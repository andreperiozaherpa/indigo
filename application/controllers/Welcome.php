<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller
{
	function __construct()
	{
		parent::__construct();

		$this->load->helper('url');
		$this->load->library('tank_auth');
		$this->load->library('session');
		$this->load->model('tank_auth/users');

		if (!$this->tank_auth->is_logged_in()) {
			redirect(base_url().'login');
		}

		$this->user_id	= $this->tank_auth->get_user_id();
		//$data['username']	= $this->tank_auth->get_username();
		$user_data = $this->users->get_user_by_id($this->tank_auth->get_user_id(),1);
		$this->firstname = $user_data->firstname;
		$this->lastname = $user_data->lastname;
		$this->full_name		= "{$user_data->firstname} {$user_data->lastname}";
		
		if( !$this->session->userdata('image') == '' ){
		$this->user_picture = $this->session->userdata('image');
		}else{
		$this->user_picture = '/images/blank_man.gif';
		}
	}

	function index()
	{
		if (!$this->tank_auth->is_logged_in()) {
			redirect(base_url().'login');
		} else {
			redirect(base_url().'helpdesk');
			/*$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['firstname']		= $this->firstname;
			$data['lastname']		= $this->lastname;
			$data['user_id']		= $this->user_id;


			$data['title']		= "Dashboard - ". app_name;
			$data['content']	= "" ;
			$data['active_menu'] = "welcome";
			$this->load->view('people/index', $data);*/
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */