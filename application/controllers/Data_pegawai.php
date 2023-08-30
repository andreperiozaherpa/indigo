<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_pegawai extends CI_Controller {
	public $user_id;

	public function __construct(){
		parent ::__construct();
		$this->user_id = $this->session->userdata('user_id');
		$this->load->model('user_model');
		$this->load->model('bkd_model');
		$this->user_model->user_id = $this->user_id;
		$this->user_model->set_user_by_user_id();
		$this->user_picture = $this->user_model->user_picture;
		$this->full_name	= $this->user_model->full_name;
		$this->user_level	= $this->user_model->level;
		if ($this->user_level=="Admin Web");

		//$this->load->model('Ref_renstra','ref_kode_kegiatan_m');
	}

	public function index()
	{
		if ($this->user_id)
		{
			$data['title']		= "Bkd - Admin ";
			$data['content']	= "bkd/index" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "bkd";

			$hal = 20;
			$page = isset($_GET["page"]) ? (int)$_GET["page"] : 1;
			$mulai = ($page>1) ? ($page * $hal) - $hal : 0;
			$total = count($this->bkd_model->get_all());
			$data['pages'] = ceil($total/$hal);
			$data['current'] = $page;
			if(!empty($_POST)){
				$filter = $_POST;
				$nip = $_POST['nip'];
				$nama = $_POST['nama_lengkap'];
				$data['filter'] = true;
				$data['filter_data'] = $_POST;
				$data['nip'] = $_POST['nip'];
				$data['nama_lengkap'] = $_POST['nama_lengkap'];
			}else{
				$filter = '';
				$nip = '';
				$nama = '';
				$data['filter'] = false;
			}
			$data['list'] = $this->bkd_model->get_page($mulai,$hal,$nama,$nip);

			$data['last_update'] = $this->bkd_model->last_update_bkd();
			$data['total_pegawai'] = $this->bkd_model->get_total_pegawai();
			$data['total_perempuan'] = $this->bkd_model->get_total_perempuan();
			$data['total_laki'] = $this->bkd_model->get_total_laki();
			$this->load->view('admin/index',$data);

		}
		else
		{
			redirect('admin');
		}
	}

	public function update()
	{
		if($this->user_id)
		{

	//hapus semua record
			$this->db->truncate('data_bkd');

			$url = 'http://124.158.175.50/publik/public/pegawai?key=208c462feb15040fc75fcb951c74e87a7f850f97a7ee933a362edca77f7ab744';
			$content = file_get_contents($url);
			$json = json_decode($content, true);
			for($i=0; $i<count($json); $i++)
			{

				$insert['nip'] = $json[$i]['nip'];
				$insert['nama_lengkap']= $json[$i]['nama_lengkap'];
				$insert['temlahir']= $json[$i]['temlahir'];
				$insert['tgllahir']= $json[$i]['tgllahir'];
				$insert['lulus']= $json[$i]['lulus'];
				$insert['jurusan']= $json[$i]['jurusan'];
				$insert['lembaga']= $json[$i]['lembaga'];
				$insert['tmtpang']= $json[$i]['tmtpang'];
				$insert['tmtcpns']= $json[$i]['tmtcpns'];
				$insert['tmtpns']= $json[$i]['tmtpns'];
				$insert['tmtjab']= $json[$i]['tmtjab'];
				$insert['nss']= $json[$i]['nss'];
				$insert['unit']= $json[$i]['unit'];
				$insert['dudukpeg']= $json[$i]['dudukpeg'];
				$insert['usia']= $json[$i]['usia'];
				$insert['masakerja']= $json[$i]['masakerja'];
				$insert['jenis_jabatan']= $json[$i]['jenis_jabatan'];
				$insert['nama_eselon']= $json[$i]['nama_eselon'];
				$insert['agama']= $json[$i]['agama'];
				$insert['kawin']= $json[$i]['kawin'];
				$insert['tingkat']= $json[$i]['tingkat'];
				$insert['kelamin']= $json[$i]['kelamin'];
				$insert['pendidikan']= $json[$i]['pendidikan'];
				$insert['gol']= $json[$i]['gol'];
				$insert['nama_dudukpeg']= $json[$i]['nama_dudukpeg'];
				$insert['pangkat']= $json[$i]['pangkat'];
				$insert['nama_jabatan']= $json[$i]['nama_jabatan'];
				$insert['nama_statuspeg']= $json[$i]['nama_statuspeg'];
				$insert['unitkerja']= $json[$i]['unitkerja'];
				$insert['tgl_update']= date("Y-m-d H:i:s");

				$in = $this->bkd_model->insert($insert);
			}


		}
		else {
			redirect('admin');
		}





	}

	public function preview()
	{
		$url = 'http://124.158.175.50/publik/public/pegawai?key=208c462feb15040fc75fcb951c74e87a7f850f97a7ee933a362edca77f7ab744';
		$content = file_get_contents($url);
    // $json = json_decode($content, true);
		$json = json_encode(json_decode($content), JSON_PRETTY_PRINT);
		echo "<pre>{$json}</pre>";
    // echo $json;
	}

	public function total()
	{
		$url = 'http://124.158.175.50/publik/public/pegawai?key=208c462feb15040fc75fcb951c74e87a7f850f97a7ee933a362edca77f7ab744';
		$content = file_get_contents($url);
    // $json = json_decode($content, true);
		$json = count(json_decode($content));
		echo "<pre>{$json}</pre>";
    // echo $json;
	}

	public function get_pegawai($nip){
		$get = $this->db->get_where('data_bkd',array('nip'=>$nip))->row();
		$data['nip'] = $get->nip;
		$data['nama'] = $get->nama_lengkap;
		$jabatan = $get->nama_jabatan;
		$j = explode(" pada ", $jabatan);
		$data['jabatan'] = $j[0];
		if(isset($j[1])){
			$data['unit_kerja'] = $j[1];
		}else{
			$data['unit_kerja'] = '';
		}
		$data['skpd'] = $get->unitkerja;

		print_r($data);

	}


}
?>
