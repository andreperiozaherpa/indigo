<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Surat_masuk_model extends CI_Model
{
	public $id_surat_masuk;
	public $jenis_surat;
	public $indeks;
	public $kode;
	public $no_urut;
	public $perihal;
	public $pengirim;
	public $tanggal_surat;
	public $nomer_surat;
	public $sifat;
	public $lokasi_smpl;
	public $lokasi_box;
	public $lokasi_rak;
	public $isi_ringkasan;
	public $file_surat;
	public $lampiran;
	public $catatan;
	public $id_pegawai;
	public $tgl_buat;
	public $status_surat;
	public $id_skpd_penerima;
	public $id_unitkerja_penerima;
	public $id_pegawai_penerima;

	public $user_data;

	public function __construct()
	{
		require_once(APPPATH.'libraries/PushNotification/Firebase.php');
		$this->firebase = new Firebase();
		$this->user_data = array();
	}

	//Surat Eksternal
	public function insert_surat_masuk_ekternal()
	{
		$this->db->set('jenis_surat',$this->jenis_surat);
		$this->db->set('indeks',$this->indeks);
		$this->db->set('kode',$this->kode);
		$this->db->set('no_urut',$this->no_urut);
		$this->db->set('perihal',$this->perihal);
		$this->db->set('pengirim',$this->pengirim);
		$this->db->set('tanggal_surat',$this->tanggal_surat);
		$this->db->set('nomer_surat',$this->nomer_surat);
		$this->db->set('sifat',$this->sifat);
		$this->db->set('isi_ringkasan',$this->isi_ringkasan);
		$this->db->set('lokasi_smpl',$this->lokasi_smpl);
		$this->db->set('lokasi_box',$this->lokasi_box);
		$this->db->set('lokasi_rak',$this->lokasi_rak);
		$this->db->set('file_surat',$this->file_surat);
		$this->db->set('catatan',$this->catatan);
		$this->db->set('lampiran',$this->lampiran);
		$this->db->set('id_pegawai_input',$this->id_pegawai_input);
		$this->db->set('tgl_input',$this->tgl_input);
		$this->db->set('status_surat',$this->status_surat);
		$this->db->set('id_skpd_penerima',$this->id_skpd_penerima);
		$this->db->set('id_unitkerja_penerima',$this->id_unitkerja_penerima);
		$this->db->set('id_pegawai_penerima',$this->id_pegawai_penerima);
		$this->db->insert('surat_masuk');
	}

	public function get_urutan_surat($id_skpd){
		$this->db->where('id_skpd_penerima',$id_skpd);
		$this->db->where('jenis_surat','eksternal');
		$get = $this->db->get('surat_masuk');
		if($get->num_rows()==0){
			$nomor_urut = 1;
		}else{
			$fetch = $get->result();
			$nomor_urut = end($fetch)->no_urut;
			$available = false;
			while($available==false){
				$nomor_urut++;
				$this->db->where('no_urut',$nomor_urut);
				$cek = $this->db->get('surat_masuk')->num_rows();
				if($cek==0){
					$available = true;
				}
			}

		}
		return $nomor_urut;
	}

	public function filter_user($menu=null)
	{
		if($this->user_data)
		{
			$user_data = $this->user_data;
			$this->db->group_start();
			$this->db->group_start();
			$this->db->where('surat_masuk.id_pegawai_input', $user_data['id_pegawai']);
			$this->db->where('surat_masuk.hash_id is null');
			$this->db->group_end();
			// $this->db->group_start();
			$this->db->or_where('surat_masuk.id_pegawai_penerima', $user_data['id_pegawai']);
			// $this->db->or_where('surat_masuk.indeks !=', NULL);
			// $this->db->group_end();
			$this->db->group_end();
		}
		else if($this->session->userdata('level')!='Administrator'){
			$this->db->group_start();
			$this->db->group_start();
			$this->db->where('surat_masuk.id_pegawai_input', $this->session->userdata('id_pegawai'));
			$this->db->where('surat_masuk.hash_id is null');
			$this->db->group_end();
			// $this->db->group_start();
			$this->db->or_where('surat_masuk.id_pegawai_penerima', $this->session->userdata('id_pegawai'));
			// $this->db->or_where('surat_masuk.indeks !=', NULL);
			// $this->db->group_end();
			$this->db->group_end();
		}
	}

	public function get_all_eksternal(){
		$this->db->where('jenis_surat', "eksternal");
		$this->filter_user();
		$query = $this->db->get('surat_masuk');
		return $query->result();
	}

	public function get_all_eksternal_unread(){
		$this->db->where('jenis_surat', "eksternal");
		$this->db->where('status_surat', "Belum Dibaca");
		$this->filter_user();
		$query = $this->db->get('surat_masuk');
		return $query->result();
	}

	public function get_all_eksternal_read(){
		$this->db->where('jenis_surat', "eksternal");
		$this->db->where('status_surat', "Sudah Dibaca");
		$this->filter_user();
		$query = $this->db->get('surat_masuk');
		return $query->result();
	}

	public function get_all_eksternal_mustread(){
		$this->db->where('jenis_surat', "eksternal");
		$this->db->where('status_surat', "Perlu Tanggapan");
		$this->filter_user();
		$query = $this->db->get('surat_masuk');
		return $query->result();
	}

	public function get_all_eksternal_unsign(){
		$this->db->where('jenis_surat', "eksternal");
		$this->db->where('status_ttd', "Belum tanda tangan");
		$this->filter_user();
		$query = $this->db->get('surat_masuk');
		return $query->result();
	}

	public function get_all_eksternal_signed(){
		$this->db->where('jenis_surat', "eksternal");
		$this->db->where('status_ttd', "Sudah tanda tangan");
		$this->filter_user();
		$query = $this->db->get('surat_masuk');
		return $query->result();
	}

	public function get_all_eksternal_mustsign(){
		$this->db->where('jenis_surat', "eksternal");
		$this->db->where('status_ttd', "Perlu Tanggapan");
		$this->filter_user();
		$query = $this->db->get('surat_masuk');
		return $query->result();
	}

	public function get_all_eksternal_unverif(){
		$this->db->where('jenis_surat', "eksternal");
		$this->db->where('status_verifikasi', "Belum Diverifikasi");
		$this->filter_user();
		$query = $this->db->get('surat_masuk');
		return $query->result();
	}

	public function get_all_eksternal_verifed(){
		$this->db->where('jenis_surat', "eksternal");
		$this->db->where('status_verifikasi', "Sudah Diverifikasi");
		$this->filter_user();
		$query = $this->db->get('surat_masuk');
		return $query->result();
	}

	public function get_all_eksternal_grafik_jan($year, $id_skpd){
		$this->db->select('MONTH(tanggal_surat) as bln, COUNT(tanggal_surat) as total');
		$this->db->where('YEAR(tanggal_surat)', $year);
		$this->db->where('jenis_surat', "eksternal");
		$this->db->where('MONTH(tanggal_surat)', 1);
		$this->db->where('id_skpd_penerima', $id_skpd);
		$query = $this->db->get('surat_masuk');
		return $query->row_array();
	}
	public function get_all_eksternal_grafik_feb($year, $id_skpd){
		$this->db->select('MONTH(tanggal_surat) as bln, COUNT(tanggal_surat) as total');
		$this->db->where('YEAR(tanggal_surat)', $year);
		$this->db->where('jenis_surat', "eksternal");
		$this->db->where('MONTH(tanggal_surat)', 2);
		$this->db->where('id_skpd_penerima', $id_skpd);
		$query = $this->db->get('surat_masuk');
		return $query->row_array();
	}
	public function get_all_eksternal_grafik_mar($year, $id_skpd){
		$this->db->select('MONTH(tanggal_surat) as bln, COUNT(tanggal_surat) as total');
		$this->db->where('YEAR(tanggal_surat)', $year);
		$this->db->where('jenis_surat', "eksternal");
		$this->db->where('MONTH(tanggal_surat)', 3);
		$this->db->where('id_skpd_penerima', $id_skpd);
		$query = $this->db->get('surat_masuk');
		return $query->row_array();
	}
	public function get_all_eksternal_grafik_apr($year, $id_skpd){
		$this->db->select('MONTH(tanggal_surat) as bln, COUNT(tanggal_surat) as total');
		$this->db->where('YEAR(tanggal_surat)', $year);
		$this->db->where('jenis_surat', "eksternal");
		$this->db->where('MONTH(tanggal_surat)', 4);
		$this->db->where('id_skpd_penerima', $id_skpd);
		$query = $this->db->get('surat_masuk');
		return $query->row_array();
	}
	public function get_all_eksternal_grafik_mei($year, $id_skpd){
		$this->db->select('MONTH(tanggal_surat) as bln, COUNT(tanggal_surat) as total');
		$this->db->where('YEAR(tanggal_surat)', $year);
		$this->db->where('jenis_surat', "eksternal");
		$this->db->where('MONTH(tanggal_surat)', 5);
		$this->db->where('id_skpd_penerima', $id_skpd);
		$query = $this->db->get('surat_masuk');
		return $query->row_array();
	}
	public function get_all_eksternal_grafik_jun($year, $id_skpd){
		$this->db->select('MONTH(tanggal_surat) as bln, COUNT(tanggal_surat) as total');
		$this->db->where('YEAR(tanggal_surat)', $year);
		$this->db->where('jenis_surat', "eksternal");
		$this->db->where('MONTH(tanggal_surat)', 6);
		$this->db->where('id_skpd_penerima', $id_skpd);
		$query = $this->db->get('surat_masuk');
		return $query->row_array();
	}
	public function get_all_eksternal_grafik_jul($year, $id_skpd){
		$this->db->select('MONTH(tanggal_surat) as bln, COUNT(tanggal_surat) as total');
		$this->db->where('YEAR(tanggal_surat)', $year);
		$this->db->where('jenis_surat', "eksternal");
		$this->db->where('MONTH(tanggal_surat)', 7);
		$this->db->where('id_skpd_penerima', $id_skpd);
		$query = $this->db->get('surat_masuk');
		return $query->row_array();
	}
	public function get_all_eksternal_grafik_agu($year, $id_skpd){
		$this->db->select('MONTH(tanggal_surat) as bln, COUNT(tanggal_surat) as total');
		$this->db->where('YEAR(tanggal_surat)', $year);
		$this->db->where('jenis_surat', "eksternal");
		$this->db->where('MONTH(tanggal_surat)', 8);
		$this->db->where('id_skpd_penerima', $id_skpd);
		$query = $this->db->get('surat_masuk');
		return $query->row_array();
	}
	public function get_all_eksternal_grafik_sep($year, $id_skpd){
		$this->db->select('MONTH(tanggal_surat) as bln, COUNT(tanggal_surat) as total');
		$this->db->where('YEAR(tanggal_surat)', $year);
		$this->db->where('jenis_surat', "eksternal");
		$this->db->where('MONTH(tanggal_surat)', 9);
		$this->db->where('id_skpd_penerima', $id_skpd);
		$query = $this->db->get('surat_masuk');
		return $query->row_array();
	}
	public function get_all_eksternal_grafik_okt($year, $id_skpd){
		$this->db->select('MONTH(tanggal_surat) as bln, COUNT(tanggal_surat) as total');
		$this->db->where('YEAR(tanggal_surat)', $year);
		$this->db->where('jenis_surat', "eksternal");
		$this->db->where('MONTH(tanggal_surat)', 10);
		$this->db->where('id_skpd_penerima', $id_skpd);
		$query = $this->db->get('surat_masuk');
		return $query->row_array();
	}
	public function get_all_eksternal_grafik_nov($year, $id_skpd){
		$this->db->select('MONTH(tanggal_surat) as bln, COUNT(tanggal_surat) as total');
		$this->db->where('YEAR(tanggal_surat)', $year);
		$this->db->where('jenis_surat', "eksternal");
		$this->db->where('MONTH(tanggal_surat)', 11);
		$this->db->where('id_skpd_penerima', $id_skpd);
		$query = $this->db->get('surat_masuk');
		return $query->row_array();
	}
	public function get_all_eksternal_grafik_des($year, $id_skpd){
		$this->db->select('MONTH(tanggal_surat) as bln, COUNT(tanggal_surat) as total');
		$this->db->where('YEAR(tanggal_surat)', $year);
		$this->db->where('jenis_surat', "eksternal");
		$this->db->where('MONTH(tanggal_surat)', 12);
		$this->db->where('id_skpd_penerima', $id_skpd);
		$query = $this->db->get('surat_masuk');
		return $query->row_array();
	}

	public function get_all_internal_grafik_jan($year, $id_skpd){
		$this->db->select('MONTH(tanggal_surat) as bln, COUNT(tanggal_surat) as total');
		$this->db->where('YEAR(tanggal_surat)', $year);
		$this->db->where('jenis_surat', "internal");
		$this->db->where('MONTH(tanggal_surat)', 1);
		$this->db->where('id_skpd_penerima', $id_skpd);
		$query = $this->db->get('surat_masuk');
		return $query->row_array();
	}
	public function get_all_internal_grafik_feb($year, $id_skpd){
		$this->db->select('MONTH(tanggal_surat) as bln, COUNT(tanggal_surat) as total');
		$this->db->where('YEAR(tanggal_surat)', $year);
		$this->db->where('jenis_surat', "internal");
		$this->db->where('MONTH(tanggal_surat)', 2);
		$this->db->where('id_skpd_penerima', $id_skpd);
		$query = $this->db->get('surat_masuk');
		return $query->row_array();
	}
	public function get_all_internal_grafik_mar($year, $id_skpd){
		$this->db->select('MONTH(tanggal_surat) as bln, COUNT(tanggal_surat) as total');
		$this->db->where('YEAR(tanggal_surat)', $year);
		$this->db->where('jenis_surat', "internal");
		$this->db->where('MONTH(tanggal_surat)', 3);
		$this->db->where('id_skpd_penerima', $id_skpd);
		$query = $this->db->get('surat_masuk');
		return $query->row_array();
	}
	public function get_all_internal_grafik_apr($year, $id_skpd){
		$this->db->select('MONTH(tanggal_surat) as bln, COUNT(tanggal_surat) as total');
		$this->db->where('YEAR(tanggal_surat)', $year);
		$this->db->where('jenis_surat', "internal");
		$this->db->where('MONTH(tanggal_surat)', 4);
		$this->db->where('id_skpd_penerima', $id_skpd);
		$query = $this->db->get('surat_masuk');
		return $query->row_array();
	}
	public function get_all_internal_grafik_mei($year, $id_skpd){
		$this->db->select('MONTH(tanggal_surat) as bln, COUNT(tanggal_surat) as total');
		$this->db->where('YEAR(tanggal_surat)', $year);
		$this->db->where('jenis_surat', "internal");
		$this->db->where('MONTH(tanggal_surat)', 5);
		$this->db->where('id_skpd_penerima', $id_skpd);
		$query = $this->db->get('surat_masuk');
		return $query->row_array();
	}
	public function get_all_internal_grafik_jun($year, $id_skpd){
		$this->db->select('MONTH(tanggal_surat) as bln, COUNT(tanggal_surat) as total');
		$this->db->where('YEAR(tanggal_surat)', $year);
		$this->db->where('jenis_surat', "internal");
		$this->db->where('MONTH(tanggal_surat)', 6);
		$this->db->where('id_skpd_penerima', $id_skpd);
		$query = $this->db->get('surat_masuk');
		return $query->row_array();
	}
	public function get_all_internal_grafik_jul($year, $id_skpd){
		$this->db->select('MONTH(tanggal_surat) as bln, COUNT(tanggal_surat) as total');
		$this->db->where('YEAR(tanggal_surat)', $year);
		$this->db->where('jenis_surat', "internal");
		$this->db->where('MONTH(tanggal_surat)', 7);
		$this->db->where('id_skpd_penerima', $id_skpd);
		$query = $this->db->get('surat_masuk');
		return $query->row_array();
	}
	public function get_all_internal_grafik_agu($year, $id_skpd){
		$this->db->select('MONTH(tanggal_surat) as bln, COUNT(tanggal_surat) as total');
		$this->db->where('YEAR(tanggal_surat)', $year);
		$this->db->where('jenis_surat', "internal");
		$this->db->where('MONTH(tanggal_surat)', 8);
		$this->db->where('id_skpd_penerima', $id_skpd);
		$query = $this->db->get('surat_masuk');
		return $query->row_array();
	}
	public function get_all_internal_grafik_sep($year, $id_skpd){
		$this->db->select('MONTH(tanggal_surat) as bln, COUNT(tanggal_surat) as total');
		$this->db->where('YEAR(tanggal_surat)', $year);
		$this->db->where('jenis_surat', "internal");
		$this->db->where('MONTH(tanggal_surat)', 9);
		$this->db->where('id_skpd_penerima', $id_skpd);
		$query = $this->db->get('surat_masuk');
		return $query->row_array();
	}
	public function get_all_internal_grafik_okt($year, $id_skpd){
		$this->db->select('MONTH(tanggal_surat) as bln, COUNT(tanggal_surat) as total');
		$this->db->where('YEAR(tanggal_surat)', $year);
		$this->db->where('jenis_surat', "internal");
		$this->db->where('MONTH(tanggal_surat)', 10);
		$this->db->where('id_skpd_penerima', $id_skpd);
		$query = $this->db->get('surat_masuk');
		return $query->row_array();
	}
	public function get_all_internal_grafik_nov($year, $id_skpd){
		$this->db->select('MONTH(tanggal_surat) as bln, COUNT(tanggal_surat) as total');
		$this->db->where('YEAR(tanggal_surat)', $year);
		$this->db->where('jenis_surat', "internal");
		$this->db->where('MONTH(tanggal_surat)', 11);
		$this->db->where('id_skpd_penerima', $id_skpd);
		$query = $this->db->get('surat_masuk');
		return $query->row_array();
	}
	public function get_all_internal_grafik_des($year, $id_skpd){
		$this->db->select('MONTH(tanggal_surat) as bln, COUNT(tanggal_surat) as total');
		$this->db->where('YEAR(tanggal_surat)', $year);
		$this->db->where('jenis_surat', "internal");
		$this->db->where('MONTH(tanggal_surat)', 12);
		$this->db->where('id_skpd_penerima', $id_skpd);
		$query = $this->db->get('surat_masuk');
		return $query->row_array();
	}

	public function filter_disposisi()
	{
		if($this->user_data)
		{
			$user_data = $this->user_data;
			$array_privileges = explode(';', $user_data['user_privileges']);

			$this->db->group_start();

			$this->db->where('disposisi_surat_masuk.id_pegawai', $user_data['id_pegawai']);

			$this->db->or_group_start();
			$this->db->where('disposisi_surat_masuk.id_pegawai', NULL);
			$this->db->where('disposisi_surat_masuk.id_unit_kerja', $user_data['id_unit_kerja']);
			$this->db->group_end();

			if($user_data['kepala_skpd']=='Y' OR in_array('tu_pimpinan', $array_privileges)){
				$this->db->or_group_start();
				$this->db->where('disposisi_surat_masuk.id_pegawai', NULL);
				$this->db->where('disposisi_surat_masuk.id_unit_kerja', NULL);
				$this->db->where('disposisi_surat_masuk.id_skpd', $user_data['id_skpd']);
				$this->db->group_end();
			}

			$this->db->group_end();
		}
		else if($this->session->userdata('level')!='Administrator'){
			$array_privileges = explode(';', $this->session->userdata('user_privileges'));

			$this->db->group_start();

			$this->db->where('disposisi_surat_masuk.id_pegawai', $this->session->userdata('id_pegawai'));

			$this->db->or_group_start();
			$this->db->where('disposisi_surat_masuk.id_pegawai', NULL);
			$this->db->where('disposisi_surat_masuk.id_unit_kerja', $this->session->userdata('id_unit_kerja'));
			$this->db->group_end();

			if($this->session->userdata('kepala_skpd')=='Y' OR in_array('tu_pimpinan', $array_privileges)){
				$this->db->or_group_start();
				$this->db->where('disposisi_surat_masuk.id_pegawai', NULL);
				$this->db->where('disposisi_surat_masuk.id_unit_kerja', NULL);
				$this->db->where('disposisi_surat_masuk.id_skpd', $this->session->userdata('id_skpd'));
				$this->db->group_end();
			}

			$this->db->group_end();
		}
	}

	public function filter_disposisi_keluar()
	{
		if($this->user_data){
			$this->db->where('disposisi_surat_masuk.id_pegawai_disposisi', $this->user_data['id_pegawai']);
		}
		else if($this->session->userdata('level')!='Administrator'){
		
			$this->db->where('disposisi_surat_masuk.id_pegawai_disposisi', $this->session->userdata('id_pegawai'));
		}
	}

	public function get_all_eksternal_disposisi($summary_field='',$summary_value=''){
		if($summary_field!=''&&$summary_value!=''){
			$this->db->where('disposisi_surat_masuk.'.$summary_field,$summary_value);
		}
		$this->filter_disposisi();
		$this->db->where('surat_masuk.jenis_surat', "eksternal");

		$this->db->join('surat_masuk', 'disposisi_surat_masuk.id_surat_masuk = surat_masuk.id_surat_masuk');

		$query = $this->db->get('disposisi_surat_masuk');
		return $query->result();
	}

	public function get_all_eksternal_unread_disposisi(){
		$this->filter_disposisi();
		$this->db->where('surat_masuk.jenis_surat', "eksternal");
		$this->db->where('disposisi_surat_masuk.status_surat', "Belum Dibaca");

		$this->db->join('surat_masuk', 'disposisi_surat_masuk.id_surat_masuk = surat_masuk.id_surat_masuk');

		$query = $this->db->get('disposisi_surat_masuk');
		return $query->result();
	}

	public function get_all_eksternal_read_disposisi(){
		$this->filter_disposisi();
		$this->db->where('surat_masuk.jenis_surat', "eksternal");
		$this->db->where('disposisi_surat_masuk.status_surat', "Sudah Dibaca");

		$this->db->join('surat_masuk', 'disposisi_surat_masuk.id_surat_masuk = surat_masuk.id_surat_masuk');

		$query = $this->db->get('disposisi_surat_masuk');
		return $query->result();
	}

	public function get_all_eksternal_mustread_disposisi(){
		$this->filter_disposisi();
		$this->db->where('surat_masuk.jenis_surat', "eksternal");
		$this->db->where('disposisi_surat_masuk.status_surat', "Perlu Tanggapan");

		$this->db->join('surat_masuk', 'disposisi_surat_masuk.id_surat_masuk = surat_masuk.id_surat_masuk');

		$query = $this->db->get('disposisi_surat_masuk');
		return $query->result();
	}

	public function get_all_eksternal_unsign_disposisi(){
		$this->filter_disposisi();
		$this->db->where('surat_masuk.jenis_surat', "eksternal");
		$this->db->where('surat_masuk.status_ttd', "Belum tanda tangan");

		$this->db->join('surat_masuk', 'disposisi_surat_masuk.id_surat_masuk = surat_masuk.id_surat_masuk');

		$query = $this->db->get('disposisi_surat_masuk');
		return $query->result();
	}

	public function get_all_eksternal_signed_disposisi(){
		$this->filter_disposisi();
		$this->db->where('surat_masuk.jenis_surat', "eksternal");
		$this->db->where('surat_masuk.status_ttd', "Sudah tanda tangan");

		$this->db->join('surat_masuk', 'disposisi_surat_masuk.id_surat_masuk = surat_masuk.id_surat_masuk');

		$query = $this->db->get('disposisi_surat_masuk');
		return $query->result();
	}

	public function get_all_eksternal_mustsign_disposisi(){
		$this->filter_disposisi();
		$this->db->where('surat_masuk.jenis_surat', "eksternal");
		$this->db->where('surat_masuk.status_ttd', "Perlu Tanggapan");

		$this->db->join('surat_masuk', 'disposisi_surat_masuk.id_surat_masuk = surat_masuk.id_surat_masuk');

		$query = $this->db->get('disposisi_surat_masuk');
		return $query->result();
	}

	public function get_all_eksternal_unverif_disposisi(){
		$this->filter_disposisi();
		$this->db->where('surat_masuk.jenis_surat', "eksternal");
		$this->db->where('disposisi_surat_masuk.status_verifikasi', "Belum Diverifikasi");

		$this->db->join('surat_masuk', 'disposisi_surat_masuk.id_surat_masuk = surat_masuk.id_surat_masuk');

		$query = $this->db->get('disposisi_surat_masuk');
		return $query->result();
	}

	public function get_all_eksternal_verifed_disposisi(){
		$this->filter_disposisi();
		$this->db->where('surat_masuk.jenis_surat', "eksternal");
		$this->db->where('disposisi_surat_masuk.status_verifikasi', "Sudah Diverifikasi");

		$this->db->join('surat_masuk', 'disposisi_surat_masuk.id_surat_masuk = surat_masuk.id_surat_masuk');

		$query = $this->db->get('disposisi_surat_masuk');
		return $query->result();
	}

	public function get_all_eksternal_mustverif_disposisi(){
		$this->filter_disposisi();
		$this->db->where('surat_masuk.jenis_surat', "eksternal");
		$this->db->where('disposisi_surat_masuk.status_verifikasi', "Perlu Tanggapan");

		$this->db->join('surat_masuk', 'disposisi_surat_masuk.id_surat_masuk = surat_masuk.id_surat_masuk');

		$query = $this->db->get('disposisi_surat_masuk');
		return $query->result();
	}

	public function get_page_eksternal_disposisi($mulai,$hal,$filter='',$summary_field='',$summary_value=''){
		// $this->db->offsett(0,6);
		if($filter!=''){
			foreach($filter as $key => $value){
				$this->db->like($key,$value);
			}
		}else{
			$this->db->limit($hal,$mulai);
		}

		if($summary_field!=''&&$summary_value!=''){
			$this->db->where('disposisi_surat_masuk.'.$summary_field,$summary_value);
		}



		$this->db->select('*, disposisi_surat_masuk.status_surat AS status_surat,pegawai_penerima.nama_lengkap as nama_lengkap_penerima_disposisi, pegawai_disposisi.nama_lengkap as nama_lengkap_disposisi');

		$this->db->join('surat_masuk', 'disposisi_surat_masuk.id_surat_masuk = surat_masuk.id_surat_masuk');
		$this->db->join('ref_skpd', 'surat_masuk.id_skpd_penerima = ref_skpd.id_skpd');
		$this->db->join('pegawai as pegawai_penerima', 'disposisi_surat_masuk.id_pegawai = pegawai_penerima.id_pegawai');
		$this->db->join('pegawai as pegawai_disposisi', 'disposisi_surat_masuk.id_pegawai_disposisi = pegawai_disposisi.id_pegawai');

		$this->db->where('surat_masuk.jenis_surat', "eksternal");
		$this->filter_disposisi();
		$this->db->order_by('disposisi_surat_masuk.status_surat', 'ASC');
		$this->db->order_by('surat_masuk.tanggal_surat', 'DESC');

		$query = $this->db->get('disposisi_surat_masuk');
		return $query->result();
	}

	public function get_all_disposisi_keluar($summary_field='',$summary_value='',$jenis_surat){
		if($summary_field!=''&&$summary_value!=''){
			$this->db->where('disposisi_surat_masuk.'.$summary_field,$summary_value);
		}
		$this->filter_disposisi_keluar();
		$this->db->where('surat_masuk.jenis_surat', $jenis_surat);

		$this->db->join('surat_masuk', 'disposisi_surat_masuk.id_surat_masuk = surat_masuk.id_surat_masuk');

		$query = $this->db->get('disposisi_surat_masuk');
		return $query->result();
	}

	public function get_all_internal_disposisi($summary_field='',$summary_value=''){
		if($summary_field!=''&&$summary_value!=''){
			$this->db->where('disposisi_surat_masuk.'.$summary_field,$summary_value);
		}
		$this->filter_disposisi();
		$this->db->where('surat_masuk.jenis_surat', "internal");

		$this->db->join('surat_masuk', 'disposisi_surat_masuk.id_surat_masuk = surat_masuk.id_surat_masuk');

		$query = $this->db->get('disposisi_surat_masuk');
		return $query->result();
	}

	public function get_status_disposisi_keluar($status,$jenis_surat){
		$this->filter_disposisi_keluar();
		$this->db->where('surat_masuk.jenis_surat', $jenis_surat);
		$this->db->where('disposisi_surat_masuk.status_surat', $status);
		$this->db->join('surat_masuk', 'disposisi_surat_masuk.id_surat_masuk = surat_masuk.id_surat_masuk');
		$query = $this->db->get('disposisi_surat_masuk');
		return $query->result();
	}

	public function get_all_internal_unread_disposisi(){
		$this->filter_disposisi();
		$this->db->where('surat_masuk.jenis_surat', "internal");
		$this->db->where('disposisi_surat_masuk.status_surat', "Belum Dibaca");
		$this->db->join('surat_masuk', 'disposisi_surat_masuk.id_surat_masuk = surat_masuk.id_surat_masuk');
		$query = $this->db->get('disposisi_surat_masuk');
		return $query->result();
	}

	public function get_all_internal_read_disposisi(){
		$this->filter_disposisi();
		$this->db->where('surat_masuk.jenis_surat', "internal");
		$this->db->where('disposisi_surat_masuk.status_surat', "Sudah Dibaca");
		$this->db->join('surat_masuk', 'disposisi_surat_masuk.id_surat_masuk = surat_masuk.id_surat_masuk');
		$query = $this->db->get('disposisi_surat_masuk');
		return $query->result();
	}

	public function get_all_internal_mustread_disposisi(){
		$this->filter_disposisi();
		$this->db->where('surat_masuk.jenis_surat', "internal");
		$this->db->where('disposisi_surat_masuk.status_surat', "Perlu Tanggapan");
		$this->db->join('surat_masuk', 'disposisi_surat_masuk.id_surat_masuk = surat_masuk.id_surat_masuk');
		$query = $this->db->get('disposisi_surat_masuk');
		return $query->result();
	}

	public function get_all_internal_unsign_disposisi(){
		$this->filter_disposisi();
		$this->db->where('surat_masuk.jenis_surat', "internal");
		$this->db->where('surat_masuk.status_ttd', "Belum tanda tangan");

		$this->db->join('surat_masuk', 'disposisi_surat_masuk.id_surat_masuk = surat_masuk.id_surat_masuk');

		$query = $this->db->get('disposisi_surat_masuk');
		return $query->result();
	}

	public function get_all_internal_signed_disposisi(){
		$this->filter_disposisi();
		$this->db->where('surat_masuk.jenis_surat', "internal");
		$this->db->where('surat_masuk.status_ttd', "Sudah tanda tangan");

		$this->db->join('surat_masuk', 'disposisi_surat_masuk.id_surat_masuk = surat_masuk.id_surat_masuk');

		$query = $this->db->get('disposisi_surat_masuk');
		return $query->result();
	}

	public function get_all_internal_mustsign_disposisi(){
		$this->filter_disposisi();
		$this->db->where('surat_masuk.jenis_surat', "internal");
		$this->db->where('surat_masuk.status_ttd', "Perlu Tanggapan");

		$this->db->join('surat_masuk', 'disposisi_surat_masuk.id_surat_masuk = surat_masuk.id_surat_masuk');

		$query = $this->db->get('disposisi_surat_masuk');
		return $query->result();
	}

	public function get_all_internal_unverif_disposisi(){
		$this->filter_disposisi();
		$this->db->where('surat_masuk.jenis_surat', "internal");
		$this->db->where('disposisi_surat_masuk.status_verifikasi', "Belum Diverifikasi");

		$this->db->join('surat_masuk', 'disposisi_surat_masuk.id_surat_masuk = surat_masuk.id_surat_masuk');

		$query = $this->db->get('disposisi_surat_masuk');
		return $query->result();
	}

	public function get_all_internal_verifed_disposisi(){
		$this->filter_disposisi();
		$this->db->where('surat_masuk.jenis_surat', "internal");
		$this->db->where('disposisi_surat_masuk.status_verifikasi', "Sudah Diverifikasi");

		$this->db->join('surat_masuk', 'disposisi_surat_masuk.id_surat_masuk = surat_masuk.id_surat_masuk');

		$query = $this->db->get('disposisi_surat_masuk');
		return $query->result();
	}

	public function get_all_internal_mustverif_disposisi(){
		$this->filter_disposisi();
		$this->db->where('surat_masuk.jenis_surat', "internal");
		$this->db->where('disposisi_surat_masuk.status_verifikasi', "Perlu Tanggapan");

		$this->db->join('surat_masuk', 'disposisi_surat_masuk.id_surat_masuk = surat_masuk.id_surat_masuk');

		$query = $this->db->get('disposisi_surat_masuk');
		return $query->result();
	}

	public function get_page_disposisi_keluar($mulai=null,$hal=null,$filter='',$summary_field='',$summary_value='',$jenis_surat=''){
		// $this->db->offsett(0,6);
		if($filter!=''){
			foreach($filter as $key => $value){
				$this->db->like($key,$value);
			}
		}else{
			if($hal!=null && $mulai!=null){
				$this->db->limit($hal,$mulai);
			}
		}

		if($summary_field!=''&&$summary_value!=''){
			$this->db->where('disposisi_surat_masuk.'.$summary_field,$summary_value);
		}


		$this->db->select('*, disposisi_surat_masuk.status_surat AS status_surat,pegawai_penerima.nama_lengkap as nama_lengkap_penerima_disposisi, pegawai_disposisi.nama_lengkap as nama_lengkap_disposisi');

		$this->db->join('surat_masuk', 'disposisi_surat_masuk.id_surat_masuk = surat_masuk.id_surat_masuk');
		$this->db->join('ref_skpd', 'surat_masuk.id_skpd_penerima = ref_skpd.id_skpd');
		$this->db->join('pegawai as pegawai_penerima', 'disposisi_surat_masuk.id_pegawai = pegawai_penerima.id_pegawai');
		$this->db->join('pegawai as pegawai_disposisi', 'disposisi_surat_masuk.id_pegawai_disposisi = pegawai_disposisi.id_pegawai');
		
		if($jenis_surat!=""){
			$this->db->where('surat_masuk.jenis_surat', $jenis_surat);
		}
		$this->filter_disposisi_keluar();
		$this->db->order_by('disposisi_surat_masuk.status_surat', 'ASC');
		$this->db->order_by('surat_masuk.tanggal_surat', 'DESC');

		$query = $this->db->get('disposisi_surat_masuk');
		return $query->result();
	}

	public function get_page_internal_disposisi($mulai=null,$hal=null,$filter='',$summary_field='',$summary_value='',$android=false){
		// $this->db->offsett(0,6);
		if($filter!=''){
			foreach($filter as $key => $value){
				$this->db->like($key,$value);
			}
		}else{ 
			if($mulai!=null && $hal!=null){
				$this->db->limit($hal,$mulai);
			}
		}

		if($summary_field!=''&&$summary_value!=''){
			$this->db->where('disposisi_surat_masuk.'.$summary_field,$summary_value);
		}



		$this->db->select('*, disposisi_surat_masuk.status_surat AS status_surat,pegawai_penerima.nama_lengkap as nama_lengkap_penerima_disposisi, pegawai_disposisi.nama_lengkap as nama_lengkap_disposisi');

		$this->db->join('surat_masuk', 'disposisi_surat_masuk.id_surat_masuk = surat_masuk.id_surat_masuk');
		$this->db->join('ref_skpd', 'surat_masuk.id_skpd_penerima = ref_skpd.id_skpd');
		$this->db->join('pegawai as pegawai_penerima', 'disposisi_surat_masuk.id_pegawai = pegawai_penerima.id_pegawai');
		$this->db->join('pegawai as pegawai_disposisi', 'disposisi_surat_masuk.id_pegawai_disposisi = pegawai_disposisi.id_pegawai');

		if(empty($this->jenis_surat)) {
			$this->db->where('surat_masuk.jenis_surat', "internal");
		}
		$this->filter_disposisi();

		if($android)
		{
			$Date = date("Y-m-d");
			$tanggal_surat = date('Y-m-d', strtotime($Date. ' - 30 day'));
			$this->db->where("surat_masuk.tanggal_surat >= ",$tanggal_surat);
			//$this->db->where("status_surat","Belum dibaca");
		}

		$this->db->order_by('disposisi_surat_masuk.status_surat', 'ASC');
		$this->db->order_by('surat_masuk.tanggal_surat', 'DESC');

		$query = $this->db->get('disposisi_surat_masuk');
		return $query->result();
	}

	public function get_page_eksternal($mulai,$hal,$filter=''){
		// $this->db->offsett(0,6);
		if($filter!=''){
			foreach($filter as $key => $value){
				$this->db->like($key,$value);
			}
		}else{
			$this->db->limit($hal,$mulai);
		}

		$this->db->where('surat_masuk.jenis_surat', "eksternal");
		$this->filter_user();
		$this->db->join('ref_skpd', 'surat_masuk.id_skpd_penerima = ref_skpd.id_skpd');
		$this->db->order_by('surat_masuk.status_surat', 'ASC');
		$this->db->order_by('surat_masuk.id_surat_masuk', 'DESC');

		$query = $this->db->get('surat_masuk');
		return $query->result();
	}


	public function get_page_internal($mulai='',$hal='',$filter='',$summary_field='',$summary_value='',$testing=''){
		// $this->db->offsett(0,6);
		if($filter!=''){
			foreach($filter as $key => $value){
				$this->db->like($key,$value);
			}
		}else{
			if($mulai!=='' && $hal !== ''){
				$this->db->limit($hal,$mulai);
			}
		}


		if($summary_field!=''&&$summary_value!=''){
			$this->db->where('surat_masuk.'.$summary_field,$summary_value);
		}

		$this->db->where('surat_masuk.jenis_surat', "internal");
		$this->filter_user();

		$this->db->join('ref_skpd', 'surat_masuk.id_skpd_penerima = ref_skpd.id_skpd');
		$this->db->join('user', 'surat_masuk.id_pegawai_input = user.id_pegawai','left');
		$this->db->join('pegawai', 'surat_masuk.id_pegawai_input = pegawai.id_pegawai','left');
		
		$this->db->select("surat_masuk.*,ref_skpd.*,pegawai.foto_pegawai as user_picture, pegawai.nama_lengkap as 'pengirim' ");

		$this->db->order_by('surat_masuk.status_surat', 'ASC');
		$this->db->order_by('surat_masuk.tanggal_surat', 'DESC');

		$query = $this->db->get('surat_masuk');
		return $query->result();
	}

	public function get_surat_masuk($mulai=null,$hal=null,$filter='',$summary_field='',$summary_value='',$android=false){
		// $this->db->offsett(0,6);
		if($filter!=''){
			foreach($filter as $key => $value){
				$this->db->like($key,$value);
			}
		}else{
			if($mulai!=null && $hal != null){
				$this->db->limit($hal,$mulai);
			}
		}

		if($summary_field!=''&&$summary_value!=''){
			$this->db->where('surat_masuk.'.$summary_field,$summary_value);
		}

		
		$this->filter_user();

		$this->db->join('ref_skpd', 'surat_masuk.id_skpd_penerima = ref_skpd.id_skpd');
		$this->db->join('user', 'surat_masuk.id_pegawai_input = user.id_pegawai','left');
		$this->db->join('pegawai', 'surat_masuk.id_pegawai_input = pegawai.id_pegawai','left');
		
		$this->db->select("surat_masuk.*,ref_skpd.*,IF(surat_masuk.surat_desa=1,'user_default.png', pegawai.foto_pegawai) as user_picture ");
		$this->db->group_by('surat_masuk.id_surat_masuk');
		$this->db->order_by('surat_masuk.status_surat', 'ASC');
		$this->db->order_by('surat_masuk.tanggal_surat', 'DESC');

		if($android)
		{
			$Date = date("Y-m-d");
			$tanggal_surat = date('Y-m-d', strtotime($Date. ' - 30 day'));
			$this->db->where("tanggal_surat >= ",$tanggal_surat);
			//$this->db->where("status_surat","Belum dibaca");
		}

		$query = $this->db->get('surat_masuk');
		return $query->result();
	}





	public function get_detail_by_id($id)
	{
		$this->db->select("*, pegawai_input.nama_lengkap as nama_lengkap_input, pegawai_input.jabatan as jabatan_input, pegawai_penerima.nama_lengkap as nama_lengkap_penerima, pegawai_penerima.jabatan as jabatan_penerima");

		$this->db->where('surat_masuk.id_surat_masuk',$id);

		$this->db->join('user as user_input', 'surat_masuk.id_pegawai_input = user_input.id_pegawai', 'left');
		$this->db->join('pegawai as pegawai_input', 'user_input.id_pegawai = pegawai_input.id_pegawai', 'left');
		$this->db->join('ref_jabatan as jabatan_input', 'pegawai_input.id_jabatan = jabatan_input.id_jabatan', 'left');

		$this->db->join('user as user_penerima', 'surat_masuk.id_pegawai_penerima = user_penerima.id_pegawai', 'left');
		$this->db->join('pegawai as pegawai_penerima', 'user_penerima.id_pegawai = pegawai_penerima.id_pegawai', 'left');
		$this->db->join('ref_jabatan as jabatan_penerima', 'pegawai_penerima.id_jabatan = jabatan_penerima.id_jabatan', 'left');

		$this->db->join('ref_skpd', 'surat_masuk.id_skpd_penerima = ref_skpd.id_skpd', 'left');
		$query = $this->db->get('surat_masuk');
		return $query->row();
	}


	public function get_detail_disposisi_keluar_by_id($id)
	{
		$this->filter_disposisi_keluar();
		$this->db->select("*, pegawai_input.nama_lengkap as nama_lengkap_input, pegawai_input.jabatan as jabatan_input, pegawai_penerima.nama_lengkap as nama_lengkap_penerima, pegawai_penerima.jabatan as jabatan_penerima, pegawai_disposisi.nama_lengkap as nama_lengkap_disposisi, pegawai_disposisi.jabatan as jabatan_disposisi, disposisi_surat_masuk.status_surat AS status_surat, disposisi_surat_masuk.id_pegawai AS id_pegawai, disposisi_surat_masuk.id_pegawai_disposisi AS id_pegawai_disposisi, disposisi_surat_masuk.id_unit_kerja AS id_unit_kerja, disposisi_surat_masuk.id_skpd AS id_skpd, pegawai_penerima_disposisi.nama_lengkap as nama_lengkap_penerima_disposisi");

		$this->db->where('disposisi_surat_masuk.id_disposisi_masuk',$id);

		$this->db->join('surat_masuk', 'disposisi_surat_masuk.id_surat_masuk = surat_masuk.id_surat_masuk', 'left');

		$this->db->join('user as user_disposisi', 'disposisi_surat_masuk.id_pegawai_disposisi = user_disposisi.id_pegawai', 'left');
		$this->db->join('pegawai as pegawai_disposisi', 'user_disposisi.id_pegawai = pegawai_disposisi.id_pegawai', 'left');
		$this->db->join('ref_jabatan as jabatan_disposisi', 'pegawai_disposisi.id_jabatan = jabatan_disposisi.id_jabatan', 'left');

		$this->db->join('pegawai as pegawai_penerima_disposisi','pegawai_penerima_disposisi.id_pegawai = disposisi_surat_masuk.id_pegawai','left');

		$this->db->join('user as user_input', 'surat_masuk.id_pegawai_input = user_input.id_pegawai', 'left');
		$this->db->join('pegawai as pegawai_input', 'user_input.id_pegawai = pegawai_input.id_pegawai', 'left');
		$this->db->join('ref_jabatan as jabatan_input', 'pegawai_input.id_jabatan = jabatan_input.id_jabatan', 'left');

		$this->db->join('user as user_penerima', 'surat_masuk.id_pegawai_penerima = user_penerima.id_pegawai', 'left');
		$this->db->join('pegawai as pegawai_penerima', 'user_penerima.id_pegawai = pegawai_penerima.id_pegawai', 'left');
		$this->db->join('ref_jabatan as jabatan_penerima', 'pegawai_penerima.id_jabatan = jabatan_penerima.id_jabatan', 'left');

		$this->db->join('ref_skpd', 'surat_masuk.id_skpd_penerima = ref_skpd.id_skpd', 'left');
		$query = $this->db->get('disposisi_surat_masuk');
		return $query->row();
	}

	public function get_detail_disposisi_by_id($id)
	{
		$this->filter_disposisi();
		$this->db->select("*, pegawai_input.nama_lengkap as nama_lengkap_input, pegawai_input.jabatan as jabatan_input, pegawai_penerima.nama_lengkap as nama_lengkap_penerima, pegawai_penerima.jabatan as jabatan_penerima, pegawai_disposisi.nama_lengkap as nama_lengkap_disposisi, pegawai_disposisi.jabatan as jabatan_disposisi, disposisi_surat_masuk.status_surat AS status_surat, disposisi_surat_masuk.id_pegawai AS id_pegawai, disposisi_surat_masuk.id_pegawai_disposisi AS id_pegawai_disposisi, disposisi_surat_masuk.id_unit_kerja AS id_unit_kerja, disposisi_surat_masuk.id_skpd AS id_skpd, pegawai_penerima_disposisi.nama_lengkap as nama_lengkap_penerima_disposisi");

		$this->db->where('disposisi_surat_masuk.id_disposisi_masuk',$id);

		$this->db->join('surat_masuk', 'disposisi_surat_masuk.id_surat_masuk = surat_masuk.id_surat_masuk', 'left');

		$this->db->join('pegawai as pegawai_penerima_disposisi','pegawai_penerima_disposisi.id_pegawai = disposisi_surat_masuk.id_pegawai','left');

		$this->db->join('user as user_disposisi', 'disposisi_surat_masuk.id_pegawai_disposisi = user_disposisi.id_pegawai', 'left');
		$this->db->join('pegawai as pegawai_disposisi', 'user_disposisi.id_pegawai = pegawai_disposisi.id_pegawai', 'left');
		$this->db->join('ref_jabatan as jabatan_disposisi', 'pegawai_disposisi.id_jabatan = jabatan_disposisi.id_jabatan', 'left');

		$this->db->join('user as user_input', 'surat_masuk.id_pegawai_input = user_input.id_pegawai', 'left');
		$this->db->join('pegawai as pegawai_input', 'user_input.id_pegawai = pegawai_input.id_pegawai', 'left');
		$this->db->join('ref_jabatan as jabatan_input', 'pegawai_input.id_jabatan = jabatan_input.id_jabatan', 'left');

		$this->db->join('user as user_penerima', 'surat_masuk.id_pegawai_penerima = user_penerima.id_pegawai', 'left');
		$this->db->join('pegawai as pegawai_penerima', 'user_penerima.id_pegawai = pegawai_penerima.id_pegawai', 'left');
		$this->db->join('ref_jabatan as jabatan_penerima', 'pegawai_penerima.id_jabatan = jabatan_penerima.id_jabatan', 'left');

		$this->db->join('ref_skpd', 'surat_masuk.id_skpd_penerima = ref_skpd.id_skpd', 'left');
		$query = $this->db->get('disposisi_surat_masuk');
		return $query->row();
	}

	

	public function baca_surat($id)
	{
		$this->db->where('id_surat_masuk',$id);
		$this->db->set('status_surat','Sudah Dibaca');
		$this->db->set('tgl_dibaca',date("Y-m-d"));
		$this->db->update('surat_masuk');

		$sm = $this->db->get_where('surat_masuk',array('id_surat_masuk'=>$id))->row();

		$sk = $this->db->get_where('surat_keluar',array('nomer_surat'=>$sm->nomer_surat))->result();
		foreach($sk as $s){
			$this->db->where('id_surat_keluar',$s->id_surat_keluar);
			if($s->jenis_surat=="internal"){
				$this->db->where('id_pegawai',$this->session->userdata('id_pegawai'));
			}elseif($s->jenis_surat=="eksternal"){
				$this->db->where('id_skpd',$this->session->userdata('id_skpd'));
			}
			$this->db->set('dibaca',"Y");
			$this->db->update('surat_keluar_penerima');
		}

	}

	public function baca_surat_disposisi($id)
	{
		$this->db->where('id_disposisi_masuk',$id);
		$this->db->set('status_surat','Sudah Dibaca');
		$this->db->set('tgl_terima',date("Y-m-d"));
		$this->db->update('disposisi_surat_masuk');
	}



	public function hapus_surat_masuk($id)
	{
		$this->db->where('id_surat_masuk',$this->id_surat_masuk);
		$query = $this->db->delete('surat_masuk');
	}

	public function update_surat_masuk($data,$id_surat_masuk){
		return $this->db->update('surat_masuk',$data,['id_surat_masuk'=>$id_surat_masuk]);
	}

	public function get_total_surat_masuk(){
		$query = $this->db->get('surat_masuk');
		return $query->num_rows();
	}

	public function get_total_surat_dibaca(){
		$this->db->where('status_surat','Dibaca');
		$query = $this->db->get('surat_masuk');
		return $query->num_rows();
	}

	public function get_total_surat_belum_dibaca(){
		$this->db->where('status_surat','Belum Dibaca');
		$query = $this->db->get('surat_masuk');
		return $query->num_rows();
	}

	// Surat Internal
	public function get_all_internal($summary_field='',$summary_value=''){
		if($summary_field!=''&&$summary_value!=''){
			$this->db->where('surat_masuk.'.$summary_field,$summary_value);
		}
		$this->db->where('jenis_surat', "internal");
		$this->filter_user();
		$query = $this->db->get('surat_masuk');
		return $query->result();
	}

	public function get_all_internal_unread(){
		$this->db->where('jenis_surat', "internal");
		$this->db->where('status_surat', "Belum Dibaca");
		$this->filter_user();
		$query = $this->db->get('surat_masuk');
		return $query->result();
	}

	public function get_all_internal_read(){
		$this->db->where('jenis_surat', "internal");
		$this->db->where('status_surat', "Sudah Dibaca");
		$this->filter_user();
		$query = $this->db->get('surat_masuk');
		return $query->result();
	}

	public function get_all_internal_mustread(){
		$this->db->where('jenis_surat', "internal");
		$this->db->where('status_surat', "Perlu Tanggapan");
		$this->filter_user();
		$query = $this->db->get('surat_masuk');
		return $query->result();
	}

	public function delete_disposisi($data)
	{
		$this->db->where('id_surat_masuk',$data['id_surat_masuk']);
		$this->db->where('id_pegawai_disposisi',$data['id_pegawai_disposisi']);
		$this->db->delete('disposisi_surat_masuk');
	}


	public function add_disposisi($data)
	{
		$this->db->insert('disposisi_surat_masuk',$data);
		return $this->db->insert_id();
	}



	public function get_all_unit_kerja_by_skpd($id_skpd){
		$this->db->where('id_skpd',$id_skpd);
		$query = $this->db->get('ref_unit_kerja');
		return $query->result();
	}

	public function get_all_pegawai_by_unit_kerja($id_unit_kerja){
		$this->db->join('ref_jabatan','ref_jabatan.id_jabatan = pegawai.id_jabatan', 'left');
		$this->db->join('ref_unit_kerja','ref_unit_kerja.id_unit_kerja = pegawai.id_unit_kerja', 'left');
		$this->db->where('pegawai.id_unit_kerja',$id_unit_kerja);
		if ($id_unit_kerja == 0) {
			$this->db->where('pegawai.id_skpd',$this->session->userdata('id_skpd'));
		}
		$query = $this->db->get('pegawai');
		return $query->result();
	}

	public function get_id_unit_kerja_by_pegawai($id_pegawai)
	{
		$this->db->where('pegawai.id_pegawai',$id_pegawai);
		$query = $this->db->get('pegawai');
		$data = $query->row();
		return $data->id_unit_kerja;
	}

	public function get_disposisi_surat_masuk_by_id_surat($id)
	{
		$this->db->select('*, disposisi_surat_masuk.id_unit_kerja AS id_unit_kerja');
		$this->db->join('ref_unit_kerja','disposisi_surat_masuk.id_unit_kerja = ref_unit_kerja.id_unit_kerja', 'left');
		$this->db->join('pegawai','disposisi_surat_masuk.id_pegawai = pegawai.id_pegawai', 'left');
		$this->db->join('ref_skpd','disposisi_surat_masuk.id_skpd = ref_skpd.id_skpd', 'left');
		$this->db->where('id_surat_masuk',$id);
		$query = $this->db->get('disposisi_surat_masuk');
		return $query->result();
	}

	public function get_disposisi_user_surat_masuk_by_id_surat($id)
	{
		$this->db->select('*, pegawai.id_unit_kerja AS id_unit_kerja');
		// $this->db->join('ref_unit_kerja','disposisi_surat_masuk.id_unit_kerja = ref_unit_kerja.id_unit_kerja', 'left');
		$this->db->join('pegawai', 'disposisi_surat_masuk.id_pegawai_disposisi = pegawai.id_pegawai', 'left');
		$this->db->join('ref_jabatan', 'pegawai.id_jabatan = ref_jabatan.id_jabatan', 'left');
		// $this->db->join('ref_skpd','disposisi_surat_masuk.id_skpd = ref_skpd.id_skpd', 'left');
		$this->db->where('disposisi_surat_masuk.id_surat_masuk',$id);
		$this->db->group_by('disposisi_surat_masuk.id_pegawai_disposisi');
		$query = $this->db->get('disposisi_surat_masuk');
		return $query->result();
	}

	public function get_disposisi_user_surat_masuk_by_id_surat_id_pegawai_disposisi($id,$id_pegawai)
	{
		$this->db->select('*, disposisi_surat_masuk.id_pegawai AS id_pegawai, disposisi_surat_masuk.id_unit_kerja AS id_unit_kerja, disposisi_surat_masuk.id_skpd AS id_skpd, ');
		// $this->db->join('ref_unit_kerja','disposisi_surat_masuk.id_unit_kerja = ref_unit_kerja.id_unit_kerja', 'left');
		$this->db->join('pegawai', 'disposisi_surat_masuk.id_pegawai = pegawai.id_pegawai', 'left');
		$this->db->join('ref_jabatan', 'pegawai.id_jabatan = ref_jabatan.id_jabatan', 'left');
		$this->db->join('ref_unit_kerja','disposisi_surat_masuk.id_unit_kerja = ref_unit_kerja.id_unit_kerja', 'left');
		$this->db->join('ref_skpd','disposisi_surat_masuk.id_skpd = ref_skpd.id_skpd', 'left');
		$this->db->where('disposisi_surat_masuk.id_surat_masuk',$id);
		$this->db->where('disposisi_surat_masuk.id_pegawai_disposisi',$id_pegawai);
		$query = $this->db->get('disposisi_surat_masuk');
		return $query->result();
	}

	public function add_by_surat_keluar($id_surat_keluar,$testing="")
	{
		$this->db->where('surat_keluar_penerima.id_surat_keluar', $id_surat_keluar);

		$this->db->select("*, surat_keluar_penerima.id_skpd as id_skpd_eksternal, pegawai_input.nama_lengkap as nama_lengkap_input, pegawai_penerima.nama_lengkap as nama_lengkap_penerima, pegawai_penerima.id_skpd as id_skpd_penerima, pegawai_penerima.id_unit_kerja as id_unit_kerja_penerima, pegawai_penerima.id_pegawai as id_pegawai_penerima, user.app_token");

		$this->db->join('surat_keluar', 'surat_keluar_penerima.id_surat_keluar = surat_keluar.id_surat_keluar', 'left');

		$this->db->join('pegawai as pegawai_input', 'surat_keluar.id_pegawai_input = pegawai_input.id_pegawai', 'left');

		$this->db->join('pegawai as pegawai_penerima', 'surat_keluar_penerima.id_pegawai = pegawai_penerima.id_pegawai', 'left');
		$this->db->join('user', 'user.id_pegawai = surat_keluar_penerima.id_pegawai', 'left');
		$this->db->group_by("surat_keluar_penerima.id_surat_keluar_penerima");

		$get = $this->db->get('surat_keluar_penerima')->result();

		$app_tokenArr = array();
		$after_insert_data = array();
		foreach ($get as $row) {
			if ($row->jenis_surat=="internal") {
				$id_skpd_penerima = $row->id_skpd_penerima;
				$id_unit_kerja_penerima = $row->id_unit_kerja_penerima;
				$id_pegawai_penerima = $row->id_pegawai_penerima;
			} else {
				if ($row->jenis_penerima == "skpd") {
					$id_skpd_penerima = $row->id_skpd_eksternal;
					$kepala = $this->getPegawaiKepalaSKPD($id_skpd_penerima);
					$id_unit_kerja_penerima = 0;
					$id_pegawai_penerima = $kepala->id_pegawai;
				}
			}

			if ($row->jenis_surat == "internal" OR $row->jenis_penerima == "skpd") {
				$data = array(	'jenis_surat' => $row->jenis_surat,
					'perihal' => $row->perihal,
					'pengirim' => $row->nama_lengkap_input,
					'tanggal_surat' => $row->tgl_buat,
					'nomer_surat' => $row->nomer_surat,
					'sifat' => $row->sifat_surat,
					'isi_ringkasan' => $row->isi_surat,
					'file_surat' => $row->file_ttd,
					'lampiran' => $row->file_lampiran,
					'id_pegawai_input' => $row->id_pegawai_input,
					'tgl_input' => date('Y-m-d'),
					'status_surat' => 'Belum Dibaca',
					'id_skpd_penerima' => $id_skpd_penerima,
					'id_unitkerja_penerima' => $id_unit_kerja_penerima,
					'id_pegawai_penerima' => $id_pegawai_penerima,
					'hash_id' => $row->hash_id
				);
				$this->db->insert('surat_masuk',$data);
				$insert_id = $this->db->insert_id();
				if($row->app_token != null){
					//$app_tokenArr[] = $row->app_token;
					$this->sendNotification($row->app_token);
				}
				if($row->jenis_penerima=="skpd")
				{
					$id_user_penerima = $this->getUserIdKepalaSKPD($id_skpd_penerima);
					if($this->getTokenKepalaSKPD($id_skpd_penerima)!=null)
					{
						//$app_tokenArr[] = $this->getTokenKepalaSKPD($id_skpd_penerima);
						$this->sendNotification($this->getTokenKepalaSKPD($id_skpd_penerima));
					}
				}else{
					$id_user_penerima = $this->getUserIdPegawai($id_pegawai_penerima);
				}
				$after_insert_data[] = array('id_user'=>$id_user_penerima,'id_surat_masuk'=>$insert_id);

			} elseif ($row->jenis_penerima == "desa") {
				
				$skpd = $this->db->get_where('ref_skpd', array('id_skpd' => $row->id_skpd_pengirim))->row();
				$data_send_surat = array(
					'perihal' => $row->perihal,
					'pengirim' => $row->nama_lengkap_input . " - " . $skpd->nama_skpd,
					'tanggal_surat' => $row->tgl_surat,
					'nomer_surat' => $row->nomer_surat,
					'sifat' => $row->sifat_surat,
					'file_surat' => $row->file_ttd,
					'lampiran' => $row->lampiran,
					'file_lampiran' => $row->file_lampiran,
					'tgl_input' => $row->tgl_buat,
					'id_skpd' => $row->id_skpd_eksternal,
					'hash_id' => $row->hash_id . "E"
				);
				$send_to_madasih = curlMadasih('send_surat', $data_send_surat);
				// if($testing==264358){
				// 	print_r($send_to_madasih);
				// }
			}
		}
		return $after_insert_data;

		// Mengirimkan notifikasi ke Android
		/*
		if(count($app_tokenArr)>0){
			require(APPPATH.'libraries/PushNotification/Firebase.php');
			$judul = "Surat Masuk";
			$pesan = "Perihal : ".$get[0]->perihal;
			$click_action = "surat_masuk";
			$data_id = '';
			$raw_data = '';
			$firebase = new Firebase();
			$firebase->sendMulti($app_tokenArr, $judul, $pesan,$click_action,$data_id,$raw_data);
		}
		*/
	}

	private function getUserIdPegawai($id_pegawai)
	{
		$this->db->where("pegawai.id_pegawai",$id_pegawai);
		$this->db->join("user","user.id_pegawai=pegawai.id_pegawai","left");
		$rs = $this->db->get("pegawai")->row();
		return $rs->user_id;
	}


	private function getUserIdKepalaSKPD($id_skpd)
	{
		$this->db->where("pegawai.id_skpd",$id_skpd);
		$this->db->where("pegawai.kepala_skpd","Y");
		$this->db->join("user","user.id_pegawai=pegawai.id_pegawai","left");
		$rs = $this->db->get("pegawai")->row();
		return $rs->user_id;
	}


	private function getPegawaiKepalaSKPD($id_skpd)
	{
		$this->db->where("pegawai.id_skpd",$id_skpd);
		$this->db->where("pegawai.kepala_skpd","Y");
		$rs = $this->db->get("pegawai")->row();
		return $rs;
	}

	private function getTokenKepalaSKPD($id_skpd)
	{
		$this->db->where("pegawai.id_skpd",$id_skpd);
		$this->db->where("pegawai.kepala_skpd","Y");
		$this->db->join("user","user.id_pegawai=pegawai.id_pegawai","left");
		$rs = $this->db->get("pegawai")->row();
		if($rs->app_token!=null){
			return $rs->app_token;
		}
		else{
			return null;
		}
	}

	private function sendNotification($app_token)
	{
		$surat_masuk = $this->getLastSuratMasuk();
		//require(APPPATH.'libraries/PushNotification/Firebase.php');
		$judul = "Surat Masuk";
		$pesan = "Perihal : ".$surat_masuk->perihal;
		$click_action = "surat_masuk";
		$data_id = $surat_masuk->id_surat_masuk;
		$file = "";
		$ringkasan = "";
		$gambar = "";
		if($surat_masuk->user_picture!=null)
			$gambar = base_url()."data/user_picture/". $surat_masuk->user_picture;
		if($surat_masuk->isi_ringkasan!=null)
			$ringkasan= $surat_masuk->isi_ringkasan;

		if($surat_masuk->jenis_surat=="internal")
			$file = base_url()."data/surat_internal/surat_masuk/".$surat_masuk->file_surat;
		else
			$file = base_url()."data/surat_eksternal/surat_masuk/".$surat_masuk->file_surat;
		$data = array(
			'gambar'	=> $gambar,
			'judul'		=> $surat_masuk->perihal,
			'tanggal'	=> $surat_masuk->tanggal_surat,
			'ringkasan'	=> $ringkasan,
			'file'		=> $file,
			'id_surat_masuk'	=> $surat_masuk->id_surat_masuk,
			'flag'		=> "surat_masuk",

		);
		$raw_data = json_encode($data);
		//$firebase = new Firebase();
		//$firebase->send($app_token, $judul, $pesan,$click_action,$data_id,$raw_data);
		$this->firebase->send($app_token, $judul, $pesan,$click_action,$data_id,$raw_data);
	}

	private function getLastSuratMasuk()
	{
		$this->db->select("surat_masuk.*,user.user_picture");
		$this->db->join('user', 'surat_masuk.id_pegawai_input = user.id_pegawai','left');
		$this->db->order_by("id_surat_masuk","DESC");
		$this->db->limit(1);
		$rs = $this->db->get("surat_masuk");
		return $rs->row();
	}

}
