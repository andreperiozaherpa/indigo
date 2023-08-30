<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Realisasi_kegiatan_kl extends CI_Controller {
	public $user_id;

	public function __construct(){
		parent ::__construct();	
		$this->user_id = $this->session->userdata('user_id');
		$this->load->model('user_model');
		$this->load->model('realisasi_kegiatan_kl_model');
		$this->load->model('ref_instansi_model');
		$this->load->model('realisasi_kegiatan_kl_notes_model');
		$this->load->model('target_kegiatan_kl_model');
		$this->load->model('realisasi_kegiatan_kl_notes_file_model');
		$this->load->model('ref_wilayah_model');
		$this->load->model('ref_kode_model');
		$this->load->model('ref_satuan_model');
		$this->user_model->user_id = $this->user_id;
		$this->user_model->set_user_by_user_id();
		$this->user_picture = $this->user_model->user_picture;
		$this->full_name	= $this->user_model->full_name;
		$this->user_level	= $this->user_model->level;
		$this->instansi_level	= $this->user_model->instansi_level;
		$this->instansi_id	= $this->user_model->instansi_id;
		$this->user_privileges	= $this->user_model->user_privileges;
		$array_privileges = explode(';', $this->user_privileges);

		if (($this->user_level!="Administrator" && $this->user_level!="User" && $this->user_level!="Departement") && !in_array('mn_kegiatan', $array_privileges)) redirect ('welcome');
	}
	public function index()
	{
		if ($this->user_id)
		{
			$data['title']		= "Realisasi Kegiatan KL - ". app_name;
			$data['content']	= "realisasi_kegiatan_kl/index" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "realisasi_kegiatan_kl";

			$data['data'] = $this->realisasi_kegiatan_kl_model->get_all($this->user_id,$this->user_level);

			$this->load->view('admin/index',$data);

		}
		else
		{
			redirect('admin');
		}
	}
	public function detail($id_realisasi_kegiatan_kl)
	{
		if ($this->user_id)
		{
			$data['title']		= "Detail Realisasi Kegiatan KL - ". app_name;
			$data['content']	= "realisasi_kegiatan_kl/detail" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "realisasi_kegiatan_kl";
			$data['instansi_level'] = $this->instansi_level;
			$data['instansi_id'] = $this->instansi_id;

			$this->load->model('target_kegiatan_kl_model');
			if(!empty($_POST)){
				$nama_notes = $_POST['nama_notes'];
				$keterangan_notes = $_POST['keterangan_notes'];
				$id_user = $this->user_id;

				if(isset($_POST['save'])){
					$this->realisasi_kegiatan_kl_notes_model->id_realisasi_kegiatan_kl = $id_realisasi_kegiatan_kl;
					$this->realisasi_kegiatan_kl_notes_model->nama_notes = $nama_notes;
					$this->realisasi_kegiatan_kl_notes_model->keterangan_notes = $keterangan_notes;
					$this->realisasi_kegiatan_kl_notes_model->id_user = $id_user;
					$insert = $this->realisasi_kegiatan_kl_notes_model->insert();
				}elseif(isset($_POST['edit'])){
					$this->realisasi_kegiatan_kl_notes_model->id_realisasi_kegiatan_kl_notes = $_POST['id_realisasi_kegiatan_kl_notes'];
					$this->realisasi_kegiatan_kl_notes_model->nama_notes = $nama_notes;
					$this->realisasi_kegiatan_kl_notes_model->keterangan_notes = $keterangan_notes;
					$this->realisasi_kegiatan_kl_notes_model->update();
					$insert = $_POST['id_realisasi_kegiatan_kl_notes'];
				}
				if($_FILES['files']['name'] !== ""){
					$filesCount = count($_FILES['files']['name']);
					for($i = 0; $i < $filesCount; $i++){
						$_FILES['file']['name']     = $_FILES['files']['name'][$i];
						$_FILES['file']['type']     = $_FILES['files']['type'][$i];
						$_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
						$_FILES['file']['error']     = $_FILES['files']['error'][$i];
						$_FILES['file']['size']     = $_FILES['files']['size'][$i];
						
		                // File upload configuration
						$config['upload_path'] = './data/images/data_pendukung_kegiatan/';
						$config['allowed_types'] = 'jpg|jpeg|png|gif|ppt|pptx|doc|docx|xls|xlsx|pdf';

						$old_name = $_FILES['file']['name'];
						$a = explode('.', $_FILES['file']['name']);

						if(isset($a[0]) && isset($a[1])){
							$new_name = md5($a[0]).'.'.$a[1];
						}else{
							$new_name = 0;
						}
		                // $new_name = 'as.png';

						$config['file_name'] = $new_name;
						


		                // Load and initialize upload library
						$this->load->library('upload', $config);
						$this->upload->initialize($config);
						
		                // Upload file to server
						if($this->upload->do_upload('file')){
		                    // Uploaded file data
							$fileData = $this->upload->data();
							$uploadData[$i]['file_hash'] =$fileData['file_name'];
							$uploadData[$i]['file_name'] = $old_name;
							$uploadData[$i]['file_ext'] = $fileData['file_ext'];
							$uploadData[$i]['file_type'] = $fileData['file_type'];
						}
					}
					
					if(!empty($uploadData)){
						foreach($uploadData as $u){
							$this->realisasi_kegiatan_kl_notes_file_model->id_realisasi_kegiatan_kl_notes = $insert;
							$this->realisasi_kegiatan_kl_notes_file_model->file_hash = $u['file_hash'];
							$this->realisasi_kegiatan_kl_notes_file_model->file_name = $u['file_name'];
							$this->realisasi_kegiatan_kl_notes_file_model->file_ext = $u['file_ext'];
							$this->realisasi_kegiatan_kl_notes_file_model->file_type = $u['file_type'];
							$this->realisasi_kegiatan_kl_notes_file_model->insert();
						}
					}
				}

			}

			$this->realisasi_kegiatan_kl_model->id_realisasi_kegiatan_kl = $id_realisasi_kegiatan_kl;
			$data['detail'] = $this->realisasi_kegiatan_kl_model->get_by_id();
			$data['notes'] = $this->realisasi_kegiatan_kl_notes_model->get_all();

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
			
			$data['title']		= "Tambah Realisasi Kegiatan KL - ". app_name;
			$data['content']	= "realisasi_kegiatan_kl/add" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "realisasi_kegiatan_kl";
			$data['instansi_level'] = $this->instansi_level;
			$data['instansi_id'] = $this->instansi_id;

			if (!empty($_POST)){
				if ((
					$_POST['tahun_realisasi_kegiatan_kl'] !="" &&
					$_POST['id_target_kegiatan_kl'] !="" &&
					$_POST['id_koordinator'] !="" &&
					$_POST['jumlah_anggaran'] !="" &&
					$_POST['tanggal_awal'] !="" &&
					$_POST['tanggal_akhir'] !="" &&
					$_POST['volume'] !="" &&
					$_POST['id_satuan'] !=""
				))
				{
					$tahun_realisasi_kegiatan_kl = $_POST['tahun_realisasi_kegiatan_kl'];
					$id_sub_koordinator = $_POST['id_sub_koordinator'];
					$id_target_kegiatan_kl = $_POST['id_target_kegiatan_kl'];
					$id_koordinator = $_POST['id_koordinator'];
					$triwulan = $_POST['triwulan'];
					$tanggal_awal = $_POST['tanggal_awal'];
					$tanggal_akhir = $_POST['tanggal_akhir'];
					$jumlah_anggaran = $_POST['jumlah_anggaran'];
					$id_provinsi_realisasi = $_POST['id_provinsi_realisasi'];
					$id_kabupaten_realisasi = $_POST['id_kabupaten_realisasi'];
					$id_kecamatan_realisasi = $_POST['id_kecamatan_realisasi'];
					$id_desa_realisasi = $_POST['id_desa_realisasi'];
					$tempat_realisasi = $_POST['tempat_realisasi'];
					$volume = $_POST['volume'];
					$id_satuan = $_POST['id_satuan'];
					$keterangan_realisasi = $_POST['keterangan_realisasi'];
					$id_user = $this->user_id;

					$this->realisasi_kegiatan_kl_model->tahun_realisasi_kegiatan_kl = $tahun_realisasi_kegiatan_kl;
					$this->realisasi_kegiatan_kl_model->id_target_kegiatan_kl = $id_target_kegiatan_kl;
					$this->realisasi_kegiatan_kl_model->id_koordinator = $id_koordinator;
					$this->realisasi_kegiatan_kl_model->id_sub_koordinator = $id_sub_koordinator;
					$this->realisasi_kegiatan_kl_model->triwulan = $triwulan;
					$this->realisasi_kegiatan_kl_model->tanggal_awal = $tanggal_awal;
					$this->realisasi_kegiatan_kl_model->tanggal_akhir = $tanggal_akhir;
					$this->realisasi_kegiatan_kl_model->jumlah_anggaran = $jumlah_anggaran;
					$this->realisasi_kegiatan_kl_model->id_provinsi_realisasi = $id_provinsi_realisasi;
					$this->realisasi_kegiatan_kl_model->id_kabupaten_realisasi = $id_kabupaten_realisasi;
					$this->realisasi_kegiatan_kl_model->id_kecamatan_realisasi = $id_kecamatan_realisasi;
					$this->realisasi_kegiatan_kl_model->id_desa_realisasi = $id_desa_realisasi;
					$this->realisasi_kegiatan_kl_model->tempat_realisasi = $tempat_realisasi;
					$this->realisasi_kegiatan_kl_model->keterangan_realisasi = $keterangan_realisasi;
					$this->realisasi_kegiatan_kl_model->volume = $volume;
					$this->realisasi_kegiatan_kl_model->id_satuan = $id_satuan;
					$this->realisasi_kegiatan_kl_model->id_user = $id_user;
					$insert = $this->realisasi_kegiatan_kl_model->insert();
					$data['message_type'] = "success";
					$data['message']		= "Realisasi Kegiatan berhasil ditambahkan.";
				}else{
					$data['message_type'] = "warning";
					$data['message'] = "<strong>Opps..</strong> Masih ada data yang kosong. silahkan lengkapi terlebih dahulu!";

				}
			}

			$data['instansi'] = $this->ref_instansi_model->get_all();
			$data['koordinator'] = $this->ref_instansi_model->get_koordinator();
			$data['provinsi'] = $this->ref_wilayah_model->get_provinsi();
			$data['kode'] = $this->ref_kode_model->get_all();
			$data['satuan'] = $this->ref_satuan_model->get_all();
			$data['instansi_level'] = $this->instansi_level;
			if($this->instansi_level=='koordinator'){
				$data['id_koordinator'] = $this->instansi_id;
				$data['sub_koordinator'] = $this->ref_instansi_model->get_lembaga($this->instansi_id);
			}elseif($this->instansi_level=='lembaga'){
				$this->ref_instansi_model->id_instansi = $this->instansi_id;
				$a = $this->ref_instansi_model->get_by_id();
				$data['id_koordinator'] = $a->id_koordinator;
				$data['id_sub_koordinator'] = $this->instansi_id;
			}
			
			$this->load->model('target_kegiatan_kl_model');
			$data['kegiatan'] = $this->target_kegiatan_kl_model->get_all();

			$this->load->view('admin/index',$data);

		}
		else
		{
			redirect('admin');
		}
	}

	public function edit($id_realisasi_kegiatan_kl)
	{
		if ($this->user_id)
		{
			
			$data['title']		= "Edit Realisasi Kegiatan KL - ". app_name;
			$data['content']	= "realisasi_kegiatan_kl/edit" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "realisasi_kegiatan_kl";
			$data['instansi_level'] = $this->instansi_level;
			$data['instansi_id'] = $this->instansi_id;

			if (!empty($_POST)){
				if ((
					$_POST['tahun_realisasi_kegiatan_kl'] !="" &&
					$_POST['id_target_kegiatan_kl'] !="" &&
					$_POST['id_koordinator'] !="" &&
					$_POST['jumlah_anggaran'] !="" &&
					$_POST['tanggal_awal'] !="" &&
					$_POST['tanggal_akhir'] !="" &&
					$_POST['volume'] !="" &&
					$_POST['id_satuan'] !=""
				))
				{
					$tahun_realisasi_kegiatan_kl = $_POST['tahun_realisasi_kegiatan_kl'];
					$id_sub_koordinator = $_POST['id_sub_koordinator'];
					$id_target_kegiatan_kl = $_POST['id_target_kegiatan_kl'];
					$id_koordinator = $_POST['id_koordinator'];
					$triwulan = $_POST['triwulan'];
					$tanggal_awal = $_POST['tanggal_awal'];
					$tanggal_akhir = $_POST['tanggal_akhir'];
					$jumlah_anggaran = $_POST['jumlah_anggaran'];
					$id_provinsi_realisasi = $_POST['id_provinsi_realisasi'];
					$id_kabupaten_realisasi = $_POST['id_kabupaten_realisasi'];
					$id_kecamatan_realisasi = $_POST['id_kecamatan_realisasi'];
					$id_desa_realisasi = $_POST['id_desa_realisasi'];
					$tempat_realisasi = $_POST['tempat_realisasi'];
					$volume = $_POST['volume'];
					$id_satuan = $_POST['id_satuan'];
					$keterangan_realisasi = $_POST['keterangan_realisasi'];

					$this->realisasi_kegiatan_kl_model->id_realisasi_kegiatan_kl = $id_realisasi_kegiatan_kl;

					$this->realisasi_kegiatan_kl_model->tahun_realisasi_kegiatan_kl = $tahun_realisasi_kegiatan_kl;
					$this->realisasi_kegiatan_kl_model->id_target_kegiatan_kl = $id_target_kegiatan_kl;
					$this->realisasi_kegiatan_kl_model->id_koordinator = $id_koordinator;
					$this->realisasi_kegiatan_kl_model->id_sub_koordinator = $id_sub_koordinator;
					$this->realisasi_kegiatan_kl_model->triwulan = $triwulan;
					$this->realisasi_kegiatan_kl_model->tanggal_awal = $tanggal_awal;
					$this->realisasi_kegiatan_kl_model->tanggal_akhir = $tanggal_akhir;
					$this->realisasi_kegiatan_kl_model->jumlah_anggaran = $jumlah_anggaran;
					$this->realisasi_kegiatan_kl_model->id_provinsi_realisasi = $id_provinsi_realisasi;
					$this->realisasi_kegiatan_kl_model->id_kabupaten_realisasi = $id_kabupaten_realisasi;
					$this->realisasi_kegiatan_kl_model->id_kecamatan_realisasi = $id_kecamatan_realisasi;
					$this->realisasi_kegiatan_kl_model->id_desa_realisasi = $id_desa_realisasi;
					$this->realisasi_kegiatan_kl_model->tempat_realisasi = $tempat_realisasi;
					$this->realisasi_kegiatan_kl_model->volume = $volume;
					$this->realisasi_kegiatan_kl_model->keterangan_realisasi = $keterangan_realisasi;
					$this->realisasi_kegiatan_kl_model->id_satuan = $id_satuan;
					$this->realisasi_kegiatan_kl_model->id_user = $id_user;
					$insert = $this->realisasi_kegiatan_kl_model->update();
					$data['message_type'] = "success";
					$data['message']		= "realisasi Kegiatan berhasil diubah.";
				}else{
					$data['message_type'] = "warning";
					$data['message'] = "<strong>Opps..</strong> Masih ada data yang kosong. silahkan lengkapi terlebih dahulu!";

				}
			}

			$this->realisasi_kegiatan_kl_model->id_realisasi_kegiatan_kl = $id_realisasi_kegiatan_kl;
			$data['detail'] = $this->realisasi_kegiatan_kl_model->get_by_id();
			$data['koordinator'] = $this->ref_instansi_model->get_koordinator();
			$data['lembaga'] = $this->ref_instansi_model->get_lembaga($data['detail']->id_koordinator);

			$data['provinsi'] = $this->ref_wilayah_model->get_provinsi();
			$data['kabupaten'] = $this->ref_wilayah_model->get_kabupaten($data['detail']->id_kabupaten_realisasi);
			$data['kecamatan'] = $this->ref_wilayah_model->get_kecamatan($data['detail']->id_kecamatan_realisasi);
			$data['desa'] = $this->ref_wilayah_model->get_desa($data['detail']->id_desa_realisasi);
			$data['satuan'] = $this->ref_satuan_model->get_all();
			
			$data['instansi_level'] = $this->instansi_level;
			if($this->instansi_level=='koordinator'){
				$data['id_koordinator'] = $this->instansi_id;
				$data['sub_koordinator'] = $this->ref_instansi_model->get_lembaga($this->instansi_id);
			}elseif($this->instansi_level=='lembaga'){
				$this->ref_instansi_model->id_instansi = $this->instansi_id;
				$a = $this->ref_instansi_model->get_by_id();
				$data['id_koordinator'] = $a->id_koordinator;
				$data['id_sub_koordinator'] = $this->instansi_id;
			}
			
			
			$this->load->model('target_kegiatan_kl_model');
			$data['kegiatan'] = $this->target_kegiatan_kl_model->get_all();

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
			
			$this->realisasi_kegiatan_kl_model->id_realisasi_kegiatan_kl = $id;
			$this->realisasi_kegiatan_kl_model->delete();
			redirect('realisasi_kegiatan_kl');
		}
		else
		{
			redirect('home');
		}
	}

	public function delete_notes($id,$id_realisasi)
	{
		if ($this->user_id)
		{
			
			$this->realisasi_kegiatan_kl_notes_model->id_realisasi_kegiatan_kl_notes = $id;
			$this->realisasi_kegiatan_kl_notes_model->delete();
			redirect('realisasi_kegiatan_kl/detail/'.$id_realisasi.'');
		}
		else
		{
			redirect('home');
		}
	}

	public function get_lembaga(){
		if(!empty($_POST)){
			$id_koordinator = $_POST['id_koordinator'];
			$get = $this->ref_instansi_model->get_lembaga($id_koordinator);
			echo'<option value="">Pilih Instansi</option>';
			foreach($get as $g){
				echo'<option value="'.$g->id_instansi.'">'.$g->nama_instansi.'</option>';
			}
		}
	}

	public function fetch_notes($id){
		if ($this->user_id)
		{
			$this->realisasi_kegiatan_kl_notes_model->id_realisasi_kegiatan_kl_notes = $id;
			$data = $this->realisasi_kegiatan_kl_notes_model->get_by_id();
			echo json_encode($data);
		}
		else
		{
			redirect('home');
		}
	}

	public function fetch_files($id){
		if ($this->user_id)
		{
			$this->realisasi_kegiatan_kl_notes_file_model->id_realisasi_kegiatan_kl_notes = $id;
			$data = $this->realisasi_kegiatan_kl_notes_file_model->get_by_n();
			echo '<div class="row el-element-overlay m-b-40">';
			foreach($data as $d){

				if($d->file_ext=='.jpg'||$d->file_ext=='.jpeg'||$d->file_ext=='.png'||$d->file_ext=='.gif'){
					$prev = '<img src="'.base_url().'data/images/data_pendukung_kegiatan/'.$d->file_hash.'" />';
				}else{
					$prev = '<i style="margin:20px;font-size: 50px" class="fa fa-file"></i>';
				}

				echo '                        
				<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
				<div class="white-box">
				<div class="el-card-item">
				<div class="el-card-avatar el-overlay-1"> 
				'.$prev.'
				<div class="el-overlay">
				<ul class="el-info">
				<li><a target="blank" class="btn default btn-outline image-popup-vertical-fit" href="'.base_url().'data/images/data_pendukung_kegiatan/'.$d->file_hash.'"><i class="fa fa-download"></i></a></li>
				<li><a class="btn default btn-outline" href="javascript:void(0);"><i class="fa fa-trash"></i></a></li>
				</ul>
				</div>
				</div>
				<div class="el-card-content"> <small>'.$d->file_name.'</small>
				<br/> </div>
				</div>
				</div>
				</div>
				';
			}
			echo '</div>';
		}
		else
		{
			redirect('home');
		}
	}

	public function tes(){
		$tahun = '2016';
		$triwulan = 1;
		$id_koordinator = 27;
		$id_sub_koordinator = 29;
		$total = $this->realisasi_kegiatan_kl_model->get_triwulan($triwulan,$tahun,$id_koordinator,$id_sub_koordinator);
		echo $total;
	}

	public function get_data($id){
		if ($this->user_id)
		{
			$this->target_kegiatan_kl_model->id_target_kegiatan_kl = $id;
			$data = $this->target_kegiatan_kl_model->get_by_id();

			$this->ref_instansi_model->id_instansi = $data->id_sub_koordinator;
			$get = $this->ref_instansi_model->get_by_id();
			$data->option = '<option value="'.$get->id_instansi.'" selected>'.$get->nama_instansi.'</option>';

			$this->target_kegiatan_kl_model->id_target_kegiatan_kl = $data->id_target_kegiatan_kl;
			$data->sisa_anggaran = rupiah($this->target_kegiatan_kl_model->get_sisa_anggaran());
			$data->help_awal = tanggal($data->tanggal_awal);
			$data->help_akhir = tanggal($data->tanggal_akhir);

			echo json_encode($data);
		}
		else
		{
			redirect('home');
		}
	}
}
?>