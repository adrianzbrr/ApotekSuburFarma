<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Rak_model extends CI_Model
{
    private $_table = "rak";
    private $_tableView = "rak_view";
    private $_tablePV = "produk_view";


    public function rules()
    {
        return [
            [
                'field' => 'namaRak',
                'label' => 'namaRak',
                'rules' => 'required'
            ]
        ];
    }

    public function getAll(){
        return $this->db->get($this->_tableView)->result();
    }

    public function getProdukById($id)
    {
        return $this->db->get_where($this->_tablePV, ["idRak" => $id])->result();
    }

    public function getById($id)
    {
        return $this->db->get_where($this->_tableView, ["idRak" => $id])->row();
    }

    public function getByNama($id)
    {
        return $this->db->get_where($this->_tableView, ["namaRak" => $id])->num_rows();
    }

    public function save()
    {
        $post = $this->input->post();
        $this->namaRak = $post["namaRak"];
        $this->db->insert($this->_table, $this);
    }
    public function update()
    {
        $post = $this->input->post();
        $this->namaRak = $post["namaRak"];
        $this->db->update($this->_table, $this, array('idRak' => $post["id"]));
    }

    public function delete($id)
    {
        return $this->db->delete($this->_table, array("idRak" => $id));
    }
}