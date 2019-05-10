<?php defined('BASEPATH') or exit('No direct script access allowed');

class Perusahaan_model extends CI_Model
{
    private $_table = "perusahaan";
    private $_tableView = "perusahaan_view";

    public function rules()
    {
        return [
            [
                'field' => 'namaPerusahaan',
                'label' => 'namaPerusahaan',
                'rules' => 'required'
            ],

            [
                'field' => 'alamatPerusahaan',
                'label' => 'alamatPerusahaan',
                'rules' => 'required'
            ],

            [
                'field' => 'noTelp',
                'label' => 'noTelp',
                'rules' => 'required'
            ]
        ];
    }

    public function getAll()
    {
        return $this->db->get($this->_tableView)->result();
    }

    public function getById($id)
    {
        return $this->db->get_where($this->_table, ["idPerusahaan" => $id])->row();
    }

    public function save()
    {
        $post = $this->input->post();
        $this->namaPerusahaan = $post["namaPerusahaan"];
        $this->alamatPerusahaan = $post["alamatPerusahaan"];
        $this->noTelp = $post["noTelp"];
        $this->db->insert($this->_table, $this);
    }

    public function update()
    {
        $post = $this->input->post();
        $this->idPerusahaan = $post["id"];
        $this->namaPerusahaan = $post["namaPerusahaan"];
        $this->alamatPerusahaan = $post["alamatPerusahaan"];
        $this->noTelp = $post["noTelp"];
        $this->db->update($this->_table, $this, array('idPerusahaan' => $post["id"]));
    }

    public function delete($id)
    {
        return $this->db->delete($this->_table, array("idPerusahaan" => $id));
    }
}
