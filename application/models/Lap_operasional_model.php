<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lap_operasional_model extends CI_Model{

	public $id_laporan_operasional;
    public $id_skpd;   
    public $tgl_periode;
    public $tgl_pengesahan;
    public $pendapatan_lo_sekarang;
    public $pendapatan_lo_awal;
    public $total_pendapatan_lo;
    public $total_pendapatan_lo_sekarang;
    public $total_pendapatan_lo_awal;
    public $beban_pegawai_sekarang;
    public $beban_pegawai_awal;
    public $total_beban_pegawai;
    public $jumlah_beban_operasi_awal;
    public $beban_barangjasa_sekarang;
    public $beban_barangjasa_awal;
    public $total_barangjasa;
    public $beban_hibah_sekarang;
    public $beban_hibah_awal;
    public $total_beban_hibah;
    public $beban_bantuansosial_sekarang;
    public $beban_bantuansosial_awal;
    public $total_bantuansosial;
    public $beban_penyusutan_sekarang;
    public $beban_penyusutan_awal;
    public $total_beban_penyusutan;
    public $beban_lain_sekarang;
    public $beban_lain_awal;
    public $total_beban_lain;
    public $jumlah_beban_operasi_sekarang;
    public $total_beban_operasi;
    public $defisit_keg_nonopera_sekarang;
    public $defisit_keg_nonopera_awal;
    public $total_defisit_keg_nonepera;
    public $beban_transfer_sekarang;
    public $beban_transfer_awal;
    public $total_beban_transfer;
    public $beban_luar_biasa_sekarang;
    public $beban_luar_biasa_awal;
    public $total_beban_luar_biasa;
    public $total_beban_sekarang;
    public $total_beban_awal;
    public $total_beban_akhir;
    public $surplus_sekarang;
    public $surplus_awal;
    public $surplus_akhir;
    public $id_pegawai_1_bpkad;
    public $id_pegawai_2_bpkad;
    public $id_pegawai_3_bpkad;
    public $id_pegawai_4_bpkad;
    public $id_pegawai_1_skpd;
    public $id_pegawai_2_skpd;
    public $id_pegawai_3_skpd;
    public $id_pegawai_4_skpd;
    public $ttd_pegawai_1_bpkad;
    public $ttd_pegawai_2_bpkad;
    public $ttd_pegawai_3_bpkad;
    public $ttd_pegawai_4_bpkad;
    public $ttd_pegawai_1_skpd;
    public $ttd_pegawai_2_skpd;
    public $ttd_pegawai_3_skpd;
    public $ttd_pegawai_4_skpd;
    public $file_draft;
    public $file_signed;
    public $status;

    public $beban_bunga_sekarang;
    public $beban_bunga_awal;
    public $total_bunga;
    public $beban_penyisihanpiutang_sekarang;
    public $beban_penyisihanpiutang_awal;
    public $total_penyisihanpiutang;
    public $beban_takterduga_sekarang;
    public $beban_takterduga_awal;
    public $total_beban_takterduga;
    

    public function get_all(){
        if (in_array('keuangan', explode(';', $this->session->userdata('user_privileges')))) {
            $this->db->where('laporan_operasional.id_skpd',$this->session->userdata('id_skpd'));
        }
        $this->db->order_by('id_laporan_operasional','desc');
        $this->db->join('pegawai as pegawai1','pegawai1.id_pegawai = laporan_operasional.id_pegawai_1_bpkad','left');
        $this->db->join('pegawai as pegawai2','pegawai2.id_pegawai = laporan_operasional.id_pegawai_2_bpkad','left');
        $this->db->join('pegawai as pegawai3','pegawai3.id_pegawai = laporan_operasional.id_pegawai_3_bpkad','left');
        $this->db->join('pegawai as pegawai4','pegawai4.id_pegawai = laporan_operasional.id_pegawai_4_bpkad','left');
        $this->db->join('pegawai as pegawai5','pegawai5.id_pegawai = laporan_operasional.id_pegawai_1_skpd','left');
        $this->db->join('pegawai as pegawai6','pegawai6.id_pegawai = laporan_operasional.id_pegawai_2_skpd','left');
        $this->db->join('pegawai as pegawai7','pegawai7.id_pegawai = laporan_operasional.id_pegawai_3_skpd','left');
        $this->db->join('pegawai as pegawai8','pegawai8.id_pegawai = laporan_operasional.id_pegawai_4_skpd','left');
        $this->db->join('ref_skpd','ref_skpd.id_skpd = laporan_operasional.id_skpd','left');
          return $this->db->get('laporan_operasional')->result();
    }

    
	public function get_page($mulai,$hal,$filter=''){
		// $this->db->offsett(0,6);
        if (in_array('keuangan', explode(';', $this->session->userdata('user_privileges')))) {
            $this->db->where('laporan_operasional.id_skpd',$this->session->userdata('id_skpd'));
        }
		if($filter!=''){
			foreach($filter as $key => $value){
				$this->db->like($key,$value);
			}
		}
        else{
			$this->db->limit($hal,$mulai);
		}

        $this->db->order_by('id_laporan_operasional','desc');
        $this->db->select('* , laporan_operasional.status as status');
        $this->db->join('pegawai as pegawai1','pegawai1.id_pegawai = laporan_operasional.id_pegawai_1_bpkad','left');
        $this->db->join('pegawai as pegawai2','pegawai2.id_pegawai = laporan_operasional.id_pegawai_2_bpkad','left');
        $this->db->join('pegawai as pegawai3','pegawai3.id_pegawai = laporan_operasional.id_pegawai_3_bpkad','left');
        $this->db->join('pegawai as pegawai4','pegawai4.id_pegawai = laporan_operasional.id_pegawai_4_bpkad','left');
        $this->db->join('pegawai as pegawai5','pegawai5.id_pegawai = laporan_operasional.id_pegawai_1_skpd','left');
        $this->db->join('pegawai as pegawai6','pegawai6.id_pegawai = laporan_operasional.id_pegawai_2_skpd','left');
        $this->db->join('pegawai as pegawai7','pegawai7.id_pegawai = laporan_operasional.id_pegawai_3_skpd','left');
        $this->db->join('pegawai as pegawai8','pegawai8.id_pegawai = laporan_operasional.id_pegawai_4_skpd','left');
        $this->db->join('ref_skpd','ref_skpd.id_skpd = laporan_operasional.id_skpd','left');
         
		$query = $this->db->get('laporan_operasional');
		return $query->result();
	}

    public function get_all_ttd()
    {
        $this->db->group_start();
        $this->db->or_group_start();
            $this->db->where('id_pegawai_1_skpd',$this->session->userdata('id_pegawai'));
            $this->db->where('ttd_pegawai_1_skpd','belum');
            $this->db->where('ttd_pegawai_2_skpd','setuju');
        $this->db->group_end();
        $this->db->or_group_start();
            $this->db->where('id_pegawai_2_skpd',$this->session->userdata('id_pegawai'));
            $this->db->where('ttd_pegawai_2_skpd','belum');
        $this->db->group_end();
        $this->db->or_group_start();
            $this->db->where('id_pegawai_3_skpd',$this->session->userdata('id_pegawai'));
            $this->db->where('ttd_pegawai_3_skpd','belum');
        $this->db->group_end();
        $this->db->or_group_start();
            $this->db->where('id_pegawai_4_skpd',$this->session->userdata('id_pegawai'));
            $this->db->where('ttd_pegawai_4_skpd','belum');
        $this->db->group_end();
        $this->db->or_group_start();
            $this->db->where('id_pegawai_1_bpkad',$this->session->userdata('id_pegawai'));
            $this->db->where('ttd_pegawai_1_bpkad','belum');
            $this->db->where('ttd_pegawai_2_bpkad','setuju');
        $this->db->group_end();
        $this->db->or_group_start();
            $this->db->where('id_pegawai_2_bpkad',$this->session->userdata('id_pegawai'));
            $this->db->where('ttd_pegawai_2_bpkad','belum');
            $this->db->where('status_verifikasi','setuju');
        $this->db->group_end();
        $this->db->or_group_start();
            $this->db->where('id_pegawai_3_bpkad',$this->session->userdata('id_pegawai'));
            $this->db->where('ttd_pegawai_3_bpkad','belum');
        $this->db->group_end();
        $this->db->or_group_start();
            $this->db->where('id_pegawai_4_bpkad',$this->session->userdata('id_pegawai'));
            $this->db->where('ttd_pegawai_4_bpkad','belum');
        $this->db->group_end();
        $this->db->group_end();
        $get = $this->get_all();
        return $get;
    }

    public function get_page_ttd($mulai, $hal, $filter = '')
    {
        $this->db->group_start();
        $this->db->or_group_start();
            $this->db->where('id_pegawai_1_skpd',$this->session->userdata('id_pegawai'));
            $this->db->where('ttd_pegawai_1_skpd','belum');
            $this->db->where('ttd_pegawai_2_skpd','setuju');
        $this->db->group_end();
        $this->db->or_group_start();
            $this->db->where('id_pegawai_2_skpd',$this->session->userdata('id_pegawai'));
            $this->db->where('ttd_pegawai_2_skpd','belum');
        $this->db->group_end();
        $this->db->or_group_start();
            $this->db->where('id_pegawai_3_skpd',$this->session->userdata('id_pegawai'));
            $this->db->where('ttd_pegawai_3_skpd','belum');
        $this->db->group_end();
        $this->db->or_group_start();
            $this->db->where('id_pegawai_4_skpd',$this->session->userdata('id_pegawai'));
            $this->db->where('ttd_pegawai_4_skpd','belum');
        $this->db->group_end();
        $this->db->or_group_start();
            $this->db->where('id_pegawai_1_bpkad',$this->session->userdata('id_pegawai'));
            $this->db->where('ttd_pegawai_1_bpkad','belum');
            $this->db->where('ttd_pegawai_2_bpkad','setuju');
        $this->db->group_end();
        $this->db->or_group_start();
            $this->db->where('id_pegawai_2_bpkad',$this->session->userdata('id_pegawai'));
            $this->db->where('ttd_pegawai_2_bpkad','belum');
            $this->db->where('status_verifikasi','setuju');
        $this->db->group_end();
        $this->db->or_group_start();
            $this->db->where('id_pegawai_3_bpkad',$this->session->userdata('id_pegawai'));
            $this->db->where('ttd_pegawai_3_bpkad','belum');
        $this->db->group_end();
        $this->db->or_group_start();
            $this->db->where('id_pegawai_4_bpkad',$this->session->userdata('id_pegawai'));
            $this->db->where('ttd_pegawai_4_bpkad','belum');
        $this->db->group_end();
        $this->db->group_end();
        $get = $this->get_page($mulai, $hal, $filter);
        return $get;
    }


   
    public function get_by_id($id_laporan_operasional){
        $this->db->select('* , laporan_operasional.status as status, 
                            pegawai1.nama_lengkap as nama_1_bpkad,pegawai1.jabatan as jabatan_1_bpkad,pegawai1.foto_pegawai as foto1,pegawai1.nip as nip1,
                            pegawai2.nama_lengkap as nama_2_bpkad,pegawai2.jabatan as jabatan_2_bpkad,pegawai2.foto_pegawai as foto2,pegawai2.nip as nip2,
                            pegawai3.nama_lengkap as nama_3_bpkad,pegawai3.jabatan as jabatan_3_bpkad,pegawai3.foto_pegawai as foto3,pegawai3.nip as nip3,
                            pegawai4.nama_lengkap as nama_4_bpkad,pegawai4.jabatan as jabatan_4_bpkad,pegawai4.foto_pegawai as foto4,pegawai4.nip as nip4,
                            pegawai5.nama_lengkap as nama_1_skpd,pegawai5.jabatan as jabatan_1_skpd,pegawai5.foto_pegawai as foto5,pegawai5.nip as nip5,
                            pegawai6.nama_lengkap as nama_2_skpd,pegawai6.jabatan as jabatan_2_skpd,pegawai6.foto_pegawai as foto6,pegawai6.nip as nip6,
                            pegawai7.nama_lengkap as nama_3_skpd,pegawai7.jabatan as jabatan_3_skpd,pegawai7.foto_pegawai as foto7,pegawai7.nip as nip7,
                            pegawai8.nama_lengkap as nama_4_skpd,pegawai8.jabatan as jabatan_4_skpd,pegawai8.foto_pegawai as foto8,pegawai8.nip as nip8,
                            ');
        $this->db->join('pegawai as pegawai1','pegawai1.id_pegawai = laporan_operasional.id_pegawai_1_bpkad','left');
        $this->db->join('pegawai as pegawai2','pegawai2.id_pegawai = laporan_operasional.id_pegawai_2_bpkad','left');
        $this->db->join('pegawai as pegawai3','pegawai3.id_pegawai = laporan_operasional.id_pegawai_3_bpkad','left');
        $this->db->join('pegawai as pegawai4','pegawai4.id_pegawai = laporan_operasional.id_pegawai_4_bpkad','left');
        $this->db->join('pegawai as pegawai5','pegawai5.id_pegawai = laporan_operasional.id_pegawai_1_skpd','left');
        $this->db->join('pegawai as pegawai6','pegawai6.id_pegawai = laporan_operasional.id_pegawai_2_skpd','left');
        $this->db->join('pegawai as pegawai7','pegawai7.id_pegawai = laporan_operasional.id_pegawai_3_skpd','left');
        $this->db->join('pegawai as pegawai8','pegawai8.id_pegawai = laporan_operasional.id_pegawai_4_skpd','left');
        $this->db->join('ref_skpd','ref_skpd.id_skpd = laporan_operasional.id_skpd','left');
         
        return $this->db->get_where('laporan_operasional',array('id_laporan_operasional'=>$id_laporan_operasional))->row();
    }

    public function insert(){
        $this->db->set('id_skpd',$this->id_skpd);
        $this->db->set('tgl_periode',$this->tgl_periode);
        $this->db->set('tgl_pengesahan',$this->tgl_pengesahan);
        $this->db->set('pendapatan_asli_sekarang',$this->pendapatan_asli_sekarang);
        $this->db->set('pendapatan_asli_awal',$this->pendapatan_asli_awal);
        $this->db->set('total_pendapatan_asli',$this->total_pendapatan_asli);
        $this->db->set('pendapatan_transfer_sekarang',$this->pendapatan_transfer_sekarang);
        $this->db->set('pendapatan_transfer_awal',$this->pendapatan_transfer_awal);
        $this->db->set('total_pendapatan_transfer',$this->total_pendapatan_transfer);
        $this->db->set('pendapatan_lain_sekarang',$this->pendapatan_lain_sekarang);
        $this->db->set('pendapatan_lain_awal',$this->pendapatan_lain_awal);
        $this->db->set('total_pendapatan_lain',$this->total_pendapatan_lain);
        $this->db->set('pendapatan_surplus_sekarang',$this->pendapatan_surplus_sekarang);
        $this->db->set('pendapatan_surplus_awal',$this->pendapatan_surplus_awal);
        $this->db->set('total_pendapatan_surplus',$this->total_pendapatan_surplus);
        $this->db->set('total_pendapatan1_lo',$this->total_pendapatan1_lo);
        $this->db->set('total_pendapatan_lo_sekarang',$this->total_pendapatan_lo_sekarang);
        $this->db->set('total_pendapatan_lo_awal',$this->total_pendapatan_lo_awal);
        $this->db->set('beban_pegawai_sekarang',$this->beban_pegawai_sekarang);
        $this->db->set('beban_pegawai_awal',$this->beban_pegawai_awal);
        $this->db->set('total_beban_pegawai',$this->total_beban_pegawai);
        $this->db->set('beban_barangjasa_sekarang',$this->beban_barangjasa_sekarang);
        $this->db->set('beban_barangjasa_awal',$this->beban_barangjasa_awal);
        $this->db->set('total_barangjasa',$this->total_barangjasa);
        $this->db->set('beban_hibah_sekarang',$this->beban_hibah_sekarang);
        $this->db->set('beban_hibah_awal',$this->beban_hibah_awal);
        $this->db->set('total_beban_hibah',$this->total_beban_hibah);
        $this->db->set('beban_bantuansosial_sekarang',$this->beban_bantuansosial_sekarang);
        $this->db->set('beban_bantuansosial_awal',$this->beban_bantuansosial_awal);
        $this->db->set('total_bantuansosial',$this->total_bantuansosial);
        $this->db->set('beban_penyusutan_sekarang',$this->beban_penyusutan_sekarang);
        $this->db->set('beban_penyusutan_awal',$this->beban_penyusutan_awal);
        $this->db->set('total_beban_penyusutan',$this->total_beban_penyusutan);
        $this->db->set('beban_lain_sekarang',$this->beban_lain_sekarang);
        $this->db->set('beban_lain_awal',$this->beban_lain_awal);
        $this->db->set('total_beban_lain',$this->total_beban_lain);
        $this->db->set('jumlah_beban_operasi_sekarang',$this->jumlah_beban_operasi_sekarang);
        $this->db->set('jumlah_beban_operasi_awal',$this->jumlah_beban_operasi_awal);
        $this->db->set('total_beban_operasi',$this->total_beban_operasi);
        $this->db->set('defisit_keg_nonopera_sekarang',$this->defisit_keg_nonopera_sekarang);
        $this->db->set('defisit_keg_nonopera_awal',$this->defisit_keg_nonopera_awal);
        $this->db->set('total_defisit_keg_nonopera',$this->total_defisit_keg_nonopera);
        $this->db->set('beban_transfer_sekarang',$this->beban_transfer_sekarang);
        $this->db->set('beban_transfer_awal',$this->beban_transfer_awal);
        $this->db->set('total_beban_transfer',$this->total_beban_transfer);
        $this->db->set('beban_luar_biasa_sekarang',$this->beban_luar_biasa_sekarang);
        $this->db->set('beban_luar_biasa_awal',$this->beban_luar_biasa_awal);
        $this->db->set('total_beban_luar_biasa',$this->total_beban_luar_biasa);
        $this->db->set('total_beban_sekarang',$this->total_beban_sekarang);
        $this->db->set('total_beban_awal',$this->total_beban_awal);
        $this->db->set('total_beban_akhir',$this->total_beban_akhir);
        $this->db->set('surplus_sekarang',$this->surplus_sekarang);
        $this->db->set('surplus_awal',$this->surplus_awal);
        $this->db->set('surplus_akhir',$this->surplus_akhir);
        $this->db->set('id_pegawai_1_bpkad',$this->id_pegawai_1_bpkad);
        $this->db->set('id_pegawai_2_bpkad',$this->id_pegawai_2_bpkad);
        $this->db->set('id_pegawai_3_bpkad',$this->id_pegawai_3_bpkad);
        $this->db->set('id_pegawai_4_bpkad',$this->id_pegawai_4_bpkad);
        $this->db->set('id_pegawai_1_skpd',$this->id_pegawai_1_skpd);
        $this->db->set('id_pegawai_2_skpd',$this->id_pegawai_2_skpd);
        $this->db->set('id_pegawai_3_skpd',$this->id_pegawai_3_skpd);
        $this->db->set('id_pegawai_4_skpd',$this->id_pegawai_4_skpd);
        $this->db->set('ttd_pegawai_1_bpkad',$this->ttd_pegawai_1_bpkad);
        $this->db->set('ttd_pegawai_2_bpkad',$this->ttd_pegawai_2_bpkad);
        $this->db->set('ttd_pegawai_3_bpkad',$this->ttd_pegawai_3_bpkad);
        $this->db->set('ttd_pegawai_4_bpkad',$this->ttd_pegawai_4_bpkad);
        $this->db->set('ttd_pegawai_1_skpd',$this->ttd_pegawai_1_skpd);
        $this->db->set('ttd_pegawai_2_skpd',$this->ttd_pegawai_2_skpd);
        $this->db->set('ttd_pegawai_3_skpd',$this->ttd_pegawai_3_skpd);
        $this->db->set('ttd_pegawai_4_skpd',$this->ttd_pegawai_4_skpd);
        $this->db->set('file_draft',$this->file_draft);
        // $this->db->set('file_signed',$this->file_signed);
        $this->db->set('status',$this->status);

        $this->db->set('beban_bunga_sekarang',$this->beban_bunga_sekarang);
        $this->db->set('beban_bunga_awal',$this->beban_bunga_awal);
        $this->db->set('total_bunga',$this->total_bunga);
        $this->db->set('beban_penyisihanpiutang_sekarang',$this->beban_penyisihanpiutang_sekarang);
        $this->db->set('beban_penyisihanpiutang_awal',$this->beban_penyisihanpiutang_awal);
        $this->db->set('total_penyisihanpiutang',$this->total_penyisihanpiutang);
        $this->db->set('beban_takterduga_sekarang',$this->beban_takterduga_sekarang);
        $this->db->set('beban_takterduga_awal',$this->beban_takterduga_awal);
        $this->db->set('total_beban_takterduga',$this->total_beban_takterduga);
        
        $this->db->insert('laporan_operasional');
        return $this->db->insert_id();
    }

    public function update($id_laporan_operasional){
        // $this->db->set('id_skpd',$this->id_skpd);
        $this->db->set('tgl_periode',$this->tgl_periode);
        $this->db->set('tgl_pengesahan',$this->tgl_pengesahan);
        $this->db->set('pendapatan_asli_sekarang',$this->pendapatan_asli_sekarang);
        $this->db->set('pendapatan_asli_awal',$this->pendapatan_asli_awal);
        $this->db->set('total_pendapatan_asli',$this->total_pendapatan_asli);
        $this->db->set('pendapatan_transfer_sekarang',$this->pendapatan_transfer_sekarang);
        $this->db->set('pendapatan_transfer_awal',$this->pendapatan_transfer_awal);
        $this->db->set('total_pendapatan_transfer',$this->total_pendapatan_transfer);
        $this->db->set('pendapatan_lain_sekarang',$this->pendapatan_lain_sekarang);
        $this->db->set('pendapatan_lain_awal',$this->pendapatan_lain_awal);
        $this->db->set('total_pendapatan_lain',$this->total_pendapatan_lain);
        $this->db->set('pendapatan_surplus_sekarang',$this->pendapatan_surplus_sekarang);
        $this->db->set('pendapatan_surplus_awal',$this->pendapatan_surplus_awal);
        $this->db->set('total_pendapatan_surplus',$this->total_pendapatan_surplus);
        $this->db->set('total_pendapatan1_lo',$this->total_pendapatan1_lo);
        $this->db->set('total_pendapatan_lo_sekarang',$this->total_pendapatan_lo_sekarang);
        $this->db->set('total_pendapatan_lo_awal',$this->total_pendapatan_lo_awal);
        $this->db->set('beban_pegawai_sekarang',$this->beban_pegawai_sekarang);
        $this->db->set('beban_pegawai_awal',$this->beban_pegawai_awal);
        $this->db->set('total_beban_pegawai',$this->total_beban_pegawai);
        $this->db->set('beban_barangjasa_sekarang',$this->beban_barangjasa_sekarang);
        $this->db->set('beban_barangjasa_awal',$this->beban_barangjasa_awal);
        $this->db->set('total_barangjasa',$this->total_barangjasa);
        $this->db->set('beban_hibah_sekarang',$this->beban_hibah_sekarang);
        $this->db->set('beban_hibah_awal',$this->beban_hibah_awal);
        $this->db->set('total_beban_hibah',$this->total_beban_hibah);
        $this->db->set('beban_bantuansosial_sekarang',$this->beban_bantuansosial_sekarang);
        $this->db->set('beban_bantuansosial_awal',$this->beban_bantuansosial_awal);
        $this->db->set('total_bantuansosial',$this->total_bantuansosial);
        $this->db->set('beban_penyusutan_sekarang',$this->beban_penyusutan_sekarang);
        $this->db->set('beban_penyusutan_awal',$this->beban_penyusutan_awal);
        $this->db->set('total_beban_penyusutan',$this->total_beban_penyusutan);
        $this->db->set('beban_lain_sekarang',$this->beban_lain_sekarang);
        $this->db->set('beban_lain_awal',$this->beban_lain_awal);
        $this->db->set('total_beban_lain',$this->total_beban_lain);
        $this->db->set('jumlah_beban_operasi_sekarang',$this->jumlah_beban_operasi_sekarang);
        $this->db->set('jumlah_beban_operasi_awal',$this->jumlah_beban_operasi_awal);
        $this->db->set('total_beban_operasi',$this->total_beban_operasi);
        $this->db->set('defisit_keg_nonopera_sekarang',$this->defisit_keg_nonopera_sekarang);
        $this->db->set('defisit_keg_nonopera_awal',$this->defisit_keg_nonopera_awal);
        $this->db->set('total_defisit_keg_nonopera',$this->total_defisit_keg_nonopera);
        $this->db->set('beban_transfer_sekarang',$this->beban_transfer_sekarang);
        $this->db->set('beban_transfer_awal',$this->beban_transfer_awal);
        $this->db->set('total_beban_transfer',$this->total_beban_transfer);
        $this->db->set('beban_luar_biasa_sekarang',$this->beban_luar_biasa_sekarang);
        $this->db->set('beban_luar_biasa_awal',$this->beban_luar_biasa_awal);
        $this->db->set('total_beban_luar_biasa',$this->total_beban_luar_biasa);
        $this->db->set('total_beban_sekarang',$this->total_beban_sekarang);
        $this->db->set('total_beban_awal',$this->total_beban_awal);
        $this->db->set('total_beban_akhir',$this->total_beban_akhir);
        $this->db->set('surplus_sekarang',$this->surplus_sekarang);
        $this->db->set('surplus_awal',$this->surplus_awal);
        $this->db->set('surplus_akhir',$this->surplus_akhir);
        $this->db->set('id_pegawai_1_bpkad',$this->id_pegawai_1_bpkad);
        $this->db->set('id_pegawai_2_bpkad',$this->id_pegawai_2_bpkad);
        $this->db->set('id_pegawai_3_bpkad',$this->id_pegawai_3_bpkad);
        $this->db->set('id_pegawai_4_bpkad',$this->id_pegawai_4_bpkad);
        $this->db->set('id_pegawai_1_skpd',$this->id_pegawai_1_skpd);
        $this->db->set('id_pegawai_2_skpd',$this->id_pegawai_2_skpd);
        $this->db->set('id_pegawai_3_skpd',$this->id_pegawai_3_skpd);
        $this->db->set('id_pegawai_4_skpd',$this->id_pegawai_4_skpd);
        $this->db->set('ttd_pegawai_1_bpkad',$this->ttd_pegawai_1_bpkad);
        $this->db->set('ttd_pegawai_2_bpkad',$this->ttd_pegawai_2_bpkad);
        $this->db->set('ttd_pegawai_3_bpkad',$this->ttd_pegawai_3_bpkad);
        $this->db->set('ttd_pegawai_4_bpkad',$this->ttd_pegawai_4_bpkad);
        $this->db->set('ttd_pegawai_1_skpd',$this->ttd_pegawai_1_skpd);
        $this->db->set('ttd_pegawai_2_skpd',$this->ttd_pegawai_2_skpd);
        $this->db->set('ttd_pegawai_3_skpd',$this->ttd_pegawai_3_skpd);
        $this->db->set('ttd_pegawai_4_skpd',$this->ttd_pegawai_4_skpd);
        $this->db->set('status_verifikasi',$this->status_verifikasi);
        $this->db->set('alasan_penolakan',$this->alasan_penolakan);
        if ($this->file_draft) $this->db->set('file_draft',$this->file_draft);
        $this->db->set('status',$this->status);
        
        $this->db->set('beban_bunga_sekarang',$this->beban_bunga_sekarang);
        $this->db->set('beban_bunga_awal',$this->beban_bunga_awal);
        $this->db->set('total_bunga',$this->total_bunga);
        $this->db->set('beban_penyisihanpiutang_sekarang',$this->beban_penyisihanpiutang_sekarang);
        $this->db->set('beban_penyisihanpiutang_awal',$this->beban_penyisihanpiutang_awal);
        $this->db->set('total_penyisihanpiutang',$this->total_penyisihanpiutang);
        $this->db->set('beban_takterduga_sekarang',$this->beban_takterduga_sekarang);
        $this->db->set('beban_takterduga_awal',$this->beban_takterduga_awal);
        $this->db->set('total_beban_takterduga',$this->total_beban_takterduga);

        $this->db->where('laporan_operasional.id_laporan_operasional',$id_laporan_operasional);
        return $this->db->update('laporan_operasional');
    }

    public function update_reset($id_laporan_operasional){
        $this->db->set('ttd_pegawai_1_bpkad',$this->ttd_pegawai_1_bpkad);
        $this->db->set('ttd_pegawai_2_bpkad',$this->ttd_pegawai_2_bpkad);
        $this->db->set('ttd_pegawai_3_bpkad',$this->ttd_pegawai_3_bpkad);
        $this->db->set('ttd_pegawai_4_bpkad',$this->ttd_pegawai_4_bpkad);
        $this->db->set('ttd_pegawai_1_skpd',$this->ttd_pegawai_1_skpd);
        $this->db->set('ttd_pegawai_2_skpd',$this->ttd_pegawai_2_skpd);
        $this->db->set('ttd_pegawai_3_skpd',$this->ttd_pegawai_3_skpd);
        $this->db->set('ttd_pegawai_4_skpd',$this->ttd_pegawai_4_skpd);
        $this->db->set('status_verifikasi',$this->status_verifikasi);
        $this->db->set('alasan_penolakan',$this->alasan_penolakan);
        $this->db->set('status',$this->status);
        $this->db->where('laporan_operasional.id_laporan_operasional',$id_laporan_operasional);
        return $this->db->update('laporan_operasional');
    }

  

    public function delete($id){
        return $this->db->delete('laporan_operasional',array('id_laporan_operasional'=>$id));
    }


    public function get_last_id_by_skpd($id_skpd)
    {
        $this->db->select('id_laporan_operasional');
        $this->db->where('laporan_operasional.id_skpd',$id_skpd);
        $this->db->where('laporan_operasional.status','Selesai');
        $this->db->order_by('laporan_operasional.tgl_selesai','DESC');
        return @$this->db->get('laporan_operasional')->row()->id_laporan_operasional;
    }

    public function cek_status_tte($id_laporan_operasional)
    {
        return $this->db->get_where('laporan_operasional', array('id_laporan_operasional' => $id_laporan_operasional, 'status !=' => 'Selesai'))->num_rows();
    }

    

}