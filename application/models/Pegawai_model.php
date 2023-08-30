<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pegawai_model extends CI_Model
{
	public	$id_pegawai	;
	public	$nip_lama	;
	public	$nip_baru	;
	public	$id_gelardepan	;
	public	$nama_lengkap	;
	public	$id_gelarbelakang	;
	public	$tgl_lahir	;
	public	$tempat_lahir	;
	public	$id_agama	;
	public	$jenis_kelamin	;
	public	$kedudukan_pegawai	;
	public	$alamat	;
	public	$RT	;
	public	$RW	;
	public	$id_desa	;
	public	$id_kecamatan	;
	public	$id_kabupaten	;
	public	$id_provinsi	;
	public	$kode_pos	;
	public	$telepon	;
	public	$kartu_akses	;
	public	$kartu_taspen	;
	public	$karis_karsu	;
	public	$npwp	;
	public	$id_statusmenikah	;
	public	$jml_tanggungan_anak	;
	public	$jml_seluruh_anak	;
	public	$foto	;
	public 	$status;
	public 	$nip;
	public 	$id_jabatan;
	public 	$id_unit_kerja;
	public 	$eselon;

	public $kd_skpd;
	public function check_avaliable($nip_baru){
		$this->db->where('nip_baru',$nip_baru);
		$query = $this->db->get('pegawai');
		if ($query->num_rows()==0)
		{
			return true;
		}
		else
		{
			return false;
		}
	} 	public function cek_nip($nip){
		$this->db->where('nip',$nip);
		$query = $this->db->get('pegawai');
		if ($query->num_rows()==0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	public function get_registered(){
		$this->db->join('user','user.id_pegawai = pegawai.id_pegawai');
		$this->db->join('riwayat_unit_kerja','riwayat_unit_kerja.id_pegawai = pegawai.id_pegawai');
		$this->db->join('ref_unit_kerja','ref_unit_kerja.id_unit_kerja = riwayat_unit_kerja.id_unit_kerja');
		$query = $this->db->get('pegawai');
		return $query->result();
	}



	public function get_registered_u($id_skpd=''){
		if($id_skpd!=''){
			$this->db->where('pegawai.id_skpd',$id_skpd);
		}
		$this->db->join('user','user.id_pegawai = pegawai.id_pegawai');
		$this->db->join('ref_unit_kerja','ref_unit_kerja.id_unit_kerja = user.unit_kerja_id');
		$query = $this->db->get('pegawai');
		return $query->result();
	}

	public function insert($data){
		$data['tgl_input'] = date('Y-m-d');
		$this->db->insert('pegawai',$data);
		// $this->updateMaster($data['nip_baru']);
	}
	public function update($data,$id_pegawai){
		$this->db->where('id_pegawai',$id_pegawai);
		$this->db->update('pegawai',$data);
	}
	public function getFromMaster($nip_master)
	{
		$this->db->where('NIP',$nip_master);
		$this->db->where('migrasi','0');
		$query = $this->db->get('pegawai1');
		return $query->result();
	}
	public function get_by_id($id_pegawai=null){
		if ($this->id_pegawai OR $id_pegawai) {

			$id_pegawai = ($this->id_pegawai) ? $this->id_pegawai : $id_pegawai;

			$this->db->select('*, pegawai.id_unit_kerja AS id_unit_kerja, pegawai.id_jabatan AS id_jabatan, pegawai.id_skpd AS id_skpd');
			// $this->db->join('ref_jabatan','pegawai.id_jabatan = ref_jabatan.id_jabatan', 'left');
			$this->db->join('ref_unit_kerja','pegawai.id_unit_kerja = ref_unit_kerja.id_unit_kerja', 'left');
			$this->db->join('ref_skpd','pegawai.id_skpd = ref_skpd.id_skpd', 'left');
			$this->db->where('id_pegawai',$id_pegawai);
			$query = $this->db->get('pegawai');
			return $query->row();
		}
	}

	public function get_all_by_skpd($id_skpd){
		$this->db->join('ref_jabatan','ref_jabatan.id_jabatan = pegawai.id_jabatan','left');
		$this->db->join('ref_unit_kerja','ref_unit_kerja.id_unit_kerja = pegawai.id_unit_kerja','left');
		$this->db->order_by('nama_lengkap','asc');
		$this->db->where('pegawai.id_skpd',$id_skpd);
		$query = $this->db->get('pegawai');
		return $query->result();
	}

	public function cek_user($id_pegawai){
		$this->db->where('id_pegawai',$id_pegawai);
		$query = $this->db->get('pegawai')->row();
		if($query->id_user==0){
			return false;
		}else{
			return true;
		}
	}

	public function get_pegawai_for_pengajuan($nip_baru)
	{
		$this->db->select("
			pegawai.id_pegawai, pegawai.nip_lama, master_pegawai.nip_baru, pegawai.karpeg,pegawai.foto,
			master_pegawai.id_gelardepan, pegawai.nama_lengkap, master_pegawai.id_gelarbelakang,
			ref_gelardepan.nama_gelardepan, ref_gelarbelakang.nama_gelarbelakang,pegawai.jenis_kelamin,
			pegawai.tempat_lahir, pegawai.tgl_lahir, master_pegawai.id_agama, ref_agama.nama_agama,
			pegawai.alamat, pegawai.RT, pegawai.RW, pegawai.kode_pos, pegawai.telepon,
			master_pegawai.id_desa, desa.desa, master_pegawai.id_kecamatan, kecamatan.kecamatan,
			master_pegawai.id_kabupaten, kabupaten.kabupaten, master_pegawai.id_provinsi, provinsi.provinsi,
			pegawai.id_skpd, ref_skpd.nama_skpd
		");
		$this->db->join('master_pegawai', 'master_pegawai.nip = pegawai.nip', 'left');
		$this->db->join('ref_gelardepan','ref_gelardepan.id_gelardepan=master_pegawai.id_gelardepan','left');
		$this->db->join('ref_gelarbelakang','ref_gelarbelakang.id_gelarbelakang=master_pegawai.id_gelarbelakang','left');
		$this->db->join('ref_agama','ref_agama.id_agama=master_pegawai.id_agama','left');
		$this->db->join('provinsi','provinsi.id_provinsi=master_pegawai.id_provinsi','left');
		$this->db->join('kabupaten','kabupaten.id_kabupaten=master_pegawai.id_kabupaten','left');
		$this->db->join('kecamatan','kecamatan.id_kecamatan=master_pegawai.id_kecamatan','left');
		$this->db->join('desa','desa.id_desa=master_pegawai.id_desa','left');
		$this->db->join('ref_skpd','ref_skpd.id_skpd=pegawai.id_skpd','left');
		$this->db->where('nip_baru',$nip_baru);
		$query = $this->db->get('pegawai');
		return $query->result();
	}
	//public function updateMaster($nip)
	//{
		//$this->db->where('NIP',$nip);
		//$this->db->set('migrasi','1');
		//$this->db->update('pegawai1');
	//}
	public function get_for_page($limit=0,$offset=0)
	{
		// $this->db->select("pegawai.id_pegawai, pegawai.nama_lengkap, master_pegawai.nip_baru, pegawai.status, ref_skpd.nama_skpd");

		// $this->db->join('riwayat_unit_kerja','riwayat_unit_kerja.id=pegawai.id_riwayat_unit_kerja','left');
		// $this->db->join('ref_skpd','ref_skpd.id_skpd=riwayat_unit_kerja.id_unit_kerja','left');

		// if ($this->kd_skpd>0) $this->db->where('riwayat_unit_kerja.id_unit_kerja',$this->kd_skpd);
		$this->db->join('ref_unit_kerja','ref_unit_kerja.id_unit_kerja = pegawai.id_unit_kerja');
		$this->db->join('ref_jabatan','ref_jabatan.id_jabatan = pegawai.id_jabatan');
		if ($this->nip!="") $this->db->where(" pegawai.nip like '%".$this->nip."%' ");
		if ($this->nama_lengkap!="") $this->db->where(" pegawai.nama_lengkap like '%".$this->nama_lengkap."%' ");
		if ($this->id_unit_kerja!="") $this->db->where('pegawai.id_unit_kerja',$this->id_unit_kerja);
		if ($this->id_jabatan!="") $this->db->where('pegawai.id_jabatan',$this->id_jabatan);
		// if ($this->status!="") $this->db->where('pegawai.status',$this->status);
		if ($limit>0) $this->db->limit($limit,$offset);
		$query = $this->db->get('pegawai');
		return $query->result();
	}

	public function get_all($id_skpd='', $nama_lengkap='')
	{
		if($id_skpd!==''){
			$this->db->where('pegawai.id_skpd',$id_skpd);
		}
		if($nama_lengkap!==''){
			$this->db->like('pegawai.nama_lengkap',$nama_lengkap);
		}
		$this->db->where('id_skpd !=', 0);
		$query = $this->db->get('pegawai');
		return $query->result();
	}

	public function get($id=0)
	{
		$this->db->select("
			pegawai.*,
			ref_skpd.nama_skpd,
			ref_gelardepan.nama_gelardepan,
			ref_gelarbelakang.nama_gelarbelakang,
			provinsi.provinsi,
			kabupaten.kabupaten,
			kecamatan.kecamatan,
			desa.desa,
			ref_statusmenikah.nama_statusmenikah,
			ref_agama.nama_agama,
			master_pegawai.nip_lama,
			master_pegawai.karpeg,
			master_pegawai.tgl_lahir,
			master_pegawai.tempat_lahir,
			master_pegawai.jenis_kelamin,
			CASE 
				WHEN master_pegawai.jenis_kelamin = '1' THEN 'Laki-laki'
				WHEN master_pegawai.jenis_kelamin = '2' THEN 'Perempuan'
			END as 'jk',
			master_pegawai.kedudukan_pegawai,
			master_pegawai.status_pegawai,
			master_pegawai.kartu_askes,
			master_pegawai.kartu_taspen,
			master_pegawai.karis_karsu,
			master_pegawai.npwp,
			master_pegawai.alamat,
			master_pegawai.RT,
			master_pegawai.RW,
			master_pegawai.telepon,
			master_pegawai.kode_pos,
			master_pegawai.kode_pos,
			master_pegawai.jml_tanggungan_anak,
			master_pegawai.jml_seluruh_anak,
			master_pegawai.golongan_darah,
			master_pegawai.tinggi,
			master_pegawai.berat_badan,
			master_pegawai.rambut,
			master_pegawai.bentuk_muka,
			master_pegawai.warna_kulit,
			master_pegawai.ciri_khas,
			master_pegawai.cacat_tubuh,
			master_pegawai.cpns_tmt, master_pegawai.cpns_id_golongan, master_pegawai.cpns_no_sk, master_pegawai.cpns_no_bakn,
			master_pegawai.cpns_pejabat, master_pegawai.cpns_id_jenjangpendidikan, master_pegawai.cpns_tahun_pendidikan,
			master_pegawai.pns_tmt, master_pegawai.pns_id_golongan, master_pegawai.pns_pejabat, master_pegawai.pns_no_sk,
			pegawai.nip,
			ref_unit_kerja.nama_unit_kerja,
			ref_jabatan.nama_jabatan,
			data_bkd.nama_eselon AS nama_eselon,
			ref_golongan_cpns.pangkat as pangkat_cpns,
			ref_golongan_pns.pangkat as pangkat_pns,

			riwayat_pendidikan.nomor_sk as nomor_ijazah,
			riwayat_pendidikan.nama_pejabat as nama_pejabat_pendidikan,
			riwayat_pendidikan.tgl_sk as tgl_ijazah,
			ref_jenjangpendidikan.nama_jenjangpendidikan,
			ref_tempatpendidikan.nama_tempatpendidikan,
			ref_jenjangpendidikan.tkt as riwayat_pendidikan_level, 
			ref_jurusan.nama_jurusan,

			ref_golongan_rpangkat.pangkat as riwayat_pangkat,
			ref_golongan_rpangkat.golongan as riwayat_pangkat_golongan,
			riwayat_pangkat.tmt_berlaku as riwayat_pangkat_tmt,
			riwayat_pangkat.tgl_sk as riwayat_pangkat_tgl_sk,
			riwayat_pangkat.no_sk as riwayat_pangkat_no_sk,
			riwayat_pangkat.nama_pejabat as riwayat_pangkat_nama_pejabat,
			riwayat_pangkat.gaji_pokok as riwayat_pangkat_gaji_pokok,
			ref_golongan_rpangkat.level as riwayat_pangkat_level,

			ref_jabatan_rjabatan.nama_jabatan as riwayat_jabatan,
			riwayat_jabatan.tgl_mulai as riwayat_jabatan_tmt,
			riwayat_jabatan.tgl_sk as riwayat_jabatan_tgl_sk,
			riwayat_jabatan.no_sk as riwayat_jabatan_no_sk,
			riwayat_jabatan.nama_pejabat as riwayat_jabatan_nama_pejabat

			
");
		$this->db->join('master_pegawai', 'master_pegawai.nip_baru = pegawai.nip', 'left');
		$this->db->join('ref_skpd','ref_skpd.id_skpd=pegawai.id_skpd','left');
		$this->db->join('ref_gelardepan','ref_gelardepan.id_gelardepan=master_pegawai.id_gelardepan','left');
		$this->db->join('ref_gelarbelakang','ref_gelarbelakang.id_gelarbelakang=master_pegawai.id_gelarbelakang','left');
		$this->db->join('provinsi','provinsi.id_provinsi=master_pegawai.id_provinsi','left');
		$this->db->join('kabupaten','kabupaten.id_kabupaten=master_pegawai.id_kabupaten','left');
		$this->db->join('kecamatan','kecamatan.id_kecamatan=master_pegawai.id_kecamatan','left');
		$this->db->join('desa','desa.id_desa=master_pegawai.id_desa','left');
		$this->db->join('ref_statusmenikah','ref_statusmenikah.id_statusmenikah=master_pegawai.id_statusmenikah','left');
		$this->db->join('ref_agama','ref_agama.id_agama=master_pegawai.id_agama','left');

		$this->db->join('ref_unit_kerja','ref_unit_kerja.id_unit_kerja=pegawai.id_unit_kerja','left');
		$this->db->join('ref_jabatan','ref_jabatan.id_jabatan=pegawai.id_jabatan','left');
		$this->db->join('data_bkd', 'data_bkd.nip = pegawai.nip','left');
		//$this->db->join('ref_eselon','ref_eselon.id_eselon=pegawai.eselon','left');

		$this->db->join('ref_golongan as ref_golongan_cpns','ref_golongan_cpns.id_golongan = master_pegawai.cpns_id_golongan','left');
		$this->db->join('ref_golongan as ref_golongan_pns','ref_golongan_pns.id_golongan = master_pegawai.pns_id_golongan','left');

		$this->db->join('riwayat_pendidikan','riwayat_pendidikan.id=master_pegawai.id_riwayat_pendidikan','left');
		$this->db->join('ref_jenjangpendidikan','ref_jenjangpendidikan.id_jenjangpendidikan = riwayat_pendidikan.id_jenjangpendidikan','left');
		$this->db->join('ref_tempatpendidikan','ref_tempatpendidikan.id_tempatpendidikan=riwayat_pendidikan.id_tempatpendidikan','left');
		$this->db->join('ref_jurusan','ref_jurusan.id_jurusan=riwayat_pendidikan.id_jurusan','left');
		
		$this->db->join('riwayat_pangkat','riwayat_pangkat.id=master_pegawai.id_riwayat_pangkat','left');
		$this->db->join('ref_golongan as ref_golongan_rpangkat','ref_golongan_rpangkat.id_golongan = riwayat_pangkat.id_golongan','left');

		$this->db->join('riwayat_jabatan','riwayat_jabatan.id=master_pegawai.id_riwayat_jabatan','left');
		$this->db->join('ref_golongan as ref_golongan_rjabatan','ref_golongan_rjabatan.id_golongan = riwayat_jabatan.id_golongan','left');
		$this->db->join('ref_jabatan as ref_jabatan_rjabatan','ref_jabatan_rjabatan.id_jabatan = riwayat_jabatan.id_jabatan','left');

		if ($id>0) $this->db->where('pegawai.id_pegawai',$id);

		$query = $this->db->get('pegawai');
		return  $query->result_array();
	}
	public function get_golongan()
	{
		$query = $this->db->get('ref_golongan');
		return $query->result();
	}
	public function get_jabatan()
	{
		$this->db->where('status','Y');
		$query = $this->db->get('ref_jabatan');
		return $query->result();
	}
	public function get_jenjangpendidikan()
	{
		$this->db->where('status','Y');
		$query = $this->db->get('ref_jenjangpendidikan');
		return $query->result();
	}
	public function get_jenispenataran()
	{
		$this->db->where('status','Y');
		$query = $this->db->get('ref_penataran');
		return $query->result();
	}
	public function get_tempatpendidikan()
	{
		$this->db->where('status','Y');
		$query = $this->db->get('ref_tempatpendidikan');
		return $query->result();
	}
	public function get_jenisseminar()
	{
		$this->db->where('status','Y');
		$query = $this->db->get('ref_jenisseminar');
		return $query->result();
	}
	public function get_jeniskursus()
	{
		$this->db->where('status','Y');
		$query = $this->db->get('ref_kursus');
		return $query->result();
	}
	public function get_unit_kerja()
	{
		$query = $this->db->get('ref_unit_kerja');
		return $query->result();
	}
	public function get_jurusan($id_tempatpendidikan=null)
	{
		if ($id_tempatpendidikan!=null) $this->db->where('id_tempatpendidikan',$id_tempatpendidikan);
		$this->db->where('status','Y');
		$query = $this->db->get('ref_jurusan');
		return $query->result();
	}
	public function get_jenisdiklat()
	{
		$this->db->where('status','Y');
		$query = $this->db->get('ref_jenisdiklat');
		return $query->result();
	}
	public function get_skpd()
	{
		$this->db->where('status','Aktif');
		$this->db->order_by('nama_skpd','ASC');
		$query = $this->db->get('ref_skpd');
		return $query->result();
	}
	public function get_jenispenghargaan()
	{
		$this->db->where('status','Y');
		$query = $this->db->get('ref_jenispenghargaan');
		return $query->result();
	}
	public function get_jenispenugasan()
	{
		$this->db->where('status','Y');
		$query = $this->db->get('ref_jenispenugasan');
		return $query->result();
	}
	public function get_jeniscuti()
	{
		$this->db->where('status','Y');
		$query = $this->db->get('ref_jeniscuti');
		return $query->result();
	}
	public function get_jenishukuman()
	{
		$this->db->where('status','Y');
		$query = $this->db->get('ref_jenishukuman');
		return $query->result();
	}
	public function tambah_riwayat_pangkat($data)
	{
		$this->db->insert('riwayat_pangkat',$data);
	}
	public function tambah_riwayat_jabatan($data)
	{
		$this->db->insert('riwayat_jabatan',$data);
	}
	public function tambah_riwayat_pendidikan($data)
	{
		$this->db->insert('riwayat_pendidikan',$data);
	}
	public function tambah_riwayat_diklat($data)
	{
		$this->db->insert('riwayat_diklat',$data);
	}
	public function tambah_riwayat_unit_kerja($data)
	{
		$this->db->insert('riwayat_unit_kerja',$data);
	}
	public function tambah_riwayat_penghargaan($data)
	{
		$this->db->insert('riwayat_penghargaan',$data);
	}
	public function tambah_riwayat_cuti($data)
	{
		$this->db->insert('riwayat_cuti',$data);
	}
	public function set_status($id_pegawai,$status){
		$this->db->where('id_pegawai',$id_pegawai);
		$this->db->set('status',$status);
		$this->db->update('pegawai');
	}
	public function get_riwayat_pangkat($id_pegawai=null,$status=null,$nip=null,$nama=null,$limit=0,$offset=0)
	{
		$this->db->select("
			riwayat_pangkat.id, riwayat_pangkat.id_pegawai, riwayat_pangkat.id_golongan, riwayat_pangkat.tmt_berlaku,
			riwayat_pangkat.gaji_pokok, riwayat_pangkat.nama_pejabat, riwayat_pangkat.no_sk, riwayat_pangkat.tgl_sk,
			riwayat_pangkat.status, riwayat_pangkat.berkas,
			ref_golongan.pangkat, ref_golongan.golongan,
			master_pegawai.nip_baru, pegawai.nama_lengkap
		");
		$this->db->join('pegawai','pegawai.id_pegawai = riwayat_pangkat.id_pegawai','left');
		$this->db->join('master_pegawai', 'master_pegawai.nip_baru = pegawai.nip', 'left');
		$this->db->join('ref_golongan','ref_golongan.id_golongan = riwayat_pangkat.id_golongan','left');
		if ($nip!=null && $nama!=null){
			$where = " (master_pegawai.nip_baru like '%$nip%' ";
			$where .= " AND pegawai.nama_lengkap like '%$nama%' ) ";
			if ($id_pegawai!=null) $where .= "AND pegawai.id_pegawai =$id_pegawai ";
			if ($status!=null) $where .= "AND riwayat_pangkat.status =$status ";
			$this->db->where($where);
		}
		else if ($nip==null && $nama!=null){
			//$where = " (master_pegawai.nip_baru like '%$nip%' ";
			$where = " pegawai.nama_lengkap like '%$nama%' ";
			if ($id_pegawai!=null) $where .= "AND pegawai.id_pegawai =$id_pegawai ";
			if ($status!=null) $where .= "AND riwayat_pangkat.status =$status ";
			$this->db->where($where);
		}
		else if ($nip!=null && $nama==null){
			$where = " master_pegawai.nip_baru like '%$nip%' ";
			//$where .= " OR pegawai.nama_lengkap like '%$nama%' ) ";
			if ($id_pegawai!=null) $where .= "AND pegawai.id_pegawai =$id_pegawai ";
			if ($status!=null) $where .= "AND riwayat_pangkat.status =$status ";
			$this->db->where($where);
		}
		else if ($nip==null && $nama==null){
			if ($id_pegawai!=null) $this->db->where('riwayat_pangkat.id_pegawai',$id_pegawai);
			if ($status!=null) $this->db->where('riwayat_pangkat.status',$status);
		}

		if ($limit>0) $this->db->limit($limit,$offset);
		$this->db->order_by('riwayat_pangkat.tgl_sk','DESC');
		$query=$this->db->get('riwayat_pangkat');
		return $query->result();
	}
	public function get_riwayat_pangkat_by_id($id)
	{
		$this->db->select("
			riwayat_pangkat.id, riwayat_pangkat.id_pegawai, riwayat_pangkat.id_golongan, riwayat_pangkat.tmt_berlaku,
			riwayat_pangkat.gaji_pokok, riwayat_pangkat.nama_pejabat, riwayat_pangkat.no_sk, riwayat_pangkat.tgl_sk,
			riwayat_pangkat.status, riwayat_pangkat.berkas,
			riwayat_pangkat.verifikasi_pegawai, riwayat_pangkat.tgl_verifikasi_pegawai,
			riwayat_pangkat.verifikasi_bkd, riwayat_pangkat.tgl_verifikasi_bkd,
			riwayat_pangkat.catatan_verifikasi, riwayat_pangkat.tgl_catatan_verifikasi,
			ref_golongan.pangkat, ref_golongan.golongan,
			master_pegawai.nip_baru, pegawai.nama_lengkap, pegawai.id_pegawai
		");
		$this->db->join('master_pegawai','master_pegawai.nip_baru = riwayat_pangkat.nip','left');
		$this->db->join('pegawai', 'master_pegawai.nip_baru = pegawai.nip', 'left');
		$this->db->join('ref_golongan','ref_golongan.id_golongan = riwayat_pangkat.id_golongan','left');
		$this->db->where('pegawai.id_pegawai',$id);
		$this->db->order_by('riwayat_pangkat.tgl_sk','DESC');
		$query=$this->db->get('riwayat_pangkat');
		// print_r($query->result());
		// die;
		return $query->result();
	}
	public function get_verif_bkd_riwayat_pangkat_by_id($id)
	{
		$this->db->select("
			riwayat_pangkat.id, riwayat_pangkat.id_pegawai, riwayat_pangkat.id_golongan, riwayat_pangkat.tmt_berlaku,
			riwayat_pangkat.gaji_pokok, riwayat_pangkat.nama_pejabat, riwayat_pangkat.no_sk, riwayat_pangkat.tgl_sk,
			riwayat_pangkat.status, riwayat_pangkat.berkas,
			riwayat_pangkat.verifikasi_pegawai, riwayat_pangkat.tgl_verifikasi_pegawai,
			riwayat_pangkat.verifikasi_bkd, riwayat_pangkat.tgl_verifikasi_bkd,
			ref_golongan.pangkat, ref_golongan.golongan,
			master_pegawai.nip_baru, pegawai.nama_lengkap, pegawai.id_pegawai
		");
		$this->db->join('master_pegawai','master_pegawai.nip_baru = riwayat_pangkat.nip','left');
		$this->db->join('pegawai', 'master_pegawai.nip_baru = pegawai.nip', 'left');
		$this->db->join('ref_golongan','ref_golongan.id_golongan = riwayat_pangkat.id_golongan','left');
		$this->db->where('riwayat_pangkat.verifikasi_bkd IS NOT NULL');
		$this->db->where('pegawai.id_pegawai',$id);
		$this->db->order_by('riwayat_pangkat.tgl_sk','DESC');
		$query=$this->db->get('riwayat_pangkat');
		// print_r($query->result());
		// die;
		return $query->result();
	}
	public function get_riwayat_jabatan($id_pegawai=null,$status=null,$nip=null,$nama=null,$limit=0,$offset=0)
	{
		$this->db->select("
			riwayat_jabatan.id,
			riwayat_jabatan.id_pegawai,
			riwayat_jabatan.id_jabatan,
			riwayat_jabatan.id_golongan,
			riwayat_jabatan.tgl_mulai,
			riwayat_jabatan.tgl_akhir,
			riwayat_jabatan.berkas,

			riwayat_jabatan.gaji_pokok,
			riwayat_jabatan.nama_pejabat,
			riwayat_jabatan.no_sk,
			riwayat_jabatan.tgl_sk,
			riwayat_jabatan.status,
			ref_jabatan.nama_jabatan,

			ref_golongan.golongan,
			ref_golongan.pangkat,
			master_pegawai.nip_baru, pegawai.nama_lengkap
		");
		$this->db->join('pegawai','pegawai.id_pegawai = riwayat_jabatan.id_pegawai','left');
		$this->db->join('master_pegawai', 'master_pegawai.nip_baru = pegawai.nip', 'left');
		$this->db->join('ref_golongan','ref_golongan.id_golongan = riwayat_jabatan.id_golongan','left');
		$this->db->join('ref_jabatan','ref_jabatan.id_jabatan = riwayat_jabatan.id_jabatan','left');
		if ($nip!=null && $nama!=null){
			$where = " (master_pegawai.nip_baru like '%$nip%' ";
			$where .= " AND pegawai.nama_lengkap like '%$nama%' ) ";
			if ($id_pegawai!=null) $where .= "AND pegawai.id_pegawai =$id_pegawai ";
			if ($status!=null) $where .= "AND riwayat_jabatan.status =$status ";
			$this->db->where($where);
		}
		else if ($nip==null && $nama!=null){
			//$where = " (master_pegawai.nip_baru like '%$nip%' ";
			$where = " pegawai.nama_lengkap like '%$nama%' ";
			if ($id_pegawai!=null) $where .= "AND pegawai.id_pegawai =$id_pegawai ";
			if ($status!=null) $where .= "AND riwayat_jabatan.status =$status ";
			$this->db->where($where);
		}
		else if ($nip!=null && $nama==null){
			$where = " master_pegawai.nip_baru like '%$nip%' ";
			//$where .= " OR pegawai.nama_lengkap like '%$nama%' ) ";
			if ($id_pegawai!=null) $where .= "AND pegawai.id_pegawai =$id_pegawai ";
			if ($status!=null) $where .= "AND riwayat_jabatan.status =$status ";
			$this->db->where($where);
		}
		else if ($nip==null && $nama==null){
			if ($id_pegawai!=null) $this->db->where('riwayat_jabatan.id_pegawai',$id_pegawai);
			if ($status!=null) $this->db->where('riwayat_jabatan.status',$status);
		}

		if ($limit>0) $this->db->limit($limit,$offset);
		$this->db->order_by('riwayat_jabatan.tgl_sk','DESC');
		$query=$this->db->get('riwayat_jabatan');
		return $query->result();
	}
	public function get_riwayat_jabatan_by_id($id)
	{
		$this->db->select("
			riwayat_jabatan.id,
			riwayat_jabatan.id_pegawai,
			riwayat_jabatan.id_jabatan,
			riwayat_jabatan.id_golongan,
			riwayat_jabatan.tgl_mulai,
			riwayat_jabatan.tgl_akhir,
			riwayat_jabatan.berkas,

			riwayat_jabatan.gaji_pokok,
			riwayat_jabatan.nama_pejabat,
			riwayat_jabatan.no_sk,
			riwayat_jabatan.tgl_sk,
			riwayat_jabatan.status,
			riwayat_jabatan.verifikasi_pegawai, riwayat_jabatan.tgl_verifikasi_pegawai,
			riwayat_jabatan.verifikasi_bkd, riwayat_jabatan.tgl_verifikasi_bkd,
			riwayat_jabatan.catatan_verifikasi, riwayat_jabatan.tgl_catatan_verifikasi,
			ref_jabatan.nama_jabatan,
			ref_golongan.golongan,
			ref_golongan.pangkat,
			master_pegawai.nip_baru, pegawai.nama_lengkap

		");
		$this->db->join('master_pegawai', 'master_pegawai.nip_baru = riwayat_jabatan.nip', 'left');
		$this->db->join('pegawai','pegawai.nip = master_pegawai.nip_baru','left');
		$this->db->join('ref_golongan','ref_golongan.id_golongan = riwayat_jabatan.id_golongan','left');
		$this->db->join('ref_jabatan','ref_jabatan.id_jabatan = riwayat_jabatan.id_jabatan','left');
		$this->db->where('pegawai.id_pegawai',$id);
		$query = $this->db->get('riwayat_jabatan');
		return $query->result();
	}
	public function get_verif_bkd_riwayat_jabatan_by_id($id)
	{
		$this->db->select("
			riwayat_jabatan.id,
			riwayat_jabatan.id_pegawai,
			riwayat_jabatan.id_jabatan,
			riwayat_jabatan.id_golongan,
			riwayat_jabatan.tgl_mulai,
			riwayat_jabatan.tgl_akhir,
			riwayat_jabatan.berkas,

			riwayat_jabatan.gaji_pokok,
			riwayat_jabatan.nama_pejabat,
			riwayat_jabatan.no_sk,
			riwayat_jabatan.tgl_sk,
			riwayat_jabatan.status,
			riwayat_jabatan.verifikasi_pegawai, riwayat_jabatan.tgl_verifikasi_pegawai,
			riwayat_jabatan.verifikasi_bkd, riwayat_jabatan.tgl_verifikasi_bkd,
			ref_jabatan.nama_jabatan,
			ref_golongan.golongan,
			ref_golongan.pangkat,
			master_pegawai.nip_baru, pegawai.nama_lengkap

		");
		$this->db->join('master_pegawai', 'master_pegawai.nip_baru = riwayat_jabatan.nip', 'left');
		$this->db->join('pegawai','pegawai.nip = master_pegawai.nip_baru','left');
		$this->db->join('ref_golongan','ref_golongan.id_golongan = riwayat_jabatan.id_golongan','left');
		$this->db->join('ref_jabatan','ref_jabatan.id_jabatan = riwayat_jabatan.id_jabatan','left');
		$this->db->where('riwayat_jabatan.verifikasi_bkd IS NOT NULL');
		$this->db->where('pegawai.id_pegawai',$id);
		$query = $this->db->get('riwayat_jabatan');
		return $query->result();
	}
	public function get_riwayat_pendidikan($id_pegawai=null,$status=null,$nip=null,$nama=null,$limit=0,$offset=0)
	{
		$this->db->select("
			riwayat_pendidikan.id,
			riwayat_pendidikan.id_pegawai,
			riwayat_pendidikan.id_jenjangpendidikan,
			riwayat_pendidikan.id_tempatpendidikan,
			riwayat_pendidikan.id_jurusan,
			riwayat_pendidikan.nama_pejabat,
			riwayat_pendidikan.nomor_sk,
			riwayat_pendidikan.tgl_sk,
			riwayat_pendidikan.status,
			riwayat_pendidikan.berkas,
			ref_jenjangpendidikan.nama_jenjangpendidikan,
			ref_tempatpendidikan.nama_tempatpendidikan,
			ref_jurusan.nama_jurusan,

			pegawai.nip, pegawai.nama_lengkap
		");

		$this->db->join('master_pegawai','master_pegawai.id_pegawai = riwayat_pendidikan.id_pegawai','left');
		$this->db->join('pegawai','pegawai.nip = master_pegawai.nip_baru','left');
		$this->db->join('ref_jenjangpendidikan','ref_jenjangpendidikan.id_jenjangpendidikan = riwayat_pendidikan.id_jenjangpendidikan','left');
		$this->db->join('ref_tempatpendidikan','ref_tempatpendidikan.id_tempatpendidikan=riwayat_pendidikan.id_tempatpendidikan','left');
		$this->db->join('ref_jurusan','ref_jurusan.id_jurusan=riwayat_pendidikan.id_jurusan','left');
		$this->db->where('pegawai.id_pegawai', $id_pegawai);
		if ($nip!=null && $nama!=null){
			$where = " (pegawai.nip like '%$nip%' ";
			$where .= " AND pegawai.nama_lengkap like '%$nama%' ) ";
			if ($id_pegawai!=null) $where .= "AND pegawai.id_pegawai =$id_pegawai ";
			if ($status!=null) $where .= "AND riwayat_pendidikan.status =$status ";
			$this->db->where($where);
		}
		else if ($nip==null && $nama!=null){
			//$where = " (master_pegawai.nip_baru like '%$nip%' ";
			$where = " pegawai.nama_lengkap like '%$nama%' ";
			if ($id_pegawai!=null) $where .= "AND pegawai.id_pegawai =$id_pegawai ";
			if ($status!=null) $where .= "AND riwayat_pendidikan.status =$status ";
			$this->db->where($where);
		}
		else if ($nip!=null && $nama==null){
			$where = " pegawai.nip like '%$nip%' ";
			//$where .= " OR pegawai.nama_lengkap like '%$nama%' ) ";
			if ($id_pegawai!=null) $where .= "AND pegawai.id_pegawai =$id_pegawai ";
			if ($status!=null) $where .= "AND riwayat_pendidikan.status =$status ";
			$this->db->where($where);
		}
		else if ($nip==null && $nama==null){
			if ($id_pegawai!=null) $this->db->where('riwayat_pendidikan.id_pegawai',$id_pegawai);
			if ($status!=null) $this->db->where('riwayat_pendidikan.status',$status);
		}

		if ($limit>0) $this->db->limit($limit,$offset);
		$this->db->order_by('riwayat_pendidikan.tgl_sk','DESC');
		$query=$this->db->get('riwayat_pendidikan');
		return $query->result();
	}
	public function get_riwayat_pendidikan_by_id($id)
	{
		$this->db->select("
			riwayat_pendidikan.id,
			riwayat_pendidikan.id_pegawai,
			riwayat_pendidikan.id_jenjangpendidikan,
			riwayat_pendidikan.id_tempatpendidikan,
			riwayat_pendidikan.id_jurusan,
			riwayat_pendidikan.nama_pejabat,
			riwayat_pendidikan.nomor_sk,
			riwayat_pendidikan.tgl_sk,
			riwayat_pendidikan.status,
			riwayat_pendidikan.berkas,
			riwayat_pendidikan.verifikasi_pegawai, riwayat_pendidikan.tgl_verifikasi_pegawai,
			riwayat_pendidikan.verifikasi_bkd, riwayat_pendidikan.tgl_verifikasi_bkd,
			riwayat_pendidikan.catatan_verifikasi, riwayat_pendidikan.tgl_catatan_verifikasi,
			ref_jenjangpendidikan.nama_jenjangpendidikan,
			ref_tempatpendidikan.nama_tempatpendidikan,
			ref_jurusan.nama_jurusan,
			pegawai.id_pegawai,
			master_pegawai.nip_baru, pegawai.nama_lengkap
		");

		$this->db->join('master_pegawai','master_pegawai.nip_baru = riwayat_pendidikan.nip','left');
		$this->db->join('pegawai', 'master_pegawai.nip_baru = pegawai.nip', 'left');
		$this->db->join('ref_jenjangpendidikan','ref_jenjangpendidikan.id_jenjangpendidikan = riwayat_pendidikan.id_jenjangpendidikan','left');
		$this->db->join('ref_tempatpendidikan','ref_tempatpendidikan.id_tempatpendidikan=riwayat_pendidikan.id_tempatpendidikan','left');
		$this->db->join('ref_jurusan','ref_jurusan.id_jurusan=riwayat_pendidikan.id_jurusan','left');
		$this->db->where('pegawai.id_pegawai',$id);
		$this->db->order_by('riwayat_pendidikan.tgl_sk','DESC');
		$query=$this->db->get('riwayat_pendidikan');
		return $query->result();
	}
	
	public function get_verif_bkd_riwayat_pendidikan_by_id($id)
	{
		$this->db->select("
			riwayat_pendidikan.id,
			riwayat_pendidikan.id_pegawai,
			riwayat_pendidikan.id_jenjangpendidikan,
			riwayat_pendidikan.id_tempatpendidikan,
			riwayat_pendidikan.id_jurusan,
			riwayat_pendidikan.nama_pejabat,
			riwayat_pendidikan.nomor_sk,
			riwayat_pendidikan.tgl_sk,
			riwayat_pendidikan.status,
			riwayat_pendidikan.berkas,
			riwayat_pendidikan.verifikasi_pegawai, riwayat_pendidikan.tgl_verifikasi_pegawai,
			riwayat_pendidikan.verifikasi_bkd, riwayat_pendidikan.tgl_verifikasi_bkd,
			ref_jenjangpendidikan.nama_jenjangpendidikan,
			ref_tempatpendidikan.nama_tempatpendidikan,
			ref_jurusan.nama_jurusan,
			pegawai.id_pegawai,
			master_pegawai.nip_baru, pegawai.nama_lengkap
		");

		$this->db->join('master_pegawai','master_pegawai.nip_baru = riwayat_pendidikan.nip','left');
		$this->db->join('pegawai', 'master_pegawai.nip_baru = pegawai.nip', 'left');
		$this->db->join('ref_jenjangpendidikan','ref_jenjangpendidikan.id_jenjangpendidikan = riwayat_pendidikan.id_jenjangpendidikan','left');
		$this->db->join('ref_tempatpendidikan','ref_tempatpendidikan.id_tempatpendidikan=riwayat_pendidikan.id_tempatpendidikan','left');
		$this->db->join('ref_jurusan','ref_jurusan.id_jurusan=riwayat_pendidikan.id_jurusan','left');
		$this->db->where('riwayat_pendidikan.verifikasi_bkd IS NOT NULL');
		$this->db->where('pegawai.id_pegawai',$id);
		$this->db->order_by('riwayat_pendidikan.tgl_sk','DESC');
		$query=$this->db->get('riwayat_pendidikan');
		return $query->result();
	}
	public function get_riwayat_diklat($id_pegawai=null,$status=null,$nip=null,$nama=null,$limit=0,$offset=0)
	{
		$this->db->select("
			riwayat_diklat.id,
			riwayat_diklat.id_pegawai,
			riwayat_diklat.id_jenisdiklat,
			riwayat_diklat.nama_diklat,
			riwayat_diklat.tempat,
			riwayat_diklat.penyelenggara,
			riwayat_diklat.angkatan,
			riwayat_diklat.tgl_mulai,
			riwayat_diklat.tgl_akhir,
			riwayat_diklat.no_sptl,
			riwayat_diklat.tgl_sptl,
			riwayat_diklat.status,
			riwayat_diklat.berkas,
			ref_jenisdiklat.nama_jenisdiklat,
			master_pegawai.nip_baru, pegawai.nama_lengkap
		");
		$this->db->join('pegawai','pegawai.id_pegawai = riwayat_diklat.id_pegawai','left');
		$this->db->join('master_pegawai', 'master_pegawai.nip_baru = pegawai.nip', 'left');
		$this->db->join('ref_jenisdiklat','ref_jenisdiklat.id_jenisdiklat = riwayat_diklat.id_jenisdiklat','left');
		if ($nip!=null && $nama!=null){
			$where = " (master_pegawai.nip_baru like '%$nip%' ";
			$where .= " AND pegawai.nama_lengkap like '%$nama%' ) ";
			if ($id_pegawai!=null) $where .= "AND pegawai.id_pegawai =$id_pegawai ";
			if ($status!=null) $where .= "AND riwayat_diklat.status =$status ";
			$this->db->where($where);
		}
		else if ($nip==null && $nama!=null){
			//$where = " (master_pegawai.nip_baru like '%$nip%' ";
			$where = " pegawai.nama_lengkap like '%$nama%' ";
			if ($id_pegawai!=null) $where .= "AND pegawai.id_pegawai =$id_pegawai ";
			if ($status!=null) $where .= "AND riwayat_diklat.status =$status ";
			$this->db->where($where);
		}
		else if ($nip!=null && $nama==null){
			$where = " master_pegawai.nip_baru like '%$nip%' ";
			//$where .= " OR pegawai.nama_lengkap like '%$nama%' ) ";
			if ($id_pegawai!=null) $where .= "AND pegawai.id_pegawai =$id_pegawai ";
			if ($status!=null) $where .= "AND riwayat_diklat.status =$status ";
			$this->db->where($where);
		}
		else if ($nip==null && $nama==null){
			if ($id_pegawai!=null) $this->db->where('riwayat_diklat.id_pegawai',$id_pegawai);
			if ($status!=null) $this->db->where('riwayat_diklat.status',$status);
		}

		if ($limit>0) $this->db->limit($limit,$offset);
		$this->db->order_by('riwayat_diklat.tgl_mulai','DESC');
		$query=$this->db->get('riwayat_diklat');
		return $query->result();
	}
	public function get_riwayat_diklat_by_id($id)
	{
		$this->db->select("
			riwayat_diklat.id,
			riwayat_diklat.id_pegawai,
			riwayat_diklat.id_jenisdiklat,
			riwayat_diklat.nama_diklat,
			riwayat_diklat.tempat,
			riwayat_diklat.penyelenggara,
			riwayat_diklat.angkatan,
			riwayat_diklat.tgl_mulai,
			riwayat_diklat.tgl_akhir,
			riwayat_diklat.no_sptl,
			riwayat_diklat.tgl_sptl,
			riwayat_diklat.status,
			riwayat_diklat.berkas,
			riwayat_diklat.verifikasi_pegawai, riwayat_diklat.tgl_verifikasi_pegawai,
			riwayat_diklat.verifikasi_bkd, riwayat_diklat.tgl_verifikasi_bkd,
			riwayat_diklat.catatan_verifikasi, riwayat_diklat.tgl_catatan_verifikasi,
			ref_jenisdiklat.nama_jenisdiklat,
			master_pegawai.nip_baru, pegawai.nama_lengkap
		");
		$this->db->join('master_pegawai', 'master_pegawai.nip_baru = riwayat_diklat.nip', 'left');
		$this->db->join('pegawai','pegawai.nip = master_pegawai.nip_baru','left');
		$this->db->join('ref_jenisdiklat','ref_jenisdiklat.id_jenisdiklat = riwayat_diklat.id_jenisdiklat','left');
		$this->db->where('pegawai.id_pegawai',$id);
		$this->db->order_by('riwayat_diklat.tgl_mulai','DESC');
		$query=$this->db->get('riwayat_diklat');
		return $query->result();
	}
	public function get_verif_bkd_riwayat_diklat_by_id($id)
	{
		$this->db->select("
			riwayat_diklat.id,
			riwayat_diklat.id_pegawai,
			riwayat_diklat.id_jenisdiklat,
			riwayat_diklat.nama_diklat,
			riwayat_diklat.tempat,
			riwayat_diklat.penyelenggara,
			riwayat_diklat.angkatan,
			riwayat_diklat.tgl_mulai,
			riwayat_diklat.tgl_akhir,
			riwayat_diklat.no_sptl,
			riwayat_diklat.tgl_sptl,
			riwayat_diklat.status,
			riwayat_diklat.berkas,
			riwayat_diklat.verifikasi_pegawai, riwayat_diklat.tgl_verifikasi_pegawai,
			riwayat_diklat.verifikasi_bkd, riwayat_diklat.tgl_verifikasi_bkd,
			ref_jenisdiklat.nama_jenisdiklat,
			master_pegawai.nip_baru, pegawai.nama_lengkap
		");
		$this->db->join('master_pegawai', 'master_pegawai.nip_baru = riwayat_diklat.nip', 'left');
		$this->db->join('pegawai','pegawai.nip = master_pegawai.nip_baru','left');
		$this->db->join('ref_jenisdiklat','ref_jenisdiklat.id_jenisdiklat = riwayat_diklat.id_jenisdiklat','left');
		$this->db->where('riwayat_diklat.verifikasi_bkd IS NOT NULL');
		$this->db->where('pegawai.id_pegawai',$id);
		$this->db->order_by('riwayat_diklat.tgl_mulai','DESC');
		$query=$this->db->get('riwayat_diklat');
		return $query->result();
	}
	public function get_riwayat_unit_kerja($id_pegawai=null,$status=null,$nip=null,$nama=null,$limit=0,$offset=0)
	{
		$this->db->select("
			riwayat_unit_kerja.id,
			riwayat_unit_kerja.id_pegawai,
			riwayat_unit_kerja.id_unit_kerja,
			riwayat_unit_kerja.tmt_awal,
			riwayat_unit_kerja.tmt_akhir,
			riwayat_unit_kerja.no_sk_awal,
			riwayat_unit_kerja.no_sk_akhir,
			riwayat_unit_kerja.status,
			riwayat_unit_kerja.berkas,
			ref_skpd.nama_skpd,
			ref_skpd.alamat_skpd,
			ref_skpd.telepon_skpd,
			ref_skpd.email_skpd,
			master_pegawai.nip_baru, pegawai.nama_lengkap
		");
		$this->db->join('pegawai','pegawai.id_pegawai = riwayat_unit_kerja.id_pegawai','left');
		$this->db->join('master_pegawai', 'master_pegawai.nip_baru = pegawai.nip', 'left');
		$this->db->join('ref_skpd','ref_skpd.id_skpd = riwayat_unit_kerja.id_unit_kerja','left');
		if ($nip!=null && $nama!=null){
			$where = " (master_pegawai.nip_baru like '%$nip%' ";
			$where .= " AND pegawai.nama_lengkap like '%$nama%' ) ";
			if ($id_pegawai!=null) $where .= "AND pegawai.id_pegawai =$id_pegawai ";
			if ($status!=null) $where .= "AND riwayat_unit_kerja.status =$status ";
			$this->db->where($where);
		}
		else if ($nip==null && $nama!=null){
			//$where = " (master_pegawai.nip_baru like '%$nip%' ";
			$where = " pegawai.nama_lengkap like '%$nama%' ";
			if ($id_pegawai!=null) $where .= "AND pegawai.id_pegawai =$id_pegawai ";
			if ($status!=null) $where .= "AND riwayat_unit_kerja.status =$status ";
			$this->db->where($where);
		}
		else if ($nip!=null && $nama==null){
			$where = " master_pegawai.nip_baru like '%$nip%' ";
			//$where .= " OR pegawai.nama_lengkap like '%$nama%' ) ";
			if ($id_pegawai!=null) $where .= "AND pegawai.id_pegawai =$id_pegawai ";
			if ($status!=null) $where .= "AND riwayat_unit_kerja.status =$status ";
			$this->db->where($where);
		}
		else if ($nip==null && $nama==null){
			if ($id_pegawai!=null) $this->db->where('riwayat_unit_kerja.id_pegawai',$id_pegawai);
			if ($status!=null) $this->db->where('riwayat_unit_kerja.status',$status);
		}

		if ($limit>0) $this->db->limit($limit,$offset);
		$this->db->order_by('riwayat_unit_kerja.tmt_akhir','DESC');
		$query=$this->db->get('riwayat_unit_kerja');
		return $query->result();
	}
	public function get_riwayat_unit_kerja_by_id($id)
	{
		$this->db->select("
			riwayat_unit_kerja.id,
			riwayat_unit_kerja.id_pegawai,
			riwayat_unit_kerja.id_unit_kerja,
			riwayat_unit_kerja.tmt_awal,
			riwayat_unit_kerja.tmt_akhir,
			riwayat_unit_kerja.no_sk_awal,
			riwayat_unit_kerja.no_sk_akhir,
			riwayat_unit_kerja.status,
			riwayat_unit_kerja.berkas,
			riwayat_unit_kerja.verifikasi_pegawai, riwayat_unit_kerja.tgl_verifikasi_pegawai,
			riwayat_unit_kerja.verifikasi_bkd, riwayat_unit_kerja.tgl_verifikasi_bkd,
			riwayat_unit_kerja.catatan_verifikasi, riwayat_unit_kerja.tgl_catatan_verifikasi,
			ref_unit_kerja.nama_unit_kerja,
			pegawai.id_pegawai,
			master_pegawai.nip_baru, pegawai.nama_lengkap
		");
		$this->db->join('master_pegawai', 'master_pegawai.nip_baru = riwayat_unit_kerja.nip', 'left');
		$this->db->join('pegawai','pegawai.nip = master_pegawai.nip_baru','left');
		$this->db->join('ref_unit_kerja','ref_unit_kerja.id_unit_kerja = riwayat_unit_kerja.id_unit_kerja','left');
		$this->db->where('pegawai.id_pegawai',$id);
		$this->db->order_by('riwayat_unit_kerja.tmt_akhir','DESC');
		$query=$this->db->get('riwayat_unit_kerja');
		return $query->result();
	}
	public function get_verif_bkd_riwayat_unit_kerja_by_id($id)
	{
		$this->db->select("
			riwayat_unit_kerja.id,
			riwayat_unit_kerja.id_pegawai,
			riwayat_unit_kerja.id_unit_kerja,
			riwayat_unit_kerja.tmt_awal,
			riwayat_unit_kerja.tmt_akhir,
			riwayat_unit_kerja.no_sk_awal,
			riwayat_unit_kerja.no_sk_akhir,
			riwayat_unit_kerja.status,
			riwayat_unit_kerja.berkas,
			riwayat_unit_kerja.verifikasi_pegawai, riwayat_unit_kerja.tgl_verifikasi_pegawai,
			riwayat_unit_kerja.verifikasi_bkd, riwayat_unit_kerja.tgl_verifikasi_bkd,
			ref_unit_kerja.nama_unit_kerja,
			pegawai.id_pegawai,
			master_pegawai.nip_baru, pegawai.nama_lengkap
		");
		$this->db->join('master_pegawai', 'master_pegawai.nip_baru = riwayat_unit_kerja.nip', 'left');
		$this->db->join('pegawai','pegawai.nip = master_pegawai.nip_baru','left');
		$this->db->join('ref_unit_kerja','ref_unit_kerja.id_unit_kerja = riwayat_unit_kerja.id_unit_kerja','left');
		$this->db->where('riwayat_unit_kerja.verifikasi_bkd IS NOT NULL');
		$this->db->where('pegawai.id_pegawai',$id);
		$this->db->order_by('riwayat_unit_kerja.tmt_akhir','DESC');
		$query=$this->db->get('riwayat_unit_kerja');
		return $query->result();
	}
	public function get_riwayat_penghargaan($id_pegawai=null,$status=null,$nip=null,$nama=null,$limit=0,$offset=0)
	{
		$this->db->select("
			riwayat_penghargaan.id,
			riwayat_penghargaan.id_pegawai,
			riwayat_penghargaan.id_jenispenghargaan,
			riwayat_penghargaan.nama_penghargaan,
			riwayat_penghargaan.tahun,
			riwayat_penghargaan.asal_perolehan,
			riwayat_penghargaan.penandatangan,
			riwayat_penghargaan.no_penghargaan,
			riwayat_penghargaan.tgl_penghargaan,
			riwayat_penghargaan.status,
			riwayat_penghargaan.berkas,
			riwayat_penghargaan.verifikasi_pegawai, riwayat_penghargaan.tgl_verifikasi_pegawai,
			riwayat_penghargaan.verifikasi_bkd, riwayat_penghargaan.tgl_verifikasi_bkd,
			ref_jenispenghargaan.nama_jenispenghargaan,
			master_pegawai.nip_baru, pegawai.nama_lengkap
		");
		$this->db->join('pegawai','pegawai.id_pegawai = riwayat_penghargaan.id_pegawai','left');
		$this->db->join('master_pegawai', 'master_pegawai.nip_baru = pegawai.nip', 'left');
		$this->db->join('ref_jenispenghargaan','ref_jenispenghargaan.id_jenispenghargaan = riwayat_penghargaan.id_jenispenghargaan','left');
		if ($nip!=null && $nama!=null){
			$where = " (master_pegawai.nip_baru like '%$nip%' ";
			$where .= " AND pegawai.nama_lengkap like '%$nama%' ) ";
			if ($id_pegawai!=null) $where .= "AND pegawai.id_pegawai =$id_pegawai ";
			if ($status!=null) $where .= "AND riwayat_penghargaan.status =$status ";
			$this->db->where($where);
		}
		else if ($nip==null && $nama!=null){
			//$where = " (master_pegawai.nip_baru like '%$nip%' ";
			$where = " pegawai.nama_lengkap like '%$nama%' ";
			if ($id_pegawai!=null) $where .= "AND pegawai.id_pegawai =$id_pegawai ";
			if ($status!=null) $where .= "AND riwayat_penghargaan.status =$status ";
			$this->db->where($where);
		}
		else if ($nip!=null && $nama==null){
			$where = " master_pegawai.nip_baru like '%$nip%' ";
			//$where .= " OR pegawai.nama_lengkap like '%$nama%' ) ";
			if ($id_pegawai!=null) $where .= "AND pegawai.id_pegawai =$id_pegawai ";
			if ($status!=null) $where .= "AND riwayat_penghargaan.status =$status ";
			$this->db->where($where);
		}
		else if ($nip==null && $nama==null){
			if ($id_pegawai!=null) $this->db->where('riwayat_penghargaan.id_pegawai',$id_pegawai);
			if ($status!=null) $this->db->where('riwayat_penghargaan.status',$status);
		}

		if ($limit>0) $this->db->limit($limit,$offset);$this->db->order_by('riwayat_penghargaan.tgl_penghargaan','DESC');
		$query=$this->db->get('riwayat_penghargaan');
		return $query->result();
	}
	public function get_riwayat_penghargaan_by_id($id)
	{
		$this->db->select("
			riwayat_penghargaan.id,
			riwayat_penghargaan.id_pegawai,
			riwayat_penghargaan.id_jenispenghargaan,
			riwayat_penghargaan.nama_penghargaan,
			riwayat_penghargaan.tahun,
			riwayat_penghargaan.asal_perolehan,
			riwayat_penghargaan.penandatangan,
			riwayat_penghargaan.no_penghargaan,
			riwayat_penghargaan.tgl_penghargaan,
			riwayat_penghargaan.status,
			riwayat_penghargaan.berkas,
			riwayat_penghargaan.verifikasi_pegawai, riwayat_penghargaan.tgl_verifikasi_pegawai,
			riwayat_penghargaan.verifikasi_bkd, riwayat_penghargaan.tgl_verifikasi_bkd,
			riwayat_penghargaan.catatan_verifikasi, riwayat_penghargaan.tgl_catatan_verifikasi,
			ref_jenispenghargaan.nama_jenispenghargaan,
			master_pegawai.nip_baru, pegawai.nama_lengkap
		");
		$this->db->join('pegawai','pegawai.id_pegawai = riwayat_penghargaan.id_pegawai','left');
		$this->db->join('master_pegawai', 'master_pegawai.nip_baru = pegawai.nip', 'left');
		$this->db->join('ref_jenispenghargaan','ref_jenispenghargaan.id_jenispenghargaan = riwayat_penghargaan.id_jenispenghargaan','left');
		$this->db->where('pegawai.id_pegawai',$id);
		$query=$this->db->get('riwayat_penghargaan');
		return $query->result();
	}
	public function get_verif_bkd_riwayat_penghargaan_by_id($id)
	{
		$this->db->select("
			riwayat_penghargaan.id,
			riwayat_penghargaan.id_pegawai,
			riwayat_penghargaan.id_jenispenghargaan,
			riwayat_penghargaan.nama_penghargaan,
			riwayat_penghargaan.tahun,
			riwayat_penghargaan.asal_perolehan,
			riwayat_penghargaan.penandatangan,
			riwayat_penghargaan.no_penghargaan,
			riwayat_penghargaan.tgl_penghargaan,
			riwayat_penghargaan.status,
			riwayat_penghargaan.berkas,
			riwayat_penghargaan.verifikasi_pegawai, riwayat_penghargaan.tgl_verifikasi_pegawai,
			riwayat_penghargaan.verifikasi_bkd, riwayat_penghargaan.tgl_verifikasi_bkd,
			ref_jenispenghargaan.nama_jenispenghargaan,
			master_pegawai.nip_baru, pegawai.nama_lengkap
		");
		$this->db->join('pegawai','pegawai.id_pegawai = riwayat_penghargaan.id_pegawai','left');
		$this->db->join('master_pegawai', 'master_pegawai.nip_baru = pegawai.nip', 'left');
		$this->db->join('ref_jenispenghargaan','ref_jenispenghargaan.id_jenispenghargaan = riwayat_penghargaan.id_jenispenghargaan','left');
		$this->db->where('riwayat_penghargaan.verifikasi_bkd IS NOT NULL');
		$this->db->where('pegawai.id_pegawai',$id);
		$query=$this->db->get('riwayat_penghargaan');
		return $query->result();
	}
	public function get_riwayat_cuti($id_pegawai,$status=null)
	{
		$this->db->select("
			riwayat_cuti.id,
			riwayat_cuti.id_pegawai,
			riwayat_cuti.id_jeniscuti,
			riwayat_cuti.keterangan,
			riwayat_cuti.pejabat_penetapan,
			riwayat_cuti.no_sk,
			riwayat_cuti.tgl_sk,
			riwayat_cuti.tgl_awal_cuti,
			riwayat_cuti.tgl_akhir_cuti,
			riwayat_cuti.status,
			riwayat_cuti.berkas,
			riwayat_cuti.verifikasi_pegawai, riwayat_cuti.tgl_verifikasi_pegawai,
			riwayat_cuti.verifikasi_bkd, riwayat_cuti.tgl_verifikasi_bkd,
			riwayat_cuti.catatan_verifikasi, riwayat_cuti.tgl_catatan_verifikasi,
			ref_jeniscuti.nama_jeniscuti
		");
		$this->db->join('ref_jeniscuti','ref_jeniscuti.id_jeniscuti = riwayat_cuti.id_jeniscuti','left');
		$this->db->where('riwayat_cuti.id_pegawai',$id_pegawai);
		if ($status!=null) $this->db->where('riwayat_cuti.status',$status);
		$this->db->order_by('riwayat_cuti.tgl_sk','DESC');
		$query=$this->db->get('riwayat_cuti');
		return $query->result();
	}
	public function get_verif_bkd_riwayat_cuti($id_pegawai,$status=null)
	{
		$this->db->select("
			riwayat_cuti.id,
			riwayat_cuti.id_pegawai,
			riwayat_cuti.id_jeniscuti,
			riwayat_cuti.keterangan,
			riwayat_cuti.pejabat_penetapan,
			riwayat_cuti.no_sk,
			riwayat_cuti.tgl_sk,
			riwayat_cuti.tgl_awal_cuti,
			riwayat_cuti.tgl_akhir_cuti,
			riwayat_cuti.status,
			riwayat_cuti.berkas,
			riwayat_cuti.verifikasi_pegawai, riwayat_cuti.tgl_verifikasi_pegawai,
			riwayat_cuti.verifikasi_bkd, riwayat_cuti.tgl_verifikasi_bkd,
			ref_jeniscuti.nama_jeniscuti
		");
		$this->db->join('ref_jeniscuti','ref_jeniscuti.id_jeniscuti = riwayat_cuti.id_jeniscuti','left');
		$this->db->where('riwayat_cuti.verifikasi_bkd IS NOT NULL');
		$this->db->where('riwayat_cuti.id_pegawai',$id_pegawai);
		if ($status!=null) $this->db->where('riwayat_cuti.status',$status);
		$this->db->order_by('riwayat_cuti.tgl_sk','DESC');
		$query=$this->db->get('riwayat_cuti');
		return $query->result();
	}
	public function ubah_status_riwayat($table,$status,$id)
	{
		$this->db->where('id',$id);
		$this->db->set('status',$status);
		$this->db->update($table);
		$this->update_riwayat_terakhir($table,$id);
	}
	public function update_riwayat_terakhir($table,$id,$delete=null)
	{
		$this->db->where('id',$id);
		$this->db->limit(1);
		$query = $this->db->get($table);
		$data = $query->result();
		$id_pegawai = $data[0]->id_pegawai;
		$id_riwayat = 0;
		if ($table=="riwayat_jabatan"){
			$riwayat = $this->get_riwayat_jabatan($id_pegawai,1);
			$field = "id_riwayat_jabatan";
		}
		else if ($table=="riwayat_pendidikan"){
			$riwayat = $this->get_riwayat_pendidikan($id_pegawai,1);
			$field = "id_riwayat_pendidikan";
		}
		else if ($table=="riwayat_pangkat"){
			$riwayat = $this->get_riwayat_pangkat($id_pegawai,1);
			$field = "id_riwayat_pangkat";
		}
		else if ($table=="riwayat_unit_kerja"){
			$riwayat = $this->get_riwayat_unit_kerja($id_pegawai,1);
			$field = "id_riwayat_unit_kerja";
		}
		else if ($table=="riwayat_diklat"){
			$riwayat = $this->get_riwayat_diklat($id_pegawai,1);
			$field = "id_riwayat_diklat";
		}
		else if ($table=="riwayat_penghargaan"){
			// $riwayat = $this->get_riwayat_penghargaan($id_pegawai,1);
			// $field = "id_riwayat_penghargaan";
		}
		else if ($table=="riwayat_cuti"){
			// $riwayat = $this->get_riwayat_cuti($id_pegawai,1);
			// $field = "id_riwayat_cuti";
		}
		if (!empty($riwayat)) {
			$id_riwayat = $riwayat[0]->id;
			//update pegawai
			$this->db->where('id_pegawai',$id_pegawai);
			$this->db->update("pegawai",array($field=>$id_riwayat));
		}
		if ($delete!=null && $delete==1 && !empty($field)){
			$this->db->where('id_pegawai',$id_pegawai);
			$this->db->where($field,$id);
			$q=$this->db->get('pegawai');
			$rs = $q->result();
			if (!empty($rs)){
				$this->db->where('id_pegawai',$id_pegawai);
				$this->db->update("pegawai",array($field=>0));
			}
		}
	}
	public function get_riwayat_penataran($id_pegawai,$status=null)
		{
			$this->db->select("
				riwayat_penataran.id,
				riwayat_penataran.id_pegawai,
				riwayat_penataran.id_penataran,
				riwayat_penataran.nama_riwayat_penataran,
				riwayat_penataran.tempat,
				riwayat_penataran.angkatan,
				riwayat_penataran.tgl_mulai_penataran,
				riwayat_penataran.tgl_akhir_penataran,
				riwayat_penataran.jam_penataran,
				riwayat_penataran.nomer_stpl,
				riwayat_penataran.tgl_stpl,
				riwayat_penataran.penyelenggara,
				riwayat_penataran.status,
				riwayat_penataran.berkas,
				riwayat_penataran.verifikasi_pegawai, riwayat_penataran.tgl_verifikasi_pegawai,
				riwayat_penataran.verifikasi_bkd, riwayat_penataran.tgl_verifikasi_bkd,
				riwayat_penataran.catatan_verifikasi, riwayat_penataran.tgl_catatan_verifikasi,
				ref_penataran.nama_penataran
			");
			$this->db->join('ref_penataran','ref_penataran.id_penataran = riwayat_penataran.id_penataran','left');
			$this->db->where('riwayat_penataran.id_pegawai',$id_pegawai);
			if ($status!=null) $this->db->where('riwayat_penataran.status',$status);
			$this->db->order_by('riwayat_penataran.id','DESC');
			$query=$this->db->get('riwayat_penataran');
			return $query->result();
		}
	public function get_verif_bkd_riwayat_penataran($id_pegawai,$status=null)
		{
			$this->db->select("
				riwayat_penataran.id,
				riwayat_penataran.id_pegawai,
				riwayat_penataran.id_penataran,
				riwayat_penataran.nama_riwayat_penataran,
				riwayat_penataran.tempat,
				riwayat_penataran.angkatan,
				riwayat_penataran.tgl_mulai_penataran,
				riwayat_penataran.tgl_akhir_penataran,
				riwayat_penataran.jam_penataran,
				riwayat_penataran.nomer_stpl,
				riwayat_penataran.tgl_stpl,
				riwayat_penataran.penyelenggara,
				riwayat_penataran.status,
				riwayat_penataran.berkas,
				riwayat_penataran.verifikasi_pegawai, riwayat_penataran.tgl_verifikasi_pegawai,
				riwayat_penataran.verifikasi_bkd, riwayat_penataran.tgl_verifikasi_bkd,
				ref_penataran.nama_penataran
			");
			$this->db->join('ref_penataran','ref_penataran.id_penataran = riwayat_penataran.id_penataran','left');
			$this->db->where('riwayat_penataran.verifikasi_bkd IS NOT NULL');
			$this->db->where('riwayat_penataran.id_pegawai',$id_pegawai);
			if ($status!=null) $this->db->where('riwayat_penataran.status',$status);
			$this->db->order_by('riwayat_penataran.id','DESC');
			$query=$this->db->get('riwayat_penataran');
			return $query->result();
		}

		public function get_riwayat_seminar($id_pegawai,$status=null)
		{
			$this->db->select("
				riwayat_seminar.id,
				riwayat_seminar.id_pegawai,
				riwayat_seminar.id_jenisseminar,
				riwayat_seminar.nama_riwayat_seminar,
				riwayat_seminar.tempat,
				riwayat_seminar.angkatan,
				riwayat_seminar.tgl_mulai_seminar,
				riwayat_seminar.tgl_akhir_seminar,
				riwayat_seminar.jam_seminar,
				riwayat_seminar.nomer_stpl,
				riwayat_seminar.tgl_stpl,
				riwayat_seminar.penyelenggara,
				riwayat_seminar.status,
				riwayat_seminar.berkas,
				riwayat_seminar.verifikasi_pegawai, riwayat_seminar.tgl_verifikasi_pegawai,
				riwayat_seminar.verifikasi_bkd, riwayat_seminar.tgl_verifikasi_bkd,
				riwayat_seminar.catatan_verifikasi, riwayat_seminar.tgl_catatan_verifikasi,
				ref_jenisseminar.nama_jenisseminar
			");
			$this->db->join('ref_jenisseminar','ref_jenisseminar.id_jenisseminar = riwayat_seminar.id_jenisseminar','left');
			$this->db->where('riwayat_seminar.id_pegawai',$id_pegawai);
			if ($status!=null) $this->db->where('riwayat_seminar.status',$status);
			$this->db->order_by('riwayat_seminar.id','DESC');
			$query=$this->db->get('riwayat_seminar');
			return $query->result();
		}
		public function get_verif_bkd_riwayat_seminar($id_pegawai,$status=null)
		{
			$this->db->select("
				riwayat_seminar.id,
				riwayat_seminar.id_pegawai,
				riwayat_seminar.id_jenisseminar,
				riwayat_seminar.nama_riwayat_seminar,
				riwayat_seminar.tempat,
				riwayat_seminar.angkatan,
				riwayat_seminar.tgl_mulai_seminar,
				riwayat_seminar.tgl_akhir_seminar,
				riwayat_seminar.jam_seminar,
				riwayat_seminar.nomer_stpl,
				riwayat_seminar.tgl_stpl,
				riwayat_seminar.penyelenggara,
				riwayat_seminar.status,
				riwayat_seminar.berkas,
				riwayat_seminar.verifikasi_pegawai, riwayat_seminar.tgl_verifikasi_pegawai,
				riwayat_seminar.verifikasi_bkd, riwayat_seminar.tgl_verifikasi_bkd,
				ref_jenisseminar.nama_jenisseminar
			");
			$this->db->join('ref_jenisseminar','ref_jenisseminar.id_jenisseminar = riwayat_seminar.id_jenisseminar','left');
			$this->db->where('riwayat_seminar.verifikasi_bkd IS NOT NULL');
			$this->db->where('riwayat_seminar.id_pegawai',$id_pegawai);
			if ($status!=null) $this->db->where('riwayat_seminar.status',$status);
			$this->db->order_by('riwayat_seminar.id','DESC');
			$query=$this->db->get('riwayat_seminar');
			return $query->result();
		}

		public function get_riwayat_bahasa($id_pegawai,$status=null)
		{
			$this->db->select("
				riwayat_bahasa.id,
				riwayat_bahasa.id_pegawai,
				riwayat_bahasa.id_bahasa,
				riwayat_bahasa.kemampuan,
				riwayat_bahasa.status,
				riwayat_bahasa.berkas,
				riwayat_bahasa.verifikasi_pegawai, riwayat_bahasa.tgl_verifikasi_pegawai,
				riwayat_bahasa.verifikasi_bkd, riwayat_bahasa.tgl_verifikasi_bkd,
				riwayat_bahasa.catatan_verifikasi, riwayat_bahasa.tgl_catatan_verifikasi,
				ref_bahasa.nama_bahasa
			");
			$this->db->join('ref_bahasa','ref_bahasa.id_bahasa = riwayat_bahasa.id_bahasa','left');
			$this->db->where('riwayat_bahasa.id_pegawai',$id_pegawai);
			if ($status!=null) $this->db->where('riwayat_bahasa.status',$status);
			$this->db->order_by('riwayat_bahasa.id','DESC');
			$query=$this->db->get('riwayat_bahasa');
			return $query->result();
		}
		public function get_verif_bkd_riwayat_bahasa($id_pegawai,$status=null)
		{
			$this->db->select("
				riwayat_bahasa.id,
				riwayat_bahasa.id_pegawai,
				riwayat_bahasa.id_bahasa,
				riwayat_bahasa.kemampuan,
				riwayat_bahasa.status,
				riwayat_bahasa.berkas,
				riwayat_bahasa.verifikasi_pegawai, riwayat_bahasa.tgl_verifikasi_pegawai,
				riwayat_bahasa.verifikasi_bkd, riwayat_bahasa.tgl_verifikasi_bkd,
				ref_bahasa.nama_bahasa
			");
			$this->db->join('ref_bahasa','ref_bahasa.id_bahasa = riwayat_bahasa.id_bahasa','left');
			$this->db->where('riwayat_bahasa.verifikasi_bkd IS NOT NULL');
			$this->db->where('riwayat_bahasa.id_pegawai',$id_pegawai);
			if ($status!=null) $this->db->where('riwayat_bahasa.status',$status);
			$this->db->order_by('riwayat_bahasa.id','DESC');
			$query=$this->db->get('riwayat_bahasa');
			return $query->result();
		}


	public function get_riwayat_bahasa_asing($id_pegawai,$status=null)
		{
			$this->db->select("
				riwayat_bahasa_asing.id,
				riwayat_bahasa_asing.id_pegawai,
				riwayat_bahasa_asing.id_bahasa_asing,
				riwayat_bahasa_asing.kemampuan,
				riwayat_bahasa_asing.status,
				riwayat_bahasa_asing.berkas,
				riwayat_bahasa_asing.verifikasi_pegawai, riwayat_bahasa_asing.tgl_verifikasi_pegawai,
				riwayat_bahasa_asing.verifikasi_bkd, riwayat_bahasa_asing.tgl_verifikasi_bkd,
				riwayat_bahasa_asing.catatan_verifikasi, riwayat_bahasa_asing.tgl_catatan_verifikasi,
				ref_bahasa_asing.nama_bahasa_asing
			");
			$this->db->join('ref_bahasa_asing','ref_bahasa_asing.id_bahasa_asing = riwayat_bahasa_asing.id_bahasa_asing','left');
			$this->db->where('riwayat_bahasa_asing.id_pegawai',$id_pegawai);
			if ($status!=null) $this->db->where('riwayat_bahasa_asing.status',$status);
			$this->db->order_by('riwayat_bahasa_asing.id','DESC');
			$query=$this->db->get('riwayat_bahasa_asing');
			return $query->result();
		}
	public function get_verif_bkd_riwayat_bahasa_asing($id_pegawai,$status=null)
		{
			$this->db->select("
				riwayat_bahasa_asing.id,
				riwayat_bahasa_asing.id_pegawai,
				riwayat_bahasa_asing.id_bahasa_asing,
				riwayat_bahasa_asing.kemampuan,
				riwayat_bahasa_asing.status,
				riwayat_bahasa_asing.berkas,
				riwayat_bahasa_asing.verifikasi_pegawai, riwayat_bahasa_asing.tgl_verifikasi_pegawai,
				riwayat_bahasa_asing.verifikasi_bkd, riwayat_bahasa_asing.tgl_verifikasi_bkd,
				ref_bahasa_asing.nama_bahasa_asing
			");
			$this->db->join('ref_bahasa_asing','ref_bahasa_asing.id_bahasa_asing = riwayat_bahasa_asing.id_bahasa_asing','left');
			$this->db->where('riwayat_bahasa_asing.verifikasi_bkd IS NOT NULL');
			$this->db->where('riwayat_bahasa_asing.id_pegawai',$id_pegawai);
			if ($status!=null) $this->db->where('riwayat_bahasa_asing.status',$status);
			$this->db->order_by('riwayat_bahasa_asing.id','DESC');
			$query=$this->db->get('riwayat_bahasa_asing');
			return $query->result();
		}
		public function get_riwayat_penugasan($id_pegawai,$status=null)
		{
			$this->db->select("
				riwayat_penugasan.id,
				riwayat_penugasan.id_pegawai,
				riwayat_penugasan.id_jenispenugasan,
				riwayat_penugasan.tempat,
				riwayat_penugasan.tgl_mulai_penugasan,
				riwayat_penugasan.tgl_akhir_penugasan,
				riwayat_penugasan.nomer_sk,
				riwayat_penugasan.pejabat_penetap,
				riwayat_penugasan.tgl_sk,
				riwayat_penugasan.status,
				riwayat_penugasan.berkas,
				riwayat_penugasan.verifikasi_pegawai, riwayat_penugasan.tgl_verifikasi_pegawai,
				riwayat_penugasan.verifikasi_bkd, riwayat_penugasan.tgl_verifikasi_bkd,
				riwayat_penugasan.catatan_verifikasi, riwayat_penugasan.tgl_catatan_verifikasi,
				ref_jenispenugasan.nama_jenispenugasan
			");
			$this->db->join('ref_jenispenugasan','ref_jenispenugasan.id_jenispenugasan = riwayat_penugasan.id_jenispenugasan','left');
			$this->db->where('riwayat_penugasan.id_pegawai',$id_pegawai);
			if ($status!=null) $this->db->where('riwayat_penugasan.status',$status);
			$this->db->order_by('riwayat_penugasan.id','DESC');
			$query=$this->db->get('riwayat_penugasan');
			return $query->result();
		}
		public function get_verif_bkd_riwayat_penugasan($id_pegawai,$status=null)
		{
			$this->db->select("
				riwayat_penugasan.id,
				riwayat_penugasan.id_pegawai,
				riwayat_penugasan.id_jenispenugasan,
				riwayat_penugasan.tempat,
				riwayat_penugasan.tgl_mulai_penugasan,
				riwayat_penugasan.tgl_akhir_penugasan,
				riwayat_penugasan.nomer_sk,
				riwayat_penugasan.pejabat_penetap,
				riwayat_penugasan.tgl_sk,
				riwayat_penugasan.status,
				riwayat_penugasan.berkas,
				riwayat_penugasan.verifikasi_pegawai, riwayat_penugasan.tgl_verifikasi_pegawai,
				riwayat_penugasan.verifikasi_bkd, riwayat_penugasan.tgl_verifikasi_bkd,
				ref_jenispenugasan.nama_jenispenugasan
			");
			$this->db->join('ref_jenispenugasan','ref_jenispenugasan.id_jenispenugasan = riwayat_penugasan.id_jenispenugasan','left');
			$this->db->where('riwayat_penugasan.verifikasi_bkd IS NOT NULL');
			$this->db->where('riwayat_penugasan.id_pegawai',$id_pegawai);
			if ($status!=null) $this->db->where('riwayat_penugasan.status',$status);
			$this->db->order_by('riwayat_penugasan.id','DESC');
			$query=$this->db->get('riwayat_penugasan');
			return $query->result();
		}
		public function get_riwayat_hukuman($id_pegawai,$status=null)
			{
				$this->db->select("
					riwayat_hukuman.id,
					riwayat_hukuman.id_pegawai,
					riwayat_hukuman.id_jenishukuman,
					riwayat_hukuman.keterangan,
					riwayat_hukuman.tgl_mulai_hukuman,
					riwayat_hukuman.tgl_akhir_hukuman,
					riwayat_hukuman.nomer_sk,
					riwayat_hukuman.pejabat_penetap,
					riwayat_hukuman.tgl_sk,
					riwayat_hukuman.status,
					riwayat_hukuman.berkas,
					riwayat_hukuman.verifikasi_pegawai, riwayat_hukuman.tgl_verifikasi_pegawai,
					riwayat_hukuman.verifikasi_bkd, riwayat_hukuman.tgl_verifikasi_bkd,
					riwayat_hukuman.catatan_verifikasi, riwayat_hukuman.tgl_catatan_verifikasi,
					ref_jenishukuman.nama_jenishukuman
				");
				$this->db->join('ref_jenishukuman','ref_jenishukuman.id_jenishukuman = riwayat_hukuman.id_jenishukuman','left');
				$this->db->where('riwayat_hukuman.id_pegawai',$id_pegawai);
				if ($status!=null) $this->db->where('riwayat_hukuman.status',$status);
				$this->db->order_by('riwayat_hukuman.id','DESC');
				$query=$this->db->get('riwayat_hukuman');
				return $query->result();
			}
		public function get_verif_bkd_riwayat_hukuman($id_pegawai,$status=null)
			{
				$this->db->select("
					riwayat_hukuman.id,
					riwayat_hukuman.id_pegawai,
					riwayat_hukuman.id_jenishukuman,
					riwayat_hukuman.keterangan,
					riwayat_hukuman.tgl_mulai_hukuman,
					riwayat_hukuman.tgl_akhir_hukuman,
					riwayat_hukuman.nomer_sk,
					riwayat_hukuman.pejabat_penetap,
					riwayat_hukuman.tgl_sk,
					riwayat_hukuman.status,
					riwayat_hukuman.berkas,
					riwayat_hukuman.verifikasi_pegawai, riwayat_hukuman.tgl_verifikasi_pegawai,
					riwayat_hukuman.verifikasi_bkd, riwayat_hukuman.tgl_verifikasi_bkd,
					ref_jenishukuman.nama_jenishukuman
				");
				$this->db->join('ref_jenishukuman','ref_jenishukuman.id_jenishukuman = riwayat_hukuman.id_jenishukuman','left');
				$this->db->where('riwayat_hukuman.verifikasi_bkd IS NOT NULL');
				$this->db->where('riwayat_hukuman.id_pegawai',$id_pegawai);
				if ($status!=null) $this->db->where('riwayat_hukuman.status',$status);
				$this->db->order_by('riwayat_hukuman.id','DESC');
				$query=$this->db->get('riwayat_hukuman');
				return $query->result();
			}
			public function get_riwayat_pernikahan($id_pegawai,$status=null)
			{
				$this->db->select("
					riwayat_pernikahan.id,
					riwayat_pernikahan.id_pegawai,
					riwayat_pernikahan.nama,
					riwayat_pernikahan.tempat_lahir,
					riwayat_pernikahan.tgl_lahir,
					riwayat_pernikahan.tgl_menikah,
					riwayat_pernikahan.pekerjaan,
					riwayat_pernikahan.keterangan,
					riwayat_pernikahan.status,
					riwayat_pernikahan.berkas,
					riwayat_pernikahan.verifikasi_pegawai, riwayat_pernikahan.tgl_verifikasi_pegawai,
					riwayat_pernikahan.verifikasi_bkd, riwayat_pernikahan.tgl_verifikasi_bkd,
					riwayat_pernikahan.catatan_verifikasi, riwayat_pernikahan.tgl_catatan_verifikasi,
					ref_jenjangpendidikan.nama_jenjangpendidikan
				");
				$this->db->join('ref_jenjangpendidikan','ref_jenjangpendidikan.id_jenjangpendidikan = riwayat_pernikahan.id_jenjangpendidikan','left');
				$this->db->where('riwayat_pernikahan.id_pegawai',$id_pegawai);
				if ($status!=null) $this->db->where('riwayat_pernikahan.status',$status);
				$this->db->order_by('riwayat_pernikahan.id','DESC');
				$query=$this->db->get('riwayat_pernikahan');
				return $query->result();
			}
			public function get_verif_bkd_riwayat_pernikahan($id_pegawai,$status=null)
			{
				$this->db->select("
					riwayat_pernikahan.id,
					riwayat_pernikahan.id_pegawai,
					riwayat_pernikahan.nama,
					riwayat_pernikahan.tempat_lahir,
					riwayat_pernikahan.tgl_lahir,
					riwayat_pernikahan.tgl_menikah,
					riwayat_pernikahan.pekerjaan,
					riwayat_pernikahan.keterangan,
					riwayat_pernikahan.status,
					riwayat_pernikahan.berkas,
					riwayat_pernikahan.verifikasi_pegawai, riwayat_pernikahan.tgl_verifikasi_pegawai,
					riwayat_pernikahan.verifikasi_bkd, riwayat_pernikahan.tgl_verifikasi_bkd,
					ref_jenjangpendidikan.nama_jenjangpendidikan
				");
				$this->db->join('ref_jenjangpendidikan','ref_jenjangpendidikan.id_jenjangpendidikan = riwayat_pernikahan.id_jenjangpendidikan','left');
				$this->db->where('riwayat_pernikahan.verifikasi_bkd IS NOT NULL');
				$this->db->where('riwayat_pernikahan.id_pegawai',$id_pegawai);
				if ($status!=null) $this->db->where('riwayat_pernikahan.status',$status);
				$this->db->order_by('riwayat_pernikahan.id','DESC');
				$query=$this->db->get('riwayat_pernikahan');
				return $query->result();
			}

			public function get_riwayat_anak($id_pegawai,$status=null)
			{
				$this->db->select("
					riwayat_anak.id,
					riwayat_anak.id_pegawai,
					riwayat_anak.nama,
					riwayat_anak.tempat_lahir,
					riwayat_anak.tgl_lahir,
					riwayat_anak.jenis_kelamin,
					riwayat_anak.pekerjaan,
					riwayat_anak.keterangan,
					riwayat_anak.status,
					riwayat_anak.berkas,
					riwayat_anak.verifikasi_pegawai, riwayat_anak.tgl_verifikasi_pegawai,
					riwayat_anak.verifikasi_bkd, riwayat_anak.tgl_verifikasi_bkd,
					riwayat_anak.catatan_verifikasi, riwayat_anak.tgl_catatan_verifikasi,
					ref_jenjangpendidikan.nama_jenjangpendidikan
				");
				$this->db->join('ref_jenjangpendidikan','ref_jenjangpendidikan.id_jenjangpendidikan = riwayat_anak.id_jenjangpendidikan','left');
				$this->db->where('riwayat_anak.id_pegawai',$id_pegawai);
				if ($status!=null) $this->db->where('riwayat_anak.status',$status);
				$this->db->order_by('riwayat_anak.id','DESC');
				$query=$this->db->get('riwayat_anak');
				return $query->result();
			}
			public function get_verif_bkd_riwayat_anak($id_pegawai,$status=null)
			{
				$this->db->select("
					riwayat_anak.id,
					riwayat_anak.id_pegawai,
					riwayat_anak.nama,
					riwayat_anak.tempat_lahir,
					riwayat_anak.tgl_lahir,
					riwayat_anak.jenis_kelamin,
					riwayat_anak.pekerjaan,
					riwayat_anak.keterangan,
					riwayat_anak.status,
					riwayat_anak.berkas,
					riwayat_anak.verifikasi_pegawai, riwayat_anak.tgl_verifikasi_pegawai,
					riwayat_anak.verifikasi_bkd, riwayat_anak.tgl_verifikasi_bkd,
					ref_jenjangpendidikan.nama_jenjangpendidikan
				");
				$this->db->join('ref_jenjangpendidikan','ref_jenjangpendidikan.id_jenjangpendidikan = riwayat_anak.id_jenjangpendidikan','left');
				$this->db->where('riwayat_anak.verifikasi_bkd IS NOT NULL');
				$this->db->where('riwayat_anak.id_pegawai',$id_pegawai);
				if ($status!=null) $this->db->where('riwayat_anak.status',$status);
				$this->db->order_by('riwayat_anak.id','DESC');
				$query=$this->db->get('riwayat_anak');
				return $query->result();
			}

			public function get_riwayat_orangtua($id_pegawai,$status=null)
			{
				$this->db->select("
					riwayat_orangtua.id,
					riwayat_orangtua.id_pegawai,
					riwayat_orangtua.nama,
					riwayat_orangtua.tempat_lahir,
					riwayat_orangtua.tgl_lahir,
					riwayat_orangtua.jenis_kelamin,
					riwayat_orangtua.pekerjaan,
					riwayat_orangtua.keterangan,
					riwayat_orangtua.status,
					riwayat_orangtua.berkas,
					riwayat_orangtua.verifikasi_pegawai, riwayat_orangtua.tgl_verifikasi_pegawai,
					riwayat_orangtua.verifikasi_bkd, riwayat_orangtua.tgl_verifikasi_bkd,
					riwayat_orangtua.catatan_verifikasi, riwayat_orangtua.tgl_catatan_verifikasi,
					ref_jenjangpendidikan.nama_jenjangpendidikan
				");
				$this->db->join('ref_jenjangpendidikan','ref_jenjangpendidikan.id_jenjangpendidikan = riwayat_orangtua.id_jenjangpendidikan','left');
				$this->db->where('riwayat_orangtua.id_pegawai',$id_pegawai);
				if ($status!=null) $this->db->where('riwayat_orangtua.status',$status);
				$this->db->order_by('riwayat_orangtua.id','DESC');
				$query=$this->db->get('riwayat_orangtua');
				return $query->result();
			}
			public function get_verif_bkd_riwayat_orangtua($id_pegawai,$status=null)
			{
				$this->db->select("
					riwayat_orangtua.id,
					riwayat_orangtua.id_pegawai,
					riwayat_orangtua.nama,
					riwayat_orangtua.tempat_lahir,
					riwayat_orangtua.tgl_lahir,
					riwayat_orangtua.jenis_kelamin,
					riwayat_orangtua.pekerjaan,
					riwayat_orangtua.keterangan,
					riwayat_orangtua.status,
					riwayat_orangtua.berkas,
					riwayat_orangtua.verifikasi_pegawai, riwayat_orangtua.tgl_verifikasi_pegawai,
					riwayat_orangtua.verifikasi_bkd, riwayat_orangtua.tgl_verifikasi_bkd,
					ref_jenjangpendidikan.nama_jenjangpendidikan
				");
				$this->db->join('ref_jenjangpendidikan','ref_jenjangpendidikan.id_jenjangpendidikan = riwayat_orangtua.id_jenjangpendidikan','left');
				$this->db->where('riwayat_orangtua.verifikasi_bkd IS NOT NULL');
				$this->db->where('riwayat_orangtua.id_pegawai',$id_pegawai);
				if ($status!=null) $this->db->where('riwayat_orangtua.status',$status);
				$this->db->order_by('riwayat_orangtua.id','DESC');
				$query=$this->db->get('riwayat_orangtua');
				return $query->result();
			}

			public function get_riwayat_mertua($id_pegawai,$status=null)
			{
				$this->db->select("
					riwayat_mertua.id,
					riwayat_mertua.id_pegawai,
					riwayat_mertua.nama,
					riwayat_mertua.tempat_lahir,
					riwayat_mertua.tgl_lahir,
					riwayat_mertua.jenis_kelamin,
					riwayat_mertua.pekerjaan,
					riwayat_mertua.keterangan,
					riwayat_mertua.status,
					riwayat_mertua.berkas,
					riwayat_mertua.verifikasi_pegawai, riwayat_mertua.tgl_verifikasi_pegawai,
					riwayat_mertua.verifikasi_bkd, riwayat_mertua.tgl_verifikasi_bkd,
					riwayat_mertua.catatan_verifikasi, riwayat_mertua.tgl_catatan_verifikasi,
					ref_jenjangpendidikan.nama_jenjangpendidikan
				");
				$this->db->join('ref_jenjangpendidikan','ref_jenjangpendidikan.id_jenjangpendidikan = riwayat_mertua.id_jenjangpendidikan','left');
				$this->db->where('riwayat_mertua.id_pegawai',$id_pegawai);
				if ($status!=null) $this->db->where('riwayat_mertua.status',$status);
				$this->db->order_by('riwayat_mertua.id','DESC');
				$query=$this->db->get('riwayat_mertua');
				return $query->result();
			}
			public function get_verif_bkd_riwayat_mertua($id_pegawai,$status=null)
			{
				$this->db->select("
					riwayat_mertua.id,
					riwayat_mertua.id_pegawai,
					riwayat_mertua.nama,
					riwayat_mertua.tempat_lahir,
					riwayat_mertua.tgl_lahir,
					riwayat_mertua.jenis_kelamin,
					riwayat_mertua.pekerjaan,
					riwayat_mertua.keterangan,
					riwayat_mertua.status,
					riwayat_mertua.berkas,
					riwayat_mertua.verifikasi_pegawai, riwayat_mertua.tgl_verifikasi_pegawai,
					riwayat_mertua.verifikasi_bkd, riwayat_mertua.tgl_verifikasi_bkd,
					ref_jenjangpendidikan.nama_jenjangpendidikan
				");
				$this->db->join('ref_jenjangpendidikan','ref_jenjangpendidikan.id_jenjangpendidikan = riwayat_mertua.id_jenjangpendidikan','left');
				$this->db->where('riwayat_mertua.verifikasi_bkd IS NOT NULL');
				$this->db->where('riwayat_mertua.id_pegawai',$id_pegawai);
				if ($status!=null) $this->db->where('riwayat_mertua.status',$status);
				$this->db->order_by('riwayat_mertua.id','DESC');
				$query=$this->db->get('riwayat_mertua');
				return $query->result();
			}
			public function get_jenisbahasa()
			{
				$this->db->where('status','Y');
				$query = $this->db->get('ref_bahasa');
				return $query->result();
			}
			public function get_jenisbahasa_asing()
			{
				$this->db->where('status','Y');
				$query = $this->db->get('ref_bahasa_asing');
				return $query->result();
			}
		public function get_riwayat_kursus($id_pegawai,$status=null)
		{
			$this->db->select("
				riwayat_kursus.id,
				riwayat_kursus.id_pegawai,
				riwayat_kursus.id_kursus,
				riwayat_kursus.nama_riwayat_kursus,
				riwayat_kursus.tempat,
				riwayat_kursus.angkatan,
				riwayat_kursus.tgl_mulai_kursus,
				riwayat_kursus.tgl_akhir_kursus,
				riwayat_kursus.jam_kursus,
				riwayat_kursus.nomer_stpl,
				riwayat_kursus.tgl_stpl,
				riwayat_kursus.penyelenggara,
				riwayat_kursus.status,
				riwayat_kursus.berkas,
				riwayat_kursus.verifikasi_pegawai, riwayat_kursus.tgl_verifikasi_pegawai,
				riwayat_kursus.verifikasi_bkd, riwayat_kursus.tgl_verifikasi_bkd,
				riwayat_kursus.catatan_verifikasi, riwayat_kursus.tgl_catatan_verifikasi,
				ref_kursus.nama_kursus
			");
			$this->db->join('ref_kursus','ref_kursus.id_kursus = riwayat_kursus.id_kursus','left');
			$this->db->where('riwayat_kursus.id_pegawai',$id_pegawai);
			if ($status!=null) $this->db->where('riwayat_kursus.status',$status);
			$this->db->order_by('riwayat_kursus.id','DESC');
			$query=$this->db->get('riwayat_kursus');
			return $query->result();
		}
		public function get_verif_bkd_riwayat_kursus($id_pegawai,$status=null)
		{
			$this->db->select("
				riwayat_kursus.id,
				riwayat_kursus.id_pegawai,
				riwayat_kursus.id_kursus,
				riwayat_kursus.nama_riwayat_kursus,
				riwayat_kursus.tempat,
				riwayat_kursus.angkatan,
				riwayat_kursus.tgl_mulai_kursus,
				riwayat_kursus.tgl_akhir_kursus,
				riwayat_kursus.jam_kursus,
				riwayat_kursus.nomer_stpl,
				riwayat_kursus.tgl_stpl,
				riwayat_kursus.penyelenggara,
				riwayat_kursus.status,
				riwayat_kursus.berkas,
				riwayat_kursus.verifikasi_pegawai, riwayat_kursus.tgl_verifikasi_pegawai,
				riwayat_kursus.verifikasi_bkd, riwayat_kursus.tgl_verifikasi_bkd,
				ref_kursus.nama_kursus
			");
			$this->db->join('ref_kursus','ref_kursus.id_kursus = riwayat_kursus.id_kursus','left');
			$this->db->where('riwayat_kursus.verifikasi_bkd IS NOT NULL');
			$this->db->where('riwayat_kursus.id_pegawai',$id_pegawai);
			if ($status!=null) $this->db->where('riwayat_kursus.status',$status);
			$this->db->order_by('riwayat_kursus.id','DESC');
			$query=$this->db->get('riwayat_kursus');
			return $query->result();
		}

	public function delete_riwayat($table,$id,$berkas)
	{
		$this->update_riwayat_terakhir($table,$id,1);
		$this->db->where('id',$id);
		$this->db->delete($table);
		if ($berkas!=""){
			unlink('./data/upload_berkas/'.$berkas);
		}

	}
	public function updateBerkasRiwayat($table,$id,$berkas)
	{
		$this->db->set('berkas',$berkas);
		$this->db->where('id',$id);
		$this->db->update("riwayat_".$table);
	}

	public function getPegawaiByJabatan($id_jabatan){
		// $this->db->where('riwayat_jabatan.status',1);
		$this->db->where('pegawai.id_jabatan',$id_jabatan);
		//$this->db->join('riwayat_jabatan','pegawai.id_pegawai = riwayat_jabatan.id_pegawai');
		$query = $this->db->get('pegawai');
		return $query->row();
	}

	public function delete_pegawai($id_pegawai){
		$this->db->where('id_pegawai',$id_pegawai);
		$this->db->delete('pegawai');
		$this->db->where('id_pegawai',$id_pegawai);
		$this->db->delete('user');
	}

	public function getData($param=null)
	{
		if($param!=null)
		{
			foreach ($param as $key => $value) {
				$this->db->where($key,$value);
			}
		}
		$this->db->join('ref_jabatan','ref_jabatan.id_jabatan = pegawai.id_jabatan','left');
		$query = $this->db->get("pegawai");
		return $query->result();
	}

	public function get_eselon(){
		$query = $this->db->get('ref_eselon');
		return $query->result();
	}
	public function get_gelardepan(){
		$query = $this->db->get('ref_gelardepan');
		return $query->result();
	}
	public function get_gelarbelakang(){
		$query = $this->db->get('ref_gelarbelakang');
		return $query->result();
	}
	public function get_agama(){
		$query = $this->db->get('ref_agama');
		return $query->result();
	}
	public function get_provinsi(){
		$query = $this->db->get('provinsi');
		return $query->result();
	}
	public function get_kabupaten(){
		$query = $this->db->get('kabupaten');
		return $query->result();
	}
	public function get_kecamatan(){
		$query = $this->db->get('kecamatan');
		return $query->result();
	}
	public function get_desa(){
		$query = $this->db->get('desa');
		return $query->result();
	}
	public function get_statusmenikah(){
		$query = $this->db->get('ref_statusmenikah');
		return $query->result();
	}

	public function get_data_pegawai_by_id($id_pegawai){
		$this->db->select("
		master_pegawai.id_pegawai,
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
	}

	public function get_ss_by_unit_kerja($id_unit_kerja, $tahun){
		$this->db->select('
		iku_ss_renstra.iku_ss_renstra, iku_ss_renja.target_ss_renja, iku_ss_renja.realisasi_ss_renja, iku_ss_renstra.polorarisasi
		');
		$this->db->join('iku_ss_renja', 'iku_ss_renja.id_iku_ss_renstra = iku_ss_renstra.id_iku_ss_renstra');
		$this->db->where('id_unit_kerja', $id_unit_kerja);
		$this->db->where('tahun_renja', $tahun);
		return $this->db->get('iku_ss_renstra')->result();
	}

	public function get_sp_by_unit_kerja($id_unit_kerja, $tahun){
		$this->db->select('
		iku_sp_renstra.iku_sp_renstra, iku_sp_renja.target_sp_renja, iku_sp_renja.realisasi_sp_renja, iku_sp_renstra.polorarisasi
		');
		$this->db->join('iku_sp_renja', 'iku_sp_renja.id_iku_sp_renstra = iku_sp_renstra.id_iku_sp_renstra');
		$this->db->where('id_unit_kerja', $id_unit_kerja);
		$this->db->where('tahun_renja', $tahun);
		return $this->db->get('iku_sp_renstra')->result();
	}

	public function get_sk_by_unit_kerja($id_unit_kerja, $tahun){
		$this->db->select('
		iku_sk_renstra.iku_sk_renstra, iku_sk_renja.target_sk_renja, iku_sk_renja.realisasi_sk_renja, iku_sk_renstra.polorarisasi
		');
		$this->db->join('iku_sk_renja', 'iku_sk_renja.id_iku_sk_renstra = iku_sk_renstra.id_iku_sk_renstra');
		$this->db->where('id_unit_kerja', $id_unit_kerja);
		$this->db->where('tahun_renja', $tahun);
		return $this->db->get('iku_sk_renstra')->result();
	}

	//

	public function get_pegawai($param)
	{
		if(isset($param['where']))
		{
			$this->db->where($param['where']);
		}

		$this->db->where("pegawai.pensiun",0);

		if(isset($param['search']))
        {
            $this->db->where("(
				pegawai.nama_lengkap like '%".$param['search']."%' OR
				pegawai.nip like '%".$param['search']."%' OR
				jabatan.nama_jabatan like '%".$param['search']."%' OR
				skpd.nama_skpd like '%".$param['search']."%' OR
				skpd.nama_skpd_alias like '%".$param['search']."%' 
			)");
        }

		if(isset($param['limit']) && isset($param['offset']))
        {
            $this->db->limit($param['limit'],$param['offset']);
        }

		$this->db->join('ref_skpd skpd', 'skpd.id_skpd = pegawai.id_skpd','left');
		//$this->db->join('master_pegawai', 'master_pegawai.nip_baru = pegawai.nip','left');
		$this->db->join('ref_unit_kerja unit_kerja', 'unit_kerja.id_unit_kerja = pegawai.id_unit_kerja', 'left');
		$this->db->join('ref_jabatan_baru jabatan', 'jabatan.id_jabatan = pegawai.id_jabatan', 'left');
		

        

		$foto_url = base_url()."data/foto/pegawai/";

		$this->db->select("pegawai.*,
			case 
				WHEN pegawai.foto_pegawai = '' THEN concat('".$foto_url."','user-default.png')
				else concat('".$foto_url."',pegawai.foto_pegawai)
			end	 as 'link_foto_pegawai',
			skpd.nama_skpd, skpd.nama_skpd_alias,
			unit_kerja.nama_unit_kerja,
			jabatan.nama_jabatan,
			
		");

		$rs = $this->db->get("pegawai");
		return $rs;
	}
}

?>
