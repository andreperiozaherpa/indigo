<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Monitoring_pegawai extends CI_Controller {
	public $user_id;

	public function __construct(){
		parent ::__construct();
		$this->user_id = $this->session->userdata('user_id');
		$this->load->model('user_model');
		$this->load->model('kegiatan_model');
		$this->load->model('realisasi_kegiatan_model');
		$this->load->model('ref_unit_kerja_model');
		$this->load->model('ref_skpd_model');
		$this->load->model('monitoring_kegiatan_model');
		$this->user_model->user_id = $this->user_id;
		$this->user_model->set_user_by_user_id();
		$this->user_picture = $this->user_model->user_picture;
		$this->full_name	= $this->user_model->full_name;
		$this->user_level	= $this->user_model->level;
		$this->user_privileges = explode(";", $this->session->userdata('user_privileges'));
		if ($this->user_level=="Admin Web");

		// $this->load->model('realisasi_kegiatan_model','realisasi_kegiatan_m');
	}
	public function index()
	{
		if ($this->user_id && ($this->user_level=="Administrator" || in_array('op_kepegawaian', $this->user_privileges) || $this->session->userdata('kepala_skpd')=="Y"))
		{
			
			$data['title']		= "Monitoring Pegawai - Admin ";
			
			$option_skpd = "";
			
			if($this->user_level=='Administrator' || in_array('op_kepegawaian', $this->user_privileges)){
				$data['ref_skpd'] = $this->ref_skpd_model->get_all();
				$data['unit_kerja'] = array();
				$option_skpd = "<option value=''>Pilih SKPD</option>";
				foreach($data['ref_skpd'] as $row)
				{
					$selected = ($this->input->post("id_skpd") && $row->id_skpd== $this->input->post("id_skpd")) ? "selected" : "";
					$option_skpd .= "<option $selected value='".$row->id_skpd."' >$row->nama_skpd</option>";
				}
				
			}else{
				$data['ref_skpd'] = $this->ref_skpd_model->get_by_id($this->session->userdata('id_skpd'));
				$data['unit_kerja'] = $this->ref_skpd_model->get_unit_kerja_by_id_skpd($this->session->userdata('id_skpd'));
				

				$option_skpd .= "<option>".$data['ref_skpd']->nama_skpd."</option>";
			}

			
			
			

			$data['option_skpd'] = $option_skpd;

			$where = array();
			if($this->user_level!=='Administrator'){
				$where['kegiatan_personal.id_skpd'] = $this->session->userdata('id_skpd');
			}
			if($this->input->post("id_skpd"))
			{
				$where['kegiatan_personal.id_skpd'] = $this->input->post("id_skpd");
				$data['unit_kerja'] = $this->ref_skpd_model->get_unit_kerja_by_id_skpd($this->input->post("id_skpd"));
			}

			if($this->input->post("id_unit_kerja"))
			{
				$data['id_unit_kerja'] = $this->input->post("id_unit_kerja");
				$where['kegiatan_personal.id_unit_kerja_tautan'] = $this->input->post("id_unit_kerja");
			}

			$sWhere = "";
			if($this->input->post("cari"))
			{
				$data['cari'] = $this->input->post("cari");
				$sWhere = "pegawai.nama_lengkap like '%".$this->input->post("cari")."%' ";
			}

			

			$kegiatan = $this->monitoring_kegiatan_model->get_monitoring($where,$sWhere);

			//echo "<pre>";print_r($kegiatan);die;

			$monitoring = array();
			$num = 1;
			foreach($kegiatan as $row)
			{
				$icon = "";
				$foto = "";
				if($row->foto_pegawai){
					$foto = base_url()."data/foto/pegawai/".$row->foto_pegawai;
				}
				else{
					$foto = base_url()."data/foto/pegawai/user-default.png";
				}

				if($row->lokasi_pengerjaan=="rumah")
				{
					$icon = '<i class="im im-icon-Home-2"></i>';
				}
				else if($row->lokasi_pengerjaan=="luar_kantor")
				{
					$icon = '<i class="im im-icon-Aim"></i>';
				}
				else{
					$icon = '<i class="im im-icon-Android-Store"></i>';
				}
				$infobox = '<a href="'.base_url('laporan/detail_pegawai/'.$row->id_pegawai."/2020").'" class="listing-img-container"><div class="infoBox-close"><i class="fa fa-times"></i></div><img src="'.$foto.'" alt=""><div class="listing-item-content"><h3>'.$row->nama_lengkap.'</h3><span>'.$row->nama_kegiatan.'</span></div></a><div class="listing-content"><div class="listing-title"><div class="rating-counter">'.$row->status_kegiatan.'</div></div></div>';
				$num++;
				$monitoring[] = array(
					$infobox, $row->lat, $row->lng, $num, $icon
				);
			}

			
			

			$data['monitoring'] = json_encode($monitoring);
			// print_r($monitoring);
			if(isset($_GET['frame'])){
				$data['frame'] = $_GET['frame'];
			}
			//$this->load->view('admin/index',$data);

			$data['total_pegawai_bekerja'] = count($this->monitoring_kegiatan_model->total_pekerjaan('pegawai'));
			$data['total_pekerjaan'] = count($this->monitoring_kegiatan_model->total_pekerjaan());
			$data['total_pekerjaan_selesai'] = count($this->monitoring_kegiatan_model->total_pekerjaan('selesai'));
			$data['total_hari_ini'] = count($this->monitoring_kegiatan_model->total_hari_ini());
			$data['total_hari_ini_belum'] = count($this->monitoring_kegiatan_model->total_hari_ini('belum'));
			$data['total_hari_ini_sudah'] = count($this->monitoring_kegiatan_model->total_hari_ini('sudah'));
			$data['total_markonah'] = count($this->monitoring_kegiatan_model->total_markonah());
			
			$this->load->view('admin/monitoring_pegawai/monitoring',$data);


		}
		else
		{
			redirect('admin');
		}
	}


	public function monitoring(){
		
		$data['title']		= "Monitoring Pegawai";
		$data['content']	= "monitoring_pegawai/frame" ;
		$data['user_picture'] = $this->user_picture;
		$data['full_name']		= $this->full_name;
		$data['user_level']		= $this->user_level;
		$data['active_menu'] = "monitoring_pegawai";

		$data['total_pegawai_bekerja'] = count($this->monitoring_kegiatan_model->total_pekerjaan('pegawai'));
		$data['total_pekerjaan'] = count($this->monitoring_kegiatan_model->total_pekerjaan());
		$data['total_pekerjaan_selesai'] = count($this->monitoring_kegiatan_model->total_pekerjaan('selesai'));
		$data['total_hari_ini'] = count($this->monitoring_kegiatan_model->total_hari_ini());
		$data['total_hari_ini_belum'] = count($this->monitoring_kegiatan_model->total_hari_ini('belum'));
		$data['total_hari_ini_sudah'] = count($this->monitoring_kegiatan_model->total_hari_ini('sudah'));
		$data['total_markonah'] = count($this->monitoring_kegiatan_model->total_markonah());

		$this->load->view('admin/index',$data);
	}


	public function get_unit_kerja($id_skpd)
	{
		if ($this->user_id)
		{
			$option = "<option value=''>Pilih unit kerja</option>";
			$unit_kerja = $this->ref_skpd_model->get_unit_kerja_by_id_skpd($id_skpd);
			foreach($unit_kerja as $row)
			{
				
				$option .= "<option value='".$row->id_unit_kerja."'>".$row->nama_unit_kerja."</option>";
			}
			//echo "<pre>";print_r($unit_kerja);
			die($option);
		}
	}


	public function test()
	{
		if ($this->user_id && ($this->user_level=="Administrator" || $this->session->kepala_skpd=="Y"))
		{
			
			$data['title']		= "Monitoring Pegawai - Admin ";
			
			$option_skpd = "";

			

			
			if($this->user_level=='Administrator'){
				$data['ref_skpd'] = $this->ref_skpd_model->get_all();
				$data['unit_kerja'] = array();
				$option_skpd = "<option value=''>Pilih SKPD</option>";
				foreach($data['ref_skpd'] as $row)
				{
					$selected = ($this->input->post("id_skpd") && $row->id_skpd== $this->input->post("id_skpd")) ? "selected" : "";
					$option_skpd .= "<option $selected value='".$row->id_skpd."' >$row->nama_skpd</option>";
				}
				
			}else{
				$data['ref_skpd'] = $this->ref_skpd_model->get_by_id($this->session->userdata('id_skpd'));
				$data['unit_kerja'] = $this->ref_skpd_model->get_unit_kerja_by_id_skpd($this->session->userdata('id_skpd'));
				

				$option_skpd .= "<option>".$data['ref_skpd']->nama_skpd."</option>";
			}

			
			
			

			$data['option_skpd'] = $option_skpd;

			$where = array();
			if($this->user_level!=='Administrator'){
				
			$where['kegiatan_personal.id_skpd'] = $this->session->userdata('id_skpd');
			}
			if($this->input->post("id_skpd"))
			{
				$where['kegiatan_personal.id_skpd'] = $this->input->post("id_skpd");
				$data['unit_kerja'] = $this->ref_skpd_model->get_unit_kerja_by_id_skpd($this->input->post("id_skpd"));
			}

			if($this->input->post("id_unit_kerja"))
			{
				$data['id_unit_kerja'] = $this->input->post("id_unit_kerja");
				$where['kegiatan_personal.id_unit_kerja_tautan'] = $this->input->post("id_unit_kerja");
			}

			$sWhere = "";
			if($this->input->post("cari"))
			{
				$data['cari'] = $this->input->post("cari");
				$sWhere = "pegawai.nama_lengkap like '%".$this->input->post("cari")."%' ";
			}

			

			$kegiatan = $this->monitoring_kegiatan_model->get_monitoring($where,$sWhere);

			

			$monitoring = array();
			$num = 1;
			foreach($kegiatan as $row)
			{
				$icon = "";
				$foto = "";
				if($row->foto_pegawai){
					$foto = base_url()."data/foto/pegawai/".$row->foto_pegawai;
				}
				else{
					$foto = base_url()."data/foto/pegawai/user-default.png";
				}

				if($row->lokasi_pengerjaan=="rumah")
				{
					$icon = '<i class="im im-icon-Home-2"></i>';
				}
				else if($row->lokasi_pengerjaan=="luar_kantor")
				{
					$icon = '<i class="im im-icon-Aim"></i>';
				}
				else{
					$icon = '<i class="im im-icon-Android-Store"></i>';
				}
				$infobox = '<a href="'.base_url('laporan/detail_pegawai/'.$row->id_pegawai."/2020").'" class="listing-img-container"><div class="infoBox-close"><i class="fa fa-times"></i></div><img src="'.$foto.'" alt=""><div class="listing-item-content"><h3>'.$row->nama_lengkap.'</h3><span>'.$row->nama_kegiatan.'</span></div></a><div class="listing-content"><div class="listing-title"><div class="rating-counter">'.$row->status_kegiatan.'</div></div></div>';
				$num++;
				$monitoring[] = array(
					$infobox, $row->lat, $row->lng, $num, $icon
				);
			}

			
			

			$data['monitoring'] = json_encode($monitoring);

			//$this->load->view('admin/index',$data);
			$this->load->view('admin/monitoring_pegawai/monitoring',$data);


		}
		else
		{
			redirect('admin');
		}
	}
}
?>
