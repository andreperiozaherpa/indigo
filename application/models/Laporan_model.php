<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan_model extends CI_Model
{
  public function get_laporan_renaksi($id_skpd, $tahun){
    if ($id_skpd != NULL) {
      $this->db->where('iku_ss_renja.id_skpd', $id_skpd);
    }
    if ($tahun != NULL) {
      $this->db->where('iku_ss_renja.tahun_renja', $tahun);
    }
    $this->db->join('iku_ss_renja', 'iku_ss_renja.id_iku_ss_renja = renaksi_iku_ss_renja.id_iku_ss_renja');
    $this->db->join('ref_skpd', 'ref_skpd.id_skpd = iku_ss_renja.id_skpd');
    $this->db->join('ref_unit_kerja', 'ref_unit_kerja.id_unit_kerja = iku_ss_renja.id_unit_kerja');
    $this->db->join('iku_ss_renstra', 'iku_ss_renstra.id_iku_ss_renstra = iku_ss_renja.id_iku_ss_renstra');
    $this->db->join('ref_satuan', 'ref_satuan.id_satuan = iku_ss_renstra.id_satuan');
    return $this->db->get('renaksi_iku_ss_renja')->result_array();
  }

  public function get_bulan_renaksi($id_skpd, $tahun){
    if ($id_skpd != NULL) {
      $this->db->where('iku_ss_renja.id_skpd', $id_skpd);
    }
    if ($tahun != NULL) {
      $this->db->where('iku_ss_renja.tahun_renja', $tahun);
    }
    $this->db->join('renaksi_iku_ss_renja', 'renaksi_iku_ss_renja.id_renaksi_iku_ss_renja = target_renaksi_iku_ss_renja.id_renaksi_iku_ss_renja');
    $this->db->join('iku_ss_renja', 'iku_ss_renja.id_iku_ss_renja = renaksi_iku_ss_renja.id_iku_ss_renja');
    return $this->db->get('target_renaksi_iku_ss_renja')->result_array();
  }

  public function get_laporan_renaksi_sp($id_skpd, $tahun){
    if ($id_skpd != NULL) {
      $this->db->where('iku_sp_renja.id_skpd', $id_skpd);
    }
    if ($tahun != NULL) {
      $this->db->where('iku_sp_renja.tahun_renja', $tahun);
    }
    $this->db->join('iku_sp_renja', 'iku_sp_renja.id_iku_sp_renja = renaksi_iku_sp_renja.id_iku_sp_renja');
    $this->db->join('ref_skpd', 'ref_skpd.id_skpd = iku_sp_renja.id_skpd');
     $this->db->join('ref_unit_kerja', 'ref_unit_kerja.id_unit_kerja = iku_sp_renja.id_unit_kerja');
    $this->db->join('iku_sp_renstra', 'iku_sp_renstra.id_iku_sp_renstra = iku_sp_renja.id_iku_sp_renstra');
    $this->db->join('ref_satuan', 'ref_satuan.id_satuan = iku_sp_renstra.id_satuan');
    return $this->db->get('renaksi_iku_sp_renja')->result_array();
  }

  public function get_bulan_renaksi_sp($id_skpd, $tahun){
    if ($id_skpd != NULL) {
      $this->db->where('iku_sp_renja.id_skpd', $id_skpd);
    }
    if ($tahun != NULL) {
      $this->db->where('iku_sp_renja.tahun_renja', $tahun);
    }
    $this->db->join('renaksi_iku_sp_renja', 'renaksi_iku_sp_renja.id_renaksi_iku_sp_renja = target_renaksi_iku_sp_renja.id_renaksi_iku_sp_renja');
    $this->db->join('iku_sp_renja', 'iku_sp_renja.id_iku_sp_renja = renaksi_iku_sp_renja.id_iku_sp_renja');
    return $this->db->get('target_renaksi_iku_sp_renja')->result_array();
  }
  public function get_laporan_renaksi_sk($id_skpd, $tahun){
    if ($id_skpd != NULL) {
      $this->db->where('iku_sk_renja.id_skpd', $id_skpd);
    }
    if ($tahun != NULL) {
      $this->db->where('iku_sk_renja.tahun_renja', $tahun);
    }
    $this->db->join('iku_sk_renja', 'iku_sk_renja.id_iku_sk_renja = renaksi_iku_sk_renja.id_iku_sk_renja');
    $this->db->join('ref_skpd', 'ref_skpd.id_skpd = iku_sk_renja.id_skpd');
     $this->db->join('ref_unit_kerja', 'ref_unit_kerja.id_unit_kerja = iku_sk_renja.id_unit_kerja');
    $this->db->join('iku_sk_renstra', 'iku_sk_renstra.id_iku_sk_renstra = iku_sk_renja.id_iku_sk_renstra');
    $this->db->join('sasaran_kegiatan_renstra', 'sasaran_kegiatan_renstra.id_sasaran_kegiatan_renstra = iku_sk_renja.id_iku_sk_renstra');
    $this->db->join('ref_satuan', 'ref_satuan.id_satuan = iku_sk_renstra.id_satuan');
    return $this->db->get('renaksi_iku_sk_renja')->result_array();
  }

  public function get_bulan_renaksi_sk($id_skpd, $tahun){
    if ($id_skpd != NULL) {
      $this->db->where('iku_sk_renja.id_skpd', $id_skpd);
    }
    if ($tahun != NULL) {
      $this->db->where('iku_sk_renja.tahun_renja', $tahun);
    }
    $this->db->join('renaksi_iku_sk_renja', 'renaksi_iku_sk_renja.id_renaksi_iku_sk_renja = target_renaksi_iku_sk_renja.id_renaksi_iku_sk_renja');
    $this->db->join('iku_sk_renja', 'iku_sk_renja.id_iku_sk_renja = renaksi_iku_sk_renja.id_iku_sk_renja');
    return $this->db->get('target_renaksi_iku_sk_renja')->result_array();
  }
}
?>
