<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Pengguna_model extends CI_Model
{
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
    public function cek($data){
        $this->db->select('username','password');
        $this->db->from('pengguna');
        $this->db->where(array(
            'username'=>$data['username'],
            'password'=>$data['password']
        ));
        $this->db->limit(1);
        $query=$this->db->get();
        if($query->num_row()==1){
            return true;
        }else{
            return false;
        }
    }
    public function get_login($data){
        $this->db->select('username'.'password');
        $this->db->from('pengguna');
        $this->db->where(array('username'=>$data['username']));
        $this->db->limit(1);
        $query=$this->db->get();
        if($query->num_row()==1){
            return true;
        }else{
            return false;
        }
    }

    function cek_login($table,$where){		
		return $this->db->get_where($table,$where);
	}	
}
?>