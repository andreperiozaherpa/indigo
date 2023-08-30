<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ref_hari_libur extends CI_Controller {
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

		$this->load->model('ref_hari_libur_model','ref_hari_libur_m');
	}
	public function index()
	{
		if ($this->user_id)
		{
			$data['title']		= "ref_hari_libur - Admin ";
			$data['content']	= "ref_hari_libur/index" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "ref_hari_libur";

			if(!empty($_POST)){
				$this->ref_hari_libur_m->tanggal_awal = $_POST['tanggal_awal'];
				$this->ref_hari_libur_m->tanggal_akhir = $_POST['tanggal_akhir'];
				$this->ref_hari_libur_m->keterangan = $_POST['keterangan'];
			}

			$data['item'] = $this->ref_hari_libur_m->get_all();
			$this->load->view('admin/index',$data);


		}
		else
		{
			redirect('admin');
		}
	}

	public function add(){
			$data['title']		= "Tambah ref_hari_libur - Admin ";
			$data['content']	= "ref_hari_libur/add" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "ref_hari_libur";

			if(!empty($_POST)){
				$in = $this->ref_hari_libur_m->insert($_POST);
				redirect('ref_hari_libur');
			}

			$this->load->view('admin/index',$data);
	}

	public function edit()
	{
		if ($this->user_id)
		{
			$id = $this->uri->segment(3);
	        if(empty($id)){
	            redirect(base_url('ref_hari_libur'));
	        }

	        $data['item'] = $this->ref_hari_libur_m->select_by_id($id);
	        
	        if(empty($data['item'])){
	            redirect(base_url('ref_hari_libur'));
	        }

			if(!empty($_POST)){
				$in = $this->ref_hari_libur_m->update($_POST,$id);
				redirect('ref_hari_libur');
			}

			$data['title']		= "Edit ref_hari_libur - Admin ";
			$data['content']	= "ref_hari_libur/edit" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "ref_hari_libur";
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
			$this->ref_hari_libur_m->delete($id);
		}
		else
		{
			redirect('home');
		}
	}
}
?>