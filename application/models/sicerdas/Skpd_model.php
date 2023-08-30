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
        $this->db->where("kepala_skpd","Y");
        $this->db->where("pensiun",0);
        //$this->db->where("jenis_pegawai","kepala");
        //$this->db->where("id_unit_kerja",0);
        return $this->db->get("pegawai")->row();
    }

    public function get_unit_kerja($id_skpd=null,$id_unit_kerja=null)
    {
        $unit_kerja = array();
        $i = 0;

        //level 1
        $this->db->select("ref_unit_kerja.*, induk.nama_unit_kerja as 'nama_unit_kerja_induk' ");
        $this->db->join("ref_unit_kerja induk","induk.id_unit_kerja = ref_unit_kerja.id_induk","left");
        
        if($id_skpd)
        {
            $this->db->where("ref_unit_kerja.id_skpd",$id_skpd);
            $this->db->where("ref_unit_kerja.id_induk",0);
        }

        if($id_unit_kerja)
        {
            $this->db->where("ref_unit_kerja.id_unit_kerja",$id_unit_kerja);
        }
        
        $dt_unit_1 = $this->db->get("ref_unit_kerja")->result();
        
        foreach($dt_unit_1 as $row1)
        {
            $class_unit_1 = 'unit-'.$row1->id_unit_kerja;
            $row1->class_unit = $class_unit_1;
            $unit_kerja[$i] = $row1;
            
            $index[1] = $i;
            $i++;

            $bawahan[1] = array();
            

            //level 2
            $dt_unit_2 = $this->db
            ->select("ref_unit_kerja.*, induk.nama_unit_kerja as 'nama_unit_kerja_induk' ")
            ->join("ref_unit_kerja induk","induk.id_unit_kerja = ref_unit_kerja.id_induk","left")
            ->where("ref_unit_kerja.id_induk",$row1->id_unit_kerja)->get("ref_unit_kerja")->result();
            foreach($dt_unit_2 as $row2)
            {
                $class_unit_2 = $class_unit_1.' unit-'.$row2->id_unit_kerja;
                $row2->class_unit = $class_unit_2;
                $unit_kerja[$i] = $row2;

                $index[2] = $i;
                $i++;

                
                $bawahan[1][] = $row2->id_unit_kerja;
                $bawahan[2] = array();

                //level 3
                $dt_unit_3 = $this->db
                ->select("ref_unit_kerja.*, induk.nama_unit_kerja as 'nama_unit_kerja_induk' ")
                ->join("ref_unit_kerja induk","induk.id_unit_kerja = ref_unit_kerja.id_induk","left")
                ->where("ref_unit_kerja.id_induk",$row2->id_unit_kerja)->get("ref_unit_kerja")->result();
                foreach($dt_unit_3 as $row3)
                {
                    $class_unit_3 = $class_unit_2.' unit-'.$row3->id_unit_kerja;
                    $row3->class_unit = $class_unit_3;
                    $unit_kerja[$i] = $row3;

                    $index[3] = $i;
                    $i++;

                    
                    $bawahan[1][] = $row3->id_unit_kerja;
                    $bawahan[2][] = $row3->id_unit_kerja;
                    $bawahan[3] = array();

                    //level 4
                    $dt_unit_4 = $this->db
                    ->select("ref_unit_kerja.*, induk.nama_unit_kerja as 'nama_unit_kerja_induk' ")
                    ->join("ref_unit_kerja induk","induk.id_unit_kerja = ref_unit_kerja.id_induk","left")
                    ->where("ref_unit_kerja.id_induk",$row3->id_unit_kerja)->get("ref_unit_kerja")->result();
                    foreach($dt_unit_4 as $row4)
                    {
                        $class_unit_4 = $class_unit_3.' unit-'.$row4->id_unit_kerja;
                        $row4->class_unit = $class_unit_4;
                        $unit_kerja[$i] = $row4;

                        $i++;

                        $bawahan[1][] = $row4->id_unit_kerja;
                        $bawahan[2][] = $row4->id_unit_kerja;
                        $bawahan[3][] = $row4->id_unit_kerja;
                    }

                    $unit_kerja[$index[3]]->id_unit_kerja_bawahan = $bawahan[3];

                }

                $unit_kerja[$index[2]]->id_unit_kerja_bawahan = $bawahan[2];
            }    
            $unit_kerja[$index[1]]->id_unit_kerja_bawahan = $bawahan[1];   
        }

        return $unit_kerja;
    }

    public function get_skpd_by_unit($param=null)
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
        
        $this->db->join("ref_skpd skpd","skpd.id_skpd = unit_kerja.id_skpd","left");

        $this->db->group_by("unit_kerja.id_skpd");

        $this->db->select("skpd.*");

        $query = $this->db->get("ref_unit_kerja unit_kerja");

        return $query;
    }
}