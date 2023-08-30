<?php
class Tpp_model extends CI_Model
{

  /*
  @param
  id_pegawai
  bulan : 1 - 12
  tahun
  id_ket_log
  */

  public function simpan($param)
  {
    $this->load->model("tpp/Tpp_perhitungan_model");
    $log = array();
    //A1 = Terlambat dan Pulang Cepat
    if ($param['id_ket_log'] == "A1") {
      $hitung_tpp = $this->Tpp_perhitungan_model->tpp_absen($param);
    } elseif ($param['id_ket_log'] == "A3") {
      $hitung_tpp = $this->Tpp_perhitungan_model->tpp_tidak_absen_pulang($param);
    }  elseif ($param['id_ket_log'] == "L1") {
      $hitung_tpp = $this->Tpp_perhitungan_model->tpp_lkh($param);
    } elseif ($param['id_ket_log'] == "A2") {
      $jml = $this->get_jumlah_ket_log($param['id_pegawai'], $param['bulan'], $param['tahun'], $param['id_ket_log']);
      if ($jml) {
        $param['jumlah'] = !empty($jml->total_jumlah) ? $jml->total_jumlah : 0;
      }
      $hitung_tpp = $this->Tpp_perhitungan_model->tpp_absen_tanpa_keterangan($param);
    } elseif ($param['id_ket_log'] == "A4") {
      $jml = $this->get_jumlah_ket_log($param['id_pegawai'], $param['bulan'], $param['tahun'], "A2");
      if ($jml) {
        $param['jumlah'] = !empty($jml->total_jumlah) ? $jml->total_jumlah : 0;
      }
      $hitung_tpp = $this->Tpp_perhitungan_model->tpp_absen_tk5($param);
    } elseif ($param['id_ket_log'] == 5) {
      $jml = $this->get_jumlah_ket_log($param['id_pegawai'], $param['bulan'], $param['tahun'], $param['id_ket_log']);
      if ($jml) {
        $param['jumlah'] = !empty($jml->total_jumlah) ? $jml->total_jumlah : 0;
      }
      $hitung_tpp = $this->Tpp_perhitungan_model->tpp_sakit_ket_dokter($param);
    } elseif ($param['id_ket_log'] == 6) {
      $jml = $this->get_jumlah_ket_log($param['id_pegawai'], $param['bulan'], $param['tahun'], $param['id_ket_log']);
      if ($jml) {
        $param['jumlah'] = !empty($jml->total_jumlah) ? $jml->total_jumlah : 0;
      }
      $hitung_tpp = $this->Tpp_perhitungan_model->tpp_sakit_rawat_inap($param);
    } elseif ($param['id_ket_log'] == 7) {
      $jml = $this->get_jumlah_ket_log($param['id_pegawai'], $param['bulan'], $param['tahun'], $param['id_ket_log']);
      if ($jml) {
        $param['jumlah'] = !empty($jml->total_jumlah) ? $jml->total_jumlah : 0;
      }
      $hitung_tpp = $this->Tpp_perhitungan_model->tpp_cuti_alasan_penting($param);
    } elseif ($param['id_ket_log'] == 8) {
      $jml = $this->get_jumlah_ket_log($param['id_pegawai'], $param['bulan'], $param['tahun'], $param['id_ket_log']);
      if ($jml) {
        $param['jumlah'] = !empty($jml->total_jumlah) ? $jml->total_jumlah : 0;
      }
      $hitung_tpp = $this->Tpp_perhitungan_model->tpp_cuti_tahunan($param);
    } elseif ($param['id_ket_log'] == 9) {
      $jml = $this->get_jumlah_ket_log($param['id_pegawai'], $param['bulan'], $param['tahun'], $param['id_ket_log']);
      if ($jml) {
        $param['jumlah'] = !empty($jml->total_jumlah) ? $jml->total_jumlah : 0;
      }
      $hitung_tpp = $this->Tpp_perhitungan_model->tpp_cuti_besar($param);
    } elseif ($param['id_ket_log'] == 10) {
      $jml = $this->get_jumlah_ket_log($param['id_pegawai'], $param['bulan'], $param['tahun'], $param['id_ket_log']);
      if ($jml) {
        $param['jumlah'] = !empty($jml->total_jumlah) ? $jml->total_jumlah : 0;
      }
      $hitung_tpp = $this->Tpp_perhitungan_model->tpp_teguran_lisan($param);
    } elseif ($param['id_ket_log'] == 11) {
      $jml = $this->get_jumlah_ket_log($param['id_pegawai'], $param['bulan'], $param['tahun'], $param['id_ket_log']);
      if ($jml) {
        $param['jumlah'] = !empty($jml->total_jumlah) ? $jml->total_jumlah : 0;
      }
      $hitung_tpp = $this->Tpp_perhitungan_model->tpp_teguran_tertulis($param);
    } elseif ($param['id_ket_log'] == 9) {
      $jml = $this->get_jumlah_ket_log($param['id_pegawai'], $param['bulan'], $param['tahun'], $param['id_ket_log']);
      if ($jml) {
        $param['jumlah'] = !empty($jml->total_jumlah) ? $jml->total_jumlah : 0;
      }
      $hitung_tpp = $this->Tpp_perhitungan_model->tpp_cuti_besar($param);
    } elseif ($param['id_ket_log'] == 12) {
      $jml = $this->get_jumlah_ket_log($param['id_pegawai'], $param['bulan'], $param['tahun'], $param['id_ket_log']);
      if ($jml) {
        $param['jumlah'] = !empty($jml->total_jumlah) ? $jml->total_jumlah : 0;
      }
      $hitung_tpp = $this->Tpp_perhitungan_model->tpp_pernyataan_tidak_puas($param);
    } elseif ($param['id_ket_log'] == 13) {
      $jml = $this->get_jumlah_ket_log($param['id_pegawai'], $param['bulan'], $param['tahun'], $param['id_ket_log']);
      if ($jml) {
        $param['jumlah'] = !empty($jml->total_jumlah) ? $jml->total_jumlah : 0;
      }
      $hitung_tpp = $this->Tpp_perhitungan_model->tpp_penundaan_gaji_berkala($param);
    } elseif ($param['id_ket_log'] == 14) {
      $jml = $this->get_jumlah_ket_log($param['id_pegawai'], $param['bulan'], $param['tahun'], $param['id_ket_log']);
      if ($jml) {
        $param['jumlah'] = !empty($jml->total_jumlah) ? $jml->total_jumlah : 0;
      }
      $hitung_tpp = $this->Tpp_perhitungan_model->tpp_penundaan_naik_pangkat($param);
    } elseif ($param['id_ket_log'] == 15) {
      $jml = $this->get_jumlah_ket_log($param['id_pegawai'], $param['bulan'], $param['tahun'], $param['id_ket_log']);
      if ($jml) {
        $param['jumlah'] = !empty($jml->total_jumlah) ? $jml->total_jumlah : 0;
      }
      $hitung_tpp = $this->Tpp_perhitungan_model->tpp_penurunan_pangkat_1($param);
    } elseif ($param['id_ket_log'] == 16) {
      $jml = $this->get_jumlah_ket_log($param['id_pegawai'], $param['bulan'], $param['tahun'], $param['id_ket_log']);
      if ($jml) {
        $param['jumlah'] = !empty($jml->total_jumlah) ? $jml->total_jumlah : 0;
      }
      $hitung_tpp = $this->Tpp_perhitungan_model->tpp_penurunan_pangkat_3($param);
    } elseif ($param['id_ket_log'] == 17) {
      $jml = $this->get_jumlah_ket_log($param['id_pegawai'], $param['bulan'], $param['tahun'], $param['id_ket_log']);
      if ($jml) {
        $param['jumlah'] = !empty($jml->total_jumlah) ? $jml->total_jumlah : 0;
      }
      $hitung_tpp = $this->Tpp_perhitungan_model->tpp_pemindahan_penurunan($param);
    } elseif ($param['id_ket_log'] == 18) {
      $jml = $this->get_jumlah_ket_log($param['id_pegawai'], $param['bulan'], $param['tahun'], $param['id_ket_log']);
      if ($jml) {
        $param['jumlah'] = !empty($jml->total_jumlah) ? $jml->total_jumlah : 0;
      }
      $hitung_tpp = $this->Tpp_perhitungan_model->tpp_diberhentikan($param);
    } elseif ($param['id_ket_log'] == 19) {
      $jml = $this->get_jumlah_ket_log($param['id_pegawai'], $param['bulan'], $param['tahun'], $param['id_ket_log']);
      if ($jml) {
        $param['jumlah'] = !empty($jml->total_jumlah) ? $jml->total_jumlah : 0;
      }
      $hitung_tpp = $this->Tpp_perhitungan_model->tpp_banding_ke_bpk($param);
    } elseif ($param['id_ket_log'] == 22) {
      $jml = $this->get_jumlah_ket_log($param['id_pegawai'], $param['bulan'], $param['tahun'], $param['id_ket_log']);
      if ($jml) {
        $param['jumlah'] = !empty($jml->total_jumlah) ? $jml->total_jumlah : 0;
      }
      $this->db->delete('tpp_log',array('id_pegawai'=>$param['id_pegawai'],'bulan'=>$param['bulan'],'tahun'=>$param['tahun']));
      $hitung_tpp = $this->Tpp_perhitungan_model->tpp_cuti_satu_bulan($param);
    } elseif ($param['id_ket_log'] == 20) {
      $jml = $this->get_jumlah_ket_log($param['id_pegawai'], $param['bulan'], $param['tahun'], $param['id_ket_log']);
      if ($jml) {
        $param['jumlah'] = !empty($jml->total_jumlah) ? $jml->total_jumlah : 0;
      }
      $this->db->delete('tpp_log',array('id_pegawai'=>$param['id_pegawai'],'bulan'=>$param['bulan'],'tahun'=>$param['tahun']));
      $hitung_tpp = $this->Tpp_perhitungan_model->tpp_tugas_belajar($param);
    } elseif ($param['id_ket_log'] == "M1") {
      $jml = $this->get_jumlah_ket_log($param['id_pegawai'], $param['bulan'], $param['tahun'], $param['id_ket_log']);
      if ($jml) {
        $param['jumlah'] = !empty($jml->total_jumlah) ? $jml->total_jumlah : 0;
      }
      $this->db->delete('tpp_log',array('id_pegawai'=>$param['id_pegawai'],'bulan'=>$param['bulan'],'tahun'=>$param['tahun']));
      $hitung_tpp = $this->Tpp_perhitungan_model->tpp_mpp($param);
    }


    $param_cek = array(
      'id_pegawai'    => $param['id_pegawai'],
      'bulan'         => $param['bulan'],
      'tahun'         => $param['tahun'],
      'id_ket_log'    => $param['id_ket_log'],
    );

    if (isset($hitung_tpp['persen_potongan']) && $hitung_tpp['persen_potongan'] > 0) {
      $log = $hitung_tpp;
    } elseif ((isset($hitung_tpp['persen_potongan']) && ($hitung_tpp['persen_potongan'] == 0 && $hitung_tpp['nominal_potongan'] == 0)) || empty($hitung_tpp)) {
      $this->db->delete('tpp_log',$param_cek);
    }

    if ($log) {
      $cek = $this->db->where($param_cek)->get("tpp_log");
      if ($cek->num_rows() == 0) {
        $dt = array_merge($log, $param_cek);
        $this->db->insert("tpp_log", $dt);
      } else {
        $this->db->where($param_cek);
        $this->db->update("tpp_log", $log);
      }
      return $log;
    }
  }


  public function get_absen_ket_log($id_pegawai, $bulan, $tahun, $id_ket_absen,$no_last_date=false)
  {
    $this->db->where("month(tanggal_awal)", $bulan);
    $this->db->where("year(tanggal_awal)", $tahun);
    if($no_last_date==false){
      $this->db->where("month(tanggal_akhir)", $bulan);
      $this->db->where("year(tanggal_akhir)", $tahun);
    }
    $this->db->where("id_ket_absen", $id_ket_absen);
    $this->db->select("sum(jumlah) as 'total_jumlah'");
    $this->db->where("id_pegawai", $id_pegawai);
    $rs = $this->db->get("absen_ket_log")->row();
    return $rs;
  }

  public function get_jumlah_ket_log($id_pegawai, $bulan, $tahun, $id_ket_absen){
    $this->db->where("absen_ket_log.id_ket_absen", $id_ket_absen);
    $this->db->where("absen_ket_log.id_pegawai", $id_pegawai);
    $this->db->where("month(absen_ket_log_detail.tanggal)", $bulan);
    $this->db->where("year(absen_ket_log_detail.tanggal)", $tahun);
    $this->db->join('absen_ket_log','absen_ket_log.id_ket_log = absen_ket_log_detail.id_ket_log');
    $this->db->select('COUNT(*) as total_jumlah');
    $rs = $this->db->get("absen_ket_log_detail")->row();
    return $rs;
  }

  public function get_log_pegawai($id_pegawai, $bulan, $tahun)
  {
    $get = $this->db->get_where('tpp_log', array('id_pegawai' => $id_pegawai, 'bulan' => $bulan, 'tahun' => $tahun))->result();
    return $get;
  }
}
