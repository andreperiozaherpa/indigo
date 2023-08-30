<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ref_pangkat_model extends CI_Model
{
	public function get_all()
	{
		$query = $this->db->get('ref_pangkat');
		return $query->result();
	}

	public function insert($data)
	{
		$insert = array(	'nama_pangkat' => $data['nama'],
							'status' => $data['status'],
							'id_pangkat' => ''
							);
		$query = $this->db->insert('ref_pangkat',$insert);
	}

	public function select_by_id($id = NULL) {
        if(!empty($id)){
            $this->db->where('id_pangkat', $id);
        }        
        $query = $this->db->get('ref_pangkat');
        return $query->result();   
    }

    public function update($data,$id = NULL)
	{
		$insert = array(	'nama_pangkat' => $data['nama'],
							'status' => $data['status'],
							);
        $this->db->where('id_pangkat', $id);
        $query = $this->db->update('ref_pangkat',$insert);
	}
	public function delete()
	{
		
		$this->db->where('id_pangkat',$this->id_pangkat);
		$this->db->delete('ref_pangkat');
		
		redirect('ref_pangkat');
	}
	
}
?>