<?php


class Surat_berkas_detail_model extends CI_Model {

    public $id_surat_berkas_detail,
            $id_surat_berkas,
            $id_surat_masuk,
            $id_surat_keluar,
            $created_date,
            $updated_date,
            $deleted_date;

    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set("Asia/Jakarta");
    }

    public function get_all_where($where = null, $table)
    {
        if (!empty($where)) {
            $this->db->where($where);
        }

        $results    = $this->db->get($table)->result();

        if (!empty($results) && $table == "surat_berkas_keluar") {
            foreach ($results as $result) {
                $this->db->select('id_surat_keluar as id_surat, jenis_surat, nomer_surat, tgl_buat as tanggal_surat, perihal, file_ttd as file');
                $result->surat              = $this->db->get_where('surat_keluar', array('id_surat_keluar' => $result->id_surat_keluar))->row();
                $result->surat->tipe        = "keluar";
                $result->surat->tanggal_surat = tanggal_hari($result->surat->tanggal_surat);
            }
        } else if (!empty($result) && $table == "surat_berkas_masuk") {
            foreach ($results as $result) {
                $this->db->select('id_surat_masuk as id_surat, jenis_surat, nomer_surat, tanggal_surat as tanggal_surat, perihal, file_surat as file');
                $result->surat              = $this->db->get_where('surat_masuk', array('id_surat_masuk' => $result->id_surat_keluar))->row();
                $result->surat->tipe        = "masuk";
                $result->surat->tanggal_surat = tanggal_hari($result->surat->tanggal_surat);
            }
        }

        return $results;
    }

    public function get_single_where($where = null)
    {
        if (!empty($where)) {
            $this->db->where($where);
        }

        $this->db->where('deleted_date', null);
        $data = $this->db->get('surat_berkas_detail')->row();

        if (!empty($data)) {
            $data->id_surat_berkas = $this->db->get_where('surat_berkas', array('id_surat_berkas' => $data->id_surat_berkas, 'deleted_date' => null))->row();

            if (!empty($data->id_surat_masuk)) {
                // $data->id_surat_masuk = ;
            }
            
            if (!empty($data->id_surat_keluar)) {
                // $data->id_surat_masuk = ;
            }
        }
    }

    public function insert_entry()
    {
        $this->id_surat_berkas  = $this->input->post('surat_berkas');
        $this->id_surat_masuk   = (!empty($this->input->post('surat_masuk'))) ? $this->input->post('surat_masuk') : null;
        $this->id_surat_keluar  = (!empty($this->input->post('surat_keluar'))) ? $this->input->post('surat_keluar') : null;
        $this->created_date     = date('y-m-d H:i:s');

        $this->db->insert('surat_berkas', $this);

        return $this->db->affected_rows();
    }

    public function update_entry()
    {
        
    }

    public function delete_entry($where)
    {
        $this->db->set('deleted_date', date('y-m-d H:i:s'));
        $this->db->where($where);
        $this->db->update('surat_berkas_detail');

        return $this->db->affected_rows();
    }


}