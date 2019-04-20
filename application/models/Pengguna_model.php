<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Pengguna_model extends CI_Model
{
    private $_table = "pengguna";
    private $_tableView = "pengguna_view";

    public function rules()
    {
        return [
                ['field' => 'username',
                'label' => 'Username',
                'rules' => 'required'],
                
                ['field' => 'password',
                'label' => 'Password',
                'rules' => 'required']
            ];
    }
    public function login($post){
        $this->db->from('pengguna');
        $this->db->where('username',$post['username']);
        $this->db->where('password',$post['password']);
        $query = $this->db->get();
        return $query;
    }

    public function getAll(){
        return $this->db->get($this->_tableView)->result();
    }

    public function getByNama($id){
        return $this->db->get_where($this->_table, ["username" => $id])->num_rows();
    }

    public function getById($id = null){
        return $this->db->get_where($this->_table, ["username" => $id])->row();
    }

    public function register(){
        $post = $this->input->post();
        $this->username = $post["username"];
        $this->password = $post["password"];
        $this->idJabatan = $post["idJabatan"];
        $this->namaPengguna = $post["namaPengguna"];
        $this->db->insert($this->_table, $this);
    }

    public function update(){
        $post = $this->input->post();
        $this->password = $post["password"];
        $this->idJabatan = $post["idJabatan"];
        $this->namaPengguna = $post["namaPengguna"];
        $this->db->update($this->_table, $this, ["username"=> $post["username"]]);
    }

    public function delete($id)
    {
        return $this->db->delete($this->_table, array("username" => $id));
    }

}
?>