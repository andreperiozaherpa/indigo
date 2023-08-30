<?php
class Survey_kepuasan_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->db_dprd = $this->load->database('dprd', TRUE);
    }
    public function get_pertanyaan()
    {
        $get = $this->db_dprd->get('survey_kepuasan_pertanyaan')->result();
        return $get;
    }
    public function get_pertanyaan_array()
    {
        $get = $this->db_dprd->get('survey_kepuasan_pertanyaan')->result_array();
        return $get;
    }
    public function get_pilihan($id_survey_kepuasan_pertanyaan)
    {
        $this->db_dprd->where('id_survey_kepuasan_pertanyaan', $id_survey_kepuasan_pertanyaan);
        $get = $this->db_dprd->get('survey_kepuasan_pilihan')->result();
        return $get;
    }
    public function check_pengisian($id_unit_kerja, $triwulan, $tahun, $id_pegawai)
    {
        $this->db_dprd->where('id_unit_kerja_dinilai', $id_unit_kerja);
        $this->db_dprd->where('triwulan', $triwulan);
        $this->db_dprd->where('tahun', $tahun);
        $this->db_dprd->where('id_pegawai_pengisi', $id_pegawai);
        $get = $this->db_dprd->get('survey_kepuasan')->num_rows();
        if ($get > 0) {
            return true;
        } else {
            return false;
        }
    }
    public function get_pengisian($id_unit_kerja, $triwulan, $tahun, $id_pegawai)
    {
        $this->db_dprd->where('id_unit_kerja_dinilai', $id_unit_kerja);
        $this->db_dprd->where('triwulan', $triwulan);
        $this->db_dprd->where('tahun', $tahun);
        $this->db_dprd->where('id_pegawai_pengisi', $id_pegawai);
        $get = $this->db_dprd->get('survey_kepuasan')->row();
        return $get;
    }
    public function insert($data)
    {
        $this->db_dprd->set('waktu_isi', date('Y-m-d H:i:s'));
        $this->db_dprd->insert('survey_kepuasan', $data);
        return $this->db_dprd->insert_id();
    }
    public function insert_jawaban($data)
    {
        $this->db_dprd->insert('survey_kepuasan_jawaban', $data);
        return $this->db_dprd->insert_id();
    }

    public function get_skor($id_unit_kerja, $triwulan, $tahun)
    {
        $this->db_dprd->where('id_unit_kerja_dinilai', $id_unit_kerja);
        $this->db_dprd->where('triwulan', $triwulan);
        $this->db_dprd->where('tahun', $tahun);
        $this->db_dprd->join('survey_kepuasan', 'survey_kepuasan.id_survey_kepuasan = survey_kepuasan_jawaban.id_survey_kepuasan');
        $this->db_dprd->join('survey_kepuasan_pilihan', 'survey_kepuasan_pilihan.id_survey_kepuasan_pilihan = survey_kepuasan_jawaban.jawaban');
        $get = $this->db_dprd->get('survey_kepuasan_jawaban')->result();

        $skor = 0;
        $nilai = 0;
        if (!empty($get)) {
            foreach ($get as $g) {
                $nilai += $g->nilai;
            }
            $skor = round($nilai / count($get), 2);
        }
        return $skor;
    }
}
