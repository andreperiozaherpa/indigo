<?php
class Rapat_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->db_dprd = $this->load->database('dprd', TRUE);
    }
    public function get_all($peserta = false,$data_filter='')
    {
        if(!empty($data_filter)){
            foreach($data_filter as $key => $value){
                if($key=='tanggal_awal'){
                    $this->db_dprd->where('tanggal >=',$value);
                }elseif($key=='tanggal_akhir'){
                    $this->db_dprd->where('tanggal <=',$value);
                }else{
                    $this->db_dprd->like($key,$value);
                }
            }
        }
        $get = $this->db_dprd->get('rapat')->result();
        if ($peserta) {
            foreach ($get as $k => $g) {
                $list_peserta = $this->get_peserta($g->id_rapat);
                $n = 1;
                $peserta_thumb = [];
                foreach ($list_peserta as $p) {
                    if (count($peserta_thumb) <= 4) {
                        $peserta_thumb[] = ['foto_pegawai' => $p->foto_pegawai, 'nama_lengkap' => $p->nama_lengkap];
                        $n++;
                    } else {
                        break;
                    }
                }
                $get[$k]->peserta_thumb = $peserta_thumb;
                $get[$k]->jumlah_peserta = count($list_peserta);
            }
        }
        return $get;
    }
    public function get_by_id($id_rapat)
    {
        $this->db_dprd->where('id_rapat', $id_rapat);
        $get = $this->db_dprd->get('rapat')->row();
        return $get;
    }
    public function insert($data)
    {
        $this->db_dprd->set('waktu_input', date('Y-m-d H:i:s'));
        $in = $this->db_dprd->insert('rapat', $data);
        if ($in) {
            return $this->db_dprd->insert_id();
        } else {
            return false;
        }
    }
    public function update($data, $id_rapat)
    {
        $this->db_dprd->set('waktu_update', date('Y-m-d H:i:s'));
        $in = $this->db_dprd->update('rapat', $data, ['id_rapat' => $id_rapat]);
        if ($in) {
            return true;
        } else {
            return false;
        }
    }
    public function delete($id_rapat){
        $this->db_dprd->delete('rapat',['id_rapat'=>$id_rapat]);
        $this->db_dprd->delete('rapat_peserta',['id_rapat'=>$id_rapat]);
        $this->db_dprd->delete('rapat_notulensi',['id_rapat'=>$id_rapat]);
        return true;
    }
    public function get_peserta($id_rapat)
    {
        $this->db_dprd->join('pegawai', 'pegawai.id_pegawai = rapat_peserta.id_pegawai');
        $get = $this->db_dprd->get_where('rapat_peserta', ['id_rapat' => $id_rapat])->result();
        return $get;
    }
    public function insert_peserta($id_rapat, $id_pegawai)
    {
        $pegawai = $this->db_dprd->get_where('pegawai', ['id_pegawai' => $id_pegawai])->row();
        if ($pegawai) {
            $in = $this->db_dprd->insert('rapat_peserta', ['id_rapat' => $id_rapat, 'id_pegawai' => $id_pegawai, 'jabatan' => $pegawai->jabatan]);
            if ($in) {
                return $this->db_dprd->insert_id();
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    public function clear_peserta($id_rapat)
    {
        return $this->db_dprd->delete('rapat_peserta', ['id_rapat' => $id_rapat]);
    }
    public function save_notulen($id_rapat, $notulensi, $lampiran)
    {
        $cek = $this->get_notulen($id_rapat);
        $this->db_dprd->set('notulensi', $notulensi);
        $this->db_dprd->set('id_rapat', $id_rapat);
        $this->db_dprd->set('lampiran', $lampiran);
        $this->db_dprd->set('tanggal', date('Y-m-d'));
        $this->db_dprd->set('jam', date('H:i:s'));
        if ($cek) {
            $this->db_dprd->where('id_rapat_notulensi', $cek->id_rapat_notulensi);
            $this->db_dprd->update('rapat_notulensi');
        } else {
            $this->db_dprd->insert('rapat_notulensi');
        }
        return true;
    }

    public function get_notulen($id_rapat)
    {
        $get = $this->db_dprd->get_where('rapat_notulensi', ['id_rapat' => $id_rapat])->row();
        return $get;
    }
}
