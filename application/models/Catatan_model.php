<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Catatan_model extends CI_Model
{

  public function get_all($id_pegawai){
    return $this->db->get_where('catatan', ["id_pegawai" => $id_pegawai])->result();
  }

  public function get_by_id($id){
    return $this->db->get_where('catatan', ["id_catatan" => $id])->row();
  }


  public function get_page($mulai,$hal,$start,$end,$nama,$id_pegawai){

    if($start!=''){
        $this->db->where('tanggal >=', $start);
    }
    if($end!=''){
        $this->db->where('tanggal <=', $end);
    }
    if($nama!='') {
      $this->db->like('nama_catatan', $nama);
      $this->db->limit($hal,$mulai);
    }else {
      $this->db->limit($hal,$mulai);
    }

    return $this->db->get_where('catatan', ["id_pegawai" => $id_pegawai])->result();
  }

  public function save($data){
    $data = array(
      'id_pegawai' => $this->input->post('id_pegawai'),
      'id_skpd' => $this->input->post('id_skpd'),
      'nama_catatan' => $this->input->post("nama_catatan"),
      'isi' => $this->input->post("isi_catatan"),
      'tanggal' => date("Y-m-d")
    );
    $this->db->insert('catatan', $data);
  }

  public function update($data, $id){
    $this->db->where('id_catatan', $id);
    $data = array(
      'id_pegawai' => $this->input->post('id_pegawai'),
      'id_skpd' => $this->input->post('id_skpd'),
      'nama_catatan' => $this->input->post("nama_catatan"),
      'isi' => $this->input->post("isi"),
      'tanggal' => date("Y-m-d")
    );
    $this->db->update('catatan', $data);
  }

  public function delete($id)
  {
    $this->db->where('id_catatan', $id);
    $this->db->delete('catatan');
  }
}
?>
