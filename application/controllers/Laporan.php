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
		check_not_login();//memeriksa session, user telah login
		// load view laporan.php
		$data = array(
			'hbs'=> $this->laporan_model->getAll()
	    );
        $this->load->view("laporan/listDefekta",$data);
	}

    public function expiredReport()
	{
		check_not_login();//memeriksa session, user telah login
		// load view laporan.php
		$data = array(
        	'kdl'=> $this->laporan_model->getAllKadaluarsa()
	    );
        $this->load->view("laporan/listExpired",$data);
    }
    
	public function delete($id)
	{
		check_not_login();//memeriksa session, user telah login
		if (!isset($id)) show_404();
		$this->batch_model->makeZero($id);
        if ($this->laporan_model->out($id)) {
			$this->session->set_flashdata('danger', 'Produk berhasil dihapus');
			redirect($this->uri->uri_string());
        }        
	}
}
