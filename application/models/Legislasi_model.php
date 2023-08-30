<?php
class Legislasi_model extends CI_Model{
    public function get_all(){
        $this->db->join('pegawai','pegawai.id_pegawai = legislasi.id_pegawai_ketua');
        $this->db->select('legislasi.*,pegawai.nama_lengkap as nama_lengkap_ketua');
        return $this->db->get('legislasi')->result();
    }
    public function insert($data){
        $this->db->insert('legislasi',$data);
        return $this->db->insert_id();
    }
    public function insert_anggota($id_legislasi,$id_pegawai,$jabatan){
        $data = ['id_legislasi'=>$id_legislasi,'id_pegawai'=>$id_pegawai,'jabatan'=>$jabatan];
        $this->db->insert('legislasi_anggota',$data);
        return $this->db->insert_id();
    }
    public function get_by_id($id_legislasi){
        $this->db->join('pegawai','pegawai.id_pegawai = legislasi.id_pegawai_ketua');
        $this->db->select('legislasi.*,pegawai.nama_lengkap as nama_lengkap_ketua, pegawai.foto_pegawai');
        $get = $this->db->get_where('legislasi',['id_legislasi'=>$id_legislasi])->row();
        return $get;
    }
    public function get_anggota($id_legislasi){
        $this->db->join('pegawai','pegawai.id_pegawai = legislasi_anggota.id_pegawai');
        $this->db->select('legislasi_anggota.*,pegawai.nama_lengkap, pegawai.foto_pegawai');
        $get = $this->db->get_where('legislasi_anggota',['id_legislasi'=>$id_legislasi])->result();
        return $get;
    }
    public function delete($id_legislasi){
        $this->db->delete('legislasi',['id_legislasi'=>$id_legislasi]);
        $this->db->delete('legislasi_anggota',['id_legislasi'=>$id_legislasi]);
        return true;
    }
}