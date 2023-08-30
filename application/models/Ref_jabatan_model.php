<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ref_jabatan_model extends CI_Model
{

	public $id_visi;
	public $visi;

	public $id_misi;
	public $misi;
	
	public $id_tujuan;
	public $tujuan;


	public function get_all_ref()
	{
		if($this->session->userdata('level') != 'Administrator'){
			$this->db->where('id_jabatan',$this->session->userdata('id_jabatan'));
		}
		$this->db->order_by('grade','DESC');
		$query = $this->db->get('ref_jabatan_baru');
		return $query->result();
	}

	public function get_by_id($id_jabatan){
		return $this->db->get_where('ref_jabatan_baru',array('id_jabatan'=>$id_jabatan))->row();
	}

	public function get_by_id_skpd($id_skpd){
		return $this->db->get_where('ref_jabatan_baru',array('id_skpd'=>$id_skpd))->result();
	}

	public function insert_ref($data)
	{
		$query = $this->db->insert('ref_jabatan_baru',$data);
		return $this->db->insert_id();
	}

	public function select_by_id_ref($id = NULL) {
        if(!empty($id)){
            $this->db->where('id_jabatan', $id);
        }        
        $query = $this->db->get('ref_jabatan_baru');
        return $query->row();   
    }

    public function update_ref($data,$id = NULL)
	{
        $this->db->where('id_jabatan', $id);
        $query = $this->db->update('ref_jabatan_baru',$data);
	}
	
	public function delete_ref($id = NULL)
	{
		$this->db->where('id_jabatan',$id);
		$query = $this->db->delete('ref_jabatan_baru');	
		// redirect('ref_jabatan');
	}

	public function cek($data){
		$q = $this->db->get_where('ref_jabatan_baru',array('id_skpd'=>$data['id_skpd'],'id_unit_kerja'=>$data['id_unit_kerja'],'nama_jabatan'=>$data['nama_jabatan'],'jenis_jabatan'=>$data['jenis_jabatan']))->row();
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
		

		$this->db->join('pegawai', '(jabatan.id_jabatan = pegawai.id_jabatan and pegawai.pensiun =0) ','left');
		$this->db->join('ref_skpd skpd', 'skpd.id_skpd = jabatan.id_skpd','left');
		$this->db->join('ref_unit_kerja unit_kerja', 'unit_kerja.id_unit_kerja = jabatan.id_unit_kerja','left');
		$foto_url = base_url()."data/foto/pegawai/";
		$this->db->select("jabatan.*, 
			case 
				WHEN pegawai.foto_pegawai = '' THEN concat('".$foto_url."','user-default.png')
				else concat('".$foto_url."',pegawai.foto_pegawai)
			end	 as 'link_foto_pegawai',
		pegawai.nama_lengkap, pegawai.nip, pegawai.pangkat, pegawai.golongan, skpd.nama_skpd, unit_kerja.nama_unit_kerja");

		$rs = $this->db->get("ref_jabatan_baru jabatan");
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


		//$this->db->join('pegawai', 'jabatan.id_jabatan = pegawai.id_jabatan','left');
		$this->db->join('ref_skpd skpd', 'skpd.id_skpd = jabatan.id_skpd','left');
		

		$this->db->select("skpd.id_skpd, skpd.nama_skpd, count(jabatan.id_jabatan) as 'total' ");

		$this->db->group_by("skpd.id_skpd");
		$this->db->order_by("count(jabatan.id_jabatan)","DESC");

		$rs = $this->db->get("ref_jabatan_baru jabatan");
		return $rs;
	}

	public function get_struktur($id_skpd)
	{
		$tree = array();
		$data = array();

		$param_root['where']['jabatan.id_skpd'] = $id_skpd;
		$param_root['where']['jabatan.id_jabatan_induk'] = 0;
		$lv_root = $this->get($param_root)->result();

		foreach($lv_root as $root)
		{
			$tree[$root->id_jabatan] = array();
			$data[$root->id_jabatan] = array(
				'nama'		=> $root->nama_lengkap,
				'jabatan'	=> $root->nama_jabatan,
				'tunjangan'	=> $root->tunjangan,
				'link_foto_pegawai'	=> $root->link_foto_pegawai,
			);

			
			$param_lv1['where']['jabatan.id_jabatan_induk'] = $root->id_jabatan;
			$param_lv1['where']['jabatan.id_skpd'] = $id_skpd;
			$level_1 = $this->get($param_lv1)->result();

			foreach($level_1 as $lv1)
			{
				$tree[$root->id_jabatan][$lv1->id_jabatan] = array();

				$data[$lv1->id_jabatan] = array(
					'nama'		=> $lv1->nama_lengkap,
					'jabatan'	=> $lv1->nama_jabatan,
					'tunjangan'	=> $lv1->tunjangan,
					'link_foto_pegawai'	=> $lv1->link_foto_pegawai,
				);

				$param_lv2['where']['jabatan.id_jabatan_induk'] = $lv1->id_jabatan;
				$param_lv2['where']['jabatan.id_skpd'] = $id_skpd;
				$level_2 = $this->get($param_lv2)->result();

				foreach($level_2 as $lv2)
				{
					$tree[$root->id_jabatan][$lv1->id_jabatan][$lv2->id_jabatan] = array();

					$data[$lv2->id_jabatan] = array(
						'nama'		=> $lv2->nama_lengkap,
						'jabatan'	=> $lv2->nama_jabatan,
						'tunjangan'	=> $lv2->tunjangan,
						'link_foto_pegawai'	=> $lv2->link_foto_pegawai,
					);
					
					$param_lv3['where']['jabatan.id_jabatan_induk'] = $lv2->id_jabatan;
					$param_lv3['where']['jabatan.id_skpd'] = $id_skpd;
					$level_3 = $this->get($param_lv3)->result();

					foreach($level_3 as $lv3)
					{
						$tree[$root->id_jabatan][$lv1->id_jabatan][$lv2->id_jabatan][$lv3->id_jabatan] = array();

						$data[$lv3->id_jabatan] = array(
							'nama'		=> $lv3->nama_lengkap,
							'jabatan'	=> $lv3->nama_jabatan,
							'tunjangan'	=> $lv3->tunjangan,
							'link_foto_pegawai'	=> $lv3->link_foto_pegawai,
						);

						$param_lv4['where']['jabatan.id_jabatan_induk'] = $lv3->id_jabatan;
						$param_lv4['where']['jabatan.id_skpd'] = $id_skpd;
						$level_4 = $this->get($param_lv4)->result();

						foreach($level_4 as $lv4)
						{
							$tree[$root->id_jabatan][$lv1->id_jabatan][$lv2->id_jabatan][$lv3->id_jabatan][$lv4->id_jabatan] = array();

							$data[$lv4->id_jabatan] = array(
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

	public function get_by_name($params)
	{
		$this->db->like('jabatan', $params);
		return $this->db->get('ref_jabatan')->result_array();
	}
}
?>