<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Batch_model extends CI_Model
{
    private $_table = "batch";
    private $_tableView = "batch_view";
    private $_tableKadaluarsa = "kadaluarsa_view";

    public $noBatch;
    public $exp;
    public $kuota;
    public $idProduk;

    public function getAll(){
        return $this->db->get($this->_table)->result();
    }

    public function getById($id){
        return $this->db->get_where($this->_table, ["noBatch" => $id])->row();
    }

    public function getByProduk($id){
        return $this->db->get_where($this->_tableView, ["idProduk" => $id])->result();
    }

    public function getNumKadaluarsa($id){
        return $this->db->num_rows($this->_tableKadaluarsa)->result();
    }

    public function save(){
        $post = $this->input->post();
        $this->db->on_duplicate($this->_table,array('noBatch'=> $post["noBatch"], 'exp' => $post["exp"],'idProduk' => $post["idProduk"]));
    }

    public function update($id)
    {
        $post = $this->input->post();
        $this->noBatch = $post["namaProduk"];
        $this->expdate = $post["hargaProduk"];
        $this->kuota = $post["idJenis"];
        $this->idProduk = $post["idBentuk"];  
        $this->db->update($this->_table, $this, array('noBatch' => $post[$id]));
    }

    public function delete($id)
    {
        return $this->db->delete($this->_table, array("noBatch" => $id));
    }


}