<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once(APPPATH . "third_party/Common/Autoloader.php");
include_once(APPPATH . "third_party/PhpWord/Autoloader.php");
include_once(APPPATH . "third_party/HTMLtoOpenXML/src/Parser.php");
include_once(APPPATH . "third_party/HTMLtoOpenXML/src/Scripts/HTMLCleaner.php");
include_once(APPPATH . "third_party/HTMLtoOpenXML/src/Scripts/ProcessProperties.php");
//include_once(APPPATH."core/Front_end.php");

use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Writer\Word2007;
use PhpOffice\PhpWord\Shared\Html;
use PhpOffice\Common\Autoloader as CAutoloader;
use PhpOffice\PhpWord\Autoloader;
use PhpOffice\PhpWord\Settings;
use PhpOffice\PhpWord\Shared\Converter;
use PhpOffice\PhpWord\Style\TablePosition;

Autoloader::register();
CAutoloader::register();
Settings::loadConfig();


class Analisis_beban_kerja extends CI_Controller {
	public $user_id;

	public function __construct(){
		parent ::__construct();
		$this->user_id = $this->session->userdata('user_id');
		$this->load->model('user_model');
		$this->load->model('simanja/analisis_jabatan_model', 'daftarAnalisisJabatan');
		//Ref
		$this->load->model('simanja/sender_model', 'sender');
		$this->load->model('simanja/ref_satuan_hasil_model', 'refSatuanHasil');
		//
		$this->load->model('ref_skpd_model');
		$this->load->model('ref_unit_kerja_model');
		$this->user_model->user_id = $this->user_id;
		$this->user_model->set_user_by_user_id();
		$this->user_picture = $this->user_model->user_picture;
		$this->full_name	= $this->user_model->full_name;
		$this->user_level	= $this->user_model->level;
		$this->user_privileges	= $this->user_model->user_privileges;
		$this->load->library(array('excel','session','pdf'));
		if ($this->user_level=="Admin Web");

		//$this->load->model('Ref_renstra','ref_kode_kegiatan_m');
	}
	
	public function index()
	{
		if ($this->user_id)
		{
			$data['title']		= "Analisis Jabatan - Sistem Informasi Anjab ABK dan Evaluasi Jabatan ";
			$data['content']	= "simanja/analisis_beban_kerja/index" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']	= $this->full_name;
			$data['user_level']	= $this->user_level;
			$data['active_menu'] = "simanja/analisis_beban_kerja";

			$where = null;
			if(isset($_GET)){
				$where = $_GET;
			}

			$data['skpd'] = $this->ref_skpd_model->get_all();
			$data['jabatan'] = $this->refJabatan->get_all_ref();
			$data['list'] = $this->daftarAnalisisJabatan->get_all_ref($where);

			//Counting
			$data['count_skpd'] = count($data['skpd']);
			$data['count_struktural'] = $this->daftarAnalisisJabatan->get_jabatan_by_jenis_count('Struktural', $where);
			$data['count_fungsional'] = $this->daftarAnalisisJabatan->get_jabatan_by_jenis_count('Fungsional', $where);
			$data['count_pelaksana'] = $this->daftarAnalisisJabatan->get_jabatan_by_jenis_count('Pelaksana', $where);
		
			if (isset($_FILES["fileExcel"]["name"])) {
				$path = $_FILES["fileExcel"]["tmp_name"];
				$object = PHPExcel_IOFactory::load($path);
				foreach($object->getWorksheetIterator() as $worksheet)
				{
					$highestRow = $worksheet->getHighestRow();
					$highestColumn = $worksheet->getHighestColumn();	
					for($row=2; $row<=$highestRow; $row++)
					{
						$nama = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
						$jenis_jabatan = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
						$id_skpd = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
						if($id_skpd != '(not set)'){
							$skpd = $this->ref_skpd_model->get_by_name($id_skpd);
							if($skpd){
								$id_skpd = $skpd->id_skpd;
							}else{
								$id_skpd = null;
							}
						}else{
							$id_skpd = null;
						}
						$temp_data[] = array(
							'nama'	=> $nama,
							'jenis_jabatan'	=> $jenis_jabatan,
							'id_skpd'	=> $id_skpd,
						); 	
					}
				}
				$insert = $this->daftarAnalisisJabatan->insert_excel($temp_data);
				if($insert){
					$this->session->set_flashdata('status', '<span class="glyphicon glyphicon-ok"></span> Data Berhasil di Import ke Database');
					redirect(base_url('simanja/analisis_beban_kerja'));
				}else{
					$this->session->set_flashdata('status', '<span class="glyphicon glyphicon-remove"></span> Terjadi Kesalahan');
					redirect(base_url('simanja/analisis_beban_kerja'));
				}
			}


			$this->load->view('admin/index',$data);
		}
		else
		{
			redirect('admin');
		}
	}

	public function detail($id)
	{
		if ($this->user_id && !empty($id))
		{
			$detail = $this->daftarAnalisisJabatan->get_by_id($id);
			$data['title']		= $detail->nama." - Sistem Informasi Anjab ABK dan Evaluasi Jabatan ";
			$data['content']	= "simanja/analisis_beban_kerja/detail" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']	= $this->full_name;
			$data['user_level']	= $this->user_level;
			$data['active_menu'] = "simanja/analisis_beban_kerja";
			$data['user_privileges'] = explode(';', $this->user_privileges);

			$data['skpd'] = $this->ref_skpd_model->get_all();
			$data['detail'] = $detail;

			$data['sender'] = $this->sender->cek_sender($id, true);

			//Ref
			$data['satuan_hasil'] = $this->refSatuanHasil->get_all_ref();

			//Parameter Penilaian
			$params['tugas_pokok'] = $this->daftarAnalisisJabatan->get_all_tugas_pokok($id);
			$params['hasil_kerja'] = $this->daftarAnalisisJabatan->get_all_hasil_kerja($id);

			$nilai = 0;
			$jumlah = 0;
			foreach($params as $i){
				$jumlah += 1;
				if(!empty($i)){
					$nilai += 1;
				}
			}

			$data['params'] = $params;
			$data['nilai'] = $nilai / $jumlah * 100;

			$data = array_merge($data,$params);

			$this->load->view('admin/index',$data);
		}
		else
		{
			redirect('admin');
		}
	}

	public function fetch_unit_kerja($id){
		$unit_kerja = $this->ref_unit_kerja_model->get_by_skpd($id, 1);
		echo json_encode($unit_kerja);
	}

	public function fetch_unit_kerja_induk($id){
		$unit_kerja = $this->ref_unit_kerja_model->get_induk($id);
		echo json_encode($unit_kerja);
	}

	public function fetch_ref($id){
		$misi = $this->daftarAnalisisJabatan->select_by_id_ref($id);
		echo json_encode($misi);
	}

	public function p_update_ref(){
		$id_ref = $_POST['id_ref'];
		unset($_POST['id_ref']);
		unset($_POST['_wysihtml5_mode']);
		$this->daftarAnalisisJabatan->update_ref($_POST,$id_ref);
		echo json_encode(array('status'=>true));
	}

	public function p_add_ref()
	{
		unset($_POST['_wysihtml5_mode']);
		$this->daftarAnalisisJabatan->insert_ref($_POST);
		echo json_encode(array('status'=>true));
	}

	public function delete_ref($id){
		if ($this->session->userdata('level') == 'Administrator') {
		$this->daftarAnalisisJabatan->delete_ref($id);
		echo json_encode(array('status'=>true));
		}
	}

	//Kualifikasi Jabatan
	public function fetch_kualifikasi_jabatan($id){
		$misi = $this->daftarAnalisisJabatan->select_by_id_kualifikasi_jabatan_anjab($id);
		echo json_encode($misi);
	}

	public function p_update_kualifikasi_jabatan(){
		$id_kualifikasi_jabatan = $_POST['id_kualifikasi_jabatan'];
		unset($_POST['id_kualifikasi_jabatan']);
		unset($_POST['_wysihtml5_mode']);
		$_POST['updator'] = $this->user_id;
		$this->daftarAnalisisJabatan->update_kualifikasi_jabatan($_POST,$id_kualifikasi_jabatan);
		echo json_encode(array('status'=>true));
	}

	public function p_add_kualifikasi_jabatan()
	{
		unset($_POST['_wysihtml5_mode']);
		$_POST['creator'] = $this->user_id;
		$_POST['created_at'] = date('Y-m-d H:i:s');
		$this->daftarAnalisisJabatan->insert_kualifikasi_jabatan($_POST);
		echo json_encode(array('status'=>true));
	}
	
	public function delete_kualifikasi_jabatan($id){
		if ($this->session->userdata('level') == 'Administrator') {
		$this->daftarAnalisisJabatan->delete_kualifikasi_jabatan($id);
		echo json_encode(array('status'=>true));
		}
	}

	//Tugas Pokok
	public function fetch_tugas_pokok($id){
		$misi = $this->daftarAnalisisJabatan->select_by_id_tugas_pokok($id);
		echo json_encode($misi);
	}

	public function p_update_tugas_pokok(){
		$id_tugas_pokok = $_POST['id_tugas_pokok'];
		unset($_POST['id_tugas_pokok']);
		unset($_POST['_wysihtml5_mode']);
		$_POST['updator'] = $this->user_id;
		$this->daftarAnalisisJabatan->update_tugas_pokok($_POST,$id_tugas_pokok);
		echo json_encode(array('status'=>true));
	}

	public function p_add_tugas_pokok()
	{
		unset($_POST['_wysihtml5_mode']);
		$_POST['creator'] = $this->user_id;
		$_POST['created_at'] = date('Y-m-d H:i:s');
		$this->daftarAnalisisJabatan->insert_tugas_pokok($_POST);
		echo json_encode(array('status'=>true));
	}
	
	public function delete_tugas_pokok($id){
		if ($this->session->userdata('level') == 'Administrator') {
		$this->daftarAnalisisJabatan->delete_tugas_pokok($id);
		echo json_encode(array('status'=>true));
		}
	}

	//Hasil Kerja
	public function fetch_hasil_kerja($id){
		$misi = $this->daftarAnalisisJabatan->select_by_id_hasil_kerja($id);
		echo json_encode($misi);
	}

	public function p_update_hasil_kerja(){
		$id_hasil_kerja = $_POST['id_hasil_kerja'];
		unset($_POST['id_hasil_kerja']);
		unset($_POST['_wysihtml5_mode']);
		$_POST['updator'] = $this->user_id;
		$this->daftarAnalisisJabatan->update_hasil_kerja($_POST,$id_hasil_kerja);
		echo json_encode(array('status'=>true));
	}

	public function p_add_hasil_kerja()
	{
		unset($_POST['_wysihtml5_mode']);
		$_POST['creator'] = $this->user_id;
		$_POST['created_at'] = date('Y-m-d H:i:s');
		$this->daftarAnalisisJabatan->insert_hasil_kerja($_POST);
		echo json_encode(array('status'=>true));
	}
	
	public function delete_hasil_kerja($id){
		if ($this->session->userdata('level') == 'Administrator') {
		$this->daftarAnalisisJabatan->delete_hasil_kerja($id);
		echo json_encode(array('status'=>true));
		}
	}

	//Bahan Kerja
	public function fetch_bahan_kerja($id){
		$misi = $this->daftarAnalisisJabatan->select_by_id_bahan_kerja($id);
		echo json_encode($misi);
	}

	public function p_update_bahan_kerja(){
		$id_bahan_kerja = $_POST['id_bahan_kerja'];
		unset($_POST['id_bahan_kerja']);
		unset($_POST['_wysihtml5_mode']);
		$_POST['updator'] = $this->user_id;
		$this->daftarAnalisisJabatan->update_bahan_kerja($_POST,$id_bahan_kerja);
		echo json_encode(array('status'=>true));
	}

	public function p_add_bahan_kerja()
	{
		unset($_POST['_wysihtml5_mode']);
		$_POST['creator'] = $this->user_id;
		$_POST['created_at'] = date('Y-m-d H:i:s');
		$this->daftarAnalisisJabatan->insert_bahan_kerja($_POST);
		echo json_encode(array('status'=>true));
	}
	
	public function delete_bahan_kerja($id){
		if ($this->session->userdata('level') == 'Administrator') {
		$this->daftarAnalisisJabatan->delete_bahan_kerja($id);
		echo json_encode(array('status'=>true));
		}
	}

	//Perangkat Kerja
	public function fetch_perangkat_kerja($id){
		$misi = $this->daftarAnalisisJabatan->select_by_id_perangkat_kerja($id);
		echo json_encode($misi);
	}

	public function p_update_perangkat_kerja(){
		$id_perangkat_kerja = $_POST['id_perangkat_kerja'];
		unset($_POST['id_perangkat_kerja']);
		unset($_POST['_wysihtml5_mode']);
		$_POST['updator'] = $this->user_id;
		$this->daftarAnalisisJabatan->update_perangkat_kerja($_POST,$id_perangkat_kerja);
		echo json_encode(array('status'=>true));
	}

	public function p_add_perangkat_kerja()
	{
		unset($_POST['_wysihtml5_mode']);
		$_POST['creator'] = $this->user_id;
		$_POST['created_at'] = date('Y-m-d H:i:s');
		$this->daftarAnalisisJabatan->insert_perangkat_kerja($_POST);
		echo json_encode(array('status'=>true));
	}
	
	public function delete_perangkat_kerja($id){
		if ($this->session->userdata('level') == 'Administrator') {
		$this->daftarAnalisisJabatan->delete_perangkat_kerja($id);
		echo json_encode(array('status'=>true));
		}
	}

	//Tanggung Jawab
	public function fetch_tanggung_jawab($id){
		$misi = $this->daftarAnalisisJabatan->select_by_id_tanggung_jawab($id);
		echo json_encode($misi);
	}

	public function p_update_tanggung_jawab(){
		$id_tanggung_jawab = $_POST['id_tanggung_jawab'];
		unset($_POST['id_tanggung_jawab']);
		unset($_POST['_wysihtml5_mode']);
		$_POST['updator'] = $this->user_id;
		$this->daftarAnalisisJabatan->update_tanggung_jawab($_POST,$id_tanggung_jawab);
		echo json_encode(array('status'=>true));
	}

	public function p_add_tanggung_jawab()
	{
		unset($_POST['_wysihtml5_mode']);
		$_POST['creator'] = $this->user_id;
		$_POST['created_at'] = date('Y-m-d H:i:s');
		$this->daftarAnalisisJabatan->insert_tanggung_jawab($_POST);
		echo json_encode(array('status'=>true));
	}
	
	public function delete_tanggung_jawab($id){
		if ($this->session->userdata('level') == 'Administrator') {
		$this->daftarAnalisisJabatan->delete_tanggung_jawab($id);
		echo json_encode(array('status'=>true));
		}
	}

	//Wewenang
	public function fetch_wewenang($id){
		$misi = $this->daftarAnalisisJabatan->select_by_id_wewenang($id);
		echo json_encode($misi);
	}

	public function p_update_wewenang(){
		$id_wewenang = $_POST['id_wewenang'];
		unset($_POST['id_wewenang']);
		unset($_POST['_wysihtml5_mode']);
		$_POST['updator'] = $this->user_id;
		$this->daftarAnalisisJabatan->update_wewenang($_POST,$id_wewenang);
		echo json_encode(array('status'=>true));
	}

	public function p_add_wewenang()
	{
		unset($_POST['_wysihtml5_mode']);
		$_POST['creator'] = $this->user_id;
		$_POST['created_at'] = date('Y-m-d H:i:s');
		$this->daftarAnalisisJabatan->insert_wewenang($_POST);
		echo json_encode(array('status'=>true));
	}
	
	public function delete_wewenang($id){
		if ($this->session->userdata('level') == 'Administrator') {
		$this->daftarAnalisisJabatan->delete_wewenang($id);
		echo json_encode(array('status'=>true));
		}
	}

	//Korelasi Jabatan
	public function fetch_korelasi_jabatan($id){
		$misi = $this->daftarAnalisisJabatan->select_by_id_korelasi_jabatan($id);
		echo json_encode($misi);
	}

	public function p_update_korelasi_jabatan(){
		$id_korelasi_jabatan = $_POST['id_korelasi_jabatan'];
		unset($_POST['id_korelasi_jabatan']);
		unset($_POST['_wysihtml5_mode']);
		$_POST['updator'] = $this->user_id;
		$this->daftarAnalisisJabatan->update_korelasi_jabatan($_POST,$id_korelasi_jabatan);
		echo json_encode(array('status'=>true));
	}

	public function p_add_korelasi_jabatan()
	{
		unset($_POST['_wysihtml5_mode']);
		$_POST['creator'] = $this->user_id;
		$_POST['created_at'] = date('Y-m-d H:i:s');
		$this->daftarAnalisisJabatan->insert_korelasi_jabatan($_POST);
		echo json_encode(array('status'=>true));
	}
	
	public function delete_korelasi_jabatan($id){
		if ($this->session->userdata('level') == 'Administrator') {
		$this->daftarAnalisisJabatan->delete_korelasi_jabatan($id);
		echo json_encode(array('status'=>true));
		}
	}

	//Kondisi Lingkungan Kerja
	public function fetch_kondisi_lingkungan_kerja($id){
		$misi = $this->daftarAnalisisJabatan->select_by_id_kondisi_lingkungan_kerja_anjab($id);
		echo json_encode($misi);
	}

	public function p_update_kondisi_lingkungan_kerja(){
		$id_kondisi_lingkungan_kerja = $_POST['id_kondisi_lingkungan_kerja'];
		unset($_POST['id_kondisi_lingkungan_kerja']);
		unset($_POST['_wysihtml5_mode']);
		$_POST['updator'] = $this->user_id;
		$this->daftarAnalisisJabatan->update_kondisi_lingkungan_kerja($_POST,$id_kondisi_lingkungan_kerja);
		echo json_encode(array('status'=>true));
	}

	public function p_add_kondisi_lingkungan_kerja()
	{
		unset($_POST['_wysihtml5_mode']);
		$_POST['creator'] = $this->user_id;
		$_POST['created_at'] = date('Y-m-d H:i:s');
		$this->daftarAnalisisJabatan->insert_kondisi_lingkungan_kerja($_POST);
		echo json_encode(array('status'=>true));
	}
	
	public function delete_kondisi_lingkungan_kerja($id){
		if ($this->session->userdata('level') == 'Administrator') {
		$this->daftarAnalisisJabatan->delete_kondisi_lingkungan_kerja($id);
		echo json_encode(array('status'=>true));
		}
	}

	//Risiko Bahaya
	public function fetch_risiko_bahaya($id){
		$misi = $this->daftarAnalisisJabatan->select_by_id_risiko_bahaya($id);
		echo json_encode($misi);
	}

	public function p_update_risiko_bahaya(){
		$id_risiko_bahaya = $_POST['id_risiko_bahaya'];
		unset($_POST['id_risiko_bahaya']);
		unset($_POST['_wysihtml5_mode']);
		$_POST['updator'] = $this->user_id;
		$this->daftarAnalisisJabatan->update_risiko_bahaya($_POST,$id_risiko_bahaya);
		echo json_encode(array('status'=>true));
	}

	public function p_add_risiko_bahaya()
	{
		unset($_POST['_wysihtml5_mode']);
		$_POST['creator'] = $this->user_id;
		$_POST['created_at'] = date('Y-m-d H:i:s');
		$this->daftarAnalisisJabatan->insert_risiko_bahaya($_POST);
		echo json_encode(array('status'=>true));
	}
	
	public function delete_risiko_bahaya($id){
		if ($this->session->userdata('level') == 'Administrator') {
		$this->daftarAnalisisJabatan->delete_risiko_bahaya($id);
		echo json_encode(array('status'=>true));
		}
	}

	//Syarat
	//Keterampilan Kerja
	public function fetch_syarat_keterampilan_kerja($id){
		$data = $this->daftarAnalisisJabatan->get_all_syarat_keterampilan_kerja($id);
		echo json_encode($data);
	}

	public function p_add_syarat_keterampilan_kerja()
	{
		unset($_POST['_wysihtml5_mode']);
		$arr_listed = isset($_POST['listed']) ? $_POST['listed'] : null;
		$id_analisis_beban_kerja = $_POST['id_analisis_beban_kerja'];
		$this->daftarAnalisisJabatan->truncate_syarat_keterampilan_kerja_batch($id_analisis_beban_kerja);
		if($arr_listed){
			foreach($arr_listed as $i){
				$temp_data[] = array(
					'id_analisis_beban_kerja' => $id_analisis_beban_kerja,
					'id_keterampilan_kerja'	=> $i,
					'creator' => $this->user_id,
					'created_at' => date('Y-m-d H:i:s')
				); 	
			}
			$this->daftarAnalisisJabatan->insert_syarat_keterampilan_kerja_batch($temp_data);
		}
		echo json_encode(array('status'=>true));
	}
	
	public function delete_syarat_keterampilan_kerja($id){
		if ($this->session->userdata('level') == 'Administrator') {
		$this->daftarAnalisisJabatan->delete_syarat_keterampilan_kerja($id);
		echo json_encode(array('status'=>true));
		}
	}

	//Bakat Kerja
	public function fetch_syarat_bakat_kerja($id){
		$data = $this->daftarAnalisisJabatan->get_all_syarat_bakat_kerja($id);
		echo json_encode($data);
	}

	public function p_add_syarat_bakat_kerja()
	{
		unset($_POST['_wysihtml5_mode']);
		$arr_listed = isset($_POST['listed']) ? $_POST['listed'] : null;
		$id_analisis_beban_kerja = $_POST['id_analisis_beban_kerja'];
		$this->daftarAnalisisJabatan->truncate_syarat_bakat_kerja_batch($id_analisis_beban_kerja);
		if($arr_listed){
			foreach($arr_listed as $i){
				$temp_data[] = array(
					'id_analisis_beban_kerja' => $id_analisis_beban_kerja,
					'id_keterampilan_kerja'	=> $i,
					'creator' => $this->user_id,
					'created_at' => date('Y-m-d H:i:s')
				); 	
			}
			$this->daftarAnalisisJabatan->insert_syarat_bakat_kerja_batch($temp_data);
		}
		echo json_encode(array('status'=>true));
	}
	
	public function delete_syarat_bakat_kerja($id){
		if ($this->session->userdata('level') == 'Administrator') {
		$this->daftarAnalisisJabatan->delete_syarat_bakat_kerja($id);
		echo json_encode(array('status'=>true));
		}
	}

	//Temperamen Kerja
	public function fetch_syarat_temperamen_kerja($id){
		$data = $this->daftarAnalisisJabatan->get_all_syarat_temperamen_kerja($id);
		echo json_encode($data);
	}

	public function p_add_syarat_temperamen_kerja()
	{
		unset($_POST['_wysihtml5_mode']);
		$arr_listed = isset($_POST['listed']) ? $_POST['listed'] : null;
		$id_analisis_beban_kerja = $_POST['id_analisis_beban_kerja'];
		$this->daftarAnalisisJabatan->truncate_syarat_temperamen_kerja_batch($id_analisis_beban_kerja);
		if($arr_listed){
			foreach($arr_listed as $i){
				$temp_data[] = array(
					'id_analisis_beban_kerja' => $id_analisis_beban_kerja,
					'id_keterampilan_kerja'	=> $i,
					'creator' => $this->user_id,
					'created_at' => date('Y-m-d H:i:s')
				); 	
			}
			$this->daftarAnalisisJabatan->insert_syarat_temperamen_kerja_batch($temp_data);
		}
		echo json_encode(array('status'=>true));
	}
	
	public function delete_syarat_temperamen_kerja($id){
		if ($this->session->userdata('level') == 'Administrator') {
		$this->daftarAnalisisJabatan->delete_syarat_temperamen_kerja($id);
		echo json_encode(array('status'=>true));
		}
	}

	//Minat Kerja
	public function fetch_syarat_minat_kerja($id){
		$data = $this->daftarAnalisisJabatan->get_all_syarat_minat_kerja($id);
		echo json_encode($data);
	}

	public function p_add_syarat_minat_kerja()
	{
		unset($_POST['_wysihtml5_mode']);
		$arr_listed = isset($_POST['listed']) ? $_POST['listed'] : null;
		$id_analisis_beban_kerja = $_POST['id_analisis_beban_kerja'];
		$this->daftarAnalisisJabatan->truncate_syarat_minat_kerja_batch($id_analisis_beban_kerja);
		if($arr_listed){
			foreach($arr_listed as $i){
				$temp_data[] = array(
					'id_analisis_beban_kerja' => $id_analisis_beban_kerja,
					'id_keterampilan_kerja'	=> $i,
					'creator' => $this->user_id,
					'created_at' => date('Y-m-d H:i:s')
				); 	
			}
			$this->daftarAnalisisJabatan->insert_syarat_minat_kerja_batch($temp_data);
		}
		echo json_encode(array('status'=>true));
	}
	
	public function delete_syarat_minat_kerja($id){
		if ($this->session->userdata('level') == 'Administrator') {
		$this->daftarAnalisisJabatan->delete_syarat_minat_kerja($id);
		echo json_encode(array('status'=>true));
		}
	}

	//Upaya Fisik
	public function fetch_syarat_upaya_fisik($id){
		$data = $this->daftarAnalisisJabatan->get_all_syarat_upaya_fisik($id);
		echo json_encode($data);
	}

	public function p_add_syarat_upaya_fisik()
	{
		unset($_POST['_wysihtml5_mode']);
		$arr_listed = isset($_POST['listed']) ? $_POST['listed'] : null;
		$id_analisis_beban_kerja = $_POST['id_analisis_beban_kerja'];
		$this->daftarAnalisisJabatan->truncate_syarat_upaya_fisik_batch($id_analisis_beban_kerja);
		if($arr_listed){
			foreach($arr_listed as $i){
				$temp_data[] = array(
					'id_analisis_beban_kerja' => $id_analisis_beban_kerja,
					'id_keterampilan_kerja'	=> $i,
					'creator' => $this->user_id,
					'created_at' => date('Y-m-d H:i:s')
				); 	
			}
			$this->daftarAnalisisJabatan->insert_syarat_upaya_fisik_batch($temp_data);
		}
		echo json_encode(array('status'=>true));
	}
	
	public function delete_syarat_upaya_fisik($id){
		if ($this->session->userdata('level') == 'Administrator') {
		$this->daftarAnalisisJabatan->delete_syarat_upaya_fisik($id);
		echo json_encode(array('status'=>true));
		}
	}

	//Kondisi Fisik
	public function fetch_syarat_kondisi_fisik($id){
		$misi = $this->daftarAnalisisJabatan->select_by_id_syarat_kondisi_fisik_anjab($id);
		echo json_encode($misi);
	}

	public function p_update_syarat_kondisi_fisik(){
		$id_syarat_kondisi_fisik = $_POST['id_syarat_kondisi_fisik'];
		unset($_POST['id_syarat_kondisi_fisik']);
		unset($_POST['_wysihtml5_mode']);
		$_POST['updator'] = $this->user_id;
		$this->daftarAnalisisJabatan->update_syarat_kondisi_fisik($_POST,$id_syarat_kondisi_fisik);
		echo json_encode(array('status'=>true));
	}

	public function p_add_syarat_kondisi_fisik()
	{
		unset($_POST['_wysihtml5_mode']);
		$_POST['creator'] = $this->user_id;
		$_POST['created_at'] = date('Y-m-d H:i:s');
		$this->daftarAnalisisJabatan->insert_syarat_kondisi_fisik($_POST);
		echo json_encode(array('status'=>true));
	}
	
	public function delete_syarat_kondisi_fisik($id){
		if ($this->session->userdata('level') == 'Administrator') {
		$this->daftarAnalisisJabatan->delete_syarat_kondisi_fisik($id);
		echo json_encode(array('status'=>true));
		}
	}

	//Fungsi Pekerjaan
	public function fetch_syarat_fungsi_pekerjaan($id){
		$data = $this->daftarAnalisisJabatan->get_all_syarat_fungsi_pekerjaan($id);
		echo json_encode($data);
	}

	public function p_add_syarat_fungsi_pekerjaan()
	{
		unset($_POST['_wysihtml5_mode']);
		$arr_listed = isset($_POST['listed']) ? $_POST['listed'] : null;
		$id_analisis_beban_kerja = $_POST['id_analisis_beban_kerja'];
		$this->daftarAnalisisJabatan->truncate_syarat_fungsi_pekerjaan_batch($id_analisis_beban_kerja);
		if($arr_listed){
			foreach($arr_listed as $i){
				$temp_data[] = array(
					'id_analisis_beban_kerja' => $id_analisis_beban_kerja,
					'id_fungsi_pekerjaan'	=> $i,
					'creator' => $this->user_id,
					'created_at' => date('Y-m-d H:i:s')
				); 	
			}
			$this->daftarAnalisisJabatan->insert_syarat_fungsi_pekerjaan_batch($temp_data);
		}
		echo json_encode(array('status'=>true));
	}
	
	public function delete_syarat_fungsi_pekerjaan($id){
		if ($this->session->userdata('level') == 'Administrator') {
		$this->daftarAnalisisJabatan->delete_syarat_fungsi_pekerjaan($id);
		echo json_encode(array('status'=>true));
		}
	}

	public function export_excel($id) {
		// Load plugin PHPExcel nya
	
		$object = new PHPExcel();

		$object->setActiveSheetIndex(0);
		$detail = $this->daftarAnalisisJabatan->get_by_id($id);
		$hasil_kerja = $this->daftarAnalisisJabatan->get_all_hasil_kerja($id);
		$sender = $this->sender->cek_sender($id, true);

		// Buat sebuah variabel untuk menampung pengaturan style dari header tabel
		$style_col = array(
			'font' => array('bold' => true), // Set font nya jadi bold
			'alignment' => array(
			  'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
			  'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
			),
			'borders' => array(
			  'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
			  'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
			  'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
			  'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
			)
		  );
	  
		  // Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
		  $style_row = array(
			'alignment' => array(
			  'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
			),
			'borders' => array(
			  'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
			  'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
			  'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
			  'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
			)
		  );
	  
		$object->setActiveSheetIndex(0)->setCellValue('A1', "NAMA JABATAN :"); // Set kolom A1 dengan tulisan "REKAPITULASI HASIL SURVEY KEPUASAN LAYANAN"
		$object->setActiveSheetIndex(0)->setCellValue('B1', $detail->nama); // Set kolom A1 dengan tulisan "REKAPITULASI HASIL SURVEY KEPUASAN LAYANAN"
		$object->setActiveSheetIndex(0)->setCellValue('A2', "UNIT KERJA :"); 
		$object->setActiveSheetIndex(0)->setCellValue('B2', ''); 
		$object->setActiveSheetIndex(0)->setCellValue('A3', "UNIT ORGANISASI :"); 
		$object->setActiveSheetIndex(0)->setCellValue('B3', $detail->namaSkpd); 
		$object->setActiveSheetIndex(0)->setCellValue('A4', "IKHITSAR JABATAN :"); 
		$object->setActiveSheetIndex(0)->setCellValue('B4', $detail->ikhtisar_jabatan); 

		$object->setActiveSheetIndex(0)->setCellValue('A7', "NO"); 
		$object->getActiveSheet()->getStyle('A7')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$object->setActiveSheetIndex(0)->setCellValue('B7', "URAIAN TUGAS"); 
		$object->getActiveSheet()->mergeCells('B7:C7'); 
		$object->getActiveSheet()->getStyle('B7')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$object->setActiveSheetIndex(0)->setCellValue('D7', "JUMLAH HASIL"); 
		$object->getActiveSheet()->getStyle('D7')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$object->setActiveSheetIndex(0)->setCellValue('E7', "SATUAN HASIL"); 
		$object->getActiveSheet()->getStyle('E7')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$object->setActiveSheetIndex(0)->setCellValue('F7', "WAKTU PENYELESAIAN PER SATUAN HASIL KERJA"); 
		$object->getActiveSheet()->getStyle('F7')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$object->setActiveSheetIndex(0)->setCellValue('G7', "WAKTU KERJA EFEKTIF"); 
		$object->getActiveSheet()->getStyle('G7')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$object->setActiveSheetIndex(0)->setCellValue('H7', "BEBAN KERJA"); 
		$object->getActiveSheet()->getStyle('H7')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$object->setActiveSheetIndex(0)->setCellValue('I7', "PEGAWAI YANG DIBUTUHKAN"); 
		$object->getActiveSheet()->getStyle('I7')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$object->setActiveSheetIndex(0)->setCellValue('J7', "KETERANGAN"); 
		$object->getActiveSheet()->getStyle('J7')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

		$no = 1; // Untuk penomoran tabel, di awal set dengan 1
		$numrow = 8; // Set baris pertama untuk isi tabel adalah baris ke 4
		$jumlah_beban_kerja = 0;
        $jumlah_kebutuhan_pegawai = 0;

		foreach($hasil_kerja as $i){ // Lakukan looping pada variabel siswa
			$jumlah_hasil = $i->jumlah_hasil ?: 0;
			$waktu_penyelesaian = $i->waktu_penyelesaian ?: 0;
			$beban_kerja = $jumlah_hasil * $waktu_penyelesaian;
			$kebutuhan_pegawai = $jumlah_hasil * str_replace(',','.',$waktu_penyelesaian) / 1250;
			$jumlah_beban_kerja += $beban_kerja;
			$jumlah_kebutuhan_pegawai += $kebutuhan_pegawai;

			$object->setActiveSheetIndex(0)->setCellValue('A'.$numrow, $no);
			$object->setActiveSheetIndex(0)->setCellValue('B'.$numrow, 'Responden'.$no);
			$object->getActiveSheet()->mergeCells('B'.$numrow.':C'.$numrow.''); 
			$object->setActiveSheetIndex(0)->setCellValue('D'.$numrow, $i->uraianTugas);
			$object->setActiveSheetIndex(0)->setCellValue('E'.$numrow, $i->jumlah_hasil);
			$object->setActiveSheetIndex(0)->setCellValue('F'.$numrow, $i->satuan_hasil);
			$object->setActiveSheetIndex(0)->setCellValue('G'.$numrow, $i->waktu_penyelesaian);
			$object->setActiveSheetIndex(0)->setCellValue('H'.$numrow, '1250');
			$object->setActiveSheetIndex(0)->setCellValue('I'.$numrow, $beban_kerja);
			$object->setActiveSheetIndex(0)->setCellValue('J'.$numrow, $kebutuhan_pegawai);

			$no++; // Tambah 1 setiap kali looping
			$numrow++; // Tambah 1 setiap kali looping
		}

		$object->setActiveSheetIndex(0)->setCellValue('A'.$numrow, 'Jumlah');
		$object->getActiveSheet()->mergeCells('A'.$numrow.':H'.$numrow.'');
		$object->setActiveSheetIndex(0)->setCellValue('I'.$numrow, $jumlah_beban_kerja);
		$object->setActiveSheetIndex(0)->setCellValue('J'.$numrow, $jumlah_kebutuhan_pegawai);
		$numrow = $numrow + 1;
		$object->setActiveSheetIndex(0)->setCellValue('A'.$numrow, 'Pembulatan');
		$object->getActiveSheet()->mergeCells('A'.$numrow.':H'.$numrow.'');
		$object->setActiveSheetIndex(0)->setCellValue('J'.$numrow, round($jumlah_kebutuhan_pegawai));
		$numrow = $numrow + 5;
		$object->setActiveSheetIndex(0)->setCellValue('A'.$numrow, 'Tanggal dibuat');
		$object->setActiveSheetIndex(0)->setCellValue('B'.$numrow, date('d, M Y H:i:s'));
		
		$numrow_nama = $numrow + 6;
		$numrow_nip = $numrow + 7;
		$object->setActiveSheetIndex(0)->setCellValue('E'.$numrow, 'Mengetahui atasan langsung');
		$object->getActiveSheet()->mergeCells('E'.$numrow.':G'.$numrow.'');
		$object->setActiveSheetIndex(0)->setCellValue('E'.$numrow_nama, isset($sender->namaVerifikator) ?: '-');
		$object->setActiveSheetIndex(0)->setCellValue('E'.$numrow_nip, isset($sender->nipVerifikator) ?: '-');
		
		$numrow_sign = $numrow - 1;
		$kondisi_saat_ini = $detail->jumlah_pemangku - round($jumlah_kebutuhan_pegawai);
		$kondisi_saat_ini = $kondisi_saat_ini.' (Kelebihan)';
		if($kondisi_saat_ini < 0){
			$kondisi_saat_ini = $kondisi_saat_ini.' (Kekurangan)';
		}
		$object->setActiveSheetIndex(0)->setCellValue('A'.$numrow_sign, 'Kondisi saat ini');
		$object->setActiveSheetIndex(0)->setCellValue('B'.$numrow_sign, $kondisi_saat_ini);
		$object->setActiveSheetIndex(0)->setCellValue('H'.$numrow_sign, 'Kabupaten Sumedang, '.date('d M Y'));
		$object->setActiveSheetIndex(0)->setCellValue('H'.$numrow, 'Yang membuat / Pemangku');
		$object->getActiveSheet()->mergeCells('H'.$numrow.':J'.$numrow.'');
		$object->setActiveSheetIndex(0)->setCellValue('H'.$numrow_nama, isset($sender->namaPemangku) ?: '-');
		$object->setActiveSheetIndex(0)->setCellValue('H'.$numrow_nip, isset($sender->nipPemangku) ?: '-');


		$object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="analisis_beban_kerja_'. $detail->nama . '_' . time() .'.xls"');
		ob_end_clean();
		ob_start();
		$object_writer->save('php://output');
 
	}

	public function export_pdf($id)
	{
		$detail = $this->daftarAnalisisJabatan->get_by_id($id);
		$hasil_kerja = $this->daftarAnalisisJabatan->get_all_hasil_kerja($id);
		$sender = $this->sender->cek_sender($id, true);
		
		$pdf = new Pdf('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		// $pdf->setPrintFooter(false);
		// $pdf->setPrintHeader(false);
		$pdf->SetTitle($detail->namaSkpd . '_' . time());
		$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 006', PDF_HEADER_STRING);
		$pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);
		$pdf->AddPage('');
		$pdf->Write(0, 'SIMANJA - Sistem Analisis Jabatan (ABK)', '', 0, 'L', true, 0, false, false, 0);

		$html = '<br><br>';

		$html .= '<table>
					<tr>
						<th width="20%">Nama Jabatan</th>
						<th width="5%">:</th>
						<th width="50%">'.$detail->nama.'</th>
					</tr>
					<tr>
						<th width="20%">Nama Perangkat Daerah</th>
						<th width="5%">:</th>
						<th width="50%">'.$detail->namaSkpd.'</th>
					</tr>
					<tr>
						<th width="20%">Ikhtisar Jabatan</th>
						<th width="5%">:</th>
						<th width="50%">'.$detail->ikhtisar_jabatan.'</th>
					</tr>
					<tr>
						<th width="20%">Tanggal dibuat</th>
						<th width="5%">:</th>
						<th width="50%"><b>'.date('d M Y H:i:s').'</b></th>
					</tr>
				</table>';

		$isi_content = '';
		$no = 1;
		foreach($hasil_kerja as $i){ // Lakukan looping pada variabel siswa
			$jumlah_hasil = $i->jumlah_hasil ?: 0;
			$waktu_penyelesaian = $i->waktu_penyelesaian ?: 0;
			$beban_kerja = $jumlah_hasil * $waktu_penyelesaian;
			$kebutuhan_pegawai = $jumlah_hasil * str_replace(',','.',$waktu_penyelesaian) / 1250;
			$jumlah_beban_kerja += $beban_kerja;
			$jumlah_kebutuhan_pegawai += $kebutuhan_pegawai;

			$isi_content .= '<tr>
								<td>'.$no.'</td>
								<td>'.$i->uraianTugas.'</td>
								<td>'.$i->jumlah_hasil.'</td>
								<td>'.$i->satuan_hasil.'</td>
								<td>'.$i->waktu_penyelesaian.'</td>
								<td>1250</td>
								<td>'.$kebutuhan_pegawai.'</td>
							</tr>';
			$no++;
		}

		$html .= '<br><br>';

		$kondisi_saat_ini_count = $detail->jumlah_pemangku - round($jumlah_kebutuhan_pegawai);
		$kondisi_saat_ini = $kondisi_saat_ini_count.' (Kelebihan)';
		if($kondisi_saat_ini_count < 0){
			$kondisi_saat_ini = $kondisi_saat_ini_count.' (Kekurangan)';
		}

		$html .= '<table border="1" cellpadding="7">
					<thead>
						<tr>
							<th>No</th>
							<th>Uraian Tugas</th>
							<th>Jumlah Hasil</th>
							<th>Satuan Hasil</th>
							<th>Waktu Penyelesaian per Satuan Hasil Kerja</th>
							<th>Waktu Kerja Efektif</th>
							<th>Pegawai yang dibutuhkan</th>
						</tr>
					</thead>
					'.$isi_content.'
					<tr>
						<td colspan="6">Jumlah</td>
						<td><b>'.$jumlah_kebutuhan_pegawai.'</b></td>
					</tr>
					<tr>
						<td colspan="6">Pembulatan</td>
						<td><b>'.round($jumlah_kebutuhan_pegawai).'</b></td>
					</tr>
				</table>';
		
		$html .= '<br><br>';
		
		$html .= '<table>
					<tr>
						<th width="20%">Kondisi saat ini</th>
						<th width="5%">:</th>
						<th width="50%"><b>'.$kondisi_saat_ini.'</b></th>
					</tr>
				</table>';
		
		$html .= '<br><br>';

		$html .= '<table border="0">
					<tr>
						<td width="50%" style="text-align: center"></td>
						<td width="50%" style="text-align: center">Kabupaten Sumedang, '.date('d M Y').'</td>
					</tr>
					<tr>
						<td width="50%" style="text-align: center">Mengetahui Atasan Langsung</td>
						<td width="50%" style="text-align: center">Pemangku Jabatan atau Penganalisis</td>
					</tr>
					<br>
					<br>
					<br>
					<br>
					<br>
					<tr>
						<td width="50%" style="text-align: center"><b>'.$sender->namaVerifikator.'</b></td>
						<td width="50%" style="text-align: center"><b>'.$sender->namaPemangku.'</b></td>
					</tr>
					<tr>
						<td width="50%" style="text-align: center">NIP : <u>'.$sender->nipVerifikator.'</u></td>
						<td width="50%" style="text-align: center">NIP : <u>'.$sender->nipPemangku.'</u></td>
					</tr>
		</table>';
		

		$pdf->writeHTML($html);
		
		ob_end_clean();
		$pdf->Output(time(), 'I');
	}

	public function export_pdf_ver1f($id)
	{
		$detail = $this->daftarAnalisisJabatan->get_by_id($id);
		$hasil_kerja = $this->daftarAnalisisJabatan->get_all_hasil_kerja($id);
		$sender = $this->sender->cek_sender($id, true);
		
		$pdf = new PDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		$pdf->setPrintFooter(false);
		$pdf->setPrintHeader(false);
		$pdf->SetTitle($detail->namaSkpd . '_' . time());
		$pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);
		$pdf->AddPage('');
		$pdf->Write(0, 'SIMANJA - Sistem Analisis Jabatan (ABK)', '', 0, 'L', true, 0, false, false, 0);

		$html = '<br><br>';

		$html .= '<table>
					<tr>
						<th width="20%">Nama Jabatan</th>
						<th width="5%">:</th>
						<th width="50%">'.$detail->nama.'</th>
					</tr>
					<tr>
						<th width="20%">Nama Perangkat Daerah</th>
						<th width="5%">:</th>
						<th width="50%">'.$detail->namaSkpd.'</th>
					</tr>
					<tr>
						<th width="20%">Ikhtisar Jabatan</th>
						<th width="5%">:</th>
						<th width="50%">'.$detail->ikhtisar_jabatan.'</th>
					</tr>
					<tr>
						<th width="20%">Tanggal dibuat</th>
						<th width="5%">:</th>
						<th width="50%"><b>'.date('d M Y H:i:s').'</b></th>
					</tr>
				</table>';

		$isi_content = '';
		$no = 1;
		foreach($hasil_kerja as $i){ // Lakukan looping pada variabel siswa
			$jumlah_hasil = $i->jumlah_hasil ?: 0;
			$waktu_penyelesaian = $i->waktu_penyelesaian ?: 0;
			$beban_kerja = $jumlah_hasil * $waktu_penyelesaian;
			$kebutuhan_pegawai = $jumlah_hasil * str_replace(',','.',$waktu_penyelesaian) / 1250;
			$jumlah_beban_kerja += $beban_kerja;
			$jumlah_kebutuhan_pegawai += $kebutuhan_pegawai;

			$isi_content .= '<tr>
								<td>'.$no.'</td>
								<td>'.$i->uraianTugas.'</td>
								<td>'.$i->jumlah_hasil.'</td>
								<td>'.$i->satuan_hasil.'</td>
								<td>'.$i->waktu_penyelesaian.'</td>
								<td>1250</td>
								<td>'.$kebutuhan_pegawai.'</td>
							</tr>';
			$no++;
		}

		$html .= '<br><br>';

		$kondisi_saat_ini_count = $detail->jumlah_pemangku - round($jumlah_kebutuhan_pegawai);
		$kondisi_saat_ini = $kondisi_saat_ini_count.' (Kelebihan)';
		if($kondisi_saat_ini_count < 0){
			$kondisi_saat_ini = $kondisi_saat_ini_count.' (Kekurangan)';
		}

		$html .= '<table border="1" cellpadding="7">
					<thead>
						<tr>
							<th>No</th>
							<th>Uraian Tugas</th>
							<th>Jumlah Hasil</th>
							<th>Satuan Hasil</th>
							<th>Waktu Penyelesaian per Satuan Hasil Kerja</th>
							<th>Waktu Kerja Efektif</th>
							<th>Pegawai yang dibutuhkan</th>
						</tr>
					</thead>
					'.$isi_content.'
					<tr>
						<td colspan="6">Jumlah</td>
						<td><b>'.$jumlah_kebutuhan_pegawai.'</b></td>
					</tr>
					<tr>
						<td colspan="6">Pembulatan</td>
						<td><b>'.round($jumlah_kebutuhan_pegawai).'</b></td>
					</tr>
				</table>';
		
		$html .= '<br><br>';
		
		$html .= '<table>
					<tr>
						<th width="20%">Kondisi saat ini</th>
						<th width="5%">:</th>
						<th width="50%"><b>'.$kondisi_saat_ini.'</b></th>
					</tr>
				</table>';
		
		// $html .= '<br><br>';

		// $html .= '<table border="0">
		// 			<tr>
		// 				<td width="50%" style="text-align: center"></td>
		// 				<td width="50%" style="text-align: center">Kabupaten Sumedang, '.date('d M Y').'</td>
		// 			</tr>
		// 			<tr>
		// 				<td width="50%" style="text-align: center">Mengetahui Atasan Langsung</td>
		// 				<td width="50%" style="text-align: center">Pemangku Jabatan atau Penganalisis</td>
		// 			</tr>
		// 			<br>
		// 			<br>
		// 			<br>
		// 			<br>
		// 			<br>
		// 			<tr>
		// 				<td width="50%" style="text-align: center"><b>'.$sender->namaVerifikator.'</b></td>
		// 				<td width="50%" style="text-align: center"><b>'.$sender->namaPemangku.'</b></td>
		// 			</tr>
		// 			<tr>
		// 				<td width="50%" style="text-align: center">NIP : <u>'.$sender->nipVerifikator.'</u></td>
		// 				<td width="50%" style="text-align: center">NIP : <u>'.$sender->nipPemangku.'</u></td>
		// 			</tr>
		// </table>';
		

		$pdf->writeHTML($html);
		
		ob_end_clean();
		$pdf->Output(time(), 'I');
	}
}
?>
