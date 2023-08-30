<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kinerja_utama_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }


    public function get($param=null)
    {

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

        // cascading
        $this->db->join("ekinerja_cascading cascading","cascading.id_cascading = kinerja_utama.id_cascading","left");

        // pegawai
        $this->db->join("pegawai","pegawai.id_pegawai = cascading.id_pegawai","left");

        //skp
        $this->db->join("ekinerja_skp skp","kinerja_utama.id_skp = skp.id_skp","left");
        $this->db->join("pegawai atasan","atasan.id_pegawai = skp.id_pegawai_atasan","left");
        $this->db->join("ref_unit_kerja unit_kerja","unit_kerja.id_unit_kerja = pegawai.id_unit_kerja","left");
        $this->db->join("ref_unit_kerja unit_kerja_atasan","unit_kerja_atasan.id_unit_kerja = atasan.id_unit_kerja","left");
        

        // renstra
        $this->db->join("sc_renstra_sasaran sasaran","sasaran.id_sasaran_renstra = cascading.id_sasaran_renstra","left");
        $this->db->join("sc_renstra_sasaran_indikator sasaran_indikator","sasaran_indikator.id_indikator_sasaran_renstra = cascading.id_indikator_sasaran_renstra","left");
        $this->db->join("ref_satuan sasaran_satuan","sasaran_satuan.id_satuan = sasaran_indikator.satuan","left");

        // program
        /* $this->db->join("sc_renstra_program_indikator program_indikator","program_indikator.id_indikator_program_renstra = cascading.id_indikator_program_renstra","left");
        $this->db->join("ref_satuan program_satuan","program_satuan.id_satuan = program_indikator.satuan","left");
        
        $this->db->join("sc_rpjmd_program_indikator program_indikator_rpjmd","program_indikator_rpjmd.id_indikator_program_rpjmd = program_indikator.id_indikator_program_rpjmd","left");

        $this->db->join("sc_renstra_program program","program.id_program_renstra = cascading.id_program_renstra","left");
        $this->db->join("sc_rpjmd_program program_rpjmd","program_rpjmd.id_program_rpjmd = program.id_program_rpjmd","left");
        $this->db->join("sc_ref_program ref_program","ref_program.id_ref_program = program_rpjmd.id_ref_program","left"); */

        //instruksi
        $this->db->join("ekinerja_instruksi instruksi","instruksi.id_instruksi = cascading.id_instruksi","left");
        $this->db->join("ref_satuan instruksi_satuan","instruksi_satuan.id_satuan = instruksi.satuan","left");
        $this->db->join("ekinerja_instruksi instruksi_atasan","instruksi_atasan.id_instruksi = instruksi.id_instruksi_atasan","left");

        // kegiatan
        $this->db->join("sc_renstra_kegiatan kegiatan","kegiatan.id_kegiatan = cascading.id_kegiatan","left");
        $this->db->join("sc_ref_kegiatan ref_kegiatan","ref_kegiatan.id_ref_kegiatan = kegiatan.id_ref_kegiatan","left");

        $this->db->join("sc_renstra_kegiatan_indikator kegiatan_indikator","kegiatan_indikator.id_indikator_kegiatan = cascading.id_kegiatan_indikator","left");
        $this->db->join("ref_satuan kegiatan_satuan","kegiatan_satuan.id_satuan = kegiatan_indikator.satuan","left");

        // sub kegiatan
        $this->db->join("sc_renja_sub_kegiatan sub_kegiatan","sub_kegiatan.id_sub_kegiatan_renja = cascading.id_sub_kegiatan_renja","left");
        $this->db->join("sc_ref_sub_kegiatan ref_sub_kegiatan","ref_sub_kegiatan.id_sub_kegiatan = sub_kegiatan.id_ref_sub_kegiatan","left");

        $this->db->join("sc_renja_sub_kegiatan_indikator sub_kegiatan_indikator","sub_kegiatan_indikator.id_indikator_sub_kegiatan = cascading.id_sub_kegiatan_indikator","left");
        $this->db->join("ref_satuan sub_kegiatan_satuan","sub_kegiatan_satuan.id_satuan = sub_kegiatan_indikator.satuan","left");

        $this->db->select("kinerja_utama.*, cascading.*, pegawai.*, kinerja_utama.rencana_hasil_kerja,
            sasaran.nama_sasaran_renstra, sasaran.id_skpd,
            
            

            ref_kegiatan.nama_kegiatan,
            kegiatan_indikator.nama_indikator_kegiatan,

            ref_sub_kegiatan.nama_sub_kegiatan,
            sub_kegiatan_indikator.nama_indikator_sub_kegiatan,
            
            instruksi.nama_instruksi, 
            instruksi_satuan.satuan as 'instruksi_satuan',
            instruksi.target as 'instruksi_target',
            instruksi_atasan.nama_instruksi as 'nama_instruksi_atasan',
            

            sasaran_indikator.nama_indikator_sasaran_renstra, 
            sasaran_satuan.satuan as 'sasaran_satuan',
            sasaran_indikator.target_tahun_1 as 'sasaran_target_tahun_1',
            sasaran_indikator.target_tahun_2 as 'sasaran_target_tahun_2',
            sasaran_indikator.target_tahun_3 as 'sasaran_target_tahun_3',
            sasaran_indikator.target_tahun_4 as 'sasaran_target_tahun_4',
            sasaran_indikator.target_tahun_5 as 'sasaran_target_tahun_5',

            kegiatan_satuan.satuan as 'kegiatan_satuan',
            kegiatan_indikator.target_tahun_1 as 'kegiatan_target_tahun_1',
            kegiatan_indikator.target_tahun_2 as 'kegiatan_target_tahun_2',
            kegiatan_indikator.target_tahun_3 as 'kegiatan_target_tahun_3',
            kegiatan_indikator.target_tahun_4 as 'kegiatan_target_tahun_4',
            kegiatan_indikator.target_tahun_5 as 'kegiatan_target_tahun_5',

            sub_kegiatan_satuan.satuan as 'sub_kegiatan_satuan',
            sub_kegiatan_indikator.target as 'sub_kegiatan_target',

            unit_kerja.nama_unit_kerja,
            atasan.nama_lengkap as 'nama_lengkap_atasan',
            atasan.nip as 'nip_atasan',
            atasan.jabatan as 'jabatan_atasan',
            atasan.pangkat as 'pangkat_atasan',
            unit_kerja_atasan.nama_unit_kerja as 'nama_unit_kerja_atasan',
            
            skp.tahun, skp.tahun_desc, skp.id_skp
            
        ");

        /* ref_program.nama_program,
            program_indikator_rpjmd.nama_indikator_program_rpjmd,
            
            program_satuan.satuan as 'program_satuan',
            program_indikator.target_tahun_1 as 'program_target_tahun_1',
            program_indikator.target_tahun_2 as 'program_target_tahun_2',
            program_indikator.target_tahun_3 as 'program_target_tahun_3',
            program_indikator.target_tahun_4 as 'program_target_tahun_4',
            program_indikator.target_tahun_5 as 'program_target_tahun_5', */


        $this->db->order_by("cascading.id_pegawai","ASC");
        $this->db->order_by("cascading.id_instruksi","ASC");
        $this->db->order_by("cascading.id_sub_kegiatan_indikator","ASC");
        $this->db->order_by("cascading.id_sub_kegiatan_renja","ASC");
        $this->db->order_by("cascading.id_kegiatan_indikator","ASC");
        $this->db->order_by("cascading.id_kegiatan","ASC");
        $this->db->order_by("cascading.id_indikator_program_renstra","ASC");
        $this->db->order_by("cascading.id_program_renstra","ASC");
        $this->db->order_by("cascading.id_indikator_sasaran_renstra","ASC");
        $this->db->order_by("cascading.id_sasaran_renstra","ASC"); 

        $query = $this->db->get("ekinerja_utama kinerja_utama");

        return $query;
    }

    
    public function getContent($detail)
    {
        $this->load->model("kinerja/Laporan_model");
        $role_pimpinan = ($detail->kepala_skpd == "Y" && in_array($detail->jenis_skpd,['skpd','kecamatan']));
        $tahun = $detail->tahun;

        $offset = 0;
        $param = array();

        $data = array();

        $param['where']['kinerja_utama.id_skp'] = $detail->id_skp;

        $result = $this->Kinerja_utama_model->get($param)->result();

        $catatan = '';

        

        $content = '';


        if($this->input->post("evaluasi")){
            $param_summary['where']['capaian.id_skp'] = $detail->id_skp;
            $param_summary['group_by'] = "kinerja_utama";
    
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
                $dt_capaian[$s->id_kinerja_utama] = $s;
            }
        }



        foreach($result as $key=>$row)
        {
            $token = md5("K".$row->id_kinerja_utama);
            if($this->input->post("verifikasi"))
            {
                $catatan = '
                <td>
                    <input type="text" class="form-control" placeholder="Umpan balik" name="umpan_balik[kinerja_utama]['.$row->id_kinerja_utama.']" />
                </td>';
            }
            else if($this->input->post("evaluasi"))
            {

                $field = ($triwulan) ? "umpan_balik_".$triwulan : "umpan_balik";
                $umpan_balik = ($row->$field);
                $catatan = '
                <td>
                    <input value="'.$umpan_balik.'" type="text" class="form-control" placeholder="Umpan balik" name="umpan_balik[kinerja_utama]['.$row->id_kinerja_utama.']" />
                </td>';
            }
            else if($this->input->post("renaksi"))
            {
                $catatan = '
                <td>
                    <a href="'.base_url().'kinerja/renaksi/detail?utoken='.$token.'" class="btn btn-outline btn-primary" ><i class="icon-share-alt"></i> Detail</a>    
                </td>';
            }

            $realisasi = '';
            if($this->input->post("evaluasi"))
            {
                $capaian = 0;

                if(!empty($dt_capaian[$row->id_kinerja_utama]))
                {
                    $capaian = number_format($dt_capaian[$row->id_kinerja_utama]->capaian,2);
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
                    <td>'.$row->nama_sasaran_renstra.'</td>
                    <td>'.$row->nama_indikator_sasaran_renstra.'</td>
                    <td>'.$row->$target.'</td>
                    <td>'.$row->sasaran_satuan.'</td>
                    <td>'.$perspektif.'</td>
                    '.$realisasi.'
                    '.$catatan.'
                </tr>
                ';

            }
            else{

                $indikator_atasan = '';
                $nama_indikator = '';
                $kegiatan = '';
                if($row->flag=="kegiatan")
                {
                    $indikator_atasan = $row->nama_indikator_sasaran_renstra;
                    $kegiatan = $row->nama_kegiatan;
                    $nama_indikator = $row->nama_indikator_kegiatan;
                    $target = "kegiatan_target_tahun_" . $tahun;
                    $satuan = "kegiatan_satuan";
                }
                if($row->flag=="sub_kegiatan")
                {
                    $indikator_atasan = $row->nama_indikator_kegiatan;
                    $kegiatan = $row->nama_sub_kegiatan;
                    $nama_indikator = $row->nama_indikator_sub_kegiatan;
                    $target = "sub_kegiatan_target";
                    $satuan = "sub_kegiatan_satuan";
                }
                
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
                    <td>'.$indikator_atasan.'</td>
                    <td>'.$row->rencana_hasil_kerja.'</td>
                    <td>'.$aspek.'</td>
                    <td>'.$kegiatan.'</td>
                    <td>'.$nama_indikator.'</td>
                    <td>'.$row->$target.'</td>
                    <td>'.$row->$satuan.'</td>
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