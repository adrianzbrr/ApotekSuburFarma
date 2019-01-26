<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Perusahaan_model extends CI_Model
{
    private $_table = "perusahaan";

    public $idPerusahaan;
    public $namaPerusahaan;
    public $alamatPerusahaan;
    public $noTelp;

    public function rules()
    {
        return [
                ['field' => 'namaPerusahaan',
                'label' => 'namaPerusahaan',
                'rules' => 'required'],
                
                ['field' => 'alamatPerusahaan',
                'label' => 'alamatPerusahaan',
                'rules' => 'required'],

                ['field' => 'noTelp',
                'label' => 'noTelp',
                'rules' => 'required']
            ];
    }

    public function getAll(){
        return $this->db->get($this->_table)->result();
    }

    public function getById($id){
        return $this->db->get_where($this->_table, ["idPerusahaan" => $id])->row();
    }

    public function save(){
        $post = $this->input->post();
        $this->namaPerusahaan = $post["namaPerusahaan"];
        $this->alamatPerusahaan = $post["alamatPerusahaan"];
        $this->noTelp = $post["noTelp"]; 
        $this->db->insert($this->_table,$this);
    }
    public function update($id)
    {
        $post = $this->input->post();
        $post = $this->input->post();
        $this->namaPerusahaan = $post["namaPerusahaan"];
        $this->alamatPerusahaan = $post["alamatPerusahaan"];
        $this->noTelp = $post["noTelp"]; 
        $this->db->update($this->_table, $this, array('idPerusahaan' => $post[$id]));
    }

    public function delete($id)
    {
        return $this->db->delete($this->_table, array("idPerusahaan" => $id));
    }


}