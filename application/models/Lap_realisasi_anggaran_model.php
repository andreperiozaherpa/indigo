<?php
defined('BASEPATH') or exit('No direct script access allowed');

class lap_realisasi_anggaran_model extends CI_Model
{

    public $id_laporan_realisasi_anggaran;
    public $id_skpd;
    public $tgl_periode;
    public $tgl_pengesahan;

    //
    public $total_pendapatan;
    public $belanja_operasi;
    public  $belanja_pegawai;
    public $beban_operasi;
    public $belanja_barang_jasa;
    public $belanja_bunga;
    public $belanja_hibah;
    public $belanja_bantuan_sosial;
    public $jumlah_belanja_operasi;
    public $belanja_modal;
    public $belanja_m_tanah;
    public $belanja_m_peralatan_mesin;
    public $belanja_m_gedung_bangunan;
    public $belanja_m_jalan;
    public $belanja_m_aset_tetap;
    public $belanja_m_aset_lainya;
    public $jumlah_modal_belanja;
    public $belanja_tak_terduga;
    public $transfer;
    public $total_belanja_transfer;
    public $surplus;
    //

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
    public $file_signed_draft;
    public $status;


    public function get_all()
    {
        if (in_array('keuangan', explode(';', $this->session->userdata('user_privileges')))) {
            $this->db->where('laporan_realisasi_anggaran.id_skpd',$this->session->userdata('id_skpd'));
        }
        $this->db->order_by('id_laporan_realisasi_anggaran', 'desc');
        $this->db->join('pegawai as pegawai1', 'pegawai1.id_pegawai = laporan_realisasi_anggaran.id_pegawai_1_bpkad', 'left');
        $this->db->join('pegawai as pegawai2', 'pegawai2.id_pegawai = laporan_realisasi_anggaran.id_pegawai_2_bpkad', 'left');
        $this->db->join('pegawai as pegawai3', 'pegawai3.id_pegawai = laporan_realisasi_anggaran.id_pegawai_3_bpkad', 'left');
        $this->db->join('pegawai as pegawai4', 'pegawai4.id_pegawai = laporan_realisasi_anggaran.id_pegawai_4_bpkad', 'left');
        $this->db->join('pegawai as pegawai5', 'pegawai5.id_pegawai = laporan_realisasi_anggaran.id_pegawai_1_skpd', 'left');
        $this->db->join('pegawai as pegawai6', 'pegawai6.id_pegawai = laporan_realisasi_anggaran.id_pegawai_2_skpd', 'left');
        $this->db->join('pegawai as pegawai7', 'pegawai7.id_pegawai = laporan_realisasi_anggaran.id_pegawai_3_skpd', 'left');
        $this->db->join('pegawai as pegawai8', 'pegawai8.id_pegawai = laporan_realisasi_anggaran.id_pegawai_4_skpd', 'left');
        $this->db->join('ref_skpd', 'ref_skpd.id_skpd = laporan_realisasi_anggaran.id_skpd', 'left');
        return $this->db->get('laporan_realisasi_anggaran')->result();
    }


    public function get_page($mulai, $hal, $filter = '')
    {
        // $this->db->offsett(0,6);
        if (in_array('keuangan', explode(';', $this->session->userdata('user_privileges')))) {
            $this->db->where('laporan_realisasi_anggaran.id_skpd',$this->session->userdata('id_skpd'));
        }
        if ($filter != '') {
            foreach ($filter as $key => $value) {
                $this->db->like($key, $value);
            }
        } else {
            $this->db->limit($hal, $mulai);
        }

        $this->db->order_by('id_laporan_realisasi_anggaran', 'desc');
        $this->db->select('* , laporan_realisasi_anggaran.status as status');
        $this->db->join('pegawai as pegawai1', 'pegawai1.id_pegawai = laporan_realisasi_anggaran.id_pegawai_1_bpkad', 'left');
        $this->db->join('pegawai as pegawai2', 'pegawai2.id_pegawai = laporan_realisasi_anggaran.id_pegawai_2_bpkad', 'left');
        $this->db->join('pegawai as pegawai3', 'pegawai3.id_pegawai = laporan_realisasi_anggaran.id_pegawai_3_bpkad', 'left');
        $this->db->join('pegawai as pegawai4', 'pegawai4.id_pegawai = laporan_realisasi_anggaran.id_pegawai_4_bpkad', 'left');
        $this->db->join('pegawai as pegawai5', 'pegawai5.id_pegawai = laporan_realisasi_anggaran.id_pegawai_1_skpd', 'left');
        $this->db->join('pegawai as pegawai6', 'pegawai6.id_pegawai = laporan_realisasi_anggaran.id_pegawai_2_skpd', 'left');
        $this->db->join('pegawai as pegawai7', 'pegawai7.id_pegawai = laporan_realisasi_anggaran.id_pegawai_3_skpd', 'left');
        $this->db->join('pegawai as pegawai8', 'pegawai8.id_pegawai = laporan_realisasi_anggaran.id_pegawai_4_skpd', 'left');
        $this->db->join('ref_skpd', 'ref_skpd.id_skpd = laporan_realisasi_anggaran.id_skpd', 'left');

        $query = $this->db->get('laporan_realisasi_anggaran');
        return $query->result();
    }

    public function get_all_ttd()
    {
        $this->db->group_start();
        $this->db->or_group_start();
            $this->db->where('id_pegawai_1_skpd',$this->session->userdata('id_pegawai'));
            $this->db->where('ttd_pegawai_1_skpd','belum');
            $this->db->where('ttd_pegawai_2_skpd','setuju');
        $this->db->group_end();
        $this->db->or_group_start();
            $this->db->where('id_pegawai_2_skpd',$this->session->userdata('id_pegawai'));
            $this->db->where('ttd_pegawai_2_skpd','belum');
        $this->db->group_end();
        $this->db->or_group_start();
            $this->db->where('id_pegawai_3_skpd',$this->session->userdata('id_pegawai'));
            $this->db->where('ttd_pegawai_3_skpd','belum');
        $this->db->group_end();
        $this->db->or_group_start();
            $this->db->where('id_pegawai_4_skpd',$this->session->userdata('id_pegawai'));
            $this->db->where('ttd_pegawai_4_skpd','belum');
        $this->db->group_end();
        $this->db->or_group_start();
            $this->db->where('id_pegawai_1_bpkad',$this->session->userdata('id_pegawai'));
            $this->db->where('ttd_pegawai_1_bpkad','belum');
            $this->db->where('ttd_pegawai_2_bpkad','setuju');
        $this->db->group_end();
        $this->db->or_group_start();
            $this->db->where('id_pegawai_2_bpkad',$this->session->userdata('id_pegawai'));
            $this->db->where('ttd_pegawai_2_bpkad','belum');
            $this->db->where('status_verifikasi','setuju');
        $this->db->group_end();
        $this->db->or_group_start();
            $this->db->where('id_pegawai_3_bpkad',$this->session->userdata('id_pegawai'));
            $this->db->where('ttd_pegawai_3_bpkad','belum');
        $this->db->group_end();
        $this->db->or_group_start();
            $this->db->where('id_pegawai_4_bpkad',$this->session->userdata('id_pegawai'));
            $this->db->where('ttd_pegawai_4_bpkad','belum');
        $this->db->group_end();
        $this->db->group_end();
        $get = $this->get_all();
        return $get;
    }

    public function get_page_ttd($mulai, $hal, $filter = '')
    {
        $this->db->group_start();
        $this->db->or_group_start();
            $this->db->where('id_pegawai_1_skpd',$this->session->userdata('id_pegawai'));
            $this->db->where('ttd_pegawai_1_skpd','belum');
            $this->db->where('ttd_pegawai_2_skpd','setuju');
        $this->db->group_end();
        $this->db->or_group_start();
            $this->db->where('id_pegawai_2_skpd',$this->session->userdata('id_pegawai'));
            $this->db->where('ttd_pegawai_2_skpd','belum');
        $this->db->group_end();
        $this->db->or_group_start();
            $this->db->where('id_pegawai_3_skpd',$this->session->userdata('id_pegawai'));
            $this->db->where('ttd_pegawai_3_skpd','belum');
        $this->db->group_end();
        $this->db->or_group_start();
            $this->db->where('id_pegawai_4_skpd',$this->session->userdata('id_pegawai'));
            $this->db->where('ttd_pegawai_4_skpd','belum');
        $this->db->group_end();
        $this->db->or_group_start();
            $this->db->where('id_pegawai_1_bpkad',$this->session->userdata('id_pegawai'));
            $this->db->where('ttd_pegawai_1_bpkad','belum');
            $this->db->where('ttd_pegawai_2_bpkad','setuju');
        $this->db->group_end();
        $this->db->or_group_start();
            $this->db->where('id_pegawai_2_bpkad',$this->session->userdata('id_pegawai'));
            $this->db->where('ttd_pegawai_2_bpkad','belum');
            $this->db->where('status_verifikasi','setuju');
        $this->db->group_end();
        $this->db->or_group_start();
            $this->db->where('id_pegawai_3_bpkad',$this->session->userdata('id_pegawai'));
            $this->db->where('ttd_pegawai_3_bpkad','belum');
        $this->db->group_end();
        $this->db->or_group_start();
            $this->db->where('id_pegawai_4_bpkad',$this->session->userdata('id_pegawai'));
            $this->db->where('ttd_pegawai_4_bpkad','belum');
        $this->db->group_end();
        $this->db->group_end();
        $get = $this->get_page($mulai, $hal, $filter);
        return $get;
    }



    public function get_by_id($id_laporan_realisasi_anggaran)
    {
        $this->db->select('* , laporan_realisasi_anggaran.status as status, 
                            pegawai1.nama_lengkap as nama_1_bpkad,pegawai1.jabatan as jabatan_1_bpkad,pegawai1.foto_pegawai as foto1,pegawai1.nip as nip1,
                            pegawai2.nama_lengkap as nama_2_bpkad,pegawai2.jabatan as jabatan_2_bpkad,pegawai2.foto_pegawai as foto2,pegawai2.nip as nip2,
                            pegawai3.nama_lengkap as nama_3_bpkad,pegawai3.jabatan as jabatan_3_bpkad,pegawai3.foto_pegawai as foto3,pegawai3.nip as nip3,
                            pegawai4.nama_lengkap as nama_4_bpkad,pegawai4.jabatan as jabatan_4_bpkad,pegawai4.foto_pegawai as foto4,pegawai4.nip as nip4,
                            pegawai5.nama_lengkap as nama_1_skpd,pegawai5.jabatan as jabatan_1_skpd,pegawai5.foto_pegawai as foto5,pegawai5.nip as nip5,
                            pegawai6.nama_lengkap as nama_2_skpd,pegawai6.jabatan as jabatan_2_skpd,pegawai6.foto_pegawai as foto6,pegawai6.nip as nip6,
                            pegawai7.nama_lengkap as nama_3_skpd,pegawai7.jabatan as jabatan_3_skpd,pegawai7.foto_pegawai as foto7,pegawai7.nip as nip7,
                            pegawai8.nama_lengkap as nama_4_skpd,pegawai8.jabatan as jabatan_4_skpd,pegawai8.foto_pegawai as foto8,pegawai8.nip as nip8,
                            ');
        $this->db->join('pegawai as pegawai1', 'pegawai1.id_pegawai = laporan_realisasi_anggaran.id_pegawai_1_bpkad', 'left');
        $this->db->join('pegawai as pegawai2', 'pegawai2.id_pegawai = laporan_realisasi_anggaran.id_pegawai_2_bpkad', 'left');
        $this->db->join('pegawai as pegawai3', 'pegawai3.id_pegawai = laporan_realisasi_anggaran.id_pegawai_3_bpkad', 'left');
        $this->db->join('pegawai as pegawai4', 'pegawai4.id_pegawai = laporan_realisasi_anggaran.id_pegawai_4_bpkad', 'left');
        $this->db->join('pegawai as pegawai5', 'pegawai5.id_pegawai = laporan_realisasi_anggaran.id_pegawai_1_skpd', 'left');
        $this->db->join('pegawai as pegawai6', 'pegawai6.id_pegawai = laporan_realisasi_anggaran.id_pegawai_2_skpd', 'left');
        $this->db->join('pegawai as pegawai7', 'pegawai7.id_pegawai = laporan_realisasi_anggaran.id_pegawai_3_skpd', 'left');
        $this->db->join('pegawai as pegawai8', 'pegawai8.id_pegawai = laporan_realisasi_anggaran.id_pegawai_4_skpd', 'left');
        $this->db->join('ref_skpd', 'ref_skpd.id_skpd = laporan_realisasi_anggaran.id_skpd', 'left');

        return $this->db->get_where('laporan_realisasi_anggaran', array('id_laporan_realisasi_anggaran' => $id_laporan_realisasi_anggaran))->row();
    }

    public function insert()
    {
        $this->db->set('id_skpd', $this->id_skpd);
        $this->db->set('tgl_periode', $this->tgl_periode);
        $this->db->set('tgl_pengesahan', $this->tgl_pengesahan);

        //
        $this->db->set('pendapatan_asli', $this->pendapatan_asli);
        $this->db->set('pendapatan_transfer', $this->pendapatan_transfer);
        $this->db->set('pendapatan_lain', $this->pendapatan_lain);
        $this->db->set('total_pendapatan', $this->total_pendapatan);
        $this->db->set('belanja_operasi', $this->belanja_operasi);
        $this->db->set('belanja_pegawai', $this->belanja_pegawai);
        $this->db->set('belanja_barang_jasa', $this->belanja_barang_jasa);
        $this->db->set('belanja_bunga', $this->belanja_bunga);
        $this->db->set('belanja_hibah', $this->belanja_hibah);
        $this->db->set('belanja_bantuan_sosial', $this->belanja_bantuan_sosial);
        $this->db->set('jumlah_belanja_operasi', $this->jumlah_belanja_operasi);
        $this->db->set('belanja_modal', $this->belanja_modal);
        $this->db->set('belanja_m_tanah', $this->belanja_m_tanah);
        $this->db->set('belanja_m_peralatan_mesin', $this->belanja_m_peralatan_mesin);
        $this->db->set('belanja_m_gedung_bangunan', $this->belanja_m_gedung_bangunan);
        $this->db->set('belanja_m_jalan', $this->belanja_m_jalan);
        $this->db->set('belanja_m_aset_tetap', $this->belanja_m_aset_tetap);
        $this->db->set('belanja_m_aset_lainya', $this->belanja_m_aset_lainya);
        $this->db->set('jumlah_modal_belanja', $this->jumlah_modal_belanja);
        $this->db->set('belanja_tak_terduga', $this->belanja_tak_terduga);
        $this->db->set('transfer', $this->transfer);
        $this->db->set('total_belanja_transfer', $this->total_belanja_transfer);
        $this->db->set('surplus', $this->surplus);
        $this->db->set('penerimaan_pembiayaan', $this->penerimaan_pembiayaan);
        $this->db->set('pengeluaran_pembiayaan', $this->pengeluaran_pembiayaan);
        $this->db->set('pembiayaan_bersih', $this->pembiayaan_bersih);
        //

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
        $this->db->set('file_draft',$this->file_draft);
        //$this->db->set('file_signed',$this->file_signed);
        $this->db->set('status', $this->status);
        $this->db->insert('laporan_realisasi_anggaran');
        return $this->db->insert_id();
    }

    public function update($id_laporan_realisasi_anggaran)
    {
        // $this->db->set('id_skpd', $this->id_skpd);
        $this->db->set('tgl_periode', $this->tgl_periode);
        $this->db->set('tgl_pengesahan', $this->tgl_pengesahan);
        //
        $this->db->set('pendapatan_asli', $this->pendapatan_asli);
        $this->db->set('pendapatan_transfer', $this->pendapatan_transfer);
        $this->db->set('pendapatan_lain', $this->pendapatan_lain);
        $this->db->set('total_pendapatan', $this->total_pendapatan);
        $this->db->set('belanja_operasi', $this->belanja_operasi);
        $this->db->set('belanja_pegawai', $this->belanja_pegawai);
        $this->db->set('belanja_barang_jasa', $this->belanja_barang_jasa);
        $this->db->set('belanja_bunga', $this->belanja_bunga);
        $this->db->set('belanja_hibah', $this->belanja_hibah);
        $this->db->set('belanja_bantuan_sosial', $this->belanja_bantuan_sosial);
        $this->db->set('jumlah_belanja_operasi', $this->jumlah_belanja_operasi);
        $this->db->set('belanja_modal', $this->belanja_modal);
        $this->db->set('belanja_m_tanah', $this->belanja_m_tanah);
        $this->db->set('belanja_m_peralatan_mesin', $this->belanja_m_peralatan_mesin);
        $this->db->set('belanja_m_gedung_bangunan', $this->belanja_m_gedung_bangunan);
        $this->db->set('belanja_m_jalan', $this->belanja_m_jalan);
        $this->db->set('belanja_m_aset_tetap', $this->belanja_m_aset_tetap);
        $this->db->set('belanja_m_aset_lainya', $this->belanja_m_aset_lainya);
        $this->db->set('jumlah_modal_belanja', $this->jumlah_modal_belanja);
        $this->db->set('belanja_tak_terduga', $this->belanja_tak_terduga);
        $this->db->set('transfer', $this->transfer);
        $this->db->set('total_belanja_transfer', $this->total_belanja_transfer);
        $this->db->set('surplus', $this->surplus);
        $this->db->set('penerimaan_pembiayaan', $this->penerimaan_pembiayaan);
        $this->db->set('pengeluaran_pembiayaan', $this->pengeluaran_pembiayaan);
        $this->db->set('pembiayaan_bersih', $this->pembiayaan_bersih);
        //
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
        $this->db->set('status_verifikasi',$this->status_verifikasi);
        $this->db->set('alasan_penolakan',$this->alasan_penolakan);
        if ($this->file_draft) $this->db->set('file_draft',$this->file_draft);
        $this->db->set('status',$this->status);
        $this->db->where('laporan_realisasi_anggaran.id_laporan_realisasi_anggaran', $id_laporan_realisasi_anggaran);
        return $this->db->update('laporan_realisasi_anggaran');
    }


    public function update_reset($id_laporan_realisasi_anggaran)
    {
        $this->db->set('ttd_pegawai_1_bpkad', $this->ttd_pegawai_1_bpkad);
        $this->db->set('ttd_pegawai_2_bpkad', $this->ttd_pegawai_2_bpkad);
        $this->db->set('ttd_pegawai_3_bpkad', $this->ttd_pegawai_3_bpkad);
        $this->db->set('ttd_pegawai_4_bpkad', $this->ttd_pegawai_4_bpkad);
        $this->db->set('ttd_pegawai_1_skpd', $this->ttd_pegawai_1_skpd);
        $this->db->set('ttd_pegawai_2_skpd', $this->ttd_pegawai_2_skpd);
        $this->db->set('ttd_pegawai_3_skpd', $this->ttd_pegawai_3_skpd);
        $this->db->set('ttd_pegawai_4_skpd', $this->ttd_pegawai_4_skpd);
        $this->db->set('status_verifikasi',$this->status_verifikasi);
        $this->db->set('alasan_penolakan',$this->alasan_penolakan);
        $this->db->set('status',$this->status);
        $this->db->where('laporan_realisasi_anggaran.id_laporan_realisasi_anggaran', $id_laporan_realisasi_anggaran);
        return $this->db->update('laporan_realisasi_anggaran');
    }


    public function delete($id)
    {
        return $this->db->delete('laporan_realisasi_anggaran', array('id_laporan_realisasi_anggaran' => $id));
    }


    public function get_last_id_by_skpd($id_skpd)
    {
        $this->db->select('id_laporan_realisasi_anggaran');
        $this->db->where('laporan_realisasi_anggaran.id_skpd',$id_skpd);
        $this->db->where('laporan_realisasi_anggaran.status','Selesai');
        $this->db->order_by('laporan_realisasi_anggaran.tgl_selesai','DESC');
        return @$this->db->get('laporan_realisasi_anggaran')->row()->id_laporan_realisasi_anggaran;
    }

    public function cek_status_tte($id_laporan_realisasi_anggaran)
    {
        return $this->db->get_where('laporan_realisasi_anggaran', array('id_laporan_realisasi_anggaran' => $id_laporan_realisasi_anggaran, 'status !=' => 'Selesai'))->num_rows();
    }
}