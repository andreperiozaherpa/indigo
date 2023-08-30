<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manage_category_download extends CI_Controller {
	public $user_id;

	public function __construct(){
		parent ::__construct();	
		$this->user_id = $this->session->userdata('user_id');
		$this->load->model('category_download_model');
		$this->load->model('user_model');
		$this->user_model->user_id = $this->user_id;
		$this->user_model->set_user_by_user_id();
		$this->user_picture = $this->user_model->user_picture;
		$this->full_name	= $this->user_model->full_name;
		$this->user_level	= $this->user_model->level;

		$this->user_privileges	= $this->user_model->user_privileges;
		$array_privileges = explode(';', $this->user_privileges);


		// if (($this->user_level!="Administrator" && $this->user_level!="Admin Web") && !in_array('blog_category_download', $array_privileges)) redirect ('welcome');
	}
	public function index()
	{
		if ($this->user_id)
		{
			$data['title']		= "Kategori E-Modul - ". app_name;
			$data['content']	= "category_download/index" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			
			$data['query']		= $this->category_download_model->get_all();
			$data['active_menu'] = "category_download";
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
			
			$data['title']		= "Tambah Kategori E-Modul - ". app_name;
			$data['content']	= "category_download/add" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			
			$data['active_menu'] = "category_download";
			if (!empty($_POST))
			{
				if ($_POST['category_download_name'] !="" &&
					$_POST['category_download_status'] !="" )
				{
					$avaliable = $this->category_download_model->check_availability("",$_POST['category_download_name']);
					if ($avaliable){
		                $this->category_download_model->category_name = $_POST['category_download_name'];
		                $this->category_download_model->category_status = $_POST['category_download_status'];
		                $this->category_download_model->insert();
		                $data['message_type'] = "success";
		                $data['message']		= "Kategori E-Modul berhasi ditambahkan.";

		                 //logs
						$this->load->model('logs_model');
						$this->logs_model->user_id	 = $this->session->userdata('user_id');
	                	$this->logs_model->activity = "telah menambahkan Kategori E-Modul";
	                	$this->logs_model->category = "add";
	                	$desc = $_POST['category_download_name'];
	                	$this->logs_model->description = "dengan nama ".$desc;
						$this->logs_model->insert();

	           		}
	           		else{
	           			$data['message_type'] = "danger";
						$data['message'] = "<strong>Opps..</strong> Kategori E-Modul telah digunakan.";
	           		}
				}
				else
				{
					$data['message_type'] = "warning";
					$data['message'] = "<strong>Opps..</strong> Data belum lengkap, silahkan lengkapi dulu!";
				}
			}
			$this->load->view('admin/index',$data);

		}
		else
		{
			redirect('admin');
		}
	}

	public function edit($category_download_id)
	{
		if ($this->user_id)
		{
			
			$data['title']		= "Edit Kategori E-Modul - ". app_name;
			$data['content']	= "category_download/edit" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			
			
			$data['active_menu'] = "category_download";
			$this->category_download_model->category_id = $category_download_id;
			if (!empty($_POST))
			{
				if ($_POST['category_download_name'] !="" &&
					$_POST['category_download_status'] !="" )
				{
					$avaliable = $this->category_download_model->check_availability($_POST['old_category_download'],$_POST['category_download_name']);
					if ($avaliable){
		                $this->category_download_model->category_name = $_POST['category_download_name'];
		                $this->category_download_model->category_status = $_POST['category_download_status'];
		                $this->category_download_model->update();
		                $data['message_type'] = "success";
		                $data['message']		= "Kategori E-Modul berhasil diperbarui.";


		                //logs
						$this->load->model('logs_model');
						$this->logs_model->user_id	 = $this->session->userdata('user_id');
	                	$this->logs_model->activity = "telah memperbarui kategori E-Modul";
	                	$this->logs_model->category = "update";
	                	$desc = $_POST['category_download_name'];
	                	$this->logs_model->description = "dengan nama ".$desc;
						$this->logs_model->insert();

	           		}
	           		else{
	           			$data['message_type'] = "danger";
						$data['message'] = "<strong>Opps..</strong> Kategori E-Modul telah digunakan.";
	           		}
				}
				else
				{
					$data['message_type'] = "warning";
					$data['message'] = "<strong>Opps..</strong> Data belum lengkap, silahkan lengkapi dulu!";
				}
			}
			$this->category_download_model->set_by_id();
			$data['category_download_name'] = $this->category_download_model->category_name;
			$data['category_download_status'] = $this->category_download_model->category_status;
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
		
			$this->category_download_model->category_id = $id;
			$this->category_download_model->delete();
			redirect('manage_category_download');
		}
		else
		{
			redirect('home');
		}
	}
}
?>