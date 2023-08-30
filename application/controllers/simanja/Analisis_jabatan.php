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
// use PhpOffice\PhpWord\SimpleType\Jc::CENTER;

Autoloader::register();
CAutoloader::register();
Settings::loadConfig();

class Analisis_jabatan extends CI_Controller {
	public $user_id;

	public function __construct(){
		parent ::__construct();
		$this->user_id = $this->session->userdata('user_id');
		$this->load->model('user_model');
		$this->load->model('pegawai_model');
		$this->load->model('simanja/analisis_jabatan_model', 'daftarAnalisisJabatan');
		//Ref
		$this->load->model('simanja/sender_model', 'sender');
		$this->load->model('simanja/ref_jabatan_model', 'refJabatan');
		$this->load->model('simanja/ref_satuan_hasil_model', 'refSatuanHasil');
		$this->load->model('simanja/ref_keterampilan_kerja_model', 'refKeterampilanKerja');
		$this->load->model('simanja/ref_bakat_kerja_model', 'refBakatKerja');
		$this->load->model('simanja/ref_temperamen_kerja_model', 'refTemperamenKerja');
		$this->load->model('simanja/ref_minat_kerja_model', 'refMinatKerja');
		$this->load->model('simanja/ref_upaya_fisik_model', 'refUpayaFisik');
		$this->load->model('simanja/ref_fungsi_pekerjaan_model', 'refFungsiPekerjaan');
		$this->load->model('simanja/ref_faktor_evaluasi_model', 'refFaktorEvaluasi');
		$this->load->model('simanja/ref_kelas_jabatan_model', 'refKelasJabatan');
		//
		$this->load->model('ref_skpd_model');
		$this->load->model('master_pegawai_model');
		$this->load->model('ref_unit_kerja_model');
		$this->user_model->user_id = $this->user_id;
		$this->user_model->set_user_by_user_id();
		$this->user_picture = $this->user_model->user_picture;
		$this->full_name	= $this->user_model->full_name;
		$this->user_level	= $this->user_model->level;
		$this->id_pegawai	= $this->user_model->id_pegawai;
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
			$data['content']	= "simanja/analisis_jabatan/index" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']	= $this->full_name;
			$data['user_level']	= $this->user_level;
			$data['user_privileges'] = explode(';', $this->user_privileges);
			$data['active_menu'] = "simanja/analisis_jabatan";

			$jabatan = $this->master_pegawai_model->get_by_name_jabatan('Kepala Sub Bagian Umum');
			$jabatan_id = [];
			$jabatan_no = 0;
			foreach($jabatan as $i){
				$jabatan_id[$jabatan_no] = $i['id_pegawai'];
				$jabatan_no++;
			}
			// $jabatan_id = implode(",", $jabatan_id);

			$where = $_GET ?: ['id_skpd' => 1];

			$admin = 0;
			if(in_array('simanja', $data['user_privileges']) || in_array($this->id_pegawai, $jabatan_id)){
				$admin = 1;
			}

			$data['skpd'] = $this->ref_skpd_model->get_all(['skpd','kecamatan','uptd','kelurahan','dprd','desa','puskesmas','demo']);
			$data['jabatan'] = $this->refJabatan->get_all_ref();
			$data['list'] = $this->daftarAnalisisJabatan->get_all_ref($where, $admin);

			//Counting
			$data['count_skpd'] = count($data['skpd']);
			$data['count_struktural'] = $this->daftarAnalisisJabatan->get_jabatan_by_jenis_count('Struktural', $where);
			$data['count_fungsional'] = $this->daftarAnalisisJabatan->get_jabatan_by_jenis_count('Fungsional', $where);
			$data['count_pelaksana'] = $this->daftarAnalisisJabatan->get_jabatan_by_jenis_count('Pelaksana', $where);

			foreach($data['list'] as $key => $item){

				//Parameter Penilaian
				$params['kualifikasi_jabatan'] = $this->daftarAnalisisJabatan->get_all_kualifikasi_jabatan($item->id, true);
				$params['tugas_pokok'] = $this->daftarAnalisisJabatan->get_all_tugas_pokok($item->id);
				$params['hasil_kerja'] = $this->daftarAnalisisJabatan->get_all_hasil_kerja($item->id);
				$params['bahan_kerja'] = $this->daftarAnalisisJabatan->get_all_bahan_kerja($item->id);
				$params['perangkat_kerja'] = $this->daftarAnalisisJabatan->get_all_perangkat_kerja($item->id);
				$params['tanggung_jawab'] = $this->daftarAnalisisJabatan->get_all_tanggung_jawab($item->id);
				$params['wewenang'] = $this->daftarAnalisisJabatan->get_all_wewenang($item->id);
				$params['korelasi_jabatan'] = $this->daftarAnalisisJabatan->get_all_korelasi_jabatan($item->id);
				$params['kondisi_lingkungan_kerja'] = $this->daftarAnalisisJabatan->get_all_kondisi_lingkungan_kerja($item->id, true);
				$params['risiko_bahaya'] = $this->daftarAnalisisJabatan->get_all_risiko_bahaya($item->id);
				
				//Syarat
				$params['keterampilan_kerja'] = $this->daftarAnalisisJabatan->get_all_syarat_keterampilan_kerja($item->id);
				$params['bakat_kerja'] = $this->daftarAnalisisJabatan->get_all_syarat_bakat_kerja($item->id);
				$params['temperamen_kerja'] = $this->daftarAnalisisJabatan->get_all_syarat_temperamen_kerja($item->id);
				$params['minat_kerja'] = $this->daftarAnalisisJabatan->get_all_syarat_minat_kerja($item->id);
				$params['upaya_fisik'] = $this->daftarAnalisisJabatan->get_all_syarat_upaya_fisik($item->id);
				$params['kondisi_fisik'] = $this->daftarAnalisisJabatan->get_all_syarat_kondisi_fisik($item->id, true);
				$params['fungsi_pekerjaan'] = $this->daftarAnalisisJabatan->get_all_syarat_fungsi_pekerjaan($item->id, true);
	
				$nilai = 0;
				$jumlah = 0;
				foreach($params as $i){
					$jumlah += 1;
					if(!empty($i)){
						$nilai += 1;
					}
				}
				
				$jumlah_beban_kerja = 0;
				$jumlah_kebutuhan_pegawai = 0;

				
				if(isset($params['hasil_kerja'])){
					foreach($params['hasil_kerja'] as $i){ 
						$jumlah_hasil = $i->jumlah_hasil ?: 0;
						$waktu_penyelesaian = $i->waktu_penyelesaian ?: 0;
						$beban_kerja = $jumlah_hasil * $waktu_penyelesaian;
						$kebutuhan_pegawai = $jumlah_hasil * str_replace(',','.',$waktu_penyelesaian) / 1250;
						$jumlah_beban_kerja += $beban_kerja;
						$jumlah_kebutuhan_pegawai += $kebutuhan_pegawai;
					}
				}
				
				$data['list'][$key]->jumlah_pemangku = ($data['list'][$key]->jumlah_pemangku != null) ? round($data['list'][$key]->jumlah_pemangku) : 0; 
				$data['list'][$key]->jumlah_kebutuhan_pegawai = $jumlah_kebutuhan_pegawai ? round($jumlah_kebutuhan_pegawai) : 0;

				$persentase = is_null($item->jumlah_pemangku) ? 99 : 100;
				$data['list'][$key]->nilai = $nilai / $jumlah * $persentase;

				$faktor_evaluasi = $this->refFaktorEvaluasi->get_all_ref(['jenis_jabatan' => ($item->jenis_jabatan == 'Pelaksana' ? 'Fungsional' : $item->jenis_jabatan)]);

				foreach($faktor_evaluasi as $i => $v){
					$arr[$i]['id'] = $v->id;
					$arr[$i]['number'] = $v->number;
					$arr[$i]['nama'] = $v->nama;
					$arr[$i]['uraian'] = $v->uraian;
					$arr[$i]['skor'] = $this->refFaktorEvaluasi->get_skor($item->id, $v->id);
				}

				$nilai_evjab = 0;
				foreach($arr as $i){
					if(isset($i['skor'])){
						$nilai_evjab += $i['skor']->nilaiItem;
					}
				}
				
				$kelas_jabatan = $this->refKelasJabatan->get_by_nilai($nilai_evjab);
				$data['list'][$key]->kelas = ($kelas_jabatan) ? $kelas_jabatan->kelas : 0;
				$data['list'][$key]->prestasi = 'Baik';
				if($data['list'][$key]->kelas > 8){
					$data['list'][$key]->prestasi = 'Sangat Baik';
				}

			}

			if (isset($_FILES["fileExcel"]["name"])) {
				$path = $_FILES["fileExcel"]["tmp_name"];
				$object = PHPExcel_IOFactory::load($path);
				foreach($object->getWorksheetIterator() as $worksheet)
				{
					$highestRow = $worksheet->getHighestRow();
					$highestColumn = $worksheet->getHighestColumn();	
					for($row=2; $row<=$highestRow; $row++)
					{
						$id_skpd = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
						$nama = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
						if($id_skpd != null){
							$skpd = $this->ref_skpd_model->get_by_name($id_skpd);
							if($skpd){
								$id_skpd = $skpd->id_skpd;
							}else{
								$id_skpd = null;
							}
						}else{
							$id_skpd = null;
						}
						$jpt_pratama = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
						if($jpt_pratama != null){
							$detail = $this->daftarAnalisisJabatan->get_by_name_and_skpd($jpt_pratama, $id_skpd);
							if($detail){
								$jpt_pratama = $detail->id;
							}else{
								$jpt_pratama = null;
							}
						}else{
							$jpt_pratama = null;
						}
						$administrator = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
						if($administrator != null){
							$detail = $this->daftarAnalisisJabatan->get_by_name_and_skpd($administrator, $id_skpd);
							if($detail){
								$administrator = $detail->id;
							}else{
								$administrator = null;
							}
						}else{
							$administrator = null;
						}
						$pengawas = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
						if($pengawas != null){
							$detail = $this->daftarAnalisisJabatan->get_by_name_and_skpd($pengawas, $id_skpd);
							if($detail){
								$pengawas = $detail->id;
							}else{
								$pengawas = null;
							}
						}else{
							$pengawas = null;
						}
						$induk_organisasi = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
						if($induk_organisasi != null){
							$detail = $this->daftarAnalisisJabatan->get_by_name_and_skpd($induk_organisasi, $id_skpd);
							if($detail){
								$induk_organisasi = $detail->id;
							}else{
								$induk_organisasi = null;
							}
						}else{
							$induk_organisasi = null;
						}
						$jenis_pegawai = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
						$jenis_jabatan = $worksheet->getCellByColumnAndRow(8, $row)->getValue();
						$data = array(
							'nama'	=> $nama,
							'jpt_pratama'	=> $jpt_pratama,
							'administrator'	=> $administrator,
							'pengawas'	=> $pengawas,
							'id_induk_jabatan'	=> $induk_organisasi,
							'jenis_pegawai'	=> $jenis_pegawai,
							'jenis_jabatan'	=> $jenis_jabatan,
							'id_skpd'	=> $id_skpd,
						); 	
						$insert = $this->daftarAnalisisJabatan->insert_excel_one($data);
					}
				}
				if($insert){
					$this->session->set_flashdata('status', '<span class="glyphicon glyphicon-ok"></span> Data Berhasil di Import ke Database');
					redirect(base_url('simanja/analisis_jabatan'));
				}else{
					$this->session->set_flashdata('status', '<span class="glyphicon glyphicon-remove"></span> Terjadi Kesalahan');
					redirect(base_url('simanja/analisis_jabatan'));
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
			$data['content']	= "simanja/analisis_jabatan/detail" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']	= $this->full_name;
			$data['user_level']	= $this->user_level;
			$data['active_menu'] = "simanja/analisis_jabatan";
			$data['user_privileges'] = explode(';', $this->user_privileges);

			$data['skpd'] = $this->ref_skpd_model->get_all();
			$data['detail'] = $detail;
			$data['pegawai'] = $this->pegawai_model->get_all_by_skpd($detail->id_skpd);
			$data['detail'] = $detail;
			if($detail->id_ref_jabatan){
				$data['ref_jabatan'] = $this->daftarAnalisisJabatan->get_ref_jabatan($detail->jenis_jabatan);
			}
			$data['jpt_pratama'] = ($detail->jenisSkpd != 'kecamatan') ? $this->daftarAnalisisJabatan->get_by_skpd($detail->id_skpd, ['jenis_jabatan' => 'Struktural', 'jenis_pegawai' => 'JPT Pratama']) : [];
			$data['administrator'] = ($detail->jenisSkpd != 'kecamatan') ? (($detail->jpt_pratama) ? $this->daftarAnalisisJabatan->get_induk($detail->jpt_pratama, 'Administrator', 'Struktural') : []) : $this->daftarAnalisisJabatan->get_jabatan_by_skpd_id_type($detail->id_skpd, 'Administrator');
			$data['pengawas'] = ($detail->jenisSkpd == 'kelurahan' || $detail->jenisSkpd == 'uptd') ? $this->daftarAnalisisJabatan->get_jabatan_by_skpd_id_type($detail->id_skpd, 'Pengawas') :  (($detail->administrator) ? $this->daftarAnalisisJabatan->get_induk($detail->administrator, 'Pengawas', 'Struktural') : []);

			$faktor_evaluasi = $this->refFaktorEvaluasi->get_all_ref(['jenis_jabatan' => ($detail->jenis_jabatan == 'Pelaksana' ? 'Fungsional' : $detail->jenis_jabatan)]);
			$arr = [];

			foreach($faktor_evaluasi as $i => $v){
				$arr[$i]['id'] = $v->id;
				$arr[$i]['number'] = $v->number;
				$arr[$i]['nama'] = $v->nama;
				$arr[$i]['uraian'] = $v->uraian;
				$arr[$i]['skor'] = $this->refFaktorEvaluasi->get_skor($id, $v->id);
			}
			
			$nilai_evjab = 0;
			foreach($arr as $i){
				if(isset($i['skor'])){
					$nilai_evjab += $i['skor']->nilaiItem;
				}
			}
			
			$kelas_jabatan = $this->refKelasJabatan->get_by_nilai($nilai_evjab);
			$data['kelas'] = ($kelas_jabatan) ? $kelas_jabatan->kelas : 0;
			
			$data['prestasi'] = 'Baik';
			if($data['kelas'] > 8){
				$data['prestasi'] = 'Sangat Baik';
			}

			$data['sender'] = $this->sender->cek_sender($id, true);

			//Ref
			$data['satuan_hasil'] = $this->refSatuanHasil->get_all_ref();
			$data['ref_keterampilan_kerja'] = $this->refKeterampilanKerja->get_all_ref();
			$data['ref_bakat_kerja'] = $this->refBakatKerja->get_all_ref();
			$data['ref_temperamen_kerja'] = $this->refTemperamenKerja->get_all_ref();
			$data['ref_minat_kerja'] = $this->refMinatKerja->get_all_ref();
			$data['ref_upaya_fisik'] = $this->refUpayaFisik->get_all_ref();
			$data['ref_fungsi_pekerjaan'] = $this->refFungsiPekerjaan->get_all_ref();
			$data['kualifikasi_pendidikan'] = $this->daftarAnalisisJabatan->get_kualifikasi_pendidikan_jabatan();

			//Parameter Penilaian
			$params['kualifikasi_jabatan'] = $this->daftarAnalisisJabatan->get_all_kualifikasi_jabatan($id, true);
			$params['tugas_pokok'] = $this->daftarAnalisisJabatan->get_all_tugas_pokok($id);
			$params['hasil_kerja'] = $this->daftarAnalisisJabatan->get_all_hasil_kerja($id);
			$params['bahan_kerja'] = $this->daftarAnalisisJabatan->get_all_bahan_kerja($id);
			$params['perangkat_kerja'] = $this->daftarAnalisisJabatan->get_all_perangkat_kerja($id);
			$params['tanggung_jawab'] = $this->daftarAnalisisJabatan->get_all_tanggung_jawab($id);
			$params['wewenang'] = $this->daftarAnalisisJabatan->get_all_wewenang($id);
			$params['korelasi_jabatan'] = $this->daftarAnalisisJabatan->get_all_korelasi_jabatan($id);
			$params['kondisi_lingkungan_kerja'] = $this->daftarAnalisisJabatan->get_all_kondisi_lingkungan_kerja($id, true);
			$params['risiko_bahaya'] = $this->daftarAnalisisJabatan->get_all_risiko_bahaya($id);
			
			//Syarat
			$params['keterampilan_kerja'] = $this->daftarAnalisisJabatan->get_all_syarat_keterampilan_kerja($id);
			$params['bakat_kerja'] = $this->daftarAnalisisJabatan->get_all_syarat_bakat_kerja($id);
			$params['temperamen_kerja'] = $this->daftarAnalisisJabatan->get_all_syarat_temperamen_kerja($id);
			$params['minat_kerja'] = $this->daftarAnalisisJabatan->get_all_syarat_minat_kerja($id);
			$params['upaya_fisik'] = $this->daftarAnalisisJabatan->get_all_syarat_upaya_fisik($id);
			$params['kondisi_fisik'] = $this->daftarAnalisisJabatan->get_all_syarat_kondisi_fisik($id, true);
			$params['fungsi_pekerjaan'] = $this->daftarAnalisisJabatan->get_all_syarat_fungsi_pekerjaan($id, true);

			$nilai = 0;
			$jumlah = 0;
			foreach($params as $i){
				$jumlah += 1;
				if(!empty($i)){
					$nilai += 1;
				}
			}

			$persentase = is_null($detail->jumlah_pemangku) ? 99 : 100;

			$data['params'] = $params;
			$data['nilai'] = $nilai / $jumlah * $persentase;

			$data = array_merge($data,$params);

			$this->load->view('admin/index',$data);
		}
		else
		{
			redirect('admin');
		}
	}

	public function peta_jabatan2($id)
	{
		$data['id'] = $id;
		$data['detail'] = $this->ref_skpd_model->get_by_id($id);

		$this->load->view('admin/simanja/peta_jabatan/index', $data);
	}

	public function peta_jabatan($id)
	{
		$data['id'] = $id;
		$data['detail'] = $this->ref_skpd_model->get_by_id($id);
		$petjab = $this->daftarAnalisisJabatan->get_by_skpd($id, ['jenis_jabatan' => 'Struktural', 'jenis_pegawai' => ($data['detail']->jenis_skpd == 'kecamatan') ? 'Administrator' : (($data['detail']->jenis_skpd == 'kelurahan' || $data['detail']->jenis_skpd == 'uptd') ? 'Pengawas' : 'JPT Pratama')]);
		
		foreach($petjab as $key => $value){
			$petjab[$key]->nested = $this->daftarAnalisisJabatan->get_induk($petjab[$key]->id, ['Administrator', 'JPT Pratama', 'Pengawas'], 'Struktural');
			$jenis_jabatan = $petjab[$key]->jenis_jabatan;
	
			$faktor_evaluasi = $this->refFaktorEvaluasi->get_all_ref(['jenis_jabatan' => ($jenis_jabatan == 'Pelaksana' ? 'Fungsional' : $jenis_jabatan)]);
			$arr = [];
	
			foreach($faktor_evaluasi as $i => $v){
				$arr[$i]['id'] = $v->id;
				$arr[$i]['number'] = $v->number;
				$arr[$i]['nama'] = $v->nama;
				$arr[$i]['uraian'] = $v->uraian;
				$arr[$i]['skor'] = $this->refFaktorEvaluasi->get_skor($value->id, $v->id);
			}
			
			$nilai_evjab = 0;
			foreach($arr as $i){
				if(isset($i['skor'])){
					$nilai_evjab += $i['skor']->nilaiItem ? round($i['skor']->nilaiItem) : null;
				}
			}
			
			$kelas_jabatan = $this->refKelasJabatan->get_by_nilai($nilai_evjab);
			$kelas = ($kelas_jabatan) ? $kelas_jabatan->kelas : 0;
	
			$petjab[$key]->kelas = $kelas;
			$petjab[$key]->nilai_evjab = $arr;

			$hasil_kerja = $this->daftarAnalisisJabatan->get_all_hasil_kerja($petjab[$key]->id);

			$jumlah_beban_kerja = 0;
        	$jumlah_kebutuhan_pegawai = 0;

			foreach($hasil_kerja as $i){ 
				$jumlah_hasil = $i->jumlah_hasil ?: 0;
				$waktu_penyelesaian = $i->waktu_penyelesaian ?: 0;
				$beban_kerja = $jumlah_hasil * $waktu_penyelesaian;
				$kebutuhan_pegawai = $jumlah_hasil * str_replace(',','.',$waktu_penyelesaian) / 1250;
				$jumlah_beban_kerja += $beban_kerja;
				$jumlah_kebutuhan_pegawai += $kebutuhan_pegawai;
			}
			$petjab[$key]->jumlah_pemangku = ($petjab[$key]->jumlah_pemangku != null) ? round($petjab[$key]->jumlah_pemangku) : 0; 
			$petjab[$key]->jumlah_kebutuhan_pegawai = $jumlah_kebutuhan_pegawai ? round($jumlah_kebutuhan_pegawai) : 0;

			if($petjab[$key]->nested){
				foreach($petjab[$key]->nested as $key2 => $value2){
					$petjab[$key]->nested[$key2]->nested = $this->daftarAnalisisJabatan->get_induk($petjab[$key]->nested[$key2]->id);
					$jenis_jabatan = $petjab[$key]->nested[$key2]->jenis_jabatan;
			
					$faktor_evaluasi = $this->refFaktorEvaluasi->get_all_ref(['jenis_jabatan' => ($jenis_jabatan == 'Pelaksana' ? 'Fungsional' : $jenis_jabatan)]);
					$arr = [];
			
					foreach($faktor_evaluasi as $i => $v){
						$arr[$i]['id'] = $v->id;
						$arr[$i]['number'] = $v->number;
						$arr[$i]['nama'] = $v->nama;
						$arr[$i]['uraian'] = $v->uraian;
						$arr[$i]['skor'] = $this->refFaktorEvaluasi->get_skor($value2->id, $v->id);
					}
					
					$nilai_evjab = 0;
					foreach($arr as $i){
						if(isset($i['skor'])){
							$nilai_evjab += $i['skor']->nilaiItem ? round($i['skor']->nilaiItem) : null;
						}
					}
					
					$kelas_jabatan = $this->refKelasJabatan->get_by_nilai($nilai_evjab);
					$kelas = ($kelas_jabatan) ? $kelas_jabatan->kelas : 0;
			
					$petjab[$key]->nested[$key2]->kelas = $kelas;
					$petjab[$key]->nested[$key2]->nilai_evjab = $arr;
		
					$hasil_kerja = $this->daftarAnalisisJabatan->get_all_hasil_kerja($petjab[$key]->nested[$key2]->id);
		
					$jumlah_beban_kerja = 0;
					$jumlah_kebutuhan_pegawai = 0;
		
					foreach($hasil_kerja as $i){ 
						$jumlah_hasil = $i->jumlah_hasil ?: 0;
						$waktu_penyelesaian = $i->waktu_penyelesaian ?: 0;
						$beban_kerja = $jumlah_hasil * $waktu_penyelesaian;
						$kebutuhan_pegawai = $jumlah_hasil * str_replace(',','.',$waktu_penyelesaian) / 1250;
						$jumlah_beban_kerja += $beban_kerja;
						$jumlah_kebutuhan_pegawai += $kebutuhan_pegawai;
		
					}
					$petjab[$key]->nested[$key2]->jumlah_pemangku = ($petjab[$key]->nested[$key2]->jumlah_pemangku != null) ? round($petjab[$key]->nested[$key2]->jumlah_pemangku) : 0; 
					$petjab[$key]->nested[$key2]->jumlah_kebutuhan_pegawai = $jumlah_kebutuhan_pegawai ? round($jumlah_kebutuhan_pegawai) : 0;

					if($petjab[$key]->nested[$key2]->nested){
						foreach($petjab[$key]->nested[$key2]->nested as $key3 => $value3){
							$petjab[$key]->nested[$key2]->nested[$key3]->nested = $this->daftarAnalisisJabatan->get_induk($petjab[$key]->nested[$key2]->nested[$key3]->id);
							$jenis_jabatan = $petjab[$key]->nested[$key2]->nested[$key3]->jenis_jabatan;
					
							$faktor_evaluasi = $this->refFaktorEvaluasi->get_all_ref(['jenis_jabatan' => ($jenis_jabatan == 'Pelaksana' ? 'Fungsional' : $jenis_jabatan)]);
							$arr = [];
					
							foreach($faktor_evaluasi as $i => $v){
								$arr[$i]['id'] = $v->id;
								$arr[$i]['number'] = $v->number;
								$arr[$i]['nama'] = $v->nama;
								$arr[$i]['uraian'] = $v->uraian;
								$arr[$i]['skor'] = $this->refFaktorEvaluasi->get_skor($value3->id, $v->id);
							}
							
							$nilai_evjab = 0;
							foreach($arr as $i){
								if(isset($i['skor'])){
									$nilai_evjab += $i['skor']->nilaiItem ? round($i['skor']->nilaiItem) : null;
								}
							}
							
							$kelas_jabatan = $this->refKelasJabatan->get_by_nilai($nilai_evjab);
							$kelas = ($kelas_jabatan) ? $kelas_jabatan->kelas : 0;
					
							$petjab[$key]->nested[$key2]->nested[$key3]->kelas = $kelas;
							$petjab[$key]->nested[$key2]->nested[$key3]->nilai_evjab = $arr;
				
							$hasil_kerja = $this->daftarAnalisisJabatan->get_all_hasil_kerja($petjab[$key]->nested[$key2]->nested[$key3]->id);
				
							$jumlah_beban_kerja = 0;
							$jumlah_kebutuhan_pegawai = 0;
				
							foreach($hasil_kerja as $i){ 
								$jumlah_hasil = $i->jumlah_hasil ?: 0;
								$waktu_penyelesaian = $i->waktu_penyelesaian ?: 0;
								$beban_kerja = $jumlah_hasil * $waktu_penyelesaian;
								$kebutuhan_pegawai = $jumlah_hasil * str_replace(',','.',$waktu_penyelesaian) / 1250;
								$jumlah_beban_kerja += $beban_kerja;
								$jumlah_kebutuhan_pegawai += $kebutuhan_pegawai;
				
							}
							$petjab[$key]->nested[$key2]->nested[$key3]->jumlah_pemangku = ($petjab[$key]->nested[$key2]->nested[$key3]->jumlah_pemangku != null) ? round($petjab[$key]->nested[$key2]->nested[$key3]->jumlah_pemangku) : 0; 
							$petjab[$key]->nested[$key2]->nested[$key3]->jumlah_kebutuhan_pegawai = $jumlah_kebutuhan_pegawai ? round($jumlah_kebutuhan_pegawai) : 0;

							if($petjab[$key]->nested[$key2]->nested[$key3]->nested){
								foreach($petjab[$key]->nested[$key2]->nested[$key3]->nested as $key4 => $value4){
									$jenis_jabatan = $petjab[$key]->nested[$key2]->nested[$key3]->nested[$key4]->jenis_jabatan;
							
									$faktor_evaluasi = $this->refFaktorEvaluasi->get_all_ref(['jenis_jabatan' => ($jenis_jabatan == 'Pelaksana' ? 'Fungsional' : $jenis_jabatan)]);
									$arr = [];
							
									foreach($faktor_evaluasi as $i => $v){
										$arr[$i]['id'] = $v->id;
										$arr[$i]['number'] = $v->number;
										$arr[$i]['nama'] = $v->nama;
										$arr[$i]['uraian'] = $v->uraian;
										$arr[$i]['skor'] = $this->refFaktorEvaluasi->get_skor($value4->id, $v->id);
									}
									
									$nilai_evjab = 0;
									foreach($arr as $i){
										if(isset($i['skor'])){
											$nilai_evjab += $i['skor']->nilaiItem ? round($i['skor']->nilaiItem) : null;
										}
									}
									
									$kelas_jabatan = $this->refKelasJabatan->get_by_nilai($nilai_evjab);
									$kelas = ($kelas_jabatan) ? $kelas_jabatan->kelas : 0;
							
									$petjab[$key]->nested[$key2]->nested[$key3]->nested[$key4]->kelas = $kelas;
									$petjab[$key]->nested[$key2]->nested[$key3]->nested[$key4]->nilai_evjab = $arr;
						
									$hasil_kerja = $this->daftarAnalisisJabatan->get_all_hasil_kerja($petjab[$key]->nested[$key2]->nested[$key3]->nested[$key4]->id);
						
									$jumlah_beban_kerja = 0;
									$jumlah_kebutuhan_pegawai = 0;
						
									foreach($hasil_kerja as $i){ 
										$jumlah_hasil = $i->jumlah_hasil ?: 0;
										$waktu_penyelesaian = $i->waktu_penyelesaian ?: 0;
										$beban_kerja = $jumlah_hasil * $waktu_penyelesaian;
										$kebutuhan_pegawai = $jumlah_hasil * str_replace(',','.',$waktu_penyelesaian) / 1250;
										$jumlah_beban_kerja += $beban_kerja;
										$jumlah_kebutuhan_pegawai += $kebutuhan_pegawai;
						
									}
									$petjab[$key]->nested[$key2]->nested[$key3]->nested[$key4]->jumlah_pemangku = ($petjab[$key]->nested[$key2]->nested[$key3]->nested[$key4]->jumlah_pemangku != null) ? round($petjab[$key]->nested[$key2]->nested[$key3]->nested[$key4]->jumlah_pemangku) : 0; 
									$petjab[$key]->nested[$key2]->nested[$key3]->nested[$key4]->jumlah_kebutuhan_pegawai = $jumlah_kebutuhan_pegawai ? round($jumlah_kebutuhan_pegawai) : 0;
								}
							}
						}
					}
				}
			}
		}

		$data['petjab'] = $petjab;
		// echo '<pre>';
		// print_r($petjab);
		// echo '</pre>';die;

		$this->load->view('admin/simanja/peta_jabatan/index2', $data);
	}

	public function peta_jabatan3($id)
	{
		$data['id'] = $id;
		$data['detail'] = $this->ref_skpd_model->get_by_id($id);
		$data['title']		= "Peta Jabatan";
		$data['content']	= "simanja/peta_jabatan/index3" ;
		$data['user_picture'] = $this->user_picture;
		$data['full_name']	= $this->full_name;
		$data['user_level']	= $this->user_level;
		$data['user_privileges'] = explode(';', $this->user_privileges);
		$data['active_menu'] = "simanja/peta_jabatan";

		$this->load->view('admin/index',$data);
	}

	public function fetch_peta_jabatan($id)
	{
		$data = $this->daftarAnalisisJabatan->get_by_skpd($id);
		
		foreach($data as $key => $value){
			$jenis_jabatan = $data[$key]->jenis_jabatan;
	
			$faktor_evaluasi = $this->refFaktorEvaluasi->get_all_ref(['jenis_jabatan' => ($jenis_jabatan == 'Pelaksana' ? 'Fungsional' : $jenis_jabatan)]);
			$arr = [];
	
			foreach($faktor_evaluasi as $i => $v){
				$arr[$i]['id'] = $v->id;
				$arr[$i]['number'] = $v->number;
				$arr[$i]['nama'] = $v->nama;
				$arr[$i]['uraian'] = $v->uraian;
				$arr[$i]['skor'] = $this->refFaktorEvaluasi->get_skor($value->id, $v->id);
				$arr[$i]['skor'] = $arr[$i]['skor'] ? round($arr[$i]['skor']) : null;
			}
			
			$nilai_evjab = 0;
			foreach($arr as $i){
				if(isset($i['skor'])){
					$nilai_evjab += $i['skor']->nilaiItem ? round($i['skor']->nilaiItem) : null;
				}
			}
	
			
			$kelas_jabatan = $this->refKelasJabatan->get_by_nilai($nilai_evjab);
			$kelas = ($kelas_jabatan) ? $kelas_jabatan->kelas : 0;
	
			$data[$key]->kelas = $kelas;
			$data[$key]->nilai_evjab = $arr;

			$hasil_kerja = $this->daftarAnalisisJabatan->get_all_hasil_kerja($data[$key]->id);

			$jumlah_beban_kerja = 0;
        	$jumlah_kebutuhan_pegawai = 0;

			foreach($hasil_kerja as $i){ 
				$jumlah_hasil = $i->jumlah_hasil ?: 0;
				$waktu_penyelesaian = $i->waktu_penyelesaian ?: 0;
				$beban_kerja = $jumlah_hasil * $waktu_penyelesaian;
				$kebutuhan_pegawai = $jumlah_hasil * str_replace(',','.',$waktu_penyelesaian) / 1250;
				$jumlah_beban_kerja += $beban_kerja;
				$jumlah_kebutuhan_pegawai += $kebutuhan_pegawai;

			}
			$data[$key]->jumlah_pemangku = ($data[$key]->jumlah_pemangku != null) ? round($data[$key]->jumlah_pemangku) : 0; 
			$data[$key]->jumlah_kebutuhan_pegawai = $jumlah_kebutuhan_pegawai ? round($jumlah_kebutuhan_pegawai) : 0;
		}

		echo json_encode($data);
	}

	public function fetch_pegawai($skpd){
		$pegawai = $this->pegawai_model->get_all_by_skpd($skpd);
		echo json_encode($pegawai);
	}

	public function fetch_unit_kerja($id){
		$detail = $this->daftarAnalisisJabatan->get_by_id($id);
		$unit_kerja = $this->daftarAnalisisJabatan->get_by_skpd($id, ['jenis_jabatan' => 'Struktural', 'jenis_pegawai' => 'JPT Pratama']);
		echo json_encode($unit_kerja);
	}

	public function fetch_jabatan($jenis_jabatan){
		$jabatan = $this->refJabatan->get_by_jenis($jenis_jabatan);
		echo json_encode($jabatan);
	}

	public function fetch_jabatan_id($id){
		$jabatan = $this->refJabatan->get_by_id($id);
		echo json_encode($jabatan);
	}

	public function fetch_unit_kerja_induk($id = '', $jenis_jabatan = ''){
		$unit_kerja = $this->daftarAnalisisJabatan->get_induk($id, $jenis_jabatan, 'Struktural');
		echo json_encode($unit_kerja);
	}

	public function fetch_unit_kerja_induk_type($id = '', $type = ''){
		$unit_kerja = $this->daftarAnalisisJabatan->get_jabatan_by_skpd_id_type($id, $type);
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
		if(isset($_POST['jenis_jabatan']) && $_POST['jenis_jabatan'] == 'Struktural'){
			if(isset($_POST['jenis_pegawai']) && $_POST['jenis_pegawai'] == 'Administrator'){
				$_POST['id_induk_jabatan'] = $_POST['jpt_pratama'] ?: $_POST['administrator'];
			}else if(isset($_POST['jenis_pegawai']) && $_POST['jenis_pegawai'] == 'Pengawas'){
				$_POST['id_induk_jabatan'] = $_POST['administrator'] ?: $_POST['pengawas'];
			}
		}else{
			if(isset($_POST['pengawas']) && $_POST['pengawas'] != '' ){
				$_POST['id_induk_jabatan'] = $_POST['pengawas'];
			}else if(isset($_POST['administrator']) && $_POST['administrator'] != ''){
				$_POST['id_induk_jabatan'] = $_POST['administrator'];
			}else if(isset($_POST['jpt_pratama']) && $_POST['jpt_pratama'] != ''){
				$_POST['id_induk_jabatan'] = $_POST['jpt_pratama'];
			}
		}
		$this->daftarAnalisisJabatan->update_ref($_POST,$id_ref);
		echo json_encode(array('status'=>true));
	}

	public function p_add_ref()
	{
		unset($_POST['_wysihtml5_mode']);
		if(isset($_POST['jenis_jabatan']) && $_POST['jenis_jabatan'] == 'Struktural'){
			if(isset($_POST['jenis_pegawai']) && $_POST['jenis_pegawai'] == 'Administrator'){
				$_POST['id_induk_jabatan'] = $_POST['jpt_pratama'];
			}else if(isset($_POST['jenis_pegawai']) && $_POST['jenis_pegawai'] == 'Pengawas'){
				$_POST['id_induk_jabatan'] = $_POST['administrator'] ?: $_POST['pengawas'];
			}
		}else{
			if(isset($_POST['pengawas']) && $_POST['pengawas'] != '' ){
				$_POST['id_induk_jabatan'] = $_POST['pengawas'];
			}else if(isset($_POST['administrator']) && $_POST['administrator'] != ''){
				$_POST['id_induk_jabatan'] = $_POST['administrator'];
			}else if(isset($_POST['jpt_pratama']) && $_POST['jpt_pratama'] != ''){
				$_POST['id_induk_jabatan'] = $_POST['jpt_pratama'];
			}
		}
		// print_r($_POST);
		$this->daftarAnalisisJabatan->insert_ref($_POST);
		echo json_encode(array('status'=>true));
	}

	public function delete_ref($id){
		$user_privileges = explode(';', $this->user_privileges);
		$this->sender->delete_anjab($id);
		$this->daftarAnalisisJabatan->delete_ref($id);
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
		$this->daftarAnalisisJabatan->delete_tugas_pokok($id);
		echo json_encode(array('status'=>true));
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
		$this->daftarAnalisisJabatan->delete_hasil_kerja($id);
		echo json_encode(array('status'=>true));
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
		$this->daftarAnalisisJabatan->delete_bahan_kerja($id);
		echo json_encode(array('status'=>true));
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
		$this->daftarAnalisisJabatan->delete_perangkat_kerja($id);
		echo json_encode(array('status'=>true));
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
		$this->daftarAnalisisJabatan->delete_tanggung_jawab($id);
		echo json_encode(array('status'=>true));
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
		$this->daftarAnalisisJabatan->delete_wewenang($id);
		echo json_encode(array('status'=>true));
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
		$this->daftarAnalisisJabatan->delete_korelasi_jabatan($id);
		echo json_encode(array('status'=>true));
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
		$this->daftarAnalisisJabatan->delete_kondisi_lingkungan_kerja($id);
		echo json_encode(array('status'=>true));
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
		$this->daftarAnalisisJabatan->delete_risiko_bahaya($id);
		echo json_encode(array('status'=>true));
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
		$this->daftarAnalisisJabatan->delete_syarat_keterampilan_kerja($id);
		echo json_encode(array('status'=>true));
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
					'id_bakat_kerja'	=> $i,
					'creator' => $this->user_id,
					'created_at' => date('Y-m-d H:i:s')
				); 	
			}
			$this->daftarAnalisisJabatan->insert_syarat_bakat_kerja_batch($temp_data);
		}
		echo json_encode(array('status'=>true));
	}
	
	public function delete_syarat_bakat_kerja($id){
		$this->daftarAnalisisJabatan->delete_syarat_bakat_kerja($id);
		echo json_encode(array('status'=>true));
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
					'id_temperamen_kerja'	=> $i,
					'creator' => $this->user_id,
					'created_at' => date('Y-m-d H:i:s')
				); 	
			}
			$this->daftarAnalisisJabatan->insert_syarat_temperamen_kerja_batch($temp_data);
		}
		echo json_encode(array('status'=>true));
	}
	
	public function delete_syarat_temperamen_kerja($id){
		$this->daftarAnalisisJabatan->delete_syarat_temperamen_kerja($id);
		echo json_encode(array('status'=>true));
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
					'id_minat_kerja'	=> $i,
					'creator' => $this->user_id,
					'created_at' => date('Y-m-d H:i:s')
				); 	
			}
			$this->daftarAnalisisJabatan->insert_syarat_minat_kerja_batch($temp_data);
		}
		echo json_encode(array('status'=>true));
	}
	
	public function delete_syarat_minat_kerja($id){
		$this->daftarAnalisisJabatan->delete_syarat_minat_kerja($id);
		echo json_encode(array('status'=>true));
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
					'id_upaya_fisik'	=> $i,
					'creator' => $this->user_id,
					'created_at' => date('Y-m-d H:i:s')
				); 	
			}
			$this->daftarAnalisisJabatan->insert_syarat_upaya_fisik_batch($temp_data);
		}
		echo json_encode(array('status'=>true));
	}
	
	public function delete_syarat_upaya_fisik($id){
		$this->daftarAnalisisJabatan->delete_syarat_upaya_fisik($id);
		echo json_encode(array('status'=>true));
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
		$this->daftarAnalisisJabatan->delete_syarat_kondisi_fisik($id);
		echo json_encode(array('status'=>true));
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
		$this->daftarAnalisisJabatan->delete_syarat_fungsi_pekerjaan($id);
		echo json_encode(array('status'=>true));
	}

	//Sender
	public function p_add_sender()
	{
		$id = $_POST['id_analisis_jabatan'];
		unset($_POST['_wysihtml5_mode']);
		$_POST['creator'] = $this->user_id;
		$_POST['created_at'] = date('Y-m-d H:i:s');
		$cek = $this->sender->cek_sender($id);
		if($cek){
			$this->sender->inactive($id);
		}
		$this->sender->insert($_POST);
		echo json_encode(array('status'=>true));
	}


	public function export_bkn($id)
	{
		$detail = $this->daftarAnalisisJabatan->get_by_id($id);
		$kualifikasi_jabatan = $this->daftarAnalisisJabatan->get_all_kualifikasi_jabatan($id, true);
		$tugas_pokok = $this->daftarAnalisisJabatan->get_all_tugas_pokok($id);
		$hasil_kerja = $this->daftarAnalisisJabatan->get_all_hasil_kerja($id);
		$bahan_kerja = $this->daftarAnalisisJabatan->get_all_bahan_kerja($id);
		$perangkat_kerja = $this->daftarAnalisisJabatan->get_all_perangkat_kerja($id);
		$tanggung_jawab = $this->daftarAnalisisJabatan->get_all_tanggung_jawab($id);
		$wewenang = $this->daftarAnalisisJabatan->get_all_wewenang($id);
		$korelasi_jabatan = $this->daftarAnalisisJabatan->get_all_korelasi_jabatan($id);
		$kondisi_lingkungan_kerja = $this->daftarAnalisisJabatan->get_all_kondisi_lingkungan_kerja($id, true);
		$risiko_bahaya = $this->daftarAnalisisJabatan->get_all_risiko_bahaya($id);

		$sender = $this->sender->cek_sender($id, true);

		if(!$kualifikasi_jabatan){
			$kualifikasi_jabatan[0] = (Object) [
				'pendidikan_formal' => '-',
				'diklat_perjejangan' => '-',
				'diklat_teknis' => '-',
				'pengalaman_kerja' => '-'
			];
		}

		if(!$kondisi_lingkungan_kerja){
			$kondisi_lingkungan_kerja[0] = (Object) [
				'tempat_kerja' => '-',
				'suhu' => '-',
				'udara' => '-',
				'keadaan_ruangan' => '-',
				'letak' => '-',
				'penerangan' => '-',
				'suara' => '-',
				'keadaan_tempat_kerja' => '-',
				'getaran' => '-'
			];
		}
		
		//Syarat
		$keterampilan_kerja = $this->daftarAnalisisJabatan->get_all_syarat_keterampilan_kerja($id);
		$bakat_kerja = $this->daftarAnalisisJabatan->get_all_syarat_bakat_kerja($id);
		$temperamen_kerja = $this->daftarAnalisisJabatan->get_all_syarat_temperamen_kerja($id);
		$minat_kerja = $this->daftarAnalisisJabatan->get_all_syarat_minat_kerja($id);
		$upaya_fisik = $this->daftarAnalisisJabatan->get_all_syarat_upaya_fisik($id);
		$kondisi_fisik = $this->daftarAnalisisJabatan->get_all_syarat_kondisi_fisik($id, true);
		$arrKategoriFungsiPekerjaan = ['Data','Orang','Benda'];
		foreach($arrKategoriFungsiPekerjaan as $value){
			$fungsi_pekerjaan[$value] = $this->daftarAnalisisJabatan->get_all_syarat_fungsi_by_category_and_id($value, $id);
		}

		$faktor_evaluasi = $this->refFaktorEvaluasi->get_all_ref(['jenis_jabatan' => ($detail->jenis_jabatan == 'Pelaksana' ? 'Fungsional' : $detail->jenis_jabatan)]);
		$arr = [];

		foreach($faktor_evaluasi as $i => $v){
			$arr[$i]['id'] = $v->id;
			$arr[$i]['number'] = $v->number;
			$arr[$i]['nama'] = $v->nama;
			$arr[$i]['uraian'] = $v->uraian;
			$arr[$i]['skor'] = $this->refFaktorEvaluasi->get_skor($id, $v->id);
		}
		
		$nilai_evjab = 0;
		foreach($arr as $i){
			if(isset($i['skor'])){
				$nilai_evjab += $i['skor']->nilaiItem;
			}
		}

		
		$kelas_jabatan = $this->refKelasJabatan->get_by_nilai($nilai_evjab);
		$kelas = ($kelas_jabatan) ? $kelas_jabatan->kelas : 0;
		
		$prestasi = 'Baik';
		if($kelas > 8){
			$prestasi = 'Sangat Baik';
		}

		if(!$kondisi_fisik){
			$kondisi_fisik[0] = (Object) [
				'jenis_kelamin' => '-',
				'umur' => '-',
				'tinggi_badan' => '-',
				'berat_badan' => '-',
				'postur_badan' => '-',
				'penampilan' => '-',
				'keadaan_fisik' => '-'
			];
		}

		$pdf = new Pdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		// $pdf->setPrintFooter(false);
		// $pdf->setPrintHeader(false);
		$pdf->SetTitle($detail->namaSkpd . '_' . time());
		$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 006', PDF_HEADER_STRING);
		$pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);
		$pdf->AddPage('');
		$pdf->SetFont('cid0jp', '', 9);

		$tabel = '
		<br>
		<br>
		<br>
        <table border="0">
              <tr>
					<td width="5%"></td> 
					<td width="40%"></td> 
					<td width="45%" style="text-align: left"><b>INFORMASI JABATAN</b></td> 
			  </tr>
			  <br>
              <tr>
					<td width="5%">1.</td> 
					<td width="40%"><b>NAMA JABATAN</b></td> 
					<td width="5%">:</td> 
					<td width="40%" style="text-align: left">'.$detail->nama.'</td> 
			  </tr>
			  <br>
              <tr>
					<td width="5%">2.</td> 
					<td width="40%"><b>KODE JABATAN</b></td> 
					<td width="5%">:</td> 
					<td width="40%" style="text-align: left"></td> 
			  </tr>
			  <br>
              <tr>
					<td width="5%">3.</td> 
					<td width="40%"><b>UNIT KERJA</b></td> 
					<td width="5%">:</td> 
					<td width="40%" style="text-align: left"></td> 
			  </tr>
              <tr>
					<td width="5%"></td> 
					<td width="40%">a.	&nbsp;JPT Pratama</td> 
					<td width="5%">:</td> 
					<td width="40%" style="text-align: left">'.$detail->namaJptPratama.'</td> 
			  </tr>
              <tr>
					<td width="5%"></td> 
					<td width="40%">b.	&nbsp;Administrator</td> 
					<td width="5%">:</td> 
					<td width="40%" style="text-align: left">'.$detail->namaAdministrator.'</td> 
			  </tr>
              <tr>
					<td width="5%"></td> 
					<td width="40%">c.	&nbsp;Pengawas</td> 
					<td width="5%">:</td> 
					<td width="40%" style="text-align: left">'.$detail->namaPengawas.'</td> 
			  </tr>
              <tr>
					<td width="5%"></td> 
					<td width="40%">d.	&nbsp;&nbsp;Pelaksana</td> 
					<td width="5%">:</td> 
					<td width="40%" style="text-align: left">'.$detail->pelaksana.'</td> 
			  </tr>
              <tr>
					<td width="5%"></td> 
					<td width="40%">e.	&nbsp;Jabatan Fungsional</td> 
					<td width="5%">:</td> 
					<td width="40%" style="text-align: left">'.$detail->jabatan_fungsional.'</td> 
			  </tr>
			  <br>
			  <tr>
					<td width="5%">4.</td> 
					<td width="40%"><b>IKHTISAR JABATAN</b></td> 
					<td width="5%">:</td> 
					<td width="40%" style="text-align: left"></td> 
			  </tr>
			  <tr>
			  		<td width="5%"></td>
			 		<td colspan="3">'.$detail->ikhtisar_jabatan.'</td> 
			  </tr>
			  <br>
			  <tr>
					<td width="5%">5.</td> 
					<td width="40%"><b>KUALIFIKASI JABATAN</b></td> 
					<td width="5%">:</td> 
					<td width="40%"></td> 
			  </tr>
			  <tr>
					<td width="5%"></td> 
					<td width="40%">a.	&nbsp;Pendidikan Formal</td> 
					<td width="5%">:</td> 
					<td width="40%" style="text-align: left">'.$kualifikasi_jabatan[0]->pendidikan_formal.'</td> 
			  </tr>
			  <tr>
					<td width="5%"></td> 
					<td width="40%">b.	&nbsp;Pendidikan dan Pelatihan</td> 
					<td width="5%">:</td> 
					<td width="40%" style="text-align: left"></td> 
			  </tr>
			  <tr>
					<td width="5%"></td> 
					<td width="40%">&nbsp;&nbsp;&nbsp;&nbsp;1) Diklat Penjenjangan</td> 
					<td width="5%">:</td> 
					<td width="40%" style="text-align: left">'.$kualifikasi_jabatan[0]->diklat_perjejangan.'</td> 
			  </tr>
			  <tr>
					<td width="5%"></td> 
					<td width="40%">&nbsp;&nbsp;&nbsp;&nbsp;2) Diklat Teknis</td> 
					<td width="5%">:</td> 
					<td width="40%" style="text-align: left">'.$kualifikasi_jabatan[0]->diklat_teknis.'</td> 
			  </tr>
			  <tr>
					<td width="5%"></td> 
					<td width="40%">c.	&nbsp;Pengalaman Kerja</td> 
					<td width="5%">:</td> 
					<td width="40%" style="text-align: left">'.$kualifikasi_jabatan[0]->pengalaman_kerja.'</td> 
			  </tr>
			  <br>
			  <tr>
					<td width="5%">6.</td> 
					<td width="40%"><b>TUGAS POKOK</b></td> 
			  </tr>
        </table>
		<br>
		<br>
		<table cellpadding="7">
			<tr style="background-color: #9FCE64">
				<th width="5%" style="background-color: white;border-right: 1px solid black;text-align"></th>
				<th style="border: 1px solid black;text-align: center;vertical-align: middle;width: 5%;">NO</th> 
				<th style="border: 1px solid black;text-align: center;vertical-align: middle;">URAIAN TUGAS</th> 
				<th style="border: 1px solid black;text-align: center;vertical-align: middle;">HASIL KERJA</th> 
				<th style="border: 1px solid black;text-align: center;vertical-align: middle;">JUMLAH HASIL</th> 
				<th style="border: 1px solid black;text-align: center;vertical-align: middle;">WAKTU PENYELESAIAN PER SATUAN HASIL KERJA</th> 
				<th style="border: 1px solid black;text-align: center;vertical-align: middle;">WAKTU EFEKTIF</th> 
				<th style="border: 1px solid black;text-align: center;vertical-align: middle;">KEBUTUHAN PEGAWAI</th> 
			</tr>';

		$no = 1;
		$jumlah = 0;
		foreach($hasil_kerja as $i){
			$jumlah_hasil = $i->jumlah_hasil ?: 0;
			$waktu_penyelesaian = $i->waktu_penyelesaian ?: 0;
			$kebutuhan_pegawai = $jumlah_hasil * str_replace(',','.',$waktu_penyelesaian) / 1250;
			$tabel .= '<tr>
							<td width="5%"></td>
							<td style="border: 1px solid black;text-align: center;vertical-align: middle;width: 5%;">'.$no++.'</td> 
							<td style="border: 1px solid black;text-align: center;vertical-align: middle;">'.$i->uraianTugas.'</td> 
							<td style="border: 1px solid black;text-align: center;vertical-align: middle;">'.$i->hasil_kerja.'</td> 
							<td style="border: 1px solid black;text-align: center;vertical-align: middle;">'.$i->jumlah_hasil.'</td> 
							<td style="border: 1px solid black;text-align: center;vertical-align: middle;">'.$i->waktu_penyelesaian.'</td> 
							<td style="border: 1px solid black;text-align: center;vertical-align: middle;">1250</td> 
							<td style="border: 1px solid black;text-align: center;vertical-align: middle;">'.$kebutuhan_pegawai.'</td> 
						</tr>';

			$jumlah += $kebutuhan_pegawai;
		}
		$jumlah_pegawai = round($jumlah);
		$tabel .= '<tr>
						<td width="5%"></td>
						<td style="border: 1px solid black;text-align" colspan="4">Jumlah</td>	
						<td style="border: 1px solid black;text-align"></td>
						<td style="border: 1px solid black;text-align"></td>
						<td style="border: 1px solid black;text-align">'.$jumlah.'</td>
					</tr>
					<tr>
						<td width="5%"></td>
						<td style="border: 1px solid black;text-align" colspan="4">Jumlah Pegawai</td>	
						<td style="border: 1px solid black;text-align"></td>
						<td style="border: 1px solid black;text-align"></td>
						<td style="border: 1px solid black;text-align">'.$jumlah_pegawai.'</td>
					</tr>'
					;

		$tabel .= '</table>';
		
		$tabel .= '
		<br>
		<br>
		<table>
			<tr>
				<td width="5%">7.</td> 
				<td width="40%"><b>HASIL KERJA</b></td> 
			</tr>
		</table>
		<br>
		<br>
		<table cellpadding="7">
				<tr style="background-color: #9FCE64">
					<th width="5%" style="background-color: white;border-right: 1px solid black;text-align"></th>
					<th style="border: 1px solid black;text-align: center;vertical-align: middle;width: 5%;">NO</th> 
					<th style="border: 1px solid black;text-align: center;vertical-align: middle;">HASIL KERJA</th> 
					<th style="border: 1px solid black;text-align: center;vertical-align: middle;">SATUAN HASIL</th> 
				</tr>';

				$no = 1;
				foreach($hasil_kerja as $i){
					$tabel .= '<tr>
									<td width="5%"></td>
									<td style="border: 1px solid black;text-align: center;vertical-align: middle;width: 5%;">'.$no++.'</td> 
									<td style="border: 1px solid black;text-align: center;vertical-align: middle;">'.$i->hasil_kerja.'</td> 
									<td style="border: 1px solid black;text-align: center;vertical-align: middle;">'.$i->satuan_hasil.'</td> 
								</tr>';
				}

		$tabel .= '</table>';

		$tabel .= '
		<br>
		<br>
		<table>
			<tr>
				<td width="5%">8.</td> 
				<td width="40%"><b>BAHAN KERJA</b></td> 
			</tr>
		</table>
		<br>
		<br>
		<table cellpadding="7">
				<tr style="background-color: #9FCE64">
					<th width="5%" style="background-color: white;border-right: 1px solid black;text-align"></th>
					<th style="border: 1px solid black;text-align: center;vertical-align: middle;width: 5%;">NO</th> 
					<th style="border: 1px solid black;text-align: center;vertical-align: middle;">BAHAN KERJA</th> 
					<th style="border: 1px solid black;text-align: center;vertical-align: middle;">PENGGUNAAN DALAM TUGAS</th> 
				</tr>';

				$no = 1;
				foreach($bahan_kerja as $i){
					$tabel .= '<tr>
									<td width="5%"></td>
									<td style="border: 1px solid black;text-align: center;vertical-align: middle;width: 5%;">'.$no++.'</td> 
									<td style="border: 1px solid black;text-align: center;vertical-align: middle;">'.$i->bahan_kerja.'</td> 
									<td style="border: 1px solid black;text-align: center;vertical-align: middle;">'.$i->penggunaan_dalam_tugas.'</td> 
								</tr>';
				}

		$tabel .= '</table>';

		$tabel .= '
		<br>
		<br>
		<table>
			<tr>
				<td width="5%">9.</td> 
				<td width="40%"><b>PERANGKAT KERJA</b></td> 
			</tr>
		</table>
		<br>
		<br>
		<table cellpadding="7">
				<tr style="background-color: #9FCE64">
					<th width="5%" style="background-color: white;border-right: 1px solid black;text-align"></th>
					<th style="border: 1px solid black;text-align: center;vertical-align: middle;width: 5%;">NO</th> 
					<th style="border: 1px solid black;text-align: center;vertical-align: middle;">BAHAN KERJA</th> 
					<th style="border: 1px solid black;text-align: center;vertical-align: middle;">PENGGUNAAN DALAM TUGAS</th> 
				</tr>';

				$no = 1;
				foreach($perangkat_kerja as $i){
					$tabel .= '<tr>
									<td width="5%"></td>
									<td style="border: 1px solid black;text-align: center;vertical-align: middle;width: 5%;">'.$no++.'</td> 
									<td style="border: 1px solid black;text-align: center;vertical-align: middle;">'.$i->perangkat_kerja.'</td> 
									<td style="border: 1px solid black;text-align: center;vertical-align: middle;">'.$i->penggunaan_dalam_tugas.'</td> 
								</tr>';
				}

		$tabel .= '</table>';

		$tabel .= '
		<br>
		<br>
		<table>
			<tr>
				<td width="5%">10.</td> 
				<td width="40%"><b>TANGGUNG JAWAB</b></td> 
			</tr>
		</table>
		<br>
		<br>
		<table cellpadding="7">
				<tr style="background-color: #9FCE64">
					<th width="5%" style="background-color: white;border-right: 1px solid black;text-align"></th>
					<th style="border: 1px solid black;text-align: center;vertical-align: middle;width: 5%;">NO</th> 
					<th style="border: 1px solid black;text-align: center;vertical-align: middle;">URAIAN</th> 
				</tr>';

				$no = 1;
				foreach($tanggung_jawab as $i){
					$tabel .= '<tr>
									<td width="5%"></td>
									<td style="border: 1px solid black;text-align: center;vertical-align: middle;width: 5%;">'.$no++.'</td> 
									<td style="border: 1px solid black;text-align: center;vertical-align: middle;">'.$i->tanggung_jawab.'</td> 
								</tr>';
				}

		$tabel .= '</table>';

		$tabel .= '
		<br>
		<br>
		<table>
			<tr>
				<td width="5%">11.</td> 
				<td width="40%"><b>WEWENANG</b></td> 
			</tr>
		</table>
		<br>
		<br>
		<table cellpadding="7">
				<tr style="background-color: #9FCE64">
					<th width="5%" style="background-color: white;border-right: 1px solid black;text-align"></th>
					<th style="border: 1px solid black;text-align: center;vertical-align: middle;width: 5%;">NO</th> 
					<th style="border: 1px solid black;text-align: center;vertical-align: middle;">URAIAN</th> 
				</tr>';

				$no = 1;
				foreach($wewenang as $i){
					$tabel .= '<tr>
									<td width="5%"></td>
									<td style="border: 1px solid black;text-align: center;vertical-align: middle;width: 5%;">'.$no++.'</td> 
									<td style="border: 1px solid black;text-align: center;vertical-align: middle;">'.$i->wewenang.'</td> 
								</tr>';
				}

		$tabel .= '</table>';

		$tabel .= '
		<br>
		<br>
		<table>
			<tr>
				<td width="5%">12.</td> 
				<td width="40%"><b>KORELASI JABATAN</b></td> 
			</tr>
		</table>
		<br>
		<br>
		<table cellpadding="7">
				<tr style="background-color: #9FCE64">
					<th width="5%" style="background-color: white;border-right: 1px solid black;text-align"></th>
					<th style="border: 1px solid black;text-align: center;vertical-align: middle;width: 5%;">NO</th> 
					<th style="border: 1px solid black;text-align: center;vertical-align: middle;">JABATAN</th> 
					<th style="border: 1px solid black;text-align: center;vertical-align: middle;">UNIT KERJA</th> 
					<th style="border: 1px solid black;text-align: center;vertical-align: middle;">DALAM HAL</th> 
				</tr>';

				$no = 1;
				foreach($korelasi_jabatan as $i){
					$tabel .= '<tr>
									<td width="5%"></td>
									<td style="border: 1px solid black;text-align: center;vertical-align: middle;width: 5%;">'.$no++.'</td> 
									<td style="border: 1px solid black;text-align: center;vertical-align: middle;">'.$i->jabatan.'</td> 
									<td style="border: 1px solid black;text-align: center;vertical-align: middle;">'.$i->unit_kerja.'</td> 
									<td style="border: 1px solid black;text-align: center;vertical-align: middle;">'.$i->hubungan_tugas.'</td> 
								</tr>';
				}

		$tabel .= '</table>';

		$tabel .= '
		<br>
		<br>
		<table>
			<tr>
				<td width="5%">13.</td> 
				<td width="40%"><b>KONDISI LINGKUNGAN KERJA</b></td> 
			</tr>
		</table>
		<br>
		<br>
		<table cellpadding="7">
				<tr style="background-color: #9FCE64">
					<th width="5%" style="background-color: white;border-right: 1px solid black;text-align"></th>
					<th style="border: 1px solid black;text-align: center;vertical-align: middle;width: 5%;">NO</th> 
					<th style="border: 1px solid black;text-align: center;vertical-align: middle;">ASPEK</th> 
					<th style="border: 1px solid black;text-align: center;vertical-align: middle;">KETERANGAN</th> 
				</tr>
				<tr>
					<td width="5%" style="background-color: white;border-right: 1px solid black;text-align"></td>
					<td style="border: 1px solid black;vertical-align: middle;">1.</td> 
					<td style="border: 1px solid black;vertical-align: middle;">Tempat Kerja</td> 
					<td style="border: 1px solid black;vertical-align: middle;">'.$kondisi_lingkungan_kerja[0]->tempat_kerja.'</td> 
				</tr>
				<tr>
					<td width="5%" style="background-color: white;border-right: 1px solid black;text-align"></td>
					<td style="border: 1px solid black;vertical-align: middle;">2.</td> 
					<td style="border: 1px solid black;vertical-align: middle;">Suhu</td> 
					<td style="border: 1px solid black;vertical-align: middle;">'.$kondisi_lingkungan_kerja[0]->suhu.'</td> 
				</tr>
				<tr>
					<td width="5%" style="background-color: white;border-right: 1px solid black;text-align"></td>
					<td style="border: 1px solid black;vertical-align: middle;">3.</td> 
					<td style="border: 1px solid black;vertical-align: middle;">Udara</td> 
					<td style="border: 1px solid black;vertical-align: middle;">'.$kondisi_lingkungan_kerja[0]->udara.'</td> 
				</tr>
				<tr>
					<td width="5%" style="background-color: white;border-right: 1px solid black;text-align"></td>
					<td style="border: 1px solid black;vertical-align: middle;">4.</td> 
					<td style="border: 1px solid black;vertical-align: middle;">Keadaan Ruangan</td> 
					<td style="border: 1px solid black;vertical-align: middle;">'.$kondisi_lingkungan_kerja[0]->keadaan_ruangan.'</td> 
				</tr>
				<tr>
					<td width="5%" style="background-color: white;border-right: 1px solid black;text-align"></td>
					<td style="border: 1px solid black;vertical-align: middle;">5.</td> 
					<td style="border: 1px solid black;vertical-align: middle;">Letak</td> 
					<td style="border: 1px solid black;vertical-align: middle;">'.$kondisi_lingkungan_kerja[0]->letak.'</td> 
				</tr>
				<tr>
					<td width="5%" style="background-color: white;border-right: 1px solid black;text-align"></td>
					<td style="border: 1px solid black;vertical-align: middle;">6.</td> 
					<td style="border: 1px solid black;vertical-align: middle;">Penerangan</td> 
					<td style="border: 1px solid black;vertical-align: middle;">'.$kondisi_lingkungan_kerja[0]->penerangan.'</td> 
				</tr>
				<tr>
					<td width="5%" style="background-color: white;border-right: 1px solid black;text-align"></td>
					<td style="border: 1px solid black;vertical-align: middle;">7.</td> 
					<td style="border: 1px solid black;vertical-align: middle;">Suara</td> 
					<td style="border: 1px solid black;vertical-align: middle;">'.$kondisi_lingkungan_kerja[0]->suara.'</td> 
				</tr>
				<tr>
					<td width="5%" style="background-color: white;border-right: 1px solid black;text-align"></td>
					<td style="border: 1px solid black;vertical-align: middle;">8.</td> 
					<td style="border: 1px solid black;vertical-align: middle;">Keadaan Tempat Kerja</td> 
					<td style="border: 1px solid black;vertical-align: middle;">'.$kondisi_lingkungan_kerja[0]->keadaan_tempat_kerja.'</td> 
				</tr>
				<tr>
					<td width="5%" style="background-color: white;border-right: 1px solid black;text-align"></td>
					<td style="border: 1px solid black;vertical-align: middle;">9.</td> 
					<td style="border: 1px solid black;vertical-align: middle;">Getaran</td> 
					<td style="border: 1px solid black;vertical-align: middle;">'.$kondisi_lingkungan_kerja[0]->getaran.'</td> 
				</tr>
				';

		$tabel .= '</table>';

		$tabel .= '
		<br>
		<br>
		<table>
			<tr>
				<td width="5%">14.</td> 
				<td width="40%"><b>RISIKO BAHAYA</b></td> 
			</tr>
		</table>
		<br>
		<br>
		<table cellpadding="7">
				<tr style="background-color: #9FCE64">
					<th width="5%" style="background-color: white;border-right: 1px solid black;text-align"></th>
					<th style="border: 1px solid black;text-align: center;vertical-align: middle;width: 5%;">NO</th> 
					<th style="border: 1px solid black;text-align: center;vertical-align: middle;">BAHAYA FISIK/ MENTAL</th> 
					<th style="border: 1px solid black;text-align: center;vertical-align: middle;">PENYEBAB</th> 
				</tr>';

				$no = 1;
				foreach($risiko_bahaya as $i){
					$tabel .= '<tr>
									<td width="5%"></td>
									<td style="border: 1px solid black;text-align: center;vertical-align: middle;width: 5%;">'.$no++.'</td> 
									<td style="border: 1px solid black;text-align: center;vertical-align: middle;">'.$i->risiko.'</td> 
									<td style="border: 1px solid black;text-align: center;vertical-align: middle;">'.$i->penyebab.'</td> 
								</tr>';
				}

		$tabel .= '</table>';

		$tabel .= '
		<br>
		<br>
		<table border="0">
					<tr>
						<td width="5%">15.</td> 
						<td width="40%"><b>SYARAT JABATAN</b></td> 
						<td width="5%">:</td> 
						<td width="40%" style="text-align: left"></td> 
					</tr>
					<tr>
						<td width="5%"></td> 
						<td width="40%">a.	&nbsp;Keterampilan Kerja</td> 
						<td width="5%">:</td> 
						<td width="40%" style="text-align: left">';
						$no = 1;
						$length = count($keterampilan_kerja);
						foreach($keterampilan_kerja as $i){
							$coma = '';
							if($no !== $length){
								$coma = ', ';
							}
							$no++;
							$tabel .= $i->keterampilan_kerja.''.$coma;
						}
		$tabel .=		'</td> 
					</tr>
					<tr>
						<td width="5%"></td> 
						<td width="40%">b.	&nbsp;Bakat Kerja</td> 
						<td width="5%">:</td> 
						<td width="40%" style="text-align: left"></td>
					</tr>';
					$no = 1;
					foreach($bakat_kerja as $i){
						$tabel .= '<tr>
										<td width="5%"></td>
										<td width="40%"></td>
										<td width="5%"></td>
										<td width="2%">'.$no++.')</td>
										<td>'.$i->kode_bakat_kerja.' = '.$i->bakat_kerja.'</td> 
									</tr>';
						}
		$tabel .= '<tr>
						<td width="5%"></td> 
						<td width="40%">c.	&nbsp;Temperamen Kerja</td> 
						<td width="5%">:</td> 
						<td width="40%" style="text-align: left"></td>
					</tr>';
					$no = 1;
					foreach($temperamen_kerja as $i){
						$tabel .= '<tr>
										<td width="5%"></td>
										<td width="40%"></td>
										<td width="5%"></td>
										<td width="2%">'.$no++.')</td>
										<td>'.$i->kode_temperamen_kerja.' = '.$i->temperamen_kerja.'</td> 
									</tr>';
						}
		$tabel .= '<tr>
						<td width="5%"></td> 
						<td width="40%">d.	&nbsp;Minat Kerja</td> 
						<td width="5%">:</td> 
						<td width="40%" style="text-align: left"></td>
					</tr>';
					$no = 1;
					foreach($minat_kerja as $i){
						$tabel .= '<tr>
										<td width="5%"></td>
										<td width="40%"></td>
										<td width="5%"></td>
										<td width="2%">'.$no++.')</td>
										<td>'.$i->kode_minat_kerja.' = '.$i->minat_kerja.'</td> 
									</tr>';
						}
		$tabel .= '<tr>
						<td width="5%"></td> 
						<td width="40%">e.	&nbsp;Upaya Fisik</td> 
						<td width="5%">:</td> 
						<td width="40%" style="text-align: left"></td>
					</tr>';
					$no = 1;
					foreach($upaya_fisik as $i){
						$tabel .= '<tr>
										<td width="5%"></td>
										<td width="40%"></td>
										<td width="5%"></td>
										<td width="2%">'.$no++.')</td>
										<td>'.$i->kode_upaya_fisik.' = '.$i->upaya_fisik.'</td> 
									</tr>';
						}
		$tabel .= '<tr>
						<td width="5%"></td> 
						<td width="40%">f.	&nbsp;Kondisi Fisik</td> 
						<td width="5%">:</td> 
						<td width="40%" style="text-align: left"></td>
					</tr>
					<tr>
						<td width="5%"></td> 
						<td width="40%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1) &nbsp;Jenis Kelamin</td> 
						<td width="5%">:</td> 
						<td width="40%" style="text-align: left">'.$kondisi_fisik[0]->jenis_kelamin.'</td>
					</tr>
					<tr>
						<td width="5%"></td> 
						<td width="40%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2) &nbsp;Umur</td> 
						<td width="5%">:</td> 
						<td width="40%" style="text-align: left">'.$kondisi_fisik[0]->umur.'</td>
					</tr>
					<tr>
						<td width="5%"></td> 
						<td width="40%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;3) &nbsp;Tinggi Badan</td> 
						<td width="5%">:</td> 
						<td width="40%" style="text-align: left">'.$kondisi_fisik[0]->tinggi_badan.'</td>
					</tr>
					<tr>
						<td width="5%"></td> 
						<td width="40%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;4) &nbsp;Berat Badan</td> 
						<td width="5%">:</td> 
						<td width="40%" style="text-align: left">'.$kondisi_fisik[0]->berat_badan.'</td>
					</tr>
					<tr>
						<td width="5%"></td> 
						<td width="40%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;5) &nbsp;Postur Tubuh</td> 
						<td width="5%">:</td> 
						<td width="40%" style="text-align: left">'.$kondisi_fisik[0]->postur_badan.'</td>
					</tr>
					<tr>
						<td width="5%"></td> 
						<td width="40%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;6) &nbsp;Penampilan</td> 
						<td width="5%">:</td> 
						<td width="40%" style="text-align: left">'.$kondisi_fisik[0]->penampilan.'</td>
					</tr>
					<tr>
						<td width="5%"></td> 
						<td width="40%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;7) &nbsp;Keadaan Fisik</td> 
						<td width="5%">:</td> 
						<td width="40%" style="text-align: left">'.$kondisi_fisik[0]->keadaan_fisik.'</td>
					</tr>
					';
		$tabel .= '<tr>
					<td width="5%"></td> 
					<td width="40%">g.	&nbsp;Fungsi Pekerjaan</td> 
					<td width="5%">:</td> 
					<td width="40%" style="text-align: left"></td>
				</tr>
				<tr>
					<td width="5%"></td>
					<td width="40%"></td>
					<td width="5%"></td>
					<td width="5%">Data</td>
					<td width="2%">:</td>
				</tr>';
					$no = 1;
					foreach($fungsi_pekerjaan['Data'] as $value){
							$tabel .= '	<tr>
											<td width="5%"></td>
											<td width="40%"></td>
											<td width="5%"></td>
											<td width="5%">'.$no++.')</td>
											<td width="30%">'.$value->fungsi_pekerjaan.'</td>
										</tr>';
					}
	$tabel .= 	'<tr>
					<td width="5%"></td>
					<td width="40%"></td>
					<td width="5%"></td>
					<td width="5%">Orang</td>
					<td width="2%">:</td>
					<td width="30%"></td>
					<td></td> 
					</tr>';
					$no = 1;
					foreach($fungsi_pekerjaan['Orang'] as $value){
							$tabel .= '	<tr>
											<td width="5%"></td>
											<td width="40%"></td>
											<td width="5%"></td>
											<td width="5%">'.$no++.')</td>
											<td width="30%">'.$value->fungsi_pekerjaan.'</td>
										</tr>';
					}
	$tabel .= 	'<tr>
					<td width="5%"></td>
					<td width="40%"></td>
					<td width="5%"></td>
					<td width="5%">Benda</td>
					<td width="2%">:</td>
					<td width="30%"></td>
					<td></td> 
					</tr>';
					$no = 1;
					foreach($fungsi_pekerjaan['Benda'] as $value){
							$tabel .= '	<tr>
											<td width="5%"></td>
											<td width="40%"></td>
											<td width="5%"></td>
											<td width="5%">'.$no++.')</td>
											<td width="30%">'.$value->fungsi_pekerjaan.'</td>
										</tr>';
					}
		$tabel .= '</table>';

		$tabel .= '
				<br>
				<br>
				<table border="0">
							<tr>
								<td width="5%">16.</td> 
								<td width="40%"><b>PRESTASI KERJA YANG DIHARAPKAN</b></td> 
								<td width="5%">:</td> 
								<td width="40%" style="text-align: left">'.$prestasi.'</td> 
							</tr>
							<br>
							<br>
							<tr>
								<td width="5%">17.</td> 
								<td width="40%"><b>KELAS</b></td> 
								<td width="5%">:</td> 
								<td width="40%" style="text-align: left">'.$kelas.'</td> 
							</tr>
				</table>';

		$tabel .= '
				<br>
				<br>
				<br>
				<br>
				<table border="0">
							<tr>
								<td width="50%" style="text-align: center"></td>
								<td width="50%" style="text-align: center">Kabupaten Sumedang, '.date('j F Y').'</td>
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

		$pdf->writeHTML($tabel);
		
		ob_clean();
		$pdf->Output($_SERVER['DOCUMENT_ROOT'] . 'data/analisis_jabatan/' . str_replace(array('-','/'),'_',$detail->nama) . '_' . time() . '.pdf', 'FI');
	}

	public function export_bkn_ver1f($id)
	{
		$detail = $this->daftarAnalisisJabatan->get_by_id($id);
		$kualifikasi_jabatan = $this->daftarAnalisisJabatan->get_all_kualifikasi_jabatan($id, true);
		$tugas_pokok = $this->daftarAnalisisJabatan->get_all_tugas_pokok($id);
		$hasil_kerja = $this->daftarAnalisisJabatan->get_all_hasil_kerja($id);
		$bahan_kerja = $this->daftarAnalisisJabatan->get_all_bahan_kerja($id);
		$perangkat_kerja = $this->daftarAnalisisJabatan->get_all_perangkat_kerja($id);
		$tanggung_jawab = $this->daftarAnalisisJabatan->get_all_tanggung_jawab($id);
		$wewenang = $this->daftarAnalisisJabatan->get_all_wewenang($id);
		$korelasi_jabatan = $this->daftarAnalisisJabatan->get_all_korelasi_jabatan($id);
		$kondisi_lingkungan_kerja = $this->daftarAnalisisJabatan->get_all_kondisi_lingkungan_kerja($id, true);
		$risiko_bahaya = $this->daftarAnalisisJabatan->get_all_risiko_bahaya($id);

		$sender = $this->sender->cek_sender($id, true);

		if(!$kualifikasi_jabatan){
			$kualifikasi_jabatan[0] = (Object) [
				'pendidikan_formal' => '-',
				'diklat_perjejangan' => '-',
				'diklat_teknis' => '-',
				'pengalaman_kerja' => '-'
			];
		}

		if(!$kondisi_lingkungan_kerja){
			$kondisi_lingkungan_kerja[0] = (Object) [
				'tempat_kerja' => '-',
				'suhu' => '-',
				'udara' => '-',
				'keadaan_ruangan' => '-',
				'letak' => '-',
				'penerangan' => '-',
				'suara' => '-',
				'keadaan_tempat_kerja' => '-',
				'getaran' => '-'
			];
		}
		
		//Syarat
		$keterampilan_kerja = $this->daftarAnalisisJabatan->get_all_syarat_keterampilan_kerja($id);
		$bakat_kerja = $this->daftarAnalisisJabatan->get_all_syarat_bakat_kerja($id);
		$temperamen_kerja = $this->daftarAnalisisJabatan->get_all_syarat_temperamen_kerja($id);
		$minat_kerja = $this->daftarAnalisisJabatan->get_all_syarat_minat_kerja($id);
		$upaya_fisik = $this->daftarAnalisisJabatan->get_all_syarat_upaya_fisik($id);
		$kondisi_fisik = $this->daftarAnalisisJabatan->get_all_syarat_kondisi_fisik($id, true);
		$arrKategoriFungsiPekerjaan = ['Data','Orang','Benda'];
		foreach($arrKategoriFungsiPekerjaan as $value){
			$fungsi_pekerjaan[$value] = $this->daftarAnalisisJabatan->get_all_syarat_fungsi_by_category_and_id($value, $id);
		}

		$faktor_evaluasi = $this->refFaktorEvaluasi->get_all_ref(['jenis_jabatan' => ($detail->jenis_jabatan == 'Pelaksana' ? 'Fungsional' : $detail->jenis_jabatan)]);
		$arr = [];

		foreach($faktor_evaluasi as $i => $v){
			$arr[$i]['id'] = $v->id;
			$arr[$i]['number'] = $v->number;
			$arr[$i]['nama'] = $v->nama;
			$arr[$i]['uraian'] = $v->uraian;
			$arr[$i]['skor'] = $this->refFaktorEvaluasi->get_skor($id, $v->id);
		}
		
		$nilai_evjab = 0;
		foreach($arr as $i){
			if(isset($i['skor'])){
				$nilai_evjab += $i['skor']->nilaiItem;
			}
		}

		
		$kelas_jabatan = $this->refKelasJabatan->get_by_nilai($nilai_evjab);
		$kelas = ($kelas_jabatan) ? $kelas_jabatan->kelas : 0;
		
		$prestasi = 'Baik';
		if($kelas > 8){
			$prestasi = 'Sangat Baik';
		}

		if(!$kondisi_fisik){
			$kondisi_fisik[0] = (Object) [
				'jenis_kelamin' => '-',
				'umur' => '-',
				'tinggi_badan' => '-',
				'berat_badan' => '-',
				'postur_badan' => '-',
				'penampilan' => '-',
				'keadaan_fisik' => '-'
			];
		}

		$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		// $pdf->setPrintFooter(false);
		// $pdf->setPrintHeader(false);
		$pdf->SetTitle($detail->namaSkpd . '_' . time());
		// $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 006', PDF_HEADER_STRING);
		$pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);
		$pdf->AddPage('');
		$pdf->SetFont('cid0jp', '', 9);

		$tabel = '
		<br>
		<br>
		<br>
        <table border="0">
              <tr>
					<td width="5%"></td> 
					<td width="40%"></td> 
					<td width="45%" style="text-align: left"><b>INFORMASI JABATAN</b></td> 
			  </tr>
			  <br>
              <tr>
					<td width="5%">1.</td> 
					<td width="40%"><b>NAMA JABATAN</b></td> 
					<td width="5%">:</td> 
					<td width="40%" style="text-align: left">'.$detail->nama.'</td> 
			  </tr>
			  <br>
              <tr>
					<td width="5%">2.</td> 
					<td width="40%"><b>KODE JABATAN</b></td> 
					<td width="5%">:</td> 
					<td width="40%" style="text-align: left"></td> 
			  </tr>
			  <br>
              <tr>
					<td width="5%">3.</td> 
					<td width="40%"><b>UNIT KERJA</b></td> 
					<td width="5%">:</td> 
					<td width="40%" style="text-align: left"></td> 
			  </tr>
              <tr>
					<td width="5%"></td> 
					<td width="40%">a.	&nbsp;JPT Pratama</td> 
					<td width="5%">:</td> 
					<td width="40%" style="text-align: left">'.$detail->namaJptPratama.'</td> 
			  </tr>
              <tr>
					<td width="5%"></td> 
					<td width="40%">b.	&nbsp;Administrator</td> 
					<td width="5%">:</td> 
					<td width="40%" style="text-align: left">'.$detail->namaAdministrator.'</td> 
			  </tr>
              <tr>
					<td width="5%"></td> 
					<td width="40%">c.	&nbsp;Pengawas</td> 
					<td width="5%">:</td> 
					<td width="40%" style="text-align: left">'.$detail->namaPengawas.'</td> 
			  </tr>
              <tr>
					<td width="5%"></td> 
					<td width="40%">d.	&nbsp;&nbsp;Pelaksana</td> 
					<td width="5%">:</td> 
					<td width="40%" style="text-align: left">'.$detail->pelaksana.'</td> 
			  </tr>
              <tr>
					<td width="5%"></td> 
					<td width="40%">e.	&nbsp;Jabatan Fungsional</td> 
					<td width="5%">:</td> 
					<td width="40%" style="text-align: left">'.$detail->jabatan_fungsional.'</td> 
			  </tr>
			  <br>
			  <tr>
					<td width="5%">4.</td> 
					<td width="40%"><b>IKHTISAR JABATAN</b></td> 
					<td width="5%">:</td> 
					<td width="40%" style="text-align: left"></td> 
			  </tr>
			  <tr>
			  		<td width="5%"></td>
			 		<td colspan="3">'.$detail->ikhtisar_jabatan.'</td> 
			  </tr>
			  <br>
			  <tr>
					<td width="5%">5.</td> 
					<td width="40%"><b>KUALIFIKASI JABATAN</b></td> 
					<td width="5%">:</td> 
					<td width="40%"></td> 
			  </tr>
			  <tr>
					<td width="5%"></td> 
					<td width="40%">a.	&nbsp;Pendidikan Formal</td> 
					<td width="5%">:</td> 
					<td width="40%" style="text-align: left">'.$kualifikasi_jabatan[0]->pendidikan_formal.'</td> 
			  </tr>
			  <tr>
					<td width="5%"></td> 
					<td width="40%">b.	&nbsp;Pendidikan dan Pelatihan</td> 
					<td width="5%">:</td> 
					<td width="40%" style="text-align: left"></td> 
			  </tr>
			  <tr>
					<td width="5%"></td> 
					<td width="40%">&nbsp;&nbsp;&nbsp;&nbsp;1) Diklat Penjenjangan</td> 
					<td width="5%">:</td> 
					<td width="40%" style="text-align: left">'.$kualifikasi_jabatan[0]->diklat_perjejangan.'</td> 
			  </tr>
			  <tr>
					<td width="5%"></td> 
					<td width="40%">&nbsp;&nbsp;&nbsp;&nbsp;2) Diklat Teknis</td> 
					<td width="5%">:</td> 
					<td width="40%" style="text-align: left">'.$kualifikasi_jabatan[0]->diklat_teknis.'</td> 
			  </tr>
			  <tr>
					<td width="5%"></td> 
					<td width="40%">c.	&nbsp;Pengalaman Kerja</td> 
					<td width="5%">:</td> 
					<td width="40%" style="text-align: left">'.$kualifikasi_jabatan[0]->pengalaman_kerja.'</td> 
			  </tr>
			  <br>
			  <tr>
					<td width="5%">6.</td> 
					<td width="40%"><b>TUGAS POKOK</b></td> 
			  </tr>
        </table>
		<br>
		<br>
		<table cellpadding="7">
			<tr style="background-color: #9FCE64">
				<th width="5%" style="background-color: white;border-right: 1px solid black;text-align"></th>
				<th style="border: 1px solid black;text-align: center;vertical-align: middle;width: 5%;">NO</th> 
				<th style="border: 1px solid black;text-align: center;vertical-align: middle;">URAIAN TUGAS</th> 
				<th style="border: 1px solid black;text-align: center;vertical-align: middle;">HASIL KERJA</th> 
				<th style="border: 1px solid black;text-align: center;vertical-align: middle;">JUMLAH HASIL</th> 
				<th style="border: 1px solid black;text-align: center;vertical-align: middle;">WAKTU PENYELESAIAN PER SATUAN HASIL KERJA</th> 
				<th style="border: 1px solid black;text-align: center;vertical-align: middle;">WAKTU EFEKTIF</th> 
				<th style="border: 1px solid black;text-align: center;vertical-align: middle;">KEBUTUHAN PEGAWAI</th> 
			</tr>';

		$no = 1;
		$jumlah = 0;
		foreach($hasil_kerja as $i){
			$jumlah_hasil = $i->jumlah_hasil ?: 0;
			$waktu_penyelesaian = $i->waktu_penyelesaian ?: 0;
			$kebutuhan_pegawai = $jumlah_hasil * str_replace(',','.',$waktu_penyelesaian) / 1250;
			$tabel .= '<tr>
							<td width="5%"></td>
							<td style="border: 1px solid black;text-align: center;vertical-align: middle;width: 5%;">'.$no++.'</td> 
							<td style="border: 1px solid black;text-align: center;vertical-align: middle;">'.$i->uraianTugas.'</td> 
							<td style="border: 1px solid black;text-align: center;vertical-align: middle;">'.$i->hasil_kerja.'</td> 
							<td style="border: 1px solid black;text-align: center;vertical-align: middle;">'.$i->jumlah_hasil.'</td> 
							<td style="border: 1px solid black;text-align: center;vertical-align: middle;">'.$i->waktu_penyelesaian.'</td> 
							<td style="border: 1px solid black;text-align: center;vertical-align: middle;">1250</td> 
							<td style="border: 1px solid black;text-align: center;vertical-align: middle;">'.$kebutuhan_pegawai.'</td> 
						</tr>';

			$jumlah += $kebutuhan_pegawai;
		}
		$jumlah_pegawai = round($jumlah);
		$tabel .= '<tr>
						<td width="5%"></td>
						<td style="border: 1px solid black;text-align" colspan="4">Jumlah</td>	
						<td style="border: 1px solid black;text-align"></td>
						<td style="border: 1px solid black;text-align"></td>
						<td style="border: 1px solid black;text-align">'.$jumlah.'</td>
					</tr>
					<tr>
						<td width="5%"></td>
						<td style="border: 1px solid black;text-align" colspan="4">Jumlah Pegawai</td>	
						<td style="border: 1px solid black;text-align"></td>
						<td style="border: 1px solid black;text-align"></td>
						<td style="border: 1px solid black;text-align">'.$jumlah_pegawai.'</td>
					</tr>'
					;

		$tabel .= '</table>';
		
		$tabel .= '
		<br>
		<br>
		<table>
			<tr>
				<td width="5%">7.</td> 
				<td width="40%"><b>HASIL KERJA</b></td> 
			</tr>
		</table>
		<br>
		<br>
		<table cellpadding="7">
				<tr style="background-color: #9FCE64">
					<th width="5%" style="background-color: white;border-right: 1px solid black;text-align"></th>
					<th style="border: 1px solid black;text-align: center;vertical-align: middle;width: 5%;">NO</th> 
					<th style="border: 1px solid black;text-align: center;vertical-align: middle;">HASIL KERJA</th> 
					<th style="border: 1px solid black;text-align: center;vertical-align: middle;">SATUAN HASIL</th> 
				</tr>';

				$no = 1;
				foreach($hasil_kerja as $i){
					$tabel .= '<tr>
									<td width="5%"></td>
									<td style="border: 1px solid black;text-align: center;vertical-align: middle;width: 5%;">'.$no++.'</td> 
									<td style="border: 1px solid black;text-align: center;vertical-align: middle;">'.$i->hasil_kerja.'</td> 
									<td style="border: 1px solid black;text-align: center;vertical-align: middle;">'.$i->satuan_hasil.'</td> 
								</tr>';
				}

		$tabel .= '</table>';

		$tabel .= '
		<br>
		<br>
		<table>
			<tr>
				<td width="5%">8.</td> 
				<td width="40%"><b>BAHAN KERJA</b></td> 
			</tr>
		</table>
		<br>
		<br>
		<table cellpadding="7">
				<tr style="background-color: #9FCE64">
					<th width="5%" style="background-color: white;border-right: 1px solid black;text-align"></th>
					<th style="border: 1px solid black;text-align: center;vertical-align: middle;width: 5%;">NO</th> 
					<th style="border: 1px solid black;text-align: center;vertical-align: middle;">BAHAN KERJA</th> 
					<th style="border: 1px solid black;text-align: center;vertical-align: middle;">PENGGUNAAN DALAM TUGAS</th> 
				</tr>';

				$no = 1;
				foreach($bahan_kerja as $i){
					$tabel .= '<tr>
									<td width="5%"></td>
									<td style="border: 1px solid black;text-align: center;vertical-align: middle;width: 5%;">'.$no++.'</td> 
									<td style="border: 1px solid black;text-align: center;vertical-align: middle;">'.$i->bahan_kerja.'</td> 
									<td style="border: 1px solid black;text-align: center;vertical-align: middle;">'.$i->penggunaan_dalam_tugas.'</td> 
								</tr>';
				}

		$tabel .= '</table>';

		$tabel .= '
		<br>
		<br>
		<table>
			<tr>
				<td width="5%">9.</td> 
				<td width="40%"><b>PERANGKAT KERJA</b></td> 
			</tr>
		</table>
		<br>
		<br>
		<table cellpadding="7">
				<tr style="background-color: #9FCE64">
					<th width="5%" style="background-color: white;border-right: 1px solid black;text-align"></th>
					<th style="border: 1px solid black;text-align: center;vertical-align: middle;width: 5%;">NO</th> 
					<th style="border: 1px solid black;text-align: center;vertical-align: middle;">BAHAN KERJA</th> 
					<th style="border: 1px solid black;text-align: center;vertical-align: middle;">PENGGUNAAN DALAM TUGAS</th> 
				</tr>';

				$no = 1;
				foreach($perangkat_kerja as $i){
					$tabel .= '<tr>
									<td width="5%"></td>
									<td style="border: 1px solid black;text-align: center;vertical-align: middle;width: 5%;">'.$no++.'</td> 
									<td style="border: 1px solid black;text-align: center;vertical-align: middle;">'.$i->perangkat_kerja.'</td> 
									<td style="border: 1px solid black;text-align: center;vertical-align: middle;">'.$i->penggunaan_dalam_tugas.'</td> 
								</tr>';
				}

		$tabel .= '</table>';

		$tabel .= '
		<br>
		<br>
		<table>
			<tr>
				<td width="5%">10.</td> 
				<td width="40%"><b>TANGGUNG JAWAB</b></td> 
			</tr>
		</table>
		<br>
		<br>
		<table cellpadding="7">
				<tr style="background-color: #9FCE64">
					<th width="5%" style="background-color: white;border-right: 1px solid black;text-align"></th>
					<th style="border: 1px solid black;text-align: center;vertical-align: middle;width: 5%;">NO</th> 
					<th style="border: 1px solid black;text-align: center;vertical-align: middle;">URAIAN</th> 
				</tr>';

				$no = 1;
				foreach($tanggung_jawab as $i){
					$tabel .= '<tr>
									<td width="5%"></td>
									<td style="border: 1px solid black;text-align: center;vertical-align: middle;width: 5%;">'.$no++.'</td> 
									<td style="border: 1px solid black;text-align: center;vertical-align: middle;">'.$i->tanggung_jawab.'</td> 
								</tr>';
				}

		$tabel .= '</table>';

		$tabel .= '
		<br>
		<br>
		<table>
			<tr>
				<td width="5%">11.</td> 
				<td width="40%"><b>WEWENANG</b></td> 
			</tr>
		</table>
		<br>
		<br>
		<table cellpadding="7">
				<tr style="background-color: #9FCE64">
					<th width="5%" style="background-color: white;border-right: 1px solid black;text-align"></th>
					<th style="border: 1px solid black;text-align: center;vertical-align: middle;width: 5%;">NO</th> 
					<th style="border: 1px solid black;text-align: center;vertical-align: middle;">URAIAN</th> 
				</tr>';

				$no = 1;
				foreach($wewenang as $i){
					$tabel .= '<tr>
									<td width="5%"></td>
									<td style="border: 1px solid black;text-align: center;vertical-align: middle;width: 5%;">'.$no++.'</td> 
									<td style="border: 1px solid black;text-align: center;vertical-align: middle;">'.$i->wewenang.'</td> 
								</tr>';
				}

		$tabel .= '</table>';

		$tabel .= '
		<br>
		<br>
		<table>
			<tr>
				<td width="5%">12.</td> 
				<td width="40%"><b>KORELASI JABATAN</b></td> 
			</tr>
		</table>
		<br>
		<br>
		<table cellpadding="7">
				<tr style="background-color: #9FCE64">
					<th width="5%" style="background-color: white;border-right: 1px solid black;text-align"></th>
					<th style="border: 1px solid black;text-align: center;vertical-align: middle;width: 5%;">NO</th> 
					<th style="border: 1px solid black;text-align: center;vertical-align: middle;">JABATAN</th> 
					<th style="border: 1px solid black;text-align: center;vertical-align: middle;">UNIT KERJA</th> 
					<th style="border: 1px solid black;text-align: center;vertical-align: middle;">DALAM HAL</th> 
				</tr>';

				$no = 1;
				foreach($korelasi_jabatan as $i){
					$tabel .= '<tr>
									<td width="5%"></td>
									<td style="border: 1px solid black;text-align: center;vertical-align: middle;width: 5%;">'.$no++.'</td> 
									<td style="border: 1px solid black;text-align: center;vertical-align: middle;">'.$i->jabatan.'</td> 
									<td style="border: 1px solid black;text-align: center;vertical-align: middle;">'.$i->unit_kerja.'</td> 
									<td style="border: 1px solid black;text-align: center;vertical-align: middle;">'.$i->hubungan_tugas.'</td> 
								</tr>';
				}

		$tabel .= '</table>';

		$tabel .= '
		<br>
		<br>
		<table>
			<tr>
				<td width="5%">13.</td> 
				<td width="40%"><b>KONDISI LINGKUNGAN KERJA</b></td> 
			</tr>
		</table>
		<br>
		<br>
		<table cellpadding="7">
				<tr style="background-color: #9FCE64">
					<th width="5%" style="background-color: white;border-right: 1px solid black;text-align"></th>
					<th style="border: 1px solid black;text-align: center;vertical-align: middle;width: 5%;">NO</th> 
					<th style="border: 1px solid black;text-align: center;vertical-align: middle;">ASPEK</th> 
					<th style="border: 1px solid black;text-align: center;vertical-align: middle;">KETERANGAN</th> 
				</tr>
				<tr>
					<td width="5%" style="background-color: white;border-right: 1px solid black;text-align"></td>
					<td style="border: 1px solid black;vertical-align: middle;">1.</td> 
					<td style="border: 1px solid black;vertical-align: middle;">Tempat Kerja</td> 
					<td style="border: 1px solid black;vertical-align: middle;">'.$kondisi_lingkungan_kerja[0]->tempat_kerja.'</td> 
				</tr>
				<tr>
					<td width="5%" style="background-color: white;border-right: 1px solid black;text-align"></td>
					<td style="border: 1px solid black;vertical-align: middle;">2.</td> 
					<td style="border: 1px solid black;vertical-align: middle;">Suhu</td> 
					<td style="border: 1px solid black;vertical-align: middle;">'.$kondisi_lingkungan_kerja[0]->suhu.'</td> 
				</tr>
				<tr>
					<td width="5%" style="background-color: white;border-right: 1px solid black;text-align"></td>
					<td style="border: 1px solid black;vertical-align: middle;">3.</td> 
					<td style="border: 1px solid black;vertical-align: middle;">Udara</td> 
					<td style="border: 1px solid black;vertical-align: middle;">'.$kondisi_lingkungan_kerja[0]->udara.'</td> 
				</tr>
				<tr>
					<td width="5%" style="background-color: white;border-right: 1px solid black;text-align"></td>
					<td style="border: 1px solid black;vertical-align: middle;">4.</td> 
					<td style="border: 1px solid black;vertical-align: middle;">Keadaan Ruangan</td> 
					<td style="border: 1px solid black;vertical-align: middle;">'.$kondisi_lingkungan_kerja[0]->keadaan_ruangan.'</td> 
				</tr>
				<tr>
					<td width="5%" style="background-color: white;border-right: 1px solid black;text-align"></td>
					<td style="border: 1px solid black;vertical-align: middle;">5.</td> 
					<td style="border: 1px solid black;vertical-align: middle;">Letak</td> 
					<td style="border: 1px solid black;vertical-align: middle;">'.$kondisi_lingkungan_kerja[0]->letak.'</td> 
				</tr>
				<tr>
					<td width="5%" style="background-color: white;border-right: 1px solid black;text-align"></td>
					<td style="border: 1px solid black;vertical-align: middle;">6.</td> 
					<td style="border: 1px solid black;vertical-align: middle;">Penerangan</td> 
					<td style="border: 1px solid black;vertical-align: middle;">'.$kondisi_lingkungan_kerja[0]->penerangan.'</td> 
				</tr>
				<tr>
					<td width="5%" style="background-color: white;border-right: 1px solid black;text-align"></td>
					<td style="border: 1px solid black;vertical-align: middle;">7.</td> 
					<td style="border: 1px solid black;vertical-align: middle;">Suara</td> 
					<td style="border: 1px solid black;vertical-align: middle;">'.$kondisi_lingkungan_kerja[0]->suara.'</td> 
				</tr>
				<tr>
					<td width="5%" style="background-color: white;border-right: 1px solid black;text-align"></td>
					<td style="border: 1px solid black;vertical-align: middle;">8.</td> 
					<td style="border: 1px solid black;vertical-align: middle;">Keadaan Tempat Kerja</td> 
					<td style="border: 1px solid black;vertical-align: middle;">'.$kondisi_lingkungan_kerja[0]->keadaan_tempat_kerja.'</td> 
				</tr>
				<tr>
					<td width="5%" style="background-color: white;border-right: 1px solid black;text-align"></td>
					<td style="border: 1px solid black;vertical-align: middle;">9.</td> 
					<td style="border: 1px solid black;vertical-align: middle;">Getaran</td> 
					<td style="border: 1px solid black;vertical-align: middle;">'.$kondisi_lingkungan_kerja[0]->getaran.'</td> 
				</tr>
				';

		$tabel .= '</table>';

		$tabel .= '
		<br>
		<br>
		<table>
			<tr>
				<td width="5%">14.</td> 
				<td width="40%"><b>RISIKO BAHAYA</b></td> 
			</tr>
		</table>
		<br>
		<br>
		<table cellpadding="7">
				<tr style="background-color: #9FCE64">
					<th width="5%" style="background-color: white;border-right: 1px solid black;text-align"></th>
					<th style="border: 1px solid black;text-align: center;vertical-align: middle;width: 5%;">NO</th> 
					<th style="border: 1px solid black;text-align: center;vertical-align: middle;">BAHAYA FISIK/ MENTAL</th> 
					<th style="border: 1px solid black;text-align: center;vertical-align: middle;">PENYEBAB</th> 
				</tr>';

				$no = 1;
				foreach($risiko_bahaya as $i){
					$tabel .= '<tr>
									<td width="5%"></td>
									<td style="border: 1px solid black;text-align: center;vertical-align: middle;width: 5%;">'.$no++.'</td> 
									<td style="border: 1px solid black;text-align: center;vertical-align: middle;">'.$i->risiko.'</td> 
									<td style="border: 1px solid black;text-align: center;vertical-align: middle;">'.$i->penyebab.'</td> 
								</tr>';
				}

		$tabel .= '</table>';

		$tabel .= '
		<br>
		<br>
		<table border="0">
					<tr>
						<td width="5%">15.</td> 
						<td width="40%"><b>SYARAT JABATAN</b></td> 
						<td width="5%">:</td> 
						<td width="40%" style="text-align: left"></td> 
					</tr>
					<tr>
						<td width="5%"></td> 
						<td width="40%">a.	&nbsp;Keterampilan Kerja</td> 
						<td width="5%">:</td> 
						<td width="40%" style="text-align: left">';
						$no = 1;
						$length = count($keterampilan_kerja);
						foreach($keterampilan_kerja as $i){
							$coma = '';
							if($no !== $length){
								$coma = ', ';
							}
							$no++;
							$tabel .= $i->keterampilan_kerja.''.$coma;
						}
		$tabel .=		'</td> 
					</tr>
					<tr>
						<td width="5%"></td> 
						<td width="40%">b.	&nbsp;Bakat Kerja</td> 
						<td width="5%">:</td> 
						<td width="40%" style="text-align: left"></td>
					</tr>';
					$no = 1;
					foreach($bakat_kerja as $i){
						$tabel .= '<tr>
										<td width="5%"></td>
										<td width="40%"></td>
										<td width="5%"></td>
										<td width="2%">'.$no++.')</td>
										<td>'.$i->kode_bakat_kerja.' = '.$i->bakat_kerja.'</td> 
									</tr>';
						}
		$tabel .= '<tr>
						<td width="5%"></td> 
						<td width="40%">c.	&nbsp;Temperamen Kerja</td> 
						<td width="5%">:</td> 
						<td width="40%" style="text-align: left"></td>
					</tr>';
					$no = 1;
					foreach($temperamen_kerja as $i){
						$tabel .= '<tr>
										<td width="5%"></td>
										<td width="40%"></td>
										<td width="5%"></td>
										<td width="2%">'.$no++.')</td>
										<td>'.$i->kode_temperamen_kerja.' = '.$i->temperamen_kerja.'</td> 
									</tr>';
						}
		$tabel .= '<tr>
						<td width="5%"></td> 
						<td width="40%">d.	&nbsp;Minat Kerja</td> 
						<td width="5%">:</td> 
						<td width="40%" style="text-align: left"></td>
					</tr>';
					$no = 1;
					foreach($minat_kerja as $i){
						$tabel .= '<tr>
										<td width="5%"></td>
										<td width="40%"></td>
										<td width="5%"></td>
										<td width="2%">'.$no++.')</td>
										<td>'.$i->kode_minat_kerja.' = '.$i->minat_kerja.'</td> 
									</tr>';
						}
		$tabel .= '<tr>
						<td width="5%"></td> 
						<td width="40%">e.	&nbsp;Upaya Fisik</td> 
						<td width="5%">:</td> 
						<td width="40%" style="text-align: left"></td>
					</tr>';
					$no = 1;
					foreach($upaya_fisik as $i){
						$tabel .= '<tr>
										<td width="5%"></td>
										<td width="40%"></td>
										<td width="5%"></td>
										<td width="2%">'.$no++.')</td>
										<td>'.$i->kode_upaya_fisik.' = '.$i->upaya_fisik.'</td> 
									</tr>';
						}
		$tabel .= '<tr>
						<td width="5%"></td> 
						<td width="40%">f.	&nbsp;Kondisi Fisik</td> 
						<td width="5%">:</td> 
						<td width="40%" style="text-align: left"></td>
					</tr>
					<tr>
						<td width="5%"></td> 
						<td width="40%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1) &nbsp;Jenis Kelamin</td> 
						<td width="5%">:</td> 
						<td width="40%" style="text-align: left">'.$kondisi_fisik[0]->jenis_kelamin.'</td>
					</tr>
					<tr>
						<td width="5%"></td> 
						<td width="40%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2) &nbsp;Umur</td> 
						<td width="5%">:</td> 
						<td width="40%" style="text-align: left">'.$kondisi_fisik[0]->umur.'</td>
					</tr>
					<tr>
						<td width="5%"></td> 
						<td width="40%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;3) &nbsp;Tinggi Badan</td> 
						<td width="5%">:</td> 
						<td width="40%" style="text-align: left">'.$kondisi_fisik[0]->tinggi_badan.'</td>
					</tr>
					<tr>
						<td width="5%"></td> 
						<td width="40%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;4) &nbsp;Berat Badan</td> 
						<td width="5%">:</td> 
						<td width="40%" style="text-align: left">'.$kondisi_fisik[0]->berat_badan.'</td>
					</tr>
					<tr>
						<td width="5%"></td> 
						<td width="40%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;5) &nbsp;Postur Tubuh</td> 
						<td width="5%">:</td> 
						<td width="40%" style="text-align: left">'.$kondisi_fisik[0]->postur_badan.'</td>
					</tr>
					<tr>
						<td width="5%"></td> 
						<td width="40%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;6) &nbsp;Penampilan</td> 
						<td width="5%">:</td> 
						<td width="40%" style="text-align: left">'.$kondisi_fisik[0]->penampilan.'</td>
					</tr>
					<tr>
						<td width="5%"></td> 
						<td width="40%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;7) &nbsp;Keadaan Fisik</td> 
						<td width="5%">:</td> 
						<td width="40%" style="text-align: left">'.$kondisi_fisik[0]->keadaan_fisik.'</td>
					</tr>
					';
		$tabel .= '<tr>
					<td width="5%"></td> 
					<td width="40%">g.	&nbsp;Fungsi Pekerjaan</td> 
					<td width="5%">:</td> 
					<td width="40%" style="text-align: left"></td>
				</tr>
				<tr>
					<td width="5%"></td>
					<td width="40%"></td>
					<td width="5%"></td>
					<td width="5%">Data</td>
					<td width="2%">:</td>
				</tr>';
					$no = 1;
					foreach($fungsi_pekerjaan['Data'] as $value){
							$tabel .= '	<tr>
											<td width="5%"></td>
											<td width="40%"></td>
											<td width="5%"></td>
											<td width="5%">'.$no++.')</td>
											<td width="30%">'.$value->fungsi_pekerjaan.'</td>
										</tr>';
					}
	$tabel .= 	'<tr>
					<td width="5%"></td>
					<td width="40%"></td>
					<td width="5%"></td>
					<td width="5%">Orang</td>
					<td width="2%">:</td>
					<td width="30%"></td>
					<td></td> 
					</tr>';
					$no = 1;
					foreach($fungsi_pekerjaan['Orang'] as $value){
							$tabel .= '	<tr>
											<td width="5%"></td>
											<td width="40%"></td>
											<td width="5%"></td>
											<td width="5%">'.$no++.')</td>
											<td width="30%">'.$value->fungsi_pekerjaan.'</td>
										</tr>';
					}
	$tabel .= 	'<tr>
					<td width="5%"></td>
					<td width="40%"></td>
					<td width="5%"></td>
					<td width="5%">Benda</td>
					<td width="2%">:</td>
					<td width="30%"></td>
					<td></td> 
					</tr>';
					$no = 1;
					foreach($fungsi_pekerjaan['Benda'] as $value){
							$tabel .= '	<tr>
											<td width="5%"></td>
											<td width="40%"></td>
											<td width="5%"></td>
											<td width="5%">'.$no++.')</td>
											<td width="30%">'.$value->fungsi_pekerjaan.'</td>
										</tr>';
					}
		$tabel .= '</table>';

		$tabel .= '
				<br>
				<br>
				<table border="0">
							<tr>
								<td width="5%">16.</td> 
								<td width="40%"><b>PRESTASI KERJA YANG DIHARAPKAN</b></td> 
								<td width="5%">:</td> 
								<td width="40%" style="text-align: left">'.$prestasi.'</td> 
							</tr>
							<br>
							<br>
							<tr>
								<td width="5%">17.</td> 
								<td width="40%"><b>KELAS</b></td> 
								<td width="5%">:</td> 
								<td width="40%" style="text-align: left">'.$kelas.'</td> 
							</tr>
				</table>';

		$pdf->writeHTML($tabel);
		
		ob_clean();
		$pdf->Output($_SERVER['DOCUMENT_ROOT'] . 'data/analisis_jabatan/' . str_replace(array('-','/'),'_',$detail->nama) . '_' . time() . '.pdf', 'FI');
	}

	public function export_bkn_word($id)
	{
		$detail = $this->daftarAnalisisJabatan->get_by_id($id);
		$kualifikasi_jabatan = $this->daftarAnalisisJabatan->get_all_kualifikasi_jabatan($id, true);
		$tugas_pokok = $this->daftarAnalisisJabatan->get_all_tugas_pokok($id);
		$hasil_kerja = $this->daftarAnalisisJabatan->get_all_hasil_kerja($id);
		$bahan_kerja = $this->daftarAnalisisJabatan->get_all_bahan_kerja($id);
		$perangkat_kerja = $this->daftarAnalisisJabatan->get_all_perangkat_kerja($id);
		$tanggung_jawab = $this->daftarAnalisisJabatan->get_all_tanggung_jawab($id);
		$wewenang = $this->daftarAnalisisJabatan->get_all_wewenang($id);
		$korelasi_jabatan = $this->daftarAnalisisJabatan->get_all_korelasi_jabatan($id);
		$kondisi_lingkungan_kerja = $this->daftarAnalisisJabatan->get_all_kondisi_lingkungan_kerja($id, true);
		$risiko_bahaya = $this->daftarAnalisisJabatan->get_all_risiko_bahaya($id);

		$sender = $this->sender->cek_sender($id, true);

		if(!$kualifikasi_jabatan){
			$kualifikasi_jabatan[0] = (Object) [
				'pendidikan_formal' => '-',
				'diklat_perjejangan' => '-',
				'diklat_teknis' => '-',
				'pengalaman_kerja' => '-'
			];
		}

		if(!$kondisi_lingkungan_kerja){
			$kondisi_lingkungan_kerja[0] = (Object) [
				'tempat_kerja' => '-',
				'suhu' => '-',
				'udara' => '-',
				'keadaan_ruangan' => '-',
				'letak' => '-',
				'penerangan' => '-',
				'suara' => '-',
				'keadaan_tempat_kerja' => '-',
				'getaran' => '-'
			];
		}
		
		//Syarat
		$keterampilan_kerja = $this->daftarAnalisisJabatan->get_all_syarat_keterampilan_kerja($id);
		$bakat_kerja = $this->daftarAnalisisJabatan->get_all_syarat_bakat_kerja($id);
		$temperamen_kerja = $this->daftarAnalisisJabatan->get_all_syarat_temperamen_kerja($id);
		$minat_kerja = $this->daftarAnalisisJabatan->get_all_syarat_minat_kerja($id);
		$upaya_fisik = $this->daftarAnalisisJabatan->get_all_syarat_upaya_fisik($id);
		$kondisi_fisik = $this->daftarAnalisisJabatan->get_all_syarat_kondisi_fisik($id, true);
		$fungsi_pekerjaan = $this->daftarAnalisisJabatan->get_all_syarat_fungsi_pekerjaan($id, true);

		$faktor_evaluasi = $this->refFaktorEvaluasi->get_all_ref(['jenis_jabatan' => ($detail->jenis_jabatan == 'Pelaksana' ? 'Fungsional' : $detail->jenis_jabatan)]);
		$arr = [];

		foreach($faktor_evaluasi as $i => $v){
			$arr[$i]['id'] = $v->id;
			$arr[$i]['number'] = $v->number;
			$arr[$i]['nama'] = $v->nama;
			$arr[$i]['uraian'] = $v->uraian;
			$arr[$i]['skor'] = $this->refFaktorEvaluasi->get_skor($id, $v->id);
		}
		
		$nilai_evjab = 0;
		foreach($arr as $i){
			if(isset($i['skor'])){
				$nilai_evjab += $i['skor']->nilaiItem;
			}
		}

		
		$kelas_jabatan = $this->refKelasJabatan->get_by_nilai($nilai_evjab);
		$kelas = ($kelas_jabatan) ? $kelas_jabatan->kelas : 0;
		
		$prestasi = 'Baik';
		if($kelas > 8){
			$prestasi = 'Sangat Baik';
		}

		if(!$kondisi_fisik){
			$kondisi_fisik[0] = (Object) [
				'jenis_kelamin' => '-',
				'umur' => '-',
				'tinggi_badan' => '-',
				'berat_badan' => '-',
				'postur_badan' => '-',
				'penampilan' => '-',
				'keadaan_fisik' => '-'
			];
		}

		$phpWord = new PhpWord();
		$section = $phpWord->addSection();
		
		$filename = time();

		$tabel = '
		
		
		
        <table border="0">
              <tr>
					<td width="5%"></td> 
					<td width="40%"></td> 
					<td colspan="2" style="text-align: left"><b>INFORMASI JABATAN</b></td> 
			  </tr>
			  
              <tr>
					<td width="5%">1.</td> 
					<td width="40%"><b>NAMA JABATAN</b></td> 
					<td width="5%">:</td> 
					<td width="40%" style="text-align: left">'.$detail->nama.'</td> 
			  </tr>
			  
              <tr>
					<td width="5%">2.</td> 
					<td width="40%"><b>KODE JABATAN</b></td> 
					<td width="5%">:</td> 
					<td width="40%" style="text-align: left"></td> 
			  </tr>
			  
              <tr>
					<td width="5%">3.</td> 
					<td width="40%"><b>UNIT KERJA</b></td> 
					<td width="5%">:</td> 
					<td width="40%" style="text-align: left"></td> 
			  </tr>
              <tr>
					<td width="5%"></td> 
					<td width="40%">a.	&nbsp;JPT Pratama</td> 
					<td width="5%">:</td> 
					<td width="40%" style="text-align: left">'.$detail->namaJptPratama.'</td> 
			  </tr>
              <tr>
					<td width="5%"></td> 
					<td width="40%">b.	&nbsp;Administrator</td> 
					<td width="5%">:</td> 
					<td width="40%" style="text-align: left">'.$detail->namaAdministrator.'</td> 
			  </tr>
              <tr>
					<td width="5%"></td> 
					<td width="40%">c.	&nbsp;Pengawas</td> 
					<td width="5%">:</td> 
					<td width="40%" style="text-align: left">'.$detail->namaPengawas.'</td> 
			  </tr>
              <tr>
					<td width="5%"></td> 
					<td width="40%">d.	&nbsp;&nbsp;Pelaksana</td> 
					<td width="5%">:</td> 
					<td width="40%" style="text-align: left">'.$detail->pelaksana.'</td> 
			  </tr>
              <tr>
					<td width="5%"></td> 
					<td width="40%">e.	&nbsp;Jabatan Fungsional</td> 
					<td width="5%">:</td> 
					<td width="40%" style="text-align: left">'.$detail->jabatan_fungsional.'</td> 
			  </tr>
			  
			  <tr>
					<td width="5%">4.</td> 
					<td width="40%"><b>IKHTISAR JABATAN</b></td> 
					<td width="5%">:</td> 
					<td width="40%" style="text-align: left"></td> 
			  </tr>
			  <tr>
			  		<td width="5%"></td>
			 		<td colspan="3">'.$detail->ikhtisar_jabatan.'</td> 
			  </tr>
			  
			  <tr>
					<td width="5%">5.</td> 
					<td width="40%"><b>KUALIFIKASI JABATAN</b></td> 
					<td width="5%">:</td> 
					<td width="40%"></td> 
			  </tr>
			  <tr>
					<td width="5%"></td> 
					<td width="40%">a.	&nbsp;Pendidikan Formal</td> 
					<td width="5%">:</td> 
					<td width="40%" style="text-align: left">'.$kualifikasi_jabatan[0]->pendidikan_formal.'</td> 
			  </tr>
			  <tr>
					<td width="5%"></td> 
					<td width="40%">b.	&nbsp;Pendidikan dan Pelatihan</td> 
					<td width="5%">:</td> 
					<td width="40%" style="text-align: left"></td> 
			  </tr>
			  <tr>
					<td width="5%"></td> 
					<td width="40%">&nbsp;&nbsp;&nbsp;&nbsp;1) Diklat Penjenjangan</td> 
					<td width="5%">:</td> 
					<td width="40%" style="text-align: left">'.$kualifikasi_jabatan[0]->diklat_perjejangan.'</td> 
			  </tr>
			  <tr>
					<td width="5%"></td> 
					<td width="40%">&nbsp;&nbsp;&nbsp;&nbsp;2) Diklat Teknis</td> 
					<td width="5%">:</td> 
					<td width="40%" style="text-align: left">'.$kualifikasi_jabatan[0]->diklat_teknis.'</td> 
			  </tr>
			  <tr>
					<td width="5%"></td> 
					<td width="40%">c.	&nbsp;Pengalaman Kerja</td> 
					<td width="5%">:</td> 
					<td width="40%" style="text-align: left">'.$kualifikasi_jabatan[0]->pengalaman_kerja.'</td> 
			  </tr>
			  
			  <tr>
					<td width="5%">6.</td> 
					<td width="40%"><b>TUGAS POKOK</b></td> 
			  </tr>
        </table>
		
		
		<table cellpadding="7" style="border: 8px #000 solid;">
			<tr style="background-color: #9FCE64">
				<th width="5%" style="background-color: white;border-right: 1px solid black;text-align"></th>
				<th style="border: 1px solid black;vertical-align: middle;width: 5%;">NO</th> 
				<th style="border: 1px solid black;vertical-align: middle;">URAIAN TUGAS</th> 
				<th style="border: 1px solid black;vertical-align: middle;">HASIL KERJA</th> 
				<th style="border: 1px solid black;vertical-align: middle;">JUMLAH HASIL</th> 
				<th style="border: 1px solid black;vertical-align: middle;">WAKTU PENYELESAIAN PER SATUAN HASIL KERJA</th> 
				<th style="border: 1px solid black;vertical-align: middle;">WAKTU EFEKTIF</th> 
				<th style="border: 1px solid black;vertical-align: middle;">KEBUTUHAN PEGAWAI</th> 
			</tr>';

		$no = 1;
		$jumlah = 0;
		foreach($hasil_kerja as $i){
			$jumlah_hasil = $i->jumlah_hasil ?: 0;
			$waktu_penyelesaian = $i->waktu_penyelesaian ?: 0;
			$kebutuhan_pegawai = $jumlah_hasil * str_replace(',','.',$waktu_penyelesaian) / 1250;
			$tabel .= '<tr>
							<td width="5%"></td>
							<td style="border: 1px solid black;vertical-align: middle;width: 5%;">'.$no++.'</td> 
							<td style="border: 1px solid black;vertical-align: middle;">'.$i->uraianTugas.'</td> 
							<td style="border: 1px solid black;vertical-align: middle;">'.$i->hasil_kerja.'</td> 
							<td style="border: 1px solid black;vertical-align: middle;">'.$i->jumlah_hasil.'</td> 
							<td style="border: 1px solid black;vertical-align: middle;">'.$i->waktu_penyelesaian.'</td> 
							<td style="border: 1px solid black;vertical-align: middle;">1250</td> 
							<td style="border: 1px solid black;vertical-align: middle;">'.$kebutuhan_pegawai.'</td> 
						</tr>';

			$jumlah += $kebutuhan_pegawai;
		}
		$jumlah_pegawai = round($jumlah);
		$tabel .= '<tr>
						<td width="5%"></td>
						<td style="border: 1px solid black;text-align" colspan="4">Jumlah</td>	
						<td style="border: 1px solid black;text-align"></td>
						<td style="border: 1px solid black;text-align"></td>
						<td style="border: 1px solid black;text-align">'.$jumlah.'</td>
					</tr>
					<tr>
						<td width="5%"></td>
						<td style="border: 1px solid black;text-align" colspan="4">Jumlah Pegawai</td>	
						<td style="border: 1px solid black;text-align"></td>
						<td style="border: 1px solid black;text-align"></td>
						<td style="border: 1px solid black;text-align">'.$jumlah_pegawai.'</td>
					</tr>'
					;

		$tabel .= '</table>';
		
		$tabel .= '
		
		
		<table>
			<tr>
				<td width="5%">7.</td> 
				<td width="40%"><b>HASIL KERJA</b></td> 
			</tr>
		</table>
		
		
		<table cellpadding="7" style="border: 8px #000 solid;">
				<tr style="background-color: #9FCE64">
					<th width="5%" style="background-color: white;border-right: 1px solid black;text-align"></th>
					<th style="border: 1px solid black;vertical-align: middle;width: 5%;">NO</th> 
					<th style="border: 1px solid black;vertical-align: middle;">HASIL KERJA</th> 
					<th style="border: 1px solid black;vertical-align: middle;">SATUAN HASIL</th> 
				</tr>';

				$no = 1;
				foreach($hasil_kerja as $i){
					$tabel .= '<tr>
									<td width="5%"></td>
									<td style="border: 1px solid black;vertical-align: middle;width: 5%;">'.$no++.'</td> 
									<td style="border: 1px solid black;vertical-align: middle;">'.$i->hasil_kerja.'</td> 
									<td style="border: 1px solid black;vertical-align: middle;">'.$i->satuan_hasil.'</td> 
								</tr>';
				}

		$tabel .= '</table>';

		$tabel .= '
		
		
		<table>
			<tr>
				<td width="5%">8.</td> 
				<td width="40%"><b>BAHAN KERJA</b></td> 
			</tr>
		</table>
		
		
		<table cellpadding="7" style="border: 8px #000 solid;">
				<tr style="background-color: #9FCE64">
					<th width="5%" style="background-color: white;border-right: 1px solid black;text-align"></th>
					<th style="border: 1px solid black;vertical-align: middle;width: 5%;">NO</th> 
					<th style="border: 1px solid black;vertical-align: middle;">BAHAN KERJA</th> 
					<th style="border: 1px solid black;vertical-align: middle;">PENGGUNAAN DALAM TUGAS</th> 
				</tr>';

				$no = 1;
				foreach($bahan_kerja as $i){
					$tabel .= '<tr>
									<td width="5%"></td>
									<td style="border: 1px solid black;vertical-align: middle;width: 5%;">'.$no++.'</td> 
									<td style="border: 1px solid black;vertical-align: middle;">'.$i->bahan_kerja.'</td> 
									<td style="border: 1px solid black;vertical-align: middle;">'.$i->penggunaan_dalam_tugas.'</td> 
								</tr>';
				}

		$tabel .= '</table>';

		$tabel .= '
		
		
		<table>
			<tr>
				<td width="5%">9.</td> 
				<td width="40%"><b>PERANGKAT KERJA</b></td> 
			</tr>
		</table>
		
		
		<table cellpadding="7" style="border: 8px #000 solid;">
				<tr style="background-color: #9FCE64">
					<th width="5%" style="background-color: white;border-right: 1px solid black;text-align"></th>
					<th style="border: 1px solid black;vertical-align: middle;width: 5%;">NO</th> 
					<th style="border: 1px solid black;vertical-align: middle;">PERANGKAT KERJA</th> 
					<th style="border: 1px solid black;vertical-align: middle;">PENGGUNAAN DALAM TUGAS</th> 
				</tr>';

				$no = 1;
				foreach($perangkat_kerja as $i){
					$tabel .= '<tr>
									<td width="5%"></td>
									<td style="border: 1px solid black;vertical-align: middle;width: 5%;">'.$no++.'</td> 
									<td style="border: 1px solid black;vertical-align: middle;">'.$i->perangkat_kerja.'</td> 
									<td style="border: 1px solid black;vertical-align: middle;">'.$i->penggunaan_dalam_tugas.'</td> 
								</tr>';
				}

		$tabel .= '</table>';

		$tabel .= '
		
		
		<table>
			<tr>
				<td width="5%">10.</td> 
				<td width="40%"><b>TANGGUNG JAWAB</b></td> 
			</tr>
		</table>
		
		
		<table cellpadding="7" style="border: 8px #000 solid;">
				<tr style="background-color: #9FCE64">
					<th width="5%" style="background-color: white;border-right: 1px solid black;text-align"></th>
					<th style="border: 1px solid black;vertical-align: middle;width: 5%;">NO</th> 
					<th style="border: 1px solid black;vertical-align: middle;">URAIAN</th> 
				</tr>';

				$no = 1;
				foreach($tanggung_jawab as $i){
					$tabel .= '<tr>
									<td width="5%"></td>
									<td style="border: 1px solid black;vertical-align: middle;width: 5%;">'.$no++.'</td> 
									<td style="border: 1px solid black;vertical-align: middle;">'.$i->tanggung_jawab.'</td> 
								</tr>';
				}

		$tabel .= '</table>';

		$tabel .= '
		
		
		<table>
			<tr>
				<td width="5%">11.</td> 
				<td width="40%"><b>WEWENANG</b></td> 
			</tr>
		</table>
		
		
		<table cellpadding="7" style="border: 8px #000 solid;">
				<tr style="background-color: #9FCE64">
					<th width="5%" style="background-color: white;border-right: 1px solid black;text-align"></th>
					<th style="border: 1px solid black;vertical-align: middle;width: 5%;">NO</th> 
					<th style="border: 1px solid black;vertical-align: middle;">URAIAN</th> 
				</tr>';

				$no = 1;
				foreach($wewenang as $i){
					$tabel .= '<tr>
									<td width="5%"></td>
									<td style="border: 1px solid black;vertical-align: middle;width: 5%;">'.$no++.'</td> 
									<td style="border: 1px solid black;vertical-align: middle;">'.$i->wewenang.'</td> 
								</tr>';
				}

		$tabel .= '</table>';

		$tabel .= '
		
		
		<table>
			<tr>
				<td width="5%">12.</td> 
				<td width="40%"><b>KORELASI JABATAN</b></td> 
			</tr>
		</table>
		
		
		<table cellpadding="7" style="border: 8px #000 solid;">
				<tr style="background-color: #9FCE64">
					<th width="5%" style="background-color: white;border-right: 1px solid black;text-align"></th>
					<th style="border: 1px solid black;vertical-align: middle;width: 5%;">NO</th> 
					<th style="border: 1px solid black;vertical-align: middle;">JABATAN</th> 
					<th style="border: 1px solid black;vertical-align: middle;">UNIT KERJA</th> 
					<th style="border: 1px solid black;vertical-align: middle;">DALAM HAL</th> 
				</tr>';

				$no = 1;
				foreach($korelasi_jabatan as $i){
					$tabel .= '<tr>
									<td width="5%"></td>
									<td style="border: 1px solid black;vertical-align: middle;width: 5%;">'.$no++.'</td> 
									<td style="border: 1px solid black;vertical-align: middle;">'.$i->jabatan.'</td> 
									<td style="border: 1px solid black;vertical-align: middle;">'.$i->unit_kerja.'</td> 
									<td style="border: 1px solid black;vertical-align: middle;">'.$i->hubungan_tugas.'</td> 
								</tr>';
				}

		$tabel .= '</table>';

		$tabel .= '
		
		
		<table>
			<tr>
				<td width="5%">13.</td> 
				<td width="40%"><b>KONDISI LINGKUNGAN KERJA</b></td> 
			</tr>
		</table>
		
		
		<table cellpadding="7" style="border: 8px #000 solid;">
				<tr style="background-color: #9FCE64">
					<th width="5%" style="background-color: white;border-right: 1px solid black;text-align"></th>
					<th style="border: 1px solid black;vertical-align: middle;width: 5%;">NO</th> 
					<th style="border: 1px solid black;vertical-align: middle;">ASPEK</th> 
					<th style="border: 1px solid black;vertical-align: middle;">KETERANGAN</th> 
				</tr>
				<tr>
					<td width="5%" style="background-color: white;border-right: 1px solid black;text-align"></td>
					<td style="border: 1px solid black;vertical-align: middle;">1.</td> 
					<td style="border: 1px solid black;vertical-align: middle;">Tempat Kerja</td> 
					<td style="border: 1px solid black;vertical-align: middle;">'.$kondisi_lingkungan_kerja[0]->tempat_kerja.'</td> 
				</tr>
				<tr>
					<td width="5%" style="background-color: white;border-right: 1px solid black;text-align"></td>
					<td style="border: 1px solid black;vertical-align: middle;">2.</td> 
					<td style="border: 1px solid black;vertical-align: middle;">Suhu</td> 
					<td style="border: 1px solid black;vertical-align: middle;">'.$kondisi_lingkungan_kerja[0]->suhu.'</td> 
				</tr>
				<tr>
					<td width="5%" style="background-color: white;border-right: 1px solid black;text-align"></td>
					<td style="border: 1px solid black;vertical-align: middle;">3.</td> 
					<td style="border: 1px solid black;vertical-align: middle;">Udara</td> 
					<td style="border: 1px solid black;vertical-align: middle;">'.$kondisi_lingkungan_kerja[0]->udara.'</td> 
				</tr>
				<tr>
					<td width="5%" style="background-color: white;border-right: 1px solid black;text-align"></td>
					<td style="border: 1px solid black;vertical-align: middle;">4.</td> 
					<td style="border: 1px solid black;vertical-align: middle;">Keadaan Ruangan</td> 
					<td style="border: 1px solid black;vertical-align: middle;">'.$kondisi_lingkungan_kerja[0]->keadaan_ruangan.'</td> 
				</tr>
				<tr>
					<td width="5%" style="background-color: white;border-right: 1px solid black;text-align"></td>
					<td style="border: 1px solid black;vertical-align: middle;">5.</td> 
					<td style="border: 1px solid black;vertical-align: middle;">Letak</td> 
					<td style="border: 1px solid black;vertical-align: middle;">'.$kondisi_lingkungan_kerja[0]->letak.'</td> 
				</tr>
				<tr>
					<td width="5%" style="background-color: white;border-right: 1px solid black;text-align"></td>
					<td style="border: 1px solid black;vertical-align: middle;">6.</td> 
					<td style="border: 1px solid black;vertical-align: middle;">Penerangan</td> 
					<td style="border: 1px solid black;vertical-align: middle;">'.$kondisi_lingkungan_kerja[0]->penerangan.'</td> 
				</tr>
				<tr>
					<td width="5%" style="background-color: white;border-right: 1px solid black;text-align"></td>
					<td style="border: 1px solid black;vertical-align: middle;">7.</td> 
					<td style="border: 1px solid black;vertical-align: middle;">Suara</td> 
					<td style="border: 1px solid black;vertical-align: middle;">'.$kondisi_lingkungan_kerja[0]->suara.'</td> 
				</tr>
				<tr>
					<td width="5%" style="background-color: white;border-right: 1px solid black;text-align"></td>
					<td style="border: 1px solid black;vertical-align: middle;">8.</td> 
					<td style="border: 1px solid black;vertical-align: middle;">Keadaan Tempat Kerja</td> 
					<td style="border: 1px solid black;vertical-align: middle;">'.$kondisi_lingkungan_kerja[0]->keadaan_tempat_kerja.'</td> 
				</tr>
				<tr>
					<td width="5%" style="background-color: white;border-right: 1px solid black;text-align"></td>
					<td style="border: 1px solid black;vertical-align: middle;">9.</td> 
					<td style="border: 1px solid black;vertical-align: middle;">Getaran</td> 
					<td style="border: 1px solid black;vertical-align: middle;">'.$kondisi_lingkungan_kerja[0]->getaran.'</td> 
				</tr>
				';

		$tabel .= '</table>';

		$tabel .= '
		
		
		<table>
			<tr>
				<td width="5%">14.</td> 
				<td width="40%"><b>RISIKO BAHAYA</b></td> 
			</tr>
		</table>
		
		
		<table cellpadding="7" style="border: 8px #000 solid;">
				<tr style="background-color: #9FCE64">
					<th width="5%" style="background-color: white;border-right: 1px solid black;text-align"></th>
					<th style="border: 1px solid black;vertical-align: middle;width: 5%;">NO</th> 
					<th style="border: 1px solid black;vertical-align: middle;">BAHAYA FISIK/ MENTAL</th> 
					<th style="border: 1px solid black;vertical-align: middle;">PENYEBAB</th> 
				</tr>';

				$no = 1;
				foreach($risiko_bahaya as $i){
					$tabel .= '<tr>
									<td width="5%"></td>
									<td style="border: 1px solid black;vertical-align: middle;width: 5%;">'.$no++.'</td> 
									<td style="border: 1px solid black;vertical-align: middle;">'.$i->risiko.'</td> 
									<td style="border: 1px solid black;vertical-align: middle;">'.$i->penyebab.'</td> 
								</tr>';
				}

		$tabel .= '</table>';

		$tabel .= '
		
		
		<table border="0">
					<tr>
						<td width="5%">15.</td> 
						<td width="40%"><b>SYARAT JABATAN</b></td> 
						<td width="5%">:</td> 
						<td width="40%" style="text-align: left"></td> 
					</tr>
					<tr>
						<td width="5%"></td> 
						<td width="40%">a.	&nbsp;Keterampilan Kerja</td> 
						<td width="5%">:</td> 
						<td width="40%" style="text-align: left">';
						$no = 1;
						$length = count($keterampilan_kerja);
						foreach($keterampilan_kerja as $i){
							$coma = '';
							if($no !== $length){
								$coma = ', ';
							}
							$no++;
							$tabel .= $i->keterampilan_kerja.''.$coma;
						}
		$tabel .=		'</td> 
					</tr>
					<tr>
						<td width="5%"></td> 
						<td width="40%">b.	&nbsp;Bakat Kerja</td> 
						<td width="5%">:</td> 
						<td width="40%" style="text-align: left"></td>
					</tr>';
					$no = 1;
					foreach($bakat_kerja as $i){
						$tabel .= '<tr>
							<td width="5%"></td>
							<td width="40%"></td>
							<td width="5%"></td>
							<td>'.$no++.') '.$i->kode_bakat_kerja.' = '.$i->bakat_kerja.'</td> 
						</tr>';
						}
		$tabel .= '<tr>
						<td width="5%"></td> 
						<td width="40%">c.	&nbsp;Temperamen Kerja</td> 
						<td width="5%">:</td> 
						<td width="40%" style="text-align: left"></td>
					</tr>';
					$no = 1;
					foreach($temperamen_kerja as $i){
						// echo $i->kode_temperamen_kerja.' = '.$i->temperamen_kerja.'<br>';
						$tabel .= '<tr>
										<td width="5%"></td>
										<td width="40%"></td>
										<td width="5%"></td>
										<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; '.$i->kode_temperamen_kerja.' = '.$i->temperamen_kerja.'</td> 
									</tr>';
						}
		$tabel .= '<tr>
						<td width="5%"></td> 
						<td width="40%">d.	&nbsp;Minat Kerja</td> 
						<td width="5%">:</td> 
						<td width="40%" style="text-align: left"></td>
					</tr>';
					$no = 1;
					foreach($minat_kerja as $i){
						$tabel .= '<tr>
										<td width="5%"></td>
										<td width="40%"></td>
										<td width="5%"></td>
										<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; '.$i->kode_minat_kerja.' = '.$i->minat_kerja.'</td> 
									</tr>';
						}
		$tabel .= '<tr>
						<td width="5%"></td> 
						<td width="40%">e.	&nbsp;Upaya Fisik</td> 
						<td width="5%">:</td> 
						<td width="40%" style="text-align: left"></td>
					</tr>';
					$no = 1;
					foreach($upaya_fisik as $i){
						$tabel .= '<tr>
										<td width="5%"></td>
										<td width="40%"></td>
										<td width="5%"></td>
										<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; '.$no++.') '.$i->upaya_fisik.'</td> 
									</tr>';
						}
		$tabel .= '<tr>
						<td width="5%"></td> 
						<td width="40%">f.	&nbsp;Kondisi Fisik</td> 
						<td width="5%">:</td> 
						<td width="40%" style="text-align: left"></td>
					</tr>
					<tr>
						<td width="5%"></td> 
						<td width="40%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1) &nbsp;Jenis Kelamin</td> 
						<td width="5%">:</td> 
						<td width="40%" style="text-align: left">'.$kondisi_fisik[0]->jenis_kelamin.'</td>
					</tr>
					<tr>
						<td width="5%"></td> 
						<td width="40%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2) &nbsp;Umur</td> 
						<td width="5%">:</td> 
						<td width="40%" style="text-align: left">'.$kondisi_fisik[0]->umur.'</td>
					</tr>
					<tr>
						<td width="5%"></td> 
						<td width="40%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;3) &nbsp;Tinggi Badan</td> 
						<td width="5%">:</td> 
						<td width="40%" style="text-align: left">'.$kondisi_fisik[0]->tinggi_badan.'</td>
					</tr>
					<tr>
						<td width="5%"></td> 
						<td width="40%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;4) &nbsp;Berat Badan</td> 
						<td width="5%">:</td> 
						<td width="40%" style="text-align: left">'.$kondisi_fisik[0]->berat_badan.'</td>
					</tr>
					<tr>
						<td width="5%"></td> 
						<td width="40%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;5) &nbsp;Postur Tubuh</td> 
						<td width="5%">:</td> 
						<td width="40%" style="text-align: left">'.$kondisi_fisik[0]->postur_badan.'</td>
					</tr>
					<tr>
						<td width="5%"></td> 
						<td width="40%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;6) &nbsp;Penampilan</td> 
						<td width="5%">:</td> 
						<td width="40%" style="text-align: left">'.$kondisi_fisik[0]->penampilan.'</td>
					</tr>
					<tr>
						<td width="5%"></td> 
						<td width="40%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;7) &nbsp;Keadaan Fisik</td> 
						<td width="5%">:</td> 
						<td width="40%" style="text-align: left">'.$kondisi_fisik[0]->keadaan_fisik.'</td>
					</tr>
					';
		$tabel .= '<tr>
					<td width="5%"></td> 
					<td width="40%">g.	&nbsp;Fungsi Pekerjaan</td> 
					<td width="5%">:</td> 
					<td width="40%" style="text-align: left"></td>
				</tr>';
				$no = 1;
				foreach($fungsi_pekerjaan as $i){
					$tabel .= '<tr>
									<td width="5%"></td>
									<td width="40%"></td>
									<td width="5%"></td>
									<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; '.$i->kode_fungsi_pekerjaan.' = '.$i->fungsi_pekerjaan.'</td> 
								</tr>';
					}
		$tabel .= '</table>';

		$tabel .= '
				
				
				<table border="0">
							<tr>
								<td width="5%">16.</td> 
								<td width="40%"><b>PRESTASI KERJA YANG DIHARAPKAN</b></td> 
								<td width="5%">:</td> 
								<td width="40%" style="text-align: left">'.$prestasi.'</td> 
							</tr>
							<tr>
								<td width="5%"></td> 
								<td width="40%">KELAS JABATAN</td> 
								<td width="5%">:</td> 
								<td width="40%" style="text-align: left">'.$kelas.'</td> 
							</tr>
				</table>';

		$tabel .= '
				<table border="0" style="margin-top: 100px; width:100%">
							<tr>
								<td width="50%" style="text-align: center"></td>
								<td width="50%" style="text-align: center">Kabupaten Sumedang, '.date('j F Y').'</td>
							</tr>
							<tr>
								<td width="50%" style="text-align: center">Mengetahui Atasan Langsung</td>
								<td width="50%" style="text-align: center">Yang Membuat</td>
							</tr>
				</table>';
		$tabel .= '
				<table border="0" style="margin-top: 500px; width:100%">
							<tr>
								<td width="50%" style="text-align: center"><b>'.$sender->namaVerifikator.'</b></td>
								<td width="50%" style="text-align: center"><b>'.$sender->namaPemangku.'</b></td>
							</tr>
							<tr>
								<td width="50%" style="text-align: center">NIP : <u>'.$sender->nipVerifikator.'</u></td>
								<td width="50%" style="text-align: center">NIP : <u>'.$sender->nipPemangku.'</u></td>
							</tr>
				</table>';

			// echo $tabel;die;
			Html::addHtml($section, $tabel);
			$writer = new Word2007($phpWord);
			header('Content-Type: application/msword');
			header('Content-Disposition: attachment;filename="analisis_jabatan_'. $detail->nama . '_' . time() .'.docx"'); 
			header('Cache-Control: max-age=0');
			ob_clean();
			$writer->save('php://output');
	}

	public function cek_word()
	{
		
		$htmlTemplate = '
		<p style="text-align: center;font-size: 16px;font-weight: bold;">PEMERINTAH DAERAH KABUPATEN SUMEDANG</p>
		<p style="text-align: center;font-size: 18px;font-weight: bold;">INFORMASI FAKTOR JABATAN PELAKSANA</p>
		<table style="width: 100%">
			<tr style="font-size: 16px;">
				<td width="30%">Nama Jabatan</td>
				<td width="5%">:</td>
				<td width="65%">Analisis Kebakaran</td>
			</tr>
			<tr style="font-size: 16px;">
				<td width="30%">Perangkat Daerah</td>
				<td width="5%">:</td>
				<td width="65%">Dinas Komunikasi dan Informatika Kab. Sumedang</td>
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
			'https://upload.wikimedia.org/wikipedia/commons/thumb/8/89/Lambang_Kabupaten_Sumedang.gif/583px-Lambang_Kabupaten_Sumedang.gif',
			array(
				'width'         => 80,
				'height'        => 80,
				'alignment' 	=> \PhpOffice\PhpWord\SimpleType\Jc::CENTER
			)
		);
		Html::addHtml($section, $htmlTemplate);
		$writer = new Word2007($phpWord);
		header('Content-Type: application/ocetet-stream');
        header('Content-Disposition: attachment;filename="'. time() .'.docx"'); 
		header('Cache-Control: max-age=0');
		ob_clean();
		$writer->save('php://output');
		// $phpWord = new PhpWord();
		// $section = $phpWord->addSection();
		// $section->addText('Hello World !');
		
		// $writer = new Word2007($phpWord);
		
		// $filename = 'simple';
		
		// header('Content-Type: application/msword');
        // 	header('Content-Disposition: attachment;filename="'. $filename .'.docx"'); 
		// header('Cache-Control: max-age=0');
		
		// $writer->save('php://output');
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
			base_url('asset/logo'),
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

	public function kunci($id = null){

		$id_skpd = isset($_GET['id_skpd']) ? $_GET['id_skpd'] : null;

		if(!empty($id)){
			$detail = $this->daftarAnalisisJabatan->get_by_id($id);
			if($detail->status == 'buka'){
				$val = 'tutup';
			}else{
				$val = 'buka';
			}
			$update = $this->daftarAnalisisJabatan->kunci($id, $val);
			if($update){
				$this->session->set_flashdata('status', '<span class="glyphicon glyphicon-ok"></span> Kunci berhasil diperbaharui');
				redirect(base_url('simanja/analisis_jabatan?id_skpd='.$id_skpd));
			}else{
				$this->session->set_flashdata('status', '<span class="glyphicon glyphicon-remove"></span> Terjadi Kesalahan');
				redirect(base_url('simanja/analisis_jabatan?id_skpd='.$id_skpd));
			}
		}
	}

	public function kunci_semua($val = null, $id_skpd = null){
		if($val == 'buka' || $val == 'tutup'){
			$update = $this->daftarAnalisisJabatan->kunci_semua($val, $id_skpd);
			if($update){
				$this->session->set_flashdata('status', '<span class="glyphicon glyphicon-ok"></span> Kunci berhasil diperbaharui');
				redirect(base_url('simanja/analisis_jabatan?=id_skpd='.$id_skpd));
			}else{
				$this->session->set_flashdata('status', '<span class="glyphicon glyphicon-remove"></span> Terjadi Kesalahan');
				redirect(base_url('simanja/analisis_jabatan?=id_skpd='.$id_skpd));
			}
		}
	}

	public function pegawai()
	{
		$pegawai = $this->master_pegawai_model->get_by_name_jabatan('Kepala Sub Bagian Umum');
		$pegawai_id = [];
		$pegawai_no = 0;
		foreach($pegawai as $i){
			$pegawai_id[$pegawai_no] = $i['id_pegawai'];
			$pegawai_no++;
		}
		$pegawai_id = implode(",", $pegawai_id);
		print_r($pegawai_id);
	}
}