<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ref_jenispenugasan_model extends CI_Model
{
	public function get_all()
	{
		$query = $this->db->get('ref_jenispenugasan');
		return $query->result();
	}

	public function insert($data)
	{
		$insert = array(	'nama_jenispenugasan' => $data['nama'],
							'status' => $data['status'],
							'id_jenispenugasan' => ''
							);
		$query = $this->db->insert('ref_jenispenugasan',$insert);
	}

	public function select_by_id($id = NULL) {
        if(!empty($id)){
            $this->db->where('id_jenispenugasan', $id);
        }        
        $query = $this->db->get('ref_jenispenugasan');
        return $query->result();   
    }

    public function update($data,$id = NULL)
	{
		$insert = array(	'nama_jenispenugasan' => $data['nama'],
							'status' => $data['status'],
							);
        $this->db->where('id_jenispenugasan', $id);
        $query = $this->db->update('ref_jenispenugasan',$insert);
	}
	
	public function delete()
	{
		$this->db->where('id_jenispenugasan',$this->id_jenispenugasan);
		$query = $this->db->delete('ref_jenispenugasan');	
		redirect('ref_jenispenugasan');
	}
}
?>