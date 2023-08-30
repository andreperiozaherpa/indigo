<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan_surat extends CI_Controller {

	public function __construct(){
		parent ::__construct();	
		$this->load->model('laporan_surat_model');
		
	}

	public function index()
	{
		$data['title']		= "Data Surat - Admin ";
			$data['content']	= "laporan_surat/index" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "laporan_surat";

			$this->load->view('admin/index',$data);
	}

	public function surat_masuk(){

		if ($this->user_id)
		{
			$data['title']		= "Data Surat - Admin ";
			$data['content']	= "laporan_surat/surat_masuk" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "laporan_surat";

			$data['surat_masuk'] = $this->laporan_surat_model->data_surat_masuk();

			$this->load->view('admin/index',$data);
		}
		else
		{
			redirect('admin');
		}
	}

	public function surat_keluar(){

		if ($this->user_id)
		{
			$data['title']		= "Data Surat - Admin ";
			$data['content']	= "laporan_surat/surat_keluar" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "laporan_surat";

			$data['surat_keluar'] = $this->laporan_surat_model->data_surat_keluar();

			$this->load->view('admin/index',$data);
		}
		else
		{
			redirect('admin');
		}
	}

		public function grafik_surat(){

		if ($this->user_id)
		{
			$data['title']		= "Data Surat - Admin ";
			$data['content']	= "laporan_surat/grafik_surat" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "laporan_surat";

			$this->load->view('admin/index',$data);
		}
		else
		{
			redirect('admin');
		}
	}

	}
