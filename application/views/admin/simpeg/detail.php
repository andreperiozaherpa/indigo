<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-md-12">
                        <h2 class="content-header-title float-left mb-0">Detail Pegawai</h2>
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?= base_url(); ?>simpeg/">Home</a>
                                </li>
                                <li class="breadcrumb-item "><a href="<?= base_url(); ?>simpeg/detail">Detail
                                        Pegawai</a>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="content-body">

            <section class="page-users-view">

                <div class="row">
                    <div class="col-lg-3 display-flex">
                        <div class="card">
                            <div class="card-header">
                                <div class="avatar-xl">
                                    <center>
                                        <img class="img-fluid" src="<?= get_foto_pegawai_by_nip($pegawai->nip_baru) ?>"
                                            alt="img placeholder" style="max-width: 70%; border-radius: 0.5rem">
                                    </center>
                                    <h4 class="text-primary pt-30 center"
                                        style="text-align: center !important;margin-top: 20px">
                                        <?= $pegawai->nama_lengkap ?>
                                    </h4>

                                </div>



                                <!-- <div class="badge badge-success">pertanian</div> -->
                            </div>
                            <div class="card-body">


                                <div class="mt-1">
                                    <h6 class="mb-0 text-muted">NIP:</h6>
                                    <p>
                                        <?= $pegawai->nip_pns ?>
                                    </p>
                                </div>
                                <div class="mt-1">
                                    <h6 class="mb-0 text-muted">Telp:</h6>
                                    <p>
                                        <?= $pegawai->no_hp ?> / <?= $pegawai->no_telepon ?>
                                    </p>
                                </div>
                                <div class="mt-1">
                                    <h6 class="mb-0 text-muted">email:</h6>
                                    <p>
                                        <?= $pegawai->email ?>
                                    </p>
                                </div>
                                <div class="mt-1 text-center">
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <a href="<?= $pegawai->instagram ?>" target="_blank"
                                            class="btn btn-sm btn-outline-danger"><i
                                                class="feather icon-instagram"></i></a>
                                        <a href="<?= $pegawai->facebook ?>" target="_blank"
                                            class="btn btn-sm btn-outline-primary"><i
                                                class="feather icon-facebook"></i></a>
                                        <a href="<?= $pegawai->twitter ?>" target="_blank"
                                            class="btn btn-sm btn-outline-info"><i class="feather icon-twitter"></i></a>
                                    </div>
                                </div>



                            </div>
                        </div>
                        <div class="row" style="margin-bottom: 2.2rem;">
                            <div class="col-md-12">
                                <a href="<?= base_url('simpeg/cetak_profil/' . $pegawai->id_pns) ?>"
                                    class="btn btn-outline-primary waves-effect waves-light btn-block">Cetak Profil</a>
                            </div>
                            <div class="col-md-6">
                                <!-- <button type="button" class="btn btn-danger waves-effect waves-light btn-block">Hapus</button> -->
                            </div>
                        </div>


                    </div>
                    <div class="col-lg-9 col-12 display-flex">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Biodata</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="divider divider-primary">
                                        <div class="divider-text">Data Pribadi</div>
                                        <!-- <a href="<?= base_url('simpeg/edit_orang'); ?>" class="btn btn-sm btn-primary waves-effect waves-light pull-right">Ubah Data</a> -->
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="card-text">
                                                <dl class="row">
                                                    <dt class="col-sm-4">Jenis Kelamin</dt>
                                                    <dd class="col-sm-3">
                                                        <?=($pegawai->jenis_kelamin == "L") ? "Laki-laki" : "Perempuan"; ?>
                                                    </dd>
                                                    <dt class="col-sm-3">Agama</dt>
                                                    <dd class="col-sm-2">
                                                        <?= convert_data($ref_agama, 'kode_agama', $pegawai->id_agama, 'nama_agama') ?>
                                                    </dd>
                                                </dl>
                                                <dl class="row">
                                                    <dt class="col-sm-4">Tempat Tanggal Lahir</dt>
                                                    <dd class="col-sm-8">
                                                        <?= convert_data($ref_kelahiran, 'kode_kelahiran', $pegawai->id_tempat_lahir, 'nama_kelahiran') ?>
                                                        , <?= $pegawai->tanggal_lahir ?>
                                                    </dd>
                                                </dl>
                                                <dl class="row">
                                                    <dt class="col-sm-4">Alamat</dt>
                                                    <dd class="col-sm-8">
                                                        <?= $pegawai->alamat ?>
                                                        <?= $pegawai->kode_pos ?>
                                                    </dd>
                                                </dl>
                                                <dl class="row">
                                                    <dt class="col-sm-4">Status</dt>
                                                    <dd class="col-sm-3">
                                                        <?= convert_data($ref_kawin, 'kode_kawin', $pegawai->id_status_kawin, 'nama_kawin') ?>
                                                    </dd>
                                                    <dt class="col-sm-3">Anak Tanggungan</dt>
                                                    <dd class="col-sm-2">
                                                        <?= $pegawai->anak_tanggungan ?>
                                                    </dd>
                                                </dl>
                                                <dl class="row">
                                                    <dt class="col-sm-4">Nama Ayah</dt>
                                                    <dd class="col-sm-3">
                                                        <?= $pegawai->nama_ayah ?>
                                                    </dd>
                                                    <dt class="col-sm-3">Anak Ke</dt>
                                                    <dd class="col-sm-2">
                                                        <?= $pegawai->anak_ke ?>
                                                    </dd>
                                                </dl>
                                                <dl class="row">
                                                    <dt class="col-sm-4">Nama Ibu</dt>
                                                    <dd class="col-sm-3">
                                                        <?= $pegawai->nama_ibu ?>
                                                    </dd>
                                                    <dt class="col-sm-3">Pendidikan</dt>
                                                    <dd class="col-sm-2">
                                                        <?= convert_data($ref_tingkatpendidikan, 'kode_tingkatpendidikan', $pegawai->id_tingkat_pendidikan, 'nama_tingkatpendidikan') ?>
                                                    </dd>
                                                </dl>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div
                                                class="card border-secondary align-middle text-left bg-transparent mb-1 px-1">
                                                <div class="card-text">
                                                    <div class="row">
                                                        <?php if ($pegawai->no_ktp): ?>
                                                        <dt class="col-sm-4">NIK</dt>
                                                        <dd class="col-sm-8">
                                                            <?= $pegawai->no_ktp ?>
                                                        </dd>
                                                        <?php endif ?>
                                                        <?php if ($pegawai->no_paspor): ?>
                                                        <dt class="col-sm-4">Paspor</dt>
                                                        <dd class="col-sm-8">
                                                            <?= $pegawai->no_paspor ?>
                                                        </dd>
                                                        <?php endif ?>
                                                        <?php if ($pegawai->no_sim): ?>
                                                        <dt class="col-sm-4">SIM</dt>
                                                        <dd class="col-sm-8">
                                                            <?= $pegawai->no_sim ?>
                                                        </dd>
                                                        <?php endif ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div
                                                class="card border-secondary align-middle text-left bg-transparent mb-1 px-1">
                                                <div class="card-text">
                                                    <div class="row">
                                                        <dt class="col-sm-4">NPWP</dt>
                                                        <dd class="col-sm-8">
                                                            <?= $pegawai->npwp ?> / <?= $pegawai->tanggal_npwp ?>
                                                        </dd>
                                                    </div>
                                                </div>
                                            </div>
                                            <div
                                                class="card border-secondary align-middle text-left bg-transparent mb-1 px-1">
                                                <div class="card-text">
                                                    <div class="row">
                                                        <dt class="col-sm-4">Akta Kelahiran</dt>
                                                        <dd class="col-sm-8">
                                                            <?= $pegawai->no_akta_kelahiran ?>
                                                        </dd>
                                                    </div>
                                                </div>
                                            </div>
                                            <div
                                                class="card border-secondary align-middle text-left bg-transparent mb-1 px-1">
                                                <div class="card-text">
                                                    <div class="row">
                                                        <dt class="col-sm-4">KARIS / KARSU</dt>
                                                        <dd class="col-sm-8">
                                                            <?= $pegawai->karis_karsu ?>
                                                        </dd>
                                                    </div>
                                                </div>
                                            </div>
                                            <div
                                                class="card border-secondary align-middle text-left bg-transparent mb-1 px-1">
                                                <div class="card-text">
                                                    <div class="row">
                                                        <dt class="col-sm-4">BPJS</dt>
                                                        <dd class="col-sm-8">
                                                            <?= $pegawai->no_bpjs ?>
                                                        </dd>
                                                    </div>
                                                </div>
                                            </div>
                                            <div
                                                class="card border-secondary align-middle text-left bg-transparent mb-1 px-1">
                                                <div class="card-text">
                                                    <div class="row">
                                                        <dt class="col-sm-4">Akta Kematian</dt>
                                                        <dd class="col-sm-8">
                                                            <?= $pegawai->no_akta_kematian ?> /
                                                            <?= $pegawai->tanggal_kematian ?>
                                                        </dd>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php if ($pegawai->pns == "Y"): ?>
                                    <div class="divider divider-primary">
                                        <div class="divider-text">Data ASN</div>
                                        <!-- <a href="<?= base_url('simpeg/edit_pegawai'); ?>" class="btn btn-sm btn-primary waves-effect waves-light pull-right">Ubah Data</a> -->
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="card-text">
                                                <dl class="row">
                                                    <dt class="col-sm-4">NIP</dt>
                                                    <dd class="col-sm-8">
                                                        <?= $pegawai->nip_baru ?>
                                                        <button type="button"
                                                            class="btn btn-outline-primary btn-sm pull-right">
                                                            <?=($pegawai->status_cpns_pns == "P" ? "PNS" : "CPNS") ?>
                                                        </button>
                                                    </dd>
                                                </dl>
                                                <dl class="row">
                                                    <dt class="col-sm-4">Eselon</dt>
                                                    <dd class="col-sm-8">
                                                        <?= convert_data($ref_eselon, 'kode_eselon', $pegawai->id_eselon, 'nama_eselon') ?>
                                                        <span class="pull-right">
                                                            <?= convert_data($ref_eselon, 'kode_eselon', $pegawai->id_eselon, 'jabatan_asn') ?>
                                                        </span>
                                                    </dd>
                                                </dl>
                                                <dl class="row">
                                                    <dt class="col-sm-4">Golongan</dt>
                                                    <dd class="col-sm-8">
                                                        <?= convert_data($ref_golongan, 'kode_golongan', $pegawai->id_golongan_akhir, 'pangkat_golongan') ?>
                                                        <span class="pull-right">
                                                            <?= convert_data($ref_golongan, 'kode_golongan', $pegawai->id_golongan_akhir, 'nama_golongan') ?>
                                                        </span>
                                                    </dd>
                                                </dl>
                                                <dl class="row">
                                                    <dt class="col-sm-4">Instansi</dt>
                                                    <dd class="col-sm-8">
                                                        <?= convert_data($ref_instansi, 'kode_instansi', $pegawai->id_instansi_kerja, 'nama_instansi') ?>
                                                    </dd>
                                                </dl>
                                                <dl class="row">
                                                    <dt class="col-sm-4">Unit Kerja</dt>
                                                    <dd class="col-sm-8">
                                                        <?= convert_data($ref_satuankerja, 'kode_satuankerja', $pegawai->id_satuan_kerja, 'nama_satuankerja') ?>
                                                    </dd>
                                                </dl>
                                                <dl class="row">
                                                    <dt class="col-sm-4">Jabatan</dt>
                                                    <dd class="col-sm-8">
                                                        <?= convert_data($ref_jabatan, 'kode_jabatan', $pegawai->id_jabatan, 'nama_jabatan') ?>
                                                    </dd>
                                                </dl>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div
                                                class="card border-secondary align-middle text-left bg-transparent mb-1 px-1">
                                                <div class="card-text">
                                                    <div class="row">
                                                        <dt class="col-sm-4">TMT PNS</dt>
                                                        <dd class="col-sm-8">
                                                            <?= $pegawai->tmt_pns ?>
                                                        </dd>
                                                    </div>
                                                </div>
                                            </div>
                                            <div
                                                class="card border-secondary align-middle text-left bg-transparent mb-1 px-1">
                                                <div class="card-text">
                                                    <div class="row">
                                                        <dt class="col-sm-4">TMT CPNS</dt>
                                                        <dd class="col-sm-8">
                                                            <?= $pegawai->tmt_cpns ?> -
                                                            <?= $pegawai->id_golongan_awal ?>
                                                        </dd>
                                                    </div>
                                                </div>
                                            </div>
                                            <div
                                                class="card border-secondary align-middle text-left bg-transparent mb-1 px-1">
                                                <div class="card-text">
                                                    <div class="row">
                                                        <dt class="col-sm-4">TMT ESELON</dt>
                                                        <dd class="col-sm-8">
                                                            <?= $pegawai->tmt_eselon ?>
                                                        </dd>
                                                    </div>
                                                </div>
                                            </div>
                                            <div
                                                class="card border-secondary align-middle text-left bg-transparent mb-1 px-1">
                                                <div class="card-text">
                                                    <div class="row">
                                                        <dt class="col-sm-4">TMT GOLONGAN</dt>
                                                        <dd class="col-sm-8">
                                                            <?= $pegawai->tmt_golongan ?>
                                                        </dd>
                                                    </div>
                                                </div>
                                            </div>
                                            <div
                                                class="card border-secondary align-middle text-left bg-transparent mb-1 px-1">
                                                <div class="card-text">
                                                    <div class="row">
                                                        <dt class="col-sm-4">TMT JABATAN</dt>
                                                        <dd class="col-sm-8">
                                                            <?= $pegawai->tmt_jabatan ?>
                                                        </dd>
                                                    </div>
                                                </div>
                                            </div>
                                            <div
                                                class="card border-secondary align-middle text-left bg-transparent mb-1 px-1">
                                                <div class="card-text">
                                                    <div class="row">
                                                        <dt class="col-sm-4">TMT PENSIUN</dt>
                                                        <dd class="col-sm-8">
                                                            <?= $pegawai->tmt_pensiun ?>
                                                        </dd>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endif ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <?php if ($pegawai->pns == "Y"): ?>
                <style type="text/css">
                .badge-left {
                    top: 0 !important;
                    right: unset !important;
                    left: -1rem;
                }
                </style>
                <div class="row">
                    <!-- left menu section -->
                    <div class="col-md-3 mb-2 mb-md-0">
                        <ul class="nav nav-pills flex-column mt-md-0 mt-1" style="display: flex;">
                            <li class="nav-item">
                                <a class="nav-link d-flex py-75 mr-0 active" onclick="get_riwayat('pangkat');"
                                    data-toggle="pill" href="#pangkat" aria-expanded="true">
                                    <i class="feather icon-trending-up mr-50 font-medium-3"></i>
                                    Pangkat
                                    <?php if ($recent_update['pangkat'] > 0) { ?>
                                    <span class="badge badge-pill badge-danger badge-left badge-up">
                                        <?=($recent_update['pangkat'] > 0) ? $recent_update['pangkat'] : '' ?>
                                    </span>
                                    <?php } ?>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link d-flex py-75 mr-0 " onclick="get_riwayat('jabatan');"
                                    data-toggle="pill" href="#jabatan" aria-expanded="false">
                                    <i class="feather icon-briefcase mr-50 font-medium-3"></i>
                                    Jabatan
                                    <?php if ($recent_update['jabatan'] > 0) { ?>
                                    <span class="badge badge-pill badge-danger badge-left badge-up">
                                        <?=($recent_update['jabatan'] > 0) ? $recent_update['jabatan'] : '' ?>
                                    </span>
                                    <?php } ?>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link d-flex py-75 mr-0 " onclick="get_riwayat('pendidikan');"
                                    data-toggle="pill" href="#pendidikan" aria-expanded="false">
                                    <i class="feather icon-book mr-50 font-medium-3"></i>
                                    Pendidikan
                                    <?php if ($recent_update['pendidikan'] > 0) { ?>
                                    <span class="badge badge-pill badge-danger badge-left badge-up">
                                        <?=($recent_update['pendidikan'] > 0) ? $recent_update['pendidikan'] : '' ?>
                                    </span>
                                    <?php } ?>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link d-flex py-75 mr-0 " onclick="get_riwayat('latihan');"
                                    data-toggle="pill" href="#latihan" aria-expanded="false">
                                    <i class="feather icon-bookmark mr-50 font-medium-3"></i>
                                    Pelatihan
                                    <?php if ($recent_update['latihan'] > 0) { ?>
                                    <span class="badge badge-pill badge-danger badge-left badge-up">
                                        <?=($recent_update['latihan'] > 0) ? $recent_update['latihan'] : '' ?>
                                    </span>
                                    <?php } ?>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link d-flex py-75 mr-0 " onclick="get_riwayat('organisasi');"
                                    data-toggle="pill" href="#organisasi" aria-expanded="false">
                                    <i class="feather icon-thumbs-up mr-50 font-medium-3"></i>
                                    Organisasi
                                    <?php if ($recent_update['organisasi'] > 0) { ?>
                                    <span class="badge badge-pill badge-danger badge-left badge-up">
                                        <?=($recent_update['organisasi'] > 0) ? $recent_update['organisasi'] : '' ?>
                                    </span>
                                    <?php } ?>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link d-flex py-75 mr-0 " onclick="get_riwayat('penghargaan');"
                                    data-toggle="pill" href="#penghargaan" aria-expanded="false">
                                    <i class="feather icon-award mr-50 font-medium-3"></i>
                                    Penghargaan
                                    <?php if ($recent_update['penghargaan'] > 0) { ?>
                                    <span class="badge badge-pill badge-danger badge-left badge-up">
                                        <?=($recent_update['penghargaan'] > 0) ? $recent_update['penghargaan'] : '' ?>
                                    </span>
                                    <?php } ?>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link d-flex py-75 mr-0 " onclick="get_riwayat('absen');"
                                    data-toggle="pill" href="#absen" aria-expanded="false">
                                    <i class="feather icon-calendar mr-50 font-medium-3"></i>
                                    Presensi/Disiplin<?php if ($recent_update['absen'] > 0) { ?>
                                    <span class="badge badge-pill badge-danger badge-left badge-up">
                                        <?=($recent_update['absen'] > 0) ? $recent_update['absen'] : '' ?>
                                    </span>
                                    <?php } ?>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link d-flex py-75 mr-0 " onclick="get_riwayat('bahasa');"
                                    data-toggle="pill" href="#bahasa" aria-expanded="false">
                                    <i class="feather icon-globe mr-50 font-medium-3"></i>
                                    Bahasa<?php if ($recent_update['bahasa'] > 0) { ?>
                                    <span class="badge badge-pill badge-danger badge-left badge-up">
                                        <?=($recent_update['bahasa'] > 0) ? $recent_update['bahasa'] : '' ?>
                                    </span><?php } ?>
                                </a>
                            </li>
                            <!-- <li class="nav-item">
									<a class="nav-link d-flex py-75 mr-0 " onclick="get_riwayat('keluarga');" data-toggle="pill" href="#keluarga" aria-expanded="false">
										<i class="feather icon-users mr-50 font-medium-3"></i>
										Keluarga
										<span class="badge badge-pill badge-danger badge-left badge-up"><?=($recent_update['keluarga'] > 0) ? $recent_update['keluarga'] : '' ?></span>
									</a>
								</li> -->
                            <li class="nav-item">
                                <a class="nav-link d-flex py-75 mr-0 "
                                    onclick="swal('Pemberitahuan','Untuk sementara riwayat keluarga tidak dapat diakses. \n\n Sedang dalam tahap pengembangan integrasi dengan kependudukan.','warning');"
                                    data-toggle="pill" href="#keluarga" aria-expanded="false">
                                    <i class="feather icon-users mr-50 font-medium-3"></i>
                                    Keluarga<?php if ($recent_update['keluarga'] > 0) { ?>
                                    <span class="badge badge-pill badge-danger badge-left badge-up">
                                        <?=($recent_update['keluarga'] > 0) ? $recent_update['keluarga'] : '' ?>
                                    </span>
                                    <?php } ?>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link d-flex py-75 mr-0 " onclick="get_riwayat('kedudukan');"
                                    data-toggle="pill" href="#kedudukan" aria-expanded="false">
                                    <i class="feather icon-toggle-left mr-50 font-medium-3"></i>
                                    Kedudukan
                                    <?php if ($recent_update['kedudukan'] > 0) { ?>
                                    <span class="badge badge-pill badge-danger badge-left badge-up">
                                        <?=($recent_update['kedudukan'] > 0) ? $recent_update['kedudukan'] : '' ?>
                                    </span>
                                    <?php } ?>
                                </a>
                            </li>
                            <?php if ($this->user_level == "Administrator" or (in_array('kepegawaian', $this->user_privileges) and $this->session->userdata('id_skpd') == 24 /*$get_api->pegawai->id_skpd*/)): ?>
                            <li class="nav-item">
                                <a class="nav-link d-flex py-75 mr-0 " onclick="get_riwayat('indikator');"
                                    data-toggle="pill" href="#indikator" aria-expanded="false">
                                    <i class="feather icon-slack mr-50 font-medium-3"></i>
                                    Indikator<?php if ($recent_update['indikator'] > 0) { ?>
                                    <span class="badge badge-pill badge-danger badge-left badge-up">
                                        <?=($recent_update['indikator'] > 0) ? $recent_update['indikator'] : '' ?>
                                    </span><?php } ?>
                                </a>
                            </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                    <!-- right content section -->
                    <div class="col-md-9" id="riwayat">
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="pangkat"
                                aria-labelledby="account-pill-general" aria-expanded="true">
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="jabatan"
                                aria-labelledby="account-pill-general" aria-expanded="false">
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="pendidikan"
                                aria-labelledby="account-pill-general" aria-expanded="false">
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="latihan"
                                aria-labelledby="account-pill-general" aria-expanded="false">
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="organisasi"
                                aria-labelledby="account-pill-general" aria-expanded="false">
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="penghargaan"
                                aria-labelledby="account-pill-general" aria-expanded="false">
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="absen" aria-labelledby="account-pill-general"
                                aria-expanded="false">
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="bahasa"
                                aria-labelledby="account-pill-general" aria-expanded="false">
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="keluarga"
                                aria-labelledby="account-pill-general" aria-expanded="false">
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="kedudukan"
                                aria-labelledby="account-pill-general" aria-expanded="false">
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="indikator"
                                aria-labelledby="account-pill-general" aria-expanded="false">
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif ?>


            </section>

        </div>

        <!-- page users view end -->




    </div>
</div>

<style type="text/css">
.fileframe {
    width: calc(100% - 28.57rem) !important;
    height: 100% !important;
    left: 0 !important;
    background: #fff0 !important;
}
</style>

<script type="text/javascript" defer>
function get_riwayat(item) {
    unblock_ui("body");
    var data = "";
    block_ui("#riwayat");
    // block_trans("#riwayat");
    $.ajax({
        type: "GET",
        url: "<?= base_url(); ?>simpeg/get_riwayat/" + item +
            "/<?= $pegawai->id_pns ?>/<?= $pegawai->nip_pns ?>",
        data: data,
        success: function(html) {
            $("#" + item).html(html);
            $('.select2').select2();
            $('.select2_wizard').select2({
                minimumInputLength: 3
            });
            $(".custom-file input").change(function(e) {
                $(this)
                    .next(".custom-file-label")
                    .html(e.target.files[0].name);
            });
            unblock_ui("#riwayat");
        },
        dataType: "html",
    });
}
document.addEventListener('DOMContentLoaded', function() {
    get_riwayat('pangkat');
    // swal('Pemberitahuan','Berdasarkan Surat Kepala BKPSDM Nomor B/10006/KP.11/II/2022. \n Batas Waktu Penginputan adalah Tanggal 8 Februari 2022','warning');
}, false);
</script>

<script type="text/javascript">
function open_fileframe(riwayat, file) {
    $("#" + riwayat + "-fileframe").attr("src", src);
    var src = "";
    if (file) {
        var filetype = file.substr(file.lastIndexOf(".") + 1);
        var ext_img = ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'tiff', 'svg'];
        var ext_file = ['doc', 'docx', 'rtf', 'pdf', 'xls', 'xlsx', 'txt', 'csv', 'psd', 'log', 'fla', 'xml', 'ade',
            'adp', 'mdb', 'accdb', 'ppt', 'pptx', 'odt', 'ots', 'ott', 'odb', 'odg', 'otp', 'otg', 'odf', 'ods',
            'odp', 'ai', 'kmz', 'dwg', 'dxf', 'hpgl', 'plt', 'spl', 'step', 'stp', 'iges', 'igs', 'sat', 'cgm'
        ];
        //if (filetype=="jpg"||filetype=="jpeg"||filetype="png"||filetype="gif"||filetype="bmp"||filetype="tiff"||filetype="svg") {} else {}
        if ($.inArray(filetype, ext_img) > -1) {
            src = "<?= base_url() ?>data/simpeg/riwayat_" + riwayat + "/" + file;
        } else if ($.inArray(filetype, ext_file) > -1) {
            src = "https://docs.google.com/viewer?url=<?= base_url() ?>data/simpeg/riwayat_" + riwayat + "/" + file +
                "&embedded=true";
        }
    }
    //alert(filetype);
    $("#" + riwayat + "-fileframe").attr("src", src);
}
</script>