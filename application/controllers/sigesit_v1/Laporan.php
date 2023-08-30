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
		$this->id_skpd	= $this->user_model->id_skpd;
		$array_privileges = explode(';', $this->user_privileges);

		if ($this->user_level == "Administrator" OR in_array('sigesit', $array_privileges)) {	}
		else{show_404();}

		$this->load->model("sigesit/Globalvar");
		$this->load->model("sigesit/Program_model");
        $this->load->model("sigesit/Kegiatan_model");
        $this->load->model("sigesit/Penerima_model");

		$this->load->model("sigesit/Realisasi_model");
		$this->load->model("Ref_skpd_model");
	}

    public function index()
	{

		$data['title']		= "sigesit - " . app_name;
		$data['content']	= "sigesit/laporan/index";
		$data['active_menu'] = "sigesit";
		$data['user_picture'] = $this->user_picture;
		$data['full_name']		= $this->full_name;
		$data['user_level']		= $this->user_level;
		$data['plugins'] = [];

		$this->load->view('admin/main_lite', $data);
		
		
	}

    public function get_list($rowno=1)
    {
        if($this->input->is_ajax_request())
        {
            // Row per page
            $rowperpage = 25;
            $offset = ($rowno-1) * $rowperpage;

            $param = array();
            $param['limit']     = $rowperpage;
            $param['offset']    = $offset;
            
			$data = array(); 

            if($this->input->post("search"))
            {
                $param['search'] = $this->input->post("search");
            }

            if($this->id_skpd)
            {
                $param['where']['kegiatan.id_skpd'] = $this->id_skpd;
            }

            if($this->input->post("id_skpd"))
            {
                $param['where']['kegiatan.id_skpd'] = $this->input->post("id_skpd");
            }

            $result = $this->Kegiatan_model->get($param)->result();

            $ids_kegiatan = array();
                foreach($result as $row)
                {
                    $ids_kegiatan[] = $row->id_kegiatan;
                }
    
                $total = array();
                if($ids_kegiatan)
                {
                    $param_total['str_where'] = "(penerima.id_kegiatan in (".implode(",",$ids_kegiatan)."))";
                    $param_total['group_by'] = "id_kegiatan";
					$param_total['where']['penerima.final'] = "Y";
					$param_total['where']['penerima.status !='] = "Dibatalkan";
                    $dt_total = $this->Penerima_model->get_total($param_total)->result();
                    foreach($dt_total as $row)
                    {
                        $total[$row->id_kegiatan]['total'] = $row->total;
                    }

					$param_total['where']['penerima.status'] = "Selesai";
                    $dt_total_selesai = $this->Penerima_model->get_total($param_total)->result();
                    foreach($dt_total_selesai as $row)
                    {
                        $total[$row->id_kegiatan]['selesai'] = $row->total;
                    }

					$param_realisasi['str_where'] = "(realisasi.id_kegiatan in (".implode(",",$ids_kegiatan)."))";
                    $param_realisasi['group_by'] = "id_kegiatan";
					$dt_realisasi = $this->Realisasi_model->get_total($param_realisasi)->result();
                    foreach($dt_realisasi as $row)
                    {
                        $total[$row->id_kegiatan]['realisasi'] = $row->total;
                    }
                }

			$content = '';
            foreach($result as $key=>$row)
            {
				$token = md5("KEGIATAN".$row->id_kegiatan) ;

                $capaian = "-";
                if($row->realisasi_anggaran>0)
                {
                    $capaian = number_format($row->realisasi_anggaran / $row->total_anggaran * 100)."%";
                }

                

                $total_penerima = !empty($total[$row->id_kegiatan]['total']) ? $total[$row->id_kegiatan]['total'] : 0;
				$total_selesai = !empty($total[$row->id_kegiatan]['selesai']) ? $total[$row->id_kegiatan]['selesai'] : 0;

				$total_realisasi = !empty($total[$row->id_kegiatan]['realisasi']) ? $total[$row->id_kegiatan]['realisasi'] : 0;

                $capaian_anggaran = ($total_realisasi) ? ($total_realisasi / $row->realisasi_anggaran * 100) : 0;

				$progress = ($total_selesai > 0) ? ($total_selesai / $total_penerima * 100) : 0;

                $status = "Belum selesai";
                $color = "yellow";
                if($total_selesai >0 && $total_selesai == $total_penerima)
                {
                    $status = "Selesai";
                    $color = "#bbf0c6";
                }

                $content .= '
                    <tr>
                        <td>'.($key+1).'</td>
                        <td>'.$row->tahun.'</td>
                        <td>'.$row->nama_skpd.'</td>
                        <td>'.$row->kode_program.' '.$row->nama_program.'</td>
                        <td>'.$row->kode_kegiatan.' '.$row->nama_kegiatan.'</td>
                        <td>'.$row->kode_sub_kegiatan.' '.$row->nama_sub_kegiatan.'</td>
                        <td>'.$row->output_kegiatan.'</td>
                        <td>'.$row->sasaran.'</td>
                        <td>'.$row->nama_sumber_anggaran.'</td>
                        <td>'.$row->target.'</td>
                        <td>'.$row->satuan.'</td>
                        <td>'.number_format($row->total_anggaran).'</td>
                        <td>'.$row->target_anggaran.'</td>
                        <td>'.$row->satuan_anggaran.'</td>
                        <td>'.number_format($row->realisasi_anggaran).'</td>
                        <td>'.number_format($total_realisasi).'</td>
                        <td>'.$capaian_anggaran.'</td>
                        <td>'.$total_selesai.'</td>
                        <td>'.$progress.'%</td>
                        <td style="background-color:'.$color.'">'.$status.'</td>
                    </tr>
				';
                $offset++;
            }

			if(!$result)
			{
				$content = '
				<tr>
                    <td colspan="20" align="center">Tidak ada data</td>
                </tr>
				';
			}

            unset($param['limit']);
            unset($param['offset']);
            $total_rows = $this->Kegiatan_model->get($param)->num_rows();


            $this->load->library('pagination');



            // Pagination Configuration
            $config['base_url'] = "";
            $config['use_page_numbers'] = TRUE;
            $config['total_rows'] = $total_rows;
            $config['per_page'] = $rowperpage;
            $config['attributes'] = array('class' => 'btn btn-default btn-outline btn-xm');

            $config = array_merge($config,$this->Globalvar->pagination_config());
            
            // Initialize
            $this->pagination->initialize($config);

            $link = $this->pagination->create_links();
            $link = str_replace("<strong>", "<button type='button' class='btn btn-primary btn-xm secondary' >", $link);
            $link = str_replace("</strong>", "</button>", $link);

            // Initialize $data Array
            $data['pagination'] = $link;
            $data['result']     = $result;
            $data['row']        = $offset;
            $data['csrf_hash']  = $this->security->get_csrf_hash();
            $data['param'] 		= $param;
			$data['content'] 	= $content;
            echo json_encode($data);


        }
    }

}