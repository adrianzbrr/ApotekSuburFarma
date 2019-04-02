<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Laporan extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
        $this->load->model("laporan_model");
        $this->load->model("batch_model");
	}
    
    public function index()
	{
	// load view admin/laporan.php
	$data = array(
        'hbs'=> $this->laporan_model->getAll()
	    );
        $this->load->view("admin/laporan/listDefekta",$data);
	}

    public function laporanKadaluarsa()
	{
	// load view admin/laporan.php
	$data = array(
        'kdl'=> $this->laporan_model->getAllKadaluarsa()
	    );
        $this->load->view("admin/laporan/listOpname",$data);
    }
    
	public function delete($id)
	{
        if (!isset($id)) show_404();

        if ($this->batch_model->delete($id)) {
            redirect(site_url('admin/perusahaan'));
        }        
	}
}