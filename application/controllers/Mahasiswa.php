<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mahasiswa extends CI_Controller {

	public $con_config;
	public function __construct(){
		parent::__construct();
		$this->load->model('M_Mahasiswa');
		$this->load->model('M_Kegiatan');
		$this->load->model('M_Proyek');
		$this->load->model('M_Bimbingan');
		$this->load->model('M_Default');
		$con_config['navigation'] = "nav_mhs";
		$this->load->helper('auth');
		if(CallLogin($this->session->userdata, "M")!=""){
			redirect(CallLogin($this->session->userdata));
		}
		
		if(isset($_SESSION['notification'])){
			$con_config['notification'] = $_SESSION['notification'];
			if(!isset($con_config['notification']['type'])){
				$con_config['notification']['type'] = "normal";
			}
			$con_config['notification'] = json_encode($con_config['notification']);
		}
		
		$con_config['profile_link'] = base_url('Mahasiswa/Profile');
		$con_config['profile_name'] = $_SESSION['nama'];
		$this->CekProyek();
		$this->con_config = $con_config;
	}

	public function index()
	{
		$data['nav_active'] = "dashboard";
		$data['nav_open'] = "";
		$data['jscallurl'] = "mahasiswa/mhs_dash.js";
		$data['status']="none";
		if($this->session->userdata('id_proyek')!=null){
			$search[0]['type']="where";
			$search[0]['value']=array('id_proyek'=>$_SESSION['id_proyek']);
			$search[1]['type']="where";
			$search[1]['value']=array('status_proyek'=>'0');
			$data_src = json_decode($this->Tampil_Data("detail","",$search), true);
			if($data_src['num_rows']>0){
				$res = $data_src['data'][0];
				if($res['npm_anggota']==$_SESSION['id_user']){
					$data['nama_ketua'] = $res['nama_ketua'];
					$data['npm_ketua'] = $res['npm_ketua'];
					$data['nama_kegiatan'] = $res['nama_kegiatan'];
					$data['judul_proyek'] = $res['judul_proyek'];
					$data['status'] = "anggota";
				}else{
					$data['status'] = "ketua";
					$data['npm_anggota']=$res['npm_anggota'];
				}
			}
		}
		$data = array_merge($data, $this->con_config);
		$this->load->view('mahasiswa/mhsw_dash',$data);
		//$this->load->view('common/footer');
	}

	public function CekProyek(){
		$search[0]['type']="where";
		$search[0]['value']="npm_ketua = '".$_SESSION['id_user']."' || npm_anggota = '".$_SESSION['id_user']."'";
		$search[1]['type']="where";
		$search[1]['value']="status_proyek != '4'";
		$data = json_decode($this->Tampil_Data('detail', "", $search), true);
		if($data['num_rows']>0){
			$data_sess = array(
				'id_proyek'=>$data['data'][0]['id_proyek'],
				'status_proyek'=>$data['data'][0]['status_proyek'],
				'id_kegiatan'=>$data['data'][0]['id_kegiatan']
			);
			$this->session->set_userdata($data_sess);
			if($data['data'][0]['npm_anggota']==$_SESSION['id_user']){
				$this->session->set_userdata('status_anggota','anggota');
			}else{
				$this->session->set_userdata('status_anggota','ketua');
			}
		}
	}

	public function CekProgress(){
		$progress = null;
		if(isset($_SESSION['status_proyek'])){
			$progress = $_SESSION['status_proyek'];
		}
		echo $progress;
	}

	public function Proyek($a="")
	{
		if(isset($_SESSION['status_anggota'])){
			$extras['status_anggota']=$_SESSION['status_anggota'];
		}else{
			$extras = "";
		}
		switch($a){
			case "":  
				$data['nav_active'] = "proyek";
				$data['nav_open'] = "kegiatan";
				$data['jscallurl'] = "mahasiswa/mhs_proyek.js";
				$data = array_merge($data, $this->con_config);
				$this->load->view('mahasiswa/mhs_proyek',$data);
			break;
			case "Data":  
				if(!isset($_SESSION['id_proyek'])){
					$data['col_config'] = "kegiatan";
				}else{
					$data['col_config'] = "detail";
				}
				$data = json_encode($data);
				echo $data;
			break;
			case "Content":
				$data = $this->input->post('content');
				switch($data){
					case "kegiatan": $data = "mhs_proyek_kegiatan"; break;
					case "detail": $data = "mhs_proyek_detail"; break;
				}
				$this->load->view('mahasiswa/content_template/'.$data);
			break;
			case "Data:Proyek":
				$search[0]['type']="where";
				$search[0]['value']="npm_ketua = '".$_SESSION['id_user']."' || npm_anggota = '".$_SESSION['id_user']."'";
				if($this->input->post('config')=="kegiatan"){
					$search[0]['type']="where";
					$search[0]['value'] = array('prodi'=>$_SESSION['prodi']);
					$search[1]['type']="where";
					$search[1]['value']=array('status_mulai'=>'1'); 
					$search[2]['type']="where";
					if($this->input->post('tampilngulang')=='true'){
						$search[2]['value']="semester <= '".$_SESSION['semester']."'";
					}else{
						$search[2]['value']="semester = '".$_SESSION['semester']."'";
					}
				}
				echo $this->Tampil_Data($this->input->post('config'), $extras,$search);
			break;
			case "Data:Anggota":
				$search[0]['type']="where";
				$search[0]['value']="npm not in ((select npm_ketua from proyek where npm_ketua is not null)) and npm not in ((select npm_anggota from proyek where npm_anggota is not null))";
				$search[1]['type']="where";
				$search[1]['value']="npm != '".$_SESSION['id_user']."'";
				$search[2]['type']="where";
				$search[2]['value']=array('prodi'=>$_SESSION['prodi']);
				echo $this->Tampil_Data('anggota', '', $search);
			break;
			case "AccProposal":
				$isi = $this->input->post();
				$data['id_proyek'] = $_SESSION['id_proyek'];
				if($isi['status_acc']=="cancel"){
					$data['npm_anggota'] = null;
					unset($_SESSION['id_proyek']);
					unset($_SESSION['status_proyek']);
					unset($_SESSION['status_anggota']);
				}else{
					$data['status_proyek']="1";
				}
				$where = array('id_proyek'=>$data['id_proyek']);
				echo $this->Ubah_Data($data, $where, 'proyek');
			break;
			case "AjukanAnggota":
				$data = $this->input->post();
				$data['id_proyek'] = $_SESSION['id_proyek'];
				$where = array('id_proyek'=>$data['id_proyek']);
				echo $this->Ubah_Data($data, $where, 'proyek');
			break;
			case "Insert":
				$data = $this->input->post();
				$data['npm_ketua'] = $_SESSION['id_user'];
				$data['status_proyek']="0";
				echo $this->Tambah_Data($data, 'detail');
			break;
		}
	}

	public function Tambah_Data($data, $table){
		$query = "";
		$notification = "";
		switch($table){
			case "detail":
				$query = $this->M_Default->insert($data, 'proyek');
				$notification['message']="Proyek berhasil ditambahkan";
			break;
			case "bimbingan":
				$query = $this->M_Default->insert($data, 'bimbingan');
				$notification['message']="Bimbingan berhasil ditambahkan";
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

	public function Tampil_Data($table, $data_extras="", $query_extras=""){
		$db_call = "";
		switch($table){
			case "kegiatan": $db_call = $this->M_Kegiatan->get_kegiatan($query_extras); break;
			case "detail": $db_call = $this->M_Proyek->get_proyek($query_extras); break;
			case "bimbingan": $db_call = $this->M_Bimbingan->get_bimbingan($query_extras); break;
			case "anggota": $db_call = $this->M_Mahasiswa->get_mahasiswa($query_extras); break;
			case "progress": $db_call = $this->M_Kegiatan->get_kegiatan_progress($query_extras);
		}

		if($db_call['status']=='1'){
			$data['data'] = $db_call['isi']->result();
			$data['num_rows'] = $db_call['isi']->num_rows();
			if($data_extras!=""){
				$data['extras'] = $data_extras;
			}
		}else{
			$data['error_message'] = $db_call['message'];
		}
		return json_encode($data);
	}

	public function Bimbingan($a="")
	{
		if($this->session->userdata('status_proyek')=="2"){ //Awalnya 1
			switch($a){
				case "": 
					$data['nav_active'] = "bimbingan";
					$data['nav_open'] = "kegiatan";
					$data['jscallurl']="mahasiswa/mhs_bimbingan.js";
					$data = array_merge($data, $this->con_config);
					$this->load->view('mahasiswa/mhs_bimb',$data);
				break;
				case "Data":
					$search[0]['type']="where";
					$search[0]['value']=array('id_proyek'=>$_SESSION['id_proyek']);
					echo $this->Tampil_Data('bimbingan', '', $search);
				break;
				case "Insert":
					$data = $this->input->post();
					$data['id_proyek'] = $_SESSION['id_proyek'];
					echo $this->Tambah_Data($data, 'bimbingan');
				break;
				case "GetProgress":
					$search = array('id_kegiatan'=>$_SESSION['id_kegiatan']);
					echo $this->Tampil_Data('progress','',$search);
				break;
			}
		}else{
			$data['nav_active'] = "bimbingan";
			$data['nav_open'] = "kegiatan";
			$data = array_merge($data, $this->con_config);
			$this->load->view('mahasiswa/content_template/mhs_bimb_error', $data);
		}
		//$this->load->view('common/footer');
	}

	public function Ubah_Data($data, $where, $table){
		$query = "";
		switch($table){
			//case "dosen": $query = $this->M_Dosen->insert_dosen($data); break;
			case "profile" :
				$query = $this->M_Default->update($data, 'mahasiswa');
				$notification['message'] = "Profile Berhasil Diupdate";
			break;
			case "proyek":
				$query = $this->M_Default->update($data, $where, 'proyek');
				$notification['message'] = "Berhasil mengubah data proyek";
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

	public function Profile($a="")
	{
		switch($a){
			case "":
				$search[0]['type']="where";
				$search[0]['value']=array('npm'=>$_SESSION['id_user']);
				$data['jscallurl']="mahasiswa/mhs_profile.js";
				$data['nav_open'] = "";
				$data['nav_active']="";
				$db_call = $this->M_Mahasiswa->get_mahasiswa($search);
				if($db_call['status']=='1'){
					$data['data_mahasiswa'] = $db_call['isi'];
				}else{
					$data['error_message'] = json_encode($db_call['message']);
				}
				$data = array_merge($data, $this->con_config);
				$this->load->view('mahasiswa/mhs_profile', $data);
			break;
			case "Update":
				$data = $this->input->post();
				if(isset($data['semester'])){
					$_SESSION['semester'] = $data['semester'];
				}
				echo $this->Ubah_Data($data, array('npm'=>$_SESSION['id_user']), 'profile');
			break;
		}
	}
}
