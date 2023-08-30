<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kegiatan extends CI_Controller {
	public $user_id;

	public function __construct(){
		parent ::__construct();	
		$this->user_id = $this->session->userdata('user_id');
		// $this->load->model('project_model');
		$this->load->model('user_model');
		// $this->load->model('worksheet_model');
		$this->load->model('kegiatan_model');
		$this->load->model('logs_model');
		$this->load->model('ref_skpd_model');
		$this->load->model('renja_perencanaan_model');
		// $this->project = $this->project_model->get_all();
		$this->user_model->user_id = $this->user_id;
		$this->user_model->set_user_by_user_id();
		$this->user_picture = $this->user_model->user_picture;
		$this->full_name	= $this->user_model->full_name;
		$this->user_level	= $this->user_model->level;
		$this->user_privileges	= $this->user_model->user_privileges;
		$array_privileges = explode(';', $this->user_privileges);

		// if (($this->user_level!="Administrator" && $this->user_level!="Admin Web") && !in_array('project', $array_privileges)) redirect ('welcome');
	}
	
	
	public function index()
	{
		if ($this->user_id)
		{
			$data['title']		= "Public - ". app_name;
			$data['content']	= "kegiatan/index" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			// $data['project'] = $this->project;
			$data['user_level']		= $this->user_level;
			
			if(!empty($_POST)){
				$nama_kegiatan = $_POST['nama_kegiatan'];
				$prioritas = $_POST['prioritas'];
				$this->kegiatan_model->nama_kegiatan = $nama_kegiatan;
				$this->kegiatan_model->prioritas = $prioritas;
			}

			$this->load->model('kegiatan_model');
			$data['query']		= $this->kegiatan_model->get_all();


			$data['active_menu'] = "kegiatan";
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
			$data['title']		= "Public - ". app_name;
			$data['content']	= "project/detail" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['project'] = $this->project;
			$data['user_level']		= $this->user_level;
			//$this->load->model('project_model');
			//$data['query']		= $this->project_model->get_all();
			$data['active_menu'] = "manage_project";
			$this->load->model('pegawai_model');
			$data['employee']		= $this->pegawai_model->get_all();
			$this->load->model('worksheet_model');
			$data['query']		= $this->project_model->get_by_id($this->uri->segment('3'));
			$data['worksheet']	= $this->worksheet_model->get_by_id($this->uri->segment('3'));
			$this->load->view('admin/index',$data);

		}
		else
		{
			redirect('admin');
		}
	}

	function verifikasi($id,$status) {
		if($id!=NULL && $status!=NULL){
			if ($status=="kirim") {
				$config['upload_path']          = './data/project/';
				$config['allowed_types']        = '*';
				$config['max_size']             = 2000;
				$config['max_width']            = 2000;
				$config['max_height']           = 2000;

				$this->load->library('upload', $config);
				if ( ! $this->upload->do_upload('job_file'))
				{
					$_POST['job_file'] = "";
				}
				else
				{
					$_POST['job_file'] = $this->upload->data('file_name');
				}
			} else if ($status=="cancel") {
				unlink('./data/project/'.$this->input->post('old_job_file'));
			}

			$this->load->model('worksheet_model');
			$res = $this->worksheet_model->verifikasi($id,$status);
		}
	}

	public function edit($id_kegiatan){

		if ($this->user_id)
		{
			$this->filter_kegiatan($id_kegiatan);
			$data['title']		= "Public - ". app_name;
			$data['content']	= "kegiatan/edit" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "kegiatan";

			$this->load->model('ref_wilayah_model');
			$data['provinsi'] = $this->ref_wilayah_model->get_provinsi();

			$this->load->model('ref_kode_kegiatan_model');
			$data['kode_kegiatan'] = $this->ref_kode_kegiatan_model->get_all();


			$this->load->model('pegawai_model');
			$data['pegawai'] = $this->pegawai_model->get_registered_u();


			$this->load->model('ref_unit_kerja_model');
			$data['unit_kerja'] = $this->ref_skpd_model->get_unit_kerja_by_id_skpd($this->session->userdata('id_skpd'));
			$id_unit_kerja = $this->session->userdata('id_unit_kerja');

			$jenis = array('ss'=>'Sasaran Strategis','sp'=>'Sasaran Program','sk'=>'Sasaran Kegiatan');
			$data['sasaran'] = '';
			foreach($jenis as $j => $v){
				$name = $this->renja_perencanaan_model->name($j);
				$sasaran = $this->renja_perencanaan_model->get_sasaran($j,$id_unit_kerja,date('Y'));
				$tSasaran = $name['tSasaran'];
				$cSasaran = $name['cSasaran'];
				if(!empty($sasaran)){
					$data['sasaran'] .= '<optgroup label="'.$v.'">';
					foreach($sasaran as $s){
						$data['sasaran'] .= '<option value="'.$j.'_'.$s->$cSasaran.'">'.$s->$tSasaran.'</option>';
					}
					$data['sasaran'] .= "</optgroup>";
				}
			}


			if (!empty($this->input->post()))
			{
				$input = $_POST;
				unset($input['id_unit_kerja']);
				unset($input['id_sasaran']);
				unset($input['id_iku']);
				if(cekForm($input)){

					$data['message_type'] = "danger";
					$data['message']		= "Masih ada form yang kosong.";
				}else{
					$config['upload_path']          = './data/kegiatan/';
					$config['allowed_types']        = 'pdf|xls|xlsx|doc|docx|ppt|pptx|jpg|jpeg|png|gif|txt|zip|rar';
					$this->load->library('upload', $config);

					$file = $_FILES['file']['name'];
					$surat_perintah = $_FILES['surat_perintah']['name'];

					if ($file !== ""){
						$this->upload->do_upload('file');
						$upload_data1 = $this->upload->data();
						$f_file = $upload_data1['file_name'];
						$this->kegiatan_model->file_pendukung= $f_file;
					}else{
						$f_file = ""; 
					}

					if ($surat_perintah !== ""){
						$this->upload->do_upload('surat_perintah');
						$upload_data2 = $this->upload->data();
						$f_surat = $upload_data2['file_name'];
						$this->kegiatan_model->surat_perintah= $f_surat;
					}else{
						$f_surat = ""; 
					}
					$this->kegiatan_model->id_kegiatan= $id_kegiatan;
					$this->kegiatan_model->nama_kegiatan= $this->input->post('nama_kegiatan');
					$this->kegiatan_model->dasar_hukum= $this->input->post('dasar_hukum');
					$this->kegiatan_model->prioritas= $this->input->post('prioritas');
					$this->kegiatan_model->anggaran_kegiatan= $this->input->post('anggaran_kegiatan');
					$this->kegiatan_model->uraian_kegiatan= $this->input->post('uraian_kegiatan');
					$this->kegiatan_model->detail_pekerjaan= $this->input->post('detail_pekerjaan');
					$this->kegiatan_model->status_kegiatan= $this->input->post('status_kegiatan');
					$this->kegiatan_model->id_ketua_tim= $this->input->post('id_ketua_tim');
					$this->kegiatan_model->tgl_mulai_kegiatan= $this->input->post('tgl_mulai_kegiatan');
					$this->kegiatan_model->tgl_akhir_kegiatan= $this->input->post('tgl_akhir_kegiatan');
					$this->kegiatan_model->nama_lokasi= $this->input->post('nama_lokasi');
					$this->kegiatan_model->id_provinsi_kegiatan= $this->input->post('id_provinsi_kegiatan');
					$this->kegiatan_model->id_kabupaten_kegiatan= $this->input->post('id_kabupaten_kegiatan');
					$this->kegiatan_model->id_kecamatan_kegiatan= $this->input->post('id_kecamatan_kegiatan');
					$this->kegiatan_model->id_desa_kegiatan= $this->input->post('id_desa_kegiatan');
					$this->kegiatan_model->id_iku= $this->input->post('id_iku');
					$insert_id = $this->kegiatan_model->update();
					$ii=0;
					$no=1;
					foreach($_POST['uraian_pekerjaan'] as $u){
					// print_r($_POST['id_user'.$no]);
						$id_user =  implode(';', $_POST['id_user'.$no]);
						$this->kegiatan_model->id_kegiatan = $id_kegiatan;
						$this->kegiatan_model->id_pegawai = $id_user;
						$this->kegiatan_model->uraian_pekerjaan = $u;
						$this->kegiatan_model->insert_anggota();
						$no++;
					}

					$data['message_type'] = "success";
					$data['message']		= "Kegiatan berhasil diubah.";
					
				}


			}

			$this->kegiatan_model->id_kegiatan = $id_kegiatan;
			$data['detail'] = $this->kegiatan_model->get_by_id();
			$data['anggota'] = $this->kegiatan_model->get_anggota_tim();
			$data['kabupaten'] = $this->ref_wilayah_model->get_kabupaten($data['detail']->id_kabupaten_kegiatan);
			$data['kecamatan'] = $this->ref_wilayah_model->get_kecamatan($data['detail']->id_kecamatan_kegiatan);
			$data['desa'] = $this->ref_wilayah_model->get_desa($data['detail']->id_desa_kegiatan);

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
			$data['title']		= "Public - ". app_name;
			$data['content']	= "kegiatan/add" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "kegiatan";

			$this->load->model('ref_wilayah_model');
			$data['provinsi'] = $this->ref_wilayah_model->get_provinsi();

			$this->load->model('ref_kode_kegiatan_model');
			$data['kode_kegiatan'] = $this->ref_kode_kegiatan_model->get_all();

			$this->load->model('pegawai_model');
			$data['pegawai'] = $this->pegawai_model->get_registered_u($this->session->userdata('id_skpd'));

			$this->load->model('ref_unit_kerja_model');
			$data['unit_kerja'] = $this->ref_skpd_model->get_unit_kerja_by_id_skpd($this->session->userdata('id_skpd'));
			$id_unit_kerja = $this->session->userdata('id_unit_kerja');

			$jenis = array('ss'=>'Sasaran Strategis','sp'=>'Sasaran Program','sk'=>'Sasaran Kegiatan');
			$data['sasaran'] = '';
			foreach($jenis as $j => $v){
				$name = $this->renja_perencanaan_model->name($j);
				$sasaran = $this->renja_perencanaan_model->get_sasaran($j,$id_unit_kerja,date('Y'));
				$tSasaran = $name['tSasaran'];
				$cSasaran = $name['cSasaran'];
				if(!empty($sasaran)){
					$data['sasaran'] .= '<optgroup label="'.$v.'">';
					foreach($sasaran as $s){
						$data['sasaran'] .= '<option value="'.$j.'_'.$s->$cSasaran.'">'.$s->$tSasaran.'</option>';
					}
					$data['sasaran'] .= "</optgroup>";
				}
			}


			if (!empty($this->input->post()))
			{

				if(!empty($_POST['id_sasaran'])){
					$e = explode('_', $_POST['id_sasaran']);
					$_POST['id_sasaran'] = $e[1];
					$_POST['jenis_sasaran'] = $e[0];
				}
				$input = $_POST;
				unset($input['id_unit_kerja']);
				unset($input['id_sasaran']);
				unset($input['id_iku']);
				unset($input['id_renaksi']);
				if(cekForm($input)){
					$data['message_type'] = "danger";
					$data['message']		= "Masih ada form yang kosong.";
				}else{
					$config['upload_path']          = './data/kegiatan/';
					$config['allowed_types']        = 'pdf|xls|xlsx|doc|docx|ppt|pptx|jpg|jpeg|png|gif|txt|zip|rar';
					$this->load->library('upload', $config);

					$file = $_FILES['file']['name'];
					$surat_perintah = $_FILES['surat_perintah']['name'];

					if ($file !== ""){
						$this->upload->do_upload('file');
						$upload_data1 = $this->upload->data();
						$f_file = $upload_data1['file_name'];
					}else{
						$f_file = ""; 
					}

					if ($surat_perintah !== ""){
						$this->upload->do_upload('surat_perintah');
						$upload_data2 = $this->upload->data();
						$f_surat = $upload_data2['file_name'];
					}else{
						$f_surat = ""; 
					}
					$this->kegiatan_model->nama_kegiatan= $this->input->post('nama_kegiatan');
					$this->kegiatan_model->dasar_hukum= $this->input->post('dasar_hukum');
					$this->kegiatan_model->prioritas= $this->input->post('prioritas');
					$this->kegiatan_model->anggaran_kegiatan= $this->input->post('anggaran_kegiatan');
					$this->kegiatan_model->uraian_kegiatan= $this->input->post('uraian_kegiatan');
					$this->kegiatan_model->file_pendukung= $f_file;
					$this->kegiatan_model->surat_perintah= $f_surat;
					$this->kegiatan_model->detail_pekerjaan= $this->input->post('detail_pekerjaan');
					$this->kegiatan_model->status_kegiatan= $this->input->post('status_kegiatan');
					$this->kegiatan_model->id_ketua_tim= $this->input->post('id_ketua_tim');
					$this->kegiatan_model->tgl_mulai_kegiatan= $this->input->post('tgl_mulai_kegiatan');
					$this->kegiatan_model->tgl_akhir_kegiatan= $this->input->post('tgl_akhir_kegiatan');
					$this->kegiatan_model->nama_lokasi= $this->input->post('nama_lokasi');
					$this->kegiatan_model->id_provinsi_kegiatan= $this->input->post('id_provinsi_kegiatan');
					$this->kegiatan_model->id_kabupaten_kegiatan= $this->input->post('id_kabupaten_kegiatan');
					$this->kegiatan_model->id_kecamatan_kegiatan= $this->input->post('id_kecamatan_kegiatan');
					$this->kegiatan_model->id_desa_kegiatan= $this->input->post('id_desa_kegiatan');
					$this->kegiatan_model->jenis_sasaran_tautan= $this->input->post('jenis_sasaran');
					$this->kegiatan_model->id_unit_kerja_tautan= $this->input->post('id_unit_kerja');
					$this->kegiatan_model->id_sasaran_tautan= $this->input->post('id_sasaran');
					$this->kegiatan_model->id_iku_tautan= $this->input->post('id_iku');
					$this->kegiatan_model->id_renaksi_tautan= $this->input->post('id_renaksi');
					$insert_id = $this->kegiatan_model->insert();
					$ii=0;
					$no=1;

					foreach($_POST['uraian_pekerjaan'] as $u){
					// print_r($_POST['id_user'.$no]);
						$id_user =  implode(';', $_POST['id_user'.$no]);
						$this->kegiatan_model->id_kegiatan = $insert_id;
						$this->kegiatan_model->id_pegawai = $id_user;
						$this->kegiatan_model->uraian_pekerjaan = $u;
						$this->kegiatan_model->insert_anggota();
						$no++;
					}
						// foreach($_POST['id_user'] as $i){
						// 	$id_user = $_POST['id_user'][$ii];
						// 	$uraian_pekerjaan = $_POST['uraian_pekerjaan'][$ii];
						// 	$this->kegiatan_model->id_kegiatan = $insert_id;
						// 	$this->kegiatan_model->id_pegawai = $id_user;
						// 	$this->kegiatan_model->uraian_pekerjaan = $uraian_pekerjaan;
						// 	$this->kegiatan_model->insert_anggota();
						// 	$ii++;
						// }

					$data['message_type'] = "success";
					$data['message']		= "Kegiatan berhasil ditambahkan.";


					$log_data = array(
						'action' => 'membuat',
						'function' => 'kegiatan tim',
						'key_name' => 'nama kegiatan',
						'key_value' => $_POST['nama_kegiatan'] ,
						'category' => $this->uri->segment(1),
					);
					$this->logs_model->insert_log($log_data);



				}


			}
			$this->load->view('admin/index',$data);




		}
		else
		{
			redirect('admin');	
		}

	}



	public function list_worksheet($insert_id)
	{
		if ($this->user_id)
		{
			$data['title']		= "Public - ". app_name;
			$data['content']	= "project/list_worksheet" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['project'] = $this->project;
			$data['user_level']		= $this->user_level;
			$this->load->model('project_model');

			// $this->load->model('services_model');
			// $data['services']		= $this->services_model->get_all();

			// $this->load->model('client_model');
			// $data['client']		= $this->client_model->get_all();

			$this->load->model('pegawai_model');
			$data['employee']		= $this->pegawai_model->get_all();

			$data['active_menu'] = "manage_project";
			if (!empty($this->input->post()))
			{
				$config['upload_path']          = './data/project/';
				$config['allowed_types']        = '*';
				$config['max_size']             = 2000;
				$config['max_width']            = 2000;
				$config['max_height']           = 2000;

				$this->load->library('upload', $config);


				$data_ws = $this->input->post();
				for ($i=$data_ws['jumlah_worksheet']; $i > 0; $i--) { 
					if (!empty($data_ws['worksheet_order'.$i])) {
						if ( ! $this->upload->do_upload('file'.$i)){
							if(!empty($data_ws['old_file'.$i])) {
								$data_ws['file'.$i] = $data_ws['old_file'.$i];
							} else {
								$data_ws['file'.$i] = "";
							}
						} 
						else {
							if(!empty($data_ws['old_file'.$i])) {
								unlink('./data/project/'.$this->input->post('old_file'.$i));
							}
							$data_ws['file'.$i] = $this->upload->data('file_name');
						}
					}
				}
				$this->load->model('worksheet_model');
				$this->worksheet_model->update($data_ws,$insert_id);
							//echo $insert_id;exit();
				redirect('manage_project/detail/'.$insert_id);



			}
			$this->load->model('worksheet_model');
			$data['query']		= $this->project_model->get_by_id($this->uri->segment('3'));
			$data['worksheet']	= $this->worksheet_model->get_by_id($this->uri->segment('3'));
			$this->load->view('admin/index',$data);




		}
		else
		{
			redirect('admin');	
		}

	}

	public function delete($id_kegiatan)
	{
		if ($this->user_id)
		{
			$this->filter_kegiatan($id_kegiatan);
			$this->kegiatan_model->id_kegiatan = $id_kegiatan;
			$this->kegiatan_model->delete();
			redirect('kegiatan');
		}
		else
		{
			redirect('home');
		}
	}

	public function closed($project_id)
	{
		if ($this->user_id)
		{
			$this->project_model->project_id = $project_id;
			$this->project_model->set_by_id();
			if ($this->project_model->project_leader == $this->session->userdata('id_pegawai')) {
				$this->project_model->closed();
			}

			redirect('manage_project/detail/'.$project_id);
		}
		else
		{
			redirect('home');
		}
	}

	public function reopen($project_id)
	{
		if ($this->user_id)
		{
			$this->project_model->project_id = $project_id;
			$this->project_model->set_by_id();
			if ($this->project_model->project_leader == $this->session->userdata('id_pegawai')) {
				$this->project_model->reopen();
			}

			redirect('manage_project/detail/'.$project_id);
		}
		else
		{
			redirect('home');
		}
	}

	public function get_kabupaten($id){
		$obj = '<option value="0">Pilih Kabupaten</option>';
		$this->load->model('ref_wilayah_model');
		$data = $this->ref_wilayah_model->get_kabupaten(null,$id);
		foreach($data as $row){
			$obj .= "<option value='".$row->id_kabupaten."'>$row->kabupaten</option>";
		}
		die ($obj);
	}

	public function get_sasaran($id_unit_kerja){
		echo '<option value="">Pilih Sasaran</option>';
		if(!empty($id_unit_kerja)){
			$jenis = array('ss'=>'Sasaran Strategis','sp'=>'Sasaran Program','sk'=>'Sasaran Kegiatan');
			foreach($jenis as $j => $v){
				$name = $this->renja_perencanaan_model->name($j);
				$sasaran = $this->renja_perencanaan_model->get_sasaran($j,$id_unit_kerja,date('Y'));
				$tSasaran = $name['tSasaran'];
				$cSasaran = $name['cSasaran'];
				if(!empty($sasaran)){
					echo '<optgroup label="'.$v.'">';
					foreach($sasaran as $s){
						echo '<option value="'.$j.'_'.$s->$cSasaran.'">'.$s->$tSasaran.'</option>';
					}
					echo "</optgroup>";
				}
			}
		}

	}
	public function get_iku($id_sasaran,$id_unit_kerja,$jenis){
		echo '<option value="">Pilih IKU</option>';
		if(!empty($id_sasaran)){
		$name = $this->renja_perencanaan_model->name($jenis);
		$iku = $this->renja_perencanaan_model->get_casecade_sasaran_by_unit_kerja($jenis,$id_unit_kerja);
		$cIku = $name['cIku']; 
		$tIku = $name['tIku'];
		foreach($iku as $i){
			echo '<option value="'.$i->$cIku.'">'.$i->$tIku.'</option>';
		}
	}

	}

	public function get_renaksi_by_id_iku($id_iku,$jenis){
		echo '<option value="">Pilih Renaksi</option>';
		if(!empty($id_iku)){
		$name = $this->renja_perencanaan_model->name($jenis);
		$renaksi = $this->renja_perencanaan_model->get_renaksi_by_iku($jenis,$id_iku);
		$cRenaksi = $name['cRenaksi']; 
		$tRenaksi = $name['tRenaksi'];
		foreach($renaksi as $i){
			echo '<option value="'.$i->$cRenaksi.'">'.$i->$tRenaksi.'</option>';
		}
	}
	}
	public function get_kecamatan($id){
		$obj = '<option value="0">Pilih Kecamatan</option>';
		$this->load->model('ref_wilayah_model');
		$data = $this->ref_wilayah_model->get_kecamatan(null,$id);
		foreach($data as $row){
			$obj .= "<option value='".$row->id_kecamatan."'>$row->kecamatan</option>";
		}
		die ($obj);
	}
	public function get_desa($id){
		$obj = '<option value="0">Pilih Desa</option>';
		$this->load->model('ref_wilayah_model');
		$data = $this->ref_wilayah_model->get_desa(null,$id);
		foreach($data as $row){
			$obj .= "<option value='".$row->id_desa."'>$row->desa</option>";
		}
		die ($obj);
	}

	public function filter_kegiatan($id_kegiatan){
		$cek = $this->kegiatan_model->check_privileges($id_kegiatan);
		if(!$cek){
			show_404();
		}
	}
}
?>