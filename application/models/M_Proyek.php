<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Proyek extends CI_Model {

  public function get_proyek($cond=""){
    $this->db->select("*");
    $this->db->from("v_proyek");
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
        }else if($key=="group_by"){
          $this->db->group_by($value);
        }else if($key=="order_by"){
          $this->db->order_by($value);
        }else if($key=="limit"){
          $this->db->limit($value);
        }
      }
    }
    //end of kondisi dinamis
    $isi = $this->db->get();
    //echo $this->db->last_query();
    if($isi){
      return array('status'=>'1','isi'=>$isi);
    }else{
      return array('status'=>'0', 'message'=>$this->db->error());
    }
  }

  public function insert($data){
    $query = $this->db->insert('proyek', $data);
    if($query){
      return array('status'=>'1','isi'=>$query);
    }else{
      return array('status'=>'0', 'message'=>$this->db->error());
    }
  }

  public function delete($data){
    $this->db->where($data);
    $query = $this->db->delete('proyek');
    if($query){
      return array('status'=>'1','isi'=>$query);
    }else{
      return array('status'=>'0', 'message'=>$this->db->error());
    }
  }

}
