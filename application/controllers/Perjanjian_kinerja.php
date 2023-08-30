<?php
include_once(APPPATH."third_party/Common/Autoloader.php");
include_once(APPPATH."third_party/PhpWord/Autoloader.php");
//include_once(APPPATH."core/Front_end.php");

use PhpOffice\Common\Autoloader AS CAutoloader;
use PhpOffice\PhpWord\Autoloader;
use PhpOffice\PhpWord\Settings;
Autoloader::register();
CAutoloader::register();
Settings::loadConfig();

defined('BASEPATH') OR exit('No direct script access allowed');

class Perjanjian_kinerja extends CI_Controller {
	public $user_id;

	public function __construct(){
		parent ::__construct();	
		$this->user_id = $this->session->userdata('user_id');
		$this->load->model('user_model');
		$this->user_model->user_id = $this->user_id;
		$this->user_model->set_user_by_user_id();
		$this->user_picture = $this->user_model->user_picture;
		$this->full_name	= $this->user_model->full_name;
		$this->user_level	= $this->user_model->level;
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
		if ($this->user_level=="Admin Web"); 

		//$this->load->model('Ref_renstra','ref_kode_kegiatan_m');
	}
	public function index()
	{
		if ($this->user_id)
		{
			$data['title']		= "Perjanjian Kinerja - Admin ";
			$data['content']	= "perjanjian_kinerja/index" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "perjanjian_kinerja";

			$this->load->model('ref_rkt_model');
			$this->load->model('ref_unit_kerja_model');
			$this->load->model('berkas_unit_kerja_model');

			if ($this->user_level != "administrator") {
				$this->ref_unit_kerja_model->session_unit_kerja_only = true;
			}
			$data['tahun'] = $this->ref_rkt_model->get_tahun();
			$data['unit_kerja'] = $this->ref_unit_kerja_model->get_all();
			if($this->user_level=='Administrator'){
				if(!empty($_POST)){
					$this->berkas_unit_kerja_model->tahun_berkas = $_POST['tahun_berkas'];
					$this->berkas_unit_kerja_model->id_unit_kerja = $_POST['id_unit_kerja'];
					$this->berkas_unit_kerja_model->nama_lengkap = $_POST['nama_lengkap'];
					$this->berkas_unit_kerja_model->nip = $_POST['nip'];
				//$data['item'] = $this->berkas_unit_kerja_model->get_all_pk_pegawai();
				} else {
				// $data['item'] = $this->berkas_unit_kerja_model->get_all_pk();
				}
			}else{
					$this->berkas_unit_kerja_model->id_unit_kerja = $this->session->userdata('unit_kerja_id');
				if(!empty($_POST)){
					$this->berkas_unit_kerja_model->tahun_berkas = $_POST['tahun_berkas'];
					$this->berkas_unit_kerja_model->nama_lengkap = $_POST['nama_lengkap'];
					$this->berkas_unit_kerja_model->nip = $_POST['nip'];
				//$data['item'] = $this->berkas_unit_kerja_model->get_all_pk_pegawai();
				}
			}
			$data['item'] = $this->berkas_unit_kerja_model->get_all_pk();
			
			$this->load->view('admin/index',$data);


		}
		else
		{
			redirect('admin');
		}
	}


	public function view()
	{
		if ($this->user_id)
		{
			$data['title']		= "Perjanjian Kinerja - Admin ";
			$data['content']	= "perjanjian_kinerja/view" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "perjanjian_kinerja";

			//if(!empty($_POST)){
			//	$this->ref_kode_kegiatan_m->nama_lokasi = $_POST['nama_lokasi'];
			//	$this->ref_kode_kegiatan_m->kode_kegiatan = $_POST['kode_kegiatan'];
			//}
			//$data['item'] = $this->ref_kode_kegiatan_m->get_all();
			$this->load->view('admin/index',$data);


		}
		else
		{
			redirect('admin');
		}
	}


	public function detail()
	{
		if ($this->user_id)
		{
			$data['title']		= "Perjanjian Kinerja - Admin ";
			$data['content']	= "perjanjian_kinerja/detail" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "perjanjian_kinerja";

			//if(!empty($_POST)){
			//	$this->ref_kode_kegiatan_m->nama_lokasi = $_POST['nama_lokasi'];
			//	$this->ref_kode_kegiatan_m->kode_kegiatan = $_POST['kode_kegiatan'];
			//}
			//$data['item'] = $this->ref_kode_kegiatan_m->get_all();
			$this->load->view('admin/index',$data);


		}
		else
		{
			redirect('admin');
		}
	}

	public function add()
	{
		if ($this->user_id)
		{
			$data['title']		= "Tambah Perjanjian Kinerja - Admin ";
			$data['content']	= "perjanjian_kinerja/add" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "perjanjian_kinerja";

			$this->load->model('ref_unit_kerja_model');
			$data['unit_kerja'] = $this->ref_unit_kerja_model->get_all();

			$this->load->model('ref_rkt_model');
			$data['tahun'] = $this->ref_rkt_model->get_tahun();
			//if(!empty($_POST)){
			//	$this->ref_kode_kegiatan_m->nama_lokasi = $_POST['nama_lokasi'];
			//	$this->ref_kode_kegiatan_m->kode_kegiatan = $_POST['kode_kegiatan'];
			//}
			//$data['item'] = $this->ref_kode_kegiatan_m->get_all();
			$this->load->view('admin/index',$data);


		}
		else
		{
			redirect('admin');
		}
	}

	public function add_perjanjian()
	{
		if ($this->user_id)
		{
			$data['title']		= "Perjanjian Kinerja - Admin ";
			$data['content']	= "perjanjian_kinerja/add_perjanjian" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "perjanjian_kinerja";

			//if(!empty($_POST)){
			//	$this->ref_kode_kegiatan_m->nama_lokasi = $_POST['nama_lokasi'];
			//	$this->ref_kode_kegiatan_m->kode_kegiatan = $_POST['kode_kegiatan'];
			//}
			//$data['item'] = $this->ref_kode_kegiatan_m->get_all();
			$this->load->view('admin/index',$data);


		}
		else
		{
			redirect('admin');
		}
	}







	public function update(){
		$id = $this->uri->segment(3);
		if(empty($id)){
			redirect(base_url('ref_kode_kegiatan'));
		}
		$data = $this->input->post();
		$this->ref_kode_kegiatan_m->update($data,$id);
		redirect(base_url('ref_kode_kegiatan'));
	}

	public function delete($id)
	{
		if ($this->user_id)
		{
			$this->ref_kode_kegiatan_m->delete($id);
		}
		else
		{
			redirect('home');
		}
	}

	public function get_jabatan(){
		if(isset($_POST['id_unit'])){
			$id = $_POST['id_unit'];
			$this->load->model('ref_unit_kerja_model');
			$id_induk = $this->ref_unit_kerja_model->get_by_id($id)->id_induk;
			$level_unit_kerja = $this->ref_unit_kerja_model->get_by_id($id)->level_unit_kerja;
			$obj = '<option value="">Pilih Jabatan</option>';
			$this->load->model('ref_jabatan_model');
			$data = $this->ref_jabatan_model->get_all(1,null,$id);
			$data_induk = $this->ref_jabatan_model->get_all(1,null,$id_induk);
			// foreach($data as $row){
			// 	$obj .= "<option value='".$row->id_jabatan."'>$row->nama_jabatan</option>";
			// }
			$obj = array();
			if($data){
				$obj['nama_jabatan'] = $data[0]->nama_jabatan;
				$detail = $this->get_pegawai($data[0]->id_jabatan);
				if (isset($detail->nama_lengkap)) {
					$obj['nama_pegawai'] = $detail->nama_lengkap;
				} else {
					$obj['nama_pegawai'] = '[ERROR]: Belum ada pemegang jabatan.';
				}
			}else{
				$obj['nama_jabatan'] = '[ERROR]: Tidak Ditemukan.';
				$obj['nama_pegawai'] = '[ERROR]: Terjadi Kesalahan.';
			}

			if($data_induk){
				$obj['nama_jabatan_a'] = $data_induk[0]->nama_jabatan;
				$detail_induk = $this->get_pegawai($data_induk[0]->id_jabatan);
				if (isset($detail_induk->nama_lengkap)) {
					$obj['nama_pegawai_a'] = $detail_induk->nama_lengkap;
				} else {
					$obj['nama_pegawai_a'] = '[ERROR]: Belum ada pemegang jabatan.';
				}
			}elseif($level_unit_kerja==0){
				$obj['nama_jabatan_a'] = '';
				$obj['nama_pegawai_a'] = '';
			}else{
				$obj['nama_jabatan_a'] = '[ERROR]: Tidak Ditemukan.';
				$obj['nama_pegawai_a'] = '[ERROR]: Terjadi Kesalahan.';
			}
			echo json_encode($obj);
			//die ($obj);
		}
	}
	public function get_pegawai($id){
		if(isset($_POST['id_jabatan'])){
			$id = $_POST['id_jabatan'];
		}
		$this->load->model('pegawai_model');
		$data = $this->pegawai_model->getPegawaiByJabatan($id);
			// if($data){
			// 	$obj = array('id_pegawai'=>$data->id_pegawai,'nama_pegawai'=>$data->nama_lengkap);
			// }else{
			// 	$obj = array('id_pegawai'=>'0','nama_pegawai'=>'Terjadi Kesalahan');
			// }
		return $data;
		
	}
	public function get_rka($id=null){
		$this->load->model('ref_rka_model');
		$this->ref_rka_model->id_unit_kerja = $id;
		$res = $this->ref_rka_model->get_all();
		if(count($res)==0 OR $id==null){
			echo'
			<tr>
			<td colspan="4"><center>Tidak Ada Data.</center></td>
			</tr>';
		}else{ 
			$total_rka = 0;
			foreach($res as $s){
				echo' <tr>
				<td>'.$s->kode_rka.'</td>
				<td>'.$s->kegiatan_rka.'</td>
				<td>'."Rp".number_format($s->pagu_rka,2,",",".").'</td>
				</tr>
				';
				$total_rka += $s->pagu_rka;
			}
			if ($total_rka>0) {
				$total_rka = "Rp".number_format($total_rka,2,",",".");
				echo "<tr>
				<th colspan='2' align='right'>TOTAL</th>
				<th align='right'>{$total_rka}</th>
				</tr>";
			}
		}
	}
	public function get_sasaran($id=null){
		// $this->load->model('sasaran_strategis_model');
		// $res = $this->sasaran_strategis_model->get_all_data(0,0,$id,0);
		$this->load->model('ref_rkt_model');
		$get_rkt = $this->ref_rkt_model->select_for_id($_POST['id_unit'],$_POST['tahun_rkt']);
		if (isset($get_rkt->id_rkt)) {
			$rkt = $this->ref_rkt_model->select_by_id($get_rkt->id_rkt);

			//print_r($data['rkt']->nama_kegiatan);die;
			$this->load->model('sasaran_strategis_model');
			$this->load->model('sasaran_program_model');
			$this->load->model('sasaran_kegiatan_model');
			$this->load->model('indikator_model');

			$params = array('id_unit' => $rkt->id_unit_kerja, 'tahun' => $rkt->tahun_rkt);
			if($rkt->level_unit_kerja==0){
				$data['sasaran'] = $this->sasaran_strategis_model->getData($params);
			}
			else if($rkt->level_unit_kerja==1){
				$data['sasaran'] = $this->sasaran_program_model->getData($params);
			}
			else {
				$data['sasaran'] = $this->sasaran_kegiatan_model->getData($params);
			}

			if($rkt->level_unit_kerja==0){
				$kode_sasaran = "kode_sasaran_strategis";
				$nama_sasaran = "sasaran_strategis";
				$id_sasaran = "id_sasaran_strategis";
				$type = "SS";
			}
			else if($rkt->level_unit_kerja==1){
				$kode_sasaran = "kode_sasaran_program";
				$nama_sasaran = "sasaran_program";
				$id_sasaran = "id_sasaran_program";
				$type = "SP";
			}
			else{
				$kode_sasaran = "kode_sasaran_kegiatan";
				$nama_sasaran = "sasaran_kegiatan";
				$id_sasaran = "id_sasaran_kegiatan";
				$type="SK";
			}
			

		} else {
			$rkt = array();
		}

		if(count($rkt)==0 OR empty($_POST['id_unit']) OR empty($_POST['tahun_rkt']) OR $id==null){
			echo'
			<tr>
			<td colspan="4"><center>Tidak Ada Data.</center></td>
			</tr>';
		}else{
			foreach($data['sasaran'] as $s){

				if($type=="SS"){
					$editdata = $this->sasaran_strategis_model->get_data_by_id($s->$id_sasaran);
					$data['kode_sasaran'] = $editdata[0]->kode_sasaran_strategis;
					$data['nama_sasaran'] = $editdata[0]->sasaran_strategis;
				}
				else if($type=="SP"){
					$editdata = $this->sasaran_program_model->get_data_by_id($s->$id_sasaran);
					$data['kode_sasaran'] = $editdata[0]->kode_sasaran_program;
					$data['nama_sasaran'] = $editdata[0]->sasaran_program;
				}
				else if($type=="SK"){
					$editdata = $this->sasaran_kegiatan_model->get_data_by_id($s->$id_sasaran);
					$data['kode_sasaran'] = $editdata[0]->kode_sasaran_kegiatan;
					$data['nama_sasaran'] = $editdata[0]->sasaran_kegiatan;
				}
				else{
					$editdata = null;
				}

				if ($editdata!=null) {
					$params = array(
						'id_unit'	=> $editdata[0]->id_unit_kerja,
						'type'		=> $type,
						'id_sasaran' => $s->$id_sasaran
					);
					
					
					$data['indikator'] = $this->indikator_model->getIndikator($params);
				} else {
					$data['indikator'] = array();
				}
				if (count($data['indikator'])>0) {
					foreach ($data['indikator'] as $index => $row) {
						if ($index == 0) {
							echo'<tr>
							<td rowspan="'.count($data['indikator']).'">'.$s->$kode_sasaran.'</td>
							<td rowspan="'.count($data['indikator']).'">'.$s->$nama_sasaran.'</td>
							';
						} else {
							echo'<tr>
							';
						}
						
						if(empty($row->target)){
							$targett = '-';
						}else{
							if (!empty($row->satuan)) {
								$targett = $row->target.' ('.$row->satuan.')';
							} else {
								$targett = $row->target;
							}
						}
						echo'
						<td>'.$row->nama_indikator.'</td>
						<td>'.$targett.'</td>
						</tr>
						';
					}
				} else {
					echo' <tr>
					<td>'.$s->$kode_sasaran.'</td>
					<td>'.$s->$nama_sasaran.'</td>
					<td>-</td>
					<td>-</td>
					</tr>
					';
				}

				
			}
		}
	}

	public function get_pk(){
		if(!empty($_POST['id_unit']) OR !empty($_POST['tahun_rkt'])){
			$this->load->model('berkas_unit_kerja_model');
			$data['id_unit_kerja'] = $_POST['id_unit'];
			$data['tahun_berkas'] = $_POST['tahun_rkt'];
			$taken = $this->berkas_unit_kerja_model->select_row($data);
			if (count($taken)>0) {
				$obj['method'] = "exist";
				$obj['id_berkas'] = $taken->id_berkas;
				$obj['pk'] = $taken->pk;
			} else {
				$obj['method'] = "new";
			}
			echo json_encode($obj);
			//die ($obj);
		}
	}

	public function upload_berkas($id, $col, $id_unit_kerja=null, $tahun_berkas=null)
	{
		if ($this->user_id)
		{
			$this->load->model('berkas_unit_kerja_model');
			$config['upload_path']          = './data/berkas_unit_kerja/';
			$config['allowed_types']        = '*';
			$config['max_size']             = 200000;
			$config['max_width']            = 200000;
			$config['max_height']           = 200000;

			$this->load->library('upload', $config);
			if ( ! $this->upload->do_upload('userfile')){ $_POST[$col] = ""; }
			else { $_POST[$col] = $this->upload->data('file_name'); }

			$_POST['renstra'] = "";
			$_POST['rkt'] = "";
			$_POST['lkj'] = "";

			if ($id == "new") {
				$_POST['id_unit_kerja'] = $id_unit_kerja;
				$_POST['tahun_berkas'] = $tahun_berkas;
				$insert = $this->berkas_unit_kerja_model->insert($_POST);
			} elseif ($id>0) {
				$return = $this->berkas_unit_kerja_model->update($_POST, $id);
			}

			redirect('perjanjian_kinerja');

		}
		else
		{
			redirect('admin');
		}
	}

	public function download_pk($tahun_berkas, $id_unit_kerja){
		if(isset($id_unit_kerja)){
			$id = $id_unit_kerja;
			$this->load->model('ref_unit_kerja_model');
			$id_induk = $this->ref_unit_kerja_model->get_by_id($id)->id_induk;
			$level_unit_kerja = $this->ref_unit_kerja_model->get_by_id($id)->level_unit_kerja;

			$this->load->model('ref_jabatan_model');
			$data = $this->ref_jabatan_model->get_all(null,null,$id);
			$data_induk = $this->ref_jabatan_model->get_all(null,null,$id_induk);
			$obj = array();

			if($data){
				$obj['nama_jabatan'] = $data[0]->nama_jabatan;
				$detail = $this->get_pegawai($data[0]->id_jabatan);
				if (isset($detail->nama_lengkap)) {
					$obj['nama_pegawai'] = $detail->nama_lengkap;
				} else {
					$obj['nama_pegawai'] = 'Belum ada pemegang jabatan.';
				}
			}else{
				$obj['nama_jabatan'] = 'Tidak Ditemukan.';
				$obj['nama_pegawai'] = 'Terjadi Kesalahan.';
			}

			if($data_induk){
				$obj['nama_jabatan_a'] = $data_induk[0]->nama_jabatan;
				$detail_induk = $this->get_pegawai($data_induk[0]->id_jabatan);
				if (isset($detail_induk->nama_lengkap)) {
					$obj['nama_pegawai_a'] = $detail_induk->nama_lengkap;
				} else {
					$obj['nama_pegawai_a'] = 'Belum ada pemegang jabatan.';
				}
			}else{
				$obj['nama_jabatan_a'] = 'Tidak Ditemukan.';
				$obj['nama_pegawai_a'] = 'Terjadi Kesalahan.';
			}
		}

		$this->load->model('ref_rka_model');
		$this->ref_rka_model->id_unit_kerja = $id_unit_kerja;
		$rka = $this->ref_rka_model->get_all();

		$this->load->model('ref_rkt_model');
		$get_rkt = $this->ref_rkt_model->select_for_id($id_unit_kerja,$tahun_berkas);
		if (isset($get_rkt->id_rkt)) {
			$rkt = $this->ref_rkt_model->select_by_id($get_rkt->id_rkt);

			$this->load->model('sasaran_strategis_model');
			$this->load->model('sasaran_program_model');
			$this->load->model('sasaran_kegiatan_model');
			$this->load->model('indikator_model');

			$params = array('id_unit' => $rkt->id_unit_kerja, 'tahun' => $rkt->tahun_rkt);
			if($rkt->level_unit_kerja==0){
				$data['sasaran'] = $this->sasaran_strategis_model->getData($params,$rkt->id_rkt);
			}
			else if($rkt->level_unit_kerja==1){
				$data['sasaran'] = $this->sasaran_program_model->getData($params,$rkt->id_rkt);
			}
			else {
				$data['sasaran'] = $this->sasaran_kegiatan_model->getData($params,$rkt->id_rkt);
			}

			if($rkt->level_unit_kerja==0){
				$kode_sasaran = "kode_sasaran_strategis";
				$nama_sasaran = "sasaran_strategis";
				$id_sasaran = "id_sasaran_strategis";
				$type = "SS";
			}
			else if($rkt->level_unit_kerja==1){
				$kode_sasaran = "kode_sasaran_program";
				$nama_sasaran = "sasaran_program";
				$id_sasaran = "id_sasaran_program";
				$type = "SP";
			}
			else{
				$kode_sasaran = "kode_sasaran_kegiatan";
				$nama_sasaran = "sasaran_kegiatan";
				$id_sasaran = "id_sasaran_kegiatan";
				$type="SK";
			}
			

		} else {
			$rkt = array();
		}

		

		$phpWord = new \PhpOffice\PhpWord\PhpWord();
		$phpWord->getCompatibility()->setOoxmlVersion(14);
		$phpWord->getCompatibility()->setOoxmlVersion(15);

		if ($level_unit_kerja==0) {
			$template_pk = "PK_Kepala.docx";
			$filename = "PK_{$tahun_berkas}_".url_title($obj['nama_jabatan'],'underscore').".docx";
		} else {
			$template_pk = "PK_Sekretaris.docx";
			$filename = "PK_{$tahun_berkas}_".url_title($obj['nama_jabatan'],'underscore')."_".url_title($obj['nama_jabatan_a'],'underscore').".docx";
		}

		$template = $phpWord->loadTemplate("./template/{$template_pk}");
		$targetFile = "./asset/uploads/";

		$bulan = $this->bulan;
		$template->setValue('tanggal_unduh', date('j')." ".$bulan[date('n')]." ".date('Y'));

		$template->setValue('nama_jabatan', $obj['nama_jabatan']);
		$template->setValue('nama_pegawai', $obj['nama_pegawai']);
		$template->setValue('nama_jabatan_a', $obj['nama_jabatan_a']);
		$template->setValue('nama_pegawai_a', $obj['nama_pegawai_a']);

		if (!empty($rka) && count($rka) > 0) {
			$no_rka = 1 ;
			$template->cloneRow('kegiatan_rka', count($rka));
			foreach($rka as $row){
				$template->setValue('no_rka#'.$no_rka, $no_rka.".");
				$template->setValue('kegiatan_rka#'.$no_rka, $row->kegiatan_rka);
				$template->setValue('pagu_rka#'.$no_rka, "Rp".number_format($row->pagu_rka,2,",","."));
				$total_rka += $row->pagu_rka;
				$no_rka++;
			}
			$template->setValue('total_rka', "Rp".number_format($total_rka,2,",","."));
		} else {
			$template->setValue('no_rka', '');
			$template->setValue('kegiatan_rka', 'Tidak ada data.');
			$template->setValue('pagu_rka', '');
			$template->setValue('total_rka', '');
		}
		if (!empty($data['sasaran']) && count($data['sasaran']) > 0) {
			$no_rkt = 1 ;
			$template->cloneRow('nama_sasaran', count($data['sasaran']));
			foreach($data['sasaran'] as $s){
				if($type=="SS"){
					$editdata = $this->sasaran_strategis_model->get_data_by_id($s->$id_sasaran);
					$data['kode_sasaran'] = $editdata[0]->kode_sasaran_strategis;
					$data['nama_sasaran'] = $editdata[0]->sasaran_strategis;
				}
				else if($type=="SP"){
					$editdata = $this->sasaran_program_model->get_data_by_id($s->$id_sasaran);
					$data['kode_sasaran'] = $editdata[0]->kode_sasaran_program;
					$data['nama_sasaran'] = $editdata[0]->sasaran_program;
				}
				else if($type=="SK"){
					$editdata = $this->sasaran_kegiatan_model->get_data_by_id($s->$id_sasaran);
					$data['kode_sasaran'] = $editdata[0]->kode_sasaran_kegiatan;
					$data['nama_sasaran'] = $editdata[0]->sasaran_kegiatan;
				}
				else{
					$editdata = null;
				}

				if ($editdata!=null) {
					$params = array(
						'id_unit'	=> $editdata[0]->id_unit_kerja,
						'type'		=> $type,
						'id_sasaran' => $s->$id_sasaran
					);
					$data['indikator'] = $this->indikator_model->getIndikator($params);
				} else {
					$data['indikator'] = array();
				}
				if (count($data['indikator'])>0) {
					$no_indikator = 1 ;
					$template->cloneRow('nama_indikator#'.$no_rkt, count($data['indikator']));
					foreach ($data['indikator'] as $index => $row) {
						if ($index == 0) {
							$template->setValue('no_rkt#'.$no_rkt."#".$no_indikator, $no_rkt.".");
							$template->setValue('nama_sasaran#'.$no_rkt."#".$no_indikator, $s->$nama_sasaran);
						} else {
							$template->setValue('no_rkt#'.$no_rkt."#".$no_indikator, "");
							$template->setValue('nama_sasaran#'.$no_rkt."#".$no_indikator, "");
						}
						$template->setValue('nama_indikator#'.$no_rkt."#".$no_indikator, $row->nama_indikator);

						if(empty($row->target)){
							$targett = '-';
						}else{
							if (!empty($row->satuan)) {
								$targett = $row->target.' ('.$row->satuan.')';
							} else {
								$targett = $row->target;
							}
						}
						$template->setValue('target_indikator#'.$no_rkt."#".$no_indikator, $targett);
						$no_indikator++;
					}
				} else {
					$template->setValue('no_rkt#'.$no_rkt, $no_rkt.".");
					$template->setValue('nama_sasaran#'.$no_rkt, $s->$nama_sasaran);
					$template->setValue('nama_indikator#'.$no_rkt, "-");
					$template->setValue('target_indikator#'.$no_rkt, "-");
				}
				$no_rkt++;
			}
		} else {
			$template->setValue('no_rkt', '');
			$template->setValue('nama_sasaran', 'Tidak ada data.');
			$template->setValue('nama_indikator', '');
			$template->setValue('target_indikator', '');
		}
		ob_clean();
		$template->saveAs("./data/upload/".$filename);
		header('Content-Description: File Transfer');
		header('Content-Type: application/octet-stream');
		header('Content-Disposition: attachment; filename='.$filename);
		header('Content-Transfer-Encoding: binary');
		header('Expires: 0');
		header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
		header('Pragma: public');
		header('Content-Length: ' . filesize("./data/upload/".$filename));
		flush();
		readfile("./data/upload/".$filename);
		unlink("./data/upload/".$filename);
		exit;
	}

}
?>