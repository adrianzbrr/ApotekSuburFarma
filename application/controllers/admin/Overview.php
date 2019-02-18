<?php

class Overview extends CI_Controller {
    public function __construct()
    {
		parent::__construct();
		$this->load->model("overview_model");

	}

	public function index()
	{
	// load view admin/overview.php
	$data = array(
		'tunggak' => $this->overview_model->getAll()
	    );
        $this->load->view("admin/overview",$data);
	}
}