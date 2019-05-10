<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Rak extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("rak_model");
        $this->load->library('form_validation');
    }

    public function index()
    {
        check_not_login();//memeriksa session, user telah login
        $data["rak"] = $this->rak_model->getAll();
        $this->load->view("rak/list", $data);
    }

    public function getProduk($id)
    {
        check_not_login();//memeriksa session, user telah login
        $data["produk"] = $this->rak_model->getProdukById($id);
        $this->load->view("rak/listProduk", $data);
    }

    public function add()
    {
        check_not_login();//memeriksa session, user telah login
        $rak = $this->rak_model;
        $validation = $this->form_validation;
        $validation->set_rules($rak->rules());
        if ($validation->run()) {
            $post = $this->input->post();
            $checkNama = $this->rak_model->getNumRow($post["namaRak"]);
            if($checkNama == 0){
                $rak->save();
                $this->session->set_flashdata('success', 'Rak berhasil disimpan');
                redirect(site_url('rak'));   
            }else{
                echo "<script> 
					alert('Nama Rak Sudah Terdaftar');
					window.location='".site_url('rak/add')."';
					</script>";
            }
            
        }
        $this->load->view("rak/new_form");
    }

    public function edit($id = null)
    {
        check_not_login();//memeriksa session, user telah login
        if (!isset($id)) redirect('rak');
        $rak = $this->rak_model;
        $validation = $this->form_validation;
        $validation->set_rules($rak->rules());
        if ($validation->run()) {
            $post = $this->input->post();
            $checkNama = $this->rak_model->getNumRow($post["namaRak"]);
            if($checkNama == 0){
                $rak->update();
                $this->session->set_flashdata('warning', 'Rak berhasil diperbaharui');
                redirect(site_url('rak'));  
            }else{
                echo "<script> 
					alert('Nama Rak Sudah Terdaftar, Silahkan ulang kembali');
					window.location='".site_url('rak')."';
					</script>";
            }
        }

        $data["rak"] = $this->rak_model->getById($id);
        if (!$data["rak"]) show_404();

        $this->load->view("rak/edit_form", $data);
    }

    public function delete($id = null)
    {
        check_not_login();//memeriksa session, user telah login
        if (!isset($id)) show_404();

        if ($this->rak_model->delete($id)) {
            $this->session->set_flashdata('danger', 'Rak berhasil dihapus');
            redirect(site_url('rak'));
        }
    }
    public function print()
    {
        var_dump($this->input->post());
    }
}
