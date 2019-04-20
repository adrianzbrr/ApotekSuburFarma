<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Batch_model extends CI_Model
{
    private $_table = "batch";
    private $_tableView = "batch_view";
    private $_tableKadaluarsa = "kadaluarsa_view";
    private $_tableProduk = "produk";

    public $noBatch;
    public $tanggalKadaluarsa;
    public $jumlah;
    public $idProduk;

    public function getAll(){
        return $this->db->get($this->_table)->result();
    }

    public function getBatch($id){
        return $this->db->get_where($this->_table, ["noBatch" => $id])->row();
    }

    public function getByProduk($id){
        return $this->db->get_where($this->_tableView, ["idProduk" => $id])->result();
    }

    public function getProduk($id)
    {
        return $this->db->get_where($this->_tableProduk, ["namaProduk" => $id])->row();
    }

    public function save(){
        $post=$this->input->post();
        $this->noBatch = $post["noBatch"];
        $this->tanggalKadaluarsa = $post["tanggalKadaluarsa"];
        $this->jumlah= $post["jumlah"];
        $this->idProduk = $this->getProduk($post["idProduk"])->idProduk;
        $this->db->insert($this->_table,$this);
    }
    
    public function delete($id)
    {
        return $this->db->delete($this->_table, array("idBatch" => $id));
    }

    public function makeZero($id)
    {
        $this->db->set('jumlah',0);
        $this->db->where('idBatch',$id);
        $this->db->update('Batch');
    }
}