<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ref_bahasa_asing_model extends CI_Model
{
	public function get_all()
	{
		$query = $this->db->get('ref_bahasa_asing');
		return $query->result();
	}

	public function insert($data)
	{
		$insert = array(	'nama_bahasa_asing' => $data['nama'],
							'status' => $data['status'],
							'id_bahasa_asing' => ''
							);
		$query = $this->db->insert('ref_bahasa_asing',$insert);
	}

	public function select_by_id($id = NULL) {
        if(!empty($id)){
            $this->db->where('id_bahasa_asing', $id);
        }        
        $query = $this->db->get('ref_bahasa_asing');
        return $query->result();   
    }

    public function update($data,$id = NULL)
	{
		$insert = array(	'nama_bahasa_asing' => $data['nama'],
							'status' => $data['status'],
							);
        $this->db->where('id_bahasa_asing', $id);
        $query = $this->db->update('ref_bahasa_asing',$insert);
	}
	
	public function delete()
	{
		$this->db->where('id_bahasa_asing',$this->id_bahasa_asing);
		$query = $this->db->delete('ref_bahasa_asing');	
		redirect('ref_bahasa_asing');
	}
}
?>