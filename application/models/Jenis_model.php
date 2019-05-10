<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Jenis_model extends CI_Model
{
    private $_table = "jenis";

    public function getAll(){
        return $this->db->get($this->_table)->result();
    }       
}