<?php


class Surat_klasifikasi_model extends CI_Model
{

    public function get_all_where($where, $like, $page)
    {
        if (!empty($where)) {
            $this->db->where($where);
        }

        if (!empty($like)) {
            $this->db->like($like);
        }

        $this->db->limit('20', $page);
        return $this->db->get('surat_klasifikasi')->result();
    }

    public function get_single_where($where)
    {
        $result = $this->db->get_where('surat_klasifikasi', $where)->row();

        return $result;
    }

    public function get_all_json($like, $page)
    {
        if (!empty($like)) {
            $this->db->like('nama_klasifikasi', $like);
            $this->db->or_like('kode_gabungan', $like);
        }
        
        $this->db->limit('20', ($page-1) * 20);
        $this->db->order_by('kode_gabungan ASC', 'nama_klasifisikasi ASC');
        $result = $this->db->get('surat_klasifikasi')->result();

        if ($result > 0) {
            foreach ($result as $res) {
                $res->id    = $res->id_surat_klasifikasi;
                $res->text  = $res->nama_klasifikasi;
            }
        }

        return $result;
    }

    public function get_single_json($id)
    {
        $this->db->order_by('kode_gabungan ASC', 'nama_klasifisikasi ASC');
        $result = $this->db->get_where('surat_klasifikasi', array('id_surat_klasifikasi' => $id))->row();

        if (!empty($result)) {
            $result->id     = $result->id_surat_klasifikasi;
            $result->text   = $result->nama_klasifikasi;
        }

        return $result;
    }

    public function get_total_rows($like)
    {
        if (!empty($like)) {
            $this->db->like('nama_klasifikasi', $like);
            $this->db->or_like('kode_gabungan', $like);
            $this->db->from('surat_klasifikasi');
            return $this->db->count_all_results();
        } else {
            return $this->db->count_all_results('surat_klasifikasi');
        }
    }

    public function get_retention($code)
    {
        return $this->db->get_where('surat_klasifikasi', array('id_surat_klasifikasi' => $code))->row();
    }
}
