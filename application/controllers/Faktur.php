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
        $this->load->library('form_validation');
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
        $data["pesanan"] = $this->pesanan_model->getAll();
        $validation = $this->form_validation;
        $validation->set_rules($faktur->rules());        
        if ($validation->run()) {
            $post = $this->input->post();
            $checkNama = $this->faktur_model->getByNama($post["noFaktur"]);
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
        $idFaktur = $this->faktur_model->getByNo($id);
        check_not_login();//memeriksa session, user telah login
        $data = array(
            'faktur' => $this->faktur_model->getByNo($id),
            'batchProduk' => $this->faktur_model->getProdukByNo($id),
            'produk' => $this->produk_model->getAll(),
            'batch' => $this->batch_model->getAll(),
            'pesanan' => $this->pesanan_model->getProdukById($idFaktur->idPesanan)
        );
        $batch = $this->batch_model;
        $pb = $this->produkBeli_model;
        $validation = $this->form_validation;
        $validation->set_rules($pb->rules());
        if ($validation->run()) {
            $batch->save();
            $pb->save($idFaktur->idFaktur);
            $this->session->set_flashdata('success', 'Produk berhasil disimpan');
            redirect($this->uri->uri_string());
        }
        $this->load->view("faktur/add_product_form",$data);
    }

    public function listProduct($id = null)
    {
        check_not_login();//memeriksa session, user telah login
        $data = array(
            'faktur' => $this->faktur_model->getByNo($id),
            'batchProduk' => $this->faktur_model->getProdukByNo($id)
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
            'faktur' => $this->faktur_model->getByNo($id),
            'perusahaan' => $this->perusahaan_model->getAll()
        );       
        $this->load->view("faktur/edit_form", $data);
    }

    public function deleteFaktur($id=null)
    {
        check_not_login();//memeriksa session, user telah login
        if (!isset($id)) show_404();
        if($this->produkBeli_model->deleteFaktur($this->faktur_model->getByNo($id)->idFaktur) && $this->faktur_model->delete($id)){
            $this->session->set_flashdata('danger', 'Faktur berhasil dihapus');
            redirect(site_url('faktur'));
        }
    }

    public function deleteBatch($id=null)
    {
        check_not_login();//memeriksa session, user telah login       
        if (!isset($id)) show_404();
        if($this->produkBeli_model->deleteBatch($id) && $this->batch_model->delete($id)){
            $this->session->set_flashdata('danger', 'Produk berhasil dihapus');
            redirect($this->uri->uri_string());
        }
    }

    public function finalize($id)
    {
        check_not_login();//memeriksa session, user telah login
        $this->faktur_model->finalize($id);
        $data["fakturNF"] = $this->faktur_model->getAllNF();
        $data["fakturF"] = $this->faktur_model->getAllF();
        $this->load->view("faktur/list",$data);
    }

    public function print()
    {
        var_dump($this->input->post());
    }
}