<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ref_statusmenikah_model extends CI_Model
{
	public function get_all()
	{
		$query = $this->db->get('ref_statusmenikah');
		return $query->result();
	}

	public function insert($data)
	{
		$insert = array(	'nama_statusmenikah' => $data['nama'],
							'status' => $data['status'],
							'id_statusmenikah' => ''
							);
		$query = $this->db->insert('ref_statusmenikah',$insert);
	}

	public function select_by_id($id = NULL) {
        if(!empty($id)){
            $this->db->where('id_statusmenikah', $id);
        }        
        $query = $this->db->get('ref_statusmenikah');
        return $query->result();   
    }

    public function update($data,$id = NULL)
	{
		$insert = array(	'nama_statusmenikah' => $data['nama'],
							'status' => $data['status'],
							);
        $this->db->where('id_statusmenikah', $id);
        $query = $this->db->update('ref_statusmenikah',$insert);
	}
	
	public function delete()
	{
		
		$this->db->where('id_statusmenikah',$this->id_statusmenikah);
		$this->db->delete('ref_statusmenikah');
		
		redirect('ref_statusmenikah');
	}
}
?>