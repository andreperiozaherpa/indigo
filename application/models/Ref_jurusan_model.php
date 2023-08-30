<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ref_jurusan_model extends CI_Model
{
	public function get_all()
	{
		$query = $this->db->get('ref_jurusan');
		return $query->result();
	}

	public function get_for_page($limit=null,$offset=null)
	{
		if ($limit!=null) $this->db->limit($limit,$offset);
		$this->db->order_by('nama_jurusan','ASC');
		$query = $this->db->get('ref_jurusan');
		return $query->result();
	}
	public function insert($data)
	{
		$insert = array(	'nama_jurusan' => $data['nama'],
							'status' => $data['status'],
							'id_jurusan' => ''
							);
		$query = $this->db->insert('ref_jurusan',$insert);
	}

	public function select_by_id($id = NULL) {
        if(!empty($id)){
            $this->db->where('id_jurusan', $id);
        }        
        $query = $this->db->get('ref_jurusan');
        return $query->result();   
    }

    public function update($data,$id = NULL)
	{
		$insert = array(	'nama_jurusan' => $data['nama'],
							'status' => $data['status'],
							);
        $this->db->where('id_jurusan', $id);
        $query = $this->db->update('ref_jurusan',$insert);
	}
	
	public function delete()
	{
		$this->db->where('id_jurusan',$this->id_jurusan);
		$query = $this->db->delete('ref_jurusan');	
		redirect('ref_jurusan');
	}
}
?>