<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengajuan_absensi extends CI_Controller {
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

		// $this->load->model('pengajuan_absensi_model','pengajuan_absensi_m');
	}
	public function index()
	{
		if ($this->user_id)
		{
			$data['title']		= "pengajuan_absensi - Admin ";
			$data['content']	= "pengajuan_absensi/index" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "pengajuan_absensi";

			// $data['item'] = $this->pengajuan_absensi_m->get_all();
			$this->load->view('admin/index',$data);


		}
		else
		{
			redirect('admin');
		}
	}

	public function add(){
			$data['title']		= "Tambah pengajuan_absensi - Admin ";
			$data['content']	= "pengajuan_absensi/add" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "pengajuan_absensi";

			// $data['item'] = $this->pengajuan_absensi_m->get_all();
			$this->load->view('admin/index',$data);
	}

	public function view()
	{
		if ($this->user_id)
		{
			
			$data['title']		= "View pengajuan_absensi - Admin ";
			$data['content']	= "pengajuan_absensi/view" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "pengajuan_absensi";
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
	            redirect(base_url('pengajuan_absensi'));
	        }

	        $data['item'] = $this->pengajuan_absensi_m->select_by_id($id);
	        
	        if(empty($data['item'])){
	            redirect(base_url('pengajuan_absensi'));
	        }

			$data['title']		= "pengajuan_absensi - Admin ";
			$data['content']	= "pengajuan_absensi/edit" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "pengajuan_absensi";
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
	            redirect(base_url('pengajuan_absensi'));
	        }
		$data = $this->input->post();
		$this->pengajuan_absensi_m->update($data,$id);
		redirect(base_url('pengajuan_absensi'));
	}

	public function delete($id)
	{
		if ($this->user_id)
		{
			$this->pengajuan_absensi_m->id_pengajuan_absensi = $id;
			$this->pengajuan_absensi_m->delete();
		}
		else
		{
			redirect('home');
		}
	}
}
?>