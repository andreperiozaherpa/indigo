<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ref_absensi_model extends CI_Model
{

	public $nama_absensi;
	public $uraian;

	public function get_all()
	{
		if($this->nama_absensi!=''){
			$this->db->like('nama_absensi',$this->nama_absensi);
		}
		if($this->uraian!=''){
			$this->db->like('uraian',$this->uraian);
		}
		$query = $this->db->get('ref_absensi');
		return $query->result();
	}

	public function insert($data)
	{
		$query = $this->db->insert('ref_absensi',$data);
	}

	public function select_by_id($id = NULL) {
        if(!empty($id)){
            $this->db->where('id_ref_absensi', $id);
        }        
        $query = $this->db->get('ref_absensi');
        return $query->row();   
    }

    public function update($data,$id = NULL)
	{
        $this->db->where('id_ref_absensi', $id);
        $query = $this->db->update('ref_absensi',$data);
	}
	
	public function delete($id = NULL)
	{
		$this->db->where('id_ref_absensi',$id);
		$query = $this->db->delete('ref_absensi');	
		redirect('ref_absensi');
	}
}
?>