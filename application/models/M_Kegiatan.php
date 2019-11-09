<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Kegiatan extends CI_Model {

	public function insert_kegiatan($data)
	{
    if($this->db->insert('kegiatan',$data)){
      return array('status'=>'1');
    }else{
      return array('status'=>'0', 'message'=>$this->db->error());
    }
	}

  public function get_kegiatan($cond=""){
    $this->db->select("*");
    $this->db->select("(select nama from dosen where nik=kegiatan.id_koordinator) as nama_koor");
    $this->db->from("kegiatan");
    $this->db->join("prodi", "kegiatan.prodi = prodi.id_prodi");
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
      return array('status'=>'0', 'message'=>$this->db->error());
    }
  }

  public function get_kegiatan_progress($where){
    $this->db->select('*');
    $this->db->from('kegiatan_progress');
    $this->db->where($where);
    $isi = $this->db->get();
    if($isi){
      return array('status'=>'1','isi'=>$isi);
    }else{
      return array('status'=>'0', 'message'=>$this->db->error());
    }
  }

	public function update_kegiatan($data, $where)
	{
		$this->db->where($where);
    if($this->db->update('kegiatan',$data)){
      return array('status'=>'1');
    }else{
      return array('status'=>'0', 'message'=>$this->db->error());
    }
	}
}
