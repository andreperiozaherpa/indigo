<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Evaluasi_kinerja extends CI_Controller {
	public $user_id;

	public function __construct(){
		parent ::__construct();
		$this->user_id = $this->session->userdata('user_id');
		$this->user_level = $this->session->userdata('user_level');
		$this->load->model('visitor_model');
		$this->load->model('berkas_model');
		$this->load->model('berkas_file_model');
		$this->load->model('ref_kategori_berkas_model');
		$this->load->model('ref_unit_kerja_model');
		$this->load->model('evaluasi_model');
		$this->load->model('evaluasi_kinerja_model');
		$this->load->helper('text');
		$this->load->helper('typography');
		$this->load->helper('file');
		$this->visitor_model->cek_visitor();
	$this->load->model('ref_skpd_model');
		$this->load->model('company_profile_model');

		$this->company_profile_model->set_identity();
	}

	public function index($tahun=null,$level=0,$id_induk=null)
	{
		if ($tahun == null) {
			redirect('evaluasi_kinerja/index/'.date("Y"));
		}
		$valid_tahun = [2017, 2018, 2019, 2020, 2021, 2022, 2023, 2024, 2025, 2026];
		if (!in_array($tahun, $valid_tahun)) {
			$tahun = $this->default_tahun;
		}
		$data['title'] = "evaluasi Kinerja - " .$this->company_profile_model->nama;
		$data['active_menu'] ="evaluasi_kinerja";
		$data['level'] = $level;
		$data['id_induk'] = $id_induk;
		$tahun = (empty($tahun)) ? date("Y") : $tahun;
		$data['tahun_'] = $tahun;

		$data['list'] = $this->evaluasi_kinerja_model->get_all_by_tahun($tahun);
		$this->load->view('blog/src/header',$data);
		$this->load->view('blog/src/top_nav',$data);
		$this->load->view('blog/evaluasi_kinerja',$data);
		$this->load->view('blog/src/footer',$data);
	}

}
?>
