<?php
class Kerja_luar_kantor extends CI_Controller{
    
	public $user_id;

	public function __construct(){
		parent ::__construct();
		$this->user_id = $this->session->userdata('user_id');
		$this->load->model('user_model');
		$this->load->model('kerja_luar_kantor_model');
		$this->load->model('master_pegawai_model');
		$this->load->model('surat_keluar_model');
		$this->user_model->user_id = $this->user_id;
		$this->user_model->set_user_by_user_id();
		$this->user_picture = $this->user_model->user_picture;
		$this->full_name	= $this->user_model->full_name;
		$this->user_level	= $this->user_model->level;
		if ($this->user_level=="Admin Web");

		//$this->load->model('Ref_renstra','ref_kode_kegiatan_m');
    }
    public function dashboard(){

		if ($this->user_id)
		{
			$data['title']		= "Dashboard - Markonah";
			$data['content']	= "kerja_luar_kantor/dashboard" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "kerja_luar_kantor";

			$hal = 6;
			$page = isset($_GET["page"]) ? (int)$_GET["page"] : 1;
			$mulai = ($page>1) ? ($page * $hal) - $hal : 0;
			$total = count($this->kerja_luar_kantor_model->get_all());
			$data['pages'] = ceil($total/$hal);
			$data['current'] = $page;

			$data['total'] = $total;
			$data['list'] = $this->kerja_luar_kantor_model->get_all();

			$this->load->view('admin/index',$data);



		}
		else
		{
			redirect('admin');
		}
	}
    
    public function index(){

		if ($this->user_id)
		{
			$data['title']		= "Ajuan Surat Kerja Luar Kantor";
			$data['content']	= "kerja_luar_kantor/index" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "kerja_luar_kantor";

			$hal = 6;
			$page = isset($_GET["page"]) ? (int)$_GET["page"] : 1;
			$mulai = ($page>1) ? ($page * $hal) - $hal : 0;
			$total = count($this->kerja_luar_kantor_model->get_all());
			$data['pages'] = ceil($total/$hal);
			$data['current'] = $page;

			$data['total'] = $total;
			$data['list'] = $this->kerja_luar_kantor_model->get_page($mulai,$hal);

			$this->load->view('admin/index',$data);



		}
		else
		{
			redirect('admin');
		}
	}
	
    public function add(){

		if ($this->user_id)
		{
			$data['title']		= "Tambah - Ajuan Surat Kerja Luar Kantor";
			$data['content']	= "kerja_luar_kantor/add" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "kerja_luar_kantor";

			if (!empty($_POST)){
				$not_required = array();
				$cekform = isFormEmpty($not_required,$_POST);
				if ($cekform){
					$data['message'] = '<b>Opps..</b> ada form yang belum diisi';
					$data['message_type'] = 'warning';
				}else{
					$data_in = array(
									'id_pegawai' => $this->session->userdata('id_pegawai'),
									'id_skpd' => $this->session->userdata('id_skpd'),
									'nama_kegiatan' => $_POST['nama_kegiatan'],
									'lokasi_pengerjaan' => $_POST['lokasi_pengerjaan'],
									'tanggal_awal' => $_POST['tanggal_awal'],
									'tanggal_akhir' => $_POST['tanggal_akhir'],
									'deskripsi_kegiatan' => $_POST['deskripsi_kegiatan'],
									'target_kegiatan' => $_POST['target_kegiatan'],
									'id_pegawai_verifikator_kegiatan' => $_POST['id_pegawai_verifikator_kegiatan']
								);
					$in = $this->kerja_luar_kantor_model->insert($data_in);
					if($in){
						$data['message'] = 'Pengajuan anda berhasil dibuat, <b><a style="color:white" target="blank" href="'.base_url('kerja_luar_kantor/detail/'.$in).'">Klik Disini</a></b> untuk menuju ke detail Pengajuan';
						$data['message_type'] = 'success';
					}else{
						$data['message'] = 'Uh oh.. terjadi kesalahan saat memproses data';
						$data['message_type'] = 'danger';
					}
				}
			}

			$data['pegawai'] = $this->master_pegawai_model->get_by_id_skpd($this->session->userdata('id_skpd'),true);

			$this->load->view('admin/index',$data);



		}
		else
		{
			redirect('admin');
		}
	}
	
    public function edit($id_kerja_luar_kantor){

		if ($this->user_id)
		{
			$data['title']		= "Edit - Ajuan Surat Kerja Luar Kantor";
			$data['content']	= "kerja_luar_kantor/edit" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "kerja_luar_kantor";

			if (!empty($_POST)){
				$not_required = array();
				$cekform = isFormEmpty($not_required,$_POST);
				if ($cekform){
					$data['message'] = '<b>Opps..</b> ada form yang belum diisi';
					$data['message_type'] = 'warning';
				}else{
					$data_in = array(
									'nama_kegiatan' => $_POST['nama_kegiatan'],
									'lokasi_pengerjaan' => $_POST['lokasi_pengerjaan'],
									'tanggal_awal' => $_POST['tanggal_awal'],
									'tanggal_akhir' => $_POST['tanggal_akhir'],
									'deskripsi_kegiatan' => $_POST['deskripsi_kegiatan'],
									'target_kegiatan' => $_POST['target_kegiatan'],
									'id_pegawai_verifikator_kegiatan' => $_POST['id_pegawai_verifikator_kegiatan']
								);
					$in = $this->kerja_luar_kantor_model->update($data_in,$id_kerja_luar_kantor);
					if($in){
						$data['message'] = 'Pengajuan anda berhasil diubah';
						$data['message_type'] = 'success';
					}else{
						$data['message'] = 'Uh oh.. terjadi kesalahan saat memproses data';
						$data['message_type'] = 'danger';
					}
				}
			}

			$data['detail'] = $this->kerja_luar_kantor_model->get_by_id($id_kerja_luar_kantor);
			$data['self_pegawai'] = $this->master_pegawai_model->get_by_id($this->session->userdata('id_pegawai'));
			$data['pegawai'] = $this->master_pegawai_model->get_by_id_skpd($this->session->userdata('id_skpd'),true);

			$this->load->view('admin/index',$data);



		}
		else
		{
			redirect('admin');
		}
	}
	
    public function detail($id_kerja_luar_kantor){

		if ($this->user_id)
		{
			$data['title']		= "Detail - Ajuan Surat Kerja Luar Kantor";
			$data['content']	= "kerja_luar_kantor/detail" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "kerja_luar_kantor";

			$data['detail'] = $this->kerja_luar_kantor_model->get_by_id($id_kerja_luar_kantor);
			$data['self_pegawai'] = $this->master_pegawai_model->get_by_id($data['detail']->id_pegawai);

			if($data['detail']->id_surat_keluar==NULL){
				$data['message'] = '<i class="ti-info-alt"></i> Anda belum membuat surat pengajuan, silahkan klik tombol <b>Buat Surat Pengajuan</b> disebelah kanan untuk membuat Pengajuan Surat';
				$data['message_type'] = 'warning';
			}else{
				$data['status_surat'] = $this->surat_keluar_model->get_status_surat($data['detail']->id_surat_keluar);
				$detail_surat = $this->surat_keluar_model->get_detail_by_id($data['detail']->id_surat_keluar);
				if($data['status_surat']=='ditolak_verifikasi'){
					$data['message'] = '<i class="ti-close"></i> Surat Pengajuan Anda ditolak oleh Verifikator dengan alasan : <b>'.$detail_surat->alasan_penolakan_verifikasi.'</b>. <br>Silahkan membuat ulang surat pengajuan sesuai dan dikoreksi sesuai dengan alasan penolakan';
					$data['message_type'] = 'danger';
				}elseif($data['status_surat']=='ditolak_penomoran'){
					$data['message'] = '<i class="ti-close"></i> Surat Pengajuan Anda ditolak oleh Bagian Penomoran dengan alasan : <b>'.$detail_surat->alasan_penolakan_penomoran.'</b>. <br>Silahkan membuat ulang surat pengajuan sesuai dan dikoreksi sesuai dengan alasan penolakan';
					$data['message_type'] = 'danger';
				}elseif($data['status_surat']=='ditolak_ttd'){
					$data['message'] = '<i class="ti-close"></i> Surat Pengajuan Anda ditolak oleh Penandatangan dengan alasan : <b>'.$detail_surat->alasan_penolakan_ttd.'</b>. <br>Silahkan membuat ulang surat pengajuan sesuai dan dikoreksi sesuai dengan alasan penolakan';
					$data['message_type'] = 'danger';
				}elseif($data['status_surat']=='sudah_ditandatangani'){
					$data['message'] = '<i class="ti-check"></i> Surat Pengajuan Anda sudah disetujui, silahkan mengisi pekerjaan anda dengan masuk ke menu <b><a style="color:white" href="'.base_url('kegiatan_personal').'">Kegiatan Personal</a></b>';
					$data['message_type'] = 'success';
					$this->load->model('kegiatan_personal_model');
					$data['kegiatan_personal'] = $this->kerja_luar_kantor_model->get_kegiatan_personal($id_kerja_luar_kantor);
				}
			}

			$this->load->view('admin/index',$data);



		}
		else
		{
			redirect('admin');
		}
	}

	public function get_json($id_kerja_luar_kantor){
		$detail = $this->kerja_luar_kantor_model->get_by_id($id_kerja_luar_kantor);
		echo json_encode($detail);
	}

	public function delete($id_kerja_luar_kantor){
		$delete = $this->kerja_luar_kantor_model->delete($id_kerja_luar_kantor);
		redirect('kerja_luar_kantor');

	}

}