<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manage_message extends CI_Controller {
	public $user_id;

	public function __construct(){
		parent ::__construct();	
		$this->user_id = $this->session->userdata('user_id');
		$this->load->model('contact_model');
		$this->load->model('user_model');

		// Load the captcha helper
		$this->load->helper('captcha');


		$this->user_model->user_id = $this->user_id;
		$this->user_model->set_user_by_user_id();
		$this->user_picture = $this->user_model->user_picture;
		$this->full_name	= $this->user_model->full_name;
		$this->user_level	= $this->user_model->level;
		if ($this->user_level!="Administrator" && $this->user_level!="Admin Web") redirect ('promkes'); 
	}
	public function index()
	{
		if ($this->user_id && $this->user_level=="Administrator")
		{
			$data['title']		= "Message - ". app_name;
			$data['content']	= "message/index" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			
			$data['user_level']		= $this->user_level;
			$data['project']		= $this->project;
			$data['query']		= $this->contact_model->get_all();

			
			$data['active_menu'] = "";
			$this->load->view('admin/index',$data);

		}
		else
		{
			redirect('admin');
		}
	}
	public function read($id)
	{
		if ($this->user_id && $this->user_level=="Administrator")
		{
			$this->contact_model->id = $id;
			$this->contact_model->status = "read";
			$this->contact_model->update();

			$unread = $this->contact_model->total_unread();
			die("$unread");
		}
	}



	public function add_menu()
	{
		
			$this->load->model('contact_model');
			$data['title']		= "Add new menu ` - ". app_name;
			$data['content']	= "menu/add" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			
			$data['user_level']		= $this->user_level;
			$data['project']		= $this->project;

			$data['active_menu'] = "menu";
			$this->load->helper('form');

				   		$this->load->model('contact_model');
				
	                	$this->contact_model->nama = $_POST['parent_id'];
		    			$this->contact_model->menu = $_POST['menu'];
		    			$this->contact_model->menu_order = $_POST['menu_order'];
		    			$this->contact_model->isi_menu = $_POST['isi_menu'];


						$this->contact_model->insert();
		                $data['message_type'] = "success";
		                $data['message']		= "pengaduan has been added successfully.";


			$this->load->model('menu_model');
			$data['datamenu'] = $this->menu_model->get_all();

			$this->load->view('admin/index',$data);


}

}
?>