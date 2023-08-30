<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class berkas extends CI_Controller {
	public $user_id;

	public function __construct(){
		parent ::__construct();	
		$this->user_id = $this->session->userdata('user_id');
		$this->load->model('user_model');
		$this->load->model('berkas_model');
		$this->load->model('ref_kategori_berkas_model');
		$this->load->model('ref_wilayah_model');
		$this->load->model('ref_kode_model');
		$this->load->model('ref_satuan_model');
		$this->load->model('ref_unit_kerja_model');
		$this->load->model('berkas_file_model');
		$this->load->helper('form');
		$this->user_model->user_id = $this->user_id;
		$this->user_model->set_user_by_user_id();
		$this->user_picture = $this->user_model->user_picture;
		$this->full_name	= $this->user_model->full_name;
		$this->user_level	= $this->user_model->level;
		$this->user_privileges	= $this->user_model->user_privileges;
		$array_privileges = explode(';', $this->user_privileges);

		if (($this->user_level!="Administrator" && $this->user_level!="User" && $this->user_level!="Departement") && !in_array('mn_kegiatan', $array_privileges)) redirect ('welcome');
	}

	public function index()
	{
		if ($this->user_id)
		{
			$data['title']		= "Berkas - ". app_name;
			$data['content']	= "berkas/index" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "berkas";

			if (!empty($_POST)){
				$this->berkas_model->id_unit_kerja = $_POST['id_unit_kerja'];
				$this->berkas_model->nama_kegiatan = $_POST['nama_kegiatan'];
			}
			$this->berkas_model->id_user = $this->user_id;
			$data['data'] = $this->berkas_model->get_all($this->user_level);
			$data['unit_kerja'] = $this->ref_unit_kerja_model->get_all();

			$this->load->view('admin/index',$data);

		}
		else
		{
			redirect('admin');
		}
	}

	public function quick_view()
	{
		if ($this->user_id)
		{
			$data['title']		= "Quick View - ". app_name;
			$data['content']	= "berkas/quick_view" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "quick_view";

			if (!empty($_POST)){
				$this->berkas_model->id_unit_kerja = $_POST['id_unit_kerja'];
				$this->berkas_model->nama_kegiatan = $_POST['nama_kegiatan'];
			}
			$this->berkas_model->id_user = $this->user_id;
			$data['data'] = $this->berkas_model->get_all($this->user_level);
			$data['unit_kerja'] = $this->ref_unit_kerja_model->get_all();

			$this->load->view('admin/index',$data);

		}
		else
		{
			redirect('admin');
		}
	}

	public function delete_files($id){

		$this->berkas_file_model->id_berkas_file = $id;
		$get = $this->berkas_file_model->get_by_id();
		unlink($get->path_file.$get->hash_file);
	}

	public function detail($id_berkas)
	{
		if ($this->user_id)
		{
			$data['title']		= "Detail Data & Berkas - ". app_name;
			$data['content']	= "berkas/detail" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "berkas";

			$data['data'] = $this->berkas_model->get_all();
			$data['unit_kerja'] = $this->ref_unit_kerja_model->get_all();
			
			$this->berkas_model->id_berkas = $id_berkas;
			$data['detail'] = $this->berkas_model->get_for_detail();
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

			$this->load->view('admin/index',$data);

		}
		else
		{
			redirect('admin');
		}
	}
	public function t(){
		$unit_kerja = $this->ref_unit_kerja_model->get_by_id_parent(2);
		print_r($unit_kerja);
	}
	public function add()
	{
		if ($this->user_id)
		{
			
			$data['title']		= "Tambah Berkas - ". app_name;
			$data['content']	= "berkas/add" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;

			$data['level'] = $this->user_level;
			$this->user_model->user_id = $this->user_id;
			$data['id_unit_kerja'] = $this->user_model->get_by_id()->unit_kerja_id;
			$this->ref_unit_kerja_model->id_unit_kerja = $data['id_unit_kerja'];
			$data['level_unit'] = $this->ref_unit_kerja_model->get_by_id()->level_unit_kerja;
			
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "berkas";
			$this->ref_unit_kerja_model->level_unit_kerja = 1;
			$data['unit_kerja'] = $this->ref_unit_kerja_model->get_by_level();
			$data['unit_kerja_a'] = $this->ref_unit_kerja_model->get_all();
			$data['kategori_berkas'] = $this->ref_kategori_berkas_model->get_all();

			if (!empty($_POST)){
				if ((
					$_POST['level_unit'] !="" &&
					$_POST['nama_kegiatan'] !="" &&
					$_POST['id_kategori_berkas'] !="" &&
					$_POST['keterangan'] !=""
				))
				{

					if (isset($_POST['sharing'])){
						if($_POST['share_dengan']=='semua'){
							$sharing_berkas = 'all';
						}else{
							if (isset($_POST['sharing_berkas'])){
								$sharing_berkas = $_POST['sharing_berkas'];
								$sharing_berkas = implode(';', $sharing_berkas);
							}else{
								$sharing_berkas = '';
							}
						}
					}else{
						$sharing_berkas = '';
					}


					$level_unit = $_POST['level_unit'];
					if($level_unit==1){
						$id_unit_kerja = $_POST['uk1'];
					}elseif($level_unit==2){
						$id_unit_kerja = $_POST['uk2'];
					}elseif($level_unit==3){
						$id_unit_kerja = $_POST['uk3'];
					}elseif($level_unit==4){
						$id_unit_kerja = $_POST['uk4'];
					}
					$nama_kegiatan = $_POST['nama_kegiatan'];
					$id_kategori_berkas = $_POST['id_kategori_berkas'];
					$data_rahasia = $_POST['data_rahasia'];
					$keterangan = $_POST['keterangan'];
					$tanggal_input = date('Y-m-d');
					$waktu_input = date('H:i:s');
					$id_user = $this->user_id;

					$this->berkas_model->id_unit_kerja = $id_unit_kerja;
					$this->berkas_model->id_kategori_berkas = $id_kategori_berkas;
					$this->berkas_model->nama_kegiatan = $nama_kegiatan;
					$this->berkas_model->keterangan = $keterangan;
					$this->berkas_model->tanggal_input = $tanggal_input;
					$this->berkas_model->waktu_input = $waktu_input;
					$this->berkas_model->data_rahasia = $data_rahasia;
					$this->berkas_model->sharing_berkas = $sharing_berkas;
					$this->berkas_model->id_user = $id_user;
					$insert = $this->berkas_model->insert();


					if($_FILES['files']['name'] !== ""){
						$filesCount = count($_FILES['files']['name']);
						for($i = 0; $i < $filesCount; $i++){
							$_FILES['file']['name']     = $_FILES['files']['name'][$i];
							$_FILES['file']['type']     = $_FILES['files']['type'][$i];
							$_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
							$_FILES['file']['error']     = $_FILES['files']['error'][$i];
							$_FILES['file']['size']     = $_FILES['files']['size'][$i];
							

							$path = 'data/berkas/'.$insert.'/';
							if (!file_exists($path)) {
								mkdir($path, 0777, true);
							}
							$config['upload_path'] = $path;   
							$config['allowed_types'] = 'jpg|jpeg|png|doc|docx|xls|xlsx|pdf';

							$old_name = $_FILES['file']['name'];
							$a = explode('.', $_FILES['file']['name']);

							if(isset($a[0]) && isset($a[1])){
								$new_name = md5($a[0]).time().'.'.$a[1];
							}else{
								$new_name = 0;
							}

							$config['file_name'] = $new_name;
							$this->load->library('upload', $config);
							$this->upload->initialize($config);
							if($this->upload->do_upload('file')){
								$fileData = $this->upload->data();
								$uploadData[$i]['hash_file'] =$fileData['file_name'];
								$uploadData[$i]['nama_file'] = $old_name;
								$uploadData[$i]['path_file'] = $config['upload_path'];
								$uploadData[$i]['eks_file'] = $fileData['file_ext'];
								$uploadData[$i]['type_file'] = $fileData['file_type'];
								$data['message_type_f'] = "success";
								$data['message_f']			= 'File berhasil diupload';
							}else{
								$data['message_type_f'] = "danger";
								$data['message_f']			= 'Gagal Upload File : '.$this->upload->display_errors();
							}
						}
						
						if(!empty($uploadData)){
							foreach($uploadData as $u){
								$this->berkas_file_model->id_berkas = $insert;
								$this->berkas_file_model->hash_file = $u['hash_file'];
								$this->berkas_file_model->nama_file = $u['nama_file'];
								$this->berkas_file_model->eks_file = $u['eks_file'];
								$this->berkas_file_model->type_file = $u['type_file'];
								$this->berkas_file_model->path_file = $u['path_file'];
								$this->berkas_file_model->insert();
							}
						}
					}

					$data['message_type'] = "success";
					$data['message']		= "Berkas berhasil ditambahkan.";
				}else{
					$data['message_type'] = "warning";
					$data['message'] = "<strong>Opps..</strong> Masih ada data yang kosong. silahkan lengkapi terlebih dahulu!";

				}
			}

			$this->load->view('admin/index',$data);

		}
		else
		{
			redirect('admin');
		}
	}

	public function edit($id_berkas)
	{
		if ($this->user_id)
		{
			
			$data['title']		= "Edit Berkas - ". app_name;
			$data['content']	= "berkas/edit" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "berkas";
			

			$this->berkas_model->id_berkas = $id_berkas;
			$data['detail'] = $this->berkas_model->get_by_id();

			$data['level'] = $this->user_level;
			$this->user_model->user_id = $this->user_id;
			$data['id_unit_kerja'] = $this->user_model->get_by_id()->unit_kerja_id;
			$this->ref_unit_kerja_model->id_unit_kerja = $data['detail']->id_unit_kerja;
			$data['level_unit'] = $this->ref_unit_kerja_model->get_by_id()->level_unit_kerja;

			if (!empty($_POST)){
				if ((
					$_POST['level_unit'] !="" &&
					$_POST['nama_kegiatan'] !="" &&
					$_POST['id_kategori_berkas'] !="" &&
					$_POST['keterangan'] !=""
				))
				{
					if (isset($_POST['sharing'])){
						if($_POST['share_dengan']=='semua'){
							$sharing_berkas = 'all';
						}else{
							if (isset($_POST['sharing_berkas'])){
								$sharing_berkas = $_POST['sharing_berkas'];
								$sharing_berkas = implode(';', $sharing_berkas);
							}else{
								$sharing_berkas = '';
							}
						}
					}else{
						$sharing_berkas = '';
					}

					$level_unit = $_POST['level_unit'];
					if($level_unit==1){
						$id_unit_kerja = $_POST['uk1'];
					}elseif($level_unit==2){
						$id_unit_kerja = $_POST['uk2'];
					}elseif($level_unit==3){
						$id_unit_kerja = $_POST['uk3'];
					}elseif($level_unit==4){
						$id_unit_kerja = $_POST['uk4'];
					}
					$nama_kegiatan = $_POST['nama_kegiatan'];
					$keterangan = $_POST['keterangan'];
					$id_kategori_berkas = $_POST['id_kategori_berkas'];
					$data_rahasia = $_POST['data_rahasia'];
					$tanggal_input = date('Y-m-d');
					$waktu_input = date('H:i:s');
					$id_user = $this->user_id;

					$this->berkas_model->id_berkas = $id_berkas;
					$this->berkas_model->id_unit_kerja = $id_unit_kerja;
					$this->berkas_model->id_kategori_berkas = $id_kategori_berkas;
					$this->berkas_model->nama_kegiatan = $nama_kegiatan;
					$this->berkas_model->keterangan = $keterangan;
					$this->berkas_model->data_rahasia = $data_rahasia;
					$this->berkas_model->sharing_berkas = $sharing_berkas;
					$insert = $this->berkas_model->update();
					$data['message_type'] = "success";
					$data['message']		= "Berkas berhasil diubah.";
				}else{
					$data['message_type'] = "warning";
					$data['message'] = "<strong>Opps..</strong> Masih ada data yang kosong. silahkan lengkapi terlebih dahulu!";

				}

				if($_FILES['files']['name'] !== ""){
					$filesCount = count($_FILES['files']['name']);
					for($i = 0; $i < $filesCount; $i++){
						$_FILES['file']['name']     = $_FILES['files']['name'][$i];
						$_FILES['file']['type']     = $_FILES['files']['type'][$i];
						$_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
						$_FILES['file']['error']     = $_FILES['files']['error'][$i];
						$_FILES['file']['size']     = $_FILES['files']['size'][$i];
						
		                // File upload configuration
						$path = 'data/berkas/'.$id_berkas.'/';
						if (!file_exists($path)) {
							mkdir($path, 0777, true);
						}
						$config['upload_path'] = $path;   
						$config['allowed_types'] = 'jpg|jpeg|png|doc|docx|xls|xlsx|pdf';

						$old_name = $_FILES['file']['name'];
						$a = explode('.', $_FILES['file']['name']);

						if(isset($a[0]) && isset($a[1])){
							$new_name = md5($a[0]).time().'.'.$a[1];
						}else{
							$new_name = 0;
						}

						$config['file_name'] = $new_name;
						$this->load->library('upload', $config);
						$this->upload->initialize($config);
						if($this->upload->do_upload('file')){
							$fileData = $this->upload->data();
							$uploadData[$i]['hash_file'] =$fileData['file_name'];
							$uploadData[$i]['nama_file'] = $old_name;
							$uploadData[$i]['path_file'] = $config['upload_path'];
							$uploadData[$i]['eks_file'] = $fileData['file_ext'];
							$uploadData[$i]['type_file'] = $fileData['file_type'];
							$data['message_type_f'] = "success";
							$data['message_f']			= 'File berhasil diupload';
						}else{
							$data['message_type_f'] = "danger";
							$data['message_f']			= 'Gagal Upload File : '.$this->upload->display_errors();
						}
					}
					
					if(!empty($uploadData)){
						foreach($uploadData as $u){
							$this->berkas_file_model->id_berkas = $id_berkas;
							$this->berkas_file_model->hash_file = $u['hash_file'];
							$this->berkas_file_model->nama_file = $u['nama_file'];
							$this->berkas_file_model->eks_file = $u['eks_file'];
							$this->berkas_file_model->type_file = $u['type_file'];
							$this->berkas_file_model->path_file = $u['path_file'];
							$this->berkas_file_model->insert();
						}
					}
				}
			}

			$this->ref_unit_kerja_model->level_unit_kerja = 1;
			$data['unit_kerja'] = $this->ref_unit_kerja_model->get_by_level();
			$data['unit_kerja_a'] = $this->ref_unit_kerja_model->get_all();
			$data['kategori_berkas'] = $this->ref_kategori_berkas_model->get_all();
			$this->ref_unit_kerja_model->id_unit_kerja = $data['detail']->id_unit_kerja;
			$aa = $this->ref_unit_kerja_model->get_by_id();
			$data['level_unit'] = $aa->level_unit_kerja;
			$level = $data['level_unit'];

			if($level==1){
				$data['uk1'] = $data['detail']->id_unit_kerja;
			}elseif($level==2){
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
				// print_r($data['uk2']);
			}

			$this->berkas_file_model->id_berkas = $id_berkas;
			$data['files'] = $this->berkas_file_model->get_by_n();
			$data['id_berkas'] = $id_berkas;
			$this->load->view('admin/index',$data);

		}
		else
		{
			redirect('admin');
		}
	}
	public function delete_file($id_berkas,$id)
	{
		if ($this->user_id)
		{
			
			$this->berkas_file_model->id_berkas_file = $id;
			$this->berkas_file_model->delete();
			redirect('berkas/edit/'.$id_berkas.'');
		}
		else
		{
			redirect('home');
		}
	}
	public function delete($id)
	{
		if ($this->user_id)
		{
			
			$this->berkas_model->id_berkas = $id;
			$this->berkas_model->delete();
			redirect('berkas');
		}
		else
		{
			redirect('home');
		}
	}

	public function get_unit_kerja(){
		if(!empty($_POST)){
			$level = $_POST['level'];
			$id_parent = $_POST['id_parent'];
			$this->ref_unit_kerja_model->id_induk = $id_parent;
			$get = $this->ref_unit_kerja_model->get_by_parent();
			echo'<option value="">Pilih Sub Unit Kerja '.($level-1).'</option>';
			foreach($get as $g){
				echo'<option value="'.$g->id_unit_kerja.'">'.$g->nama_unit_kerja.'</option>';
			}
		}
	}

	public function fetch_file($id){
		if ($this->user_id)
		{
			$this->berkas_file_model->id_berkas_file = $id;
			$data = $this->berkas_file_model->get_by_id();
			$type_file = $data->type_file;
			$type_file = explode('/', $type_file);
			$type_file = $type_file[0];
			if($type_file=='application'){
				$data->type = 'document';
			}elseif($type_file=='image'){
				$data->type = 'image';
			}
			echo json_encode($data);
		}
		else
		{
			redirect('home');
		}
	}
	public function fetch_berkas($id_berkas){
		if ($this->user_id)
		{
			// echo $id_berkas;
			
			$this->berkas_model->id_berkas = $id_berkas;
			$data['detail'] = $this->berkas_model->get_for_detail();
			$this->ref_unit_kerja_model->level_unit_kerja = 1;
			$data['unit_kerja'] = $this->ref_unit_kerja_model->get_by_level();
			$data['unit_kerja_a'] = $this->ref_unit_kerja_model->get_all();
			$data['kategori_berkas'] = $this->ref_kategori_berkas_model->get_all();
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

			$detail = $data['detail'];
			$uk1_nama = $data['uk1_nama'];
			$uk2_nama = $data['uk2_nama'];
			$uk3_nama = $data['uk3_nama'];
			$uk4_nama = $data['uk4_nama'];
			$files = $data['files'];

			echo '				
			<div class="row">			
			<div class="col-md-4 col-xs-12">

			<div class="white-box">

			<div class="user-bg">
			<div class="overlay-box">
			<div class="user-content">
			<a href="javascript:void(0)"><img src="'. base_url() .'data/user_picture/'. $detail->user_picture .'" class="thumb-lg img-circle" alt="img"></a>
			<h4 class="text-white">'. $detail->full_name .'</h4>
			<h5 class="text-white">Diinput pada '. tanggal($detail->tanggal_input).' '.stime($detail->waktu_input)  .'</h5>
			</div>
			</div>
			</div>
			<div class="user-btm-box">
			<!-- .row -->
			<div class="row text-center m-t-10">
			<div class="col-md-6 b-r"><strong>Email</strong>
			<p>'. $detail->email .'</p>
			</div>
			<div class="col-md-6"><strong>Telepon</strong>
			<p>'. $detail->phone .'</p>
			</div>
			</div>
			<!-- /.row -->
			<hr>
			<!-- .row -->
			<div class="row text-center m-t-10">
			<div class="col-md-12"><strong>Alamat</strong>
			<p>'. $detail->bio .'</p>
			</div>
			</div>
			</div>
			</div>
			</div>
			<div class="col-sm-8 col-xs-12">
			<div class="white-box" style="padding-top: 0;">
			<div class="row">
			<!-- Nav tabs -->
			<ul class="nav customtab nav-tabs" role="tablist">
			<li role="presentation" class="active"><a href="#detail" aria-controls="home" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-home"></i></span><span class="hidden-xs"> Detail</span></a></li>
			<li role="presentation" class=""><a href="#file" aria-controls="profile" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-user"></i></span> <span class="hidden-xs">Daftar File</span></a></li>
			</ul>
			<!-- Tab panes -->
			<div class="tab-content">
			<div role="tabpanel" class="tab-pane active fade in" id="detail">
			<div class="form-horizontal">
			<div class="row">

			<div class="col-md-12">
			<div class="form-group">
			<label class="control-label col-md-3">Unit Kerja</label>
			<div class="col-md-9">
			<p class="form-control-static">'.$uk1_nama.'</p>
			</div>
			</div>
			<div class="form-group">
			<label class="control-label col-md-3">Sub Unit Kerja 1</label>
			<div class="col-md-9">
			<p class="form-control-static">'.$uk2_nama.'</p>
			</div>
			</div>
			<div class="form-group">
			<label class="control-label col-md-3">Sub Unit Kerja 2</label>
			<div class="col-md-9">
			<p class="form-control-static">'.$uk3_nama.'</p>
			</div>
			</div>
			<div class="form-group">
			<label class="control-label col-md-3">Sub Unit Kerja 3</label>
			<div class="col-md-9">
			<p class="form-control-static">'.$uk4_nama.'</p>
			</div>
			</div>
			</div>
			<div class="col-md-12">
			<div class="form-group">
			<label class="control-label col-md-3">Nama Kegiatan</label>
			<div class="col-md-9">
			<p  class="form-control-static">'. $detail->nama_kegiatan .' </p>
			</div>
			</div>
			<div class="form-group">
			<label class="control-label col-md-3">Keterangan</label>
			<div class="col-md-9">
			<p  class="form-control-static">'. $detail->keterangan .' </p>
			</div>
			</div>
			<div class="form-group">
			<label class="control-label col-md-3">Tanggal Input</label>
			<div class="col-md-9">
			<p  class="form-control-static">'. tanggal($detail->tanggal_input) .' </p>
			</div>
			</div>
			<div class="form-group">
			<label class="control-label col-md-3">Jam Input</label>
			<div class="col-md-9">
			<p class="form-control-static">'. stime($detail->waktu_input) .' </p>
			</div>
			</div>
			</div>
			</div>
			</div>
			<div class="clearfix"></div>
			</div>
			<div role="tabpanel" class="tab-pane fade" id="file">

			<div class="row el-element-overlay m-b-40">   

			';
			if(empty($files)){
				echo '
				<div style="text-align: center"> 
				<i style="font-size: 100px" data-icon="5" class="linea-icon linea-elaborate"></i>
				<h4 style="margin-top: -10px">Belum Ada File Terupload</h4>
				</div>
				';
			}else{
				foreach($files as $f){

					$type_file = $f->type_file;
					$type_file = explode('/', $type_file);
					$type_file = $type_file[0];
					if($type_file=='application'){
						$type = 'document';
						$ext = $f->eks_file;
						$ext = ltrim($ext, '.');
					}elseif($type_file=='image'){
						$type = 'image';
					}
					if($type=='document'){
						$thumb = '<div style="margin: 20px" class="file-icon file-icon-lg" data-type="'.$ext.'"></div>';
					}elseif($type=='image'){
						$thumb = '
						<div class="gambar">
						<img src="'.base_url().$f->path_file.$f->hash_file.'">
						</div>';
					}
					echo '                <div class="g col-lg-3 col-md-4 col-sm-6 col-xs-12">
					<div class="white-box">
					<div class="el-card-item">
					<div class="el-card-avatar el-overlay-1"> 
					'.$thumb.'
					<div class="el-overlay">
					<ul class="el-info">
					<li><a target="blank" class="btn default btn-outline" href="'. base_url()."berkas/download_file/".$f->id_berkas_file.'_'.$f->hash_file.'"><i class="icon-cloud-download"></i></a></li>
					</ul>
					</div>
					</div>
					<div class="el-card-content"> <small>'. $f->nama_file .'</small>
					<br/> </div>
					</div>
					</div>
					</div>
					</div>
					</div>
					</div>
					</div>
					</div>
					</div>
					</div>
					';
				}
			}
		}
		else
		{
			redirect('home');
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

	public function export_excel(){
		require_once APPPATH.'third_party/PHPExcel.php';

		$id_unit_kerja = $_POST['id_unit_kerja'];
		$j_rentang = $_POST['j_rentang'];
		$kertas = $_POST['kertas'];

		$nama_file = 'Laporan Data dan Berkas BNTP '.date('Y-m-d').' '.time();

		if($j_rentang=='tanggal'){
			$rentang_waktu = $_POST['rentang_waktu'];
			$a = explode('-', $rentang_waktu);
			$tanggal_awal = date("Y-m-d", strtotime($a[0]) );
			$tanggal_akhir = date("Y-m-d", strtotime($a[1]) );
			$this->berkas_model->tanggal_awal = $tanggal_awal;
			$this->berkas_model->tanggal_akhir = $tanggal_akhir;
			$rentang = tanggal($tanggal_awal).' s.d. '.tanggal($tanggal_akhir);
		}else{
			$rentang = 'Semua Waktu';
		}

		if($id_unit_kerja!=='all'){
			$this->berkas_model->id_unit_kerja = $_POST['id_unit_kerja'];
			$this->ref_unit_kerja_model->id_unit_kerja = $id_unit_kerja;
			$aa = $this->ref_unit_kerja_model->get_by_id();
			$uk = $aa->nama_unit_kerja;
		}else{
			$uk = 'Semua Unit Kerja';
		}

		$this->berkas_model->id_user = $this->user_id;
		$order = $this->berkas_model->get_for_export($this->user_level);


		$objPHPExcel = new PHPExcel();
        $objPHPExcel = PHPExcel_IOFactory::load("template/".$kertas.".xls");
		// $objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
		// ->setLastModifiedBy("Maarten Balliauw")
		// ->setTitle("Office 2007 XLSX Test Document")
		// ->setSubject("Office 2007 XLSX Test Document")
		// ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
		// ->setKeywords("office 2007 openxml php")
		// ->setCategory("Test result file");

            $baris  = 11;
            $no=1;

            foreach ($order as $frow){

            $data['detail'] = $frow;

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

			$detail = $data['detail'];
			$uk1_nama = $data['uk1_nama'];
			$uk2_nama = $data['uk2_nama'];
			$uk3_nama = $data['uk3_nama'];
			$uk4_nama = $data['uk4_nama'];

                $styleArray = array(
                  'borders' => array(
                    'allborders' => array(
                      'style' => PHPExcel_Style_Border::BORDER_THIN
                    )
                  )
                );
                $objPHPExcel->setActiveSheetIndex(0)->setCellValue("A".$baris, $no);
                $objPHPExcel->setActiveSheetIndex(0)->setCellValue("B".$baris, $uk1_nama); 
                $objPHPExcel->setActiveSheetIndex(0)->setCellValue("C".$baris, $uk2_nama); 
                $objPHPExcel->setActiveSheetIndex(0)->setCellValue("D".$baris, $uk3_nama); 
                $objPHPExcel->setActiveSheetIndex(0)->setCellValue("E".$baris, $uk4_nama);  
                $objPHPExcel->setActiveSheetIndex(0)->setCellValue("F".$baris, $frow->nama_kegiatan);  
                $objPHPExcel->setActiveSheetIndex(0)->setCellValue("G".$baris, site_url('admin/berkas/detail/').'/'.$frow->id_berkas);  

                $objPHPExcel->getActiveSheet()->getStyle('A'.$baris)->applyFromArray($styleArray);
                $objPHPExcel->getActiveSheet()->getStyle('B'.$baris)->applyFromArray($styleArray);
                $objPHPExcel->getActiveSheet()->getStyle('C'.$baris)->applyFromArray($styleArray);
                $objPHPExcel->getActiveSheet()->getStyle('D'.$baris)->applyFromArray($styleArray);
                $objPHPExcel->getActiveSheet()->getStyle('E'.$baris)->applyFromArray($styleArray);
                $objPHPExcel->getActiveSheet()->getStyle('F'.$baris)->applyFromArray($styleArray);
                $objPHPExcel->getActiveSheet()->getStyle('G'.$baris)->applyFromArray($styleArray);
                 
                $baris++;
                $no++;
            }

             $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C6', tanggal(date('Y-m-d')).' '.stime(date('H:i:s')));
             $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C7', $uk);
             $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C8', $rentang);

// Rename worksheet
		$objPHPExcel->getActiveSheet()->setTitle('Halaman 1');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel2007)
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="'.$nama_file.'.xls"');
		header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
		header('Cache-Control: max-age=1');

		// If you're serving to IE over SSL, then the following may be needed
		header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
		header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
		header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
		header ('Pragma: public'); // HTTP/1.0

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		$objWriter->save('php://output');
	}
}
?>