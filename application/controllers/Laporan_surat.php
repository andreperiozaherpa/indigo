<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan_surat extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->user_id = $this->session->userdata('user_id');
		$this->load->model('user_model');
		$this->user_model->user_id = $this->user_id;
		$this->user_model->set_user_by_user_id();
		$this->id_skpd = $this->user_model->kd_skpd;
		$this->load->model('laporan_surat_model');
		$this->load->model('ref_skpd_model');
		$this->load->model('surat_masuk_model', 'smm');
		$this->load->model('surat_keluar_model', 'skm');
	}

	public function index()
	{
		$data['title']		= "Data Surat - Admin ";
		$data['content']	= "laporan_surat/index";
		$data['user_picture'] = $this->user_picture;
		$data['full_name']		= $this->full_name;
		$data['user_level']		= $this->user_level;
		$data['active_menu'] = "laporan_surat";

		$this->load->view('admin/index', $data);
	}

	public function surat_masuk()
	{

		if ($this->user_id) {
			$data['title']		= "Data Surat - Admin ";
			$data['content']	= "laporan_surat/surat_masuk";
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "laporan_surat";

			if (!empty($_POST)) {
				$start = $_POST["start"];
				$end = $_POST["end"];
				$data['filter'] = true;
				$data['start'] = $_POST['start'];
				$data['end'] = $_POST['end'];
			} else {
				$start = '';
				$end = '';
				$data['filter'] = false;
			}

			$id_skpd = $this->id_skpd;
			if ($this->user_level == 'Administrator') {
				$id_skpd = '';
			}

			$data['surat_masuk'] = $this->laporan_surat_model->data_surat_masuk($start, $end, $id_skpd);

			$this->load->view('admin/index', $data);
		} else {
			redirect('admin');
		}
	}

	public function surat_keluar()
	{

		if ($this->user_id) {
			$data['title']		= "Data Surat - Admin ";
			$data['content']	= "laporan_surat/surat_keluar";
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "laporan_surat";

			if (!empty($_POST)) {
				$start = $_POST["start"];
				$end = $_POST["end"];
				$data['filter'] = true;
				$data['start'] = $_POST['start'];
				$data['end'] = $_POST['end'];
			} else {
				$start = '';
				$end = '';
				$data['filter'] = false;
			}

			$id_skpd = $this->id_skpd;

			$data['surat_keluar'] = $this->laporan_surat_model->data_surat_keluar($start, $end, $id_skpd);
			// print_r($data['surat_keluar']);
			// die;

			$this->load->view('admin/index', $data);
		} else {
			redirect('admin');
		}
	}


	public function grafik_surat($year)
	{

		if ($this->user_id) {
			$data['title']		= "Grafik Surat - Admin ";
			$data['content']	= "laporan_surat/grafik_surat";
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "laporan_surat";

			if ($year == '') {
				redirect('laporan_surat/grafik_surat/' . date("Y"));
			}

			$id_skpd = 1;

			$data['skpd'] = $this->ref_skpd_model->get_all();

			if (!empty($_POST)) {
				$start = $_POST["year"];
				$data['year'] = $_POST['year'];
			}

			// echo "<pre>";print_r($this->smm->get_all_eksternal_grafik());
			// die;

			$data['sm_se_jan'] = $this->smm->get_all_eksternal_grafik_jan($year, $id_skpd);
			$data['sm_se_feb'] = $this->smm->get_all_eksternal_grafik_feb($year, $id_skpd);
			$data['sm_se_mar'] = $this->smm->get_all_eksternal_grafik_mar($year, $id_skpd);
			$data['sm_se_apr'] = $this->smm->get_all_eksternal_grafik_apr($year, $id_skpd);
			$data['sm_se_mei'] = $this->smm->get_all_eksternal_grafik_mei($year, $id_skpd);
			$data['sm_se_jun'] = $this->smm->get_all_eksternal_grafik_jun($year, $id_skpd);
			$data['sm_se_jul'] = $this->smm->get_all_eksternal_grafik_jul($year, $id_skpd);
			$data['sm_se_agu'] = $this->smm->get_all_eksternal_grafik_agu($year, $id_skpd);
			$data['sm_se_sep'] = $this->smm->get_all_eksternal_grafik_sep($year, $id_skpd);
			$data['sm_se_okt'] = $this->smm->get_all_eksternal_grafik_okt($year, $id_skpd);
			$data['sm_se_nov'] = $this->smm->get_all_eksternal_grafik_nov($year, $id_skpd);
			$data['sm_se_des'] = $this->smm->get_all_eksternal_grafik_des($year, $id_skpd);
			$data['sm_si_jan'] = $this->smm->get_all_internal_grafik_jan($year, $id_skpd);
			$data['sm_si_feb'] = $this->smm->get_all_internal_grafik_feb($year, $id_skpd);
			$data['sm_si_mar'] = $this->smm->get_all_internal_grafik_mar($year, $id_skpd);
			$data['sm_si_apr'] = $this->smm->get_all_internal_grafik_apr($year, $id_skpd);
			$data['sm_si_mei'] = $this->smm->get_all_internal_grafik_mei($year, $id_skpd);
			$data['sm_si_jun'] = $this->smm->get_all_internal_grafik_jun($year, $id_skpd);
			$data['sm_si_jul'] = $this->smm->get_all_internal_grafik_jul($year, $id_skpd);
			$data['sm_si_agu'] = $this->smm->get_all_internal_grafik_agu($year, $id_skpd);
			$data['sm_si_sep'] = $this->smm->get_all_internal_grafik_sep($year, $id_skpd);
			$data['sm_si_okt'] = $this->smm->get_all_internal_grafik_okt($year, $id_skpd);
			$data['sm_si_nov'] = $this->smm->get_all_internal_grafik_nov($year, $id_skpd);
			$data['sm_si_des'] = $this->smm->get_all_internal_grafik_des($year, $id_skpd);
			$data['sk_se_jan'] = $this->skm->get_all_eksternal_grafik_jan($year, $id_skpd);
			$data['sk_se_feb'] = $this->skm->get_all_eksternal_grafik_feb($year, $id_skpd);
			$data['sk_se_mar'] = $this->skm->get_all_eksternal_grafik_mar($year, $id_skpd);
			$data['sk_se_apr'] = $this->skm->get_all_eksternal_grafik_apr($year, $id_skpd);
			$data['sk_se_mei'] = $this->skm->get_all_eksternal_grafik_mei($year, $id_skpd);
			$data['sk_se_jun'] = $this->skm->get_all_eksternal_grafik_jun($year, $id_skpd);
			$data['sk_se_jul'] = $this->skm->get_all_eksternal_grafik_jul($year, $id_skpd);
			$data['sk_se_agu'] = $this->skm->get_all_eksternal_grafik_agu($year, $id_skpd);
			$data['sk_se_sep'] = $this->skm->get_all_eksternal_grafik_sep($year, $id_skpd);
			$data['sk_se_okt'] = $this->skm->get_all_eksternal_grafik_okt($year, $id_skpd);
			$data['sk_se_nov'] = $this->skm->get_all_eksternal_grafik_nov($year, $id_skpd);
			$data['sk_se_des'] = $this->skm->get_all_eksternal_grafik_des($year, $id_skpd);
			$data['sk_si_jan'] = $this->skm->get_all_internal_grafik_jan($year, $id_skpd);
			$data['sk_si_feb'] = $this->skm->get_all_internal_grafik_feb($year, $id_skpd);
			$data['sk_si_mar'] = $this->skm->get_all_internal_grafik_mar($year, $id_skpd);
			$data['sk_si_apr'] = $this->skm->get_all_internal_grafik_apr($year, $id_skpd);
			$data['sk_si_mei'] = $this->skm->get_all_internal_grafik_mei($year, $id_skpd);
			$data['sk_si_jun'] = $this->skm->get_all_internal_grafik_jun($year, $id_skpd);
			$data['sk_si_jul'] = $this->skm->get_all_internal_grafik_jul($year, $id_skpd);
			$data['sk_si_agu'] = $this->skm->get_all_internal_grafik_agu($year, $id_skpd);
			$data['sk_si_sep'] = $this->skm->get_all_internal_grafik_sep($year, $id_skpd);
			$data['sk_si_okt'] = $this->skm->get_all_internal_grafik_okt($year, $id_skpd);
			$data['sk_si_nov'] = $this->skm->get_all_internal_grafik_nov($year, $id_skpd);
			$data['sk_si_des'] = $this->skm->get_all_internal_grafik_des($year, $id_skpd);
			$this->load->view('admin/index', $data);
		} else {
			redirect('admin');
		}
	}
	
	public function statistik_skpd(){

		if ($this->user_id)
		{
			$data['title']		= "Statistik SKPD - Admin ";
			$data['content']	= "laporan_surat/statistik_skpd" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "laporan_surat/statistik_skpd";
			$awal = '2020-01-01';
			$eselon = isset($_GET['eselon']) ? $_GET['eselon'] : "II";
			$data['eselon'] = $eselon;
			$data['list_eselon'] = array('II','III','IV');
			$data['skpd'] = $this->laporan_surat_model->get_skpd_rank($awal);
			$data['pegawai'] = $this->laporan_surat_model->get_pegawai_ttd_rank($eselon);
			$this->load->view('admin/index',$data);
		}
		else
		{
			redirect('admin');
		}
	}
}
