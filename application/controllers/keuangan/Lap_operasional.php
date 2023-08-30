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

class Lap_operasional extends CI_Controller
{
	public $user_id;

	public function __construct()
	{
		parent::__construct();
		$this->user_id = $this->session->userdata('user_id');


		$this->user_model->user_id = $this->user_id;
		$this->user_model->set_user_by_user_id();
		$this->load->model('ref_skpd_model');
		$this->load->model('lap_operasional_model');
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
			$data['content']	= "keuangan/lap_operasional/index";
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;

			$hal = 6;
			$page = isset($_GET["page"]) ? (int)$_GET["page"] : 1;
			$mulai = ($page > 1) ? ($page * $hal) - $hal : 0;
			$total = count($this->lap_operasional_model->get_all());
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
			$data['list'] = $this->lap_operasional_model->get_page($mulai, $hal, $filter);


			$data['active_menu'] = "lap_operasional";
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
			$data['content']	= "keuangan/lap_operasional/add";
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;

			//$data['query']		= $this->agenda_model->get_all();
			$data['active_menu'] = "lap_operasional";

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
						$this->lap_operasional_model->file_draft = $nama;
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

				$this->lap_operasional_model->id_skpd = $_POST['id_skpd'];
				$this->lap_operasional_model->tgl_periode = $_POST['tgl_periode'];
				$this->lap_operasional_model->tgl_pengesahan = $_POST['tgl_pengesahan'];
				
				$this->lap_operasional_model->pendapatan_asli_sekarang = $_POST['pendapatan_asli_sekarang'];
				$this->lap_operasional_model->pendapatan_asli_awal = $_POST['pendapatan_asli_awal'];
				$this->lap_operasional_model->total_pendapatan_asli = $_POST['total_pendapatan_asli'];
				$this->lap_operasional_model->pendapatan_transfer_sekarang = $_POST['pendapatan_transfer_sekarang'];
				$this->lap_operasional_model->pendapatan_transfer_awal = $_POST['pendapatan_transfer_awal'];
				$this->lap_operasional_model->total_pendapatan_transfer = $_POST['total_pendapatan_transfer'];
				$this->lap_operasional_model->pendapatan_lain_sekarang = $_POST['pendapatan_lain_sekarang'];
				$this->lap_operasional_model->pendapatan_lain_awal = $_POST['pendapatan_lain_awal'];
				$this->lap_operasional_model->total_pendapatan_lain = $_POST['total_pendapatan_lain'];
				$this->lap_operasional_model->pendapatan_surplus_sekarang = $_POST['pendapatan_surplus_sekarang'];
				$this->lap_operasional_model->pendapatan_surplus_awal = $_POST['pendapatan_surplus_awal'];
				$this->lap_operasional_model->total_pendapatan_surplus = $_POST['total_pendapatan_surplus'];
				$this->lap_operasional_model->total_pendapatan1_lo = $_POST['total_pendapatan1_lo'];
				$this->lap_operasional_model->total_pendapatan_lo_sekarang = $_POST['total_pendapatan_lo_sekarang'];
				$this->lap_operasional_model->total_pendapatan_lo_awal = $_POST['total_pendapatan_lo_awal'];
				$this->lap_operasional_model->beban_pegawai_sekarang = $_POST['beban_pegawai_sekarang'];
				$this->lap_operasional_model->beban_pegawai_awal = $_POST['beban_pegawai_awal'];
				$this->lap_operasional_model->total_beban_pegawai = $_POST['total_beban_pegawai'];
				$this->lap_operasional_model->beban_barangjasa_sekarang = $_POST['beban_barangjasa_sekarang'];
				$this->lap_operasional_model->beban_barangjasa_awal = $_POST['beban_barangjasa_awal'];
				$this->lap_operasional_model->total_barangjasa = $_POST['total_barangjasa'];
				$this->lap_operasional_model->beban_bunga_sekarang = $_POST['beban_bunga_sekarang'];
				$this->lap_operasional_model->beban_bunga_awal = $_POST['beban_bunga_awal'];
				$this->lap_operasional_model->toal_bunga = $_POST['total_bunga'];
				$this->lap_operasional_model->beban_hibah_sekarang = $_POST['beban_hibah_sekarang'];
				$this->lap_operasional_model->beban_hibah_awal = $_POST['beban_hibah_awal'];
				$this->lap_operasional_model->total_beban_hibah = $_POST['total_beban_hibah'];
				$this->lap_operasional_model->beban_bantuansosial_sekarang = $_POST['beban_bantuansosial_sekarang'];
				$this->lap_operasional_model->beban_bantuansosial_awal = $_POST['beban_bantuansosial_awal'];
				$this->lap_operasional_model->total_bantuansosial = $_POST['total_bantuansosial'];
				$this->lap_operasional_model->beban_penyisihanpiutang_sekarang = $_POST['beban_penyisihanpiutang_sekarang'];
				$this->lap_operasional_model->beban_penyisihanpiutang_awal = $_POST['beban_penyisihanpiutang_awal'];
				$this->lap_operasional_model->total_penyisihanpiutang = $_POST['total_penyisihanpiutang'];
				$this->lap_operasional_model->beban_penyusutan_sekarang = $_POST['beban_penyusutan_sekarang'];
				$this->lap_operasional_model->beban_penyusutan_awal = $_POST['beban_penyusutan_awal'];
				$this->lap_operasional_model->total_beban_penyusutan = $_POST['total_beban_penyusutan'];
				$this->lap_operasional_model->beban_lain_sekarang = $_POST['beban_lain_sekarang'];
				$this->lap_operasional_model->beban_lain_awal = $_POST['beban_lain_awal'];
				$this->lap_operasional_model->total_beban_lain = $_POST['total_beban_lain'];
				$this->lap_operasional_model->jumlah_beban_operasi_sekarang = $_POST['jumlah_beban_operasi_sekarang'];
				$this->lap_operasional_model->jumlah_beban_operasi_awal = $_POST['jumlah_beban_operasi_awal'];
				$this->lap_operasional_model->total_beban_operasi = $_POST['total_beban_operasi'];
				$this->lap_operasional_model->defisit_keg_nonopera_sekarang = $_POST['defisit_keg_nonopera_sekarang'];
				$this->lap_operasional_model->defisit_keg_nonopera_awal = $_POST['defisit_keg_nonopera_awal'];
				$this->lap_operasional_model->total_defisit_keg_nonopera = $_POST['total_defisit_keg_nonopera'];
				$this->lap_operasional_model->beban_transfer_sekarang = $_POST['beban_transfer_sekarang'];
				$this->lap_operasional_model->beban_transfer_awal = $_POST['beban_transfer_awal'];
				$this->lap_operasional_model->total_beban_transfer = $_POST['total_beban_transfer'];
				$this->lap_operasional_model->beban_takterduga_sekarang = $_POST['beban_takterduga_sekarang'];
				$this->lap_operasional_model->beban_takterduga_awal = $_POST['beban_takterduga_awal'];
				$this->lap_operasional_model->total_beban_takterduga = $_POST['total_beban_takterduga'];
				// $this->lap_operasional_model->beban_luar_biasa_sekarang = $_POST['beban_luar_biasa_sekarang'];
				// $this->lap_operasional_model->beban_luar_biasa_awal = $_POST['beban_luar_biasa_awal'];
				// $this->lap_operasional_model->total_beban_luar_biasa = $_POST['total_beban_luar_biasa'];
				$this->lap_operasional_model->total_beban_sekarang = $_POST['total_beban_sekarang'];
				$this->lap_operasional_model->total_beban_awal = $_POST['total_beban_awal'];
				$this->lap_operasional_model->total_beban_akhir = $_POST['total_beban_akhir'];
				$this->lap_operasional_model->surplus_sekarang = $_POST['surplus_sekarang'];
				$this->lap_operasional_model->surplus_awal = $_POST['surplus_awal'];
				$this->lap_operasional_model->surplus_akhir = $_POST['surplus_akhir'];
				$this->lap_operasional_model->id_pegawai_1_bpkad = $_POST['id_pegawai_1_bpkad'];
				$this->lap_operasional_model->id_pegawai_2_bpkad = $_POST['id_pegawai_2_bpkad'];
				// $this->lap_operasional_model->id_pegawai_3_bpkad = $_POST['id_pegawai_3_bpkad'];
				// $this->lap_operasional_model->id_pegawai_4_bpkad = $_POST['id_pegawai_4_bpkad'];
				$this->lap_operasional_model->id_pegawai_1_skpd = $_POST['id_pegawai_1_skpd'];
				$this->lap_operasional_model->id_pegawai_2_skpd = $_POST['id_pegawai_2_skpd'];
				// $this->lap_operasional_model->id_pegawai_3_skpd = $_POST['id_pegawai_3_skpd'];
				// $this->lap_operasional_model->id_pegawai_4_skpd = $_POST['id_pegawai_4_skpd'];
				$this->lap_operasional_model->ttd_pegawai_1_bpkad = 'belum';
				$this->lap_operasional_model->ttd_pegawai_2_bpkad = 'belum';
				$this->lap_operasional_model->ttd_pegawai_3_bpkad = 'belum';
				$this->lap_operasional_model->ttd_pegawai_4_bpkad = 'belum';
				$this->lap_operasional_model->ttd_pegawai_1_skpd = 'belum';
				$this->lap_operasional_model->ttd_pegawai_2_skpd = 'belum';
				$this->lap_operasional_model->ttd_pegawai_3_skpd = 'belum';
				$this->lap_operasional_model->ttd_pegawai_4_skpd = 'belum';
				// $this->lap_operasional_model->file_draft = $_POST['file_draft'];
				// $this->lap_operasional_model->file_signed = $_POST['file_signed'];
				$this->lap_operasional_model->status = 'Proses';




				//tulis script php word disini



				$in = $this->lap_operasional_model->insert();
				if ($in) {

					$detail =  $this->lap_operasional_model->get_by_id($in);
					$phpWord = new \PhpOffice\PhpWord\PhpWord();
					$phpWord->getCompatibility()->setOoxmlVersion(14);
					$phpWord->getCompatibility()->setOoxmlVersion(15);

					//$template = $detail->file_draft;
					$filename = $detail->nama_skpd . '_LO_' . time() . ".docx";
					$filename = str_replace(",", "", $filename);
					$filename = str_replace(" ", "_", $filename);
					$filename = str_replace("/", "_", $filename);
					//$filename = 'tes.docx';	
					$template_path = './data/keuangan/template/LO_template.docx';

					$template = $phpWord->loadTemplate($template_path);

					$template->setValue('hari', poee(date('N', strtotime($detail->tgl_pengesahan))));
					$template->setValue('nama_skpd', $detail->nama_skpd);
					$template->setValue('tgl_periode', tanggal($detail->tgl_periode));
					$template->setValue('thn_periode', date('Y', strtotime($detail->tgl_periode)) - 1);
					$tgl_pengesahan = terbilang(date('d', strtotime($detail->tgl_pengesahan))) . " bulan " . bulan(date('m', strtotime($detail->tgl_pengesahan))) . " tahun " . terbilang(date('Y', strtotime($detail->tgl_pengesahan)));
					$template->setValue('tgl_pengesahan', $tgl_pengesahan);

					$template->setValue('pendapatan_asli_sekarang', dot2_minus($detail->pendapatan_asli_sekarang));
					$template->setValue('pendapatan_asli_awal', dot2_minus($detail->pendapatan_asli_awal));
					$template->setValue('total_pendapatan_asli', dot2_minus($detail->total_pendapatan_asli));
					$template->setValue('pendapatan_transfer_sekarang', dot2_minus($detail->pendapatan_transfer_sekarang));
					$template->setValue('pendapatan_transfer_awal', dot2_minus($detail->pendapatan_transfer_awal));
					$template->setValue('total_pendapatan_transfer', dot2_minus($detail->total_pendapatan_transfer));
					$template->setValue('pendapatan_lain_sekarang', dot2_minus($detail->pendapatan_lain_sekarang));
					$template->setValue('pendapatan_lain_awal', dot2_minus($detail->pendapatan_lain_awal));
					$template->setValue('total_pendapatan_lain', dot2_minus($detail->total_pendapatan_lain));
					$template->setValue('pendapatan_surplus_sekarang', dot2_minus($detail->pendapatan_surplus_sekarang));
					$template->setValue('pendapatan_surplus_awal', dot2_minus($detail->pendapatan_surplus_awal));
					$template->setValue('total_pendapatan_surplus', dot2_minus($detail->total_pendapatan_surplus));
					$template->setValue('total_pendapatan1_lo', dot2_minus($detail->total_pendapatan1_lo));
					$template->setValue('total_pendapatan_lo_sekarang', dot2_minus($detail->total_pendapatan_lo_sekarang));
					$template->setValue('total_pendapatan_lo_awal', dot2_minus($detail->total_pendapatan_lo_awal));
					$template->setValue('beban_pegawai_sekarang', dot2_minus($detail->beban_pegawai_sekarang));
					$template->setValue('beban_pegawai_awal', dot2_minus($detail->beban_pegawai_awal));
					$template->setValue('total_beban_pegawai', dot2_minus($detail->total_beban_pegawai));
					$template->setValue('beban_barangjasa_sekarang', dot2_minus($detail->beban_barangjasa_sekarang));
					$template->setValue('beban_barangjasa_awal', dot2_minus($detail->beban_barangjasa_awal));
					$template->setValue('total_barangjasa', dot2_minus($detail->total_barangjasa));
					$template->setValue('beban_hibah_sekarang', dot2_minus($detail->beban_hibah_sekarang));
					$template->setValue('beban_hibah_awal', dot2_minus($detail->beban_hibah_awal));
					$template->setValue('total_beban_hibah', dot2_minus($detail->total_beban_hibah));
					$template->setValue('beban_bantuansosial_sekarang', dot2_minus($detail->beban_bantuansosial_sekarang));
					$template->setValue('beban_bantuansosial_awal', dot2_minus($detail->beban_bantuansosial_awal));
					$template->setValue('total_bantuansosial', dot2_minus($detail->total_bantuansosial));
					$template->setValue('beban_penyusutan_sekarang', dot2_minus($detail->beban_penyusutan_sekarang));
					$template->setValue('beban_penyusutan_awal', dot2_minus($detail->beban_penyusutan_awal));
					$template->setValue('total_beban_penyusutan', dot2_minus($detail->total_beban_penyusutan));
					$template->setValue('beban_lain_sekarang', dot2_minus($detail->beban_lain_sekarang));
					$template->setValue('beban_lain_awal', dot2_minus($detail->beban_lain_awal));
					$template->setValue('total_beban_lain', dot2_minus($detail->total_beban_lain));
					$template->setValue('jumlah_beban_operasi_sekarang', dot2_minus($detail->jumlah_beban_operasi_sekarang));
					$template->setValue('jumlah_beban_operasi_awal', dot2_minus($detail->jumlah_beban_operasi_awal));
					$template->setValue('total_beban_operasi', dot2_minus($detail->total_beban_operasi));
					$template->setValue('defisit_keg_nonopera_sekarang', dot2_minus($detail->defisit_keg_nonopera_sekarang));
					$template->setValue('defisit_keg_nonopera_awal', dot2_minus($detail->defisit_keg_nonopera_awal));
					$template->setValue('total_defisit_keg_nonopera', dot2_minus($detail->total_defisit_keg_nonopera));
					$template->setValue('beban_transfer_sekarang', dot2_minus($detail->beban_transfer_sekarang));
					$template->setValue('beban_transfer_awal', dot2_minus($detail->beban_transfer_awal));
					$template->setValue('total_beban_transfer', dot2_minus($detail->total_beban_transfer));
					$template->setValue('beban_luar_biasa_sekarang', dot2_minus($detail->beban_luar_biasa_sekarang));
					$template->setValue('beban_luar_biasa_awal', dot2_minus($detail->beban_luar_biasa_awal));
					$template->setValue('total_beban_luar_biasa', dot2_minus($detail->total_beban_luar_biasa));
					$template->setValue('total_beban_sekarang', dot2_minus($detail->total_beban_sekarang));
					$template->setValue('total_beban_awal', dot2_minus($detail->total_beban_awal));
					$template->setValue('total_beban_akhir', dot2_minus($detail->total_beban_akhir));
					$template->setValue('surplus_sekarang', dot2_minus($detail->surplus_sekarang));
					$template->setValue('surplus_awal', dot2_minus($detail->surplus_awal));
					$template->setValue('surplus_akhir', dot2_minus($detail->surplus_akhir));
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

					$template->setValue('beban_bunga_sekarang', dot2_minus($detail->beban_bunga_sekarang));
					$template->setValue('beban_bunga_awal', dot2_minus($detail->beban_bunga_awal));
					$template->setValue('total_bunga', dot2_minus($detail->total_bunga));
					$template->setValue('beban_penyisihanpiutang_sekarang', dot2_minus($detail->beban_penyisihanpiutang_sekarang));
					$template->setValue('beban_penyisihanpiutang_awal', dot2_minus($detail->beban_penyisihanpiutang_awal));
					$template->setValue('total_penyisihanpiutang', dot2_minus($detail->total_penyisihanpiutang));
					$template->setValue('beban_takterduga_sekarang', dot2_minus($detail->beban_takterduga_sekarang));
					$template->setValue('beban_takterduga_awal', dot2_minus($detail->beban_takterduga_awal));
					$template->setValue('total_beban_takterduga', dot2_minus($detail->total_beban_takterduga));

					$template->setValue('total_belanja', rp_minus($detail->total_beban_sekarang));
					$terbilang_total_belanja = terbilang_koma_minus($detail->total_beban_sekarang);
					$template->setValue('terbilang_total_belanja', $terbilang_total_belanja);

					$template->setValue('total_semua', rp_minus($detail->total_pendapatan_lo_sekarang));
					$terbilang_total = terbilang_koma_minus($detail->total_pendapatan_lo_sekarang);
					$template->setValue('terbilang_total', $terbilang_total);






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
					$this->db->where('id_laporan_operasional', $in);
					$this->db->update('laporan_operasional');
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
					// echo "5";
					// break;
					redirect(base_url('keuangan/lap_operasional/detail/' . encode($in) . '?msg=' . urlencode($data['message'])));
				} else {

					$data['message'] = 'Terjadi kesalahan';
					$data['message_type'] = 'danger';
					// echo "6";
					// break;
				}
				// echo "7";
				// break;
				// } while (0);
			}

			$this->load->view('admin/index', $data);
		} else {
			redirect('admin');
		}
	}


	public function detail($id_laporan_operasional)
	{
		if ($this->user_id) {
			$id_laporan_operasional = decode($id_laporan_operasional);
			$data['title']		= "Keuangan - " . app_name;
			$data['content']	= "keuangan/lap_operasional/detail";
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;

			$data['detail']		= $this->lap_operasional_model->get_by_id($id_laporan_operasional);

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
					$up = $this->db->update('laporan_operasional', $data_up, ['id_laporan_operasional' => $id_laporan_operasional]);
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
					$get_data 	 = $this->lap_operasional_model->get_by_id($id_laporan_operasional);
					$user 		 = $this->user_model->get_current_sertifikat_user();
					$cur_date 	 = date("Ymdhis");
					$berkas		 = !empty($get_data->file_signed_draft) ? $get_data->file_signed_draft : "tmp/" . $get_data->file_draft;
					$src 		 = "./data/keuangan/" . $berkas;
					// $src 		 = "./data/keuangan/".$berkas;
					//$certificate = "./data/sertifikat/{$user->certificate}";
					$certificate = "/sertifikat/{$user->user_id}/{$user->certificate}";
					$input_name	 = !empty($get_data->file_signed_draft) ? $get_data->file_signed_draft : $get_data->file_draft;
					$filename = $get_data->nama_skpd . '_LO_' . time();
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
						$this->db->where('id_laporan_operasional', $id_laporan_operasional);
						$this->db->update('laporan_operasional');


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
							'key_value' => $id_laporan_operasional,
							'category' => 'surat_LO',
						);

						$this->logs_model->insert_log($log_data);
					}
				} elseif (isset($_POST['tolak'])) {

					$get_data 	 = $this->lap_operasional_model->get_by_id($id_laporan_operasional);
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
					$this->db->where('id_laporan_operasional', $id_laporan_operasional);
					$this->db->update('laporan_operasional');
					$data['message'] = "Surat telah ditolak";
					$data['message_type'] = "danger";
				}
			}


			$data['active_menu'] = "lap_operasional";
			$data['detail']		= $this->lap_operasional_model->get_by_id($id_laporan_operasional);
			$this->load->view('admin/index', $data);
		} else {
			redirect('admin');
		}
	}

	public function download($id_laporan_operasional)
	{
		if ($this->user_id) {

			$detail =  $this->lap_operasional_model->get_by_id($id_laporan_operasional);
			$phpWord = new \PhpOffice\PhpWord\PhpWord();
			$phpWord->getCompatibility()->setOoxmlVersion(14);
			$phpWord->getCompatibility()->setOoxmlVersion(15);

			// $template = $detail->file_draft;
			// $filename = $detail->file_draft.'_'.time().".docx";
			// $filename = str_replace(",","", $filename);
			// $filename = str_replace(" ","_", $filename);
			// $filename = str_replace("/","_", $filename);
			$filename = 'tes.docx';
			$template_path = './data/keuangan/template/LO_template.docx';

			$template = $phpWord->loadTemplate($template_path);

			$template->setValue('hari', poee(date('N', strtotime($detail->tgl_pengesahan))));
			$template->setValue('nama_skpd', $detail->nama_skpd);
			$template->setValue('tgl_periode', $detail->tgl_periode);
			$template->setValue('thn_periode', date('Y', strtotime($detail->tgl_periode)) - 1);
			$tgl_pengesahan = terbilang(date('d', strtotime($detail->tgl_pengesahan))) . " bulan " . bulan(date('m', strtotime($detail->tgl_pengesahan))) . " tahun " . terbilang(date('Y', strtotime($detail->tgl_pengesahan)));
			$template->setValue('tgl_pengesahan', $tgl_pengesahan);
			$template->setValue('pendapatan_lo_sekarang', $detail->pendapatan_lo_sekarang);
			$template->setValue('pendapatan_lo_awal', $detail->pendapatan_lo_awal);
			$template->setValue('total_pendapatan_lo', $detail->total_pendapatan_lo);
			$template->setValue('total_pendapatan1_lo', $detail->total_pendapatan1_lo);
			$template->setValue('total_pendapatan_lo_sekarang', $detail->total_pendapatan_lo_sekarang);
			$template->setValue('total_pendapatan_lo_awal', $detail->total_pendapatan_lo_awal);
			$template->setValue('beban_pegawai_sekarang', $detail->beban_pegawai_sekarang);
			$template->setValue('beban_pegawai_awal', $detail->beban_pegawai_awal);
			$template->setValue('total_beban_pegawai', $detail->total_beban_pegawai);
			$template->setValue('beban_barangjasa_sekarang', $detail->beban_barangjasa_sekarang);
			$template->setValue('beban_barangjasa_awal', $detail->beban_barangjasa_awal);
			$template->setValue('total_barangjasa', $detail->total_barangjasa);
			$template->setValue('beban_hibah_sekarang', $detail->beban_hibah_sekarang);
			$template->setValue('beban_hibah_awal', $detail->beban_hibah_awal);
			$template->setValue('total_beban_hibah', $detail->total_beban_hibah);
			$template->setValue('beban_bantuansosial_sekarang', $detail->beban_bantuansosial_sekarang);
			$template->setValue('beban_bantuansosial_awal', $detail->beban_bantuansosial_awal);
			$template->setValue('total_bantuansosial', $detail->total_bantuansosial);
			$template->setValue('beban_penyusutan_sekarang', $detail->beban_penyusutan_sekarang);
			$template->setValue('beban_penyusutan_awal', $detail->beban_penyusutan_awal);
			$template->setValue('total_beban_penyusutan', $detail->total_beban_penyusutan);
			$template->setValue('beban_lain_sekarang', $detail->beban_lain_sekarang);
			$template->setValue('beban_lain_awal', $detail->beban_lain_awal);
			$template->setValue('total_beban_lain', $detail->total_beban_lain);
			$template->setValue('jumlah_beban_operasi_sekarang', $detail->jumlah_beban_operasi_sekarang);
			$template->setValue('jumlah_beban_operasi_awal', $detail->jumlah_beban_operasi_awal);
			$template->setValue('total_beban_operasi', $detail->total_beban_operasi);
			$template->setValue('defisit_keg_nonopera_sekarang', $detail->defisit_keg_nonopera_sekarang);
			$template->setValue('defisit_keg_nonopera_awal', $detail->defisit_keg_nonopera_awal);
			$template->setValue('total_defisit_keg_nonopera', $detail->total_defisit_keg_nonopera);
			$template->setValue('beban_transfer_sekarang', $detail->beban_transfer_sekarang);
			$template->setValue('beban_transfer_awal', $detail->beban_transfer_awal);
			$template->setValue('total_beban_transfer', $detail->total_beban_transfer);
			$template->setValue('beban_luar_biasa_sekarang', $detail->beban_luar_biasa_sekarang);
			$template->setValue('beban_luar_biasa_awal', $detail->beban_luar_biasa_awal);
			$template->setValue('total_beban_luar_biasa', $detail->total_beban_luar_biasa);
			$template->setValue('total_beban_sekarang', $detail->total_beban_sekarang);
			$template->setValue('total_beban_awal', $detail->total_beban_awal);
			$template->setValue('total_beban_akhir', $detail->total_beban_akhir);
			$template->setValue('surplus_sekarang', $detail->surplus_sekarang);
			$template->setValue('surplus_awal', $detail->surplus_awal);
			$template->setValue('surplus_akhir', $detail->surplus_akhir);
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




			ob_clean();
			$template->saveAs("./data/keuangan/tmp/" . $filename);
			header('Content-Description: File Transfer');
			header('Content-Type: application/octet-stream');
			header('Content-Disposition: attachment; filename=' . $filename);
			header('Content-Transfer-Encoding: binary');
			header('Expires: 0');
			header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
			header('Pragma: public');
			header('Content-Length: ' . filesize("./data/keuangan/tmp/" . $filename));
			flush();
			readfile("./data/keuangan/tmp/" . $filename);
			// unlink("./data/keuangan/tmp/".$filename);

		}
	}

	public function edit($id_laporan_operasional)
	{
		if (($this->user_level != "Administrator" && $this->user_level != "Admin Web") && !in_array('keuangan', explode(';', $this->session->userdata('user_privileges')))) redirect('welcome');
		$id_laporan_operasional = decode($id_laporan_operasional);
		if ($this->user_id) {

			$data['title']		= "Keuangan - " . app_name;
			$data['content']	= "keuangan/lap_operasional/edit";
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
						$this->lap_operasional_model->file_draft = $nama;
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

				$this->lap_operasional_model->id_skpd = $_POST['id_skpd'];
				$this->lap_operasional_model->tgl_periode = $_POST['tgl_periode'];
				$this->lap_operasional_model->tgl_pengesahan = $_POST['tgl_pengesahan'];
				$this->lap_operasional_model->pendapatan_asli_sekarang = $_POST['pendapatan_asli_sekarang'];
				$this->lap_operasional_model->pendapatan_asli_awal = $_POST['pendapatan_asli_awal'];
				$this->lap_operasional_model->total_pendapatan_asli = $_POST['total_pendapatan_asli'];
				$this->lap_operasional_model->pendapatan_transfer_sekarang = $_POST['pendapatan_transfer_sekarang'];
				$this->lap_operasional_model->pendapatan_transfer_awal = $_POST['pendapatan_transfer_awal'];
				$this->lap_operasional_model->total_pendapatan_transfer = $_POST['total_pendapatan_transfer'];
				$this->lap_operasional_model->pendapatan_lain_sekarang = $_POST['pendapatan_lain_sekarang'];
				$this->lap_operasional_model->pendapatan_lain_awal = $_POST['pendapatan_lain_awal'];
				$this->lap_operasional_model->total_pendapatan_lain = $_POST['total_pendapatan_lain'];
				$this->lap_operasional_model->pendapatan_surplus_sekarang = $_POST['pendapatan_surplus_sekarang'];
				$this->lap_operasional_model->pendapatan_surplus_awal = $_POST['pendapatan_surplus_awal'];
				$this->lap_operasional_model->total_pendapatan_surplus = $_POST['total_pendapatan_surplus'];
				$this->lap_operasional_model->total_pendapatan1_lo = $_POST['total_pendapatan1_lo'];
				$this->lap_operasional_model->total_pendapatan_lo_sekarang = $_POST['total_pendapatan_lo_sekarang'];
				$this->lap_operasional_model->total_pendapatan_lo_awal = $_POST['total_pendapatan_lo_awal'];
				$this->lap_operasional_model->beban_pegawai_sekarang = $_POST['beban_pegawai_sekarang'];
				$this->lap_operasional_model->beban_pegawai_awal = $_POST['beban_pegawai_awal'];
				$this->lap_operasional_model->total_beban_pegawai = $_POST['total_beban_pegawai'];
				$this->lap_operasional_model->beban_barangjasa_sekarang = $_POST['beban_barangjasa_sekarang'];
				$this->lap_operasional_model->beban_barangjasa_awal = $_POST['beban_barangjasa_awal'];
				$this->lap_operasional_model->total_barangjasa = $_POST['total_barangjasa'];
				$this->lap_operasional_model->beban_hibah_sekarang = $_POST['beban_hibah_sekarang'];
				$this->lap_operasional_model->beban_hibah_awal = $_POST['beban_hibah_awal'];
				$this->lap_operasional_model->total_beban_hibah = $_POST['total_beban_hibah'];
				$this->lap_operasional_model->beban_bantuansosial_sekarang = $_POST['beban_bantuansosial_sekarang'];
				$this->lap_operasional_model->beban_bantuansosial_awal = $_POST['beban_bantuansosial_awal'];
				$this->lap_operasional_model->total_bantuansosial = $_POST['total_bantuansosial'];
				$this->lap_operasional_model->beban_penyusutan_sekarang = $_POST['beban_penyusutan_sekarang'];
				$this->lap_operasional_model->beban_penyusutan_awal = $_POST['beban_penyusutan_awal'];
				$this->lap_operasional_model->total_beban_penyusutan = $_POST['total_beban_penyusutan'];
				$this->lap_operasional_model->beban_lain_sekarang = $_POST['beban_lain_sekarang'];
				$this->lap_operasional_model->beban_lain_awal = $_POST['beban_lain_awal'];
				$this->lap_operasional_model->total_beban_lain = $_POST['total_beban_lain'];
				$this->lap_operasional_model->jumlah_beban_operasi_sekarang = $_POST['jumlah_beban_operasi_sekarang'];
				$this->lap_operasional_model->jumlah_beban_operasi_awal = $_POST['jumlah_beban_operasi_awal'];
				$this->lap_operasional_model->total_beban_operasi = $_POST['total_beban_operasi'];
				$this->lap_operasional_model->defisit_keg_nonopera_sekarang = $_POST['defisit_keg_nonopera_sekarang'];
				$this->lap_operasional_model->defisit_keg_nonopera_awal = $_POST['defisit_keg_nonopera_awal'];
				$this->lap_operasional_model->total_defisit_keg_nonopera = $_POST['total_defisit_keg_nonopera'];
				$this->lap_operasional_model->beban_transfer_sekarang = $_POST['beban_transfer_sekarang'];
				$this->lap_operasional_model->beban_transfer_awal = $_POST['beban_transfer_awal'];
				$this->lap_operasional_model->total_beban_transfer = $_POST['total_beban_transfer'];
				// $this->lap_operasional_model->beban_luar_biasa_sekarang = $_POST['beban_luar_biasa_sekarang'];
				// $this->lap_operasional_model->beban_luar_biasa_awal = $_POST['beban_luar_biasa_awal'];
				// $this->lap_operasional_model->total_beban_luar_biasa = $_POST['total_beban_luar_biasa'];
				$this->lap_operasional_model->total_beban_sekarang = $_POST['total_beban_sekarang'];

				$this->lap_operasional_model->beban_bunga_sekarang = $_POST['beban_bunga_sekarang'];
				$this->lap_operasional_model->beban_bunga_awal = $_POST['beban_bunga_awal'];
				$this->lap_operasional_model->total_bunga = $_POST['total_bunga'];
				$this->lap_operasional_model->beban_penyisihanpiutang_sekarang = $_POST['beban_penyisihanpiutang_sekarang'];
				$this->lap_operasional_model->beban_penyisihanpiutang_awal = $_POST['beban_penyisihanpiutang_awal'];
				$this->lap_operasional_model->total_penyisihanpiutang = $_POST['total_penyisihanpiutang'];
				$this->lap_operasional_model->beban_takterduga_sekarang = $_POST['beban_takterduga_sekarang'];
				$this->lap_operasional_model->beban_takterduga_awal = $_POST['beban_takterduga_awal'];
				$this->lap_operasional_model->total_beban_takterduga = $_POST['total_beban_takterduga'];

				$this->lap_operasional_model->total_beban_awal = $_POST['total_beban_awal'];
				$this->lap_operasional_model->total_beban_akhir = $_POST['total_beban_akhir'];
				$this->lap_operasional_model->surplus_sekarang = $_POST['surplus_sekarang'];
				$this->lap_operasional_model->surplus_awal = $_POST['surplus_awal'];
				$this->lap_operasional_model->surplus_akhir = $_POST['surplus_akhir'];
				$this->lap_operasional_model->id_pegawai_1_bpkad = $_POST['id_pegawai_1_bpkad'];
				$this->lap_operasional_model->id_pegawai_2_bpkad = $_POST['id_pegawai_2_bpkad'];
				// $this->lap_operasional_model->id_pegawai_3_bpkad = $_POST['id_pegawai_3_bpkad'];
				// $this->lap_operasional_model->id_pegawai_4_bpkad = $_POST['id_pegawai_4_bpkad'];
				$this->lap_operasional_model->id_pegawai_1_skpd = $_POST['id_pegawai_1_skpd'];
				$this->lap_operasional_model->id_pegawai_2_skpd = $_POST['id_pegawai_2_skpd'];
				// $this->lap_operasional_model->id_pegawai_3_skpd = $_POST['id_pegawai_3_skpd'];
				// $this->lap_operasional_model->id_pegawai_4_skpd = $_POST['id_pegawai_4_skpd'];
				$this->lap_operasional_model->ttd_pegawai_1_bpkad = 'belum';
				$this->lap_operasional_model->ttd_pegawai_2_bpkad = 'belum';
				$this->lap_operasional_model->ttd_pegawai_3_bpkad = 'belum';
				$this->lap_operasional_model->ttd_pegawai_4_bpkad = 'belum';
				$this->lap_operasional_model->ttd_pegawai_1_skpd = 'belum';
				$this->lap_operasional_model->ttd_pegawai_2_skpd = 'belum';
				$this->lap_operasional_model->ttd_pegawai_3_skpd = 'belum';
				$this->lap_operasional_model->ttd_pegawai_4_skpd = 'belum';
				$this->lap_operasional_model->status_verifikasi = 'belum';
				$this->lap_operasional_model->alasan_penolakan = '';
				// $this->lap_operasional_model->file_draft = $_POST['file_draft'];
				// $this->lap_operasional_model->file_signed = $_POST['file_signed'];
				$this->lap_operasional_model->status = 'Proses';


				//tulis script php word disini



				$this->lap_operasional_model->update($id_laporan_operasional);
				$in = $id_laporan_operasional;

				if ($in) {

					$detail =  $this->lap_operasional_model->get_by_id($in);
					$phpWord = new \PhpOffice\PhpWord\PhpWord();
					$phpWord->getCompatibility()->setOoxmlVersion(14);
					$phpWord->getCompatibility()->setOoxmlVersion(15);

					//$template = $detail->file_draft;
					$filename = $detail->nama_skpd . '_LO_' . time() . ".docx";
					$filename = str_replace(",", "", $filename);
					$filename = str_replace(" ", "_", $filename);
					$filename = str_replace("/", "_", $filename);
					//$filename = 'tes.docx';	
					$template_path = './data/keuangan/template/LO_template.docx';

					$template = $phpWord->loadTemplate($template_path);

					$template->setValue('hari', poee(date('N', strtotime($detail->tgl_pengesahan))));
					$template->setValue('nama_skpd', $detail->nama_skpd);
					$template->setValue('tgl_periode', tanggal($detail->tgl_periode));
					$template->setValue('thn_periode', date('Y', strtotime($detail->tgl_periode)) - 1);
					$tgl_pengesahan = terbilang(date('d', strtotime($detail->tgl_pengesahan))) . " bulan " . bulan(date('m', strtotime($detail->tgl_pengesahan))) . " tahun " . terbilang(date('Y', strtotime($detail->tgl_pengesahan)));
					$template->setValue('tgl_pengesahan', $tgl_pengesahan);

					$template->setValue('pendapatan_asli_sekarang', dot2_minus($detail->pendapatan_asli_sekarang));
					$template->setValue('pendapatan_asli_awal', dot2_minus($detail->pendapatan_asli_awal));
					$template->setValue('total_pendapatan_asli', dot2_minus($detail->total_pendapatan_asli));
					$template->setValue('pendapatan_transfer_sekarang', dot2_minus($detail->pendapatan_transfer_sekarang));
					$template->setValue('pendapatan_transfer_awal', dot2_minus($detail->pendapatan_transfer_awal));
					$template->setValue('total_pendapatan_transfer', dot2_minus($detail->total_pendapatan_transfer));
					$template->setValue('pendapatan_lain_sekarang', dot2_minus($detail->pendapatan_lain_sekarang));
					$template->setValue('pendapatan_lain_awal', dot2_minus($detail->pendapatan_lain_awal));
					$template->setValue('total_pendapatan_lain', dot2_minus($detail->total_pendapatan_lain));
					$template->setValue('pendapatan_surplus_sekarang', dot2_minus($detail->pendapatan_surplus_sekarang));
					$template->setValue('pendapatan_surplus_awal', dot2_minus($detail->pendapatan_surplus_awal));
					$template->setValue('total_pendapatan_surplus', dot2_minus($detail->total_pendapatan_surplus));
					$template->setValue('total_pendapatan1_lo', dot2_minus($detail->total_pendapatan1_lo));
					$template->setValue('total_pendapatan_lo_sekarang', dot2_minus($detail->total_pendapatan_lo_sekarang));
					$template->setValue('total_pendapatan_lo_awal', dot2_minus($detail->total_pendapatan_lo_awal));
					$template->setValue('beban_pegawai_sekarang', dot2_minus($detail->beban_pegawai_sekarang));
					$template->setValue('beban_pegawai_awal', dot2_minus($detail->beban_pegawai_awal));
					$template->setValue('total_beban_pegawai', dot2_minus($detail->total_beban_pegawai));
					$template->setValue('beban_barangjasa_sekarang', dot2_minus($detail->beban_barangjasa_sekarang));
					$template->setValue('beban_barangjasa_awal', dot2_minus($detail->beban_barangjasa_awal));
					$template->setValue('total_barangjasa', dot2_minus($detail->total_barangjasa));
					$template->setValue('beban_hibah_sekarang', dot2_minus($detail->beban_hibah_sekarang));
					$template->setValue('beban_hibah_awal', dot2_minus($detail->beban_hibah_awal));
					$template->setValue('total_beban_hibah', dot2_minus($detail->total_beban_hibah));
					$template->setValue('beban_bantuansosial_sekarang', dot2_minus($detail->beban_bantuansosial_sekarang));
					$template->setValue('beban_bantuansosial_awal', dot2_minus($detail->beban_bantuansosial_awal));
					$template->setValue('total_bantuansosial', dot2_minus($detail->total_bantuansosial));
					$template->setValue('beban_penyusutan_sekarang', dot2_minus($detail->beban_penyusutan_sekarang));
					$template->setValue('beban_penyusutan_awal', dot2_minus($detail->beban_penyusutan_awal));
					$template->setValue('total_beban_penyusutan', dot2_minus($detail->total_beban_penyusutan));
					$template->setValue('beban_lain_sekarang', dot2_minus($detail->beban_lain_sekarang));
					$template->setValue('beban_lain_awal', dot2_minus($detail->beban_lain_awal));
					$template->setValue('total_beban_lain', dot2_minus($detail->total_beban_lain));
					$template->setValue('jumlah_beban_operasi_sekarang', dot2_minus($detail->jumlah_beban_operasi_sekarang));
					$template->setValue('jumlah_beban_operasi_awal', dot2_minus($detail->jumlah_beban_operasi_awal));
					$template->setValue('total_beban_operasi', dot2_minus($detail->total_beban_operasi));
					$template->setValue('defisit_keg_nonopera_sekarang', dot2_minus($detail->defisit_keg_nonopera_sekarang));
					$template->setValue('defisit_keg_nonopera_awal', dot2_minus($detail->defisit_keg_nonopera_awal));
					$template->setValue('total_defisit_keg_nonopera', dot2_minus($detail->total_defisit_keg_nonopera));
					$template->setValue('beban_transfer_sekarang', dot2_minus($detail->beban_transfer_sekarang));
					$template->setValue('beban_transfer_awal', dot2_minus($detail->beban_transfer_awal));
					$template->setValue('total_beban_transfer', dot2_minus($detail->total_beban_transfer));
					$template->setValue('beban_luar_biasa_sekarang', dot2_minus($detail->beban_luar_biasa_sekarang));
					$template->setValue('beban_luar_biasa_awal', dot2_minus($detail->beban_luar_biasa_awal));
					$template->setValue('total_beban_luar_biasa', dot2_minus($detail->total_beban_luar_biasa));
					$template->setValue('total_beban_sekarang', dot2_minus($detail->total_beban_sekarang));
					$template->setValue('total_beban_awal', dot2_minus($detail->total_beban_awal));
					$template->setValue('total_beban_akhir', dot2_minus($detail->total_beban_akhir));
					$template->setValue('surplus_sekarang', dot2_minus($detail->surplus_sekarang));
					$template->setValue('surplus_awal', dot2_minus($detail->surplus_awal));
					$template->setValue('surplus_akhir', dot2_minus($detail->surplus_akhir));

					$template->setValue('beban_bunga_sekarang', dot2_minus($detail->beban_bunga_sekarang));
					$template->setValue('beban_bunga_awal', dot2_minus($detail->beban_bunga_awal));
					$template->setValue('total_bunga', dot2_minus($detail->total_bunga));
					$template->setValue('beban_penyisihanpiutang_sekarang', dot2_minus($detail->beban_penyisihanpiutang_sekarang));
					$template->setValue('beban_penyisihanpiutang_awal', dot2_minus($detail->beban_penyisihanpiutang_awal));
					$template->setValue('total_penyisihanpiutang', dot2_minus($detail->total_penyisihanpiutang));
					$template->setValue('beban_takterduga_sekarang', dot2_minus($detail->beban_takterduga_sekarang));
					$template->setValue('beban_takterduga_awal', dot2_minus($detail->beban_takterduga_awal));
					$template->setValue('total_beban_takterduga', dot2_minus($detail->total_beban_takterduga));

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

					$template->setValue('total_belanja', rp_minus($detail->total_beban_sekarang));
					$terbilang_total_belanja = terbilang_koma_minus($detail->total_beban_sekarang);
					$template->setValue('terbilang_total_belanja', $terbilang_total_belanja);

					$template->setValue('total_semua', rp_minus($detail->total_pendapatan_lo_sekarang));
					$terbilang_total = terbilang_koma_minus($detail->total_pendapatan_lo_sekarang);
					$template->setValue('terbilang_total', $terbilang_total);






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
					$this->db->where('id_laporan_operasional', $in);
					$this->db->update('laporan_operasional');
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
					// echo "5";
					// break;
					redirect(base_url('keuangan/lap_operasional/detail/' . encode($in) . '?msg=' . urlencode($data['message'])));
				} else {

					$data['message'] = 'Terjadi kesalahan';
					$data['message_type'] = 'danger';
					// echo "6";
					// break;
				}
				// echo "7";
				// break;
				// } while (0);
			}

			$data['detail']		= $this->lap_operasional_model->get_by_id($id_laporan_operasional);
			$data['active_menu'] = "neraca";
			$this->load->view('admin/index', $data);
		} else {
			redirect('admin');
		}
	}


	public function delete($id_laporan_operasional)
	{
		if (($this->user_level != "Administrator" && $this->user_level != "Admin Web") && !in_array('keuangan', explode(';', $this->session->userdata('user_privileges')))) redirect('welcome');

		$this->lap_operasional_model->delete($id_laporan_operasional);

		redirect('keuangan/lap_operasional');
	}

	public function reset_ulang($id_laporan_operasional)
	{
		if (($this->user_level != "Administrator" && $this->user_level != "Admin Web") && !in_array('keuangan', explode(';', $this->session->userdata('user_privileges')))) redirect('welcome');
		$id_laporan_operasional = decode($id_laporan_operasional);
			$cek_status_tte = $this->lap_operasional_model->cek_status_tte($id_laporan_operasional);
			if ($cek_status_tte) {

				$this->lap_operasional_model->ttd_pegawai_1_bpkad = 'belum';
				$this->lap_operasional_model->ttd_pegawai_2_bpkad = 'belum';
				$this->lap_operasional_model->ttd_pegawai_3_bpkad = 'belum';
				$this->lap_operasional_model->ttd_pegawai_4_bpkad = 'belum';
				$this->lap_operasional_model->ttd_pegawai_1_skpd = 'belum';
				$this->lap_operasional_model->ttd_pegawai_2_skpd = 'belum';
				$this->lap_operasional_model->ttd_pegawai_3_skpd = 'belum';
				$this->lap_operasional_model->ttd_pegawai_4_skpd = 'belum';
				$this->lap_operasional_model->status_verifikasi = 'belum';
				$this->lap_operasional_model->alasan_penolakan = '';
				$this->lap_operasional_model->status = 'Proses';


				$this->lap_operasional_model->update_reset($id_laporan_operasional);
				$in = $id_laporan_operasional;

				if ($in) {

					$detail =  $this->lap_operasional_model->get_by_id($in);
					$phpWord = new \PhpOffice\PhpWord\PhpWord();
					$phpWord->getCompatibility()->setOoxmlVersion(14);
					$phpWord->getCompatibility()->setOoxmlVersion(15);

					//$template = $detail->file_draft;
					$filename = $detail->nama_skpd . '_LO_' . time() . ".docx";
					$filename = str_replace(",", "", $filename);
					$filename = str_replace(" ", "_", $filename);
					$filename = str_replace("/", "_", $filename);
					//$filename = 'tes.docx';	
					$template_path = './data/keuangan/template/LO_template.docx';

					$template = $phpWord->loadTemplate($template_path);

					$template->setValue('hari', poee(date('N', strtotime($detail->tgl_pengesahan))));
					$template->setValue('nama_skpd', $detail->nama_skpd);
					$template->setValue('tgl_periode', tanggal($detail->tgl_periode));
					$template->setValue('thn_periode', date('Y', strtotime($detail->tgl_periode)) - 1);
					$tgl_pengesahan = terbilang(date('d', strtotime($detail->tgl_pengesahan))) . " bulan " . bulan(date('m', strtotime($detail->tgl_pengesahan))) . " tahun " . terbilang(date('Y', strtotime($detail->tgl_pengesahan)));
					$template->setValue('tgl_pengesahan', $tgl_pengesahan);

					$template->setValue('pendapatan_asli_sekarang', dot2_minus($detail->pendapatan_asli_sekarang));
					$template->setValue('pendapatan_asli_awal', dot2_minus($detail->pendapatan_asli_awal));
					$template->setValue('total_pendapatan_asli', dot2_minus($detail->total_pendapatan_asli));
					$template->setValue('pendapatan_transfer_sekarang', dot2_minus($detail->pendapatan_transfer_sekarang));
					$template->setValue('pendapatan_transfer_awal', dot2_minus($detail->pendapatan_transfer_awal));
					$template->setValue('total_pendapatan_transfer', dot2_minus($detail->total_pendapatan_transfer));
					$template->setValue('pendapatan_lain_sekarang', dot2_minus($detail->pendapatan_lain_sekarang));
					$template->setValue('pendapatan_lain_awal', dot2_minus($detail->pendapatan_lain_awal));
					$template->setValue('total_pendapatan_lain', dot2_minus($detail->total_pendapatan_lain));
					$template->setValue('pendapatan_surplus_sekarang', dot2_minus($detail->pendapatan_surplus_sekarang));
					$template->setValue('pendapatan_surplus_awal', dot2_minus($detail->pendapatan_surplus_awal));
					$template->setValue('total_pendapatan_surplus', dot2_minus($detail->total_pendapatan_surplus));
					$template->setValue('total_pendapatan1_lo', dot2_minus($detail->total_pendapatan1_lo));
					$template->setValue('total_pendapatan_lo_sekarang', dot2_minus($detail->total_pendapatan_lo_sekarang));
					$template->setValue('total_pendapatan_lo_awal', dot2_minus($detail->total_pendapatan_lo_awal));
					$template->setValue('beban_pegawai_sekarang', dot2_minus($detail->beban_pegawai_sekarang));
					$template->setValue('beban_pegawai_awal', dot2_minus($detail->beban_pegawai_awal));
					$template->setValue('total_beban_pegawai', dot2_minus($detail->total_beban_pegawai));
					$template->setValue('beban_barangjasa_sekarang', dot2_minus($detail->beban_barangjasa_sekarang));
					$template->setValue('beban_barangjasa_awal', dot2_minus($detail->beban_barangjasa_awal));
					$template->setValue('total_barangjasa', dot2_minus($detail->total_barangjasa));
					$template->setValue('beban_hibah_sekarang', dot2_minus($detail->beban_hibah_sekarang));
					$template->setValue('beban_hibah_awal', dot2_minus($detail->beban_hibah_awal));
					$template->setValue('total_beban_hibah', dot2_minus($detail->total_beban_hibah));
					$template->setValue('beban_bantuansosial_sekarang', dot2_minus($detail->beban_bantuansosial_sekarang));
					$template->setValue('beban_bantuansosial_awal', dot2_minus($detail->beban_bantuansosial_awal));
					$template->setValue('total_bantuansosial', dot2_minus($detail->total_bantuansosial));
					$template->setValue('beban_penyusutan_sekarang', dot2_minus($detail->beban_penyusutan_sekarang));
					$template->setValue('beban_penyusutan_awal', dot2_minus($detail->beban_penyusutan_awal));
					$template->setValue('total_beban_penyusutan', dot2_minus($detail->total_beban_penyusutan));
					$template->setValue('beban_lain_sekarang', dot2_minus($detail->beban_lain_sekarang));
					$template->setValue('beban_lain_awal', dot2_minus($detail->beban_lain_awal));
					$template->setValue('total_beban_lain', dot2_minus($detail->total_beban_lain));
					$template->setValue('jumlah_beban_operasi_sekarang', dot2_minus($detail->jumlah_beban_operasi_sekarang));
					$template->setValue('jumlah_beban_operasi_awal', dot2_minus($detail->jumlah_beban_operasi_awal));
					$template->setValue('total_beban_operasi', dot2_minus($detail->total_beban_operasi));
					$template->setValue('defisit_keg_nonopera_sekarang', dot2_minus($detail->defisit_keg_nonopera_sekarang));
					$template->setValue('defisit_keg_nonopera_awal', dot2_minus($detail->defisit_keg_nonopera_awal));
					$template->setValue('total_defisit_keg_nonopera', dot2_minus($detail->total_defisit_keg_nonopera));
					$template->setValue('beban_transfer_sekarang', dot2_minus($detail->beban_transfer_sekarang));
					$template->setValue('beban_transfer_awal', dot2_minus($detail->beban_transfer_awal));
					$template->setValue('total_beban_transfer', dot2_minus($detail->total_beban_transfer));
					$template->setValue('beban_luar_biasa_sekarang', dot2_minus($detail->beban_luar_biasa_sekarang));
					$template->setValue('beban_luar_biasa_awal', dot2_minus($detail->beban_luar_biasa_awal));
					$template->setValue('total_beban_luar_biasa', dot2_minus($detail->total_beban_luar_biasa));
					$template->setValue('total_beban_sekarang', dot2_minus($detail->total_beban_sekarang));
					$template->setValue('total_beban_awal', dot2_minus($detail->total_beban_awal));
					$template->setValue('total_beban_akhir', dot2_minus($detail->total_beban_akhir));
					$template->setValue('surplus_sekarang', dot2_minus($detail->surplus_sekarang));
					$template->setValue('surplus_awal', dot2_minus($detail->surplus_awal));
					$template->setValue('surplus_akhir', dot2_minus($detail->surplus_akhir));

					$template->setValue('beban_bunga_sekarang', dot2_minus($detail->beban_bunga_sekarang));
					$template->setValue('beban_bunga_awal', dot2_minus($detail->beban_bunga_awal));
					$template->setValue('total_bunga', dot2_minus($detail->total_bunga));
					$template->setValue('beban_penyisihanpiutang_sekarang', dot2_minus($detail->beban_penyisihanpiutang_sekarang));
					$template->setValue('beban_penyisihanpiutang_awal', dot2_minus($detail->beban_penyisihanpiutang_awal));
					$template->setValue('total_penyisihanpiutang', dot2_minus($detail->total_penyisihanpiutang));
					$template->setValue('beban_takterduga_sekarang', dot2_minus($detail->beban_takterduga_sekarang));
					$template->setValue('beban_takterduga_awal', dot2_minus($detail->beban_takterduga_awal));
					$template->setValue('total_beban_takterduga', dot2_minus($detail->total_beban_takterduga));

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

					$template->setValue('total_belanja', rp_minus($detail->total_beban_sekarang));
					$terbilang_total_belanja = terbilang_koma_minus($detail->total_beban_sekarang);
					$template->setValue('terbilang_total_belanja', $terbilang_total_belanja);

					$template->setValue('total_semua', rp_minus($detail->total_pendapatan_lo_sekarang));
					$terbilang_total = terbilang_koma_minus($detail->total_pendapatan_lo_sekarang);
					$template->setValue('terbilang_total', $terbilang_total);






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
					$this->db->where('id_laporan_operasional', $in);
					$this->db->update('laporan_operasional');
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


					$data['message'] = '<b>Sukses</b> Dokumen Berhasil Direset.';
					$data['message_type'] = 'success';
					// echo "5";
					// break;
					redirect(base_url('keuangan/lap_operasional/detail/' . encode($in) . '?msg=' . urlencode($data['message'])));
				} else {

					$data['message'] = 'Terjadi kesalahan';
					$data['message_type'] = 'danger';
					// echo "6";
					// break;
				}
				// echo "7";
				// break;
				// } while (0);
			} else {
				$data['message'] = '<b>GAGAL!</b> Dokumen sudah Terbit.';
				redirect(base_url('keuangan/lap_operasional/detail/' . encode($lap_operasional) . '?msg=' . urlencode($data['message'])));
			}

	}


	function convert()
	{
		$var = shell_exec("lowriter --convert-to pdf ./data/keuangan/tmp/tes.docx --outdir ./data/keuangan/tmp 2>&1");
		var_dump($var);
	}
}