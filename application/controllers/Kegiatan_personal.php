<?php
defined('BASEPATH') or exit('No direct script access allowed');

require './vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Kegiatan_personal extends CI_Controller
{
	public $user_id;
	public $id_skpd;


	public function __construct()
	{
		parent::__construct();
		$this->user_id = $this->session->userdata('user_id');
		$this->load->model('user_model');
		$this->load->model('kegiatan_personal_model');
		$this->load->model('logs_model');
		$this->load->model('ref_skpd_model');
		$this->load->model('renja_perencanaan_model');
		$this->load->model('kerja_luar_kantor_model');
		$this->user_model->user_id = $this->user_id;
		$this->user_model->set_user_by_user_id();
		$this->user_picture = $this->user_model->user_picture;
		$this->full_name	= $this->user_model->full_name;
		$this->user_level	= $this->user_model->level;
		$this->id_skpd = $this->user_model->id_skpd;
		$this->id_pegawai = $this->user_model->id_pegawai;
		if ($this->user_level == "Admin Web");

		// $this->load->model('realisasi_kegiatan_model','realisasi_kegiatan_m');
	}
	public function index()
	{
		if ($this->user_id) {
			$data['title']		= "Kegiatan personal - Admin ";
			$data['content']	= "kegiatan_personal/index";
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "kegiatan_personal";
			$data['verifikator_kegiatan'] =  $this->kegiatan_personal_model->get_verifikator_kegiatan($this->id_skpd, $this->id_pegawai);

			$hal = 10;
			$page = isset($_GET["page"]) ? (int) $_GET["page"] : 1;
			$mulai = ($page > 1) ? ($page * $hal) - $hal : 0;
			$total = count($this->kegiatan_personal_model->get_all_by_id($this->id_pegawai));
			$data['pages'] = ceil($total / $hal);
			$data['current'] = $page;
			if (isset($_POST['filter_kegiatan'])) {
				$data['filter'] = true;
				$nama = $_POST['nama_kegiatan_filter'];
				$tgl = $_POST['tgl_filter'];
				$data['nama'] = $_POST['nama_kegiatan_filter'];
				$data['tgl'] = $_POST['tgl_filter'];
			} else {
				$nama = '';
				$tgl = '';
				$data['filter'] = false;
			}

			$data['belum_dikerjakan'] = $this->kegiatan_personal_model->get_belum_dikerjakan($this->id_pegawai, $mulai, $hal, $tgl, $nama);
			$data['menunggu_verifikasi'] = $this->kegiatan_personal_model->get_menunggu_verifikasi($this->id_pegawai, $mulai, $hal, $tgl, $nama);
			$data['selesai_diverifikasi'] = $this->kegiatan_personal_model->get_selesai_diverifikasi($this->id_pegawai, $mulai, $hal, $tgl, $nama);
			$data['daftar_kegiatan'] = $this->kegiatan_personal_model->get_daftar_kegiatan($this->id_pegawai, $mulai, $hal, $tgl, $nama);

			$this->load->model('ref_unit_kerja_model');
			$data['unit_kerja'] = $this->ref_skpd_model->get_unit_kerja_by_id_skpd($this->session->userdata('id_skpd'));
			$id_unit_kerja = $this->session->userdata('id_unit_kerja');

			$jenis = array('ss' => 'Sasaran Strategis', 'sp' => 'Sasaran Program', 'sk' => 'Sasaran Kegiatan');
			$data['sasaran'] = '';
			foreach ($jenis as $j => $v) {
				$name = $this->renja_perencanaan_model->name($j);
				$sasaran = $this->renja_perencanaan_model->get_sasaran($j, $id_unit_kerja, date('Y'));
				$tSasaran = $name['tSasaran'];
				$cSasaran = $name['cSasaran'];
				if (!empty($sasaran)) {
					$data['sasaran'] .= '<optgroup label="' . $v . '">';
					foreach ($sasaran as $s) {
						$data['sasaran'] .= '<option value="' . $j . '_' . $s->$cSasaran . '">' . $s->$tSasaran . '</option>';
					}
					$data['sasaran'] .= "</optgroup>";
				}
			}

			if (isset($_POST['tambah_kegiatan'])) {

				$this->form_validation->set_error_delimiters('<div style="color:red;">', '</div>');
				$this->form_validation->set_rules('nama_kegiatan', 'Nama Kegiatan', 'trim|xss_clean|required');
				$this->form_validation->set_rules('tgl_kegiatan_mulai', 'Tanggal Awal', 'trim|xss_clean|required');
				$this->form_validation->set_rules('tgl_kegiatan_akhir', 'Tanggal Akhir', 'trim|xss_clean|required');
				$this->form_validation->set_rules('deskripsi', 'Deskripsi Kegiatan', 'trim|xss_clean|required');
				$this->form_validation->set_rules('target_kegiatan', 'Target Kegiatan', 'trim|xss_clean|required');
				$this->form_validation->set_rules('id_verifikator', 'Verifikator Kegiatan', 'trim|xss_clean|required');

				if ($this->form_validation->run() == true) {
					$this->kegiatan_personal_model->tambah_kegiatan_personal($this->id_skpd, $this->id_pegawai, $this->user_id);
					echo '<script>javascript:alert("Berhasil! Kegiatan berhasil ditambahkan");window.location = window.location.href;</script>';
				} else {
					echo '<script>javascript:alert("Gagal! Ada kesalahan, silahkan coba lagi");window.location = window.location.href;</script>';
				}
			}

			if (isset($_POST['update_kegiatan'])) {

				$this->form_validation->set_error_delimiters('<div style="color:red;">', '</div>');
				$this->form_validation->set_rules('nama_kegiatan', 'Nama Kegiatan', 'trim|xss_clean|required');
				$this->form_validation->set_rules('tgl_kegiatan_mulai', 'Tanggal Awal', 'trim|xss_clean|required');
				$this->form_validation->set_rules('tgl_kegiatan_akhir', 'Tanggal Akhir', 'trim|xss_clean|required');
				$this->form_validation->set_rules('deskripsi', 'Deskripsi Kegiatan', 'trim|xss_clean|required');
				$this->form_validation->set_rules('target_kegiatan', 'Target Kegiatan', 'trim|xss_clean|required');
				$this->form_validation->set_rules('id_verifikator', 'Verifikator Kegiatan', 'trim|xss_clean|required');

				if ($this->form_validation->run() == true) {
					$this->kegiatan_personal_model->update_kegiatan_personal($this->id_skpd, $this->id_pegawai, $this->input->post('id_kegiatan_personal'), $this->user_id);
					echo '<script>javascript:alert("Berhasil! Kegiatan berhasil diupdate");window.location = window.location.href;</script>';
				} else {
					echo '<script>javascript:alert("Gagal! Ada kesalahan, silahkan coba lagi");window.location = window.location.href;</script>';
				}
			}

			if (isset($_POST['hapus_kegiatan'])) {
				$this->kegiatan_personal_model->hapus_kegiatan_personal($this->input->post('id_kegiatan_personal'));
				echo '<script>javascript:alert("Berhasil! Kegiatan berhasil dihapus");window.location = window.location.href;</script';
			}

			if (isset($_POST['kerjakan_pekerjaan'])) {
				$this->form_validation->set_error_delimiters('<div style="color:red;">', '</div>');
				$this->form_validation->set_rules('deskripsi_hasil', 'Deskripsi Hasil Kegiatan', 'trim|xss_clean|required');
				$this->form_validation->set_rules('lampiran', 'File Lampiran', 'trim|xss_clean');
				$this->form_validation->set_rules('tgl_selesai_kegiatan', 'Tanggal Selesai Kegiatan', 'trim|xss_clean|required');

				if ($this->form_validation->run() == true) {

					$id_keg = $this->input->post('id_kegiatan_personal');
					$this->kegiatan_personal_model->kerjakan_kegiatan_personal($id_keg, $this->id_pegawai, $this->user_id);
					echo '<script>alert("Berhasil! Kegiatan berhasil dikerjakan");window.location = window.location.href;</script>';
				} else {
					echo '<script>javascript:alert("Gagal! Ada kesalahan, silahkan coba lagi");window.location = window.location.href;</script>';
				}
			}

			if (isset($_POST['revisi_pekerjaan'])) {
				$this->form_validation->set_error_delimiters('<div style="color:red;">', '</div>');
				$this->form_validation->set_rules('deskripsi_hasil', 'Deskripsi Hasil Kegiatan', 'trim|xss_clean|required|max_length[300]');
				$this->form_validation->set_rules('lampiran', 'File Lampiran', 'trim|xss_clean');
				$this->form_validation->set_rules('tgl_selesai_kegiatan', 'Tanggal Selesai Kegiatan', 'trim|xss_clean|required');

				if ($this->form_validation->run() == true) {

					$id_keg = $this->input->post('id_kegiatan_personal');
					$this->kegiatan_personal_model->revisi_kegiatan_personal($id_keg, $this->id_pegawai, $this->user_id);
					echo '<script>alert("Berhasil! Kegiatan berhasil direvisi");window.location = window.location.href;</script>';
				} else {
					echo '<script>javascript:alert("Gagal! Ada kesalahan, silahkan coba lagi");window.location = window.location.href;</script>';
				}
			}

			$this->load->model('kerja_luar_kantor_model');
			$data['ref_izin'] = $this->kerja_luar_kantor_model->get_verifered();
			$this->load->model('iki_model');
			$data['iki'] = $this->iki_model->get_sasaran_by_id($this->id_pegawai);
			// print_r($data['ref_izin']);die;
			$this->load->view('admin/index', $data);
		} else {
			redirect('admin');
		}
	}

	public function detail_kegiatan($id_pegawai, $id_kegiatan)
	{
		if ($this->user_id) {
			if (!($id_pegawai)) {
				redirect(base_url('kegiatan_personal'));
			}
			if (!($id_kegiatan)) {
				redirect(base_url('kegiatan_personal'));
			}

			$this->load->model('master_pegawai_model');
			$cek_peg = $this->master_pegawai_model->get_by_id($id_pegawai);

			if ($this->user_level !== "Administrator") {

				if (($cek_peg->id_skpd !== $this->session->userdata('id_skpd') && $this->session->userdata('kepala_skpd') !== "Y")) {
					if ($id_pegawai != $this->id_pegawai) {

						redirect(base_url('kegiatan_personal'));
					}
				}
			}

			$data['title']		= "Detail Kegiatan personal - Admin ";
			$data['content']	= "kegiatan_personal/detail_kegiatan";
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "kegiatan_personal";
			$data['kegiatan'] =  $this->kegiatan_personal_model->get_kegiatan_by_id($id_pegawai, $id_kegiatan);
			$data['logs'] = $this->kegiatan_personal_model->logs($id_kegiatan);

			if ($data['kegiatan'] == false) {
				redirect(base_url('kegiatan_personal'));
			}

			$this->load->view('admin/index', $data);
		} else {
			redirect('admin');
		}
	}

	public function map()
	{
		$this->load->view('admin/map');
	}
	public function listing()
	{
		$this->load->view('admin/kegiatan_personal/listing');
	}
	public function rekap()
	{

		if ($this->user_id) {

			$data['title']		= "Rekap Kegiatan Personal";
			$data['content']	= "kegiatan_personal/rekap";
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "kegiatan_personal";

			$hal = 12;
			$page = isset($_GET["page"]) ? (int) $_GET["page"] : 1;
			$mulai = ($page > 1) ? ($page * $hal) - $hal : 0;
			$total = count($this->kegiatan_personal_model->total_pekerjaan('pegawai'));
			$data['pages'] = ceil($total / $hal);
			$data['current'] = $page;
			$bulan = '';
			$tahun = '';
			$nama = '';
			$data['filter'] = false;
			if (!empty($_POST)) {
				$bulan = isset($_POST['bulan']) ? $_POST['bulan'] : '';
				$tahun = isset($_POST['tahun']) ? $_POST['tahun'] : '';
				$nama = isset($_POST['nama']) ? $_POST['nama'] : '';
				$data['filter'] = true;
			}

			$data['total_pekerjaan'] = count($this->kegiatan_personal_model->total_pekerjaan());
			$data['pekerjaan_selesai'] = count($this->kegiatan_personal_model->total_pekerjaan('selesai'));
			$data['total_pegawai'] = count($this->kegiatan_personal_model->total_pekerjaan('pegawai'));
			$data['pegawai'] = $this->kegiatan_personal_model->get_pekerjaan_pegawai_page($mulai, $hal, $bulan, $tahun, $nama);

			$this->load->view('admin/index', $data);
		} else {
			redirect('admin');
		}
	}

	public function rekap_detail($id_pegawai)
	{

		if ($this->user_id) {

			$data['title']		= "Detail Rekap Kegiatan Personal";
			$data['content']	= "kegiatan_personal/rekap_detail";
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "kegiatan_personal";

			$this->load->model('master_pegawai_model');

			$data['pegawai'] = $this->master_pegawai_model->get_by_id($id_pegawai);
			$data['list_pekerjaan'] = $this->kegiatan_personal_model->list_by_pegawai($id_pegawai);
			$data['total'] = count($this->kegiatan_personal_model->total_by_pegawai($id_pegawai));
			$data['selesai'] = count($this->kegiatan_personal_model->total_by_pegawai($id_pegawai, 'SELESAI DIVERIFIKASI'));
			$data['proses'] = count($this->kegiatan_personal_model->total_by_pegawai($id_pegawai, 'MENUNGGU VERIFIKASI'));
			$data['belum'] = count($this->kegiatan_personal_model->total_by_pegawai($id_pegawai, 'BELUM DIKERJAKAN'));

			$this->load->view('admin/index', $data);
		} else {
			redirect('admin');
		}
	}

	public function download_rekap_catatan_kerja(){
		if(!empty($_POST)){
			$bulan = $_POST['bulan'];
			$tahun = $_POST['tahun'];
		}
	}


	public function kegiatan_json($id_kegiatan_personal)
	{
		echo json_encode($this->kegiatan_personal_model->get_by_id($id_kegiatan_personal));
	}
	public function laporan()
	{

		if ($this->user_id) {

			$data['title']		= "Laporan Kegiatan Personal";
			$data['content']	= "kegiatan_personal/laporan";
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "kegiatan_personal";
			$this->load->model('ref_skpd_model');
			$data['skpd'] = $this->ref_skpd_model->get_all();
			if (!empty($_POST)) {
				$bulan = $_POST['bulan'];
				$tahun = $_POST['tahun'];
				$id_skpd = $_POST['id_skpd'];
				if (!empty($id_skpd)) {
					$data['nama_skpd'] = $this->ref_skpd_model->get_by_id($id_skpd)->nama_skpd;
				}
				$data['list'] = $this->kegiatan_personal_model->get_all_pekerjaan($bulan, $tahun, $id_skpd);
			}

			$this->load->view('admin/index', $data);
		} else {
			redirect('admin');
		}
	}

	public function rekap_ekspor($bulan='', $tahun='', $id_skpd='')
	{
		$this->load->library('pdf');
		$bulan = $bulan==0 ? '' : $bulan;
		$tahun = $tahun==0 ? '' : $tahun;
		$id_skpd = $id_skpd==0 ? '' : $id_skpd;
		$list = $this->kegiatan_personal_model->get_all_pekerjaan($bulan, $tahun, $id_skpd);
		// $nama_skpd = $this->ref_skpd_model->get_by_id($id_skpd)->nama_skpd;
		
		$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		$pdf->setPrintFooter(false);
		$pdf->setPrintHeader(false);
		$pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);
		$pdf->AddPage('L');
		$pdf->Write(0, 'Rekapitulasi Pengisian / Pelaporan', '', 0, 'C', true, 0, false, false, 0);
		$pdf->Write(0, 'Kegiatan Personal pada Aplikasi e-office.sumedangkab.go.id', '', 0, 'C', true, 0, false, false, 0);
		$filename = "Rekapitulasi Kegiatan Personal";
		if($id_skpd!==''){
			$nama_skpd = $this->ref_skpd_model->get_by_id($id_skpd)->nama_skpd;
			$filename .= " SKPD ".$nama_skpd;
			$pdf->Write(0, 'SKPD '.$nama_skpd, '', 0, 'C', true, 0, false, false, 0);
		}
		if($bulan!==''){
			$filename .= " Bulan ".bulan($bulan);
			$pdf->Write(0, 'Bulan '.bulan($bulan), '', 0, 'C', true, 0, false, false, 0);
		}
		if($tahun!==''){
			$filename .= " Tahun ".$tahun;
			$pdf->Write(0, 'Tahun '.$tahun, '', 0, 'C', true, 0, false, false, 0);
		}
		$pdf->SetFont('');

		$tabel = '
		<br><br>
		<table border="1" id="myTable" class="table table-hover color-table primary-table m-b-0 toggle-arrow-tiny dataTable no-footer" role="grid" aria-describedby="myTable_info" style="width: 1261px;">
		<thead>
		<tr>
		  <th width="3%" style="vertical-align: middle;text-align:center" rowspan="2">
		  <span style="line-height:30px"><b>No</b></span>
		  </th>
		  <th width="11%" style="vertical-align: middle;text-align:center;line-height:30px" rowspan="2">
		  <b>NIP</b>
		  </th>
		  <th width="22%" style="vertical-align: middle;text-align:center" rowspan="2">
		  <span style="line-height:30px"><b>Nama</b></span></th>
		  <th width="10%" style="vertical-align: middle;text-align:center" rowspan="2">
		  <span style="line-height:30px"><b>Diusulkan</b></span></th>
		  <th width="30%" colspan="3" style="text-align:center"><b>Proses Verifikasi</b></th>
		</tr>
		<tr>
		  <th width="10%" style="text-align:center"><b>Belum Dikerjakan</b></th>
		  <th width="10%" style="text-align:center"><b>Verifikasi Atasan</b></th>
		  <th width="10%" style="text-align:center"><b>Pekerjaan Selesai</b></th>
		</tr>
	  </thead>
		<tbody>
		';
	
		$no=1;
		foreach($list as $l){
		$tabel .= '
		<tr role="row" class="odd">
			  <td width="3%" style="text-align:center">'.$no.'</td>
			  <td width="11%" >'.$l->nip.'</td>
			  <td width="22%" >'.$l->nama_lengkap.'</td>
			  <td width="10%"   style="text-align:center">'.$l->diusulkan.'</td>
			  <td width="10%"   style="text-align:center">'.$l->belum_dikerjakan.'</td>
			  <td width="10%"   style="text-align:center">'.$l->verifikasi.'</td>
			  <td width="10%"   style="text-align:center">'.$l->selesai.'</td>
			</tr>';
			$no++;
		}

		$tabel .= '
			</tbody>
	  </table>
		';
		$pdf->writeHTML($tabel);
		ob_end_clean();
		$pdf->Output($filename. '.pdf', 'D');
	}
}
