<?php
	class Manage_notice extends CI_Controller{
	public $user_id;

	public function __construct(){
		parent ::__construct();	
		$this->user_id = $this->session->userdata('user_id');
		$this->load->model('user_model');
		$this->load->model('notice_model');
		$this->user_model->user_id = $this->user_id;
		$this->user_model->set_user_by_user_id();
		$this->user_picture = $this->user_model->user_picture;
		$this->full_name	= $this->user_model->full_name;
		$this->user_level	= $this->user_model->level;
		$this->user_privileges	= $this->user_model->user_privileges;
		$array_privileges = explode(';', $this->user_privileges);
		if (($this->user_level!="Administrator" && $this->user_level!="Admin Web") && !in_array('notice', $array_privileges)) redirect ('welcome');

		
	}
		public function index(){
			if ($this->user_id){
				$data['title']		= "Papan Pengumuman - ". app_name;
				$data['active_menu'] = "manage_notice";
				$data['content']	= "notice_board/index" ;
				$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			
				$data['user_level']		= $this->user_level;
				$data['notice'] = $this->notice_model->get_all()->result();
				$this->load->view('admin/index',$data);
			}
		}

		public function add_notice(){
			if ($this->user_id){
				$data['title']		= "Tambah Pengumuman - ". app_name;
				$data['active_menu'] = "manage_notice";
				$data['content']	= "notice_board/add" ;
				$data['user_picture'] = $this->user_picture;
				$data['full_name']		= $this->full_name;
			
				$data['user_level']		= $this->user_level;
				if(!empty($_POST)){
		            $this->notice_model->text = $_POST['text'];
		            $this->notice_model->date = $_POST['date'];
		            $this->notice_model->status = $_POST['status'];
					$this->notice_model->insert();
			        $data['message_type'] = "success";
			        $data['message']		= "Pengumuman berhasil ditambahkan.";
			                
			        //logs
					$this->load->model('logs_model');
					$this->logs_model->user_id	 = $this->session->userdata('user_id');
		            $this->logs_model->activity = "has been add notice board";
		            $this->logs_model->category = "add";
		            $desc = $_POST['text'];
		            $this->logs_model->description = "with text ".$desc;
					$this->logs_model->insert();
				}

				$this->load->view('admin/index',$data);
			}else{
				redirect('admin');
			}
		}

		public function edit_notice($notice_id){
			if ($this->user_id){
				$this->notice_model->notice_id = $notice_id;
				$data['title']		= "Edit Pengumuman - ". app_name;
				$data['active_menu'] = "manage_notice";
				$data['content']	= "notice_board/edit" ;
				$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			
				$data['user_level']		= $this->user_level;
				if(!empty($_POST)){
		            $this->notice_model->text = $_POST['text'];
		            $this->notice_model->date = $_POST['date'];
		            $this->notice_model->status = $_POST['status'];
					$this->notice_model->update();
			        $data['message_type'] = "success";
			        $data['message']		= "Pengumuman berhasil diperbarui";

			        //logs
					$this->load->model('logs_model');
					$this->logs_model->user_id	 = $this->session->userdata('user_id');
	               	$this->logs_model->activity = "has been update notice";
	               	$this->logs_model->category = "update";
	               	$desc = $_POST['text'];
	               	$this->logs_model->description = "with text ".$desc;
					$this->logs_model->insert();

				}

				$this->notice_model->set_id();
				$data['text']	= $this->notice_model->text;
				$data['date']	= $this->notice_model->date;
				$data['status']	= $this->notice_model->status;

				$this->load->view('admin/index',$data);

			}else{
				redirect('admin');
			}
		}

		public function delete($notice_id){
			if ($this->user_id){
				$this->load->model('notice_model');
				$this->notice_model->notice_id = $notice_id;
				$this->notice_model->delete();
				redirect('manage_notice');
			}else{
				redirect('home');
			}
		}
	}