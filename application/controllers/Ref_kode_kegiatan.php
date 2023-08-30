<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ref_kode_kegiatan extends CI_Controller {
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

		$this->load->model('ref_kode_kegiatan_model','ref_kode_kegiatan_m');
	}
	public function index()
	{
		if ($this->user_id)
		{
			$data['title']		= "ref_kode_kegiatan - Admin ";
			$data['content']	= "ref_kode_kegiatan/index" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "ref_kode_kegiatan";

			if(!empty($_POST)){
				$this->ref_kode_kegiatan_m->nama_lokasi = $_POST['nama_lokasi'];
				$this->ref_kode_kegiatan_m->kode_kegiatan = $_POST['kode_kegiatan'];
			}
			$data['item'] = $this->ref_kode_kegiatan_m->get_all();
			$this->load->view('admin/index',$data);


		}
		else
		{
			redirect('admin');
		}
	}

	public function add(){
		$data['title']		= "Tambah ref_kode_kegiatan - Admin ";
		$data['content']	= "ref_kode_kegiatan/add" ;
		$data['user_picture'] = $this->user_picture;
		$data['full_name']		= $this->full_name;
		$data['user_level']		= $this->user_level;
		$data['active_menu'] = "ref_kode_kegiatan";

		if(!empty($_POST)){
			$in = $this->ref_kode_kegiatan_m->insert($_POST);
			redirect('ref_kode_kegiatan');
		}
		$this->load->model('ref_wilayah_model');
		$data['provinsi'] = $this->ref_wilayah_model->get_provinsi();

		$this->load->view('admin/index',$data);
	}

	public function view()
	{
		if ($this->user_id)
		{

			$data['title']		= "ref_kode_kegiatan - Admin ";
			$data['content']	= "ref_pendidikan/view" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "ref_pendidikan";
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
			{$data['title']		= "ref_kode_kegiatan - Admin ";
		$data['content']	= "ref_kode_kegiatan/edit" ;
		$data['user_picture'] = $this->user_picture;
		$data['full_name']		= $this->full_name;
		$data['user_level']		= $this->user_level;
		$data['active_menu'] = "ref_kode_kegiatan";
		
		$id = $this->uri->segment(3);
		if(empty($id)){
			redirect(base_url('ref_kode_kegiatan'));
		}
		
		$data['item'] = $this->ref_kode_kegiatan_m->select_by_id($id);
		$this->load->model('ref_wilayah_model');
		$data['provinsi'] = $this->ref_wilayah_model->get_provinsi();
		$data['kabupaten'] = $this->ref_wilayah_model->get_kabupaten($data['item']->id_kabupaten_kegiatan);
		$data['kecamatan'] = $this->ref_wilayah_model->get_kecamatan($data['item']->id_kecamatan_kegiatan);
		$data['desa'] = $this->ref_wilayah_model->get_desa($data['item']->id_desa_kegiatan);
		
		if(empty($data['item'])){
			redirect(base_url('ref_kode_kegiatan'));
		}

		if(!empty($_POST)){
			$in = $this->ref_kode_kegiatan_m->update($_POST,$id);
			redirect('ref_kode_kegiatan');
		}

		
		
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
		redirect(base_url('ref_kode_kegiatan'));
	}
	$data = $this->input->post();
	$this->ref_kode_kegiatan_m->update($data,$id);
	redirect(base_url('ref_kode_kegiatan'));
}

public function delete($id)
{
	if ($this->user_id)
	{
		$this->ref_kode_kegiatan_m->delete($id);
	}
	else
	{
		redirect('home');
	}
}

public function get_kabupaten($id){
	$obj = '<option value="">-- Pilih Kabupaten --</option>';
	$this->load->model('ref_wilayah_model');
	$data = $this->ref_wilayah_model->get_kabupaten(null,$id);
	foreach($data as $row){
		$obj .= "<option value='".$row->id_kabupaten."'>$row->kabupaten</option>";
	}
	die ($obj);
}
public function get_kecamatan($id){
	$obj = '<option value="">-- Pilih Kecamatan --</option>';
	$this->load->model('ref_wilayah_model');
	$data = $this->ref_wilayah_model->get_kecamatan(null,$id);
	foreach($data as $row){
		$obj .= "<option value='".$row->id_kecamatan."'>$row->kecamatan</option>";
	}
	die ($obj);
}
public function get_desa($id){
	$obj = '<option value="">-- Pilih Desa --</option>';
	$this->load->model('ref_wilayah_model');
	$data = $this->ref_wilayah_model->get_desa(null,$id);
	foreach($data as $row){
		$obj .= "<option value='".$row->id_desa."'>$row->desa</option>";
	}
	die ($obj);
}
}
?>