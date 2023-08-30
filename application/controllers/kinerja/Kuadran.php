<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kuadran extends CI_Controller
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


        $hasPrivilege = ($this->user_level == 'Administrator' || in_array('program', $array_privileges)) ;

        if(!$hasPrivilege)
        {
            show_404();
        }

        $this->pegawai = $dt_pegawai;


        $this->load->model("kinerja/Config");
        $this->load->model("sicerdas/Globalvar");
        $this->load->model("sicerdas/Skpd_model");
        $this->load->model("kinerja/Skpd");

        $this->load->model("kinerja/Perilaku_model");
        $this->load->model("kinerja/Laporan_model");
        
	}

    public function index()
    {
        $data['title']		    = 'Kuadran 9 Box | ' . $this->Config->app_name;
		$data['content']	    = "kinerja/kuadran/index";
		$data['user_picture']   = $this->user_picture;
		$data['full_name']		= $this->full_name;
		$data['user_level']		= $this->user_level;
        $data['plugins']        = ['select','sweetalert'];
        $data['active_menu']    = "laporan";

        $param = array();
        if($this->id_skpd)
        {
            $param['where']['skpd.id_skpd'] = $this->id_skpd;
        }

        $data['dt_skpd']        = $this->Skpd->get($param);

        
        
        //echo "<pre>";print_r($this->pegawai);die;

        $this->load->view('admin/main', $data);
    }

    
    
    public function get_unit_kerja()
    {
        $content = '<option value="">Pilih</option>';
        if($this->input->is_ajax_request() && $this->input->post("id_skpd"))
        {
            $this->load->model("sicerdas/Skpd_model");
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

    public function get_data()
    {
        $id_skpd = $this->input->post("id_skpd");
        $id_unit_kerja = $this->input->post("id_unit_kerja");
        $tahun = $this->input->post("tahun");
        $triwulan = $this->input->post("triwulan");
        if($this->input->is_ajax_request() && $id_skpd && $tahun)
        {
            $param = array();
            $param['where']['skp.tahun'] = $tahun;

            if($triwulan)
            {
                if($triwulan==1)
                {
                    $param['bulan'] = [1,2,3];
                }
                else if($triwulan==2)
                {
                    $param['bulan'] = [4,5,6];
                }
                else if($triwulan==3)
                {
                    $param['bulan'] = [7,8,9];
                }
                else if($triwulan==4)
                {
                    $param['bulan'] = [10,11,12];
                }
            }
            $param['where']['pegawai.id_skpd'] = $id_skpd;
            
            if($id_unit_kerja)
            {
                $param['where']['pegawai.id_unit_kerja'] = $id_unit_kerja;
            }

            $param['group_by'] = "ASN";

            $dt_capaian_kinerja = $this->Laporan_model->getSummary($param)->result();

            unset($param['where']['skp.tahun']);
            $param['where']['rekap.tahun'] = $tahun;
            $dt_capaian_perilaku = $this->Perilaku_model->getSummary($param)->result();

            // init container
            $container = array(0,0,0,0,0,0,0,0,0);

            $capaian_perilaku = array();
            foreach($dt_capaian_perilaku as $row)
            {
                $capaian_perilaku[$row->id_pegawai] = $row;
            }

            $detail = array();

            foreach($dt_capaian_kinerja as $row)
            {
                $kinerja = $row->capaian;
                $perilaku = !empty($capaian_perilaku[$row->id_pegawai]) ? $capaian_perilaku[$row->id_pegawai] : 0;

                $kinerja_desc = $this->Laporan_model->_rating_hasil_kerja($kinerja);
                $perilaku_desc = $this->Laporan_model->_rating_perilaku($perilaku);

                $box = $this->Laporan_model->_get_box($kinerja_desc,$perilaku_desc);
                $i = $box - 1;
                $container[$i]++;

                $dt = $row;
                $dt->kinerja = $kinerja;
                $dt->kinerja_desc = $kinerja_desc;
                $dt->perilaku = $perilaku;
                $dt->perilaku_desc = $perilaku_desc;

                $detail[$i][] = $dt;
            }
            
            $data['detail'] = $detail;


            $content = '<table style="width:450px;margin-top:20px" class="table_ table-bordered ">
                <tr align="center" valign="center">
                    <td rowspan="3" style="writing-mode: tb-rl;transform: rotate(-180deg);width:50px">
                        <b>HASIL
                            KINERJA</b></td>
                    <td width="100px" style=""><b>Diatas<br>Ekspektasi<b></td>
                    <td width="100px" onclick="show_detail(6)" title="Lihat detail"
                        style="background-color:#b0cc8d;color:black; width:100px; height:100px;cursor:pointer;">
                        <small>Kurang / Misconduct</small><br>
                        <b>'.$container[6].'</b>
                    </td>
                    <td width="100px" onclick="show_detail(7)" title="Lihat detail"
                        style="background-color:#fcb503;color:black;width:100px; height:100px;cursor:pointer;">
                        <small>Baik</small><br>
                        <b>'.$container[7].'</b>
                    </td>
                    <td width="100px" onclick="show_detail(8)" title="Lihat detail"
                        style="background-color:#c72d0e;color:white;width:100px; height:100px;cursor:pointer;">
                        <small>Sangat Baik</small><br>
                        <b>'.$container[8].'</b>
                    </td>
                </tr>
                <tr align="center">
                    <td width="100px" style=""><b>Sesuai<br>Ekspektasi<b></td>
                    <td width="100px" onclick="show_detail(3)" title="Lihat detail"
                        style="background-color:#b0cc8d;color:black; width:100px; height:100px;cursor:pointer;">
                        <small>Kurang / Misconduct</small><br>
                        <b>'.$container[3].'</b>
                    </td>
                    <td width="100px" onclick="show_detail(4)" title="Lihat detail"
                        style="background-color:#fcb503;color:black;width:100px; height:100px;cursor:pointer;">
                        <small>Baik</small><br>
                        <b>'.$container[4].'</b>
                    </td>
                    <td width="100px" onclick="show_detail(5)" title="Lihat detail"
                        style="background-color:#fcb503;color:black;width:100px; height:100px;cursor:pointer;">
                        <small>Baik</small><br>
                        <b>'.$container[5].'</b>
                    </td>
                </tr>
                <tr align="center">
                    <td width="100px" style=""><b>Dibawah<br>Ekspektasi<b></td>
                    <td width="100px" onclick="show_detail(0)" title="Lihat detail"
                        style="background-color:#cfd6e3;color:black; width:100px; height:100px;cursor:pointer;">
                        <small>Sangat Kurang</small><br>
                        <b>'.$container[0].'</b>
                    </td>
                    <td width="100px" onclick="show_detail(1)" title="Lihat detail"
                        style="background-color:#f0d784;color:black;width:100px; height:100px;cursor:pointer;">
                        <small>Butuh Perbaikan</small><br>
                        <b>'.$container[1].'</b>
                    </td>
                    <td width="100px" onclick="show_detail(2)" title="Lihat detail"
                        style="background-color:#f0d784;color:black;width:100px; height:100px;cursor:pointer;">
                        <small>Butuh Perbaikan</small><br>
                        <b>'.$container[2].'</b>
                    </td>
                </tr>
                <tr align="center">
                    <td colspan="2" rowspan="2"></td>
                    <td width="100px" style="height:100px"><b>Dibawah<br>Ekspektasi<b></td>
                    <td width="100px" style="height:100px"><b>Sesuai<br>Ekspektasi<b></td>
                    <td width="100px" style="height:100px"><b>Diatas<br>Ekspektasi<b></td>
                </tr>
                <tr>
                    <td colspan="3" align="center" style="height:50px"><b>PERILAKU</b></td>
                </tr>
            </table>
            <br>
            * Klik kotak untuk melihat detail.
            ';
        }
        $data['content'] = $content;
        echo json_encode($data);
    }
}