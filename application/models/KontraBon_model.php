<?php defined('BASEPATH') OR exit('No direct script access allowed');

class KontraBon_model extends CI_Model
{
    private $_table = "kontraBon";

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
                'rules' => 'required']
            ];
    }

    public function getAll(){
        return $this->db->get($this->_table)->result();
    }

    public function getById($id){
        return $this->db->get_where($this->_table, ["noKontraBon" => $id])->row();
    }

    public function save(){
        $post = $this->input->post();
        $this->noKontraBon = $post["noKontraBon"];
        $this->tanggalCetak = $post["tanggalCetak"];
        $this->tanggalKembali = $post["tanggalKembali"];
        $this->totalPembayaran = $post["totalPembayaran"];     
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

    public function delete($id)
    {
        return $this->db->delete($this->_table, array("noKontraBon" => $id));
    }


}