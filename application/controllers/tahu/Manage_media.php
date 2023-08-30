<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manage_media extends CI_Controller {
	public $user_id;

	public function __construct(){
		parent ::__construct();	
		$this->user_id = $this->session->userdata('user_id');
		$this->load->model('gallery_model');
		$this->load->model('user_model');
		// $this->load->model('navigasi_menu_model');
		
		$this->user_model->user_id = $this->user_id;
		$this->user_model->set_user_by_user_id();
		$this->user_picture = $this->user_model->user_picture;
		$this->full_name	= $this->user_model->full_name;
		$this->user_level	= $this->user_model->level;

		$this->user_privileges	= $this->user_model->user_privileges;
		$array_privileges = explode(';', $this->user_privileges);

		if (!in_array('web_skpd', $array_privileges)) redirect ('welcome');
		
	}
	public function gallery()
	{
		if ($this->user_id)
		{

			$data['title']		= "Galeri - ". app_name;
			$data['content']	= "media/gallery/index" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			
			if (!empty($_GET['s'])) {
				$this->post_model->search = $_GET['s'];
				$data['search'] = $_GET['s'];
			}
			
			
			$data['query']		= $this->gallery_model->get_album();
			$data['active_menu'] = "media";
			$this->load->view('admin/index',$data);

		}
		else
		{
			redirect('admin');
		}
	}
	public function create_album()
	{
		if ($this->user_id)
		{
			$data['title']		= "Buat Album - ". app_name;
			$data['content']	= "media/gallery/create_album" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			
			$this->load->helper('form');
			if (!empty($_POST))
			{
				if ($_POST['album_title'] !="" &&
					$_POST['description'] !="" 
				)
				{
						$config['upload_path']          = './data/images/album/';
			            $config['allowed_types']        = 'gif|jpg|png';
			            $config['max_size']             = 2000;
			            $config['max_width']            = 2000;
			            $config['max_height']           = 2000;

			            $this->load->library('upload', $config);
			            if ( ! $this->upload->do_upload())
		                {
		                    $this->gallery_model->album_picture 	= "album.jpg";
		                    $tmp_name				= $_FILES['userfile']['tmp_name'];
		                    if ($tmp_name!="")
		                    {
		                    	$data['error']			= $this->upload->display_errors();
		                    }
		                }
		                else
		                {
		                	$this->gallery_model->album_picture = $this->upload->data('file_name');
		                }

		                $this->gallery_model->album_title = $_POST['album_title'];
		                $this->gallery_model->album_description = $_POST['description'];
		                $this->gallery_model->create_album();
		                $data['message_type'] = "success";
		                $data['message']		= "Album has been created successfully.";

		                //logs
						$this->load->model('logs_model');
						$this->logs_model->user_id	 = $this->session->userdata('user_id');
	                	$this->logs_model->activity = "has been added album";
	                	$this->logs_model->category = "add";
	                	$desc = $_POST['album_title'];
	                	$this->logs_model->description = "with names ".$desc;
						$this->logs_model->insert();

				}
				else
				{
					$data['message_type'] = "warning";
					$data['message'] = "<strong>Opps..</strong> Data not complete. Please complete it!";
				}
			}
					
			$data['active_menu'] = "media";
			$this->load->view('admin/index',$data);

		}
		else
		{
			redirect('admin');
		}
	}
	public function edit_album($album_id)
	{
		if ($this->user_id)
		{
			$data['title']		= "Edit Album - ". app_name;
			$data['content']	= "media/gallery/edit_album" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			
			$this->gallery_model->album_id = $album_id;
			$this->load->helper('form');
			if (!empty($_POST))
			{
				if ($_POST['album_title'] !="" &&
					$_POST['description'] !="" 
				)
				{
						$config['upload_path']          = './data/images/album/';
			            $config['allowed_types']        = 'gif|jpg|png';
			            $config['max_size']             = 2000;
			            $config['max_width']            = 2000;
			            $config['max_height']           = 2000;

			            $this->load->library('upload', $config);
			            if ( ! $this->upload->do_upload())
		                {
		                    $this->gallery_model->album_picture 	= "";
		                    $tmp_name				= $_FILES['userfile']['tmp_name'];
		                    if ($tmp_name!="")
		                    {
		                    	$data['error']			= $this->upload->display_errors();
		                    }
		                }
		                else
		                {
		                	$this->gallery_model->set_album_by_id();
							if ($this->gallery_model->album_picture !="album.jpg") unlink('./data/images/album/'.$this->gallery_model->album_picture);
		                	$this->gallery_model->album_picture = $this->upload->data('file_name');
		                }

		                $this->gallery_model->album_title = $_POST['album_title'];
		                $this->gallery_model->album_description = $_POST['description'];
		                $this->gallery_model->update_album();
		                $data['message_type'] = "success";
		                $data['message']		= "Album has been updated successfully.";

		                //logs
						$this->load->model('logs_model');
						$this->logs_model->user_id	 = $this->session->userdata('user_id');
	                	$this->logs_model->activity = "has been updated album";
	                	$this->logs_model->category = "update";
	                	$desc = $_POST['album_title'];
	                	$this->logs_model->description = "with names ".$desc;
						$this->logs_model->insert();


				}
				else
				{
					$data['message_type'] = "warning";
					$data['message'] = "<strong>Opps..</strong> Data not complete. Please complete it!";
				}
			}
					
			$data['active_menu'] = "media";
			$this->gallery_model->set_album_by_id();
			$data['album_id']	= $album_id;
			$data['album_title']	= $this->gallery_model->album_title;
			$data['album_description']	= $this->gallery_model->album_description;
			$data['album_picture']	= $this->gallery_model->album_picture;
			$this->load->view('admin/index',$data);

		}
		else
		{
			redirect('admin');
		}
	}
	public function delete_album($id)
	{
		if ($this->user_id)
		{
			$this->gallery_model->album_id = $id;
			$this->gallery_model->set_album_by_id();
			if ($this->gallery_model->album_picture !="album.jpg") unlink('./data/images/album/'.$this->gallery_model->album_picture);
			$this->gallery_model->delete_album();
			redirect('manage_media/gallery');
		}
		else
		{
			redirect('home');
		}
	}
	public function album($album_id)
	{
		if ($this->user_id)
		{
			$data['title']		= "Album - ". app_name;
			$data['content']	= "media/gallery/album" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			
			if ($album_id!="untitled"){
				$this->gallery_model->album_id = $album_id;
				
				$this->gallery_model->set_album_by_id();
				$data['album_title'] = $this->gallery_model->album_title;
				$data['album_id']	= $album_id;
			}
			else
			{
				$data['album_title'] = "Untitled";
				$data['album_id']	= "untitled";
			}
			$data['query']		= $this->gallery_model->get_gallery();
			$data['active_menu'] = "media";

			$this->load->view('admin/index',$data);

		}
		else
		{
			redirect('admin');
		}
	}
	public function delete_gallery($album_id,$picture)
	{
		if ($this->user_id)
		{
			$this->gallery_model->picture = $picture;
			unlink('./data/upload/'.$picture);
			$this->gallery_model->delete_gallery();
			$link ="manage_media/album/$album_id";
			redirect($link);
		}
		else
		{
			redirect('home');
		}
	}
	public function upload($album_id)
	{
		// A list of permitted file extensions
		$this->load->model('gallery_model');
		$allowed = array('png', 'jpg','jpeg','gif');

		if(isset($_FILES['upl']) && $_FILES['upl']['error'] == 0){

			$extension = pathinfo($_FILES['upl']['name'], PATHINFO_EXTENSION);

			if(!in_array(strtolower($extension), $allowed)){
				echo '{"status":"error"}';
				exit;
			}

			if(move_uploaded_file($_FILES['upl']['tmp_name'], 'data/upload/'.$_FILES['upl']['name'])){
				if ($album_id>0){
					$this->gallery_model->album_id = $album_id;
					$this->gallery_model->picture = $_FILES['upl']['name'];
					$this->gallery_model->insert_gallery();
				}
				echo '{"status":"success"}';

				exit;
			}
		}
		else{
			echo '{"status":"error"}';
		}
		exit;
	}
	public function update_gallery($album_id)
	{
		if ($this->user_id)
		{
			$query	= $this->gallery_model->get_gallery();
			$obj = "";
			$dir = "data/upload";
			if ($album_id=="untitled"){
				$files = scandir($dir,1);
				$files2 = array();
				$x = 0;
				foreach ($query as $row) {
					$files2[$x]	= $row->picture;
					$x++;
				}
				foreach ($files as $file) {
					$cek = (array_search($file, $files2) === false ) ? TRUE : FALSE;
					if ($cek){
						$explode_file = explode(".", $file);
						$count = count($explode_file);
						if ($count>0) 
							$ext	= $explode_file[$count-1];
						else
							$ext 	= "";
						$img = base_url().$dir."/".$file;
						if ($ext=="jpg" || $ext=="png" || $ext=="gif" || $ext=="jpeg"){
						$obj.="
							<div class='col-sm-2 col-xs-4' data-tag='$ext'>
					
								<article class='image-thumb'>
									
									<a href='#' class='image'>
										<img src='$img' />
									</a>
									
									<div class='image-options'>
										<a href='#' onclick='jQuery(\"#confirm\").modal(\"show\");delete_(\"$album_id\",\"$file\")'><i class='entypo-cancel'></i></a>
									</div>
									
								</article>
							
							</div>
						";
						}
					}
					
				}
			}
			else{
				$this->gallery_model->album_id = $album_id;
				$query = $this->gallery_model->get_gallery();
				foreach ($query as $row) {
					$explode_file = explode(".", $row->picture);
						$count = count($explode_file);
						if ($count>0) 
							$ext	= $explode_file[$count-1];
						else
							$ext 	= "";
						$img = base_url().$dir."/".$row->picture;
						if ($ext=="jpg" || $ext=="png" || $ext=="gif" || $ext=="jpeg"){
						$obj .="
							<div class='col-sm-2 col-xs-4' data-tag='$ext'>
					
								<article class='image-thumb'>
									
									<a href='#' class='image'>
										<img src='$img' />
									</a>
									
									<div class='image-options'>
										
										<a href='#' onclick='jQuery(\"#confirm\").modal(\"show\");delete_(\"$album_id\",\"$row->picture\")'><i class='entypo-cancel'></i></a>
									</div>
									
								</article>
							
							</div>
						";
						}
					}
			}
			die($obj);
		}
		else
		{
			redirect('home');
		}
	}

	public function img_header()
	{
		if ($this->user_id)
		{
			$data['title']		= "Gambar Header - ". app_name;
			$data['content']	= "media/img_header/index" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			
			$this->load->model('img_header_model');
			$data['query']		= $this->img_header_model->get_all();
			$data['active_menu'] = "media";
			$this->load->view('admin/index',$data);

		}
		else
		{
			redirect('admin');
		}
	}

	public function add_img_header()
	{
		if ($this->user_id)
		{
			$this->load->model('img_header_model');
			$data['title']		= "Tambah Gambar Header - ". app_name;
			$data['content']	= "media/img_header/add" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			
			$data['active_menu'] = "media";
			$this->load->helper('form');
			if (!empty($_POST))
			{
				if ($_POST['judul'] !="" &&
					$_POST['status'] !=""  
				)
				{
						$config['upload_path']          = './data/images/header/';
			            $config['allowed_types']        = 'gif|jpg|png|jpeg';
			            $config['max_size']             = 10000;
			            $config['max_width']            = 5000;
			            $config['max_height']           = 5000;

			            $this->load->library('upload', $config);
			            if ( ! $this->upload->do_upload())
		                {
		                    $data['message_type'] = "warning";
		                    $data['message']			= $this->upload->display_errors();
		                }
		                else
		                {
		                	$this->img_header_model->gbr_header = $this->upload->data('file_name');
		                	$this->img_header_model->judul = $_POST['judul'];
		                	$this->img_header_model->deskripsi = $_POST['deskripsi'];
		                	$this->img_header_model->link = $_POST['link'];
			                $this->img_header_model->status= $_POST['status'];
			                $this->img_header_model->urutan= $_POST['urutan'];
			                //$this->img_header_model->id_services= $_POST['id_services'];
			                $this->img_header_model->insert();
			                $data['message_type'] = "success";
			                $data['message']		= "Gambar Header berhasil ditambahkan.";

			                 //logs
							$this->load->model('logs_model');
							$this->logs_model->user_id	 = $this->session->userdata('user_id');
		                	$this->logs_model->activity = "telah menambahkan gambar header";
		                	$this->logs_model->category = "add";
		                	$desc = $_POST['judul'];
		                	$this->logs_model->description = "with names ".$desc;
							$this->logs_model->insert();

			           
		                }

		               
				}
				else
				{
					$data['message_type'] = "warning";
					$data['message'] = "<strong>Opps..</strong> Data belum lengkap, silahkan lengkapi dulu!";
				}
			}
			
			$this->load->view('admin/index',$data);
			
		}
		else
		{
			redirect('admin');	
		}
	}
	public function edit_img_header($id_header)
	{
		if ($this->user_id)
		{
			$this->load->model('img_header_model');
			$this->img_header_model->id_header = $id_header;
			$data['title']		= "Edit image header - ". app_name;
			$data['content']	= "media/img_header/edit" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			
			$data['active_menu'] = "media";
			$this->load->helper('form');
			if (!empty($_POST))
			{
				if ($_POST['judul'] !="" &&
					$_POST['status'] !=""  
				)
				{
						$config['upload_path']          = './data/images/header/';
			            $config['allowed_types']        = 'gif|jpg|png|jpeg';
			            $config['max_size']             = 10000;
			            $config['max_width']            = 5000;
			            $config['max_height']           = 5000;

			            $this->load->library('upload', $config);
			            if ( ! $this->upload->do_upload())
		                {
		                    $this->img_header_model->gbr_header 	= "";
		                    $tmp_name				= $_FILES['userfile']['tmp_name'];
		                    if ($tmp_name!="")
		                    {
		                    	$data['error']			= $this->upload->display_errors();
		                    }
		                
		                }
		                else
		                {
		                	$this->img_header_model->set();
		                	if ($this->img_header_model->gbr_header !="") unlink('./data/images/header/'.$this->img_header_model->gbr_header);
			           		$this->img_header_model->gbr_header = $this->upload->data('file_name');
		                }

		               	$this->img_header_model->judul = $_POST['judul'];
			            $this->img_header_model->status= $_POST['status'];
		                	$this->img_header_model->deskripsi = $_POST['deskripsi'];
		                	$this->img_header_model->link = $_POST['link'];
		                	$this->img_header_model->urutan = $_POST['urutan'];
		                	//$this->img_header_model->id_services = $_POST['id_services'];
			            $this->img_header_model->update();
			            $data['message_type'] = "success";
			            $data['message']		= "Gambar Header berhasil diperbarui.";

		              //logs
						$this->load->model('logs_model');
						$this->logs_model->user_id	 = $this->session->userdata('user_id');
	                	$this->logs_model->activity = "telah memperbarui gamabr header";
	                	$this->logs_model->category = "update";
	                	$desc = $_POST['judul'];
	                	$this->logs_model->description = "with names ".$desc;
						$this->logs_model->insert();

				}
				else
				{
					$data['message_type'] = "warning";
					$data['message'] = "<strong>Opps..</strong> Data belum lengkap, silahkan lengkapi dulu!";
				}
			}
			$this->img_header_model->set();
			$data['judul'] = $this->img_header_model->judul;
			$data['deskripsi'] = $this->img_header_model->deskripsi;
			$data['link'] = $this->img_header_model->link;
			$data['status'] = $this->img_header_model->status;
			$data['gbr_header'] = $this->img_header_model->gbr_header;
			$data['urutan'] = $this->img_header_model->urutan;
			$this->load->view('admin/index',$data);
			
		}
		else
		{
			redirect('admin');	
		}
	}

	public function delete_img_header($id_header)
	{
		if ($this->user_id)
		{
			$this->load->model('img_header_model');
			$this->img_header_model->id_header = $id_header;
			$this->img_header_model->set();
			if ($this->img_header_model->gbr_header !="") unlink('./data/images/header/'.$this->img_header_model->gbr_header);
			$this->img_header_model->delete();
			redirect('manage_media/img_header');
		}
		else
		{
			redirect('home');
		}
	}
	public function banner()
	{
		if ($this->user_id)
		{
			$data['title']		= "Banner - ". app_name;
			$data['content']	= "tahu/banner/index" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			
			$this->load->model('tahu/banner_model');
			$data['query']		= $this->banner_model->get_all();
			$data['active_menu'] = "media";
			$this->load->view('admin/index',$data);

		}
		else
		{
			redirect('admin');
		}
	}

	public function add_banner()
	{
		if ($this->user_id)
		{
			$this->load->model('banner_model');
			$data['title']		= "Tambah Banner` - ". app_name;
			$data['content']	= "tahu/banner/add" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			
			$data['active_menu'] = "media";
			$this->load->helper('form');
			if (!empty($_POST))
			{
				if ($_POST['judul'] !="" &&
					$_POST['url'] !=""  
				)
				{
						$config['upload_path']          = './data/images/banner/';
			            $config['allowed_types']        = 'gif|jpg|png';
			            $config['max_size']             = 2000;
			            $config['max_width']            = 2000;
			            $config['max_height']           = 2000;

			            $this->load->library('upload', $config);
			            if ( ! $this->upload->do_upload())
		                {
		                    $data['message_type'] = "warning";
		                    $data['message']			= $this->upload->display_errors();
		                }
		                else
		                {
		                	$this->banner_model->gambar = $this->upload->data('file_name');
		                	$this->banner_model->judul = $_POST['judul'];
			                $this->banner_model->url= $_POST['url'];
			                $this->banner_model->insert();
			                $data['message_type'] = "success";
			                $data['message']		= "Banner berhasil ditambahkan.";


			                  //logs
							$this->load->model('logs_model');
							$this->logs_model->user_id	 = $this->session->userdata('user_id');
		                	$this->logs_model->activity = "telah menambahkan banner";
		                	$this->logs_model->category = "add";
		                	$desc = $_POST['judul'];
		                	$this->logs_model->description = "with names ".$desc;
							$this->logs_model->insert();

			           
		                }

		               
				}
				else
				{
					$data['message_type'] = "warning";
					$data['message'] = "<strong>Opps..</strong> Data belum lengkap, silahkan lengkapi dulu!";
				}
			}
			$this->load->view('admin/index',$data);
			
		}
		else
		{
			redirect('admin');	
		}
	}
	public function edit_banner($id_banner)
	{
		if ($this->user_id)
		{
			$this->load->model('banner_model');
			$this->banner_model->id_banner = $id_banner;
			$data['title']		= "Edit Banner - ". app_name;
			$data['content']	= "tahu/banner/edit" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			
			$data['active_menu'] = "media";
			$this->load->helper('form');
			if (!empty($_POST))
			{
				if ($_POST['judul'] !="" &&
					$_POST['url'] !=""  
				)
				{
						$config['upload_path']          = './data/images/banner/';
			            $config['allowed_types']        = 'gif|jpg|png';
			            $config['max_size']             = 2000;
			            $config['max_width']            = 2000;
			            $config['max_height']           = 2000;

			            $this->load->library('upload', $config);
			            if ( ! $this->upload->do_upload())
		                {
		                    $this->banner_model->gambar 	= "";
		                    $tmp_name				= $_FILES['userfile']['tmp_name'];
		                    if ($tmp_name!="")
		                    {
		                    	$data['error']			= $this->upload->display_errors();
		                    }
		                
		                }
		                else
		                {
		                	$this->banner_model->set();
		                	if ($this->banner_model->gambar !="") unlink('./data/images/banner/'.$this->banner_model->gambar);
			           		$this->banner_model->gambar = $this->upload->data('file_name');
		                }

		               	$this->banner_model->judul = $_POST['judul'];
			            $this->banner_model->url= $_POST['url'];
			            $this->banner_model->update();
			            $data['message_type'] = "success";
			            $data['message']		= "Banner telah berhasil diperbarui.";


			               //logs
							$this->load->model('logs_model');
							$this->logs_model->user_id	 = $this->session->userdata('user_id');
		                	$this->logs_model->activity = "has been update banner";
		                	$this->logs_model->category = "update";
		                	$desc = $_POST['judul'];
		                	$this->logs_model->description = "with names ".$desc;
							$this->logs_model->insert();


				}
				else
				{
					$data['message_type'] = "warning";
					$data['message'] = "<strong>Opps..</strong> Data belum lengkap, silahkan lengkapi dulu!";
				}
			}
			$this->banner_model->set();
			$data['judul'] = $this->banner_model->judul;
			$data['url'] = $this->banner_model->url;
			$data['gambar'] = $this->banner_model->gambar;
			$this->load->view('admin/index',$data);
			
		}
		else
		{
			redirect('admin');	
		}
	}

	public function delete_banner($id_banner)
	{
		if ($this->user_id)
		{
			$this->load->model('banner_model');
			$this->banner_model->id_banner = $id_banner;
			$this->banner_model->set();
			if ($this->banner_model->gambar !="") unlink('./data/images/banner/'.$this->banner_model->gambar);
			$this->banner_model->delete();
			redirect('manage_media/banner');
		}
		else
		{
			redirect('home');
		}
	}

	public function download()
	{
		if ($this->user_id)
		{
			$data['title']		= "Unduhan - ". app_name;
			$data['content']	= "tahu/download/index" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			
			$this->load->model('tahu/download_model');
			$data['query']		= $this->download_model->get_all();
			$data['active_menu'] = "media";
			$this->load->view('admin/index',$data);

		}
		else
		{
			redirect('admin');
		}
	}

	public function add_download()
	{
		if ($this->user_id)
		{
			$this->load->model('tahu/download_model');
			$data['title']		= "Tambah Berkas Unduhan` - ". app_name;
			$data['content']	= "tahu/download/add" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;

			$this->load->model('tahu/category_download_model');
			$data['category'] = $this->category_download_model->get_all();
			
			$data['active_menu'] = "media";
			$this->load->helper('form');
			if (!empty($_POST))
			{
				
				if ($_POST['judul'] !="" )
				{
						$config['upload_path']          = './data/download/';
			            $config['allowed_types']        = '*';
			            $config['max_size']             = 5000;
			            //$config['max_width']            = 2000;
			            //$config['max_height']           = 2000;

			            $this->load->library('upload', $config);
			            if ( ! $this->upload->do_upload())
		                {
		                    $data['message_type'] = "warning";
		                    $data['message']			= $this->upload->display_errors();
		                    $this->download_model->nama_file = "";
		                }
		                else
		                {
		                	$this->download_model->nama_file = $this->upload->data('file_name');
		                }

		                	$this->download_model->judul = $_POST['judul'];
		                	$this->download_model->link = $_POST['link'];
		                	$this->download_model->category_id = $_POST['category_id'];
		                	$this->download_model->detail = $_POST['detail'];
			                $this->download_model->insert();
			                $data['message_type'] = "success";
			                $data['message']		= "Berkas Unduhan berhasil ditambahkan.";


			                 //logs
							$this->load->model('logs_model');
							$this->logs_model->user_id	 = $this->session->userdata('user_id');
		                	$this->logs_model->activity = "has been add download";
		                	$this->logs_model->category = "add";
		                	$desc = $_POST['judul'];
		                	$this->logs_model->description = "with names ".$desc;
							$this->logs_model->insert();

			           
		               
				}
				else
				{
					$data['message_type'] = "warning";
					$data['message'] = "<strong>Opps..</strong> Data belum lengkap, silahkan lengkapi dulu!";
				}
			}
			$this->load->view('admin/index',$data);
			
		}
		else
		{
			redirect('admin');	
		}
	}
	public function edit_download($id_download)
	{
		if ($this->user_id)
		{
			$this->load->model('tahu/download_model');
			$this->download_model->id_download = $id_download;
			$data['title']		= "Edit Unduhan - ". app_name;
			$data['content']	= "tahu/download/edit" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;

			$this->load->model('category_download_model');
			$data['category'] = $this->category_download_model->get_all();
			
			$data['active_menu'] = "media";
			$this->load->helper('form');
			if (!empty($_POST))
			{
				if ($_POST['judul'] !="" )
				{
						$config['upload_path']          = './data/download/';
			            $config['allowed_types']        = '*';
			            $config['max_size']             = 2000;
			            //$config['max_width']            = 2000;
			            //$config['max_height']           = 2000;

			            $this->load->library('upload', $config);
			            if ( ! $this->upload->do_upload())
		                {
		                    $this->download_model->nama_file 	= "";
		                    $tmp_name				= $_FILES['userfile']['tmp_name'];
		                    if ($tmp_name!="")
		                    {
		                    	$data['message_file']			= $this->upload->display_errors();
		                    }
		                
		                }
		                else
		                {
		                	$this->download_model->set();
		                	if ($this->download_model->nama_file !="") unlink('./data/download/'.$this->download_model->nama_file);
			           		$this->download_model->nama_file = $this->upload->data('file_name');
		                }

		               	$this->download_model->judul = $_POST['judul'];
	                	$this->download_model->link = $_POST['link'];
	                	$this->download_model->category_id = $_POST['category_id'];
	                	$this->download_model->detail = $_POST['detail'];
			            $this->download_model->update();
			            $data['message_type'] = "success";
			            $data['message']		= "Berkas Unduhan berhasil diperbarui.";


			               //logs
							$this->load->model('logs_model');
							$this->logs_model->user_id	 = $this->session->userdata('user_id');
		                	$this->logs_model->activity = "has been updated download";
		                	$this->logs_model->category = "update";
		                	$desc = $_POST['judul'];
		                	$this->logs_model->description = "with names ".$desc;
							$this->logs_model->insert();

				}
				else
				{
					$data['message_type'] = "warning";
					$data['message'] = "<strong>Opps..</strong> Data belum lengkap, silahkan lengkapi dulu!";
				}
			}
			$this->download_model->set();
			$data['judul'] = $this->download_model->judul;
			$data['nama_file'] = $this->download_model->nama_file;
			$data['category_id'] = $this->download_model->category_id;
			$data['detail'] = $this->download_model->detail;
			$data['link'] = $this->download_model->link;
			$this->load->view('admin/index',$data);
			
		}
		else
		{
			redirect('admin');	
		}
	}

	public function delete_download($id_download)
	{
		if ($this->user_id)
		{
			$this->load->model('download_model');
			$this->download_model->id_download = $id_download;
			$this->download_model->set();
			if ($this->download_model->nama_file !="") unlink('./data/download/'.$this->download_model->nama_file);
			$this->download_model->delete();
			redirect('manage_media/download');
		}
		else
		{
			redirect('home');
		}
	}

	public function navigasi_menu()
	{
		if ($this->user_id)
		{
			$data['title']		= "Navigasi Menu - ". app_name;
			$data['content']	= "media/navigasi_menu/index" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			
			$this->load->model('navigasi_menu_model');
			$data['query']		= $this->navigasi_menu_model->get_all();
			$data['active_menu'] = "media";
			$this->load->view('admin/index',$data);

		}
		else
		{
			redirect('admin');
		}
	}

	public function add_navigasi_menu()
	{
		if ($this->user_id)
		{
			$this->load->model('navigasi_menu_model');
			$data['title']		= "Tambah Navigasi Menu` - ". app_name;
			$data['content']	= "media/navigasi_menu/add" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			
			$data['active_menu'] = "media";
			$this->load->helper('form');
			if (!empty($_POST))
			{
				if ($_POST['judul'] !="" &&
					$_POST['url'] !=""  &&
					$_POST['isi'] !=""  
				)
				{
					$config['upload_path']          = './data/images/navigasi_menu/';
					$config['allowed_types']        = 'gif|jpg|png';
					$config['max_size']             = 5000;
					$config['max_width']            = 5000;
					$config['max_height']           = 5000;

					$this->load->library('upload', $config);
					if ( ! $this->upload->do_upload('bg_header'))
					{
						$data['message_type'] = "warning";
						$data['message']	= $this->upload->display_errors();
					}
					else
					{
					
					$this->navigasi_menu_model->bg_header = $this->upload->data('file_name');
					$this->navigasi_menu_model->judul = $_POST['judul'];
					$this->navigasi_menu_model->url= $_POST['url'];
					$this->navigasi_menu_model->isi= $_POST['isi'];
					$this->navigasi_menu_model->insert();
					$data['message_type'] = "success";
					$data['message']		= "Navigasi Menu berhasil ditambahkan.";


					  //logs
					$this->load->model('logs_model');
					$this->logs_model->user_id	 = $this->session->userdata('user_id');
					$this->logs_model->activity = "telah menambahkan navigasi menu";
					$this->logs_model->category = "add";
					$desc = $_POST['judul'];
					$this->logs_model->description = "with names ".$desc;
					$this->logs_model->insert();
					}

		               
				}
				else
				{
					$data['message_type'] = "warning";
					$data['message'] = "<strong>Opps..</strong> Data belum lengkap, silahkan lengkapi dulu!";
				}
			}
			$this->load->view('admin/index',$data);
			
		}
		else
		{
			redirect('admin');	
		}
	}
	public function edit_navigasi_menu($id_navigasi_menu)
	{
		if ($this->user_id)
		{
			$this->load->model('navigasi_menu_model');
			$this->navigasi_menu_model->id_navigasi_menu = $id_navigasi_menu;
			$data['title']		= "Edit Navigasi Menu - ". app_name;
			$data['content']	= "media/navigasi_menu/edit" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			
			$data['active_menu'] = "media";
			$this->load->helper('form');
			if (!empty($_POST))
			{
				if ($_POST['judul'] !="" &&
					$_POST['url'] !=""  
				)
				{
					$config['upload_path']          = './data/images/navigasi_menu/';
					$config['allowed_types']        = 'gif|jpg|png';
					$config['max_size']             = 5000;
					$config['max_width']            = 5000;
					$config['max_height']           = 5000;

					$this->load->library('upload', $config);
					if (!empty($this->upload->do_upload('bg_header')))
					{
						$this->navigasi_menu_model->set();
						if ($this->navigasi_menu_model->bg_header !=""){
							unlink('./data/images/navigasi_menu/'.$this->navigasi_menu_model->bg_header);
							$this->navigasi_menu_model->bg_header = $this->upload->data('file_name');
						}else{
							$this->navigasi_menu_model->bg_header = $this->upload->data('file_name');
						}
					}
					

					$this->navigasi_menu_model->judul = $_POST['judul'];
					$this->navigasi_menu_model->url= $_POST['url'];
					$this->navigasi_menu_model->isi= $_POST['isi'];
					$this->navigasi_menu_model->update();
					$data['message_type'] = "success";
					$data['message']		= "Navigasi Menu telah berhasil diperbarui.";


					   //logs
						$this->load->model('logs_model');
						$this->logs_model->user_id	 = $this->session->userdata('user_id');
						$this->logs_model->activity = "has been update navigasi menu";
						$this->logs_model->category = "update";
						$desc = $_POST['judul'];
						$this->logs_model->description = "with names ".$desc;
						$this->logs_model->insert();


				}
				else
				{
					$data['message_type'] = "warning";
					$data['message'] = "<strong>Opps..</strong> Data belum lengkap, silahkan lengkapi dulu!";
				}
			}
			$this->navigasi_menu_model->set();
			$data['judul'] = $this->navigasi_menu_model->judul;
			$data['url'] = $this->navigasi_menu_model->url;
			$data['isi'] = $this->navigasi_menu_model->isi;
			$data['bg_header'] = $this->navigasi_menu_model->bg_header;
			$this->load->view('admin/index',$data);
			
		}
		else
		{
			redirect('admin');	
		}
	}

	public function delete_navigasi_menu($id_navigasi_menu)
	{
		if ($this->user_id)
		{
			$this->load->model('navigasi_menu_model');
			$this->navigasi_menu_model->id_navigasi_menu = $id_navigasi_menu;
			$this->navigasi_menu_model->set();
			redirect('manage_media/navigasi_menu');
		}
		else
		{
			redirect('home');
		}
	}
	public function iklan_layanan()
	{
		if ($this->user_id)
		{
			$data['title']		= "Iklan Layanan - ". app_name;
			$data['content']	= "tahu/iklan_layanan/index" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			
			$this->load->model('tahu/iklan_layanan_model');
			$data['query']		= $this->iklan_layanan_model->get_all();
			$data['active_menu'] = "media";
			$this->load->view('admin/index',$data);

		}
		else
		{
			redirect('admin');
		}
	}

	public function add_iklan_layanan()
	{
		if ($this->user_id)
		{
			$this->load->model('tahu/iklan_layanan_model');
			$data['title']		= "Tambah Iklan Layanan - ". app_name;
			$data['content']	= "tahu/iklan_layanan/add" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			
			$data['active_menu'] = "media";
			$this->load->helper('form');
			if (!empty($_POST))
			{
				if ($_POST['nama_iklan'] !="" &&
					$_POST['status'] !=""  
				)
				{
						$config['upload_path']          = './data/images/iklan_layanan/';
			            $config['allowed_types']        = 'gif|jpg|png|jpeg';
			            $config['max_size']             = 10000;
			            $config['max_width']            = 5000;
			            $config['max_height']           = 5000;

			            $this->load->library('upload', $config);
			            if ( ! $this->upload->do_upload())
		                {
		                    $data['message_type'] = "warning";
		                    $data['message']			= $this->upload->display_errors();
		                }
		                else
		                {
		                	$this->iklan_layanan_model->gambar = $this->upload->data('file_name');
		                	$this->iklan_layanan_model->nama_iklan = $_POST['nama_iklan'];
		                	$this->iklan_layanan_model->deskripsi = $_POST['deskripsi'];
		                	$this->iklan_layanan_model->chanel = $_POST['chanel'];
			                $this->iklan_layanan_model->status= $_POST['status'];
			                $this->iklan_layanan_model->insert();
			                $data['message_type'] = "success";
			                $data['message']		= "Iklan Layanan berhasil ditambahkan.";

			                 //logs
							$this->load->model('logs_model');
							$this->logs_model->user_id	 = $this->session->userdata('user_id');
		                	$this->logs_model->activity = "telah menambahkan Iklan Layanan";
		                	$this->logs_model->category = "add";
		                	$desc = $_POST['nama_iklan'];
		                	$this->logs_model->description = "with names ".$desc;
							$this->logs_model->insert();

			           
		                }

		               
				}
				else
				{
					$data['message_type'] = "warning";
					$data['message'] = "<strong>Opps..</strong> Data belum lengkap, silahkan lengkapi dulu!";
				}
			}
			
			$this->load->view('admin/index',$data);
			
		}
		else
		{
			redirect('admin');	
		}
	}
	public function edit_iklan_layanan($id_iklan)
	{
		if ($this->user_id)
		{
			$this->load->model('tahu/iklan_layanan_model');
			$this->iklan_layanan_model->id_iklan = $id_iklan;
			$data['title']		= "Edit Iklan Layanan - ". app_name;
			$data['content']	= "tahu/iklan_layanan/edit" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			
			$data['active_menu'] = "media";
			$this->load->helper('form');
			if (!empty($_POST))
			{
				if ($_POST['nama_iklan'] !="" &&
					$_POST['status'] !=""  
				)
				{
						$config['upload_path']          = './data/images/iklan_layanan/';
			            $config['allowed_types']        = 'gif|jpg|png|jpeg';
			            $config['max_size']             = 10000;
			            $config['max_width']            = 5000;
			            $config['max_height']           = 5000;

			            $this->load->library('upload', $config);
			            if ( ! $this->upload->do_upload())
		                {
		                    $this->iklan_layanan_model->gambar 	= "";
		                    $tmp_name				= $_FILES['userfile']['tmp_name'];
		                    if ($tmp_name!="")
		                    {
		                    	$data['error']			= $this->upload->display_errors();
		                    }
		                
		                }
		                else
		                {
		                	$this->iklan_layanan_model->set();
		                	if ($this->iklan_layanan_model->gambar !="") unlink('./data/images/iklan_layanan/'.$this->iklan_layanan_model->gambar);
			           		$this->iklan_layanan_model->gambar = $this->upload->data('file_name');
		                }

		               	$this->iklan_layanan_model->nama_iklan = $_POST['nama_iklan'];
			            $this->iklan_layanan_model->status= $_POST['status'];
		                	$this->iklan_layanan_model->deskripsi = $_POST['deskripsi'];
		                	$this->iklan_layanan_model->chanel = $_POST['chanel'];
			            $this->iklan_layanan_model->update();
			            $data['message_type'] = "success";
			            $data['message']		= "Iklan Layanan berhasil diperbarui.";

		              //logs
						$this->load->model('logs_model');
						$this->logs_model->user_id	 = $this->session->userdata('user_id');
	                	$this->logs_model->activity = "telah memperbarui Iklan Layanan";
	                	$this->logs_model->category = "update";
	                	$desc = $_POST['nama_iklan'];
	                	$this->logs_model->description = "with names ".$desc;
						$this->logs_model->insert();

				}
				else
				{
					$data['message_type'] = "warning";
					$data['message'] = "<strong>Opps..</strong> Data belum lengkap, silahkan lengkapi dulu!";
				}
			}
			$this->iklan_layanan_model->set();
			$data['nama_iklan'] = $this->iklan_layanan_model->nama_iklan;
			$data['deskripsi'] = $this->iklan_layanan_model->deskripsi;
			$data['chanel'] = $this->iklan_layanan_model->chanel;
			$data['status'] = $this->iklan_layanan_model->status;
			$data['gambar'] = $this->iklan_layanan_model->gambar;
			$this->load->view('admin/index',$data);
			
		}
		else
		{
			redirect('admin');	
		}
	}

	public function delete_iklan_layanan($id_iklan)
	{
		if ($this->user_id)
		{
			$this->load->model('tahu/iklan_layanan_model');
			$this->iklan_layanan_model->id_iklan = $id_iklan;
			$this->iklan_layanan_model->set();
			if ($this->iklan_layanan_model->gambar !="") unlink('./data/images/iklan_layanan/'.$this->iklan_layanan_model->gambar);
			$this->iklan_layanan_model->delete();
			redirect('tahu/manage_media/iklan_layanan');
		}
		else
		{
			redirect('home');
		}
	}

	public function modal()
	{
		if ($this->user_id)
		{
			$data['title']		= "Modal - ". app_name;
			$data['content']	= "tahu/modal/index" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			
			$this->load->model('tahu/modal_model');
			$data['query']		= $this->modal_model->get_all();
			$data['active_menu'] = "media";
			$this->load->view('admin/index',$data);

		}
		else
		{
			redirect('admin');
		}
	}

	public function add_modal()
	{
		if ($this->user_id)
		{
			$this->load->model('tahu/modal_model');
			$data['title']		= "Tambah Modal  - ". app_name;
			$data['content']	= "tahu/modal/add" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			
			$data['active_menu'] = "media";
			$this->load->helper('form');
			if (!empty($_POST))
			{
				if ($_POST['judul'] !="" &&
					$_POST['status'] !=""  
				)
				{
						$config['upload_path']          = './data/images/modal/';
			            $config['allowed_types']        = 'gif|jpg|png|jpeg';
			            $config['max_size']             = 10000;
			            $config['max_width']            = 5000;
			            $config['max_height']           = 5000;

			            $this->load->library('upload', $config);
			            if ( ! $this->upload->do_upload('gambar'))
		                {
		                    $data['message_type'] = "warning";
		                    $data['message']			= $this->upload->display_errors();
		                }
		                else
		                {
		                	$this->modal_model->gambar = $this->upload->data('file_name');
		                	$this->modal_model->judul = $_POST['judul'];
		                	$this->modal_model->deskripsi = $_POST['deskripsi'];
			                $this->modal_model->status= $_POST['status'];
			                $this->modal_model->insert();
			                $data['message_type'] = "success";
			                $data['message']		= "Modal  berhasil ditambahkan.";

			                 //logs
							$this->load->model('logs_model');
							$this->logs_model->user_id	 = $this->session->userdata('user_id');
		                	$this->logs_model->activity = "telah menambahkan Modal ";
		                	$this->logs_model->category = "add";
		                	$desc = $_POST['judul'];
		                	$this->logs_model->description = "with names ".$desc;
							$this->logs_model->insert();

			           
		                }

		               
				}
				else
				{
					$data['message_type'] = "warning";
					$data['message'] = "<strong>Opps..</strong> Data belum lengkap, silahkan lengkapi dulu!";
				}
			}
			
			$this->load->view('admin/index',$data);
			
		}
		else
		{
			redirect('admin');	
		}
	}
	public function edit_modal($id_modal)
	{
		if ($this->user_id)
		{
			$this->load->model('tahu/modal_model');
			$this->modal_model->id_modal = $id_modal;
			$data['title']		= "Edit Modal  - ". app_name;
			$data['content']	= "tahu/modal/edit" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			
			$data['active_menu'] = "media";
			$this->load->helper('form');
			if (!empty($_POST))
			{
				if ($_POST['judul'] !="" &&
					$_POST['status'] !=""  
				)
				{
						$config['upload_path']          = './data/images/modal/';
			            $config['allowed_types']        = 'gif|jpg|png|jpeg';
			            $config['max_size']             = 10000;
			            $config['max_width']            = 5000;
			            $config['max_height']           = 5000;

			            $this->load->library('upload', $config);
			            if ( ! $this->upload->do_upload())
		                {
		                    $this->modal_model->gambar 	= "";
		                    $tmp_name				= $_FILES['gambar']['tmp_name'];
		                    if ($tmp_name!="")
		                    {
		                    	$data['error']			= $this->upload->display_errors();
		                    }
		                
		                }
		                else
		                {
		                	$this->modal_model->set();
		                	if ($this->modal_model->gambar !="") unlink('./data/images/modal/'.$this->modal_model->gambar);
			           		$this->modal_model->gambar = $this->upload->data('file_name');
		                }

		               	$this->modal_model->judul = $_POST['judul'];
			            $this->modal_model->status= $_POST['status'];
		                	$this->modal_model->deskripsi = $_POST['deskripsi'];
			            $this->modal_model->update();
			            $data['message_type'] = "success";
			            $data['message']		= "Modal berhasil diperbarui.";

		              //logs
						$this->load->model('logs_model');
						$this->logs_model->user_id	 = $this->session->userdata('user_id');
	                	$this->logs_model->activity = "telah memperbarui Modal ";
	                	$this->logs_model->category = "update";
	                	$desc = $_POST['judul'];
	                	$this->logs_model->description = "with names ".$desc;
						$this->logs_model->insert();

				}
				else
				{
					$data['message_type'] = "warning";
					$data['message'] = "<strong>Opps..</strong> Data belum lengkap, silahkan lengkapi dulu!";
				}
			}
			$this->modal_model->set();
			$data['judul'] = $this->modal_model->judul;
			$data['deskripsi'] = $this->modal_model->deskripsi;
			$data['status'] = $this->modal_model->status;
			$data['gambar'] = $this->modal_model->gambar;
			$this->load->view('admin/index',$data);
			
		}
		else
		{
			redirect('admin');	
		}
	}

	public function delete_modal($id_modal)
	{
		if ($this->user_id)
		{
			$this->load->model('tahu/modal_model');
			$this->modal_model->id_modal = $id_modal;
			$this->modal_model->set();
			if ($this->modal_model->gambar !="") unlink('./data/images/modal/'.$this->modal_model->gambar);
			$this->modal_model->delete();
			redirect('tahu/manage_media/modal');
		}
		else
		{
			redirect('home');
		}
	}
}
?>