<?php
defined('BASEPATH') OR exit('No direct script access allowed');
ini_set('max_execution_time', '300');

class Standar_kepatuhan extends CI_Controller 
{
	public $user_id;

	public function __construct(){
		parent ::__construct();
		$this->user_id = $this->session->userdata('user_id');
		$this->load->model('user_model');
		$this->load->model('standar_kepatuhan_2_model', 'skm');
		$this->load->model('ref_skpd_model', 'rsm');
		$this->load->model('buka_tutup_form_model', 'btfm');
		$this->user_model->user_id = $this->user_id;
		$this->user_model->set_user_by_user_id();
		$this->user_picture = $this->user_model->user_picture;
		$this->full_name	= $this->user_model->full_name;
		$this->user_level	= $this->user_model->level;
		$this->id_pegawai	= $this->user_model->id_pegawai;
		$this->id_skpd = $this->user_model->id_skpd;
		$this->form_setting = $this->btfm->get_by_slug('standar_kepatuhan');
		$this->user_privileges	= $this->user_model->user_privileges;
		

		if ($this->user_level=="Admin Web");

		//$this->load->model('Ref_renstra','ref_kode_kegiatan_m');
	}

	public function index($index = null)
	{
		if ($this->user_id)
		{
			$data['title']		= "Standar Kepatuhan - Admin ";
			$data['content']	= "standar_kepatuhan_2/index" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "standar_kepatuhan_2";
			$data['id_pegawai'] = $this->id_pegawai;
			$data['id_skpd'] = $this->id_skpd;
			$data['user_privileges'] = explode(';', $this->user_privileges);
			$array_privileges = explode(';', $this->user_privileges);

			$data['column'] = $this->skm->get_column_name();
			$data['status_form'] = $this->form_setting;
			
			$data['skpd'] = $this->rsm->get_all();
			$filter = array();
			if (isset($_POST['filter'])) {
				$filter = $_POST;
				unset($filter['filter']);
			}

			if (isset($_POST['setting-form'])) {

				$insert['tanggal_mulai'] = $_POST['tanggal_mulai'];
				$insert['tanggal_tutup'] = $_POST['tanggal_tutup'];

				if ($this->btfm->update('standar_kepatuhan', $insert)) {
					return redirect('standar_kepatuhan', 'refresh');
				}
			}

			$this->skm->id_skpd = $this->id_skpd;
			if ($this->user_level == 'Administrator' || in_array('admin_standar_kepatuhan', $array_privileges)) {
				$this->skm->id_skpd = null;
			}

			$filter['max'] = $this->skm->get_max_id_standar_kepatuhan();;

			$data['list'] = $this->skm->get_standar_kepatuhan($filter);

			if($index == 1){
				$test = $this->skm->get_max_id_standar_kepatuhan();
				echo '<pre>'. print_r($data['list']);die;
			}

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
			$data['content']	= "standar_kepatuhan_2/add" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "standar_kepatuhan_2";
			$data['id_pegawai'] = $this->id_pegawai;
			$data['id_skpd'] = $this->id_skpd;

			$data['status_form'] = $this->form_setting;
			$status_form = $data['status_form'];

			$date = date('Y-m-d');
			if ($this->session->userdata('id_skpd') == 16 || ($date > $status_form->tanggal_mulai && $date < $status_form->tanggal_tutup)) {
				null;
			} else {
				redirect('standar_kepatuhan');
				die;
			}

			$data['skpd'] = $this->rsm->get_all();
			// $data['column'] = $this->skm->get_column_name();
			$data['indikator'] = $this->skm->get_indikator();
			$indikator = $this->skm->get_indikator_list();
			// echo '<pre>'; print_r($data['indikator']);die;

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
                if (empty($_FILES['jumlah_jenis_pelayanan_file']['name']))
				{
					$this->form_validation->set_rules('jumlah_jenis_pelayanan_file', 'Ketersediaan Layanan File', 'required');
				}
				// foreach ($data['column'] as $key => $value) {
				// 	if ($value->name == 'id_user' || $value->name == 'created_at' || $value->name == 'updated_at' || $value->name == 'id_standar_kepatuhan' || $value->name == 'id_skpd' 
				// 		|| $value->name == 'jumlah_jenis_pelayanan' || $value->name == 'jumlah_jenis_pelayanan_file' || substr($value->name, -5) == '_file' || substr($value->name, -5) == '_foto'
				// 		|| $value->name == 'status_review' || $value->name == 'nilai_review' || $value->name == 'catatan_review') {
				// 		continue;
				// 	}
				// 	$this->form_validation->set_rules($value->name, ucwords(str_replace("_"," ", $value->name)), 'required');
				// }
				if ($this->form_validation->run() != FALSE)
                {
					$insert['jumlah_jenis_pelayanan'] = $this->input->post('jumlah_jenis_pelayanan');
					$this->load->library('upload');
					if (!empty($_FILES['jumlah_jenis_pelayanan_file']['name'])) {
						$config = array(
							'allowed_types' => 'jpg|jpeg|png|pdf',
							'max_size'      => 5000,
							'upload_path' 	=> './data/standar_kepatuhan/',
							'file_name' => time().$_FILES['jumlah_jenis_pelayanan_file']['name']
							
						);
						$this->upload->initialize($config);
						if (!$this->upload->do_upload('jumlah_jenis_pelayanan_file')) {
							$error[] = $this->upload->display_errors();
						} else {
							$file_name = $this->upload->data('file_name');
							$insert['jumlah_jenis_pelayanan_file'] = $file_name;
						}
					}
					$insert['id_user'] = $this->user_id;
					$insert['created_at'] = date('Y-m-d H:i:s');

					$id_standar_kepatuhan = $this->skm->insert($insert);

					$insert_isi = [];
					$insert_isi['id_standar_kepatuhan'] = $id_standar_kepatuhan;
					$insert_isi['id_user'] = $this->user_id;
					$test = 0;

					foreach ($indikator as $i => $val){
						
						if (!empty($_FILES[$val['id_standar_kepatuhan_indikator'].'_foto']['name'])) {
							$config = array(
								'allowed_types' => 'jpg|jpeg|png|pdf',
								'max_size'      => 5000,
								'upload_path' 	=> './data/standar_kepatuhan/',
								'file_name' => time().$_FILES[$val['id_standar_kepatuhan_indikator'].'_foto']['name']
							);
							$this->upload->initialize($config);
							if (!$this->upload->do_upload($val['id_standar_kepatuhan_indikator'].'_foto')) {
								$error[] = $this->upload->display_errors();
							} else {
								$file_name = $this->upload->data('file_name');
								$insert_isi['foto'] = $file_name;
							}
						}
						
						// if (!empty($_FILES[$val['id_standar_kepatuhan_indikator'].'_file']['name'])) {
						// 	$config = array(
						// 		'allowed_types' => 'jpg|jpeg|png|pdf',
						// 		'max_size'      => 5000,
						// 		'upload_path' 	=> './data/standar_kepatuhan/',
						// 		'file_name' => time().$_FILES[$val['id_standar_kepatuhan_indikator'].'_file']['name']
						// 	);
						// 	$this->upload->initialize($config);
						// 	if (!$this->upload->do_upload($val['id_standar_kepatuhan_indikator'].'_file')) {
						// 		$error[] = $this->upload->display_errors();
						// 	} else {
						// 		$file_name = $this->upload->data('file_name');
						// 		$insert_isi['file'] = $file_name;
						// 	}
						// }

						if (!empty($_FILES[$val['id_standar_kepatuhan_indikator'].'_foto']['name'])){
							$insert_isi['id_standar_kepatuhan_indikator'] = $val['id_standar_kepatuhan_indikator'];
							$insert_isi['skor'] = $val['skor'];
							$this->skm->insert_isi($insert_isi);
						}

						$test += 1;
					}

					// echo '<pre>'; print_r($_FILES);
					// echo '<pre>'; print_r($_POST);
					// echo '<pre>'; print_r($indikator);
					// echo '<pre>'; print_r($id_standar_kepatuhan);
					// echo '<pre>'; print_r($error);
					// die;

					if ($id_standar_kepatuhan) {
						$this->session->set_flashdata('success', '<i class="ti-check"></i> Terimakasih sudah mengisi, inputan anda berhasil terekam di sistem.');
						redirect('standar_kepatuhan');
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
			$data['content']	= "standar_kepatuhan_2/detail" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "standar_kepatuhan_2";
			$data['id_pegawai'] = $this->id_pegawai;
			$data['id_skpd'] = $this->id_skpd;
			$data['user_privileges'] = explode(';', $this->user_privileges);

			$data['column'] = $this->skm->get_column_name();
			$data['detail'] = $this->skm->get_standar_kepatuhan_by_id($id);
			$data['indikator'] = $this->skm->get_indikator();

			if (isset($_POST['review'])) {
				$this->load->helper(array('form', 'url'));

                $this->load->library('form_validation');

				$this->form_validation->set_rules('nilai', 'Nilai Hasil Review', 'required');

				if ($this->form_validation->run() == true)
                {
					$review = $_POST;
					unset($review['review']);
					$review['status'] = 'Y';
                    if($this->skm->review($id,$review)){
						$this->session->set_flashdata('success', '<i class="ti-check"></i> Hasil review sudah dikirim.');
						redirect(base_url('standar_kepatuhan_2/detail/'.$id));
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

			$data['detail'] = $this->skm->get_standar_kepatuhan_by_id($id);
			$data['isi'] = $this->skm->get_standar_kepatuhan_isi_by_id_standar_kepatuhan($id);
			
			if (file_exists('./data/standar_kepatuhan/'.$detail['jumlah_jenis_pelayanan_file'])) {
				unlink('./data/standar_kepatuhan/'.$detail['jumlah_jenis_pelayanan_file']);
			}

			foreach ($data['isi'] as $key => $value) {
				if (!empty($value['foto'])) {
					if (file_exists('./data/standar_kepatuhan/'.$value['foto'])) {
						unlink('./data/standar_kepatuhan/'.$value['foto']);
					}
				}
				if (!empty($value['file'])) {
					if (file_exists('./data/standar_kepatuhan/'.$value['file'])) {
						unlink('./data/standar_kepatuhan/'.$value['file']);
					}
				}
				$this->skm->delete_isi($value['id_standar_kepatuhan_isi']);
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
	// 		$data['content']	= "standar_kepatuhan_2/edit" ;
	// 		$data['user_picture'] = $this->user_picture;
	// 		$data['full_name']		= $this->full_name;
	// 		$data['user_level']		= $this->user_level;
	// 		$data['active_menu'] = "standar_kepatuhan_2";
	// 		$data['id_pegawai'] = $this->id_pegawai;
	// 		$data['id_skpd'] = $this->id_skpd;
	// 		$this->load->model('ref_skpd_model');
	// 		$data['skpd'] = $this->ref_skpd_model->get_all();

	// 		if(isset($_POST['update'])){
	// 			$this->skm->update($_POST, $id);
	// 			$this->session->set_flashdata('sukses', 'Data Berhasil Diedit');
	// 			redirect("standar_kepatuhan_2");
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
	// 		$data['content']	= "standar_kepatuhan_2/detail" ;
	// 		$data['user_picture'] = $this->user_picture;
	// 		$data['full_name']		= $this->full_name;
	// 		$data['user_level']		= $this->user_level;
	// 		$data['active_menu'] = "standar_kepatuhan_2";

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
	// 	redirect("standar_kepatuhan_2");
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
