<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Surat_keluar_model extends CI_Model
{

	//Surat Eksternal
	public function get_all_eksternal($summary_field = '', $summary_value = '')
	{
		if ($summary_field != '' && $summary_value != '') {
			if ($summary_field == 'status_surat') {
				if ($summary_value == "dalam_proses") {
					$this->db->group_start();
					$this->db->where('status_verifikasi', 'menunggu_verifikasi');
					$this->db->or_group_start();
					$this->db->where('status_penomoran', 'N');
					$this->db->where('status_verifikasi', 'sudah_diverifikasi');
					$this->db->group_end();
					$this->db->or_group_start();
					$this->db->where('status_penomoran', 'Y');
					$this->db->where('status_ttd', 'menunggu_verifikasi');
					$this->db->group_end();
					$this->db->group_end();
				} elseif ($summary_value == "selesai") {
					$this->db->where('status_ttd', 'sudah_ditandatangani');
				} elseif ($summary_value == "perlu_tanggapan") {
					$this->db->group_start();
					$this->db->where('status_verifikasi', NULL);
					$this->db->or_where('status_verifikasi', "ditolak");
					$this->db->or_where('status_ttd', "ditolak");
					$this->db->group_end();
				}
			} else {
				$this->db->where('surat_keluar.' . $summary_field, $summary_value);
			}
		}
		$this->db->where('jenis_surat', "eksternal");
		$this->db->where('status_register !=', "Sudah Diregistrasi");
		$this->filter_user();
		$query = $this->db->get('surat_keluar');
		return $query->result();
	}

	public function get_all_eksternal_unread()
	{
		$this->db->where('jenis_surat', "eksternal");
		$this->db->where('status_surat', "Belum Dibaca");
		$this->db->where('status_register !=', "Sudah Diregistrasi");
		$this->filter_user();
		$query = $this->db->get('surat_keluar');
		return $query->result();
	}

	public function get_all_eksternal_read()
	{
		$this->db->where('jenis_surat', "eksternal");
		$this->db->where('status_surat', "Sudah Dibaca");
		$this->db->where('status_register !=', "Sudah Diregistrasi");
		$this->filter_user();
		$query = $this->db->get('surat_keluar');
		return $query->result();
	}

	public function get_all_eksternal_mustread()
	{
		$this->db->where('jenis_surat', "eksternal");
		$this->db->where('status_surat', "Perlu Tanggapan");
		$this->db->where('status_register !=', "Sudah Diregistrasi");
		$this->filter_user();
		$query = $this->db->get('surat_keluar');
		return $query->result();
	}

	public function get_all_eksternal_verif()
	{
		$this->db->where('jenis_surat', "eksternal");
		$this->db->where('status_verifikasi', "Sudah Diverifikasi");
		$this->db->where('status_register !=', "Sudah Diregistrasi");
		$this->filter_user();
		$query = $this->db->get('surat_keluar');
		return $query->result();
	}

	public function get_all_eksternal_unverif()
	{
		$this->db->where('jenis_surat', "eksternal");
		$this->db->where('status_verifikasi', "Belum Diverifikasi");
		$this->db->where('status_register !=', "Sudah Diregistrasi");
		$this->filter_user();
		$query = $this->db->get('surat_keluar');
		return $query->result();
	}

	public function get_all_eksternal_mustverif()
	{
		$this->db->where('jenis_surat', "eksternal");
		$this->db->where('status_verifikasi', "Perlu Diverifikasi");
		$this->db->where('status_register !=', "Sudah Diregistrasi");
		$this->filter_user();
		$query = $this->db->get('surat_keluar');
		return $query->result();
	}

	public function get_all_eksternal_sign()
	{
		$this->db->where('jenis_surat', "eksternal");
		$this->db->where('status_ttd', "sudah_ditandatangani");
		$this->db->where('status_penomoran', "Y");
		$this->db->where('status_register !=', "Sudah Diregistrasi");
		$this->filter_user("ttd");
		$query = $this->db->get('surat_keluar');
		return $query->result();
	}

	public function get_all_eksternal_unsign()
	{
		$this->db->where('jenis_surat', "eksternal");
		$this->db->where('status_ttd', "menunggu_verifikasi");
		$this->db->where('status_penomoran', "Y");
		$this->db->where('status_register !=', "Sudah Diregistrasi");
		$this->filter_user("ttd");
		$query = $this->db->get('surat_keluar');
		return $query->result();
	}

	public function get_all_eksternal_tolak()
	{
		$this->db->where('jenis_surat', "eksternal");
		$this->db->where('status_ttd', "ditolak");
		$this->db->where('status_penomoran', "Y");
		$this->db->where('status_register !=', "Sudah Diregistrasi");
		$this->filter_user("ttd");
		$query = $this->db->get('surat_keluar');
		return $query->result();
	}


	//Surat Internal
	public function get_all_internal($summary_field = '', $summary_value = '')
	{
		if ($summary_field != '' && $summary_value != '') {
			if ($summary_field == 'status_surat') {
				if ($summary_value == "dalam_proses") {
					$this->db->group_start();
					$this->db->where('status_verifikasi', 'menunggu_verifikasi');
					$this->db->or_group_start();
					$this->db->where('status_penomoran', 'N');
					$this->db->where('status_verifikasi', 'sudah_diverifikasi');
					$this->db->group_end();
					$this->db->or_group_start();
					$this->db->where('status_penomoran', 'Y');
					$this->db->where('status_ttd', 'menunggu_verifikasi');
					$this->db->group_end();
					$this->db->group_end();
				} elseif ($summary_value == "selesai") {
					$this->db->where('status_ttd', 'sudah_ditandatangani');
				} elseif ($summary_value == "perlu_tanggapan") {
					$this->db->group_start();
					$this->db->where('status_verifikasi', NULL);
					$this->db->or_where('status_verifikasi', "ditolak");
					$this->db->or_where('status_ttd', "ditolak");
					$this->db->group_end();
				}
			} else {
				$this->db->where('surat_keluar.' . $summary_field, $summary_value);
			}
		}
		$this->db->where('jenis_surat', "internal");
		$this->db->where('status_register !=', "Sudah Diregistrasi");
		$this->filter_user();
		$query = $this->db->get('surat_keluar');
		return $query->result();
	}
	public function get_all_internal_verifikasi($summary_field = '', $summary_value = '')
	{
		if ($summary_field != '' && $summary_value != '') {
			$this->db->where('surat_keluar.' . $summary_field, $summary_value);
		}
		$this->db->where('jenis_surat', "internal");
		$this->db->where('status_verifikasi is not null');
		$this->db->where('status_register !=', "Sudah Diregistrasi");
		$this->filter_user('verifikator');
		$query = $this->db->get('surat_keluar');
		return $query->result();
	}
	public function get_internal_verifikasi($status_verifikasi)
	{
		$this->db->where('jenis_surat', "internal");
		$this->db->where('status_verifikasi', $status_verifikasi);
		$this->db->where('status_register !=', "Sudah Diregistrasi");
		$this->filter_user('verifikator');
		$query = $this->db->get('surat_keluar');
		return $query->result();
	}
	public function get_eksternal_verifikasi($status_verifikasi)
	{
		$this->db->where('jenis_surat', "eksternal");
		$this->db->where('status_verifikasi', $status_verifikasi);
		$this->db->where('status_register !=', "Sudah Diregistrasi");
		$this->filter_user('verifikator');
		$query = $this->db->get('surat_keluar');
		return $query->result();
	}
	public function get_all_penomoran($summary_field = '', $summary_value = '')
	{
		if ($summary_field != '' && $summary_value != '') {
			$this->db->where('surat_keluar.' . $summary_field, $summary_value);
		}
		// $this->db->where('jenis_surat', "internal");
		$this->db->where('status_verifikasi', "sudah_diverifikasi");
		// $this->db->where('status_ttd', "menunggu_verifikasi");
		// $this->db->where('status_register !=', "Sudah Diregistrasi");
		// $this->filter_user("ttd");
		$this->filter_penomoran();
		$query = $this->db->get('surat_keluar');
		return $query->result();
	}
	public function get_all_penomoran_y()
	{
		// $this->db->where('jenis_surat', "internal");
		$this->db->where('status_verifikasi', "sudah_diverifikasi");
		// $this->db->where('status_ttd', "menunggu_verifikasi");
		$this->db->where('status_penomoran', "Y");
		// $this->db->where('status_register !=', "Sudah Diregistrasi");
		// $this->filter_user("ttd");
		$this->filter_penomoran();
		$query = $this->db->get('surat_keluar');
		return $query->result();
	}
	public function get_all_penomoran_n()
	{
		// $this->db->where('jenis_surat', "internal");
		$this->db->where('status_verifikasi', "sudah_diverifikasi");
		// $this->db->where('status_ttd', "menunggu_verifikasi");
		$this->db->where('status_penomoran', "N");
		// $this->db->where('status_register !=', "Sudah Diregistrasi");
		// $this->filter_user("ttd");
		$this->filter_penomoran();
		$query = $this->db->get('surat_keluar');
		return $query->result();
	}
	public function get_all_penomoran_t()
	{
		// $this->db->where('jenis_surat', "internal");
		$this->db->where('status_verifikasi', "sudah_diverifikasi");
		// $this->db->where('status_ttd', "menunggu_verifikasi");
		$this->db->where('status_penomoran', "T");
		// $this->db->where('status_register !=', "Sudah Diregistrasi");
		// $this->filter_user("ttd");
		$this->filter_penomoran();
		$query = $this->db->get('surat_keluar');
		return $query->result();
	}

	public function get_all_internal_unread()
	{
		$this->db->where('jenis_surat', "internal");
		$this->db->where('status_surat', "Belum Dibaca");
		$this->db->where('status_register !=', "Sudah Diregistrasi");
		$this->filter_user();
		$query = $this->db->get('surat_keluar');
		return $query->result();
	}

	public function get_all_internal_read()
	{
		$this->db->where('jenis_surat', "internal");
		$this->db->where('status_surat', "Sudah Dibaca");
		$this->db->where('status_register !=', "Sudah Diregistrasi");
		$this->filter_user();
		$query = $this->db->get('surat_keluar');
		return $query->result();
	}

	public function get_all_internal_mustread()
	{
		$this->db->where('jenis_surat', "internal");
		$this->db->where('status_surat', "Perlu Tanggapan");
		$this->db->where('status_register !=', "Sudah Diregistrasi");
		$this->filter_user();
		$query = $this->db->get('surat_keluar');
		return $query->result();
	}

	public function get_all_internal_verif()
	{
		$this->db->where('jenis_surat', "internal");
		$this->db->where('status_verifikasi', "Sudah Diverifikasi");
		$this->db->where('status_register !=', "Sudah Diregistrasi");
		$this->filter_user();
		$query = $this->db->get('surat_keluar');
		return $query->result();
	}

	public function get_all_internal_unverif()
	{
		$this->db->where('jenis_surat', "internal");
		$this->db->where('status_verifikasi', "Belum Diverifikasi");
		$this->db->where('status_register !=', "Sudah Diregistrasi");
		$this->filter_user();
		$query = $this->db->get('surat_keluar');
		return $query->result();
	}

	public function get_all_internal_mustverif()
	{
		$this->db->where('jenis_surat', "internal");
		$this->db->where('status_verifikasi', "Perlu Diverifikasi");
		$this->db->where('status_register !=', "Sudah Diregistrasi");
		$this->filter_user();
		$query = $this->db->get('surat_keluar');
		return $query->result();
	}

	public function get_all_internal_sign()
	{
		$this->db->where('jenis_surat', "internal");
		$this->db->where('status_ttd', "sudah_ditandatangani");
		$this->db->where('status_penomoran', "Y");
		$this->db->where('status_register !=', "Sudah Diregistrasi");
		$this->filter_user("ttd");
		$query = $this->db->get('surat_keluar');
		return $query->result();
	}

	public function get_all_internal_unsign()
	{
		$this->db->where('jenis_surat', "internal");
		$this->db->where('status_ttd', "menunggu_verifikasi");
		$this->db->where('status_penomoran', "Y");
		$this->db->where('status_register !=', "Sudah Diregistrasi");
		$this->filter_user("ttd");
		$query = $this->db->get('surat_keluar');
		return $query->result();
	}

	public function get_all_internal_tolak()
	{
		$this->db->where('jenis_surat', "internal");
		$this->db->where('status_ttd', "ditolak");
		$this->db->where('status_penomoran', "Y");
		$this->db->where('status_register !=', "Sudah Diregistrasi");
		$this->filter_user("ttd");
		$query = $this->db->get('surat_keluar');
		return $query->result();
	}

	public function get_all_internal_ttd($summary_field = '', $summary_value = '')
	{

		if ($summary_field != '' && $summary_value != '') {
			$this->db->where('surat_keluar.' . $summary_field, $summary_value);
		}
		$this->db->where('jenis_surat', "internal");
		$this->db->where('status_verifikasi', "sudah_diverifikasi");
		$this->db->where('status_penomoran', "Y");
		$this->db->where('status_register !=', "Sudah Diregistrasi");
		$this->filter_user("ttd");
		$query = $this->db->get('surat_keluar');
		return $query->result();
	}

	public function get_all_eksternal_ttd($summary_field = '', $summary_value = '')
	{

		if ($summary_field != '' && $summary_value != '') {
			$this->db->where('surat_keluar.' . $summary_field, $summary_value);
		}
		$this->db->where('jenis_surat', "eksternal");
		$this->db->where('status_verifikasi', "sudah_diverifikasi");
		$this->db->where('status_penomoran', "Y");
		$this->db->where('status_register !=', "Sudah Diregistrasi");
		$this->filter_user("ttd");
		$query = $this->db->get('surat_keluar');
		return $query->result();
	}


	//
	public function get_page_internal($mulai, $hal, $filter = '', $summary_field = '', $summary_value = '')
	{
		// $this->db->offsett(0,6);
		if ($filter != '') {
			foreach ($filter as $key => $value) {
				$this->db->like($key, $value);
			}
		} else {
			$this->db->limit($hal, $mulai);
		}

		if ($summary_field != '' && $summary_value != '') {
			if ($summary_field == 'status_surat') {
				if ($summary_value == "dalam_proses") {
					$this->db->group_start();
					$this->db->where('status_verifikasi', 'menunggu_verifikasi');
					$this->db->or_group_start();
					$this->db->where('status_penomoran', 'N');
					$this->db->where('status_verifikasi', 'sudah_diverifikasi');
					$this->db->group_end();
					$this->db->or_group_start();
					$this->db->where('status_penomoran', 'Y');
					$this->db->where('status_ttd', 'menunggu_verifikasi');
					$this->db->group_end();
					$this->db->group_end();
				} elseif ($summary_value == "selesai") {
					$this->db->where('status_ttd', 'sudah_ditandatangani');
				} elseif ($summary_value == "perlu_tanggapan") {
					$this->db->group_start();
					$this->db->where('status_verifikasi', NULL);
					$this->db->or_where('status_verifikasi', "ditolak");
					$this->db->or_where('status_ttd', "ditolak");
					$this->db->group_end();
				}
			} else {
				$this->db->where('surat_keluar.' . $summary_field, $summary_value);
			}
		}

		$this->db->where('surat_keluar.jenis_surat', "internal");
		$this->db->where('status_register !=', "Sudah Diregistrasi");
		$this->filter_user();
		$this->db->join('ref_skpd', 'surat_keluar.id_skpd_pengirim = ref_skpd.id_skpd');
		$this->db->order_by('id_surat_keluar', 'DESC');
		$query = $this->db->get('surat_keluar');

        // edited by Dinar
        if (!empty($query)) {
            foreach ($query->result() as $q) {
                $q->surat_klasifikasi   = $this->db->get_where('surat_klasifikasi', array('id_surat_klasifikasi' => $q->surat_klasifikasi))->row();
            }
        }
		return $query->result();
	}

	public function filter_user($cek = NULL)
	{
		if ($this->session->userdata('level') != 'Administrator') {
			// $this->db->group_start();
			if ($cek == "verifikator") {
				$this->db->where('surat_keluar.id_pegawai_verifikasi', $this->session->userdata('id_pegawai'));
			} elseif ($cek == "ttd") {
				$this->db->where('surat_keluar.id_pegawai_ttd', $this->session->userdata('id_pegawai'));
			} elseif ($cek == "tembusan") {
				$this->db->where('surat_keluar_tembusan.id_pegawai', $this->session->userdata('id_pegawai'));
			} else {
				$this->db->where('surat_keluar.id_pegawai_input', $this->session->userdata('id_pegawai'));
			}
			// $this->db->group_end();
		}
	}
	//
	public function get_page_internal_verifikasi($mulai, $hal, $filter, $summary_field = '', $summary_value = '')
	{
		if ($summary_field != '' && $summary_value != '') {
			$this->db->where('surat_keluar.' . $summary_field, $summary_value);
		}
		$this->db->where('jenis_surat', "internal");
		$this->db->where('status_verifikasi is not null');
		if ($filter != '') {
			foreach ($filter as $key => $value) {
				$this->db->like($key, $value);
			}
		} else {
			$this->db->limit($hal, $mulai);
		}

		$this->db->where('surat_keluar.jenis_surat', "internal");
		$this->db->where('status_register !=', "Sudah Diregistrasi");
		$this->filter_user("verifikator");
		$this->db->join('ref_skpd', 'surat_keluar.id_skpd_pengirim = ref_skpd.id_skpd');
		$this->db->order_by('id_surat_keluar', 'DESC');
		$query = $this->db->get('surat_keluar');
		return $query->result();
	}
	//
	public function get_page_penomoran($mulai, $hal, $perihal, $hash_id, $tgl_penerimaan, $summary_field = '', $summary_value = '')
	{
		if ($summary_field != '' && $summary_value != '') {
			$this->db->where('surat_keluar.' . $summary_field, $summary_value);
		}
		$this->db->where('status_verifikasi', "sudah_diverifikasi");
		// $this->db->where('status_ttd', "menunggu_verifikasi");

		if ($perihal != '') {
			$this->db->like('perihal', $perihal);
		}
		if ($hash_id != '') {
			$this->db->like('nomer_surat >=', $hash_id);
		}
		if ($tgl_penerimaan != '') {
			$this->db->like('tgl_surat ', $tgl_penerimaan);
		}

		$this->filter_penomoran();

		$this->db->limit($hal, $mulai);

		$this->db->join('ref_skpd', 'surat_keluar.id_skpd_pengirim = ref_skpd.id_skpd');
		$this->db->join('pegawai as pegawai_input', 'pegawai_input.id_pegawai = surat_keluar.id_pegawai_input');
		$this->db->join('ref_unit_kerja as unit_kerja_input', 'unit_kerja_input.id_unit_kerja = pegawai_input.id_unit_kerja', 'left');
		$this->db->order_by('tgl_verifikasi', 'DESC');
		$this->db->order_by('id_surat_keluar', 'DESC');
		$this->db->select('*,pegawai_input.nama_lengkap as nama_pegawai_input,unit_kerja_input.nama_unit_kerja as nama_unit_kerja_input');
		$query = $this->db->get('surat_keluar');
		return $query->result();
	}

	function filter_penomoran()
	{
		//ID TU PIMPINAN SEKDA = 1
		if ($this->session->userdata('level') != 'Administrator') {
			if ($this->session->userdata('id_skpd') == "1") {
				$this->db->group_start();
				$this->db->where('kop_surat', $this->session->userdata('id_skpd'));
				$this->db->or_where('kop_surat', "sekda");
				$this->db->or_where('kop_surat', "bupati");
				$this->db->or_where('kop_surat', "");
				$this->db->or_where('kop_surat', NULL);
				$this->db->group_end();
			} else {
				$this->db->where('kop_surat', $this->session->userdata('id_skpd'));
			}
		}
	}
	//
	public function get_page_internal_ttd($mulai, $hal, $filter = '', $summary_field = '', $summary_value = '')
	{

		if ($summary_field != '' && $summary_value != '') {
			$this->db->where('surat_keluar.' . $summary_field, $summary_value);
		}
		// $this->db->offsett(0,6);
		if ($filter != '') {
			foreach ($filter as $key => $value) {
				$this->db->like($key, $value);
			}
		} else {
			$this->db->limit($hal, $mulai);
		}
		$this->db->where('jenis_surat', "internal");
		$this->db->where('status_verifikasi', "sudah_diverifikasi");
		$this->db->where('status_penomoran', "Y");
		$this->db->where('status_register !=', "Sudah Diregistrasi");
		$this->filter_user("ttd");
		$this->db->join('ref_skpd', 'surat_keluar.id_skpd_pengirim = ref_skpd.id_skpd');
		$this->db->order_by('id_surat_keluar', 'DESC');
		$query = $this->db->get('surat_keluar');
		return $query->result();
	}
	//
	public function get_page_eksternal_ttd($mulai, $hal, $filter = '', $summary_field = '', $summary_value = '')
	{

		if ($summary_field != '' && $summary_value != '') {
			$this->db->where('surat_keluar.' . $summary_field, $summary_value);
		}
		$this->db->where('jenis_surat', "eksternal");
		$this->db->where('status_verifikasi', "sudah_diverifikasi");
		$this->db->where('status_penomoran', "Y");
		if ($filter != '') {
			foreach ($filter as $key => $value) {
				$this->db->like($key, $value);
			}
		} 
		else {
			$this->db->limit($hal, $mulai);
		}

		$this->db->where('surat_keluar.jenis_surat', "eksternal");
		$this->db->where('status_register !=', "Sudah Diregistrasi");
		$this->filter_user("ttd");
		$this->db->join('ref_skpd', 'surat_keluar.id_skpd_pengirim = ref_skpd.id_skpd');
		$this->db->order_by('id_surat_keluar', 'DESC');
		$query = $this->db->get('surat_keluar');

		return $query->result();
	}


	//
	public function get_page_eksternal($mulai, $hal, $filter = '', $summary_field = '', $summary_value = '')
	{
		// $this->db->offsett(0,6);
		if ($filter != '') {
			foreach ($filter as $key => $value) {
				if($key=='id_skpd_pengirim'){
					$this->db->where($key, $value);
				}else{
					$this->db->like($key, $value);
				}
			}
		} 
		else {
			$this->db->limit($hal, $mulai);
		}

		if ($summary_field != '' && $summary_value != '') {
			if ($summary_field == 'status_surat') {
				if ($summary_value == "dalam_proses") {
					$this->db->group_start();
					$this->db->where('status_verifikasi', 'menunggu_verifikasi');
					$this->db->or_group_start();
					$this->db->where('status_penomoran', 'N');
					$this->db->where('status_verifikasi', 'sudah_diverifikasi');
					$this->db->group_end();
					$this->db->or_group_start();
					$this->db->where('status_penomoran', 'Y');
					$this->db->where('status_ttd', 'menunggu_verifikasi');
					$this->db->group_end();
					$this->db->group_end();
				} elseif ($summary_value == "selesai") {
					$this->db->where('status_ttd', 'sudah_ditandatangani');
				} elseif ($summary_value == "perlu_tanggapan") {
					$this->db->group_start();
					$this->db->where('status_verifikasi', NULL);
					$this->db->or_where('status_verifikasi', "ditolak");
					$this->db->or_where('status_ttd', "ditolak");
					$this->db->group_end();
				}
			} else {
				$this->db->where('surat_keluar.' . $summary_field, $summary_value);
			}
		}

		$this->db->where('surat_keluar.jenis_surat', "eksternal");
		$this->db->where('status_register !=', "Sudah Diregistrasi");
		$this->filter_user();
		$this->db->join('ref_skpd', 'surat_keluar.id_skpd_pengirim = ref_skpd.id_skpd');
		$this->db->order_by('id_surat_keluar', 'DESC');
		$query = $this->db->get('surat_keluar');

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $q) {
                $q->surat_klasifikasi       = $this->db->get_where('surat_klasifikasi', array('id_surat_klasifikasi' => $q->surat_klasifikasi))->row();
            }
        }
		return $query->result();
	}

	public function get_all_eksternal_verifikasi($summary_field = '', $summary_value = '')
	{
		if ($summary_field != '' && $summary_value != '') {
			$this->db->where('surat_keluar.' . $summary_field, $summary_value);
		}
		$this->db->where('jenis_surat', "eksternal");
		$this->db->where('status_verifikasi is not null');
		$this->db->where('status_register !=', "Sudah Diregistrasi");
		$this->filter_user("verifikator");
		$this->db->order_by('id_surat_keluar', 'DESC');
		$query = $this->db->get('surat_keluar');
		return $query->result();
	}
	//
	public function get_page_eksternal_verifikasi($mulai, $hal, $filter = '', $summary_field = '', $summary_value = '')
	{
		if ($summary_field != '' && $summary_value != '') {
			$this->db->where('surat_keluar.' . $summary_field, $summary_value);
		}
		// $this->db->offsett(0,6);
		$this->db->where('jenis_surat', "eksternal");
		$this->db->where('status_verifikasi is not null');
		$this->db->where('status_register !=', "Sudah Diregistrasi");
		if ($filter != '') {
			foreach ($filter as $key => $value) {
				$this->db->like($key, $value);
			}
		} else {
			$this->db->limit($hal, $mulai);
		}

		$this->db->where('surat_keluar.jenis_surat', "eksternal");
		$this->filter_user("verifikator");
		$this->db->join('ref_skpd', 'surat_keluar.id_skpd_pengirim = ref_skpd.id_skpd');
		$this->db->order_by('id_surat_keluar', 'DESC');
		$query = $this->db->get('surat_keluar');
		return $query->result();
	}

	public function get_page($mulai, $hal, $filter = '')
	{

		$this->db->select('surat_keluar.*, surat_keluar.nomer_surat AS nomer_surat,
			pegawai_input.nama_lengkap AS nama_lengkap_input, pegawai_input.nip AS nip_input, pegawai_input.foto_pegawai AS foto_input,
			pegawai_verifikasi.nama_lengkap AS nama_lengkap_verifikasi, pegawai_verifikasi.nip AS nip_verifikasi, pegawai_verifikasi.foto_pegawai AS foto_verifikasi,
			pegawai_ttd.nama_lengkap AS nama_lengkap_ttd, pegawai_ttd.nip AS nip_ttd, pegawai_ttd.foto_pegawai AS foto_ttd,
			pegawai_register.nama_lengkap AS nama_lengkap_register, pegawai_register.nip AS nip_register, pegawai_register.foto_pegawai AS foto_register,ref_surat.nama_surat
			');

		$this->db->join('ref_surat', 'surat_keluar.id_ref_surat = ref_surat.id_ref_surat', 'left');
		$this->db->join('pegawai AS pegawai_input', 'surat_keluar.id_pegawai_input = pegawai_input.id_pegawai', 'left');
		$this->db->join('pegawai AS pegawai_verifikasi', 'surat_keluar.id_pegawai_verifikasi = pegawai_verifikasi.id_pegawai', 'left');
		$this->db->join('pegawai AS pegawai_ttd', 'surat_keluar.id_pegawai_ttd = pegawai_ttd.id_pegawai', 'left');
		$this->db->join('pegawai AS pegawai_register', 'surat_keluar.id_pegawai_register = pegawai_register.id_pegawai', 'left');
		$query = $this->db->get('surat_keluar');
		return $query->result();
	}

	public function get_detail_by_id($id)
	{
		$this->db->select("surat_keluar.*,ref_skpd.*,ref_surat.nama_surat,verifikator.app_token as 'app_token_verifikator', ttd.app_token as 'app_token_ttd',verifikator.full_name as 'full_name_verifikator', ttd.full_name as 'full_name_ttd',verifikator.user_id as 'id_user_verifikator' ,input.user_id as 'id_user_input', ttd.user_id as 'id_user_ttd', 
			pegawai_input.nama_lengkap AS nama_lengkap_input, pegawai_input.nip AS nip_input, pegawai_input.foto_pegawai AS foto_input,
			pegawai_verifikasi.nama_lengkap AS nama_lengkap_verifikasi, pegawai_verifikasi.nip AS nip_verifikasi, pegawai_verifikasi.foto_pegawai AS foto_verifikasi,
			pegawai_ttd.nama_lengkap AS nama_lengkap_ttd, pegawai_ttd.nip AS nip_ttd, pegawai_ttd.foto_pegawai AS foto_ttd,
			pegawai_register.nama_lengkap AS nama_lengkap_register, pegawai_register.nip AS nip_register, pegawai_register.foto_pegawai AS foto_register,ref_surat.nama_surat
			,unit_kerja_input.nama_unit_kerja as nama_unit_kerja_input");
		$this->db->where('surat_keluar.id_surat_keluar', $id);
		$this->db->join('ref_skpd', 'surat_keluar.id_skpd_pengirim = ref_skpd.id_skpd', 'left');
		$this->db->join('ref_surat', 'ref_surat.id_ref_surat = surat_keluar.id_ref_surat', 'left');
		$this->db->join('user as verifikator', 'verifikator.id_pegawai = surat_keluar.id_pegawai_verifikasi', 'left');
		$this->db->join('user as ttd', 'ttd.id_pegawai = surat_keluar.id_pegawai_ttd', 'left');
		$this->db->join('user as input', 'input.id_pegawai = surat_keluar.id_pegawai_input', 'left');
		//
		$this->db->join('pegawai AS pegawai_input', 'surat_keluar.id_pegawai_input = pegawai_input.id_pegawai', 'left');
		$this->db->join('ref_unit_kerja AS unit_kerja_input', 'pegawai_input.id_unit_kerja = unit_kerja_input.id_unit_kerja', 'left');
		$this->db->join('pegawai AS pegawai_verifikasi', 'surat_keluar.id_pegawai_verifikasi = pegawai_verifikasi.id_pegawai', 'left');
		$this->db->join('pegawai AS pegawai_ttd', 'surat_keluar.id_pegawai_ttd = pegawai_ttd.id_pegawai', 'left');
		$this->db->join('pegawai AS pegawai_register', 'surat_keluar.id_pegawai_register = pegawai_register.id_pegawai', 'left');
		$query = $this->db->get('surat_keluar');
		return $query->row();
	}

	public function get_detail_verifikasi_by_id($id)
	{
		$this->db->where('surat_keluar_verifikasi.id_surat_keluar', $id);
		$this->db->join('pegawai', 'pegawai.id_pegawai = surat_keluar_verifikasi.id_pegawai_verifikasi', 'left');
		$this->db->join('ref_jabatan_baru', 'pegawai.id_jabatan = ref_jabatan_baru.id_jabatan', 'left');
		$query = $this->db->get('surat_keluar_verifikasi');
		return $query->result();
	}

	public function get_detail_by_id_d($id)
	{
		$this->db->where('id_surat_keluar', $id);
		$query = $this->db->get('surat_keluar');
		return $query->row();
	}

	public function get_penerima($id_surat_keluar)
	{
		$this->db->where('id_surat_keluar', $id_surat_keluar);
		$query = $this->db->get('surat_keluar_penerima')->result();
		foreach ($query as $n => $q) {
			if ($q->jenis_surat == 'internal') {
				$pegawai = $this->db->get_where('pegawai', array('id_pegawai' => $q->id_pegawai))->row();
				$jabatan = (isset($pegawai->jabatan)) ? $pegawai->jabatan : "-"; //$this->db->get_where('ref_jabatan',array('id_jabatan'=>$pegawai->id_jabatan))->row();
				$one = (array) $query[$n];
				$two = (array) $pegawai;
				if (!empty($jabatan)) {
					$three = array('nama_jabatan' => $jabatan); //(array) $jabatan;
				} else {
					if ($pegawai->kepala_skpd == "Y") {
						$skpd = $this->db->get_where('ref_skpd', array('id_skpd' => $pegawai->id_skpd))->row();
						$three = array('nama_jabatan' => 'Kepala SKPD ' . $skpd->nama_skpd);
					} else {
						$three = array('nama_jabatan' => '-');
					}
				}
				$query[$n] = array_merge($one, $two, $three);
			} elseif ($q->jenis_surat == 'eksternal' && $q->jenis_penerima == 'skpd') {
				$skpd = $this->db->get_where('ref_skpd', array('id_skpd' => $q->id_skpd))->row();
				$one = (array) $query[$n];
				$two = (array) $skpd;
				$query[$n] = array_merge($one, $two);
			}
		}
		$query = json_decode(json_encode($query));
		return $query;
	}

	public function baca_surat($id)
	{
		$this->db->where('id_surat_keluar', $id);
		$this->db->set('status_surat', 'Sudah Dibaca');
		$this->db->update('surat_keluar');
	}



	public function hapus_surat_keluar($id)
	{
		$this->db->where('id_surat_keluar', $this->id_surat_keluar);
		$query = $this->db->delete('surat_keluar');
	}

	public function get_total_surat_keluar()
	{
		$query = $this->db->get('surat_keluar');
		return $query->num_rows();
	}

	public function get_total_surat_dibaca()
	{
		$this->db->where('status_surat', 'Dibaca');
		$query = $this->db->get('surat_keluar');
		return $query->num_rows();
	}

	public function get_total_surat_belum_dibaca()
	{
		$this->db->where('status_surat', 'Belum Dibaca');
		$query = $this->db->get('surat_keluar');
		return $query->num_rows();
	}

	public function insert_surat_keluar($data)
	{
		$q = $this->db->insert('surat_keluar', $data);
		return $this->db->insert_id();
	}

	public function update_surat_keluar($data, $id_surat_keluar, $trigger = null)
	{
		if ($trigger) {
			$get_q = $this->db->get_where('surat_keluar', array('id_surat_keluar' => $id_surat_keluar))->row();

			$trigger['data']['id_surat_keluar'] = $get_q->id_surat_keluar;
			$trigger['data']['id_pegawai_verifikasi'] = $get_q->id_pegawai_verifikasi;

			if ($trigger['update'] == "verifikasi") {

				$data['id_pegawai_verifikasi'] = $trigger['data']['id_pegawai_verifikasi_teruskan'];
				unset($trigger['data']['id_pegawai_verifikasi_teruskan']);
				if ($get_q->id_verifikasi) {
					$array_id_verifikasi = explode(',', $get_q->id_verifikasi);
					array_push($array_id_verifikasi, $this->session->userdata('id_pegawai'));
					$data['id_verifikasi'] = implode(',', $array_id_verifikasi);
				} else {
					$data['id_verifikasi'] = $this->session->userdata('id_pegawai');
				}

				$q_v = $this->db->insert('surat_keluar_verifikasi', $trigger['data']);
			}
		}
		$q = $this->db->update('surat_keluar', $data, array('id_surat_keluar' => $id_surat_keluar));
	}

	public function insert_penerima_surat($data, $id_surat_keluar, $jenis)
	{
		$this->db->set('jenis_surat', $jenis);
		$this->db->set('id_surat_keluar', $id_surat_keluar);
		$q = $this->db->insert('surat_keluar_penerima', $data);
		return $this->db->insert_id();
	}

	public function insert_tembusan_surat($id_pegawai, $id_surat_keluar)
	{
		$q = $this->db->insert('surat_keluar_tembusan', array('id_pegawai' => $id_pegawai, 'id_surat_keluar' => $id_surat_keluar));
		return $this->db->insert_id();
	}

	public function delete_penerima_surat($id_surat_keluar)
	{
		$q = $this->db->delete('surat_keluar_penerima', array('id_surat_keluar' => $id_surat_keluar));
	}

	public function delete_tembusan_surat($id_surat_keluar)
	{
		$q = $this->db->delete('surat_keluar_tembusan', array('id_surat_keluar' => $id_surat_keluar));
	}


	public function delete_surat_keluar($id = NULL)
	{
		$this->db->where('id_surat_keluar', $id);
		$query = $this->db->delete('surat_keluar');
		$this->db->where('id_surat_keluar', $id);
		$query = $this->db->delete('surat_keluar_tembusan');
		$this->db->where('id_surat_keluar', $id);
		$query = $this->db->delete('surat_keluar_penerima');
		$this->db->where('id_surat_keluar', $id);
		$query = $this->db->delete('disposisi_surat_keluar');
		// redirect('tujuan');
	}

	public function get_all_eksternal_grafik_jan($year, $id_skpd)
	{
		$this->db->select('MONTH(tgl_surat) as bln, COUNT(tgl_surat) as total');
		$this->db->where('YEAR(tgl_surat)', $year);
		$this->db->where('jenis_surat', "eksternal");
		$this->db->where('MONTH(tgl_surat)', 1);
		$this->db->where('id_skpd_pengirim', $id_skpd);
		$query = $this->db->get('surat_keluar');
		return $query->row_array();
	}
	public function get_all_eksternal_grafik_feb($year, $id_skpd)
	{
		$this->db->select('MONTH(tgl_surat) as bln, COUNT(tgl_surat) as total');
		$this->db->where('YEAR(tgl_surat)', $year);
		$this->db->where('jenis_surat', "eksternal");
		$this->db->where('MONTH(tgl_surat)', 2);
		$this->db->where('id_skpd_pengirim', $id_skpd);
		$query = $this->db->get('surat_keluar');
		return $query->row_array();
	}
	public function get_all_eksternal_grafik_mar($year, $id_skpd)
	{
		$this->db->select('MONTH(tgl_surat) as bln, COUNT(tgl_surat) as total');
		$this->db->where('YEAR(tgl_surat)', $year);
		$this->db->where('jenis_surat', "eksternal");
		$this->db->where('MONTH(tgl_surat)', 3);
		$this->db->where('id_skpd_pengirim', $id_skpd);
		$query = $this->db->get('surat_keluar');
		return $query->row_array();
	}
	public function get_all_eksternal_grafik_apr($year, $id_skpd)
	{
		$this->db->select('MONTH(tgl_surat) as bln, COUNT(tgl_surat) as total');
		$this->db->where('YEAR(tgl_surat)', $year);
		$this->db->where('jenis_surat', "eksternal");
		$this->db->where('MONTH(tgl_surat)', 4);
		$this->db->where('id_skpd_pengirim', $id_skpd);
		$query = $this->db->get('surat_keluar');
		return $query->row_array();
	}
	public function get_all_eksternal_grafik_mei($year, $id_skpd)
	{
		$this->db->select('MONTH(tgl_surat) as bln, COUNT(tgl_surat) as total');
		$this->db->where('YEAR(tgl_surat)', $year);
		$this->db->where('jenis_surat', "eksternal");
		$this->db->where('MONTH(tgl_surat)', 5);
		$this->db->where('id_skpd_pengirim', $id_skpd);
		$query = $this->db->get('surat_keluar');
		return $query->row_array();
	}
	public function get_all_eksternal_grafik_jun($year, $id_skpd)
	{
		$this->db->select('MONTH(tgl_surat) as bln, COUNT(tgl_surat) as total');
		$this->db->where('YEAR(tgl_surat)', $year);
		$this->db->where('jenis_surat', "eksternal");
		$this->db->where('MONTH(tgl_surat)', 6);
		$this->db->where('id_skpd_pengirim', $id_skpd);
		$query = $this->db->get('surat_keluar');
		return $query->row_array();
	}
	public function get_all_eksternal_grafik_jul($year, $id_skpd)
	{
		$this->db->select('MONTH(tgl_surat) as bln, COUNT(tgl_surat) as total');
		$this->db->where('YEAR(tgl_surat)', $year);
		$this->db->where('jenis_surat', "eksternal");
		$this->db->where('MONTH(tgl_surat)', 7);
		$this->db->where('id_skpd_pengirim', $id_skpd);
		$query = $this->db->get('surat_keluar');
		return $query->row_array();
	}
	public function get_all_eksternal_grafik_agu($year, $id_skpd)
	{
		$this->db->select('MONTH(tgl_surat) as bln, COUNT(tgl_surat) as total');
		$this->db->where('YEAR(tgl_surat)', $year);
		$this->db->where('jenis_surat', "eksternal");
		$this->db->where('MONTH(tgl_surat)', 8);
		$this->db->where('id_skpd_pengirim', $id_skpd);
		$query = $this->db->get('surat_keluar');
		return $query->row_array();
	}
	public function get_all_eksternal_grafik_sep($year, $id_skpd)
	{
		$this->db->select('MONTH(tgl_surat) as bln, COUNT(tgl_surat) as total');
		$this->db->where('YEAR(tgl_surat)', $year);
		$this->db->where('jenis_surat', "eksternal");
		$this->db->where('MONTH(tgl_surat)', 9);
		$this->db->where('id_skpd_pengirim', $id_skpd);
		$query = $this->db->get('surat_keluar');
		return $query->row_array();
	}
	public function get_all_eksternal_grafik_okt($year, $id_skpd)
	{
		$this->db->select('MONTH(tgl_surat) as bln, COUNT(tgl_surat) as total');
		$this->db->where('YEAR(tgl_surat)', $year);
		$this->db->where('jenis_surat', "eksternal");
		$this->db->where('MONTH(tgl_surat)', 10);
		$this->db->where('id_skpd_pengirim', $id_skpd);
		$query = $this->db->get('surat_keluar');
		return $query->row_array();
	}
	public function get_all_eksternal_grafik_nov($year, $id_skpd)
	{
		$this->db->select('MONTH(tgl_surat) as bln, COUNT(tgl_surat) as total');
		$this->db->where('YEAR(tgl_surat)', $year);
		$this->db->where('jenis_surat', "eksternal");
		$this->db->where('MONTH(tgl_surat)', 11);
		$this->db->where('id_skpd_pengirim', $id_skpd);
		$query = $this->db->get('surat_keluar');
		return $query->row_array();
	}
	public function get_all_eksternal_grafik_des($year, $id_skpd)
	{
		$this->db->select('MONTH(tgl_surat) as bln, COUNT(tgl_surat) as total');
		$this->db->where('YEAR(tgl_surat)', $year);
		$this->db->where('jenis_surat', "eksternal");
		$this->db->where('MONTH(tgl_surat)', 12);
		$this->db->where('id_skpd_pengirim', $id_skpd);
		$query = $this->db->get('surat_keluar');
		return $query->row_array();
	}

	public function get_all_internal_grafik_jan($year, $id_skpd)
	{
		$this->db->select('MONTH(tgl_surat) as bln, COUNT(tgl_surat) as total');
		$this->db->where('YEAR(tgl_surat)', $year);
		$this->db->where('jenis_surat', "internal");
		$this->db->where('MONTH(tgl_surat)', 1);
		$this->db->where('id_skpd_pengirim', $id_skpd);
		$query = $this->db->get('surat_keluar');
		return $query->row_array();
	}
	public function get_all_internal_grafik_feb($year, $id_skpd)
	{
		$this->db->select('MONTH(tgl_surat) as bln, COUNT(tgl_surat) as total');
		$this->db->where('YEAR(tgl_surat)', $year);
		$this->db->where('jenis_surat', "internal");
		$this->db->where('MONTH(tgl_surat)', 2);
		$this->db->where('id_skpd_pengirim', $id_skpd);
		$query = $this->db->get('surat_keluar');
		return $query->row_array();
	}
	public function get_all_internal_grafik_mar($year, $id_skpd)
	{
		$this->db->select('MONTH(tgl_surat) as bln, COUNT(tgl_surat) as total');
		$this->db->where('YEAR(tgl_surat)', $year);
		$this->db->where('jenis_surat', "internal");
		$this->db->where('MONTH(tgl_surat)', 3);
		$this->db->where('id_skpd_pengirim', $id_skpd);
		$query = $this->db->get('surat_keluar');
		return $query->row_array();
	}
	public function get_all_internal_grafik_apr($year, $id_skpd)
	{
		$this->db->select('MONTH(tgl_surat) as bln, COUNT(tgl_surat) as total');
		$this->db->where('YEAR(tgl_surat)', $year);
		$this->db->where('jenis_surat', "internal");
		$this->db->where('MONTH(tgl_surat)', 4);
		$this->db->where('id_skpd_pengirim', $id_skpd);
		$query = $this->db->get('surat_keluar');
		return $query->row_array();
	}
	public function get_all_internal_grafik_mei($year, $id_skpd)
	{
		$this->db->select('MONTH(tgl_surat) as bln, COUNT(tgl_surat) as total');
		$this->db->where('YEAR(tgl_surat)', $year);
		$this->db->where('jenis_surat', "internal");
		$this->db->where('MONTH(tgl_surat)', 5);
		$this->db->where('id_skpd_pengirim', $id_skpd);
		$query = $this->db->get('surat_keluar');
		return $query->row_array();
	}
	public function get_all_internal_grafik_jun($year, $id_skpd)
	{
		$this->db->select('MONTH(tgl_surat) as bln, COUNT(tgl_surat) as total');
		$this->db->where('YEAR(tgl_surat)', $year);
		$this->db->where('jenis_surat', "internal");
		$this->db->where('MONTH(tgl_surat)', 6);
		$this->db->where('id_skpd_pengirim', $id_skpd);
		$query = $this->db->get('surat_keluar');
		return $query->row_array();
	}
	public function get_all_internal_grafik_jul($year, $id_skpd)
	{
		$this->db->select('MONTH(tgl_surat) as bln, COUNT(tgl_surat) as total');
		$this->db->where('YEAR(tgl_surat)', $year);
		$this->db->where('jenis_surat', "internal");
		$this->db->where('MONTH(tgl_surat)', 7);
		$this->db->where('id_skpd_pengirim', $id_skpd);
		$query = $this->db->get('surat_keluar');
		return $query->row_array();
	}
	public function get_all_internal_grafik_agu($year, $id_skpd)
	{
		$this->db->select('MONTH(tgl_surat) as bln, COUNT(tgl_surat) as total');
		$this->db->where('YEAR(tgl_surat)', $year);
		$this->db->where('jenis_surat', "internal");
		$this->db->where('MONTH(tgl_surat)', 8);
		$this->db->where('id_skpd_pengirim', $id_skpd);
		$query = $this->db->get('surat_keluar');
		return $query->row_array();
	}
	public function get_all_internal_grafik_sep($year, $id_skpd)
	{
		$this->db->select('MONTH(tgl_surat) as bln, COUNT(tgl_surat) as total');
		$this->db->where('YEAR(tgl_surat)', $year);
		$this->db->where('jenis_surat', "internal");
		$this->db->where('MONTH(tgl_surat)', 9);
		$this->db->where('id_skpd_pengirim', $id_skpd);
		$query = $this->db->get('surat_keluar');
		return $query->row_array();
	}
	public function get_all_internal_grafik_okt($year, $id_skpd)
	{
		$this->db->select('MONTH(tgl_surat) as bln, COUNT(tgl_surat) as total');
		$this->db->where('YEAR(tgl_surat)', $year);
		$this->db->where('jenis_surat', "internal");
		$this->db->where('MONTH(tgl_surat)', 10);
		$this->db->where('id_skpd_pengirim', $id_skpd);
		$query = $this->db->get('surat_keluar');
		return $query->row_array();
	}
	public function get_all_internal_grafik_nov($year, $id_skpd)
	{
		$this->db->select('MONTH(tgl_surat) as bln, COUNT(tgl_surat) as total');
		$this->db->where('YEAR(tgl_surat)', $year);
		$this->db->where('jenis_surat', "internal");
		$this->db->where('MONTH(tgl_surat)', 11);
		$this->db->where('id_skpd_pengirim', $id_skpd);
		$query = $this->db->get('surat_keluar');
		return $query->row_array();
	}
	public function get_all_internal_grafik_des($year, $id_skpd)
	{
		$this->db->select('MONTH(tgl_surat) as bln, COUNT(tgl_surat) as total');
		$this->db->where('YEAR(tgl_surat)', $year);
		$this->db->where('jenis_surat', "internal");
		$this->db->where('MONTH(tgl_surat)', 12);
		$this->db->where('id_skpd_pengirim', $id_skpd);
		$query = $this->db->get('surat_keluar');
		return $query->row_array();
	}

	public function get_surat_tembusan($param = null)
	{
		if ($param != null) {
			foreach ($param as $key => $value) {
				$this->db->where($key, $value);
			}
		}
		$this->db->join('surat_keluar', 'surat_keluar.id_surat_keluar = surat_keluar_tembusan.id_surat_keluar', 'left');
		$this->db->join('user', 'user.id_pegawai = surat_keluar_tembusan.id_pegawai', 'left');
		$query = $this->db->get("surat_keluar_tembusan");
		return $query->result();
	}

	public function get_all_tembusan_status($jenis, $status)
	{
		$this->db->where('surat_keluar.jenis_surat', $jenis);
		$this->db->where('surat_keluar_tembusan.status_surat', $status);
		$this->db->join('surat_keluar', 'surat_keluar.id_surat_keluar = surat_keluar_tembusan.id_surat_keluar', 'left');
		$this->db->join('user', 'user.id_pegawai = surat_keluar_tembusan.id_pegawai', 'left');
		$this->filter_user("tembusan");
		$query = $this->db->get("surat_keluar_tembusan");
		return $query->result();
	}

	public function get_tembusan_by_surat_keluar($id_surat_keluar)
	{
		$this->db->where('surat_keluar.id_surat_keluar', $id_surat_keluar);
		$this->db->join('surat_keluar', 'surat_keluar.id_surat_keluar = surat_keluar_tembusan.id_surat_keluar', 'left');
		$this->db->join('pegawai', 'pegawai.id_pegawai = surat_keluar_tembusan.id_pegawai', 'left');
		$this->db->select('*,surat_keluar_tembusan.status_surat as status_tembusan');
		$query = $this->db->get("surat_keluar_tembusan");
		return $query->result();
	}
	public function get_all_tembusan($jenis)
	{
		$this->db->where('surat_keluar.jenis_surat', $jenis);
		$this->db->where('surat_keluar.status_ttd', "sudah_ditandatangani");
		$this->db->join('surat_keluar', 'surat_keluar.id_surat_keluar = surat_keluar_tembusan.id_surat_keluar', 'left');
		$this->db->join('user', 'user.id_pegawai = surat_keluar_tembusan.id_pegawai', 'left');
		$this->filter_user("tembusan");
		$query = $this->db->get("surat_keluar_tembusan");
		return $query->result();
	}

	public function get_page_tembusan($jenis, $mulai, $hal, $filter = '', $summary_field = '', $summary_value = '')
	{
		// $this->db->offsett(0,6);
		if ($filter != '') {
			foreach ($filter as $key => $value) {
				$this->db->like($key, $value);
			}
		} else {
			$this->db->limit($hal, $mulai);
		}

		if ($summary_field != '' && $summary_value != '') {
			$this->db->where('surat_keluar.' . $summary_field, $summary_value);
		}
		$this->db->where('surat_keluar.jenis_surat', $jenis);
		$this->db->where('surat_keluar.status_ttd', "sudah_ditandatangani");
		$this->db->join('surat_keluar', 'surat_keluar.id_surat_keluar = surat_keluar_tembusan.id_surat_keluar', 'left');
		$this->db->join('user', 'user.id_pegawai = surat_keluar_tembusan.id_pegawai', 'left');
		$this->db->join('ref_skpd', 'surat_keluar.id_skpd_pengirim = ref_skpd.id_skpd');
		$this->db->order_by('surat_keluar.id_surat_keluar', 'DESC');
		$this->db->select('*,surat_keluar_tembusan.status_surat as status_tembusan');
		$this->filter_user("tembusan");
		$query = $this->db->get("surat_keluar_tembusan");
		return $query->result();
	}
	public function get_surat_tembusan_by_id($id_surat_keluar_tembusan)
	{
		$this->db->where('id_surat_keluar_tembusan', $id_surat_keluar_tembusan);
		$this->db->join('surat_keluar', 'surat_keluar.id_surat_keluar = surat_keluar_tembusan.id_surat_keluar', 'left');
		$this->db->join('ref_surat', 'ref_surat.id_ref_surat = surat_keluar.id_ref_surat', 'left');
		$this->db->join('user', 'user.id_pegawai = surat_keluar_tembusan.id_pegawai', 'left');
		$this->db->join('ref_skpd', 'surat_keluar.id_skpd_pengirim = ref_skpd.id_skpd');
		$this->db->order_by('surat_keluar.id_surat_keluar', 'DESC');
		$this->db->select('*,surat_keluar_tembusan.status_surat as status_tembusan,surat_keluar.jenis_surat as jenis_surat_keluar');
		$this->filter_user("tembusan");
		$query = $this->db->get("surat_keluar_tembusan");
		return $query->row();
	}

	public function baca_surat_tembusan($id_surat_keluar_tembusan)
	{
		$this->db->where('id_surat_keluar_tembusan', $id_surat_keluar_tembusan);
		$this->db->set('status_surat', 'Sudah Dibaca');
		$this->db->update('surat_keluar_tembusan');
	}

	public function get_status_surat($id_surat_keluar)
	{
		$get = $this->db->get_where('surat_keluar', array('id_surat_keluar' => $id_surat_keluar))->row();
		if ($get) {
			if ($get->status_verifikasi == NULL) {
				$status = "belum_diupload";
			} else {
				if ($get->status_verifikasi == "ditolak") {
					$status = "ditolak_verifikasi";
				} else {
					$status = $get->status_verifikasi;
				}
			}

			if ($get->status_verifikasi == "sudah_diverifikasi") {
				if ($get->status_penomoran == "N") {
					$status = "menunggu_penomoran";
				} elseif ($get->status_penomoran == "T") {
					$status = "ditolak_penomoran";
				}
			}

			if ($get->status_penomoran == "Y") {
				if ($get->status_ttd == "menunggu_verifikasi") {
					$status = "menunggu_tandatangan";
				} else {
					if ($get->status_ttd == "ditolak") {
						$status = "ditolak_ttd";
					} else {
						$status = $get->status_ttd;
					}
				}
			}

			return $status;
		} else {
			return false;
		}
	}

	public function get_all_where($search, $year, $page)
	{
		if (!empty($search)) {
			$this->db->like($this->perihal, $search);
			$this->db->or_like($this->nomer_surat, $search);
		}

		$where	= array(
			"YEAR(tanggal_surat)"	=> $year,
			// "status_ttd"			=> 'Sudah tanda tangan'
		);
		$this->db->where($where);
		$this->db->limit(20, $page);
		
		return $this->db->get('surat_keluar')->result();
	}

//    edited by Dinar
    public function get_all_wheres($search, $year, $skpd, $page, $arrSent)
    {
        $this->db->where('id_skpd_pengirim', $skpd);
        $this->db->where("YEAR(tgl_buat)", $year);
        $this->db->where_not_in('id_surat_keluar', $arrSent);

        if (!empty($search)) {
            $this->db->like('perihal', $search);
            $this->db->or_like('nomer_surat', $search);
        }

        $this->db->limit('20', ($page-1) * 20);
        $this->db->order_by('id_surat_keluar', 'DESC');
        $this->db->select('id_surat_keluar, perihal, nomer_surat');
        $result = $this->db->get('surat_keluar')->result();

        if ($result > 0) {
            foreach ($result as $res) {
                $res->id    = $res->id_surat_keluar;
                $res->text  = $res->perihal;
            }
        }

        return $result;

    }

    public function get_total_rows($search, $year, $skpd)
    {
        if (!empty($search)) {
            $this->db->like('perihal', $search);
            $this->db->or_like('nomer_surat', $search);

            $this->db->where('id_skpd_pengirim', $skpd);
            $this->db->where("YEAR(tgl_buat)", $year);
            $this->db->from('surat_keluar');
            return $this->db->count_all_results();
        } else {
            $this->db->where('id_skpd_pengirim', $skpd);
            $this->db->where("YEAR(tgl_buat)", $year);
            return $this->db->count_all_results('surat_keluar');
        }

    }
}
