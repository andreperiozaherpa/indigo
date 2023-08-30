<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manage_tag extends CI_Controller {
	public $user_id;

	public function __construct(){
		parent ::__construct();	
		$this->user_id = $this->session->userdata('user_id');
		$this->load->model('tag_model');
		$this->load->model('user_model');
		$this->user_model->user_id = $this->user_id;
		$this->user_model->set_user_by_user_id();
		$this->user_picture = $this->user_model->user_picture;
		$this->full_name	= $this->user_model->full_name;
		$this->user_level	= $this->user_model->level;
		$this->user_privileges	= $this->user_model->user_privileges;
		$array_privileges = explode(';', $this->user_privileges);

			if (($this->user_level!="Administrator" && $this->user_level!="Admin Web") && !in_array('tags', $array_privileges)) redirect ('welcome'); 
	}
	public function index()
	{
		if ($this->user_id)
		{
			$data['title']		= "Tag - ". app_name;
			$data['content']	= "tag/index" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			
			$data['user_level']		= $this->user_level;
			$data['query']		= $this->tag_model->get_all();
			$data['active_menu'] = "tag";
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
			$data['title']		= "Tambah Tag - ". app_name;
			$data['content']	= "tag/add" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			
			$data['user_level']		= $this->user_level;
			
			$data['active_menu'] = "tag";
			if (!empty($_POST))
			{
				if ($_POST['tag_name'] !="")
				{
					$avaliable = $this->tag_model->check_availability("",$_POST['tag_name']);
					if ($avaliable){
		                $this->tag_model->tag_name = $_POST['tag_name'];
		                $this->tag_model->tag_slug = $_POST['tag_slug'];
		                $this->tag_model->insert();
		                $data['message_type'] = "success";
		                $data['message']		= "Tag berhasil ditambahkan.";
	           		}
	           		else{
	           			$data['message_type'] = "danger";
						$data['message'] = "<strong>Opps..</strong> Tag sudah terpakai.";
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

	public function edit($tag_id)
	{
		if ($this->user_id)
		{
			$data['title']		= "Edit Tag - ". app_name;
			$data['content']	= "tag/edit" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			
			$data['user_level']		= $this->user_level;
			
			$data['active_menu'] = "tag";
			$this->tag_model->tag_id = $tag_id;
			if (!empty($_POST))
			{
				if ($_POST['tag_name'] !="")
				{
					$avaliable = $this->tag_model->check_availability($_POST['old_tag'],$_POST['tag_name']);
					if ($avaliable){
		                $this->tag_model->tag_name = $_POST['tag_name'];
		                $this->tag_model->tag_slug = $_POST['tag_slug'];
		                $this->tag_model->update();
		                $data['message_type'] = "success";
		                $data['message']		= "Tag berhasil diperbarui.";
	           		}
	           		else{
	           			$data['message_type'] = "danger";
						$data['message'] = "<strong>Opps..</strong> Tag sudah terpakai.";
	           		}
				}
				else
				{
					$data['message_type'] = "warning";
					$data['message'] = "<strong>Opps..</strong> Data belum lengkap. silahkan lengkapi dulu!";
				}
			}
			$this->tag_model->set_by_id();
			$data['tag_name'] = $this->tag_model->tag_name;
			$data['tag_slug'] = $this->tag_model->tag_slug;
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
			$this->tag_model->tag_id = $id;
			$this->tag_model->delete();
			redirect('manage_tag');
		}
		else
		{
			redirect('home');
		}
	}
}
?>