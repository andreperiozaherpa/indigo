<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Legislasi extends CI_Controller {
	public $user_id;

	public function __construct(){
		parent ::__construct();	
		$this->user_id = $this->session->userdata('user_id');
		// $this->load->model('project_model');
		$this->load->model('user_model');
		// $this->load->model('worksheet_model');
		$this->load->model('kegiatan_model');
		$this->load->model('logs_model');
		$this->load->model('ref_skpd_model');
		$this->load->model('renja_perencanaan_model');
		$this->load->model('legislasi_model');
		$this->user_model->user_id = $this->user_id;
		$this->user_model->set_user_by_user_id();
		$this->user_picture = $this->user_model->user_picture;
		$this->full_name	= $this->user_model->full_name;
		$this->user_level	= $this->user_model->level;
		$this->user_privileges	= $this->user_model->user_privileges;
		$array_privileges = explode(';', $this->user_privileges);

		// if (($this->user_level!="Administrator" && $this->user_level!="Admin Web") && !in_array('project', $array_privileges)) redirect ('welcome');
	}
	
	
	public function index()
	{
		if ($this->user_id)
		{
			$data['title']		= "Legislasi - ". app_name;
			$data['content']	= "legislasi/index" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			// $data['project'] = $this->project;
			$data['user_level']		= $this->user_level;
			
			if(!empty($_POST)){
				$nama_kegiatan = $_POST['nama_kegiatan'];
				$prioritas = $_POST['prioritas'];
				$this->kegiatan_model->nama_kegiatan = $nama_kegiatan;
				$this->kegiatan_model->prioritas = $prioritas;
			}

			$this->load->model('kegiatan_model');
			$data['query']		= $this->legislasi_model->get_all();


			$data['active_menu'] = "legislasi";
			$this->load->view('admin/index',$data);

		}
		else
		{
			redirect('admin');
		}
	}

	public function detail($id_legislasi)
	{
		if ($this->user_id)
		{
			$data['title']		= "Detail Legislasi - ". app_name;
			$data['content']	= "legislasi/detail" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "legislasi";
			$data['detail'] = $this->legislasi_model->get_by_id($id_legislasi);
			$data['anggota'] = $this->legislasi_model->get_anggota($id_legislasi);
			$this->load->view('admin/index',$data);

		}
		else
		{
			redirect('admin');
		}
	}


	public function edit($id_legislasi){
		if ($this->user_id){
			$data['title']		= "Edit Legislasi - ". app_name;
			$data['content']	= "legislasi/edit" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "legislasi";
			
			$this->load->model('pegawai_model');
			$data['pegawai'] = $this->pegawai_model->get_registered_u(231);
			if(!empty($_POST)){
				$required_form = ['judul','tanggal_pelaksanaan','laporan_singkat','rekomendasi','status','id_pegawai_ketua'];
				$lengkap = true;
				$data_insert = [];
				foreach($required_form as $r){
					if(!empty($_POST[$r])){
						$data_insert[$r] = $_POST[$r]; 
						continue;
					}else{
						$lengkap = false;
						break;
					}
				}
				if(!$lengkap){
					$data['message'] = 'Masih ada form yang kosong';
					$data['message_type'] = 'warning';
				}else{
					// $error_upload = false;
					// if (!empty($_FILES['file_pendukung']['name'])) {
					// 	$config = array(
					// 		'upload_path' => "./data/legislasi/",
					// 		'allowed_types' => "jpeg|gif|jpg|png|doc|docx|word|ppt|pdf|xls|rar|7zip|pptx|xlsx",
					// 		'overwrite' => TRUE,
					// 		'max_size' => "50480000"
					// 	);
					// 	$this->load->library('upload', $config);
					// 	if ($this->upload->do_upload('file_pendukung')) {
					// 		$data_insert['file_pendukung'] =  $this->upload->data('file_name');
					// 	} else {
					// 		$data['message'] =  $this->upload->display_errors();
					// 		$data['message_type'] = 'danger';
					// 		$error_upload = true;
					// 	}
					// } else {
					// 	$data_insert['file_pendukung'] = NULL;
					// }
					
					// if (!$error_upload) {
					// 	$in = $this->legislasi_model->insert($data_insert);
					// 	if($in){
					// 		if(isset($_POST['id_anggota'])){
					// 			foreach($_POST['id_anggota'] as $k => $a){
					// 				$jabatan = $_POST['jabatan'][$k];
					// 				$insert_anggota = $this->legislasi_model->insert_anggota($in,$a,$jabatan);
					// 			}
					// 		}
					// 		$data['message'] = 'Legislasi berhasil ditambahkan';
					// 		$data['message_type'] = 'success';
					// 	}
					// }
				}
			}
			
			$data['detail'] = $this->legislasi_model->get_by_id($id_legislasi);
			$data['anggota'] = $this->legislasi_model->get_anggota($id_legislasi);
			$this->load->view('admin/index',$data);
		}else{
			redirect('admin');	
		}

	}

	public function add(){
		if ($this->user_id){
			$data['title']		= "Buat Legislasi - ". app_name;
			$data['content']	= "legislasi/add" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "legislasi";
			
			$this->load->model('pegawai_model');
			$data['pegawai'] = $this->pegawai_model->get_registered_u(231);
			if(!empty($_POST)){
				$required_form = ['judul','tanggal_pelaksanaan','laporan_singkat','rekomendasi','status','id_pegawai_ketua'];
				$lengkap = true;
				$data_insert = [];
				foreach($required_form as $r){
					if(!empty($_POST[$r])){
						$data_insert[$r] = $_POST[$r]; 
						continue;
					}else{
						$lengkap = false;
						break;
					}
				}
				if(!$lengkap){
					$data['message'] = 'Masih ada form yang kosong';
					$data['message_type'] = 'warning';
				}else{
					$error_upload = false;
					if (!empty($_FILES['file_pendukung']['name'])) {
						$config = array(
							'upload_path' => "./data/legislasi/",
							'allowed_types' => "jpeg|gif|jpg|png|doc|docx|word|ppt|pdf|xls|rar|7zip|pptx|xlsx",
							'overwrite' => TRUE,
							'max_size' => "50480000"
						);
						$this->load->library('upload', $config);
						if ($this->upload->do_upload('file_pendukung')) {
							$data_insert['file_pendukung'] =  $this->upload->data('file_name');
						} else {
							$data['message'] =  $this->upload->display_errors();
							$data['message_type'] = 'danger';
							$error_upload = true;
						}
					} else {
						$data_insert['file_pendukung'] = NULL;
					}
					
					if (!$error_upload) {
						$in = $this->legislasi_model->insert($data_insert);
						if($in){
							if(isset($_POST['id_anggota'])){
								foreach($_POST['id_anggota'] as $k => $a){
									$jabatan = $_POST['jabatan'][$k];
									$insert_anggota = $this->legislasi_model->insert_anggota($in,$a,$jabatan);
								}
							}
							$data['message'] = 'Legislasi berhasil ditambahkan';
							$data['message_type'] = 'success';
						}
					}
				}
			}
			$this->load->view('admin/index',$data);
		}else{
			redirect('admin');	
		}

	}


	public function delete($id_legislasi)
	{
		if ($this->user_id)
		{
			$this->legislasi_model->delete($id_legislasi);
			redirect('legislasi');
		}
		else
		{
			redirect('home');
		}
	}
}
