<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan_model extends CI_Model
{
    private $_table="laporan";
    private $_tableKedaluwarsa = "kedaluwarsa_view";
    private $_tableHabis = "habis_view";
    private $_tableBatch = "batch_view";

    public function getAllHabis(){
        return $this->db->get($this->_tableHabis)->result();
    }

    public function getLimit(){
        return $this->db->get($this->_tableHabis,5)->result();
    }

    public function getAllKedaluwarsa(){
        return $this->db->get($this->_tableKedaluwarsa)->result();
    }

    public function getNumHabis(){
        return $this->db->get($this->_tableHabis)->num_rows();
    }

    public function getNumKedaluwarsa(){
        return $this->db->get($this->_tableKedaluwarsa)->num_rows();
    }

    public function getBatch($id){
        $this->db->where("noBatch",$id);
        $this->db->order_by("idBatch",'DESC');
        return $this->db->get($this->_tableBatch)->row();
    }

    public function getProdukByBatch($id){
        return $this->db->get_where($this->_tableBatch,["idBatch" => $id])->row();
    }

    public function in()
    {
        $post = $this->input->post();
        $this->tanggalLaporan = $post["tanggal"];
        $this->jenisLaporan = 0;
        $this->idBatch = $this->getBatch($post["noBatch"])->idBatch;
        $this->sisa = $this->getProdukByBatch($this->getBatch($post["noBatch"])->idBatch)->total;
        $this->db->insert($this->_table, $this);
    }
    
    public function out($id)
    {
        $post = $this->input->post();
        $this->tanggalLaporan = date('y-m-d');
        $this->jenisLaporan = 1;
        $this->idBatch = $id;
        $this->sisa = $this->getProdukByBatch($id)->total;
        $this->db->insert($this->_table, $this);
    }
}