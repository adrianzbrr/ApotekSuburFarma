<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Rak_model extends CI_Model
{
    public $_table = "rak";

    public $idRak;
    public $namaRak;

    public function getAll(){
        return $this->db->get($this->_table)->result();
    }

    public function getId($nama){
        $hasil=$this->db->query("SELECT idRak FROM Rak WHERE namaRak ='$nama'");
        return $hasil->result();
    }
        
}