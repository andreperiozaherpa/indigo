<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Arsip_surat_model extends CI_Model
{

    public function surat_masuk($summary_field='',$summary_value='')
    {
        $this->db->order_by('id_surat_masuk','desc');
    	if($this->session->userdata('level')!='Administrator'){
    		$this->db->where('id_skpd_penerima',$this->session->userdata('id_skpd'));
    	}
        if($summary_field!=''&&$summary_value!=''){
          $this->db->where('surat_masuk.'.$summary_field,$summary_value);
        }
        $query = $this->db->get('surat_masuk');
        return $query->result();
    }

    public function surat_masuk_archived(){
    	if($this->session->userdata('level')!='Administrator'){
    		$this->db->where('id_skpd_penerima',$this->session->userdata('id_skpd'));
    	}
		$this->db->where('status_arsip', "Sudah Diarsipkan");
		$query = $this->db->get('surat_masuk');
		return $query->result();
    }

    public function surat_masuk_unarchived(){
    	if($this->session->userdata('level')!='Administrator'){
    		$this->db->where('id_skpd_penerima',$this->session->userdata('id_skpd'));
    	}
		$this->db->where('status_arsip', "Belum Diarsipkan");
		$query = $this->db->get('surat_masuk');
		return $query->result();
    }

	public function get_detail_sm_by_id($id_surat_masuk)
	{
        $this->db->select("*, pegawai_input.nama_lengkap as nama_lengkap_input, pegawai_input.jabatan as jabatan_input, pegawai_penerima.nama_lengkap as nama_lengkap_penerima, pegawai_penerima.jabatan as jabatan_penerima");

        $this->db->where('surat_masuk.id_surat_masuk',$id_surat_masuk);

        $this->db->join('user as user_input', 'surat_masuk.id_pegawai_input = user_input.id_pegawai', 'left');
        $this->db->join('pegawai as pegawai_input', 'user_input.id_pegawai = pegawai_input.id_pegawai', 'left');
        $this->db->join('ref_jabatan_baru as jabatan_input', 'pegawai_input.id_jabatan = jabatan_input.id_jabatan', 'left');

        $this->db->join('user as user_penerima', 'surat_masuk.id_pegawai_penerima = user_penerima.id_pegawai', 'left');
        $this->db->join('pegawai as pegawai_penerima', 'user_penerima.id_pegawai = pegawai_penerima.id_pegawai', 'left');
        $this->db->join('ref_jabatan as jabatan_penerima', 'pegawai_penerima.id_jabatan = jabatan_penerima.id_jabatan', 'left');

        $this->db->join('ref_skpd', 'surat_masuk.id_skpd_penerima = ref_skpd.id_skpd', 'left');
        $query = $this->db->get('surat_masuk');
        return $query->row();
	}

	public function get_disposisi_surat_masuk_by_id_surat($id_surat_masuk)
	{
		$this->db->join('ref_unit_kerja','ref_unit_kerja.id_unit_kerja = disposisi_surat_masuk.id_unit_kerja');
		$this->db->where('id_surat_masuk',$id_surat_masuk);
		$query = $this->db->get('disposisi_surat_masuk');
		return $query->result();
	}


    public function get_page_surat_masuk($mulai,$hal,$filter='',$summary_field='',$summary_value='')
    {
        $this->db->order_by('id_surat_masuk','desc');
    		if($this->session->userdata('level')!='Administrator'){
    		$this->db->where('id_skpd_penerima',$this->session->userdata('id_skpd'));
    	}
        // $this->db->offsett(0,6);
        if($filter!=''){
            foreach($filter as $key => $value){
                $this->db->like($key,$value);
            }
        }else{
            $this->db->limit($hal,$mulai);
        }

        if($summary_field!=''&&$summary_value!=''){
            $this->db->where('surat_masuk.'.$summary_field,$summary_value);
        }

		// $this->db->group_start();
		// 	$this->db->where('surat_masuk.id_pegawai_input', $this->session->userdata('user_id'));
		// 	$this->db->or_where('surat_masuk.id_pegawai_penerima', $this->session->userdata('id_pegawai'));
		// $this->db->group_end();

		$this->db->join('ref_skpd', 'surat_masuk.id_skpd_penerima = ref_skpd.id_skpd');
        
        $this->db->join('pegawai','pegawai.id_pegawai = surat_masuk.id_pegawai_input','left');
		$this->db->join('ref_skpd as skpd_pengirim', 'skpd_pengirim.id_skpd = pegawai.id_skpd','left');

        $this->db->select('surat_masuk.*,ref_skpd.*,skpd_pengirim.nama_skpd as skpd_pengirim');


		$query = $this->db->get('surat_masuk');
		return $query->result();
    }

    public function data_surat_keluar()
    {
        $query  =  $this->db->get('surat_keluar');
        return $query->result();
    }

}
?>
