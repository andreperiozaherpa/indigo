<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ref_penggunaan extends CI_Controller {
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
		$this->user_privileges	= $this->user_model->user_privileges;
		if ($this->user_level=="Admin Web"); 

		$this->load->model('ref_penggunaan_model','penggunaan_m');
		
		if (!$this->user_id OR ($this->session->userdata('user_level') != 1 && !in_array('referensi_umum', $this->user_privileges))) {
			redirect('admin/login');
		}
	}
	public function index()
	{
		if ($this->user_id)
		{
			$data['title']		= "Ref. penggunaan- Admin ";
			$data['content']	= "ref_penggunaan/index" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "ref_penggunaan";

			$data['item'] = $this->penggunaan_m->get_all();
			$this->load->view('admin/index',$data);


		}
		else
		{
			redirect('admin');
		}
	}

	public function add(){
		$data = $this->input->post();
		$this->penggunaan_m->insert($data);
		redirect(base_url('ref_penggunaan'));
	}

	public function view()
	{
		if ($this->user_id)
		{
			
			$data['title']		= "Ref penggunaan - Admin ";
			$data['content']	= "ref_penggunaan/view" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "ref_penggunaan";
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
	            redirect(base_url('ref_penggunaan'));
	        }
	        $this->load->model('ref_penggunaan_model');
	        $data['item'] = $this->ref_penggunaan_model->select_by_id($id);
	        
	        if(empty($data['item'])){
	            redirect(base_url('ref_penggunaan'));
	        }

			$data['title']		= "ref penggunaan - Admin ";
			$data['content']	= "ref_penggunaan/edit" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "ref_penggunaan";
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
	            redirect(base_url('ref_penggunaan'));
	        }
		$data = $this->input->post();
		$this->penggunaan_m->update($data,$id);
		redirect(base_url('ref_penggunaan'));
	}


	public function delete($id)
	{
		if ($this->user_id)
		{
			$this->load->model('ref_penggunaan_model');
			$this->ref_penggunaan_model->id_penggunaan = $id;
			$this->ref_penggunaan_model->delete();
			$data['message_type'] = "success";
			$data['message']	= "Record Ref penggunaan  berhasil dihapus.";
		
			redirect('ref_penggunaan');
			
		}
		else
		{
			redirect('home');
		}
	}
}
?>