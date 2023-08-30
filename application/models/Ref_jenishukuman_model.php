<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ref_jenishukuman_model extends CI_Model
{
	public function get_all($status=null)
	{
		if ($status!=null) $this->db->where("status",$status);
		$query = $this->db->get('ref_jenishukuman');
		return $query->result();
	}

	public function insert($data)
	{
		$insert = array(	'nama_jenishukuman' => $data['nama'],
							'status' => $data['status'],
							'id_jenishukuman' => ''
							);
		$query = $this->db->insert('ref_jenishukuman',$insert);
	}

	public function select_by_id($id = NULL) {
        if(!empty($id)){
            $this->db->where('id_jenishukuman', $id);
        }        
        $query = $this->db->get('ref_jenishukuman');
        return $query->result();   
    }

    public function update($data,$id = NULL)
	{
		$insert = array(	'nama_jenishukuman' => $data['nama'],
							'status' => $data['status'],
							);
        $this->db->where('id_jenishukuman', $id);
        $query = $this->db->update('ref_jenishukuman',$insert);
	}
	
	public function delete()
	{
		$this->db->where('id_jenishukuman',$this->id_jenishukuman);
		$query = $this->db->delete('ref_jenishukuman');	
		redirect('ref_hukumandisiplin');
	}
}
?>