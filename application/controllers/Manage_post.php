<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manage_post extends CI_Controller {
	public $user_id;

	public function __construct(){
		parent ::__construct();	
		$this->user_id = $this->session->userdata('user_id');
		$this->load->model('post_model');
		$this->load->model('user_model');
		$this->user_model->user_id = $this->user_id;
		$this->user_model->set_user_by_user_id();
		$this->user_picture = $this->user_model->user_picture;
		$this->full_name	= $this->user_model->full_name;
		$this->user_level	= $this->user_model->level;
		$this->user_privileges	= $this->user_model->user_privileges;
		$array_privileges = explode(';', $this->user_privileges);

			if (($this->user_level!="Administrator" && $this->user_level!="Admin Web") && !in_array('post', $array_privileges)) redirect ('welcome'); 
	}

	public function index()
	{
		if ($this->user_id)
		{
			$data['title']		= "Berita - ". app_name;
			$data['content']	= "post/index" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			
			$data['user_level']		= $this->user_level;
			if (!empty($_GET['s'])) {
				$this->post_model->search = $_GET['s'];
				$data['search'] = $_GET['s'];
			}
			
			$data['per_page']	= 10;
			$data['total_rows']	= $this->post_model->get_total_row();
			$offset = 0;
			if (!empty($_GET['per_page'])) $offset = $_GET['per_page'] ;
			if ($this->user_level!="Administrator" ) $this->post_model->author = $this->user_id;
			$data['query']		= $this->post_model->get_for_page($data['per_page'],$offset);
			$data['active_menu'] = "post";
			$data['offset']	= $offset;
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
			$data['title']		= "Tambah Berita - ". app_name;
			$data['content']	= "post/add" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "post";
			$data['level'] = $this->user_model->get_user_level();
			$this->load->helper('form');
			if (!empty($_POST))
			{
				if ($_POST['title'] !="" &&
					$_POST['content'] !="" &&
					$_POST['date'] !="" &&
					$_POST['time'] !="" &&
					$_POST['post_status'] !="" &&
					$_POST['category_id'] !="" 
				)
				{
					$avaliable = $this->post_model->check_availability("",$_POST['title_slug'])	;
					if ($avaliable){
						$config['upload_path']          = './data/images/featured_image';
			            $config['allowed_types']        = 'gif|jpg|png';
			            $config['max_size']             = 2000;
			            $config['max_width']            = 1500;
			            $config['max_height']           = 1500;

			            $this->load->library('upload', $config);
			            if ( ! $this->upload->do_upload())
		                {
		                    $this->post_model->picture 	= "";
		                    $tmp_name				= $_FILES['userfile']['tmp_name'];
		                    if ($tmp_name!="")
		                    {
		                    	$data['error']			= $this->upload->display_errors();
		                    }
		                }
		                else
		                {
		                	$this->post_model->picture = $this->upload->data('file_name');
		                }

		                $this->post_model->category_id = $_POST['category_id'];
		                $this->post_model->title = $_POST['title'];
		                $this->post_model->title_slug = $_POST['title_slug'];
		                $this->post_model->content = $_POST['content'];
		                $this->post_model->date = $_POST['date'];
		                $this->post_model->time = $_POST['time'];
		                $this->post_model->author = $this->user_id;
		                $this->post_model->post_status = $_POST['post_status'];
		                $this->post_model->insert();
		                $data['message_type'] = "success";
		                $data['message']		= "Berita berhasil ditambahakan.";


		                //logs
							$this->load->model('logs_model');
							$this->logs_model->user_id	 = $this->session->userdata('user_id');
		                	$this->logs_model->activity = "has been add post";
		                	$this->logs_model->category = "add";
		                	$desc = $_POST['title'];
		                	$this->logs_model->description = "with names ".$desc;
							$this->logs_model->insert();

		            }
		            else{
		            	$data['message_type'] = "danger";
						$data['message'] = "<strong>Opps..</strong> Judul berita sudah digunakan, silahkan coba yang lain.";
		            }
				}
				else
				{
					$data['message_type'] = "warning";
					$data['message'] = "<strong>Opps..</strong> Data belum lengkap. silahkan lengkapi dulu!";
				}
			}
			$this->load->model('category_model');
			$this->category_model->category_status = "Active";
			$data['categories']	= $this->category_model->get_all();
			$this->load->view('admin/index',$data);
			
		}
		else
		{
			redirect('admin');	
		}
	}
	
	public function edit($post_id)
	{

		if ($this->user_id)
		{

			$data['title']		= "Edit Berita - ". app_name;
			$data['content']	= "post/edit" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "post";
			$data['level'] = $this->user_model->get_user_level();
			$this->load->helper('form');
			$this->post_model->post_id = $post_id;
			if (!empty($_POST))
			{
				if ($_POST['title'] !="" &&
					$_POST['content'] !="" &&
					$_POST['date'] !="" &&
					$_POST['time'] !="" &&
					$_POST['post_status'] !="" &&
					$_POST['category_id'] !="" 
				)
				{
					
					$avaliable = $this->post_model->check_availability($_POST['old_title_slug'],$_POST['title_slug'])	;
					if ($avaliable){
						$config['upload_path']          = './data/images/featured_image';
			            $config['allowed_types']        = 'gif|jpg|png';
			            $config['max_size']             = 2000;
			            $config['max_width']            = 1500;
			            $config['max_height']           = 1500;

			            $this->load->library('upload', $config);
			            if ( ! $this->upload->do_upload())
		                {
		                    $this->post_model->picture 	= "";
		                    $tmp_name				= $_FILES['userfile']['tmp_name'];
		                    if ($tmp_name!="")
		                    {
		                    	$data['error']			= $this->upload->display_errors();
		                    }
		                }
		                else
		                {
		                	$this->post_model->set_by_id();
		                	if ($this->post_model->picture !="") unlink('./data/images/featured_image/'.$this->post_model->picture);
		                	$this->post_model->picture = $this->upload->data('file_name');
		                }

		                $this->post_model->category_id = $_POST['category_id'];
		                $this->post_model->title = $_POST['title'];
		                $this->post_model->title_slug = $_POST['title_slug'];
		                $this->post_model->content = $_POST['content'];
		                $this->post_model->date = $_POST['date'];
		                $this->post_model->time = $_POST['time'];
		                $this->post_model->author = $this->user_id;
		                $this->post_model->post_status = $_POST['post_status'];
		                $this->post_model->update();
		                $data['message_type'] = "success";
		                $data['message']		= "Berita berhasil diperbarui.";

		                 //logs
							$this->load->model('logs_model');
							$this->logs_model->user_id	 = $this->session->userdata('user_id');
		                	$this->logs_model->activity = "has been update post";
		                	$this->logs_model->category = "update";
		                	$desc = $_POST['title'];
		                	$this->logs_model->description = "with names ".$desc;
							$this->logs_model->insert();

		            }
		            else{
		            	$data['message_type'] = "danger";
						$data['message'] = "<strong>Opps..</strong> Judul berita sudah digunakan, silahkan coba yang lain.";
		            }
				}
				else
				{
					$data['message_type'] = "warning";
					$data['message'] = "<strong>Opps..</strong> Data belum lengkap. silahkan lengkapi dulu!";
				}
			}
			$this->load->model('category_model');
			$this->category_model->category_status = "Active";
			$data['categories']	= $this->category_model->get_all();
			$this->post_model->set_by_id();
			$data['post_title']	= $this->post_model->title;
			$data['title_slug']	= $this->post_model->title_slug;
			$data['post_content']	= $this->post_model->content;
			$data['date']	= $this->post_model->date;
			$data['time']	= $this->post_model->time;
			$data['post_status']	= $this->post_model->post_status;
			$data['picture']	= $this->post_model->picture;
			$data['category_id']	= $this->post_model->category_id;

			$this->load->view('admin/index',$data);
			
		}
		else
		{
			redirect('admin');	
		}
	}
	public function delete($post_id)
	{
		if ($this->user_id)
		{
			$this->post_model->post_id = $post_id;
			$this->post_model->set_by_id();
			if ($this->post_model->picture !="") unlink('./data/images/featured_image/'.$this->post_model->picture);
			$this->post_model->delete();
			redirect('manage_post');
		}
		else
		{
			redirect('home');
		}
	}
}
?>