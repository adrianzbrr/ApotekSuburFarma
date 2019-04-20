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
        check_not_login();//memeriksa session, user telah login
        $data["perusahaan"] = $this->perusahaan_model->getAll();
        $this->load->view("perusahaan/list", $data);
    }

    public function add()
    {
        check_not_login();//memeriksa session, user telah login
        $perusahaan = $this->perusahaan_model;
        $validation = $this->form_validation;
        $validation->set_rules($perusahaan->rules());
        if ($validation->run()) {
            $perusahaan->save();
            $this->session->set_flashdata('success', 'Perusahaan berhasil disimpan');
            redirect(site_url('perusahaan'));
        }
        $data["perusahaan"] = $this->perusahaan_model->getAll();
        $this->load->view("perusahaan/new_form", $data);
    }

    public function edit($id = null)
    {
        check_not_login();//memeriksa session, user telah login
        if (!isset($id)) redirect('perusahaan');

        $perusahaan = $this->perusahaan_model;
        $validation = $this->form_validation;
        $validation->set_rules($perusahaan->rules());

        if ($validation->run()) {
            $perusahaan->update();
            $this->session->set_flashdata('warning', 'Perusahaan berhasil diperbaharui');
            redirect(site_url('perusahaan'));
        }

        $data["perusahaan"] = $perusahaan->getById($id);
        if (!$data["perusahaan"]) show_404();

        $this->load->view("perusahaan/edit_form", $data);
    }
    public function delete($id = null)
    {
        check_not_login();//memeriksa session, user telah login
        if (!isset($id)) show_404();

        if ($this->perusahaan_model->delete($id)) {
            $this->session->set_flashdata('danger', 'Perusahaan berhasil dihapus');
            redirect(site_url('perusahaan'));
        }
    }

    public function print()
    {
        var_dump($this->input->post());
    }
}
