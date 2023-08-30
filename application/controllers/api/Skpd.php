<?php
class SKPD extends CI_Controller{
    public function index(){
        $this->db->group_start();
            $this->db->or_where('jenis_skpd','kecamatan');
            $this->db->or_where('jenis_skpd','skpd');
        $this->db->group_end();
        $skpd = $this->db->get('ref_skpd')->result();
        // print_r($skpd);die;
        echo "<table>";
        foreach($skpd as $skpd_detail){
            if($skpd_detail->jenis_skpd=='kecamatan'){
                $simple_alias = str_replace('kecamatan','kec_',str_replace(' ','',strtolower($skpd_detail->nama_skpd)));
            }else{
                $simple_alias = str_replace(' ','',strtolower($skpd_detail->nama_skpd_alias));
            }

            echo "<tr>
            
            <td>$skpd_detail->id_skpd</td>
            <td>$skpd_detail->nama_skpd</td>
            <td>$simple_alias</td>
            </tr>";

        }
        echo "</table>";
    }
}