<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Persyaratan extends CI_Controller {
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

		$this->load->model("talenta/persyaratan_model");

		$user_privileges = explode(";", $this->session->userdata('user_privileges'));
		if ($this->user_level=="Administrator" OR in_array('talenta', $user_privileges) ){

		} 
		else{
			redirect ('welcome');
		}
	}
	public function index()
	{		if ($this->user_id)
		{
			$data['title']		= "Ref. Persyaratan - Manajemen Talenta";
			$data['content']	= "talenta/ref_persyaratan/index" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "ref_persyaratan";
			$param = null;
			$keyword=null;
			if($_POST)
			{
				if($this->input->post("eselon")!="")
					$param['eselon'] = $this->input->post("eselon");

				$keyword = $this->input->post("persyaratan");
				$data = array_merge($data,$_POST);
			}
			$data['dt_persyaratan'] = $this->persyaratan_model->get($param,$keyword);

			if($this->session->flashdata("message_success")){
				$data["message_success"]  = $this->session->flashdata("message_success");
			}
			if($this->session->flashdata("message_error")){
				$data["message_error"]  = $this->session->flashdata("message_error");
			}

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
			if($this->session->flashdata("message_success")){
				$data["message_success"]  = $this->session->flashdata("message_success");
			}
			if($this->session->flashdata("message_error")){
				$data["message_error"]  = $this->session->flashdata("message_error");
			}

			$data['title']		= "Tambah Persyaratan - Manajemen Talenta";
			$data['content']	= "talenta/ref_persyaratan/add" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			//$data['active_menu'] = "ref_persyaratan";

			$this->load->library('form_validation');
			if(!empty($_POST))
			{
				$this->form_validation->set_rules(
					'eselon',
					'Eselon',
					'required|in_list[I,II,III,IV]',
					[
						'required' => '%s harus diisi',
						'in_list'	=> '%s tidak valid',
					]
				);
				$this->form_validation->set_rules(
					'persyaratan',
					'Persyaratan',
					'required',
					[
						'required' => '%s harus diisi',
					]
				);

				if($this->form_validation->run() ==true) {
					
					$insert = array();
					foreach($_POST as $key=>$value)
					{
						$insert[$key] = $this->security->xss_clean($value);
					}
					//echo "<pre>";print_r($insert);die;
					$this->persyaratan_model->insert($insert);	
					
					$this->session->set_flashdata("message_success","Persyaratan berhasil ditambahkan.");
					redirect("talenta/persyaratan/add");

				}
				else{
					$data = array_merge($data,$_POST);
				}
			}
			$this->load->view('admin/index',$data);

		}
		else
		{
			redirect('admin');
		}
	}

	public function edit($id_persyaratan=null)
	{		
		if ($this->user_id)
		{
			if($this->session->flashdata("message_success")){
				$data["message_success"]  = $this->session->flashdata("message_success");
			}
			if($this->session->flashdata("message_error")){
				$data["message_error"]  = $this->session->flashdata("message_error");
			}

			$param = array("id_persyaratan" => $id_persyaratan);
			$detail = $this->persyaratan_model->get($param);

			if($id_persyaratan!=null && $detail){

				$data['title']		= "Edit Persyaratan - Manajemen Talenta";
				$data['content']	= "talenta/ref_persyaratan/edit" ;
				$data['user_picture'] = $this->user_picture;
				$data['full_name']		= $this->full_name;
				$data['user_level']		= $this->user_level;
				$data['active_menu'] = "ref_persyaratan";
				
				$data['persyaratan'] = $detail[0]->persyaratan;
				$data['deskripsi'] = $detail[0]->deskripsi;
				$data['eselon'] = $detail[0]->eselon;

				$this->load->library('form_validation');
				if(!empty($_POST))
				{
					/*
					$this->form_validation->set_rules(
						'eselon',
						'Eselon',
						'required|in_list[I,II,III,IV]',
						[
							'required' => '%s harus diisi',
							'in_list'	=> '%s tidak valid',
						]
					);
					*/
					$this->form_validation->set_rules(
						'persyaratan',
						'Persyaratan',
						'required',
						[
							'required' => '%s harus diisi',
						]
					);

					if($this->form_validation->run() ==true) {
						
						$update = array();
						foreach($_POST as $key=>$value)
						{
							$update[$key] = $this->security->xss_clean($value);
						}
						//echo "<pre>";print_r($insert);die;
						$this->persyaratan_model->update($update,$id_persyaratan);	
						
						$this->session->set_flashdata("message_success","Persyaratan berhasil diubah.");
						redirect("talenta/persyaratan/edit/".$id_persyaratan);

					}
					else{
						$data = array_merge($data,$_POST);
					}
				}
				$this->load->view('admin/index',$data);
			}
			else{
				show_404();
			}
		}
		else
		{
			redirect('admin');
		}
	}

	public function delete($id_persyaratan=null)
	{
		//var_dump($id_persyaratan);die;
		if($this->user_id && $id_persyaratan!=null){
			
			$success = $this->persyaratan_model->delete($id_persyaratan);
			if($success)
				$this->session->set_flashdata("message_success","Persyaratan berhasil dihapus.");
			else
				$this->session->set_flashdata("message_error","Persyaratan gagal dihapus.");
			redirect("/talenta/persyaratan");
		}
		else{
			redirect("admin");
		}
		
	}
}
?>