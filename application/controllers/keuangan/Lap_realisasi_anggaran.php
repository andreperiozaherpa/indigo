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

class lap_realisasi_anggaran extends CI_Controller
{
	public $user_id;

	public function __construct()
	{
		parent::__construct();
		$this->user_id = $this->session->userdata('user_id');


		$this->user_model->user_id = $this->user_id;
		$this->user_model->set_user_by_user_id();
		$this->load->model('ref_skpd_model');
		$this->load->model('lap_realisasi_anggaran_model');
		$this->load->model('logs_model');
		$this->load->library('encryption');
		$this->load->helper('encryption_helper');
		$this->load->library('wordPdf');

		$this->user_picture = $this->user_model->user_picture;
		$this->full_name	= $this->user_model->full_name;
		$this->user_level	= $this->user_model->level;
		$this->user_privileges	= $this->user_model->user_privileges;
		$array_privileges = explode(';', $this->user_privileges);


		// if (($this->user_level != "Administrator" && $this->user_level != "Admin Web") && !in_array('keuangan', $array_privileges)) redirect('welcome');
	}


	public function index()
	{
		if (($this->user_level != "Administrator" && $this->user_level != "Admin Web") && !in_array('keuangan', explode(';', $this->session->userdata('user_privileges')))) redirect('keuangan/lap_ttd');

		if ($this->user_id) {

			$data['title']		= "Keuangan - " . app_name;
			$data['content']	= "keuangan/lap_realisasi_anggaran/index";
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;

			$hal = 6;
			$page = isset($_GET["page"]) ? (int)$_GET["page"] : 1;
			$mulai = ($page > 1) ? ($page * $hal) - $hal : 0;
			$total = count($this->lap_realisasi_anggaran_model->get_all());
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
			$data['list'] = $this->lap_realisasi_anggaran_model->get_page($mulai, $hal, $filter);


			$data['active_menu'] = "lap_realisasi_anggaran";
			$this->load->view('admin/index', $data);
		} else {
			redirect('admin');
		}
	}


	public function add()
	{
		if (($this->user_level != "Administrator" && $this->user_level != "Admin Web") && !in_array('keuangan', explode(';', $this->session->userdata('user_privileges')))) redirect('welcome');

		if ($this->user_id) {

			$data['title']		= "Keuangan - " . app_name;
			$data['content']	= "keuangan/lap_realisasi_anggaran/add";
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;

			//$data['query']		= $this->agenda_model->get_all();
			$data['active_menu'] = "lap_realisasi_anggaran";

			$data['skpd'] = $this->ref_skpd_model->get_all();
			$data['pegawai_bpkad'] = $this->db->order_by('nama_lengkap', 'asc')->get_where('pegawai', ['id_skpd' => 25])->result();
			$data['sarerea_penandatangan'] = $this->db->get_where('sarerea_penandatangan', ['id' => 1])->row();
			//$data['pegawai_setda'] = $this->db->get_where('pegawai',['id_skpd'=>1])->result();

			if ($_POST) {
				// do {

				if (isset($_FILES['file_draft']['tmp_name'])) {
					$config['upload_path']          = './data/keuangan/tmp/';
					$config['allowed_types']        = 'pdf';

					$input = array();
					$this->load->library('upload', $config);
					if (!$this->upload->do_upload('file_draft')) {
						$tmp_name = $_FILES['file_draft']['tmp_name'];
						if ($tmp_name != "") {
							$data['message'] = $this->upload->display_errors();
							$data['message_type'] = "danger";
							// echo "1";
							// break;

						}
						// echo ".1";
					} else {
						$nama = $this->upload->data('file_name');
						$this->lap_realisasi_anggaran_model->file_draft = $nama;
						if ($nama) {
							$data['message'] = "File berhasil diupload";
							$data['message_type'] = 'success';
							echo "2";
						} else {

							$data['message'] = "Terjadi Kesalahan";
							$data['message_type'] = 'danger';
							// echo "3";
							// break;
						}
					}
				} else {
					$data['message'] = "Lampiran Belum Diisi";
					$data['message_type'] = 'danger';
					// echo "4";
					// break;
				}

				$this->lap_realisasi_anggaran_model->id_skpd = $_POST['id_skpd'];
				$this->lap_realisasi_anggaran_model->tgl_periode = $_POST['tgl_periode'];
				$this->lap_realisasi_anggaran_model->tgl_pengesahan = $_POST['tgl_pengesahan'];
				//
				$this->lap_realisasi_anggaran_model->pendapatan_asli = $_POST['pendapatan_asli'];
				$this->lap_realisasi_anggaran_model->pendapatan_transfer = $_POST['pendapatan_transfer'];
				$this->lap_realisasi_anggaran_model->pendapatan_lain = $_POST['pendapatan_lain'];
				$this->lap_realisasi_anggaran_model->total_pendapatan = $_POST['total_pendapatan'];
				$this->lap_realisasi_anggaran_model->belanja_operasi = $_POST['belanja_operasi'];
				$this->lap_realisasi_anggaran_model->belanja_pegawai = $_POST['belanja_pegawai'];
				$this->lap_realisasi_anggaran_model->belanja_barang_jasa = $_POST['belanja_barang_jasa'];
				$this->lap_realisasi_anggaran_model->belanja_bunga = $_POST['belanja_bunga'];
				$this->lap_realisasi_anggaran_model->belanja_hibah = $_POST['belanja_hibah'];
				$this->lap_realisasi_anggaran_model->belanja_bantuan_sosial = $_POST['belanja_bantuan_sosial'];
				$this->lap_realisasi_anggaran_model->jumlah_belanja_operasi = $_POST['jumlah_belanja_operasi'];
				$this->lap_realisasi_anggaran_model->belanja_modal = $_POST['belanja_modal'];
				$this->lap_realisasi_anggaran_model->belanja_m_tanah = $_POST['belanja_m_tanah'];
				$this->lap_realisasi_anggaran_model->belanja_m_peralatan_mesin = $_POST['belanja_m_peralatan_mesin'];
				$this->lap_realisasi_anggaran_model->belanja_m_gedung_bangunan = $_POST['belanja_m_gedung_bangunan'];
				$this->lap_realisasi_anggaran_model->belanja_m_jalan = $_POST['belanja_m_jalan'];
				$this->lap_realisasi_anggaran_model->belanja_m_aset_tetap = $_POST['belanja_m_aset_tetap'];
				$this->lap_realisasi_anggaran_model->belanja_m_aset_lainya = $_POST['belanja_m_aset_lainya'];
				$this->lap_realisasi_anggaran_model->jumlah_modal_belanja = $_POST['jumlah_modal_belanja'];
				$this->lap_realisasi_anggaran_model->belanja_tak_terduga = $_POST['belanja_tak_terduga'];
				$this->lap_realisasi_anggaran_model->transfer = $_POST['transfer'];
				$this->lap_realisasi_anggaran_model->total_belanja_transfer = $_POST['total_belanja_transfer'];
				$this->lap_realisasi_anggaran_model->surplus = $_POST['surplus'];
				$this->lap_realisasi_anggaran_model->penerimaan_pembiayaan = $_POST['penerimaan_pembiayaan'];
				$this->lap_realisasi_anggaran_model->pengeluaran_pembiayaan = $_POST['pengeluaran_pembiayaan'];
				$this->lap_realisasi_anggaran_model->pembiayaan_bersih = $_POST['pembiayaan_bersih'];
				//
				$this->lap_realisasi_anggaran_model->id_pegawai_1_bpkad = $_POST['id_pegawai_1_bpkad'];
				$this->lap_realisasi_anggaran_model->id_pegawai_2_bpkad = $_POST['id_pegawai_2_bpkad'];
				$this->lap_realisasi_anggaran_model->id_pegawai_3_bpkad = $_POST['id_pegawai_3_bpkad'];
				// $this->lap_realisasi_anggaran_model->id_pegawai_4_bpkad = $_POST['id_pegawai_4_bpkad'];
				$this->lap_realisasi_anggaran_model->id_pegawai_1_skpd = $_POST['id_pegawai_1_skpd'];
				$this->lap_realisasi_anggaran_model->id_pegawai_2_skpd = $_POST['id_pegawai_2_skpd'];
				$this->lap_realisasi_anggaran_model->id_pegawai_3_skpd = $_POST['id_pegawai_3_skpd'];
				// $this->lap_realisasi_anggaran_model->id_pegawai_4_skpd = $_POST['id_pegawai_4_skpd'];
				$this->lap_realisasi_anggaran_model->ttd_pegawai_1_bpkad = 'belum';
				$this->lap_realisasi_anggaran_model->ttd_pegawai_2_bpkad = 'belum';
				$this->lap_realisasi_anggaran_model->ttd_pegawai_3_bpkad = 'belum';
				$this->lap_realisasi_anggaran_model->ttd_pegawai_4_bpkad = 'belum';
				$this->lap_realisasi_anggaran_model->ttd_pegawai_1_skpd = 'belum';
				$this->lap_realisasi_anggaran_model->ttd_pegawai_2_skpd = 'belum';
				$this->lap_realisasi_anggaran_model->ttd_pegawai_3_skpd = 'belum';
				$this->lap_realisasi_anggaran_model->ttd_pegawai_4_skpd = 'belum';
				// $this->lap_realisasi_anggaran_model->file_draft = $_POST['file_draft'];
				// $this->lap_realisasi_anggaran_model->file_signed = $_POST['file_signed'];
				$this->lap_realisasi_anggaran_model->status = 'Proses';




				//tulis script php word disini



				$in = $this->lap_realisasi_anggaran_model->insert();
				if ($in) {

					$detail =  $this->lap_realisasi_anggaran_model->get_by_id($in);
					$phpWord = new \PhpOffice\PhpWord\PhpWord();
					$phpWord->getCompatibility()->setOoxmlVersion(14);
					$phpWord->getCompatibility()->setOoxmlVersion(15);

					//$template = $detail->file_draft;
					$filename = $detail->nama_skpd . '_LRA_' . time() . ".docx";
					$filename = str_replace(",", "", $filename);
					$filename = str_replace(" ", "_", $filename);
					$filename = str_replace("/", "_", $filename);
					//$filename = 'tes.docx';	
					$template_path = './data/keuangan/template/LRA_template.docx';

					$template = $phpWord->loadTemplate($template_path);

					$template->setValue('hari', poee(date('N', strtotime($detail->tgl_pengesahan))));
					$template->setValue('nama_skpd', strtoupper($detail->nama_skpd));
					$template->setValue('tgl_periode', tanggal($detail->tgl_periode));
					$template->setValue('thn_periode', date('Y', strtotime($detail->tgl_periode)) - 1);
					$tgl_pengesahan = terbilang(date('d', strtotime($detail->tgl_pengesahan))) . " bulan " . bulan(date('m', strtotime($detail->tgl_pengesahan))) . " tahun " . terbilang(date('Y', strtotime($detail->tgl_pengesahan)));
					$template->setValue('tgl_pengesahan', $tgl_pengesahan);


					//
					$template->setValue('pendapatan_asli', dot2_minus($detail->pendapatan_asli));
					$template->setValue('pendapatan_transfer', dot2_minus($detail->pendapatan_transfer));
					$template->setValue('pendapatan_lain', dot2_minus($detail->pendapatan_lain));
					$template->setValue('total_pendapatan', dot2_minus($detail->total_pendapatan));
					$template->setValue('belanja_operasi', dot2_minus($detail->belanja_operasi));
					$template->setValue('belanja_pegawai', dot2_minus($detail->belanja_pegawai));
					$template->setValue('belanja_barang_jasa', dot2_minus($detail->belanja_barang_jasa));
					$template->setValue('belanja_bunga', dot2_minus($detail->belanja_bunga));
					$template->setValue('belanja_hibah', dot2_minus($detail->belanja_hibah));
					$template->setValue('belanja_bantuan_sosial', dot2_minus($detail->belanja_bantuan_sosial));
					$template->setValue('jumlah_belanja_operasi', dot2_minus($detail->jumlah_belanja_operasi));
					$template->setValue('belanja_modal', dot2_minus($detail->belanja_modal));
					$template->setValue('belanja_m_tanah', dot2_minus($detail->belanja_m_tanah));
					$template->setValue('belanja_m_peralatan_mesin', dot2_minus($detail->belanja_m_peralatan_mesin));
					$template->setValue('belanja_m_gedung_bangunan', dot2_minus($detail->belanja_m_gedung_bangunan));
					$template->setValue('belanja_m_jalan', dot2_minus($detail->belanja_m_jalan));
					$template->setValue('belanja_m_aset_tetap', dot2_minus($detail->belanja_m_aset_tetap));
					$template->setValue('belanja_m_aset_lainya', dot2_minus($detail->belanja_m_aset_lainya));
					$template->setValue('jumlah_modal_belanja', dot2_minus($detail->jumlah_modal_belanja));
					$template->setValue('belanja_tak_terduga', dot2_minus($detail->belanja_tak_terduga));
					$template->setValue('transfer', dot2_minus($detail->transfer));
					$template->setValue('total_belanja_transfer', dot2_minus($detail->total_belanja_transfer));
					$template->setValue('surplus', dot2_minus($detail->surplus));
					$template->setValue('penerimaan_pembiayaan', dot2_minus($detail->penerimaan_pembiayaan));
					$template->setValue('pengeluaran_pembiayaan', dot2_minus($detail->pengeluaran_pembiayaan));
					$template->setValue('pembiayaan_bersih', dot2_minus($detail->pembiayaan_bersih));
					//

					$template->setValue('nama_pegawai_1_bpkad', $detail->nama_1_bpkad);
					$template->setValue('nama_pegawai_2_bpkad', $detail->nama_2_bpkad);
					$template->setValue('nama_pegawai_3_bpkad', $detail->nama_3_bpkad);
					$template->setValue('nama_pegawai_4_bpkad', $detail->nama_4_bpkad);
					$template->setValue('nama_pegawai_1_skpd', $detail->nama_1_skpd);
					$template->setValue('nama_pegawai_2_skpd', $detail->nama_2_skpd);
					$template->setValue('nama_pegawai_3_skpd', $detail->nama_3_skpd);
					$template->setValue('nama_pegawai_4_skpd', $detail->nama_4_skpd);
					$template->setValue('jabatan_pegawai_1_bpkad', $detail->jabatan_1_bpkad);
					$template->setValue('jabatan_pegawai_2_bpkad', $detail->jabatan_2_bpkad);
					$template->setValue('jabatan_pegawai_3_bpkad', $detail->jabatan_3_bpkad);
					$template->setValue('jabatan_pegawai_4_bpkad', $detail->jabatan_4_bpkad);
					$template->setValue('jabatan_pegawai_1_skpd', $detail->jabatan_1_skpd);
					$template->setValue('jabatan_pegawai_2_skpd', $detail->jabatan_2_skpd);
					$template->setValue('jabatan_pegawai_3_skpd', $detail->jabatan_3_skpd);
					$template->setValue('jabatan_pegawai_4_skpd', $detail->jabatan_4_skpd);
					$template->setValue('nip_pegawai_1_bpkad', $detail->nip1);
					$template->setValue('nip_pegawai_2_bpkad', $detail->nip2);
					$template->setValue('nip_pegawai_3_bpkad', $detail->nip3);
					$template->setValue('nip_pegawai_4_bpkad', $detail->nip4);
					$template->setValue('nip_pegawai_1_skpd', $detail->nip5);
					$template->setValue('nip_pegawai_2_skpd', $detail->nip6);
					$template->setValue('nip_pegawai_3_skpd', $detail->nip7);
					$template->setValue('nip_pegawai_4_skpd', $detail->nip8);

					$template->setValue('pendapatan', rp_minus($detail->total_pendapatan));
					$terbilang_pendapatan = terbilang_koma_minus($detail->total_pendapatan);
					$template->setValue('terbilang_pendapatan', $terbilang_pendapatan);

					$template->setValue('total_belanja', rp_minus($detail->total_belanja_transfer));
					$terbilang_total_belanja = terbilang_koma_minus($detail->total_belanja_transfer);
					$template->setValue('terbilang_total_belanja', $terbilang_total_belanja);





					ob_clean();
					$template->saveAs("./data/keuangan/tmp/" . $filename);
					$file_pdf = $this->wordpdf->convert("data/keuangan/tmp/" . $filename);
					//fwrite file_pdf to /data/keuangan/

					
					$berkas_pdf  = pathinfo("./data/keuangan/tmp/{$filename}", PATHINFO_FILENAME).".pdf";

					$file = fopen("./data/keuangan/".$berkas_pdf,"w");
					fwrite($file, base64_decode($file_pdf));
					fclose($file);
					// die;

					// shell_exec("lowriter  --convert-to pdf ./data/keuangan/tmp/{$filename} --outdir ./data/keuangan/ 2>&1");
					// $berkas_pdf  = pathinfo("./data/keuangan/tmp/{$filename}", PATHINFO_FILENAME) . ".pdf";
					unlink("./data/keuangan/tmp/" . $filename);

					$this->db->set('file_signed_draft', $berkas_pdf);
					$this->db->set('tgl_upload', date('Y-m-d H:i:s'));
					$this->db->where('id_laporan_realisasi_anggaran', $in);
					$this->db->update('laporan_realisasi_anggaran');
					// header('Content-Description: File Transfer');
					// header('Content-Type: application/octet-stream');
					// header('Content-Disposition: attachment; filename='.$filename);
					// header('Content-Transfer-Encoding: binary');
					// header('Expires: 0');
					// header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
					// header('Pragma: public');
					// header('Content-Length: ' . filesize("./data/keuangan/tmp/".$filename));
					// flush();
					//readfile("./data/keuangan/tmp/".$filename);
					// unlink("./data/keuangan/tmp/".$filename);


					$data['message'] = '<b>Sukses</b> Data berhasil ditambahkan';
					$data['message_type'] = 'success';
					redirect(base_url('keuangan/lap_realisasi_anggaran/detail/' . encode($in) . '?msg=' . urlencode($data['message'])));
				} else {

					$data['message'] = 'Terjadi kesalahan';
					$data['message_type'] = 'danger';
				}
			}

			$this->load->view('admin/index', $data);
		} else {
			redirect('admin');
		}
	}


	public function detail($id_laporan_realisasi_anggaran)
	{
		if ($this->user_id) {
			$id_laporan_realisasi_anggaran = decode($id_laporan_realisasi_anggaran);
			$data['title']		= "Keuangan - " . app_name;
			$data['content']	= "keuangan/lap_realisasi_anggaran/detail";
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;

			$data['detail']		= $this->lap_realisasi_anggaran_model->get_by_id($id_laporan_realisasi_anggaran);

			if ($this->input->get('msg') == 'sukses') {

				$data['message'] = '<b>Sukses</b> Data berhasil ditambahkan';
				$data['message_type'] = 'success';
			}

			if (!empty($_FILES)) {
				$config['upload_path']          = './data/keuangan/tmp/';
				$config['allowed_types']        = 'pdf';

				$input = array();
				$this->load->library('upload', $config);
				if (!$this->upload->do_upload('file_signed_draft')) {
					$tmp_name = $_FILES['file_signed_draft']['tmp_name'];
					if ($tmp_name != "") {
						$data['message'] = $this->upload->display_errors();
						$data['message_type'] = "danger";
					}
				} else {
					$nama = $this->upload->data('file_name');
					$data_up = array(
						'file_signed_draft' => $nama,
						'tgl_upload' => date('Y-m-d H:i:s'),
						'ttd_pegawai_1_bpkad' => 'belum',
						'ttd_pegawai_2_bpkad' => 'belum',
						'ttd_pegawai_3_bpkad' => 'belum',
						'ttd_pegawai_4_bpkad' => 'belum',
						'ttd_pegawai_1_skpd' => 'belum',
						'ttd_pegawai_2_skpd' => 'belum',
						'ttd_pegawai_3_skpd' => 'belum',
						'ttd_pegawai_4_skpd' => 'belum',
					);
					$up = $this->db->update('laporan_realisasi_anggaran', $data_up, ['id_laporan_realisasi_anggaran' => $id_laporan_realisasi_anggaran]);
					if ($up) {
						$data['message'] = "File berhasil diupload";
						$data['message_type'] = 'success';
					} else {

						$data['message'] = "Terjadi Kesalahan";
						$data['message_type'] = 'danger';
					}
				}
			}

			if (!empty($_POST)) {
				if (isset($_POST['terima'])) {
					$this->load->model('user_model');
					$this->load->model('master_pegawai_model');
					$get_data 	 = $this->lap_realisasi_anggaran_model->get_by_id($id_laporan_realisasi_anggaran);
					$user 		 = $this->user_model->get_current_sertifikat_user();
					$cur_date 	 = date("Ymdhis");
					$berkas		 = !empty($get_data->file_signed_draft) ? $get_data->file_signed_draft : "tmp/" . $get_data->file_draft;
					$src 		 = "./data/keuangan/" . $berkas;
					// $src 		 = "./data/keuangan/".$berkas;
					//$certificate = "./data/sertifikat/{$user->certificate}";
					$certificate = "/sertifikat/{$user->user_id}/{$user->certificate}";
					$input_name	 = !empty($get_data->file_signed_draft) ? $get_data->file_signed_draft : $get_data->file_draft;
					$filename = $get_data->nama_skpd . '_LRA_' . time();
					$filename = str_replace(",", "", $filename);
					$filename = str_replace(" ", "_", $filename);
					$filename = str_replace("/", "_", $filename);
					$output_name = "{$filename}_(signed).pdf";
					$dest 		 = "./data/keuangan";
					$passkey  	 = $_POST['passkey'];
					$pegawai 	 = $this->master_pegawai_model->get_by_id($this->session->userdata('id_pegawai'));
					if ($passkey == "ujicoba") {
						$pegawai 	= $this->master_pegawai_model->get_by_id(10472);
						$passkey	= "c0c0d0t!";
					}
					$nik		 = $pegawai->nik;

					// if ($pegawai->id_pegawai==77) {
					$ttd = tanda_tangan_cloud($src, $dest, $nik, $passkey, $output_name);
					// } else {
					// $ttd = tanda_tangan_digital($src, $certificate, $dest, $passkey, $input_name, $output_name, $testing);
					// }
					// var_dump($src);
					// 	var_dump($ttd); die();
					if (!$ttd['error']) {
						$file_ttd = $ttd['file_ttd'];

						if ($get_data->ttd_pegawai_2_skpd != "setuju") {
							$this->db->set('ttd_pegawai_2_skpd', 'setuju');
							$this->db->set('tgl_pegawai_2_skpd', date('Y-m-d H:i:s'));
						} elseif ($get_data->ttd_pegawai_1_skpd != "setuju") {
							$this->db->set('ttd_pegawai_1_skpd', 'setuju');
							$this->db->set('tgl_pegawai_1_skpd', date('Y-m-d H:i:s'));
						} elseif ($get_data->ttd_pegawai_2_bpkad != "setuju") {
							$this->db->set('ttd_pegawai_2_bpkad', 'setuju');
							$this->db->set('tgl_pegawai_2_bpkad', date('Y-m-d H:i:s'));
						} elseif ($get_data->ttd_pegawai_1_bpkad != "setuju") {
							$this->db->set('ttd_pegawai_1_bpkad', 'setuju');
							$this->db->set('tgl_pegawai_1_bpkad', date('Y-m-d H:i:s'));

							$this->db->set('tgl_selesai', date('Y-m-d H:i:s'));
							$this->db->set('status', 'Selesai');
							$this->db->set('file_signed', $file_ttd);
						}
						$this->db->set('file_signed_draft', $file_ttd);
						$this->db->where('id_laporan_realisasi_anggaran', $id_laporan_realisasi_anggaran);
						$this->db->update('laporan_realisasi_anggaran');


						// $source = "./data/surat_eksternal/ttd/{$file_ttd}";
						// $dest = "./data/surat_eksternal/surat_masuk/{$file_ttd}";


						// copy($source, $dest);

						//baca notifikasi
						// $read = $this->notification_model->read('surat_eksternal/tanda_tangan_detail', $id_surat_keluar);
						// if ($read) {
						// 	$this->socketio->send('refresh_notification', array('user_id' => $this->session->userdata('user_id')));
						// }

						// $this->surat_keluar_model->update_surat_keluar(array('status_ttd' => 'sudah_ditandatangani', 'tgl_ttd' => date('Y-m-d'), 'file_ttd' => $file_ttd), $id_surat_keluar);
						$data['message'] = $ttd['message'];
						$data['message_type'] = "success";


						//$this->surat_masuk_model->add_by_surat_keluar($id_surat_keluar);


						//kirim notif ke pembuat surat
						// $notif_data = array();
						// $notif_data['title'] = 'Tandatangan Surat';
						// $notif_data['message'] = 'Surat dengan nomor registrasi ' . $data['detail']->hash_id . ' telah selesai ditandatangani dan di teruskan ke penerima';
						// $notif_data['data'] = 'surat_eksternal/detail_surat_keluar';
						// $notif_data['data_id'] = $id_surat_keluar;
						// $notif_data['ntime'] = date('H:i:s');
						// $notif_data['ndate'] = date('Y-m-d');
						// $notif_data['user_id'] = $data['detail']->id_user_input;
						// $notif_data['category'] = 'surat_eksternal/surat_keluar';
						// $this->notification_model->insert($notif_data);
						// $notif_data['link'] = base_url($notif_data['data'] . '/' . $notif_data['data_id']);
						// $this->socketio->send('new_notification', $notif_data);
						// $this->socketio->send('refresh_notification', array('user_id' => $notif_data['user_id']));


						// $send_surat = $this->surat_masuk_model->add_by_surat_keluar($id_surat_keluar, $testing);
						// if($testing==264358){
						// print_r($send_surat);die;
						// }
						/*foreach ($send_surat as $s) {
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
						$tembusan_s = $this->surat_keluar_model->get_tembusan_by_surat_keluar($id_surat_keluar);*/

						/*foreach ($tembusan_s as $t) {
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
						}*/

						/*$detail = $this->surat_keluar_model->get_detail_by_id($id_surat_keluar);
						$log_data = array(
							'action' => 'melakukan',
							'function' => 'tandatangan surat',
							'key_name' => 'nomor registrasi sistem',
							'key_value' => $detail->hash_id,
							'category' => $this->uri->segment(1),
						);
						$this->logs_model->insert_log($log_data);*/
					} else {
						$data['message'] = $ttd['message'];
						$data['message_type'] = "info";
						$log_data = array(
							'action' => 'gagal melakukan',
							'function' => 'tandatangan laporan keuangan ' . $ttd['message'],
							'key_name' => 'nomor registrasi sistem',
							'key_value' => $id_laporan_realisasi_anggaran,
							'category' => 'surat_LRA',
						);

						$this->logs_model->insert_log($log_data);
					}
				} elseif (isset($_POST['tolak'])) {

					$get_data 	 = $this->lap_realisasi_anggaran_model->get_by_id($id_laporan_realisasi_anggaran);
					//baca notifikasi
					if ($get_data->ttd_pegawai_2_skpd != "setuju") {
						$this->db->set('ttd_pegawai_2_skpd', 'ditolak');
						$this->db->set('tgl_pegawai_2_skpd', date('Y-m-d H:i:s'));
					} elseif ($get_data->ttd_pegawai_1_skpd != "setuju") {
						$this->db->set('ttd_pegawai_1_skpd', 'ditolak');
						$this->db->set('tgl_pegawai_1_skpd', date('Y-m-d H:i:s'));
					} elseif ($get_data->ttd_pegawai_2_bpkad != "setuju") {
						$this->db->set('ttd_pegawai_2_bpkad', 'ditolak');
						$this->db->set('tgl_pegawai_2_bpkad', date('Y-m-d H:i:s'));
					} elseif ($get_data->ttd_pegawai_1_bpkad != "setuju") {
						$this->db->set('ttd_pegawai_1_bpkad', 'ditolak');
						$this->db->set('tgl_pegawai_1_bpkad', date('Y-m-d H:i:s'));
					}
					$this->db->set('status', 'Ditolak');
					$this->db->set('alasan_penolakan', $_POST['alasan_penolakan_ttd']);
					$this->db->where('id_laporan_realisasi_anggaran', $id_laporan_realisasi_anggaran);
					$this->db->update('laporan_realisasi_anggaran');
					$data['message'] = "Surat telah ditolak";
					$data['message_type'] = "danger";
				}
			}

			$data['active_menu'] = "lap_realisasi_anggaran";
			$data['detail']		= $this->lap_realisasi_anggaran_model->get_by_id($id_laporan_realisasi_anggaran);
			$this->load->view('admin/index', $data);
		} else {
			redirect('admin');
		}
	}

	public function edit($id_laporan_realisasi_anggaran)
	{
		if (($this->user_level != "Administrator" && $this->user_level != "Admin Web") && !in_array('keuangan', explode(';', $this->session->userdata('user_privileges')))) redirect('welcome');
		$id_laporan_realisasi_anggaran = decode($id_laporan_realisasi_anggaran);
		if ($this->user_id) {

			$data['title']		= "Keuangan - " . app_name;
			$data['content']	= "keuangan/lap_realisasi_anggaran/edit";
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;

			$data['skpd'] = $this->ref_skpd_model->get_all();
			$data['pegawai_bpkad'] = $this->db->order_by('nama_lengkap', 'asc')->get_where('pegawai', ['id_skpd' => 25])->result();
			// $data['pegawai_setda'] = $this->db->get_where('pegawai', ['id_skpd' => 1])->result();



			if ($_POST) {


				// do {

				if (isset($_FILES['file_draft']['tmp_name'])) {
					$config['upload_path']          = './data/keuangan/tmp/';
					$config['allowed_types']        = 'pdf';

					$input = array();
					$this->load->library('upload', $config);
					if (!$this->upload->do_upload('file_draft')) {
						$tmp_name = $_FILES['file_draft']['tmp_name'];
						if ($tmp_name != "") {
							$data['message'] = $this->upload->display_errors();
							$data['message_type'] = "danger";
							// echo "1";
							// break;

						}
						// echo ".1";
					} else {
						$nama = $this->upload->data('file_name');
						$this->lap_realisasi_anggaran_model->file_draft = $nama;
						if ($nama) {
							$data['message'] = "File berhasil diupload";
							$data['message_type'] = 'success';
							echo "2";
						} else {

							$data['message'] = "Terjadi Kesalahan";
							$data['message_type'] = 'danger';
							// echo "3";
							// break;
						}
					}
				} else {
					$data['message'] = "Lampiran Belum Diisi";
					$data['message_type'] = 'danger';
					// echo "4";
					// break;
				}

				$this->lap_realisasi_anggaran_model->id_skpd = $_POST['id_skpd'];
				$this->lap_realisasi_anggaran_model->tgl_periode = $_POST['tgl_periode'];
				$this->lap_realisasi_anggaran_model->tgl_pengesahan = $_POST['tgl_pengesahan'];

				//
				$this->lap_realisasi_anggaran_model->pendapatan_asli = $_POST['pendapatan_asli'];
				$this->lap_realisasi_anggaran_model->pendapatan_transfer = $_POST['pendapatan_transfer'];
				$this->lap_realisasi_anggaran_model->pendapatan_lain = $_POST['pendapatan_lain'];
				$this->lap_realisasi_anggaran_model->total_pendapatan = $_POST['total_pendapatan'];
				$this->lap_realisasi_anggaran_model->belanja_operasi = $_POST['belanja_operasi'];
				$this->lap_realisasi_anggaran_model->belanja_pegawai = $_POST['belanja_pegawai'];
				$this->lap_realisasi_anggaran_model->belanja_barang_jasa = $_POST['belanja_barang_jasa'];
				$this->lap_realisasi_anggaran_model->belanja_bunga = $_POST['belanja_bunga'];
				$this->lap_realisasi_anggaran_model->belanja_hibah = $_POST['belanja_hibah'];
				$this->lap_realisasi_anggaran_model->belanja_bantuan_sosial = $_POST['belanja_bantuan_sosial'];
				$this->lap_realisasi_anggaran_model->jumlah_belanja_operasi = $_POST['jumlah_belanja_operasi'];
				$this->lap_realisasi_anggaran_model->belanja_modal = $_POST['belanja_modal'];
				$this->lap_realisasi_anggaran_model->belanja_m_tanah = $_POST['belanja_m_tanah'];
				$this->lap_realisasi_anggaran_model->belanja_m_peralatan_mesin = $_POST['belanja_m_peralatan_mesin'];
				$this->lap_realisasi_anggaran_model->belanja_m_gedung_bangunan = $_POST['belanja_m_gedung_bangunan'];
				$this->lap_realisasi_anggaran_model->belanja_m_jalan = $_POST['belanja_m_jalan'];
				$this->lap_realisasi_anggaran_model->belanja_m_aset_tetap = $_POST['belanja_m_aset_tetap'];
				$this->lap_realisasi_anggaran_model->belanja_m_aset_lainya = $_POST['belanja_m_aset_lainya'];
				$this->lap_realisasi_anggaran_model->jumlah_modal_belanja = $_POST['jumlah_modal_belanja'];
				$this->lap_realisasi_anggaran_model->belanja_tak_terduga = $_POST['belanja_tak_terduga'];
				$this->lap_realisasi_anggaran_model->transfer = $_POST['transfer'];
				$this->lap_realisasi_anggaran_model->total_belanja_transfer = $_POST['total_belanja_transfer'];
				$this->lap_realisasi_anggaran_model->surplus = $_POST['surplus'];
				$this->lap_realisasi_anggaran_model->penerimaan_pembiayaan = $_POST['penerimaan_pembiayaan'];
				$this->lap_realisasi_anggaran_model->pengeluaran_pembiayaan = $_POST['pengeluaran_pembiayaan'];
				$this->lap_realisasi_anggaran_model->pembiayaan_bersih = $_POST['pembiayaan_bersih'];
				//


				$this->lap_realisasi_anggaran_model->id_pegawai_1_bpkad = $_POST['id_pegawai_1_bpkad'];
				$this->lap_realisasi_anggaran_model->id_pegawai_2_bpkad = $_POST['id_pegawai_2_bpkad'];
				$this->lap_realisasi_anggaran_model->id_pegawai_3_bpkad = $_POST['id_pegawai_3_bpkad'];
				// $this->lap_realisasi_anggaran_model->id_pegawai_4_bpkad = $_POST['id_pegawai_4_bpkad'];
				$this->lap_realisasi_anggaran_model->id_pegawai_1_skpd = $_POST['id_pegawai_1_skpd'];
				$this->lap_realisasi_anggaran_model->id_pegawai_2_skpd = $_POST['id_pegawai_2_skpd'];
				$this->lap_realisasi_anggaran_model->id_pegawai_3_skpd = $_POST['id_pegawai_3_skpd'];
				// $this->lap_realisasi_anggaran_model->id_pegawai_4_skpd = $_POST['id_pegawai_4_skpd'];
				$this->lap_realisasi_anggaran_model->ttd_pegawai_1_bpkad = 'belum';
				$this->lap_realisasi_anggaran_model->ttd_pegawai_2_bpkad = 'belum';
				$this->lap_realisasi_anggaran_model->ttd_pegawai_3_bpkad = 'belum';
				$this->lap_realisasi_anggaran_model->ttd_pegawai_4_bpkad = 'belum';
				$this->lap_realisasi_anggaran_model->ttd_pegawai_1_skpd = 'belum';
				$this->lap_realisasi_anggaran_model->ttd_pegawai_2_skpd = 'belum';
				$this->lap_realisasi_anggaran_model->ttd_pegawai_3_skpd = 'belum';
				$this->lap_realisasi_anggaran_model->ttd_pegawai_4_skpd = 'belum';
				$this->lap_realisasi_anggaran_model->status_verifikasi = 'belum';
				$this->lap_realisasi_anggaran_model->alasan_penolakan = '';
				// $this->lap_realisasi_anggaran_model->file_draft = $_POST['file_draft'];
				// $this->lap_realisasi_anggaran_model->file_signed = $_POST['file_signed'];
				$this->lap_realisasi_anggaran_model->status = 'Proses';


				//tulis script php word disini



				$this->lap_realisasi_anggaran_model->update($id_laporan_realisasi_anggaran);
				$in = $id_laporan_realisasi_anggaran;



				if ($in) {

					$detail =  $this->lap_realisasi_anggaran_model->get_by_id($in);
					$phpWord = new \PhpOffice\PhpWord\PhpWord();
					$phpWord->getCompatibility()->setOoxmlVersion(14);
					$phpWord->getCompatibility()->setOoxmlVersion(15);

					//$template = $detail->file_draft;
					$filename = $detail->nama_skpd . '_LRA_' . time() . ".docx";
					$filename = str_replace(",", "", $filename);
					$filename = str_replace(" ", "_", $filename);
					$filename = str_replace("/", "_", $filename);
					//$filename = 'tes.docx';	
					$template_path = './data/keuangan/template/LRA_template.docx';

					$template = $phpWord->loadTemplate($template_path);

					$template->setValue('hari', poee(date('N', strtotime($detail->tgl_pengesahan))));
					$template->setValue('nama_skpd', strtoupper($detail->nama_skpd));
					$template->setValue('tgl_periode', tanggal($detail->tgl_periode));
					$template->setValue('thn_periode', date('Y', strtotime($detail->tgl_periode)) - 1);
					$tgl_pengesahan = terbilang(date('d', strtotime($detail->tgl_pengesahan))) . " bulan " . bulan(date('m', strtotime($detail->tgl_pengesahan))) . " tahun " . terbilang(date('Y', strtotime($detail->tgl_pengesahan)));
					$template->setValue('tgl_pengesahan', $tgl_pengesahan);


					//
					$template->setValue('pendapatan_asli', dot2_minus($detail->pendapatan_asli));
					$template->setValue('pendapatan_transfer', dot2_minus($detail->pendapatan_transfer));
					$template->setValue('pendapatan_lain', dot2_minus($detail->pendapatan_lain));
					$template->setValue('total_pendapatan', dot2_minus($detail->total_pendapatan));
					$template->setValue('belanja_operasi', dot2_minus($detail->belanja_operasi));
					$template->setValue('belanja_pegawai', dot2_minus($detail->belanja_pegawai));
					$template->setValue('belanja_barang_jasa', dot2_minus($detail->belanja_barang_jasa));
					$template->setValue('belanja_bunga', dot2_minus($detail->belanja_bunga));
					$template->setValue('belanja_hibah', dot2_minus($detail->belanja_hibah));
					$template->setValue('belanja_bantuan_sosial', dot2_minus($detail->belanja_bantuan_sosial));
					$template->setValue('jumlah_belanja_operasi', dot2_minus($detail->jumlah_belanja_operasi));
					$template->setValue('belanja_modal', dot2_minus($detail->belanja_modal));
					$template->setValue('belanja_m_tanah', dot2_minus($detail->belanja_m_tanah));
					$template->setValue('belanja_m_peralatan_mesin', dot2_minus($detail->belanja_m_peralatan_mesin));
					$template->setValue('belanja_m_gedung_bangunan', dot2_minus($detail->belanja_m_gedung_bangunan));
					$template->setValue('belanja_m_jalan', dot2_minus($detail->belanja_m_jalan));
					$template->setValue('belanja_m_aset_tetap', dot2_minus($detail->belanja_m_aset_tetap));
					$template->setValue('belanja_m_aset_lainya', dot2_minus($detail->belanja_m_aset_lainya));
					$template->setValue('jumlah_modal_belanja', dot2_minus($detail->jumlah_modal_belanja));
					$template->setValue('belanja_tak_terduga', dot2_minus($detail->belanja_tak_terduga));
					$template->setValue('transfer', dot2_minus($detail->transfer));
					$template->setValue('total_belanja_transfer', dot2_minus($detail->total_belanja_transfer));
					$template->setValue('surplus', dot2_minus($detail->surplus));
					$template->setValue('penerimaan_pembiayaan', dot2_minus($detail->penerimaan_pembiayaan));
					$template->setValue('pengeluaran_pembiayaan', dot2_minus($detail->pengeluaran_pembiayaan));
					$template->setValue('pembiayaan_bersih', dot2_minus($detail->pembiayaan_bersih));
					//
					$template->setValue('nama_pegawai_1_bpkad', $detail->nama_1_bpkad);
					$template->setValue('nama_pegawai_2_bpkad', $detail->nama_2_bpkad);
					$template->setValue('nama_pegawai_3_bpkad', $detail->nama_3_bpkad);
					$template->setValue('nama_pegawai_4_bpkad', $detail->nama_4_bpkad);
					$template->setValue('nama_pegawai_1_skpd', $detail->nama_1_skpd);
					$template->setValue('nama_pegawai_2_skpd', $detail->nama_2_skpd);
					$template->setValue('nama_pegawai_3_skpd', $detail->nama_3_skpd);
					$template->setValue('nama_pegawai_4_skpd', $detail->nama_4_skpd);
					$template->setValue('jabatan_pegawai_1_bpkad', $detail->jabatan_1_bpkad);
					$template->setValue('jabatan_pegawai_2_bpkad', $detail->jabatan_2_bpkad);
					$template->setValue('jabatan_pegawai_3_bpkad', $detail->jabatan_3_bpkad);
					$template->setValue('jabatan_pegawai_4_bpkad', $detail->jabatan_4_bpkad);
					$template->setValue('jabatan_pegawai_1_skpd', $detail->jabatan_1_skpd);
					$template->setValue('jabatan_pegawai_2_skpd', $detail->jabatan_2_skpd);
					$template->setValue('jabatan_pegawai_3_skpd', $detail->jabatan_3_skpd);
					$template->setValue('jabatan_pegawai_4_skpd', $detail->jabatan_4_skpd);
					$template->setValue('nip_pegawai_1_bpkad', $detail->nip1);
					$template->setValue('nip_pegawai_2_bpkad', $detail->nip2);
					$template->setValue('nip_pegawai_3_bpkad', $detail->nip3);
					$template->setValue('nip_pegawai_4_bpkad', $detail->nip4);
					$template->setValue('nip_pegawai_1_skpd', $detail->nip5);
					$template->setValue('nip_pegawai_2_skpd', $detail->nip6);
					$template->setValue('nip_pegawai_3_skpd', $detail->nip7);
					$template->setValue('nip_pegawai_4_skpd', $detail->nip8);
					$template->setValue('total_pendapatan1_lo', $detail->total_pendapatan_lo);

					$template->setValue('pendapatan', rp_minus($detail->total_pendapatan));
					$terbilang_pendapatan = terbilang_koma_minus($detail->total_pendapatan);
					$template->setValue('terbilang_pendapatan', $terbilang_pendapatan);

					$template->setValue('total_belanja', rp_minus($detail->total_belanja_transfer));
					$terbilang_total_belanja = terbilang_koma_minus($detail->total_belanja_transfer);
					$template->setValue('terbilang_total_belanja', $terbilang_total_belanja);





					ob_clean();
					$template->saveAs("./data/keuangan/tmp/" . $filename);
					$file_pdf = $this->wordpdf->convert("data/keuangan/tmp/" . $filename);
					//fwrite file_pdf to /data/keuangan/

					
					$berkas_pdf  = pathinfo("./data/keuangan/tmp/{$filename}", PATHINFO_FILENAME).".pdf";

					$file = fopen("./data/keuangan/".$berkas_pdf,"w");
					fwrite($file, base64_decode($file_pdf));
					fclose($file);
					// die;

					// shell_exec("lowriter  --convert-to pdf ./data/keuangan/tmp/{$filename} --outdir ./data/keuangan/ 2>&1");
					// $berkas_pdf  = pathinfo("./data/keuangan/tmp/{$filename}", PATHINFO_FILENAME) . ".pdf";
					unlink("./data/keuangan/tmp/" . $filename);

					$this->db->set('file_signed_draft', $berkas_pdf);
					$this->db->set('tgl_upload', date('Y-m-d H:i:s'));
					$this->db->where('id_laporan_realisasi_anggaran', $in);
					$this->db->update('laporan_realisasi_anggaran');

					$data['message'] = '<b>Sukses</b> Data berhasil ditambahkan';
					$data['message_type'] = 'success';

					redirect(base_url('keuangan/lap_realisasi_anggaran/detail/' . encode($in) . '?msg=' . urlencode($data['message'])));
				} else {

					$data['message'] = 'Terjadi kesalahan';
					$data['message_type'] = 'danger';
					// echo "6";
					// break;
				}
			}

			$data['detail']		= $this->lap_realisasi_anggaran_model->get_by_id($id_laporan_realisasi_anggaran);
			$data['active_menu'] = "neraca";
			$this->load->view('admin/index', $data);
		} else {
			redirect('admin');
		}
	}


	public function delete($id_laporan_realisasi_anggaran)
	{
		$this->lap_realisasi_anggaran_model->delete($id_laporan_realisasi_anggaran);

		redirect('keuangan/lap_realisasi_anggaran');
	}


	public function reset_ulang($id_laporan_realisasi_anggaran)
	{
		if (($this->user_level != "Administrator" && $this->user_level != "Admin Web") && !in_array('keuangan', explode(';', $this->session->userdata('user_privileges')))) redirect('welcome');
		$id_laporan_realisasi_anggaran = decode($id_laporan_realisasi_anggaran);
		

			$cek_status_tte = $this->lap_realisasi_anggaran_model->cek_status_tte($id_laporan_realisasi_anggaran);
			if ($cek_status_tte) {

				$this->lap_realisasi_anggaran_model->ttd_pegawai_1_bpkad = 'belum';
				$this->lap_realisasi_anggaran_model->ttd_pegawai_2_bpkad = 'belum';
				$this->lap_realisasi_anggaran_model->ttd_pegawai_3_bpkad = 'belum';
				$this->lap_realisasi_anggaran_model->ttd_pegawai_4_bpkad = 'belum';
				$this->lap_realisasi_anggaran_model->ttd_pegawai_1_skpd = 'belum';
				$this->lap_realisasi_anggaran_model->ttd_pegawai_2_skpd = 'belum';
				$this->lap_realisasi_anggaran_model->ttd_pegawai_3_skpd = 'belum';
				$this->lap_realisasi_anggaran_model->ttd_pegawai_4_skpd = 'belum';
				$this->lap_realisasi_anggaran_model->status_verifikasi = 'belum';
				$this->lap_realisasi_anggaran_model->alasan_penolakan = '';
				$this->lap_realisasi_anggaran_model->status = 'Proses';
				$this->lap_realisasi_anggaran_model->update_reset($id_laporan_realisasi_anggaran);
				$in = $id_laporan_realisasi_anggaran;

				if ($in) {

					$detail =  $this->lap_realisasi_anggaran_model->get_by_id($in);
					$phpWord = new \PhpOffice\PhpWord\PhpWord();
					$phpWord->getCompatibility()->setOoxmlVersion(14);
					$phpWord->getCompatibility()->setOoxmlVersion(15);

					//$template = $detail->file_draft;
					$filename = $detail->nama_skpd . '_LRA_' . time() . ".docx";
					$filename = str_replace(",", "", $filename);
					$filename = str_replace(" ", "_", $filename);
					$filename = str_replace("/", "_", $filename);
					//$filename = 'tes.docx';	
					$template_path = './data/keuangan/template/LRA_template.docx';

					$template = $phpWord->loadTemplate($template_path);

					$template->setValue('hari', poee(date('N', strtotime($detail->tgl_pengesahan))));
					$template->setValue('nama_skpd', strtoupper($detail->nama_skpd));
					$template->setValue('tgl_periode', tanggal($detail->tgl_periode));
					$template->setValue('thn_periode', date('Y', strtotime($detail->tgl_periode)) - 1);
					$tgl_pengesahan = terbilang(date('d', strtotime($detail->tgl_pengesahan))) . " bulan " . bulan(date('m', strtotime($detail->tgl_pengesahan))) . " tahun " . terbilang(date('Y', strtotime($detail->tgl_pengesahan)));
					$template->setValue('tgl_pengesahan', $tgl_pengesahan);


					//
					$template->setValue('pendapatan_asli', dot2_minus($detail->pendapatan_asli));
					$template->setValue('pendapatan_transfer', dot2_minus($detail->pendapatan_transfer));
					$template->setValue('pendapatan_lain', dot2_minus($detail->pendapatan_lain));
					$template->setValue('total_pendapatan', dot2_minus($detail->total_pendapatan));
					$template->setValue('belanja_operasi', dot2_minus($detail->belanja_operasi));
					$template->setValue('belanja_pegawai', dot2_minus($detail->belanja_pegawai));
					$template->setValue('belanja_barang_jasa', dot2_minus($detail->belanja_barang_jasa));
					$template->setValue('belanja_bunga', dot2_minus($detail->belanja_bunga));
					$template->setValue('belanja_hibah', dot2_minus($detail->belanja_hibah));
					$template->setValue('belanja_bantuan_sosial', dot2_minus($detail->belanja_bantuan_sosial));
					$template->setValue('jumlah_belanja_operasi', dot2_minus($detail->jumlah_belanja_operasi));
					$template->setValue('belanja_modal', dot2_minus($detail->belanja_modal));
					$template->setValue('belanja_m_tanah', dot2_minus($detail->belanja_m_tanah));
					$template->setValue('belanja_m_peralatan_mesin', dot2_minus($detail->belanja_m_peralatan_mesin));
					$template->setValue('belanja_m_gedung_bangunan', dot2_minus($detail->belanja_m_gedung_bangunan));
					$template->setValue('belanja_m_jalan', dot2_minus($detail->belanja_m_jalan));
					$template->setValue('belanja_m_aset_tetap', dot2_minus($detail->belanja_m_aset_tetap));
					$template->setValue('belanja_m_aset_lainya', dot2_minus($detail->belanja_m_aset_lainya));
					$template->setValue('jumlah_modal_belanja', dot2_minus($detail->jumlah_modal_belanja));
					$template->setValue('belanja_tak_terduga', dot2_minus($detail->belanja_tak_terduga));
					$template->setValue('transfer', dot2_minus($detail->transfer));
					$template->setValue('total_belanja_transfer', dot2_minus($detail->total_belanja_transfer));
					$template->setValue('surplus', dot2_minus($detail->surplus));
					$template->setValue('penerimaan_pembiayaan', dot2_minus($detail->penerimaan_pembiayaan));
					$template->setValue('pengeluaran_pembiayaan', dot2_minus($detail->pengeluaran_pembiayaan));
					$template->setValue('pembiayaan_bersih', dot2_minus($detail->pembiayaan_bersih));
					//
					$template->setValue('nama_pegawai_1_bpkad', $detail->nama_1_bpkad);
					$template->setValue('nama_pegawai_2_bpkad', $detail->nama_2_bpkad);
					$template->setValue('nama_pegawai_3_bpkad', $detail->nama_3_bpkad);
					$template->setValue('nama_pegawai_4_bpkad', $detail->nama_4_bpkad);
					$template->setValue('nama_pegawai_1_skpd', $detail->nama_1_skpd);
					$template->setValue('nama_pegawai_2_skpd', $detail->nama_2_skpd);
					$template->setValue('nama_pegawai_3_skpd', $detail->nama_3_skpd);
					$template->setValue('nama_pegawai_4_skpd', $detail->nama_4_skpd);
					$template->setValue('jabatan_pegawai_1_bpkad', $detail->jabatan_1_bpkad);
					$template->setValue('jabatan_pegawai_2_bpkad', $detail->jabatan_2_bpkad);
					$template->setValue('jabatan_pegawai_3_bpkad', $detail->jabatan_3_bpkad);
					$template->setValue('jabatan_pegawai_4_bpkad', $detail->jabatan_4_bpkad);
					$template->setValue('jabatan_pegawai_1_skpd', $detail->jabatan_1_skpd);
					$template->setValue('jabatan_pegawai_2_skpd', $detail->jabatan_2_skpd);
					$template->setValue('jabatan_pegawai_3_skpd', $detail->jabatan_3_skpd);
					$template->setValue('jabatan_pegawai_4_skpd', $detail->jabatan_4_skpd);
					$template->setValue('nip_pegawai_1_bpkad', $detail->nip1);
					$template->setValue('nip_pegawai_2_bpkad', $detail->nip2);
					$template->setValue('nip_pegawai_3_bpkad', $detail->nip3);
					$template->setValue('nip_pegawai_4_bpkad', $detail->nip4);
					$template->setValue('nip_pegawai_1_skpd', $detail->nip5);
					$template->setValue('nip_pegawai_2_skpd', $detail->nip6);
					$template->setValue('nip_pegawai_3_skpd', $detail->nip7);
					$template->setValue('nip_pegawai_4_skpd', $detail->nip8);
					$template->setValue('total_pendapatan1_lo', $detail->total_pendapatan_lo);

					$template->setValue('pendapatan', rp_minus($detail->total_pendapatan));
					$terbilang_pendapatan = terbilang_koma_minus($detail->total_pendapatan);
					$template->setValue('terbilang_pendapatan', $terbilang_pendapatan);

					$template->setValue('total_belanja', rp_minus($detail->total_belanja_transfer));
					$terbilang_total_belanja = terbilang_koma_minus($detail->total_belanja_transfer);
					$template->setValue('terbilang_total_belanja', $terbilang_total_belanja);





					ob_clean();
					$template->saveAs("./data/keuangan/tmp/" . $filename);
					$file_pdf = $this->wordpdf->convert("data/keuangan/tmp/" . $filename);
					//fwrite file_pdf to /data/keuangan/

					
					$berkas_pdf  = pathinfo("./data/keuangan/tmp/{$filename}", PATHINFO_FILENAME).".pdf";

					$file = fopen("./data/keuangan/".$berkas_pdf,"w");
					fwrite($file, base64_decode($file_pdf));
					fclose($file);
					// die;

					// shell_exec("lowriter  --convert-to pdf ./data/keuangan/tmp/{$filename} --outdir ./data/keuangan/ 2>&1");
					// $berkas_pdf  = pathinfo("./data/keuangan/tmp/{$filename}", PATHINFO_FILENAME) . ".pdf";
					unlink("./data/keuangan/tmp/" . $filename);

					$this->db->set('file_signed_draft', $berkas_pdf);
					$this->db->set('tgl_upload', date('Y-m-d H:i:s'));
					$this->db->where('id_laporan_realisasi_anggaran', $in);
					$this->db->update('laporan_realisasi_anggaran');

					$data['message'] = '<b>Sukses</b> Dokumen Berhasil Direset.';
					$data['message_type'] = 'success';

					redirect(base_url('keuangan/lap_realisasi_anggaran/detail/' . encode($in) . '?msg=' . urlencode($data['message'])));
				} else {

					$data['message'] = 'Terjadi kesalahan';
					$data['message_type'] = 'danger';
					// echo "6";
					// break;
				}
			} else {
				$data['message'] = '<b>GAGAL!</b> Dokumen sudah Terbit.';
				redirect(base_url('keuangan/lap_realisasi_anggaran/detail/' . encode($id_laporan_realisasi_anggaran) . '?msg=' . urlencode($data['message'])));
			}

	}

}
