<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Peer_review extends CI_Controller
{
	public $user_id;

	public function __construct()
	{
		parent::__construct();
		$this->user_id = $this->session->userdata('user_id');
		$this->load->model('user_model');
		$this->load->model('peer_review_model');
		$this->load->model('master_pegawai_model');
		$this->user_model->user_id = $this->user_id;
		$this->user_model->set_user_by_user_id();
		$this->user_picture = $this->user_model->user_picture;
		$this->full_name	= $this->user_model->full_name;
		$this->user_privileges = explode(";", $this->session->userdata('user_privileges'));
		$this->user_level	= $this->user_model->level;
		// if ($this->user_level == "Admin Web");

		// $this->load->model('agenda_harian_model','agenda_harian_m');
	}
	public function index()
	{
		redirect('kinerja/perilaku');
		if ($this->user_id) {
			$data['title']		= "Peer Review ";
			$data['content']	= "peer_review/index";
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "peer_review";

			// $data['item'] = $this->agenda_harian_m->get_all();
			$id_pegawai = $this->session->userdata('id_pegawai');
			$id_skpd = $this->session->userdata('id_skpd');
			$id_unit_kerja = $this->session->userdata('unit_kerja_id');
			$bulan = isset($_GET['bulan']) ? $_GET['bulan'] : date('m');
			$tahun = isset($_GET['tahun']) ? $_GET['tahun'] : date('Y');
			// print_r(2025%45);die;
			$data['bulan'] = $bulan;
			$data['tahun'] = $tahun;

			// get data id atasan
			// $pegawai = $this->db->get_where('pegawai', array('id_pegawai' => $id_pegawai))->row();
			// $id_atasan_langsung = $pegawai->id_pegawai_atasan_langsung;

			// $data['menilai'] = $this->peer_review_model->get_menilai(26, 18, 632, $bulan, $tahun); // get data bersama atasan
			$data['menilai'] = $this->peer_review_model->get_menilai($id_pegawai, $id_skpd, $bulan, $tahun);
			$id_pegawai_penilai = $this->session->userdata('id_pegawai');
			$data['id_pegawai_penilai'] = $id_pegawai_penilai;
			// print_r($data['menilai']);die;
			
			// echo json_encode($data['menilai']); die;
			$this->load->view('admin/index', $data);
		} else {
			redirect('admin');
		}
	}


	public function detail($id_pegawai, $bulan, $tahun)
	{
		redirect('kinerja/perilaku');
		if ($this->user_id) {

			$data['title']		= "Detail Penilaian 360°  ";
			$data['content']	= "peer_review/detail";
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "peer_review";
			$data['bulan'] = $bulan;
			$data['tahun'] = $tahun;
			$id_pegawai_penilai = $this->session->userdata('id_pegawai');
			if (!empty($_POST)) {
				$data_penilai = array('bulan' => $bulan, 'tahun' => $tahun, 'id_pegawai' => $id_pegawai, 'id_pegawai_penilai' => $id_pegawai_penilai, 'tanggal_isi' => date('Y-m-d'), 'waktu_isi' => date('H:i:s'));
				$insert_penilai = $this->peer_review_model->insert_penilai($data_penilai);
				if ($insert_penilai) {
					$arr_jawaban = $_POST['jawaban'];
					foreach ($arr_jawaban as $id_pr_pertanyaan => $jawaban) {
						$data_detail = array('id_pr_pertanyaan' => $id_pr_pertanyaan, 'jawaban' => $jawaban);
						$this->peer_review_model->insert_penilai_detail($data_detail, $insert_penilai);
					}
				}
			}

			$data['pegawai'] = $this->master_pegawai_model->get_by_id($id_pegawai);
			$data['instrumen'] = $this->peer_review_model->get_instrumen($data['pegawai']->jenis_pegawai);
			$data['penilaian'] = $this->peer_review_model->get_penilai($id_pegawai, $id_pegawai_penilai, $bulan, $tahun);
			$this->load->view('admin/index', $data);
		} else {
			redirect('admin');
		}
	}


	public function randomize()
	{
		// $this->db->limit(6);
		$pegawai = $this->db->get_where('pegawai', array('pensiun' => 0))->result();

		$penilaian = array();

		foreach ($pegawai as $key  => $p) {
			$list_penilai = array();

			$selected = array();

			while (count($list_penilai) < 4) {

				// if(in_array($list_penilai))

				if (count($selected) >= count($pegawai)) {
					break;
				}
				$penilai = $pegawai[rand(0, count($pegawai) - 1)];


				if ($penilai->nama_lengkap !== $p->nama_lengkap) {
					if (!in_array($penilai->nama_lengkap, $list_penilai)) {

						// if (!in_array($penilai->nama_lengkap, $selected)) {
						$selected[] = $penilai->nama_lengkap;
						// }

						$count = 0;
						// $nama = array();
						foreach ($penilaian as $pp) {
							foreach ($pp['penilai'] as $pe) {
								if ($penilai->nama_lengkap == $pe) {
									// $nama[] = $penilai->nama_lengkap;
									$count++;
								}
							}
						}

						// if ($count < 6) {
						$list_penilai[] = $penilai->nama_lengkap;
						// echo $count;
						// }
					}
				}
				// print_r($selected);
			}


			$penilaian[] = array('nama_lengkap' => $p->nama_lengkap, 'penilai' => $list_penilai);
			// break;

		}

		print_r($penilaian);
	}

	public function randomize2()
	{
		$this->db->where('id_skpd', 16);
		// $this->db->limit(10);
		$pegawai = $this->db->get_where('pegawai', array('pensiun' => 0))->result();

		$penilaian = array();

		$lompat = rand(1, 999);
		$row = count($pegawai);
		// echo $lompat;
		if ($row % $lompat == 0) {
			$lompat++;
		}
		foreach ($pegawai as $key  => $p) {

			$list_penilai = array();

			for ($i = 1; $i <= 4; $i++) {
				$p_key = $key + $lompat * $i % $row;
				if (empty($pegawai[$p_key])) {
					$p_key = $p_key - $row;
				}
				$penilai = $pegawai[$p_key];
				$list_penilai[] = $penilai->nama_lengkap;
			}

			$penilaian[] = array('nama_lengkap' => $p->nama_lengkap, 'penilai' => $list_penilai);
		}

		print_r($penilaian);
	}

	public function rekap()
	{
		$data['title']        = "Rekap Penilaian Perilaku";
		$data['content']    = "peer_review/rekap";
		$data['user_picture'] = $this->user_picture;
		$data['full_name']        = $this->full_name;
		$data['user_level']        = $this->user_level;


		$this->load->model('ref_skpd_model');
		if (in_array('kepegawaian', $this->user_privileges)) {
			$data['skpd_kepegawaian'] = $this->session->userdata('id_skpd');
			$data['skpd'][] = $this->ref_skpd_model->get_by_id($this->session->userdata('id_skpd'));
			$id_skpd = $data['skpd'][0]->id_skpd;
		} else {
			$data['skpd'] = $this->ref_skpd_model->get_all();
			$id_skpd = 0;
		}
		$bulan = date("m");
		$tahun = date("Y");
		if ($this->input->get("bulan")) {
			$bulan = $this->input->get("bulan", true);
		}

		if ($this->input->get("id_skpd")) {
			$id_skpd = $this->input->get("id_skpd", true);
		}

		if ($this->input->get("tahun")) {
			$tahun = $this->input->get("tahun", true);
		}

		$data['id_skpd'] = $id_skpd;
		$data['bulan'] = $bulan;
		$data['tahun'] = $tahun;

		$data['pegawai'] = $this->peer_review_model->get_list_pegawai($id_skpd, $bulan, $tahun);
		$this->load->view('admin/index', $data);
	}
}
