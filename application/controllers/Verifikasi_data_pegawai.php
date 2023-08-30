<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Verifikasi_data_pegawai extends CI_Controller {
	public $user_id;
	public function __construct(){
		parent ::__construct();
		$this->user_id = $this->session->userdata('user_id');
		$this->load->model('user_model');
		$this->load->model('master_pegawai_model');
		$this->load->model('verifikasi_data_pegawai_model');
		$this->load->model('ref_skpd_model');
		$this->load->model('dashboard_model', 'dm');
		$this->load->model('kegiatan_model', 'km');
		$this->load->model('kegiatan_personal_model', 'kpm');
		$this->load->model('realisasi_kegiatan_model', 'rkm');
		$this->load->model('pegawai_model');
		$this->user_model->user_id = $this->user_id;
		$this->user_model->set_user_by_user_id();
		$this->id_pegawai	= $this->user_model->id_pegawai;
		$this->user_picture = $this->user_model->user_picture;
		$this->full_name	= $this->user_model->full_name;
		$this->user_level	= $this->user_model->level;
		$this->foto_pegawai = $this->user_model->foto_pegawai;
		$this->level_id	= $this->user_model->level_id;
	}

	public function index($summary_field='',$summary_value='')
	{
		if ($this->user_id)
		{


			$data['title']		= "Verifikasi Data Pegawai - Admin ";
			$data['content']	= "verifikasi_data_pegawai/index" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu']		= 'verifikasi_data_pegawai';

			$hal = 6;
			$page = isset($_GET["page"]) ? (int)$_GET["page"] : 1;
			$mulai = ($page>1) ? ($page * $hal) - $hal : 0;
			$total = count($this->verifikasi_data_pegawai_model->get_pages($summary_field,$summary_value));
			$data['pages'] = ceil($total/$hal);
			$data['current'] = $page;
			if(!empty($_POST)){
				$filter = $_POST;
				$nip = $_POST['nip'];
				$nama = $_POST['nama_lengkap'];
				$skpd = $_POST['id_skpd'];
				$data['filter'] = true;
				$data['filter_data'] = $_POST;
				$data['nip'] = $_POST['nip'];
				$data['nama_lengkap'] = $_POST['nama_lengkap'];
				$data['id_skpd'] = $_POST['id_skpd'];
			}else{
				$filter = '';
				$nip = '';
				$nama = '';
				$skpd = '';
				$data['filter'] = false;
			}
			// $data['total_pegawai'] = $this->verifikasi_data_pegawai_model->get_total_pegawai();
			// $data['total_pegawai_true'] = $this->verifikasi_data_pegawai_model->get_total_pegawai_true();
			// $data['total_pegawai_process'] = $this->verifikasi_data_pegawai_model->get_total_pegawai_process();
			// $data['total_pegawai_false'] = $this->verifikasi_data_pegawai_model->get_total_pegawai_false();
			$data['total_pegawai'] = 0;
			$data['total_pegawai_true'] = 0;
			$data['total_pegawai_process'] = 0;
			$data['total_pegawai_false'] = 0;
			if(!empty($summary_value)&&!empty($summary_field)){
				$data['summary_field'] = $summary_field;
				$data['summary_value'] = $summary_value;
			}

			$data['list'] = $this->verifikasi_data_pegawai_model->get_page($mulai,$hal,$nama,$nip,$skpd,$summary_field,$summary_value);
			$data['skpd'] = $this->ref_skpd_model->get_all();

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

			$data['title']		= "Master Pegawai - Admin ";
			$data['content']	= "master_pegawai/add" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['active_menu']		= 'master_pegawai';
			$data['user_level']		= $this->user_level;
			$data['skpd'] = $this->ref_skpd_model->get_all();



			if(!empty($_POST)){
				$cek = $_POST;
				if(cekForm($cek)){
					$data['message'] = 'Masih ada form yang kosong';
					$data['type'] = 'warning';
				}else{
					$insert = $_POST;
					unset($insert['foto_pegawai']);
					$insert['foto_pegawai'] = "user-default.png";

					$config['upload_path']          = './data/foto/pegawai/';
					$config['allowed_types']        = 'gif|jpg|png';
					$config['max_size']             = 2000;
					$config['max_width']            = 2000;
					$config['max_height']           = 2000;

					$this->load->library('upload', $config);
					if ( ! $this->upload->do_upload('foto_pegawai')){
						$tmp_name = $_FILES['foto_pegawai']['tmp_name'];
						if ($tmp_name!=""){
							$data['message'] = $this->upload->display_errors();
							$data['type'] = "danger";
						}
					}else{
						$insert['foto_pegawai'] = $this->upload->data('file_name');
					}

					$in = $this->master_pegawai_model->insert($insert);
					$data['message'] = 'Pegawai berhasil ditambahkan';
					$data['type'] = 'success';
				}
			}

			if($this->user_level=='Operator'){
				$data['unit_kerja'] = $this->ref_skpd_model->get_unit_kerja_by_id_skpd($this->session->userdata('id_skpd'));
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

			$data['title']		= "Master Pegawai - Admin ";
			$data['content']	= "master_pegawai/view" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu']		= 'master_pegawai';
			$data['detail'] = $this->master_pegawai_model->get_by_id($id_pegawai);
			foreach($data['detail'] as $k => $d){
				if(empty($d)){
					$data['detail']->$k = "-";
				}

			}
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
			$data['content']	= "master_pegawai/edit" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['active_menu']		= 'master_pegawai';
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

					$in = $this->master_pegawai_model->update($update,$id_pegawai);
					$data['message'] = 'Pegawai berhasil diubah';
					$data['type'] = 'success';
				}
			}

			$data['detail'] = $this->master_pegawai_model->get_by_id($id_pegawai);
			$data['jabatan'] = $this->ref_skpd_model->get_jabatan_by_id($data['detail']->id_jabatan);
			$data['unit_kerja'] = $this->ref_skpd_model->get_unit_kerja_by_id_skpd($data['detail']->id_skpd);

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
			$this->master_pegawai_model->delete($id);
			redirect('master_pegawai');
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
			$this->user_model->id_skpd = $detail->id_skpd;
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

	public function reset_token($id_pegawai){
		$this->load->model('user_model');
		$this->pegawai_model->id_pegawai = $id_pegawai;
		$detail = $this->pegawai_model->get_by_id();
		$id_user = $detail->id_user;
		$this->user_model->reset_token($id_user);
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

	public function kominfo(){
		$url = 'http://124.158.175.50/publik/public/pegawai?key=208c462feb15040fc75fcb951c74e87a7f850f97a7ee933a362edca77f7ab744';
		$content = file_get_contents($url);
		$json = json_decode($content, true);
		$kominfo = array();
		foreach($json as $j){
			if($j['unitkerja']=='Dinas Komunikasi, Informatika, Persandian dan Statistik'){
				$kominfo[] = $j;
			}
		}
		print_r($kominfo);
	}

	public function testing(){
		$this->db->where('golongan is null');
		$query = $this->db->get('pegawai')->result();
		foreach($query as $q){
			$this->db->where('nip',$q->nip);
			$a = $this->db->get('data_bkd')->row();
			print_r($q);

			// $this->db->where('nip',$q->nip);
			// $this->db->set('golongan',$a->gol);
			// $this->db->set('pangkat',$a->pangkat);
			// $this->db->update('pegawai');
			// echo "success<br>";
		}
	}

	public function details_kepegawaian($id_pegawai=0)
	{
		if ($this->user_id && !empty($id_pegawai) && $id_pegawai>0)
		{
			$data['title']		= "Details User";
			$data['content']	= "verifikasi_data_pegawai/views" ;
			$data['user_picture'] = $this->user_picture;
			$data['foto_pegawai'] = $this->foto_pegawai;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['user_id'] = $this->id_pegawai;
			$data['active_menu'] = "dashboard_user";

			//Read
			$data['golongan'] = $this->pegawai_model->get_golongan();
			$data['gelardepan'] = $this->pegawai_model->get_gelardepan();
			$data['gelarbelakang'] = $this->pegawai_model->get_gelarbelakang();
			$data['agama'] = $this->pegawai_model->get_agama();
			$data['provinsi'] = $this->pegawai_model->get_provinsi();
			$data['kecamatan'] = $this->pegawai_model->get_kecamatan();
			$data['desa'] = $this->pegawai_model->get_desa();
			$data['kabupaten'] = $this->pegawai_model->get_kabupaten();
			$data['statusmenikah'] = $this->pegawai_model->get_statusmenikah();
			// $this->load->model('ref_jabatan_model');
			// $data['jabatan'] = $this->ref_jabatan_model->getAll(1);
			// $data['jab_level1'] = $this->ref_jabatan_model->get_all(1);
			// $data['arr_jenis_jabatan'] = $this->ref_jabatan_model->arr_jenis_jabatan;
			$data['eselon'] = $this->pegawai_model->get_eselon();
			$data['jenjangpendidikan'] = $this->pegawai_model->get_jenjangpendidikan();
			$data['tempatpendidikan'] = $this->pegawai_model->get_tempatpendidikan();
			$data['jurusan'] = $this->pegawai_model->get_jurusan();
			$data['jenisdiklat'] = $this->pegawai_model->get_jenisdiklat();
			$data['jenispenataran'] = $this->pegawai_model->get_jenispenataran();
			$data['jenisseminar'] = $this->pegawai_model->get_jenisseminar();
			$data['jeniskursus'] = $this->pegawai_model->get_jeniskursus();
			$data['unit_kerja1'] = $this->pegawai_model->get_unit_kerja();
			$data['jenispenghargaan'] = $this->pegawai_model->get_jenispenghargaan();
			$data['jenispenugasan'] = $this->pegawai_model->get_jenispenugasan();
			$data['jeniscuti'] = $this->pegawai_model->get_jeniscuti();
			$data['jenishukuman'] = $this->pegawai_model->get_jenishukuman();
			$data['jenisbahasa']= $this->pegawai_model->get_jenisbahasa();
			$data['jenisbahasa_asing']= $this->pegawai_model->get_jenisbahasa_asing();
			$data['data_pegawai'] = $this->pegawai_model->get_data_pegawai_by_id($id_pegawai);
			//
			$data['data_pangkat'] = $this->pegawai_model->get_riwayat_pangkat_by_id($id_pegawai);
			$data['data_jabatan'] = $this->pegawai_model->get_riwayat_jabatan_by_id($id_pegawai);
			$data['data_pendidikan'] = $this->pegawai_model->get_riwayat_pendidikan_by_id($id_pegawai);
			$data['data_diklat'] = $this->pegawai_model->get_riwayat_diklat_by_id($id_pegawai);
			$data['data_penataran'] = $this->pegawai_model->get_riwayat_penataran($id_pegawai);
			$data['data_seminar'] = $this->pegawai_model->get_riwayat_seminar($id_pegawai);
			$data['data_kursus'] = $this->pegawai_model->get_riwayat_kursus($id_pegawai);
			$data['data_unit_kerja'] = $this->pegawai_model->get_riwayat_unit_kerja_by_id($id_pegawai);
			$data['data_penghargaan'] = $this->pegawai_model->get_riwayat_penghargaan_by_id($id_pegawai);
			$data['data_penugasan'] = $this->pegawai_model->get_riwayat_penugasan($id_pegawai);
			$data['data_cuti'] = $this->pegawai_model->get_riwayat_cuti($id_pegawai);
			$data['data_hukuman'] = $this->pegawai_model->get_riwayat_hukuman($id_pegawai);
			$data['pendidikan_last'] = $this->pegawai_model->get_riwayat_pendidikan($id_pegawai,1);
			$data['pangkat_last'] = $this->pegawai_model->get_riwayat_pangkat($id_pegawai,1);
			$data['jabatan_last'] = $this->pegawai_model->get_riwayat_jabatan($id_pegawai,1);
			$data['unit_kerja_last'] = $this->pegawai_model->get_riwayat_unit_kerja($id_pegawai,1);
			$data['data_bahasa']= $this->pegawai_model->get_riwayat_bahasa($id_pegawai);
			$data['data_bahasa_asing']= $this->pegawai_model->get_riwayat_bahasa_asing($id_pegawai);
			$data['data_pernikahan'] = $this->pegawai_model->get_riwayat_pernikahan($id_pegawai);
			$data['data_anak'] = $this->pegawai_model->get_riwayat_anak($id_pegawai);
			$data['data_orangtua'] = $this->pegawai_model->get_riwayat_orangtua($id_pegawai);
			$data['data_mertua'] = $this->pegawai_model->get_riwayat_mertua($id_pegawai);
			$jumlah_riwayat = count($data['data_pangkat']) + count($data['data_jabatan']) + count($data['data_pendidikan']) + count($data['data_diklat']) + count($data['data_penataran']) + count($data['data_seminar']) + count($data['data_kursus']) + count($data['data_unit_kerja']) + count($data['data_penghargaan']) + count($data['data_penugasan']) + count($data['data_cuti']) + count($data['data_hukuman']) + count($data['data_bahasa']) + count($data['data_bahasa_asing']) + count($data['data_pernikahan']) + count($data['data_anak']) + count($data['data_orangtua']) + count($data['data_mertua']);
			$data['jumlah_riwayat'] = $jumlah_riwayat;
			//
			$data['data_verif_pangkat'] = $this->pegawai_model->get_verif_bkd_riwayat_pangkat_by_id($id_pegawai);
			$data['data_verif_jabatan'] = $this->pegawai_model->get_verif_bkd_riwayat_jabatan_by_id($id_pegawai);
			$data['data_verif_pendidikan'] = $this->pegawai_model->get_verif_bkd_riwayat_pendidikan_by_id($id_pegawai);
			$data['data_verif_diklat'] = $this->pegawai_model->get_verif_bkd_riwayat_diklat_by_id($id_pegawai);
			$data['data_verif_penataran'] = $this->pegawai_model->get_verif_bkd_riwayat_penataran($id_pegawai);
			$data['data_verif_seminar'] = $this->pegawai_model->get_verif_bkd_riwayat_seminar($id_pegawai);
			$data['data_verif_kursus'] = $this->pegawai_model->get_verif_bkd_riwayat_kursus($id_pegawai);
			$data['data_verif_unit_kerja'] = $this->pegawai_model->get_verif_bkd_riwayat_unit_kerja_by_id($id_pegawai);
			$data['data_verif_penghargaan'] = $this->pegawai_model->get_verif_bkd_riwayat_penghargaan_by_id($id_pegawai);
			$data['data_verif_penugasan'] = $this->pegawai_model->get_verif_bkd_riwayat_penugasan($id_pegawai);
			$data['data_verif_cuti'] = $this->pegawai_model->get_verif_bkd_riwayat_cuti($id_pegawai);
			$data['data_verif_hukuman'] = $this->pegawai_model->get_verif_bkd_riwayat_hukuman($id_pegawai);
			$data['data_verif_bahasa']= $this->pegawai_model->get_verif_bkd_riwayat_bahasa($id_pegawai);
			$data['data_verif_bahasa_asing']= $this->pegawai_model->get_verif_bkd_riwayat_bahasa_asing($id_pegawai);
			$data['data_verif_pernikahan'] = $this->pegawai_model->get_verif_bkd_riwayat_pernikahan($id_pegawai);
			$data['data_verif_anak'] = $this->pegawai_model->get_verif_bkd_riwayat_anak($id_pegawai);
			$data['data_verif_orangtua'] = $this->pegawai_model->get_verif_bkd_riwayat_orangtua($id_pegawai);
			$data['data_verif_mertua'] = $this->pegawai_model->get_verif_bkd_riwayat_mertua($id_pegawai);
				$jumlah_verif_riwayat = count($data['data_verif_pangkat']) + count($data['data_verif_jabatan']) + count($data['data_verif_pendidikan']) + count($data['data_verif_diklat']) + count($data['data_verif_penataran']) + count($data['data_verif_seminar']) + count($data['data_verif_kursus']) + count($data['data_verif_unit_kerja']) + count($data['data_verif_penghargaan']) + count($data['data_verif_penugasan']) + count($data['data_verif_cuti']) + count($data['data_verif_hukuman']) + count($data['data_verif_bahasa']) + count($data['data_verif_bahasa_asing']) + count($data['data_verif_pernikahan']) + count($data['data_verif_anak']) + count($data['data_verif_orangtua']) + count($data['data_verif_mertua']);
			$data['jumlah_verif_riwayat'] = $jumlah_verif_riwayat;
			//
			$data['data_by_bkd'] = $this->dm->get_data_bkd($id_pegawai);
			//CREATE
			if (isset($_POST['submit_pangkat'])) {
			  $this->dm->add_riwayat_pangkat_by_operator($id_pegawai);
			  echo '<script>javascript:alert("Berhasil ditambahkan!");window.location = window.location.href;</script>';
			}
			if (isset($_POST['submit_jabatan'])) {
			  $this->dm->add_riwayat_jabatan_by_operator($id_pegawai);
			  echo '<script>javascript:alert("Berhasil ditambahkan!");window.location = window.location.href;</script>';
			}
			if (isset($_POST['submit_pendidikan'])) {
			  $this->dm->add_riwayat_pendidikan_by_operator($id_pegawai);
			  echo '<script>javascript:alert("Berhasil ditambahkan!");window.location = window.location.href;</script>';
			}
			if (isset($_POST['submit_diklat'])) {
			  $this->dm->add_riwayat_diklat_by_operator($id_pegawai);
			  echo '<script>javascript:alert("Berhasil ditambahkan!");window.location = window.location.href;</script>';
			}
			if (isset($_POST['submit_penataran'])) {
			  $this->dm->add_riwayat_penataran_by_operator($id_pegawai);
			  echo '<script>javascript:alert("Berhasil ditambahkan!");window.location = window.location.href;</script>';
			}
			if (isset($_POST['submit_seminar'])) {
			  $this->dm->add_riwayat_seminar_by_operator($id_pegawai);
			  echo '<script>javascript:alert("Berhasil ditambahkan!");window.location = window.location.href;</script>';
			}
			if (isset($_POST['submit_kursus'])) {
			  $this->dm->add_riwayat_kursus_by_operator($id_pegawai);
			  echo '<script>javascript:alert("Berhasil ditambahkan!");window.location = window.location.href;</script>';
			}
			if (isset($_POST['submit_unit_kerja'])) {
			  $this->dm->add_riwayat_unit_kerja_by_operator($id_pegawai);
			  echo '<script>javascript:alert("Berhasil ditambahkan!");window.location = window.location.href;</script>';
			}
			if (isset($_POST['submit_penghargaan'])) {
			  $this->dm->add_riwayat_penghargaan_by_operator($id_pegawai);
			  echo '<script>javascript:alert("Berhasil ditambahkan!");window.location = window.location.href;</script>';
			}
			if (isset($_POST['submit_penugasan'])) {
			  $this->dm->add_riwayat_penugasan_by_operator($id_pegawai);
			  echo '<script>javascript:alert("Berhasil ditambahkan!");window.location = window.location.href;</script>';
			}
			if (isset($_POST['submit_cuti'])) {
			  $this->dm->add_riwayat_cuti_by_operator($id_pegawai);
			  echo '<script>javascript:alert("Berhasil ditambahkan!");window.location = window.location.href;</script>';
			}
			if (isset($_POST['submit_hukuman'])) {
			  $this->dm->add_riwayat_hukuman_by_operator($id_pegawai);
			  echo '<script>javascript:alert("Berhasil ditambahkan!");window.location = window.location.href;</script>';
			}
			if (isset($_POST['submit_bahasa'])) {
			  $this->dm->add_riwayat_bahasa_by_operator($id_pegawai);
			  echo '<script>javascript:alert("Berhasil ditambahkan!");window.location = window.location.href;</script>';
			}
			if (isset($_POST['submit_bahasa_asing'])) {
			  $this->dm->add_riwayat_bahasa_asing_by_operator($id_pegawai);
			  echo '<script>javascript:alert("Berhasil ditambahkan!");window.location = window.location.href;</script>';
			}
			if (isset($_POST['submit_pernikahan'])) {
			  $this->dm->add_riwayat_pernikahan_by_operator($id_pegawai);
			  echo '<script>javascript:alert("Berhasil ditambahkan!");window.location = window.location.href;</script>';
			}
			if (isset($_POST['submit_anak'])) {
			  $this->dm->add_riwayat_anak_by_operator($id_pegawai);
			  echo '<script>javascript:alert("Berhasil ditambahkan!");window.location = window.location.href;</script>';
			}
			if (isset($_POST['submit_orangtua'])) {
			  $this->dm->add_riwayat_orangtua_by_operator($id_pegawai);
			  echo '<script>javascript:alert("Berhasil ditambahkan!");window.location = window.location.href;</script>';
			}
			if (isset($_POST['submit_mertua'])) {
			  $this->dm->add_riwayat_mertua_by_operator($id_pegawai);
			  echo '<script>javascript:alert("Berhasil ditambahkan!");window.location = window.location.href;</script>';
			}

			//UPDATE
			if (isset($_POST['update_master_pegawai'])) {
				$nip = $this->input->post('nip');
				$this->dm->update_master_pegawai_by_nip($nip);
				echo '<script>javascript:alert("Berhasil diupdate!");window.location = window.location.href;</script>';
			}

			//verif
			if (isset($_POST['verif_pangkat'])) {
			  $id_pangkat = $this->input->post('id_pangkat');
			  $this->dm->verif_riwayat_pangkat_by_operator($id_pangkat);
			  echo '<script>window.location = window.location.href;</script>';
			}
			if (isset($_POST['verif_jabatan'])) {
			  $id_jabatan = $this->input->post('id_jabatan');
			  $this->dm->verif_riwayat_jabatan_by_operator($id_jabatan);
			  echo '<script>window.location = window.location.href;</script>';
			}
			if (isset($_POST['verif_pendidikan'])) {
			  $id_pendidikan = $this->input->post('id_pendidikan');
			  $this->dm->verif_riwayat_pendidikan_by_operator($id_pendidikan);
			  echo '<script>window.location = window.location.href;</script>';
			}
			if (isset($_POST['verif_diklat'])) {
			  $id_diklat = $this->input->post('id_diklat');
			  $this->dm->verif_riwayat_diklat_by_operator($id_diklat);
			  echo '<script>window.location = window.location.href;</script>';
			}
			if (isset($_POST['verif_penataran'])) {
			  $id_penataran = $this->input->post('id_penataran');
			  $this->dm->verif_riwayat_penataran_by_operator($id_penataran);
			  echo '<script>window.location = window.location.href;</script>';
			}
			if (isset($_POST['verif_seminar'])) {
			  $id_seminar = $this->input->post('id_seminar');
			  $this->dm->verif_riwayat_seminar_by_operator($id_seminar);
			  echo '<script>window.location = window.location.href;</script>';
			}
			if (isset($_POST['verif_kursus'])) {
			  $id_kursus = $this->input->post('id_kursus');
			  $this->dm->verif_riwayat_kursus_by_operator($id_kursus);
			  echo '<script>window.location = window.location.href;</script>';
			}
			if (isset($_POST['verif_unit_kerja'])) {
			  $id_unit_kerja = $this->input->post('id_unit_kerja');
			  $this->dm->verif_riwayat_unit_kerja_by_operator($id_unit_kerja);
			  echo '<script>window.location = window.location.href;</script>';
			}
			if (isset($_POST['verif_penghargaan'])) {
			  $id_penghargaan = $this->input->post('id_penghargaan');
			  $this->dm->verif_riwayat_penghargaan_by_operator($id_penghargaan);
			  echo '<script>window.location = window.location.href;</script>';
			}
			if (isset($_POST['verif_penugasan'])) {
			  $id_penugasan = $this->input->post('id_penugasan');
			  $this->dm->verif_riwayat_penugasan_by_operator($id_penugasan);
			  echo '<script>window.location = window.location.href;</script>';
			}
			if (isset($_POST['verif_cuti'])) {
			  $id_cuti = $this->input->post('id_cuti');
			  $this->dm->verif_riwayat_cuti_by_operator($id_cuti);
			  echo '<script>window.location = window.location.href;</script>';
			}
			if (isset($_POST['verif_hukuman'])) {
			  $id_hukuman = $this->input->post('id_hukuman');
			  $this->dm->verif_riwayat_hukuman_by_operator($id_hukuman);
			  echo '<script>window.location = window.location.href;</script>';
			}
			if (isset($_POST['verif_bahasa'])) {
			  $id_bahasa = $this->input->post('id_bahasa');
			  $this->dm->verif_riwayat_bahasa_by_operator($id_bahasa);
			  echo '<script>window.location = window.location.href;</script>';
			}
			if (isset($_POST['verif_bahasa_asing'])) {
			  $id_bahasa_asing = $this->input->post('id_bahasa_asing');
			  $this->dm->verif_riwayat_bahasa_asing_by_operator($id_bahasa_asing);
			  echo '<script>window.location = window.location.href;</script>';
			}
			if (isset($_POST['verif_pernikahan'])) {
			  $id_pernikahan = $this->input->post('id_pernikahan');
			  $this->dm->verif_riwayat_pernikahan_by_operator($id_pernikahan);
			  echo '<script>window.location = window.location.href;</script>';
			}
			if (isset($_POST['verif_anak'])) {
			  $id_anak = $this->input->post('id_anak');
			  $this->dm->verif_riwayat_anak_by_operator($id_anak);
			  echo '<script>window.location = window.location.href;</script>';
			}
			if (isset($_POST['verif_orangtua'])) {
			  $id_orangtua = $this->input->post('id_orangtua');
			  $this->dm->verif_riwayat_orangtua_by_operator($id_orangtua);
			  echo '<script>window.location = window.location.href;</script>';
			}
			if (isset($_POST['verif_mertua'])) {
			  $id_mertua = $this->input->post('id_mertua');
			  $this->dm->verif_riwayat_mertua_by_operator($id_mertua);
			  echo '<script>window.location = window.location.href;</script>';
			}

			//unverif
			if (isset($_POST['unverif_pangkat'])) {
			  $id_pangkat = $this->input->post('id_pangkat');
			  $this->dm->unverif_riwayat_pangkat_by_operator($id_pangkat);
			  echo '<script>window.location = window.location.href;</script>';
			}
			if (isset($_POST['unverif_jabatan'])) {
			  $id_jabatan = $this->input->post('id_jabatan');
			  $this->dm->unverif_riwayat_jabatan_by_operator($id_jabatan);
			  echo '<script>window.location = window.location.href;</script>';
			}
			if (isset($_POST['unverif_pendidikan'])) {
			  $id_pendidikan = $this->input->post('id_pendidikan');
			  $this->dm->unverif_riwayat_pendidikan_by_operator($id_pendidikan);
			  echo '<script>window.location = window.location.href;</script>';
			}
			if (isset($_POST['unverif_diklat'])) {
			  $id_diklat = $this->input->post('id_diklat');
			  $this->dm->unverif_riwayat_diklat_by_operator($id_diklat);
			  echo '<script>window.location = window.location.href;</script>';
			}
			if (isset($_POST['unverif_penataran'])) {
			  $id_penataran = $this->input->post('id_penataran');
			  $this->dm->unverif_riwayat_penataran_by_operator($id_penataran);
			  echo '<script>window.location = window.location.href;</script>';
			}
			if (isset($_POST['unverif_seminar'])) {
			  $id_seminar = $this->input->post('id_seminar');
			  $this->dm->unverif_riwayat_seminar_by_operator($id_seminar);
			  echo '<script>window.location = window.location.href;</script>';
			}
			if (isset($_POST['unverif_kursus'])) {
			  $id_kursus = $this->input->post('id_kursus');
			  $this->dm->unverif_riwayat_kursus_by_operator($id_kursus);
			  echo '<script>window.location = window.location.href;</script>';
			}
			if (isset($_POST['unverif_unit_kerja'])) {
			  $id_unit_kerja = $this->input->post('id_unit_kerja');
			  $this->dm->unverif_riwayat_unit_kerja_by_operator($id_unit_kerja);
			  echo '<script>window.location = window.location.href;</script>';
			}
			if (isset($_POST['unverif_penghargaan'])) {
			  $id_penghargaan = $this->input->post('id_penghargaan');
			  $this->dm->unverif_riwayat_penghargaan_by_operator($id_penghargaan);
			  echo '<script>window.location = window.location.href;</script>';
			}
			if (isset($_POST['unverif_penugasan'])) {
			  $id_penugasan = $this->input->post('id_penugasan');
			  $this->dm->unverif_riwayat_penugasan_by_operator($id_penugasan);
			  echo '<script>window.location = window.location.href;</script>';
			}
			if (isset($_POST['unverif_cuti'])) {
			  $id_cuti = $this->input->post('id_cuti');
			  $this->dm->unverif_riwayat_cuti_by_operator($id_cuti);
			  echo '<script>window.location = window.location.href;</script>';
			}
			if (isset($_POST['unverif_hukuman'])) {
			  $id_hukuman = $this->input->post('id_hukuman');
			  $this->dm->unverif_riwayat_hukuman_by_operator($id_hukuman);
			  echo '<script>window.location = window.location.href;</script>';
			}
			if (isset($_POST['unverif_bahasa'])) {
			  $id_bahasa = $this->input->post('id_bahasa');
			  $this->dm->unverif_riwayat_bahasa_by_operator($id_bahasa);
			  echo '<script>window.location = window.location.href;</script>';
			}
			if (isset($_POST['unverif_bahasa_asing'])) {
			  $id_bahasa_asing = $this->input->post('id_bahasa_asing');
			  $this->dm->unverif_riwayat_bahasa_asing_by_operator($id_bahasa_asing);
			  echo '<script>window.location = window.location.href;</script>';
			}
			if (isset($_POST['unverif_pernikahan'])) {
			  $id_pernikahan = $this->input->post('id_pernikahan');
			  $this->dm->unverif_riwayat_pernikahan_by_operator($id_pernikahan);
			  echo '<script>window.location = window.location.href;</script>';
			}
			if (isset($_POST['unverif_anak'])) {
			  $id_anak = $this->input->post('id_anak');
			  $this->dm->unverif_riwayat_anak_by_operator($id_anak);
			  echo '<script>window.location = window.location.href;</script>';
			}
			if (isset($_POST['unverif_orangtua'])) {
			  $id_orangtua = $this->input->post('id_orangtua');
			  $this->dm->unverif_riwayat_orangtua_by_operator($id_orangtua);
			  echo '<script>window.location = window.location.href;</script>';
			}
			if (isset($_POST['unverif_mertua'])) {
			  $id_mertua = $this->input->post('id_mertua');
			  $this->dm->unverif_riwayat_mertua_by_operator($id_mertua);
			  echo '<script>window.location = window.location.href;</script>';
			}

			//catat
			if (isset($_POST['catat_pangkat'])) {
			  $id_pangkat = $this->input->post('id_pangkat');
			  $this->dm->catat_riwayat_pangkat_by_operator($id_pangkat);
			  echo '<script>javascript:alert("Catatan berhasil dikirim!");window.location = window.location.href;</script>';
			}
			if (isset($_POST['catat_jabatan'])) {
			  $id_jabatan = $this->input->post('id_jabatan');
			  $this->dm->catat_riwayat_jabatan_by_operator($id_jabatan);
			  echo '<script>javascript:alert("Catatan berhasil dikirim!");window.location = window.location.href;</script>';
			}
			if (isset($_POST['catat_pendidikan'])) {
			  $id_pendidikan = $this->input->post('id_pendidikan');
			  $this->dm->catat_riwayat_pendidikan_by_operator($id_pendidikan);
			  echo '<script>javascript:alert("Catatan berhasil dikirim!");window.location = window.location.href;</script>';
			}
			if (isset($_POST['catat_diklat'])) {
			  $id_diklat = $this->input->post('id_diklat');
			  $this->dm->catat_riwayat_diklat_by_operator($id_diklat);
			  echo '<script>javascript:alert("Catatan berhasil dikirim!");window.location = window.location.href;</script>';
			}
			if (isset($_POST['catat_penataran'])) {
			  $id_penataran = $this->input->post('id_penataran');
			  $this->dm->catat_riwayat_penataran_by_operator($id_penataran);
			  echo '<script>javascript:alert("Catatan berhasil dikirim!");window.location = window.location.href;</script>';
			}
			if (isset($_POST['catat_seminar'])) {
			  $id_seminar = $this->input->post('id_seminar');
			  $this->dm->catat_riwayat_seminar_by_operator($id_seminar);
			  echo '<script>javascript:alert("Catatan berhasil dikirim!");window.location = window.location.href;</script>';
			}
			if (isset($_POST['catat_kursus'])) {
			  $id_kursus = $this->input->post('id_kursus');
			  $this->dm->catat_riwayat_kursus_by_operator($id_kursus);
			  echo '<script>javascript:alert("Catatan berhasil dikirim!");window.location = window.location.href;</script>';
			}
			if (isset($_POST['catat_unit_kerja'])) {
			  $id_unit_kerja = $this->input->post('id_unit_kerja');
			  $this->dm->catat_riwayat_unit_kerja_by_operator($id_unit_kerja);
			  echo '<script>javascript:alert("Catatan berhasil dikirim!");window.location = window.location.href;</script>';
			}
			if (isset($_POST['catat_penghargaan'])) {
			  $id_penghargaan = $this->input->post('id_penghargaan');
			  $this->dm->catat_riwayat_penghargaan_by_operator($id_penghargaan);
			  echo '<script>javascript:alert("Catatan berhasil dikirim!");window.location = window.location.href;</script>';
			}
			if (isset($_POST['catat_penugasan'])) {
			  $id_penugasan = $this->input->post('id_penugasan');
			  $this->dm->catat_riwayat_penugasan_by_operator($id_penugasan);
			  echo '<script>javascript:alert("Catatan berhasil dikirim!");window.location = window.location.href;</script>';
			}
			if (isset($_POST['catat_cuti'])) {
			  $id_cuti = $this->input->post('id_cuti');
			  $this->dm->catat_riwayat_cuti_by_operator($id_cuti);
			  echo '<script>javascript:alert("Catatan berhasil dikirim!");window.location = window.location.href;</script>';
			}
			if (isset($_POST['catat_hukuman'])) {
			  $id_hukuman = $this->input->post('id_hukuman');
			  $this->dm->catat_riwayat_hukuman_by_operator($id_hukuman);
			  echo '<script>javascript:alert("Catatan berhasil dikirim!");window.location = window.location.href;</script>';
			}
			if (isset($_POST['catat_bahasa'])) {
			  $id_bahasa = $this->input->post('id_bahasa');
			  $this->dm->catat_riwayat_bahasa_by_operator($id_bahasa);
			  echo '<script>javascript:alert("Catatan berhasil dikirim!");window.location = window.location.href;</script>';
			}
			if (isset($_POST['catat_bahasa_asing'])) {
			  $id_bahasa_asing = $this->input->post('id_bahasa_asing');
			  $this->dm->catat_riwayat_bahasa_asing_by_operator($id_bahasa_asing);
			  echo '<script>javascript:alert("Catatan berhasil dikirim!");window.location = window.location.href;</script>';
			}
			if (isset($_POST['catat_pernikahan'])) {
			  $id_pernikahan = $this->input->post('id_pernikahan');
			  $this->dm->catat_riwayat_pernikahan_by_operator($id_pernikahan);
			  echo '<script>javascript:alert("Catatan berhasil dikirim!");window.location = window.location.href;</script>';
			}
			if (isset($_POST['catat_anak'])) {
			  $id_anak = $this->input->post('id_anak');
			  $this->dm->catat_riwayat_anak_by_operator($id_anak);
			  echo '<script>javascript:alert("Catatan berhasil dikirim!");window.location = window.location.href;</script>';
			}
			if (isset($_POST['catat_orangtua'])) {
			  $id_orangtua = $this->input->post('id_orangtua');
			  $this->dm->catat_riwayat_orangtua_by_operator($id_orangtua);
			  echo '<script>javascript:alert("Catatan berhasil dikirim!");window.location = window.location.href;</script>';
			}
			if (isset($_POST['catat_mertua'])) {
			  $id_mertua = $this->input->post('id_mertua');
			  $this->dm->catat_riwayat_mertua_by_operator($id_mertua);
			  echo '<script>javascript:alert("Catatan berhasil dikirim!");window.location = window.location.href;</script>';
			}

			//DELETE
			if (isset($_POST['delete_pangkat'])) {
				$id_pangkat = $this->input->post('id_pangkat');
				$this->dm->delete_riwayat_pangkat_by_id($id_pangkat, $id_pegawai);
				echo '<script>javascript:alert("Berhasil dihapus!");window.location = window.location.href;</script>';
			}
			if (isset($_POST['delete_jabatan'])) {
				$id_jabatan = $this->input->post('id_jabatan');
				$this->dm->delete_riwayat_jabatan_by_id($id_jabatan, $id_pegawai);
				echo '<script>javascript:alert("Berhasil dihapus!");window.location = window.location.href;</script>';
			}
			if (isset($_POST['delete_pendidikan'])) {
				$id_pendidikan = $this->input->post('id_pendidikan');
				$this->dm->delete_riwayat_pendidikan_by_id($id_pendidikan, $id_pegawai);
				echo '<script>javascript:alert("Berhasil dihapus!");window.location = window.location.href;</script>';
			}
			if (isset($_POST['delete_diklat'])) {
				$id_diklat = $this->input->post('id_diklat');
				$this->dm->delete_riwayat_diklat_by_id($id_diklat, $id_pegawai);
				echo '<script>javascript:alert("Berhasil dihapus!");window.location = window.location.href;</script>';
			}
			if (isset($_POST['delete_penataran'])) {
				$id_penataran = $this->input->post('id_penataran');
				$this->dm->delete_riwayat_penataran_by_id($id_penataran, $id_pegawai);
				echo '<script>javascript:alert("Berhasil dihapus!");window.location = window.location.href;</script>';
			}
			if (isset($_POST['delete_seminar'])) {
				$id_seminar = $this->input->post('id_seminar');
				$this->dm->delete_riwayat_seminar_by_id($id_seminar, $id_pegawai);
				echo '<script>javascript:alert("Berhasil dihapus!");window.location = window.location.href;</script>';
			}
			if (isset($_POST['delete_kursus'])) {
				$id_kursus = $this->input->post('id_kursus');
				$this->dm->delete_riwayat_kursus_by_id($id_kursus, $id_pegawai);
				echo '<script>javascript:alert("Berhasil dihapus!");window.location = window.location.href;</script>';
			}
			if (isset($_POST['delete_unit_kerja'])) {
				$id_unit_kerja = $this->input->post('id_unit_kerja');
				$this->dm->delete_riwayat_unit_kerja_by_id($id_unit_kerja, $id_pegawai);
				echo '<script>javascript:alert("Berhasil dihapus!");window.location = window.location.href;</script>';
			}
			if (isset($_POST['delete_penghargaan'])) {
				$id_penghargaan = $this->input->post('id_penghargaan');
				$this->dm->delete_riwayat_penghargaan_by_id($id_penghargaan, $id_pegawai);
				echo '<script>javascript:alert("Berhasil dihapus!");window.location = window.location.href;</script>';
			}
			if (isset($_POST['delete_penugasan'])) {
				$id_penugasan = $this->input->post('id_penugasan');
				$this->dm->delete_riwayat_penugasan_by_id($id_penugasan, $id_pegawai);
				echo '<script>javascript:alert("Berhasil dihapus!");window.location = window.location.href;</script>';
			}
			if (isset($_POST['delete_cuti'])) {
				$id_cuti = $this->input->post('id_cuti');
				$this->dm->delete_riwayat_cuti_by_id($id_cuti, $id_pegawai);
				echo '<script>javascript:alert("Berhasil dihapus!");window.location = window.location.href;</script>';
			}
			if (isset($_POST['delete_hukuman'])) {
				$id_hukuman = $this->input->post('id_hukuman');
				$this->dm->delete_riwayat_hukuman_by_id($id_hukuman, $id_pegawai);
				echo '<script>javascript:alert("Berhasil dihapus!");window.location = window.location.href;</script>';
			}
			if (isset($_POST['delete_bahasa'])) {
				$id_bahasa = $this->input->post('id_bahasa');
				$this->dm->delete_riwayat_bahasa_by_id($id_bahasa, $id_pegawai);
				echo '<script>javascript:alert("Berhasil dihapus!");window.location = window.location.href;</script>';
			}
			if (isset($_POST['delete_bahasa_asing'])) {
				$id_bahasa_asing = $this->input->post('id_bahasa_asing');
				$this->dm->delete_riwayat_bahasa_asing_by_id($id_bahasa_asing, $id_pegawai);
				echo '<script>javascript:alert("Berhasil dihapus!");window.location = window.location.href;</script>';
			}
			if (isset($_POST['delete_pernikahan'])) {
				$id_pernikahan = $this->input->post('id_pernikahan');
				$this->dm->delete_riwayat_pernikahan_by_id($id_pernikahan, $id_pegawai);
				echo '<script>javascript:alert("Berhasil dihapus!");window.location = window.location.href;</script>';
			}
			if (isset($_POST['delete_anak'])) {
				$id_anak = $this->input->post('id_anak');
				$this->dm->delete_riwayat_anak_by_id($id_anak, $id_pegawai);
				echo '<script>javascript:alert("Berhasil dihapus!");window.location = window.location.href;</script>';
			}
			if (isset($_POST['delete_orangtua'])) {
				$id_orangtua = $this->input->post('id_orangtua');
				$this->dm->delete_riwayat_orangtua_by_id($id_orangtua, $id_pegawai);
				echo '<script>javascript:alert("Berhasil dihapus!");window.location = window.location.href;</script>';
			}
			if (isset($_POST['delete_mertua'])) {
				$id_mertua = $this->input->post('id_mertua');
				$this->dm->delete_riwayat_mertua_by_id($id_mertua, $id_pegawai);
				echo '<script>javascript:alert("Berhasil dihapus!");window.location = window.location.href;</script>';
			}
			$this->load->view('admin/index',$data);

		}
		else
		{
			redirect('admin');
		}
	}

	public function verifikasi_data_pegawai($id_pegawai=0)
	{
		if ($this->user_id && !empty($id_pegawai) && $id_pegawai>0)
		{

			$data['title']		= "Master Pegawai - Admin ";
			$data['content']	= "master_pegawai/verifikasi_data_pegawai" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu']		= 'master_pegawai';

			$this->load->view('admin/index',$data);

		}
		else
		{
			redirect('admin');
		}
	}

}
?>
