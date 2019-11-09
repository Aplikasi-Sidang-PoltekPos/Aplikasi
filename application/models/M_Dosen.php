<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Dosen extends CI_Model {

	public function get_dosen($cond="", $query_extras=""){
	$this->db->select("*");
	if($query_extras!=""){
		for($a=0;$a<sizeof($query_extras);$a++){
			$this->db->select($query_extras);
		}		
	}
    $this->db->from("dosen");
    //$this->db->where('npm', '1174040');
		//Dari sini mah bukan contoh, ini mah buat kondisi dinamis
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
				}else if($key=="group_by"){
					$this->db->group_by($value);
				}else if($key=="limit"){
					$this->db->limit($value);
				}
			}
		}
		//end of kondisi dinamis
    	$isi = $this->db->get();
		if($isi){
			return array('status'=>'1','isi'=>$isi);
		}else{
			return array('status'=>'0', 'message'=>$this->db->error());
		}
	}

	 public function update($data, $where){
		$this->db->where($where);
		$isi = $this->db->update('dosen', $data);
    	if($isi){
			return array('status'=>'1');
		}else{
			return array('status'=>'0', 'message'=>$this->db->error());
		}
	}
}
