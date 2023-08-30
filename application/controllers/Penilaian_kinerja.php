<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penilaian_kinerja extends CI_Controller {
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
		if ($this->user_level=="Admin Web"); 

		$this->load->model('ref_pekerjaan_model','ref_pekerjaan_m');
	}
	public function index()
	{
		if ($this->user_id)
		{
			$data['title']		= "Penilaian Kinerja - Admin ";
			$data['content']	= "penilaian_kinerja/index" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "penilaian_kinerja";

			$this->load->view('admin/index',$data);

		}
		else
		{
			redirect('admin');
		}
	}

	

	public function view()
	{
		if ($this->user_id)
		{
			
			$data['title']		= "Penilaian Kinerja- Admin ";
			$data['content']	= "penilaian_kinerja/view" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "penilaian_kinerja";
			$this->load->view('admin/index',$data);

		}
		else
		{
			redirect('admin');
		}
	}

	
	
	public function delete($id)
	{
		if ($this->user_id)
		{
			$this->ref_pekerjaan_m->delete($id);
		}
		else
		{
			redirect('home');
		}
	}
}
?>