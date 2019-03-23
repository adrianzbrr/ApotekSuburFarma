<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Jenis_model extends CI_Model
{
    private $_table = "jenis";

    public function getAll(){
        return $this->db->get($this->_table)->result();
    }

    public function getId($nama){
        $hasil=$this->db->query("SELECT idJenis FROM Jenis WHERE namaJenis ='$nama'");
        return $hasil->result();
    }
        
}