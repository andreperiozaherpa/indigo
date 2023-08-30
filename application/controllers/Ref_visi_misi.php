<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ref_visi_misi extends CI_Controller {
	public $user_id;

	public function __construct(){
		parent ::__construct();
		$this->user_id = $this->session->userdata('user_id');
		$this->load->model('user_model');
		$this->load->model('ref_visi_misi_model');
		$this->user_model->user_id = $this->user_id;
		$this->user_model->set_user_by_user_id();
		$this->user_picture = $this->user_model->user_picture;
		$this->full_name	= $this->user_model->full_name;
		$this->user_level	= $this->user_model->level;
		if ($this->user_level=="Admin Web");

		//$this->load->model('Ref_renstra','ref_kode_kegiatan_m');
	}
	public function index()
	{
		if ($this->user_id)
		{
			$data['title']		= "Visi Misi - Admin ";
			$data['content']	= "ref_visi_misi/index" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "ref_visi_misi";

			$data['visi'] = $this->ref_visi_misi_model->get_visi();
			$data['misi'] = $this->ref_visi_misi_model->get_all_m();
			$data['tujuan'] = $this->ref_visi_misi_model->get_all_t();

			//if(!empty($_POST)){
			//	$this->ref_kode_kegiatan_m->nama_lokasi = $_POST['nama_lokasi'];
			//	$this->ref_kode_kegiatan_m->kode_kegiatan = $_POST['kode_kegiatan'];
			//}
			//$data['item'] = $this->ref_kode_kegiatan_m->get_all();
			$this->load->view('admin/index',$data);


		}
		else
		{
			redirect('admin');
		}
	}


	public function get_visi(){
		$visi = $this->ref_visi_misi_model->get_visi();
		echo json_encode($visi);
	}

	public function save_visi(){
		$this->ref_visi_misi_model->update_v(array('visi'=>$_POST['visi']),$_POST['id_visi']);
		echo json_encode(array('status'=>true));
	}

	public function fetch_misi($id){
		$misi = $this->ref_visi_misi_model->select_by_id_m($id);
		echo json_encode($misi);
	}
	public function p_update_m(){
		$this->ref_visi_misi_model->update_m(array('misi'=>$_POST['misi']),$_POST['id_misi']);
		echo json_encode(array('status'=>true));
	}
	public function p_add_m(){
		$this->ref_visi_misi_model->insert_m(array('misi'=>$_POST['misi']));
		echo json_encode(array('status'=>true));
	}
	public function delete_m($id){
		$this->ref_visi_misi_model->delete_m($id);
		echo json_encode(array('status'=>true));
	}


	public function fetch_tujuan($id){
		$tujuan = $this->ref_visi_misi_model->select_by_id_t($id);
		echo json_encode($tujuan);
	}
	public function p_update_t(){
		$this->ref_visi_misi_model->update_t(array('tujuan'=>$_POST['tujuan'],'id_misi'=>$_POST['id_misi']),$_POST['id_tujuan']);
		echo json_encode(array('status'=>true));
	}
	public function p_add_t(){
		$this->ref_visi_misi_model->insert_t(array('tujuan'=>$_POST['tujuan'],'id_misi'=>$_POST['id_misi']));
		echo json_encode(array('status'=>true));
	}
	public function delete_t($id){
		$this->ref_visi_misi_model->delete_t($id);
		echo json_encode(array('status'=>true));
	}

}
?>
