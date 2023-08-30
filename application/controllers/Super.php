<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Super extends CI_Controller {
  public function __construct() {
      parent::__construct();

  }

  public function get_pegawai_perilaku($user_id)
  {
    $this->load->model("kinerja/Perilaku_model");
    $dt_pegawai = $this->Perilaku_model->getPegawai($user_id);
    echo "<pre>";print_r($dt_pegawai);
  }

  public function hitung_capaian_perilaku($id_skp=null)
  {
    $this->load->model("kinerja/Perilaku_model");
    $dt_kuisioner = $this->Perilaku_model->get_kuisioner();
    $ids_skp = array(896,1603,1697,1699,1884,2018,2284,2737,2791,2811,2812,2914,2925,2972,3612,3683,4402,4405,4408,4410,4477);
    $dt_rekap = array();

    if($id_skp)
    {
      $dt_rekap = $this->db->where("id_skp",$id_skp)->get("ekinerja_perilaku_rekap");
    }
    else if($ids_skp) {
      $dt_rekap = $this->db->where_in("id_skp",$ids_skp)->get("ekinerja_perilaku_rekap");
    }
    else{
      $dt_rekap = $this->db->where("hasil > 5")->limit(50)->order_by("hasil","DESC")->get("ekinerja_perilaku_rekap");
    }

    if($dt_rekap)
    {
      
      foreach($dt_rekap->result() as $row)
      {
        $dt_nilai = $this->db
        ->select("count(*) as 'total', id_pegawai")
        ->where("id_skp",$row->id_skp)
        ->where("bulan",$row->bulan)
        ->group_by("id_pegawai")
        ->get("ekinerja_perilaku_nilai")
        ->result();

        foreach($dt_nilai as $nilai)
        {
          if($nilai->total > 1)
          {
            $dt_duplicate = $this->db
            ->where("id_pegawai",$nilai->id_pegawai)
            ->where("id_skp",$row->id_skp)
            ->where("bulan",$row->bulan)
            ->get("ekinerja_perilaku_nilai");

            $ids_nilai = array();
            foreach($dt_duplicate->result() as $key => $duplicate)
            {
              if($key > 0)
              {
                $ids_nilai[] = $duplicate->id_nilai;
              }
            }

            if($ids_nilai)
            {
              // delete duplicate
              $this->db->where_in("id_nilai",$ids_nilai)->delete("ekinerja_perilaku_nilai_detail");
              $this->db->where_in("id_nilai",$ids_nilai)->delete("ekinerja_perilaku_nilai");
            }


          }
        }

        // hitung ulang
        //update rekap
        $this->Perilaku_model->updateRekap($row->id_skp, $row->tahun, $row->bulan);

        echo "<pre>";print_r($dt_nilai);
      }
      //echo $dt_rekap->num_rows();
    }
  }

  public function hitung_capaian_kinerja($id_skp=null)
    {
        $this->load->model("kinerja/Skp_model");

        if($this->input->get("nip"))
        {
          $param['where']['pegawai.nip'] = $this->input->get("nip");
        }
        else{
          $param['str_where'] = "(skp.hitung_capaian is null AND skp.status != 'Ditolak' )";
        }

        
        $param['where']['skp.tahun_desc'] = date("Y");

        if($id_skp)
        {
          $param['where']['skp.id_skp'] = $id_skp;
        }
        

        $param['limit'] = 15;
        $param['offset'] = 0;

        $this->db->order_by("id_skp","ASC");

        $dt_skp = $this->Skp_model->get($param)->result();

        foreach($dt_skp as $row)
        {
          $this->Skp_model->hitung_capaian($row->id_skp);
        }
    }

  /* public function update_capaian_kinerja($bulan,$rowno=1)
  {
    $this->load->model("kinerja/Skp_model");
    $this->load->model("kinerja/Capaian_model");

    $rowperpage = 500;
    $offset = ($rowno-1) * $rowperpage;
    $param['limit'] = $rowperpage;
    $param['offset'] = $offset;

    
  
    $tahun_desc = 2023;
    //$bulan= 1; // 2


    $param['skp.tahun_desc'] = $tahun_desc;

    $dt_skp = $this->Skp_model->get($param);

    //echo $dt_skp->num_rows();die;

    foreach($dt_skp->result() as $skp)
    {

      $dt_capaian = $this->db
      ->where("id_skp",$skp->id_skp)
      ->where("tahun_desc",$tahun_desc)
      ->where("bulan",$bulan)
      ->get("ekinerja_capaian")->result();

      foreach($dt_capaian as $row)
      {
        $this->Capaian_model->update($row);
      }

      //echo "<pre>";print_r($skp);
    }
  }

  public function init_capaian_kinerja($rowno=1)
  {
    $this->load->model("kinerja/Skp_model");
    $this->load->model("kinerja/Kinerja_utama_model");
    $this->load->model("kinerja/Kinerja_tambahan_model");
    $this->load->model("kinerja/Instruksi_model");

    $rowperpage = 20;
    $offset = ($rowno-1) * $rowperpage;
    $param['limit'] = $rowperpage;
    $param['offset'] = $offset;

    
  
    $tahun_desc = 2023;
    //$bulan= 1; // 2

    if($this->input->get("id_skp"))
    {
      $param['where']['skp.id_skp'] = $this->input->get("id_skp");
    }


    $param['where']['skp.tahun_desc'] = $tahun_desc;
    $this->db->order_by("skp.id_skp","ASC");
    $dt_skp = $this->Skp_model->get($param);

    //echo $dt_skp->num_rows();die;

    foreach($dt_skp->result() as $skp)
    {

      $param_kinerja_utama['where']['kinerja_utama.id_skp'] = $skp->id_skp;
      $dt_kinerja_utama = $this->Kinerja_utama_model->get($param_kinerja_utama)->result();
      $ids_kinerja_utama = array();
      foreach($dt_kinerja_utama as $row)
      {
        $this->do_init_capaian_kinerja($row);
        $ids_kinerja_utama[] = $row->id_kinerja_utama;
      }

      if($ids_kinerja_utama)
      {
        $this->db
        ->where_not_in("id_kinerja_utama",$ids_kinerja_utama)
        ->where("id_skp",$skp->id_skp)
        ->delete("ekinerja_capaian");
      }


      // IKP
      
      $param_ikp['where']['instruksi_khusus.id_skp'] = $skp->id_skp;
      $dt_ikp = $this->Instruksi_model->get_instruksi_khusus($param_ikp)->result();
      $ids_instruksi_khusus = array();
      foreach($dt_ikp as $row)
      {
        $this->do_init_capaian_kinerja($row);
        $ids_instruksi_khusus[] = $row->id_instruksi_khusus;
      }

      if($ids_instruksi_khusus)
      {
        $this->db
        ->where_not_in("id_instruksi_khusus",$ids_instruksi_khusus)
        ->where("id_skp",$skp->id_skp)
        ->delete("ekinerja_capaian");
      }


      // tambahan
      $param_kinerja_tambahan['where']['kinerja_tambahan.id_skp'] = $skp->id_skp;
      $dt_kinerja_tambahan = $this->Kinerja_tambahan_model->get($param_kinerja_tambahan)->result();
      $ids_kinerja_tambahan = array();
      foreach($dt_kinerja_tambahan as $row)
      {
        $this->do_init_capaian_kinerja($row);
        $ids_kinerja_tambahan[] = $row->id_kinerja_tambahan;
      }

      if($ids_kinerja_tambahan)
      {
        $this->db
        ->where_not_in("id_kinerja_tambahan",$ids_kinerja_tambahan)
        ->where("id_skp",$skp->id_skp)
        ->delete("ekinerja_capaian");
      }

      //echo "<pre>";print_r($skp);
    }
  }

  private function do_init_capaian_kinerja($data)
  {
    //echo "<pre>";print_r($data);die;
    $this->load->model("kinerja/Capaian_model");
    for($i=1; $i<=12 ;$i++)
    {
      $insert = array(
        'capaian' => null,
        'id_skp'  => $data->id_skp,
        'bulan'   => $i,
        'tahun'   => $data->tahun,
        'tahun_desc'   => $data->tahun_desc,
      );

      $this->db->where("id_skp",$data->id_skp);
      $this->db->where("bulan",$i);
      if(!empty($data->id_kinerja_utama))
      {
          $this->db->where("id_kinerja_utama",$data->id_kinerja_utama);
          $insert['id_kinerja_utama'] = $data->id_kinerja_utama;
      }
      else if(!empty($data->id_instruksi_khusus))
      {
          $this->db->where("id_instruksi_khusus",$data->id_instruksi_khusus);
          $insert['id_instruksi_khusus'] = $data->id_instruksi_khusus;
      }
      else if(!empty($data->id_kinerja_tambahan))
      {
          $this->db->where("id_kinerja_tambahan",$data->id_kinerja_tambahan);
          $insert['id_kinerja_tambahan'] = $data->id_kinerja_tambahan;
      }

      $cek = $this->db->get("ekinerja_capaian");

      if($cek->num_rows() == 0)
      {
          
          $this->db->insert("ekinerja_capaian",$insert);
      }

      //echo "<pre>";print_r($data);

      $data->bulan = $i;
      $this->Capaian_model->update($data);
    }
  } */

  
  /* public function init_capaian_kinerja($id, $rowno = 1)
  {
    $this->load->model("kinerja/Capaian_model");
    $this->load->model("kinerja/Kinerja_utama_model");
    $this->load->model("kinerja/Kinerja_tambahan_model");
    $this->load->model("kinerja/Instruksi_model");
    $rowperpage = 200;
    $offset = ($rowno-1) * $rowperpage;
    $param['limit'] = $rowperpage;
    $param['offset'] = $offset;

    if($id=="id_kinerja_utama")
    {
      $result = $this->Kinerja_utama_model->get($param)->result();
      $group_by = "kinerja_utama";
    }
    else if($id=="id_kinerja_tambahan")
    {
      $result = $this->Kinerja_tambahan_model->get($param)->result();
      $group_by = "kinerja_tambahan";
    }
    else if($id=="id_instruksi_khusus")
    {
      $result = $this->Instruksi_model->get_instruksi_khusus($param)->result();
      $group_by = "instruksi_khusus";
    }

    $ids = array();
    foreach($result as $row)
    {
      $ids[] = $row->$id;
    }

    $dt_capaian = array();

    for($i=1;$i<=12;$i++)
    {
      $param_summary['group_by'] = $group_by;
      $param_summary['bulan'] = $i;
      $param_summary['str_where'] = "(renaksi.".$id." in (".implode(",",$ids).") )";
      $summary = $this->Capaian_model->getSummary($param_summary)->result();

      foreach($summary as $row)
      {
        $dt_capaian[$row->$id][$i] = $row;
      }
    }

    //echo "<pre>";print_r($dt_capaian);die;

    foreach($result as $row)
    {
      for($i=1;$i<=12;$i++)
      {
        
        $capaian = (!empty($dt_capaian[$row->$id][$i])) ? $dt_capaian[$row->$id][$i]->capaian : 0;
  
        $data = array(
          'id_skp'  => $row->id_skp,
          'bulan'   => $i,
          'tahun'   => $row->tahun,
          'tahun_desc'  => $row->tahun_desc,
          'capaian' => $capaian
        );
        $data[$id] = $row->$id;

        $cek = $this->db
        ->where($id,$row->$id)
        ->where("bulan",$i)
        ->get("ekinerja_capaian");

        if($cek->num_rows()==0)
        {
          $this->db->insert("ekinerja_capaian",$data);
        }
        else{
          $this->db->where("id_capaian",$cek->row()->id_capaian);
          $this->db->update("ekinerja_capaian",$data);
        }
      }
    }
    
  } */

  public function insert_sasaran_unit_kerja()
  {
    $dt_sasaran = $this->db->get("sc_renstra_sasaran")->result();
    foreach($dt_sasaran as $row)
    {
      // penanggung jawab otomatis semua unit kerja
      $this->db->where("id_sasaran_renstra",$row->id_sasaran_renstra)->delete("sc_renstra_sasaran_unit_kerja");
      $dt_unit_kerja = $this->db->where("id_skpd",$row->id_skpd)->get("ref_unit_kerja")->result();
      foreach($dt_unit_kerja as $unit)
      {
          $this->db
          ->set("id_sasaran_renstra",$row->id_sasaran_renstra)
          ->set("id_unit_kerja",$unit->id_unit_kerja)
          ->insert("sc_renstra_sasaran_unit_kerja");
      }
    }
  }

  public function insert_cascading_pimpinan()
  {
    $this->load->model("sicerdas/Skpd_model");
    $this->load->model("sicerdas/Globalvar");

    $dt_sasaran = $this->db
    ->join("sc_renstra_sasaran","sc_renstra_sasaran.id_sasaran_renstra = sc_renstra_sasaran_indikator.id_sasaran_renstra","left")
    ->get("sc_renstra_sasaran_indikator")->result();
    foreach($dt_sasaran as $row)
    {
      // indikator sasaran otomatis cascading ke pimpinan
      

      $kepala = $this->Skpd_model->get_kepala($row->id_skpd);

      if($kepala)
      {
        foreach($this->Globalvar->get_tahun() as $key => $value)
        {
          $tahun = $key + 1;
          $dt_cascading = array(
              "id_sasaran_renstra"            => $row->id_sasaran_renstra,
              "id_indikator_sasaran_renstra"  => $row->id_indikator_sasaran_renstra,
              "id_pegawai"                    => $kepala->id_pegawai,
              "flag"                          => "sasaran",
              "tahun"                         => $tahun,
              "tahun_desc"                    => $value
          );
          
          $cek = $this->db
          ->where("id_indikator_sasaran_renstra",$row->id_indikator_sasaran_renstra)
          ->where("flag","sasaran")
          ->where("tahun",$tahun)
          ->get("sc_cascading")->row();
        
          if($cek)
          {
              $this->db->where("id_cascading",$cek->id_cascading)->update("sc_cascading",$dt_cascading);
          }
          else{
              $this->db->insert("sc_cascading",$dt_cascading);
          }
        }
      }
      else{
        echo $row->id_skpd."<br>";
      }

    }
  }

  public function isi_jabatan()
	{
		$dt_pegawai = $this->db->where("id_jabatan > 0 and id_jabatan is not null")->get("pegawai");

		foreach ($dt_pegawai->result() as $row) {
			$this->db
			->set("id_pegawai",$row->id_pegawai)
			->where("id_jabatan",$row->id_jabatan)
			->update("ref_jabatan_baru");
		}
	}
  
  public function insert_gagal_absen($app_token=null)
  {
    if($app_token && ($app_token == $this->config->item("app_token")))
		{
      $this->load->model("absen_model");

      $tanggal = "2020-09-15";
      $jam_masuk = "07:30:00";

      $pegawai = $this->db->where("aktif_shift not in (7,8)")->get("absen_shift_setting")->result();

      foreach ($pegawai as $row) {
        $cek = $this->db->where("tanggal",$tanggal)->where("id_pegawai",$row->id_pegawai)->get("absen_log");
        if($cek->num_rows()==0)
        {
          $absen_log = array(
            'id_pegawai'    => $row->id_pegawai,
            'tanggal'       => $tanggal,
            'jam_masuk'     => $jam_masuk,
            'masuk_telat'   => 0,
          );
          $this->db->insert("absen_log",$absen_log);
          echo "insert sukses<br>";
        }
      }


    }
  }


}
