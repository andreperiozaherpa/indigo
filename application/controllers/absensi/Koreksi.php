<?php
class Koreksi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->user_id = $this->session->userdata('user_id');
        $this->load->model('user_model');
        $this->user_model->user_id = $this->user_id;
        $this->user_model->set_user_by_user_id();
        $this->user_picture = $this->user_model->user_picture;
        $this->full_name = $this->user_model->full_name;
        $this->user_level = $this->user_model->level;

        $this->load->model("absen_model");
        $this->load->model("ref_skpd_model");
        $this->load->model("ref_ket_absen_model");
        $this->load->model("master_pegawai_model");
        $this->load->model('tpp/tpp_model');
        $this->load->model('tpp/Tpp_model');
        $this->load->model("tpp/tpp_perhitungan_model");
        $this->load->model('laporan_kinerja_harian_model');
        $this->load->model('ref_hari_kerja_efektif_model');
        $this->load->model("pegawai_posisi_model");
        $this->load->model("kinerja/Laporan_model", "Laporan_kinerja_model");
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        // ini_set('output_buffering', 0);
        error_reporting(E_ALL);

        $this->user_privileges = explode(";", $this->session->userdata('user_privileges'));

    }

    public function a()
    {
        // phpinfo();

        $param['group_by'] = "ASN";
        $param['where']['skp.tahun_desc'] = 2023;
        $param['bulan'] = 2;
        $param['where']['pegawai.id_pegawai'] = 10472;
        $summary = $this->Laporan_kinerja_model->getSummary($param)->result();
        $data['summaryLKH'] = $summary;
        print_r($summary);
        // die;
    }
    public function test_looping()
    {
        ob_implicit_flush(1);

        for ($i = 0; $i < 10; $i++) {
            echo $i;
            //this is for the buffer achieve the minimum size in order to flush data
            echo str_repeat(' ', 1024 * 64);
            sleep(1);
        }
    }

    public function index()
    {

        if (!$this->user_id) {
            show_404();
        }

        if ($this->user_level !== "Administrator") {
            show_404();
        }
        $data['title'] = "Koreksi TPP Pegawai";
        $data['content'] = "absensi/koreksi/index";
        $data['user_picture'] = $this->user_picture;
        $data['full_name'] = $this->full_name;
        $data['user_level'] = $this->user_level;


        $this->load->model('ref_skpd_model');
        $data['skpd'] = $this->ref_skpd_model->get_all();
        $id_skpd = "";
        $param = array();

        $bulan = date("m");
        $tahun = date("Y");

        if ($this->input->get("bulan")) {
            $bulan = $this->input->get("bulan", true);
        }

        if ($this->input->get("id_skpd")) {
            $id_skpd = $this->input->get("id_skpd", true);
            $data['selected_skpd'] = $this->ref_skpd_model->get_by_id($id_skpd);
        }

        if ($this->input->get("tahun")) {
            $tahun = $this->input->get("tahun", true);
        }

        $data['bulan'] = $bulan;
        $data['tahun'] = $tahun;
        $data['id_skpd'] = $id_skpd;

        $data['run'] = $this;

        $this->load->view('admin/index', $data);
    }

    public function hitung_lkh($id_skpd = '', $bulan, $tahun)
    {
        $bulan = (int) $bulan;
        echo "Hitung LKH " . newLine() . "";
        if ($id_skpd == '') {
            $nama_skpd = 'Semua SKPD';
        } else {
            $skpd = $this->ref_skpd_model->get_by_id($id_skpd);
            $nama_skpd = $skpd->nama_skpd;
        }
        echo "$nama_skpd - " . bulan($bulan) . " $tahun" . newLine() . "";
        echo "--------------------------------------" . newLine() . "" . newLine() . "";
        $pegawai = $this->laporan_kinerja_harian_model->get_all_pegawai($id_skpd, $bulan, $tahun);
        // print_r(count($pegawai));die;
        $efektif = $this->ref_hari_kerja_efektif_model->get_by_bulan($bulan);
        $n = 1;
        foreach ($pegawai as $n => $p) {
            if ($p->id_skpd == 400) {
                continue;
            }
            echo "[$n] Checking $p->nama_lengkap .. ";

            if ($p->jumlah_lkh == 0 || $efektif == 0) {
                $persentase = 0;
            } else {
                $persentase = round(($p->jumlah_lkh / $efektif) * 100, 2);
            }

            $tpp = $this->tpp_perhitungan_model->get_tpp($p->id_pegawai);
            $param = array('id_ket_log' => 'L1', 'persentase' => $persentase, 'bulan' => $bulan, 'tahun' => $tahun, 'id_pegawai' => $p->id_pegawai, 'tpp' => $tpp);
            $save = $this->tpp_model->simpan($param);
            if ($save) {
                $ket = "<span style=\"color:red\">" . $save['keterangan'] . "</span>";
            } else {
                $ket = "<span style=\"color:green\">OK</span>";
            }
            echo $ket . "" . newLine() . "";
            flushOutput();
            $n++;
        }
    }

    public function hitung_tap($id_skpd = '', $bulan, $tahun)
    {
        $bulan = (int) $bulan;
        echo "Hitung Log Absen " . newLine() . "";
        if (empty($id_skpd)) {
            $nama_skpd = 'Semua SKPD';
        } else {
            $skpd = $this->ref_skpd_model->get_by_id($id_skpd);
            $nama_skpd = $skpd->nama_skpd;
        }
        echo "$nama_skpd - " . bulan($bulan) . " $tahun" . newLine() . "";
        echo "--------------------------------------" . newLine() . "" . newLine() . "";
        $pegawai = $this->pegawai_posisi_model->get_posisi($id_skpd, $bulan, $tahun);
        // print_r($pegawai);
        $n = 1;
        foreach ($pegawai as $k => $p) {
            if ($p->id_skpd == 400) {
                continue;
            }

            echo "[$n] Checking $p->nama_lengkap .. ";
            $id_pegawai = $p->id_pegawai;
            $param_tap = array(
                'id_pegawai' => $id_pegawai,
                'bulan' => $bulan,
                'tahun' => $tahun,
                'id_ket_log' => "A3", //Tidak Absen Pulang
            );
            $save = $this->Tpp_model->simpan($param_tap);


            $param = array(
                'id_pegawai' => $p->id_pegawai,
                'bulan' => $bulan,
                'tahun' => $tahun,
                'id_ket_log' => "A1",
            );

            $save_log = $this->tpp_model->simpan($param);

            if ($save) {
                $ket = "<span style=\"color:red\">" . $save['keterangan'] . "</span>";
            } else {
                $ket = "<span style=\"color:green\">OK</span> ";
            }
            if ($save_log) {
                $ket = "<span style=\"color:red\">" . $save_log['keterangan'] . "</span> ";
            } else {
                $ket = "<span style=\"color:green\">OK</span> ";
            }
            echo $ket . "" . newLine() . "";
            flushOutput();
            $n++;
        }
    }

    public function hitung_tk($id_skpd = '', $bulan, $tahun)
    {
        $bulan = (int) $bulan;
        echo "Hitung Tanpa Keterangan " . newLine() . "";
        if ($id_skpd == '') {
            $nama_skpd = 'Semua SKPD';
        } else {
            $skpd = $this->ref_skpd_model->get_by_id($id_skpd);
            $nama_skpd = $skpd->nama_skpd;
        }
        echo "$nama_skpd - " . bulan($bulan) . " $tahun" . newLine() . "";
        echo "--------------------------------------" . newLine() . "" . newLine() . "";
        $this->load->model('Absen_model');
        $pegawai = $this->pegawai_posisi_model->get_posisi($id_skpd, $bulan, $tahun);
        $k = 1;
        // print_r(($pegawai));die;
        foreach ($pegawai as $n => $p) {
            if ($p->id_skpd == 400) {
                continue;
            }
            $jml_hari = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);
            echo "[$n] Checking $p->nama_lengkap .. ";
            $tk = 0;
            for ($tanggal = 1; $tanggal <= $jml_hari; $tanggal++) {
                $t = str_pad($tanggal, 2, '0', STR_PAD_LEFT);
                $bulan = str_pad($bulan, 2, '0', STR_PAD_LEFT);
                $tanggal_absen = "$tahun-$bulan-$t";
                $shift_setting = $this->db->get_where('absen_shift_setting', array('id_pegawai' => $p->id_pegawai))->row();
                if (!$shift_setting) {
                    $id_shift = 1;
                } else {
                    $id_shift = $shift_setting->aktif_shift;
                }
                $shift = $this->db->get_where('absen_shift', array('id_shift' => $id_shift))->row();
                $hari = date("N", strtotime($tanggal_absen));
                $fhari = "hari" . $hari;


                if ($id_shift == 12 || $id_shift == 16 || $id_shift == 17 || $id_shift == 13 || $id_shift == 14 || $id_shift == 15) {
                    for ($h = 1; $h <= 6; $h++) {
                        $fh = "hari" . $h;
                        $shift->$fh = "Y";
                    }
                }

                if ($shift->$fhari == "Y") {

                    $libur = $this->db->get_where('ref_hari_libur', array('MONTH(tanggal_libur)' => $bulan, 'YEAR(tanggal_libur)' => $tahun))->result();
                    $tanggal_libur = array();
                    foreach ($libur as $l) {
                        $tanggal_libur[] = $l->tanggal_libur;
                    }

                    $absen = $this->db->get_where('absen_log', array('id_pegawai' => $p->id_pegawai, 'tanggal' => $tanggal_absen))->num_rows();
                    $log = $this->db
                        ->where('absen_ket_log.id_pegawai', $p->id_pegawai)
                        ->where('absen_ket_log_detail.tanggal', $tanggal_absen)
                        ->join('absen_ket_log', 'absen_ket_log.id_ket_log = absen_ket_log_detail.id_ket_log')
                        ->get('absen_ket_log_detail')
                        ->num_rows();
                    if (!in_array($tanggal_absen, $tanggal_libur) && empty($absen) && empty($log)) {
                        //Eksekusi
                        $this->Absen_model->tanpa_keterangan($p->id_pegawai, $tanggal_absen);
                        // echo $tanggal_absen;

                        echo "<span style='color:red'>" . tanggal_hari($tanggal_absen) . "</span> ";
                        $tk++;
                    }
                }
                flushOutput();
            }

            if ($tk == 0) {
                echo "<span style='color:green'>OK</span> ";
            }

            echo "" . newLine() . "";
            $k++;
            flushOutput();
        }
    }

    public function aa()
    {
    }


    public function fix_absen_hari_libur($id_skpd = '', $bulan, $tahun)
    {
        $bulan = (int) $bulan;
        echo "Fix Absen di Hari Libur " . newLine() . "";
        if ($id_skpd == '') {
            $nama_skpd = 'Semua SKPD';
        } else {
            $skpd = $this->ref_skpd_model->get_by_id($id_skpd);
            $nama_skpd = $skpd->nama_skpd;
        }
        echo "$nama_skpd - " . bulan($bulan) . " $tahun" . newLine() . "";
        echo "--------------------------------------" . newLine() . "" . newLine() . "";
        $this->load->model("tpp/Tpp_model");
        $this->load->model("absen_model");

        $this->db->order_by('nama_lengkap');
        if ($id_skpd !== '') {
            $this->db->where('pegawai_posisi.id_skpd', $id_skpd);
        }
        $this->db->join('ref_skpd', 'ref_skpd.id_skpd = pegawai_posisi.id_skpd AND pegawai_posisi.bulan = ' . $bulan . ' AND pegawai_posisi.tahun = ' . $tahun);
        $this->db->join('pegawai', 'pegawai.id_pegawai = pegawai_posisi.id_pegawai AND pegawai_posisi.bulan = ' . $bulan . ' AND pegawai_posisi.tahun = ' . $tahun);
        $pegawai = $this->db->get_where('pegawai_posisi', array('pensiun' => 0))->result();

        $libur = $this->db->get_where('ref_hari_libur', array('MONTH(tanggal_libur)' => $bulan, 'YEAR(tanggal_libur)' => $tahun))->result();
        $tanggal_libur = array();
        foreach ($libur as $l) {
            $tanggal_libur[] = $l->tanggal_libur;
        }


        $n = 1;
        foreach ($pegawai as $k => $v) {
            $tanggal_log = array();
            $this->db->join('absen_ket_log', 'absen_ket_log.id_ket_log = absen_ket_log_detail.id_ket_log');
            $this->db->join('ref_ket_absen', 'ref_ket_absen.id_ket_absen = absen_ket_log.id_ket_absen');
            $log = $this->db->get_where('absen_ket_log_detail', array('id_pegawai' => $v->id_pegawai, 'MONTH(tanggal)' => $bulan, 'YEAR(tanggal)' => $tahun))->result();
            $ket = array('cuti', 'sakit', 'tk');
            foreach ($log as $lo) {
                if (in_array($lo->group_ket, $ket)) {
                    $tanggal_log[] = $lo->tanggal;
                }
            }
            if ($v->id_skpd == 400) {
                continue;
            }


            echo "[$n] Checking $v->nama_lengkap .. ";

            $absen_log = $this->db->get_where('absen_log', array('id_pegawai' => $v->id_pegawai, 'MONTH(tanggal)' => $bulan, 'YEAR(tanggal)' => $tahun))->result();
            $hit = 0;
            foreach ($absen_log as $l) {
                $id_pegawai = $v->id_pegawai;
                $tanggal = $l->tanggal;
                $shift_setting = $this->db->get_where('absen_shift_setting', array('id_pegawai' => $v->id_pegawai))->row();
                if (!$shift_setting) {
                    $id_shift = 1;
                } else {
                    $id_shift = $shift_setting->aktif_shift;
                }
                $shift = $this->db->get_where('absen_shift', array('id_shift' => $id_shift))->row();
                $hari = date("N", strtotime($l->tanggal));
                $fhari = "hari" . $hari;

                if ($id_shift == 12 || $id_shift == 16 || $id_shift == 17 || $id_shift == 13 || $id_shift == 14 || $id_shift == 15) {
                    for ($h = 1; $h <= 6; $h++) {
                        $fh = "hari" . $h;
                        $shift->$fh = "Y";
                    }
                }
                if ($shift->$fhari !== "Y" || in_array($l->tanggal, $tanggal_libur) || in_array($l->tanggal, $tanggal_log)) {
                    $this->db->delete('absen_log', array('id_pegawai' => $v->id_pegawai, 'tanggal' => $l->tanggal));
                    $param = array(
                        'id_pegawai' => $id_pegawai,
                        'bulan' => date("m", strtotime($tanggal)),
                        'tahun' => date("Y", strtotime($tanggal)),
                        'id_ket_log' => "A1", //Terlambat dan Pulang Cepat
                    );
                    $this->Tpp_model->simpan($param);

                    $param_tap = array(
                        'id_pegawai' => $id_pegawai,
                        'bulan' => date("m", strtotime($tanggal)),
                        'tahun' => date("Y", strtotime($tanggal)),
                        'id_ket_log' => "A3", //Tidak Absen Pulang
                    );
                    $this->Tpp_model->simpan($param_tap);
                    // echo $id_pegawai;die;

                    echo "<span style='color:red'>" . tanggal_hari($l->tanggal) . "</span> ";
                    $hit++;
                    // die;
                }

                flushOutput();
            }

            if ($hit == 0) {
                echo "<span style='color:green'>OK</span> ";
            }

            echo "" . newLine() . "";
            $n++;

            flushOutput();
        }
    }


    public function fix_tanpa_keterangan($id_skpd = '', $bulan, $tahun)
    {
        $bulan = (int) $bulan;
        echo "Fix Tanpa Keterangan di Hari Kerja " . newLine() . "";
        if ($id_skpd == '') {
            $nama_skpd = 'Semua SKPD';
        } else {
            $skpd = $this->ref_skpd_model->get_by_id($id_skpd);
            $nama_skpd = $skpd->nama_skpd;
        }
        echo "$nama_skpd - " . bulan($bulan) . " $tahun" . newLine() . "";
        echo "--------------------------------------" . newLine() . "" . newLine() . "";
        $this->load->model("tpp/Tpp_model");
        $this->load->model("absen_model");
        // $this->db->order_by('nama_lengkap');
        // if ($id_skpd !== '') {
        //     // $this->db->where('pegawai.id_skpd', $id_skpd);
        //     $this->db->having('id_skpd_pencairan', $id_skpd);
        // }
        // $this->db->join('ref_skpd', 'ref_skpd.id_skpd = pegawai.id_skpd');

        // $this->db->join('ref_jabatan_baru as sekarang', 'sekarang.id_jabatan = pegawai.id_jabatan', 'left');
        // $this->db->join('ref_jabatan_baru as lama', 'lama.id_jabatan = pegawai.id_jabatan_lama', 'left');
        // $this->db->select('pegawai.*,ref_skpd.*,
        // IF(lama.id_jabatan IS NULL, sekarang.id_jabatan, lama.id_jabatan) as id_jabatan_pencairan,
        // IF(lama.id_jabatan IS NULL, sekarang.nama_jabatan, lama.nama_jabatan) as nama_jabatan_pencairan,
        // IF(lama.id_jabatan IS NULL, sekarang.id_skpd, lama.id_skpd) as id_skpd_pencairan');

        // $pegawai = $this->db->get_where('pegawai', array('pensiun' => 0))->result();

        $pegawai = $this->pegawai_posisi_model->get_posisi($id_skpd, $bulan, $tahun);

        $libur = $this->db->get_where('ref_hari_libur', array('MONTH(tanggal_libur)' => $bulan, 'YEAR(tanggal_libur)' => $tahun))->result();
        $tanggal_libur = array();
        foreach ($libur as $l) {
            $tanggal_libur[] = $l->tanggal_libur;
        }

        $n = 1;
        // print_r(count($pegawai));die;
        foreach ($pegawai as $k => $v) {
            if ($v->id_skpd == 400) {
                continue;
            }
            echo "[$n] Checking $v->nama_lengkap .. ";
            $log = $this->db->get_where('absen_ket_log', array('id_ket_absen' => 'A2', 'id_pegawai' => $v->id_pegawai, 'MONTH(tanggal_awal)' => $bulan, 'YEAR(tanggal_awal)' => $tahun))->result();

            $hit = 0;
            foreach ($log as $l) {
                $id_pegawai = $v->id_pegawai;
                // echo $id_pegawai;die;
                $tanggal = $l->tanggal_awal;
                $shift_setting = $this->db->get_where('absen_shift_setting', array('id_pegawai' => $v->id_pegawai))->row();
                if (!$shift_setting) {
                    $id_shift = 1;
                } else {
                    $id_shift = $shift_setting->aktif_shift;
                }

                if ($id_pegawai == 206 && $tanggal <= '2021-08-19') {
                    $id_shift = 1;
                }
                $shift = $this->db->get_where('absen_shift', array('id_shift' => $id_shift))->row();
                $hari = date("N", strtotime($l->tanggal_awal));
                $fhari = "hari" . $hari;

                if ($id_shift == 12 || $id_shift == 16 || $id_shift == 17 || $id_shift == 13 || $id_shift == 14 || $id_shift == 15) {
                    for ($h = 1; $h <= 6; $h++) {
                        $fh = "hari" . $h;
                        $shift->$fh = "Y";
                    }
                }
                $absen = $this->db->get_where('absen_log', array('id_pegawai' => $id_pegawai, 'tanggal' => $tanggal))->row();
                if ($shift->$fhari !== "Y" || in_array($l->tanggal_awal, $tanggal_libur) || $absen || $tanggal > date('Y-m-d')) {
                    if ($v->id_skpd_induk == 5 && $hari == 7) {
                        continue;
                    }
                    // if ($v->id_skpd_induk !== 5 && in_array($l->tanggal_awal, $tanggal_libur)) {
                    //Hapus Tanpa Keterangan
                    $this->absen_model->delete_tanpa_keterangan($id_pegawai, $tanggal);
                    $param = array(
                        'id_pegawai' => $id_pegawai,
                        'bulan' => date("m", strtotime($tanggal)),
                        'tahun' => date("Y", strtotime($tanggal)),
                        'id_ket_log' => "A1", //Terlambat dan Pulang Cepat
                    );
                    $this->Tpp_model->simpan($param);

                    $param_tap = array(
                        'id_pegawai' => $id_pegawai,
                        'bulan' => date("m", strtotime($tanggal)),
                        'tahun' => date("Y", strtotime($tanggal)),
                        'id_ket_log' => "A3", //Tidak Absen Pulang
                    );
                    $this->Tpp_model->simpan($param_tap);
                    echo "<span style='color:red'>" . tanggal_hari($l->tanggal_awal) . "</span> ";
                    $hit++;
                    // die;
                    // }
                }

                flushOutput();
            }

            if ($hit == 0) {
                echo "<span style='color:green'>OK</span> ";
            }
            echo "" . newLine() . "";
            $n++;
            flushOutput();
        }
    }


    public function generate_tpp($id_skpd = '', $bulan, $tahun)
    {
        $bulan = (int) $bulan;
        echo "Generate TPP " . newLine() . "";
        if ($id_skpd == '') {
            $nama_skpd = 'Semua SKPD';
        } else {
            $skpd = $this->ref_skpd_model->get_by_id($id_skpd);
            $nama_skpd = $skpd->nama_skpd;
        }
        echo "$nama_skpd - " . bulan($bulan) . " $tahun" . newLine() . "";
        echo "--------------------------------------" . newLine() . "" . newLine() . "";

        $this->load->model("tpp/tpp_perhitungan_model");
        // $bulan = 02;
        // $tahun = 2021;
        $this->db->where('id_skpd !=', 400);
        $this->db->where('id_skpd !=', 0);

        if ($id_skpd !== '') {
            $this->db->where('id_skpd', $id_skpd);
        }

        $this->db->order_by('nama_lengkap');
        $pegawai = $this->db->get_where('pegawai')->result();
        // print_r(count($pegawai));
        // die;
        $no = 1;
        foreach ($pegawai as $p) {
            $data_insert = ['bulan' => $bulan, 'tahun' => $tahun, 'id_pegawai' => $p->id_pegawai, 'id_skpd' => $p->id_skpd, 'id_jabatan' => $p->id_jabatan, 'jabatan' => $p->jabatan];
            $jabatan = $this->db->get_where('ref_jabatan_baru', ['id_jabatan' => $p->id_jabatan])->row();
            if ($jabatan) {
                $tpp = $jabatan->tpp;
                $grade = $jabatan->grade;
                $pajak = $this->tpp_perhitungan_model->get_pajak($p->id_pegawai);
                $data_insert['grade'] = $grade;
                $data_insert['tpp'] = $tpp;
                $data_insert['pph'] = $pajak;
                $cek = $this->db->get_where('pegawai_posisi', ['bulan' => $bulan, 'tahun' => $tahun, 'id_pegawai' => $p->id_pegawai])->row();
                if ($p->pensiun == 0) {
                    if (!$cek) {
                        $this->db->insert('pegawai_posisi', $data_insert);
                        echo "[$no] $p->nama_lengkap [INSERT NEW] " . newLine() . "";
                    } else {
                        if ($cek->lock == "N") {
                            $this->db->update('pegawai_posisi', $data_insert, ['id_pegawai_posisi' => $cek->id_pegawai_posisi]);
                            echo "[$no] $p->nama_lengkap [UPDATE] " . newLine() . "";
                        }
                    }
                } else {
                    if ($cek) {
                        $this->db->delete('pegawai_posisi', ['id_pegawai_posisi' => $cek->id_pegawai_posisi]);
                        echo "[$no] $p->nama_lengkap [PENSIUN] " . newLine() . "";
                    }
                }
                $no++;
            }
            flushOutput();
        }
    }

    public function console_iframe($mode = '', $id_skpd = 0, $bulan = '', $tahun = '')
    {
        echo "<style>body{background-color:#222222;color:#FFFFFF;font-family: Consolas, Menlo, Monaco, Lucida Console, Liberation Mono, DejaVu Sans Mono, Bitstream Vera Sans Mono, Courier New, monospace, serif;}</style>";
        echo "<body>";
        echo '<script>
        var scroller = setInterval(function() {  
            window.scrollTo(0,document.body.scrollHeight);
        }, 10); // update every 10 ms, change at will
        </script>';
        // if ($mode !== 'generate_tpp') {
        //     if ($bulan > date('m') - 1 && $tahun >= date('Y')) {
        //         echo "<span style='color:red'>[ERROR]</span> Belum saatnya perhitungan!";
        //         die;
        //     }
        // }
        if ($mode !== 'generate_tpp') {
            if ($bulan > date('m') - 0 && $tahun >= date('Y')) {
                echo "<span style='color:red'>[ERROR]</span> Belum saatnya perhitungan!";
                die;
            }
        }
        if ($mode !== '') {
            if ($id_skpd == 0) {
                $id_skpd = '';
            }
            if ($mode == 'hitung_lkh' && !empty($bulan) && !empty($tahun)) {
                $this->hitung_lkh($id_skpd, $bulan, $tahun);
            } elseif ($mode == 'hitung_tk' && !empty($bulan) && !empty($tahun)) {
                $this->hitung_tk($id_skpd, $bulan, $tahun);
            } elseif ($mode == 'fix_absen_hari_libur' && !empty($bulan) && !empty($tahun)) {
                $this->fix_absen_hari_libur($id_skpd, $bulan, $tahun);
            } elseif ($mode == 'fix_tanpa_keterangan' && !empty($bulan) && !empty($tahun)) {
                $this->fix_tanpa_keterangan($id_skpd, $bulan, $tahun);
            } elseif ($mode == 'hitung_tap' && !empty($bulan) && !empty($tahun)) {
                $this->hitung_tap($id_skpd, $bulan, $tahun);
            } elseif ($mode == 'generate_tpp' && !empty($bulan) && !empty($tahun)) {
                $this->generate_tpp($id_skpd, $bulan, $tahun);
            }
        } else {
            echo 'Result goes here';
        }
        echo "</body>";
        echo '<script>
        clearInterval(scroller); // stop updating so that you can scroll up 
        </script>';
    }

    public function console()
    {
        // echo php_sapi_name();die;
        echo "--------------------------------------------------\n";
        echo "|        Console Perhitungan TPP Pegawai         |\n";
        echo "--------------------------------------------------\n";
        echo "Daftar SKPD\n";
        $this->db->or_where('jenis_skpd', 'skpd');
        $this->db->or_where('jenis_skpd', 'kecamatan');
        $skpd = $this->db->get('ref_skpd')->result();
        $n = 1;
        echo "  [0] Semua SKPD\n";
        foreach ($skpd as $s) {
            echo "  [$n] $s->nama_skpd\n";
            $n++;
        }
        echo "[?] Silahkan Pilih SKPD : ";
        $id_skpd = trim(fgets(STDIN));
        $nama_skpd = '';
        if ($id_skpd == 0) {
            $id_skpd = '';
            $nama_skpd = 'Semua SKPD';
        } else {
            $id_skpd = $skpd[$id_skpd - 1]->id_skpd;
            $nama_skpd = $skpd[$id_skpd - 1]->nama_skpd;
        }

        echo "[i] Anda Memilih $nama_skpd\n";
        echo "--------------------------------------------------\n";
        echo "Daftar Bulan\n";
        $list_bulan = array(
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember',
        );
        $n = 1;
        foreach ($list_bulan as $k => $b) {
            echo "  [$n] $b\n";
            $n++;
        }

        echo "[?] Silahkan Pilih Bulan : ";
        $bulan = trim(fgets(STDIN));
        $nama_bulan = $list_bulan[$bulan];
        echo "[i] Anda Memilih $nama_bulan\n";
        echo "--------------------------------------------------\n";
        echo "Masukkan Tahun : ";
        $tahun = trim(fgets(STDIN));
        echo "[i] Anda Memilih $tahun\n";
        echo "--------------------------------------------------\n";
        echo "Daftar Perintah\n";
        $daftar_perintah = [
            1 => 'Hitung LKH',
            2 => 'Hitung TK',
            3 => 'Hitung TAP',
            4 => 'Fix Absen Hari Libur',
            5 => 'Fix Tanpa Keterangan',
            6 => 'Generate TPP',
        ];
        foreach ($daftar_perintah as $k => $p) {
            echo "  [$k] $p\n";
        }
        echo "[?] Silahkan Pilih Perintah : ";
        $num_mode = trim(fgets(STDIN));
        if ($num_mode == 1) {
            $mode = 'hitung_lkh';
        } elseif ($num_mode == 2) {
            $mode = 'hitung_tk';
        } elseif ($num_mode == 3) {
            $mode = 'hitung_tap';
        } elseif ($num_mode == 4) {
            $mode = 'fix_absen_hari_libur';
        } elseif ($num_mode == 5) {
            $mode = 'fix_tanpa_keterangan';
        } elseif ($num_mode == 6) {
            $mode = 'generate_tpp';
        }

        echo "[i] Anda Memilih $daftar_perintah[$num_mode]\n";
        echo "--------------------------------------------------\n";
        if ($id_skpd == 0) {
            $id_skpd = '';
        }
        if ($mode == 'hitung_lkh' && !empty($bulan) && !empty($tahun)) {
            $this->hitung_lkh($id_skpd, $bulan, $tahun);
        } elseif ($mode == 'hitung_tk' && !empty($bulan) && !empty($tahun)) {
            $this->hitung_tk($id_skpd, $bulan, $tahun);
        } elseif ($mode == 'fix_absen_hari_libur' && !empty($bulan) && !empty($tahun)) {
            $this->fix_absen_hari_libur($id_skpd, $bulan, $tahun);
        } elseif ($mode == 'fix_tanpa_keterangan' && !empty($bulan) && !empty($tahun)) {
            $this->fix_tanpa_keterangan($id_skpd, $bulan, $tahun);
        } elseif ($mode == 'hitung_tap' && !empty($bulan) && !empty($tahun)) {
            $this->hitung_tap($id_skpd, $bulan, $tahun);
        } elseif ($mode == 'generate_tpp' && !empty($bulan) && !empty($tahun)) {
            $this->generate_tpp($id_skpd, $bulan, $tahun);
        }
        echo "\n";
    }
}