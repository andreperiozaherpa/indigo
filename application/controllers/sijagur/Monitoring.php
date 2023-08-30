<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Monitoring extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('arsip_surat_model');
		$this->load->model('surat_masuk_model');
		$this->user_privileges = explode(";", $this->session->userdata('user_privileges'));
	}


	public function index()
	{

		if ($this->user_id) {
			$data['title']		= "Sijagur - Admin ";
			$data['content']	= "sijagur/map";
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "sijagur";
			$this->load->view('admin/index', $data);
		} else {
			redirect('admin');
		}
	}

	public function markers()
	{
		$this->db->order_by('last_update', 'DESC');
		$this->db->where('kepala_skpd', 'Y');
		$this->db->join('pegawai', 'pegawai.id_pegawai = sijagur_lokasi.id_pegawai');
		$loc = $this->db->get('sijagur_lokasi')->result();
		$markers = array();
		$summary_online = 0;
		$summary_count = count($loc);
		foreach ($loc as $l) {
			$latitude = $l->latitude;
			$longitude = $l->longitude;


			$last_time = "";
			$tanggal = "";
			$waktu = "";

			$last_time = $l->last_update;
			$ex = explode(" ", $last_time);
			$tanggal = $ex[0];
			$waktu = $ex[1];

			//check if user online by waktu
			$online = "N";
			$now = date('Y-m-d H:i:s');
			$now = strtotime($now);
			$last_time = strtotime($last_time);
			$diff = $now - $last_time;
			$diff = $diff / 60;
			if ($diff < 5) {
				$online = "Y";
				$summary_online++;
			}


			// $url = "https://api.mapbox.com/geocoding/v5/mapbox.places/$longitude,$latitude.json?access_token=pk.eyJ1Ijoia2hhbGlkaW5zYW4iLCJhIjoiY2t1eHRsYnJqMWp3YzJwcDZ4b2x1Njg5aiJ9.kd47yu7SHCwxHtwin8Qenw";
			// $location = json_decode(file_get_contents($url));
			// // print_r($location);die;
			// if(isset($location->features[0])){
			// $location = $location->features[0]->place_name;
			// print


			$markers[] = array('id' => $l->id_pegawai, 'name' => $l->nama_lengkap, 'foto' => base_url('data/foto/pegawai/' . $l->foto_pegawai), 'jabatan' => $l->jabatan, 'position' => ["lat" => $latitude, "long" => $longitude], 'tanggal' => tanggal($tanggal), 'waktu' => $waktu, 'online' => $online);
			// }
		}

		$summary = ['count' => $summary_count, 'online' => $summary_online];
		$res = ['markers' => $markers, 'summary' => $summary];

		echo json_encode($res);
	}

	public function index_old($summary_field = '', $summary_value = '')
	{

		if ($this->user_id) {

			$summary_value = urldecode($summary_value);
			$this->filter_arsip();
			$data['title']		= "Sijagur - Admin ";
			$data['content']	= "sijagur/index";
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "sijagur";

			$data['sirup'] = $this->db->join('ref_skpd', 'ref_skpd.id_skpd = sj_sirup.id_skpd', 'left')->get('sj_sirup')->result();

			$this->load->view('admin/index', $data);
		} else {
			redirect('admin');
		}
	}

	public function map_animation()
	{
		$this->load->view('admin/sijagur/map_animation');
	}

	public function detail($id_sirup)
	{
		if ($this->user_id) {
			if ($id_sirup == "") {
				redirect(base_url('sijagur/monitoring'));
				exit;
			}
			$data['title']		= "Sijagur - Admin ";
			$data['content']	= "sijagur/detail";
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "sijagur";

			$data['detail'] = $this->db->join('ref_skpd', 'ref_skpd.id_skpd = sj_sirup.id_skpd', 'left')->get_where('sj_sirup', array('id_sirup' => $id_sirup))->row();

			$this->load->view('admin/index', $data);
		} else {
			redirect('admin');
		}
	}

	public function get_sirup($id_sirup)
	{
		$url = 'https://sirup.lkpp.go.id/sirup/home/detailPaketPenyediaPublic2017/' . $id_sirup;
		$contents = file_get_contents($url);
		// $contents = "coba";
		echo $contents;
	}

	public function realisasi($id_surat_masuk = 185816)
	{
		if ($this->user_id) {
			if ($id_surat_masuk == "") {
				redirect(base_url('arsip_surat'));
				exit;
			}
			$this->filter_arsip($id_surat_masuk);
			$data['title']		= "Sijagur - Admin ";
			$data['content']	= "sijagur/realisasi";
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "sijagur";

			if (!empty($_POST)) {
				$data_update = $_POST;
				$data_update['status_arsip'] = 'Sudah Diarsipkan';
				$data_update['tgl_arsip'] = date('Y-m-d');
				// print_r($data_update);die;
				$update = $this->surat_masuk_model->update_surat_masuk($data_update, $id_surat_masuk);
				$data['message'] = "Surat telah berhasil diarsipkan";
				$data['type'] = "success";
			}
			$data['disposisi'] = $this->surat_masuk_model->get_disposisi_surat_masuk_by_id_surat($id_surat_masuk);
			$data['detail'] = $this->arsip_surat_model->get_detail_sm_by_id($id_surat_masuk);

			$this->load->view('admin/index', $data);
		} else {
			redirect('admin');
		}
	}



	public function surat_keluar()
	{

		if ($this->user_id) {
			$data['title']		= "Data Surat - Admin ";
			$data['content']	= "laporan_surat/surat_keluar";
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "laporan_surat";

			$data['surat_keluar'] = $this->laporan_surat_model->data_surat_keluar();

			$this->load->view('admin/index', $data);
		} else {
			redirect('admin');
		}
	}


	public function grafik_surat()
	{

		if ($this->user_id) {
			$data['title']		= "Grafik Surat - Admin ";
			$data['content']	= "laporan_surat/grafik_surat";
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "laporan_surat";

			$this->load->view('admin/index', $data);
		} else {
			redirect('admin');
		}
	}


	public function filter_arsip($id = '')
	{
		if ($id !== '') {
			$data['detail'] = $this->surat_masuk_model->get_detail_by_id($id);

			if (empty($data['detail'])) {
				show_404();
			}
		}
		if ($this->user_level !== "Administrator") {
			if (!in_array('tu_pimpinan', $this->user_privileges)) {
				show_404();
			}
		}
	}
}
