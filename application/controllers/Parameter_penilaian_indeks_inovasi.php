<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Parameter_penilaian_indeks_inovasi extends CI_Controller 
{
	public $user_id;

	public function __construct(){
		parent ::__construct();
		$this->user_id = $this->session->userdata('user_id');
		$this->load->model('user_model');
		$this->load->model('parameter_penilaian_indeks_inovasi_model', 'ppiim');
		$this->load->model('ref_skpd_model', 'rsm');
		$this->user_model->user_id = $this->user_id;
		$this->user_model->set_user_by_user_id();
		$this->user_picture = $this->user_model->user_picture;
		$this->full_name	= $this->user_model->full_name;
		$this->user_level	= $this->user_model->level;
		$this->id_pegawai	= $this->user_model->id_pegawai;
		$this->id_skpd = $this->user_model->id_skpd;
		$this->user_privileges	= $this->user_model->user_privileges;
		

		if ($this->user_level=="Admin Web");

		//$this->load->model('Ref_renstra','ref_kode_kegiatan_m');
	}

	public function index()
	{
		if ($this->user_id)
		{
			$data['title']		= "Parameter Penilaian Indeks Inovasi";
			$data['content']	= "parameter_penilaian_indeks_inovasi/index" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "parameter_penilaian_indeks_inovasi";
			$data['id_pegawai'] = $this->id_pegawai;
			$data['id_skpd'] = $this->id_skpd;
			$data['user_privileges'] = explode(';', $this->user_privileges);
			$array_privileges = explode(';', $this->user_privileges);
			
			// $data['sklm'] = $this->sklm->get_first();
			$data['skpd'] = $this->rsm->get_all();
			$filter = array();
			if (isset($_POST['filter'])) {
				$filter = $_POST;
				unset($filter['filter']);
			}
			if ($this->user_level != 'Administrator' && !in_array('indeks_inovasi', $user_privileges) ) {
				$this->ppiim->id_user = $this->user_id;
			}
			$data['list'] = $this->ppiim->get_parameter_penilaian_indeks_inovasi($filter); 

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
			$data['title']		= "Tambah Parameter Penilaian ";
			$data['content']	= "parameter_penilaian_indeks_inovasi/add" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "parameter_penilaian_indeks_inovasi";
			$data['id_pegawai'] = $this->id_pegawai;
			$data['id_skpd'] = $this->id_skpd;

			// $data['sklm'] = $this->sklm->get_first();
			$data['skpd'] = $this->rsm->get_all();
			// $data['column'] = $this->ppiim->get_column_name();

			if(isset($_POST['submit'])){
				$this->load->helper(array('form', 'url'));

                $this->load->library('form_validation');

                $this->form_validation->set_rules('indikator', 'Indikator', 'required');
                $this->form_validation->set_rules('definisi_operasional', 'Definisi Operasional', 'required');
                $this->form_validation->set_rules('bobot', 'Bobot Penilaian', 'required');
                $this->form_validation->set_rules('parameter_pertama', 'Parameter Pertama', 'required');
                $this->form_validation->set_rules('parameter_kedua', 'Parameter Kedua', 'required');
                $this->form_validation->set_rules('parameter_ketiga', 'Parameter Ketiga', 'required');
				

				if ($this->form_validation->run() != FALSE)
                {
					$insert['indikator'] = $this->input->post('indikator');
					$insert['definisi_operasional'] = $this->input->post('definisi_operasional');
					$insert['bobot'] = $this->input->post('bobot');
					$insert['parameter_pertama'] = $this->input->post('parameter_pertama');
					$insert['parameter_kedua'] = $this->input->post('parameter_kedua');
					$insert['parameter_ketiga'] = $this->input->post('parameter_ketiga');
					$insert['informasi_inputan'] = $this->input->post('informasi_inputan');
					$insert['type_input'] = $this->input->post('type_input');
					$insert['urutan'] = $this->input->post('urutan');
					
					$insert['id_user'] = $this->user_id;
					$insert['created_at'] = date('Y-m-d H:i:s');

					if ($this->ppiim->insert($insert)) {
						$this->session->set_flashdata('success', '<i class="ti-check"></i> Terimakasih sudah mengisi, inputan anda berhasil terekam di sistem.');
						redirect('parameter_penilaian_indeks_inovasi');
					}
                }
				
			}
			
			$this->load->view('admin/index',$data);

		}
		else
		{
			redirect('admin');
		}
	}

	public function edit($id)
	{
		if ($this->user_id)
		{
			$data['title']		= "Ubah Parameter Penilaian ";
			$data['content']	= "parameter_penilaian_indeks_inovasi/edit" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "parameter_penilaian_indeks_inovasi";
			$data['id_pegawai'] = $this->id_pegawai;
			$data['id_skpd'] = $this->id_skpd;

			// $data['sklm'] = $this->sklm->get_first();
			$data['skpd'] = $this->rsm->get_all();
			$data['detail'] = $this->ppiim->get_parameter_penilaian_indeks_inovasi_by_id($id);
			// $data['column'] = $this->ppiim->get_column_name();

			if(isset($_POST['submit'])){
				$this->load->helper(array('form', 'url'));

                $this->load->library('form_validation');

				$this->form_validation->set_rules('indikator', 'Indikator', 'required');
                $this->form_validation->set_rules('definisi_operasional', 'Definisi Operasional', 'required');
                $this->form_validation->set_rules('bobot', 'Bobot Penilaian', 'required');
                $this->form_validation->set_rules('parameter_pertama', 'Parameter Pertama', 'required');
                $this->form_validation->set_rules('parameter_kedua', 'Parameter Kedua', 'required');
                $this->form_validation->set_rules('parameter_ketiga', 'Parameter Ketiga', 'required');

				if ($this->form_validation->run() != FALSE)
                {
					$insert['indikator'] = $this->input->post('indikator');
					$insert['definisi_operasional'] = $this->input->post('definisi_operasional');
					$insert['bobot'] = $this->input->post('bobot');
					$insert['parameter_pertama'] = $this->input->post('parameter_pertama');
					$insert['parameter_kedua'] = $this->input->post('parameter_kedua');
					$insert['parameter_ketiga'] = $this->input->post('parameter_ketiga');
					$insert['informasi_inputan'] = $this->input->post('informasi_inputan');
					$insert['type_input'] = $this->input->post('type_input');
					$insert['urutan'] = $this->input->post('urutan');
					
					$insert['id_user'] = $this->user_id;
					$insert['updated_at'] = date('Y-m-d H:i:s');

					if ($this->ppiim->update($insert,$id)) {
						$this->session->set_flashdata('success', '<i class="ti-check"></i> Berhasil, data telah diperbaharui.');
						redirect('parameter_penilaian_indeks_inovasi');
					}
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
		if ($this->user_id) {
			$data['title']		= "Detail Parameter Penilaian ";
			$data['content']	= "parameter_penilaian_indeks_inovasi/detail" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "parameter_penilaian_indeks_inovasi";
			$data['id_pegawai'] = $this->id_pegawai;
			$data['id_skpd'] = $this->id_skpd;
			$data['user_privileges'] = explode(';', $this->user_privileges);

			$data['detail'] = $this->ppiim->get_parameter_penilaian_indeks_inovasi_by_id($id);

			$this->load->view('admin/index',$data);
		}else{
			redirect('admin');
		}
	}

	public function delete($id)
	{
		if ($this->user_id) {

			$data['detail'] = $this->ppiim->get_parameter_penilaian_indeks_inovasi_by_id($id);

			if ($this->ppiim->delete($id)) {
				$this->session->set_flashdata('success', '<i class="ti-check"></i> Berhasil, data telah dihapus.');
				redirect('parameter_penilaian_indeks_inovasi');
			}

			$this->load->view('admin/index',$data);
		}else{
			redirect('admin');
		}
	}

	public function update_sklm($id)
	{
		if ($this->user_id) {

			$data['detail'] = $this->sklm->get_by_id($id);

			if ($data['detail']->status == 'Y') {
				$status = 'N';
			}else{
				$status = 'Y';
			}

			if ($this->sklm->update_status_sklm($id, $status)) {
				redirect('parameter_penilaian_indeks_inovasi');
			}

			$this->load->view('admin/index',$data);
		}else{
			redirect('admin');
		}
	}

	// public function ubah($id)
	// {
	// 	if ($this->user_id)
	// 	{
	// 		if ($id == "") {
	// 			redirect('pengumuman');
	// 		}
	// 		$data['title']		= "Edit Parameter Penilaian ";
	// 		$data['content']	= "parameter_penilaian_indeks_inovasi/edit" ;
	// 		$data['user_picture'] = $this->user_picture;
	// 		$data['full_name']		= $this->full_name;
	// 		$data['user_level']		= $this->user_level;
	// 		$data['active_menu'] = "parameter_penilaian_indeks_inovasi";
	// 		$data['id_pegawai'] = $this->id_pegawai;
	// 		$data['id_skpd'] = $this->id_skpd;
	// 		$this->load->model('ref_skpd_model');
	// 		$data['skpd'] = $this->ref_skpd_model->get_all();

	// 		if(isset($_POST['update'])){
	// 			$this->ppiim->update($_POST, $id);
	// 			$this->session->set_flashdata('sukses', 'Data Berhasil Diedit');
	// 			redirect("parameter_penilaian_indeks_inovasi");
	// 		}
	// 		$data['pengumuman'] = $this->ppiim->get_by_id($id);
	// 		if(empty($data['pengumuman'])){
	// 			show_404();
	// 		}
	// 		if($this->user_level!=="Administrator"){
	// 			if($data['pengumuman']->id_pegawai!==$this->id_pegawai){
	// 				show_404();
	// 			}
	// 		}
	// 		$this->load->view('admin/index',$data);

	// 	}
	// 	else
	// 	{
	// 		redirect('admin');
	// 	}
	// }


	// public function detail($id)
	// {
	// 	if ($this->user_id)
	// 	{
	// 		if ($id == "") {
	// 			redirect('pengumuman');
	// 		}
	// 		$data['title']		= "Detail Parameter Penilaian ";
	// 		$data['content']	= "parameter_penilaian_indeks_inovasi/detail" ;
	// 		$data['user_picture'] = $this->user_picture;
	// 		$data['full_name']		= $this->full_name;
	// 		$data['user_level']		= $this->user_level;
	// 		$data['active_menu'] = "parameter_penilaian_indeks_inovasi";

	// 		$data['pengumuman'] = $this->ppiim->get_by_id($id);
	// 		if(empty($data['pengumuman'])){
	// 			show_404();
	// 		}
	// 		if($this->user_level!=="Administrator"){
	// 			if($data['pengumuman']->id_pegawai!==$this->id_pegawai){
	// 				show_404();
	// 			}
	// 		}
	// 		$this->load->view('admin/index',$data);

	// 	}
	// 	else
	// 	{
	// 		redirect('admin');
	// 	}
	// }

	// public function delete($id){
	// 	$detail = $this->ppiim->get_by_id($id);
	// 	if ($detail->) {
	// 		# code...
	// 	}
		
	// 	$this->ppiim->delete($id);
	// 	$this->session->set_flashdata('sukses', 'Data Berhasil Dihapus');
	// 	redirect("parameter_penilaian_indeks_inovasi");
	// }

	// public function randomize(){
	// 	$this->db->limit(6);
	// 	$pegawai = $this->db->get_where('pegawai',array('id_skpd'=>16,'pensiun'=>0))->result();

	// 	$array_pegawai = $pegawai;

	// 	$menilaian = array();
	// 	$count = array();
	// 	$apr = array();

	// 	foreach($pegawai as $p){
	// 		$list_menilai = array();
	// 		$apr = $array_pegawai;
	// 		// print_r($apr);

	// 		while(count($list_menilai)!=4){
	// 			if (count($apr)==0) {
	// 				break;
	// 			}

	// 			$random = array_rand($apr);
	// 			$menilai = $pegawai[$random];

	// 			if (!isset($pegawai[$random])) {
	// 				echo $random;
	// 				print_r($pegawai[$random]);die();
	// 				break;
	// 			}

	// 			if (!array_key_exists($random, $count)) {
	// 				$count[$random] = 0;
	// 			}

	// 			if ($menilai->id_pegawai!=$p->id_pegawai) {
	// 				if (!in_array($menilai->id_pegawai, $list_menilai)) {
	// 					unset($apr[$random]);
	// 					$list_menilai[] = $menilai->id_pegawai;
	// 					$count[$random]++;
	// 					if ($count[$random]==4) {
	// 						unset($array_pegawai[$random]);
	// 					}
	// 				} else {
	// 					unset($apr[$random]);
	// 				}
	// 			} else {
	// 				unset($apr[$random]);
	// 			}
	// 		}

	// 		$menilaian[] = array('id_pegawai'=>$p->id_pegawai,'menilai'=>$list_menilai);

	// 	}

	// 	echo "<pre>";
	// 	print_r($menilaian);
	// }

	// public function randomize2(){
	// 	$this->db->limit(5);
	// 	$pegawai = $this->db->get_where('pegawai',array('id_skpd'=>16,'pensiun'=>0))->result();

	// 	$menilaian = array();

	// 	foreach($pegawai as $p){
	// 		$list_menilai = array();

	// 		$selected = array();

	// 		while(count($list_menilai)!=4){

	// 			// if(in_array($list_menilai))
				
	// 			$menilai = $pegawai[rand(0,count($pegawai)-1)];

	// 			$selected[] = $menilai->id_pegawai;
	// 			if(count($selected)==count($pegawai)){
	// 				break;
	// 			}

	// 			if(!in_array($menilai->id_pegawai,$list_menilai)){
	// 				if($menilai->id_pegawai!==$p->id_pegawai){

	// 					$count = 0;
	// 					foreach($menilaian as $pp){
	// 						foreach($pp['menilai'] as $pe){
	// 							if($menilai->id_pegawai==$pe){
	// 								$count++;
	// 							}
	// 						}
	// 					}						

	// 					if($count!=4){
	// 						// echo $count;
	// 						$list_menilai[] = $menilai->id_pegawai;
	// 					}
	// 				}
	// 			}

	// 		}

	// 		$menilaian[] = array('id_pegawai'=>$p->id_pegawai,'menilai'=>$list_menilai);

	// 	}

	// 	print_r($menilaian);
	// }


}
?>
