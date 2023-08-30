<?php
class Pegawai_dewan_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->db_dprd = $this->load->database('dprd', TRUE);
    }

    public function get_all()
    {
        $res = $this->db_dprd->get('pegawai')->result();
        return $res;
    }

    public function get_pegawai_by_id($id_pegawai)
    {

        $res = $this->db_dprd->get_where('pegawai', ['id_pegawai' => $id_pegawai])->row();
        return $res;
    }
    public function get_pegawai_user($id_pegawai)
    {
        $this->db_dprd->where("pegawai.id_pegawai", $id_pegawai);
        $this->db_dprd->join("user", "user.id_pegawai=pegawai.id_pegawai", "left");
        $rs = $this->db_dprd->get("pegawai")->row();
        return $rs->user_id;
    }

    public function insert_surat($data)
    {
        unset($data->id_surat_keluar);
        foreach($data as $k => $v){
            if (!$this->db_dprd->field_exists($k, 'surat_keluar')){
                unset($data->$k);
            }
        }
        $res = $this->db_dprd->insert('surat_keluar', $data);
        $id = $this->db_dprd->insert_id();
        return $id;
    }
    public function insert_surat_masuk($data)
    {
        if (isset($data->id_surat_masuk)) {
            unset($data->id_surat_masuk);
        }
        $res = $this->db_dprd->insert('surat_masuk', $data);
        $id = $this->db_dprd->insert_id();
        return $id;
    }
    public function insert_notifikasi($data)
    {
        $dataa = $data['data'];
        $data_id = $data['data_id'];
        $this->db_dprd->where('data', $dataa);
        $this->db_dprd->where('data_id', $data_id);
        $this->db_dprd->where('read_status', 0);
        $this->db_dprd->where('web', 1);
        $get = $this->db_dprd->get('notification');
        if ($get->num_rows() == 0) {
            $this->db_dprd->set('web', 1);
            $this->db_dprd->set('notification_id', 'N-' . rand(10, 9999) . time());
            $this->db_dprd->insert('notification', $data);
        } else {
            $this->db_dprd->where('notification_id', $get->row()->notification_id);
            $this->db_dprd->update('notification', $data);
        }
        return true;
    }
}
