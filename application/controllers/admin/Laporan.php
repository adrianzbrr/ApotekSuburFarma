<?php

class Laporan extends CI_Controller {
public function __construct()
    {
		parent::__construct();
		$this->load->model("laporan_model");
	}

	public function index()
	{
	// load view admin/laporan.php
	$data = array(
        'kdl'=> $this->laporan_model->getAll()
	    );
        $this->load->view("admin/laporan/listOpname",$data);
	}
}