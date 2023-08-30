<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manage_category extends CI_Controller {
	public $user_id;

	public function __construct(){
		parent ::__construct();	
		$this->user_id = $this->session->userdata('user_id');
		$this->load->model('category_model');
		$this->load->model('user_model');
		$this->user_model->user_id = $this->user_id;
		$this->user_model->set_user_by_user_id();
		$this->user_picture = $this->user_model->user_picture;
		$this->full_name	= $this->user_model->full_name;
		$this->user_level	= $this->user_model->level;

		$this->user_privileges	= $this->user_model->user_privileges;
		$array_privileges = explode(';', $this->user_privileges);


		if (($this->user_level!="Administrator" && $this->user_level!="Admin Web") && !in_array('blog_category', $array_privileges)) redirect ('welcome');
	}
	public function index()
	{
		if ($this->user_id)
		{
			$data['title']		= "Kategori - ". app_name;
			$data['content']	= "category/index" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			
			$data['query']		= $this->category_model->get_all();
			$data['active_menu'] = "category";
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
			
			$data['title']		= "Tambah Kategori - ". app_name;
			$data['content']	= "category/add" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			
			$data['active_menu'] = "category";
			if (!empty($_POST))
			{
				if ($_POST['category_name'] !="" &&
					$_POST['category_status'] !="" )
				{
					$avaliable = $this->category_model->check_availability("",$_POST['category_name']);
					if ($avaliable){
		                $this->category_model->category_name = $_POST['category_name'];
		                $this->category_model->category_status = $_POST['category_status'];
		                $this->category_model->category_slug = url_title($_POST['category_name']);
		                $this->category_model->insert();
		                $data['message_type'] = "success";
		                $data['message']		= "Kategori telah berhasil ditambahkan.";

		                 //logs
						$this->load->model('logs_model');
						$this->logs_model->user_id	 = $this->session->userdata('user_id');
	                	$this->logs_model->activity = "telah menambahkan kategori";
	                	$this->logs_model->category = "add";
	                	$desc = $_POST['category_name'];
	                	$this->logs_model->description = "dengan nama ".$desc;
						$this->logs_model->insert();

	           		}
	           		else{
	           			$data['message_type'] = "danger";
						$data['message'] = "<strong>Opps..</strong> Kategori telah digunakan.";
	           		}
				}
				else
				{
					$data['message_type'] = "warning";
					$data['message'] = "<strong>Opps..</strong> Data belum lengkap. silahkan lengkapi dulu!";
				}
			}
			$this->load->view('admin/index',$data);

		}
		else
		{
			redirect('admin');
		}
	}

	public function edit($category_id)
	{
		if ($this->user_id)
		{
			
			$data['title']		= "Edit Kategori - ". app_name;
			$data['content']	= "category/edit" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			
			
			$data['active_menu'] = "category";
			$this->category_model->category_id = $category_id;
			if (!empty($_POST))
			{
				if ($_POST['category_name'] !="" &&
					$_POST['category_status'] !="" )
				{
					$avaliable = $this->category_model->check_availability($_POST['old_category'],$_POST['category_name']);
					if ($avaliable){
		                $this->category_model->category_name = $_POST['category_name'];
		                $this->category_model->category_status = $_POST['category_status'];
		                $this->category_model->category_slug = url_title($_POST['category_name']);
		                $this->category_model->update();
		                $data['message_type'] = "success";
		                $data['message']		= "Kategori berhasil diperbarui.";


		                //logs
						$this->load->model('logs_model');
						$this->logs_model->user_id	 = $this->session->userdata('user_id');
	                	$this->logs_model->activity = "telah memperbarui kategori";
	                	$this->logs_model->category = "update";
	                	$desc = $_POST['category_name'];
	                	$this->logs_model->description = "dengan nama ".$desc;
						$this->logs_model->insert();

	           		}
	           		else{
	           			$data['message_type'] = "danger";
						$data['message'] = "<strong>Opps..</strong> Kategori telah digunakan.";
	           		}
				}
				else
				{
					$data['message_type'] = "warning";
					$data['message'] = "<strong>Opps..</strong> Data belum lengkap. silahkan lengkapi dulu!";
				}
			}
			$this->category_model->set_by_id();
			$data['category_name'] = $this->category_model->category_name;
			$data['category_status'] = $this->category_model->category_status;
			$data['category_slug'] = $this->category_model->category_slug;
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
		
			$this->category_model->category_id = $id;
			$this->category_model->delete();
			redirect('manage_category');
		}
		else
		{
			redirect('home');
		}
	}
}
?>