<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Pesanan_model extends CI_Model
{
    private $_table = "pesanan";
    private $_tableView = "pesanan_view";
    private $_tablePP = "pesananproduk";
    private $_tablePPV = "pesananproduk_view";
    private $_tablePerusahaan = "perusahaan";
    private $_tableProduk = "produk";
    

    public function rules()
    {
        return [
                ['field' => 'idPesanan',
                'label' => 'idPesanan',
                'rules' => 'required'],

                ['field' => 'tanggalPesanan',
                'label' => 'tanggalPesanan',
                'rules' => 'required'],

                ['field' => 'namaPerusahaan',
                'label' => 'namaPerusahaan',
                'rules' => 'required']
            ];
    }

    public function rulesProduk()
    {
        return [

                ['field' => 'namaProduk',
                'label' => 'namaProduk',
                'rules' => 'required'],

                ['field' => 'jumlahBeli',
                'label' => 'jumlahBeli',
                'rules' => 'required']
            ];
    }


    public function getAll(){
        return $this->db->get($this->_tableView)->result();
    }

    public function getAllF(){
        return $this->db->get_where($this->_tableView, ["final" => 1])->result();
    }
    public function getAllNF(){
        return $this->db->get_where($this->_tableView, ["final" => 0])->result();
    }

    public function getById($id){
        return $this->db->get_where($this->_tableView, ["idPesanan" => $id])->row();
    }

    public function getPerusahaan($id){
        return $this->db->get_where($this->_tablePerusahaan, ["namaPerusahaan" => $id])->row();
    }

    public function getProduk($id){
        return $this->db->get_where($this->_tableProduk, ["namaProduk" => $id])->row();
    }
    
    public function getProdukById($id){
        return $this->db->get_where($this->_tablePPV, ["idPesanan" => $id])->result();
    }

    public function save(){
        $post = $this->input->post();
        $this->idPesanan = $post["idPesanan"];
        $this->tanggalPesanan = $post["tanggalPesanan"];
        $this->idPerusahaan = $this->getPerusahaan($post["namaPerusahaan"])->idPerusahaan;       
        $this->db->insert($this->_table,$this);
    }
    
    public function addProduk($id){
        $post = $this->input->post();
        $this->jumlahBeli =$post["jumlahBeli"];
        $this->idProduk = $this->getProduk($post["namaProduk"])->idProduk;
        $this->idPesanan = $id;
        $this->db->insert($this->_tablePP,$this);        
    }

    public function delete($id)
    {
        $this->db->delete($this->_table, array("idPesanan" => $id));
        $this->db->delete($this->_tablePP, array("idPesanan" => $id));
    }

    public function finalize($id)
    {
        $this->db->set('final',1);
        $this->db->where('idPesanan',$id);
        return $this->db->update($this->_table);
    }
}