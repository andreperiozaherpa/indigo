<?php
include_once(APPPATH."third_party/Common/Autoloader.php");
include_once(APPPATH."third_party/PhpWord/Autoloader.php");
//include_once(APPPATH."core/Front_end.php");

use PhpOffice\Common\Autoloader AS CAutoloader;
use PhpOffice\PhpWord\Autoloader;
use PhpOffice\PhpWord\Settings;
use PhpOffice\PhpWord\Shared\Converter;
use PhpOffice\PhpWord\Style\TablePosition;
Autoloader::register();
CAutoloader::register();
Settings::loadConfig();

defined('BASEPATH') OR exit('No direct script access allowed');

class Renja_rka extends CI_Controller {
	public $user_id;

	public function __construct(){
		parent ::__construct();
		$this->user_id = $this->session->userdata('user_id');
		$this->load->model('user_model');
		$this->user_model->user_id = $this->user_id;
		$this->user_model->set_user_by_user_id();
		$this->user_picture = $this->user_model->user_picture;
		$this->full_name	= $this->user_model->full_name;
		$this->user_level	= $this->user_model->level;
		$this->load->model('ref_skpd_model');
		$this->load->model('master_pegawai_model');

		$this->load->model('renja_rka_model');
		$this->load->model('renja_perencanaan_model');
		$this->load->model('renstra_realisasi_model');
		$this->load->model('ref_visi_misi_model');


		$this->level_id	= $this->user_model->level_id;
		if ($this->level_id >2 ) redirect("admin");
	}
	public function index()
	{
		if ($this->user_id)
		{
			$data['title']		= "Rencana Kerja Anggaran SKPD ";
			$data['content']	= "renja/rka/index" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "renja_rka";

			$this->load->model('ref_skpd_model');


			$hal = 6;
			$page = isset($_GET["page"]) ? (int)$_GET["page"] : 1;
			$mulai = ($page>1) ? ($page * $hal) - $hal : 0;
			$total = count($this->ref_skpd_model->get_all());
			$data['pages'] = ceil($total/$hal);
			$data['current'] = $page;
			if(!empty($_POST)){
				$filter = $_POST;
				$data['filter'] = true;
				$data['filter_data'] = $_POST;
			}else{
				$filter = '';
				$data['filter'] = false;
			}
			$data['list'] = $this->ref_skpd_model->get_page($mulai,$hal,$filter);


			$this->load->view('admin/index',$data);


		}
		else
		{
			redirect('admin');
		}
	}


	public function view($id_skpd)
	{
		if ($this->user_id)
		{
			$data['title']		= "Detail Rencana Kerja SKPD";
			$data['content']	= "renja/rka/view" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "ref_skpd";

			$this->load->model('ref_skpd_model');
			$this->load->model('renja_rka_model');
			
			$data['kepala_skpd'] = $this->ref_skpd_model->get_kepala_skpd($id_skpd);

			$data['detail'] = $this->ref_skpd_model->get_by_id($id_skpd);
			$data['perencanaan'] = $this->renja_rka_model->get_perencanaan_by_id_skpd($id_skpd);
			$data['sasaran_strategis'] = $this->renja_rka_model->get_sasaran_strategis_by_id_skpd($id_skpd);
			$data['iku_sasaran_strategis'] = array();
			foreach ($data['sasaran_strategis'] as $key => $value) {
				$data['iku_sasaran_strategis'][$key] = $this->renja_rka_model->get_iku_sasaran_strategis_by_id_ss($value['id_sasaran_strategis_renstra']);
			}

			$jenis = array('ss','sp','sk');

			for($tahun=2019;$tahun<=2023;$tahun++){
				$data['rencana_kerja'][$tahun] = $this->renja_rka_model->get_rencana_kerja_by_tahun($tahun,$id_skpd);
				$total_capaian = 0;
				$count_total_capaian = 0;

				foreach ($jenis as $j) {
					$data['grafik_rencana_kerja_ss'][$tahun] = $this->renja_rka_model->get_grafik_rencana_kerja_by_tahun($j,$tahun,$id_skpd);
					$name = $this->renja_rka_model->name($j);
					$taIkuRenja = $name['taIkuRenja'];
					$rIkuRenja = $name['rIkuRenja'];

					foreach ($data['grafik_rencana_kerja_ss'][$tahun] as $i) {
						$target = $i->$taIkuRenja;
						$realisasi = $i->$rIkuRenja;
						$pola = $i->polorarisasi;
						$capaian = get_capaian($target,$realisasi,$pola);

						$total_capaian += $capaian;
						$count_total_capaian++;
					}
				}

				$data['grafik_capaian'][$tahun] = ($count_total_capaian>0) ? $total_capaian/$count_total_capaian : 0;
			}
			
			$data['misi'] = $this->ref_visi_misi_model->get_all_m();

			$this->load->view('admin/index',$data);


		}
		else
		{
			redirect('admin');
		}
	}

	public function detail($id_skpd,$tahun)
	{
		if ($this->user_id)
		{
			$data['title']		= "Detail Renja Unit Kerja Anggaran - Admin ";
			$data['content']	= "renja/rka/detail" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "ref_skpd";

			$jenis = array('ss'=>'Sasaran Strategis','sp'=>'Sasaran Program','sk'=>'Sasaran Kegiatan');
			if(!empty($_POST)){
				if (isset($_POST['tambah_rka'])) {
					unset($_POST['tambah_rka']);
					unset($_POST['id_rka']);
					$query = $this->renja_rka_model->insert_rka($_POST);
					if ($query) {
						$this->session->set_flashdata('type', 'success');
						$this->session->set_flashdata('msg', 'Berhasil Tambah DPA.');
					} else {
						$this->session->set_flashdata('type', 'danger');
						$this->session->set_flashdata('msg', 'Gagal Tambah DPA.');
					}
				} elseif (isset($_POST['update_rka'])) {
					$post_data['kode_rka'] = $_POST['kode_rka'];
					$post_data['nama_rka'] = $_POST['nama_rka'];
					$post_data['anggaran'] = $_POST['anggaran'];
					$query = $this->renja_rka_model->update_rka($post_data,$_POST['id_rka']);
					if ($query) {
						$this->session->set_flashdata('type', 'success');
						$this->session->set_flashdata('msg', 'Berhasil Update DPA.');
					} else {
						$this->session->set_flashdata('type', 'danger');
						$this->session->set_flashdata('msg', 'Gagal Update DPA.');
					}
				} elseif (isset($_POST['delete_rka'])) {
					$query = $this->renja_rka_model->delete_rka($_POST['id_rka']);
					if ($query) {
						$this->session->set_flashdata('type', 'success');
						$this->session->set_flashdata('msg', 'Berhasil Hapus DPA.');
					} else {
						$this->session->set_flashdata('type', 'danger');
						$this->session->set_flashdata('msg', 'Gagal Hapus DPA.');
					}
				}
			}

			$data['tahun'] = $tahun;
			$data['id_skpd'] = $id_skpd;
			$data['skpd'] = $this->ref_skpd_model->get_by_id($id_skpd);
			$data['kepala_skpd'] = $this->ref_skpd_model->get_kepala_skpd($id_skpd);
			$data['jumlah_pegawai'] = $this->master_pegawai_model->get_jml_by_id_skpd($id_skpd);
			
			$is_renja_exist = false;
			foreach($jenis as $key => $value){
				$renja = $this->renja_rka_model->get_renja_skpd($key,$id_skpd,$tahun);
				if(!empty($renja)){
					$is_renja_exist = true;
					break;
				}
			}

			$data['is_renja_skpd_exist'] = $is_renja_exist;

			$data['jenis'] = $jenis;
			$data['unit_kerja'] = $this->ref_skpd_model->get_all_unit_kerja_by_id_skpd($id_skpd);

			$this->load->view('admin/index',$data);


		}
		else
		{
			redirect('admin');
		}
	}

	public function download_pk_renja($jenis,$id_skpd,$tahun,$id_unit_kerja=''){
		
		$phpWord = new \PhpOffice\PhpWord\PhpWord();
		$phpWord->getCompatibility()->setOoxmlVersion(14);
		$phpWord->getCompatibility()->setOoxmlVersion(15);

		$kepala = $this->ref_skpd_model->get_kepala_skpd($id_skpd);
		if($jenis=='skpd'){
			$template = 'PK_Kepala';
			$detail = $this->ref_skpd_model->get_by_id($id_skpd);
			$namafile = "Perjanjian Kinerja SKPD ".$detail->nama_skpd." Tahun ".$tahun;
		}elseif($jenis=='unit_kerja'){
			$template = 'PK_pegawai';
			$detail = $this->ref_skpd_model->get_unit_kerja_by_id($id_unit_kerja);
			$namafile = "Perjanjian Kinerja Unit Kerja ".$detail->nama_unit_kerja." Tahun ".$tahun;
			$kepala_unit_kerja = $this->ref_skpd_model->get_kepala_unit_kerja($id_unit_kerja);
		}else{
			show_404();
		}
		$jenis_sasaran = array('ss'=>'Sasaran Strategis','sp'=>'Sasaran Program','sk'=>'Sasaran Kegiatan');
		$filename = $namafile.".docx";

		$template_path = './template/'.$template.'.docx';
		$template = $phpWord->loadTemplate($template_path);


		$template->setValue('tahun', $tahun);
		$template->setValue('tanggal_unduh', tanggal(date('Y-m-d')));
		$template->setValue('nama_skpd', $detail->nama_skpd);
		$template->setValue('nama_pegawai', $kepala->nama_lengkap);
		$template->setValue('nama_jabatan', "Kepala SKPD ".$detail->nama_skpd);
		if($jenis=='unit_kerja'){
			$template->setValue('nama_pegawai_a',$kepala_unit_kerja->nama_lengkap);
			$template->setValue('nama_jabatan_a',$kepala_unit_kerja->nama_jabatan);
		}

		$total_iku = 0;
		$array_iku = array();
		foreach($jenis_sasaran as $j => $v){
			$name = $this->renja_rka_model->name($j);
			if($jenis=='skpd'){
				$sasaran = $this->renja_rka_model->get_sasaran_skpd($j,$id_skpd,$tahun);
			}else{
				$sasaran = $this->renja_rka_model->get_sasaran($j,$id_unit_kerja,$tahun);

			}
			$jumlah_iku = 0;
			foreach($sasaran as $s){
				$tSasaran = $name['tSasaran'];
				$cSasaran = $name['cSasaran'];
				if($jenis=='skpd'){
					$iku = $this->renja_rka_model->get_iku_skpd($j,$s->$cSasaran,$tahun,$id_skpd);
				}else{
					$iku = $this->renja_rka_model->get_iku($j,$s->$cSasaran,$tahun,$id_unit_kerja);
					foreach($iku as $k => $v){
						$iku[$k]->$tSasaran = $s->$tSasaran;
					}
				}
				foreach($iku as $i){
					$jumlah_iku++;
				}
			}
			if($jumlah_iku!=0){
				$total_iku += $jumlah_iku;
				foreach($iku as $i){
					$i->j = $j;
					$array_iku[] = $i;
				}
			}
		}
		$template->cloneRow('nama_sasaran',$total_iku);
		foreach($array_iku as $k => $i){
			$no = $k+1;
			$j = $i->j;
			// echo $no.' '.$j.'<br>';
			$name = $this->renja_rka_model->name($j);
			$tSasaran = $name['tSasaran'];
			$cSasaran = $name['cSasaran'];
			$tIku = $name['tIku'];
			$cIku = $name['cIku'];
			$cIkuRenja = $name['cIkuRenja'];
			$taIkuRenja = $name['taIkuRenja'];
			$aIkuRenja = $name['aIkuRenja'];
			$rIkuRenja = $name['rIkuRenja'];
			if($j=='ss'){
				$program = $this->renja_rka_model->get_program_by_iku_ss($i->$cIku);
				$list_program = "";
				foreach($program as $p){
					$list_program .= "- ".$p->sasaran_program_renstra."</w:t><w:br/><w:t>";
				}
				if(empty($list_program)){
					$list_program = "-";
				}
				$template->setValue('list_program#'.$no,$list_program,1,true);
				$template->setValue('anggaran_indikator#'.$no,rupiah($i->anggaran_kegiatan));
			}elseif($j=='sp'){
				$kegiatan = $this->renja_rka_model->get_kegiatan_by_iku_sp($i->$cIku);
				$list_kegiatan = "";
				$anggaran_program = "";
				foreach($kegiatan as $p){
					$list_kegiatan .= "- ".$p->sasaran_kegiatan_renstra."</w:t><w:br/><w:t>";
				}

				if(empty($list_kegiatan)){
					$list_kegiatan = "-";
				}
				$template->setValue('list_kegiatan#'.$no,$list_kegiatan,1,true);
				$template->setValue('anggaran_indikator#'.$no,rupiah($i->anggaran_kegiatan));
			}else{
				$template->setValue('list_kegiatan#'.$no,"-",1,true);
				$template->setValue('anggaran_indikator#'.$no,rupiah($i->$aIkuRenja));
			}
			$template->setValue('no_rkt#'.$no,$no);
			$template->setValue('nama_sasaran#'.$no,$i->$tSasaran);
			$template->setValue('nama_indikator#'.$no,$i->$tIku);
			$template->setValue('target_indikator#'.$no,$i->$taIkuRenja);
		}
		// die; 
		ob_clean();
		$template->saveAs("./data/perjanjian_kinerja/".$filename);
		header('Content-Description: File Transfer');
		header('Content-Type: application/octet-stream');
		header('Content-Disposition: attachment; filename='.$filename);
		header('Content-Transfer-Encoding: binary');
		header('Expires: 0');
		header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
		header('Pragma: public');
		header('Content-Length: ' . filesize("./data/perjanjian_kinerja/".$filename));
		flush();
		readfile("./data/perjanjian_kinerja/".$filename);
	}

	public function edit()
	{
		if ($this->user_id)
		{
			$data['title']		= "edit renja - Admin ";
			$data['content']	= "renja/rka/edit" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "ref_skpd";
			$this->load->view('admin/index',$data);

		}
		else
		{
			redirect('admin');
		}
	}


	public function detail_iku($id_skpd,$jenis,$id_iku)
	{
		if ($this->user_id)
		{
			$data['title']		= "Detail IKU Renja - Admin ";
			$data['content']	= "renja/rka/detail_iku" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "ref_skpd";
			$name = $this->renja_rka_model->name($jenis);

			$data['name'] = $name;

			foreach($data['name'] as $k => $v){
				$data[$k] = $v;
				$$k = $v;
			}

			if(!empty($_POST)){
				if(isset($_POST['tambah_renaksi'])){
					$insert_renaksi = array($tRenaksi=>$_POST['renaksi'],$cIkuRenja=>$id_iku,'perhitungan_atasan'=>$_POST['perhitungan_atasan']);
					$insert_renaksi = $this->renja_rka_model->insert_renaksi($jenis,$insert_renaksi);
					for($i=1;$i<=12;$i++){
						if(!isset($_POST['status_jadwal_'.$i])){
							$_POST['status_jadwal_'.$i] = 'tidak_dijadwalkan';
						}
						if(!isset($_POST['target_'.$i])){
							$_POST['target_'.$i] = 0;
						}
						$insert_target_renaksi = array('bulan'=>$i,$cRenaksi=>$insert_renaksi,'status_jadwal'=>$_POST['status_jadwal_'.$i],'target'=>$_POST['target_'.$i]);
						$insert_target_renaksi = $this->renja_rka_model->insert_target_renaksi($jenis,$insert_target_renaksi);
					}
				}elseif(isset($_POST['ubah_renaksi'])){
					$id_renaksi = $_POST['id_renaksi'];
					$update_renaksi = array($tRenaksi=>$_POST['renaksi']);
					$update_renaksi = $this->renja_rka_model->update_renaksi($jenis,$update_renaksi,$id_renaksi);
					for($i=1;$i<=12;$i++){
						if(!isset($_POST['status_jadwal_'.$i])){
							$_POST['status_jadwal_'.$i] = 'tidak_dijadwalkan';
						}
						if(!isset($_POST['target_'.$i])){
							$_POST['target_'.$i] = 0;
						}
						$update_target_tenaksi = array('status_jadwal'=>$_POST['status_jadwal_'.$i],'target'=>$_POST['target_'.$i]);
						$update_target_tenaksi = $this->renja_rka_model->update_target_renaksi($jenis,$update_target_tenaksi,$id_renaksi,$i);
					}
				}elseif(isset($_POST['update_target_renaksi'])){
					$name = $this->renja_rka_model->name($jenis);
					$id_target_renaksi = $_POST['id_target_renaksi'];

					$target = $this->renja_rka_model->get_target_renaksi_by_id($jenis,$id_target_renaksi);

					if(isset($_POST['perhitungan_capaian_renaksi'])){
						if($_POST['perhitungan_capaian_renaksi']=="otomatis"){
							$t = $target->target;
							$realisasi = $_POST['realisasi_target'];
							$pola = $target->polorarisasi;
							$capaian = get_capaian($t,$realisasi,$pola);
							$_POST['capaian'] = $capaian;
						}
					}else{
						$_POST['perhitungan_capaian_renaksi'] = 'manual';
					}

					$id_renaksi = $name['cRenaksi'];
					$id_renaksi = $target->$id_renaksi;

					$realisasi_before_update = $target->realisasi;
					$realisasi_after_update = $_POST['realisasi_target'];
					$hasil_realisasi = $realisasi_after_update - $realisasi_before_update;


					$update = array('realisasi'=>$_POST['realisasi_target'],'link_dokumen_pendukung'=>$_POST['link_dokumen_pendukung'],'capaian'=>$_POST['capaian'],'perhitungan_capaian_renaksi'=>$_POST['perhitungan_capaian_renaksi']);
					if ($_FILES['dokumen_pendukung']['tmp_name']!=''){
						$config['upload_path']          = './data/dokumen_renaksi/';
						$config['allowed_types']        = 'docx|doc|xls|xlsx|pdf|jpg|jpeg|png|gif|rar|zip|ppt|pptx';
						$config['overwrite'] = false;
						$this->load->library('upload', $config);
						if ( ! $this->upload->do_upload('dokumen_pendukung')){
							$data['message_type'] = "danger";
							$data['message'] 	= $this->upload->display_errors();
							print_r($data['message']);die;
						}else{
							$update['dokumen_pendukung'] = $this->upload->data('file_name');
						}
					}
					$update_target_tenaksi = $this->renja_rka_model->update_target_renaksi_by_id($jenis,$update,$id_target_renaksi);



					$name = $this->renja_rka_model->name($jenis);

					$detail_iku = $this->renja_rka_model->get_iku_renja_by_id($jenis,$id_iku);
					//INSERT KINERJA PEGAWAI
					if($jenis=="ss"){
						$data_kepala = $this->ref_skpd_model->get_kepala_skpd($id_skpd);

					}else{
						$data_kepala = $this->ref_skpd_model->get_kepala_unit_kerja($detail_iku->id_unit_kerja);
					}
					if(isset($data_kepala->id_pegawai)){
						$id_pegawai = $data_kepala->id_pegawai;
						$this->load->model('master_pegawai_model');
						$pegawai = $this->master_pegawai_model->get_by_id($id_pegawai);
						$iku = $this->renja_rka_model->get_iku_renja_by_id($jenis,$id_iku);
						$target = $name['taIkuRenja'];
						$target = $iku->$target;
						$realisasi = $name['rIkuRenja'];
						$realisasi = $iku->$realisasi;
						$total_realisasi = $realisasi + $hasil_realisasi;

						$renaksi = $this->renja_rka_model->get_renaksi_by_id($jenis,$id_renaksi);
						if(empty($renaksi->perhitungan_atasan)){
							//
						}else{
							$update_iku = array($name['rIkuRenja']=>$total_realisasi);
							$update_iku = $this->renja_rka_model->update_iku_renja($jenis,$update_iku,$id_iku);

							$kinerja_pegawai = array(
								'id_pegawai' => $id_pegawai,
								'nip' => $pegawai->nip,
								'id_skpd' => $pegawai->id_skpd,
								'id_unit_kerja' => $pegawai->id_unit_kerja,
								'jenis_sasaran' => $jenis,
								'id_iku' => $id_iku,
								'realisasi' => $hasil_realisasi,
								'target' => $target
							);

							$this->load->model('kinerja_pegawai_model');
							$insert_kinerja = $this->kinerja_pegawai_model->insert($kinerja_pegawai);
						}
					}

				}elseif(isset($_POST['hapus_renaksi'])){
					$delete = $this->renja_rka_model->hapus_renaksi($jenis,$_POST['id_renaksi']);
				}
			}


			$data['id_skpd'] = $id_skpd;
			$data['detail'] = $this->renja_rka_model->get_iku_renja_by_id($jenis,$id_iku);
			if($data['detail']->jenis_renja=='skpd'){
				$data['skpd'] = $this->ref_skpd_model->get_by_id($id_skpd);
				$data['kepala'] = $this->ref_skpd_model->get_kepala_skpd($id_skpd);
				$data['staff'] = $this->master_pegawai_model->get_jml_by_id_skpd($id_skpd);
				$data['detail']->nama_unit_kerja = $data['skpd']->nama_skpd;
			}else{
				$data['kepala'] = $this->ref_skpd_model->get_kepala_unit_kerja($data['detail']->id_unit_kerja);
				$data['staff'] = count($this->ref_skpd_model->get_staff_unit_kerja($data['detail']->id_unit_kerja));
			}
			$data['renaksi'] = $this->renja_rka_model->get_renaksi($jenis,$id_iku);
			$jj = array('ss'=>'Sasaran Strategis','sp'=>'Sasaran Program','sk'=>'Sasaran Kegiatan');
			foreach($jj as $n => $j){
				if($n==$jenis){
					$data['nama_jenis'] = $j;
					$data['jenis'] = $n;
				}
			}

			if(isset($data['kepala']->id_pegawai)){
				$data['id_kepala'] = $data['kepala']->id_pegawai;
			}else{
				$data['id_kepala'] = 0;
			}


			$this->load->view('admin/index',$data);


		}
		else
		{
			redirect('admin');
		}
	}

	public function get_rka($id_rka){
		$get = $this->renja_rka_model->get_rka_by_id($id_rka);
		echo json_encode($get);
	}

	public function get_iku_renja($jenis,$id_iku){
		$get = $this->renja_rka_model->get_iku_renja_by_id($jenis,$id_iku);
		$name = $this->renja_rka_model->name($jenis);
		$realisasi_renja = $name['rIkuRenja'];
		$get->realisasi = $get->$realisasi_renja;
		echo json_encode($get);
	}

	public function get_renaksi($jenis,$id_renaksi){
		$q = $this->renja_rka_model->get_renaksi_by_id($jenis,$id_renaksi);
		$target = $this->renja_rka_model->get_target_renaksi_by_renaksi($jenis,$id_renaksi);
		$name = $this->renja_rka_model->name($jenis);
		$tRenaksi = $name['tRenaksi'];
		$cRenaksi = $name['cRenaksi'];
		foreach($target as $t){
			$bulan = $t->bulan;
			$sStatusJadwal = 'status_jadwal_'.$bulan;
			$sTarget = 'target_'.$bulan;
			$q->renaksi = $q->$tRenaksi;
			$q->id_renaksi = $q->$cRenaksi;
			$q->$sStatusJadwal = $t->status_jadwal;
			$q->$sTarget = $t->target;
		}
		echo json_encode($q);
	}

	public function get_target_renaksi($jenis,$id_target_renaksi){
		$target = $this->renja_rka_model->get_target_renaksi_by_id($jenis,$id_target_renaksi);
		echo json_encode($target);
	}

	public function get_iku_sasaran_by_unit_kerja($id_unit_kerja,$tahun){
		$jenis = array('ss'=>'Sasaran Strategis','sp'=>'Sasaran Program','sk'=>'Sasaran Kegiatan');
		foreach($jenis as $key => $value){
			$name = $this->renja_rka_model->name($key);
			$iku = $this->renja_rka_model->get_casecade_sasaran_by_unit_kerja($key,$id_unit_kerja);
			if(!empty($iku)){
				$renja = $this->renja_rka_model->get_renja_unit_kerja($key,$id_unit_kerja,$tahun);
				$tSasaran = $name['tSasaran'];
				$cSasaran = $name['cSasaran'];
				$id_iku = $name['cIku'];
				echo '
				<input type="hidden" name="id_unit_kerja" value="'.$id_unit_kerja.'">
				<input type="hidden" name="tahun_renja" value="'.$tahun.'">
				<span style="font-weight:500;">
				<i style="font-size:15px;color:#fff;background-color:#6003c8;padding:5px;border-radius:50%" class="ti-target"></i> <span style="border-bottom:solid 2px #6003c8;padding-bottom:3px;">
				'.($value).'</span></span><br>';
				echo '<table style="margin-top:15px;margin-bottom:30px" class="table color-table muted-table table-bordered text-center" >
				<thead>
				<tr>
				<th>
				<div class="checkbox checkbox-primary text-center">
				<input id="checkbox1" type="checkbox" class="checkall" checked onclick="checkAll()">
				<label for="checkbox1"></label>
				</div>
				</th>
				<th class="text-center">Indikator</th>
				<th class="text-center">Target</th>
				<th class="text-center">Satuan</th>
				<th class="text-center">Anggaran</th>
				</tr>
				</thead>
				<tbody id="tablePKPerubahan">';
				if(empty($renja)){
					$no=1;
					$group = array();
					foreach ($iku as $element) {
						$group[$element->$cSasaran][] = $element;
					}


					foreach($group as $id_sasaran => $iku){
						$detail_sasaran = $this->renja_rka_model->get_detail_sasaran($key,$id_sasaran);
						echo '
						<tr style="background-color:#f1e7fe	;">
						<td colspan="5" style="text-align:left"><span style="color:#6003C8;font-weight:700;">'.$value.'</span> '.$detail_sasaran->$tSasaran.'</td>
						</tr>';
						foreach($iku as $i){
							$iku = $name['tIku'];
							$id_iku = $name['cIku'];
							$taIkuRenja = $name['taIkuRenja'];
							$vTarget = 'target_'.$tahun;
							$vAnggaran = 'anggaran_'.$tahun;
							$id = "'$key$no'";
							echo'<tr>
							<td>
							<div class="checkbox checkbox-primary">
							<input id="cb_'.$key.$no.'" onclick="cekParent('.$id.')" name="'.$id_iku.'[]" value="'.$i->$id_iku.'" type="checkbox" checked class="child">
							<label for="checkbox2"></label>
							</div>
							</td>
							<td style="vertical-align:middle">'.$i->$iku.'</td>
							<td>
							<input id="target_'.$key.$no.'" type="text" class="form-control" value="'.$i->$vTarget.'" name="'.$taIkuRenja.$i->$id_iku.'" placeholder="Masukkan Target">
							</td>
							<td style="vertical-align:middle">'.$i->satuan.'</td>
							<td>
							<input id="anggaran_'.$key.$no.'" type="text" class="form-control" value="'.$i->$vAnggaran.'" name="anggaran_'.$key.'_renja'.$i->$id_iku.'" placeholder="Masukkan Anggaran">
							</td>
							</tr>';
							$no++;
						}
					}
				}else{
					
					$no=1;

					$group = array();

					foreach($renja as $element){
						$element->jenis = 'renja';
						$group[$element->$cSasaran][] = $element;
					}
					foreach ($iku as $element) {
						foreach($renja as $r){
							if($element->$id_iku==$r->$id_iku){
								continue(2);
							}
						}
						$element->jenis = 'iku';
						$group[$element->$cSasaran][] = $element;
					}

					foreach($group as $id_sasaran => $iku){
						$detail_sasaran = $this->renja_rka_model->get_detail_sasaran($key,$id_sasaran);
						echo '
						<tr style="background-color:#f1e7fe	;">
						<td colspan="5" style="text-align:left"><span style="color:#6003C8;font-weight:700;">'.$value.'</span> '.$detail_sasaran->$tSasaran.'</td>
						</tr>';
						foreach($iku as $i){
							if($i->jenis=='renja'){
								$tIku = $name['tIku'];
								$cIkuRenja = $name['cIkuRenja'];
								$id_iku = $name['cIku'];
								$taIkuRenja = $name['taIkuRenja'];
								$aIkuRenja = $name['aIkuRenja'];
								$vTarget = 'target_'.$tahun;
								$vAnggaran = 'anggaran_'.$tahun;
								$id = "'$key$no'";
								echo'
								<tr>
								<td>
								<div class="checkbox checkbox-primary">
								<input type="hidden" value="'.$i->$cIkuRenja.'" name="'.$cIkuRenja.$i->$id_iku.'">
								<input id="cb_'.$key.$no.'" onclick="cekParent('.$id.')" name="'.$id_iku.'[]" value="'.$i->$id_iku.'" type="checkbox" checked class="child">
								<label for="checkbox2"></label>
								</div>
								</td>
								<td style="vertical-align:middle">'.$i->$tIku.'</td>
								<td>
								<input id="target_'.$key.$no.'" type="text" class="form-control" value="'.$i->$taIkuRenja.'" name="'.$taIkuRenja.$i->$id_iku.'" placeholder="Masukkan Target">
								</td>
								<td style="vertical-align:middle">'.$i->satuan.'</td>
								<td>
								<input id="anggaran_'.$key.$no.'" type="text" class="form-control" value="'.$i->$aIkuRenja.'" name="anggaran_'.$key.'_renja'.$i->$id_iku.'" placeholder="Masukkan Anggaran">
								</td>
								</tr>';
							}elseif($i->jenis=='iku'){

								$tIku = $name['tIku'];
								$id_iku = $name['cIku'];
								$taIkuRenja = $name['taIkuRenja'];
								$vTarget = 'target_'.$tahun;
								$vAnggaran = 'anggaran_'.$tahun;
								$id = "'$key$no'";
								echo'<tr>
								<td>
								<div class="checkbox checkbox-primary">
								<input id="cb_'.$key.$no.'" onclick="cekParent('.$id.')" name="'.$id_iku.'[]" value="'.$i->$id_iku.'" type="checkbox" class="child">
								<label for="checkbox2"></label>
								</div>
								</td>
								<td style="vertical-align:middle">'.$i->$tIku.'</td>
								<td>
								<input id="target_'.$key.$no.'" type="text" class="form-control" value="'.$i->$vTarget.'" name="'.$taIkuRenja.$i->$id_iku.'" placeholder="Masukkan Target">
								</td>
								<td style="vertical-align:middle">'.$i->satuan.'</td>
								<td>
								<input id="anggaran_'.$key.$no.'" type="text" class="form-control" value="'.$i->$vAnggaran.'" name="anggaran_'.$key.'_renja'.$i->$id_iku.'" placeholder="Masukkan Anggaran">
								</td>
								</tr>';
							}
							$no++;
						}
					}
				}
				echo'
				</tbody>
				</table>';
			}
		}
	}



	function get_tujuan_by_misi($id_misi=null)
	{
		if($id_misi==null){
			$id_misi = $this->input->get('id_misi');
		}
		$this->load->model('ref_visi_misi_model');
		$data['tujuan'] = $this->ref_visi_misi_model->get_all_t_by_id_m($id_misi);
		echo '<option value="">Pilih Tujuan</option>';
		foreach ($data['tujuan'] as $key) {
			echo "<option value='{$key->id_tujuan}'>{$key->tujuan}</option>";
		}
	}

	public function get_iku_sasaran_by_skpd($id_skpd,$tahun){
		$jenis = array('ss'=>'Sasaran Strategis');
		foreach($jenis as $key => $value){
			$name = $this->renja_rka_model->name($key);
			$iku = $this->renja_rka_model->get_casecade_sasaran_by_skpd($key,$id_skpd);
			if(!empty($iku)){
				$renja = $this->renja_rka_model->get_renja_skpd($key,$id_skpd,$tahun);
				// print_r($renja);die;
				$tSasaran = $name['tSasaran'];
				$cSasaran = $name['cSasaran'];
				$id_iku = $name['cIku'];
				echo '
				<input type="hidden" name="id_skpd" value="'.$id_skpd.'">
				<input type="hidden" name="tahun_renja" value="'.$tahun.'">
				<span style="font-weight:500;">
				<i style="font-size:15px;color:#fff;background-color:#6003c8;padding:5px;border-radius:50%" class="ti-target"></i> <span style="border-bottom:solid 2px #6003c8;padding-bottom:3px;">
				'.($value).'</span></span><br>';
				echo '<table style="margin-top:15px;margin-bottom:30px" class="table color-table muted-table table-bordered text-center" >
				<thead>
				<tr>
				<th>
				<div class="checkbox checkbox-primary text-center">
				<input id="checkbox1" type="checkbox" class="checkall" checked onclick="checkAll()">
				<label for="checkbox1"></label>
				</div>
				</th>
				<th class="text-center">Indikator</th>
				<th class="text-center">Target</th>
				<th class="text-center">Satuan</th>
				<th class="text-center">Anggaran</th>
				</tr>
				</thead>
				<tbody id="tablePKPerubahan">';
				if(empty($renja)){
					$no=1;
					$group = array();
					foreach ($iku as $element) {
						$group[$element->$cSasaran][] = $element;
					}


					foreach($group as $id_sasaran => $iku){
						$detail_sasaran = $this->renja_rka_model->get_detail_sasaran($key,$id_sasaran);
						echo '
						<tr style="background-color:#f1e7fe	;">
						<td colspan="5" style="text-align:left"><span style="color:#6003C8;font-weight:700;">'.$value.'</span> '.$detail_sasaran->$tSasaran.'</td>
						</tr>';
						foreach($iku as $i){
							$iku = $name['tIku'];
							$id_iku = $name['cIku'];
							$taIkuRenja = $name['taIkuRenja'];
							$vTarget = 'target_'.$tahun;
							$vAnggaran = 'anggaran_'.$tahun;
							$id = "'$key$no'";
							echo'<tr>
							<td>
							<div class="checkbox checkbox-primary">
							<input id="cb_'.$key.$no.'" onclick="cekParent('.$id.')" name="'.$id_iku.'[]" value="'.$i->$id_iku.'" type="checkbox" checked class="child">
							<label for="checkbox2"></label>
							</div>
							</td>
							<td style="vertical-align:middle">'.$i->$iku.'</td>
							<td>
							<input id="target_'.$key.$no.'" type="text" class="form-control" value="'.$i->$vTarget.'" name="'.$taIkuRenja.$i->$id_iku.'" placeholder="Masukkan Target">
							</td>
							<td style="vertical-align:middle">'.$i->satuan.'</td>
							<td>
							<input id="anggaran_'.$key.$no.'" type="text" class="form-control" value="'.$i->$vAnggaran.'" name="anggaran_'.$key.'_renja'.$i->$id_iku.'" placeholder="Masukkan Anggaran">
							</td>
							</tr>';
							$no++;
						}
					}
				}else{
					$no=1;

					$group = array();

					foreach($renja as $element){
						$element->jenis = 'renja';
						$group[$element->$cSasaran][] = $element;
					}
					foreach ($iku as $element) {
						foreach($renja as $r){
							if($element->$id_iku==$r->$id_iku){
								continue(2);
							}
						}
						$element->jenis = 'iku';
						$group[$element->$cSasaran][] = $element;
					}

					foreach($group as $id_sasaran => $iku){
						$detail_sasaran = $this->renja_rka_model->get_detail_sasaran($key,$id_sasaran);
						echo '
						<tr style="background-color:#f1e7fe	;">
						<td colspan="5" style="text-align:left"><span style="color:#6003C8;font-weight:700;">'.$value.'</span> '.$detail_sasaran->$tSasaran.'</td>
						</tr>';
						foreach($iku as $i){
							if($i->jenis=='renja'){
								$tIku = $name['tIku'];
								$cIkuRenja = $name['cIkuRenja'];
								$id_iku = $name['cIku'];
								$taIkuRenja = $name['taIkuRenja'];
								$aIkuRenja = $name['aIkuRenja'];
								$vTarget = 'target_'.$tahun;
								$vAnggaran = 'anggaran_'.$tahun;
								$id = "'$key$no'";
								echo'
								<tr>
								<td>
								<div class="checkbox checkbox-primary">
								<input type="hidden" value="'.$i->$cIkuRenja.'" name="'.$cIkuRenja.$i->$id_iku.'">
								<input id="cb_'.$key.$no.'" onclick="cekParent('.$id.')" name="'.$id_iku.'[]" value="'.$i->$id_iku.'" type="checkbox" checked class="child">
								<label for="checkbox2"></label>
								</div>
								</td>
								<td style="vertical-align:middle">'.$i->$tIku.'</td>
								<td>
								<input id="target_'.$key.$no.'" type="text" class="form-control" value="'.$i->$taIkuRenja.'" name="'.$taIkuRenja.$i->$id_iku.'" placeholder="Masukkan Target">
								</td>
								<td style="vertical-align:middle">'.$i->satuan.'</td>
								<td>
								<input id="anggaran_'.$key.$no.'" type="text" class="form-control" value="'.$i->$aIkuRenja.'" name="anggaran_'.$key.'_renja'.$i->$id_iku.'" placeholder="Masukkan Anggaran">
								</td>
								</tr>';
							}elseif($i->jenis=='iku'){

								$tIku = $name['tIku'];
								$id_iku = $name['cIku'];
								$taIkuRenja = $name['taIkuRenja'];
								$vTarget = 'target_'.$tahun;
								$vAnggaran = 'anggaran_'.$tahun;
								$id = "'$key$no'";
								echo'<tr>
								<td>
								<div class="checkbox checkbox-primary">
								<input id="cb_'.$key.$no.'" onclick="cekParent('.$id.')" name="'.$id_iku.'[]" value="'.$i->$id_iku.'" type="checkbox" class="child">
								<label for="checkbox2"></label>
								</div>
								</td>
								<td style="vertical-align:middle">'.$i->$tIku.'</td>
								<td>
								<input id="target_'.$key.$no.'" type="text" class="form-control" value="'.$i->$vTarget.'" name="'.$taIkuRenja.$i->$id_iku.'" placeholder="Masukkan Target">
								</td>
								<td style="vertical-align:middle">'.$i->satuan.'</td>
								<td>
								<input id="anggaran_'.$key.$no.'" type="text" class="form-control" value="'.$i->$vAnggaran.'" name="anggaran_'.$key.'_renja'.$i->$id_iku.'" placeholder="Masukkan Anggaran">
								</td>
								</tr>';
							}
							$no++;
						}
					}
					// if(count($iku)!==count($renja)){
					// 	echo'
					// 	<tr>
					// 	<td style="background-color:#98A6AD;color:#fff" colspan="5"><center><b><i class="ti-alert"></i> Indikator yang tidak diturunkan</b></center></td>
					// 	</tr>
					// 	';
					// }
					

				}
				echo'
				</tbody>
				</table>';
			}
		}
	}


}
?>
