<?php
include_once(APPPATH . "third_party/Common/Autoloader.php");
include_once(APPPATH . "third_party/PhpWord/Autoloader.php");
//include_once(APPPATH."core/Front_end.php");

use PhpOffice\Common\Autoloader as CAutoloader;
use PhpOffice\PhpWord\Autoloader;
use PhpOffice\PhpWord\Settings;
use PhpOffice\PhpWord\Shared\Converter;
use PhpOffice\PhpWord\Style\TablePosition;

Autoloader::register();
CAutoloader::register();
Settings::loadConfig();
defined('BASEPATH') or exit('No direct script access allowed');

class Auditor extends CI_Controller
{
	public $user_id;

	public function __construct()
	{
		parent::__construct();
		$this->user_id = $this->session->userdata('user_id');
		$this->id_pegawai = $this->session->userdata('id_pegawai');
		$this->load->model('user_model');
		$this->load->model('auditor_model');
		$this->user_model->user_id = $this->user_id;
		$this->user_model->set_user_by_user_id();
		$this->user_picture = $this->user_model->user_picture;
		$this->full_name = $this->user_model->full_name;
		$this->user_level = $this->user_model->level;
		$this->user_privileges = explode(";", $this->user_model->user_privileges);
		$this->kepala_skpd = $this->user_model->kepala_skpd;
		$this->id_inspektorat = 2;

		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->helper('security');
		$this->load->library('encryption');
		$this->load->helper('encryption_helper');

		if (!$this->user_id) {
			redirect("admin/login");
		}

		// if($this->session->userdata('username') == '197903102008011005' or $this->session->userdata('username') == '199004022020121001'){
		// 	$this->user_level = "Administrator";
		// }
		

		if ($this->user_level != "Administrator" AND $this->session->userdata('id_skpd') != $this->id_inspektorat) {
			show_404();
		}
	}

	public function pkpt()
	{
		if ($this->user_id) {
			$data['title'] = "Daftar PKPT";
			$data['content'] = "auditor/frame";
			$data['content_frame'] = "pkpt";
			$data['user_picture'] = $this->user_picture;
			$data['full_name'] = $this->full_name;
			$data['user_level'] = $this->user_level;
			$data['user_privileges'] = $this->user_privileges;
			$data['kepala_skpd'] = $this->kepala_skpd;
			$data['id_pegawai'] = $this->id_pegawai;
			$data['active_menu'] = "auditor";

			if ($this->input->post()) {
				$meta = $this->input->post(NULL, TRUE);
				$insert = $this->auditor_model->insert_pkpt($meta);
			}

			$this->load->view('admin/index', $data);
		} else {
			redirect('admin');
		}
	}

	public function pkpt_penugasan($id_pkpt)
	{
		if ($this->user_id) {
			$data['title'] = "Daftar PKPT";
			$data['content'] = "auditor/frame";
			$data['content_frame'] = "pkpt_penugasan";
			$data['user_picture'] = $this->user_picture;
			$data['full_name'] = $this->full_name;
			$data['user_level'] = $this->user_level;
			$data['user_privileges'] = $this->user_privileges;
			$data['kepala_skpd'] = $this->kepala_skpd;
			$data['id_pegawai'] = $this->id_pegawai;
			$data['active_menu'] = "auditor";

			if ($id_pkpt) {

				if ($this->input->post()) {
					$meta = $this->input->post(NULL, TRUE);
				}

				$this->session->set_userdata('auditor_pkpt', $id_pkpt);
			} else {
				redirect('auditor/pkpt');
			}

			$this->load->view('admin/index', $data);
		} else {
			redirect('auditor/pkpt');
		}
	}

	public function penugasan()
	{
		if ($this->user_id and ($this->user_level == "Administrator" or in_array('auditor', $this->user_privileges))) {
			$data['title'] = "Daftar Penugasan";
			$data['content'] = "auditor/frame";
			$data['content_frame'] = "penugasan";
			$data['user_picture'] = $this->user_picture;
			$data['full_name'] = $this->full_name;
			$data['user_level'] = $this->user_level;
			$data['user_privileges'] = $this->user_privileges;
			$data['kepala_skpd'] = $this->kepala_skpd;
			$data['id_pegawai'] = $this->id_pegawai;
			$data['active_menu'] = "auditor";

			if ($this->input->post()) {
				$meta = $this->input->post(NULL, TRUE);
				$insert = $this->auditor_model->insert_penugasan($meta);
			}

			$this->load->view('admin/index', $data);
		} else {
			redirect('auditor/pkpt');
		}
	}

	public function temuan()
	{
		if ($this->user_id and ($this->user_level == "Administrator" or in_array('auditor', $this->user_privileges))) {
			$data['title'] = "Daftar Temuan";
			$data['content'] = "auditor/frame";
			$data['content_frame'] = "temuan";
			$data['user_picture'] = $this->user_picture;
			$data['full_name'] = $this->full_name;
			$data['user_level'] = $this->user_level;
			$data['user_privileges'] = $this->user_privileges;
			$data['kepala_skpd'] = $this->kepala_skpd;
			$data['id_pegawai'] = $this->id_pegawai;
			$data['active_menu'] = "auditor";

			if ($this->input->post()) {
				$meta = $this->input->post(NULL, TRUE);
				$insert = $this->auditor_model->insert_temuan($meta);
			}

			$this->load->view('admin/index', $data);
		} else {
			redirect('auditor/pkpt');
		}
	}

	public function kertas_kerja($id_penugasan)
	{
		if ($this->user_id) {
			$data['title'] = "Kertas Kerja";
			$data['content'] = "auditor/frame";
			$data['content_frame'] = "kertas_kerja";
			$data['user_picture'] = $this->user_picture;
			$data['full_name'] = $this->full_name;
			$data['user_level'] = $this->user_level;
			$data['user_privileges'] = $this->user_privileges;
			$data['kepala_skpd'] = $this->kepala_skpd;
			$data['id_pegawai'] = $this->id_pegawai;
			$data['active_menu'] = "auditor";

			if ($id_penugasan) {

				if ($this->input->post()) {
					$meta = $this->input->post(NULL, TRUE);
					if (isset($_POST['submit_program'])) {
						unset($meta['submit_program']);
						$meta['id_penugasan'] = decode($id_penugasan);
						$submit = $this->auditor_model->submit_program($meta);
					}
					if (isset($_POST['change_ketua'])) {
						unset($meta['change_ketua']);
						$meta['id_penugasan'] = decode($id_penugasan);
						$change = $this->auditor_model->change_ketua($meta);
					}
				}

				$this->session->set_userdata('auditor_penugasan', $id_penugasan);
			} else {
				redirect('auditor/pkpt_penugasan');
			}
			$data['penugasan'] = $this->auditor_model->get_detail_penugasan(decode($id_penugasan));

			$this->load->view('admin/index', $data);
		} else {
			redirect('auditor/pkpt');
		}
	}
	public function monitoring()
	{
		if ($this->user_id and ($this->user_level == "Administrator" or in_array('auditor', $this->user_privileges))) {
			$data['title'] = "Daftar Temuan";
			$data['content'] = "auditor/frame";
			$data['content_frame'] = "monitoring";
			$data['user_picture'] = $this->user_picture;
			$data['full_name'] = $this->full_name;
			$data['user_level'] = $this->user_level;
			$data['user_privileges'] = $this->user_privileges;
			$data['kepala_skpd'] = $this->kepala_skpd;
			$data['id_pegawai'] = $this->id_pegawai;
			$data['active_menu'] = "auditor";

			$this->load->view('admin/index', $data);
		} else {
			redirect('auditor/pkpt');
		}
	}

	public function frame($frame)
	{
		if ($this->user_id) {
			$data['title'] = "Kertas Kerja";
			$data['user_picture'] = $this->user_picture;
			$data['full_name'] = $this->full_name;
			$data['user_level'] = $this->user_level;
			$data['user_privileges'] = $this->user_privileges;
			$data['kepala_skpd'] = $this->kepala_skpd;
			$data['id_pegawai'] = $this->id_pegawai;
			$data['active_menu'] = "auditor";

			if ($frame == "temuan") {
				$data['list_sp'] = $this->auditor_model->get_list_sp();
				$data['list_skpd'] = $this->auditor_model->get_list_skpd();
				$data['list_anggota'] = $this->auditor_model->get_list_anggota();

				$data['list_temuan'] = $this->auditor_model->get_list_temuan();
			} elseif ($frame == "monitoring") {
				$data['list_temuan'][0] = $this->auditor_model->get_list_temuan(0);
				$data['list_temuan'][1] = $this->auditor_model->get_list_temuan(1);
				$data['list_temuan'][2] = $this->auditor_model->get_list_temuan(2);
				$data['list_temuan'][3] = $this->auditor_model->get_list_temuan(3);
			}

			if ($frame == "pkpt") {
				$data['list_subkegiatan'] = $this->auditor_model->get_list_subkegiatan();
				$data['list_week'] = week(2023);
				$data['list_pkptsubkegiatan'] = $this->auditor_model->get_list_pkptsubkegiatan(2023);

				$data['count_pkpt'] = $this->auditor_model->get_count_pkpt();
				$data['list_pkpt'] = $this->auditor_model->get_list_pkpt();
				foreach ($data['list_pkpt']['sub_kegiatan'] as $row) {
					foreach ($data['list_pkpt']['pkpt'][$row->kode_sub_kegiatan] as $key => $value) {
						$data['list_penugasan'][$row->kode_sub_kegiatan][$key] = $this->auditor_model->get_list_penugasan(null, $value->id_pkpt);
					}
				}
			} elseif ($frame == "penugasan") {
				$data['list_pkpt'] = $this->auditor_model->get_list_pkpt();
				$data['list_sp'] = $this->auditor_model->get_list_sp();
				$data['list_skpd'] = $this->auditor_model->get_list_skpd();
				$data['list_anggota'] = $this->auditor_model->get_list_anggota();
				$get_desa = curlMadasih('list_desa');
				if ($testing == 1) {
					print_r($get_desa);
					die;
				}
				if ($get_desa) {
					$data['desa'] = json_decode($get_desa);
				} else {
					$data['desa'] = array();
				}

				$data['count_pkpt'] = $this->auditor_model->get_count_pkpt();
				$data['list_penugasan'] = $this->auditor_model->get_list_penugasan();
			} elseif ($frame == "pkpt_penugasan") {
				$id_pkpt = decode($this->session->userdata('auditor_pkpt'));
				$data['list_week'] = week(2023);

				$data['count_pkpt'] = $this->auditor_model->get_count_pkpt();
				$data['pkpt'] = $this->auditor_model->get_detail_pkpt($id_pkpt);
				$data['list_penugasan'][0] = $this->auditor_model->get_list_penugasan(0, $id_pkpt);
				$data['list_penugasan'][1] = $this->auditor_model->get_list_penugasan(1, $id_pkpt);
				$data['list_penugasan'][2] = $this->auditor_model->get_list_penugasan(2, $id_pkpt);
				$data['list_penugasan'][3] = $this->auditor_model->get_list_penugasan(3, $id_pkpt);
			} elseif ($frame == "kertas_kerja") {
				$id_penugasan = decode($this->session->userdata('auditor_penugasan'));
				$data['list_week'] = week(2023);

				$data['penugasan'] = $this->auditor_model->get_detail_penugasan($id_penugasan);
				$data['pkpt'] = $this->auditor_model->get_detail_pkpt($data['penugasan']['detail']->id_pkpt);
				$data['list_penugasan'] = $this->auditor_model->get_list_penugasan(null, $data['penugasan']['detail']->id_pkpt, $id_penugasan);
			}

			$this->load->view('admin/auditor/src/head', $data);
			$this->load->view('admin/auditor/' . $frame, $data);
			$this->load->view('admin/auditor/src/bottom', $data);
		} else {
			redirect('admin');
		}
	}

	function delete_objek_pemeriksaan()
	{
		if ($this->user_id and ($this->user_level == "Administrator" or in_array('auditor', $this->user_privileges))) {
			$meta = $this->input->post(NULL, TRUE);
			$meta['id'] = decode($meta['id']);

			$resp['error'] = false;
			$resp['error_msg'] = "";
			$submit = $this->auditor_model->delete_objek_pemeriksaan($meta);
		} else {
			$resp['error'] = true;
			$resp['error_msg'] = "Akses Tidak Diperbolehkan.";
		}
		echo json_encode($resp);
	}

	function delete_penugasan()
	{
		if ($this->user_id and ($this->user_level == "Administrator" or in_array('auditor', $this->user_privileges))) {
			$meta = $this->input->post(NULL, TRUE);
			$meta['id'] = decode($meta['id']);

			$resp['error'] = false;
			$resp['error_msg'] = "";
			$submit = $this->auditor_model->delete_penugasan($meta);
		} else {
			$resp['error'] = true;
			$resp['error_msg'] = "Akses Tidak Diperbolehkan.";
		}
		echo json_encode($resp);
	}

	function change_klasifikasi()
	{
		if ($this->user_id and ($this->user_level == "Administrator" or $this->kepala_skpd == "Y")) {
			$meta = $this->input->post(NULL, TRUE);
			$meta['id_penugasan'] = decode($meta['id_penugasan']);

			$resp['error'] = false;
			$resp['error_msg'] = "";
			$submit = $this->auditor_model->change_klasifikasi($meta);
		} else {
			$resp['error'] = true;
			$resp['error_msg'] = "Akses Tidak Diperbolehkan.";
		}
		echo json_encode($resp);
	}

	function get_kanban($id_penugasan, $id_pegawai = 0)
	{
		$item = $this->auditor_model->get_item_board($id_penugasan, 'board-to-do', $id_pegawai);
		$board[] = [
			'id' => 'board-to-do',
			'title' => 'Persiapan dan Pelaksanaan',
			'item' => $item,
			// 'itemAddOptions' => array(
            //     'enabled' => true,
            //     'content' => "+ Tambah Kertas Kerja",
            //     'class' => "kanban-title-button btn btn-default btn-xs",
            //     'footer' => false
            // )
		];

		$item = $this->auditor_model->get_item_board($id_penugasan, 'board-in-progres', $id_pegawai);
		$board[] = [
			'id' => 'board-in-progres',
			'title' => 'Draft Pembuatan Laporan',
			'item' => $item
		];

		$item = $this->auditor_model->get_item_board($id_penugasan, 'board-in-review', $id_pegawai);
		$board[] = [
			'id' => 'board-in-review',
			'title' => 'Pembuatan Laporan Akhir',
			'item' => $item
		];

		$item = $this->auditor_model->get_item_board($id_penugasan, 'board-done', $id_pegawai);
		$board[] = [
			'id' => 'board-done',
			'title' => 'Pekerjaan Selesai',
			'item' => $item
		];

		echo json_encode($board);
	}

	function add_board($id_penugasan, $id_pegawai = 0)
	{
		if ($this->input->post()) {
			$meta = $this->input->post(NULL, TRUE);
			$meta['id_penugasan'] = decode($id_penugasan);
			$meta['id_pegawai'] = $id_pegawai;
			$meta['tanggal_topik'] = date('Y-m-d');
			$insert = $this->auditor_model->insert_pekerjaan($meta);

			//log aktifitas
			if ($insert) {
				$set['board_id'] = $meta['board_id'] ;
				$set['board_position'] = "board-to-do";
				$move = $this->auditor_model->move_pekerjaan($set);
				$verse['type'] = "system";
				$nama_user = ($this->session->userdata('nama_lengkap')) ? $this->session->userdata('nama_lengkap') : $this->session->userdata('full_name');
				$verse['komentar_aktifitas'] = base64_encode('<blockquote class="blockquote"><footer class="blockquote-footer text-dark"><span class="fw-bolder">' . $nama_user . '</span> membuat kertas kerja.</footer></blockquote>');
				$verse['id_pegawai'] = ($this->id_pegawai) ? $this->id_pegawai : 0;
				$verse['board_id'] = $meta['board_id'];
				$submit = $this->auditor_model->add_aktifitas($verse);
			}
		} else {
			show_404();
		}
	}

	function move_board($id_penugasan, $id_pegawai = 0)
	{
		if ($this->input->post()) {
			$meta = $this->input->post(NULL, TRUE);
			$meta['id_penugasan'] = decode($id_penugasan);
			$meta['id_pegawai'] = $id_pegawai;
			$move = $this->auditor_model->move_pekerjaan($meta);

			//log aktifitas
			if ($move) {
				$verse['type'] = "system";
				$verse['group'] = "aktifitas";
				$nama_user = ($this->session->userdata('nama_lengkap')) ? $this->session->userdata('nama_lengkap') : $this->session->userdata('full_name');
				$verse['komentar_aktifitas'] = base64_encode('<blockquote class="blockquote"><footer class="blockquote-footer text-dark"><span class="fw-bolder">' . $nama_user . '</span> memindahkan kertas kerja menjadi <span class="text-primary">' . posisi_kertas_kerja($meta['board_position']) . '</span>.</footer></blockquote>');
				$verse['id_pegawai'] = ($this->id_pegawai) ? $this->id_pegawai : 0;
				$verse['board_id'] = $meta['board_id'];
				$submit = $this->auditor_model->add_aktifitas($verse);
			}
			$resp['move'] = $move;
			$resp['error'] = false;
			$resp['error_msg'] = "";
		} else {
			$resp['error'] = true;
			$resp['error_msg'] = "Akses Tidak Diperbolehkan.";
		}
		echo json_encode($resp);
	}

	function save_kertas_kerja()
	{
		if ($this->user_id) {
			$meta = $this->input->post(NULL, TRUE);

			$config['upload_path'] = './data/auditor/kertas_kerja/cover/';
			$config['allowed_types'] = 'gif|jpeg|jpg|png';
			$config['max_size'] = 2500;
			$config['encrypt_name'] = TRUE;

			$this->load->library('upload', $config);

			if (!$this->upload->do_upload('cover_pekerjaan')) {
				$resp['error'] = false;
				$resp['error_msg'] = "File Gagal Diunggah: " . $this->upload->display_errors('', '');
			} else {
				$resp['error'] = false;
				$resp['error_msg'] = "";
				$meta['cover_pekerjaan'] = $this->upload->data('file_name');

			}

			if (count($meta['anggota_topik']) == 0) {
				unset($meta['anggota_topik']);
			} else {
				$meta['anggota_topik'] = implode(',', $meta['anggota_topik']);
			}
			$submit = $this->auditor_model->update_pekerjaan($meta);

			//log aktifitas
			if ($submit) {
				$verse['type'] = "system";
				$verse['group'] = "aktifitas";
				$nama_user = ($this->session->userdata('nama_lengkap')) ? $this->session->userdata('nama_lengkap') : $this->session->userdata('full_name');
				$verse['komentar_aktifitas'] = base64_encode('<blockquote class="blockquote"><footer class="blockquote-footer text-dark"><span class="fw-bolder">' . $nama_user . '</span> mengubah informasi kertas kerja.</footer></blockquote>');
				$verse['id_pegawai'] = ($this->id_pegawai) ? $this->id_pegawai : 0;
				$verse['board_id'] = $meta['board_id'];
				$submit = $this->auditor_model->add_aktifitas($verse);
			}
		} else {
			$resp['error'] = true;
			$resp['error_msg'] = "Akses Tidak Diperbolehkan.";
		}
		echo json_encode($resp);
	}

	function delete_kertas_kerja()
	{
		if ($this->user_id) {
			$meta = $this->input->post(NULL, TRUE);

			$resp['error'] = false;
			$resp['error_msg'] = "";
			$submit = $this->auditor_model->delete_pekerjaan($meta);
		} else {
			$resp['error'] = true;
			$resp['error_msg'] = "Akses Tidak Diperbolehkan.";
		}
		echo json_encode($resp);
	}

	function get_aktifitas($board_id = null, $group = null)
	{
		if ($board_id and $this->user_id) {
			$get = $this->auditor_model->get_aktifitas($board_id, $group);
			foreach ($get as $row) {
				$foto = ($row->foto_pegawai) ? $row->foto_pegawai : "user-default.png";
				switch ($row->group) {
					case "nhp":
						$tautan_text = "mengupload berkas NHP.";
						break;
					case "lhp":
						$tautan_text = "mengupload berkas LHP.";
						break;
					default:
						$tautan_text = "menambahkan tautan.";
						break;
				}
				$tautan = ($row->berkas_aktifitas) ? '
									<blockquote class="blockquote ps-1 border-start-primary border-start-3">
										<small><a href="' . base_url('data/auditor/kertas_kerja/attachment/' . $row->berkas_aktifitas) . '" target="_blank"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-paperclip font-small-3 align-middle me-0"><path d="M21.44 11.05l-9.19 9.19a6 6 0 0 1-8.49-8.49l9.19-9.19a4 4 0 0 1 5.66 5.66l-9.2 9.19a2 2 0 0 1-2.83-2.83l8.49-8.48"></path></svg> ' . $row->berkas_aktifitas . '</a></small>
										<footer class="blockquote-footer">' . $tautan_text . '</footer>
									</blockquote>' : '';
				$more_info = ($row->type == "system") ? '<div class="more-info w-100 text-center">' : '<div class="more-info">';
				$more_info = ($row->group == "nhp" or $row->group == "lhp") ? '<div class="more-info w-100 text-start">' : $more_info;
				echo '	<div class="d-flex align-items-start mb-1">
							<div class="avatar my-0 ms-0 me-50">
								<img src="/data/foto/pegawai/' . $foto . '"
									alt="Avatar" height="32" />
							</div>
							' . $more_info . '
								<p class="mb-0">
									' . base64_decode($row->komentar_aktifitas) . '
								</p>
								' . $tautan . '
								<small class="text-muted">' . tgl_indo_full($row->tanggal_aktifitas) . '</small>
							</div>
						</div>';
			}
			// echo "<pre>";
			// print_r($get);
			// echo "</pre>";
		} else {
			echo "Akses Tidak Diperbolehkan.";
		}
	}

	function get_status($board_id = null, $group = null)
	{
		if ($board_id and $this->user_id) {
			$row = $this->auditor_model->get_status($board_id, $group);
			if ($row) {
				if ($group == "nhp") {
					if ($row->memiliki_nhp == 'N') {
						echo '	<div class="alert alert-dark" role="alert">
									<div class="alert-body"><strong>Status:</strong> Tidak memiliki NHP.</div>
								</div>';
					} elseif (empty($row->berkas_nhp)) {
						echo '	<div class="alert alert-danger" role="alert">
									<div class="alert-body"><strong>Status:</strong> Berkas NHP belum diupload.</div>
								</div>';
					} elseif ($row->status_nhp == "P") {
						echo '	<div class="alert alert-secondary" role="alert">
									<div class="alert-body"><strong>Status:</strong> NHP sedang tahap verifikasi.</div>
								</div>';
						if (in_array($this->id_pegawai, explode(',',$row->pt_penugasan))){
							echo '<div class="alert alert-warning mb-0 d-flex justify-content-between align-items-center mt-1 pt-25">
									<blockquote class="blockquote ps-1 py-1 border-start-warning border-start-3">
										<small><a href="' . base_url('data/auditor/kertas_kerja/attachment/' . $row->berkas_nhp) . '" target="_blank"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-paperclip font-small-3 align-middle me-0">
													<path d="M21.44 11.05l-9.19 9.19a6 6 0 0 1-8.49-8.49l9.19-9.19a4 4 0 0 1 5.66 5.66l-9.2 9.19a2 2 0 0 1-2.83-2.83l8.49-8.48">
													</path>
												</svg>
												'.$row->judul_nhp.'</a></small>
										<footer class="blockquote-footer">Berkas NHP - ' . tgl_indo_full($row->tanggal_nhp) . '</footer>
									</blockquote>
									<a href="#" class="text-body" data-bs-toggle="modal" data-bs-target="#modals-slide-in" onclick="verifikasi_nhp('.$row->id_pekerjaan.')"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-square font-medium-5"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>Verifikasi</a>
								</div>';

						}
					} elseif ($row->status_nhp == "N") {
						echo '	<div class="alert alert-danger" role="alert">
									<div class="alert-body"><strong>Status:</strong> Berkas NHP ditolak.</div>
								</div>';
					} elseif ($row->status_nhp == "Y") {
						echo '	<div class="alert alert-primary" role="alert">
									<div class="alert-body"><strong>Status:</strong> NHP sudah disetujui.</div>
								</div>';
						echo '	<blockquote class="blockquote ps-1 border-start-primary border-start-3">
									<small><a href="' . base_url('data/auditor/kertas_kerja/attachment/' . $row->berkas_nhp) . '"
											target="_blank"><svg width="24" height="24" viewBox="0 0 24 24"
												fill="none" stroke="currentColor" stroke-width="2"
												stroke-linecap="round" stroke-linejoin="round"
												class="feather feather-paperclip font-small-3 align-middle me-0">
												<path
													d="M21.44 11.05l-9.19 9.19a6 6 0 0 1-8.49-8.49l9.19-9.19a4 4 0 0 1 5.66 5.66l-9.2 9.19a2 2 0 0 1-2.83-2.83l8.49-8.48">
												</path>
											</svg> '.$row->judul_nhp.'</a></small>
									<footer class="blockquote-footer">Berkas NHP - ' . tgl_indo_full($row->tanggal_nhp) . '
									</footer>
								</blockquote>';
					}
				}
				if ($group == "lhp") {
					if ($row->memiliki_nhp == 'N') {
						echo '	<div class="alert alert-dark" role="alert">
									<div class="alert-body"><strong>Status:</strong> Tidak memiliki LHP.</div>
								</div>';
					} elseif (empty($row->berkas_lhp) OR $row->status_lhp == NULL) {
						echo '	<div class="alert alert-danger" role="alert">
									<div class="alert-body"><strong>Status:</strong> Berkas LHP belum diupload.</div>
								</div>';
					} elseif ($row->status_lhp == "P") {
						echo '	<div class="alert alert-secondary" role="alert">
									<div class="alert-body"><strong>Status:</strong> LHP sedang tahap verifikasi.</div>
								</div>';
						if (in_array($this->id_pegawai, explode(',',$row->ppj_penugasan)) AND $row->status_nhp == "Y"){
							echo '<div class="alert alert-warning mb-0 d-flex justify-content-between align-items-center mt-1 pt-25">
									<blockquote class="blockquote ps-1 py-1 border-start-warning border-start-3">
										<small><a href="' . base_url('data/auditor/kertas_kerja/attachment/' . $row->berkas_lhp) . '" target="_blank"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-paperclip font-small-3 align-middle me-0">
													<path d="M21.44 11.05l-9.19 9.19a6 6 0 0 1-8.49-8.49l9.19-9.19a4 4 0 0 1 5.66 5.66l-9.2 9.19a2 2 0 0 1-2.83-2.83l8.49-8.48">
													</path>
												</svg>
												'.$row->judul_lhp.'</a></small>
										<footer class="blockquote-footer">Berkas LHP - ' . tgl_indo_full($row->tanggal_lhp) . '</footer>
									</blockquote>
									<a href="#" class="text-body" data-bs-toggle="modal" data-bs-target="#modals-slide-in" onclick="verifikasi_lhp('.$row->id_pekerjaan.')"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-square font-medium-5"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>Verifikasi</a>
								</div>';

						}
					} elseif ($row->status_lhp == "N") {
						echo '	<div class="alert alert-danger" role="alert">
									<div class="alert-body"><strong>Status:</strong> Berkas LHP ditolak.</div>
								</div>';
					} elseif ($row->status_lhp == "Y") {
						echo '	<div class="alert alert-primary" role="alert">
									<div class="alert-body"><strong>Status:</strong> LHP sudah disetujui.</div>
								</div>';
						if($row->tanggal_lhp > $row->tanggal_batas_lhp){
						echo '	<div class="alert alert-danger" role="alert">
									<div class="alert-body">Pelaporan LHP telah melewati batas tanggal yang sudah ditetapkan.</div>
								</div>';
						} else {
						echo '	<div class="alert alert-primary" role="alert">
									<div class="alert-body">Pelaporan LHP sudah tepat waktu.</div>
								</div>';
						}
						echo '	<blockquote class="blockquote ps-1 border-start-primary border-start-3">
									<small><a href="' . base_url('data/auditor/kertas_kerja/attachment/' . $row->berkas_lhp) . '"
											target="_blank"><svg width="24" height="24" viewBox="0 0 24 24"
												fill="none" stroke="currentColor" stroke-width="2"
												stroke-linecap="round" stroke-linejoin="round"
												class="feather feather-paperclip font-small-3 align-middle me-0">
												<path
													d="M21.44 11.05l-9.19 9.19a6 6 0 0 1-8.49-8.49l9.19-9.19a4 4 0 0 1 5.66 5.66l-9.2 9.19a2 2 0 0 1-2.83-2.83l8.49-8.48">
												</path>
											</svg> '.$row->judul_lhp.'</a></small>
									<footer class="blockquote-footer">Berkas LHP - ' . tgl_indo_full($row->tanggal_lhp) . '
									</footer>
								</blockquote>';
					}
				}
			}
		} else {
			echo "Akses Tidak Diperbolehkan.";
		}
	}

	function add_aktifitas()
	{
		if ($this->user_id) {
			$meta = $this->input->post(NULL, TRUE);
			$meta['group'] = "aktifitas";
			$meta['type'] = "comment";
			$nama_user = ($this->session->userdata('nama_lengkap')) ? $this->session->userdata('nama_lengkap') : $this->session->userdata('full_name');
			$meta['komentar_aktifitas'] = base64_encode('<span class="fw-bold">' . $nama_user . '</span>' . str_replace('<img ', '<img class="img-fluid rounded"', $this->input->post('komentar_aktifitas', FALSE)));
			$meta['id_pegawai'] = ($this->id_pegawai) ? $this->id_pegawai : 0;
			if (trim($this->input->post('komentar_aktifitas', FALSE)) == "<p><br></p>") {
				$meta['komentar_aktifitas'] = base64_encode('<span class="fw-bold">' . $nama_user . '</span>');
			}

			$config['upload_path'] = './data/auditor/kertas_kerja/attachment/';
			$config['allowed_types'] = 'gif|jpeg|jpg|png|pdf|xls|xlsx|doc|docx|ppt|pptx|pptm|zip';
			$config['max_size'] = 20000;
			$config['encrypt_name'] = TRUE;

			$this->load->library('upload', $config);

			if (!$this->upload->do_upload('berkas_aktifitas')) {
				$resp['error'] = false;
				$resp['error_msg'] = "File Gagal Diunggah: " . $this->upload->display_errors('', '');
			} else {
				$resp['error'] = false;
				$resp['error_msg'] = "";
				$meta['berkas_aktifitas'] = $this->upload->data('file_name');
				$meta['type'] = "attachment";
			}
			$resp['board_id'] = $meta['board_id'];
			$submit = $this->auditor_model->add_aktifitas($meta);
		} else {
			$resp['error'] = true;
			$resp['error_msg'] = "Akses Tidak Diperbolehkan.";
		}
		echo json_encode($resp);
	}

	function add_aktifitas_nhp()
	{
		if ($this->user_id) {
			$meta = $this->input->post(NULL, TRUE);
			$data['board_id'] = $meta['board_id'];
			$data['memiliki_nhp'] = "Y";
			$data['judul_nhp'] = $meta['judul_nhp'];
			$data['tanggal_nhp'] = $meta['tanggal_nhp'];
			$data['status_nhp'] = "P";
			$data['status_lhp'] = NULL;
			unset($meta['judul_nhp']);
			unset($meta['tanggal_nhp']);

			$meta['group'] = "nhp";
			$meta['type'] = "attachment";
			$nama_user = ($this->session->userdata('nama_lengkap')) ? $this->session->userdata('nama_lengkap') : $this->session->userdata('full_name');
			$meta['komentar_aktifitas'] = base64_encode('<span class="fw-bold">' . $nama_user . '</span>');
			$meta['id_pegawai'] = ($this->id_pegawai) ? $this->id_pegawai : 0;

			$config['upload_path'] = './data/auditor/kertas_kerja/attachment/';
			$config['allowed_types'] = 'gif|jpeg|jpg|png|pdf|xls|xlsx|doc|docx|ppt|pptx|pptm|zip';
			$config['max_size'] = 20000;
			$config['encrypt_name'] = TRUE;

			$this->load->library('upload', $config);

			if (!$this->upload->do_upload('berkas_nhp')) {
				$resp['error'] = false;
				$resp['error_msg'] = "File Gagal Diunggah: " . $this->upload->display_errors('', '');
			} else {
				$resp['error'] = false;
				$resp['error_msg'] = "";
				$meta['berkas_aktifitas'] = $this->upload->data('file_name');
				$meta['type'] = "attachment";
				$data['berkas_nhp'] = $this->upload->data('file_name');
			}
			$resp['board_id'] = $set['board_id'] = $meta['board_id'];
			$submit = $this->auditor_model->add_aktifitas($meta);
			$update = $this->auditor_model->update_pekerjaan($data);
			$set['board_position'] = "board-in-progres";
			$move = $this->auditor_model->move_pekerjaan($set);
		} else {
			$resp['error'] = true;
			$resp['error_msg'] = "Akses Tidak Diperbolehkan.";
		}
		echo json_encode($resp);
	}

	function tidak_memiliki_nhp()
	{
		if ($this->user_id) {
			$meta = $this->input->post(NULL, TRUE);

			$data['board_id'] = $meta['board_id'];
			$resp['error'] = false;
			$resp['error_msg'] = "";
			$verse = array(
				'board_id' => $meta['board_id'],
				'memiliki_nhp' => 'N',
				'tanggal_nhp' => NULL,
				'berkas_nhp' => NULL,
				'status_nhp' => NULL,
				'tanggal_lhp' => NULL,
				'berkas_lhp' => NULL,
			);
			$submit = $this->auditor_model->update_pekerjaan($verse);
			unset($verse);

			//log aktifitas
			if ($submit) {
				$set['board_id'] = $meta['board_id'] ;
				$set['board_position'] = "board-done";
				$move = $this->auditor_model->move_pekerjaan($set);
				$verse['type'] = "system";
				$verse['group'] = "nhp";
				$nama_user = ($this->session->userdata('nama_lengkap')) ? $this->session->userdata('nama_lengkap') : $this->session->userdata('full_name');
				$verse['komentar_aktifitas'] = base64_encode('<blockquote class="blockquote"><footer class="blockquote-footer text-dark"><span class="fw-bolder">' . $nama_user . '</span> menandai kertas kerja menjadi <span class="text-primary">Tidak memiliki NHP</span>.</footer></blockquote>');
				$verse['id_pegawai'] = ($this->id_pegawai) ? $this->id_pegawai : 0;
				$verse['board_id'] = $meta['board_id'];
				$submit = $this->auditor_model->add_aktifitas($verse);
			}
		} else {
			$meta = $this->input->post(NULL, TRUE);

			$data['board_id'] = $meta['board_id'];
			$resp['error'] = true;
			$resp['error_msg'] = "Akses Tidak Diperbolehkan.";
		}
		echo json_encode($resp);
	}

	function add_aktifitas_lhp()
	{
		if ($this->user_id) {
			$meta = $this->input->post(NULL, TRUE);
			$data['board_id'] = $meta['board_id'];
			$data['judul_lhp'] = $meta['judul_lhp'];
			$data['tanggal_lhp'] = $meta['tanggal_lhp'];
			$data['status_lhp'] = "P";
			$data['aspek_temuan'] = implode(',', $meta['aspek_temuan']);
			if (in_array("Administrasi Keuangan", $meta['aspek_temuan'])) {
				$data['jumlah_kerugian'] = $meta['jumlah_kerugian'];
				$data['disetor_kerugian'] = $meta['disetor_kerugian'];
				$data['jumlah_kewajiban'] = $meta['jumlah_kewajiban'];
				$data['disetor_kewajiban'] = $meta['disetor_kewajiban'];
			} else {
				$data['jumlah_kerugian'] = 0;
				$data['disetor_kerugian'] = 0;
				$data['jumlah_kewajiban'] = 0;
				$data['disetor_kewajiban'] = 0;
			}
			$data['jumlah_temuan'] = 0;
			$data['jumlah_rekomendasi'] = 0;
			foreach ($meta['aspek_temuan'] as $label) {
				$jenis = get_aspek('jenis',$label);
				$data['jumlah_temuan'] += $meta['jumlah_temuan'][$jenis];
				$data['jumlah_rekomendasi'] += $meta['jumlah_rekomendasi'][$jenis];
			}
			$temp['aspek_temuan'] = $meta['aspek_temuan'];
			$temp['jumlah_temuan'] = $meta['jumlah_temuan'];
			$temp['jumlah_rekomendasi'] = $meta['jumlah_rekomendasi'];
			unset($meta['judul_lhp']);
			unset($meta['tanggal_lhp']);
			unset($meta['aspek_temuan']);
			unset($meta['jumlah_kerugian']);
			unset($meta['disetor_kerugian']);
			unset($meta['jumlah_kewajiban']);
			unset($meta['disetor_kewajiban']);
			unset($meta['jumlah_temuan']);
			unset($meta['jumlah_rekomendasi']);

			$meta['group'] = "lhp";
			$meta['type'] = "attachment";
			$nama_user = ($this->session->userdata('nama_lengkap')) ? $this->session->userdata('nama_lengkap') : $this->session->userdata('full_name');
			$meta['komentar_aktifitas'] = base64_encode('<span class="fw-bold">' . $nama_user . '</span>');
			$meta['id_pegawai'] = ($this->id_pegawai) ? $this->id_pegawai : 0;

			$config['upload_path'] = './data/auditor/kertas_kerja/attachment/';
			$config['allowed_types'] = 'gif|jpeg|jpg|png|pdf|xls|xlsx|doc|docx|ppt|pptx|pptm|zip';
			$config['max_size'] = 20000;
			$config['encrypt_name'] = TRUE;

			$this->load->library('upload', $config);

			if (!$this->upload->do_upload('berkas_lhp')) {
				$resp['error'] = false;
				$resp['error_msg'] = "File Gagal Diunggah: " . $this->upload->display_errors('', '');
			} else {
				$resp['error'] = false;
				$resp['error_msg'] = "";
				$meta['berkas_aktifitas'] = $this->upload->data('file_name');
				$meta['type'] = "attachment";
				$data['berkas_lhp'] = $this->upload->data('file_name');
			}
			$resp['board_id'] = $set['board_id'] = $meta['board_id'];
			$submit = $this->auditor_model->add_aktifitas($meta);
			$update = $this->auditor_model->update_pekerjaan($data);
			$set['board_position'] = "board-in-review";
			$move = $this->auditor_model->move_pekerjaan($set);
			$reset = $this->auditor_model->reset_aspek($resp);
			foreach ($temp['aspek_temuan'] as $label) {
				$jenis = get_aspek('jenis',$label);
				$verse['board_id'] = $meta['board_id'];
				$verse['jenis'] = $jenis;
				$verse['label'] = $label;
				$verse['temuan'] = $temp['jumlah_temuan'][$jenis];
				$verse['rekomendasi'] = $temp['jumlah_rekomendasi'][$jenis];
				$add = $this->auditor_model->add_aspek($verse);
				unset($verse);
			}

		} else {
			$resp['error'] = true;
			$resp['error_msg'] = "Akses Tidak Diperbolehkan.";
		}
		echo json_encode($resp);
	}

	function get_pekerjaan($id = NULL)
	{
		if ($this->user_id) {
			$resp['pekerjaan'] = $this->auditor_model->get_detail_pekerjaan($id);
			$resp['error'] = false;
			$resp['error_msg'] = "";
		} else {
			$resp['error'] = true;
			$resp['error_msg'] = "Akses Tidak Diperbolehkan.";
		}
		echo json_encode($resp);
	}

	function submit_verifikasi()
	{
		if ($this->user_id) {
			$meta = $this->input->post(NULL, TRUE);

			$data['board_id'] = $meta['board_id'];
			$resp['error'] = false;
			$resp['error_msg'] = "";
			$verse['board_id'] = $set['board_id'] = $meta['board_id'];
			if ($meta['jenis'] == 'nhp') {
				if ($meta['verifikasi'] == 'terima') {
					$verse['status_nhp'] = "Y";
					$set['board_position'] = "board-in-review";
				} elseif ($meta['verifikasi'] == 'tolak') {
					$verse['status_nhp'] = "N";
				}
			} elseif ($meta['jenis'] == 'lhp') {
				if ($meta['verifikasi'] == 'terima') {
					$verse['status_lhp'] = "Y";
					$set['board_position'] = "board-done";
				} elseif ($meta['verifikasi'] == 'tolak') {
					$verse['status_lhp'] = "N";
				}
			}
			$submit = $this->auditor_model->update_pekerjaan($verse);
			$move = $this->auditor_model->move_pekerjaan($set);
			unset($verse);

			//log aktifitas
			if ($submit) {
				if ($meta['jenis'] == 'nhp') {
					$verse['type'] = "system";
					$verse['group'] = "nhp";
					$nama_user = ($this->session->userdata('nama_lengkap')) ? $this->session->userdata('nama_lengkap') : $this->session->userdata('full_name');
					$verse['board_id'] = $meta['board_id'];
					if ($meta['verifikasi'] == 'terima') {
						$verse['komentar_aktifitas'] = base64_encode('<blockquote class="blockquote"><footer class="blockquote-footer text-dark"><span class="fw-bolder">' . $nama_user . '</span> sudah <span class="text-primary">menyetujui</span> berkas NHP.</footer></blockquote>');
					} elseif ($meta['verifikasi'] == 'tolak') {
						$alasan_penolakan = ($meta['alasan_penolakan']) ? '<blockquote class="blockquote ps-1 border-start-danger border-start-3"><small>' . $meta['alasan_penolakan'] . '</small></blockquote>' : '';
						$verse['komentar_aktifitas'] = base64_encode('<blockquote class="blockquote"><footer class="blockquote-footer text-dark"><span class="fw-bolder">' . $nama_user . '</span> telah <span class="text-danger">menolak</span> berkas NHP.</footer></blockquote>' . $alasan_penolakan);
					}
					$verse['id_pegawai'] = ($this->id_pegawai) ? $this->id_pegawai : 0;
					$verse['board_id'] = $meta['board_id'];
					$submit = $this->auditor_model->add_aktifitas($verse);
				} elseif ($meta['jenis'] == 'lhp') {
					$verse['type'] = "system";
					$verse['group'] = "lhp";
					$nama_user = ($this->session->userdata('nama_lengkap')) ? $this->session->userdata('nama_lengkap') : $this->session->userdata('full_name');
					$verse['board_id'] = $meta['board_id'];
					if ($meta['verifikasi'] == 'terima') {
						$verse['komentar_aktifitas'] = base64_encode('<blockquote class="blockquote"><footer class="blockquote-footer text-dark"><span class="fw-bolder">' . $nama_user . '</span> sudah <span class="text-primary">menyetujui</span> berkas LHP.</footer></blockquote>');
					} elseif ($meta['verifikasi'] == 'tolak') {
						$alasan_penolakan = ($meta['alasan_penolakan']) ? '<blockquote class="blockquote ps-1 border-start-danger border-start-3"><small>' . $meta['alasan_penolakan'] . '</small></blockquote>' : '';
						$verse['komentar_aktifitas'] = base64_encode('<blockquote class="blockquote"><footer class="blockquote-footer text-dark"><span class="fw-bolder">' . $nama_user . '</span> telah <span class="text-danger">menolak</span> berkas LHP.</footer></blockquote>' . $alasan_penolakan);
					}
					$verse['id_pegawai'] = ($this->id_pegawai) ? $this->id_pegawai : 0;
					$verse['board_id'] = $meta['board_id'];
					$submit = $this->auditor_model->add_aktifitas($verse);
				}
			}
		} else {
			$resp['error'] = true;
			$resp['error_msg'] = "Akses Tidak Diperbolehkan.";
		}
		echo json_encode($resp);
	}

	public function index()
	{
		if ($this->user_id and ($this->user_level == "Administrator" or $this->session->userdata('id_skpd') == $this->id_inspektorat)) {
			redirect('auditor/pkpt');
		} else {
			redirect('admin');
		}
	}
}