<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ref_satuan extends CI_Controller {
	public $user_id;

	public function __construct(){
		parent ::__construct();	
		$this->user_id = $this->session->userdata('user_id');
		$this->load->model('user_model');
		$this->load->model('ref_satuan_model');
		$this->user_model->user_id = $this->user_id;
		$this->user_model->set_user_by_user_id();
		$this->user_picture = $this->user_model->user_picture;
		$this->full_name	= $this->user_model->full_name;
		$this->user_level	= $this->user_model->level;

		if (($this->user_level!="Administrator" && $this->user_level!="Admin Web") ) redirect ('welcome');
	}
	public function index()
	{		if ($this->user_id)
		{
			$data['title']		= "Ref. satuan Kegiatan - ". app_name;
			$data['content']	= "ref_satuan/index" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			
			$data['user_level']		= $this->user_level;
			$data['query']		= $this->ref_satuan_model->get_all();
			$data['active_menu'] = "ref_satuan";

			$this->load->model('ref_satuan_model');


			if (!empty($_POST)){
				$this->ref_satuan_model->satuan = $_POST['satuan'];
				$this->ref_satuan_model->keterangan = $_POST['keterangan'];
				$this->ref_instansi_model->status = $_POST['status'];
			}


			$data['satuan'] = $this->ref_satuan_model->get_all();

			$this->load->helper('form');
			$this->load->view('admin/index',$data);

		}
		else
		{
			redirect('admin');
		}
	}
	
	public function add()
	{
		if ($this->user_id)
		{
			$data['title']		= "Tambah Satuan Kegiatan - ". app_name;
			$data['content']	= "ref_satuan/add" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "ref_satuan";

			$this->load->model('ref_satuan_model');
			$data['koordinator'] = $this->ref_satuan_model->get_all();

			$this->load->helper('form');
			if (!empty($_POST))
			{

				
				$this->ref_satuan_model->satuan = $_POST['satuan'];
				$this->ref_satuan_model->keterangan = $_POST['keterangan'];
				$this->ref_satuan_model->status = $_POST['status'];
				$this->ref_satuan_model->insert();
				$data['message_type'] = "success";
				$data['message']		= "Satuan Kegiatan telah berhasil ditambahkan.";


			                 //logs
				$this->load->model('logs_model');
				$this->logs_model->user_id	 = $this->session->userdata('user_id');
				$this->logs_model->activity = "has been add satuan kegiatan";
				$this->logs_model->category = "add";
				$desc = $_POST['satuan'];
				$this->logs_model->description = "with names ".$desc;
				$this->logs_model->insert();
			}

			$this->load->view('admin/index',$data);

		}
		else
		{
			redirect('admin');
		}
	}

	public function edit($id_satuan)
	{
		if ($this->user_id)
		{
			
			$data['title']		= "Edit Satuan Kegiatan - ". app_name;
			$data['content']	= "ref_satuan/edit" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			
			$data['user_level']		= $this->user_level;
			
			$data['active_menu'] = "ref_satuan";

			$this->load->model('ref_satuan_model');
			$this->load->helper('form');
			if (!empty($_POST))
			{

				

				$this->ref_satuan_model->id_satuan = $id_satuan;
				$this->ref_satuan_model->satuan = $_POST['satuan'];
				$this->ref_satuan_model->keterangan = $_POST['keterangan'];
				$this->ref_satuan_model->status = $_POST['status'];	
				$this->ref_satuan_model->update();
				$data['message_type'] = "success";
				$data['message']		= "Satuan kegiatan telah berhasil diperbarui.";


			                 //logs
				$this->load->model('logs_model');
				$this->logs_model->user_id	 = $this->session->userdata('user_id');
				$this->logs_model->activity = "has been update instansi";
				$this->logs_model->category = "add";
				$desc = $_POST['satuan'];
				$this->logs_model->description = "with names ".$desc;
				$this->logs_model->insert();
			}

			$this->ref_satuan_model->id_satuan = $id_satuan;
			$get = $this->ref_satuan_model->get_by_id();
			$data['data'] = $get;
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
			
			$this->load->model('ref_satuan_model');
			$this->ref_satuan_model->id_satuan = $id;
			$this->ref_satuan_model->delete();
			redirect('ref_satuan');
		}
		else
		{
			redirect('home');
		}
	}
}
?>