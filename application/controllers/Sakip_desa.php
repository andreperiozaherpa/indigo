<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Sakip_desa extends CI_Controller
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
		$this->full_name	= $this->user_model->full_name;
		$this->user_level	= $this->user_model->level;
		$this->load->model('skpd_model');
		$this->load->model('ref_skpd_model');
		$this->load->model('rpjmdesa_model');
		$this->load->model('ref_unit_kerja_model');
		$this->load->model('sakip_desa/visimisi_desa_model');
		$this->level_id	= $this->user_model->level_id;
		if ($this->level_id > 2) redirect("admin");
	}

	public function index()
	{
		if ($this->user_id) {
			$data['title']		= "SAKIP Desa";
			$data['content']	= "sakip_desa/index";
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "sakip_desa";

			$id_skpd = $this->session->userdata('id_skpd');
			$detail_skpd = $this->ref_skpd_model->get_by_id($id_skpd);
			if ($detail_skpd) {
				$detail_induk = $this->ref_skpd_model->get_by_id($detail_skpd->id_skpd_induk);
				$id_kecamatan = $detail_skpd->id_kecamatan;
			} else {
				$id_kecamatan = 0;
			}


			$get_desa = curlMadasih('list_desa?id_kecamatan=' . $id_kecamatan);
			if ($get_desa) {
				$all_desa = json_decode($get_desa);
			} else {
				$all_desa = array();
			}

			$hal = 6;
			$page = isset($_GET["page"]) ? (int)$_GET["page"] : 1;
			$mulai = ($page > 1) ? ($page * $hal) - $hal : 0;
			$total = count($all_desa);
			$data['pages'] = ceil($total / $hal);
			$data['current'] = $page;
			if (!empty($_POST)) {
				if (!empty($_POST['id_kecamatan'])) {
					$id_kecamatan = $_POST['id_kecamatan'];
					$get_desa = curlMadasih('list_desa?id_kecamatan=' . $id_kecamatan);
				}
				$filter = $_POST;
				$data['filter'] = true;
				$data['filter_data'] = $_POST;
			} else {
				$filter = array();
				$data['filter'] = false;
			}
			$get_desa_page = curlMadasih("page_desa?mulai=$mulai&hal=$hal&id_kecamatan=$id_kecamatan", $filter, true);
			if ($get_desa_page) {
				$page_desa = json_decode($get_desa_page);
			} else {
				$page_desa = array();
			}
			$data['list'] = $page_desa;

			$data['kecamatan'] = $this->ref_skpd_model->get_by_jenis('kecamatan');

			$this->load->view('admin/index', $data);
		} else {
			redirect('admin');
		}
	}

	public function detail($id_desa)
	{
		if ($this->user_id) {
			$data['title']		= "SAKIP Desa";
			$data['content']	= "sakip_desa/detail";
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "sakip_desa";
			$data['detail_skpd'] = json_decode(curlMadasih("detail_desa?id_desa=$id_desa"));
			$data['kepala_skpd'] = $data['detail_skpd']->kepala;
			$tahun = 2020;
			$sasaran_sakip =  json_decode(curlMadasih("sasaran_sakip?id_desa=$id_desa&tahun=$tahun"));
			$data['bidang'] = json_decode(curlMadasih("list_bidang?id_desa=$id_desa&tahun=$tahun"));
			$data['sasaran'] = $sasaran_sakip->sasaran;
			$data['tahun_awal'] = $sasaran_sakip->tahun_awal;
			$data['tahun_akhir'] = $sasaran_sakip->tahun_akhir;
			$data['tahun'] = $tahun;
			$data['id_skpd'] = $id_desa;
			$this->load->view('admin/index', $data);
		} else {
			redirect('admin');
		}
	}

	public function detail_tahun($id_desa, $tahun)
	{
		if ($this->user_id) {
			$data['title']		= "SAKIP Desa";
			$data['content']	= "sakip_desa/detail_tahun";
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "sakip_desa";
			$data['detail_skpd'] = json_decode(curlMadasih("detail_desa?id_desa=$id_desa"));
			$data['kepala_skpd'] = $data['detail_skpd']->kepala;

			$sasaran_sakip =  json_decode(curlMadasih("sasaran_sakip?id_desa=$id_desa&tahun=$tahun"));
			$data['bidang'] = json_decode(curlMadasih("list_bidang?id_desa=$id_desa&tahun=$tahun"));
			$data['sasaran'] = $sasaran_sakip->sasaran;
			$data['tahun_awal'] = $sasaran_sakip->tahun_awal;
			$data['tahun_akhir'] = $sasaran_sakip->tahun_akhir;
			$data['tahun'] = $tahun;
			$data['id_skpd'] = $id_desa;
			$this->load->view('admin/index', $data);
		} else {
			redirect('admin');
		}
	}


	public function detail_realisasi_kk($id_sd_target_indikator)
	{
		if ($this->user_id) {
			$data['title']		= "Detail Realisasi KK";
			$data['content']	= "sakip_desa/detail_realisasi_kk";
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "sakip_desa";
			$data['detail_target'] = json_decode(curlMadasih("detail_target?id_sd_target_indikator=$id_sd_target_indikator"));
			$id_skpd = $data['detail_target']->id_skpd;
			$data['detail_skpd'] = json_decode(curlMadasih("detail_desa?id_desa=$id_skpd"));
			$data['kepala_skpd'] = $data['detail_skpd']->kepala;
			$data['list'] = json_decode(curlMadasih("list_keluarga_miskin?id_sd_target_indikator=$id_sd_target_indikator"));
			$this->load->view('admin/index', $data);
		} else {
			redirect('admin');
		}
	}

	public function detail_kegiatan($id_skpd, $tahun, $id_sd_sub_bidang)
	{
		if ($this->user_id) {
			$data['title']		= "Detail Rencana Strategis SKPD";
			$data['content']	= "sakip_desa/detail_kegiatan";
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "rkpdesa";
			$data['id_skpd'] = $id_skpd;
			$data['detail_sub_bidang'] = json_decode(curlMadasih("detail_sub_bidang?id_sd_sub_bidang=$id_sd_sub_bidang"));
			$data['kegiatan'] = $data['detail_sub_bidang']->kegiatan;
			$data['detail_skpd'] = json_decode(curlMadasih("detail_desa?id_desa=$id_skpd"));
			$data['kepala_skpd'] = $data['detail_skpd']->kepala;
			$this->load->view('admin/index', $data);
		} else {
			redirect('admin');
		}
	}
}
