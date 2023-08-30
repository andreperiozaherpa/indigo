<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Download extends CI_Controller {
	public $user_id;

	public function __construct(){
		parent ::__construct();	
		$this->user_id = $this->session->userdata('user_id');
		$this->user_level = $this->session->userdata('user_level');
		$this->load->model('tahu/visitor_model');
		$this->visitor_model->cek_visitor();
		
		$this->load->model('company_profile_model');

		$this->company_profile_model->set_identity();
	}

	public function index()
	{
		$data['title'] = "Download - " .$this->company_profile_model->nama;
		$data['active_menu'] ="download";
		$this->load->model('tahu/download_model');
		$data['download'] = $this->download_model->get_all();
		$this->load->view('blog/download',$data);
	}
	
}
?>