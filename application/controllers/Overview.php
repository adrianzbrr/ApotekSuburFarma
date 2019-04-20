<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Overview extends CI_Controller {
	
	public function __construct(){
		
		parent::__construct();
		$this->load->model("overview_model");
		$this->load->model("laporan_model");

	}

	public function index()
	{
		check_not_login();//memeriksa session, user telah login
		// load view overview.php
		$data = array(
			'habis' => $this->laporan_model->getLimit(),
			'tunggak' => $this->overview_model->getAll(),
			'kdl'=> $this->overview_model->getNumKadaluarsa(),
			'hbs'=> $this->overview_model->getNumHabis(),
			'prdk'=> $this->overview_model->getNumProduct()
	    );
        $this->load->view("overview",$data);
	}
}
