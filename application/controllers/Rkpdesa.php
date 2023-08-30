<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Rkpdesa extends CI_Controller {
	public $user_id;

	public function __construct(){
		parent ::__construct();
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

		$this->level_id	= $this->user_model->level_id;
		
		$this->sasaran = array(
			array('nama_sasaran'=>'Menurunnya Jumlah Rumah Tangga Miskin','indikator'=>array(array('nama_indikator'=>'Jumlah Rumah Tangga Miskin (Desil 1 dan Desil 2)','satuan'=>'KK'))),
			array('nama_sasaran'=>'Meningkatnya pencegahan Stunting Terintegrasi','indikator'=>array(array('nama_indikator'=>'Cakupan layanan konvergensi stunting ','satuan'=>'%'))),
			array('nama_sasaran'=>'Meningkatnya kualitas pelayanan publik di Desa','indikator'=>array(array('nama_indikator'=>'Indeks Kepuasan Masyarakat','satuan'=>'Point')))
		);

		$this->kegiatan = array(array('nama_kegiatan'=>'Kegiatan 1','anggaran'=>(rand(1,5)*1000000)),array('nama_kegiatan'=>'Kegiatan 2','anggaran'=>(rand(1,5)*1000000)),array('nama_kegiatan'=>'Kegiatan 3','anggaran'=>(rand(1,5)*1000000)));

		$this->bidang = array(
			array('nama_bidang'=>'Pelaksanaan Pembangunan Desa','sub_bidang'=>array(array('nama_sub_bidang'=>'Sub Bidang 1','kegiatan'=>$this->kegiatan))),
			array('nama_bidang'=>'Pembinaan Kemasyarakatan ','sub_bidang'=>array(array('nama_sub_bidang'=>'Sub Bidang 2','kegiatan'=>$this->kegiatan))),
			array('nama_bidang'=>'Pemberdayaan Masyarakat ','sub_bidang'=>array(array('nama_sub_bidang'=>'Sub Bidang 3','kegiatan'=>$this->kegiatan))),
		);

		if ($this->level_id >2 ) redirect("admin");
    }
    
	public function index()
	{
		if ($this->user_id)
		{
			$data['title']		= "Detail Rencana Strategis SKPD";
			$data['content']	= "rkpdesa/index" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "rkpdesa";
			$this->load->model('ref_skpd_model');
			$hal = 6;
			$page = isset($_GET["page"]) ? (int)$_GET["page"] : 1;
			$mulai = ($page>1) ? ($page * $hal) - $hal : 0;
			$total = count($this->ref_skpd_model->get_all('desa'));
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
			$data['list'] = $this->ref_skpd_model->get_page($mulai,$hal,$filter,'desa');

			$this->load->view('admin/index',$data);
		}
		else
		{
			redirect('admin');
		}
	}
    
	public function detail()
	{
		if ($this->user_id)
		{
			$data['title']		= "Detail Rencana Strategis SKPD";
			$data['content']	= "rkpdesa/detail" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "rkpdesa";
			$this->load->view('admin/index',$data);
		}
		else
		{
			redirect('admin');
		}
	}
	public function detail_tahun()
	{
		if ($this->user_id)
		{
			$data['title']		= "Detail Rencana Strategis SKPD";
			$data['content']	= "rkpdesa/detail_tahun" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "rkpdesa";
			$data['sasaran'] = json_decode(json_encode($this->sasaran));
			$data['bidang'] = json_decode(json_encode($this->bidang));
			$this->load->view('admin/index',$data);
		}
		else
		{
			redirect('admin');
		}
	}
	public function detail_kegiatan()
	{
		if ($this->user_id)
		{
			$data['title']		= "Detail Rencana Strategis SKPD";
			$data['content']	= "rkpdesa/detail_kegiatan" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "rkpdesa";
			$data['kegiatan'] = json_decode(json_encode($this->kegiatan));
			$this->load->view('admin/index',$data);
		}
		else
		{
			redirect('admin');
		}
	}
}