<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengajuan_surat_model extends CI_Model
{

  public function get_all($id_pegawai)
  {
    return $this->db->get_where('pengajuan_surat', ["id_pegawai" => $id_pegawai])->result();
  }

  public function get_alls()
  {
    return $this->db->get('pengajuan_surat')->result();
  }

  public function get_by_id($id)
  {
    $this->db->select('pengajuan_surat.*, ref_jenis_pengajuan_surat.id_ref_jenis_pengajuan_surat, ref_jenis_pengajuan_surat.jenis_pengajuan_surat');
    $this->db->join('ref_jenis_pengajuan_surat', 'ref_jenis_pengajuan_surat.id_ref_jenis_pengajuan_surat = pengajuan_surat.id_ref_jenis_pengajuan_surat');
    return $this->db->get_where('pengajuan_surat', ["id_pengajuan_surat" => $id])->row();
  }

  public function get_by_ids($id)
  {
    $this->db->select('pengajuan_surat.*, ref_jenis_pengajuan_surat.id_ref_jenis_pengajuan_surat, ref_jenis_pengajuan_surat.jenis_pengajuan_surat, pegawai.id_pegawai, pegawai.nip, pegawai.golongan, pegawai.pangkat, pegawai.jabatan, pegawai.nama_lengkap,pegawai.id_unit_kerja, pegawai.id_skpd,
                      ref_unit_kerja.id_unit_kerja, ref_unit_kerja.nama_unit_kerja, ref_skpd.id_skpd, ref_skpd.nama_skpd, data_bkd.nip, data_bkd.temlahir, data_bkd.tgllahir');
    $this->db->join('pegawai', 'pegawai.id_pegawai=pengajuan_surat.id_pegawai');
    $this->db->join('ref_unit_kerja', 'ref_unit_kerja.id_unit_kerja = pegawai.id_unit_kerja');
    $this->db->join('ref_skpd', 'ref_skpd.id_skpd = pegawai.id_skpd');
    $this->db->join('data_bkd', 'data_bkd.nip=pegawai.nip');
    $this->db->join('ref_jenis_pengajuan_surat', 'ref_jenis_pengajuan_surat.id_ref_jenis_pengajuan_surat = pengajuan_surat.id_ref_jenis_pengajuan_surat');
    return $this->db->get_where('pengajuan_surat', ["id_pengajuan_surat" => $id])->row();
  }

  public function get_jenis_pengajuan_surat()
  {
    return $this->db->get('ref_jenis_pengajuan_surat')->result();
  }


  public function get_page($mulai, $hal, $start, $end, $jenis, $id_pegawai)
  {

    // terhubung dgn data bkd
    // $this->db->select('pengajuan_surat.*, ref_jenis_pengajuan_surat.id_ref_jenis_pengajuan_surat, ref_jenis_pengajuan_surat.jenis_pengajuan_surat, pegawai.id_pegawai, pegawai.nip, pegawai.golongan, pegawai.pangkat, pegawai.jabatan, pegawai.nama_lengkap,pegawai.id_unit_kerja, pegawai.id_skpd,
    //                   ref_unit_kerja.id_unit_kerja, ref_unit_kerja.nama_unit_kerja, ref_skpd.id_skpd, ref_skpd.nama_skpd, data_bkd.nip, data_bkd.temlahir, data_bkd.tgllahir');
    $this->db->select('pengajuan_surat.*, ref_jenis_pengajuan_surat.id_ref_jenis_pengajuan_surat, ref_jenis_pengajuan_surat.jenis_pengajuan_surat, pegawai.id_pegawai, pegawai.nip, pegawai.golongan, pegawai.pangkat, pegawai.jabatan, pegawai.nama_lengkap,pegawai.id_unit_kerja, pegawai.id_skpd,
                      ref_unit_kerja.id_unit_kerja, ref_unit_kerja.nama_unit_kerja, ref_skpd.id_skpd, ref_skpd.nama_skpd');

    $this->db->join('pegawai', 'pegawai.id_pegawai=pengajuan_surat.id_pegawai');
    $this->db->join('ref_unit_kerja', 'ref_unit_kerja.id_unit_kerja = pegawai.id_unit_kerja');
    $this->db->join('ref_skpd', 'ref_skpd.id_skpd = pegawai.id_skpd');
    // $this->db->join('data_bkd', 'data_bkd.nip=pegawai.nip');

    if ($start != '') {
      $this->db->where('pengajuan_surat.created_at >=', $start);
    }
    if ($end != '') {
      $this->db->where('pengajuan_surat.created_at <=', $end);
    }
    if ($jenis != '') {
      $this->db->where('pengajuan_surat.id_ref_jenis_pengajuan_surat', $jenis);
      $this->db->limit($hal, $mulai);
    } else {
      $this->db->limit($hal, $mulai);
    }

    $this->db->join('ref_jenis_pengajuan_surat', 'ref_jenis_pengajuan_surat.id_ref_jenis_pengajuan_surat = pengajuan_surat.id_ref_jenis_pengajuan_surat');

    return $this->db->get_where('pengajuan_surat', ['pengajuan_surat.id_pegawai' => $id_pegawai])->result();
  }

  public function get_pages($mulai, $hal, $start, $end, $jenis, $status)
  {

    // data dengan bkd
    // $this->db->select('pengajuan_surat.*, ref_jenis_pengajuan_surat.id_ref_jenis_pengajuan_surat, ref_jenis_pengajuan_surat.jenis_pengajuan_surat, pegawai.id_pegawai, pegawai.nip, pegawai.golongan, pegawai.pangkat, pegawai.jabatan, pegawai.nama_lengkap,pegawai.id_unit_kerja, pegawai.id_skpd,
    //                   ref_unit_kerja.id_unit_kerja, ref_unit_kerja.nama_unit_kerja, ref_skpd.id_skpd, ref_skpd.nama_skpd, data_bkd.nip, data_bkd.temlahir, data_bkd.tgllahir');
    $this->db->select('pengajuan_surat.*, ref_jenis_pengajuan_surat.id_ref_jenis_pengajuan_surat, ref_jenis_pengajuan_surat.jenis_pengajuan_surat, pegawai.id_pegawai, pegawai.nip, pegawai.golongan, pegawai.pangkat, pegawai.jabatan, pegawai.nama_lengkap,pegawai.id_unit_kerja, pegawai.id_skpd,
                      ref_unit_kerja.id_unit_kerja, ref_unit_kerja.nama_unit_kerja, ref_skpd.id_skpd, ref_skpd.nama_skpd');
    $this->db->join('pegawai', 'pegawai.id_pegawai=pengajuan_surat.id_pegawai');
    $this->db->join('ref_unit_kerja', 'ref_unit_kerja.id_unit_kerja = pegawai.id_unit_kerja');
    $this->db->join('ref_skpd', 'ref_skpd.id_skpd = pegawai.id_skpd');
    // $this->db->join('data_bkd', 'data_bkd.nip=pegawai.nip');

    if ($start != '') {
      $this->db->where('pengajuan_surat.created_at >=', $start);
    }
    if ($end != '') {
      $this->db->where('pengajuan_surat.created_at <=', $end);
    }
    if ($jenis != '') {
      $this->db->where('pengajuan_surat.id_ref_jenis_pengajuan_surat', $jenis);
    }
    if ($status != '') {
      $this->db->where('pengajuan_surat.status', $status);
    }
    if (!empty($mulai) || !empty($hal)) {
      $this->db->limit($hal, $mulai);
    }
    $this->db->join('ref_jenis_pengajuan_surat', 'ref_jenis_pengajuan_surat.id_ref_jenis_pengajuan_surat = pengajuan_surat.id_ref_jenis_pengajuan_surat');

    return $this->db->get('pengajuan_surat')->result();
  }

  public function save($data)
  {
    $this->db->insert('pengajuan_surat', $data);
  }

  public function update($data, $id)
  {
    $this->db->where('id_pengajuan_surat', $id);
    $this->db->update('pengajuan_surat', $data);
  }

  public function delete($id)
  {
    $get = $this->db->get_where('pengajuan_surat', ['id_pengajuan_surat' => $id])->row();

    $field_file = ['surat_usulan_opd', 'sk_tidak_dijatuhi_hukuman_disiplin', 'sk_pangkat_terakhir', 'jadwal_kuliah', 'sk_lembaga_pendidikan', 'fc_ijazah', 'transkip_nilai', 'surat_jadi'];
    foreach ($field_file as $key => $value) {
      if ($get->$value == null) {
        continue;
      }
      array_map('unlink', glob(FCPATH . "data/pengajuan_surat/" . $get->$value));
    }
    $this->db->where('id_pengajuan_surat', $id);
    $this->db->delete('pengajuan_surat');
  }
}
