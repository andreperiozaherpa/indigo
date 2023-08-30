<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ref_renstra_model extends CI_Model
{
	public function get_all_data($limit=0, $offset=0)
	{
		$this->db->join("misi", "ref_renstra.id_misi = misi.id_misi", "left");
		$this->db->limit($limit,$offset);
		$query = $this->db->get('ref_renstra');
		return $query->result();
	}

	public function get_all_data_misi($limit=0, $offset=0)
	{
		$this->db->limit($limit,$offset);
		$query = $this->db->get('misi');
		return $query->result();
	}

	public function get_data_by_id($id)
	{
		$this->db->where("id_renstra", $id);
		$query = $this->db->get('ref_renstra');
		return $query->result();
	}

	public function insert_data($data)
	{
		if ($data) {
			$query = $this->db->insert('ref_renstra', $data);
			return true;
		}
	}

	public function update_data($data, $id=null)
	{
		if ($data AND $id > 0) {
			$this->db->where("id_renstra", $id);
			$query = $this->db->update('ref_renstra', $data);
			return true;
		}
	}

	public function delete_data($id=null)
	{
		if ($id > 0) {
			$this->db->where("id_renstra", $id);
			$query = $this->db->delete('ref_renstra');
			return true;
		}
	}
}
?>