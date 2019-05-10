<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Faktur_model extends CI_Model
{
    private $_table = "faktur";
    private $_tableView = "faktur_view";
    private $_tablePB = "ProdukBeli_view";
    private $_tablePerusahaan = "Perusahaan_view";
    private $_tableProduk = "produk_view";

    public function rules()
    {
        return [
                ['field' => 'noFaktur',
                'label' => 'Nomor Faktur',
                'rules' => 'required'],
                
                ['field' => 'tanggalCetak',
                'label' => 'tanggal tetak',
                'rules' => 'required'],

                ['field' => 'tanggalJatuhTempo',
                'label' => 'tanggal jatuh tempo',
                'rules' => 'required'],

                ['field' => 'idPerusahaan',
                'label' => 'Perusahaan',
                'rules' => 'required'],

                ['field' => 'idPesanan',
                'label' => 'Pesanan',
                'rules' => 'required']
            ];
    }

    public function rulesKontra(){
        return [
            ['field' => 'noFaktur',
            'label' => 'noFaktur',
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
        return $this->db->get_where($this->_tableView, ["idFaktur" => $id])->row();
    }

    public function getNumRow($no){
        return $this->db->get_where($this->_table, ["noFaktur" => $no])->num_rows();
    }

    public function getProduk($nama){
        return $this->db->get_where($this->_tableProduk, ["namaProduk" => $nama])->row();
    }
    
    public function getProdukById($id){
        return $this->db->get_where($this->_tablePB, ["idFaktur" => $id])->result();
    }

    public function save(){
        $post = $this->input->post();
        $this->noFaktur = $post["noFaktur"];
        $this->tanggalCetak = $post["tanggalCetak"];
        $this->tanggalJatuhTempo = $post["tanggalJatuhTempo"];
        $this->idPerusahaan = $post["idPerusahaan"];
        $this->idPesanan = $post["idPesanan"];       
        $this->db->insert($this->_table,$this);
    }
    
    public function update()
    {
        $post = $this->input->post();
        $this->noFaktur = $post["noFaktur"];
        $this->tanggalCetak = $post["tanggalCetak"];
        $this->tanggalJatuhTempo = $post["tanggalJatuhTempo"];
        $this->idPerusahaan = $post["idPerusahaan"];
        $this->db->update($this->_table, $this, array('noFaktur' => $post["id"]));
    }

    public function inputKontrabon($id)
    {
        $post = $this->input->post();
        $this->db->set('idKontraBon', $id);
        $this->db->where('noFaktur', $post["noFaktur"]);
        $this->db->update('faktur');
    }

    public function removeKontraBon($id)
    {
        $this->db->set('idKontraBon',NULL);
        $this->db->where('noFaktur',$id);
        $this->db->update('faktur');
    }

    public function removeAllKontraBon($id)
    {
        $this->db->set('idKontraBon',NULL);
        $this->db->where('idKontraBon',$id);
        $this->db->update('faktur');
    }

    public function delete($id)
    {
        $this->db->delete($this->_table, array("idFaktur" => $id));
    }

    public function finalize($id)
    {
        $this->db->set('final',1);
        $this->db->where('idFaktur',$id);
        $this->db->update($this->_table);
    }
}