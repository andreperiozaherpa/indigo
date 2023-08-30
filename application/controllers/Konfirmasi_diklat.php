<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Konfirmasi_diklat extends CI_Controller {
	public $user_id;

	public function __construct(){
		parent ::__construct();	
		$this->user_id = $this->session->userdata('user_id');
		$this->load->model('user_model');
		$this->user_model->user_id = $this->user_id;
		$this->user_model->set_user_by_user_id();
		$this->user_picture = $this->user_model->user_picture;
		$this->full_name	= $this->user_model->full_name;
		$this->user_level	= $this->user_model->level;
		$this->level_id	= $this->user_model->level_id;
		$this->kd_skpd	= $this->user_model->kd_skpd;
		
		$this->load->model('pegawai_model');
		$this->arrStatusRiwayat = array(
			0 => 'Belum diverifikasi',
			1 => 'Sudah diverifikasi',
			2 => 'Ditolak'
		);

	}
	public function index()
	{
		if ($this->user_id)
		{
			$data['title']		= "Konfirmasi diklat - Admin ";
			$data['content']	= "konfirmasi_diklat/index" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$nip = $nama = $status = null;
			if (!empty($_POST)){
				$nip = $_POST['nip'];
				$nama= $_POST['nama'];
				$status = $_POST['status'];
				
				$data = array_merge($data,$_POST);
			}
			
			$offset = 0;
			$limit = $data['per_page']	= 15;
			if (!empty($_GET['per_page'])) $offset = $_GET['per_page'] ;
			$data['result'] = $this->pegawai_model->get_riwayat_diklat(null,$status,$nip,$nama,$limit,$offset);
			$data['all_result'] = $this->pegawai_model->get_riwayat_diklat(null,$status,$nip,$nama);
			
			$data['total_rows']	= count($data['all_result']);
			$data['offset']	= $offset;
			
			$data['arrStatusRiwayat'] = $this->arrStatusRiwayat;
			$this->load->view('admin/index',$data);


		}
		else
		{
			redirect('admin');
		}
	}
	public function ubah_status($id,$status)
	{
			$this->pegawai_model->ubah_status_riwayat("riwayat_diklat",$status,$id);
			redirect('konfirmasi_diklat/view/'.$id);
		
	}
	
	public function view($id)
	{
		if ($this->user_id)
		{
			
			$data['title']		= "Konfirmasi diklat - Admin ";
			$data['content']	= "konfirmasi_diklat/view" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			
			$data['arrStatusRiwayat'] = $this->arrStatusRiwayat;
			$result = $this->pegawai_model->get_riwayat_diklat_by_id($id);
			if (empty($result)) redirect('konfirmasi_diklat');
			//var_dump($result[0]->nama_lengkap);die;
			$data['result'] = $result[0];
			$data['pangkat_last'] = $this->pegawai_model->get_riwayat_pangkat($result[0]->id_pegawai,1);
			$data['unit_kerja_last'] = $this->pegawai_model->get_riwayat_unit_kerja($result[0]->id_pegawai,1);
			
			$this->load->view('admin/index',$data);

		}
		else
		{
			redirect('admin');
		}
	}


	public function delete($id,$berkas)
	{
		if ($this->user_id)
		{
			$this->pegawai_model->delete_riwayat("riwayat_diklat",$id,$berkas);
			redirect('konfirmasi_diklat');
		}
		else
		{
			redirect('admin');
		}
	}
}
?>