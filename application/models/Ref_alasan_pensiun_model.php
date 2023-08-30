<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ref_alasan_pensiun_model extends CI_Model
{
	public function get_all()
	{
		$query = $this->db->get('ref_alasan_pensiun');
		return $query->result();
	}

	public function get_persyaratan_by_id($id_persyaratan_pensiun){
		$this->db->where('id_persyaratan_pensiun',$id_persyaratan_pensiun);
		$query = $this->db->get('ref_persyaratan_pensiun');
		return $query->row();
	}

	public function insert($data)
	{
		$query = $this->db->insert('ref_alasan_pensiun',$data);
	}

	public function select_by_id($id = NULL) {
        if(!empty($id)){
            $this->db->where('id_alasan_pensiun', $id);
        }        
        $query = $this->db->get('ref_alasan_pensiun');
        return $query->result();   
    }

    public function update($data,$id = NULL)
	{
        $this->db->where('id_alasan_pensiun', $id);
        $query = $this->db->update('ref_alasan_pensiun',$data);
	}
	
	public function delete()
	{
		$this->db->where('id_alasan_pensiun',$this->id_alasan_pensiun);
		$query = $this->db->delete('ref_alasan_pensiun');	
		redirect('ref_diklat');
	}
}
?>