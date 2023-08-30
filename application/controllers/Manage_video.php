<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manage_video extends CI_Controller {
	public $user_id;

	public function __construct(){
		parent ::__construct();	
		$this->user_id = $this->session->userdata('user_id');
		$this->load->model('video_model');
		$this->load->model('user_model');
		
		$this->user_model->user_id = $this->user_id;
		$this->user_model->set_user_by_user_id();
		$this->user_picture = $this->user_model->user_picture;
		$this->full_name	= $this->user_model->full_name;
		$this->user_level	= $this->user_model->level;
		$this->user_privileges	= $this->user_model->user_privileges;
		$array_privileges = explode(';', $this->user_privileges);

			if (($this->user_level!="Administrator" && $this->user_level!="Admin Web") || !in_array('video', $array_privileges)) redirect ('welcome');
	}
	public function index()
	{
		if ($this->user_id)
		{
			$data['title']		= "Video - ". app_name;
			$data['content']	= "video/index" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			
			$data['user_level']		= $this->user_level;
			$data['query']		= $this->video_model->get_all();
			$data['active_menu'] = "video";
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
			$data['title']		= "Tambah Video - ". app_name;
			$data['content']	= "video/add" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			
			$data['user_level']		= $this->user_level;

			$this->load->model('category_video_model');
			$data['category'] = $this->category_video_model->get_all();
			
			$data['active_menu'] = "video";
			if (!empty($_POST))
			{
				
						$url_video = $_POST['link'];
						$new_url = str_replace("watch?v=", "embed/", $url_video);

					
		                $this->video_model->judul = $_POST['judul'];
		                $this->video_model->link = $url_video;
		                $this->video_model->category_video_id = $_POST['category_video_id'];
		                $this->video_model->content = $_POST['content'];
		                $this->video_model->date_video = date('Y-m-d');
		                $this->video_model->time_video = date('H:i:s');
		                $this->video_model->insert();
		                $data['message_type'] = "success";
		                $data['message']		= "Video berhasil ditambahkan.";
	           		
	           		
			}
			$this->load->view('admin/index',$data);

		}
		else
		{
			redirect('admin');
		}
	}

	public function edit($id_video)
	{
		if ($this->user_id)
		{
			$data['title']		= "Edit Video - ". app_name;
			$data['content']	= "video/edit" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			
			$data['user_level']		= $this->user_level;


			$this->load->model('category_video_model');
			$data['category'] = $this->category_video_model->get_all();
			
			$data['active_menu'] = "video";
			$this->video_model->id_video = $id_video;
			if (!empty($_POST))
			{
				if ($_POST['judul'] !="")
				{
					
						$url_video = $_POST['link'];
						$new_url = str_replace("watch?v=", "embed/", $url_video);

		                $this->video_model->judul = $_POST['judul'];
		                $this->video_model->link = $url_video;
		                $this->video_model->category_video_id = $_POST['category_video_id'];
		                $this->video_model->content = $_POST['content'];
		                $this->video_model->update();
		                $data['message_type'] = "success";
		                $data['message']		= "Video berhasil diperbarui.";
	           		
	           		
				}
				else
				{
					$data['message_type'] = "warning";
					$data['message'] = "<strong>Opps..</strong> Data belum lengkap. Silahkan lengkapi dulu!";
				}
			}
			$this->video_model->set_by_id();
			$data['judul'] = $this->video_model->judul;
			$data['link'] = $this->video_model->link;
			$data['category_video_id'] = $this->video_model->category_video_id;
			$data['contentt'] = $this->video_model->content;
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
			$this->video_model->id_video = $id;
			$this->video_model->delete();
			redirect('manage_video');
		}
		else
		{
			redirect('home');
		}
	}
}
?>