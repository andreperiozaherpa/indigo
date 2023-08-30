<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ref_gelarbelakang_model extends CI_Model
{
	public $id_gelarbelakang;
	public function get_all()
	{
		$query = $this->db->get('ref_gelarbelakang');
		return $query->result();
	}

	public function insert($data)
	{
		$insert = array(	'nama_gelarbelakang' => $data['nama'],
							'status' => $data['status'],
							'id_gelarbelakang' => ''
							);
		$query = $this->db->insert('ref_gelarbelakang',$insert);
	}

	public function select_by_id($id = NULL) {
        if(!empty($id)){
            $this->db->where('id_gelarbelakang', $id);
        }        
        $query = $this->db->get('ref_gelarbelakang');
        return $query->result();   
    }

    public function update($data,$id = NULL)
	{
		$insert = array(	'nama_gelarbelakang' => $data['nama'],
							'status' => $data['status'],
							);
        $this->db->where('id_gelarbelakang', $id);
        $query = $this->db->update('ref_gelarbelakang',$insert);
	}
	public function delete()
	{
		$this->db->where('id_gelarbelakang',$this->id_gelarbelakang);
		$this->db->delete('ref_gelarbelakang');
	}
}
?>