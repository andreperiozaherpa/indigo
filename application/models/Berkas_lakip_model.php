<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Berkas_lakip_model extends CI_Model
{

	public $tahun_berkas_lakip;
	public $id_skpd;
	public $nama_lengkap;
	public $nip;

	public function get_all()
	{
		if($this->tahun_berkas_lakip!=''){
			$this->db->where('tahun_berkas_lakip',$this->tahun_berkas_lakip);
		}
		if($this->id_skpd!=''){
			$this->db->where('berkas_lakip.id_skpd',$this->id_skpd);
		}
		// $this->db->join('ref_renstra','ref_renstra.id_renstra = berkas_lakip.id_renstra');
		$this->db->join('ref_skpd','ref_skpd.id_skpd = berkas_lakip.id_skpd');
		$query = $this->db->get('berkas_lakip');
		return $query->result();
	}

	public function get_all_by_year($tahun)
	{
		if($tahun!=''){
			$this->db->where('tahun_berkas_lakip',$tahun);
		}
		// $this->db->join('ref_renstra','ref_renstra.id_renstra = berkas_lakip.id_renstra');
		$this->db->join('ref_skpd','ref_skpd.id_skpd = berkas_lakip.id_skpd');
		$query = $this->db->get('berkas_lakip');
		return $query->result();
	}

	public function get_all_pk()
	{
		if($this->tahun_berkas_lakip!=''){
			$this->db->where('berkas_lakip.tahun_berkas_lakip',$this->tahun_berkas_lakip);
		}
		if($this->id_skpd!=''){
			$this->db->where('berkas_lakip.id_skpd',$this->id_skpd);
		}
		if($this->nama_lengkap!=''){
			$this->db->like('pegawai.nama_lengkap',$this->nama_lengkap);
		}
		if($this->nip!=''){
			$this->db->like('pegawai.nip',$this->nip);
		}
		$this->db->where('berkas_lakip.pk !=','');
		// $this->db->join('ref_renstra','ref_renstra.id_renstra = berkas_lakip.id_renstra');
		$this->db->join('ref_skpd','ref_skpd.id_skpd = berkas_lakip.id_skpd');
		$this->db->join('pegawai','berkas_lakip.id_skpd = pegawai.id_skpd');
		$query = $this->db->get('berkas_lakip');
		return $query->result();
	}

	public function get_all_pk_pegawai()
	{
		if($this->tahun_berkas_lakip!=''){
			$this->db->where('berkas_lakip.tahun_berkas_lakip',$this->tahun_berkas_lakip);
		}
		if($this->id_skpd!=''){
			$this->db->where('berkas_lakip.id_skpd',$this->id_skpd);
		}
		// $this->db->join('ref_renstra','ref_renstra.id_renstra = berkas_lakip.id_renstra');
		$this->db->join('ref_skpd','ref_skpd.id_skpd = pegawai.id_skpd', 'left');
		$this->db->join('berkas_lakip','berkas_lakip.id_skpd = pegawai.id_skpd', 'left');
		$query = $this->db->get('pegawai');
		return $query->result();
	}


	public function insert($data)
	{
		$query = $this->db->insert('berkas_lakip',$data);
		return $query;
	}

	public function select_by_id($id = NULL) {
		if(!empty($id)){
			$this->db->where('id_berkas_lakip', $id);
		}        
		$query = $this->db->get('berkas_lakip');
		return $query->row();   
	}

	public function select_by_id_skpd($id = NULL) {
		if(!empty($id)){
			$this->db->where('ref_skpd.id_skpd', $id);
		}        
		// $this->db->where('ref_jabatan.level_jabatan', 1);
		$this->db->order_by('tahun_berkas_lakip', 'DESC');
		$this->db->join('berkas_lakip','ref_skpd.id_skpd = berkas_lakip.id_skpd');
		// $this->db->join('pegawai','ref_skpd.id_skpd = pegawai.id_skpd');
		// $this->db->join('ref_jabatan','ref_jabatan.id_jabatan = pegawai.id_jabatan');
		$query = $this->db->get('ref_skpd');
		return $query->result();   
	}

	public function select_row($data)
	{
		$this->db->where('id_skpd',$data['id_skpd']);
		$this->db->where('tahun_berkas_lakip',$data['tahun_berkas_lakip']);
		$query = $this->db->get('berkas_lakip')->row();
		return $query; 
	}

	public function update($data,$id = NULL)
	{
		$this->db->where('id_berkas_lakip', $id);
		$query = $this->db->update('berkas_lakip',$data);

		$this->db->where('id_berkas_lakip',$id);
		$get = $this->db->get('berkas_lakip')->row();
		return $get->id_skpd;
	}

	public function check_taken($data)
	{
		$this->db->where('id_skpd',$data['id_skpd']);
		$this->db->where('tahun_berkas_lakip',$data['tahun_berkas_lakip']);
		$get = $this->db->get('berkas_lakip')->row();
		return $get->id_skpd;
	}
	
	public function delete($id = NULL)
	{
		$this->db->where('id_berkas_lakip',$id);
		$get = $this->db->get('berkas_lakip')->row();
		if ($get->renstra) unlink('./data/berkas_lakip/'.$get->renstra);
		if ($get->rkt) unlink('./data/berkas_lakip/'.$get->rkt);
		if ($get->pk) unlink('./data/berkas_lakip/'.$get->pk);
		if ($get->lkj) unlink('./data/berkas_lakip/'.$get->lkj);
		$this->db->where('id_berkas_lakip',$id);
		$query = $this->db->delete('berkas_lakip');	
		// redirect('berkas_lakip');
	}
	
	public function delete_berkas($id = NULL, $col = NULL)
	{
		$this->db->where('id_berkas_lakip',$id);
		$get = $this->db->get('berkas_lakip')->row();
		unlink('./data/berkas_lakip/'.$get->$col);
		$this->db->where('id_berkas_lakip',$id);
		$this->db->set($col, '');
		$query = $this->db->update('berkas_lakip');	
		// redirect('berkas_lakip');
	}

	public function get_tahun(){
		$this->db->distinct();

		$this->db->select('tahun_berkas_lakip');
		$this->db->order_by('tahun_berkas_lakip', 'ASC');
		$query = $this->db->get('berkas_lakip');
		return $query->result();
	}
}
?>