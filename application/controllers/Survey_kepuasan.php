<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Survey_kepuasan extends CI_Controller
{
	public $user_id;

	public function __construct()
	{
		parent::__construct();
		$this->user_id = $this->session->userdata('user_id');
		// $this->load->model('project_model');
		$this->load->model('user_model');
		// $this->load->model('worksheet_model');
		$this->load->model('kegiatan_model');
		$this->load->model('logs_model');
		$this->load->model('ref_skpd_model');
		$this->load->model('renja_perencanaan_model');
		$this->load->model('survey_kepuasan_model');
		// $this->project = $this->project_model->get_all();
		$this->user_model->user_id = $this->user_id;
		$this->user_model->set_user_by_user_id();
		$this->user_picture = $this->user_model->user_picture;
		$this->full_name	= $this->user_model->full_name;
		$this->user_level	= $this->user_model->level;
		$this->user_privileges	= $this->user_model->user_privileges;
		$array_privileges = explode(';', $this->user_privileges);

		// if (($this->user_level!="Administrator" && $this->user_level!="Admin Web") && !in_array('project', $array_privileges)) redirect ('welcome');
	}


	public function index()
	{
		if ($this->user_id) {
			$data['title']		= "Survey Kepuasan - " . app_name;
			$data['content']	= "survey_kepuasan/index";
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			// $data['project'] = $this->project;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "survey_kepuasan";

			$bulan = date('m');
			if ($bulan <= 4) {
				$triwulan = 1;
			} else if ($bulan > 4 && $bulan <= 8) {
				$triwulan = 2;
			} else if ($bulan > 8 && $bulan <= 12) {
				$triwulan = 3;
			} else {
				$triwulan = 0;
			}

			$data['triwulan'] = $triwulan;
			$data['tahun'] = date('Y');

			$data['unit_kerja'] = $this->ref_skpd_model->get_unit_kerja_by_skpd_level(id_skpd_setwan, 1);
			$this->load->view('admin/index', $data);
		} else {
			redirect('admin');
		}
	}
	public function form($id_unit_kerja, $triwulan, $tahun)
	{
		if ($this->user_id) {
			$data['title']		= "Form Survey Kepuasan - " . app_name;
			$data['content']	= "survey_kepuasan/form";
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			// $data['project'] = $this->project;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "survey_kepuasan";
			$data['detail_unit_kerja'] = $this->ref_skpd_model->get_unit_kerja_by_id($id_unit_kerja);
			$data['triwulan'] = $triwulan;
			$data['tahun'] = $tahun;
			$data['pertanyaan'] = $this->survey_kepuasan_model->get_pertanyaan();
			$id_pegawai = $this->session->userdata('id_pegawai');

			if (!empty($_POST)) {
				$get_pengisian = $this->survey_kepuasan_model->get_pengisian($id_unit_kerja, $triwulan, $tahun, $id_pegawai);
				$id_survey_kepuasan = null;
				if ($get_pengisian) {
					$id_survey_kepuasan = $get_pengisian->id_survey_kepuasan;
				} else {
					$in = $this->survey_kepuasan_model->insert(['id_pegawai_pengisi' => $id_pegawai, 'id_unit_kerja_dinilai' => $id_unit_kerja, 'triwulan' => $triwulan, 'tahun' => $tahun]);
					if ($in) {
						$id_survey_kepuasan = $in;
					}
				}
				if (!empty($id_survey_kepuasan)) {
					$jawaban = $_POST['jawaban'];
					foreach ($jawaban as $p => $j) {
						$inj = $this->survey_kepuasan_model->insert_jawaban(['id_survey_kepuasan' => $id_survey_kepuasan, 'id_survey_kepuasan_pertanyaan' => $p, 'jawaban' => $j]);
					}
				}
			}


			$data['status_pengisian'] = $this->survey_kepuasan_model->check_pengisian($id_unit_kerja, $triwulan, $tahun, $id_pegawai);

			$this->load->view('admin/index', $data);
		} else {
			redirect('admin');
		}
	}

	public function rekap()
	{
		if ($this->user_id) {
			$data['title']		= "Rekap Pengisian Survey Kepuasan - " . app_name;
			$data['content']	= "survey_kepuasan/rekap";
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			// $data['project'] = $this->project;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "survey_kepuasan";

			$bulan = date('m');
			if ($bulan <= 4) {
				$triwulan = 1;
			} else if ($bulan > 4 && $bulan <= 8) {
				$triwulan = 2;
			} else if ($bulan > 8 && $bulan <= 12) {
				$triwulan = 3;
			} else {
				$triwulan = 0;
			}

			$data['triwulan'] = $triwulan;
			$data['tahun'] = date('Y');

			$data_filter = ['triwulan' => $triwulan, 'tahun' => $data['tahun']];

			if (!empty($_GET['triwulan']) && is_string($_GET['triwulan'])) {
				$data_filter['triwulan'] = $_GET['triwulan'];
			}
			if (!empty($_GET['tahun']) && is_string($_GET['tahun'])) {
				$data_filter['tahun'] = $_GET['tahun'];
			}


			$data['filter'] = $data_filter;



			$data['unit_kerja'] = $this->ref_skpd_model->get_unit_kerja_by_skpd_level(id_skpd_setwan, 1);
			$this->load->view('admin/index', $data);
		} else {
			redirect('admin');
		}
	}
}
