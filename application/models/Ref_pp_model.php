<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ref_pp_model extends CI_Model
{
	public function get_all()
	{
		$query = $this->db->get('ref_pp');
		return $query->result();
	}

	public function insert($data)
	{
		// $insert = array(	'nama_pp' => $data['nama'],
		// 					'status' => $data['status'],
		// 					'id_pp' => ''
		// 					);
		$query = $this->db->insert('ref_pp',$data);
		$insert_id = $this->db->insert_id();
		if ($data['status']=="Y") {
			$this->db->where('id_pp !=', $insert_id);
			$this->db->update('ref_pp',array('status' => 'N'));
		}
	}

	public function select_by_id($id = NULL) {
        if(!empty($id)){
            $this->db->where('id_pp', $id);
        }        
        $query = $this->db->get('ref_pp');
        return $query->result();   
    }

    public function update($data,$id = NULL)
	{
		// $insert = array(	'nama_pp' => $data['nama'],
		// 					'status' => $data['status'],
		// 					);
        $this->db->where('id_pp', $id);
        $query = $this->db->update('ref_pp',$data);
		if ($data['status']=="Y") {
			$this->db->where('id_pp !=', $id);
			$this->db->update('ref_pp',array('status' => 'N'));
		}
	}
	
	public function delete()
	{
		
		$this->db->where('id_pp',$this->id_pp);
		$this->db->delete('ref_pp');
		
		redirect('ref_pp');
		
	}
}
?>