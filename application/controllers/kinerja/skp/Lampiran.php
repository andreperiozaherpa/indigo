<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Lampiran extends CI_Controller
{
	public $user_id;

	public function __construct()
	{
		parent::__construct();
		$this->user_id = $this->session->userdata('user_id');

		if (!$this->user_id) {
            redirect('admin');
        }
        
        $this->load->model("kinerja/Lampiran_model");
        $this->load->model("kinerja/Skp_model");
        $this->load->model("kinerja/Config");
	}

    


    public function get_data()
    {
        $id_skp = $this->input->post("id_skp");
        if($this->input->is_ajax_request())
        {
            $content = [];
            $dt_jenis_lampiran = $this->Config->jenis_lampiran;
            $dt_lampiran = [];
            if($id_skp)
            {
                $param['where']['lampiran.id_skp'] = $id_skp;
                $result = $this->Lampiran_model->get($param)->result();

                foreach($result as $key=>$row)
                {
                    $id = array_search($row->jenis,$dt_jenis_lampiran);
                    $dt_lampiran[$id][] = $row;
                }
                //$data['result'] = $result;

                foreach($dt_lampiran as $key => $lampiran)
                {
                    $content_ = '';
                    
                    foreach($lampiran as $k=>$r)
                    {
                        $id_lampiran = ($id_skp && $r->id_lampiran) ? $r->id_lampiran : 0;
                        $input_id = '<input type="hidden" value="'.$id_lampiran.'" id="lampiran_id_lampiran'.$key.'_'.$k.'" name="lampiran[id_lampiran]['.$key.']['.$k.']" />';


                        $content_ .= '
                            <tr id="row-lampiran-'.$key.'_'.$k.'">
                                <td>
                                    '.$input_id.'
                                    <textarea class="form-control" name="lampiran[nama_lampiran]['.$key.']['.$k.']">'.$r->nama_lampiran.'</textarea>
                                </td>
                                <td>
                                    <div class="btn-group m-b-20">
                                        <a onclick="delete_lampiran('.$key.','.$k.')" type="button" class="btn btn-sm_ btn-default btn-outline waves-effect"><i class="fa fa-trash"></i></a>
                                    </div>
                                </td>
                            </tr>
                        ';
                    }
                    $content[$key] = $content_;
                }
            }
            else{
                foreach($dt_jenis_lampiran as $key => $jenis_lampiran){
                    $content[$key] = '
                            <tr id="row-lampiran-'.$key.'_0">
                                <td>
                                    <input type="hidden" value="0" id="lampiran_id_lampiran'.$key.'_0" name="lampiran[id_lampiran]['.$key.'][0]" />
                                    <textarea class="form-control" name="lampiran[nama_lampiran]['.$key.'][0]"></textarea>
                                </td>
                                <td>
                                    <div class="btn-group m-b-20">
                                        <a onclick="delete_lampiran('.$key.',0)" type="button" class="btn btn-sm_ btn-default btn-outline waves-effect"><i class="fa fa-trash"></i></a>
                                    </div>
                                </td>
                            </tr>';
                }
            }


            
            $data['content'] 	= $content;
            $data['dt_lampiran'] = $dt_lampiran;
            echo json_encode($data);


        }
    }


    
}