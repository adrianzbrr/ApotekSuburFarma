<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Overview_model extends CI_Model
{
    private $_tableTunggak = "totalTunggakan_view";
    private $_tableJumlahProduk = "jumlahProduk_view";

    public function getTunggak(){
        return $this->db->get($this->_tableTunggak)->result();
    }

    public function getNumProduct(){
        return $this->db->get($this->_tableJumlahProduk)->row();
    }
}