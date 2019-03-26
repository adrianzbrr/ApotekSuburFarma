<?php defined('BASEPATH') OR exit('No direct script access allowed');

class KontraBon_model extends CI_Model
{
    private $_table = "kontraBon";
    private $_tableView = "kontrabon_view";
    private $_tableFV = "faktur_view";

    public $noKontraBon;
    public $tanggalCetak;
    public $tanggalKembali;

    public function rules()
    {
        return [
                ['field' => 'noKontraBon',
                'label' => 'noKontraBon',
                'rules' => 'required'],
                
                ['field' => 'tanggalCetak',
                'label' => 'tanggalCetak',
                'rules' => 'required'],

                ['field' => 'tanggalKembali',
                'label' => 'tanggalKembali',
                'rules' => 'required'],

                ['field' => 'idPerusahaan',
                'label' => 'idPerusahaan',
                'rules' => 'required']
            ];
    }

    public function getAll(){
        return $this->db->get($this->_tableView)->result();
    }

    public function getKontraBon($id){
        return $this->db->get_where($this->_table, ["noKontraBon" => $id])->row();
    }
    
    public function getFakturById($id){
        $this->db->select('faktur_view.noFaktur,faktur_view.totalPembayaran,perusahaan.namaPerusahaan');
        $this->db->from('faktur_view');
        $this->db->join('perusahaan','perusahaan.idPerusahaan=faktur_view.idPerusahaan');
        $this->db->where('faktur_view.noKontraBon',$id);
        return $query = $this->db->get()->result();
    }

    public function getPerusahaan($id){
        return $this->db->get_where($this->_table, ["noKontraBon" => $id])->row();
    }

    public function getFakturByPerusahaan($id){
        $this->db->select('noFaktur');
        $this->db->from('faktur');
        $this->db->where('idKontraBon',NULL);
        $this->db->where('idPerusahaan',$id);
        return $query = $this->db->get()->result();
    }

    public function save(){
        $post = $this->input->post();
        $this->noKontraBon = $post["noKontraBon"];
        $this->tanggalCetak = $post["tanggalCetak"];
        $this->tanggalKembali = $post["tanggalKembali"];  
        $this->idPerusahaan = $post["idPerusahaan"];  
        $this->db->insert($this->_table,$this);
    }
    public function update($id)
    {
        $post = $this->input->post();
        $this->noKontraBon = $post["noKontraBon"];
        $this->tanggalCetak = $post["tanggalCetak"];
        $this->tanggalKembali = $post["tanggalKembali"];   
        $this->db->update($this->_table, $this, array('noKontraBon' => $post[$id]));
    }

    public function masukFaktur($id)
    {
        return $this->db->update($this->_table, array("idPerusahaan" => $id));
    }

    public function delete($id)
    {
        $this->db->where('idKontraBon',$id);
        return $this->db->delete($this->_table);
    }

}