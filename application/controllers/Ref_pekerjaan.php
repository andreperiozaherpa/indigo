<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ref_pekerjaan extends CI_Controller {
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
			$data['title']		= "ref_pekerjaan - Admin ";
			$data['content']	= "ref_pekerjaan/index" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "ref_pekerjaan";

			if(!empty($_POST)){
				$this->ref_pekerjaan_m->nama_pekerjaan = $_POST['nama_pekerjaan'];
				$this->ref_pekerjaan_m->uraian = $_POST['uraian'];
			}
			$data['item'] = $this->ref_pekerjaan_m->get_all();

			$this->load->view('admin/index',$data);


		}
		else
		{
			redirect('admin');
		}
	}

	public function add(){
			$data['title']		= "Tambah ref_pekerjaan - Admin ";
			$data['content']	= "ref_pekerjaan/add" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "ref_pekerjaan";
			if(!empty($_POST)){
				$in = $this->ref_pekerjaan_m->insert($_POST);
				redirect('ref_pekerjaan');
			}

			$this->load->view('admin/index',$data);
	}

	public function view()
	{
		if ($this->user_id)
		{
			
			$data['title']		= "ref_pekerjaan - Admin ";
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
	            redirect(base_url('ref_pekerjaan'));
	        }

	        $data['item'] = $this->ref_pekerjaan_m->select_by_id($id);
	        
	        if(empty($data['item'])){
	            redirect(base_url('ref_pekerjaan'));
	        }

			if(!empty($_POST)){
				$in = $this->ref_pekerjaan_m->update($_POST,$id);
				redirect('ref_pekerjaan');
			}

			$data['title']		= "ref_pekerjaan - Admin ";
			$data['content']	= "ref_pekerjaan/edit" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "ref_pekerjaan";
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
	            redirect(base_url('ref_pekerjaan'));
	        }
		$data = $this->input->post();
		$this->ref_pekerjaan_m->update($data,$id);
		redirect(base_url('ref_pekerjaan'));
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