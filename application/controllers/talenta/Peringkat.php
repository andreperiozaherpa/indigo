<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Peringkat extends CI_Controller
{
	public $user_id;

	public function __construct()
	{
		parent::__construct();
		$this->user_id = $this->session->userdata('user_id');
		$this->load->model('user_model');
		$this->user_model->user_id = $this->user_id;
		$this->user_model->set_user_by_user_id();
		$this->user_picture = $this->user_model->user_picture;
		$this->full_name = $this->user_model->full_name;
		$this->user_level = $this->user_model->level;

		$this->load->model("talenta/kebutuhan_model");
		$this->load->model("talenta/pendaftaran_model");
		$this->load->model("talenta/skor_model");


	}

	public function index()
	{
		$user_privileges = explode(";", $this->session->userdata('user_privileges'));
		if ($this->user_level == "Administrator" or in_array('talenta', $user_privileges)) {

		} else {
			redirect('welcome');
		}

		if ($this->user_id) {
			$data['title'] = "Peringkat - Manajemen Talenta";
			$data['content'] = "talenta/peringkat/index";
			$data['user_picture'] = $this->user_picture;
			$data['full_name'] = $this->full_name;
			$data['user_level'] = $this->user_level;
			//$data['active_menu'] = "ref_persyaratan";


			if ($this->session->flashdata("message_success")) {
				$data["message_success"] = $this->session->flashdata("message_success");
			}
			if ($this->session->flashdata("message_error")) {
				$data["message_error"] = $this->session->flashdata("message_error");
			}
			$this->load->library('form_validation');
			$where = array();
			if ($_POST) {
				$data['filter'] = $_POST;
				$this->form_validation->set_rules(
					'eselon',
					'Eselon',
					'required|in_list[I,II,III,IV]',
					[
						'required' => '%s harus diisi',
						'in_list' => '%s tidak valid',
					]
				);
				$this->form_validation->set_rules(
					'id_skpd',
					'SKPD',
					'required',
					[
						'required' => '%s harus diisi',
					]
				);

				$this->form_validation->set_rules(
					'id_jabatan',
					'Jabatan',
					'required',
					[
						'required' => '%s harus diisi',
					]
				);

				if ($this->input->post("eselon")) {
					$where['mt_kebutuhan.eselon'] = $this->input->post("eselon");
				}

				$data = array_merge($data, $_POST);
				if ($this->input->post("id_skpd")) {
					$where['ref_skpd.id_skpd'] = $this->input->post("id_skpd");

					$param = array("mt_kebutuhan.id_skpd" => $this->input->post("id_skpd"));
					$dt_jabatan = $this->kebutuhan_model->getSeleksi($param);
					$data['dt_jabatan'] = $dt_jabatan;
				}

				if ($this->input->post("id_jabatan")) {
					$where['ref_jabatan.id_jabatan'] = $this->input->post("id_jabatan");
				}

				if ($this->form_validation->run() == true) {


					$hal = 6;
					$page = isset($_GET["page"]) ? (int) $_GET["page"] : 1;
					$mulai = ($page > 1) ? ($page * $hal) - $hal : 0;
					$total = $this->skor_model->getTotalSummary($where);
					$data['pages'] = ceil($total / $hal);
					$data['current'] = $page;


					$data['dt_summary'] = $this->skor_model->getSummary($where, $hal, $mulai);
				}

			}




			$this->load->model("ref_skpd_model");
			$data['dt_skpd'] = $this->ref_skpd_model->get_all();

			//echo $this->session->userdata('id_pegawai');die;
			//echo "<pre>";print_r($data);die;

			$this->load->view('admin/index', $data);

		} else {
			redirect('admin');
		}
	}


	public function download($id_pedaftaran = null)
	{
		$user_privileges = explode(";", $this->session->userdata('user_privileges'));
		if ($this->user_level == "Administrator" or in_array('talenta', $user_privileges)) {

		} else {
			redirect('welcome');
		}

		if ($this->user_id) {
			$url = base_url("talenta/peringkat/profile/" . $id_pedaftaran . "/" . $this->config->item('app_token'));
			$filename = md5(uniqid()) . ".pdf";
			$path = "./data/talent/" . $filename;
			$output = array();
			$result = false;
			exec("xvfb-run wkhtmltopdf -T 20 -B 20 -L 20 -R 20  $url $path", $output, $result);
			if (!$result) {
				header("Content-type: application/download");
				header("Content-Disposition: inline; filename=" . $filename);
				@readfile($path);

				unlink($path);
			} else {
				//echo "<pre>";print_r($output);
				die("Error download");
			}
		} else {
			redirect('admin');
		}
	}
	public function profile($id_pedaftaran = null, $token = null)
	{
		$data = array();
		$dt_pendaftaran = $this->pendaftaran_model->get(['mt_pendaftaran.id_pendaftaran' => $id_pedaftaran]);
		if ($dt_pendaftaran && $id_pedaftaran != null && $token != null && $token == $this->config->item('app_token')) {
			$skpd = $this->db->where("id_skpd", 24)->get("ref_skpd")->result();
			$data['skpd'] = $skpd[0];
			$id_pegawai = $dt_pendaftaran[0]->id_pegawai;
			$data['dt_pendaftaran'] = $dt_pendaftaran[0];
			//echo "<pre>";print_r($dt_pendaftaran);die;

			$this->load->model("talenta/skor_model");
			$data['peringkat'] = $this->skor_model->getPeringkat($id_pegawai, $dt_pendaftaran[0]->id_kebutuhan);

			$param = array(
				'mt_kebutuhan.id_kebutuhan' => $dt_pendaftaran[0]->id_kebutuhan,
			);
			$data['dt_summary'] = $this->skor_model->getSummary($param);

			// idp
			$this->load->model("talenta/idp_model");
			$param = array(
				'mt_idp.id_pegawai' => $id_pegawai
			);
			$detail = $this->idp_model->get($param);
			$data['detail'] = (!empty($detail[0])) ? $detail[0] : null;


			$this->load->model("pegawai_model");
			$pegawai = $this->pegawai_model->get($id_pegawai);

			$pendidikan = $this->pegawai_model->get_riwayat_pendidikan($id_pegawai, 1);
			$pangkat = $this->pegawai_model->get_riwayat_pangkat($id_pegawai, 1);
			$jabatan = $this->pegawai_model->get_riwayat_jabatan($id_pegawai, 1);
			$unit_kerja = $this->pegawai_model->get_riwayat_unit_kerja($id_pegawai, 1);
			$diklat = $this->pegawai_model->get_riwayat_diklat($id_pegawai, 1);
			$penghargaan = $this->pegawai_model->get_riwayat_penghargaan($id_pegawai, 1);
			$cuti = $this->pegawai_model->get_riwayat_cuti($id_pegawai, 1);
			$penataran = $this->pegawai_model->get_riwayat_penataran($id_pegawai, 1);
			$seminar = $this->pegawai_model->get_riwayat_seminar($id_pegawai, 1);
			$bahasa = $this->pegawai_model->get_riwayat_bahasa($id_pegawai, 1);
			$bahasa_asing = $this->pegawai_model->get_riwayat_bahasa_asing($id_pegawai, 1);
			$kursus = $this->pegawai_model->get_riwayat_kursus($id_pegawai, 1);
			$penugasan = $this->pegawai_model->get_riwayat_penugasan($id_pegawai, 1);
			$hukuman = $this->pegawai_model->get_riwayat_hukuman($id_pegawai, 1);
			$pernikahan = $this->pegawai_model->get_riwayat_pernikahan($id_pegawai, 1);
			$anak = $this->pegawai_model->get_riwayat_anak($id_pegawai, 1);
			$orangtua = $this->pegawai_model->get_riwayat_orangtua($id_pegawai, 1);
			$mertua = $this->pegawai_model->get_riwayat_mertua($id_pegawai, 1);

			$data['pegawai'] = $pegawai[0];
			$data['pendidikan'] = $pendidikan;
			$data['pangkat'] = $pangkat;
			$data['jabatan'] = $jabatan;
			$data['unit_kerja'] = $unit_kerja;
			$data['diklat'] = $diklat;
			$data['penghargaan'] = $penghargaan;
			$data['cuti'] = $cuti;
			$data['penataran'] = $penataran;
			$data['seminar'] = $seminar;
			$data['bahasa'] = $bahasa;
			$data['bahasa_asing'] = $bahasa_asing;
			$data['kursus'] = $kursus;
			$data['penugasan'] = $penugasan;
			$data['hukuman'] = $hukuman;
			$data['pernikahan'] = $pernikahan;
			$data['anak'] = $anak;
			$data['orangtua'] = $orangtua;
			$data['mertua'] = $mertua;

			$this->load->view("admin/talenta/peringkat/profile_pegawai", $data);
		} else {

			show_404();
		}
	}

	public function download_all()
	{
		$user_privileges = explode(";", $this->session->userdata('user_privileges'));
		if ($this->user_level == "Administrator" or in_array('talenta', $user_privileges)) {

		} else {
			redirect('welcome');
		}

		if ($this->user_id) {
			$param = "";
			foreach ($_GET as $key => $value) {
				$param .= "/" . $value;
			}
			$url = base_url("talenta/peringkat/load_data" . $param . "/" . $this->config->item('app_token'));
			//var_dump($url);die;
			$filename = md5(uniqid()) . ".pdf";
			$path = "./data/talent/" . $filename;
			$output = array();
			$result = false;
			exec("xvfb-run wkhtmltopdf -T 20 -B 20 -L 20 -R 20 $url $path", $output, $result);
			if (!$result) {
				header("Content-type: application/download");
				header("Content-Disposition: inline; filename=" . $filename);
				@readfile($path);

				unlink($path);
			} else {
				echo "<pre>";
				print_r($output);
				die("Error download");
			}
		} else {
			redirect('admin');
		}
	}

	public function load_data($eselon = null, $id_skpd = null, $id_jabatan = null, $token = null)
	{
		if ($eselon != null && $id_skpd != null && $id_jabatan != null && $token != null && $token == $this->config->item('app_token')) {
			$where = array();
			$where['mt_kebutuhan.eselon'] = $eselon;

			$where['ref_skpd.id_skpd'] = $id_skpd;
			$where['ref_jabatan.id_jabatan'] = $id_jabatan;


			$data['dt_summary'] = $this->skor_model->getSummary($where);

			$data['eselon'] = $eselon;

			$this->load->view('admin/talenta/peringkat/download', $data);
		} else {
			show_404();
		}
	}


}
?>