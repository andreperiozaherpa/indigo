<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ref_unit_kerja_model extends CI_Model
{
	public $id_unit_kerja;
	public $id_induk;
	public $level_unit_kerja;
	public $nama_unit_kerja;

	public $alamat;

	public $telp;
	public $email;

	public $set_renstra;
	public $set_rkt;
	public $set_pk;
	public $set_lkj;

	public $status;
	public $ket_induk;

	public $session_unit_kerja_only;

	public function get_all()
	{
		if ($this->session_unit_kerja_only == true) {
			$this->db->where("id_unit_kerja", $this->session->userdata("unit_kerja_id"));
		}
		$query = $this->db->get('ref_unit_kerja');
		return $query->result();
	}
	public function get_all_d()
	{
		if ($this->session_unit_kerja_only == true) {
			$this->db->where("id_unit_kerja", $this->session->userdata("unit_kerja_id"));
		}
		$query = $this->db->get('ref_unit_kerja_d');
		return $query->result();
	}

	public function get_all_level($level)
	{
		$this->db->where("level_unit_kerja",$level);
		$query = $this->db->get('ref_unit_kerja');
		return $query->result();
	}

	public function get_by_kode($kode)
	{
		$this->db->where("kode_unit_kerja",$kode);
		$query = $this->db->get('ref_unit_kerja');
		return $query->result();
	}

	public function get_by_skpd($skpd,$level=null)
	{
		if($level) $this->db->where('level_unit_kerja',$level);
		$this->db->where("id_skpd",$skpd);
		$query = $this->db->get('ref_unit_kerja');
		return $query->result();
	}

	public function update_kode($id, $kode)
	{
		$this->db->where('id_unit_kerja',$id);
		$this->db->set('kode_unit_kerja',$kode);
		$this->db->update('ref_unit_kerja');
	}

	public function get_by_id_parent($id){
		$unit_kerja = $this->get_all();
		$id_uk = array();
		foreach($unit_kerja as $u){
			$induk = $u->ket_induk;
			$induk = explode('|', $induk);
			$cek = array_search($id, $induk);
			if($cek){
				$id_uk[] = $u->id_unit_kerja;
			}
		}
		if(!empty($id_uk)){
			$this->db->order_by('level_unit_kerja','asc');
			$this->db->where_in('id_unit_kerja',$id_uk);
			$query = $this->db->get('ref_unit_kerja');
			return $query->result();
		}else{
			return array();
		}
	}

	public function get_by_parent($tahun=null)
	{
		$this->db->select('*, ref_unit_kerja.id_unit_kerja AS id_unit_kerja');
		$this->db->where('id_induk',$this->id_induk);
		if ($tahun == "ALL") {
			$this->db->join('berkas_unit_kerja',"ref_unit_kerja.id_unit_kerja = berkas_unit_kerja.id_unit_kerja");
			$this->db->join('ref_rkt',"ref_unit_kerja.id_unit_kerja = ref_rkt.id_unit_penanggungjawab");
		} elseif ($tahun) {
			$this->db->join('berkas_unit_kerja',"ref_unit_kerja.id_unit_kerja = berkas_unit_kerja.id_unit_kerja AND berkas_unit_kerja.tahun_berkas = '{$tahun}'", "left");
			$this->db->join('ref_rkt',"ref_unit_kerja.id_unit_kerja = ref_rkt.id_unit_penanggungjawab AND ref_rkt.tahun_rkt = '{$tahun}'", "left");
		}
		$query = $this->db->get('ref_unit_kerja');
		return $query->result();
	}

	public function get_by_level($tahun=null)
	{
		$this->db->select('*, ref_unit_kerja.id_unit_kerja AS id_unit_kerja');
		if(count($this->level_unit_kerja)>1){
			$this->db->order_by('level_unit_kerja');
			$this->db->where_in('level_unit_kerja',$this->level_unit_kerja);
		}else{
			$this->db->where('level_unit_kerja',$this->level_unit_kerja);
		}
		if ($tahun == "ALL") {
			$this->db->join('berkas_unit_kerja',"ref_unit_kerja.id_unit_kerja = berkas_unit_kerja.id_unit_kerja");
			$this->db->join('ref_rkt',"ref_unit_kerja.id_unit_kerja = ref_rkt.id_unit_penanggungjawab");
		} elseif ($tahun) {
			$this->db->join('berkas_unit_kerja',"ref_unit_kerja.id_unit_kerja = berkas_unit_kerja.id_unit_kerja AND berkas_unit_kerja.tahun_berkas = '{$tahun}'", "left");
			$this->db->join('ref_rkt',"ref_unit_kerja.id_unit_kerja = ref_rkt.id_unit_penanggungjawab AND ref_rkt.tahun_rkt = '{$tahun}'", "left");
		}
		$query = $this->db->get('ref_unit_kerja');
		return $query->result();
	}


	public function get_by_id($id_unit_kerja=null)
	{
		if ($id_unit_kerja) {
			$this->id_unit_kerja = $id_unit_kerja;
		}
		$this->db->where('id_unit_kerja',$this->id_unit_kerja);
		$query = $this->db->get('ref_unit_kerja');
		return $query->row();
	}



	public function get_by_id_d($id_unit_kerja=null)
	{
		if ($id_unit_kerja) {
			$this->id_unit_kerja = $id_unit_kerja;
		}
		$this->db->where('id_unit_kerja',$this->id_unit_kerja);
		$query = $this->db->get('ref_unit_kerja_d');
		return $query->row();
	}
	public function get_result_by_id($id_unit_kerja=null)
	{
		if ($id_unit_kerja) {
			$this->id_unit_kerja = $id_unit_kerja;
		}
		$this->db->where('id_unit_kerja',$this->id_unit_kerja);
		$query = $this->db->get('ref_unit_kerja');
		return $query->result();
	}
	public function get_all_ref($group=0)
	{
		if ($group==0){
			if ($this->id_unit_kerja!=0) $this->db->where('id_unit_kerja',$this->id_unit_kerja);
			if ($this->status!="") $this->db->where('status',$this->status);
			$this->db->order_by('nama_unit_kerja','ASC');
			$query = $this->db->get('ref_unit_kerja');
			return $query->result();
		}
		elseif($group==1){
			$data = array();
			$this->db->where('level_unit_kerja','0');
			$query = $this->db->get('ref_unit_kerja');
			$i=0;

			foreach($query->result() as $row){
				$data[$i]['id_unit_kerja']=$row->id_unit_kerja;
				$data[$i]['nama_unit_kerja']=$row->nama_unit_kerja;
				$data[$i]['level_unit_kerja']=$row->level_unit_kerja;
				$data[$i]['kode_unit_kerja']=$row->kode_unit_kerja;
				$i++;
				$unit_kerja2 = $this->get_induk($row->id_unit_kerja);
				foreach($unit_kerja2 as $row2){
					$data[$i]['id_unit_kerja']=$row2->id_unit_kerja;
					$data[$i]['nama_unit_kerja']=$row2->nama_unit_kerja;
					$data[$i]['level_unit_kerja']=$row2->level_unit_kerja;
					$data[$i]['kode_unit_kerja']=$row2->kode_unit_kerja;
					$i++;
					$unit_kerja3 = $this->get_induk($row2->id_unit_kerja);
					foreach($unit_kerja3 as $row3){
						$data[$i]['id_unit_kerja']=$row3->id_unit_kerja;
						$data[$i]['nama_unit_kerja']=$row3->nama_unit_kerja;
						$data[$i]['level_unit_kerja']=$row3->level_unit_kerja;
						$data[$i]['kode_unit_kerja']=$row3->kode_unit_kerja;
						$i++;
						$unit_kerja4 = $this->get_induk($row3->id_unit_kerja);
						foreach($unit_kerja4 as $row4){
							$data[$i]['id_unit_kerja']=$row4->id_unit_kerja;
							$data[$i]['nama_unit_kerja']=$row4->nama_unit_kerja;
							$data[$i]['level_unit_kerja']=$row4->level_unit_kerja;
							$data[$i]['kode_unit_kerja']=$row4->kode_unit_kerja;
							$i++;
							$unit_kerja5 = $this->get_induk($row4->id_unit_kerja);
							foreach($unit_kerja5 as $row5){
								$data[$i]['id_unit_kerja']=$row5->id_unit_kerja;
								$data[$i]['nama_unit_kerja']=$row5->nama_unit_kerja;
								$data[$i]['level_unit_kerja']=$row5->level_unit_kerja;
								$data[$i]['kode_unit_kerja']=$row5->kode_unit_kerja;
								$i++;
								$unit_kerja6 = $this->get_induk($row5->id_unit_kerja);
								foreach($unit_kerja6 as $row6){
									$data[$i]['id_unit_kerja']=$row6->id_unit_kerja;
									$data[$i]['nama_unit_kerja']=$row6->nama_unit_kerja;
									$data[$i]['level_unit_kerja']=$row6->level_unit_kerja;
									$data[$i]['kode_unit_kerja']=$row6->kode_unit_kerja;
									$i++;
									$unit_kerja7 = $this->get_induk($row6->id_unit_kerja);
									foreach($unit_kerja7 as $row7){
										$data[$i]['id_unit_kerja']=$row7->id_unit_kerja;
										$data[$i]['nama_unit_kerja']=$row7->nama_unit_kerja;
										$data[$i]['level_unit_kerja']=$row7->level_unit_kerja;
										$data[$i]['kode_unit_kerja']=$row7->kode_unit_kerja;
										$i++;
									}
								}
							}
						}
					}
				}
			}
			return $data;
		}
	}


	public function get_unit_kerja_by_induk($id_induk){
		$this->db->where('id_induk',$id_induk);
		$query = $this->db->get('ref_unit_kerja');
		return $query->result();
	}
	public function get_unit_kerja_by_id($id){
		$this->db->where('id_unit_kerja',$id);
		$query = $this->db->get('ref_unit_kerja');
		return $query->result();
	}
	
	public function insert()
	{
		$unit_kerja_ = $this->get_unit_kerja_by_id($this->id_induk);
		if (!empty($unit_kerja_[0])){
			if($unit_kerja_[0]->ket_induk!=""){
				$this->ket_induk = $unit_kerja_[0]->ket_induk.$this->id_induk."|";
			}
			else{
				$this->ket_induk = "|".$this->id_induk."|";
			}
		}
		if ($this->id_induk) $this->db->set('id_induk',$this->id_induk);
		if ($this->level_unit_kerja) $this->db->set('level_unit_kerja',$this->level_unit_kerja);
		$this->db->set('nama_unit_kerja',$this->nama_unit_kerja);
		// $this->db->set('alamat',$this->alamat);
		// $this->db->set('telp',$this->telp);
		// $this->db->set('email',$this->email);
		$this->db->set('set_renstra',$this->set_renstra);
		$this->db->set('set_rkt',$this->set_rkt);
		$this->db->set('set_pk',$this->set_pk);
		$this->db->set('set_lkj',$this->set_lkj);
		$this->db->set('status','Aktif');
		if (!empty($this->ket_induk)) $this->db->set('ket_induk',$this->ket_induk);
		$this->db->insert('ref_unit_kerja');
	}
	public function cek_unit_kerja($id_unit_kerja)
	{
		$this->db->where('id_unit_kerja',$id_unit_kerja);
		$query = $this->db->get('ref_unit_kerja');
		if ($query->result())
			return false;
		else
			return true;
	}
	public function update()
	{
		$this->db->where('id_unit_kerja',$this->id_unit_kerja);
		$this->db->set('nama_unit_kerja',$this->nama_unit_kerja);
		// $this->db->set('alamat',$this->alamat);
		// $this->db->set('telp',$this->telp);
		// $this->db->set('email',$this->email);
		$this->db->set('set_renstra',$this->set_renstra);
		$this->db->set('set_rkt',$this->set_rkt);
		$this->db->set('set_pk',$this->set_pk);
		$this->db->set('set_lkj',$this->set_lkj);
		$this->db->update('ref_unit_kerja');
	}
	public function set_by_id()
	{
		$this->db->where('id_unit_kerja',$this->id_unit_kerja);
		$query = $this->db->get('ref_unit_kerja');
		foreach ($query->result() as $row) {
			$this->id_induk 	= $row->id_induk;
			$this->level_unit_kerja 	= $row->level_unit_kerja;
			$this->nama_unit_kerja 	= $row->nama_unit_kerja;
			// $this->alamat			= $row->alamat;
			// $this->telp 			= $row->telp;
			// $this->email 			= $row->email;
			$this->set_renstra 			= $row->set_renstra;
			$this->set_rkt 			= $row->set_rkt;
			$this->set_pk 			= $row->set_pk;
			$this->set_lkj 			= $row->set_lkj;
			$this->status 			= $row->status;
			$this->ket_induk 			= $row->ket_induk;
		}
	}
	public function ubah_status()
	{
		$this->db->where('id_unit_kerja',$this->id_unit_kerja);
		$this->db->set('status',$this->status);
		$this->db->update('ref_unit_kerja');
	}
	public function get_induk($id_induk=null){

		if ($id_induk) $this->db->where('id_induk',$id_induk);
		$query = $this->db->get('ref_unit_kerja');
		return $query->result();
	}

	public function getUnit($param=null,$sWhere="")
	{
		if($param!=null)
		{
			foreach ($param as $key => $value) {
				$this->db->where($key,$value);
			}
		}
		if($sWhere!="") $this->db->where($sWhere);

		$qry = $this->db->get("ref_unit_kerja");
		return $qry->result();
	}

	public function detail_unit($id)
	{
		$this->db->select('pegawai.nama_lengkap');
		$this->db->where('pegawai.id_unit_kerja',$id);
		$this->db->where('ref_jabatan.level_jabatan', "1");
		$this->db->join('ref_jabatan','ref_jabatan.id_jabatan = pegawai.id_jabatan');
		$kepala = $this->db->get('pegawai')->row();

		$this->db->select('ref_jabatan.nama_jabatan');
		$this->db->where('ref_jabatan.id_unit',$id);
		$this->db->where('ref_jabatan.level_jabatan', "1");
		$jabatan = $this->db->get('ref_jabatan')->row();

		$this->db->select('pegawai.id_pegawai');
		$this->db->where('pegawai.id_unit_kerja',$id);
		$this->db->where('ref_jabatan.level_jabatan', "2");
		$this->db->join('ref_jabatan','ref_jabatan.id_jabatan = pegawai.id_jabatan');
		$pegawai = $this->db->get('pegawai')->num_rows();

		$data = array(	'nama_kepala' => (isset($kepala->nama_lengkap)) ? $kepala->nama_lengkap : "Belum Ada",
						'nama_jabatan' => (isset($jabatan->nama_jabatan)) ? $jabatan->nama_jabatan : "",
						'jumlah_pegawai' => (isset($pegawai) && $pegawai>0) ? "{$pegawai} orang" : "Tidak Ada", );

		return $data;
	}
}
?>
