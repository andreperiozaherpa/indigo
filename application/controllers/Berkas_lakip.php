<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Berkas_lakip extends CI_Controller {
	public $user_id;

	public function __construct(){
		parent ::__construct();	
		$this->user_id = $this->session->userdata('user_id');
		$this->load->model('user_model');
		$this->load->model('berkas_lakip_model');
		$this->load->model('ref_skpd_model');
		// $this->load->model('ref_satuan_model');
		// $this->load->model('ref_renstra_model');
		$this->user_model->user_id = $this->user_id;
		$this->user_model->set_user_by_user_id();
		$this->user_picture = $this->user_model->user_picture;
		$this->full_name	= $this->user_model->full_name;
		$this->user_level	= $this->user_model->level;
		if ($this->user_level=="Admin Web"); 

		//$this->load->model('Ref_renstra','berkas_lakip_m');
	}
	public function index()
	{
		if ($this->user_id)
		{
			$data['title']		= "Berkas Lakip - Admin ";
			$data['content']	= "berkas_lakip/index" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "berkas_lakip";

			$data['tahun'] = $this->berkas_lakip_model->get_tahun();
			$data['skpd'] = $this->ref_skpd_model->get_all();
			if(!empty($_POST)){
				$this->berkas_lakip_model->tahun_berkas = $_POST['tahun_berkas'];
				$this->berkas_lakip_model->id_skpd = $_POST['id_skpd'];
			}
			$data['item'] = $this->berkas_lakip_model->get_all();
			$this->load->view('admin/index',$data);


		}
		else
		{
			redirect('admin');
		}
	}


	public function view()
	{
		if ($this->user_id)
		{
			$data['title']		= "Berkas Lakip - Admin ";
			$data['content']	= "berkas_lakip/view" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "berkas_lakip";

			//if(!empty($_POST)){
			//	$this->berkas_lakip_m->nama_lokasi = $_POST['nama_lokasi'];
			//	$this->berkas_lakip_m->kode_kegiatan = $_POST['kode_kegiatan'];
			//}
			//$data['item'] = $this->berkas_lakip_m->get_all();
			$this->load->view('admin/index',$data);


		}
		else
		{
			redirect('admin');
		}
	}

	public function tambah()
	{
		if ($this->user_id)
		{
			$data['title']		= "Berkas Lakip - Admin ";
			$data['content']	= "berkas_lakip/add" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "berkas_lakip";

			if(!empty($_POST)){
				$taken = $this->berkas_lakip_model->check_taken($_POST);
			
				if (count($taken)>0) {
					redirect('berkas_lakip/detail/'.$taken);
				}


				$config['upload_path']          = './data/berkas_lakip/';
				$config['allowed_types']        = 'pdf|docx|doc|txt|xlsx|xls|ppt|pptx|zip|rar';
	            $config['max_size']             = 200000;

	            $this->load->library('upload', $config);
	            if ( ! $this->upload->do_upload('renstra')){ $_POST['renstra'] = ""; }
                else { $_POST['renstra'] = $this->upload->data('file_name'); }

	            if ( ! $this->upload->do_upload('rkt')){ $_POST['rkt'] = ""; }
                else { $_POST['rkt'] = $this->upload->data('file_name'); }
                
	            if ( ! $this->upload->do_upload('pk')){ $_POST['pk'] = ""; }
                else { $_POST['pk'] = $this->upload->data('file_name'); }
                
	            if ( ! $this->upload->do_upload('lkj')){ $_POST['lkj'] = ""; }
				else { $_POST['lkj'] = $this->upload->data('file_name'); }
				
				
	            if ( ! $this->upload->do_upload('lainnya')){ $_POST['lainnya'] = ""; }
                else { $_POST['lainnya'] = $this->upload->data('file_name'); }


				$insert = $this->berkas_lakip_model->insert($_POST);
				$data['message_type'] = "success";
				$data['message']		= "Berkas berhasil ditambahkan.";

				redirect('berkas_lakip/detail/'.$_POST['id_skpd']);
			}
			// $data['renstra'] = $this->ref_renstra_model->get_all_data();
			// $data['satuan'] = $this->ref_satuan_model->get_all();
			$data['tahun'] = $this->berkas_lakip_model->get_tahun();
			$data['skpd'] = $this->ref_skpd_model->get_all();
			$this->load->view('admin/index',$data);


		}
		else
		{
			redirect('admin');
		}
	}

	public function upload_berkas($id, $col)
	{
		if ($this->user_id)
		{
			$config['upload_path']          = './data/berkas_lakip/';
			$config['allowed_types']        = 'pdf|word|xls|xlsx|doc|docx|png|jpg|jpeg|gif|psd';
            $config['max_size']             = 200000;
            $config['max_width']            = 200000;
            $config['max_height']           = 200000;
            $config['encrypt_name']         = TRUE;

            $this->load->library('upload', $config);
            if ( ! $this->upload->do_upload('userfile')){  }
            else { $_POST[$col] = $this->upload->data('file_name'); }

			$return = $this->berkas_lakip_model->update($_POST, $id);
			
			redirect('berkas_lakip/detail/'.$return);

		}
		else
		{
			redirect('admin');
		}
	}



	public function detail()
	{
		if ($this->user_id)
		{
			$data['title']		= "Berkas Lakip - Admin ";
			$data['content']	= "berkas_lakip/detail" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "berkas_lakip";
			
			$id = $this->uri->segment(3);
			if(empty($id)){
				redirect(base_url('berkas_lakip'));
			}
			
			$data['item'] = $this->berkas_lakip_model->select_by_id_skpd($id);
			// print_r($data['item']);die;
			
			if(empty($data['item'])){
				redirect(base_url('berkas_lakip'));
			}

			// $data['renstra'] = $this->ref_renstra_model->get_all_data();
			// $data['satuan'] = $this->ref_satuan_model->get_all();
			$data['skpd'] = $this->ref_skpd_model->get_all();
			
			$data['detail'] = $this->ref_skpd_model->get_by_id($id);
			$data['kepala_skpd'] = $this->ref_skpd_model->get_kepala_skpd($id);
			
			$this->load->view('admin/index',$data);


		}
		else
		{
			redirect('admin');
		}
	}
	


	public function edit()
	{
		if ($this->user_id)
			{$data['title']	= "Berkas Lakip - Admin ";
		$data['content']	= "berkas_lakip/edit" ;
		$data['user_picture'] = $this->user_picture;
		$data['full_name']		= $this->full_name;
		$data['user_level']		= $this->user_level;
		$data['active_menu'] = "berkas_lakip";
		
		$id = $this->uri->segment(3);
		if(empty($id)){
			redirect(base_url('berkas_lakip'));
		}

		if(!empty($_POST)){
			$in = $this->berkas_lakip_model->update($_POST,$id);
			$data['message_type'] = "success";
			$data['message']		= "Berkas berhasil disimpan.";
			// redirect('berkas_lakip');
		}
		
		$data['item'] = $this->berkas_lakip_model->select_by_id($id);
		
		if(empty($data['item'])){
			redirect(base_url('berkas_lakip'));
		}

		// $data['renstra'] = $this->ref_renstra_model->get_all_data();
		// $data['satuan'] = $this->ref_satuan_model->get_all();
		$data['skpd'] = $this->ref_skpd_model->get_all();
		
		
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
		$this->berkas_lakip_model->delete($id);
	}
	else
	{
		redirect('home');
	}
}

public function delete_berkas($id,$col)
{
	if ($this->user_id)
	{
		$this->berkas_lakip_model->delete_berkas($id, $col);
	}
	else
	{
		redirect('home');
	}
}
}
?>