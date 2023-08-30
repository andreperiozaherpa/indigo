<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Instruksi_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }


    public function get($param=null)
    {

        if(!empty($param['search']))
        {
            $this->db->where("(instruksi.nama_instruksi like '%".$param['search']."%' )");
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

        $this->db->join("ref_satuan satuan","satuan.id_satuan = instruksi.satuan","left");
        
        $this->db->select("instruksi.*,
        satuan.satuan as 'satuan_desc' ");

        $query = $this->db->get("ekinerja_instruksi instruksi");    

        return $query;
    }

    public function get_instruksi_khusus($param=null)
    {

        if(!empty($param['search']))
        {
            $this->db->where("(instruksi.nama_instruksi like '%".$param['search']."%' )");
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
        $this->db->join("ekinerja_skp skp","skp.id_skp = instruksi_khusus.id_skp","left");
        $this->db->join("ekinerja_instruksi instruksi","instruksi.id_instruksi = instruksi_khusus.id_instruksi","left");
        $this->db->join("ref_satuan satuan","satuan.id_satuan = instruksi.satuan","left");
        $this->db->join("ekinerja_instruksi instruksi_atasan","instruksi_atasan.id_instruksi = instruksi.id_instruksi_atasan","left");

        //skp
        $this->db->join("pegawai","pegawai.id_pegawai = skp.id_pegawai","left");
        $this->db->join("pegawai atasan","atasan.id_pegawai = skp.id_pegawai_atasan","left");

        $this->db->join("ref_unit_kerja unit_kerja","unit_kerja.id_unit_kerja = pegawai.id_unit_kerja","left");
        $this->db->join("ref_unit_kerja unit_kerja_atasan","unit_kerja_atasan.id_unit_kerja = atasan.id_unit_kerja","left");

        
        $this->db->select("instruksi_khusus.*, instruksi.*, skp.*,skp.id_skp,
            satuan.satuan as 'satuan_desc',
            instruksi_atasan.nama_instruksi as 'nama_instruksi_atasan',
            pegawai.*,unit_kerja.*,
            atasan.nama_lengkap as 'nama_lengkap_atasan',
            atasan.nip as 'nip_atasan',
            atasan.jabatan as 'jabatan_atasan',
            atasan.pangkat as 'pangkat_atasan',
            unit_kerja_atasan.nama_unit_kerja as 'nama_unit_kerja_atasan'
        ");

        $query = $this->db->get("ekinerja_instruksi_khusus instruksi_khusus");    

        return $query;
    }
    
    
    public function insert($data)
    {
       $this->db->insert("ekinerja_instruksi",$data);
    }
    public function update($data,$id)
    {
       $this->db->where("id_instruksi",$id);
       $this->db->update("ekinerja_instruksi",$data);
    }
    public function delete($id)
    {

        $this->load->model("kinerja/Cascading");
        $this->Cascading->delete_instruksi($id);

        $this->db
        ->where("id_instruksi",$id)
        ->where("flag","instruksi")
        ->delete("sc_cascading");

        $status = $this->db->where("id_instruksi",$id)->delete("ekinerja_instruksi");
        return $status;
    }

    public function getContent($detail)
    {
        $this->load->model("kinerja/Laporan_model");
        
        $role_pimpinan = ($detail->kepala_skpd == "Y" && in_array($detail->jenis_skpd,['skpd','kecamatan']));
        $tahun = $detail->tahun;

        $offset = 0;
        $param = array();

        $data = array();

        $param['where']['instruksi_khusus.id_skp'] = $detail->id_skp;

        $result = $this->Instruksi_model->get_instruksi_khusus($param)->result();

        $catatan = '';

        if($this->input->post("evaluasi")){
            $param_summary['where']['capaian.id_skp'] = $detail->id_skp;
            $param_summary['group_by'] = "instruksi_khusus";
    
            $triwulan = $this->input->post("triwulan");
            if($triwulan)
            {
                if($triwulan==1)
                {
                    $param_summary['bulan'] = [1,2,3];
                }
                else if($triwulan==2)
                {
                    $param_summary['bulan'] = [4,5,6];
                }
                else if($triwulan==3)
                {
                    $param_summary['bulan'] = [7,8,9];
                }
                else if($triwulan==4)
                {
                    $param_summary['bulan'] = [10,11,12];
                }
            }
    
            $summary = $this->Laporan_model->getSummary($param_summary)->result();
    
            $dt_capaian = array();
            foreach($summary as $s)
            {
                $dt_capaian[$s->id_instruksi_khusus] = $s;
            }
        }

        $content = '';
        foreach($result as $key=>$row)
        {
            $token = md5("K".$row->id_instruksi_khusus);
            if($this->input->post("verifikasi"))
            {
                $catatan = '<td>
                    <input type="text" class="form-control" placeholder="Umpan balik" name="umpan_balik[instruksi]['.$row->id_instruksi_khusus.']" />
                </td>';
            }
            else if($this->input->post("evaluasi"))
            {
                $field = ($triwulan) ? "umpan_balik_".$triwulan : "umpan_balik";
                $umpan_balik = ($row->$field);
                $catatan = '<td>
                    <input value="'.$umpan_balik.'" type="text" class="form-control" placeholder="Umpan balik" name="umpan_balik[instruksi]['.$row->id_instruksi_khusus.']" />
                </td>';
            }
            else if($this->input->post("renaksi"))
            {
                $catatan = '
                <td>
                    <a href="'.base_url().'kinerja/renaksi/detail?itoken='.$token.'" class="btn btn-outline btn-primary" ><i class="icon-share-alt"></i> Detail</a>    
                </td>';
            }
 

            $realisasi = '';
            if($this->input->post("evaluasi"))
            {
                $capaian = 0;

                if(!empty($dt_capaian[$row->id_instruksi_khusus]))
                {
                    $capaian = number_format($dt_capaian[$row->id_instruksi_khusus]->capaian,2);
                }
                $realisasi = '<td>'.$capaian.'</td>';
            }   

            if($role_pimpinan)
            {
                $dt_perspektif = ($row->perspektif!="") ? explode(",",$row->perspektif) : [];

                $perspektif = '';
                if($dt_perspektif)
                {
                    $perspektif = '
                    <ul style="padding-left:15px">
                        <li>
                            '.implode("</li><li>",$dt_perspektif).'
                        </li>
                    </ul>';
                }


                $target = "sasaran_target_tahun_" . $tahun;
                $content .= '
                <tr>
                    <td>'.($offset+1).'</td>
                    <td>'.$row->nama_instruksi.'</td>
                    <td>'.$row->indikator_kinerja_individu.'</td>
                    <td>'.$row->target.'</td>
                    <td>'.$row->satuan_desc.'</td>
                    <td>'.$perspektif.'</td>
                    '.$realisasi.'
                    '.$catatan.'
                </tr>
                ';

            }
            else{

                $aspek = ($row->aspek!="") ? explode(",",$row->aspek) : [];

                $dt_aspek = ($row->aspek!="") ? explode(",",$row->aspek) : [];

                $aspek = '';
                if($dt_aspek)
                {
                    $aspek = '
                    <ul style="padding-left:15px">
                        <li>
                            '.implode("</li><li>",$dt_aspek).'
                        </li>
                    </ul>';
                }

                $content .= '
                <tr>
                    <td>'.($offset+1).'</td>
                    <td>'.$row->nama_instruksi_atasan.'</td>
                    <td>'.$row->nama_instruksi.'</td>
                    <td>'.$aspek.'</td>
                    <td>'.$row->indikator_kinerja_individu.'</td>
                    <td>'.$row->target.'</td>
                    <td>'.$row->satuan_desc.'</td>
                    '.$realisasi.'
                    '.$catatan.'
                </tr>';

            }

            $offset++;
        }

        if(!$result)
        {
            $content = '<tr><td colspan="8" align="center">-Belum ada data-</td></tr>';
        }

        return $content;
    }
}