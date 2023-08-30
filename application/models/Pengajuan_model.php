<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengajuan_model extends CI_Model
{
	public function insert($table,$data){
		$this->db->insert($table,$data);
	}
	public function update($table,$data,$id){
		$this->db->where("id",$id);
		$this->db->update($table,$data);
	}
	public function get_mutasi($id_pegawai=null,$status=null,$nip=null,$nama=null,$limit=0,$offset=0)
	{
		$this->db->select("
			pengajuan_mutasi.id, pengajuan_mutasi.id_pegawai, pengajuan_mutasi.kd_skpd_awal,
			pengajuan_mutasi.kd_skpd_tujuan, pengajuan_mutasi.tgl_mutasi, pengajuan_mutasi.berkas,
			pengajuan_mutasi.keterangan_berkas, pengajuan_mutasi.keterangan_pengajuan,
			pengajuan_mutasi.status, pengajuan_mutasi.catatan, pengajuan_mutasi.created,
			pengajuan_mutasi.updated, pengajuan_mutasi.createdby, pengajuan_mutasi.updatedby,
			pegawai.nama_lengkap, pegawai.nip_baru,
			skpd_awal.nama_skpd as nama_skpd_awal,
			skpd_tujuan.nama_skpd as nama_skpd_tujuan
		");
		$this->db->join('pegawai','pegawai.id_pegawai = pengajuan_mutasi.id_pegawai','left');
		$this->db->join('skpd as skpd_awal','skpd_awal.kd_skpd = pengajuan_mutasi.kd_skpd_awal','left');
		$this->db->join('skpd skpd_tujuan','skpd_tujuan.kd_skpd = pengajuan_mutasi.kd_skpd_tujuan','left');
		if ($nip!=null && $nama!=null){
			$where = " (pegawai.nip_baru like '%$nip%' ";
			$where .= " AND pegawai.nama_lengkap like '%$nama%' ) ";
			if ($id_pegawai!=null) $where .= "AND pegawai.id_pegawai =$id_pegawai ";
			if ($status!=null) $where .= "AND pengajuan_mutasi.status =$status ";
			$this->db->where($where);
		}
		else if ($nip==null && $nama!=null){
			//$where = " (pegawai.nip_baru like '%$nip%' ";
			$where = " pegawai.nama_lengkap like '%$nama%' ";
			if ($id_pegawai!=null) $where .= "AND pegawai.id_pegawai =$id_pegawai ";
			if ($status!=null) $where .= "AND pengajuan_mutasi.status =$status ";
			$this->db->where($where);
		}
		else if ($nip!=null && $nama==null){
			$where = " pegawai.nip_baru like '%$nip%' ";
			//$where .= " OR pegawai.nama_lengkap like '%$nama%' ) ";
			if ($id_pegawai!=null) $where .= "AND pegawai.id_pegawai =$id_pegawai ";
			if ($status!=null) $where .= "AND pengajuan_mutasi.status =$status ";
			$this->db->where($where);
		}
		else if ($nip==null && $nama==null){
			if ($id_pegawai!=null) $this->db->where('riwayat_pangkat.id_pegawai',$id_pegawai);
			if ($status!=null) $this->db->where('pengajuan_mutasi.status',$status);
		}
		
		if ($limit>0) $this->db->limit($limit,$offset);
		$this->db->order_by('pengajuan_mutasi.created','DESC');
		$query=$this->db->get('pengajuan_mutasi');
		return $query->result();
	}
	public function get_mutasi_by_id($id)
	{
		$this->db->select("
			pengajuan_mutasi.id, pengajuan_mutasi.id_pegawai, pengajuan_mutasi.kd_skpd_awal,
			pengajuan_mutasi.kd_skpd_tujuan, pengajuan_mutasi.tgl_mutasi, pengajuan_mutasi.berkas,
			pengajuan_mutasi.keterangan_berkas, pengajuan_mutasi.keterangan_pengajuan,
			pengajuan_mutasi.status, pengajuan_mutasi.catatan, pengajuan_mutasi.created,
			pengajuan_mutasi.updated, pengajuan_mutasi.createdby, pengajuan_mutasi.updatedby,
			pegawai.nama_lengkap, pegawai.nip_baru,pegawai.id_pegawai,
			skpd_awal.nama_skpd as nama_skpd_awal, skpd_awal.alamat as alamat_skpd_awal,
			skpd_awal.telp as telp_skpd_awal, skpd_awal.email as email_skpd_awal,
			skpd_tujuan.nama_skpd as nama_skpd_tujuan, skpd_tujuan.alamat as alamat_skpd_tujuan,
			skpd_tujuan.telp as telp_skpd_tujuan, skpd_tujuan.email as email_skpd_tujuan
		");
		$this->db->join('pegawai','pegawai.id_pegawai = pengajuan_mutasi.id_pegawai','left');
		$this->db->join('skpd as skpd_awal','skpd_awal.kd_skpd = pengajuan_mutasi.kd_skpd_awal','left');
		$this->db->join('skpd skpd_tujuan','skpd_tujuan.kd_skpd = pengajuan_mutasi.kd_skpd_tujuan','left');
		$this->db->where('pengajuan_mutasi.id',$id);
		$query=$this->db->get('pengajuan_mutasi');
		return $query->result();
	}
	public function get_pensiun($id_pegawai=null,$status=null,$nip=null,$nama=null,$limit=0,$offset=0)
	{
		$this->db->select("
			pengajuan_pensiun.id, pengajuan_pensiun.id_pegawai,
			pengajuan_pensiun.tgl_pensiun, pengajuan_pensiun.berkas,
			pengajuan_pensiun.keterangan_berkas, pengajuan_pensiun.keterangan_pengajuan,
			pengajuan_pensiun.status, pengajuan_pensiun.catatan, pengajuan_pensiun.created,
			pengajuan_pensiun.updated, pengajuan_pensiun.createdby, pengajuan_pensiun.updatedby,
			pegawai.nama_lengkap, pegawai.nip_baru, pegawai.cpns_tmt
		");
		$this->db->join('pegawai','pegawai.id_pegawai = pengajuan_pensiun.id_pegawai','left');
		if ($nip!=null && $nama!=null){
			$where = " (pegawai.nip_baru like '%$nip%' ";
			$where .= " AND pegawai.nama_lengkap like '%$nama%' ) ";
			if ($id_pegawai!=null) $where .= "AND pegawai.id_pegawai =$id_pegawai ";
			if ($status!=null) $where .= "AND pengajuan_pensiun.status =$status ";
			$this->db->where($where);
		}
		else if ($nip==null && $nama!=null){
			//$where = " (pegawai.nip_baru like '%$nip%' ";
			$where = " pegawai.nama_lengkap like '%$nama%' ";
			if ($id_pegawai!=null) $where .= "AND pegawai.id_pegawai =$id_pegawai ";
			if ($status!=null) $where .= "AND pengajuan_pensiun.status =$status ";
			$this->db->where($where);
		}
		else if ($nip!=null && $nama==null){
			$where = " pegawai.nip_baru like '%$nip%' ";
			//$where .= " OR pegawai.nama_lengkap like '%$nama%' ) ";
			if ($id_pegawai!=null) $where .= "AND pegawai.id_pegawai =$id_pegawai ";
			if ($status!=null) $where .= "AND pengajuan_pensiun.status =$status ";
			$this->db->where($where);
		}
		else if ($nip==null && $nama==null){
			if ($id_pegawai!=null) $this->db->where('riwayat_pangkat.id_pegawai',$id_pegawai);
			if ($status!=null) $this->db->where('pengajuan_pensiun.status',$status);
		}
		
		if ($limit>0) $this->db->limit($limit,$offset);
		$this->db->order_by('pengajuan_pensiun.created','DESC');
		$query=$this->db->get('pengajuan_pensiun');
		return $query->result();
	}
	public function get_pensiun_by_id($id)
	{
		$this->db->select("
			pengajuan_pensiun.id, pengajuan_pensiun.id_pegawai,
			pengajuan_pensiun.tgl_pensiun, pengajuan_pensiun.berkas,
			pengajuan_pensiun.keterangan_berkas, pengajuan_pensiun.keterangan_pengajuan,
			pengajuan_pensiun.status, pengajuan_pensiun.catatan, pengajuan_pensiun.created,
			pengajuan_pensiun.updated, pengajuan_pensiun.createdby, pengajuan_pensiun.updatedby,
			pegawai.nama_lengkap, pegawai.nip_baru, pegawai.cpns_tmt
		");
		
		$this->db->join('pegawai','pegawai.id_pegawai = pengajuan_pensiun.id_pegawai','left');
		$this->db->where('id',$id);
		$query=$this->db->get('pengajuan_pensiun');
		return $query->result();
	}
	public function get_hukuman($id_pegawai=null,$status=null,$nip=null,$nama=null,$limit=0,$offset=0)
	{
		$this->db->select("
			pengajuan_hukuman.id, pengajuan_hukuman.id_pegawai,pengajuan_hukuman.id_jenishukuman,
			pengajuan_hukuman.tgl_hukuman, pengajuan_hukuman.berkas, pengajuan_hukuman.tgl_pengajuan,
			pengajuan_hukuman.keterangan_berkas, pengajuan_hukuman.keterangan_pengajuan,
			pengajuan_hukuman.status, pengajuan_hukuman.catatan, pengajuan_hukuman.created,
			pengajuan_hukuman.updated, pengajuan_hukuman.createdby, pengajuan_hukuman.updatedby,
			pegawai.nama_lengkap, pegawai.nip_baru, 
			ref_jenishukuman.nama_jenishukuman
		");
		$this->db->join('pegawai','pegawai.id_pegawai = pengajuan_hukuman.id_pegawai','left');
		$this->db->join('ref_jenishukuman','ref_jenishukuman.id_jenishukuman = pengajuan_hukuman.id_jenishukuman','left');
		if ($nip!=null && $nama!=null){
			$where = " (pegawai.nip_baru like '%$nip%' ";
			$where .= " AND pegawai.nama_lengkap like '%$nama%' ) ";
			if ($id_pegawai!=null) $where .= "AND pegawai.id_pegawai =$id_pegawai ";
			if ($status!=null) $where .= "AND pengajuan_hukuman.status =$status ";
			$this->db->where($where);
		}
		else if ($nip==null && $nama!=null){
			//$where = " (pegawai.nip_baru like '%$nip%' ";
			$where = " pegawai.nama_lengkap like '%$nama%' ";
			if ($id_pegawai!=null) $where .= "AND pegawai.id_pegawai =$id_pegawai ";
			if ($status!=null) $where .= "AND pengajuan_hukuman.status =$status ";
			$this->db->where($where);
		}
		else if ($nip!=null && $nama==null){
			$where = " pegawai.nip_baru like '%$nip%' ";
			//$where .= " OR pegawai.nama_lengkap like '%$nama%' ) ";
			if ($id_pegawai!=null) $where .= "AND pegawai.id_pegawai =$id_pegawai ";
			if ($status!=null) $where .= "AND pengajuan_hukuman.status =$status ";
			$this->db->where($where);
		}
		else if ($nip==null && $nama==null){
			if ($id_pegawai!=null) $this->db->where('riwayat_pangkat.id_pegawai',$id_pegawai);
			if ($status!=null) $this->db->where('pengajuan_hukuman.status',$status);
		}
		
		if ($limit>0) $this->db->limit($limit,$offset);
		$this->db->order_by('pengajuan_hukuman.created','DESC');
		$query=$this->db->get('pengajuan_hukuman');
		return $query->result();
	}
	public function get_hukuman_by_id($id)
	{
		$this->db->select("
			pengajuan_hukuman.id, pengajuan_hukuman.id_pegawai,pengajuan_hukuman.id_jenishukuman,
			pengajuan_hukuman.tgl_hukuman, pengajuan_hukuman.berkas,pengajuan_hukuman.tgl_pengajuan,
			pengajuan_hukuman.keterangan_berkas, pengajuan_hukuman.keterangan_pengajuan,
			pengajuan_hukuman.status, pengajuan_hukuman.catatan, pengajuan_hukuman.created,
			pengajuan_hukuman.updated, pengajuan_hukuman.createdby, pengajuan_hukuman.updatedby,
			pegawai.nama_lengkap, pegawai.nip_baru, 
			ref_jenishukuman.nama_jenishukuman
		");
		$this->db->join('pegawai','pegawai.id_pegawai = pengajuan_hukuman.id_pegawai','left');
		$this->db->join('ref_jenishukuman','ref_jenishukuman.id_jenishukuman = pengajuan_hukuman.id_jenishukuman','left');
		$this->db->where("id",$id);
		$this->db->order_by('pengajuan_hukuman.created','DESC');
		$query=$this->db->get('pengajuan_hukuman');
		return $query->result();
	}
	public function get_izin_belajar($id_pegawai=null,$status=null,$nip=null,$nama=null,$limit=0,$offset=0)
	{
		$this->db->select("
			pengajuan_izin_belajar.id, pengajuan_izin_belajar.id_pegawai, pengajuan_izin_belajar.id_jenjangpendidikan,
			pengajuan_izin_belajar.id_tempatpendidikan, pengajuan_izin_belajar.id_jurusan, 
			pengajuan_izin_belajar.nim, pengajuan_izin_belajar.tgl_pengajuan,
			pengajuan_izin_belajar.berkas,
			pengajuan_izin_belajar.keterangan_berkas, pengajuan_izin_belajar.keterangan_pengajuan,
			pengajuan_izin_belajar.status, pengajuan_izin_belajar.catatan, pengajuan_izin_belajar.created,
			pengajuan_izin_belajar.updated, pengajuan_izin_belajar.createdby, pengajuan_izin_belajar.updatedby,
			pegawai.nama_lengkap, pegawai.nip_baru,
			jenjang.nama_jenjangpendidikan,
			sekolah.nama_tempatpendidikan,
			jurusan.nama_jurusan
		");
		$this->db->join('pegawai','pegawai.id_pegawai = pengajuan_izin_belajar.id_pegawai','left');
		$this->db->join('ref_jenjangpendidikan as jenjang','jenjang.id_jenjangpendidikan = pengajuan_izin_belajar.id_jenjangpendidikan','left');
		$this->db->join('ref_tempatpendidikan as sekolah','sekolah.id_tempatpendidikan = pengajuan_izin_belajar.id_tempatpendidikan','left');
		$this->db->join('ref_jurusan as jurusan','jurusan.id_jurusan = pengajuan_izin_belajar.id_jurusan','left');
		if ($nip!=null && $nama!=null){
			$where = " (pegawai.nip_baru like '%$nip%' ";
			$where .= " AND pegawai.nama_lengkap like '%$nama%' ) ";
			if ($id_pegawai!=null) $where .= "AND pegawai.id_pegawai =$id_pegawai ";
			if ($status!=null) $where .= "AND pengajuan_izin_belajar.status =$status ";
			$this->db->where($where);
		}
		else if ($nip==null && $nama!=null){
			//$where = " (pegawai.nip_baru like '%$nip%' ";
			$where = " pegawai.nama_lengkap like '%$nama%' ";
			if ($id_pegawai!=null) $where .= "AND pegawai.id_pegawai =$id_pegawai ";
			if ($status!=null) $where .= "AND pengajuan_izin_belajar.status =$status ";
			$this->db->where($where);
		}
		else if ($nip!=null && $nama==null){
			$where = " pegawai.nip_baru like '%$nip%' ";
			//$where .= " OR pegawai.nama_lengkap like '%$nama%' ) ";
			if ($id_pegawai!=null) $where .= "AND pegawai.id_pegawai =$id_pegawai ";
			if ($status!=null) $where .= "AND pengajuan_izin_belajar.status =$status ";
			$this->db->where($where);
		}
		else if ($nip==null && $nama==null){
			if ($id_pegawai!=null) $this->db->where('riwayat_pangkat.id_pegawai',$id_pegawai);
			if ($status!=null) $this->db->where('pengajuan_izin_belajar.status',$status);
		}
		
		if ($limit>0) $this->db->limit($limit,$offset);
		$this->db->order_by('pengajuan_izin_belajar.created','DESC');
		$query=$this->db->get('pengajuan_izin_belajar');
		return $query->result();
	}
	public function get_izin_belajar_by_id($id)
	{
		$this->db->select("
			pengajuan_izin_belajar.id, pengajuan_izin_belajar.id_pegawai, pengajuan_izin_belajar.id_jenjangpendidikan,
			pengajuan_izin_belajar.id_tempatpendidikan, pengajuan_izin_belajar.id_jurusan, 
			pengajuan_izin_belajar.nim, pengajuan_izin_belajar.tgl_pengajuan,
			pengajuan_izin_belajar.berkas,
			pengajuan_izin_belajar.keterangan_berkas, pengajuan_izin_belajar.keterangan_pengajuan,
			pengajuan_izin_belajar.status, pengajuan_izin_belajar.catatan, pengajuan_izin_belajar.created,
			pengajuan_izin_belajar.updated, pengajuan_izin_belajar.createdby, pengajuan_izin_belajar.updatedby,
			pegawai.nama_lengkap, pegawai.nip_baru,
			jenjang.nama_jenjangpendidikan,
			sekolah.nama_tempatpendidikan,
			jurusan.nama_jurusan
		");
		$this->db->join('pegawai','pegawai.id_pegawai = pengajuan_izin_belajar.id_pegawai','left');
		$this->db->join('ref_jenjangpendidikan as jenjang','jenjang.id_jenjangpendidikan = pengajuan_izin_belajar.id_jenjangpendidikan','left');
		$this->db->join('ref_tempatpendidikan as sekolah','sekolah.id_tempatpendidikan = pengajuan_izin_belajar.id_tempatpendidikan','left');
		$this->db->join('ref_jurusan as jurusan','jurusan.id_jurusan = pengajuan_izin_belajar.id_jurusan','left');
		$this->db->where("id",$id);
		$query=$this->db->get('pengajuan_izin_belajar');
		return $query->result();
	}
	public function get_kenaikan_pangkat($id_pegawai=null,$status=null,$nip=null,$nama=null,$limit=0,$offset=0)
	{
		$this->db->select("
			pengajuan_kenaikan_pangkat.id, pengajuan_kenaikan_pangkat.id_pegawai, pengajuan_kenaikan_pangkat.id_golongan1,
			pengajuan_kenaikan_pangkat.id_golongan2, pengajuan_kenaikan_pangkat.tgl_pengangkatan, pengajuan_kenaikan_pangkat.berkas,
			pengajuan_kenaikan_pangkat.keterangan_berkas, pengajuan_kenaikan_pangkat.keterangan_pengajuan,
			pengajuan_kenaikan_pangkat.status, pengajuan_kenaikan_pangkat.catatan, pengajuan_kenaikan_pangkat.created,
			pengajuan_kenaikan_pangkat.updated, pengajuan_kenaikan_pangkat.createdby, pengajuan_kenaikan_pangkat.updatedby,
			pegawai.nama_lengkap, pegawai.nip_baru,
			golongan1.golongan as golongan1,
			golongan2.golongan as golongan2
		");
		$this->db->join('pegawai','pegawai.id_pegawai = pengajuan_kenaikan_pangkat.id_pegawai','left');
		$this->db->join('ref_golongan as golongan1','golongan1.id_golongan = pengajuan_kenaikan_pangkat.id_golongan1','left');
		$this->db->join('ref_golongan as golongan2','golongan2.id_golongan = pengajuan_kenaikan_pangkat.id_golongan2','left');
		if ($nip!=null && $nama!=null){
			$where = " (pegawai.nip_baru like '%$nip%' ";
			$where .= " AND pegawai.nama_lengkap like '%$nama%' ) ";
			if ($id_pegawai!=null) $where .= "AND pegawai.id_pegawai =$id_pegawai ";
			if ($status!=null) $where .= "AND pengajuan_kenaikan_pangkat.status =$status ";
			$this->db->where($where);
		}
		else if ($nip==null && $nama!=null){
			//$where = " (pegawai.nip_baru like '%$nip%' ";
			$where = " pegawai.nama_lengkap like '%$nama%' ";
			if ($id_pegawai!=null) $where .= "AND pegawai.id_pegawai =$id_pegawai ";
			if ($status!=null) $where .= "AND pengajuan_kenaikan_pangkat.status =$status ";
			$this->db->where($where);
		}
		else if ($nip!=null && $nama==null){
			$where = " pegawai.nip_baru like '%$nip%' ";
			//$where .= " OR pegawai.nama_lengkap like '%$nama%' ) ";
			if ($id_pegawai!=null) $where .= "AND pegawai.id_pegawai =$id_pegawai ";
			if ($status!=null) $where .= "AND pengajuan_kenaikan_pangkat.status =$status ";
			$this->db->where($where);
		}
		else if ($nip==null && $nama==null){
			if ($id_pegawai!=null) $this->db->where('riwayat_pangkat.id_pegawai',$id_pegawai);
			if ($status!=null) $this->db->where('pengajuan_kenaikan_pangkat.status',$status);
		}
		
		if ($limit>0) $this->db->limit($limit,$offset);
		$this->db->order_by('pengajuan_kenaikan_pangkat.created','DESC');
		$query=$this->db->get('pengajuan_kenaikan_pangkat');
		return $query->result();
	}
	public function get_kenaikan_pangkat_by_id($id)
	{
		$this->db->select("
			pengajuan_kenaikan_pangkat.id, pengajuan_kenaikan_pangkat.id_pegawai, pengajuan_kenaikan_pangkat.id_golongan1,
			pengajuan_kenaikan_pangkat.id_golongan2, pengajuan_kenaikan_pangkat.tgl_pengangkatan, pengajuan_kenaikan_pangkat.berkas,
			pengajuan_kenaikan_pangkat.keterangan_berkas, pengajuan_kenaikan_pangkat.keterangan_pengajuan,
			pengajuan_kenaikan_pangkat.status, pengajuan_kenaikan_pangkat.catatan, pengajuan_kenaikan_pangkat.created,
			pengajuan_kenaikan_pangkat.updated, pengajuan_kenaikan_pangkat.createdby, pengajuan_kenaikan_pangkat.updatedby,
			pegawai.nama_lengkap, pegawai.nip_baru, pegawai.cpns_tmt,
			golongan1.golongan as golongan1,
			golongan2.golongan as golongan2
		");
		$this->db->join('pegawai','pegawai.id_pegawai = pengajuan_kenaikan_pangkat.id_pegawai','left');
		$this->db->join('ref_golongan as golongan1','golongan1.id_golongan = pengajuan_kenaikan_pangkat.id_golongan1','left');
		$this->db->join('ref_golongan as golongan2','golongan2.id_golongan = pengajuan_kenaikan_pangkat.id_golongan2','left');
		$this->db->where("id",$id);
		$this->db->order_by('pengajuan_kenaikan_pangkat.created','DESC');
		$query=$this->db->get('pengajuan_kenaikan_pangkat');
		return $query->result();
	}
	public function ubah_status($table,$status,$id)
	{
		$this->db->where('id',$id);
		$this->db->set('status',$status);
		$this->db->update($table);
	}
	public function delete($table,$id,$berkas)
	{
		$this->db->where('id',$id);
		$this->db->delete($table);
		if ($berkas!=""){
			unlink('./data/upload_berkas/'.$berkas);
		}
	}
	public function get_masa_kerja($tgl1,$tgl2){ // tgl1 < tgl2
		$hari1=gregoriantojd(date('m',strtotime($tgl1)),date('d',strtotime($tgl1)),date('Y',strtotime($tgl1)));	
		$hari2=gregoriantojd(date('m',strtotime($tgl2)),date('d',strtotime($tgl2)),date('Y',strtotime($tgl2)));
		$selisih=$hari2 - $hari1;
		$tahun=round($selisih/365);
		$sisa=round($selisih%365);
		$bulan=round($sisa/30);
		$hari=round($sisa%30);
		return array(
			'tahun' => $tahun,
			'bulan' => $bulan,
			'hari'  => $hari
		);
	}
	public function get_golongan($id_golongan=null){
		if ($id_golongan!=null) $this->db->where('id_golongan',$id_golongan);
		$this->db->order_by('level','DESC');
		$query = $this->db->get('ref_golongan');
		return $query->result();
	}
	public function get_golongan_by_level($level){
		$this->db->where("level < '$level'");
		$this->db->order_by('level','DESC');
		$query = $this->db->get('ref_golongan');
		return $query->result();
	}
}
?>