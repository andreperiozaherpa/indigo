<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ref_pendidikan_model extends CI_Model
{
	public $id_jenjangpendidikan;
	public $nama_jenjangpendidikan;
	public $status;
	public $keterangan;

	public $level;
	
	public $arr_level = array(
		1 => 'Dasar',
		2 => 'Menengah Pertama',
		3 => 'Menengah Atas',
		4 => 'Perguruan  Tinggi'
	);
	public function get_all()
	{
		$query = $this->db->get('ref_jenjangpendidikan');
		return $query->result();
	}

	public function insert($data)
	{
		$insert = array(	'nama_jenjangpendidikan' => $data['nama'],
							'keterangan' => $data['keterangan'],
							'status' => $data['status'],
							'level' => $data['level']
							);
		$query = $this->db->insert('ref_jenjangpendidikan',$insert);
	}

	public function select_by_id($id = NULL) {
        if(!empty($id)){
            $this->db->where('id_jenjangpendidikan', $id);
        }        
        $query = $this->db->get('ref_jenjangpendidikan');
        return $query->result();   
    }

	public function update()
	{
		$this->db->where('id_jenjangpendidikan',$this->id_jenjangpendidikan);
		$this->db->set('nama_jenjangpendidikan',$this->nama_jenjangpendidikan);
		$this->db->set('keterangan',$this->keterangan);
		$this->db->set('status',$this->status);
		$this->db->set('level',$this->level);
		$this->db->update('ref_jenjangpendidikan');
	}
	public function set_by_id()
	{
		$this->db->where('id_jenjangpendidikan',$this->id_jenjangpendidikan);
		$query = $this->db->get('ref_jenjangpendidikan');
		foreach ($query->result() as $row) {
			$this->nama_jenjangpendidikan 	= $row->nama_jenjangpendidikan;
			$this->status			= $row->status;
			$this->keterangan			= $row->keterangan;
			$this->level			= $row->level;
	
		}
	}
	public function delete()
	{
		$this->db->where('id_jenjangpendidikan',$this->id_jenjangpendidikan);
		$this->db->delete('ref_jenjangpendidikan');
	}
	public function get_sekolah($id_jenjangpendidikan){
		$this->id_jenjangpendidikan = $id_jenjangpendidikan;
		$this->set_by_id();
		
		$this->db->where("level",$this->level);
		$query = $this->db->get('ref_tempatpendidikan');
		return $query->result();
	}

	
}
?>