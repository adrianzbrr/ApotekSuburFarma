<?php defined('BASEPATH') or exit('No direct script access allowed');

class Angsuran_model extends CI_Model
{
    private $_table = "angsuran";
    private $_tableView = "angsuran_view";


    public function rules()
    {
        return [
            [
                'field' => 'jumlahAngsuran',
                'label' => 'Jumlah Angsuran',
                'rules' => 'required'
            ],

            [
                'field' => 'tanggalAngsuran',
                'label' => 'Tanggal Angsuran',
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
        return $this->db->get_where($this->_tableView, ["idAngsuran" => $id])->row();
    }

    public function getByKontraBon($no)
    {
        return $this->db->get_where($this->_tableView, ["idKontraBon" => $no])->result();
    }

    public function save()
    {
        $post = $this->input->post();
        $this->jumlahAngsuran = $post["jumlahAngsuran"];
        $this->tanggalAngsuran = $post["tanggalAngsuran"];
        $this->idKontraBon = $post["id"];
        $this->db->insert($this->_table, $this);
    }

    public function update()
    {
        $post = $this->input->post();
        $this->totalAngsuran = $post["namaProduk"];
        $this->tanggalAngsuran = $post["minimalStok"];
        $this->db->update($this->_table, $this, array('idAngsuran' => $post["id"]));
    }

    public function delete($id)
    {
        $this->db->delete($this->_table, array("idAngsuran" => $id));
    }
}
