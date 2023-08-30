<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ref_jenispenghargaan_model extends CI_Model
{
	public function get_all()
	{
		$query = $this->db->get('ref_jenispenghargaan');
		return $query->result();
	}

	public function insert($data)
	{
		$insert = array(	'nama_jenispenghargaan' => $data['nama'],
							'status' => $data['status'],
							'id_jenispenghargaan' => ''
							);
		$query = $this->db->insert('ref_jenispenghargaan',$insert);
	}

	public function select_by_id($id = NULL) {
        if(!empty($id)){
            $this->db->where('id_jenispenghargaan', $id);
        }        
        $query = $this->db->get('ref_jenispenghargaan');
        return $query->result();   
    }

    public function update($data,$id = NULL)
	{
		$insert = array(	'nama_jenispenghargaan' => $data['nama'],
							'status' => $data['status'],
							);
        $this->db->where('id_jenispenghargaan', $id);
        $query = $this->db->update('ref_jenispenghargaan',$insert);
	}
	
	public function delete()
	{
		$this->db->where('id_jenispenghargaan',$this->id_jenispenghargaan);
		$query = $this->db->delete('ref_jenispenghargaan');	
		redirect('ref_penghargaan');
	}
}
?>