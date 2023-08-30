<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Surat_tembusan extends CI_Controller {
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
		$this->load->model('skpd_model');
		$this->load->model('surat_keluar_model');

		$this->level_id	= $this->user_model->level_id;
		if ($this->level_id >2 ) redirect("admin");
	}
	public function index($jenis_surat)
	{
		if ($this->user_id)
		{
			$data['title']		= "Surat Tembusan";
			$data['content']	= "surat_tembusan/index" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "surat_tembusan";
			$hal = 6;
			$page = isset($_GET["page"]) ? (int)$_GET["page"] : 1;
			$mulai = ($page>1) ? ($page * $hal) - $hal : 0;
			$total = count($this->surat_keluar_model->get_all_tembusan($jenis_surat));
			$data['pages'] = ceil($total/$hal);
			$data['current'] = $page;
			if(!empty($_POST)){
				$filter = $_POST;
				$data['filter'] = true;
				$data['filter_data'] = $_POST;
			}else{
				$filter = '';
				$data['filter'] = false;
			}
			$data['total'] = $this->surat_keluar_model->get_all_tembusan($jenis_surat);
			$data['unread'] = $this->surat_keluar_model->get_all_tembusan_status($jenis_surat,'Belum Dibaca');
			$data['read'] = $this->surat_keluar_model->get_all_tembusan_status($jenis_surat,'Sudah Dibaca');
			$data['list'] = $this->surat_keluar_model->get_page_tembusan($jenis_surat,$mulai,$hal,$filter);
			// print_r($data['list']);die;
			$this->load->view('admin/index',$data);


		}
		else
		{
			redirect('admin');
		}
	}

	public function detail($id_surat_keluar_tembusan)
	{
		if ($this->user_id)
		{
			$data['content']	= "surat_tembusan/detail" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "surat_tembusan";
			$data['detail'] = $this->surat_keluar_model->get_surat_tembusan_by_id($id_surat_keluar_tembusan);

			if ($data['detail']->status_tembusan == "Belum Dibaca") {
				$this->surat_keluar_model->baca_surat_tembusan($id_surat_keluar_tembusan);
			}
			$data['title']		= "Surat Tembusan ".ucfirst($data['detail']->jenis_surat_keluar);
			$data['penerima'] = $this->surat_keluar_model->get_penerima($data['detail']->id_surat_keluar);
			$data['status_surat'] = $this->surat_keluar_model->get_status_surat($data['detail']->id_surat_keluar);
			$data['detail'] = $this->surat_keluar_model->get_surat_tembusan_by_id($id_surat_keluar_tembusan);
			$this->load->view('admin/index',$data);


		}
		else
		{
			redirect('admin');
		}
	}

}
?>
