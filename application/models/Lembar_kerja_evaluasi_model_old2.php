<?php
class Lembar_kerja_evaluasi_model extends CI_Model
{
    public function get_indikator($jenis_lke, $level, $id_skpd = '')
    {
        $tahun = date('Y');
        $get = $this->db->get_where('lke_indikator', array('jenis_lke' => $jenis_lke, 'level' => $level, 'tahun' => $tahun))->result();
        foreach ($get as $k => $g) {
            $nilai = $this->get_nested_nilai($g->id_lke_indikator, $id_skpd);
            $get[$k]->nilai = $nilai;

            // update by khalid
            $nilai_koreksi = $this->get_nested_nilai($g->id_lke_indikator, $id_skpd, true);
            $get[$k]->nilai_koreksi = $nilai_koreksi;
            //end

            // var_dump();
            // die();
        }
        return $get;
    }


    public function get_indikator_filter($jenis_lke, $level, $tahun, $id_skpd = '')
    {
        $get = $this->db->get_where('lke_indikator', array('jenis_lke' => $jenis_lke, 'level' => $level, 'tahun' => $tahun))->result();
        foreach ($get as $k => $g) {
            $nilai = $this->get_nested_nilai($g->id_lke_indikator, $id_skpd);
            $nilai_koreksi = $this->get_nested_nilai($g->id_lke_indikator, $id_skpd, true);
            $get[$k]->nilai = $nilai;
            $get[$k]->nilai_koreksi = $nilai_koreksi;
        }
        return $get;
    }

    public function get_id_lke_indikator($id_pegawai, $id_lke)
    {
        $get = $this->db->query('select count(id) as id_pokja 
        from lke_pokja JOIN lke_indikator 
        ON lke_pokja.id_lke_indikator=lke_indikator.id_lke_indikator 
        where id_pegawai_ketua=' . $id_pegawai . ' AND lke_indikator.id_lke_indikator=' . $id_lke . '');
        return $get;
    }

    public function get_ketua_pokja_by_id_indikator($id_lke_ketua, $id_skpd)
    {
        $get = $this->db->query("select * 
        from lke_pokja 
        JOIN pegawai ON lke_pokja.id_pegawai_ketua=pegawai.id_pegawai
        where id_lke_indikator='.$id_lke_ketua.' AND lke_pokja.id_skpd='.$id_skpd.'");
        return $get;
    }


    public function get_pokja()
    {
        $get = $this->db->query('select id,  a.id_lke_indikator as id_lke_indikator, 
        a.id_pegawai_ketua, c.nama_indikator as nama_indikator, c.tahun as tahun, 
        c.jenis_lke as jenis, nama_pokja, d.nama_indikator as nama_induk, nama_lengkap 
        from lke_pokja a  
                JOIN pegawai b ON a.id_pegawai_ketua=b.id_pegawai  
                JOIN lke_indikator c ON a.id_lke_indikator=c.id_lke_indikator
                JOIN lke_indikator d ON c.id_induk=d.id_lke_indikator
        ORDER BY id DESC');
        return $get;
    }

    public function get_pokja_filter($tahun)
    {
        $get = $this->db->query('select id,  a.id_lke_indikator as id_lke_indikator, 
        a.id_pegawai_ketua, c.nama_indikator as nama_indikator, c.tahun as tahun, 
        c.jenis_lke as jenis, nama_pokja, d.nama_indikator as nama_induk, nama_lengkap 
        from lke_pokja a  
                JOIN pegawai b ON a.id_pegawai_ketua=b.id_pegawai  
                JOIN lke_indikator c ON a.id_lke_indikator=c.id_lke_indikator
                JOIN lke_indikator d ON c.id_induk=d.id_lke_indikator
        WHERE c.tahun=' . $tahun . ' 
        ORDER BY id DESC');
        return $get;
    }

    public function get_lke_indikator()
    {
        $get = $this->db->query('select a.id_lke_indikator as id_indikator, a.nama_indikator as nama_indikator, a.jenis_lke as jenis_lke, a.tahun as tahun,
         b.nama_indikator as nama_induk
         FROM lke_indikator a  
         JOIN lke_indikator b ON a.id_induk=b.id_lke_indikator
         WHERE a.level = 3');
        return $get;
    }

    public function get_lke_indikator_filter($tahun)
    {
        $get = $this->db->query('select a.id_lke_indikator as id_indikator, a.nama_indikator as nama_indikator, a.jenis_lke as jenis_lke, a.tahun as tahun,
        b.nama_indikator as nama_induk
        FROM lke_indikator a  
        JOIN lke_indikator b ON a.id_induk=b.id_lke_indikator
        WHERE a.level = 3 AND a.tahun=' . $tahun);
        return $get;
    }

    public function get_pegawai()
    {
        $get = $this->db->query('select * from pegawai');
        return $get;
    }

    public function skpd_ref()
    {
        $get = $this->db->query('select * from ref_skpd');
        return $get;
    }

    public function listing()
    {
        $this->db->select('*');
        $this->db->from('ref_skpd');
        $this->db->order_by('id_skpd', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    public function insert_indikator($data)
    {
        $this->db->insert('lke_indikator', $data);
        return $this->db->insert_id();
    }

    public function get_nested_nilai($id_lke_indikator, $id_skpd = '', $koreksi = false)
    {

        $select = $this->db->query("select id_lke_indikator, level, id_induk, nama_indikator, jenis_jawaban, bobot
                                    from (select * from lke_indikator order by id_induk, id_lke_indikator)
                                    products_sorted, 
                                    (select @pv := '" . $id_lke_indikator . "') initialisation
                                    where   (find_in_set(id_induk, @pv) and length(@pv := concat(@pv, ',', id_lke_indikator)))")
            ->result();

        // if ($id_lke_indikator == 346) {
        //     print_r($select);
        //     die;
        // }
        $nilai = 0;

        $detail_indikator = $this->db->get_where('lke_indikator', ['id_lke_indikator' => $id_lke_indikator])->row();

        if ($detail_indikator) {
            $bobot = $detail_indikator->bobot;
        } else {
            $bobot = 0;
        }

        foreach ($select as $s) {
            if ($koreksi) {
                $detail_jawaban = $this->get_detail_jawaban($s->id_lke_indikator, $s->jenis_jawaban, $id_skpd, true);
            } else {
                $detail_jawaban = $this->get_detail_jawaban($s->id_lke_indikator, $s->jenis_jawaban, $id_skpd);
            }
            if ($detail_indikator->level < 4) {
                $induk = $this->db->get_where('lke_indikator', ['id_lke_indikator' => $s->id_induk])->row();
                $child = $this->db->get_where('lke_indikator', ['id_induk' => $s->id_induk])->result();
                if ($induk) {
                    $bobot_induk = $induk->bobot;
                } else {
                    $bobot_induk = 0;
                }
                $plus_nilai = is_numeric($detail_jawaban['nilai']) ? $detail_jawaban['nilai'] : 0;
                $plus_nilai = ($plus_nilai / count($child)) * $bobot_induk;
            } else {

                $plus_nilai = is_numeric($detail_jawaban['nilai']) ? $detail_jawaban['nilai'] : 0;
            }
            $nilai += $plus_nilai;
        }

        if ($detail_indikator->level < 4) {
            $nilai = $nilai;
        } else {
            if ($bobot > 0) {
                $nilai = ($nilai / count($select)) * $bobot;
            } else {
                $nilai = 0;
            }
        }

        return round($nilai, 2);
        // return "$nilai / " . count($select) . " * $bobot";
    }

    public function get_indikator_by_induk($id_induk, $last = false, $id_skpd = '', $koreksi = false)
    {
        $get = $this->db->get_where('lke_indikator', array('id_induk' => $id_induk))->result();
        foreach ($get as $k => $j) {
            if ($last) {
                $detail_jawaban = $this->get_detail_jawaban($j->id_lke_indikator, $j->jenis_jawaban, $id_skpd);
                $get[$k]->jawaban = $detail_jawaban['jawaban'];
                $get[$k]->id_lke_jawaban = $detail_jawaban['id_lke_jawaban'];
                $get[$k]->nilai = $detail_jawaban['nilai'];
                if ($koreksi) {
                    $detail_jawaban_koreksi = $this->get_detail_jawaban($j->id_lke_indikator, $j->jenis_jawaban, $id_skpd, true);
                    $get[$k]->jawaban_koreksi = $detail_jawaban_koreksi['jawaban'];
                    $get[$k]->id_lke_jawaban_koreksi = $detail_jawaban_koreksi['id_lke_jawaban'];
                    $get[$k]->nilai_koreksi = $detail_jawaban_koreksi['nilai'];
                }
            } else {
                $nilai = $this->get_nested_nilai($j->id_lke_indikator, $id_skpd);
                $nilai_koreksi = $this->get_nested_nilai($j->id_lke_indikator, $id_skpd, true);
                $get[$k]->nilai = $nilai;
                $get[$k]->nilai_koreksi = $nilai_koreksi;
            }
        }
        return $get;
    }

    public function get_detail_jawaban($id_lke_indikator, $jenis_jawaban, $id_skpd = '', $koreksi = false)
    {
        if ($id_skpd == '') {
            $id_skpd = $this->session->userdata('id_skpd');
        }
        if ($koreksi) {
            $get_jawaban = $this->get_jawaban_koreksi($id_lke_indikator, $id_skpd);
        } else {
            $get_jawaban = $this->get_jawaban($id_lke_indikator, $id_skpd);
        }
        $id_lke_jawaban = 0;
        if (empty($get_jawaban)) {
            $jawaban = "Belum diisi";
            $nilai = "";
        } else {
            $nilai = 0;
            $id_lke_jawaban = $get_jawaban->id_lke_jawaban;
            if ($jenis_jawaban == 'multiple') {
                $get_pilihan = $this->get_pilihan_by_id($get_jawaban->jawaban);
                $jawaban = ($get_pilihan) ? $get_pilihan->penjelasan : '-';
                $nilai = $get_pilihan->bobot_jawaban;
            } else {
                $jawaban = $get_jawaban->jawaban;
                if ($jenis_jawaban == 'switch') {
                    if ($jawaban == 'Ya') {
                        $nilai = 1;
                    } elseif ($jawaban == 'Tidak') {
                        $nilai = 0;
                    }
                } elseif ($jenis_jawaban == "%") {
                    $nilai = $jawaban / 100;
                    $jawaban = $jawaban . "%";
                } elseif ($jenis_jawaban == "rupiah") {
                    $jawaban = rupiah(trim($jawaban));
                } elseif ($jenis_jawaban == "jumlah") {
                    $jawaban = number_format((int) trim($jawaban));
                }
            }
        }
        return array('jawaban' => $jawaban, 'id_lke_jawaban' => $id_lke_jawaban, 'nilai' => $nilai);
    }

    public function get_by_id($id_lke_indikator)
    {
        $get = $this->db->get_where('lke_indikator', array('id_lke_indikator' => $id_lke_indikator))->row();
        return $get;
    }

    function update_data($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }

    public function get_pilihan_by_id($id_lke_indikator_pilihan)
    {
        $get = $this->db->get_where('lke_indikator_pilihan', array('id_lke_indikator_pilihan' => $id_lke_indikator_pilihan))->row();
        return $get;
    }

    public function insert_pilihan($data)
    {
        $this->db->insert('lke_indikator_pilihan', $data);
        return $this->db->insert_id();
    }

    public function get_jawaban_indikator($id_lke_indikator)
    {
        $get = $this->db->get_where('lke_indikator_pilihan', array('id_lke_indikator' => $id_lke_indikator));
        return $get;
    }

    public function insert_jawaban($data)
    {
        $this->db->insert('lke_jawaban', $data);
        return $this->db->insert_id();
    }

    public function update_jawaban($data, $id_lke_jawaban)
    {
        return $this->db->update('lke_jawaban', $data, array('id_lke_jawaban' => $id_lke_jawaban));
    }

    public function insert_jawaban_koreksi($data)
    {
        $this->db->insert('lke_jawaban_koreksi', $data);
        return $this->db->insert_id();
    }

    public function get_jawaban($id_lke_indikator, $id_skpd, $id_induk = '')
    {

        $get = $this->db->get_where('lke_jawaban', array('id_lke_indikator' => $id_lke_indikator, 'id_skpd' => $id_skpd))->row();
        return $get;
    }

    public function get_jawaban_koreksi($id_lke_indikator, $id_skpd, $id_induk = '')
    {

        $get = $this->db->get_where('lke_jawaban_koreksi', array('id_lke_indikator' => $id_lke_indikator, 'id_skpd' => $id_skpd))->row();
        return $get;
    }

    public function get_jawaban_by_id($id_lke_jawaban)
    {
        $this->db->join('lke_indikator', 'lke_indikator.id_lke_indikator = lke_jawaban.id_lke_indikator');
        $get = $this->db->get_where('lke_jawaban', array('id_lke_jawaban' => $id_lke_jawaban))->row();
        return $get;
    }

    public function get_jawaban_koreksi_by_id($id_lke_jawaban)
    {
        $this->db->join('lke_indikator', 'lke_indikator.id_lke_indikator = lke_jawaban_koreksi.id_lke_indikator');
        $get = $this->db->get_where('lke_jawaban_koreksi', array('id_lke_jawaban' => $id_lke_jawaban))->row();
        return $get;
    }

    public function get_pegawai_ketua($id_lke_indikator, $id_skpd)
    {
        $this->db->where('id_lke_indikator', $id_lke_indikator);
        $this->db->where('lke_pokja.id_skpd', $id_skpd);
        $this->db->join('pegawai', 'pegawai.id_pegawai = lke_pokja.id_pegawai_ketua');
        $get = $this->db->get('lke_pokja')->row();
        return $get;
    }

    public function get_setting_waktu($jenis_pengisi, $tahun)
    {
        $this->db->where('jenis_pengisi', $jenis_pengisi);
        $this->db->where('tahun', $tahun);
        $get_setting_waktu = $this->db->get('lke_pengaturan')->row();
        return $get_setting_waktu;
    }
}
