<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Verifikasi_surat extends CI_Controller {
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

		$this->load->view('blog/src/header',$data);
		$this->load->view('blog/src/top_nav',$data);
		$this->load->view('blog/verifikasi_surat',$data);
		$this->load->view('blog/src/footer',$data);
	}

	public function id($hash_id='')
	{
		$data['title']		= "Verifikasi - Admin ";
		$data['content']	= "verifikasi/index" ;
		$data['active_menu'] = "verifikasi";

		if(!empty($hash_id)){

			if($hash_id=="not_found"){
				$data['type'] = "not_found";
			}else{
				$data['type'] = 'hash';
				$data['detail'] = $this->verifikasi_model->get_by_hash_id($hash_id);
				if(empty($data['detail'])){
					$data['detail'] = false;
				}else{
					$data['penerima'] = $this->surat_keluar_model->get_penerima($data['detail']->id_surat_keluar);
				}
			}

			$this->load->view('blog/src/header',$data);
			$this->load->view('blog/src/top_nav',$data);
			$this->load->view('blog/verifikasi_surat',$data);
			$this->load->view('blog/src/footer',$data);
		}else{
			redirect(base_url());
		}
	}

}
