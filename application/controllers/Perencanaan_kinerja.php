<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Perencanaan_kinerja extends CI_Controller {
	public $user_id;

	public function __construct(){
		parent ::__construct();
		$this->user_id = $this->session->userdata('user_id');
		$this->user_level = $this->session->userdata('user_level');
		$this->default_tahun = 2019;
		$this->load->model('visitor_model');
		$this->load->model('berkas_model');
		$this->load->model('berkas_file_model');
		$this->load->model('ref_kategori_berkas_model');
		$this->load->model('ref_unit_kerja_model');
		$this->load->model('ref_visi_misi_model');
		$this->load->model('sasaran_rpjmd_model');
		$this->load->model('skpd_model');
		$this->load->model('ref_skpd_model');
		$this->load->model('renstra_perencanaan_model');
		$this->load->model('renstra_reviu_model');
		$this->load->model('renstra_perencanaan_model');
		$this->load->model('renja_perencanaan_model');
		$this->load->model('renstra_realisasi_model');
		$this->jenis = array('ss'=>'sasaran_strategis','sp'=>'sasaran_program','sk'=>'sasaran_kegiatan');
		$this->load->helper('text');
		$this->load->helper('typography');
		$this->load->helper('file');
		$this->visitor_model->cek_visitor();
		$this->load->model('company_profile_model');

		$this->company_profile_model->set_identity();
	}

	public function index($tahun=null,$level=0,$id_induk=null)
	{

		$valid_tahun = [2017,2018,2019,2020,2021,2022,2023,2024,2025,2026];
		if(!in_array($tahun,$valid_tahun)){
			$tahun = $this->default_tahun;
		}

		if ($tahun == null) {
			redirect('perencanaan_kinerja/index/'.$this->default_tahun);
		}
		$data['title'] = "Perancanaan Kinerja - " .$this->company_profile_model->nama;
		$data['active_menu'] ="perencanaan_kinerja";
		$data['level'] = $level;
		$data['id_induk'] = $id_induk;
		$tahun = (empty($tahun)) ? $this->default_tahun : $tahun;


		$this->load->model('berkas_unit_kerja_model');
		$data['tahun'] = $this->berkas_unit_kerja_model->get_tahun();
		$data['tahun_'] = $tahun;
		/*
		if($level<=1){
		$this->ref_unit_kerja_model->level_unit_kerja = array(-1,0);
			$data['unit_kerja'] = $this->ref_unit_kerja_model->get_by_level($tahun);
		}else{
			$this->ref_unit_kerja_model->id_induk = $id_induk;
			$data['unit_kerja'] = $this->ref_unit_kerja_model->get_by_parent($tahun);
		}
		*/
		$data['list'] = $this->ref_skpd_model->get_multiple_jenis(array('skpd','kecamatan'));
		$this->load->view('blog/src/header',$data);
		$this->load->view('blog/src/top_nav',$data);
		$this->load->view('blog/perencanaan_kinerja',$data);
		$this->load->view('blog/src/footer',$data);
	}

	public function iku($id_rkt)
	{
		$data['title'] = "Perancanaan Kinerja - " .$this->company_profile_model->nama;
		$data['active_menu'] ="perencanaan_kinerja";

		$this->load->model('sasaran_strategis_model');
		$this->load->model('sasaran_program_model');
		$this->load->model('sasaran_kegiatan_model');
		$this->load->model('ref_renstra_model');
		$this->load->model('ref_satuan_model');
		$this->load->model('ref_unit_kerja_model');
		$this->load->model('ref_rkt_model');
		$this->load->model('indikator_model');

			$data['renstra'] = $this->ref_renstra_model->get_all_data();
			$data['satuan'] = $this->ref_satuan_model->get_all();
			$data['unit_kerja'] = $this->ref_unit_kerja_model->get_all();
			$data['detail'] = $this->ref_rkt_model->select_by_id($id_rkt);


			$params = array(
				'id_unit' 	=> $data['detail']->id_unit_kerja,
				'tahun'		=> $data['detail']->tahun_rkt,
			);

			if($data['detail']->level_unit_kerja==1||$data['detail']->level_unit_kerja==0){
				$data['sasaran'] = $this->sasaran_strategis_model->getData($params);
				$data['n'] = 'sasaran_strategis';
				$data['j'] = 'Sasaran Strategis';
				$data['type'] = 'SS';
			}elseif($data['detail']->level_unit_kerja==2){
				$data['sasaran'] = $this->sasaran_program_model->getData($params);
				$data['n'] = 'sasaran_program';
				$data['j'] = 'Sasaran Program';
				$data['type'] = 'SP';
			}else{
				$data['sasaran'] = $this->sasaran_kegiatan_model->getData($params);
				$data['n'] = 'sasaran_kegiatan';
				$data['j'] = 'Sasaran Kegiatan';
				$data['type'] = 'SK';

			}

			$data['tahun'] = $this->ref_rkt_model->get_tahun();

			$tahun_rkt = date('Y');
			if(!empty($_POST['tahun_rkt'])) $tahun_rkt = $_POST['tahun_rkt'];
			$data['tahun_rkt'] = $tahun_rkt;

			$this->load->model('ref_visi_misi_model');
			$data['visi'] = $this->ref_visi_misi_model->get_visi_r();
			$data['misi'] = $this->ref_visi_misi_model->get_all_m_r();

		$this->load->view('blog/src/header',$data);
		$this->load->view('blog/src/top_nav',$data);
		$this->load->view('blog/iku',$data);
		$this->load->view('blog/src/footer',$data);

	}

	// public function detail($id_berkas)
	// {
	// 	if ($id_berkas) {


	// 		$this->berkas_model->id_berkas = $id_berkas;
	// 		$data['detail'] = $this->berkas_model->get_for_detail();
	// 		if(empty($data['detail'])){
	// 			redirect('perencanaan_kinerja');
	// 		}else{
	// 			if($data['detail']->data_rahasia){
	// 				redirect('perencanaan_kinerja');
	// 			}
	// 		}
	// 		if (!empty($_GET['s'])) {
	// 			$this->berkas_model->search = $_GET['s'];
	// 			$data['search'] = $_GET['s'];
	// 		}
	// 		if (!empty($_GET['c'])) {
	// 			$this->berkas_model->search_c = $_GET['c'];
	// 			$data['search_c'] = $_GET['c'];
	// 		}
	// 		$this->berkas_model->id_berkas = $id_berkas;
	// 		$data['row'] = $this->berkas_model->get_by_id();

	// 		$data['title'] = "Data dan Pelaporan - " .$data['row']->nama_kegiatan;
	// 		$data['active_menu'] ="perencanaan_kinerja";
	// 		//banner
	// 		$this->load->model('banner_model');
	// 		$data['banner'] = $this->banner_model->get_all();

	// 		$this->load->model('ref_kategori_berkas_model');
	// 		$data['categories']	= $this->ref_kategori_berkas_model->get_all();

	// 		$data['data'] = $this->berkas_model->get_all();
	// 		$data['unit_kerja'] = $this->ref_unit_kerja_model->get_all();
	// 		$this->ref_unit_kerja_model->level_unit_kerja = 1;
	// 		$data['unit_kerja'] = $this->ref_unit_kerja_model->get_by_level();
	// 		$this->ref_unit_kerja_model->id_unit_kerja = $data['detail']->id_unit_kerja;
	// 		$aa = $this->ref_unit_kerja_model->get_by_id();
	// 		$data['level_unit'] = $aa->level_unit_kerja;
	// 		$level = $data['level_unit'];
	// 		if($level==1){
	// 			$data['uk1'] = $data['detail']->id_unit_kerja;
	// 		}
	// 		elseif($level==2){
	// 			$this->ref_unit_kerja_model->id_induk = $aa->id_induk;
	// 			$data['uk2'] = $this->ref_unit_kerja_model->get_by_parent();
	// 			$data['uk2s'] = $data['detail']->id_unit_kerja;
	// 			$data['uk1'] = $aa->id_induk;
	// 		}elseif($level==3){
	// 			$this->ref_unit_kerja_model->id_induk = $aa->id_induk;
	// 			$data['uk3'] = $this->ref_unit_kerja_model->get_by_parent();
	// 			$this->ref_unit_kerja_model->id_unit_kerja = $aa->id_unit_kerja;
	// 			$data['uk3s'] = $this->ref_unit_kerja_model->get_by_id()->id_unit_kerja;
	// 			$data['uk3sp'] = $this->ref_unit_kerja_model->get_by_id()->id_induk;
	// 			$this->ref_unit_kerja_model->id_unit_kerja = $data['uk3sp'];
	// 			$p2 = $this->ref_unit_kerja_model->get_by_id();
	// 			$this->ref_unit_kerja_model->id_induk = $p2->id_induk;
	// 			$data['uk2'] = $this->ref_unit_kerja_model->get_by_parent();
	// 			$this->ref_unit_kerja_model->id_unit_kerja = $data['uk3sp'];
	// 			$data['uk2s'] = $this->ref_unit_kerja_model->get_by_id()->id_unit_kerja;
	// 			$data['uk2sp'] = $this->ref_unit_kerja_model->get_by_id()->id_induk;

	// 			$this->ref_unit_kerja_model->id_unit_kerja = $data['uk2sp'];
	// 			$data['uk1'] = $this->ref_unit_kerja_model->get_by_id()->id_unit_kerja;
	// 		}elseif($level==4){
	// 			$this->ref_unit_kerja_model->id_induk = $aa->id_induk;
	// 			$data['uk4'] = $this->ref_unit_kerja_model->get_by_parent();
	// 			$this->ref_unit_kerja_model->id_unit_kerja = $aa->id_unit_kerja;
	// 			$data['uk4s'] = $this->ref_unit_kerja_model->get_by_id()->id_unit_kerja;
	// 			$data['uk4sp'] = $this->ref_unit_kerja_model->get_by_id()->id_induk;


	// 			$this->ref_unit_kerja_model->id_unit_kerja = $data['uk4sp'];
	// 			$p3 = $this->ref_unit_kerja_model->get_by_id();
	// 			$this->ref_unit_kerja_model->id_induk = $p3->id_induk;
	// 			$data['uk3'] = $this->ref_unit_kerja_model->get_by_parent();

	// 			$this->ref_unit_kerja_model->id_unit_kerja = $data['uk4sp'];
	// 			$data['uk3s'] = $this->ref_unit_kerja_model->get_by_id()->id_unit_kerja;
	// 			$data['uk3sp'] = $this->ref_unit_kerja_model->get_by_id()->id_induk;


	// 			$this->ref_unit_kerja_model->id_unit_kerja = $data['uk3sp'];
	// 			$p2 = $this->ref_unit_kerja_model->get_by_id();
	// 			$this->ref_unit_kerja_model->id_induk = $p2->id_induk;
	// 			$data['uk2'] = $this->ref_unit_kerja_model->get_by_parent();
	// 			$this->ref_unit_kerja_model->id_unit_kerja = $data['uk3sp'];
	// 			$data['uk2s'] = $this->ref_unit_kerja_model->get_by_id()->id_unit_kerja;
	// 			$data['uk2sp'] = $this->ref_unit_kerja_model->get_by_id()->id_induk;

	// 			$this->ref_unit_kerja_model->id_unit_kerja = $data['uk2sp'];
	// 			$data['uk1'] = $this->ref_unit_kerja_model->get_by_id()->id_unit_kerja;
	// 		}

	// 		if(isset($data['uk1'])){
	// 			$this->ref_unit_kerja_model->id_unit_kerja = $data['uk1'];
	// 			$data['uk1_nama'] = $this->ref_unit_kerja_model->get_by_id()->nama_unit_kerja;
	// 		}else{
	// 			$data['uk1_nama'] = '-';
	// 		}


	// 		if(isset($data['uk2s'])){
	// 			$this->ref_unit_kerja_model->id_unit_kerja = $data['uk2s'];
	// 			$data['uk2_nama'] = $this->ref_unit_kerja_model->get_by_id()->nama_unit_kerja;
	// 		}else{
	// 			$data['uk2_nama'] = '-';
	// 		}
	// 		if(isset($data['uk3s'])){
	// 			$this->ref_unit_kerja_model->id_unit_kerja = $data['uk3s'];
	// 			$data['uk3_nama'] = $this->ref_unit_kerja_model->get_by_id()->nama_unit_kerja;
	// 		}else{
	// 			$data['uk3_nama'] = '-';
	// 		}

	// 		if(isset($data['uk4s'])){
	// 			$this->ref_unit_kerja_model->id_unit_kerja = $data['uk4s'];
	// 			$data['uk4_nama'] = $this->ref_unit_kerja_model->get_by_id()->nama_unit_kerja;
	// 		}else{
	// 			$data['uk4_nama'] = '-';
	// 		}

	// 		$this->berkas_file_model->id_berkas = $id_berkas;
	// 		$data['files'] = $this->berkas_file_model->get_by_n();
	// 		$data['id_berkas'] = $id_berkas;

	// 		$this->load->view('blog/src/header',$data);
	// 		$this->load->view('blog/src/top_nav',$data);
	// 		$this->load->view('blog/perencanaan_kinerja_detail',$data);
	// 		$this->load->view('blog/src/footer',$data);
	// 	} else {
	// 		redirect('perencanaan_kinerja');
	// 	}
	// }

	public function detail_renstra($id_skpd)
	{

		if ($id_skpd == null) {
			redirect('perencanaan_kinerja/index/'.date("Y"));
		}
		$data['title'] = "Perancanaan Kinerja - " .$this->company_profile_model->nama;
		$data['active_menu'] ="perencanaan_kinerja";

		$data['detail'] = $this->ref_skpd_model->get_by_id($id_skpd);
		$data['unit_kerja'] = $this->renstra_perencanaan_model->get_unit_kerja_by_id_skpd($id_skpd);
		$data['perencanaan'] = $this->renstra_perencanaan_model->get_perencanaan_by_id_skpd($id_skpd);

		$data['sasaran_strategis'] = $this->renstra_perencanaan_model->get_sasaran_strategis_by_id_skpd($id_skpd);
		$data['iku_sasaran_strategis'] = array();
		$data['iku_sasaran_strategis_unit_kerja'] = array();
		$data['unit_kerja_ss'] = array();
		foreach ($data['sasaran_strategis'] as $key => $value) {
			$data['iku_sasaran_strategis'][$key] = $this->renstra_perencanaan_model->get_iku_sasaran_strategis_by_id_ss($value['id_sasaran_strategis_renstra']);
			foreach ($data['iku_sasaran_strategis'][$key] as $keys => $values) {
				$data['iku_sasaran_strategis_unit_kerja'][$key][$keys] = $this->renstra_perencanaan_model->get_casecade_unit_kerja_iku_ss_renstra($values['id_iku_ss_renstra']);
				foreach ($data['iku_sasaran_strategis_unit_kerja'][$key][$keys] as $row) {
					$data['unit_kerja_ss'][] = array('id_unit_kerja' => $row['id_unit_kerja'], 'nama_unit_kerja' => $row['nama_unit_kerja'] );
				}
			}
		}
		$data['unit_kerja_ss'] = array_unique($data['unit_kerja_ss'], SORT_REGULAR);

		$data['sasaran_program'] = $this->renstra_perencanaan_model->get_sasaran_program_by_id_skpd($id_skpd);
		$data['iku_sasaran_program'] = array();
		$data['iku_sasaran_program_unit_kerja'] = array();
		$data['unit_kerja_sp'] = array();
		foreach ($data['sasaran_program'] as $key => $value) {
			$data['iku_sasaran_program'][$key] = $this->renstra_perencanaan_model->get_iku_sasaran_program_by_id_sp($value['id_sasaran_program_renstra']);
			foreach ($data['iku_sasaran_program'][$key] as $keys => $values) {
				$data['iku_sasaran_program_unit_kerja'][$key][$keys] = $this->renstra_perencanaan_model->get_casecade_unit_kerja_iku_sp_renstra($values['id_iku_sp_renstra']);
				foreach ($data['iku_sasaran_program_unit_kerja'][$key][$keys] as $row) {
					$data['unit_kerja_sp'][] = array('id_unit_kerja' => $row['id_unit_kerja'], 'nama_unit_kerja' => $row['nama_unit_kerja'] );
				}
			}
		}
		$data['unit_kerja_sp'] = array_unique($data['unit_kerja_sp'], SORT_REGULAR);

		$data['sasaran_kegiatan'] = $this->renstra_perencanaan_model->get_sasaran_kegiatan_by_id_skpd($id_skpd);
		$data['iku_sasaran_kegiatan'] = array();
		$data['iku_sasaran_kegiatan_unit_kerja'] = array();
		// $data['unit_kerja_sk'] = array();
		foreach ($data['sasaran_kegiatan'] as $key => $value) {
			$data['iku_sasaran_kegiatan'][$key] = $this->renstra_perencanaan_model->get_iku_sasaran_kegiatan_by_id_sk($value['id_sasaran_kegiatan_renstra']);
			foreach ($data['iku_sasaran_kegiatan'][$key] as $keys => $values) {
				$data['iku_sasaran_kegiatan_unit_kerja'][$key][$keys] = $this->renstra_perencanaan_model->get_casecade_unit_kerja_iku_sk_renstra($values['id_iku_sk_renstra']);
				// foreach ($data['iku_sasaran_kegiatan_unit_kerja'][$key][$keys] as $row) {
				// 	$data['unit_kerja_sk'][] = array('id_unit_kerja' => $row['id_unit_kerja'], 'nama_unit_kerja' => $row['nama_unit_kerja'] );
				// }
			}
		}
		// $data['unit_kerja_sk'] = array_unique($data['unit_kerja_sk'], SORT_REGULAR);

		$this->load->model('ref_satuan_model');
		$data['ref_satuan'] = $this->ref_satuan_model->get_all();

		$this->load->view('blog/src/header', $data);
		$this->load->view('blog/src/top_nav', $data);
		$this->load->view('blog/perencanaan_kinerja_detail_renstra', $data);
		$this->load->view('blog/src/footer', $data);
	}

	public function detail_renja($id_skpd, $tahun){

		if ($id_skpd == null && $tahun == 0) {
			redirect('perencanaan_kinerja/index/'.date("Y"));
		}

		$data['title'] = "Perencanaan Kinerja - Detail Renja";
		$data['detail'] = $this->ref_skpd_model->get_by_id($id_skpd);

		$jenis = array('ss'=>'Sasaran Strategis','sp'=>'Sasaran Program','sk'=>'Sasaran Kegiatan');
		if(!empty($_POST)){
			foreach($jenis as $j => $v){
				$name = $this->renja_perencanaan_model->name($j);
				if(!empty($_POST[$name['cIku']])){
					$id = $_POST[$name['cIku']];
					foreach($id as $i){
						$insert = array(
							$name['cIku']  => $i,
							$name['taIkuRenja'] => $_POST[$name['taIkuRenja'].$i],
							$name['aIkuRenja'] =>$_POST[$name['aIkuRenja'].$i],
							'id_unit_kerja' => $_POST['id_unit_kerja'],
							'tahun_renja' => $_POST['tahun_renja']
						);
						$cek_iku = $this->renja_perencanaan_model->cek_iku_renja($j,$i);
						if(!$cek_iku){
							$in = $this->renja_perencanaan_model->insert_iku_renja($j,$insert);
						}
					}
				}
			}
		}

		$data['tahun'] = $tahun;
		$data['id_skpd'] = $id_skpd;
		$data['unit_kerja'] = $this->ref_skpd_model->get_unit_kerja_by_id_skpd($id_skpd);
		//echo "<pre>";print_r($data['unit_kerja']);
		$data['jenis'] = $jenis;

		$this->load->view('blog/src/header', $data);
		$this->load->view('blog/src/top_nav');
		$this->load->view('blog/perencanaan_kinerja_detail_renja', $data);
		$this->load->view('blog/src/footer');
	}

	public function detail_pk($id_skpd, $tahun){

		if ($id_skpd == null && $tahun == 0) {
			redirect('perencanaan_kinerja/index/'.date("Y"));
		}

		$data['title'] = "Perencanaan Kinerja - Detail Renja";

		$data['detail'] = $this->ref_skpd_model->get_by_id($id_skpd);

		$jenis = array('ss'=>'Sasaran Strategis','sp'=>'Sasaran Program','sk'=>'Sasaran Kegiatan');
		if(!empty($_POST)){
			foreach($jenis as $j => $v){
				$name = $this->renja_perencanaan_model->name($j);
				if(!empty($_POST[$name['cIku']])){
					$id = $_POST[$name['cIku']];
					foreach($id as $i){
						$insert = array(
							$name['cIku']  => $i,
							$name['taIkuRenja'] => $_POST[$name['taIkuRenja'].$i],
							$name['aIkuRenja'] =>$_POST[$name['aIkuRenja'].$i],
							'id_unit_kerja' => $_POST['id_unit_kerja'],
							'tahun_renja' => $_POST['tahun_renja']
						);
						$cek_iku = $this->renja_perencanaan_model->cek_iku_renja($j,$i);
						if(!$cek_iku){
							$in = $this->renja_perencanaan_model->insert_iku_renja($j,$insert);
						}
					}
				}
			}
		}

		$data['tahun'] = $tahun;
		$data['id_skpd'] = $id_skpd;
		$data['unit_kerja'] = $this->ref_skpd_model->get_unit_kerja_by_id_skpd($id_skpd);

		$data['jenis'] = $jenis;


		$this->load->view('blog/src/header', $data);
		$this->load->view('blog/src/top_nav');
		$this->load->view('blog/perencanaan_kinerja_detail_pk', $data);
		$this->load->view('blog/src/footer');
	}


	public function detail_rpjmd()
	{

		$data['title'] = "Perancanaan Kinerja - Detail RPJMD";
		$data['active_menu'] ="perencanaan_kinerja";

		$data['visi'] = $this->ref_visi_misi_model->get_visi();
		$data['misi'] = $this->ref_visi_misi_model->get_all_m();
		$data['tujuan'] = $this->ref_visi_misi_model->get_all_t();
		$data['sasaran'] = $this->sasaran_rpjmd_model->get_all();

		$this->load->view('blog/src/header', $data);
		$this->load->view('blog/src/top_nav', $data);
		$this->load->view('blog/perencanaan_kinerja_detail_rpjmd', $data);
		$this->load->view('blog/src/footer', $data);
	}

	public function iku_skpd($id_skpd=null)
	{
		if ($id_skpd==null) {
			redirect('perencanaan_kinerja/index/'.date("Y"));
		}

		$data['title'] = "Perancanaan Kinerja ";
		$data['active_menu'] ="perencanaan_kinerja";

		$this->load->model('sasaran_rpjmd_model');

		if(!empty($_POST)){
			$up = $_POST;
			$name = $this->renstra_realisasi_model->name($_POST['jenis']);
			unset($up['id_iku']);
			unset($up['jenis']);
			$arr = array('s','m','a','r','t','c');
			foreach($arr as $a){
				if(isset($up['status_'.$a])){
					$status = $up['status_'.$a];
					if($status==1){
						$up['catatan_'.$a] = '';
					}
				}
			}
			$update = $this->renstra_reviu_model->update_reviu_iku($_POST['jenis'],$_POST['id_iku'],$up);
		}
		$data['detail'] = $this->ref_skpd_model->get_by_id($id_skpd);
		$data['unit_kerja'] = $this->renstra_perencanaan_model->get_unit_kerja_by_id_skpd($id_skpd);
		$data['perencanaan'] = $this->renstra_perencanaan_model->get_perencanaan_by_id_skpd($id_skpd);

		$jumlah_reviu = $this->renstra_reviu_model->get_jumlah_reviu($id_skpd);
		$data['belum_diriviu'] = $jumlah_reviu['belum_diriviu'];
		$data['disetujui'] = $jumlah_reviu['disetujui'];
		$data['ditolak'] = $jumlah_reviu['ditolak'];

		foreach ($this->jenis as $key => $value) {
			$data[$value] = $this->renstra_realisasi_model->get_sasaran_by_id_skpd($key,$id_skpd);
		}

		$data['a_jenis'] = $this->jenis;

		$this->load->view('blog/src/header', $data);
		$this->load->view('blog/src/top_nav', $data);
		$this->load->view('blog/iku_skpd', $data);
		$this->load->view('blog/src/footer', $data);
	}

	public function download_file($id_berkas_file){
		$id_berkas_file = explode('_', $id_berkas_file);
		$id_berkas_file = $id_berkas_file[0];
		$this->berkas_file_model->id_berkas_file = $id_berkas_file;
		$data = $this->berkas_file_model->get_by_id();
		$file = urldecode($data->hash_file);
		$filepath = $data->path_file . $file;
		echo $filepath;
		if(file_exists($filepath)) {
			header('Content-Description: File Transfer');
			header('Content-Type: application/octet-stream');
			header('Content-Disposition: attachment; filename="'.basename($data->nama_file).'"');
			header('Expires: 0');
			header('Cache-Control: must-revalidate');
			header('Pragma: public');
			header('Content-Length: ' . filesize($filepath));
			flush();
			readfile($filepath);
			exit;
		}
	}

}
?>
