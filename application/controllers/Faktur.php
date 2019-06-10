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
        $this->load->model("pesanan_model");
        $this->load->model("laporan_model");
        $this->load->library('form_validation');
        $this->load->library('user_agent');
    }

    public function index()
    {
        check_not_login();//memeriksa session, user telah login
        $data["fakturNF"] = $this->faktur_model->getAllNF();
        $this->load->view("faktur/list",$data);
    }

    public function indexFinal()
    {
        check_not_login();//memeriksa session, user telah login
        $data["fakturF"] = $this->faktur_model->getAllF();
        $this->load->view("faktur/listFinal",$data);
        
    }

    public function add()
    {
        check_not_login();//memeriksa session, user telah login
        $faktur = $this->faktur_model;
        $data["perusahaan"] = $this->perusahaan_model->getAll();
        $data["pesanan"] = $this->pesanan_model->getAllF();
        $validation = $this->form_validation;
        $validation->set_rules($faktur->rules());        
        if ($validation->run()) {
            $post = $this->input->post();
            $checkNama = $this->faktur_model->getNumRow($post["noFaktur"]);
            if($checkNama == 0){
                $faktur->save();
                $this->session->set_flashdata('success', 'Faktur berhasil disimpan');
                redirect(site_url('faktur'));   
            }else{
                echo "<script> 
					alert('Nomor Faktur sudah terdaftar, Silahkan registrasi ulang');
					window.location='".site_url('faktur/add')."';
					</script>";
            }
        }
        $this->load->view("faktur/new_form",$data);
    }

    public function addProduct($id = null)
    {
        check_not_login();//memeriksa session, user telah login
        $faktur=$this->faktur_model->getById($id);
        $data = array(
            'faktur' => $this->faktur_model->getById($id),
            'batchProduk' => $this->faktur_model->getProdukById($id),
            'produk' => $this->produk_model->getAll(),
            'batch' => $this->batch_model->getAll(),
            'pesanan' => $this->pesanan_model->getProdukById($faktur->idPesanan)
        );
        $batch = $this->batch_model;
        $pb = $this->produkBeli_model;
        $laporan = $this->laporan_model;
        $validation = $this->form_validation;
        $validation->set_rules($pb->rules());
        if ($validation->run()) {
            $batch->save();
            $pb->save($id);
            $laporan->in();
            $this->session->set_flashdata('success', 'Produk berhasil disimpan');
            redirect($this->uri->uri_string());
        }
        $this->load->view("faktur/add_product_form",$data); 
    }

    public function listProduct($id = null)
    {
        check_not_login();//memeriksa session, user telah login
        $data = array(
            'faktur' => $this->faktur_model->getById($id),
            'batchProduk' => $this->faktur_model->getProdukById($id)
        );
        $this->load->view("faktur/product_list",$data);
    }

    public function edit($id = null)
    {
        check_not_login();//memeriksa session, user telah login
        if (!isset($id)) redirect('faktur');
        $faktur = $this->faktur_model;
        $validation = $this->form_validation;
        $validation->set_rules($faktur->rules());
        if ($validation->run()) {
            $faktur->update();
            $this->session->set_flashdata('warning', 'Faktur berhasil diperbarui');
            redirect(site_url('faktur'));
        }
        $data= array(
            'faktur' => $this->faktur_model->getById($id),
            'perusahaan' => $this->perusahaan_model->getAll()
        );       
        $this->load->view("faktur/edit_form", $data);
    }

    public function deleteFaktur($id=null)
    {
        check_not_login();//memeriksa session, user telah login
        if (!isset($id)) show_404();
        $this->produkBeli_model->deleteFaktur($id);
        $this->faktur_model->delete($id);
            $this->session->set_flashdata('danger', 'Faktur berhasil dihapus');
            redirect(site_url('faktur'));
    }

    public function deleteBatch($id=null)
    {
        check_not_login();//memeriksa session, user telah login    
        if (!isset($id)) show_404();
        $this->laporan_model->delete($id);
        if($this->produkBeli_model->deleteBatch($id) && $this->batch_model->delete($id)){
            $this->session->set_flashdata('danger', 'Produk berhasil dihapus');
            redirect($this->agent->referrer());
        }
    }

    public function finalize($id)
    {
        check_not_login();//memeriksa session, user telah login
        $this->faktur_model->finalize($id);
        $data["fakturNF"] = $this->faktur_model->getAllNF();
        $data["fakturF"] = $this->faktur_model->getAllF();
        $this->load->view("faktur/listFinal",$data);
    }
}