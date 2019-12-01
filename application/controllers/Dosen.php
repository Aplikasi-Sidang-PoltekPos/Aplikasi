<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dosen extends CI_Controller {

	public $con_config;
	public function __construct(){
		parent::__construct();
		$this->load->model('M_Dosen');
		$this->load->model('M_Proyek');
		$this->load->model('M_Bimbingan');
		$this->load->model('M_Kegiatan');
		$this->load->model('M_Default');
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
		$con_config['status_user'] = 'D';
		
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
		if(isset($_SESSION['stat_koor'])){
			$data['stat_koor'] = $_SESSION['stat_koor'];
			
		}
		$data = array_merge($data, $this->con_config);
		$this->load->view('dosen/dosen_dash',$data);
		//$this->load->view('common/footer');
	}

	public function SettingProyek($a=""){
		switch($a){
			case "":
				$data['nav_active'] = "setting_proyek";
				$data['nav_open'] = "koordinator";
				$data['jscallurl']="dosen/koor_setting_proyek.js";
				
				$data = array_merge($data, $this->con_config);
				$this->load->view('koordinator/koor_setting_proyek',$data);
			break;
			case "Data":
				$search[0]['type']="where";
				$search[0]['value']=array('id_kegiatan'=>$_SESSION['stat_koor']['id_kegiatan']);
				$data['data_kegiatan'] = json_decode($this->Tampil_Data('kegiatan', '', $search));
				$data['data_progress'] = json_decode($this->Tampil_Data('kegiatan_progress', '', $search[0]['value']));
				echo json_encode($data);
			break;
			case "SendSetting":
				$data = $this->input->post();
				switch($data['condition']){
					case "insert":
						unset($data['condition']);
						$data['id_kegiatan'] = $_SESSION['stat_koor']['id_kegiatan'];
						echo $this->Tambah_Data($data, 'kegiatan_progress');
					break;
				}
			break;
			case "UpdateProyek":
				$data = $this->input->post();
				$data['id_kegiatan'] = $_SESSION['stat_koor']['id_kegiatan'];
				echo $this->Ubah_Data($data, array('id_kegiatan'=>$data['id_kegiatan']), 'kegiatan');
			break;
		}
	}

	public function Bimbingan($a="")
	{
		if(isset($_SESSION['id_proyek'])){
			$this->session->set_flashdata('id_proyek', $_SESSION['id_proyek']);
		}

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
				$search[0]['value']=array('id_dosen_pembimbing'=>$_SESSION['id_user']);
				$search[1]['type']="group_by";
				$search[1]['value']="judul_proyek";
				echo $this->Tampil_Data('proyek', '', $search);
			break;
			case "Detail":
				if(!isset($_SESSION['id_proyek'])){
					$this->session->set_flashdata('id_proyek', $this->input->post('id_proyek'));
				}else if(isset($_SESSION['id_proyek'])){
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
				$search[1]['type']="where";
				$search[1]['value']=array('status_bimbingan'=>$this->input->post('opsi_tampil'));
				$tampil_bimbingan = $this->M_Bimbingan->getTotalBimbingan($data);
				$result = json_decode($this->Tampil_Data('bimbingan', '', $search), true);
				echo json_encode($result);
			break;
			case "Detail:Approve":
				$data = $this->input->post();
				$data_progress = json_decode($data['checkId_group'], true);
				$progress_where[0] = "";
				$progress_where[1] = "";
				for($a=0;$a<sizeof($data_progress);$a++){
					if($data_progress[$a]['status']=="0"){
						$progress_where[0].=$data_progress[$a]['id'].',';
					}else{
						$progress_where[1].=$data_progress[$a]['id'].',';
					}
				}
				if($progress_where[0]!=""){
					$this->Ubah_Data(array('status_penyelesaian'=>'0'), 'id_bimbingan_progress in('.substr($progress_where[0], 0, strlen($progress_where[0])-1).')','progressbimbingan');
				}
				if($progress_where[1]!=""){
					$this->Ubah_Data(array('status_penyelesaian'=>'1'), 'id_bimbingan_progress in('.substr($progress_where[1], 0, strlen($progress_where[1])-1).')','progressbimbingan');
				}
				unset($data['checkId_group']);
				if($data['catatan']==""){
					$data['catatan']=="Tidak ada";
				}
				$where = array('id_bimbingan'=>$data['id_bimbingan']);
				echo $this->Ubah_Data($data, $where, 'bimbingan');
			break;
			
			case "Detail:Sidang":
				$total_bimbingan = $this->input->post('total_bimbingan');
				if($total_bimbingan>=8){
					$where = array('id_proyek'=>$_SESSION['id_proyek']);
					$data['status_proyek'] = "3"; //Awalnya 2
					$notif = json_decode($this->Ubah_Data($data, $where, 'proyek'), true);
					if($notif['status']=="success"){
						$notif['message'] = "Mahasiswa Berhasil Disiapkan untuk sidang";
						$notif['type']="normal";
						$this->session->set_flashdata('notification', $notif);
						redirect('Dosen/Bimbingan');
					}
				}
			break;
			case "Detail:ProgressBimbingan":
				$data = $this->input->post();
				echo $this->Tampil_Data('bimbingan_progress', '', 'id_bimbingan = "'.$data['id_bimbingan'].'"');
			break;
			case "Input:ProgressBimbingan":
				$data = $this->input->post();
				echo $this->Ubah_Data($data, array('id_bimbingan_progress'=>$data['id_bimbingan_progress']), 'progressbimbingan');
			break;
		}
	}

	public function Sidang($a=""){
		switch($a){
			case "":
				$data['nav_active'] = "nilai_sidang";
				$data['nav_open'] = "sidang";
				$data['jscallurl'] = "dosen/dosen_nilai_sidang.js";
				$data = array_merge($data, $this->con_config);
				$this->load->view('dosen/dosen_nilai_sidang', $data);
			break;
			case "Data":
				$data = $this->input->post();
				$where['status_proyek']="3";
				switch($data['option']){
					case "Penguji": $where['id_dosen_penguji'] = $_SESSION['id_user']; break;
					case "Pembimbing": $where['id_dosen_pembimbing'] = $_SESSION['id_user']; break;
				}
				$search[0]['type']="where";
				$search[0]['value']=$where;
				echo $this->Tampil_Data('proyek', '', $search);
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
			case "dosen": $db_call = $this->M_Dosen->get_dosen($where, $query_extras); break;
			case "bimbingan": $db_call = $this->M_Bimbingan->get_bimbingan($where); break;
			case "proyek": $db_call = $this->M_Proyek->get_proyek($where); break;
			case "kegiatan": $db_call = $this->M_Kegiatan->get_kegiatan($where); break;
			case "kegiatan_progress": $db_call = $this->M_Kegiatan->get_kegiatan_progress($where);
			default: $db_call = $this->M_Default->select_where($where, $table);
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
				$table = "proyek";
				$notification['message'] = "Proyek Berhasil Di Approve";
			break;
			case "bimbingan":
				$table = "bimbingan";
				$notification['message'] = "Bimbingan Berhasil Di Approve";
			break;
			case "profile":
				$table = "dosen";
				$notification['message'] = "Dosen Berhasil diubah";
			break;
			case "kegiatan":
				$table = "kegiatan";
				$notification['message'] = "Pengaturan berhasil Diperbaharui";
			break;
			case "progressbimbingan":
				$table = "bimbingan_progress";
				$notification['message'] = "success";
			break;
		}
		$query = $this->M_Default->update($data, $where, $table);
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

	public function Tambah_Data($data, $table){
		$query = "";
		switch($table){
			//case "dosen": $query = $this->M_Dosen->insert_dosen($data); break;
			case "kegiatan_progress" :
				$query = $this->M_Default->insert($data, 'kegiatan_progress');
				$notification['message'] = "Progress Kegiatan Berhasil Ditambah";
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
				$search[0]['value']=array('prodi'=>$_SESSION['prodi']);
				$search[1]['type']="where";
				$search[1]['value']=array('status_proyek'=>'1'); //Awalnya 0
				$search[2]['type']="where";
				$search[2]['value']=array('id_kegiatan'=>$_SESSION['stat_koor']['id_kegiatan']);
				//$search[3]['type']="group_by";
				//$search[3]['value']="proyek.judul_proyek";
				echo $this->Tampil_Data('proyek', "", $search);
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
				$this->load->view('admin/data_dosen', $data);
			break;
			case "PilihPembimbing:Data": //Semua di :Data awalnya 1
				$maks_anak = "(select count(*) from proyek where id_dosen_pembimbing = dosen.nik && status_proyek='2' && id_kegiatan = '".$_SESSION['stat_koor']['id_kegiatan']."') <= round((select count(*) from mahasiswa where prodi=dosen.prodi) / (select count(*) from dosen as a where a.prodi = dosen.prodi), 0)";
				$search[0]['type']="where";
				$search[0]['value']=array('prodi'=>$_SESSION['prodi']);
				$search[1]['type']="where";
				$search[1]['value']=$maks_anak;
				$query_extras[0] = "(select count(*) from proyek where id_dosen_pembimbing = dosen.nik && status_proyek='2' && id_kegiatan = '".$_SESSION['stat_koor']['id_kegiatan']."') as total_pembimbing";
				echo $this->Tampil_Data('dosen', "", $search, $query_extras);
			break;
			case "PilihPembimbing:Update":
				$data = $this->input->post();
				$data['status_proyek']="2"; //Awalnya 1
				$where = array('id_proyek'=>$data['id_proyek']);
				echo $this->Ubah_Data($data, $where, 'proyek');
			break;
		}
		//$this->load->view('common/footer');
	}

	public function Jadwal($a="")
	{
		switch($a){
			case "":
				$data['jscallurl']="dosen/koor_jadwal.js";
				$data['nav_active'] = "jadwal";
				$data['nav_open'] = "koordinator";
				$data = array_merge($data, $this->con_config);
				$this->load->view('koordinator/koor_jadwal',$data);
			break;
			case "Data":
				$search[0]['type']="where";
				$search[0]['value']=array('prodi'=>$_SESSION['prodi']);
				$search[1]['type']="where";
				$search[1]['value']=array('status_proyek'=>'3'); //Awalnya 2
				$search[2]['type']="where";
				$search[2]['value']=array('id_kegiatan'=>$_SESSION['stat_koor']['id_kegiatan']);
				echo $this->Tampil_Data('proyek', "", $search);
			break;
			case "DataPenguji":
				$id_dosen_pembimbing = $this->input->post('id_dosen_pembimbing');
				$search[0]['type']="where";
				$search[0]['value']="nik != '".$id_dosen_pembimbing."'";
				$search[1]['type']="where";
				$search[1]['value']=array('prodi'=>$_SESSION['prodi']);
				echo $this->Tampil_Data('dosen', '', $search);
			break;
			case "Jadwalkan":
				$data = $this->input->post();
				$where = array('id_proyek'=>$data['id_proyek']);
				echo $this->Ubah_Data($data, $where, 'proyek');
			break;
		}
		//$this->load->view('common/footer');
	}
}
