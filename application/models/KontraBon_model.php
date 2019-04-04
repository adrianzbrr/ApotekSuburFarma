<?php defined('BASEPATH') OR exit('No direct script access allowed');

class KontraBon_model extends CI_Model
{
    private $_table = "kontraBon";
    private $_tableView = "kontrabon_view";
    private $_tableViewFinal = "kontrabonfinal_view";
    private $_tableFV = "faktur_view";
    private $_tablePerusahaan = "perusahaan";

    public $noKontraBon;
    public $tanggalCetak;
    public $tanggalKembali;
    public $idPerusahaan;

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

    public function getAllF(){
        return $this->db->get_where($this->_tableViewFinal, ["final" => 1])->result();
    }

    public function getAllFbyId($id){
        return $this->db->get_where($this->_tableViewFinal, ["noKontraBon" =>$id])->row();
    }

    public function getAllNF(){
        return $this->db->get_where($this->_tableView, ["final" => 0])->result();
    }

    public function getKontraBon($id){
        return $this->db->get_where($this->_table, ["noKontraBon" => $id])->row();
    }
    
    public function getFakturById($id){
        return $this->db->get_where($this->_tableFV, ["noKontraBon"=>$id])->result();
    }

    public function getPerusahaan($id){
        return $this->db->get_where($this->_tablePerusahaan, ["namaPerusahaan" => $id])->row();
    }

    public function getFakturByPerusahaan($id){
        $this->db->select('noFaktur');
        $this->db->from('faktur');
        $this->db->where('idKontraBon',NULL);
        $this->db->where('idPerusahaan',$id);
        $this->db->where('final',1);
        return $query = $this->db->get()->result();
    }

    public function save(){
        $post = $this->input->post();
        $this->noKontraBon = $post["noKontraBon"];
        $this->tanggalCetak = $post["tanggalCetak"];
        $this->tanggalKembali = $post["tanggalKembali"];  
        $this->idPerusahaan = $this->getPerusahaan($post["idPerusahaan"])->idPerusahaan;  
        $this->db->insert($this->_table,$this);
    }
    public function update($id)
    {
        $post = $this->input->post();
        $this->noKontraBon = $post["noKontraBon"];
        $this->tanggalCetak = $post["tanggalCetak"];
        $this->tanggalKembali = $post["tanggalKembali"];  
        $this->idPerusahaan = $this->getPerusahaan($post["idPerusahaan"])->idPerusahaan;  
        $this->db->update($this->_table, $this, array('noKontraBon' => $post[$id]));
    }

    public function paid($id)
    {
        $this->db->set('idStatus',1);
        $this->db->where('noKontraBon',$id);
        return $this->db->update($this->_table);
    }

    public function delete($id)
    {
        $this->db->where('idKontraBon',$id);
        return $this->db->delete($this->_table);
    }

    public function finalize($id)
    {
        $this->db->set('final',1);
        $this->db->where('noKontraBon',$id);
        return $this->db->update($this->_table);
    }

}