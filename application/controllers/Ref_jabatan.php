<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ref_jabatan extends CI_Controller {
	public $user_id;

	public function __construct(){
		parent ::__construct();
		$this->user_id = $this->session->userdata('user_id');
		$this->load->model('user_model');
		$this->load->model('ref_jabatan_model');
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
			$data['title']		= "Ref. Jabatan - Admin ";
			$data['content']	= "ref_jabatan/index" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "ref_jabatan";

			$data['jabatan'] = $this->ref_jabatan_model->get_all_ref();

			$this->load->view('admin/index',$data);


		}
		else
		{
			redirect('admin');
		}
	}

	public function fetch_ref($id){
		$misi = $this->ref_jabatan_model->select_by_id_ref($id);
		echo json_encode($misi);
	}
	public function p_update_ref(){
		$id_ref = $_POST['id_ref'];
		unset($_POST['id_ref']);
		unset($_POST['_wysihtml5_mode']);
		$this->ref_jabatan_model->update_ref($_POST,$id_ref);
		echo json_encode(array('status'=>true));
	}
	public function p_add_ref()
	{
		unset($_POST['_wysihtml5_mode']);
		$this->ref_jabatan_model->insert_ref($_POST);
		echo json_encode(array('status'=>true));
	}
	public function delete_ref($id){
		if ($this->session->userdata('level') == 'Administrator') {
		$this->ref_jabatan_model->delete_ref($id);
		echo json_encode(array('status'=>true));
		}
	}

}
?>
