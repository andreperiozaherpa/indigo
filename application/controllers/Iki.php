<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Iki extends CI_Controller {
	public $user_id;

	public function __construct(){
		parent ::__construct();
		$this->user_id = $this->session->userdata('user_id');
		$this->load->model('user_model');
		$this->load->model('ref_jabatan_model');
		$this->load->model('ref_skpd_model');
		$this->load->model('iki_model');
		$this->user_model->user_id = $this->user_id;
		$this->user_model->set_user_by_user_id();
		$this->user_picture = $this->user_model->user_picture;
		$this->full_name	= $this->user_model->full_name;
		$this->user_level	= $this->user_model->level;
		if ($this->user_level=="Admin Web");

		//$this->load->model('Ref_renstra','ref_kode_kegiatan_m');
	}
	public function index()
	{
		if ($this->user_id)
		{
			if ($this->session->userdata('level') != 'Administrator') {
				redirect('iki/view/'.$this->session->userdata('id_pegawai'));
			}
			$data['title']		= "IKI - Admin ";
			$data['content']	= "iki/index" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "iki";

			$hal = 6;
			$page = isset($_GET["page"]) ? (int) $_GET["page"] : 1;
			$mulai = ($page > 1) ? ($page * $hal) - $hal : 0;
			$total = count($this->master_pegawai_model->get_all());
			$data['pages'] = ceil($total / $hal);
			$data['current'] = $page;
			if (!empty($_POST)) {
				$filter = $_POST;
				$nama = $_POST['nama_lengkap'];
				$nip = $_POST['nip'];
				$skpd = @$_POST['id_skpd'];
				$data['filter'] = true;
				$data['filter_data'] = $_POST;
				$data['nama_lengkap'] = $_POST['nama_lengkap'];
				$data['nip'] = $_POST['nip'];
				$data['id_skpd'] = $skpd;
			} else {
				$filter = '';
				$nama = '';
				$nip = '';
				$skpd = '';
				$data['filter'] = false;
			}

			$data['list'] = $this->iki_model->get_page($mulai, $hal, $nama, $nip, $skpd);
			$data['skpd'] = $this->ref_skpd_model->get_all();

			// $data['jabatan'] = $this->ref_jabatan_model->get_all_ref();

			$this->load->view('admin/index',$data);


		}
		else
		{
			redirect('admin');
		}
	}

	public function view($id_pegawai = 0)
	{
		if ($this->user_id AND ($this->session->userdata('id_pegawai') == $id_pegawai OR $this->session->userdata('level') == 'Administrator'))
		{
			$data['title']		= "IKI - Admin ";
			$data['content']	= "iki/view" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "iki";

			$data['detail'] = $this->iki_model->get_by_id($id_pegawai);
			$data['sasaran'] = $this->iki_model->get_sasaran_by_id($id_pegawai);
			// $data['jabatan'] = $this->ref_jabatan_model->get_all_ref();

			$this->load->view('admin/index',$data);


		}
		else
		{
			redirect('admin');
		}
	}

	public function fetch_sasaran($id){
		$misi = $this->iki_model->select_by_id_sasaran($id);
		echo json_encode($misi);
	}
	public function p_update_sasaran(){
		$id_ref = $_POST['id_ref'];
		unset($_POST['id_ref']);
		unset($_POST['_wysihtml5_mode']);
		$this->iki_model->update_sasaran($_POST,$id_ref);
		echo json_encode(array('status'=>true));
	}
	public function p_add_sasaran()
	{
		unset($_POST['_wysihtml5_mode']);
		$this->iki_model->insert_sasaran($_POST);
		echo json_encode(array('status'=>true));
	}
	public function delete_sasaran($id){
		$this->iki_model->delete_sasaran($id);
		echo json_encode(array('status'=>true));
	}

	public function fetch_indikator($id){
		$misi = $this->iki_model->select_by_id_indikator($id);
		echo json_encode($misi);
	}
	public function p_update_indikator(){
		$id_ref = $_POST['id_ref'];
		unset($_POST['id_ref']);
		unset($_POST['_wysihtml5_mode']);
		$this->iki_model->update_indikator($_POST,$id_ref);
		echo json_encode(array('status'=>true));
	}
	public function p_add_indikator()
	{
		unset($_POST['_wysihtml5_mode']);
		$this->iki_model->insert_indikator($_POST);
		echo json_encode(array('status'=>true));
	}
	public function delete_indikator($id){
		$this->iki_model->delete_indikator($id);
		echo json_encode(array('status'=>true));
	}

}
?>
