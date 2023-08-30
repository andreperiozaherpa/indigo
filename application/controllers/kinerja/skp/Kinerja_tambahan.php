<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kinerja_tambahan extends CI_Controller
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
        $this->load->model("kinerja/Skp_model");
        $this->load->model("kinerja/Kinerja_tambahan_model");
        $this->load->model("sicerdas/Globalvar");
        $this->load->model("sicerdas/Cascading_model");
        $this->load->model("sicerdas/Pegawai_model");

        $param_pegawai['where']['pegawai.id_user'] =  $this->session->id_user;

        $dt_pegawai = $this->Pegawai_model->get($param_pegawai)->row();

        $this->role_pimpinan = ($dt_pegawai && $dt_pegawai->kepala_skpd == "Y" && in_array($dt_pegawai->jenis_skpd,['skpd','kecamatan']));


        $this->pegawai = $dt_pegawai;

	}

    public function get_data()
    {
        $id_skp = $this->input->post("id_skp");
        $content = '';
        $n = 1;
        if($this->input->is_ajax_request() && $id_skp)
        {
            $offset = 0;
            $param = array();

			$data = array();

            $param['where']['kinerja_tambahan.id_skp'] = $id_skp;
            $result = $this->Kinerja_tambahan_model->get($param)->result();

            $param_detail['where']["skp.id_skp"] = $id_skp;
            $detail = $this->Skp_model->get($param_detail)->row();
            $tahun = $detail->tahun;


			
            
            foreach($result as $key=>$row)
            {
                $rencana_hasil_kerja = $row->rencana_hasil_kerja;
                $rencana_hasil_kerja_atasan = $row->rencana_hasil_kerja_atasan;
                $indikator_kinerja_individu = $row->indikator_kinerja_individu;
                $target = $row->target;
                $satuan = $row->satuan;
                $satuan_desc = $row->satuan_desc;

                $content .= '<tr id="row-kinerja-tambahan-'.$n.'">';

                $id_kinerja_tambahan = ($id_skp && $row->id_kinerja_tambahan) ? $row->id_kinerja_tambahan : 0;
                $input_id = '<input type="hidden" value="'.$id_kinerja_tambahan.'" id="kinerja_tambahan_id_kinerja_tambahan_'.$n.'" name="kinerja_tambahan[id_kinerja_tambahan]['.$n.']" />';

                if($this->role_pimpinan)
                {
                    $dt_perspektif = ($id_skp && $row->perspektif) ? explode(",",$row->perspektif) : [];
                    
                    $content .= '
                        <td><label id="label_rencana_hasil_kerja_'.$n.'">'.$row->rencana_hasil_kerja.'</label></td>
                        <td><label id="label_indikator_kinerja_individu_'.$n.'">'.$row->indikator_kinerja_individu.'</label></td>
                        <td><label id="label_target_'.$n.'">'.$target.'</label></td>
                        <td><label id="label_satuan_'.$n.'">'.$satuan_desc.'</label></td>
                        <td>
                            <select id="err_kinerja_tambahan_perspektif_'.$n.'"  class="form-control_ kinerja_tambahan kinerja_tambahan_'.$n.'" multiple name="kinerja_tambahan[perspektif]['.$n.'][]">';
                            foreach($this->Config->perspektif as $k => $value){
                                $selected = ($dt_perspektif && in_array($value,$dt_perspektif)) ? "selected" : "";
                                $content .= '<option '.$selected.' value="'.$value.'">'.$value.'</option>';
                            }
                            
                        $content .='</select>';

                    $content .='
                            <div class="text-danger error" id="err_kinerja_tambahan_perspektif_'.$n.'"></div>
                        </td>
                    ';

                }
                else{
                    $dt_aspek = ($id_skp && $row->aspek) ? explode(",",$row->aspek) : [];
                    $content .= '
                        <td><label id="label_rencana_hasil_kerja_atasan_'.$n.'">'.$rencana_hasil_kerja_atasan.'</label></td>
                        <td><label id="label_rencana_hasil_kerja_'.$n.'">'.$row->rencana_hasil_kerja.'</label></td>
                        <td>
                            <select id="err_kinerja_tambahan_aspek_'.$n.'"  class="form-control_ kinerja_tambahan kinerja_tambahan_'.$n.'" multiple name="kinerja_tambahan[aspek]['.$n.'][]">';
                            foreach($this->Config->aspek as $k => $value){
                                $selected = ($dt_aspek && in_array($value,$dt_aspek)) ? "selected" : "";
                                $content .= '<option '.$selected.' value="'.$value.'">'.$value.'</option>';
                            }
                            
                        $content .='</select>';

                    $content .='
                            <div class="text-danger error" id="err_kinerja_tambahan_perspektif_'.$n.'"></div>
                        </td>
                        <td><label id="label_indikator_kinerja_individu_'.$n.'">'.$row->indikator_kinerja_individu.'</label></td>
                        <td><label id="label_target_'.$n.'">'.$target.'</label></td>
                        <td><label id="label_satuan_'.$n.'">'.$satuan_desc.'</label></td>
                        
                    ';

                }

                $content .= '<td>
                    '.$input_id.'
                    <input type="hidden" id="rencana_hasil_kerja_'.$n.'" value="'.$rencana_hasil_kerja.'" name="kinerja_tambahan[rencana_hasil_kerja]['.$n.']" />
                    <input type="hidden" id="rencana_hasil_kerja_atasan_'.$n.'" value="'.$rencana_hasil_kerja_atasan.'" name="kinerja_tambahan[rencana_hasil_kerja_atasan]['.$n.']" />
                    <input type="hidden" id="indikator_kinerja_individu_'.$n.'" value="'.$indikator_kinerja_individu.'" name="kinerja_tambahan[indikator_kinerja_individu]['.$n.']" />
                    <input type="hidden" id="target_'.$n.'" value="'.$target.'" name="kinerja_tambahan[target]['.$n.']" />
                    <input type="hidden" id="satuan_'.$n.'" value="'.$satuan.'" name="kinerja_tambahan[satuan]['.$n.']" />
                    <div class="btn-group m-b-20" id="btn_kinerja_tambahan_'.$n.'">
                    <a onclick="edit_kinerja_tambahan('.$n.',\''.$rencana_hasil_kerja.'\',\''.$indikator_kinerja_individu.'\',\''.$target.'\',\''.$satuan.'\',\''.$rencana_hasil_kerja_atasan.'\')" 
                    type="button" class="btn btn-sm_ btn-default btn-outline waves-effect"><i class="fa fa-pencil"></i></a>
                    <a onclick="delete_kinerja_tambahan('.$n.')" type="button" class="btn btn-sm_ btn-default btn-outline waves-effect"><i class="fa fa-trash"></i></a>
                    </div>
                    </td></tr>';
                
                $n++;
            }


            
            $data['result']     = $result;
            
            


        }
        else{
            $content = '<tr id="row-kinerja-tambahan-empty">
                            <td colspan="7" align="center">-Belum ada data-</td>
                        </tr>';
        }
        $data['content'] 	= $content;
        $data['n'] = $n;
        echo json_encode($data);
    }
    
}