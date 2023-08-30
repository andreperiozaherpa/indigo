<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Perilaku extends CI_Controller
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

        $this->load->model("kinerja/Perilaku_model");
        $this->load->model("kinerja/Config");
        $this->load->model("sicerdas/Globalvar");
        $this->load->model("sicerdas/Pegawai_model");
        $this->load->model("kinerja/Skp_model");

        $this->pegawai = $this->Perilaku_model->getPegawai($this->user_id);

        $this->id_pegawai = $this->user_model->id_pegawai;

	}

    public function pegawai()
    {
        echo "<pre>";print_r($this->pegawai );
    }

    public function index()
    {
        $data['title']		    = 'Penilaian Perilaku | ' . $this->Config->app_name;
		$data['content']	    = "kinerja/perilaku/index";
		$data['user_picture']   = $this->user_picture;
		$data['full_name']		= $this->full_name;
		$data['user_level']		= $this->user_level;
        $data['plugins']        = ['select','sweetalert'];
        $data['active_menu']    = "perilaku";

        $this->load->view('admin/main', $data);
    }

    public function get_list($rowno=1)
    {
        if($this->input->is_ajax_request())
        {
            // Row per page
            $rowperpage = 10;
            $offset = ($rowno-1) * $rowperpage;

            $param = array();
            $param['limit']     = $rowperpage;
            $param['offset']    = $offset;
            
			$data = array();

            $bulan = $this->input->post("bulan");
            $tahun = $this->input->post("tahun");
            
            if($this->input->post("id_pegawai"))
            {
                $param['where']['skp.id_pegawai'] = $this->input->post("id_pegawai");
            }
            $param['where']['skp.tahun'] = $tahun;
            

            $ids_pegawai = array();
            $roles = array();
            $dt_pegawai = $this->pegawai['data']['semua'];
            foreach($dt_pegawai as $row)
            {
                $ids_pegawai[] = $row->id_pegawai;
                $roles[$row->id_pegawai] = $row->role;
            }

            $result = array();

            if($ids_pegawai)
            {
                $param['str_where'] = "(skp.id_pegawai in (".implode(",",$ids_pegawai).") )";
                $result = $this->Skp_model->get($param)->result();
            }


            if($this->id_pegawai)
            {
                $dt_perilaku_nilai = array();
                $param_nilai = array();

                $param_nilai['where']['perilaku_nilai.id_pegawai'] = $this->id_pegawai;
                $param_nilai['where']['perilaku_nilai.bulan'] = $bulan;
                $param_nilai['where']['perilaku_nilai.tahun'] = $tahun;
                $dt_nilai = $this->Perilaku_model->get_nilai($param_nilai)->result();
                foreach($dt_nilai as $row)
                {
                    $dt_perilaku_nilai[$row->id_skp][$row->tahun][$row->bulan] = $row->tanggal;
                }
            }

            //echo "<pre>";print_r($dt_perilaku_nilai);

			$content = '';
            foreach($result as $key=>$row)
            {
                $token = md5("SKP".$row->id_skp);
                $role  = $roles[$row->id_pegawai];
                $status = '<span class="text-danger">Belum dinilai</span>';
                $btn_action = '<a href="'.base_url().'kinerja/perilaku/kuisioner/'.$token.'?bulan='.$bulan.'&tahun='.$tahun.'" class="btn btn-default btn-sm btn-outline"><i class="fa fa-pencil"></i> Nilai</a>';
				$offset++;

                //echo "<pre>"; print_r($dt_perilaku_nilai[$row->id_skp][$row->tahun][12]);

                

                $status_penilaian = $this->Perilaku_model->status_penilaian($row->id_skp,$role,$row->id_user,$bulan, $tahun);
    
                if($status_penilaian == false)
                {
                    $btn_action = "";
                    $status = '-';
                }
                else{
                    if(!empty($dt_perilaku_nilai[$row->id_skp][$row->tahun][$bulan]))
                    {
                        $status = '<span class="text-success"><i class="ti ti-check"></i> Sudah dinilai</span>';
                        $btn_action = "";
                    }
                }


                $content .= '
				<tr>
					<td>'.$offset.'</td>
					<td>'.$row->nama_lengkap.'</td>
                    <td>'.$row->jabatan.'</td>
					<td>'.$role.'</td>
					<td>'.$status.'</td>
					<td>'.$btn_action.'</td>
				</tr>
				';

               
            }

			if(!$result)
			{
				$content = '<tr><td colspan="6" align="center">-Belum ada data-</td></tr>';
			}

            unset($param['limit']);
            unset($param['offset']);
            
            $total_rows = $this->Skp_model->get($param)->num_rows();


            $this->load->library('pagination');



            // Pagination Configuration
            $config['base_url'] = "";
            $config['use_page_numbers'] = TRUE;
            $config['total_rows'] = $total_rows;
            $config['per_page'] = $rowperpage;
            $config['attributes'] = array('class' => 'btn btn-default btn-outline btn-xm');

            $config = array_merge($config,$this->Config->pagination_config());
            
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

    public function get_pegawai()
    {
        $content = '<option value="">Semua</option>';
        if($this->input->is_ajax_request())
        {
            $dt_pegawai = $this->pegawai['data']['semua'];
            foreach($dt_pegawai as $row)
            {
                $content .= '<option value="'.$row->id_pegawai.'">['.$row->role.'] '.$row->nama_lengkap.' - '.$row->jabatan.'</option>';
            }           
        }
        $data['content'] = $content;
        echo json_encode($data);
    }

    public function kuisioner($token)
    {
        $data['title']		    = 'Kuisioner Penilaian Perilaku | ' . $this->Config->app_name;
		$data['content']	    = "kinerja/perilaku/kuisioner";
		$data['user_picture']   = $this->user_picture;
		$data['full_name']		= $this->full_name;
		$data['user_level']		= $this->user_level;
        $data['plugins']        = ['wizard','sweetalert'];
        $data['active_menu']    = "perilaku";

        $param['where']["md5(CONCAT('SKP',skp.id_skp))"] = $token;
        $detail = $this->Skp_model->get($param)->row();

        $tahun = $this->input->get("tahun");
        $bulan = $this->input->get("bulan");

        if(!$detail || !$token || !$tahun || !$bulan)
        {
            show_404();
        }

        $param_nilai = array();

        $param_nilai['where']['perilaku_nilai.id_skp'] = $detail->id_skp;
        $param_nilai['where']['perilaku_nilai.id_pegawai'] = $detail->id_pegawai;
        $param_nilai['where']['perilaku_nilai.bulan'] = $bulan;
        $param_nilai['where']['perilaku_nilai.tahun'] = $tahun;
        $dt_nilai = $this->Perilaku_model->get_nilai($param_nilai)->row();
        //echo "<pre>";print_r($param_nilai);die;
        if($dt_nilai)
        {
            show_404();
        }

        $dt_tahun = $this->Globalvar->get_tahun();

        $data['periode'] = date("M Y",strtotime($dt_tahun[($tahun-1)]."-".$bulan."-01"));


        $param_pegawai['where']['pegawai.id_pegawai'] = $detail->id_pegawai;
        $data['pegawai'] = $this->Pegawai_model->get($param_pegawai)->row();

        
        $data['token'] = $token;

        $this->load->view('admin/main', $data);
    }

    public function get_kuisioner()
    {   
        $content = '';
        if($this->input->is_ajax_request())
        {

            $dt_kuisioner = $this->Perilaku_model->get_kuisioner()->result();
            $data = array();
            foreach($dt_kuisioner as $row)
            {
                $data[$row->nama_perilaku][] = $row;
            }

            $tablist = "";
            $tab_content = "";
            $i = 1;
            $num = 1;
            foreach($data as $key => $value)
            {
                $active = ($i==1) ? "active" : "";
                $tablist .= '
                <li class="'.$active.'" role="tab">
                    <h4><span>'.$i.'</span>'.$key.'</h4>
                </li>';

                $pertanyaan = '<table width="100%" border="0" cellspacing="5">';

                foreach($value as $k => $row)
                {
                    $val = $row->kuisioner;
                    $pertanyaan .= '
                    <tr valign="top">
                        <td width="1%">'.$num.'.</td>
                        <td colspan="5">
                            '.$val.'
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td width="10%">
                            <div class="radio radio-primary">
                                <input type="radio" name="jawaban_'.$row->id_kuisioner.'" id="jawaban_5_'.$num.'" value="5">
                                <label for="jawaban_5_'.$num.'"> Sangat Baik</label>
                            </div>
                        </td>
                        <td width="10%">
                            <div class="radio radio-primary">
                                <input type="radio" name="jawaban_'.$row->id_kuisioner.'" id="jawaban_4_'.$num.'" value="4">
                                <label for="jawaban_4_'.$num.'"> Baik</label>
                            </div>
                        </td>
                        <td width="10%">
                            <div class="radio radio-primary">
                                <input type="radio" name="jawaban_'.$row->id_kuisioner.'" id="jawaban_3_'.$num.'" value="3">
                                <label for="jawaban_3_'.$num.'"> Cukup</label>
                            </div>
                        </td>
                        <td width="10%">
                            <div class="radio radio-primary">
                                <input type="radio" name="jawaban_'.$row->id_kuisioner.'" id="jawaban_2_'.$num.'" value="2">
                                <label for="jawaban_2_'.$num.'"> Kurang</label>
                            </div>
                        </td>
                        <td width="59%">
                            <div class="radio radio-primary">
                                <input type="radio" name="jawaban_'.$row->id_kuisioner.'" id="jawaban_1_'.$num.'" value="1">
                                <label for="jawaban_1_'.$num.'"> Sangat Kurang</label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="6">&nbsp;</td>
                    </tr>';
                    $num++;
                }
                $pertanyaan .= '</table>';

                $tab_content .= '
               
                <div class="wizard-pane '.$active.'" role="tabpanel">
                    '.$pertanyaan.'
                </div>';

                $i++;
                
            }

            $data['data'] = $data;

            $content = '
            <ul class="wizard-steps" role="tablist">
                '.$tablist.'
            </ul>
            <div class="wizard-content">
                '.$tab_content.'
            </div>';
        }
        $data['content'] = $content;
        echo json_encode($data);
    }

    public function submit_kuisioner()
    {
        $tahun = $this->input->post("tahun");
        $bulan = $this->input->post("bulan");
        $token = $this->input->post("token");

        $data['status'] = false;
        if($this->input->is_ajax_request() && $tahun && $bulan && $token)
        {

            $param['where']["md5(CONCAT('SKP',skp.id_skp))"] = $token;
            $detail = $this->Skp_model->get($param)->row();

            $cek = $this->db
            ->where("id_skp",$detail->id_skp)
            ->where("bulan",$bulan)
            ->where("id_pegawai",$this->id_pegawai)
            ->get("ekinerja_perilaku_nilai");

            if($cek->num_rows() == 0)
            {
                $role   = $this->Perilaku_model->get_role($this->id_pegawai, $detail->id_pegawai);
                $bobot  = $this->Perilaku_model->get_bobot($role,$detail->id_user);
                    
    
                $dt_nilai = array(
                    'id_skp'        => $detail->id_skp,
                    'bulan'         => $bulan,
                    'tahun'         => $tahun,
                    'id_pegawai'    => $this->id_pegawai,
                    'role'          => $role,
                    'bobot'         => $bobot,
                );
    
                $this->db->insert("ekinerja_perilaku_nilai",$dt_nilai);
                $id_nilai = $this->db->insert_id();
    
                $dt_kuisioner = $this->Perilaku_model->get_kuisioner();
    
                $nilai = 0;
                $total_rating = 0;
                foreach($dt_kuisioner->result() as $row)
                {
                    $jawaban = 'jawaban_'.$row->id_kuisioner;
    
                    $rating = 0;
    
                    if($this->input->post($jawaban))
                    {
                        $rating = $this->input->post($jawaban);   
                    }
    
                    $dt_nilai = array(
                        'id_nilai'      => $id_nilai,
                        'id_kuisioner'  => $row->id_kuisioner,
                        'rating'        => $rating
                    );
    
                    $this->db->insert("ekinerja_perilaku_nilai_detail",$dt_nilai);
    
                    $total_rating += $rating;
                }
    
                // update nilai
                $rata2rating = $total_rating / $dt_kuisioner->num_rows() ;
                $nilai = $rata2rating * $bobot; 
                $this->db->set("nilai",$nilai);
                $this->db->set("rata2rating",$rata2rating);
                $this->db->where("id_nilai",$id_nilai);
                $this->db->update("ekinerja_perilaku_nilai");
    
                //update rekap
                $this->Perilaku_model->updateRekap($detail->id_skp, $tahun, $bulan);
    
                $data['status'] = true;
                $data['message'] = "Jawaban berhasil dikirim. Terima kasih atasan partisipasi anda.";

            }
            else{
                $data['message'] = "Jawaban sudah ada";
            }

        }

        $data['post'] = $_POST;
        echo json_encode($data);
    }   
}