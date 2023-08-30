<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Target_pekerjaan extends CI_Controller {
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
		$this->load->model('target_pekerjaan_model');
	}
	public function index()
	{
		if ($this->user_id)
		{
			$data['title']		= "Target Pekerjaan - Admin ";
			$data['content']	= "target_pekerjaan/index" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "target_pekerjaan";

			if(!empty($_POST)){
				$this->target_pekerjaan_model->nama_kegiatan = $_POST['nama_kegiatan'];
				$this->target_pekerjaan_model->id_pekerjaan = $_POST['id_pekerjaan'];
				$this->target_pekerjaan_model->tgl_mulai_kegiatan = $_POST['tgl_mulai_kegiatan'];
				$this->target_pekerjaan_model->tgl_akhir_kegiatan = $_POST['tgl_akhir_kegiatan'];
			}

			$this->load->model('ref_pekerjaan_model');
			$data['pekerjaan'] = $this->ref_pekerjaan_model->get_all();

			$data['query'] = $this->target_pekerjaan_model->get_all();

			$this->load->view('admin/index',$data);

		}
		else
		{
			redirect('admin');
		}
	}

	public function add(){
		$data['title']		= "Tambah ref_pekerjaan - Admin ";
		$data['content']	= "target_pekerjaan/add" ;
		$data['user_picture'] = $this->user_picture;
		$data['full_name']		= $this->full_name;
		$data['user_level']		= $this->user_level;
		$data['active_menu'] = "target_pekerjaan";

		if(!empty($_POST)){
			$this->target_pekerjaan_model->id_pekerjaan= $this->input->post('id_pekerjaan');
			$this->target_pekerjaan_model->nama_kegiatan= $this->input->post('nama_kegiatan');
			$this->target_pekerjaan_model->angka_kredit= $this->input->post('angka_kredit');
			$this->target_pekerjaan_model->uraian_kegiatan= $this->input->post('uraian_kegiatan');
			$this->target_pekerjaan_model->tgl_mulai_kegiatan= $this->input->post('tgl_mulai_kegiatan');
			$this->target_pekerjaan_model->tgl_akhir_kegiatan= $this->input->post('tgl_akhir_kegiatan');
			$this->target_pekerjaan_model->nama_lokasi= $this->input->post('nama_lokasi');
			$this->target_pekerjaan_model->id_provinsi_kegiatan= $this->input->post('id_provinsi_kegiatan');
			$this->target_pekerjaan_model->id_kabupaten_kegiatan= $this->input->post('id_kabupaten_kegiatan');
			$this->target_pekerjaan_model->id_kecamatan_kegiatan= $this->input->post('id_kecamatan_kegiatan');
			$this->target_pekerjaan_model->id_desa_kegiatan= $this->input->post('id_desa_kegiatan');
			$this->target_pekerjaan_model->kuantitas_kegiatan= $this->input->post('kuantitas_kegiatan');
			$this->target_pekerjaan_model->id_satuan_kuantitas= $this->input->post('id_satuan_kuantitas');
			$this->target_pekerjaan_model->kualitas_kegiatan= $this->input->post('kualitas_kegiatan');
			$this->target_pekerjaan_model->id_satuan_kualitas= $this->input->post('id_satuan_kualitas');
			$this->target_pekerjaan_model->waktu_kegiatan= $this->input->post('waktu_kegiatan');
			$this->target_pekerjaan_model->id_satuan_waktu= $this->input->post('id_satuan_waktu');
			$this->target_pekerjaan_model->biaya_kegiatan= $this->input->post('biaya_kegiatan');
			$insert = $this->target_pekerjaan_model->insert();
			if($insert){
				$data['message_type'] = "success";
				$data['message']		= "Kegiatan berhasil ditambahkan.";
			}else{
				$data['message_type'] = "warning";
				$data['message']		= "Sudah tidak berlaku.";
			}
		}

		$this->load->model('ref_pekerjaan_model');
		$data['pekerjaan'] = $this->ref_pekerjaan_model->get_all();

		$this->load->model('ref_satuan_model');
		$data['satuan'] = $this->ref_satuan_model->get_all();

		$this->load->model('ref_wilayah_model');
		$data['provinsi'] = $this->ref_wilayah_model->get_provinsi();


		$this->load->view('admin/index',$data);
	}

	public function edit($id_target_pekerjaan)
	{
		if ($this->user_id)
		{
			
			$data['title']		= "target_pekerjaan - Admin ";
			$data['content']	= "target_pekerjaan/edit" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "target_pekerjaan";



			if(!empty($_POST)){
				$this->target_pekerjaan_model->id_kecamatan_kegiatan= $id_target_pekerjaan;
				$this->target_pekerjaan_model->id_pekerjaan= $this->input->post('id_pekerjaan');
				$this->target_pekerjaan_model->nama_kegiatan= $this->input->post('nama_kegiatan');
				$this->target_pekerjaan_model->angka_kredit= $this->input->post('angka_kredit');
				$this->target_pekerjaan_model->uraian_kegiatan= $this->input->post('uraian_kegiatan');
				$this->target_pekerjaan_model->tgl_mulai_kegiatan= $this->input->post('tgl_mulai_kegiatan');
				$this->target_pekerjaan_model->tgl_akhir_kegiatan= $this->input->post('tgl_akhir_kegiatan');
				$this->target_pekerjaan_model->nama_lokasi= $this->input->post('nama_lokasi');
				$this->target_pekerjaan_model->id_provinsi_kegiatan= $this->input->post('id_provinsi_kegiatan');
				$this->target_pekerjaan_model->id_kabupaten_kegiatan= $this->input->post('id_kabupaten_kegiatan');
				$this->target_pekerjaan_model->id_kecamatan_kegiatan= $this->input->post('id_kecamatan_kegiatan');
				$this->target_pekerjaan_model->id_desa_kegiatan= $this->input->post('id_desa_kegiatan');
				$this->target_pekerjaan_model->kuantitas_kegiatan= $this->input->post('kuantitas_kegiatan');
				$this->target_pekerjaan_model->id_satuan_kuantitas= $this->input->post('id_satuan_kuantitas');
				$this->target_pekerjaan_model->kualitas_kegiatan= $this->input->post('kualitas_kegiatan');
				$this->target_pekerjaan_model->id_satuan_kualitas= $this->input->post('id_satuan_kualitas');
				$this->target_pekerjaan_model->waktu_kegiatan= $this->input->post('waktu_kegiatan');
				$this->target_pekerjaan_model->id_satuan_waktu= $this->input->post('id_satuan_waktu');
				$this->target_pekerjaan_model->biaya_kegiatan= $this->input->post('biaya_kegiatan');
				$insert = $this->target_pekerjaan_model->update();
				if($insert){
					$data['message_type'] = "success";
					$data['message']		= "Kegiatan berhasil ditambahkan.";
				}else{
					$data['message_type'] = "warning";
					$data['message']		= "Sudah tidak berlaku.";
				}
			}


			$this->target_pekerjaan_model->id_target_pekerjaan = $id_target_pekerjaan;
			$data['detail'] = $this->target_pekerjaan_model->get_by_id();

			$this->load->model('ref_pekerjaan_model');
			$data['pekerjaan'] = $this->ref_pekerjaan_model->get_all();

			$this->load->model('ref_satuan_model');
			$data['satuan'] = $this->ref_satuan_model->get_all();

			$this->load->model('ref_wilayah_model');
			$data['provinsi'] = $this->ref_wilayah_model->get_provinsi();
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

	
	
	public function delete($id)
	{
		if ($this->user_id)
		{
			$this->target_pekerjaan_model->id_target_pekerjaan = $id;

			$this->target_pekerjaan_model->delete();
			redirect('target_pekerjaan');
		}
		else
		{
			redirect('home');
		}
	}

	public function get_kabupaten($id){
		$obj = '<option value=""> Pilih Kabupaten </option>';
		$this->load->model('ref_wilayah_model');
		$data = $this->ref_wilayah_model->get_kabupaten(null,$id);
		foreach($data as $row){
			$obj .= "<option value='".$row->id_kabupaten."'>$row->kabupaten</option>";
		}
		die ($obj);
	}
	public function get_kecamatan($id){
		$obj = '<option value=""> Pilih Kecamatan </option>';
		$this->load->model('ref_wilayah_model');
		$data = $this->ref_wilayah_model->get_kecamatan(null,$id);
		foreach($data as $row){
			$obj .= "<option value='".$row->id_kecamatan."'>$row->kecamatan</option>";
		}
		die ($obj);
	}
	public function get_desa($id){
		$obj = '<option value=""> Pilih Desa </option>';
		$this->load->model('ref_wilayah_model');
		$data = $this->ref_wilayah_model->get_desa(null,$id);
		foreach($data as $row){
			$obj .= "<option value='".$row->id_desa."'>$row->desa</option>";
		}
		die ($obj);
	}
}
?>