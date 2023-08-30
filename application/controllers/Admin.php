<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
	public $user_id;
	public function __construct()
	{
		die;
		parent::__construct();
		$this->user_id = $this->session->userdata('user_id');
		$this->load->model('user_model');
		$this->load->model('bkd_model', 'bm');
		$this->user_model->user_id = $this->user_id;
		$this->user_model->set_user_by_user_id();
		$this->user_picture = $this->user_model->user_picture;
		$this->full_name = $this->user_model->full_name;
		$this->user_level = $this->user_model->level;

		$this->load->helper('form');
		$this->load->library('form_validation');

		$this->load->helper('url');
		$this->load->library('tank_auth');
		$this->load->library('session');
		$this->load->model('tank_auth/users');

		$this->load->helper('text');
		$this->load->helper('typography');
		$this->load->helper('file');

		$this->bulan = array(
			1 => 'Januari',
			2 => 'Februari',
			3 => 'Maret',
			4 => 'April',
			5 => 'Mei',
			6 => 'Juni',
			7 => 'Juli',
			8 => 'Agustus',
			9 => 'September',
			10 => 'Oktober',
			11 => 'Nopember',
			12 => 'Desember',
		);


		if ($this->tank_auth->is_logged_in()) {
			redirect('welcome');
		}

		if ($_SERVER['HTTP_HOST'] == "sakip.sumedangkab.go.id") {
			redirect("https://e-office.sumedangkab.go.id/admin");
		}


		//echo $this->session->userdata('employee_id');exit();

	}

	public function index()
	{
		if ($this->user_id) {
			if ($this->user_level == "User")
				redirect('dashboard_user');
			if ($this->user_level == "Operator")
				redirect('dashboard_user/operator');
			if ($this->user_level == "Dewan")
				redirect('dashboard_dewan');
			if ($this->user_level != "Administrator" && $this->user_level != "User")
				redirect('home');
			$data['title'] = app_name . " - Admin";
			$data['content'] = "dashboard";
			$data['user_picture'] = $this->user_picture;
			$data['full_name'] = $this->full_name;
			$data['user_level'] = $this->user_level;
			$data['active_menu'] = "dashboard";
			$this->load->model('dashboard_model');
			$data['visitor_days'] = $this->dashboard_model->get_visitor_days();
			$data['visitor_all'] = $this->dashboard_model->get_visitor_all();
			$data['user'] = $this->dashboard_model->get_user();
			$data['post'] = $this->dashboard_model->get_post();
			// $data['lembaga'] = $this->dashboard_model->get_lembaga();
			// $data['koordinator'] = $this->dashboard_model->get_koordinator();
			// $data['kegiatan'] = $this->dashboard_model->get_kegiatan();
			// $data['kegiatan_prov'] = $this->dashboard_model->get_kegiatan_prov();
			// $data['download'] = $this->dashboard_model->get_download();
			// $data['video'] = $this->dashboard_model->get_video();
			// $data['notice_board'] = $this->dashboard_model->get_notice_board()->text;
			$data['misi'] = $this->dashboard_model->get_misi();
			$data['sasaran_strategis'] = $this->dashboard_model->get_sasaran_strategis();
			$data['sasaran_program'] = $this->dashboard_model->get_sasaran_program();
			$data['sasaran_kegiatan'] = $this->dashboard_model->get_sasaran_kegiatan();
			$data['skpd'] = $this->dashboard_model->get_skpd();

			//$data['iku']	= $this->dashboard_model->get_iku();
			// $data['detail_pecapaian']	= $this->dashboard_model->getCapaianIndikator();
			// $data['capaian']	= $this->dashboard_model->getCapaianTahunan();

			//loadheader
			$this->load->model('img_header_model');
			$data['header'] = $this->img_header_model->get_all();

			//logs
			$this->load->model('logs_model');
			$data['logs'] = $this->logs_model->get_some();

			//grafik
			$this->load->model('dashboard_model');


			//logs
			$this->load->model('logs_model');
			$data['logs'] = $this->logs_model->get_some_id($this->user_id);


			$this->user_model->user_id = $this->session->userdata('user_id');
			$this->user_model->set_user_by_user_id();

			$data['user_privileges'] = $this->user_model->user_privileges;
			$data['user_group_menu'] = $this->user_model->user_group_menu;
			$data['nama_unit_kerja'] = $this->user_model->nama_unit_kerja;

			$data['username'] = $this->user_model->username;
			$data['employee_id'] = $this->user_model->employee_id;
			$data['unit_kerja_id'] = $this->user_model->unit_kerja_id;
			$data['user_picture'] = $this->user_model->user_picture;
			$data['full_name'] = $this->user_model->full_name;
			$data['email'] = $this->user_model->email;
			$data['user_level'] = $this->user_model->level;
			$data['phone'] = $this->user_model->phone;
			$data['bio'] = $this->user_model->bio;
			$data['user_status'] = $this->user_model->user_status;
			$data['picture'] = $this->user_model->user_picture;
			$data['reg_date'] = $this->user_model->reg_date;

			$data['grafik_kelamin'] = $this->bm->get_data_kelamin();
			$data['grafik_nama_statuspeg'] = $this->bm->get_data_nama_statuspeg();
			$data['grafik_pendidikan'] = $this->bm->get_data_pendidikan();
			$data['grafik_golongan'] = $this->bm->get_data_golongan();
			$data['grafik_golongan_1'] = $this->bm->get_data_golongan_1();
			$data['grafik_golongan_2'] = $this->bm->get_data_golongan_2();
			$data['grafik_golongan_3'] = $this->bm->get_data_golongan_3();
			$data['grafik_golongan_4'] = $this->bm->get_data_golongan_4();

			$this->load->view('admin/index', $data);
		} else {
			redirect('admin/login');
		}
	}

	public function dashboard()
	{
		if ($this->user_id) {
			if ($this->user_level != "Administrator" && $this->user_level != "User")
				redirect('home');
			$data['title'] = app_name . " - Admin";
			$data['content'] = "dashboard_user";
			$data['user_picture'] = $this->user_picture;
			$data['full_name'] = $this->full_name;
			$data['user_level'] = $this->user_level;
			$data['active_menu'] = "dashboard";
			$this->load->model('dashboard_model');
			$data['visitor_days'] = $this->dashboard_model->get_visitor_days();
			$data['visitor_all'] = $this->dashboard_model->get_visitor_all();
			$data['user'] = $this->dashboard_model->get_user();
			$data['post'] = $this->dashboard_model->get_post();
			$data['lembaga'] = $this->dashboard_model->get_lembaga();
			$data['koordinator'] = $this->dashboard_model->get_koordinator();
			$data['kegiatan'] = $this->dashboard_model->get_kegiatan();
			$data['kegiatan_prov'] = $this->dashboard_model->get_kegiatan_prov();
			$data['download'] = $this->dashboard_model->get_download();
			$data['video'] = $this->dashboard_model->get_video();
			$data['notice_board'] = $this->dashboard_model->get_notice_board()->text;
			$data['misi'] = $this->dashboard_model->get_misi();
			$data['sasaran_strategis'] = $this->dashboard_model->get_sasaran_strategis();
			$data['sasaran_program'] = $this->dashboard_model->get_sasaran_program();
			$data['sasaran_kegiatan'] = $this->dashboard_model->get_sasaran_kegiatan();

			$data['iku'] = $this->dashboard_model->get_iku();
			$data['detail_pecapaian'] = $this->dashboard_model->getCapaianIndikator();
			$data['capaian'] = $this->dashboard_model->getCapaianTahunan();
			$data['sasaran'] = $this->dashboard_model->get_sasaran();

			//loadheader
			$this->load->model('img_header_model');
			$data['header'] = $this->img_header_model->get_all();

			//logs
			$this->load->model('logs_model');
			$data['logs'] = $this->logs_model->get_some();

			//grafik
			$this->load->model('dashboard_model');

			if ($this->input->get('tahun')) {
				$tahun = $this->input->get('tahun');
			}
			$tahun = (empty($tahun)) ? date("Y") : $tahun;

			$data['tahun'] = $tahun;
			$data['bulan'] = $this->bulan;


			$data['data_koordinator'] = $this->dashboard_model->get_data_koordinator();

			for ($i = 1; $i <= 4; $i++) {
				$get = $this->dashboard_model->get_triwulan($i, $tahun);
				$data['grafik1'][$i] = ($get) ? $get : 0;

				if (!isset($data['totalgrafik']))
					$data['totalgrafik'] = 0;
				$data['totalgrafik'] = ($get) ? $data['totalgrafik'] + $get : $data['totalgrafik'] + 0;
			}

			$grafik2 = array();
			$grafik3 = array();
			$grafik4 = array();
			$grafik5 = array();


			for ($i = 1; $i <= count($this->bulan); $i++) {
				$grafik3[$i] = 0;
			}

			foreach ($data['data_koordinator'] as $key => $value) {
				$id_koordinator = $value->id_instansi;

				for ($i = 1; $i <= count($this->bulan); $i++) {
					$get = $this->dashboard_model->get_realisasi($i, $tahun, $id_koordinator);
					$grafik2[$key][$i] = ($get) ? $get : 0;

					if (!isset($grafik3[$i]))
						$grafik3[$i] = 0;
					$grafik3[$i] = ($get) ? $grafik3[$i] + $get : $grafik3[$i] + 0;
				}

				$get = $this->dashboard_model->get_realisasi(NULL, $tahun, $id_koordinator);
				$grafik4[$key] = ($get) ? $get : 0;

				$get = $this->dashboard_model->get_target(NULL, $tahun, $id_koordinator);
				$grafik5[$key] = ($get) ? $get : 0;

				if (!isset($data['totalgrafikt']))
					$data['totalgrafikt'] = 0;
				$data['totalgrafikt'] = ($get) ? $data['totalgrafikt'] + $get : $data['totalgrafikt'] + 0;
			}

			$data['grafik2'] = $grafik2;
			$data['grafik3'] = $grafik3;
			$data['grafik4'] = $grafik4;
			$data['grafik5'] = $grafik5;


			//echo count($data['grafik2'][6]); exit();

			//departmen
			$this->load->model('ref_unit_kerja_model');
			$data['unit_kerja'] = $this->ref_unit_kerja_model->get_all();


			//logs
			$this->load->model('logs_model');
			$data['logs'] = $this->logs_model->get_some_id($this->user_id);


			$this->user_model->user_id = $this->session->userdata('user_id');
			$this->user_model->set_user_by_user_id();

			$data['user_privileges'] = $this->user_model->user_privileges;
			$data['user_group_menu'] = $this->user_model->user_group_menu;
			$data['nama_unit_kerja'] = $this->user_model->nama_unit_kerja;

			$data['username'] = $this->user_model->username;
			$data['employee_id'] = $this->user_model->employee_id;
			$data['unit_kerja_id'] = $this->user_model->unit_kerja_id;
			$data['user_picture'] = $this->user_model->user_picture;
			$data['full_name'] = $this->user_model->full_name;
			$data['email'] = $this->user_model->email;
			$data['user_level'] = $this->user_model->level;
			$data['phone'] = $this->user_model->phone;
			$data['bio'] = $this->user_model->bio;
			$data['user_status'] = $this->user_model->user_status;
			$data['picture'] = $this->user_model->user_picture;
			$data['reg_date'] = $this->user_model->reg_date;

			$this->load->view('admin/index', $data);
		} else {
			redirect('admin/login');
		}
	}

	public function notifikasi()
	{
		if ($this->user_id) {
			if ($this->user_level != "Administrator" && $this->user_level != "User")
				redirect('home');
			$data['title'] = app_name;
			$data['content'] = "notifikasi";
			$data['user_picture'] = $this->user_picture;
			$data['full_name'] = $this->full_name;
			$data['user_level'] = $this->user_level;
			$data['active_menu'] = "dashboard";
			//grafik
			$this->load->model('dashboard_model');

			if ($this->input->get('tahun')) {
				$tahun = $this->input->get('tahun');
			}
			$tahun = (empty($tahun)) ? date("Y") : $tahun;

			$data['tahun'] = $tahun;
			$data['bulan'] = $this->bulan;

			$this->load->view('admin/index', $data);
		} else {
			redirect('admin/login');
		}
	}

	public function delete_notifikasi($id)
	{
		if ($this->user_id) {
			$data['id_notifikasi'] = $id;
			$data['user_id'] = (!empty($this->user_id) and $this->user_id > 0) ? $this->user_id : null;
			$data['unit_kerja_id'] = (!empty($this->unit_kerja_id) and $this->unit_kerja_id > 0) ? $this->unit_kerja_id : null;
			$data['is_admin'] = (!empty($this->user_level) and $this->user_level == "Administrator") ? true : false;
			$this->notifikasi_model->spam($data);
		} else {
			redirect('admin/login');
		}
	}

	/*EDIT BY AYU*/
	public function resetpassword()
	{
		$data['title'] = "Admin - Login" . $this->session->userdata('user_id');
		$data['username'] = $this->session->userdata('username');
		$data['tokenCmdbuild'] = $this->session->userdata('tokenCmdbuild');

		if ($data['username'] != '') {
			$data['user_data'] = $this->master_pegawai_model->get_by_id($this->user_model->id_pegawai);
			if (!empty($_POST)) {
				if ($_POST['password'] !== $_POST['confirmpassword']) {
					$data['pesan'] = "Konfirmasi Password tidak sama";
					$data['type'] = "danger";
					$data['passwordSuccess'] = "failed";
					$data['newPassword'] = "";
					$data['nama_skpd'] = "";
					$data['nama_skpd_alias'] = "";
					$this->load->view('admin/resetpassword', $data);
				} else {
					//change password
					$this->user_model->username = $data['username'];
					$this->user_model->password = md5($_POST['password']);
					$this->user_model->is_expired = 0;
					$this->user_model->reset_password_expired();

					$dataSkpd = $this->GetNamaSKPD($this->user_model->id_skpd);
					$data['newPassword'] = $_POST['password'];
					$data['username'] = $data['username'];
					$data['passwordSuccess'] = "success";
					$data['nama_skpd'] = $dataSkpd->nama_skpd;
					$data['nama_skpd_alias'] = $dataSkpd->nama_skpd_alias;
					$this->load->view('admin/resetpassword', $data);
					/*ADD BY AYU*/
				}
			} else {
				$dataSkpd = $this->GetNamaSKPD($this->user_model->id_skpd);
				$data['newPassword'] = "";
				$data['passwordSuccess'] = "";
				$data['nama_skpd'] = $dataSkpd->nama_skpd;
				$data['nama_skpd_alias'] = $dataSkpd->nama_skpd_alias;

				/*ADD BY AYU*/
				$this->load->view('admin/resetpassword', $data);
				/*ADD BY AYU*/
			}
		} else {
			redirect("admin/login");
		}
	}

	public function GetNamaSKPD($idSkpd)
	{
		$this->db->where('id_skpd', $idSkpd);
		$this->db->select('nama_skpd,nama_skpd_alias');
		$this->db->limit(1);
		$query = $this->db->get('ref_skpd');
		$row = $query->row();
		if ($query->num_rows() > 0) {
			return $row;
		} else {
			return "";
		}
	}

	/*EDIT BY AYU*/

	public function login()
	{
		if ($this->user_id) {
			redirect('admin');
		} else {
			$data['title'] = "Admin - Login" . $this->session->userdata('user_id');
			if (!empty($_POST)) {
				$this->form_validation->set_rules('username', 'Username', 'trim|required');
				$this->form_validation->set_rules('password', 'Password', 'trim|required');
				if ($this->form_validation->run() == FALSE) {
					$data['pesan'] = "Login gagal.<br>username atau password tidak tepat";
				} elseif ($_POST['username'] != "" && $_POST['password'] != "") {
					$this->load->model('user_model');
					$this->user_model->username = $_POST['username'];
					$this->user_model->password = $_POST['password'];
					$valid = $this->user_model->validasi_login();
					if ($valid) {

						$user = $this->db->get_where('user', array('username' => $_POST['username']))->row();
						$last_online = $user->last_online;
						// var_dump(time() - $last_online);
						// die;
						//if last_online less than 10 second

						$filename = "./data/login_exception.txt";
						$handle = fopen($filename, "r");
						$contents = fread($handle, filesize($filename));
						fclose($handle);
						$contents = explode("\n", $contents);
						$contents = array_filter($contents);
						$contents = array_map('trim', $contents);

						if (time() - $last_online <= 10 && $user->user_level == 2 && !in_array($user->username, $contents)) {
							$data['pesan'] = "Login gagal.<br>Akun sedang login di perangkat lain";
						} else {
							$login = $this->user_model->cek_status_user();
							//var_dump($login);die;
							if ($login) {
								/*EDIT BY AYU*/
								$isExpired = $this->user_model->is_expired;
								//echo $isExpired;							

								//echo "TOKEN:".$this->session->userdata('tokenCmdbuild');

								if ($isExpired == '1') {
									redirect('admin/resetpassword');
								} else {
									/*EDIT BY AYU*/

									//logs
									$this->load->model('logs_model');
									$this->logs_model->user_id = $this->session->userdata('user_id');
									$this->logs_model->activity = "login ke aplikasi";
									$this->logs_model->category = "login";
									$desc = $_POST['username'];
									$this->logs_model->description = "dengan username " . $desc;
									$this->logs_model->insert();
									redirect('admin');
								}
							} else {
								$data['pesan'] = "Login gagal.<br>Akun anda tidak aktif.";
							}
						}
					} else {
						$data['pesan'] = "Login gagal.<br>username atau password tidak tepat";
					}
				} else {
					//echo"<script type='javascript'>alert('username atau Password tidak boleh kosong)');</script>";
					$data['pesan'] = "username atau Password tidak boleh kosong";
				}
			}
			$this->load->view('admin/login', $data);
		}
	}

	/*public function register()
	{
	if ($this->user_id)
	{
	redirect('admin');
	}
	else
	{
	$data['title']		= "Admin - Register";
	if (!empty($_POST))
	{
	$this->user_model->username = $_POST['username'];
	if ($_POST['password']=="")
	$this->user_model->password = "123456";
	else
	$this->user_model->password = $_POST['password'];
	$this->user_model->full_name = $_POST['full_name'];
	$this->user_model->email = $_POST['email'];
	$this->user_model->phone = $_POST['phone'];
	$this->user_model->user_picture = 'user_default.png';
	$this->user_model->user_level= '3';	//masyarakat
	$this->user_model->user_status = 'Not Active';
	$register = $this->user_model->insert();
	if ($register)
	{
	redirect('admin');
	}
	else
	{
	$data['pesan']	= "Pendaftaran gagal.";
	}
	}
	$this->load->model('user_model');
	$data['level']	= $this->user_model->get_user_level();
	$this->load->view('admin/register',$data);
	}
	}*/

	public function logout()
	{
		$CI = &get_instance();
		$CI->session->sess_destroy();
		redirect('admin/login');
	}
	public function page_not_found()
	{
		if ($this->user_id) {
			if ($this->user_level != "Administrator" && $this->user_level != "Admin Web")
				redirect('promkes');
			$data['title'] = app_name;
			$data['content'] = "404";
			$data['user_picture'] = $this->user_picture;
			$data['full_name'] = $this->full_name;
			$data['user_level'] = $this->user_level;
			$data['active_menu'] = "";
			$this->load->view('admin/index', $data);
		} else {
			redirect('admin/login');
		}
	}

	public function blank()
	{
		$this->load->view('admin/blank');
	}

	public function update_last_online()
	{
		$now = time();
		$data_update = ['last_online' => $now];
		$update = $this->db->update('user', $data_update, ['user_id' => $this->user_id]);
		if ($update) {
			//json
			$data['status'] = 'success';
			$data['message'] = 'Update last online berhasil';
			$data['data'] = $now;
			$this->output->set_content_type('application/json')->set_output(json_encode($data));
		} else {
			//json
			$data['status'] = 'error';
			$data['message'] = 'Update last online gagal';
			$data['data'] = $now;
			$this->output->set_content_type('application/json')->set_output(json_encode($data));
		}
	}
	public function tes_token_maksiti($token)
	{
		$data['title']		    = 'Detail SKP | ' . $this->Config->app_name;
		$data['content']	    = "kinerja/skp/verifikasi/detail/index";
		$data['user_picture']   = $this->user_picture;
		$data['full_name']		= $this->full_name;
		$data['user_level']		= $this->user_level;
		$data['plugins']        = ['select', 'sweetalert'];
		$data['active_menu']    = "verifikasi_skp";


		$this->load->model("kinerja/Config");
		$this->load->model("kinerja/Skp_model");
		$this->load->model("sicerdas/Globalvar");


		$param['where']["md5(CONCAT('SKP',skp.id_skp))"] = $token;

		$detail = $this->Skp_model->get($param)->row();

		if (!$detail || !$token) {
			show_404();
		}

		if ($detail->status != "Belum Diverifikasi") {
			$token = md5("SKP" . $detail->id_skp);
			redirect("kinerja/skp/detail/view?token=" . $token);
		}
		echo $detail->id_skp;
		die;

		$data['detail'] = $detail;

		$role_pimpinan = ($detail->kepala_skpd == "Y" && in_array($detail->jenis_skpd, ['skpd', 'kecamatan']));

		$data['role_pimpinan']  = $role_pimpinan;

		$this->load->view('admin/main', $data);
	}
}
