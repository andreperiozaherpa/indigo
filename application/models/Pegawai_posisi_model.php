<?php
class Pegawai_posisi_model extends CI_Model
{

  public function get_posisi($id_skpd = '', $bulan = '', $tahun = '', $search = false, $keyword = '', $mode = '')
  {
    $this->load->model('ref_skpd_model');
    $is_induk = false;
    if ($id_skpd == 21 || $id_skpd == 10 || $id_skpd == 8 || $id_skpd == 11 || $id_skpd == 17) {
      if ($id_skpd != '') {
        $skpd = $this->ref_skpd_model->get_by_id($id_skpd);
        $is_induk = $this->ref_skpd_model->is_induk($id_skpd);
      }
    }

    if ($mode == 'absen') {
      $this->db->select(
        "user.api_key,pegawai.id_pegawai,pegawai.nip,pegawai.nama_lengkap,
  (SELECT COUNT(absen_log.id_log) FROM absen_log WHERE absen_log.id_pegawai = pegawai.id_pegawai AND MONTH(absen_log.tanggal) = $bulan AND YEAR(absen_log.tanggal) = $tahun AND jam_pulang IS NOT NULL AND jam_masuk IS NOT NULL ) as hadir,
  (SELECT COUNT(absen_log.id_log) FROM absen_log WHERE absen_log.id_pegawai = pegawai.id_pegawai AND MONTH(absen_log.tanggal) = $bulan AND YEAR(absen_log.tanggal) = $tahun AND jam_pulang IS NULL AND jam_masuk IS NOT NULL ) as tap,
  (SELECT sum(masuk_telat) FROM absen_log WHERE absen_log.id_pegawai = pegawai.id_pegawai AND MONTH(absen_log.tanggal) = $bulan AND YEAR(absen_log.tanggal) = $tahun ) as masuk_telat,
  (SELECT sum(pulang_cepat) FROM absen_log WHERE absen_log.id_pegawai = pegawai.id_pegawai AND MONTH(absen_log.tanggal) = $bulan AND YEAR(absen_log.tanggal) = $tahun) as pulang_cepat,
  (SELECT sum(waktu_kerja) FROM absen_log WHERE absen_log.id_pegawai = pegawai.id_pegawai AND MONTH(absen_log.tanggal) = $bulan AND YEAR(absen_log.tanggal) = $tahun) as waktu_kerja
  "
      );
      $this->db->order_by('nama_lengkap');
    }
    $this->db->join('pegawai', 'pegawai.id_pegawai = pegawai_posisi.id_pegawai');
    $this->db->join('user', 'user.id_pegawai = pegawai.id_pegawai');
    $this->db->join('ref_skpd', 'ref_skpd.id_skpd = pegawai_posisi.id_skpd');
    $this->db->select('pegawai_posisi.*,pegawai.nama_lengkap,pegawai.nip');
    if (!empty($id_skpd)) {
      if ($is_induk == true) {
        $this->db->group_start();
        $this->db->or_where('ref_skpd.id_skpd_induk', $id_skpd);
        $this->db->or_where('pegawai_posisi.id_skpd', $id_skpd);
        $this->db->group_end();
      } else {
        $this->db->where('pegawai_posisi.id_skpd', $id_skpd);
      }
    }
    if ($bulan != '') {
      $this->db->where('pegawai_posisi.bulan', $bulan);
    }
    if ($tahun != '') {
      $this->db->where('pegawai_posisi.tahun', $tahun);
    }
    if ($search) {
      $this->db->like('nip', $keyword);
      $this->db->or_like('nama_lengkap', $keyword);
    }
    if ($bulan == '' || $tahun == '') {
      $this->db->group_by('pegawai_posisi.id_pegawai');
    }
    $this->db->order_by('pegawai.nama_lengkap');
    $get = $this->db->get_where('pegawai_posisi')->result();
    return $get;
  }

  private function is_induk($id_skpd)
  {
    $this->load->model('ref_skpd_model');
    $is_induk = false;
    if ($id_skpd != '') {
      $skpd = $this->ref_skpd_model->get_by_id($id_skpd);
      $is_induk = $this->ref_skpd_model->is_induk($id_skpd);
    }
    return $is_induk;
  }
}
