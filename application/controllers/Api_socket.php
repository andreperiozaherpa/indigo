<?php

use ElephantIO\Client;
use ElephantIO\Engine\SocketIO\Version2X;

class Api_socket extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('socketio', array('host' => "e-office.sumedangkab.go.id", 'port' => 3000));
	}
	public function index()
	{
		$this->emit('refresh_notification', array('user_id' => 1234));
	}

	public function ehehe()
	{
		echo date('H:i:s');
		die;
		$this->load->model('surat_keluar_model');

		$detail = $this->surat_keluar_model->get_detail_by_id(594);
		print_r($detail);
	}

	public function emit($name, $notif_data)
	{

		$client = new Client(new Version2X('https://localhost:3000', ['context' => ['ssl' => ['verify_peer_name' => false, 'verify_peer' => false]]]));
		$client->initialize();
		$client->emit($name, $notif_data);
		$client->close();
	}

	public function tes()
	{
		$url =  'http://127.0.0.1/api_socket/send';
		$post = array('name' => 'refresh_notification', 'notif_data' => array('user_id' => 1234));
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));
		$response = curl_exec($ch);
		curl_close($ch);
		echo $response;
	}
	public function send()
	{
		// echo "whoooooo";
		if (!empty($_POST)) {
			$name = $_POST['name'];
			$notif_data = $_POST['notif_data'];
			// print_r($_POST);
			$a = $this->socketio->send($name, $notif_data);
		}
	}

	function do_curl($name, $notif_data)
	{
		$url =  'http://127.0.0.1/api_socket/send';
		// return $url;
		$post = array('name' => $name, 'notif_data' => $notif_data);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));
		$response = curl_exec($ch);
		curl_close($ch);
		echo $response;
	}


	public function set_kepala_kecamatan()
	{
		// $this->db->like('jabatan','Camat%!','none',false);
		// $this->db->like('nama_skpd','Kecamatan');
		// $this->db->join('ref_skpd','ref_skpd.id_skpd = pegawai.id_skpd');
		$query = $this->db->query("SELECT * FROM `pegawai` JOIN `ref_skpd` ON `ref_skpd`.`id_skpd` = `pegawai`.`id_skpd` WHERE jabatan LIKE 'Camat%' ESCAPE '!' AND `nama_skpd` LIKE '%Kecamatan%' ESCAPE '!'")->result();
		foreach ($query as $q) {
			if ($q->kepala_skpd == '') {
				$this->db->update('pegawai', array('kepala_skpd' => 'Y'), array('id_pegawai' => $q->id_pegawai));
				// break;
			}
		}
		print_r($query);
	}

	public function get_surat_duplikat()
	{
		$query = $this->db->query('SELECT *, COUNT(*) jml_surat FROM surat_masuk GROUP BY nomer_surat,id_pegawai_penerima HAVING jml_surat > 1')->result();
		print_r($query);
		// foreach($query as $q){
		// 	$nomer_surat = $q->nomer_surat;
		// 	$id_pegawai_penerima = $q->id_pegawai_penerima;
		// 	$get = $this->db->get_where('surat_masuk',array('nomer_surat'=>$nomer_surat,'id_pegawai_penerima'=>$id_pegawai_penerima))->result();
		// 	foreach($get as $k => $v){
		// 		if($k!==0){
		// 			$this->db->delete('surat_masuk',array('id_surat_masuk'=>$v->id_surat_masuk));
		// 		}
		// 	}
		// 	// break;
		// }

	}

	public function cek_hash($hash)
	{
		echo generate_hash($hash);
	}

	public function uptd()
	{
		if (!empty($_POST)) {
			foreach ($_POST['id_skpd'] as $k => $id_skpd) {
				$id_induk = $_POST['id_induk'][$k];
				if ($id_induk !== '') {
					$this->db->update('ref_skpd', array('id_skpd_induk' => $id_induk), array('id_skpd' => $id_skpd));
				}
			}
		}
		$this->load->view('uptd');
	}

	public function puskesmas()
	{

		$puskesmas = $this->db->get_where('ref_skpd', array('jenis_skpd' => 'puskesmas'))->result();
		$uptd = $this->db->get_where('ref_skpd', array('jenis_skpd' => 'uptd'))->result();
		$e = array_merge($uptd, $puskesmas);
		foreach ($e as $u) {
			echo $u->nama_skpd . "<br>";
			// $this->db->insert('ref_unit_kerja',array('id_skpd'=>$u->id_skpd,'id_induk'=>0,'level_unit_kerja'=>1,'nama_unit_kerja'=>'Sub Bagian Tata Usaha'));
		}
	}

	public function kelurahan()
	{

		$kelurahan = $this->db->get_where('ref_skpd', array('jenis_skpd' => 'kelurahan'))->result();
		foreach ($kelurahan as $u) {
			echo $u->nama_skpd . "<br>";
			// $this->db->insert('ref_unit_kerja',array('id_skpd'=>$u->id_skpd,'id_induk'=>0,'level_unit_kerja'=>1,'nama_unit_kerja'=>'Sekretaris'));
			// $id_sekretaris = $this->db->insert_id();
			// $this->db->insert('ref_unit_kerja',array('id_skpd'=>$u->id_skpd,'id_induk'=>$id_sekretaris,'level_unit_kerja'=>2,'nama_unit_kerja'=>'Seksi Sosial'));
			// $this->db->insert('ref_unit_kerja',array('id_skpd'=>$u->id_skpd,'id_induk'=>$id_sekretaris,'level_unit_kerja'=>2,'nama_unit_kerja'=>'Seksi Pemerintahan, Ketentraman dan Ketertiban'));
			// $this->db->insert('ref_unit_kerja',array('id_skpd'=>$u->id_skpd,'id_induk'=>$id_sekretaris,'level_unit_kerja'=>2,'nama_unit_kerja'=>'Seksi Ekonomi dan Pembangunan'));
		}
	}

	public function et()
	{
		session_start();

		ini_set('max_execution_time', 0); // to get unlimited php script execution time

		if (empty($_SESSION['i'])) {
			$_SESSION['i'] = 0;
		}

		$total = 100;
		for ($i = $_SESSION['i']; $i < $total; $i++) {
			$_SESSION['i'] = $i;
			$percent = intval($i / $total * 100) . "%";

			sleep(1); // Here call your time taking function like sending bulk sms etc.
			echo $percent;

			ob_flush();
			flush();
		}
		echo 'complete';

		session_destroy();
	}
}
