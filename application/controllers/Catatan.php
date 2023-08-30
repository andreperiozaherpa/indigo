<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Catatan extends CI_Controller {
	public $user_id;

	public function __construct(){
		parent ::__construct();
		$this->user_id = $this->session->userdata('user_id');
		$this->load->model('user_model');
		$this->load->model('catatan_model', 'cm');
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
			$data['title']		= "Catatan - Admin ";
			$data['content']	= "catatan/index" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "catatan";
			$data['id_pegawai'] = $this->id_pegawai;
			$data['id_skpd'] = $this->id_skpd;

			$id_pegawai = $this->id_pegawai;
			$hal = 6;
			$page = isset($_GET["page"]) ? (int)$_GET["page"] : 1;
			$mulai = ($page>1) ? ($page * $hal) - $hal : 0;
			$total = count($this->cm->get_all($id_pegawai));
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

			$data['list'] = $this->cm->get_page($mulai,$hal,$start,$end,$nama,$id_pegawai);

			$data['catatan'] = $this->cm->get_all($id_pegawai);
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
			$data['title']		= "Tambah Catatan - Admin ";
			$data['content']	= "catatan/add" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "catatan";
			$data['id_pegawai'] = $this->id_pegawai;
			$data['id_skpd'] = $this->id_skpd;

		if(isset($_POST['tombol_submit'])){
			$this->cm->save($_POST);
			$this->session->set_flashdata('sukses', 'Data Berhasil Ditambah');
			redirect("catatan");
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
			$data['title']		= "Edit Catatan - Admin ";
			$data['content']	= "catatan/edit" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "catatan";
			$data['id_pegawai'] = $this->id_pegawai;
			$data['id_skpd'] = $this->id_skpd;

		if(isset($_POST['update'])){
			$this->cm->update($_POST, $id);
			$this->session->set_flashdata('sukses', 'Data Berhasil Diedit');
			redirect("catatan");
		}
			$data['catatan'] = $this->cm->get_by_id($id);
			if(empty($data['catatan'])){
				show_404();
			}
			if($this->user_level!=="Administrator"){
				if($data['catatan']->id_pegawai!==$this->id_pegawai){
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
			$data['title']		= "Detail Catatan - Admin ";
			$data['content']	= "catatan/detail" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "catatan";

			$data['catatan'] = $this->cm->get_by_id($id);
			if(empty($data['catatan'])){
				show_404();
			}
			if($this->user_level!=="Administrator"){
				if($data['catatan']->id_pegawai!==$this->id_pegawai){
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
		$data['catatan'] = $this->cm->get_by_id($id);
		if(empty($data['catatan'])){
			show_404();
		}
		if($this->user_level!=="Administrator"){
			if($data['catatan']->id_pegawai!==$this->id_pegawai){
				show_404();
			}
		}
		$this->cm->delete($id);
		$this->session->set_flashdata('sukses', 'Data Berhasil Dihapus');
		redirect("catatan");
	}


}
?>
