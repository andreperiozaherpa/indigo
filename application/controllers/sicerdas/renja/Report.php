<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Report extends CI_Controller
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
		$this->array_privileges = explode(';', $this->user_privileges);

        

        $hasPrivilege = ($this->user_level == "Administrator" OR in_array('tapem', $this->array_privileges));

        if(!$hasPrivilege)
        {
            show_404();
        }

        $this->load->model("sicerdas/Globalvar");
        $this->load->model("kinerja/Skpd");
        $this->load->model("sicerdas/renja/Sub_kegiatan_indikator_model");

	}

    public function index()
    {
        $data['title']		    = 'Laporan Renja | Sicerdas';
		$data['content']	    = "sicerdas/renja/report/index";
		$data['user_picture']   = $this->user_picture;
		$data['full_name']		= $this->full_name;
		$data['user_level']		= $this->user_level;
        $data['plugins']        = ['select','sweetalert'];
        $data['active_menu']    = "renja_report";

        $param = array();
        if($this->id_skpd && $this->id_skpd != 1)
        {
            $param['where']['skpd.id_skpd'] = $this->id_skpd;
        }

        $data['dt_skpd']        = $this->Skpd->get($param);

        $data['dt_urusan'] = $this->db->get("sc_ref_urusan")->result();

        $this->load->view('admin/main', $data);
    }

    public function get_data()
    {
        $id_skpd = $this->input->post("id_skpd");
        $id_urusan = $this->input->post("id_urusan");
        $tahun = $this->input->post("tahun");

        $data['post'] = $_POST;

        if($this->input->is_ajax_request() && $id_skpd && $id_urusan && $tahun)
        {

            $data['content'] = $this->get_content($id_skpd,$id_urusan,$tahun);
            $data['status'] = true;
            
        }
        
        echo json_encode($data);
    }

    private function get_content($id_skpd,$id_urusan,$tahun)
    {
        $param = array();
        $param['where']['sasaran.id_skpd'] = $id_skpd;
        $param['where']['urusan.id_urusan'] = $id_urusan;
        $param['where']['renja_sub_kegiatan.tahun'] = $tahun;
        $dt = $this->Sub_kegiatan_indikator_model->get($param)->result();

        $report = array();

        foreach($dt as $row)
        {
            if(empty($report['program'][$row->id_ref_program]))
            {
                $report['program'][$row->id_ref_program] = array(
                    'nama_program'   => $row->nama_program,
                    'rows'           => 0
                );
            }
            
            if(empty($report['program'][$row->id_ref_program]['kegiatan'][$row->id_ref_kegiatan]))
            {
                $report['program'][$row->id_ref_program]['kegiatan'][$row->id_ref_kegiatan] = array(
                    'nama_kegiatan' => $row->nama_kegiatan,
                    'rows'          => 0
                );
            }

            if(empty($report['program'][$row->id_ref_program]['kegiatan'][$row->id_ref_kegiatan]['sub_kegiatan'][$row->id_sub_kegiatan]))
            {
                $report['program'][$row->id_ref_program]['kegiatan'][$row->id_ref_kegiatan]['sub_kegiatan'][$row->id_sub_kegiatan] = array(
                    'nama_sub_kegiatan' => $row->nama_sub_kegiatan,
                    'rows'          => 0
                );
            }

            if(empty($report['program'][$row->id_ref_program]['kegiatan'][$row->id_ref_kegiatan]['sub_kegiatan'][$row->id_sub_kegiatan]['indikator'][$row->id_indikator_sub_kegiatan]))
            {
                $report['program'][$row->id_ref_program]['kegiatan'][$row->id_ref_kegiatan]['sub_kegiatan'][$row->id_sub_kegiatan]['indikator'][$row->id_indikator_sub_kegiatan] = array(
                    'nama_indikator_sub_kegiatan' => $row->nama_indikator_sub_kegiatan,
                    'satuan'            => $row->satuan_desc,
                    'target'            => $row->target
                );
            }

            $report['program'][$row->id_ref_program]['kegiatan'][$row->id_ref_kegiatan]['sub_kegiatan'][$row->id_sub_kegiatan]['rows']++;
            $report['program'][$row->id_ref_program]['kegiatan'][$row->id_ref_kegiatan]['rows']++;
            $report['program'][$row->id_ref_program]['rows']++;
        }
        //echo "<pre>";print_r($report);
        $content = '';

        if($dt)
        {
            $list = '';
            $no=1;
            foreach($report['program'] as $id_ref_program => $program)
            {
                //echo "<pre>";print_r($k);
                $list .= '
                    <tr>
                        <td rowspan="'.$program['rows'].'">'.$no.'</td>
                        <td rowspan="'.$program['rows'].'">'.$program['nama_program'].'</td>
                ';

                $num_kegiatan = 0;

                foreach($program['kegiatan'] as $id_ref_kegiatan => $kegiatan)
                {
                    if($num_kegiatan > 0)
                    {
                        $list .= "<tr>";
                    }
                    $list .= '<td rowspan="'.$kegiatan['rows'].'">'.$kegiatan['nama_kegiatan'].'</td>';
                    $id_ref_kegiatan_last = $id_ref_kegiatan;


                    $num_sub_kegiatan = 0;


                    foreach($kegiatan['sub_kegiatan'] as $id_sub_kegiatan => $sub_kegiatan)
                    {
                        if($num_sub_kegiatan >0)
                        {
                            $list .= "<tr>";
                        }

                        $list .= '<td rowspan="'.$sub_kegiatan['rows'].'">'.$sub_kegiatan['nama_sub_kegiatan'].'</td>';
                        
                        $num_indikator = 0;

                        foreach($sub_kegiatan['indikator'] as $id_indikator_sub_kegiatan => $indikator)
                        {
                            if($num_indikator>0)
                            {
                                $list .= "<tr>";
                            }
                            $list .= '<td>'.$indikator['nama_indikator_sub_kegiatan'].'</td>';
                            $list .= '<td>'.$indikator['satuan'].'</td>';
                            $list .= '<td>'.$indikator['target'].'</td>';
                            $list .= '<td></td>';
                            $list .= '<td></td>';
                            $list .= '<td></td>';
                            $id_indikator_sub_kegiatan_last = $id_indikator_sub_kegiatan;

                            $list .= '</tr>';

                            $num_indikator++;
                        }
                        $num_sub_kegiatan++;
                    }
                    $num_kegiatan++;
                }

                



                $list .= '</tr>';

                $no++;
            }
            $content = '
                <b>'.$dt[0]->nama_urusan.'</b><br>
                <b>'.$dt[0]->nama_skpd.'</b><br>
                <p>Urusan '.$dt[0]->nama_urusan.' mendapat alokasi anggaran sebesar Rp. ............ dan terealisasi sebesar Rp. ............ atau .... % dengan hasil capaian kinerja Program dan Kegiatan sebagai berikut :</p>

                <table class="table table-bordered" width="100%" border="1" style="border-collapse:collapse">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Urusan/Perangkat Daerah/Program Pemerintahan</th>
                            <th>Kegiatan</th>
                            <th>Sub Kegiatan</th>
                            <th>Indikator Kerja</th>
                            <th>Satuan</th>
                            <th>Target (Output Dan Outcome Perkegiatan)</th>
                            <th>Realisasi (Perkegiatan)</th>
                            <th>Capaian Kinerja (%)</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="10"><b>'.$dt[0]->nama_urusan.'</b></td>
                        </tr>
                        <tr>
                            <td colspan="10">'.$dt[0]->nama_skpd.'</td>
                        </tr>
                        '.$list.'
                    </tbody>
                </table>
                <p>Permasalahan yang dihadapi dalam penyelenggaraan '.$dt[0]->nama_urusan.' tahun '.$dt[0]->tahun.' dan rumusan solusinya</p>

                <table class="table table-bordered" width="100%" border="1" style="border-collapse:collapse">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Perangkat Daerah</th>
                            <th>Permasalahan</th>
                            <th>Solusi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>'.$dt[0]->nama_skpd.'</td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            ';

        }
        return $content;
    }

    public function download()
    {
        $id_skpd = $this->input->get("id_skpd");
        $id_urusan = $this->input->get("id_urusan");
        $tahun = $this->input->get("tahun");
        if($id_skpd && $id_urusan && $tahun)
        {
            
            $content = $this->get_content($id_skpd,$id_urusan,$tahun);
            //echo $content;die;

            //$this->load->library("HTML_TO_DOC");
            require_once(APPPATH . 'libraries/HTML_TO_DOC.php');

            $doc = new HTML_TO_DOC();

           /*  $content = '<b>'.$dt[0]->nama_urusan.'</b><br>
            <b>'.$dt[0]->nama_skpd.'</b><br>
            <b>Urusan Penunjang Pemerintahan Sekretariat Daerah mendapat alokasi anggaran sebesar Rp. ............  dan terealisasi sebesar Rp. ........... atau ....% dengan hasil capaian kinerja Program dan Kegiatan sebagai berikut :</b> ';
 */
            $doc->createDoc($content,"Laporan.docx",1);

            //echo "<pre>";print_r($dt);
            //echo "<pre>";print_r($report);
        }
    }
}
