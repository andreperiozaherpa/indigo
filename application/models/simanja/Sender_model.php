<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sender_model extends CI_Model
{

	public $id_visi;
	public $visi;

	public $id_misi;
	public $misi;
	
	public $id_tujuan;
	public $tujuan;

	public function get_all($where = null, $admin = null)
	{
		$this->db->select('simanja_sender.*, pemangku.id_pegawai as idPemangku, pemangku.id_skpd as idSkpdPemangku, pemangku.nama_lengkap as namaPemangku, verifikator.id_pegawai as idVerifikator, 
		verifikator.nama_lengkap as namaVerifikator, simanja_analisis_jabatan.id as idAnalisisJabatan, simanja_analisis_jabatan.nama as namaJabatan, simanja_analisis_jabatan.id_skpd as idSkpdAnjab, ref_skpd.id_skpd as idSkpd, ref_skpd.nama_skpd as namaSkpd');
		$this->db->join('pegawai as pemangku', 'pemangku.id_pegawai = simanja_sender.id_pegawai');
		$this->db->join('pegawai as verifikator', 'verifikator.id_pegawai = simanja_sender.id_verifikator');
		$this->db->join('simanja_analisis_jabatan', 'simanja_analisis_jabatan.id = simanja_sender.id_analisis_jabatan');
		$this->db->join('ref_skpd', 'ref_skpd.id_skpd = simanja_analisis_jabatan.id_skpd');
		if($admin != 1){
			if(in_array('simanja', explode(";", $this->session->userdata('user_privileges')))){
				// $this->db->where('pemangku.id_skpd',$this->session->userdata('kd_skpd'));
				$this->db->where('simanja_sender.id_verifikator',$this->session->userdata('id_pegawai'));
				$this->db->or_where('simanja_sender.id_pegawai',$this->session->userdata('id_pegawai'));
			}else{
				$this->db->where('simanja_sender.id_verifikator',$this->session->userdata('id_pegawai'));
			}
		}
		if(isset($where['status'])){
			if($where['status'] != null){
				$this->db->where_in('simanja_sender.status', explode(",",$where['status']));
			}
		}
		if(isset($where['id_skpd'])){
			if($where['id_skpd'] != null){
				$this->db->where('pemangku.id_skpd', $where['id_skpd']);
			}
		}
		$this->db->where('is_active', 1);
		$this->db->order_by('simanja_sender.created_at','DESC');
		$query = $this->db->get('simanja_sender');
		return $query->result();
	}

	public function cek_sender($anjab, $limit = null){
		if($limit){
			$this->db->limit(1);
		}
		$this->db->select('simanja_sender.*, pemangku.id_pegawai as idPemangku, pemangku.nama_lengkap as namaPemangku, verifikator.id_pegawai as idVerifikator, verifikator.nama_lengkap as namaVerifikator,
			pemangku.nip as nipPemangku, verifikator.nip as nipVerifikator');
		$this->db->join('pegawai as pemangku', 'pemangku.id_pegawai = simanja_sender.id_pegawai');
		$this->db->join('pegawai as verifikator', 'verifikator.id_pegawai = simanja_sender.id_verifikator');
		return $this->db->get_where('simanja_sender',['id_analisis_jabatan' => $anjab, 'is_active' => 1])->row();
	}

	public function inactive($anjab){
		$this->db->where('id_analisis_jabatan', $anjab);
		return $this->db->update('simanja_sender', ['is_active' => 0]);
	}

	public function count_by_status($status, $admin = null){
		if($admin != 1){
			$this->db->where('simanja_sender.id_verifikator', $this->session->userdata('id_pegawai'));
		}
		$this->db->where_in('status', $status);
		return $this->db->get('simanja_sender')->num_rows();
	}

	public function get_by_id($id){
		return $this->db->get_where('simanja_sender',array('id'=>$id))->row();
	}

	public function get_by_id_skpd($id_skpd){
		return $this->db->get_where('simanja_sender',array('id_skpd'=>$id_skpd))->result();
	}

	public function insert($data)
	{
		$query = $this->db->insert('simanja_sender',$data);
		return $this->db->insert_id();
	}

	public function select_by_id($id = NULL) {
        if(!empty($id)){
            $this->db->where('id', $id);
        }        
        $query = $this->db->get('simanja_sender');
        return $query->row();   
    }

    public function update($data,$id = NULL)
	{
        $this->db->where('id', $id);
        $query = $this->db->update('simanja_sender',$data);
	}

	public function tolak($id = NULL, $data = null)
	{
		$this->db->where('id',$id);
		$query = $this->db->update('simanja_sender', $data);
		// redirect('sender');
	}

	public function delete($id = NULL)
	{
		$this->db->where('id',$id);
		$query = $this->db->delete('simanja_sender');	
		// redirect('sender');
	}

	public function delete_anjab($id = NULL)
	{
		$this->db->where('id_analisis_jabatan',$id);
		$query = $this->db->delete('simanja_sender');	
		// redirect('sender');
	}

	public function cek($data){
		$q = $this->db->get_where('simanja_sender',array('id_skpd'=>$data['id_skpd'],'id_unit_kerja'=>$data['id_unit_kerja'],'nama_jabatan'=>$data['nama_jabatan'],'jenis_jabatan'=>$data['jenis_jabatan']))->row();
		return $q;
	}

	public function get($param)
	{
		if(isset($param['where']))
		{
			$this->db->where($param['where']);
		}
		if(isset($param['str_where']))
		{
			$this->db->where($param['str_where']);
		}

		if(isset($param['search']))
        {
            $this->db->where("(
				jabatan.nama_jabatan like '%".$param['search']."%' 
			)");
        }

		if(isset($param['limit']) && isset($param['offset']))
        {
            $this->db->limit($param['limit'],$param['offset']);
        }
		

		$this->db->join('pegawai', '(jabatan.id = pegawai.id and pegawai.pensiun =0) ','left');
		$this->db->join('ref_skpd skpd', 'skpd.id_skpd = jabatan.id_skpd','left');
		$this->db->join('ref_unit_kerja unit_kerja', 'unit_kerja.id_unit_kerja = jabatan.id_unit_kerja','left');
		$foto_url = base_url()."data/foto/pegawai/";
		$this->db->select("jabatan.*, 
			case 
				WHEN pegawai.foto_pegawai = '' THEN concat('".$foto_url."','user-default.png')
				else concat('".$foto_url."',pegawai.foto_pegawai)
			end	 as 'link_foto_pegawai',
		pegawai.nama_lengkap, pegawai.nip, pegawai.pangkat, pegawai.golongan, skpd.nama_skpd, unit_kerja.nama_unit_kerja");

		$rs = $this->db->get("simanja_sender jabatan");
		return $rs;
	}

	public function get_skpd($param)
	{
		if(isset($param['where']))
		{
			$this->db->where($param['where']);
		}
		if(isset($param['str_where']))
		{
			//$this->db->where($param['str_where']);
		}


		if(isset($param['limit']) && isset($param['offset']))
        {
            $this->db->limit($param['limit'],$param['offset']);
        }


		//$this->db->join('pegawai', 'jabatan.id = pegawai.id','left');
		$this->db->join('ref_skpd skpd', 'skpd.id_skpd = jabatan.id_skpd','left');
		

		$this->db->select("skpd.id_skpd, skpd.nama_skpd, count(jabatan.id) as 'total' ");

		$this->db->group_by("skpd.id_skpd");
		$this->db->order_by("count(jabatan.id)","DESC");

		$rs = $this->db->get("simanja_sender jabatan");
		return $rs;
	}

	public function get_struktur($id_skpd)
	{
		$tree = array();
		$data = array();

		$param_root['where']['jabatan.id_skpd'] = $id_skpd;
		$param_root['where']['jabatan.id_induk'] = 0;
		$lv_root = $this->get($param_root)->result();

		foreach($lv_root as $root)
		{
			$tree[$root->id] = array();
			$data[$root->id] = array(
				'nama'		=> $root->nama_lengkap,
				'jabatan'	=> $root->nama_jabatan,
				'tunjangan'	=> $root->tunjangan,
				'link_foto_pegawai'	=> $root->link_foto_pegawai,
			);

			
			$param_lv1['where']['jabatan.id_induk'] = $root->id;
			$param_lv1['where']['jabatan.id_skpd'] = $id_skpd;
			$level_1 = $this->get($param_lv1)->result();

			foreach($level_1 as $lv1)
			{
				$tree[$root->id][$lv1->id] = array();

				$data[$lv1->id] = array(
					'nama'		=> $lv1->nama_lengkap,
					'jabatan'	=> $lv1->nama_jabatan,
					'tunjangan'	=> $lv1->tunjangan,
					'link_foto_pegawai'	=> $lv1->link_foto_pegawai,
				);

				$param_lv2['where']['jabatan.id_induk'] = $lv1->id;
				$param_lv2['where']['jabatan.id_skpd'] = $id_skpd;
				$level_2 = $this->get($param_lv2)->result();

				foreach($level_2 as $lv2)
				{
					$tree[$root->id][$lv1->id][$lv2->id] = array();

					$data[$lv2->id] = array(
						'nama'		=> $lv2->nama_lengkap,
						'jabatan'	=> $lv2->nama_jabatan,
						'tunjangan'	=> $lv2->tunjangan,
						'link_foto_pegawai'	=> $lv2->link_foto_pegawai,
					);
					
					$param_lv3['where']['jabatan.id_induk'] = $lv2->id;
					$param_lv3['where']['jabatan.id_skpd'] = $id_skpd;
					$level_3 = $this->get($param_lv3)->result();

					foreach($level_3 as $lv3)
					{
						$tree[$root->id][$lv1->id][$lv2->id][$lv3->id] = array();

						$data[$lv3->id] = array(
							'nama'		=> $lv3->nama_lengkap,
							'jabatan'	=> $lv3->nama_jabatan,
							'tunjangan'	=> $lv3->tunjangan,
							'link_foto_pegawai'	=> $lv3->link_foto_pegawai,
						);

						$param_lv4['where']['jabatan.id_induk'] = $lv3->id;
						$param_lv4['where']['jabatan.id_skpd'] = $id_skpd;
						$level_4 = $this->get($param_lv4)->result();

						foreach($level_4 as $lv4)
						{
							$tree[$root->id][$lv1->id][$lv2->id][$lv3->id][$lv4->id] = array();

							$data[$lv4->id] = array(
								'nama'		=> $lv4->nama_lengkap,
								'jabatan'	=> $lv4->nama_jabatan,
								'tunjangan'	=> $lv4->tunjangan,
								'link_foto_pegawai'	=> $lv4->link_foto_pegawai,
							);
						}
					}
					
				}

			}
		}
		

		return array(
			'tree'	=> $tree,
			'data'	=> $data,
		);
	}

	public function insert_excel($data){
		$insert = $this->db->insert_batch('simanja_sender', $data);
		if($insert){
			return true;
		}
	}
}
?>