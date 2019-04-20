<?php

class User {
    public $ci;

    function __construct(){
        $this->ci =& get_instance();
    }

    function user_login(){
        $this->ci->load->model('pengguna_model');
        $user_id = $this->ci->session->userdata('username');
        $user_data = $this->ci->pengguna_model->getById($user_id);
        return $user_data;
    }
}