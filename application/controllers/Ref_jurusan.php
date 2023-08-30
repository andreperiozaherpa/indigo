<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ref_jurusan extends CI_Controller {
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

		$this->load->model('ref_jurusan_model','jurusan_m');
		
		$this->level_id	= $this->user_model->level_id;
		if ($this->level_id >2 ) redirect("admin");
	}
	public function index()
	{
		if ($this->user_id)
		{
			$data['title']		= "jurusan - Admin ";
			$data['content']	= "ref_jurusan/index" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "ref_jurusan";

			$offset = 0;
			$limit = $data['per_page']	= 30;
			if (!empty($_GET['per_page'])) $offset = $_GET['per_page'] ;
			$data['result'] = $this->jurusan_m->get_for_page($limit,$offset);
			$data['all_result'] = $this->jurusan_m->get_for_page();
			
			$data['total_rows']	= count($data['all_result']);
			$data['offset']	= $offset;
			
			$this->load->view('admin/index',$data);


		}
		else
		{
			redirect('admin');
		}
	}

	public function add(){
		$data = $this->input->post();
		$this->jurusan_m->insert($data);
		redirect(base_url('ref_jurusan'));
	}

	public function view()
	{
		if ($this->user_id)
		{
			
			$data['title']		= "jurusan - Admin ";
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
	            redirect(base_url('ref_jurusan'));
	        }

	        $data['item'] = $this->jurusan_m->select_by_id($id);
	        
	        if(empty($data['item'])){
	            redirect(base_url('ref_jurusan'));
	        }

			$data['title']		= "jurusan - Admin ";
			$data['content']	= "ref_jurusan/edit" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "ref_jurusan";
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
	            redirect(base_url('ref_jurusan'));
	        }
		$data = $this->input->post();
		$this->jurusan_m->update($data,$id);
		redirect(base_url('ref_jurusan'));
	}

	public function delete($id)
	{
		if ($this->user_id)
		{
			$this->load->model('ref_jurusan_model');
			$this->ref_jurusan_model->id_jurusan = $id;
			$this->ref_jurusan_model->delete();
			
		}
		else
		{
			redirect('home');
		}
	}
}
?>