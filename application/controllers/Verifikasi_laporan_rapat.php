<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Verifikasi_laporan_rapat extends CI_Controller {
	public $user_id;

	public function __construct(){
		parent ::__construct();
		$this->user_id = $this->session->userdata('user_id');
		$this->load->model('user_model');
		$this->load->model('verifikasi_laporan_rapat_model', 'vlrm');
		$this->user_model->user_id = $this->user_id;
		$this->user_model->set_user_by_user_id();
		$this->user_picture = $this->user_model->user_picture;
		$this->full_name	= $this->user_model->full_name;
		$this->user_level	= $this->user_model->level;
		$this->id_pegawai	= $this->user_model->id_pegawai;
		$this->id_skpd = $this->user_model->id_skpd;
		if ($this->user_level=="Admin Web");

	}

	public function index()
	{
		if ($this->user_id)
		{
			$data['title']		= "Verifikasi laporan Rapat - Admin ";
			$data['content']	= "verifikasi_laporan_rapat/index" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "verifikasi_laporan_rapat";
			$data['id_pegawai'] = $this->id_pegawai;
			$data['id_skpd'] = $this->id_skpd;

			$id_pegawai = $this->id_pegawai;
			$hal = 6;
			$page = isset($_GET["page"]) ? (int)$_GET["page"] : 1;
			$mulai = ($page>1) ? ($page * $hal) - $hal : 0;
			$total = count($this->vlrm->get_all($id_pegawai));
			$data['pages'] = ceil($total/$hal);
			$data['current'] = $page;
			if(!empty($_POST)){
				$filter = $_POST;
				$start = $_POST["start"];
				$end = $_POST["end"];
				$nama = $_POST["nama"];
				$data['filter'] = true;
				$data['start'] = $_POST['start'];
				$data['end'] = $_POST['end'];
				$data['nama'] = $_POST['nama'];
			}else{
				$start = '';
				$end = '';
				$nama = '';
				$data['filter'] = false;
			}

			$data['list'] = $this->vlrm->get_page($mulai,$hal,$start,$end,$nama,$id_pegawai);

			$data['pengumuman'] = $this->vlrm->get_all($id_pegawai);
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
			$data['title']		= "Tambah Laporan Rapat - Admin ";
			$data['content']	= "laporan_rapat/add" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "laporan_rapat";
			$data['id_pegawai'] = $this->id_pegawai;
			$data['id_skpd'] = $this->id_skpd;

			$id_pegawai = $this->id_pegawai;
			$id_skpd = $this->id_skpd;
			$data['penerima'] = $this->lrm->pegawai_penerima($id_skpd);

		if(isset($_POST['tombol_submit'])){
			$this->lrm->save($_POST, $id_pegawai);
			$this->session->set_flashdata('sukses', 'Data Berhasil Ditambah');
			redirect("laporan_rapat");
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
			$data['title']		= "Edit Laporan Rapat - Admin ";
			$data['content']	= "laporan_rapat/edit" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "laporan_rapat";
			$data['id_pegawai'] = $this->id_pegawai;
			$data['id_skpd'] = $this->id_skpd;

		if(isset($_POST['update'])){
			$this->lrm->update($_POST, $id);
			$this->session->set_flashdata('sukses', 'Data Berhasil Diedit');
			redirect("laporan_rapat");
		}
			$data['laporan_rapat'] = $this->lrm->get_by_id($id);
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
			$data['title']		= "Detail Laporan Rapat - Admin ";
			$data['content']	= "verifikasi_laporan_rapat/detail" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "laporan_rapat";

			if(isset($_POST['verifikasi_laporan'])){
				$this->vlrm->verifikasi($_POST, $id);
				$this->session->set_flashdata('sukses', 'Data Berhasil Diverifikasi');
				redirect("verifikasi_laporan_rapat");
			}

			$data['laporan_rapat'] = $this->vlrm->get_by_id($id);
			$this->load->view('admin/index',$data);

		}
		else
		{
			redirect('admin');
		}
	}

	public function delete($id){
		$id_pegawai = $this->id_pegawai;
		$this->lrm->delete($id, $id_pegawai);
		$this->session->set_flashdata('sukses', 'Data Berhasil Dihapus');
		redirect("laporan_rapat");
	}


}
?>
