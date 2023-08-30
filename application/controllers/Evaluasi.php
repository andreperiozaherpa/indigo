<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Evaluasi extends CI_Controller {
	public $user_id;

	public function __construct(){
		parent ::__construct();
		$this->user_id = $this->session->userdata('user_id');
		$this->load->model('user_model');
		$this->load->model('evaluasi_model');
		$this->load->model('ref_skpd_model');
		$this->user_model->user_id = $this->user_id;
		$this->user_model->set_user_by_user_id();
		$this->user_picture = $this->user_model->user_picture;
		$this->full_name	= $this->user_model->full_name;
		$this->user_level	= $this->user_model->level;
		$this->id_unit_kerja	= $this->user_model->unit_kerja_id;
		$this->level_unit_kerja	= $this->user_model->level_unit_kerja;

		if ($this->user_level=="Admin Web");

		//$this->load->model('Ref_renstra','ref_kode_kegiatan_m');
	}

	public function index($tahun=null,$level=0,$id_induk=null)
	{
		if ($this->user_id)
		{
			if ($tahun == null) {
				redirect('evaluasi/index/'.date("Y"));
			}
			$data['title']		= "Evaluasi - Admin ";
			$data['content']	= "evaluasi/index" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "evaluasi";

			$data['level'] = $level;
			$data['id_induk'] = $id_induk;
			$tahun = (empty($tahun)) ? date("Y") : $tahun;

			if(isset($_POST['filter'])){
				$this->evaluasi_model->id_skpd = $_POST['id_skpd'];
			}
			if(isset($_POST['tombol_submit'])){
					$this->evaluasi_model->update($_POST['nilai'], $id = $_POST['id_evaluasi']);
					$this->session->set_flashdata('msg', '<div class="alert alert-success text-center"> Data Berhasil Di Update </div>');
				}
			if(isset($_POST['tombol_submit_all'])){
					$this->evaluasi_model->updateMass();
					$this->session->set_flashdata('msg', '<div class="alert alert-success text-center"> Data Berhasil Di Update </div>');
				}
			if(isset($_POST['mass_create'])) {
				$this->evaluasi_model->insertMass();
				$this->session->set_flashdata('msg', '<div class="alert alert-success text-center"> Data Berhasil Di Ditambahkan </div>');
			}

			$data['list'] = $this->evaluasi_model->get_all_by_tahun($tahun);
			$data['skpd'] = $this->evaluasi_model->get_all_skpd();
			$this->load->view('admin/index',$data);
		}
		else
		{
			redirect('admin');
		}
	}

	public function insert_data(){
		$this->db->where('jenis_skpd','skpd');
		$this->db->or_where('jenis_skpd','kecamatan');
		$skpd = $this->db->get('ref_skpd')->result();
		foreach($skpd as $s){
			for($tahun=2019;$tahun<=2021;$tahun++){
				$cek = $this->db->get_where('evaluasi',array('id_skpd'=>$s->id_skpd,'tahun_evaluasi'=>$tahun))->num_rows();
				if($cek < 1){
					$this->db->insert('evaluasi',array('id_skpd'=>$s->id_skpd,'tahun_evaluasi'=>$tahun));
					echo $s->nama_skpd." - $tahun <br> ";
				}
			}
		}
	}

}
?>
