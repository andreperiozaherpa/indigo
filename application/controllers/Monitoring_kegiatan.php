<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Monitoring_kegiatan extends CI_Controller {
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
		if ($this->user_level=="Admin Web");

		// $this->load->model('realisasi_kegiatan_model','realisasi_kegiatan_m');
	}
	public function index()
	{
		if ($this->user_id)
		{
			$data['title']		= "Monitoring Kegiatan - Admin ";
			$data['content']	= "monitoring_kegiatan/index" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "monitoring_kegiatan";
			$data['query']		= $this->kegiatan_model->get_all();
			if($this->user_level=='Administrator'){
				$data['unit_kerja'] = $this->ref_unit_kerja_model->get_all();
			}else{
				$data['unit_kerja'] = $this->ref_skpd_model->get_unit_kerja_by_id_skpd($this->session->userdata('id_skpd'));
			}


			// if(!empty($_POST)){
				// $id_unit_kerja = $_POST['id_unit_kerja'];
				// if(empty($id_unit_kerja)){
				// 	$data['message'] = 'Silahkan pilih Unit Kerja terlebih dahulu';
				// }else{
			if(!empty($_POST)){
				$id_unit_kerja = $_POST['id_unit_kerja'];
				$tgl_awal = $_POST['tgl_awal'];
				$tgl_akhir = $_POST['tgl_akhir'];
			}else{
				$id_unit_kerja = '';
				$tgl_awal = '';
				$tgl_akhir = '';
			}
			$data['result'] = $this->monitoring_kegiatan_model->get_all($id_unit_kerja,$tgl_awal,$tgl_akhir);
			$data['daftar_pekerjaan'] = array();
			$data['sedang_dikerjakan'] = array();
			$data['selesai_dikerjakan'] = array();
			foreach($data['result'] as $n => $r){
				$progress = $this->realisasi_kegiatan_model->get_progress($r->id_kegiatan);
				if($progress==0){
					array_push($data['daftar_pekerjaan'], $data['result'][$n]);
				}elseif($progress==100){
					array_push($data['selesai_dikerjakan'], $data['result'][$n]);
				}else{
					array_push($data['sedang_dikerjakan'], $data['result'][$n]);
				}

			}
				// }
			// }

			$this->load->view('admin/index',$data);


		}
		else
		{
			redirect('admin');
		}
	}
}
?>
