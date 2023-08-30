<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Renaksi extends CI_Controller
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
		$this->array_privileges = explode(';', $this->user_privileges);

		if ($this->user_level == "Administrator" OR in_array('program', $this->array_privileges)) {	}
		else{show_404();}

        $this->load->model("sicerdas/renja/Sub_kegiatan_indikator_model");
		$this->load->model("sicerdas/renja/Renaksi_model");

        $this->file_max_size = 10000; // 10mb
  		$this->file_type_allowed = ['docx','doc', 'xls', 'xlsx', 'pdf', 'jpg', 'jpeg', 'png', 'gif', 'rar', 'zip', 'ppt', 'pptx'];
	}

    public function detail($token)
    {
        $data['title']		= "Sicerdas - " . app_name;
		$data['content']	= "sicerdas/renja/renaksi/detail";
		$data['active_menu'] = "renja";
		$data['user_picture'] = $this->user_picture;
		$data['full_name']		= $this->full_name;
		$data['user_level']		= $this->user_level;
        $data['plugins'] = ['sweetalert','select','dropify','switchery'];

        $param['where']["md5(CONCAT('SKI',indikator.id_indikator_sub_kegiatan))"] = $token;
        $detail = $this->Sub_kegiatan_indikator_model->get($param)->row();

        if($token && $detail)
        {
            $data['back_token'] = md5("SC".$detail->id_sub_kegiatan_renja);
            $data['detail'] = $detail;

            $data['file_max_size'] = $this->file_max_size;
            $data['file_type_allowed'] = $this->file_type_allowed;
            
            //echo "<pre>";print_r($detail);die;
            
            $this->load->view('admin/main', $data);
        }
        else{
            show_404();
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
                        'field' => 'nama_renaksi',
                        'label' => 'Nama renaksi',
                        'rules' => 'required',
                        'errors' => [
                            'required' => '%s diperlukan',
                        ]
                    ],

                    [
                        'field' => 'id_indikator_sub_kegiatan',
                        'label' => 'id_indikator_sub_kegiatan',
                        'rules' => 'required',
                        'errors' => [
                            'required' => '%s diperlukan',
                        ]
                    ],
                    
                    [
                        'field' => 'id_skpd',
                        'label' => 'id_skpd',
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
                        'id_indikator_sub_kegiatan'  => $post_data['id_indikator_sub_kegiatan'],
                        'nama_renaksi'  => $post_data['nama_renaksi'],
                    );

                    
                    if($this->input->post("action")=="edit"){
						$id_renaksi = $post_data['id_renaksi'];
                        $this->db->where("id_renaksi",$id_renaksi)->update("sc_renaksi",$dt);
                        $data['message'] = "Renaksi berhasil diubah";
                    }
                    else if($this->input->post("action")=="add"){
                        $this->db->insert("sc_renaksi",$dt);
                        $id_renaksi = $this->db->insert_id();
                        $data['message'] = "Renaksi berhasil disimpan";
                    }
                    else{
                        $data['message'] = "Error";
                        $data['status'] = FALSE;
                    }

                    if($id_renaksi)
                    {
                        if($this->input->post("target_renaksi"))
                        {
                            foreach($_POST['target_renaksi'] as $key => $value)
                            {
                                $status = (!empty($_POST['status'][$key])) ? "Y" : "N";
                                $target_renaksi = ($status=="Y" && !empty($_POST['target_renaksi'][$key])) ? $_POST['target_renaksi'][$key] : 0;
                                $target_anggaran = ($status=="Y" && !empty($_POST['target_anggaran'][$key])) ? $_POST['target_anggaran'][$key] : 0;

                                $dt_detail = array(
                                    "id_renaksi"    => $id_renaksi,
                                    "month"         => $key,
                                    "status"        => $status,
                                    "target_renaksi"    => $target_renaksi,
                                    "target_anggaran"   => $target_anggaran,  
                                    "id_skpd"       => $post_data['id_skpd']
                                );
                                
                                $param_renaksi_detail['where']['detail.id_renaksi'] = $id_renaksi;
                                $param_renaksi_detail['where']['detail.month'] = $key;
                                $cek = $this->Renaksi_model->get_detail($param_renaksi_detail);


                                if($cek->num_rows()==0)
                                {
                                    $this->db->insert("sc_renaksi_detail",$dt_detail);
                                }
                                else{
                                    $detail = $cek->row();
                                    
                                    $dt_detail['capaian'] = $this->Renaksi_model->hitung_capaian($target_renaksi, $detail->realisasi, $detail->metode, $detail->target_min);
                                    $dt_detail['capaian_anggaran'] = $this->Renaksi_model->hitung_capaian($target_anggaran, $detail->realisasi_anggaran, $detail->metode, $detail->target_anggaran_min);
                            
                                    $this->db
                                    ->where("id_renaksi",$id_renaksi)
                                    ->where("month",$key)
                                    ->update("sc_renaksi_detail",$dt_detail);
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

    public function delete()
    {
        if($this->input->is_ajax_request())
        {
            $id = $this->input->post("id");
            if($_POST && $id)
            {
                $data['status'] = true;

                $this->db->where("id_renaksi",$id)->delete("sc_renaksi_detail");
                
                $status = $this->db->where("id_renaksi",$id)->delete("sc_renaksi");
                    
                    if($status){
                        $data['message'] = "Renaksi berhasil dihapus";
                        
                    }
                    else{
                        $data['status'] = FALSE;
                        $data['message'] = "Gagal menghapus renaksi";
                    }
                
                echo json_encode($data);
            }           
        }
    }

    public function get_renaksi()
    {
        $id_indikator_sub_kegiatan = $this->input->post("id_indikator_sub_kegiatan");
        $data['post'] = $_POST;
        if($this->input->is_ajax_request() && $id_indikator_sub_kegiatan)
        {
            $param_renaksi['where']['renaksi.id_indikator_sub_kegiatan'] = $id_indikator_sub_kegiatan;

            $dt_renaksi = $this->Renaksi_model->get_detail($param_renaksi)->result();

            $renaksi = array();
            foreach($dt_renaksi as $row)
            {
                $renaksi[$row->id_renaksi]['nama_renaksi'] = $row->nama_renaksi;
                $renaksi[$row->id_renaksi]['detail'][] = $row;
            }
            $data['dt_renaksi'] = $renaksi;
            $content = '';
            $id_renaksi = 0;
            $num = 0;
            foreach($renaksi as $id_renaksi => $row) {
                $num++;
                $content .='
          <div class="row b-t m-t-50" style="margin-top: 0px;padding-top: 30px">
            <p><strong style="padding-top:20px;">Rencana Aksi '.$num.'.</strong> '.$row['nama_renaksi'].' <a
                style="margin-left: 10px;color:white;" href="javascript:void(0)" onclick="hapusRenaksi('.$id_renaksi.')"
                class="btn btn-danger pull-right "><i class="ti-trash"></i> Hapus</a><a href="javascript:void(0)"
                class="btn btn-primary pull-right " style="color:white;" onclick="editRenaksi('.$id_renaksi.')"><i
                  class="ti-pencil"></i> Edit</a></p>
            <br>
            <div class="table-responsive">
              <table class="table color-table muted-table">
                <thead>
                  <tr>
                    <th style="text-align: center" rowspan="2">Bulan</th>
                    <th style="text-align: center" rowspan="2">Status Jadwal</th>
                    <th style="text-align: center" colspan="3">Kegiatan</th>
                    <th style="text-align: center" colspan="3">Anggaran</th>
                    <th style="text-align: center" rowspan="2">Lampiran</th>
                    <th style="text-align: center" rowspan="2">Link</th>
                    <th class=" " style="text-align: center" rowspan="2">Opsi</th>
                  </tr>
                  <tr>
                    <th style="text-align: center">Target</th>
                    <th style="text-align: center">Realisasi</th>
                    <th style="text-align: center">Capaian</th>
                    <th style="text-align: center">Target</th>
                    <th style="text-align: center">Realisasi</th>
                    <th style="text-align: center">Capaian</th>
                  </tr>
                </thead>
                <tbody>';

                  foreach($row['detail'] as $k => $dt){
                    $content .='
                  <tr>
                    <td style="text-align: center">'.bulan($dt->month).' </td>
                    <td style="text-align: center">';

                    if($dt->status=="Y"){
                      $content .='<span class="label label-primary"><i class="ti-check"></i>Dijadwalkan</span>';
                    }
                    if($dt->status=="N"){
                      $content .='<span class="label label-danger"><i class="ti-close"></i>Tidak Dijadwalkan</span>';
                    }

                    $lampiran = '-';
                    if($dt->dokumen)
                    {
                        $lampiran = '<a href="'.base_url().'data/sicerdas/'.$dt->dokumen.'" target="_blank" class="btn btn-sm btn-default">Download</a>';
                    }

                    $link = '-';
                    if($dt->link)
                    {
                        $link = '<a href="'.$dt->link.'" target="_blank" class="btn btn-sm btn-default">Buka</a>';
                    }

                    $content .='
                    </td>
                    <td style="text-align: center" class="">'.number_format($dt->target_renaksi).'</td>
                    <td style="text-align: center" class="">'.number_format($dt->realisasi).'</td>
                    <td style="text-align: center" class="">'.number_format($dt->capaian).'%</td>
                    <td style="text-align: center" class="">'.number_format($dt->target_anggaran).'</td>
                    <td style="text-align: center" class="">'.number_format($dt->realisasi_anggaran).'</td>
                    <td style="text-align: center" class="">'.number_format($dt->capaian_anggaran).'%</td>
                    <td align="center">
                      '.$lampiran.'
                    </td>
                    <td align="center">
                      '.$link.'
                    </td>
                    <td class=" " style="text-align: center">
                      <a href="javascript:void(0)" class="btn btn-sm btn-primary" style="color:white;"
                        onclick="showUpdate('.$id_renaksi.','.$k.',\''.bulan($dt->month).'\')"><i class="ti-eye"></i> Update Capaian</a>
                    </td>
                  </tr>';

                }
        $content .='
                </tbody>
              </table>
            </div>
          </div>';
           
            }   

            if($content=="")
            {
                $content = '
                    <div class="row">
                        <div class="col-md-12">
                            <p class="text-center">- Belum ada data -</p>
                        </div>
                    </div>
                ';
            }
            
            $data['content'] = $content;
            
        }
        echo json_encode($data);
    }

    public function update_capaian()
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
                        'field' => 'realisasi',
                        'label' => 'Realisasi',
                        'rules' => 'required',
                        'errors' => [
                            'required' => '%s diperlukan',
                        ]
                    ],

                    [
                        'field' => 'realisasi_anggaran',
                        'label' => 'Realisasi Anggaran',
                        'rules' => 'required',
                        'errors' => [
                            'required' => '%s diperlukan',
                        ]
                    ],

                    [
                        'field' => 'id_renaksi_detail',
                        'label' => 'id_renaksi_detail',
                        'rules' => 'required',
                        'errors' => [
                            'required' => '%s diperlukan',
                        ]
                    ],
         
                ];

                

                $this->form_validation->set_rules( $validation_rules );
                
                if( $this->form_validation->run() )
                {
                    $param['where']['detail.id_renaksi_detail'] = $post_data['id_renaksi_detail'];
                    $detail = $this->Renaksi_model->get_detail($param)->row();

                    if($detail)
                    {
                        $config['upload_path']="./data/sicerdas/";
                        $config['allowed_types']=implode("|", $this->file_type_allowed);
                        $config['encrypt_name'] = TRUE;
                        $config['max_size']     = $this->file_max_size;

                        $dokumen = $detail->dokumen;

                        $this->load->library('upload',$config);
                        if($this->upload->do_upload("dokumen")){
                            $dokumen = $this->upload->data('file_name');
                            $path = $config['upload_path'] . $detail->dokumen;
                            if($detail->dokumen && file_exists($path)){
                                unlink($path);
                            }
                        }
                        else if (!empty($_FILES['file']['tmp_name'])){
                            $error_upload = $this->upload->display_errors();
                        }

                        if(!empty($error_upload)){
                            $data['errors'] = array('dokumen' => $error_upload);
                            $data['status'] = FALSE;
                        }
                        else{

                            $data['status'] = true;
                            $capaian = ($this->input->post("capaian")) ? $this->input->post("capaian") : 0;
                            $capaian_anggaran = ($this->input->post("capaian")) ? $this->input->post("capaian_anggaran") : 0;
    
                            //echo "<pre>";print_r($detail);die;  
    
                            $capaian = 0;
                            if($this->input->post("capaian"))
                            {
                                $capaian = $this->input->post("capaian");
                            }
                            else{
                                $capaian = $this->Renaksi_model->hitung_capaian($detail->target_renaksi, $post_data['realisasi'], $detail->metode, $detail->target_min);
                            }
    
                            $capaian_anggaran = 0;
                            if($this->input->post("capaian_anggaran"))
                            {
                                $capaian_anggaran = $this->input->post("capaian_anggaran");
                            }
                            else{
                                $capaian_anggaran = $this->Renaksi_model->hitung_capaian($detail->target_anggaran, $post_data['realisasi_anggaran'], $detail->metode, $detail->target_anggaran_min);
                            }
    
                            $update = array(
                                'realisasi' => $post_data['realisasi'],
                                'realisasi_anggaran' => $post_data['realisasi_anggaran'],
                                'link' => $this->input->post("link"),
                                'capaian_anggaran' => $capaian_anggaran,
                                'capaian'   => $capaian,
                                'dokumen' => $dokumen
                            );
                            $this->db
                            ->where("id_renaksi_detail",$post_data['id_renaksi_detail'])
                            ->update("sc_renaksi_detail",$update);
    
                            $data['message'] = "Capaian berhasil di-update";
                        }
                        
                    }
                    else{
                        $data['status'] = FALSE;
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
}