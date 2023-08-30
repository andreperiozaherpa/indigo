<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kenaikan_gaji_berkala_model extends CI_Model{

	public function get_all(){
		if($this->session->userdata('level')!='Administrator'){
			if($this->session->userdata('id_skpd')==5){ //Dinas Kesehatan
				$this->db->group_start();
					$this->db->where('pegawai.id_skpd',$this->session->userdata('id_skpd'));
					$this->db->or_where('ref_skpd.id_skpd_induk',$this->session->userdata('id_skpd'));
				$this->db->group_end();
			}else{

				$this->db->where('pegawai.id_skpd',$this->session->userdata('id_skpd'));
			}
		}
		$this->db->join('ref_skpd','ref_skpd.id_skpd = pegawai.id_skpd');
		$this->db->join('ref_unit_kerja','ref_unit_kerja.id_unit_kerja = pegawai.id_unit_kerja', 'left');
		$this->db->join('ref_jabatan','ref_jabatan.id_jabatan = pegawai.id_jabatan', 'left');
		$query = $this->db->get('pegawai');
		return $query->result();
	}
	public function get_page($mulai,$hal,$nama,$nip, $skpd){
		if($this->session->userdata('level')!='Administrator'){
			if($this->session->userdata('id_skpd')==5){ //Dinas Kesehatan
				$this->db->group_start();
					$this->db->where('pegawai.id_skpd',$this->session->userdata('id_skpd'));
					$this->db->or_where('ref_skpd.id_skpd_induk',$this->session->userdata('id_skpd'));
				$this->db->group_end();
			}else{

				$this->db->where('pegawai.id_skpd',$this->session->userdata('id_skpd'));
			}
		}

		if($nama!='') {
			$this->db->like('pegawai.nama_lengkap', $nama);
		}
		if($nip!='') {
			$this->db->like('pegawai.nip', $nip);
		}
		if($skpd!=''){
				$this->db->where('pegawai.id_skpd', $skpd);
		}else{
			$this->db->limit($hal,$mulai);
		}
		$this->db->select('*, pegawai.id_pegawai as id_pegawai');
		// $this->db->join('master_pegawai', 'master_pegawai.nip_baru = pegawai.nip', 'left');
		$this->db->join('ref_skpd','ref_skpd.id_skpd = pegawai.id_skpd');
		$this->db->join('ref_unit_kerja','ref_unit_kerja.id_unit_kerja = pegawai.id_unit_kerja', 'left');
		$this->db->join('ref_jabatan','ref_jabatan.id_jabatan = pegawai.id_jabatan', 'left');
		$this->db->order_by('pegawai.id_pegawai', 'ASC');
		$query = $this->db->get('pegawai');
		return $query->result();
	}
	public function get_by_id($id_pegawai){
		$this->db->where('id_pegawai',$id_pegawai);
		$query = $this->db->get('pegawai');
		return $query->row();
	}

	public function get_by_id_skpd($id_skpd){
		if($id_skpd!=''&&$id_skpd!=0){
			$this->db->where('pegawai.id_skpd',$id_skpd);
		}
		$this->db->join('ref_skpd','ref_skpd.id_skpd = pegawai.id_skpd');
		$this->db->join('ref_unit_kerja','ref_unit_kerja.id_unit_kerja = pegawai.id_unit_kerja','left');
		$this->db->join('ref_jabatan','ref_jabatan.id_jabatan = pegawai.id_jabatan','left');
		// $this->db->order_by('pegawai.id_jabatan','ASC');
		$this->db->order_by('nama_lengkap','ASC');
		$query = $this->db->get('pegawai');
		return $query->result();
	}

	public function get_jml_by_id_skpd($id_skpd){
		if($id_skpd!=''&&$id_skpd!=0){
			$this->db->where('pegawai.id_skpd',$id_skpd);
		}
		$this->db->join('ref_skpd','ref_skpd.id_skpd = pegawai.id_skpd');
		$this->db->join('ref_unit_kerja','ref_unit_kerja.id_unit_kerja = pegawai.id_unit_kerja','left');
		$this->db->join('ref_jabatan','ref_jabatan.id_jabatan = pegawai.id_jabatan','left');
		// $this->db->order_by('pegawai.id_jabatan','ASC');
		$this->db->order_by('nama_lengkap','ASC');
		$query = $this->db->get('pegawai');
		return $query->num_rows();
	}
	public function insert($data){
		return $this->db->insert('pegawai',$data);
	}
	public function update($data,$id_pegawai){
		return $this->db->update('pegawai',$data,array('id_pegawai'=>$id_pegawai));
	}
	public function delete($id_pegawai){
		$this->db->delete('pegawai',array('id_pegawai'=>$id_pegawai));
	}

	/*public function get_data_pegawai_by_id($id_pegawai){
		$this->db->select("
		master_pegawai.id_pegawai AS id_master_pegawai,
		master_pegawai.nip_lama,
		master_pegawai.nip_baru,
		master_pegawai.karpeg,
		master_pegawai.id_gelardepan,
		master_pegawai.nama_lengkap,
		master_pegawai.id_gelarbelakang,
		master_pegawai.tgl_lahir,
		master_pegawai.tempat_lahir,
		master_pegawai.id_agama,
		master_pegawai.jenis_kelamin,
		master_pegawai.bayar_gaji,
		master_pegawai.kedudukan_pegawai,
		master_pegawai.status_pegawai,
		master_pegawai.alamat,
		master_pegawai.RT,
		master_pegawai.RW,
		master_pegawai.id_desa,
		master_pegawai.id_kecamatan,
		master_pegawai.id_kabupaten,
		master_pegawai.id_provinsi,
		master_pegawai.kode_pos,
		master_pegawai.telepon,
		master_pegawai.kartu_askes,
		master_pegawai.kartu_taspen,
		master_pegawai.karis_karsu,
		master_pegawai.npwp,
		master_pegawai.id_statusmenikah,
		master_pegawai.jml_tanggungan_anak,
		master_pegawai.jml_seluruh_anak,
		master_pegawai.foto,
		master_pegawai.status,
		master_pegawai.golongan_darah,
		master_pegawai.berat_badan,
		master_pegawai.bentuk_muka,
		master_pegawai.ciri_khas,
		master_pegawai.tinggi,
		master_pegawai.rambut,
		master_pegawai.warna_kulit,
		master_pegawai.cacat_tubuh,
		master_pegawai.hobby,
		master_pegawai.kd_skpd,
		master_pegawai.cpns_tmt, master_pegawai.cpns_id_golongan, master_pegawai.cpns_no_sk, master_pegawai.cpns_no_bakn,
		master_pegawai.cpns_pejabat, master_pegawai.cpns_id_jenjangpendidikan, master_pegawai.cpns_tahun_pendidikan,
		master_pegawai.pns_tmt, master_pegawai.pns_id_golongan, master_pegawai.pns_pejabat, master_pegawai.pns_no_sk,
		ref_skpd.nama_skpd,
		ref_gelardepan.nama_gelardepan,
		ref_gelarbelakang.nama_gelarbelakang,
		provinsi.provinsi,
		kabupaten.kabupaten,
		kecamatan.kecamatan,
		desa.desa,
		ref_statusmenikah.nama_statusmenikah,
		ref_agama.nama_agama,
		pegawai.id_pegawai
		");
		$this->db->join('pegawai', 'pegawai.nip = master_pegawai.nip_baru', 'left');
		$this->db->join('ref_skpd','ref_skpd.id_skpd=master_pegawai.kd_skpd','left');
		$this->db->join('ref_gelardepan','ref_gelardepan.id_gelardepan=master_pegawai.id_gelardepan','left');
		$this->db->join('ref_gelarbelakang','ref_gelarbelakang.id_gelarbelakang=master_pegawai.id_gelarbelakang','left');
		$this->db->join('provinsi','provinsi.id_provinsi=master_pegawai.id_provinsi','left');
		$this->db->join('kabupaten','kabupaten.id_kabupaten=master_pegawai.id_kabupaten','left');
		$this->db->join('kecamatan','kecamatan.id_kecamatan=master_pegawai.id_kecamatan','left');
		$this->db->join('desa','desa.id_desa=master_pegawai.id_desa','left');
		$this->db->join('ref_statusmenikah','ref_statusmenikah.id_statusmenikah=master_pegawai.id_statusmenikah','left');
		$this->db->join('ref_agama','ref_agama.id_agama=master_pegawai.id_agama','left');
	  $this->db->where('pegawai.id_pegawai',$id_pegawai);
		$query = $this->db->get('master_pegawai');
		return  $query->row();
	}*/

	public function get_user_by_id_pegawai($id_pegawai){
		$this->db->where('pegawai.id_pegawai', $id_pegawai);
		$this->db->join('user', 'user.id_pegawai = pegawai.id_pegawai');
		$this->db->join('ref_skpd', 'ref_skpd.id_skpd = pegawai.id_skpd', 'left');
		$this->db->join('ref_unit_kerja', 'ref_unit_kerja.id_unit_kerja = pegawai.id_unit_kerja');
		// $this->db->join('ketersediaan_user', 'ketersediaan_user.id_ketersediaan = user.id_ketersediaan', 'left');
		$query = $this->db->get('pegawai');
		$res = $query->row();
		if($res->kepala_skpd=='Y'){
			$res->nama_unit_kerja = $res->nama_skpd;
		}
		return $res;
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

	public function get_riwayat_kgb($id,$limit=null,$offset=0)
	{
		if ($limit) {
			$this->db->limit($limit,$offset);
		}
		$this->db->join('ref_golongan', 'riwayat_kgb.id_golongan = ref_golongan.id_golongan', 'left');
		$this->db->order_by('terhitung_mulai_tanggal', 'DESC');
		return $this->db->get_where('riwayat_kgb',array('id_pegawai' => $id))->result();
	}

	public function get_detail_riwayat_kgb_by_id($id)
	{
		$this->db->join('ref_pp', 'riwayat_kgb.id_pp = ref_pp.id_pp', 'left');
		$this->db->join('ref_golongan', 'riwayat_kgb.id_golongan = ref_golongan.id_golongan', 'left');
		return $this->db->get_where('riwayat_kgb',array('id_riwayat_kgb' => $id))->row();
	}

	public function get_riwayat_kgb_by_id($id)
	{
		return $this->db->get_where('riwayat_kgb',array('id_riwayat_kgb' => $id))->row();
	}

	public function get_detail_kgb_by_id($id)
	{
		return $this->db->get_where('ref_kgb',array('id_kgb' => $id))->row();
	}

	public function insert_riwayat_kgb($data)
	{
		$this->db->insert('riwayat_kgb',$data);
		return $this->db->insert_id();
	}

	public function update_riwayat_kgb($id,$data)
	{
		return $this->db->update('riwayat_kgb',$data,array('id_riwayat_kgb'=>$id));
	}

	public function update_cpns($id,$id_pegawai,$data)
	{
		$this->db->update('master_pegawai',$data,array('id_pegawai'=>$id));
		return $this->db->update('pegawai',$data,array('id_pegawai'=>$id_pegawai));
	}

	public function delete_riwayat_kgb($id,$id_pegawai)
	{
		$this->db->where('id_riwayat_kgb',$id);
		return $this->db->delete('riwayat_kgb');
	}

	public function get_id_golongan_by_name($name)
	{
		return $this->db->get_where('ref_golongan',array('pangkat' => $name))->row();
	}

	public function get_data_pegawai_by_id($id_pegawai){
		$this->db->select("
		master_pegawai.id_pegawai AS id_master_pegawai,
		master_pegawai.nip_lama,
		master_pegawai.nip_baru,
		master_pegawai.karpeg,
		master_pegawai.id_gelardepan,
		master_pegawai.nama_lengkap,
		master_pegawai.id_gelarbelakang,
		master_pegawai.tgl_lahir,
		master_pegawai.tempat_lahir,
		master_pegawai.id_agama,
		master_pegawai.jenis_kelamin,
		master_pegawai.bayar_gaji,
		master_pegawai.kedudukan_pegawai,
		master_pegawai.status_pegawai,
		master_pegawai.alamat,
		master_pegawai.RT,
		master_pegawai.RW,
		master_pegawai.id_desa,
		master_pegawai.id_kecamatan,
		master_pegawai.id_kabupaten,
		master_pegawai.id_provinsi,
		master_pegawai.kode_pos,
		master_pegawai.telepon,
		master_pegawai.kartu_askes,
		master_pegawai.kartu_taspen,
		master_pegawai.karis_karsu,
		master_pegawai.npwp,
		master_pegawai.id_statusmenikah,
		master_pegawai.jml_tanggungan_anak,
		master_pegawai.jml_seluruh_anak,
		master_pegawai.foto,
		master_pegawai.status,
		master_pegawai.golongan_darah,
		master_pegawai.berat_badan,
		master_pegawai.bentuk_muka,
		master_pegawai.ciri_khas,
		master_pegawai.tinggi,
		master_pegawai.rambut,
		master_pegawai.warna_kulit,
		master_pegawai.cacat_tubuh,
		master_pegawai.hobby,
		master_pegawai.kd_skpd,
		master_pegawai.cpns_tmt, master_pegawai.cpns_no_sk, master_pegawai.cpns_no_bakn,
		master_pegawai.cpns_pejabat, master_pegawai.cpns_id_jenjangpendidikan, master_pegawai.cpns_tahun_pendidikan,
		master_pegawai.pns_tmt, master_pegawai.pns_id_golongan, master_pegawai.pns_pejabat, master_pegawai.pns_no_sk,
		ref_skpd.nama_skpd,
		ref_gelardepan.nama_gelardepan,
		ref_gelarbelakang.nama_gelarbelakang,
		provinsi.provinsi,
		kabupaten.kabupaten,
		kecamatan.kecamatan,
		desa.desa,
		ref_statusmenikah.nama_statusmenikah,
		ref_agama.nama_agama,
		pegawai.cpns_id_golongan as cpns_id_golongan,
		pegawai.golongan as golongan_pns,
		pegawai.mkg_tahun_awal as mkg_tahun_awal,
		pegawai.mkg_bulan_awal as mkg_bulan_awal,
		golongan_pns.pangkat as pangkat_pns,
		pegawai.id_pegawai
		");
		$this->db->join('pegawai', 'pegawai.nip = master_pegawai.nip_baru', 'left');
		$this->db->join('ref_skpd','ref_skpd.id_skpd=master_pegawai.kd_skpd','left');
		$this->db->join('ref_gelardepan','ref_gelardepan.id_gelardepan=master_pegawai.id_gelardepan','left');
		$this->db->join('ref_gelarbelakang','ref_gelarbelakang.id_gelarbelakang=master_pegawai.id_gelarbelakang','left');
		$this->db->join('provinsi','provinsi.id_provinsi=master_pegawai.id_provinsi','left');
		$this->db->join('kabupaten','kabupaten.id_kabupaten=master_pegawai.id_kabupaten','left');
		$this->db->join('kecamatan','kecamatan.id_kecamatan=master_pegawai.id_kecamatan','left');
		$this->db->join('desa','desa.id_desa=master_pegawai.id_desa','left');
		$this->db->join('ref_statusmenikah','ref_statusmenikah.id_statusmenikah=master_pegawai.id_statusmenikah','left');
		$this->db->join('ref_agama','ref_agama.id_agama=master_pegawai.id_agama','left');
		$this->db->join('ref_golongan as golongan_pns','golongan_pns.id_golongan=master_pegawai.pns_id_golongan','left');
	  $this->db->where('pegawai.id_pegawai',$id_pegawai);
		$query = $this->db->get('master_pegawai');
		// echo "<pre>";
		// var_dump($query->row());
		// exit();
		return  $query->row();
	}

	public function get_data_cpns_pegawai_by_id($id)
	{
		$this->db->select("
		master_pegawai.cpns_tmt, master_pegawai.cpns_id_golongan, master_pegawai.cpns_no_sk, master_pegawai.cpns_no_bakn,
		master_pegawai.cpns_pejabat, master_pegawai.cpns_id_jenjangpendidikan, master_pegawai.cpns_tahun_pendidikan,
		");
		$this->db->join('pegawai', 'pegawai.nip = master_pegawai.nip_baru', 'left');
	 	$this->db->where('pegawai.id_pegawai',$id_pegawai);
		$query = $this->db->get('master_pegawai');
		return  $query->row();
	}

	public function get_prediksi_kgb($pp,$golongan,$mkg)
	{
		$this->db->join('ref_golongan', 'ref_kgb.id_golongan = ref_golongan.id_golongan', 'left');
		return $this->db->get_where('ref_kgb',array('ref_kgb.id_pp' => $pp, 'ref_kgb.id_golongan' => $golongan, 'ref_kgb.mkg' => $mkg))->row();
	}

}
