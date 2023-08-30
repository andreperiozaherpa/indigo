<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ref_visi_misi_model extends CI_Model
{

	public $id_visi;
	public $visi;

	public $id_misi;
	public $misi;
	
	public $id_tujuan;
	public $tujuan;

	public function get_all_v()
	{
		if($this->visi!=''){
			$this->db->like('visi',$this->visi);
		}
		$query = $this->db->get('visi');
		return $query->result();
	}

	public function get_visi(){
		$query = $this->db->get('visi');
		return $query->row();
	}
	public function get_visi_r(){
		$query = $this->db->get('ref_visi');
		return $query->row();
	}


	public function insert_v($data)
	{
		$query = $this->db->insert('visi',$data);
	}

	public function select_by_id_v($id = NULL) {
        if(!empty($id)){
            $this->db->where('id_visi', $id);
        }        
        $query = $this->db->get('visi');
        return $query->row();   
    }

    public function update_v($data,$id = NULL)
	{
        $this->db->where('id_visi', $id);
        $query = $this->db->update('visi',$data);
	}
	
	public function delete_v($id = NULL)
	{
		$this->db->where('id_visi',$id);
		$query = $this->db->delete('visi');	
		redirect('visi');
	}

	public function get_all_m_r()
	{
		if($this->misi!=''){
			$this->db->like('misi',$this->misi);
		}
		$query = $this->db->get('ref_misi');
		return $query->result();
	}

	public function get_all_m()
	{
		if($this->misi!=''){
			$this->db->like('misi',$this->misi);
		}
		$query = $this->db->get('misi');
		return $query->result();
	}

	public function insert_m($data)
	{
		$query = $this->db->insert('misi',$data);
	}

	public function select_by_id_m($id = NULL) {
        if(!empty($id)){
            $this->db->where('id_misi', $id);
        }        
        $query = $this->db->get('misi');
        return $query->row();   
    }

    public function update_m($data,$id = NULL)
	{
        $this->db->where('id_misi', $id);
        $query = $this->db->update('misi',$data);
	}
	
	public function delete_m($id = NULL)
	{
		$this->db->where('id_misi',$id);
		$query = $this->db->delete('misi');	
		redirect('misi');
	}

	public function get_all_t()
	{
		if($this->tujuan!=''){
			$this->db->like('tujuan',$this->tujuan);
		}
		$this->db->join('misi','misi.id_misi = tujuan.id_misi');
		$query = $this->db->get('tujuan');
		return $query->result();
	}

	public function get_all_t_by_id_m($id = NULL)
	{
		if($this->tujuan!=''){
			$this->db->like('tujuan',$this->tujuan);
		}
		$this->db->where('tujuan.id_misi',$id);
		$this->db->join('misi','misi.id_misi = tujuan.id_misi');
		$query = $this->db->get('tujuan');
		return $query->result();
	}

	public function get_t_by_id($id_tujuan){
		$this->db->where('id_tujuan',$id_tujuan);
		$query = $this->db->get('tujuan')->row();
		return $query;
	}

	public function insert_t($data)
	{
		$query = $this->db->insert('tujuan',$data);
	}

	public function select_by_id_t($id = NULL) {
        if(!empty($id)){
            $this->db->where('id_tujuan', $id);
        }        
        $query = $this->db->get('tujuan');
        return $query->row();   
    }

    public function update_t($data,$id = NULL)
	{
        $this->db->where('id_tujuan', $id);
        $query = $this->db->update('tujuan',$data);
	}
	
	public function delete_t($id = NULL)
	{
		$this->db->where('id_tujuan',$id);
		$query = $this->db->delete('tujuan');	
		// redirect('tujuan');
	}
}
?>