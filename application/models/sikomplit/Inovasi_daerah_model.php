<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inovasi_daerah_model extends CI_Model
{
	public $id_inovasi_daerah;
	public $album_id;
	public $gallery_title;
	public $picture;
	public $album_title;	
	public $album_description;
	public $album_picture;
	public $pict_count;
	public $creator;
	public $id_skpd;
	public $status_kirim;

	public function get_column_name()
	{
		return $this->db->field_data('inovasi_daerah');
	}

	public function insert($data)
	{
		return $this->db->insert('inovasi_daerah', $data);
	}
	

	public function delete($id)
	{
		$this->db->where('id_inovasi_daerah', $id);
		return $this->db->delete('inovasi_daerah');
	}

	public function review($id, $data){
		$this->db->where('id_inovasi_daerah', $id);
		return $this->db->update('inovasi_daerah', $data);
	}

	public function update($data, $id){
		$this->db->where('id_inovasi_daerah', $id);
		return $this->db->update('inovasi_daerah', $data);
	}
	
	public function get_inovasi_daerah($filter=null)
	{
		$this->db->select('inovasi_daerah.*, user.user_id, user.id_pegawai,  ref_skpd.id_skpd, ref_skpd.nama_skpd');
		$this->db->join('user', 'user.user_id = inovasi_daerah.creator');
		// $this->db->join('pegawai', 'pegawai.id_pegawai = user.id_pegawai');
		$this->db->join('ref_skpd', 'ref_skpd.id_skpd = inovasi_daerah.id_skpd');
		if (!empty($filter['id_skpd'])) {
			$this->db->where('inovasi_daerah.id_skpd', $filter['id_skpd']);
		}
		if (!empty($filter['tahapan'])) {
			$this->db->where('inovasi_daerah.tahapan', $filter['tahapan']);
		}
		if ($this->id_skpd) {
			$this->db->where('inovasi_daerah.id_skpd', $this->id_skpd);
		}
		if ($this->status_kirim){
			$this->db->where('inovasi_daerah.status_kirim', $this->status_kirim);
		}
		$this->db->where('status','Y');
		$this->db->order_by('created_at', 'DESC');
		$query = $this->db->get('inovasi_daerah');
		return $query->result();
	}
	
	public function get_inovasi_daerah_by_id($id)
	{
		$this->db->select('inovasi_daerah.*, user.user_id, user.id_pegawai, ref_skpd.id_skpd, ref_skpd.nama_skpd, user.full_name');
		$this->db->join('user', 'user.user_id = inovasi_daerah.creator');
		// $this->db->join('pegawai', 'pegawai.id_pegawai = user.id_pegawai');
		$this->db->join('ref_skpd', 'ref_skpd.id_skpd = inovasi_daerah.id_skpd');
		$this->db->where('inovasi_daerah.id_inovasi_daerah', $id);
		$query = $this->db->get('inovasi_daerah');
		return $query->row();
	}
	public function get_gallery_by_album()
	{
		$this->db->where('album_id',$this->album_id);
		$query = $this->db->get('album');
		return $query->result();
	}
	public function create_album()
	{
		$this->db->set('album_title',$this->album_title);
		$this->db->set('description',$this->album_description);
		$this->db->set('picture',$this->album_picture);
		$this->db->insert('album');
	}
	public function update_album()
	{
		$this->db->where('album_id',$this->album_id);
		$this->db->set('album_title',$this->album_title);
		$this->db->set('description',$this->album_description);
		if ($this->album_picture!="") $this->db->set('picture',$this->album_picture);
		$this->db->update('album');
	}
	public function delete_album()
	{
		$this->db->where('album_id',$this->album_id);
		$this->db->delete('album');
	}
	public function set_album_by_id()
	{
		$this->db->where('album_id',$this->album_id);
		$query = $this->db->get('album');
		foreach ($query->result() as $row) {
			$this->album_title = $row->album_title;
			$this->album_picture = $row->picture;
			$this->album_description = $row->description;
			$this->pict_count = $row->pict_count;
		}
	}

	public function update_kematangan($id,$data)
	{
		$this->db->where('id_inovasi_daerah', $id);
		return $this->db->update('inovasi_daerah', $data);
	}
	public function get_gallery($limit=null)
	{
		if ($this->album_id!="") $this->db->where('album_id',$this->album_id);
		if (!empty($limit)) $this->db->limit($limit);
		$query = $this->db->get('gallery');
		return $query->result();
	}
	public function delete_gallery()
	{
		$this->db->where('picture',$this->picture);
		$query = $this->db->get('gallery');
		$album_id = "";
		foreach ($query->result() as $row) {
			$album_id = $row->album_id;
		}
		$this->db->where('picture',$this->picture);
		$this->db->delete('gallery');
		$this->update_pict_count($album_id,'delete');
	}
	public function insert_gallery()
	{
		$this->db->set('picture',$this->picture);
		$this->db->set('gallery_title',$this->picture);
		$this->db->set('album_id',$this->album_id);
		$this->db->insert('gallery');
		$this->update_pict_count($this->album_id,'insert');
	}
	public function update_pict_count($album_id,$act)
	{
		$this->db->where('album_id',$album_id);
		$query = $this->db->get('album');
		$pict_count = 0 ;
		foreach ($query->result() as $row) {
			$pict_count = $row->pict_count;
		}
		if ($act=='insert')
			$pict_count = $pict_count + 1;
		else
			$pict_count = $pict_count - 1;
		$this->db->where('album_id',$album_id);
		$this->db->set('pict_count',$pict_count);
		$this->db->update('album');
	}
}
?>