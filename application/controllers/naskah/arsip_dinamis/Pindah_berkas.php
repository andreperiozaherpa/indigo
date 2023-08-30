<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pindah_berkas extends CI_Controller
{
	public $user_id, $user_level, $full_name, $user_picture, $id_pegawai, $level_id;

	public function __construct()
	{
		parent::__construct();
		$this->user_id = $this->session->userdata('user_id');
		$this->load->model('user_model');
		$this->load->model('naskah/surat_klasifikasi_model', 'klasifikasi');
		$this->load->model('naskah/surat_berkas_model', 'surat_berkas');
		$this->user_model->user_id = $this->user_id;
		$this->user_model->set_user_by_user_id();
		$this->user_picture = $this->user_model->user_picture;
		$this->full_name = $this->user_model->full_name;
		$this->user_level = $this->user_model->level;
		$this->id_pegawai = $this->user_model->id_pegawai;
		$this->level_id = $this->user_model->level_id;

		// if ($this->level_id > 2) redirect("admin");
		$this->load->library('socketio', array('host' => "e-office.sumedangkab.go.id", 'port' => 3000));
	}

	public function index()
	{
		if ($this->user_id) {

			$data['title'] = "Daftar Usul Pemindahan Berkas";
			// $data['content']	= "surat_internal/masuk/index" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name'] = $this->full_name;
			$data['user_level'] = $this->user_level;
			$data['active_menu'] = "surat_internal";
			$where = array(
				'deleted_date' => null,
				'status_pindah' => 1,
				'status_berkas' => 'inaktif'
			);
			$data['files'] = $this->surat_berkas->get_all_where($where);
			// panggil nama file di folder views disimpan di array content
			$data['content'] = "naskah/arsip_dinamis/pindah_berkas/index";

			// load template
			$this->load->view('admin/index', $data);

		} else {
			show_404();
			//redirect('admin');

		}
	}
}