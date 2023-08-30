<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Rkpd extends CI_Controller
{
	public $user_id;

	public function __construct()
	{
		parent::__construct();
		$this->user_id = $this->session->userdata('user_id');


		$this->user_model->user_id = $this->user_id;
		$this->user_model->set_user_by_user_id();
		

		$this->user_picture = $this->user_model->user_picture;
		$this->full_name	= $this->user_model->full_name;
		$this->user_level	= $this->user_model->level;
		$this->user_privileges	= $this->user_model->user_privileges;
		$this->array_privileges = explode(';', $this->user_privileges);
    
    	if ($this->user_level == "Administrator" OR in_array('sicerdas_rpjmd', $this->array_privileges)) {	}
		else{show_404();}

		$this->load->model("kinerja/Skpd");
    	$this->load->model("sievka/Predikat");
		$this->load->model("sicerdas/Globalvar");
	}


	public function index()
	{
		if ($this->user_id) {

			$data['title']		= "sievka - " . app_name;
			$data['content']	= "sievka/evaluasi/rkpd";
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;

			$data['active_menu'] = "sievka";
      		$param = array();
			$data['dt_skpd']        = $this->Skpd->get($param);

			$this->load->view('admin/index', $data);
		} else {
			redirect('admin');
		}
	}

	public function get_data()
    {
        if($this->input->is_ajax_request())
        {
         $param = array();
            
			$data = array();

            $id_skpd = $this->input->post("id_skpd");
			$tahun = $this->input->post("tahun");

			$content = $this->getContent($id_skpd,$tahun);
			
			$data['content'] 	= $content;
            echo json_encode($data);


        }
    }

    public function download()
    {
        $id_skpd = $this->input->get("id_skpd");
		$tahun = $this->input->get("tahun");
        if($id_skpd && $tahun)
        {
          
          $skpd = $this->db->where("id_skpd",$id_skpd)->get("ref_skpd")->row();
          if($skpd)
          {
            header("Content-type: application/vnd-ms-excel");
			header("Content-Disposition: attachment; filename=Evaluasi_terhadap_Hasil_RKPD.xls");
            $content = $this->getContent($id_skpd,$tahun,true);
            echo '<h2>Evaluasi terhadap Hasil RKPD</h2>
            <h3>'.$skpd->nama_skpd.'</h3>'.$content;
            
          }
        }


    }


    private function getContent($id_skpd,$tahun,$download=false)
    {
		$this->load->model("sicerdas/renstra/Program_indikator_model");
		$this->load->model("kinerja/Realisasi_program_model");

		$dt_tahun = $this->Globalvar->get_tahun();

		$akhir_tahun = $dt_tahun[4];
		$tahun_ini = $dt_tahun[($tahun-1)];

		$tahun_kemarin = $tahun - 1;
  
		$list = '';

		$param['where']['sasaran.id_skpd'] = $id_skpd;
      	$result = $this->Program_indikator_model->get($param);

		$total_row = $result->num_rows();
		$total_realisasi = 0;
		$total_realisasi_rp = 0;
		$total_realisasi_kinerja = 0;
		$total_realisasi_kinerja_rp = 0;
		$total_tingkat_capaian = 0;
		$total_tingkat_capaian_rp = 0;


		$dt_realisasi = $this->Realisasi_program_model->get($param)->result();
      	$realisasi = array();
      	foreach($dt_realisasi as $row)
      	{
        	$realisasi[$row->id_indikator_program_renstra][$row->tahun] = $row;
      	}

		//echo "<pre>";print_r($realisasi);

		$target_tahun = "target_tahun_".$tahun;
		$target_tahun_rp = "target_tahun_".$tahun."_rp";

		foreach($result->result() as $key => $row)
		{
			
			$realisasi_tahun_kemarin = 0;
			$realisasi_tahun_kemarin_rp = 0;

			$realisasi_ = 0;
			$realisasi_rp = 0;

			if($tahun_kemarin>0)
			{
				if(!empty($realisasi[$row->id_indikator_program_renstra][$tahun_kemarin]))
				{
					$capaian = $realisasi[$row->id_indikator_program_renstra][$tahun_kemarin];
					$realisasi_tahun_kemarin = $capaian->realisasi;
					$realisasi_tahun_kemarin_rp = $capaian->realisasi_rp;
				}
			}

			if(!empty($realisasi[$row->id_indikator_program_renstra][$tahun]))
			{
				$capaian = $realisasi[$row->id_indikator_program_renstra][$tahun];
				$realisasi_ = $capaian->realisasi;
				$realisasi_rp = $capaian->realisasi_rp;
				$total_realisasi += $realisasi_;
				$total_realisasi_rp += $realisasi_rp;
			}

			$realisasi_kinerja = $realisasi_tahun_kemarin + $realisasi_;
			$realisasi_kinerja_rp = $realisasi_tahun_kemarin_rp + $realisasi_rp;
			$total_realisasi_kinerja += $realisasi_kinerja;
			$total_realisasi_kinerja_rp += $realisasi_kinerja_rp;

			$tingkat_capaian = floor($realisasi_kinerja / 6);
			$tingkat_capaian_rp = floor($realisasi_kinerja_rp / 6);
			$total_tingkat_capaian += $tingkat_capaian;
			$total_tingkat_capaian_rp += $tingkat_capaian_rp;

			$list .= '
			  <tr>
				<td>'.($key+1).'</td>
				<td>'.$row->nama_sasaran_renstra.'</td>
				<td>'.$row->kode_program.'</td>
				<td>'.$row->nama_program.'</td>
				<td>'.$row->nama_indikator_program_renstra.'</td>
				<td>'.$row->target_tahun_5.'</td>
            	<td>'.$row->target_tahun_5_rp.'</td>
				<td>'.$realisasi_tahun_kemarin.'</td>
				<td>'.$realisasi_tahun_kemarin_rp.'</td>
				<td>'.$row->$target_tahun.'</td>
            	<td>'.$row->$target_tahun_rp.'</td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td>'.$realisasi_.'</td>
				<td>'.$realisasi_rp.'</td>
				<td>'.$realisasi_kinerja.'</td>
				<td>'.$realisasi_kinerja_rp.'</td>
				<td>'.$tingkat_capaian.'</td>
				<td>'.$tingkat_capaian_rp.'</td>
				<td>'.$row->nama_skpd.'</td>
				';

			$list .= '</tr>';
		}

		$rata2_realisasi = ($total_realisasi > 0) ? floor($total_realisasi/$total_row) : 0;
		$rata2_realisasi_rp = ($total_realisasi_rp > 0) ? floor($total_realisasi_rp/$total_row) : 0;
		$rata2_realisasi_kinerja = ($total_realisasi_kinerja > 0) ? floor($total_realisasi_kinerja/$total_row) : 0;
		$rata2_realisasi_kinerja_rp = ($total_realisasi_kinerja_rp > 0) ? floor($total_realisasi_kinerja_rp/$total_row) : 0;
		$rata2_tingkat_capaian = ($total_tingkat_capaian > 0) ? floor($total_tingkat_capaian/$total_row) : 0;
		$rata2_tingkat_capaian_rp = ($total_tingkat_capaian_rp > 0) ? floor($total_tingkat_capaian/$total_row) : 0;
		
		$row_rata2_capaian = '<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
		<td>'.$rata2_realisasi.'</td>
		<td>'.$rata2_realisasi_rp.'</td>
		<td>'.$rata2_realisasi_kinerja.'</td>
		<td>'.$rata2_realisasi_kinerja_rp.'</td>
		<td>'.$rata2_tingkat_capaian.'</td>
		<td>'.$rata2_tingkat_capaian_rp.'</td>';

		$predikat[] = $this->Predikat->getPredikat($rata2_realisasi);
		$predikat[] = $this->Predikat->getPredikat($rata2_realisasi_rp);
		$predikat[] = $this->Predikat->getPredikat($rata2_realisasi_kinerja);
		$predikat[] = $this->Predikat->getPredikat($rata2_realisasi_kinerja_rp);
		$predikat[] = $this->Predikat->getPredikat($rata2_tingkat_capaian);
		$predikat[] = $this->Predikat->getPredikat($rata2_tingkat_capaian_rp);

		$row_predikat = '<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>';
		foreach($predikat as $key => $value)
		{
			$row_predikat .= '<td>'.$value.'</td>';
		}

		
  
		$atr = ($download) ? 'border="1" style="border-collapse:collapse;" ' : "";
  
		$content = '
		<table class="table  table-bordered table-responsive" '.$atr.'>
			<tr class="info">
				<th rowspan="2" style="vertical-align: middle;">No</th>
				<th rowspan="2" style="vertical-align: middle;">Sasaran</th>
				<th rowspan="2" style="vertical-align: middle;">Kode</th>
				<th rowspan="2" style="vertical-align: middle;">Urusan/Bidang Urusan Pemerintahan Daerah Dan Program/ Kegiatan</th>
				<th rowspan="2" style="vertical-align: middle;">Indikator Kinerja Program <i>(outcome)</i>/ Kegiatan <i>(output)</i></th>
				<th rowspan="2" colspan="2" style="vertical-align: middle;">Target RPJMD Kabupaten/Kota pada Tahun '.$akhir_tahun.' (Akhir Periode RPJMD)</th>
				<th rowspan="2" colspan="2" style="vertical-align: middle;">Realisasi Capaian Kinerja RPJMD Kabupaten/Kota sampai dengan RKPD Kabupaten/Kota Tahun Lalu (n-2)</th>
				<th rowspan="2" colspan="2" style="vertical-align: middle;">Target Kinerja dan Anggaran RKPD Kabupaten/Kota Tahun Berjalan (Tahun n-1) yang Dievaluasi</th>
				<th colspan="8" style="vertical-align: middle;">Realisasi Kinerja Pada Triwulan</th>
				<th rowspan="2" colspan="2" style="vertical-align: middle;">Realisasi Capaian Kinerja dan Anggaran RKPD Kabupaten/Kota yang Dievaluasi</th>
				<th rowspan="2" colspan="2" style="vertical-align: middle;">Realisasi Kinerja dan Anggaran RPJMD Kabupaten/Kota s/d Tahun '.$tahun_ini.' (Akhir Tahun Pelaksanaan RKPD tahun '.$akhir_tahun.')</th>
				<th rowspan="2" colspan="2" style="vertical-align: middle;">Tingkat Capaian Kinerja dan Realisasi Anggaran RPJMD Kabupaten/Kota s/d Tahun '.$tahun_ini.' (%)</th>
				<th rowspan="2" style="vertical-align: middle;">Perangkat Daerah Penanggung Jawab</th>
  
				<th rowspan="2" >Faktor pendorong keberhasilan pencapaian:</th>
				<th rowspan="2" >Faktor penghambat pencapaian kinerja:</th>
				<th rowspan="2" >Tindak lanjut yang diperlukan dalam triwulan berikutnya:</th>
				<th rowspan="2">Tindak lanjut yang diperlukan dalam RKPD berikutnya:</th>
			</tr>
			<tr class="info">
				<td colspan="2" style="vertical-align: middle;">I</td>
				<td colspan="2" style="vertical-align: middle;">II</td>
				<td colspan="2" style="vertical-align: middle;">III</td>
				<td colspan="2" style="vertical-align: middle;">IV</td>
			</tr>
			<tr class="active">
				<td rowspan="2" style="vertical-align: middle;text-align:center">1</td>
				<td rowspan="2" style="vertical-align: middle;text-align:center">2</td>
				<td rowspan="2" style="vertical-align: middle;text-align:center">3</td>
				<td rowspan="2" style="vertical-align: middle;text-align:center">4</td>
				<td rowspan="2" style="vertical-align: middle;text-align:center">5</td>
				<td colspan="2" style="vertical-align: middle;text-align:center">6</td>
				<td colspan="2" style="vertical-align: middle;text-align:center">7</td>
				<td colspan="2" style="vertical-align: middle;text-align:center">8</td>
				<td colspan="2" style="vertical-align: middle;text-align:center">9</td>
				<td colspan="2" style="vertical-align: middle;text-align:center">10</td>
				<td colspan="2" style="vertical-align: middle;text-align:center">11</td>
				<td colspan="2" style="vertical-align: middle;text-align:center">12</td>
				<td colspan="2" style="vertical-align: middle;text-align:center">13</td>
				<td colspan="2" style="vertical-align: middle;text-align:center">14 = 7 + 13</td>
				<td colspan="2" style="vertical-align: middle;text-align:center">15 = 14/6 X100%</td>
				<td rowspan="2" style="vertical-align: middle;text-align:center">16</td>
				<td rowspan="2" style="vertical-align: middle;text-align:center">17</td>
				<td rowspan="2" style="vertical-align: middle;text-align:center">18</td>
				<td rowspan="2" style="vertical-align: middle;text-align:center">19</td>
				<td rowspan="2" style="vertical-align: middle;text-align:center">20</td>
			</tr>
			<tr class="active">
				<td style="vertical-align: middle;text-align:center">K</td>
				<td style="vertical-align: middle;text-align:center">Rp</td>
				<td style="vertical-align: middle;text-align:center">K</td>
				<td style="vertical-align: middle;text-align:center">Rp</td>
				<td style="vertical-align: middle;text-align:center">K</td>
				<td style="vertical-align: middle;text-align:center">Rp</td>
				<td style="vertical-align: middle;text-align:center">K</td>
				<td style="vertical-align: middle;text-align:center">Rp</td>
				<td style="vertical-align: middle;text-align:center">K</td>
				<td style="vertical-align: middle;text-align:center">Rp</td>
				<td style="vertical-align: middle;text-align:center">K</td>
				<td style="vertical-align: middle;text-align:center">Rp</td>
				<td style="vertical-align: middle;text-align:center">K</td>
				<td style="vertical-align: middle;text-align:center">Rp</td>
				<td style="vertical-align: middle;text-align:center">K</td>
				<td style="vertical-align: middle;text-align:center">Rp</td>
				<td style="vertical-align: middle;text-align:center">K</td>
				<td style="vertical-align: middle;text-align:center">Rp</td>
				<td style="vertical-align: middle;text-align:center">K</td>
				<td style="vertical-align: middle;text-align:center">Rp</td>
			</tr>
			'.$list.'
			<tr>
			  <td colspan="11" style="text-align: right;">Rata-rata capaian kinerja (%)</td>
			  '.$row_rata2_capaian.'
			  <td colspan="5"></td>
		  
			</tr>
			<tr>
			  <td colspan="11" style="text-align: right;">Predikat kinerja</td>
			  '.$row_predikat.'
			  <td colspan="5"></td>
			</tr>
		  
		  </table>
		  
		';
		return $content;
    }

}