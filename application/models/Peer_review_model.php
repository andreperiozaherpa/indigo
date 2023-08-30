<?php
class Peer_Review_model extends CI_Model
{
    public function get_instrumen($jenis_pegawai = '')
    {
        if ($jenis_pegawai !== '') {
            if ($jenis_pegawai == 'staff') {
                $this->db->where('id_pr_instrumen !=', 5);
            }
        }
        return $this->db->get_where('pr_instrumen')->result();
    }

    public function get_indikator($id_pr_instrumen)
    {
        return $this->db->get_where('pr_indikator', array('id_pr_instrumen' => $id_pr_instrumen))->result();
    }

    public function get_pertanyaan($id_pr_indikator)
    {
        return $this->db->get_where('pr_pertanyaan', array('id_pr_indikator' => $id_pr_indikator))->result();
    }

    // public function get_menilai($id_pegawai, $id_skpd, $id_atasan, $bulan, $tahun)
    public function get_menilai($id_pegawai, $id_skpd, $bulan, $tahun)
    {

        // get atasan single row
        // $atasan = $this->db->get_where('pegawai', array('id_pegawai' => $id_atasan))->result();

        // $this->db->limit(10);
        $this->db->where('id_skpd', $id_skpd);
        $pegawai = $this->db->get_where('pegawai', array('pensiun' => 0))->result();

        $penilaian = array();

        // // $lompat = rand(1,999);
        $lompat = $bulan + $tahun; // 2025
        $row = count($pegawai); // 16
        if ($lompat % $row == 0) {
            $lompat += $bulan;
            $lompat += 3;
            // $lompat += 2;
        }
        // echo $lompat;
        foreach ($pegawai as $key => $p) {

            $list_penilai = array();

            // for ($i = 1; $i <= 3; $i++) {
            for ($i = 1; $i <= 4; $i++) {
                $p_key = $key + $lompat * $i % $row;
                if (empty($pegawai[$p_key])) {
                    $p_key = $p_key - $row;
                }
                $penilai = $pegawai[$p_key];
                $list_penilai[] = $penilai;
            }

            if ($p->id_pegawai == $id_pegawai) {
                $penilaian = $list_penilai;
            }

        }





        // $penilaian = array_merge($penilaian, $atasan);

        $history = $this->get_history_penilaian($id_pegawai, $bulan, $tahun);
        $pegawai_history = array();

        foreach ($history as $h) {
            $pegawai_history[] = $h->id_pegawai;
        }

        foreach ($penilaian as $kpen => $pen) {
            if (in_array($pen->id_pegawai, $pegawai_history)) {
                unset($penilaian[$kpen]);
            }
        }

        $result = array_merge($history, $penilaian);
        $result = array_slice($result, 0, 4);

        // list inject
        $list_inject = ['2253', '3119', '10753', '10553'];
        if ($bulan == 12 && $tahun == 2022 && in_array($id_pegawai, $list_inject)) {
            $this->db->or_where('id_pegawai', 667);
            $this->db->or_where('id_pegawai', 1120);
            $rr = $this->db->get('pegawai')->result();
            foreach ($rr as $r) {
                $result[] = $r;
            }
        } else  if ($bulan == 1 && $tahun == 2023 && in_array($id_pegawai, $list_inject)) {
            $this->db->or_where('id_pegawai', 667);
            $rr = $this->db->get('pegawai')->result();
            foreach ($rr as $r) {
                $result[] = $r;
            }
        } else  if ($bulan == 2 && $tahun == 2023 && in_array($id_pegawai, $list_inject)) {
            $this->db->or_where('id_pegawai', 667);
            $rr = $this->db->get('pegawai')->result();
            foreach ($rr as $r) {
                $result[] = $r;
            }
        } else  if ($bulan == 3 && $tahun == 2023 && in_array($id_pegawai, $list_inject)) {
            $this->db->or_where('id_pegawai', 667);
            $rr = $this->db->get('pegawai')->result();
            foreach ($rr as $r) {
                $result[] = $r;
            }
        }

        return $result;
    }

    public function get_history_penilaian($id_pegawai_penilai, $bulan, $tahun)
    {
        $this->db->join('pegawai', 'pegawai.id_pegawai = pr_penilai.id_pegawai');
        $list = $this->db->get_where('pr_penilai', array('id_pegawai_penilai' => $id_pegawai_penilai, 'bulan' => $bulan, 'tahun' => $tahun))->result();
        return $list;
    }

    public function get_penilai($id_pegawai, $id_pegawai_penilai, $bulan, $tahun)
    {
        $get = $this->db->get_where('pr_penilai', array('id_pegawai' => $id_pegawai, 'id_pegawai_penilai' => $id_pegawai_penilai, 'bulan' => $bulan, 'tahun' => $tahun))->row();
        if ($get) {
            $get->jawaban = $this->db->get_where('pr_penilai_detail', array('id_pr_penilai' => $get->id_pr_penilai))->result();
            return $get;
        } else {
            return false;
        }
    }

    public function insert_penilai($data)
    {
        $in = $this->db->insert('pr_penilai', $data);
        return $this->db->insert_id();
    }

    public function insert_penilai_detail($data, $id_pr_penilai)
    {
        $this->db->set('id_pr_penilai', $id_pr_penilai);
        $in = $this->db->insert('pr_penilai_detail', $data);
        return $this->db->insert_id();
    }

    public function get_jawaban($id_pr_penilai, $id_pr_indikator)
    {
        $this->db->join('pr_pertanyaan', 'pr_pertanyaan.id_pr_pertanyaan = pr_penilai_detail.id_pr_pertanyaan');
        $get = $this->db->get_where('pr_penilai_detail', array('id_pr_penilai' => $id_pr_penilai, 'id_pr_indikator' => $id_pr_indikator))->result();
        return $get;
    }

    public function get_list_pegawai($id_skpd, $bulan, $tahun)
    {

        $this->db->order_by('nama_lengkap');
        $pegawai = $this->db->get_where('pegawai', array('id_skpd' => $id_skpd, 'pensiun' => 0))->result();


        $this->db->where('MONTH(pr_penilai.tanggal_isi)', $bulan);
        $this->db->where('YEAR(pr_penilai.tanggal_isi)', $tahun);
        $this->db->join('pr_penilai', 'pr_penilai.id_pr_penilai = pr_penilai_detail.id_pr_penilai');
        $penilai = $this->db->get('pr_penilai_detail')->result();


        foreach ($pegawai as $k => $p) {
            $pegawai[$k]->total_nilai = 0;
            $pegawai[$k]->array_penilai = array();
            $pegawai[$k]->total_pertanyaan = 0;
            foreach ($penilai as $lo) {
                if ($lo->id_pegawai == $p->id_pegawai) {
                    if (!in_array($lo->id_pegawai_penilai, $pegawai[$k]->array_penilai)) {
                        $pegawai[$k]->array_penilai[] = $lo->id_pegawai_penilai;
                    }
                    $pegawai[$k]->total_nilai += $lo->jawaban;
                    $pegawai[$k]->total_pertanyaan += 1;
                }
            }
        }
        return $pegawai;
    }
}