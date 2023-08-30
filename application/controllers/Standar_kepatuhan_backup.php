<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Standar_kepatuhan_backup extends CI_Controller 
{
	public $user_id;

	public function __construct(){
		parent ::__construct();
		$this->user_id = $this->session->userdata('user_id');
		$this->load->model('user_model');
		$this->load->model('standar_kepatuhan_model', 'skm');
		$this->load->model('standar_kepatuhan_list_model', 'sklm');
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
			$data['title']		= "Standar Kepatuhan - Admin ";
			$data['content']	= "standar_kepatuhan/index" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "standar_kepatuhan";
			$data['id_pegawai'] = $this->id_pegawai;
			$data['id_skpd'] = $this->id_skpd;
			$data['user_privileges'] = explode(';', $this->user_privileges);
			$array_privileges = explode(';', $this->user_privileges);

			$data['column'] = $this->skm->get_column_name();
			
			$data['sklm'] = $this->sklm->get_first();
			$data['skpd'] = $this->rsm->get_all();
			$filter = array();
			if (isset($_POST['filter'])) {
				$filter = $_POST;
				unset($filter['filter']);
			}

			$this->skm->id_user = $this->user_id;
			if ($this->user_level == 'Administrator' || in_array('program', $array_privileges)) {
				$this->skm->id_user = null;
			}
			$data['list'] = $this->skm->get_standar_kepatuhan($filter);

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
			$data['title']		= "Tambah Standar Kepatuhan - Admin ";
			$data['content']	= "standar_kepatuhan/add" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "standar_kepatuhan";
			$data['id_pegawai'] = $this->id_pegawai;
			$data['id_skpd'] = $this->id_skpd;

			$data['sklm'] = $this->sklm->get_first();
			$data['skpd'] = $this->rsm->get_all();
			$data['column'] = $this->skm->get_column_name();

			if(isset($_POST['submit'])){
				$this->load->helper(array('form', 'url'));

                $this->load->library('form_validation');

				if ($data['user_level'] == 'Administrator') {
					$this->form_validation->set_rules('id_skpd', 'Perangkat Daerah', 'required');
					$insert['id_skpd'] = $this->input->post('id_skpd');
				}else{
					$insert['id_skpd'] = $this->id_skpd;
				}
                $this->form_validation->set_rules('jumlah_jenis_pelayanan', 'Jumlah Jenis Pelayanan', 'required');
				foreach ($data['column'] as $key => $value) {
					if ($value->name == 'id_user' || $value->name == 'created_at' || $value->name == 'updated_at' || $value->name == 'id_standar_kepatuhan' || $value->name == 'id_skpd' 
						|| $value->name == 'jumlah_jenis_pelayanan' || $value->name == 'jumlah_jenis_pelayanan_file' || substr($value->name, -5) == '_file' || substr($value->name, -5) == '_foto'
						|| $value->name == 'status_review' || $value->name == 'nilai_review' || $value->name == 'catatan_review') {
						continue;
					}
					$this->form_validation->set_rules($value->name, ucwords(str_replace("_"," ", $value->name)), 'required');
				}
				if ($this->form_validation->run() != FALSE)
                {
					$insert['jumlah_jenis_pelayanan'] = $this->input->post('jumlah_jenis_pelayanan');
					$this->load->library('upload', $config);
					if (!empty($_FILES['jumlah_jenis_pelayanan_file']['name'])) {
						$config = array(
							'allowed_types' => 'jpg|jpeg|png|pdf',
							'max_size'      => 5000,
							'overwrite'     => FALSE,
							'upload_path' 	=> './data/standar_kepatuhan/'
						);
						$this->upload->initialize($config);
						if (!$this->upload->do_upload('jumlah_jenis_pelayanan_file')) {
							$error[] = $this->upload->display_errors();
							$insert['jumlah_jenis_pelayanan_file'] = $file_name;
						} else {
							$file_name = $this->upload->data('file_name');
							$insert['jumlah_jenis_pelayanan_file'] = $file_name;
						}
					}
					foreach ($data['column'] as $key => $value) {
						if ($value->name == 'id_user' || $value->name == 'created_at' || $value->name == 'updated_at' || $value->name == 'id_standar_kepatuhan' || $value->name == 'id_skpd' 
							|| $value->name == 'jumlah_jenis_pelayanan' || $value->name == 'jumlah_jenis_pelayanan_file') {
							continue;
						}elseif (substr($value->name, -5) == '_file' || substr($value->name, -5) == '_foto') {
							$this->load->library('upload');
							if (!empty($_FILES[$value->name]['name']) || !empty($_FILES[$value->name]['name'])) {
								$config = array(
									'allowed_types' => 'jpg|jpeg|png|pdf',
									'max_size'      => 5000,
									'overwrite'     => FALSE,
									'upload_path'	=> './data/standar_kepatuhan/'
								);
								$this->upload->initialize($config);
								if (!$this->upload->do_upload($value->name)) {
									$error[] = $this->upload->display_errors();
									$insert[$value->name] = null;
								} else {
									$file_name = $this->upload->data('file_name');
									$insert[$value->name] = $file_name;
								}
							}
						}else{
							$insert[$value->name] = $this->input->post($value->name);
						}
					}
					$insert['id_user'] = $this->user_id;
					$insert['created_at'] = date('Y-m-d H:i:s');

					if ($this->skm->insert($insert)) {
						$this->session->set_flashdata('success', '<i class="ti-check"></i> Terimakasih sudah mengisi, inputan anda berhasil terekam di sistem.');
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
			$data['title']		= "Detail Standar Kepatuhan - Admin ";
			$data['content']	= "standar_kepatuhan/detail" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "standar_kepatuhan";
			$data['id_pegawai'] = $this->id_pegawai;
			$data['id_skpd'] = $this->id_skpd;
			$data['user_privileges'] = explode(';', $this->user_privileges);

			$data['column'] = $this->skm->get_column_name();
			$data['detail'] = $this->skm->get_standar_kepatuhan_by_id($id);

			if (isset($_POST['review'])) {
				$this->load->helper(array('form', 'url'));

                $this->load->library('form_validation');

				$this->form_validation->set_rules('nilai_review', 'Nilai Hasil Review', 'required');

				if ($this->form_validation->run() == true)
                {
					$review = $_POST;
					unset($review['review']);
					$review['status_review'] = 'Sudah Direview';
                    if($this->skm->review($id,$review)){
						$this->session->set_flashdata('success', '<i class="ti-check"></i> Hasil review sudah dikirim.');
						redirect(base_url('standar_kepatuhan/detail/'.$id));
					}
                }
			}

			$this->load->view('admin/index',$data);
		}else{
			redirect('admin');
		}
	}

	public function delete($id)
	{
		if ($this->user_id) {

			$data['column'] = $this->skm->get_column_name();
			$data['detail'] = $this->skm->get_standar_kepatuhan_by_id($id);
			
			if (file_exists('./data/standar_kepatuhan/'.$detail['jumlah_jenis_pelayanan_file'])) {
				unlink('./data/standar_kepatuhan/'.$detail['jumlah_jenis_pelayanan_file']);
			}

			foreach ($data['column'] as $key => $value) {
				if (substr($value->name, -5) == '_file') {
					if (!empty($detail[$value->name.'_file'])) {
						if (file_exists('./data/standar_kepatuhan/'.$detail[$value->name.'_file'])) {
							unlink('./data/standar_kepatuhan/'.$detail[$value->name.'_file']);
						}
					}
				}
				if (substr($value->name, -5) == '_foto') {
					if (!empty($detail[$value->name.'_foto'])) {
						if (file_exists('./data/standar_kepatuhan/'.$detail[$value->name.'_foto'])) {
							unlink('./data/standar_kepatuhan/'.$detail[$value->name.'_foto']);
						}
					}
				}
			}

			if ($this->skm->delete($id)) {
				redirect('standar_kepatuhan');
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
				redirect('standar_kepatuhan');
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
	// 		$data['title']		= "Edit Standar Kepatuhan - Admin ";
	// 		$data['content']	= "standar_kepatuhan/edit" ;
	// 		$data['user_picture'] = $this->user_picture;
	// 		$data['full_name']		= $this->full_name;
	// 		$data['user_level']		= $this->user_level;
	// 		$data['active_menu'] = "standar_kepatuhan";
	// 		$data['id_pegawai'] = $this->id_pegawai;
	// 		$data['id_skpd'] = $this->id_skpd;
	// 		$this->load->model('ref_skpd_model');
	// 		$data['skpd'] = $this->ref_skpd_model->get_all();

	// 		if(isset($_POST['update'])){
	// 			$this->skm->update($_POST, $id);
	// 			$this->session->set_flashdata('sukses', 'Data Berhasil Diedit');
	// 			redirect("standar_kepatuhan");
	// 		}
	// 		$data['pengumuman'] = $this->skm->get_by_id($id);
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
	// 		$data['title']		= "Detail Standar Kepatuhan - Admin ";
	// 		$data['content']	= "standar_kepatuhan/detail" ;
	// 		$data['user_picture'] = $this->user_picture;
	// 		$data['full_name']		= $this->full_name;
	// 		$data['user_level']		= $this->user_level;
	// 		$data['active_menu'] = "standar_kepatuhan";

	// 		$data['pengumuman'] = $this->skm->get_by_id($id);
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
	// 	$detail = $this->skm->get_by_id($id);
	// 	if ($detail->) {
	// 		# code...
	// 	}
		
	// 	$this->skm->delete($id);
	// 	$this->session->set_flashdata('sukses', 'Data Berhasil Dihapus');
	// 	redirect("standar_kepatuhan");
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
