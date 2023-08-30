<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lkh_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    /* public function get($param)
    {
        if(!empty($param['where']))
        {
            $this->db->where($param['where']);
        }
        if(!empty($param['str_where']))
        {
            $this->db->where($param['str_where']);
        }
        
        if(isset($param['limit']) && isset($param['offset']))
        {
            $this->db->limit($param['limit'],$param['offset']);
        }

        $this->db->join("laporan_kerja_harian","laporan_kerja_harian.id_laporan_kerja_harian = lkh.id_laporan_kerja_harian","left");
        $this->db->join("ekinerja_renaksi_detail renaksi_detail","renaksi_detail.id_renaksi_detail = lkh.id_renaksi_detail","left");

        $rs = $this->db->get("ekinerja_lkh lkh");
        return $rs;
    } */

    public function get($param)
    {
        if(!empty($param['search']))
        {
            $this->db->where("(
                laporan_kerja_harian.rincian_kegiatan like '%".$param['search']."%' OR
                sasaran_indikator.nama_indikator_sasaran_renstra  like '%".$param['search']."%' OR
                kinerja_utama.rencana_hasil_kerja like '%".$param['search']."%' OR
                kinerja_tambahan.rencana_hasil_kerja like '%".$param['search']."%' OR
                instruksi_khusus.indikator_kinerja_individu like '%".$param['search']."%' OR
                renaksi.renaksi like '%".$param['search']."%'
            )");
        }

        if(!empty($param['where']))
        {
            $this->db->where($param['where']);
        }
        if(!empty($param['str_where']))
        {
            $this->db->where($param['str_where']);
        }

        if(!empty($param['str_where_2']))
        {
            $this->db->where($param['str_where_2']);
        }
        
        if(isset($param['limit']) && isset($param['offset']))
        {
            $this->db->limit($param['limit'],$param['offset']);
        }

        $this->db->join("laporan_kerja_harian", "laporan_kerja_harian.id_laporan_kerja_harian =lkh.id_laporan_kerja_harian", "left");

        $this->db->join("pegawai", "pegawai.id_pegawai =laporan_kerja_harian.id_pegawai", "left");
        $this->db->join("pegawai verifikator", "verifikator.id_pegawai =laporan_kerja_harian.id_verifikator", "left");
        $this->db->join("laporan_kerja_harian_rating rating", "rating.id_laporan_kerja_harian =laporan_kerja_harian.id_laporan_kerja_harian", "left");

        // skpd
        $this->db->join("ref_skpd skpd", "pegawai.id_skpd =skpd.id_skpd", "left");

        // lkh > kinerja
        $this->db->join("ekinerja_renaksi_detail renaksi_detail", "renaksi_detail.id_renaksi_detail =lkh.id_renaksi_detail", "left");
        $this->db->join("ekinerja_renaksi renaksi", "renaksi.id_renaksi =renaksi_detail.id_renaksi", "left");
        $this->db->join("ref_satuan renaksi_satuan","renaksi_satuan.id_satuan = renaksi.satuan","left");

        // kinerja utama
        $this->db->join("ekinerja_utama kinerja_utama", "kinerja_utama.id_kinerja_utama =renaksi.id_kinerja_utama", "left");

        // kinerja tambahan
        $this->db->join("ekinerja_tambahan kinerja_tambahan", "kinerja_tambahan.id_kinerja_tambahan =renaksi.id_kinerja_tambahan", "left");

        // instruksi khusus
        $this->db->join("ekinerja_instruksi_khusus instruksi_khusus", "instruksi_khusus.id_instruksi_khusus =renaksi.id_instruksi_khusus", "left");

        // skp
        //$this->db->join("ekinerja_skp skp", "skp.id_skp =renaksi.id_skp", "left");
        
        // cascading
        $this->db->join("ekinerja_cascading cascading", "cascading.id_cascading =kinerja_utama.id_cascading", "left");

        // renstra
        //$this->db->join("sc_renstra_sasaran sasaran","sasaran.id_sasaran_renstra = cascading.id_sasaran_renstra","left");
        $this->db->join("sc_renstra_sasaran_indikator sasaran_indikator","sasaran_indikator.id_indikator_sasaran_renstra = cascading.id_indikator_sasaran_renstra","left");
        //$this->db->join("ref_satuan sasaran_satuan","sasaran_satuan.id_satuan = sasaran_indikator.satuan","left");

        // program
        //$this->db->join("sc_renstra_program_indikator program_indikator","program_indikator.id_indikator_program_renstra = cascading.id_indikator_program_renstra","left");
        //$this->db->join("ref_satuan program_satuan","program_satuan.id_satuan = program_indikator.satuan","left");
        
        //$this->db->join("sc_rpjmd_program_indikator program_indikator_rpjmd","program_indikator_rpjmd.id_indikator_program_rpjmd = program_indikator.id_indikator_program_rpjmd","left");

        //$this->db->join("sc_renstra_program program","program.id_program_renstra = cascading.id_program_renstra","left");
        //$this->db->join("sc_rpjmd_program program_rpjmd","program_rpjmd.id_program_rpjmd = program.id_program_rpjmd","left");
        //$this->db->join("sc_ref_program ref_program","ref_program.id_ref_program = program_rpjmd.id_ref_program","left");

        //instruksi
        //$this->db->join("ekinerja_instruksi instruksi","instruksi.id_instruksi = cascading.id_instruksi","left");
        //$this->db->join("ref_satuan instruksi_satuan","instruksi_satuan.id_satuan = instruksi.satuan","left");
        //$this->db->join("ekinerja_instruksi instruksi_atasan","instruksi_atasan.id_instruksi = instruksi.id_instruksi_atasan","left");

        // kegiatan
        //$this->db->join("sc_renstra_kegiatan kegiatan","kegiatan.id_kegiatan = cascading.id_kegiatan","left");
        //$this->db->join("sc_ref_kegiatan ref_kegiatan","ref_kegiatan.id_ref_kegiatan = kegiatan.id_ref_kegiatan","left");

        //$this->db->join("sc_renstra_kegiatan_indikator kegiatan_indikator","kegiatan_indikator.id_indikator_kegiatan = cascading.id_kegiatan_indikator","left");
        //$this->db->join("ref_satuan kegiatan_satuan","kegiatan_satuan.id_satuan = kegiatan_indikator.satuan","left");

        // sub kegiatan
        //$this->db->join("sc_renja_sub_kegiatan sub_kegiatan","sub_kegiatan.id_sub_kegiatan_renja = cascading.id_sub_kegiatan_renja","left");
        //$this->db->join("sc_ref_sub_kegiatan ref_sub_kegiatan","ref_sub_kegiatan.id_sub_kegiatan = sub_kegiatan.id_ref_sub_kegiatan","left");

        //$this->db->join("sc_renja_sub_kegiatan_indikator sub_kegiatan_indikator","sub_kegiatan_indikator.id_indikator_sub_kegiatan = cascading.id_sub_kegiatan_indikator","left");
        //$this->db->join("ref_satuan sub_kegiatan_satuan","sub_kegiatan_satuan.id_satuan = sub_kegiatan_indikator.satuan","left");


        $case_status = "CASE status_verifikasi
                            WHEN 'sudah_diverifikasi' THEN 'Sudah Diverifikasi'
                            WHEN 'belum_diverifikasi' THEN 'Belum Diverifikasi'
                            WHEN 'ditolak' THEN 'Ditolak'
                            ELSE '-'
                        END as 'status'
        ";

        $download_lampiran = "CONCAT('" . base_url() . "','data/kegiatan_personal/',laporan_kerja_harian.id_pegawai,'/',laporan_kerja_harian.lampiran) as 'download_lampiran' ";
        
        $select_verifikasi = "";
        if(isset($param['verifikasi']))
        {
            $this->db->group_by("laporan_kerja_harian.tanggal");
            $this->db->group_by("laporan_kerja_harian.id_pegawai");
            $select_verifikasi = "count(laporan_kerja_harian.tanggal) as 'jumlah_laporan', 
                sum(
                    CASE status_verifikasi
                            WHEN 'sudah_diverifikasi' THEN 1
                            ELSE 0
                        END
                ) as 'sudah_diverifikasi',
            ";
        }
        
        $this->db->select("
        laporan_kerja_harian.*,
        rating.*, 
        DATE_FORMAT(tanggal,'%d %b') as 'short_date',
        laporan_kerja_harian.id_laporan_kerja_harian as 'id_laporan_kerja_harian',
        DATE_FORMAT(tanggal,'%d %M %Y') as 'long_date', 
        $case_status,
        pegawai.nama_lengkap as 'nama_pegawai' , 
        pegawai.nip as 'nip' , 
        pegawai.jabatan,
        verifikator.nama_lengkap as 'nama_verifikator', 
        $download_lampiran,
        $select_verifikasi

        CASE 
            WHEN (renaksi.id_kinerja_utama is not null AND cascading.flag is not null AND cascading.flag ='sasaran')
                THEN sasaran_indikator.nama_indikator_sasaran_renstra 
            WHEN (renaksi.id_kinerja_utama is not null AND cascading.flag is not null AND cascading.flag !='sasaran')
                THEN kinerja_utama.rencana_hasil_kerja
            WHEN (renaksi.id_kinerja_tambahan is not null)
                THEN kinerja_tambahan.rencana_hasil_kerja
            WHEN (renaksi.id_instruksi_khusus is not null)
                THEN instruksi_khusus.indikator_kinerja_individu
            ELSE ''
        END as 'rencana_hasil_kerja',

        CASE 
            WHEN (renaksi.id_kinerja_utama is not null)
                THEN renaksi.id_kinerja_utama 
            WHEN (renaksi.id_kinerja_tambahan is not null)
                THEN renaksi.id_kinerja_tambahan
            WHEN (renaksi.id_instruksi_khusus is not null)
                THEN renaksi.id_instruksi_khusus
            ELSE ''
        END as 'id_rencana_hasil',

        CASE 
            WHEN (renaksi.id_kinerja_utama is not null)
                THEN 'Kinerja Utama' 
            WHEN (renaksi.id_kinerja_tambahan is not null)
                THEN 'Kinerja Tambahan'
            WHEN (renaksi.id_instruksi_khusus is not null)
                THEN 'Instruksi Khusus'
            ELSE ''
        END as 'flag',
        renaksi.id_renaksi,
        renaksi.renaksi,
        renaksi.id_kinerja_utama,
        renaksi.id_instruksi_khusus,
        renaksi.id_kinerja_tambahan,
        renaksi_detail.target,
        renaksi_satuan.satuan,
        renaksi_detail.id_renaksi_detail
        ");

        $this->db->order_by("laporan_kerja_harian.id_laporan_kerja_harian", "desc");

        $this->db->group_by("lkh.id_laporan_kerja_harian");

        $rs = $this->db->get("ekinerja_lkh lkh");

        return $rs;
    }

    public function getTotalRealisasi($id_renaksi_detail)
    {
        $this->db->where("lkh.id_renaksi_detail",$id_renaksi_detail);

        $this->db->join("laporan_kerja_harian","laporan_kerja_harian.id_laporan_kerja_harian = lkh.id_laporan_kerja_harian","left");
        
        $this->db->select("sum(laporan_kerja_harian.hasil_kegiatan) as 'total' ");

        $res = $this->db->get("ekinerja_lkh lkh")->row();

        if($res && !empty($res->total))
        {
            $total = $res->total;
            if($total>100)
            {
                $total = 100;
            }
            return $total;
        }
        else{
            return 0;
        }

    }

    public function getSummaryRealisasi($param)
    {
        if(!empty($param['where']))
        {
            $this->db->where($param['where']);
        }
        if(!empty($param['str_where']))
        {
            $this->db->where($param['str_where']);
        }
        
        if(isset($param['limit']) && isset($param['offset']))
        {
            $this->db->limit($param['limit'],$param['offset']);
        }

        $this->db->join("laporan_kerja_harian","laporan_kerja_harian.id_laporan_kerja_harian = lkh.id_laporan_kerja_harian","left");
        $this->db->join("ekinerja_renaksi_detail renaksi_detail","renaksi_detail.id_renaksi_detail = lkh.id_renaksi_detail","left");
        $this->db->join("ekinerja_renaksi renaksi","renaksi.id_renaksi = renaksi_detail.id_renaksi","left");

        $select = "sum(laporan_kerja_harian.hasil_kegiatan) as 'total' ";

        if(isset($param['group_by']))
        {
            $this->db->group_by($param['group_by']);
            $select .= ",".$param['group_by'];
        }

        $this->db->select($select);

        $res = $this->db->get("ekinerja_lkh lkh");

        return $res;

    }

    private function getAvgCapaianLKH($id_renaksi)
    {
        $this->db->where("renaksi_detail.id_renaksi",$id_renaksi);
        $this->db->where("renaksi_detail.status_jadwal","Y");
        $this->db->select("avg(renaksi_detail.capaian_lkh) as 'capaian_lkh' ");

        $res = $this->db->get("ekinerja_renaksi_detail renaksi_detail")->row();

        if($res && !empty($res->capaian_lkh))
        {
            return $res->capaian_lkh;
        }
        else{
            return 0;
        }

    }

    public function updateCapaian($id_renaksi_detail)
    {
        $this->load->model("kinerja/Renaksi_model");
        $this->load->model("kinerja/Capaian_model");

        // update renaksi detail
        $capaian_lkh = $this->getTotalRealisasi($id_renaksi_detail);
        $this->Renaksi_model->updateCapaianRenaksi($id_renaksi_detail,$capaian_lkh);


        $param['where']['renaksi_detail.id_renaksi_detail'] = $id_renaksi_detail;
        $renaksi_detail = $this->Renaksi_model->get_detail($param)->row();
        if($renaksi_detail)
        {
            // update capaian RHK
            $this->Capaian_model->update($renaksi_detail);
        }
    }

    public function getVerifikator($id_pegawai)
    {

        $dt_pegawai = $this->db->where("id_pegawai",$id_pegawai)->get("pegawai")->row();

        $id_skpd = $dt_pegawai->id_skpd;
        $kepala_skpd = $dt_pegawai->kepala_skpd;

        $this->load->model("ref_skpd_model");
        $this->load->model("master_pegawai_model");

        $skpd = $this->ref_skpd_model->get_by_id($id_skpd);
        $jenis_skpd = $skpd->jenis_skpd;
        $pegawai = $this->master_pegawai_model->get_by_id($id_pegawai);

        $atasan = $this->master_pegawai_model->get_by_id($id_pegawai)->id_pegawai_atasan_langsung;
        $verifikator = array();
        if (!empty($atasan)) {
            $verifikator[] = $this->master_pegawai_model->get_by_id($atasan);
        } else {
            if ($kepala_skpd == "Y" && $pegawai->jabatan != 'Sekretaris Daerah') {
                $verifikator_kepala = array('Asisten Administrasi Umum' => array(3, 12, 18, 25, 26, 24, 20), 'Asisten Pembangunan' => array(4, 5, 6, 7, 9, 10, 11, 17, 19, 21, 22, 14, 30), 'Asisten Pemerintahan' => array(8, 13, 15, 16, 23, 35, 36, 2));
                $verifikator = array();
                foreach ($verifikator_kepala as $k => $v) {
                    if (in_array($id_skpd, $v)) {
                        $verifikator[] = $this->master_pegawai_model->get_by_jabatan($k);
                    }
                }
                if ($jenis_skpd == 'kecamatan') {
                    $verifikator[] = $this->master_pegawai_model->get_by_id(88);
                } elseif ($jenis_skpd == 'puskesmas') {
                    $verifikator[] = $this->master_pegawai_model->get_by_id(538);
                } elseif ($jenis_skpd == 'kelurahan' || $jenis_skpd == 'uptd') {
                    $verifikator[] = $this->master_pegawai_model->get_pegawai_kepala_skpd($skpd->id_skpd_induk);
                }
                // $verifikator[] = $this->master_pegawai_model->get_by_id(77);
            } elseif ($pegawai->jabatan == 'Sekretaris Daerah') {
                $verifikator = $this->master_pegawai_model->get_by_id_skpd(33, true);
            } elseif ($pegawai->jabatan == 'Staff Ahli' || $pegawai->jabatan == 'Asisten Administrasi Umum' || $pegawai->jabatan == 'Asisten Pembangunan' || $pegawai->jabatan == 'Asisten Pemerintahan') {
                $verifikator[0] = $this->master_pegawai_model->get_by_id(77);
            } else {
                $verifikator = $this->master_pegawai_model->get_by_id_skpd($id_skpd, true);
            }
            // $verifikator = $this->master_pegawai_model->get_by_id_skpd($id_skpd, true);
        }

        return $verifikator;
    }
}