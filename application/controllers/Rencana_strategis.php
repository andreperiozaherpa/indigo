<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rencana_strategis extends CI_Controller {
	public $user_id;

	public function __construct(){
		parent ::__construct();
		$this->user_id = $this->session->userdata('user_id');
		$this->load->model('user_model');
		$this->user_model->user_id = $this->user_id;
		$this->user_model->set_user_by_user_id();
		$this->user_picture = $this->user_model->user_picture;
		$this->full_name	= $this->user_model->full_name;
		$this->user_level	= $this->user_model->level;
		$this->load->model('skpd_model');

		$this->level_id	= $this->user_model->level_id;
		if ($this->level_id >2 ) redirect("admin");
	}
	public function get_induk()
	{
		$obj = "";
		if (!empty($_POST['id_induk'])){
			$id_induk = $_POST['id_induk']==9999 ? 0 : $_POST['id_induk'];
			$data = $this->skpd_model->get_induk($id_induk);
			if (!empty($data)) $obj = "<option value='' selected>Pilih</option>";
			foreach($data as $row){
				$obj .="<option value=".$row->kd_skpd.">".$row->nama_skpd."</option>";
			}
		}
		die ($obj);
	}
	public function index()
	{
		if ($this->user_id)
		{
			$data['title']		= "R. Strategis - Admin ";
			$data['content']	= "rencana_strategis/index" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "rencana_strategis_skpd";
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
			$data['title']		= "skpd - Admin ";
			$data['content']	= "ref_skpd/add" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "ref_skpd";
			$this->load->view('admin/index',$data);


		}
		else
		{
			redirect('admin');
		}
	}


	public function view()
	{
		if ($this->user_id)
		{
			$data['title']		= "skpd - Admin ";
			$data['content']	= "ref_skpd/view" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "ref_skpd";
			$this->load->view('admin/index',$data);


		}
		else
		{
			redirect('admin');
		}
	}




}
?>
