<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Analisis_jabatan_model extends CI_Model
{

	public $id_visi;
	public $visi;

	public $id_misi;
	public $misi;
	
	public $id_tujuan;
	public $tujuan;

	public function get_all_ref($where = '', $admin =  null)
	{
		$this->db->select('simanja_analisis_jabatan.*, ref_skpd.id_skpd as idSkpd, ref_skpd.nama_skpd, induk_jabatan.id as idIndukJabatan, induk_jabatan.nama as namaIndukJabatan');
		if($admin == 1){
			$this->db->where('simanja_analisis_jabatan.id_skpd',$this->session->userdata('id_skpd'));
		}else{
			if($where){
				if($where['id_skpd']){
					$this->db->where('simanja_analisis_jabatan.id_skpd' , $where['id_skpd']);
				}
				if($where['jenis_jabatan']){
					$this->db->where('simanja_analisis_jabatan.jenis_jabatan' , $where['jenis_jabatan']);
				}
			}
		}
		$this->db->join('ref_skpd', 'ref_skpd.id_skpd = simanja_analisis_jabatan.id_skpd', 'left');
		$this->db->join('simanja_analisis_jabatan as induk_jabatan', 'induk_jabatan.id = simanja_analisis_jabatan.id_induk_jabatan', 'left');
		$this->db->order_by('simanja_analisis_jabatan.nama');
		$query = $this->db->get('simanja_analisis_jabatan');
		return $query->result();
	}
	
	public function get_by_id($id){
		$this->db->select('simanja_analisis_jabatan.*, ref_skpd.id_skpd as idSkpd, ref_skpd.nama_skpd as namaSkpd, ref_skpd.jenis_skpd as jenisSkpd, administrator.id as idAdministrator, administrator.nama as namaAdministrator,
		pengawas.id as idPengawas, pengawas.nama as namaPengawas, jpt_pratama.id as idJptPratama, jpt_pratama.nama as namaJptPratama, induk_jabatan.id as idIndukJabatan, induk_jabatan.nama as namaIndukJabatan');
		$this->db->join('simanja_analisis_jabatan as jpt_pratama', 'jpt_pratama.id = simanja_analisis_jabatan.jpt_pratama', 'left');
		$this->db->join('simanja_analisis_jabatan as administrator', 'administrator.id = simanja_analisis_jabatan.administrator', 'left');
		$this->db->join('simanja_analisis_jabatan as pengawas', 'pengawas.id = simanja_analisis_jabatan.pengawas', 'left');
		$this->db->join('simanja_analisis_jabatan as induk_jabatan', 'induk_jabatan.id = simanja_analisis_jabatan.id_induk_jabatan', 'left');
		$this->db->join('ref_skpd', 'ref_skpd.id_skpd = simanja_analisis_jabatan.id_skpd', 'left');
		return $this->db->get_where('simanja_analisis_jabatan',array('simanja_analisis_jabatan.id'=>$id))->row();
	}

	public function get_by_id_skpd($id_skpd){
		return $this->db->get_where('simanja_analisis_jabatan',array('id_skpd'=>$id_skpd))->result();
	}

	public function insert_ref($data)
	{
		$query = $this->db->insert('simanja_analisis_jabatan',$data);
		return $this->db->insert_id();
	}

	public function select_by_id_ref($id = NULL) {
        if(!empty($id)){
            $this->db->where('id', $id);
        }        
        $query = $this->db->get('simanja_analisis_jabatan');
        return $query->row();   
    }

    public function update_ref($data,$id = NULL)
	{
        $this->db->where('id', $id);
        $query = $this->db->update('simanja_analisis_jabatan',$data);
	}
	
	public function delete_ref($id = NULL)
	{
		$this->db->where('id',$id);
		$query = $this->db->delete('simanja_analisis_jabatan');	
		// redirect('ref_bakat_kerja');
	}

	public function cek($data){
		$q = $this->db->get_where('simanja_analisis_jabatan',array('id_skpd'=>$data['id_skpd'],'id_unit_kerja'=>$data['id_unit_kerja'],'nama_jabatan'=>$data['nama_jabatan'],'jenis_jabatan'=>$data['jenis_jabatan']))->row();
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

		$rs = $this->db->get("simanja_analisis_jabatan jabatan");
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

		$rs = $this->db->get("simanja_analisis_jabatan jabatan");
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
		$insert = $this->db->insert_batch('simanja_analisis_jabatan', $data);
		if($insert){
			return true;
		}
	}

	public function insert_excel_one($data){
		$insert = $this->db->insert('simanja_analisis_jabatan', $data);
		if($insert){
			return true;
		}
	}

	public function get_by_skpd($id, $where = null)
	{
		if($where){
			$this->db->where($where);
		}
		return $this->db->get_where('simanja_analisis_jabatan', ['id_skpd' => $id])->result();
	}

	public function get_induk($id_induk=null, $jenis_pegawai=null, $jenis_jabatan=null){

		if ($id_induk) $this->db->where('id_induk_jabatan',$id_induk);
		if ($jenis_pegawai) $this->db->where_in('jenis_pegawai',$jenis_pegawai);
		if ($jenis_jabatan) $this->db->where('jenis_jabatan',$jenis_jabatan);
		$query = $this->db->get('simanja_analisis_jabatan');
		return $query->result();
	}

	public function get_jabatan_by_skpd_id_type($id=null, $type=null){

		if ($id) $this->db->where('id_skpd',$id);
		if ($type) $this->db->where('jenis_pegawai',$type);
		$query = $this->db->get('simanja_analisis_jabatan');
		return $query->result();
	}

	//Kualifikasi Jabatan
	public function get_all_kualifikasi_jabatan($id = '', $limit = '')
	{
		if($id){
			$this->db->where('simanja_kualifikasi_jabatan.id_analisis_jabatan', $id);
		}
		if($limit){
			$this->db->limit(1);
		}
		$query = $this->db->get('simanja_kualifikasi_jabatan');
		return $query->result();
	}

	public function insert_kualifikasi_jabatan($data)
	{
		$query = $this->db->insert('simanja_kualifikasi_jabatan',$data);
		return $this->db->insert_id();
	}

	public function select_by_id_kualifikasi_jabatan($id = NULL) {
        if(!empty($id)){
            $this->db->where('id', $id);
        }        
        $query = $this->db->get('simanja_kualifikasi_jabatan');
        return $query->row();   
    }

	public function select_by_id_kualifikasi_jabatan_anjab($id_analisis_jabatan = null) {
		if(!empty($id_analisis_jabatan)){
			$this->db->where('id_analisis_jabatan', $id_analisis_jabatan);
		}
		$this->db->order_by('created_at','DESC');
		$this->db->limit(1);        
		$query = $this->db->get('simanja_kualifikasi_jabatan');
		return $query->row();   
	}

    public function update_kualifikasi_jabatan($data,$id = NULL)
	{
        $this->db->where('id', $id);
        $query = $this->db->update('simanja_kualifikasi_jabatan',$data);
	}
	
	public function delete_kualifikasi_jabatan($id = NULL)
	{
		$this->db->where('id',$id);
		$query = $this->db->delete('simanja_kualifikasi_jabatan');	
	}

	//Tugas Pokok
	public function get_all_tugas_pokok($id = '')
	{
		if($id){
			$this->db->where('simanja_tugas_pokok.id_analisis_jabatan', $id);
		}
		$query = $this->db->get('simanja_tugas_pokok');
		return $query->result();
	}

	public function insert_tugas_pokok($data)
	{
		$query = $this->db->insert('simanja_tugas_pokok',$data);
		return $this->db->insert_id();
	}

	public function select_by_id_tugas_pokok($id = NULL) {
        if(!empty($id)){
            $this->db->where('id', $id);
        }        
        $query = $this->db->get('simanja_tugas_pokok');
        return $query->row();   
    }

    public function update_tugas_pokok($data,$id = NULL)
	{
        $this->db->where('id', $id);
        $query = $this->db->update('simanja_tugas_pokok',$data);
	}
	
	public function delete_tugas_pokok($id = NULL)
	{
		$this->db->where('id',$id);
		$query = $this->db->delete('simanja_tugas_pokok');	
	}

	//Hasil Kerja
	public function get_all_hasil_kerja($id = '')
	{
		$this->db->select('simanja_hasil_kerja.*, simanja_tugas_pokok.id as idTugasPokok, simanja_tugas_pokok.uraian_tugas as uraianTugas, simanja_ref_satuan_hasil.id as idSatuanHasil, simanja_ref_satuan_hasil.nama as satuan_hasil');
		if($id){
			$this->db->where('simanja_hasil_kerja.id_analisis_jabatan', $id);
		}
		$this->db->join('simanja_tugas_pokok', 'simanja_tugas_pokok.id = simanja_hasil_kerja.id_tugas_pokok', 'left');
		$this->db->join('simanja_ref_satuan_hasil', 'simanja_ref_satuan_hasil.id = simanja_hasil_kerja.id_satuan_hasil', 'left');
		$query = $this->db->get('simanja_hasil_kerja');
		return $query->result();
	}

	public function insert_hasil_kerja($data)
	{
		$query = $this->db->insert('simanja_hasil_kerja',$data);
		return $this->db->insert_id();
	}

	public function select_by_id_hasil_kerja($id = NULL) {
        if(!empty($id)){
            $this->db->where('id', $id);
        }        
        $query = $this->db->get('simanja_hasil_kerja');
        return $query->row();   
    }

    public function update_hasil_kerja($data,$id = NULL)
	{
        $this->db->where('id', $id);
        $query = $this->db->update('simanja_hasil_kerja',$data);
	}
	
	public function delete_hasil_kerja($id = NULL)
	{
		$this->db->where('id',$id);
		$query = $this->db->delete('simanja_hasil_kerja');	
	}

	//Bahan Kerja
	public function get_all_bahan_kerja($id = '')
	{
		if($id){
			$this->db->where('simanja_bahan_kerja.id_analisis_jabatan', $id);
		}
		$query = $this->db->get('simanja_bahan_kerja');
		return $query->result();
	}

	public function insert_bahan_kerja($data)
	{
		$query = $this->db->insert('simanja_bahan_kerja',$data);
		return $this->db->insert_id();
	}

	public function select_by_id_bahan_kerja($id = NULL) {
        if(!empty($id)){
            $this->db->where('id', $id);
        }        
        $query = $this->db->get('simanja_bahan_kerja');
        return $query->row();   
    }

    public function update_bahan_kerja($data,$id = NULL)
	{
        $this->db->where('id', $id);
        $query = $this->db->update('simanja_bahan_kerja',$data);
	}
	
	public function delete_bahan_kerja($id = NULL)
	{
		$this->db->where('id',$id);
		$query = $this->db->delete('simanja_bahan_kerja');	
	}

	//Perangkat Kerja
	public function get_all_perangkat_kerja($id = '')
	{
		if($id){
			$this->db->where('simanja_perangkat_kerja.id_analisis_jabatan', $id);
		}
		$query = $this->db->get('simanja_perangkat_kerja');
		return $query->result();
	}

	public function insert_perangkat_kerja($data)
	{
		$query = $this->db->insert('simanja_perangkat_kerja',$data);
		return $this->db->insert_id();
	}

	public function select_by_id_perangkat_kerja($id = NULL) {
        if(!empty($id)){
            $this->db->where('id', $id);
        }        
        $query = $this->db->get('simanja_perangkat_kerja');
        return $query->row();   
    }

    public function update_perangkat_kerja($data,$id = NULL)
	{
        $this->db->where('id', $id);
        $query = $this->db->update('simanja_perangkat_kerja',$data);
	}
	
	public function delete_perangkat_kerja($id = NULL)
	{
		$this->db->where('id',$id);
		$query = $this->db->delete('simanja_perangkat_kerja');	
	}

	//Tanggung Jawab
	public function get_all_tanggung_jawab($id = '')
	{
		if($id){
			$this->db->where('simanja_tanggung_jawab.id_analisis_jabatan', $id);
		}
		$query = $this->db->get('simanja_tanggung_jawab');
		return $query->result();
	}

	public function insert_tanggung_jawab($data)
	{
		$query = $this->db->insert('simanja_tanggung_jawab',$data);
		return $this->db->insert_id();
	}

	public function select_by_id_tanggung_jawab($id = NULL) {
        if(!empty($id)){
            $this->db->where('id', $id);
        }        
        $query = $this->db->get('simanja_tanggung_jawab');
        return $query->row();   
    }

    public function update_tanggung_jawab($data,$id = NULL)
	{
        $this->db->where('id', $id);
        $query = $this->db->update('simanja_tanggung_jawab',$data);
	}
	
	public function delete_tanggung_jawab($id = NULL)
	{
		$this->db->where('id',$id);
		$query = $this->db->delete('simanja_tanggung_jawab');	
	}

	//Wewenang
	public function get_all_wewenang($id = '')
	{
		if($id){
			$this->db->where('simanja_wewenang.id_analisis_jabatan', $id);
		}
		$query = $this->db->get('simanja_wewenang');
		return $query->result();
	}

	public function insert_wewenang($data)
	{
		$query = $this->db->insert('simanja_wewenang',$data);
		return $this->db->insert_id();
	}

	public function select_by_id_wewenang($id = NULL) {
        if(!empty($id)){
            $this->db->where('id', $id);
        }        
        $query = $this->db->get('simanja_wewenang');
        return $query->row();   
    }

    public function update_wewenang($data,$id = NULL)
	{
        $this->db->where('id', $id);
        $query = $this->db->update('simanja_wewenang',$data);
	}
	
	public function delete_wewenang($id = NULL)
	{
		$this->db->where('id',$id);
		$query = $this->db->delete('simanja_wewenang');	
	}

	//Korelasi Jabatan
	public function get_all_korelasi_jabatan($id = '')
	{
		if($id){
			$this->db->where('simanja_korelasi_jabatan.id_analisis_jabatan', $id);
		}
		$query = $this->db->get('simanja_korelasi_jabatan');
		return $query->result();
	}

	public function insert_korelasi_jabatan($data)
	{
		$query = $this->db->insert('simanja_korelasi_jabatan',$data);
		return $this->db->insert_id();
	}

	public function select_by_id_korelasi_jabatan($id = NULL) {
        if(!empty($id)){
            $this->db->where('id', $id);
        }        
        $query = $this->db->get('simanja_korelasi_jabatan');
        return $query->row();   
    }

    public function update_korelasi_jabatan($data,$id = NULL)
	{
        $this->db->where('id', $id);
        $query = $this->db->update('simanja_korelasi_jabatan',$data);
	}
	
	public function delete_korelasi_jabatan($id = NULL)
	{
		$this->db->where('id',$id);
		$query = $this->db->delete('simanja_korelasi_jabatan');	
	}

	//Kondisi Lingkungan Kerja
	public function get_all_kondisi_lingkungan_kerja($id = '', $limit = '')
	{
		if($id){
			$this->db->where('simanja_kondisi_lingkungan_kerja.id_analisis_jabatan', $id);
		}
		if($limit){
			$this->db->limit(1);
		}
		$query = $this->db->get('simanja_kondisi_lingkungan_kerja');
		return $query->result();
	}

	public function insert_kondisi_lingkungan_kerja($data)
	{
		$query = $this->db->insert('simanja_kondisi_lingkungan_kerja',$data);
		return $this->db->insert_id();
	}

	public function select_by_id_kondisi_lingkungan_kerja($id = NULL) {
        if(!empty($id)){
            $this->db->where('id', $id);
        }        
        $query = $this->db->get('simanja_kondisi_lingkungan_kerja');
        return $query->row();   
    }

	public function select_by_id_kondisi_lingkungan_kerja_anjab($id_analisis_jabatan = null) {
		if(!empty($id_analisis_jabatan)){
			$this->db->where('id_analisis_jabatan', $id_analisis_jabatan);
		}
		$this->db->order_by('created_at','DESC');
		$this->db->limit(1);        
		$query = $this->db->get('simanja_kondisi_lingkungan_kerja');
		return $query->row();   
	}

    public function update_kondisi_lingkungan_kerja($data,$id = NULL)
	{
        $this->db->where('id', $id);
        $query = $this->db->update('simanja_kondisi_lingkungan_kerja',$data);
	}
	
	public function delete_kondisi_lingkungan_kerja($id = NULL)
	{
		$this->db->where('id',$id);
		$query = $this->db->delete('simanja_kondisi_lingkungan_kerja');	
	}

	//Risiko Bahaya
	public function get_all_risiko_bahaya($id = '')
	{
		if($id){
			$this->db->where('simanja_risiko_bahaya.id_analisis_jabatan', $id);
		}
		$query = $this->db->get('simanja_risiko_bahaya');
		return $query->result();
	}

	public function insert_risiko_bahaya($data)
	{
		$query = $this->db->insert('simanja_risiko_bahaya',$data);
		return $this->db->insert_id();
	}

	public function select_by_id_risiko_bahaya($id = NULL) {
        if(!empty($id)){
            $this->db->where('id', $id);
        }        
        $query = $this->db->get('simanja_risiko_bahaya');
        return $query->row();   
    }

    public function update_risiko_bahaya($data,$id = NULL)
	{
        $this->db->where('id', $id);
        $query = $this->db->update('simanja_risiko_bahaya',$data);
	}
	
	public function delete_risiko_bahaya($id = NULL)
	{
		$this->db->where('id',$id);
		$query = $this->db->delete('simanja_risiko_bahaya');	
	}

	//Syarat Keterampilan Kerja
	public function insert_syarat_keterampilan_kerja_batch($data){
		$insert = $this->db->insert_batch('simanja_syarat_keterampilan_kerja', $data);
		if($insert){
			return true;
		}
	}

	public function truncate_syarat_keterampilan_kerja_batch($id = '')
	{
		if($id){
			$this->db->where('id_analisis_jabatan', $id);
			return $this->db->delete('simanja_syarat_keterampilan_kerja'); 
		}
	}

	public function get_all_syarat_keterampilan_kerja($id = '')
	{
		$this->db->select('simanja_syarat_keterampilan_kerja.*, simanja_ref_keterampilan_kerja.id, simanja_ref_keterampilan_kerja.nama as keterampilan_kerja');
		$this->db->join('simanja_ref_keterampilan_kerja', 'simanja_ref_keterampilan_kerja.id = simanja_syarat_keterampilan_kerja.id_keterampilan_kerja', 'left');
		if($id){
			$this->db->where('simanja_syarat_keterampilan_kerja.id_analisis_jabatan', $id);
		}
		$query = $this->db->get('simanja_syarat_keterampilan_kerja');
		return $query->result();
	}

	public function insert_syarat_keterampilan_kerja($data)
	{
		$query = $this->db->insert('simanja_syarat_keterampilan_kerja',$data);
		return $this->db->insert_id();
	}

	public function select_by_id_syarat_keterampilan_kerja($id = NULL) {
        if(!empty($id)){
            $this->db->where('id', $id);
        }        
        $query = $this->db->get('simanja_syarat_keterampilan_kerja');
        return $query->row();   
    }

    public function update_syarat_keterampilan_kerja($data,$id = NULL)
	{
        $this->db->where('id', $id);
        $query = $this->db->update('simanja_syarat_keterampilan_kerja',$data);
	}
	
	public function delete_syarat_keterampilan_kerja($id = NULL)
	{
		$this->db->where('id',$id);
		$query = $this->db->delete('simanja_syarat_keterampilan_kerja');	
	}

	//Syarat Bakat Kerja
	public function insert_syarat_bakat_kerja_batch($data){
		$insert = $this->db->insert_batch('simanja_syarat_bakat_kerja', $data);
		if($insert){
			return true;
		}
	}

	public function truncate_syarat_bakat_kerja_batch($id = '')
	{
		if($id){
			$this->db->where('id_analisis_jabatan', $id);
			return $this->db->delete('simanja_syarat_bakat_kerja'); 
		}
	}

	public function get_all_syarat_bakat_kerja($id = '')
	{
		$this->db->select('simanja_syarat_bakat_kerja.*, simanja_ref_bakat_kerja.id, simanja_ref_bakat_kerja.kode as kode_bakat_kerja, simanja_ref_bakat_kerja.arti as bakat_kerja');
		$this->db->join('simanja_ref_bakat_kerja', 'simanja_ref_bakat_kerja.id = simanja_syarat_bakat_kerja.id_bakat_kerja', 'left');
		if($id){
			$this->db->where('simanja_syarat_bakat_kerja.id_analisis_jabatan', $id);
		}
		$query = $this->db->get('simanja_syarat_bakat_kerja');
		return $query->result();
	}

	public function select_by_id_syarat_bakat_kerja($id = NULL) {
        if(!empty($id)){
            $this->db->where('id', $id);
        }        
        $query = $this->db->get('simanja_syarat_bakat_kerja');
        return $query->row();   
    }

	//Syarat Temperamen Kerja
	public function insert_syarat_temperamen_kerja_batch($data){
		$insert = $this->db->insert_batch('simanja_syarat_temperamen_kerja', $data);
		if($insert){
			return true;
		}
	}

	public function truncate_syarat_temperamen_kerja_batch($id = '')
	{
		if($id){
			$this->db->where('id_analisis_jabatan', $id);
			return $this->db->delete('simanja_syarat_temperamen_kerja'); 
		}
	}

	public function get_all_syarat_temperamen_kerja($id = '')
	{
		$this->db->select('simanja_syarat_temperamen_kerja.*, simanja_ref_temperamen_kerja.id, simanja_ref_temperamen_kerja.kode as kode_temperamen_kerja, simanja_ref_temperamen_kerja.arti as temperamen_kerja');
		$this->db->join('simanja_ref_temperamen_kerja', 'simanja_ref_temperamen_kerja.id = simanja_syarat_temperamen_kerja.id_temperamen_kerja', 'left');
		if($id){
			$this->db->where('simanja_syarat_temperamen_kerja.id_analisis_jabatan', $id);
		}
		$query = $this->db->get('simanja_syarat_temperamen_kerja');
		return $query->result();
	}

	public function select_by_id_syarat_temperamen_kerja($id = NULL) {
        if(!empty($id)){
            $this->db->where('id', $id);
        }        
        $query = $this->db->get('simanja_syarat_temperamen_kerja');
        return $query->row();   
    }

	//Syarat Minat Kerja
	public function insert_syarat_minat_kerja_batch($data){
		$insert = $this->db->insert_batch('simanja_syarat_minat_kerja', $data);
		if($insert){
			return true;
		}
	}

	public function truncate_syarat_minat_kerja_batch($id = '')
	{
		if($id){
			$this->db->where('id_analisis_jabatan', $id);
			return $this->db->delete('simanja_syarat_minat_kerja'); 
		}
	}

	public function get_all_syarat_minat_kerja($id = '')
	{
		$this->db->select('simanja_syarat_minat_kerja.*, simanja_ref_minat_kerja.id, simanja_ref_minat_kerja.penjelasan as minat_kerja, simanja_ref_minat_kerja.kode as kode_minat_kerja');
		$this->db->join('simanja_ref_minat_kerja', 'simanja_ref_minat_kerja.id = simanja_syarat_minat_kerja.id_minat_kerja', 'left');
		if($id){
			$this->db->where('simanja_syarat_minat_kerja.id_analisis_jabatan', $id);
		}
		$query = $this->db->get('simanja_syarat_minat_kerja');
		return $query->result();
	}

	public function select_by_id_syarat_minat_kerja($id = NULL) {
        if(!empty($id)){
            $this->db->where('id', $id);
        }        
        $query = $this->db->get('simanja_syarat_minat_kerja');
        return $query->row();   
    }

	//Syarat Upaya Fisik
	public function insert_syarat_upaya_fisik_batch($data){
		$insert = $this->db->insert_batch('simanja_syarat_upaya_fisik', $data);
		if($insert){
			return true;
		}
	}

	public function truncate_syarat_upaya_fisik_batch($id = '')
	{
		if($id){
			$this->db->where('id_analisis_jabatan', $id);
			return $this->db->delete('simanja_syarat_upaya_fisik'); 
		}
	}

	public function get_all_syarat_upaya_fisik($id = '')
	{
		$this->db->select('simanja_syarat_upaya_fisik.*, simanja_ref_upaya_fisik.id, simanja_ref_upaya_fisik.arti as upaya_fisik, simanja_ref_upaya_fisik.kode as kode_upaya_fisik');
		$this->db->join('simanja_ref_upaya_fisik', 'simanja_ref_upaya_fisik.id = simanja_syarat_upaya_fisik.id_upaya_fisik', 'left');
		if($id){
			$this->db->where('simanja_syarat_upaya_fisik.id_analisis_jabatan', $id);
		}
		$query = $this->db->get('simanja_syarat_upaya_fisik');
		return $query->result();
	}

	public function select_by_id_syarat_upaya_fisik($id = NULL) {
        if(!empty($id)){
            $this->db->where('id', $id);
        }        
        $query = $this->db->get('simanja_syarat_upaya_fisik');
        return $query->row();   
    }

	//Kondisi Fisik
	public function get_all_syarat_kondisi_fisik($id = '', $limit = '')
	{
		if($id){
			$this->db->where('simanja_syarat_kondisi_fisik.id_analisis_jabatan', $id);
		}
		if($limit){
			$this->db->limit(1);
		}
		$query = $this->db->get('simanja_syarat_kondisi_fisik');
		return $query->result();
	}

	public function insert_syarat_kondisi_fisik($data)
	{
		$query = $this->db->insert('simanja_syarat_kondisi_fisik',$data);
		return $this->db->insert_id();
	}

	public function select_by_id_syarat_kondisi_fisik($id = NULL) {
		if(!empty($id)){
			$this->db->where('id', $id);
		}        
		$query = $this->db->get('simanja_syarat_kondisi_fisik');
		return $query->row();   
	}

	public function select_by_id_syarat_kondisi_fisik_anjab($id_analisis_jabatan = null) {
		if(!empty($id_analisis_jabatan)){
			$this->db->where('id_analisis_jabatan', $id_analisis_jabatan);
		}
		$this->db->order_by('created_at','DESC');
		$this->db->limit(1);        
		$query = $this->db->get('simanja_syarat_kondisi_fisik');
		return $query->row();   
	}

	public function update_syarat_kondisi_fisik($data,$id = NULL)
	{
		$this->db->where('id', $id);
		$query = $this->db->update('simanja_syarat_kondisi_fisik',$data);
	}
	
	public function delete_syarat_kondisi_fisik($id = NULL)
	{
		$this->db->where('id',$id);
		$query = $this->db->delete('simanja_syarat_kondisi_fisik');	
	}

	//Syarat Fungsi Jabatan
	public function insert_syarat_fungsi_pekerjaan_batch($data){
		$insert = $this->db->insert_batch('simanja_syarat_fungsi_pekerjaan', $data);
		if($insert){
			return true;
		}
	}

	public function truncate_syarat_fungsi_pekerjaan_batch($id = '')
	{
		if($id){
			$this->db->where('id_analisis_jabatan', $id);
			return $this->db->delete('simanja_syarat_fungsi_pekerjaan'); 
		}
	}

	public function get_all_syarat_fungsi_pekerjaan($id = '')
	{
		$this->db->select('simanja_syarat_fungsi_pekerjaan.*, simanja_ref_fungsi_pekerjaan.id, simanja_ref_fungsi_pekerjaan.kode as kode_fungsi_pekerjaan, simanja_ref_fungsi_pekerjaan.keterangan as fungsi_pekerjaan');
		$this->db->join('simanja_ref_fungsi_pekerjaan', 'simanja_ref_fungsi_pekerjaan.id = simanja_syarat_fungsi_pekerjaan.id_fungsi_pekerjaan', 'left');
		if($id){
			$this->db->where('simanja_syarat_fungsi_pekerjaan.id_analisis_jabatan', $id);
		}
		$query = $this->db->get('simanja_syarat_fungsi_pekerjaan');
		return $query->result();
	}

	public function get_all_syarat_fungsi_by_category_and_id($kategori, $id)
	{
		$this->db->select('simanja_syarat_fungsi_pekerjaan.*, simanja_ref_fungsi_pekerjaan.id, simanja_ref_fungsi_pekerjaan.kode as kode_fungsi_pekerjaan, simanja_ref_fungsi_pekerjaan.keterangan as fungsi_pekerjaan');
		$this->db->join('simanja_ref_fungsi_pekerjaan', 'simanja_ref_fungsi_pekerjaan.id = simanja_syarat_fungsi_pekerjaan.id_fungsi_pekerjaan', 'left');
		if($kategori){
			$this->db->where('simanja_ref_fungsi_pekerjaan.kategori', $kategori);
		}
		if($id){
			$this->db->where('simanja_syarat_fungsi_pekerjaan.id_analisis_jabatan', $id);
		}
		$query = $this->db->get('simanja_syarat_fungsi_pekerjaan');
		return $query->result();
	}

	public function get_kualifikasi_pendidikan_jabatan()
	{
		$this->db->select('simanja_ref_jabatan.id, simanja_ref_jabatan.kualifikasi_pendidikan');
		$this->db->group_by('simanja_ref_jabatan.kualifikasi_pendidikan');
		$this->db->order_by('simanja_ref_jabatan.kualifikasi_pendidikan');
		return $this->db->get('simanja_ref_jabatan')->result();
	}

	public function get_ref_jabatan($type)
	{
		if($type) $this->db->where('jenis', $type);
		return $this->db->get('simanja_ref_jabatan')->result();
	}

	public function get_ref_diklat()
	{
		return $this->db->get('ref_jenisdiklat');
	}

	//
	public function get_jabatan_by_jenis_count($jenis = '', $where = ''){
		if($jenis){
			$this->db->where('jenis_jabatan', $jenis);
		}
		if($where){
			if($where['id_skpd']){
				$this->db->where('simanja_analisis_jabatan.id_skpd' , $where['id_skpd']);
			}
		}
		return $this->db->get('simanja_analisis_jabatan')->num_rows();
	}

	public function get_by_name_and_skpd($name, $id){
		return $this->db->get_where('simanja_analisis_jabatan', ['nama' => $name, 'id_skpd' => $id])->row();
	}

	public function kunci($id, $val){
		$this->db->where('id', $id);
		return $this->db->update('simanja_analisis_jabatan', ['status' => $val]);
	}

	public function kunci_semua($val, $id_skpd){
		if(!empty($id_skpd)){
			$this->db->where('id_skpd', $id_skpd);
		}
		return $this->db->update('simanja_analisis_jabatan', ['status' => $val]);
	}
}
?>