<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Perusahaan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("perusahaan_model");
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data["perusahaan"] = $this->perusahaan_model->getAll();
        $this->load->view("admin/perusahaan/list", $data);
    }

    public function add()
    {

        $perusahaan = $this->perusahaan_model;
        $validation = $this->form_validation;
        $validation->set_rules($perusahaan->rules());
        if ($validation->run()) {
            $perusahaan->save();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
        }
        $data["perusahaan"] = $this->perusahaan_model->getAll();
        $this->load->view("admin/perusahaan/new_form", $data);
    }

    public function edit($id = null)
    {
        if (!isset($id)) redirect('admin/perusahaan');

        $perusahaan = $this->perusahaan_model;
        $validation = $this->form_validation;
        $validation->set_rules($perusahaan->rules());

        if ($validation->run()) {
            $perusahaan->update();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
        }

        $data["perusahaan"] = $perusahaan->getById($id);
        if (!$data["perusahaan"]) show_404();

        $this->load->view("admin/perusahaan/edit_form", $data);
    }
    public function delete($id = null)
    {
        if (!isset($id)) show_404();

        if ($this->perusahaan_model->delete($id)) {
            redirect(site_url('admin/perusahaan'));
        }
    }

    public function deleteNew($id = null)
    {
        if (!isset($id)) show_404();

        if ($this->perusahaan_model->delete($id)) {
            redirect(site_url('admin/perusahaan/add'));
        }
    }
    public function print()
    {
        var_dump($this->input->post());
    }
}
