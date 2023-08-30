<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manage_project extends CI_Controller {
	public $user_id;

	public function __construct(){
		parent ::__construct();	
		$this->user_id = $this->session->userdata('user_id');
		$this->load->model('project_model');
		$this->load->model('user_model');
		$this->load->model('worksheet_model');
		$this->user_model->user_id = $this->user_id;
		$this->user_model->set_user_by_user_id();
		$this->user_picture = $this->user_model->user_picture;
		$this->full_name	= $this->user_model->full_name;
		$this->user_level	= $this->user_model->level;
		$this->user_privileges	= $this->user_model->user_privileges;
		$array_privileges = explode(';', $this->user_privileges);

			if (($this->user_level!="Administrator" && $this->user_level!="Admin Web") && !in_array('project', $array_privileges)) redirect ('welcome');
	}
	
	
	public function index()
	{
		if ($this->user_id)
		{
			$data['title']		= "Public - ". app_name;
			$data['content']	= "project/index" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['project'] = $this->project;
			$data['user_level']		= $this->user_level;
			if (!empty($_GET['s'])) {
				$this->project_model->search = $_GET['s'];
				$data['search'] = $_GET['s'];
			}
			if(!empty($_POST)){
				$project_name = $_POST['project_name'];
				$id_services = $_POST['id_services'];
				$id_client = $_POST['id_client'];
				$priority = $_POST['priority'];
				$this->project_model->project_name = $project_name;
				$this->project_model->id_services = $id_services;
				$this->project_model->id_client = $id_client;
				$this->project_model->priority = $priority;
			}

			$this->load->model('project_model');
			$data['query']		= $this->project_model->get_all();

			$this->load->model('services_model');
			$data['services']		= $this->services_model->get_all();

			$this->load->model('client_model');
			$data['client']		= $this->client_model->get_all();


			$data['active_menu'] = "manage_project";
			$this->load->view('admin/index',$data);

		}
		else
		{
			redirect('admin');
		}
	}

		public function detail()
	{
		if ($this->user_id)
		{
			$data['title']		= "Public - ". app_name;
			$data['content']	= "project/detail" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['project'] = $this->project;
			$data['user_level']		= $this->user_level;
			//$this->load->model('project_model');
			//$data['query']		= $this->project_model->get_all();
			$data['active_menu'] = "manage_project";
			$this->load->model('employee_model');
			$data['employee']		= $this->employee_model->get_all();
			$this->load->model('worksheet_model');
			$data['query']		= $this->project_model->get_by_id($this->uri->segment('3'));
			$data['worksheet']	= $this->worksheet_model->get_by_id($this->uri->segment('3'));
			$this->load->view('admin/index',$data);

		}
		else
		{
			redirect('admin');
		}
	}

	function verifikasi($id,$status) {
        if($id!=NULL && $status!=NULL){
        	if ($status=="kirim") {
	        	$config['upload_path']          = './data/project/';
	            $config['allowed_types']        = '*';
	            $config['max_size']             = 2000;
	            $config['max_width']            = 2000;
	            $config['max_height']           = 2000;

	            $this->load->library('upload', $config);
	            if ( ! $this->upload->do_upload('job_file'))
	            {
	                $_POST['job_file'] = "";
	            }
	            else
	            {
	            	$_POST['job_file'] = $this->upload->data('file_name');
	            }
        	} else if ($status=="cancel") {
        		unlink('./data/project/'.$this->input->post('old_job_file'));
        	}

        	$this->load->model('worksheet_model');
            $res = $this->worksheet_model->verifikasi($id,$status);
        }
    }

	public function edit_project()
	{
		if ($this->user_id)
		{
			$data['title']		= "Public - ". app_name;
			$data['content']	= "project/edit" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['project'] = $this->project;
			$data['user_level']		= $this->user_level;
			$this->load->model('project_model');

			$this->load->model('services_model');
			$data['services']		= $this->services_model->get_all();

			$this->load->model('client_model');
			$data['client']		= $this->client_model->get_all();

			$this->load->model('employee_model');
			$data['employee']		= $this->employee_model->get_all();

			$data['active_menu'] = "manage_project";
			if (!empty($this->input->post()))
			{
						$config['upload_path']          = './data/project/';
			            $config['allowed_types']        = '*';
			            $config['max_size']             = 2000;
			            $config['max_width']            = 2000;
			            $config['max_height']           = 2000;

			            $this->load->library('upload', $config);
			            if ( ! $this->upload->do_upload('file'))
		                {
		                    $file = "";
		                }
		                else
		                {
		                	unlink('./data/project/'.$this->input->post('old_file'));
		                	$file = $this->upload->data('file_name');
		                }

		                	$this->project_model->project_name = $this->input->post('project_name');
		                	$this->project_model->project_description = $this->input->post('project_description');
		                	$this->project_model->id_services = $this->input->post('id_services');
		                	$this->project_model->id_client = $this->input->post('id_client');
		                	$this->project_model->priority = $this->input->post('priority');
		                	$this->project_model->date_start = $this->input->post('date_start');
		                	$this->project_model->date_end = $this->input->post('date_end');
		                	$this->project_model->project_leader = $this->input->post('project_leader');
		                	$this->project_model->project_status = $this->input->post('project_status');
		                	$this->project_model->team = implode(",", $this->input->post('team'));
		                	$this->project_model->file = $file;
							$insert_id = $this->project_model->update();
			                $data['message_type'] = "success";
			                $data['message']		= "services has been added successfully.";


			                 //logs
							$this->load->model('logs_model');
							$this->logs_model->user_id	 = $this->session->userdata('user_id');
		                	$this->logs_model->activity = "has been updated project";
		                	$this->logs_model->category = "update";
		                	$desc = $this->input->post('project_name');
		                	$this->logs_model->description = "with names ".$desc;
							$this->logs_model->insert();


							/*$data_ws = $this->input->post();
							for ($i=$data_ws['jumlah_worksheet']; $i > 0; $i--) { 
								if (!empty($data_ws['worksheet_order'.$i])) {
						            if ( ! $this->upload->do_upload('file'.$i)){
						            	if(!empty($data_ws['old_file'.$i])) {
						            		$data_ws['file'.$i] = $data_ws['old_file'.$i];
						            	} else {
						            		$data_ws['file'.$i] = "";
						            	}
						            } 
					                else {
					                	if(!empty($data_ws['old_file'.$i])) {
						            		unlink('./data/project/'.$this->input->post('old_file'.$i));
						            	}
					                	$data_ws['file'.$i] = $this->upload->data('file_name');
					                }
					            }
					        }
							$this->load->model('worksheet_model');
							$this->worksheet_model->update($data_ws,$insert_id);*/
							//echo $insert_id;exit();
							redirect('manage_project/detail/'.$insert_id);

		                


			}
			$this->load->model('worksheet_model');
			$data['query']		= $this->project_model->get_by_id($this->uri->segment('3'));
			$data['worksheet']	= $this->worksheet_model->get_by_id($this->uri->segment('3'));
			$this->load->view('admin/index',$data);
				
			
			
			
		}
		else
		{
			redirect('admin');	
		}

	}

	public function add_project()
	{
		if ($this->user_id)
		{
			$data['title']		= "Public - ". app_name;
			$data['content']	= "project/add_project" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['project'] = $this->project;
			$data['user_level']		= $this->user_level;
			//$this->load->model('project_model');
			//$data['query']		= $this->project_model->get_all();

			$this->load->model('services_model');
			$data['services']		= $this->services_model->get_all();

			$this->load->model('client_model');
			$data['client']		= $this->client_model->get_all();

			$this->load->model('employee_model');
			$data['employee']		= $this->employee_model->get_all();

			$data['active_menu'] = "manage_project";
			if (!empty($this->input->post()))
			{
						$config['upload_path']          = './data/project/';
			            $config['allowed_types']        = '*';
			            $config['max_size']             = 2000;
			            $config['max_width']            = 2000;
			            $config['max_height']           = 2000;

			            $this->load->library('upload', $config);
			            if ( ! $this->upload->do_upload('file'))
		                {
		                    $data['message_type'] = "warning";
		                    $data['message']			= $this->upload->display_errors();
		                }
		                else
		                {

		                	$this->project_model->project_name = $this->input->post('project_name');
		                	$this->project_model->project_description = $this->input->post('project_description');
		                	$this->project_model->id_services = $this->input->post('id_services');
		                	$this->project_model->id_client = $this->input->post('id_client');
		                	$this->project_model->priority = $this->input->post('priority');
		                	$this->project_model->date_start = $this->input->post('date_start');
		                	$this->project_model->date_end = $this->input->post('date_end');
		                	$this->project_model->project_leader = $this->input->post('project_leader');
		                	$this->project_model->project_status = $this->input->post('project_status');
		                	$this->project_model->team = implode(",", $this->input->post('team'));
		                	$this->project_model->file = $this->upload->data('file_name');
							$insert_id = $this->project_model->insert();
			                $data['message_type'] = "success";
			                $data['message']		= "services has been added successfully.";


			                 //logs
							$this->load->model('logs_model');
							$this->logs_model->user_id	 = $this->session->userdata('user_id');
		                	$this->logs_model->activity = "has been add project";
		                	$this->logs_model->category = "add";
		                	$desc = $this->input->post('project_name');
		                	$this->logs_model->description = "with names ".$desc;
							$this->logs_model->insert();


							$data_ws = $this->input->post();
							for ($i=$data_ws['jumlah_worksheet']; $i > 0; $i--) { 
								if (!empty($data_ws['worksheet_order'.$i])) {
						            if ( ! $this->upload->do_upload('file'.$i)){
						            	$data_ws['file'.$i] = "";
						            } 
					                else {
					                	$data_ws['file'.$i] = $this->upload->data('file_name');
					                }
					            }
					        }
							$this->load->model('worksheet_model');
							$this->worksheet_model->update($data_ws,$insert_id);
							//echo $insert_id;exit();
							redirect('manage_project/detail/'.$insert_id);

		                }


			}
			$this->load->view('admin/index',$data);
				
			
			
			
		}
		else
		{
			redirect('admin');	
		}

	}

	

	public function list_worksheet($insert_id)
	{
		if ($this->user_id)
		{
			$data['title']		= "Public - ". app_name;
			$data['content']	= "project/list_worksheet" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['project'] = $this->project;
			$data['user_level']		= $this->user_level;
			$this->load->model('project_model');

			$this->load->model('services_model');
			$data['services']		= $this->services_model->get_all();

			$this->load->model('client_model');
			$data['client']		= $this->client_model->get_all();

			$this->load->model('employee_model');
			$data['employee']		= $this->employee_model->get_all();

			$data['active_menu'] = "manage_project";
			if (!empty($this->input->post()))
			{
						$config['upload_path']          = './data/project/';
			            $config['allowed_types']        = '*';
			            $config['max_size']             = 2000;
			            $config['max_width']            = 2000;
			            $config['max_height']           = 2000;

			            $this->load->library('upload', $config);


							$data_ws = $this->input->post();
							for ($i=$data_ws['jumlah_worksheet']; $i > 0; $i--) { 
								if (!empty($data_ws['worksheet_order'.$i])) {
						            if ( ! $this->upload->do_upload('file'.$i)){
						            	if(!empty($data_ws['old_file'.$i])) {
						            		$data_ws['file'.$i] = $data_ws['old_file'.$i];
						            	} else {
						            		$data_ws['file'.$i] = "";
						            	}
						            } 
					                else {
					                	if(!empty($data_ws['old_file'.$i])) {
						            		unlink('./data/project/'.$this->input->post('old_file'.$i));
						            	}
					                	$data_ws['file'.$i] = $this->upload->data('file_name');
					                }
					            }
					        }
							$this->load->model('worksheet_model');
							$this->worksheet_model->update($data_ws,$insert_id);
							//echo $insert_id;exit();
							redirect('manage_project/detail/'.$insert_id);
		                


			}
			$this->load->model('worksheet_model');
			$data['query']		= $this->project_model->get_by_id($this->uri->segment('3'));
			$data['worksheet']	= $this->worksheet_model->get_by_id($this->uri->segment('3'));
			$this->load->view('admin/index',$data);
				
			
			
			
		}
		else
		{
			redirect('admin');	
		}

	}

	public function delete($project_id)
	{
		if ($this->user_id)
		{
			$this->project_model->project_id = $project_id;
			$this->project_model->set_by_id();
			if ($this->project_model->file !="") unlink('./data/project/'.$this->project_model->file);
			$this->project_model->delete();
			redirect('manage_project');
		}
		else
		{
			redirect('home');
		}
	}
}
?>