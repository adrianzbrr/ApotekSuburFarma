<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Overview_model extends CI_Model
{
    private $_table = "totalTunggakan_view";

    public function getAll(){
        return $this->db->get($this->_table)->result();
    }
}