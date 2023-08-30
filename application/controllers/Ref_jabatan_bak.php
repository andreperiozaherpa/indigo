<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ref_jabatan extends CI_Controller {
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
		
		$this->load->model('ref_jabatan_model','jabatan_m'); 
		$this->arr_jenis_jabatan = $this->jabatan_m->arr_jenis_jabatan;
		$this->arr_level_jabatan = $this->jabatan_m->arr_level_jabatan;
		
		$this->level_id	= $this->user_model->level_id;
		if ($this->level_id >2 ) redirect("admin");
	}
	public function index()
	{
		if ($this->user_id)
		{
			$data['title']		= "jabatan - Admin ";
			$data['content']	= "ref_jabatan/index" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "ref_jabatan";

			//$data['item'] = $this->jabatan_m->get_all();
			// $offset = 0;
			// if (!empty($_GET['per_page'])) $offset = $_GET['per_page'] ;
			$data['result'] = $this->jabatan_m->getAll(1);
			// $data['per_page']	= 25;
			// $data['total_rows']	= count($data['result']);
			// $data['offset']	= $offset;
			$data['arr_jenis_jabatan'] = $this->arr_jenis_jabatan;
			$data['arr_level_jabatan'] = $this->arr_level_jabatan;
			$this->load->model('ref_unit_kerja_model');
			$data['arr_unit_kerja'] = $this->ref_unit_kerja_model->get_all();
			$this->load->view('admin/index',$data);


		}
		else
		{
			redirect('admin');
		}
	}

	public function add(){
		$data = $this->input->post();
		$data['id_induk'] = 0;
		$data['jenis_jabatan'] = 1;
		$data['ket_induk'] = '';
		$cek_kepala = $this->jabatan_m->cek_kepala($data);
		if ($cek_kepala > 0 AND $data['level_jabatan'] == 1) {
			$this->session->set_flashdata('t_msg', "error");
			$this->session->set_flashdata('h_msg', "Tambah data");
			$this->session->set_flashdata('msg', "Error! Kepala Jabatan telah terdaftar.");
		} else {
			$this->jabatan_m->insert($data);
			$this->session->set_flashdata('t_msg', "success");
			$this->session->set_flashdata('h_msg', "Tambah data");
			$this->session->set_flashdata('msg', "Success! Jabatan berhasil ditambahkan.");
		}
		redirect(base_url('ref_jabatan'));
	}

	public function view()
	{
		if ($this->user_id)
		{
			
			$data['title']		= "jabatan - Admin ";
			$data['content']	= "ref_jabatan/view" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "ref_jabatan";
			$this->load->view('admin/index',$data);

		}
		else
		{
			redirect('admin');
		}
	}

	public function edit()
	{
		if ($this->user_id)
		{
			$id = $this->uri->segment(3);
	        if(empty($id)){
	            redirect(base_url('ref_jabatan'));
	        }

	        $data['item'] = $this->jabatan_m->select_by_id($id);
	        
	        if(empty($data['item'])){
	            redirect(base_url('ref_jabatan'));
	        }
			
			$data['title']		= "jabatan - Admin ";
			$data['content']	= "ref_jabatan/edit" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "ref_jabatan";
			$data['arr_jenis_jabatan'] = $this->arr_jenis_jabatan;
			$data['arr_level_jabatan'] = $this->arr_level_jabatan;
			$this->load->view('admin/index',$data);

		}
		else
		{
			redirect('admin');
		}
	}
	public function tambah_cabang()
	{
		if ($this->user_id)
		{
			
			$id = $this->uri->segment(3);
	        if(empty($id)){
	            redirect(base_url('ref_jabatan'));
	        }
			if (!empty($_POST)){
				$jab = $this->jabatan_m->select_by_id($id);
				$data = $this->input->post();
				$data['id_induk'] = $id;
				$data['id_unit'] = $jab[0]->id_unit;
				$data['level_jabatan'] = ($jab[0]->level_jabatan)+1;
				if($jab[0]->ket_induk!=""){
					$data['ket_induk'] = $jab[0]->ket_induk.$id."|";
				}
				else{
					$data['ket_induk'] = "|".$id."|";
				}
				$data['jenis_jabatan'] = $jab[0]->jenis_jabatan;
				$this->jabatan_m->insert($data);
				redirect(base_url('ref_jabatan'));
			}
			
	        $data['item'] = $this->jabatan_m->select_by_id($id);
	        
	        if(empty($data['item'])){
	            redirect(base_url('ref_jabatan'));
	        }
			
			$data['title']		= "jabatan - Admin ";
			$data['content']	= "ref_jabatan/tambah_cabang" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "ref_jabatan";
			$this->load->view('admin/index',$data);

		}
		else
		{
			redirect('admin');
		}
	}
	public function update(){
		$id = $this->uri->segment(3);
		if(empty($id)){
	            redirect(base_url('ref_jabatan'));
	        }
		$data = $this->input->post();
		$this->jabatan_m->update($data,$id);
		redirect(base_url('ref_jabatan'));
	}

	public function delete($id)
	{
		if ($this->user_id)
		{
			$this->load->model('ref_jabatan_model');
			$this->ref_jabatan_model->id_jabatan = $id;
			$this->ref_jabatan_model->delete();
			
			
		}
		else
		{
			redirect('home');
		}
	}
	public function get_jabatan()
	{
		if (!empty($_POST['jenis_jabatan'])){
			$this->load->model('ref_jabatan_model');
			$data['jabatan'] = $this->ref_jabatan_model->get_all(1,$_POST['jenis_jabatan']);
			
			$response ="<option value=''>Pilih</option>";
			
			foreach($data['jabatan'] as $row){
				$response .= "<option value='$row->id_jabatan'>$row->nama_jabatan</option>";
			}
			die($response);
		}
		
	}
	
	public function get_induk()
	{
		$obj = "";
		if (!empty($_POST['id_induk'])){
			$id_induk = $_POST['id_induk']==9999 ? 0 : $_POST['id_induk'];
			$data = $this->jabatan_m->get_induk($id_induk);
			if (!empty($data)) $obj = "<option value='' selected>Pilih</option>";
			foreach($data as $row){
				$obj .="<option value=".$row->id_jabatan.">".$row->nama_jabatan."</option>";
			}
		}
		die ($obj);
	}
}
?>