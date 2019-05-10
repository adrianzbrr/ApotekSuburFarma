<?php defined('BASEPATH') OR exit('No direct script access allowed');

class KontraBon_model extends CI_Model
{
    private $_table = "kontraBon";
    private $_tableView = "kontrabon_view";
    private $_tableViewFinal = "kontrabonfinal_view";
    private $_tableFV = "faktur_view";

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

    public function getAllNF(){
        return $this->db->get_where($this->_tableView, ["final" => 0])->result();
    }

    public function getById($id){
        return $this->db->get_where($this->_tableView, ["idKontraBon" => $id])->row();
    }

    public function getFinalById($id){
        return $this->db->get_where($this->_tableViewFinal, ["idKontraBon" => $id])->row();
    }
    
    public function getNumRow($id){
        return $this->db->get_where($this->_table, ["noKontraBon" => $id])->num_rows();
    }
    
    public function getFakturById($id){
        return $this->db->get_where($this->_tableFV, ["idKontraBon"=>$id])->result();
    }

    public function getNumKontraBonExp(){
        return $this->db->get_where($this->_tableViewFinal, ["sisaHari <=" => 7,"sisa !=" =>0])->num_rows();
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
        $this->idPerusahaan = $post["idPerusahaan"]; 
        $this->db->insert($this->_table,$this);
    }
    public function update($id)
    {
        $post = $this->input->post();
        $this->noKontraBon = $post["noKontraBon"];
        $this->tanggalCetak = $post["tanggalCetak"];
        $this->tanggalKembali = $post["tanggalKembali"];  
        $this->idPerusahaan = $post["idPerusahaan"];  
        $this->db->update($this->_table, $this, array('noKontraBon' => $post[$id]));
    }


    public function delete($id)
    {
        $this->db->where('idKontraBon',$id);
        return $this->db->delete($this->_table);
    }

    public function finalize($id)
    {
        $this->db->set('final',1);
        $this->db->where('idKontraBon',$id);
        return $this->db->update($this->_table);
    }

}