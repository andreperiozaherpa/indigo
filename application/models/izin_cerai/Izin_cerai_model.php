<?php
class Izin_cerai_model extends CI_Model{
    public function get_all(){
        $this->db->join('pegawai','pegawai.id_pegawai = ic_izin_cerai.id_pegawai');
        return $this->db->get('ic_izin_cerai')->result();
    }
    public function get_by_id($id_izin_cerai){
        $this->db->where('id_izin_cerai',$id_izin_cerai);
        $this->db->join('pegawai','pegawai.id_pegawai = ic_izin_cerai.id_pegawai');
        $this->db->join('ref_skpd','ref_skpd.id_skpd = pegawai.id_skpd');
        $this->db->join('ref_unit_kerja','ref_unit_kerja.id_unit_kerja = pegawai.id_unit_kerja');
        $this->db->join('ref_jabatan_baru','ref_jabatan_baru.id_jabatan = pegawai.id_jabatan');
        return $this->db->get('ic_izin_cerai')->row();
    }
    public function insert($data){
        $data['tanggal_pengajuan'] = date('Y-m-d');
        $this->db->insert('ic_izin_cerai',$data);
        return $this->db->insert_id();
    }
    public function update($data,$id_izin_cerai){
        return $this->db->update('ic_izin_cerai',$data,['id_izin_cerai'=>$id_izin_cerai]);
    }
    public function delete($id_izin_cerai){
        $this->db->delete('ic_izin_cerai_persyaratan',['id_izin_cerai'=>$id_izin_cerai]);
        return $this->db->delete('ic_izin_cerai',['id_izin_cerai'=>$id_izin_cerai]);
    }

    public function save_persyaratan($id_izin_cerai,$id_ref_persyaratan,$file){
        $data = ['id_izin_cerai'=>$id_izin_cerai,'id_ref_persyaratan'=>$id_ref_persyaratan,'file'=>$file,'status_verifikasi'=>'menunggu_verifikasi'];
        $this->db->insert('ic_izin_cerai_persyaratan',$data);
        return $this->db->insert_id();
    }
    public function update_persyaratan($id_izin_cerai_persyaratan,$file){
        $data = ['file'=>$file,'status_verifikasi'=>'menunggu_verifikasi'];
        return $this->db->update('ic_izin_cerai_persyaratan',$data,['id_izin_cerai_persyaratan'=>$id_izin_cerai_persyaratan]);
    }

    public function get_persyaratan($id_izin_cerai){
        $this->db->join('ic_ref_persyaratan','ic_ref_persyaratan.id_ref_persyaratan = ic_izin_cerai_persyaratan.id_ref_persyaratan');
        $res = $this->db->get_where('ic_izin_cerai_persyaratan',['id_izin_cerai'=>$id_izin_cerai])->result();
        return $res;
    }

    public function cek_kelengkapan_persyaratan($id_izin_cerai){
        $get = $this->get_persyaratan($id_izin_cerai);
        $lengkap = true;
        foreach($get as $g){
            if($g->status_verifikasi=='menunggu_verifikasi'){
                $lengkap = false;
                break;
            }
        }
        return $lengkap;
    }

    

    public function get_detail_persyaratan($id_izin_cerai_persyaratan){
        $this->db->join('ic_ref_persyaratan','ic_ref_persyaratan.id_ref_persyaratan = ic_izin_cerai_persyaratan.id_ref_persyaratan');
        $res = $this->db->get_where('ic_izin_cerai_persyaratan',['id_izin_cerai_persyaratan'=>$id_izin_cerai_persyaratan])->row();
        return $res;
    }
}