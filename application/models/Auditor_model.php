<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auditor_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_count_pkpt($year = null)
    {
        $pegawai = $this->db->get_where('pegawai',['id_pegawai'=>$this->session->userdata('id_pegawai')])->row();
        // $penugasan = $this->db->get_where('auditor_penugasan',['id_penugasan'=>decode($id_penugasan)])->row();
        
        if ($pegawai->kepala_skpd != "Y" and $this->uri->segment(3) !="penugasan" and $this->session->userdata('level') != "Administrator") {
           $this->db->group_start();
            // $this->db->where('FIND_IN_SET('.$id_pegawai.', anggota_topik) > 0');
            $this->db->or_where("CONCAT(',', pj_penugasan, ',') LIKE '%,{$pegawai->id_pegawai},%'");
            $this->db->or_where("CONCAT(',', ppj_penugasan, ',') LIKE '%,{$pegawai->id_pegawai},%'");
            $this->db->or_where("CONCAT(',', pt_penugasan, ',') LIKE '%,{$pegawai->id_pegawai},%'");
            $this->db->or_where("CONCAT(',', kt_penugasan, ',') LIKE '%,{$pegawai->id_pegawai},%'");
            $this->db->or_where("CONCAT(',', at_penugasan, ',') LIKE '%,{$pegawai->id_pegawai},%'");
            // $this->db->or_where_in('pj_penugasan',array(intval($pegawai->id_pegawai)),true);
            // $this->db->or_where_in('ppj_penugasan',array(intval($pegawai->id_pegawai)),true);
            // $this->db->or_where_in('pt_penugasan',array(intval($pegawai->id_pegawai)),true);
            // $this->db->or_where_in('kt_penugasan',array(intval($pegawai->id_pegawai)),true);
            // $this->db->or_where_in('at_penugasan',array(intval($pegawai->id_pegawai)),true);
           $this->db->group_end();
        }
        if ($year) {
            $this->db->where('tahun_anggaran', $year);
        }
        $this->db->join('auditor_susunan', 'auditor_susunan.id_susunan = auditor_penugasan.id_susunan', 'left');
        $this->db->join('auditor_pkpt', 'auditor_pkpt.id_pkpt = auditor_susunan.id_pkpt', 'left');
        $query = $this->db->get('auditor_penugasan');

        $total = $persiapan = $proses = $selesai = 0;
        foreach ($query->result() as $key => $value) {
            if ($value->status_penugasan == "Selesai") {
                $selesai++;
            } elseif ($value->status_penugasan == "Proses") {
                $proses++;
            } elseif ($value->status_penugasan == "Persiapan") {
                $persiapan++;
            }
            $total++;
        }
        $ret = array('total' => $total, 'persiapan' => $persiapan, 'proses' => $proses, 'selesai' => $selesai);

        return $ret;
    }

    public function get_list_sp()
    {
        $this->db->where('id_skpd_pengirim', 2);
        $this->db->where('jenis_surat', 'internal');
        $this->db->where('status_ttd', 'sudah_ditandatangani');
        $this->db->order_by('nomer_surat', 'ASC');
        $this->db->group_by('nomer_surat');
        $query = $this->db->get('surat_keluar');
        return $query->result();
    }

    public function get_list_skpd()
    {
        $this->db->where('jenis_skpd !=', 'desa');
        $this->db->where('jenis_skpd !=', 'demo');
        $this->db->order_by('nama_skpd', 'ASC');
        $query = $this->db->get('ref_skpd');
        return $query->result();
    }

    public function get_list_anggota()
    {
        $this->db->where('id_skpd', 2);
        $this->db->order_by('nama_lengkap', 'ASC');
        $query = $this->db->get('pegawai');
        return $query->result();
    }

    public function get_list_subkegiatan()
    {
        $this->db->where('sasaran.id_skpd', 2);
        $this->db->join("sc_ref_sub_kegiatan ref_sub_kegiatan", "ref_sub_kegiatan.id_sub_kegiatan = renja_sub_kegiatan.id_ref_sub_kegiatan", "left");

        $this->db->join("sc_renstra_kegiatan_indikator renstra_kegiatan_indikator", "renstra_kegiatan_indikator.id_indikator_kegiatan = renja_sub_kegiatan.id_indikator_kegiatan", "left");
        $this->db->join("sc_renstra_kegiatan renstra_kegiatan", "renstra_kegiatan.id_kegiatan = renstra_kegiatan_indikator.id_kegiatan", "left");
        $this->db->join("sc_renstra_program_indikator program_indikator", "program_indikator.id_indikator_program_renstra = renstra_kegiatan.id_indikator_program_renstra", "left");
        $this->db->join("sc_renstra_program renstra_program", "renstra_program.id_program_renstra = program_indikator.id_program_renstra", "left");

        $this->db->join("sc_renstra_sasaran sasaran", "sasaran.id_sasaran_renstra = renstra_program.id_sasaran_renstra", "left");
        // $this->db->order_by('nama_skpd', 'ASC');
        $query = $this->db->get('sc_renja_sub_kegiatan renja_sub_kegiatan');
        return $query->result();
    }

    public function get_list_pkptsubkegiatan($year = null)
    {
        if ($year) {
            $this->db->where('tahun_anggaran', $year);
        }
        $this->db->join('sc_ref_sub_kegiatan', 'sc_ref_sub_kegiatan.kode_sub_kegiatan = auditor_pkpt.kode_sub_kegiatan', 'left');
        $this->db->group_by('auditor_pkpt.kode_sub_kegiatan');
        $query = $this->db->get('auditor_pkpt');
        return $query;
    }

    public function get_list_pkpt($year = null)
    {
        if ($year) {
            $this->db->where('tahun_anggaran', $year);
        }
        $this->db->join('sc_ref_sub_kegiatan', 'sc_ref_sub_kegiatan.kode_sub_kegiatan = auditor_pkpt.kode_sub_kegiatan', 'left');
        $this->db->group_by('auditor_pkpt.kode_sub_kegiatan');
        $query = $this->db->get('auditor_pkpt');
        $ret['sub_kegiatan'] = $query->result();

        foreach ($ret['sub_kegiatan'] as $row) {
            $this->db->where('auditor_pkpt.kode_sub_kegiatan', $row->kode_sub_kegiatan);
            $this->db->join('sc_ref_sub_kegiatan', 'sc_ref_sub_kegiatan.kode_sub_kegiatan = auditor_pkpt.kode_sub_kegiatan', 'left');
            $query2 = $this->db->get('auditor_pkpt');
            $ret['pkpt'][$row->kode_sub_kegiatan] = $query2->result();

            foreach ($ret['pkpt'][$row->kode_sub_kegiatan] as $key => $value) {
                $this->db->where('id_pkpt', $value->id_pkpt);
                $query3 = $this->db->get('auditor_susunan');
                $ret['susunan'][$row->kode_sub_kegiatan][$key] = $query3->result();
            }
        }
        return $ret;
    }

    public function get_list_penugasan($klasifikasi = null, $id_pkpt = null, $id_penugasan = null)
    {
        $pegawai = $this->db->get_where('pegawai',['id_pegawai'=>$this->session->userdata('id_pegawai')])->row();
        // $penugasan = $this->db->get_where('auditor_penugasan',['id_penugasan'=>decode($id_penugasan)])->row();
        
        if ($pegawai->kepala_skpd != "Y" and $this->uri->segment(3) !="penugasan" and $this->session->userdata('level') != "Administrator") {
           $this->db->group_start();
            // $this->db->where('FIND_IN_SET('.$id_pegawai.', anggota_topik) > 0');
            $this->db->or_where("CONCAT(',', pj_penugasan, ',') LIKE '%,{$pegawai->id_pegawai},%'");
            $this->db->or_where("CONCAT(',', ppj_penugasan, ',') LIKE '%,{$pegawai->id_pegawai},%'");
            $this->db->or_where("CONCAT(',', pt_penugasan, ',') LIKE '%,{$pegawai->id_pegawai},%'");
            $this->db->or_where("CONCAT(',', kt_penugasan, ',') LIKE '%,{$pegawai->id_pegawai},%'");
            $this->db->or_where("CONCAT(',', at_penugasan, ',') LIKE '%,{$pegawai->id_pegawai},%'");
            // $this->db->or_where_in('pj_penugasan',array(intval($pegawai->id_pegawai)),true);
            // $this->db->or_where_in('ppj_penugasan',array(intval($pegawai->id_pegawai)),true);
            // $this->db->or_where_in('pt_penugasan',array(intval($pegawai->id_pegawai)),true);
            // $this->db->or_where_in('kt_penugasan',array(intval($pegawai->id_pegawai)),true);
            // $this->db->or_where_in('at_penugasan',array(intval($pegawai->id_pegawai)),true);
           $this->db->group_end();
        }
        if ($klasifikasi) {
            $this->db->where('klasifikasi', $klasifikasi);
        }
        if ($id_pkpt) {
            $this->db->where('id_pkpt', $id_pkpt);
        }
        if ($id_penugasan) {
            $this->db->where('id_penugasan', $id_penugasan);
        }
        $this->db->join('auditor_susunan', 'auditor_susunan.id_susunan = auditor_penugasan.id_susunan', 'left');
        $this->db->join('surat_keluar', 'surat_keluar.id_surat_keluar = auditor_penugasan.id_surat', 'left');
        $this->db->order_by('id_penugasan', 'DESC');
        $query = $this->db->get('auditor_penugasan');
        $ret['detail'] = $query->result();
        // echo $this->db->last_query();

        $persiapan = $proses = $selesai = 0;
        foreach ($ret['detail'] as $key => $value) {
            if ($value->status_penugasan == "Selesai") {
                $selesai++;
            } elseif ($value->status_penugasan == "Proses") {
                $proses++;
            } elseif ($value->status_penugasan == "Persiapan") {
                $persiapan++;
            }

            $anggota = array();
            $pj = explode(',', $value->pj_penugasan);
            $ppj = explode(',', $value->ppj_penugasan);
            $pt = explode(',', $value->pt_penugasan);
            $kt = explode(',', $value->kt_penugasan);
            $at = explode(',', $value->at_penugasan);
            $anggota = array_merge($anggota, $pj);
            $anggota = array_merge($anggota, $ppj);
            $anggota = array_merge($anggota, $pt);
            $anggota = array_merge($anggota, $kt);
            $anggota = array_merge($anggota, $at);
            $this->db->where_in('id_pegawai', $anggota);
            $query2 = $this->db->get('pegawai');
            $ret['anggota'][$key] = $query2->result();

            $this->db->where('id_penugasan', $value->id_penugasan);
            $this->db->where('memiliki_nhp', 'Y');
            $this->db->where('status_nhp !=', 'Y');
            $query3 = $this->db->get('auditor_pekerjaan');
            $ret['nhp'][$key] = $query3->result();

            $this->db->where('id_penugasan', $value->id_penugasan);
            $this->db->where('memiliki_nhp', 'Y');
            $this->db->where('status_nhp', 'Y');
            $this->db->where('status_lhp !=', 'Y');
            $query4 = $this->db->get('auditor_pekerjaan');
            $ret['lhp'][$key] = $query4->result();
        }
        $ret['count'] = array('persiapan' => $persiapan, 'proses' => $proses, 'selesai' => $selesai);
        return $ret;
    }

    public function get_list_temuan($klasifikasi = null)
    {
        if ($klasifikasi) {
            $this->db->where('klasifikasi', $klasifikasi);
        }
        $this->db->join('surat_keluar', 'surat_keluar.id_surat_keluar = auditor_temuan.id_surat', 'left');
        $query = $this->db->get('auditor_temuan');
        $ret['detail'] = $query->result();

        foreach ($ret['detail'] as $key => $value) {
            $anggota = explode(',', $value->anggota_temuan);
            $this->db->where_in('id_pegawai', $anggota);
            $query2 = $this->db->get('pegawai');
            $ret['anggota'][$key] = $query2->result();
        }
        return $ret;
    }

    public function get_detail_temuan($id_temuan)
    {
        $this->db->where('id_temuan', $id_temuan);
        $this->db->join('surat_keluar', 'surat_keluar.id_surat_keluar = auditor_temuan.id_surat', 'left');
        $this->db->join('ref_skpd', 'ref_skpd.id_skpd = auditor_temuan.lokasi_temuan', 'left');
        $query = $this->db->get('auditor_temuan');
        $ret['detail'] = $query->row();

        $anggota = explode(',', $ret['detail']->anggota_temuan);
        $this->db->where('id_pegawai', $anggota[0]);
        $query2 = $this->db->get('pegawai');
        $ret['ketua'] = $query2->row();

        $anggota = explode(',', $ret['detail']->anggota_temuan);
        array_shift($anggota);
        $this->db->where_in('id_pegawai', $anggota);
        $query3 = $this->db->get('pegawai');
        $ret['anggota'] = $query3->result();

        $this->db->where('id_temuan', $id_temuan);
        $query = $this->db->get('auditor_program');
        $ret['program'] = $query->result();

        return $ret;
    }

    public function get_detail_pkpt($id_pkpt = null)
    {
        $this->db->where('id_pkpt', $id_pkpt);
        $this->db->join('sc_ref_sub_kegiatan', 'sc_ref_sub_kegiatan.kode_sub_kegiatan = auditor_pkpt.kode_sub_kegiatan', 'left');
        $query = $this->db->get('auditor_pkpt');
        $ret['detail'] = $query->row();

        $this->db->where('id_pkpt', $id_pkpt);
        $query2 = $this->db->get('auditor_susunan');
        $ret['susunan'] = $query2->result();

        $this->db->where('tahun_anggaran', $ret['detail']->tahun_anggaran);
        $this->db->join('sc_ref_sub_kegiatan', 'sc_ref_sub_kegiatan.kode_sub_kegiatan = auditor_pkpt.kode_sub_kegiatan', 'left');
        $this->db->group_by('auditor_pkpt.kode_sub_kegiatan');
        $query3 = $this->db->get('auditor_pkpt');
        $ret['list'] = $query3->result();
        return $ret;
    }

    public function get_detail_penugasan($id_penugasan)
    {
        $this->db->where('id_penugasan', $id_penugasan);
        $this->db->join('surat_keluar', 'surat_keluar.id_surat_keluar = auditor_penugasan.id_surat', 'left');
        // $this->db->join('ref_skpd', 'ref_skpd.id_skpd = auditor_penugasan.lokasi_temuan', 'left');
        $this->db->join('auditor_susunan', 'auditor_susunan.id_susunan = auditor_penugasan.id_susunan', 'left');
        $query = $this->db->get('auditor_penugasan');
        $ret['detail'] = $query->row();

        $list_desa = $list_skpd = array();
        $lo = explode(',', $ret['detail']->lokasi_penugasan);
        foreach ($lo as $l) {
            if (strpos($l, 'd') !== false) {
                $list_desa[] = ltrim($l, 'd');
            } else {
                $list_skpd[] = $l;
            }
        }
        $this->db->where_in('id_skpd', $lo);
        $qlo = $this->db->get('ref_skpd');
        $ret['lo_penugasan_skpd'] = $qlo->result();

        $get_desa = curlMadasih('list_desa');
        if ($testing == 1) {
            print_r($get_desa);
            die;
        }
        if ($get_desa) {
            $desa = json_decode($get_desa);
        } else {
            $desa = array();
        }
        $ret['lo_penugasan_desa'] = array();
        foreach ($desa as $d) {
            if (in_array($d->id_skpd,$list_desa)) {
                $ret['lo_penugasan_desa'][] = $d;
            }
        }

        $ret['lo_penugasan'] = array_merge($ret['lo_penugasan_skpd'],$ret['lo_penugasan_desa']);

        $pj = explode(',', $ret['detail']->pj_penugasan);
        $this->db->where_in('id_pegawai', $pj);
        $qpj = $this->db->get('pegawai');
        $ret['pj_penugasan'] = $qpj->result();

        $ppj = explode(',', $ret['detail']->ppj_penugasan);
        $this->db->where_in('id_pegawai', $ppj);
        $qppj = $this->db->get('pegawai');
        $ret['ppj_penugasan'] = $qppj->result();

        $pt = explode(',', $ret['detail']->pt_penugasan);
        $this->db->where_in('id_pegawai', $pt);
        $qpt = $this->db->get('pegawai');
        $ret['pt_penugasan'] = $qpt->result();

        $kt = explode(',', $ret['detail']->kt_penugasan);
        $this->db->where_in('id_pegawai', $kt);
        $qkt = $this->db->get('pegawai');
        $ret['kt_penugasan'] = $qkt->result();

        $at = explode(',', $ret['detail']->at_penugasan);
        $this->db->where_in('id_pegawai', $at);
        $qat = $this->db->get('pegawai');
        $ret['at_penugasan'] = $qat->result();

        return $ret;
    }

    public function get_detail_pekerjaan($id_pekerjaan)
    {
        $this->db->where('id_pekerjaan', $id_pekerjaan);
        $query = $this->db->get('auditor_pekerjaan');
        $ret['detail'] = $query->row();

        $anggota = explode(',', $ret['detail']->anggota_topik);
        $this->db->where_in('id_pegawai', $anggota);
        $query2 = $this->db->get('pegawai');
        $ret['anggota'] = $query2->result();

        return $ret;
    }

    public function insert_pkpt($meta)
    {
        $pkpt['tahun_anggaran'] = 2023;
        $pkpt['kode_sub_kegiatan'] = $meta['kode_sub_kegiatan'];
        $pkpt['nama_aktifitas'] = $meta['nama_aktifitas'];
        $pkpt['jenis_pemeriksaan'] = $meta['jenis_pemeriksaan'];
        $pkpt['jumlah_lhp'] = $meta['jumlah_lhp'];
        if (!empty($meta['id_pkpt'])) {
            $this->db->where('id_pkpt', $meta['id_pkpt']);
            $i_pkpt = $this->db->update('auditor_pkpt', $pkpt);
            $id_pkpt = $meta['id_pkpt'];
        } else {
            $i_pkpt = $this->db->insert('auditor_pkpt', $pkpt);
            $id_pkpt = $this->db->insert_id();
        }
        $this->db->where('id_pkpt', $id_pkpt);
        $d_susunan = $this->db->delete('auditor_susunan');
        if ($id_pkpt and count($meta['nama_tim']) > 1) {
            foreach ($meta['nama_tim'] as $key => $value) {
                $susunan = array();
                if ($key != 0) {
                    $susunan['id_pkpt'] = $id_pkpt;
                    $susunan['nama_tim'] = $meta['nama_tim'][$key];
                    $susunan['jumlah_pj'] = $meta['jumlah_pj'][$key];
                    $susunan['jumlah_ppj'] = $meta['jumlah_ppj'][$key];
                    $susunan['jumlah_pt'] = $meta['jumlah_pt'][$key];
                    $susunan['jumlah_kt'] = $meta['jumlah_kt'][$key];
                    $susunan['jumlah_at'] = $meta['jumlah_at'][$key];
                    $susunan['jadwal_rmp'] = $meta['jadwal_rmp'][$key];
                    $susunan['jadwal_rpl'] = $meta['jadwal_rpl'][$key];
                    if (!empty($meta['id_susunan'][$key])) {
                        $susunan['id_susunan'] = $meta['id_susunan'][$key];
                    }
                    $i_susunan = $this->db->insert('auditor_susunan', $susunan);
                }
            }
        }
    }

    public function delete_objek_pemeriksaan($meta)
    {
        $this->db->where('id_pkpt', $meta['id']);
        $this->db->delete('auditor_susunan');
        $this->db->where('id_pkpt', $meta['id']);
        return $this->db->delete('auditor_pkpt');
    }

    public function insert_penugasan($meta)
    {
        $meta['status_penugasan'] = "Persiapan";
        $meta['lokasi_penugasan'] = (isset($meta['pj_penugasan'])) ? implode(',', @$meta['lokasi_penugasan']) : "";
        $meta['pj_penugasan'] = (isset($meta['pj_penugasan'])) ? implode(',', @$meta['pj_penugasan']) : "";
        $meta['ppj_penugasan'] = (isset($meta['ppj_penugasan'])) ? implode(',', @$meta['ppj_penugasan']) : "";
        $meta['pt_penugasan'] = (isset($meta['pt_penugasan'])) ? implode(',', @$meta['pt_penugasan']) : "";
        $meta['kt_penugasan'] = (isset($meta['kt_penugasan'])) ? implode(',', @$meta['kt_penugasan']) : "";
        $meta['at_penugasan'] = (isset($meta['at_penugasan'])) ? implode(',', @$meta['at_penugasan']) : "";
        if (!empty($meta['id_penugasan'])) {
            $this->db->where('id_penugasan', $meta['id_penugasan']);
            $i_penugasan = $this->db->update('auditor_penugasan', $meta);
        } else {
            $i_penugasan = $this->db->insert('auditor_penugasan', $meta);
        }
        return $i_penugasan;
    }

    public function delete_penugasan($meta)
    {
        $this->db->where('id_penugasan', $meta['id']);
        return $this->db->delete('auditor_penugasan');
    }

    public function insert_temuan($meta)
    {
        $meta['status_temuan'] = "Persiapan";
        $meta['lokasi_temuan'] = implode(',', $meta['lokasi_temuan']);
        $meta['anggota_temuan'] = implode(',', $meta['anggota_temuan']);
        return $this->db->insert('auditor_temuan', $meta);
    }

    public function submit_program($meta)
    {
        $verse1['nama_temuan'] = $meta['nama_temuan'];
        $verse1['rincian_temuan'] = $meta['rincian_temuan'];
        $this->db->where('id_temuan', $meta['id_temuan']);
        $temuan = $this->db->update('auditor_temuan', $verse1);

        $this->db->where('id_temuan', $meta['id_temuan']);
        $this->db->delete('auditor_program');

        foreach ($meta['nama_program'] as $nama_program) {
            if ($nama_program) {
                $verse2['id_temuan'] = $meta['id_temuan'];
                $verse2['nama_program'] = $nama_program;
                $program = $this->db->insert('auditor_program', $verse2);
            }
        }
    }

    public function change_ketua($meta)
    {
        $get = $this->db->get_where('auditor_temuan', ['id_temuan' => $meta['id_temuan']])->row();

        $anggota_temuan = explode(',', $get->anggota_temuan);
        $anggota_temuan = array_diff($anggota_temuan, [$meta['anggota_temuan']]);
        array_unshift($anggota_temuan, $meta['anggota_temuan']);

        $verse['anggota_temuan'] = implode(',', $anggota_temuan);
        $this->db->where('id_temuan', $meta['id_temuan']);
        $temuan = $this->db->update('auditor_temuan', $verse);
    }

    public function change_klasifikasi($meta)
    {
        $this->db->where('id_penugasan', $meta['id_penugasan']);
        $temuan = $this->db->update('auditor_penugasan', $meta);
    }

    public function insert_pekerjaan($meta)
    {
        return $this->db->insert('auditor_pekerjaan', $meta);
    }

    public function move_pekerjaan($meta)
    {
        $this->db->set('board_position', $meta['board_position']);
        $this->db->where('board_id', $meta['board_id']);
        $query = $this->db->update('auditor_pekerjaan');

        $this->db->where('board_id', $meta['board_id']);
        $check = $this->db->get('auditor_pekerjaan')->row();

        $this->db->where('id_penugasan', $check->id_penugasan);
        $this->db->group_by('board_position');
        $get = $this->db->get('auditor_pekerjaan')->result();

        $persiapan = $proses = $selesai = 0;
        foreach ($get as $row) {
            if ($row->board_position == "board-done") {
                $selesai++;
            } elseif ($row->board_position == "board-in-progres" or $row->board_position == "board-in-review") {
                $proses++;
            } elseif ($row->board_position == "board-to-do") {
                $persiapan++;
            }
        }

        if ($proses > 0) {
            $status = "Proses";
        } elseif ($selesai == 0) {
            $status = "Persiapan";
        } elseif ($persiapan == 0) {
            $status = "Selesai";
        } else {
            $status = "Proses";
        }
        $this->db->set('status_penugasan', $status);
        $this->db->where('id_penugasan', $check->id_penugasan);
        $query2 = $this->db->update('auditor_penugasan');

        return $status;
    }

    public function update_pekerjaan($meta)
    {
        foreach ($meta as $key => $row) {
            $this->db->set($key, $row);
        }
        $this->db->where('board_id', $meta['board_id']);
        return $this->db->update('auditor_pekerjaan');
    }

    public function delete_pekerjaan($meta)
    {
        $this->db->where('board_id', $meta['board_id']);
        return $this->db->delete('auditor_pekerjaan');
    }

    public function reset_aspek($meta)
    {
        $this->db->where('board_id', $meta['board_id']);
        return $this->db->delete('auditor_aspek');
    }

    public function add_aspek($meta)
    {
        foreach ($meta as $key => $row) {
            $this->db->set($key, $row);
        }
        return $this->db->insert('auditor_aspek');
    }

    public function add_aktifitas($meta)
    {
        foreach ($meta as $key => $row) {
            $this->db->set($key, $row);
        }
        return $this->db->insert('auditor_aktifitas');
    }

    public function get_item_board($id_penugasan, $board = null,$id_pegawai=0)
    {
        $pegawai = $this->db->get_where('pegawai',['id_pegawai'=>$id_pegawai])->row();
        $penugasan = $this->db->get_where('auditor_penugasan',['id_penugasan'=>decode($id_penugasan)])->row();
        
        if ($pegawai->kepala_skpd != "Y" AND !in_array($id_pegawai,explode(',',$penugasan->pj_penugasan))  AND !in_array($id_pegawai,explode(',',$penugasan->ppj_penugasan))  AND !in_array($id_pegawai,explode(',',$penugasan->pt_penugasan))  AND !in_array($id_pegawai,explode(',',$penugasan->kt_penugasan)) and $this->session->userdata('level') != "Administrator") {
           $this->db->group_start();
            // $this->db->where('FIND_IN_SET('.$id_pegawai.', anggota_topik) > 0');
            $this->db->where_in('anggota_topik',array(intval($id_pegawai)),true);
            $this->db->or_where('id_pegawai',$id_pegawai);
           $this->db->group_end();
        }
        if($id_pegawai == 0) 
            $this->db->where('board_position', NULL);
        if ($board)
            $this->db->where('board_position', $board);
        $this->db->where('id_penugasan', decode($id_penugasan));
        $query = $this->db->get('auditor_pekerjaan');
        

        $items = array();
        foreach ($query->result() as $row) {
            $comments = $this->db->where('board_id',$row->board_id)->where('type','comment')->get('auditor_aktifitas')->num_rows();
            $attachments = $this->db->where('board_id',$row->board_id)->where('type','attachment')->get('auditor_aktifitas')->num_rows();
            $pembuat = $this->db->where('id_pegawai',$row->id_pegawai)->get('pegawai')->row();
            //   {
            //     "id": "in-progress-2",
            //     "title": "Find new images for pages",
            //     "comments": "1",
            //     "badge-text": "Images",
            //     "image": "04.jpg",
            //     "badge": "warning",
            //     "due-date": "2",
            //     "attachments": "5",
            //     "assigned": [
            //       "avatar-s-3.jpg",
            //       "avatar-s-4.jpg"
            //     ],
            //     "members": ["Laurel", "Oliver"]
            //   }

            $pegawai = $this->db->where_in('id_pegawai', explode(',', $row->anggota_topik))->get('pegawai')->result();
            $item = array(
                'id' => $row->board_id,
                'title' => $row->nama_topik,
                'comments' => $comments,
                'badge-text' => $row->nama_skpd,
                'class' => '',
                // 'image' => NULL,
                'badge' => 'primary',
                'due-date' => $row->tanggal_topik,
                'attachments' => $attachments,
                'pembuat' => $pembuat->nama_lengkap,
                'pembuatid' => $pembuat->id_pegawai,
                // 'members' => null,
            );
            if ($row->status_nhp == "P"){
                $item['class'] = "border-warning";
            } elseif ($row->status_nhp == "N"){
                $item['class'] = "border-danger";
            }
            if ($row->status_nhp == "Y" AND $row->status_lhp == "P"){
                $item['class'] = "border-warning";
            } elseif ($row->status_nhp == "Y" AND $row->status_lhp == "N"){
                $item['class'] = "border-danger";
            }
            if (!empty($row->cover_pekerjaan))
                $item['image'] = $row->cover_pekerjaan;
            if (!empty($pegawai)) {
                foreach ($pegawai as $anggota) {
                    $item['assigned'][] = $anggota->foto_pegawai;
                    $item['members'][] = str_replace(',', '&#44;', $anggota->nama_lengkap);
                    ;
                }
            }
            $items[] = $item;
        }
        return $items;
    }

    public function get_aktifitas($board_id, $group = '')
    {
        if ($group)
            $this->db->where('group', $group);
        $this->db->join('pegawai', 'pegawai.id_pegawai = auditor_aktifitas.id_pegawai', 'left');
        $this->db->order_by('tanggal_aktifitas', 'DESC');
        return $this->db->get_where('auditor_aktifitas', ['board_id' => $board_id])->result();
    }

    public function get_status($board_id, $group = '')
    {
        $this->db->join('auditor_penugasan','auditor_penugasan.id_penugasan = auditor_pekerjaan.id_penugasan','left');
        return $this->db->get_where('auditor_pekerjaan', ['board_id' => $board_id])->row();
    }
}