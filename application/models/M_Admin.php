<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Admin extends CI_Model {

	public function get_admin($cond=""){
		$this->db->select("*");
		$this->db->from("admin");
		if($cond!=""){
			foreach($cond as $row){
				$key = $row['type'];
				$value = $row['value'];
				if($key=="where"){
					$this->db->where($value);
				}else if($key=="where_in"){
					for($a=0;$a<sizeof($value); $a++){
						$this->db->where_in($value[$a]['name'], $value[$a]['value']);
					}
				}else if($key=="where_not_in"){
					for($a=0;$a<sizeof($value); $a++){
						$this->db->where_not_in($value[$a]['name'], $value[$a]['value']);
					}
				}else if($key=="order_by"){
					$this->db->order_by($value);
				}else if($key=="limit"){
					$this->db->limit($value);
				}
			}
		}
		$isi = $this->db->get();
		if($isi){
		return array('status'=>'1','isi'=>$isi);
		}else{
		return array('status'=>'0', 'message'=>$this->db->error());
		}
	}

	public function get_prodi($where){
		return $this->db->get_where('prodi', $where)->row();
		
	}


}
