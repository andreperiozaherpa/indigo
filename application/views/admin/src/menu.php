<style>
    .sidebar {
        overflow-y: scroll;
    }

    .sidebar::-webkit-scrollbar {
        width: 10px;
    }

    /* Track */
    .sidebar::-webkit-scrollbar-track {
        background: transparent;
    }

    /* Handle */
    .sidebar::-webkit-scrollbar-thumb {
        background: #cdcdcd;
        /* height: 10px; */
    }

    /* Handle on hover */
    .sidebar::-webkit-scrollbar-thumb:hover {
        background: #c1c1c1;
    }
</style>
<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <div class="user-profile">
            <div class="dropdown user-pro-body">
                <br>
                <br>
                <div>

                    <img src="<?= base_url() . "data/foto/pegawai/" ?><?= empty($user_picture) ? 'user-default.png' : $user_picture ?>"
                        alt="user-img" style=" object-fit: cover;

          width: 50px;
          height: 50px;border-radius: 50%;
          ">
                </div>
                <a href="#" class="dropdown-toggle u-dropdown" data-toggle="dropdown" role="button" aria-haspopup="true"
                    aria-expanded="false">
                    <?php echo $full_name ?>
                    <span class="caret"></span>
                </a>
                <ul class="dropdown-menu animated flipInY">
                    <li><a href="<?php echo base_url(); ?>logout"><i class="fa fa-power-off"></i> Keluar</a></li>
                </ul>
            </div>
        </div>
        <hr>
        <ul class="nav" id="side-menu">

            <?php

            $user_group_menu = explode(";", $this->session->userdata('user_group_menu'));
            $user_privileges = explode(";", $this->session->userdata('user_privileges'));
            $n_verifikasi_internal = $this->notification_model->get_by_module('surat_internal/verifikasi_surat_detail');
            $CI = &get_instance();
            $pegawai = $this->master_pegawai_model->get_by_id($this->session->userdata('id_pegawai'));
            $CI->load->model('ref_skpd_model');
            $jabatan = $this->master_pegawai_model->get_by_name_jabatan('Kepala sub bagian program');
            $jabatan_id = [];
            $jabatan_no = 0;
            foreach ($jabatan as $i) {
                $jabatan_id[$jabatan_no] = $i['id_pegawai'];
                $jabatan_no++;
            }
            $nama_unit_kerja = '';
            $jenis_skpd = '';
            if ($user_level !== 'Administrator' && $user_level !== 'Operator') {
                if ($pegawai) {
                    $unit_kerja = $CI->ref_skpd_model->get_unit_kerja_by_id($pegawai->id_unit_kerja);
                    $nama_unit_kerja = ($unit_kerja) ? $unit_kerja->nama_unit_kerja : '';
                    $jenis_skpd = $CI->ref_skpd_model->get_by_id($pegawai->id_skpd)->jenis_skpd;
                } else {
                    $nama_unit_kerja = '';
                    $jenis_skpd = '';
                    $pegawai = new stdClass();
                    $pegawai->kepala_skpd = NULL;
                    $pegawai->id_pegawai = NULL;
                }
            }
            ?>
            <li class="sidebar-search hidden-sm hidden-md hidden-lg">
                <!-- input-group -->
                <div class="input-group custom-search-form">
                    <input id="mySearch" onkeyup="menuOffice()" type="text" class="form-control"
                        placeholder="Cari Menu"> <span class="input-group-btn">
                        <button class="btn btn-default" type="button"> <i class="fa fa-search"></i> </button>
                    </span>
                </div>
                <!-- /input-group -->
            </li>

            <li class="nav-small-cap m-t-10">--- Dashboard</li>

            <?php if ($user_level == "Administrator") { ?>
                                <li><a href="<?php echo base_url(); ?>admin" class="waves-effect"><i class="linea-icon linea-basic fa-fw"
                                            data-icon="v"></i> <span class="hide-menu">Admin</span></a></li>
            <?php } elseif ($user_level == 'Operator') {
                ?>

                                <li><a href="<?php echo base_url(); ?>dashboard_user/operator" class="waves-effect"><i class="ti-mouse"></i>
                                        <span class="hide-menu">Operator</span></a></li>
                                <?php
            } elseif ($user_level == "Dewan") {
                ?>

                                <li><a href="<?php echo base_url(); ?>dashboard_dewan" class="waves-effect"><i
                                            class="linea-icon linea-basic fa-fw" data-icon="u"></i> <span class="hide-menu">Dewan</span></a>
                                </li>
                                <?php
            } else { ?>
                                <li><a href="<?php echo base_url(); ?>dashboard_user" class="waves-effect"><i
                                            class="linea-icon linea-basic fa-fw" data-icon="u"></i> <span class="hide-menu">User</span></a>
                                </li>

                                <li>
                                    <a href="#" class="waves-effect"><i class="ti-filter fa-fw"></i> <span class="hide-menu">Seleksi
                                            Talent<span class="fa arrow"></span></a>
                                    <ul class="nav nav-second-level">
                                        <li><a href="<?php echo base_url(); ?>talenta/seleksi" class="waves-effect"> <span
                                                    class="hide-menu">Pendaftaran Seleksi</span></a></li>
                                        <li><a href="<?php echo base_url(); ?>talenta/seleksi/status" class="waves-effect"> <span
                                                    class="hide-menu">Status Seleksi</span></a></li>
                                        <li><a href="<?php echo base_url(); ?>talenta/idp/detail/<?= $this->session->userdata("id_pegawai"); ?>"
                                                class="waves-effect"> <span class="hide-menu">Individual Development Plan</span></a></li>
                                    </ul>
                                </li>
            <?php } ?>
            <?php if ($user_level == "Administrator"): ?>
                                <li class="nav-small-cap m-t-10">--- Referensi</li>
                                <?php if ($user_level == "Administrator" or ($user_level == 'User' and $this->session->userdata('level_unit_kerja') == 0)) { ?>
                                                    <li><a href="<?php echo base_url(); ?>ref_skpd" class="waves-effect"><i data-icon="&#xe030;"
                                                                class="linea-icon linea-aerrow fa-fw"></i> <span class="hide-menu">Ref. SKPD</span></a></li>
                                                    <li><a href="<?php echo base_url(); ?>ref_surat" class="waves-effect"><i data-icon="&"
                                                                class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu">Ref. Surat</span></a></li>
                                <?php } ?>


                                <?php if ($user_level == 'Administrator'): ?>
                                                    <!-- <li><a href="<?php echo base_url(); ?>ref_unit_kerja" class="waves-effect"><i data-icon="&#xe030;" class="linea-icon linea-aerrow fa-fw"></i> <span class="hide-menu">Ref.Unit Kerja</span></a></li> -->
                                                    <li><a href="<?php echo base_url(); ?>berkas_unit_kerja" class="waves-effect"><i
                                                                class="linea-icon linea-ecommerce fa-fw" data-icon="/"></i> <span class="hide-menu">Berkas
                                                                Tahunan</span></a></li>
                                <?php endif ?>


                                <?php if ($user_level == 'Administrator'): ?>
                                                    <li><a href="<?php echo base_url(); ?>manage_user" class="waves-effect"> <i
                                                                class="icon-user linea-basic fa-fw"></i> <span class="hide-menu">Pengguna</span></a></li>
                                <?php endif ?>

                                <!--
                <?php if (in_array('kategori_berkas', $user_privileges)): ?>
                <li><a href="<?php echo base_url(); ?>ref_kategori_berkas" class="waves-effect"><i class="linea-icon linea-basic fa-fw" data-icon="0"></i> <span class="hide-menu">Ref. Kategori Berkas</span></a></li>
                <?php endif ?>

          -->


                                <!--                     <?php if (in_array('notice', $user_privileges)): ?>
                    <li><a href="<?php echo base_url(); ?>berkas" class="waves-effect"> <i class="icon-note linea-basic fa-fw"></i> <span class="hide-menu">Data dan Berkas</span></a></li>
                        <?php endif ?>  -->

                                <!--
                    <?php if (in_array('berkas', $user_privileges)): ?>
                    <li> <a href="#" class="waves-effect"><i class="icon-note fa-fw"></i> <span class="hide-menu">Data & Berkas<span class="fa arrow"></span></span></a>
                        <ul class="nav nav-second-level">
                            <li> <a href="<?php echo base_url(); ?>berkas">Kelola Data & Berkas</a> </li>
                            <li> <a href="<?php echo base_url(); ?>quick_view">Quick View</a> </li>
                        </ul>
                    </li>
                    <?php endif ?>

              -->

                                <?php if ($user_level == 'Administrator'): ?>
                                                    <li>
                                                        <a href="#" class="waves-effect"><i data-icon="q" class="linea-icon linea-basic fa-fw"></i> <span
                                                                class="hide-menu">Front End Media<span class="fa arrow"></span></a>
                                                        <ul class="nav nav-second-level">
                                                            <li> <a href="<?php echo base_url(); ?>manage_menu">Menu</a></li>
                                                            <li> <a href="<?php echo base_url(); ?>manage_media/img_header">Header</a></li>
                                                            <li> <a href="<?php echo base_url(); ?>manage_media/banner">Banner</a></li>
                                                            <li> <a href="<?php echo base_url(); ?>manage_video">Video</a></li>
                                                            <li> <a href="<?php echo base_url(); ?>manage_category_video">Kategori Video</a></li>

                                                        </ul>
                                                    </li>
                                <?php endif ?>

            <?php endif ?>

            <?php
            if ($user_level == 'Operator') {
                ?>

                                <li class="nav-small-cap m-t-10">--- Operator</li>

                                <li><a href="<?php echo base_url(); ?>ref_skpd/view/<?= $this->session->userdata('kd_skpd') ?>"
                                        class="waves-effect"><i data-icon="&#xe030;" class="linea-icon linea-aerrow fa-fw"></i> <span
                                            class="hide-menu">Data SKPD</span></a></li>
                                <li><a href="<?php echo base_url(); ?>helpdesk" class="waves-effect"><i class="ti-headphone-alt"></i> <span
                                            class="hide-menu">Helpdesk</span></a></li>
                                <?php
            }
            ?>

            <?php if ($user_level == 'Administrator' or $user_level == 'Operator' or in_array('kepegawaian', $user_privileges) or $this->session->id_skpd == 24): ?>
                                <li class="nav-small-cap m-t-10">--- Kepegawaian</li>
            <?php endif ?>
            <?php if ($user_level == 'Administrator' or $user_level == 'Operator' or (in_array('kepegawaian', $user_privileges) && $jenis_skpd !== 'puskesmas')): ?>
                                <li>
                                    <a href="#" class="waves-effect"><i data-icon="u" class="linea-icon linea-basic fa-fw"></i> <span
                                            class="hide-menu">Kepegawaian<span class="fa arrow"></span></a>
                                    <ul class="nav nav-second-level">
                                        <?php
                                        if ($user_level !== 'Dewan') {
                                            ?>
                                                            <li><a href="<?php echo base_url(); ?>master_pegawai/index" class="waves-effect"> <span
                                                                        class="hide-menu">Master Pegawai</span></a></li>
                                                            <li><a href="<?php echo base_url(); ?>master_pegawai/posisi" class="waves-effect"> <span
                                                                        class="hide-menu">Posisi Pegawai</span></a></li>
                                                            <li><a href="<?php echo base_url(); ?>verifikasi_data_pegawai" class="waves-effect"> <span
                                                                        class="hide-menu">Verifikasi Data Pegawai</span></a></li>
                                                            <li><a href="<?php echo base_url(); ?>master_pegawai/mass_reset" class="waves-effect"> <span
                                                                        class="hide-menu">Mass Reset Password</span></a></li>
                                                            <li><a href="<?php echo base_url(); ?>simpeg" class="waves-effect"> <span
                                                                        class="hide-menu">SIMPEG</span></a></li>
                                        <?php } else {
                                            ?>

                                                            <li><a href="<?php echo base_url(); ?>master_pegawai/dewan" class="waves-effect"> <span
                                                                        class="hide-menu">Master Pegawai</span></a></li>
                                                            <?php
                                        } ?>
                                        <?php if ($user_level == 'Administrator'): ?>
                                                            <li><a href="<?php echo base_url(); ?>getbkd" class="waves-effect"> <span class="hide-menu">Simpeg
                                                                        BKD</span></a></li>
                                        <?php endif ?>

                                        <li><a href="<?php echo base_url(); ?>master_pegawai/mutasi" class="waves-effect"> <span
                                                    class="hide-menu">Mutasi Pegawai</span></a></li>


                                        <?php if ($user_level == 'Administrator'): ?>
                                                            <li><a href="<?php echo base_url(); ?>ref_tupoksi" class="waves-effect"> <span
                                                                        class="hide-menu">Ref. Tupoksi</span></a></li>
                                                            <li><a href='<?php echo base_url(); ?>ref_jabatan' class="waves-effect"> <span
                                                                        class="hide-menu">Ref. Jabatan</span></a></li>
                                        <?php endif ?>


                                    </ul>
                                </li>
            <?php endif ?>

            <?php if ($user_level == 'Administrator' or (in_array('kepegawaian', $user_privileges) && $jenis_skpd !== 'puskesmas' && $user_level !== 'Dewan') or $this->session->id_skpd == 24): ?>
                                <li>
                                    <a href="#" class="waves-effect"><i data-icon="d" class="linea-icon linea-basic fa-fw"></i> <span
                                            class="hide-menu">Proses Pensiun<span class="fa arrow"></span></a>
                                    <ul class="nav nav-second-level">
                                        <?php if ($user_level == 'Administrator' or in_array('kepegawaian', $user_privileges)) { ?>
                                                            <li><a href="<?php echo base_url(); ?>prediksi_pensiun" class="waves-effect"><span
                                                                        class="hide-menu">Prediksi Pensiun</span></a></li>
                                                            <li><a href="<?php echo base_url(); ?>usulan_pensiun" class="waves-effect"><span
                                                                        class="hide-menu">Usulan Pensiun</span></a></li>
                                                            <?php
                                        }
                                        if ($this->session->id_skpd == 24) { ?>
                                                            <li><a href="<?php echo base_url(); ?>verifikasi_usulan" class="waves-effect"><span
                                                                        class="hide-menu">Verifikasi Usulan</span></a></li>
                                                            <li><a href="<?php echo base_url(); ?>laporan_pensiun" class="waves-effect"><span
                                                                        class="hide-menu">Laporan Usulan</span></a></li>
                                        <?php } ?>
                                    </ul>
                                </li>
            <?php endif ?>


            <?php if ($user_level == 'Administrator' or (in_array('kepegawaian', $user_privileges) && $jenis_skpd !== 'puskesmas' && $user_level !== 'Dewan') or in_array('op_kepegawaian', $user_privileges)): ?>
                                <li>
                                    <a href="#" class="waves-effect"><i class="linea-icon linea-basic fa-fw" data-icon="&#xe00b;"></i> <span
                                            class="hide-menu">Kenaikan Gaji Berkala<span class="fa arrow"></span></a>
                                    <ul class="nav nav-second-level">
                                        <li><a href="<?php echo base_url(); ?>kenaikan_gaji_berkala" class="waves-effect"><span
                                                    class="hide-menu">Daftar ASN</span></a></li>
                                        <?php if ($user_level == 'Administrator'): ?>
                                                            <li><a href="<?php echo base_url(); ?>ref_pp" class="waves-effect"><span class="hide-menu">Ref.
                                                                        PP</span></a></li>
                                                            <li><a href="<?php echo base_url(); ?>ref_kgb" class="waves-effect"><span class="hide-menu">Ref.
                                                                        Gaji Pokok</span></a></li>
                                        <?php endif ?>
                                    </ul>
                                </li>
            <?php endif ?>

            <?php if ($user_level == 'Administrator' or $user_level == 'User'): ?>
                                <li>
                                    <a href="#" class="waves-effect"><i class="linea-icon linea-basic fa-fw" data-icon="&#xe00b;"></i> <span
                                            class="hide-menu">Pengajuan Surat<span class="fa arrow"></span></a>
                                    <ul class="nav nav-second-level">
                                        <li><a href="<?php echo base_url(); ?>pengajuan_surat" class="waves-effect"><span
                                                    class="hide-menu">Ajuan Surat</span></a></li>
                                        <?php if ($user_level == 'Administrator' or in_array('diklat', $user_privileges)) { ?>
                                                            <li><a href="<?php echo base_url(); ?>verifikasi_pengajuan_surat" class="waves-effect"><span
                                                                        class="hide-menu">Verifikasi Pengajuan Surat</span></a></li>
                                                            <li><a href="<?php echo base_url(); ?>ref_jenis_pengajuan_surat" class="waves-effect"><span
                                                                        class="hide-menu">Ref. Jenis Pengajuan Surat</span></a></li>
                                        <?php } ?>
                                    </ul>
                                </li>
            <?php endif ?>


            <?php if ($user_level == 'Administrator' or in_array('op_kepegawaian', $user_privileges) or (in_array('kepegawaian', $user_privileges)) && $user_level !== 'Dewan'): ?>
                                <li>
                                    <a href="#" class="waves-effect"><i class="linea-icon linea-basic fa-fw" data-icon="O"></i> <span
                                            class="hide-menu">Rekap Keg. Pegawai<span class="fa arrow"></span></a>
                                    <ul class="nav nav-second-level">
                                        <?php if ($user_level == 'Administrator' or in_array('op_kepegawaian', $user_privileges)) { ?>
                                                            <li><a href="<?php echo base_url(); ?>peer_review/rekap" class="waves-effect"><span
                                                                        class="hide-menu">Rekap Penilaian Perilaku</span></a></li>
                                                            <!-- <li><a href="<?php echo base_url(); ?>monitoring_pegawai/monitoring" class="waves-effect"><span class="hide-menu">Markonah</span></a></li> -->
                                        <?php } ?>


                                        <li><a href="<?php echo base_url(); ?>kegiatan_personal/rekap" class="waves-effect"><span
                                                    class="hide-menu">LKH Versi 2</span></a></li>
                                        <li><a href="<?php echo base_url(); ?>kegiatan_personal/laporan" class="waves-effect"><span
                                                    class="hide-menu">Laporan Keg. Personal</span></a></li>
                                        <li><a href="<?php echo base_url(); ?>laporan_kinerja_harian/rekap" class="waves-effect"><span
                                                    class="hide-menu">LKH</span></a></li>
                                    </ul>
                                </li>
            <?php endif ?>


            <?php if ($user_level == 'Administrator' or in_array('op_kepegawaian', $user_privileges)): ?>
                                <li>
                                    <a href="#" class="waves-effect"><i class="linea-icon linea-basic fa-fw" data-icon="O"></i> <span
                                            class="hide-menu">Ref. Kepegawaian<span class="fa arrow"></span></a>
                                    <ul class="nav nav-second-level">
                                        <li><a href='<?php echo base_url(); ?>ref_hari_kerja_efektif'>Ref. Hari Kerja Efektif</a></li>
                                    </ul>
                                </li>
            <?php endif ?>


            <?php if ($user_level == 'Administrator' or in_array('talenta', $user_privileges) or in_array('op_kepegawaian', $user_privileges)): ?>
                                <li>
                                    <a href="<?= base_url('skp_perencanaan') ?>" class="waves-effect"><i data-icon="S"
                                            class="linea-icon linea-ecommerce fa-fw"></i> <span class="hide-menu">IKI/SKP</a>
                                </li>

                                <li>
                                    <a href="#" class="waves-effect"><i data-icon="u" class="linea-icon linea-basic fa-fw"></i> <span
                                            class="hide-menu">Manajemen Talenta<span class="fa arrow"></span></a>
                                    <ul class="nav nav-second-level">
                                        <!--
                <?php if ($user_level == 'Administrator' or in_array('talenta', $user_privileges)): ?>

              <li class="nav-small-cap m-l-30 m-t-0">--- Analisis Kebutuhan Talent</li>
              <li><a href="<?php echo base_url(); ?>talenta/persyaratan" class="waves-effect"> <span class="hide-menu">Ref. Persyaratan</span></a></li>
              <li><a href="<?php echo base_url(); ?>talenta/kebutuhan" class="waves-effect"> <span class="hide-menu">Analisis Kebutuhan</span></a></li>
                <?php endif ?>
            <li class="nav-small-cap m-l-30 m-t-0">--- Seleksi Calon Talent</li>
                <?php
                if ($user_level == 'Administrator' or in_array('talenta', $user_privileges)) {
                    ?>

              <li><a href="<?php echo base_url(); ?>talenta/pendaftar" class="waves-effect"> <span class="hide-menu">Data ASN Pendaftar</span></a></li>
              <li><a href="<?php echo base_url(); ?>talenta/peringkat" class="waves-effect"> <span class="hide-menu">Peringkat</span></a></li>
                <?php } ?>
            <li class="nav-small-cap m-l-30 m-t-0">--- Talent Pool</li>
            <li><a href="<?php echo base_url(); ?>talenta/idp" class="waves-effect"> <span class="hide-menu">Individual Development Plan</span></a></li> -->

                                        <li><a href="<?php echo base_url(); ?>talenta/assessment" class="waves-effect"> <span
                                                    class="hide-menu">Data Talent</span></a></li>
                                        <li><a href="<?php echo base_url(); ?>talenta/peringkat_talent/ranking" class="waves-effect"> <span
                                                    class="hide-menu">Ranking Talent</span></a></li>
                                        <li><a href="<?php echo base_url(); ?>talenta/peringkat_talent/ranking_guru" class="waves-effect"> <span
                                                                    class="hide-menu">Ranking Talent Guru</span></a></li>
                                            <!-- <li><a href="<?php echo base_url(); ?>talenta/peringkat_talent/index" class="waves-effect"> <span class="hide-menu">Peringkat Struktural</span></a></li>
            <li><a href="<?php echo base_url(); ?>talenta/peringkat_talent/pelaksana" class="waves-effect"> <span class="hide-menu">Peringkat Pelaksana</span></a></li>
            <li><a href="<?php echo base_url(); ?>talenta/peringkat_talent/fungsional" class="waves-effect"> <span class="hide-menu">Peringkat Fungsional</span></a></li> -->
                                        <!-- <li><a href="<?php echo base_url(); ?>data_assement/simulasi" class="waves-effect"> <span class="hide-menu">Simulasi 9 Box</span></a></li> -->

                                    </ul>
                                </li>
            <?php endif ?>




            <?php if ($user_level == 'Administrator'): ?>
                                <li>
                                    <a href="#" class="waves-effect"><i data-icon="r" class="linea-icon linea-basic fa-fw"></i> <span
                                            class="hide-menu">Ref. Kepegawaian<span class="fa arrow"></span></a>
                                    <ul class="nav nav-second-level">
                                        <li><a href="<?php echo base_url() . "ref_agama"; ?>">Agama</a></li>
                                        <li><a href="<?php echo base_url() . "ref_statusmenikah"; ?>">Status Pernikahan</a></li>
                                        <li><a href="<?php echo base_url() . "ref_pendidikan"; ?>">Jenjang Pendidikan</a></li>
                                        <li><a href="<?php echo base_url() . "ref_tempatpendidikan"; ?>">Sekolah</a></li>
                                        <li><a href="<?php echo base_url() . "ref_jurusan"; ?>">Jurusan</a></li>
                                        <li><a href="<?php echo base_url() . "ref_gelarbelakang"; ?>">Gelar Belakang</a></li>
                                        <li><a href="<?php echo base_url() . "ref_gelardepan"; ?>">Gelar Depan</a></li>
                                        <li><a href="<?php echo base_url() . "ref_bahasa"; ?>">Bahasa Lokal</a></li>
                                        <li><a href="<?php echo base_url() . "ref_bahasa_asing"; ?>">Bahasa Asing</a></li>
                                        <li><a href="<?php echo base_url() . "ref_diklat"; ?>">Jenis Diklat</a></li>
                                        <li><a href="<?php echo base_url() . "ref_seminar"; ?>">Jenis Seminar</a></li>
                                        <li><a href="<?php echo base_url() . "ref_kursus"; ?>">Jenis Kursus</a>
                                        <li>
                                        <li><a href="<?php echo base_url() . "ref_cuti"; ?>">Jenis Cuti</a>
                                        <li>
                                        <li><a href="<?php echo base_url() . "ref_penghargaan"; ?>">Jenis Penghargaan</a>
                                        <li>
                                        <li><a href="<?php echo base_url() . "ref_jenispenugasan"; ?>">Jenis Penugasan</a>
                                        <li>
                                        <li><a href="<?php echo base_url() . "ref_hukumandisiplin"; ?>">Jenis Hukuman Disiplin</a>
                                        <li>

                                    </ul>
                                </li>
            <?php endif ?>

            <?php if ($user_level == 'Administrator' or $user_level == 'User') { ?>
                                <li>
                                    <a href="#" class="waves-effect"><i data-icon="L" class="linea-icon linea-basic fa-fw"></i> <span
                                            class="hide-menu">Bangkom<span class="fa arrow"></span></a>
                                    <ul class="nav nav-second-level">
                                        <?php if ($user_level == 'Administrator' or in_array('op_kepegawaian', $user_privileges)): ?>
                                                            <li><a href="<?php echo base_url() . "bangkom/indikator"; ?>">Ref. Indikator Kompetensi</a></li>
                                                            <li><a href="<?php echo base_url() . "bangkom/diklat"; ?>">Data Diklat</a></li>
                                        <?php endif; ?>

                                        <?php if ($user_level == 'Administrator' or in_array('kepegawaian', $user_privileges)): ?>
                                                            <li><a href="<?php echo base_url() . "bangkom/validasi"; ?>">Validasi PPK</a></li>
                                        <?php endif; ?>

                                        <?php if ($user_level == 'Administrator' or in_array('kepegawaian', $user_privileges)): ?>
                                                            <li><a href="<?php echo base_url() . "bangkom/verifikasi"; ?>">Verifikasi PYB</a></li>
                                        <?php endif; ?>

                                        <li><a href="<?php echo base_url() . "bangkom/penilaian"; ?>">Penilaian Mandiri</a></li>
                                        <?php
                                        $bawahan = $this->db->where("id_pegawai_atasan_langsung", $this->session->userdata("id_pegawai"))->get("pegawai");
                                        if ($user_level == 'Administrator' || $bawahan->num_rows() > 0) { ?>
                                                            <li><a href="<?php echo base_url() . "bangkom/identifikasi"; ?>">Dialog Atasan Bawahan</a></li>
                                        <?php } ?>
                                    </ul>
                                </li>


                                <li>
                                    <a href="#" class="waves-effect"><i data-icon="&#xe026;" class="linea-icon linea-basic fa-fw"></i> <span
                                            class="hide-menu">Keuangan<span class="fa arrow"></span></a>
                                    <ul class="nav nav-second-level">
                                        <?php if ($user_level == 'Administrator' or in_array('keuangan', $user_privileges)): ?>
                                                            <li><a href="<?php echo base_url() . "keuangan/lap_realisasi_anggaran"; ?>">BAR LRA</a></li>
                                                            <li><a href="<?php echo base_url() . "keuangan/lap_neraca"; ?>">BAR Neraca</a></li>
                                                            <li><a href="<?php echo base_url() . "keuangan/lap_operasional"; ?>">BAR LO</a></li>

                                        <?php endif; ?>

                                    </ul>
                                </li>

            <?php } ?>

            <?php if ($user_level == 'Administrator' or in_array('sicerdas_rpjmd', $user_privileges) or in_array('program', $user_privileges)): ?>
                                <li class="nav-small-cap m-t-10">--- Sicerdas </li>
            <?php endif; ?>

            <?php if ($user_level == 'Administrator' or in_array('sicerdas_rpjmd', $user_privileges)): ?>
                                <li>
                                    <a href="#" class="waves-effect"><i data-icon="&#xe026;" class="linea-icon linea-basic fa-fw"></i> <span
                                            class="hide-menu">RPJMD<span class="fa arrow"></span></a>
                                    <ul class="nav nav-second-level">
                                        <?php if ($user_level == 'Administrator'): ?>
                                                            <li><a href="<?php echo base_url() . "sicerdas/rpjmd/visimisi"; ?>">Visi Misi</a></li>
                                                            <li><a href="<?php echo base_url() . "sicerdas/rpjmd/sasaran"; ?>">Sasaran</a></li>
                                                            <li><a href="<?php echo base_url() . "sicerdas/rpjmd/urusan"; ?>">Urusan</a></li>
                                                            <li><a href="<?php echo base_url() . "sicerdas/rpjmd/program"; ?>">Program</a></li>
                                        <?php endif; ?>
                                        <li><a href="<?php echo base_url() . "sicerdas/rpjmd/laporan"; ?>">Laporan</a></li>

                                    </ul>
                                </li>
            <?php endif; ?>




            <?php if ($user_level == 'Administrator' or in_array('program', $user_privileges)): ?>
                                <li>
                                    <a href="#" class="waves-effect"><i data-icon="&#xe026;" class="linea-icon linea-basic fa-fw"></i> <span
                                            class="hide-menu">Renstra<span class="fa arrow"></span></a>
                                    <ul class="nav nav-second-level">

                                        <?php if ($user_level == 'Administrator' or in_array('program', $user_privileges)): ?>
                                                            <li><a href="<?php echo base_url() . "sicerdas/renstra/skpd/sasaran"; ?>">Sasaran</a></li>
                                                            <li><a href="<?php echo base_url() . "sicerdas/renstra/skpd/program"; ?>">Program</a></li>
                                                            <li><a href="<?php echo base_url() . "sicerdas/renstra/skpd/kegiatan"; ?>">Kegiatan</a></li>
                                        <?php endif; ?>
                                        <li><a href="<?php echo base_url() . "sicerdas/renstra/laporan"; ?>">Laporan</a></li>

                                    </ul>
                                </li>
            <?php endif; ?>
            <?php if ($user_level == 'Administrator' or in_array('program', $user_privileges)): ?>
                                <li>
                                    <a href="<?php echo base_url(); ?>sicerdas/renja/skpd" class="waves-effect">
                                        <i class="icon-direction linea-basic fa-fw"></i>
                                        <span class="hide-menu">Renja</span>
                                    </a>
                                </li>
            <?php endif; ?>
            <?php if ($user_level == 'Administrator' or in_array('tapem', $user_privileges)): ?>
                                <li>
                                    <a href="<?php echo base_url(); ?>sicerdas/renja/report" class="waves-effect">
                                        <i class="ti-file fa-fw"></i>
                                        <span class="hide-menu">Laporan</span>
                                    </a>
                                </li>

            <?php endif; ?>
            <?php if ($user_level == 'Administrator' or in_array('program', $user_privileges)): ?>
                                <!-- <li>
          <a href="<?php echo base_url(); ?>skp_sicerdas" class="waves-effect">
            <i class="icon-direction linea-basic fa-fw"></i>
            <span class="hide-menu">SKP</span>
          </a>
        </li> -->

            <?php endif; ?>

            <li class="nav-small-cap m-t-10">--- MAK SITI </li>

            <?php
            if ($pegawai) {
                $id_pegawai = $pegawai->id_pegawai;
                $dt_pegawai = $this->db
                    ->join("ref_skpd", "ref_skpd.id_skpd = pegawai.id_skpd", "left")
                    ->where("id_pegawai", $id_pegawai)->get("pegawai")->row();

                $role_pimpinan = ($dt_pegawai && $dt_pegawai->kepala_skpd == "Y" && in_array($dt_pegawai->jenis_skpd, ['skpd', 'kecamatan']));
            } else {
                $role_pimpinan = false;
            }
            ?>

            <?php if ($user_level == 'Administrator' || $role_pimpinan): ?>
                                <li>
                                    <a href="<?php echo base_url(); ?>kinerja/pk" class="waves-effect">
                                        <i class="icon-book-open linea-basic fa-fw"></i>
                                        <span class="hide-menu">Perjanjian Kerja</span>
                                    </a>
                                </li>
            <?php endif; ?>

            <?php if ($user_level == 'Administrator' or in_array('program', $user_privileges)): ?>
                                <li>
                                    <a href="<?php echo base_url(); ?>kinerja/instruksi" class="waves-effect">
                                        <i class="icon-magic-wand linea-basic fa-fw"></i>
                                        <span class="hide-menu">Instruksi Khusus</span>
                                    </a>
                                </li>

            <?php endif; ?>

            <li>
                <a href="<?php echo base_url(); ?>kinerja/matrik" class="waves-effect">
                    <i class="icon-grid linea-basic fa-fw"></i>
                    <span class="hide-menu">Matrik</span>
                </a>
            </li>

            <li>
                <a href="#" class="waves-effect"><i class="icon-note linea-basic fa-fw"></i> <span
                        class="hide-menu">SKP<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li><a href="<?php echo base_url() . "kinerja/skp/form"; ?>">Buat SKP</a></li>
                    <li><a href="<?php echo base_url() . "kinerja/skp/riwayat"; ?>">Riwayat</a></li>
                    <li><a href="<?php echo base_url() . "kinerja/skp/verifikasi"; ?>">Verifikasi SKP</a></li>
                    <li><a href="<?php echo base_url() . "kinerja/skp/arsip"; ?>">Arsip</a></li>
                </ul>
            </li>






            <li>
                <a href="<?php echo base_url(); ?>kinerja/renaksi" class="waves-effect">
                    <i class=" icon-target linea-basic fa-fw"></i>
                    <span class="hide-menu">Renaksi</span>
                </a>
            </li>

            <li>
                <a href="#" class="waves-effect"><i class="icon-notebook linea-basic fa-fw"></i> <span
                        class="hide-menu">LKH<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li><a href="<?php echo base_url(); ?>kinerja/lkh/pegawai">Input Laporan</a></li>
                    <li><a href="<?php echo base_url() . "kinerja/lkh/verifikasi"; ?>">Verifikasi Laporan</a></li>
                </ul>
            </li>

            <li>
                <a href="<?php echo base_url(); ?>kinerja/perilaku" class="waves-effect">
                    <i class=" icon-emotsmile linea-basic fa-fw"></i>
                    <span class="hide-menu">Penilaian Perilaku</span>
                </a>
            </li>

            <li>
                <a href="<?php echo base_url(); ?>kinerja/dokumentasi" class="waves-effect">
                    <i class="icon-paper-clip linea-basic fa-fw"></i>
                    <span class="hide-menu">Dokumentasi Kerja</span>
                </a>
            </li>


            <li>
                <a href="#" class="waves-effect"><i class="icon-doc linea-basic fa-fw"></i> <span
                        class="hide-menu">Laporan Pencapaian<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li><a href="<?php echo base_url() . "kinerja/laporan/evaluasi"; ?>">Evaluasi Kinerja</a></li>
                    <li><a href="<?php echo base_url() . "kinerja/laporan/skpd"; ?>">SKPD</a></li>
                    <li><a href="<?php echo base_url() . "kinerja/laporan/unit_kerja"; ?>">Unit Kerja</a></li>
                    <li><a href="<?php echo base_url() . "kinerja/laporan/pegawai"; ?>">Pegawai</a></li>
                    <?php if ($user_level == 'Administrator' || $role_pimpinan || in_array('program', $user_privileges)): ?>
                                        <li><a href="<?php echo base_url() . "kinerja/laporan/program"; ?>">Program</a></li>
                                        <li><a href="<?php echo base_url() . "kinerja/laporan/kegiatan"; ?>">Kegiatan</a></li>
                                        <li><a href="<?php echo base_url() . "kinerja/laporan/sub_kegiatan"; ?>">Sub Kegiatan</a></li>
                    <?php endif ?>
                </ul>
            </li>

            <?php if ($user_level == 'Administrator' || $role_pimpinan || in_array('program', $user_privileges)): ?>
                                <li>
                                    <a href="<?php echo base_url(); ?>kinerja/kuadran" class="waves-effect">
                                        <i class="ti ti-layout-grid2 linea-basic fa-fw"></i>
                                        <span class="hide-menu">Kuadran 9 Box</span>
                                    </a>
                                </li>
            <?php endif ?>

            <?php if ($user_level == 'Administrator' or in_array('sicerdas_rpjmd', $user_privileges)): ?>
                                <li class="nav-small-cap m-t-10">--- SIEVKA </li>
                                <li>
                                    <a href="#" class="waves-effect"><i data-icon="&#xe026;" class="linea-icon linea-basic fa-fw"></i> <span
                                            class="hide-menu">Evaluasi<span class="fa arrow"></span></a>
                                    <ul class="nav nav-second-level">
                                        <?php if ($user_level == 'Administrator'): ?>
                                                            <li><a href="<?php echo base_url() . "sievka/evaluasi/rpjmd"; ?>">Evaluasi RPJMD</a></li>
                                                            <li><a href="<?php echo base_url() . "sievka/evaluasi/rkpd"; ?>">Evaluasi RPKD</a></li>
                                                            <li><a href="<?php echo base_url() . "sievka/evaluasi/renja"; ?>">Evaluasi Renja</a></li>
                                                            <li><a href="<?php echo base_url() . "sievka/evaluasi/urusan"; ?>">Evaluasi Per-Urusan</a></li>
                                        <?php endif; ?>

                                    </ul>
                                </li>
            <?php endif; ?>




            <?php if (in_array('unit_kerja', $user_privileges) && $user_level == 'Administrator'): ?>


            <?php endif ?>

            <?php if ($user_level == 'Administrator' or in_array('kepegawaian', $user_privileges)): ?>
                                <!-- <li>
          <a href="#" class="waves-effect"><i data-icon="r" class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu">Absensi<span class="fa arrow"></span></a>
          <ul class="nav nav-second-level">
            <li><a href='<?php echo base_url(); ?>ref_hari_libur'>Ref. Hari Libur</a></li>
            <li><a href='<?php echo base_url(); ?>ref_absensi'>Ref. Absensi</a></li>
            <li><a href='<?php echo base_url(); ?>pengajuan_absensi'>Pengajuan Absensi</a></li>
            <li><a href='<?php echo base_url(); ?>laporan_absensi'>Laporan Absensi</a></li>

          </ul>
        </li> -->
            <?php endif ?>

            <?php if ($user_level == 'Administrator' or $user_level == 'User') { ?>
                                <li class="nav-small-cap m-t-10">--- SIPECI & SIPERA</li>

                                <li>
                                    <a href="#" class="waves-effect"><i class="ti-map-alt fa-fw"></i> <span class="hide-menu">Permintaan
                                            Cuti<span class="fa arrow"></span></a>
                                    <ul class="nav nav-second-level">
                                        <li><a href="<?php echo base_url() . "permintaan_cuti/index"; ?>">Pengajuan</a></li>
                                        <?php if ($user_level == 'Administrator' or in_array('kepegawaian', $user_privileges) or $this->session->id_skpd == 24) { ?>
                                                            <li><a href="<?php echo base_url() . "permintaan_cuti/verifikasi"; ?>">Verifikasi</a></li>
                                        <?php } ?>

                                    </ul>
                                </li>
                                <li>
                                    <a href="#" class="waves-effect"><i class="ti-unlink fa-fw"></i> <span class="hide-menu">Izin
                                            Perceraian<span class="fa arrow"></span></a>
                                    <ul class="nav nav-second-level">
                                        <li><a href="<?php echo base_url() . "izin_cerai/index"; ?>">Pengajuan</a></li>
                                        <?php if ($user_level == 'Administrator' or in_array('kepegawaian', $user_privileges) or $this->session->id_skpd == 24) { ?>
                                                            <li><a href="<?php echo base_url() . "izin_cerai/verifikasi"; ?>">Verifikasi</a></li>
                                        <?php } ?>
                                    </ul>
                                </li>

                                <?php if ($user_level == 'Administrator' or (in_array('kepegawaian', $user_privileges))) { ?>
                                                    <li>
                                                        <a href="#" class="waves-effect"><i class="ti-pulse fa-fw"></i> <span class="hide-menu">Laporan<span
                                                                    class="fa arrow"></span></a>
                                                        <ul class="nav nav-second-level">
                                                            <li><a href="<?php echo base_url() . "permintaan_cuti/laporan"; ?>">Permintaan Cuti</a></li>
                                                            <li><a href="<?php echo base_url() . "izin_cerai/laporan"; ?>">Izin Perceraian</a></li>
                                                        </ul>
                                                    </li>
                                <?php } ?>
            <?php } ?>
            <?php if ($user_level == 'Administrator' or in_array('sicerdas_rpjmd', $user_privileges)): ?>
                                <li class="nav-small-cap m-t-10">--- Sijagur </li>

                                <li>
                                    <a href="<?= base_url('sijagur/monitoring') ?>" class="waves-effect"><i data-icon="&#xe026;"
                                            class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu">Monitoring</a>
                                </li>
            <?php endif; ?>

            <?php if ($user_level == 'Administrator' or in_array('program', $user_privileges) or in_array('inspektorat', $user_privileges)): ?>
                                <li class="nav-small-cap m-t-10">--- MAUTI</li>
            <?php endif ?>

            <?php if ($user_level == 'Administrator'): ?>
                                <li>
                                    <a href="#" class="waves-effect"><i data-icon="a" class="linea-icon linea-software fa-fw"></i> <span
                                            class="hide-menu">RPJMD<span class="fa arrow"></span></a>
                                    <ul class="nav nav-second-level">
                                        <?php /*if (in_array('header', $user_privileges)):*/?>
                                        <?php if ($user_level == 'Administrator') { ?>
                                                            <li><a href='<?php echo base_url(); ?>ref_visi_misi'>Visi Misi </a></li>
                                        <?php } ?>

                                        <?php if ($user_level == 'Administrator') { ?>
                                                            <li><a href='<?php echo base_url(); ?>sasaran_rpjmd'>Sasaran </a></li>
                                        <?php } ?>

                                        <?php if ($user_level == 'Administrator') { ?>
                                                            <li><a href='<?php echo base_url(); ?>program_rpjmd'>Program </a></li>
                                        <?php } ?>




                                    </ul>
                                </li>
            <?php endif ?>


            <?php if ($user_level == 'Administrator' or in_array('program', $user_privileges) or in_array('inspektorat', $user_privileges)): ?>
                                <li>
                                    <a href="#" class="waves-effect"><i data-icon="a" class="linea-icon linea-software fa-fw"></i> <span
                                            class="hide-menu">RENSTRA<span class="fa arrow"></span></a>
                                    <ul class="nav nav-second-level">
                                        <?php /*if (in_array('header', $user_privileges)):*/?>

                                        <?php if ($user_level == 'Administrator' or in_array('program', $user_privileges)): ?>
                                                            <li><a href='<?php echo base_url(); ?>renstra_perencanaan'>Perencanaan</a></li>
                                                            <li><a href='<?php echo base_url(); ?>renstra_realisasi'>Realisasi</a></li>
                                        <?php endif ?>
                                        <?php if ($user_level == 'Administrator' or in_array('inspektorat', $user_privileges)): ?>
                                                            <li><a href='<?php echo base_url(); ?>renstra_reviu'>Reviu</a></li>
                                        <?php endif ?>


                                    </ul>
                                </li>
            <?php endif ?>


            <?php if ($user_level == 'Administrator' or in_array('program', $user_privileges)): ?>
                                <li>
                                    <a href="#" class="waves-effect"><i data-icon="&#xe02e;" class="linea-icon linea-aerrow fa-fw"></i>
                                        <span class="hide-menu">RENJA<span class="fa arrow"></span></a>
                                    <ul class="nav nav-second-level">
                                        <li><a href='<?php echo base_url(); ?>renja_perencanaan'>Rencana Kerja</a></li>
                                        <li><a href='<?php echo base_url(); ?>renja_rka'>Rencana Kerja Anggaran</a></li>
                                        <li><a href='<?php echo base_url(); ?>berkas_lakip'>Berkas LAKIP</a></li>
                                        <!-- <li><a href='<?php echo base_url(); ?>perjanjian_kinerja'>Perjanjian Kinerja</a></li> -->
                                    </ul>
                                </li>
            <?php endif ?>


            <?php if ($user_level == "Administrator" or in_array('inspektorat', $user_privileges)): ?>
                                <li>
                                    <a href="<?php echo base_url(); ?>evaluasi" class="waves-effect">
                                        <i class="icon-direction linea-basic fa-fw"></i>
                                        <span class="hide-menu">Evaluasi</span>
                                    </a>
                                </li>
            <?php endif ?>


            <?php if ($user_level == 'Administrator' or in_array('program', $user_privileges)): ?>
                                <li>
                                    <a href="#" class="waves-effect"><i data-icon="S" class="linea-icon linea-ecommerce fa-fw"></i> <span
                                            class="hide-menu">Laporan MAUTI<span class="fa arrow"></span></a>
                                    <ul class="nav nav-second-level">
                                        <li>
                                            <a href="javascript:void(0)" class="waves-effect">RPJMD<span class="fa arrow"></span></a>
                                            <ul class="nav nav-third-level">

                                                <li><a href='<?php echo base_url(); ?>laporan_rpjmd/perencanaan'>Matriks</a></li>
                                            </ul>
                                        </li>

                                        <li>
                                            <a href="javascript:void(0)" class="waves-effect">Renstra<span class="fa arrow"></span></a>
                                            <ul class="nav nav-third-level">
                                                <li><a href='<?php echo base_url(); ?>laporan/perencanaan'>Laporan Perencanaan</a></li>
                                                <li><a href='<?php echo base_url(); ?>laporan/pencapaian'>Laporan Pencapaian</a></li>


                                            </ul>
                                        </li>

                                        <li>
                                            <a href="javascript:void(0)" class="waves-effect">Renja<span class="fa arrow"></span></a>
                                            <ul class="nav nav-third-level">
                                                <li><a href='<?php echo base_url(); ?>laporan/lap_renja'>Lap. Renja</a></li>
                                                <li><a href='<?php echo base_url(); ?>laporan/pohonkerja'>Visual Pohon Kerja</a></li>
                                                <li><a href='<?php echo base_url(); ?>laporan/pengukuran_unitkerja'>Visual Pengukuran</a>
                                                </li>
                                            </ul>
                                        </li>

                                        <li>
                                            <a href="javascript:void(0)" class="waves-effect">Renaksi<span class="fa arrow"></span></a>
                                            <ul class="nav nav-third-level">
                                                <li><a href='<?php echo base_url(); ?>laporan/lap_renaksi'>Laporan Rencana Aksi</a></li>

                                            </ul>
                                        </li>

                                        <li><a href='<?php echo base_url(); ?>laporan/pegawai'>Kinerja Pegawai</a></li>

                                    </ul>
                                </li>
            <?php endif ?>

            <?php if ($user_level == 'Administrator' or in_array('sakip_desa', $user_privileges)): ?>
                                <li class="nav-small-cap m-t-10">--- DESA</li>
            <?php endif ?>

            <?php if ($user_level == 'Administrator' or in_array('sakip_desa', $user_privileges)): ?>
                                <li>
                                    <a href='<?php echo base_url(); ?>sakip_desa' class="waves-effect"><i data-icon="a"
                                            class="linea-icon linea-software fa-fw"></i> <span class="hide-menu">SAKIP Desa</a>
                                </li>
            <?php endif ?>

            <?php
            if ($user_level !== 'Operator') {
                ?>

                                <?php if ($user_level == 'Administrator' or $user_level !== 'Operator' or in_array('default', $user_privileges)): ?>
                                                    <li class="nav-small-cap m-t-10">--- Tata Naskah Surat</li>
                                <?php endif ?>

                                <?php if ($user_level == 'Administrator' or in_array('default', $user_privileges) or in_array('tu_pimpinan', $user_privileges)): ?>
                                                    <li>
                                                        <a href="#" class="waves-effect"><i data-icon="(" class="linea-icon linea-basic fa-fw"></i> <span
                                                                class="hide-menu">Surat Internal<span class="fa arrow"></span></a>
                                                        <ul class="nav nav-second-level">
                                                            <li class="nav-small-cap m-l-30 m-t-0">--- Surat Masuk</li>
                                                            <li><a class="count" href='<?php echo base_url(); ?>surat_internal/surat_masuk'>List Surat Masuk</a>
                                                            </li>
                                                            <li><a class="count" href="<?php echo base_url(); ?>surat_disposisi/internal">Disposisi Masuk</a>
                                                            </li>
                                                            <li class="nav-small-cap m-l-30 m-t-0">--- Surat Keluar</li>
                                                            <li><a class="count" href='<?php echo base_url(); ?>surat_internal/surat_keluar'>List Surat
                                                                    Keluar</a></li>
                                                            <li><a class="count" href='<?php echo base_url(); ?>surat_internal/verifikasi_surat'>Verifikator
                                                                    Surat</a></li>
                                                            <li><a class="count" href="<?php echo base_url(); ?>surat_internal/tanda_tangan">Tanda Tangan</a>
                                                            </li>
                                                            <li><a class="count" href='<?php echo base_url(); ?>surat_tembusan/index/internal'>Tembusan</a></li>
                                                            <li><a class="count" href="<?php echo base_url(); ?>surat_disposisi/internal_keluar">Disposisi
                                                                    Keluar</a> </li>
                                                        </ul>
                                                    </li>
                                <?php endif ?>

                                <?php if ($user_level == 'Administrator' or in_array('default', $user_privileges) or in_array('tu_pimpinan', $user_privileges)): ?>
                                                    <li>
                                                        <a href="#" class="waves-effect"><i data-icon=")" class="linea-icon linea-basic fa-fw"></i> <span
                                                                class="hide-menu">Surat Eksternal<span class="fa arrow"></span></a>
                                                        <ul class="nav nav-second-level">
                                                            <li class="nav-small-cap m-l-30 m-t-0">--- Surat Masuk</li>
                                                            <li><a class="count" href='<?php echo base_url(); ?>surat_eksternal/surat_masuk'>List Surat
                                                                    Masuk</a></li>
                                                            <li><a class="count" href="<?php echo base_url(); ?>surat_disposisi/eksternal">Disposisi Masuk</a>
                                                            </li>
                                                            <li class="nav-small-cap m-l-30 m-t-0">--- Surat Keluar</li>
                                                            <li><a class="count" href='<?php echo base_url(); ?>surat_eksternal/surat_keluar'>List Surat
                                                                    Keluar</a></li>
                                                            <li><a class="count" href='<?php echo base_url(); ?>surat_eksternal/verifikasi_surat'>Verifikator
                                                                    Surat </a></li>
                                                            <li><a class="count" href="<?php echo base_url(); ?>surat_eksternal/tanda_tangan">Tanda Tangan</a>
                                                            </li>
                                                            <li><a class="count" href='<?php echo base_url(); ?>surat_tembusan/index/eksternal'>Tembusan</a>
                                                            </li>
                                                            <li><a class="count" href="<?php echo base_url(); ?>surat_disposisi/eksternal_keluar">Disposisi
                                                                    Keluar</a> </li>

                                                        </ul>
                                                    </li>
                                <?php endif ?>


                                <?php if ($user_level == 'Administrator' or in_array('tu_pimpinan', $user_privileges)): ?>
                                                    <li>
                                                        <a href="#" class="waves-effect"><i data-icon=")" class="linea-icon linea-basic fa-fw"></i> <span
                                                                class="hide-menu">Arsip & Register Surat<span class="fa arrow"></span></a>

                                                        <ul class="nav nav-second-level">
                                                            <li><a href="<?php echo base_url(); ?>penomoran_surat" class="waves-effect">Penomoran Surat
                                                                    Keluar</a>
                                                            <li><a href="<?php echo base_url(); ?>arsip_surat" class="waves-effect">Arsip Surat Masuk</a>
                                                            <li><a href="<?php echo base_url(); ?>register_surat" class="waves-effect">Arsip Surat Keluar </a>

                                                            </li>
                                                        </ul>
                                                    </li>
                                <?php endif ?>


                                <?php if ($user_level == 'Administrator' or in_array('default', $user_privileges)): ?>
                                                    <li>
                                                        <a href="#" class="waves-effect"><i data-icon=")" class="linea-icon linea-basic fa-fw"></i> <span
                                                                class="hide-menu">Monitoring Surat<span class="fa arrow"></span></a>

                                                        <ul class="nav nav-second-level">
                                                            <li><a href="<?php echo base_url(); ?>monitoring_surat_keluar" class="waves-effect">Surat Keluar
                                                                </a>
                                                            <li><a href="<?php echo base_url(); ?>monitoring_surat_masuk" class="waves-effect">Surat Masuk</a>
                                                            </li>
                                                        </ul>
                                                    </li>
                                <?php endif ?>

                                <?php if ($user_level == 'Administrator' or $user_level == 'User') { ?>
                                                    <?php
                                                    $mulai = 0;
                                                    $hal = 1;
                                                    $filter = '';
                                                    $lap_ttd = 0;

                                                    $CI = &get_instance();
                                                    $CI->load->model('lap_operasional_model');
                                                    $CI->load->model('lap_realisasi_anggaran_model');
                                                    $CI->load->model('lap_neraca_model');

                                                    $listlap1 = $CI->lap_operasional_model->get_page_ttd($mulai, $hal, $filter);
                                                    $listlap2 = $CI->lap_realisasi_anggaran_model->get_page_ttd($mulai, $hal, $filter);
                                                    $listlap3 = $CI->lap_neraca_model->get_page_ttd($mulai, $hal, $filter);

                                                    $lap_ttd += (int) count($listlap1);
                                                    $lap_ttd += (int) count($listlap2);
                                                    $lap_ttd += (int) count($listlap3);
                                                    ?>
                                                    <li><a href="<?php echo base_url() . "keuangan/lap_ttd"; ?>"><i data-icon=")"
                                                                class="linea-icon linea-basic fa-fw"></i> TTD Lap. Keuangan <span
                                                                class="fa fa-circle text-danger <?= ($lap_ttd > 0) ? '' : 'hide' ?>"></span></a></li>
                                <?PHP } ?>

                                <?php if ($user_level == 'Administrator' or in_array('tu_pimpinan', $user_privileges)): ?>
                                                    <li>
                                                        <a href="#" class="waves-effect"><i data-icon=")" class="linea-icon linea-basic fa-fw"></i> <span
                                                                class="hide-menu">Laporan Surat<span class="fa arrow"></span></a>
                                                        <ul class="nav nav-second-level">
                                                            <li>
                                                                <a href="javascript:void(0)" class="waves-effect">Data Surat<span class="fa arrow"></span></a>
                                                                <ul class="nav nav-third-level">
                                                                    <li><a href='<?php echo base_url(); ?>laporan_surat/surat_masuk'>Surat Masuk</a></li>
                                                                    <li><a href="<?php echo base_url(); ?>laporan_surat/surat_keluar">Surat Keluar</a> </li>
                                                                </ul>
                                                            </li>
                                                        </ul>
                                                        <ul class="nav nav-second-level">
                                                            <li>
                                                                <a href="<?php echo base_url(); ?>laporan_surat/grafik_surat" class="waves-effect">Grafik
                                                                    Surat</a>
                                                            </li>
                                                            <li>
                                                                <a href="<?php echo base_url(); ?>laporan_surat/statistik_skpd" class="waves-effect">Statistik
                                                                    SKPD</a>
                                                            </li>
                                                        </ul>
                                                    </li>
                                <?php endif ?>



            <?php } ?>


                        <?php if ($user_level == 'Administrator' or $user_level == 'User') { ?>
                              <li class="nav-small-cap m-t-10">--- SIMAPAN</li>
                        <?php if ($user_level == 'Administrator' or in_array('simapan', $user_privileges) or in_array('tu_pimpinan', $user_privileges)): ?>
                                          <li>
                                            <a href="#" class="waves-effect"><i data-icon="(" class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu">Naskah Internal<span class="fa arrow"></span></a>
                                            <ul class="nav nav-second-level">
                                              <li class="nav-small-cap m-l-30 m-t-0">--- Naskah Masuk</li>
                                              <li><a class="count" href='<?php echo base_url(); ?>naskah/surat_internal/surat_masuk'>List Naskah Masuk</a></li>
                                              <li><a class="count" href="<?php echo base_url(); ?>naskah/surat_disposisi/internal">Disposisi Masuk</a> </li>
                                              <li class="nav-small-cap m-l-30 m-t-0">--- Naskah Keluar</li>
                                              <li><a class="count" href='<?php echo base_url(); ?>naskah/surat_internal/surat_keluar'>List Naskah Keluar</a></li>
                                              <li><a class="count" href='<?php echo base_url(); ?>naskah/surat_internal/verifikasi_surat'>Verifikator Naskah</a></li>
                                              <li><a class="count" href="<?php echo base_url(); ?>naskah/surat_internal/tanda_tangan">Tanda Tangan</a> </li>
                                              <li><a class="count" href='<?php echo base_url(); ?>naskah/surat_tembusan/index/internal'>Tembusan</a></li>
                                              <li><a class="count" href="<?php echo base_url(); ?>naskah/surat_disposisi/internal_keluar">Disposisi Keluar</a> </li>

                                            </ul>
                                          </li>
                        <?php endif ?>

                          <li> <a href="#" class="waves-effect"><i data-icon=")" class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu">Naskah Eksternal<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                              <li class="nav-small-cap m-l-30 m-t-0">--- Naskah Masuk</li>
                              <li><a class="count" href='<?php echo base_url(); ?>naskah/surat_eksternal/surat_masuk'>List Naskah Masuk</a></li>
                              <li><a class="count" href="<?php echo base_url(); ?>naskah/surat_disposisi/eksternal">Disposisi Masuk</a> </li>
                              <li class="nav-small-cap m-l-30 m-t-0">--- Naskah Keluar</li>
                              <li><a class="count" href='<?php echo base_url(); ?>naskah/surat_eksternal/surat_keluar'>List Naskah Keluar</a></li>
                              <li><a class="count" href='<?php echo base_url(); ?>naskah/surat_eksternal/verifikasi_surat'>Verifikator Naskah </a></li>
                              <li><a class="count" href="<?php echo base_url(); ?>naskah/surat_eksternal/tanda_tangan">Tanda Tangan</a> </li>
                              <li><a class="count" href='<?php echo base_url(); ?>naskah/surat_tembusan/index/eksternal'>Tembusan</a></li>
                              <li><a class="count" href="<?php echo base_url(); ?>naskah/surat_disposisi/eksternal_keluar">Disposisi Keluar</a> </li>

                            </ul>
                          </li>

                              <?php if ($user_level == 'Administrator' or in_array('tu_pimpinan', $user_privileges)): ?>
                                          <li>
                                              <a href="javascript:void(0);" class="waves-effect">
                                                  <i data-icon=")" class="linea-icon linea-basic fa-fw"></i>
                                                  <span class="hide-menu">Kartu Kendali</span><span class="fa arrow"></span> </a>
                                              <ul class="nav nav-second-level">
                                                  <li><a class="count" href='<?php echo base_url(); ?>naskah/arsip_dinamis/kartu_kendali/keluar'>Kendali Keluar</a></li>
                                                  <li><a class="count" href='<?php echo base_url(); ?>naskah/arsip_dinamis/kartu_kendali/masuk'>Kendali Masuk</a></li>
                                              </ul>
                                          </li>
                              <?php endif; ?>

                        <?php if ($user_level == 'Administrator' or in_array('tu_pimpinan', $user_privileges)): ?>
                                          <li>
                                            <a href="#" class="waves-effect"><i data-icon=")" class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu">Berkas<span class="fa arrow"></span></a>

                                            <ul class="nav nav-second-level">
                                              <li><a href="<?php echo base_url(); ?>naskah/arsip_dinamis/berkas_aktif" class="waves-effect">Daftar Berkas Aktif</a>
                                              <li><a href="<?php echo base_url(); ?>naskah/arsip_dinamis/pindah_berkas" class="waves-effect">Daftar Pemindahan Berkas</a>
                                              <li><a href="<?php echo base_url(); ?>naskah/arsip_dinamis/berkas_inaktif" class="waves-effect">Daftar Berkas Inaktif</a>
                                              <li><a href="<?php echo base_url(); ?>naskah/arsip_dinamis/pinjam_berkas" class="waves-effect">Daftar Peminjaman Berkas</a>
                                              </li>
                                            </ul>
                                          </li>
                        <?php endif ?>

                        <?php if ($user_level == 'Administrator' or in_array('tu_pimpinan', $user_privileges)): ?>
                                          <li>
                                            <a href="#" class="waves-effect"><i data-icon=")" class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu">Penyerahan Berkas<span class="fa arrow"></span></a>

                                            <ul class="nav nav-second-level">
                                              <li><a href="<?php echo base_url(); ?>naskah/arsip_dinamis/usul_musnah" class="waves-effect">Daftar Usulan Musnah</a>
                                              <li><a href="<?php echo base_url(); ?>naskah/arsip_dinamis/usul_permanen" class="waves-effect">Daftar Usulan Permanen</a>
                                              </li>
                                            </ul>
                                          </li>
                        <?php endif ?>




                        <?php if ($user_level == 'Administrator' or in_array('tu_pimpinan', $user_privileges)): ?>
                                          <li>
                                            <a href="#" class="waves-effect"><i data-icon=")" class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu">Arsip & Register Surat<span class="fa arrow"></span></a>

                                            <ul class="nav nav-second-level">
                                              <li><a href="<?php echo base_url(); ?>naskah/penomoran_surat" class="waves-effect">Penomoran Surat Keluar</a>
                                              <li><a href="<?php echo base_url(); ?>naskah/arsip_surat" class="waves-effect">Arsip Surat Masuk</a>
                                              <li><a href="<?php echo base_url(); ?>naskah/register_surat" class="waves-effect">Arsip Surat Keluar </a>

                                              </li>
                                            </ul>
                                          </li>
                        <?php endif ?>


                        <?php if ($user_level == 'Administrator' or in_array('simapan', $user_privileges)): ?>
                                          <li>
                                            <a href="#" class="waves-effect"><i data-icon=")" class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu">Monitoring Surat<span class="fa arrow"></span></a>

                                            <ul class="nav nav-second-level">
                                              <li><a href="<?php echo base_url(); ?>monitoring_surat_keluar" class="waves-effect">Surat Keluar </a>
                                              <li><a href="<?php echo base_url(); ?>monitoring_surat_masuk" class="waves-effect">Surat Masuk</a>
                                              </li>
                                            </ul>
                                          </li>
                        <?php endif ?>


                        <?php if ($user_level == 'Administrator' or in_array('tu_pimpinan', $user_privileges)): ?>
                                          <li>
                                            <a href="#" class="waves-effect"><i data-icon=")" class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu">Laporan Surat<span class="fa arrow"></span></a>
                                            <ul class="nav nav-second-level">
                                              <li>
                                                <a href="javascript:void(0)" class="waves-effect">Data Surat<span class="fa arrow"></span></a>
                                                <ul class="nav nav-third-level">
                                                  <li><a href='<?php echo base_url(); ?>laporan_surat/surat_masuk'>Surat Masuk</a></li>
                                                  <li><a href="<?php echo base_url(); ?>laporan_surat/surat_keluar">Surat Keluar</a> </li>
                                                </ul>
                                              </li>
                                            </ul>
                                            <ul class="nav nav-second-level">
                                              <li>
                                                <a href="<?php echo base_url(); ?>laporan_surat/grafik_surat" class="waves-effect">Grafik Surat</a>
                                              </li>
                                              <li>
                                                <a href="<?php echo base_url(); ?>laporan_surat/statistik_skpd" class="waves-effect">Statistik SKPD</a>
                                              </li>
                                            </ul>
                                          </li>
                        <?php endif ?>
        <?php } ?>
            <!-- <?php if ($user_level == 'Administrator' or $this->session->userdata('id_skpd') == 1) { ?>

        <li class="nav-small-cap m-t-10">--- SIPANDA</li>
        <li>
          <a href="#" class="waves-effect"><i class="ti-settings fa-fw"></i> <span class="hide-menu">Pengaturan<span class="fa arrow"></span></a>
          <ul class="nav nav-second-level">
            <li><a href='<?php echo base_url(); ?>perjalanan_dinas/ttd'>Penandatangan</a></li>
          </ul>
        </li>
        <li>
          <a href="#" class="waves-effect"><i class="ti-map-alt fa-fw"></i> <span class="hide-menu">Perjalanan Dinas<span class="fa arrow"></span></a>
          <ul class="nav nav-second-level">
            <li><a href='<?php echo base_url(); ?>perjalanan_dinas/index'>Pengajuan</a></li>
            <li><a href='<?php echo base_url(); ?>perjalanan_dinas/verifikasi'>Verifikasi</a></li>
          </ul>
        </li>

        <li>
          <a href="#" class="waves-effect"><i class="ti-agenda fa-fw"></i> <span class="hide-menu">Laporan<span class="fa arrow"></span></a>
          <ul class="nav nav-second-level">
            <li><a href='<?php echo base_url(); ?>perjalanan_dinas/laporan'>Rekap Pencairan</a></li>
            <li><a href='<?php echo base_url(); ?>perjalanan_dinas/laporan/bagian'>Rekap per Bagian</a></li>
            <li><a href='<?php echo base_url(); ?>perjalanan_dinas/laporan/pegawai'>Rekap per Pegawai</a></li>
            <li><a href='<?php echo base_url(); ?>perjalanan_dinas/bku'>Buku Kas Umum</a></li>
          </ul>
        </li>
      <?php } ?> -->

            <?php if ($user_level == 'Administrator' or in_array('default', $user_privileges) or in_array('op_kepegawaian', $user_privileges)): ?>
                                <li class="nav-small-cap m-t-10">--- Kegiatan dan Agenda</li>



                                <!-- <li>
          <a href="#" class="waves-effect"><i data-icon="S" class="linea-icon linea-ecommerce fa-fw"></i> <span class="hide-menu">Agenda<span class="fa arrow"></span></a>
          <ul class="nav nav-second-level">

            <li><a href='<?php echo base_url(); ?>agenda_umum'>Agenda Umum</a></li>
            <li><a href='<?php echo base_url(); ?>agenda_pribadi'>Agenda Pribadi</a></li>
          </ul>
        </li> -->


                                <?php if ($user_level == 'Administrator' or in_array('op_kepegawaian', $user_privileges) or $nama_unit_kerja == 'Sekretaris' or in_array('auditor_lke', $user_privileges) or in_array('rb_zi', $user_privileges) or in_array('setting_pokja', $user_privileges)) { ?>
                                                    <li>
                                                        <a href="#" class="waves-effect"><i class="icon-notebook fa-fw"></i> <span class="hide-menu">Lembar
                                                                Kerja Evaluasi<span class="fa arrow"></span></a>
                                                        <ul class="nav nav-second-level">
                                                            <?php
                                                            if ($user_level == 'Administrator' or $nama_unit_kerja == 'Sekretaris' or in_array('rb_zi', $user_privileges)) {
                                                                ?>
                                                                                <li><a href='<?php echo base_url(); ?>lembar_kerja_evaluasi/zi_wbk'>ZI</a></li>
                                                                                <li><a href='<?php echo base_url(); ?>lembar_kerja_evaluasi/rb'>Reformasi Birokrasi</a></li>
                                                            <?php } ?>
                                                            <?php
                                                            if ($user_level == 'Administrator' or $nama_unit_kerja == 'Sekretaris' or in_array('setting_pokja', $user_privileges)) {
                                                                ?>
                                                                                <li><a href='<?php echo base_url(); ?>lembar_kerja_evaluasi/setting_zi'>Setting Penanggungjawab
                                                                                        ZI</a></li>
                                                                                <li><a href='<?php echo base_url(); ?>lembar_kerja_evaluasi/setting_rb'>Setting Penanggungjawab
                                                                                        RB</a></li>
                                                                                <li><a href='<?php echo base_url(); ?>lembar_kerja_evaluasi/verifikasi_atasan/zi_wbk'>Verifikasi
                                                                                        Atasan ZI</a></li>
                                                                                <li><a href='<?php echo base_url(); ?>lembar_kerja_evaluasi/verifikasi_atasan/rb'>Verifikasi Atasan
                                                                                        RB</a></li>
                                                            <?php } ?>
                                                            <?php
                                                            if ($user_level == 'Administrator' or in_array('auditor_lke', $user_privileges)) {
                                                                ?>
                                                                                <!-- <li><a href='<?php echo base_url(); ?>lembar_kerja_evaluasi/koreksi/zi_wbk'>Koreksi ZI</a></li> -->
                                                                                <li><a href='<?php echo base_url(); ?>lembar_kerja_evaluasi/koreksi_v2/zi_wbk'>Koreksi ZI V2</a>
                                                                                </li>
                                                                                <!-- <li><a href='<?php echo base_url(); ?>lembar_kerja_evaluasi/koreksi/rb'>Koreksi RB</a></li> -->
                                                                                <li><a href='<?php echo base_url(); ?>lembar_kerja_evaluasi/koreksi_v2/rb'>Koreksi RB V2</a></li>

                                                            <?php } ?>
                                                        </ul>
                                                    </li>
                                <?php } ?>

                                <!-- <li>
          <a href="#" class="waves-effect"><i data-icon="U" class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu">Laporan Rapat<span class="fa arrow"></span></a>
          <ul class="nav nav-second-level">
            <li> <a href="<?php echo base_url(); ?>laporan_rapat">Laporan Rapat</a></li>
            <li> <a href="<?php echo base_url(); ?>verifikator_laporan_rapat">Verifikasi Laporan</a></li>
          </ul>
        </li> -->

                                <?php
                                if ($user_level == 'Dewan') {
                                    ?>
                                                    <li>
                                                        <a href="javascript:void(0)" class="waves-effect"><i data-icon="S"
                                                                class="linea-icon linea-ecommerce fa-fw"></i><span class="hide-menu">Legislasi<span
                                                                    class="fa arrow"></span></a>
                                                        <ul class="nav nav-second-level">
                                                            <li><a href='<?php echo base_url(); ?>legislasi'>Target Kegiatan</a></li>
                                                            <li><a href="<?php echo base_url(); ?>realisasi_kegiatan">Realisasi Kegiatan</a> </li>
                                                            <li><a href="<?php echo base_url(); ?>monitoring_kegiatan">Monitoring Pekerjaan</a> </li>

                                                        </ul>
                                                    </li>
                                                    <?php
                                } else {
                                    ?>
                                                    <li>
                                                        <a href="javascript:void(0)" class="waves-effect"><i data-icon="S"
                                                                class="linea-icon linea-ecommerce fa-fw"></i><span class="hide-menu">Kegiatan Tim<span
                                                                    class="fa arrow"></span></a>
                                                        <ul class="nav nav-second-level">
                                                            <li><a href='<?php echo base_url(); ?>kegiatan'>Target Kegiatan</a></li>
                                                            <li><a href="<?php echo base_url(); ?>realisasi_kegiatan">Realisasi Kegiatan</a> </li>
                                                            <li><a href="<?php echo base_url(); ?>monitoring_kegiatan">Monitoring Kegiatan</a> </li>

                                                        </ul>
                                                    </li>
                                                    <?php
                                }
                                ?>


                                <li>
                                    <a href="javascript:void(0)" class="waves-effect"><i data-icon="S"
                                            class="linea-icon linea-ecommerce fa-fw"></i><span class="hide-menu">Kegiatan Personal<span
                                                class="fa arrow"></span></a>
                                    <ul class="nav nav-second-level">
                                        <li><a href='<?php echo base_url(); ?>kegiatan_personal'>Kegiatan Personal</a></li>
                                        <li><a href="<?php echo base_url(); ?>verifikasi_kegiatan_personal">Verifikasi Kegiatan</a> </li>
                                        <?php if ($user_level == 'Administrator') { ?>
                                                            <li><a href="<?php echo base_url(); ?>kegiatan_personal/rekap">Rekap Kegiatan</a> </li>
                                        <?php } ?>
                                    </ul>
                                </li>

            <?php endif ?>



            <!-- <?php if ($user_level == 'Administrator' or in_array('op_kepegawaian', $user_privileges) or $user_level == 'User'): ?>

        <li><a href="<?php echo base_url(); ?>catatan" class="waves-effect"> <i class="icon-pin linea-basic fa-fw"></i> <span class="hide-menu">Catatan</span></a></li>
            <?php
            if ($this->session->userdata('kepala_skpd') == 'Y' || $this->session->userdata('level') == 'Administrator') {
                ?>
          <li>
            <a href="#" class="waves-effect"><i class="icon-home fa-fw"></i> <span class="hide-menu">Markonah<span class="fa arrow"></span></a>
            <ul class="nav nav-second-level">
              <li> <a href="<?php echo base_url(); ?>kerja_luar_kantor">Markonah</a></li>
              <li> <a href="<?php echo base_url(); ?>monitoring_pegawai/monitoring">Monitoring Pegawai</a></li>
            </ul>
          </li>
                <?php
            } else {
                ?>
          <li><a href="<?php echo base_url(); ?>kerja_luar_kantor" class="waves-effect"> <i class="icon-home fa-fw"></i> <span class="hide-menu">Markonah</span></a></li>
            <?php } ?>
      <?php endif ?> -->

            <?php if ($user_level == 'Administrator' or $this->session->userdata('id_skpd') == 2): ?>
                                <li class="nav-small-cap m-t-10">--- PENGAWASAN</li>
                                <li>
                                    <a href='<?php echo base_url() . "auditor/pkpt"; ?>' class="waves-effect"><i data-icon="m"
                                            class="linea-icon linea-basic"></i> <span class="hide-menu">Daftar PKPT</a>
                                </li>


                                <?php if ($user_level == 'Administrator' or in_array('auditor', $user_privileges)): ?>
                                                    <li>
                                                        <a href='<?php echo base_url() . "auditor/penugasan"; ?>' class="waves-effect"><i data-icon="&#xe01a;"
                                                                class="linea-icon linea-basic"></i> <span class="hide-menu">Operator Penugasan</a>
                                                    </li>
                                <?php endif; ?>
            <?php endif; ?>

            <?php
            if ($user_level == 'Adminstrator' || $user_level == 'Dewan') {
                ?>
                                <li class="nav-small-cap m-t-10">--- SURVEY</li>

                                <li><a href='<?php echo base_url(); ?>survey_kepuasan' class="waves-effect"><i data-icon="a"
                                            class="linea-icon linea-software fa-fw"></i> <span class="hide-menu">Survey Kepuasan</a></li>
            <?php } ?>

            <?php
            if ($user_level !== 'Operator' && $user_level !== 'Dewan') {
                ?>
                                <?php if ($user_level == 'Administrator' or in_array('default', $user_privileges)): ?>
                                                    <li class="nav-small-cap m-t-10">--- Manajemen Kinerja</li>


                                                    <!-- <li>
            <a href="#" class="waves-effect"><i data-icon="S" class="linea-icon linea-ecommerce fa-fw"></i> <span class="hide-menu">Kegiatan / SKP<span class="fa arrow"></span></a>
            <ul class="nav nav-second-level">
                      <?php if ($user_level == 'Administrator') { ?>
                <li> <a href="<?php echo str_replace("https", "http", base_url()); ?>monitoring_pegawai">Monitoring Pegawai</a></li>
                      <?php } ?>
            -->


                                                    <!-- <li>
            <a href="<?= base_url('skp_perencanaan') ?>" class="waves-effect"><i data-icon="S" class="linea-icon linea-ecommerce fa-fw"></i> <span class="hide-menu">IKI/SKP</a>
          </li> -->

                                                    <!-- <li>
            <a href="#" class="waves-effect"><i data-icon="S" class="linea-icon linea-ecommerce fa-fw"></i> <span class="hide-menu">SKP<span class="fa arrow"></span></a>
            <ul class="nav nav-second-level">
              <li><a href='<?php echo base_url(); ?>ref_jabatan' class="waves-effect"> <span class="hide-menu">Tugas dan Fungsi Jabatan</span></a></li>
              <li><a href='<?php echo base_url(); ?>iki'>Indikator</a></li>
            </ul>
          </li> -->


                                                    <!-- <li><a href="<?php echo base_url(); ?>peer_review" class="waves-effect"><i class="ti-exchange-vertical fa-fw"></i> <span class="hide-menu">Penilaian Perilaku</span></a>
                    </li> -->

                                                    <!-- <?php if ($user_level == 'Administrator'): ?>
            <li><a href="<?php echo base_url(); ?>instruksi_langsung" class="waves-effect"> <i class="icon-action-redo linea-basic fa-fw"></i> <span class="hide-menu">Instruksi Langsung</span></a></li>
                  <?php endif ?> -->
                                <?php endif ?>



                                <li>
                                    <a href="#" class="waves-effect"><i class="icon-notebook fa-fw"></i> <span class="hide-menu">Lap.
                                            Kinerja Harian<span class="fa arrow"></span></a>
                                    <ul class="nav nav-second-level">
                                        <!-- <li><a href='<?php echo base_url(); ?>laporan_kinerja_harian'>Input Laporan</a></li> -->
                                        <li><a href='<?php echo base_url(); ?>laporan_kinerja_harian/verifikasi'>Verifikasi Laporan</a></li>
                                    </ul>
                                </li>



            <?php } ?>

            <li>
                <a href="#" class="waves-effect"><i data-icon="S" class="linea-icon linea-ecommerce fa-fw"></i>
                    <span class="hide-menu">Presensi<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li><a href='<?php echo base_url(); ?>absensi/rekapitulasi'>Rekapitulasi</a></li>
                    <?php if ($user_level == 'Administrator' or in_array('kepegawaian', $user_privileges) or in_array('op_kepegawaian', $user_privileges)): ?>
                                        <li><a href='<?php echo base_url(); ?>absensi/laporan'>Laporan Absensi</a></li>
                                        <li><a href='<?php echo base_url(); ?>absensi/laporan_tpp'>Laporan TPP</a></li>
                                        <li><a href='<?php echo base_url(); ?>absensi/log'>Log</a></li>
                    <?php endif ?>
                    <?php if ($user_level == 'Administrator'): ?>
                                        <li><a href='<?php echo base_url(); ?>absensi/shift'>Pengaturan shift</a></li>
                    <?php endif ?>
                </ul>
            </li>
            <?php if ($user_level == 'Administrator' or in_array('tata_pemerintahan', $user_privileges) or in_array('tapem', $user_privileges)) { ?>
                                <li class="nav-small-cap m-t-10">--- TATA PEMERINTAHAN</li>
                                <li><a href='<?php echo base_url(); ?>sakip_desa' class="waves-effect"><i data-icon="a"
                                            class="linea-icon linea-software fa-fw"></i> <span class="hide-menu">SAKIP Desa</a></li>
                                <li><a href='<?php echo base_url(); ?>rekap_desa/sdgs' class="waves-effect"><i data-icon="a"
                                            class="linea-icon linea-software fa-fw"></i> <span class="hide-menu">SDGs Desa</a></li>
                                <li><a href='<?php echo base_url(); ?>rekap_desa/surat' class="waves-effect"><i data-icon="a"
                                            class="linea-icon linea-software fa-fw"></i> <span class="hide-menu">Surat Desa</a></li>
                                <li><a href='<?php echo base_url(); ?>renja_perencanaan/rekap/kecamatan' class="waves-effect"><i
                                            data-icon="a" class="linea-icon linea-software fa-fw"></i> <span class="hide-menu">SAKIP
                                            Kecamatan</a></li>
                                <li><a href='<?php echo base_url(); ?>laporan_surat/statistik_skpd' class="waves-effect"><i data-icon="a"
                                            class="linea-icon linea-software fa-fw"></i> <span class="hide-menu">Surat Kecamatan</a></li>

                                <li>
                                    <a href="#" class="waves-effect"><i class="icon-notebook fa-fw"></i> <span class="hide-menu">LKE
                                            Kecamatan<span class="fa arrow"></span></a>
                                    <ul class="nav nav-second-level">
                                        <li><a href='<?php echo base_url(); ?>lembar_kerja_evaluasi/rekap/zi_wbk/kecamatan'>ZI-WBK</a></li>
                                        <li><a href='<?php echo base_url(); ?>lembar_kerja_evaluasi/rekap/rb/kecamatan'>RB</a></li>
                                    </ul>
                                </li>
            <?php } ?>


            <!--

                                    <?php if (in_array('mn_front_end', $user_group_menu)): ?>
                                        <li>
                                            <a href="#" class="waves-effect"><i data-icon="R" class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu">Realisasi Renstra<span class="fa arrow"></span></a>
                                            <ul class="nav nav-second-level">
                                                    <?php if (in_array('header', $user_privileges)): ?>
                                                    <li><a href='<?php echo base_url(); ?>realisasi_sr'>Sasaran Strategis</a></li>
                                                    <li><a href='<?php echo base_url(); ?>realisasi_sp'>Sasaran Program</a></li>
                                                    <li><a href='<?php echo base_url(); ?>realisasi_sk'>Sasaran Kegiatan</a></li>
                                                    <?php endif ?>

                                            </ul>
                                        </li>
                                    <?php endif ?>


                                    <?php if (in_array('mn_front_end', $user_group_menu)): ?>
                                        <li>
                                            <a href="#" class="waves-effect"><i data-icon="R" class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu">Realisasi RKT<span class="fa arrow"></span></a>
                                            <ul class="nav nav-second-level">
                                                    <?php if (in_array('header', $user_privileges)): ?>
                                                    <li><a href='<?php echo base_url(); ?>realisasi_rkt'>Realisasi RKT</a></li>
                                                    <?php endif ?>
                                            </ul>
                                        </li>
                                    <?php endif ?>





                                    <?php if (in_array('mn_front_end', $user_group_menu)): ?>
                                        <li>
                                            <a href="#" class="waves-effect"><i data-icon="R" class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu">Kegiatan Unit Kerja<span class="fa arrow"></span></a>
                                            <ul class="nav nav-second-level">
                                                    <?php if (in_array('header', $user_privileges)): ?>
                                                    <!-- <li><a href='<?php echo base_url(); ?>ref_kode_kegiatan'>Rencana Kerja </a></li>
                                                    <li><a href='<?php echo base_url(); ?>kegiatan'>Kegiatan Unit Kerja</a></li>
                                                    <li><a href='<?php echo base_url(); ?>realisasi_kegiatan'>Realisasi Kegiatan</a></li>


                                                    <?php endif ?>

                                            </ul>
                                        </li>
                                    <?php endif ?>



                                    <?php if (in_array('mn_front_end', $user_group_menu)): ?>
                                        <li>
                                            <a href="#" class="waves-effect"><i data-icon="Q" class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu">Kegiatan Personal<span class="fa arrow"></span></a>
                                            <ul class="nav nav-second-level">
                                                    <?php if (in_array('header', $user_privileges)): ?>
                                                    <li><a href='<?php echo base_url(); ?>ref_pekerjaan'>Kategori Pekerjaan</a></li>
                                                    <li><a href='<?php echo base_url(); ?>target_pekerjaan'>Target Pekerjaan</a></li>
                                                    <li><a href='<?php echo base_url(); ?>realisasi_pekerjaan'>Realisasi Pekerjaan</a></li>

                                                    <?php endif ?>

                                            </ul>
                                        </li>
                                    <?php endif ?>


                                    <?php if (in_array('mn_front_end', $user_group_menu)): ?>
                                        <li>
                                            <a href="#" class="waves-effect"><i data-icon="&#xe020;" class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu">Verifikasi Pekerjaan<span class="fa arrow"></span></a>
                                            <ul class="nav nav-second-level">
                                                    <?php if (in_array('header', $user_privileges)): ?>
                                                    <li><a href='<?php echo base_url(); ?>verifikasi_pekerjaan'>Daftar Verifikasi</a></li>

                                                    <?php endif ?>

                                            </ul>
                                        </li>
                                    <?php endif ?>

                                    <?php if (in_array('unit_kerja', $user_privileges) && $user_level == 'Administrator'): ?>
                                        <li><a href="<?php echo base_url(); ?>penilaian_kinerja" class="waves-effect"><i class="linea-icon linea-basic fa-fw" data-icon=";"></i> <span class="hide-menu">Penilaian Kinerja</span></a></li>
                                    <?php endif ?>


                                    <?php if (in_array('mn_front_end', $user_group_menu)): ?>
                                        <li>
                                            <a href="#" class="waves-effect"><i data-icon="R" class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu">Laporan Kinerja<span class="fa arrow"></span></a>
                                            <ul class="nav nav-second-level">
                                                    <?php if (in_array('header', $user_privileges)): ?>
                                                    <li><a href='<?php echo base_url(); ?>kinerja_lembaga'>Kinerja Lembaga</a></li>
                                                    <li><a href='<?php echo base_url(); ?>kinerja_pegawai'>Kinerja Pegawai</a></li>
                                                    <?php endif ?>

                                            </ul>
                                        </li>
                                    <?php endif ?>




                                    <?php if (in_array('mn_blog', $user_group_menu)): ?>
                                        <li>
                                            <a href="#" class="waves-effect"><i data-icon="2" class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu">Berita<span class="fa arrow"></span></a>
                                            <ul class="nav nav-second-level">
                                                    <?php if (in_array('post', $user_privileges)): ?>
                                                    <li> <a href="<?php echo base_url(); ?>manage_post">Berita </a></li>
                                                    <?php endif ?>
                                                    <?php if (in_array('blog_category', $user_privileges)): ?>
                                                    <li> <a href="<?php echo base_url(); ?>manage_category/">Kategori</a></li>
                                                    <?php endif ?>
                                            </ul>
                                        </li>
                                    <?php endif ?>

                                  -->

            <?php if ($user_level == 'Administrator' or in_array('web_skpd', $user_privileges)): ?>
                                <li class="nav-small-cap m-t-10">--- Web SKPD/Kecamatan</li>
                                <li>
                                    <a href="#" class="waves-effect"><i data-icon="&#xe025;" class="linea-icon linea-basic fa-fw"></i> <span
                                            class="hide-menu">Front End Media<span class="fa arrow"></span></a>
                                    <ul class="nav nav-second-level">
                                        <!-- <li> <a href="<?php echo base_url(); ?>tahu/manage_menu">Menu</a></li> -->
                                        <!-- <li> <a href="<?php echo base_url(); ?>tahu/manage_media/img_header">Header</a></li> -->
                                        <li> <a href="<?php echo base_url(); ?>tahu/manage_media/banner">Banner</a></li>
                                        <li> <a href="<?php echo base_url(); ?>tahu/manage_media/download">Publikasi</a></li>
                                        <li> <a href="<?php echo base_url(); ?>tahu/manage_media/modal">Modal</a></li>
                                        <li> <a href="<?php echo base_url(); ?>tahu/manage_media/iklan_layanan">Iklan Layanan</a></li>
                                        <!-- <li> <a href="<?php echo base_url(); ?>tahu/manage_category_video">Kategori Video</a></li>  -->
                                        <!-- <li> <a href="<?php echo base_url(); ?>tahu/manage_notice">Pengumuman</a></li> -->
                                        <!-- <li> <a href="<?php echo base_url(); ?>tahu/manage_category/">Kategori Berita</a></li>  -->
                                        <li> <a href="<?php echo base_url(); ?>tahu/manage_post">Berita </a></li>
                                        <!-- <li> <a href="<?php echo base_url(); ?>tahu/manage_post/berita2">Berita 2</a></li> -->
                                        <!-- <li> <a href="<?php echo base_url(); ?>tahu/manage_media/navigasi_menu">Navigasi Menu</a></li> -->
                                        <!-- <li> <a href="<?php echo base_url(); ?>tahu/manage_category_video">Kategori Video</a></li>  -->
                                        <!-- <li> <a href="<?php echo base_url(); ?>tahu/manage_video"> Video</a></li>  -->
                                        <!-- <li> <a href="<?php echo base_url(); ?>tahu/manage_sambutan"> Naskah Sambutan</a></li>  -->
                                        <!-- <li> <a href="<?php echo base_url(); ?>tahu/manage_press_release"> Press Release</a></li>  -->
                                        <!-- <li> <a href="<?php echo base_url(); ?>tahu/manage_survey_kepuasan"> Survey Kepuasan</a></li>  -->
                                    </ul>
                                </li>
            <?php endif ?>



            <?php if ($user_level == 'Administrator' || $this->session->userdata('user_level') == 0): ?>
                                <li class="nav-small-cap m-t-10">--- Informasi Lembaga</li>
                                <li>
                                    <a href="#" class="waves-effect"><i data-icon="K" class="linea-icon linea-basic fa-fw"></i> <span
                                            class="hide-menu">Profil Lembaga<span class="fa arrow"></span></a>
                                    <ul class="nav nav-second-level">
                                        <?php if ($user_level == 'Administrator' || $this->session->userdata('user_level') == 0): ?>
                                                            <li> <a href="<?php echo base_url(); ?>manage_company_profile/identity">Identitas</a></li>
                                        <?php endif ?>

                                    </ul>
                                </li>
            <?php endif ?>

            <?php if ($user_level == 'Administrator' or $user_level == 'Operator' or $pegawai->kepala_skpd == 'Y' or in_array('pengumuman', $user_privileges)): ?>
                                <li><a href="<?php echo base_url(); ?>pengumuman" class="waves-effect"> <i
                                            class="icon-bell linea-basic fa-fw"></i> <span class="hide-menu">Pengumuman</span></a></li>
            <?php endif ?>
            <!-- 
      <?php if ($user_level == 'Administrator' or in_array('standar_kepatuhan', $user_privileges)): ?>
        <li>
          <a href="#" class="waves-effect"><i data-icon="&#xe00a" class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu">Standar Kepatuhan<span class="fa arrow"></span></a>
          <ul class="nav nav-second-level">
            <li> <a href="<?php echo base_url(); ?>standar_kepatuhan/add">Form</a></li>
                <?php if ($user_level == 'Administrator') { ?>
              <li> <a href="<?php echo base_url(); ?>standar_kepatuhan">Manage</a></li>
                <?php } else { ?>
              <li> <a href="<?php echo base_url(); ?>standar_kepatuhan">List</a></li>
                <?php } ?>
          </ul>
        </li>
      <?php endif ?> -->

            <?php if ($user_level == 'Administrator' or in_array('standar_kepatuhan', $user_privileges)): ?>
                                <li>
                                    <a href='<?php echo base_url(); ?>standar_kepatuhan' class="waves-effect"><i data-icon="&#xe00a"
                                            class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu">Standar Kepatuhan</a>
                                </li>
            <?php endif ?>

            <li class="nav-small-cap m-t-10">--- SIKOMPLIT</li>

            <li>
                <a href='<?php echo base_url(); ?>sikomplit/inovasi_daerah' class="waves-effect"><i data-icon="a"
                        class="linea-icon linea-software fa-fw"></i> <span class="hide-menu">Inovasi Daerah</a>
            </li>
            <?php if ($user_level == 'Administrator'): ?>
                                <li>
                                    <a href='<?php echo base_url(); ?>sikomplit/parameter_penilaian_indeks_inovasi' class="waves-effect"><i
                                            data-icon="a" class="linea-icon linea-software fa-fw"></i> <span class="hide-menu">Parameter
                                            Penilaian</a>
                                </li>
            <?php endif ?>

            <?php if ($user_level == 'Administrator' or in_array('sigesit', $user_privileges)): ?>
                                <li class="nav-small-cap m-t-10">--- SIGESIT</li>
                                <li>
                                    <a href="#" class="waves-effect"><i data-icon="&#xe026;" class="linea-icon linea-basic fa-fw"></i> <span
                                            class="hide-menu">Sigesit<span class="fa arrow"></span></a>
                                    <ul class="nav nav-second-level">
                                        <li><a href="<?php echo base_url() . "sigesit/perencanaan"; ?>">Perencanaan</a></li>
                                        <li><a href="<?php echo base_url() . "sigesit/penganggaran"; ?>">Penganggaran</a></li>
                                        <li><a href="<?php echo base_url() . "sigesit/monev"; ?>">Monev</a></li>
                                        <li><a href="<?php echo base_url() . "sigesit/laporan"; ?>">Laporan</a></li>
                                        <!-- <li><a href="<?php echo base_url() . "sigesit/maps"; ?>">Spasial</a></li> -->


                                    </ul>
                                </li>
            <?php endif; ?>

            <?php if ($user_level == 'Administrator' or $user_level == 'Operator' or $pegawai->kepala_skpd == 'Y' or in_array('umkm', $user_privileges)): ?>
                                <li class="nav-small-cap m-t-10">--- UMKM</li>
                                <li>
                                    <a href='<?php echo base_url(); ?>umkm/beranda' class="waves-effect"><i data-icon="a"
                                            class="linea-icon linea-software fa-fw"></i> <span class="hide-menu">UMKM</a>
                                </li>
            <?php endif ?>
            <li class="nav-small-cap m-t-10">--- SIMANJA</li>
            <?php if ($user_level == 'Administrator' or in_array('simanja', $user_privileges) or in_array('admin_simanja', $user_privileges) or in_array($pegawai->id_pegawai, $jabatan_id)): ?>
                                <li>
                                    <a href='<?php echo base_url() . "simanja/analisis_jabatan"; ?>' class="waves-effect"><i data-icon="S"
                                            class="linea-icon linea-ecommerce"></i> <span class="hide-menu">Analisis Jabatan</a>
                                </li>
            <?php endif; ?>
            <li>
                <a href='<?php echo base_url() . "simanja/verifikasi"; ?>' class="waves-effect"><i data-icon="S"
                        class="linea-icon linea-ecommerce"></i> <span class="hide-menu">Verifikasi</a>
            </li>
            <li>
                <?php if ($user_level == 'Administrator' or in_array('admin_simanja', $user_privileges)): ?>
                                    <a href="#" class="waves-effect"><i data-icon="&#xe026;" class="linea-icon linea-basic fa-fw"></i> <span
                                            class="hide-menu">Referensi Data<span class="fa arrow"></span></a>
                                    <ul class="nav nav-second-level">
                                        <li><a href="<?php echo base_url() . "simanja/ref_jabatan"; ?>">Jabatan</a></li>
                                        <li><a href="<?php echo base_url() . "simanja/ref_bakat_kerja"; ?>">Bakat Kerja</a></li>
                                        <li><a href="<?php echo base_url() . "simanja/ref_fungsi_pekerjaan"; ?>">Fungsi Pekerjaan</a></li>
                                        <li><a href="<?php echo base_url() . "simanja/ref_keterampilan_kerja"; ?>">Keterampilan Kerja</a>
                                        </li>
                                        <li><a href="<?php echo base_url() . "simanja/ref_minat_kerja"; ?>">Minat Kerja</a></li>
                                        <li><a href="<?php echo base_url() . "simanja/ref_kelas_jabatan"; ?>">Kelas Jabatan</a></li>
                                        <li><a href="<?php echo base_url() . "simanja/ref_upaya_fisik"; ?>">Upaya Fisik</a></li>
                                        <li><a href="<?php echo base_url() . "simanja/ref_temperamen_kerja"; ?>">Temperamen Kerja</a></li>
                                        <li><a href="<?php echo base_url() . "simanja/ref_diklat_perjenjangan"; ?>">Diklat Perjenjangan</a>
                                        </li>
                                        <li><a href="<?php echo base_url() . "simanja/ref_satuan_hasil"; ?>">Satuan Hasil</a></li>
                                        <li><a href="<?php echo base_url() . "simanja/ref_waktu_kerja_efektif"; ?>">Waktu Kerja Efektif</a>
                                        </li>
                                        <li><a href="<?php echo base_url() . "simanja/ref_pengetahuan_kerja"; ?>">Pengetahuan Kerja</a></li>
                                        <li><a href="<?php echo base_url() . "simanja/ref_faktor_evaluasi"; ?>">Faktor Evaluasi</a></li>
                                    </ul>
                                </li>
            <?php endif; ?>


            <!-- <li>
            <a href='<?php echo base_url(); ?>lomba_inovasi' class="waves-effect"><i data-icon="a" class="linea-icon linea-software fa-fw"></i> <span class="hide-menu">Lomba Inovasi</a>
          </li> -->
            <?php
            if ($this->session->userdata('id_skpd') == "3") {
                ?>
                                <li class="nav-small-cap m-t-10">--- DPRD</li>

                                <li>
                                    <a href="<?= base_url('master_pegawai/dewan') ?>" class="waves-effect"><i data-icon="u"
                                            class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu">Keanggotaan</a>
                                </li>

                                <li>
                                    <a href="<?= base_url('kegiatan_dewan') ?>" class="waves-effect"><i class="ti-pulse fa-fw"></i> <span
                                            class="hide-menu">Catatan Kegiatan</a>
                                </li>

                                <li>
                                    <a href="<?= base_url('legislasi') ?>" class="waves-effect"><i class="ti-flag fa-fw"></i> <span
                                            class="hide-menu">Legislasi</a>
                                </li>

                                <li>
                                    <a href="<?= base_url('manajemen_rapat') ?>" class="waves-effect"><i class="ti-vector fa-fw"></i> <span
                                            class="hide-menu">Manajemen Rapat</a>
                                </li>
                                <li>
                                    <a href="<?= base_url('survey_kepuasan/rekap') ?>" class="waves-effect"><i
                                            class="ti-bookmark-alt fa-fw"></i> <span class="hide-menu">Rekap Survey</a>
                                </li>
                                <li><a href="<?php echo base_url(); ?>pengumuman" class="waves-effect"> <i
                                            class="icon-bell linea-basic fa-fw"></i> <span class="hide-menu">Input Pengumuman</span></a>
                                </li>
                                <?php
            }
            ?>

            <li class="nav-small-cap m-t-10">--- Akun</li>

            <?php if ($user_level == 'User' || $this->session->userdata('user_level') == 0): ?>

                                <li><a href="<?php echo base_url(); ?>pengaturan_akun" class="waves-effect"> <i class="ti-settings"></i>
                                        <span class="hide-menu">Pengaturan Akun</span></a></li>
                                <li><a href="<?php echo base_url(); ?>simpeg/my_profile" class="waves-effect"> <i class="ti-user"></i> <span
                                            class="hide-menu">Profil SIMPEG</span></a></li>
            <?php endif ?>
            <li><a href="<?php echo base_url(); ?>helpdesk" class="waves-effect"> <i class="icon-question"></i> <span
                        class="hide-menu"> Helpdesk</span></a></li>
            <li><a href="<?php echo base_url(); ?>logout" class="waves-effect"> <i class="icon-logout"></i> <span
                        class="hide-menu"> Keluar</span></a></li>

        </ul>
    </div>
</div>