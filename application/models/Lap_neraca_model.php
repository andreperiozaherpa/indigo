<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Lap_neraca_model extends CI_Model
{

    public $id_laporan_neraca;
    public $id_skpd;
    public $tgl_periode;
    public $tgl_pengesahan;
    public $asset_lancar_sekarang;
    public $asset_lancar_awal;
    public $asset_lancar_total;
    public $kas_sekarang;
    public $kas_awal;
    public $kas_total;
    public $persedian_sekarang;
    public $persedian_awal;
    public $persedian_total;
    public $dst1_text;
    public $dst1_sekarang;
    public $dst1_awal;
    public $dst1_total;
    public $dst2_text;
    public $dst2_sekarang;
    public $dst2_awal;
    public $dst2_total;
    public $dst3_text;
    public $dst3_sekarang;
    public $dst3_awal;
    public $dst3_total;
    public $dst4_text;
    public $dst4_sekarang;
    public $dst4_awal;
    public $dst4_total;
    public $dst5_text;
    public $dst5_sekarang;
    public $dst5_awal;
    public $dst5_total;
    public $dst6_text;
    public $dst6_sekarang;
    public $dst6_awal;
    public $dst6_total;
    public $dst7_text;
    public $dst7_sekarang;
    public $dst7_awal;
    public $dst7_total;
    public $dst8_text;
    public $dst8_sekarang;
    public $dst8_awal;
    public $dst8_total;
    public $investasi_jangkapanjang_sekarang;
    public $investasi_jangkapanjang_awal;
    public $investasi_jangkapanjang_total;
    public $asset_tetap_sekarang;
    public $asset_tetap_awal;
    public $asset_tetap_total;
    public $tanah_sekarang;
    public $tanah_awal;
    public $tanah_total;
    public $peralatan_sekarang;
    public $peralatan_awal;
    public $peralatan_total;
    public $gedung_sekarang;
    public $gedung_awal;
    public $gedung_total;
    public $jalan_sekarang;
    public $jalan_awal;
    public $jalan_total;
    public $asset_lainya_sekarang;
    public $asset_lainya_awal;
    public $asset_lainya_total;
    public $kontruksi_sekarang;
    public $kontruksi_awal;
    public $kontruksi_total;
    public $akumulasi_sekarang;
    public $akumulasi_awal;
    public $akumulasi_total;
    public $asset_lain_sekarang;
    public $asset_lain_awal;
    public $asset_lain_total;
    public $total_asset_sekarang;
    public $total_asset_awal;
    public $total_asset;
    public $total_kewajiban_sekarang;
    public $total_kewajiban_awal;
    public $total_kewajiban;
    public $kewajiban_pendek_sekarang;
    public $kewajiban_pendek_awal;
    public $kewajiban_pendek_total;
    public $kewajiban_panjang_sekarang;
    public $kewajiban_panjang_awal;
    public $kewajiban_panjang_total;
    public $ekuitas_sekarang;
    public $ekuitas_awal;
    public $ekuitas_total;
    public $total_neraca_sekarang;
    public $total_neraca_awal;
    public $total_neraca;

    public $id_pegawai_1_bpkad;
    public $id_pegawai_2_bpkad;
    public $id_pegawai_3_bpkad;
    public $id_pegawai_4_bpkad;
    public $id_pegawai_1_skpd;
    public $id_pegawai_2_skpd;
    public $id_pegawai_3_skpd;
    public $id_pegawai_4_skpd;
    public $ttd_pegawai_1_bpkad;
    public $ttd_pegawai_2_bpkad;
    public $ttd_pegawai_3_bpkad;
    public $ttd_pegawai_4_bpkad;
    public $ttd_pegawai_1_skpd;
    public $ttd_pegawai_2_skpd;
    public $ttd_pegawai_3_skpd;
    public $ttd_pegawai_4_skpd;
    public $file_draft;
    public $file_signed;
    public $status;


    public function get_all()
    {
        if (in_array('keuangan', explode(';', $this->session->userdata('user_privileges')))) {
            $this->db->where('laporan_neraca.id_skpd', $this->session->userdata('id_skpd'));
        }
        $this->db->order_by('id_laporan_neraca', 'desc');
        $this->db->join('pegawai as pegawai1', 'pegawai1.id_pegawai = laporan_neraca.id_pegawai_1_bpkad', 'left');
        $this->db->join('pegawai as pegawai2', 'pegawai2.id_pegawai = laporan_neraca.id_pegawai_2_bpkad', 'left');
        $this->db->join('pegawai as pegawai3', 'pegawai3.id_pegawai = laporan_neraca.id_pegawai_3_bpkad', 'left');
        $this->db->join('pegawai as pegawai4', 'pegawai4.id_pegawai = laporan_neraca.id_pegawai_4_bpkad', 'left');
        $this->db->join('pegawai as pegawai5', 'pegawai5.id_pegawai = laporan_neraca.id_pegawai_1_skpd', 'left');
        $this->db->join('pegawai as pegawai6', 'pegawai6.id_pegawai = laporan_neraca.id_pegawai_2_skpd', 'left');
        $this->db->join('pegawai as pegawai7', 'pegawai7.id_pegawai = laporan_neraca.id_pegawai_3_skpd', 'left');
        $this->db->join('pegawai as pegawai8', 'pegawai8.id_pegawai = laporan_neraca.id_pegawai_4_skpd', 'left');
        $this->db->join('ref_skpd', 'ref_skpd.id_skpd = laporan_neraca.id_skpd', 'left');
        return $this->db->get('laporan_neraca')->result();
    }


    public function get_page($mulai, $hal, $filter = '')
    {
        // $this->db->offsett(0,6);
        if (in_array('keuangan', explode(';', $this->session->userdata('user_privileges')))) {
            $this->db->where('laporan_neraca.id_skpd', $this->session->userdata('id_skpd'));
        }
        if ($filter != '') {
            foreach ($filter as $key => $value) {
                $this->db->like($key, $value);
            }
        } else {
            $this->db->limit($hal, $mulai);
        }

        $this->db->order_by('id_laporan_neraca', 'desc');
        $this->db->select('* , laporan_neraca.status as status');
        $this->db->join('pegawai as pegawai1', 'pegawai1.id_pegawai = laporan_neraca.id_pegawai_1_bpkad', 'left');
        $this->db->join('pegawai as pegawai2', 'pegawai2.id_pegawai = laporan_neraca.id_pegawai_2_bpkad', 'left');
        $this->db->join('pegawai as pegawai3', 'pegawai3.id_pegawai = laporan_neraca.id_pegawai_3_bpkad', 'left');
        $this->db->join('pegawai as pegawai4', 'pegawai4.id_pegawai = laporan_neraca.id_pegawai_4_bpkad', 'left');
        $this->db->join('pegawai as pegawai5', 'pegawai5.id_pegawai = laporan_neraca.id_pegawai_1_skpd', 'left');
        $this->db->join('pegawai as pegawai6', 'pegawai6.id_pegawai = laporan_neraca.id_pegawai_2_skpd', 'left');
        $this->db->join('pegawai as pegawai7', 'pegawai7.id_pegawai = laporan_neraca.id_pegawai_3_skpd', 'left');
        $this->db->join('pegawai as pegawai8', 'pegawai8.id_pegawai = laporan_neraca.id_pegawai_4_skpd', 'left');
        $this->db->join('ref_skpd', 'ref_skpd.id_skpd = laporan_neraca.id_skpd', 'left');

        $query = $this->db->get('laporan_neraca');
        return $query->result();
    }

    public function get_all_ttd()
    {
        $this->db->group_start();
        $this->db->or_group_start();
        $this->db->where('id_pegawai_1_skpd', $this->session->userdata('id_pegawai'));
        $this->db->where('ttd_pegawai_1_skpd', 'belum');
        $this->db->where('ttd_pegawai_2_skpd', 'setuju');
        $this->db->group_end();
        $this->db->or_group_start();
        $this->db->where('id_pegawai_2_skpd', $this->session->userdata('id_pegawai'));
        $this->db->where('ttd_pegawai_2_skpd', 'belum');
        $this->db->where('ttd_pegawai_3_skpd', 'setuju');
        $this->db->group_end();
        $this->db->or_group_start();
        $this->db->where('id_pegawai_3_skpd', $this->session->userdata('id_pegawai'));
        $this->db->where('ttd_pegawai_3_skpd', 'belum');
        $this->db->group_end();
        $this->db->or_group_start();
        $this->db->where('id_pegawai_4_skpd', $this->session->userdata('id_pegawai'));
        $this->db->where('ttd_pegawai_4_skpd', 'belum');
        $this->db->group_end();
        $this->db->or_group_start();
        $this->db->where('id_pegawai_1_bpkad', $this->session->userdata('id_pegawai'));
        $this->db->where('ttd_pegawai_1_bpkad', 'belum');
        $this->db->where('ttd_pegawai_2_bpkad', 'setuju');
        $this->db->group_end();
        $this->db->or_group_start();
        $this->db->where('id_pegawai_2_bpkad', $this->session->userdata('id_pegawai'));
        $this->db->where('ttd_pegawai_2_bpkad', 'belum');
        $this->db->where('ttd_pegawai_3_bpkad', 'setuju');
        $this->db->group_end();
        $this->db->or_group_start();
        $this->db->where('id_pegawai_3_bpkad', $this->session->userdata('id_pegawai'));
        $this->db->where('ttd_pegawai_3_bpkad', 'belum');
        $this->db->where('status_verifikasi', 'setuju');
        $this->db->group_end();
        $this->db->or_group_start();
        $this->db->where('id_pegawai_4_bpkad', $this->session->userdata('id_pegawai'));
        $this->db->where('ttd_pegawai_4_bpkad', 'belum');
        $this->db->group_end();
        $this->db->group_end();
        $get = $this->get_all();
        return $get;
    }

    public function get_page_ttd($mulai, $hal, $filter = '')
    {
        $this->db->group_start();
        $this->db->or_group_start();
        $this->db->where('id_pegawai_1_skpd', $this->session->userdata('id_pegawai'));
        $this->db->where('ttd_pegawai_1_skpd', 'belum');
        $this->db->where('ttd_pegawai_2_skpd', 'setuju');
        $this->db->group_end();
        $this->db->or_group_start();
        $this->db->where('id_pegawai_2_skpd', $this->session->userdata('id_pegawai'));
        $this->db->where('ttd_pegawai_2_skpd', 'belum');
        $this->db->where('ttd_pegawai_3_skpd', 'setuju');
        $this->db->group_end();
        $this->db->or_group_start();
        $this->db->where('id_pegawai_3_skpd', $this->session->userdata('id_pegawai'));
        $this->db->where('ttd_pegawai_3_skpd', 'belum');
        $this->db->group_end();
        $this->db->or_group_start();
        $this->db->where('id_pegawai_4_skpd', $this->session->userdata('id_pegawai'));
        $this->db->where('ttd_pegawai_4_skpd', 'belum');
        $this->db->group_end();
        $this->db->or_group_start();
        $this->db->where('id_pegawai_1_bpkad', $this->session->userdata('id_pegawai'));
        $this->db->where('ttd_pegawai_1_bpkad', 'belum');
        $this->db->where('ttd_pegawai_2_bpkad', 'setuju');
        $this->db->group_end();
        $this->db->or_group_start();
        $this->db->where('id_pegawai_2_bpkad', $this->session->userdata('id_pegawai'));
        $this->db->where('ttd_pegawai_2_bpkad', 'belum');
        $this->db->where('ttd_pegawai_3_bpkad', 'setuju');
        $this->db->group_end();
        $this->db->or_group_start();
        $this->db->where('id_pegawai_3_bpkad', $this->session->userdata('id_pegawai'));
        $this->db->where('ttd_pegawai_3_bpkad', 'belum');
        $this->db->where('status_verifikasi', 'setuju');
        $this->db->group_end();
        $this->db->or_group_start();
        $this->db->where('id_pegawai_4_bpkad', $this->session->userdata('id_pegawai'));
        $this->db->where('ttd_pegawai_4_bpkad', 'belum');
        $this->db->group_end();
        $this->db->group_end();
        $get = $this->get_page($mulai, $hal, $filter);
        return $get;
    }



    public function get_by_id($id_laporan_neraca)
    {
        $this->db->select('* , laporan_neraca.status as status, 
                            pegawai1.nama_lengkap as nama_1_bpkad,pegawai1.jabatan as jabatan_1_bpkad,pegawai1.foto_pegawai as foto1,pegawai1.nip as nip1,
                            pegawai2.nama_lengkap as nama_2_bpkad,pegawai2.jabatan as jabatan_2_bpkad,pegawai2.foto_pegawai as foto2,pegawai2.nip as nip2,
                            pegawai3.nama_lengkap as nama_3_bpkad,pegawai3.jabatan as jabatan_3_bpkad,pegawai3.foto_pegawai as foto3,pegawai3.nip as nip3,
                            pegawai4.nama_lengkap as nama_4_bpkad,pegawai4.jabatan as jabatan_4_bpkad,pegawai4.foto_pegawai as foto4,pegawai4.nip as nip4,
                            pegawai5.nama_lengkap as nama_1_skpd,pegawai5.jabatan as jabatan_1_skpd,pegawai5.foto_pegawai as foto5,pegawai5.nip as nip5,
                            pegawai6.nama_lengkap as nama_2_skpd,pegawai6.jabatan as jabatan_2_skpd,pegawai6.foto_pegawai as foto6,pegawai6.nip as nip6,
                            pegawai7.nama_lengkap as nama_3_skpd,pegawai7.jabatan as jabatan_3_skpd,pegawai7.foto_pegawai as foto7,pegawai7.nip as nip7,
                            pegawai8.nama_lengkap as nama_4_skpd,pegawai8.jabatan as jabatan_4_skpd,pegawai8.foto_pegawai as foto8,pegawai8.nip as nip8,
                            ');
        $this->db->join('pegawai as pegawai1', 'pegawai1.id_pegawai = laporan_neraca.id_pegawai_1_bpkad', 'left');
        $this->db->join('pegawai as pegawai2', 'pegawai2.id_pegawai = laporan_neraca.id_pegawai_2_bpkad', 'left');
        $this->db->join('pegawai as pegawai3', 'pegawai3.id_pegawai = laporan_neraca.id_pegawai_3_bpkad', 'left');
        $this->db->join('pegawai as pegawai4', 'pegawai4.id_pegawai = laporan_neraca.id_pegawai_4_bpkad', 'left');
        $this->db->join('pegawai as pegawai5', 'pegawai5.id_pegawai = laporan_neraca.id_pegawai_1_skpd', 'left');
        $this->db->join('pegawai as pegawai6', 'pegawai6.id_pegawai = laporan_neraca.id_pegawai_2_skpd', 'left');
        $this->db->join('pegawai as pegawai7', 'pegawai7.id_pegawai = laporan_neraca.id_pegawai_3_skpd', 'left');
        $this->db->join('pegawai as pegawai8', 'pegawai8.id_pegawai = laporan_neraca.id_pegawai_4_skpd', 'left');
        $this->db->join('ref_skpd', 'ref_skpd.id_skpd = laporan_neraca.id_skpd', 'left');

        return $this->db->get_where('laporan_neraca', array('id_laporan_neraca' => $id_laporan_neraca))->row();
    }

    public function insert()
    {
        $this->db->set('id_skpd', $this->id_skpd);
        $this->db->set('tgl_periode', $this->tgl_periode);
        $this->db->set('tgl_pengesahan', $this->tgl_pengesahan);

        $this->db->set('asset_lancar_sekarang', $this->asset_lancar_sekarang);
        $this->db->set('asset_lancar_awal', $this->asset_lancar_awal);
        $this->db->set('asset_lancar_total', $this->asset_lancar_total);
        $this->db->set('kas_sekarang', $this->kas_sekarang);
        $this->db->set('kas_awal', $this->kas_awal);
        $this->db->set('kas_total', $this->kas_total);
        $this->db->set('persedian_sekarang', $this->persedian_sekarang);
        $this->db->set('persedian_awal', $this->persedian_awal);
        $this->db->set('persedian_total', $this->persedian_total);
        $this->db->set('dst1_text', $this->dst1_text);
        $this->db->set('dst1_sekarang', $this->dst1_sekarang);
        $this->db->set('dst1_awal', $this->dst1_awal);
        $this->db->set('dst1_total', $this->dst1_total);
        $this->db->set('dst2_text', $this->dst2_text);
        $this->db->set('dst2_sekarang', $this->dst2_sekarang);
        $this->db->set('dst2_awal', $this->dst2_awal);
        $this->db->set('dst2_total', $this->dst2_total);
        $this->db->set('dst3_text', $this->dst3_text);
        $this->db->set('dst3_sekarang', $this->dst3_sekarang);
        $this->db->set('dst3_awal', $this->dst3_awal);
        $this->db->set('dst3_total', $this->dst3_total);
        $this->db->set('dst4_text', $this->dst4_text);
        $this->db->set('dst4_sekarang', $this->dst4_sekarang);
        $this->db->set('dst4_awal', $this->dst4_awal);
        $this->db->set('dst4_total', $this->dst4_total);
        $this->db->set('dst5_text', $this->dst5_text);
        $this->db->set('dst5_sekarang', $this->dst5_sekarang);
        $this->db->set('dst5_awal', $this->dst5_awal);
        $this->db->set('dst5_total', $this->dst5_total);
        $this->db->set('dst6_text', $this->dst6_text);
        $this->db->set('dst6_sekarang', $this->dst6_sekarang);
        $this->db->set('dst6_awal', $this->dst6_awal);
        $this->db->set('dst6_total', $this->dst6_total);
        $this->db->set('dst7_text', $this->dst7_text);
        $this->db->set('dst7_sekarang', $this->dst7_sekarang);
        $this->db->set('dst7_awal', $this->dst7_awal);
        $this->db->set('dst7_total', $this->dst7_total);
        $this->db->set('dst8_text', $this->dst8_text);
        $this->db->set('dst8_sekarang', $this->dst8_sekarang);
        $this->db->set('dst8_awal', $this->dst8_awal);
        $this->db->set('dst8_total', $this->dst8_total);
        $this->db->set('investasi_jangkapanjang_sekarang', $this->investasi_jangkapanjang_sekarang);
        $this->db->set('investasi_jangkapanjang_awal', $this->investasi_jangkapanjang_awal);
        $this->db->set('investasi_jangkapanjang_total', $this->investasi_jangkapanjang_total);
        $this->db->set('asset_tetap_sekarang', $this->asset_tetap_sekarang);
        $this->db->set('asset_tetap_awal', $this->asset_tetap_awal);
        $this->db->set('asset_tetap_total', $this->asset_tetap_total);
        $this->db->set('tanah_sekarang', $this->tanah_sekarang);
        $this->db->set('tanah_awal', $this->tanah_awal);
        $this->db->set('tanah_total', $this->tanah_total);
        $this->db->set('peralatan_sekarang', $this->peralatan_sekarang);
        $this->db->set('peralatan_awal', $this->peralatan_awal);
        $this->db->set('peralatan_total', $this->peralatan_total);
        $this->db->set('gedung_sekarang', $this->gedung_sekarang);
        $this->db->set('gedung_awal', $this->gedung_awal);
        $this->db->set('gedung_total', $this->gedung_total);
        $this->db->set('jalan_sekarang', $this->jalan_sekarang);
        $this->db->set('jalan_awal', $this->jalan_awal);
        $this->db->set('jalan_total', $this->jalan_total);
        $this->db->set('asset_lainya_sekarang', $this->asset_lainya_sekarang);
        $this->db->set('asset_lainya_awal', $this->asset_lainya_awal);
        $this->db->set('asset_lainya_total', $this->asset_lainya_total);
        $this->db->set('kontruksi_sekarang', $this->kontruksi_sekarang);
        $this->db->set('kontruksi_awal', $this->kontruksi_awal);
        $this->db->set('kontruksi_total', $this->kontruksi_total);
        $this->db->set('akumulasi_sekarang', $this->akumulasi_sekarang);
        $this->db->set('akumulasi_awal', $this->akumulasi_awal);
        $this->db->set('akumulasi_total', $this->akumulasi_total);
        $this->db->set('asset_lain_sekarang', $this->asset_lain_sekarang);
        $this->db->set('asset_lain_awal', $this->asset_lain_awal);
        $this->db->set('asset_lain_total', $this->asset_lain_total);
        $this->db->set('total_asset_sekarang', $this->total_asset_sekarang);
        $this->db->set('total_asset_awal', $this->total_asset_awal);
        $this->db->set('total_asset', $this->total_asset);
        $this->db->set('total_kewajiban_sekarang', $this->total_kewajiban_sekarang);
        $this->db->set('total_kewajiban_awal', $this->total_kewajiban_awal);
        $this->db->set('total_kewajiban', $this->total_kewajiban);
        $this->db->set('kewajiban_pendek_sekarang', $this->kewajiban_pendek_sekarang);
        $this->db->set('kewajiban_pendek_awal', $this->kewajiban_pendek_awal);
        $this->db->set('kewajiban_pendek_total', $this->kewajiban_pendek_total);
        $this->db->set('kewajiban_panjang_sekarang', $this->kewajiban_panjang_sekarang);
        $this->db->set('kewajiban_panjang_awal', $this->kewajiban_panjang_awal);
        $this->db->set('kewajiban_panjang_total', $this->kewajiban_panjang_total);
        $this->db->set('ekuitas_sekarang', $this->ekuitas_sekarang);
        $this->db->set('ekuitas_awal', $this->ekuitas_awal);
        $this->db->set('ekuitas_total', $this->ekuitas_total);
        $this->db->set('total_neraca_sekarang', $this->total_neraca_sekarang);
        $this->db->set('total_neraca_awal', $this->total_neraca_awal);
        $this->db->set('total_neraca', $this->total_neraca);

        $this->db->set('id_pegawai_1_bpkad', $this->id_pegawai_1_bpkad);
        $this->db->set('id_pegawai_2_bpkad', $this->id_pegawai_2_bpkad);
        $this->db->set('id_pegawai_3_bpkad', $this->id_pegawai_3_bpkad);
        $this->db->set('id_pegawai_4_bpkad', $this->id_pegawai_4_bpkad);
        $this->db->set('id_pegawai_1_skpd', $this->id_pegawai_1_skpd);
        $this->db->set('id_pegawai_2_skpd', $this->id_pegawai_2_skpd);
        $this->db->set('id_pegawai_3_skpd', $this->id_pegawai_3_skpd);
        $this->db->set('id_pegawai_4_skpd', $this->id_pegawai_4_skpd);
        $this->db->set('ttd_pegawai_1_bpkad', $this->ttd_pegawai_1_bpkad);
        $this->db->set('ttd_pegawai_2_bpkad', $this->ttd_pegawai_2_bpkad);
        $this->db->set('ttd_pegawai_3_bpkad', $this->ttd_pegawai_3_bpkad);
        $this->db->set('ttd_pegawai_4_bpkad', $this->ttd_pegawai_4_bpkad);
        $this->db->set('ttd_pegawai_1_skpd', $this->ttd_pegawai_1_skpd);
        $this->db->set('ttd_pegawai_2_skpd', $this->ttd_pegawai_2_skpd);
        $this->db->set('ttd_pegawai_3_skpd', $this->ttd_pegawai_3_skpd);
        $this->db->set('ttd_pegawai_4_skpd', $this->ttd_pegawai_4_skpd);
        $this->db->set('file_draft', $this->file_draft);
        // $this->db->set('file_signed',$this->file_signed);
        $this->db->set('status', $this->status);
        $this->db->insert('laporan_neraca');
        return $this->db->insert_id();
    }

    public function update($id_laporan_neraca)
    {
        // $this->db->set('id_skpd', $this->id_skpd);
        $this->db->set('tgl_periode', $this->tgl_periode);
        $this->db->set('tgl_pengesahan', $this->tgl_pengesahan);

        $this->db->set('asset_lancar_sekarang', $this->asset_lancar_sekarang);
        $this->db->set('asset_lancar_awal', $this->asset_lancar_awal);
        $this->db->set('asset_lancar_total', $this->asset_lancar_total);
        $this->db->set('kas_sekarang', $this->kas_sekarang);
        $this->db->set('kas_awal', $this->kas_awal);
        $this->db->set('kas_total', $this->kas_total);
        $this->db->set('persedian_sekarang', $this->persedian_sekarang);
        $this->db->set('persedian_awal', $this->persedian_awal);
        $this->db->set('persedian_total', $this->persedian_total);
        $this->db->set('dst1_text', $this->dst1_text);
        $this->db->set('dst1_sekarang', $this->dst1_sekarang);
        $this->db->set('dst1_awal', $this->dst1_awal);
        $this->db->set('dst1_total', $this->dst1_total);
        $this->db->set('dst2_text', $this->dst2_text);
        $this->db->set('dst2_sekarang', $this->dst2_sekarang);
        $this->db->set('dst2_awal', $this->dst2_awal);
        $this->db->set('dst2_total', $this->dst2_total);
        $this->db->set('dst3_text', $this->dst3_text);
        $this->db->set('dst3_sekarang', $this->dst3_sekarang);
        $this->db->set('dst3_awal', $this->dst3_awal);
        $this->db->set('dst3_total', $this->dst3_total);
        $this->db->set('dst4_text', $this->dst4_text);
        $this->db->set('dst4_sekarang', $this->dst4_sekarang);
        $this->db->set('dst4_awal', $this->dst4_awal);
        $this->db->set('dst4_total', $this->dst4_total);
        $this->db->set('dst5_text', $this->dst5_text);
        $this->db->set('dst5_sekarang', $this->dst5_sekarang);
        $this->db->set('dst5_awal', $this->dst5_awal);
        $this->db->set('dst5_total', $this->dst5_total);
        $this->db->set('dst6_text', $this->dst6_text);
        $this->db->set('dst6_sekarang', $this->dst6_sekarang);
        $this->db->set('dst6_awal', $this->dst6_awal);
        $this->db->set('dst6_total', $this->dst6_total);
        $this->db->set('dst7_text', $this->dst7_text);
        $this->db->set('dst7_sekarang', $this->dst7_sekarang);
        $this->db->set('dst7_awal', $this->dst7_awal);
        $this->db->set('dst7_total', $this->dst7_total);
        $this->db->set('dst8_text', $this->dst8_text);
        $this->db->set('dst8_sekarang', $this->dst8_sekarang);
        $this->db->set('dst8_awal', $this->dst8_awal);
        $this->db->set('dst8_total', $this->dst8_total);
        $this->db->set('investasi_jangkapanjang_sekarang', $this->investasi_jangkapanjang_sekarang);
        $this->db->set('investasi_jangkapanjang_awal', $this->investasi_jangkapanjang_awal);
        $this->db->set('investasi_jangkapanjang_total', $this->investasi_jangkapanjang_total);
        $this->db->set('asset_tetap_sekarang', $this->asset_tetap_sekarang);
        $this->db->set('asset_tetap_awal', $this->asset_tetap_awal);
        $this->db->set('asset_tetap_total', $this->asset_tetap_total);
        $this->db->set('tanah_sekarang', $this->tanah_sekarang);
        $this->db->set('tanah_awal', $this->tanah_awal);
        $this->db->set('tanah_total', $this->tanah_total);
        $this->db->set('peralatan_sekarang', $this->peralatan_sekarang);
        $this->db->set('peralatan_awal', $this->peralatan_awal);
        $this->db->set('peralatan_total', $this->peralatan_total);
        $this->db->set('gedung_sekarang', $this->gedung_sekarang);
        $this->db->set('gedung_awal', $this->gedung_awal);
        $this->db->set('gedung_total', $this->gedung_total);
        $this->db->set('jalan_sekarang', $this->jalan_sekarang);
        $this->db->set('jalan_awal', $this->jalan_awal);
        $this->db->set('jalan_total', $this->jalan_total);
        $this->db->set('asset_lainya_sekarang', $this->asset_lainya_sekarang);
        $this->db->set('asset_lainya_awal', $this->asset_lainya_awal);
        $this->db->set('asset_lainya_total', $this->asset_lainya_total);
        $this->db->set('kontruksi_sekarang', $this->kontruksi_sekarang);
        $this->db->set('kontruksi_awal', $this->kontruksi_awal);
        $this->db->set('kontruksi_total', $this->kontruksi_total);
        $this->db->set('akumulasi_sekarang', $this->akumulasi_sekarang);
        $this->db->set('akumulasi_awal', $this->akumulasi_awal);
        $this->db->set('akumulasi_total', $this->akumulasi_total);
        $this->db->set('asset_lain_sekarang', $this->asset_lain_sekarang);
        $this->db->set('asset_lain_awal', $this->asset_lain_awal);
        $this->db->set('asset_lain_total', $this->asset_lain_total);
        $this->db->set('total_asset_sekarang', $this->total_asset_sekarang);
        $this->db->set('total_asset_awal', $this->total_asset_awal);
        $this->db->set('total_asset', $this->total_asset);
        $this->db->set('total_kewajiban_sekarang', $this->total_kewajiban_sekarang);
        $this->db->set('total_kewajiban_awal', $this->total_kewajiban_awal);
        $this->db->set('total_kewajiban', $this->total_kewajiban);
        $this->db->set('kewajiban_pendek_sekarang', $this->kewajiban_pendek_sekarang);
        $this->db->set('kewajiban_pendek_awal', $this->kewajiban_pendek_awal);
        $this->db->set('kewajiban_pendek_total', $this->kewajiban_pendek_total);
        $this->db->set('kewajiban_panjang_sekarang', $this->kewajiban_panjang_sekarang);
        $this->db->set('kewajiban_panjang_awal', $this->kewajiban_panjang_awal);
        $this->db->set('kewajiban_panjang_total', $this->kewajiban_panjang_total);
        $this->db->set('ekuitas_sekarang', $this->ekuitas_sekarang);
        $this->db->set('ekuitas_awal', $this->ekuitas_awal);
        $this->db->set('ekuitas_total', $this->ekuitas_total);
        $this->db->set('total_neraca_sekarang', $this->total_neraca_sekarang);
        $this->db->set('total_neraca_awal', $this->total_neraca_awal);
        $this->db->set('total_neraca', $this->total_neraca);

        $this->db->set('id_pegawai_1_bpkad', $this->id_pegawai_1_bpkad);
        $this->db->set('id_pegawai_2_bpkad', $this->id_pegawai_2_bpkad);
        $this->db->set('id_pegawai_3_bpkad', $this->id_pegawai_3_bpkad);
        $this->db->set('id_pegawai_4_bpkad', $this->id_pegawai_4_bpkad);
        $this->db->set('id_pegawai_1_skpd', $this->id_pegawai_1_skpd);
        $this->db->set('id_pegawai_2_skpd', $this->id_pegawai_2_skpd);
        $this->db->set('id_pegawai_3_skpd', $this->id_pegawai_3_skpd);
        $this->db->set('id_pegawai_4_skpd', $this->id_pegawai_4_skpd);
        $this->db->set('ttd_pegawai_1_bpkad', $this->ttd_pegawai_1_bpkad);
        $this->db->set('ttd_pegawai_2_bpkad', $this->ttd_pegawai_2_bpkad);
        $this->db->set('ttd_pegawai_3_bpkad', $this->ttd_pegawai_3_bpkad);
        $this->db->set('ttd_pegawai_4_bpkad', $this->ttd_pegawai_4_bpkad);
        $this->db->set('ttd_pegawai_1_skpd', $this->ttd_pegawai_1_skpd);
        $this->db->set('ttd_pegawai_2_skpd', $this->ttd_pegawai_2_skpd);
        $this->db->set('ttd_pegawai_3_skpd', $this->ttd_pegawai_3_skpd);
        $this->db->set('ttd_pegawai_4_skpd', $this->ttd_pegawai_4_skpd);
        $this->db->set('status_verifikasi', $this->status_verifikasi);
        $this->db->set('alasan_penolakan', $this->alasan_penolakan);
        if ($this->file_draft) $this->db->set('file_draft', $this->file_draft);
        $this->db->set('status', $this->status);
        $this->db->where('laporan_neraca.id_laporan_neraca', $id_laporan_neraca);
        return $this->db->update('laporan_neraca');
    }

    public function update_reset($id_laporan_neraca)
    {
        $this->db->set('ttd_pegawai_1_bpkad', $this->ttd_pegawai_1_bpkad);
        $this->db->set('ttd_pegawai_2_bpkad', $this->ttd_pegawai_2_bpkad);
        $this->db->set('ttd_pegawai_3_bpkad', $this->ttd_pegawai_3_bpkad);
        $this->db->set('ttd_pegawai_4_bpkad', $this->ttd_pegawai_4_bpkad);
        $this->db->set('ttd_pegawai_1_skpd', $this->ttd_pegawai_1_skpd);
        $this->db->set('ttd_pegawai_2_skpd', $this->ttd_pegawai_2_skpd);
        $this->db->set('ttd_pegawai_3_skpd', $this->ttd_pegawai_3_skpd);
        $this->db->set('ttd_pegawai_4_skpd', $this->ttd_pegawai_4_skpd);
        $this->db->set('status_verifikasi', $this->status_verifikasi);
        $this->db->set('alasan_penolakan', $this->alasan_penolakan);
        $this->db->set('status', $this->status);
        $this->db->where('laporan_neraca.id_laporan_neraca', $id_laporan_neraca);
        return $this->db->update('laporan_neraca');
    }



    public function delete($id)
    {
        return $this->db->delete('laporan_neraca', array('id_laporan_neraca' => $id));
    }


    public function get_last_id_by_skpd($id_skpd)
    {
        $this->db->select('id_laporan_neraca');
        $this->db->where('laporan_neraca.id_skpd', $id_skpd);
        $this->db->where('laporan_neraca.status', 'Selesai');
        $this->db->order_by('laporan_neraca.tgl_selesai', 'DESC');
        return @$this->db->get('laporan_neraca')->row()->id_laporan_neraca;
    }

    public function cek_status_tte($id_laporan_neraca)
    {
        return $this->db->get_where('laporan_neraca', array('id_laporan_neraca' => $id_laporan_neraca, 'status !=' => 'Selesai'))->num_rows();
    }
}