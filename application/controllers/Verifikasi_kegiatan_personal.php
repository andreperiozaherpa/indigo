<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Verifikasi_kegiatan_personal extends CI_Controller {
	public $user_id;

	public function __construct(){
		parent ::__construct();
		$this->user_id = $this->session->userdata('user_id');
		$this->load->model('user_model');
		$this->load->model('verifikasi_kegiatan_personal_model');
		$this->user_model->user_id = $this->user_id;
		$this->user_model->set_user_by_user_id();
		$this->user_picture = $this->user_model->user_picture;
		$this->full_name	= $this->user_model->full_name;
		$this->user_level	= $this->user_model->level;
		$this->id_skpd = $this->user_model->id_skpd;
		$this->id_pegawai = $this->user_model->id_pegawai;
		if ($this->user_level=="Admin Web");

		// $this->load->model('realisasi_kegiatan_model','realisasi_kegiatan_m');
	}
	public function index()
	{
		if ($this->user_id)
		{
			$data['title']		= "Verifikasi Kegiatan personal - Admin ";
			$data['content']	= "verifikasi_kegiatan_personal/index" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "verifikasi_kegiatan_personal";
			$data['verifikator_kegiatan'] =  $this->verifikasi_kegiatan_personal_model->get_verifikator_kegiatan($this->id_skpd, $this->id_pegawai);

			$hal = 4;

			$page = isset($_GET["page"]) ? (int)$_GET["page"] : 1;
			$mulai = ($page>1) ? ($page * $hal) - $hal : 0;
			$total = count($this->verifikasi_kegiatan_personal_model->get_all_by_id($this->id_pegawai));
			$data['pages'] = ceil($total/$hal);
			$data['current'] = $page;
			if(!empty($_POST)){
				$data['filter'] = true;
				$nama = $_POST['nama_kegiatan_filter'];
				$tgl = $_POST['tgl_filter'];
				$data['nama'] = $_POST['nama_kegiatan_filter'];
				$data['tgl'] = $_POST['tgl_filter'];
			}else{
				$nama = '';
				$tgl = '';
				$data['filter'] = false;
			}

			$data['menunggu_verifikasi'] = $this->verifikasi_kegiatan_personal_model->get_menunggu_verifikasi($this->id_pegawai, $mulai, $hal, $tgl, $nama);
			$data['revisi_kegiatan'] = $this->verifikasi_kegiatan_personal_model->get_revisi_kegiatan($this->id_pegawai, $mulai, $hal, $tgl, $nama);
			$data['selesai_diverifikasi'] = $this->verifikasi_kegiatan_personal_model->get_selesai_diverifikasi($this->id_pegawai, $mulai, $hal, $tgl, $nama);
			$data['daftar_kegiatan'] = $this->verifikasi_kegiatan_personal_model->get_daftar_kegiatan($this->id_pegawai, $mulai, $hal, $tgl, $nama);

			if (isset($_POST['tambah_kegiatan'])) {

				$this->form_validation->set_error_delimiters('<div style="color:red;">', '</div>');
				$this->form_validation->set_rules('nama_kegiatan', 'Nama Kegiatan', 'trim|xss_clean|required|max_length[20]');
				$this->form_validation->set_rules('tgl_kegiatan_mulai', 'Tanggal Awal', 'trim|xss_clean|required');
				$this->form_validation->set_rules('tgl_kegiatan_akhir', 'Tanggal Akhir', 'trim|xss_clean|required');
				$this->form_validation->set_rules('deskripsi', 'Deskripsi Kegiatan', 'trim|xss_clean|required|max_length[300]');
				$this->form_validation->set_rules('target_kegiatan', 'Target Kegiatan', 'trim|xss_clean|required|max_length[20]');
				$this->form_validation->set_rules('id_verifikator', 'Verifikator Kegiatan', 'trim|xss_clean|required');

				if ($this->form_validation->run() == true) {
					$this->verifikasi_kegiatan_personal_model->tambah_kegiatan_personal($this->id_skpd, $this->id_pegawai);
					echo '<script>javascript:alert("Berhasil! Kegiatan berhasil ditambahkan");window.location = window.location.href;</script>';
				}else {
					echo '<script>javascript:alert("Gagal! Ada kesalahan, silahkan coba lagi");window.location = window.location.href;</script>';
				}

			}

			if (isset($_POST['update_kegiatan'])) {

				$this->form_validation->set_error_delimiters('<div style="color:red;">', '</div>');
				$this->form_validation->set_rules('nama_kegiatan', 'Nama Kegiatan', 'trim|xss_clean|required|max_length[20]');
				$this->form_validation->set_rules('tgl_kegiatan_mulai', 'Tanggal Awal', 'trim|xss_clean|required');
				$this->form_validation->set_rules('tgl_kegiatan_akhir', 'Tanggal Akhir', 'trim|xss_clean|required');
				$this->form_validation->set_rules('deskripsi', 'Deskripsi Kegiatan', 'trim|xss_clean|required|max_length[300]');
				$this->form_validation->set_rules('target_kegiatan', 'Target Kegiatan', 'trim|xss_clean|required|max_length[20]');
				$this->form_validation->set_rules('id_verifikator', 'Verifikator Kegiatan', 'trim|xss_clean|required');

				if ($this->form_validation->run() == true) {
					$this->verifikasi_kegiatan_personal_model->update_kegiatan_personal($this->id_skpd, $this->id_pegawai, $this->input->post('id_kegiatan_personal'));
					echo '<script>javascript:alert("Berhasil! Kegiatan berhasil diupdate");window.location = window.location.href;</script>';
				}else {
					echo '<script>javascript:alert("Gagal! Ada kesalahan, silahkan coba lagi");window.location = window.location.href;</script>';
				}

			}

			if (isset($_POST['kerjakan_pekerjaan'])) {
				$this->form_validation->set_error_delimiters('<div style="color:red;">', '</div>');
				$this->form_validation->set_rules('deskripsi_hasil', 'Deskripsi Hasil Kegiatan', 'trim|xss_clean|required|max_length[300]');
				$this->form_validation->set_rules('lampiran', 'File Lampiran', 'trim|xss_clean');
				$this->form_validation->set_rules('tgl_selesai_kegiatan', 'Tanggal Selesai Kegiatan', 'trim|xss_clean|required');

				if ($this->form_validation->run() == true) {

					$id_keg = $this->input->post('id_kegiatan_personal');
					$this->verifikasi_kegiatan_personal_model->kerjakan_kegiatan_personal($id_keg, $this->id_pegawai);
					echo '<script>alert("Berhasil! Kegiatan berhasil dikerjakan");window.location = window.location.href;</script>';
				}else {
					echo '<script>javascript:alert("Gagal! Ada kesalahan, silahkan coba lagi");window.location = window.location.href;</script>';
				}

			}

			$this->load->view('admin/index',$data);
		}
		else
		{
			redirect('admin');
		}
	}

	public function detail_kegiatan($id_pegawai, $id_kegiatan){
		if ($this->user_id)
		{
			if (!($id_pegawai)) {
				redirect(base_url('verifikasi_kegiatan_personal'));
			}
			if (!($id_kegiatan)) {
				redirect(base_url('verifikasi_kegiatan_personal'));
			}
			$data['title']		= "Detail kegiatan personal - Admin ";
			$data['content']	= "verifikasi_kegiatan_personal/detail_kegiatan" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "verifikasi_kegiatan_personal";
			$data['kegiatan'] =  $this->verifikasi_kegiatan_personal_model->get_kegiatan_by_id($id_pegawai, $id_kegiatan);

			$this->load->view('admin/index',$data);
		}
		else
		{
			redirect('admin');
		}
	}

	public function detail_verifikasi_kegiatan($id_pegawai, $id_kegiatan){
		if ($this->user_id)
		{
			if (!($id_pegawai)) {
				redirect(base_url('verifikasi_kegiatan_personal'));
			}
			if (!($id_kegiatan)) {
				redirect(base_url('verifikasi_kegiatan_personal'));
			}

			$data['kegiatan'] =  $this->verifikasi_kegiatan_personal_model->get_kegiatan_by_id($id_pegawai, $id_kegiatan);

			if ($this->id_pegawai != $data['kegiatan']->id_pegawai_verifikator) {
				show_404();
			}
			
			$data['title']		= "Detail Verifikasi kegiatan personal - Admin ";
			$data['content']	= "verifikasi_kegiatan_personal/detail_verifikasi_kegiatan" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "verifikasi_kegiatan_personal";
			
			$data['logs'] = $this->verifikasi_kegiatan_personal_model->logs($id_kegiatan);

			if (isset($_POST['tolak'])) {
				$this->verifikasi_kegiatan_personal_model->tolak($_POST['id_kegiatan_personal'], $this->user_id);
				echo '<script>alert("Berhasil! Kegiatan berhasil ditolak");window.location = window.location.href;</script>';
			}

			if (isset($_POST['verifikasi_kegiatan'])) {
				$this->verifikasi_kegiatan_personal_model->verifikasi_kegiatan($_POST['id_kegiatan_personal'], $this->user_id);
				echo '<script>alert("Berhasil! Kegiatan berhasil disetujui");window.location = window.location.href;</script>';
			}

			if (isset($_POST['batalkan'])) {
				$this->verifikasi_kegiatan_personal_model->batalkan($_POST['id_kegiatan_personal'], $this->user_id);
				echo '<script>alert("Berhasil! Kegiatan berhasil dibatalkan");window.location = window.location.href;</script>';
			}
			$this->load->model('iki_model');
			$data['iki'] = $this->iki_model->get_sasaran_by_id($this->id_pegawai);

			$this->load->view('admin/index',$data);
		}
		else
		{
			redirect('admin');
		}
	}


}
?>
