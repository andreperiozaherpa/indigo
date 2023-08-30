<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ref_kategori_berkas extends CI_Controller {
	public $user_id;

	public function __construct(){
		parent ::__construct();	
		$this->user_id = $this->session->userdata('user_id');
		$this->load->model('user_model');
		$this->load->model('ref_kategori_berkas_model');
		$this->user_model->user_id = $this->user_id;
		$this->user_model->set_user_by_user_id();
		$this->user_picture = $this->user_model->user_picture;
		$this->full_name	= $this->user_model->full_name;
		$this->user_level	= $this->user_model->level;

		$this->user_privileges	= $this->user_model->user_privileges;
		$array_privileges = explode(';', $this->user_privileges);

			if (($this->user_level!="Administrator" && $this->user_level!="User") && !in_array('kategori_berkas', $array_privileges)) redirect ('welcome');
	}
	public function index()
	{		if ($this->user_id)
		{
			$data['title']		= "Ref. kategori_berkas Kegiatan - ". app_name;
			$data['content']	= "ref_kategori_berkas/index" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			
			$data['user_level']		= $this->user_level;
			$data['query']		= $this->ref_kategori_berkas_model->get_all();
			$data['active_menu'] = "ref_kategori_berkas";

			$this->load->model('ref_kategori_berkas_model');


			if (!empty($_POST)){
            	$this->ref_kategori_berkas_model->kategori_berkas = $_POST['kategori_berkas'];
            	$this->ref_kategori_berkas_model->keterangan = $_POST['keterangan'];
            	$this->ref_instansi_model->status = $_POST['status'];
			}


			$data['kategori_berkas'] = $this->ref_kategori_berkas_model->get_all();

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
			$data['title']		= "Tambah kategori_berkas Kegiatan - ". app_name;
			$data['content']	= "ref_kategori_berkas/add" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "ref_kategori_berkas";

			$this->load->model('ref_kategori_berkas_model');
			$data['koordinator'] = $this->ref_kategori_berkas_model->get_all();

			$this->load->helper('form');
			if (!empty($_POST))
			{

						
		                	$this->ref_kategori_berkas_model->kategori_berkas = $_POST['kategori_berkas'];
		                	$this->ref_kategori_berkas_model->keterangan = $_POST['keterangan'];
		                	$this->ref_kategori_berkas_model->status = $_POST['status'];
							$this->ref_kategori_berkas_model->insert();
			                $data['message_type'] = "success";
			                $data['message']		= "kategori_berkas Kegiatan berhasil ditambahakan.";


			                 //logs
							$this->load->model('logs_model');
							$this->logs_model->user_id	 = $this->session->userdata('user_id');
		                	$this->logs_model->activity = "has been add kategori_berkas kegiatan";
		                	$this->logs_model->category = "add";
		                	$desc = $_POST['kategori_berkas'];
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

	public function edit($id_kategori_berkas)
	{
		if ($this->user_id)
		{
			
			$data['title']		= "Edit kategori_berkas Kegiatan - ". app_name;
			$data['content']	= "ref_kategori_berkas/edit" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			
			$data['user_level']		= $this->user_level;
			
			$data['active_menu'] = "ref_kategori_berkas";

			$this->load->model('ref_kategori_berkas_model');
			$this->load->helper('form');
			if (!empty($_POST))
			{

					

		                	$this->ref_kategori_berkas_model->id_kategori_berkas = $id_kategori_berkas;
		                	$this->ref_kategori_berkas_model->kategori_berkas = $_POST['kategori_berkas'];
		                	$this->ref_kategori_berkas_model->keterangan = $_POST['keterangan'];
		                	$this->ref_kategori_berkas_model->status = $_POST['status'];	
							$this->ref_kategori_berkas_model->update();
			                $data['message_type'] = "success";
			                $data['message']		= "kategori_berkas Kegiatan berhasil diperbarui .";


			                 //logs
							$this->load->model('logs_model');
							$this->logs_model->user_id	 = $this->session->userdata('user_id');
		                	$this->logs_model->activity = "has been update instansi";
		                	$this->logs_model->category = "add";
		                	$desc = $_POST['kategori_berkas'];
		                	$this->logs_model->description = "with names ".$desc;
							$this->logs_model->insert();
			}

			$this->ref_kategori_berkas_model->id_kategori_berkas = $id_kategori_berkas;
			$get = $this->ref_kategori_berkas_model->get_by_id();
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
		
			$this->load->model('ref_kategori_berkas_model');
			$this->ref_kategori_berkas_model->id_kategori_berkas = $id;
			$this->ref_kategori_berkas_model->delete();
			redirect('ref_kategori_berkas');
		}
		else
		{
			redirect('home');
		}
	}
}
?>