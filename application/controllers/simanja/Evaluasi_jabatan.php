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

class Evaluasi_jabatan extends CI_Controller {
	public $user_id;

	public function __construct(){
		parent ::__construct();
		$this->user_id = $this->session->userdata('user_id');
		$this->load->model('user_model');
		$this->load->model('simanja/analisis_jabatan_model', 'daftarAnalisisJabatan');
		//Ref
		$this->load->model('simanja/ref_faktor_evaluasi_model', 'refFaktorEvaluasi');
		$this->load->model('simanja/ref_jabatan_model', 'refJabatan');
		$this->load->model('simanja/ref_satuan_hasil_model', 'refSatuanHasil');
		$this->load->model('simanja/ref_keterampilan_kerja_model', 'refKeterampilanKerja');
		$this->load->model('simanja/ref_bakat_kerja_model', 'refBakatKerja');
		$this->load->model('simanja/ref_temperamen_kerja_model', 'refTemperamenKerja');
		$this->load->model('simanja/ref_minat_kerja_model', 'refMinatKerja');
		$this->load->model('simanja/ref_upaya_fisik_model', 'refUpayaFisik');
		$this->load->model('simanja/ref_fungsi_pekerjaan_model', 'refFungsiPekerjaan');
		//
		$this->load->model('ref_skpd_model');
		$this->load->model('ref_unit_kerja_model');
		$this->user_model->user_id = $this->user_id;
		$this->user_model->set_user_by_user_id();
		$this->user_picture = $this->user_model->user_picture;
		$this->full_name	= $this->user_model->full_name;
		$this->user_level	= $this->user_model->level;
		$this->load->library(array('excel','session','pdf'));
		if ($this->user_level=="Admin Web");

		//$this->load->model('Ref_renstra','ref_kode_kegiatan_m');
	}
	
	public function index()
	{
		if ($this->user_id)
		{
			$data['title']		= "Evaluasi Jabatan - Sistem Informasi Anjab ABK dan Evaluasi Jabatan ";
			$data['content']	= "simanja/evaluasi_jabatan/index" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']	= $this->full_name;
			$data['user_level']	= $this->user_level;
			$data['active_menu'] = "simanja/evaluasi_jabatan";

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
					redirect(base_url('simanja/evaluasi_jabatan'));
				}else{
					$this->session->set_flashdata('status', '<span class="glyphicon glyphicon-remove"></span> Terjadi Kesalahan');
					redirect(base_url('simanja/evaluasi_jabatan'));
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
			$data['content']	= "simanja/evaluasi_jabatan/detail" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']	= $this->full_name;
			$data['user_level']	= $this->user_level;
			$data['active_menu'] = "simanja/evaluasi_jabatan";

			$data['skpd'] = $this->ref_skpd_model->get_all();
			$data['detail'] = $detail;

			//Parameter Penilaian
			$params['kualifikasi_jabatan'] = $this->daftarAnalisisJabatan->get_all_kualifikasi_jabatan($id, true);
			$params['tugas_pokok'] = $this->daftarAnalisisJabatan->get_all_tugas_pokok($id);
			$params['hasil_kerja'] = $this->daftarAnalisisJabatan->get_all_hasil_kerja($id);
			$params['tanggung_jawab'] = $this->daftarAnalisisJabatan->get_all_tanggung_jawab($id);
			$faktor_evaluasi = $this->refFaktorEvaluasi->get_all_ref(['jenis_jabatan' => ($detail->jenis_jabatan == 'Pelaksana' ? 'Fungsional' : $detail->jenis_jabatan)]);
			$arr = [];

			foreach($faktor_evaluasi as $i => $v){
				$arr[$i]['id'] = $v->id;
				$arr[$i]['number'] = $v->number;
				$arr[$i]['nama'] = $v->nama;
				$arr[$i]['uraian'] = $v->uraian;
				$arr[$i]['skor'] = $this->refFaktorEvaluasi->get_skor($id, $v->id);
			}

			$params['faktor_evaluasi'] = $arr;

			$data = array_merge($data,$params);

			$this->load->view('admin/index',$data);
		}
		else
		{
			redirect('admin');
		}
	}

	public function fetch_ref($id){
		$misi = $this->refFaktorEvaluasi->get_all_ref_item($id);
		echo json_encode($misi);
	}

	public function fetch_item($anjab, $faktor){
		$item = $this->refFaktorEvaluasi->get_skor($anjab, $faktor);
		echo json_encode($item);
	}

	public function p_update_ref(){
		$id_ref = $_POST['id_ref'];
		$anjab = $_POST['id_analisis_jabatan'];
		$faktor = $_POST['id_faktor_evaluasi'];

		unset($_POST['id_ref']);
		unset($_POST['_wysihtml5_mode']);

		$cek = $this->refFaktorEvaluasi->cek_skor($anjab, $faktor);
		if(!empty($cek)){
			$this->refFaktorEvaluasi->update_skor($_POST,$anjab, $faktor);
		}else{
			$_POST['created_at'] = date('Y-m-d H:i:s');
			$this->refFaktorEvaluasi->insert_skor($_POST);
		}

		echo json_encode(array('status'=>true));
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
		$id_analisis_jabatan = $_POST['id_analisis_jabatan'];
		$this->daftarAnalisisJabatan->truncate_syarat_keterampilan_kerja_batch($id_analisis_jabatan);
		if($arr_listed){
			foreach($arr_listed as $i){
				$temp_data[] = array(
					'id_analisis_jabatan' => $id_analisis_jabatan,
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
		$id_analisis_jabatan = $_POST['id_analisis_jabatan'];
		$this->daftarAnalisisJabatan->truncate_syarat_bakat_kerja_batch($id_analisis_jabatan);
		if($arr_listed){
			foreach($arr_listed as $i){
				$temp_data[] = array(
					'id_analisis_jabatan' => $id_analisis_jabatan,
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
		$id_analisis_jabatan = $_POST['id_analisis_jabatan'];
		$this->daftarAnalisisJabatan->truncate_syarat_temperamen_kerja_batch($id_analisis_jabatan);
		if($arr_listed){
			foreach($arr_listed as $i){
				$temp_data[] = array(
					'id_analisis_jabatan' => $id_analisis_jabatan,
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
		$id_analisis_jabatan = $_POST['id_analisis_jabatan'];
		$this->daftarAnalisisJabatan->truncate_syarat_minat_kerja_batch($id_analisis_jabatan);
		if($arr_listed){
			foreach($arr_listed as $i){
				$temp_data[] = array(
					'id_analisis_jabatan' => $id_analisis_jabatan,
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
		$id_analisis_jabatan = $_POST['id_analisis_jabatan'];
		$this->daftarAnalisisJabatan->truncate_syarat_upaya_fisik_batch($id_analisis_jabatan);
		if($arr_listed){
			foreach($arr_listed as $i){
				$temp_data[] = array(
					'id_analisis_jabatan' => $id_analisis_jabatan,
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
		$id_analisis_jabatan = $_POST['id_analisis_jabatan'];
		$this->daftarAnalisisJabatan->truncate_syarat_fungsi_pekerjaan_batch($id_analisis_jabatan);
		if($arr_listed){
			foreach($arr_listed as $i){
				$temp_data[] = array(
					'id_analisis_jabatan' => $id_analisis_jabatan,
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
	
	public function export_evjab_informasi_word($id)
	{
		$detail = $this->daftarAnalisisJabatan->get_by_id($id);
		
		$htmlTemplate = '
		<p style="text-align: center;font-size: 16px;font-weight: bold;">PEMERINTAH DAERAH KABUPATEN SUMEDANG</p>
		<p style="text-align: center;font-size: 18px;font-weight: bold;">INFORMASI FAKTOR JABATAN PELAKSANA</p>
		<table style="width: 100%">
			<tr style="font-size: 16px;">
				<td width="30%">Nama Jabatan</td>
				<td width="5%">:</td>
				<td width="65%">'.$detail->nama.'</td>
			</tr>
			<tr style="font-size: 16px;">
				<td width="30%">Perangkat Daerah</td>
				<td width="5%">:</td>
				<td width="65%">'.$detail->namaSkpd.'</td>
			</tr>
		</table>
		<ol type="I">
			<li style="font-weight: bold;font-size: 16px;">PERAN JABATAN</li>
			<p style="font-size: 16px">Jabatan ini merupakan jabatan klerek pendukung administrasi untuk memproses tindakan kepegawaian di National Finance Center (NFC): administrasi kepegawaian, administasi penggajian, pengendalian administrasi kepegawaian, atau melakukan berbagai tugas yang berhubungan dengan satu atau lebih bidang analis kepegawaian.</p>
			<li style="font-weight: bold;font-size: 16px;">TUGAS DAN TANGGUNG JAWAB UTAMA</li>
			<ol type="A">
				<li style="font-weight: bold;font-size: 16px;">URAIAN TUGAS</li>
				<ol>
					<li style="font-size: 16px;">Mengevaluasi formulir kepegawaian untuk melengkapi dan memastikan kesesuaian isinya.</li>
					<li style="font-size: 16px;">Melakukan orientasi bagi pegawai baru.</li>
				</ol>
				<li style="font-weight: bold;font-size: 16px;">TANGGUNG JAWAB</li>
				Menjamin kesesuaian data kepegawaian dan hal-hal yang berkaitan dengan penggajian pegawai.
			</ol>
			<li style="font-weight: bold;font-size: 16px;">HASIL KERJA JABATAN</li>
			<ol>
				<li style="font-size: 16px;">Data kepegawaian yang mutakhir.</li>
				<li style="font-size: 16px;">Data penggajian yang akurat.</li>
			</ol>
			<li style="font-weight: bold;font-size: 16px;">TINGKAT FAKTOR</li>
			<ol style="list-style-type: none;">
				<li style="font-weight: bold;font-size: 16px;">FAKTOR 1: PENGETAHUAN YANG DIBUTUHKAN JABATAN</li>
				<p>
					1.	Pengetahuan tentang peraturan, kebijakan, prosedur, dan terminology kepegawaian, untuk menganalisis situasi, menjawab pertanyaan dasar, dan menyelesaikan masalah teknis kecil.
					2.	Pengetahuan tentang formulir kepegawaian dan terminologi dan prosedur NFC dan untuk melakukan tindakan kepegawaian dan penggajian.
					3. Pengetahuan tentang prosedur dan struktur data kepegawaian 	untuk memelihara data referensi dan / atau organisasi data.
					4. 	Pengetahuan tentang peraturan kerahasian information untuk menjamin kerahasiaan dokumen dan data pegawai dan untuk 
				</p>
				<li style="font-weight: bold;font-size: 16px;">FAKTOR 2: PENGETAHUAN YANG DIBUTUHKAN JABATAN</li>
				<p>
					1.	Pengetahuan tentang peraturan, kebijakan, prosedur, dan terminology kepegawaian, untuk menganalisis situasi, menjawab pertanyaan dasar, dan menyelesaikan masalah teknis kecil.
					2.	Pengetahuan tentang formulir kepegawaian dan terminologi dan prosedur NFC dan untuk melakukan tindakan kepegawaian dan penggajian.
					3. Pengetahuan tentang prosedur dan struktur data kepegawaian 	untuk memelihara data referensi dan / atau organisasi data.
					4. 	Pengetahuan tentang peraturan kerahasian information untuk menjamin kerahasiaan dokumen dan data pegawai dan untuk 
				</p>
				<li style="font-weight: bold;font-size: 16px;">FAKTOR 3: PENGETAHUAN YANG DIBUTUHKAN JABATAN</li>
				<p>
					1.	Pengetahuan tentang peraturan, kebijakan, prosedur, dan terminology kepegawaian, untuk menganalisis situasi, menjawab pertanyaan dasar, dan menyelesaikan masalah teknis kecil.
					2.	Pengetahuan tentang formulir kepegawaian dan terminologi dan prosedur NFC dan untuk melakukan tindakan kepegawaian dan penggajian.
					3. Pengetahuan tentang prosedur dan struktur data kepegawaian 	untuk memelihara data referensi dan / atau organisasi data.
					4. 	Pengetahuan tentang peraturan kerahasian information untuk menjamin kerahasiaan dokumen dan data pegawai dan untuk 
				</p>
				<li style="font-weight: bold;font-size: 16px;">FAKTOR 4: PENGETAHUAN YANG DIBUTUHKAN JABATAN</li>
				<p>
					1.	Pengetahuan tentang peraturan, kebijakan, prosedur, dan terminology kepegawaian, untuk menganalisis situasi, menjawab pertanyaan dasar, dan menyelesaikan masalah teknis kecil.
					2.	Pengetahuan tentang formulir kepegawaian dan terminologi dan prosedur NFC dan untuk melakukan tindakan kepegawaian dan penggajian.
					3. Pengetahuan tentang prosedur dan struktur data kepegawaian 	untuk memelihara data referensi dan / atau organisasi data.
					4. 	Pengetahuan tentang peraturan kerahasian information untuk menjamin kerahasiaan dokumen dan data pegawai dan untuk 
				</p>
			</ol>
			<li style="font-weight: bold;font-size: 16px;">PERSYARATAN JABATAN TERTENTU</li>
			(jika ada)
		</ol>
		<br/>
			Terakhir diperbaharui : 6 Juni 2016';

		$phpWord = new PhpWord();
		$section = $phpWord->addSection();
		$section->addImage(
			'data/logo/icon.png',
			array(
				'width'         => 80,
				'height'        => 80,
				'alignment' 	=> \PhpOffice\PhpWord\SimpleType\Jc::CENTER
			)
		);
		Html::addHtml($section, $htmlTemplate);
		$writer = new Word2007($phpWord);
		header('Content-Type: application/ocetet-stream');
		header('Content-Disposition: attachment;filename="evaluasi_jabatan_informasi_'. $detail->nama . '_' . time() .'.docx"'); 
		header('Cache-Control: max-age=0');
		ob_clean();
		$writer->save('php://output');
	}
}
?>
