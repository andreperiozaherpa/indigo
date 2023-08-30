<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ref_jenisdiklat_model extends CI_Model
{
	public function get_all()
	{
		$query = $this->db->get('ref_jenisdiklat');
		return $query->result();
	}

	public function insert($data)
	{
		$insert = array(	'nama_jenisdiklat' => $data['nama'],
							'status' => $data['status'],
							'id_jenisdiklat' => ''
							);
		$query = $this->db->insert('ref_jenisdiklat',$insert);
	}

	public function select_by_id($id = NULL) {
        if(!empty($id)){
            $this->db->where('id_jenisdiklat', $id);
        }        
        $query = $this->db->get('ref_jenisdiklat');
        return $query->result();   
    }

    public function update($data,$id = NULL)
	{
		$insert = array(	'nama_jenisdiklat' => $data['nama'],
							'status' => $data['status'],
							);
        $this->db->where('id_jenisdiklat', $id);
        $query = $this->db->update('ref_jenisdiklat',$insert);
	}
	
	public function delete()
	{
		$this->db->where('id_jenisdiklat',$this->id_jenisdiklat);
		$query = $this->db->delete('ref_jenisdiklat');	
		redirect('ref_diklat');
	}
}
?>