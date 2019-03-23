<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan_model extends CI_Model
{
    private $_tableKadaluarsa = "kadaluarsa_view";

    public function getAll(){
        return $this->db->get($this->_tableKadaluarsa)->result();
    }

}