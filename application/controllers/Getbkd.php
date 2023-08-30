<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Getbkd extends CI_Controller {
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

	public function migrate(){
		$get = $this->db->get('data_bkd')->result();
		$n=0;
		foreach($get as $k => $g){
			$skpd = $g->unitkerja;
			if(strpos($skpd, "Kecamatan") !== false ){
				$skpd = "Sekretariat ".$skpd;
			}
			$search_id = $this->db->get_where('ref_skpd',array('nama_skpd'=>$skpd))->row();
			if($search_id){
				$id_skpd = $search_id->id_skpd;
			}else{
				$id_skpd = "NULL";
			}
			$check_pegawai = $this->db->get_where('pegawai2',array('nip'=>$g->nip))->row();
			if($check_pegawai){
				$peg = false;
			}else{
				$peg = true;
			}
			$jabatan = explode(' pada ', $g->nama_jabatan)[0];
			if(strpos($jabatan,"Kepala") !== false ){
				$jenis_pegawai = "kepala";
			}else{
				$jenis_pegawai = "staff";
			}
			if(strpos($jabatan, "Kepala ".$skpd) !== false ){
				$kepala_skpd = "Y";
			}else{
				$kepala_skpd = NULL;
			}
			if($id_skpd!=="NULL" && $peg){
				$det_pegawai = array(
					'nip'=>$g->nip,
					'nama_lengkap'=>$g->nama_lengkap,
					'jenis_pegawai'=>$jenis_pegawai,
					'id_skpd'=>$id_skpd,
					'id_unit_kerja'=>0,
					'jabatan'=>$jabatan,
					'id_user'=>0,
					'kepala_skpd'=>$kepala_skpd,
					'foto_pegawai'=>'user-default.png',
					'golongan'=>$g->gol,
					'pangkat'=>$g->pangkat,
					'status'=>NULL,
					'status_verifikasi_data'=>'false'

				);
				echo "<pre>";
				print_r($det_pegawai);
				$in_pegawai = $this->db->insert('pegawai2',$det_pegawai);
				$id_pegawai = $this->db->insert_id();

				$det_user = array(
					'employee_id'=>0,
					'instansi_id'=>0,
					'unit_kerja_id'=>0,
					'id_pegawai'=>$id_pegawai,
					'kd_skpd'=>$id_skpd,
					'id_ketersediaan'=>1,
					'username'=>$g->nip,
					'password'=>md5($g->nip),
					'full_name'=>$g->nama_lengkap,
					'email'=>'',
					'phone'=>'',
					'bio'=>NULL,
					'certificate'=>NULL,
					'dot_key'=>NULL,
					'pass_key'=>NULL,
					'scan_ttd'=>NULL,
					'user_picture'=>'user_default.png',
					'user_level'=>2,
					'user_group_menu'=>NULL,
					'user_privileges'=>'default',
					'reg_date'=>date('Y-m-d H:i:s'),
					'user_status'=>'Active',
					'api_key'=>NULL,
					'app_token'=>NULL,

				);
				print_r($det_user);
				$in_user = $this->db->insert('user2',$det_user);
				$id_user = $this->db->insert_id();
				$up_pegawai = $this->db->update('pegawai2',array('id_user'=>$id_user),array('id_pegawai'=>$id_pegawai));
				echo "</pre>";
				echo "<hr>";
				$n++;
				if($n>1000){
					break;
				}
			}
		}
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

	public function get_data($nip){
		$get = file_get_contents("http://simpeg.sumedangkab.go.id/api/public/pegawai?key=050610");
		$data = json_decode($get);
		$key = array_search($nip, array_column($data, 'nip'));
		if(is_numeric($key)){
			echo json_encode($data[$key]);
		}else{
			echo json_encode(array('status'=>'Pegawai tidak ditemukan'));
		}
	}

	public function fetch_data_bkd(){
		$get = json_decode(file_get_contents("./pegawai.json"));
		$list_skpd = array();
		$list_jabatan = array();
		foreach($get as $g){
			if(empty($list_skpd[$g->kodeunitkerja])){
				if(trim($g->kodeunitkerja)!==""){
					$list_skpd[$g->kodeunitkerja] = $g->unitkerja;
				}
			}

			// echo $g->unitkerja." (".$g->kodeunitkerja.") -> ".$g->nama_jabatan."<br>";
			$list_jabatan[] = array('id_skpd'=>$g->kodeunitkerja,'nama_jabatan'=>$g->nama_jabatan);
		}
		
		$data = array();
		foreach($list_skpd as $k => $l){
			$jabatans = array();
			foreach($list_jabatan as $j){
				if($j['id_skpd']==$k){

					if(!in_array($j['nama_jabatan'],$jabatans)){
						if(trim($j['nama_jabatan'])!==''){
							$jabatans[] = $j['nama_jabatan'];
						}
					}

				}
			}
			$data[] = array('id_skpd'=>$k,'nama_skpd'=>$l,'jabatan'=>$jabatans);
		}
		
		// print_r($list_jabatan);
		print_r($data);
	}

	public function ass(){
		$new = $this->db->get('data_bkd2')->result();
		$a = 1;
		foreach($new as $key => $n){
			$get = $this->db->get_where('data_bkd',array('nip'=>$n->nip))->row();
			if($get){
				if($n->lulus==''){
					$update = array(
						'lulus' => $get->lulus,
						'jurusan' => $get->jurusan,
						'lembaga' => $get->lembaga,
						'tmtcpns' => $get->tmtcpns,
						'tmtpns' => $get->tmtpns,
						'tmtjab' => $get->tmtjab,
						'nss' => $get->nss,
						'unit' => $get->unit,
						'dudukpeg' => $get->dudukpeg,
						'usia' => $get->usia,
						'masakerja' => $get->masakerja,
						'nama_eselon' => $get->nama_eselon,
						'kawin' => $get->kawin,
						'nama_statuspeg' => $get->nama_statuspeg);
					$this->db->update('data_bkd2',$update,array('nip'=>$n->nip));
					$a++;
					echo $n->nip."<br>";
					if($a==1){
						die;
					}
				}
			}
		}
	}

	public function ehe(){
		$awal = $this->db->query('SELECT * FROM `surat_masuk` WHERE `id_pegawai_penerima` = 166')->result();
		foreach($awal as $a){
			unset($a->id_surat_masuk);
			$a->id_skpd_penerima = 13;
			$a->id_pegawai_penerima = 522;
			$a = (array) $a;
			// $this->db->insert('surat_masuk',$a);
			// print_r($a);
		}
		// print_r($awal);
	}



}
?>
