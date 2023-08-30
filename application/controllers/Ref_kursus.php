<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ref_kursus extends CI_Controller {
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

		$this->load->model('ref_kursus_model','kursus_m');
		
		$this->level_id	= $this->user_model->level_id;
		if ($this->level_id >2 ) redirect("admin");
	}
	public function index()
	{
		if ($this->user_id)
		{
			$data['title']		= "kursus - Admin ";
			$data['content']	= "ref_kursus/index" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "ref_kursus";

			$data['item'] = $this->kursus_m->get_all();
			$this->load->view('admin/index',$data);


		}
		else
		{
			redirect('admin');
		}
	}

	public function add(){
		$data = $this->input->post();
		$this->kursus_m->insert($data);
		redirect(base_url('ref_kursus'));
	}

	public function view()
	{
		if ($this->user_id)
		{
			
			$data['title']		= "kursus - Admin ";
			$data['content']	= "ref_pendidikan/view" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "ref_pendidikan";
			$this->load->view('admin/index',$data);

		}
		else
		{
			redirect('admin');
		}
	}

	public function edit()
	{
		if ($this->user_id)
		{
			$id = $this->uri->segment(3);
	        if(empty($id)){
	            redirect(base_url('ref_kursus'));
	        }

	        $data['item'] = $this->kursus_m->select_by_id($id);
	        
	        if(empty($data['item'])){
	            redirect(base_url('ref_kursus'));
	        }

			$data['title']		= "kursus - Admin ";
			$data['content']	= "ref_kursus/edit" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "ref_kursus";
			$this->load->view('admin/index',$data);

		}
		else
		{
			redirect('admin');
		}
	}

	public function update(){
		$id = $this->uri->segment(3);
		if(empty($id)){
	            redirect(base_url('ref_kursus'));
	        }
		$data = $this->input->post();
		$this->kursus_m->update($data,$id);
		redirect(base_url('ref_kursus'));
	}

	public function delete($id)
	{
		if ($this->user_id)
		{
			$this->kursus_m->id_kursus = $id;
			$this->kursus_m->delete();
		}
		else
		{
			redirect('home');
		}
	}
}
?>