<?php
class Tpp_perhitungan_model extends CI_Model
{

  public function tpp_absen($param)
  {
    $this->load->model("tpp/Tpp_absen_model");
    $result = $this->Tpp_absen_model->hitung_absensi($param);
    return $result;
  }

  public function tpp_absen_tanpa_keterangan($param)
  {
    $this->load->model("tpp/Tpp_absen_model");
    $result = $this->Tpp_absen_model->hitung_tanpa_keterangan($param);
    return $result;
  }

  public function tpp_absen_tk5($param)
  {
    $this->load->model("tpp/Tpp_absen_model");
    $result = $this->Tpp_absen_model->hitung_tk_5($param);
    return $result;
  }

  public function tpp_tidak_absen_pulang($param)
  {
    $this->load->model("tpp/Tpp_absen_model");
    $result = $this->Tpp_absen_model->hitung_tidak_absen_pulang($param);
    return $result;
  }

  public function tpp_sakit_ket_dokter($param)
  {
    $result = array();
    $tpp = $this->get_tpp($param['id_pegawai']);
    if (isset($param['jumlah'])) {
      $jumlah = $param['jumlah'];
      if ($jumlah >= 3) {
        $persen = 3;
      } elseif ($jumlah >= 1) {
        $persen = 1.5;
      } else {
        $persen = 0;
      }

      $keterangan = "Sakit dengan keterangan dokter selama " . $param['jumlah'] . " hari";
      $nominal_potongan = $tpp['tpp_dinamis'] * $persen / 100;
      $result = array(
        'persen_potongan'   => $persen,
        'nominal_potongan'  => $nominal_potongan,
        'keterangan'        => $keterangan,
      );
    }
    return $result;
  }

  public function tpp_sakit_rawat_inap($param)
  {
    $result = array();
    $tpp = $this->get_tpp($param['id_pegawai']);
    if (isset($param['jumlah'])) {
      $jumlah = $param['jumlah'];
      if ($jumlah >= 8) {
        $persen = 2;
      } elseif ($jumlah >= 1) {
        $persen = 1;
      } else {
        $persen = 0;
      }

      $keterangan = "Sakit Rawat Inap selama " . $param['jumlah'] . " hari";
      $nominal_potongan = $tpp['tpp_dinamis'] * $persen / 100;
      $result = array(
        'persen_potongan'   => $persen,
        'nominal_potongan'  => $nominal_potongan,
        'keterangan'        => $keterangan,
      );
    }
    return $result;
  }

  public function tpp_cuti_alasan_penting($param)
  {
    $result = array();
    $tpp = $this->get_tpp($param['id_pegawai']);
    if (isset($param['jumlah'])) {
      $jumlah = $param['jumlah'];
      if ($jumlah >= 10) { // lebih dari 10 hari
        $persen = 3;
      } elseif ($jumlah >= 1) { // 1 - 9 hari
        $persen = 0;
      } else {
        $persen = 0;
      }

      $keterangan = "Cuti Alasan Penting selama " . $param['jumlah'] . " hari";
      $nominal_potongan = $tpp['tpp_dinamis'] * $persen / 100;
      $result = array(
        'persen_potongan'   => $persen,
        'nominal_potongan'  => $nominal_potongan,
        'keterangan'        => $keterangan,
      );
    }
    return $result;
  }

  public function tpp_cuti_tahunan($param)
  {
    $result = array();
    $tpp = $this->get_tpp($param['id_pegawai']);
    if (isset($param['jumlah'])) {
      $jumlah = $param['jumlah'];
      if ($jumlah >= 7) { // 7-12 hari
        $persen = 5;
      } elseif ($jumlah >= 1) { // 1-6 hari
        $persen = 3;
      } else {
        $persen = 0;
      }

      $keterangan = "Cuti Tahunan selama " . $param['jumlah'] . " hari";
      $nominal_potongan = $tpp['tpp_dinamis'] * $persen / 100;
      $result = array(
        'persen_potongan'   => $persen,
        'nominal_potongan'  => $nominal_potongan,
        'keterangan'        => $keterangan,
      );
    }
    return $result;
  }
  public function tpp_cuti_besar($param)
  {
    $result = array();
    $tpp = $this->get_tpp($param['id_pegawai']);
    // if (isset($param['jumlah'])) {
    $persen = 10;
    $keterangan = "Cuti Besar pada bulan " . bulan($param['bulan']);
    $nominal_potongan = $tpp['tpp_dinamis'] * $persen / 100;
    $result = array(
      'persen_potongan'   => $persen,
      'nominal_potongan'  => $nominal_potongan,
      'keterangan'        => $keterangan,
    );
    // }
    return $result;
  }
  public function tpp_teguran_lisan($param)
  {
    $result = array();
    $tpp = $this->get_tpp($param['id_pegawai']);
    // if (isset($param['jumlah'])) {
    $persen = 20;
    $keterangan = "Teguran Lisan berlaku pada Bulan " . bulan($param['bulan']);
    $nominal_potongan = $tpp['tpp_dinamis'] * $persen / 100;
    $result = array(
      'persen_potongan'   => $persen,
      'nominal_potongan'  => $nominal_potongan,
      'keterangan'        => $keterangan,
    );
    // }
    return $result;
  }

  public function tpp_teguran_tertulis($param)
  {
    $result = array();
    $tpp = $this->get_tpp($param['id_pegawai']);
    // if (isset($param['jumlah'])) {
    $persen = 20;
    $keterangan = "Teguran Tertulis berlaku pada Bulan " . bulan($param['bulan']);
    $nominal_potongan = $tpp['tpp_dinamis'] * $persen / 100;
    $result = array(
      'persen_potongan'   => $persen,
      'nominal_potongan'  => $nominal_potongan,
      'keterangan'        => $keterangan,
    );
    // }
    return $result;
  }

  public function tpp_pernyataan_tidak_puas($param)
  {
    $result = array();
    $tpp = $this->get_tpp($param['id_pegawai']);
    // if (isset($param['jumlah'])) {
    $persen = 100;
    $keterangan = "Pernyataan tidak Puas berlaku pada Bulan " . bulan($param['bulan']);
    $nominal_potongan = $tpp['tpp_dinamis'] * $persen / 100;
    $result = array(
      'persen_potongan'   => $persen,
      'nominal_potongan'  => $nominal_potongan,
      'keterangan'        => $keterangan,
    );
    // }
    return $result;
  }

  public function tpp_penundaan_gaji_berkala($param)
  {
    $result = array();
    $tpp = $this->get_tpp($param['id_pegawai']);
    // if (isset($param['jumlah'])) {
    $persen = 30;
    $keterangan = "Penundanaan Gaji Berkala selama 1 Tahun berlaku pada Bulan " . bulan($param['bulan']);
    $nominal_potongan = $tpp['tpp_dinamis'] * $persen / 100;
    $result = array(
      'persen_potongan'   => $persen,
      'nominal_potongan'  => $nominal_potongan,
      'keterangan'        => $keterangan,
    );
    // }
    return $result;
  }

  public function tpp_penundaan_naik_pangkat($param)
  {
    $result = array();
    $tpp = $this->get_tpp($param['id_pegawai']);
    // if (isset($param['jumlah'])) {
    $persen = 30;
    $keterangan = "Penundanaan Kenaikan Pangkat selama 1 Tahun berlaku pada Bulan " . bulan($param['bulan']);
    $nominal_potongan = $tpp['tpp_dinamis'] * $persen / 100;
    $result = array(
      'persen_potongan'   => $persen,
      'nominal_potongan'  => $nominal_potongan,
      'keterangan'        => $keterangan,
    );
    // }
    return $result;
  }

  public function tpp_penurunan_pangkat_1($param)
  {
    $result = array();
    $tpp = $this->get_tpp($param['id_pegawai']);
    // if (isset($param['jumlah'])) {
    $persen = 30;
    $keterangan = "Penurunan Pangkat 1 tingkat selama 1 Tahun berlaku pada Bulan " . bulan($param['bulan']);
    $nominal_potongan = $tpp['tpp_dinamis'] * $persen / 100;
    $result = array(
      'persen_potongan'   => $persen,
      'nominal_potongan'  => $nominal_potongan,
      'keterangan'        => $keterangan,
    );
    // }
    return $result;
  }

  public function tpp_penurunan_pangkat_3($param)
  {
    $result = array();
    $tpp = $this->get_tpp($param['id_pegawai']);
    // if (isset($param['jumlah'])) {
    $persen = 40;
    $keterangan = "Penurunan Pangkat 1 tingkat selama 3 Tahun berlaku pada Bulan " . bulan($param['bulan']);
    $nominal_potongan = $tpp['tpp_dinamis'] * $persen / 100;
    $result = array(
      'persen_potongan'   => $persen,
      'nominal_potongan'  => $nominal_potongan,
      'keterangan'        => $keterangan,
    );
    // }
    return $result;
  }

  public function tpp_pemindahan_penurunan($param)
  {
    $result = array();
    $tpp = $this->get_tpp($param['id_pegawai']);
    // if (isset($param['jumlah'])) {
    $persen = 40;
    $keterangan = "Pemindahan dalam rangka penurunan jabatan setingkat lebih rendah berlaku pada Bulan " . bulan($param['bulan']);
    $nominal_potongan = $tpp['tpp_dinamis'] * $persen / 100;
    $result = array(
      'persen_potongan'   => $persen,
      'nominal_potongan'  => $nominal_potongan,
      'keterangan'        => $keterangan,
    );
    // }
    return $result;
  }

  public function tpp_diberhentikan($param)
  {
    $result = array();
    $tpp = $this->get_tpp($param['id_pegawai']);
    // if (isset($param['jumlah'])) {
    $persen = 50;
    $keterangan = "Diberhentikan dari jabatan dijatuhkan disiplin tingkat berat berlaku pada Bulan " . bulan($param['bulan']);
    $nominal_potongan = $tpp['tpp_dinamis'] * $persen / 100;
    $result = array(
      'persen_potongan'   => $persen,
      'nominal_potongan'  => $nominal_potongan,
      'keterangan'        => $keterangan,
    );
    // }
    return $result;
  }

  public function tpp_banding_ke_bpk($param)
  {
    $result = array();
    $tpp = $this->get_tpp($param['id_pegawai']);
    // if (isset($param['jumlah'])) {
    $persen = 50;
    $keterangan = "Melakukan banding ke Badan Pertimbangan Kepegawaian berlaku pada Bulan " . bulan($param['bulan']);
    $nominal_potongan = $tpp['tpp'] * $persen / 100;
    $result = array(
      'persen_potongan'   => $persen,
      'nominal_potongan'  => $nominal_potongan,
      'keterangan'        => $keterangan,
    );
    // }
    return $result;
  }


  public function tpp_cuti_satu_bulan($param)
  {
    $result = array();
    $tpp = $this->get_tpp($param['id_pegawai']);
    if (isset($param['jumlah']) && $param['jumlah'] > 0) {
      $persen = 100;
      $keterangan = "Cuti 1 Bulan atau Lebih pada Bulan " . bulan($param['bulan']);
      $nominal_potongan = $tpp['tpp'] * $persen / 100;
      $result = array(
        'persen_potongan'   => $persen,
        'nominal_potongan'  => $nominal_potongan,
        'keterangan'        => $keterangan,
      );
    }
    return $result;
  }

  public function tpp_mpp($param)
  {
    $result = array();
    $tpp = $this->get_tpp($param['id_pegawai']);
    if (isset($param['jumlah']) && $param['jumlah'] > 0) {
      $persen = 100;
      $keterangan = "Masa Persiapan Pensiun berlaku pada Bulan " . bulan($param['bulan']);
      $nominal_potongan = $tpp['tpp'] * $persen / 100;
      $result = array(
        'persen_potongan'   => $persen,
        'nominal_potongan'  => $nominal_potongan,
        'keterangan'        => $keterangan,
      );
    }
    return $result;
  }
  public function tpp_tugas_belajar($param)
  {
    $result = array();
    $tpp = $this->get_tpp($param['id_pegawai']);
    if (isset($param['jumlah']) && $param['jumlah'] > 0) {
      $persen = 100;
      $keterangan = "Tugas Belajar berlaku pada Bulan " . bulan($param['bulan']);
      $nominal_potongan = $tpp['tpp'] * $persen / 100;
      $result = array(
        'persen_potongan'   => $persen,
        'nominal_potongan'  => $nominal_potongan,
        'keterangan'        => $keterangan,
      );
    }
    return $result;
  }





  public function tpp_lkh($param)
  {
    $this->load->model("kinerja/Laporan_model", "Laporan_kinerja_model");
    $result = array();
    $tpp = $this->get_tpp($param['id_pegawai']);
    $pegawai = $this->db->get_where('pegawai', array('id_pegawai' => $param['id_pegawai']))->row();

    
    $capaian_kualitas = 0;
    if($param['bulan'] >= 2 && $param['tahun'] >= 2023){
    //update pegawai_posisi
      $cek = $this->db->get_where('pegawai_posisi',[
        'id_pegawai'=>$param['id_pegawai'],
        'bulan' => $param['bulan'],
        'tahun' => $param['tahun']
      ])->row();

      if(!empty($cek)){
          $param['group_by'] = "ASN";
          $param['where']['skp.tahun_desc'] = $param['tahun'];
          $param['bulan'] = $param['bulan'];
          $param['where']['pegawai.id_pegawai'] = $param['id_pegawai'];
          $summary = $this->Laporan_kinerja_model->getSummary($param)->result();
          if(isset($summary[0])){
            $capaian_kualitas = $summary[0]->capaian;
          }else{
            $capaian_kualitas = 0;
          }
          $data_update = ['kinerja_kualitas'=>$capaian_kualitas,'kinerja_kuantitas'=>$param['persentase']];
          $update = $this->db->update('pegawai_posisi',$data_update,['id_pegawai_posisi'=>$cek->id_pegawai_posisi]);
      } 
        if ($pegawai->bebas_lkh == "Y") {
          $persen_potongan = 0;
        } else {
          $kuantitas = $param['persentase'];
          $kualitas = $capaian_kualitas;
          $jumlah = ($kuantitas + $kualitas) / 2;
          $persen_potongan = 100 - $jumlah;
        }   
        $string_keterangan = "Capaian Kinerja adalah sebesar ".$jumlah.'%';
    }else{
      if ($pegawai->bebas_lkh == "Y") {
        $persen_potongan = 0;
      } else {
        $jumlah = $param['persentase'];
        if ($jumlah < 80) {
          $persen_potongan = 20;
        } else {
          $persen_potongan = 0;
        }
      }
      $string_keterangan = "LKH kurang dari 80% yaitu : $param[persentase]%";
    }

    if ($persen_potongan > 0 && $tpp['tpp_dinamis'] > 0) {
      $result['persen_potongan'] = $persen_potongan;
      $result['nominal_potongan'] = $tpp['tpp_dinamis'] * ($persen_potongan / 100);
      $result['keterangan'] = $string_keterangan;
    }
    return $result;
  }

  public function get_tpp($id_pegawai,$bulan='',$tahun='')
  {

    $bulan = empty($bulan) ? date('m') - 1 : $bulan;
    $tahun = empty($tahun) ? date('Y'): $tahun;

    if((date('m') - 1) == 0){
      $bulan = 12;
      $tahun = date('Y') - 1;
    }

    $pegawai = $this->db->get_where('pegawai_posisi',['id_pegawai'=>$id_pegawai,'bulan'=>$bulan,'tahun'=>$tahun])->row();
    if ($pegawai ) {
      $tpp = $pegawai->tpp;
      $grade = $pegawai->grade;
      if($bulan >= 2 && $tahun >= 2023){
        return array(
          'tpp'   => $tpp,
          'tpp_statis'  => ($tpp * 60 / 100),
          'tpp_absen'  => ($tpp * 10 / 100),
          'tpp_dinamis'  => ($tpp * 30 / 100),
          'grade' => $grade
        );
      }else{
        return array(
          'tpp'   => $tpp,
          'tpp_statis'  => ($tpp * 70 / 100),
          'tpp_dinamis'  => ($tpp * 30 / 100),
          'grade' => $grade
        );
      }
    } else {
      return false;
    }
  }


  public function get_pajak($id_pegawai)
  {
    $pegawai = $this->db->get_where('pegawai', array('id_pegawai' => $id_pegawai))->row();
    if ($pegawai) {
      $golongan = $pegawai->golongan;
      $pajak = $this->hitung_pajak($golongan);
      return $pajak;
    } else {
      return false;
    }
  }

  public function hitung_pajak($golongan){
      $pajak = 0;
      if (!empty($golongan)) {
        $ex_gol = explode('/', $golongan);
        $golongan = strtoupper(trim($ex_gol[0]));
        if ($golongan == "I" || $golongan == "II") {
          $pajak = 0;
        } elseif ($golongan == "III") {
          $pajak = 5;
        } elseif ($golongan == "IV") {
          $pajak = 15;
        }
      }
      return $pajak;
  }

  public function get_potongan($id_pegawai, $bulan, $tahun)
  {
    $this->db->select('sum(nominal_potongan) as jml_potongan');
    $this->db->group_by('id_pegawai');
    $get = $this->db->get_where('tpp_log', array('id_pegawai' => $id_pegawai, 'bulan' => $bulan, 'tahun' => $tahun))->row();
    return $get;
  }
  public function get_potongan_by_jenis($id_pegawai, $bulan, $tahun, $jenis)
  {
    $this->db->select('sum(nominal_potongan) as jml_potongan');
    $this->db->group_by('id_pegawai');
    $this->db->join('ref_ket_absen', 'ref_ket_absen.id_ket_absen = tpp_log.id_ket_log');
    $get = $this->db->get_where('tpp_log', array('id_pegawai' => $id_pegawai, 'bulan' => $bulan, 'tahun' => $tahun, 'ref_ket_absen.jenis' => $jenis))->row();
    if ($get) {
      $potongan = $get->jml_potongan;
    } else {
      $potongan = 0;
    }
    return $potongan;
  }

  public function hitung_ulang_pegawai($id_pegawai)
  {

    $this->load->model('ref_ket_absen_model');
    $this->load->model('laporan_kinerja_harian_model');
    $this->load->model('absen_model');
    $this->load->model('tpp/tpp_model');
    $this->load->model('master_pegawai_model');
    $this->load->model('ref_hari_kerja_efektif_model');

    $log = $this->db->get_where('absen_ket_log', array('id_pegawai' => $id_pegawai))->result();
    // print_r($log);die;
    foreach ($log as $l) {
      $id_pegawai = $l->id_pegawai;
      $pegawai = $this->master_pegawai_model->get_by_id($id_pegawai);
      $bulan = date("m", strtotime($l->tanggal_awal));
      $tahun = date("Y", strtotime($l->tanggal_awal));
      $lkh_p = $this->laporan_kinerja_harian_model->get_single_pegawai($id_pegawai, $bulan, $tahun);

      $efektif = $this->ref_hari_kerja_efektif_model->get_by_bulan($bulan);
      $ket_absen = $this->ref_ket_absen_model->get_by_id($l->id_ket_absen);
      // pengecualian :
      // DL = Dinas Luar; DD = Dinas Dalam; WH = Work from home, IM = Isolasi mandiri
      // Dianggap hadir (tidak masuk potongan TPP)
      if (in_array($l->id_ket_absen, ['DL', 'DD', 'WH', 'IM'])) {
        $tanggal = $l->tanggal_awal;
        $tanggal_akhir = $l->tanggal_akhir;
        while ($tanggal <= $tanggal_akhir) {
          $this->absen_model->insert_absen($id_pegawai, $tanggal);
          $tanggal = date("Y-m-d", strtotime($tanggal . " +1 days"));
        }
      } else {
        $param = array(
          'id_pegawai'  => $id_pegawai,
          'bulan'       => date("m", strtotime($l->tanggal_awal)),
          'tahun'       => date("Y", strtotime($l->tanggal_awal)),
          'id_ket_log'  => $l->id_ket_absen,
          'jumlah' => 0
        );
        $save_tpp = $this->tpp_model->simpan($param);
      }


      //Sakit dan Cuti
      if (in_array($l->id_ket_absen, [5, 6, 7, 8, 9])) {
        $range = getDatesFromRange($l->tanggal_awal, $l->tanggal_akhir);
        foreach ($range as $tgl_lkh) {
          $data_lkh = array(
            'id_pegawai' => $id_pegawai,
            'id_skpd' => $pegawai->id_skpd,
            'tanggal' => $tgl_lkh,
            'rincian_kegiatan' => $ket_absen->ket_absen,
            'hasil_kegiatan' => '-',
            'lampiran' => NULL,
            'id_verifikator' => 0,
            'status_verifikasi' => 'sudah_diverifikasi',
            'automated' => 1
          );
          //Insert ke Laporan Kinerja Harian
          $insert_lkh = $this->laporan_kinerja_harian_model->insert($data_lkh);

          if ($lkh_p->jumlah_lkh == 0 || $efektif == 0) {
            $persentase = 0;
          } else {
            $persentase = round(($lkh_p->jumlah_lkh / $efektif) * 100, 2);
          }

          if ($bulan == 9 && $tahun == 2020) {
            $tpp = $this->get_tpp($lkh_p->id_pegawai);
            $param = array('id_ket_log' => 'L1', 'persentase' => $persentase, 'bulan' => $bulan, 'tahun' => $tahun, 'id_pegawai' => $lkh_p->id_pegawai, 'tpp' => $tpp);
            $save = $this->tpp_model->simpan($param);
          }
          $where_absen = array(
            'id_pegawai' => $id_pegawai,
            'tanggal' => $tgl_lkh,
          );
          //Hapus Absen
          $delete_absen = $this->absen_model->delete_log($where_absen);
        }
      }
    }
  }

  public function cek_tidak_dapat_tpp($id_pegawai, $bulan, $tahun)
  {
    $this->db->join('ref_ket_absen', 'ref_ket_absen.id_ket_absen = absen_ket_log.id_ket_absen');
    $absen_log = $this->db->get_where('absen_ket_log', array('id_pegawai' => $id_pegawai, 'MONTH(tanggal_awal)' => $bulan, 'YEAR(tanggal_awal)' => $tahun))->result();

    $tidak_dapat_tpp = false;
    foreach ($absen_log as $l) {
      if ($l->tidak_dapat_tpp == 1) {
        $tidak_dapat_tpp = true;
        break;
      }
    }
    return $tidak_dapat_tpp;
  }
}
