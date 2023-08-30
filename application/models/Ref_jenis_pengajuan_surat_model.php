<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ref_jenis_pengajuan_surat_model extends CI_Model
{
	public function get_all()
	{
		$query = $this->db->get('ref_jenis_pengajuan_surat');
		return $query->result();
	}

	public function insert($data)
	{
		// $insert = array(	'nama_pp' => $data['nama'],
		// 					'status' => $data['status'],
		// 					'id_ref_jenis_pengajuan_surat' => ''
		// 					);
		$query = $this->db->insert('ref_jenis_pengajuan_surat',$data);
		$insert_id = $this->db->insert_id();
		if ($data['status']=="Y") {
			$this->db->where('id_ref_jenis_pengajuan_surat !=', $insert_id);
			$this->db->update('ref_jenis_pengajuan_surat',array('status' => 'N'));
		}
	}

	public function select_by_id($id = NULL) {
        if(!empty($id)){
            $this->db->where('id_ref_jenis_pengajuan_surat', $id);
        }        
        $query = $this->db->get('ref_jenis_pengajuan_surat');
        return $query->result();   
    }

    public function update($data,$id = NULL)
	{
		// $insert = array(	'nama_pp' => $data['nama'],
		// 					'status' => $data['status'],
		// 					);
        $this->db->where('id_ref_jenis_pengajuan_surat', $id);
        $query = $this->db->update('ref_jenis_pengajuan_surat',$data);
	}
	
	public function delete()
	{
		
		$this->db->where('id_ref_jenis_pengajuan_surat',$this->id_ref_jenis_pengajuan_surat);
		$this->db->delete('ref_jenis_pengajuan_surat');
		
		redirect('ref_jenis_pengajuan_surat');
		
	}
}
?>