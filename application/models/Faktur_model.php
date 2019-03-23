<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Faktur_model extends CI_Model
{
    private $_table = "faktur";
    private $_tableView = "faktur_view";
    private $_tablePB = "ProdukBeli";

    public $noFaktur;
    public $tanggalCetak;
    public $tanggalJatuhTempo;
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

    public function rules1()
    {
        return [
                ['field' => 'noKontraBon',
                'label' => 'noKontraBon',
                'rules' => 'required']
            ];
    }

    public function getAll(){
        return $this->db->get($this->_tableView)->result();
    }

    public function getById($id){
        return $this->db->get_where($this->_table, ["noFaktur" => $id])->row();
    }

    public function getProdukById($id){
        $this->db->select('produkbeli_view.noFaktur,produk.namaProduk, produkbeli_view.noBatch, batch.exp, produkbeli_view.kuotaBeli, produkbeli_view.hargaSatuan, produkbeli_view.diskon, produkBeli_view.hargaBeli');
        $this->db->from('ProdukBeli_view');
        $this->db->join('Batch','produkbeli_view.noBatch = batch.noBatch');
        $this->db->join('Produk','batch.idProduk = produk.idProduk');
        $this->db->where('ProdukBeli_view.noFaktur',$id);
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
    
    public function update()
    {
        $post = $this->input->post();
        $this->noFaktur = $post["noFaktur"];
        $this->tanggalCetak = $post["tanggalCetak"];
        $this->tanggalJatuhTempo = $post["tanggalJatuhTempo"];
        $this->noKontraBon = $post["noKontraBon"];
        $this->idPerusahaan = $post["idPerusahaan"];
        $this->db->update($this->_table, $this, array('noFaktur' => $post["id"]));
    }

    public function masukKontrabon($id)
    {
        $this->db->set('noKontraBon', $noKontraBon);
        $this->db->where('noFaktur', $post["noFaktur"]);
        $this->db->update('faktur');
    }

    public function deleteBatch($id)
    {
        return $this->db->delete($this->_tablePB, array("noBatch" => $id));
    }


    public function delete($id)
    {
        return $this->db->delete($this->_table, array("noFaktur" => $id));
    }


}