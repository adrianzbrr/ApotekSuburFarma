<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Overview_model extends CI_Model
{
    private $_tableTunggak = "totalTunggakan_view";
    private $_tableKadaluarsa = "totalKadaluarsa_view";

    public function getAll(){
        return $this->db->get($this->_tableTunggak)->result();
    }

    public function getNumKadaluarsa(){
        return $this->db->get($this->_tableKadaluarsa)->result();
    }
}