<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Faktur_model extends CI_Model
{
    private $_table = "faktur";

    public $noFaktur;
    public $tanggalCetak;
    public $tanggalJatuhTempo;
    public $totalPembayaran;
    public $noKontraBon;
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

    public function getAll(){
        return $this->db->get($this->_table)->result();
    }

    public function getById($id){
        return $this->db->get_where($this->_table, ["noFaktur" => $id])->row();
    }

    public function getProdukById($id){
        $this->db->select('produkbeli.noFaktur,produk.namaProduk, produkbeli.noBatch, batch.exp, produkbeli.kuotaBeli, produkbeli.diskon, produkBeli.HargaBeli');
        $this->db->from('ProdukBeli');
        $this->db->join('Batch','produkbeli.noBatch = batch.noBatch');
        $this->db->join('Produk','batch.idProduk = produk.idProduk');
        $this->db->where('ProdukBeli.noFaktur',$id);
        return $query = $this->db->get()->result();
    }

    public function save(){
        $post = $this->input->post();
        $this->noFaktur = $post["noFaktur"];
        $this->tanggalCetak = $post["tanggalCetak"];
        $this->tanggalJatuhTempo = $post["tanggalJatuhTempo"];
        $this->idPerusahaan = $post["idPerusahaan"];        
        $this->db->insert($this->_table,$this);
    }
    
    public function update($id)
    {
        $post = $this->input->post();
        $this->noFaktur = $post["noFaktur"];
        $this->tanggalCetak = $post["tanggalCetak"];
        $this->tanggalJatuhTempo = $post["tanggalJatuhTempo"];
        $this->totalPembayaran = $post["totalPembayaran"];
        $this->noKontraBon = $post["noKontraBon"];
        $this->idPerusahaan = $post["idPerusahaan"];
        $this->db->update($this->_table, $this, array('noFaktur' => $post[$id]));
    }

    public function delete($id)
    {
        return $this->db->delete($this->_table, array("noFaktur" => $id));
    }


}