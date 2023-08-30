<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengumuman_model extends CI_Model
{

  public function get_all($id_pegawai=null){
    if($id_pegawai)
    {
      $this->db->where("id_pegawai",$id_pegawai);
    }
    $this->db->order_by("periode_akhir","desc");
    return $this->db->get('pengumuman')->result();
  }

  public function get_by_id($id){
    return $this->db->get_where('pengumuman', ["id_pengumuman" => $id])->row();
  }


  public function get_page($mulai,$hal,$start,$end,$nama,$id_pegawai=null){

    if($start!=''){
        $this->db->where('periode_awal >=', $start);
    }
    if($end!=''){
        $this->db->where('periode_akhir <=', $end);
    }
    if($nama!='') {
      $this->db->like('nama', $nama);
      $this->db->limit($hal,$mulai);
    }else {
      $this->db->limit($hal,$mulai);
    }

    if($id_pegawai)
    {
      $this->db->where("id_pegawai",$id_pegawai);
    }
    $this->db->order_by("periode_akhir","desc");

    return $this->db->get('pengumuman')->result();
  }

  public function save($data){
    $data = array(
      'id_pegawai' => $this->input->post('id_pegawai'),
      'id_skpd' => $this->input->post('id_skpd'),
      'nama' => $this->input->post('nama_pengumuman'),
      'isi' => $this->input->post("isi_pengumuman"),
      'periode_awal' => $this->input->post('periode_awal'),
      'periode_akhir' => $this->input->post('periode_akhir'),
      'tanggal' => date("Y-m-d")
    );
    $this->db->insert('pengumuman', $data);
  }

  public function update($data, $id){
    $this->db->where('id_pengumuman', $id);
    $data = array(
      'id_pegawai' => $this->input->post('id_pegawai'),
      'id_skpd' => $this->input->post('id_skpd'),
      'nama' => $this->input->post('nama_pengumuman'),
      'isi' => $this->input->post("isi_pengumuman"),
      'periode_awal' => $this->input->post('periode_awal'),
      'periode_akhir' => $this->input->post('periode_akhir'),
      'tanggal' => date("Y-m-d")
    );
    $this->db->update('pengumuman', $data);
  }

  public function delete($id)
  {
    $this->db->where('id_pengumuman', $id);
    $this->db->delete('pengumuman');
  }
}
?>
