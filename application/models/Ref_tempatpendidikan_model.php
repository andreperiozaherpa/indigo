<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ref_tempatpendidikan_model extends CI_Model
{
	public $id_tempatpendidikan;
	public $nama_tempatpendidikan;
	public $status;
	public $level;
	public function get_for_page($limit=null,$offset=null)
	{
		if ($limit!=null) $this->db->limit($limit,$offset);
		$this->db->order_by('nama_tempatpendidikan','ASC');
		$query = $this->db->get('ref_tempatpendidikan');
		return $query->result();
	}
	
	public function get_all()
	{
		$query = $this->db->get('ref_tempatpendidikan');
		return $query->result();
	}

	public function insert($data)
	{
		$this->db->set('nama_tempatpendidikan',$this->nama_tempatpendidikan);
		$this->db->set('status',$this->status);
		$this->db->set('level',$this->level);
		$this->db->insert('ref_tempatpendidikan');
	}

	public function select_by_id($id = NULL) {
        if(!empty($id)){
            $this->db->where('id_tempatpendidikan', $id);
        }        
        $query = $this->db->get('ref_tempatpendidikan');
        return $query->result();   
    }

	public function update()
	{
		$this->db->where('id_tempatpendidikan',$this->id_tempatpendidikan);
		$this->db->set('nama_tempatpendidikan',$this->nama_tempatpendidikan);
		$this->db->set('status',$this->status);
		$this->db->set('level',$this->level);
		$this->db->update('ref_tempatpendidikan');
	}
	public function set_by_id()
	{
		$this->db->where('id_tempatpendidikan',$this->id_tempatpendidikan);
		$query = $this->db->get('ref_tempatpendidikan');
		foreach ($query->result() as $row) {
			$this->nama_tempatpendidikan 	= $row->nama_tempatpendidikan;
			$this->status			= $row->status;
			$this->level			= $row->level;
	
		}
	}
	public function delete()
	{
		$this->db->where('id_tempatpendidikan',$this->id_tempatpendidikan);
		$this->db->delete('ref_tempatpendidikan');
	}
}
?>