
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sasaran_indikator extends CI_Controller
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


		
		$this->load->model("sicerdas/renstra/Sasaran_indikator_model");
		$this->load->model("sicerdas/Globalvar");
        $this->load->model("sicerdas/Cascading_model");
        $this->load->model("sicerdas/Pegawai_model");
        $this->load->model("sicerdas/Skpd_model");
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
                        'field' => 'nama_indikator_sasaran_renstra',
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
                        'field' => 'id_sasaran',
                        'label' => 'Sasaran',
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
                }
                

                $this->form_validation->set_rules( $validation_rules );
                
                if( $this->form_validation->run() )
                {
					$dt = array(
						'id_sasaran_renstra'	=> $post_data['id_sasaran'],
						'nama_indikator_sasaran_renstra'	=> $post_data['nama_indikator_sasaran_renstra'],
						'satuan'	=> $post_data['satuan'],
						'target_awal'	=> $post_data['target_awal'],
						'target_akhir'	=> $post_data['target_akhir'],
					);

                    $id_indikator_sasaran_renstra = null;
                    $id_sasaran_renstra = $post_data['id_sasaran'];

					foreach($dt_tahun as $key => $value)
                	{
                		$dt['target_tahun_'.($key+1)] = $post_data['target_tahun_'.($key+1)];
                	}
					if($this->input->post("action")=="edit"){
						$this->Sasaran_indikator_model->update($dt,$post_data['id_indikator']);
						$data['message'] = "Indikator berhasil diubah";
                        $id_indikator_sasaran_renstra = $post_data['id_indikator'];
					}
					else if($this->input->post("action")=="add"){
						$this->Sasaran_indikator_model->insert($dt);
						$data['message'] = "Indikator berhasil disimpan";
                        $id_indikator_sasaran_renstra = $this->db->insert_id();
					}
					else{
						$data['message'] = "Error";
						$data['status'] = FALSE;
					}

                    if($id_indikator_sasaran_renstra && $id_sasaran_renstra)
                    {
                        $this->db
                        ->where("id_indikator_sasaran_renstra",$id_indikator_sasaran_renstra)
                        ->where("flag","sasaran")
                        ->delete("sc_cascading");

                        if($this->input->post("cascading"))
                        {
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
                                        ->set("id_sasaran_renstra",$id_sasaran_renstra)
                                        ->set("id_indikator_sasaran_renstra",$id_indikator_sasaran_renstra)
                                        ->set("id_pegawai",$row->id_pegawai)
                                        ->set("id_unit_kerja",$row->id_unit_kerja)
                                        ->set("tahun",$tahun)
                                        ->set("tahun_desc",$tahun_desc)
                                        ->set("flag","sasaran")
                                        ->insert("sc_cascading");
                                    }

                                }
                            }

                        }


                        // indikator sasaran otomatis cascading ke pimpinan
                        /* $cek = $this->db
                        ->where("id_indikator_sasaran_renstra",$id_indikator_sasaran_renstra)
                        ->where("flag","sasaran")
                        ->get("sc_cascading")->row();

                        $kepala = $this->Skpd_model->get_kepala($post_data['id_skpd']);

                        $dt_cascading = array(
                            "id_sasaran_renstra"            => $id_sasaran_renstra,
                            "id_indikator_sasaran_renstra"  => $id_indikator_sasaran_renstra,
                            "id_pegawai"                    => $kepala->id_pegawai,
                            "flag"                          => "sasaran"  
                        );

                        if($cek)
                        {
                            $this->db->where("id_cascading",$cek->id_cascading)->update("sc_cascading",$dt_cascading);
                        }
                        else{
                            $this->db->insert("sc_cascading",$dt_cascading);
                        } */
                    }
                }
                else{
                    $errors = $this->form_validation->error_array();
                    $data['status'] = FALSE;
                    $data['errors'] = $errors;
                    
                }
                $data['post'] = $_POST;
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

			if($this->input->post("id_sasaran"))
			{
				$param['where']['indikator.id_sasaran_renstra'] = $this->input->post("id_sasaran");
			}
            
           

            $result = $this->Sasaran_indikator_model->get($param)->result();

            $tahun = '';
            $dt_tahun = $this->Globalvar->get_tahun();
            foreach($dt_tahun as $key => $value)
            {
            	$tahun .= '<th style="text-align: center;vertical-align:middle">Target '.$value.'</th>';
            }

			$content = '
			<thead>
				<tr style="">
					<th style="text-align: center;vertical-align:middle">#</th>
					<th style="text-align: center;vertical-align:middle">Indikator</th>
                    <th style="text-align: center;vertical-align:middle">Kondisi Awal</th>
					'.$tahun.'
                    <th style="text-align: center;vertical-align:middle">Kondisi Akhir</th>
					<th style="text-align: center;vertical-align:middle">Satuan</th>
					<th style="text-align: center;vertical-align:middle" width="100px">Opsi</th>
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
	            	$row_tahun .= '<td align="center">'.$row->$target_tahun.'</td>';
	            }
                $param_cascading['where']['cascading.id_indikator_sasaran_renstra'] = $row->id_indikator_sasaran_renstra;
                $param_cascading['where']['cascading.flag'] = "sasaran";
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
                     	<td>'.$row->nama_indikator_sasaran_renstra.'</td>
                        <td>'.$row->target_awal.'</td>
                     	'.$row_tahun.'
                        <td>'.$row->target_akhir.'</td>
                     	<td>'.$row->satuan_desc.'</td>
                     	<td align="center">
                     		<a href="javascript:void(0)" onclick="editIndikator('.$key.')" class="btn btn-info btn-circle"><i class="ti-pencil"></i></a>
							<a href="javascript:void(0)" onclick="hapusIndikator('.$row->id_indikator_sasaran_renstra.')" class="btn btn-danger btn-circle"><i class="ti-trash"></i></a>
                     	</td>
                  	</tr>
				';
                $offset++;
            }

			if(!$result)
			{
				$content .= '<tr><td colspan="11" align="center">-Belum ada data-</td></tr>';
			}

			$content .= '</tbody>';

            unset($param['limit']);
            unset($param['offset']);
            $total_rows = $this->Sasaran_indikator_model->get($param)->num_rows();


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
                
                $status = $this->Sasaran_indikator_model->delete($this->input->post("id"));
                    
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
        $content = '';//'<option value="">Pilih</option>';
        if($this->input->is_ajax_request() && $this->input->post("id_sasaran_renstra"))
        {
            $param['where']['indikator.id_sasaran_renstra'] = $this->input->post("id_sasaran_renstra");
            $dt = $this->Sasaran_indikator_model->get($param);

            $id_indikator_sasaran_renstra = $this->input->post("id_indikator_sasaran_renstra");

            foreach($dt->result() as $row)
            {
                $selected = ($id_indikator_sasaran_renstra && in_array($row->id_indikator_sasaran_renstra,$id_indikator_sasaran_renstra) ) ? "selected" : "";
                $content .= '<option '.$selected.' value="'.$row->id_indikator_sasaran_renstra.'">'.$row->nama_indikator_sasaran_renstra.'</option>';
            }           
        }
        $data['content'] = $content;
        $data['post'] = $_POST;
        echo json_encode($data);
    }
}