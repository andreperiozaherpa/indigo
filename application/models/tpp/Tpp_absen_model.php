<?php
class Tpp_absen_model extends CI_Model
{

  public function hitung_absensi($param)
  {
    $this->load->model("tpp/Tpp_perhitungan_model");
    $result = array();
    $tpp = $this->Tpp_perhitungan_model->get_tpp($param['id_pegawai']);
    $absen = $this->get_absen($param);

    if ($absen && $tpp) {
      $total_menit_masuk = $absen->total_masuk_telat;
      if ($total_menit_masuk > 90) {
        $persen_masuk = 1.5;
      } else if ($total_menit_masuk > 60) {
        $persen_masuk = 1.25;
      } else if ($total_menit_masuk > 30) {
        $persen_masuk = 1;
      } else if ($total_menit_masuk >= 1) {
        $persen_masuk = 0.5;
      } else {
        $persen_masuk = 0;
      }

      $total_menit_pulang = $absen->total_pulang_cepat;
      if ($total_menit_pulang > 90) {
        $persen_pulang = 1.5;
      } else if ($total_menit_pulang > 60) {
        $persen_pulang = 1.25;
      } else if ($total_menit_pulang > 30) {
        $persen_pulang = 1;
      } else if ($total_menit_pulang >= 1) {
        $persen_pulang = 0.5;
      } else {
        $persen_pulang = 0;
      }

      $persen = $persen_masuk + $persen_pulang;

      

      $keterangan =  "Telat Masuk ".convert_minute($absen->total_masuk_telat)." ($persen_masuk%) dan Pulang Cepat ".convert_minute($absen->total_pulang_cepat)." ($persen_pulang%)";
     
      
      if($param['bulan'] >= 2 && $param['tahun'] >= 2023){
        $nominal_potongan = $tpp['tpp_absen'] * $persen / 100;
      }else{
        $nominal_potongan = $tpp['tpp_dinamis'] * $persen / 100;
      }
      $result = array(
        'persen_potongan'   => $persen,
        'nominal_potongan'  => $nominal_potongan,
        'keterangan'        => $keterangan,
      );
    }

    return $result;
  }

  private function get_absen($param)
  {
    $this->db->where("month(tanggal)", $param['bulan']);
    $this->db->where("year(tanggal)", $param['tahun']);
    $this->db->select("sum(masuk_telat) as 'total_masuk_telat', sum(pulang_cepat) as 'total_pulang_cepat'");
    $this->db->where("id_pegawai", $param['id_pegawai']);
    $rs = $this->db->get("absen_log")->row();
    return $rs;
  }

  private function get_absen_pulang_kosong($id_pegawai, $bulan, $tahun)
  {
    $this->db->where('jam_pulang is null');
    $this->db->where('MONTH(tanggal)', $bulan);
    $this->db->where('YEAR(tanggal)', $tahun);
    $this->db->where('id_pegawai', $id_pegawai);
    $this->db->select('count(*) as jml_kosong');
    $get = $this->db->get('absen_log')->row();
    return $get;
  }

  public function hitung_tanpa_keterangan($param)
  {
    $this->load->model("tpp/Tpp_perhitungan_model");
    $result = array();
    $tpp = $this->Tpp_perhitungan_model->get_tpp($param['id_pegawai']);
    if (isset($param['jumlah'])) {

      $pegawai = $this->db->get_where('pegawai', array('id_pegawai' => $param['id_pegawai']))->row();
      if ($pegawai->bebas_absen == "Y") {
        $persen = 0;
      } else {
        if ($param['jumlah'] >= 2) {
          $persen = 10;
        } else if ($param['jumlah'] >= 1) {
          $persen = 5;
        } else {
          $persen = 0;
        }
      }

      $keterangan = "Tanpa keterangan " . $param['jumlah'] . " hari";
      
      if($param['bulan'] >= 2 && $param['tahun'] >= 2023){
        $nominal_potongan = $tpp['tpp_absen'] * $persen / 100;
      }else{
        $nominal_potongan = $tpp['tpp_dinamis'] * $persen / 100;
      }
      $result = array(
        'persen_potongan'   => $persen,
        'nominal_potongan'  => $nominal_potongan,
        'keterangan'        => $keterangan,
      );
    }
    return $result;
  }

  public function hitung_tk_5($param)
  {
    $this->load->model("tpp/Tpp_perhitungan_model");
    $result = array();
    $tpp = $this->Tpp_perhitungan_model->get_tpp($param['id_pegawai']);
    if (isset($param['jumlah'])) {

      $pegawai = $this->db->get_where('pegawai', array('id_pegawai' => $param['id_pegawai']))->row();
      if ($pegawai->bebas_absen == "Y") {
        $persen = 0;
      } else {
        if ($param['jumlah'] >= 5) {
          $persen = 100;
        } else {
          $persen = 0;
        }
      }

      if ($persen > 0 && $tpp['tpp'] > 0) {
        $keterangan = "Tanpa keterangan lebih dari 5 hari yaitu " . $param['jumlah'] . " hari pada bulan ".bulan($param['bulan']);
        $nominal_potongan = $tpp['tpp'] * $persen / 100;
        $result = array(
          'persen_potongan'   => $persen,
          'nominal_potongan'  => $nominal_potongan,
          'keterangan'        => $keterangan,
        );
      }
    }
    return $result;
  }

  public function hitung_tidak_absen_pulang($param)
  {
    $this->load->model("tpp/Tpp_perhitungan_model");
    $result = array();
    $tpp = $this->Tpp_perhitungan_model->get_tpp($param['id_pegawai']);
    $absen_kosong = $this->get_absen_pulang_kosong($param['id_pegawai'], $param['bulan'], $param['tahun']);
    if ($tpp && $absen_kosong) {
      $pegawai = $this->db->get_where('pegawai', array('id_pegawai' => $param['id_pegawai']))->row();
      if ($pegawai->bebas_absen !== "Y") {
        $jumlah = $absen_kosong->jml_kosong;
        if ($jumlah > 0) {
          $persen = 1.5;
          $keterangan = "Tidak Absen Pulang selama " . $jumlah . " hari";
          if($param['bulan'] >= 2 && $param['tahun'] >= 2023){
            $nominal_potongan = $tpp['tpp_absen'] * $jumlah * $persen / 100;
          }else{
            $nominal_potongan = $tpp['tpp_dinamis'] * $jumlah * $persen / 100;
          }
          $persen = $jumlah * $persen;
          $result = array(
            'persen_potongan'   => $persen,
            'nominal_potongan'  => $nominal_potongan,
            'keterangan'        => $keterangan,
          );
        }
      }
    }
    return $result;
  }
}
