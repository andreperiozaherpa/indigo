<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Agenda_harian extends CI_Controller {
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

		// $this->load->model('agenda_harian_model','agenda_harian_m');
	}
	public function index()
	{
		if ($this->user_id)
		{
			$data['title']		= "agenda_harian - Admin ";
			$data['content']	= "agenda_harian/index" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "agenda_harian";

			// $data['item'] = $this->agenda_harian_m->get_all();
			$this->load->view('admin/index',$data);


		}
		else
		{
			redirect('admin');
		}
	}

	public function add(){
			$data['title']		= "Tambah agenda_harian - Admin ";
			$data['content']	= "agenda_harian/add" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "agenda_harian";

			// $data['item'] = $this->agenda_harian_m->get_all();
			$this->load->view('admin/index',$data);
	}

	public function view()
	{
		if ($this->user_id)
		{
			
			$data['title']		= "agenda_harian - Admin ";
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
	            redirect(base_url('agenda_harian'));
	        }

	        $data['item'] = $this->agenda_harian_m->select_by_id($id);
	        
	        if(empty($data['item'])){
	            redirect(base_url('agenda_harian'));
	        }

			$data['title']		= "agenda_harian - Admin ";
			$data['content']	= "agenda_harian/edit" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "agenda_harian";
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
	            redirect(base_url('agenda_harian'));
	        }
		$data = $this->input->post();
		$this->agenda_harian_m->update($data,$id);
		redirect(base_url('agenda_harian'));
	}

	public function delete($id)
	{
		if ($this->user_id)
		{
			$this->agenda_harian_m->id_agenda_harian = $id;
			$this->agenda_harian_m->delete();
		}
		else
		{
			redirect('home');
		}
	}
}
?>