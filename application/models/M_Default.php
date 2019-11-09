<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Default extends CI_Model {
    public function insert($data, $table)
	{
        if($this->db->insert($table,$data)){
            return array('status'=>'1');
        }else{
            return array('status'=>'0', 'message'=>$this->db->error());
        }
    }
    
    public function update($data, $where, $table)
	{
		$this->db->where($where);
        if($this->db->update($table,$data)){
            return array('status'=>'1');
        }else{
            return array('status'=>'0', 'message'=>$this->db->error());
        }
	}
}
