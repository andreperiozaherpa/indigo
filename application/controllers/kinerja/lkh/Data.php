<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Data extends CI_Controller
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


        $this->load->model("sicerdas/Pegawai_model");
        $param_pegawai['where']['pegawai.id_user'] = $this->session->id_user;
        $param_pegawai['where']['pegawai.pensiun'] = 0;
        $dt_pegawai = $this->Pegawai_model->get($param_pegawai)->row();

        $this->role_pimpinan = ($dt_pegawai && $dt_pegawai->kepala_skpd == "Y" && in_array($dt_pegawai->jenis_skpd,['skpd','kecamatan']));


        $hasPrivilege = true;

        $this->pegawai = $dt_pegawai;

        if(!$hasPrivilege)
        {
            show_404();
        }



        $this->load->model("kinerja/Config");
        $this->load->model("kinerja/Skp_model");
        $this->load->model("kinerja/Kinerja_utama_model");
        $this->load->model("kinerja/Kinerja_tambahan_model");
        $this->load->model("kinerja/Instruksi_model");
        $this->load->model("kinerja/Renaksi_model");
        $this->load->model("sicerdas/Globalvar");
        $this->load->model("kinerja/Skpd");
        $this->load->model("sicerdas/Ref_satuan_model");
        $this->load->model("kinerja/Lkh_model");
        $this->load->model("sicerdas/Skpd_model");
        $this->load->model("laporan_kinerja_harian_model");
	}

    
    public function get_rencana_hasil()
    {
        $content = '<option value="">Pilih</option>';
        $tanggal = $this->input->post("tanggal");
        $rencana_hasil = $this->input->post("rencana_hasil");
        if($this->input->is_ajax_request() && $tanggal)
        {
            $tahun = date("Y",strtotime($tanggal));

            $param['where']['skp.id_pegawai'] = $this->pegawai->id_pegawai;
            $param['where']['skp.tahun_desc'] = $tahun;
            $param['where']['skp.status'] = 'Sudah Diverifikasi';

            $dt_kinerja_utama = $this->Kinerja_utama_model->get($param)->result();
            $dt_kinerja_tambahan = $this->Kinerja_tambahan_model->get($param)->result();
            $dt_instruksi = $this->Instruksi_model->get_instruksi_khusus($param)->result();

            $content .= '
            <optgroup label="Kinerja Utama">';

            foreach($dt_kinerja_utama as $row)
            {
                if($row->flag=="sasaran")
                {
                    $_rencana_hasil = $row->nama_indikator_sasaran_renstra;
                }
                else{
                    $_rencana_hasil = $row->rencana_hasil_kerja;
                }

                $selected = ($rencana_hasil && $rencana_hasil == $row->id_kinerja_utama) ? "selected" : "";
                $value = "U-".$row->id_kinerja_utama;
                $content .= '<option '.$selected.' value="'.$value.'">'.$_rencana_hasil.'</option>';
            }
            
            $content .='
            </optgroup>

            <optgroup label="Instruksi Khusus">';

            foreach($dt_instruksi as $row)
            {
                $selected = ($rencana_hasil && $rencana_hasil == $row->id_instruksi_khusus) ? "selected" : "";
                $value = "I-".$row->id_instruksi_khusus;
                $content .= '<option '.$selected.' value="'.$value.'">'.$row->indikator_kinerja_individu.'</option>';
            }
            
            $content .='
            </optgroup>

            <optgroup label="Kinerja Tambahan">';

            foreach($dt_kinerja_tambahan as $row)
            {
                $selected = ($rencana_hasil && $rencana_hasil == $row->id_kinerja_tambahan) ? "selected" : "";
                $value = "T-".$row->id_kinerja_tambahan;
                $content .= '<option '.$selected.' value="'.$value.'">'.$row->rencana_hasil_kerja.'</option>';
            }
            
            $content .='</optgroup>';
        }
        $data['post'] = $_POST;
        $data['content'] = $content;
        echo json_encode($data);
    }

    public function get_renaksi()
    {
        $content = '<option value="">Pilih</option>';
        $tanggal = $this->input->post("tanggal");
        $rencana_hasil = $this->input->post("rencana_hasil");
        $id_renaksi_detail = $this->input->post("id_renaksi_detail");

        if($this->input->is_ajax_request() && $rencana_hasil && $tanggal)
        {
			$tahun = date("Y",strtotime($tanggal));
            $bulan = date("n",strtotime($tanggal));
            $rencana_hasilArr = explode("-",$rencana_hasil);

            $detail = null;
            $satuan = "satuan_desc";
            
            if($rencana_hasilArr[0]=="U")
            {
                $param['where']['renaksi.id_kinerja_utama'] = $rencana_hasilArr[1];

                $param_detail['where']['kinerja_utama.id_kinerja_utama']  = $rencana_hasilArr[1];
                $detail = $this->Kinerja_utama_model->get($param_detail)->row();

            }

            if($rencana_hasilArr[0]=="T")
            {
                $param['where']['renaksi.id_kinerja_tambahan'] = $rencana_hasilArr[1];
                
                $param_detail['where']["kinerja_tambahan.id_kinerja_tambahan"]  = $rencana_hasilArr[1];
                $detail = $this->Kinerja_tambahan_model->get($param_detail)->row();
            }

            if($rencana_hasilArr[0]=="I")
            {
                $param['where']['renaksi.id_instruksi_khusus'] = $rencana_hasilArr[1];

                $param_detail['where']["instruksi_khusus.id_instruksi_khusus"]  = $rencana_hasilArr[1];
                $detail = $this->Instruksi_model->get_instruksi_khusus($param_detail)->row();
            }

            $param['where']['renaksi.tahun_desc'] = $tahun;
            $param['where']['renaksi_detail.bulan'] = $bulan;
            $param['where']['renaksi_detail.status_jadwal'] = "Y";

            $data['param'] = $param;
            $data['detail'] = $detail;

            $result = $this->Renaksi_model->get_detail($param)->result();

            

            $data['result'] = $result;

            $target = [];
            $satuan = [];
            $realisasi = [];

            $this->load->model("kinerja/Lkh_model");

            foreach($result as $row)
            {
                $selected = ($id_renaksi_detail && $id_renaksi_detail == $row->id_renaksi_detail) ? "selected" : "";
                $content .= '<option '.$selected.' value="'.$row->id_renaksi_detail.'">'.$row->renaksi.'</option>';
                $target[$row->id_renaksi_detail] = $row->target;
                $satuan[$row->id_renaksi_detail] = $row->satuan;

                // init
                $realisasi[$row->id_renaksi_detail] = 0;//$this->Lkh_model->getTotalRealisasi($row->id_renaksi_detail);

            }        
            
            $param['group_by']  = "renaksi_detail.id_renaksi_detail";
            $dt_realisasi = $this->Lkh_model->getSummaryRealisasi($param)->result();
            foreach($dt_realisasi as $row)
            {
                $realisasi[$row->id_renaksi_detail] = $row->total;
            }
            
            $data['target'] = $target;
            $data['satuan'] = $satuan;
            $data['realisasi'] = $realisasi;
        }
        $data['content'] = $content;
        $data['post'] = $_POST;
        echo json_encode($data);
    }
    


    public function get_unit_kerja()
    {
        $content = '<option value="">Pilih</option>';
        if($this->input->is_ajax_request() && $this->input->post("id_skpd"))
        {
            
            $dt_unit_kerja = $this->Skpd_model->get_unit_kerja($this->input->post('id_skpd'));



            foreach($dt_unit_kerja as $row)
            {
                $pad = "";
                if($row->level_unit_kerja==2)
                {
                  $pad = '-';
                }
                else if($row->level_unit_kerja==3)
                {
                  $pad = '--';
                }
                else if($row->level_unit_kerja==4)
                {
                  $pad = '---';
                }
                $unit_kerja_induk = ($row->level_unit_kerja!=1)  ? " < ".$row->nama_unit_kerja_induk : "";
                $selected =  ($row->id_unit_kerja == $this->input->post("id_unit_kerja"))  ? "selected" : "";
                $content .= '<option '.$selected.' value="'.$row->id_unit_kerja.'">'.$pad.$row->nama_unit_kerja.$unit_kerja_induk.'</option>';
            }           
        }
        $data['content'] = $content;
        echo json_encode($data);
    }

    public function get_pegawai()
    {
        $content = '<option value="">Pilih</option>';
        if($this->input->is_ajax_request())
        {
            if($this->input->post("id_unit_kerja"))
            {
                $dt_pegawai = $this->db
                ->where("id_unit_kerja",$this->input->post("id_unit_kerja"))
                ->where("(id_pegawai_atasan_langsung = '".$this->pegawai->id_pegawai."') ")
                ->get("pegawai")->result();
            }
            else{
                $dt_pegawai = $this->db
                ->where("(id_pegawai_atasan_langsung = '".$this->pegawai->id_pegawai."') ")
                ->get("pegawai")->result();
            }
            foreach($dt_pegawai as $row)
            {
                $selected = ($row->id_pegawai == $this->input->post("id_pegawai"))  ? "selected" : "";
                $content .= '<option '.$selected.' value="'.$row->id_pegawai.'">'.$row->nama_lengkap.'</option>';
            }           
        }
        $data['content'] = $content;
        echo json_encode($data);
    }

    public function get_detail()
    {
        $content = '';
        $id_pegawai = $this->input->post("id_pegawai");
        $tanggal = $this->input->post("tanggal");
        if($this->input->is_ajax_request() && $id_pegawai && $tanggal)
        {
            $param['where']['laporan_kerja_harian.id_pegawai'] = $id_pegawai;
            $param['where']['laporan_kerja_harian.tanggal'] = $tanggal;
            $this->db->group_by("laporan_kerja_harian.id_laporan_kerja_harian");
            $result = $this->Lkh_model->get($param)->result();
            foreach($result as $key => $row)
            {
                $lampiran = '';
                $penilaian= "";
                $komentar = '';
                if($row->lampiran)
                {
                    $lampiran = '<a class="btn btn-sm btn-default btn-outline" href="'.base_url().'data/kegiatan_personal/'.$row->id_pegawai.'/'.$row->lampiran.'" target="_blank"><i class="ti ti-download"></i> Download</a>';
                }
                if($row->rating)
                {
                    $star1= ($row->rating>=1) ? "checked" : "";
                    $star2= ($row->rating>=2) ? "checked" : "";
                    $star3= ($row->rating>=3) ? "checked" : "";
                    $star4= ($row->rating>=4) ? "checked" : "";
                    $star5= ($row->rating>=5) ? "checked" : "";

                    $penilaian = '
                        <span class="fa fa-star '.$star1.'"></span>
                        <span class="fa fa-star '.$star2.'"></span>
                        <span class="fa fa-star '.$star3.'"></span>
                        <span class="fa fa-star '.$star4.'"></span>
                        <span class="fa fa-star '.$star5.'"></span>
                    ';
                }
                if($row->komentar)
                {
                    $komentar = '<br>"'.$row->komentar.'"';
                }
                $content .= '
                    <tr>
                        <td>'.($key+1).'</td>
                        <td>'.$row->rencana_hasil_kerja.'</td>
                        <td>'.$row->renaksi.'</td>
                        <td id="rincian_kegiatan_'.$key.'"></td>
                        <td>'.$row->hasil_kegiatan.'</td>
                        <td>'.$row->status.'</td>
                        <td>'.$penilaian.$komentar.'</td>
                        <td>'.$lampiran.'</td>
                    </tr>
                ';
            }
            $data['title'] = "Detail LKH | " . $result[0]->nama_pegawai . " | " . date("d M Y", strtotime($tanggal));
            $data['status_verifikasi'] = $result[0]->status_verifikasi;
            $data['result'] = $result;
        }
        $data['content'] = $content;
        echo json_encode($data);
    }

    
}