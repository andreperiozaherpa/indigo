<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Berkas_unit_kerja_model extends CI_Model
{

	public $tahun_berkas;
	public $id_unit_kerja;
	public $nama_lengkap;
	public $nip;

	public function get_all()
	{
		if($this->tahun_berkas!=''){
			$this->db->where('tahun_berkas',$this->tahun_berkas);
		}
		if($this->id_unit_kerja!=''){
			$this->db->where('berkas_unit_kerja.id_unit_kerja',$this->id_unit_kerja);
		}
		// $this->db->join('ref_renstra','ref_renstra.id_renstra = berkas_unit_kerja.id_renstra');
		$this->db->join('ref_unit_kerja','ref_unit_kerja.id_unit_kerja = berkas_unit_kerja.id_unit_kerja');
		$query = $this->db->get('berkas_unit_kerja');
		return $query->result();
	}

	public function get_all_pk()
	{
		if($this->tahun_berkas!=''){
			$this->db->where('berkas_unit_kerja.tahun_berkas',$this->tahun_berkas);
		}
		if($this->id_unit_kerja!=''){
			$this->db->where('berkas_unit_kerja.id_unit_kerja',$this->id_unit_kerja);
		}
		if($this->nama_lengkap!=''){
			$this->db->like('pegawai.nama_lengkap',$this->nama_lengkap);
		}
		if($this->nip!=''){
			$this->db->like('pegawai.nip',$this->nip);
		}
		$this->db->where('berkas_unit_kerja.pk !=','');
		// $this->db->join('ref_renstra','ref_renstra.id_renstra = berkas_unit_kerja.id_renstra');
		$this->db->join('ref_unit_kerja','ref_unit_kerja.id_unit_kerja = berkas_unit_kerja.id_unit_kerja');
		$this->db->join('pegawai','berkas_unit_kerja.id_unit_kerja = pegawai.id_unit_kerja');
		$query = $this->db->get('berkas_unit_kerja');
		return $query->result();
	}

	public function get_all_pk_pegawai()
	{
		if($this->tahun_berkas!=''){
			$this->db->where('berkas_unit_kerja.tahun_berkas',$this->tahun_berkas);
		}
		if($this->id_unit_kerja!=''){
			$this->db->where('berkas_unit_kerja.id_unit_kerja',$this->id_unit_kerja);
		}
		// $this->db->join('ref_renstra','ref_renstra.id_renstra = berkas_unit_kerja.id_renstra');
		$this->db->join('ref_unit_kerja','ref_unit_kerja.id_unit_kerja = pegawai.id_unit_kerja', 'left');
		$this->db->join('berkas_unit_kerja','berkas_unit_kerja.id_unit_kerja = pegawai.id_unit_kerja', 'left');
		$query = $this->db->get('pegawai');
		return $query->result();
	}


	public function insert($data)
	{
		$query = $this->db->insert('berkas_unit_kerja',$data);
		return $query;
	}

	public function select_by_id($id = NULL) {
		if(!empty($id)){
			$this->db->where('id_berkas', $id);
		}        
		$query = $this->db->get('berkas_unit_kerja');
		return $query->row();   
	}

	public function select_by_id_unit_kerja($id = NULL) {
		if(!empty($id)){
			$this->db->where('ref_unit_kerja.id_unit_kerja', $id);
		}        
		$this->db->where('ref_jabatan.level_jabatan', 1);
		$this->db->order_by('tahun_berkas', 'DESC');
		$this->db->join('berkas_unit_kerja','ref_unit_kerja.id_unit_kerja = berkas_unit_kerja.id_unit_kerja');
		$this->db->join('pegawai','ref_unit_kerja.id_unit_kerja = pegawai.id_unit_kerja');
		$this->db->join('ref_jabatan','ref_jabatan.id_jabatan = pegawai.id_jabatan');
		$query = $this->db->get('ref_unit_kerja');
		return $query->result();   
	}

	public function select_row($data)
	{
		$this->db->where('id_unit_kerja',$data['id_unit_kerja']);
		$this->db->where('tahun_berkas',$data['tahun_berkas']);
		$query = $this->db->get('berkas_unit_kerja')->row();
		return $query; 
	}

	public function update($data,$id = NULL)
	{
		$this->db->where('id_berkas', $id);
		$query = $this->db->update('berkas_unit_kerja',$data);

		$this->db->where('id_berkas',$id);
		$get = $this->db->get('berkas_unit_kerja')->row();
		return $get->id_unit_kerja;
	}

	public function check_taken($data)
	{
		$this->db->where('id_unit_kerja',$data['id_unit_kerja']);
		$this->db->where('tahun_berkas',$data['tahun_berkas']);
		$get = $this->db->get('berkas_unit_kerja')->row();
		return $get->id_unit_kerja;
	}
	
	public function delete($id = NULL)
	{
		$this->db->where('id_berkas',$id);
		$get = $this->db->get('berkas_unit_kerja')->row();
		if ($get->renstra) unlink('./data/berkas_unit_kerja/'.$get->renstra);
		if ($get->rkt) unlink('./data/berkas_unit_kerja/'.$get->rkt);
		if ($get->pk) unlink('./data/berkas_unit_kerja/'.$get->pk);
		if ($get->lkj) unlink('./data/berkas_unit_kerja/'.$get->lkj);
		$this->db->where('id_berkas',$id);
		$query = $this->db->delete('berkas_unit_kerja');	
		// redirect('berkas_unit_kerja');
	}
	
	public function delete_berkas($id = NULL, $col = NULL)
	{
		$this->db->where('id_berkas',$id);
		$get = $this->db->get('berkas_unit_kerja')->row();
		unlink('./data/berkas_unit_kerja/'.$get->$col);
		$this->db->where('id_berkas',$id);
		$this->db->set($col, '');
		$query = $this->db->update('berkas_unit_kerja');	
		// redirect('berkas_unit_kerja');
	}

	public function get_tahun(){
		$this->db->distinct();

		$this->db->select('tahun_berkas');
		$this->db->order_by('tahun_berkas', 'ASC');
		$query = $this->db->get('berkas_unit_kerja');
		return $query->result();
	}
}
?>