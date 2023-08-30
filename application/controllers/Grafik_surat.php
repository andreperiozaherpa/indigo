<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Verifikasi extends CI_Controller {
	public $no_registrasi;
	public $id;

	public function __construct(){
		parent ::__construct();	
		$this->load->model('verifikasi_model');
		
	}

	public function index()
	{
		$data['title']		= "Verifikasi - Admin ";
			$data['content']	= "verifikasi/index" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "verifikasi";

			$this->load->view('admin/index',$data);
	}

	public function search(){
			$data['title']		= "Verifikasi - Admin ";
			$data['content']	= "verifikasi/result" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "verifikasi";

		$no_surat = $this->input->post("no_surat");
		$data['result'] = $this->verifikasi_model->search($no_surat);
		if(!empty($_POST)){
				$filter = $_POST;
				$data['filter'] = true;
				$data['filter_data'] = $_POST;
			}else{
				$filter = '';
				$data['filter'] = false;
			}
		$this->load->view('admin/index',$data);

	}

	}
