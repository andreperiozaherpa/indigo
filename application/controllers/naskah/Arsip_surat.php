<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Arsip_surat extends CI_Controller {

	public function __construct(){
		parent ::__construct();
		$this->load->model('arsip_surat_model');
		$this->load->model('surat_masuk_model');
		$this->user_privileges = explode(";", $this->session->userdata('user_privileges'));

	}

	public function index($summary_field='',$summary_value=''){

		if ($this->user_id)
		{

			$summary_value = urldecode($summary_value);
			$this->filter_arsip();
			$data['title']		= "Arsip Surat Masuk - Admin ";
			$data['content']	= "arsip_surat/masuk/index" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "laporan_surat";

			$hal = 6;
			$page = isset($_GET["page"]) ? (int)$_GET["page"] : 1;
			$mulai = ($page>1) ? ($page * $hal) - $hal : 0;
			$total = count($this->arsip_surat_model->surat_masuk($summary_field,$summary_value));
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

			$data['total'] = $this->arsip_surat_model->surat_masuk();
			$data['archived'] = $this->arsip_surat_model->surat_masuk_archived();
			$data['unarchived'] = $this->arsip_surat_model->surat_masuk_unarchived();
			$data['list'] = $this->arsip_surat_model->get_page_surat_masuk($mulai,$hal,$filter,$summary_field,$summary_value);
			if(!empty($summary_value)&&!empty($summary_field)){
				$data['summary_field'] = $summary_field;
				$data['summary_value'] = $summary_value;
			}


			$this->load->view('admin/index',$data);
		}
		else
		{
			redirect('admin');
		}
	}

	public function detail_surat_masuk($id_surat_masuk){
		if ($this->user_id)
		{
			if ($id_surat_masuk == "") {
				redirect(base_url('arsip_surat'));
				exit;
			}
			$this->filter_arsip($id_surat_masuk);
			$data['title']		= "Detail Arsip Surat Masuk - Admin ";
			$data['content']	= "arsip_surat/masuk/detail" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "surat masuk";

			if(!empty($_POST)){
				$data_update = $_POST;
				$data_update['status_arsip'] = 'Sudah Diarsipkan';
				$data_update['tgl_arsip'] = date('Y-m-d');
				// print_r($data_update);die;
				$update = $this->surat_masuk_model->update_surat_masuk($data_update,$id_surat_masuk);
				$data['message'] = "Surat telah berhasil diarsipkan";
				$data['type'] = "success";

			}
			$data['disposisi'] = $this->surat_masuk_model->get_disposisi_surat_masuk_by_id_surat($id_surat_masuk);
			$data['detail'] = $this->arsip_surat_model->get_detail_sm_by_id($id_surat_masuk);

			$this->load->view('admin/index',$data);
		}
		else
		{
			redirect('admin');
		}
	}



	public function surat_keluar(){

		if ($this->user_id)
		{
			$data['title']		= "Data Surat - Admin ";
			$data['content']	= "laporan_surat/surat_keluar" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "laporan_surat";

			$data['surat_keluar'] = $this->laporan_surat_model->data_surat_keluar();

			$this->load->view('admin/index',$data);
		}
		else
		{
			redirect('admin');
		}
	}


	public function grafik_surat(){

		if ($this->user_id)
		{
			$data['title']		= "Grafik Surat - Admin ";
			$data['content']	= "laporan_surat/grafik_surat" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "laporan_surat";

			$this->load->view('admin/index',$data);
		}
		else
		{
			redirect('admin');
		}
	}


	public function filter_arsip($id=''){
		if($id!==''){
			$data['detail'] = $this->surat_masuk_model->get_detail_by_id($id);

			if(empty($data['detail'])){
				show_404();
			}
		}
		if($this->user_level!=="Administrator"){
			if(!in_array('tu_pimpinan', $this->user_privileges)){
				show_404();
			}
		}
	}

	}
