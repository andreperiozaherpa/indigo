<?php
class Permintaan_cuti_model extends CI_Model{
    public function get_all(){
        if ($this->session->userdata('level') !== 'Administrator') {
            $this->db->where('pc_permintaan_cuti.id_pegawai',$this->session->userdata('id_pegawai'));
        }
        $this->db->join('pc_ref_jenis_cuti','pc_ref_jenis_cuti.id_ref_jenis_cuti = pc_permintaan_cuti.id_ref_jenis_cuti');
        $this->db->join('pegawai','pegawai.id_pegawai = pc_permintaan_cuti.id_pegawai');
        return $this->db->get('pc_permintaan_cuti')->result();
    }
    public function get_verifikasi($jenis_verifikasi){
        if ($jenis_verifikasi=='kepegawaian') {
            $this->db->where('pc_permintaan_cuti.id_skpd',$this->session->userdata('id_skpd'));
            $this->db->where('status_pengajuan','sudah_Diajukan');
        }
        $this->db->join('pc_ref_jenis_cuti','pc_ref_jenis_cuti.id_ref_jenis_cuti = pc_permintaan_cuti.id_ref_jenis_cuti');
        $this->db->join('pegawai','pegawai.id_pegawai = pc_permintaan_cuti.id_pegawai');
        return $this->db->get('pc_permintaan_cuti')->result();
    }
    public function get_by_id($id_permintaan_cuti){
        $this->db->where('id_permintaan_cuti',$id_permintaan_cuti);
        $this->db->join('pc_ref_jenis_cuti','pc_ref_jenis_cuti.id_ref_jenis_cuti = pc_permintaan_cuti.id_ref_jenis_cuti');
        $this->db->join('pegawai','pegawai.id_pegawai = pc_permintaan_cuti.id_pegawai');
        $this->db->join('ref_skpd','ref_skpd.id_skpd = pegawai.id_skpd');
        $this->db->join('ref_unit_kerja','ref_unit_kerja.id_unit_kerja = pegawai.id_unit_kerja');
        $this->db->join('ref_jabatan_baru','ref_jabatan_baru.id_jabatan = pegawai.id_jabatan');
        return $this->db->get('pc_permintaan_cuti')->row();
    }
    public function insert($data){
        $data['tanggal_pengajuan'] = date('Y-m-d');
        $this->db->insert('pc_permintaan_cuti',$data);
        return $this->db->insert_id();
    }
    public function update($data,$id_permintaan_cuti){
        return $this->db->update('pc_permintaan_cuti',$data,['id_permintaan_cuti'=>$id_permintaan_cuti]);
    }
    public function delete($id_permintaan_cuti){
        $this->db->delete('pc_permintaan_cuti_persyaratan',['id_permintaan_cuti'=>$id_permintaan_cuti]);
        return $this->db->delete('pc_permintaan_cuti',['id_permintaan_cuti'=>$id_permintaan_cuti]);
    }

    public function save_persyaratan($id_permintaan_cuti,$id_ref_persyaratan,$file){
        $data = ['id_permintaan_cuti'=>$id_permintaan_cuti,'id_ref_persyaratan'=>$id_ref_persyaratan,'file'=>$file,'status_verifikasi'=>'menunggu_verifikasi'];
        $this->db->insert('pc_permintaan_cuti_persyaratan',$data);
        return $this->db->insert_id();
    }
    public function update_persyaratan($id_permintaan_cuti_persyaratan,$file){
        $data = ['file'=>$file,'status_verifikasi'=>'menunggu_verifikasi'];
        return $this->db->update('pc_permintaan_cuti_persyaratan',$data,['id_permintaan_cuti_persyaratan'=>$id_permintaan_cuti_persyaratan]);
    }

    public function get_persyaratan($id_permintaan_cuti){
        $this->db->join('pc_ref_persyaratan','pc_ref_persyaratan.id_ref_persyaratan = pc_permintaan_cuti_persyaratan.id_ref_persyaratan');
        $res = $this->db->get_where('pc_permintaan_cuti_persyaratan',['id_permintaan_cuti'=>$id_permintaan_cuti])->result();
        return $res;
    }

    public function cek_kelengkapan_persyaratan($id_permintaan_cuti){
        $get = $this->get_persyaratan($id_permintaan_cuti);
        $lengkap = true;
        foreach($get as $g){
            if($g->status_verifikasi=='menunggu_verifikasi'){
                $lengkap = false;
                break;
            }
        }
        return $lengkap;
    }

    

    public function get_detail_persyaratan($id_permintaan_cuti_persyaratan){
        $this->db->join('pc_ref_persyaratan','pc_ref_persyaratan.id_ref_persyaratan = pc_permintaan_cuti_persyaratan.id_ref_persyaratan');
        $res = $this->db->get_where('pc_permintaan_cuti_persyaratan',['id_permintaan_cuti_persyaratan'=>$id_permintaan_cuti_persyaratan])->row();
        return $res;
    }
}