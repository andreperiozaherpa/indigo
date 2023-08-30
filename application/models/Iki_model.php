
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Iki_model extends CI_Model
{
    public function get_page($mulai, $hal, $nama, $nip, $skpd, $where = '')
    {
        $user_privileges = explode(";", $this->session->userdata('user_privileges'));
        if ($this->session->userdata('level') != 'Administrator' && in_array('op_kepegawaian', $user_privileges) == false) {
            if ($this->session->userdata('level') == 'Operator') {
                $this->db->where('pegawai.id_skpd', $this->session->userdata('kd_skpd'));
            } else {
                $this->db->where('pegawai.id_skpd', $this->session->userdata('id_skpd'));
            }
        }
        if ($nama != '') {
            $this->db->like('nama_lengkap', $nama);
        }
        if ($nip != '') {
            $this->db->where('nip', $nip);
        }
        if ($skpd != '') {
            $this->db->where('pegawai.id_skpd', $skpd);
        } else {
            $this->db->limit($hal, $mulai);
        }
        if ($where !== '') {
            $this->db->where($where);
        }
        $this->db->where('pensiun', 0);
        $this->db->join('ref_skpd', 'ref_skpd.id_skpd = pegawai.id_skpd');
        $this->db->join('ref_unit_kerja', 'ref_unit_kerja.id_unit_kerja = pegawai.id_unit_kerja', 'left');
        $this->db->join('ref_jabatan', 'ref_jabatan.id_jabatan = pegawai.id_jabatan', 'left');
        $query = $this->db->get('pegawai');
        return $query->result();
    }
    
    public function get_by_id($id_pegawai)
    {
        $this->db->where('pegawai.id_pegawai', $id_pegawai);
        $this->db->join('user', 'user.id_pegawai = pegawai.id_pegawai', 'left');
        $this->db->join('ref_skpd', 'ref_skpd.id_skpd = pegawai.id_skpd');
        $this->db->join('ref_unit_kerja', 'ref_unit_kerja.id_unit_kerja = pegawai.id_unit_kerja', 'left');
        $this->db->join('ref_jabatan_baru', 'ref_jabatan_baru.id_jabatan = pegawai.id_jabatan', 'left');
        $this->db->select('pegawai.*,ref_jabatan_baru.*,ref_skpd.nama_skpd,ref_unit_kerja.nama_unit_kerja,user.user_id, user.employee_id, user.instansi_id, user.unit_kerja_id, user.kd_skpd, user.id_ketersediaan, user.username, user.password, user.full_name, user.email, user.phone, user.bio, user.certificate, user.dot_key, user.pass_key, user.scan_ttd, user.user_picture, user.user_level, user.user_group_menu, user.user_privileges, user.reg_date, user.user_status, user.api_key, user.app_token');
        $query = $this->db->get('pegawai');
        return $query->row();
    }
    
    public function get_sasaran_by_id($id_pegawai)
    {
        $this->db->where('id_pegawai', $id_pegawai);
        $query = $this->db->get('iki_sasaran');
        $data = NULL;
        foreach ($query->result_array() as $row) {
            $data[$row['id_sasaran_iki']] = $row;

            $this->db->where('id_sasaran_iki', $row['id_sasaran_iki']);
            $query2 = $this->db->get('iki_indikator');
            $data[$row['id_sasaran_iki']]['iki'] = $query2->result_array();
        }
        return $data;
    }

    public function cek_iki($id_pegawai)
    {
        $this->db->where('id_pegawai',$id_pegawai);
        $query = $this->db->get('iki_indikator');
        return $query->num_rows();
    }

    public function insert_sasaran($data)
    {
        $query = $this->db->insert('iki_sasaran', $data);
    }

    public function select_by_id_sasaran($id = NULL)
    {
        if (!empty($id)) {
            $this->db->where('id_sasaran_iki', $id);
        }
        $query = $this->db->get('iki_sasaran');
        return $query->row();
    }

    public function update_sasaran($data, $id = NULL)
    {
        $this->db->where('id_sasaran_iki', $id);
        $query = $this->db->update('iki_sasaran', $data);
    }

    public function delete_sasaran($id = NULL)
    {
        $this->db->where('id_sasaran_iki', $id);
        $query = $this->db->delete('iki_sasaran');
        $this->db->where('id_sasaran_iki', $id);
        $query = $this->db->delete('iki_indikator');
        // redirect('ref_jabatan');
    }

    public function insert_indikator($data)
    {
        $query = $this->db->insert('iki_indikator', $data);
    }

    public function select_by_id_indikator($id = NULL)
    {
        if (!empty($id)) {
            $this->db->where('id_iki', $id);
        }
        $query = $this->db->get('iki_indikator');
        return $query->row();
    }

    public function update_indikator($data, $id = NULL)
    {
        $this->db->where('id_iki', $id);
        $query = $this->db->update('iki_indikator', $data);
    }

    public function delete_indikator($id = NULL)
    {
        $this->db->where('id_iki', $id);
        $query = $this->db->delete('iki_indikator');
        // redirect('ref_jabatan');
    }
}
