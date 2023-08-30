<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ref_pekerjaan_model extends CI_Model
{

	public $nama_pekerjaan;
	public $uraian;

	public function get_all()
	{
		if($this->nama_pekerjaan!=''){
			$this->db->like('nama_pekerjaan',$this->nama_pekerjaan);
		}
		if($this->uraian!=''){
			$this->db->like('uraian',$this->uraian);
		}
		$query = $this->db->get('ref_pekerjaan');
		return $query->result();
	}

	public function insert($data)
	{
		$query = $this->db->insert('ref_pekerjaan',$data);
	}

	public function select_by_id($id = NULL) {
        if(!empty($id)){
            $this->db->where('id_pekerjaan', $id);
        }        
        $query = $this->db->get('ref_pekerjaan');
        return $query->row();   
    }

    public function update($data,$id = NULL)
	{
        $this->db->where('id_pekerjaan', $id);
        $query = $this->db->update('ref_pekerjaan',$data);
	}
	
	public function delete($id = NULL)
	{
		$this->db->where('id_pekerjaan',$id);
		$query = $this->db->delete('ref_pekerjaan');	
		redirect('ref_pekerjaan');
	}
}
?>