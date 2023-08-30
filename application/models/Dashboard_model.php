<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_model extends CI_Model
{
	public function get_visitor_days()
	{
		$this->db->where('date',date('Y-m-d'));
		$query = $this->db->get('visitor');
		return $query->num_rows();
	}

	public function get_visitor_all()
	{
		$query = $this->db->get('visitor');
		return $query->num_rows();
	}

	public function get_total_surat_masuk($id_pegawai)
	{
		$this->db->where('id_pegawai_penerima', $id_pegawai);
		$query = $this->db->get('surat_masuk');
		return $query->num_rows();
	}

	public function get_total_catatan($id_pegawai)
	{
		$this->db->where('id_pegawai', $id_pegawai);
		$query = $this->db->get('catatan');
		return $query->num_rows();
	}

	public function get_total_kegiatan($id_pegawai)
	{
		$this->db->where('id_pegawai', $id_pegawai);
		$query = $this->db->get('kegiatan_anggota');
		return $query->num_rows();
	}

	public function get_total_agenda($id_pegawai)
	{
		$skrng = date("Y-m-d");
		$this->db->where('id_pegawai', $id_pegawai);
		$this->db->where('start_date >=', $skrng);
		$query = $this->db->get('calendar_pribadi');
		return $query->num_rows();
	}

	public function get_data_bkd($id_pegawai)
	{
		$this->db->join('pegawai', 'pegawai.nip = data_bkd.nip');
		$this->db->join('ref_skpd', 'ref_skpd.id_skpd = pegawai.id_skpd');
		$this->db->join('ref_unit_kerja', 'ref_unit_kerja.id_unit_kerja = pegawai.id_unit_kerja');
		$this->db->where('pegawai.id_pegawai', $id_pegawai);
		$query = $this->db->get('data_bkd');
		return $query->row();
	}

	public function get_pengumuman($id_pegawai, $id_skpd){

		$skrng = date("Y-m-d");
		$this->db->join('pegawai', 'pegawai.id_pegawai = pengumuman.id_pegawai');
		$this->db->where('pegawai.id_skpd', $id_skpd);
		$this->db->where('tanggal', $skrng);
		$this->db->group_start();
		$this->db->where('id_skpd_tujuan',$id_skpd);
		$this->db->or_where('id_skpd_tujuan','semua');
		$this->db->group_end();
		return $this->db->get('pengumuman')->result();
	}

	public function get_skpd()
	{
		$query = $this->db->get('ref_skpd');
		return $query->num_rows();
	}

	public function get_sasaran()
	{
		$this->db->where('id_unit',$this->session->userdata('unit_kerja_id'));
		if ($this->session->userdata('level_unit_kerja')==0 OR $this->session->userdata('level_unit_kerja')==1) {
			$query = $this->db->get('sasaran_strategis');
		} elseif ($this->session->userdata('level_unit_kerja')==2) {
			$query = $this->db->get('sasaran_program');
		} else {
			$query = $this->db->get('sasaran_kegiatan');
		}
		return $query->num_rows();
	}



	public function getCapaianIndikator()
	{
		if ($this->session->userdata('level') == "Administrator") {
			$this->db->where('ref_unit_kerja.level_unit_kerja','0');
		} else {
			$this->db->where('pencapaian_indikator.id_unit',$this->session->userdata('unit_kerja_id'));
		}
		$this->db->where('pencapaian_indikator.tahun',date('Y'));
		if ($this->session->userdata('level_unit_kerja')==0 OR $this->session->userdata('level_unit_kerja')==1) {
			$this->db->join("sasaran_strategis_indikator","sasaran_strategis_indikator.uid_iku=pencapaian_indikator.uid_iku","left");
			$this->db->join('ref_satuan','ref_satuan.id_satuan=sasaran_strategis_indikator.id_satuan','left');
		} elseif ($this->session->userdata('level_unit_kerja')==2) {
			$this->db->join("sasaran_program_indikator","sasaran_program_indikator.uid_iku=pencapaian_indikator.uid_iku","left");
			$this->db->join('ref_satuan','ref_satuan.id_satuan=sasaran_program_indikator.id_satuan','left');
		} else {
			$this->db->join("sasaran_kegiatan_indikator","sasaran_kegiatan_indikator.uid_iku=pencapaian_indikator.uid_iku","left");
			$this->db->join('ref_satuan','ref_satuan.id_satuan=sasaran_kegiatan_indikator.id_satuan','left');
		}

		$this->db->join('ref_unit_kerja','ref_unit_kerja.id_unit_kerja=pencapaian_indikator.id_unit','left');
		$query = $this->db->get('pencapaian_indikator');
		return $query->result();
	}

	public function getCapaianTahunan()
	{
		$capaian = 0;
		$this->db->where("tahun",date('Y'));
		if ($this->session->userdata('level') == "Administrator") {
			$this->db->where('id_unit','89');
		} else {
			$this->db->where('id_unit',$this->session->userdata('unit_kerja_id'));
		}
		//$this->db->select("avg(capaian) as capaian");
		//$this->db->join("ref_unit_kerja","ref_unit_kerja.id_unit_kerja = pencapaian_unit_detail.id_unit","left");
		//$this->db->where("(ref_unit_kerja.ket_induk like '%|$id_unit|%' OR id_unit = $id_unit)");
		$qry = $this->db->get("pencapaian_unit");
		$res = $qry->result();
		if(!empty($res[0]->nilai)){
			$capaian = number_format($res[0]->nilai,2);
		}
		return $capaian;
	}


	public function get_user()
	{
		$query = $this->db->get('user');
		return $query->num_rows();
	}
	public function get_message()
	{
		$this->db->where('status','unread');
		$query = $this->db->get('contact');
		return $query->num_rows();
	}
	public function get_post()
	{
		$query = $this->db->get('post');
		return $query->num_rows();
	}

	public function get_status(){
		//$this->db->group_by('user_statuses.user_id');
		$this->db->join('user','user.user_id=user_statuses.user_id');
		$query = $this->db->get('user_statuses');
		return $query->result();
	}

	public function get_services()
	{
		$query = $this->db->get('services');
		return $query->num_rows();
	}

	public function get_product()
	{
		$query = $this->db->get('product');
		return $query->num_rows();
	}

	public function get_helpdesk()
	{
		$query = $this->db->get('helpdesk');
		return $query->num_rows();
	}


	public function get_portofolio()
	{
		$query = $this->db->get('portofolio');
		return $query->num_rows();
	}

	public function get_notice_board(){
		$this->db->where('status','Y');
		$query = $this->db->get('notice_board');
		return $query->row();
	}


	public function get_client()
	{
		$query = $this->db->get('client');
		return $query->num_rows();
	}

	public function get_lembaga()
	{
		$this->db->where('level', 'lembaga');
		$query = $this->db->get('ref_instansi');
		return $query->num_rows();
	}

	public function get_koordinator()
	{
		$this->db->where('level', 'koordinator');
		$query = $this->db->get('ref_instansi');
		return $query->num_rows();
	}


	public function get_kegiatan()
	{
		$this->db->where('tahun_target_kegiatan_kl', date('Y'));
		$query = $this->db->get('target_kegiatan_kl');
		return $query->num_rows();
	}


	public function get_kegiatan_prov()
	{
		$this->db->where('tahun_target_kegiatan_kl', date('Y'));
		$query = $this->db->get('target_kegiatan_kl');
		return $query->num_rows();
	}


	public function get_download()
	{
		$query = $this->db->get('download');
		return $query->num_rows();
	}


	public function get_video()
	{
		$query = $this->db->get('video');
		return $query->num_rows();
	}


	public function get_misi()
	{
		$query = $this->db->get('misi');
		return $query->num_rows();
	}

	public function get_sasaran_strategis()
	{
		$query = $this->db->get('sasaran_strategis_renstra');
		return $query->num_rows();
	}

	public function get_sasaran_program()
	{
		$query = $this->db->get('sasaran_program_renstra');
		return $query->num_rows();
	}

	public function get_sasaran_kegiatan()
	{
		$query = $this->db->get('sasaran_kegiatan_renstra');
		return $query->num_rows();
	}

	public function total_izin()
	{
		$this->db->select("id_perizinan");
		$query = $this->db->get('tbl_perizinan');
		$rs = $query->num_rows();
		if (!empty($rs)) return $rs;
		else return 0;
	}

	public function total_izin_tahunan()
	{
		$tahun = date('Y');
		$this->db->select("id_perizinan");
		$this->db->where("year(tanggal_sk) = '$tahun' ");
		$query = $this->db->get('tbl_perizinan');
		$rs = $query->num_rows();
		if (!empty($rs)) return $rs;
		else return 0;
	}

	public function total_izin_akan_habis()
	{
		$tgl_skrg = date('Y-m-d');
		$warning_date = date('Y-m-d', strtotime ( '+60 day' , strtotime ( $tgl_skrg ) ) ) ;
		$this->db->select("id_perizinan");
		$this->db->where("tanggal_akhir_sk > '$tgl_skrg' ");
		$this->db->where("tanggal_akhir_sk <= '$warning_date' ");
		$query = $this->db->get('tbl_perizinan');
		$rs = $query->num_rows();
		if (!empty($rs)) return $rs;
		else return 0;
	}

	public function total_izin_nonaktif()
	{
		$tgl_skrg = date('Y-m-d');
		$tahun = date('Y');
		$this->db->select("id_perizinan");
		$this->db->where("year(tanggal_akhir_sk) = '$tahun' ");
		$this->db->where("tanggal_akhir_sk <= '$tgl_skrg' ");
		$query = $this->db->get('tbl_perizinan');
		$rs = $query->num_rows();
		if (!empty($rs)) return $rs;
		else return 0;
	}

	public function total_investasi($tahun,$type=null)
	{
		$this->db->select("sum(amount) as total");
		$this->db->where("year(date_finance) = '$tahun' ");
		if (!empty($type)) $this->db->where('type',$type);
		$query = $this->db->get('finance');
		$rs = $query->result();
		if (!empty($rs)) return $rs[0]->total;
		else return 0;
	}

	public function get_total_investasi($tahun,$bulan,$type=null)
	{
		$this->db->select("sum(amount) as total");
		$this->db->where("year(date_finance) = '$tahun' ");
		$this->db->where("month(date_finance) = '$bulan' ");
		if (!empty($type)) $this->db->where('type',$type);
		$query = $this->db->get('finance');
		$rs = $query->result();
		if (!empty($rs)) return $rs[0]->total;
		else return 0;
	}

	public function total_finance($date,$type=null)
	{
		$this->db->select("sum(amount) as total");
		$this->db->like('date_finance',$date);
		if (!empty($type)) $this->db->where('type',$type);
		$query = $this->db->get('finance');
		$rs = $query->result();
		if (!empty($rs)) return $rs[0]->total;
		else return 0;
	}


	public function get_total_visitor($tahun,$bulan,$type=null)
	{
		$this->db->select("id");
		$this->db->where("year(date) = '$tahun' ");
		$this->db->where("month(date) = '$bulan' ");
		if (!empty($type)) $this->db->where('type',$type);
		$query = $this->db->get('visitor');
		$rs = $query->num_rows();
		if (!empty($rs)) return $rs;
		else return 0;
	}

	public function get_data_koordinator()
	{
		$this->db->where('level','koordinator');
		$query = $this->db->get('ref_instansi')->result();
		return $query;
	}

	public function get_data_lembaga($id_koordinator=NULL)
	{
		if($id_koordinator) $this->db->where('id_koordinator',$id_koordinator);
		$this->db->where('level','lembaga');
		$query = $this->db->get('ref_instansi')->result();
		return $query;
	}

	public function get_triwulan($triwulan,$tahun=NULL,$id_koordinator=NULL,$id_sub_koordinator=NULL){
		if($triwulan==1){
			$this->db->where('MONTH(tanggal_akhir) >=', '1');
			$this->db->where('MONTH(tanggal_akhir) <=', '3');
		} elseif($triwulan==2){
			$this->db->where('MONTH(tanggal_akhir) >=', '4');
			$this->db->where('MONTH(tanggal_akhir) <=', '6');
		} elseif($triwulan==3){
			$this->db->where('MONTH(tanggal_akhir) >=', '7');
			$this->db->where('MONTH(tanggal_akhir) <=', '9');
		} elseif($triwulan==4){
			$this->db->where('MONTH(tanggal_akhir) >=', '10');
			$this->db->where('MONTH(tanggal_akhir) <=', '12');
		}
		if($tahun) $this->db->where('tahun_realisasi_kegiatan_kl',$tahun);
		if($id_koordinator) $this->db->where('id_koordinator',$id_koordinator);
		if($id_sub_koordinator) $this->db->where('id_sub_koordinator',$id_sub_koordinator);
		$query = $this->db->get('realisasi_kegiatan_kl')->num_rows();
		return $query;
	}

	public function get_realisasi($bulan=NULL,$tahun=NULL,$id_koordinator=NULL,$id_sub_koordinator=NULL){
		if($bulan) $this->db->where('MONTH(tanggal_akhir)',$bulan);
		if($tahun) $this->db->where('tahun_realisasi_kegiatan_kl',$tahun);
		if($id_koordinator) $this->db->where('id_koordinator',$id_koordinator);
		if($id_sub_koordinator) $this->db->where('id_sub_koordinator',$id_sub_koordinator);
		$query = $this->db->get('realisasi_kegiatan_kl')->num_rows();
		return $query;
	}

	public function get_target($bulan=NULL,$tahun=NULL,$id_koordinator=NULL,$id_sub_koordinator=NULL){
		if($bulan) $this->db->where('MONTH(tanggal_akhir)',$bulan);
		if($tahun) $this->db->where('tahun_target_kegiatan_kl',$tahun);
		if($id_koordinator) $this->db->where('id_koordinator',$id_koordinator);
		if($id_sub_koordinator) $this->db->where('id_sub_koordinator',$id_sub_koordinator);
		$query = $this->db->get('target_kegiatan_kl')->num_rows();
		return $query;
	}

	public function get_average($triwulan,$id_koordinator){
		if($triwulan==1){
			$this->db->where('MONTH(tanggal_akhir) >=', '1');
			$this->db->where('MONTH(tanggal_akhir) <=', '3');
		} elseif($triwulan==2){
			$this->db->where('MONTH(tanggal_akhir) >=', '4');
			$this->db->where('MONTH(tanggal_akhir) <=', '6');
		} elseif($triwulan==3){
			$this->db->where('MONTH(tanggal_akhir) >=', '7');
			$this->db->where('MONTH(tanggal_akhir) <=', '9');
		} elseif($triwulan==4){
			$this->db->where('MONTH(tanggal_akhir) >=', '10');
			$this->db->where('MONTH(tanggal_akhir) <=', '12');
		}
		$this->db->where('id_koordinator',$id_koordinator);
		$q2 = $this->db->get('target_kegiatan_kl')->result();
		$hasil = array();
		foreach($q2 as $r){
			$this->db->where('id_target_kegiatan_kl',$r->id_target_kegiatan_kl);
			$q = $this->db->get('realisasi_kegiatan_kl')->num_rows();
			$sisa = $r->jumlah_target_kegiatan - $q;
			$persen = $q/$r->jumlah_target_kegiatan*100;
			$hasil[] = round($persen,2);
		}
		// $total = count($hasil);
		$jumlah = 0;
		foreach($hasil as $h){
			if($h>=1){
				$jumlah++;
			}
		}
		$total = array_sum($hasil);
		$average = $total/$jumlah;
		// return $total;
		return round($average,2);
	}

	public function get_agenda_umum($id_skpd){
		$today = date("Y-m-d");

		$this->db->join('pegawai', 'pegawai.id_pegawai = calendar_umum.id_pegawai');
		$this->db->where('start_date >=', $today);
		$this->db->order_by('start_date', 'asc');
		$this->db->where('calendar_umum.id_skpd', $id_skpd);
		$query = $this->db->get('calendar_umum');

		return $query->result();
	}

	public function get_agenda_pribadi(){

		$this->db->order_by('start_date', 'asc');
		$query = $this->db->get('calendar_pribadi');

		return $query->result();
	}

	public function get_agenda_pribadi_by($id_pegawai){
		$today = date("Y-m-d");

		$this->db->where('start_date >=', $today);
		$this->db->order_by('start_date', 'asc');
		$this->db->where('id_pegawai', $id_pegawai);
		$query = $this->db->get('calendar_pribadi');

		return $query->result();
	}

	public function cek_password($id,$password){
		$this->db->where('password', md5($password));
		$this->db->where('user_id',$id);
		return $this->db->get('user')->num_rows();
	}

	public function update_password($id,$pass=null){
		if($pass==null){
			$data = array('password' => md5($this->input->post('n_password')));
		}else{
			$data = array('password' => md5($pass));
		}
		$this->db->where('user_id', $id);
		return $this->db->update('user', $data);
	}

	public function get_ketersediaan($where){
		$this->db->where('id_ketersediaan !=', $where);
		return $this->db->get('ketersediaan_user')->result();
	}

	public function update_ketersediaan($id){
		$data = array('id_ketersediaan' => $this->input->post('ketersediaan'));
		$this->db->where('user_id', $id);
		return $this->db->update('user', $data);
	}
	//get by id
	public function riwayat_pangkat_by_id($id_pangkat){
		$this->db->where('id', $id_pangkat);
		return $this->db->get('riwayat_pangkat')->row();
	}
	public function riwayat_jabatan_by_id($id_jabatan){
		$this->db->where('id', $id_jabatan);
		return $this->db->get('riwayat_jabatan')->row();
	}
	public function riwayat_pendidikan_by_id($id_pendidikan){
		$this->db->where('id', $id_pendidikan);
		return $this->db->get('riwayat_pendidikan')->row();
	}
	public function riwayat_diklat_by_id($id_diklat){
		$this->db->where('id', $id_diklat);
		return $this->db->get('riwayat_diklat')->row();
	}
	public function riwayat_penataran_by_id($id_penataran){
		$this->db->where('id', $id_penataran);
		return $this->db->get('riwayat_penataran')->row();
	}
	public function riwayat_seminar_by_id($id_seminar){
		$this->db->where('id', $id_seminar);
		return $this->db->get('riwayat_seminar')->row();
	}
	public function riwayat_kursus_by_id($id_kursus){
		$this->db->where('id', $id_kursus);
		return $this->db->get('riwayat_kursus')->row();
	}
	public function riwayat_unit_kerja_by_id($id_unit_kerja){
		$this->db->where('id', $id_unit_kerja);
		return $this->db->get('riwayat_unit_kerja')->row();
	}
	public function riwayat_penghargaan_by_id($id_penghargaan){
		$this->db->where('id', $id_penghargaan);
		return $this->db->get('riwayat_penghargaan')->row();
	}
	public function riwayat_penugasan_by_id($id_penugasan){
		$this->db->where('id', $id_penugasan);
		return $this->db->get('riwayat_penugasan')->row();
	}
	public function riwayat_cuti_by_id($id_cuti){
		$this->db->where('id', $id_cuti);
		return $this->db->get('riwayat_cuti')->row();
	}
	public function riwayat_hukuman_by_id($id_hukuman){
		$this->db->where('id', $id_hukuman);
		return $this->db->get('riwayat_hukuman')->row();
	}
	public function riwayat_bahasa_by_id($id_bahasa){
		$this->db->where('id', $id_bahasa);
		return $this->db->get('riwayat_bahasa')->row();
	}
	public function riwayat_bahasa_asing_by_id($id_bahasa_asing){
		$this->db->where('id', $id_bahasa_asing);
		return $this->db->get('riwayat_bahasa_asing')->row();
	}
	public function riwayat_pernikahan_by_id($id_pernikahan){
		$this->db->where('id', $id_pernikahan);
		return $this->db->get('riwayat_pernikahan')->row();
	}
	public function riwayat_anak_by_id($id_anak){
		$this->db->where('id', $id_anak);
		return $this->db->get('riwayat_anak')->row();
	}
	public function riwayat_orangtua_by_id($id_orangtua){
		$this->db->where('id', $id_orangtua);
		return $this->db->get('riwayat_orangtua')->row();
	}
	public function riwayat_mertua_by_id($id_mertua){
		$this->db->where('id', $id_mertua);
		return $this->db->get('riwayat_mertua')->row();
	}

	// Kepegawaian Create
	public function add_riwayat_pangkat_by_id($id_pegawai){
		$data = array(
			'id_pegawai' => $id_pegawai,
			'nip' => $this->input->post('nip'),
			'id_golongan' => $this->input->post('id_golongan'),
			'tmt_berlaku' => $this->input->post('tmt_berlaku'),
			'gaji_pokok' => $this->input->post('gaji_pokok'),
			'nama_pejabat' => $this->input->post('nama_pejabat'),
			'no_sk' => $this->input->post('no_sk'),
			'tgl_sk' => $this->input->post('tgl_sk'),
			'verifikasi_pegawai' => 'true',
			'tgl_verifikasi_pegawai' => date('Y-m-d H:i:s'),
			'berkas' => $this->_berkasPangkat($id_pegawai),
			'status' => 0,
			'created_at' => date('Y-m-d H:i:s')
		);
		$this->db->insert('riwayat_pangkat', $data);
	}
	public function add_riwayat_jabatan_by_id($id_pegawai){
		$data = array(
			'id_pegawai' => $id_pegawai,
			'nip' => $this->input->post('nip'),
			'id_golongan' => $this->input->post('id_golongan'),
			'id_eselon' => $this->input->post('id_eselon'),
			'nama_jabatan_sementara' => $this->input->post('nama_jabatan_sementara'),
			'jenis_jabatan_sementara' => $this->input->post('jenis_jabatan_sementara'),
			'tgl_mulai' => $this->input->post('tgl_mulai'),
			'tgl_akhir' => $this->input->post('tgl_akhir'),
			'gaji_pokok' => $this->input->post('gaji_pokok'),
			'nama_pejabat' => $this->input->post('nama_pejabat'),
			'no_sk' => $this->input->post('no_sk'),
			'tgl_sk' => $this->input->post('tgl_sk'),
			'nuptk' => $this->input->post('nuptk'),
			'verifikasi_pegawai' => 'true',
			'tgl_verifikasi_pegawai' => date('Y-m-d H:i:s'),
			'berkas' => $this->_berkasJabatan($id_pegawai),
			'status' => 0,
			'created_at' => date('Y-m-d H:i:s')
		);
		$this->db->insert('riwayat_jabatan', $data);
	}
	public function add_riwayat_pendidikan_by_id($id_pegawai){
		$data = array(
			'id_pegawai' => $id_pegawai,
			'nip' => $this->input->post('nip'),
			'id_jenjangpendidikan' => $this->input->post('id_jenjangpendidikan'),
			'id_tempatpendidikan' => $this->input->post('id_tempatpendidikan'),
			'id_jurusan' => $this->input->post('id_jurusan'),
			'nama_pejabat' => $this->input->post('nama_pejabat'),
			'nomor_sk' => $this->input->post('nomor_sk'),
			'tgl_sk' => $this->input->post('tgl_sk'),
			'verifikasi_pegawai' => 'true',
			'tgl_verifikasi_pegawai' => date('Y-m-d H:i:s'),
			'berkas' => $this->_berkasPendidikan($id_pegawai),
			'status' => 0,
			'created_at' => date('Y-m-d H:i:s')
		);
		$this->db->insert('riwayat_pendidikan', $data);
	}
	public function add_riwayat_diklat_by_id($id_pegawai){
		$data = array(
			'id_pegawai' => $id_pegawai,
			'nip' => $this->input->post('nip'),
			'id_jenisdiklat' => $this->input->post('id_jenisdiklat'),
			'tempat' => $this->input->post('tempat'),
			'penyelenggara' => $this->input->post('penyelenggara'),
			'angkatan' => $this->input->post('angkatan'),
			'nama_diklat' => $this->input->post('nama_diklat'),
			'tgl_mulai' => $this->input->post('tgl_mulai'),
			'tgl_akhir' => $this->input->post('tgl_akhir'),
			'no_sptl' => $this->input->post('no_sptl'),
			'tgl_sptl' => $this->input->post('tgl_sptl'),
			'verifikasi_pegawai' => 'true',
			'tgl_verifikasi_pegawai' => date('Y-m-d H:i:s'),
			'berkas' => $this->_berkasDiklat($id_pegawai),
			'status' => 0,
			'created_at' => date('Y-m-d H:i:s')
		);
		$this->db->insert('riwayat_diklat', $data);
	}
	public function add_riwayat_penataran_by_id($id_pegawai){
		$data = array(
			'id_pegawai' => $id_pegawai,
			'nip' => $this->input->post('nip'),
			'id_penataran' => $this->input->post('id_penataran'),
			'tempat' => $this->input->post('tempat'),
			'penyelenggara' => $this->input->post('penyelenggara'),
			'angkatan' => $this->input->post('angkatan'),
			'nama_riwayat_penataran' => $this->input->post('nama_riwayat_penataran'),
			'tgl_mulai_penataran' => $this->input->post('tgl_mulai_penataran'),
			'tgl_akhir_penataran' => $this->input->post('tgl_akhir_penataran'),
			'nomer_stpl' => $this->input->post('nomer_stpl'),
			'tgl_stpl' => $this->input->post('tgl_stpl'),
			'verifikasi_pegawai' => 'true',
			'tgl_verifikasi_pegawai' => date('Y-m-d H:i:s'),
			'berkas' => $this->_berkasPenataran($id_pegawai),
			'status' => 0,
			'created_at' => date('Y-m-d H:i:s')
		);
		$this->db->insert('riwayat_penataran', $data);
	}
	public function add_riwayat_seminar_by_id($id_pegawai){
		$data = array(
			'id_pegawai' => $id_pegawai,
			'nip' => $this->input->post('nip'),
			'id_jenisseminar' => $this->input->post('id_jenisseminar'),
			'tempat' => $this->input->post('tempat'),
			'penyelenggara' => $this->input->post('penyelenggara'),
			'angkatan' => $this->input->post('angkatan'),
			'nama_riwayat_seminar' => $this->input->post('nama_riwayat_seminar'),
			'tgl_mulai_seminar' => $this->input->post('tgl_mulai_seminar'),
			'tgl_akhir_seminar' => $this->input->post('tgl_akhir_seminar'),
			'nomer_stpl' => $this->input->post('nomer_stpl'),
			'tgl_stpl' => $this->input->post('tgl_stpl'),
			'verifikasi_pegawai' => 'true',
			'tgl_verifikasi_pegawai' => date('Y-m-d H:i:s'),
			'berkas' => $this->_berkasSeminar($id_pegawai),
			'status' => 0,
			'created_at' => date('Y-m-d H:i:s')
		);
		$this->db->insert('riwayat_seminar', $data);
	}
	public function add_riwayat_kursus_by_id($id_pegawai){
		$data = array(
			'id_pegawai' => $id_pegawai,
			'nip' => $this->input->post('nip'),
			'id_kursus' => $this->input->post('id_kursus'),
			'tempat' => $this->input->post('tempat'),
			'penyelenggara' => $this->input->post('penyelenggara'),
			'angkatan' => $this->input->post('angkatan'),
			'nama_riwayat_kursus' => $this->input->post('nama_riwayat_kursus'),
			'tgl_mulai_kursus' => $this->input->post('tgl_mulai_kursus'),
			'tgl_akhir_kursus' => $this->input->post('tgl_akhir_kursus'),
			'nomer_stpl' => $this->input->post('nomer_stpl'),
			'tgl_stpl' => $this->input->post('tgl_stpl'),
			'verifikasi_pegawai' => 'true',
			'tgl_verifikasi_pegawai' => date('Y-m-d H:i:s'),
			'berkas' => $this->_berkasKursus($id_pegawai),
			'status' => 0,
			'created_at' => date('Y-m-d H:i:s')
		);
		$this->db->insert('riwayat_kursus', $data);
	}
	public function add_riwayat_unit_kerja_by_id($id_pegawai){
		$data = array(
			'id_pegawai' => $id_pegawai,
			'nip' => $this->input->post('nip'),
			'id_unit_kerja' => $this->input->post('id_unit_kerja'),
			'tmt_awal' => $this->input->post('tmt_awal'),
			'tmt_akhir' => $this->input->post('tmt_akhir'),
			'no_sk_awal' => $this->input->post('no_sk_awal'),
			'no_sk_akhir' => $this->input->post('no_sk_akhir'),
			'verifikasi_pegawai' => 'true',
			'tgl_verifikasi_pegawai' => date('Y-m-d H:i:s'),
			'berkas' => $this->_berkasUnitKerja($id_pegawai),
			'status' => 0,
			'created_at' => date('Y-m-d H:i:s')
		);
		$this->db->insert('riwayat_unit_kerja', $data);
	}
	public function add_riwayat_penghargaan_by_id($id_pegawai){
		$data = array(
			'id_pegawai' => $id_pegawai,
			'nip' => $this->input->post('nip'),
			'id_jenispenghargaan' => $this->input->post('id_jenispenghargaan'),
			'nama_penghargaan' => $this->input->post('nama_penghargaan'),
			'tahun' => $this->input->post('tahun'),
			'asal_perolehan' => $this->input->post('asal_perolehan'),
			'penandatangan' => $this->input->post('penandatangan'),
			'no_penghargaan' => $this->input->post('no_penghargaan'),
			'tgl_penghargaan' => $this->input->post('tgl_penghargaan'),
			'verifikasi_pegawai' => 'true',
			'tgl_verifikasi_pegawai' => date('Y-m-d H:i:s'),
			'berkas' => $this->_berkasPenghargaan($id_pegawai),
			'status' => 0,
			'created_at' => date('Y-m-d H:i:s')
		);
		$this->db->insert('riwayat_penghargaan', $data);
	}
	public function add_riwayat_penugasan_by_id($id_pegawai){
		$data = array(
			'id_pegawai' => $id_pegawai,
			'nip' => $this->input->post('nip'),
			'id_jenispenugasan' => $this->input->post('id_jenispenugasan'),
			'tempat' => $this->input->post('tempat'),
			'pejabat_penetap' => $this->input->post('pejabat_penetap'),
			'tgl_mulai_penugasan' => $this->input->post('tgl_mulai_penugasan'),
			'tgl_akhir_penugasan' => $this->input->post('tgl_akhir_penugasan'),
			'nomer_sk' => $this->input->post('nomer_sk'),
			'tgl_sk' => $this->input->post('tgl_sk'),
			'verifikasi_pegawai' => 'true',
			'tgl_verifikasi_pegawai' => date('Y-m-d H:i:s'),
			'berkas' => $this->_berkasPenugasan($id_pegawai),
			'status' => 0,
			'created_at' => date('Y-m-d H:i:s')
		);
		$this->db->insert('riwayat_penugasan', $data);
	}
	public function add_riwayat_cuti_by_id($id_pegawai){
		$data = array(
			'id_pegawai' => $id_pegawai,
			'nip' => $this->input->post('nip'),
			'id_jeniscuti' => $this->input->post('id_jeniscuti'),
			'keterangan' => $this->input->post('keterangan'),
			'pejabat_penetapan' => $this->input->post('pejabat_penetapan'),
			'tgl_awal_cuti' => $this->input->post('tgl_awal_cuti'),
			'tgl_akhir_cuti' => $this->input->post('tgl_akhir_cuti'),
			'no_sk' => $this->input->post('no_sk'),
			'tgl_sk' => $this->input->post('tgl_sk'),
			'verifikasi_pegawai' => 'true',
			'tgl_verifikasi_pegawai' => date('Y-m-d H:i:s'),
			'berkas' => $this->_berkasCuti($id_pegawai),
			'status' => 0,
			'created_at' => date('Y-m-d H:i:s')
		);
		$this->db->insert('riwayat_cuti', $data);
	}
	public function add_riwayat_hukuman_by_id($id_pegawai){
		$data = array(
			'id_pegawai' => $id_pegawai,
			'nip' => $this->input->post('nip'),
			'id_jenishukuman' => $this->input->post('id_jenishukuman'),
			'keterangan' => $this->input->post('keterangan'),
			'pejabat_penetap' => $this->input->post('pejabat_penetap'),
			'tgl_mulai_hukuman' => $this->input->post('tgl_mulai_hukuman'),
			'tgl_akhir_hukuman' => $this->input->post('tgl_akhir_hukuman'),
			'nomer_sk' => $this->input->post('nomer_sk'),
			'tgl_sk' => $this->input->post('tgl_sk'),
			'verifikasi_pegawai' => 'true',
			'tgl_verifikasi_pegawai' => date('Y-m-d H:i:s'),
			'berkas' => $this->_berkasHukuman($id_pegawai),
			'status' => 0,
			'created_at' => date('Y-m-d H:i:s')
		);
		$this->db->insert('riwayat_hukuman', $data);
	}
	public function add_riwayat_bahasa_by_id($id_pegawai){
		$data = array(
			'id_pegawai' => $id_pegawai,
			'nip' => $this->input->post('nip'),
			'id_bahasa' => $this->input->post('id_bahasa'),
			'kemampuan' => $this->input->post('kemampuan'),
			'verifikasi_pegawai' => 'true',
			'tgl_verifikasi_pegawai' => date('Y-m-d H:i:s'),
			'berkas' => $this->_berkasBahasa($id_pegawai),
			'status' => 0,
			'created_at' => date('Y-m-d H:i:s')
		);
		$this->db->insert('riwayat_bahasa', $data);
	}
	public function add_riwayat_bahasa_asing_by_id($id_pegawai){
		$data = array(
			'id_pegawai' => $id_pegawai,
			'nip' => $this->input->post('nip'),
			'id_bahasa_asing' => $this->input->post('id_bahasa_asing'),
			'kemampuan' => $this->input->post('kemampuan'),
			'verifikasi_pegawai' => 'true',
			'tgl_verifikasi_pegawai' => date('Y-m-d H:i:s'),
			'berkas' => $this->_berkasBahasaAsing($id_pegawai),
			'status' => 0,
			'created_at' => date('Y-m-d H:i:s')
		);
		$this->db->insert('riwayat_bahasa_asing', $data);
	}
	public function add_riwayat_pernikahan_by_id($id_pegawai){
		$data = array(
			'id_pegawai' => $id_pegawai,
			'nip' => $this->input->post('nip'),
			'id_jenjangpendidikan' => $this->input->post('id_jenjangpendidikan'),
			'pekerjaan' => $this->input->post('pekerjaan'),
			'nama' => $this->input->post('nama'),
			'tempat_lahir' => $this->input->post('tempat_lahir'),
			'tgl_lahir' => $this->input->post('tgl_lahir'),
			'tgl_menikah' => $this->input->post('tgl_menikah'),
			'keterangan' => $this->input->post('keterangan'),
			'verifikasi_pegawai' => 'true',
			'tgl_verifikasi_pegawai' => date('Y-m-d H:i:s'),
			'berkas' => $this->_berkasPernikahan($id_pegawai),
			'status' => 0,
			'created_at' => date('Y-m-d H:i:s')
		);
		$this->db->insert('riwayat_pernikahan', $data);
	}
	public function add_riwayat_anak_by_id($id_pegawai){
		$data = array(
			'id_pegawai' => $id_pegawai,
			'nip' => $this->input->post('nip'),
			'id_jenjangpendidikan' => $this->input->post('id_jenjangpendidikan'),
			'pekerjaan' => $this->input->post('pekerjaan'),
			'nama' => $this->input->post('nama'),
			'tempat_lahir' => $this->input->post('tempat_lahir'),
			'tgl_lahir' => $this->input->post('tgl_lahir'),
			'jenis_kelamin' => $this->input->post('jenis_kelamin'),
			'keterangan' => $this->input->post('keterangan'),
			'verifikasi_pegawai' => 'true',
			'tgl_verifikasi_pegawai' => date('Y-m-d H:i:s'),
			'berkas' => $this->_berkasAnak($id_pegawai),
			'status' => 0,
			'created_at' => date('Y-m-d H:i:s')
		);
		$this->db->insert('riwayat_anak', $data);
	}
	public function add_riwayat_orangtua_by_id($id_pegawai){
		$data = array(
			'id_pegawai' => $id_pegawai,
			'nip' => $this->input->post('nip'),
			'id_jenjangpendidikan' => $this->input->post('id_jenjangpendidikan'),
			'pekerjaan' => $this->input->post('pekerjaan'),
			'nama' => $this->input->post('nama'),
			'tempat_lahir' => $this->input->post('tempat_lahir'),
			'tgl_lahir' => $this->input->post('tgl_lahir'),
			'jenis_kelamin' => $this->input->post('jenis_kelamin'),
			'keterangan' => $this->input->post('keterangan'),
			'verifikasi_pegawai' => 'true',
			'tgl_verifikasi_pegawai' => date('Y-m-d H:i:s'),
			'berkas' => $this->_berkasOrangtua($id_pegawai),
			'status' => 0,
			'created_at' => date('Y-m-d H:i:s')
		);
		$this->db->insert('riwayat_orangtua', $data);
	}
	public function add_riwayat_mertua_by_id($id_pegawai){
		$data = array(
			'id_pegawai' => $id_pegawai,
			'nip' => $this->input->post('nip'),
			'id_jenjangpendidikan' => $this->input->post('id_jenjangpendidikan'),
			'pekerjaan' => $this->input->post('pekerjaan'),
			'nama' => $this->input->post('nama'),
			'tempat_lahir' => $this->input->post('tempat_lahir'),
			'tgl_lahir' => $this->input->post('tgl_lahir'),
			'jenis_kelamin' => $this->input->post('jenis_kelamin'),
			'keterangan' => $this->input->post('keterangan'),
			'verifikasi_pegawai' => 'true',
			'tgl_verifikasi_pegawai' => date('Y-m-d H:i:s'),
			'berkas' => $this->_berkasMertua($id_pegawai),
			'status' => 0,
			'created_at' => date('Y-m-d H:i:s')
		);
		$this->db->insert('riwayat_mertua', $data);
	}

	//Kepegawaian Update
	public function update_master_pegawai_by_nip($nip){
		$data = array(
			'nip_lama' => $this->input->post('nip_lama'),
			'nip_baru' => $this->input->post('nip_baru'),
			'karpeg' => $this->input->post('karpeg'),
			'id_gelardepan' => $this->input->post('id_gelardepan'),
			'nama_lengkap' => $this->input->post('nama_lengkap'),
			'id_gelarbelakang' => $this->input->post('id_gelarbelakang'),
			'tgl_lahir' => $this->input->post('tgl_lahir'),
			'tempat_lahir' => $this->input->post('tempat_lahir'),
			'id_agama' => $this->input->post('id_agama'),
			'jenis_kelamin' => $this->input->post('jenis_kelamin'),
			'bayar_gaji' => $this->input->post('bayar_gaji'),
			'kedudukan_pegawai' => $this->input->post('kedudukan_pegawai'),
			'status_pegawai' => $this->input->post('status_pegawai'),
			'alamat' => $this->input->post('alamat'),
			'RT' => $this->input->post('RT'),
			'RW' => $this->input->post('RW'),
			'id_desa' => $this->input->post('id_desa'),
			'id_kecamatan' => $this->input->post('id_kecamatan'),
			'id_kabupaten' => $this->input->post('id_kabupaten'),
			'id_provinsi' => $this->input->post('id_provinsi'),
			'kode_pos' => $this->input->post('kode_pos'),
			'telepon' => $this->input->post('telepon'),
			'kartu_askes' => $this->input->post('kartu_askes'),
			'kartu_taspen' => $this->input->post('kartu_taspen'),
			'karis_karsu' => $this->input->post('karis_karsu'),
			'npwp' => $this->input->post('npwp'),
			'id_statusmenikah' => $this->input->post('id_statusmenikah'),
			'jml_tanggungan_anak' => $this->input->post('jml_tanggungan_anak'),
			'jml_seluruh_anak' => $this->input->post('jml_seluruh_anak'),
			'jml_seluruh_anak' => $this->input->post('jml_seluruh_anak'),
			'cpns_tmt' => $this->input->post('cpns_tmt'),
			'cpns_id_golongan' => $this->input->post('cpns_id_golongan'),
			'cpns_no_sk' => $this->input->post('cpns_no_sk'),
			'cpns_pejabat' => $this->input->post('cpns_pejabat'),
			'cpns_id_jenjangpendidikan' => $this->input->post('cpns_id_jenjangpendidikan'),
			'cpns_tahun_pendidikan' => $this->input->post('cpns_tahun_pendidikan'),
			'pns_tmt' => $this->input->post('pns_tmt'),
			'pns_id_golongan' => $this->input->post('pns_id_golongan'),
			'pns_pejabat' => $this->input->post('pns_pejabat'),
			'pns_no_sk' => $this->input->post('pns_no_sk'),
			'status' => 0,
			'updated_at' => date('Y-m-d H:i:s')
		);
		$this->db->where('nip_baru', $nip);
		$this->db->update('master_pegawai', $data);
	}

	//Kepegawaian Delete
	public function delete_riwayat_pangkat_by_id($id_pangkat, $id_pegawai){
		$this->_deletePangkat($id_pangkat, $id_pegawai);
		$this->db->where('id', $id_pangkat);
		$this->db->delete('riwayat_pangkat');
	}
	public function delete_riwayat_jabatan_by_id($id_jabatan, $id_pegawai){
		$this->_deleteJabatan($id_jabatan, $id_pegawai);
		$this->db->where('id', $id_jabatan);
		$this->db->delete('riwayat_jabatan');
	}
	public function delete_riwayat_pendidikan_by_id($id_pendidikan, $id_pegawai){
		$this->_deletePendidikan($id_pendidikan, $id_pegawai);
		$this->db->where('id', $id_pendidikan);
		$this->db->delete('riwayat_pendidikan');
	}
	public function delete_riwayat_diklat_by_id($id_diklat, $id_pegawai){
		$this->_deleteDiklat($id_diklat, $id_pegawai);
		$this->db->where('id', $id_diklat);
		$this->db->delete('riwayat_diklat');
	}
	public function delete_riwayat_penataran_by_id($id_penataran, $id_pegawai){
		$this->_deletePenataran($id_penataran, $id_pegawai);
		$this->db->where('id', $id_penataran);
		$this->db->delete('riwayat_penataran');
	}
	public function delete_riwayat_seminar_by_id($id_seminar, $id_pegawai){
		$this->_deleteSeminar($id_seminar, $id_pegawai);
		$this->db->where('id', $id_seminar);
		$this->db->delete('riwayat_seminar');
	}
	public function delete_riwayat_kursus_by_id($id_kursus, $id_pegawai){
		$this->_deleteKursus($id_kursus, $id_pegawai);
		$this->db->where('id', $id_kursus);
		$this->db->delete('riwayat_kursus');
	}
	public function delete_riwayat_unit_kerja_by_id($id_unit_kerja, $id_pegawai){
		$this->_deleteUnitKerja($id_unit_kerja, $id_pegawai);
		$this->db->where('id', $id_unit_kerja);
		$this->db->delete('riwayat_unit_kerja');
	}
	public function delete_riwayat_penghargaan_by_id($id_penghargaan, $id_pegawai){
		$this->_deletePenghargaan($id_penghargaan, $id_pegawai);
		$this->db->where('id', $id_penghargaan);
		$this->db->delete('riwayat_penghargaan');
	}
	public function delete_riwayat_penugasan_by_id($id_penugasan, $id_pegawai){
		$this->_deletePenugasan($id_penugasan, $id_pegawai);
		$this->db->where('id', $id_penugasan);
		$this->db->delete('riwayat_penugasan');
	}
	public function delete_riwayat_cuti_by_id($id_cuti, $id_pegawai){
		$this->_deleteCuti($id_cuti, $id_pegawai);
		$this->db->where('id', $id_cuti);
		$this->db->delete('riwayat_cuti');
	}
	public function delete_riwayat_hukuman_by_id($id_hukuman, $id_pegawai){
		$this->_deleteHukuman($id_hukuman, $id_pegawai);
		$this->db->where('id', $id_hukuman);
		$this->db->delete('riwayat_hukuman');
	}
	public function delete_riwayat_bahasa_by_id($id_bahasa, $id_pegawai){
		$this->_deleteBahasa($id_bahasa, $id_pegawai);
		$this->db->where('id', $id_bahasa);
		$this->db->delete('riwayat_bahasa');
	}
	public function delete_riwayat_bahasa_asing_by_id($id_bahasa_asing, $id_pegawai){
		$this->_deleteBahasaAsing($id_bahasa_asing, $id_pegawai);
		$this->db->where('id', $id_bahasa_asing);
		$this->db->delete('riwayat_bahasa_asing');
	}
	public function delete_riwayat_pernikahan_by_id($id_pernikahan, $id_pegawai){
		$this->_deletePernikahan($id_pernikahan, $id_pegawai);
		$this->db->where('id', $id_pernikahan);
		$this->db->delete('riwayat_pernikahan');
	}
	public function delete_riwayat_anak_by_id($id_anak, $id_pegawai){
		$this->_deleteAnak($id_anak, $id_pegawai);
		$this->db->where('id', $id_anak);
		$this->db->delete('riwayat_anak');
	}
	public function delete_riwayat_orangtua_by_id($id_orangtua, $id_pegawai){
		$this->_deleteOrangtua($id_orangtua, $id_pegawai);
		$this->db->where('id', $id_orangtua);
		$this->db->delete('riwayat_orangtua');
	}
	public function delete_riwayat_mertua_by_id($id_mertua, $id_pegawai){
		$this->_deleteMertua($id_mertua, $id_pegawai);
		$this->db->where('id', $id_mertua);
		$this->db->delete('riwayat_mertua');
	}

	// ADMIN -- KEPEGAWAIAN
	// Kepegawaian Create
	public function add_riwayat_pangkat_by_operator($id_pegawai){
	  $data = array(
	    'id_pegawai' => $id_pegawai,
	    'nip' => $this->input->post('nip'),
	    'id_golongan' => $this->input->post('id_golongan'),
	    'tmt_berlaku' => $this->input->post('tmt_berlaku'),
	    'gaji_pokok' => $this->input->post('gaji_pokok'),
	    'nama_pejabat' => $this->input->post('nama_pejabat'),
	    'no_sk' => $this->input->post('no_sk'),
	    'tgl_sk' => $this->input->post('tgl_sk'),
	    'verifikasi_bkd' => 'true',
	    'tgl_verifikasi_bkd' => date('Y-m-d H:i:s'),
			'berkas' => $this->_berkasPangkat($id_pegawai),
	    'status' => 0,
	    'created_at' => date('Y-m-d H:i:s')
	  );
	  $this->db->insert('riwayat_pangkat', $data);
	}
	public function add_riwayat_jabatan_by_operator($id_pegawai){
	  $data = array(
	    'id_pegawai' => $id_pegawai,
	    'nip' => $this->input->post('nip'),
	    'id_golongan' => $this->input->post('id_golongan'),
	    'id_eselon' => $this->input->post('id_eselon'),
	    'nama_jabatan_sementara' => $this->input->post('nama_jabatan_sementara'),
	    'jenis_jabatan_sementara' => $this->input->post('jenis_jabatan_sementara'),
	    'tgl_mulai' => $this->input->post('tgl_mulai'),
	    'tgl_akhir' => $this->input->post('tgl_akhir'),
	    'gaji_pokok' => $this->input->post('gaji_pokok'),
	    'nama_pejabat' => $this->input->post('nama_pejabat'),
	    'no_sk' => $this->input->post('no_sk'),
	    'tgl_sk' => $this->input->post('tgl_sk'),
	    'nuptk' => $this->input->post('nuptk'),
	    'verifikasi_bkd' => 'true',
	    'tgl_verifikasi_bkd' => date('Y-m-d H:i:s'),
			'berkas' => $this->_berkasJabatan($id_pegawai),
	    'status' => 0,
	    'created_at' => date('Y-m-d H:i:s')
	  );
	  $this->db->insert('riwayat_jabatan', $data);
	}
	public function add_riwayat_pendidikan_by_operator($id_pegawai){
	  $data = array(
	    'id_pegawai' => $id_pegawai,
	    'nip' => $this->input->post('nip'),
	    'id_jenjangpendidikan' => $this->input->post('id_jenjangpendidikan'),
	    'id_tempatpendidikan' => $this->input->post('id_tempatpendidikan'),
	    'id_jurusan' => $this->input->post('id_jurusan'),
	    'nama_pejabat' => $this->input->post('nama_pejabat'),
	    'nomor_sk' => $this->input->post('nomor_sk'),
	    'tgl_sk' => $this->input->post('tgl_sk'),
	    'verifikasi_bkd' => 'true',
	    'tgl_verifikasi_bkd' => date('Y-m-d H:i:s'),
			'berkas' => $this->_berkasPendidikan($id_pegawai),
	    'status' => 0,
	    'created_at' => date('Y-m-d H:i:s')
	  );
	  $this->db->insert('riwayat_pendidikan', $data);
	}
	public function add_riwayat_diklat_by_operator($id_pegawai){
	  $data = array(
	    'id_pegawai' => $id_pegawai,
	    'nip' => $this->input->post('nip'),
	    'id_jenisdiklat' => $this->input->post('id_jenisdiklat'),
	    'tempat' => $this->input->post('tempat'),
	    'penyelenggara' => $this->input->post('penyelenggara'),
	    'angkatan' => $this->input->post('angkatan'),
	    'nama_diklat' => $this->input->post('nama_diklat'),
	    'tgl_mulai' => $this->input->post('tgl_mulai'),
	    'tgl_akhir' => $this->input->post('tgl_akhir'),
	    'no_sptl' => $this->input->post('no_sptl'),
	    'tgl_sptl' => $this->input->post('tgl_sptl'),
	    'verifikasi_bkd' => 'true',
	    'tgl_verifikasi_bkd' => date('Y-m-d H:i:s'),
			'berkas' => $this->_berkasDiklat($id_pegawai),
	    'status' => 0,
	    'created_at' => date('Y-m-d H:i:s')
	  );
	  $this->db->insert('riwayat_diklat', $data);
	}
	public function add_riwayat_penataran_by_operator($id_pegawai){
	  $data = array(
	    'id_pegawai' => $id_pegawai,
	    'nip' => $this->input->post('nip'),
	    'id_penataran' => $this->input->post('id_penataran'),
	    'tempat' => $this->input->post('tempat'),
	    'penyelenggara' => $this->input->post('penyelenggara'),
	    'angkatan' => $this->input->post('angkatan'),
	    'nama_riwayat_penataran' => $this->input->post('nama_riwayat_penataran'),
	    'tgl_mulai_penataran' => $this->input->post('tgl_mulai_penataran'),
	    'tgl_akhir_penataran' => $this->input->post('tgl_akhir_penataran'),
	    'nomer_stpl' => $this->input->post('nomer_stpl'),
	    'tgl_stpl' => $this->input->post('tgl_stpl'),
	    'verifikasi_bkd' => 'true',
	    'tgl_verifikasi_bkd' => date('Y-m-d H:i:s'),
			'berkas' => $this->_berkasPenataran($id_pegawai),
	    'status' => 0,
	    'created_at' => date('Y-m-d H:i:s')
	  );
	  $this->db->insert('riwayat_penataran', $data);
	}
	public function add_riwayat_seminar_by_operator($id_pegawai){
	  $data = array(
	    'id_pegawai' => $id_pegawai,
	    'nip' => $this->input->post('nip'),
	    'id_jenisseminar' => $this->input->post('id_jenisseminar'),
	    'tempat' => $this->input->post('tempat'),
	    'penyelenggara' => $this->input->post('penyelenggara'),
	    'angkatan' => $this->input->post('angkatan'),
	    'nama_riwayat_seminar' => $this->input->post('nama_riwayat_seminar'),
	    'tgl_mulai_seminar' => $this->input->post('tgl_mulai_seminar'),
	    'tgl_akhir_seminar' => $this->input->post('tgl_akhir_seminar'),
	    'nomer_stpl' => $this->input->post('nomer_stpl'),
	    'tgl_stpl' => $this->input->post('tgl_stpl'),
	    'verifikasi_bkd' => 'true',
	    'tgl_verifikasi_bkd' => date('Y-m-d H:i:s'),
			'berkas' => $this->_berkasSeminar($id_pegawai),
	    'status' => 0,
	    'created_at' => date('Y-m-d H:i:s')
	  );
	  $this->db->insert('riwayat_seminar', $data);
	}
	public function add_riwayat_kursus_by_operator($id_pegawai){
	  $data = array(
	    'id_pegawai' => $id_pegawai,
	    'nip' => $this->input->post('nip'),
	    'id_kursus' => $this->input->post('id_kursus'),
	    'tempat' => $this->input->post('tempat'),
	    'penyelenggara' => $this->input->post('penyelenggara'),
	    'angkatan' => $this->input->post('angkatan'),
	    'nama_riwayat_kursus' => $this->input->post('nama_riwayat_kursus'),
	    'tgl_mulai_kursus' => $this->input->post('tgl_mulai_kursus'),
	    'tgl_akhir_kursus' => $this->input->post('tgl_akhir_kursus'),
	    'nomer_stpl' => $this->input->post('nomer_stpl'),
	    'tgl_stpl' => $this->input->post('tgl_stpl'),
	    'verifikasi_bkd' => 'true',
	    'tgl_verifikasi_bkd' => date('Y-m-d H:i:s'),
			'berkas' => $this->_berkasKursus($id_pegawai),
	    'status' => 0,
	    'created_at' => date('Y-m-d H:i:s')
	  );
	  $this->db->insert('riwayat_kursus', $data);
	}
	public function add_riwayat_unit_kerja_by_operator($id_pegawai){
	  $data = array(
	    'id_pegawai' => $id_pegawai,
	    'nip' => $this->input->post('nip'),
	    'id_unit_kerja' => $this->input->post('id_unit_kerja'),
	    'tmt_awal' => $this->input->post('tmt_awal'),
	    'tmt_akhir' => $this->input->post('tmt_akhir'),
	    'no_sk_awal' => $this->input->post('no_sk_awal'),
	    'no_sk_akhir' => $this->input->post('no_sk_akhir'),
	    'verifikasi_bkd' => 'true',
	    'tgl_verifikasi_bkd' => date('Y-m-d H:i:s'),
			'berkas' => $this->_berkasUnitKerja($id_pegawai),
	    'status' => 0,
	    'created_at' => date('Y-m-d H:i:s')
	  );
	  $this->db->insert('riwayat_unit_kerja', $data);
	}
	public function add_riwayat_penghargaan_by_operator($id_pegawai){
	  $data = array(
	    'id_pegawai' => $id_pegawai,
	    'nip' => $this->input->post('nip'),
	    'id_jenispenghargaan' => $this->input->post('id_jenispenghargaan'),
	    'nama_penghargaan' => $this->input->post('nama_penghargaan'),
	    'tahun' => $this->input->post('tahun'),
	    'asal_perolehan' => $this->input->post('asal_perolehan'),
	    'penandatangan' => $this->input->post('penandatangan'),
	    'no_penghargaan' => $this->input->post('no_penghargaan'),
	    'tgl_penghargaan' => $this->input->post('tgl_penghargaan'),
	    'verifikasi_bkd' => 'true',
	    'tgl_verifikasi_bkd' => date('Y-m-d H:i:s'),
			'berkas' => $this->_berkasPenghargaan($id_pegawai),
	    'status' => 0,
	    'created_at' => date('Y-m-d H:i:s')
	  );
	  $this->db->insert('riwayat_penghargaan', $data);
	}
	public function add_riwayat_penugasan_by_operator($id_pegawai){
	  $data = array(
	    'id_pegawai' => $id_pegawai,
	    'nip' => $this->input->post('nip'),
	    'id_jenispenugasan' => $this->input->post('id_jenispenugasan'),
	    'tempat' => $this->input->post('tempat'),
	    'pejabat_penetap' => $this->input->post('pejabat_penetap'),
	    'tgl_mulai_penugasan' => $this->input->post('tgl_mulai_penugasan'),
	    'tgl_akhir_penugasan' => $this->input->post('tgl_akhir_penugasan'),
	    'nomer_sk' => $this->input->post('nomer_sk'),
	    'tgl_sk' => $this->input->post('tgl_sk'),
	    'verifikasi_bkd' => 'true',
	    'tgl_verifikasi_bkd' => date('Y-m-d H:i:s'),
			'berkas' => $this->_berkasPenugasan($id_pegawai),
	    'status' => 0,
	    'created_at' => date('Y-m-d H:i:s')
	  );
	  $this->db->insert('riwayat_penugasan', $data);
	}
	public function add_riwayat_cuti_by_operator($id_pegawai){
	  $data = array(
	    'id_pegawai' => $id_pegawai,
	    'nip' => $this->input->post('nip'),
	    'id_jeniscuti' => $this->input->post('id_jeniscuti'),
	    'keterangan' => $this->input->post('keterangan'),
	    'pejabat_penetapan' => $this->input->post('pejabat_penetapan'),
	    'tgl_awal_cuti' => $this->input->post('tgl_awal_cuti'),
	    'tgl_akhir_cuti' => $this->input->post('tgl_akhir_cuti'),
	    'no_sk' => $this->input->post('no_sk'),
	    'tgl_sk' => $this->input->post('tgl_sk'),
	    'verifikasi_bkd' => 'true',
	    'tgl_verifikasi_bkd' => date('Y-m-d H:i:s'),
			'berkas' => $this->_berkasCuti($id_pegawai),
	    'status' => 0,
	    'created_at' => date('Y-m-d H:i:s')
	  );
	  $this->db->insert('riwayat_cuti', $data);
	}
	public function add_riwayat_hukuman_by_operator($id_pegawai){
	  $data = array(
	    'id_pegawai' => $id_pegawai,
	    'nip' => $this->input->post('nip'),
	    'id_jenishukuman' => $this->input->post('id_jenishukuman'),
	    'keterangan' => $this->input->post('keterangan'),
	    'pejabat_penetap' => $this->input->post('pejabat_penetap'),
	    'tgl_mulai_hukuman' => $this->input->post('tgl_mulai_hukuman'),
	    'tgl_akhir_hukuman' => $this->input->post('tgl_akhir_hukuman'),
	    'nomer_sk' => $this->input->post('nomer_sk'),
	    'tgl_sk' => $this->input->post('tgl_sk'),
	    'verifikasi_bkd' => 'true',
	    'tgl_verifikasi_bkd' => date('Y-m-d H:i:s'),
			'berkas' => $this->_berkasHukuman($id_pegawai),
	    'status' => 0,
	    'created_at' => date('Y-m-d H:i:s')
	  );
	  $this->db->insert('riwayat_hukuman', $data);
	}
	public function add_riwayat_bahasa_by_operator($id_pegawai){
	  $data = array(
	    'id_pegawai' => $id_pegawai,
	    'nip' => $this->input->post('nip'),
	    'id_bahasa' => $this->input->post('id_bahasa'),
	    'kemampuan' => $this->input->post('kemampuan'),
	    'verifikasi_bkd' => 'true',
	    'tgl_verifikasi_bkd' => date('Y-m-d H:i:s'),
			'berkas' => $this->_berkasBahasa($id_pegawai),
	    'status' => 0,
	    'created_at' => date('Y-m-d H:i:s')
	  );
	  $this->db->insert('riwayat_bahasa', $data);
	}
	public function add_riwayat_bahasa_asing_by_operator($id_pegawai){
	  $data = array(
	    'id_pegawai' => $id_pegawai,
	    'nip' => $this->input->post('nip'),
	    'id_bahasa_asing' => $this->input->post('id_bahasa_asing'),
	    'kemampuan' => $this->input->post('kemampuan'),
	    'verifikasi_bkd' => 'true',
	    'tgl_verifikasi_bkd' => date('Y-m-d H:i:s'),
			'berkas' => $this->_berkasBahasaAsing($id_pegawai),
	    'status' => 0,
	    'created_at' => date('Y-m-d H:i:s')
	  );
	  $this->db->insert('riwayat_bahasa_asing', $data);
	}
	public function add_riwayat_pernikahan_by_operator($id_pegawai){
	  $data = array(
	    'id_pegawai' => $id_pegawai,
	    'nip' => $this->input->post('nip'),
	    'id_jenjangpendidikan' => $this->input->post('id_jenjangpendidikan'),
	    'pekerjaan' => $this->input->post('pekerjaan'),
	    'nama' => $this->input->post('nama'),
	    'tempat_lahir' => $this->input->post('tempat_lahir'),
	    'tgl_lahir' => $this->input->post('tgl_lahir'),
	    'tgl_menikah' => $this->input->post('tgl_menikah'),
	    'keterangan' => $this->input->post('keterangan'),
	    'verifikasi_bkd' => 'true',
	    'tgl_verifikasi_bkd' => date('Y-m-d H:i:s'),
			'berkas' => $this->_berkasPernikahan($id_pegawai),
	    'status' => 0,
	    'created_at' => date('Y-m-d H:i:s')
	  );
	  $this->db->insert('riwayat_pernikahan', $data);
	}
	public function add_riwayat_anak_by_operator($id_pegawai){
	  $data = array(
	    'id_pegawai' => $id_pegawai,
	    'nip' => $this->input->post('nip'),
	    'id_jenjangpendidikan' => $this->input->post('id_jenjangpendidikan'),
	    'pekerjaan' => $this->input->post('pekerjaan'),
	    'nama' => $this->input->post('nama'),
	    'tempat_lahir' => $this->input->post('tempat_lahir'),
	    'tgl_lahir' => $this->input->post('tgl_lahir'),
	    'jenis_kelamin' => $this->input->post('jenis_kelamin'),
	    'keterangan' => $this->input->post('keterangan'),
	    'verifikasi_bkd' => 'true',
	    'tgl_verifikasi_bkd' => date('Y-m-d H:i:s'),
			'berkas' => $this->_berkasAnak($id_pegawai),
	    'status' => 0,
	    'created_at' => date('Y-m-d H:i:s')
	  );
	  $this->db->insert('riwayat_anak', $data);
	}
	public function add_riwayat_orangtua_by_operator($id_pegawai){
	  $data = array(
	    'id_pegawai' => $id_pegawai,
	    'nip' => $this->input->post('nip'),
	    'id_jenjangpendidikan' => $this->input->post('id_jenjangpendidikan'),
	    'pekerjaan' => $this->input->post('pekerjaan'),
	    'nama' => $this->input->post('nama'),
	    'tempat_lahir' => $this->input->post('tempat_lahir'),
	    'tgl_lahir' => $this->input->post('tgl_lahir'),
	    'jenis_kelamin' => $this->input->post('jenis_kelamin'),
	    'keterangan' => $this->input->post('keterangan'),
	    'verifikasi_bkd' => 'true',
	    'tgl_verifikasi_bkd' => date('Y-m-d H:i:s'),
			'berkas' => $this->_berkasOrangtua($id_pegawai),
	    'status' => 0,
	    'created_at' => date('Y-m-d H:i:s')
	  );
	  $this->db->insert('riwayat_orangtua', $data);
	}
	public function add_riwayat_mertua_by_operator($id_pegawai){
	  $data = array(
	    'id_pegawai' => $id_pegawai,
	    'nip' => $this->input->post('nip'),
	    'id_jenjangpendidikan' => $this->input->post('id_jenjangpendidikan'),
	    'pekerjaan' => $this->input->post('pekerjaan'),
	    'nama' => $this->input->post('nama'),
	    'tempat_lahir' => $this->input->post('tempat_lahir'),
	    'tgl_lahir' => $this->input->post('tgl_lahir'),
	    'jenis_kelamin' => $this->input->post('jenis_kelamin'),
	    'keterangan' => $this->input->post('keterangan'),
	    'verifikasi_bkd' => 'true',
	    'tgl_verifikasi_bkd' => date('Y-m-d H:i:s'),
			'berkas' => $this->_berkasMertua($id_pegawai),
	    'status' => 0,
	    'created_at' => date('Y-m-d H:i:s')
	  );
	  $this->db->insert('riwayat_mertua', $data);
	}

	//Kepegawaian verif pegawai
	public function verif_riwayat_pangkat_by_id($id_pangkat){
	  $data = array(
	    'verifikasi_pegawai' => 'true',
	    'tgl_verifikasi_pegawai' => date('Y-m-d H:i:s')
	  );
	  $this->db->where('id', $id_pangkat);
	  $this->db->update('riwayat_pangkat', $data);
	}
	public function verif_riwayat_jabatan_by_id($id_jabatan){
	$data = array(
	  'verifikasi_pegawai' => 'true',
	  'tgl_verifikasi_pegawai' => date('Y-m-d H:i:s')
	);
	  $this->db->where('id', $id_jabatan);
	  $this->db->update('riwayat_jabatan', $data);
	}
	public function verif_riwayat_pendidikan_by_id($id_pendidikan){
	$data = array(
	  'verifikasi_pegawai' => 'true',
	  'tgl_verifikasi_pegawai' => date('Y-m-d H:i:s')
	);
	  $this->db->where('id', $id_pendidikan);
	  $this->db->update('riwayat_pendidikan', $data);
	}
	public function verif_riwayat_diklat_by_id($id_diklat){
	$data = array(
	  'verifikasi_pegawai' => 'true',
	  'tgl_verifikasi_pegawai' => date('Y-m-d H:i:s')
	);
	  $this->db->where('id', $id_diklat);
	  $this->db->update('riwayat_diklat', $data);
	}
	public function verif_riwayat_penataran_by_id($id_penataran){
	$data = array(
	  'verifikasi_pegawai' => 'true',
	  'tgl_verifikasi_pegawai' => date('Y-m-d H:i:s')
	);
	  $this->db->where('id', $id_penataran);
	  $this->db->update('riwayat_penataran', $data);
	}
	public function verif_riwayat_seminar_by_id($id_seminar){
	$data = array(
	  'verifikasi_pegawai' => 'true',
	  'tgl_verifikasi_pegawai' => date('Y-m-d H:i:s')
	);
	  $this->db->where('id', $id_seminar);
	  $this->db->update('riwayat_seminar', $data);
	}
	public function verif_riwayat_kursus_by_id($id_kursus){
	$data = array(
	  'verifikasi_pegawai' => 'true',
	  'tgl_verifikasi_pegawai' => date('Y-m-d H:i:s')
	);
	  $this->db->where('id', $id_kursus);
	  $this->db->update('riwayat_kursus', $data);
	}
	public function verif_riwayat_unit_kerja_by_id($id_unit_kerja){
	$data = array(
	  'verifikasi_pegawai' => 'true',
	  'tgl_verifikasi_pegawai' => date('Y-m-d H:i:s')
	);
	  $this->db->where('id', $id_unit_kerja);
	  $this->db->update('riwayat_unit_kerja', $data);
	}
	public function verif_riwayat_penghargaan_by_id($id_penghargaan){
	$data = array(
	  'verifikasi_pegawai' => 'true',
	  'tgl_verifikasi_pegawai' => date('Y-m-d H:i:s')
	);
	  $this->db->where('id', $id_penghargaan);
	  $this->db->update('riwayat_penghargaan', $data);
	}
	public function verif_riwayat_penugasan_by_id($id_penugasan){
	$data = array(
	  'verifikasi_pegawai' => 'true',
	  'tgl_verifikasi_pegawai' => date('Y-m-d H:i:s')
	);
	  $this->db->where('id', $id_penugasan);
	  $this->db->update('riwayat_penugasan', $data);
	}
	public function verif_riwayat_cuti_by_id($id_cuti){
	$data = array(
	  'verifikasi_pegawai' => 'true',
	  'tgl_verifikasi_pegawai' => date('Y-m-d H:i:s')
	);
	  $this->db->where('id', $id_cuti);
	  $this->db->update('riwayat_cuti', $data);
	}
	public function verif_riwayat_hukuman_by_id($id_hukuman){
	$data = array(
	  'verifikasi_pegawai' => 'true',
	  'tgl_verifikasi_pegawai' => date('Y-m-d H:i:s')
	);
	  $this->db->where('id', $id_hukuman);
	  $this->db->update('riwayat_hukuman', $data);
	}
	public function verif_riwayat_bahasa_by_id($id_bahasa){
	$data = array(
	  'verifikasi_pegawai' => 'true',
	  'tgl_verifikasi_pegawai' => date('Y-m-d H:i:s')
	);
	  $this->db->where('id', $id_bahasa);
	  $this->db->update('riwayat_bahasa', $data);
	}
	public function verif_riwayat_bahasa_asing_by_id($id_bahasa_asing){
	$data = array(
	  'verifikasi_pegawai' => 'true',
	  'tgl_verifikasi_pegawai' => date('Y-m-d H:i:s')
	);
	  $this->db->where('id', $id_bahasa_asing);
	  $this->db->update('riwayat_bahasa_asing', $data);
	}
	public function verif_riwayat_pernikahan_by_id($id_pernikahan){
	$data = array(
	  'verifikasi_pegawai' => 'true',
	  'tgl_verifikasi_pegawai' => date('Y-m-d H:i:s')
	);
	  $this->db->where('id', $id_pernikahan);
	  $this->db->update('riwayat_pernikahan', $data);
	}
	public function verif_riwayat_anak_by_id($id_anak){
	$data = array(
	  'verifikasi_pegawai' => 'true',
	  'tgl_verifikasi_pegawai' => date('Y-m-d H:i:s')
	);
	  $this->db->where('id', $id_anak);
	  $this->db->update('riwayat_anak', $data);
	}
	public function verif_riwayat_orangtua_by_id($id_orangtua){
	$data = array(
	  'verifikasi_pegawai' => 'true',
	  'tgl_verifikasi_pegawai' => date('Y-m-d H:i:s')
	);
	  $this->db->where('id', $id_orangtua);
	  $this->db->update('riwayat_orangtua', $data);
	}
	public function verif_riwayat_mertua_by_id($id_mertua){
	$data = array(
	  'verifikasi_pegawai' => 'true',
	  'tgl_verifikasi_pegawai' => date('Y-m-d H:i:s')
	);
	  $this->db->where('id', $id_mertua);
	  $this->db->update('riwayat_mertua', $data);
	}
	//Kepegawaian unverif pegawai
	public function unverif_riwayat_pangkat_by_id($id_pangkat){
	  $data = array(
	    'verifikasi_pegawai' => null,
	    'tgl_verifikasi_pegawai' => date('Y-m-d H:i:s')
	  );
	  $this->db->where('id', $id_pangkat);
	  $this->db->update('riwayat_pangkat', $data);
	}
	public function unverif_riwayat_jabatan_by_id($id_jabatan){
	$data = array(
	  'verifikasi_pegawai' => null,
	  'tgl_verifikasi_pegawai' => date('Y-m-d H:i:s')
	);
	  $this->db->where('id', $id_jabatan);
	  $this->db->update('riwayat_jabatan', $data);
	}
	public function unverif_riwayat_pendidikan_by_id($id_pendidikan){
	$data = array(
	  'verifikasi_pegawai' => null,
	  'tgl_verifikasi_pegawai' => date('Y-m-d H:i:s')
	);
	  $this->db->where('id', $id_pendidikan);
	  $this->db->update('riwayat_pendidikan', $data);
	}
	public function unverif_riwayat_diklat_by_id($id_diklat){
	$data = array(
	  'verifikasi_pegawai' => null,
	  'tgl_verifikasi_pegawai' => date('Y-m-d H:i:s')
	);
	  $this->db->where('id', $id_diklat);
	  $this->db->update('riwayat_diklat', $data);
	}
	public function unverif_riwayat_penataran_by_id($id_penataran){
	$data = array(
	  'verifikasi_pegawai' => null,
	  'tgl_verifikasi_pegawai' => date('Y-m-d H:i:s')
	);
	  $this->db->where('id', $id_penataran);
	  $this->db->update('riwayat_penataran', $data);
	}
	public function unverif_riwayat_seminar_by_id($id_seminar){
	$data = array(
	  'verifikasi_pegawai' => null,
	  'tgl_verifikasi_pegawai' => date('Y-m-d H:i:s')
	);
	  $this->db->where('id', $id_seminar);
	  $this->db->update('riwayat_seminar', $data);
	}
	public function unverif_riwayat_kursus_by_id($id_kursus){
	$data = array(
	  'verifikasi_pegawai' => null,
	  'tgl_verifikasi_pegawai' => date('Y-m-d H:i:s')
	);
	  $this->db->where('id', $id_kursus);
	  $this->db->update('riwayat_kursus', $data);
	}
	public function unverif_riwayat_unit_kerja_by_id($id_unit_kerja){
	$data = array(
	  'verifikasi_pegawai' => null,
	  'tgl_verifikasi_pegawai' => date('Y-m-d H:i:s')
	);
	  $this->db->where('id', $id_unit_kerja);
	  $this->db->update('riwayat_unit_kerja', $data);
	}
	public function unverif_riwayat_penghargaan_by_id($id_penghargaan){
	$data = array(
	  'verifikasi_pegawai' => null,
	  'tgl_verifikasi_pegawai' => date('Y-m-d H:i:s')
	);
	  $this->db->where('id', $id_penghargaan);
	  $this->db->update('riwayat_penghargaan', $data);
	}
	public function unverif_riwayat_penugasan_by_id($id_penugasan){
	$data = array(
	  'verifikasi_pegawai' => null,
	  'tgl_verifikasi_pegawai' => date('Y-m-d H:i:s')
	);
	  $this->db->where('id', $id_penugasan);
	  $this->db->update('riwayat_penugasan', $data);
	}
	public function unverif_riwayat_cuti_by_id($id_cuti){
	$data = array(
	  'verifikasi_pegawai' => null,
	  'tgl_verifikasi_pegawai' => date('Y-m-d H:i:s')
	);
	  $this->db->where('id', $id_cuti);
	  $this->db->update('riwayat_cuti', $data);
	}
	public function unverif_riwayat_hukuman_by_id($id_hukuman){
	$data = array(
	  'verifikasi_pegawai' => null,
	  'tgl_verifikasi_pegawai' => date('Y-m-d H:i:s')
	);
	  $this->db->where('id', $id_hukuman);
	  $this->db->update('riwayat_hukuman', $data);
	}
	public function unverif_riwayat_bahasa_by_id($id_bahasa){
	$data = array(
	  'verifikasi_pegawai' => null,
	  'tgl_verifikasi_pegawai' => date('Y-m-d H:i:s')
	);
	  $this->db->where('id', $id_bahasa);
	  $this->db->update('riwayat_bahasa', $data);
	}
	public function unverif_riwayat_bahasa_asing_by_id($id_bahasa_asing){
	$data = array(
	  'verifikasi_pegawai' => null,
	  'tgl_verifikasi_pegawai' => date('Y-m-d H:i:s')
	);
	  $this->db->where('id', $id_bahasa_asing);
	  $this->db->update('riwayat_bahasa_asing', $data);
	}
	public function unverif_riwayat_pernikahan_by_id($id_pernikahan){
	$data = array(
	  'verifikasi_pegawai' => null,
	  'tgl_verifikasi_pegawai' => date('Y-m-d H:i:s')
	);
	  $this->db->where('id', $id_pernikahan);
	  $this->db->update('riwayat_pernikahan', $data);
	}
	public function unverif_riwayat_anak_by_id($id_anak){
	$data = array(
	  'verifikasi_pegawai' => null,
	  'tgl_verifikasi_pegawai' => date('Y-m-d H:i:s')
	);
	  $this->db->where('id', $id_anak);
	  $this->db->update('riwayat_anak', $data);
	}
	public function unverif_riwayat_orangtua_by_id($id_orangtua){
	$data = array(
	  'verifikasi_pegawai' => null,
	  'tgl_verifikasi_pegawai' => date('Y-m-d H:i:s')
	);
	  $this->db->where('id', $id_orangtua);
	  $this->db->update('riwayat_orangtua', $data);
	}
	public function unverif_riwayat_mertua_by_id($id_mertua){
	$data = array(
	  'verifikasi_pegawai' => null,
	  'tgl_verifikasi_pegawai' => date('Y-m-d H:i:s')
	);
	  $this->db->where('id', $id_mertua);
	  $this->db->update('riwayat_mertua', $data);
	}

	//Kepegawaian verif bkd
	public function verif_riwayat_pangkat_by_operator($id_pangkat){
	  $data = array(
	    'verifikasi_bkd' => 'true',
	    'tgl_verifikasi_bkd' => date('Y-m-d H:i:s')
	  );
	  $this->db->where('id', $id_pangkat);
	  $this->db->update('riwayat_pangkat', $data);
	}
	public function verif_riwayat_jabatan_by_operator($id_jabatan){
	$data = array(
	  'verifikasi_bkd' => 'true',
	  'tgl_verifikasi_bkd' => date('Y-m-d H:i:s')
	);
	  $this->db->where('id', $id_jabatan);
	  $this->db->update('riwayat_jabatan', $data);
	}
	public function verif_riwayat_pendidikan_by_operator($id_pendidikan){
	$data = array(
	  'verifikasi_bkd' => 'true',
	  'tgl_verifikasi_bkd' => date('Y-m-d H:i:s')
	);
	  $this->db->where('id', $id_pendidikan);
	  $this->db->update('riwayat_pendidikan', $data);
	}
	public function verif_riwayat_diklat_by_operator($id_diklat){
	$data = array(
	  'verifikasi_bkd' => 'true',
	  'tgl_verifikasi_bkd' => date('Y-m-d H:i:s')
	);
	  $this->db->where('id', $id_diklat);
	  $this->db->update('riwayat_diklat', $data);
	}
	public function verif_riwayat_penataran_by_operator($id_penataran){
	$data = array(
	  'verifikasi_bkd' => 'true',
	  'tgl_verifikasi_bkd' => date('Y-m-d H:i:s')
	);
	  $this->db->where('id', $id_penataran);
	  $this->db->update('riwayat_penataran', $data);
	}
	public function verif_riwayat_seminar_by_operator($id_seminar){
	$data = array(
	  'verifikasi_bkd' => 'true',
	  'tgl_verifikasi_bkd' => date('Y-m-d H:i:s')
	);
	  $this->db->where('id', $id_seminar);
	  $this->db->update('riwayat_seminar', $data);
	}
	public function verif_riwayat_kursus_by_operator($id_kursus){
	$data = array(
	  'verifikasi_bkd' => 'true',
	  'tgl_verifikasi_bkd' => date('Y-m-d H:i:s')
	);
	  $this->db->where('id', $id_kursus);
	  $this->db->update('riwayat_kursus', $data);
	}
	public function verif_riwayat_unit_kerja_by_operator($id_unit_kerja){
	$data = array(
	  'verifikasi_bkd' => 'true',
	  'tgl_verifikasi_bkd' => date('Y-m-d H:i:s')
	);
	  $this->db->where('id', $id_unit_kerja);
	  $this->db->update('riwayat_unit_kerja', $data);
	}
	public function verif_riwayat_penghargaan_by_operator($id_penghargaan){
	$data = array(
	  'verifikasi_bkd' => 'true',
	  'tgl_verifikasi_bkd' => date('Y-m-d H:i:s')
	);
	  $this->db->where('id', $id_penghargaan);
	  $this->db->update('riwayat_penghargaan', $data);
	}
	public function verif_riwayat_penugasan_by_operator($id_penugasan){
	$data = array(
	  'verifikasi_bkd' => 'true',
	  'tgl_verifikasi_bkd' => date('Y-m-d H:i:s')
	);
	  $this->db->where('id', $id_penugasan);
	  $this->db->update('riwayat_penugasan', $data);
	}
	public function verif_riwayat_cuti_by_operator($id_cuti){
	$data = array(
	  'verifikasi_bkd' => 'true',
	  'tgl_verifikasi_bkd' => date('Y-m-d H:i:s')
	);
	  $this->db->where('id', $id_cuti);
	  $this->db->update('riwayat_cuti', $data);
	}
	public function verif_riwayat_hukuman_by_operator($id_hukuman){
	$data = array(
	  'verifikasi_bkd' => 'true',
	  'tgl_verifikasi_bkd' => date('Y-m-d H:i:s')
	);
	  $this->db->where('id', $id_hukuman);
	  $this->db->update('riwayat_hukuman', $data);
	}
	public function verif_riwayat_bahasa_by_operator($id_bahasa){
	$data = array(
	  'verifikasi_bkd' => 'true',
	  'tgl_verifikasi_bkd' => date('Y-m-d H:i:s')
	);
	  $this->db->where('id', $id_bahasa);
	  $this->db->update('riwayat_bahasa', $data);
	}
	public function verif_riwayat_bahasa_asing_by_operator($id_bahasa_asing){
	$data = array(
	  'verifikasi_bkd' => 'true',
	  'tgl_verifikasi_bkd' => date('Y-m-d H:i:s')
	);
	  $this->db->where('id', $id_bahasa_asing);
	  $this->db->update('riwayat_bahasa_asing', $data);
	}
	public function verif_riwayat_pernikahan_by_operator($id_pernikahan){
	$data = array(
	  'verifikasi_bkd' => 'true',
	  'tgl_verifikasi_bkd' => date('Y-m-d H:i:s')
	);
	  $this->db->where('id', $id_pernikahan);
	  $this->db->update('riwayat_pernikahan', $data);
	}
	public function verif_riwayat_anak_by_operator($id_anak){
	$data = array(
	  'verifikasi_bkd' => 'true',
	  'tgl_verifikasi_bkd' => date('Y-m-d H:i:s')
	);
	  $this->db->where('id', $id_anak);
	  $this->db->update('riwayat_anak', $data);
	}
	public function verif_riwayat_orangtua_by_operator($id_orangtua){
	$data = array(
	  'verifikasi_bkd' => 'true',
	  'tgl_verifikasi_bkd' => date('Y-m-d H:i:s')
	);
	  $this->db->where('id', $id_orangtua);
	  $this->db->update('riwayat_orangtua', $data);
	}
	public function verif_riwayat_mertua_by_operator($id_mertua){
	$data = array(
	  'verifikasi_bkd' => 'true',
	  'tgl_verifikasi_bkd' => date('Y-m-d H:i:s')
	);
	  $this->db->where('id', $id_mertua);
	  $this->db->update('riwayat_mertua', $data);
	}
	//Kepegawaian unverif bkd
	public function unverif_riwayat_pangkat_by_operator($id_pangkat){
	  $data = array(
	    'verifikasi_bkd' => null,
	    'tgl_verifikasi_bkd' => date('Y-m-d H:i:s')
	  );
	  $this->db->where('id', $id_pangkat);
	  $this->db->update('riwayat_pangkat', $data);
	}
	public function unverif_riwayat_jabatan_by_operator($id_jabatan){
	$data = array(
	  'verifikasi_bkd' => null,
	  'tgl_verifikasi_bkd' => date('Y-m-d H:i:s')
	);
	  $this->db->where('id', $id_jabatan);
	  $this->db->update('riwayat_jabatan', $data);
	}
	public function unverif_riwayat_pendidikan_by_operator($id_pendidikan){
	$data = array(
	  'verifikasi_bkd' => null,
	  'tgl_verifikasi_bkd' => date('Y-m-d H:i:s')
	);
	  $this->db->where('id', $id_pendidikan);
	  $this->db->update('riwayat_pendidikan', $data);
	}
	public function unverif_riwayat_diklat_by_operator($id_diklat){
	$data = array(
	  'verifikasi_bkd' => null,
	  'tgl_verifikasi_bkd' => date('Y-m-d H:i:s')
	);
	  $this->db->where('id', $id_diklat);
	  $this->db->update('riwayat_diklat', $data);
	}
	public function unverif_riwayat_penataran_by_operator($id_penataran){
	$data = array(
	  'verifikasi_bkd' => null,
	  'tgl_verifikasi_bkd' => date('Y-m-d H:i:s')
	);
	  $this->db->where('id', $id_penataran);
	  $this->db->update('riwayat_penataran', $data);
	}
	public function unverif_riwayat_seminar_by_operator($id_seminar){
	$data = array(
	  'verifikasi_bkd' => null,
	  'tgl_verifikasi_bkd' => date('Y-m-d H:i:s')
	);
	  $this->db->where('id', $id_seminar);
	  $this->db->update('riwayat_seminar', $data);
	}
	public function unverif_riwayat_kursus_by_operator($id_kursus){
	$data = array(
	  'verifikasi_bkd' => null,
	  'tgl_verifikasi_bkd' => date('Y-m-d H:i:s')
	);
	  $this->db->where('id', $id_kursus);
	  $this->db->update('riwayat_kursus', $data);
	}
	public function unverif_riwayat_unit_kerja_by_operator($id_unit_kerja){
	$data = array(
	  'verifikasi_bkd' => null,
	  'tgl_verifikasi_bkd' => date('Y-m-d H:i:s')
	);
	  $this->db->where('id', $id_unit_kerja);
	  $this->db->update('riwayat_unit_kerja', $data);
	}
	public function unverif_riwayat_penghargaan_by_operator($id_penghargaan){
	$data = array(
	  'verifikasi_bkd' => null,
	  'tgl_verifikasi_bkd' => date('Y-m-d H:i:s')
	);
	  $this->db->where('id', $id_penghargaan);
	  $this->db->update('riwayat_penghargaan', $data);
	}
	public function unverif_riwayat_penugasan_by_operator($id_penugasan){
	$data = array(
	  'verifikasi_bkd' => null,
	  'tgl_verifikasi_bkd' => date('Y-m-d H:i:s')
	);
	  $this->db->where('id', $id_penugasan);
	  $this->db->update('riwayat_penugasan', $data);
	}
	public function unverif_riwayat_cuti_by_operator($id_cuti){
	$data = array(
	  'verifikasi_bkd' => null,
	  'tgl_verifikasi_bkd' => date('Y-m-d H:i:s')
	);
	  $this->db->where('id', $id_cuti);
	  $this->db->update('riwayat_cuti', $data);
	}
	public function unverif_riwayat_hukuman_by_operator($id_hukuman){
	$data = array(
	  'verifikasi_bkd' => null,
	  'tgl_verifikasi_bkd' => date('Y-m-d H:i:s')
	);
	  $this->db->where('id', $id_hukuman);
	  $this->db->update('riwayat_hukuman', $data);
	}
	public function unverif_riwayat_bahasa_by_operator($id_bahasa){
	$data = array(
	  'verifikasi_bkd' => null,
	  'tgl_verifikasi_bkd' => date('Y-m-d H:i:s')
	);
	  $this->db->where('id', $id_bahasa);
	  $this->db->update('riwayat_bahasa', $data);
	}
	public function unverif_riwayat_bahasa_asing_by_operator($id_bahasa_asing){
	$data = array(
	  'verifikasi_bkd' => null,
	  'tgl_verifikasi_bkd' => date('Y-m-d H:i:s')
	);
	  $this->db->where('id', $id_bahasa_asing);
	  $this->db->update('riwayat_bahasa_asing', $data);
	}
	public function unverif_riwayat_pernikahan_by_operator($id_pernikahan){
	$data = array(
	  'verifikasi_bkd' => null,
	  'tgl_verifikasi_bkd' => date('Y-m-d H:i:s')
	);
	  $this->db->where('id', $id_pernikahan);
	  $this->db->update('riwayat_pernikahan', $data);
	}
	public function unverif_riwayat_anak_by_operator($id_anak){
	$data = array(
	  'verifikasi_bkd' => null,
	  'tgl_verifikasi_bkd' => date('Y-m-d H:i:s')
	);
	  $this->db->where('id', $id_anak);
	  $this->db->update('riwayat_anak', $data);
	}
	public function unverif_riwayat_orangtua_by_operator($id_orangtua){
	$data = array(
	  'verifikasi_bkd' => null,
	  'tgl_verifikasi_bkd' => date('Y-m-d H:i:s')
	);
	  $this->db->where('id', $id_orangtua);
	  $this->db->update('riwayat_orangtua', $data);
	}
	public function unverif_riwayat_mertua_by_operator($id_mertua){
	$data = array(
	  'verifikasi_bkd' => null,
	  'tgl_verifikasi_bkd' => date('Y-m-d H:i:s')
	);
	  $this->db->where('id', $id_mertua);
	  $this->db->update('riwayat_mertua', $data);
	}
	//Kepegawaian catat bkd
	public function catat_riwayat_pangkat_by_operator($id_pangkat){
	  $data = array(
	    'catatan_verifikasi' => $this->input->post('catatan_verifikasi'),
	    'tgl_catatan_verifikasi' => date('Y-m-d H:i:s')
	  );
	  $this->db->where('id', $id_pangkat);
	  $this->db->update('riwayat_pangkat', $data);
	}
	public function catat_riwayat_jabatan_by_operator($id_jabatan){
	$data = array(
	  'catatan_verifikasi' => $this->input->post('catatan_verifikasi'),
	  'tgl_catatan_verifikasi' => date('Y-m-d H:i:s')
	);
	  $this->db->where('id', $id_jabatan);
	  $this->db->update('riwayat_jabatan', $data);
	}
	public function catat_riwayat_pendidikan_by_operator($id_pendidikan){
	$data = array(
	  'catatan_verifikasi' => $this->input->post('catatan_verifikasi'),
	  'tgl_catatan_verifikasi' => date('Y-m-d H:i:s')
	);
	  $this->db->where('id', $id_pendidikan);
	  $this->db->update('riwayat_pendidikan', $data);
	}
	public function catat_riwayat_diklat_by_operator($id_diklat){
	$data = array(
	  'catatan_verifikasi' => $this->input->post('catatan_verifikasi'),
	  'tgl_catatan_verifikasi' => date('Y-m-d H:i:s')
	);
	  $this->db->where('id', $id_diklat);
	  $this->db->update('riwayat_diklat', $data);
	}
	public function catat_riwayat_penataran_by_operator($id_penataran){
	$data = array(
	  'catatan_verifikasi' => $this->input->post('catatan_verifikasi'),
	  'tgl_catatan_verifikasi' => date('Y-m-d H:i:s')
	);
	  $this->db->where('id', $id_penataran);
	  $this->db->update('riwayat_penataran', $data);
	}
	public function catat_riwayat_seminar_by_operator($id_seminar){
	$data = array(
	  'catatan_verifikasi' => $this->input->post('catatan_verifikasi'),
	  'tgl_catatan_verifikasi' => date('Y-m-d H:i:s')
	);
	  $this->db->where('id', $id_seminar);
	  $this->db->update('riwayat_seminar', $data);
	}
	public function catat_riwayat_kursus_by_operator($id_kursus){
	$data = array(
	  'catatan_verifikasi' => $this->input->post('catatan_verifikasi'),
	  'tgl_catatan_verifikasi' => date('Y-m-d H:i:s')
	);
	  $this->db->where('id', $id_kursus);
	  $this->db->update('riwayat_kursus', $data);
	}
	public function catat_riwayat_unit_kerja_by_operator($id_unit_kerja){
	$data = array(
	  'catatan_verifikasi' => $this->input->post('catatan_verifikasi'),
	  'tgl_catatan_verifikasi' => date('Y-m-d H:i:s')
	);
	  $this->db->where('id', $id_unit_kerja);
	  $this->db->update('riwayat_unit_kerja', $data);
	}
	public function catat_riwayat_penghargaan_by_operator($id_penghargaan){
	$data = array(
	  'catatan_verifikasi' => $this->input->post('catatan_verifikasi'),
	  'tgl_catatan_verifikasi' => date('Y-m-d H:i:s')
	);
	  $this->db->where('id', $id_penghargaan);
	  $this->db->update('riwayat_penghargaan', $data);
	}
	public function catat_riwayat_penugasan_by_operator($id_penugasan){
	$data = array(
	  'catatan_verifikasi' => $this->input->post('catatan_verifikasi'),
	  'tgl_catatan_verifikasi' => date('Y-m-d H:i:s')
	);
	  $this->db->where('id', $id_penugasan);
	  $this->db->update('riwayat_penugasan', $data);
	}
	public function catat_riwayat_cuti_by_operator($id_cuti){
	$data = array(
	  'catatan_verifikasi' => $this->input->post('catatan_verifikasi'),
	  'tgl_catatan_verifikasi' => date('Y-m-d H:i:s')
	);
	  $this->db->where('id', $id_cuti);
	  $this->db->update('riwayat_cuti', $data);
	}
	public function catat_riwayat_hukuman_by_operator($id_hukuman){
	$data = array(
	  'catatan_verifikasi' => $this->input->post('catatan_verifikasi'),
	  'tgl_catatan_verifikasi' => date('Y-m-d H:i:s')
	);
	  $this->db->where('id', $id_hukuman);
	  $this->db->update('riwayat_hukuman', $data);
	}
	public function catat_riwayat_bahasa_by_operator($id_bahasa){
	$data = array(
	  'catatan_verifikasi' => $this->input->post('catatan_verifikasi'),
	  'tgl_catatan_verifikasi' => date('Y-m-d H:i:s')
	);
	  $this->db->where('id', $id_bahasa);
	  $this->db->update('riwayat_bahasa', $data);
	}
	public function catat_riwayat_bahasa_asing_by_operator($id_bahasa_asing){
	$data = array(
	  'catatan_verifikasi' => $this->input->post('catatan_verifikasi'),
	  'tgl_catatan_verifikasi' => date('Y-m-d H:i:s')
	);
	  $this->db->where('id', $id_bahasa_asing);
	  $this->db->update('riwayat_bahasa_asing', $data);
	}
	public function catat_riwayat_pernikahan_by_operator($id_pernikahan){
	$data = array(
	  'catatan_verifikasi' => $this->input->post('catatan_verifikasi'),
	  'tgl_catatan_verifikasi' => date('Y-m-d H:i:s')
	);
	  $this->db->where('id', $id_pernikahan);
	  $this->db->update('riwayat_pernikahan', $data);
	}
	public function catat_riwayat_anak_by_operator($id_anak){
	$data = array(
	  'catatan_verifikasi' => $this->input->post('catatan_verifikasi'),
	  'tgl_catatan_verifikasi' => date('Y-m-d H:i:s')
	);
	  $this->db->where('id', $id_anak);
	  $this->db->update('riwayat_anak', $data);
	}
	public function catat_riwayat_orangtua_by_operator($id_orangtua){
	$data = array(
	  'catatan_verifikasi' => $this->input->post('catatan_verifikasi'),
	  'tgl_catatan_verifikasi' => date('Y-m-d H:i:s')
	);
	  $this->db->where('id', $id_orangtua);
	  $this->db->update('riwayat_orangtua', $data);
	}
	public function catat_riwayat_mertua_by_operator($id_mertua){
	$data = array(
	  'catatan_verifikasi' => $this->input->post('catatan_verifikasi'),
	  'tgl_catatan_verifikasi' => date('Y-m-d H:i:s')
	);
	  $this->db->where('id', $id_mertua);
	  $this->db->update('riwayat_mertua', $data);
	}
	//Kepegawaian catat pegawai
	public function catat_riwayat_pangkat_by_id($id_pangkat){
	  $data = array(
	    'catatan_verifikasi' => $this->input->post('catatan_verifikasi'),
	    'tgl_catatan_verifikasi' => date('Y-m-d H:i:s')
	  );
	  $this->db->where('id', $id_pangkat);
	  $this->db->update('riwayat_pangkat', $data);
	}
	public function catat_riwayat_jabatan_by_id($id_jabatan){
	$data = array(
	  'catatan_verifikasi' => $this->input->post('catatan_verifikasi'),
	  'tgl_catatan_verifikasi' => date('Y-m-d H:i:s')
	);
	  $this->db->where('id', $id_jabatan);
	  $this->db->update('riwayat_jabatan', $data);
	}
	public function catat_riwayat_pendidikan_by_id($id_pendidikan){
	$data = array(
	  'catatan_verifikasi' => $this->input->post('catatan_verifikasi'),
	  'tgl_catatan_verifikasi' => date('Y-m-d H:i:s')
	);
	  $this->db->where('id', $id_pendidikan);
	  $this->db->update('riwayat_pendidikan', $data);
	}
	public function catat_riwayat_diklat_by_id($id_diklat){
	$data = array(
	  'catatan_verifikasi' => $this->input->post('catatan_verifikasi'),
	  'tgl_catatan_verifikasi' => date('Y-m-d H:i:s')
	);
	  $this->db->where('id', $id_diklat);
	  $this->db->update('riwayat_diklat', $data);
	}
	public function catat_riwayat_penataran_by_id($id_penataran){
	$data = array(
	  'catatan_verifikasi' => $this->input->post('catatan_verifikasi'),
	  'tgl_catatan_verifikasi' => date('Y-m-d H:i:s')
	);
	  $this->db->where('id', $id_penataran);
	  $this->db->update('riwayat_penataran', $data);
	}
	public function catat_riwayat_seminar_by_id($id_seminar){
	$data = array(
	  'catatan_verifikasi' => $this->input->post('catatan_verifikasi'),
	  'tgl_catatan_verifikasi' => date('Y-m-d H:i:s')
	);
	  $this->db->where('id', $id_seminar);
	  $this->db->update('riwayat_seminar', $data);
	}
	public function catat_riwayat_kursus_by_id($id_kursus){
	$data = array(
	  'catatan_verifikasi' => $this->input->post('catatan_verifikasi'),
	  'tgl_catatan_verifikasi' => date('Y-m-d H:i:s')
	);
	  $this->db->where('id', $id_kursus);
	  $this->db->update('riwayat_kursus', $data);
	}
	public function catat_riwayat_unit_kerja_by_id($id_unit_kerja){
	$data = array(
	  'catatan_verifikasi' => $this->input->post('catatan_verifikasi'),
	  'tgl_catatan_verifikasi' => date('Y-m-d H:i:s')
	);
	  $this->db->where('id', $id_unit_kerja);
	  $this->db->update('riwayat_unit_kerja', $data);
	}
	public function catat_riwayat_penghargaan_by_id($id_penghargaan){
	$data = array(
	  'catatan_verifikasi' => $this->input->post('catatan_verifikasi'),
	  'tgl_catatan_verifikasi' => date('Y-m-d H:i:s')
	);
	  $this->db->where('id', $id_penghargaan);
	  $this->db->update('riwayat_penghargaan', $data);
	}
	public function catat_riwayat_penugasan_by_id($id_penugasan){
	$data = array(
	  'catatan_verifikasi' => $this->input->post('catatan_verifikasi'),
	  'tgl_catatan_verifikasi' => date('Y-m-d H:i:s')
	);
	  $this->db->where('id', $id_penugasan);
	  $this->db->update('riwayat_penugasan', $data);
	}
	public function catat_riwayat_cuti_by_id($id_cuti){
	$data = array(
	  'catatan_verifikasi' => $this->input->post('catatan_verifikasi'),
	  'tgl_catatan_verifikasi' => date('Y-m-d H:i:s')
	);
	  $this->db->where('id', $id_cuti);
	  $this->db->update('riwayat_cuti', $data);
	}
	public function catat_riwayat_hukuman_by_id($id_hukuman){
	$data = array(
	  'catatan_verifikasi' => $this->input->post('catatan_verifikasi'),
	  'tgl_catatan_verifikasi' => date('Y-m-d H:i:s')
	);
	  $this->db->where('id', $id_hukuman);
	  $this->db->update('riwayat_hukuman', $data);
	}
	public function catat_riwayat_bahasa_by_id($id_bahasa){
	$data = array(
	  'catatan_verifikasi' => $this->input->post('catatan_verifikasi'),
	  'tgl_catatan_verifikasi' => date('Y-m-d H:i:s')
	);
	  $this->db->where('id', $id_bahasa);
	  $this->db->update('riwayat_bahasa', $data);
	}
	public function catat_riwayat_bahasa_asing_by_id($id_bahasa_asing){
	$data = array(
	  'catatan_verifikasi' => $this->input->post('catatan_verifikasi'),
	  'tgl_catatan_verifikasi' => date('Y-m-d H:i:s')
	);
	  $this->db->where('id', $id_bahasa_asing);
	  $this->db->update('riwayat_bahasa_asing', $data);
	}
	public function catat_riwayat_pernikahan_by_id($id_pernikahan){
	$data = array(
	  'catatan_verifikasi' => $this->input->post('catatan_verifikasi'),
	  'tgl_catatan_verifikasi' => date('Y-m-d H:i:s')
	);
	  $this->db->where('id', $id_pernikahan);
	  $this->db->update('riwayat_pernikahan', $data);
	}
	public function catat_riwayat_anak_by_id($id_anak){
	$data = array(
	  'catatan_verifikasi' => $this->input->post('catatan_verifikasi'),
	  'tgl_catatan_verifikasi' => date('Y-m-d H:i:s')
	);
	  $this->db->where('id', $id_anak);
	  $this->db->update('riwayat_anak', $data);
	}
	public function catat_riwayat_orangtua_by_id($id_orangtua){
	$data = array(
	  'catatan_verifikasi' => $this->input->post('catatan_verifikasi'),
	  'tgl_catatan_verifikasi' => date('Y-m-d H:i:s')
	);
	  $this->db->where('id', $id_orangtua);
	  $this->db->update('riwayat_orangtua', $data);
	}
	public function catat_riwayat_mertua_by_id($id_mertua){
	$data = array(
	  'catatan_verifikasi' => $this->input->post('catatan_verifikasi'),
	  'tgl_catatan_verifikasi' => date('Y-m-d H:i:s')
	);
	  $this->db->where('id', $id_mertua);
	  $this->db->update('riwayat_mertua', $data);
	}

	//ASDASDAWDSADWDAWDASDAWDAWDAWDENTONG
	public function update_status_data_true($id_pegawai){
		$data = array(
			'status_verifikasi_data' => 'true'
		);
			$this->db->where('id_pegawai', $id_pegawai);
			$this->db->update('pegawai', $data);
	}
	public function update_status_data_process($id_pegawai){
		$data = array(
			'status_verifikasi_data' => 'process'
		);
			$this->db->where('id_pegawai', $id_pegawai);
			$this->db->update('pegawai', $data);
	}
	public function update_status_data_false($id_pegawai){
		$data = array(
			'status_verifikasi_data' => 'false'
		);
			$this->db->where('id_pegawai', $id_pegawai);
			$this->db->update('pegawai', $data);
	}

	//Upload berkas pegawai
	private function _berkasPangkat($id_pegawai){
		$dir = "./data/berkas/pangkat/$id_pegawai";
		if(!file_exists($dir)){
				mkdir($dir);
		}
		$config = array(
		'upload_path' => $dir,
		'allowed_types' => "gif|jpg|png|doc|docx|word|ppt|pdf|xls|rar|7zip",
		'encrypt_name' => TRUE,
		'overwrite' => TRUE,
		'max_size' => "2048000"
		);
	$this->load->library('upload', $config);
	if($this->upload->do_upload('berkas')){
			$data = array('berkas' => $this->upload->data());
			return $this->upload->data('file_name');
		}else{
			$error = array('error' => $this->upload->display_errors());
			$this->session->set_flashdata('error',$error['error']);
			return "default";
		}
	}
	private function _berkasJabatan($id_pegawai){
		$dir = "./data/berkas/jabatan/$id_pegawai";
		if(!file_exists($dir)){
				mkdir($dir);
		}
		$config = array(
		'upload_path' => $dir,
		'allowed_types' => "gif|jpg|png|doc|docx|word|ppt|pdf|xls|rar|7zip",
		'encrypt_name' => TRUE,
		'overwrite' => TRUE,
		'max_size' => "2048000"
		);
	$this->load->library('upload', $config);
	if($this->upload->do_upload('berkas')){
			$data = array('berkas' => $this->upload->data());
			return $this->upload->data('file_name');
		}else{
			$error = array('error' => $this->upload->display_errors());
			$this->session->set_flashdata('error',$error['error']);
			return "default";
		}
	}
	private function _berkasPendidikan($id_pegawai){
		$dir = "./data/berkas/pendidikan/$id_pegawai";
		if(!file_exists($dir)){
				mkdir($dir);
		}
		$config = array(
		'upload_path' => $dir,
		'allowed_types' => "gif|jpg|png|doc|docx|word|ppt|pdf|xls|rar|7zip",
		'encrypt_name' => TRUE,
		'overwrite' => TRUE,
		'max_size' => "2048000"
		);
	$this->load->library('upload', $config);
	if($this->upload->do_upload('berkas')){
			$data = array('berkas' => $this->upload->data());
			return $this->upload->data('file_name');
		}else{
			$error = array('error' => $this->upload->display_errors());
			$this->session->set_flashdata('error',$error['error']);
			return "default";
		}
	}
	private function _berkasDiklat($id_pegawai){
		$dir = "./data/berkas/diklat/$id_pegawai";
		if(!file_exists($dir)){
				mkdir($dir);
		}
		$config = array(
		'upload_path' => $dir,
		'allowed_types' => "gif|jpg|png|doc|docx|word|ppt|pdf|xls|rar|7zip",
		'encrypt_name' => TRUE,
		'overwrite' => TRUE,
		'max_size' => "2048000"
		);
	$this->load->library('upload', $config);
	if($this->upload->do_upload('berkas')){
			$data = array('berkas' => $this->upload->data());
			return $this->upload->data('file_name');
		}else{
			$error = array('error' => $this->upload->display_errors());
			$this->session->set_flashdata('error',$error['error']);
			return "default";
		}
	}
	private function _berkasPenataran($id_pegawai){
		$dir = "./data/berkas/penataran/$id_pegawai";
		if(!file_exists($dir)){
				mkdir($dir);
		}
		$config = array(
		'upload_path' => $dir,
		'allowed_types' => "gif|jpg|png|doc|docx|word|ppt|pdf|xls|rar|7zip",
		'encrypt_name' => TRUE,
		'overwrite' => TRUE,
		'max_size' => "2048000"
		);
	$this->load->library('upload', $config);
	if($this->upload->do_upload('berkas')){
			$data = array('berkas' => $this->upload->data());
			return $this->upload->data('file_name');
		}else{
			$error = array('error' => $this->upload->display_errors());
			$this->session->set_flashdata('error',$error['error']);
			return "default";
		}
	}
	private function _berkasSeminar($id_pegawai){
		$dir = "./data/berkas/seminar/$id_pegawai";
		if(!file_exists($dir)){
				mkdir($dir);
		}
		$config = array(
		'upload_path' => $dir,
		'allowed_types' => "gif|jpg|png|doc|docx|word|ppt|pdf|xls|rar|7zip",
		'encrypt_name' => TRUE,
		'overwrite' => TRUE,
		'max_size' => "2048000"
		);
	$this->load->library('upload', $config);
	if($this->upload->do_upload('berkas')){
			$data = array('berkas' => $this->upload->data());
			return $this->upload->data('file_name');
		}else{
			$error = array('error' => $this->upload->display_errors());
			$this->session->set_flashdata('error',$error['error']);
			return "default";
		}
	}
	private function _berkasKursus($id_pegawai){
		$dir = "./data/berkas/kursus/$id_pegawai";
		if(!file_exists($dir)){
				mkdir($dir);
		}
		$config = array(
		'upload_path' => $dir,
		'allowed_types' => "gif|jpg|png|doc|docx|word|ppt|pdf|xls|rar|7zip",
		'encrypt_name' => TRUE,
		'overwrite' => TRUE,
		'max_size' => "2048000"
		);
	$this->load->library('upload', $config);
	if($this->upload->do_upload('berkas')){
			$data = array('berkas' => $this->upload->data());
			return $this->upload->data('file_name');
		}else{
			$error = array('error' => $this->upload->display_errors());
			$this->session->set_flashdata('error',$error['error']);
			return "default";
		}
	}
	private function _berkasUnitKerja($id_pegawai){
		$dir = "./data/berkas/unit_kerja/$id_pegawai";
		if(!file_exists($dir)){
				mkdir($dir);
		}
		$config = array(
		'upload_path' => $dir,
		'allowed_types' => "gif|jpg|png|doc|docx|word|ppt|pdf|xls|rar|7zip",
		'encrypt_name' => TRUE,
		'overwrite' => TRUE,
		'max_size' => "2048000"
		);
	$this->load->library('upload', $config);
	if($this->upload->do_upload('berkas')){
			$data = array('berkas' => $this->upload->data());
			return $this->upload->data('file_name');
		}else{
			$error = array('error' => $this->upload->display_errors());
			$this->session->set_flashdata('error',$error['error']);
			return "default";
		}
	}
	private function _berkasPenghargaan($id_pegawai){
		$dir = "./data/berkas/penghargaan/$id_pegawai";
		if(!file_exists($dir)){
				mkdir($dir);
		}
		$config = array(
		'upload_path' => $dir,
		'allowed_types' => "gif|jpg|png|doc|docx|word|ppt|pdf|xls|rar|7zip",
		'encrypt_name' => TRUE,
		'overwrite' => TRUE,
		'max_size' => "2048000"
		);
	$this->load->library('upload', $config);
	if($this->upload->do_upload('berkas')){
			$data = array('berkas' => $this->upload->data());
			return $this->upload->data('file_name');
		}else{
			$error = array('error' => $this->upload->display_errors());
			$this->session->set_flashdata('error',$error['error']);
			return "default";
		}
	}
	private function _berkasPenugasan($id_pegawai){
		$dir = "./data/berkas/penugasan/$id_pegawai";
		if(!file_exists($dir)){
				mkdir($dir);
		}
		$config = array(
		'upload_path' => $dir,
		'allowed_types' => "gif|jpg|png|doc|docx|word|ppt|pdf|xls|rar|7zip",
		'encrypt_name' => TRUE,
		'overwrite' => TRUE,
		'max_size' => "2048000"
		);
	$this->load->library('upload', $config);
	if($this->upload->do_upload('berkas')){
			$data = array('berkas' => $this->upload->data());
			return $this->upload->data('file_name');
		}else{
			$error = array('error' => $this->upload->display_errors());
			$this->session->set_flashdata('error',$error['error']);
			return "default";
		}
	}
	private function _berkasCuti($id_pegawai){
		$dir = "./data/berkas/cuti/$id_pegawai";
		if(!file_exists($dir)){
				mkdir($dir);
		}
		$config = array(
		'upload_path' => $dir,
		'allowed_types' => "gif|jpg|png|doc|docx|word|ppt|pdf|xls|rar|7zip",
		'encrypt_name' => TRUE,
		'overwrite' => TRUE,
		'max_size' => "2048000"
		);
	$this->load->library('upload', $config);
	if($this->upload->do_upload('berkas')){
			$data = array('berkas' => $this->upload->data());
			return $this->upload->data('file_name');
		}else{
			$error = array('error' => $this->upload->display_errors());
			$this->session->set_flashdata('error',$error['error']);
			return "default";
		}
	}
	private function _berkasHukuman($id_pegawai){
		$dir = "./data/berkas/hukuman/$id_pegawai";
		if(!file_exists($dir)){
				mkdir($dir);
		}
		$config = array(
		'upload_path' => $dir,
		'allowed_types' => "gif|jpg|png|doc|docx|word|ppt|pdf|xls|rar|7zip",
		'encrypt_name' => TRUE,
		'overwrite' => TRUE,
		'max_size' => "2048000"
		);
	$this->load->library('upload', $config);
	if($this->upload->do_upload('berkas')){
			$data = array('berkas' => $this->upload->data());
			return $this->upload->data('file_name');
		}else{
			$error = array('error' => $this->upload->display_errors());
			$this->session->set_flashdata('error',$error['error']);
			return "default";
		}
	}
	private function _berkasBahasa($id_pegawai){
		$dir = "./data/berkas/bahasa/$id_pegawai";
		if(!file_exists($dir)){
				mkdir($dir);
		}
		$config = array(
		'upload_path' => $dir,
		'allowed_types' => "gif|jpg|png|doc|docx|word|ppt|pdf|xls|rar|7zip",
		'encrypt_name' => TRUE,
		'overwrite' => TRUE,
		'max_size' => "2048000"
		);
	$this->load->library('upload', $config);
	if($this->upload->do_upload('berkas')){
			$data = array('berkas' => $this->upload->data());
			return $this->upload->data('file_name');
		}else{
			$error = array('error' => $this->upload->display_errors());
			$this->session->set_flashdata('error',$error['error']);
			return "default";
		}
	}
	private function _berkasBahasaAsing($id_pegawai){
		$dir = "./data/berkas/bahasa_asing/$id_pegawai";
		if(!file_exists($dir)){
				mkdir($dir);
		}
		$config = array(
		'upload_path' => $dir,
		'allowed_types' => "gif|jpg|png|doc|docx|word|ppt|pdf|xls|rar|7zip",
		'encrypt_name' => TRUE,
		'overwrite' => TRUE,
		'max_size' => "2048000"
		);
	$this->load->library('upload', $config);
	if($this->upload->do_upload('berkas')){
			$data = array('berkas' => $this->upload->data());
			return $this->upload->data('file_name');
		}else{
			$error = array('error' => $this->upload->display_errors());
			$this->session->set_flashdata('error',$error['error']);
			return "default";
		}
	}
	private function _berkasPernikahan($id_pegawai){
		$dir = "./data/berkas/pernikahan/$id_pegawai";
		if(!file_exists($dir)){
				mkdir($dir);
		}
		$config = array(
		'upload_path' => $dir,
		'allowed_types' => "gif|jpg|png|doc|docx|word|ppt|pdf|xls|rar|7zip",
		'encrypt_name' => TRUE,
		'overwrite' => TRUE,
		'max_size' => "2048000"
		);
	$this->load->library('upload', $config);
	if($this->upload->do_upload('berkas')){
			$data = array('berkas' => $this->upload->data());
			return $this->upload->data('file_name');
		}else{
			$error = array('error' => $this->upload->display_errors());
			$this->session->set_flashdata('error',$error['error']);
			return "default";
		}
	}
	private function _berkasAnak($id_pegawai){
		$dir = "./data/berkas/anak/$id_pegawai";
		if(!file_exists($dir)){
				mkdir($dir);
		}
		$config = array(
		'upload_path' => $dir,
		'allowed_types' => "gif|jpg|png|doc|docx|word|ppt|pdf|xls|rar|7zip",
		'encrypt_name' => TRUE,
		'overwrite' => TRUE,
		'max_size' => "2048000"
		);
	$this->load->library('upload', $config);
	if($this->upload->do_upload('berkas')){
			$data = array('berkas' => $this->upload->data());
			return $this->upload->data('file_name');
		}else{
			$error = array('error' => $this->upload->display_errors());
			$this->session->set_flashdata('error',$error['error']);
			return "default";
		}
	}
	private function _berkasOrangtua($id_pegawai){
		$dir = "./data/berkas/orangtua/$id_pegawai";
		if(!file_exists($dir)){
				mkdir($dir);
		}
		$config = array(
		'upload_path' => $dir,
		'allowed_types' => "gif|jpg|png|doc|docx|word|ppt|pdf|xls|rar|7zip",
		'encrypt_name' => TRUE,
		'overwrite' => TRUE,
		'max_size' => "2048000"
		);
	$this->load->library('upload', $config);
	if($this->upload->do_upload('berkas')){
			$data = array('berkas' => $this->upload->data());
			return $this->upload->data('file_name');
		}else{
			$error = array('error' => $this->upload->display_errors());
			$this->session->set_flashdata('error',$error['error']);
			return "default";
		}
	}
	private function _berkasMertua($id_pegawai){
		$dir = "./data/berkas/mertua/$id_pegawai";
		if(!file_exists($dir)){
				mkdir($dir);
		}
		$config = array(
		'upload_path' => $dir,
		'allowed_types' => "gif|jpg|png|doc|docx|word|ppt|pdf|xls|rar|7zip",
		'encrypt_name' => TRUE,
		'overwrite' => TRUE,
		'max_size' => "2048000"
		);
	$this->load->library('upload', $config);
	if($this->upload->do_upload('berkas')){
			$data = array('berkas' => $this->upload->data());
			return $this->upload->data('file_name');
		}else{
			$error = array('error' => $this->upload->display_errors());
			$this->session->set_flashdata('error',$error['error']);
			return "default";
		}
	}

	//Delete berkas pegawai
	private function _deletePangkat($id, $id_pegawai){

			$data = $this->riwayat_pangkat_by_id($id);
			if ($data->berkas != "default") {
				$filename = explode(".", $data->berkas)[0];
			return array_map('unlink', glob(FCPATH."data/berkas/pangkat/$id_pegawai/$filename.*"));
			}
	}
	private function _deleteJabatan($id, $id_pegawai){

			$data = $this->riwayat_jabatan_by_id($id);
			if ($data->berkas != "default") {
				$filename = explode(".", $data->berkas)[0];
			return array_map('unlink', glob(FCPATH."data/berkas/jabatan/$id_pegawai/$filename.*"));
			}
	}
	private function _deletePendidikan($id, $id_pegawai){

			$data = $this->riwayat_pendidikan_by_id($id);
			if ($data->berkas != "default") {
				$filename = explode(".", $data->berkas)[0];
			return array_map('unlink', glob(FCPATH."data/berkas/pendidikan/$id_pegawai/$filename.*"));
			}
	}
	private function _deleteDiklat($id, $id_pegawai){

			$data = $this->riwayat_diklat_by_id($id);
			if ($data->berkas != "default") {
				$filename = explode(".", $data->berkas)[0];
			return array_map('unlink', glob(FCPATH."data/berkas/diklat/$id_pegawai/$filename.*"));
			}
	}
	private function _deletePenataran($id, $id_pegawai){

			$data = $this->riwayat_penataran_by_id($id);
			if ($data->berkas != "default") {
				$filename = explode(".", $data->berkas)[0];
			return array_map('unlink', glob(FCPATH."data/berkas/penataran/$id_pegawai/$filename.*"));
			}
	}
	private function _deleteSeminar($id, $id_pegawai){

			$data = $this->riwayat_seminar_by_id($id);
			if ($data->berkas != "default") {
				$filename = explode(".", $data->berkas)[0];
			return array_map('unlink', glob(FCPATH."data/berkas/seminar/$id_pegawai/$filename.*"));
			}
	}
	private function _deleteKursus($id, $id_pegawai){

			$data = $this->riwayat_unit_kerja_by_id($id);
			if ($data->berkas != "default") {
				$filename = explode(".", $data->berkas)[0];
			return array_map('unlink', glob(FCPATH."data/berkas/unit_kerja/$id_pegawai/$filename.*"));
			}
	}
	private function _deleteUnitKerja($id, $id_pegawai){

			$data = $this->riwayat_unit_kerja_by_id($id);
			if ($data->berkas != "default") {
				$filename = explode(".", $data->berkas)[0];
			return array_map('unlink', glob(FCPATH."data/berkas/unit_kerja/$id_pegawai/$filename.*"));
			}
	}
	private function _deletePenghargaan($id, $id_pegawai){

			$data = $this->riwayat_penghargaan_by_id($id);
			if ($data->berkas != "default") {
				$filename = explode(".", $data->berkas)[0];
			return array_map('unlink', glob(FCPATH."data/berkas/penghargaan/$id_pegawai/$filename.*"));
			}
	}
	private function _deletePenugasan($id, $id_pegawai){

			$data = $this->riwayat_penugasan_by_id($id);
			if ($data->berkas != "default") {
				$filename = explode(".", $data->berkas)[0];
			return array_map('unlink', glob(FCPATH."data/berkas/penugasan/$id_pegawai/$filename.*"));
			}
	}
	private function _deleteCuti($id, $id_pegawai){

			$data = $this->riwayat_cuti_by_id($id);
			if ($data->berkas != "default") {
				$filename = explode(".", $data->berkas)[0];
			return array_map('unlink', glob(FCPATH."data/berkas/cuti/$id_pegawai/$filename.*"));
			}
	}
	private function _deleteHukuman($id, $id_pegawai){

			$data = $this->riwayat_hukuman_by_id($id);
			if ($data->berkas != "default") {
				$filename = explode(".", $data->berkas)[0];
			return array_map('unlink', glob(FCPATH."data/berkas/hukuman/$id_pegawai/$filename.*"));
			}
	}
	private function _deleteBahasa($id, $id_pegawai){

			$data = $this->riwayat_bahasa_by_id($id);
			if ($data->berkas != "default") {
				$filename = explode(".", $data->berkas)[0];
			return array_map('unlink', glob(FCPATH."data/berkas/bahasa/$id_pegawai/$filename.*"));
			}
	}
	private function _deleteBahasaAsing($id, $id_pegawai){

			$data = $this->riwayat_bahasa_asing_by_id($id);
			if ($data->berkas != "default") {
				$filename = explode(".", $data->berkas)[0];
			return array_map('unlink', glob(FCPATH."data/berkas/bahasa_asing/$id_pegawai/$filename.*"));
			}
	}
	private function _deletePernikahan($id, $id_pegawai){

			$data = $this->riwayat_pernikahan_by_id($id);
			if ($data->berkas != "default") {
				$filename = explode(".", $data->berkas)[0];
			return array_map('unlink', glob(FCPATH."data/berkas/pernikahan/$id_pegawai/$filename.*"));
			}
	}
	private function _deleteAnak($id, $id_pegawai){

			$data = $this->riwayat_anak_by_id($id);
			if ($data->berkas != "default") {
				$filename = explode(".", $data->berkas)[0];
			return array_map('unlink', glob(FCPATH."data/berkas/anak/$id_pegawai/$filename.*"));
			}
	}
	private function _deleteOrangtua($id, $id_pegawai){

			$data = $this->riwayat_orangtua_by_id($id);
			if ($data->berkas != "default") {
				$filename = explode(".", $data->berkas)[0];
			return array_map('unlink', glob(FCPATH."data/berkas/orangtua/$id_pegawai/$filename.*"));
			}
	}
	private function _deleteMertua($id, $id_pegawai){

			$data = $this->riwayat_mertua_by_id($id);
			if ($data->berkas != "default") {
				$filename = explode(".", $data->berkas)[0];
			return array_map('unlink', glob(FCPATH."data/berkas/mertua/$id_pegawai/$filename.*"));
			}
	}

	//Upload certificate
	function upload_certificate($id_user){
		$data = array(
			'certificate' => $this->_uploadCertificate($id_user)
		);
		$this->db->where('user_id', $id_user);
		$this->db->update('user', $data);

	}

	private function _uploadCertificate($id_user = null){
		$id_user = (empty($id_user)) ? $this->session->userdata('user_id') : $id_user ;
		$dir = "/sertifikat/".$id_user;
		if(!file_exists($dir)){
				mkdir($dir);
		}
		$config = array(
		'upload_path' => $dir,
		'allowed_types' => "*",
		'encrypt_name' => TRUE
		);

	$this->load->library('upload', $config);
	if($this->upload->do_upload('certificate')){
			$data = array('certificate' => $this->upload->data());
			return $this->upload->data('file_name');
		}else{
			$error = array('error' => $this->upload->display_errors());
			$this->session->set_flashdata('error',$error['error']);
			return "default";
		}
	}

}
?>
