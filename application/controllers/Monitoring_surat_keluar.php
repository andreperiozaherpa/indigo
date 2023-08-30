<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Monitoring_surat_keluar extends CI_Controller {
	public $user_id;

	public function __construct(){
		parent ::__construct();
		$this->user_id = $this->session->userdata('user_id');
		$this->load->model('user_model');
		$this->load->model('kegiatan_model');
		$this->load->model('realisasi_kegiatan_model');
		$this->load->model('ref_skpd_model');
		$this->load->model('surat_masuk_model');
		$this->load->model('ref_surat_model');
		$this->load->model('surat_keluar_model');
		$this->load->model('data_model');
		$this->load->model('monitoring_surat_model');
		$this->user_model->user_id = $this->user_id;
		$this->user_model->set_user_by_user_id();
		$this->user_picture = $this->user_model->user_picture;
		$this->full_name	= $this->user_model->full_name;
		$this->user_level	= $this->user_model->level;
		if ($this->user_level=="Admin Web");

		// $this->load->model('realisasi_kegiatan_model','realisasi_kegiatan_m');
	}
	public function index()
	{
		if ($this->user_id)
		{
			$data['title']		= "Monitoring Surat Keluar - Admin ";
			$data['content']	= "monitoring_surat_keluar/index" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "monitoring_surat_keluar";

			$hal = 3;
			$page = isset($_GET["page"]) ? (int)$_GET["page"] : 1;
			$mulai = ($page>1) ? ($page * $hal) - $hal : 0;
			$total = count($this->monitoring_surat_model->get_all());
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
			$data['total'] = $this->monitoring_surat_model->get_all();
			$data['list'] = $this->monitoring_surat_model->get_page($mulai,$hal,$filter);

			$data['ref_surat'] = $this->monitoring_surat_model->get_all_ref_surat();

			foreach ($data['list'] as $key => $l) {
				$data['detail_verifikasi'][$key] = $this->surat_keluar_model->get_detail_verifikasi_by_id($l->id_surat_keluar);
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
			$data['list'] = $this->monitoring_surat_model->get_detail_page($id);
			foreach ($data['list'] as $key => $l) {
				$data['detail_verifikasi'][$key] = $this->surat_keluar_model->get_detail_verifikasi_by_id($l->id_surat_keluar);
			}
			$this->load->view('admin/monitoring_surat_keluar/get_detail',$data);
	}
}
?>
