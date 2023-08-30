<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ref_rka_model extends CI_Model
{

	public $tahun_rkt;
	public $id_unit_kerja;

	public function get_all()
	{
		/*if($this->tahun_rkt!=''){
			$this->db->where('tahun_rkt',$this->tahun_rkt);
		}*/
		if($this->id_unit_kerja!==''&&!empty($this->id_unit_kerja)){
			$this->db->where('ref_rka.id_unit_kerja',$this->id_unit_kerja);
		}
		// $this->db->join('ref_renstra','ref_renstra.id_renstra = ref_rka.id_renstra');
		$this->db->join('ref_unit_kerja','ref_unit_kerja.id_unit_kerja = ref_rka.id_unit_kerja');
		$query = $this->db->get('ref_rka')->result();
		foreach($query as $q){
			$q->type = 'user';
		}
		return $query;
	}

	public function get_all_master($level='',$tahun=null)
	{
		if($tahun!=null){
			$this->db->where('tahun',$tahun);
		}
		$query = $this->db->get('master_ref_rka')->result();
		foreach($query as $q){
			$q->nama_unit_kerja = '-';
			$q->type = 'master';
			// if($level!=''&&!empty($level)){
			$kode = $q->kode_rka;
			$ex = explode('.', $kode);
			$c = count($ex);
			if($c==1){
				if(strlen($kode)==3){
					if($level==3){
						$q->view_by = 3;
					}elseif($level==4){
						$q->view_by = 4;
					}
				}else{
					$q->view_by = 1;
				}
			}elseif($c==3){
				if($kode[0]==1){
					$q->view_by = 0;
				}else{
					$q->view_by = 2;
				}
			}else{
				$q->view_by = 2;
			}
			// }
		}
		return $query;
	}

	public function insert($data)
	{
		$query = $this->db->insert('ref_rka',$data);
		return $query;
	}


	public function insert_master($data)
	{
		$query = $this->db->insert('master_ref_rka',$data);
		return $query;
	}
	public function select_by_id($id = NULL) {
		if(!empty($id)){
			$this->db->where('id_rka', $id);
		}        
		$query = $this->db->get('ref_rka');
		return $query->row();   
	}

	public function select_by_id_master($id = NULL) {
		if(!empty($id)){
			$this->db->where('id_rka', $id);
		}        
		$query = $this->db->get('master_ref_rka');
		return $query->row();   
	}
	public function update($data,$id = NULL)
	{
		$this->db->where('id_rka', $id);
		$query = $this->db->update('ref_rka',$data);
	}
	
	public function delete($id = NULL)
	{
		$this->db->where('id_rka',$id);
		$query = $this->db->delete('ref_rka');	
		// redirect('ref_rka');
	}
	public function update_master($data,$id = NULL)
	{
		$this->db->where('id_rka', $id);
		$query = $this->db->update('master_ref_rka',$data);
	}
	
	public function delete_master($id = NULL)
	{
		$this->db->where('id_rka',$id);
		$query = $this->db->delete('master_ref_rka');	
		// redirect('ref_rka');
	}

	public function get_tahun(){
		$this->db->distinct();

		$this->db->select('tahun_rkt');
		$query = $this->db->get('ref_rka');
		return $query->result();
	}
}
?>