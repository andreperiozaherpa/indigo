<?php
class Skp_model extends CI_Model{
    public function get_capaian($id_skpd,$id_unit_kerja,$tahun){

    }

    public function save_sasaran($data){
        $in = $this->db->insert('sasaran_skp',$data);
        if($in){
            return $this->db->insert_id();
        }else{
            return false;
        }
    }

    public function update_sasaran($data,$id_sasaran_skp){
        $in = $this->db->update('sasaran_skp',$data,array('id_sasaran_skp'=>$id_sasaran_skp));
        if($in){
            return true;
        }else{
            return false;
        }
    }

    public function get_sasaran($id_pegawai,$id_unit_kerja,$tahun){
        return $this->db->get_where('sasaran_skp',array('id_pegawai'=>$id_pegawai,'id_unit_kerja'=>$id_unit_kerja,'tahun'=>$tahun))->result();
    }

    public function get_sasaran_by_id($id_sasaran_skp){
        return $this->db->get_where('sasaran_skp',array('id_sasaran_skp'=>$id_sasaran_skp))->row();
    }
    
    public function save_indikator($data){
        $in = $this->db->insert('sasaran_skp_indikator',$data);
        if($in){
            return $this->db->insert_id();
        }else{
            return false;
        }
    }
    
    public function update_indikator($data,$id_sasaran_skp_indikator){
        $in = $this->db->update('sasaran_skp_indikator',$data,array('id_sasaran_skp_indikator'=>$id_sasaran_skp_indikator));
        if($in){
            return true;
        }else{
            return false;
        }
    }
    public function get_indikator($id_sasaran_skp){
        $this->db->join('ref_satuan','ref_satuan.id_satuan = sasaran_skp_indikator.id_satuan');
        return $this->db->get_where('sasaran_skp_indikator',array('id_sasaran_skp'=>$id_sasaran_skp))->result();
    }
    public function get_indikator_by_id($id_sasaran_skp_indikator){
        $this->db->join('ref_satuan','ref_satuan.id_satuan = sasaran_skp_indikator.id_satuan');
        return $this->db->get_where('sasaran_skp_indikator',array('id_sasaran_skp_indikator'=>$id_sasaran_skp_indikator))->row();
    }
    
    public function save_realisasi($data,$id_sasaran_skp_indikator){
        $in = $this->db->update('sasaran_skp_indikator',$data,array('id_sasaran_skp_indikator'=>$id_sasaran_skp_indikator));
        if($in){
            return true;
        }else{
            return false;
        }
    }

    public function get_summary($id_pegawai,$id_unit_kerja,$tahun){
        
    }

    
    public function delete_sasaran($id_sasaran_skp){
        return $this->db->delete('sasaran_skp',array('id_sasaran_skp'=>$id_sasaran_skp));
        return $this->db->delete('sasaran_skp_indikator',array('id_sasaran_skp'=>$id_sasaran_skp));
    }
    public function delete_indikator($id_sasaran_skp_indikator){
        return $this->db->delete('sasaran_skp_indikator',array('id_sasaran_skp_indikator'=>$id_sasaran_skp_indikator));
    }
}