<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Faktur extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("produk_model");
        $this->load->model("batch_model");
        $this->load->model("perusahaan_model");
        $this->load->model("faktur_model");
        $this->load->model("produkBeli_model");
        $this->load->model("jenis_model");
        $this->load->model("bentuk_model");
        $this->load->model("rak_model");
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data["faktur"] = $this->faktur_model->getAll();
        $this->load->view("admin/faktur/list",$data);
    }

    public function tambahFaktur()
    {
        $faktur = $this->faktur_model;
        $data["perusahaan"] = $this->perusahaan_model->getAll();
        $validation = $this->form_validation;
        $validation->set_rules($faktur->rules());        
        if ($validation->run()) {
            $faktur->save();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
        }
        $this->load->view("admin/faktur/tambahFaktur",$data);
    }

    public function tambahProduk($id = null)
    {
        $data = array(
            'faktur' => $this->faktur_model->getFaktur($id),
            'batchProduk' => $this->faktur_model->getProdukByNo($id),
            'produk' => $this->produk_model->getAll(),
            'batch' => $this->batch_model->getAll()
        );
        $batch = $this->batch_model;
        $idFaktur = $this->faktur_model->getFaktur($id);
        $pb = $this->produkBeli_model;
        $validation = $this->form_validation;
        $validation->set_rules($pb->rules());      
        if ($validation->run()) {
            $batch->save();
            $pb->save($idFaktur->idFaktur);
            $this->session->set_flashdata('success', 'Berhasil disimpan');
        }
        $this->load->view("admin/faktur/tambahProduk",$data);
    }

    public function edit($id = null)
    {
        if (!isset($id)) redirect('admin/faktur');
       
        $faktur = $this->faktur_model;
        $validation = $this->form_validation;
        $validation->set_rules($faktur->rules());

        if ($validation->run()) {
            $faktur->update();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
        }
        $data["faktur"] = $faktur->getById($id);
        if (!$data["faktur"]) show_404();
        
        $this->load->view("admin/faktur/edit_form", $data);
    }

    public function deleteFaktur($id=null)
    {
        if (!isset($id)) show_404();
        if($this->produkBeli_model->deleteFaktur($this->faktur_model->getFaktur($id)->idFaktur) && $this->faktur_model->delete($id)){
            redirect(site_url('admin/faktur'));
        }
    }

    public function deleteBatch($idF=null,$idB=null)
    {
        
        if (!isset($idF)) show_404();
        if($this->faktur_model->deleteBatch($idF,$this->batch_model->getBatch($idB)->idBatch)){
            redirect(site_url('admin/faktur/'));
        }
    }

    public function print()
    {
        var_dump($this->input->post());
    }
}