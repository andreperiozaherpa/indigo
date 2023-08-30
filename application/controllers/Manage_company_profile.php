<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manage_company_profile extends CI_Controller {
	public $user_id;

	public function __construct(){
		parent ::__construct();	
		$this->user_id = $this->session->userdata('user_id');
		$this->load->model('company_profile_model');
		$this->load->model('user_model');
		$this->user_model->user_id = $this->user_id;
		$this->user_model->set_user_by_user_id();
		$this->user_picture = $this->user_model->user_picture;
		$this->full_name	= $this->user_model->full_name;
		$this->user_level	= $this->user_model->level;

		$this->user_privileges	= $this->user_model->user_privileges;
		$array_privileges = explode(';', $this->user_privileges);

			if (($this->user_level!="Administrator" && $this->user_level!="Admin Web") && !in_array('company', $array_privileges)) redirect ('welcome');
	}

	public function identity()
	{
		if ($this->user_id)
		{
			
			$data['title']		= "Identitas Lembaga - ". app_name;
			$data['content']	= "company_profile/identity" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			
			if (!empty($_POST))
			{
				if ($_POST['nama'] !="" &&
					$_POST['alamat'] !="" &&
					$_POST['telepon'] !="" &&
					$_POST['tentang'] !="" 
				)
				{
					
						$config['upload_path']          = './data/logo/';
			            $config['allowed_types']        = 'gif|jpg|png';
			            $config['max_size']             = 2000;
			            $config['max_width']            = 2000;
			            $config['max_height']           = 2000;

			           $this->load->library('upload', $config);
			           if ( ! $this->upload->do_upload())
		               {
		                    $this->company_profile_model->logo 	= "";
		                    $tmp_name				= $_FILES['userfile']['tmp_name'];
		                    if ($tmp_name!="")
		                    {
		                    	$data['error']			= $this->upload->display_errors();
		                    }
		                }
		                else
		                {
		                	$this->company_profile_model->set_identity();
		                	if ($this->company_profile_model->logo !="") unlink('./data/logo/'.$this->company_profile_model->logo);
		                	$this->company_profile_model->logo = $this->upload->data('file_name');
		                }

		                $this->company_profile_model->nama = $_POST['nama'];
		                $this->company_profile_model->alamat = $_POST['alamat'];
		                $this->company_profile_model->email= $_POST['email'];
		                $this->company_profile_model->facebook = $_POST['facebook'];
		                $this->company_profile_model->twitter = $_POST['twitter'];
		                $this->company_profile_model->telepon = $_POST['telepon'];
		                $this->company_profile_model->youtube = $_POST['youtube'];
		                $this->company_profile_model->gmap= $_POST['gmap'];
		                $this->company_profile_model->instagram = $_POST['instagram'];
		                $this->company_profile_model->tentang= $_POST['tentang'];
		                $this->company_profile_model->latitude= $_POST['latitude'];
		                $this->company_profile_model->longitude= $_POST['longitude'];
		                $this->company_profile_model->update_identity();
		                $data['message_type'] = "success";
		                $data['message']		= "Identitas berhasil diperbarui.";
		            
				}
				else
				{
					$data['message_type'] = "warning";
					$data['message'] = "<strong>Opps..</strong> Data belum lengkap, silahkan lengkapi dulu!";
				}
			}
			$this->company_profile_model->set_identity();
			$data['nama']		= $this->company_profile_model->nama;
			$data['alamat']		= $this->company_profile_model->alamat;
			$data['logo']		= $this->company_profile_model->logo;
			$data['email']		= $this->company_profile_model->email;
			$data['facebook']		= $this->company_profile_model->facebook;
			$data['twitter']		= $this->company_profile_model->twitter;
			$data['telepon']		= $this->company_profile_model->telepon;
			$data['youtube']		= $this->company_profile_model->youtube;
			$data['gmap']		= $this->company_profile_model->gmap;
			$data['tentang']		= $this->company_profile_model->tentang;
			$data['instagram']		= $this->company_profile_model->instagram;
			$data['latitude']		= $this->company_profile_model->latitude;
			$data['longitude']		= $this->company_profile_model->longitude;

			$data['active_menu'] = "company_profile";
			$this->load->view('admin/index',$data);

		}
		else
		{
			redirect('admin');
		}
	}
	
	public function sambutan()
	{
		if ($this->user_id)
		{
			 
			$data['title']		= "Sambutan - ". app_name;
			$data['content']	= "company_profile/sambutan" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			
			$data['query']		= $this->company_profile_model->get_all_sambutan();
			$data['active_menu'] = "company_profile";
			$this->load->view('admin/index',$data);

		}
		else
		{
			redirect('admin');
		}
	}
	public function add_sambutan()
	{
		if ($this->user_id)
		{
			
			$data['title']		= "Tambah sambutan - ". app_name;
			$data['content']	= "company_profile/add_sambutan" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			
			$data['active_menu'] = "company_profile";
			$this->load->helper('form');
			if (!empty($_POST))
			{
				if ($_POST['nama'] !="" &&
					$_POST['jabatan'] !="" &&
					$_POST['isi'] !=""
				)
				{
					
						$config['upload_path']          = './data/images/sambutan/';
			            $config['allowed_types']        = 'gif|jpg|png';
			            $config['max_size']             = 1000;
			            $config['max_width']            = 500;
			            $config['max_height']           = 500;

			            $this->load->library('upload', $config);
			            if ( ! $this->upload->do_upload())
		                {
		                    $this->company_profile_model->foto 	= "default.png";
		                    $tmp_name				= $_FILES['userfile']['tmp_name'];
		                    if ($tmp_name!="")
		                    {
		                    	$data['message_type'] = "warning";
		                    	$data['message']			= $this->upload->display_errors();
		                    }
		                }
		                else
		                {
		                	$this->company_profile_model->foto = $this->upload->data('file_name');
		                }

		                $this->company_profile_model->_nama = $_POST['nama'];
		                $this->company_profile_model->jabatan= $_POST['jabatan'];
		                $this->company_profile_model->isi = $_POST['isi'];
		                $this->company_profile_model->insert_sambutan();
		                $data['message_type'] = "success";
		                $data['message']		= "Tambah sambutan sukses.";
		            
				}
				else
				{
					$data['message_type'] = "warning";
					$data['message'] = "<strong>Opps..</strong> Data not complete. Please complete it!";
				}
			}
			$this->load->view('admin/index',$data);
			
		}
		else
		{
			redirect('admin');	
		}
	}
	public function edit_sambutan($id_sambutan)
	{
		if ($this->user_id)
		{
			
			$data['title']		= "Edit sambutan - ". app_name;
			$data['content']	= "company_profile/edit_sambutan" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			
			$data['active_menu'] = "company_profile";
			$this->company_profile_model->id_sambutan = $id_sambutan;	
			$this->load->helper('form');
			if (!empty($_POST))
			{
				if ($_POST['nama'] !="" &&
					$_POST['jabatan'] !="" &&
					$_POST['isi'] !=""
				)
				{
						
						$config['upload_path']          = './data/images/sambutan/';
			            $config['allowed_types']        = 'gif|jpg|png';
			            $config['max_size']             = 1000;
			            $config['max_width']            = 500;
			            $config['max_height']           = 500;

			            $this->load->library('upload', $config);
			            if ( ! $this->upload->do_upload())
		                {
		                    $this->company_profile_model->foto 	= "";
		                    $tmp_name				= $_FILES['userfile']['tmp_name'];
		                    if ($tmp_name!="")
		                    {
		                    	$data['message_type'] = "warning";
		                    	$data['message']			= $this->upload->display_errors();
		                    }
		                }
		                else
		                {
		                	$this->company_profile_model->set_sambutan();
		                	if ($this->company_profile_model->foto !="default.png") unlink('./data/images/sambutan/'.$this->company_profile_model->foto);
		                	$this->company_profile_model->foto = $this->upload->data('file_name');
		                }

		                $this->company_profile_model->_nama = $_POST['nama'];
		                $this->company_profile_model->jabatan= $_POST['jabatan'];
		                $this->company_profile_model->isi = $_POST['isi'];
		                $this->company_profile_model->update_sambutan();

		                $data['message_type'] = "success";
		                $data['message']		= "Edit sambutan sukses.";
		            
				}
				else
				{
					$data['message_type'] = "warning";
					$data['message'] = "<strong>Opps..</strong> Data not complete. Please complete it!";
				}
			}
			$this->company_profile_model->set_sambutan();
			$data['nama'] = $this->company_profile_model->_nama;
			$data['jabatan'] = $this->company_profile_model->jabatan;
			$data['foto'] = $this->company_profile_model->foto;
			$data['isi'] = $this->company_profile_model->isi;
			$this->load->view('admin/index',$data);
			
		}
		else
		{
			redirect('admin');	
		}
	}
	
	public function delete_sambutan($id_sambutan)
	{
		if ($this->user_id)
		{
			
			$this->company_profile_model->id_sambutan = $id_sambutan;
			$this->company_profile_model->set_sambutan();
			if ($this->company_profile_model->foto !="default.png") unlink('./data/images/sambutan/'.$this->company_profile_model->foto);
			$this->company_profile_model->delete_sambutan();
			redirect('manage_company_profile/sambutan');
		}
		else
		{
			redirect('home');
		}
	}

	public function visi_misi()
	{
		if ($this->user_id)
		{
			
			$data['title']		= "Visi misi - ". app_name;
			$data['content']	= "company_profile/visi_misi" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			
			if (!empty($_POST))
			{
				if ($_POST['visi'] !="" &&
					$_POST['misi'] !="" &&
					$_POST['tujuan'] !="" 
				)
				{
					
						
		                $this->company_profile_model->visi = $_POST['visi'];
		                $this->company_profile_model->misi= $_POST['misi'];
		                $this->company_profile_model->tujuan= $_POST['tujuan'];
		                $this->company_profile_model->update_visi_misi();
		                $data['message_type'] = "success";
		                $data['message']		= "Program Kerja has been updated successfully.";
		            
				}
				else
				{
					$data['message_type'] = "warning";
					$data['message'] = "<strong>Opps..</strong> Data not complete. Please complete it!";
				}
			}
			$this->company_profile_model->set_visi_misi();
			$data['visi']		= $this->company_profile_model->visi;
			$data['misi']		= $this->company_profile_model->misi;
			$data['tujuan']		= $this->company_profile_model->tujuan;

			$data['active_menu'] = "company_profile";
			$this->load->view('admin/index',$data);

		}
		else
		{
			redirect('admin');
		}
	}

	public function program_kerja()
	{
		if ($this->user_id)
		{
			
			$data['title']		= "Program Kerja - ". app_name;
			$data['content']	= "company_profile/program_kerja" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			
			if (!empty($_POST))
			{
				if ($_POST['isi'] !="" 
				)
				{
					
						
		                $this->company_profile_model->isi = $_POST['isi'];
		                $this->company_profile_model->update_program_kerja();
		                $data['message_type'] = "success";
		                $data['message']		= "Visi Misi has been updated successfully.";
		            
				}
				else
				{
					$data['message_type'] = "warning";
					$data['message'] = "<strong>Opps..</strong> Data not complete. Please complete it!";
				}
			}
			$this->company_profile_model->set_program_kerja();
			$data['isi']		= $this->company_profile_model->isi;
			$data['active_menu'] = "company_profile";
			$this->load->view('admin/index',$data);

		}
		else
		{
			redirect('admin');
		}
	}

	public function struktur_organisasi()
	{
		if ($this->user_id)
		{
			
			$data['title']		= "Struktur Organisasi - ". app_name;
			$data['content']	= "company_profile/struktur_organisasi" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			
			if (!empty($_POST))
			{
				if ($_POST['isi'] !="" 
				)
				{
					
						
		                $this->company_profile_model->isi = $_POST['isi'];
		                $this->company_profile_model->update_struktur_organisasi();
		                $data['message_type'] = "success";
		                $data['message']		= "Struktur Organisasi has been updated successfully.";
		            
				}
				else
				{
					$data['message_type'] = "warning";
					$data['message'] = "<strong>Opps..</strong> Data not complete. Please complete it!";
				}
			}
			$this->company_profile_model->set_struktur_organisasi();
			$data['isi']		= $this->company_profile_model->isi;
			$data['active_menu'] = "company_profile";
			$this->load->view('admin/index',$data);

		}
		else
		{
			redirect('admin');
		}
	}

}
?>