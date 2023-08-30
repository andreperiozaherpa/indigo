<?php
class Peringkat_talent_model extends CI_Model
{
    public function get_all($rumpun = '', $eselon = '')
    {
        if ($rumpun !== '')
            $this->db->where('pegawai.rumpun', $rumpun);
        if ($eselon !== '')
            $this->db->where('pegawai.eselon', $eselon);
        $this->db->join('pegawai', 'pegawai.id_pegawai = pegawai_skor_talent.id_pegawai');
        $get = $this->db->get('pegawai_skor_talent')->result();
        return $get;
    }
    public function get_all_talent($rumpun = '', $eselon = '')
    {
        $nip_guru = array('197403171993031002', '197008101994032006', '197105151993072001', '196802101988032002', '196708011988031005', '196808071993071001', '197509302005011003', '196604101994031008', '196804021988032003', '196709011988031005', '196610101993031009', '197301161993032005', '196606111994121002', '196704061993071001', '197206261999031008', '196702241989032006', '196801121989022001', '196604161986032008', '196706041994032005', '197101011995081001', '196702152005012001', '197006041998022004', '196609181994032009', '196705181991031004', '196609031992122002', '197403031996032002', '197106281997022003', '196705101991032006', '197001012005012020', '196708131986101002', '196704051996031003', '197311151996032003', '196806142003121002', '196605081986032010', '196704072007012010', '196706151988031006', '197603242005011005', '196707151988031007', '198105212005011007', '196610011993071001', '196603021994032003', '196906261992012001', '197111221993072001', '196808181988032010', '196610261997032003');
        if ($rumpun !== '')
            $this->db->where('pegawai.rumpun', $rumpun);
        if ($eselon == "II.") {
            $this->db->like('pegawai.eselon', $eselon, 'after');
            $this->db->where_not_in('pegawai.nip', $nip_guru);
        } elseif ($eselon == "III.") {
            $this->db->group_start()->like('pegawai.eselon', 'III.', 'after')->or_where_in('pegawai.nip', $nip_guru)->group_end();
        } elseif ($eselon == "IV.") {
            $this->db->group_start()->or_not_like('pegawai.eselon', 'II.', 'both')->or_where('pegawai.eselon', null)->group_end();
            $this->db->where_not_in('pegawai.nip', $nip_guru);
        }
        $this->db->where('tahun', date('Y'));
        $this->db->where('pegawai.id_skpd !=', 73);
        $this->db->join('pegawai', 'pegawai.id_pegawai = pegawai_talent_simpeg.id_pegawai', 'left');
        $this->db->join('ref_skpd', 'pegawai.id_skpd = ref_skpd.id_skpd', 'left');
        $get = $this->db->get('pegawai_talent_simpeg')->result();
        return $get;
    }
    public function get_by_id_pegawai($id_pegawai)
    {
        $get = $this->db->get_where('pegawai_skor_talent', array('id_pegawai' => $id_pegawai))->row();
        return $get;
    }

    public function get_all2($jenis_jabatan, $jabatan = '', $rumpun = '')
    {
        if ($rumpun !== '')
            $this->db->where('pegawai.rumpun', $rumpun);
        if ($jabatan !== '')
            $this->db->where('pegawai_skor_talent2.jabatan', $jabatan);
        $this->db->where('pegawai_skor_talent2.jenis_jabatan', $jenis_jabatan);
        $this->db->join('pegawai', 'pegawai.id_pegawai = pegawai_skor_talent2.id_pegawai');
        $this->db->select('pegawai.*,pegawai_skor_talent2.*');
        $get = $this->db->get('pegawai_skor_talent2')->result();
        return $get;
    }
    public function get_by_id_pegawai2($id_pegawai)
    {
        $get = $this->db->get_where('pegawai_skor_talent2', array('id_pegawai' => $id_pegawai))->row();
        return $get;
    }
    public function get_jabatan($jenis_jabatan)
    {
        $this->db->where('pegawai_skor_talent2.jenis_jabatan', $jenis_jabatan);
        $this->db->group_by('jabatan');
        $get = $this->db->get('pegawai_skor_talent2')->result();
        return $get;
    }
    public function get_rumpun($jenis_jabatan)
    {
        $this->db->where('pegawai_skor_talent2.jenis_jabatan', $jenis_jabatan);
        $this->db->join('pegawai', 'pegawai.id_pegawai = pegawai_skor_talent2.id_pegawai');
        $this->db->group_by('rumpun');
        $get = $this->db->get('pegawai_skor_talent2')->result();
        return $get;
    }

    public function get_k_peer($nip)
    {

        $this->db->order_by('nama_lengkap');
        $pegawai = $this->db->get_where('pegawai', array('nip' => $nip, 'pensiun' => 0))->result();

        $bulan = date('m', strtotime('-1 month'));
        $tahun = date('Y', strtotime('-1 month'));

        $this->db->where('MONTH(pr_penilai.tanggal_isi) >=', $bulan);
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
        return @$pegawai[@$k];
    }

    public function get_k_peer_maksiti($nip)
    {

        $this->db->order_by('nama_lengkap');
        $pegawai = $this->db->get_where('pegawai', array('nip' => $nip, 'pensiun' => 0))->result();

        $bulan = (date('n') == 1) ? 12 : date('n', strtotime('-1 month'));
        $tahun = (date('n') == 1) ? date('Y', strtotime('-1 year')) : date('Y');


        foreach ($pegawai as $k => $p) {

            $this->db->where('ekinerja_skp.id_pegawai', $pegawai[$k]->id_pegawai);
            $this->db->where('ekinerja_perilaku_rekap.bulan <=', $bulan);
            $this->db->where('ekinerja_skp.tahun_desc', $tahun);
            $this->db->join('ekinerja_skp', 'ekinerja_skp.id_skp = ekinerja_perilaku_rekap.id_skp', 'left');
            $penilai = $this->db->get('ekinerja_perilaku_rekap')->result();
            $pegawai[$k]->total_nilai = 0;
            $pegawai[$k]->array_penilai = array();
            $pegawai[$k]->total_pertanyaan = 0;
            foreach ($penilai as $lo) {
                $pegawai[$k]->total_nilai += $lo->hasil;
                $pegawai[$k]->total_pertanyaan += 1;
            }
        }
        return @$pegawai[@$k];
    }

    public function get_k_tpp($id_pegawai)
    {
        $datemin = 202108;
        // MENGAMBIL 1 TAHUN SEBELUMNYA
        $datenow = date("Ym", strtotime("-1 year"));
        $datefix = ($datenow > $datemin) ? $datenow : $datemin;
        // MENGAMBIL 1 BULAN SEBELUMNYA
        $selisih = date("Ym", strtotime("-1 month")) - $datefix;
        $bulan = (int) substr($datefix, -2);
        $tahun = substr($datefix, 0, 4);
        $count = 1;

        $total_persen = 0;
        while (true) {
            $pegawai = $this->db->get_where('pegawai_posisi', ['id_pegawai' => $id_pegawai, 'bulan' => $bulan, 'tahun' => $tahun])->row();
            if ($pegawai) {
                $tpp = $pegawai->tpp;
                $grade = $pegawai->grade;

                $this->db->select('sum(nominal_potongan) as jml_potongan');
                $this->db->group_by('id_pegawai');
                $potongan = $this->db->get_where('tpp_log', array('id_pegawai' => $id_pegawai, 'bulan' => $bulan, 'tahun' => $tahun))->row();

                $persentase[] = ($tpp > 0) ? ($tpp - @$potongan->jml_potongan) / $tpp * 100 : 0;
                $total_persen = array_sum($persentase);
            }

            if ($bulan == 12) {
                $bulan = 1;
                $tahun++;
            } else {
                $bulan++;
            }
            if ($bulan == date("m") and $tahun == date("Y")) {
                break;
            }
            $count++;
        }
        return round(@$total_persen / $count, 2);
    }

    public function get_k_rating($id_pegawai)
    {

        $bulan = date('Y-m', strtotime('-1 month'));
        // $tahun = date('Y',strtotime('-1 month'));

        $this->db->select('rating');
        $this->db->where('laporan_kerja_harian.tanggal >=', $bulan);
        // $this->db->where('MONTH(laporan_kerja_harian.tanggal) >=', $bulan);
        // $this->db->where('YEAR(laporan_kerja_harian.tanggal) >=', $tahun);
        $this->db->where('laporan_kerja_harian.id_pegawai', $id_pegawai);
        $this->db->join('laporan_kerja_harian', 'laporan_kerja_harian.id_laporan_kerja_harian = laporan_kerja_harian_rating.id_laporan_kerja_harian', 'left');
        $get = $this->db->get('laporan_kerja_harian_rating')->result();

        $no = 0;
        $jumlah_rating = 0;
        foreach ($get as $key => $value) {
            $jumlah_rating += $value->rating;
            $no++;
        }

        if ($id_pegawai == 77) {
            $jumlah_rating = 5;
            $no = 1;
        }

        return ($no > 0) ? $jumlah_rating / $no : $no;
    }
}