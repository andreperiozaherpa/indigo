<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Verifikasi_pekerjaan extends CI_Controller {
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

		$this->load->model('realisasi_pekerjaan_model');
	}
	public function index()
	{
		if ($this->user_id)
		{
			$data['title']		= "Verifikasi pekerjaan - Admin ";
			$data['content']	= "verifikasi_perkerjaan/index" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "verifikasi_perkerjaan";

			$data['query'] = $this->realisasi_pekerjaan_model->get_for_verif();

			$this->load->view('admin/index',$data);

		}
		else
		{
			redirect('admin');
		}
	}

	

	public function view($id_realisasi_pekerjaan)
	{
		if ($this->user_id)
		{
			
			$data['title']		= "Verifikasi Perkerjaan - Admin ";
			$data['content']	= "verifikasi_perkerjaan/view" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "verifikasi_perkerjaan";

			$this->realisasi_pekerjaan_model->id_realisasi_pekerjaan = $id_realisasi_pekerjaan;
			$data['detail'] = $this->realisasi_pekerjaan_model->get_by_id_v();
			$this->load->model('ref_satuan_model');
			$this->ref_satuan_model->id_satuan_kualitas = $data['detail']->id_satuan_kualitas;
			$data['kualitas'] = $this->ref_satuan_model->get_by_id()->nama_satuan;
			$this->ref_satuan_model->id_satuan_kuantitas = $data['detail']->id_satuan_kuantitas;
			$data['kuantitas'] = $this->ref_satuan_model->get_by_id()->nama_satuan;
			$this->ref_satuan_model->id_satuan_waktu = $data['detail']->id_satuan_waktu;
			$data['waktu'] = $this->ref_satuan_model->get_by_id()->nama_satuan;

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
			$this->ref_pekerjaan_m->delete($id);
		}
		else
		{
			redirect('home');
		}
	}
}
?>