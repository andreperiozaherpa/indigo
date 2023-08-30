<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Instruksi extends CI_Controller
{
	public $user_id;

	public function __construct()
	{
		parent::__construct();
		$this->user_id = $this->session->userdata('user_id');
        $this->id_skpd = $this->session->userdata('id_skpd');

		if (!$this->user_id) {
            redirect('admin');
        }

        $this->load->model("kinerja/Config");
        $this->load->model("sicerdas/Globalvar");
        $this->load->model("sicerdas/Cascading_model");
        $this->load->model("sicerdas/Pegawai_model");
        $this->load->model("kinerja/Skp_model");
        $this->load->model("kinerja/Instruksi_model");

        $param_pegawai['where']['pegawai.id_user'] =  $this->session->id_user;

        $dt_pegawai = $this->Pegawai_model->get($param_pegawai)->row();

        $this->role_pimpinan = ($dt_pegawai && $dt_pegawai->kepala_skpd == "Y" && in_array($dt_pegawai->jenis_skpd,['skpd','kecamatan']));


        $this->pegawai = $dt_pegawai;

	}

    public function get_data()
    {
        $tahun = $this->input->post("tahun");
        $id_skp = $this->input->post("id_skp");
        if($this->input->is_ajax_request() && ($tahun || $id_skp))
        {
            $offset = 0;
            $param = array();

			$data = array();
            $result = [];

            $editData = [];

            if($id_skp)
            {
                $param_['where']['instruksi_khusus.id_skp'] = $id_skp;
                $result = $this->Instruksi_model->get_instruksi_khusus($param_)->result();

                foreach($result as $r)
                {
                    $editData[$r->id_instruksi] = $r;
                }

                $param_detail['where']["skp.id_skp"] = $id_skp;
                $detail = $this->Skp_model->get($param_detail)->row();
                $tahun = $detail->tahun;
            }
            
            $param['where']['cascading.flag'] = "instruksi";
            $param['where']['cascading.tahun'] = $tahun;
            $param['where']['cascading.id_pegawai'] = $this->pegawai->id_pegawai;
            
            $dt_result = $this->Cascading_model->get($param)->result();

            if($editData)
            {
                $result = [];
                foreach($dt_result as $k => $r)
                {
                    if(!empty($editData[$r->id_instruksi]))
                    {
                        $result[$k] = $editData[$r->id_instruksi];
                    }
                    else{
                        $result[$k] = $r;
                    }
                }
            }
            else{
                $result = $dt_result;
            }



			$content = '';
            foreach($result as $key=>$row)
            {
                $target = !empty($row->instruksi_target) ? $row->instruksi_target : $row->target;
                $satuan = !empty($row->instruksi_satuan) ? $row->instruksi_satuan : $row->satuan_desc;

                $indikator_kinerja_individu = ($id_skp && !empty($row->indikator_kinerja_individu)) ? $row->indikator_kinerja_individu : "";

                $id_instruksi_khusus = ($id_skp && !empty($row->id_instruksi_khusus)) ? $row->id_instruksi_khusus : 0;
                $input_id = '<input type="hidden" value="'.$id_instruksi_khusus.'" id="instruksi_id_instruksi_khusus'.$row->id_instruksi.'" name="instruksi[id_instruksi_khusus]['.$row->id_instruksi.']" />';

                if($this->role_pimpinan)
                {
                    $dt_perspektif = ($id_skp && !empty($row->perspektif)) ? explode(",",$row->perspektif) : [];

                    $content .= '
                    <tr>
                        <td>'.($offset+1).$input_id.'</td>
                        <td>'.$row->nama_instruksi.'</td>
                        <td>
                            <input value="'.$indikator_kinerja_individu.'" id="instruksi_indikator_kinerja_individu_'.$row->id_instruksi.'"  type="text" class="form-control" placeholder="Nama indikator" name="instruksi[indikator_kinerja_individu]['.$row->id_instruksi.']" />
                            <div class="text-danger error" id="err_instruksi_indikator_kinerja_individu_'.$row->id_instruksi.'"></div>
                        </td>
                        <td>'.$target.'</td>
                        <td>'.$satuan.'</td>
                        <td>
                        <select id="instruksi_perspektif_'.$row->id_instruksi.'" class="form-control_ instruksi" multiple name="instruksi[perspektif]['.$row->id_instruksi.'][]">';
                            foreach($this->Config->perspektif as $key => $value){
                                $selected = ($dt_perspektif && in_array($value,$dt_perspektif)) ? "selected" : "";
                                $content .= '<option '.$selected.' value="'.$value.'">'.$value.'</option>';
                            }
                            
                        $content .='</select>';

                    $content .='
                            <div class="text-danger error" id="err_instruksi_perspektif_'.$row->id_instruksi.'"></div>
                        </td>
                    </tr>
                    ';

                }
                else{
                    $dt_aspek = ($id_skp && !empty($row->aspek)) ? explode(",",$row->aspek) : [];
                    $content .= '
                    <tr>
                        <td>'.($offset+1).$input_id.'</td>
                        <td>'.$row->nama_instruksi_atasan.'</td>
                        <td>'.$row->nama_instruksi.'</td>
                        <td>
                            <select id="instruksi_aspek_'.$row->id_instruksi.'"  class="form-control_ instruksi" multiple name="instruksi[aspek]['.$row->id_instruksi.'][]">';
                            
                            foreach($this->Config->aspek as $key => $value){
                                $selected = ($dt_aspek && in_array($value,$dt_aspek)) ? "selected" : "";
                                $content .= '<option  '.$selected.' value="'.$value.'">'.$value.'</option>';
                            }
                            
                        $content .='</select>';

                    $content .='
                            <div class="text-danger error" id="err_instruksi_aspek_'.$row->id_instruksi.'"></div>
                        </td>
                        <td>
                            <input value="'.$indikator_kinerja_individu.'" id="instruksi_indikator_kinerja_individu_'.$row->id_instruksi.'" type="text" class="form-control" placeholder="Nama indikator" name="instruksi[indikator_kinerja_individu]['.$row->id_instruksi.']" />
                            <div class="text-danger error" id="err_instruksi_indikator_kinerja_individu_'.$row->id_instruksi.'"></div>
                        </td>
                        <td>'.$target.'</td>
                        <td>'.$satuan.'</td>
                        
                    </tr>';

                }

                $offset++;
            }

			if(!$result)
			{
				$content = '<tr><td colspan="7" align="center">-Belum ada data-</td></tr>';
			}

            
            $data['result']     = $result;
            $data['content'] 	= $content;
            echo json_encode($data);


        }
    }
    
}