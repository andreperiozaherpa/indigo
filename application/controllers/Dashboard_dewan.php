<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_dewan extends CI_Controller {
	public $user_id;

	public function __construct(){
		parent ::__construct();
		$this->user_id = $this->session->userdata('user_id');
		$this->load->model('user_model');
		$this->load->model('logs_model');
		$this->load->model('ref_skpd_model');
		$this->load->model('master_pegawai_model');
		$this->user_model->user_id = $this->user_id;
		$this->user_model->set_user_by_user_id();
		$this->load->model('dashboard_model', 'dm');
		$this->load->model('kegiatan_model', 'km');
		$this->load->model('kegiatan_personal_model', 'kpm');
		$this->load->model('realisasi_kegiatan_model', 'rkm');
		$this->load->model('pegawai_model');
		$this->load->model('talenta/peringkat_talent_model');
		$this->load->model('tpp/tpp_perhitungan_model');
		$this->load->model('tpp/tpp_model');
		$this->user_picture = $this->user_model->user_picture;
		$this->foto_pegawai = $this->user_model->foto_pegawai;
		$this->full_name	= $this->user_model->full_name;
		$this->user_level	= $this->user_model->level;
		$this->id_pegawai	= $this->user_model->id_pegawai;
		$this->id_skpd	= $this->user_model->id_skpd;
	}

	public function index()
	{
		if ($this->user_id)
		{
			$data['title']		= "User";
			$data['content']	= "dashboard_dewan/index" ;
			$data['user_picture'] = $this->user_picture;
			$data['foto_pegawai'] = $this->foto_pegawai;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['user_id'] = $this->id_pegawai;
			$data['id_skpd'] = $this->id_skpd;
			$data['active_menu'] = "dashboard_dewan";

			$data['id_user'] = $this->user_id;
			$id = $this->user_id;
			$id_pegawai = $this->id_pegawai;
			$id_skpd = $this->id_skpd;
			$user = $this->user_model->get_user_by_id_new();
			$where = $user->id_ketersediaan;
			$data['kegiatan'] = $this->km->get_pekerjaan_by_user($id_pegawai);
			$data['total_surat_masuk'] = $this->dm->get_total_surat_masuk($id_pegawai);
			// print_r($data['total_surat_masuk']);
			// die;
			// $data['total_surat_masuk'] = 1;
			$data['total_catatan'] = $this->dm->get_total_catatan($id_pegawai);
			$data['total_kegiatan'] = $this->dm->get_total_kegiatan($id_pegawai);
			$data['kegiatan_personal'] = $this->kpm->get_all_by_id($id_pegawai);
			$data['total_agenda'] = $this->dm->get_total_agenda($id_pegawai);
			$data['agenda_umum'] = $this->dm->get_agenda_umum($id_skpd);
			$data['agenda_pribadi'] = $this->dm->get_agenda_pribadi_by($id_pegawai);
			$data['data_by_bkd'] = $this->dm->get_data_bkd($id_pegawai);
			$data['pengumuman'] = $this->dm->get_pengumuman($id_pegawai, $id_skpd);
			$data['user'] = $this->user_model->get_user_by_id_new();
			// print_r($data['user']);die;
			// print_r($data['user']);die;
			$tahun = date('Y');
			$data['tahun_sekarang'] = $tahun;
			$data['details_pegawai'] = $this->pegawai_model->get_by_id($id_pegawai);
			$data['pegawai'] = $this->master_pegawai_model->get_by_id($this->session->userdata('id_pegawai'));
			$id_unit_kerja = $data['details_pegawai']->id_unit_kerja;
			$this->load->model('kinerja_pegawai_model');
			$data['iku_ss'] = $this->kinerja_pegawai_model->get_kinerja('ss',$data['details_pegawai']->nip);
			$data['iku_sp'] = $this->kinerja_pegawai_model->get_kinerja('sp',$data['details_pegawai']->nip);
			$data['iku_sk'] = $this->kinerja_pegawai_model->get_kinerja('sk',$data['details_pegawai']->nip);
			$data['ketersediaan'] = $this->dm->get_ketersediaan($where);
			$data['logs']	= $this->logs_model->get_some_id($id);

			$data['talent'] = $this->peringkat_talent_model->get_by_id_pegawai($id_pegawai);

			$data['tpp_pegawai'] = $this->tpp_perhitungan_model->get_tpp($this->session->userdata('id_pegawai'));

			$this->load->view('admin/index',$data);

		}
		else
		{
			redirect('admin');
		}
	}

	public function operator(){
		$data['title']		= "Dashboard Operator";
		$data['content']	= "dashboard_user/operator" ;
		$data['user_picture'] = $this->user_picture;
		$data['foto_pegawai'] = $this->foto_pegawai;
		$data['full_name']		= $this->full_name;
		$data['user_level']		= $this->user_level;
		$data['active_menu'] = "operator";
		$data['id_user'] = $this->user_id;
		$id_skpd = $this->session->userdata('kd_skpd');
		$data['skpd'] = $this->ref_skpd_model->get_by_id($id_skpd);
		$data['jml_pegawai'] = $this->master_pegawai_model->get_jml_by_id_skpd($id_skpd);
		$data['jml_r'] = $this->master_pegawai_model->get_registered_by_id_skpd($id_skpd);
		$data['jml_nr'] = $this->master_pegawai_model->get_not_registered_by_id_skpd($id_skpd);
		$this->load->view('admin/index',$data);

	}

	public function reset_token($id_pegawai){
		$this->load->model('user_model');
		$this->load->model('pegawai_model');
		$this->pegawai_model->id_pegawai = $id_pegawai;
		$detail = $this->pegawai_model->get_by_id();
		$id_user = $detail->id_user;
		$this->user_model->reset_token($id_user);
		echo json_encode(array("status" => TRUE));
	}


	public function updateKetersediaan($id){

		$id = $this->user_id;
		if ($id) {
			if (isset($_POST['ketersediaan'])) {
				$this->dm->update_ketersediaan($id);
				$this->session->set_flashdata('msg', '<div class="alert alert-success" role="alert">Ketersediaan Berhasil Diubah !</div>');
				redirect('dashboard_user');
			}else{
				redirect();
			}
		}else{
			redirect('admin');
		}

	}

	public function updatePassword($id,$level='user'){
		$id = $this->user_id;
		if ($id) {
			$this->form_validation->set_rules('old_password', 'Password Lama', 'trim|required|xss_clean');
			$this->form_validation->set_rules('n_password', 'Password Baru', 'trim|required|xss_clean');
			$this->form_validation->set_rules('cn_password', 'Konfirmasi Password Baru', 'trim|required|matches[n_password]|xss_clean');
			if ($this->form_validation->run() == true) {
				if (isset($_POST['tombol_update'])) {
					$cek_password = $this->dm->cek_password($id,$this->input->post('old_password'));
					if ($cek_password == 1) {
						$this->dm->update_password($id);
						$this->session->set_flashdata('msg', '<div class="alert alert-success" role="alert">Password Berhasil Diubah !</div>');
						if($level=='user'){
							redirect('dashboard_user');
						}else{
							redirect('dashboard_user/operator');

						}
					}else{
						$this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert">Password Lama Anda Salah !</div>');
						if($level=='user'){
							redirect('dashboard_user');
						}else{
							redirect('dashboard_user/operator');

						}
					}
				}
			}elseif($this->form_validation->run() == false) {
				$this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert">Konfirmasi Password Tidak Cocok</div>');
				if($level=='user'){
					redirect('dashboard_user');
				}else{
					redirect('dashboard_user/operator');

				}
			}
		}else{
			redirect('admin');
		}
	}

	public function details_kepegawaian()
	{
		redirect('simpeg/my_profile');
		if ($this->user_id)
		{
			$data['title']		= "Details User";
			$data['content']	= "dashboard_user/view" ;
			$data['user_picture'] = $this->user_picture;
			$data['foto_pegawai'] = $this->foto_pegawai;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['user_id'] = $this->id_pegawai;
			$data['active_menu'] = "dashboard_user";

			$id_pegawai  = $this->id_pegawai;
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
			$data['jenisbahasa']= $this->pegawai_model->get_jenisbahasa();
			$data['jenisbahasa_asing']= $this->pegawai_model->get_jenisbahasa_asing();
			$data['data_by_bkd'] = $this->dm->get_data_bkd($id_pegawai);
			//CREATE
			if (isset($_POST['submit_pangkat'])) {
				$this->dm->add_riwayat_pangkat_by_id($id_pegawai);
				echo '<script>javascript:alert("Berhasil ditambahkan!");window.location = window.location.href;</script>';
			}
			if (isset($_POST['submit_jabatan'])) {
				$this->dm->add_riwayat_jabatan_by_id($id_pegawai);
				echo '<script>javascript:alert("Berhasil ditambahkan!");window.location = window.location.href;</script>';
			}
			if (isset($_POST['submit_pendidikan'])) {
				$this->dm->add_riwayat_pendidikan_by_id($id_pegawai);
				echo '<script>javascript:alert("Berhasil ditambahkan!");window.location = window.location.href;</script>';
			}
			if (isset($_POST['submit_diklat'])) {
				$this->dm->add_riwayat_diklat_by_id($id_pegawai);
				echo '<script>javascript:alert("Berhasil ditambahkan!");window.location = window.location.href;</script>';
			}
			if (isset($_POST['submit_penataran'])) {
				$this->dm->add_riwayat_penataran_by_id($id_pegawai);
				echo '<script>javascript:alert("Berhasil ditambahkan!");window.location = window.location.href;</script>';
			}
			if (isset($_POST['submit_seminar'])) {
				$this->dm->add_riwayat_seminar_by_id($id_pegawai);
				echo '<script>javascript:alert("Berhasil ditambahkan!");window.location = window.location.href;</script>';
			}
			if (isset($_POST['submit_kursus'])) {
				$this->dm->add_riwayat_kursus_by_id($id_pegawai);
				echo '<script>javascript:alert("Berhasil ditambahkan!");window.location = window.location.href;</script>';
			}
			if (isset($_POST['submit_unit_kerja'])) {
				$this->dm->add_riwayat_unit_kerja_by_id($id_pegawai);
				echo '<script>javascript:alert("Berhasil ditambahkan!");window.location = window.location.href;</script>';
			}
			if (isset($_POST['submit_penghargaan'])) {
				$this->dm->add_riwayat_penghargaan_by_id($id_pegawai);
				echo '<script>javascript:alert("Berhasil ditambahkan!");window.location = window.location.href;</script>';
			}
			if (isset($_POST['submit_penugasan'])) {
				$this->dm->add_riwayat_penugasan_by_id($id_pegawai);
				echo '<script>javascript:alert("Berhasil ditambahkan!");window.location = window.location.href;</script>';
			}
			if (isset($_POST['submit_cuti'])) {
				$this->dm->add_riwayat_cuti_by_id($id_pegawai);
				echo '<script>javascript:alert("Berhasil ditambahkan!");window.location = window.location.href;</script>';
			}
			if (isset($_POST['submit_hukuman'])) {
				$this->dm->add_riwayat_hukuman_by_id($id_pegawai);
				echo '<script>javascript:alert("Berhasil ditambahkan!");window.location = window.location.href;</script>';
			}
			if (isset($_POST['submit_bahasa'])) {
				$this->dm->add_riwayat_bahasa_by_id($id_pegawai);
				echo '<script>javascript:alert("Berhasil ditambahkan!");window.location = window.location.href;</script>';
			}
			if (isset($_POST['submit_bahasa_asing'])) {
				$this->dm->add_riwayat_bahasa_asing_by_id($id_pegawai);
				echo '<script>javascript:alert("Berhasil ditambahkan!");window.location = window.location.href;</script>';
			}
			if (isset($_POST['submit_pernikahan'])) {
				$this->dm->add_riwayat_pernikahan_by_id($id_pegawai);
				echo '<script>javascript:alert("Berhasil ditambahkan!");window.location = window.location.href;</script>';
			}
			if (isset($_POST['submit_anak'])) {
				$this->dm->add_riwayat_anak_by_id($id_pegawai);
				echo '<script>javascript:alert("Berhasil ditambahkan!");window.location = window.location.href;</script>';
			}
			if (isset($_POST['submit_orangtua'])) {
				$this->dm->add_riwayat_orangtua_by_id($id_pegawai);
				echo '<script>javascript:alert("Berhasil ditambahkan!");window.location = window.location.href;</script>';
			}
			if (isset($_POST['submit_mertua'])) {
				$this->dm->add_riwayat_mertua_by_id($id_pegawai);
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
			  $this->dm->verif_riwayat_pangkat_by_id($id_pangkat);
			  echo '<script>window.location = window.location.href;</script>';
			}
			if (isset($_POST['verif_jabatan'])) {
			  $id_jabatan = $this->input->post('id_jabatan');
			  $this->dm->verif_riwayat_jabatan_by_id($id_jabatan);
			  echo '<script>window.location = window.location.href;</script>';
			}
			if (isset($_POST['verif_pendidikan'])) {
			  $id_pendidikan = $this->input->post('id_pendidikan');
			  $this->dm->verif_riwayat_pendidikan_by_id($id_pendidikan);
			  echo '<script>window.location = window.location.href;</script>';
			}
			if (isset($_POST['verif_diklat'])) {
			  $id_diklat = $this->input->post('id_diklat');
			  $this->dm->verif_riwayat_diklat_by_id($id_diklat);
			  echo '<script>window.location = window.location.href;</script>';
			}
			if (isset($_POST['verif_penataran'])) {
			  $id_penataran = $this->input->post('id_penataran');
			  $this->dm->verif_riwayat_penataran_by_id($id_penataran);
			  echo '<script>window.location = window.location.href;</script>';
			}
			if (isset($_POST['verif_seminar'])) {
			  $id_seminar = $this->input->post('id_seminar');
			  $this->dm->verif_riwayat_seminar_by_id($id_seminar);
			  echo '<script>window.location = window.location.href;</script>';
			}
			if (isset($_POST['verif_kursus'])) {
			  $id_kursus = $this->input->post('id_kursus');
			  $this->dm->verif_riwayat_kursus_by_id($id_kursus);
			  echo '<script>window.location = window.location.href;</script>';
			}
			if (isset($_POST['verif_unit_kerja'])) {
			  $id_unit_kerja = $this->input->post('id_unit_kerja');
			  $this->dm->verif_riwayat_unit_kerja_by_id($id_unit_kerja);
			  echo '<script>window.location = window.location.href;</script>';
			}
			if (isset($_POST['verif_penghargaan'])) {
			  $id_penghargaan = $this->input->post('id_penghargaan');
			  $this->dm->verif_riwayat_penghargaan_by_id($id_penghargaan);
			  echo '<script>window.location = window.location.href;</script>';
			}
			if (isset($_POST['verif_penugasan'])) {
			  $id_penugasan = $this->input->post('id_penugasan');
			  $this->dm->verif_riwayat_penugasan_by_id($id_penugasan);
			  echo '<script>window.location = window.location.href;</script>';
			}
			if (isset($_POST['verif_cuti'])) {
			  $id_cuti = $this->input->post('id_cuti');
			  $this->dm->verif_riwayat_cuti_by_id($id_cuti);
			  echo '<script>window.location = window.location.href;</script>';
			}
			if (isset($_POST['verif_hukuman'])) {
			  $id_hukuman = $this->input->post('id_hukuman');
			  $this->dm->verif_riwayat_hukuman_by_id($id_hukuman);
			  echo '<script>window.location = window.location.href;</script>';
			}
			if (isset($_POST['verif_bahasa'])) {
			  $id_bahasa = $this->input->post('id_bahasa');
			  $this->dm->verif_riwayat_bahasa_by_id($id_bahasa);
			  echo '<script>window.location = window.location.href;</script>';
			}
			if (isset($_POST['verif_bahasa_asing'])) {
			  $id_bahasa_asing = $this->input->post('id_bahasa_asing');
			  $this->dm->verif_riwayat_bahasa_asing_by_id($id_bahasa_asing);
			  echo '<script>window.location = window.location.href;</script>';
			}
			if (isset($_POST['verif_pernikahan'])) {
			  $id_pernikahan = $this->input->post('id_pernikahan');
			  $this->dm->verif_riwayat_pernikahan_by_id($id_pernikahan);
			  echo '<script>window.location = window.location.href;</script>';
			}
			if (isset($_POST['verif_anak'])) {
			  $id_anak = $this->input->post('id_anak');
			  $this->dm->verif_riwayat_anak_by_id($id_anak);
			  echo '<script>window.location = window.location.href;</script>';
			}
			if (isset($_POST['verif_orangtua'])) {
			  $id_orangtua = $this->input->post('id_orangtua');
			  $this->dm->verif_riwayat_orangtua_by_id($id_orangtua);
			  echo '<script>window.location = window.location.href;</script>';
			}
			if (isset($_POST['verif_mertua'])) {
			  $id_mertua = $this->input->post('id_mertua');
			  $this->dm->verif_riwayat_mertua_by_id($id_mertua);
			  echo '<script>window.location = window.location.href;</script>';
			}

			//unverif
			if (isset($_POST['unverif_pangkat'])) {
			  $id_pangkat = $this->input->post('id_pangkat');
			  $this->dm->unverif_riwayat_pangkat_by_id($id_pangkat);
			  echo '<script>window.location = window.location.href;</script>';
			}
			if (isset($_POST['unverif_jabatan'])) {
			  $id_jabatan = $this->input->post('id_jabatan');
			  $this->dm->unverif_riwayat_jabatan_by_id($id_jabatan);
			  echo '<script>window.location = window.location.href;</script>';
			}
			if (isset($_POST['unverif_pendidikan'])) {
			  $id_pendidikan = $this->input->post('id_pendidikan');
			  $this->dm->unverif_riwayat_pendidikan_by_id($id_pendidikan);
			  echo '<script>window.location = window.location.href;</script>';
			}
			if (isset($_POST['unverif_diklat'])) {
			  $id_diklat = $this->input->post('id_diklat');
			  $this->dm->unverif_riwayat_diklat_by_id($id_diklat);
			  echo '<script>window.location = window.location.href;</script>';
			}
			if (isset($_POST['unverif_penataran'])) {
			  $id_penataran = $this->input->post('id_penataran');
			  $this->dm->unverif_riwayat_penataran_by_id($id_penataran);
			  echo '<script>window.location = window.location.href;</script>';
			}
			if (isset($_POST['unverif_seminar'])) {
			  $id_seminar = $this->input->post('id_seminar');
			  $this->dm->unverif_riwayat_seminar_by_id($id_seminar);
			  echo '<script>window.location = window.location.href;</script>';
			}
			if (isset($_POST['unverif_kursus'])) {
			  $id_kursus = $this->input->post('id_kursus');
			  $this->dm->unverif_riwayat_kursus_by_id($id_kursus);
			  echo '<script>window.location = window.location.href;</script>';
			}
			if (isset($_POST['unverif_unit_kerja'])) {
			  $id_unit_kerja = $this->input->post('id_unit_kerja');
			  $this->dm->unverif_riwayat_unit_kerja_by_id($id_unit_kerja);
			  echo '<script>window.location = window.location.href;</script>';
			}
			if (isset($_POST['unverif_penghargaan'])) {
			  $id_penghargaan = $this->input->post('id_penghargaan');
			  $this->dm->unverif_riwayat_penghargaan_by_id($id_penghargaan);
			  echo '<script>window.location = window.location.href;</script>';
			}
			if (isset($_POST['unverif_penugasan'])) {
			  $id_penugasan = $this->input->post('id_penugasan');
			  $this->dm->unverif_riwayat_penugasan_by_id($id_penugasan);
			  echo '<script>window.location = window.location.href;</script>';
			}
			if (isset($_POST['unverif_cuti'])) {
			  $id_cuti = $this->input->post('id_cuti');
			  $this->dm->unverif_riwayat_cuti_by_id($id_cuti);
			  echo '<script>window.location = window.location.href;</script>';
			}
			if (isset($_POST['unverif_hukuman'])) {
			  $id_hukuman = $this->input->post('id_hukuman');
			  $this->dm->unverif_riwayat_hukuman_by_id($id_hukuman);
			  echo '<script>window.location = window.location.href;</script>';
			}
			if (isset($_POST['unverif_bahasa'])) {
			  $id_bahasa = $this->input->post('id_bahasa');
			  $this->dm->unverif_riwayat_bahasa_by_id($id_bahasa);
			  echo '<script>window.location = window.location.href;</script>';
			}
			if (isset($_POST['unverif_bahasa_asing'])) {
			  $id_bahasa_asing = $this->input->post('id_bahasa_asing');
			  $this->dm->unverif_riwayat_bahasa_asing_by_id($id_bahasa_asing);
			  echo '<script>window.location = window.location.href;</script>';
			}
			if (isset($_POST['unverif_pernikahan'])) {
			  $id_pernikahan = $this->input->post('id_pernikahan');
			  $this->dm->unverif_riwayat_pernikahan_by_id($id_pernikahan);
			  echo '<script>window.location = window.location.href;</script>';
			}
			if (isset($_POST['unverif_anak'])) {
			  $id_anak = $this->input->post('id_anak');
			  $this->dm->unverif_riwayat_anak_by_id($id_anak);
			  echo '<script>window.location = window.location.href;</script>';
			}
			if (isset($_POST['unverif_orangtua'])) {
			  $id_orangtua = $this->input->post('id_orangtua');
			  $this->dm->unverif_riwayat_orangtua_by_id($id_orangtua);
			  echo '<script>window.location = window.location.href;</script>';
			}
			if (isset($_POST['unverif_mertua'])) {
			  $id_mertua = $this->input->post('id_mertua');
			  $this->dm->unverif_riwayat_mertua_by_id($id_mertua);
			  echo '<script>window.location = window.location.href;</script>';
			}

			//catat
			if (isset($_POST['catat_pangkat'])) {
			  $id_pangkat = $this->input->post('id_pangkat');
			  $this->dm->catat_riwayat_pangkat_by_id($id_pangkat);
			  echo '<script>javascript:alert("Catatan berhasil dikirim!");window.location = window.location.href;</script>';
			}
			if (isset($_POST['catat_jabatan'])) {
			  $id_jabatan = $this->input->post('id_jabatan');
			  $this->dm->catat_riwayat_jabatan_by_id($id_jabatan);
			  echo '<script>javascript:alert("Catatan berhasil dikirim!");window.location = window.location.href;</script>';
			}
			if (isset($_POST['catat_pendidikan'])) {
			  $id_pendidikan = $this->input->post('id_pendidikan');
			  $this->dm->catat_riwayat_pendidikan_by_id($id_pendidikan);
			  echo '<script>javascript:alert("Catatan berhasil dikirim!");window.location = window.location.href;</script>';
			}
			if (isset($_POST['catat_diklat'])) {
			  $id_diklat = $this->input->post('id_diklat');
			  $this->dm->catat_riwayat_diklat_by_id($id_diklat);
			  echo '<script>javascript:alert("Catatan berhasil dikirim!");window.location = window.location.href;</script>';
			}
			if (isset($_POST['catat_penataran'])) {
			  $id_penataran = $this->input->post('id_penataran');
			  $this->dm->catat_riwayat_penataran_by_id($id_penataran);
			  echo '<script>javascript:alert("Catatan berhasil dikirim!");window.location = window.location.href;</script>';
			}
			if (isset($_POST['catat_seminar'])) {
			  $id_seminar = $this->input->post('id_seminar');
			  $this->dm->catat_riwayat_seminar_by_id($id_seminar);
			  echo '<script>javascript:alert("Catatan berhasil dikirim!");window.location = window.location.href;</script>';
			}
			if (isset($_POST['catat_kursus'])) {
			  $id_kursus = $this->input->post('id_kursus');
			  $this->dm->catat_riwayat_kursus_by_id($id_kursus);
			  echo '<script>javascript:alert("Catatan berhasil dikirim!");window.location = window.location.href;</script>';
			}
			if (isset($_POST['catat_unit_kerja'])) {
			  $id_unit_kerja = $this->input->post('id_unit_kerja');
			  $this->dm->catat_riwayat_unit_kerja_by_id($id_unit_kerja);
			  echo '<script>javascript:alert("Catatan berhasil dikirim!");window.location = window.location.href;</script>';
			}
			if (isset($_POST['catat_penghargaan'])) {
			  $id_penghargaan = $this->input->post('id_penghargaan');
			  $this->dm->catat_riwayat_penghargaan_by_id($id_penghargaan);
			  echo '<script>javascript:alert("Catatan berhasil dikirim!");window.location = window.location.href;</script>';
			}
			if (isset($_POST['catat_penugasan'])) {
			  $id_penugasan = $this->input->post('id_penugasan');
			  $this->dm->catat_riwayat_penugasan_by_id($id_penugasan);
			  echo '<script>javascript:alert("Catatan berhasil dikirim!");window.location = window.location.href;</script>';
			}
			if (isset($_POST['catat_cuti'])) {
			  $id_cuti = $this->input->post('id_cuti');
			  $this->dm->catat_riwayat_cuti_by_id($id_cuti);
			  echo '<script>javascript:alert("Catatan berhasil dikirim!");window.location = window.location.href;</script>';
			}
			if (isset($_POST['catat_hukuman'])) {
			  $id_hukuman = $this->input->post('id_hukuman');
			  $this->dm->catat_riwayat_hukuman_by_id($id_hukuman);
			  echo '<script>javascript:alert("Catatan berhasil dikirim!");window.location = window.location.href;</script>';
			}
			if (isset($_POST['catat_bahasa'])) {
			  $id_bahasa = $this->input->post('id_bahasa');
			  $this->dm->catat_riwayat_bahasa_by_id($id_bahasa);
			  echo '<script>javascript:alert("Catatan berhasil dikirim!");window.location = window.location.href;</script>';
			}
			if (isset($_POST['catat_bahasa_asing'])) {
			  $id_bahasa_asing = $this->input->post('id_bahasa_asing');
			  $this->dm->catat_riwayat_bahasa_asing_by_id($id_bahasa_asing);
			  echo '<script>javascript:alert("Catatan berhasil dikirim!");window.location = window.location.href;</script>';
			}
			if (isset($_POST['catat_pernikahan'])) {
			  $id_pernikahan = $this->input->post('id_pernikahan');
			  $this->dm->catat_riwayat_pernikahan_by_id($id_pernikahan);
			  echo '<script>javascript:alert("Catatan berhasil dikirim!");window.location = window.location.href;</script>';
			}
			if (isset($_POST['catat_anak'])) {
			  $id_anak = $this->input->post('id_anak');
			  $this->dm->catat_riwayat_anak_by_id($id_anak);
			  echo '<script>javascript:alert("Catatan berhasil dikirim!");window.location = window.location.href;</script>';
			}
			if (isset($_POST['catat_orangtua'])) {
			  $id_orangtua = $this->input->post('id_orangtua');
			  $this->dm->catat_riwayat_orangtua_by_id($id_orangtua);
			  echo '<script>javascript:alert("Catatan berhasil dikirim!");window.location = window.location.href;</script>';
			}
			if (isset($_POST['catat_mertua'])) {
			  $id_mertua = $this->input->post('id_mertua');
			  $this->dm->catat_riwayat_mertua_by_id($id_mertua);
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

	public function get_kabupaten($parent_id){
		$obj = '<option value="">Pilih</option>';
		$this->load->model('ref_wilayah_model');
		$id = explode("-",$parent_id);
		$data = $this->ref_wilayah_model->get_kabupaten(null,$id[0]);
		foreach($data as $row){
			$obj .= "<option value='".$row->id_kabupaten."'>$row->kabupaten</option>";
		}
		die ($obj);
	}
	public function get_kecamatan($parent_id){
		$obj = '<option value="">Pilih</option>';
		$this->load->model('ref_wilayah_model');
		$id = explode("-",$parent_id);
		$data = $this->ref_wilayah_model->get_kecamatan(null,$id[0]);
		foreach($data as $row){
			$obj .= "<option value='".$row->id_kecamatan."'>$row->kecamatan</option>";
		}
		die ($obj);
	}
	public function get_desa($parent_id){
		$obj = '<option value="">Pilih</option>';
		$this->load->model('ref_wilayah_model');
		$id = explode("-",$parent_id);
		$data = $this->ref_wilayah_model->get_desa(null,$id[0]);
		foreach($data as $row){
			$obj .= "<option value='".$row->id_desa."'>$row->desa</option>";
		}
		die ($obj);
	}

	public function get_log_tpp($bulan,$tahun){
		$id_pegawai = $this->session->userdata('id_pegawai');
		$log = $this->tpp_model->get_log_pegawai($id_pegawai,$bulan,$tahun);
		print_r($log);
	}


}
?>
