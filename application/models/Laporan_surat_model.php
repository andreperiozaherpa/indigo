<?php
class Laporan_surat_model extends CI_Model
{

	public function data_surat_masuk($start, $end, $id_skpd)
	{
		if ($start != "") {
			$this->db->where('tanggal_surat >=', $start);
		}
		if ($end != "") {
			$this->db->where('tanggal_surat <=', $end);
		}
		if ($id_skpd != "") {
			$this->db->where('id_skpd_penerima', $id_skpd);
		}
		return $this->db->get('surat_masuk')->result();
	}

	public function data_surat_keluar($start, $end, $id_skpd)
	{
		if ($start != "") {
			$this->db->where('tgl_surat >=', $start);
		}
		if ($end != "") {
			$this->db->where('tgl_surat <=', $end);
		}
		if ($id_skpd != "") {
			$this->db->where('id_skpd_pengirim', $id_skpd);
		}
		return $this->db->get('surat_keluar')->result();
	}

	public function get_skpd_rank($tanggal_awal = '', $tanggal_akhir = '')
	{
		if ($tanggal_awal != "") {
			$this->db->where('tgl_surat >=', $tanggal_awal);
		}
		if ($tanggal_akhir != "") {
			$this->db->where('tgl_surat <=', $tanggal_akhir);
		}
		$this->db->group_by('id_skpd_pengirim');
		$this->db->order_by('jumlah_surat', 'desc');
		$this->db->group_start();
		$this->db->or_where('ref_skpd.jenis_skpd', 'skpd');
		$this->db->or_where('ref_skpd.jenis_skpd', 'kecamatan');
		$this->db->group_end();
		$this->db->join('ref_skpd', 'ref_skpd.id_skpd = surat_keluar.id_skpd_pengirim');
		$this->db->select('id_skpd_pengirim,nama_skpd,count(*) as jumlah_surat');
		$skpd = $this->db->get('surat_keluar')->result();
		return $skpd;
	}

	public function get_pegawai_ttd_rank($eselon, $tanggal_awal = '', $tanggal_akhir = '')
	{
		if ($tanggal_awal != "") {
			$this->db->where('tgl_surat >=', $tanggal_awal);
		}
		if ($tanggal_akhir != "") {
			$this->db->where('tgl_surat <=', $tanggal_akhir);
		}
		$this->db->group_by('id_pegawai');
		$this->db->order_by('jumlah_surat', 'desc');
		$this->db->where('surat_keluar.status_ttd', 'sudah_ditandatangani');
		// $this->db->where("SUBSTRING_INDEX(eselon, '.', 1) = ", $eselon);
		$this->db->join('pegawai', 'pegawai.id_pegawai = surat_keluar.id_pegawai_ttd');
		$this->db->join('ref_skpd', 'ref_skpd.id_skpd = pegawai.id_skpd');
		// $this->db->where('ref_skpd.jenis_skpd','kecamatan');

		$this->db->group_start();
		$this->db->or_where('ref_skpd.jenis_skpd', 'skpd');
		$this->db->or_where('ref_skpd.jenis_skpd', 'kecamatan');
		$this->db->group_end();
		$this->db->where('pegawai.kepala_skpd', 'Y');
		$this->db->where('pegawai.pensiun', 'N');
		// $this->db->where('surat_keluar.id_skpd_pengirim','pegawai.id_skpd',false);
		$this->db->select('id_pegawai,pegawai.nip,pegawai.jabatan,nama_lengkap,count(*) as jumlah_surat,ref_skpd.nama_skpd, (select count(*) from disposisi_surat_masuk where id_pegawai_disposisi=pegawai.id_pegawai) as jumlah_disposisi');
		// $this->db->select('id_pegawai,pegawai.nip,pegawai.jabatan,nama_lengkap,count(*) as jumlah_surat,ref_skpd.nama_skpd');
		$pegawai = $this->db->get('surat_keluar')->result();
		return $pegawai;
	}
}