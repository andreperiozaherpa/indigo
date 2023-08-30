<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ref_gelardepan_model extends CI_Model
{
	public $id_gelardepan;
	public function get_all()
	{
		$query = $this->db->get('ref_gelardepan');
		return $query->result();
	}

	public function insert($data)
	{
		$insert = array(	'nama_gelardepan' => $data['nama'],
							'status' => $data['status'],
							'id_gelardepan' => ''
							);
		$query = $this->db->insert('ref_gelardepan',$insert);
	}

	public function select_by_id($id = NULL) {
        if(!empty($id)){
            $this->db->where('id_gelardepan', $id);
        }        
        $query = $this->db->get('ref_gelardepan');
        return $query->result();   
    }

    public function update($data,$id = NULL)
	{
		$insert = array(	'nama_gelardepan' => $data['nama'],
							'status' => $data['status'],
							);
        $this->db->where('id_gelardepan', $id);
        $query = $this->db->update('ref_gelardepan',$insert);
	}
	public function delete()
	{
		$this->db->where('id_gelardepan',$this->id_gelardepan);
		$this->db->delete('ref_gelardepan');
	}
}
?>