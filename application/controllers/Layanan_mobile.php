<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Layanan_mobile extends CI_Controller {
	public $user_id;

	public function __construct(){
		parent ::__construct();	
		$this->user_id = $this->session->userdata('user_id');
		$this->load->model('user_model');
		$this->load->model('realisasi_kegiatan_kl_model');
		$this->load->model('ref_instansi_model');
		$this->user_model->user_id = $this->user_id;
		$this->user_model->set_user_by_user_id();
		$this->user_picture = $this->user_model->user_picture;
		$this->full_name	= $this->user_model->full_name;
		$this->user_level	= $this->user_model->level;

		$this->user_privileges	= $this->user_model->user_privileges;
		$array_privileges = explode(';', $this->user_privileges);

		// if (($this->user_level!="Administrator" && $this->user_level!="User" && $this->user_level!="Departement") && !in_array('mn_informasi', $array_privileges)) redirect ('welcome');
	}
	public function index()
	{
		if ($this->user_id)
		{
			$data['title']		= "Layanan Mobile - ". app_name;
			$data['content']	= "layanan_mobile/index" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "layanan_mobile";

			$data['data'] = $this->realisasi_kegiatan_kl_model->get_informasi();

			$this->load->view('admin/index',$data);

		}
		else
		{
			redirect('admin');
		}
	}
}
?>