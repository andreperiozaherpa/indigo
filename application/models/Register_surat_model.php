<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register_surat_model extends CI_Model
{

	public function surat_keluar($summary_field='',$summary_value='')
	{
    	if($this->session->userdata('level')!='Administrator'){
    		$this->db->where('id_skpd_pengirim',$this->session->userdata('id_skpd'));
    	}
		if($summary_field!=''&&$summary_value!=''){
			$this->db->where('surat_keluar.'.$summary_field,$summary_value);
		}
		$this->db->where('status_ttd','sudah_ditandatangani');
		$query = $this->db->get('surat_keluar');
		return $query->result();
	}

	public function surat_keluar_registered(){
    	if($this->session->userdata('level')!='Administrator'){
    		$this->db->where('id_skpd_pengirim',$this->session->userdata('id_skpd'));
    	}
		$this->db->where('status_ttd','sudah_ditandatangani');
		$this->db->where('status_register', "Sudah Diregistrasi");
		$query = $this->db->get('surat_keluar');
		return $query->result();
	}

	public function surat_keluar_unregistered(){
    	if($this->session->userdata('level')!='Administrator'){
    		$this->db->where('id_skpd_pengirim',$this->session->userdata('id_skpd'));
    	}
		$this->db->where('status_ttd','sudah_ditandatangani');
		$this->db->where('status_register', "Belum Diregistrasi");
		$query = $this->db->get('surat_keluar');
		return $query->result();
	}

	public function get_detail_sk_by_id($id_surat_keluar)
	{
		// $this->db->select("*, pegawai_input.nama_lengkap as nama_lengkap_input, jabatan_input.nama_jabatan as jabatan_input, pegawai_penerima.nama_lengkap as nama_lengkap_penerima, jabatan_penerima.nama_jabatan as jabatan_penerima");

		// $this->db->where('surat_masuk.id_surat_masuk',$id_surat_masuk);

		// $this->db->join('user as user_input', 'surat_masuk.id_pegawai_input = user_input.user_id', 'left');
		// $this->db->join('pegawai as pegawai_input', 'user_input.id_pegawai = pegawai_input.id_pegawai', 'left');
		// $this->db->join('ref_jabatan as jabatan_input', 'pegawai_input.id_jabatan = jabatan_input.id_jabatan', 'left');

		// $this->db->join('user as user_penerima', 'surat_masuk.id_pegawai_penerima = user_penerima.id_pegawai', 'left');
		// $this->db->join('pegawai as pegawai_penerima', 'user_penerima.id_pegawai = pegawai_penerima.id_pegawai', 'left');
		// $this->db->join('ref_jabatan as jabatan_penerima', 'pegawai_penerima.id_jabatan = jabatan_penerima.id_jabatan', 'left');

		$this->db->join('ref_skpd', 'surat_keluar.id_skpd_pengirim = ref_skpd.id_skpd');
		$query = $this->db->get('surat_keluar');
		return $query->row();
	}

	public function get_disposisi_surat_keluar_by_id_surat($id_surat_keluar)
	{
		$this->db->join('ref_unit_kerja','ref_unit_kerja.id_unit_kerja = disposisi_surat_keluar.id_unit_kerja');
		$this->db->where('id_surat_keluar',$id_surat_keluar);
		$query = $this->db->get('disposisi_surat_keluar');
		return $query->result();
	}


	public function get_page_surat_keluar($start,$end,$nomer_surat,$hal,$mulai,$summary_field='',$summary_value='')
	{
		$this->db->order_by('id_surat_keluar','desc');
    	if($this->session->userdata('level')!='Administrator'){
    		$this->db->where('id_skpd_pengirim',$this->session->userdata('id_skpd'));
    	}
		if($summary_field!=''&&$summary_value!=''){
			$this->db->where('surat_keluar.'.$summary_field,$summary_value);
		}
		if($start!=''){
			$this->db->where('tanggal_surat >=', $start);
		}
		if($end!=''){
			$this->db->where('tanggal_surat <=', $end);
		}
		if($nomer_surat!=''){
			$this->db->like('nomer_surat', $nomer_surat);
		}else{
			$this->db->limit($hal,$mulai);
		}

		$this->db->where('status_ttd','sudah_ditandatangani');

		// $this->db->group_start();
		// 	$this->db->where('surat_keluar.id_pegawai_input', $this->session->userdata('user_id'));
		// 	$this->db->or_where('surat_keluar.penerima', $this->session->userdata('id_pegawai'));
		// $this->db->group_end();

		$this->db->join('ref_skpd', 'surat_keluar.id_skpd_pengirim = ref_skpd.id_skpd');

		$query = $this->db->get('surat_keluar');
		return $query->result();
	}

	public function data_surat_keluar()
	{
		$query  =  $this->db->get('surat_keluar');
		return $query->result();
	}

	public function kirim_surat($id_surat_keluar){
		$CI =& get_instance();
		$sk = $this->db->get_where('surat_keluar',array('id_surat_keluar'=>$id_surat_keluar))->row();
		$penerima = $this->db->get_where('surat_keluar_penerima',array('id_surat_keluar'=>$id_surat_keluar))->result();
		foreach($penerima as $p){
			$insert['pengirim'] = $sk->id_skpd_pengirim;
			$insert['jenis_surat'] = $sk->jenis_surat;
			$insert['indeks'] = '';
			$insert['kode'] = '';
			$insert['no_urut'] = '';
			$insert['perihal'] = $sk->perihal;
			$insert['tanggal_surat'] = $sk->tgl_surat;
			$insert['nomer_surat'] = $sk->nomer_surat;
			$insert['sifat'] = $sk->sifat_surat;
			$insert['file_surat'] = $sk->file_ttd;
			$insert['lampiran'] = '';
			$insert['catatan'] = '';
			if($CI->session->userdata('id_pegawai')){
				$id_pegawai_input = $CI->session->userdata('id_pegawai');
			}else{
				$id_pegawai_input = 0;
			}
			$insert['id_pegawai_input'] = $id_pegawai_input;
			$insert['tgl_input'] = date('Y-m-d');
			$insert['status_surat'] = 'Belum Dibaca';
			if($sk->jenis_surat=='internal'){
				$pegawai = $this->db->get_where('pegawai',array('id_pegawai'=>$p->id_pegawai))->row();
				$insert['id_skpd_pengirim'] = $pegawai->id_skpd;
				$insert['id_unitkerja_penerima'] = $pegawai->id_unit_kerja;
				$insert['id_pegawai_penerima'] = $p->id_pegawai;
			}elseif($sk->jenis_surat=='eksternal'&&$p->jenis_penerima=='skpd'){
				$insert['id_skpd_pengirim'] = $p->id_skpd;
			}

			if($p->jenis_penerima!='non_skpd'){
				$this->db->insert('surat_masuk',$insert);
			}
		}
	}

}
?>
