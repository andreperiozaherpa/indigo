<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ref_hari_kerja_efektif_model extends CI_Model
{

	public function get_all()
	{
		$query = $this->db->get('ref_hari_kerja_efektif');
		return $query->result();
	}

	public function get_by_bulan($id_bulan){
		return $this->db->get_where('ref_hari_kerja_efektif',array('id_bulan'=>$id_bulan))->row()->jumlah;
	}
}
?>