<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Faktur_model extends CI_Model
{
    private $_table = "faktur";
    private $_tableView = "faktur_view";
    private $_tablePB = "ProdukBeli";
    private $_tablePBView = "ProdukBeli_view";
    private $_tablePerusahaan = "Perusahaan";
    private $_tableProduk = "produk";
    private $_tableBatch = "batch";

    public $noFaktur;
    public $tanggalCetak;
    public $tanggalJatuhTempo;
    public $idPerusahaan;

    public function rules()
    {
        return [
                ['field' => 'noFaktur',
                'label' => 'noFaktur',
                'rules' => 'required'],
                
                ['field' => 'tanggalCetak',
                'label' => 'tanggalCetak',
                'rules' => 'required'],

                ['field' => 'tanggalJatuhTempo',
                'label' => 'tanggalJatuhTempo',
                'rules' => 'required'],

                ['field' => 'idPerusahaan',
                'label' => 'idPerusahaan',
                'rules' => 'required']
            ];
    }

    public function rules1(){
        return [
            ['field' => 'noFaktur',
            'label' => 'noFaktur',
            'rules' => 'required']
        ];

    }

    public function getAll(){
        return $this->db->get($this->_tableView)->result();
    }

    public function getFaktur($id){
        return $this->db->get_where($this->_table, ["noFaktur" => $id])->row();
    }

    public function getPerusahaan($id){
        return $this->db->get_where($this->_tablePerusahaan, ["namaPerusahaan" => $id])->row();
    }

    public function getProduk($id){
        return $this->db->get_where($this->_tableProduk, ["namaProduk" => $id])->row();
    }
    
    public function getProdukByNo($id){
        return $this->db->get_where($this->_tablePBView, ["noFaktur" => $id])->result();
    }

    public function save(){
        $post = $this->input->post();
        $this->noFaktur = $post["noFaktur"];
        $this->tanggalCetak = $post["tanggalCetak"];
        $this->tanggalJatuhTempo = $post["tanggalJatuhTempo"];
        $this->idPerusahaan = $this->getPerusahaan($post["idPerusahaan"])->idPerusahaan;       
        $this->db->insert($this->_table,$this);
    }
    
    public function update()
    {
        $post = $this->input->post();
        $this->noFaktur = $post["noFaktur"];
        $this->tanggalCetak = $post["tanggalCetak"];
        $this->tanggalJatuhTempo = $post["tanggalJatuhTempo"];
        $this->idPerusahaan = $this->getPerusahaan($post["idPerusahaan"])->idPerusahaan;
        $this->db->update($this->_table, $this, array('noFaktur' => $post["id"]));
    }

    public function masukKontrabon($id)
    {
        $post = $this->input->post();
        $this->db->set('idKontraBon', $id);
        $this->db->where('noFaktur', $post["noFaktur"]);
        $this->db->update('faktur');
    }

    public function deleteKontraBon($id)
    {
        $this->db->set('idKontraBon',NULL);
        $this->db->where('noFaktur',$id);
        $this->db->update('faktur');
    }

    public function deleteAllKontraBon($id)
    {
        $this->db->set('idKontraBon',NULL);
        $this->db->where('idKontraBon',$id);
        $this->db->update('faktur');
    }


    public function deleteBatch($idF,$idB)
    {
        $this->db->where('idBatch',$idB);
        return $this->db->delete($this->_tablePB);
    }

    public function delete($id)
    {
        return $this->db->delete($this->_table, array("noFaktur" => $id));
    }


}