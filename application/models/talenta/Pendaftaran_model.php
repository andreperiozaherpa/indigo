<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pendaftaran_model extends CI_Model
{
    public function insert($data)
    {
        $this->db->insert("mt_pendaftaran",$data);
        $id_pendaftaran = $this->db->insert_id();
        $data = array(
            'id_pendaftaran'    => $id_pendaftaran,
        );
        $this->db->insert("mt_assessment",$data);
        return $id_pendaftaran;
    }

    public function update($data,$id_pendaftaran)
    {
        $this->db->where("id_pendaftaran",$id_pendaftaran);
        $this->db->update("mt_pendaftaran",$data);
        
    }


    public function updateAssessment($data,$id_pendaftaran)
    {
        $this->db->where("id_pendaftaran",$id_pendaftaran);
        $this->db->update("mt_assessment",$data);
        
    }

    public function get($param=null, $hal=null,$mulai=null,$sWhere='')
    {
        if($param!=null)
        {
            foreach($param as $key=>$value){
                $this->db->where($key,$value);
            }
        }
        if($sWhere!="")
        {
            $this->db->where($sWhere);
        }

        $this->db->where("'".date('Y-m-d')."' >= mt_kebutuhan.tanggal_buka AND mt_kebutuhan.tanggal_tutup >= '".date('Y-m-d')."' ");

        $this->db->where("mt_kebutuhan.id_kebutuhan is not null");
        //$nilai_kinerja = ($nkp * 35/100) + ($np * 35/100) + ($skp * 30/100);
        $select="mt_pendaftaran.*,ref_jabatan.*,ref_skpd.*,pegawai.*,mt_kebutuhan.*,p2.nama_lengkap as nama_verifikator";
        //$select .=",mt_assessment.kompetensi, mt_assessment.kinerja, mt_assessment.perilaku, mt_assessment.sasaran_kinerja, mt_assessment.file_sasaran_kinerja";
        $select .=",mt_pendaftaran.status as status_seleksi ";
        //$select .=",( (mt_assessment.kinerja * 0.35) + (mt_assessment.perilaku * 0.35) + (mt_assessment.sasaran_kinerja * 0.30) )as nilai_kinerja";
        $select .= ",mt_assessment.kompetensi, mt_assessment.potensi, mt_assessment.file_kompetensi, mt_assessment.file_potensi, mt_assessment.box ";
        
        $this->db->select($select);
        $this->db->join('mt_assessment','mt_assessment.id_pendaftaran=mt_pendaftaran.id_pendaftaran','left');
        $this->db->join('mt_kebutuhan','mt_kebutuhan.id_kebutuhan=mt_pendaftaran.id_kebutuhan','left');
        $this->db->join('pegawai','pegawai.id_pegawai=mt_pendaftaran.id_pegawai','left');

        $this->db->join('ref_skpd','ref_skpd.id_skpd=mt_kebutuhan.id_skpd','left');
        $this->db->join('ref_jabatan','ref_jabatan.id_jabatan=mt_kebutuhan.id_jabatan','left');
        
        $this->db->join('pegawai p2','p2.id_pegawai=mt_pendaftaran.verifikator','left');


        if($hal && $mulai)
        {
            $this->db->limit($hal,$mulai);
        }
        $this->db->order_by("mt_pendaftaran.tgl_daftar","DESC");
        $query = $this->db->get("mt_pendaftaran");
        return $query->result();
    }

    

    
    public function get_total($param=null){
        if($param!=null)
        {
            foreach($param as $key=>$value){
                $this->db->where($key,$value);
            }
        }
        $this->db->where("mt_kebutuhan.id_kebutuhan is not null");
        $this->db->where("'".date('Y-m-d')."' >= mt_kebutuhan.tanggal_buka AND mt_kebutuhan.tanggal_tutup >= '".date('Y-m-d')."' ");
        $this->db->join('mt_kebutuhan','mt_kebutuhan.id_kebutuhan=mt_pendaftaran.id_kebutuhan','left');
        
		$query = $this->db->get('mt_pendaftaran');
		return $query->num_rows();
	}

}
?>