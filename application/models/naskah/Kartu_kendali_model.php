<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kartu_kendali_model extends CI_Model
{

    public $table   = "kartu_kendali";
    public $order = array('nomor_urut' => 'desc'); // default order

    public function get_all_where($where = null, $limit = null, $start = null, $col = null, $dir = null)
    {
        $this->db->where('deleted_at is null');
        $this->db->limit($limit, $start);
        $this->db->order_by($col, $dir);

        if (!empty($where)) {
            $this->db->where($where);
        }

        $cards  = $this->db->get($this->table)->result();

        if (!empty($cards)) {
            foreach ($cards as $card) {
                if ($card->jenis_surat == "internal") {
                    switch ($card->tipe_surat) {
                        case "masuk":
                            $card->surat    = $this->db->get_where('surat_masuk', array('id_surat_masuk' => $card->surat, 'jenis_surat' => 'internal'))->row();
                            break;
                        case "keluar":
                            $card->surat    = $this->db->get_where('surat_keluar', array('id_surat_keluar' => $card->surat, 'jenis_surat' => 'internal'))->row();
                            $card->surat->id_pegawai_input  = $this->db->select('nama_lengkap, jabatan')->where(array('id_pegawai' => $card->surat->id_pegawai_input))->get('pegawai')->row();

                            break;
                    }
                } else if ($card->jenis_surat == "eksternal") {
                    switch ($card->tipe_surat) {
                        case "masuk":
                            $card->surat    = $this->db->get_where('surat_masuk', array('id_surat_masuk' => $card->surat, 'jenis_surat' => 'eksternal'))->row();
                            break;
                        case "keluar":
                            $card->surat    = $this->db->get_where('surat_keluar', array('id_surat_keluar' => $card->surat, 'jenis_surat' => 'eksternal'))->row();
                            break;
                    }
                }

                $card->klasifikasi  = $this->db->get_where('surat_klasifikasi', array('id_surat_klasifikasi' => $card->klasifikasi))->row();
            }
        }

        return $cards;
    }

    public function get_all_search_where($where, $filter = null, $limit, $start, $search, $col, $dir)
    {
        if (!empty($where)) {
            $this->db->where($where);
        }
        $this->db->where('deleted_at is null');
        $this->db->limit($limit, $start);
        $this->db->order_by($col, $dir);
        $cards = $this->db->get('kartu_kendali');

        if ($cards->num_rows() > 0) {
            foreach ($cards->result() as $card) {
                if ($card->sumber_surat == "surat_masuk" && $card->tipe_kendali == "masuk") {
                    $this->db->select('surat_masuk.*');
                    $this->db->join('surat_masuk', 'surat_masuk.id_surat_masuk = kartu_kendali.surat');
                } else if ($card->sumber_surat == "surat_keluar" && $card->tipe_kendali == "keluar") {
                    $this->db->select('surat_keluar.*');
                    $this->db->join('surat_keluar', 'surat_keluar.id_surat_keluar = kartu_kendali.surat');
                }

                if (!empty($search)) {
                    $this->db->like('perihal', $search);
                    $this->db->or_like('nomer_surat', $search);
                }

                if (!empty($where)) {
                    $this->db->where($where);
                }

                if (!empty($filter)) {
                    $this->db->where($filter);
                }
                $where['deleted_at']    = null;
                $this->db->select('id, kartu_kendali.indeks as kartu_kendali_indeks, nomor_urut as kartu_kendali_nomor_urut, kartu_kendali.isi_ringkasan as kartu_kendali_isi_ringkasan, kartu_kendali.catatan as kartu_kendali_catatan, kartu_kendali.lembar as kartu_kendali_lembar, kartu_kendali.jenis_surat as kartu_kendali_jenis_surat, sumber_surat, tipe_kendali as kartu_kendali_tipe_kendali, pengolah as kartu_kendali_pengolah, surat, klasifikasi, skpd, temp, created_at, updated_at, deleted_at');
                $cards_post = $this->db->get_where('kartu_kendali', $where)->result();

                if (!empty($cards_post)) {
                    foreach ($cards_post as $cp) {
                        $cp->klasifikasi = $this->db->get_where('surat_klasifikasi', array('id_surat_klasifikasi' => $cp->klasifikasi))->row();
//                        $cp->id_pegawai_input = $this->db->select('nama_lengkap, jabatan')->where(array('id_pegawai' => $cp->id_pegawai_input))->get('pegawai')->row();

                        if ($cp->sumber_surat == "surat_keluar") {
                            $surat_masuk            = $this->db->select('id_surat_masuk')->where('hash_id', $cp->hash_id)->get('surat_masuk')->row();
                            $disposisi              = $this->db->get_where('disposisi_surat_masuk', array('id_surat_masuk' => $surat_masuk->id_surat_masuk))->result();

                            if (!empty($disposisi)) {
                                $cp->disposisi_surat_masuk    = $surat_masuk->id_surat_masuk;
                            } else {
                                $cp->disposisi_surat_masuk    = null;
                            }

                        } else if ($cp->sumber_surat == "surat_masuk") {
                            $disposisi              = $this->db->get_where('disposisi_surat_masuk', array('id_surat_masuk' => $cp->id_surat_masuk))->result();
                            if (!empty($disposisi)) {
                                $cp->disposisi_surat_masuk    = $surat_masuk->id_surat_masuk;
                            } else {
                                $cp->disposisi_surat_masuk    = null;
                            }
                        }
                    }
                }

                return $cards_post;
            }
        } else {
            return $cards->result();
        }

    }

    public function get_single_where($where = null)
    {
        $this->db->where('deleted_at is null');

        if (!empty($where)) {
            $this->db->where($where);
        }

        $card       = $this->db->get($this->table)->row();

        if (!empty($card)) {
            switch ($card->sumber_surat) {
                case "surat_masuk":
                    $card->surat        = $this->db->get_where('surat_masuk', array('id_surat_masuk' => $card->surat))->row();
                    break;
                case "surat_keluar":
                    $card->surat        = $this->db->get_where('surat_keluar', array('id_surat_keluar' => $card->surat))->row();
                    break;
            }

            $card->klasifikasi          = $this->db->get_where('surat_klasifikasi', array('id_surat_klasifikasi' => $card->klasifikasi))->row();
            $card->skpd                 = $this->db->get_where('ref_skpd', array('id_skpd' => $card->skpd))->row();
        }

        return $card;
    }

    public function get_last_nomer_urut($where)
    {
        $this->db->where('deleted_at is null');
        $this->db->where($where);
        $this->db->limit(1);
        $this->db->order_by('nomor_urut', 'desc');
        $this->db->select('nomor_urut');
        return $this->db->get($this->table)->row();
    }

    public function insert_entry($data)
    {
        $insert     = $this->db->insert($this->table, $data);

        return $insert;
    }

    public function update_entry($data, $id)
    {
        $this->db->where('id', $id);
        $update     = $this->db->update($this->table, $data);

        return $update;
    }

    public function update_pengolah($id, $pengolah)
    {
        $this->db->set('pengolah', $pengolah);
        $this->db->where('id', $id);
        $update     = $this->db->update($this->table);

        return $update;
    }

    public function delete_entry($where)
    {

    }

    function get_count($search, $where = null, $filter = null)
    {
        $this->db->where('deleted_at is null');

        if (!empty($where)) {
            $this->db->where($where);
        }

        $cards = $this->db->get('kartu_kendali');

        if ($cards->num_rows() > 0) {
            foreach ($cards->result() as $card) {
                if ($card->sumber_surat == "surat_masuk" && $card->tipe_kendali == "masuk") {
                    $this->db->join('surat_masuk', 'surat_masuk.id_surat_masuk = kartu_kendali.surat');
                } else if ($card->sumber_surat == "surat_keluar" && $card->tipe_kendali == "keluar") {
                    $this->db->join('surat_keluar', 'surat_keluar.id_surat_keluar = kartu_kendali.surat');
                }

                if (!empty($search)) {
                    $this->db->like('perihal', $search);
                    $this->db->or_like('nomer_surat', $search);
                }

                if (!empty($where)) {
                    $this->db->where($where);
                }

                if (!empty($filter)) {
                    $this->db->where($filter);
                }
                $where['deleted_at']    = null;

                $cards = $this->db->count_all_results('kartu_kendali');

                return $cards;
            }
        } else {
            return $cards->num_rows();
        }
    }
}