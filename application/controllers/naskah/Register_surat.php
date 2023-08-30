<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register_surat extends CI_Controller {

	public function __construct(){
		parent ::__construct();
		$this->load->model('register_surat_model');
		$this->load->model('surat_keluar_model');
		$this->load->model('logs_model');
		$this->user_privileges = explode(";", $this->session->userdata('user_privileges'));

	}

	public function index($summary_field='',$summary_value=''){

		if ($this->user_id)
		{
			$summary_value = urldecode($summary_value);
			$this->filter_register();
			$data['title']		= "Registrasi Surat Keluar- Admin ";
			$data['content']	= "register_surat/index" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "register_surat";

			$hal = 6;
			$page = isset($_GET["page"]) ? (int)$_GET["page"] : 1;
			$mulai = ($page>1) ? ($page * $hal) - $hal : 0;
			$total = count($this->register_surat_model->surat_keluar($summary_field,$summary_value));
			$data['pages'] = ceil($total/$hal);
			$data['current'] = $page;
			if(!empty($_POST)){
				$start = $_POST["start"];
				$end = $_POST["end"];
				$nomer_surat = $_POST["nomer_surat"];
				$data['filter'] = true;
				$data['start'] = $_POST['start'];
				$data['end'] = $_POST['end'];
				$data['nomer_surat'] = $_POST['nomer_surat'];
			}else{
				$start = '';
				$end = '';
				$nomer_surat = '';
				$data['filter'] = false;
			}

			$data['total'] = $this->register_surat_model->surat_keluar();
			$data['registered'] = $this->register_surat_model->surat_keluar_registered();
			$data['unregistered'] = $this->register_surat_model->surat_keluar_unregistered();
			$data['list'] = $this->register_surat_model->get_page_surat_keluar($start,$end,$nomer_surat,$hal,$mulai,$summary_field,$summary_value);
			if(!empty($summary_value)&&!empty($summary_field)){
				$data['summary_field'] = $summary_field;
				$data['summary_value'] = $summary_value;
			}

			$this->load->view('admin/index',$data);
		}
		else
		{
			redirect('admin');
		}
	}

	public function detail($id_surat_keluar){
		if ($this->user_id)
		{
			$this->filter_register($id_surat_keluar);
			$data['title']		= "Registrasi Surat Keluar - Admin ";
			$data['content']	= "register_surat/detail" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "surat keluar";
			$data['detail'] = $this->surat_keluar_model->get_detail_by_id($id_surat_keluar);
			if(!empty($_POST)){
				$up = $_POST;
				$up['status_register'] = 'Sudah Diregistrasi';
				$up['tgl_register'] = date('Y-m-d');
				$up['id_pegawai_register'] = $this->session->userdata('id_pegawai');
				$this->surat_keluar_model->update_surat_keluar($up,$id_surat_keluar);
				$this->register_surat_model->kirim_surat($id_surat_keluar);
				$data['message'] = "Surat telah berhasil diregistrasi";
				$data['type'] = "success";


				$detail = $this->surat_keluar_model->get_detail_by_id($id_surat_keluar);
				$log_data = array(
					'action' => 'melakukan',
					'function' => 'register surat',
					'key_name' => 'nomor registrasi sistem',
					'key_value' => $detail->hash_id ,
					'category' => $this->uri->segment(1),
				);
				$this->logs_model->insert_log($log_data);

				$params = array('surat_keluar_tembusan.id_surat_keluar' => $id_surat_keluar);
				$tembusan = $this->surat_keluar_model->get_surat_tembusan($params);
				$app_tokenArr = array();

				require(APPPATH.'libraries/PushNotification/Firebase.php');
				$judul = "Tembusan";
				$pesan = "Perihal : ".$tembusan[0]->perihal;
				$click_action = "tembusan";
				$data_id = $id_surat_keluar;
				$file = "";
				$file_verifikasi = "";
				$file_draft = "";
				$id_surat_keluar_tembusan = "";

				if($data["detail"]->jenis_surat=="internal")
					$file = base_url()."data/surat_internal/ttd/".$data['detail']->file_ttd;
				else
					$file = base_url()."data/surat_eksternal/ttd/".$data['detail']->file_ttd;

				$data_ = array(
					'tanggal'	=> $data['detail']->tgl_surat,
					'file'		=> $file,
					'perihal'	=> $data['detail']->perihal,
					'jenis'		=> $data['detail']->jenis_surat,
					'id_surat_keluar'	=> $id_surat_keluar,
					'file_verifikasi'	=> $file_verifikasi,
					'file_draft'		=> $file_draft,
								//'id_surat_keluar_tembusan' => $id_surat_keluar_tembusan,
								//'status'			=> strtoupper(str_replace("_", " ", $data['detail']->status_ttd)),

				);
				$firebase = new Firebase();
				foreach ($tembusan as $row) {
					if($row->app_token != null)
					{
						$data_['id_surat_keluar_tembusan'] = $row->id_surat_keluar_tembusan;
						$raw_data = json_encode($data_);

						$respone = $firebase->send($row->app_token, $judul, $pesan,$click_action,$data_id,$raw_data);
					}
				}

			}


			$data['penerima'] = $this->surat_keluar_model->get_penerima($id_surat_keluar);

			$this->load->view('admin/index',$data);
		}
		else
		{
			redirect('admin');
		}
	}



	public function surat_keluar(){

		if ($this->user_id)
		{
			$data['title']		= "Data Surat - Admin ";
			$data['content']	= "laporan_surat/surat_keluar" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "laporan_surat";

			$data['surat_keluar'] = $this->laporan_surat_model->data_surat_keluar();

			$this->load->view('admin/index',$data);
		}
		else
		{
			redirect('admin');
		}
	}


	public function grafik_surat(){

		if ($this->user_id)
		{
			$data['title']		= "Grafik Surat - Admin ";
			$data['content']	= "laporan_surat/grafik_surat" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "laporan_surat";

			$this->load->view('admin/index',$data);
		}
		else
		{
			redirect('admin');
		}
	}



	public function filter_register($id=''){
		if($id!==''){
			$data['detail'] = $this->surat_keluar_model->get_detail_by_id($id);

			if(empty($data['detail'])){
				show_404();
			}
		}
		if($this->user_level!=="Administrator"){
			if(!in_array('tu_pimpinan', $this->user_privileges)){
				show_404();
			}
		}
	}

}
