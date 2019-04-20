<?php defined('BASEPATH') OR exit('No direct script access allowed');

class ProdukBeli_model extends CI_Model
{
    private $_table = "ProdukBeli";
    private $_tableBatch = "Batch";

    public $idFaktur;
    public $idBatch;
    public $jumlahBeli;
    public $diskon;

    public function rules()
    {
        return [
            [
                'field' => 'noBatch',
                'label' => 'noBatch',
                'rules' => 'required']
            ];
    }

    public function getAll(){
        return $this->db->get($this->_table)->result();
    }

    public function getBatch($id){
        $this->db->where("noBatch",$id);
        $this->db->order_by("idBatch",'DESC');
        return $this->db->get($this->_tableBatch)->row();
    }

    public function save($id){
        $post = $this->input->post();
        $this->idFaktur = $id;
        $this->idBatch = $this->getBatch($post["noBatch"])->idBatch;
        $this->jumlahBeli = $post["jumlah"];
        $this->diskon= $post["diskon"];
        $this->hargaBeli = $post["hargaBeli"];      
        $this->db->insert($this->_table,$this);
    }

    public function deleteFaktur($id)
    {
        return $this->db->delete($this->_table, array("idFaktur" => $id));
    }

    public function deleteBatch($id)
    {
        return $this->db->delete($this->_table,array("idBatch"=>$id));
    }
}