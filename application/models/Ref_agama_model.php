<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ref_agama_model extends CI_Model
{
	public function get_all()
	{
		$query = $this->db->get('ref_agama');
		return $query->result();
	}

	public function insert($data)
	{
		$insert = array(	'nama_agama' => $data['nama'],
							'status' => $data['status'],
							'id_agama' => ''
							);
		$query = $this->db->insert('ref_agama',$insert);
	}

	public function select_by_id($id = NULL) {
        if(!empty($id)){
            $this->db->where('id_agama', $id);
        }        
        $query = $this->db->get('ref_agama');
        return $query->result();   
    }

    public function update($data,$id = NULL)
	{
		$insert = array(	'nama_agama' => $data['nama'],
							'status' => $data['status'],
							);
        $this->db->where('id_agama', $id);
        $query = $this->db->update('ref_agama',$insert);
	}
	
	public function delete()
	{
		
		$this->db->where('id_agama',$this->id_agama);
		$this->db->delete('ref_agama');
		
		redirect('ref_agama');
		
	}
}
?>