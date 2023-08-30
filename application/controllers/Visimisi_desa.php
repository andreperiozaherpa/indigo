<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Visimisi_desa extends CI_Controller
{
	public $user_id;

	public function __construct()
	{
		parent::__construct();
		$this->user_id = $this->session->userdata('user_id');
		$this->load->model('user_model');
		$this->user_model->user_id = $this->user_id;
		$this->user_model->set_user_by_user_id();
		$this->user_picture = $this->user_model->user_picture;
		$this->full_name	= $this->user_model->full_name;
		$this->user_level	= $this->user_model->level;
		$this->load->model('skpd_model');
		$this->load->model('ref_skpd_model');
		$this->load->model('rpjmdesa_model');
		$this->load->model('ref_unit_kerja_model');
		$this->load->model('sakip_desa/visimisi_desa_model');
		$this->session->set_userdata('id_skpd',140);
		$this->level_id	= $this->user_model->level_id;
		if ($this->level_id > 2) redirect("admin");
	}

	public function index()
	{
		if ($this->user_id) {
			$data['title']		= "Visi, Misi, dan Tujuan Desa";
			$data['content']	= "visimisi_desa/index";
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "visimisi_desa";
			$data['id_skpd'] = $this->session->userdata('id_skpd');
			$data['visi'] = $this->visimisi_desa_model->get_visi($data['id_skpd']);
			$data['misi'] = $this->visimisi_desa_model->get_misi($data['id_skpd']);
			$data['tujuan'] = $this->visimisi_desa_model->get_tujuan($data['id_skpd']);
			$this->load->view('admin/index', $data);
		} else {
			redirect('admin');
		}
	}

	public function getVisi($id_skpd)
	{
		$get = $this->visimisi_desa_model->get_visi($id_skpd);
		echo json_encode($get);
	}

	public function updateVisi($id_skpd){
		if(!empty($_POST)){
			$insert = $this->visimisi_desa_model->update_visi($id_skpd,$_POST);
			$res = array('status'=>true);
		}else{
			$res = array('status'=>false);
		}
		echo json_encode($res);
	}

	public function fetchMisi($id_misi){
		$get = $this->visimisi_desa_model->get_misi_by_id($id_misi);
		echo json_encode($get);
	}

	public function insertMisi($id_skpd){
		$insert = $this->visimisi_desa_model->insert_misi($id_skpd,$_POST);
		echo json_encode(array('status'=>true));
	}

	public function updateMisi(){
		if(!empty($_POST)){
			$insert = $this->visimisi_desa_model->update_misi($_POST);
			$res = array('status'=>true);
		}else{
			$res = array('status'=>false);
		}
		echo json_encode($res);
	}
	public function deleteMisi($id_misi){
		$get = $this->visimisi_desa_model->delete_misi($id_misi);
		echo json_encode(array('status'=>true));
	}
}
