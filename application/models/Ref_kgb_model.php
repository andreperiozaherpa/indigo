<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ref_kgb_model extends CI_Model
{
	public function get_all()
	{
		// $this->db->join('ref_golongan', 'ref_golongan.id_golongan = ref_kgb.id_golongan', 'left');
		// $this->db->join('ref_pp', 'ref_pp.id_pp = ref_kgb.id_pp', 'left');
		$query = $this->db->get('ref_kgb');
		return $query->result();
	}

	public function get_item($id_pp,$mkg,$id_golongan)
	{
		$this->db->select('id_kgb, gaji_pokok');
		$this->db->where('id_pp',$id_pp);
		$this->db->where('mkg',$mkg);
		$this->db->where('id_golongan',$id_golongan);
		$query = $this->db->get('ref_kgb')->row();
		if ($query) {
			$return['id_kgb'] = $query->id_kgb;
			$return['gaji_pokok'] = (@$query->gaji_pokok>0) ? $query->gaji_pokok : "";
		} else {
			$return['id_kgb'] = "";
			$return['gaji_pokok'] = "";
		}
		// $return->gaji_pokok = (@$query->gaji_pokok>0) ? $query->gaji_pokok : "";
		return $return;
	}

	public function get_max_mkg_by_pp($id_pp)
	{
		$this->db->select_max('mkg');
		$this->db->where('id_pp',$id_pp);
		$query = $this->db->get('ref_kgb')->row();
		return $query->mkg;
	}

	public function get_max_mkg_by_pp_golongan($id_pp,$g)
	{
		$this->db->select_max('mkg');
		$this->db->where('id_pp',$id_pp);
		$this->db->where('id_golongan >=',$g.'0');
		$this->db->where('id_golongan <=',$g.'9');
		$query = $this->db->get('ref_kgb')->row();
		return $query->mkg;
	}

	public function insert($data)
	{
		// $insert = array(	'nama_kgb' => $data['nama'],
		// 					'status' => $data['status'],
		// 					'id_kgb' => ''
		// 					);

		$this->db->where('id_pp',$data['id_pp']);
		$this->db->where('mkg',$data['mkg']);
		$this->db->where('id_golongan',$data['id_golongan']);
		$get = $this->db->get('ref_kgb')->num_rows();

		if ($get>0) {
			return false;
		} else {
			$query = $this->db->insert('ref_kgb',$data);
			return $query;
		}

		
	}

	public function select_by_id($id = NULL) {
        if(!empty($id)){
            $this->db->where('id_kgb', $id);
        }        
        $query = $this->db->get('ref_kgb');
        return $query->result();   
    }

    public function update($data,$id = NULL)
	{
		// $insert = array(	'nama_kgb' => $data['nama'],
		// 					'status' => $data['status'],
		// 					);
        $this->db->where('id_kgb', $id);
        $query = $this->db->update('ref_kgb',$data);
	}
	
	public function delete()
	{
		
		$this->db->where('id_kgb',$this->id_kgb);
		$this->db->delete('ref_kgb');
		
		redirect('ref_kgb');
		
	}
}
?>