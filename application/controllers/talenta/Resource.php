<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Resource extends CI_Controller {

    public function index()
    {
        show_404();
    }

    public function get_unit_kerja_by_skpd()
    {
        if($this->user_id)
        {
            $id_skpd = $this->input->post("id_skpd");
            if($id_skpd)
            {
                $this->load->model("ref_unit_kerja_model");
                $param = array("id_skpd" => $id_skpd);
                $dt_unit = $this->ref_unit_kerja_model->getUnit($param);

                $option= "<option value=''>Pilih Unit Kerja</option>";
                foreach($dt_unit as $row)
                {
                    
                    $option .= "<option value='".$row->id_unit_kerja."'>".$row->nama_unit_kerja."</option>";
                }
                die($option);
            }
            else{
                show_404();
            }
        }
    }

    public function get_jabatan_by_unit_kerja()
    {
        if($this->user_id)
        {
            $id_unit_kerja = $this->input->post("id_unit_kerja");
            if($id_unit_kerja)
            {
                $this->load->model("ref_jabatan_model");
                $param = array("id_unit_kerja" => $id_unit_kerja);
                $dt_jabatan = $this->ref_jabatan_model->get($param);

                $option= "<option value=''>Pilih Jabatan</option>";
                foreach($dt_jabatan as $row)
                {
                    
                    $option .= "<option value='".$row->id_jabatan."'>".$row->nama_jabatan."</option>";
                }
                die($option);
            }
            else{
                show_404();
            }
        }
    }


    public function get_jabatan_by_skpd()
    {
        if($this->user_id)
        {
            $id_skpd = $this->input->post("id_skpd");
            if($id_skpd)
            {
                $this->load->model("ref_jabatan_model");
                $param = array("id_skpd" => $id_skpd);
                $dt_jabatan = $this->ref_jabatan_model->get($param);

                $option= "<option value=''>Pilih Jabatan</option>";
                foreach($dt_jabatan as $row)
                {
                    
                    $option .= "<option value='".$row->id_jabatan."'>".$row->nama_jabatan."</option>";
                }
                die($option);
            }
            else{
                show_404();
            }
        }
    }

    public function get_jabatan_buka()
    {
        if($this->user_id)
        {
            $id_skpd = $this->input->post("id_skpd");
            if($id_skpd)
            {
                $this->load->model("talenta/kebutuhan_model");
                $param = array("mt_kebutuhan.id_skpd" => $id_skpd);
                $dt_jabatan = $this->kebutuhan_model->getSeleksi($param);

                $option= "<option value=''>Pilih Jabatan</option>";
                foreach($dt_jabatan as $row)
                {
                    
                    $option .= "<option value='".$row->id_jabatan."'>".$row->nama_jabatan."</option>";
                }
                die($option);
            }
            else{
                show_404();
            }
        }
    }


    public function get_persyaratan_by_eselon()
    {
        if($this->user_id)
        {
            $eselon = $this->input->post("eselon");
            if($eselon)
            {
                $this->load->model("talenta/persyaratan_model");
                $param = array("eselon" => $eselon);
                $dt_persyaratan = $this->persyaratan_model->get($param);

                $result= "";
                $i=1;
                foreach($dt_persyaratan as $row)
                {
                    $result .= '
                    <div class="checkbox checkbox-primary checkbox-circle">
                        <input id="checkbox-'.$i.'" type="checkbox" value="'.$row->id_persyaratan.'" name="persyaratan[]">
                        <label for="checkbox-'.$i.'"> '.$row->persyaratan.' </label>
                    </div>';
                    $i++;
                }
                if(!$dt_persyaratan){
                    $result = '<p class="text-muted">Tidak ada data</p>';
                }
                die($result);
            }
            else{
                show_404();
            }
        }
    }
}