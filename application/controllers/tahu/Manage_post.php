<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manage_post extends CI_Controller {
	public $user_id;

	public function __construct(){
		parent ::__construct();	
		$this->user_id = $this->session->userdata('user_id');
		$this->load->model('tahu/post_model');
		$this->load->model('user_model');
		$this->load->model('tahu/video_model');
		$this->load->model('tahu/visitor_model');
		$this->user_model->user_id = $this->user_id;
		$this->user_model->set_user_by_user_id();
		$this->user_picture = $this->user_model->user_picture;
		$this->full_name	= $this->user_model->full_name;
		$this->user_level	= $this->user_model->level;

		// if($this->session->userdata("user_level")>1){
		// 	redirect("home");
		// }
		
		$this->user_privileges	= $this->user_model->user_privileges;
		$array_privileges = explode(';', $this->user_privileges);

		// print_r($array_privileges);die;

		if (($this->user_level!="Administrator" && $this->user_level!="Admin Web") && !in_array('web_skpd', $array_privileges)) redirect ('welcome'); 
	}

	public function index()
	{
		if ($this->user_id)
		{
			$data['title']		= "Berita - ". app_name;
			$data['content']	= "tahu/post/index" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			
			$data['user_level']		= $this->user_level;
			if (!empty($_GET['s'])) {
				$this->post_model->search = $_GET['s'];
				$data['search'] = $_GET['s'];
			}
			
			$data['per_page']	= 10;
			$this->post_model->author = $this->user_id;
			$where_author = ['id_skpd' => $this->session->userdata('id_skpd')];
			$where_publish = ['post_status' => 'Publish'];
			if ($this->session->userdata('user_level') == 1 || $this->session->userdata('user_level') == 6 || $this->session->userdata('user_level') == 7) {
				$this->post_model->author = null;
				$where_author = array();
			}
			$where_publish_author = array_merge($where_publish, $where_author);
			$data['total_rows']	= $this->post_model->get_total_row();
			$offset = 0;
			if (!empty($_GET['per_page'])) $offset = $_GET['per_page'] ;
			// if ($this->user_level!="Administrator" ) $this->post_model->author = $this->user_id;
			$data['query']		= $this->post_model->get_for_page($data['per_page'],$offset);
			$data['active_menu'] = "post";
			$data['offset']	= $offset;
			
			//Statistik
			// print_r($where_author);die;
			$data['berita'] = $this->post_model->get_where_total($where_author);
			$data['berita_publish'] = $this->post_model->get_where_total($where_publish_author);
			$data['berita_draft'] = $data['berita'] - $data['berita_publish'];
			$data['berita_pembaca'] = $this->visitor_model->get_total(['date(date)' => date('Y-m-d') , 'id_berita !=' => null]);
			$data['berita_terbaru'] = $this->post_model->get_all(1, $where_author);

			$this->load->view('admin/index',$data);

		}
		else
		{
			redirect('admin');
		}
	}

	public function add()
	{
		
		if ($this->user_id)
		{
			$data['title']		= "Tambah Berita - ". app_name;
			$data['content']	= "tahu/post/add" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "post";
			$data['level'] = $this->user_model->get_user_level();
			$this->load->helper('form');
			if (!empty($_POST))
			{
				if ($_POST['title'] !="" &&
					$_POST['content'] !="" &&
					$_POST['category_id'] !="" 
				)
				{
					$avaliable = $this->post_model->check_availability("",$_POST['title_slug'])	;
					if ($avaliable){
						$config['upload_path']          = './data/images/featured_image/uploads';
			            $config['allowed_types']        = 'gif|jpg|png|jpeg';
			            $config['max_size']             = 2000;
			            $config['max_width']            = 1500;
			            $config['max_height']           = 1500;
						$config['file_name']			= 'berita_'.date('Ymdhis');
						
						
			            $this->load->library('upload', $config);
			            if ( ! $this->upload->do_upload('userfile'))
		                {
							$this->post_model->picture 	= "";
		                    $tmp_name				= $_FILES['userfile']['tmp_name'];
		                    if ($tmp_name!="")
		                    {
		                    	$data['error']			= $this->upload->display_errors();
		                    }
		                }
		                else
		                {
		                	$this->post_model->picture = $this->upload->data('file_name');
		                }

		                $this->post_model->category_id = $_POST['category_id'];
		                $this->post_model->title = $_POST['title'];
		                $this->post_model->title_slug = $_POST['title_slug'];
		                $this->post_model->content = $_POST['content'];
		                $this->post_model->date = date('Y-m-d');
		                $this->post_model->time = date('H:i:s');
		                $this->post_model->author = $this->user_id;
		                $this->post_model->post_status = 'Draft';
		                $this->post_model->insert();
		                $data['message_type'] = "success";
		                $data['message']		= "Berita berhasil ditambahakan.";


		                //logs
							$this->load->model('logs_model');
							$this->logs_model->user_id	 = $this->session->userdata('user_id');
		                	$this->logs_model->activity = "has been add post";
		                	$this->logs_model->category = "add";
		                	$desc = $_POST['title'];
		                	$this->logs_model->description = "with names ".$desc;
							$this->logs_model->insert();

		            }
		            else{
		            	$data['message_type'] = "danger";
						$data['message'] = "<strong>Opps..</strong> Judul berita sudah digunakan, silahkan coba yang lain.";
		            }
				}
				else
				{
					$data['message_type'] = "warning";
					$data['message'] = "<strong>Opps..</strong> Data belum lengkap. silahkan lengkapi dulu!";
				}
			}
			$this->load->model('category_model');
			$this->category_model->category_status = "Active";
			$data['categories']	= $this->category_model->get_all();
			$this->load->view('admin/index',$data);
			
		}
		else
		{
			redirect('admin');	
		}
	}
	
	public function edit($post_id)
	{

		if ($this->user_id)
		{

			$data['title']		= "Edit Berita - ". app_name;
			$data['content']	= "tahu/post/edit" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "post";
			$data['level'] = $this->user_model->get_user_level();
			$this->load->helper('form');
			$this->post_model->post_id = $post_id;
			if (!empty($_POST))
			{
				if ($_POST['title'] !="" &&
					$_POST['content'] !="" &&
					// $_POST['date'] !="" &&
					// $_POST['time'] !="" &&
					// $_POST['post_status'] !="" &&
					$_POST['category_id'] !="" 
				)
				{
					
					$avaliable = $this->post_model->check_availability($_POST['old_title_slug'],$_POST['title_slug'])	;
					if ($avaliable){
						$config['upload_path']          = './data/images/featured_image/uploads';
			            $config['allowed_types']        = 'gif|jpg|png|jpeg';
			            $config['max_size']             = 2000;
			            $config['max_width']            = 1500;
			            $config['max_height']           = 1500;
						$config['file_name']			= 'berita_'.date('Ymdhis');

			            $this->load->library('upload', $config);
			            if ( ! $this->upload->do_upload())
		                {
		                    $this->post_model->picture 	= "";
		                    $tmp_name				= $_FILES['userfile']['tmp_name'];
		                    if ($tmp_name!="")
		                    {
		                    	$data['error']			= $this->upload->display_errors();
		                    }
		                }
		                else
		                {
		                	$this->post_model->set_by_id();
		                	if ($this->post_model->picture !="") unlink('./data/images/featured_image/uploads/'.$this->post_model->picture);
		                	$this->post_model->picture = $this->upload->data('file_name');
		                }

		                $this->post_model->category_id = $_POST['category_id'];
		                $this->post_model->title = $_POST['title'];
		                $this->post_model->title_slug = trim($_POST['title_slug']);
		                $this->post_model->content = $_POST['content'];
		                $this->post_model->author = $this->user_id;
		                $this->post_model->edited_at = date('Y-m-d H:i:s');
		                $this->post_model->update();
		                $data['message_type'] = "success";
		                $data['message']		= "Berita berhasil diperbarui.";

		                 //logs
							$this->load->model('logs_model');
							$this->logs_model->user_id	 = $this->session->userdata('user_id');
		                	$this->logs_model->activity = "has been update post";
		                	$this->logs_model->category = "update";
		                	$desc = $_POST['title'];
		                	$this->logs_model->description = "with names ".$desc;
							$this->logs_model->insert();

		            }
		            else{
		            	$data['message_type'] = "danger";
						$data['message'] = "<strong>Opps..</strong> Judul berita sudah digunakan, silahkan coba yang lain.";
		            }
				}
				else
				{
					$data['message_type'] = "warning";
					$data['message'] = "<strong>Opps..</strong> Data belum lengkap. silahkan lengkapi dulu!";
				}
			}
			$this->load->model('category_model');
			$this->category_model->category_status = "Active";
			$data['categories']	= $this->category_model->get_all();
			$this->post_model->set_by_id();
			$data['post_title']	= $this->post_model->title;
			$data['title_slug']	= $this->post_model->title_slug;
			$data['post_content']	= $this->post_model->content;
			$data['date']	= $this->post_model->date;
			$data['time']	= $this->post_model->time;
			$data['post_status']	= $this->post_model->post_status;
			$data['picture']	= $this->post_model->picture;
			$data['category_id']	= $this->post_model->category_id;

			$this->load->view('admin/index',$data);
			
		}
		else
		{
			redirect('admin');	
		}
	}

	public function update_status($post_id){
		$this->post_model->post_id = $post_id;
		$detail = $this->post_model->get_by_id();
		if ($detail->post_status == 'Publish') {
			$this->post_model->post_status = 'Draft';
		}else{
			$this->post_model->post_status = 'Publish';
		}
		if ($this->post_model->update_status()) {
			redirect('tahu/manage_post');
		} 

	}

	public function delete($post_id)
	{
		if ($this->user_id)
		{
			$this->post_model->post_id = $post_id;
			$this->post_model->set_by_id();
			if ($this->post_model->picture !="") unlink('./data/images/featured_image/uploads/'.$this->post_model->picture);
			$this->post_model->delete();
			redirect('tahu/manage_post');
		}
		else
		{
			redirect('home');
		}
	}
	
	public function berita2()
	{

			$this->load->view('admin/data_berita');
		
	}

	public function import_video()
	{
		if ( isset($_POST['import'])) {

            $file = $_FILES['video']['tmp_name'];

			// Medapatkan ekstensi file csv yang akan diimport.
			$ekstensi  = explode('.', $_FILES['video']['name']);

			// Tampilkan peringatan jika submit tanpa memilih menambahkan file.
			if (empty($file)) {
				echo 'File tidak boleh kosong!';
			} else {
				// Validasi apakah file yang diupload benar-benar file csv.
				if (strtolower(end($ekstensi)) === 'csv' && $_FILES["video"]["size"] > 0) {

					$i = 0;
					$handle = fopen($file, "r");
					while (($row = fgetcsv($handle, 2048))) {
						$i++;
						// print_r($row);die;
						if ($i == 1) continue;
						// print_r($row);die;
						
						// Data yang akan disimpan ke dalam databse
		                $this->video_model->judul = $row[2];
		                $this->video_model->link = ($row[4]) ? $row[4] : 'Belum ada content';
		                $this->video_model->date_video = date('Y-m-d', strtotime($row[1]));
		                $this->video_model->content = ($row[5]) ? $row[5] : 'Belum ada content';
		                $this->video_model->category_video_id = 1;

						// Simpan data ke database.
						if ($this->video_model->insert_percobaan()) {
							echo "<script>console.log('".$this->video_model->judul." Berhasil ditambahkan')</script>";
						}else {
							echo "<script>console.log('".$this->video_model->judul." Gagal ditambahkan')</script>";
						}
					}

					fclose($handle);
					redirect('tahu/manage_post/import_video');

				} else {
					echo 'Format file tidak valid!';
				}
			}
        }else{
			$this->load->view('admin/post/import_video');
		}
	}

	public function import_berita()
	{
		if (isset($_POST['import'])) {

            $file = $_FILES['berita']['tmp_name'];

			// Medapatkan ekstensi file csv yang akan diimport.
			$ekstensi  = explode('.', $_FILES['berita']['name']);

			// Tampilkan peringatan jika submit tanpa memilih menambahkan file.
			if (empty($file)) {
				echo 'File tidak boleh kosong!';
			} else {
				// Validasi apakah file yang diupload benar-benar file csv.
				if (strtolower(end($ekstensi)) === 'csv' && $_FILES["berita"]["size"] > 0) {

					$i = 0;
					$handle = fopen($file, "r");
					while (($row = fgetcsv($handle, 2048))) {
						$i++;
						// print_r($row);die;
						if ($i == 1) continue;
						// echo 'slug_berita_'.date('Ymdhis');die;
						// print_r($row);die;
						
						// Data yang akan disimpan ke dalam databse
		                $this->post_model->category_id = 9;
						$title = $row[1];
						if (!$row[1]) {
							$title = 'Berita '.date('Ymdhis');
						}
		                $this->post_model->title = $title;
						$title_slug = $row[8];
						if (!$row[8]) {
							$title_slug = 'berita_'.date('Ymdhis');
						}
		                $this->post_model->title_slug = $title_slug;
		                $this->post_model->content = $row[3];
		                $this->post_model->date = date('Y-m-d', strtotime($row[10]));
		                $this->post_model->time = date('H:i:s', strtotime($row[10]));
		                $this->post_model->picture = $row[6];
						$penulis = 23;
						if ($row[5] == 'Sekda') {
							$penulis = 354;
						}elseif ($row[5] == 'Diskominfosanditik') {
							$penulis = 355;
						}elseif ($row[5] == 'DPPKB') {
							$penulis = 356;
						}elseif ($row[5] == 'SITURAJA') {
							$penulis = 357;
						}elseif ($row[5] == 'TANJUNGSARI') {
							$penulis = 358;
						}elseif ($row[5] == 'Sek DPRD') {
							$penulis = 359;
						}elseif ($row[5] == 'DLHK') {
							$penulis = 360;
						}elseif ($row[5] == 'DPK2O') {
							$penulis = 361;
						}elseif ($row[5] == 'RSUD') {
							$penulis = 362;
						}elseif ($row[5] == 'DAP') {
							$penulis = 363;
						}elseif ($row[5] == 'SUKASARI') {
							$penulis = 364;
						}elseif ($row[5] == 'BKPSM') {
							$penulis = 365;
						}elseif ($row[5] == 'TOMO') {
							$penulis = 366;
						}elseif ($row[5] == 'CIMANGGUNG') {
							$penulis = 367;
						}elseif ($row[5] == 'SUMEDANG SELATAN') {
							$penulis = 367;
						}elseif ($row[5] == 'DinPUPR') {
							$penulis = 367;
						}elseif ($row[5] == 'BPKAD') {
							$penulis = 367;
						}elseif ($row[5] == 'SURIAN') {
							$penulis = 367;
						}else{
							$penulis = 23;
						}
		                $this->post_model->author = $penulis;
						$status = $row[9];
						if ($row[9] != 'Publish' ) {
							$status = 'Draft';
						}
		                $this->post_model->post_status = $status;

						// Simpan data ke database.
						if ($this->post_model->insert()) {
							echo "<script>console.log('".$this->post_model->judul." Berhasil ditambahkan')</script>";
						}else {
							echo "<script>console.log('".$this->post_model->judul." Gagal ditambahkan')</script>";
						}
					}

					fclose($handle);
					redirect('tahu/manage_post/import_berita');

				} else {
					echo 'Format file tidak valid!';
				}
			}
        }else{
			$this->load->view('admin/post/import_berita');
		}
	}
		
}
?>