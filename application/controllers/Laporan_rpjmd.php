<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan_rpjmd extends CI_Controller {
	public $user_id;

	public function __construct(){
		parent ::__construct();	
		$this->user_id = $this->session->userdata('user_id');
		$this->load->model('user_model');
		$this->load->model('laporan_sakip_model');


		$this->user_model->user_id = $this->user_id;
		$this->user_model->set_user_by_user_id();
		$this->user_picture = $this->user_model->user_picture;
		$this->full_name	= $this->user_model->full_name;
		$this->user_level	= $this->user_model->level;
		if ($this->user_level=="Admin Web"); 


	}
	public function index()
	{
		if ($this->user_id)
		{
			$data['title']		= "Laporan Perencanaan - Admin ";
			//$data['content']	= "laporan_rpjmd/perencanaan" ;
			$data['content']	= "laporan_rpjmd/statik_matriks2" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "laporan";
			$data['misi'] = $this->laporan_sakip_model->get_misi();

			$this->load->view('admin/index',$data);


		}
		else
		{
			redirect('admin');
		}
	}

	public function perencanaan()
	{
		if ($this->user_id)
		{
			$data['title']		= "Laporan Perencanaan - Admin ";
			//$data['content']	= "laporan_rpjmd/perencanaan" ;
			$data['content']	= "laporan_rpjmd/perencanaan" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "laporan";
			$data['misi'] = $this->laporan_sakip_model->get_misi();
			$this->load->model('ref_skpd_model');
			$data['skpd'] = $this->ref_skpd_model->get_all();
			$data['id_skpd'] = @$_GET['id_skpd'];
			$data['tahun'] = @$_GET['tahun'];
			$this->load->view('admin/index',$data);


		}
		else
		{
			redirect('admin');
		}
	}

	public function perencanaan_old()
	{
		if ($this->user_id)
		{
			$data['title']		= "Laporan Perencanaan - Admin ";
			//$data['content']	= "laporan_rpjmd/perencanaan" ;
			$data['content']	= "laporan_rpjmd/statik_matriks" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "laporan";
			$data['misi'] = $this->laporan_sakip_model->get_misi();
			$this->load->model('ref_skpd_model');
			$data['skpd'] = $this->ref_skpd_model->get_all();
			$data['id_skpd'] = @$_GET['id_skpd'];
			$data['tahun'] = @$_GET['tahun'];
			$this->load->view('admin/index',$data);


		}
		else
		{
			redirect('admin');
		}
	}





	




	
}
?>