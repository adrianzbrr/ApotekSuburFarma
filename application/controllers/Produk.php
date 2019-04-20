<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Produk extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("produk_model");
        $this->load->model("jenis_model");
        $this->load->model("bentuk_model");
        $this->load->model("rak_model");
        $this->load->model("batch_model");
        $this->load->model("satuan_model");
        $this->load->library('form_validation');
    }

    public function index()
    {
        check_not_login();//memeriksa session, user telah login
        $data["produk"] = $this->produk_model->getAll();
        $this->load->view("produk/list", $data);
    }

    public function getBatch($id)
    {
        check_not_login();//memeriksa session, user telah login
        $data["batch"] = $this->batch_model->getByProduk($id);
        $this->load->view("produk/listBatch", $data);
    }

    public function add()
    {
        check_not_login();//memeriksa session, user telah login
        $produk = $this->produk_model;
        $data = array(
            'jenis' => $this->jenis_model->getAll(),
            'bentuk' => $this->bentuk_model->getAll(),
            'rak' => $this->rak_model->getAll(),
            'satuan' => $this->satuan_model->getAll()
        );
        $validation = $this->form_validation;
        $validation->set_rules($produk->rules());
        if ($validation->run()) {
            $post = $this->input->post();
            $checkNama = $this->produk_model->getByNama($post["namaProduk"]);
            if($checkNama == 0){
                $produk->save();
                $this->session->set_flashdata('success', 'Produk berhasil disimpan');
                redirect(site_url('produk'));   
            }else{
                echo "<script> 
					alert('Nama Produk Sudah Terdaftar');
					window.location='".site_url('produk/add')."';
					</script>";
            }
            
        }
        $this->load->view("produk/new_form", $data);
    }

    public function edit($id = null)
    {
        check_not_login();//memeriksa session, user telah login
        if (!isset($id)) redirect('produk');
        $produk = $this->produk_model;
        $validation = $this->form_validation;
        $validation->set_rules($produk->rules());
        if ($validation->run()) {
            $produk->update();
            $this->session->set_flashdata('warning', 'Produk berhasil diperbaharui');
            redirect(site_url('produk'));
        }

        $data = array(
            'produk' => $this->produk_model->getById($id),
            'jenis' => $this->jenis_model->getAll(),
            'bentuk' => $this->bentuk_model->getAll(),
            'rak' => $this->rak_model->getAll(),
            'satuan' => $this->satuan_model->getAll()
        );
        if (!$data["produk"]) show_404();

        $this->load->view("produk/edit_form", $data);
    }

    public function delete($id = null)
    {
        check_not_login();//memeriksa session, user telah login
        if (!isset($id)) show_404();

        if ($this->produk_model->delete($id)) {
            $this->session->set_flashdata('danger', 'Produk berhasil dihapus');
            redirect(site_url('produk'));
        }
    }
    public function print()
    {
        var_dump($this->input->post());
    }
}
