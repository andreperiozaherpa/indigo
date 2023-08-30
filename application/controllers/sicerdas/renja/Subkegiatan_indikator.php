
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Subkegiatan_indikator extends CI_Controller
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


		if ($this->user_level == "Administrator" OR in_array('program', $this->array_privileges)) {	}
		else{show_404();}

		$this->load->model("sicerdas/renja/Sub_kegiatan_indikator_model");
		$this->load->model("sicerdas/Globalvar");
        $this->load->model("sicerdas/renja/Sub_kegiatan_model");
        $this->load->model("sicerdas/Pegawai_model");
        $this->load->model("sicerdas/Cascading_model");
	}

    public function save()
    {
        if($this->input->is_ajax_request()  )
        {
            if($_POST)
            {
                $data['status'] = true;
                $data['errors'] = array();
                $html_escape = html_escape($_POST);
                $post_data = array();
                foreach($html_escape as $key=>$value)
                {
                    $post_data[$key] = $this->security->xss_clean($value);
                }

                $this->load->library('form_validation');

                $this->form_validation->set_data( $post_data );

                
                $validation_rules = [
                    
                    [
                        'field' => 'nama_indikator_sub_kegiatan',
                        'label' => 'Nama indikator',
                        'rules' => 'required|regex_match[/^[a-z\d\-_\s\()\/\+\-.,"]+$/i]',
                        'errors' => [
                            'required' => '%s diperlukan',
                            'regex_match'   => '%s harus berupa huruf, angka, spasi, atau karakter lainya seperti ()/+-_',
                        ]
                    ],
                    [
                        'field' => 'satuan',
                        'label' => 'Satuan',
                        'rules' => 'required',
                        'errors' => [
                            'required' => '%s diperlukan',
                        ]
                    ],
                    [
                        'field' => 'target',
                        'label' => 'Target',
                        'rules' => 'required',
                        'errors' => [
                            'required' => '%s diperlukan',
                        ]
                    ],

                    /* [
                        'field' => 'target_anggaran',
                        'label' => 'Target anggaran',
                        'rules' => 'required',
                        'errors' => [
                            'required' => '%s diperlukan',
                        ]
                    ], */

                    
                ];

                if($this->input->post("action")=="add")
                {
                    $validation_rules[] =  
                    [
                        'field' => 'metode',
                        'label' => 'Metode perhitungan',
                        'rules' => 'required',
                        'errors' => [
                            'required' => '%s diperlukan',
                        ]
                    ];
                    if($this->input->post("metode")=="Minimize")
                    {
                        $validation_rules[] =  [
                            'field' => 'target_min',
                            'label' => 'Target minimum',
                            'rules' => 'required',
                            'errors' => [
                                'required' => '%s diperlukan',
                            ]
                        ];
                        $validation_rules[] =  [
                            'field' => 'target_anggaran_min',
                            'label' => 'Target minimum anggaran',
                            'rules' => 'required',
                            'errors' => [
                                'required' => '%s diperlukan',
                            ]
                        ];
                    }
                }


                

                

                $this->form_validation->set_rules( $validation_rules );
                
                if( $this->form_validation->run() )
                {

                    $id_sub_kegiatan_renja = $post_data['id_sub_kegiatan_renja'];
                    
                    $dt = array(
                        'id_sub_kegiatan_renja'  => $post_data['id_sub_kegiatan_renja'],
                        'nama_indikator_sub_kegiatan'  => $post_data['nama_indikator_sub_kegiatan'],
                        'satuan'    => $post_data['satuan'],
                        'target'   => $post_data['target'],
                        //'target_anggaran'   => $post_data['target_anggaran'],
                        //'pagu_indikatif'            => $this->input->post("pagu_indikatif"),
                        //'pagu_prakiraan_maju'            => $this->input->post("pagu_prakiraan_maju"),
                        'lokasi_kegiatan'            => $this->input->post("lokasi_kegiatan"),
                        'metode'            => $this->input->post("metode"),
                        'target_min'            => $this->input->post("target_min"),
                        'target_anggaran_min'            => $this->input->post("target_anggaran_min"),
                    );

                    if($this->input->post("month"))
                    {
                        foreach($_POST['month'] as $key => $value)
                        {
                            $dt['month_'.$key] = $value;
                        }
                    }
                    $id_sub_kegiatan_indikator = null;
                    if($this->input->post("action")=="edit"){
                        $this->Sub_kegiatan_indikator_model->update($dt,$post_data['id_indikator_sub_kegiatan']);
                        $data['message'] = "Indikator berhasil diubah";
                        $id_sub_kegiatan_indikator = $post_data['id_indikator_sub_kegiatan'];

                        // update capaian 
                        $this->load->model("sicerdas/renja/Renaksi_model");
                        $param['where']['renaksi.id_indikator_sub_kegiatan'] = $post_data['id_indikator_sub_kegiatan'];
                        $dt_renaksi = $this->Renaksi_model->get_detail($param)->result();
                        foreach($dt_renaksi as $detail)
                        {
                            $capaian = $this->Renaksi_model->hitung_capaian($detail->target_renaksi, $detail->realisasi, $detail->metode, $detail->target_min);
                            $capaian_anggaran = $this->Renaksi_model->hitung_capaian($detail->target_anggaran, $detail->realisasi_anggaran, $detail->metode, $detail->target_anggaran_min);
                            
                            $update = array(
                                'capaian_anggaran' => $capaian_anggaran,
                                'capaian'   => $capaian
                            );
                            $this->db
                            ->where("id_renaksi_detail",$detail->id_renaksi_detail)
                            ->update("sc_renaksi_detail",$update);
                        }
                    }
                    else if($this->input->post("action")=="add"){
                        $this->Sub_kegiatan_indikator_model->insert($dt);
                        $data['message'] = "Indikator berhasil disimpan";
                        $id_sub_kegiatan_indikator = $this->db->insert_id();
                    }
                    else{
                        $data['message'] = "Error";
                        $data['status'] = FALSE;
                    }

                    if($id_sub_kegiatan_indikator)
                    {
                        
                        $param_detail['where']['renja_sub_kegiatan.id_sub_kegiatan_renja'] = $id_sub_kegiatan_renja;
                        $detail = $this->Sub_kegiatan_model->get($param_detail)->row();

                        $this->db
                        ->where("id_sub_kegiatan_indikator",$id_sub_kegiatan_indikator)
                        ->where("flag","sub_kegiatan")
                        ->where("id_sasaran_renstra",$detail->id_sasaran_renstra)
                        ->where("id_program_renstra",$detail->id_program_renstra)
                        ->where("id_indikator_program_renstra",$detail->id_indikator_program_renstra)
                        ->where("id_kegiatan",$detail->id_kegiatan)
                        ->where("id_kegiatan_indikator",$detail->id_indikator_kegiatan)
                        ->where("id_sub_kegiatan_renja",$id_sub_kegiatan_renja)        
                        ->delete("sc_cascading");

                        if($this->input->post("cascading"))
                        {
                            $dt_tahun = $this->Globalvar->get_tahun();

                            foreach($this->input->post("cascading") as $tahun => $ids_pegawai)
                            {
                                if($ids_pegawai)
                                {
                                    $param_pegawai['str_where'] = "(pegawai.id_pegawai in (".implode(",",$ids_pegawai).") )";
                                    $dt_pegawai = $this->Pegawai_model->get($param_pegawai)->result();                                    
                                    
                                    $tahun_ = $tahun - 1;
                                    $tahun_desc = $dt_tahun[$tahun_];

                                    foreach($dt_pegawai as $row)
                                    {
                                        $this->db
                                        ->set("id_sasaran_renstra",$detail->id_sasaran_renstra)
                                        ->set("id_program_renstra",$detail->id_program_renstra)
                                        ->set("id_indikator_program_renstra",$detail->id_indikator_program_renstra)
                                        ->set("id_kegiatan",$detail->id_kegiatan)
                                        ->set("id_kegiatan_indikator",$detail->id_indikator_kegiatan)
                                        ->set("id_sub_kegiatan_renja",$id_sub_kegiatan_renja)
                                        ->set("id_sub_kegiatan_indikator",$id_sub_kegiatan_indikator)
                                        ->set("id_pegawai",$row->id_pegawai)
                                        ->set("id_unit_kerja",$row->id_unit_kerja)
                                        ->set("flag","sub_kegiatan")
                                        ->set("tahun",$tahun)
                                        ->set("tahun_desc",$tahun_desc)
                                        ->insert("sc_cascading");
                                    }
                                }
                            }
                        }
                    }
                }
                else{
                    $errors = $this->form_validation->error_array();
                    $data['status'] = FALSE;
                    $data['errors'] = $errors;
                    $data['post'] = $_POST;
                }
                echo json_encode($data);
            }           
        }   
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

			if($this->input->post("id_sub_kegiatan_renja"))
			{
				$param['where']['indikator.id_sub_kegiatan_renja'] = $this->input->post("id_sub_kegiatan_renja");
			}
            
           

            $result = $this->Sub_kegiatan_indikator_model->get($param)->result();

            $content = '';
            foreach($result as $key=>$row)
            {
                $month = array();
                for($i=1;$i<=12;$i++)
                {
                    $month_x = "month_".$i;
                    $month[$i] = ($row->$month_x == "Y") ? '<td align="center" style="background:green;color:white">v</td>' : '<td align="center">-</td>';
                }
            	
                $token = md5("SKI".$row->id_indikator_sub_kegiatan);

                $param_cascading['where']['cascading.id_sub_kegiatan_indikator'] = $row->id_indikator_sub_kegiatan;
                $param_cascading['where']['cascading.flag'] = "sub_kegiatan";
                $dt_cascading = $this->Cascading_model->get($param_cascading)->result();
                $cascading = array();
                foreach($dt_cascading as $cas)
                {
                    $cascading[$cas->tahun][] = $cas->id_pegawai;
                }
                $result[$key]->cascading = $cascading;

                $content .= '
					<tr>
                     	<td>'.($offset+1).'</td>
                     	<td>'.$row->nama_indikator_sub_kegiatan.'</td>
                        <td>'.number_format($row->target).'</td>
                     	<td>'.$row->satuan_desc.'</td>
                        '.implode("",$month).'
                        <!--<td align="center"><a href="'.base_url().'sicerdas/renja/renaksi/detail/'.$token.'"><button class="btn btn-outline btn-primary">Renaksi</button></td>-->
                     	<td align="center">
                     		<a href="javascript:void(0)" onclick="editIndikator('.$key.')" class="btn btn-info btn-circle"><i class="ti-pencil"></i></a>
							<a href="javascript:void(0)" onclick="hapusIndikator('.$row->id_indikator_sub_kegiatan.')" class="btn btn-danger btn-circle"><i class="ti-trash"></i></a>
                     	</td>
                  	</tr>
				';
                $offset++;
            }

			if(!$result)
			{
				$content .= '<tr><td colspan="18" align="center">-Belum ada data-</td></tr>';
			}

		

            unset($param['limit']);
            unset($param['offset']);
            $total_rows = $this->Sub_kegiatan_indikator_model->get($param)->num_rows();


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

    public function delete()
    {
        if($this->input->is_ajax_request())
        {
            if($_POST)
            {
                $data['status'] = true;
                
                $status = $this->Sub_kegiatan_indikator_model->delete($this->input->post("id"));
                    
                    if($status){
                        $data['message'] = "Indikator berhasil dihapus";
                        
                    }
                    else{
                        $data['status'] = FALSE;
                        $data['message'] = "Gagal menghapus indikator";
                    }
                
                echo json_encode($data);
            }           
        }
    }
    
}