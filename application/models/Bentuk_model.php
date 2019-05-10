<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Bentuk_model extends CI_Model
{
    private $_table = "bentuk";

    public function getAll(){
        return $this->db->get($this->_table)->result();
    }
}