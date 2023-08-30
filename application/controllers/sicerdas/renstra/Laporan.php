<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan extends CI_Controller
{
	public $user_id;

	public function __construct()
	{
		parent::__construct();
		$this->user_id = $this->session->userdata('user_id');
		if (!$this->user_id) {
			redirect('admin');
		}


		$this->user_model->user_id = $this->user_id;
		$this->user_model->set_user_by_user_id();


		$this->user_picture = $this->user_model->user_picture;
		$this->full_name	= $this->user_model->full_name;
		$this->user_level	= $this->user_model->level;
		$this->user_privileges	= $this->user_model->user_privileges;
		$this->array_privileges = explode(';', $this->user_privileges);


		if ($this->user_level == "Administrator" or in_array('program', $this->array_privileges)) {
		} else {
			show_404();
		}

		$this->load->model("sicerdas/Skpd_model");
		$this->load->model("sicerdas/Globalvar");

		$this->load->model("sicerdas/rpjmd/Report_model");

		$this->dt_tahun = $this->Globalvar->get_tahun();
	}


	public function index()
	{
		$data['title']		= "sicerdas - " . app_name;
		$data['content']	= "sicerdas/renstra/laporan/laporan";
		$data['user_picture'] = $this->user_picture;
		$data['full_name']		= $this->full_name;
		// $data['user_level']		= $this->user_level;
		$data['user_level']		= $this->user_level;

		$data['active_menu'] = "renstra_laporan";
		$data['plugins'] = ['select'];

		$param_skpd['where']['skpd.jenis_skpd'] = "skpd";
		$data['dt_skpd'] = $this->Skpd_model->get($param_skpd)->result();


		$data['dt_tahun'] = $this->dt_tahun;

		if ($this->user_level == 'Administrator') {
			$id_skpd = ($this->input->get("id_skpd"))  ? $this->input->get("id_skpd") : $data['dt_skpd'][0]->id_skpd;
		} else {
			$id_skpd = $this->session->userdata('id_skpd');
		}
		$data['id_skpd'] = $id_skpd;
		$dt_report = $this->Report_model->generate($id_skpd);

		$data['detail_skpd'] = $this->db->get_where('ref_skpd', ['id_skpd' => $id_skpd])->row();
		//echo '<pre>';print_r($report);die;

		//$param['id_skpd'] = $id_skpd;
		//$dt_report = $this->Report_model->get($param)->result();

		$data['report'] = $this->get_report($dt_report);

		//echo $data['report'];die;

		if($this->input->get("download")==1)
		{
			
			header("Content-type: application/vnd-ms-excel");
			header("Content-Disposition: attachment; filename=Laporan_renstra.xls");
			echo $data['report'];
		}
		else{
			$this->load->view('admin/main', $data);
		}
	}

	private function get_report($data)
	{
		$content = '';

		$style_header0 = 'style="background-color:#92D050;color:#000;font-weight:bold"';
		$style_header1 = 'style="background-color:#C6E0B4;color:#000;font-weight:bold"';
		$style_header2 = 'style="color:#000;font-weight:bold"';

		$col_tahun = '<tr ' . $style_header0 . '>';
		$col_target = '<tr ' . $style_header0 . '>';
		foreach ($this->dt_tahun as $key => $value) {
			$col_tahun .= '<td colspan="3" align="center">Tahun ' . $value . '</td>';
			$col_target .= '<td align="center">Target</td><td align="center">Satuan</td><td align="center">Rp</td>';
		}
		$col_tahun .= '<td colspan="3" align="center">Kondisi Kinerja pada Akhir Periode RPJMD</td>';
		$col_tahun .= '</tr>';
		$col_target .= '<td align="center">Target</td><td align="center">Satuan</td><td align="center">Rp</td>';
		$col_target .= '</tr>';


		$row_content = '';

		foreach ($data as $row) {
			$style_header = '';
			if ($row['level'] == 1) {
				$style_header = $style_header1;
			} else if ($row['level'] == 2) {
				$style_header = $style_header2;
			} else if ($row['level'] == 3) {
				$style_header = 'style="color:#000;"';
			}

			$target_tahun = '';
			foreach ($row['target_tahun'] as $tahun) {
				$target_tahun .= '<td align="center">' . $tahun['target'] . '</td><td>' . $tahun['satuan'] . '</td><td align="right">' . $tahun['rp'] . '</td>';
			}

			$dt_target_akhir = $row['target_akhir'];
			$target_akhir = '<td align="center">' . $dt_target_akhir['target'] . '</td><td>' . $dt_target_akhir['satuan'] . '</td><td align="right">' . $dt_target_akhir['rp'] . '</td>';

			$row_content .= '
				<tr ' . $style_header . '>
					<td>' . $row['kode'] . '</td>
					<td>' . $row['urusan_program'] . '</td>
					<td>' . $row['indikator'] . '</td>
					' . $target_tahun .
				$target_akhir . '
					<td>' . $row['skpd'] . '</td>
				</tr>
			';
		}

		$content .= '
			<table width="100%" border="1" style="border-collapse:collapse;font-size:11px">
		        <thead>
		          	<tr ' . $style_header0 . '>
		            	<td align="center" rowspan="3">Kode</td>
			            <td align="center" rowspan="3" width="150px">Urusan Pemerintahan Bidang dan Program Prioritas Pembangunan</td>
			            <td align="center" rowspan="3">Indikator Program (outcome)</td>
			            <td align="center" colspan="18">Capaian Kinerja Program dan Kerangka Pendanaan</td>
			            <td align="center" rowspan="3">Perangkat Daerah Penanggungjawab</td>
		          	</tr>
		          	' . $col_tahun . '
		          	
		          	' . $col_target . '

		        </thead>
		        <tbody>
		        	' . $row_content . '
		        </tbody>
		    </table>
		';

		return $content;
	}
}
