<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Perilaku_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    public function getPegawai($user_id)
    {
        $this->load->model("sicerdas/Pegawai_model");
        
        $param_pegawai['where']['pegawai.id_user'] = $user_id;
        $dt_pegawai = $this->Pegawai_model->get($param_pegawai)->row();
        //echo "<pre>";print_r($dt_pegawai);
        $pegawai = array();

        $ids = array($dt_pegawai->id_pegawai);

        if($dt_pegawai->id_pegawai_atasan_langsung)
        {
            $dt_atasan = $this->db
            ->select("*, 'atasan' as 'role' ")
            ->where("id_pegawai",$dt_pegawai->id_pegawai_atasan_langsung)
            ->where("pensiun",0)
            ->get("pegawai")->row();

            if($dt_atasan){
                $pegawai[] = $dt_atasan;
                $ids[] = $dt_atasan->id_pegawai;
            }
            //echo "<pre>";print_r($dt_atasan);
        }

        $dt_bawahan = $this->db
        ->select("*, 'bawahan' as 'role' ")
        ->where("id_pegawai_atasan_langsung",$dt_pegawai->id_pegawai)
        ->where("pensiun",0)
        ->get("pegawai");

        foreach($dt_bawahan->result() as $row)
        {
            $ids[] = $row->id_pegawai;
        }

        $param_rekan = array();
        
        if($dt_pegawai->jenis_pegawai=="staff")
        {
            $param_rekan['where']['pegawai.id_unit_kerja'] = $dt_pegawai->id_unit_kerja;
            $param_rekan['where']['pegawai.jenis_pegawai'] = "staff";
        }
        else if($dt_pegawai->jenis_pegawai=="kepala"){
            //$param_rekan['where']['pegawai.jenis_pegawai'] = "kepala";
            $param_rekan['where']['pegawai.jenis_pegawai != '] = "staff";
            $param_rekan['where']['ref_skpd.jenis_skpd'] = $dt_pegawai->jenis_skpd;

            if($dt_pegawai->id_skpd_induk > 0)
            {
                $param_rekan['where']['ref_skpd.id_skpd'] = $dt_pegawai->id_skpd_induk;
            }

            if($dt_pegawai->kepala_skpd=="Y")
            {
                $param_rekan['where']['pegawai.kepala_skpd'] = "Y";
                $this->db->where("ref_skpd.nama_skpd_alias != 'SETDA' ");
            }
            else{
                $param_rekan['where']['pegawai.id_skpd'] = $dt_pegawai->id_skpd;
            }   
        }

        $param_rekan['select'] = "*, 'rekan' as 'role' ";
        $param_rekan['where']['pegawai.pensiun'] = 0;
        $this->db->where("ref_skpd.nama_skpd != 'Kabupaten Sumedang'");
        $this->db->where_not_in("pegawai.id_pegawai",$ids);
        if($dt_pegawai->level_unit_kerja)
        {
            //$param_rekan['where']['ref_unit_kerja.level_unit_kerja'] = $dt_pegawai->level_unit_kerja;
        }

        $param_rekan['where']['pegawai.id_pegawai_atasan_langsung'] = $dt_pegawai->id_pegawai_atasan_langsung;
        
        $dt_rekan = $this->Pegawai_model->get($param_rekan);


        $pegawai = array_merge($pegawai,$dt_rekan->result());
        $pegawai = array_merge($pegawai, $dt_bawahan->result());

        return array(
            'total' => array(
                'atasan' => !empty($dt_atasan) ? 1 : 0,
                'rekan' => $dt_rekan->num_rows(),
                'bawahan'   => $dt_bawahan->num_rows()
            ),
            'data' => array(
                'semua'   => $pegawai,
                'atasan'    => !empty($dt_atasan) ? $dt_atasan : [],
                'rekan'     => $dt_rekan->result(),
                'bawahan'   => $dt_bawahan->result(),
            ),
            'param_rekan' => $param_rekan
        );
    }

    public function get($param=null)
    {

        if(!empty($param['search']))
        {
            $this->db->where("(ref_perilaku.nama_perilaku like '%".$param['search']."%' )");
        }

        if(!empty($param['where']))
        {
            $this->db->where($param['where']);
        }
        if(!empty($param['str_where']))
        {
            $this->db->where($param['str_where']);
        }
        
        if(isset($param['limit']) && isset($param['offset']))
        {
            $this->db->limit($param['limit'],$param['offset']);
        }

        $this->db->join("ekinerja_ref_perilaku ref_perilaku","ref_perilaku.id_ref_perilaku = perilaku.id_ref_prilaku","left");

        $query = $this->db->get("ekinerja_perilaku perilaku");    

        return $query;
    }

    public function get_nilai($param=null)
    {
        if(!empty($param['where']))
        {
            $this->db->where($param['where']);
        }
        if(!empty($param['str_where']))
        {
            $this->db->where($param['str_where']);
        }
        
        if(isset($param['limit']) && isset($param['offset']))
        {
            $this->db->limit($param['limit'],$param['offset']);
        }

        $query = $this->db->get("ekinerja_perilaku_nilai perilaku_nilai");    

        return $query;
    }

    public function get_kuisioner($param=null)
    {
        if(!empty($param['where']))
        {
            $this->db->where($param['where']);
        }
        if(!empty($param['str_where']))
        {
            $this->db->where($param['str_where']);
        }
        
        if(isset($param['limit']) && isset($param['offset']))
        {
            $this->db->limit($param['limit'],$param['offset']);
        }

        $this->db->join("ekinerja_ref_perilaku_aspek aspek","aspek.id_aspek = kuisioner.id_aspek","left");
        $this->db->join("ekinerja_ref_perilaku perilaku","perilaku.id_ref_perilaku = aspek.id_ref_perilaku","left");

        $this->db->order_by("aspek.id_aspek","ASC");
        $this->db->order_by("perilaku.id_ref_perilaku","ASC");

        $query = $this->db->get("ekinerja_ref_perilaku_kuisioner kuisioner");    

        return $query;
    }

    function get_role($penilai, $id_pegawai)
    {
        $this->load->model("sicerdas/Pegawai_model");
        $param_pegawai['where']['pegawai.id_pegawai'] = $id_pegawai;
        $dt_pegawai = $this->Pegawai_model->get($param_pegawai)->row();

        $role = "";
        
        if($dt_pegawai->id_pegawai_atasan_langsung == $penilai)
        {
            $role = "atasan";
        }
        else{
            $dt_bawahan = $this->db
            ->select("*, 'bawahan' as 'role' ")
            ->where("id_pegawai_atasan_langsung",$id_pegawai)
            ->where("pensiun",0)
            ->get("pegawai");

            foreach($dt_bawahan->result() as $row)
            {
                $ids[] = $row->id_pegawai;
            }

            if(in_array($penilai,$ids))
            {
                $role = "bawahan";
            }
            else{
                $role = "rekan";   
            }
        }

        return $role;
    }

    public function get_bobot($role,$user_id=null)
    {
        $bobot = 0;
        if($role=="atasan") { // yang menilai atasan
            $bobot = 0.6;
        }
        else{
            if($user_id)
            {
                $dt_pegawai = $this->getPegawai($user_id);
                $total = $dt_pegawai['total']['bawahan'] + $dt_pegawai['total']['rekan'];
                if($total>0)
                {
                    $bobot = (0.4 / $total);
                }
                else{
                    $bobot = 0.4;
                }
            }
            else{
                $bobot = (0.4 / 3);
            }
        }

        return $bobot;
    }

    public function status_penilaian($id_skp,$role,$user_id,$bulan,$tahun)
    {
        $this->db->where("bulan",$bulan);
        $this->db->where("tahun",$tahun);
        $this->db->where("id_skp",$id_skp);
        $this->db->select("count(*) as 'jumlah', role ");
        $this->db->group_by("role");
        $res = $this->db->get("ekinerja_perilaku_nilai")->result();

        $total_role = array();
        $total = 0;
        foreach($res as $row)
        {
            $total_role[$row->role] = (int)$row->jumlah;
            $total += (int)$row->jumlah;
        }


        $status = false;

        if($total<4){
            

            $dt_pegawai = $this->getPegawai($user_id);
            $total_atasan  = $dt_pegawai['total']['atasan'];
            $total_bawahan  = $dt_pegawai['total']['bawahan'];
            $total_rekan    = $dt_pegawai['total']['rekan'];

            // role = status pegawai terhadap penilai

            if($role=="bawahan"){ 
                if(empty($total_role['atasan']))
                {
                    $status = true;
                }
            }
            else if($role == "rekan")
            {
                if(empty($total_role['rekan']))
                {
                    $status = true;
                }
                else{
                    if($total_role['rekan'] < 2)
                    {
                        $status = true;
                    }
                    else{
                        if($total_bawahan==0) // jika tidak memiliki bawahan, maka boleh dinilai oleh 3 rekan
                        {
                            $status = true; 
                        }
                    }
                }
            }
            else if($role=="atasan")
            {
                if(empty($total_role['bawahan']))
                {
                    $status = true;
                }
                else{
                    if($total_role['bawahan']>=1)
                    {
                        if($total_rekan < 2)
                        {
                            $status = true; //jika rekan < 2 , maka boleh dinilai oleh 3 bawahan
                        }
                    }
                }
            }
            

        }


        


        return $status;
    }

    public function updateRekap($id_skp, $tahun, $bulan)
    {
        $this->db->where("bulan",$bulan);
        $this->db->where("tahun",$tahun);
        $this->db->where("id_skp",$id_skp);
        $this->db->select("sum(nilai) as 'total' ");
        $rs = $this->db->get("ekinerja_perilaku_nilai")->row();

        $hasil = ($rs && $rs->total) ? $rs->total : 0;


        $this->db->where("bulan",$bulan);
        $this->db->where("tahun",$tahun);
        $this->db->where("id_skp",$id_skp);
        $cek = $this->db->get("ekinerja_perilaku_rekap");

        $this->db->set("hasil",$hasil);
        if($cek->num_rows()==0)
        {
            $this->db->set("bulan",$bulan);
            $this->db->set("tahun",$tahun);
            $this->db->set("id_skp",$id_skp);
            $this->db->insert("ekinerja_perilaku_rekap");
        }
        else{
            $this->db->where("id_rekap",$cek->row()->id_rekap);
            $this->db->update("ekinerja_perilaku_rekap");
        }
    }

    public function getCapaian($id_skp)
    {
        $this->db->where("id_skp",$id_skp);
        $this->db->select("avg(hasil) as 'hasil' ");
        $res = $this->db->get("ekinerja_perilaku_rekap")->row();

        

        if($res && $res->hasil)
        {
            return $res->hasil;
        }
        else{
            return 0;
        }
    }

    public function getSummary($param)
    {
        if(!empty($param['where']))
        {
            $this->db->where($param['where']);
        }
        if(!empty($param['str_where']))
        {
            $this->db->where($param['str_where']);
        }
        
        if(isset($param['limit']) && isset($param['offset']))
        {
            $this->db->limit($param['limit'],$param['offset']);
        }

        $select = "avg(hasil) as 'hasil' ";


        $this->db->join("ekinerja_skp skp","skp.id_skp = rekap.id_skp","left");
        $this->db->join("pegawai","pegawai.id_pegawai = skp.id_pegawai","left");

        if(!empty($param['bulan']))
        {
            if(is_array($param['bulan']))
            {
                $this->db->where_in("rekap.bulan",$param['bulan']);
            }
            else{
                $this->db->where("reka[.bulan",$param['bulan']);
            }
        }

        if(!empty($param['group_by']))
        {
            if($param['group_by'] == "ASN")
            {
                $this->db->join("ref_unit_kerja","ref_unit_kerja.id_unit_kerja = pegawai.id_unit_kerja","left");
                $select .= ", skp.id_pegawai, pegawai.nama_lengkap, pegawai.nip, pegawai.jabatan,ref_unit_kerja.nama_unit_kerja" ;
                $this->db->group_by("skp.id_pegawai");
            }
        }

        $this->db->select($select);
        $query = $this->db->get("ekinerja_perilaku_rekap rekap");   
        return $query;
    }

    public function getAspek()
    {
        $this->db->order_by("id_ref_perilaku","ASC");
        $this->db->order_by("id_aspek","ASC");
        $res = $this->db->get("ekinerja_ref_perilaku_aspek");
        return $res;
    }


    public function getContent($id_skp)
    {
        
        $offset = 0;
        $param = array();

        $data = array();

        $param['where']['perilaku.id_skp'] = $id_skp;

        $result = $this->Perilaku_model->get($param)->result();

        $catatan = '';

        $aspek = array();
        $dt_aspek = $this->Perilaku_model->getAspek()->result();
        foreach($dt_aspek as $row)
        {
            $aspek[$row->id_ref_perilaku][] = $row->nama_aspek;
        }

        

        $content = '';
        foreach($result as $key=>$row)
        {
            $ekspektasi = $row->ekspektasi;
            if($this->input->post("verifikasi"))
            {
                $ekspektasi = '
                    <input type="text" class="form-control" placeholder="Ekspektasi" name="umpan_balik[perilaku]['.$row->id_perilaku.']" />
                ';
            }

            $nama_perilaku = $row->nama_perilaku;
            $nama_aspek = implode("</li><li>",$aspek[$row->id_ref_perilaku]);

            $nama_perilaku .= "<br><ul><li>$nama_aspek</li></ul>";
            
            $content .= '
                <tr>
                    <td width="5%">'.($offset+1).'</td>
                    <td width="40%">'.$nama_perilaku.'</td>
                    <td width="26%">'.$ekspektasi.'</td>
                </tr>
            ';

            $offset++;
        }

        if(!$result)
        {
            $content = '<tr><td colspan="3" align="center">-Belum ada data-</td></tr>';
        }

        return $content;
    }

    
}