<?php
class Visimisi_desa_model extends CI_Model
{
    public function get_visi($id_skpd){
        return $this->db->get_where('sd_visi',array('id_skpd'=>$id_skpd))->row();
    }
    public function update_visi($id_skpd,$data){
        $cek = $this->get_visi($id_skpd);
        if($cek){
            $q = $this->db->update('sd_visi',array('visi'=>$data['visi']),array('id_sd_visi',$data['id_sd_visi']));
            return $q;
        }else{
            $q = $this->db->insert('sd_visi',array('id_skpd'=>$id_skpd,'visi'=>$data['visi']));
            return $this->db->insert_id();
        }
    }
    public function get_misi($id_skpd){
        return $this->db->get_where('sd_misi',array('id_skpd'=>$id_skpd))->result();
    }
    public function get_misi_by_id($id_sd_misi){
        return $this->db->get_where('sd_misi',array('id_sd_misi'=>$id_sd_misi))->row();
    }
    public function insert_misi($id_skpd,$data){
        $q = $this->db->insert('sd_misi',array('id_skpd'=>$id_skpd,'misi'=>$data['misi']));
        return $this->db->insert_id();
    }
    public function update_misi($data){
        $q = $this->db->update('sd_misi',array('misi'=>$data['misi']),array('id_sd_misi'=>$data['id_sd_misi']));
        return $q;
    }
    public function delete_misi($id_sd_misi){
        $q = $this->db->delete('sd_misi',array('id_sd_misi'=>$id_sd_misi));
        return $q;
    }
    public function get_tujuan($id_skpd){
        $this->db->join('sd_misi','sd_misi.id_sd_misi = sd_tujuan.id_sd_misi');
        return $this->db->get_where('sd_tujuan',array('sd_tujuan.id_skpd'=>$id_skpd))->result();
    }
    public function get_tujuan_by_id($id_sd_tujuan){
        $this->db->join('sd_misi','sd_misi.id_sd_misi = sd_tujuan.id_sd_misi');
        return $this->db->get_where('sd_tujuan',array('sd_tujuan.id_sd_tujuan'=>$id_sd_tujuan))->row();
    }
    public function insert_tujuan($id_skpd,$data){
        $q = $this->db->insert('sd_tujuan',array('id_skpd'=>$id_skpd,'id_sd_misi'=>$data['id_sd_misi'],'tujuan'=>$data['tujuan']));
        return $this->db->insert_id();
    }
    public function update_tujuan($data){
        $q = $this->db->insert('sd_tujuan',array('id_sd_misi'=>$data['id_sd_misi'],'tujuan'=>$data['tujuan']),array('id_sd_tujuan'=>$data['id_sd_tujuan']));
        return $q;
    }
    public function delete_tujuan($id_sd_tujuan){
        $q = $this->db->delete('sd_tujuan',array('id_sd_tujuan'=>$id_sd_tujuan));
        return $q;
    }
}
