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

	public function set_identity()
	{
		$query = $this->db->get('identitas');
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
		$this->db->set('nama',$this->nama);
		$this->db->set('alamat',$this->alamat);
		$this->db->set('telepon',$this->telepon);
		if ($this->logo !="") $this->db->set('logo',$this->logo);
		$this->db->set('email',$this->email);
		$this->db->set('facebook',$this->facebook);
		$this->db->set('twitter',$this->twitter);
		$this->db->set('youtube',$this->youtube);
		$this->db->set('gmap',$this->gmap);
		$this->db->set('instagram',$this->instagram);
		$this->db->set('tentang',$this->tentang);
		$this->db->set('longitude',$this->longitude);
		$this->db->set('latitude',$this->latitude);
		$this->db->update('identitas');
	}
	public function get_all_sambutan()
	{
		$query = $this->db->get('sambutan');
		return $query->result();
	}
	public function insert_sambutan()
	{
		$this->db->set('nama',$this->_nama);
		$this->db->set('jabatan',$this->jabatan);
		$this->db->set('isi',$this->isi);
		if ($this->foto !="") $this->db->set('foto',$this->foto);
		$this->db->insert('sambutan');
	}
	public function update_sambutan()
	{
		$this->db->where('id_sambutan',$this->id_sambutan);
		$this->db->set('nama',$this->_nama);
		$this->db->set('jabatan',$this->jabatan);
		$this->db->set('isi',$this->isi);
		if ($this->foto !="") $this->db->set('foto',$this->foto);
		$this->db->update('sambutan');
	}
	public function set_sambutan()
	{
		$this->db->where('id_sambutan',$this->id_sambutan);
		$query = $this->db->get('sambutan');
		foreach ($query->result() as $row) {
			$this->_nama = $row->nama;
			$this->jabatan = $row->jabatan;
			$this->isi= $row->isi;
			$this->foto= $row->foto;
		}
	}
	public function delete_sambutan()
	{
		$this->db->where('id_sambutan',$this->id_sambutan);
		$this->db->delete('sambutan');
	}
	public function set_visi_misi()
	{
		$query = $this->db->get('visimisi');
		foreach ($query->result() as $row) {
			$this->visi = $row->visi;
			$this->misi = $row->misi;
			$this->tujuan= $row->tujuan;
		}
	}
	public function update_visi_misi()
	{
		$this->db->set('visi',$this->visi);
		$this->db->set('misi',$this->misi);
		$this->db->set('tujuan',$this->tujuan);
		$this->db->update('visimisi');
	}
		public function set_program_kerja()
	{
		$query = $this->db->get('program_kerja');
		foreach ($query->result() as $row) {
			$this->isi = $row->isi;
		}
	}
	public function update_program_kerja()
	{
		$this->db->set('isi',$this->isi);
		$this->db->update('program_kerja');
	}

		public function set_struktur_organisasi()
	{
		$query = $this->db->get('struktur_organisasi');
		foreach ($query->result() as $row) {
			$this->isi = $row->isi;
		}
	}
	public function update_struktur_organisasi()
	{
		$this->db->set('isi',$this->isi);
		$this->db->update('struktur_organisasi');
	}
}
?>