<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dosen extends CI_Controller {

	public $con_config;
	public function __construct(){
		parent::__construct();
		$this->load->model('M_Dosen');
		$this->load->model('M_Proyek');
		$this->load->model('M_Bimbingan');
		$con_config['navigation'] = "nav_dosen";
		$this->load->helper('auth');
		if(CallLogin($this->session->userdata, "D")!=""){
			redirect(CallLogin($this->session->userdata));
		}

		if(!isset($_SESSION['stat_koor'])){
			$this->load->model('M_Kegiatan');
			$search[0]['type']="where";
			$search[0]['value']=array('id_koordinator'=>$_SESSION['id_user']);
			$data = $this->M_Kegiatan->get_kegiatan($search);
			$stat_koor = "";
			if($data['isi']->num_rows()>0){
				$stat_koor['status']="1";
				$stat_koor['id_kegiatan']=$data['isi']->row()->id_kegiatan;
			}else{
				$stat_koor['status']="0";
			}
			$this->session->set_userdata('stat_koor', $stat_koor);
		}
		
		if(isset($_SESSION['stat_koor'])){
			if($_SESSION['stat_koor']['status']=="1"){
				$con_config['navigation_2'] = "nav_koor";
			}
		}
		
		$con_config['profile_name'] = $_SESSION['nama'];
		$con_config['profile_link'] = base_url('Dosen/Profile');

		if(isset($_SESSION['notification'])){
			$con_config['notification'] = $_SESSION['notification'];
		}

		if($this->input->post('notification')!=null){
			$con_config['notification'] = $this->input->post('notification');
		}

		if(isset($con_config['notification'])){
			if(!isset($con_config['notification']['type'])){
				$con_config['notification']['type'] = "normal";
			}
			$con_config['notification'] = json_encode($con_config['notification']);
		}

		$this->con_config = $con_config;
	}

	public function index()
	{
		$data['nav_active'] = "dashboard";
		$data['nav_open'] = "";
		$data = array_merge($data, $this->con_config);
		$this->load->view('dosen/dosen_dash',$data);
		//$this->load->view('common/footer');
	}

	public function Bimbingan($a="")
	{
		switch($a){
			case "":
				$data['nav_active'] = "bimbingan";
				$data['nav_open'] = "menu";
				$data['jscallurl']="dosen/dosen_bimb.js";
				$data = array_merge($data, $this->con_config);
				$this->load->view('dosen/dosen_bimb',$data);
			break;
			case "Data":
				$search[0]['type']="where";
				$search[0]['value']=array('proyek.id_dosen_pembimbing'=>$_SESSION['id_user']);
				$search[1]['type']="group_by";
				$search[1]['value']="judul_proyek";
				echo $this->Tampil_Data('proyek', '', $search);
			break;
			case "Detail":
				if(!isset($_SESSION['id_proyek'])){
					$this->session->set_flashdata('id_proyek', $this->input->post('id_proyek'));
				}else{
					$this->session->set_flashdata('id_proyek', $_SESSION['id_proyek']);
				}
				$data['nav_active'] = "bimbingan";
				$data['nav_open'] = "menu";
				$data['jscallurl'] = "dosen/dosen_bimb_detail.js";
				$data = array_merge($data, $this->con_config);
				$this->load->view('dosen/dosen_bimb_detail',$data);
			break;
			case "Detail:Data":
				$data = $_SESSION['id_proyek'];
				$search[0]['type']="where";
				$search[0]['value']=array('id_proyek'=>$data);
				echo $this->Tampil_Data('bimbingan', '', $search);
			break;
			case "Detail:Approve":
				$data = $this->input->post();
				$data['status_bimbingan']="1";
				$where = array('id_bimbingan'=>$data['id_bimbingan']);
				$this->session->set_flashdata('id_proyek', $data['id_proyek']);
				echo $this->Ubah_Data($data, $where, 'bimbingan');
			break;
		}
	}

	public function nilai_pembimbing()
	{
		$data['nav_active'] = "nilai_pembimbing";
		$data['nav_open'] = "menu";
		$data = array_merge($data, $this->con_config);
		$this->load->view('dosen/nilai_pembimbing',$data);
		//$this->load->view('common/footer');
	}
	public function nilai_penguji()
	{

		$data['nav_active'] = "nilai_penguji";
		$data['nav_open'] = "menu";
		$data = array_merge($data, $this->con_config);
		$this->load->view('dosen/nilai_penguji',$data);
		//$this->load->view('common/footer');
	}

	public function detil_proyek(){
		
		$data['nav_active'] = "dashboard";
		$data['nav_open'] = "";
		$data = array_merge($data, $this->con_config);
		$this->load->view('dosen/detil_proyek',$data);
	}

	public function Profile($a="")
	{
		switch($a){
			case "":
				$data['nav_active'] = "";
				$data['nav_open'] = "";
				$data['jscallurl']="Dosen/dosen_profile.js";
				$search[0]['type']="where";
				$search[0]['value']=array('nik'=>$_SESSION['id_user']);
				$db_call = $this->M_Dosen->get_dosen($search);
				if($db_call['status']=='1'){
					$data['data_dosen'] = $db_call['isi'];
				}else{
					$data['error_message'] = json_encode($db_call['message']);
				}
				$data = array_merge($data, $this->con_config);
				$this->load->view('dosen/dosen_profile', $data);
			break;
			case "Update": 
				$data = $this->input->post();
				echo $this->Ubah_Data($data, array('nik'=>$_SESSION['id_user']), 'profile');
			break;
		}
	}

	public function Tampil_Data($table, $data_extras="", $where="", $query_extras=""){
		$db_call = "";
		switch($table){
			case "approval": $db_call = $this->M_Proyek->get_proyek($where); break;
			case "dosen": $db_call = $this->M_Dosen->get_dosen($where, $query_extras); break;
			case "bimbingan": $db_call = $this->M_Bimbingan->get_bimbingan($where); break;
			case "proyek": $db_call = $this->M_Proyek->get_proyek($where); break;
		}
		if($db_call['status']=='1'){
			$data['data'] = $db_call['isi']->result();
			if($data_extras!=""){
				$data['extras'] = $data_extras;
			}
		}else{
			$data['error_message'] = $db_call['message'];
		}
		return json_encode($data);
	}

	public function Hapus_Data($data, $table){
		$query = "";
		switch($table){
			case "proyek":
				$query = $this->M_Proyek->delete($data);
				$notification['message']="Proyek sudah ditolak";
			break;
		}

		if($query['status']=='1'){
			$notification['status'] = "success";
			if(!isset($notification['message'])){
				$notification['message'] = "Data berhasil disetor ke pusat data";
			}
			$notification['title'] = "YEAY!";
		}else{
			$notification['status'] = "error";
			$notification['message'] = "Terdapat error ".$query['message']['message']." (".$query['message']['code'].")";
			$notification['title'] = "Aww";
		}
		return json_encode($notification);
	}

	public function Ubah_Data($data, $where, $table){
		$query = "";
		switch($table){
			//case "dosen": $query = $this->M_Dosen->insert_dosen($data); break;
			case "proyek" :
				$query = $this->M_Proyek->update($data, $where);
				$notification['message'] = "Proyek Berhasil Di Approve";
			break;
			case "bimbingan":
				$query = $this->M_Bimbingan->update($data, $where);
				$notification['message'] = "Bimbingan Berhasil Di Approve";
			break;
			case "profile":
				$query = $this->M_Dosen->update($data, $where);
				$notification['message'] = "Dosen Berhasil diubah";
			break;
		}

		if($query['status']=='1'){
			$notification['status'] = "success";
			if(!isset($notification['message'])){
				$notification['message'] = "Data berhasil disetor ke pusat data";
			}
			$notification['title'] = "YEAY!";
		}else{
			$notification['status'] = "error";
			$notification['message'] = "Terdapat error ".$query['message']['message']." (".$query['message']['code'].")";
			$notification['title'] = "Aww";
		}
		echo json_encode($notification);
	}

	//Koordinator

	public function Approval($a="")
	{
		switch($a){
			case "":
				$data['jscallurl']="dosen/koor_app.js";
				$data['nav_active'] = "approval_proposal";
				$data['nav_open'] = "koordinator";
				$data = array_merge($data, $this->con_config);
				$this->load->view('koordinator/koor_app',$data);
			break;
			case "Data":
				$search[0]['type']="where";
				$search[0]['value']=array('kegiatan.prodi'=>$_SESSION['prodi']);
				$search[1]['type']="where";
				$search[1]['value']=array('proyek.status'=>'0');
				$search[2]['type']="where";
				$search[2]['value']=array('proyek.id_kegiatan'=>$_SESSION['stat_koor']['id_kegiatan']);
				//$search[3]['type']="group_by";
				//$search[3]['value']="proyek.judul_proyek";
				echo $this->Tampil_Data('approval', "", $search);
			break;
			case "Tolak":
				$data = $this->input->post();
				echo $this->Hapus_Data($data, 'proyek');
			break;
			case "PilihPembimbing":
				$data['nav_active'] = "approval_proposal";
				$data['nav_open'] = "koordinator";
				$data['jscallurl'] = "dosen/koor_app_pembimbing.js";
				$data = array_merge($data, $this->con_config);
				$this->session->set_flashdata('id_proyek', $this->input->post('id_proyek'));
				$this->session->set_flashdata('judul_proyek', $this->input->post('judul_proyek'));
				$this->load->view('admin/data_dosen', $data);
			break;
			case "PilihPembimbing:Data":
				$search[0]['type']="where";
				$search[0]['value']=array('prodi'=>$_SESSION['prodi']);
				$query_extras[0] = "(select count(*) from proyek where id_dosen_pembimbing = dosen.nik) as total_pembimbing";
				$query_extras[1] = "(select count(*) from mahasiswa where prodi=dosen.prodi) / (select count(*) from dosen as a where a.prodi = dosen.prodi) as maks_anak";
				echo $this->Tampil_Data('dosen', array('id_proyek'=>$_SESSION['id_proyek'], 'judul_proyek'=>$_SESSION['judul_proyek']), $search, $query_extras);
			break;
			case "PilihPembimbing:Update":
				$data = $this->input->post();
				$data['status']="1";
				$where = array('id_proyek'=>$data['id_proyek']);
				echo $this->Ubah_Data($data, $where, 'proyek');
			break;
			case "PilihPembimbing:Sukses":
				$data = $this->input->post();
				$this->session->set_flashdata('notification', json_decode($data['notification'], true));
				redirect($data['link']);
			break;
		}
		//$this->load->view('common/footer');
	}

	public function Jadwal()
	{
		$data['nav_active'] = "jadwal";
		$data['nav_open'] = "koordinator";
		$data = array_merge($data, $this->con_config);
		$this->load->view('koordinator/koor_jadwal',$data);
		//$this->load->view('common/footer');
	}
}
