<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Renstra_perencanaan_model extends CI_Model{

	public function get_perencanaan_by_id_skpd($id_skpd){
		// $this->db->select("iku_sasaran_rpjmd.id_iku_sasaran_rpjmd, iku_sasaran_rpjmd.iku_sasaran_rpjmd, sasaran_rpjmd.id_sasaran_rpjmd, sasaran_rpjmd.sasaran_rpjmd, tujuan.id_tujuan, tujuan.tujuan, misi.id_misi, misi.misi, visi.id_visi, visi.visi");
		// $this->db->where('iku_sasaran_rpjmd.id_skpd',$id_skpd);
		$this->db->where('FIND_IN_SET('.$id_skpd.', iku_sasaran_rpjmd.id_skpd)');
		$this->db->join('sasaran_rpjmd', 'sasaran_rpjmd.id_sasaran_rpjmd = iku_sasaran_rpjmd.id_sasaran_rpjmd');
		$this->db->join('tujuan', 'tujuan.id_tujuan = sasaran_rpjmd.id_tujuan');
		$this->db->join('misi', 'misi.id_misi = tujuan.id_misi');
		$this->db->join('visi', 'visi.id_visi = misi.id_visi');
		$query = $this->db->get('iku_sasaran_rpjmd');
		return $query->result_array();
	}

	public function get_sasaran_strategis_by_id($id){
		$this->db->where('sasaran_strategis_renstra.id_sasaran_strategis_renstra',$id);
		$query = $this->db->get('sasaran_strategis_renstra');
		return $query->row();
	}

	public function get_sasaran_program_by_id($id){
		$this->db->where('sasaran_program_renstra.id_sasaran_program_renstra',$id);
		$query = $this->db->get('sasaran_program_renstra');
		return $query->row();
	}

	public function get_sasaran_kegiatan_by_id($id){
		$this->db->where('sasaran_kegiatan_renstra.id_sasaran_kegiatan_renstra',$id);
		$query = $this->db->get('sasaran_kegiatan_renstra');
		return $query->row();
	}

	public function get_sasaran_subkegiatan_by_id($id){
		$this->db->where('sasaran_subkegiatan_renstra.id_sasaran_subkegiatan_renstra',$id);
		$query = $this->db->get('sasaran_subkegiatan_renstra');
		return $query->row();
	}

	public function get_sasaran_strategis_by_id_skpd($id_skpd,$apbd="Murni"){
		$this->db->where('sasaran_strategis_renstra.id_skpd',$id_skpd);
		$this->db->where('apbd',$apbd);
		$query = $this->db->get('sasaran_strategis_renstra');
		return $query->result_array();
	}

	public function get_sasaran_program_by_id_skpd($id_skpd,$apbd="Murni"){
		$this->db->where('sasaran_program_renstra.id_skpd',$id_skpd);
		$this->db->where('apbd',$apbd);
		// $this->db->join('ref_unit_kerja', 'ref_unit_kerja.id_unit_kerja = sasaran_program_renstra.id_unit_kerja');
		$query = $this->db->get('sasaran_program_renstra');
		return $query->result_array();
	}

	public function get_sasaran_kegiatan_by_id_skpd($id_skpd,$apbd="Murni"){
		$this->db->where('sasaran_kegiatan_renstra.id_skpd',$id_skpd);
		$this->db->where('apbd',$apbd);
		// $this->db->join('ref_unit_kerja', 'ref_unit_kerja.id_unit_kerja = sasaran_kegiatan_renstra.id_unit_kerja');
		$query = $this->db->get('sasaran_kegiatan_renstra');
		return $query->result_array();
	}

	public function get_sasaran_subkegiatan_by_id_skpd($id_skpd,$apbd="Murni"){
		$this->db->where('sasaran_subkegiatan_renstra.id_skpd',$id_skpd);
		$this->db->where('apbd',$apbd);
		// $this->db->join('ref_unit_kerja', 'ref_unit_kerja.id_unit_kerja = sasaran_kegiatan_renstra.id_unit_kerja');
		$query = $this->db->get('sasaran_subkegiatan_renstra');
		return $query->result_array();
	}

	public function get_iku_sasaran_strategis_by_id_ss($id_ss){
		$this->db->where('iku_ss_renstra.id_sasaran_strategis_renstra',$id_ss);
		$this->db->join('ref_satuan', 'ref_satuan.id_satuan = iku_ss_renstra.id_satuan');
		$query = $this->db->get('iku_ss_renstra');
		return $query->result_array();
	}

	public function get_iku_sasaran_program_by_id_sp($id_sp){
		$this->db->where('iku_sp_renstra.id_sasaran_program_renstra',$id_sp);
		$this->db->join('ref_satuan', 'ref_satuan.id_satuan = iku_sp_renstra.id_satuan');
		$query = $this->db->get('iku_sp_renstra');
		return $query->result_array();
	}

	public function get_iku_sasaran_kegiatan_by_id_sk($id_sk){
		$this->db->where('iku_sk_renstra.id_sasaran_kegiatan_renstra',$id_sk);
		$this->db->join('ref_satuan', 'ref_satuan.id_satuan = iku_sk_renstra.id_satuan');
		$query = $this->db->get('iku_sk_renstra');
		return $query->result_array();
	}

	public function get_iku_sasaran_subkegiatan_by_id_ssk($id_ssk){
		$this->db->where('iku_ssk_renstra.id_sasaran_subkegiatan_renstra',$id_ssk);
		$this->db->join('ref_satuan', 'ref_satuan.id_satuan = iku_ssk_renstra.id_satuan');
		$query = $this->db->get('iku_ssk_renstra');
		return $query->result_array();
	}

	public function get_iku_by_id($id_iku)
	{
		$this->db->where('iku_ss_renstra.id_iku_ss_renstra',$id_iku);
		$this->db->join('sasaran_strategis_renstra','sasaran_strategis_renstra.id_sasaran_strategis_renstra = iku_ss_renstra.id_sasaran_strategis_renstra');
		$this->db->join('ref_satuan', 'ref_satuan.id_satuan = iku_ss_renstra.id_satuan');
		$query = $this->db->get('iku_ss_renstra');
		return $query->row();
	}

	public function get_iku_sasaran_strategis_by_id_iku($id_iku){
		$this->db->where('iku_ss_renstra.id_iku_ss_renstra',$id_iku);
		$this->db->join('sasaran_strategis_renstra','sasaran_strategis_renstra.id_sasaran_strategis_renstra = iku_ss_renstra.id_sasaran_strategis_renstra');
		$this->db->join('ref_satuan', 'ref_satuan.id_satuan = iku_ss_renstra.id_satuan');
		$query = $this->db->get('iku_ss_renstra');
		return $query->row();
	}

	public function get_iku_sasaran_program_by_id_iku($id_iku){
		$this->db->where('iku_sp_renstra.id_iku_sp_renstra',$id_iku);
		$this->db->join('sasaran_program_renstra','sasaran_program_renstra.id_sasaran_program_renstra = iku_sp_renstra.id_sasaran_program_renstra');
		$this->db->join('ref_satuan', 'ref_satuan.id_satuan = iku_sp_renstra.id_satuan');
		$query = $this->db->get('iku_sp_renstra');
		return $query->row();
	}

	public function get_iku_sasaran_kegiatan_by_id_iku($id_iku){
		$this->db->where('iku_sk_renstra.id_iku_sk_renstra',$id_iku);
		$this->db->join('sasaran_kegiatan_renstra','sasaran_kegiatan_renstra.id_sasaran_kegiatan_renstra = iku_sk_renstra.id_sasaran_kegiatan_renstra');
		$this->db->join('ref_satuan', 'ref_satuan.id_satuan = iku_sk_renstra.id_satuan');
		$query = $this->db->get('iku_sk_renstra');
		return $query->row();
	}

	public function get_iku_sasaran_subkegiatan_by_id_iku($id_iku){
		$this->db->where('iku_ssk_renstra.id_iku_ssk_renstra',$id_iku);
		$this->db->join('sasaran_subkegiatan_renstra','sasaran_subkegiatan_renstra.id_sasaran_subkegiatan_renstra = iku_ssk_renstra.id_sasaran_subkegiatan_renstra');
		$this->db->join('ref_satuan', 'ref_satuan.id_satuan = iku_ssk_renstra.id_satuan');
		$query = $this->db->get('iku_ssk_renstra');
		return $query->row();
	}


	public function get_casecade_unit_kerja_iku_ss_renstra($id_iku){
		$this->db->where('casecade_unit_kerja_iku_ss_renstra.id_iku_ss_renstra',$id_iku);
		$this->db->join('ref_unit_kerja', 'ref_unit_kerja.id_unit_kerja = casecade_unit_kerja_iku_ss_renstra.id_unit_kerja');
		$query = $this->db->get('casecade_unit_kerja_iku_ss_renstra');
		return $query->result_array();
	}

	public function get_casecade_unit_kerja_iku_sp_renstra($id_iku){
		$this->db->where('casecade_unit_kerja_iku_sp_renstra.id_iku_sp_renstra',$id_iku);
		$this->db->join('ref_unit_kerja', 'ref_unit_kerja.id_unit_kerja = casecade_unit_kerja_iku_sp_renstra.id_unit_kerja');
		$query = $this->db->get('casecade_unit_kerja_iku_sp_renstra');
		return $query->result_array();
	}
	
	public function get_casecade_unit_kerja_iku_sk_renstra($id_iku){
		$this->db->where('casecade_unit_kerja_iku_sk_renstra.id_iku_sk_renstra',$id_iku);
		$this->db->join('ref_unit_kerja', 'ref_unit_kerja.id_unit_kerja = casecade_unit_kerja_iku_sk_renstra.id_unit_kerja');
		$query = $this->db->get('casecade_unit_kerja_iku_sk_renstra');
		return $query->result_array();
	}
	
	public function get_casecade_unit_kerja_iku_ssk_renstra($id_iku){
		$this->db->where('casecade_unit_kerja_iku_ssk_renstra.id_iku_ssk_renstra',$id_iku);
		$this->db->join('ref_unit_kerja', 'ref_unit_kerja.id_unit_kerja = casecade_unit_kerja_iku_ssk_renstra.id_unit_kerja');
		$query = $this->db->get('casecade_unit_kerja_iku_ssk_renstra');
		return $query->result_array();
	}

	public function get_unit_kerja_by_id_skpd($id_skpd){
		$this->db->where('ref_unit_kerja.id_skpd',$id_skpd);
		$query = $this->db->get('ref_unit_kerja');
		return $query->result();
	}

	public function get_sipd_program_by_sasaran($id_sasaran){
		$get_unit = $this->db->get_where('sipd_ref_unit',array('id_skpd' => $id_sasaran))->row();
		$kode_unit = substr($get_unit->kode_unit, 0, 17);
		
		$this->db->like('sipd_master_kodering.kode_kodering',$kode_unit.".");
		$this->db->join('sipd_master_kodering','SUBSTRING(sipd_master_kodering.kode_kodering, 24, 7) = sipd_ref_program.kode_program','left');
		$this->db->group_by('sipd_ref_program.kode_program');
		$query = $this->db->get('sipd_ref_program');
		return $query->result();
	}

	public function get_sipd_kegiatan_by_sasaran($id_sasaran){
		$get_kegiatan = $this->db->join('sasaran_program_renstra','sasaran_program_renstra.id_sasaran_program_renstra = iku_sp_renstra.id_sasaran_program_renstra', 'left')
		->get_where('iku_sp_renstra',array('id_iku_sp_renstra' => $id_sasaran))->row();
		$kode_program = $get_kegiatan->kode_sipd_program;

		$get_unit = $this->db->get_where('sipd_ref_unit',array('id_skpd' => $get_kegiatan->id_skpd))->row();
		$kode_unit = substr($get_unit->kode_unit, 0, 17);

		$this->db->like('sipd_master_kodering.kode_kodering',$kode_unit.".");
		$this->db->like('sipd_master_kodering.kode_kodering',".".$kode_program.".");
		$this->db->join('sipd_master_kodering','SUBSTRING(sipd_master_kodering.kode_kodering, 24, 12) = sipd_ref_kegiatan.kode_kegiatan','left');
		$this->db->group_by('sipd_ref_kegiatan.kode_kegiatan');
		$query = $this->db->get('sipd_ref_kegiatan');
		return $query->result();
	}

	public function get_sipd_subkegiatan_by_sasaran($id_sasaran){
		$get_subkegiatan = $this->db->join('sasaran_kegiatan_renstra','sasaran_kegiatan_renstra.id_sasaran_kegiatan_renstra = iku_sk_renstra.id_sasaran_kegiatan_renstra', 'left')
		->get_where('iku_sk_renstra',array('id_iku_sk_renstra' => $id_sasaran))->row();
		$kode_kegiatan = $get_subkegiatan->kode_sipd_kegiatan;

		$get_unit = $this->db->get_where('sipd_ref_unit',array('id_skpd' => $get_subkegiatan->id_skpd))->row();
		$kode_unit = substr($get_unit->kode_unit, 0, 17);

		$this->db->like('sipd_master_kodering.kode_kodering',$kode_unit.".");
		$this->db->like('sipd_master_kodering.kode_kodering',".".$kode_kegiatan.".");
		$this->db->join('sipd_master_kodering','SUBSTRING(sipd_master_kodering.kode_kodering, 24, 15) = sipd_ref_sub_kegiatan.kode_sub_kegiatan','left');
		$this->db->group_by('sipd_ref_sub_kegiatan.kode_sub_kegiatan');
		$query = $this->db->get('sipd_ref_sub_kegiatan');
		return $query->result();
	}

	public function get_iku_ss_by_unit_kerja($id_unit_kerja,$apbd="Murni"){
		$this->db->where('apbd',$apbd);
		$this->db->where_in('casecade_unit_kerja_iku_ss_renstra.id_unit_kerja',$id_unit_kerja);
		$this->db->join('iku_ss_renstra', 'iku_ss_renstra.id_iku_ss_renstra = casecade_unit_kerja_iku_ss_renstra.id_iku_ss_renstra');
		$this->db->join('sasaran_strategis_renstra','sasaran_strategis_renstra.id_sasaran_strategis_renstra = iku_ss_renstra.id_sasaran_strategis_renstra','left');
		$query = $this->db->get('casecade_unit_kerja_iku_ss_renstra');
		return $query->result();
	}

	public function get_iku_sp_by_unit_kerja($id_unit_kerja,$apbd="Murni"){
		$this->db->where('apbd',$apbd);
		$this->db->where_in('casecade_unit_kerja_iku_sp_renstra.id_unit_kerja',$id_unit_kerja);
		$this->db->join('iku_sp_renstra', 'iku_sp_renstra.id_iku_sp_renstra = casecade_unit_kerja_iku_sp_renstra.id_iku_sp_renstra');
		$this->db->join('sasaran_program_renstra','sasaran_program_renstra.id_sasaran_program_renstra = iku_sp_renstra.id_sasaran_program_renstra');
		$query = $this->db->get('casecade_unit_kerja_iku_sp_renstra');
		return $query->result();
	}

	public function get_iku_sk_by_unit_kerja($id_unit_kerja,$apbd="Murni"){
		$this->db->where('apbd',$apbd);
		$this->db->where_in('casecade_unit_kerja_iku_sk_renstra.id_unit_kerja',$id_unit_kerja);
		$this->db->join('iku_sk_renstra', 'iku_sk_renstra.id_iku_sk_renstra = casecade_unit_kerja_iku_sk_renstra.id_iku_sk_renstra');
		$this->db->join('sasaran_kegiatan_renstra','sasaran_kegiatan_renstra.id_sasaran_kegiatan_renstra = iku_sk_renstra.id_sasaran_kegiatan_renstra');
		$query = $this->db->get('casecade_unit_kerja_iku_sk_renstra');
		return $query->result();
	}

	public function get_iku_ssk_by_unit_kerja($id_unit_kerja,$apbd="Murni"){
		$this->db->where('apbd',$apbd);
		$this->db->where_in('casecade_unit_kerja_iku_ssk_renstra.id_unit_kerja',$id_unit_kerja);
		$this->db->join('iku_ssk_renstra', 'iku_ssk_renstra.id_iku_ssk_renstra = casecade_unit_kerja_iku_ssk_renstra.id_iku_ssk_renstra');
		$this->db->join('sasaran_subkegiatan_renstra','sasaran_subkegiatan_renstra.id_sasaran_subkegiatan_renstra = iku_ssk_renstra.id_sasaran_subkegiatan_renstra');
		$query = $this->db->get('casecade_unit_kerja_iku_ssk_renstra');
		return $query->result();
	}

	public function insert_sasaran_strategis_renstra($data)
	{
		if ($data) {
			$query = $this->db->insert('sasaran_strategis_renstra', $data);
			return true;
		}
	}

	public function update_sasaran_strategis_renstra($data,$id)
	{
		if ($data) {
			$query = $this->db->update('sasaran_strategis_renstra', $data, array('id_sasaran_strategis_renstra'=>$id));
			return true;
		}
	}

	public function insert_indikator_sasaran_strategis($data)
	{
		if ($data) {
			$query = $this->db->insert('iku_ss_renstra', $data);
			return $this->db->insert_id();
		}
	}

	public function update_indikator_sasaran_strategis($data,$id)
	{
		if ($data) {
			$query = $this->db->update('iku_ss_renstra', $data, array('id_iku_ss_renstra'=>$id));
			return $id;
		}
	}

	public function insert_casecade_unit_kerja_iku_ss_renstra($id_iku,$id_unit_kerja)
	{
		$this->db->set('id_iku_ss_renstra', $id_iku);
		$this->db->set('id_unit_kerja', $id_unit_kerja);
		$query = $this->db->insert('casecade_unit_kerja_iku_ss_renstra');
		return true;
	}

	public function delete_casecade_unit_kerja_iku_ss_renstra($id_iku)
	{
		$this->db->where('id_iku_ss_renstra', $id_iku);
		$query = $this->db->delete('casecade_unit_kerja_iku_ss_renstra');
		return true;
	}

	public function update_bobot_iku_ss($id_iku,$bobot)
	{
		$this->db->where('id_iku_ss_renstra', $id_iku);
		$this->db->set('bobot', $bobot);
		$query = $this->db->update('iku_ss_renstra');
		return true;
	}


	public function insert_sasaran_program_renstra($data)
	{
		if ($data) {
			$query = $this->db->insert('sasaran_program_renstra', $data);
			return true;
		}
	}

	public function update_sasaran_program_renstra($data,$id)
	{
		if ($data) {
			$query = $this->db->update('sasaran_program_renstra', $data, array('id_sasaran_program_renstra'=>$id));
			return true;
		}
	}

	public function insert_indikator_sasaran_program($data)
	{
		if ($data) {
			$query = $this->db->insert('iku_sp_renstra', $data);
			return $this->db->insert_id();
		}
	}

	public function update_indikator_sasaran_program($data,$id)
	{
		if ($data) {
			$query = $this->db->update('iku_sp_renstra', $data, array('id_iku_sp_renstra'=>$id));
			return $id;
		}
	}

	public function insert_casecade_unit_kerja_iku_sp_renstra($id_iku,$id_unit_kerja)
	{
		$this->db->set('id_iku_sp_renstra', $id_iku);
		$this->db->set('id_unit_kerja', $id_unit_kerja);
		$query = $this->db->insert('casecade_unit_kerja_iku_sp_renstra');
		return true;
	}

	public function delete_casecade_unit_kerja_iku_sp_renstra($id_iku)
	{
		$this->db->where('id_iku_sp_renstra', $id_iku);
		$query = $this->db->delete('casecade_unit_kerja_iku_sp_renstra');
		return true;
	}

	public function update_bobot_iku_sp($id_iku,$bobot)
	{
		$this->db->where('id_iku_sp_renstra', $id_iku);
		$this->db->set('bobot', $bobot);
		$query = $this->db->update('iku_sp_renstra');
		return true;
	}


	public function insert_sasaran_kegiatan_renstra($data)
	{
		if ($data) {
			$query = $this->db->insert('sasaran_kegiatan_renstra', $data);
			return true;
		}
	}

	public function update_sasaran_kegiatan_renstra($data,$id)
	{
		if ($data) {
			$query = $this->db->update('sasaran_kegiatan_renstra', $data, array('id_sasaran_kegiatan_renstra'=>$id));
			return true;
		}
	}

	public function insert_indikator_sasaran_kegiatan($data)
	{
		if ($data) {
			$query = $this->db->insert('iku_sk_renstra', $data);
			return $this->db->insert_id();
		}
	}

	public function update_indikator_sasaran_kegiatan($data,$id)
	{
		if ($data) {
			$query = $this->db->update('iku_sk_renstra', $data, array('id_iku_sk_renstra'=>$id));
			return $id;
		}
	}

	public function insert_casecade_unit_kerja_iku_sk_renstra($id_iku,$id_unit_kerja)
	{
		$this->db->set('id_iku_sk_renstra', $id_iku);
		$this->db->set('id_unit_kerja', $id_unit_kerja);
		$query = $this->db->insert('casecade_unit_kerja_iku_sk_renstra');
		return true;
	}

	public function delete_casecade_unit_kerja_iku_sk_renstra($id_iku)
	{
		$this->db->where('id_iku_sk_renstra', $id_iku);
		$query = $this->db->delete('casecade_unit_kerja_iku_sk_renstra');
		return true;
	}

	public function update_bobot_iku_sk($id_iku,$bobot)
	{
		$this->db->where('id_iku_sk_renstra', $id_iku);
		$this->db->set('bobot', $bobot);
		$query = $this->db->update('iku_sk_renstra');
		return true;
	}


	public function insert_sasaran_subkegiatan_renstra($data)
	{
		if ($data) {
			$query = $this->db->insert('sasaran_subkegiatan_renstra', $data);
			return true;
		}
	}

	public function update_sasaran_subkegiatan_renstra($data,$id)
	{
		if ($data) {
			$query = $this->db->update('sasaran_subkegiatan_renstra', $data, array('id_sasaran_subkegiatan_renstra'=>$id));
			return true;
		}
	}

	public function insert_indikator_sasaran_subkegiatan($data)
	{
		if ($data) {
			$query = $this->db->insert('iku_ssk_renstra', $data);
			return $this->db->insert_id();
		}
	}

	public function update_indikator_sasaran_subkegiatan($data,$id)
	{
		if ($data) {
			$query = $this->db->update('iku_ssk_renstra', $data, array('id_iku_ssk_renstra'=>$id));
			return $id;
		}
	}

	public function insert_casecade_unit_kerja_iku_ssk_renstra($id_iku,$id_unit_kerja)
	{
		$this->db->set('id_iku_ssk_renstra', $id_iku);
		$this->db->set('id_unit_kerja', $id_unit_kerja);
		$query = $this->db->insert('casecade_unit_kerja_iku_ssk_renstra');
		return true;
	}

	public function delete_casecade_unit_kerja_iku_ssk_renstra($id_iku)
	{
		$this->db->where('id_iku_ssk_renstra', $id_iku);
		$query = $this->db->delete('casecade_unit_kerja_iku_ssk_renstra');
		return true;
	}

	public function update_bobot_iku_ssk($id_iku,$bobot)
	{
		$this->db->where('id_iku_ssk_renstra', $id_iku);
		$this->db->set('bobot', $bobot);
		$query = $this->db->update('iku_ssk_renstra');
		return true;
	}


	public function get_total_ss($id_skpd,$apbd="Murni")
	{
		$this->db->where('id_skpd',$id_skpd);
		$this->db->where('apbd',$apbd);
		$query = $this->db->get('sasaran_strategis_renstra');
		return $query->num_rows();
	}

	public function get_total_iku_ss($id_skpd,$apbd="Murni")
	{
		$this->db->where('sasaran_strategis_renstra.id_skpd',$id_skpd);
		$this->db->where('apbd',$apbd);
		$this->db->join('sasaran_strategis_renstra','sasaran_strategis_renstra.id_sasaran_strategis_renstra = iku_ss_renstra.id_sasaran_strategis_renstra');
		$query = $this->db->get('iku_ss_renstra');
		return $query->num_rows();
	}



	public function get_total_sp($id_skpd,$apbd="Murni")
	{
		$this->db->where('id_skpd',$id_skpd);
		$this->db->where('apbd',$apbd);
		$query = $this->db->get('sasaran_program_renstra');
		return $query->num_rows();
	}

	public function get_total_iku_sp($id_skpd,$apbd="Murni")
	{
		$this->db->where('sasaran_program_renstra.id_skpd',$id_skpd);
		$this->db->where('apbd',$apbd);
		$this->db->join('sasaran_program_renstra','sasaran_program_renstra.id_sasaran_program_renstra = iku_sp_renstra.id_sasaran_program_renstra');
		$query = $this->db->get('iku_sp_renstra');
		return $query->num_rows();
	}




	public function get_total_sk($id_skpd,$apbd="Murni")
	{
		$this->db->where('id_skpd',$id_skpd);
		$this->db->where('apbd',$apbd);
		$query = $this->db->get('sasaran_kegiatan_renstra');
		return $query->num_rows();
	}

	public function get_total_iku_sk($id_skpd,$apbd="Murni")
	{
		$this->db->where('sasaran_kegiatan_renstra.id_skpd',$id_skpd);
		$this->db->where('apbd',$apbd);
		$this->db->join('sasaran_kegiatan_renstra','sasaran_kegiatan_renstra.id_sasaran_kegiatan_renstra = iku_sk_renstra.id_sasaran_kegiatan_renstra');
		$query = $this->db->get('iku_sk_renstra');
		return $query->num_rows();
	}




	public function get_total_ssk($id_skpd,$apbd="Murni")
	{
		$this->db->where('id_skpd',$id_skpd);
		$this->db->where('apbd',$apbd);
		$query = $this->db->get('sasaran_subkegiatan_renstra');
		return $query->num_rows();
	}

	public function get_total_iku_ssk($id_skpd,$apbd="Murni")
	{
		$this->db->where('sasaran_subkegiatan_renstra.id_skpd',$id_skpd);
		$this->db->where('apbd',$apbd);
		$this->db->join('sasaran_subkegiatan_renstra','sasaran_subkegiatan_renstra.id_sasaran_subkegiatan_renstra = iku_ssk_renstra.id_sasaran_subkegiatan_renstra');
		$query = $this->db->get('iku_ssk_renstra');
		return $query->num_rows();
	}
	

	public function get_total_iku($id_skpd)
	{
		$this->db->where('id_skpd',$id_skpd);
		$query = $this->db->get('iku_sasaran_rpjmd');
		return $query->num_rows();
	}


	public function hapus_ss()
	{
		$this->db->where('id_sasaran_strategis_renstra',$this->id_sasaran_strategis_renstra);
		$query = $this->db->delete('sasaran_strategis_renstra');

		$this->db->where('id_sasaran_strategis_renstra',$this->id_sasaran_strategis_renstra);
		$query = $this->db->delete('iku_ss_renstra');

	}


	public function hapus_sp()
	{
		$this->db->where('id_sasaran_program_renstra',$this->id_sasaran_program_renstra);
		$query = $this->db->delete('sasaran_program_renstra');

		$this->db->where('id_sasaran_program_renstra',$this->id_sasaran_program_renstra);
		$query = $this->db->delete('iku_sp_renstra');

	}


	public function hapus_sk()
	{
		$this->db->where('id_sasaran_kegiatan_renstra',$this->id_sasaran_kegiatan_renstra);
		$query = $this->db->delete('sasaran_kegiatan_renstra');

		$this->db->where('id_sasaran_kegiatan_renstra',$this->id_sasaran_kegiatan_renstra);
		$query = $this->db->delete('iku_sk_renstra');

	}


	public function hapus_ssk()
	{
		$this->db->where('id_sasaran_subkegiatan_renstra',$this->id_sasaran_subkegiatan_renstra);
		$query = $this->db->delete('sasaran_subkegiatan_renstra');

		$this->db->where('id_sasaran_subkegiatan_renstra',$this->id_sasaran_subkegiatan_renstra);
		$query = $this->db->delete('iku_ssk_renstra');

	}


	public function hapus_iku_ss()
	{

		$this->db->where('id_iku_ss_renstra', $this->id_iku_ss_renstra);
		$query = $this->db->delete('iku_ss_renstra');

		$this->db->where('id_iku_ss_renstra', $this->id_iku_ss_renstra);
		$query = $this->db->delete('casecade_unit_kerja_iku_ss_renstra');

	}

	public function hapus_iku_sp()
	{

		$this->db->where('id_iku_sp_renstra', $this->id_iku_sp_renstra);
		$query = $this->db->delete('iku_sp_renstra');

		$this->db->where('id_iku_sp_renstra', $this->id_iku_sp_renstra);
		$query = $this->db->delete('casecade_unit_kerja_iku_sp_renstra');

	}

	public function hapus_iku_sk()
	{

		$this->db->where('id_iku_sk_renstra', $this->id_iku_sk_renstra);
		$query = $this->db->delete('iku_sk_renstra');

		$this->db->where('id_iku_sk_renstra', $this->id_iku_sk_renstra);
		$query = $this->db->delete('casecade_unit_kerja_iku_sk_renstra');

	}

	public function hapus_iku_ssk()
	{

		$this->db->where('id_iku_ssk_renstra', $this->id_iku_ssk_renstra);
		$query = $this->db->delete('iku_ssk_renstra');

		$this->db->where('id_iku_ssk_renstra', $this->id_iku_ssk_renstra);
		$query = $this->db->delete('casecade_unit_kerja_iku_ssk_renstra');

	}







	

}