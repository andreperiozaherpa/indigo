<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class skpd_model extends CI_Model
{
	public $kd_skpd;
	public $id_induk;
	public $level_skpd;
	public $id_unit_kerja;
	public $nama_skpd;
	public $alamat;

	public $telp;
	public $email;
	public $status;
	public $ket_induk;
	public function get_all($group=0)
	{
		if ($group==0){
			if ($this->kd_skpd!=0) $this->db->where('kd_skpd',$this->kd_skpd);
			if ($this->status!="") $this->db->where('status',$this->status);
			$this->db->order_by('nama_skpd','ASC');
			$query = $this->db->get('skpd');
			return $query->result();
		}
		elseif($group==1){
			$data = array();
			$this->db->where('level_skpd','1');
			$query = $this->db->get('skpd');
			$i=0;

			foreach($query->result() as $row){
				$data[$i]['kd_skpd']=$row->kd_skpd;
				$data[$i]['nama_skpd']=$row->nama_skpd;
				$data[$i]['level_skpd']=$row->level_skpd;
				$data[$i]['id_unit_kerja']=$row->id_unit_kerja;
				$i++;
				$skpd2 = $this->get_induk($row->kd_skpd);
				foreach($skpd2 as $row2){
					$data[$i]['kd_skpd']=$row2->kd_skpd;
					$data[$i]['nama_skpd']=$row2->nama_skpd;
					$data[$i]['level_skpd']=$row2->level_skpd;
					$data[$i]['id_unit_kerja']=$row2->id_unit_kerja;
					$i++;
					$skpd3 = $this->get_induk($row2->kd_skpd);
					foreach($skpd3 as $row3){
						$data[$i]['kd_skpd']=$row3->kd_skpd;
						$data[$i]['nama_skpd']=$row3->nama_skpd;
						$data[$i]['level_skpd']=$row3->level_skpd;
						$data[$i]['id_unit_kerja']=$row3->id_unit_kerja;
						$i++;
						$skpd4 = $this->get_induk($row3->kd_skpd);
						foreach($skpd4 as $row4){
							$data[$i]['kd_skpd']=$row4->kd_skpd;
							$data[$i]['nama_skpd']=$row4->nama_skpd;
							$data[$i]['level_skpd']=$row4->level_skpd;
							$data[$i]['id_unit_kerja']=$row4->id_unit_kerja;
							$i++;
							$skpd5 = $this->get_induk($row4->kd_skpd);
							foreach($skpd5 as $row5){
								$data[$i]['kd_skpd']=$row5->kd_skpd;
								$data[$i]['nama_skpd']=$row5->nama_skpd;
								$data[$i]['level_skpd']=$row5->level_skpd;
								$data[$i]['id_unit_kerja']=$row5->id_unit_kerja;
								$i++;
								$skpd6 = $this->get_induk($row5->kd_skpd);
								foreach($skpd6 as $row6){
									$data[$i]['kd_skpd']=$row6->kd_skpd;
									$data[$i]['nama_skpd']=$row6->nama_skpd;
									$data[$i]['level_skpd']=$row6->level_skpd;
									$data[$i]['id_unit_kerja']=$row6->id_unit_kerja;
									$i++;
									$skpd7 = $this->get_induk($row6->kd_skpd);
									foreach($skpd7 as $row7){
										$data[$i]['kd_skpd']=$row7->kd_skpd;
										$data[$i]['nama_skpd']=$row7->nama_skpd;
										$data[$i]['level_skpd']=$row7->level_skpd;
										$data[$i]['id_unit_kerja']=$row7->id_unit_kerja;
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

	
	public function get_skpd_by_induk($id_induk){
		$this->db->where('id_induk',$id_induk);
		$query = $this->db->get('skpd');
		return $query->result();
	}
	public function get_skpd_by_id($id){
		$this->db->where('kd_skpd',$id);
		$query = $this->db->get('skpd');
		return $query->result();
	}
	public function insert()
	{
		$skpd_ = $this->get_skpd_by_id($this->id_induk);
		if (!empty($skpd_[0])){
			if($skpd_[0]->ket_induk!=""){
				$this->ket_induk = $skpd_[0]->ket_induk.$this->id_induk."|";
			}
			else{
				$this->ket_induk = "|".$this->id_induk."|";
			}
		}
		$this->db->set('id_induk',$this->id_induk);
		$this->db->set('level_skpd',$this->level_skpd);
		$this->db->set('id_unit_kerja',$this->id_unit_kerja);
		$this->db->set('nama_skpd',$this->nama_skpd);
		$this->db->set('alamat',$this->alamat);
		$this->db->set('telp',$this->telp);
		$this->db->set('email',$this->email);
		$this->db->set('status','Aktif');
		if (!empty($this->ket_induk)) $this->db->set('ket_induk',$this->ket_induk);
		$this->db->insert('skpd');
	}
	public function cek_unit_kerja($id_unit_kerja)
	{
		$this->db->where('id_unit_kerja',$id_unit_kerja);
		$query = $this->db->get('skpd');
		if ($query->result())
			return false;
		else
			return true;
	}
	public function update()
	{
		$this->db->where('kd_skpd',$this->kd_skpd);
		$this->db->set('nama_skpd',$this->nama_skpd);
		$this->db->set('alamat',$this->alamat);
		$this->db->set('telp',$this->telp);
		$this->db->set('email',$this->email);
		$this->db->update('skpd');
	}
	public function set_by_id()
	{
		$this->db->where('kd_skpd',$this->kd_skpd);
		$query = $this->db->get('skpd');
		foreach ($query->result() as $row) {
			$this->id_induk 	= $row->id_induk;
			$this->level_skpd 	= $row->level_skpd;
			$this->id_unit_kerja 	= $row->id_unit_kerja;
			$this->nama_skpd 	= $row->nama_skpd;
			$this->alamat			= $row->alamat;
			$this->telp 			= $row->telp;
			$this->email 			= $row->email;
			$this->status 			= $row->status;
			$this->ket_induk 			= $row->ket_induk;
		}
	}
	public function ubah_status()
	{
		$this->db->where('kd_skpd',$this->kd_skpd);
		$this->db->set('status',$this->status);
		$this->db->update('skpd');
	}
	public function get_induk($id_induk){
		
		$this->db->where('id_induk',$id_induk);
		$query = $this->db->get('skpd');
		return $query->result();
	}
}
?>