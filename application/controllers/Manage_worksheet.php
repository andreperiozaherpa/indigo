<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manage_worksheet extends CI_Controller {
	public $user_id;

	public function __construct(){
		parent ::__construct();	
		$this->user_id = $this->session->userdata('user_id');
		$this->employee_id = $this->session->userdata('employee_id');
		$this->load->model('project_model');
		$this->load->model('worksheet_model');
		$this->load->model('user_model');
		$this->load->model('project_model');
		$this->project = $this->project_model->get_all();
		$this->user_model->user_id = $this->user_id;
		$this->user_model->set_user_by_user_id();
		$this->user_picture = $this->user_model->user_picture;
		$this->full_name	= $this->user_model->full_name;
		$this->user_level	= $this->user_model->level;

		$this->user_privileges	= $this->user_model->user_privileges;
		$array_privileges = explode(';', $this->user_privileges);

			if (($this->user_level!="Administrator" && $this->user_level!="Admin Web") && !in_array('worksheet', $array_privileges)) redirect ('welcome');
	}
	
	
	public function index()
	{
		if ($this->user_id)
		{
			$data['title']		= "Public - ". app_name;
			$data['content']	= "worksheet/index" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['project'] = $this->project;
			$data['user_level']		= $this->user_level;
			if (!empty($_GET['s'])) {
				$this->worksheet_model->search = $_GET['s'];
				$data['search'] = $_GET['s'];
			}
			if(!empty($_POST)){
				$project_name = $_POST['project_name'];
				$id_services = $_POST['id_services'];
				$id_client = $_POST['id_client'];
				$priority = $_POST['priority'];
				$this->worksheet_model->project_name = $project_name;
				$this->worksheet_model->id_services = $id_services;
				$this->worksheet_model->id_client = $id_client;
				$this->worksheet_model->priority = $priority;
			}
			$this->load->model('worksheet_model');
			$data['query']		= $this->worksheet_model->get_all();

			$this->load->model('employee_model');
			$data['employee']		= $this->employee_model->get_all();
			
			$this->load->model('services_model');
			$data['services']		= $this->services_model->get_all();

			$this->load->model('client_model');
			$data['client']		= $this->client_model->get_all();

			$data['active_menu'] = "manage_worksheet";
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
			$data['content']	= "worksheet/detail" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['project'] = $this->project;
			$data['user_level']		= $this->user_level;
			//$this->load->model('project_model');
			//$data['query']		= $this->project_model->get_all();
			$data['active_menu'] = "manage_worksheet";
			$this->load->model('employee_model');
			$data['employee']		= $this->employee_model->get_all();
			$data['query']		= $this->project_model->get_by_id($this->uri->segment('3'));
			$data['worksheet']	= $this->worksheet_model->get_by_id($this->uri->segment('3'));
			$this->load->view('admin/index',$data);

		}
		else
		{
			redirect('admin');
		}
	}


	public function add_worksheet()
	{
		if ($this->user_id)
		{
			$data['title']		= "Public - ". app_name;
			$data['content']	= "worksheet/add" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['project'] = $this->project;
			$data['user_level']		= $this->user_level;
			//$this->load->model('worksheet_model');
			//$data['query']		= $this->worksheet_model->get_all();
			$data['active_menu'] = "manage_worksheet";
			$this->load->view('admin/index',$data);
				
			
			
			
		}
		else
		{
			redirect('admin');	
		}

}

	public function edit_worksheet ($id_worksheet)
	{
		if ($this->user_id)
		{
			$data['title']		= "Public - ". app_name;
			$data['content']	= "worksheet/edit" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['project'] = $this->project;
			$data['user_level']		= $this->user_level;
			//$this->load->model('worksheet_model');
			//$data['query']		= $this->worksheet_model->get_all();
			$data['active_menu'] = "manage_worksheet";
			$this->load->view('admin/index',$data);
			
		}
		else
		{
			redirect('admin');	
		}
	}

	public function delete($id_portofolio)
	{
		if ($this->user_id)
		{
			$this->load->model('portofolio_model');
			$this->portofolio_model->id_portofolio = $id_portofolio;
			$this->portofolio_model->delete();
			redirect('manage_portofolio');
		}
		else
		{
			redirect('home');
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
}
?>