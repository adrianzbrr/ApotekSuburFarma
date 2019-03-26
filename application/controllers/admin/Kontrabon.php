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
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data["kontraBon"] = $this->kontraBon_model->getAll();
        $this->load->view("admin/kontraBon/list",$data);
    }

    public function add()
    {
        $kontrabon = $this->kontraBon_model;

        $data = array(
            'perusahaan' => $this->perusahaan_model->getAll()
        );
        $validation = $this->form_validation;
        $validation->set_rules($kontrabon->rules());        
        if ($validation->run()) {
            $kontrabon->save();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
        }
        $this->load->view("admin/kontraBon/tambah",$data);
    }

    public function tambahFaktur($id = null)
    {
        $idPerusahaan = $this->kontraBon_model->getKontraBon($id);
        $data = array(
            'noKontraBon' => $this->kontraBon_model->getKontraBon($id),
            'noFaktur' => $this->kontraBon_model->getFakturById($id),
            'notFaktur' => $this->kontraBon_model->getFakturByPerusahaan($idPerusahaan->idPerusahaan)
        );
        $faktur = $this->faktur_model;
        $idKontraBon = $this->kontraBon_model->getKontraBon($id);
        $validation = $this->form_validation;
        $validation->set_rules($faktur->rules1());        
        if ($validation->run()) {
            echo $idKontraBon->idKontraBon;
            $faktur->masukKontraBon($idKontraBon->idKontraBon);
            $this->session->set_flashdata('success', 'Berhasil disimpan');
        }
        $this->load->view("admin/kontraBon/tambahFaktur",$data);
    }


    public function edit($id = null)
    {
        if (!isset($id)) redirect('admin/kontrabon');
        $kontrabon = $this->kontraBon_model;
        $validation = $this->form_validation;
        $validation->set_rules($kontrabon->rules());
        if ($validation->run()) {
            $kontrabon->update();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
        }

        $data["kontrabon"] = $kontarbon->getKontraBon($id);
        if (!$data["kontrabon"]) show_404();
        
        $this->load->view("admin/kontrabon/edit_form", $data);
    }

    public function delete($id=null)
    {
        if (!isset($id)) show_404();
        $this->faktur_model->deleteAllKontraBon($id);
        if($this->kontraBon_model->delete($id)){
            redirect(site_url('admin/kontraBon'));
            $this->session->set_flashdata('danger', 'Kontra Bon');
        }
    }

    public function deleteFaktur($id){
        if (!isset($id)) show_404();
        if($this->faktur_model->deleteKontraBon($id)){
            redirect($this->uri->uri_string('Faktur berhasil'));
            $this->session->set_flashdata('danger', 'Faktur berhasil dihapus');
        }

    }
    public function print()
    {
        var_dump($this->input->post());
    }
}