<?php
defined('BASEPATH') or exit('No direct script access allowed');
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

class Penomoran_surat extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('naskah/register_surat_model');
		$this->load->model('naskah/surat_keluar_model');
		$this->load->model('logs_model');
		$this->user_privileges = explode(";", $this->session->userdata('user_privileges'));
		$this->load->library('socketio', array('host' => "e-office.sumedangkab.go.id", 'port' => 3000));

	}

	public function index($summary_field = '', $summary_value = '')
	{

		if ($this->user_id) {
			$summary_value = urldecode($summary_value);
			$this->filter_penomoran();
			$data['title'] = "Penomoran Surat Keluar- Admin ";
			$data['content'] = "naskah/penomoran_surat/index";
			$data['user_picture'] = $this->user_picture;
			$data['full_name'] = $this->full_name;
			$data['user_level'] = $this->user_level;
			$data['active_menu'] = "penomoran_surat";

			$hal = 6;
			$page = isset($_GET["page"]) ? (int) $_GET["page"] : 1;
			$mulai = ($page > 1) ? ($page * $hal) - $hal : 0;
			$total = count($this->surat_keluar_model->get_all_penomoran($summary_field, $summary_value));
			$data['pages'] = ceil($total / $hal);
			$data['current'] = $page;
			if (!empty($_POST)) {
				$perihal = $_POST['perihal'];
				$hash_id = $_POST['hash_id'];
				$tgl_penerimaan = $_POST['tgl_penerimaan'];
				$data['filter'] = true;
				$data['perihal'] = $_POST['perihal'];
				$data['hash_id'] = $_POST['hash_id'];
				$data['tgl_penerimaan'] = $_POST['tgl_penerimaan'];
			} else {
				$filter = '';
				$data['filter'] = false;
				$perihal = '';
				$hash_id = '';
				$tgl_penerimaan = '';
			}
			$data['total'] = $this->surat_keluar_model->get_all_penomoran();
			$data['registered'] = $this->surat_keluar_model->get_all_penomoran_y();
			$data['unregistered'] = $this->surat_keluar_model->get_all_penomoran_n();
			$data['rejected'] = $this->surat_keluar_model->get_all_penomoran_t();
			$data['list'] = $this->surat_keluar_model->get_page_penomoran($mulai, $hal, $perihal, $hash_id, $tgl_penerimaan, $summary_field, $summary_value);
			if (!empty($summary_value) && !empty($summary_field)) {
				$data['summary_field'] = $summary_field;
				$data['summary_value'] = $summary_value;
			}

			$this->load->view('admin/index', $data);
		} else {
			redirect('admin');
		}
	}

	public function detail($id_surat_keluar)
	{
		if ($this->user_id) {
			$this->load->model('naskah/kartu_kendali_model', 'kartu_kendali');
			$this->filter_penomoran($id_surat_keluar);
			$data['title'] = "Detail Penomoran Surat Keluar - Admin ";
			$data['content'] = "naskah/penomoran_surat/detail";
			$data['user_picture'] = $this->user_picture;
			$data['full_name'] = $this->full_name;
			$data['user_level'] = $this->user_level;
			$data['active_menu'] = "penomoran_surat";

			$data['detail'] = $this->surat_keluar_model->get_detail_by_id($id_surat_keluar);
			$data['penerima'] = $this->surat_keluar_model->get_penerima($id_surat_keluar);

			$kartu_kendali = null;
			if ($data['detail']->status_penomoran == 'Y') {
				$where = array(
					'jenis_surat' => $data['detail']->jenis_surat,
					'tipe_kendali' => 'keluar',
					'sumber_surat' => 'surat_keluar',
					'skpd' => $data['detail']->id_skpd,
					'surat' => $id_surat_keluar
				);
				$kartu_kendali = $this->kartu_kendali->get_single_where($where);
			}

			$data['kartu_kendali'] = $kartu_kendali;

			//echo "<pre>";print_r($data['detail']);die;
			if (!empty($_POST)) {
				if (isset($_POST['nomer_surat'])) {
					if (!empty($_FILES)) {
						$config['upload_path'] = './data/' . $_POST['jenis_surat'] . '/draf_pdf/';
						$config['allowed_types'] = 'pdf';

						$input = array();
						$this->load->library('upload', $config);
						if (!$this->upload->do_upload('file_verifikasi')) {
							$tmp_name = $_FILES['file_verifikasi']['tmp_name'];
							if ($tmp_name != "") {
								$data['message'] = $this->upload->display_errors();
								$data['type'] = "danger";
							}
						} else {

							$read = $this->notification_model->read('penomoran_surat/detail', $id_surat_keluar);
							if ($read) {
								$this->socketio->send('refresh_notification', array('user_id' => $this->session->userdata('user_id')));
							}

							$this->surat_keluar_model->update_surat_keluar(array('status_penomoran' => 'Y', 'alasan_penolakan_penomoran' => NULL, 'nomer_surat' => $_POST['nomer_surat'], 'file_verifikasi' => $this->upload->data('file_name'), 'tgl_penomoran' => date('Y-m-d'), 'id_pegawai_penomoran' => $this->session->userdata('id_pegawai')), $id_surat_keluar);
							$data['message'] = "Surat telah diregister nomor";
							$data['type'] = "success";

							// Edited by Dinar
							$kartu_kendali_data = array(
								'indeks' => $this->input->post('indeks'),
								'lembar' => $this->input->post('lembar'),
								'isi_ringkasan' => $this->input->post('isi_ringkasan'),
								'catatan' => $this->input->post('catatan'),
								'jenis_surat' => $data['detail']->jenis_surat,
								'tipe_kendali' => 'keluar',
								'sumber_surat' => 'surat_keluar',
								//                                'pengolah'      => $this->session->userdata('id_pegawai'),
								'pengolah' => null,
								'surat' => $data['detail']->id_surat_keluar,
								'klasifikasi' => $data['detail']->surat_klasifikasi,
								'skpd' => $data['detail']->id_skpd,
								'temp' => 'Y',
							);

							if ($data['detail']->status_penomoran == 'Y') {
								// update kartu kendali
								$kartu_kendali_data['created_at'] = $data['kartu_kendali']->created_at;
								$kartu_kendali_data['updated_at'] = date('Y-m-d H:i:s');
								$this->kartu_kendali->update_entry($kartu_kendali_data, $data['kartu_kendali']->id);

							} else {
								// insert kartu kendali
								$kartu_kendali_data['created_at'] = date('Y-m-d H:i:s');
								$this->kartu_kendali->insert_entry($kartu_kendali_data);
							}
							// End edit

							//kirim notif ke penandatangan surat
							$notif_data = array();
							$notif_data['title'] = 'Tandatangan Surat';
							$notif_data['message'] = 'Ada surat menunggu ditandatangan oleh Anda dengan nomor registrasi ' . $data['detail']->hash_id;
							$notif_data['data'] = $_POST['jenis_surat'] . '/tanda_tangan_detail';
							$notif_data['data_id'] = $id_surat_keluar;
							$notif_data['ntime'] = date('H:i:s');
							$notif_data['ndate'] = date('Y-m-d');
							$notif_data['user_id'] = $data['detail']->id_user_ttd;
							$notif_data['category'] = $_POST['jenis_surat'] . '/tanda_tangan';
							$this->notification_model->insert($notif_data);
							$notif_data['link'] = base_url($notif_data['data'] . '/' . $notif_data['data_id']);
							$this->socketio->send('new_notification', $notif_data);
							$this->socketio->send('refresh_notification', array('user_id' => $notif_data['user_id']));

							//kirim notif ke pembuat surat
							$notif_data = array();
							$notif_data['title'] = 'Penomoran Surat';
							$notif_data['message'] = 'Surat dengan nomor registrasi ' . $data['detail']->hash_id . ' telah selesai dilakukan penomoran surat';
							$notif_data['data'] = $_POST['jenis_surat'] . '/detail_surat_keluar';
							$notif_data['data_id'] = $id_surat_keluar;
							$notif_data['ntime'] = date('H:i:s');
							$notif_data['ndate'] = date('Y-m-d');
							$notif_data['user_id'] = $data['detail']->id_user_input;
							$notif_data['category'] = $_POST['jenis_surat'] . '/surat_keluar';
							$this->notification_model->insert($notif_data);
							$notif_data['link'] = base_url($notif_data['data'] . '/' . $notif_data['data_id']);
							$this->socketio->send('new_notification', $notif_data);
							$this->socketio->send('refresh_notification', array('user_id' => $notif_data['user_id']));


							$detail = $this->surat_keluar_model->get_detail_by_id($id_surat_keluar);
							$log_data = array(
								'action' => 'melakukan',
								'function' => 'penomoran surat',
								'key_name' => 'nomor registrasi sistem',
								'key_value' => $detail->hash_id,
								'category' => $this->uri->segment(1),
							);
							$this->logs_model->insert_log($log_data);

							$app_token = $data['detail']->app_token_ttd;
							if ($app_token != null) {
								require(APPPATH . 'libraries/PushNotification/Firebase.php');
								$judul = $data['detail']->full_name_ttd . ", ada surat menunggu tanda tangan anda.";
								$pesan = "Perihal : " . $data['detail']->perihal;
								$click_action = "ttd";
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
									'status' => strtoupper(str_replace("_", " ", $data['detail']->status_ttd)),

								);
								$raw_data = json_encode($dataa);
								$firebase = new Firebase();
								$respone = $firebase->send($app_token, $judul, $pesan, $click_action, $data_id, $raw_data);
								//var_dump($respone);die;
							}
						}


					}
				} elseif (isset($_POST['tolak'])) {
					$this->surat_keluar_model->update_surat_keluar(array('status_penomoran' => 'T', 'alasan_penolakan_penomoran' => $_POST['alasan_penolakan_penomoran'], 'tgl_penomoran' => date('Y-m-d'), 'id_pegawai_penomoran' => $this->session->userdata('id_pegawai')), $id_surat_keluar);
					$data['message'] = "Surat telah ditolak";
					$data['type'] = "danger";
					$detail = $this->surat_keluar_model->get_detail_by_id($id_surat_keluar);
					$log_data = array(
						'action' => 'menolak',
						'function' => 'registrasi surat',
						'key_name' => 'nomor registrasi sistem',
						'key_value' => $detail->hash_id,
						'category' => $this->uri->segment(1),
					);
					$this->logs_model->insert_log($log_data);
					$notif_data = array();
					$notif_data['title'] = 'Penomoran Surat';
					$notif_data['message'] = 'Surat dengan nomor registrasi ' . $detail->hash_id . ' ditolak oleh Bagian Penomoran';
					$notif_data['data'] = 'surat_' . $data['detail']->jenis_surat . '/detail_surat_keluar';
					$notif_data['data_id'] = $id_surat_keluar;
					$notif_data['ntime'] = date('H:i:s');
					$notif_data['ndate'] = date('Y-m-d');
					$notif_data['user_id'] = $detail->id_user_input;
					$notif_data['category'] = 'surat_' . $data['detail']->jenis_surat . '/surat_keluar';
					$this->notification_model->insert($notif_data);
					$notif_data['link'] = base_url($notif_data['data'] . '/' . $notif_data['data_id']);
					$this->socketio->send('new_notification', $notif_data);
					$this->socketio->send('refresh_notification', array('user_id' => $notif_data['user_id']));

				}
			}
			$data['detail'] = $this->surat_keluar_model->get_detail_by_id($id_surat_keluar);
			$data['penerima'] = $this->surat_keluar_model->get_penerima($id_surat_keluar);

			$kartu_kendali = null;
			if ($data['detail']->status_penomoran == 'Y') {
				$where = array(
					'jenis_surat' => $data['detail']->jenis_surat,
					'tipe_kendali' => 'keluar',
					'sumber_surat' => 'surat_keluar',
					'skpd' => $data['detail']->id_skpd,
					'surat' => $id_surat_keluar
				);
				$kartu_kendali = $this->kartu_kendali->get_single_where($where);
			}

			$data['kartu_kendali'] = $kartu_kendali;

			$this->load->view('admin/index', $data);
		} else {
			redirect('admin');
		}
	}

	public function download($id_surat_keluar, $testing = 0)
	{

		if ($this->user_id) {
			$this->filter_penomoran($id_surat_keluar);

			$detail = $this->surat_keluar_model->get_detail_by_id($id_surat_keluar);

			if ($detail->jenis_surat == "internal") {
				$jenis_surat = "surat_internal";
			} elseif ($detail->jenis_surat == "eksternal") {
				$jenis_surat = "surat_eksternal";
			}

			if ($testing == 1) {
				$file_verifikasi = $detail->file_draft_surat;
				$template_path = './data/' . $jenis_surat . '/keluar/' . $file_verifikasi;

			} else {
				$file_verifikasi = $detail->file_verifikasi;
				$template_path = './data/' . $jenis_surat . '/draf_pdf/' . $file_verifikasi;

			}

			if ($testing == 1) {
				print_r($template_path);
				die;
			}



			$phpWord = new \PhpOffice\PhpWord\PhpWord();
			$phpWord->getCompatibility()->setOoxmlVersion(14);
			$phpWord->getCompatibility()->setOoxmlVersion(15);

			$filename = str_replace(',', '', $file_verifikasi);

			$template = $phpWord->loadTemplate($template_path);

			// $hash_id = $detail->hash_id;
			// $img_qr = get_qr_code($template_path,0,'jpeg');
			// $qrcode = generate_qr('https://e-office.sumedangkab.go.id/verifikasi_surat/id/'.$hash_id);
			// $template->setImageValue($img_qr, $qrcode);

			if ($testing == 1) {
				echo $img_qr . "<br>";
				die;
			}

			ob_clean();
			$template->saveAs("./data/temp_surat/" . $filename);
			// if(isset($_POST['download'])){
			header('Content-Description: File Transfer');
			header('Content-Type: application/octet-stream');
			header('Content-Disposition: attachment; filename=' . $filename);
			header('Content-Transfer-Encoding: binary');
			header('Expires: 0');
			header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
			header('Pragma: public');
			header('Content-Length: ' . filesize("./data/temp_surat/" . $filename));
			flush();
			readfile("./data/temp_surat/" . $filename);
			unlink("./data/temp_surat/" . $filename);
			// }
		}
	}


	public function surat_keluar()
	{

		if ($this->user_id) {
			$data['title'] = "Data Surat - Admin ";
			$data['content'] = "laporan_surat/surat_keluar";
			$data['user_picture'] = $this->user_picture;
			$data['full_name'] = $this->full_name;
			$data['user_level'] = $this->user_level;
			$data['active_menu'] = "laporan_surat";

			$data['surat_keluar'] = $this->laporan_surat_model->data_surat_keluar();

			$this->load->view('admin/index', $data);
		} else {
			redirect('admin');
		}
	}


	public function grafik_surat()
	{

		if ($this->user_id) {
			$data['title'] = "Grafik Surat - Admin ";
			$data['content'] = "laporan_surat/grafik_surat";
			$data['user_picture'] = $this->user_picture;
			$data['full_name'] = $this->full_name;
			$data['user_level'] = $this->user_level;
			$data['active_menu'] = "laporan_surat";

			$this->load->view('admin/index', $data);
		} else {
			redirect('admin');
		}
	}

	public function filter_penomoran($id = '')
	{
		if ($id !== '') {
			$data['detail'] = $this->surat_keluar_model->get_detail_by_id($id);

			if (empty($data['detail'])) {
				show_404();
			} else {
				//ID TU PIMPINAN SEKDA = 1
				if ($this->user_level !== "Administrator") {
					if ($this->session->userdata('id_skpd') == "1") {
						if ($data['detail']->kop_surat == "sekda" or $data['detail']->kop_surat == "bupati" or $data['detail']->kop_surat == 1) {
							// show_404();
						} else {
							show_404();
						}
					} elseif ($this->session->userdata('id_skpd') == "3") {
						if ($data['detail']->kop_surat == "231" or $data['detail']->kop_surat == "3") {
							// show_404();
						} else {
							show_404();
						}
					} else {
						if ($data['detail']->kop_surat != $this->session->userdata('id_skpd')) {
							show_404();
						}
					}

				}
			}
		}

		if ($this->user_level !== "Administrator") {
			if (!in_array('tu_pimpinan', $this->user_privileges)) {
				show_404();
			}
		}
	}

}