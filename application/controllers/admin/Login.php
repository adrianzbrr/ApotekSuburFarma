<?php
class Login extends CI_Controller {

    public function __construct(){
		parent::__construct();		
		$this->load->model('pengguna_model');
	}
 
	public function index(){
		$this->load->view("admin/login");
	}
 
    public function aksi_login()
    {
        var_dump($this->input->post());
        $username = $this->input->post('username');
		$password = $this->input->post('password');
		$where = array(
			'username' => $username,
			'password' => md5($password)
			);
		$cek = $this->pengguna_model->cek_login("pengguna",$where)->num_rows();
		if($cek > 0){

			$data_session = array(
				'nama' => $username,
				'status' => "login"
				);
 
            $this->session->set_userdata($data_session);
            
			redirect(base_url("admin/login"));
 
		}else{
			echo "Username dan password salah !";
		}
	}
 
	function logout(){
		$this->session->sess_destroy();
		redirect(base_url('login'));
	} 
}