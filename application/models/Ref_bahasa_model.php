<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ref_bahasa_model extends CI_Model
{
	public function get_all()
	{
		$query = $this->db->get('ref_bahasa');
		return $query->result();
	}

	public function insert($data)
	{
		$insert = array(	'nama_bahasa' => $data['nama'],
							'status' => $data['status'],
							'id_bahasa' => ''
							);
		$query = $this->db->insert('ref_bahasa',$insert);
	}

	public function select_by_id($id = NULL) {
        if(!empty($id)){
            $this->db->where('id_bahasa', $id);
        }        
        $query = $this->db->get('ref_bahasa');
        return $query->result();   
    }

    public function update($data,$id = NULL)
	{
		$insert = array(	'nama_bahasa' => $data['nama'],
							'status' => $data['status'],
							);
        $this->db->where('id_bahasa', $id);
        $query = $this->db->update('ref_bahasa',$insert);
	}
	
	public function delete()
	{
		$this->db->where('id_bahasa',$this->id_bahasa);
		$query = $this->db->delete('ref_bahasa');	
		redirect('ref_bahasa');
	}
}
?>