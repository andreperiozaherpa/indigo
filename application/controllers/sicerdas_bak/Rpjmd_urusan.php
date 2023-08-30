<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Rpjmd_urusan extends CI_Controller
{
	public $user_id;

	public function __construct()
	{
		parent::__construct();
		$this->user_id = $this->session->userdata('user_id');

		$this->user_model->user_id = $this->user_id;
		$this->user_model->set_user_by_user_id();

		$this->load->model('sicerdas/sc_urusan_model');
		
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

			$data['title']		= "sicerdas - " . app_name;
			$data['content']	= "sicerdas/rpjmd/urusan/index";
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;


			$hal = 20;
			$page = isset($_GET["page"]) ? (int)$_GET["page"] : 1;
			$mulai = ($page > 1) ? ($page * $hal) - $hal : 0;
			$total = count($this->sc_urusan_model->get_all());
			$data['pages'] = ceil($total / $hal);
			$data['current'] = $page;
			if (!empty($_POST)) {
				$filter = $_POST;
				$data['filter'] = true;
				$data['filter_data'] = $_POST;
			} else {
				$filter = '';
				$data['filter'] = false;
			}

			$data['list'] = $this->sc_urusan_model->get_page($mulai, $hal, $filter);

			$data['active_menu'] = "rpjmd_urusan";
			$this->load->view('admin/index', $data);
		} else {
			redirect('admin');
		}
	}

	public function detail()
	{
		if ($this->user_id) {

			$data['title']		= "sicerdas - " . app_name;
			$data['content']	= "sicerdas/rpjmd/urusan/detail";
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;

			$data['active_menu'] = "rpjmd_urusan";
			$this->load->view('admin/index', $data);
		} else {
			redirect('admin');
		}
	}


}