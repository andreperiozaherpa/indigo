<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bkd_model extends CI_Model
{

    public function get_all()
    {
        $query  =  $this->db->get('data_bkd');
        return $query->result();
    }

    public function get_total_pegawai()
    {
      $query = $this->db->get('data_bkd');
      return $query->num_rows();
    }

    public function get_total_perempuan()
    {
      $query = $this->db->get_where('data_bkd', array('kelamin' => 'Perempuan'));
      return $query->num_rows();
    }

    public function get_total_laki()
    {
      $query = $this->db->get_where('data_bkd', array('kelamin' => 'Laki-laki'));
      return $query->num_rows();
    }

    public function last_update_bkd()
    {
       $this->db->order_by('tgl_update', 'DESC');
       $this->db->limit(1);
       return $this->db->get('data_bkd')->row();
    }

    function get_data_kelamin(){
      $this->db->select('kelamin, COUNT(kelamin) as total');
      $this->db->group_by('kelamin');
      $this->db->order_by('total', 'desc');
      $query = $this->db->get('data_bkd');
      if($query->num_rows() > 0){
        foreach($query->result_array() as $data){
            $hasil[] = $data;
        }
        return $hasil;
    }
  }

    function get_data_nama_statuspeg(){
      $this->db->select('nama_statuspeg, COUNT(nama_statuspeg) as total');
      $this->db->group_by('nama_statuspeg');
      $this->db->order_by('total', 'desc');
      $query = $this->db->get('data_bkd');
      if($query->num_rows() > 0){
        foreach($query->result_array() as $data){
            $hasil[] = $data;
        }
        return $hasil;
    }
  }

    function get_data_pendidikan(){
      $this->db->select('pendidikan, COUNT(pendidikan) as total');
      $this->db->group_by('pendidikan');
      $this->db->order_by('total', 'desc');
      $query = $this->db->get('data_bkd');
      if($query->num_rows() > 0){
        foreach($query->result_array() as $data){
            $hasil[] = $data;
        }
        return $hasil;
    }
  }

    function get_data_golongan(){
      $this->db->select('gol, COUNT(gol) as total');
      $this->db->group_by('gol');
      $this->db->order_by('total', 'desc');
      $query = $this->db->get('data_bkd');
      if($query->num_rows() > 0){
        foreach($query->result_array() as $data){
            $hasil[] = $data;
        }
        return $hasil;
    }
  }

  function get_data_golongan_1(){
    $this->db->select('gol, COUNT(gol) as total');
    $this->db->where_in('gol', array('I/a', 'I/b', 'I/c', 'I/d'));
    $this->db->group_by('gol');
    $this->db->order_by('total', 'desc');
    $query = $this->db->get('data_bkd');
    if($query->num_rows() > 0){
      foreach($query->result_array() as $data){
          $hasil[] = $data;
      }
      return $hasil;
  }
}

  function get_data_golongan_2(){
    $this->db->select('gol, COUNT(gol) as total');
    $this->db->where_in('gol', array('II/a', 'II/b', 'II/c', 'II/d'));
    $this->db->group_by('gol');
    $this->db->order_by('total', 'desc');
    $query = $this->db->get('data_bkd');
    if($query->num_rows() > 0){
      foreach($query->result_array() as $data){
          $hasil[] = $data;
      }
      return $hasil;
  }
}

  function get_data_golongan_3(){
    $this->db->select('gol, COUNT(gol) as total');
    $this->db->where_in('gol', array('III/a', 'III/b', 'III/c', 'III/d'));
    $this->db->group_by('gol');
    $this->db->order_by('total', 'desc');
    $query = $this->db->get('data_bkd');
    if($query->num_rows() > 0){
      foreach($query->result_array() as $data){
          $hasil[] = $data;
      }
      return $hasil;
  }
}

  function get_data_golongan_4(){
    $this->db->select('gol, COUNT(gol) as total');
    $this->db->where_in('gol', array('IV/a', 'IV/b', 'IV/c', 'IV/d'));
    $this->db->group_by('gol');
    $this->db->order_by('total', 'desc');
    $query = $this->db->get('data_bkd');
    if($query->num_rows() > 0){
      foreach($query->result_array() as $data){
          $hasil[] = $data;
      }
      return $hasil;
  }
}


    public function get_page($mulai,$hal,$nama, $nip){

		if($nama!='') {
			$this->db->like('nama_lengkap', $nama);
		}if($nip!=''){
				$this->db->like('nip', $nip);
		}else{
			$this->db->limit($hal,$mulai);
		}
		$query = $this->db->get('data_bkd');
		return $query->result();
	}



    public function insert($insert)
    {
      $this->db->insert('data_bkd',$insert);
    }

}
?>
