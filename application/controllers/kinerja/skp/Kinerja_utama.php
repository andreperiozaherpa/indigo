<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kinerja_utama extends CI_Controller
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
        $this->load->model("kinerja/Kinerja_utama_model");
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
        $tahun = $this->input->post("tahun");
        $id_skp = $this->input->post("id_skp");
        if($this->input->is_ajax_request() && ($tahun || $id_skp))
        {
            $offset = 0;
            $param = array();

			$data = array();

            $editData = [];

            if($id_skp)
            {
                $param_skp['where']['kinerja_utama.id_skp'] = $id_skp;
                $result = $this->Kinerja_utama_model->get($param_skp)->result();

                $data['_rs'] = $result;

                foreach($result as $r)
                {
                    if($r->flag=="sasaran"){
                        $editData["sasaran_".$r->id_indikator_sasaran_renstra] = $r;
                    }
                    else if($r->flag=="kegiatan"){
                        $editData["kegiatan_".$r->id_kegiatan_indikator] = $r;
                    }
                    else if($r->flag=="sub_kegiatan"){
                        $editData["sub_kegiatan_".$r->id_sub_kegiatan_indikator] = $r;
                    }
                }

                $param_detail['where']["skp.id_skp"] = $id_skp;
                $detail = $this->Skp_model->get($param_detail)->row();
                $tahun = $detail->tahun;
            }

            $param['where']['cascading.tahun'] = $tahun;
                
            if($this->role_pimpinan)
            {
                $param['where']['cascading.flag'] = "sasaran";
                $param['where']['sasaran.id_skpd'] = $this->id_skpd;
            }
            else{
                $param['str_where'] = "(cascading.flag in ('kegiatan','sub_kegiatan') )";
                $param['where']['cascading.id_pegawai'] = $this->pegawai->id_pegawai;
            }
    
            $data['param'] = $param;

            $dt_result = $this->Cascading_model->get($param)->result();

            if($editData)
            {
                $result = [];
                foreach($dt_result as $k => $r)
                {

                    if(!empty($editData["sasaran_".$r->id_indikator_sasaran_renstra]))
                    {
                        $result[$k] = $editData["sasaran_".$r->id_indikator_sasaran_renstra];
                    }
                    else if(!empty($editData["kegiatan_".$r->id_kegiatan_indikator]))
                    {
                        $result[$k] = $editData["kegiatan_".$r->id_kegiatan_indikator];
                    }
                    else if(!empty($editData["sub_kegiatan_".$r->id_sub_kegiatan_indikator]))
                    {
                        $result[$k] = $editData["sub_kegiatan_".$r->id_sub_kegiatan_indikator];
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
                $id_kinerja_utama = ($id_skp && $row->id_kinerja_utama) ? $row->id_kinerja_utama : 0;
                $input_id = '<input type="hidden" value="'.$id_kinerja_utama.'" id="kinerja_utama_id_kinerja_utama_'.$row->id_cascading.'" name="kinerja_utama[id_kinerja_utama]['.$row->id_cascading.']" />';
                
                if($this->role_pimpinan)
                {
                    $dt_perspektif = ($id_skp && $row->perspektif) ? explode(",",$row->perspektif) : [];

                    $target = "sasaran_target_tahun_" . $tahun;
                    $content .= '
                    <tr>
                        <td>'.($offset+1).$input_id.'</td>
                        <td>'.$row->nama_sasaran_renstra.'</td>
                        <td>'.$row->nama_indikator_sasaran_renstra.'</td>
                        <td>'.$row->$target.'</td>
                        <td>'.$row->sasaran_satuan.'</td>
                        <td>
                            <select id="kinerja_utama_perspektif_'.$row->id_cascading.'" class="form-control_ kinerja_utama" multiple name="kinerja_utama[perspektif]['.$row->id_cascading.'][]">';
                            foreach($this->Config->perspektif as $k => $value){
                                $selected = ($dt_perspektif && in_array($value,$dt_perspektif)) ? "selected" : "";
                                $content .= '<option '.$selected.' value="'.$value.'">'.$value.'</option>';
                            }
                            
                        $content .='</select>';

                    $content .='
                            <div class="text-danger error" id="err_kinerja_utama_perspektif_'.$row->id_cascading.'"></div>
                        </td>
                    </tr>
                    ';

                }
                else{

                    $indikator_atasan = '';
                    $nama_indikator = '';
                    $kegiatan = '';
                    $rencana_hasil_kerja = ($id_skp && $row->rencana_hasil_kerja) ? $row->rencana_hasil_kerja : "";

                    $dt_aspek = ($id_skp && $row->aspek) ? explode(",",$row->aspek) : [];

                    if($row->flag=="kegiatan")
                    {
                        $indikator_atasan = $row->nama_indikator_sasaran_renstra;
                        $kegiatan = $row->nama_kegiatan;
                        $nama_indikator = $row->nama_indikator_kegiatan;
                        $target = "kegiatan_target_tahun_" . $tahun;
                        $satuan = "kegiatan_satuan";
                    }
                    if($row->flag=="sub_kegiatan")
                    {
                        $indikator_atasan = $row->nama_indikator_kegiatan;
                        $kegiatan = $row->nama_sub_kegiatan;
                        $nama_indikator = $row->nama_indikator_sub_kegiatan;
                        $target = "sub_kegiatan_target";
                        $satuan = "sub_kegiatan_satuan";
                    }

                    $content .= '
                    <tr>
                        <td>'.($offset+1).$input_id.'</td>
                        <td>'.$indikator_atasan.'</td>
                        <td>
                            <input value="'.$rencana_hasil_kerja.'" id="kinerja_utama_rencana_hasil_kerja_'.$row->id_cascading.'" type="text" class="form-control" placeholder="Rencana hasil kerja" name="kinerja_utama[rencana_hasil_kerja]['.$row->id_cascading.']" />
                            <div class="text-danger error" id="err_kinerja_utama_rencana_hasil_kerja_'.$row->id_cascading.'"></div>
                        </td>
                        
                        <td>
                            <select id="kinerja_utama_aspek_'.$row->id_cascading.'" class="form-control_ kinerja_utama" multiple name="kinerja_utama[aspek]['.$row->id_cascading.'][]">';
                            foreach($this->Config->aspek as $k => $value){
                                $selected = ($dt_aspek && in_array($value,$dt_aspek)) ? "selected" : "";
                                $content .= '<option '.$selected.' value="'.$value.'">'.$value.'</option>';
                            }
                            
                        $content .='</select>';

                    $content .='
                            <div class="text-danger error" id="err_kinerja_utama_aspek_'.$row->id_cascading.'"></div>
                        </td>
                        <td>'.$kegiatan.'</td>
                        <td>'.$nama_indikator.'</td>
                        <td>'.$row->$target.'</td>
                        <td>'.$row->$satuan.'</td>
                        
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