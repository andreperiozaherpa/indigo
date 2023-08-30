<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Prediksi_pensiun extends CI_Controller {
	public $user_id;
	public function __construct(){
		parent ::__construct();
		$this->user_id = $this->session->userdata('user_id');
		$this->load->model('user_model');
		$this->load->model('prediksi_pensiun_model');
		$this->load->model('ref_skpd_model');
		$this->load->model('pegawai_model');
		$this->user_model->user_id = $this->user_id;
		$this->user_model->set_user_by_user_id();
		$this->user_picture = $this->user_model->user_picture;
		$this->full_name	= $this->user_model->full_name;
		$this->user_level	= $this->user_model->level;
		$this->level_id	= $this->user_model->level_id;
	}
	public function index()
	{
		if ($this->user_id)
		{
			$data['title']		= "Prediksi Pensiun - Admin ";
			$data['content']	= "prediksi_pensiun/index" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu']		= 'prediksi_pensiun';

			$hal = 6;
			$page = isset($_GET["page"]) ? (int)$_GET["page"] : 1;
			$mulai = ($page>1) ? ($page * $hal) - $hal : 0;
			$total = $this->prediksi_pensiun_model->get_count();
			$data['pages'] = ceil($total/$hal);
			$data['current'] = $page;
			if(!empty($_POST)){
				$filter = $_POST;
				$nama = $_POST['nama_lengkap'];
				$skpd = @$_POST['id_skpd'];
				$tahun =  $_POST['tahun'];
				$bulan =  $_POST['bulan'];
				$data['filter'] = true;
				$data['filter_data'] = $_POST;
				$data['nama_lengkap'] = $_POST['nama_lengkap'];
				$data['id_skpd'] = @$_POST['id_skpd'];
				$data['tahun'] = $_POST['tahun'];
				$data['bulan'] = $_POST['bulan'];
			}else{
				$filter = '';
				$nama = '';
				$skpd = '';
				$tahun = '';
				$bulan = '';
				$data['filter'] = false;
			}
			$data['list'] = $this->prediksi_pensiun_model->get_page($mulai,$hal,$nama,$skpd,$tahun,$bulan);
			$data['skpd'] = $this->ref_skpd_model->get_all();

			$this->load->view('admin/index',$data);


		}
		else
		{
			redirect('admin');
		}
	}

	public function create($id_pegawai)
	{
		if ($this->user_id)
		{

			$data['title']		= "Input Usulan Pensiun - Admin ";
			$data['content']	= "prediksi_pensiun/add" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['active_menu']		= 'prediksi_pensiun';
			$data['user_level']		= $this->user_level;
			$data['skpd'] = $this->ref_skpd_model->get_all();
			$data['detail'] = $this->prediksi_pensiun_model->get_by_id($id_pegawai);
			$this->load->model('ref_alasan_pensiun_model');
			$data['perihal'] = $this->ref_alasan_pensiun_model->get_all();

			if(!empty($_POST)){
				$insert = $_POST;
				$insert['id_pegawai'] = $id_pegawai;
				if(isset($insert['tgl_meninggal'])){
					if($insert['tgl_meninggal']==""){
						$insert['tgl_meninggal'] =  NULL;
					}
				}
				$insert['tgl_usulan'] = date('Y-m-d');
				$in = $this->prediksi_pensiun_model->insert($insert);
				$data['message'] = '<i class="ti-check"></i> Usulan Pensiun berhasil ditambahkan, silahkan klik <b><a target="blank" style="color:#fff" href="'.base_url('usulan_pensiun/view/'.$in).'">disini</a></b> untuk melihat detail';
				$data['type'] = 'success';

			}

			$this->load->view('admin/index',$data);

		}
		else
		{
			redirect('admin');
		}
	}

	public function get_unit_kerja_by_skpd($id_skpd){
		$get = $this->ref_skpd_model->get_unit_kerja_by_id_skpd($id_skpd);
		echo '<option value="0">Pilih Unit Kerja</option>';
		foreach($get as $g){
			echo '<option value="'.$g->id_unit_kerja.'">'.$g->nama_unit_kerja.'</option>';
		}

	}


	public function get_jabatan_by_unit_kerja($id_unit_kerja){
		$get = $this->ref_skpd_model->get_jabatan_by_unit_kerja($id_unit_kerja);
		echo '<option value="0">Pilih Jabatan</option>';
		foreach($get as $g){
			echo '<option value="'.$g->id_jabatan.'">'.$g->nama_jabatan.'</option>';
		}

	}

	public function getFromMaster(){
		$nip_master = $_POST['nip_master'];
		$data = $this->pegawai_model->getFromMaster($nip_master);
		print(json_encode($data));
	}
	public function get_pegawai_for_pengajuan(){
		$nip_baru = $_POST['nip_baru'];
		$data = $this->pegawai_model->get_pegawai_for_pengajuan($nip_baru);
		print(json_encode($data));
	}
	public function view($id_pegawai=0)
	{
		if ($this->user_id && !empty($id_pegawai) && $id_pegawai>0)
		{

			$data['title']		= "Detail Prediksi Pensiun - Admin ";
			$data['content']	= "prediksi_pensiun/view" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu']		= 'prediksi_pensiun';
			$data['detail'] = $this->prediksi_pensiun_model->get_by_id($id_pegawai);
			$data['skpd'] = $this->ref_skpd_model->get_by_id($data['detail']->id_skpd);
			$data['jabatan'] = $this->ref_skpd_model->get_jabatan_by_id($data['detail']->id_jabatan);
			$data['unit_kerja'] = $this->ref_skpd_model->get_unit_kerja_by_id($data['detail']->id_unit_kerja);
			$data['cek_user'] = $this->pegawai_model->cek_user($id_pegawai);
			$this->user_model->id_pegawai = $id_pegawai;
			$data['id_pegawai'] = $id_pegawai;
			if ($data['cek_user']) {

				$data['detail_user'] = $this->user_model->get_by_pegawai();

				$data['u'] = $this->user_model->get_user_by_user_id($data['detail_user']->user_id);

				$data['active_menu'] = "";
				$data['top_nav']	= "NO";
				$this->load->model('post_model');
				$data['total_post']	= $this->post_model->getTotalByAuthor($this->user_id);

			//activity
				$this->load->model('logs_model');
				$data['logs']		= $this->logs_model->get_some_id($this->user_model->user_id);

			//departmen
				$this->load->model('ref_unit_kerja_model');
				$data['get_unit_kerja']		= $this->ref_unit_kerja_model->get_all();
			}

			$this->load->view('admin/index',$data);

		}
		else
		{
			redirect('admin');
		}
	}

	public function edit($id_pegawai=0)
	{
		if ($this->user_id && !empty($id_pegawai) && $id_pegawai>0)
		{
			$data['title']		= "Edit Pegawai - Admin ";
			$data['content']	= "prediksi_pensiun/edit" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['active_menu']		= 'prediksi_pensiun';
			$data['user_level']		= $this->user_level;
			$data['skpd'] = $this->ref_skpd_model->get_all();



			if(!empty($_POST)){
				$cek = $_POST;
				if(cekForm($cek)){
					$data['message'] = 'Masih ada form yang kosong';
					$data['type'] = 'warning';
				}else{
					$update = $_POST;
					unset($update['foto_pegawai']);
					$config['upload_path']          = './data/foto/pegawai/';
					$config['allowed_types']        = 'gif|jpg|png';
					$config['max_size']             = 2000;
					$config['max_width']            = 2000;
					$config['max_height']           = 2000;

					if(isset($_FILES['foto_pegawai']['tmp_name'])){
						$this->load->library('upload', $config);
						if ( ! $this->upload->do_upload('foto_pegawai')){
							$tmp_name = $_FILES['foto_pegawai']['tmp_name'];
							if ($tmp_name!=""){
								$data['message'] = $this->upload->display_errors();
								$data['type'] = "danger";
							}
						}else{
							$update['foto_pegawai'] = $this->upload->data('file_name');
						}
					}

					$in = $this->prediksi_pensiun_model->update($update,$id_pegawai);
					$data['message'] = 'Pegawai berhasil diubah';
					$data['type'] = 'success';
				}
			}

			$data['detail'] = $this->prediksi_pensiun_model->get_by_id($id_pegawai);
			$data['jabatan'] = $this->ref_skpd_model->get_jabatan_by_id($data['detail']->id_jabatan);
			$data['unit_kerja'] = $this->ref_skpd_model->get_unit_kerja_by_id($data['detail']->id_unit_kerja);

			$this->load->view('admin/index',$data);

		}
		else
		{
			redirect('admin');
		}
	}




	public function delete($id)
	{
		if ($this->user_id)
		{
			$this->prediksi_pensiun_model->delete($id);
			redirect('prediksi_pensiun');
		}
		else
		{
			redirect('home');
		}
	}

	public function reg_account(){
		$this->load->model('user_model');
		$id_pegawai = $_POST['id_pegawai'];

		$this->pegawai_model->id_pegawai = $id_pegawai;
		$detail = $this->pegawai_model->get_by_id();
		$cek_username = $this->user_model->cek_username($_POST['username']);
		$cek_user = $this->pegawai_model->cek_user($id_pegawai);

		if(cekForm($_POST)==TRUE){
			echo json_encode(array("status" => FALSE,"message" => "Masih ada form yang kosong"));
		}elseif($_POST['password']!==$_POST['c_password']){
			echo json_encode(array("status" => FALSE,"message" => "Konfirmasi Password tidak sama"));
		}elseif($cek_username==FALSE){
			echo json_encode(array("status" => FALSE,"message" => "Username sudah terdaftar"));
		}elseif($cek_user){
			echo json_encode(array("status" => FALSE,"message" => "pegawai ini telah didaftarkan"));
		}else{
			$this->user_model->username = $_POST['username'];
			$this->user_model->full_name = $detail->nama_lengkap;
			$this->user_model->password = $_POST['password'];
			$this->user_model->user_picture = 'user_default.png';
			$this->user_model->user_status = 'Active';
			$this->user_model->user_level = 2;
			$this->user_model->id_pegawai = $id_pegawai;
			$this->user_model->user_privileges = '';
			$this->user_model->unit_kerja_id = $detail->id_unit_kerja;
			$insert = $this->user_model->insert();
			$data = array('id_user'=>$insert);
			$update = $this->pegawai_model->update($data,$id_pegawai);
			echo json_encode(array("status" => TRUE));
		}
	}
	public function del_account($id_pegawai){
		$this->load->model('user_model');
		$this->pegawai_model->id_pegawai = $id_pegawai;
		$detail = $this->pegawai_model->get_by_id();
		$this->user_model->user_id = $detail->id_user;
		$this->user_model->delete();
		$data = array('id_user'=>0);
		$update = $this->pegawai_model->update($data,$id_pegawai);
		echo json_encode(array("status" => TRUE));
	}

	public function get_pegawai($nip){
		$url = 'http://124.158.175.50/publik/public/pegawai?key=208c462feb15040fc75fcb951c74e87a7f850f97a7ee933a362edca77f7ab744';
		$content = file_get_contents($url);
		$json = json_decode($content, true);
		$userdb = array(
			array(
				'uid' => '100',
				'name' => 'Sandra Shush',
				'pic_square' => 'urlof100'
			),
			array(
				'uid' => '5465',
				'name' => 'Stefanie Mcmohn',
				'pic_square' => 'urlof100'
			),
			array(
				'uid' => '40489',
				'name' => 'Michael',
				'pic_square' => 'urlof40489'
			)
		);
		$key = array_search($nip, array_column($json, 'nip'));
		if(empty($key)){
			$result = array('result'=>0,'message'=>'Pegawai tidak ditemukan');
		}else{
			$result = $json[$key];
			$result['result'] = 1;
		}
		echo json_encode($result);
	}



}
?>
