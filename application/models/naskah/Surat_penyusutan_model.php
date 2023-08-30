<?php


class Surat_penyusutan_model extends CI_Model
{

    public $id_surat_penyusutan,
        $created_date,
	    $updated_date,
	    $deleted_date,
        $id_skpd,
        $id_unit_kerja,
        $id_pegawai,
        $penyusutan_akhir;

    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set("Asia/Jakarta");
    }

    public function get_all_where($where = null)
    {
        if (!empty($where)) {
            $this->db->where($where);
        }

        $this->db->where('deleted_date', null);
        $data = $this->db->get('surat_berkas')->result();

        if (!empty($data)) {
            foreach ($data as $d) {
                $d->id_surat_klasifikasi = $this->db->get_where('surat_klasifikasi', array('id_surat_klasifikasi' => $d->id_surat_klasifikasi))->row();
                $retensi_aktif_int = intval($d->id_surat_klasifikasi->retensi_aktif);
                $retensi_inaktif_int = intval($d->id_surat_klasifikasi->retensi_inaktif);
                $d->id_surat_klasifikasi->kurun_waktu = $retensi_aktif_int + $retensi_inaktif_int;
                $d->id_surat_klasifikasi->akhir_retensi_aktif = intval(date('Y', strtotime($d->created_date))) + $retensi_aktif_int;
            }
        }

        return $data;
    }

    public function get_single_where($where = null)
    {
        if (!empty($where)) {
            $this->db->where($where);
        }

        $this->db->where('deleted_date', null);
        $data = $this->db->get('surat_berkas')->row();

        if (!empty($data)) {
            $data->id_surat_klasifikasi = $this->db->get_where('surat_klasifikasi', array('id_surat_klasifikasi' => $data->id_surat_klasifikasi))->row();
            $retensi_aktif_int = intval($data->id_surat_klasifikasi->retensi_aktif);
            $retensi_inaktif_int = intval($data->id_surat_klasifikasi->retensi_inaktif);
            $data->id_surat_klasifikasi->kurun_waktu = $retensi_aktif_int + $retensi_inaktif_int;
            $data->id_surat_klasifikasi->akhir_retensi_aktif = intval(date('Y', strtotime($data->created_date))) + $retensi_aktif_int;
        }

        return $data;
    }

    public function get_last_number($code)
    {
        $id_surat_klasifikasi = $this->db->select('id_surat_penyusutan')->limit(1)->get('surat_klasifikasi')->row();
        $this->db->limit(1);
        $this->db->select_max('nomor_berkas');

        return $this->db->get_where('surat_berkas', array('id_surat_klasifikasi' => $id_surat_klasifikasi->id_surat_klasifikasi, 'status_berkas' => 'Aktif', 'deleted_date' => null))->row();
    }

    public function insert_entry_permanen()
    {
        $this->created_date = date('y-m-d H:i:s');
        $this->penyusutan_akhir = "permanen";
        $this->status = 0 ; // 0 : usulan, 1 : terverifikasi, 2 : ditolak
        $this->id_skpd = (!empty($this->session->userdata('id_skpd')) ? $this->session->userdata('id_skpd') : null);
        $this->db->insert('surat_penyusutan', $this);

        $arrayid = $this->input->post('idberkas');
        $penyusutan_id = 1;

        foreach ($arrayid as $id_berkas) {
            $data = array(
                'id_surat_penyusutan' => $penyusutan_id,
                'id_surat_berkas' => $id_berkas,
                'created_date' => date('y-m-d H:i:s')
            );
            $this->db->insert('surat_penyusutan_detail', $data);
        }
        return $this->db->affected_rows();
    }

    public function insert_entry_musnah()
    {
        $this->created_date = date('y-m-d H:i:s');
        $this->penyusutan_akhir = "musnah";
        $this->status = 0 ; // 0 : usulan, 1 : terverifikasi, 2 : ditolak
        $this->id_skpd = (!empty($this->session->userdata('id_skpd')) ? $this->session->userdata('id_skpd') : null);
        $this->db->insert('surat_penyusutan', $this);

        $arrayid = $this->input->post('idberkas');
        $penyusutan_id = 1;

        foreach ($arrayid as $id_berkas) {
            $data = array(
                'id_surat_penyusutan' => $penyusutan_id,
                'id_surat_berkas' => $id_berkas,
                'created_date' => date('y-m-d H:i:s')
            );
            $this->db->insert('surat_penyusutan_detail', $data);
        }
        return $this->db->affected_rows();
    }

    public function update_entry()
    {
        
    }

    public function delete_entry($id)
    {
        $this->db->set('deleted_date', date('y-m-d H:i:s'));
        $this->db->where($this->id_surat_berkas, $id);
        $this->db->update('surat_berkas');

        return $this->db->affected_rows();
    }
}
