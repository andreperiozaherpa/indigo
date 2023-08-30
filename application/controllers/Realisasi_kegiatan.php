<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Realisasi_kegiatan extends CI_Controller {
	public $user_id;

	public function __construct(){
		parent ::__construct();	
		$this->user_id = $this->session->userdata('user_id');
		$this->load->model('user_model');
		$this->load->model('kegiatan_model');
		$this->load->model('realisasi_kegiatan_model');
		$this->user_model->user_id = $this->user_id;
		$this->user_model->set_user_by_user_id();
		$this->user_picture = $this->user_model->user_picture;
		$this->full_name	= $this->user_model->full_name;
		$this->user_level	= $this->user_model->level;
		if ($this->user_level=="Admin Web"); 

		// $this->load->model('realisasi_kegiatan_model','realisasi_kegiatan_m');
	}
	public function index()
	{
		if ($this->user_id)
		{
			$data['title']		= "Realisasi Kegiatan - Admin ";
			$data['content']	= "realisasi_kegiatan/index" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "realisasi_kegiatan";
			$data['query']		= $this->kegiatan_model->get_all();
			// $data['item'] = $this->realisasi_kegiatan_m->get_all();
			$this->load->view('admin/index',$data);


		}
		else
		{
			redirect('admin');
		}
	}

	public function add(){
		$data['title']		= "Tambah realisasi_kegiatan - Admin ";
		$data['content']	= "realisasi_kegiatan/add" ;
		$data['user_picture'] = $this->user_picture;
		$data['full_name']		= $this->full_name;
		$data['user_level']		= $this->user_level;
		$data['active_menu'] = "realisasi_kegiatan";

			// $data['item'] = $this->realisasi_kegiatan_m->get_all();
		$this->load->view('admin/index',$data);
	}

	public function detail($id_kegiatan)
	{
		if ($this->user_id)
		{
			$this->filter_kegiatan($id_kegiatan);
			
			$data['title']		= "Detail Realisasi Kegiatan - Admin ";
			$data['content']	= "realisasi_kegiatan/detail" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "realisasi_kegiatan";

			if (!empty($this->input->post()))
			{
				$id_realisasi = $_POST['id_realisasi'];
				$realisasi = $_POST['realisasi'];
				$d = array('realisasi'=>$realisasi,'tgl_update'=>date('Y-m-d'),'status'=>'menunggu_verifikasi');
				$update = $this->realisasi_kegiatan_model->update($id_realisasi,$d);

				if($_FILES['files']['name'] !== ""){
					$filesCount = count($_FILES['files']['name']);
					for($i = 0; $i < $filesCount; $i++){
						$_FILES['file']['name']     = $_FILES['files']['name'][$i];
						$_FILES['file']['type']     = $_FILES['files']['type'][$i];
						$_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
						$_FILES['file']['error']     = $_FILES['files']['error'][$i];
						$_FILES['file']['size']     = $_FILES['files']['size'][$i];
						$config['upload_path'] = './data/kegiatan_realisasi/';
						$config['allowed_types'] = 'jpg|jpeg|png|gif|ppt|pptx|doc|docx|xls|xlsx|pdf';
						$this->load->library('upload', $config);
						$this->upload->initialize($config);
						if($this->upload->do_upload('file')){
							$fileData = $this->upload->data();
							$uploadData[$i]['file_name'] =$fileData['file_name'];
						}
					}
					
					if(!empty($uploadData)){
						foreach($uploadData as $u){
							$ins = array('id_realisasi'=>$id_realisasi,'file'=>$u['file_name']);
							$this->realisasi_kegiatan_model->insert_file($ins);
						}
					}
				}




				$this->kegiatan_model->id_kegiatan = $id_kegiatan;
				$detail = $this->kegiatan_model->get_by_id();
				$log_data = array(
					'action' => 'menambahkan',
					'function' => 'realisasi kegiatan',
					'key_name' => 'nama kegiatan',
					'key_value' => $detail->nama_kegiatan,
					'category' => $this->uri->segment(1),
				);
				$this->logs_model->insert_log($log_data);

			}
			$this->kegiatan_model->id_kegiatan = $id_kegiatan;
			$data['k'] = $this->kegiatan_model->get_by_id();
			$data['anggota'] = $this->kegiatan_model->get_anggota();
			$data['realisasi'] = $this->realisasi_kegiatan_model->get_by_kegiatan($id_kegiatan);
			$data['diterima'] = count($this->realisasi_kegiatan_model->get_by_kegiatan($id_kegiatan,'disetujui'));
			$data['menunggu_verifikasi'] = count($this->realisasi_kegiatan_model->get_by_kegiatan($id_kegiatan,'menunggu_verifikasi'));
			$data['progress'] = $this->realisasi_kegiatan_model->get_progress($id_kegiatan);
			// print_r($data['progress']);die;
			$this->load->model('pegawai_model');
			$this->load->model('ref_wilayah_model');
			$this->load->view('admin/index',$data);

		}
		else
		{
			redirect('admin');
		}
	}

	public function fetch_realisasi($id_realisasi){
		$realisasi = $this->realisasi_kegiatan_model->get_by_id($id_realisasi);
		echo json_encode($realisasi);
	}

	public function update_status($id_kegiatan,$id_realisasi,$status){
			$this->filter_kegiatan($id_kegiatan);
		if($status){
			$u = 'disetujui';
			$this->kegiatan_model->id_kegiatan = $id_kegiatan;
			$detail = $this->kegiatan_model->get_by_id();
			$log_data = array(
				'action' => 'menyetujui',
				'function' => 'realisasi kegiatan',
				'key_name' => 'nama kegiatan',
				'key_value' => $detail->nama_kegiatan,
				'category' => $this->uri->segment(1),
			);
			$this->logs_model->insert_log($log_data);
		}else{
			$u = 'ditolak';
			$this->kegiatan_model->id_kegiatan = $id_kegiatan;
			$detail = $this->kegiatan_model->get_by_id();
			$log_data = array(
				'action' => 'menolak',
				'function' => 'realisasi kegiatan',
				'key_name' => 'nama kegiatan',
				'key_value' => $detail->nama_kegiatan,
				'category' => $this->uri->segment(1),
			);
			$this->logs_model->insert_log($log_data);
		}
		$update = $this->realisasi_kegiatan_model->update($id_realisasi,array('status'=>$u));
		redirect('realisasi_kegiatan/detail/'.$id_kegiatan.'');
	}

	public function edit()
	{
		if ($this->user_id)
		{
			$id = $this->uri->segment(3);
			if(empty($id)){
				redirect(base_url('realisasi_kegiatan'));
			}

			$data['item'] = $this->realisasi_kegiatan_m->select_by_id($id);

			if(empty($data['item'])){
				redirect(base_url('realisasi_kegiatan'));
			}

			$data['title']		= "realisasi_kegiatan - Admin ";
			$data['content']	= "realisasi_kegiatan/edit" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "realisasi_kegiatan";
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
			redirect(base_url('realisasi_kegiatan'));
		}
		$data = $this->input->post();
		$this->realisasi_kegiatan_m->update($data,$id);
		redirect(base_url('realisasi_kegiatan'));
	}

	public function delete($id)
	{
		if ($this->user_id)
		{
			$this->realisasi_kegiatan_m->id_realisasi_kegiatan = $id;
			$this->realisasi_kegiatan_m->delete();
		}
		else
		{
			redirect('home');
		}
	}



	public function filter_kegiatan($id_kegiatan){
		$cek = $this->kegiatan_model->check_privileges($id_kegiatan);
		if(!$cek){
			show_404();
		}
	}

}
?>