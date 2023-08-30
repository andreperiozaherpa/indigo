<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Realisasi_pekerjaan extends CI_Controller {
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
		$this->load->model('realisasi_pekerjaan_model');
	}
	public function index()
	{
		if ($this->user_id)
		{
			$data['title']		= "Realisasi pekerjaan - Admin ";
			$data['content']	= "realisasi_pekerjaan/index" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "realisasi_pekerjaan";

			$this->load->view('admin/index',$data);

		}
		else
		{
			redirect('admin');
		}
	}

	public function add(){
		$data['title']		= "Tambah Realisasi Pekerjaan - Admin ";
		$data['content']	= "realisasi_pekerjaan/add" ;
		$data['user_picture'] = $this->user_picture;
		$data['full_name']		= $this->full_name;
		$data['user_level']		= $this->user_level;
		$data['active_menu'] = "realisasi_pekerjaan";

		$this->load->model('ref_pekerjaan_model');
		$data['pekerjaan'] = $this->ref_pekerjaan_model->get_all();

		$this->load->model('ref_satuan_model');
		$data['satuan'] = $this->ref_satuan_model->get_all();

		$this->load->model('ref_wilayah_model');
		$data['provinsi'] = $this->ref_wilayah_model->get_provinsi();

		$this->load->view('admin/index',$data);
	}

	public function p_add(){
		$data = $_POST;
		unset($data['file']);
		if(cekForm($data)==TRUE){
			echo json_encode(array("status" => FALSE,"message" => "Masih ada form yang kosong"));
		}else{
			if($_FILES['file']['name'] !== ""){
				$config['upload_path']          = './data/realisasi_pekerjaan/';
				$config['allowed_types']        = 'pdf|xls|xlsx|doc|docx|ppt|pptx|jpg|jpeg|png|gif|txt|zip|rar';
				$this->load->library('upload', $config);
				if ( ! $this->upload->do_upload('file')){
					echo json_encode(array("status" => FALSE,"message" => $this->upload->display_errors()));
					die;
				}else{
					$file = $this->upload->data('file_name');
				}
			}else{
				$file = '';
			}
			$data['file_pendukung'] = $file;
			$insert = $this->realisasi_pekerjaan_model->insert($data);
			echo json_encode(array("status" => TRUE));
		}
	}

	public function fetch_realisasi($id_realisasi_pekerjaan){
		$this->load->model('ref_wilayah_model');
		$this->realisasi_pekerjaan_model->id_realisasi_pekerjaan = $id_realisasi_pekerjaan;
		$data = $this->realisasi_pekerjaan_model->get_by_id();
		$data->provinsi = $this->ref_wilayah_model->get_nama_provinsi($data->id_provinsi_realisasi);
		$data->kabupaten = $this->ref_wilayah_model->get_nama_kabupaten($data->id_kabupaten_realisasi);
		$data->kecamatan = $this->ref_wilayah_model->get_nama_kecamatan($data->id_kecamatan_realisasi);
		$data->desa = $this->ref_wilayah_model->get_nama_desa($data->id_desa_realisasi);
		echo json_encode($data);
	}

	public function p_update(){
		$data = $_POST;
		unset($data['file']);
		unset($data['id_realisasi_pekerjaan']);
		if(cekForm($data)==TRUE){
			echo json_encode(array("status" => FALSE,"message" => "Masih ada form yang kosong"));
		}else{
			if($_FILES['file']['name'] !== ""){
				$config['upload_path']          = './data/realisasi_pekerjaan/';
				$config['allowed_types']        = 'pdf|xls|xlsx|doc|docx|ppt|pptx|jpg|jpeg|png|gif|txt|zip|rar';
				$this->load->library('upload', $config);
				if ( ! $this->upload->do_upload('file')){
					echo json_encode(array("status" => FALSE,"message" => $this->upload->display_errors()));
					die;
				}else{
					$file = $this->upload->data('file_name');
					$data['file_pendukung'] = $file;
				}
			}

			$this->realisasi_pekerjaan_model->id_realisasi_pekerjaan = $_POST['id_realisasi_pekerjaan'];
			$update = $this->realisasi_pekerjaan_model->update($data);
			echo json_encode(array("status" => TRUE));
		}
	}

	public function get_timeline($id_target_pekerjaan){
		$this->realisasi_pekerjaan_model->id_target_pekerjaan = $id_target_pekerjaan;
		$data = $this->realisasi_pekerjaan_model->get_all();
		if(empty($data)){
			echo "<h3>Belum ada data</h2>";
		}else{
			$no=1;
			foreach($data as $n){
				if($no%2==0){
					$class = ' class="timeline-inverted"';
				}else{
					$class = '';
				}

				$uraian = $n->uraian_realisasi;
				if(strlen($uraian>120)){
					$uraian = substr($uraian, 0, 120).' ...';
				}

				echo '
				<li'.$class.'>
				<div class="timeline-badge success"><i class="fa fa-save"></i></div>
				<div class="timeline-panel">
				<div class="timeline-heading">
				<h4 class="timeline-title">'.$n->nama_kegiatan_realisasi.'</h4> 
				<small class="text-muted pull-right"> <button class="btn btn-xs btn-default btn-outline m-l-5 ">'.$n->nama_pekerjaan.'</button></small>
				<hr>
				<p><small class="text-muted"><i class="fa fa-clock-o"></i> '.tanggal($n->tgl_kegiatan_realisasi).'</small> </p>
				</div>
				<div class="timeline-body">
				<p style="word-break: break-all; word-wrap: break-word;">'.$uraian.'</p>
				</div>
				<hr>
				<p>
				'.status_pekerjaan($n->status).'</p>

				<div class="btn-group m-r-10 pull-right">
				<button aria-expanded="false" data-toggle="dropdown" class="btn btn-default btn-outline dropdown-toggle waves-effect waves-light" type="button"> <i class="fa fa-spin fa-gear m-r-5"></i> <span class="caret"></span></button>
				<ul role="menu" class="dropdown-menu">
				<li><a href="#" data-toggle="modal" data-target=".bs-example-modal-lg">Detail</a></li>
				<li><a href="javascript:void(0)" onclick="editRealisasi('.$n->id_realisasi_pekerjaan.')">Edit</a></li>

				<li class="divider"></li>
				<li><a href="javascript:void(0)" onclick="deleteRealisasi('.$n->id_realisasi_pekerjaan.')">Hapus</a></li>
				</ul>
				</div>


				</div>
				</li>
				';
				$no++;
			}
		}

	}

	public function view()
	{
		if ($this->user_id)
		{

			$data['title']		= "target_pekerjaan - Admin ";
			$data['content']	= "target_pekerjaan/view" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "target_pekerjaan";
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
			$this->realisasi_pekerjaan_model->id_realisasi_pekerjaan = $id;
			$this->realisasi_pekerjaan_model->delete();
			echo json_encode(array("status" => TRUE));
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

	public function get_kegiatan($id){
		$obj = '<option value=""> Pilih Kegiatan </option>';
		$this->load->model('target_pekerjaan_model');
		$this->target_pekerjaan_model->id_pekerjaan = $id;
		$data = $this->target_pekerjaan_model->get_all();
		foreach($data as $row){
			$obj .= "<option value='".$row->id_target_pekerjaan."'>$row->nama_kegiatan</option>";
		}
		die ($obj);
	}

	public function get_detail_kegiatan($id){
		$this->load->model('ref_wilayah_model');
		$this->load->model('target_pekerjaan_model');
		$this->load->model('ref_satuan_model');
		$this->target_pekerjaan_model->id_target_pekerjaan = $id;
		$data = $this->target_pekerjaan_model->get_by_id();
		$data->provinsi = $this->ref_wilayah_model->get_nama_provinsi($data->id_provinsi_kegiatan);
		$data->kabupaten = $this->ref_wilayah_model->get_nama_kabupaten($data->id_kabupaten_kegiatan);
		$data->kecamatan = $this->ref_wilayah_model->get_nama_kecamatan($data->id_kecamatan_kegiatan);
		$data->desa = $this->ref_wilayah_model->get_nama_desa($data->id_desa_kegiatan);
		$this->ref_satuan_model->id_satuan = $data->id_satuan_kuantitas;
		$data->satuan_kuantitas = $this->ref_satuan_model->get_by_id()->satuan;
		$this->ref_satuan_model->id_satuan = $data->id_satuan_kualitas;
		$data->satuan_kualitas = $this->ref_satuan_model->get_by_id()->satuan;
		$this->ref_satuan_model->id_satuan = $data->id_satuan_waktu;
		$data->satuan_waktu = $this->ref_satuan_model->get_by_id()->satuan;
		echo json_encode($data);
	}
}
?>