<?php
include_once(APPPATH . "third_party/Common/Autoloader.php");
include_once(APPPATH . "third_party/PhpWord/Autoloader.php");
include_once(APPPATH . "third_party/HTMLtoOpenXML/src/Parser.php");
include_once(APPPATH . "third_party/HTMLtoOpenXML/src/Scripts/HTMLCleaner.php");
include_once(APPPATH . "third_party/HTMLtoOpenXML/src/Scripts/ProcessProperties.php");
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

class Surat_eksternal extends CI_Controller
{
	public $user_id;

	public function __construct()
	{
		parent::__construct();
		$this->user_id = $this->session->userdata('user_id');
		$this->load->model('user_model');
		$this->user_model->user_id = $this->user_id;
		$this->user_model->set_user_by_user_id();
		$this->user_picture = $this->user_model->user_picture;
		$this->full_name = $this->user_model->full_name;
		$this->user_level = $this->user_model->level;
		$this->id_pegawai = $this->user_model->id_pegawai;
		$this->user_privileges = explode(";", $this->session->userdata('user_privileges'));
		$this->load->model('ref_skpd_model');
		$this->load->model('ref_surat_model');
		$this->load->model('surat_masuk_model');
		$this->load->model('surat_keluar_model');
		$this->load->model('logs_model');

		$this->load->model('notification_model');
		$this->load->model('data_model');


		$this->level_id = $this->user_model->level_id;

		$this->load->model('master_pegawai_model');
		$sekda = $this->master_pegawai_model->get_pegawai_kepala_skpd(1);
		if ($sekda) {
			$id_pegawai_sekda = $sekda->id_pegawai;
		} else {
			$id_pegawai_sekda = 77;
		}

		$this->id_pegawai_sekda = $id_pegawai_sekda;
		// if ($this->level_id > 2) redirect("admin");

		$this->load->library('socketio', array('host' => "e-office.sumedangkab.go.id", 'port' => 3000));
		$this->load->library('splpjabar', ['clientId' => '5djCAeA9fCW6TrLQqDbTtyhZufMa', 'clientSecret' => 'weM6Tf_mIEHucn0ILgIVCcDYmEAa']);
	}


	public function i()
	{
		echo $this->id_pegawai_sekda;
	}
	public function get_induk()
	{
		$obj = "";
		if (!empty($_POST['id_induk'])) {
			$id_induk = $_POST['id_induk'] == 9999 ? 0 : $_POST['id_induk'];
			$data = $this->skpd_model->get_induk($id_induk);
			if (!empty($data))
				$obj = "<option value='' selected>Pilih</option>";
			foreach ($data as $row) {
				$obj .= "<option value=" . $row->kd_skpd . ">" . $row->nama_skpd . "</option>";
			}
		}
		die($obj);
	}
	public function index()
	{
		if ($this->user_id) {

			show_404();
			// $data['title']		= "Surat eksternal";
			// $data['content']	= "surat_eksternal/masuk/index" ;
			// $data['user_picture'] = $this->user_picture;
			// $data['full_name']		= $this->full_name;
			// $data['user_level']		= $this->user_level;
			// $data['active_menu'] = "surat_eksternal";
			// $this->load->view('admin/index',$data);
			//

		} else {
			redirect('admin');
		}
	}


	public function view()
	{
		if ($this->user_id) {
			$data['title'] = "skpd - Admin ";
			$data['content'] = "renstra/perencanaan/view";
			$data['user_picture'] = $this->user_picture;
			$data['full_name'] = $this->full_name;
			$data['user_level'] = $this->user_level;
			$data['active_menu'] = "ref_skpd";
			$this->load->view('admin/index', $data);
		} else {
			redirect('admin');
		}
	}

	//Surat Masuk

	public function surat_masuk()
	{
		if ($this->user_id) {
			$data['title'] = "Surat eksternal";
			$data['content'] = "surat_eksternal/masuk/index";
			$data['user_picture'] = $this->user_picture;
			$data['full_name'] = $this->full_name;
			$data['user_level'] = $this->user_level;
			$data['active_menu'] = "surat_eksternal";
			$hal = 6;
			$page = isset($_GET["page"]) ? (int) $_GET["page"] : 1;
			$mulai = ($page > 1) ? ($page * $hal) - $hal : 0;
			$total = count($this->surat_masuk_model->get_all_eksternal());
			$data['pages'] = ceil($total / $hal);
			$data['current'] = $page;
			if (!empty($_POST)) {
				$filter = $_POST;
				$data['filter'] = true;
				$data['filter_data'] = $_POST;
			} else {
				$filter = '';
				$data['filter'] = false;
			}
			$data['total'] = $this->surat_masuk_model->get_all_eksternal();
			$data['unread'] = $this->surat_masuk_model->get_all_eksternal_unread();
			$data['read'] = $this->surat_masuk_model->get_all_eksternal_read();
			$data['mustread'] = $this->surat_masuk_model->get_all_eksternal_mustread();
			$data['list'] = $this->surat_masuk_model->get_page_eksternal($mulai, $hal, $filter);

			$this->load->view('admin/index', $data);
		} else {
			redirect('admin');
		}
	}


	public function surat_masuk_verifikasi()
	{
		if ($this->user_id) {
			$data['title'] = "Verifikasi Surat Masuk";
			$data['content'] = "surat_eksternal/masuk/verifikasi";
			$data['user_picture'] = $this->user_picture;
			$data['full_name'] = $this->full_name;
			$data['user_level'] = $this->user_level;
			$data['active_menu'] = "surat_eksternal";
			$hal = 6;
			$page = isset($_GET["page"]) ? (int) $_GET["page"] : 1;
			$mulai = ($page > 1) ? ($page * $hal) - $hal : 0;
			$total = count($this->surat_masuk_model->get_all_eksternal());
			$data['pages'] = ceil($total / $hal);
			$data['current'] = $page;
			if (!empty($_POST)) {
				$filter = $_POST;
				$data['filter'] = true;
				$data['filter_data'] = $_POST;
			} else {
				$filter = '';
				$data['filter'] = false;
			}
			$data['total'] = $this->surat_masuk_model->get_all_eksternal();
			$data['unread'] = $this->surat_masuk_model->get_all_eksternal_unread();
			$data['read'] = $this->surat_masuk_model->get_all_eksternal_read();
			$data['mustread'] = $this->surat_masuk_model->get_all_eksternal_mustread();
			$data['list'] = $this->surat_masuk_model->get_page_verifikasi($mulai, $hal, $filter);

			$this->load->view('admin/index', $data);
		} else {
			redirect('admin');
		}
	}



	public function tambah_surat_masuk($testing = "")
	{
		if ($this->user_id) {
			$this->load->model('surat_masuk_model');
			$data['title'] = "Surat eksternal";
			$data['content'] = "surat_eksternal/masuk/add";
			$data['user_picture'] = $this->user_picture;
			$data['full_name'] = $this->full_name;
			$data['user_level'] = $this->user_level;

			$data['active_menu'] = "surat_eksternal";
			$this->load->helper('form');
			if (!empty($_POST)) {
				$not_required = array('lokasi_smpl', 'lokasi_box', 'lokasi_rak', 'catatan');
				$cekform = isFormEmpty($not_required, $_POST);

				if (!$cekform) {
					$config['upload_path'] = './data/surat_eksternal/surat_masuk/';
					$config['allowed_types'] = 'pdf|jpg|jpeg|png|doc|docx';
					$config['max_size'] = 1024 * 5;
					$config['max_width'] = 2000;
					$config['max_height'] = 2000;

					$this->load->library('upload', $config);
					if (!$this->upload->do_upload('file_surat')) {
						$data['message_type'] = "warning";
						$data['message'] = $this->upload->display_errors();
					} else {
						$data['message'] = "";
						$this->surat_masuk_model->file_surat = $this->upload->data('file_name');
					}
					if ($_FILES['lampiran']['name'] !== "") {
						$config['upload_path'] = './data/surat_eksternal/lampiran/';
						$config['allowed_types'] = 'pdf|jpg|jpeg|png|doc|docx';
						$config['max_size'] = 2000;
						$config['max_width'] = 2000;
						$config['max_height'] = 2000;
						$this->load->library('upload', $config);
						if (!$this->upload->do_upload('lampiran')) {
							$data['message_type'] = "warning";
							$data['message'] .= $this->upload->display_errors();
						} else {
							$data['message'] .= "";
							$this->surat_masuk_model->lampiran = $this->upload->data('file_name');
						}
					}

					if (!$data['message']) {

						$penerima_surat = $_POST['id_pegawai_penerima'];
						if (!empty($penerima_surat)) {
							foreach ($penerima_surat as $ps) {
								$check_dewan = explode('_', $ps);
								if ($check_dewan[0] == 'dewan') {
									$id_pegawai_penerima = $check_dewan[1];
									$this->load->model('pegawai_dewan_model');
									$data_insert_sm = new stdClass();
									$data_insert_sm->file_surat = $this->surat_masuk_model->file_surat;
									if (!empty($this->surat_masuk_model->lampiran)) {
										$data_insert_sm->lampiran = $this->surat_masuk_model->lampiran;
									}
									$data_insert_sm->jenis_surat = "eksternal";
									$data_insert_sm->indeks = $_POST['indeks'];
									$data_insert_sm->kode = $_POST['kode'];
									$data_insert_sm->no_urut = $_POST['no_urut'];
									$data_insert_sm->perihal = $_POST['perihal'];
									$data_insert_sm->pengirim = $_POST['pengirim'];
									$data_insert_sm->tanggal_surat = $_POST['tanggal_surat'];
									$data_insert_sm->nomer_surat = $_POST['nomer_surat'];
									$data_insert_sm->sifat = $_POST['sifat'];
									$data_insert_sm->lokasi_smpl = $_POST['lokasi_smpl'];
									$data_insert_sm->lokasi_box = $_POST['lokasi_box'];
									$data_insert_sm->lokasi_rak = $_POST['lokasi_rak'];
									$data_insert_sm->isi_ringkasan = $_POST['isi_ringkasan'];
									$data_insert_sm->catatan = $_POST['catatan'];
									$data_insert_sm->id_pegawai_input = $this->session->userdata('id_pegawai');
									$data_insert_sm->tgl_input = date("Y-m-d");
									$data_insert_sm->status_surat = "Belum Dibaca";
									$data_insert_sm->id_skpd_penerima = $_POST['id_skpd_penerima'];
									$data_insert_sm->id_unitkerja_penerima = 0;
									$data_insert_sm->id_pegawai_penerima = $id_pegawai_penerima;
									$this->pegawai_dewan_model->insert_surat_masuk($data_insert_sm);
								} else {
									$this->surat_masuk_model->jenis_surat = "eksternal";
									$this->surat_masuk_model->indeks = $_POST['indeks'];
									$this->surat_masuk_model->kode = $_POST['kode'];
									$this->surat_masuk_model->no_urut = $_POST['no_urut'];

									$this->surat_masuk_model->perihal = $_POST['perihal'];
									$this->surat_masuk_model->pengirim = $_POST['pengirim'];
									$this->surat_masuk_model->tanggal_surat = $_POST['tanggal_surat'];
									$this->surat_masuk_model->nomer_surat = $_POST['nomer_surat'];
									$this->surat_masuk_model->sifat = $_POST['sifat'];
									$this->surat_masuk_model->lokasi_smpl = $_POST['lokasi_smpl'];
									$this->surat_masuk_model->lokasi_box = $_POST['lokasi_box'];
									$this->surat_masuk_model->lokasi_rak = $_POST['lokasi_rak'];
									$this->surat_masuk_model->isi_ringkasan = $_POST['isi_ringkasan'];

									$this->surat_masuk_model->catatan = $_POST['catatan'];
									$this->surat_masuk_model->id_pegawai_input = $this->session->userdata('id_pegawai');
									$this->surat_masuk_model->tgl_input = date("Y-m-d");
									$this->surat_masuk_model->status_surat = "Belum Dibaca";
									$this->surat_masuk_model->id_skpd_penerima = $_POST['id_skpd_penerima'];
									$this->surat_masuk_model->id_unitkerja_penerima = $this->surat_masuk_model->get_id_unit_kerja_by_pegawai($ps);
									$this->surat_masuk_model->id_pegawai_penerima = $ps;
									$this->surat_masuk_model->insert_surat_masuk_ekternal();
								}
							}
							$data['message_type'] = "success";
							$data['message'] = "Surat Masuk berhasil ditambahkan.";


							$log_data = array(
								'action' => 'menambahkan',
								'function' => 'surat masuk eksternal',
								'key_name' => 'nomor surat',
								'key_value' => $_POST['indeks'] . "/" . $_POST['kode'] . "/" . $_POST['no_urut'],
								'category' => $this->uri->segment(1),
							);
							$this->logs_model->insert_log($log_data);
						}
					}
				} else {
					$data['message_type'] = "warning";
					$data['message'] = "<strong>Opps..</strong> Data belum lengkap, silahkan lengkapi dulu!";
				}
			}

			$this->load->model('pegawai_model');
			$data['unit_kerja'] = $this->surat_masuk_model->get_all_unit_kerja_by_skpd($this->session->userdata('id_skpd'));
			$data['uk_bupati'] = $this->surat_masuk_model->get_all_unit_kerja_by_skpd(33);
			array_push($data['unit_kerja'], (object) array('id_unit_kerja' => "0", 'nama_unit_kerja' => 'Kepala SKPD'));
			$a = $this->ref_skpd_model->get_kepala_skpd($this->session->userdata('id_skpd'));

			$lastvalue = end($data['unit_kerja']);
			$lastkey = count($data['unit_kerja']) - 1;

			$arr1 = array($lastkey => $lastvalue);

			array_pop($data['unit_kerja']);

			$arr1 = array_merge($arr1, $data['unit_kerja']);

			$data['unit_kerja'] = $arr1;

			foreach ($data['unit_kerja'] as $u) {
				$data['pegawai'][$u->id_unit_kerja] = $this->surat_masuk_model->get_all_pegawai_by_unit_kerja($u->id_unit_kerja);
				// $data['pegawai'][0] = $this->surat_masuk_model->get_all_pegawai_by_unit_kerja($u->id_unit_kerja);
			}
			foreach ($data['uk_bupati'] as $u) {
				$data['bupati'][$u->id_unit_kerja] = $this->surat_masuk_model->get_all_pegawai_by_unit_kerja($u->id_unit_kerja);
			}

			if ($this->session->userdata('id_skpd') == "3") {
				$this->load->model('pegawai_dewan_model');
				$data['pegawai_dewan'] = $this->pegawai_dewan_model->get_all();
				// print_r($data['pegawai_dewan']);die;
			}

			$urut = $this->surat_masuk_model->get_urutan_surat($this->session->userdata('id_skpd'));
			// $urut = 1;
			$data['urutan'] = str_pad($urut, 4, '0', STR_PAD_LEFT);

			$data['skpd'] = $this->ref_skpd_model->get_by_id($this->session->userdata('id_skpd'));
			$this->load->view('admin/index', $data);
		} else {
			redirect('admin');
		}
	}


	public function edit_surat_masuk($id)
	{
		if ($this->user_id) {
			$this->filter_surat_masuk($id);
			$this->load->model('surat_masuk_model');
			$data['title'] = "Surat eksternal";
			$data['content'] = "surat_eksternal/masuk/edit";
			$data['user_picture'] = $this->user_picture;
			$data['full_name'] = $this->full_name;
			$data['user_level'] = $this->user_level;

			$data['active_menu'] = "surat_eksternal";
			$this->load->helper('form');
			if (!empty($_POST)) {
				if (
					$_POST['perihal'] != ""

				) {
					$config['upload_path'] = './data/surat_eksternal/surat_masuk/';
					$config['allowed_types'] = 'pdf';
					$config['max_size'] = 2000;
					$config['max_width'] = 2000;
					$config['max_height'] = 2000;

					$this->load->library('upload', $config);
					if (!$this->upload->do_upload('file_surat')) {
						$data['message_type'] = "warning";
						$data['message'] = $this->upload->display_errors();
					} else {
						$data['message'] = "";
						$this->surat_masuk_model->file_surat = $this->upload->data('file_name');
					}

					$config['upload_path'] = './data/surat_eksternal/lampiran/';
					$config['allowed_types'] = 'pdf|jpg|jpeg|png';
					$config['max_size'] = 2000;
					$config['max_width'] = 2000;
					$config['max_height'] = 2000;

					$this->load->library('upload', $config);
					if (!$this->upload->do_upload('lampiran')) {
						$data['message_type'] = "warning";
						$data['message'] .= $this->upload->display_errors();
					} else {
						$data['message'] .= "";
						$this->surat_masuk_model->lampiran = $this->upload->data('file_name');
					}

					if (!$data['message']) {

						$this->surat_masuk_model->jenis_surat = "eksternal";
						$this->surat_masuk_model->indeks = $_POST['indeks'];
						$this->surat_masuk_model->kode = $_POST['kode'];
						$this->surat_masuk_model->no_urut = $_POST['no_urut'];

						$this->surat_masuk_model->perihal = $_POST['perihal'];
						$this->surat_masuk_model->pengirim = $_POST['pengirim'];
						$this->surat_masuk_model->tanggal_surat = $_POST['tanggal_surat'];
						$this->surat_masuk_model->nomer_surat = $_POST['nomer_surat'];
						$this->surat_masuk_model->sifat = $_POST['sifat'];
						$this->surat_masuk_model->lokasi_smpl = $_POST['lokasi_smpl'];
						$this->surat_masuk_model->lokasi_box = $_POST['lokasi_box'];
						$this->surat_masuk_model->lokasi_rak = $_POST['lokasi_rak'];
						$this->surat_masuk_model->isi_ringkasan = $_POST['isi_ringkasan'];

						$this->surat_masuk_model->catatan = $_POST['catatan'];
						$this->surat_masuk_model->id_pegawai_input = $this->user_id;
						$this->surat_masuk_model->tgl_input = date("Y-m-d");
						$this->surat_masuk_model->status_surat = "Belum Dibaca";
						$this->surat_masuk_model->id_skpd_penerima = $_POST['id_skpd_penerima'];
						$this->surat_masuk_model->id_unitkerja_penerima = $_POST['id_unitkerja_penerima'];
						$this->surat_masuk_model->id_pegawai_penerima = $_POST['id_pegawai_penerima'];



						$this->surat_masuk_model->insert_surat_masuk_ekternal();
						$data['message_type'] = "success";
						$data['message'] = "Surat Masuk berhasil ditambahkan.";


						$detail = $this->surat_masuk_model->get_detail_by_id($id);
						$log_data = array(
							'action' => 'memperbarui',
							'function' => 'surat masuk eksternal',
							'key_name' => 'nomor surat',
							'key_value' => $detail->indeks . "/" . $detail->kode . "/" . $detail->no_urut,
							'category' => $this->uri->segment(1),
						);
						$this->logs_model->insert_log($log_data);
					}
				} else {
					$data['message_type'] = "warning";
					$data['message'] = "<strong>Opps..</strong> Data belum lengkap, silahkan lengkapi dulu!";
				}
			}

			$data['detail'] = $this->surat_masuk_model->get_detail_by_id($id);

			$data['skpd'] = $this->ref_skpd_model->get_all();




			$this->load->view('admin/index', $data);
		} else {
			redirect('admin');
		}
	}





	public function detail_surat_masuk($id)
	{
		if ($this->user_id) {
			$this->filter_surat_masuk($id);


			$read = $this->notification_model->read('surat_eksternal/detail_surat_masuk', $id, $this->session->userdata('user_id'));
			if ($read) {
				$this->socketio->send('refresh_notification', array('user_id' => $this->session->userdata('user_id')));
			}

			$data['title'] = "detail Surat - Admin ";
			$data['content'] = "surat_eksternal/masuk/detail";
			$data['user_picture'] = $this->user_picture;
			$data['full_name'] = $this->full_name;
			$data['user_level'] = $this->user_level;
			$data['active_menu'] = "surat eksternal/detail";

			$data['detail'] = $this->surat_masuk_model->get_detail_by_id($id);
			if (!file_exists('./data/surat_eksternal/surat_masuk/' . $data['detail']->file_surat)) {
				if (file_exists('./data/surat_eksternal/ttd/' . $data['detail']->file_surat)) {
					copy('./data/surat_eksternal/ttd/' . $data['detail']->file_surat, './data/surat_eksternal/surat_masuk/' . $data['detail']->file_surat);
				}
			}
			if (!empty($_POST)) {
				$post_data = $_POST;
				if (isset($post_data['unit_kerja'])) {
					$unit_kerja = $post_data['unit_kerja'];
					unset($post_data['unit_kerja']);
				} else {
					$unit_kerja = array();
				}
				if (isset($post_data['pegawai'])) {
					$pegawai = $post_data['pegawai'];
					unset($post_data['pegawai']);
				} else {
					$pegawai = array();
				}

				if (isset($post_data['skpd'])) {
					$skpd = $post_data['skpd'];
					unset($post_data['skpd']);
				} else {
					$skpd = array();
				}
				unset($post_data['instruksi']);
				$post_data['instruksi'] = implode(";", $_POST['instruksi']);

				$post_data['id_surat_masuk'] = $id;
				$detail_surat_masuk = $this->surat_masuk_model->get_detail_by_id($id);
				$post_data['status_surat'] = "Belum Dibaca";
				$post_data['id_pegawai_disposisi'] = $this->session->userdata('id_pegawai');

				$delete = $this->surat_masuk_model->delete_disposisi($post_data);

				$post_data['jenis_penerima_disposisi'] = "internal";
				foreach ($pegawai as $key) {
					$expl_id = explode('-', $key);
					$post_data['id_unit_kerja'] = $expl_id[0];
					$post_data['id_pegawai'] = $expl_id[1];
					$query = $this->surat_masuk_model->add_disposisi($post_data);
					// kirim notif ke pegawai disposisi surat
					$this->load->model('user_model');
					$this->user_model->id_pegawai = $post_data['id_pegawai'];
					$usr = $this->user_model->get_by_pegawai();
					$notif_post_data = array();
					$notif_post_data['title'] = 'Disposisi Surat';
					$notif_post_data['message'] = 'Ada disposisi surat baru dengan perihal ' . $detail_surat_masuk->perihal;
					$notif_post_data['data'] = 'surat_disposisi/detail';
					$notif_post_data['data_id'] = $query;
					$notif_post_data['ntime'] = date('H:i:s');
					$notif_post_data['ndate'] = date('Y-m-d');
					$notif_post_data['user_id'] = $usr->user_id;
					$notif_post_data['category'] = 'surat_disposisi/internal';
					$this->notification_model->insert($notif_post_data);
					$notif_post_data['link'] = base_url($notif_post_data['data'] . '/' . $notif_post_data['data_id']);
					$this->socketio->send('new_notification', $notif_post_data);
					$this->socketio->send('refresh_notification', array('user_id' => $notif_post_data['user_id']));
				}

				unset($post_data['id_pegawai']);
				foreach ($unit_kerja as $key) {
					$post_data['id_unit_kerja'] = $key;
					$query = $this->surat_masuk_model->add_disposisi($post_data);
				}

				unset($post_data['id_unit_kerja']);
				$post_data['jenis_penerima_disposisi'] = "eksternal";
				foreach ($skpd as $key) {
					$post_data['id_skpd'] = $key;
					$query = $this->surat_masuk_model->add_disposisi($post_data);
				}
				$data['message'] = "Surat berhasil di disposisikan";
				$data['type'] = 'success';
			}

			if ($data['detail']->id_pegawai_penerima == $this->session->userdata('id_pegawai') and (!$data['detail']->tgl_dibaca or $data['detail']->status_surat == "Belum Dibaca")) {
				$this->surat_masuk_model->baca_surat($id);
			}

			$data['disposisi'] = $this->surat_masuk_model->get_disposisi_surat_masuk_by_id_surat($id);

			$id_skpd = ($this->user_level !== "Administrator") ? $this->session->userdata('id_skpd') : $data['detail']->id_skpd_penerima;
			$this->load->model('ref_skpd_model');

			$data['unit_kerja'] = $this->ref_skpd_model->get_unit_kerja_by_id_skpd($id_skpd);
			// $data['pegawai'][0] = $this->ref_skpd_model->get_pegawai_by_id_unit_kerja(0,$id_skpd);
			foreach ($data['unit_kerja'] as $key => $value) {
				$data['pegawai'][$value->id_unit_kerja] = $this->ref_skpd_model->get_pegawai_by_id_unit_kerja($value->id_unit_kerja, $id_skpd);
			}
			$data['skpd'] = $this->ref_skpd_model->get_skpd_except_this_id_skpd($id_skpd);
			//echo "<pre>";print_r($data);die;


			$data['catatan_disposisi'] = array(
				'Wakili / Hadiri / Terima / Laporkan Hasilnya',
				'Agendakan / Persiapan / Koordinasi',
				'Selesaikan Sesuai Ketentuan / Peraturan yang Berlaku',
				'Pelajari / Telaah / Sarannya',
				'Untuk Ditindaklanjuti / Dipedomani / Dipenuhi sesuai Ketentuan',
				'Untuk Dibantu / Difasilitasi / Dipenuhi sesuai Ketentuan',
				'Untuk Dijawab / Dicatat / FILE',
				'Siapkan Pointer / Sambutan / Bahan Lebih Lanjut',
				'Untuk Dibantu Sesuai Kemampuan dan Ketentuan',
				'ACC, Sesuai Ketentuan yang Berlaku',
				'ACC, Saran Saudara',
				'AMM'
			);

			$this->load->view('admin/index', $data);
		} else {
			redirect('admin');
		}
	}



	public function detail_surat_masuk_verifikasi($id)
	{
		if ($this->user_id) {
			// $this->filter_surat_masuk($id);
			// $read = $this->notification_model->read('surat_eksternal/detail_surat_masuk', $id, $this->session->userdata('user_id'));
			// if ($read) {
			// 	$this->socketio->send('refresh_notification', array('user_id' => $this->session->userdata('user_id')));
			// }

			$data['title'] = "Detail Verifikasi Surat Masuk ";
			$data['content'] = "surat_eksternal/masuk/detail_verifikasi";
			$data['user_picture'] = $this->user_picture;
			$data['full_name'] = $this->full_name;
			$data['user_level'] = $this->user_level;
			$data['active_menu'] = "surat_eksternal/surat_masuk_verifikasi";

			$data['detail'] = $this->surat_masuk_model->get_detail_verifikasi($id);

			// $data['pegawai_teruskan'] = $this->master_pegawai_model->get_by_id_skpd(231);

			$this->load->model('pegawai_dewan_model');
			$data['pegawai_teruskan'] = $this->pegawai_dewan_model->get_all();
			if (!empty($_POST)) {
				$id_pegawai = $_POST['id_pegawai'];
				$terima = $this->surat_masuk_model->terima_verifikasi($id, $id_pegawai);
				if ($terima) {
					$url_surat = 'https://e-officedprd.sumedangkab.go.id/';
					$s = $terima;
					$detail_surat_masuk = $this->surat_masuk_model->get_detail_by_id($s['id_surat_masuk']);
					$notif_data = array();
					$notif_data['title'] = 'Surat Masuk';
					$notif_data['message'] = 'Ada surat masuk baru dengan perihal ' . $detail_surat_masuk->perihal;
					$notif_data['data'] = 'surat_eksternal/detail_surat_masuk';
					$notif_data['data_id'] = $s['id_surat_masuk'];
					$notif_data['ntime'] = date('H:i:s');
					$notif_data['ndate'] = date('Y-m-d');
					$notif_data['user_id'] = $s['id_user'];
					$notif_data['category'] = 'surat_eksternal/surat_masuk';
					$this->notification_model->insert($notif_data);
					$notif_data['link'] = $url_surat . ($notif_data['data'] . '/' . $notif_data['data_id']);
					$this->socketio->send('new_notification', $notif_data);
					$this->socketio->send('refresh_notification', array('user_id' => $notif_data['user_id']));
					$data['message'] = 'Surat sudah diteruskan kepada Penerima';
					$data['type'] = 'success';
				} else {
					$data['message'] = 'Terjadi kesalahan';
					$data['type'] = 'danger';
				}
				// print_r($_POST);die;
			}
			$this->load->view('admin/index', $data);
		} else {
			redirect('admin');
		}
	}

	public function add_disposisi($id_surat_masuk)
	{
		if ($this->user_id) {
			$data = $_POST;


			$unit_kerja = $data['unit_kerja'];
			unset($data['unit_kerja']);
			$pegawai = $data['pegawai'];
			unset($data['pegawai']);
			$skpd = $data['skpd'];
			unset($data['skpd']);
			unset($data['instruksi']);
			$data['instruksi'] = implode(";", $_POST['instruksi']);

			$data['id_surat_masuk'] = $id_surat_masuk;
			$detail_surat_masuk = $this->surat_masuk_model->get_detail_by_id($id_surat_masuk);
			$data['status_surat'] = "Belum Dibaca";
			$data['id_pegawai_disposisi'] = $this->session->userdata('id_pegawai');

			$delete = $this->surat_masuk_model->delete_disposisi($data);

			$data['jenis_penerima_disposisi'] = "internal";
			foreach ($pegawai as $key) {
				$expl_id = explode('-', $key);
				$data['id_unit_kerja'] = $expl_id[0];
				$data['id_pegawai'] = $expl_id[1];
				$query = $this->surat_masuk_model->add_disposisi($data);
				// kirim notif ke pegawai disposisi surat
				$this->load->model('user_model');
				$this->user_model->id_pegawai = $data['id_pegawai'];
				$usr = $this->user_model->get_by_pegawai();
				$notif_data = array();
				$notif_data['title'] = 'Disposisi Surat';
				$notif_data['message'] = 'Ada disposisi surat baru dengan perihal ' . $detail_surat_masuk->perihal;
				$notif_data['data'] = 'surat_disposisi/detail';
				$notif_data['data_id'] = $query;
				$notif_data['ntime'] = date('H:i:s');
				$notif_data['ndate'] = date('Y-m-d');
				$notif_data['user_id'] = $usr->user_id;
				$notif_data['category'] = 'surat_disposisi/internal';
				$this->notification_model->insert($notif_data);
				$notif_data['link'] = base_url($notif_data['data'] . '/' . $notif_data['data_id']);
				$this->socketio->send('new_notification', $notif_data);
				$this->socketio->send('refresh_notification', array('user_id' => $notif_data['user_id']));
			}

			unset($data['id_pegawai']);
			foreach ($unit_kerja as $key) {
				$data['id_unit_kerja'] = $key;
				$query = $this->surat_masuk_model->add_disposisi($data);
			}

			unset($data['id_unit_kerja']);
			$data['jenis_penerima_disposisi'] = "eksternal";
			foreach ($skpd as $key) {
				$data['id_skpd'] = $key;
				$query = $this->surat_masuk_model->add_disposisi($data);
			}
		}
	}

	public function hapus_surat_masuk($home, $id)
	{
		if ($this->user_id) {
			$this->filter_surat_masuk($id);
			$this->surat_masuk_model->id_surat_masuk = $id;
			$this->surat_masuk_model->hapus_surat_masuk($id);


			$detail = $this->surat_masuk_model->get_detail_by_id($id);
			$log_data = array(
				'action' => 'menghapus',
				'function' => 'surat masuk eksternal',
				'key_name' => 'nomor surat',
				'key_value' => $detail->indeks . "/" . $detail->kode . "/" . $detail->no_urut,
				'category' => $this->uri->segment(1),
			);
			$this->logs_model->insert_log($log_data);

			redirect('surat_eksternal/surat_masuk/');
		} else {
			redirect('home');
		}
	}




	//Surat Keluar

	public function surat_keluar($summary_field = '', $summary_value = '')
	{
		if ($this->user_id) {
			$data['title'] = "Surat Keluar Eksternal";
			$data['content'] = "surat_eksternal/keluar/index";
			$data['user_picture'] = $this->user_picture;
			$data['full_name'] = $this->full_name;
			$data['user_level'] = $this->user_level;
			$data['active_menu'] = "surat_eksternal";

			$hal = 6;
			$page = isset($_GET["page"]) ? (int) $_GET["page"] : 1;
			$mulai = ($page > 1) ? ($page * $hal) - $hal : 0;
			$total = count($this->surat_keluar_model->get_all_eksternal($summary_field, $summary_value));
			$data['pages'] = ceil($total / $hal);
			$data['current'] = $page;
			if (!empty($_POST)) {
				$filter = $_POST;
				$data['filter'] = true;
				$data['filter_data'] = $_POST;
			} else {
				$filter = '';
				$data['filter'] = false;
			}
			$data['total'] = $this->surat_keluar_model->get_all_eksternal();
			$data['perlu_tanggapan'] = $this->surat_keluar_model->get_all_eksternal('status_surat', 'perlu_tanggapan');
			$data['dalam_proses'] = $this->surat_keluar_model->get_all_eksternal('status_surat', 'dalam_proses');
			$data['selesai'] = $this->surat_keluar_model->get_all_eksternal('status_surat', 'selesai');
			$data['list'] = $this->surat_keluar_model->get_page_eksternal($mulai, $hal, $filter, $summary_field, $summary_value);
			if (!empty($summary_value) && !empty($summary_field)) {
				$data['summary_field'] = $summary_field;
				$data['summary_value'] = $summary_value;
			}


			$data['skpd'] = $this->ref_skpd_model->get_all();
			$this->load->view('admin/index', $data);
		} else {
			redirect('admin');
		}
	}

	public function kategori_surat_keluar()
	{
		if ($this->user_id) {
			$data['title'] = "Pilih Kategori Surat - Admin ";
			$data['content'] = "surat_eksternal/keluar/kategori";
			$data['user_picture'] = $this->user_picture;
			$data['full_name'] = $this->full_name;
			$data['user_level'] = $this->user_level;
			$data['active_menu'] = "surat eksternal/kategori";

			$hal = 6;
			$page = isset($_GET["page"]) ? (int) $_GET["page"] : 1;
			$mulai = ($page > 1) ? ($page * $hal) - $hal : 0;
			$total = count($this->ref_surat_model->get_all_j('eksternal'));
			$data['pages'] = ceil($total / $hal);
			$data['current'] = $page;
			if (!empty($_POST)) {
				$filter = $_POST;
				$data['filter'] = true;
				$data['filter_data'] = $_POST;
			} else {
				$filter = '';
				$data['filter'] = false;
			}
			$data['list'] = $this->ref_surat_model->get_page_eksternal($mulai, $hal, $filter);


			$this->load->view('admin/index', $data);
		} else {
			redirect('admin');
		}
	}

	public function tambah_surat_keluar($id_ref_surat, $testing = "")
	{
		if ($this->user_id) {
			// echo $this->session->userdata('id_skpd');die;
			$data['title'] = "Tambah Surat Keluar - Admin ";
			$data['content'] = "surat_eksternal/keluar/add";
			$data['user_picture'] = $this->user_picture;
			$data['full_name'] = $this->full_name;
			$data['user_level'] = $this->user_level;
			$data['active_menu'] = "surat eksternal/tambah";
			if ($id_ref_surat !== 'custom') {
				$data['detail'] = $this->ref_surat_model->get_by_id($id_ref_surat);
				$data['field'] = $this->ref_surat_model->get_field($id_ref_surat);
				$field = $data['field'];

				$data['fe'] = $this->ref_surat_model->get_field_with_event($id_ref_surat);
			} else {
				$data['detail'] = array('nama_surat' => 'Surat Kustom');
				$data['detail'] = json_decode(json_encode($data['detail']));
			}

			$this->load->model('master_pegawai_model');
			$data['pegawai1'] = $this->master_pegawai_model->get_by_id($this->id_pegawai_sekda);


			if (!empty($_POST)) {
				foreach ($data['field'] as $f) {
					if (!empty($f->r_value) && !empty($f->r_table)) {
						if (isset($_POST[$f->field_name])) {
							if ($f->r_value == 'id_pegawai' && $f->r_table == 'pegawai') {
								$gp = $this->db->get_where('pegawai', array('id_pegawai' => $_POST[$f->field_name]))->row();
								$_POST[$f->field_name] = $gp->nama_lengkap;
							}
						}
					}
				}
				$not_required = array('_wysihtml5_mode', 'draft', 'download', 'tembusan_surat', 'id_skpd', 'nama_penerima', 'alamat_penerima', 'kode_wilayah_jabar', 'jabar_tujuan', 'jabar_kode_klasifikasi', 'jabar_jenis_naskah', 'jabar_sifat_naskah', 'jabar_jenis_lampiran');
				$cekform = isFormEmpty($not_required, $_POST);
				if ($cekform) {
					$data['type'] = 'warning';
					$data['messages'] = 'Ada form yang belum diisi';
				} else {
					$insert = $_POST;
					unset($insert['tembusan_surat']);
					$kop_surat = $insert['kop_surat'];
					if (isset($_POST['draft'])) {
						unset($insert['draft']);
					}
					unset($insert['id_penerima']);
					if (isset($insert['_wysihtml5_mode'])) {
						unset($insert['_wysihtml5_mode']);
					}
					if (isset($_POST['download'])) {
						unset($insert['download']);
					}
					unset($insert['jenis_penerima']);
					unset($insert['id_skpd']);
					unset($insert['id_skpd_desa']);
					unset($insert['nama_penerima']);
					unset($insert['alamat_penerima']);
					unset($insert['id_riwayat_kgb']);
					unset($insert['kode_wilayah_jabar']);
					unset($insert['jabar_tujuan']);
					unset($insert['jabar_kode_klasifikasi']);
					unset($insert['jabar_jenis_naskah']);
					unset($insert['jabar_sifat_naskah']);
					unset($insert['jabar_jenis_lampiran']);


					$insert['tgl_buat'] = date('Y-m-d');
					$insert['tgl_surat'] = date('Y-m-d');
					$insert['id_ref_surat'] = $id_ref_surat;
					$insert['jenis_surat'] = 'eksternal';
					$insert['status_surat'] = 'Belum Dibaca';
					if (!empty($this->session->userdata('id_skpd'))) {
						$insert['id_skpd_pengirim'] = $this->session->userdata('id_skpd');
					} else {
						$insert['id_skpd_pengirim'] = 1;
					}
					if (!empty($this->session->userdata('id_pegawai'))) {
						$insert['id_pegawai_input'] = $this->session->userdata('id_pegawai');
					} else {
						$insert['id_pegawai_input'] = 0;
					}
					if (!empty($this->session->userdata('id_unit_kerja'))) {
						$insert['id_unit_kerja_pengirim'] = $this->session->userdata('id_unit_kerja');
					} else {
						$insert['id_unit_kerja_pengirim'] = 0;
					}

					if (!empty($_FILES['file_lampiran']['name'])) {
						$new_name = time() . $_FILES["file_lampiran"]['name'];
						$config['file_name'] = $new_name;
						$config['upload_path'] = './data/surat_eksternal/lampiran/';
						$config['allowed_types'] = 'doc|docx|pdf|xls|xlsx|ppt|pptx|txt|zip|rar';
						$config['max_size'] = 10 * 1024;
						$input = array();
						$this->load->library('upload', $config);
						if (!$this->upload->do_upload('file_lampiran')) {
							$tmp_name = $_FILES['file_lampiran']['tmp_name'];
							if ($tmp_name != "") {
								redirect('surat_eksternal/tambah_surat_keluar/' . $id_ref_surat . '?error');
								die;
							}
						} else {
							$insert['file_lampiran'] = $this->upload->data('file_name');
						}
					}

					if ($kop_surat == "231") {
						$insert['surat_dewan'] = 1;
					}

					$jenis_penerima = $_POST['jenis_penerima'];
					if ($jenis_penerima == 'jabar') {
						$insert['surat_jabar'] = 1;
						$insert['kode_wilayah_jabar'] = $_POST['kode_wilayah_jabar'];
						$insert['jabar_kode_klasifikasi'] = $_POST['jabar_kode_klasifikasi'];
						$insert['jabar_jenis_naskah'] = $_POST['jabar_jenis_naskah'];
						$insert['jabar_sifat_naskah'] = $_POST['jabar_sifat_naskah'];
						$insert['jabar_jenis_lampiran'] = $_POST['jabar_jenis_lampiran'];
					}
					$in = $this->surat_keluar_model->insert_surat_keluar($insert);
					$hash_id = generate_hash($in);
					$this->surat_keluar_model->update_surat_keluar(array('hash_id' => $hash_id), $in);
					if ($jenis_penerima == 'skpd') {
						$id_skpd = $_POST['id_skpd'];
						foreach ($id_skpd as $is) {
							$insert_penerima = array('id_skpd' => $is, 'jenis_penerima' => $jenis_penerima);
							$this->surat_keluar_model->insert_penerima_surat($insert_penerima, $in, 'eksternal');
						}
					} elseif ($jenis_penerima == 'non_skpd') {
						$insert_penerima = array('nama_penerima' => $_POST['nama_penerima'], 'alamat_penerima' => $_POST['alamat_penerima'], 'jenis_penerima' => $jenis_penerima);
						$this->surat_keluar_model->insert_penerima_surat($insert_penerima, $in, 'eksternal');
					} elseif ($jenis_penerima == 'desa') {
						$id_skpd = $_POST['id_skpd_desa'];
						foreach ($id_skpd as $is) {
							$insert_penerima = array('id_skpd' => $is, 'jenis_penerima' => 'desa');
							$this->surat_keluar_model->insert_penerima_surat($insert_penerima, $in, 'eksternal');
						}
					} elseif ($jenis_penerima == 'jabar') {
						$tujuan = $_POST['jabar_tujuan'];
						foreach ($tujuan as $t) {
							$tujuan_string = '';
							$get_eo = $this->db->get_where('surat_penerima_jabar', array('kode_wilayah' => $_POST['kode_wilayah_jabar']))->row();
							$getTujuan = $this->splpjabar->getTujuan($get_eo->path_endpoint, ['id' => $t]);
							if ($getTujuan && isset($getTujuan[0])) {
								$tujuan_string = $getTujuan[0]->name;
							}
							$insert_penerima = [
								'jenis_surat' => 'eksternal',
								'jenis_penerima' => $jenis_penerima,
								'tujuan' => $t,
								'tujuan_string' => $tujuan_string,
								'nama_penerima' => $tujuan_string,
								'alamat_penerima' => $get_eo->nama_instansi,
							];
							$this->surat_keluar_model->insert_penerima_surat($insert_penerima, $in, 'eksternal');
						}
					}
					if (isset($_POST['tembusan_surat'])) {
						$tembusan_surat = $_POST['tembusan_surat'];
						foreach ($tembusan_surat as $t) {
							$this->surat_keluar_model->insert_tembusan_surat($t, $in);
						}
					}
					$sk = $this->surat_keluar_model->get_detail_by_id($in);



					if ($kop_surat == "bupati") {
						$template = $data['detail']->template_file_bupati;
					} else {
						$template = $data['detail']->template_file;
					}
					if ($kop_surat == "sekda") {
						$skpd = $this->ref_skpd_model->get_by_id(1);
					} else if ($kop_surat == "231") {
						$skpd = $this->ref_skpd_model->get_by_id(231);
						$template = $data['detail']->template_file_dprd;
					} else {
						$skpd = $this->ref_skpd_model->get_by_id($sk->id_skpd_pengirim);
					}

					$phpWord = new \PhpOffice\PhpWord\PhpWord();
					$phpWord->getCompatibility()->setOoxmlVersion(14);
					$phpWord->getCompatibility()->setOoxmlVersion(15);
					$filename = $data['detail']->nama_surat . '_' . time() . rand(1, 9999) . ".docx";
					$filename = str_replace(",", "", $filename);
					$filename = str_replace(" ", "_", $filename);


					$template_path = './data/template_surat/' . $template;
					$template = $phpWord->loadTemplate($template_path);
					$phpWord->setDefaultFontSize(50);

					$template->setValue('nama_skpd', $skpd->nama_skpd);
					$template->setValue('no_telp', $skpd->telepon_skpd);
					$template->setValue('email', $skpd->email_skpd);
					$template->setValue('alamat', $skpd->alamat_skpd);
					if ($data['detail']->ttd_dinamis != 1) {
						$template->setValue('nomer_surat', $sk->nomer_surat);
					}
					$template->setValue('website', $skpd->website);
					$template->setValue('kode_pos', $skpd->kode_pos);
					$template->setValue('nomor_registrasi', $sk->hash_id);
					$template->setValue('tanggal_surat', tanggal($sk->tgl_surat));
					$template->setValue('dikeluarkan_di', 'Sumedang');
					$template->setValue('lampiran', ($sk->lampiran));
					$template->setValue('perihal', ($sk->perihal));
					$template->setValue('sifat_surat', ucwords($sk->sifat_surat));
					if ($id_ref_surat == 901 && isset($_POST['id_riwayat_kgb'])) {
						$id_riwayat_kgb = $_POST['id_riwayat_kgb'];
						$this->load->model('kenaikan_gaji_berkala_model');
						$kgb = $this->kenaikan_gaji_berkala_model->get_detail_riwayat_kgb_by_id($id_riwayat_kgb);
						$kgb_lama = $this->kenaikan_gaji_berkala_model->get_detail_riwayat_kgb_by_id($kgb->id_riwayat_kgb_lama);
						$data_pegawai = $this->kenaikan_gaji_berkala_model->get_data_pegawai_by_id($kgb->id_pegawai);
						$data_by_bkd = $this->kenaikan_gaji_berkala_model->get_data_bkd($kgb->id_pegawai);
						$template->setValue('nama_lengkap', $data_by_bkd->nama_lengkap);
						$template->setValue('tempat_lahir', $data_by_bkd->temlahir);
						$template->setValue('tgl_lahir', date("d-m-Y", strtotime($data_by_bkd->tgllahir)));
						$template->setValue('nip', $data_by_bkd->nip);
						$template->setValue('karpeg', $data_pegawai->karpeg);
						$template->setValue('pangkat', $data_by_bkd->pangkat);
						$template->setValue('gol', $data_by_bkd->gol);
						$template->setValue('nama_jabatan', $data_by_bkd->nama_jabatan);
						$template->setValue('unitkerja', $data_by_bkd->unitkerja);

						$template->setValue('gaji_pokok_lama', 'Rp.' . number_format($kgb_lama->gaji_pokok, 0, ',', '.') . ',-');
						$template->setValue('pp_lama', $kgb_lama->nama_pp);
						$template->setValue('tanggal_buat_lama', tanggal($kgb_lama->tanggal_buat));
						$template->setValue('nomor_kgb_lama', $kgb_lama->nomor_kgb);
						$template->setValue('terhitung_mulai_tanggal_lama', tanggal($kgb_lama->terhitung_mulai_tanggal));
						$template->setValue('mkg_lama', sprintf("%02d", $kgb_lama->mkg) . ' Tahun 00 Bulan');

						$template->setValue('gaji_pokok', 'Rp.' . number_format($kgb->gaji_pokok, 0, ',', '.') . ',-');
						$template->setValue('pp', $kgb->nama_pp);
						$template->setValue('tanggal_buat', tanggal($kgb->tanggal_buat));
						$template->setValue('nomor_kgb', $kgb->nomor_kgb);
						$template->setValue('terhitung_mulai_tanggal', tanggal($kgb->terhitung_mulai_tanggal));
						$template->setValue('mkg', sprintf("%02d", $kgb->mkg) . ' Tahun 00 Bulan');
						$template->setValue('golongan', $kgb->pangkat);

						$terhitung_mulai_tanggal_baru = date("Y-m-d", strtotime(date("Y-m-d", strtotime($kgb->terhitung_mulai_tanggal)) . " + 2 year"));
						$template->setValue('terhitung_mulai_tanggal_baru', tanggal($terhitung_mulai_tanggal_baru));
					} else {
						if (isset($field)) {
							foreach ($field as $f) {
								$field_name = $f->field_name;
								$sk->$field_name = str_replace('’', "'", $sk->$field_name);
								$sk->$field_name = str_replace('–', "-", $sk->$field_name);
								$sk->$field_name = str_replace('<div>', ' ', $sk->$field_name);
								$sk->$field_name = str_replace('</div>', '<br>', $sk->$field_name);
								if ($f->input_type == 'textarea') {
									$parser = new \HTMLtoOpenXML\Parser();
									$field_value = $parser->fromHTML($sk->$field_name);
									$template->setValue($field_name, $field_value, null, true);
								} elseif ($f->input_type == 'date') {
									$template->setValue($field_name, tanggal($sk->$field_name));
								} else {
									$template->setValue($field_name, $sk->$field_name);
								}
							}
						}
						if ($id_ref_surat !== 'custom') {
							$template->setValue('penutup', $sk->penutup);
						}
					}

					if ($sk->surat_dewan == "1") {
						$this->load->model('pegawai_dewan_model');
						$pegawai_ttd = $this->pegawai_dewan_model->get_pegawai_by_id($sk->id_pegawai_ttd);
					} else {
						$pegawai_ttd = $this->master_pegawai_model->get_by_id($sk->id_pegawai_ttd);
					}
					$template->setValue('nip_ttd', $pegawai_ttd->nip);
					$template->setValue('nama_ttd', $pegawai_ttd->nama_lengkap);
					$template->setValue('jabatan_ttd', $pegawai_ttd->jabatan);
					$detail = $this->surat_keluar_model->get_detail_by_id($in);
					$template->setValue('tgl_surat', $sk->tgl_surat);

					$hash_id = $detail->hash_id;
					$img_qr = get_qr_code($template_path, 0, 'jpeg');
					$qrcode = generate_qr('https://e-office.sumedangkab.go.id/verifikasi_surat/id/' . $hash_id);
					$template->setImageValue($img_qr, $qrcode);
					if ($this->session->id_pegawai == 318) {
						// print_r($img_qr);die;
					}


					if ($testing == 1) {
					} else {
						// $hash_id = $detail->hash_id;
						// $img_qr = get_qr_code($template_path,1,'jpeg');
						// $qrcode = generate_qr('https://e-office.sumedangkab.go.id/verifikasi_surat/id/not_found');
						// $template->setImageValue($img_qr, $qrcode);
						// $img_qr_footer = get_qr_code($template_path,0,'jpeg');
						// $qrcode_footer = generate_qr('https://e-office.sumedangkab.go.id/verifikasi_surat/id/not_found');
						// $template->setImageValue($img_qr_footer, $qrcode_footer);
					}

					// $img_qr = get_qr_code($template_path);
					// // $img_qr = 'image3.png';
					// $qrcode = generate_qr($detail->hash_id);
					// // echo $qrcode;die;
					// $template->setImageValue($img_qr, './data/images/blank.png');

					ob_clean();
					$template->saveAs("./data/surat_eksternal/keluar/" . $filename);
					$this->surat_keluar_model->update_surat_keluar(array('file_draft_surat' => ($filename)), $in);

					if (isset($_POST['download'])) {
						header('Content-Description: File Transfer');
						header('Content-Type: application/octet-stream');
						header('Content-Disposition: attachment; filename=' . $filename);
						header('Content-Transfer-Encoding: binary');
						header('Expires: 0');
						header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
						header('Pragma: public');
						header('Content-Length: ' . filesize("./data/surat_eksternal/keluar/" . $filename));
						flush();
						readfile("./data/surat_eksternal/keluar/" . $filename);
						echo refresh_url(base_url('surat_eksternal/surat_keluar'));
					}

					$data['type'] = 'success';
					$data['messages'] = '<i class="ti-check"></i> Surat Keluar berhasil ditambahkan, klik <a style="color:#fff;font-weight:bold" target="blank" href="' . base_url('surat_eksternal/detail_surat_keluar/' . $in) . '">disini</a> untuk melihat detail surat.';


					$log_data = array(
						'action' => 'membuat',
						'function' => 'surat keluar eksternal',
						'key_name' => 'nomor registrasi sistem',
						'key_value' => $hash_id,
						'category' => $this->uri->segment(1),
					);
					$this->logs_model->insert_log($log_data);
				}
			}


			$data['skpd'] = $this->ref_skpd_model->get_all();
			// $agg = file_get_contents('https://e-officedesa.sumedangkab.go.id/api_eoffice/list_desa');
			// print_r($agg);die;
			$get_desa = curlMadasih('list_desa');
			if ($get_desa) {
				$data['desa'] = json_decode($get_desa);
			} else {
				$data['desa'] = array();
			}

			$this->load->model('master_pegawai_model');
			$id_skpd = $this->session->userdata('id_skpd');
			$d_pegawai1 = $this->master_pegawai_model->get_by_id_skpd($id_skpd, true);
			$d_pegawai2 = $this->master_pegawai_model->get_by_id_skpd(33, true);
			if ($this->user_level == 'Dewan' || $id_skpd == "3") {
				// $this->load->model('pegawai_dewan_model');
				// $d_pegawai3 = $this->pegawai_dewan_model->get_all();
				$d_pegawai3 =[];
				// print_r($d_pegawai3);die;
				$data['pegawai'] = array_merge($d_pegawai1, $d_pegawai2, $d_pegawai3);
				// $data['pegawai'][] = $d_pegawai3;
			} else {
				$data['pegawai'] = array_merge($d_pegawai1, $d_pegawai2);
			}
			// $data['pegawai_tembusan'] = $this->master_pegawai_model->get_by_id_skpd(33);
			$data['pegawai_tembusan'] = $this->master_pegawai_model->get_by_id_skpd(33);
			$data['kepala_skpd'] = $this->master_pegawai_model->get_kepala_skpd();
			$data['list_tembusan'] = array_merge($data['pegawai_tembusan'], $data['kepala_skpd']);
			$data['pegawai_tembusan'] = $this->master_pegawai_model->get_all();
			$data['id_ref_surat'] = $id_ref_surat;
			$data['skpd'] = $this->ref_skpd_model->get_all();
			$data['testing'] = $testing;

			$data['skpd_pegawai'] = $this->ref_skpd_model->get_by_id($id_skpd);
			// print_r($data['skpd_pegawai']);
			// die;
			if ($id_ref_surat == 901) {
				$id_riwayat_kgb = @$_GET['id_riwayat_kgb'];
				$this->load->model('kenaikan_gaji_berkala_model');
				$data['kgb'] = $this->kenaikan_gaji_berkala_model->get_detail_riwayat_kgb_by_id($id_riwayat_kgb);
				// print_r($data['kgb']);die;
			} else {
				$data['kgb'] = false;
			}

			$data['ekosistem_jabar'] = $this->db->get('surat_penerima_jabar')->result();

			$this->load->view('admin/index', $data);
		} else {
			redirect('admin');
		}
	}

	public function edit_surat_keluar($id_ref_surat, $id_surat_keluar)
	{
		if ($this->user_id) {
			$this->filter_surat_keluar($id_surat_keluar);
			$data['title'] = "Edit Surat Keluar - Admin ";
			$data['content'] = "surat_eksternal/keluar/edit";
			$data['user_picture'] = $this->user_picture;
			$data['full_name'] = $this->full_name;
			$data['user_level'] = $this->user_level;
			$data['active_menu'] = "surat eksternal/tambah";
			if ($id_ref_surat !== 'custom') {
				$data['detail'] = $this->ref_surat_model->get_by_id($id_ref_surat);
				$data['field'] = $this->ref_surat_model->get_field($id_ref_surat);
				$field = $data['field'];
			} else {
				$data['detail'] = array('nama_surat' => 'Surat Kustom');
				$data['detail'] = json_decode(json_encode($data['detail']));
			}



			if (!empty($_POST)) {
				$not_required = array('_wysihtml5_mode', 'draft', 'download', 'tembusan_surat', 'id_skpd', 'nama_penerima', 'alamat_penerima', 'kode_wilayah_jabar', 'jabar_tujuan', 'jabar_kode_klasifikasi', 'jabar_jenis_naskah', 'jabar_sifat_naskah', 'jabar_jenis_lampiran');
				$cekform = isFormEmpty($not_required, $_POST);
				if ($cekform) {
					$data['type'] = 'warning';
					$data['messages'] = 'Ada form yang belum diisi';
				} else {
					$insert = $_POST;
					unset($insert['tembusan_surat']);
					if (isset($_POST['draft'])) {
						unset($insert['draft']);
					}
					unset($insert['id_penerima']);
					if (isset($insert['_wysihtml5_mode'])) {
						unset($insert['_wysihtml5_mode']);
					}
					unset($insert['jenis_penerima']);
					unset($insert['id_skpd']);
					unset($insert['nama_penerima']);
					unset($insert['alamat_penerima']);

					unset($insert['kode_wilayah_jabar']);
					unset($insert['jabar_tujuan']);
					unset($insert['jabar_kode_klasifikasi']);
					unset($insert['jabar_jenis_naskah']);
					unset($insert['jabar_sifat_naskah']);
					unset($insert['jabar_jenis_lampiran']);

					$insert['id_ref_surat'] = $id_ref_surat;
					if (!empty($this->session->userdata('id_skpd'))) {
						$insert['id_skpd_pengirim'] = $this->session->userdata('id_skpd');
					} else {
						$insert['id_skpd_pengirim'] = 1;
					}
					if (!empty($this->session->userdata('id_pegawai'))) {
						$insert['id_pegawai_input'] = $this->session->userdata('id_pegawai');
					} else {
						$insert['id_pegawai_input'] = 0;
					}
					if (!empty($this->session->userdata('id_unit_kerja'))) {
						$insert['id_unit_kerja_pengirim'] = $this->session->userdata('id_unit_kerja');
					} else {
						$insert['id_unit_kerja_pengirim'] = 0;
					}
					$in = $this->surat_keluar_model->update_surat_keluar($insert, $id_surat_keluar);
					// $this->surat_keluar_model->update_surat_keluar(array('hash_id'=>generate_hash($in)),$in);
					$jenis_penerima = $_POST['jenis_penerima'];
					if ($jenis_penerima == 'skpd') {
						$id_skpd = $_POST['id_skpd'];
						$this->surat_keluar_model->delete_penerima_surat($id_surat_keluar);
						foreach ($id_skpd as $is) {
							$insert_penerima = array('id_skpd' => $is, 'jenis_penerima' => $jenis_penerima);
							$this->surat_keluar_model->insert_penerima_surat($insert_penerima, $id_surat_keluar, 'eksternal');
						}
					} elseif ($jenis_penerima == 'non_skpd') {
						$insert_penerima = array('nama_penerima' => $_POST['nama_penerima'], 'alamat_penerima' => $_POST['alamat_penerima'], 'jenis_penerima' => $jenis_penerima);
						$this->surat_keluar_model->delete_penerima_surat($id_surat_keluar);
						$this->surat_keluar_model->insert_penerima_surat($insert_penerima, $id_surat_keluar, 'eksternal');
					} elseif ($jenis_penerima == 'jabar') {
						$tujuan = $_POST['jabar_tujuan'];
						foreach ($tujuan as $t) {
							$insert_penerima = [
								'jenis_surat' => 'eksternal',
								'jenis_penerima' => $jenis_penerima,
								'tujuan' => $t
							];
							$this->surat_keluar_model->insert_penerima_surat($insert_penerima, $id_surat_keluar, 'eksternal');
						}
					}
					if (isset($_POST['tembusan_surat'])) {
						$tembusan_surat = $_POST['tembusan_surat'];
						$this->surat_keluar_model->delete_tembusan_surat($id_surat_keluar);
						foreach ($tembusan_surat as $t) {
							$this->surat_keluar_model->insert_tembusan_surat($t, $id_surat_keluar);
						}
					}
					$sk = $this->surat_keluar_model->get_detail_by_id($id_surat_keluar);

					$skpd = $this->ref_skpd_model->get_by_id($sk->id_skpd_pengirim);

					$phpWord = new \PhpOffice\PhpWord\PhpWord();
					$phpWord->getCompatibility()->setOoxmlVersion(14);
					$phpWord->getCompatibility()->setOoxmlVersion(15);

					$template = $data['detail']->template_file;
					$filename = $data['detail']->nama_surat . '_' . time() . ".docx";
					$filename = str_replace(",", "", $filename);
					$filename = str_replace(" ", "_", $filename);

					$template_path = './data/template_surat/' . $template;
					$template = $phpWord->loadTemplate($template_path);

					$template->setValue('nama_skpd', $skpd->nama_skpd);
					$template->setValue('no_telp', $skpd->telepon_skpd);
					$template->setValue('email', $skpd->email_skpd);
					$template->setValue('alamat', $skpd->alamat_skpd);
					$template->setValue('nomer_surat', $sk->nomer_surat);
					$template->setValue('website', $sk->website);
					$template->setValue('kode_pos', $sk->kode_pos);
					$template->setValue('tanggal_surat', tanggal($sk->tgl_surat));

					if (isset($field)) {
						foreach ($field as $f) {
							$field_name = $f->field_name;
							$template->setValue($field_name, $sk->$field_name);
						}
					}
					if ($id_ref_surat !== 'custom') {
						$template->setValue('penutup', $sk->penutup);
					}

					$pegawai_ttd = $this->master_pegawai_model->get_by_id($sk->id_pegawai_ttd);
					$template->setValue('nip_ttd', $pegawai_ttd->nip);
					$template->setValue('nama_ttd', $pegawai_ttd->nama_lengkap);
					$template->setValue('jabatan_ttd', $pegawai_ttd->jabatan);
					$detail = $this->surat_keluar_model->get_detail_by_id($in);
					$template->setValue('tgl_surat', $sk->tgl_surat);
					// $img_qr = get_qr_code($template_path);
					$img_qr = 'image3.png';
					$qrcode = generate_qr($detail->hash_id);
					// $template->setImageValue($img_qr, $qrcode);

					ob_clean();
					$template->saveAs("./data/surat_eksternal/keluar/" . $filename);
					$this->surat_keluar_model->update_surat_keluar(array('file_draft_surat' => ($filename)), $id_surat_keluar);

					$data['type'] = 'success';
					$data['messages'] = 'Surat Keluar berhasil diubah';

					$detail = $this->surat_keluar_model->get_detail_by_id($id_surat_keluar);
					$log_data = array(
						'action' => 'memperbarui',
						'function' => 'surat keluar eksternal',
						'key_name' => 'nomor registrasi sistem',
						'key_value' => $detail->hash_id,
						'category' => $this->uri->segment(1),
					);
					$this->logs_model->insert_log($log_data);
				}
			}

			$data['skpd'] = $this->ref_skpd_model->get_all();

			$this->load->model('master_pegawai_model');
			$id_skpd = $this->session->userdata('id_skpd');
			$data['pegawai'] = $this->master_pegawai_model->get_by_id_skpd($id_skpd);
			$data['kepala_skpd'] = $this->master_pegawai_model->get_kepala_skpd();
			$data['pegawai_tembusan'] = $this->master_pegawai_model->get_by_id_skpd(33);
			$data['id_ref_surat'] = $id_ref_surat;
			$data['skpd'] = $this->ref_skpd_model->get_all();

			$data['detail'] = $this->surat_keluar_model->get_detail_by_id($id_surat_keluar);
			if (empty($data['detail'])) {
				show_404();
			}
			if ($this->user_level !== "admin") {
				if ($data['detail']->id_pegawai_input !== $this->id_pegawai) {
					show_404();
				}
			}
			$data['tembusan_surat'] = $this->surat_keluar_model->get_surat_tembusan(array('surat_keluar_tembusan.id_surat_keluar' => $id_surat_keluar));
			$data['penerima'] = $this->surat_keluar_model->get_penerima($id_surat_keluar);
			// print_r($penerima);die;

			// print_r($data['penerima']);die;

			$data['detail']->jenis_penerima = $data['penerima'][0]->jenis_penerima;


			$this->load->view('admin/index', $data);
		} else {
			redirect('admin');
		}
	}

	public function detail_surat_keluar($id_surat_keluar, $testing = "")
	{
		if ($this->user_id) {
			$data['testing'] = $testing;
			$this->filter_surat_keluar($id_surat_keluar);
			$read = $this->notification_model->read('surat_eksternal/detail_surat_keluar', $id_surat_keluar);
			if ($read) {
				$this->socketio->send('refresh_notification', array('user_id' => $this->session->userdata('user_id')));
			}
			$data['title'] = "Detail Surat Keluar - Admin ";
			$data['content'] = "surat_eksternal/keluar/detail";
			$data['user_picture'] = $this->user_picture;
			$data['full_name'] = $this->full_name;
			$data['user_level'] = $this->user_level;
			$data['active_menu'] = "surat eksternal";
			$data['penerima'] = $this->surat_keluar_model->get_penerima($id_surat_keluar);
			$data['tembusan'] = $this->surat_keluar_model->get_tembusan_by_surat_keluar($id_surat_keluar);
			$data['detail'] = $this->surat_keluar_model->get_detail_by_id($id_surat_keluar);
			$data['status_surat'] = $this->surat_keluar_model->get_status_surat($id_surat_keluar);
			if (!empty($_FILES)) {
				$config['upload_path'] = './data/surat_eksternal/keluar/';
				$config['allowed_types'] = 'docx';

				$input = array();
				$this->load->library('upload', $config);
				if (!$this->upload->do_upload('file_verifikasi')) {
					$tmp_name = $_FILES['file_verifikasi']['tmp_name'];
					if ($tmp_name != "") {
						$data['message'] = $this->upload->display_errors();
						$data['type'] = "danger";
					}
				} else {
					$this->surat_keluar_model->update_surat_keluar(array('file_draft_surat' => $this->upload->data('file_name'), 'status_verifikasi' => 'menunggu_verifikasi', 'status_penomoran' => 'N'), $id_surat_keluar);

					$data['message'] = "File berhasil diupload";
					$data['type'] = "success";


					$notif_data = array();
					$notif_data['title'] = 'Verifikasi Surat';
					$notif_data['message'] = 'Ada surat menunggu diverifikasi oleh Anda dengan nomor registrasi ' . $data['detail']->hash_id;
					$notif_data['data'] = 'surat_eksternal/verifikasi_surat_detail';
					$notif_data['data_id'] = $id_surat_keluar;
					$notif_data['ntime'] = date('H:i:s');
					$notif_data['ndate'] = date('Y-m-d');
					$notif_data['user_id'] = $data['detail']->id_user_verifikator;
					$notif_data['category'] = 'surat_eksternal/verifikasi_surat';
					$this->notification_model->insert($notif_data);
					$notif_data['link'] = base_url($notif_data['data'] . '/' . $notif_data['data_id']);
					$this->socketio->send('new_notification', $notif_data);
					$this->socketio->send('refresh_notification', array('user_id' => $notif_data['user_id']));

					$app_token = $data['detail']->app_token_verifikator;
					if ($app_token != null) {
						require_once(APPPATH . 'libraries/PushNotification/Firebase.php');
						$judul = $data['detail']->full_name_verifikator . ", ada surat menunggu verifikasi dari anda.";
						$pesan = "Perihal : " . $data['detail']->perihal;
						$click_action = "verifikasi";
						$data_id = $id_surat_keluar;
						$file = "";
						$file_verifikasi = "";
						$file_draft = "";

						if ($data["detail"]->jenis_surat == "internal")
							$file_verifikasi = base_url() . "data/surat_internal/draf_pdf/" . $this->upload->data('file_name');
						else
							$file_verifikasi = base_url() . "data/surat_eksternal/draf_pdf/" . $this->upload->data('file_name');

						$dataa = array(
							'tanggal' => $data['detail']->tgl_surat,
							'file' => $file,
							'perihal' => $data['detail']->perihal,
							'jenis' => $data['detail']->jenis_surat,
							'id_surat_keluar' => $id_surat_keluar,
							'file_verifikasi' => $file_verifikasi,
							'file_draft' => $file_draft,
							'status' => strtoupper(str_replace("_", " ", $data['detail']->status_verifikasi)),

						);
						$raw_data = json_encode($dataa);
						$firebase = new Firebase();
						$respone = $firebase->send($app_token, $judul, $pesan, $click_action, $data_id, $raw_data);
						//var_dump($respone);die;
					}
				}
			}
			$data['status_surat'] = $this->surat_keluar_model->get_status_surat($id_surat_keluar);

			$data['detail'] = $this->surat_keluar_model->get_detail_by_id($id_surat_keluar);
			$this->load->view('admin/index', $data);
		} else {
			redirect('admin');
		}
	}


	public function buat_ulang_surat($id_surat_keluar)
	{
		$sk = $this->surat_keluar_model->get_detail_by_id_d($id_surat_keluar);

		$id_ref_surat = $sk->id_ref_surat;

		$phpWord = new \PhpOffice\PhpWord\PhpWord();
		$phpWord->getCompatibility()->setOoxmlVersion(14);
		$phpWord->getCompatibility()->setOoxmlVersion(15);
		$this->load->model('ref_surat_model');
		$detail_template = $this->ref_surat_model->get_by_id($sk->id_ref_surat);

		$field = $this->ref_surat_model->get_field($sk->id_ref_surat);
		$kop_surat = $sk->kop_surat;
		if ($kop_surat == "bupati") {
			$template = $detail_template->template_file_bupati;
		} else {
			$template = $detail_template->template_file;
		}
		if ($kop_surat == "sekda") {
			$skpd = $this->ref_skpd_model->get_by_id(1);
		} else {
			$skpd = $this->ref_skpd_model->get_by_id($sk->id_skpd_pengirim);
		}

		$filename = $detail_template->nama_surat . '_' . time() . ".docx";
		$filename = str_replace(",", "", $filename);
		$filename = str_replace(" ", "_", $filename);

		$template_path = './data/template_surat/' . $template;
		$template = $phpWord->loadTemplate($template_path);

		foreach ($sk as $n => $v) {
			$sk->$n = str_replace('–', '-', $sk->$n);
		}

		$template->setValue('nama_skpd', $skpd->nama_skpd);
		$template->setValue('no_telp', $skpd->telepon_skpd);
		$template->setValue('email', $skpd->email_skpd);
		$template->setValue('alamat', $skpd->alamat_skpd);
		$template->setValue('nomer_surat', $sk->nomer_surat);
		$template->setValue('nomor_registrasi', $sk->hash_id);
		$template->setValue('website', $skpd->website);
		$template->setValue('kode_pos', $skpd->kode_pos);
		$template->setValue('tanggal_surat', tanggal($sk->tgl_surat));
		$template->setValue('dikeluarkan_di', 'Sumedang');
		$template->setValue('lampiran', ($sk->lampiran));
		$template->setValue('perihal', ($sk->perihal));
		$template->setValue('sifat_surat', ucwords($sk->sifat_surat));
		$parser = new \HTMLtoOpenXML\Parser();
		if (isset($field)) {
			foreach ($field as $k => $f) {
				$field_name = $f->field_name;
				if (isset($sk->$field_name)) {
					$sk->$field_name = str_replace('’', "'", $sk->$field_name);
					$sk->$field_name = str_replace('–', "-", $sk->$field_name);
					$sk->$field_name = str_replace('<div>', ' ', $sk->$field_name);
					$sk->$field_name = str_replace('</div>', '<br>', $sk->$field_name);
					if ($f->input_type == 'textarea') {
						$field_value = $parser->fromHTML(trim($sk->$field_name));
						$template->setValue($field_name, $field_value, null, true);
					} elseif ($f->input_type == 'date') {
						$template->setValue($field_name, tanggal(trim($sk->$field_name)));
					} else {
						$template->setValue($field_name, trim($sk->$field_name));
					}
				}
			}
		}
		// die;

		if ($id_ref_surat !== 'custom') {
			$template->setValue('penutup', $parser->fromHTML(trim($sk->penutup)));
		}

		$pegawai_ttd = $this->master_pegawai_model->get_by_id($sk->id_pegawai_ttd);
		$template->setValue('nip_ttd', $pegawai_ttd->nip);
		$template->setValue('nama_ttd', $pegawai_ttd->nama_lengkap);
		$template->setValue('jabatan_ttd', $pegawai_ttd->jabatan);
		$detail = $this->surat_keluar_model->get_detail_by_id($id_surat_keluar);
		$template->setValue('tgl_surat', $sk->tgl_surat);

		$hash_id = $detail->hash_id;
		$img_qr = get_qr_code($template_path, 0, 'jpeg');
		$qrcode = generate_qr('https://e-office.sumedangkab.go.id/verifikasi_surat/id/' . $hash_id);
		$template->setImageValue($img_qr, $qrcode);
		ob_clean();
		$template->saveAs("./data/surat_eksternal/keluar/" . $filename);
		$this->surat_keluar_model->update_surat_keluar(array('file_draft_surat' => ($filename)), $id_surat_keluar);
		redirect('surat_eksternal/detail_surat_keluar/' . $id_surat_keluar);
	}

	// Verifikasi Surat

	public function verifikasi_surat($summary_field = '', $summary_value = '')
	{
		if ($this->user_id) {
			$data['title'] = "detail Surat - Admin ";
			$data['content'] = "surat_eksternal/verifikasi/index";
			$data['user_picture'] = $this->user_picture;
			$data['full_name'] = $this->full_name;
			$data['user_level'] = $this->user_level;
			$data['active_menu'] = "surat eksternal/tambah";

			$hal = 6;
			$page = isset($_GET["page"]) ? (int) $_GET["page"] : 1;
			$mulai = ($page > 1) ? ($page * $hal) - $hal : 0;
			$total = count($this->surat_keluar_model->get_all_eksternal_verifikasi($summary_field, $summary_value));
			$data['pages'] = ceil($total / $hal);
			$data['current'] = $page;
			if (!empty($_POST)) {
				$filter = $_POST;
				$data['filter'] = true;
				$data['filter_data'] = $_POST;
			} else {
				$filter = '';
				$data['filter'] = false;
			}
			$data['total'] = $this->surat_keluar_model->get_all_eksternal_verifikasi();
			$data['sudah_diverifikasi'] = $this->surat_keluar_model->get_eksternal_verifikasi('sudah_diverifikasi');
			$data['menunggu_verifikasi'] = $this->surat_keluar_model->get_eksternal_verifikasi('menunggu_verifikasi');
			$data['ditolak'] = $this->surat_keluar_model->get_eksternal_verifikasi('ditolak');
			$data['list'] = $this->surat_keluar_model->get_page_eksternal_verifikasi($mulai, $hal, $filter, $summary_field, $summary_value);

			$this->load->view('admin/index', $data);
		} else {
			redirect('admin');
		}
	}

	// Verifikasi Surat
	public function verifikasi_surat_detail($id_surat_keluar, $testing = "")
	{
		if ($this->user_id) {

			$this->filter_verifikator($id_surat_keluar);
			$data['title'] = "detail Surat - Admin ";
			$data['content'] = "surat_eksternal/verifikasi/detail";
			$data['user_picture'] = $this->user_picture;
			$data['full_name'] = $this->full_name;
			$data['user_level'] = $this->user_level;
			$data['active_menu'] = "surat eksternal";
			$data['detail'] = $this->surat_keluar_model->get_detail_by_id($id_surat_keluar);
			if (!empty($_FILES)) {
				$config['upload_path'] = './data/surat_eksternal/keluar/';
				$config['allowed_types'] = 'docx';

				$input = array();
				$this->load->library('upload', $config);
				if (!$this->upload->do_upload('file_verifikasi')) {
					$tmp_name = $_FILES['file_verifikasi']['tmp_name'];
					if ($tmp_name != "") {
						$data['message'] = $this->upload->display_errors();
						$data['type'] = "danger";
					}
				} else {
					$this->surat_keluar_model->update_surat_keluar(array('file_draft_surat' => $this->upload->data('file_name'), 'status_verifikasi' => 'menunggu_verifikasi', 'status_penomoran' => 'N'), $id_surat_keluar);
					$data['message'] = "File berhasil diupload";
					$data['type'] = "success";
				}
			}
			if (!empty($_POST)) {

				$read = $this->notification_model->read('surat_eksternal/verifikasi_surat_detail', $id_surat_keluar);
				if ($read) {
					$this->socketio->send('refresh_notification', array('user_id' => $this->session->userdata('user_id')));
				}
				if (isset($_POST['terima'])) {
					$sess_id_pegawai = $this->session->userdata('id_pegawai');
					$kepala_setwan = $this->master_pegawai_model->get_pegawai_kepala_skpd(3);
					if ($sess_id_pegawai == 10841) {
						$kepala_setwan->id_pegawai = $sess_id_pegawai;
					}
					// print_r($kepala_setwan);die;
					if ($data['detail']->kop_surat == "bupati" && $sess_id_pegawai != $this->id_pegawai_sekda) {
						// echo "verifikasi gagal";die;
						$data['message'] = "<b>Gagal</b> khusus Surat Bupati harus mendapatkan verifikasi dari Sekretaris Daerah sebelum masuk ke Bagian Penomoran, silahkan Teruskan verifikasi surat ini ke Sekretaris Daerah";
						$data['type'] = "danger";
					} else if ($data['detail']->kop_surat == "231" && $sess_id_pegawai !== $kepala_setwan->id_pegawai) {
						$data['message'] = "<b>Gagal</b> khusus Surat DPRD harus mendapatkan verifikasi dari Sekretaris DPRD sebelum masuk ke Bagian Penomoran, silahkan Teruskan verifikasi surat ini ke Sekretaris DPRD";
						$data['type'] = "danger";
					} else {
						$copy = copy('./data/surat_eksternal/keluar/' . $data['detail']->file_draft_surat, './data/surat_eksternal/draf_pdf/' . $data['detail']->file_draft_surat);
						$this->surat_keluar_model->update_surat_keluar(array('file_verifikasi' => $data['detail']->file_draft_surat, 'status_verifikasi' => 'sudah_diverifikasi', 'status_ttd' => 'menunggu_verifikasi', 'tgl_verifikasi' => date('Y-m-d')), $id_surat_keluar);
						$data['message'] = "Surat telah disetujui";
						$data['type'] = "success";


						$detail = $this->surat_keluar_model->get_detail_by_id($id_surat_keluar);
						$log_data = array(
							'action' => 'menyetujui',
							'function' => 'verifikasi surat',
							'key_name' => 'nomor registrasi sistem',
							'key_value' => $detail->hash_id,
							'category' => $this->uri->segment(1),
						);
						$this->logs_model->insert_log($log_data);


						//kirim notif ke pembuat surat
						$notif_data = array();
						$notif_data['title'] = 'Verifikasi Surat';
						$notif_data['message'] = 'Surat dengan nomor registrasi ' . $data['detail']->hash_id . ' telah disetujui oleh verifikator surat';
						$notif_data['data'] = 'surat_eksternal/detail_surat_keluar';
						$notif_data['data_id'] = $id_surat_keluar;
						$notif_data['ntime'] = date('H:i:s');
						$notif_data['ndate'] = date('Y-m-d');
						$notif_data['user_id'] = $data['detail']->id_user_input;
						$notif_data['category'] = 'surat_eksternal/surat_keluar';
						$this->notification_model->insert($notif_data);
						$notif_data['link'] = base_url($notif_data['data'] . '/' . $notif_data['data_id']);
						$this->socketio->send('new_notification', $notif_data);
						$this->socketio->send('refresh_notification', array('user_id' => $notif_data['user_id']));

						//kirim notif ke register surat

						$reg = $this->user_model->get_user_tu_pimpinan($this->session->userdata('id_skpd'), $data['detail']->kop_surat);
						foreach ($reg as $r) {
							$notif_data = array();
							$notif_data['title'] = 'Penomoran Surat';
							$notif_data['message'] = 'Ada surat menunggu untuk dilakukan penomoran dengan nomor registrasi ' . $data['detail']->hash_id;
							$notif_data['data'] = 'penomoran_surat/detail';
							$notif_data['data_id'] = $id_surat_keluar;
							$notif_data['ntime'] = date('H:i:s');
							$notif_data['ndate'] = date('Y-m-d');
							$notif_data['user_id'] = $r->user_id;
							$notif_data['category'] = 'penomoran_surat';
							$this->notification_model->insert($notif_data);
							$notif_data['link'] = base_url($notif_data['data'] . '/' . $notif_data['data_id']);
							$this->socketio->send('new_notification', $notif_data);
							$this->socketio->send('refresh_notification', array('user_id' => $notif_data['user_id']));
						}
					}
				} elseif (isset($_POST['tolak'])) {
					$this->surat_keluar_model->update_surat_keluar(array('status_verifikasi' => 'ditolak', 'alasan_penolakan_verifikasi' => $_POST['alasan_penolakan_verifikasi']), $id_surat_keluar);
					$data['message'] = "Surat telah ditolak";
					$data['type'] = "danger";


					$detail = $this->surat_keluar_model->get_detail_by_id($id_surat_keluar);
					$log_data = array(
						'action' => 'menolak',
						'function' => 'verifikasi surat',
						'key_name' => 'nomor registrasi sistem',
						'key_value' => $detail->hash_id,
						'category' => $this->uri->segment(1),
					);
					$this->logs_model->insert_log($log_data);


					$notif_data = array();
					$notif_data['title'] = 'Verifikasi Surat';
					$notif_data['message'] = 'Surat dengan nomor registrasi ' . $data['detail']->hash_id . ' ditolak oleh verifikator surat';
					$notif_data['data'] = 'surat_eksternal/detail_surat_keluar';
					$notif_data['data_id'] = $id_surat_keluar;
					$notif_data['ntime'] = date('H:i:s');
					$notif_data['ndate'] = date('Y-m-d');
					$notif_data['user_id'] = $data['detail']->id_user_input;
					$notif_data['category'] = 'surat_eksternal/surat_keluar';
					$this->notification_model->insert($notif_data);
					$notif_data['link'] = base_url($notif_data['data'] . '/' . $notif_data['data_id']);
					$this->socketio->send('new_notification', $notif_data);
					$this->socketio->send('refresh_notification', array('user_id' => $notif_data['user_id']));
				} elseif (isset($_POST['teruskan'])) {
					$this->surat_keluar_model->update_surat_keluar(
						array(
							'file_verifikasi' => $data['detail']->file_draft_surat,
							'status_verifikasi' => 'menunggu_verifikasi'
						),
						$id_surat_keluar,
						array(
							'update' => 'verifikasi',
							'data' => array(
								'id_pegawai_verifikasi_teruskan' => $_POST['id_pegawai_verifikasi_teruskan'],
								'file_verifikasi' => $data['detail']->file_draft_surat,
								'status_verifikasi' => 'sudah_diverifikasi',
								'tgl_verifikasi' => date('Y-m-d')
							)
						)
					);
					$data['message'] = "Surat telah diteruskan";
					$data['type'] = "info";



					$detail = $this->surat_keluar_model->get_detail_by_id($id_surat_keluar);
					$log_data = array(
						'action' => 'meneruskan',
						'function' => 'verifikasi surat',
						'key_name' => 'nomor registrasi sistem',
						'key_value' => $detail->hash_id,
						'category' => $this->uri->segment(1),
					);
					$this->logs_model->insert_log($log_data);

					//kirim notif ke pengguna
					$notif_data = array();
					$notif_data['title'] = 'Verifikasi Surat';
					$notif_data['message'] = 'Surat dengan nomor registrasi ' . $data['detail']->hash_id . ' telah disetujui dan diteruskan oleh verifikator surat';
					$notif_data['data'] = 'surat_eksternal/detail_surat_keluar';
					$notif_data['data_id'] = $id_surat_keluar;
					$notif_data['ntime'] = date('H:i:s');
					$notif_data['ndate'] = date('Y-m-d');
					$notif_data['user_id'] = $data['detail']->id_user_input;
					$notif_data['category'] = 'surat_eksternal/surat_keluar';
					$this->notification_model->insert($notif_data);
					$notif_data['link'] = base_url($notif_data['data'] . '/' . $notif_data['data_id']);
					$this->socketio->send('new_notification', $notif_data);
					$this->socketio->send('refresh_notification', array('user_id' => $notif_data['user_id']));


					//kirim notif ke pemeriksa selanjutnya
					$this->load->model('master_pegawai_model');
					$peg = $this->master_pegawai_model->get_by_id($_POST['id_pegawai_verifikasi_teruskan']);
					$id_user_pegawai_teruskan = $peg->id_user;
					// echo $id_user_pegawai_teruskan;die;
					$notif_data = array();
					$notif_data['title'] = 'Verifikasi Surat';
					$notif_data['message'] = 'Ada surat menunggu diverifikasi oleh Anda dengan nomor registrasi ' . $data['detail']->hash_id;
					$notif_data['data'] = 'surat_eksternal/verifikasi_surat_detail';
					$notif_data['data_id'] = $id_surat_keluar;
					$notif_data['ntime'] = date('H:i:s');
					$notif_data['ndate'] = date('Y-m-d');
					$notif_data['user_id'] = $id_user_pegawai_teruskan;
					$notif_data['category'] = 'surat_eksternal/verifikasi_surat';
					$this->notification_model->insert($notif_data);
					$notif_data['link'] = base_url($notif_data['data'] . '/' . $notif_data['data_id']);
					$this->socketio->send('new_notification', $notif_data);
					$this->socketio->send('refresh_notification', array('user_id' => $notif_data['user_id']));
				}
			}
			$data['detail'] = $this->surat_keluar_model->get_detail_by_id($id_surat_keluar);
			$data['detail_verifikasi'] = $this->surat_keluar_model->get_detail_verifikasi_by_id($id_surat_keluar);
			$data['array_id_verifikasi'] = explode(',', $data['detail']->id_verifikasi);
			$data['penerima'] = $this->surat_keluar_model->get_penerima($id_surat_keluar);
			$data['tembusan'] = $this->surat_keluar_model->get_tembusan_by_surat_keluar($id_surat_keluar);

			$data['unit_kerja'] = $this->surat_masuk_model->get_all_unit_kerja_by_skpd($this->session->userdata('id_skpd'));
			array_push($data['unit_kerja'], (object) array('id_unit_kerja' => "0", 'nama_unit_kerja' => 'Kepala SKPD'));
			$a = $this->ref_skpd_model->get_kepala_skpd($this->session->userdata('id_skpd'));

			$lastvalue = end($data['unit_kerja']);
			$lastkey = count($data['unit_kerja']) - 1;

			$arr1 = array($lastkey => $lastvalue);

			array_pop($data['unit_kerja']);

			$arr1 = array_merge($arr1, $data['unit_kerja']);

			$data['unit_kerja'] = $arr1;

			foreach ($data['unit_kerja'] as $u) {
				$data['pegawai'][$u->id_unit_kerja] = $this->surat_masuk_model->get_all_pegawai_by_unit_kerja($u->id_unit_kerja);
				// $data['pegawai'][0] = $this->surat_masuk_model->get_all_pegawai_by_unit_kerja($u->id_unit_kerja);
			}
			$data['pegawai1'] = $this->master_pegawai_model->get_by_id($this->id_pegawai_sekda);
			$this->load->view('admin/index', $data);
		} else {
			redirect('admin');
		}
	}
	public function tanggapan_surat_keluar()
	{
		if ($this->user_id) {
			$data['title'] = "respone Surat - Admin ";
			$data['content'] = "surat_eksternal/keluar/respone";
			$data['user_picture'] = $this->user_picture;
			$data['full_name'] = $this->full_name;
			$data['user_level'] = $this->user_level;
			$data['active_menu'] = "surat eksternal/tambah";
			$this->load->view('admin/index', $data);
		} else {
			redirect('admin');
		}
	}


	//Tanda Tangan
	public function tanda_tangan($summary_field = '', $summary_value = '')
	{
		if ($this->user_id) {
			$data['title'] = "tanda tangan Surat - Admin ";
			$data['content'] = "surat_eksternal/tanda_tangan/index";
			$data['user_picture'] = $this->user_picture;
			$data['full_name'] = $this->full_name;
			$data['user_level'] = $this->user_level;
			$data['active_menu'] = "surat_eksternal/tanda_tangan";

			$hal = 6;
			$page = isset($_GET["page"]) ? (int) $_GET["page"] : 1;
			$mulai = ($page > 1) ? ($page * $hal) - $hal : 0;
			$total = count($this->surat_keluar_model->get_all_eksternal_ttd($summary_field, $summary_value));
			$data['pages'] = ceil($total / $hal);
			$data['current'] = $page;
			if (!empty($_POST)) {
				$filter = $_POST;
				$data['filter'] = true;
				$data['filter_data'] = $_POST;
			} else {
				$filter = '';
				$data['filter'] = false;
			}
			$data['total'] = $this->surat_keluar_model->get_all_eksternal_ttd();
			$data['unsign'] = $this->surat_keluar_model->get_all_eksternal_unsign();
			$data['sign'] = $this->surat_keluar_model->get_all_eksternal_sign();
			$data['tolak'] = $this->surat_keluar_model->get_all_eksternal_tolak();
			$data['list'] = $this->surat_keluar_model->get_page_eksternal_ttd($mulai, $hal, $filter, $summary_field, $summary_value);
			if (!empty($summary_value) && !empty($summary_field)) {
				$data['summary_field'] = $summary_field;
				$data['summary_value'] = $summary_value;
			}

			$this->load->view('admin/index', $data);
		} else {
			redirect('admin');
		}
	}


	public function send_ulang($id_surat_keluar = '', $tembusan = '')
	{
		if (!empty($id_surat_keluar)) {
			$detail = $this->surat_keluar_model->get_detail_by_id($id_surat_keluar);
			if ($detail->status_ttd == 'sudah_ditandatangani') {
				$send_surat = $this->surat_masuk_model->add_by_surat_keluar($id_surat_keluar);
				// print_r($send_surat);die;
				foreach ($send_surat as $s) {
					//kirim notif ke penerima
					$detail_surat_masuk = $this->surat_masuk_model->get_detail_by_id($s['id_surat_masuk']);
					$notif_data = array();
					$notif_data['title'] = 'Surat Masuk';
					$notif_data['message'] = 'Ada surat masuk baru dengan perihal ' . $detail_surat_masuk->perihal;
					$notif_data['data'] = 'surat_eksternal/detail_surat_masuk';
					$notif_data['data_id'] = $s['id_surat_masuk'];
					$notif_data['ntime'] = date('H:i:s');
					$notif_data['ndate'] = date('Y-m-d');
					$notif_data['user_id'] = $s['id_user'];
					$notif_data['category'] = 'surat_eksternal/surat_masuk';
					$this->notification_model->insert($notif_data);
					$notif_data['link'] = base_url($notif_data['data'] . '/' . $notif_data['data_id']);
					$this->socketio->send('new_notification', $notif_data);
					$this->socketio->send('refresh_notification', array('user_id' => $notif_data['user_id']));
					echo "mengirim surat masuk ke " . $notif_data['user_id'] . "<br>";
				}
				if ($tembusan == 1) {
					$tembusan_s = $this->surat_keluar_model->get_tembusan_by_surat_keluar($id_surat_keluar);
					// print_r($send_surat);die;
					foreach ($tembusan_s as $t) {
						//kirim notif ke penerima
						$notif_data = array();
						$notif_data['title'] = 'Surat Tembusan';
						$notif_data['message'] = 'Ada surat tembusan baru dengan perihal ' . $t->perihal;
						$notif_data['data'] = 'surat_tembusan/detail';
						$notif_data['data_id'] = $t->id_surat_keluar_tembusan;
						$notif_data['ntime'] = date('H:i:s');
						$notif_data['ndate'] = date('Y-m-d');
						$notif_data['user_id'] = $t->id_user;
						$notif_data['category'] = 'surat_tembusan/index/' . $t->jenis_surat;
						$this->notification_model->insert($notif_data);
						$notif_data['link'] = base_url($notif_data['data'] . '/' . $notif_data['data_id']);
						$this->socketio->send('new_notification', $notif_data);
						$this->socketio->send('refresh_notification', array('user_id' => $notif_data['user_id']));
						echo "mengirim surat tembusan ke " . $notif_data['user_id'] . "<br>";
					}
				}
			} else {
				echo "belum ditandatangani";
			}
		}
	}

	public function tanda_tangan_detail($id_surat_keluar, $testing = "")
	{
		if ($this->user_id) {
			$this->filter_ttd($id_surat_keluar);
			$data['title'] = "detail Surat - Admin ";
			$data['content'] = "surat_eksternal/tanda_tangan/detail";
			$data['user_picture'] = $this->user_picture;
			$data['full_name'] = $this->full_name;
			$data['user_level'] = $this->user_level;
			$data['active_menu'] = "surat_eksternal/tanda_tangan_detail";

			$data['detail'] = $this->surat_keluar_model->get_detail_by_id($id_surat_keluar);
			$data['detail_ref'] = $this->ref_surat_model->get_by_id($data['detail']->id_ref_surat);
			if (!empty($_POST)) {
				if (isset($_POST['terima'])) {
					$this->load->model('user_model');
					$berkas = $this->surat_keluar_model->get_detail_by_id($id_surat_keluar);
					$user = $this->user_model->get_current_sertifikat_user();
					$cur_date = date("Ymdhis");
					$src = "./data/surat_eksternal/draf_pdf/{$berkas->file_verifikasi}";
					//$certificate = "./data/sertifikat/{$user->certificate}";
					$certificate = "/sertifikat/{$user->user_id}/{$user->certificate}";
					$input_name = $berkas->file_verifikasi;
					$output_name = "surat{$cur_date}{$berkas->hash_id}_(signed).pdf";
					$dest = "./data/surat_eksternal/ttd";
					$passkey = $_POST['passkey'];
					$pegawai = $this->master_pegawai_model->get_by_id($this->session->userdata('id_pegawai'));
					$nik = $pegawai->nik;

					if ($pegawai->ttd_cloud == "Y") {
						$data_specimen = '';
						if ($data['detail']->posisi_ttd == "Y") {
							$pegawai_ttd = $this->master_pegawai_model->get_by_id($data['detail']->id_pegawai_ttd);
							$this->load->library('imageTTD');
							$image_ttd = $this->imagettd->generate($pegawai_ttd->nama_lengkap, $pegawai_ttd->nip, $pegawai_ttd->jabatan);
							$file_image_ttd = "./data/image_ttd/ttd_image_" . $pegawai_ttd->id_pegawai . time() . ".png";
							$fp = fopen($file_image_ttd, 'w+');
							fputs($fp, base64_decode($image_ttd));
							fclose($fp);

							$data_specimen = [
								'llx' => $data['detail']->posisi_llx,
								'lly' => $data['detail']->posisi_lly,
								'urx' => $data['detail']->posisi_urx,
								'ury' => $data['detail']->posisi_ury,
								'image_ttd' => $file_image_ttd
							];
						}
						$ttd = tanda_tangan_cloud($src, $dest, $nik, $passkey, $output_name, $testing, $data_specimen);
						// print_r($ttd);
						// die;
					} else {
						$ttd = tanda_tangan_digital($src, $certificate, $dest, $passkey, $input_name, $output_name, $testing);
					}
					if (!$ttd['error']) {
						$file_ttd = $ttd['file_ttd'];

						$source = "./data/surat_eksternal/ttd/{$file_ttd}";
						$dest = "./data/surat_eksternal/surat_masuk/{$file_ttd}";


						copy($source, $dest);

						//baca notifikasi
						$read = $this->notification_model->read('surat_eksternal/tanda_tangan_detail', $id_surat_keluar);
						if ($read) {
							$this->socketio->send('refresh_notification', array('user_id' => $this->session->userdata('user_id')));
						}

						$this->surat_keluar_model->update_surat_keluar(array('status_ttd' => 'sudah_ditandatangani', 'tgl_ttd' => date('Y-m-d'), 'file_ttd' => $file_ttd), $id_surat_keluar);
						$data['message'] = $ttd['message'];
						$data['type'] = "success";


						//$this->surat_masuk_model->add_by_surat_keluar($id_surat_keluar);


						//kirim notif ke pembuat surat
						$notif_data = array();
						$notif_data['title'] = 'Tandatangan Surat';
						$notif_data['message'] = 'Surat dengan nomor registrasi ' . $data['detail']->hash_id . ' telah selesai ditandatangani dan di teruskan ke penerima';
						$notif_data['data'] = 'surat_eksternal/detail_surat_keluar';
						$notif_data['data_id'] = $id_surat_keluar;
						$notif_data['ntime'] = date('H:i:s');
						$notif_data['ndate'] = date('Y-m-d');
						$notif_data['user_id'] = $data['detail']->id_user_input;
						$notif_data['category'] = 'surat_eksternal/surat_keluar';
						$this->notification_model->insert($notif_data);
						$notif_data['link'] = base_url($notif_data['data'] . '/' . $notif_data['data_id']);
						$this->socketio->send('new_notification', $notif_data);
						$this->socketio->send('refresh_notification', array('user_id' => $notif_data['user_id']));

						if ($data['detail']->surat_jabar) {
							$date = date('YmdHis');
							$milliseconds = round(microtime(true) * 1000);
							$milliseconds = substr($milliseconds, -3);
							$tid = "3211" . $date . $milliseconds . "1";
							$update_tid = $this->db->update('surat_keluar', ['tid' => $tid], ['id_surat_keluar' => $id_surat_keluar]);
						}

						$send_surat = $this->surat_masuk_model->add_by_surat_keluar($id_surat_keluar, $testing);

						// if ($testing == 264358) {
						// 	print_r($send_surat);
						// 	die;
						// }

						foreach ($send_surat as $s) {
							if (isset($s['id_surat_masuk_verifikasi'])) {
								//kirim notif ke verifikator
								$detail_surat_masuk = $this->surat_masuk_model->get_detail_verifikasi($s['id_surat_masuk_verifikasi']);
								$detail_pegawai_penerima = $this->master_pegawai_model->get_by_id($detail_surat_masuk->id_pegawai_penerima);
								$notif_data = array();
								$notif_data['title'] = 'Verifikasi Surat Masuk';
								$notif_data['message'] = 'Ada surat masuk untuk ' . $detail_pegawai_penerima->nama_lengkap . ' menunggu diverifikasi oleh Anda dengan perihal ' . $detail_surat_masuk->perihal;
								$notif_data['data'] = 'surat_eksternal/detail_surat_masuk_verifikasi';
								$notif_data['data_id'] = $s['id_surat_masuk_verifikasi'];
								$notif_data['ntime'] = date('H:i:s');
								$notif_data['ndate'] = date('Y-m-d');
								$notif_data['user_id'] = $s['id_user'];
								$notif_data['category'] = 'surat_eksternal/surat_masuk_verifikasi';
								$this->notification_model->insert($notif_data);
								$notif_data['link'] = base_url($notif_data['data'] . '/' . $notif_data['data_id']);
								$this->socketio->send('new_notification', $notif_data);
								$this->socketio->send('refresh_notification', array('user_id' => $notif_data['user_id']));
							} else {

								//kirim notif ke penerima
								$detail_surat_masuk = $this->surat_masuk_model->get_detail_by_id($s['id_surat_masuk']);
								$notif_data = array();
								$notif_data['title'] = 'Surat Masuk';
								$notif_data['message'] = 'Ada surat masuk baru dengan perihal ' . $detail_surat_masuk->perihal;
								$notif_data['data'] = 'surat_eksternal/detail_surat_masuk';
								$notif_data['data_id'] = $s['id_surat_masuk'];
								$notif_data['ntime'] = date('H:i:s');
								$notif_data['ndate'] = date('Y-m-d');
								$notif_data['user_id'] = $s['id_user'];
								$notif_data['category'] = 'surat_eksternal/surat_masuk';
								$this->notification_model->insert($notif_data);
								$notif_data['link'] = base_url($notif_data['data'] . '/' . $notif_data['data_id']);
								$this->socketio->send('new_notification', $notif_data);
								$this->socketio->send('refresh_notification', array('user_id' => $notif_data['user_id']));
							}
						}
						$tembusan_s = $this->surat_keluar_model->get_tembusan_by_surat_keluar($id_surat_keluar);

						foreach ($tembusan_s as $t) {
							//kirim notif ke penerima
							$notif_data = array();
							$notif_data['title'] = 'Surat Tembusan';
							$notif_data['message'] = 'Ada surat tembusan baru dengan perihal ' . $t->perihal;
							$notif_data['data'] = 'surat_tembusan/detail';
							$notif_data['data_id'] = $t->id_surat_keluar_tembusan;
							$notif_data['ntime'] = date('H:i:s');
							$notif_data['ndate'] = date('Y-m-d');
							$notif_data['user_id'] = $t->id_user;
							$notif_data['category'] = 'surat_tembusan/index/' . $t->jenis_surat;
							$this->notification_model->insert($notif_data);
							$notif_data['link'] = base_url($notif_data['data'] . '/' . $notif_data['data_id']);
							$this->socketio->send('new_notification', $notif_data);
							$this->socketio->send('refresh_notification', array('user_id' => $notif_data['user_id']));
						}

						$detail = $this->surat_keluar_model->get_detail_by_id($id_surat_keluar);
						$log_data = array(
							'action' => 'melakukan',
							'function' => 'tandatangan surat',
							'key_name' => 'nomor registrasi sistem',
							'key_value' => $detail->hash_id,
							'category' => $this->uri->segment(1),
						);
						$this->logs_model->insert_log($log_data);
					} else {
						$data['message'] = $ttd['message'];
						$data['type'] = "info";
						$log_data = array(
							'action' => 'gagal melakukan',
							'function' => 'tandatangan surat dikarenakan ' . $ttd['message'],
							'key_name' => 'nomor registrasi sistem',
							'key_value' => $data['detail']->hash_id,
							'category' => 'surat_' . $data['detail']->jenis_surat,
						);

						$this->logs_model->insert_log($log_data);
					}
				} elseif (isset($_POST['tolak'])) {

					//baca notifikasi
					$read = $this->notification_model->read('surat_eksternal/tanda_tangan_detail', $id_surat_keluar);
					if ($read) {
						$this->socketio->send('refresh_notification', array('user_id' => $this->session->userdata('user_id')));
					}
					$this->surat_keluar_model->update_surat_keluar(array('status_ttd' => 'ditolak', 'alasan_penolakan_ttd' => $_POST['alasan_penolakan_ttd'], 'tgl_ttd' => date('Y-m-d')), $id_surat_keluar);
					$data['message'] = "Surat telah ditolak";
					$data['type'] = "danger";


					$detail = $this->surat_keluar_model->get_detail_by_id($id_surat_keluar);
					$log_data = array(
						'action' => 'menolak',
						'function' => 'tandatangan surat',
						'key_name' => 'nomor registrasi sistem',
						'key_value' => $detail->hash_id,
						'category' => $this->uri->segment(1),
					);
					$this->logs_model->insert_log($log_data);


					//kirim notif ke pembuat surat
					$notif_data = array();
					$notif_data['title'] = 'Tandatangan Surat';
					$notif_data['message'] = 'Surat dengan nomor registrasi ' . $data['detail']->hash_id . ' ditolak oleh penandatangan surat';
					$notif_data['data'] = 'surat_eksternal/detail_surat_keluar';
					$notif_data['data_id'] = $id_surat_keluar;
					$notif_data['ntime'] = date('H:i:s');
					$notif_data['ndate'] = date('Y-m-d');
					$notif_data['user_id'] = $data['detail']->id_user_input;
					$notif_data['category'] = 'surat_eksternal/surat_keluar';
					$this->notification_model->insert($notif_data);
					$notif_data['link'] = base_url($notif_data['data'] . '/' . $notif_data['data_id']);
					$this->socketio->send('new_notification', $notif_data);
					$this->socketio->send('refresh_notification', array('user_id' => $notif_data['user_id']));
				}
			}
			$data['detail'] = $this->surat_keluar_model->get_detail_by_id($id_surat_keluar);
			$data['penerima'] = $this->surat_keluar_model->get_penerima($id_surat_keluar);
			$data['tembusan'] = $this->surat_keluar_model->get_tembusan_by_surat_keluar($id_surat_keluar);
			$this->load->view('admin/index', $data);
		} else {
			redirect('admin');
		}
	}


	public function init_jabar($kode_wilayah = '')
	{
		$status = false;
		$message = '';
		$data = [];
		$get_eo = $this->db->get_where('surat_penerima_jabar', array('kode_wilayah' => $kode_wilayah))->row();
		if ($get_eo) {
			$getTujuan = $this->splpjabar->getTujuan($get_eo->path_endpoint);
			if (!$getTujuan) {
				$message = 'Gagal mengambil data Tujuan dari Ekosistem ' . $get_eo->nama_instansi;
				echo json_encode(array('status' => $status, 'message' => $message));
				exit;
			}
			$getKlasifikasi = $this->splpjabar->getKlasifikasi($get_eo->path_endpoint);
			if (!$getKlasifikasi) {
				$message = 'Gagal mengambil data Klasifikasi dari Ekosistem ' . $get_eo->nama_instansi;
				echo json_encode(array('status' => $status, 'message' => $message));
				exit;
			}

			$getJenisNaskah = $this->splpjabar->getJenisNaskah($get_eo->path_endpoint);
			if (!$getJenisNaskah) {
				$message = 'Gagal mengambil data Jenis Naskah dari Ekosistem ' . $get_eo->nama_instansi;
				echo json_encode(array('status' => $status, 'message' => $message));
				exit;
			}

			$getJenisLampiran = $this->splpjabar->getJenisLampiran($get_eo->path_endpoint);
			if (!$getJenisLampiran) {
				$message = 'Gagal mengambil data Jenis Lampiran dari Ekosistem ' . $get_eo->nama_instansi;
				echo json_encode(array('status' => $status, 'message' => $message));
				exit;
			}

			$getSifatNaskah = $this->splpjabar->getSifatNaskah($get_eo->path_endpoint);
			if (!$getSifatNaskah) {
				$message = 'Gagal mengambil data Sifat Naskah dari Ekosistem ' . $get_eo->nama_instansi;
				echo json_encode(array('status' => $status, 'message' => $message));
				exit;
			}

			$temp_klasifikasi = [];

			foreach ($getKlasifikasi as $k => $v) {
				if ($k < 50) {
					$temp_klasifikasi[] = $v;
				}
				$name = strtolower($v->name);
				if (strpos($name, 'undangan') !== false || strpos($name, 'edaran') !== false) {
					$temp_klasifikasi[] = $v;
				}
			}

			$data = ['tujuan' => $getTujuan, 'klasifikasi' => $temp_klasifikasi, 'jenis_naskah' => $getJenisNaskah, 'jenis_lampiran' => $getJenisLampiran, 'sifat_naskah' => $getSifatNaskah];
			$status = true;
		} else {
			$message = 'Kode Wilayah tidak ditemukan';
		}

		echo json_encode(array('status' => $status, 'message' => $message, 'data' => $data));
	}



	public function tanda_tangan_surat($id)
	{
		// GET DATA
		$berkas = $this->surat_keluar_model->get_detail_by_id($id);

		$this->load->model('user_model');
		$user = $this->user_model->get_current_sertifikat_user();

		if (empty($user->user_id) or empty($user->certificate) or empty($user->dot_key) or empty($user->pass_key)) {
			return false;
		} else {

			//load tcpdf
			$this->load->library("Pdf");

			// https://github.com/pauln/tcpdi
			// create new PDF document
			$pdf = new TCPDI('P', PDF_UNIT, 'LETTER', true, 'UTF-8', false);

			// Add a page from a PDF by file path.
			$pdfdata = file_get_contents("./data/surat_eksternal/draf_pdf/{$berkas->file_verifikasi}"); // Simulate only having raw data available.
			$pagecount = $pdf->setSourceData($pdfdata);
			for ($i = 1; $i <= $pagecount; $i++) {
				$tplidx = $pdf->importPage($i);
				$pdf->AddPage();
				$pdf->useTemplate($tplidx);
			}

			// set document information
			$pdf->SetCreator(PDF_CREATOR);
			$pdf->SetAuthor('SEKRETARIAT DAERAH');
			$pdf->SetTitle('KABUPATEN SUMEDANG');
			$pdf->SetSubject('');
			$pdf->SetKeywords('');

			$pdf->setPrintHeader(false);
			$pdf->setPrintFooter(false);

			// set default header data
			//$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 052', PDF_HEADER_STRING);

			// set header and footer fonts
			//$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
			//$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

			// set default monospaced font
			$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

			// set margins
			$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
			$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
			$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

			// set auto page breaks
			$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

			// set image scale factor
			$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

			// set some language-dependent strings (optional)
			if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
				require_once(dirname(__FILE__) . '/lang/eng.php');
				$pdf->setLanguageArray($l);
			}

			// ---------------------------------------------------------

			/*
			NOTES:
			- To create self-signed signature: openssl req -x509 -nodes -days 365000 -newkey rsa:1024 -keyout tcpdf.crt -out tcpdf.crt
			- To export crt to p12: openssl pkcs12 -export -in tcpdf.crt -out tcpdf.p12
			- To convert pfx certificate to pem: openssl pkcs12 -in tcpdf.pfx -out tcpdf.crt -nodes
			*/

			// set certificate file
			$certificate = "file://data/sertifikat/{$user->user_id}/{$user->certificate}";

			$key = "file://data/sertifikat/{$user->user_id}/{$user->dot_key}";

			$this->load->helper('encryption_helper');
			$ps = decode($user->pass_key);

			// set additional information
			$server = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] && !in_array(strtolower($_SERVER['HTTPS']), array('off', 'no'))) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'];
			$info = array(
				'Name' => 'SEKRTERARIAT DAERAH',
				'Location' => 'KABUPATEN SUMEDANG',
				'Reason' => 'SURAT DIGITAL',
				'ContactInfo' => $server,
			);

			// set document signature
			$pdf->setSignature($certificate, $key, $ps, '', 2, $info);

			// set font
			$pdf->SetFont('helvetica', '', 12);

			// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
			// *** set signature appearance ***

			// create content for signature (image and/or text)
			//$pdf->Image('data/sertifikat/ttd.png', 180, 60, 15, 15, 'PNG');

			// define active area for signature appearance
			//$pdf->setSignatureAppearance(180, 60, 15, 15);

			// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

			// *** set an empty signature appearance ***
			//$pdf->addEmptySignatureAppearance(180, 80, 15, 15);

			// ---------------------------------------------------------

			// make folder if not exist
			if (!file_exists("./data/surat_eksternal/ttd")) {
				mkdir("./data/surat_eksternal/ttd", 0777, true);
			}

			//Close and output PDF document
			ob_clean();

			$hash_id = strtoupper(hash("crc32b", crypt($id, str_pad('$1$sprazuto', 16, "0", STR_PAD_LEFT))));
			$cur_date = date("Ymdhis");
			$filename = "surat{$cur_date}{$berkas->hash_id}(verified).pdf";
			$pdf->Output($_SERVER['DOCUMENT_ROOT'] . "data/surat_eksternal/ttd/{$filename}", 'F');

			// backup to owner
			$source = "./data/surat_eksternal/ttd/{$filename}";
			$dest = "./data/surat_eksternal/surat_masuk/{$filename}";
			// $dest_raw = "./../global/berkas_sk/{$berkas[0]->no_ktp}/{$berkas[0]->berkas_revisi_sk}";
			// $last_space = strrpos($dest_raw, '/');
			// $file = substr($dest_raw, $last_space);
			// $dest = substr($dest_raw, 0, $last_space);

			//   	if (!file_exists($dest)) {
			//     mkdir($dest, 0777, true);
			// }
			copy($source, $dest);
			// readfile(".data/surat_keluar/{$id}/{$filename}");
			return $filename;
		}
		//============================================================+
		// END OF FILE
		//============================================================+

	}


	public function get_unit_kerja()
	{
		if (!empty($_POST)) {
			$id_skpd = $_POST['id_skpd'];
			$get = $this->data_model->get_unit_kerja(null, $id_skpd);
			echo '<option value="0">Pilih Unit Kerja</option>';
			foreach ($get as $g) {
				echo '<option value="' . $g->id_unit_kerja . '">' . $g->nama_unit_kerja . '</option>';
			}
		}
	}
	public function get_pegawai()
	{
		if (!empty($_POST)) {
			$id_unit_kerja = $_POST['id_unit_kerja'];
			$get = $this->data_model->get_pegawai(null, $id_unit_kerja);
			echo '<option value="0">Pilih Pegawai</option>';
			foreach ($get as $g) {
				echo '<option value="' . $g->id_pegawai . '">' . $g->nama_lengkap . '</option>';
			}
		}
	}

	public function delete_surat_keluar($id)
	{
		$this->filter_surat_keluar($id);
		$detail = $this->surat_keluar_model->get_detail_by_id($id);
		$log_data = array(
			'action' => 'menghapus',
			'function' => 'surat keluar internal',
			'key_name' => 'nomor registrasi sistem',
			'key_value' => $detail->hash_id,
			'category' => $this->uri->segment(1),
		);
		$this->logs_model->insert_log($log_data);
		$this->surat_keluar_model->delete_surat_keluar($id);
		echo json_encode(array('status' => true));
	}



	public function filter_surat_masuk($id)
	{
		$data['detail'] = $this->surat_masuk_model->get_detail_by_id($id);

		if (empty($data['detail'])) {
			show_404();
		}
		if ($this->user_level !== "Administrator") {
			if ($data['detail']->id_pegawai_input !== $this->id_pegawai && $data['detail']->id_pegawai_penerima !== $this->id_pegawai) {
				show_404();
			}
		}
	}

	public function filter_surat_keluar($id)
	{

		$data['detail'] = $this->surat_keluar_model->get_detail_by_id($id);

		if (empty($data['detail'])) {
			show_404();
		}
		if ($this->user_level !== "Administrator") {
			if ($data['detail']->id_pegawai_input !== $this->id_pegawai) {
				show_404();
			}
		}
	}

	public function filter_verifikator($id)
	{

		$data['detail'] = $this->surat_keluar_model->get_detail_by_id($id);

		if (empty($data['detail'])) {
			show_404();
		}
		if ($this->user_level !== "Administrator") {
			if ($data['detail']->id_pegawai_verifikasi !== $this->id_pegawai && !empty($data['detail']->status_verifikasi)) {
				show_404();
			}
		}
	}



	public function filter_ttd($id)
	{

		$data['detail'] = $this->surat_keluar_model->get_detail_by_id($id);

		if (empty($data['detail'])) {
			show_404();
		}
		if ($this->user_level !== "Administrator") {
			if ($data['detail']->id_pegawai_ttd !== $this->id_pegawai && !empty($data['detail']->status_ttd)) {
				show_404();
			}
		}
	}

	public function notification()
	{
		$this->load->view('admin/notification');
	}

	public function testo()
	{
		print_r($this->surat_masuk_model->getTokenKepalaSKPD(15));
	}
}