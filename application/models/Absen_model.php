<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Absen_model extends CI_Model
{
  public function get_log($param = null)
  {
    if (isset($param['where'])) {
      $this->db->where($param['where']);
    }
    $this->db->order_by("tanggal", "ASC");
    $this->db->group_by("tanggal");
    $this->db->join("absen_shift", "absen_shift.id_shift = absen_log.id_shift", "left");
    $this->db->select('absen_log.*,absen_shift.nama_shift,absen_shift.jam_masuk as shift_masuk,absen_shift.jam_pulang as shift_pulang');
    $rs = $this->db->get("absen_log");
    return $rs;
  }

  public function delete_log($where)
  {
    return $this->db->delete('absen_log', $where);
  }


  public function get_shift_setting($param = null)
  {
    if (isset($param['where'])) {
      $this->db->where($param['where']);
    }
    $this->db->select("absen_shift_setting.*, absen_shift.jam_masuk, absen_shift.jam_pulang");
    $this->db->join("absen_shift", "absen_shift.id_shift = absen_shift_setting.aktif_shift", "left");
    $rs = $this->db->get("absen_shift_setting");
    return $rs;
  }
  public function get_shift($param = null)
  {
    if (isset($param['where'])) {
      $this->db->where($param['where']);
    }

    $rs = $this->db->get("absen_shift");
    return $rs;
  }

  public function isHoliday($date, $id_shift = null)
  {
    $isHoliday = false;
    // khusus shift pagi, siang dan malam, tidak ada hari libur
    if (!in_array($id_shift, [6, 7, 8])) {
      $libur = $this->db->where("tanggal_libur", $date)->get("ref_hari_libur");
      if ($libur->num_rows() > 0) {
        $isHoliday = true;
      }
    }

    return $isHoliday;

    //return false; // di by pass. tidak ada hari libur 6jun2020
    /*
    $isWeekend = (date('N', strtotime($date)) > 6);
    if($isWeekend){
    return true;
    }
    return false;
    */
  }


  public function get_pegawai($param = null)
  {

    if (isset($param['where'])) {
      $this->db->where($param['where']);
    }

    $this->db->where("absen_log.jam_masuk is not null");
    // $this->db->where("absen_log.jam_pulang is not null");
    $this->db->where("pegawai.pensiun", 0);

    $this->db->order_by('pegawai.nama_lengkap');
    $this->db->join('pegawai', 'pegawai.id_pegawai = absen_log.id_pegawai');
    $this->db->join('ref_skpd', 'ref_skpd.id_skpd = pegawai.id_skpd');
    $this->db->join('user', 'user.id_pegawai = pegawai.id_pegawai');

    $this->db->group_by('absen_log.id_pegawai');
    $this->db->select('user.api_key, pegawai.nip, absen_log.id_pegawai,
    pegawai.nama_lengkap,ref_skpd.nama_skpd,
    SUM((IF(jam_masuk is not null and jam_pulang is not null,1,0))) as jumlah,
    SUM((IF(jam_pulang IS NULL,1,0))) as jumlah_tap,
    sum(masuk_telat) as total_masuk_telat, sum(pulang_cepat) as total_pulang_cepat,
    sum(waktu_kerja) as total_waktu_kerja
    ');

    // $this->db->where("user.api_key is not null");

    return $this->db->get('(SELECT DISTINCT tanggal as tgl,absen_log.* FROM absen_log) as absen_log');
  }

  public function inquiry($id_pegawai, $param = array())
  {
    $jenis = "";
    $error = false;
    $message = "";
    $tempat = "";

    $batas_waktu_absen_masuk = 90; //menit
    $batas_waktu_absen_pulang = 90; //menit

    $radius_is_valid = true;

    if (isset($param['radius'])) {

      $tempat = "Kantor";

      $pegawai = $this->db
        ->join("ref_skpd", "ref_skpd.id_skpd = pegawai.id_skpd", "left")
        ->where("id_pegawai", $id_pegawai)
        ->get("pegawai")->row();

      $latitude_skpd = $pegawai->latitude;
      $longitude_skpd = $pegawai->longitude;

      if ($pegawai->id_ref_skpd_sub) {
        $lokasi = $this->db
          ->where("ref_skpd_sub.id_ref_skpd_sub", $pegawai->id_ref_skpd_sub)
          ->get("ref_skpd_sub")
          ->row();
        $latitude_skpd = $lokasi->latitude;
        $longitude_skpd = $lokasi->longitude;
      }

      if (isset($param['latitude']) && isset($param['longitude']) && $latitude_skpd && $longitude_skpd) {
        $latitude = floatval($param['latitude']);
        $longitude = floatval($param['longitude']);

        $latitude2 = floatval($latitude_skpd);
        $longitude2 = floatval($longitude_skpd);

        $this->load->helper("distance");
        $unit = "M";
        $batas_radius = 170; // meter
        if (isset($param['dinas_dalam'])) {
          $unit = "K";
          $batas_radius = 100; // Kilo Meter
          $tempat = "Dinas Dalam";
        }

        $distance = distance($latitude, $longitude, $latitude2, $longitude2, $unit);

        if ($distance > $batas_radius) {
          $radius_is_valid = false;
        }
      } else {
        $radius_is_valid = false;
      }
    }


    $param_shift_setting['where']['absen_shift_setting.id_pegawai'] = $id_pegawai;
    $shift_setting = $this->get_shift_setting($param_shift_setting)->row();



    if (!$radius_is_valid) {
      $error = true;
      $message = "Lokasi diluar jangkauan.";
    } else if (!$shift_setting) {
      $error = true;
      $message = "Skema shift belum disetting.";
    } else {
      $param_shift['where']['absen_shift.id_shift'] = $shift_setting->aktif_shift;
      $shift = $this->get_shift($param_shift)->row();
      $mulai_absen_masuk = date("H:i:s", strtotime($shift->jam_masuk . " -" . $batas_waktu_absen_masuk . " minutes"));
      $selesai_absen_masuk = date("H:i:s", strtotime($shift->jam_masuk . " +" . $batas_waktu_absen_masuk . " minutes"));
      ;
      $mulai_absen_pulang = date("H:i:s", strtotime($shift->jam_pulang . " -" . $batas_waktu_absen_pulang . " minutes"));
      $selesai_absen_pulang = date("H:i:s", strtotime($shift->jam_pulang . " +" . $batas_waktu_absen_pulang . " minutes"));
      ;
      $sekarang = date("H:i:s");
      $tanggal = date("Y-m-d");
      $hari = date("N");
      $fhari = "hari" . $hari;

      /*
      begin of Pengecualian Dinkes
      * jumat pulang jam 16:30 (5 Hari)
      * jumat pulang jam 11:00 (6 Hari)
      * sabtu pulang jam 13:00 (6 Hari)
      */
      if ($shift->id_shift == 1 && $hari == 5) {
        $mulai_absen_pulang = date("H:i:s", strtotime("16:30:00 -" . $batas_waktu_absen_pulang . " minutes"));
        $selesai_absen_pulang = date("H:i:s", strtotime("16:30:00 +" . $batas_waktu_absen_pulang . " minutes"));
        ;
      }
      if ($shift->id_shift == 4 && $hari == 5) {
        $mulai_absen_pulang = date("H:i:s", strtotime("11:00:00 -" . $batas_waktu_absen_pulang . " minutes"));
        $selesai_absen_pulang = date("H:i:s", strtotime("11:00:00 +" . $batas_waktu_absen_pulang . " minutes"));
        ;
      }
      if ($shift->id_shift == 4 && $hari == 6) {
        $mulai_absen_pulang = date("H:i:s", strtotime("13:00:00 -" . $batas_waktu_absen_pulang . " minutes"));
        $selesai_absen_pulang = date("H:i:s", strtotime("13:00:00 +" . $batas_waktu_absen_pulang . " minutes"));
        ;
      }
      // end of Pengecualian Dinkes

      $isHoliday = $this->isHoliday($tanggal, $shift->id_shift);

      if ($sekarang >= $mulai_absen_masuk && $sekarang <= $selesai_absen_masuk && $shift->$fhari == "Y" && !$isHoliday) {
        $param['where']['absen_log.id_pegawai'] = $id_pegawai;
        $param['where']['absen_log.tanggal'] = date('Y-m-d');
        $absen_log = $this->get_log($param);
        $absen = $absen_log->row();
        if ($absen_log->num_rows() == 0 || $absen->jam_masuk == null) {
          $jenis = "masuk";
        } else {
          $error = true;
          $message = "Anda sudah absen masuk.";
        }
      } else if ($sekarang >= $mulai_absen_pulang && $sekarang <= $selesai_absen_pulang) {
        if ($shift->flag == "beda_hari") {
          $hari = date("N", strtotime(date("Y-m-d") . " -1 days"));
          $tanggal = date("Y-m-d", strtotime(date("Y-m-d") . " -1 days"));
          $fhari = "hari" . $hari;
        }
        $param['where']['absen_log.id_pegawai'] = $id_pegawai;
        $param['where']['absen_log.tanggal'] = $tanggal;
        $absen_log = $this->get_log($param);
        $absen = $absen_log->row();

        if ($shift->$fhari == "Y" && $absen_log->num_rows() > 0 && $absen->jam_pulang == null) {
          $jenis = "pulang";
        } else if ($shift->$fhari == "Y" && $absen_log->num_rows() > 0 && $absen->jam_pulang != null) {
          $error = true;
          $message = "Anda sudah absen pulang";
        } else {
          $error = true;
          $message = "Absen tidak tersedia";
        }
      } else {
        $error = true;
        $message = "Absen tidak tersedia.";
      }
    }

    return array(
      'error' => $error,
      'message' => $message,
      'tempat' => $tempat,
      'jenis' => $jenis,
    );
  }

  public function change_shift($id_pegawai, $id_shift)
  {
    $cek = $this->db->where("id_pegawai", $id_pegawai)->get("absen_shift_setting");
    if ($cek->num_rows() == 0) {
      $this->db->set("id_pegawai", $id_pegawai);
      $this->db->set("id_shift", $id_shift);
      $this->db->set("aktif_shift", $id_shift);
      $this->db->insert("absen_shift_setting");
    } else {
      $this->db->where("id_pegawai", $id_pegawai);
      $this->db->set("id_shift", $id_shift);
      $this->db->update("absen_shift_setting");
    }
  }

  public function get_masuk_telat($id_pegawai, $jam_masuk, $tanggal = '', $id_shift_preselected = '')
  {
    if ($tanggal !== '') {
      $absen_log = $this->db->get_where('absen_log', ['id_pegawai' => $id_pegawai, 'tanggal' => $tanggal])->row();
      if ($absen_log) {
        $id_shift = $absen_log->id_shift;
        if (!empty($id_shift)) {
          $shift_setting = $this->db->get_where('absen_shift', ['id_shift' => $id_shift])->row();
        } else {
          // return 0;
          $param_shift_setting['where']['absen_shift_setting.id_pegawai'] = $id_pegawai;
          $shift_setting = $this->get_shift_setting($param_shift_setting)->row();
          if (!$shift_setting) {
            return 0;
          }
        }
      } else {
        return 0;
      }
    } else {
      $param_shift_setting['where']['absen_shift_setting.id_pegawai'] = $id_pegawai;
      $shift_setting = $this->get_shift_setting($param_shift_setting)->row();
      if (!$shift_setting) {
        return 0;
      }
    }

    if ($id_shift_preselected !== '') {
      $shift_setting = $this->db->get_where('absen_shift', ['id_shift' => $id_shift_preselected])->row();
      if (!$shift_setting) {
        return 0;
      }
    }

    $set_jam_masuk = $shift_setting->jam_masuk;

    $masuk_telat = 0;
    $jam_masuk = strtotime($jam_masuk);
    $_jam_masuk = strtotime($set_jam_masuk);
    if ($jam_masuk > $_jam_masuk) {
      $masuk_telat = ($jam_masuk - $_jam_masuk) / 60;
    }

    return $masuk_telat;
  }

  public function get_pulang_cepat($id_pegawai, $jam_pulang, $tanggal = '', $id_shift_preselected = '')
  {

    if ($tanggal !== '') {
      $absen_log = $this->db->get_where('absen_log', ['id_pegawai' => $id_pegawai, 'tanggal' => $tanggal])->row();
      if ($absen_log) {
        $id_shift = $absen_log->id_shift;
        if (!empty($id_shift)) {
          $shift_setting = $this->db->get_where('absen_shift', ['id_shift' => $id_shift])->row();
        } else {
          // return 0;
          $param_shift_setting['where']['absen_shift_setting.id_pegawai'] = $id_pegawai;
          $shift_setting = $this->get_shift_setting($param_shift_setting)->row();
          if (!$shift_setting) {
            return 0;
          }
        }
      } else {
        return 0;
      }
    } else {
      $param_shift_setting['where']['absen_shift_setting.id_pegawai'] = $id_pegawai;
      $shift_setting = $this->get_shift_setting($param_shift_setting)->row();
      if (!$shift_setting) {
        return 0;
      }
    }

    if ($id_shift_preselected !== '') {
      $shift_setting = $this->db->get_where('absen_shift', ['id_shift' => $id_shift_preselected])->row();
      if (!$shift_setting) {
        return 0;
      }
    }

    $set_jam_pulang = $shift_setting->jam_pulang;

    /*
    begin of Pengecualian Dinkes
    * jumat pulang jam 16:30 (5 Hari)
    * jumat pulang jam 11:00 (6 Hari)
    * sabtu pulang jam 13:00 (6 Hari)
    */

    if ($tanggal !== '') {
      $hari = date('N', strtotime($tanggal));
    } else {
      $hari = date("N");
    }


    if ($shift_setting->id_shift == 1 && $hari == 5) {
      $set_jam_pulang = "16:30:00";
    }
    if (($shift_setting->id_shift == 4 || $shift_setting->id_shift == 12) && $hari == 5) {
      $set_jam_pulang = "11:00:00";
    }
    if (($shift_setting->id_shift == 4 || $shift_setting->id_shift == 12) && $hari == 6) {
      $set_jam_pulang = "13:00:00";
    }
    // end of Pengecualian Dinkes


    $pulang_cepat = 0;
    $jam_pulang = strtotime($jam_pulang);
    $_jam_pulang = strtotime($set_jam_pulang);
    if ($jam_pulang < $_jam_pulang) {
      $pulang_cepat = ($_jam_pulang - $jam_pulang) / 60;
    }

    return $pulang_cepat;
  }

  public function get_waktu_kerja($id_pegawai, $jam_masuk, $jam_pulang, $tanggal = '', $id_shift_preselected = '')
  {

    if ($tanggal !== '') {
      $absen_log = $this->db->get_where('absen_log', ['id_pegawai' => $id_pegawai, 'tanggal' => $tanggal])->row();
      if ($absen_log) {
        $id_shift = $absen_log->id_shift;
        if (!empty($id_shift)) {
          $shift_setting = $this->db->get_where('absen_shift', ['id_shift' => $id_shift])->row();
        } else {
          // return 0;
          $param_shift_setting['where']['absen_shift_setting.id_pegawai'] = $id_pegawai;
          $shift_setting = $this->get_shift_setting($param_shift_setting)->row();
          if (!$shift_setting) {
            return 0;
          }
        }
      } else {
        return 0;
      }
    } else {
      $param_shift_setting['where']['absen_shift_setting.id_pegawai'] = $id_pegawai;
      $shift_setting = $this->get_shift_setting($param_shift_setting)->row();
      if (!$shift_setting) {
        return 0;
      }
    }

    if ($id_shift_preselected !== '') {
      $shift_setting = $this->db->get_where('absen_shift', ['id_shift' => $id_shift_preselected])->row();
      if (!$shift_setting) {
        return 0;
      }
    }


    $jam_masuk = strtotime($jam_masuk);
    if ($jam_masuk < strtotime($shift_setting->jam_masuk)) {
      $jam_masuk = strtotime($shift_setting->jam_masuk);
    }

    $jam_pulang = strtotime($jam_pulang);
    if ($jam_pulang > strtotime($shift_setting->jam_pulang)) {
      $set_jam_pulang = $shift_setting->jam_pulang;
      /*
      begin of Pengecualian Dinkes
      * jumat pulang jam 16:30 (5 Hari)
      * jumat pulang jam 11:00 (6 Hari)
      * sabtu pulang jam 13:00 (6 Hari)
      */
      $hari = date("N");
      if ($shift_setting->id_shift == 1 && $hari == 5) {
        $set_jam_pulang = "16:30:00";
      }
      if (($shift_setting->id_shift == 4 || $shift_setting->id_shift == 12) && $hari == 5) {
        $set_jam_pulang = "11:00:00";
      }
      if (($shift_setting->id_shift == 4 || $shift_setting->id_shift == 12) && $hari == 6) {
        $set_jam_pulang = "13:00:00";
      }
      // end of Pengecualian Dinkes

      $jam_pulang = strtotime($set_jam_pulang);
    }

    $waktu_kerja = 0;
    if ($jam_pulang > $jam_masuk) {
      $waktu_kerja = ($jam_pulang - $jam_masuk);
    } else {
      $waktu_kerja = (strtotime("23:59:59") - $jam_masuk) + ($jam_pulang - strtotime("00:00:00"));
    }

    return ($waktu_kerja / 60);
  }

  public function insert_ket_log($data)
  {
    $cek_param = array(
      'id_pegawai' => $data['id_pegawai'],
      'id_skpd' => $data['id_skpd'],
      'tanggal_awal' => $data['tanggal_awal'],
      'tanggal_akhir' => $data['tanggal_akhir'],
      'jumlah' => $data['jumlah'],
      'id_ket_absen' => $data['id_ket_absen'],
    );

    $cek = $this->db->get_where('absen_ket_log', $cek_param)->row();
    if ($cek) {
      $this->db->update('absen_ket_log', $data, $cek_param);
      $id_ket_log = $cek->id_ket_log;
    } else {
      $this->db->insert('absen_ket_log', $data);
      $id_ket_log = $this->db->insert_id();
    }

    //Insert ke detail tanggal
    if (empty($data['tanggal_akhir']) || $data['tanggal_akhir'] == "0000-00-00") {
      $dates[] = $data['tanggal_awal'];
    } else {
      $dates = getDatesFromRange($data['tanggal_awal'], $data['tanggal_akhir']);
    }
    $this->db->delete('absen_ket_log_detail', array('id_ket_log' => $id_ket_log));
    foreach ($dates as $d) {
      $cek_detail = $this->db->get_where('absen_ket_log_detail', array('id_ket_log' => $id_ket_log, 'tanggal' => $d))->num_rows();
      if ($cek_detail == 0) {
        $insert = $this->db->insert('absen_ket_log_detail', array('id_ket_log' => $id_ket_log, 'tanggal' => $d));
      }
    }
    return $id_ket_log;
  }

  public function get_ket_log($id_skpd = '', $bulan, $tahun)
  {
    $this->db->order_by('id_ket_log', 'desc');
    if ($id_skpd != '') {
      $this->db->where('pegawai.id_skpd', $id_skpd);
    }
    $this->db->where('MONTH(tanggal_awal)', $bulan);
    $this->db->where('YEAR(tanggal_awal)', $tahun);
    $this->db->join('ref_ket_absen', 'ref_ket_absen.id_ket_absen = absen_ket_log.id_ket_absen');
    $this->db->join('pegawai', 'pegawai.id_pegawai = absen_ket_log.id_pegawai', 'left');
    $this->db->join('ref_skpd', 'ref_skpd.id_skpd = pegawai.id_skpd', 'left');
    $get = $this->db->get('absen_ket_log')->result();
    return $get;
  }

  public function get_detail_log($id_ket_log)
  {
    $res = $this->db->get_where('absen_ket_log_detail', array('id_ket_log' => $id_ket_log))->result();
    return $res;
  }

  public function get_tgl_detail_log($id_ket_log)
  {
    $res = $this->get_detail_log($id_ket_log);
    $tanggals = array();
    foreach ($res as $r) {
      $tanggals[] = $r->tanggal;
    }
    return $tanggals;
  }

  public function get_ket_log_by_id($id_ket_log)
  {
    $this->db->join('ref_ket_absen', 'ref_ket_absen.id_ket_absen = absen_ket_log.id_ket_absen');
    $this->db->join('pegawai', 'pegawai.id_pegawai = absen_ket_log.id_pegawai', 'left');
    $this->db->join('ref_skpd', 'ref_skpd.id_skpd = pegawai.id_skpd', 'left');
    return $this->db->get_where('absen_ket_log', array('id_ket_log' => $id_ket_log))->row();
  }
  public function get_ket_log_pegawai_by_group($id_pegawai, $bulan, $tahun, $group)
  {
    $this->db->where('MONTH(tanggal_awal)', $bulan);
    $this->db->where('YEAR(tanggal_awal)', $tahun);
    $this->db->where('id_pegawai', $id_pegawai);
    $this->db->where('ref_ket_absen.group_ket', $group);
    $this->db->join('ref_ket_absen', 'ref_ket_absen.id_ket_absen = absen_ket_log.id_ket_absen');
    return $this->db->get('absen_ket_log')->result();
  }
  public function get_ket_log_pegawai($id_pegawai, $bulan, $tahun)
  {
    $this->db->where('MONTH(tanggal_awal)', $bulan);
    $this->db->where('YEAR(tanggal_awal)', $tahun);
    $this->db->where('id_pegawai', $id_pegawai);
    $this->db->join('absen_ket_log', 'absen_ket_log.id_ket_log = absen_ket_log_detail.id_ket_log');
    $this->db->join('ref_ket_absen', 'ref_ket_absen.id_ket_absen = absen_ket_log.id_ket_absen');
    return $this->db->get('absen_ket_log_detail')->result();
  }
  public function delete_ket_log($id_ket_log, $data)
  {
    $this->load->model('tpp/tpp_model');
    $delete = $this->db->delete('absen_ket_log', array('id_ket_log' => $id_ket_log));
    if ($delete) {
      $this->db->delete('absen_ket_log_detail', array('id_ket_log' => $id_ket_log));
      $param = array(
        'id_pegawai' => $data['id_pegawai'],
        'bulan' => date("m", strtotime($data['tanggal_awal'])),
        'tahun' => date("Y", strtotime($data['tanggal_awal'])),
        'id_ket_log' => $data['id_ket_absen'],
        'jumlah' => 0
      );
      $save_tpp = $this->tpp_model->simpan($param);
      return true;
    } else {
      return false;
    }
  }
  public function get_log_summary($param)
  {
    if (isset($param['where'])) {
      $this->db->where($param['where']);
    }
    $this->db->select("sum(masuk_telat) as total_masuk_telat, sum(pulang_cepat) as total_pulang_cepat,
    sum(waktu_kerja) as total_waktu_kerja");
    $rs = $this->db->get("absen_log");
    return $rs;
  }

  public function if_absen_exist($tanggal, $id_pegawai)
  {
    $cek = $this->db->get_where('absen_log', array('tanggal' => $tanggal, 'id_pegawai' => $id_pegawai));
    if ($cek->num_rows() > 0) {
      return $cek->row();
    } else {
      return false;
    }
  }

  public function insert_absen($id_pegawai, $tanggal, $mode = "all", $koreksi = false)
  {
    $param_shift_setting['where']['absen_shift_setting.id_pegawai'] = $id_pegawai;
    $shift_setting = $this->get_shift_setting($param_shift_setting)->row();
    if (!$shift_setting) {
      $id_shift = 1;
    } else {
      $id_shift = $shift_setting->aktif_shift;
    }
    // echo $id_shift;

    // if($id_shift == 1||$id_shift == 2||$id_shift == 3){
    //   $id_shift = 11;
    // }else if($id_shift == 2){
    //   $id_shift = 12;
    // }


    $shift_setting = $this->db->where("id_shift", $id_shift)->get("absen_shift")->row();
    $hari = date('N', strtotime($tanggal));
    if ($shift_setting->id_shift == 1 && $hari == 5) {
      $shift_setting->jam_pulang = "16:30:00";
    }
    if (($shift_setting->id_shift == 4 || $shift_setting->id_shift == 12) && $hari == 5) {
      $shift_setting->jam_pulang = "11:00:00";
    }
    if (($shift_setting->id_shift == 4 || $shift_setting->id_shift == 12) && $hari == 6) {
      $shift_setting->jam_pulang = "13:00:00";
    }

    // print_r($shift_setting);

    $hari = date("N", strtotime($tanggal));
    $bulan = date("m", strtotime($tanggal));
    $tahun = date("Y", strtotime($tanggal));


    $libur = $this->db->get_where('ref_hari_libur', array('MONTH(tanggal_libur)' => $bulan, 'YEAR(tanggal_libur)' => $tahun))->result();
    $tanggal_libur = array();
    foreach ($libur as $lib) {
      $tanggal_libur[] = $lib->tanggal_libur;
    }

    $fhari = "hari" . $hari;

    if ($shift_setting->$fhari == "Y" && !in_array($tanggal, $tanggal_libur)) {

      $cek = $this->db->where("id_pegawai", $id_pegawai)
        ->where("tanggal", $tanggal)
        ->get("absen_log");

      $waktu_kerja = 0;
      $jam_pulang = strtotime($shift_setting->jam_pulang);
      $jam_masuk = strtotime($shift_setting->jam_masuk);

      if ($jam_pulang > $jam_masuk) {
        $waktu_kerja = ($jam_pulang - $jam_masuk);
      } else {
        $waktu_kerja = (strtotime("23:59:59") - $jam_masuk) + ($jam_pulang - strtotime("00:00:00"));
      }
      $waktu_kerja = ($waktu_kerja / 60);

      if ($koreksi && $cek->num_rows() > 0) {
        $cr = $cek->row();
        $dt = array(
          'id_pegawai' => $id_pegawai,
          'tanggal' => $tanggal,
          'jam_masuk' => $cr->jam_masuk,
          'jam_pulang' => $cr->jam_pulang,
          'masuk_telat' => $cr->masuk_telat,
          'pulang_cepat' => $cr->pulang_cepat,
          'id_shift' => $id_shift
        );

        if ($cr->masuk_telat > 0) {
          $dt['jam_masuk'] = date("H:i:s", strtotime('-' . rand(0, 1200) . ' seconds', strtotime($shift_setting->jam_masuk)));
          $dt['masuk_telat'] = $this->get_masuk_telat($id_pegawai, $dt['jam_masuk'], $tanggal, $cr->id_shift);
        }

        if ($cr->pulang_cepat > 0 || $cr->jam_pulang == NULL) {
          $dt['jam_pulang'] = date("H:i:s", strtotime('+' . rand(0, 1200) . ' seconds', strtotime($shift_setting->jam_pulang)));
          $dt['pulang_cepat'] = $this->get_pulang_cepat($id_pegawai, $dt['jam_pulang'], $tanggal, $cr->id_shift);
        }

        $dt['waktu_kerja'] = $this->get_waktu_kerja($id_pegawai, $dt['jam_masuk'], $dt['jam_pulang'], $tanggal, $cr->id_shift);

        $dt['tempat'] = 'Kantor';

      } else {

        $dt = array(
          'id_pegawai' => $id_pegawai,
          'tanggal' => $tanggal,
          'jam_masuk' => $shift_setting->jam_masuk,
          'jam_pulang' => $shift_setting->jam_pulang,
          'masuk_telat' => 0,
          'pulang_cepat' => 0,
          'waktu_kerja' => $waktu_kerja,
          'id_shift' => $id_shift,
          'tempat' => 'Kantor'
        );
      }
      // return $dt;


      if ($mode == "masuk") {
        unset($dt['jam_pulang']);
        unset($dt['pulang_cepat']);
        unset($dt['waktu_kerja']);
      }



      if ($cek->num_rows() > 0) {
        $this->db->where("id_pegawai", $id_pegawai);
        $this->db->where("tanggal", $tanggal);
        $this->db->update("absen_log", $dt);
        //echo "update absen";
      } else {
        $this->db->insert("absen_log", $dt);
        //echo "insert absen";
      }
    } else {
      return false;
    }
  }

  public function tanpa_keterangan($id_pegawai, $tanggal)
  {
    $param_shift_setting['where']['absen_shift_setting.id_pegawai'] = $id_pegawai;
    $shift_setting = $this->get_shift_setting($param_shift_setting)->row();
    if (!$shift_setting) {
      $id_shift = 1;
    } else {
      $id_shift = $shift_setting->aktif_shift;
    }

    $shift_setting = $this->db->where("id_shift", $id_shift)->get("absen_shift")->row();

    $hari = date("N", strtotime($tanggal));
    $fhari = "hari" . $hari;

    if ($id_shift == 12 || $id_shift == 16 || $id_shift == 17 || $id_shift == 13 || $id_shift == 14 || $id_shift == 15) {
      for ($h = 1; $h <= 6; $h++) {
        $fh = "hari" . $h;
        $shift_setting->$fh = "Y";
      }
    }
    if ($shift_setting->$fhari == "Y") {
      $pegawai = $this->db->where("id_pegawai", $id_pegawai)->get("pegawai")->row();
      if ($pegawai) {
        // insert log
        $log = array(
          'id_pegawai' => $id_pegawai,
          'id_skpd' => $pegawai->id_skpd,
          'tanggal_awal' => $tanggal,
          'tanggal_akhir' => $tanggal,
          'jumlah' => 1,
          'id_ket_absen' => "A2",
          'keterangan' => "Tanpa keterangan",
        );
        // $this->db->insert("absen_ket_log", $log);
        $this->insert_ket_log($log);

        $bulan = date("m", strtotime($tanggal));
        $tahun = date("Y", strtotime($tanggal));
        $param_cek = array(
          'id_pegawai' => $id_pegawai,
          'month(tanggal_awal)' => $bulan,
          'year(tanggal_awal)' => $tahun,
          'id_ket_absen' => "A2",
        );
        $jumlah = 1;
        $cek = $this->db->where($param_cek)->select("sum(jumlah) as 'jumlah'")->get("absen_ket_log");
        if ($cek->num_rows() > 0) {
          $row = $cek->row();
          $jumlah = $jumlah + $row->jumlah;
        }

        // simpan tpp tanpa keterangan
        $param = array(
          'id_pegawai' => $id_pegawai,
          'bulan' => $bulan,
          'tahun' => $tahun,
          'id_ket_log' => "A2",
          'jumlah' => $jumlah,
        );
        $this->load->model("tpp/tpp_model");
        $this->tpp_model->simpan($param);
      }
    }
  }

  public function delete_tanpa_keterangan($id_pegawai, $tanggal)
  {
    $log = $this->db
      // ->where($tanggal . ' between ', 'tanggal_awal and tanggal_akhir', false)
      ->where('tanggal_awal', $tanggal)
      ->where('tanggal_akhir', $tanggal)
      ->where('id_pegawai', $id_pegawai)
      ->where('id_ket_absen', 'A2')
      ->get('absen_ket_log')->result();
    foreach ($log as $l) {
      $data = (array) $l;
      $delete = $this->delete_ket_log($l->id_ket_log, $data);
    }
  }

  public function generate_tanpa_keterangan_pegawai($id_pegawai, $bulan, $tahun)
  {
    $jml_hari = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);
    for ($tanggal = 1; $tanggal <= $jml_hari; $tanggal++) {
      $tanggal = str_pad($tanggal, 2, '0', STR_PAD_LEFT);
      $bulan = str_pad($bulan, 2, '0', STR_PAD_LEFT);
      $tanggal_absen = "$tahun-$bulan-$tanggal";
      $shift_setting = $this->db->get_where('absen_shift_setting', array('id_pegawai' => $id_pegawai))->row();
      if (!$shift_setting) {
        $id_shift = 1;
      } else {
        $id_shift = $shift_setting->aktif_shift;
      }
      $shift = $this->db->get_where('absen_shift', array('id_shift' => $id_shift))->row();
      $hari = date("N", strtotime($tanggal_absen));
      $fhari = "hari" . $hari;
      if ($shift->$fhari == "Y") {

        $libur = $this->db->get_where('ref_hari_libur', array('MONTH(tanggal_libur)' => $bulan, 'YEAR(tanggal_libur)' => $tahun))->result();
        $tanggal_libur = array();
        foreach ($libur as $l) {
          $tanggal_libur[] = $l->tanggal_libur;
        }

        $absen = $this->db->get_where('absen_log', array('id_pegawai' => $id_pegawai, 'tanggal' => $tanggal_absen))->num_rows();
        $log = $this->db
          ->where('absen_ket_log.id_pegawai', $id_pegawai)
          ->where('absen_ket_log_detail.tanggal', $tanggal_absen)
          ->join('absen_ket_log', 'absen_ket_log.id_ket_log = absen_ket_log_detail.id_ket_log')
          ->get('absen_ket_log_detail')
          ->num_rows();
        if (!in_array($tanggal_absen, $tanggal_libur) && empty($absen) && empty($log) && $tanggal_absen < date('Y-m-d')) {
          //Eksekusi
          $this->tanpa_keterangan($id_pegawai, $tanggal_absen);
        }
      }
    }
  }

  public function get_pegawai_new($id_skpd, $bulan, $tahun)
  {


    if ($bulan == 8 && $tahun == 2021) {

      $this->db->select(
        "user.api_key,pegawai.id_pegawai,pegawai.nip,pegawai.nama_lengkap,
  (SELECT COUNT(absen_log.id_log) FROM absen_log WHERE absen_log.id_pegawai = pegawai.id_pegawai AND MONTH(absen_log.tanggal) = $bulan AND YEAR(absen_log.tanggal) = $tahun AND jam_pulang IS NOT NULL AND jam_masuk IS NOT NULL ) as hadir,
  (SELECT COUNT(absen_log.id_log) FROM absen_log WHERE absen_log.id_pegawai = pegawai.id_pegawai AND MONTH(absen_log.tanggal) = $bulan AND YEAR(absen_log.tanggal) = $tahun AND jam_pulang IS NULL AND jam_masuk IS NOT NULL ) as tap,
  (SELECT sum(masuk_telat) FROM absen_log WHERE absen_log.id_pegawai = pegawai.id_pegawai AND MONTH(absen_log.tanggal) = $bulan AND YEAR(absen_log.tanggal) = $tahun ) as masuk_telat,
  (SELECT sum(pulang_cepat) FROM absen_log WHERE absen_log.id_pegawai = pegawai.id_pegawai AND MONTH(absen_log.tanggal) = $bulan AND YEAR(absen_log.tanggal) = $tahun) as pulang_cepat,
  (SELECT sum(waktu_kerja) FROM absen_log WHERE absen_log.id_pegawai = pegawai.id_pegawai AND MONTH(absen_log.tanggal) = $bulan AND YEAR(absen_log.tanggal) = $tahun) as waktu_kerja,
  IF(lama.id_jabatan IS NULL, sekarang.id_jabatan, lama.id_jabatan) as id_jabatan_pencairan,
  IF(lama.id_jabatan IS NULL, sekarang.nama_jabatan, lama.nama_jabatan) as nama_jabatan_pencairan,
  IF(lama.id_jabatan IS NULL, sekarang.id_skpd, lama.id_skpd) as id_skpd_pencairan
    "
      );
      $this->db->join('user', 'user.id_pegawai = pegawai.id_pegawai', 'left');
      $this->db->join('ref_jabatan_baru as sekarang', 'sekarang.id_jabatan = pegawai.id_jabatan', 'left');
      $this->db->join('ref_jabatan_baru as lama', 'lama.id_jabatan = pegawai.id_jabatan_lama', 'left');
      $this->db->order_by('nama_lengkap');
      $this->db->having('id_skpd_pencairan', $id_skpd);
      $pegawai = $this->db->get_where('pegawai', array('pensiun' => 0))->result();
    } else {
      $this->load->model('pegawai_posisi_model');
      $pegawai = $this->pegawai_posisi_model->get_posisi($id_skpd, $bulan, $tahun, '', '', 'absen');
      // $pegawai = $this->db->get_where('pegawai', array('id_skpd' => $id_skpd, 'pensiun' => 0))->result();
    }



    $this->db->where('MONTH(tanggal_awal)', $bulan);
    $this->db->where('YEAR(tanggal_awal)', $tahun);
    $this->db->group_start();
    $this->db->or_where('absen_ket_log.id_skpd', $id_skpd);
    $this->db->or_where('ref_skpd.id_skpd_induk', $id_skpd);
    $this->db->group_end();
    $this->db->join('ref_skpd', 'ref_skpd.id_skpd = absen_ket_log.id_skpd');
    $this->db->join('ref_ket_absen', 'ref_ket_absen.id_ket_absen = absen_ket_log.id_ket_absen');
    $log = $this->db->get('absen_ket_log')->result();

    foreach ($pegawai as $k => $p) {
      $ket_log = ['sakit', 'cuti', 'tk', 'dd', 'dl', 'im', 'wfh', 'mpp'];
      foreach ($ket_log as $l) {
        $pegawai[$k]->$l = 0;
        foreach ($log as $lo) {
          if ($lo->id_pegawai == $p->id_pegawai && $lo->group_ket == $l) {
            $pegawai[$k]->$l += $lo->jumlah;
          }
        }
      }
    }
    return $pegawai;
  }
}