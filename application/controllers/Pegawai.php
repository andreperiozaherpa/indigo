<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pegawai extends CI_Controller {
	public $user_id;

	public function __construct(){
		parent::__construct();
		$this->user_id = $this->session->userdata('user_id');
		$this->load->model('user_model');
		$this->user_model->user_id = $this->user_id;
		$this->user_model->set_user_by_user_id();
		$this->user_picture = $this->user_model->user_picture;
		$this->full_name	= $this->user_model->full_name;
		$this->user_level	= $this->user_model->level;
		$this->load->model('pegawai_model');
		$this->load->model('ref_skpd_model');

			
	}


	public function index()
	{
		if ($this->user_id)
		{
			// if ($this->user_level!="Administrator" && $this->user_level!="User") redirect ('home'); 
			$data['title']		= app_name;
			$data['content']	= "pegawai/index" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "pegawai";

			$this->load->view('admin/index',$data);
		}
		else
		{
			redirect('admin/login');
		}
	}

	public function detail()
	{
		if ($this->user_id)
		{
			// if ($this->user_level!="Administrator" && $this->user_level!="User") redirect ('home'); 
			$data['title']		= app_name;
			$data['content']	= "pegawai/detail" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "pegawai";

			$this->load->view('admin/index',$data);
		}
		else
		{
			redirect('admin/login');
		}
	}

	public function add()
	{
		if ($this->user_id)
		{
			if ($this->user_level!="Administrator" && $this->user_level!="User") redirect ('home'); 
			$data['title']		= app_name;
			$data['content']	= "karyawan/add" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "karyawan";

			$this->load->view('admin/index',$data);
		}
		else
		{
			redirect('admin/login');
		}
	}




	public function delete($id_services)
	{
		if ($this->user_id)
		{
			$this->load->model('services_model');
			$this->services_model->id_services = $id_services;
			$this->services_model->delete();
			redirect('manage_services');
		}
		else
		{
			redirect('home');
		}
	}

	public function getPegawaiBySKPD($jenis_laporan=''){
		if ($this->user_id)
		{
			$input_data = json_decode(trim(file_get_contents('php://input')), true);
			$pegawai = $this->pegawai_model->get_all_by_skpd($input_data['id']);
			$skpd = $this->ref_skpd_model->get_by_id($input_data['id']);
			if ($jenis_laporan == 'lo') {
				$this->load->model('lap_operasional_model');
				$id_last = $this->lap_operasional_model->get_last_id_by_skpd($input_data['id']);
				$laporan = $this->lap_operasional_model->get_by_id($id_last);
			}
			if ($jenis_laporan == 'lra') {
				$this->load->model('lap_realisasi_anggaran_model');
				$id_last = $this->lap_realisasi_anggaran_model->get_last_id_by_skpd($input_data['id']);
				$laporan = $this->lap_realisasi_anggaran_model->get_by_id($id_last);
			}
			if ($jenis_laporan == 'neraca') {
				$this->load->model('lap_neraca_model');
				$id_last = $this->lap_neraca_model->get_last_id_by_skpd($input_data['id']);
				$laporan = $this->lap_neraca_model->get_by_id($id_last);
			}
			$laporan = (@$laporan) ? $laporan : array();
			echo json_encode([
				'data' => $pegawai,
				'status' => 'succes',
				'skpd' => $skpd,
				'laporan' => $laporan
			]);
		}
		else
		{
			redirect('home');
		}
	}
}
?>
