<?php
defined('BASEPATH') or exit('No direct script access allowed');

require './vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Skp_sicerdas extends CI_Controller
{
	public $user_id;
	public $id_skpd;


	public function __construct()
	{
		parent::__construct();
		$this->user_id = $this->session->userdata('user_id');
		$this->load->model('user_model');
		$this->load->model('kegiatan_personal_model');
		$this->load->model('logs_model');
		$this->load->model('ref_skpd_model');
		$this->load->model('renja_perencanaan_model');
		$this->load->model('kerja_luar_kantor_model');
		$this->load->model('renja_perencanaan_model');
		$this->load->model('renja_rka_model');
		$this->load->model('renstra_realisasi_model');
		$this->load->model('ref_visi_misi_model');
		$this->load->model('skp_model');
		$this->load->model('ref_satuan_model');
		$this->user_model->user_id = $this->user_id;
		$this->user_model->set_user_by_user_id();
		$this->user_picture = $this->user_model->user_picture;
		$this->full_name	= $this->user_model->full_name;
		$this->user_level	= $this->user_model->level;
		$this->id_skpd = $this->user_model->id_skpd;
		$this->id_pegawai = $this->user_model->id_pegawai;
		$this->load->helper('skp_helper');
		if ($this->user_level == "Admin Web");
		if (null === $this->session->userdata('pegawai_skp')) {
			$this->session->set_userdata('pegawai_skp', $this->session->userdata('id_pegawai'));
		}

		// $this->load->model('realisasi_kegiatan_model','realisasi_kegiatan_m');
	}

	public function index()
	{
		if ($this->user_id) {

			if ($this->user_level != "Operator" and $this->user_level != "Administrator") {
				$this->pegawai('self');
			} else {
				$data['title']		= "SKP Sicerdas - Admin ";
				$data['content']	= "skp_sicerdas/list";
				$data['user_picture'] = $this->user_picture;
				$data['full_name']		= $this->full_name;
				$data['user_level']		= $this->user_level;
				$data['active_menu']		= 'skp_sicerdas';

				$hal = 6;
				$page = isset($_GET["page"]) ? (int) $_GET["page"] : 1;
				$mulai = ($page > 1) ? ($page * $hal) - $hal : 0;
				$total = count($this->master_pegawai_model->get_all(true));
				$data['pages'] = ceil($total / $hal);
				$data['current'] = $page;
				if (!empty($_GET['nama_lengkap']) or !empty($_GET['nio']) or !empty($_GET['id_skpd'])) {
					$filter = $_GET;
					$nama = @$_GET['nama_lengkap'];
					$nip = @$_GET['nip'];
					$skpd = @$_GET['id_skpd'];
					$data['filter'] = true;
					$data['filter_data'] = @$_GET;
					$data['nama_lengkap'] = @$_GET['nama_lengkap'];
					$data['nip'] = @$_GET['nip'];
					$data['id_skpd'] = $skpd;
				} else {
					$filter = '';
					$nama = '';
					$nip = '';
					$skpd = '';
					$data['filter'] = false;
				}

				$data['list'] = $this->master_pegawai_model->get_page($mulai, $hal, $nama, $nip, $skpd, '', true);

				if ($this->session->userdata('id_skpd')) { //Dinas 
					$data['skpd'] = $this->ref_skpd_model->get_all('', false, $this->session->userdata('id_skpd'));
				} else {
					$data['skpd'] = $this->ref_skpd_model->get_all('', true);
				}

				$this->load->view('admin/index', $data);
			}
		} else {
			redirect('admin');
		}
	}
	public function pegawai($id_pegawai)
	{
		if ($this->user_id) {
			$data['title']		= "SKP Sicerdas - Admin ";
			$data['content']	= "skp_sicerdas/index";
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "skp_sicerdas";

			if ($this->user_level != "Operator" and $this->user_level != "Administrator") {
				$id_pegawai = $this->session->userdata('id_pegawai');
			}
			$this->session->set_userdata('pegawai_skp', $id_pegawai);
			$data['pegawai'] = $this->master_pegawai_model->get_by_id($id_pegawai);
			$id_skpd = $data['pegawai']->id_skpd;
			$id_unit_kerja = $data['pegawai']->id_unit_kerja;
			$data['id_skpd'] = $id_skpd;
			$data['id_unit_kerja'] = $id_unit_kerja;
			$data['id_pegawai'] = $id_pegawai;
			$data['detail_unit_kerja'] = $this->ref_skpd_model->get_unit_kerja_by_id($id_unit_kerja);
			$data['kepala_unit_kerja'] = $this->ref_skpd_model->get_kepala_unit_kerja($id_unit_kerja);
			$data['jenis'] = array('ss' => 'Sasaran Strategis', 'sp' => 'Sasaran Program', 'sk' => 'Sasaran Kegiatan');
			$data['kepala_skpd'] = $this->ref_skpd_model->get_kepala_skpd($id_skpd);
			$data['detail_skpd'] = $this->ref_skpd_model->get_by_id($id_skpd);
			// print_r($data);die;
			$this->load->view('admin/index', $data);
		} else {
			redirect('admin');
		}
	}

	public function detail($tahun)
	{
		if ($this->user_id) {
			$data['title']		= "SKP Sicerdas - Admin ";
			$data['content']	= "skp_sicerdas/detail";
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "skp_sicerdas";

			$id_pegawai = $this->session->userdata('pegawai_skp');
			if (isset($_POST['insert'])) {
				$dt = array(
					'jenis_renja' => $_POST['jenis_renja'],
					'id_iku_renja' => $_POST['id_iku_renja'],
					'tahun' => $tahun,
					'kegiatan_tugas_jabatan' => $_POST['kegiatan_tugas_jabatan'],
					'kuantitas_satuan' => $_POST['kuantitas_satuan'],
					'kuantitas_target' => $_POST['kuantitas_target'],
					'kualitas_satuan' => $_POST['kualitas_satuan'],
					'kualitas_target' => $_POST['kualitas_target'],
					'waktu_satuan' => $_POST['waktu_satuan'],
					'waktu_target' => $_POST['waktu_target'],
					'biaya_satuan' => $_POST['biaya_satuan'],
					'biaya_target' => $_POST['biaya_target'],
					'id_pegawai_input' => $id_pegawai,
					'tanggal_perencanaan' => date('Y-m-d H:i:s'),
					'status_kegiatan' => 'Perencanaan',
				);
				$this->db->insert('iku_urtug', $dt);
			} elseif (isset($_POST['edit'])) {
				$dt = array(
					'kegiatan_tugas_jabatan' => $_POST['kegiatan_tugas_jabatan'],
					'kuantitas_satuan' => $_POST['kuantitas_satuan'],
					'kuantitas_target' => $_POST['kuantitas_target'],
					'kualitas_satuan' => $_POST['kualitas_satuan'],
					'kualitas_target' => $_POST['kualitas_target'],
					'waktu_satuan' => $_POST['waktu_satuan'],
					'waktu_target' => $_POST['waktu_target'],
					'biaya_satuan' => $_POST['biaya_satuan'],
					'biaya_target' => $_POST['biaya_target'],
					'id_pegawai_input' => $id_pegawai,
					'tanggal_perencanaan' => date('Y-m-d H:i:s'),
					'status_kegiatan' => 'Perencanaan',
				);
				$this->db->where('id_urtug', $_POST['id_urtug']);
				$this->db->update('iku_urtug', $dt);
			} elseif (isset($_POST['delete'])) {
				$this->db->where('id_urtug', $_POST['id_urtug']);
				$this->db->delete('iku_urtug');
			} elseif (isset($_POST['set'])) {
				$dt = array(
					'id_pegawai_input' => $id_pegawai,
					'tanggal_perencanaan' => date('Y-m-d H:i:s'),
					'status_kegiatan' => 'Realisasi',
				);
				$this->db->where('id_urtug', $_POST['id_urtug']);
				$this->db->update('iku_urtug', $dt);
			} elseif (isset($_POST['update'])) {
				$row = $this->db->where('id_urtug', $_POST['id_urtug'])->get('iku_urtug')->row();

				$dt = array(
					'kuantitas_realisasi' => $_POST['kuantitas_realisasi'],
					'kualitas_realisasi' => $_POST['kualitas_realisasi'],
					'waktu_realisasi' => $_POST['waktu_realisasi'],
					'biaya_realisasi' => $_POST['biaya_realisasi'],
					'capaian' => capaian_skp($row->kuantitas_target, $_POST['kuantitas_realisasi'], $row->kualitas_target, $_POST['kualitas_realisasi'], $row->waktu_target, $_POST['waktu_realisasi'], $row->biaya_target, $_POST['biaya_realisasi']),
					'tanggal_realisasi' => date('Y-m-d H:i:s'),
					'status_kegiatan' => 'Realisasi',
				);
				$this->db->where('id_urtug', $_POST['id_urtug']);
				$this->db->update('iku_urtug', $dt);
			} elseif (isset($_POST['sub'])) {
				foreach (@$_POST['id_pegawai'] as $value) {
					$dt = array(
						'jenis_renja' => $_POST['jenis_renja'],
						'id_iku_renja' => $_POST['id_iku_renja'],
						'tahun' => $tahun,
						'kegiatan_tugas_jabatan' => $_POST['kegiatan_tugas_jabatan'],
						'kuantitas_satuan' => $_POST['kuantitas_satuan'],
						'kuantitas_target' => $_POST['kuantitas_target'],
						'kualitas_satuan' => $_POST['kualitas_satuan'],
						'kualitas_target' => $_POST['kualitas_target'],
						'waktu_satuan' => $_POST['waktu_satuan'],
						'waktu_target' => $_POST['waktu_target'],
						'biaya_satuan' => $_POST['biaya_satuan'],
						'biaya_target' => $_POST['biaya_target'],
						'id_pegawai_input' => $value,
						'tanggal_perencanaan' => date('Y-m-d H:i:s'),
						'status_kegiatan' => 'Realisasi',
					);
					$this->db->insert('iku_urtug', $dt);
				}
			} elseif (isset($_POST['editsub'])) {
				$dt = array(
					'kegiatan_tugas_jabatan' => $_POST['kegiatan_tugas_jabatan'],
					'kuantitas_satuan' => $_POST['kuantitas_satuan'],
					'kuantitas_target' => $_POST['kuantitas_target'],
					'kualitas_satuan' => $_POST['kualitas_satuan'],
					'kualitas_target' => $_POST['kualitas_target'],
					'waktu_satuan' => $_POST['waktu_satuan'],
					'waktu_target' => $_POST['waktu_target'],
					'biaya_satuan' => $_POST['biaya_satuan'],
					'biaya_target' => $_POST['biaya_target'],
					'tanggal_perencanaan' => date('Y-m-d H:i:s'),
				);
				$this->db->where('jenis_renja', $_POST['jenis_renja']);
				$this->db->where('id_iku_renja', $_POST['id_iku_renja']);
				$this->db->where('tanggal_perencanaan', $_POST['tanggal_perencanaan']);
				$this->db->update('iku_urtug', $dt);
			} elseif (isset($_POST['deletesub'])) {
				$this->db->where('jenis_renja', 'cc');
				$this->db->where('id_iku_renja', $_POST['id_iku_renja']);
				$this->db->where('tanggal_perencanaan', $_POST['tanggal_perencanaan']);
				$this->db->delete('iku_urtug');
			} elseif (isset($_POST['removesub'])) {
				$this->db->where('id_urtug', $_POST['id_urtug']);
				$this->db->delete('iku_urtug');
			} elseif (isset($_POST['addsub'])) {
				$clone = $this->db->get_where('iku_urtug', array('jenis_renja' => 'cc', 'id_iku_renja' => $_POST['id_iku_renja'], 'tanggal_perencanaan' => $_POST['tanggal_perencanaan']))->row_array();
				foreach (@$_POST['id_pegawai'] as $value) {
					$dt = array(
						'jenis_renja' => $clone['jenis_renja'],
						'id_iku_renja' => $clone['id_iku_renja'],
						'tahun' => $tahun,
						'kegiatan_tugas_jabatan' => $clone['kegiatan_tugas_jabatan'],
						'kuantitas_satuan' => $clone['kuantitas_satuan'],
						'kuantitas_target' => $clone['kuantitas_target'],
						'kualitas_satuan' => $clone['kualitas_satuan'],
						'kualitas_target' => $clone['kualitas_target'],
						'waktu_satuan' => $clone['waktu_satuan'],
						'waktu_target' => $clone['waktu_target'],
						'biaya_satuan' => $clone['biaya_satuan'],
						'biaya_target' => $clone['biaya_target'],
						'id_pegawai_input' => $value,
						'tanggal_perencanaan' => $clone['tanggal_perencanaan'],
						'status_kegiatan' => 'Realisasi',
					);
					$this->db->insert('iku_urtug', $dt);
				}
			} elseif (isset($_POST['save'])) {
				$dt = array(
					'tanggal_realisasi' => date('Y-m-d H:i:s'),
					'status_kegiatan' => 'Selesai',
				);
				$this->db->where('id_urtug', $_POST['id_urtug']);
				$this->db->update('iku_urtug', $dt);
			}

			$data['id_pegawai'] = $id_pegawai;
			$data['pegawai'] = $this->master_pegawai_model->get_by_id($id_pegawai);
			$id_skpd = $data['pegawai']->id_skpd;
			$id_unit_kerja = $data['pegawai']->id_unit_kerja;
			$data['tahun'] = $tahun;
			$data['id_skpd'] = $id_skpd;
			$data['id_unit_kerja'] = $id_unit_kerja;
			$data['detail_unit_kerja'] = $this->ref_skpd_model->get_unit_kerja_by_id($id_unit_kerja);
			$data['kepala_unit_kerja'] = $this->ref_skpd_model->get_kepala_unit_kerja($id_unit_kerja);
			$data['jenis'] = array('ss' => 'Sasaran Strategis', 'sp' => 'Sasaran Program', 'sk' => 'Sasaran Kegiatan');
			$data['kepala_skpd'] = $this->ref_skpd_model->get_kepala_skpd($id_skpd);
			$data['detail_skpd'] = $this->ref_skpd_model->get_by_id($id_skpd);

			$data['ref_satuan'] = $this->db->get('ref_satuan')->result();
			$data['pegawai_bawahan'] = $this->db->get_where('pegawai', array('id_pegawai_atasan_langsung' => $id_pegawai))->result();


			$this->load->view('admin/index', $data);
		} else {
			redirect('admin');
		}
	}

	public function detail_bulanan($tahun)
	{
		if ($this->user_id) {
			$data['title']		= "SKP Sicerdas - Admin ";
			$data['content']	= "skp_sicerdas/detail_bulanan";
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "skp_sicerdas";

			$id_pegawai = $this->session->userdata('pegawai_skp');
			if (isset($_POST['insert'])) {
				$dt = array(
					'tahun' => $tahun,
					'bulan' => $_POST['bulan'],
					'id_urtug' => $_POST['id_urtug'],
					'kegiatan_tugas_jabatan' => $_POST['kegiatan_tugas_jabatan'],
					'kuantitas_satuan' => $_POST['kuantitas_satuan'],
					'kuantitas_target' => $_POST['kuantitas_target'],
					'kualitas_satuan' => $_POST['kualitas_satuan'],
					'kualitas_target' => $_POST['kualitas_target'],
					'waktu_satuan' => $_POST['waktu_satuan'],
					'waktu_target' => $_POST['waktu_target'],
					'biaya_satuan' => $_POST['biaya_satuan'],
					'biaya_target' => $_POST['biaya_target'],
					'id_pegawai_input' => $id_pegawai,
					'tanggal_perencanaan' => date('Y-m-d H:i:s'),
					'status_kegiatan' => 'Perencanaan',
				);
				$this->db->insert('iku_urtug_bulanan', $dt);
			} elseif (isset($_POST['edit'])) {
				$dt = array(
					'kegiatan_tugas_jabatan' => $_POST['kegiatan_tugas_jabatan'],
					'kuantitas_satuan' => $_POST['kuantitas_satuan'],
					'kuantitas_target' => $_POST['kuantitas_target'],
					'kualitas_satuan' => $_POST['kualitas_satuan'],
					'kualitas_target' => $_POST['kualitas_target'],
					'waktu_satuan' => $_POST['waktu_satuan'],
					'waktu_target' => $_POST['waktu_target'],
					'biaya_satuan' => $_POST['biaya_satuan'],
					'biaya_target' => $_POST['biaya_target'],
					'id_pegawai_input' => $id_pegawai,
					'tanggal_perencanaan' => date('Y-m-d H:i:s'),
					'status_kegiatan' => 'Perencanaan',
				);
				$this->db->where('id_urtug_bulanan', $_POST['id_urtug_bulanan']);
				$this->db->update('iku_urtug_bulanan', $dt);
			} elseif (isset($_POST['delete'])) {
				$this->db->where('id_urtug_bulanan', $_POST['id_urtug_bulanan']);
				$this->db->delete('iku_urtug_bulanan');
			} elseif (isset($_POST['set'])) {
				$dt = array(
					'id_pegawai_input' => $id_pegawai,
					'tanggal_perencanaan' => date('Y-m-d H:i:s'),
					'status_kegiatan' => 'Realisasi',
				);
				$this->db->where('id_urtug_bulanan', $_POST['id_urtug_bulanan']);
				$this->db->update('iku_urtug_bulanan', $dt);
			} elseif (isset($_POST['update'])) {
				$row = $this->db->where('id_urtug_bulanan', $_POST['id_urtug_bulanan'])->get('iku_urtug_bulanan')->row();

				$dt = array(
					'kuantitas_realisasi' => $_POST['kuantitas_realisasi'],
					'kualitas_realisasi' => $_POST['kualitas_realisasi'],
					'waktu_realisasi' => $_POST['waktu_realisasi'],
					'biaya_realisasi' => $_POST['biaya_realisasi'],
					'capaian' => capaian_skp($row->kuantitas_target, $_POST['kuantitas_realisasi'], $row->kualitas_target, $_POST['kualitas_realisasi'], $row->waktu_target, $_POST['waktu_realisasi'], $row->biaya_target, $_POST['biaya_realisasi']),
					'tanggal_realisasi' => date('Y-m-d H:i:s'),
					'status_kegiatan' => 'Realisasi',
				);
				$this->db->where('id_urtug_bulanan', $_POST['id_urtug_bulanan']);
				$this->db->update('iku_urtug_bulanan', $dt);
			} elseif (isset($_POST['save'])) {
				$dt = array(
					'tanggal_realisasi' => date('Y-m-d H:i:s'),
					'status_kegiatan' => 'Selesai',
				);
				$this->db->where('id_urtug_bulanan', $_POST['id_urtug_bulanan']);
				$this->db->update('iku_urtug_bulanan', $dt);
			}

			$data['id_pegawai'] = $id_pegawai;
			$data['pegawai'] = $this->master_pegawai_model->get_by_id($id_pegawai);
			$id_skpd = $data['pegawai']->id_skpd;
			$id_unit_kerja = $data['pegawai']->id_unit_kerja;
			$data['tahun'] = $tahun;
			$data['id_skpd'] = $id_skpd;
			$data['id_unit_kerja'] = $id_unit_kerja;
			$data['detail_unit_kerja'] = $this->ref_skpd_model->get_unit_kerja_by_id($id_unit_kerja);
			$data['kepala_unit_kerja'] = $this->ref_skpd_model->get_kepala_unit_kerja($id_unit_kerja);
			$data['kepala_skpd'] = $this->ref_skpd_model->get_kepala_skpd($id_skpd);
			$data['detail_skpd'] = $this->ref_skpd_model->get_by_id($id_skpd);

			$data['ref_satuan'] = $this->db->get('ref_satuan')->result();

			$data['iku_urtug'] = $this->db->get_where('iku_urtug', array('id_pegawai_input' => $id_pegawai, 'tahun' => $tahun))->result();

			// print_r($data['iku_urtug']); die();


			$this->load->view('admin/index', $data);
		} else {
			redirect('admin');
		}
	}

	public function cetak($tahun, $penilaian = false)
	{
		if ($this->user_id) {
			$data['title']		= "SKP Sicerdas - Admin ";
			$data['content']	= "skp_sicerdas/cetak";
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "skp_sicerdas";

			$id_pegawai = $this->session->userdata('pegawai_skp');

			$data['id_pegawai'] = $id_pegawai;
			$data['pegawai'] = $this->master_pegawai_model->get_by_id($id_pegawai);
			$id_pegawai_atasan = ($data['pegawai']->kepala_skpd == "Y") ? 77 : $data['pegawai']->id_pegawai_atasan_langsung;
			$data['pegawai_atasan'] = $this->master_pegawai_model->get_by_id($id_pegawai_atasan);
			$id_skpd = $data['pegawai']->id_skpd;
			$id_unit_kerja = $data['pegawai']->id_unit_kerja;
			$data['tahun'] = $tahun;
			$data['id_skpd'] = $id_skpd;
			$data['id_unit_kerja'] = $id_unit_kerja;
			$data['detail_unit_kerja'] = $this->ref_skpd_model->get_unit_kerja_by_id($id_unit_kerja);
			$data['kepala_unit_kerja'] = $this->ref_skpd_model->get_kepala_unit_kerja($id_unit_kerja);
			$data['jenis'] = array('ss' => 'Sasaran Strategis', 'sp' => 'Sasaran Program', 'sk' => 'Sasaran Kegiatan');
			$data['kepala_skpd'] = $this->ref_skpd_model->get_kepala_skpd($id_skpd);
			$data['detail_skpd'] = $this->ref_skpd_model->get_by_id($id_skpd);

			$data['ref_satuan'] = $this->db->get('ref_satuan')->result();
			$data['pegawai_bawahan'] = $this->db->get_where('pegawai', array('id_pegawai_atasan_langsung' => $id_pegawai))->result();

			if ($penilaian) {
				$this->load->view('admin/skp_sicerdas/cetak_penilaian', $data);
			} else {
				$this->load->view('admin/skp_sicerdas/cetak', $data);
			}
		} else {
			redirect('admin');
		}
	}

	public function kesenjangan_kinerja($tahun)
	{
		if ($this->user_id) {
			$data['title']		= "SKP Sicerdas - Admin ";
			$data['content']	= "skp_sicerdas/kesenjangan_kinerja";
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "skp_sicerdas";

			$id_pegawai = $this->session->userdata('pegawai_skp');

			$data['id_pegawai'] = $id_pegawai;
			$data['pegawai'] = $this->master_pegawai_model->get_by_id($id_pegawai);
			$data['pegawai_atasan'] = $this->master_pegawai_model->get_by_id($data['pegawai']->id_pegawai_atasan_langsung);
			$id_skpd = $data['pegawai']->id_skpd;
			$id_unit_kerja = $data['pegawai']->id_unit_kerja;
			$data['tahun'] = $tahun;
			$data['id_skpd'] = $id_skpd;
			$data['id_unit_kerja'] = $id_unit_kerja;
			$data['detail_unit_kerja'] = $this->ref_skpd_model->get_unit_kerja_by_id($id_unit_kerja);
			$data['kepala_unit_kerja'] = $this->ref_skpd_model->get_kepala_unit_kerja($id_unit_kerja);
			$data['jenis'] = array('ss' => 'Sasaran Strategis', 'sp' => 'Sasaran Program', 'sk' => 'Sasaran Kegiatan');
			$data['kepala_skpd'] = $this->ref_skpd_model->get_kepala_skpd($id_skpd);
			$data['detail_skpd'] = $this->ref_skpd_model->get_by_id($id_skpd);

			$data['ref_satuan'] = $this->db->get('ref_satuan')->result();
			$data['pegawai_bawahan'] = $this->db->get_where('pegawai', array('id_pegawai_atasan_langsung' => $id_pegawai))->result();

			$this->load->view('admin/index', $data);
		} else {
			redirect('admin');
		}
	}

	public function cetak_bulanan($tahun, $bulan, $penilaian = false)
	{
		if ($this->user_id) {
			$data['title']		= "SKP Sicerdas - Admin ";
			$data['content']	= "skp_sicerdas/cetak_bulanan";
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "skp_sicerdas";

			$id_pegawai = $this->session->userdata('pegawai_skp');

			$data['id_pegawai'] = $id_pegawai;
			$data['pegawai'] = $this->master_pegawai_model->get_by_id($id_pegawai);
			$data['pegawai_atasan'] = $this->master_pegawai_model->get_by_id($data['pegawai']->id_pegawai_atasan_langsung);
			$id_skpd = $data['pegawai']->id_skpd;
			$id_unit_kerja = $data['pegawai']->id_unit_kerja;
			$data['tahun'] = $tahun;
			$data['bulan'] = $bulan;
			$data['id_skpd'] = $id_skpd;
			$data['id_unit_kerja'] = $id_unit_kerja;
			$data['detail_unit_kerja'] = $this->ref_skpd_model->get_unit_kerja_by_id($id_unit_kerja);
			$data['kepala_unit_kerja'] = $this->ref_skpd_model->get_kepala_unit_kerja($id_unit_kerja);
			$data['kepala_skpd'] = $this->ref_skpd_model->get_kepala_skpd($id_skpd);
			$data['detail_skpd'] = $this->ref_skpd_model->get_by_id($id_skpd);

			$data['ref_satuan'] = $this->db->get('ref_satuan')->result();

			if ($penilaian) {
				$this->load->view('admin/skp_sicerdas/cetak_penilaian_bulanan', $data);
			} else {
				$this->load->view('admin/skp_sicerdas/cetak_bulanan', $data);
			}
		} else {
			redirect('admin');
		}
	}

	public function detail_pegawai($tahun)
	{
		$data['title']		= "SKP Sicerdas - Admin ";
		$data['content']	= "skp_sicerdas/detail_pegawai";
		$data['user_picture'] = $this->user_picture;
		$data['full_name']		= $this->full_name;
		$data['user_level']		= $this->user_level;
		$data['active_menu'] = "skp_sicerdas";

		$id_pegawai = $this->session->userdata('pegawai_skp');
		$data['pegawai'] = $this->master_pegawai_model->get_by_id($id_pegawai);
		$id_skpd = $data['pegawai']->id_skpd;
		$id_unit_kerja = $data['pegawai']->id_unit_kerja;
		$data['tahun'] = $tahun;
		$data['id_skpd'] = $id_skpd;
		$data['id_unit_kerja'] = $id_unit_kerja;
		$data['id_pegawai'] = $id_pegawai;
		$data['detail_unit_kerja'] = $this->ref_skpd_model->get_unit_kerja_by_id($id_unit_kerja);
		$data['kepala_unit_kerja'] = $this->ref_skpd_model->get_kepala_unit_kerja($id_unit_kerja);
		$data['jenis'] = array('ss' => 'Sasaran Strategis', 'sp' => 'Sasaran Program', 'sk' => 'Sasaran Kegiatan');
		$data['kepala_skpd'] = $this->ref_skpd_model->get_kepala_skpd($id_skpd);
		$data['detail_skpd'] = $this->ref_skpd_model->get_by_id($id_skpd);

		$data['sasaran_skp'] = $this->skp_model->get_sasaran($id_pegawai, $id_unit_kerja, $tahun);
		$data['satuan'] = $this->ref_satuan_model->get_all();

		$this->load->view('admin/index', $data);
	}

	public function saveSasaran($method = "")
	{
		$post = $_POST;
		$res = array('title' => '', 'message' => '', 'message_type' => '');
		$id_pegawai = $this->session->userdata('pegawai_skp');
		$pegawai = $this->master_pegawai_model->get_by_id($id_pegawai);
		if ($method == "add") {
			unset($post['id_sasaran_skp']);
			if (cekForm($post)) {
				$res['title'] = "Oops";
				$res['message'] = "Masih ada form yang kosong";
				$res['message_type'] = "warning";
			} else {

				$post['id_skpd'] = $pegawai->id_skpd;
				$post['id_unit_kerja'] = $pegawai->id_unit_kerja;
				$post['id_pegawai'] = $id_pegawai;

				$save = $this->skp_model->save_sasaran($post);
				if ($save) {

					$res['title'] = "Success";
					$res['message'] = "Sasaran berhasil ditambahkan";
					$res['message_type'] = "success";
				} else {

					$res['title'] = "Error";
					$res['message'] = "Terjadi kesalahan";
					$res['message_type'] = "danger";
				}
			}
		} elseif ($method = "edit") {
			unset($post['id_sasaran_skp']);
			if (cekForm($post)) {
				$res['title'] = "Oops";
				$res['message'] = "Masih ada form yang kosong";
				$res['message_type'] = "warning";
			} else {
				$save = $this->skp_model->update_sasaran($post, $_POST['id_sasaran_skp']);
				if ($save) {

					$res['title'] = "Success";
					$res['message'] = "Sasaran berhasil diupdate";
					$res['message_type'] = "success";
				} else {

					$res['title'] = "Error";
					$res['message'] = "Terjadi kesalahan";
					$res['message_type'] = "danger";
				}
			}
		}

		echo json_encode($res);
	}


	public function saveIndikator($method = "")
	{
		$post = $_POST;
		$res = array('title' => '', 'message' => '', 'message_type' => '');
		$id_pegawai = $this->session->userdata('pegawai_skp');
		$pegawai = $this->master_pegawai_model->get_by_id($id_pegawai);
		if ($method == "add") {
			unset($post['id_sasaran_skp_indikator']);
			if (cekForm($post)) {
				$res['title'] = "Oops";
				$res['message'] = "Masih ada form yang kosong";
				$res['message_type'] = "warning";
			} else {

				$save = $this->skp_model->save_indikator($post);
				if ($save) {

					$res['title'] = "Success";
					$res['message'] = "Indikator berhasil ditambahkan";
					$res['message_type'] = "success";
				} else {

					$res['title'] = "Error";
					$res['message'] = "Terjadi kesalahan";
					$res['message_type'] = "danger";
				}
			}
		} elseif ($method = "edit") {
			unset($post['id_sasaran_skp_indikator']);
			if (cekForm($post)) {
				$res['title'] = "Oops";
				$res['message'] = "Masih ada form yang kosong";
				$res['message_type'] = "warning";
			} else {

				$save = $this->skp_model->update_indikator($post, $_POST['id_sasaran_skp_indikator']);
				if ($save) {

					$res['title'] = "Success";
					$res['message'] = "Indikator berhasil diupdate";
					$res['message_type'] = "success";
				} else {

					$res['title'] = "Error";
					$res['message'] = "Terjadi kesalahan";
					$res['message_type'] = "danger";
				}
			}
		}

		echo json_encode($res);
	}


	public function saveRealisasi()
	{
		$post = $_POST;
		$res = array('title' => '', 'message' => '', 'message_type' => '');

		if (empty($post['perhitungan_capaian'])) {
			unset($post['capaian']);
		}
		if (cekForm($post)) {
			$res['title'] = "Oops";
			$res['message'] = "Masih ada form yang kosong";
			$res['message_type'] = "warning";
		} else {

			if (isset($post['perhitungan_capaian'])) {
				$post['perhitungan_capaian'] = 'manual';
			} else {
				$iku = $this->skp_model->get_indikator_by_id($post['id_sasaran_skp_indikator']);
				$target = $iku->target;
				$realisasi = $_POST['realisasi'];
				$pola = $iku->polarisasi;
				$capaian = get_capaian($target, $realisasi, $pola);
				$post['perhitungan_capaian'] = 'otomatis';
				$post['capaian'] = $capaian;
			}
			unset($post['id_sasaran_skp_indikator']);
			$save = $this->skp_model->save_realisasi($post, $_POST['id_sasaran_skp_indikator']);
			if ($save) {

				$res['title'] = "Success";
				$res['message'] = "Realisasi berhasil diupdate";
				$res['message_type'] = "success";
			} else {

				$res['title'] = "Error";
				$res['message'] = "Terjadi kesalahan";
				$res['message_type'] = "danger";
			}
		}

		echo json_encode($res);
	}

	public function getIndikatorbyID($id_sasaran_skp_indikator)
	{
		echo json_encode($this->skp_model->get_indikator_by_id($id_sasaran_skp_indikator));
	}

	public function getSasaranByID($id_sasaran_skp)
	{
		echo json_encode($this->skp_model->get_sasaran_by_id($id_sasaran_skp));
	}
	public function deleteIndikator($id_sasaran_skp_indikator)
	{
		$res = array('title' => '', 'message' => '', 'message_type' => '');
		$del = $this->skp_model->delete_indikator($id_sasaran_skp_indikator);
		if ($del) {

			$res['title'] = "Success";
			$res['message'] = "Indikator berhasil dihapus";
			$res['message_type'] = "success";
		} else {

			$res['title'] = "Error";
			$res['message'] = "Terjadi kesalahan";
			$res['message_type'] = "danger";
		}
		echo json_encode($res);
	}

	public function deleteSasaran($id_sasaran_skp)
	{
		$res = array('title' => '', 'message' => '', 'message_type' => '');
		$del = $this->skp_model->delete_sasaran($id_sasaran_skp);
		if ($del) {

			$res['title'] = "Success";
			$res['message'] = "Sasaran berhasil dihapus";
			$res['message_type'] = "success";
		} else {

			$res['title'] = "Error";
			$res['message'] = "Terjadi kesalahan";
			$res['message_type'] = "danger";
		}
		echo json_encode($res);
	}

	public function coba()
	{
		$capaian = capaian_skp(200, 178, 100, 86, 12, 12, 0, 0);
		echo konversi_nilai_skp($capaian);
	}

	public function update_capaian()
	{
		$get = $this->db->where('kuantitas_realisasi >', 0)->get('iku_urtug')->result();
		// $get = $this->db->where('kuantitas_realisasi >', 0)->get('iku_urtug_bulanan')->result();
		foreach ($get as $row) {
			$capaian = capaian_skp($row->kuantitas_target, $row->kuantitas_realisasi, $row->kualitas_target, $row->kualitas_realisasi, $row->waktu_target, $row->waktu_realisasi, $row->biaya_target, $row->biaya_realisasi);
			$this->db->where('id_urtug', $row->id_urtug)->update('iku_urtug', array('capaian' => $capaian));
			// $this->db->where('id_urtug_bulanan',$row->id_urtug_bulanan)->update('iku_urtug_bulanan', array('capaian' => $capaian));
		}
	}
}
