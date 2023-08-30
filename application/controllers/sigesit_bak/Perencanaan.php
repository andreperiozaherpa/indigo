<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Perencanaan extends CI_Controller
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
		$array_privileges = explode(';', $this->user_privileges);


		if (($this->user_level != "Administrator" && $this->user_level != "Admin Web") && !in_array('event', $array_privileges)) redirect('welcome');
	}


	public function index()
	{
		if ($this->user_id) {

			$data['title']		= "sigesit - " . app_name;
			$data['content']	= "sigesit/perencanaan/index";
			$data['active_menu'] = "sigesit";
            $data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
            
			$this->load->view('admin/index', $data);
		} else {
			redirect('admin');
		}
	}


	public function detail_skpd()
	{
		if ($this->user_id) {

			$data['title']		= "sigesit - " . app_name;
			$data['content']	= "sigesit/perencanaan/detail_skpd";
			$data['active_menu'] = "sigesit";
            $data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
            
			$this->load->view('admin/index', $data);
		} else {
			redirect('admin');
		}
	}

	public function tambah()
	{
		if ($this->user_id) {

			$data['title']		= "sigesit - " . app_name;
			$data['content']	= "sigesit/perencanaan/tambah";
			$data['active_menu'] = "sigesit";
            $data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
            
			$this->load->view('admin/index', $data);
		} else {
			redirect('admin');
		}
	}

	public function detail_perencanaan()
	{
		if ($this->user_id) {

			$data['title']		= "sigesit - " . app_name;
			$data['content']	= "sigesit/perencanaan/detail_perencanaan";
			$data['active_menu'] = "sigesit";
            $data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
            
			$this->load->view('admin/index', $data);
		} else {
			redirect('admin');
		}
	}




}