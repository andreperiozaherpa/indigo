<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Standar_kepatuhan_2_model extends CI_Model
{
	public $gallery_id;
	public $album_id;
	public $gallery_title;
	public $picture;
	public $album_title;	
	public $album_description;
	public $album_picture;
	public $pict_count;
	public $id_user;
	public $id_skpd;

	public function get_column_name()
	{
		return $this->db->field_data('standar_kepatuhan');
	}

	public function insert($data)
	{
		$this->db->insert('standar_kepatuhan_2', $data);
		return $this->db->insert_id();
	}

	public function insert_isi($data)
	{
		return $this->db->insert('standar_kepatuhan_isi_2', $data);
	}
	
	public function get_indikator()
	{
		$query = $this->db->get('standar_kepatuhan_variabel_2')->result_array();

		foreach($query as $i=>$product) {

			$this->db->where('id_standar_kepatuhan_variabel', $product['id_standar_kepatuhan_variabel']);
			$indikator = $this->db->get('standar_kepatuhan_indikator_2')->result_array();

			$query[$i]['indikator'] = $indikator;

		}

		return $query;
	}

	public function get_indikator_list()
	{
		return $this->db->get('standar_kepatuhan_indikator_2')->result_array();
	}

	public function delete($id)
	{
		$this->db->where('id_standar_kepatuhan', $id);
		return $this->db->delete('standar_kepatuhan_2');
	}

	public function delete_isi($id)
	{
		$this->db->where('id_standar_kepatuhan_isi', $id);
		return $this->db->delete('standar_kepatuhan_isi_2');
	}

	public function review($id, $data){
		$this->db->where('id_standar_kepatuhan', $id);
		return $this->db->update('standar_kepatuhan_2', $data);
	}
	
	public function get_standar_kepatuhan($filter=null)
	{
		$this->db->select('standar_kepatuhan_2.*, user.user_id, user.id_pegawai, pegawai.id_pegawai, pegawai.id_skpd, pegawai.nama_lengkap, ref_skpd.id_skpd, ref_skpd.nama_skpd');
		$this->db->join('user', 'user.user_id = standar_kepatuhan_2.id_user');
		$this->db->join('pegawai', 'pegawai.id_pegawai = user.id_pegawai');
		$this->db->join('ref_skpd', 'ref_skpd.id_skpd = standar_kepatuhan_2.id_skpd');
		if (!empty($this->id_skpd)) {
			$this->db->where('standar_kepatuhan_2.id_skpd', $this->id_skpd);
		}
		if (!empty($filter['start'])) {
			$this->db->where('standar_kepatuhan_2.created_at >=', $filter['start']);
		}
		if (!empty($filter['max'])) {
			$this->db->where_in('standar_kepatuhan_2.id_standar_kepatuhan', $filter['max']);
		}
		if (!empty($filter['end'])) {
			$this->db->where('standar_kepatuhan_2.created_at <=', $filter['end']);
		}
		if ($this->id_user) {
			$this->db->where('standar_kepatuhan_2.id_user', $this->id_user);
		}
		// $this->db->order_by('standar_kepatuhan_2.created_at', 'DESC');
		// $this->db->group_by('standar_kepatuhan_2.id_skpd');
		$query = $this->db->get('standar_kepatuhan_2');
		$q = $query->result_array();

		foreach ($q as $i => $val){
			$get_nilai = $this->get_standar_kepatuhan_skor($val['id_standar_kepatuhan']);
			$q[$i]['nilai_sistem'] = $get_nilai[0]->skor;
		}

		return $q;

	} 

	public function get_max_id_standar_kepatuhan()
	{
		// $q = $this->db->query('SELECT MAX(id_standar_kepatuhan) as id FROM standar_kepatuhan_2 GROUP BY id_skpd');
		// return $q->result();

		$this->db->select('standar_kepatuhan_2.*, max(standar_kepatuhan_2.id_standar_kepatuhan) as max');
		// $this->db->join('user', 'user.user_id = standar_kepatuhan_2.id_user', 'left');
		// $this->db->join('pegawai', 'pegawai.id_pegawai = user.id_pegawai');
		// $this->db->join('ref_skpd', 'ref_skpd.id_skpd = standar_kepatuhan_2.id_skpd');
		$this->db->group_by('standar_kepatuhan_2.id_skpd');
		$q = $this->db->get('standar_kepatuhan_2')->result();
		$arr = [];

		foreach ($q as $key => $que){
			$arr[$key] = $que->max;
		}
		return $arr;
	}

	public function get_standar_kepatuhan_isi($standar_kepatuhan, $indikator)
	{
		$this->db->select('standar_kepatuhan_isi_2.*, standar_kepatuhan_indikator_2.indikator');
		$this->db->join('standar_kepatuhan_indikator_2', 'standar_kepatuhan_indikator_2.id_standar_kepatuhan_indikator = standar_kepatuhan_isi_2.id_standar_kepatuhan_indikator', 'LEFT');
		$this->db->where('standar_kepatuhan_isi_2.id_standar_kepatuhan', $standar_kepatuhan);
		$this->db->where('standar_kepatuhan_isi_2.id_standar_kepatuhan_indikator', $indikator);
		return $this->db->get('standar_kepatuhan_isi_2')->row_array();
	}

	public function get_standar_kepatuhan_isi_by_id_standar_kepatuhan($standar_kepatuhan)
	{
		$this->db->where('id_standar_kepatuhan', $standar_kepatuhan);
		return $this->db->get('standar_kepatuhan_isi_2')->result_array();
	}

	public function get_standar_kepatuhan_skor($id)
	{
		$this->db->select_sum('skor');
		$this->db->where('id_standar_kepatuhan', $id);
		return $this->db->get('standar_kepatuhan_isi_2')->result();
	}
	
	public function get_standar_kepatuhan_by_id($id)
	{
		$this->db->select('standar_kepatuhan_2.*, user.user_id, user.id_pegawai, pegawai.id_pegawai, pegawai.id_skpd, pegawai.nama_lengkap, ref_skpd.id_skpd, ref_skpd.nama_skpd');
		$this->db->join('user', 'user.user_id = standar_kepatuhan_2.id_user');
		$this->db->join('pegawai', 'pegawai.id_pegawai = user.id_pegawai');
		$this->db->join('ref_skpd', 'ref_skpd.id_skpd = pegawai.id_skpd');
		$this->db->where('standar_kepatuhan_2.id_standar_kepatuhan', $id);
		$query = $this->db->get('standar_kepatuhan_2');
		return $query->row_array();
	}
	
	public function get_standar_kepatuhan_by_id_skpd($id)
	{
		$this->db->select('standar_kepatuhan_2.*, user.user_id, user.id_pegawai, pegawai.id_pegawai, pegawai.id_skpd, pegawai.nama_lengkap, ref_skpd.id_skpd, ref_skpd.nama_skpd');
		$this->db->join('user', 'user.user_id = standar_kepatuhan_2.id_user');
		$this->db->join('pegawai', 'pegawai.id_pegawai = user.id_pegawai');
		$this->db->join('ref_skpd', 'ref_skpd.id_skpd = pegawai.id_skpd');
		$this->db->where('standar_kepatuhan_2.id_skpd', $id);
		$this->db->order_by('created_at', 'desc');
		$this->db->limit(1);
		$query = $this->db->get('standar_kepatuhan_2');
		return $query->row_array();
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
