<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Rpjmd extends CI_Controller
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
	}


	public function index()
	{
		if ($this->user_id) {

			$data['title']		= "sievka - " . app_name;
			$data['content']	= "sievka/evaluasi/rpjmd";
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

          $content = $this->getContent($id_skpd);
          
          $data['content'] 	= $content;
          echo json_encode($data);


        }
    }

    public function download()
    {
        $id_skpd = $this->input->get("id_skpd");
        if($id_skpd)
        {
          
          $skpd = $this->db->where("id_skpd",$id_skpd)->get("ref_skpd")->row();
          if($skpd)
          {
            header("Content-type: application/vnd-ms-excel");
			      header("Content-Disposition: attachment; filename=Evaluasi_terhadap_Hasil_RPJMD.xls");
            $content = $this->getContent($id_skpd,true);
            echo '<h2>Evaluasi terhadap Hasil RPJMD</h2>
            <h3>'.$skpd->nama_skpd.'</h3>'.$content;
            
          }
        }


    }


    private function getContent($id_skpd,$download=false)
    {
      $this->load->model("sicerdas/renstra/Program_indikator_model");
      $this->load->model("kinerja/Realisasi_program_model");

      $list = '';

      $param['where']['sasaran.id_skpd'] = $id_skpd;
      $result = $this->Program_indikator_model->get($param);

      $dt_realisasi = $this->Realisasi_program_model->get($param)->result();
      $realisasi = array();
      foreach($dt_realisasi as $row)
      {
        $realisasi[$row->id_indikator_program_renstra][$row->tahun] = $row;
      }

      $total_row = $result->num_rows();
      $total_capaianArr = array();
      $total_capaian_rpArr = array();
      $total_capaian_akhir = 0;
      $total_capaian_akhir_rp = 0;
      $total_rasio = 0;
      $total_rasio_rp = 0;

      foreach($result->result() as $key => $row)
      {
        
        $list .= '
          <tr>
            <td>'.($key+1).'</td>
            <td>'.$row->nama_sasaran_renstra.'</td>
            <td>'.$row->nama_program.'</td>
            <td>'.$row->nama_indikator_program_renstra.'</td>
            <td></td>
            <td>'.$row->target_akhir.'</td>
            <td>'.$row->target_akhir_rp.'</td>
            <td>'.$row->target_tahun_1.'</td>
            <td>'.$row->target_tahun_1_rp.'</td>
            <td>'.$row->target_tahun_2.'</td>
            <td>'.$row->target_tahun_2_rp.'</td>
            <td>'.$row->target_tahun_3.'</td>
            <td>'.$row->target_tahun_3_rp.'</td>
            <td>'.$row->target_tahun_4.'</td>
            <td>'.$row->target_tahun_4_rp.'</td>
            <td>'.$row->target_tahun_5.'</td>
            <td>'.$row->target_tahun_5_rp.'</td>';
        
        $tahun = 1;
        $capaian_akhir_rp=0;
        $capaian_akhir = 0;
        $rasio = 0;
        $rasio_rp = 0;
        for($tahun=1; $tahun <= 5; $tahun++)
        {
          if(!empty($realisasi[$row->id_indikator_program_renstra][$tahun]))
          {
            $capaian = $realisasi[$row->id_indikator_program_renstra][$tahun];
            $list .= '<td>'.$capaian->realisasi.'</td><td>'.$capaian->realisasi_rp.'</td>';
            $capaian_akhir_rp += $capaian->realisasi_rp;
            $capaian_akhir += $capaian->realisasi;
            $rasio += $capaian->capaian;
            $rasio_rp += $capaian->capaian_rp;
            $total_capaianArr[$tahun] = !empty($total_capaianArr[$tahun]) ? ($total_capaianArr[$tahun] + $capaian->capaian) : $capaian->capaian;
            $total_capaian_rpArr[$tahun] = !empty($total_capaian_rpArr[$tahun]) ? ($total_capaian_rpArr[$tahun] + $capaian->capaian_rp) : $capaian->capaian_rp;
            $total_capaian_akhir += $capaian_akhir;
            $total_capaian_akhir_rp += $capaian_akhir_rp;
            $total_rasio += $rasio;
            $total_rasio_rp += $rasio_rp;
          }
          
          else{
            $list .= '<td></td><td></td>';
          }
        }

        $tahun = 1;
        for($tahun=1; $tahun <= 5; $tahun++)
        {
          if(!empty($realisasi[$row->id_indikator_program_renstra][$tahun]))
          {
            $capaian = $realisasi[$row->id_indikator_program_renstra][$tahun];
            $list .= '<td>'.$capaian->capaian.'</td><td>'.$capaian->capaian_rp.'</td>';
          }
          else{
            $list .= '<td></td><td></td>';
          }
        }

        $rata_capaian_rp= ($rasio_rp > 0) ? floor($rasio_rp / 5) : 0;
        $rata_capaian= ($rasio > 0) ? floor($rasio / 5) : 0;

        $list .= '<td>'.$capaian_akhir.'</td>';
        $list .= '<td>'.$capaian_akhir_rp.'</td>';
        $list .= '<td>'.$rata_capaian.'</td>';
        $list .= '<td>'.$rata_capaian_rp.'</td>';

        $list .= '<td>'.$row->faktor_pendorong.'</td>';
        $list .= '<td>'.$row->faktor_penghambat.'</td>';
        $list .= '<td>'.$row->tindak_lanjut_rkpd.'</td>';
        $list .= '<td>'.$row->tindak_lanjut_rpjmd.'</td>';

        $list .='</tr>';
      }

      $row_rata2_capaian = '';
      $tahun = 1;
      $predikat = array();
      for($tahun=1; $tahun <= 5; $tahun++)
      {
        $rata2 = (!empty($total_capaianArr[$tahun]) && $total_capaianArr[$tahun] > 0) ? floor($total_capaianArr[$tahun] / $total_row) : '';
        $rata2Rp = (!empty($total_capaian_rpArr[$tahun]) && $total_capaian_rpArr[$tahun] > 0) ? floor($total_capaian_rpArr[$tahun] / $total_row) : '';
        $row_rata2_capaian .= '<td>'.$rata2.'</td><td>'.$rata2Rp.'</td>';
       
        $predikat[] = $this->Predikat->getPredikat($rata2);
        $predikat[] = $this->Predikat->getPredikat($rata2Rp);
      }

      $rata2_capaian_akhir = ($total_capaian_akhir > 0) ? floor($total_capaian_akhir/$total_row) : 0;
      $rata2_capaian_akhir_rp = ($total_capaian_akhir_rp > 0) ? floor($total_capaian_akhir_rp/$total_row) : 0;

      $rata2_rasio = ($total_rasio > 0) ? floor($total_rasio/$total_row) : 0;
      $rata2_rasio_rp = ($total_rasio_rp > 0) ? floor($total_rasio_rp/$total_row) : 0;

      $row_rata2_capaian .= '<td>'.$rata2_capaian_akhir.'</td>';
      $row_rata2_capaian .= '<td>'.$rata2_capaian_akhir_rp.'</td>';
      $row_rata2_capaian .= '<td>'.$rata2_rasio.'</td>';
      $row_rata2_capaian .= '<td>'.$rata2_rasio_rp.'</td>';
      
      $predikat[] = $this->Predikat->getPredikat($rata2_capaian_akhir);
      $predikat[] = $this->Predikat->getPredikat($rata2_capaian_akhir_rp);
      $predikat[] = $this->Predikat->getPredikat($rata2_rasio);
      $predikat[] = $this->Predikat->getPredikat($rata2_rasio_rp);

      $row_predikat = '';
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
            <th rowspan="2" style="vertical-align: middle;">Program Prioritas</th>
            <th rowspan="2" style="vertical-align: middle;">Indikator Kinerja</th>
            <th rowspan="2" style="vertical-align: middle;">Data Capaian Pada Awal Tahun Perencanaan</th>
            <th rowspan="2" colspan="2" style="vertical-align: middle;">Target Pada Akhir Tahun Perencanaan</th>
            <th colspan="10" style="vertical-align: middle;">Target RPJMD Kabupaten/Kota pada RKPD Kabupaten/Kota Tahun Ke-</th>
            <th colspan="10" style="vertical-align: middle;">Capaian Target RPJMD Kabupaten/Kota Melalui Pelaksanaan RKPD Tahun Ke-</th>
            <th colspan="10" style="vertical-align: middle;">Tingkat Capaian Target RPJMD Kabupaten/Kota Hasil Pelaksanaan RKPD Kabupaten/Kota Tahun Ke- (%)</th>
            <th rowspan="2" colspan="2" style="vertical-align: middle;">Capaian Pada Akhir Tahun Perencanaan</th>
            <th rowspan="2" colspan="2" style="vertical-align: middle;">Rasio Capaian Akhir (%)</th>

            <th rowspan="2" >Faktor pendorong keberhasilan pencapaian:</th>
            <th rowspan="2" >Faktor penghambat pencapaian kinerja:</th>
            <th rowspan="2" >Tindak lanjut yang diperlukan dalam RKPD kabupaten/kota berikutnya:</th>
            <th rowspan="2">Tindak lanjut yang diperlukan dalam RPJMD kabupaten/kota berikutnya:</th>
          </tr>
          <tr class="info">
            <td colspan="2">1</td>
            <td colspan="2">2</td>
            <td colspan="2">3</td>
            <td colspan="2">4</td>
            <td colspan="2">5</td>
            <td colspan="2">1</td>
            <td colspan="2">2</td>
            <td colspan="2">3</td>
            <td colspan="2">4</td>
            <td colspan="2">5</td>
            <td colspan="2">1</td>
            <td colspan="2">2</td>
            <td colspan="2">3</td>
            <td colspan="2">4</td>
            <td colspan="2">5</td>
          </tr>
          <tr class="active">
            <td rowspan="2">(1)</td>
            <td rowspan="2">(2)</td>
            <td rowspan="2">(3)</td>
            <td rowspan="2">(4)</td>
            <td rowspan="2">(5)</td>
            <td colspan="2">(6)</td>
            <td colspan="2">(7)</td>
            <td colspan="2">(8)</td>
            <td colspan="2">(9)</td>
            <td colspan="2">(10)</td>
            <td colspan="2">(11)</td>
            <td colspan="2">(12)</td>
            <td colspan="2">(13)</td>
            <td colspan="2">(14)</td>
            <td colspan="2">(15)</td>
            <td colspan="2">(16)</td>
            <td colspan="2">(17)</td>
            <td colspan="2">(18)</td>
            <td colspan="2">(19)</td>
            <td colspan="2">(20)</td>
            <td colspan="2">(21)</td>
            <td colspan="2">(22)</td>
            <td colspan="2">(23)</td>
            <td rowspan="2">(24)</td>
            <td rowspan="2">(25)</td>
            <td rowspan="2">(26)</td>
            <td rowspan="2">(27)</td>
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
            <td colspan="27" style="text-align: right;">Rata-rata capaian kinerja (%)</td>
            '.$row_rata2_capaian.'
            <td colspan="4"></td>
        
          </tr>
          <tr>
            <td colspan="27" style="text-align: right;">Predikat kinerja</td>
            '.$row_predikat.'
            <td colspan="4"></td>
          </tr>
        
        </table>
        
      ';
      return $content;
    }


    
}