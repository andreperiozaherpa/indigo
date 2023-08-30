<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tpp extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model("tpp/Tpp_model");
  }

  public function reset($app_token = null)
  {
    if ($app_token && ($app_token == $this->config->item("app_token"))) {
      $this->db->set("hitung_tpp", null);
      $this->db->update("absen_shift_setting");
    }
  }
  public function hitung_tpp_absen($app_token = null)
  {
    if ($app_token && ($app_token == $this->config->item("app_token"))) {
      $data = $this->db
        ->select("absen_shift_setting.*")
        ->join("pegawai", "pegawai.id_pegawai=absen_shift_setting.id_pegawai", "left")
        ->where("(pegawai.bebas_absen is null OR pegawai.bebas_absen !='Y') ")
        ->where("absen_shift_setting.hitung_tpp", null)
        //->where_in("id_pegawai",[51,166])
        ->limit(1000)
        ->get("absen_shift_setting")
        ->result();

      $this->load->model("tpp/Tpp_model");


      $today = date("Y-m-d");
      $bulan = date("n", strtotime($today . " -1 days"));
      $tahun = date("Y", strtotime($today . " -1 days"));
      $kemarin = date("Y-m-d", strtotime($today . " -1 days"));

      foreach ($data as $row) {
        $param = array(
          'id_pegawai'  => $row->id_pegawai,
          'bulan'       => $bulan,
          'tahun'       => $tahun,
          'id_ket_log'  => "A1",
        );

        // A1 = TPP Masuk Telat dan pulang cepat
        $this->Tpp_model->simpan($param);

        //echo "<pre>";print_r($param);

        $this->db->where("id_pegawai", $row->id_pegawai);
        $this->db->set("hitung_tpp", "Y");
        $this->db->update("absen_shift_setting");
      }
    }
  }

  public function hitung_tpp_tidak_absen($app_token = null)
  {
    if ($app_token && ($app_token == $this->config->item("app_token"))) {
      $data = $this->db
        ->select("absen_shift_setting.*")
        ->join("pegawai", "pegawai.id_pegawai=absen_shift_setting.id_pegawai", "left")
        ->where("(pegawai.bebas_absen is null OR pegawai.bebas_absen !='Y') ")
        // ->where('pegawai.id_pegawai',316)
        ->get("absen_shift_setting")
        ->result();
      // print_r($data);die;

      $this->load->model("tpp/Tpp_model");
      $this->load->model('Absen_model');

      $today = date("Y-m-d");
      $bulan = date("n", strtotime($today . " -1 days"));
      $tahun = date("Y", strtotime($today . " -1 days"));
      $kemarin = date("Y-m-d", strtotime($today . " -1 days"));

      foreach ($data as $row) {
        $id_pegawai = $row->id_pegawai;
        $tanggal_absen = $kemarin;
        
        // A2 = TPP Tanpa keterangan
        $libur = $this->db->get_where('ref_hari_libur', array('MONTH(tanggal_libur)' => $bulan, 'YEAR(tanggal_libur)' => $tahun))->result();
        $tanggal_libur  = array();
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

        //Jika tidak ada hari libur & tidak absen & tidak ada di Log
        if (!in_array($tanggal_absen, $tanggal_libur) &&  empty($absen) && empty($log)) {
          //Eksekusi
          $this->Absen_model->tanpa_keterangan($id_pegawai, $tanggal_absen);
        }

        // A3 = TPP Tidak Absen Pulang
        $param['id_ket_log']  = "A3";
        $this->Tpp_model->simpan($param);
      }
    }
  }
}
