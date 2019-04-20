<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan_model extends CI_Model
{
    private $_tableKadaluarsa = "kadaluarsa_view";
    private $_tableHabis = "habis_view";

    public function getAll(){
        return $this->db->get($this->_tableHabis)->result();
    }

    public function getLimit(){
        return $this->db->get($this->_tableHabis,5)->result();
    }

    public function getAllKadaluarsa(){
        return $this->db->get($this->_tableKadaluarsa)->result();
    }
    

}