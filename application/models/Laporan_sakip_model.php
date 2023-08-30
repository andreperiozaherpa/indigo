<?php
class Laporan_sakip_model extends CI_Model{

	//RPJMD

	public function get_visi(){
		return $this->db->get('visi')->row();
	}
	public function get_misi_by_visi($id_visi){
		return $this->db->get_where('misi',array('id_visi'=>$id_visi))->result();
	}
	public function get_tujuan_by_misi($id_misi){

		return $this->db->get_where('tujuan',array('id_misi'=>$id_misi))->result();	
	}
	public function get_misi(){
		return $this->db->get('misi')->result();
	}
	public function get_sasaran_rpjmd_by_tujuan($id_tujuan){
		return $this->db->get_where('sasaran_rpjmd',array('id_tujuan'=>$id_tujuan))->result();
	}
	public function get_sasaran_strategis_renstra_by_tujuan($id_tujuan,$id_skpd=0){
		$this->db->join('iku_sasaran_rpjmd', 'sasaran_strategis_renstra.id_iku_sasaran_rpjmd = iku_sasaran_rpjmd.id_iku_sasaran_rpjmd', 'LEFT');
		$this->db->join('sasaran_rpjmd', 'iku_sasaran_rpjmd.id_sasaran_rpjmd = sasaran_rpjmd.id_sasaran_rpjmd', 'LEFT');
		$this->db->join('ref_skpd','ref_skpd.id_skpd = sasaran_strategis_renstra.id_skpd', 'LEFT');
		if (@$_GET['id_skpd'] || $id_skpd!==0) {
			if($id_skpd==0){
				$id_skpd = @$_GET['id_skpd'];
			}
			$this->db->where('ref_skpd.id_skpd', $id_skpd);
		}
		return $this->db->get_where('sasaran_strategis_renstra',array('sasaran_rpjmd.id_tujuan'=>$id_tujuan))->result();
	}
	public function get_sasaran_program_renstra_by_strategis($list_iku){
		$this->db->join('ref_unit_kerja','ref_unit_kerja.id_unit_kerja = sasaran_program_renstra.id_unit_kerja', 'LEFT');
		if ($list_iku) {
			$this->db->where_in('id_iku_ss_renstra',$list_iku);
			return $this->db->get('sasaran_program_renstra')->result();
		} else {
			return $this->db->get_where('sasaran_program_renstra',array('sasaran_program_renstra.id_sasaran_program_renstra'=>0))->result();
		}
	}
	public function get_sasaran_kegiatan_renstra_by_program($list_iku){
		$this->db->join('ref_unit_kerja','ref_unit_kerja.id_unit_kerja = sasaran_kegiatan_renstra.id_unit_kerja', 'LEFT');
		if ($list_iku) {
			$this->db->where_in('id_iku_sp_renstra',$list_iku);
			return $this->db->get('sasaran_kegiatan_renstra')->result();
		} else {
			return $this->db->get_where('sasaran_kegiatan_renstra',array('sasaran_kegiatan_renstra.id_sasaran_kegiatan_renstra'=>0))->result();
		}
	}
	public function get_sasaran_strategis_by_tujuan($id_tujuan,$id_skpd=''){
		$this->db->join('iku_sasaran_rpjmd','iku_sasaran_rpjmd.id_iku_sasaran_rpjmd = sasaran_strategis_renstra.id_iku_sasaran_rpjmd');
		$this->db->join('sasaran_rpjmd','sasaran_rpjmd.id_sasaran_rpjmd = iku_sasaran_rpjmd.id_sasaran_rpjmd');
		$this->db->select('sasaran_strategis_renstra.*,sasaran_rpjmd.id_tujuan as id_tujuan_rpjmd');
		$this->db->where('sasaran_rpjmd.id_tujuan',$id_tujuan);
		if($id_skpd!='') $this->db->where('sasaran_strategis_renstra.id_skpd',$id_skpd);
		return $this->db->get('sasaran_strategis_renstra')->result();
	}
	public function get_sasaran_strategis_by_tujuan_skpd($id_tujuan,$id_skpd){
		$this->db->join('iku_sasaran_rpjmd','iku_sasaran_rpjmd.id_iku_sasaran_rpjmd = sasaran_strategis_renstra.id_iku_sasaran_rpjmd');
		$this->db->join('sasaran_rpjmd','sasaran_rpjmd.id_sasaran_rpjmd = iku_sasaran_rpjmd.id_sasaran_rpjmd');
		$this->db->select('sasaran_strategis_renstra.*,sasaran_rpjmd.id_tujuan as id_tujuan_rpjmd');
		return $this->db->get_where('sasaran_strategis_renstra',array('sasaran_rpjmd.id_tujuan'=>$id_tujuan,'sasaran_strategis_renstra.id_skpd'=>$id_skpd))->result();
		// return $this->db->get('sasaran_strategis_renstra')->result();
	}
	public function get_iku_sasaran_rpjmd($id_sasaran_rpjmd,$where_skpd=NULL){
		$this->db->join('ref_satuan','ref_satuan.id_satuan = iku_sasaran_rpjmd.id_satuan');
		// $this->db->join('ref_skpd','ref_skpd.id_skpd = iku_sasaran_rpjmd.id_skpd');
		if ($where_skpd) {
			$this->db->where_in('id_skpd', $where_skpd);
		}
		$query =  $this->db->get_where('iku_sasaran_rpjmd',array('id_sasaran_rpjmd'=>$id_sasaran_rpjmd))->result();
		foreach($query as $k => $q){
			$skpd = explode(',', $q->id_skpd);
			foreach($skpd as $s){
				$detail_skpd = $this->db->get_where('ref_skpd',array('id_skpd'=>$s))->row();
				$query[$k]->skpd[] = $detail_skpd;
			}
		}
		return $query;
	}
	public function get_iku_sasaran_strategis_renstra($id_sasaran_renstra){
		$this->db->join('ref_satuan','ref_satuan.id_satuan = iku_ss_renstra.id_satuan');
		// $this->db->join('ref_skpd','ref_skpd.id_skpd = iku_sasaran_rpjmd.id_skpd');
		$query =  $this->db->get_where('iku_ss_renstra',array('iku_ss_renstra.id_sasaran_strategis_renstra'=>$id_sasaran_renstra))->result();
		foreach($query as $k => $q){
			$this->db->join('ref_unit_kerja', 'ref_unit_kerja.id_unit_kerja = casecade_unit_kerja_iku_ss_renstra.id_unit_kerja', 'LEFT');
			$detail_unit_kerja = $this->db->get_where('casecade_unit_kerja_iku_ss_renstra',array('id_iku_ss_renstra'=>$q->id_iku_ss_renstra))->result();
			$query[$k]->unit_kerja = $detail_unit_kerja;
		}
		return $query;
	}
	public function get_iku_sasaran_program_renstra($id_program_renstra){
		$this->db->join('ref_satuan','ref_satuan.id_satuan = iku_sp_renstra.id_satuan');
		// $this->db->join('ref_skpd','ref_skpd.id_skpd = iku_sasaran_rpjmd.id_skpd');
		$query =  $this->db->get_where('iku_sp_renstra',array('iku_sp_renstra.id_sasaran_program_renstra'=>$id_program_renstra))->result();
		foreach($query as $k => $q){
			$this->db->join('ref_unit_kerja', 'ref_unit_kerja.id_unit_kerja = casecade_unit_kerja_iku_sp_renstra.id_unit_kerja', 'LEFT');
			$detail_unit_kerja = $this->db->get_where('casecade_unit_kerja_iku_sp_renstra',array('id_iku_sp_renstra'=>$q->id_iku_sp_renstra))->result();
			$query[$k]->unit_kerja = $detail_unit_kerja;
		}
		return $query;
	}
	public function get_iku_sasaran_kegiatan_renstra($id_kegiatan_renstra){
		$this->db->join('ref_satuan','ref_satuan.id_satuan = iku_sk_renstra.id_satuan');
		// $this->db->join('ref_skpd','ref_skpd.id_skpd = iku_sasaran_rpjmd.id_skpd');
		$query =  $this->db->get_where('iku_sk_renstra',array('iku_sk_renstra.id_sasaran_kegiatan_renstra'=>$id_kegiatan_renstra))->result();
		foreach($query as $k => $q){
			$this->db->join('ref_unit_kerja', 'ref_unit_kerja.id_unit_kerja = casecade_unit_kerja_iku_sk_renstra.id_unit_kerja', 'LEFT');
			$detail_unit_kerja = $this->db->get_where('casecade_unit_kerja_iku_sk_renstra',array('id_iku_sk_renstra'=>$q->id_iku_sk_renstra))->result();
			$query[$k]->unit_kerja = $detail_unit_kerja;
		}
		return $query;
	}
	public function get_iku_sasaran_strategis($id_sasaran_strategis_renstra){
		$this->db->join('ref_satuan','ref_satuan.id_satuan = iku_ss_renstra.id_satuan');
		$this->db->join('ref_skpd','ref_skpd.id_skpd = iku_ss_renstra.id_skpd');
		$this->db->join('sasaran_strategis_renstra','sasaran_strategis_renstra.id_sasaran_strategis_renstra = iku_ss_renstra.id_sasaran_strategis_renstra');
		return $this->db->get_where('iku_ss_renstra',array('iku_ss_renstra.id_sasaran_strategis_renstra'=>$id_sasaran_strategis_renstra))->result();
	}
	public function get_iku_sasaran_program($id_sasaran_program_renstra){
		$this->db->join('ref_satuan','ref_satuan.id_satuan = iku_sp_renstra.id_satuan');
		$this->db->join('ref_skpd','ref_skpd.id_skpd = iku_sp_renstra.id_skpd');
		$this->db->join('sasaran_program_renstra','sasaran_program_renstra.id_sasaran_program_renstra = iku_sp_renstra.id_sasaran_program_renstra');
		return $this->db->get_where('iku_sp_renstra',array('iku_sp_renstra.id_sasaran_program_renstra'=>$id_sasaran_program_renstra))->result();
	}
	public function get_iku_sasaran_kegiatan($id_sasaran_kegiatan_renstra){
		$this->db->join('ref_satuan','ref_satuan.id_satuan = iku_sk_renstra.id_satuan');
		$this->db->join('ref_skpd','ref_skpd.id_skpd = iku_sk_renstra.id_skpd');
		$this->db->join('sasaran_kegiatan_renstra','sasaran_kegiatan_renstra.id_sasaran_kegiatan_renstra = iku_sk_renstra.id_sasaran_kegiatan_renstra');
		return $this->db->get_where('iku_sk_renstra',array('iku_sk_renstra.id_sasaran_kegiatan_renstra'=>$id_sasaran_kegiatan_renstra))->result();
	}
	public function get_sasaran_program_by_sasaran_strategis($id_sasaran_strategis_renstra){
		$this->db->join('iku_ss_renstra','iku_ss_renstra.id_iku_ss_renstra = sasaran_program_renstra.id_iku_ss_renstra');
		return $this->db->get_where('sasaran_program_renstra',array('id_sasaran_strategis_renstra'=>$id_sasaran_strategis_renstra))->result();
	}	
	public function get_sasaran_kegiatan_by_sasaran_program($id_sasaran_program_renstra){
		$this->db->join('iku_sp_renstra','iku_sp_renstra.id_iku_sp_renstra = sasaran_kegiatan_renstra.id_iku_sp_renstra');
		return $this->db->get_where('sasaran_kegiatan_renstra',array('id_sasaran_program_renstra'=>$id_sasaran_program_renstra,'id_skpd'=>$id_skpd))->result();
	}
	public function get_sasaran_program_by_sasaran_strategis_skpd($id_sasaran_strategis_renstra,$id_skpd){
		$this->db->join('iku_ss_renstra','iku_ss_renstra.id_iku_ss_renstra = sasaran_program_renstra.id_iku_ss_renstra');
		return $this->db->get_where('sasaran_program_renstra',array('id_sasaran_strategis_renstra'=>$id_sasaran_strategis_renstra,'sasaran_program_renstra.id_skpd'=>$id_skpd))->result();
	}	
	public function get_sasaran_kegiatan_by_sasaran_program_skpd($id_sasaran_program_renstra,$id_skpd){
		$this->db->join('iku_sp_renstra','iku_sp_renstra.id_iku_sp_renstra = sasaran_kegiatan_renstra.id_iku_sp_renstra');
		return $this->db->get_where('sasaran_kegiatan_renstra',array('id_sasaran_program_renstra'=>$id_sasaran_program_renstra,'sasaran_kegiatan_renstra.id_skpd'=>$id_skpd))->result();
	}
	public function get_program_by_sasaran($id_sasaran_rpjmd){
		return $this->db->get_where('program_rpjmd',array('id_sasaran_rpjmd'=>$id_sasaran_rpjmd))->result();
	}
	public function get_iku_program($id_program_rpjmd,$where_skpd=NULL){
		$this->db->join('ref_satuan','ref_satuan.id_satuan = iku_program_rpjmd.id_satuan');
		if ($where_skpd) {
			$this->db->where_in('id_skpd', $where_skpd);
		}
		$query =  $this->db->get_where('iku_program_rpjmd',array('id_program_rpjmd'=>$id_program_rpjmd))->result();
		foreach($query as $k => $q){
			$skpd = explode(',', $q->id_skpd);
			foreach($skpd as $s){
				$detail_skpd = $this->db->get_where('ref_skpd',array('id_skpd'=>$s))->row();
				$query[$k]->skpd[] = $detail_skpd;
			}
		}
		return $query;
	}
	public function get_sasaran_strategis_by_iku_sasaran_rpjmd($id_iku_sasaran_rpjmd){
		return $this->db->get_where('sasaran_strategis_renstra',array('id_iku_sasaran_rpjmd'=>$id_iku_sasaran_rpjmd))->result();
	}
	public function get_sasaran_program_by_ss_renstra($id_sasaran_strategis_renstra){
		$this->db->where('iku_ss_renstra.id_sasaran_strategis_renstra',$id_sasaran_strategis_renstra);
		$this->db->join('sasaran_strategis_renstra','iku_ss_renstra.id_iku_ss_renstra = sasaran_program_renstra.id_iku_ss_renstra');
		$q = $this->db->get('sasaran_program_renstra')->result();
		return $q;
	}
	public function get_sasaran_strategis_by_id($id_sasaran_strategis_renstra){
		$this->db->where('id_sasaran_strategis_renstra',$id_sasaran_strategis_renstra);
		$q = $this->db->get('sasaran_strategis_renstra')->row();
		return $q;
	}
	public function get_sasaran_program_by_id($id_sasaran_program_renstra){
		$this->db->where('id_sasaran_program_renstra',$id_sasaran_program_renstra);
		$q = $this->db->get('sasaran_program_renstra')->row();
		return $q;
	}

	public function get_sasaran_kegiatan_by_id($id_sasaran_kegiatan_renstra){
		$this->db->where('id_sasaran_kegiatan_renstra',$id_sasaran_kegiatan_renstra);
		$q = $this->db->get('sasaran_kegiatan_renstra')->row();
		return $q;
	}


	//RENSTRA

	public function name($jenis){
		if($jenis=='ss'){
			$name = 'sasaran_strategis';
			$nSasaran = 'Sasaran Strategis';
		}elseif($jenis=='sp'){
			$name = 'sasaran_program';
			$nSasaran = 'Program';
		}elseif($jenis=='sk'){
			$name = 'sasaran_kegiatan';
			$nSasaran = 'Kegiatan';
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

		return array('cSasaran'=>$cSasaran,'tSasaran'=>$tSasaran,'tIku'=>$tIku,'cIku'=>$cIku,'cUnitKerja'=>$cUnitKerja,'name'=>$name,'nSasaran'=>$nSasaran,'tIkuRenja'=>$tIkuRenja,'cIkuRenja'=>$cIkuRenja,'taIkuRenja'=>$taIkuRenja,'aIkuRenja'=>$aIkuRenja,'rIkuRenja'=>$rIkuRenja,'tRenaksi'=>$tRenaksi,'cRenaksi'=>$cRenaksi,'tTaRenaksi'=>$tTaRenaksi,'cTaRenaksi'=>$cTaRenaksi);

	}


	public function get_iku_sasaran($jenis,$id_sasaran,$tahun){
		$name = $this->name($jenis);
		$this->db->where('tahun_renja',$tahun);
		$this->db->where($name['tSasaran'].'.'.$name['cSasaran'],$id_sasaran); 
		// $this->db->where('jenis_renja','skpd');
		$this->db->join($name['tIku'],$name['tIku'].'.'.$name['cIku'].' = '.$name['tIkuRenja'].'.'.$name['cIku']);
		$this->db->join($name['tSasaran'],$name['tSasaran'].'.'.$name['cSasaran'].' = '.$name['tIku'].'.'.$name['cSasaran']);
		$this->db->join('ref_satuan','ref_satuan.id_satuan = '.$name['tIku'].'.id_satuan');
		$this->db->join('ref_unit_kerja','ref_unit_kerja.id_unit_kerja = '.$name['tIkuRenja'].'.id_unit_kerja');
		$q = $this->db->get($name['tIkuRenja'])->result();
		return $q;
	}
	public function get_sasaran_renstra($jenis,$id_skpd=0){
		$name = $this->name($jenis);
		if($id_skpd!==0){
			$this->db->where('id_skpd',$id_skpd);
		}
		$this->db->order_by('id_skpd');
		$query = $this->db->get($name['tSasaran']);
		return $query->result();
	}


	public function get_iku_sasaran_renstra($jenis,$id_sasaran,$id_skpd=null){
		$name = $this->name($jenis);
		$this->db->where($name['cSasaran'],$id_sasaran);
		if($id_skpd) $this->db->where($name['tIku'].'.id_skpd',$id_skpd);
		$this->db->join('ref_satuan','ref_satuan.id_satuan = '.$name['tIku'].'.id_satuan');
		$this->db->join('ref_skpd','ref_skpd.id_skpd = '.$name['tIku'].'.id_skpd');
		$query = $this->db->get($name['tIku']);
		return $query->result();
	}

	//RENJA

	public function get_iku_renja($jenis,$id_iku,$id_skpd=null,$tahun=''){
		$name = $this->name($jenis);
		$this->db->where($name['tIkuRenja'].'.'.$name['cIku'],$id_iku);
		$this->db->where('tahun_renja',$tahun);
		if($id_skpd) $this->db->where($name['tIkuRenja'].'.id_skpd',$id_skpd);
		$this->db->join($name['tIku'],$name['tIku'].'.'.$name['cIku'].'='.$name['tIkuRenja'].'.'.$name['cIku']);
		$this->db->join('ref_satuan','ref_satuan.id_satuan = '.$name['tIku'].'.id_satuan');
		$this->db->join('ref_skpd','ref_skpd.id_skpd = '.$name['tIku'].'.id_skpd');
		$this->db->join('ref_unit_kerja','ref_unit_kerja.id_unit_kerja = '.$name['tIkuRenja'].'.id_unit_kerja');
		$query = $this->db->get($name['tIkuRenja']);
		return $query->result();
	}

	public function get_sasaran_renaksi($j,$id_skpd=null,$tahun){
            $renstra = $this->get_sasaran_renstra($j);
            $name = $this->name($j);
            foreach($name as $v => $n){
              $$v = $n;
            }
            $renstra_beriku  = array();
            foreach($renstra as $r){
              $jml_renja = 0;
              $iku = $this->get_iku_sasaran_renstra($j,$r->$cSasaran,$id_skpd);
              foreach($iku as $i){
                $iku_renja = $this->get_iku_renja($j,$i->$cIku,$id_skpd,$tahun);
                $jml_renja += count($iku_renja);
              }
              if($jml_renja!==0){
                $jml_capaian = 0;
                foreach($iku_renja as $ir){
                  $capaian = get_capaian($ir->$taIkuRenja,$ir->$rIkuRenja,$ir->polorarisasi);
                  $jml_capaian += $capaian;
                }
                $r->jumlah_capaian = $jml_capaian;
                $renstra_beriku[] = $r;
              } 
            }
            return $renstra_beriku;
	}

	public function get_renaksi($jenis,$id_iku_renja){
		$name = $this->name($jenis);
		$this->db->where($name['tRenaksi'].'.'.$name['cIkuRenja'],$id_iku_renja);
		$this->db->join($name['tIkuRenja'],$name['tIkuRenja'].'.'.$name['cIkuRenja'].'='.$name['tRenaksi'].'.'.$name['cIkuRenja']);
		$this->db->join($name['tIku'],$name['tIku'].'.'.$name['cIku'].'='.$name['tIkuRenja'].'.'.$name['cIku']);
		$this->db->join('ref_satuan','ref_satuan.id_satuan = '.$name['tIku'].'.id_satuan');
		$this->db->join('ref_skpd','ref_skpd.id_skpd = '.$name['tIku'].'.id_skpd');
		$this->db->join('ref_unit_kerja','ref_unit_kerja.id_unit_kerja = '.$name['tIkuRenja'].'.id_unit_kerja');
		$query = $this->db->get($name['tRenaksi']);
		return $query->result();
	}

	public function get_target_renaksi($jenis,$id_renaksi){
		$name = $this->name($jenis);
		$this->db->where($name['cRenaksi'],$id_renaksi);
		$query = $this->db->get($name['tTaRenaksi']);
		return $query->result();
	}

}