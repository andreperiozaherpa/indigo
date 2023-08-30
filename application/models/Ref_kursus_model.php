<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ref_kursus_model extends CI_Model
{
	public function get_all()
	{
		$query = $this->db->get('ref_kursus');
		return $query->result();
	}

	public function insert($data)
	{
		$insert = array(	'nama_kursus' => $data['nama'],
							'status' => $data['status'],
							'id_kursus' => ''
							);
		$query = $this->db->insert('ref_kursus',$insert);
	}

	public function select_by_id($id = NULL) {
        if(!empty($id)){
            $this->db->where('id_kursus', $id);
        }        
        $query = $this->db->get('ref_kursus');
        return $query->result();   
    }

    public function update($data,$id = NULL)
	{
		$insert = array(	'nama_kursus' => $data['nama'],
							'status' => $data['status'],
							);
        $this->db->where('id_kursus', $id);
        $query = $this->db->update('ref_kursus',$insert);
	}
	
	public function delete()
	{
		$this->db->where('id_kursus',$this->id_kursus);
		$query = $this->db->delete('ref_kursus');	
		redirect('ref_kursus');
	}
}
?>