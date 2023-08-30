<?php
class Lembar_kerja_evaluasi_model extends CI_Model
{
    public function get_indikator($jenis_lke, $level, $id_skpd = '')
    {
        $get = $this->db->get_where('lke_indikator', array('jenis_lke' => $jenis_lke, 'level' => $level))->result();
        foreach ($get as $k => $g) {
            $nilai = $this->get_nested_nilai($g->id_lke_indikator, $id_skpd);
            $get[$k]->nilai = $nilai;
        }
        return $get;
    }
    public function insert_indikator($data)
    {
        $this->db->insert('lke_indikator', $data);
        return $this->db->insert_id();
    }

    public function get_nested_nilai($id_lke_indikator, $id_skpd = '', $koreksi = false)
    {

        $select = $this->db->query("select id_lke_indikator,
        level,
        id_induk,
        nama_indikator,
        jenis_jawaban
        from    (select * from lke_indikator
                order by id_induk, id_lke_indikator) products_sorted,
                (select @pv := '" . $id_lke_indikator . "') initialisation
        where   (find_in_set(id_induk, @pv) and length(@pv := concat(@pv, ',', id_lke_indikator)))")->result();
        $nilai = 0;
        foreach ($select as $s) {
            if ($koreksi) {
                $detail_jawaban = $this->get_detail_jawaban($s->id_lke_indikator, $s->jenis_jawaban, $id_skpd, true);
            } else {
                $detail_jawaban = $this->get_detail_jawaban($s->id_lke_indikator, $s->jenis_jawaban, $id_skpd);
            }
            $nilai += $detail_jawaban['nilai'];
        }
        return $nilai;
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
                $get[$k]->nilai = $nilai;
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
                    $jawaban = number_format((int) trim( $jawaban));
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
    public function update_jawaban($data,$id_lke_jawaban)
    {
        return $this->db->update('lke_jawaban', $data,array('id_lke_jawaban'=>$id_lke_jawaban));
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
}
