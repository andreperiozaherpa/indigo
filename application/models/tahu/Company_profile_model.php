<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Company_profile_model extends CI_Model
{
	public $id_identitas;
	public $nama;
	public $alamat;
	public $telepon;
	public $logo;
	public $email;
	public $facebook;
	public $twitter;
	public $youtube;
	public $gmap;
	public $instagram;
	public $tentang;

	public $id_sambutan;
	public $_nama;
	public $jabatan;
	public $foto;
	public $isi;


	public $visi;
	public $misi;
	public $tujuan;

	public function __construct()
	{
		parent::__construct();
		$this->db_tahu = $this->load->database('tahu', TRUE);
	}

	public function set_identity()
	{
		$query = $this->db_tahu->get('identitas');
		foreach ($query->result() as $row) {
			$this->nama = $row->nama;
			$this->alamat = $row->alamat;
			$this->telepon = $row->telepon;
			$this->logo= $row->logo;
			$this->email = $row->email;
			$this->facebook= $row->facebook;
			$this->twitter= $row->twitter;
			$this->youtube= $row->youtube;
			$this->gmap = $row->gmap;
			$this->instagram= $row->instagram;
			$this->tentang= $row->tentang;
			$this->latitude= $row->latitude;
			$this->longitude= $row->longitude;

		}
	}
	public function update_identity()
	{
		$this->db_tahu->set('nama',$this->nama);
		$this->db_tahu->set('alamat',$this->alamat);
		$this->db_tahu->set('telepon',$this->telepon);
		if ($this->logo !="") $this->db_tahu->set('logo',$this->logo);
		$this->db_tahu->set('email',$this->email);
		$this->db_tahu->set('facebook',$this->facebook);
		$this->db_tahu->set('twitter',$this->twitter);
		$this->db_tahu->set('youtube',$this->youtube);
		$this->db_tahu->set('gmap',$this->gmap);
		$this->db_tahu->set('instagram',$this->instagram);
		$this->db_tahu->set('tentang',$this->tentang);
		$this->db_tahu->set('longitude',$this->longitude);
		$this->db_tahu->set('latitude',$this->latitude);
		$this->db_tahu->update('identitas');
	}
	public function get_all_sambutan()
	{
		$query = $this->db_tahu->get('sambutan');
		return $query->result();
	}

	public function get_all_vm()
	{
		$query = $this->db_tahu->get('visimisi');
		return $query->row();
	}

	public function insert_sambutan()
	{
		$this->db_tahu->set('nama',$this->_nama);
		$this->db_tahu->set('jabatan',$this->jabatan);
		$this->db_tahu->set('isi',$this->isi);
		if ($this->foto !="") $this->db_tahu->set('foto',$this->foto);
		$this->db_tahu->insert('sambutan');
	}
	public function update_sambutan()
	{
		$this->db_tahu->where('id_sambutan',$this->id_sambutan);
		$this->db_tahu->set('nama',$this->_nama);
		$this->db_tahu->set('jabatan',$this->jabatan);
		$this->db_tahu->set('isi',$this->isi);
		if ($this->foto !="") $this->db_tahu->set('foto',$this->foto);
		$this->db_tahu->update('sambutan');
	}
	public function set_sambutan()
	{
		$this->db_tahu->where('id_sambutan',$this->id_sambutan);
		$query = $this->db_tahu->get('sambutan');
		foreach ($query->result() as $row) {
			$this->_nama = $row->nama;
			$this->jabatan = $row->jabatan;
			$this->isi= $row->isi;
			$this->foto= $row->foto;
		}
	}
	public function delete_sambutan()
	{
		$this->db_tahu->where('id_sambutan',$this->id_sambutan);
		$this->db_tahu->delete('sambutan');
	}
	public function set_visi_misi()
	{
		$query = $this->db_tahu->get('visimisi');
		foreach ($query->result() as $row) {
			$this->visi = $row->visi;
			$this->misi = $row->misi;
			$this->tujuan= $row->tujuan;
		}
	}
	public function update_visi_misi()
	{
		$this->db_tahu->set('visi',$this->visi);
		$this->db_tahu->set('misi',$this->misi);
		$this->db_tahu->set('tujuan',$this->tujuan);
		$this->db_tahu->update('visimisi');
	}
		public function set_program_kerja()
	{
		$query = $this->db_tahu->get('program_kerja');
		foreach ($query->result() as $row) {
			$this->isi = $row->isi;
		}
	}
	public function update_program_kerja()
	{
		$this->db_tahu->set('isi',$this->isi);
		$this->db_tahu->update('program_kerja');
	}

		public function set_struktur_organisasi()
	{
		$query = $this->db_tahu->get('struktur_organisasi');
		foreach ($query->result() as $row) {
			$this->isi = $row->isi;
		}
	}
	public function update_struktur_organisasi()
	{
		$this->db_tahu->set('isi',$this->isi);
		$this->db_tahu->update('struktur_organisasi');
	}
}
?>