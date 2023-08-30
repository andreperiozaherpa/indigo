<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Target_kegiatan_kl extends CI_Controller {
	public $user_id;

	public function __construct(){
		parent ::__construct();	
		$this->user_id = $this->session->userdata('user_id');
		$this->load->model('user_model');
		$this->load->model('target_kegiatan_kl_model');
		$this->load->model('ref_instansi_model');
		$this->load->model('ref_wilayah_model');
		$this->load->model('ref_kode_model');
		$this->load->model('ref_satuan_model');
		$this->user_model->user_id = $this->user_id;
		$this->user_model->set_user_by_user_id();
		$this->user_picture = $this->user_model->user_picture;
		$this->full_name	= $this->user_model->full_name;
		$this->user_level	= $this->user_model->level;
		$this->user_privileges	= $this->user_model->user_privileges;
		$this->instansi_level	= $this->user_model->instansi_level;
		$this->instansi_id	= $this->user_model->instansi_id;
		$array_privileges = explode(';', $this->user_privileges);

		if (($this->user_level!="Administrator" && $this->user_level!="User" && $this->user_level!="Departement") && !in_array('mn_kegiatan', $array_privileges)) redirect ('welcome');
	}

	public function index()
	{
		if ($this->user_id)
		{
			$data['title']		= "Target Kegiatan KL - ". app_name;
			$data['content']	= "target_kegiatan_kl/index" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "target_kegiatan_kl";

			$data['data'] = $this->target_kegiatan_kl_model->get_all($this->user_id,$this->user_level);

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
			
			$data['title']		= "Tambah Target Kegiatan KL - ". app_name;
			$data['content']	= "target_kegiatan_kl/add" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "target_kegiatan_kl";
			$data['instansi_level'] = $this->instansi_level;
			$data['instansi_id'] = $this->instansi_id;

			if (!empty($_POST)){
				if ((
					$_POST['tahun_target_kegiatan_kl'] !="" &&
					$_POST['id_kode'] !="" &&
					$_POST['id_koordinator'] !="" &&
					$_POST['rencana_kegiatan'] !="" &&
					$_POST['tanggal_awal'] !="" &&
					$_POST['tanggal_akhir'] !="" &&
					$_POST['jumlah_target_kegiatan'] !="" &&
					$_POST['alokasi_anggaran'] !="" &&
					$_POST['volume_kegiatan'] !="" &&
					$_POST['id_satuan'] !=""
				))
				{
				$tahun_target_kegiatan_kl = $_POST['tahun_target_kegiatan_kl'];
				$id_sub_koordinator = $_POST['id_sub_koordinator'];
				$id_kode = $_POST['id_kode'];
				$id_koordinator = $_POST['id_koordinator'];
				$rencana_kegiatan = $_POST['rencana_kegiatan'];
				$tanggal_awal = $_POST['tanggal_awal'];
				$tanggal_akhir = $_POST['tanggal_akhir'];
				$jumlah_target_kegiatan = $_POST['jumlah_target_kegiatan'];
				$id_provinsi_target = $_POST['id_provinsi_target'];
				$id_kabupaten_target = $_POST['id_kabupaten_target'];
				$id_kecamatan_target = $_POST['id_kecamatan_target'];
				$id_desa_target = $_POST['id_desa_target'];
				$alokasi_anggaran = str_replace($_POST['alokasi_anggaran'], '.', '');
				$keterangan_kegiatan = $_POST['keterangan_kegiatan'];
				$tempat = $_POST['tempat'];
				$volume_kegiatan = $_POST['volume_kegiatan'];
				$id_satuan = $_POST['id_satuan'];
				$id_user = $this->user_id;

				$this->target_kegiatan_kl_model->tahun_target_kegiatan_kl = $tahun_target_kegiatan_kl;
				$this->target_kegiatan_kl_model->id_kode = $id_kode;
				$this->target_kegiatan_kl_model->id_koordinator = $id_koordinator;
				$this->target_kegiatan_kl_model->id_sub_koordinator = $id_sub_koordinator;
				$this->target_kegiatan_kl_model->rencana_kegiatan = $rencana_kegiatan;
				$this->target_kegiatan_kl_model->tanggal_awal = $tanggal_awal;
				$this->target_kegiatan_kl_model->tanggal_akhir = $tanggal_akhir;
				$this->target_kegiatan_kl_model->jumlah_target_kegiatan = $jumlah_target_kegiatan;
				$this->target_kegiatan_kl_model->id_provinsi_target = $id_provinsi_target;
				$this->target_kegiatan_kl_model->id_kabupaten_target = $id_kabupaten_target;
				$this->target_kegiatan_kl_model->id_kecamatan_target = $id_kecamatan_target;
				$this->target_kegiatan_kl_model->id_desa_target = $id_desa_target;
				$this->target_kegiatan_kl_model->alokasi_anggaran = $alokasi_anggaran;
				$this->target_kegiatan_kl_model->tempat = $tempat;
				$this->target_kegiatan_kl_model->volume_kegiatan = $volume_kegiatan;
				$this->target_kegiatan_kl_model->keterangan_kegiatan = $keterangan_kegiatan;
				$this->target_kegiatan_kl_model->id_satuan = $id_satuan;
				$this->target_kegiatan_kl_model->id_user = $id_user;
				$insert = $this->target_kegiatan_kl_model->insert();
	            $data['message_type'] = "success";
	            $data['message']		= "Target Kegiatan berhasil ditambahkan.";
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


			$this->load->view('admin/index',$data);

		}
		else
		{
			redirect('admin');
		}
	}

	public function edit($id_target_kegiatan_kl)
	{
		if ($this->user_id)
		{
			
			$data['title']		= "Edit Target Kegiatan KL - ". app_name;
			$data['content']	= "target_kegiatan_kl/edit" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "target_kegiatan_kl";
			$data['instansi_level'] = $this->instansi_level;
			$data['instansi_id'] = $this->instansi_id;

			if (!empty($_POST)){
				if ((
					$_POST['tahun_target_kegiatan_kl'] !="" &&
					$_POST['id_kode'] !="" &&
					$_POST['id_koordinator'] !="" &&
					$_POST['rencana_kegiatan'] !="" &&
					$_POST['tanggal_awal'] !="" &&
					$_POST['tanggal_akhir'] !="" &&
					$_POST['jumlah_target_kegiatan'] !="" &&
					$_POST['alokasi_anggaran'] !="" &&
					$_POST['volume_kegiatan'] !="" &&
					$_POST['id_satuan'] !=""
				))
				{
				$tahun_target_kegiatan_kl = $_POST['tahun_target_kegiatan_kl'];
				$id_sub_koordinator = $_POST['id_sub_koordinator'];
				$id_kode = $_POST['id_kode'];
				$id_kode = $_POST['id_kode'];
				$id_koordinator = $_POST['id_koordinator'];
				$rencana_kegiatan = $_POST['rencana_kegiatan'];
				$tanggal_awal = $_POST['tanggal_awal'];
				$tanggal_akhir = $_POST['tanggal_akhir'];
				$jumlah_target_kegiatan = $_POST['jumlah_target_kegiatan'];
				$id_provinsi_target = $_POST['id_provinsi_target'];
				$id_kabupaten_target = $_POST['id_kabupaten_target'];
				$id_kecamatan_target = chop($_POST['id_kecamatan_target'], '.', '');

				$id_desa_target = $_POST['id_desa_target'];
				$alokasi_anggaran = chop($_POST['alokasi_anggaran'], '.', '');
				$tempat = $_POST['tempat'];
				$volume_kegiatan = $_POST['volume_kegiatan'];
				$id_satuan = $_POST['id_satuan'];
				$keterangan_kegiatan = $_POST['keterangan_kegiatan'];

				$this->target_kegiatan_kl_model->id_target_kegiatan_kl = $id_target_kegiatan_kl;

				$this->target_kegiatan_kl_model->tahun_target_kegiatan_kl = $tahun_target_kegiatan_kl;
				$this->target_kegiatan_kl_model->id_kode = $id_kode;
				$this->target_kegiatan_kl_model->id_koordinator = $id_koordinator;
				$this->target_kegiatan_kl_model->id_sub_koordinator = $id_sub_koordinator;
				$this->target_kegiatan_kl_model->rencana_kegiatan = $rencana_kegiatan;
				$this->target_kegiatan_kl_model->tanggal_awal = $tanggal_awal;
				$this->target_kegiatan_kl_model->tanggal_akhir = $tanggal_akhir;
				$this->target_kegiatan_kl_model->jumlah_target_kegiatan = $jumlah_target_kegiatan;
				$this->target_kegiatan_kl_model->id_provinsi_target = $id_provinsi_target;
				$this->target_kegiatan_kl_model->id_kabupaten_target = $id_kabupaten_target;
				$this->target_kegiatan_kl_model->id_kecamatan_target = $id_kecamatan_target;
				$this->target_kegiatan_kl_model->id_desa_target = $id_desa_target;
				$this->target_kegiatan_kl_model->alokasi_anggaran = $alokasi_anggaran;
				$this->target_kegiatan_kl_model->tempat = $tempat;
				$this->target_kegiatan_kl_model->keterangan_kegiatan = $keterangan_kegiatan;
				$this->target_kegiatan_kl_model->volume_kegiatan = $volume_kegiatan;
				$this->target_kegiatan_kl_model->id_satuan = $id_satuan;
				$insert = $this->target_kegiatan_kl_model->update();
	            $data['message_type'] = "success";
	            $data['message']		= "Target Kegiatan berhasil diubah.";
			}else{
				$data['message_type'] = "warning";
				$data['message'] = "<strong>Opps..</strong> Masih ada data yang kosong. silahkan lengkapi terlebih dahulu!";

			}
			}

			$this->target_kegiatan_kl_model->id_target_kegiatan_kl = $id_target_kegiatan_kl;
			$data['detail'] = $this->target_kegiatan_kl_model->get_by_id();
			$data['koordinator'] = $this->ref_instansi_model->get_koordinator();
			$data['lembaga'] = $this->ref_instansi_model->get_lembaga($data['detail']->id_koordinator);
			$data['provinsi'] = $this->ref_wilayah_model->get_provinsi();
			$data['kabupaten'] = $this->ref_wilayah_model->get_kabupaten($data['detail']->id_kabupaten_target);
			$data['kecamatan'] = $this->ref_wilayah_model->get_kecamatan($data['detail']->id_kecamatan_target);
			$data['desa'] = $this->ref_wilayah_model->get_desa($data['detail']->id_desa_target);
			$data['satuan'] = $this->ref_satuan_model->get_all();
			$data['instansi_level'] = $this->instansi_level;
			$data['kode'] = $this->ref_kode_model->get_all();
			if($this->instansi_level=='koordinator'){
				$data['id_koordinator'] = $this->instansi_id;
				$data['sub_koordinator'] = $this->ref_instansi_model->get_lembaga($this->instansi_id);
			}elseif($this->instansi_level=='lembaga'){
				$this->ref_instansi_model->id_instansi = $this->instansi_id;
				$a = $this->ref_instansi_model->get_by_id();
				$data['id_koordinator'] = $a->id_koordinator;
				$data['id_sub_koordinator'] = $this->instansi_id;
			}


			$this->load->view('admin/index',$data);

		}
		else
		{
			redirect('admin');
		}
	}

	public function detail($id_target_kegiatan_kl)
	{
		if ($this->user_id)
		{
			
			$data['title']		= "Detail Target Kegiatan KL - ". app_name;
			$data['content']	= "target_kegiatan_kl/detail" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "target_kegiatan_kl";

			$this->target_kegiatan_kl_model->id_target_kegiatan_kl = $id_target_kegiatan_kl;
			$data['detail'] = $this->target_kegiatan_kl_model->get_by_id();

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
		
			$this->target_kegiatan_kl_model->id_target_kegiatan_kl = $id;
			$this->target_kegiatan_kl_model->delete();
			redirect('target_kegiatan_kl');
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
			echo'<option value="0">Pilih Instansi</option>';
			foreach($get as $g){
				echo'<option value="'.$g->id_instansi.'">'.$g->nama_instansi.'</option>';
			}
		}
	}
	public function get_kabupaten(){
		if(!empty($_POST)){
			$id_provinsi = $_POST['id_provinsi'];
			$get = $this->ref_wilayah_model->get_kabupaten(null,$id_provinsi);
			echo'<option value="0">Pilih Kabupaten / Kota</option>';
			foreach($get as $g){
				echo'<option value="'.$g->id_kabupaten.'">'.$g->kabupaten.'</option>';
			}
		}
	}
	public function get_kecamatan(){
		if(!empty($_POST)){
			$id_kabupaten = $_POST['id_kabupaten'];
			$get = $this->ref_wilayah_model->get_kecamatan(null,$id_kabupaten);
			echo'<option value="0">Pilih Kecamatan</option>';
			foreach($get as $g){
				echo'<option value="'.$g->id_kecamatan.'">'.$g->kecamatan.'</option>';
			}
		}
	}
	public function get_desa(){
		if(!empty($_POST)){
			$id_kecamatan = $_POST['id_kecamatan'];
			$get = $this->ref_wilayah_model->get_desa(null,$id_kecamatan);
			echo'<option value="0">Pilih Desa / Kelurahan</option>';
			foreach($get as $g){
				echo'<option value="'.$g->id_desa.'">'.$g->desa.'</option>';
			}
		}
	}
}
?>