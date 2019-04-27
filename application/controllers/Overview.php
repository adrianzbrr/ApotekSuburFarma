<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Overview extends CI_Controller {
	
	public function __construct(){
		
		parent::__construct();
		$this->load->model("overview_model");
		$this->load->model("laporan_model");
		$this->load->model("kontrabon_model");
		$this->load->model("batch_model");
	}

	public function index()
	{
		check_not_login();//memeriksa session, user telah login
		// load view overview.php
		$data = array(
			'tunggak' => $this->overview_model->getAll(),
			'habis' => $this->laporan_model->getLimit(),
			'prdk'=> $this->overview_model->getNumProduct(),
			'kdl'=> $this->laporan_model->getNumKadaluarsa(),
			'hbs'=> $this->laporan_model->getNumHabis(),
			'exp'=> $this->kontrabon_model->getNumKontraBonExp()
		);
        $this->load->view("overview",$data);
	}
}
