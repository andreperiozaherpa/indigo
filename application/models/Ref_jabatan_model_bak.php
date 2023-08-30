<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ref_jabatan_model extends CI_Model
{
	public $id_jabatan;
	public $arr_jenis_jabatan = array(
		1 => 'Struktural',
		2 => 'Fungsional'
	);
	public $arr_level_jabatan = array(
		1 => 'Kepala',
		2 => 'Staff'
	);
	public function get_all($level_jabatan=null,$jenis_jabatan=null,$id_unit=null)
	{
		if ($level_jabatan!=null) $this->db->where("level_jabatan",$level_jabatan);
		if ($jenis_jabatan!=null) $this->db->where("jenis_jabatan",$jenis_jabatan);
		if ($id_unit!=null) $this->db->where("id_unit",$id_unit);
		$query = $this->db->get('ref_jabatan');
		return $query->result();
	}
	

	public function getAll($group=0,$jenis_jabatan=null)
	{
		if ($group==0){
			if ($this->id_jabatan!=0) $this->db->where('id_jabatan',$this->id_jabatan);
			if ($this->status!="") $this->db->where('status',$this->status);
			$this->db->order_by('nama_jabatan','ASC');
			$query = $this->db->get('ref_jabatan');
			$res = $query->result();
			foreach($res as $r){
				$id_unit = $r->id_unit;
				if($id_unit==0){
					$res->nama_unit_kerja = 'Semua Unit Kerja';
				}else{
					$this->db->where('id_unit_kerja');
					$q = $this->db->get('ref_unit_kerja')->row();
					$res->nama_unit_kerja = $q->nama_unit_kerja;
				}
			}
			return $res;
		}
		elseif($group==1){
			$data = array();
			$this->db->where('level_jabatan','1');
			if ($jenis_jabatan!=null) $this->db->where("jenis_jabatan",$jenis_jabatan);
			$query = $this->db->get('ref_jabatan');
			$i=0;

			foreach($query->result() as $row){
				$data[$i]['id_jabatan']=$row->id_jabatan;
				$data[$i]['nama_jabatan']=$row->nama_jabatan;
				$data[$i]['id_unit']=$row->id_unit;
				$data[$i]['level_jabatan']=$row->level_jabatan;
				$data[$i]['status']=$row->status;
				$data[$i]['jenis_jabatan']=$row->jenis_jabatan;
				$i++;
				$jab2 = $this->get_kepala($row->id_unit, 2);
				foreach($jab2 as $row2){
					$data[$i]['id_jabatan']=$row2->id_jabatan;
					$data[$i]['nama_jabatan']=$row2->nama_jabatan;
					$data[$i]['id_unit']=$row->id_unit;
					$data[$i]['level_jabatan']=$row2->level_jabatan;
					$data[$i]['status']=$row2->status;
					$data[$i]['jenis_jabatan']=$row2->jenis_jabatan;
					$i++;
					$jab3 = $this->get_kepala($row2->id_unit, 3);
					foreach($jab3 as $row3){
						$data[$i]['id_jabatan']=$row3->id_jabatan;
						$data[$i]['nama_jabatan']=$row3->nama_jabatan;
						$data[$i]['id_unit']=$row->id_unit;
						$data[$i]['level_jabatan']=$row3->level_jabatan;
						$data[$i]['status']=$row3->status;
						$data[$i]['jenis_jabatan']=$row3->jenis_jabatan;
						$i++;
						$jab4 = $this->get_kepala($row3->id_unit, 4);
						foreach($jab4 as $row4){
							$data[$i]['id_jabatan']=$row4->id_jabatan;
							$data[$i]['nama_jabatan']=$row4->nama_jabatan;
							$data[$i]['id_unit']=$row->id_unit;
							$data[$i]['level_jabatan']=$row4->level_jabatan;
							$data[$i]['status']=$row4->status;
							$data[$i]['jenis_jabatan']=$row4->jenis_jabatan;
							$i++;
							$jab5 = $this->get_kepala($row4->id_unit, 5);
							foreach($jab5 as $row5){
								$data[$i]['id_jabatan']=$row5->id_jabatan;
								$data[$i]['nama_jabatan']=$row5->nama_jabatan;
								$data[$i]['id_unit']=$row->id_unit;
								$data[$i]['level_jabatan']=$row5->level_jabatan;
								$data[$i]['status']=$row5->status;
								$data[$i]['jenis_jabatan']=$row5->jenis_jabatan;
								$i++;
								$jab6 = $this->get_kepala($row5->id_unit, 6);
								foreach($jab6 as $row6){
									$data[$i]['id_jabatan']=$row6->id_jabatan;
									$data[$i]['nama_jabatan']=$row6->nama_jabatan;
									$data[$i]['id_unit']=$row->id_unit;
									$data[$i]['level_jabatan']=$row6->level_jabatan;
									$data[$i]['status']=$row6->status;
									$data[$i]['jenis_jabatan']=$row6->jenis_jabatan;
									$i++;
									$jab7 = $this->get_kepala($row6->id_unit, 7);
									foreach($jab7 as $row7){
										$data[$i]['id_jabatan']=$row7->id_jabatan;
										$data[$i]['nama_jabatan']=$row7->nama_jabatan;
										$data[$i]['id_unit']=$row->id_unit;
										$data[$i]['level_jabatan']=$row7->level_jabatan;
										$data[$i]['status']=$row7->status;
										$data[$i]['jenis_jabatan']=$row7->jenis_jabatan;
										$i++;
									}
								}
							}
						}
					}
				}
			}
			$no=0;
			foreach($data as $r){
				$id_unit = $r['id_unit'];
				if($id_unit==0){
					$data[$no]['nama_unit_kerja'] = 'Semua Unit Kerja';
				}else{
					$this->db->where('id_unit_kerja',$id_unit);
					$q = $this->db->get('ref_unit_kerja')->row();
					$data[$no]['nama_unit_kerja'] = $q->nama_unit_kerja;
				}
				$no++;
			}
			// return $res;
			return $data;
		}
	}
	public function get_induk($id_induk){
		$this->db->where('id_induk',$id_induk);
		$this->db->order_by('nama_jabatan','ASC');
		$query = $this->db->get('ref_jabatan');
		return $query->result();
	}

	public function get_kepala($id_unit,$level_jabatan){
		$this->db->where('id_unit',$id_unit);
		$this->db->where('level_jabatan',$level_jabatan);
		$this->db->order_by('nama_jabatan','ASC');
		$query = $this->db->get('ref_jabatan');
		return $query->result();
	}
	
	public function insert($data)
	{
		if (!isset($data['status'])) $data['status'] = "Y";
		$insert = array(	'nama_jabatan' => $data['nama'],
			'status' => $data['status'],
			'id_unit' => $data['id_unit'],
			// 'id_jabatan' => '',
			'level_jabatan' => $data['level_jabatan'],
			'id_induk' => $data['id_induk'],
			'ket_induk' => $data['ket_induk'],
			'jenis_jabatan' => $data['jenis_jabatan'],
		);
		$query = $this->db->insert('ref_jabatan',$insert);
	}
	
	public function cek_kepala($data)
	{
		$this->db->where("id_unit", $data['id_unit']);
		$this->db->where("level_jabatan", 1);
		$query = $this->db->get('ref_jabatan');
		return $query->num_rows();
	}

	public function select_by_id($id = NULL) {
		if(!empty($id)){
			$this->db->where('id_jabatan', $id);
		}        
		$query = $this->db->get('ref_jabatan');
		return $query->result();   
	}

	public function update($data,$id = NULL)
	{
		$dt = array(	'nama_jabatan' => $data['nama'],
			'jenis_jabatan' => $data['jenis_jabatan'],
			'id_unit' => $data['id_unit'],
			'status' => $data['status'],
		);
		$this->db->where('id_jabatan', $id);
		$query = $this->db->update('ref_jabatan',$dt);
	}
	
	public function delete()
	{
		$this->db->where('id_jabatan',$this->id_jabatan);
		$query = $this->db->delete('ref_jabatan');
		$this->db->where("ket_induk like '%|".$this->id_jabatan."|%' ");
		$query = $this->db->delete('ref_jabatan');		
		redirect('ref_jabatan');
	}
	public function get_eselon()
	{
		$this->db->order_by('level','ASC');
		$query = $this->db->get('ref_eselon');
		return $query->result();
	}

	public function get($param=null)
	{
		if($param!=null){
			foreach($param as $key=>$value)
			{
				$this->db->where($key,$value);
			}
		}
		$rs = $this->db->get("ref_jabatan");
		return $rs->result();
	}

	public function get_by_name($params)
	{
		$this->db->like('nama_jabatan', $params);
		$this->db->get('ref_jabatan')->result_array();
	}
}
?>