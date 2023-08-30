<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dummy extends CI_Controller {
	public $user_id;

	public function __construct(){
		parent ::__construct();	

	}

	public function index()
	{
		echo "connected";
	}

	public function xeditable()
	{
		$this->load->view('xeditable');
	}
}
