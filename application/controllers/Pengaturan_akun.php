<?php
class Pengaturan_akun extends CI_Controller
{
	public $user_id;

	public function __construct()
	{
		parent::__construct();
		$this->user_id = $this->session->userdata('user_id');
		$this->load->model('user_model');
		$this->load->model('master_pegawai_model');
		$this->load->model('ref_skpd_model');
		$this->load->model('pegawai_model');
		$this->load->model('dashboard_model');
		$this->load->model('user_model');
		$this->user_model->user_id = $this->user_id;
		$this->user_model->set_user_by_user_id();
		$this->user_picture = $this->user_model->user_picture;
		$this->full_name = $this->user_model->full_name;
		$this->user_level = $this->user_model->level; /*ADD BY AYU */
		$this->email = $this->user_model->email;
		$this->user_privileges = $this->user_model->user_privileges;
		$array_privileges = explode(';', $this->user_privileges);

		if (($this->user_level != "User"))
			redirect('admin');
	}

	public function index()
	{
		if ($this->user_id && $this->user_level == "User") {
			//var_dump($this->user_id);die;
			$data['title'] = "Pengaturan Akun - " . app_name;
			$data['content'] = "pengaturan_akun/index";
			$data['user_picture'] = $this->user_picture;
			$data['full_name'] = $this->full_name;
			$data['user_level'] = $this->user_level;
			$data['id_user'] = $this->user_id;
			$data['active_menu'] = "user";

			/*ADD BY AYU */
			$data['email'] = $this->email;
			/*ADD BY AYU*/

			$id_user = $this->user_id;

			$data['skpd'] = $this->ref_skpd_model->get_all();
			$id_pegawai = $this->session->userdata('id_pegawai');

			$data['detail'] = $this->master_pegawai_model->get_by_id($id_pegawai);

			$data['newPassword'] = ""; /*ADD BY AYU*/
			$data['passwordSuccess'] = ""; /*ADD BY AYU*/
			$data['tokenCmdbuild'] = $this->session->userdata('tokenCmdbuild'); /*ADD BY AYU*/

			if (!empty($_POST)) {
				if (isset($_POST['profil_pic'])) {
					$update = $_POST;
					unset($update['foto_pegawai']);
					$config['upload_path'] = './data/foto/pegawai/';
					$config['allowed_types'] = 'gif|jpg|png|jpeg';
					$config['max_size'] = 2000;
					$config['max_width'] = 2000;
					$config['max_height'] = 2000;

					if (isset($_FILES['foto_pegawai']['tmp_name'])) {
						$this->load->library('upload', $config);
						if (!$this->upload->do_upload('foto_pegawai')) {
							$tmp_name = $_FILES['foto_pegawai']['tmp_name'];
							if ($tmp_name != "") {
								$data['message'] = $this->upload->display_errors();
								$data['type'] = "danger";
							}
						} else {
							$in = $this->master_pegawai_model->update(array('foto_pegawai' => $this->upload->data('file_name')), $id_pegawai);
							$data['message'] = '<i class="ti-check"></i> Foto profil berhasil diubah';
							$data['type'] = 'success';
							$filename = $this->upload->data('file_name');
							$old_path = './data/foto/pegawai/';
							$new_path = './data/user_picture/';
							if (!copy($old_path . $filename, $new_path . $filename)) {
								$data['message'] = "failed to copy $file...\n";
								$data['type'] = 'warning';
							}
						}
					}
				} elseif (isset($_POST['delete_pic'])) {
					$in = $this->master_pegawai_model->update(array('foto_pegawai' => 'user-default.png'), $id_pegawai);
					$data['message'] = '<i class="ti-check"></i> Foto profil berhasil dihapus';
					$data['type'] = 'success';
				} elseif (isset($_POST['account'])) {
					$update = $_POST;
					unset($update['account']);
					$in = $this->master_pegawai_model->update($update, $id_pegawai);
					$data['message'] = '<i class="ti-check"></i> Data pegawai berhasil diperbaharui';
					$data['type'] = 'success';
				} elseif (isset($_POST['password'])) {
					$old_password = $_POST['old_password'];
					$n_password = $_POST['n_password'];
					$cn_password = $_POST['cn_password'];
					$id = $this->user_id;
					$cek_password = $this->dashboard_model->cek_password($id, $old_password);
					if (!$cek_password) {
						$data['message'] = "Password lama salah";
						$data['type'] = "danger";
						$data['passwordSuccess'] = "failed";
					}
					//if password not contains both lower and uppercase characters
					elseif (!preg_match("#[a-z]+#", $n_password) || !preg_match("#[A-Z]+#", $n_password)) {
						$data['message'] = "Password harus mengandung huruf kecil dan huruf besar";
						$data['type'] = "danger";
						$data['passwordSuccess'] = "failed";
					}
					//if password not contains number
					elseif (!preg_match("#[0-9]+#", $n_password)) {
						$data['message'] = "Password harus mengandung angka";
						$data['type'] = "danger";
						$data['passwordSuccess'] = "failed";
					}
					//if password not contains special character
					elseif (!preg_match("#\W+#", $n_password)) {
						$data['message'] = "Password harus mengandung karakter spesial";
						$data['type'] = "danger";
						$data['passwordSuccess'] = "failed";
					}
					//if password length less than 8
					elseif (strlen($n_password) < 8) {
						$data['message'] = "Password harus lebih dari 8 karakter";
						$data['type'] = "danger";
						$data['passwordSuccess'] = "failed";
					} elseif ($n_password !== $cn_password) {
						$data['message'] = "Konfirmasi Password tidak sama";
						$data['type'] = "danger";
						$data['passwordSuccess'] = "failed";
					} else {
						$this->dashboard_model->update_password($id, $n_password);
						$data['message'] = '<i class="ti-check"></i> Password berhasil diperbaharui';
						$data['type'] = "success";

						/*ADD BY AYU*/
						$data['newPassword'] = $n_password;
						$data['passwordSuccess'] = "success";
						/*ADD BY AYU*/
					}


				} elseif (isset($_POST['upload_certificate'])) {
					$this->dashboard_model->upload_certificate($id_user);
					$data['message'] = '<i class="ti-check"></i> Sertifikat berhasil di upload';
					$data['type'] = "success";
				} elseif (isset($_POST['atasan'])) {
					$update = array('id_pegawai_atasan_langsung' => $_POST['id_pegawai_atasan_langsung']);
					$in = $this->master_pegawai_model->update($update, $id_pegawai);
					$data['message'] = '<i class="ti-check"></i> Atasan langsung berhasil diperbaharui';
					$data['type'] = 'success';
				} elseif (isset($_POST['lokasi'])) {
					if (empty($_POST['id_ref_skpd_sub'])) {
						$_POST['id_ref_skpd_sub'] == NULL;
					}
					$update = array('id_ref_skpd_sub' => $_POST['id_ref_skpd_sub']);
					$in = $this->master_pegawai_model->update($update, $id_pegawai);
					$data['message'] = '<i class="ti-check"></i> Lokasi Kantor berhasil diperbaharui';
					$data['type'] = 'success';
				} elseif (isset($_POST['identitas'])) {
					if (strlen($_POST['nik']) !== 16) {
						$data['message'] = 'NIK harus 16 digit';
						$data['type'] = 'warning';
					} else {
						$update = $_POST;
						unset($update['file_ktp']);
						$config['file_name'] = 'ktp_' . md5($id_pegawai) . time();
						$config['upload_path'] = './data/ktp/';
						$config['allowed_types'] = 'gif|jpg|png|jpeg';
						$config['max_size'] = 2000;
						$config['max_width'] = 2000;
						$config['max_height'] = 2000;
						$config['overwrite'] = TRUE;

						if (isset($_FILES['file_ktp']['tmp_name'])) {
							$this->load->library('upload', $config);
							if (!$this->upload->do_upload('file_ktp')) {
								$tmp_name = $_FILES['file_ktp']['tmp_name'];
								if ($tmp_name != "") {
									$data['message'] = $this->upload->display_errors();
									$data['type'] = "danger";
								}
							} else {
								if (!empty($data['detail']->file_ktp)) {
									unlink('./data/ktp/' . $data['detail']->file_ktp);
								}
								$in = $this->master_pegawai_model->update(array('nik' => $_POST['nik'], 'file_ktp' => $this->upload->data('file_name')), $id_pegawai);
								$data['message'] = '<i class="ti-check"></i> Identitas Diri berhasil diubah';
								$data['type'] = 'success';
							}
						}
					}
				}
			}

			$data['detail'] = $this->master_pegawai_model->get_by_id($id_pegawai);
			$data['jabatan'] = $this->ref_skpd_model->get_jabatan_by_id($data['detail']->id_jabatan);
			$data['unit_kerja'] = $this->ref_skpd_model->get_unit_kerja_by_id_skpd($data['detail']->id_skpd);
			$data['details'] = $this->master_pegawai_model->get_by_id_user($id_user);
			$data['atasan'] = $this->master_pegawai_model->get_by_id_skpd($data['detail']->id_skpd);

			$data['sub_office'] = $this->ref_skpd_model->get_skpd_sub($data['detail']->id_skpd);
			// print_r($data['detail']->id_skpd);
			$this->load->view('admin/index', $data);
		} else {
			redirect('admin');
		}
	}

	public function get_pegawai()
	{
		if (isset($_POST['searchTerm'])) {
			$search = $_POST['searchTerm'];
			$fetch = $this->master_pegawai_model->search($search);

			$data = array();

			foreach ($fetch as $f) {
				$data[] = array(
					'id' => $f->id_pegawai,
					'text' => $f->nama_lengkap,
					'html' => $f->nip . "<br> <b>" . $f->nama_lengkap . "</b><br>" . $f->jabatan
				);
			}
			echo json_encode($data);
		}
	}
}