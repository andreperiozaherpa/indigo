<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lap_realisasi_anggaran extends CI_Controller {
	public $user_id;

	public function __construct(){
		parent ::__construct();	
		$this->user_id = $this->session->userdata('user_id');
		
	
		$this->user_model->user_id = $this->user_id;
		$this->user_model->set_user_by_user_id();
		$this->load->model('ref_skpd_model');
		
		$this->user_picture = $this->user_model->user_picture;
		$this->full_name	= $this->user_model->full_name;
		$this->user_level	= $this->user_model->level;
		$this->user_privileges	= $this->user_model->user_privileges;
		$array_privileges = explode(';', $this->user_privileges);

		if (($this->user_level!="Administrator" && $this->user_level!="Admin Web") && !in_array('event', $array_privileges)) redirect ('welcome');
	}


    public function index()
	{
		if ($this->user_id)
		{
			
			$data['title']		= "Keuangan - ". app_name;
			$data['content']	= "keuangan/lap_realisasi_anggaran/index" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			
			$data['active_menu'] = "lap_realisasi_anggaran";
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
			
			$data['title']		= "Keuangan - ". app_name;
			$data['content']	= "keuangan/lap_realisasi_anggaran/add" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			
			//$data['query']		= $this->agenda_model->get_all();
			$data['active_menu'] = "lap_realisasi_anggaran";

			$data['skpd'] = $this->ref_skpd_model->get_all();
			$data['pegawai_bpkad'] = $this->db->get_where('pegawai',['id_skpd'=>25])->result();
			$data['pegawai_setda'] = $this->db->get_where('pegawai',['id_skpd'=>1])->result();
			
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
			
			$data['title']		= "Keuangan - ". app_name;
			$data['content']	= "keuangan/lap_realisasi_anggaran/detail" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			
			//$data['query']		= $this->agenda_model->get_all();
			$data['active_menu'] = "lap_realisasi_anggaran";
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
		{
			
			$data['title']		= "Keuangan - ". app_name;
			$data['content']	= "keuangan/lap_realisasi_anggaran/edit" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			
			$data['skpd'] = $this->ref_skpd_model->get_all();
			$data['pegawai_bpkad'] = $this->db->get_where('pegawai',['id_skpd'=>25])->result();
			$data['pegawai_setda'] = $this->db->get_where('pegawai',['id_skpd'=>1])->result();
			
			
			$data['active_menu'] = "neraca";
			$this->load->view('admin/index',$data);

		}
		else
		{
			redirect('admin');
		}
	}



}
?>