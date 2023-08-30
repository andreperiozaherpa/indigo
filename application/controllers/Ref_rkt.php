<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ref_rkt extends CI_Controller {
	public $user_id;

	public function __construct(){
		parent ::__construct();	
		$this->user_id = $this->session->userdata('user_id');
		$this->load->model('user_model');
		$this->load->model('ref_rkt_model');
		$this->load->model('ref_unit_kerja_model');
		$this->load->model('ref_satuan_model');
		$this->load->model('ref_renstra_model');
		$this->user_model->user_id = $this->user_id;
		$this->user_model->set_user_by_user_id();
		$this->user_picture = $this->user_model->user_picture;
		$this->full_name	= $this->user_model->full_name;
		$this->user_level	= $this->user_model->level;
		if ($this->user_level=="Admin Web"); 

		//$this->load->model('Ref_renstra','ref_rkt_m');
	}
	public function index()
	{
		if ($this->user_id)
		{
			$data['title']		= "Rencana Kerja tahunan - Admin ";
			$data['content']	= "ref_rkt/index" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "ref_rkt";

			$data['tahun'] = $this->ref_rkt_model->get_tahun();
			$data['unit_kerja'] = $this->ref_unit_kerja_model->get_all();
			if(!empty($_POST)){
				$this->ref_rkt_model->tahun_rkt = $_POST['tahun_rkt'];
				$this->ref_rkt_model->id_unit_penanggungjawab = $_POST['id_unit_penanggungjawab'];
			}
			$data['item'] = $this->ref_rkt_model->get_all();
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
			$data['title']		= "Rencana Strategis - Admin ";
			$data['content']	= "ref_rkt/view" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "ref_rkt";

			//if(!empty($_POST)){
			//	$this->ref_rkt_m->nama_lokasi = $_POST['nama_lokasi'];
			//	$this->ref_rkt_m->kode_kegiatan = $_POST['kode_kegiatan'];
			//}
			//$data['item'] = $this->ref_rkt_m->get_all();
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
			$data['title']		= "Rencana Strategis - Admin ";
			$data['content']	= "ref_rkt/add" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "ref_rkt";

			if(!empty($_POST)){
				$insert = $this->ref_rkt_model->insert($_POST);
				$data['message_type'] = "success";
				$data['message']		= "RKT berhasil ditambahakan.";
			}
			$data['renstra'] = $this->ref_renstra_model->get_all_data();
			$data['satuan'] = $this->ref_satuan_model->get_all();
			$data['unit_kerja'] = $this->ref_unit_kerja_model->get_all();
			$this->load->view('admin/index',$data);


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
			$data['title']		= "Rencana Strategis - Admin ";
			$data['content']	= "ref_rkt/detail" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "ref_rkt";
			
			$id = $this->uri->segment(3);
			if(empty($id)){
				redirect(base_url('ref_rkt'));
			}
			
			$data['item'] = $this->ref_rkt_model->select_by_id($id);
			
			if(empty($data['item'])){
				redirect(base_url('ref_rkt'));
			}

			$data['renstra'] = $this->ref_renstra_model->get_all_data();
			$data['satuan'] = $this->ref_satuan_model->get_all();
			$data['unit_kerja'] = $this->ref_unit_kerja_model->get_all();
			
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
			{$data['title']		= "ref_rkt - Admin ";
		$data['content']	= "ref_rkt/edit" ;
		$data['user_picture'] = $this->user_picture;
		$data['full_name']		= $this->full_name;
		$data['user_level']		= $this->user_level;
		$data['active_menu'] = "ref_rkt";
		
		$id = $this->uri->segment(3);
		if(empty($id)){
			redirect(base_url('ref_rkt'));
		}

		if(!empty($_POST)){
			$in = $this->ref_rkt_model->update($_POST,$id);
			$data['message_type'] = "success";
			$data['message']		= "RKT berhasil disimpan.";
			// redirect('ref_rkt');
		}
		
		$data['item'] = $this->ref_rkt_model->select_by_id($id);
		
		if(empty($data['item'])){
			redirect(base_url('ref_rkt'));
		}

		$data['renstra'] = $this->ref_renstra_model->get_all_data();
		$data['satuan'] = $this->ref_satuan_model->get_all();
		$data['unit_kerja'] = $this->ref_unit_kerja_model->get_all();
		
		
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
		$this->ref_rkt_model->delete($id);
	}
	else
	{
		redirect('home');
	}
}
}
?>