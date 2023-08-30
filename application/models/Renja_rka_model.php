<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Renja_rka_model extends CI_Model{
	//!#
	public function name($jenis){
		if($jenis=='ss'){
			$name = 'sasaran_strategis';
			$nSasaran = 'Sasaran Strategis';
		}elseif($jenis=='sp'){
			$name = 'sasaran_program';
			$nSasaran = 'Sasaran Program';
		}elseif($jenis=='sk'){
			$name = 'sasaran_kegiatan';
			$nSasaran = 'Sasaran Kegiatan';
		}
		$tSasaran = $name.'_renstra';
		$cSasaran = 'id_'.$tSasaran;
		$tIku = 'iku_'.$jenis.'_renstra';
		$cIku = 'id_'.$tIku;
		$cUnitKerja = 'casecade_unit_kerja_'.$tIku;

		$tIkuRenja = 'iku_'.$jenis.'_renja';
		$cIkuRenja = 'id_'.$tIkuRenja;
		$taIkuRenja = 'target_'.$jenis.'_renja';
		$aIkuRenja = 'anggaran_'.$jenis.'_renja';
		$rIkuRenja = 'realisasi_'.$jenis.'_renja';

		$tRenaksi = 'renaksi_'.$tIkuRenja;
		$cRenaksi = 'id_'.$tRenaksi;
		$tTaRenaksi = 'target_'.$tRenaksi;
		$cTaRenaksi = 'id_'.$tTaRenaksi;

		return array('cSasaran'=>$cSasaran,'tSasaran'=>$tSasaran,'tIku'=>$tIku,'cIku'=>$cIku,'cUnitKerja'=>$cUnitKerja,'name'=>$name,'nSasaran'=>$nSasaran,'tIkuRenja'=>$tIkuRenja,'cIkuRenja'=>$cIkuRenja,'taIkuRenja'=>$taIkuRenja,'aIkuRenja'=>$aIkuRenja,'rIkuRenja'=>$rIkuRenja,'tRenaksi'=>$tRenaksi,
			'cRenaksi'=>$cRenaksi,'tTaRenaksi'=>$tTaRenaksi,'cTaRenaksi'=>$cTaRenaksi);

	}

	public function get_detail_sasaran($jenis,$id_sasaran){
		$name = $this->name($jenis);
		return $this->db->get_where($name['tSasaran']."",array($name['cSasaran']=>$id_sasaran))->row();
	}
	//!#
	public function get_perencanaan_by_id_skpd($id_skpd){
		// $this->db->select("iku_sasaran_rpjmd.id_iku_sasaran_rpjmd, iku_sasaran_rpjmd.iku_sasaran_rpjmd, sasaran_rpjmd.id_sasaran_rpjmd, sasaran_rpjmd.sasaran_rpjmd, tujuan.id_tujuan, tujuan.tujuan, misi.id_misi, misi.misi, visi.id_visi, visi.visi");
		$this->db->where('iku_sasaran_rpjmd.id_skpd',$id_skpd);
		$this->db->join('sasaran_rpjmd', 'sasaran_rpjmd.id_sasaran_rpjmd = iku_sasaran_rpjmd.id_sasaran_rpjmd');
		$this->db->join('tujuan', 'tujuan.id_tujuan = sasaran_rpjmd.id_tujuan');
		$this->db->join('misi', 'misi.id_misi = tujuan.id_misi');
		$this->db->join('visi', 'visi.id_visi = misi.id_visi');
		$query = $this->db->get('iku_sasaran_rpjmd');
		return $query->result_array();
	}
	//!#
	public function get_rencana_kerja_by_tahun($tahun,$id_skpd){
		// $this->db->select("iku_sasaran_rpjmd.id_iku_sasaran_rpjmd, iku_sasaran_rpjmd.iku_sasaran_rpjmd, sasaran_rpjmd.id_sasaran_rpjmd, sasaran_rpjmd.sasaran_rpjmd, tujuan.id_tujuan, tujuan.tujuan, misi.id_misi, misi.misi, visi.id_visi, visi.visi");
		$ss 	= "SELECT COUNT(id_iku_ss_renja) FROM iku_ss_renja WHERE tahun_renja = '$tahun' AND id_skpd = '$id_skpd'";
		$sp 	= "SELECT COUNT(id_iku_sp_renja) FROM iku_sp_renja WHERE tahun_renja = '$tahun' AND id_skpd = '$id_skpd'";
		$sk 	= "SELECT COUNT(id_iku_sk_renja) FROM iku_sk_renja WHERE tahun_renja = '$tahun' AND id_skpd = '$id_skpd'";
		$ass 	= "SELECT SUM(anggaran_ss_renja) FROM iku_ss_renja WHERE tahun_renja = '$tahun' AND id_skpd = '$id_skpd'";
		$asp 	= "SELECT SUM(anggaran_sp_renja) FROM iku_sp_renja WHERE tahun_renja = '$tahun' AND id_skpd = '$id_skpd'";
		$ask 	= "SELECT SUM(anggaran_sk_renja) FROM iku_sk_renja WHERE tahun_renja = '$tahun' AND id_skpd = '$id_skpd'";
		$rss 	= "SELECT COUNT(id_renaksi_iku_ss_renja) FROM renaksi_iku_ss_renja WHERE id_iku_ss_renja IN (SELECT id_iku_ss_renja FROM iku_ss_renja WHERE tahun_renja = '$tahun' AND id_skpd = '$id_skpd')";
		$rsp 	= "SELECT COUNT(id_renaksi_iku_sp_renja) FROM renaksi_iku_sp_renja WHERE id_iku_sp_renja IN (SELECT id_iku_sp_renja FROM iku_sp_renja WHERE tahun_renja = '$tahun' AND id_skpd = '$id_skpd')";
		$rsk 	= "SELECT COUNT(id_renaksi_iku_sk_renja) FROM renaksi_iku_sk_renja WHERE id_iku_sk_renja IN (SELECT id_iku_sk_renja FROM iku_sk_renja WHERE tahun_renja = '$tahun' AND id_skpd = '$id_skpd')";
		$this->db->select('	('.$ss.') AS total_ss, ('.$sp.') AS total_sp, ('.$sk.') AS total_sk,
			('.$ass.') AS anggaran_ss, ('.$asp.') AS anggaran_sp, ('.$ask.') AS anggaran_sk,
			('.$rss.') AS renaksi_ss, ('.$rsp.') AS renaksi_sp, ('.$rsk.') AS renaksi_sk,
			');
		$query = $this->db->get();
		return $query->row();
	}
	//!#
	public function get_grafik_rencana_kerja_by_tahun($jenis,$tahun,$id_skpd){
		$name = $this->name($jenis);
		$this->db->where('tahun_renja', $tahun);
		$this->db->where($name['tIkuRenja'].'.id_skpd', $id_skpd);
		$this->db->join($name['tIku'],$name['tIku'].'.'.$name['cIku'].' = '.$name['tIkuRenja'].'.'.$name['cIku']);
		$this->db->join($name['tSasaran'],$name['tSasaran'].'.'.$name['cSasaran'].' = '.$name['tIku'].'.'.$name['cSasaran']);
		$this->db->join('ref_satuan','ref_satuan.id_satuan = '.$name['tIku'].'.id_satuan');
		$query = $this->db->get($name['tIkuRenja']);
		return $query->result();
	}

	//!#
	public function get_sasaran_strategis_by_id_skpd($id_skpd){
		$this->db->where('sasaran_strategis_renstra.id_skpd',$id_skpd);
		$query = $this->db->get('sasaran_strategis_renstra');
		return $query->result_array();
	}
	//!#
	public function get_iku_sasaran_strategis_by_id_ss($id_ss){
		$this->db->where('iku_ss_renstra.id_sasaran_strategis_renstra',$id_ss);
		$query = $this->db->get('iku_ss_renstra');
		return $query->result_array();
	}

	public function insert_sasaran_strategis_renstra($data)
	{
		if ($data) {
			$query = $this->db->insert('sasaran_strategis_renstra', $data);
			return true;
		}
	}


	//!#
	public function get_total_ss($id_skpd)
	{
		$this->db->where('id_skpd',$id_skpd);
		$query = $this->db->get('sasaran_strategis_renstra');
		return $query->num_rows();
	}

	public function get_total_iku_ss($id_skpd)
	{
		$this->db->where('id_skpd',$id_skpd);
		$query = $this->db->get('iku_ss_renstra');
		return $query->num_rows();
	}

	//!#
	public function get_total_sp($id_skpd)
	{
		$this->db->where('id_skpd',$id_skpd);
		$query = $this->db->get('sasaran_program_renstra');
		return $query->num_rows();
	}

	public function get_total_iku_sp($id_skpd)
	{
		$this->db->where('id_skpd',$id_skpd);
		$query = $this->db->get('iku_sp_renstra');
		return $query->num_rows();
	}


	//!#
	public function get_total_sk($id_skpd)
	{
		$this->db->where('id_skpd',$id_skpd);
		$query = $this->db->get('sasaran_kegiatan_renstra');
		return $query->num_rows();
	}

	public function get_total_iku_sk($id_skpd)
	{
		$this->db->where('id_skpd',$id_skpd);
		$query = $this->db->get('iku_sk_renstra');
		return $query->num_rows();
	}

	//!#
	public function get_total_iku($id_skpd)
	{
		$this->db->where('id_skpd',$id_skpd);
		$query = $this->db->get('iku_sasaran_rpjmd');
		return $query->num_rows();
	}

	public function get_casecade_sasaran_by_unit_kerja($jenis,$id_unit_kerja){
		$name = $this->name($jenis);
		$this->db->where('id_unit_kerja',$id_unit_kerja);
		$this->db->join($name['tIku'],$name['tIku'].'.'.$name['cIku'].' = '.$name['cUnitKerja'].'.'.$name['cIku']);
		$this->db->join('ref_satuan','ref_satuan.id_satuan = '.$name['tIku'].'.id_satuan');
		$query = $this->db->get($name['cUnitKerja']);
		return $query->result();
	}

	public function get_casecade_sasaran_by_skpd($jenis,$id_skpd){
		$name = $this->name($jenis);
		$this->db->group_by($name['tIku'].".".$name['cIku']);
		$this->db->where('ref_unit_kerja.id_skpd',$id_skpd);
		$this->db->join($name['tIku'],$name['tIku'].'.'.$name['cIku'].' = '.$name['cUnitKerja'].'.'.$name['cIku']);
		$this->db->join($name['tSasaran'],$name['tSasaran'].'.'.$name['cSasaran'].' = '.$name['tIku'].'.'.$name['cSasaran']);
		$this->db->join('ref_satuan','ref_satuan.id_satuan = '.$name['tIku'].'.id_satuan');
		$this->db->join('ref_unit_kerja','ref_unit_kerja.id_unit_kerja = '.$name['cUnitKerja'].'.id_unit_kerja');
		$query = $this->db->get($name['cUnitKerja']);
		return $query->result();
	}

	public function insert_iku_renja($jenis,$data){
		$name = $this->name($jenis);
		return $this->db->insert($name['tIkuRenja'],$data);
	}

	public function update_iku_renja($jenis,$data,$id_iku_renja){
		$name = $this->name($jenis);
		return $this->db->update($name['tIkuRenja'],$data,array($name['cIkuRenja']=>$id_iku_renja));
	}

	public function hapus_iku_renja($jenis,$id_iku_renja){
		$name = $this->name($jenis);
		return $this->db->delete($name['tIkuRenja'],array($name['cIkuRenja']=>$id_iku_renja));
	}

	public function cek_iku_renja($jenis,$id_iku_renstra,$id_unit_kerja,$tahun){
		$name = $this->name($jenis);
		$this->db->where('tahun_renja',$tahun);
		$this->db->where('id_unit_kerja',$id_unit_kerja);
		$this->db->where('jenis_renja','unit_kerja');
		$this->db->where($name['cIku'],$id_iku_renstra);
		$query = $this->db->get($name['tIkuRenja']);
		$c =  $query->num_rows();
		if($c>0){
			return true;
		}else{
			return false;
		}
	}

	public function cek_iku_renja_skpd($jenis,$id_iku_renstra,$id_skpd,$tahun){
		$name = $this->name($jenis);
		$this->db->where('tahun_renja',$tahun);
		$this->db->where('id_skpd',$id_skpd);
		$this->db->where('jenis_renja','skpd');
		$this->db->where($name['cIku'],$id_iku_renstra);
		$query = $this->db->get($name['tIkuRenja']);
		$c =  $query->num_rows();
		if($c>0){
			return true;
		}else{
			return false;
		}
	}

	public function get_sasaran($jenis,$id_unit_kerja,$tahun){
		$name = $this->name($jenis);
		$this->db->where('tahun_renja',$tahun);
		$this->db->where('jenis_renja','unit_kerja');
		$this->db->where($name['tIkuRenja'].'.id_unit_kerja',$id_unit_kerja);
		$this->db->group_by($name['tIku'].'.'.$name['cSasaran']);
		$this->db->join($name['tIku'],$name['tIku'].'.'.$name['cIku'].' = '.$name['tIkuRenja'].'.'.$name['cIku']);
		$this->db->join($name['tSasaran'],$name['tSasaran'].'.'.$name['cSasaran'].' = '.$name['tIku'].'.'.$name['cSasaran']);
		$q = $this->db->get($name['tIkuRenja'])->result();
		return $q;
	}

	public function get_iku($jenis,$id_sasaran,$tahun,$id_unit_kerja){
		$name = $this->name($jenis);
		$this->db->where('tahun_renja',$tahun);
		$this->db->where('jenis_renja','unit_kerja');
		$this->db->where($name['tSasaran'].'.'.$name['cSasaran'],$id_sasaran);
		$this->db->where($name['tIkuRenja'].'.id_unit_kerja',$id_unit_kerja);
		$this->db->join($name['tIku'],$name['tIku'].'.'.$name['cIku'].' = '.$name['tIkuRenja'].'.'.$name['cIku']);
		$this->db->join($name['tSasaran'],$name['tSasaran'].'.'.$name['cSasaran'].' = '.$name['tIku'].'.'.$name['cSasaran']);
		$this->db->join('ref_satuan','ref_satuan.id_satuan = '.$name['tIku'].'.id_satuan');
		$query = $this->db->get($name['tIkuRenja'])->result();
		if($jenis!=='sk'){
			foreach($query as $k => $q){

				if($jenis=='ss'){
					$this->db->join('iku_sp_renstra','iku_sp_renstra.id_iku_sp_renstra = iku_sp_renja.id_iku_sp_renstra');
					$this->db->join('sasaran_program_renstra','sasaran_program_renstra.id_sasaran_program_renstra = iku_sp_renstra.id_sasaran_program_renstra');
					$iku_sp = $this->db->get_where('iku_sp_renja',array('tahun_renja'=>$tahun,'id_iku_ss_renstra'=>$q->id_iku_ss_renstra))->result();
					$anggaran_kegiatan = 0;
					foreach($iku_sp as $ip){

						$this->db->join('iku_sk_renstra','iku_sk_renstra.id_iku_sk_renstra = iku_sk_renja.id_iku_sk_renstra');
						$this->db->join('sasaran_kegiatan_renstra','sasaran_kegiatan_renstra.id_sasaran_kegiatan_renstra = iku_sk_renstra.id_sasaran_kegiatan_renstra');
						$iku_sk = $this->db->get_where('iku_sk_renja',array('tahun_renja'=>$tahun,'id_iku_sp_renstra'=>$ip->id_iku_sp_renstra))->result();
						foreach($iku_sk as $is){
							$anggaran_kegiatan += $is->anggaran_sk_renja;
						}
					}
					$query[$k]->anggaran_kegiatan = $anggaran_kegiatan;
				}elseif($jenis=='sp'){
					$this->db->join('iku_sk_renstra','iku_sk_renstra.id_iku_sk_renstra = iku_sk_renja.id_iku_sk_renstra');
					$this->db->join('sasaran_kegiatan_renstra','sasaran_kegiatan_renstra.id_sasaran_kegiatan_renstra = iku_sk_renstra.id_sasaran_kegiatan_renstra');
					$iku_sk = $this->db->get_where('iku_sk_renja',array('tahun_renja'=>$tahun,'id_iku_sp_renstra'=>$q->id_iku_sp_renstra))->result();
					$anggaran_kegiatan = 0;
					foreach($iku_sk as $is){
						$anggaran_kegiatan += $is->anggaran_sk_renja;
					}
					$query[$k]->anggaran_kegiatan = $anggaran_kegiatan;
				}
			}
		}
		return $query;
	}

	public function get_sasaran_skpd($jenis,$id_skpd,$tahun){
		$name = $this->name($jenis);
		$this->db->where('tahun_renja',$tahun);
		$this->db->where('jenis_renja','skpd');
		$this->db->where($name['tIkuRenja'].'.id_skpd',$id_skpd);
		$this->db->group_by($name['tIku'].'.'.$name['cSasaran']);
		$this->db->join($name['tIku'],$name['tIku'].'.'.$name['cIku'].' = '.$name['tIkuRenja'].'.'.$name['cIku']);
		$this->db->join($name['tSasaran'],$name['tSasaran'].'.'.$name['cSasaran'].' = '.$name['tIku'].'.'.$name['cSasaran']);
		$this->db->join('ref_unit_kerja','ref_unit_kerja.id_unit_kerja = '.$name['tIkuRenja'].'.id_unit_kerja');
		$q = $this->db->get($name['tIkuRenja'])->result();
		return $q;
	}

	public function get_iku_skpd($jenis,$id_sasaran,$tahun,$id_skpd){
		$name = $this->name($jenis);
		$this->db->where('tahun_renja',$tahun);
		$this->db->where($name['tSasaran'].'.'.$name['cSasaran'],$id_sasaran);
		$this->db->where('jenis_renja','skpd');
		$this->db->where($name['tIkuRenja'].'.id_skpd',$id_skpd);
		$this->db->join($name['tIku'],$name['tIku'].'.'.$name['cIku'].' = '.$name['tIkuRenja'].'.'.$name['cIku']);
		$this->db->join($name['tSasaran'],$name['tSasaran'].'.'.$name['cSasaran'].' = '.$name['tIku'].'.'.$name['cSasaran']);
		$this->db->join('ref_satuan','ref_satuan.id_satuan = '.$name['tIku'].'.id_satuan');
		$this->db->join('ref_unit_kerja','ref_unit_kerja.id_unit_kerja = '.$name['tIkuRenja'].'.id_unit_kerja');
		$query = $this->db->get($name['tIkuRenja'])->result();
		if($jenis!=='sk'){
			foreach($query as $k => $q){
				if($jenis=='ss'){
					$this->db->join('iku_sp_renstra','iku_sp_renstra.id_iku_sp_renstra = iku_sp_renja.id_iku_sp_renstra');
					$this->db->join('sasaran_program_renstra','sasaran_program_renstra.id_sasaran_program_renstra = iku_sp_renstra.id_sasaran_program_renstra');
					$iku_sp = $this->db->get_where('iku_sp_renja',array('tahun_renja'=>$tahun,'id_iku_ss_renstra'=>$q->id_iku_ss_renstra))->result();
					$anggaran_kegiatan = 0;
					foreach($iku_sp as $ip){

						$this->db->join('iku_sk_renstra','iku_sk_renstra.id_iku_sk_renstra = iku_sk_renja.id_iku_sk_renstra');
						$this->db->join('sasaran_kegiatan_renstra','sasaran_kegiatan_renstra.id_sasaran_kegiatan_renstra = iku_sk_renstra.id_sasaran_kegiatan_renstra');
						$iku_sk = $this->db->get_where('iku_sk_renja',array('tahun_renja'=>$tahun,'id_iku_sp_renstra'=>$ip->id_iku_sp_renstra))->result();
						foreach($iku_sk as $is){
							$anggaran_kegiatan += $is->anggaran_sk_renja;
						}
					}
					$query[$k]->anggaran_kegiatan = $anggaran_kegiatan;
				}elseif($jenis=='sp'){
					$this->db->join('iku_sk_renstra','iku_sk_renstra.id_iku_sk_renstra = iku_sk_renja.id_iku_sk_renstra');
					$this->db->join('sasaran_kegiatan_renstra','sasaran_kegiatan_renstra.id_sasaran_kegiatan_renstra = iku_sk_renstra.id_sasaran_kegiatan_renstra');
					$iku_sk = $this->db->get_where('iku_sk_renja',array('tahun_renja'=>$tahun,'id_iku_sp_renstra'=>$q->id_iku_sp_renstra))->result();
					$anggaran_kegiatan = 0;
					foreach($iku_sk as $is){
						$anggaran_kegiatan += $is->anggaran_sk_renja;
					}
					$query[$k]->anggaran_kegiatan = $anggaran_kegiatan;
				}
			}
		}
		return $query;
	}

	public function get_rka($jenis,$id_iku,$tahun,$id_skpd,$id_unit_kerja="0"){
		$this->db->where('tahun',$tahun);
		$this->db->where('id_skpd',$id_skpd);
		$this->db->where('id_unit_kerja',$id_unit_kerja);
		$this->db->where('id_iku',$id_iku);
		$this->db->where('jenis_sasaran',$jenis);
		$query = $this->db->get('rka_renja')->result();
		return $query;
	}


	public function get_iku_renja_by_id($jenis,$id_iku){
		$name = $this->name($jenis);
		$this->db->where($name['cIkuRenja'],$id_iku);
		$this->db->join('ref_unit_kerja','ref_unit_kerja.id_unit_kerja = '.$name['tIkuRenja'].'.id_unit_kerja');
		$this->db->join($name['tIku'],$name['tIku'].'.'.$name['cIku'].' = '.$name['tIkuRenja'].'.'.$name['cIku']);
		$this->db->join($name['tSasaran'],$name['tSasaran'].'.'.$name['cSasaran'].' = '.$name['tIku'].'.'.$name['cSasaran']);
		$this->db->join('ref_satuan','ref_satuan.id_satuan = '.$name['tIku'].'.id_satuan');
		$q = $this->db->get($name['tIkuRenja'])->row();
		return $q;
	}

	public function get_renja_unit_kerja($jenis,$id_unit_kerja,$tahun){
		$name = $this->name($jenis);
		$this->db->where('tahun_renja',$tahun);
		$this->db->where('jenis_renja','unit_kerja');
		$this->db->where('id_unit_kerja',$id_unit_kerja);
		$this->db->join($name['tIku'],$name['tIku'].'.'.$name['cIku'].' = '.$name['tIkuRenja'].'.'.$name['cIku']);
		$this->db->join('ref_satuan','ref_satuan.id_satuan = '.$name['tIku'].'.id_satuan');
		$q = $this->db->get($name['tIkuRenja']);
		return $q->result();
	}

	public function get_renja_skpd($jenis,$id_skpd,$tahun){
		$name = $this->name($jenis);
		$this->db->where('tahun_renja',$tahun);
		$this->db->where('jenis_renja','skpd');
		$this->db->where($name['tIkuRenja'].'.id_skpd',$id_skpd);
		$this->db->join($name['tIku'],$name['tIku'].'.'.$name['cIku'].' = '.$name['tIkuRenja'].'.'.$name['cIku']);
		$this->db->join($name['tSasaran'],$name['tSasaran'].'.'.$name['cSasaran'].' = '.$name['tIku'].'.'.$name['cSasaran']);
		$this->db->join('ref_satuan','ref_satuan.id_satuan = '.$name['tIku'].'.id_satuan');
		$q = $this->db->get($name['tIkuRenja']);
		return $q->result();
	}

	public function insert_renaksi($jenis,$data){
		$name = $this->name($jenis);
		$in = $this->db->insert($name['tRenaksi'],$data);
		return $this->db->insert_id();
	}

	public function insert_target_renaksi($jenis,$data){
		$name = $this->name($jenis);
		$in = $this->db->insert($name['tTaRenaksi'],$data);
		return $this->db->insert_id();
	}

	public function update_renaksi($jenis,$data,$id_renaksi){
		$name = $this->name($jenis);
		$up = $this->db->update($name['tRenaksi'],$data,array($name['cRenaksi']=>$id_renaksi));
	}

	public function hapus_renaksi($jenis,$id_renaksi){
		$name = $this->name($jenis);
		$this->db->delete($name['tRenaksi'],array($name['cRenaksi']=>$id_renaksi));
		$this->db->delete($name['tTaRenaksi'],array($name['cRenaksi']=>$id_renaksi));
	}

	public function update_target_renaksi($jenis,$data,$id_renaksi,$bulan){
		$name = $this->name($jenis);
		$up = $this->db->update($name['tTaRenaksi'],$data,array($name['cRenaksi']=>$id_renaksi,'bulan'=>$bulan));
	}

	public function update_target_renaksi_by_id($jenis,$data,$id_target_renaksi){
		$name = $this->name($jenis);
		$up = $this->db->update($name['tTaRenaksi'],$data,array($name['cTaRenaksi']=>$id_target_renaksi));
	}

	public function get_renaksi($jenis,$id_iku){
		$name = $this->name($jenis);
		$this->db->where($name['cIkuRenja'],$id_iku);
		$q = $this->db->get($name['tRenaksi']);
		return $q->result();
	}

	public function get_renaksi_by_iku($jenis,$id_iku){
		$name = $this->name($jenis);
		$this->db->where($name['tIku'].".".$name['cIku'],$id_iku);
		$this->db->join($name['tIkuRenja'],$name['tIkuRenja'].".".$name['cIkuRenja']." = ".$name['tRenaksi'].".".$name['cIkuRenja']);
		$this->db->join($name['tIku'],$name['tIku'].'.'.$name['cIku'].' = '.$name['tIkuRenja'].'.'.$name['cIku']);
		$q = $this->db->get($name['tRenaksi'].'');
		return $q->result();
	}

	public function get_renaksi_by_id($jenis,$id_renaksi){
		$name = $this->name($jenis);
		$this->db->where($name['cRenaksi'],$id_renaksi);
		$q = $this->db->get($name['tRenaksi']);
		return $q->row();
	}


	public function get_target_renaksi_by_renaksi($jenis,$id_renaksi){
		$name = $this->name($jenis);
		$this->db->where($name['cRenaksi'],$id_renaksi);
		$q = $this->db->get($name['tTaRenaksi']);
		return $q->result();
	}


	public function get_target_renaksi_by_id($jenis,$id_target_renaksi){
		$name = $this->name($jenis);
		$this->db->select('*, '.$name['tTaRenaksi'].'.capaian as capaian_renaksi');
		$this->db->where($name['cTaRenaksi'],$id_target_renaksi);
		$this->db->join($name['tRenaksi'],$name['tRenaksi'].".".$name['cRenaksi']."=".$name['tTaRenaksi'].".".$name['cRenaksi']);
		$this->db->join($name['tIkuRenja'],$name['tIkuRenja'].".".$name['cIkuRenja']."=".$name['tRenaksi'].".".$name['cIkuRenja']);
		$this->db->join($name['tIku'],$name['tIku'].".".$name['cIku']."=".$name['tIkuRenja'].".".$name['cIku']);
		$q = $this->db->get($name['tTaRenaksi']);
		return $q->row();
	}

	public function get_target_renaksi($jenis,$id_renaksi){
		$name = $this->name($jenis);
		$this->db->where($name['cRenaksi'],$id_renaksi);
		$q = $this->db->get($name['tTaRenaksi']);
		return $q->result();
	}

	public function get_program_by_iku_ss($id_iku_ss_renstra){
		$this->db->where('id_iku_ss_renstra',$id_iku_ss_renstra);
		$q = $this->db->get('sasaran_program_renstra')->result();
		return $q;
	}

	public function get_kegiatan_by_iku_sp($id_iku_sp_renstra){
		$this->db->where('id_iku_sp_renstra',$id_iku_sp_renstra);
		$q = $this->db->get('sasaran_kegiatan_renstra')->result();
		return $q;
	}

	public function get_total_renja($id_skpd,$tahun){
		$jenis = array('ss','sp','sk');
	}

	public function get_rka_by_id($id_rka)
	{
		$this->db->where('id_rka',$id_rka);
		return $this->db->get('rka_renja')->row();
	}

	public function insert_rka($data)
	{
		return $this->db->insert('rka_renja',$data);
	}

	public function update_rka($data,$id_rka)
	{
		return $this->db->update('rka_renja',$data, array('id_rka' => $id_rka));
	}

	public function delete_rka($id_rka)
	{
		return $this->db->delete('rka_renja', array('id_rka' => $id_rka));
	}



}
