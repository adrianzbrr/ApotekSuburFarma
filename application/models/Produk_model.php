<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Produk_model extends CI_Model
{
    private $_table = "produk";
    private $_table1 = "produk_view";

    public $idProduk;
    public $namaProduk;
    public $idJenis;
    public $idBentuk;
    public $idRak;

    public function rules()
    {
        return [
            [
                'field' => 'namaProduk',
                'label' => 'Nama Produk',
                'rules' => 'required'],
                
                // ['field' => 'hargaProduk',
                // 'label' => 'Harga Produk',
                // 'rules' => 'numeric'],
                
                ['field' => 'idJenis',
                'label' => 'Jenis Produk',
                'rules' => 'required'],

                ['field' => 'idBentuk',
                'label' => 'Bentuk Produk',
                'rules' => 'required'],

                ['field' => 'idRak',
                'label' => 'Rak',
                'rules' => 'required']
            ];
    }

    public function getAll(){
        return $this->db->get($this->_table1)->result();
    }

    public function getById($id){
        return $this->db->get_where($this->_table, ["idProduk" => $id])->row();
    }

    public function save(){
        $post = $this->input->post();
        $this->namaProduk = $post["namaProduk"];
        $this->idJenis = $post["idJenis"];
        $this->idBentuk = $post["idBentuk"];
        $this->idRak = $post["idRak"];        
        $this->db->insert($this->_table,$this);
    }
    public function update($id)
    {
        $post = $this->input->post();
        $this->namaProduk = $post["namaProduk"];     
        $this->idJenis = $post["idJenis"];
        $this->idBentuk = $post["idBentuk"];
        $this->idRak = $post["idRak"];
        $this->db->update($this->_table, $this, array('idProduk' => $post[$id]));
    }

    public function delete($id)
    {
        return $this->db->delete($this->_table, array("idProduk" => $id));
    }


}