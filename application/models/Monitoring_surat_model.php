<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Monitoring_surat_model extends CI_Model
{
	public $tag_id;
	public $tag_name;
	public $tag_slug;

	public function filter_surat_keluar()
	{
		if ($this->session->userdata('level') != "Administrator") {
			$this->db->group_start();
				$this->db->where('surat_keluar.id_pegawai_input', $this->session->userdata('id_pegawai'));
				$this->db->or_where('surat_keluar.id_pegawai_verifikasi', $this->session->userdata('id_pegawai'));
				$this->db->or_where('FIND_IN_SET('.$this->session->userdata('id_pegawai').', surat_keluar.id_verifikasi)');
				$this->db->or_where('surat_keluar.id_pegawai_ttd', $this->session->userdata('id_pegawai'));
				$this->db->or_where('surat_keluar.id_pegawai_penomoran', $this->session->userdata('id_pegawai'));
			$this->db->group_end();
		}
	}

	public function get_all(){
		// $this->db->where('jenis_surat', "internal");
		$this->filter_surat_keluar();
		$query = $this->db->get('surat_keluar');
		return $query->result();
	}
	
	public function get_page($mulai,$hal,$filter=''){

		$this->filter_surat_keluar();

		$this->db->select('surat_keluar.*, surat_keluar.nomer_surat AS nomer_surat,
			pegawai_input.nama_lengkap AS nama_lengkap_input, pegawai_input.nip AS nip_input, pegawai_input.foto_pegawai AS foto_input,
			pegawai_verifikasi.nama_lengkap AS nama_lengkap_verifikasi, pegawai_verifikasi.nip AS nip_verifikasi, pegawai_verifikasi.foto_pegawai AS foto_verifikasi,
			pegawai_ttd.nama_lengkap AS nama_lengkap_ttd, pegawai_ttd.nip AS nip_ttd, pegawai_ttd.foto_pegawai AS foto_ttd,
			pegawai_register.nama_lengkap AS nama_lengkap_register, pegawai_register.nip AS nip_register, pegawai_register.foto_pegawai AS foto_register,ref_surat.nama_surat
			');

		$this->db->order_by('surat_keluar.id_surat_keluar', 'DESC');

		// $this->db->offsett(0,6);
		if($filter!=''){
			foreach($filter as $key => $value){
				switch ($key) {
					case 'value':
						# code...
						break;
					
					default:
						$this->db->like('surat_keluar.'.$key,$value);
						break;
				}
				
			}
		}else{
			$this->db->limit($hal,$mulai);
		}

		// $this->db->where('surat_keluar.jenis_surat', "internal");
		// if($this->session->userdata('level_name'!=='Administrator')){
		// 	$this->db->where('surat_keluar.id_pegawai_input', $this->session->userdata('id_pegawai'));
		// }
		// $this->db->join('ref_skpd', 'surat_keluar.id_skpd_pengirim = ref_skpd.id_skpd');
		$this->db->join('ref_surat', 'surat_keluar.id_ref_surat = ref_surat.id_ref_surat', 'left');
		$this->db->join('pegawai AS pegawai_input', 'surat_keluar.id_pegawai_input = pegawai_input.id_pegawai', 'left');
		$this->db->join('pegawai AS pegawai_verifikasi', 'surat_keluar.id_pegawai_verifikasi = pegawai_verifikasi.id_pegawai', 'left');
		$this->db->join('pegawai AS pegawai_ttd', 'surat_keluar.id_pegawai_ttd = pegawai_ttd.id_pegawai', 'left');
		$this->db->join('pegawai AS pegawai_register', 'surat_keluar.id_pegawai_penomoran = pegawai_register.id_pegawai', 'left');
		$query = $this->db->get('surat_keluar');
		return $query->result();
	}

	public function get_detail_page($id){

		$this->db->select('surat_keluar.*, surat_keluar.nomer_surat AS nomer_surat,
			pegawai_input.nama_lengkap AS nama_lengkap_input, pegawai_input.nip AS nip_input, pegawai_input.foto_pegawai AS foto_input,
			pegawai_verifikasi.nama_lengkap AS nama_lengkap_verifikasi, pegawai_verifikasi.nip AS nip_verifikasi, pegawai_verifikasi.foto_pegawai AS foto_verifikasi,
			pegawai_ttd.nama_lengkap AS nama_lengkap_ttd, pegawai_ttd.nip AS nip_ttd, pegawai_ttd.foto_pegawai AS foto_ttd,
			pegawai_register.nama_lengkap AS nama_lengkap_register, pegawai_register.nip AS nip_register, pegawai_register.foto_pegawai AS foto_register,ref_surat.nama_surat
			');

		$this->db->where('surat_keluar.id_surat_keluar', $id);

		$this->db->join('ref_surat', 'surat_keluar.id_ref_surat = ref_surat.id_ref_surat', 'left');
		$this->db->join('pegawai AS pegawai_input', 'surat_keluar.id_pegawai_input = pegawai_input.id_pegawai', 'left');
		$this->db->join('pegawai AS pegawai_verifikasi', 'surat_keluar.id_pegawai_verifikasi = pegawai_verifikasi.id_pegawai', 'left');
		$this->db->join('pegawai AS pegawai_ttd', 'surat_keluar.id_pegawai_ttd = pegawai_ttd.id_pegawai', 'left');
		$this->db->join('pegawai AS pegawai_register', 'surat_keluar.id_pegawai_penomoran = pegawai_register.id_pegawai', 'left');
		$query = $this->db->get('surat_keluar');
		return $query->result();
	}

	public function filter_surat_masuk()
	{
		if($this->session->userdata('level')!='Administrator'){
			$array_privileges = explode(';', $this->session->userdata('user_privileges'));

			$this->db->group_start();
				$this->db->where('surat_masuk.id_pegawai_input', $this->session->userdata('id_pegawai'));
				$this->db->or_where('surat_masuk.id_pegawai_penerima', $this->session->userdata('id_pegawai'));

				if($this->session->userdata('kepala_skpd')=='Y' OR in_array('tu_pimpinan', $array_privileges)){
					$this->db->or_group_start();
						$this->db->where('surat_masuk.id_pegawai_penerima', '0');
						$this->db->where('surat_masuk.id_unitkerja_penerima', '0');
						$this->db->where('surat_masuk.id_skpd_penerima', $this->session->userdata('id_skpd'));
					$this->db->group_end();
				}

				$this->db->or_where_in($this->session->userdata('id_pegawai'),"SELECT id_pegawai FROM disposisi_surat_masuk WHERE disposisi_surat_masuk.id_surat_masuk = surat_masuk.id_surat_masuk", FALSE);

				$this->db->or_where_in($this->session->userdata('id_unit_kerja'),"SELECT id_unit_kerja FROM disposisi_surat_masuk WHERE disposisi_surat_masuk.id_surat_masuk = surat_masuk.id_surat_masuk AND disposisi_surat_masuk.id_pegawai IS NULL", FALSE);

				if($this->session->userdata('kepala_skpd')=='Y' OR in_array('tu_pimpinan', $array_privileges)){
					$this->db->or_where_in($this->session->userdata('id_skpd'),"SELECT id_skpd FROM disposisi_surat_masuk WHERE disposisi_surat_masuk.id_surat_masuk = surat_masuk.id_surat_masuk AND disposisi_surat_masuk.id_pegawai IS NULL AND disposisi_surat_masuk.id_unit_kerja IS NULL", FALSE);
				}

			$this->db->group_end();

		}
	}

	public function get_all_surat_masuk(){
		// $this->db->where('jenis_surat', "internal");

		$this->filter_surat_masuk();
		$query = $this->db->get('surat_masuk');
		return $query->result();
	}

	public function get_page_surat_masuk($mulai,$hal,$filter=''){

		$this->filter_surat_masuk();
		$this->db->select('*, surat_masuk.nomer_surat AS nomer_surat,
			pegawai_input.nama_lengkap AS nama_lengkap_input, pegawai_input.nip AS nip_input, pegawai_input.foto_pegawai AS foto_input,
			pegawai_penerima.nama_lengkap AS nama_lengkap_penerima, pegawai_penerima.nip AS nip_penerima, pegawai_penerima.foto_pegawai AS foto_penerima,');

		$this->db->order_by('surat_masuk.id_surat_masuk', 'DESC');

		// $this->db->offsett(0,6);
		if($filter!=''){
			foreach($filter as $key => $value){
				switch ($key) {
					case 'value':
						# code...
						break;
					
					default:
						$this->db->like('surat_masuk.'.$key,$value);
						break;
				}
				
			}
		}else{
			$this->db->limit($hal,$mulai);
		}

		// $this->db->where('surat_keluar.jenis_surat', "internal");
		// if($this->session->userdata('level_name'!=='Administrator')){
		// 	$this->db->where('surat_keluar.id_pegawai_input', $this->session->userdata('id_pegawai'));
		// }
		// $this->db->join('ref_skpd', 'surat_keluar.id_skpd_pengirim = ref_skpd.id_skpd');
		$this->db->join('pegawai AS pegawai_input', 'surat_masuk.id_pegawai_input = pegawai_input.id_pegawai', 'left');
		$this->db->join('pegawai AS pegawai_penerima', 'surat_masuk.id_pegawai_penerima = pegawai_penerima.id_pegawai', 'left');
		$this->db->join('ref_skpd AS skpd_penerima', 'surat_masuk.id_skpd_penerima = skpd_penerima.id_skpd', 'left');
		$query = $this->db->get('surat_masuk');
		return $query->result();
	}

	public function get_all_ref_surat($value='')
	{
		$this->db->order_by('nama_surat','ASC');
		$query = $this->db->get('ref_surat');
		return $query->result();
	}
}

?>