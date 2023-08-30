<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Rtangga_miskin extends CI_Controller {
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
		if ($this->level_id >2 ) redirect("admin");
    }
    
	public function detail()
	{
		if ($this->user_id)
		{
			$data['title']		= "Detail Rencana Strategis SKPD";
			$data['content']	= "rtangga_miskin/detail" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "rtangga_miskin";
			$this->load->view('admin/index',$data);
		}else{
			redirect('admin');
		}
	}
}