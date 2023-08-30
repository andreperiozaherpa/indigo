<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Simpeg_model extends CI_Model
{

    public $search;
    public $id_kedudukan;
    public $status;

    public $id;
    public $nip;

	public function __construct()
	{
		parent::__construct();
		$this->db_simpeg = $this->load->database('simpeg', TRUE);
	}

    public function get_all()
    {
        //select
        $this->db_simpeg->select('*');

        if ($limit) {
            $this->db_simpeg->limit($limit,$offset);
        }

        $this->db_simpeg->order_by('nama_lengkap', 'asc');
        return $this->db_simpeg->get('master_orang')->result();
    }

    public function get_per_page($limit=null,$offset=0)
    {
        //select
        $this->db_simpeg->select('
            master_orang.id_orang, master_orang.nama_lengkap, master_orang.id_kartu_identitas, master_orang.no_ktp, master_orang.no_paspor, master_orang.no_sim, master_orang.pns, master_orang.foto, master_orang.nip_pns,
            master_pegawai.status_cpns_pns,
            ');

        $this->search_pegawai();

        if ($limit) {
            $this->db_simpeg->limit($limit,$offset);
        }

        $this->db_simpeg->order_by('master_orang.pns', 'DESC');
        $this->db_simpeg->order_by('master_orang.nama_lengkap', 'asc');
        $this->db_simpeg->join('master_pegawai', 'master_pegawai.id_orang = master_orang.id_orang', 'left');
        return $this->db_simpeg->get('master_orang')->result();
    }

    public function get_active()
    {
        //select
        $this->db_simpeg->select('*');

        $this->db_simpeg->order_by('nama_lengkap', 'asc');
        $this->db_simpeg->where('status', 'Y');
        return $this->db_simpeg->get('master_orang')->result();
    }

    public function get_active_pegawai()
    {
        //select
        $this->db_simpeg->select('*');

        $this->db_simpeg->order_by('nip_baru', 'asc');
        $this->db_simpeg->where('status', 'Y');
        return $this->db_simpeg->get('master_pegawai')->result();
    }

    public function get_row()
    {
        //select
        $this->db_simpeg->select('master_orang.id_orang');

        $this->search_pegawai();

        // $this->db_simpeg->join('master_pegawai', 'master_pegawai.id_orang = master_orang.id_orang', 'left');
        return $this->db_simpeg->get('master_orang')->num_rows();
    }

    public function get_by_id($id)
    {
        //select
        $this->db_simpeg->select('*');

        $this->db_simpeg->join('master_pegawai', 'master_pegawai.id_orang = master_orang.id_orang', 'left');

        return $this->db_simpeg->get_where('master_orang', array('master_orang.id_orang' => $id))->row();
    }

    public function get_by_nip($nip)
    {
        //select
        $this->db_simpeg->select('*');

        $this->db_simpeg->join('master_pegawai', 'master_pegawai.id_orang = master_orang.id_orang', 'left');

        return $this->db_simpeg->get_where('master_orang', array('master_orang.nip_pns' => $nip))->row();
    }

    public function get_recent_update($id=null)
    {
        $riwayat = array('anak','bahasa','cuti','diklat','hukuman','jabatan','kedudukan','kepanitiaan','kredit','kursus','mutasi','orangtua','organisasi','penugasan','pangkat','pendidikan','penghargaan','pernikahan','prestasi','profesi','pwk','indikator');
        $recent_update = array();
        foreach ($riwayat as $row) {
            $this->db_simpeg->select('id_pegawai');
            if ($this->router->fetch_method() == "my_profile") {
                $this->db_simpeg->where('status_verifikasi','Ditolak');
            } else {
                $this->db_simpeg->where('status_verifikasi','Proses');
            }
            
            if ($id) {
                $this->db_simpeg->where('id_pegawai',$id);
                $query = $this->db_simpeg->get('riwayat_'.$row);
                $count['riwayat_'.$row] = $query->num_rows();
            } else {
                $this->db_simpeg->group_by('id_pegawai');
                $query = $this->db_simpeg->get('riwayat_'.$row);
                $result = $query->result_array();
                $id_pegawai = array_column($result, 'id_pegawai');
                $recent_update = array_merge($recent_update,$id_pegawai);
            }
        }
        if ($id) {
            $recent_update['pangkat'] = $count['riwayat_pangkat'] + $count['riwayat_kredit'];
            $recent_update['jabatan'] = $count['riwayat_jabatan'] + $count['riwayat_mutasi'] + $count['riwayat_pwk'];
            $recent_update['pendidikan'] = $count['riwayat_pendidikan'] + $count['riwayat_profesi'];
            $recent_update['latihan'] = $count['riwayat_diklat'] + $count['riwayat_kursus'];
            $recent_update['organisasi'] = $count['riwayat_organisasi'] + $count['riwayat_penugasan'];
            $recent_update['penghargaan'] = $count['riwayat_penghargaan'] + $count['riwayat_prestasi'];
            $recent_update['absen'] = $count['riwayat_cuti'] + $count['riwayat_hukuman'];
            $recent_update['bahasa'] = $count['riwayat_bahasa'];
            $recent_update['keluarga'] = $count['riwayat_orangtua'] + $count['riwayat_pernikahan'] + $count['riwayat_anak'];
            $recent_update['kedudukan'] = $count['riwayat_kedudukan'];
            $recent_update['indikator'] = $count['riwayat_indikator'];
        } else {
            $recent_update = array_unique($recent_update);
        }
        // var_dump($recent_update); die();
        return $recent_update;
    }

    function search_pegawai()
    {
        if ($this->search) {
            $this->db_simpeg->group_start();
            $this->db_simpeg->or_like('master_orang.nama_lengkap', $this->search);
            $this->db_simpeg->or_like('master_orang.no_ktp', $this->search);
            $this->db_simpeg->or_like('master_orang.no_paspor', $this->search);
            $this->db_simpeg->or_like('master_orang.no_sim', $this->search);
            $this->db_simpeg->or_like('master_orang.nip_pns', $this->search);
            $this->db_simpeg->group_end();
        }
    }

    function where_riwayat($riwayat,$update='')
    {
        if ($update) $this->db_simpeg->where('status_update',$update);
        $this->db_simpeg->where($riwayat.'.id_pegawai',$this->id);
        $this->db_simpeg->where($riwayat.'.nip_pegawai',$this->nip);
    }

    public function get_riwayat_pangkat($update)
    {
        //select
        $this->db_simpeg->select('*');
        $this->db_simpeg->select('riwayat_pangkat.status AS status');

        $this->where_riwayat('riwayat_pangkat',$update);

        // $this->db_simpeg->join('ref_golongan', 'ref_golongan.kode_golongan = riwayat_pangkat.kode_golongan', 'left');

        $this->db_simpeg->order_by('riwayat_pangkat.tmt_pangkat', 'desc');
        return $this->db_simpeg->get('riwayat_pangkat')->result();
    }

    public function get_riwayat_kredit($update)
    {
        //select
        $this->db_simpeg->select('*');
        $this->db_simpeg->select('riwayat_kredit.status AS status');

        $this->where_riwayat('riwayat_kredit',$update);

        $this->db_simpeg->order_by('riwayat_kredit.tahun_selesai_penilaian', 'desc');
        $this->db_simpeg->order_by('riwayat_kredit.bulan_selesai_penilaian', 'desc');
        return $this->db_simpeg->get('riwayat_kredit')->result();
    }

    public function get_riwayat_jabatan($update)
    {
        //select
        $this->db_simpeg->select('*');
        $this->db_simpeg->select('riwayat_jabatan.status AS status');
        $this->db_simpeg->select('riwayat_jabatan.id_jabatan AS id_jabatan');
        $this->db_simpeg->select('riwayat_jabatan.kode_jabatan AS kode_jabatan');

        $this->where_riwayat('riwayat_jabatan',$update);

        // $this->db_simpeg->join('ref_jabatan', 'ref_jabatan.id_jabatan = riwayat_jabatan.id_ref_jabatan', 'left');
        // $this->db_simpeg->join('ref_skpd', 'ref_skpd.id_skpd = ref_jabatan.id_skpd', 'left');
        // $this->db_simpeg->join('ref_unit_kerja', 'ref_unit_kerja.id_unit_kerja = ref_jabatan.id_unit_kerja', 'left');
        // $this->db_simpeg->join('ref_eselon', 'ref_eselon.id_eselon = riwayat_jabatan.id_ref_eselon', 'left');

        $this->db_simpeg->order_by('riwayat_jabatan.tmt_berlaku', 'desc');
        return $this->db_simpeg->get('riwayat_jabatan')->result();
    }

    public function get_riwayat_mutasi($update)
    {
        //select
        $this->db_simpeg->select('*');
        $this->db_simpeg->select('riwayat_mutasi.status AS status');
        $this->db_simpeg->select('riwayat_mutasi.id_skpd AS id_skpd');
        // $this->db_simpeg->select('ref_skpd.nama_skpd AS nama_skpd');
        $this->db_simpeg->select('riwayat_mutasi.id_unit_kerja AS id_unit_kerja');
        // $this->db_simpeg->select('ref_unit_kerja.nama_unit_kerja AS nama_unit_kerja');
        // $this->db_simpeg->select('ref_skpd_asal.nama_skpd AS nama_skpd_asal');
        // $this->db_simpeg->select('ref_unit_kerja_asal.nama_unit_kerja AS nama_unit_kerja_asal');

        $this->where_riwayat('riwayat_mutasi',$update);

        // $this->db_simpeg->join('ref_skpd', 'ref_skpd.id_skpd = riwayat_mutasi.id_skpd', 'left');
        // $this->db_simpeg->join('ref_unit_kerja', 'ref_unit_kerja.id_unit_kerja = riwayat_mutasi.id_unit_kerja', 'left');
        // $this->db_simpeg->join('ref_skpd AS ref_skpd_asal', 'ref_skpd_asal.id_skpd = riwayat_mutasi.id_skpd_asal', 'left');
        // $this->db_simpeg->join('ref_unit_kerja AS ref_unit_kerja_asal', 'ref_unit_kerja_asal.id_unit_kerja = riwayat_mutasi.id_unit_kerja_asal', 'left');

        $this->db_simpeg->order_by('riwayat_mutasi.sk_tanggal', 'desc');
        return $this->db_simpeg->get('riwayat_mutasi')->result();
    }

    public function get_riwayat_pwk($update)
    {
        //select
        $this->db_simpeg->select('*');
        $this->db_simpeg->select('riwayat_pwk.status AS status');

        $this->where_riwayat('riwayat_pwk',$update);

        // $this->db_simpeg->join('ref_kpkn', 'ref_kpkn.kode_kpkn = riwayat_pwk.kode_kpkn', 'left');

        $this->db_simpeg->order_by('riwayat_pwk.tmt_pwk', 'desc');
        return $this->db_simpeg->get('riwayat_pwk')->result();
    }

    public function get_riwayat_pendidikan($update)
    {
        //select
        $this->db_simpeg->select('*');
        $this->db_simpeg->select('riwayat_pendidikan.status AS status');
        $this->db_simpeg->select('riwayat_pendidikan.id_pendidikan AS id_pendidikan');
        $this->db_simpeg->select('riwayat_pendidikan.kode_pendidikan AS kode_pendidikan');

        $this->where_riwayat('riwayat_pendidikan',$update);

        // $this->db_simpeg->join('ref_tingkatpendidikan', 'ref_tingkatpendidikan.kode_tingkatpendidikan = riwayat_pendidikan.kode_tingkatpendidikan', 'left');
        // $this->db_simpeg->join('ref_pendidikan', 'ref_pendidikan.kode_pendidikan = riwayat_pendidikan.kode_pendidikan', 'left');

        $this->db_simpeg->order_by('riwayat_pendidikan.tahun_lulus', 'desc');
        return $this->db_simpeg->get('riwayat_pendidikan')->result();
    }

    public function get_riwayat_profesi($update)
    {
        //select
        $this->db_simpeg->select('*');
        $this->db_simpeg->select('riwayat_profesi.status AS status');
        $this->db_simpeg->select('riwayat_profesi.id_profesi AS id_profesi');
        $this->db_simpeg->select('riwayat_profesi.kode_profesi AS kode_profesi');

        $this->where_riwayat('riwayat_profesi',$update);

        // $this->db_simpeg->join('ref_profesi', 'ref_profesi.kode_profesi = riwayat_profesi.kode_profesi', 'left');

        $this->db_simpeg->order_by('riwayat_profesi.tahun_lulus', 'desc');
        return $this->db_simpeg->get('riwayat_profesi')->result();
    }

    public function get_riwayat_diklat($update)
    {
        //select
        $this->db_simpeg->select('*');
        $this->db_simpeg->select('riwayat_diklat.status AS status');

        $this->where_riwayat('riwayat_diklat',$update);

        // $this->db_simpeg->join('ref_latihan', 'ref_latihan.kode_latihan = riwayat_diklat.kode_latihan', 'left');
        // $this->db_simpeg->join('ref_kompetensi', 'ref_kompetensi.kode_kompetensi = riwayat_diklat.kode_kompetensi', 'left');

        $this->db_simpeg->order_by('riwayat_diklat.tmt_berakhir', 'desc');
        return $this->db_simpeg->get('riwayat_diklat')->result();
    }

    public function get_riwayat_kursus($update)
    {
        //select
        $this->db_simpeg->select('*');
        $this->db_simpeg->select('riwayat_kursus.status AS status');

        $this->where_riwayat('riwayat_kursus',$update);

        // $this->db_simpeg->join('ref_jeniskursus', 'ref_jeniskursus.kode_jeniskursus = riwayat_kursus.kode_jeniskursus', 'left');
        // $this->db_simpeg->join('ref_instansi', 'ref_instansi.kode_instansi = riwayat_kursus.kode_instansi', 'left');

        $this->db_simpeg->order_by('riwayat_kursus.tmt_berakhir', 'desc');
        return $this->db_simpeg->get('riwayat_kursus')->result();
    }

    public function get_riwayat_organisasi($update)
    {
        //select
        $this->db_simpeg->select('*');
        $this->db_simpeg->select('riwayat_organisasi.status AS status');

        $this->where_riwayat('riwayat_organisasi',$update);

        // $this->db_simpeg->join('ref_kepanitiaan', 'ref_kepanitiaan.kode_kepanitiaan = riwayat_organisasi.kode_kepanitiaan', 'left');

        $this->db_simpeg->order_by('riwayat_organisasi.tmt_mulai', 'desc');
        $this->db_simpeg->order_by('riwayat_organisasi.tmt_berakhir', 'desc');
        return $this->db_simpeg->get('riwayat_organisasi')->result();
    }

    public function get_riwayat_kepanitiaan($update)
    {
        //select
        $this->db_simpeg->select('*');
        $this->db_simpeg->select('riwayat_kepanitiaan.status AS status');
        $this->db_simpeg->select('riwayat_kepanitiaan.id_kepanitiaan AS id_kepanitiaan');
        $this->db_simpeg->select('riwayat_kepanitiaan.nama_kepanitiaan AS nama_kepanitiaan');
        // $this->db_simpeg->select('ref_kepanitiaan.nama_kepanitiaan AS nama_ref_kepanitiaan');

        $this->where_riwayat('riwayat_kepanitiaan',$update);

        // $this->db_simpeg->join('ref_kepanitiaan', 'ref_kepanitiaan.kode_kepanitiaan = riwayat_kepanitiaan.kode_kepanitiaan', 'left');

        $this->db_simpeg->order_by('riwayat_kepanitiaan.sk_tanggal', 'desc');
        return $this->db_simpeg->get('riwayat_kepanitiaan')->result();
    }

    public function get_riwayat_penugasan($update)
    {
        //select
        $this->db_simpeg->select('*');
        $this->db_simpeg->select('riwayat_penugasan.status AS status');
        $this->db_simpeg->select('riwayat_penugasan.id_penugasan AS id_penugasan');
        $this->db_simpeg->select('riwayat_penugasan.nama_penugasan AS nama_penugasan');
        // $this->db_simpeg->select('ref_kepanitiaan.nama_kepanitiaan AS nama_ref_kepanitiaan');

        $this->where_riwayat('riwayat_penugasan',$update);

        // $this->db_simpeg->join('ref_kepanitiaan', 'ref_kepanitiaan.kode_kepanitiaan = riwayat_kepanitiaan.kode_kepanitiaan', 'left');

        $this->db_simpeg->order_by('riwayat_penugasan.sk_tanggal', 'desc');
        return $this->db_simpeg->get('riwayat_penugasan')->result();
    }

    public function get_riwayat_penghargaan($update)
    {
        //select
        $this->db_simpeg->select('*');
        $this->db_simpeg->select('riwayat_penghargaan.status AS status');
        $this->db_simpeg->select('riwayat_penghargaan.id_penghargaan AS id_penghargaan');
        $this->db_simpeg->select('riwayat_penghargaan.nama_penghargaan AS nama_penghargaan');
        // $this->db_simpeg->select('ref_penghargaan.nama_penghargaan AS nama_ref_penghargaan');

        $this->where_riwayat('riwayat_penghargaan',$update);

        // $this->db_simpeg->join('ref_penghargaan', 'ref_penghargaan.kode_penghargaan = riwayat_penghargaan.kode_penghargaan', 'left');

        $this->db_simpeg->order_by('riwayat_penghargaan.sk_tanggal', 'desc');
        return $this->db_simpeg->get('riwayat_penghargaan')->result();
    }

    public function get_riwayat_prestasi($update)
    {
        //select
        $this->db_simpeg->select('*');
        $this->db_simpeg->select('riwayat_prestasi.status AS status');

        $this->where_riwayat('riwayat_prestasi',$update);

        $this->db_simpeg->order_by('riwayat_prestasi.tahun', 'desc');
        return $this->db_simpeg->get('riwayat_prestasi')->result();
    }

    public function get_riwayat_cuti($update)
    {
        //select
        $this->db_simpeg->select('*');
        $this->db_simpeg->select('riwayat_cuti.status AS status');
        $this->db_simpeg->select('riwayat_cuti.id_cuti AS id_cuti');

        $this->where_riwayat('riwayat_cuti',$update);

        // $this->db_simpeg->join('ref_cuti', 'ref_cuti.kode_cuti = riwayat_cuti.kode_cuti', 'left');

        $this->db_simpeg->order_by('riwayat_cuti.tmt_berakhir', 'desc');
        return $this->db_simpeg->get('riwayat_cuti')->result();
    }

    public function get_riwayat_hukuman($update)
    {
        //select
        $this->db_simpeg->select('*');
        $this->db_simpeg->select('riwayat_hukuman.status AS status');
        $this->db_simpeg->select('riwayat_hukuman.id_hukuman AS id_hukuman');

        $this->where_riwayat('riwayat_hukuman',$update);

        // $this->db_simpeg->join('ref_jenishukuman', 'ref_jenishukuman.kode_jenishukuman = riwayat_hukuman.kode_jenishukuman', 'left');

        $this->db_simpeg->order_by('riwayat_hukuman.tmt_berakhir', 'desc');
        return $this->db_simpeg->get('riwayat_hukuman')->result();
    }

    public function get_riwayat_bahasa($update)
    {
        //select
        $this->db_simpeg->select('*');
        $this->db_simpeg->select('riwayat_bahasa.status AS status');

        $this->where_riwayat('riwayat_bahasa',$update);

        $this->db_simpeg->order_by('riwayat_bahasa.bahasa', 'asc');
        return $this->db_simpeg->get('riwayat_bahasa')->result();
    }

    public function get_riwayat_orangtua($update)
    {
        //select
        $this->db_simpeg->select('*');
        $this->db_simpeg->select('riwayat_orangtua.status AS status');

        $this->where_riwayat('riwayat_orangtua',$update);

        // $this->db_simpeg->join('master_orang', 'master_orang.id_orang = riwayat_orangtua.id_orang', 'left');
        // $this->db_simpeg->join('ref_kelahiran', 'ref_kelahiran.kode_kelahiran = master_orang.id_tempat_lahir', 'left');
        // $this->db_simpeg->join('ref_tingkatpendidikan', 'ref_tingkatpendidikan.kode_tingkatpendidikan = master_orang.id_tingkat_pendidikan', 'left');

        $this->db_simpeg->order_by('riwayat_orangtua.hubungan_orangtua', 'asc');
        return $this->db_simpeg->get('riwayat_orangtua')->result();
    }

    public function get_riwayat_pernikahan($update)
    {
        //select
        $this->db_simpeg->select('*');
        $this->db_simpeg->select('riwayat_pernikahan.status AS status');
        // $this->db_simpeg->select('master_orang.id_orang AS id_orang');

        $this->where_riwayat('riwayat_pernikahan',$update);

        // $this->db_simpeg->join('master_orang', 'master_orang.id_orang = riwayat_pernikahan.id_orang', 'left');
        // $this->db_simpeg->join('ref_kelahiran', 'ref_kelahiran.kode_kelahiran = master_orang.id_tempat_lahir', 'left');
        // $this->db_simpeg->join('ref_tingkatpendidikan', 'ref_tingkatpendidikan.kode_tingkatpendidikan = master_orang.id_tingkat_pendidikan', 'left');
        // $this->db_simpeg->join('master_pegawai', 'master_pegawai.id_orang = master_orang.id_orang', 'left');

        $this->db_simpeg->order_by('riwayat_pernikahan.posisi', 'asc');
        return $this->db_simpeg->get('riwayat_pernikahan')->result();
    }

    public function get_riwayat_anak($update)
    {
        //select
        $this->db_simpeg->select('*');
        $this->db_simpeg->select('riwayat_anak.status AS status');

        $this->where_riwayat('riwayat_anak',$update);

        // $this->db_simpeg->join('master_orang', 'master_orang.id_orang = riwayat_anak.id_orang', 'left');
        // $this->db_simpeg->join('ref_kelahiran', 'ref_kelahiran.kode_kelahiran = master_orang.id_tempat_lahir', 'left');
        // $this->db_simpeg->join('ref_tingkatpendidikan', 'ref_tingkatpendidikan.kode_tingkatpendidikan = master_orang.id_tingkat_pendidikan', 'left');

        $this->db_simpeg->order_by('riwayat_anak.hubungan_anak', 'asc');
        $this->db_simpeg->order_by('riwayat_anak.posisi', 'asc');
        return $this->db_simpeg->get('riwayat_anak')->result();
    }

    public function get_riwayat_kedudukan($update)
    {
        //select
        $this->db_simpeg->select('*');
        $this->db_simpeg->select('riwayat_kedudukan.status AS status');

        $this->where_riwayat('riwayat_kedudukan',$update);

        // $this->db_simpeg->join('ref_kedudukan', 'ref_kedudukan.kode_kedudukan = riwayat_kedudukan.kode_kedudukan', 'left');

        $this->db_simpeg->order_by('riwayat_kedudukan.tmt_kedudukan', 'desc');
        return $this->db_simpeg->get('riwayat_kedudukan')->result();
    }

    public function get_riwayat_indikator($update)
    {
        //select
        $this->db_simpeg->select('*');
        $this->db_simpeg->select('riwayat_indikator.status AS status');

        $this->where_riwayat('riwayat_indikator',$update);

        $this->db_simpeg->order_by('riwayat_indikator.tahun', 'desc');
        return $this->db_simpeg->get('riwayat_indikator')->result();
    }

    //tedipake soalna pake ajax
    public function insert()
    {
        // $this->db_simpeg->set('nama_kedudukan', $this->nama_kedudukan);
        // $this->db_simpeg->set('status', $this->status);
        // $this->db_simpeg->insert('master_orang');
        // return $this->db_simpeg->insert_id();
    }

    //tedipake soalna pake ajax
    public function update()
    {
        // $this->db_simpeg->where('id_kedudukan', $this->id_kedudukan);
        // $this->db_simpeg->set('nama_kedudukan', $this->nama_kedudukan);
        // $this->db_simpeg->set('status', $this->status);
        // return $this->db_simpeg->update('master_orang');
    }

    //tedipake soalna pake ajax
    public function delete()
    {
        // return $this->db_simpeg->delete('master_orang', array('id_kedudukan' => $this->id_kedudukan));
    }




}
