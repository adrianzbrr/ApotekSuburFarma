<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Overview_model extends CI_Model
{
    private $_tableTunggak = "totalTunggakan_view";
    private $_tableKadaluarsa = "totalKadaluarsa";
    private $_tableHabis = "totalHabis_view";
    private $_tableJumlahProduk = "jumlahProduk_view";
    private $_tableKontraBon = "kontrabonfinal_view";

    public function getAll(){
        return $this->db->get($this->_tableTunggak)->result();
    }

    public function getNumKadaluarsa(){
        return $this->db->get($this->_tableKadaluarsa)->result();
    }

    public function getNumHabis(){
        return $this->db->get($this->_tableHabis)->result();
    }

    public function getNumProduct(){
        return $this->db->get($this->_tableJumlahProduk)->row();
    }

    public function getKontraBonExp(){
        return $this->db->get_where($this->_tableKontraBon, ["sisaHari" <= 7])->num_rows();
    }
}