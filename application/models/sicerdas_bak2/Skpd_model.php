<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Skpd_model extends CI_Model{

	public function get($param=null)
    {

        if(!empty($param['search']))
        {
            $this->db->where("(skpd.nama_skpd like '%".$param['search']."%' )");
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

        $query = $this->db->get("ref_skpd skpd");

        return $query;
    }

    public function get_kepala($id_skpd)
    {
        $this->db->where("id_skpd",$id_skpd);
        $this->db->where("jenis_pegawai","kepala");
        $this->db->where("id_unit_kerja",0);
        $this->db->where("pensiun",0);
        return $this->db->get("pegawai")->row();
    }

    public function get_unit_kerja($id_skpd)
    {
        $unit_kerja = array();

        //level 1
        $dt_unit_1 = $this->db->where("id_skpd",$id_skpd)->where("id_induk",0)->get("ref_unit_kerja")->result();
        foreach($dt_unit_1 as $row1)
        {
            $class_unit_1 = 'unit-'.$row1->id_unit_kerja;
            $row1->class_unit = $class_unit_1;
            $unit_kerja[] = $row1;
            

            //level 2
            $dt_unit_2 = $this->db->where("id_induk",$row1->id_unit_kerja)->get("ref_unit_kerja")->result();
            foreach($dt_unit_2 as $row2)
            {
                $class_unit_2 = $class_unit_1.' unit-'.$row2->id_unit_kerja;
                $row2->class_unit = $class_unit_2;
                $unit_kerja[] = $row2;

                //level 3
                $dt_unit_3 = $this->db->where("id_induk",$row2->id_unit_kerja)->get("ref_unit_kerja")->result();
                foreach($dt_unit_3 as $row3)
                {
                    $class_unit_3 = $class_unit_2.' unit-'.$row3->id_unit_kerja;
                    $row3->class_unit = $class_unit_3;
                    $unit_kerja[] = $row3;

                    //level 4
                    $dt_unit_4 = $this->db->where("id_induk",$row3->id_unit_kerja)->get("ref_unit_kerja")->result();
                    foreach($dt_unit_4 as $row4)
                    {
                        $class_unit_4 = $class_unit_3.' unit-'.$row4->id_unit_kerja;
                        $row4->class_unit = $class_unit_4;
                        $unit_kerja[] = $row4;
                    }
                }
            }       
        }

        return $unit_kerja;
    }
}