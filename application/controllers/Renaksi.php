<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Renaksi extends CI_Controller{

	public $user_id;

	public function __construct(){
		parent ::__construct();
		$this->user_id = $this->session->userdata('user_id');
		$this->load->model('user_model');
		$this->user_model->user_id = $this->user_id;
		$this->user_model->set_user_by_user_id();
		$this->user_picture = $this->user_model->user_picture;
		$this->full_name	= $this->user_model->full_name;
		$this->user_level	= $this->user_model->level;
		$this->load->model('ref_skpd_model');
		$this->load->model('master_pegawai_model');

		$this->load->model('renja_perencanaan_model');
		$this->load->model('renstra_realisasi_model');
		$this->load->model('ref_visi_misi_model');
		
		$this->load->model('renja_rka_model');


		$this->level_id	= $this->user_model->level_id;
		if ($this->level_id >2 ) redirect("admin");
	}

	public function detail($jenis,$id_iku,$id_skpd,$tahun)
	{
		if ($this->user_id)
		{
			$data['title']		= "Detail Renaksi - Admin ";
			$data['content']	= "renaksi/detail" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "ref_skpd";
			$name = $this->renja_perencanaan_model->name($jenis);

			$data['name'] = $name;

			foreach($data['name'] as $k => $v){
				$data[$k] = $v;
				$$k = $v;
			}

			$data['detail'] = $this->renja_perencanaan_model->get_iku_renja_by_id($jenis,$id_iku);
			if($data['detail']->jenis_renja=='skpd'){
				$data['skpd'] = $this->ref_skpd_model->get_by_id($id_skpd);
				$data['kepala'] = $this->ref_skpd_model->get_kepala_skpd($id_skpd);
				$data['staff'] = $this->master_pegawai_model->get_jml_by_id_skpd($id_skpd);
				$data['detail']->nama_unit_kerja = $data['skpd']->nama_skpd;
			}else{
				$data['kepala'] = $this->ref_skpd_model->get_kepala_unit_kerja($data['detail']->id_unit_kerja);
				$data['staff'] = count($this->ref_skpd_model->get_staff_unit_kerja($data['detail']->id_unit_kerja));
			}
			$data['renaksi'] = $this->renja_perencanaan_model->get_renaksi($jenis,$id_iku);
			$jj = array('ss'=>'Sasaran Strategis','sp'=>'Sasaran Program','sk'=>'Sasaran Kegiatan');
			foreach($jj as $n => $j){
				if($n==$jenis){
					$data['nama_jenis'] = $j;
					$data['jenis'] = $n;
				}
			}


            $data['rka'] = $this->renja_rka_model->get_rka($jenis,$id_iku,$tahun,$id_skpd);
            $data['total_rka'] = 0;
            foreach ($data['rka'] as $r) {
              $data['total_rka'] += $r->anggaran;
            }


			$this->load->view('admin/index',$data);


		}
		else
		{
			redirect('admin');
		}
	}
}