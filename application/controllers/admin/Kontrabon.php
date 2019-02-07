<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Kontrabon extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("kontraBon_model");
        $this->load->model("faktur_model");
    }

    public function index()
    {
        $data["kontraBon"] = $this->kontraBon_model->getAll();
        $this->load->view("admin/kontraBon/list",$data);
    }

    public function add()
    {
        $kontrabon = $this->faktur_model;
        $data["faktur"] = $this->faktur_model->getAll();
        $validation = $this->form_validation;
        $validation->set_rules($kontrabon->rules());        
        if ($validation->run()) {
            $kontrabon->save();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
        }
        $this->load->view("admin/kontrabon/tambah",$data);
    }


    public function edit($id = null)
    {
        if (!isset($id)) redirect('admin/kontrabon');
       
        $kontrabon = $this->kontra_model;
        $validation = $this->form_validation;
        $validation->set_rules($kontrabon->rules());
        if ($validation->run()) {
            $kontrabon->update();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
        }

        $data["kontrabon"] = $kontarbon->getById($id);
        if (!$data["kontrabon"]) show_404();
        
        $this->load->view("admin/kontrabon/edit_form", $data);
    }

    public function delete($id=null)
    {
        if (!isset($id)) show_404();
        $this->faktur_model->delete($id);
    }
    public function print()
    {
        var_dump($this->input->post());
    }
}