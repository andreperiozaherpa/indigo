<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Target_pekerjaan_model extends CI_Model
{
	public $id_target_pekerjaan;
	public $id_pekerjaan;
	public $nama_kegiatan;
	public $angka_kredit;
	public $uraian_kegiatan;
	public $tgl_mulai_kegiatan;
	public $tgl_akhir_kegiatan;
	public $nama_lokasi;
	public $id_provinsi_kegiatan;
	public $id_kabupaten_kegiatan;
	public $id_kecamatan_kegiatan;
	public $id_desa_kegiatan;
	public $kuantitas_kegiatan;
	public $id_satuan_kuantitas;
	public $kualitas_kegiatan;
	public $id_satuan_kualitas;
	public $waktu_kegiatan;
	public $id_satuan_waktu;
	public $biaya_kegiatan;

	public function get_all()
	{
		if($this->nama_kegiatan!='') $this->db->like('nama_kegiatan',$this->nama_kegiatan);
		if($this->id_pekerjaan!='') $this->db->where('target_pekerjaan.id_pekerjaan',$this->id_pekerjaan);
		if($this->tgl_mulai_kegiatan!='') $this->db->where('tgl_mulai_kegiatan >=',$this->tgl_mulai_kegiatan);
		if($this->tgl_akhir_kegiatan!='') $this->db->where('tgl_akhir_kegiatan <=',$this->tgl_akhir_kegiatan);
		$this->db->join('ref_pekerjaan','ref_pekerjaan.id_pekerjaan = target_pekerjaan.id_pekerjaan');
		$query = $this->db->get('target_pekerjaan');
		return $query->result();
	}

	public function get_by_id(){
		$this->db->where('id_target_pekerjaan',$this->id_target_pekerjaan);
		$query = $this->db->get('target_pekerjaan');
		return $query->row();
	}

	public function get_anggota_tim(){
		$this->db->where('id_target_pekerjaan',$this->id_target_pekerjaan);
		$query = $this->db->get('target_pekerjaan_anggota');
		return $query->result();
	}

	public function insert(){
		$this->db->set('id_pekerjaan',$this->id_pekerjaan);
		$this->db->set('nama_kegiatan',$this->nama_kegiatan);
		$this->db->set('angka_kredit',$this->angka_kredit);
		$this->db->set('uraian_kegiatan',$this->uraian_kegiatan);
		$this->db->set('tgl_mulai_kegiatan',$this->tgl_mulai_kegiatan);
		$this->db->set('tgl_akhir_kegiatan',$this->tgl_akhir_kegiatan);
		$this->db->set('nama_lokasi',$this->nama_lokasi);
		$this->db->set('id_provinsi_kegiatan',$this->id_provinsi_kegiatan);
		$this->db->set('id_kabupaten_kegiatan',$this->id_kabupaten_kegiatan);
		$this->db->set('id_kecamatan_kegiatan',$this->id_kecamatan_kegiatan);
		$this->db->set('id_desa_kegiatan',$this->id_desa_kegiatan);
		$this->db->set('kuantitas_kegiatan',$this->kuantitas_kegiatan);
		$this->db->set('id_satuan_kuantitas',$this->id_satuan_kuantitas);
		$this->db->set('kualitas_kegiatan',$this->kualitas_kegiatan);
		$this->db->set('id_satuan_kualitas',$this->id_satuan_kualitas);
		$this->db->set('waktu_kegiatan',$this->waktu_kegiatan);
		$this->db->set('id_satuan_waktu',$this->id_satuan_waktu);
		$this->db->set('biaya_kegiatan',$this->biaya_kegiatan);
		$this->db->insert('target_pekerjaan');
		return $this->db->insert_id();
	}

	public function insert_anggota(){
		$this->db->set('id_target_pekerjaan',$this->id_target_pekerjaan);
		$this->db->set('id_pegawai',$this->id_pegawai);
		$this->db->set('uraian_pekerjaan',$this->uraian_pekerjaan);
		$this->db->insert('target_pekerjaan_anggota');
		return $this->db->insert_id();
	}

	public function update()
	{
		$this->db->where('id_target_pekerjaan',$this->id_target_pekerjaan);
		$this->db->set('id_pekerjaan',$this->id_pekerjaan);
		$this->db->set('nama_kegiatan',$this->nama_kegiatan);
		$this->db->set('angka_kredit',$this->angka_kredit);
		$this->db->set('uraian_kegiatan',$this->uraian_kegiatan);
		$this->db->set('tgl_mulai_kegiatan',$this->tgl_mulai_kegiatan);
		$this->db->set('tgl_akhir_kegiatan',$this->tgl_akhir_kegiatan);
		$this->db->set('nama_lokasi',$this->nama_lokasi);
		$this->db->set('id_provinsi_kegiatan',$this->id_provinsi_kegiatan);
		$this->db->set('id_kabupaten_kegiatan',$this->id_kabupaten_kegiatan);
		$this->db->set('id_kecamatan_kegiatan',$this->id_kecamatan_kegiatan);
		$this->db->set('id_desa_kegiatan',$this->id_desa_kegiatan);
		$this->db->set('kuantitas_kegiatan',$this->kuantitas_kegiatan);
		$this->db->set('id_satuan_kuantitas',$this->id_satuan_kuantitas);
		$this->db->set('kualitas_kegiatan',$this->kualitas_kegiatan);
		$this->db->set('id_satuan_kualitas',$this->id_satuan_kualitas);
		$this->db->set('waktu_kegiatan',$this->waktu_kegiatan);
		$this->db->set('id_satuan_waktu',$this->id_satuan_waktu);
		$this->db->set('biaya_kegiatan',$this->biaya_kegiatan);
		$this->db->update('target_pekerjaan');
	}
	public function delete()
	{
		$this->db->where('id_target_pekerjaan',$this->id_target_pekerjaan);
		$this->db->delete('target_pekerjaan');
	}
	public function set()
	{
		$this->db->where('id_target_pekerjaan',$this->id_target_pekerjaan);
		$query= $this->db->get('target_pekerjaan');
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
		$this->db->where('id_target_pekerjaan',$this->id_target_pekerjaan);
		$this->db->update('target_pekerjaan');
	}

	public function get_for_page($limit,$offset)
	{

		// $this->db->join('channel','channel.channel_id = post.channel_id','left');
		$this->db->join('category_target_pekerjaan','category_target_pekerjaan.category_id = target_pekerjaan.category_id','left');
		// $this->db->join('user','user.user_id = post.author','left');
		if ($this->search!=""){
			$this->db->group_start();
			$this->db->where(" judul like '%$this->search%' OR detail like '%$this->search%'  ");
			$this->db->group_end();
		}
		// if ($this->author!="") $this->db->where('author',$this->author);
		// if ($this->post_status!="") $this->db->where('post_status',$this->post_status);
		// if ($this->external!="") $this->db->where('category.category_id > 0');
		
		if ($this->search_c!="") $this->db->where('target_pekerjaan.category_id',$this->search_c);
		// if ($this->channel_id!="") $this->db->where('channel.channel_id',$this->channel_id);
		// if ($this->tag!="") $this->db->where(" tag like '%$this->tag%' ");
		$this->db->order_by('tgl_posting','DESC');
		$this->db->limit($limit,$offset);
		$query = $this->db->get('target_pekerjaan');
		return $query->result();
	}

	public function get_total_row()
	{

		// $this->db->join('channel','channel.channel_id = post.channel_id','left');
		$this->db->join('category_target_pekerjaan','category_target_pekerjaan.category_id = target_pekerjaan.category_id','left');
		// $this->db->join('user','user.user_id = post.author','left');
		if ($this->search!=""){
			$this->db->group_start();
			$this->db->where(" judul like '%$this->search%' OR detail like '%$this->search%'  ");
			$this->db->group_end();
		}
		// if ($this->author!="") $this->db->where('author',$this->author);
		// if ($this->post_status!="") $this->db->where('post_status',$this->post_status);
		// if ($this->external!="") $this->db->where('category.category_id > 0');
		
		if ($this->search_c!="") $this->db->where('target_pekerjaan.category_id',$this->search_c);
		// if ($this->channel_id!="") $this->db->where('channel.channel_id',$this->channel_id);
		// if ($this->tag!="") $this->db->where(" tag like '%$this->tag%' ");
		$query = $this->db->get('target_pekerjaan');
		return $query->num_rows();
	}
}
?>