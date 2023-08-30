<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Renja extends CI_Controller
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
			$data['content']	= "sievka/evaluasi/renja";
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
			header("Content-Disposition: attachment; filename=Evaluasi_terhadap_Hasil_Renja.xls");
            $content = $this->getContent($id_skpd,$tahun,true);
            echo '<h2>Evaluasi terhadap Hasil Renja</h2>
            <h3>'.$skpd->nama_skpd.'</h3>'.$content;
            
          }
        }


    }


    private function getContent($id_skpd,$tahun,$download=false)
    {
		$this->load->model("sicerdas/renstra/Kegiatan_indikator_model");
		$this->load->model("sicerdas/renstra/Kegiatan_model");
		
		
		$dt_tahun = $this->Globalvar->get_tahun();

		$akhir_tahun = $dt_tahun[4];
		$tahun_ini = $dt_tahun[($tahun-1)];

		$tahun_kemarin = $tahun - 1;
  
		$list = '';

		$param['where']['sasaran.id_skpd'] = $id_skpd;
      	$result = $this->Kegiatan_indikator_model->get($param);

		$total_row = $result->num_rows();

		$target_tahun = "target_tahun_".$tahun;
		$target_tahun_rp = "target_tahun_".$tahun."_rp";

		$ids = array();
        foreach($result->result() as $row)
        {
            $ids[] = $row->id_indikator_kegiatan;
        }

		if($ids)
		{
			$this->load->model("kinerja/Laporan_model");

			
			$param['group_by'] = "id_kegiatan_indikator";
            $param['str_where'] = "(cascading.id_kegiatan_indikator in (".implode(",",$ids).") )";
			$param['where']['renaksi.tahun'] = $tahun;
            $summary = $this->Laporan_model->getSummary($param)->result();

			$dt_capaian = array();
            foreach($summary as $s)
            {
                $dt_capaian[$s->id_kegiatan_indikator] = $s;
            }

			//echo print_r($dt_capaian);

			if($tahun_kemarin>0)
			{
				$param['where']['renaksi.tahun'] = $tahun_kemarin;
				$summaryTahunKemarin = $this->Laporan_model->getSummary($param)->result();
	
				$dt_capaian_tahun_kemarin = array();
				foreach($summaryTahunKemarin as $s)
				{
					$dt_capaian_tahun_kemarin[$s->id_kegiatan_indikator] = $s;
				}

			}

			// capaian triwulan
			$dt_triwulan = array();
			$triwulan = array();

			$param['where']['renaksi.tahun'] = $tahun;
			$param['bulan'] = array(1,2,3);
			$dt_triwulan[1] = $this->Laporan_model->getSummary($param)->result();
			
			$param['bulan'] = array(4,5,6);
			$dt_triwulan[2] = $this->Laporan_model->getSummary($param)->result();

			$param['bulan'] = array(7,8,9);
			$dt_triwulan[3] = $this->Laporan_model->getSummary($param)->result();

			$param['bulan'] = array(10,11,12);
			$dt_triwulan[4] = $this->Laporan_model->getSummary($param)->result();

			for($i=1; $i <= 4 ; $i++)
			{
				foreach($dt_triwulan[$i] as $r)
				{
					$triwulan[$i][$r->id_kegiatan_indikator] = $r;
				}
			}
		}

		$total_capaian = 0;
		$total_capaian_kinerja = 0;
		$total_tingkat_capaian = 0;
		$total_triwulan = array();

		foreach($result->result() as $key => $row)
		{

			$capaian_tahun_kemarin = 0;
			$capaian = 0;

            if(!empty($dt_capaian[$row->id_indikator_kegiatan]))
            {
                $capaian = number_format($dt_capaian[$row->id_indikator_kegiatan]->capaian,0);
            }

			if(!empty($dt_capaian_tahun_kemarin[$row->id_indikator_kegiatan]))
            {
                $capaian_tahun_kemarin = number_format($dt_capaian_tahun_kemarin[$row->id_indikator_kegiatan]->capaian,0);
            }

			$capaian_kinerja = $capaian_tahun_kemarin + $capaian;

			$tingkat_capaian = floor($capaian_kinerja / 5);

			$total_capaian += $capaian;
			$total_capaian_kinerja += $capaian_kinerja;
			$total_tingkat_capaian += $tingkat_capaian;

			$col_triwulan = '';
			for($i=1;$i<=4;$i++)
			{
				$capaian_triwulan = 0;
				if(!empty($triwulan[$i][$row->id_indikator_kegiatan]))
				{
					$capaian_triwulan = number_format($triwulan[$i][$row->id_indikator_kegiatan]->capaian,0);
				}
				$col_triwulan .= '<td>'.$capaian_triwulan.'</td><td></td>';
				$total_triwulan[$i] = !empty($total_triwulan[$i]) ? ($total_triwulan[$i] + $capaian_triwulan) : $capaian_triwulan;
			}

			$dt_unit_kerja = $this->Kegiatan_model->getUnitKerja($row->id_kegiatan,"nama_unit_kerja");
			$unit_kerja = "<ul><li>" . implode("</li><li>",$dt_unit_kerja) . "</li></ul>";
			

			$list .= '<tr>
				<td>'.($key+1).'</td>
				<td>'.$row->nama_sasaran_renstra.'</td>
				<td>'.$row->nama_kegiatan.'</td>
				<td>'.$row->nama_indikator_kegiatan.'</td>
				<td>'.$row->target_tahun_5.'</td>
				<td>'.$row->target_tahun_5_rp.'</td>
				<td>'.$capaian_tahun_kemarin.'</td>
				<td></td>
				<td>'.$row->$target_tahun.'</td>
				<td>'.$row->$target_tahun_rp.'</td>
				'.$col_triwulan.'
				<td>'.$capaian.'</td>
				<td></td>
				<td>'.$capaian_kinerja.'</td>
				<td></td>
				<td>'.$tingkat_capaian.'</td>
				<td></td>
				<td>'.$unit_kerja.'</td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			';;
		}

		
		$rata2_capaian = ($total_capaian > 0) ? floor($total_capaian/$total_row) : 0;
		$rata2_capaian_kinerja = ($total_capaian_kinerja > 0) ? floor($total_capaian_kinerja/$total_row) : 0;
		$rata2_tingkat_capaian = ($total_tingkat_capaian > 0) ? floor($total_tingkat_capaian/$total_row) : 0;

		
		$row_rata2_capaian = '';

		for($i=1;$i<=4;$i++)
		{
			$rata2_capaian_triwulan = ($total_triwulan[$i] > 0) ? floor($total_triwulan[$i]/$total_row) : 0;
			$row_rata2_capaian .= '<td>'.$rata2_capaian_triwulan.'</td><td></td>';
			$predikat[] = $this->Predikat->getPredikat($rata2_capaian_triwulan);
		}

		$row_rata2_capaian.='
		<td>'.$rata2_capaian.'</td>
		<td></td>
		<td>'.$rata2_capaian_kinerja.'</td>
		<td></td>
		<td>'.$rata2_tingkat_capaian.'</td>
		<td></td>
		';

		$predikat[] = $this->Predikat->getPredikat($rata2_capaian);
		$predikat[] = $this->Predikat->getPredikat($rata2_capaian_kinerja);
		$predikat[] = $this->Predikat->getPredikat($rata2_tingkat_capaian);

		$row_predikat = '';
		foreach($predikat as $key => $value)
		{
			$row_predikat .= '<td>'.$value.'</td><td></td>';
		}


	
		$atr = ($download) ? 'border="1" style="border-collapse:collapse;" ' : "";
  
		$content = '
		<table class="table  table-bordered table-responsive" '.$atr.'>
			<tr class="info">
				<th rowspan="2" style="vertical-align: middle;">No</th>
				<th rowspan="2" style="vertical-align: middle;">Sasaran</th>
				<th rowspan="2" style="vertical-align: middle;">Program / Kegiatan</th>
				<th rowspan="2" style="vertical-align: middle;">Indikator Kinerja Program <i>(outcome)</i> / Kegiatan <i>(output)</i></th>
				<th rowspan="2" colspan="2" style="vertical-align: middle;">Target Renstra Perangkat Daerah pada Tahun '.$akhir_tahun.' (Akhir Periode Renstra Perangkat Daerah)</th>
				<th rowspan="2" colspan="2" style="vertical-align: middle;">Realisasi Capaian Kinerja Renstra Perangkat Daerah sampai dengan Renja Perangkat Daerah Tahun Lalu (n-2)</th>
				<th rowspan="2" colspan="2" style="vertical-align: middle;">Target Kinerja dan Anggaran Renja Perangkat Daerah Tahun berjalan (Tahun n-1) yang dievaluasi</th>
				<th colspan="8" style="vertical-align: middle;">Realisasi Kinerja Pada Triwulan</th>
				<th rowspan="2" colspan="2" style="vertical-align: middle;">Realisasi Capaian Kinerja dan Anggaran Renja Perangkat Daerah yang dievaluasi</th>
				<th rowspan="2" colspan="2" style="vertical-align: middle;">Realisasi kinerja dan Anggaran Renstra Perangkat Daerah s/d tahun '.$tahun_ini.' (Akhir Tahun Pelaksanaan Renja Perangkat Daerah Tahun '.$akhir_tahun.')</th>
				<th rowspan="2" colspan="2" style="vertical-align: middle;">Tingkat Capaian Kinerja Dan Realisasi Anggaran Renstra Perangkat Daerah s/d tahun '.$tahun_ini.' (%)</th>
				<th rowspan="2"  style="vertical-align: middle;">Unit Perangkat Daerah Penanggung Jawab</th>
  
				<th rowspan="2" >Faktor pendorong keberhasilan kinerja:</th>
				<th rowspan="2" >Faktor penghambat pencapaian kinerja:</th>
				<th rowspan="2" >Tindak lanjut yang diperlukan dalam triwulan berikutnya*):</th>
				<th rowspan="2">Tindak lanjut yang diperlukan dalam RKPD berikutnya*):</th>
			</tr>
			<tr class="info">
				<td colspan="2" style="vertical-align: middle;">I</td>
				<td colspan="2" style="vertical-align: middle;">II</td>
				<td colspan="2" style="vertical-align: middle;">III</td>
				<td colspan="2" style="vertical-align: middle;">IV</td>
			</tr>
			<tr class="active">
				<td rowspan="2" style="vertical-align: middle;">1</td>
				<td rowspan="2" style="vertical-align: middle;">2</td>
				<td rowspan="2" style="vertical-align: middle;">3</td>
				<td rowspan="2" style="vertical-align: middle;" >4</td>
				<td colspan="2" style="vertical-align: middle;">5</td>
				<td colspan="2" style="vertical-align: middle;">6</td>
				<td colspan="2" style="vertical-align: middle;">7</td>
				<td colspan="2" style="vertical-align: middle;">8</td>
				<td colspan="2" style="vertical-align: middle;">9</td>
				<td colspan="2" style="vertical-align: middle;">10</td>
				<td colspan="2" style="vertical-align: middle;">11</td>
				<td colspan="2" style="vertical-align: middle;">12</td>
				<td colspan="2" style="vertical-align: middle;">13 = 6 + 12</td>
				<td colspan="2" style="vertical-align: middle;">14=13/5x100%</td>
				<td rowspan="2" style="vertical-align: middle;">15</td>
				<td rowspan="2" style="vertical-align: middle;text-align:center">16</td>
				<td rowspan="2" style="vertical-align: middle;text-align:center">17</td>
				<td rowspan="2" style="vertical-align: middle;text-align:center">18</td>
				<td rowspan="2" style="vertical-align: middle;text-align:center">19</td>
			</tr>
			<tr class="active">
				<td>K</td>
				<td>Rp</td>
				<td>K</td>
				<td>Rp</td>
				<td>K</td>
				<td>Rp</td>
				<td>K</td>
				<td>Rp</td>
				<td>K</td>
				<td>Rp</td>
				<td>K</td>
				<td>Rp</td>
				<td>K</td>
				<td>Rp</td>
				<td>K</td>
				<td>Rp</td>
				<td>K</td>
				<td>Rp</td>
				<td>K</td>
				<td>Rp</td>
			</tr>
			'.$list.'
			<tr>
			  <td colspan="10" style="text-align: right;">Rata-rata capaian kinerja (%)</td>
			  '.$row_rata2_capaian.'
			  <td colspan="5"></td>
		  
			</tr>
			<tr>
			  <td colspan="10" style="text-align: right;">Predikat kinerja</td>
			  '.$row_predikat.'
			  <td colspan="5"></td>
			</tr>
		  
		  </table>
		  
		';
		return $content;
    }

}