<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan_rapat_model extends CI_Model
{

  public function get_all($id_pegawai){
    return $this->db->get_where('laporan_rapat', ["id_pegawai" => $id_pegawai])->result();
  }

  public function get_by_id($id){
    $this->db->join('pegawai', 'pegawai.id_pegawai = laporan_rapat.id_pegawai_verifikasi', 'left');
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

    return $this->db->get_where('laporan_rapat', ["id_pegawai" => $id_pegawai])->result();
  }

  public function save($data, $id_pegawai){
    $data = array(
      'id_pegawai' => $this->input->post('id_pegawai'),
      'id_skpd' => $this->input->post('id_skpd'),
      'nama_laporan' => $this->input->post('nama'),
      'isi_laporan' => $this->input->post("isi"),
      'tanggal_laporan' => $this->input->post('tanggal'),
      'lokasi_rapat' => $this->input->post('lokasi'),
      'lat' => $this->input->post('lat'),
      'lng' => $this->input->post('lng'),
      'file_laporan' => $this->_uploadFile($id_pegawai),
      'id_pegawai_verifikasi' => $this->input->post('id_penerima')
    );
    $this->db->insert('laporan_rapat', $data);

  }

  public function update($data, $id, $id_pegawai){

    $data = array(
      'id_pegawai' => $this->input->post('id_pegawai'),
      'id_skpd' => $this->input->post('id_skpd'),
      'nama_laporan' => $this->input->post('nama'),
      'isi_laporan' => $this->input->post("isi"),
      'tanggal_laporan' => $this->input->post('tanggal'),
      'lokasi_rapat' => $this->input->post('lokasi'),
      'lat' => $this->input->post('lat'),
      'lng' => $this->input->post('lng'),
      'id_pegawai_verifikasi' => $this->input->post('id_penerima')
    );
    if (!empty($_FILES['file_laporan']['name'])) {
        $this->_deleteFile($id, $id_pegawai);
        $data['file_laporan'] = $this->_uploadFile($id_pegawai);
    } else {
        $data['file_laporan'] = $this->input->post('file_lama');
    }

    $this->db->where('id_laporan_rapat', $id);
    $this->db->update('laporan_rapat', $data);
  }

  public function delete($id, $id_pegawai)
  {
    $this->_deleteFile($id, $id_pegawai);
    return $this->db->delete('laporan_rapat', array("id_laporan_rapat" => $id));
  }

  public function pegawai_penerima($id_skpd){
    $this->db->where('id_skpd', $id_skpd);
    return $this->db->get('pegawai')->result();
  }


  private function _uploadFile($id_pegawai){

    mkdir("./data/laporan_rapat/$id_pegawai");

    $config = array(
    'upload_path' => "./data/laporan_rapat/$id_pegawai/",
    'allowed_types' => "gif|jpg|png|doc|docx|word|ppt|pdf|xls|rar|7zip",
    'overwrite' => TRUE,
    'max_size' => "2048000" // Can be set to particular file size , here it is 2 MB(2048 Kb)
    // 'max_height' => "2000",
    // 'max_width' => "2000"
    );

  $this->load->library('upload', $config);

  if($this->upload->do_upload('file_laporan'))
    {
      $data = array('file_laporan' => $this->upload->data());
      return $this->upload->data('file_name');
    }
  else
    {
      $error = array('error' => $this->upload->display_errors());
      $this->session->set_flashdata('error',$error['error']);
      return "default";
    }


  }

  private function _deleteFile($id, $id_pegawai){

      $data = $this->get_by_id($id);
      if ($data->file_laporan != "default") {
        $filename = explode(".", $data->file_laporan)[0];
      return array_map('unlink', glob(FCPATH."data/laporan_rapat/$id_pegawai/$filename.*"));
      }
  }

}
?>
