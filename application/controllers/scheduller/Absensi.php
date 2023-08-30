<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Absensi extends CI_Controller {
  public function __construct() {
      parent::__construct();
      $this->load->model("absen_model");
  }

  public function change_shift($app_token=null,$flag=null)
	{
		if($app_token && ($app_token == $this->config->item("app_token")))
		{
      $this->db->select("absen_shift_setting.*,absen_shift.flag");
      $this->db->where("absen_shift_setting.id_shift != absen_shift_setting.aktif_shift");
      $this->db->where("absen_shift.flag",$flag);
      $this->db->join("absen_shift","absen_shift.id_shift = absen_shift_setting.aktif_shift","left");
      $rs = $this->db->get("absen_shift_setting")->result();
      //echo "<pre>";print_r($rs);
      foreach ($rs as $row) {
        $this->db->set("aktif_shift",$row->id_shift);
        $this->db->where("setting_id",$row->setting_id);
        $this->db->update("absen_shift_setting");
      }
    }
    else{
      echo "invalid token";
    }

  }

  public function hitung($app_token=null)
  {

    if($app_token && ($app_token == $this->config->item("app_token")))
		{
      $this->load->model("absen_model");
      $today = date("Y-m-d");
      $absen_log = 
      $this->db->where("absen_log.tanggal >= ","2020-08-01")
      ->where("absen_log.tanggal < ",$today)
      ->where("(absen_log.waktu_kerja is null OR absen_log.flag='H' )")
      //->where("absen_log.masuk_telat is null")
      //->where("absen_log.pulang_cepat is null")
      //->where("absen_log.waktu_kerja is null")
      //->where("absen_log.id_pegawai",10472)
      ->join("absen_shift_setting","absen_shift_setting.id_pegawai = absen_log.id_pegawai","left")
      ->join("absen_shift","absen_shift_setting.aktif_shift = absen_shift.id_shift","left")
      ->limit(20000)
      ->select("absen_log.tanggal, absen_log.id_pegawai, absen_log.id_log, absen_log.jam_masuk, absen_log.jam_pulang,
      absen_shift.jam_masuk as '_jam_masuk',absen_shift.jam_pulang as '_jam_pulang' ")
      ->get("absen_log");
      // var_dump($absen_log->num_rows());die;

      foreach ($absen_log->result() as $row) {
        $set_jam_masuk = $row->_jam_masuk;
        $set_jam_pulang = $row->_jam_pulang;
        if(!$set_jam_masuk){
          if(strtotime($row->jam_masuk) > strtotime("18:29:00"))
          {
            $set_jam_masuk = "20:00:00";
            $set_jam_pulang = "07:30:00";
          }
          else if(strtotime($row->jam_masuk) > strtotime("12:29:00"))
          {
            $set_jam_masuk = "14:00:00";
            $set_jam_pulang = "20:00:00";
          }
          else if(strtotime($row->jam_masuk) > strtotime("07:15:00"))
          {
            $set_jam_masuk = "07:30:00";
            if(strtotime($row->jam_pulang) > strtotime("15:00:00")){
                $set_jam_pulang = "16:00:00";
            }
            else {
              $set_jam_pulang = "14:00:00";
            }
          }
          else if(strtotime($row->jam_masuk) > strtotime("06:45:00"))
          {
            $set_jam_masuk = "07:00:00";
            $set_jam_pulang = "15:30:00";
          }
          else{
            $set_jam_masuk = "06:30:00";
            $set_jam_pulang = "15:00:00";
          }
        }
        else{

          if(strtotime($row->jam_masuk) > strtotime("18:29:00"))
          {
            $set_jam_masuk = "20:00:00";
            $set_jam_pulang = "07:30:00";
          }
          else if(strtotime($row->jam_masuk) > strtotime("12:29:00"))
          {
            $set_jam_masuk = "14:00:00";
            $set_jam_pulang = "20:00:00";
          }
          else{

            /*
            begin of Pengecualian Dinkes
             * jumat pulang jam 16:30 (5 Hari)
             * jumat pulang jam 11:00 (6 Hari)
             * sabtu pulang jam 13:00 (6 Hari)
            */
            $param_shift_setting['where']['absen_shift_setting.id_pegawai'] = $row->id_pegawai;
            $shift_setting = $this->absen_model->get_shift_setting($param_shift_setting)->row();
            if($shift_setting)
            {

              $hari = date("N",strtotime($row->tanggal));
              if($shift_setting->aktif_shift == 1 && $hari==5)
              {
                $set_jam_pulang = "16:30:00";
              }
              if($shift_setting->aktif_shift == 4 && $hari==5)
              {
                $set_jam_pulang = "11:00:00";
              }
              if($shift_setting->aktif_shift == 4 && $hari==6)
              {
                $set_jam_pulang = "13:00:00";
              }
            // end of Pengecualian Dinkes
              //echo "<pre>";print_r($shift_setting);die;
            }

          }
        }





          $masuk_telat = 0;
          $jam_masuk = strtotime($row->jam_masuk);
          $_jam_masuk = strtotime($set_jam_masuk);
          if($jam_masuk > $_jam_masuk)
          {
            $masuk_telat =  ($jam_masuk - $_jam_masuk);
          }
          else{
            $jam_masuk = strtotime($set_jam_masuk);
          }

          $pulang_cepat = 0;
          $_jam_pulang = strtotime($set_jam_pulang);
          $jam_pulang = strtotime($set_jam_pulang);
          if($row->jam_pulang!=null){
            $jam_pulang = strtotime($row->jam_pulang);
          }

          if($jam_pulang < $_jam_pulang)
          {
            $pulang_cepat =  ($_jam_pulang - $jam_pulang);
          }
          else{
            $jam_pulang = strtotime($set_jam_pulang);
          }

          $waktu_kerja = 0;
          if($jam_pulang > $jam_masuk){
            $waktu_kerja = ($jam_pulang - $jam_masuk);
          }
          else{
            $waktu_kerja = (strtotime("23:59:59") - $jam_masuk) + ($jam_pulang - strtotime("00:00:00"));

          }

          $update = array(
            'masuk_telat'   => ($masuk_telat/60),
            'pulang_cepat'  => ($pulang_cepat/60),
            'waktu_kerja'   => ($waktu_kerja/60),
            'flag'          => null,
          );


          $this->db->where("id_log",$row->id_log);
          $status = $this->db->update("absen_log",$update);

        }

      }
  }

  public function bebas_absen($app_token=null)
  {

    if($app_token && ($app_token == $this->config->item("app_token")))
		{
      $data = $this->db->where("bebas_absen","Y")->get("pegawai")->result();
      foreach ($data as $key => $row) {
        $today = date("Y-m-d");
        $tanggal = date("Y-m-d",strtotime($today." -1 days"));
        $this->absen_model->insert_absen($row->id_pegawai,$tanggal);
      }
    }
  }

  public function bebaskan_absen($app_token=null)
  {

    if($app_token && ($app_token == $this->config->item("app_token")))
		{
      $data = $this->db->where("bebas_absen","Y")->get("pegawai")->result();
      foreach ($data as $key => $row) {
        $tanggal = "2020-09-01";
        $tanggal2 = "2020-10-12";
        while($tanggal <= $tanggal2)
        {
          $this->absen_model->insert_absen($row->id_pegawai,$tanggal);
          $tanggal = date("Y-m-d",strtotime($tanggal." +1 days"));
        }
      }
    }
  }
}
