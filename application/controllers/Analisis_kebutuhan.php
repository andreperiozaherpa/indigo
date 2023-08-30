<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Analisis_kebutuhan extends CI_Controller {
	public $user_id;
	public function __construct(){
		parent ::__construct();
		$this->user_id = $this->session->userdata('user_id');
		$this->load->model('user_model');
		$this->load->model('master_pegawai_model');
		$this->load->model('verifikasi_data_pegawai_model');
		$this->load->model('ref_skpd_model');
		$this->load->model('dashboard_model', 'dm');
		$this->load->model('kegiatan_model', 'km');
		$this->load->model('kegiatan_personal_model', 'kpm');
		$this->load->model('realisasi_kegiatan_model', 'rkm');
		$this->load->model('pegawai_model');
		$this->user_model->user_id = $this->user_id;
		$this->user_model->set_user_by_user_id();
		$this->id_pegawai	= $this->user_model->id_pegawai;
		$this->user_picture = $this->user_model->user_picture;
		$this->full_name	= $this->user_model->full_name;
		$this->user_level	= $this->user_model->level;
		$this->foto_pegawai = $this->user_model->foto_pegawai;
		$this->level_id	= $this->user_model->level_id;
	}

	public function index($summary_field='',$summary_value='')
	{
		if ($this->user_id)
		{

			$data['title']		= "Analisis Kebutuhan - Admin ";
			$data['content']	= "analisis_kebutuhan/index" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu']		= 'data_assement';

			$this->load->view('admin/index',$data);


		}
		else
		{
			redirect('admin');
		}
	}

	public function tambah()
	{
		if ($this->user_id)
		{
			$data['title']		= "Details User";
			$data['content']	= "data_assement/add" ;
			$data['user_picture'] = $this->user_picture;
			$data['foto_pegawai'] = $this->foto_pegawai;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['user_id'] = $this->id_pegawai;
			$data['active_menu'] = "analisis_kebutuhan";


			$this->load->view('admin/index',$data);

		}
		else
		{
			redirect('admin');
		}
	}


	public function add()
	{
		if ($this->user_id)
		{
			$data['title']		= "Tambah Analisis Kebutuhan";
			$data['content']	= "analisis_kebutuhan/add" ;
			$data['user_picture'] = $this->user_picture;
			$data['foto_pegawai'] = $this->foto_pegawai;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['user_id'] = $this->id_pegawai;
			$data['active_menu'] = "analisis_kebutuhan";


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
			$data['title']		= "Detail Analisis Kebutuhan";
			$data['content']	= "analisis_kebutuhan/detail" ;
			$data['user_picture'] = $this->user_picture;
			$data['foto_pegawai'] = $this->foto_pegawai;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['user_id'] = $this->id_pegawai;
			$data['active_menu'] = "analisis_kebutuhan";


			$this->load->view('admin/index',$data);

		}
		else
		{
			redirect('admin');
		}
	}

}
?>
