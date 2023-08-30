<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ref_kegiatan_model extends CI_Model
{
	public $id_kegiatan;
	public $nama_kegiatan;
	public $status;


	//public function get_all()
	//{
	//	$query = $this->db->get('ref_kegiatan');
	//	return $query->result();
	//}

	public function get_all()
	{
		if ($this->status!="") $this->db->where('status',$this->status);
		$query = $this->db->get('ref_kegiatan');
		return $query->result();
	}

	public function insert($data)
	{
		$insert = array(	'nama_kegiatan' => $data['nama'],
							'status' => $data['status']
							);
		$query = $this->db->insert('ref_kegiatan',$insert);
	}

	public function select_by_id($id = NULL) {
        if(!empty($id)){
            $this->db->where('id_kegiatan', $id);
        }        
        $query = $this->db->get('ref_kegiatan');
        return $query->result();   
    }

	public function update($data,$id = NULL)
	{
		$insert = array(	'nama_kegiatan' => $data['nama'],
							'status' => $data['status'],
							);
        $this->db->where('id_kegiatan', $id);
        $query = $this->db->update('ref_kegiatan',$insert);
	}
	
	public function set_by_id()
	{
		$this->db->where('id_kegiatan',$this->id_kegiatan);
		$query = $this->db->get('ref_kegiatan');
		foreach ($query->result() as $row) {
			$this->nama_kegiatan 	= $row->nama_kegiatan;
			$this->status			= $row->status;
	
		}
	}
	public function delete()
	{
		$this->db->where('id_kegiatan',$this->id_kegiatan);
		$this->db->delete('ref_kegiatan');
	}
	
}
?>