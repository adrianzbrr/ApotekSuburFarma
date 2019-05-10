<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Batch_model extends CI_Model
{
    private $_table = "batch";
    private $_tableView = "batch_view";
    private $_tableProduk = "produk_view";

    public function getAll(){
        return $this->db->get($this->_tableView)->result();
    }

    public function getProduk($id)
    {
        return $this->db->get_where($this->_tableProduk, ["namaProduk" => $id])->row();
    }

    public function save(){
        $post=$this->input->post();
        $this->noBatch = $post["noBatch"];
        $this->tanggalKedaluwarsa = $post["tanggalKedaluwarsa"];
        $this->jumlah= $post["jumlah"];
        $this->idProduk = $this->getProduk($post["idProduk"])->idProduk;
        $this->db->insert($this->_table,$this);
    }
    
    public function delete($id)
    {
        $this->db->delete($this->_table, array("idBatch" => $id));
    }

    public function makeZero($id)
    {
        $this->db->set('jumlah',0);
        $this->db->where('idBatch',$id);
        $this->db->update('Batch');
    }
}