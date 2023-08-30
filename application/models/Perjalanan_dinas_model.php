<?php
class Perjalanan_dinas_model extends CI_Model
{
    public function insert($data)
    {
        $this->db->insert('perjalanan_dinas', $data);
        return $this->db->insert_id();
    }

    public function get_ref_file()
    {
        return $this->db->get('perjalanan_dinas_ref_file')->result();
    }
    public function get_all()
    {
        return $this->db->get('perjalanan_dinas')->result();
    }
    public function get_all_ttd()
    {
        $this->db->join('pegawai', 'pegawai.id_pegawai = perjalanan_dinas_ttd.id_pegawai', 'left');
        return $this->db->get('perjalanan_dinas_ttd')->result();
    }

    public function update($data, $id_perjalanan_dinas)
    {
        return $this->db->update('perjalanan_dinas', $data, array('id_perjalanan_dinas' => $id_perjalanan_dinas));
    }
    public function update_file($data, $id_perjalanan_dinas_file)
    {
        return $this->db->update('perjalanan_dinas_file', $data, array('id_perjalanan_dinas_file' => $id_perjalanan_dinas_file));
    }
    public function get_by_id($id_perjalanan_dinas)
    {
        $this->db->join('ref_unit_kerja', 'ref_unit_kerja.id_unit_kerja = perjalanan_dinas.id_unit_kerja');
        $this->db->join('ref_skpd', 'ref_skpd.id_skpd = ref_unit_kerja.id_skpd');
        return $this->db->get_where('perjalanan_dinas', array('id_perjalanan_dinas' => $id_perjalanan_dinas))->row();
    }
    public function clear_pembiayaan($id_perjalanan_dinas)
    {
        return $this->db->delete('perjalanan_dinas_pembiayaan', array('id_perjalanan_dinas' => $id_perjalanan_dinas));
    }
    public function get_pembiayaan_by_id($id_perjalanan_dinas_pembiayaan)
    {
        $this->db->join('pegawai', 'pegawai.id_pegawai = perjalanan_dinas_pembiayaan.id_pegawai', 'left');
        $this->db->select('*,perjalanan_dinas_pembiayaan.jenis_pegawai as jenis_pegawai_p');
        return $this->db->get_where('perjalanan_dinas_pembiayaan', array('id_perjalanan_dinas_pembiayaan' => $id_perjalanan_dinas_pembiayaan))->row();
    }
    public function insert_pembiayaan($data, $id_perjalanan_dinas)
    {
        $this->db->set('id_perjalanan_dinas', $id_perjalanan_dinas);
        $this->db->insert('perjalanan_dinas_pembiayaan', $data);
        return $this->db->insert_id();
    }
    public function insert_file($data, $id_perjalanan_dinas)
    {
        $this->db->set('id_perjalanan_dinas', $id_perjalanan_dinas);
        $this->db->insert('perjalanan_dinas_file', $data);
        return $this->db->insert_id();
    }

    public function get_pembiayaan($id_perjalanan_dinas)
    {
        $this->db->join('pegawai', 'pegawai.id_pegawai = perjalanan_dinas_pembiayaan.id_pegawai', 'left');
        $this->db->join('pegawai as pegawai_atasan', 'pegawai_atasan.id_pegawai = perjalanan_dinas_pembiayaan.id_pegawai_atasan', 'left');
        $this->db->select('pegawai.*,perjalanan_dinas_pembiayaan.*,perjalanan_dinas_pembiayaan.jenis_pegawai as jenis_pegawai_p,pegawai_atasan.nama_lengkap as nama_lengkap_atasan');
        return $this->db->get_where('perjalanan_dinas_pembiayaan', array('id_perjalanan_dinas' => $id_perjalanan_dinas))->result();
    }
    public function get_file($id_perjalanan_dinas)
    {
        return $this->db->get_where('perjalanan_dinas_file', array('id_perjalanan_dinas' => $id_perjalanan_dinas))->result();
    }
    public function get_files($id_perjalanan_dinas)
    {
        $pembiayaan = $this->get_pembiayaan($id_perjalanan_dinas);
        $file = $this->get_file($id_perjalanan_dinas);
        $ref_file = $this->get_ref_file();
        $files = array();

        foreach ($ref_file as $r) {
          $files[] = array('label'=>$r->label,'type'=>'static');
        }
        
        foreach ($pembiayaan as $k => $p) {
          $nama_peg = !empty($p->id_pegawai) ? $p->nama_lengkap : $p->nama_pegawai;
          $files[] = array('label'=>"Fakta Integritas $nama_peg",'type'=>'static');
          $files[] = array('label'=>"Surat Perintah $nama_peg",'type'=>'static');
        }

        
        foreach ($file as $f) {
          foreach ($ref_file as $r) {
            if ($f->nama_file == $r->label) {
              continue (2);
            }
          }

          foreach ($pembiayaan as $k => $p) {
            $nama_peg = !empty($p->id_pegawai) ? $p->nama_lengkap : $p->nama_pegawai;
            if ($f->nama_file == "Fakta Integritas $nama_peg") {
              continue (2);
            }
            if ($f->nama_file == "Surat Perintah $nama_peg") {
              continue (2);
            }
          }
          
          $files[] = array('label'=>$f->nama_file,'type'=>'dynamic');
        }
        return $files;
    }


    public function get_ttd($kode)
    {
        $this->db->join('pegawai', 'pegawai.id_pegawai = perjalanan_dinas_ttd.id_pegawai', 'left');
        return $this->db->get_where('perjalanan_dinas_ttd', array('kode' => $kode))->row();
    }

    public function get_file_by_name($name, $id_perjalanan_dinas)
    {
        return $this->db->get_where('perjalanan_dinas_file', array('nama_file' => $name, 'id_perjalanan_dinas' => $id_perjalanan_dinas))->row();
    }
    
    public function get_by_pegawai($id_pegawai='', $bulan = '', $tahun = '')
    {
        if ($bulan !== '') {
            $this->db->where('MONTH(tanggal)', $bulan);
        }
        if ($tahun !== '') {
            $this->db->where('YEAR(tanggal)', $tahun);
        }
        if ($id_pegawai !== '') {
            $this->db->where('id_pegawai', $id_pegawai);
        }
        $this->db->where('status_verifikasi', 'sudah_diverifikasi');
        $this->db->join('perjalanan_dinas','perjalanan_dinas.id_perjalanan_dinas = perjalanan_dinas_pembiayaan.id_perjalanan_dinas');
        $this->db->join('ref_unit_kerja','ref_unit_kerja.id_unit_kerja = perjalanan_dinas.id_unit_kerja');
        $ajuan = $this->db->get('perjalanan_dinas_pembiayaan')->result();
        return $ajuan;
    }

    public function get_by_unit_kerja($id_unit_kerja='', $bulan = '', $tahun = '',$jenis_perjalanan='')
    {
        if ($bulan !== '') {
            $this->db->where('MONTH(tanggal)', $bulan);
        }
        if ($tahun !== '') {
            $this->db->where('YEAR(tanggal)', $tahun);
        }
        if ($id_unit_kerja !== '') {
            $this->db->where('id_unit_kerja', $id_unit_kerja);
        }
        if ($jenis_perjalanan !== '') {
            $this->db->group_start();
            $this->db->where('jenis_perjalanan', $jenis_perjalanan);
            $this->db->or_where('sub_jenis_perjalanan', $jenis_perjalanan);
            $this->db->group_end();
        }
        $this->db->where('status_verifikasi', 'sudah_diverifikasi');
        $ajuan = $this->db->get('perjalanan_dinas')->result();
        return $ajuan;
    }

    public function get_per_bagian($bulan, $tahun)
    {


        $this->db->group_start();
        $this->db->where('level_unit_kerja', 1);
        $this->db->or_where('level_unit_kerja', 2);
        $this->db->group_end();
        $data['bagian'] = $this->db->get_where('ref_unit_kerja', array('id_skpd' => 1))->result();
        $jumlah_bagian = array();
        foreach ($data['bagian'] as $k => $b) {
            $this->db->where('MONTH(tanggal)', $bulan);
            $this->db->where('YEAR(tanggal)', $tahun);
            $this->db->where('status_verifikasi', 'sudah_diverifikasi');
            $ajuan = $this->db->get_where('perjalanan_dinas', array('id_unit_kerja' => $b->id_unit_kerja))->result();
            $total_bagian = 0;
            foreach ($ajuan as $a) {
                $jumlah_transport = 0;
                $jumlah_refresentasi = 0;
                $jumlah_uh = 0;
                $jumlah_total_uh = 0;
                $jumlah_bp = 0;
                $jumlah_total_bp = 0;
                $jumlah_total = 0;
                $pembiayaan =  $this->perjalanan_dinas_model->get_pembiayaan($a->id_perjalanan_dinas);
                foreach ($pembiayaan as $kp => $p) {
                    $jumlah_uh += $p->nominal_uh;
                    $jumlah_total_uh += ($p->nominal_uh * $p->volume_uh);
                    $jumlah_bp += $p->nominal_bp;
                    $jumlah_total_bp += ($p->nominal_bp * $p->volume_bp);
                    if ($kp == 0) {
                        $total = ($p->nominal_bp * $p->volume_bp) + ($p->nominal_uh * $p->volume_uh) + $a->biaya_transport + $a->uang_refresentasi;
                        $jumlah_transport += $a->biaya_transport;
                        $jumlah_refresentasi += $a->uang_refresentasi;
                    } else {
                        $total = ($p->nominal_bp * $p->volume_bp) + ($p->nominal_uh * $p->volume_uh);
                    }
                    $jumlah_total += $total;
                }
                $total_bagian += $jumlah_total;
                $jumlah_bagian[$b->id_unit_kerja][] = array('nominal' => $jumlah_total, 'id_perjalanan_dinas' => $a->id_perjalanan_dinas);
            }
        }
        $biggest_id = 0;
        $biggest_value = 0;

        foreach ($jumlah_bagian as $k => $j) {
            $c = count($j);
            if ($c > $biggest_value) {
                $biggest_id = $k;
                $biggest_value = $c;
            }
        }

        $total_row = count($jumlah_bagian[$biggest_id]);
        for ($i = 0; $i < count($jumlah_bagian[$biggest_id]); $i++) {

            foreach ($data['bagian'] as $k => $b) {
                if (empty($jumlah_bagian[$b->id_unit_kerja][$i])) {
                    $jumlah_bagian[$b->id_unit_kerja][$i] = array('nominal' => 0, 'id_perjalanan_dinas' => 0);
                }
            }
        }

        $res = array();

        $res['jumlah_bagian'] = $jumlah_bagian;
        $res['total_row'] = $total_row;
        return $res;
    }

    public function cek_verifikasi_file($id_perjalanan_dinas){
        $count = count($this->get_files($id_perjalanan_dinas));
        $get = $this->db->get_where('perjalanan_dinas_file',array('id_perjalanan_dinas'=>$id_perjalanan_dinas,'status_verifikasi'=>'sudah_diverifikasi'))->num_rows();
        if($get!==$count){
            return false;
        }else{
            return true;
        }
    }

    public function list_pegawai($id_unit_kerja){
        $this->db->join('ref_unit_kerja','ref_unit_kerja.id_unit_kerja = pegawai.id_unit_kerja');
        $this->db->join('ref_unit_kerja as unit_kerja_induk','unit_kerja_induk.id_unit_kerja = ref_unit_kerja.id_induk');
        $this->db->group_start();
        $this->db->where('ref_unit_kerja.id_unit_kerja',$id_unit_kerja);
        $this->db->or_where('unit_kerja_induk.id_unit_kerja',$id_unit_kerja);
        $this->db->group_end();
        $this->db->order_by('nama_lengkap');
        $res = $this->db->get_where('pegawai',array('pensiun'=>0))->result();
        return $res;
    }
}
