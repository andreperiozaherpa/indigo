<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ref_pendidikan extends CI_Controller {
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

		$this->load->model('ref_pendidikan_model','pendidikan_m');
		
		$this->level_id	= $this->user_model->level_id;
		if ($this->level_id >2 ) redirect("admin");
	}
	public function index()
	{
		if ($this->user_id)
		{
			$data['title']		= "Ref Pendikan - Admin ";
			$data['content']	= "ref_pendidikan/index" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "ref_pendidikan";

			$data['item'] = $this->pendidikan_m->get_all();
			$data['arr_level' ] = $this->pendidikan_m->arr_level;
			$this->load->view('admin/index',$data);


		}
		else
		{
			redirect('admin');
		}
	}

	public function add(){
		$data = $this->input->post();
		$this->pendidikan_m->insert($data);
		redirect(base_url('ref_pendidikan'));
	}

	
	public function edit($id_jenjangpendidikan)
	{
		$this->load->model('ref_pendidikan_model');
		
		if ($this->user_id)
		{
			
			$data['title']		= " Ref Pendidikan - ". app_name;
			$data['content']	= "ref_pendidikan/edit" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['arr_level' ] = $this->pendidikan_m->arr_level;
			$data['active_menu'] = "ref_pendidikan";
			$this->ref_pendidikan_model->id_jenjangpendidikan = $id_jenjangpendidikan;
			
			if (!empty($_POST))
			{
				
				if ($_POST['nama_jenjangpendidikan'] !="" &&
					$_POST['status'] !="" )
				{
					
		                $this->ref_pendidikan_model->nama_jenjangpendidikan = $_POST['nama_jenjangpendidikan'];
		                $this->ref_pendidikan_model->status = $_POST['status'];
		                $this->ref_pendidikan_model->keterangan = $_POST['keterangan'];
						$this->ref_pendidikan_model->level = $_POST['level'];
						$this->ref_pendidikan_model->update();
		                $data['message_type'] = "success";
		                $data['message']		= "Jenjang pendidikan berhasil diubah.";
	           		
				}
				else
				{
					$data['message_type'] = "warning";
					$data['message'] = "<strong>Opps..</strong> Data belum lengkap!";
				}
			}
			
			$this->ref_pendidikan_model->set_by_id();
			$data['nama_jenjangpendidikan'] = $this->ref_pendidikan_model->nama_jenjangpendidikan;
			$data['status'] = $this->ref_pendidikan_model->status;
			$data['keterangan'] = $this->ref_pendidikan_model->keterangan;
			$data['level'] = $this->ref_pendidikan_model->level;
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
			$this->load->model('ref_pendidikan_model');
			$this->ref_pendidikan_model->id_jenjangpendidikan = $id;
			$this->ref_pendidikan_model->delete();
			redirect('ref_pendidikan');
		}
		else
		{
			redirect('home');
		}
	}
	
	public function get_sekolah(){
		if (!empty($_POST['id_jenjangpendidikan'])){
			$data = $this->pendidikan_m->get_sekolah($_POST['id_jenjangpendidikan']);
			$respon = "<option value=''>Pilih</option>";
			foreach ($data as $row){
				$respon .= "<option value=$row->id_tempatpendidikan>$row->nama_tempatpendidikan</option>";
			}
			die($respon);
		}
	}
}
?>