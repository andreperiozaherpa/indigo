<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_pelaporan extends CI_Controller {
	public $user_id;

	public function __construct(){
		parent ::__construct();	
		$this->user_id = $this->session->userdata('user_id');
		$this->user_level = $this->session->userdata('user_level');
		$this->load->model('visitor_model');
		$this->load->model('berkas_model');
		$this->load->model('berkas_file_model');
		$this->load->model('ref_kategori_berkas_model');
		$this->load->model('ref_unit_kerja_model');
		$this->load->helper('text');
		$this->load->helper('typography');
        $this->load->helper('file');
		$this->visitor_model->cek_visitor();
		
		$this->load->model('company_profile_model');

		$this->company_profile_model->set_identity();
	}

	public function index()
	{
		$data['title'] = "Data dan Pelaporan - " .$this->company_profile_model->nama;
		$data['active_menu'] ="data_pelaporan";
		if (!empty($_GET['s'])) {
			$this->berkas_model->search = $_GET['s'];
			$data['search'] = $_GET['s'];
		}
		if (!empty($_GET['c'])) {
			$this->berkas_model->search_c = $_GET['c'];
			$data['search_c'] = $_GET['c'];
		}
		$data['per_page']	= 6;
		$data['total_rows']	= $this->berkas_model->get_total_row();
		$offset = 0;
		if (!empty($_GET['per_page'])) $offset = $_GET['per_page'] ;
		$data['berkas'] = $this->berkas_model->get_for_page($data['per_page'],$offset);
		//banner
		$this->load->model('banner_model');
		$data['banner'] = $this->banner_model->get_all();

		$this->load->model('ref_kategori_berkas_model');
		$data['categories']	= $this->ref_kategori_berkas_model->get_all();
		
		$this->load->view('blog/src/header',$data);
		$this->load->view('blog/src/top_nav',$data);
		$this->load->view('blog/data_pelaporan',$data);
		$this->load->view('blog/src/footer',$data);
	}

	public function detail($id_berkas)
	{
		if ($id_berkas) {

			
			$this->berkas_model->id_berkas = $id_berkas;
			$data['detail'] = $this->berkas_model->get_for_detail();
			if(empty($data['detail'])){
				redirect('data_pelaporan');
			}else{
				if($data['detail']->data_rahasia){
				redirect('data_pelaporan');
				}
			}
			if (!empty($_GET['s'])) {
				$this->berkas_model->search = $_GET['s'];
				$data['search'] = $_GET['s'];
			}
			if (!empty($_GET['c'])) {
				$this->berkas_model->search_c = $_GET['c'];
				$data['search_c'] = $_GET['c'];
			}
			$this->berkas_model->id_berkas = $id_berkas;
			$data['row'] = $this->berkas_model->get_by_id();

			$data['title'] = "Data dan Pelaporan - " .$data['row']->nama_kegiatan;
			$data['active_menu'] ="data_pelaporan";
			//banner
			$this->load->model('banner_model');
			$data['banner'] = $this->banner_model->get_all();

			$this->load->model('ref_kategori_berkas_model');
			$data['categories']	= $this->ref_kategori_berkas_model->get_all();

			$data['data'] = $this->berkas_model->get_all();
			$data['unit_kerja'] = $this->ref_unit_kerja_model->get_all();
			$this->ref_unit_kerja_model->level_unit_kerja = 1;
			$data['unit_kerja'] = $this->ref_unit_kerja_model->get_by_level();
			$this->ref_unit_kerja_model->id_unit_kerja = $data['detail']->id_unit_kerja;
			$aa = $this->ref_unit_kerja_model->get_by_id();
			$data['level_unit'] = $aa->level_unit_kerja;
			$level = $data['level_unit'];
			if($level==1){
				$data['uk1'] = $data['detail']->id_unit_kerja;
			}
			elseif($level==2){
				$this->ref_unit_kerja_model->id_induk = $aa->id_induk;
				$data['uk2'] = $this->ref_unit_kerja_model->get_by_parent();
				$data['uk2s'] = $data['detail']->id_unit_kerja;
				$data['uk1'] = $aa->id_induk;
			}elseif($level==3){
				$this->ref_unit_kerja_model->id_induk = $aa->id_induk;
				$data['uk3'] = $this->ref_unit_kerja_model->get_by_parent();
				$this->ref_unit_kerja_model->id_unit_kerja = $aa->id_unit_kerja;
				$data['uk3s'] = $this->ref_unit_kerja_model->get_by_id()->id_unit_kerja;
				$data['uk3sp'] = $this->ref_unit_kerja_model->get_by_id()->id_induk;
				$this->ref_unit_kerja_model->id_unit_kerja = $data['uk3sp'];
				$p2 = $this->ref_unit_kerja_model->get_by_id();
				$this->ref_unit_kerja_model->id_induk = $p2->id_induk;
				$data['uk2'] = $this->ref_unit_kerja_model->get_by_parent();
				$this->ref_unit_kerja_model->id_unit_kerja = $data['uk3sp'];
				$data['uk2s'] = $this->ref_unit_kerja_model->get_by_id()->id_unit_kerja;
				$data['uk2sp'] = $this->ref_unit_kerja_model->get_by_id()->id_induk;

				$this->ref_unit_kerja_model->id_unit_kerja = $data['uk2sp'];
				$data['uk1'] = $this->ref_unit_kerja_model->get_by_id()->id_unit_kerja;	
			}elseif($level==4){
				$this->ref_unit_kerja_model->id_induk = $aa->id_induk;
				$data['uk4'] = $this->ref_unit_kerja_model->get_by_parent();
				$this->ref_unit_kerja_model->id_unit_kerja = $aa->id_unit_kerja;
				$data['uk4s'] = $this->ref_unit_kerja_model->get_by_id()->id_unit_kerja;
				$data['uk4sp'] = $this->ref_unit_kerja_model->get_by_id()->id_induk;


				$this->ref_unit_kerja_model->id_unit_kerja = $data['uk4sp'];
				$p3 = $this->ref_unit_kerja_model->get_by_id();
				$this->ref_unit_kerja_model->id_induk = $p3->id_induk;
				$data['uk3'] = $this->ref_unit_kerja_model->get_by_parent();

				$this->ref_unit_kerja_model->id_unit_kerja = $data['uk4sp'];
				$data['uk3s'] = $this->ref_unit_kerja_model->get_by_id()->id_unit_kerja;
				$data['uk3sp'] = $this->ref_unit_kerja_model->get_by_id()->id_induk;


				$this->ref_unit_kerja_model->id_unit_kerja = $data['uk3sp'];
				$p2 = $this->ref_unit_kerja_model->get_by_id();
				$this->ref_unit_kerja_model->id_induk = $p2->id_induk;
				$data['uk2'] = $this->ref_unit_kerja_model->get_by_parent();
				$this->ref_unit_kerja_model->id_unit_kerja = $data['uk3sp'];
				$data['uk2s'] = $this->ref_unit_kerja_model->get_by_id()->id_unit_kerja;
				$data['uk2sp'] = $this->ref_unit_kerja_model->get_by_id()->id_induk;

				$this->ref_unit_kerja_model->id_unit_kerja = $data['uk2sp'];
				$data['uk1'] = $this->ref_unit_kerja_model->get_by_id()->id_unit_kerja;
			}

			if(isset($data['uk1'])){
				$this->ref_unit_kerja_model->id_unit_kerja = $data['uk1'];
				$data['uk1_nama'] = $this->ref_unit_kerja_model->get_by_id()->nama_unit_kerja;
			}else{
				$data['uk1_nama'] = '-';
			}


			if(isset($data['uk2s'])){
				$this->ref_unit_kerja_model->id_unit_kerja = $data['uk2s'];
				$data['uk2_nama'] = $this->ref_unit_kerja_model->get_by_id()->nama_unit_kerja;
			}else{
				$data['uk2_nama'] = '-';
			}
			if(isset($data['uk3s'])){
				$this->ref_unit_kerja_model->id_unit_kerja = $data['uk3s'];
				$data['uk3_nama'] = $this->ref_unit_kerja_model->get_by_id()->nama_unit_kerja;
			}else{
				$data['uk3_nama'] = '-';
			}

			if(isset($data['uk4s'])){
				$this->ref_unit_kerja_model->id_unit_kerja = $data['uk4s'];
				$data['uk4_nama'] = $this->ref_unit_kerja_model->get_by_id()->nama_unit_kerja;
			}else{
				$data['uk4_nama'] = '-';
			}

			$this->berkas_file_model->id_berkas = $id_berkas;
			$data['files'] = $this->berkas_file_model->get_by_n();
			$data['id_berkas'] = $id_berkas;
			
			$this->load->view('blog/src/header',$data);
			$this->load->view('blog/src/top_nav',$data);
			$this->load->view('blog/data_pelaporan_detail',$data);
			$this->load->view('blog/src/footer',$data);
		} else {
				redirect('data_pelaporan');
		}
	}

	public function download_file($id_berkas_file){
		$id_berkas_file = explode('_', $id_berkas_file);
		$id_berkas_file = $id_berkas_file[0];
		$this->berkas_file_model->id_berkas_file = $id_berkas_file;
		$data = $this->berkas_file_model->get_by_id();
		$file = urldecode($data->hash_file);
		$filepath = $data->path_file . $file;
		echo $filepath;
		if(file_exists($filepath)) {
			header('Content-Description: File Transfer');
			header('Content-Type: application/octet-stream');
			header('Content-Disposition: attachment; filename="'.basename($data->nama_file).'"');
			header('Expires: 0');
			header('Cache-Control: must-revalidate');
			header('Pragma: public');
			header('Content-Length: ' . filesize($filepath));
			flush(); 
			readfile($filepath);
			exit;
		}
	}
	
}
?>