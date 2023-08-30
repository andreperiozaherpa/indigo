<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengumuman extends CI_Controller {
	public $user_id;

	public function __construct(){
		parent ::__construct();
		$this->user_id = $this->session->userdata('user_id');
		$this->load->model('user_model');
		$this->load->model('pengumuman_model', 'pm');
		$this->user_model->user_id = $this->user_id;
		$this->user_model->set_user_by_user_id();
		$this->user_picture = $this->user_model->user_picture;
		$this->full_name	= $this->user_model->full_name;
		$this->user_level	= $this->user_model->level;
		$this->id_pegawai	= $this->user_model->id_pegawai;
		$this->id_skpd = $this->user_model->id_skpd;
		if ($this->user_level=="Admin Web");

		//$this->load->model('Ref_renstra','ref_kode_kegiatan_m');
	}

	public function index()
	{
		if ($this->user_id)
		{
			$data['title']		= "Pengumuman - Admin ";
			$data['content']	= "pengumuman/index" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "pengumuman";
			$data['id_pegawai'] = $this->id_pegawai;
			$data['id_skpd'] = $this->id_skpd;

			$id_pegawai = $this->id_pegawai;
			$hal = 6;
			$page = isset($_GET["page"]) ? (int)$_GET["page"] : 1;
			$mulai = ($page>1) ? ($page * $hal) - $hal : 0;
			$total = count($this->pm->get_all($id_pegawai));
			$data['pages'] = ceil($total/$hal);
			$data['current'] = $page;
			if(!empty($_POST)){
				$filter = $_POST;
				$start = $_POST["start"];
				$end = $_POST["end"];
				$nama = $_POST['nama'];
				$data['filter'] = true;
				$data['start'] = $_POST['start'];
				$data['end'] = $_POST['end'];
				$data['nama'] = $_POST['nama'];
			}else{
				$start = '';
				$end = '';
				$nama = '';
				$data['filter'] = false;
			}

			$data['list'] = $this->pm->get_page($mulai,$hal,$start,$end,$nama,$id_pegawai);

			$data['pengumuman'] = $this->pm->get_all($id_pegawai);
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
			$data['title']		= "Tambah Pengumuman - Admin ";
			$data['content']	= "pengumuman/add" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "pengumuman";
			$data['id_pegawai'] = $this->id_pegawai;
			$data['id_skpd'] = $this->id_skpd;
			$this->load->model('ref_skpd_model');
			$data['skpd'] = $this->ref_skpd_model->get_all();
			if(isset($_POST['tombol_submit'])){
				unset($_POST['tombol_submit']);
				if(cekForm($_POST)){
					$data['message'] = "Masih ada data yang kosong";
					$data['type'] = "warning";
				}else{
					if(empty($_POST['id_skpd_tujuan'])){
						$_POST['id_skpd_tujuan'] = $this->id_skpd;
					}
					$this->pm->save($_POST);
					$this->session->set_flashdata('sukses', 'Data Berhasil Ditambah');

			// send notif
					$this->db->select("app_token");
					if($_POST['id_skpd_tujuan']!=='semua'){
						$this->db->where('id_skpd',$_POST['id_skpd_tujuan']);
						$this->db->join('pegawai','pegawai.id_user = user.user_id');
					}
					$this->db->where("app_token is not null");
					$token = $this->db->get("user")->result();
					$regIds = array();

					foreach ($token as $row) {
						$regIds[] = $row->app_token;
					}
            //var_dump($_POST);die;
					if(count($regIds)>0){
						require(APPPATH.'libraries/PushNotification/Firebase.php');
						$firebase = new Firebase();
						$title = "Pengumuman";
						$message = $_POST['isi_pengumuman'];
						$click_action = "";
						$data_id = "";
						$raw_data = "";

						$firebase->sendMulti($regIds, $title, $message,$click_action,$data_id,$raw_data);
					}
					redirect("pengumuman");
				}
			}

			$data['user_privileges'] = explode(";", $this->session->userdata('user_privileges'));
			$data['pegawai'] = $this->master_pegawai_model->get_by_id($this->id_pegawai);
			$this->load->view('admin/index',$data);

		}
		else
		{
			redirect('admin');
		}
	}

	public function ubah($id)
	{
		if ($this->user_id)
		{
			if ($id == "") {
				redirect('pengumuman');
			}
			$data['title']		= "Edit Pengumuman - Admin ";
			$data['content']	= "pengumuman/edit" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "pengumuman";
			$data['id_pegawai'] = $this->id_pegawai;
			$data['id_skpd'] = $this->id_skpd;
			$this->load->model('ref_skpd_model');
			$data['skpd'] = $this->ref_skpd_model->get_all();

			if(isset($_POST['update'])){
				$this->pm->update($_POST, $id);
				$this->session->set_flashdata('sukses', 'Data Berhasil Diedit');
				redirect("pengumuman");
			}
			$data['pengumuman'] = $this->pm->get_by_id($id);
			if(empty($data['pengumuman'])){
				show_404();
			}
			if($this->user_level!=="Administrator"){
				if($data['pengumuman']->id_pegawai!==$this->id_pegawai){
					show_404();
				}
			}
			$this->load->view('admin/index',$data);

		}
		else
		{
			redirect('admin');
		}
	}


	public function detail($id)
	{
		if ($this->user_id)
		{
			if ($id == "") {
				redirect('pengumuman');
			}
			$data['title']		= "Detail Pengumuman - Admin ";
			$data['content']	= "pengumuman/detail" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "pengumuman";

			$data['pengumuman'] = $this->pm->get_by_id($id);
			if(empty($data['pengumuman'])){
				show_404();
			}
			if($this->user_level!=="Administrator"){
				if($data['pengumuman']->id_pegawai!==$this->id_pegawai){
					show_404();
				}
			}
			$this->load->view('admin/index',$data);

		}
		else
		{
			redirect('admin');
		}
	}

	public function delete($id){
		$data['pengumuman'] = $this->pm->get_by_id($id);
		if(empty($data['pengumuman'])){
			show_404();
		}
		if($this->user_level!=="Administrator"){
			if($data['pengumuman']->id_pegawai!==$this->id_pegawai){
				show_404();
			}
		}
		$this->pm->delete($id);
		$this->session->set_flashdata('sukses', 'Data Berhasil Dihapus');
		redirect("pengumuman");
	}

	public function randomize(){
		$this->db->limit(6);
		$pegawai = $this->db->get_where('pegawai',array('id_skpd'=>16,'pensiun'=>0))->result();

		$array_pegawai = $pegawai;

		$menilaian = array();
		$count = array();
		$apr = array();

		foreach($pegawai as $p){
			$list_menilai = array();
			$apr = $array_pegawai;
			// print_r($apr);

			while(count($list_menilai)!=4){
				if (count($apr)==0) {
					break;
				}

				$random = array_rand($apr);
				$menilai = $pegawai[$random];

				if (!isset($pegawai[$random])) {
					echo $random;
					print_r($pegawai[$random]);die();
					break;
				}

				if (!array_key_exists($random, $count)) {
					$count[$random] = 0;
				}

				if ($menilai->id_pegawai!=$p->id_pegawai) {
					if (!in_array($menilai->id_pegawai, $list_menilai)) {
						unset($apr[$random]);
						$list_menilai[] = $menilai->id_pegawai;
						$count[$random]++;
						if ($count[$random]==4) {
							unset($array_pegawai[$random]);
						}
					} else {
						unset($apr[$random]);
					}
				} else {
					unset($apr[$random]);
				}
			}

			$menilaian[] = array('id_pegawai'=>$p->id_pegawai,'menilai'=>$list_menilai);

		}

		echo "<pre>";
		print_r($menilaian);
	}

	public function randomize2(){
		$this->db->limit(5);
		$pegawai = $this->db->get_where('pegawai',array('id_skpd'=>16,'pensiun'=>0))->result();

		$menilaian = array();

		foreach($pegawai as $p){
			$list_menilai = array();

			$selected = array();

			while(count($list_menilai)!=4){

				// if(in_array($list_menilai))
				
				$menilai = $pegawai[rand(0,count($pegawai)-1)];

				$selected[] = $menilai->id_pegawai;
				if(count($selected)==count($pegawai)){
					break;
				}

				if(!in_array($menilai->id_pegawai,$list_menilai)){
					if($menilai->id_pegawai!==$p->id_pegawai){

						$count = 0;
						foreach($menilaian as $pp){
							foreach($pp['menilai'] as $pe){
								if($menilai->id_pegawai==$pe){
									$count++;
								}
							}
						}						

						if($count!=4){
							// echo $count;
							$list_menilai[] = $menilai->id_pegawai;
						}
					}
				}

			}

			$menilaian[] = array('id_pegawai'=>$p->id_pegawai,'menilai'=>$list_menilai);

		}

		print_r($menilaian);
	}


}
?>
