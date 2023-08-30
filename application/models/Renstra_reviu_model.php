<?php
class Renstra_reviu_model extends CI_Model{
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
		return array('cSasaran'=>$cSasaran,'tSasaran'=>$tSasaran,'tIku'=>$tIku,'cIku'=>$cIku,'cUnitKerja'=>$cUnitKerja,'name'=>$name,'nSasaran'=>$nSasaran);

	}

	public function update_reviu_iku($jenis,$id_iku,$data){
		$name = $this->name($jenis);
		return $this->db->update($name['tIku'],$data,array($name['cIku']=>$id_iku));
	}

	public function get_status_reviu($jenis,$id_iku){
		$name = $this->name($jenis);
		$this->db->where($name['cIku'],$id_iku);
		$this->db->select('status_s,status_m,status_a,status_r,status_t,status_c');
		$q = (array) $this->db->get($name['tIku'])->row();
		if(!array_filter($q)){
			$hasil_reviu = 'kosong_semua';
		}else{
			if(count(array_unique($q)) <= 1){
				$hasil_reviu = 'diterima_semua';
			}else{
				$hasil_reviu = 'campuran';
			}
		}
		return $hasil_reviu;
	}

	public function get_jumlah_reviu($id_skpd){
		$this->load->model('renstra_realisasi_model');

		$belum_diriviu = 0;
		$disetujui = 0;
		$ditolak = 0;
		$j = array('ss','sk','sp');
		foreach($j as $jenis){
			$name = $this->name($jenis);
			$data = $this->renstra_realisasi_model->get_sasaran_by_id_skpd($jenis,$id_skpd);
			foreach($data as $d){
				$id_sasaran = $name['cSasaran'];
				$iku = $this->renstra_realisasi_model->get_iku($jenis,$d->$id_sasaran);
				foreach($iku as $i){
					$id_iku = $name['cIku'];
					$status_reviu = $this->renstra_reviu_model->get_status_reviu($jenis,$i->$id_iku);
					if($status_reviu=='diterima_semua') $disetujui+= 1;
					if($status_reviu=='kosong_semua') $belum_diriviu+= 1;
					if($status_reviu=='campuran') $ditolak+= 1;
				}
			}
		}
		return array('belum_diriviu'=>$belum_diriviu,'disetujui'=>$disetujui,'ditolak'=>$ditolak);
	}

	public function get_jumlah_semua_iku_sasaran_skpd($id_skpd){

		$this->load->model('renstra_realisasi_model');

		$jumlah = 0;
		$j = array('ss','sk','sp');
		foreach($j as $jenis){
			$name = $this->name($jenis);
			$data = $this->renstra_realisasi_model->get_sasaran_by_id_skpd($jenis,$id_skpd);
			foreach($data as $d){
				$id_sasaran = $name['cSasaran'];
				$iku = $this->renstra_realisasi_model->get_iku($jenis,$d->$id_sasaran);
				foreach($iku as $i){
					$jumlah +=1;
				}
			}
		}
		return $jumlah;
	}

	public function get_status_reviu_skpd($id_skpd){
		$status_reviu = $this->get_jumlah_reviu($id_skpd);
		$jumlah = $this->get_jumlah_semua_iku_sasaran_skpd($id_skpd);
		if($status_reviu['belum_diriviu']==$jumlah){
			$status = 'belum_direviu';
		}elseif($status_reviu['disetujui']==$jumlah){
			$status = 'sudah_direviu';
		}else{
			if($jumlah==0){
				$status = 'belum_ada_indikator';
			}else{
				$status = 'masih_perlu_tanggapan';
			}
		}
		return $status;
	}
}