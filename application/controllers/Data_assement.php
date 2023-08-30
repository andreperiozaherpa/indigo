<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_assement extends CI_Controller {
	public $user_id;
	public function __construct(){
		parent ::__construct();
		$this->user_id = $this->session->userdata('user_id');
		$this->load->model('user_model');
		$this->load->model('master_pegawai_model');
		$this->load->model('verifikasi_data_pegawai_model');
		$this->load->model('ref_skpd_model');
		$this->load->model('dashboard_model', 'dm');
		$this->load->model('kegiatan_model', 'km');
		$this->load->model('kegiatan_personal_model', 'kpm');
		$this->load->model('realisasi_kegiatan_model', 'rkm');
		$this->load->model('pegawai_model');
		$this->user_model->user_id = $this->user_id;
		$this->user_model->set_user_by_user_id();
		$this->id_pegawai	= $this->user_model->id_pegawai;
		$this->user_picture = $this->user_model->user_picture;
		$this->full_name	= $this->user_model->full_name;
		$this->user_level	= $this->user_model->level;
		$this->foto_pegawai = $this->user_model->foto_pegawai;
		$this->level_id	= $this->user_model->level_id;
	}

	public function index($summary_field='',$summary_value='')
	{
		if ($this->user_id)
		{


			$data['title']		= "Data Assement - Admin ";
			$data['content']	= "data_assement/index" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu']		= 'data_assement';

			$hal = 6;
			$page = isset($_GET["page"]) ? (int)$_GET["page"] : 1;
			$mulai = ($page>1) ? ($page * $hal) - $hal : 0;
			$total = count($this->verifikasi_data_pegawai_model->get_pages($summary_field,$summary_value));
			$data['pages'] = ceil($total/$hal);
			$data['current'] = $page;
			if(!empty($_POST)){
				$filter = $_POST;
				$nip = $_POST['nip'];
				$nama = $_POST['nama_lengkap'];
				$skpd = $_POST['id_skpd'];
				$data['filter'] = true;
				$data['filter_data'] = $_POST;
				$data['nip'] = $_POST['nip'];
				$data['nama_lengkap'] = $_POST['nama_lengkap'];
				$data['id_skpd'] = $_POST['id_skpd'];
			}else{
				$filter = '';
				$nip = '';
				$nama = '';
				$skpd = '';
				$data['filter'] = false;
			}
			// $data['total_pegawai'] = $this->verifikasi_data_pegawai_model->get_total_pegawai();
			// $data['total_pegawai_true'] = $this->verifikasi_data_pegawai_model->get_total_pegawai_true();
			// $data['total_pegawai_process'] = $this->verifikasi_data_pegawai_model->get_total_pegawai_process();
			// $data['total_pegawai_false'] = $this->verifikasi_data_pegawai_model->get_total_pegawai_false();

			if(!empty($summary_value)&&!empty($summary_field)){
				$data['summary_field'] = $summary_field;
				$data['summary_value'] = $summary_value;
			}

			if($this->user_level=='Operator'){

				$data['list'] = $this->verifikasi_data_pegawai_model->get_page($mulai,$hal,$nama,$nip,$skpd,$summary_field='',$summary_value='',array('pegawai.id_skpd'=>$this->session->userdata('id_skpd')));
			}else{
				$data['list'] = $this->verifikasi_data_pegawai_model->get_page($mulai,$hal,$nama,$nip,$skpd,$summary_field,$summary_value);
			}
			$data['skpd'] = $this->ref_skpd_model->get_all();

			$this->load->view('admin/index',$data);


		}
		else
		{
			redirect('admin');
		}
	}

	public function details()
	{
		if ($this->user_id)
		{
			$data['title']		= "Details User";
			$data['content']	= "data_assement/views" ;
			$data['user_picture'] = $this->user_picture;
			$data['foto_pegawai'] = $this->foto_pegawai;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['user_id'] = $this->id_pegawai;
			$data['active_menu'] = "dashboard_user";


			$this->load->view('admin/index',$data);

		}
		else
		{
			redirect('admin');
		}
	}

	public function simulasi()
	{
		if ($this->user_id)
		{
			$data['title']		= "Simulasi 9 Box";
			$data['content']	= "data_assement/simulasi" ;
			$data['user_picture'] = $this->user_picture;
			$data['foto_pegawai'] = $this->foto_pegawai;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['user_id'] = $this->id_pegawai;
			$data['active_menu'] = "dashboard_user";


			$this->load->view('admin/index',$data);

		}
		else
		{
			redirect('admin');
		}
	}

	public function verifikasi_data_pegawai($id_pegawai=0)
	{
		if ($this->user_id && !empty($id_pegawai) && $id_pegawai>0)
		{

			$data['title']		= "Master Pegawai - Admin ";
			$data['content']	= "master_pegawai/verifikasi_data_pegawai" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu']		= 'master_pegawai';

			$this->load->view('admin/index',$data);

		}
		else
		{
			redirect('admin');
		}
	}

}
?>
