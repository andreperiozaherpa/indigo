<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Verifikasi extends CI_Controller {
	public $no_registrasi;
	public $id;

	public function __construct(){
		parent ::__construct();	
		$this->load->model('verifikasi_model');
		$this->load->model('surat_keluar_model');
		$this->load->helper('form');
		
	}

	public function index()
	{
		$data['title']		= "Verifikasi - Admin ";
		$data['content']	= "verifikasi/index" ;
		$data['user_picture'] = $this->user_picture;
		$data['full_name']		= $this->full_name;
		$data['user_level']		= $this->user_level;
		$data['active_menu'] = "verifikasi";
		$data['type'] = 'no';
		if(isset($_POST['no_surat'])){
			$data['detail'] = $this->verifikasi_model->get_by_no_surat($_POST['no_surat']);
			if(empty($data['detail'])){
				$data['detail'] = false;
			}else{
				$data['penerima'] = $this->surat_keluar_model->get_penerima($data['detail']->id_surat_keluar);
			}
		}

		$this->load->view('admin/index',$data);
	}

	public function id($hash_id)
	{
		$data['title']		= "Verifikasi - Admin ";
		$data['content']	= "verifikasi/index" ;
		$data['user_picture'] = $this->user_picture;
		$data['full_name']		= $this->full_name;
		$data['user_level']		= $this->user_level;
		$data['active_menu'] = "verifikasi";
		$data['type'] = 'hash';

		if(!empty($hash_id)){
			$data['detail'] = $this->verifikasi_model->get_by_hash_id($hash_id);
			if(empty($data['detail'])){
				$data['detail'] = false;
			}else{
				$data['penerima'] = $this->surat_keluar_model->get_penerima($data['detail']->id_surat_keluar);
			}
		}

		$this->load->view('admin/index',$data);
	}

}
