<?php
class Laporan_kinerja_harian_model extends CI_Model
{
    public function getRatingDesc()
    {
        return array(
            1 => 'Kecewa',
            2 => 'Tidak Puas',
            3 => 'Cukup Puas',
            4 => 'Puas',
            5 => 'Sangat Puas'
        );
    }
    public function insert($data)
    {

        if (isset($data['automated'])) {
            if ($data['automated'] == 1) {
                $update_where = array(
                    'id_pegawai' => $data['id_pegawai'],
                    'id_skpd' => $data['id_skpd'],
                    'tanggal' => $data['tanggal'],
                    'rincian_kegiatan' => $data['rincian_kegiatan'],
                    'automated' => 1
                );
                $lkh = $this->db->get_where('laporan_kerja_harian', $update_where)->row();
                if ($lkh) {
                    $this->db->update('laporan_kerja_harian', $data, $update_where);
                    return $lkh->id_laporan_kerja_harian;
                }
            }
        }
        $this->db->insert('laporan_kerja_harian', $data);
        return $this->db->insert_id();
    }
    public function insert_log($data, $id_laporan_kerja_harian)
    {

        $in = array(
            'id_laporan_kerja_harian' => $id_laporan_kerja_harian,
            'rincian_kegiatan' => $data['rincian_kegiatan'],
            'hasil_kegiatan' => $data['hasil_kegiatan'],
            'lampiran' => isset($data['lampiran']) ? $data['lampiran'] : NULL,
            'status_verifikasi' => $data['status_verifikasi']
        );
        if (isset($data['alasan_penolakan'])) {
            $in['alasan_penolakan'] = $data['alasan_penolakan'];
        }
        $this->db->insert('laporan_kerja_harian_log', $in);
        return $this->db->insert_id();
    }

    public function update($data, $id_laporan_kerja_harian)
    {
        $this->db->update('laporan_kerja_harian', $data, array('id_laporan_kerja_harian' => $id_laporan_kerja_harian));

        $lkh = $this->db->where("id_laporan_kerja_harian",$id_laporan_kerja_harian)->get("ekinerja_lkh")->row();
        $this->load->model("kinerja/Lkh_model");
        $this->Lkh_model->updateCapaian($lkh->id_renaksi_detail);

        return true;
    }
    public function delete($id_laporan_kerja_harian)
    {
        // Kinerja > LKH

        
        $lkh = $this->db->where("id_laporan_kerja_harian",$id_laporan_kerja_harian)->get("ekinerja_lkh")->row();
        

        $this->db->where("id_laporan_kerja_harian",$id_laporan_kerja_harian)->delete("ekinerja_lkh");

        $this->db->delete('laporan_kerja_harian', array('id_laporan_kerja_harian' => $id_laporan_kerja_harian));

        $this->load->model("kinerja/Lkh_model");
        $this->Lkh_model->updateCapaian($lkh->id_renaksi_detail);

        return true;
    }
    public function delete_where($where)
    {
        return $this->db->delete('laporan_kerja_harian', $where);
    }
    public function get_by_id($id_laporan_kerja_harian)
    {
        $this->db->join("pegawai p1", "p1.id_pegawai =laporan_kerja_harian.id_pegawai", "left");
        $this->db->join("pegawai p2", "p2.id_pegawai =laporan_kerja_harian.id_verifikator", "left");
        $this->db->select("laporan_kerja_harian.*,p1.*,p1.nama_lengkap as 'nama_pegawai' , p2.nama_lengkap as 'nama_verifikator' ");
        return $this->db->get_where('laporan_kerja_harian', array('id_laporan_kerja_harian' => $id_laporan_kerja_harian))->row();
    }
    public function get_log($id_laporan_kerja_harian, $status = '')
    {
        $this->db->where('id_laporan_kerja_harian', $id_laporan_kerja_harian);
        if ($status != '') {
            $this->db->where('status_verifikasi', $status);
        }
        return $this->db->get('laporan_kerja_harian_log')->result();
    }
    public function get_by_pegawai($id_pegawai, $android = false, $where = '')
    {
        if (!empty($where)) {
            foreach ($where as $field => $value) {
                if (!empty($value)) {
                    if ($field == 'awal') {
                        $this->db->where("laporan_kerja_harian.tanggal >= ", $value);
                    } elseif ($field == 'akhir') {
                        $this->db->where("laporan_kerja_harian.tanggal <= ", $value);
                    } else {
                        $this->db->where($field, $value);
                    }
                }
            }
        }

        $this->db->join("pegawai p1", "p1.id_pegawai =laporan_kerja_harian.id_pegawai", "left");
        $this->db->join("pegawai p2", "p2.id_pegawai =laporan_kerja_harian.id_verifikator", "left");
        $this->db->join("laporan_kerja_harian_rating rating", "rating.id_laporan_kerja_harian =laporan_kerja_harian.id_laporan_kerja_harian", "left");


        $case_status = "CASE status_verifikasi
                            WHEN 'sudah_diverifikasi' THEN 'Sudah Diverifikasi'
                            WHEN 'belum_diverifikasi' THEN 'Belum Diverifikasi'
                            WHEN 'ditolak' THEN 'Ditolak'
                            ELSE '-'
                        END as 'status'
        ";

        $download_lampiran = "CONCAT('" . base_url() . "','data/kegiatan_personal/',laporan_kerja_harian.id_pegawai,'/',laporan_kerja_harian.lampiran) as 'download_lampiran' ";

        /* $this->db->select("*, DATE_FORMAT(tanggal,'%d %b') as 'short_date',
        laporan_kerja_harian.id_laporan_kerja_harian as 'id_laporan_kerja_harian',
         DATE_FORMAT(tanggal,'%d %M %Y') as 'long_date', $case_status,
         p1.nama_lengkap as 'nama_pegawai' , p2.nama_lengkap as 'nama_verifikator', $download_lampiran "); */

        $this->db->select("laporan_kerja_harian.*,rating.*, DATE_FORMAT(tanggal,'%d %b') as 'short_date',
         laporan_kerja_harian.id_laporan_kerja_harian as 'id_laporan_kerja_harian',
          DATE_FORMAT(tanggal,'%d %M %Y') as 'long_date', $case_status,
          p1.nama_lengkap as 'nama_pegawai' , p2.nama_lengkap as 'nama_verifikator', $download_lampiran ");

        if ($android == true) {
            $today = date("Y-m-d");
            $tanggal = date('Y-m-d', strtotime($today . ' - 30 day'));
            $this->db->where("laporan_kerja_harian.tanggal >= ", $tanggal);
        }

        $this->db->order_by("laporan_kerja_harian.id_laporan_kerja_harian", "desc");
        if ($this->session->userdata('level') != 'Administrator') {
            $this->db->where('laporan_kerja_harian.id_pegawai', $id_pegawai);
        }
        return $this->db->get('laporan_kerja_harian')->result();
    }
    public function get_verifikasi_by_pegawai($id_pegawai, $android = false, $where = '')
    {
        if (!empty($where)) {
            foreach ($where as $field => $value) {
                if (!empty($value)) {
                    if ($field == 'awal') {
                        $this->db->where("laporan_kerja_harian.tanggal >= ", $value);
                    } elseif ($field == 'akhir') {
                        $this->db->where("laporan_kerja_harian.tanggal <= ", $value);
                    } elseif ($field == 'nama_pegawai') {
                        $this->db->like('p1.nama_lengkap', $value);
                    } else {
                        $this->db->where($field, $value);
                    }
                }
            }
        }

        $this->db->join("pegawai p1", "p1.id_pegawai =laporan_kerja_harian.id_pegawai", "left");
        $this->db->join("pegawai p2", "p2.id_pegawai =laporan_kerja_harian.id_verifikator", "left");
        $this->db->join("laporan_kerja_harian_rating rating", "rating.id_laporan_kerja_harian =laporan_kerja_harian.id_laporan_kerja_harian", "left");

        $case_status = "CASE status_verifikasi
                            WHEN 'sudah_diverifikasi' THEN 'Sudah Diverifikasi'
                            WHEN 'belum_diverifikasi' THEN 'Belum Diverifikasi'
                            WHEN 'ditolak' THEN 'Ditolak'
                            ELSE '-'
                        END as 'status'
        ";

        $download_lampiran = "CONCAT('" . base_url() . "','data/kegiatan_personal/',laporan_kerja_harian.id_pegawai,'/',laporan_kerja_harian.lampiran) as 'download_lampiran' ";

        $this->db->select("laporan_kerja_harian.*,rating.*, DATE_FORMAT(tanggal,'%d %b') as 'short_date',
        laporan_kerja_harian.id_laporan_kerja_harian as 'id_laporan_kerja_harian',
         DATE_FORMAT(tanggal,'%d %M %Y') as 'long_date', $case_status,
         p1.nama_lengkap as 'nama_pegawai' , p2.nama_lengkap as 'nama_verifikator', $download_lampiran ");

        if ($android == true) {
            $today = date("Y-m-d");
            $tanggal = date('Y-m-d', strtotime($today . ' - 14 day'));
            $this->db->where("laporan_kerja_harian.tanggal >= ", $tanggal);
        }


        $this->db->order_by("laporan_kerja_harian.id_laporan_kerja_harian", "desc");

        if ($this->session->userdata('level') != 'Administrator') {
            $this->db->where('laporan_kerja_harian.id_verifikator', $id_pegawai);
        }

        
        return $this->db->get('laporan_kerja_harian')->result();
    }
    public function get_by_skpd($id_skpd)
    {
        return $this->db->get_where('laporan_kerja_harian', array('id_skpd' => $id_skpd))->result();
    }
    public function get_rekap($id_pegawai, $bulan = '', $tahun = '')
    {
        $this->db->order_by("tanggal", "asc");
        $this->db->where('id_pegawai', $id_pegawai);
        if (!empty($bulan)) {
            $this->db->where('MONTH(tanggal)', $bulan, false);
        }
        if (!empty($tahun)) {
            $this->db->where('YEAR(tanggal)', $tahun, false);
        }
        $this->db->where('status_verifikasi', 'sudah_diverifikasi');
        return $this->db->get('laporan_kerja_harian')->result();
    }

    public function get_all_pegawai($id_skpd = '', $bulan = '', $tahun = '')
    {
        if ($bulan == 8 && $tahun == 2021) {
            return $this->db->query("SELECT p.*, IFNULL(lkh.jumlah_lkh,0) as jumlah_lkh,
            IF(lama.id_jabatan IS NULL, sekarang.id_jabatan, lama.id_jabatan) as id_jabatan_pencairan,
            IF(lama.id_jabatan IS NULL, sekarang.nama_jabatan, lama.nama_jabatan) as nama_jabatan_pencairan,
            IF(lama.id_jabatan IS NULL, sekarang.id_skpd, lama.id_skpd) as id_skpd_pencairan
                        FROM pegawai as p
                        LEFT JOIN (
                        SELECT id_pegawai , count(DISTINCT tanggal) AS jumlah_lkh FROM laporan_kerja_harian
                        WHERE MONTH(tanggal) = $bulan
                        AND YEAR(tanggal) = $tahun
                        AND status_verifikasi = 'sudah_diverifikasi'
                        GROUP  BY id_pegawai
                        ) as lkh ON lkh.id_pegawai = p.id_pegawai
                                    LEFT JOIN ref_jabatan_baru as sekarang ON sekarang.id_jabatan = p.id_jabatan
                                    LEFT JOIN ref_jabatan_baru as lama ON lama.id_jabatan = p.id_jabatan_lama
                        WHERE p.pensiun = 0
                                    GROUP BY p.id_pegawai
                                    HAVING id_skpd_pencairan = $id_skpd
                        ORDER  BY p.nama_lengkap")->result();
        } else {
            if ($id_skpd != '') {
                if ($id_skpd == 21 || $id_skpd == 10 || $id_skpd == 8 || $id_skpd == 11 || $id_skpd == 17) {
                    $s_where = "INNER JOIN ref_skpd ON ref_skpd.id_skpd = p.id_skpd WHERE (p.id_skpd = $id_skpd OR ref_skpd.id_skpd_induk = $id_skpd) AND pegawai.pensiun = 0 AND p.bulan = $bulan AND p.tahun = $tahun";
                }else{

                    $s_where = "WHERE p.id_skpd = $id_skpd AND pegawai.pensiun = 0 AND p.bulan = $bulan AND p.tahun = $tahun";
                }
            } else {
                $s_where = "WHERE pegawai.pensiun = 0 AND p.bulan = $bulan AND p.tahun = $tahun";
            }
            return $this->db->query(
                "SELECT pegawai.*, IFNULL(lkh.jumlah_lkh,0) as jumlah_lkh
            FROM pegawai_posisi as p
            LEFT JOIN (
            SELECT id_pegawai , count(DISTINCT tanggal) AS jumlah_lkh FROM laporan_kerja_harian
            WHERE MONTH(tanggal) = $bulan
            AND YEAR(tanggal) = $tahun
            AND status_verifikasi = 'sudah_diverifikasi'
            GROUP  BY id_pegawai
            ) as lkh ON lkh.id_pegawai = p.id_pegawai
            INNER JOIN pegawai ON pegawai.id_pegawai = p.id_pegawai
            $s_where
            ORDER  BY pegawai.nama_lengkap"
            )->result();
        }
    }


    public function get_single_pegawai($id_pegawai = '', $bulan = '', $tahun = '')
    {
        if ($id_pegawai != '') {
            $s_where = "WHERE p.id_pegawai = $id_pegawai AND p.pensiun = 0";
        } else {
            $s_where = "WHERE p.pensiun = 0";
        }
        return $this->db->query(
            "SELECT p.*, IFNULL(lkh.jumlah_lkh,0) as jumlah_lkh
            FROM pegawai as p
            LEFT JOIN (
            SELECT id_pegawai , count(DISTINCT tanggal) AS jumlah_lkh FROM laporan_kerja_harian
            WHERE MONTH(tanggal) = $bulan
            AND YEAR(tanggal) = $tahun
            AND status_verifikasi = 'sudah_diverifikasi'
            GROUP  BY id_pegawai
            ) as lkh ON lkh.id_pegawai = p.id_pegawai
            $s_where
            ORDER  BY p.nama_lengkap"
        )->row();
    }

    public function hitung_ulang_tpp($id_pegawai, $bulan, $tahun)
    {
        $bulan = (int) $bulan;
        if ($bulan <= (date('m') - 1 ) && $tahun == date('Y')) {
            $this->load->model('tpp/tpp_model');
            $this->load->model('tpp/tpp_perhitungan_model');
            $this->load->model('ref_hari_kerja_efektif_model');
            $lkh_p = $this->get_single_pegawai($id_pegawai, $bulan, $tahun);
            // return $lkh_p;

            $efektif = $this->ref_hari_kerja_efektif_model->get_by_bulan($bulan);
            if ($lkh_p->jumlah_lkh == 0 || $efektif == 0) {
                $persentase = 0;
            } else {
                $persentase = round(($lkh_p->jumlah_lkh / $efektif) * 100, 2);
            }
            $tpp = $this->tpp_perhitungan_model->get_tpp($id_pegawai);
            $param = array('id_ket_log' => 'L1', 'persentase' => $persentase, 'bulan' => $bulan, 'tahun' => $tahun, 'id_pegawai' => $id_pegawai, 'tpp' => $tpp);
            $save = $this->tpp_model->simpan($param);
            return $save;
        }
    }
}
