<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ref_kode extends CI_Controller {
	public $user_id;

	public function __construct(){
		parent ::__construct();	
		$this->user_id = $this->session->userdata('user_id');
		$this->load->model('user_model');
		$this->load->model('ref_kode_model');
		$this->user_model->user_id = $this->user_id;
		$this->user_model->set_user_by_user_id();
		$this->user_picture = $this->user_model->user_picture;
		$this->full_name	= $this->user_model->full_name;
		$this->user_level	= $this->user_model->level;

		$this->user_privileges	= $this->user_model->user_privileges;
		$array_privileges = explode(';', $this->user_privileges);

			if (($this->user_level!="Administrator" && $this->user_level!="Admin Web") ) redirect ('welcome');
	}
	public function index()
	{		if ($this->user_id)
		{
			$data['title']		= "Ref. Kode Kegiatan - ". app_name;
			$data['content']	= "ref_kode/index" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			
			$data['user_level']		= $this->user_level;
			$data['query']		= $this->ref_kode_model->get_all();
			$data['active_menu'] = "ref_kode";

			$this->load->model('ref_kode_model');


			if (!empty($_POST)){
            	$this->ref_kode_model->kode = $_POST['kode'];
            	$this->ref_kode_model->keterangan = $_POST['keterangan'];
            	$this->ref_instansi_model->status = $_POST['status'];
			}


			$data['kode'] = $this->ref_kode_model->get_all();

			$this->load->helper('form');
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
			$data['title']		= "Tambah Kode Kegiatan - ". app_name;
			$data['content']	= "ref_kode/add" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "ref_kode";

			$this->load->model('ref_kode_model');
			$data['koordinator'] = $this->ref_kode_model->get_all();

			$this->load->helper('form');
			if (!empty($_POST))
			{

						
		                	$this->ref_kode_model->kode = $_POST['kode'];
		                	$this->ref_kode_model->keterangan = $_POST['keterangan'];
		                	$this->ref_kode_model->status = $_POST['status'];
							$this->ref_kode_model->insert();
			                $data['message_type'] = "success";
			                $data['message']		= "Kode Kegiatan berhasil ditambahakan.";


			                 //logs
							$this->load->model('logs_model');
							$this->logs_model->user_id	 = $this->session->userdata('user_id');
		                	$this->logs_model->activity = "has been add kode kegiatan";
		                	$this->logs_model->category = "add";
		                	$desc = $_POST['kode'];
		                	$this->logs_model->description = "with names ".$desc;
							$this->logs_model->insert();
			}

			$this->load->view('admin/index',$data);

		}
		else
		{
			redirect('admin');
		}
	}

	public function edit($id_kode)
	{
		if ($this->user_id)
		{
			
			$data['title']		= "Edit Kode Kegiatan - ". app_name;
			$data['content']	= "ref_kode/edit" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			
			$data['user_level']		= $this->user_level;
			
			$data['active_menu'] = "ref_kode";

			$this->load->model('ref_kode_model');
			$this->load->helper('form');
			if (!empty($_POST))
			{

					

		                	$this->ref_kode_model->id_kode = $id_kode;
		                	$this->ref_kode_model->kode = $_POST['kode'];
		                	$this->ref_kode_model->keterangan = $_POST['keterangan'];
		                	$this->ref_kode_model->status = $_POST['status'];	
							$this->ref_kode_model->update();
			                $data['message_type'] = "success";
			                $data['message']		= "Kode Kegiatan berhasil diperbarui .";


			                 //logs
							$this->load->model('logs_model');
							$this->logs_model->user_id	 = $this->session->userdata('user_id');
		                	$this->logs_model->activity = "has been update instansi";
		                	$this->logs_model->category = "add";
		                	$desc = $_POST['kode'];
		                	$this->logs_model->description = "with names ".$desc;
							$this->logs_model->insert();
			}

			$this->ref_kode_model->id_kode = $id_kode;
			$get = $this->ref_kode_model->get_by_id();
			$data['data'] = $get;
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
		
			$this->load->model('ref_kode_model');
			$this->ref_kode_model->id_kode = $id;
			$this->ref_kode_model->delete();
			redirect('ref_kode');
		}
		else
		{
			redirect('home');
		}
	}
}
?>