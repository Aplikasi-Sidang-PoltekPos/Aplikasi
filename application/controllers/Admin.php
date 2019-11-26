<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Symfony\Component\HttpFoundation\Response;

class Admin extends CI_Controller {

	public $con_config;
	public function __construct(){
		parent::__construct();
		$this->load->model('M_Admin');
		$this->load->model('M_Mahasiswa');
		$this->load->model('M_Dosen');
		$this->load->model('M_Kegiatan');
		$this->load->model('M_Default');
		$con_config['navigation'] = "nav_admin";
		$this->load->helper('auth');
		if(CallLogin($this->session->userdata, "A")!=""){
			redirect(CallLogin($this->session->userdata));
		}
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
		$con_config['profile_name'] = $_SESSION['nama'];
		$con_config['profile_link'] = "";

		$this->con_config = $con_config;
	}

	public function index()
	{
		//$this->session->set_flashdata('notification', array('message'=>'Tes Alert', 'status'=>'success', 'title'=>'Apa ')); //Alert Ditengah
		//$this->session->set_flashdata('notification', array('message'=>'Tes Alert', 'status'=>'success', 'type'=>'top-end')); //Alert di kanan atas
		$data['nav_active'] = "dashboard";
		$data['nav_open'] = "";
		$data = array_merge($data, $this->con_config);
		$this->load->view('admin/admin_dash', $data);
	}

	public function Kegiatan($a="")
	{
		switch($a){
			case "":
				$data['nav_active'] = "kegiatan";
				$data['nav_open'] = "";
				$data['jscallurl'] = "admin/data_kegiatan.js";
				$data['semester_total'] = $this->M_Admin->get_prodi(array('id_prodi'=>$_SESSION['prodi']))->total_semester;
				$data['data_tahun_ajaran'] = $this->M_Mahasiswa->getAngkatan();
				$data = array_merge($data, $this->con_config);
				$this->load->view('admin/data_kegiatan', $data);
			break;
			case "Insert":
				$data = $this->input->post();
				$data['status_mulai'] = "0";
				$data['prodi']=$_SESSION['prodi'];
				$this->Tambah_Data($data, 'kegiatan');
			break;
			case "Data":
				$search[0]['type']="where";
				$search[0]['value']=array('prodi'=>$_SESSION['prodi']);
				echo $this->Tampil_Data('kegiatan', "", $search);
			break;
			case "DataKoor":
				$search[0]['type']="where";
				$search[0]['value']="nik not in ((select id_koordinator from kegiatan where status_mulai in('0','1')))";
				$search[1]['type']="where";
				$search[1]['value']=array('prodi'=>$_SESSION['prodi']);
				echo $this->Tampil_Data('dosen', '', $search);
			break;
			case "UpdateStatus":
				$data = $this->input->post();
				$isi['status_mulai']="1";
				echo $this->Ubah_Data($isi, $data, 'kegiatan');
			break;
			case "InsertObyek":
				$data = $this->input->post();
				$data['id_prodi'] = $_SESSION['prodi'];
				echo $this->Tambah_Data($data, 'obyekpenelitian');
			break;
			case "TampilObyek":
				$search=array('id_prodi'=>$_SESSION['prodi']);
				echo $this->Tampil_Data('obyekpenelitian', '', $search);
			break;
		}

	}

	public function Dosen($a="")
	{
		switch($a){
			case "":
				$data['nav_active'] = "dosen";
				$data['nav_open'] = "data_master";
				$data['jscallurl'] = "admin/data_dosen.js";
				$data = array_merge($data, $this->con_config);
				$this->load->view('admin/data_dosen', $data);
			break;
			case "Data":
				$search[0]['type']="where";
				$search[0]['value']=array('prodi'=>$_SESSION['prodi']);
				echo $this->Tampil_Data('dosen', "", $search);
			break;
			case "Insert":
				$data = $this->input->post();
				$data['prodi'] = $_SESSION['prodi'];
				echo $this->Tambah_Data($data, 'dosen');
			break;
		}
	}

	public function Tambah_Data($data, $table){
		switch($table){
			case "dosen":
				$notification['message']="Dosen berhasil ditambahkan";
			break;
			case "kegiatan" :
				$notification['message']="Kegiatan berhasil ditambahkan";
			break;
			case "obyekpenelitian":
				$table="obyek_penelitian";
				$notification['message']="Obyek Penelitian Berhasil Ditambahkan";
			break;
		}
		$query = $this->M_Default->insert($data, $table);
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

	public function Ubah_Data($data, $where, $table){
		$query = "";
		switch($table){
			//case "dosen": $query = $this->M_Dosen->insert_dosen($data); break;
			case "kegiatan" :
				$query = $this->M_Default->update($data, $where, 'kegiatan');
				$notification['message'] = "Kegiatan Berhasil Diubah";
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

	public function Mahasiswa($a=""){
		switch($a){
			case "":
				$data['nav_active'] = "mahasiswa";
				$data['nav_open'] = "data_master";
				$data['jscallurl'] = "admin/data_mahasiswa.js";
				$data = array_merge($data, $this->con_config);
				$this->load->view('admin/data_mahasiswa', $data);
			break;
			case "Data":
				$search[0]['type']="where";
				$search[0]['value']=array('prodi'=>$_SESSION['prodi']);
				echo $this->Tampil_Data('mahasiswa', "", $search);
			break;
			case "Download":
				$this->download_format_excel();
			break;
			case "Upload":
				$this->upload_data_excel($_FILES['file']);
			break;
		}
	}

	public function Tampil_Data($table, $data_extras="", $query_extras=""){
		$db_call = "";
		switch($table){
			case "mahasiswa": $db_call = $this->M_Mahasiswa->get_mahasiswa($query_extras); break;
			case "dosen": $db_call = $this->M_Dosen->get_dosen($query_extras); break;
			case "kegiatan": $db_call = $this->M_Kegiatan->get_kegiatan($query_extras); break;
			case "obyekpenelitian": $db_call = $this->M_Kegiatan->get_obyek_penelitian($query_extras); break;
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

	public function upload_data_excel($file){
		$notification = array();
		if(isset($file)){
			$file_tmp = $file['tmp_name'];
			$filename = $file['name'];
			if(substr($filename, -4)==".xls" || substr($filename, -5)==".xlsx"){
				$excelreader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader('Xlsx');
				$loadexcel = $excelreader->load($file_tmp); // Load file yang telah diupload ke folder excel
				$sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);

				// Buat sebuah variabel array untuk menampung array data yg akan kita insert ke database
				$data = array();
				$numrow = 0;
				$col = array();
				foreach($sheet as $row){
					if($numrow>0){
						$data_sub[$col['a']] = $row['A'];
						$data_sub[$col['b']] = $row['B'];
						$data_sub[$col['c']] = $row['C'];
						array_push($data, $data_sub);
					}else{
						$col['a'] = $row['A'];
						$col['b'] = $row['B'];
						$col['c'] = $row['C'];
					}
					$numrow++;
				}
				$total_masuk=0;
				$error_code="";
				foreach($data as $row){
					$isi[$col['a']] = $row[$col['a']];
					$isi[$col['b']] = $row[$col['b']];
					$isi[$col['c']] = $row[$col['c']];
					$isi['prodi'] = $_SESSION['prodi'];
					$query = $this->M_Default->insert($isi, 'mahasiswa');
					if($query['status']=='1'){
						$total_masuk++;
					}else if($query['message']['code']!='1062'){
						$error_code=$query['message']['code'];
						break;
					}
				}
				if($total_masuk>0){
					$notification['status'] = "success";
					$notification['message'] = "Data berhasil disinkron ke pusat data";
					$notification['title'] = "YEAY!";
				}else if($error_code!=""){
					$notification['status'] = "error";
					if($error_code=="1054"){
						$notification['message'] = "Kolom di excel berbeda dengan yang di database, apa kamu dah dikasihtau apa nama kolomnya?";
					}else{
						$notification['message'] = "Apakah yang terjadi? (".$error_code.")";
					}
					$notification['title'] = "Oops..";
				}else{
					$notification['status'] = "warning";
					$notification['message'] = "Data tidak ada yang masuk sama sekali ke database";
					$notification['title'] = "Aww..";
				}
			}else{
				$notification['status'] = "error";
				$notification['message'] = "File bukan termasuk excel, Coba lagi yang lain deh";
				$notification['title'] = "Aduh";
			}
		}else{
			$notification['status'] = "error";
			$notification['message'] = "File belum terupload, Silahkan coba lagi!";
			$notification['title'] = "Aduh";
		}
		echo json_encode($notification);
	}

	public function download_format_excel(){
		$streamedResponse = new StreamedResponse();
		$streamedResponse->setCallback(function(){
			$spreadsheet = new Spreadsheet();
			$sheet = $spreadsheet->getActiveSheet();
			$sheet->setCellValue('A1','npm');
			$sheet->setCellValue('B1','nama');
			$sheet->setCellValue('C1', 'angkatan');
			$writer = new Xlsx($spreadsheet);
			$writer->save('php://output');
		});

		$streamedResponse->setStatusCode(Response::HTTP_OK);
		$streamedResponse->headers->set('Content-Type', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		$streamedResponse->headers->set('Content-Disposition', 'attachment; filename="format_kolom.xlsx"');
		return $streamedResponse->send();
	}
}
