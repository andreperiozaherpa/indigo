<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manage_menu extends CI_Controller {
	public $user_id;

	public function __construct(){
		parent ::__construct();
		$this->user_id = $this->session->userdata('user_id');
		$this->load->model('menu_model');
		$this->load->model('user_model');
		$this->user_model->user_id = $this->user_id;
		$this->user_model->set_user_by_user_id();
		$this->user_picture = $this->user_model->user_picture;
		$this->full_name	= $this->user_model->full_name;
		$this->user_level	= $this->user_model->level;
		$this->user_privileges	= $this->user_model->user_privileges;
		$array_privileges = explode(';', $this->user_privileges);


		if (($this->user_level!="Administrator" && $this->user_level!="Admin Web") && !in_array('menu', $array_privileges)) redirect ('welcome');
	}


	public function index()
	{
		if ($this->user_id && in_array('menu', $array_privileges))
		{
			$data['title']		= "Public - ". app_name;
			$data['content']	= "menu/index" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			
			$this->load->model('menu_model');
			$data['query']		= $this->menu_model->get_all();
			$data['active_menu'] = "menu";
			$this->load->view('admin/index',$data);

		}
		else
		{
			redirect('admin');
		}
	}

	public function add_menu()
	{
		if ($this->user_id)
		{
			$this->load->model('menu_model');
			$data['title']		= "Add new menu ` - ". app_name;
			$data['content']	= "menu/add" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			

			$data['active_menu'] = "menu";
			$this->load->helper('form');

				if (!empty($_POST))
			{
				      	$this->load->model('menu_model');
				
	                	$this->menu_model->parent_id = $_POST['parent_id'];
		    			$this->menu_model->menu = $_POST['menu'];
		    			$this->menu_model->menu_order = $_POST['menu_order'];
		    			$this->menu_model->link = $_POST['link'];
		    			$this->menu_model->isi_menu = $_POST['isi_menu'];


						$this->menu_model->insert();
		                $data['message_type'] = "success";
		                $data['message']		= "menu has been added successfully.";


			}

			$this->load->model('menu_model');
			$data['datamenu'] = $this->menu_model->get_all();

			$this->load->view('admin/index',$data);

		}
		else
		{
			redirect('admin');
		}

}

	public function edit_menu ($id_menu)
	{
		if ($this->user_id)
		{
			$this->load->model('menu_model');
			$this->menu_model->id_menu = $id_menu;
			$data['title']		= "Edit menu - ". app_name;
			$data['content']	= "menu/edit" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			
			$data['active_menu'] = "public";
			$this->load->helper('form');
			if (!empty($_POST))
			{
				      	$this->load->model('menu_model');
				
	                	$this->menu_model->parent_id = $_POST['parent_id'];
		    			$this->menu_model->menu = $_POST['menu'];
		    			$this->menu_model->menu_order = $_POST['menu_order'];
		    			$this->menu_model->link = $_POST['link'];
		    			$this->menu_model->isi_menu = $_POST['isi_menu'];


						$this->menu_model->update();
		                $data['message_type'] = "success";
		                $data['message']		= "menu has been added successfully.";


			}



			$this->menu_model->set();
			$data['parent_id']	= $this->menu_model->parent_id;
			$data['menu']	= $this->menu_model->menu;
			$data['menu_order']	= $this->menu_model->menu_order;
			$data['link']	= $this->menu_model->link;
			$data['isi_menu']	= $this->menu_model->isi_menu;


			$this->load->model('menu_model');
			$data['datamenu'] = $this->menu_model->get_all();

			
			$this->load->view('admin/index',$data);



		}
		else
		{
			redirect('admin');
		}
	}

	public function delete($id_menu)
	{
		if ($this->user_id)
		{
			$this->load->model('menu_model');
			$this->menu_model->id_menu = $id_menu;
			$this->menu_model->delete();
			redirect('manage_menu');
		}
		else
		{
			redirect('home');
		}
	}
}
?>
