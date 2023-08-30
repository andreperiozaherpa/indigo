<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ref_tempatpendidikan extends CI_Controller {
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
		if ($this->user_level=="Admin Web"); 
	}
	public function index()
	{
		if ($this->user_id)
		{
			
			$data['title']		= "Ref Pendidikan - Admin ";
			$data['content']	= "ref_tempatpendidikan/index" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "ref_tempatpendidikan";
			
			$this->load->model('ref_tempatpendidikan_model');
			$this->load->model('ref_pendidikan_model');
			$data['arr_level' ] = $this->ref_pendidikan_model->arr_level;
			
			
			$offset = 0;
			$limit = $data['per_page']	= 30;
			if (!empty($_GET['per_page'])) $offset = $_GET['per_page'] ;
			$data['result'] = $this->ref_tempatpendidikan_model->get_for_page($limit,$offset);
			$data['all_result'] = $this->ref_tempatpendidikan_model->get_for_page();
			
			$data['total_rows']	= count($data['all_result']);
			$data['offset']	= $offset;
			
			$this->load->view('admin/index',$data);
			


		}
		else
		{
			redirect('admin');
		}
	}
	
	public function add(){
		$this->load->model('ref_tempatpendidikan_model');
				        $this->ref_tempatpendidikan_model->nama_tempatpendidikan = $_POST['nama_tempatpendidikan'];
		                $this->ref_tempatpendidikan_model->status = $_POST['status'];
						$this->ref_tempatpendidikan_model->level= $_POST['level'];
		                $this->ref_tempatpendidikan_model->insert();
						
		                $data['message_type'] = "success";
		                $data['message']		= "Sekolah berhasil disimpan.";
						redirect(base_url('ref_tempatpendidikan'));
	}
	
	
	
	public function edit($id)
	{
		$this->load->model('ref_tempatpendidikan_model');
		$this->load->model('ref_pendidikan_model');
		
		if ($this->user_id)
		{
			
			$data['title']		= " Ref Sekolah - ". app_name;
			$data['content']	= "ref_tempatpendidikan/edit" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['arr_level' ] = $this->ref_pendidikan_model->arr_level;

			$this->ref_tempatpendidikan_model->id_tempatpendidikan = $id;
			
			if (!empty($_POST))
			{
				
				if ($_POST['nama_tempatpendidikan'] !="" &&
					$_POST['status'] !="" && $_POST['level'] !="" )
				{
					
		                $this->ref_tempatpendidikan_model->nama_tempatpendidikan = $_POST['nama_tempatpendidikan'];
		                $this->ref_tempatpendidikan_model->status = $_POST['status'];
		                $this->ref_tempatpendidikan_model->level = $_POST['level'];
						$this->ref_tempatpendidikan_model->update();
		                $data['message_type'] = "success";
		                $data['message']		= "Sekolah berhasil diubah.";
	           		
				}
				else
				{
					$data['message_type'] = "warning";
					$data['message'] = "<strong>Opps..</strong> Data belum lengkap!";
				}
			}
			
			$this->ref_tempatpendidikan_model->set_by_id();
			$data['nama_tempatpendidikan'] = $this->ref_tempatpendidikan_model->nama_tempatpendidikan;
			$data['status'] = $this->ref_tempatpendidikan_model->status;
			$data['level'] = $this->ref_tempatpendidikan_model->level;
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
			$this->ref_tempatpendidikan->id_tempatpendidikan = $id;
			$this->ref_tempatpendidikan->delete();
			redirect('ref_tempatpendidikan');
		}
		else
		{
			redirect('admin');
		}
	}
}
?>