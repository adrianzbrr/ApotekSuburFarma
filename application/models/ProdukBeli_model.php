<?php defined('BASEPATH') OR exit('No direct script access allowed');

class ProdukBeli_model extends CI_Model
{
    private $_table = "ProdukBeli";

    public $noFaktur;
    public $noBatch;
    public $kuotaBeli;
    public $diskon;

    public function rules()
    {
        return [
            [
                'field' => 'noBatch',
                'label' => 'noBatch',
                'rules' => 'required']
            ];
    }

    public function getAll(){
        return $this->db->get($this->_table)->result();
    }

    public function save($id){
        $post = $this->input->post();
        $this->noFaktur = $id;
        $this->noBatch = $post["noBatch"];
        $this->kuotaBeli = $post["kuota"];
        $this->diskon= $post["diskon"];
        $this->hargaBeli = $post["hargaBeli"];      
        $this->db->insert($this->_table,$this);
    }

    public function delete($id)
    {
        return $this->db->delete($this->_table, array("noBatch" => $id));
    }


}