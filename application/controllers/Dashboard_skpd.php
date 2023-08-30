<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_skpd extends CI_Controller {
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
	}

	public function index()
	{
		if ($this->user_id)
		{
			$data['title']		= "Dashboard SKPD";
			$data['content']	= "dashboard_skpd/index" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "dashboard_skpd";
			$this->load->view('admin/index',$data);

		}
		else
		{
			redirect('admin');
		}
	}

}
?>
