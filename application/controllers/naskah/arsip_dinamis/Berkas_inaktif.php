<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Berkas_inaktif extends CI_Controller
{
	public $user_id, $user_level, $full_name, $user_picture, $id_pegawai, $level_id;

	public function __construct()
	{
		parent::__construct();
		$this->user_id = $this->session->userdata('user_id');
		$this->load->model('user_model');
		$this->load->model('naskah/surat_klasifikasi_model', 'klasifikasi');
		$this->load->model('naskah/surat_berkas_model', 'surat_berkas');
		$this->load->model('naskah/surat_penyusutan_model', 'surat_penyusutan');
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

			$data['title'] = "Daftar Berkas Inaktif";
			// $data['content']	= "surat_internal/masuk/index" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name'] = $this->full_name;
			$data['user_level'] = $this->user_level;
			$where = array(
				'deleted_date' => null,
				'status_pindah' => 0,
				'status_berkas' => 'inaktif'
			);
			$data['files'] = $this->surat_berkas->get_all_where($where);

			//echo json_encode($data);
			//die;
			$data['active_menu'] = "surat_internal";
			// panggil nama file di folder views disimpan di array content
			$data['content'] = "naskah/arsip_dinamis/berkas_inaktif/index";

			// load template
			$this->load->view('admin/index', $data);

		} else {
			show_404();
			//redirect('admin');

		}
	}

	public function musnah()
	{
		if ($this->user_id) {

			$data['title'] = "Tambah Usulan Musnah";
			// $data['content']	= "surat_internal/masuk/index" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name'] = $this->full_name;
			$data['user_level'] = $this->user_level;
			$where = array(
				'deleted_date' => null,
				'status_pindah' => 0,
				'status_berkas' => 'inaktif'
			);
			$data['files'] = $this->surat_berkas->get_all_where($where);

			//echo json_encode($data);
			//die;
			$data['active_menu'] = "surat_internal";
			// panggil nama file di folder views disimpan di array content
			$data['content'] = "naskah/arsip_dinamis/berkas_inaktif/musnah";

			// load template
			$this->load->view('admin/index', $data);

		} else {
			show_404();
			//redirect('admin');

		}
	}

	public function permanen()
	{
		if ($this->user_id) {

			$data['title'] = "Tambah Usulan Permanen";
			// $data['content']	= "surat_internal/masuk/index" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name'] = $this->full_name;
			$data['user_level'] = $this->user_level;
			$where = array(
				'deleted_date' => null,
				'status_pindah' => 0,
				'status_berkas' => 'inaktif'
			);
			$data['files'] = $this->surat_berkas->get_all_where($where);

			//echo json_encode($data);
			//die;
			$data['active_menu'] = "surat_internal";
			// panggil nama file di folder views disimpan di array content
			$data['content'] = "naskah/arsip_dinamis/berkas_inaktif/permanen";

			// load template
			$this->load->view('admin/index', $data);

		} else {
			show_404();
			//redirect('admin');

		}
	}

	public function save_permanen()
	{
		if (!empty($_POST)) {
			$save = $this->surat_penyusutan->insert_entry_permanen();

			if ($save > 0) {
				$status = 200;
				$message = "Usulan permanen berhasil disimpan";
			} else {
				$status = 500;
				$message = "Usulan permanen gagal disimpan!";
			}
		} else {
			$status = 502;
			$message = "Anda tidak memiliki hak akses!";
		}

		$this->session->set_flashdata(
			array(
				'status' => $status,
				'message' => $message
			)
		);

		redirect('naskah/arsip_dinamis/berkas_inaktif');
	}

	public function save_musnah()
	{
		if (!empty($_POST)) {
			$save = $this->surat_penyusutan->insert_entry_musnah();

			if ($save > 0) {
				$status = 200;
				$message = "Usulan musnah berhasil disimpan";
			} else {
				$status = 500;
				$message = "Usulan musnah gagal disimpan!";
			}
		} else {
			$status = 502;
			$message = "Anda tidak memiliki hak akses!";
		}

		$this->session->set_flashdata(
			array(
				'status' => $status,
				'message' => $message
			)
		);

		redirect('naskah/arsip_dinamis/berkas_inaktif');
	}

	public function view()
	{
		if (!empty($this->input->get('x_slug'))) {
			$data['x_slug'] = $this->input->get('x_slug');
			$data['user_picture'] = $this->user_picture;
			$data['full_name'] = $this->full_name;
			$data['user_level'] = $this->user_level;
			$data['active_menu'] = "berkas_inaktif";

			$data['file'] = $this->surat_berkas->get_single_where(array('slug' => $data['x_slug']));

			if ($this->input->get('for') == "details") {
				$data['title'] = "Detail Berkas";
				$data['content'] = 'arsip_dinamis/berkas_inaktif/detail';
			} else {
				$data['title'] = "Ubah Berkas";
				$data['content'] = 'arsip_dinamis/berkas_inaktif/edit';
			}

			$this->load->view('admin/index', $data);
		} else {
			redirect('admin');
		}
	}

}