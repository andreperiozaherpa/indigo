<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Rekap_desa extends CI_Controller{
    
	public function __construct()
	{
		parent::__construct();
		$this->user_id = $this->session->userdata('user_id');
		$this->load->model('user_model');
		$this->user_model->user_id = $this->user_id;
		$this->user_model->set_user_by_user_id();
		$this->id_skpd = $this->user_model->kd_skpd;
		$this->load->model('laporan_surat_model');
		$this->load->model('ref_skpd_model');
		$this->load->model('surat_masuk_model', 'smm');
		$this->load->model('surat_keluar_model', 'skm');
	}

	public function sdgs()
	{
		$data['title']		= "Rekap SDGs Desa";
		$data['content']	= "rekap_desa/sdgs";
		$data['user_picture'] = $this->user_picture;
		$data['full_name']		= $this->full_name;
		$data['user_level']		= $this->user_level;
		$data['active_menu'] = "rekap_desa/sdgs";


        $data['kecamatan'] = $this->db->get_where('ref_skpd', array('jenis_skpd' => 'kecamatan'))->result();
		$data['id_kecamatan'] = isset($_GET['id_kecamatan']) ? $_GET['id_kecamatan'] : null;
		$id_skpd = $this->session->userdata('id_skpd');
		$detail = $this->ref_skpd_model->get_by_id($id_skpd);
		if($detail && $detail->jenis_skpd == 'kecamatan'){
			$data['id_kecamatan'] = $id_skpd;
		}
		$this->load->view('admin/index', $data);
	}
	public function detail_sdgs($id_desa)
	{
		$data['title']		= "Detail SDGs Desa";
		$data['content']	= "rekap_desa/detail_sdgs";
		$data['user_picture'] = $this->user_picture;
		$data['full_name']		= $this->full_name;
		$data['user_level']		= $this->user_level;
		$data['active_menu'] = "rekap_desa/sdgs";
		$data['id_desa'] = $id_desa;
		$this->load->view('admin/index', $data);
	}
	public function surat()
	{
		$data['title']		= "Rekap Surat Desa";
		$data['content']	= "rekap_desa/surat";
		$data['user_picture'] = $this->user_picture;
		$data['full_name']		= $this->full_name;
		$data['user_level']		= $this->user_level;
		$data['active_menu'] = "rekap_desa/surat";
        $data['kecamatan'] = $this->db->get_where('ref_skpd', array('jenis_skpd' => 'kecamatan'))->result();
        $data['id_kecamatan'] = isset($_GET['id_kecamatan']) ? $_GET['id_kecamatan'] : null;
		$this->load->view('admin/index', $data);
	}
}