<?php defined('BASEPATH') OR exit('No direct script access allowed');

class KontraBon_model extends CI_Model
{
    private $_table = "kontraBon";
    private $_table1 = "kontrabon_view";

    public $noKontraBon;
    public $tanggalCetak;
    public $tanggalKembali;
    public $totalPembayaran;

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
        return $this->db->get($this->_table1)->result();
    }

    public function getById($id){
        return $this->db->get_where($this->_table, ["noKontraBon" => $id])->row();
    }


    public function getFakturById($id){
        $this->db->select('faktur.noFaktur,faktur.totalPembayaran,perusahaan.namaPerusahaan');
        $this->db->from('faktur');
        $this->db->join('perusahaan','perusahaan.idPerusahaan=faktur.idPerusahaan');
        $this->db->where('faktur.noKontraBon',$id);
        return $query = $this->db->get()->result();
    }

    public function getFakturByPerusahaan($id){
        $this->db->select('noFaktur');
        $this->db->from('faktur');
        $this->db->where('idPerusahaan',("SELECT idPerusahaan FROM KontraBon WHERE noKontraBon ='$id'"));
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
        $this->totalPembayaran = $post["totalPembayaran"];    
        $this->db->update($this->_table, $this, array('noKontraBon' => $post[$id]));
    }

    public function masukFaktur($id)
    {
        return $this->db->update($this->_table, array("idPerusahaan" => $id));
    }

    public function delete($id)
    {
        return $this->db->delete($this->_table, array("noKontraBon" => $id));
    }


}