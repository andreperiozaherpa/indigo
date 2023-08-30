<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ref_golongan_model extends CI_Model
{
	public function get_all()
	{
		$query = $this->db->get('ref_golongan');
		return $query->result();
	}

	public function get_all_by_golongan($g)
	{
		$this->db->where('id_golongan >=',$g.'0');
		$this->db->where('id_golongan <=',$g.'9');
		$query = $this->db->get('ref_golongan');
		return $query->result();
	}

	public function insert($data)
	{
		// $insert = array(	'nama_golongan' => $data['nama'],
		// 					'status' => $data['status'],
		// 					'id_golongan' => ''
		// 					);
		$query = $this->db->insert('ref_golongan',$data);
	}

	public function select_by_id($id = NULL) {
        if(!empty($id)){
            $this->db->where('id_golongan', $id);
        }        
        $query = $this->db->get('ref_golongan');
        return $query->result();   
    }

    public function update($data,$id = NULL)
	{
		// $insert = array(	'nama_golongan' => $data['nama'],
		// 					'status' => $data['status'],
		// 					);
        $this->db->where('id_golongan', $id);
        $query = $this->db->update('ref_golongan',$data);
	}
	
	public function delete()
	{
		
		$this->db->where('id_golongan',$this->id_golongan);
		$this->db->delete('ref_golongan');
		
		redirect('ref_golongan');
		
	}
}
?>