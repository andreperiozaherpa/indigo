<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manage_agenda extends CI_Controller {
	public $user_id;

	public function __construct(){
		parent ::__construct();	
		$this->user_id = $this->session->userdata('user_id');
		$this->load->model('agenda_model');
		$this->load->model('user_model');
		$this->user_model->user_id = $this->user_id;
		$this->user_model->set_user_by_user_id();
		$this->user_picture = $this->user_model->user_picture;
		$this->full_name	= $this->user_model->full_name;
		$this->user_level	= $this->user_model->level;
		$this->user_privileges	= $this->user_model->user_privileges;
		$array_privileges = explode(';', $this->user_privileges);

		if (($this->user_level!="Administrator" && $this->user_level!="Admin Web") && !in_array('event', $array_privileges)) redirect ('welcome');
	}
	public function index()
	{
		if ($this->user_id)
		{
			
			$data['title']		= "Agenda - ". app_name;
			$data['content']	= "agenda/index" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			
			$data['query']		= $this->agenda_model->get_all();
			$data['active_menu'] = "agenda";
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
			
			$data['title']		= "Tambah Agenda - ". app_name;
			$data['content']	= "agenda/add" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			
			$data['active_menu'] = "agenda";
			if (!empty($_POST))
			{
				if ($_POST['tema'] !="" &&
					$_POST['isi_agenda'] !="" &&
					$_POST['tempat'] !="" &&
					$_POST['pengirim'] !="" &&
					$_POST['tgl_mulai'] !="" &&
					$_POST['tgl_selesai'] !="" &&
					$_POST['jam'] !="" )
				{
					$avaliable = $this->agenda_model->check_availability("",$_POST['tema']);
					if ($avaliable){
						$config['upload_path']          = './data/agenda/';
			            $config['allowed_types']        = '*';
			            $config['max_size']             = 10000;
			            //$config['max_width']            = 10000;
			            //$config['max_height']           = 10000;

			            $this->load->library('upload', $config);
			            if ( ! $this->upload->do_upload())
		                {
		                    $data['message_type'] = "warning";
		                    $data['message']			= $this->upload->display_errors();
		                }
		                else
		                {
		                $this->agenda_model->nama_file = $this->upload->data('file_name');
	            		}

		                $this->agenda_model->tema = $_POST['tema'];
		                $this->agenda_model->tema_slug = $_POST['tema_slug'];
		                $this->agenda_model->isi_agenda = $_POST['isi_agenda'];
		                $this->agenda_model->tempat = $_POST['tempat'];
		                $this->agenda_model->pengirim = $_POST['pengirim'];
		                $this->agenda_model->penerima = implode(",", $_POST['penerima']);
		                $this->agenda_model->tgl_mulai= $_POST['tgl_mulai'];
		                $this->agenda_model->tgl_selesai = $_POST['tgl_selesai'];
		                $this->agenda_model->jam = $_POST['jam'];
		                $this->agenda_model->user_id = $this->user_id;
		                $this->agenda_model->insert();
		                $data['message_type'] = "success";
		                $data['message']		= "Agenda berhasil ditambahkan.";

		                //logs
						$this->load->model('logs_model');
						$this->logs_model->user_id	 = $this->session->userdata('user_id');
	                	$this->logs_model->activity = "telah menambahkan agenda";
	                	$this->logs_model->category = "add";
	                	$desc = $_POST['tema'];
	                	$this->logs_model->description = "with names ".$desc;
						$this->logs_model->insert();
						

	           		}
	           		else{
	           			$data['message_type'] = "danger";
						$data['message'] = "<strong>Opps..</strong>Tema agenda sudah ada.";
	           		}
				}
				else
				{
					$data['message_type'] = "warning";
					$data['message'] = "<strong>Opps..</strong> Data belum lengkap. silahkan lengkapi dulu!";
				}
			}

			$this->load->model('ref_instansi_model');
			$data['instansi_penerima']		= $this->ref_instansi_model->get_all_instansi();

			$this->load->view('admin/index',$data);

		}
		else
		{
			redirect('admin');
		}
	}

	public function edit($id_agenda)
	{
		if ($this->user_id)
		{
			
			$data['title']		= "Edit Agenda - ". app_name;
			$data['content']	= "agenda/edit" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			
			
			$data['active_menu'] = "agenda";
			$this->agenda_model->id_agenda = $id_agenda;
			if (!empty($_POST))
			{
				if ($_POST['tema'] !="" &&
					$_POST['isi_agenda'] !="" &&
					$_POST['tempat'] !="" &&
					$_POST['pengirim'] !="" &&
					$_POST['tgl_mulai'] !="" &&
					$_POST['tgl_selesai'] !="" &&
					$_POST['jam'] !="" )
				{
					$avaliable = $this->agenda_model->check_availability($_POST['old_tema'],$_POST['tema']);
					if ($avaliable){

						$config['upload_path']          = './data/agenda/';
			            $config['allowed_types']        = '*';
			            $config['max_size']             = 10000;
			            //$config['max_width']            = 10000;
			            //$config['max_height']           = 10000;

			            $this->load->library('upload', $config);
			            if ( ! $this->upload->do_upload())
		                {
		                    $data['message_type_file'] = "warning";
		                    $data['message_file']			= $this->upload->display_errors();
		                    $this->agenda_model->nama_file = $_POST['old_file'];
		                }
		                else
		                {
		                	$this->agenda_model->nama_file = $this->upload->data('file_name');
		                }
		                $this->agenda_model->tema = $_POST['tema'];
		                $this->agenda_model->tema_slug = $_POST['tema_slug'];
		                $this->agenda_model->isi_agenda = $_POST['isi_agenda'];
		                $this->agenda_model->tempat = $_POST['tempat'];
		                $this->agenda_model->pengirim = $_POST['pengirim'];
		                $this->agenda_model->penerima = implode(",", $_POST['penerima']);
		                $this->agenda_model->tgl_mulai= $_POST['tgl_mulai'];
		                $this->agenda_model->tgl_selesai = $_POST['tgl_selesai'];
		                $this->agenda_model->jam = $_POST['jam'];
		                $this->agenda_model->user_id = $this->user_id;
		                $this->agenda_model->update();
		                $data['message_type'] = "success";
		                $data['message']		= "Agenda telah berhasil diperbarui.";

		                 //logs
						$this->load->model('logs_model');
						$this->logs_model->user_id	 = $this->session->userdata('user_id');
	                	$this->logs_model->activity = "telah memperbarui agenda";
	                	$this->logs_model->category = "update";
	                	$desc = $_POST['tema'];
	                	$this->logs_model->description = "dengan nama ".$desc;
						$this->logs_model->insert();


	           		}
	           		else{
	           			$data['message_type'] = "danger";
						$data['message'] = "<strong>Opps..</strong> Agenda sudah ada.";
	           		}
				}
				else
				{
					$data['message_type'] = "warning";
					$data['message'] = "<strong>Opps..</strong> Data belum lengkap. silahkan lengkapi dulu!";
				}
			}
			$this->agenda_model->set_by_id();
			$data['tema'] = $this->agenda_model->tema;
			$data['tema_slug'] = $this->agenda_model->tema_slug;
			$data['isi_agenda'] = $this->agenda_model->isi_agenda;
			$data['tempat'] = $this->agenda_model->tempat;
			$data['pengirim'] = $this->agenda_model->pengirim;
			$data['penerima'] = $this->agenda_model->penerima;
			$data['tgl_mulai'] = $this->agenda_model->tgl_mulai;
			$data['tgl_selesai'] = $this->agenda_model->tgl_selesai;
			$data['jam'] = $this->agenda_model->jam;
			$data['nama_file'] = $this->agenda_model->nama_file;

			$this->load->model('ref_instansi_model');
			$data['instansi_penerima']		= $this->ref_instansi_model->get_all_instansi();

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
			
			$this->agenda_model->id_agenda = $id;
			$this->agenda_model->delete();
			redirect('manage_agenda');
		}
		else
		{
			redirect('home');
		}
	}
}
?>