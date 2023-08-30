<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ref_jenisseminar_model extends CI_Model
{
	public function get_all()
	{
		$query = $this->db->get('ref_jenisseminar');
		return $query->result();
	}

	public function insert($data)
	{
		$insert = array(	'nama_jenisseminar' => $data['nama'],
							'status' => $data['status'],
							'id_jenisseminar' => ''
							);
		$query = $this->db->insert('ref_jenisseminar',$insert);
	}

	public function select_by_id($id = NULL) {
        if(!empty($id)){
            $this->db->where('id_jenisseminar', $id);
        }        
        $query = $this->db->get('ref_jenisseminar');
        return $query->result();   
    }

    public function update($data,$id = NULL)
	{
		$insert = array(	'nama_jenisseminar' => $data['nama'],
							'status' => $data['status'],
							);
        $this->db->where('id_jenisseminar', $id);
        $query = $this->db->update('ref_jenisseminar',$insert);
	}
	
	public function delete()
	{
		$this->db->where('id_jenisseminar',$this->id_jenisseminar);
		$query = $this->db->delete('ref_jenisseminar');	
		redirect('ref_seminar');
	}
}
?>