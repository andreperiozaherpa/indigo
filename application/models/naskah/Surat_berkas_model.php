<?php


class Surat_berkas_model extends CI_Model
{

    public $id_surat_berkas,
    $nama_berkas,
    $slug,
    $id_surat_klasifikasi,
    $kategori_berkas,
    $arsip_vital,
    $arsip_terjaga,
    $mkb,
    $uraian,
    $lokasi_fisik,
    $status_berkas,
    $status_pinjam,
    $status_pindah,
    $nomor_berkas,
    $id_skpd;

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
                $d->id_surat_klasifikasi->kurun_waktu = $retensi_aktif_int;
                $d->id_surat_klasifikasi->akhir_retensi_aktif = intval(date('Y', strtotime($d->created_date))) + $retensi_aktif_int;

                $this->db->where('id_surat_berkas', $d->id_surat_berkas);
                $d->total_in = $this->db->count_all_results('surat_berkas_masuk');

                $this->db->where('id_surat_berkas', $d->id_surat_berkas);
                $d->total_out = $this->db->count_all_results('surat_berkas_keluar');

                $d->jumlah_item = ((!empty($d->total_in)) ? $d->total_in : 0) + ((!empty($d->total_out)) ? $d->total_out : 0);
            }
        }

        return $data;
    }

    public function get_surat_added($tipe_surat)
    {
        $results = null;
        if ($tipe_surat == "surat_keluar") {
            $this->db->select('surat_berkas_keluar.id_surat_keluar');
            $this->db->where('id_skpd', $this->session->userdata('id_skpd'));

            $this->db->join('surat_berkas_keluar', 'surat_berkas_keluar.id_surat_berkas = surat_berkas.id_surat_berkas');
            $results = $this->db->get('surat_berkas')->result_array();
        } else if ($tipe_surat == "surat_masuk") {
            $this->db->select('surat_berkas_masuk.id_surat_masuk');
            $this->db->where('id_skpd', $this->session->userdata('id_skpd'));

            $this->db->join('surat_berkas_masuk', 'surat_berkas_masuk.id_surat_berkas = surat_berkas.id_surat_berkas');
            $results = $this->db->get('surat_berkas')->result_array();
        }

        return $results;
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
            $data->id_surat_klasifikasi->kurun_waktu = $retensi_aktif_int;
            $akhir_retensi_aktif = date('Y-m-d', strtotime('+' . $retensi_aktif_int . 'year', strtotime($data->created_date)));
            $format_akhir_retensi_aktif = date_create($akhir_retensi_aktif);
            $data->id_surat_klasifikasi->akhir_retensi_aktif = date_format($format_akhir_retensi_aktif, "d M Y");
        }

        return $data;
    }

    public function get_last_number_file_active($code)
    {
        // $id_surat_klasifikasi = $this->db->select('id_surat_klasifikasi')->where('id_surat_klasifikasi', $code)->limit(1)->get('surat_klasifikasi')->row();

        $this->db->limit(1);
        $this->db->select_max('nomor_berkas');

        return $this->db->get_where('surat_berkas', array('id_surat_klasifikasi' => $code, 'id_skpd' => $this->session->userdata('id_skpd'), 'status_berkas' => 'aktif', 'deleted_date' => null))->row();
    }

    public function insert_entry()
    {
        $this->nama_berkas = $this->input->post('name_file');
        $this->slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $this->nama_berkas), '-'));
        $this->id_surat_klasifikasi = $this->input->post('classification');
        $this->kategori_berkas = $this->input->post('category');
        $this->arsip_vital = (!empty($this->input->post('arsip_vital')) && $this->input->post('arsip_vital') == "1") ? 1 : 0;
        $this->arsip_terjaga = (!empty($this->input->post('arsip_terjaga')) && $this->input->post('arsip_terjaga') == "1") ? 1 : 0;
        $this->mkb = (!empty($this->input->post('mkb')) && $this->input->post('mkb') == "1") ? 1 : 0;
        $this->uraian = $this->input->post('description');
        $this->lokasi_fisik = $this->input->post('location_file');
        $this->status_berkas = "aktif";
        $this->status_pinjam = 0;
        $this->status_pindah = 0;
        $this->nomor_berkas = $this->input->post('number_file');
        $this->id_skpd = (!empty($this->session->userdata('id_skpd')) ? $this->session->userdata('id_skpd') : null);
        $this->created_date = date('y-m-d H:i:s');

        $last_number_file = $this->get_last_number_file_active($this->id_surat_klasifikasi);

        if (empty($last_number_file->nomor_berkas)) {
            $this->nomor_berkas = 1;
        } else {
            $this->nomor_berkas = (int) $last_number_file->nomor_berkas + 1;
        }

        $this->db->insert('surat_berkas', $this);

        return $this->db->affected_rows();
    }

    public function update_entry()
    {

    }

    public function delete_entry($id)
    {
        $this->db->set('deleted_date', date('y-m-d H:i:s'));
        $this->db->where('id_surat_berkas', $id);
        $this->db->update('surat_berkas');

        return $this->db->affected_rows();
    }

    public function insert_detail_keluar_entry($id_surat_berkas, $id_surat)
    {
        $data = array(
            'id_surat_berkas' => $id_surat_berkas,
            'id_surat_keluar' => $id_surat,
            'created_date' => date('Y-m-d H:i:s')
        );

        $this->db->insert('surat_berkas_keluar', $data);
    }

    public function insert_detail_masuk_entry($id_surat_berkas, $id_surat)
    {
        $data = array(
            'id_surat_berkas' => $id_surat_berkas,
            'id_surat_masuk' => $id_surat,
            'created_date' => date('Y-m-d H:i:s')
        );

        $this->db->insert('surat_berkas_masuk', $data);
    }

    public function get_total()
    {
        $this->db->where('deleted_date is null');
        $this->db->where('id_skpd', $this->session->userdata('id_skpd'));

        return $this->db->count_all_results('surat_berkas');
    }
}