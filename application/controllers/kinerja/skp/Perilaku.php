<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Perilaku extends CI_Controller
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

        $this->load->model("kinerja/Perilaku_model");
        $this->load->model("kinerja/Skp_model");

        $param_pegawai['where']['pegawai.id_user'] =  $this->session->id_user;

        $dt_pegawai = $this->Pegawai_model->get($param_pegawai)->row();

        $this->role_pimpinan = ($dt_pegawai && $dt_pegawai->kepala_skpd == "Y" && in_array($dt_pegawai->jenis_skpd,['skpd','kecamatan']));


        $this->pegawai = $dt_pegawai;

	}

    public function get_data()
    {   
        $id_skp = $this->input->post("id_skp");
        if($this->input->is_ajax_request())
        {
            $offset = 0;
            
            if($id_skp)
            {
                $param['where']['perilaku.id_skp'] = $id_skp;
                $result = $this->Perilaku_model->get($param)->result();
            }
            else{
                $result = $this->db->get("ekinerja_ref_perilaku")->result();
            }

            $content = '';
            foreach($result as $row)
            {
                $ekspektasi = ($id_skp && $row->ekspektasi) ? $row->ekspektasi : "";   

                $id_perilaku = ($id_skp && $row->id_perilaku) ? $row->id_perilaku : 0;
                $input_id = '<input type="hidden" value="'.$id_perilaku.'" id="perilaku_id_perilaku'.$row->id_ref_perilaku.'" name="perilaku[id_perilaku]['.$row->id_ref_perilaku.']" />';

                $content .= '
                    <tr>
                        <td>'.($offset+1).'</td>
                        <td>'.$row->nama_perilaku.'</td>
                        <td width="300px">
                            '.$input_id.'
                            <input type="text" class="form-control" name="perilaku[ekspektasi]['.$row->id_ref_perilaku.']"
                            placeholder="Ekspektasi Khusus Pimpinan/Leader" value="'.$ekspektasi.'" />
                        </td>
                    </tr>
                ';

                $offset++;
            }

            
            $data['result']     = $result;
            $data['content'] 	= $content;
            echo json_encode($data);


        }
    }
    
}