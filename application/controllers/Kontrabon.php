<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Kontrabon extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("kontraBon_model");
        $this->load->model("faktur_model");
        $this->load->model("perusahaan_model");
        $this->load->model("angsuran_model");
        $this->load->library('form_validation');
    }

    public function index()
    {
        check_not_login();//memeriksa session, user telah login
        $data["kontraBonNF"] = $this->kontraBon_model->getAllNF();
        $this->load->view("kontraBon/list",$data);
    }

    public function indexFinal()
    {
        check_not_login();//memeriksa session, user telah login
        $data["kontraBonF"] = $this->kontraBon_model->getAllF();
        $this->load->view("kontraBon/listFinal",$data);
    }

    public function add()
    {
        check_not_login();//memeriksa session, user telah login
        $kontrabon = $this->kontraBon_model;
        $data = array(
            'perusahaan' => $this->perusahaan_model->getAll()
        );
        $validation = $this->form_validation;
        $validation->set_rules($kontrabon->rules());        
        if ($validation->run()) {
            $post = $this->input->post();
            $checkNama = $this->kontraBon_model->getByNama($post["noKontraBon"]);
            if($checkNama == 0){
                $kontrabon->save();
                $this->session->set_flashdata('success', 'Kontra bon berhasil disimpan');
                redirect(site_url('kontraBon'));   
            }else{
                echo "<script> 
					alert('Nomor Kontra Bon sudah terdaftar, Silahkan registrasi ulang');
					window.location='".site_url('kontraBon/add')."';
					</script>";
            }
        }
        $this->load->view("kontraBon/new_form",$data);
    }

    public function listFaktur($id)
    {
        check_not_login();//memeriksa session, user telah login
        $data = array(
            'noKontraBon' => $this->kontraBon_model->getKontraBon($id),
            'noFaktur' => $this->kontraBon_model->getFakturById($id),
            'kontraBonF' => $this->kontraBon_model->getAllFbyId($id),
            'angsuran'=> $this->angsuran_model->getByKontraBon($id)
        );
        $angsuran = $this->angsuran_model;
        $validation = $this->form_validation;
        $validation->set_rules($angsuran->rules());        
        if ($validation->run()) {
            $angsuran->save();
            $this->session->set_flashdata('success', 'Berhasil');
            redirect($this->uri->uri_string());
        }
        $this->load->view("kontraBon/faktur_list",$data);
    }

    public function addFaktur($id = null)
    {
        check_not_login();//memeriksa session, user telah login
        $idPerusahaan = $this->kontraBon_model->getKontraBon($id);
        $data = array(
            'kontraBon' => $this->kontraBon_model->getKontraBon($id),
            'noFaktur' => $this->kontraBon_model->getFakturById($id),
            'notFaktur' => $this->kontraBon_model->getFakturByPerusahaan($idPerusahaan->idPerusahaan)
        );
        $faktur = $this->faktur_model;
        $idKontraBon = $this->kontraBon_model->getKontraBon($id);
        $validation = $this->form_validation;
        $validation->set_rules($faktur->rules1());        
        if ($validation->run()) {
            $faktur->masukKontraBon($idKontraBon->idKontraBon);
            $this->session->set_flashdata('success', 'Faktur berhasil disimpan');
            redirect($this->uri->uri_string());
        }
        $this->load->view("kontraBon/add_Faktur",$data);
    }


    public function edit($id = null)
    {
        check_not_login();//memeriksa session, user telah login
        if (!isset($id)) redirect('kontrabon');
        $kontrabon = $this->kontraBon_model;
        $validation = $this->form_validation;
        $validation->set_rules($kontrabon->rules());
        if ($validation->run()) {
            $kontrabon->update();
            $this->session->set_flashdata('success', 'Kontra bon berhasil diperbaharui');
        }

        $data["kontrabon"] = $kontarbon->getKontraBon($id);
        if (!$data["kontrabon"]) show_404();
        
        $this->load->view("kontrabon/edit_form", $data);
    }

    public function delete($id=null)
    {
        check_not_login();//memeriksa session, user telah login
        if (!isset($id)) show_404();
        $this->faktur_model->deleteAllKontraBon($id);
        if($this->kontraBon_model->delete($id)){
            redirect(site_url('kontraBon'));
            $this->session->set_flashdata('danger', 'Kontra Bon berhasil dihapus');
        }
    }

    public function deleteFaktur($id)
    {
        check_not_login();//memeriksa session, user telah login
        if (!isset($id)) show_404();
        if($this->faktur_model->deleteKontraBon($id)){
            $this->session->set_flashdata('danger', 'Faktur berhasil dihapus');
            redirect($this->uri->uri_string());
        }
    }

    public function finalize($id){
        check_not_login();//memeriksa session, user telah login
        $this->kontraBon_model->finalize($id);
        redirect(site_url('kontraBon'));
    }

    public function print()
    {
        var_dump($this->input->post());
    }
}