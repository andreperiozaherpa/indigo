
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


		

		$this->load->model("sicerdas/rpjmd/Program_indikator_model");
		$this->load->model("sicerdas/Globalvar");
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
                        'field' => 'nama_indikator_program_rpjmd',
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
                        'field' => 'target_awal',
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
                        'field' => 'id_program_rpjmd',
                        'label' => 'Program',
                        'rules' => 'required',
                        'errors' => [
                            'required' => '%s diperlukan',
                        ]
                    ],
                    [
                        'field' => 'ids_skpd',
                        'label' => 'SKPD',
                        'rules' => 'required',
                        'errors' => [
                            'required' => '%s diperlukan',
                        ]
                    ],
                    
                ];

                $sumber_pagu = $this->input->post("sumber_pagu");
                
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
                    if(!$sumber_pagu)
                    {
                        $validation_rules[] = [
                            'field' => 'target_tahun_'.($key+1).'_rp',
                            'label' => 'Target tahun '.$value,
                            'rules' => 'required',
                            'errors' => [
                                'required' => '%s diperlukan',
                            ]
                        ];
                    }
                }

                if(!$sumber_pagu)
                {
                    $validation_rules[] = [
                        'field' => 'target_awal_rp',
                        'label' => 'Target awal',
                        'rules' => 'required',
                        'errors' => [
                            'required' => '%s diperlukan',
                        ]
                    ];
                    $validation_rules[] = [
                        'field' => 'target_akhir_rp',
                        'label' => 'Target akhir',
                        'rules' => 'required',
                        'errors' => [
                            'required' => '%s diperlukan',
                        ]
                    ];
                }
                

                $this->form_validation->set_rules( $validation_rules );
                
                if( $this->form_validation->run() )
                {

                    $id_indikator_program_rpjmd = $post_data['id_indikator'];
                    
					$dt = array(
						'id_program_rpjmd'	=> $post_data['id_program_rpjmd'],
						'nama_indikator_program_rpjmd'	=> $post_data['nama_indikator_program_rpjmd'],
						'satuan'	=> $post_data['satuan'],
						'target_awal'	=> $post_data['target_awal'],
                        'target_awal_rp'   => ($sumber_pagu) ? 0 : $post_data['target_awal_rp'],
						'target_akhir'	=> $post_data['target_akhir'],
                        'target_akhir_rp'  => ($sumber_pagu) ? 0 : $post_data['target_akhir_rp'],
                        'sumber_pagu'       => $sumber_pagu
					);

					foreach($dt_tahun as $key => $value)
                	{
                		$dt['target_tahun_'.($key+1)] = $post_data['target_tahun_'.($key+1)];
                        $dt['target_tahun_'.($key+1).'_rp'] = ($sumber_pagu) ? 0 : $post_data['target_tahun_'.($key+1).'_rp'];
                	}
					if($this->input->post("action")=="edit"){

                        if($sumber_pagu)
                        {
                            $dt['group_pagu'] = $sumber_pagu;
                        }
                        else{
                            $dt['group_pagu'] = $post_data['id_indikator'];
                        }
                        
						$this->Program_indikator_model->update($dt,$post_data['id_indikator']);
						$data['message'] = "Indikator berhasil diubah";
					}
					else if($this->input->post("action")=="add"){
						$this->Program_indikator_model->insert($dt);
                        $id_indikator_program_rpjmd = $this->db->insert_id();
						$data['message'] = "Indikator berhasil disimpan";

                        if(!$sumber_pagu)
                        {
                            $dt= array(
                                'group_pagu' => $id_indikator_program_rpjmd
                            );
                            $this->Program_indikator_model->update($dt,$id_indikator_program_rpjmd);
                        }
					}
					else{
						$data['message'] = "Error";
						$data['status'] = FALSE;
					}

                    if($id_indikator_program_rpjmd)
                    {
                        $this->db->where("id_indikator_program_rpjmd",$id_indikator_program_rpjmd)->delete("sc_rpjmd_program_indikator_skpd");
                        $ids_skpd = explode(",", $post_data['ids_skpd']);
                        foreach($ids_skpd as $key => $value)
                        {
                            $this->db
                            ->set("id_indikator_program_rpjmd",$id_indikator_program_rpjmd)
                            ->set("id_skpd",$value)
                            ->insert("sc_rpjmd_program_indikator_skpd");
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
        if ($this->user_level == "Administrator" OR in_array('sicerdas_rpjmd', $this->array_privileges)) {	}
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

			if($this->input->post("id_program_rpjmd"))
			{
				$param['where']['indikator.id_program_rpjmd'] = $this->input->post("id_program_rpjmd");
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
                    '.$tahun.'
                    <th rowspan="2" style="text-align: center;vertical-align:middle">Satuan</th>
                    <th rowspan="2" style="text-align: center;vertical-align:middle">SKPD Penanggung Jawab</th>
                    <th rowspan="2" style="text-align: center;vertical-align:middle">Opsi</th>
				</tr>

                <tr>
                    '.$tahun_.'
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
                    

                    $rowspan = "";
                    if(!$row->sumber_pagu)
                    {
                        $jml_row = $this->db->where("group_pagu",$row->id_indikator_program_rpjmd)->get("sc_rpjmd_program_indikator")->num_rows();
                        if($jml_row>1)
                        {
                            $rowspan = 'rowspan="'.$jml_row.'"';
                        }
                        $row_tahun .= '<td align="center" '.$rowspan.'>'.number_format($row->$target_tahun_rp).'</td>';
                    }
	            }

                $dt_skpd = $this->Program_indikator_model->get_skpd($row->id_indikator_program_rpjmd)->result();
                
                $skpd = array();
                $ids_skpd = array();
                foreach($dt_skpd as $r)
                {
                    $skpd[] = $r->nama_skpd;
                    $ids_skpd[] = $r->id_skpd;
                }

                $nama_skpd = implode("<br>", $skpd);

                $result[$key]->skpd = $dt_skpd;
                $result[$key]->ids_skpd = $ids_skpd;

                $content .= '
					<tr>
                     	<td>'.($offset+1).'</td>
                     	<td>'.$row->nama_indikator_program_rpjmd.'</td>
                     	'.$row_tahun.'
                     	<td>'.$row->satuan_desc.'</td>
                        <td>'.$nama_skpd.'</td>
                     	<td align="center">
                     		<a href="javascript:void(0)" onclick="editIndikator('.$key.')" class="btn btn-info btn-circle"><i class="ti-pencil"></i></a>
							<a href="javascript:void(0)" onclick="hapusIndikator('.$row->id_indikator_program_rpjmd.')" class="btn btn-danger btn-circle"><i class="ti-trash"></i></a>
                     	</td>
                  	</tr>
				';
                $offset++;
            }

			if(!$result)
			{
				$content .= '<tr><td colspan="15" align="center">-Belum ada data-</td></tr>';
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
        if($this->input->is_ajax_request() && $this->input->post("id_sasaran_rpjmd"))
        {
            $param['where']['indikator.id_sasaran_rpjmd'] = $this->input->post("id_sasaran_rpjmd");
            $dt = $this->Sasaran_indikator_model->get($param);
            foreach($dt->result() as $row)
            {
                $content .= '<option value="'.$row->id_indikator_sasaran_rpjmd.'">'.$row->nama_indikator_sasaran_rpjmd.'</option>';
            }           
        }
        $data['content'] = $content;
        echo json_encode($data);
    }

    public function get_indikator_by_program()
    {
        $content = '';// '<option value="">Pilih</option>';
        if($this->input->is_ajax_request() && $this->input->post("id_program_rpjmd"))
        {
            $param['where']['indikator.id_program_rpjmd'] = $this->input->post("id_program_rpjmd");
            if($this->input->post("id_skpd"))
            {
                $param['id_skpd'] = $this->input->post("id_skpd");
            }
            $dt = $this->Program_indikator_model->get($param);

            $id_indikator_program_rpjmd = $this->input->post("id_indikator_program_rpjmd");

            foreach($dt->result() as $row)
            {
                $selected = ($id_indikator_program_rpjmd && in_array($row->id_indikator_program_rpjmd,$id_indikator_program_rpjmd) ) ? "selected" : "";
                $content .= '<option '.$selected.' value="'.$row->id_indikator_program_rpjmd.'">'.$row->nama_indikator_program_rpjmd.'</option>';
            }           
        }
        $data['content'] = $content;
        echo json_encode($data);
    }
}