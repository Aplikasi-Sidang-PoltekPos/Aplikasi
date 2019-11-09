<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class M_mahasiswa extends CI_Model{

    public function get_mahasiswa($cond=""){
    $this->db->select("*");
    $this->db->from("mahasiswa");
		//Dari sini mah bukan contoh, ini mah buat kondisi dinamis
		if($cond!=""){
			foreach($cond as $row){
				$key = $row['type'];
				$value = $row['value'];
				if($key=="where"){
					$this->db->where($value);
				}else if($key=="where_in"){
					$this->db->where_in($value['column'], $value['value']);
				}else if($key=="where_not_in"){
					$this->db->where_not_in($value['column'], $value['value']);
				}else if($key=="order_by"){
					$this->db->order_by($value);
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
			//echo $this->db->last_query();
			return array('status'=>'0', 'message'=>$this->db->error());
		}
	}

  	public function update($data){
		$this->db->where('npm', $data['npm']);
		$isi = $this->db->update('mahasiswa', $data);
    	if($isi){
			return array('status'=>'1');
		}else{
			return array('status'=>'0', 'message'=>$this->db->error());
		}
	}

  public function getAngkatan(){
    $this->db->distinct();
    $this->db->select("angkatan");
    $this->db->from('mahasiswa');
    $this->db->order_by('angkatan');
    return $this->db->get();
  }

}
