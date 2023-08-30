<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Peserta_model extends CI_Model
{
    public function get($param=null,$keyword=null)
    {
      if(!empty($param['where']))
    	{
        $this->db->where($param['where']);
    	}
    	if(!empty($param['like']))
    	{
        $this->db->like($param['like']);
    	}
    	if(isset($param['limit']) && isset($param['offset']))
    	{
    		$this->db->limit($param['limit'],$param['offset']);
    	}
      $this->db->join("pegawai","pegawai.id_pegawai = bangkom_peserta.id_pegawai","left");
      $this->db->join("ref_skpd","ref_skpd.id_skpd = pegawai.id_skpd","left");
      $this->db->join("ref_jabatan_baru","ref_jabatan_baru.id_jabatan = pegawai.id_jabatan","left");

      $status = $this->config->item("status_penilaian_mandiri");
  		$case = "CASE ";
  		foreach ($status as $key => $value) {
  			$case .= " WHEN bangkom_peserta.status = '$key' THEN '$value' ";
  		}
  		$case .= "ELSE ''
  					END as 'status_desc'";


      $status_identifikasi = $this->config->item("status_identifikasi");
  		$case2 = "CASE ";
  		foreach ($status_identifikasi as $key => $value) {
  			$case2 .= " WHEN bangkom_peserta.status = '$key' THEN '$value' ";
  		}
  		$case2 .= "ELSE ''
  					END as 'status_identifikasi'";


      $this->db->select("bangkom_peserta.*, $case ,$case2, pegawai.nip, pegawai.nama_lengkap,
      pegawai.nama_lengkap, pegawai.pendidikan,
      ref_skpd.nama_skpd,
      ref_jabatan_baru.nama_jabatan,
      date_format(tahun_kegiatan,'%d %M %Y') as'tahun_kegiatan_desc'");
      return $this->db->get("bangkom_peserta");
    }

    public function get_eselon($eselon)
    {
      if(in_array($eselon,['II.a','II.b']))
      {
        return "Eselon II";
      }
      else if(in_array($eselon,['III.a','III.b']))
      {
        return "Eselon III";
      }
      else if(in_array($eselon,['IV.a','IV.b']))
      {
        return "Eselon IV";
      }
      else{
        return "Pelaksana";
      }
    }

    public function get_indikator($param)
    {
      if(!empty($param['where']))
    	{
        $this->db->where($param['where']);
    	}
    	if(!empty($param['like']))
    	{
        $this->db->like($param['like']);
    	}
    	if(isset($param['limit']) && isset($param['offset']))
    	{
    		$this->db->limit($param['limit'],$param['offset']);
    	}

      $this->db->join("bangkom_indikator","bangkom_indikator.id_indikator = bangkom_peserta_indikator.id_indikator","left");

      $rs = $this->db->get("bangkom_peserta_indikator");
      return $rs;
    }

    public function get_detail($param)
    {
      if(!empty($param['where']))
    	{
        $this->db->where($param['where']);
    	}
    	if(!empty($param['like']))
    	{
        $this->db->like($param['like']);
    	}
    	if(isset($param['limit']) && isset($param['offset']))
    	{
    		$this->db->limit($param['limit'],$param['offset']);
    	}


      $rs = $this->db->get("bangkom_peserta_detail");
      return $rs;
    }

    public function get_diklat($param)
    {
      if(!empty($param['where']))
    	{
        $this->db->where($param['where']);
    	}
    	if(!empty($param['like']))
    	{
        $this->db->like($param['like']);
    	}
    	if(isset($param['limit']) && isset($param['offset']))
    	{
    		$this->db->limit($param['limit'],$param['offset']);
    	}

      $this->db->join("bangkom_peserta","bangkom_peserta.id_peserta = bangkom_peserta_diklat.id_peserta","left");
      $this->db->join("pegawai","bangkom_peserta.id_pegawai = pegawai.id_pegawai","left");
      $this->db->join("ref_skpd","ref_skpd.id_skpd = pegawai.id_skpd","left");
      $this->db->join("ref_jabatan_baru","ref_jabatan_baru.id_jabatan = pegawai.id_jabatan","left");

      $this->db->join("bangkom_diklat","bangkom_diklat.id_diklat = bangkom_peserta_diklat.id_diklat","left");

      $this->db->select("bangkom_peserta_diklat.*, bangkom_diklat.*,
        bangkom_peserta.jenis_kompetensi,
        pegawai.nip, pegawai.nama_lengkap,
        ref_skpd.nama_skpd,
        ref_jabatan_baru.nama_jabatan,
        CASE
          WHEN (bangkom_peserta_diklat.status='1' AND bangkom_peserta_diklat.status_diklat='0') THEN 'Terverifikasi PYB'
          WHEN (bangkom_peserta_diklat.status='1' AND bangkom_peserta_diklat.status_diklat is null) THEN 'Teridentifikasi Atasan'
          WHEN (bangkom_peserta_diklat.status='1' AND bangkom_peserta_diklat.status_diklat='1') THEN 'Tervalidasi PPK'
          WHEN (bangkom_peserta_diklat.status='0' AND bangkom_peserta_diklat.status_diklat='0') THEN 'Tidak Terverifikasi PYB'
          WHEN (bangkom_peserta_diklat.status='0' AND bangkom_peserta_diklat.status_diklat='1') THEN 'Tidak Tervalidasi PPK'
          ELSE ''
        END as 'status_desc'
      ");

      $rs = $this->db->get("bangkom_peserta_diklat");
      return $rs;
    }

  }
