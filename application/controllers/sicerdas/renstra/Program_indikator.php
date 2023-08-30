
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Program_indikator extends CI_Controller
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


		

		$this->load->model("sicerdas/renstra/Program_indikator_model");
        $this->load->model("sicerdas/renstra/Program_model");
		$this->load->model("sicerdas/Globalvar");
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
                    
                    /* [
                        'field' => 'nama_indikator_program_renstra',
                        'label' => 'Nama indikator',
                        'rules' => 'required|regex_match[/^[a-z\d\-_\s\()\/\+\-.,"]+$/i]',
                        'errors' => [
                            'required' => '%s diperlukan',
                            'regex_match'   => '%s harus berupa huruf, angka, spasi, atau karakter lainya seperti ()/+-_',
                        ]
                    ], */
                    [
                        'field' => 'satuan',
                        'label' => 'Satuan',
                        'rules' => 'required',
                        'errors' => [
                            'required' => '%s diperlukan',
                        ]
                    ],
                    [
                        'field' => 'metode',
                        'label' => 'Metode perhitungan',
                        'rules' => 'required',
                        'errors' => [
                            'required' => '%s diperlukan',
                        ]
                    ],
                    [
                        'field' => 'target_awal',
                        'label' => 'Target awal',
                        'rules' => 'required',
                        'errors' => [
                            'required' => '%s diperlukan',
                        ]
                    ],
                    [
                        'field' => 'target_awal_rp',
                        'label' => 'Target awal',
                        'rules' => 'required',
                        'errors' => [
                            'required' => '%s diperlukan',
                        ]
                    ],
                    [
                        'field' => 'target_akhir',
                        'label' => 'Target akhir',
                        'rules' => 'required',
                        'errors' => [
                            'required' => '%s diperlukan',
                        ]
                    ],
                    [
                        'field' => 'target_akhir_rp',
                        'label' => 'Target akhir',
                        'rules' => 'required',
                        'errors' => [
                            'required' => '%s diperlukan',
                        ]
                    ],
                    [
                        'field' => 'id_program_renstra',
                        'label' => 'Program',
                        'rules' => 'required',
                        'errors' => [
                            'required' => '%s diperlukan',
                        ]
                    ],

                    [
                        'field' => 'id_indikator_sasaran',
                        'label' => 'Indikator sasaran',
                        'rules' => 'required',
                        'errors' => [
                            'required' => '%s diperlukan',
                        ]
                    ],

                    
                    [
                        'field' => 'id_indikator_program',
                        'label' => 'Indikator Program RPJMD',
                        'rules' => 'required',
                        'errors' => [
                            'required' => '%s diperlukan',
                        ]
                    ],
                    
                ];

                
                $dt_tahun = $this->Globalvar->get_tahun();

                foreach($dt_tahun as $key => $value)
                {
                    $validation_rules[] = [
                        'field' => 'target_tahun_'.($key+1),
                        'label' => 'Target tahun '.$value,
                        'rules' => 'required',
                        'errors' => [
                            'required' => '%s diperlukan',
                        ]
                    ];
                    $validation_rules[] = [
                        'field' => 'target_tahun_'.($key+1).'_rp',
                        'label' => 'Target tahun '.$value,
                        'rules' => 'required',
                        'errors' => [
                            'required' => '%s diperlukan',
                        ]
                    ];
                }
                

                $this->form_validation->set_rules( $validation_rules );
                
                if( $this->form_validation->run() )
                {

                    $id_indikator_program_renstra = $post_data['id_indikator'];
                    $id_program_renstra = $post_data['id_program_renstra'];
                    $dt = array(
                        'id_program_renstra'  => $post_data['id_program_renstra'],
                        'id_indikator_program_rpjmd'  => $post_data['id_indikator_program'],
                        'id_indikator_sasaran_renstra'  => $post_data['id_indikator_sasaran'],
                        //'nama_indikator_program_renstra'  => $post_data['nama_indikator_program_renstra'],
                        'satuan'    => $post_data['satuan'],
                        'metode'    => $post_data['metode'],
                        'target_awal'   => $post_data['target_awal'],
                        'target_awal_rp'   => $post_data['target_awal_rp'],
                        'target_akhir'  => $post_data['target_akhir'],
                        'target_akhir_rp'  => $post_data['target_akhir_rp'],
                        'lokasi'            => $this->input->post("lokasi"),
                        /* 'faktor_pendorong'            => $this->input->post("faktor_pendorong"),
                        'faktor_penghambat'            => $this->input->post("faktor_penghambat"),
                        'tindak_lanjut_rkpd'            => $this->input->post("tindak_lanjut_rkpd"),
                        'tindak_lanjut_rpjmd'            => $this->input->post("tindak_lanjut_rpjmd"), */
                    );

                    foreach($dt_tahun as $key => $value)
                    {
                        $dt['target_tahun_'.($key+1)] = $post_data['target_tahun_'.($key+1)];
                        $dt['target_tahun_'.($key+1).'_rp'] = $post_data['target_tahun_'.($key+1).'_rp'];
                    }
                    if($this->input->post("action")=="edit"){
                        $cekData = $this->db->where("id_indikator_program_renstra",$post_data['id_indikator'])->get("sc_renstra_program_indikator")->row();
                        if($cekData->id_indikator_program_rpjmd != $post_data['id_indikator_program'])
                        {
                            $cek = $this->db
                            ->where("id_program_renstra",$post_data['id_program_renstra'])
                            ->where("id_indikator_program_rpjmd",$post_data['id_indikator_program'])
                            ->get("sc_renstra_program_indikator")->row();

                            if($cek)
                            {
                                $data['status'] = false;
                                $data['message'] = "Indikator sudah ada";
                            }
                            else{
                                $this->Program_indikator_model->update($dt,$post_data['id_indikator']);
                                $data['message'] = "Indikator berhasil diubah";
                            }
                        }
                        else{
                            $this->Program_indikator_model->update($dt,$post_data['id_indikator']);
                            $data['message'] = "Indikator berhasil diubah.";
                        }
                    }
                    else if($this->input->post("action")=="add"){
                        $cek = $this->db
                        ->where("id_program_renstra",$post_data['id_program_renstra'])
                        ->where("id_indikator_program_rpjmd",$post_data['id_indikator_program'])
                        ->get("sc_renstra_program_indikator")->row();

                        if($cek)
                        {
                            $data['status'] = false;
                            $data['message'] = "Indikator sudah ada";
                        }
                        else{
                            $this->Program_indikator_model->insert($dt);
                            $id_indikator_program_renstra = $this->db->insert_id();
                            $data['message'] = "Indikator berhasil disimpan";
                        }
                    }
                    else{
                        $data['message'] = "Error";
                        $data['status'] = FALSE;
                    }

                    if($id_indikator_program_renstra && $data['status']==true) 
                    {

                        /* $this->db
                        ->where("id_indikator_program_renstra",$id_indikator_program_renstra)
                        ->where("flag","program")
                        ->delete("sc_cascading");
                        if($this->input->post("cascading"))
                        {
                            $param_detail['where']['renstra_program.id_program_renstra'] = $id_program_renstra;
                            $detail = $this->Program_model->get($param_detail)->row();
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
                                        ->set("id_program_renstra",$id_program_renstra)
                                        ->set("id_indikator_program_renstra",$id_indikator_program_renstra)
                                        ->set("id_pegawai",$row->id_pegawai)
                                        ->set("id_unit_kerja",$row->id_unit_kerja)
                                        ->set("flag","program")
                                        ->set("tahun",$tahun)
                                        ->set("tahun_desc",$tahun_desc)
                                        ->insert("sc_cascading");
                                    }
                                }
                            }
                        } */

                        // update cascading
                        $param_detail['where']['indikator.id_indikator_program_renstra'] = $id_indikator_program_renstra;
                        $detail = $this->Program_indikator_model->get($param_detail)->row();
                        if($detail)
                        {
                            $this->db
                            ->where("id_indikator_program_renstra",$id_indikator_program_renstra)   
                            ->set("id_indikator_sasaran_renstra",$detail->id_indikator_sasaran_renstra)
                            ->set("id_sasaran_renstra",$detail->id_sasaran_renstra)
                            ->update("sc_cascading");
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
        if ($this->user_level == "Administrator" OR in_array('sicerdas_renstra', $this->array_privileges)) {	}
		else{show_404();}
        
        if($this->input->is_ajax_request())
        {
            // Row per page
            $rowperpage = 10;
            $offset = ($rowno-1) * $rowperpage;

            $param = array();
            $param['limit']     = $rowperpage;
            $param['offset']    = $offset;
            
			$data = array();

			if($this->input->post("id_program_renstra"))
			{
				$param['where']['indikator.id_program_renstra'] = $this->input->post("id_program_renstra");
			}
            
           

            $result = $this->Program_indikator_model->get($param)->result();

            $tahun = '';
            $tahun_ = '';
            $dt_tahun = $this->Globalvar->get_tahun();
            foreach($dt_tahun as $key => $value)
            {
            	$tahun .= '<th colspan="2" style="text-align: center;vertical-align:middle">'.$value.'</th>';
                $tahun_ .= '<th>Target</th><th>Rp.</th>';
            }

			$content = '
			<thead>
				<tr style="">
                    <th rowspan="2" style="text-align: center;vertical-align:middle">#</th>
                    <th rowspan="2" style="text-align: center;vertical-align:middle">Indikator</th>
                    <th colspan="2" style="text-align: center;vertical-align:middle">Kondisi Awal</th>
                    '.$tahun.'
                    <th colspan="2" style="text-align: center;vertical-align:middle">Kondisi Awal</th>
                    <th rowspan="2" style="text-align: center;vertical-align:middle">Satuan</th>
                    <th rowspan="2" style="text-align: center;vertical-align:middle">Metode</th>
                    <th rowspan="2" style="text-align: center;vertical-align:middle">Opsi</th>
				</tr>

                <tr>
                    <th>Target</th><th>Rp.</th>
                    '.$tahun_.'
                    <th>Target</th><th>Rp.</th>
                </tr>

				</thead>
			<tbody>
			';
            foreach($result as $key=>$row)
            {
            	$row_tahun = '';
            	foreach($dt_tahun as $k => $value)
	            {
	            	$target_tahun = 'target_tahun_'.($k+1);
                    $target_tahun_rp = 'target_tahun_'.($k+1)."_rp";
	            	$row_tahun .= '<td align="center">'.$row->$target_tahun.'</td>';
                    $row_tahun .= '<td align="center">'.number_format($row->$target_tahun_rp).'</td>';
	            }

                /* $dt_unit_kerja = $this->Program_indikator_model->get_unit_kerja($row->id_indikator_program_renstra)->result();
                
                $unit_kerja = array();
                $ids_unit_kerja = array();
                foreach($dt_unit_kerja as $r)
                {
                    $unit_kerja[] = $r->nama_unit_kerja;
                    $ids_unit_kerja[] = $r->id_unit_kerja;
                }

                $nama_unit_kerja = implode("<br>", $unit_kerja);

                $result[$key]->unit_kerja = $dt_unit_kerja;
                $result[$key]->ids_unit_kerja = $ids_unit_kerja; */

                $param_cascading['where']['cascading.id_indikator_program_renstra'] = $row->id_indikator_program_renstra;
                $param_cascading['where']['cascading.flag'] = "program";
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
                     	<td>'.$row->nama_indikator_program_renstra.'</td>
                        <td>'.$row->target_awal.'</td>
                        <td>'.number_format($row->target_awal_rp).'</td>
                     	'.$row_tahun.'
                        <td>'.$row->target_akhir.'</td>
                        <td>'.number_format($row->target_akhir_rp).'</td>
                     	<td>'.$row->satuan_desc.'</td>
                        <td>'.$row->metode.'</td>
                     	<td align="center">
                     		<a href="javascript:void(0)" onclick="editIndikator('.$key.')" class="btn btn-info btn-circle"><i class="ti-pencil"></i></a>
							<a href="javascript:void(0)" onclick="hapusIndikator('.$row->id_indikator_program_renstra.')" class="btn btn-danger btn-circle"><i class="ti-trash"></i></a>
                     	</td>
                  	</tr>
				';
                $offset++;
            }

			if(!$result)
			{
				$content .= '<tr><td colspan="19" align="center">-Belum ada data-</td></tr>';
			}

			$content .= '</tbody>';

            unset($param['limit']);
            unset($param['offset']);
            $total_rows = $this->Program_indikator_model->get($param)->num_rows();


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
                
                $status = $this->Program_indikator_model->delete($this->input->post("id"));
                    
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
    public function get_indikator_by_sasaran()
    {
        $content = '<option value="">Pilih</option>';
        if($this->input->is_ajax_request() && $this->input->post("id_sasaran_renstra"))
        {
            $param['where']['indikator.id_sasaran_renstra'] = $this->input->post("id_sasaran_renstra");
            $dt = $this->Sasaran_indikator_model->get($param);
            foreach($dt->result() as $row)
            {
                $content .= '<option value="'.$row->id_indikator_sasaran_renstra.'">'.$row->nama_indikator_sasaran_renstra.'</option>';
            }           
        }
        $data['content'] = $content;
        echo json_encode($data);
    }

    public function get_indikator_by_program()
    {
        $content = '<option value="">Pilih</option>';
        if($this->input->is_ajax_request() && $this->input->post("id_program_renstra"))
        {
            $param['where']['indikator.id_program_renstra'] = $this->input->post("id_program_renstra");
            if($this->input->post("id_skpd"))
            {
                $param['id_skpd'] = $this->input->post("id_skpd");
            }
            $dt = $this->Program_indikator_model->get($param);
            foreach($dt->result() as $row)
            {
                $selected = ($row->id_indikator_program_renstra == $this->input->post("id_indikator_program_renstra"))  ? "selected" : "";
                $content .= '<option '.$selected.' value="'.$row->id_indikator_program_renstra.'">'.$row->nama_indikator_program_renstra.'</option>';
            }           
        }
        $data['post'] = $_POST;
        $data['content'] = $content;
        echo json_encode($data);
    }
}