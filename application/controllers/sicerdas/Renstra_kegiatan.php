<?php
defined('BASEPATH') or exit('No direct script access allowed');

class renstra_kegiatan extends CI_Controller
{
	public $user_id;

	public function __construct()
	{
		parent::__construct();
		$this->user_id = $this->session->userdata('user_id');

		$this->user_model->user_id = $this->user_id;
		$this->user_model->set_user_by_user_id();
		
		$this->user_picture = $this->user_model->user_picture;
		$this->full_name	= $this->user_model->full_name;
		$this->user_level	= $this->user_model->level;
		$this->user_privileges	= $this->user_model->user_privileges;
		$this->array_privileges = explode(';', $this->user_privileges);


		if (($this->user_level != "Administrator" && $this->user_level != "Admin Web") && !in_array('event', $this->array_privileges)) redirect('welcome');
	}


	public function index()
	{
		if ($this->user_id) {

			$data['title']		= "sicerdas - " . app_name;
			$data['content']	= "sicerdas/renstra/kegiatan/index";
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;

			$data['active_menu'] = "renstra_kegiatan";
			$this->load->view('admin/index', $data);
		} else {
			redirect('admin');
		}
	}

	public function detail()
	{
		if ($this->user_id) {

			$data['title']		= "sicerdas - " . app_name;
			$data['content']	= "sicerdas/renstra/kegiatan/detail";
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;

			$data['active_menu'] = "renstra_kegiatan";
			$this->load->view('admin/index', $data);
		} else {
			redirect('admin');
		}
	}


	public function detail_kegiatan()
	{
		if ($this->user_id) {

			$data['title']		= "sicerdas - " . app_name;
			$data['content']	= "sicerdas/renstra/kegiatan/detail_kegiatan";
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;

			$data['active_menu'] = "renstra_kegiatan";
			$this->load->view('admin/index', $data);
		} else {
			redirect('admin');
		}
	}



}