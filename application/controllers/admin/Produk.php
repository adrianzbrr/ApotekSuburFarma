<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Produk extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("produk_model");
        $this->load->model("jenis_model");
        $this->load->model("bentuk_model");
        $this->load->model("rak_model");
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data["produk"] = $this->produk_model->getAll();
        $this->load->view("admin/product/list", $data);
    }

    public function add()
    {
        $produk = $this->produk_model;
        $data = array(
            'jenis' => $this->jenis_model->getAll(),
            'bentuk' => $this->bentuk_model->getAll(),
            'rak' => $this->rak_model->getAll()
        );
        $validation = $this->form_validation;
        $validation->set_rules($produk->rules());        
        if ($validation->run()) {
            $produk->save();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
        }
        $this->load->view("admin/product/new_form",$data);
    }

    public function edit($id = null)
    {
        if (!isset($id)) redirect('admin/produk');
       
        $produk = $this->produk_model;
        $validation = $this->form_validation;
        $validation->set_rules($produk->rules());

        if ($validation->run()) {
            $produk->update();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
        }
        
        $data["produk"] = $produk->getById($id);
        if (!$data["produk"]) show_404();
        
        $this->load->view("admin/product/edit_form", $data);
    }

    public function delete($id=null)
    {
        if (!isset($id)) show_404();
        
        if ($this->produk_model->delete($id)) {
            redirect(site_url('admin/produk'));
        }
    }
    public function print()
    {
        var_dump($this->input->post());
    }
}