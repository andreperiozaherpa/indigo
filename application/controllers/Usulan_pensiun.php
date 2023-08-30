<?php
include_once(APPPATH."third_party/Common/Autoloader.php");
include_once(APPPATH."third_party/PhpWord/Autoloader.php");
//include_once(APPPATH."core/Front_end.php");

use PhpOffice\Common\Autoloader AS CAutoloader;
use PhpOffice\PhpWord\Autoloader;
use PhpOffice\PhpWord\Settings;
use PhpOffice\PhpWord\Shared\Converter;
use PhpOffice\PhpWord\Style\TablePosition;
Autoloader::register();
CAutoloader::register();
Settings::loadConfig();
defined('BASEPATH') OR exit('No direct script access allowed');

class Usulan_pensiun extends CI_Controller {
	public $user_id;
	public function __construct(){
		parent ::__construct();
		$this->user_id = $this->session->userdata('user_id');
		$this->load->model('user_model');
		$this->load->model('usulan_pensiun_model');
		$this->load->model('ref_skpd_model');
		$this->load->model('pegawai_model');
		$this->user_model->user_id = $this->user_id;
		$this->user_model->set_user_by_user_id();
		$this->user_picture = $this->user_model->user_picture;
		$this->full_name	= $this->user_model->full_name;
		$this->user_level	= $this->user_model->level;
		$this->level_id	= $this->user_model->level_id;
		$this->perihal = array('janda_duda'=>'Janda / Duda','aps'=>'Atas Permintaan Sendiri (APS)','bup'=>'Batas Usia Pensiun (BUP)','uzur'=>'Uzur');
	}
	public function index()
	{
		if ($this->user_id)
		{
			$data['title']		= "Prediksi Pensiun - Admin ";
			$data['content']	= "usulan_pensiun/index" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu']		= 'usulan_pensiun';

			$hal = 6;
			$page = isset($_GET["page"]) ? (int)$_GET["page"] : 1;
			$mulai = ($page>1) ? ($page * $hal) - $hal : 0;
			$total = count($this->usulan_pensiun_model->get_all());
			$data['pages'] = ceil($total/$hal);
			$data['current'] = $page;
			if(!empty($_POST)){
				$filter = $_POST;
				$nama = $_POST['nama_lengkap'];
				$skpd = $_POST['id_skpd'];
				$data['filter'] = true;
				$data['filter_data'] = $_POST;
				$data['nama_lengkap'] = $_POST['nama_lengkap'];
				$data['id_skpd'] = $_POST['id_skpd'];
			}else{
				$filter = '';
				$nama = '';
				$skpd = '';
				$data['filter'] = false;
			}
			$data['list'] = $this->usulan_pensiun_model->get_page($mulai,$hal,$nama,$skpd);
			$data['skpd'] = $this->ref_skpd_model->get_all();
			$data['perihal'] = $this->perihal;
			$this->load->view('admin/index',$data);


		}
		else
		{
			redirect('admin');
		}
	}

	public function create($id_pegawai)
	{
		if ($this->user_id)
		{

			$data['title']		= "Input Usulan Pensiun - Admin ";
			$data['content']	= "usulan_pensiun/add" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['active_menu']		= 'usulan_pensiun';
			$data['user_level']		= $this->user_level;
			$data['skpd'] = $this->ref_skpd_model->get_all();
			$data['detail'] = $this->usulan_pensiun_model->get_by_id($id_pegawai);

			if(!empty($_POST)){
				$insert = $_POST;
				$insert['id_pegawai'] = $id_pegawai;
				$in = $this->usulan_pensiun_model->insert($insert);
				$data['message'] = 'Usulan Pensiun Berhasil Ditambahkan';
				$data['type'] = 'success';

			}

			$this->load->view('admin/index',$data);

		}
		else
		{
			redirect('admin');
		}
	}

	public function get_unit_kerja_by_skpd($id_skpd){
		$get = $this->ref_skpd_model->get_unit_kerja_by_id_skpd($id_skpd);
		echo '<option value="0">Pilih Unit Kerja</option>';
		foreach($get as $g){
			echo '<option value="'.$g->id_unit_kerja.'">'.$g->nama_unit_kerja.'</option>';
		}

	}


	public function get_jabatan_by_unit_kerja($id_unit_kerja){
		$get = $this->ref_skpd_model->get_jabatan_by_unit_kerja($id_unit_kerja);
		echo '<option value="0">Pilih Jabatan</option>';
		foreach($get as $g){
			echo '<option value="'.$g->id_jabatan.'">'.$g->nama_jabatan.'</option>';
		}

	}

	public function getFromMaster(){
		$nip_master = $_POST['nip_master'];
		$data = $this->pegawai_model->getFromMaster($nip_master);
		print(json_encode($data));
	}
	public function get_pegawai_for_pengajuan(){
		$nip_baru = $_POST['nip_baru'];
		$data = $this->pegawai_model->get_pegawai_for_pengajuan($nip_baru);
		print(json_encode($data));
	}
	public function view($id_usulan=0)
	{
		if ($this->user_id && !empty($id_usulan) && $id_usulan>0)
		{
			$this->load->model('ref_alasan_pensiun_model');

			$data['title']		= "Detail Prediksi Pensiun - Admin ";
			$data['content']	= "usulan_pensiun/view" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu']		= 'usulan_pensiun';
			$data['detail'] = $this->usulan_pensiun_model->get_by_id($id_usulan);
			$data['skpd'] = $this->ref_skpd_model->get_by_id($data['detail']->id_skpd);
			$data['jabatan'] = $this->ref_skpd_model->get_jabatan_by_id($data['detail']->id_jabatan);
			$data['unit_kerja'] = $this->ref_skpd_model->get_unit_kerja_by_id($data['detail']->id_unit_kerja);

			if(!empty($_FILES)){
				$config['upload_path']          = './data/upload/berkas_persyaratan/';
				$config['allowed_types']        = 'gif|jpg|png|doc|docx|xls|xlsx|zip|rar';
				$config['max_size']             = 2000;
				$config['max_width']            = 2000;
				$config['max_height']           = 2000;
				$config['remove_spaces']           = false;
				$persyaratan = explode(";", $data['detail']->persyaratan);
				$success = true;
				foreach($persyaratan as $p){
					$formName = 'file_'.$p;
					if(isset($_FILES[$formName]['tmp_name'])){
						if(empty($_FILES[$formName]['tmp_name'])){
							$data['message'] = "GAGAL : Masih ada berkas yang kosong";
							$data['type'] = "danger";
							$success = false;
							break;	
						}else{
							$path = $_FILES[$formName]['name'];
							$fileExt = pathinfo($path, PATHINFO_EXTENSION);
							$dp = $this->ref_alasan_pensiun_model->get_persyaratan_by_id($p);
							$reqFileName = $dp->format;
							$reqFileName = str_replace('{$nip}', $data['detail']->nip, $reqFileName);
							$reqFileName = str_replace('{$tahun}', date('Y'), $reqFileName);
							$reqFileName = str_replace('{$jenis}', strtoupper($_POST['jenis_akta']), $reqFileName);
							$reqFileName = str_replace('{$golru}', str_replace("/", " ", $data['detail']->gol), $reqFileName);
							$config['file_name'] = $reqFileName.".".$fileExt;
							$this->load->library('upload', $config);
							$this->upload->initialize($config);
							if ( ! $this->upload->do_upload($formName)){
								$tmp_name = $_FILES[$formName]['tmp_name'];
								if ($tmp_name!=""){
									$data['message'] = $this->upload->display_errors();
									$data['type'] = "danger";
								}
							}else{
								$fileName = $this->upload->data('file_name');
								$ins = array('id_usulan'=>$id_usulan,'id_persyaratan_pensiun'=>$p,'nama_file'=>$fileName);
								$insert = $this->usulan_pensiun_model->insert_berkas($ins);
							}
						}
					}
				}
				if($success){
					$upd = array('status_usulan'=>'pending');
					$update = $this->usulan_pensiun_model->update($upd,$id_usulan);
					$data['message'] = 'Usulan Pensiun telah berhasil diajukan';
					$data['type'] = 'success';
				}

			}
			
			$data['detail'] = $this->usulan_pensiun_model->get_by_id($id_usulan);
			$data['skpd'] = $this->ref_skpd_model->get_by_id($data['detail']->id_skpd);
			$data['jabatan'] = $this->ref_skpd_model->get_jabatan_by_id($data['detail']->id_jabatan);
			$data['unit_kerja'] = $this->ref_skpd_model->get_unit_kerja_by_id($data['detail']->id_unit_kerja);

			$this->load->view('admin/index',$data);

		}
		else
		{
			redirect('admin');
		}
	}

	public function download_pengantar($id_usulan){
		$detail = $this->usulan_pensiun_model->get_by_id($id_usulan);
		$phpWord = new \PhpOffice\PhpWord\PhpWord();
		$phpWord->getCompatibility()->setOoxmlVersion(14);
		$phpWord->getCompatibility()->setOoxmlVersion(15);

		$template = $detail->template_surat;
		$filename = $detail->perihal.'_'.time().".docx";
		$filename = str_replace(",","", $filename);
		$filename = str_replace(" ","_", $filename);
		$filename = str_replace("/","_", $filename);

		$template_path = './template/'.$template;
		$template = $phpWord->loadTemplate($template_path);

		$template->setValue('tgl_pensiun', tanggal($detail->tgl_pensiun));
		$template->setValue('nama', $detail->nama_lengkap);
		$template->setValue('nip', $detail->nip);
		$template->setValue('tgl_lahir', tanggal($detail->tgllahir));
		$template->setValue('gol', $detail->gol);
		$template->setValue('jabatan', $detail->nama_jabatan);
		$template->setValue('nomor_urut', $detail->nomor_urut);
		if($detail->id_alasan_pensiun==1){
			$template->setValue('tgl_meninggal', tanggal($detail->tgl_meninggal));
		}
		$template->setValue('tmt_pensiun', tanggal($detail->tgl_pensiun));
		ob_clean();
		$template->saveAs("./data/usulan_pensiun/".$filename);
		header('Content-Description: File Transfer');
		header('Content-Type: application/octet-stream');
		header('Content-Disposition: attachment; filename='.$filename);
		header('Content-Transfer-Encoding: binary');
		header('Expires: 0');
		header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
		header('Pragma: public');
		header('Content-Length: ' . filesize("./data/usulan_pensiun/".$filename));
		flush();
		readfile("./data/usulan_pensiun/".$filename);
		// unlink("./data/usulan_pensiun/".$filename);
	}

	public function edit($id_pegawai=0)
	{
		if ($this->user_id && !empty($id_pegawai) && $id_pegawai>0)
		{
			$data['title']		= "Edit Pegawai - Admin ";
			$data['content']	= "usulan_pensiun/edit" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['active_menu']		= 'usulan_pensiun';
			$data['user_level']		= $this->user_level;
			$data['skpd'] = $this->ref_skpd_model->get_all();



			if(!empty($_POST)){
				$cek = $_POST;
				if(cekForm($cek)){
					$data['message'] = 'Masih ada form yang kosong';
					$data['type'] = 'warning';
				}else{
					$update = $_POST;
					unset($update['foto_pegawai']);
					$config['upload_path']          = './data/foto/pegawai/';
					$config['allowed_types']        = 'gif|jpg|png';
					$config['max_size']             = 2000;
					$config['max_width']            = 2000;
					$config['max_height']           = 2000;

					if(isset($_FILES['foto_pegawai']['tmp_name'])){
						$this->load->library('upload', $config);
						if ( ! $this->upload->do_upload('foto_pegawai')){
							$tmp_name = $_FILES['foto_pegawai']['tmp_name'];
							if ($tmp_name!=""){
								$data['message'] = $this->upload->display_errors();
								$data['type'] = "danger";
							}
						}else{
							$update['foto_pegawai'] = $this->upload->data('file_name');
						}
					}

					$in = $this->usulan_pensiun_model->update($update,$id_pegawai);
					$data['message'] = 'Pegawai berhasil diubah';
					$data['type'] = 'success';
				}
			}

			$data['detail'] = $this->usulan_pensiun_model->get_by_id($id_pegawai);
			$data['jabatan'] = $this->ref_skpd_model->get_jabatan_by_id($data['detail']->id_jabatan);
			$data['unit_kerja'] = $this->ref_skpd_model->get_unit_kerja_by_id($data['detail']->id_unit_kerja);

			$this->load->view('admin/index',$data);

		}
		else
		{
			redirect('admin');
		}
	}




	public function delete($id)
	{
		if ($this->user_id)
		{
			$this->usulan_pensiun_model->delete($id);
			redirect('usulan_pensiun');
		}
		else
		{
			redirect('home');
		}
	}

	public function reg_account(){
		$this->load->model('user_model');
		$id_pegawai = $_POST['id_pegawai'];

		$this->pegawai_model->id_pegawai = $id_pegawai;
		$detail = $this->pegawai_model->get_by_id();
		$cek_username = $this->user_model->cek_username($_POST['username']);
		$cek_user = $this->pegawai_model->cek_user($id_pegawai);

		if(cekForm($_POST)==TRUE){
			echo json_encode(array("status" => FALSE,"message" => "Masih ada form yang kosong"));
		}elseif($_POST['password']!==$_POST['c_password']){
			echo json_encode(array("status" => FALSE,"message" => "Konfirmasi Password tidak sama"));
		}elseif($cek_username==FALSE){
			echo json_encode(array("status" => FALSE,"message" => "Username sudah terdaftar"));
		}elseif($cek_user){
			echo json_encode(array("status" => FALSE,"message" => "pegawai ini telah didaftarkan"));
		}else{
			$this->user_model->username = $_POST['username'];
			$this->user_model->full_name = $detail->nama_lengkap;
			$this->user_model->password = $_POST['password'];
			$this->user_model->user_picture = 'user_default.png';
			$this->user_model->user_status = 'Active';
			$this->user_model->user_level = 2;
			$this->user_model->id_pegawai = $id_pegawai;
			$this->user_model->user_privileges = '';
			$this->user_model->unit_kerja_id = $detail->id_unit_kerja;
			$insert = $this->user_model->insert();
			$data = array('id_user'=>$insert);
			$update = $this->pegawai_model->update($data,$id_pegawai);
			echo json_encode(array("status" => TRUE));
		}
	}
	public function del_account($id_pegawai){
		$this->load->model('user_model');
		$this->pegawai_model->id_pegawai = $id_pegawai;
		$detail = $this->pegawai_model->get_by_id();
		$this->user_model->user_id = $detail->id_user;
		$this->user_model->delete();
		$data = array('id_user'=>0);
		$update = $this->pegawai_model->update($data,$id_pegawai);
		echo json_encode(array("status" => TRUE));
	}

	public function get_pegawai($nip){
		$url = 'http://124.158.175.50/publik/public/pegawai?key=208c462feb15040fc75fcb951c74e87a7f850f97a7ee933a362edca77f7ab744';
		$content = file_get_contents($url);
		$json = json_decode($content, true);
		$userdb = array(
			array(
				'uid' => '100',
				'name' => 'Sandra Shush',
				'pic_square' => 'urlof100'
			),
			array(
				'uid' => '5465',
				'name' => 'Stefanie Mcmohn',
				'pic_square' => 'urlof100'
			),
			array(
				'uid' => '40489',
				'name' => 'Michael',
				'pic_square' => 'urlof40489'
			)
		);
		$key = array_search($nip, array_column($json, 'nip'));
		if(empty($key)){
			$result = array('result'=>0,'message'=>'Pegawai tidak ditemukan');
		}else{
			$result = $json[$key];
			$result['result'] = 1;
		}
		echo json_encode($result);
	}



}
?>
