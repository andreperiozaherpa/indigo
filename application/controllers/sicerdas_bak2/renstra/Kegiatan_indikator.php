
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kegiatan_indikator extends CI_Controller
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
		$array_privileges = explode(';', $this->user_privileges);


		if ($this->user_level == "Administrator" OR in_array('sicedas_renstra', $array_privileges)) {	}
		else{show_404();}

		$this->load->model("sicerdas/renstra/Kegiatan_indikator_model");
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
                        'field' => 'nama_indikator_kegiatan',
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
                        'field' => 'id_kegiatan',
                        'label' => 'Kegiatan',
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

                    $id_indikator_kegiatan = $post_data['id_indikator'];

                    $dt = array(
                        'id_kegiatan'  => $post_data['id_kegiatan'],
                        'nama_indikator_kegiatan'  => $post_data['nama_indikator_kegiatan'],
                        'satuan'    => $post_data['satuan'],
                        'target_awal'   => $post_data['target_awal'],
                        'target_awal_rp'   => $post_data['target_awal_rp'],
                        'target_akhir'  => $post_data['target_akhir'],
                        'target_akhir_rp'  => $post_data['target_akhir_rp'],
                        'lokasi'            => $this->input->post("lokasi"),
                    );

                    foreach($dt_tahun as $key => $value)
                    {
                        $dt['target_tahun_'.($key+1)] = $post_data['target_tahun_'.($key+1)];
                        $dt['target_tahun_'.($key+1).'_rp'] = $post_data['target_tahun_'.($key+1).'_rp'];
                    }
                    if($this->input->post("action")=="edit"){
                        $this->Kegiatan_indikator_model->update($dt,$post_data['id_indikator']);
                        $data['message'] = "Indikator berhasil diubah";
                    }
                    else if($this->input->post("action")=="add"){
                        $this->Kegiatan_indikator_model->insert($dt);
                        $id_indikator_kegiatan = $this->db->insert_id();
                        $data['message'] = "Indikator berhasil disimpan";


                    }
                    else{
                        $data['message'] = "Error";
                        $data['status'] = FALSE;
                    }

                    if($id_indikator_kegiatan)
                    {
                        $this->db->where("id_indikator_kegiatan",$id_indikator_kegiatan)->delete("sc_renstra_kegiatan_indikator_unit_kerja");
                        foreach($_POST['ids_unit_kerja'] as $key => $value)
                        {
                            $this->db
                            ->set("id_indikator_kegiatan",$id_indikator_kegiatan)
                            ->set("id_unit_kerja",$value)
                            ->insert("sc_renstra_kegiatan_indikator_unit_kerja");
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

			if($this->input->post("id_kegiatan"))
			{
				$param['where']['indikator.id_kegiatan'] = $this->input->post("id_kegiatan");
			}
            
           

            $result = $this->Kegiatan_indikator_model->get($param)->result();

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
                    <th rowspan="2" style="text-align: center;vertical-align:middle">Unit Kerja Penanggung Jawab</th>
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

                $dt_unit_kerja = $this->Kegiatan_indikator_model->get_unit_kerja($row->id_indikator_kegiatan)->result();
                
                $unit_kerja = array();
                $ids_unit_kerja = array();
                foreach($dt_unit_kerja as $r)
                {
                    $unit_kerja[] = $r->nama_unit_kerja;
                    $ids_unit_kerja[] = $r->id_unit_kerja;
                }

                $nama_unit_kerja = implode("<br>", $unit_kerja);

                $result[$key]->unit_kerja = $dt_unit_kerja;
                $result[$key]->ids_unit_kerja = $ids_unit_kerja;

                $content .= '
					<tr>
                     	<td>'.($key+1).'</td>
                     	<td>'.$row->nama_indikator_kegiatan.'</td>
                        <td>'.number_format($row->target_awal).'</td>
                        <td>'.number_format($row->target_awal_rp).'</td>
                     	'.$row_tahun.'
                        <td>'.number_format($row->target_akhir).'</td>
                        <td>'.number_format($row->target_akhir_rp).'</td>
                     	<td>'.$row->satuan_desc.'</td>
                        <td>'.$nama_unit_kerja.'</td>
                     	<td align="center">
                     		<a href="javascript:void(0)" onclick="editIndikator('.$key.')" class="btn btn-info btn-circle"><i class="ti-pencil"></i></a>
							<a href="javascript:void(0)" onclick="hapusIndikator('.$row->id_indikator_kegiatan.')" class="btn btn-danger btn-circle"><i class="ti-trash"></i></a>
                     	</td>
                  	</tr>
				';
            }

			if(!$result)
			{
				$content .= '<tr><td colspan="19" align="center">-Belum ada data-</td></tr>';
			}

			$content .= '</tbody>';

            unset($param['limit']);
            unset($param['offset']);
            $total_rows = $this->Kegiatan_indikator_model->get($param)->num_rows();


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
                
                $status = $this->Kegiatan_indikator_model->delete($this->input->post("id"));
                    
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