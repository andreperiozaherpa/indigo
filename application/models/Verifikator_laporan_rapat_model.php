<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Verifikator_laporan_rapat_model extends CI_Model
{

  public function get_all($id_pegawai){
    return $this->db->get_where('laporan_rapat', ["id_pegawai_verifikasi" => $id_pegawai])->result();
  }

  public function get_by_id($id){
    $this->db->select('
    laporan_rapat.id_laporan_rapat, laporan_rapat.nama_laporan,
    laporan_rapat.isi_laporan, laporan_rapat.tanggal_laporan, laporan_rapat.lokasi_rapat,
    laporan_rapat.file_laporan, laporan_rapat.status, pegawai.id_pegawai, pegawai.nama_lengkap
    ');
    $this->db->join('pegawai', 'pegawai.id_pegawai = laporan_rapat.id_pegawai', 'left');
    return $this->db->get_where('laporan_rapat', ["id_laporan_rapat" => $id])->row();
}

  public function get_id_creator($id){
    return $this->db->get_where('laporan_rapat', ["id_laporan_rapat" => $id])->row();
}


  public function get_page($mulai,$hal,$start,$end,$nama,$id_pegawai){

    if($start!=''){
        $this->db->where('tanggal >=', $start);
    }
    if($end!=''){
        $this->db->where('tanggal <=', $end);
    }
    if($nama!='') {
      $this->db->like('isi_laporan', $nama);
      $this->db->limit($hal,$mulai);
    }else {
      $this->db->limit($hal,$mulai);
    }

    return $this->db->get_where('laporan_rapat', ["id_pegawai_verifikasi" => $id_pegawai])->result();
  }

  public function save($data, $id_pegawai){
    foreach ($this->input->post('id_penerima') as $p) {
    $data = array(
      'id_pegawai' => $this->input->post('id_pegawai'),
      'id_skpd' => $this->input->post('id_skpd'),
      'nama_laporan' => $this->input->post('nama'),
      'isi_laporan' => $this->input->post("isi"),
      'tanggal_laporan' => $this->input->post('tanggal'),
      'lokasi_rapat' => $this->input->post('lokasi'),
      'file_laporan' => $this->_uploadFile($id_pegawai),
      'id_pegawai_verifikasi' => $p
    );
    $this->db->insert('laporan_rapat', $data);
  }

  }

  public function update($data, $id){
    $this->db->where('id_laporan_rapat', $id);
    $data = array(
      'id_pegawai' => $this->input->post('id_pegawai'),
      'id_skpd' => $this->input->post('id_skpd'),
      'nama_laporan' => $this->input->post('nama'),
      'isi_laporan' => $this->input->post("isi"),
      'tanggal_laporan' => $this->input->post('tanggal'),
      'lokasi_rapat' => $this->input->post('lokasi')
    );
    if (!empty($_FILES["image"]["name"])) {
      $this->image = $this->_uploadImage();
    } else {
      $this->image = $post["old_image"];
    }
    $this->db->update('laporan_rapat', $data);
  }

  public function delete($id, $id_pegawai)
  {
    $this->_deleteFile($id, $id_pegawai);
    $this->db->where('id_laporan_rapat', $id);
    $this->db->delete('laporan_rapat');
  }

  public function pegawai_penerima($id_skpd){
    $this->db->where('id_skpd', $id_skpd);
    return $this->db->get('pegawai')->result();
  }

  public function verifikator($data, $id){
    $this->db->where('id_laporan_rapat', $id);
    $data = array(
      'code_warna_status' => 'info',
      'status' => 'SUDAH DIVERIFIKASI'
    );
    $this->db->update('laporan_rapat', $data);
  }

  public function batal_verifikator($data, $id){
    $this->db->where('id_laporan_rapat', $id);
    $data = array(
      'code_warna_status' => 'warning',
      'status' => 'BELUM DIVERIFIKASI'
    );
    $this->db->update('laporan_rapat', $data);
  }

  // private function _uploadFile($id_pegawai){
  //
  //   mkdir("./data/laporan_rapat/$id_pegawai");
  //
  //   $config = array(
  //   'upload_path' => "./data/laporan_rapat/$id_pegawai/",
  //   'allowed_types' => "*",
  //   'overwrite' => TRUE,
  //   'max_size' => "2048000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
  //   'max_height' => "768",
  //   'max_width' => "1024"
  //   );
  //
  // $this->load->library('upload', $config);
  //
  // if($this->upload->do_upload('file_laporan'))
  //   {
  //     $data = array('file_laporan' => $this->upload->data());
  //     return $this->upload->data('file_name');
  //   }
  // else
  //   {
  //     $error = array('error' => $this->upload->display_errors());
  //     echo "<pre>";
  //     print_r($error);
  //     echo "</pre>";
  //     exit;
  //   }
  //
  //
  // }
  //
  // private function _deleteFile($id, $id_pegawai){
  //
  //     $data = $this->get_by_id($id);
  //     if ($data->file_laporan != "default") {
  //       $filename = explode(".", $data->file_laporan)[0];
  //     return array_map('unlink', glob(FCPATH."data/laporan_rapat/$id_pegawai/$filename.*"));
  //     }
  // }

}
?>
