<?php
class Kegiatan_dewan_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->db_dprd = $this->load->database('dprd', TRUE);
    }
    public function get_all($peserta = false, $data_filter = '')
    {
        if (!empty($data_filter)) {
            foreach ($data_filter as $key => $value) {
                if ($key == 'tanggal_awal') {
                    $this->db_dprd->where('tanggal >=', $value);
                } elseif ($key == 'tanggal_akhir') {
                    $this->db_dprd->where('tanggal <=', $value);
                } else {
                    $this->db_dprd->like($key, $value);
                }
            }
        }
        $get = $this->db_dprd->get('kegiatan_dewan')->result();
        if ($peserta) {
            foreach ($get as $k => $g) {
                $list_peserta = $this->get_peserta($g->id_kegiatan_dewan);
                $n = 1;
                $peserta_thumb = [];
                foreach ($list_peserta as $p) {
                    if (count($peserta_thumb) <= 4) {
                        $peserta_thumb[] = ['foto_pegawai' => $p->foto_pegawai, 'nama_lengkap' => $p->nama_lengkap];
                        $n++;
                    } else {
                        break;
                    }
                }
                $get[$k]->peserta_thumb = $peserta_thumb;
                $get[$k]->jumlah_peserta = count($list_peserta);
            }
        }
        return $get;
    }
    public function get_by_id($id_kegiatan_dewan)
    {
        $this->db_dprd->where('id_kegiatan_dewan', $id_kegiatan_dewan);
        $get = $this->db_dprd->get('kegiatan_dewan')->row();
        return $get;
    }
    public function insert($data)
    {
        $this->db_dprd->set('waktu_input', date('Y-m-d H:i:s'));
        $this->db_dprd->set('id_pegawai_input', $this->session->userdata('id_pegawai'));
        $in = $this->db_dprd->insert('kegiatan_dewan', $data);
        if ($in) {
            return $this->db_dprd->insert_id();
        } else {
            return false;
        }
    }
    public function update($data, $id_kegiatan_dewan)
    {
        $this->db_dprd->set('waktu_update', date('Y-m-d H:i:s'));
        $in = $this->db_dprd->update('kegiatan_dewan', $data, ['id_kegiatan_dewan' => $id_kegiatan_dewan]);
        if ($in) {
            return true;
        } else {
            return false;
        }
    }
    public function delete($id_kegiatan_dewan)
    {
        $this->db_dprd->delete('kegiatan_dewan', ['id_kegiatan_dewan' => $id_kegiatan_dewan]);
        $this->db_dprd->delete('kegiatan_dewan_peserta', ['id_kegiatan_dewan' => $id_kegiatan_dewan]);
        $this->db_dprd->delete('kegiatan_dewan_notulensi', ['id_kegiatan_dewan' => $id_kegiatan_dewan]);
        return true;
    }
    public function get_peserta($id_kegiatan_dewan)
    {
        $this->db_dprd->join('pegawai', 'pegawai.id_pegawai = kegiatan_dewan_peserta.id_pegawai');
        $get = $this->db_dprd->get_where('kegiatan_dewan_peserta', ['id_kegiatan_dewan' => $id_kegiatan_dewan])->result();
        return $get;
    }
    public function insert_peserta($id_kegiatan_dewan, $id_pegawai)
    {
        $pegawai = $this->db_dprd->get_where('pegawai', ['id_pegawai' => $id_pegawai])->row();
        if ($pegawai) {
            $in = $this->db_dprd->insert('kegiatan_dewan_peserta', ['id_kegiatan_dewan' => $id_kegiatan_dewan, 'id_pegawai' => $id_pegawai, 'jabatan' => $pegawai->jabatan]);
            if ($in) {
                return $this->db_dprd->insert_id();
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    public function clear_peserta($id_kegiatan_dewan)
    {
        return $this->db_dprd->delete('kegiatan_dewan_peserta', ['id_kegiatan_dewan' => $id_kegiatan_dewan]);
    }
    public function save_notulen($id_kegiatan_dewan, $notulensi, $lampiran)
    {
        $cek = $this->get_notulen($id_kegiatan_dewan);
        $this->db_dprd->set('notulensi', $notulensi);
        $this->db_dprd->set('id_kegiatan_dewan', $id_kegiatan_dewan);
        $this->db_dprd->set('lampiran', $lampiran);
        $this->db_dprd->set('tanggal', date('Y-m-d'));
        $this->db_dprd->set('jam', date('H:i:s'));
        if ($cek) {
            $this->db_dprd->where('id_kegiatan_dewan_notulensi', $cek->id_kegiatan_dewan_notulensi);
            $this->db_dprd->update('kegiatan_dewan_notulensi');
        } else {
            $this->db_dprd->insert('kegiatan_dewan_notulensi');
        }
        return true;
    }

    public function get_notulen($id_kegiatan_dewan)
    {
        $get = $this->db_dprd->get_where('kegiatan_dewan_notulensi', ['id_kegiatan_dewan' => $id_kegiatan_dewan])->row();
        return $get;
    }
}
