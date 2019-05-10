<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Jabatan_model extends CI_Model
{
    private $_table = "jabatan";

    public function getAll(){
        return $this->db->get($this->_table)->result();
    }

    public function getNumRow($id){
        return $this->db->get_where($this->_table, ["username" => $id])->num_rows();
    }
}