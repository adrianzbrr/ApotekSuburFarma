<?php
class Pengguna extends CI_Controller {

	public function __construct()
	{
		parent::__construct();		
		$this->load->model('pengguna_model');
		$this->load->model('jabatan_model');
        $this->load->library('form_validation');
		
	}
	
	public function index()
    {
        check_not_login();//memeriksa session, user telah login
        $data["pengguna"] = $this->pengguna_model->getAll();
        $this->load->view("pengguna/list", $data);
	}
	
	public function login(){
		check_already_login();
		$this->load->view("login");
	}

	public function process()
	{
		$post = $this->input->post(null, TRUE);
		if(isset($post['username'])){
			$query =$this->pengguna_model->login($post);
			if($query->num_rows()>0){
				$row = $query->row();
				$params = array(
					'username' => $row->username,
					'idJabatan' => $row->idJabatan
				);
				$this->session->set_userdata($params);
				echo "<script> 
					alert('Login Berhasil');
					window.location='".site_url('overview')."';
					</script>";
			}else{
				echo "<script> 
					alert('username dan password tidak terdaftar');
					window.location='".site_url('pengguna')."';
					</script>";
			}
		}
	}
		
	public function logout(){
		$params = array(
			'username','idJabatan'
		);
		$this->session->unset_userdata($params);
		redirect('pengguna');
	} 

	public function add(){
		check_not_login();//memeriksa session, user telah login
        $pengguna = $this->pengguna_model;
        $validation = $this->form_validation;
        $validation->set_rules($pengguna->rules());        
        if ($validation->run()) {
            $post = $this->input->post();
            $checkNama = $this->pengguna_model->getNumRow($post["username"]);
            if($checkNama == 0){
                $pengguna->register();
				$this->session->set_flashdata('success', 'Pengguna baru berhasil disimpan');
				redirect(site_url('pengguna')); 
            }else{
                echo "<script> 
					alert('Username telah terdaftar, Silahkan registrasi ulang');
					window.location='".site_url('pengguna/pengguna')."';
					</script>";
            }
        }
        $data["jabatan"] = $this->jabatan_model->getAll();
        $this->load->view("pengguna/new_form", $data);
	}

	public function edit($id = null){
		check_not_login();//memeriksa session, user telah login
		if (!isset($id)) redirect('pengguna');
		$pengguna = $this->pengguna_model;
		$data["pengguna"]=$this->pengguna_model->getById($id);
		$data["jabatan"] = $this->jabatan_model->getAll();
		$validation = $this->form_validation;
		$validation->set_rules($pengguna->rules());        
        if ($validation->run()) {
            $pengguna->update();
			$this->session->set_flashdata('warning', 'Pengguna berhasil diperbarui');
			redirect(site_url('pengguna'));
		}
		$this->load->view("pengguna/edit_form", $data);
	}

	public function delete($id=null){
		check_not_login();//memeriksa session, user telah login
		if (!isset($id)) show_404();
		
        if ($this->pengguna_model->delete($id)) {
            $this->session->set_flashdata('danger', 'Pengguna berhasil dihapus');
            redirect(site_url('pengguna'));
        }
	}

}
