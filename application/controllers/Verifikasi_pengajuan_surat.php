<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Verifikasi_pengajuan_surat extends CI_Controller {
	public $user_id;

	public function __construct(){
		parent ::__construct();
		$this->user_id = $this->session->userdata('user_id');
		$this->load->model('user_model');
		$this->load->model('pengajuan_surat_model', 'psm');
		$this->user_model->user_id = $this->user_id;
		$this->user_model->set_user_by_user_id();
		$this->user_picture = $this->user_model->user_picture;
		$this->full_name	= $this->user_model->full_name;
		$this->user_level	= $this->user_model->level;
		$this->id_pegawai	= $this->user_model->id_pegawai;
		$this->id_skpd	= $this->user_model->id_skpd;
		if ($this->user_level=="Admin Web");

		//$this->load->model('Ref_renstra','ref_kode_kegiatan_m');
	}

	public function index()
	{
		if ($this->user_id)
		{
			$data['title']		= "Verifikasi Pengajuan Surat - Admin ";
			$data['content']	= "verifikasi_pengajuan_surat/index" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "pengajuan_surat";
			$data['id_pegawai'] = $this->id_pegawai;
			$data['id_skpd'] = $this->id_skpd;
			$data['jenis_pengajuan_surat'] = $this->psm->get_jenis_pengajuan_surat();

			if(!empty($_POST)){
				$filter = $_POST;
				$start = $_POST["start"];
				$end = $_POST["end"];
				$jenis = $_POST["jenis"];
				$status = $_POST["status"];
				$data['filter'] = true;
				$data['start'] = $_POST['start'];
				$data['end'] = $_POST['end'];
				$data['jenis'] = $_POST['jenis'];
				$data['status'] = $_POST['status'];
			}else{
				$start = '';
				$end = '';
				$jenis = '';
				$status = '';
				$data['filter'] = false;
			}
			$id_pegawai = $this->id_pegawai;
			$hal = 6;
			$page = isset($_GET["page"]) ? (int)$_GET["page"] : 1;
			$mulai = ($page>1) ? ($page * $hal) - $hal : 0;
			$total = count($this->psm->get_pages($mulai,null,$start,$end,$jenis,$status));
			$data['pages'] = ceil($total/$hal);
			$data['current'] = $page;
			$data['list'] = $this->psm->get_pages($mulai,$hal,$start,$end,$jenis,$status);

			$data['pengajuan_surat'] = $this->psm->get_all($id_pegawai);
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
			$data['title']		= "Tambah Pengajuan Surat - Admin ";
			$data['content']	= "pengajuan_surat/add" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "pengajuan_surat";
			$data['id_pegawai'] = $this->id_pegawai;
			$data['id_skpd'] = $this->id_skpd;
			$data['jenis_pengajuan_surat'] = $this->psm->get_jenis_pengajuan_surat();

		if(isset($_POST['tombol_submit'])){

			$config['upload_path']          = './data/pengajuan_surat/';
			$config['allowed_types']        = 'pdf';
			$config['encrypt_name']			= true;

			$this->load->library('upload', $config);
			foreach ($_FILES as $key => $value) {
				if ($value['name'] == null) {continue;}
				if ( ! $this->upload->do_upload($key)){
					 $this->session->set_flashdata('error', $this->upload->display_errors());
					 redirect(base_url().'pengajuan_surat/add','refresh');die;
				}else{
					$_POST[$key] = $this->upload->data('file_name');
				}
			}

			unset($_POST['tombol_submit']);
			$this->psm->save($_POST);
			$this->session->set_flashdata('sukses', 'Data Berhasil Ditambah');
			redirect("pengajuan_surat");
		}
			$this->load->view('admin/index',$data);

		}
		else
		{
			redirect('admin');
		}
	}

	public function ubah($id)
	{
		if ($this->user_id)
		{
			$data['title']		= "Edit Pengajuan Surat - Admin ";
			$data['content']	= "pengajuan_surat/edit" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "pengajuan_surat";
			$data['id_pegawai'] = $this->id_pegawai;
			$data['id_skpd'] = $this->id_skpd;
			$data['jenis_pengajuan_surat'] = $this->psm->get_jenis_pengajuan_surat();
			$data['pengajuan_surat'] = $this->psm->get_by_id($id);

		if(isset($_POST['update'])){
			$this->psm->update($_POST, $id);
			$this->session->set_flashdata('sukses', 'Data Berhasil Diedit');
			redirect("pengajuan_surat");
		}
			$data['pengajuan_surat'] = $this->psm->get_by_id($id);
			if(empty($data['pengajuan_surat'])){
				show_404();
			}
			if($this->user_level!=="Administrator"){
				if($data['pengajuan_surat']->id_pegawai!==$this->id_pegawai){
					show_404();
				}
			}
			$this->load->view('admin/index',$data);

		}
		else
		{
			redirect('admin');
		}
	}


	public function detail($id)
	{
		if ($this->user_id)
		{
			$data['title']		= "Detail Pengajuan Surat  - Admin ";
			$data['content']	= "verifikasi_pengajuan_surat/detail" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "pengajuan_surat";
			$data['id_pegawai'] = $this->id_pegawai;

			$data['pengajuan_surat'] = $this->psm->get_by_ids($id);

			if(isset($_POST['verifikasi'])){

				$config['upload_path']          = './data/pengajuan_surat/';
				$config['allowed_types']        = 'pdf';
				$config['encrypt_name']			= true;

				$this->load->library('upload', $config);
				foreach ($_FILES as $key => $value) {
					if ($value['name'] == null) {continue;}
					if ( ! $this->upload->do_upload($key)){
						$this->session->set_flashdata('error', $this->upload->display_errors());
						redirect(base_url().'verifikasi_pengajuan_surat/detail/'.$id,'refresh');die;
					}else{
						$_POST[$key] = $this->upload->data('file_name');
					}
				}

				unset($_POST['verifikasi']);

				if($this->psm->update($_POST, $this->input->post('id_pengajuan_surat'))){
					$this->session->set_flashdata('sukses', 'Data Berhasil Diverifikasi');
					redirect(base_url().'verifikasi_pengajuan_surat','refresh');die;
				}
			}
			if(empty($data['pengajuan_surat'])){
				show_404();
			}
			if($this->user_level!=="Administrator"){
				if($data['pengajuan_surat']->id_pegawai!==$this->id_pegawai){
					show_404();
				}
			}
			$this->load->view('admin/index',$data);

		}
		else
		{
			redirect('admin');
		}
	}

	public function delete($id){
		$data['pengajuan_surat'] = $this->psm->get_by_id($id);
		if(empty($data['pengajuan_surat'])){
			show_404();
		}
		if($this->user_level!=="Administrator"){
			if($data['pengajuan_surat']->id_pegawai!==$this->id_pegawai){
				show_404();
			}
		}
		$this->psm->delete($id);
		$this->session->set_flashdata('sukses', 'Data Berhasil Dihapus');
		redirect("pengajuan_surat");
	}


}
