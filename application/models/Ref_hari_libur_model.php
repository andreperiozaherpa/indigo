<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ref_hari_libur_model extends CI_Model
{

	public $tanggal_awal;
	public $tanggal_akhir;
	public $keterangan;

	public function get_all()
	{
		if($this->tanggal_awal!=''){
			$this->db->where('tanggal_libur >=', $this->tanggal_awal);
		}
		if($this->tanggal_akhir!=''){
			$this->db->where('tanggal_libur <=', $this->tanggal_akhir);
		}
		if($this->keterangan!=''){
			$this->db->like('keterangan',$this->keterangan);
		}
		$query = $this->db->get('ref_hari_libur');
		return $query->result();
	}

	public function insert($data)
	{
		$query = $this->db->insert('ref_hari_libur',$data);
	}

	public function select_by_id($id = NULL) {
        if(!empty($id)){
            $this->db->where('id_hari_libur', $id);
        }        
        $query = $this->db->get('ref_hari_libur');
        return $query->row();   
    }

    public function update($data,$id = NULL)
	{
        $this->db->where('id_hari_libur', $id);
        $query = $this->db->update('ref_hari_libur',$data);
	}
	
	public function delete($id = NULL)
	{
		$this->db->where('id_hari_libur',$id);
		$query = $this->db->delete('ref_hari_libur');	
		redirect('ref_hari_libur');
	}
}
?>