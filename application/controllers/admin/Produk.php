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
        $data["produk"] = $this->produk_model->getAll();
        $this->load->view("admin/produk/list", $data);
    }

    public function getBatch($id)
    {
        $data["batch"] = $this->batch_model->getByProduk($id);
        $this->load->view("admin/produk/listBatch", $data);
    }

    public function add()
    {
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
            $produk->save();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
            redirect(site_url('admin/produk'));
        }
        $this->load->view("admin/produk/new_form", $data);
    }

    public function edit($id = null)
    {
        if (!isset($id)) redirect('admin/produk');
        $produk = $this->produk_model;
        $validation = $this->form_validation;
        $validation->set_rules($produk->rules());
        if ($validation->run()) {
            $produk->update();
            $this->session->set_flashdata('warning', 'Berhasil diubah');
            redirect(site_url('admin/produk'));
        }

        $data = array(
            'produk' => $this->produk_model->getById($id),
            'jenis' => $this->jenis_model->getAll(),
            'bentuk' => $this->bentuk_model->getAll(),
            'rak' => $this->rak_model->getAll(),
            'satuan' => $this->satuan_model->getAll()
        );
        if (!$data["produk"]) show_404();

        $this->load->view("admin/produk/edit_form", $data);
    }

    public function delete($id = null)
    {
        if (!isset($id)) show_404();

        if ($this->produk_model->delete($id)) {
            $this->session->set_flashdata('danger', 'Berhasil dihapus');
            redirect(site_url('admin/produk'));
        }
    }
    public function print()
    {
        var_dump($this->input->post());
    }
}
