<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tujuan extends CI_Controller
{
	public $user_id;

	public function __construct()
	{
		parent::__construct();
        $this->user_id = $this->session->userdata('user_id');
        if (!$this->user_id) {
            redirect('admin');
        }

		$this->load->model("sicerdas/rpjmd/Misi_model");
        $this->load->model("sicerdas/rpjmd/Tujuan_model");
        $this->load->model("sicerdas/rpjmd/Tujuan_indikator_model");
    }

    public function get()
    {
        if($this->input->is_ajax_request())
        {
            $data = array();

			$dt_misi = $this->Misi_model->get();
            $result = $dt_misi;
            $content = '';
            foreach($dt_misi as $key => $misi)
            {
                $m = $key+1;

                $tujuan = '';
                $param_tujuan['where']['tujuan.id_misi'] = $misi->id_misi;
                $dt_tujuan = $this->Tujuan_model->get($param_tujuan);
                if($dt_tujuan->num_rows()==0)
                {
                    $tujuan = '<div style="margin-top:10px" class=" alert alert-warning" > Belum ada tujuan, silakan buatkan tujuan dari Misi di atas. </div>';
                }
                else{
                    $result[$key]->tujuan = $dt_tujuan->result();
                    foreach($dt_tujuan->result() as $k => $row){
                        $t = $k+1;

                        $param_indikator['where']['indikator.id_tujuan'] = $row->id_tujuan;
                        $dt_indikator = $this->Tujuan_indikator_model->get($param_indikator);

                        $indikator = '';
                        if($dt_indikator->num_rows()==0)
                        {
                            $indikator = '
                                <tr>
                                    <td colspan="3" align="center">-Belum ada indikator-</td>
                                </tr>
                            ';   
                        }
                        else{
                            $result[$key]->tujuan[$k]->indikator = $dt_indikator->result();
                            foreach($dt_indikator->result() as $y => $ind)
                            {
                                $indikator .= '
                                <tr>
                                    <td align="center">'.($y+1).'.</td>
                                    <td>'.$ind->nama_indikator_tujuan.'</td>
                                    <td style="width:150px">
                                        <a href="javascript:void(0)" onclick="edit_indikator('.$key.','.$k.','.$y.')" class="btn btn-warning btn-sm btn-outline btn-circle"><i class="fa fa-pencil"></i> </a> 
                                        <a href="javascript:void(0)" onclick="delete_indikator('.$ind->id_indikator_tujuan.')" class="btn btn-danger btn-circle btn-sm btn-outline "><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>   
                                ';
                            }
                        }

                        $tujuan .= '
                        <div class="row" style="margin-top:10px">
                            <div class="col-md-12 p-b-20" style="background:#f4f4f4">
                                <div style="margin-top:10px">
                                    <div class="btn-group m-r-10">
                                        <button aria-expanded="false" data-toggle="dropdown" class="btn btn-default btn-outline dropdown-toggle waves-effect waves-light" type="button"> <i class="fa fa-gear m-r-5"></i> <span class="caret"></span></button>
                                        <ul role="menu" class="dropdown-menu">
                                            <li><a href="javascript:void(0)" onclick="edit_tujuan('.$key.','.$k.');">Edit</a></li>
                                            <li>
                                                <a href="javascript:void(0)"  title="" onclick="delete_tujuan('.$row->id_tujuan.')" data-toggle="tooltip" data-original-title=""> Hapus </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <strong>Tujuan '.$t.'.</strong> '.$row->tujuan.'
                                </div>  
                
                                <div style="background: #fff;margin-top:10px">
                                    <table class="table color-table muted-table" >
                                        <thead>
                                            <tr>
                                                <th width="50px">No.</th>
                                                <th>Indikator</th>
                                                <th>Opsi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            '.$indikator.'
                                        </tbody>
                                    </table>
                                    <div class="col-md-12 text-right">
                                        <button type="button" class="btn btn-success btn-outline full-right" onclick="add_indikator('.$key.','.$k.');"><i class="fa fa-plus"></i> Tambah Indikator</button>
                                    </div>
                                </div>  
                            </div>
                        </div>
                        <hr>
                        ';
                    }
                }
                
               
                $content .= '
                <div class="panel-body">
                    <b>Misi '.$m.'.</b> '.$misi->misi.'<hr> 
                    <div class="row">
                        <div class="col-md-12">
                            <button type="button" class="btn btn-primary btn-outline" onclick="add_tujuan('.$key.');"><i class="fa fa-plus"></i> Tambah Tujuan Misi '.$m.'</button>
                        </div>
                    </div>
                    '.$tujuan.'
                </div>
                ';

                
            }

            $data['content'] = $content;
            $data['result'] = $result;

            echo json_encode($data);

        }
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
                        'field' => 'tujuan',
                        'label' => 'Tujuan',
                        'rules' => 'required|regex_match[/^[a-z\d\-_\s\()\/\+\-.,"]+$/i]',
                        'errors' => [
                            'required' => '%s diperlukan',
                            'regex_match'   => '%s harus berupa huruf, angka, spasi, atau karakter lainya seperti ()/+-_',
                        ]
                    ],
                    [
                        'field' => 'id_misi',
                        'label' => 'Misi',
                        'rules' => 'required',
                        'errors' => [
                            'required' => '%s diperlukan',
                        ]
                    ],
                    
                ];
                

                $this->form_validation->set_rules( $validation_rules );
                
                if( $this->form_validation->run() )
                {
					$dt = array(
						'tujuan'	=> $post_data['tujuan'],
						'id_misi'	=> $post_data['id_misi'],
					);
					if($this->input->post("action")=="edit"){
						$this->Tujuan_model->update($dt,$post_data['id_tujuan']);
						$data['message'] = "Tujuan berhasil diubah";
					}
					else if($this->input->post("action")=="add"){
						$this->Tujuan_model->insert($dt);
						$data['message'] = "Tujuan berhasil disimpan";
					}
					else{
						$data['message'] = "Error";
						$data['status'] = FALSE;
					}
                }
                else{
                    $errors = $this->form_validation->error_array();
                    $data['status'] = FALSE;
                    $data['errors'] = $errors;
                    //$data['post'] = $_POST;
                }
                echo json_encode($data);
            }           
        }   
    }
    public function delete()
    {
        if($this->input->is_ajax_request())
        {
            if($_POST)
            {
                $data['status'] = true;
                
                $status = $this->Tujuan_model->delete($this->input->post("id"));
                    
                    if($status){
                        $data['message'] = "Tujuan berhasil dihapus";
                        
                    }
                    else{
                        $data['status'] = FALSE;
                        $data['message'] = "Gagal menghapus tujuan";
                    }
                
                echo json_encode($data);
            }           
        }
    }

    public function save_indikator()
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
                        'field' => 'indikator',
                        'label' => 'Indikator',
                        'rules' => 'required|regex_match[/^[a-z\d\-_\s\()\/\+\-.,"]+$/i]',
                        'errors' => [
                            'required' => '%s diperlukan',
                            'regex_match'   => '%s harus berupa huruf, angka, spasi, atau karakter lainya seperti ()/+-_',
                        ]
                    ],
                    [
                        'field' => 'id_tujuan',
                        'label' => 'Tujuan',
                        'rules' => 'required',
                        'errors' => [
                            'required' => '%s diperlukan',
                        ]
                    ],
                    
                ];
                

                $this->form_validation->set_rules( $validation_rules );
                
                if( $this->form_validation->run() )
                {
					$dt = array(
						'id_tujuan'	=> $post_data['id_tujuan'],
						'nama_indikator_tujuan'	=> $post_data['indikator'],
					);
					if($this->input->post("action")=="edit"){
						$this->Tujuan_indikator_model->update($dt,$post_data['id_indikator']);
						$data['message'] = "Indikator berhasil diubah";
					}
					else if($this->input->post("action")=="add"){
						$this->Tujuan_indikator_model->insert($dt);
						$data['message'] = "Indikator berhasil disimpan";
					}
					else{
						$data['message'] = "Error";
						$data['status'] = FALSE;
					}
                }
                else{
                    $errors = $this->form_validation->error_array();
                    $data['status'] = FALSE;
                    $data['errors'] = $errors;
                    //$data['post'] = $_POST;
                }
                echo json_encode($data);
            }           
        }   
    }
    public function delete_indikator()
    {
        if($this->input->is_ajax_request())
        {
            if($_POST)
            {
                $data['status'] = true;
                
                $status = $this->Tujuan_indikator_model->delete($this->input->post("id"));
                    
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

    public function get_tujuan_by_misi()
    {
        $content = '<option value="">Pilih</option>';
        if($this->input->is_ajax_request() && $this->input->post("id_misi"))
        {
            $param_tujuan['where']['tujuan.id_misi'] = $this->input->post("id_misi");
            $dt_tujuan = $this->Tujuan_model->get($param_tujuan);
            foreach($dt_tujuan->result() as $row)
            {
                $content .= '<option value="'.$row->id_tujuan.'">'.$row->tujuan.'</option>';
            }           
        }
        $data['content'] = $content;
        echo json_encode($data);
    }
    public function get_indikator_by_tujuan()
    {
        $content = '<option value="">Pilih</option>';
        if($this->input->is_ajax_request() && $this->input->post("id_tujuan"))
        {
            $param['where']['indikator.id_tujuan'] = $this->input->post("id_tujuan");
            $dt = $this->Tujuan_indikator_model->get($param);
            foreach($dt->result() as $row)
            {
                $content .= '<option value="'.$row->id_indikator_tujuan.'">'.$row->nama_indikator_tujuan.'</option>';
            }           
        }
        $data['content'] = $content;
        echo json_encode($data);
    }
}