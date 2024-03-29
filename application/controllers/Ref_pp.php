<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ref_pp extends CI_Controller {
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

		$this->load->model('ref_pp_model','pp_m');
	}
	public function index()
	{
		if ($this->user_id)
		{
			$data['title']		= "Peraturan Pemerintah - Admin ";
			$data['content']	= "ref_pp/index" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "ref_pp";

			$data['item'] = $this->pp_m->get_all();
			$this->load->view('admin/index',$data);


		}
		else
		{
			redirect('admin');
		}
	}

	public function add(){
		$data = $this->input->post();
		$this->pp_m->insert($data);
		redirect(base_url('ref_pp'));
	}

	public function view()
	{
		if ($this->user_id)
		{
			
			$data['title']		= "Peraturan Pemerintah - Admin ";
			$data['content']	= "ref_pp/view" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "ref_pp";
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
	            redirect(base_url('ref_pp'));
	        }

	        $data['item'] = $this->pp_m->select_by_id($id);
	        
	        if(empty($data['item'])){
	            redirect(base_url('ref_pp'));
	        }

			$data['title']		= "Peraturan Pemerintah - Admin ";
			$data['content']	= "ref_pp/edit" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "ref_pp";
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
	            redirect(base_url('ref_pp'));
	        }
		$data = $this->input->post();
		$this->pp_m->update($data,$id);
		redirect(base_url('ref_pp'));
	}

	public function delete($id)
	{
		if ($this->user_id)
		{
			$this->load->model('ref_pp_model');
			$this->ref_pp_model->id_pp = $id;
			$this->ref_pp_model->delete();
			$data['message_type'] = "success";
			$data['message']	= "Record Ref pp berhasil dihapus.";
		
			redirect('ref_pp');
			
		}
		else
		{
			redirect('home');
		}
	}
}
?>