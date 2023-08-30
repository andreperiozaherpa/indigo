<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lampiran_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }


    public function get($param=null)
    {

        if(!empty($param['search']))
        {
            $this->db->where("(lampiran.nama_lampiran like '%".$param['search']."%' )");
        }

        if(!empty($param['where']))
        {
            foreach ($param['where'] as $key => $value) {
                $this->db->where($key,$value);
            }
        }
        if(!empty($param['str_where']))
        {
            $this->db->where($param['str_where']);
        }
        
        if(isset($param['limit']) && isset($param['offset']))
        {
            $this->db->limit($param['limit'],$param['offset']);
        }

        $this->db->order_by("lampiran.jenis","ASC");

        $query = $this->db->get("ekinerja_lampiran lampiran");    

        return $query;
    }

    public function getContent($id_skp,$download=false)
    {
        $offset = 0;
        $param = array();

        $data = array();

        $param['where']['lampiran.id_skp'] = $id_skp;

        $result = $this->Lampiran_model->get($param)->result();

        $catatan = '<td></td>';

        
        $content = '';

        if($download)
        {
            $content = '<table width="100%" border="1" cellpadding="5">';
        }
        else{
            $content = '<table class="table table-striped">';
        }


        $jenis = "";

        foreach($result as $key=>$row)
        {
            if($this->input->post("verifikasi"))
            {
                $catatan = '<td width="20%">
                    <input type="text" class="form-control" placeholder="Umpan balik" name="umpan_balik[lampiran]['.$row->id_lampiran.']" />
                </td>';
            }

            if($jenis != $row->jenis)
            {
                if(!$download)
                {
                    $content .= '
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th width="75%">'.$row->jenis.'</th>
                            <th width="20%"></th>
                        </tr>
                    </thead>
                    ';
                }   
                else{
                    $content .= '
                        <tr>
                            <th width="5%"><b>No</b></th>
                            <th width="75%"><b>'.$row->jenis.'</b></th>
                            <th width="20%"></th>
                        </tr>
                    ';
                }


                $jenis = $row->jenis;
                $offset = 0;
            }

            $no ='';
            if($row->nama_lampiran!=""){
                $offset++;
                $no = $offset;
            }
            $content .= '
            <tr>
                <td width="5%">'.($no).'</td>
                <td width="75%">'.$row->nama_lampiran.'</td>
                '.$catatan.'
            </tr>
        ';
            
        }

        if(!$result)
        {
            $content = '<tr><td colspan="3" align="center">-Tidak ada data-</td></tr>';
        }

        $content .= '</table>';
        return $content;
    }
}