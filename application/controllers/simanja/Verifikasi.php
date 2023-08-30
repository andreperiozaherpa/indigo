<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Verifikasi extends CI_Controller {
	public $user_id;

	public function __construct(){
		parent ::__construct();
		$this->user_id = $this->session->userdata('user_id');
		$this->load->model('user_model');
		$this->load->model('simanja/analisis_jabatan_model', 'daftarAnalisisJabatan');
		$this->load->model('simanja/sender_model', 'sender');
		//Ref
		$this->load->model('simanja/ref_satuan_hasil_model', 'refSatuanHasil');
		$this->load->model('simanja/ref_jabatan_model', 'refJabatan');
		//
		$this->load->model('ref_skpd_model');
		$this->load->model('ref_unit_kerja_model');
		$this->user_model->user_id = $this->user_id;
		$this->user_model->set_user_by_user_id();
		$this->user_picture = $this->user_model->user_picture;
		$this->full_name	= $this->user_model->full_name;
		$this->user_level	= $this->user_model->level;
		$this->id_pegawai	= $this->user_model->id_pegawai;
		$this->user_privileges	= $this->user_model->user_privileges;
		$this->load->library(array('excel','session','pdf'));
		if ($this->user_level=="Admin Web");

		//$this->load->model('Ref_renstra','ref_kode_kegiatan_m');
	}
	
	public function index()
	{
		if ($this->user_id)
		{
			$data['title']		= "Verifikasi ANJAB ABK - Sistem Informasi Anjab ABK dan Evaluasi Jabatan ";
			$data['content']	= "simanja/verifikasi/index" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']	= $this->full_name;
			$data['user_level']	= $this->user_level;
			$data['user_privileges'] = explode(';', $this->user_privileges);
			$data['active_menu'] = "simanja/verifikasi";

			$where = null;
			if(isset($_GET)){
				$where = $_GET;
			}

			$jabatan = $this->master_pegawai_model->get_by_name_jabatan('Kepala sub bagian program');
			$jabatan_id = [];
			$jabatan_no = 0;
			foreach($jabatan as $i){
				$jabatan_id[$jabatan_no] = $i['id_pegawai'];
				$jabatan_no++;
			}

			$admin = 0;
			if($this->session->userdata('level') == 'Administrator' or in_array('admin_simanja', $data['user_privileges'])){
				$admin = 1;
			}

			$data['skpd'] = $this->ref_skpd_model->get_all();
			$data['jabatan'] = $this->refJabatan->get_all_ref();
			$data['list'] = $this->sender->get_all($where, $admin);

			//Counting
			$data['count_list'] = count($data['list']);
			$data['count_terverifikasi'] = $this->sender->count_by_status([2,3], $admin);
			$data['count_belum_terverifikasi'] = $this->sender->count_by_status([1,4,5], $admin);
		
			if (isset($_FILES["fileExcel"]["name"])) {
				$path = $_FILES["fileExcel"]["tmp_name"];
				$object = PHPExcel_IOFactory::load($path);
				foreach($object->getWorksheetIterator() as $worksheet)
				{
					$highestRow = $worksheet->getHighestRow();
					$highestColumn = $worksheet->getHighestColumn();	
					for($row=2; $row<=$highestRow; $row++)
					{
						$nama = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
						$jenis_jabatan = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
						$id_skpd = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
						if($id_skpd != '(not set)'){
							$skpd = $this->ref_skpd_model->get_by_name($id_skpd);
							if($skpd){
								$id_skpd = $skpd->id_skpd;
							}else{
								$id_skpd = null;
							}
						}else{
							$id_skpd = null;
						}
						$temp_data[] = array(
							'nama'	=> $nama,
							'jenis_jabatan'	=> $jenis_jabatan,
							'id_skpd'	=> $id_skpd,
						); 	
					}
				}
				$insert = $this->daftarAnalisisJabatan->insert_excel($temp_data);
				if($insert){
					$this->session->set_flashdata('status', '<span class="glyphicon glyphicon-ok"></span> Data Berhasil di Import ke Database');
					redirect(base_url('simanja/verifikasi'));
				}else{
					$this->session->set_flashdata('status', '<span class="glyphicon glyphicon-remove"></span> Terjadi Kesalahan');
					redirect(base_url('simanja/verifikasi'));
				}
			}


			$this->load->view('admin/index',$data);
		}
		else
		{
			redirect('admin');
		}
	}

	public function detail($id)
	{
		if ($this->user_id && !empty($id))
		{
			$detail = $this->daftarAnalisisJabatan->get_by_id($id);
			$data['title']		= $detail->nama." - Sistem Informasi Anjab ABK dan Evaluasi Jabatan ";
			$data['content']	= "simanja/verifikasi/detail" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']	= $this->full_name;
			$data['user_level']	= $this->user_level;
			$data['active_menu'] = "simanja/verifikasi";

			$data['skpd'] = $this->ref_skpd_model->get_all();
			$data['detail'] = $detail;

			//Ref
			$data['satuan_hasil'] = $this->refSatuanHasil->get_all_ref();

			//Parameter Penilaian
			$params['tugas_pokok'] = $this->daftarAnalisisJabatan->get_all_tugas_pokok($id);
			$params['hasil_kerja'] = $this->daftarAnalisisJabatan->get_all_hasil_kerja($id);

			$nilai = 0;
			$jumlah = 0;
			foreach($params as $i){
				$jumlah += 1;
				if(!empty($i)){
					$nilai += 1;
				}
			}

			$data['params'] = $params;
			$data['nilai'] = $nilai / $jumlah * 100;

			$data = array_merge($data,$params);

			$this->load->view('admin/index',$data);
		}
		else
		{
			redirect('admin');
		}
	}

	public function fetch_unit_kerja($id){
		$unit_kerja = $this->ref_unit_kerja_model->get_by_skpd($id, 1);
		echo json_encode($unit_kerja);
	}

	public function fetch_unit_kerja_induk($id){
		$unit_kerja = $this->ref_unit_kerja_model->get_induk($id);
		echo json_encode($unit_kerja);
	}

	public function fetch_ref($id){
		$sender = $this->sender->select_by_id($id);
		echo json_encode($sender);
	}

	public function p_update_ref(){
		
		$id_ref = $_POST['id_ref'];
		unset($_POST['id_ref']);
		unset($_POST['_wysihtml5_mode']);
		$path = md5(time());
		$sender = $this->sender->select_by_id($id_ref);
		if($sender->status == 2){
			$_POST['path_kabupaten'] = $path;
			$_POST['status'] = 3;
			$_POST['id_verifikator_kabupaten'] = $this->session->userdata('id_pegawai');
			$this->sender->update($_POST,$id_ref);
			if($_POST['id_analisis_jabatan']){
				$dataAnjab = file_get_contents(base_url('simanja/analisis_jabatan/export_bkn_ver1f/'.$_POST['id_analisis_jabatan']));
				$dataAbk = file_get_contents(base_url('simanja/analisis_beban_kerja/export_pdf_ver1f/'.$_POST['id_analisis_jabatan']));
				write_file('./data/simanja/arsip/abk/'.$path.'.pdf', $dataAbk);
			}
		}else{
			$_POST['status'] = 2;
			$_POST['path'] = $path;
			$this->sender->update($_POST,$id_ref);
			if($_POST['id_analisis_jabatan']){
				$dataAnjab = file_get_contents(base_url('simanja/analisis_jabatan/export_bkn/'.$_POST['id_analisis_jabatan']));
				$dataAbk = file_get_contents(base_url('simanja/analisis_beban_kerja/export_pdf/'.$_POST['id_analisis_jabatan']));
			}
		}

		if($dataAnjab){
			write_file('./data/simanja/arsip/'.$path.'.pdf', $dataAnjab);
		}
		echo json_encode(array('status'=>true));
	}

	public function p_tolak_ref($id){
		if ($id) {
			$sender = $this->sender->select_by_id($id);
			if($sender->status == 1){
				$data['status'] = 4;
				$data['tolak'] = $_POST['tolak'];
				$data['verificated_at'] = date('Y-m-d h:i:s');
			}else if($sender->status == 2){
				$data['status'] = 5;
				$data['tolak_kabupaten'] = $_POST['tolak'];
				$data['verificated_kabupaten_at'] = date('Y-m-d h:i:s');
			}
			$this->sender->tolak($id, $data);
			echo json_encode(array('status'=>true));
		}
	}

	public function p_add_ref()
	{
		unset($_POST['_wysihtml5_mode']);
		$this->daftarAnalisisJabatan->insert_ref($_POST);
		echo json_encode(array('status'=>true));
	}

	public function delete_ref($id){
		if ($this->session->userdata('level') == 'Administrator') {
		$this->sender->delete_ref($id);
		echo json_encode(array('status'=>true));
		}
	}
}
?>