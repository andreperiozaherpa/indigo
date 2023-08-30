<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengaduan extends CI_Controller {
	public $user_id;

	public function __construct(){
		parent ::__construct();	
		$this->user_id = $this->session->userdata('user_id');
		$this->user_level = $this->session->userdata('user_level');
		$this->load->model('visitor_model');
		$this->visitor_model->cek_visitor();
		
		$this->load->model('company_profile_model');

		$this->company_profile_model->set_identity();
	}

	public function index()
	{
		
		$data['title'] = "Pengaduan - " .$this->company_profile_model->nama;
		$data['active_menu'] ="layanan";
		$this->load->model('download_model');
		$data['download'] = $this->download_model->get_all();
		//banner
		$this->load->model('banner_model');
		$data['banner'] = $this->banner_model->get_all();
		$this->load->model('agenda_model');
		if (!empty($_POST)){
			if ($_POST['tema'] !="") $this->agenda_model->tema = $_POST['tema'];
		}
		$data['agenda'] = $this->agenda_model->get_all();
		
		$this->load->view('blog/src/header',$data);
		$this->load->view('blog/src/top_nav',$data);
		$this->load->view('blog/pengaduan',$data);
		$this->load->view('blog/src/footer',$data);
	}
	
}
?>