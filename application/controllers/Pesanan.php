<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Pesanan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("produk_model");
        $this->load->model("perusahaan_model");
        $this->load->model("pesanan_model");
        $this->load->model("faktur_model");
        $this->load->library('form_validation');
        $this->load->library('user_agent');
    }

    public function index()
    {
        check_not_login();//memeriksa session, user telah login
        $data["pesananNF"] = $this->pesanan_model->getAllNF();
        $this->load->view("pesanan/list",$data);
    }

    public function indexFinal()
    {
        check_not_login();//memeriksa session, user telah login
        $data["pesananF"] = $this->pesanan_model->getAllF();
        $this->load->view("pesanan/listFinal",$data);
    }

    public function add()
    {
        check_not_login();//memeriksa session, user telah login
        $pesanan = $this->pesanan_model;
        $data["perusahaan"] = $this->perusahaan_model->getAll();
        $validation = $this->form_validation;
        $validation->set_rules($pesanan->rules());        
        if ($validation->run()) {
            $pesanan->save();
            $this->session->set_flashdata('success', 'Pesanan berhasil disimpan');
            redirect(site_url('pesanan'));
        }
        $this->load->view("pesanan/new_form",$data);
    }

    public function addProduct($id = null)
    {
        check_not_login();//memeriksa session, user telah login
        $data = array(
            'pemesanan' => $this->pesanan_model->getById($id),
            'pesanan' => $this->pesanan_model->getProdukById($id),
            'produk' => $this->produk_model->getAll()
        );
        $pesanan = $this->pesanan_model;
        $validation = $this->form_validation;
        $validation->set_rules($pesanan->rulesProduk());      
        if ($validation->run()) {
            $pesanan->addProduk($id);
            $this->session->set_flashdata('success', 'Produk berhasil disimpan');
            redirect($this->uri->uri_string());
        }
        $this->load->view("pesanan/add_Product",$data);
    }

    public function listProduk($id = null)
    {
        check_not_login();//memeriksa session, user telah login
        $data = array(
            'pemesanan' => $this->pesanan_model->getById($id),
            'pesanan' => $this->pesanan_model->getProdukById($id)
        );
        $this->load->view("pesanan/listProduk",$data);
    }

    public function edit($id = null)
    {
        check_not_login();//memeriksa session, user telah login
        if (!isset($id)) redirect('pesanan');
        $pesanan = $this->pesanan_model;
        $validation = $this->form_validation;
        $validation->set_rules($pesanan->rules());
        if ($validation->run()) {
            $pesanan->update();
            $this->session->set_flashdata('warning', 'Pesanan berhasil diperbaharui');
            redirect(site_url('pesanan'));
        }
        $data= array(
            'pesanan' => $this->pesanan_model->getById($id),
            'perusahaan' => $this->perusahaan_model->getAll()
        );       
        $this->load->view("pesanan/edit_form", $data);
    }

    public function delete($id=null)
    {
        check_not_login();//memeriksa session, user telah login
        if (!isset($id)) show_404();
        if($this->pesanan_model->delete($id)){
            $this->session->set_flashdata('danger', 'Pesanan berhasil dihapus');
            redirect(site_url('pesanan'));
        }
    }

    public function deleteProduk($id=null)
    {
        check_not_login();//memeriksa session, user telah login
        if (!isset($id)) show_404();
        if($this->pesanan_model->deleteProduk($id)){
            $this->session->set_flashdata('danger', 'Produk berhasil dihapus');
            redirect($this->agent->referrer());
        }
    }

    public function finalize($id)
    {
        check_not_login();//memeriksa session, user telah login
        $this->pesanan_model->finalize($id);
        redirect(site_url('pesanan/indexFinal'));
    }

    public function print()
    {
        var_dump($this->input->post());
    }
}