<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ref_instansi extends CI_Controller {
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

		$this->user_privileges	= $this->user_model->user_privileges;
		$array_privileges = explode(';', $this->user_privileges);

			if (($this->user_level!="Administrator" && $this->user_level!="Admin Web") ) redirect ('welcome');
	}
	public function index()
	{
		if ($this->user_id)
		{
			$data['title']		= "Ref. Instansi - ". app_name;
			$data['content']	= "ref_instansi/index" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "ref_instansi";

			$this->load->model('ref_instansi_model');


			if (!empty($_POST)){
            	$this->ref_instansi_model->nama_instansi = $_POST['nama_instansi'];
            	$this->ref_instansi_model->telepon = $_POST['telepon'];
            	$this->ref_instansi_model->email = $_POST['email'];
            	$this->ref_instansi_model->website = $_POST['website'];
            	$this->ref_instansi_model->keterangan = $_POST['keterangan'];
            	if($_POST['level']!==''){
            		$this->ref_instansi_model->level = $_POST['level'];
            	}
            	if($_POST['id_koordinator']!==''){
            		$this->ref_instansi_model->id_koordinator = $_POST['id_koordinator'];
            	}
			}


			$data['koordinator'] = $this->ref_instansi_model->get_all();

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
			$data['title']		= "Tambah Instansi - ". app_name;
			$data['content']	= "ref_instansi/add" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "ref_instansi";

			$this->load->model('ref_instansi_model');
			$data['koordinator'] = $this->ref_instansi_model->get_all();

			$this->load->helper('form');
			if (!empty($_POST))
			{

						$config['upload_path']          = './data/images/instansi/';
			            $config['allowed_types']        = 'gif|jpg|png';
			            $config['max_size']             = 2000;
			            $config['max_width']            = 2000;
			            $config['max_height']           = 2000;

	                	$logo = "image.png";

			            $this->load->library('upload', $config);
			            if ( ! $this->upload->do_upload('logo'))
		                {
		                    $data['message_type'] = "warning";
		                    $data['message']			= $this->upload->display_errors();
		                }
		                else
		                {
		                	$logo = $this->upload->data('file_name');
		                }

		                	$this->ref_instansi_model->nama_instansi = $_POST['nama_instansi'];
		                	$this->ref_instansi_model->telepon = $_POST['telepon'];
		                	$this->ref_instansi_model->email = $_POST['email'];
		                	$this->ref_instansi_model->website = $_POST['website'];
		                	$this->ref_instansi_model->keterangan = $_POST['keterangan'];
		                	$this->ref_instansi_model->logo = $logo;
		                	$this->ref_instansi_model->status = $_POST['status'];
		                	$this->ref_instansi_model->level = $_POST['level'];
		                	if(empty($_POST['id_koordinator'])){
		                		$id = 0;
		                	}else{
		                		$id = $_POST['id_koordinator'];
		                	}
		                	$this->ref_instansi_model->id_koordinator = $id;	
							$this->ref_instansi_model->insert();
			                $data['message_type'] = "success";
			                $data['message']		= "Instansi berhasil ditambahkan.";


			                 //logs
							$this->load->model('logs_model');
							$this->logs_model->user_id	 = $this->session->userdata('user_id');
		                	$this->logs_model->activity = "has been add instansi";
		                	$this->logs_model->category = "add";
		                	$desc = $_POST['nama_instansi'];
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

	public function edit($id_instansi)
	{
		if ($this->user_id)
		{
			
			$data['title']		= "Edit Instansi - ". app_name;
			$data['content']	= "ref_instansi/edit" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			
			$data['active_menu'] = "ref_instansi";

			$this->load->model('ref_instansi_model');
			$this->load->helper('form');
			if (!empty($_POST))
			{


						if($_FILES['logo']['name']!==''){
							$config['upload_path']          = './data/images/instansi/';
				            $config['allowed_types']        = 'gif|jpg|png';
				            $config['max_size']             = 2000;
				            $config['max_width']            = 2000;
				            $config['max_height']           = 2000;

		                	$logo = "image.png";

				            $this->load->library('upload', $config);
				            if ( ! $this->upload->do_upload('logo'))
			                {
			                    $data['message_type'] = "warning";
			                    $data['message']			= $this->upload->display_errors();
			                }
			                else
			                {
			                	$logo = $this->upload->data('file_name');
		                		$this->ref_instansi_model->logo = $logo;
			                }
		            	}

		                	$this->ref_instansi_model->id_instansi = $id_instansi;
		                	$this->ref_instansi_model->nama_instansi = $_POST['nama_instansi'];
		                	$this->ref_instansi_model->telepon = $_POST['telepon'];
		                	$this->ref_instansi_model->email = $_POST['email'];
		                	$this->ref_instansi_model->website = $_POST['website'];
		                	$this->ref_instansi_model->keterangan = $_POST['keterangan'];
		                	$this->ref_instansi_model->status = $_POST['status'];
		                	$this->ref_instansi_model->level = $_POST['level'];
		                	if(empty($_POST['id_koordinator'])){
		                		$id = 0;
		                	}else{
		                		$id = $_POST['id_koordinator'];
		                	}
		                	$this->ref_instansi_model->id_koordinator = $id;	
							$this->ref_instansi_model->update();
			                $data['message_type'] = "success";
			                $data['message']		= "Instansi berhasil diperbarui.";


			                 //logs
							$this->load->model('logs_model');
							$this->logs_model->user_id	 = $this->session->userdata('user_id');
		                	$this->logs_model->activity = "has been update instansi";
		                	$this->logs_model->category = "add";
		                	$desc = $_POST['nama_instansi'];
		                	$this->logs_model->description = "with names ".$desc;
							$this->logs_model->insert();
			}

			$this->ref_instansi_model->id_instansi = $id_instansi;
			$get = $this->ref_instansi_model->get_by_id();
			$data['data'] = $get;
			$data['koordinator'] = $this->ref_instansi_model->get_all();
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
		
			$this->load->model('ref_instansi_model');
			$this->ref_instansi_model->id_instansi = $id;
			$this->ref_instansi_model->delete();
			redirect('ref_instansi');
		}
		else
		{
			redirect('home');
		}
	}
}
?>