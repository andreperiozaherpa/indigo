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

class Lap_neraca extends CI_Controller
{
	public $user_id;

	public function __construct()
	{
		parent::__construct();
		$this->user_id = $this->session->userdata('user_id');


		$this->user_model->user_id = $this->user_id;
		$this->user_model->set_user_by_user_id();
		$this->load->model('ref_skpd_model');
		$this->load->model('lap_neraca_model');
		$this->load->model('logs_model');
		$this->load->helper('text');
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
			$data['content']	= "keuangan/lap_neraca/index";
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;

			$hal = 6;
			$page = isset($_GET["page"]) ? (int)$_GET["page"] : 1;
			$mulai = ($page > 1) ? ($page * $hal) - $hal : 0;
			$total = count($this->lap_neraca_model->get_all());
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
			$data['list'] = $this->lap_neraca_model->get_page($mulai, $hal, $filter);


			$data['active_menu'] = "lap_neraca";
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
			$data['content']	= "keuangan/lap_neraca/add";
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;

			//$data['query']		= $this->agenda_model->get_all();
			$data['active_menu'] = "lap_neraca";

			$data['skpd'] = $this->ref_skpd_model->get_all();
			$data['pegawai_bpkad'] = $this->db->order_by('nama_lengkap','asc')->get_where('pegawai', ['id_skpd' => 25])->result();
			$data['sarerea_penandatangan'] = $this->db->get_where('sarerea_penandatangan', ['id' => 1])->row();
			//$data['pegawai_setda'] = $this->db->get_where('pegawai',['id_skpd'=>1])->result();

			if ($_POST) {
				// do {

					if(isset($_FILES['file_draft']['tmp_name'])){
						$config['upload_path']          = './data/keuangan/tmp/';
						$config['allowed_types']        = 'pdf';

						$input = array();
						$this->load->library('upload', $config);
						if ( ! $this->upload->do_upload('file_draft')){
							$tmp_name = $_FILES['file_draft']['tmp_name'];
							if ($tmp_name!=""){
								$data['message'] = $this->upload->display_errors();
								$data['message_type'] = "danger";
								// echo "1";
								// break;
								
							}
							// echo ".1";
						}else{
							$nama = $this->upload->data('file_name');
							$this->lap_neraca_model->file_draft = $nama;
							if($up){
								$data['message'] = "File berhasil diupload";
								$data['message_type'] = 'success';
								echo "2";
							}else{

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

					$this->lap_neraca_model->id_skpd = $_POST['id_skpd'];
					$this->lap_neraca_model->tgl_periode = $_POST['tgl_periode'];
					$this->lap_neraca_model->tgl_pengesahan = $_POST['tgl_pengesahan'];

					$this->lap_neraca_model->asset_lancar_sekarang = $_POST['asset_lancar_sekarang'];
					$this->lap_neraca_model->asset_lancar_awal = $_POST['asset_lancar_awal'];
					$this->lap_neraca_model->asset_lancar_total = $_POST['asset_lancar_total'];
					$this->lap_neraca_model->kas_sekarang = $_POST['kas_sekarang'];
					$this->lap_neraca_model->kas_awal = $_POST['kas_awal'];
					$this->lap_neraca_model->kas_total = $_POST['kas_total'];
					$this->lap_neraca_model->persedian_sekarang = $_POST['persedian_sekarang'];
					$this->lap_neraca_model->persedian_awal = $_POST['persedian_awal'];
					$this->lap_neraca_model->persedian_total = $_POST['persedian_total'];
					$this->lap_neraca_model->dst1_text = $_POST['dst1_text'];
					$this->lap_neraca_model->dst1_sekarang = $_POST['dst1_sekarang'];
					$this->lap_neraca_model->dst1_awal = $_POST['dst1_awal'];
					$this->lap_neraca_model->dst1_total = $_POST['dst1_total'];
					$this->lap_neraca_model->dst2_text = $_POST['dst2_text'];
					$this->lap_neraca_model->dst2_sekarang = $_POST['dst2_sekarang'];
					$this->lap_neraca_model->dst2_awal = $_POST['dst2_awal'];
					$this->lap_neraca_model->dst2_total = $_POST['dst2_total'];
					$this->lap_neraca_model->dst3_text = $_POST['dst3_text'];
					$this->lap_neraca_model->dst3_sekarang = $_POST['dst3_sekarang'];
					$this->lap_neraca_model->dst3_awal = $_POST['dst3_awal'];
					$this->lap_neraca_model->dst3_total = $_POST['dst3_total'];
					$this->lap_neraca_model->dst4_text = $_POST['dst4_text'];
					$this->lap_neraca_model->dst4_sekarang = $_POST['dst4_sekarang'];
					$this->lap_neraca_model->dst4_awal = $_POST['dst4_awal'];
					$this->lap_neraca_model->dst4_total = $_POST['dst4_total'];
					$this->lap_neraca_model->dst5_text = $_POST['dst5_text'];
					$this->lap_neraca_model->dst5_sekarang = $_POST['dst5_sekarang'];
					$this->lap_neraca_model->dst5_awal = $_POST['dst5_awal'];
					$this->lap_neraca_model->dst5_total = $_POST['dst5_total'];
					$this->lap_neraca_model->dst6_text = $_POST['dst6_text'];
					$this->lap_neraca_model->dst6_sekarang = $_POST['dst6_sekarang'];
					$this->lap_neraca_model->dst6_awal = $_POST['dst6_awal'];
					$this->lap_neraca_model->dst6_total = $_POST['dst6_total'];
					$this->lap_neraca_model->dst7_text = $_POST['dst7_text'];
					$this->lap_neraca_model->dst7_sekarang = $_POST['dst7_sekarang'];
					$this->lap_neraca_model->dst7_awal = $_POST['dst7_awal'];
					$this->lap_neraca_model->dst7_total = $_POST['dst7_total'];
					$this->lap_neraca_model->dst8_text = $_POST['dst8_text'];
					$this->lap_neraca_model->dst8_sekarang = $_POST['dst8_sekarang'];
					$this->lap_neraca_model->dst8_awal = $_POST['dst8_awal'];
					$this->lap_neraca_model->dst8_total = $_POST['dst8_total'];
					$this->lap_neraca_model->investasi_jangkapanjang_sekarang = $_POST['investasi_jangkapanjang_sekarang'];
					$this->lap_neraca_model->investasi_jangkapanjang_awal = $_POST['investasi_jangkapanjang_awal'];
					$this->lap_neraca_model->investasi_jangkapanjang_total = $_POST['investasi_jangkapanjang_total'];
					$this->lap_neraca_model->asset_tetap_sekarang = $_POST['asset_tetap_sekarang'];
					$this->lap_neraca_model->asset_tetap_awal = $_POST['asset_tetap_awal'];
					$this->lap_neraca_model->asset_tetap_total = $_POST['asset_tetap_total'];
					$this->lap_neraca_model->tanah_sekarang = $_POST['tanah_sekarang'];
					$this->lap_neraca_model->tanah_awal = $_POST['tanah_awal'];
					$this->lap_neraca_model->tanah_total = $_POST['tanah_total'];
					$this->lap_neraca_model->peralatan_sekarang = $_POST['peralatan_sekarang'];
					$this->lap_neraca_model->peralatan_awal = $_POST['peralatan_awal'];
					$this->lap_neraca_model->peralatan_total = $_POST['peralatan_total'];
					$this->lap_neraca_model->gedung_sekarang = $_POST['gedung_sekarang'];
					$this->lap_neraca_model->gedung_awal = $_POST['gedung_awal'];
					$this->lap_neraca_model->gedung_total = $_POST['gedung_total'];
					$this->lap_neraca_model->jalan_sekarang = $_POST['jalan_sekarang'];
					$this->lap_neraca_model->jalan_awal = $_POST['jalan_awal'];
					$this->lap_neraca_model->jalan_total = $_POST['jalan_total'];
					$this->lap_neraca_model->asset_lainya_sekarang = $_POST['asset_lainya_sekarang'];
					$this->lap_neraca_model->asset_lainya_awal = $_POST['asset_lainya_awal'];
					$this->lap_neraca_model->asset_lainya_total = $_POST['asset_lainya_total'];
					$this->lap_neraca_model->kontruksi_sekarang = $_POST['kontruksi_sekarang'];
					$this->lap_neraca_model->kontruksi_awal = $_POST['kontruksi_awal'];
					$this->lap_neraca_model->kontruksi_total = $_POST['kontruksi_total'];
					$this->lap_neraca_model->akumulasi_sekarang = $_POST['akumulasi_sekarang'];
					$this->lap_neraca_model->akumulasi_awal = $_POST['akumulasi_awal'];
					$this->lap_neraca_model->akumulasi_total = $_POST['akumulasi_total'];
					$this->lap_neraca_model->asset_lain_sekarang = $_POST['asset_lain_sekarang'];
					$this->lap_neraca_model->asset_lain_awal = $_POST['asset_lain_awal'];
					$this->lap_neraca_model->asset_lain_total = $_POST['asset_lain_total'];
					$this->lap_neraca_model->total_asset_sekarang = $_POST['total_asset_sekarang'];
					$this->lap_neraca_model->total_asset_awal = $_POST['total_asset_awal'];
					$this->lap_neraca_model->total_asset = $_POST['total_asset'];
					$this->lap_neraca_model->total_kewajiban_sekarang = $_POST['total_kewajiban_sekarang'];
					$this->lap_neraca_model->total_kewajiban_awal = $_POST['total_kewajiban_awal'];
					$this->lap_neraca_model->total_kewajiban = $_POST['total_kewajiban'];
					$this->lap_neraca_model->kewajiban_pendek_sekarang = $_POST['kewajiban_pendek_sekarang'];
					$this->lap_neraca_model->kewajiban_pendek_awal = $_POST['kewajiban_pendek_awal'];
					$this->lap_neraca_model->kewajiban_pendek_total = $_POST['kewajiban_pendek_total'];
					$this->lap_neraca_model->kewajiban_panjang_sekarang = $_POST['kewajiban_panjang_sekarang'];
					$this->lap_neraca_model->kewajiban_panjang_awal = $_POST['kewajiban_panjang_awal'];
					$this->lap_neraca_model->kewajiban_panjang_total = $_POST['kewajiban_panjang_total'];
					$this->lap_neraca_model->ekuitas_sekarang = $_POST['ekuitas_sekarang'];
					$this->lap_neraca_model->ekuitas_awal = $_POST['ekuitas_awal'];
					$this->lap_neraca_model->ekuitas_total = $_POST['ekuitas_total'];
					$this->lap_neraca_model->total_neraca_sekarang = $_POST['total_neraca_sekarang'];
					$this->lap_neraca_model->total_neraca_awal = $_POST['total_neraca_awal'];
					$this->lap_neraca_model->total_neraca = $_POST['total_neraca'];



					$this->lap_neraca_model->id_pegawai_1_bpkad = $_POST['id_pegawai_1_bpkad'];
					$this->lap_neraca_model->id_pegawai_2_bpkad = $_POST['id_pegawai_2_bpkad'];
					$this->lap_neraca_model->id_pegawai_3_bpkad = $_POST['id_pegawai_3_bpkad'];
					$this->lap_neraca_model->id_pegawai_4_bpkad = $_POST['id_pegawai_4_bpkad'];
					$this->lap_neraca_model->id_pegawai_1_skpd = $_POST['id_pegawai_1_skpd'];
					$this->lap_neraca_model->id_pegawai_2_skpd = $_POST['id_pegawai_2_skpd'];
					$this->lap_neraca_model->id_pegawai_3_skpd = $_POST['id_pegawai_3_skpd'];
					$this->lap_neraca_model->id_pegawai_4_skpd = $_POST['id_pegawai_4_skpd'];
					$this->lap_neraca_model->ttd_pegawai_1_bpkad = 'belum';
					$this->lap_neraca_model->ttd_pegawai_2_bpkad = 'belum';
					$this->lap_neraca_model->ttd_pegawai_3_bpkad = 'belum';
					$this->lap_neraca_model->ttd_pegawai_4_bpkad = 'belum';
					$this->lap_neraca_model->ttd_pegawai_1_skpd = 'belum';
					$this->lap_neraca_model->ttd_pegawai_2_skpd = 'belum';
					$this->lap_neraca_model->ttd_pegawai_3_skpd = 'belum';
					$this->lap_neraca_model->ttd_pegawai_4_skpd = 'belum';
					// $this->lap_neraca_model->file_draft = $_POST['file_draft'];
					// $this->lap_neraca_model->file_signed = $_POST['file_signed'];
					$this->lap_neraca_model->status = 'Proses';




					//tulis script php word disini



					$in = $this->lap_neraca_model->insert();
					if ($in) {

						$detail =  $this->lap_neraca_model->get_by_id($in);
						$phpWord = new \PhpOffice\PhpWord\PhpWord();
						$phpWord->getCompatibility()->setOoxmlVersion(14);
						$phpWord->getCompatibility()->setOoxmlVersion(15);

						//$template = $detail->file_draft;
						$filename = $detail->nama_skpd . '_Neraca_' . time() . ".docx";
						$filename = str_replace(",", "", $filename);
						$filename = str_replace(" ", "_", $filename);
						$filename = str_replace("/", "_", $filename);
						//$filename = 'tes.docx';	
						$template_path = './data/keuangan/template/Neraca_template.docx';

						$template = $phpWord->loadTemplate($template_path);

						$template->setValue('hari', poee(date('N', strtotime($detail->tgl_pengesahan))));
						$template->setValue('nama_skpd', $detail->nama_skpd);
						$template->setValue('tgl_periode', tanggal($detail->tgl_periode));
						$template->setValue('thn_periode', date('Y', strtotime($detail->tgl_periode)) -1);
						$tgl_pengesahan = terbilang(date('d', strtotime($detail->tgl_pengesahan))) . " bulan " . bulan(date('m', strtotime($detail->tgl_pengesahan))) . " tahun " . terbilang(date('Y', strtotime($detail->tgl_pengesahan)));
						$template->setValue('tgl_pengesahan', $tgl_pengesahan);


						$template->setValue('total_pendapatan1_lo', dot2_minus($detail->total_pendapatan_lo));
						$template->setValue('asset_lancar_sekarang', dot2_minus($detail->asset_lancar_sekarang));
						$template->setValue('asset_lancar_awal', dot2_minus($detail->asset_lancar_awal));
						$template->setValue('asset_lancar_total', dot2_minus($detail->asset_lancar_total));
						$template->setValue('kas_sekarang', dot2_minus($detail->kas_sekarang));
						$template->setValue('kas_awal', dot2_minus($detail->kas_awal));
						$template->setValue('kas_total', dot2_minus($detail->kas_total));
						$template->setValue('persedian_sekarang', dot2_minus($detail->persedian_sekarang));
						$template->setValue('persedian_awal', dot2_minus($detail->persedian_awal));
						$template->setValue('persedian_total', dot2_minus($detail->persedian_total));
						$template->setValue('investasi_jangkapanjang_sekarang', dot2_minus($detail->investasi_jangkapanjang_sekarang));
						$template->setValue('investasi_jangkapanjang_awal', dot2_minus($detail->investasi_jangkapanjang_awal));
						$template->setValue('investasi_jangkapanjang_total', dot2_minus($detail->investasi_jangkapanjang_total));
						$template->setValue('asset_tetap_sekarang', dot2_minus($detail->asset_tetap_sekarang));
						$template->setValue('asset_tetap_awal', dot2_minus($detail->asset_tetap_awal));
						$template->setValue('asset_tetap_total', dot2_minus($detail->asset_tetap_total));
						$template->setValue('tanah_sekarang', dot2_minus($detail->tanah_sekarang));
						$template->setValue('tanah_awal', dot2_minus($detail->tanah_awal));
						$template->setValue('tanah_total', dot2_minus($detail->tanah_total));
						$template->setValue('peralatan_sekarang', dot2_minus($detail->peralatan_sekarang));
						$template->setValue('peralatan_awal', dot2_minus($detail->peralatan_awal));
						$template->setValue('peralatan_total', dot2_minus($detail->peralatan_total));
						$template->setValue('gedung_sekarang', dot2_minus($detail->gedung_sekarang));
						$template->setValue('gedung_awal', dot2_minus($detail->gedung_awal));
						$template->setValue('gedung_total', dot2_minus($detail->gedung_total));
						$template->setValue('jalan_sekarang', dot2_minus($detail->jalan_sekarang));
						$template->setValue('jalan_awal', dot2_minus($detail->jalan_awal));
						$template->setValue('jalan_total', dot2_minus($detail->jalan_total));
						$template->setValue('asset_lainya_sekarang', dot2_minus($detail->asset_lainya_sekarang));
						$template->setValue('asset_lainya_awal', dot2_minus($detail->asset_lainya_awal));
						$template->setValue('asset_lainya_total', dot2_minus($detail->asset_lainya_total));
						$template->setValue('kontruksi_sekarang', dot2_minus($detail->kontruksi_sekarang));
						$template->setValue('kontruksi_awal', dot2_minus($detail->kontruksi_awal));
						$template->setValue('kontruksi_total', dot2_minus($detail->kontruksi_total));
						$template->setValue('akumulasi_sekarang', dot2_minus($detail->akumulasi_sekarang));
						$template->setValue('akumulasi_awal', dot2_minus($detail->akumulasi_awal));
						$template->setValue('akumulasi_total', dot2_minus($detail->akumulasi_total));
						$template->setValue('asset_lain_sekarang', dot2_minus($detail->asset_lain_sekarang));
						$template->setValue('asset_lain_awal', dot2_minus($detail->asset_lain_awal));
						$template->setValue('asset_lain_total', dot2_minus($detail->asset_lain_total));
						$template->setValue('total_asset_sekarang', dot2_minus($detail->total_asset_sekarang));
						$template->setValue('total_asset_awal', dot2_minus($detail->total_asset_awal));
						$template->setValue('total_asset', dot2_minus($detail->total_asset));
						$template->setValue('total_kewajiban_sekarang', dot2_minus($detail->total_kewajiban_sekarang));
						$template->setValue('total_kewajiban_awal', dot2_minus($detail->total_kewajiban_awal));
						$template->setValue('total_kewajiban', dot2_minus($detail->total_kewajiban));
						$template->setValue('kewajiban_pendek_sekarang', dot2_minus($detail->kewajiban_pendek_sekarang));
						$template->setValue('kewajiban_pendek_awal', dot2_minus($detail->kewajiban_pendek_awal));
						$template->setValue('kewajiban_pendek_total', dot2_minus($detail->kewajiban_pendek_total));
						$template->setValue('kewajiban_panjang_sekarang', dot2_minus($detail->kewajiban_panjang_sekarang));
						$template->setValue('kewajiban_panjang_awal', dot2_minus($detail->kewajiban_panjang_awal));
						$template->setValue('kewajiban_panjang_total', dot2_minus($detail->kewajiban_panjang_total));
						$template->setValue('ekuitas_sekarang', dot2_minus($detail->ekuitas_sekarang));
						$template->setValue('ekuitas_awal', dot2_minus($detail->ekuitas_awal));
						$template->setValue('ekuitas_total', dot2_minus($detail->ekuitas_total));
						$template->setValue('total_neraca_sekarang', dot2_minus($detail->total_neraca_sekarang));
						$template->setValue('total_neraca_awal', dot2_minus($detail->total_neraca_awal));
						$template->setValue('total_neraca', dot2_minus($detail->total_neraca));

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

						// $template->setValue('total_belanja', $detail->total_beban_air);
						// $terbilang_total_belanja = terbilang($detail->total_beban_akhir);
						// $template->setValue('terbilang_total_belanja', $terbilang_total_belanja);


						$list_dst = array();
						for ($i=1; $i <= 8; $i++) { 
							$dst_text = "dst".$i."_text";

							if ($detail->$dst_text != "") {
								$list_dst[] = $i;
							}
						}

						if (count($list_dst) > 0) {
							$i = 1;
							$template->cloneRow('dst_text', count($list_dst)+1);
							foreach ($list_dst as $ld) {
								$dst_text = "dst".$ld."_text";
			                    $template->setValue('dst_text#'.$i, ascii_to_entities($detail->$dst_text));
								$dst_sekarang = "dst".$ld."_sekarang";
			                    $template->setValue('dst_sekarang#'.$i, dot2_minus($detail->$dst_sekarang));
								$dst_awal = "dst".$ld."_awal";
			                    $template->setValue('dst_awal#'.$i, dot2_minus($detail->$dst_awal));
								$dst_total = "dst".$ld."_total";
			                    $template->setValue('dst_total#'.$i, dot2_minus($detail->$dst_total));
			                    $i++;
							}
							$template->setValue('dst_text#'.$i, "");
							$template->setValue('dst_sekarang#'.$i, "");
							$template->setValue('dst_awal#'.$i, "");
							$template->setValue('dst_total#'.$i, "");
						} else {
							$template->setValue('dst_text', "");
							$template->setValue('dst_sekarang', "");
							$template->setValue('dst_awal', "");
							$template->setValue('dst_total', "");
						}


						
						$template->setValue('subtotal_neraca', rp_minus($detail->total_neraca_sekarang));
						 $terbilang_total_neraca = terbilang_koma_minus($detail->total_neraca_sekarang);
						$template->setValue('terbilang_total_neraca', $terbilang_total_neraca);






						ob_clean();
						$template->saveAs("./data/keuangan/tmp/" . $filename);
						$file_pdf = $this->wordpdf->convert("data/keuangan/tmp/" . $filename);
						//fwrite file_pdf to /data/keuangan/

						
						$berkas_pdf  = pathinfo("./data/keuangan/tmp/{$filename}", PATHINFO_FILENAME).".pdf";

						$file = fopen("./data/keuangan/".$berkas_pdf,"w");
						fwrite($file, base64_decode($file_pdf));
						fclose($file);
						// die;

						// shell_exec("libreoffice --headless  --convert-to pdf ./data/keuangan/tmp/{$filename} --outdir ./data/keuangan/ 2>&1");
						// $berkas_pdf  = pathinfo("./data/keuangan/tmp/{$filename}", PATHINFO_FILENAME).".pdf";
						unlink("./data/keuangan/tmp/" . $filename);

						$this->db->set('file_signed_draft', $berkas_pdf);
						$this->db->set('tgl_upload', date('Y-m-d H:i:s'));
						$this->db->where('id_laporan_neraca', $in);
						$this->db->update('laporan_neraca');
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
						redirect(base_url('keuangan/lap_neraca/detail/' . encode($in) . '?msg=' . urlencode($data['message'])));
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


	public function detail($id_laporan_neraca)
	{
		if ($this->user_id) {
			$id_laporan_neraca = decode($id_laporan_neraca);
			$data['title']		= "Keuangan - " . app_name;
			$data['content']	= "keuangan/lap_neraca/detail";
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;

			$data['detail']		= $this->lap_neraca_model->get_by_id($id_laporan_neraca);

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
					$up = $this->db->update('laporan_neraca', $data_up, ['id_laporan_neraca' => $id_laporan_neraca]);
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
					$get_data 	 = $this->lap_neraca_model->get_by_id($id_laporan_neraca);
					$user 		 = $this->user_model->get_current_sertifikat_user();
					$cur_date 	 = date("Ymdhis");
					$berkas		 = !empty($get_data->file_signed_draft) ? $get_data->file_signed_draft : "tmp/".$get_data->file_draft;
					$src 		 = "./data/keuangan/".$berkas;
					// $src 		 = "./data/keuangan/".$berkas;
					//$certificate = "./data/sertifikat/{$user->certificate}";
					$certificate = "/sertifikat/{$user->user_id}/{$user->certificate}";
					$input_name	 = !empty($get_data->file_signed_draft) ? $get_data->file_signed_draft : $get_data->file_draft;
					$filename = $get_data->nama_skpd . '_Neraca_' . time();
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

						if ($get_data->ttd_pegawai_3_skpd != "setuju") {
							$this->db->set('ttd_pegawai_3_skpd', 'setuju');
							$this->db->set('tgl_pegawai_3_skpd', date('Y-m-d H:i:s'));
						} elseif ($get_data->ttd_pegawai_2_skpd != "setuju") {
							$this->db->set('ttd_pegawai_2_skpd', 'setuju');
							$this->db->set('tgl_pegawai_2_skpd', date('Y-m-d H:i:s'));
						}  elseif ($get_data->ttd_pegawai_1_skpd != "setuju") {
							$this->db->set('ttd_pegawai_1_skpd', 'setuju');
							$this->db->set('tgl_pegawai_1_skpd', date('Y-m-d H:i:s'));
						} elseif ($get_data->ttd_pegawai_3_bpkad != "setuju") {
							$this->db->set('ttd_pegawai_3_bpkad', 'setuju');
							$this->db->set('tgl_pegawai_3_bpkad', date('Y-m-d H:i:s'));
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
						$this->db->where('id_laporan_neraca', $id_laporan_neraca);
						$this->db->update('laporan_neraca');


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
							'key_value' => $id_laporan_neraca,
							'category' => 'surat_Neraca',
						);

						$this->logs_model->insert_log($log_data);
					}
				} elseif (isset($_POST['tolak'])) {

					$get_data 	 = $this->lap_neraca_model->get_by_id($id_laporan_neraca);
					//baca notifikasi

					if ($get_data->ttd_pegawai_3_skpd != "setuju") {
						$this->db->set('ttd_pegawai_3_skpd', 'ditolak');
						$this->db->set('tgl_pegawai_3_skpd', date('Y-m-d H:i:s'));
					} elseif ($get_data->ttd_pegawai_2_skpd != "setuju") {
						$this->db->set('ttd_pegawai_2_skpd', 'ditolak');
						$this->db->set('tgl_pegawai_2_skpd', date('Y-m-d H:i:s'));
					}  elseif ($get_data->ttd_pegawai_1_skpd != "setuju") {
						$this->db->set('ttd_pegawai_1_skpd', 'ditolak');
						$this->db->set('tgl_pegawai_1_skpd', date('Y-m-d H:i:s'));
					} elseif ($get_data->ttd_pegawai_3_bpkad != "setuju") {
						$this->db->set('ttd_pegawai_3_bpkad', 'ditolak');
						$this->db->set('tgl_pegawai_3_bpkad', date('Y-m-d H:i:s'));
					} elseif ($get_data->ttd_pegawai_2_bpkad != "setuju") {
						$this->db->set('ttd_pegawai_2_bpkad', 'ditolak');
						$this->db->set('tgl_pegawai_2_bpkad', date('Y-m-d H:i:s'));
					} elseif ($get_data->ttd_pegawai_1_bpkad != "setuju") {
						$this->db->set('ttd_pegawai_1_bpkad', 'ditolak');
						$this->db->set('tgl_pegawai_1_bpkad', date('Y-m-d H:i:s'));
					}
					$this->db->set('status', 'Ditolak');
					$this->db->set('alasan_penolakan', $_POST['alasan_penolakan_ttd']);
					$this->db->where('id_laporan_neraca', $id_laporan_neraca);
					$this->db->update('laporan_neraca');
					$data['message'] = "Surat telah ditolak";
					$data['message_type'] = "danger";
				}
			}

			$data['active_menu'] = "lap_neraca";
			$data['detail']		= $this->lap_neraca_model->get_by_id($id_laporan_neraca);
			$this->load->view('admin/index', $data);
		} else {
			redirect('admin');
		}
	}


	public function edit($id_laporan_neraca)
	{
		if (($this->user_level != "Administrator" && $this->user_level != "Admin Web") && !in_array('keuangan', explode(';', $this->session->userdata('user_privileges')))) redirect('welcome');
		$id_laporan_neraca = decode($id_laporan_neraca);
		if ($this->user_id) {

			$data['title']		= "Keuangan - " . app_name;
			$data['content']	= "keuangan/lap_neraca/edit";
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;

			$data['skpd'] = $this->ref_skpd_model->get_all();
			$data['pegawai_bpkad'] = $this->db->order_by('nama_lengkap','asc')->get_where('pegawai', ['id_skpd' => 25])->result();
			// $data['pegawai_setda'] = $this->db->get_where('pegawai', ['id_skpd' => 1])->result();



			if ($_POST) {

				// do {

					if(isset($_FILES['file_draft']['tmp_name'])){
						$config['upload_path']          = './data/keuangan/tmp/';
						$config['allowed_types']        = 'pdf';

						$input = array();
						$this->load->library('upload', $config);
						if ( ! $this->upload->do_upload('file_draft')){
							$tmp_name = $_FILES['file_draft']['tmp_name'];
							if ($tmp_name!=""){
								$data['message'] = $this->upload->display_errors();
								$data['message_type'] = "danger";
								// echo "1";
								// break;
								
							}
							// echo ".1";
						}else{
							$nama = $this->upload->data('file_name');
							$this->lap_neraca_model->file_draft = $nama;
							if($nama){
								$data['message'] = "File berhasil diupload";
								$data['message_type'] = 'success';
								echo "2";
							}else{

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

				// $this->lap_neraca_model->id_skpd = $_POST['id_skpd'];
				$this->lap_neraca_model->tgl_periode = $_POST['tgl_periode'];
				$this->lap_neraca_model->tgl_pengesahan = $_POST['tgl_pengesahan'];

				$this->lap_neraca_model->asset_lancar_sekarang = $_POST['asset_lancar_sekarang'];
				$this->lap_neraca_model->asset_lancar_awal = $_POST['asset_lancar_awal'];
				$this->lap_neraca_model->asset_lancar_total = $_POST['asset_lancar_total'];
				$this->lap_neraca_model->kas_sekarang = $_POST['kas_sekarang'];
				$this->lap_neraca_model->kas_awal = $_POST['kas_awal'];
				$this->lap_neraca_model->kas_total = $_POST['kas_total'];
				$this->lap_neraca_model->persedian_sekarang = $_POST['persedian_sekarang'];
				$this->lap_neraca_model->persedian_awal = $_POST['persedian_awal'];
				$this->lap_neraca_model->persedian_total = $_POST['persedian_total'];
				$this->lap_neraca_model->dst1_text = $_POST['dst1_text'];
				$this->lap_neraca_model->dst1_sekarang = $_POST['dst1_sekarang'];
				$this->lap_neraca_model->dst1_awal = $_POST['dst1_awal'];
				$this->lap_neraca_model->dst1_total = $_POST['dst1_total'];
				$this->lap_neraca_model->dst2_text = $_POST['dst2_text'];
				$this->lap_neraca_model->dst2_sekarang = $_POST['dst2_sekarang'];
				$this->lap_neraca_model->dst2_awal = $_POST['dst2_awal'];
				$this->lap_neraca_model->dst2_total = $_POST['dst2_total'];
				$this->lap_neraca_model->dst3_text = $_POST['dst3_text'];
				$this->lap_neraca_model->dst3_sekarang = $_POST['dst3_sekarang'];
				$this->lap_neraca_model->dst3_awal = $_POST['dst3_awal'];
				$this->lap_neraca_model->dst3_total = $_POST['dst3_total'];
				$this->lap_neraca_model->dst4_text = $_POST['dst4_text'];
				$this->lap_neraca_model->dst4_sekarang = $_POST['dst4_sekarang'];
				$this->lap_neraca_model->dst4_awal = $_POST['dst4_awal'];
				$this->lap_neraca_model->dst4_total = $_POST['dst4_total'];
				$this->lap_neraca_model->dst5_text = $_POST['dst5_text'];
				$this->lap_neraca_model->dst5_sekarang = $_POST['dst5_sekarang'];
				$this->lap_neraca_model->dst5_awal = $_POST['dst5_awal'];
				$this->lap_neraca_model->dst5_total = $_POST['dst5_total'];
				$this->lap_neraca_model->dst6_text = $_POST['dst6_text'];
				$this->lap_neraca_model->dst6_sekarang = $_POST['dst6_sekarang'];
				$this->lap_neraca_model->dst6_awal = $_POST['dst6_awal'];
				$this->lap_neraca_model->dst6_total = $_POST['dst6_total'];
				$this->lap_neraca_model->dst7_text = $_POST['dst7_text'];
				$this->lap_neraca_model->dst7_sekarang = $_POST['dst7_sekarang'];
				$this->lap_neraca_model->dst7_awal = $_POST['dst7_awal'];
				$this->lap_neraca_model->dst7_total = $_POST['dst7_total'];
				$this->lap_neraca_model->dst8_text = $_POST['dst8_text'];
				$this->lap_neraca_model->dst8_sekarang = $_POST['dst8_sekarang'];
				$this->lap_neraca_model->dst8_awal = $_POST['dst8_awal'];
				$this->lap_neraca_model->dst8_total = $_POST['dst8_total'];
				$this->lap_neraca_model->investasi_jangkapanjang_sekarang = $_POST['investasi_jangkapanjang_sekarang'];
				$this->lap_neraca_model->investasi_jangkapanjang_awal = $_POST['investasi_jangkapanjang_awal'];
				$this->lap_neraca_model->investasi_jangkapanjang_total = $_POST['investasi_jangkapanjang_total'];
				$this->lap_neraca_model->asset_tetap_sekarang = $_POST['asset_tetap_sekarang'];
				$this->lap_neraca_model->asset_tetap_awal = $_POST['asset_tetap_awal'];
				$this->lap_neraca_model->asset_tetap_total = $_POST['asset_tetap_total'];
				$this->lap_neraca_model->tanah_sekarang = $_POST['tanah_sekarang'];
				$this->lap_neraca_model->tanah_awal = $_POST['tanah_awal'];
				$this->lap_neraca_model->tanah_total = $_POST['tanah_total'];
				$this->lap_neraca_model->peralatan_sekarang = $_POST['peralatan_sekarang'];
				$this->lap_neraca_model->peralatan_awal = $_POST['peralatan_awal'];
				$this->lap_neraca_model->peralatan_total = $_POST['peralatan_total'];
				$this->lap_neraca_model->gedung_sekarang = $_POST['gedung_sekarang'];
				$this->lap_neraca_model->gedung_awal = $_POST['gedung_awal'];
				$this->lap_neraca_model->gedung_total = $_POST['gedung_total'];
				$this->lap_neraca_model->jalan_sekarang = $_POST['jalan_sekarang'];
				$this->lap_neraca_model->jalan_awal = $_POST['jalan_awal'];
				$this->lap_neraca_model->jalan_total = $_POST['jalan_total'];
				$this->lap_neraca_model->asset_lainya_sekarang = $_POST['asset_lainya_sekarang'];
				$this->lap_neraca_model->asset_lainya_awal = $_POST['asset_lainya_awal'];
				$this->lap_neraca_model->asset_lainya_total = $_POST['asset_lainya_total'];
				$this->lap_neraca_model->kontruksi_sekarang = $_POST['kontruksi_sekarang'];
				$this->lap_neraca_model->kontruksi_awal = $_POST['kontruksi_awal'];
				$this->lap_neraca_model->kontruksi_total = $_POST['kontruksi_total'];
				$this->lap_neraca_model->akumulasi_sekarang = $_POST['akumulasi_sekarang'];
				$this->lap_neraca_model->akumulasi_awal = $_POST['akumulasi_awal'];
				$this->lap_neraca_model->akumulasi_total = $_POST['akumulasi_total'];
				$this->lap_neraca_model->asset_lain_sekarang = $_POST['asset_lain_sekarang'];
				$this->lap_neraca_model->asset_lain_awal = $_POST['asset_lain_awal'];
				$this->lap_neraca_model->asset_lain_total = $_POST['asset_lain_total'];
				$this->lap_neraca_model->total_asset_sekarang = $_POST['total_asset_sekarang'];
				$this->lap_neraca_model->total_asset_awal = $_POST['total_asset_awal'];
				$this->lap_neraca_model->total_asset = $_POST['total_asset'];
				$this->lap_neraca_model->total_kewajiban_sekarang = $_POST['total_kewajiban_sekarang'];
				$this->lap_neraca_model->total_kewajiban_awal = $_POST['total_kewajiban_awal'];
				$this->lap_neraca_model->total_kewajiban = $_POST['total_kewajiban'];
				$this->lap_neraca_model->kewajiban_pendek_sekarang = $_POST['kewajiban_pendek_sekarang'];
				$this->lap_neraca_model->kewajiban_pendek_awal = $_POST['kewajiban_pendek_awal'];
				$this->lap_neraca_model->kewajiban_pendek_total = $_POST['kewajiban_pendek_total'];
				$this->lap_neraca_model->kewajiban_panjang_sekarang = $_POST['kewajiban_panjang_sekarang'];
				$this->lap_neraca_model->kewajiban_panjang_awal = $_POST['kewajiban_panjang_awal'];
				$this->lap_neraca_model->kewajiban_panjang_total = $_POST['kewajiban_panjang_total'];
				$this->lap_neraca_model->ekuitas_sekarang = $_POST['ekuitas_sekarang'];
				$this->lap_neraca_model->ekuitas_awal = $_POST['ekuitas_awal'];
				$this->lap_neraca_model->ekuitas_total = $_POST['ekuitas_total'];
				$this->lap_neraca_model->total_neraca_sekarang = $_POST['total_neraca_sekarang'];
				$this->lap_neraca_model->total_neraca_awal = $_POST['total_neraca_awal'];
				$this->lap_neraca_model->total_neraca = $_POST['total_neraca'];



				$this->lap_neraca_model->id_pegawai_1_bpkad = $_POST['id_pegawai_1_bpkad'];
				$this->lap_neraca_model->id_pegawai_2_bpkad = $_POST['id_pegawai_2_bpkad'];
				$this->lap_neraca_model->id_pegawai_3_bpkad = $_POST['id_pegawai_3_bpkad'];
				// $this->lap_neraca_model->id_pegawai_4_bpkad = $_POST['id_pegawai_4_bpkad'];
				$this->lap_neraca_model->id_pegawai_1_skpd = $_POST['id_pegawai_1_skpd'];
				$this->lap_neraca_model->id_pegawai_2_skpd = $_POST['id_pegawai_2_skpd'];
				$this->lap_neraca_model->id_pegawai_3_skpd = $_POST['id_pegawai_3_skpd'];
				// $this->lap_neraca_model->id_pegawai_4_skpd = $_POST['id_pegawai_4_skpd'];
				$this->lap_neraca_model->ttd_pegawai_1_bpkad = 'belum';
				$this->lap_neraca_model->ttd_pegawai_2_bpkad = 'belum';
				$this->lap_neraca_model->ttd_pegawai_3_bpkad = 'belum';
				$this->lap_neraca_model->ttd_pegawai_4_bpkad = 'belum';
				$this->lap_neraca_model->ttd_pegawai_1_skpd = 'belum';
				$this->lap_neraca_model->ttd_pegawai_2_skpd = 'belum';
				$this->lap_neraca_model->ttd_pegawai_3_skpd = 'belum';
				$this->lap_neraca_model->ttd_pegawai_4_skpd = 'belum';
				$this->lap_neraca_model->status_verifikasi = 'belum';
				$this->lap_neraca_model->alasan_penolakan = '';
				// $this->lap_neraca_model->file_draft = $_POST['file_draft'];
				// $this->lap_neraca_model->file_signed = $_POST['file_signed'];
				$this->lap_neraca_model->status = 'Proses';


				//tulis script php word disini




				$this->lap_neraca_model->update($id_laporan_neraca);
				$in = $id_laporan_neraca;
				if ($in) {

				$detail =  $this->lap_neraca_model->get_by_id($in);
				$phpWord = new \PhpOffice\PhpWord\PhpWord();
				$phpWord->getCompatibility()->setOoxmlVersion(14);
				$phpWord->getCompatibility()->setOoxmlVersion(15);

				//$template = $detail->file_draft;
				$filename = $detail->nama_skpd . '_Neraca_' . time() . ".docx";
				$filename = str_replace(",", "", $filename);
				$filename = str_replace(" ", "_", $filename);
				$filename = str_replace("/", "_", $filename);
				//$filename = 'tes.docx';	
				$template_path = './data/keuangan/template/Neraca_template.docx';

				$template = $phpWord->loadTemplate($template_path);

				$template->setValue('hari', poee(date('N', strtotime($detail->tgl_pengesahan))));
				$template->setValue('nama_skpd', $detail->nama_skpd);
				$template->setValue('tgl_periode', tanggal($detail->tgl_periode));
				$template->setValue('thn_periode', date('Y', strtotime($detail->tgl_periode)) -1);
				$tgl_pengesahan = terbilang(date('d', strtotime($detail->tgl_pengesahan))) . " bulan " . bulan(date('m', strtotime($detail->tgl_pengesahan))) . " tahun " . terbilang(date('Y', strtotime($detail->tgl_pengesahan)));
				$template->setValue('tgl_pengesahan', $tgl_pengesahan);


				// $template->setValue('total_pendapatan1_lo', dot2_minus($detail->total_pendapatan_lo));
				$template->setValue('asset_lancar_sekarang', dot2_minus($detail->asset_lancar_sekarang));
				$template->setValue('asset_lancar_awal', dot2_minus($detail->asset_lancar_awal));
				$template->setValue('asset_lancar_total', dot2_minus($detail->asset_lancar_total));
				$template->setValue('kas_sekarang', dot2_minus($detail->kas_sekarang));
				$template->setValue('kas_awal', dot2_minus($detail->kas_awal));
				$template->setValue('kas_total', dot2_minus($detail->kas_total));
				$template->setValue('persedian_sekarang', dot2_minus($detail->persedian_sekarang));
				$template->setValue('persedian_awal', dot2_minus($detail->persedian_awal));
				$template->setValue('persedian_total', dot2_minus($detail->persedian_total));
				$template->setValue('investasi_jangkapanjang_sekarang', dot2_minus($detail->investasi_jangkapanjang_sekarang));
				$template->setValue('investasi_jangkapanjang_awal', dot2_minus($detail->investasi_jangkapanjang_awal));
				$template->setValue('investasi_jangkapanjang_total', dot2_minus($detail->investasi_jangkapanjang_total));
				$template->setValue('asset_tetap_sekarang', dot2_minus($detail->asset_tetap_sekarang));
				$template->setValue('asset_tetap_awal', dot2_minus($detail->asset_tetap_awal));
				$template->setValue('asset_tetap_total', dot2_minus($detail->asset_tetap_total));
				$template->setValue('tanah_sekarang', dot2_minus($detail->tanah_sekarang));
				$template->setValue('tanah_awal', dot2_minus($detail->tanah_awal));
				$template->setValue('tanah_total', dot2_minus($detail->tanah_total));
				$template->setValue('peralatan_sekarang', dot2_minus($detail->peralatan_sekarang));
				$template->setValue('peralatan_awal', dot2_minus($detail->peralatan_awal));
				$template->setValue('peralatan_total', dot2_minus($detail->peralatan_total));
				$template->setValue('gedung_sekarang', dot2_minus($detail->gedung_sekarang));
				$template->setValue('gedung_awal', dot2_minus($detail->gedung_awal));
				$template->setValue('gedung_total', dot2_minus($detail->gedung_total));
				$template->setValue('jalan_sekarang', dot2_minus($detail->jalan_sekarang));
				$template->setValue('jalan_awal', dot2_minus($detail->jalan_awal));
				$template->setValue('jalan_total', dot2_minus($detail->jalan_total));
				$template->setValue('asset_lainya_sekarang', dot2_minus($detail->asset_lainya_sekarang));
				$template->setValue('asset_lainya_awal', dot2_minus($detail->asset_lainya_awal));
				$template->setValue('asset_lainya_total', dot2_minus($detail->asset_lainya_total));
				$template->setValue('kontruksi_sekarang', dot2_minus($detail->kontruksi_sekarang));
				$template->setValue('kontruksi_awal', dot2_minus($detail->kontruksi_awal));
				$template->setValue('kontruksi_total', dot2_minus($detail->kontruksi_total));
				$template->setValue('akumulasi_sekarang', dot2_minus($detail->akumulasi_sekarang));
				$template->setValue('akumulasi_awal', dot2_minus($detail->akumulasi_awal));
				$template->setValue('akumulasi_total', dot2_minus($detail->akumulasi_total));
				$template->setValue('asset_lain_sekarang', dot2_minus($detail->asset_lain_sekarang));
				$template->setValue('asset_lain_awal', dot2_minus($detail->asset_lain_awal));
				$template->setValue('asset_lain_total', dot2_minus($detail->asset_lain_total));
				$template->setValue('total_asset_sekarang', dot2_minus($detail->total_asset_sekarang));
				$template->setValue('total_asset_awal', dot2_minus($detail->total_asset_awal));
				$template->setValue('total_asset', dot2_minus($detail->total_asset));
				$template->setValue('total_kewajiban_sekarang', dot2_minus($detail->total_kewajiban_sekarang));
				$template->setValue('total_kewajiban_awal', dot2_minus($detail->total_kewajiban_awal));
				$template->setValue('total_kewajiban', dot2_minus($detail->total_kewajiban));
				$template->setValue('kewajiban_pendek_sekarang', dot2_minus($detail->kewajiban_pendek_sekarang));
				$template->setValue('kewajiban_pendek_awal', dot2_minus($detail->kewajiban_pendek_awal));
				$template->setValue('kewajiban_pendek_total', dot2_minus($detail->kewajiban_pendek_total));
				$template->setValue('kewajiban_panjang_sekarang', dot2_minus($detail->kewajiban_panjang_sekarang));
				$template->setValue('kewajiban_panjang_awal', dot2_minus($detail->kewajiban_panjang_awal));
				$template->setValue('kewajiban_panjang_total', dot2_minus($detail->kewajiban_panjang_total));
				$template->setValue('ekuitas_sekarang', dot2_minus($detail->ekuitas_sekarang));
				$template->setValue('ekuitas_awal', dot2_minus($detail->ekuitas_awal));
				$template->setValue('ekuitas_total', dot2_minus($detail->ekuitas_total));
				$template->setValue('total_neraca_sekarang', dot2_minus($detail->total_neraca_sekarang));
				$template->setValue('total_neraca_awal', dot2_minus($detail->total_neraca_awal));
				$template->setValue('total_neraca', dot2_minus($detail->total_neraca));

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

				$list_dst = array();
				for ($i=1; $i <= 8; $i++) { 
					$dst_text = "dst".$i."_text";

					if ($detail->$dst_text != "") {
						$list_dst[] = $i;
					}
				}

				if (count($list_dst) > 0) {
					$i = 1;
					$template->cloneRow('dst_text', count($list_dst)+1);
					foreach ($list_dst as $ld) {
						$dst_text = "dst".$ld."_text";
	                    $template->setValue('dst_text#'.$i, ascii_to_entities($detail->$dst_text));
						$dst_sekarang = "dst".$ld."_sekarang";
	                    $template->setValue('dst_sekarang#'.$i, dot2_minus($detail->$dst_sekarang));
						$dst_awal = "dst".$ld."_awal";
	                    $template->setValue('dst_awal#'.$i, dot2_minus($detail->$dst_awal));
						$dst_total = "dst".$ld."_total";
	                    $template->setValue('dst_total#'.$i, dot2_minus($detail->$dst_total));
	                    $i++;
					}
					$template->setValue('dst_text#'.$i, "");
					$template->setValue('dst_sekarang#'.$i, "");
					$template->setValue('dst_awal#'.$i, "");
					$template->setValue('dst_total#'.$i, "");
				} else {
					$template->setValue('dst_text', "");
					$template->setValue('dst_sekarang', "");
					$template->setValue('dst_awal', "");
					$template->setValue('dst_total', "");
				}


						
				$template->setValue('subtotal_neraca', rp_minus($detail->total_neraca_sekarang));
				 $terbilang_total_neraca = terbilang_koma_minus($detail->total_neraca_sekarang);
				$template->setValue('terbilang_total_neraca', $terbilang_total_neraca);


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
				// print_r($filename);
				// die();
				unlink("./data/keuangan/tmp/" . $filename);

				$this->db->set('file_signed_draft', $berkas_pdf);
				$this->db->set('tgl_upload', date('Y-m-d H:i:s'));
				$this->db->where('id_laporan_neraca', $in);
				$this->db->update('laporan_neraca');

				$data['message'] = '<b>Sukses</b> Data berhasil ditambahkan';
				$data['message_type'] = 'success';

				redirect(base_url('keuangan/lap_neraca/detail/' . encode($in) . '?msg=' . urlencode($data['message'])));
				} else {

						$data['message'] = 'Terjadi kesalahan';
						$data['message_type'] = 'danger';
						// echo "6";
						// break;
					}
			}

			$data['detail']		= $this->lap_neraca_model->get_by_id($id_laporan_neraca);
			$data['active_menu'] = "neraca";
			$this->load->view('admin/index', $data);
		} else {
			redirect('admin');
		}
	}


	public function delete($id_laporan_neraca)
	{
		if (($this->user_level != "Administrator" && $this->user_level != "Admin Web") && !in_array('keuangan', explode(';', $this->session->userdata('user_privileges')))) redirect('welcome');
		$this->lap_neraca_model->delete($id_laporan_neraca);

		redirect('keuangan/lap_neraca');
	}

	public function reset_ulang($id_laporan_neraca){
		if (($this->user_level != "Administrator" && $this->user_level != "Admin Web") && !in_array('keuangan', explode(';', $this->session->userdata('user_privileges')))) redirect('welcome');
		$id_laporan_neraca = decode($id_laporan_neraca);

			$cek_status_tte = $this->lap_neraca_model->cek_status_tte($id_laporan_neraca);
			if ($cek_status_tte) {

				$this->lap_neraca_model->ttd_pegawai_1_bpkad = 'belum';
				$this->lap_neraca_model->ttd_pegawai_2_bpkad = 'belum';
				$this->lap_neraca_model->ttd_pegawai_3_bpkad = 'belum';
				$this->lap_neraca_model->ttd_pegawai_4_bpkad = 'belum';
				$this->lap_neraca_model->ttd_pegawai_1_skpd = 'belum';
				$this->lap_neraca_model->ttd_pegawai_2_skpd = 'belum';
				$this->lap_neraca_model->ttd_pegawai_3_skpd = 'belum';
				$this->lap_neraca_model->ttd_pegawai_4_skpd = 'belum';
				$this->lap_neraca_model->status_verifikasi = 'belum';
				$this->lap_neraca_model->alasan_penolakan = '';
				$this->lap_neraca_model->status = 'Proses';


				$this->lap_neraca_model->update_reset($id_laporan_neraca);
				$in = $id_laporan_neraca;
				if ($in) {

				$detail =  $this->lap_neraca_model->get_by_id($in);
				$phpWord = new \PhpOffice\PhpWord\PhpWord();
				$phpWord->getCompatibility()->setOoxmlVersion(14);
				$phpWord->getCompatibility()->setOoxmlVersion(15);

				//$template = $detail->file_draft;
				$filename = $detail->nama_skpd . '_Neraca_' . time() . ".docx";
				$filename = str_replace(",", "", $filename);
				$filename = str_replace(" ", "_", $filename);
				$filename = str_replace("/", "_", $filename);
				//$filename = 'tes.docx';	
				$template_path = './data/keuangan/template/Neraca_template.docx';

				$template = $phpWord->loadTemplate($template_path);

				$template->setValue('hari', poee(date('N', strtotime($detail->tgl_pengesahan))));
				$template->setValue('nama_skpd', $detail->nama_skpd);
				$template->setValue('tgl_periode', tanggal($detail->tgl_periode));
				$template->setValue('thn_periode', date('Y', strtotime($detail->tgl_periode)) -1);
				$tgl_pengesahan = terbilang(date('d', strtotime($detail->tgl_pengesahan))) . " bulan " . bulan(date('m', strtotime($detail->tgl_pengesahan))) . " tahun " . terbilang(date('Y', strtotime($detail->tgl_pengesahan)));
				$template->setValue('tgl_pengesahan', $tgl_pengesahan);


				// $template->setValue('total_pendapatan1_lo', dot2_minus($detail->total_pendapatan_lo));
				$template->setValue('asset_lancar_sekarang', dot2_minus($detail->asset_lancar_sekarang));
				$template->setValue('asset_lancar_awal', dot2_minus($detail->asset_lancar_awal));
				$template->setValue('asset_lancar_total', dot2_minus($detail->asset_lancar_total));
				$template->setValue('kas_sekarang', dot2_minus($detail->kas_sekarang));
				$template->setValue('kas_awal', dot2_minus($detail->kas_awal));
				$template->setValue('kas_total', dot2_minus($detail->kas_total));
				$template->setValue('persedian_sekarang', dot2_minus($detail->persedian_sekarang));
				$template->setValue('persedian_awal', dot2_minus($detail->persedian_awal));
				$template->setValue('persedian_total', dot2_minus($detail->persedian_total));
				$template->setValue('investasi_jangkapanjang_sekarang', dot2_minus($detail->investasi_jangkapanjang_sekarang));
				$template->setValue('investasi_jangkapanjang_awal', dot2_minus($detail->investasi_jangkapanjang_awal));
				$template->setValue('investasi_jangkapanjang_total', dot2_minus($detail->investasi_jangkapanjang_total));
				$template->setValue('asset_tetap_sekarang', dot2_minus($detail->asset_tetap_sekarang));
				$template->setValue('asset_tetap_awal', dot2_minus($detail->asset_tetap_awal));
				$template->setValue('asset_tetap_total', dot2_minus($detail->asset_tetap_total));
				$template->setValue('tanah_sekarang', dot2_minus($detail->tanah_sekarang));
				$template->setValue('tanah_awal', dot2_minus($detail->tanah_awal));
				$template->setValue('tanah_total', dot2_minus($detail->tanah_total));
				$template->setValue('peralatan_sekarang', dot2_minus($detail->peralatan_sekarang));
				$template->setValue('peralatan_awal', dot2_minus($detail->peralatan_awal));
				$template->setValue('peralatan_total', dot2_minus($detail->peralatan_total));
				$template->setValue('gedung_sekarang', dot2_minus($detail->gedung_sekarang));
				$template->setValue('gedung_awal', dot2_minus($detail->gedung_awal));
				$template->setValue('gedung_total', dot2_minus($detail->gedung_total));
				$template->setValue('jalan_sekarang', dot2_minus($detail->jalan_sekarang));
				$template->setValue('jalan_awal', dot2_minus($detail->jalan_awal));
				$template->setValue('jalan_total', dot2_minus($detail->jalan_total));
				$template->setValue('asset_lainya_sekarang', dot2_minus($detail->asset_lainya_sekarang));
				$template->setValue('asset_lainya_awal', dot2_minus($detail->asset_lainya_awal));
				$template->setValue('asset_lainya_total', dot2_minus($detail->asset_lainya_total));
				$template->setValue('kontruksi_sekarang', dot2_minus($detail->kontruksi_sekarang));
				$template->setValue('kontruksi_awal', dot2_minus($detail->kontruksi_awal));
				$template->setValue('kontruksi_total', dot2_minus($detail->kontruksi_total));
				$template->setValue('akumulasi_sekarang', dot2_minus($detail->akumulasi_sekarang));
				$template->setValue('akumulasi_awal', dot2_minus($detail->akumulasi_awal));
				$template->setValue('akumulasi_total', dot2_minus($detail->akumulasi_total));
				$template->setValue('asset_lain_sekarang', dot2_minus($detail->asset_lain_sekarang));
				$template->setValue('asset_lain_awal', dot2_minus($detail->asset_lain_awal));
				$template->setValue('asset_lain_total', dot2_minus($detail->asset_lain_total));
				$template->setValue('total_asset_sekarang', dot2_minus($detail->total_asset_sekarang));
				$template->setValue('total_asset_awal', dot2_minus($detail->total_asset_awal));
				$template->setValue('total_asset', dot2_minus($detail->total_asset));
				$template->setValue('total_kewajiban_sekarang', dot2_minus($detail->total_kewajiban_sekarang));
				$template->setValue('total_kewajiban_awal', dot2_minus($detail->total_kewajiban_awal));
				$template->setValue('total_kewajiban', dot2_minus($detail->total_kewajiban));
				$template->setValue('kewajiban_pendek_sekarang', dot2_minus($detail->kewajiban_pendek_sekarang));
				$template->setValue('kewajiban_pendek_awal', dot2_minus($detail->kewajiban_pendek_awal));
				$template->setValue('kewajiban_pendek_total', dot2_minus($detail->kewajiban_pendek_total));
				$template->setValue('kewajiban_panjang_sekarang', dot2_minus($detail->kewajiban_panjang_sekarang));
				$template->setValue('kewajiban_panjang_awal', dot2_minus($detail->kewajiban_panjang_awal));
				$template->setValue('kewajiban_panjang_total', dot2_minus($detail->kewajiban_panjang_total));
				$template->setValue('ekuitas_sekarang', dot2_minus($detail->ekuitas_sekarang));
				$template->setValue('ekuitas_awal', dot2_minus($detail->ekuitas_awal));
				$template->setValue('ekuitas_total', dot2_minus($detail->ekuitas_total));
				$template->setValue('total_neraca_sekarang', dot2_minus($detail->total_neraca_sekarang));
				$template->setValue('total_neraca_awal', dot2_minus($detail->total_neraca_awal));
				$template->setValue('total_neraca', dot2_minus($detail->total_neraca));

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

				$list_dst = array();
				for ($i=1; $i <= 8; $i++) { 
					$dst_text = "dst".$i."_text";

					if ($detail->$dst_text != "") {
						$list_dst[] = $i;
					}
				}

				if (count($list_dst) > 0) {
					$i = 1;
					$template->cloneRow('dst_text', count($list_dst)+1);
					foreach ($list_dst as $ld) {
						$dst_text = "dst".$ld."_text";
	                    $template->setValue('dst_text#'.$i, ascii_to_entities($detail->$dst_text));
						$dst_sekarang = "dst".$ld."_sekarang";
	                    $template->setValue('dst_sekarang#'.$i, dot2_minus($detail->$dst_sekarang));
						$dst_awal = "dst".$ld."_awal";
	                    $template->setValue('dst_awal#'.$i, dot2_minus($detail->$dst_awal));
						$dst_total = "dst".$ld."_total";
	                    $template->setValue('dst_total#'.$i, dot2_minus($detail->$dst_total));
	                    $i++;
					}
					$template->setValue('dst_text#'.$i, "");
					$template->setValue('dst_sekarang#'.$i, "");
					$template->setValue('dst_awal#'.$i, "");
					$template->setValue('dst_total#'.$i, "");
				} else {
					$template->setValue('dst_text', "");
					$template->setValue('dst_sekarang', "");
					$template->setValue('dst_awal', "");
					$template->setValue('dst_total', "");
				}


						
				$template->setValue('subtotal_neraca', rp_minus($detail->total_neraca_sekarang));
				 $terbilang_total_neraca = terbilang_koma_minus($detail->total_neraca_sekarang);
				$template->setValue('terbilang_total_neraca', $terbilang_total_neraca);


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
				// print_r($filename);
				// die();
				unlink("./data/keuangan/tmp/" . $filename);

				$this->db->set('file_signed_draft', $berkas_pdf);
				$this->db->set('tgl_upload', date('Y-m-d H:i:s'));
				$this->db->where('id_laporan_neraca', $in);
				$this->db->update('laporan_neraca');

				$data['message'] = '<b>Sukses</b> Dokumen Berhasil Direset.';
				$data['message_type'] = 'success';

				redirect(base_url('keuangan/lap_neraca/detail/' . encode($in) . '?msg=' . urlencode($data['message'])));
				} else {

						$data['message'] = 'Terjadi kesalahan';
						$data['message_type'] = 'danger';
						// echo "6";
						// break;
					}
			} else {
				$data['message'] = '<b>GAGAL!</b> Dokumen sudah Terbit.';
				redirect(base_url('keuangan/lap_neraca/detail/' . encode($id_laporan_neraca) . '?msg=' . urlencode($data['message'])));
			}
	}

	public function tes()
	{
		// echo "tes"; die();
		var_dump(exec("lowriter --convert-to pdf ./data/keuangan/template/Neraca_template.docx --outdir ./data/keuangan/template/ 2>&1"));
	}
}