<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kegiatan_model extends CI_Model
{
	public $id_kegiatan;
	public $jenis_sasaran_tautan;
	public $id_unit_kerja_tautan;
	public $id_sasaran_tautan;
	public $id_iku_tautan;
	public $id_renaksi_tautan;
	public $nama_kegiatan;
	public $dasar_hukum;
	public $prioritas;
	public $anggaran_kegiatan;
	public $uraian_kegiatan;
	public $file_pendukung;
	public $detail_pekerjaan;
	public $status_kegiatan;
	public $surat_perintah;
	public $id_ketua_tim;
	public $tgl_mulai_kegiatan;
	public $tgl_akhir_kegiatan;
	public $nama_lokasi;
	public $id_provinsi_kegiatan;
	public $id_kabupaten_kegiatan;
	public $id_kecamatan_kegiatan;
	public $id_desa_kegiatan;

	public $id_kegiatan_anggota;
	public $id_pegawai;
	public $uraian_pekerjaan;

	public function get_all()
	{
		if($this->nama_kegiatan!='') $this->db->like('nama_kegiatan',$this->nama_kegiatan);
		if($this->prioritas!='') $this->db->where('prioritas',$this->prioritas);
		$this->db->join('pegawai','pegawai.id_pegawai = kegiatan.id_ketua_tim');
		$query = $this->db->get('kegiatan')->result();

		if($this->session->userdata('level')!=='Administrator'){
			$list = array();
				$id_pegawai = $this->session->userdata('id_pegawai');
			foreach($query as $k => $q){
				if($q->id_ketua_tim==$id_pegawai){
					$list[] = $query[$k];
				}

				$this->db->where("FIND_IN_SET(".$id_pegawai." ,REPLACE(id_pegawai, ';', ',') ) !=", 0);
				$this->db->where('id_kegiatan',$q->id_kegiatan);
				$z = $this->db->get('kegiatan_anggota')->row();
				if(!empty($z)){
					$list[] = $query[$k];
				}

			}
			return $list;
		}else{
			return $query;
		}
	}


	public function get_all_pegawai($id_pegawai,$filter='')
	{
		if($filter!=''){
			foreach($filter as $key => $value){
				if($key=='tanggal_awal'||$key=='tanggal_akhir'){
					if(!empty($value)){
						if($key=='tanggal_awal'){
							$this->db->where('tgl_mulai_kegiatan >',$value);
						}elseif($key=='tanggal_akhir'){
							$this->db->where('tgl_akhir_kegiatan <',$value);
						}
					}
				}else{

				$this->db->like($key,$value);
				}
			}
		}
		$this->db->join('pegawai','pegawai.id_pegawai = kegiatan.id_ketua_tim');
		$query = $this->db->get('kegiatan')->result();

		$list = array();
		foreach($query as $k => $q){
			if($q->id_ketua_tim==$id_pegawai){
				$list[] = $query[$k];
			}

			$this->db->where("FIND_IN_SET(".$id_pegawai." ,REPLACE(id_pegawai, ';', ',') ) !=", 0);
			$this->db->where('id_kegiatan',$q->id_kegiatan);
			$z = $this->db->get('kegiatan_anggota')->row();
			if(!empty($z)){
				$list[] = $query[$k];
			}

		}
		return $list;
	}

	public function check_privileges($id_kegiatan)
	{
		$this->db->where('id_kegiatan',$id_kegiatan);
		$q = $this->db->get('kegiatan')->row();

		if(!empty($q)){
			if($this->session->userdata('level')!=='Administrator'){
				$list = false;
				$id_pegawai = $this->session->userdata('id_pegawai');
				if($q->id_ketua_tim==$id_pegawai){
					$list = true;
				}

				$this->db->where("FIND_IN_SET(".$id_pegawai." ,REPLACE(id_pegawai, ';', ',') ) !=", 0);
				$this->db->where('id_kegiatan',$q->id_kegiatan);
				$z = $this->db->get('kegiatan_anggota')->row();
				if(!empty($z)){
					$list = true;
				}
				return $list;
			}else{
				return true;
			}
		}else{
			return false;
		}
	}


	public function get_pekerjaan($id_pegawai,$tahun=''){
		$this->db->group_by('kegiatan_anggota.id_kegiatan');
		if($tahun!==''){
			$this->db->where('YEAR(tgl_mulai_kegiatan)',$tahun);
		}
		$this->db->join('kegiatan','kegiatan.id_kegiatan = kegiatan_anggota.id_kegiatan');
		$this->db->where("FIND_IN_SET(".$id_pegawai." ,REPLACE(id_pegawai, ';', ',') ) !=", 0);
		$query = $this->db->get('kegiatan_anggota');
		return $query->result();
	}

	public function get_pekerjaan_by_user($id_pegawai,$tahun=''){
		$this->db->group_by('kegiatan_anggota.id_kegiatan');
		if($tahun!==''){
			$this->db->where('YEAR(tgl_mulai_kegiatan)',$tahun);
		}
		$this->db->join('kegiatan','kegiatan.id_kegiatan = kegiatan_anggota.id_kegiatan');
		$this->db->where("FIND_IN_SET(".$id_pegawai." ,REPLACE(id_pegawai, ';', ',') ) !=", 0);
		$this->db->limit(5);
		$this->db->order_by('kegiatan_anggota.id_kegiatan', 'desc');
		$query = $this->db->get('kegiatan_anggota');
		return $query->result();
	}

	public function get_capaian($id_kegiatan,$id_pegawai){
		$this->db->where('id_kegiatan',$id_kegiatan);
		$this->db->where("FIND_IN_SET(".$id_pegawai." ,REPLACE(id_pegawai, ';', ',') ) !=", 0);
		$query = $this->db->get('kegiatan_anggota')->result();
		$jumlah = count($query);

		$selesai = 0;
		foreach($query as $q){
			$this->db->where('status','disetujui');
			$this->db->where('id_kegiatan_anggota',$q->id_kegiatan_anggota);
			$jml = $this->db->get('kegiatan_realisasi')->num_rows();
			$selesai += $jml;
		}

		$presentase = $selesai/$jumlah*100;
		return $presentase;
	}

	// public function get_capaian_by_user($id_kegiatan,$id_pegawai){
	// 	$this->db->where('kegiatan_anggota.id_kegiatan',$id_kegiatan);
	// 	$this->db->where("FIND_IN_SET(".$id_pegawai." ,REPLACE(id_pegawai, ';', ',') ) !=", 0);
	// 	$this->db->join('kegiatan_realisasi', 'kegiatan_realisasi.')
	// }

	public function get_by_id(){
		$this->db->where('id_kegiatan',$this->id_kegiatan);
		$this->db->join('pegawai','pegawai.id_pegawai = kegiatan.id_ketua_tim');
		$query = $this->db->get('kegiatan');
		return $query->row();
	}

	public function get_anggota_tim(){
		$this->db->where('id_kegiatan',$this->id_kegiatan);
		$query = $this->db->get('kegiatan_anggota');
		return $query->result();
	}

	public function insert(){
		$this->db->set('jenis_sasaran_tautan',$this->jenis_sasaran_tautan);
		$this->db->set('id_unit_kerja_tautan',$this->id_unit_kerja_tautan);
		$this->db->set('id_sasaran_tautan',$this->id_sasaran_tautan);
		$this->db->set('id_iku_tautan',$this->id_iku_tautan);
		$this->db->set('id_renaksi_tautan',$this->id_renaksi_tautan);
		$this->db->set('surat_perintah',$this->surat_perintah);
		$this->db->set('nama_kegiatan',$this->nama_kegiatan);
		$this->db->set('dasar_hukum',$this->dasar_hukum);
		$this->db->set('prioritas',$this->prioritas);
		$this->db->set('anggaran_kegiatan',$this->anggaran_kegiatan);
		$this->db->set('uraian_kegiatan',$this->uraian_kegiatan);
		$this->db->set('file_pendukung',$this->file_pendukung);
		$this->db->set('detail_pekerjaan',$this->detail_pekerjaan);
		$this->db->set('status_kegiatan',$this->status_kegiatan);
		$this->db->set('id_ketua_tim',$this->id_ketua_tim);
		$this->db->set('tgl_mulai_kegiatan',$this->tgl_mulai_kegiatan);
		$this->db->set('tgl_akhir_kegiatan',$this->tgl_akhir_kegiatan);
		$this->db->set('nama_lokasi',$this->nama_lokasi);
		$this->db->set('id_provinsi_kegiatan',$this->id_provinsi_kegiatan);
		$this->db->set('id_kabupaten_kegiatan',$this->id_kabupaten_kegiatan);
		$this->db->set('id_kecamatan_kegiatan',$this->id_kecamatan_kegiatan);
		$this->db->set('id_desa_kegiatan',$this->id_desa_kegiatan);
		$this->db->insert('kegiatan');
		return $this->db->insert_id();
	}

	public function insert_anggota(){
		$this->db->set('id_kegiatan',$this->id_kegiatan);
		$this->db->set('id_pegawai',$this->id_pegawai);
		$this->db->set('uraian_pekerjaan',$this->uraian_pekerjaan);
		$this->db->insert('kegiatan_anggota');
		$in = $this->db->insert_id();
		$this->db->set('id_kegiatan',$this->id_kegiatan);
		$this->db->set('id_kegiatan_anggota',$in);
		$this->db->set('realisasi','');
		// $this->db->set('tgl_update','2012-01-01');
		$this->db->insert('kegiatan_realisasi');
	}

	public function get_anggota(){
		$this->db->where('id_kegiatan',$this->id_kegiatan);
		// $this->db->join('pegawai','pegawai.id_pegawai = kegiatan_anggota.id_pegawai');
		$query = $this->db->get('kegiatan_anggota');
		return $query->result();
	}

	public function update()
	{
		$this->db->where('id_kegiatan',$this->id_kegiatan);
		$this->db->set('id_iku',$this->id_iku);
		if($this->surat_perintah!='') $this->db->set('surat_perintah',$this->surat_perintah);
		$this->db->set('nama_kegiatan',$this->nama_kegiatan);
		$this->db->set('dasar_hukum',$this->dasar_hukum);
		$this->db->set('prioritas',$this->prioritas);
		$this->db->set('anggaran_kegiatan',$this->anggaran_kegiatan);
		$this->db->set('uraian_kegiatan',$this->uraian_kegiatan);
		if($this->file_pendukung!='') $this->db->set('file_pendukung',$this->file_pendukung);
		$this->db->set('detail_pekerjaan',$this->detail_pekerjaan);
		$this->db->set('status_kegiatan',$this->status_kegiatan);
		$this->db->set('id_ketua_tim',$this->id_ketua_tim);
		$this->db->set('tgl_mulai_kegiatan',$this->tgl_mulai_kegiatan);
		$this->db->set('tgl_akhir_kegiatan',$this->tgl_akhir_kegiatan);
		$this->db->set('nama_lokasi',$this->nama_lokasi);
		$this->db->set('id_provinsi_kegiatan',$this->id_provinsi_kegiatan);
		$this->db->set('id_kabupaten_kegiatan',$this->id_kabupaten_kegiatan);
		$this->db->set('id_kecamatan_kegiatan',$this->id_kecamatan_kegiatan);
		$this->db->set('id_desa_kegiatan',$this->id_desa_kegiatan);
		$this->db->update('kegiatan');
		$this->db->where('id_kegiatan',$this->id_kegiatan);
		$this->db->delete('kegiatan_anggota');
	}
	public function delete()
	{
		$this->db->where('id_kegiatan',$this->id_kegiatan);
		$this->db->delete('kegiatan');
	}
	public function set()
	{
		$this->db->where('id_kegiatan',$this->id_kegiatan);
		$query= $this->db->get('kegiatan');
		foreach ($query->result() as $row) {
			$this->judul = $row->judul;
			$this->nama_file = $row->nama_file;
			$this->link = $row->link;
			$this->category_id = $row->category_id;
			$this->detail = $row->detail;
			$this->hits=$row->hits;
			$this->tgl_posting = $row->tgl_posting;
			$this->author = $row->author;
		}
	}


	public function hits()
	{
		$this->db->set('hits', 'hits+1', FALSE);
		$this->db->where('id_kegiatan',$this->id_kegiatan);
		$this->db->update('kegiatan');
	}

	public function get_for_page($limit,$offset)
	{

		// $this->db->join('channel','channel.channel_id = post.channel_id','left');
		$this->db->join('category_kegiatan','category_kegiatan.category_id = kegiatan.category_id','left');
		// $this->db->join('user','user.user_id = post.author','left');
		if ($this->search!=""){
			$this->db->group_start();
			$this->db->where(" judul like '%$this->search%' OR detail like '%$this->search%'  ");
			$this->db->group_end();
		}
		// if ($this->author!="") $this->db->where('author',$this->author);
		// if ($this->post_status!="") $this->db->where('post_status',$this->post_status);
		// if ($this->external!="") $this->db->where('category.category_id > 0');

		if ($this->search_c!="") $this->db->where('kegiatan.category_id',$this->search_c);
		// if ($this->channel_id!="") $this->db->where('channel.channel_id',$this->channel_id);
		// if ($this->tag!="") $this->db->where(" tag like '%$this->tag%' ");
		$this->db->order_by('tgl_posting','DESC');
		$this->db->limit($limit,$offset);
		$query = $this->db->get('kegiatan');
		return $query->result();
	}

	public function get_total_row()
	{

		// $this->db->join('channel','channel.channel_id = post.channel_id','left');
		$this->db->join('category_kegiatan','category_kegiatan.category_id = kegiatan.category_id','left');
		// $this->db->join('user','user.user_id = post.author','left');
		if ($this->search!=""){
			$this->db->group_start();
			$this->db->where(" judul like '%$this->search%' OR detail like '%$this->search%'  ");
			$this->db->group_end();
		}
		// if ($this->author!="") $this->db->where('author',$this->author);
		// if ($this->post_status!="") $this->db->where('post_status',$this->post_status);
		// if ($this->external!="") $this->db->where('category.category_id > 0');

		if ($this->search_c!="") $this->db->where('kegiatan.category_id',$this->search_c);
		// if ($this->channel_id!="") $this->db->where('channel.channel_id',$this->channel_id);
		// if ($this->tag!="") $this->db->where(" tag like '%$this->tag%' ");
		$query = $this->db->get('kegiatan');
		return $query->num_rows();
	}
}
?>
