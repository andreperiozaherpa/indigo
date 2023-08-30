<base href="<?= base_url() ?>" target="_parent">

<style>
table.table-fit {
    width: 100% !important;
    table-layout: auto !important;
}

table.table-fit thead th,
table.table-fit tfoot th {
    width: auto !important;
}

table.table-fit tbody td,
table.table-fit tfoot td {
    width: auto !important;
}

.table> :not(caption)>*>* {
    padding: 0;
}

.table.jadwal> :not(caption)>*>* {
    padding: 0.75rem 0;
}

.avatar-group.tim .avatar .avatar-content {
    background-color: unset !important;
}
</style>

<!-- BEGIN: Content-->
<div class="app-content content ecommerce-application">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-start mb-0">Daftar Penugasan</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="<?= base_url('auditor/pkpt') ?>">Home</a>
                                </li>
                                <li class="breadcrumb-item active">
                                    <a href="#">Daftar Penugasan</a>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">

            <div class="col-sm-12">
                <div class="row">
                    <div class="col-lg-3 col-sm-6 d-grid">
                        <div class="card">
                            <div class="card-body d-flex align-items-center justify-content-between">
                                <div>
                                    <h3 class="fw-bolder mb-75">
                                        <?= $count_pkpt['total'] ?>
                                    </h3>
                                    <span>Total Penugasan</span>
                                </div>
                                <div class="avatar bg-light-primary p-50">
                                    <span class="avatar-content">
                                        <i data-feather="user" class="font-medium-4"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 d-grid">
                        <div class="card">
                            <div class="card-body d-flex align-items-center justify-content-between">
                                <div>
                                    <h3 class="fw-bolder mb-75">
                                        <?= $count_pkpt['persiapan'] ?>
                                    </h3>
                                    <span>Penugasan dalam Persiapan dan Pelaksanaan</span>
                                </div>
                                <div class="avatar bg-light-danger p-50">
                                    <span class="avatar-content">
                                        <i data-feather="user-plus" class="font-medium-4"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 d-grid">
                        <div class="card">
                            <div class="card-body d-flex align-items-center justify-content-between">
                                <div>
                                    <h3 class="fw-bolder mb-75">
                                        <?= $count_pkpt['proses'] ?>
                                    </h3>
                                    <span>Penugasan dalam Proses dan Pembuatan Laporan</span>
                                </div>
                                <div class="avatar bg-light-warning p-50">
                                    <span class="avatar-content">
                                        <i data-feather="user-x" class="font-medium-4"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 d-grid">
                        <div class="card">
                            <div class="card-body d-flex align-items-center justify-content-between">
                                <div>
                                    <h3 class="fw-bolder mb-75">
                                        <?= $count_pkpt['selesai'] ?>
                                    </h3>
                                    <span>Penugasan Selesai</span>
                                </div>
                                <div class="avatar bg-light-success p-50">
                                    <span class="avatar-content">
                                        <i data-feather="user-check" class="font-medium-4"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-sm-12">

                <?php foreach ($pkpt['list'] as $num => $row) { ?>
                <?php if ($row->kode_sub_kegiatan == $pkpt['detail']->kode_sub_kegiatan) { ?>
                <!-- Role cards -->
                <div class="row my-1">
                    <div class="col-lg-6">
                        <div class="d-flex align-items-center">
                            <div class="avatar avatar-tag bg-light-primary me-1">
                                <?= number_to_alphabet($num + 1) ?>
                            </div>
                            <div>
                                <h4 class="mb-0">
                                    <?= $row->kode_sub_kegiatan ?>
                                </h4>
                                <span>
                                    <?= $row->nama_sub_kegiatan ?>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="table-responsive" style="padding-right:20px">
                            <table class="table table-bordered table-fit text-center">
                                <tr>
                                    <?php $week = json_decode(json_encode($list_week), true); ?>
                                    <?php foreach (array_unique(array_column($week, 'month')) as $bulan) { ?>
                                    <?php $col = 0; ?>
                                    <?php foreach ($week as $minggu) {
                                                    if ($minggu['month'] == $bulan) { ?>
                                    <?php $col++; ?>
                                    <?php } ?>
                                    <?php } ?>
                                    <td colspan="<?= $col ?>">
                                        <?= bulann($bulan) ?>
                                    </td>
                                    <?php } ?>
                                </tr>
                                <tr>
                                    <?php foreach ($week as $minggu) { ?>
                                    <th>
                                        <?= $minggu['week_month'] ?>
                                    </th>
                                    <?php } ?>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="added-cards">
                            <?php if ($pkpt['detail']) { ?>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="cardMaster rounded border p-2 mb-1">
                                        <div class="d-flex justify-content-between flex-sm-row flex-column">
                                            <div class="card-information">
                                                <h6>
                                                    <?= $pkpt['detail']->nama_aktifitas ?>
                                                </h6>
                                                <h6 class="badge badge-light-primary mt-50">
                                                    <?= $pkpt['detail']->jenis_pemeriksaan ?>
                                                </h6>
                                            </div>
                                            <div class="d-flex flex-column text-start text-lg-end">
                                                <span class="mb-50">Jumlah LHP
                                                    <button type="button"
                                                        class="btn btn-icon btn-outline-primary btn-sm">
                                                        <?= $pkpt['detail']->jumlah_lhp ?>
                                                    </button>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="col-12 table-responsive">
                                        <table class="table table-bordered table-fit text-center jadwal">
                                            <tr>
                                                <?php foreach ($week as $minggu) { ?>
                                                <?php
                                                                $aclass = array();
                                                                $aclass[] = "fade";
                                                                $title = "";
                                                                $popup = "";
                                                                $content = "";
                                                                $jadwal_rmp = array();
                                                                $jadwal_rpl = array();
                                                                $jadwal_penugasan = array();
                                                                $jadwal_belumselesai = array();
                                                                $jadwal_selesai = array();
                                                                $jadwal_verifikasinhp = array();
                                                                $jadwal_tolaknhp = array();
                                                                $jadwal_verifikasilhp = array();
                                                                $jadwal_tolaklhp = array();
                                                                foreach ($pkpt['susunan'] as $list) {
                                                                    if ($minggu['dateid'] == $list->jadwal_rmp) {
                                                                        $aclass[] = "table-primary";
                                                                        $jadwal_rmp[] = $list->nama_tim;
                                                                    }
                                                                    if ($minggu['dateid'] == $list->jadwal_rpl) {
                                                                        $aclass[] = "table-primary";
                                                                        $jadwal_rpl[] = $list->nama_tim;
                                                                    }
                                                                }
                                                                for ($i = 1; $i <= 3; $i++) {
                                                                    foreach ($list_penugasan[$i]['detail'] as $key => $list) {
                                                                        if ($minggu['last_date'] > $list->tanggal_awal_penugasan and $minggu['first_date'] < $list->tanggal_akhir_penugasan) {
                                                                            $aclass[] = "table-light";
                                                                            $jadwal_penugasan[] = (strlen($list->nama_penugasan) > 30) ? substr($list->nama_penugasan, 0, 30) . '...' : $list->nama_penugasan;
                                                                        }
                                                                        if (in_array($list->tanggal_akhir_penugasan, explode(',', $minggu['list_date'])) and $list->status_penugasan != "Selesai" and current_week() > $minggu['week']) {
                                                                            $aclass[] = "table-danger";
                                                                            $jadwal_belumselesai[] = (strlen($list->nama_penugasan) > 30) ? substr($list->nama_penugasan, 0, 30) . '...' : $list->nama_penugasan;
                                                                        }

                                                                        if (in_array($list->tanggal_akhir_penugasan, explode(',', $minggu['list_date'])) and $list->status_penugasan == "Selesai") {
                                                                            $aclass[] = "table-success";
                                                                            $jadwal_selesai[] = (strlen($list->nama_penugasan) > 30) ? substr($list->nama_penugasan, 0, 30) . '...' : $list->nama_penugasan;
                                                                        }

                                                                        foreach ($list_penugasan[$i]['nhp'][$key] as $list_nhp) {
                                                                            if ($list_nhp->status_nhp == "P" and in_array($list_nhp->tanggal_nhp, explode(',', $minggu['list_date']))) {
                                                                                $aclass[] = "table-warning";
                                                                                $jadwal_verifikasinhp[] = (strlen($list->nama_penugasan) > 30) ? substr($list->nama_penugasan, 0, 30) . '...' : $list->nama_penugasan;
                                                                            }
                                                                            if ($list_nhp->status_nhp == "N" and in_array($list_nhp->tanggal_nhp, explode(',', $minggu['list_date']))) {
                                                                                $aclass[] = "table-danger";
                                                                                $jadwal_tolaknhp[] = (strlen($list->nama_penugasan) > 30) ? substr($list->nama_penugasan, 0, 30) . '...' : $list->nama_penugasan;
                                                                            }
                                                                        }

                                                                        foreach ($list_penugasan[$i]['lhp'][$key] as $list_lhp) {
                                                                            if ($list_lhp->status_lhp == "P" and in_array($list_lhp->tanggal_lhp, explode(',', $minggu['list_date']))) {
                                                                                $aclass[] = "table-warning";
                                                                                $jadwal_verifikasilhp[] = (strlen($list->nama_penugasan) > 30) ? substr($list->nama_penugasan, 0, 30) . '...' : $list->nama_penugasan;
                                                                            }
                                                                            if ($list_lhp->status_lhp == "N" and in_array($list_lhp->tanggal_lhp, explode(',', $minggu['list_date']))) {
                                                                                $aclass[] = "table-danger";
                                                                                $jadwal_tolaklhp[] = (strlen($list->nama_penugasan) > 30) ? substr($list->nama_penugasan, 0, 30) . '...' : $list->nama_penugasan;
                                                                            }
                                                                        }
                                                                    }
                                                                }

                                                                if (count($jadwal_verifikasinhp) > 0) {
                                                                    $content .= "Berkas NHP Menunggu Verifikasi {" . implode($jadwal_verifikasinhp, ", ") . "}; ";
                                                                }
                                                                if (count($jadwal_tolaknhp) > 0) {
                                                                    $content .= "Berkas NHP Telah Ditolak {" . implode($jadwal_tolaknhp, ", ") . "}; ";
                                                                }
                                                                if (count($jadwal_verifikasilhp) > 0) {
                                                                    $content .= "Berkas LHP Menunggu Verifikasi {" . implode($jadwal_verifikasilhp, ", ") . "}; ";
                                                                }
                                                                if (count($jadwal_tolaklhp) > 0) {
                                                                    $content .= "Berkas LHP Telah Ditolak {" . implode($jadwal_tolaklhp, ", ") . "}; ";
                                                                }
                                                                if (count($jadwal_belumselesai) > 0) {
                                                                    $content .= "Penugasan Terlambat {" . implode($jadwal_belumselesai, ", ") . "}; ";
                                                                }
                                                                if (count($jadwal_selesai) > 0) {
                                                                    $content .= "Penugasan Selesai {" . implode($jadwal_selesai, ", ") . "}; ";
                                                                }
                                                                if (count($jadwal_rmp) > 0) {
                                                                    $content .= "Jadwal RMP {" . implode($jadwal_rmp, ", ") . "}; ";
                                                                }
                                                                if (count($jadwal_rpl) > 0) {
                                                                    $content .= "Jadwal RPL {" . implode($jadwal_rpl, ", ") . "}; ";
                                                                }
                                                                if (count($jadwal_penugasan) > 0) {
                                                                    $content .= "Jadwal Penugasan {" . implode($jadwal_penugasan, ", ") . "}; ";
                                                                }

                                                                if (in_array('table-warning', $aclass)) {
                                                                    $class = "table-warning";
                                                                } elseif (in_array('table-danger', $aclass)) {
                                                                    $class = "table-danger";
                                                                } elseif (in_array('table-success', $aclass)) {
                                                                    $class = "table-success";
                                                                } elseif (in_array('table-primary', $aclass)) {
                                                                    $class = "table-primary";
                                                                } elseif (in_array('table-light', $aclass)) {
                                                                    $class = "table-light";
                                                                } else {
                                                                    $class = "fade";
                                                                }
                                                                if ($class != "fade") {
                                                                    $title = "role='button' title='" . bulan($minggu['month']) . " Minggu ke-{$minggu['week_month']}'";
                                                                }
                                                                if ($content != "") {
                                                                    $popup = "data-bs-content='{$content}'";
                                                                }
                                                                ?>
                                                <td class="<?= $class ?>" data-bs-toggle="popover"
                                                    data-bs-placement="top" data-bs-container="body" <?= $title ?>
                                                    <?= $popup ?>>
                                                    <?= $minggu['week_month'] ?>
                                                </td>
                                                <?php } ?>
                                            </tr>
                                        </table>
                                    </div>
                                    <div
                                        class="col-12 d-flex justify-content-around flex-sm-row flex-column mt-50 table-responsive">
                                        <?php foreach ($pkpt['susunan'] as $list) { ?>
                                        <div class="">
                                            <div class="text-center">
                                                <?= $list->nama_tim ?>
                                            </div>
                                            <div class="avatar-group tim justify-content-center">
                                                <?php if ($list->jumlah_pj > 0) { ?>
                                                <div data-bs-toggle="tooltip" data-popup="tooltip-custom"
                                                    data-bs-placement="top"
                                                    class="avatar bg-light-primary avatar-sm pull-up my-0" title=""
                                                    data-bs-original-title="Penanggung Jawab">
                                                    <div class="avatar-content">
                                                        <?= $list->jumlah_pj ?>
                                                    </div>
                                                </div>
                                                <?php } ?>
                                                <?php if ($list->jumlah_ppj > 0) { ?>
                                                <div data-bs-toggle="tooltip" data-popup="tooltip-custom"
                                                    data-bs-placement="top"
                                                    class="avatar bg-primary avatar-sm pull-up my-0" title=""
                                                    data-bs-original-title="Pembantu Penanggung Jawab">
                                                    <div class="avatar-content">
                                                        <?= $list->jumlah_ppj ?>
                                                    </div>
                                                </div>
                                                <?php } ?>
                                                <?php if ($list->jumlah_pt > 0) { ?>
                                                <div data-bs-toggle="tooltip" data-popup="tooltip-custom"
                                                    data-bs-placement="top"
                                                    class="avatar bg-info avatar-sm pull-up my-0" title=""
                                                    data-bs-original-title="Pengendali Teknis">
                                                    <div class="avatar-content">
                                                        <?= $list->jumlah_pt ?>
                                                    </div>
                                                </div>
                                                <?php } ?>
                                                <?php if ($list->jumlah_kt > 0) { ?>
                                                <div data-bs-toggle="tooltip" data-popup="tooltip-custom"
                                                    data-bs-placement="top"
                                                    class="avatar bg-light-success avatar-sm pull-up my-0" title=""
                                                    data-bs-original-title="Ketua Tim">
                                                    <div class="avatar-content">
                                                        <?= $list->jumlah_kt ?>
                                                    </div>
                                                </div>
                                                <?php } ?>
                                                <?php if ($list->jumlah_at > 0) { ?>
                                                <div data-bs-toggle="tooltip" data-popup="tooltip-custom"
                                                    data-bs-placement="top"
                                                    class="avatar bg-success avatar-sm pull-up my-0" title=""
                                                    data-bs-original-title="Anggota Tim">
                                                    <div class="avatar-content">
                                                        <?= $list->jumlah_at ?>
                                                    </div>
                                                </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <!--/ Role cards -->
                <?php } ?>
                <?php } ?>

            </div>

            <div class="col-sm-12">

                <!-- Role cards -->
                <div class="row">

                    <!-- Profile Card -->
                    <div class="col-xl-4 col-lg-6 col-md-6 d-grid">
                        <div class="card bg-success text-white">
                            <div class="card-body text-center">
                                <h3 class="text-white"><i data-feather="alert-circle" class="font-medium-5"></i>
                                    Observasi</h3>
                                <h6 class="text-white">Tidak melanggar dokumentasi sistem manajemen
                                    yang telah
                                    ditetapkan. Saran untuk peningkatan.</h6>
                                <!-- <span class="badge badge-light-primary profile-badge">Pro Level</span> -->
                                <hr class="mb-2" />
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="text-white fw-bolder">Persiapan</h6>
                                        <h3 class="text-white mb-0">
                                            <?= $list_penugasan[1]['count']['persiapan'] ?>
                                        </h3>
                                    </div>
                                    <div>
                                        <h6 class="text-white fw-bolder">Proses</h6>
                                        <h3 class="text-white mb-0">
                                            <?= $list_penugasan[1]['count']['proses'] ?>
                                        </h3>
                                    </div>
                                    <div>
                                        <h6 class="text-white fw-bolder">Selesai</h6>
                                        <h3 class="text-white mb-0">
                                            <?= $list_penugasan[1]['count']['selesai'] ?>
                                        </h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/ Profile Card -->

                    <!-- Profile Card -->
                    <div class="col-xl-4 col-lg-6 col-md-6 d-grid">
                        <div class="card bg-warning text-white">
                            <div class="card-body text-center">
                                <h3 class="text-white"><i data-feather="alert-triangle" class="font-medium-5"></i>
                                    Ketidaksesuaian Minor</h3>
                                <h6 class="text-white">Tidak mempunyai dampak serius terhadap mutu,
                                    lingkungan dan K3
                                    atau sistemnya.</h6>
                                <!-- <span class="badge badge-light-primary profile-badge">Pro Level</span> -->
                                <hr class="mb-2" />
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="text-white fw-bolder">Persiapan</h6>
                                        <h3 class="text-white mb-0">
                                            <?= $list_penugasan[2]['count']['persiapan'] ?>
                                        </h3>
                                    </div>
                                    <div>
                                        <h6 class="text-white fw-bolder">Proses</h6>
                                        <h3 class="text-white mb-0">
                                            <?= $list_penugasan[2]['count']['proses'] ?>
                                        </h3>
                                    </div>
                                    <div>
                                        <h6 class="text-white fw-bolder">Selesai</h6>
                                        <h3 class="text-white mb-0">
                                            <?= $list_penugasan[2]['count']['selesai'] ?>
                                        </h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/ Profile Card -->

                    <!-- Profile Card -->
                    <div class="col-xl-4 col-lg-6 col-md-6 d-grid">
                        <div class="card bg-danger text-white">
                            <div class="card-body text-center">
                                <h3 class="text-white"><i data-feather="alert-octagon" class="font-medium-5"></i>
                                    Ketidaksesuaian Mayor</h3>
                                <h6 class="text-white">Berdampak yang serius terhadap pencapaian
                                    mutu atau efektivitas
                                    sistem mutu.</h6>
                                <!-- <span class="badge badge-light-primary profile-badge">Pro Level</span> -->
                                <hr class="mb-2" />
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="text-white fw-bolder">Persiapan</h6>
                                        <h3 class="text-white mb-0">
                                            <?= $list_penugasan[3]['count']['persiapan'] ?>
                                        </h3>
                                    </div>
                                    <div>
                                        <h6 class="text-white fw-bolder">Proses</h6>
                                        <h3 class="text-white mb-0">
                                            <?= $list_penugasan[3]['count']['proses'] ?>
                                        </h3>
                                    </div>
                                    <div>
                                        <h6 class="text-white fw-bolder">Selesai</h6>
                                        <h3 class="text-white mb-0">
                                            <?= $list_penugasan[3]['count']['selesai'] ?>
                                        </h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/ Profile Card -->

                    <div class="col-xl-4 col-lg-6 col-md-6">
                        <?php foreach ($list_penugasan[1]['detail'] as $key => $row) { ?>
                        <div class="card">
                            <div class="card-header align-self-center">
                                <?= $row->no_surat ?>
                            </div>
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <span
                                        class="badge <?=($row->status_penugasan == 'Selesai') ? 'bg-success' : 'bg-primary' ?>">
                                        <?= $row->status_penugasan ?>
                                    </span>
                                    <ul class="list-unstyled d-flex align-items-center avatar-group mb-0">
                                        <?php foreach ($list_penugasan[1]['anggota'][$key] as $num => $value) { ?>
                                        <?php if ($num < 5) {
                                                    $limit = 0; ?>
                                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                            title="<?= $value->nama_lengkap ?>" class="avatar avatar-sm pull-up">
                                            <img class="rounded-circle"
                                                src="<?php echo base_url() . "data/foto/pegawai/" . $value->foto_pegawai; ?>"
                                                alt="Avatar" />
                                        </li>
                                        <?php } else {
                                                    $limit++;
                                                } ?>
                                        <?php } ?>
                                        <?php if ($limit > 1) { ?>
                                        <li class="avatar bg-primary avatar-sm pull-up">
                                            <div class="avatar-content" style="background-color: unset !important;">
                                                <?="+" . $limit ?>
                                            </div>
                                        </li>
                                        <?php } elseif ($limit == 1) { ?>
                                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                            title="<?= $list_penugasan[1]['anggota'][$key][$num]->nama_lengkap ?>"
                                            class="avatar avatar-sm pull-up">
                                            <img class="rounded-circle"
                                                src="<?php echo base_url() . "data/foto/pegawai/" . $list_penugasan[1]['anggota'][$key][$num]->foto_pegawai; ?>"
                                                alt="Avatar" />
                                        </li>
                                        <?php } ?>
                                    </ul>
                                </div>
                                <div class="d-flex justify-content-between align-items-end mt-1 pt-25">
                                    <div class="role-heading">
                                        <h4 class="fw-bolder">
                                            <?= $row->nama_penugasan ?>
                                        </h4>
                                        <span
                                            class="<?=($row->tanggal_akhir_penugasan < date('Y-m-d') and $row->status_penugasan != 'Selesai') ? 'text-danger' : '' ?>">
                                            <?= tanggal($row->tanggal_awal_penugasan) ?> -
                                            <?= tanggal($row->tanggal_akhir_penugasan) ?>
                                        </span>
                                    </div>
                                    <a href="<?= base_url('auditor/kertas_kerja/' . encode($row->id_penugasan)) ?>"
                                        class="text-body"><i data-feather="book" class="font-medium-5"></i> Detail</a>
                                </div>
                                <?php if (count($list_penugasan[1]['nhp'][$key]) > 0 OR count($list_penugasan[1]['lhp'][$key]) > 0 ) { ?>
                                <hr />
                                <?php foreach ($list_penugasan[1]['nhp'][$key] as $num => $value) { ?>
                                <?php if ($value->status_nhp) { ?>
                                <?php
                                            switch ($value->status_nhp) {
                                                case "Y":
                                                    $code = "primary";
                                                    $text = "Berkas NHP sudah disetujui.";
                                                    break;
                                                case "P":
                                                    $code = "warning";
                                                    $text = "Berkas NHP belum diverifikasi.";
                                                    break;
                                                case "N":
                                                    $code = "danger";
                                                    $text = "Berkas NHP telah ditolak.";
                                                    break;
                                                default:
                                                    $code = "dark";
                                                    $text = "";
                                                    break;
                                            }
                                            ?>
                                <div
                                    class="alert alert-<?= $code ?> mb-0 d-flex justify-content-between align-items-center mt-1 pt-25">
                                    <blockquote class="blockquote ps-1 py-1 border-start-<?= $code ?> border-start-3">
                                        <small><a
                                                href="javascript:void(0)"><svg width="24" height="24" viewBox="0 0 24 24"
                                                    fill="none" stroke="currentColor" stroke-width="2"
                                                    stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-paperclip font-small-3 align-middle me-0">
                                                    <path
                                                        d="M21.44 11.05l-9.19 9.19a6 6 0 0 1-8.49-8.49l9.19-9.19a4 4 0 0 1 5.66 5.66l-9.2 9.19a2 2 0 0 1-2.83-2.83l8.49-8.48">
                                                    </path>
                                                </svg>
                                                <?= $value->nama_skpd ?>
                                            </a></small>
                                        <footer class="blockquote-footer text-<?= $code ?> fs-5"><?= $text ?>
                                        </footer>
                                    </blockquote>
                                    <?php if ($value->status_nhp == "P" AND in_array($id_pegawai, explode(',',$row->pt_penugasan))) { ?>
                                    <a href="#" class="text-body" data-bs-toggle="modal"
                                        data-bs-target="#modals-slide-in"
                                        onclick="verifikasi_nhp(<?= $value->id_pekerjaan ?>)"><i
                                            data-feather="check-square" class="font-medium-5"></i>
                                        Verifikasi NHP</a>
                                    <?php } ?>
                                </div>
                                <?php } ?>
                                <?php } ?>
                                <?php foreach ($list_penugasan[1]['lhp'][$key] as $num => $value) { ?>
                                <?php if ($value->status_lhp) { ?>
                                <?php
                                            switch ($value->status_lhp) {
                                                case "Y":
                                                    $code = "primary";
                                                    $text = "Berkas LHP sudah disetujui.";
                                                    break;
                                                case "P":
                                                    $code = "warning";
                                                    $text = "Berkas LHP belum diverifikasi.";
                                                    break;
                                                case "N":
                                                    $code = "danger";
                                                    $text = "Berkas LHP telah ditolak.";
                                                    break;
                                                default:
                                                    $code = "dark";
                                                    $text = "";
                                                    break;
                                            }
                                            ?>
                                <div
                                    class="alert alert-<?= $code ?> mb-0 d-flex justify-content-between align-items-center mt-1 pt-25">
                                    <blockquote class="blockquote ps-1 py-1 border-start-<?= $code ?> border-start-3">
                                        <small><a
                                                href="javascript:void(0)"><svg width="24" height="24" viewBox="0 0 24 24"
                                                    fill="none" stroke="currentColor" stroke-width="2"
                                                    stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-paperclip font-small-3 align-middle me-0">
                                                    <path
                                                        d="M21.44 11.05l-9.19 9.19a6 6 0 0 1-8.49-8.49l9.19-9.19a4 4 0 0 1 5.66 5.66l-9.2 9.19a2 2 0 0 1-2.83-2.83l8.49-8.48">
                                                    </path>
                                                </svg>
                                                <?= $value->nama_skpd ?>
                                            </a></small>
                                        <footer class="blockquote-footer text-<?= $code ?> fs-5"><?= $text ?>
                                        </footer>
                                    </blockquote>
                                    <?php if ($value->status_lhp == "P" AND in_array($id_pegawai, explode(',',$row->ppj_penugasan)) AND $value->status_nhp == "Y") { ?>
                                    <a href="#" class="text-body" data-bs-toggle="modal"
                                        data-bs-target="#modals-slide-in"
                                        onclick="verifikasi_lhp(<?= $value->id_pekerjaan ?>)"><i
                                            data-feather="check-square" class="font-medium-5"></i>
                                        Verifikasi LHP</a>
                                    <?php } ?>
                                </div>
                                <?php } ?>
                                <?php } ?>
                                <?php } ?>
                            </div>
                            <div class="card-footer d-flex justify-content-between">
                                <div>
                                    <h5>
                                        <?= $row->nama_tim ?>
                                    </h5>
                                </div>
                                <div>
                                    <?php if($kepala_skpd == "Y"){?>
                                    <a href="#" class="text-body" data-bs-toggle="modal" data-bs-target="#addNewCard"
                                        onclick="change_klasifikasi(<?= $row->klasifikasi ?>,'<?= encode($row->id_penugasan) ?>')"><i
                                            data-feather="sliders" class="font-medium-5"></i>
                                        Ubah Klasifikasi</a>
                                        <?php }?>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                    <div class="col-xl-4 col-lg-6 col-md-6">
                        <?php foreach ($list_penugasan[2]['detail'] as $key => $row) { ?>
                        <div class="card">
                            <div class="card-header align-self-center">
                                <?= $row->no_surat ?>
                            </div>
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <span
                                        class="badge <?=($row->status_penugasan == 'Selesai') ? 'bg-success' : 'bg-primary' ?>">
                                        <?= $row->status_penugasan ?>
                                    </span>
                                    <ul class="list-unstyled d-flex align-items-center avatar-group mb-0">
                                        <?php foreach ($list_penugasan[2]['anggota'][$key] as $num => $value) { ?>
                                        <?php if ($num < 5) {
                                                    $limit = 0; ?>
                                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                            title="<?= $value->nama_lengkap ?>" class="avatar avatar-sm pull-up">
                                            <img class="rounded-circle"
                                                src="<?php echo base_url() . "data/foto/pegawai/" . $value->foto_pegawai; ?>"
                                                alt="Avatar" />
                                        </li>
                                        <?php } else {
                                                    $limit++;
                                                } ?>
                                        <?php } ?>
                                        <?php if ($limit > 1) { ?>
                                        <li class="avatar bg-primary avatar-sm pull-up">
                                            <div class="avatar-content" style="background-color: unset !important;">
                                                <?="+" . $limit ?>
                                            </div>
                                        </li>
                                        <?php } elseif ($limit == 1) { ?>
                                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                            title="<?= $list_penugasan[2]['anggota'][$key][$num]->nama_lengkap ?>"
                                            class="avatar avatar-sm pull-up">
                                            <img class="rounded-circle"
                                                src="<?php echo base_url() . "data/foto/pegawai/" . $list_penugasan[2]['anggota'][$key][$num]->foto_pegawai; ?>"
                                                alt="Avatar" />
                                        </li>
                                        <?php } ?>
                                    </ul>
                                </div>
                                <div class="d-flex justify-content-between align-items-end mt-1 pt-25">
                                    <div class="role-heading">
                                        <h4 class="fw-bolder">
                                            <?= $row->nama_penugasan ?>
                                        </h4>
                                        <span
                                            class="<?=($row->tanggal_akhir_penugasan < date('Y-m-d') and $row->status_penugasan != 'Selesai') ? 'text-danger' : '' ?>">
                                            <?= tanggal($row->tanggal_awal_penugasan) ?> -
                                            <?= tanggal($row->tanggal_akhir_penugasan) ?>
                                        </span>
                                    </div>
                                    <a href="<?= base_url('auditor/kertas_kerja/' . encode($row->id_penugasan)) ?>"
                                        class="text-body"><i data-feather="book" class="font-medium-5"></i> Detail</a>
                                </div>
                                <?php if (count($list_penugasan[2]['nhp'][$key]) > 0 OR count($list_penugasan[2]['lhp'][$key]) > 0 ) { ?>
                                <hr />
                                <?php foreach ($list_penugasan[2]['nhp'][$key] as $num => $value) { ?>
                                <?php if ($value->status_nhp) { ?>
                                <?php
                                            switch ($value->status_nhp) {
                                                case "Y":
                                                    $code = "primary";
                                                    $text = "Berkas NHP sudah disetujui.";
                                                    break;
                                                case "P":
                                                    $code = "warning";
                                                    $text = "Berkas NHP belum diverifikasi.";
                                                    break;
                                                case "N":
                                                    $code = "danger";
                                                    $text = "Berkas NHP telah ditolak.";
                                                    break;
                                                default:
                                                    $code = "dark";
                                                    $text = "";
                                                    break;
                                            }
                                            ?>
                                <div
                                    class="alert alert-<?= $code ?> mb-0 d-flex justify-content-between align-items-center mt-1 pt-25">
                                    <blockquote class="blockquote ps-1 py-1 border-start-<?= $code ?> border-start-3">
                                        <small><a
                                                href="javascript:void(0)"><svg width="24" height="24" viewBox="0 0 24 24"
                                                    fill="none" stroke="currentColor" stroke-width="2"
                                                    stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-paperclip font-small-3 align-middle me-0">
                                                    <path
                                                        d="M21.44 11.05l-9.19 9.19a6 6 0 0 1-8.49-8.49l9.19-9.19a4 4 0 0 1 5.66 5.66l-9.2 9.19a2 2 0 0 1-2.83-2.83l8.49-8.48">
                                                    </path>
                                                </svg>
                                                <?= $value->nama_skpd ?>
                                            </a></small>
                                        <footer class="blockquote-footer text-<?= $code ?> fs-5"><?= $text ?>
                                        </footer>
                                    </blockquote>
                                    <?php if ($value->status_nhp == "P" AND in_array($id_pegawai, explode(',',$row->pt_penugasan))) { ?>
                                    <a href="#" class="text-body" data-bs-toggle="modal"
                                        data-bs-target="#modals-slide-in"
                                        onclick="verifikasi_nhp(<?= $value->id_pekerjaan ?>)"><i
                                            data-feather="check-square" class="font-medium-5"></i>
                                        Verifikasi NHP</a>
                                    <?php } ?>
                                </div>
                                <?php } ?>
                                <?php } ?>
                                <?php foreach ($list_penugasan[2]['lhp'][$key] as $num => $value) { ?>
                                <?php if ($value->status_lhp) { ?>
                                <?php
                                            switch ($value->status_lhp) {
                                                case "Y":
                                                    $code = "primary";
                                                    $text = "Berkas LHP sudah disetujui.";
                                                    break;
                                                case "P":
                                                    $code = "warning";
                                                    $text = "Berkas LHP belum diverifikasi.";
                                                    break;
                                                case "N":
                                                    $code = "danger";
                                                    $text = "Berkas LHP telah ditolak.";
                                                    break;
                                                default:
                                                    $code = "dark";
                                                    $text = "";
                                                    break;
                                            }
                                            ?>
                                <div
                                    class="alert alert-<?= $code ?> mb-0 d-flex justify-content-between align-items-center mt-1 pt-25">
                                    <blockquote class="blockquote ps-1 py-1 border-start-<?= $code ?> border-start-3">
                                        <small><a
                                                href="javascript:void(0)"><svg width="24" height="24" viewBox="0 0 24 24"
                                                    fill="none" stroke="currentColor" stroke-width="2"
                                                    stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-paperclip font-small-3 align-middle me-0">
                                                    <path
                                                        d="M21.44 11.05l-9.19 9.19a6 6 0 0 1-8.49-8.49l9.19-9.19a4 4 0 0 1 5.66 5.66l-9.2 9.19a2 2 0 0 1-2.83-2.83l8.49-8.48">
                                                    </path>
                                                </svg>
                                                <?= $value->nama_skpd ?>
                                            </a></small>
                                        <footer class="blockquote-footer text-<?= $code ?> fs-5"><?= $text ?>
                                        </footer>
                                    </blockquote>
                                    <?php if ($value->status_lhp == "P" AND in_array($id_pegawai, explode(',',$row->ppj_penugasan)) AND $value->status_nhp == "Y") { ?>
                                    <a href="#" class="text-body" data-bs-toggle="modal"
                                        data-bs-target="#modals-slide-in"
                                        onclick="verifikasi_lhp(<?= $value->id_pekerjaan ?>)"><i
                                            data-feather="check-square" class="font-medium-5"></i>
                                        Verifikasi LHP</a>
                                    <?php } ?>
                                </div>
                                <?php } ?>
                                <?php } ?>
                                <?php } ?>
                            </div>
                            <div class="card-footer d-flex justify-content-between">
                                <div>
                                    <h5>
                                        <?= $row->nama_tim ?>
                                    </h5>
                                </div>
                                <div>
                                    <?php if($kepala_skpd == "Y"){?>
                                    <a href="#" class="text-body" data-bs-toggle="modal" data-bs-target="#addNewCard"
                                        onclick="change_klasifikasi(<?= $row->klasifikasi ?>,'<?= encode($row->id_penugasan) ?>')"><i
                                            data-feather="sliders" class="font-medium-5"></i>
                                        Ubah Klasifikasi</a>
                                        <?php }?>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                    <div class="col-xl-4 col-lg-6 col-md-6">
                        <?php foreach ($list_penugasan[3]['detail'] as $key => $row) { ?>
                        <div class="card">
                            <div class="card-header align-self-center">
                                <?= $row->no_surat ?>
                            </div>
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <span
                                        class="badge <?=($row->status_penugasan == 'Selesai') ? 'bg-success' : 'bg-primary' ?>">
                                        <?= $row->status_penugasan ?>
                                    </span>
                                    <ul class="list-unstyled d-flex align-items-center avatar-group mb-0">
                                        <?php foreach ($list_penugasan[3]['anggota'][$key] as $num => $value) { ?>
                                        <?php if ($num < 5) {
                                                    $limit = 0; ?>
                                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                            title="<?= $value->nama_lengkap ?>" class="avatar avatar-sm pull-up">
                                            <img class="rounded-circle"
                                                src="<?php echo base_url() . "data/foto/pegawai/" . $value->foto_pegawai; ?>"
                                                alt="Avatar" />
                                        </li>
                                        <?php } else {
                                                    $limit++;
                                                } ?>
                                        <?php } ?>
                                        <?php if ($limit > 1) { ?>
                                        <li class="avatar bg-primary avatar-sm pull-up">
                                            <div class="avatar-content" style="background-color: unset !important;">
                                                <?="+" . $limit ?>
                                            </div>
                                        </li>
                                        <?php } elseif ($limit == 1) { ?>
                                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                            title="<?= $list_penugasan[3]['anggota'][$key][$num]->nama_lengkap ?>"
                                            class="avatar avatar-sm pull-up">
                                            <img class="rounded-circle"
                                                src="<?php echo base_url() . "data/foto/pegawai/" . $list_penugasan[3]['anggota'][$key][$num]->foto_pegawai; ?>"
                                                alt="Avatar" />
                                        </li>
                                        <?php } ?>
                                    </ul>
                                </div>
                                <div class="d-flex justify-content-between align-items-end mt-1 pt-25">
                                    <div class="role-heading">
                                        <h4 class="fw-bolder">
                                            <?= $row->nama_penugasan ?>
                                        </h4>
                                        <span
                                            class="<?=($row->tanggal_akhir_penugasan < date('Y-m-d') and $row->status_penugasan != 'Selesai') ? 'text-danger' : '' ?>">
                                            <?= tanggal($row->tanggal_awal_penugasan) ?> -
                                            <?= tanggal($row->tanggal_akhir_penugasan) ?>
                                        </span>
                                    </div>
                                    <a href="<?= base_url('auditor/kertas_kerja/' . encode($row->id_penugasan)) ?>"
                                        class="text-body"><i data-feather="book" class="font-medium-5"></i> Detail</a>
                                </div>
                                <?php if (count($list_penugasan[3]['nhp'][$key]) > 0 OR count($list_penugasan[3]['lhp'][$key]) > 0 ) { ?>
                                <hr />
                                <?php foreach ($list_penugasan[3]['nhp'][$key] as $num => $value) { ?>
                                <?php if ($value->status_nhp) { ?>
                                <?php
                                            switch ($value->status_nhp) {
                                                case "Y":
                                                    $code = "primary";
                                                    $text = "Berkas NHP sudah disetujui.";
                                                    break;
                                                case "P":
                                                    $code = "warning";
                                                    $text = "Berkas NHP belum diverifikasi.";
                                                    break;
                                                case "N":
                                                    $code = "danger";
                                                    $text = "Berkas NHP telah ditolak.";
                                                    break;
                                                default:
                                                    $code = "dark";
                                                    $text = "";
                                                    break;
                                            }
                                            ?>
                                <div
                                    class="alert alert-<?= $code ?> mb-0 d-flex justify-content-between align-items-center mt-1 pt-25">
                                    <blockquote class="blockquote ps-1 py-1 border-start-<?= $code ?> border-start-3">
                                        <small><a
                                                href="javascript:void(0)"><svg width="24" height="24" viewBox="0 0 24 24"
                                                    fill="none" stroke="currentColor" stroke-width="2"
                                                    stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-paperclip font-small-3 align-middle me-0">
                                                    <path
                                                        d="M21.44 11.05l-9.19 9.19a6 6 0 0 1-8.49-8.49l9.19-9.19a4 4 0 0 1 5.66 5.66l-9.2 9.19a2 2 0 0 1-2.83-2.83l8.49-8.48">
                                                    </path>
                                                </svg>
                                                <?= $value->nama_skpd ?>
                                            </a></small>
                                        <footer class="blockquote-footer text-<?= $code ?> fs-5"><?= $text ?>
                                        </footer>
                                    </blockquote>
                                    <?php if ($value->status_nhp == "P" AND in_array($id_pegawai, explode(',',$row->pt_penugasan))) { ?>
                                    <a href="#" class="text-body" data-bs-toggle="modal"
                                        data-bs-target="#modals-slide-in"
                                        onclick="verifikasi_nhp(<?= $value->id_pekerjaan ?>)"><i
                                            data-feather="check-square" class="font-medium-5"></i>
                                        Verifikasi NHP</a>
                                    <?php } ?>
                                </div>
                                <?php } ?>
                                <?php } ?>
                                <?php foreach ($list_penugasan[3]['lhp'][$key] as $num => $value) { ?>
                                <?php if ($value->status_lhp) { ?>
                                <?php
                                            switch ($value->status_lhp) {
                                                case "Y":
                                                    $code = "primary";
                                                    $text = "Berkas LHP sudah disetujui.";
                                                    break;
                                                case "P":
                                                    $code = "warning";
                                                    $text = "Berkas LHP belum diverifikasi.";
                                                    break;
                                                case "N":
                                                    $code = "danger";
                                                    $text = "Berkas LHP telah ditolak.";
                                                    break;
                                                default:
                                                    $code = "dark";
                                                    $text = "";
                                                    break;
                                            }
                                            ?>
                                <div
                                    class="alert alert-<?= $code ?> mb-0 d-flex justify-content-between align-items-center mt-1 pt-25">
                                    <blockquote class="blockquote ps-1 py-1 border-start-<?= $code ?> border-start-3">
                                        <small><a
                                                href="javascript:void(0)"><svg width="24" height="24" viewBox="0 0 24 24"
                                                    fill="none" stroke="currentColor" stroke-width="2"
                                                    stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-paperclip font-small-3 align-middle me-0">
                                                    <path
                                                        d="M21.44 11.05l-9.19 9.19a6 6 0 0 1-8.49-8.49l9.19-9.19a4 4 0 0 1 5.66 5.66l-9.2 9.19a2 2 0 0 1-2.83-2.83l8.49-8.48">
                                                    </path>
                                                </svg>
                                                <?= $value->nama_skpd ?>
                                            </a></small>
                                        <footer class="blockquote-footer text-<?= $code ?> fs-5"><?= $text ?>
                                        </footer>
                                    </blockquote>
                                    <?php if ($value->status_lhp == "P" AND in_array($id_pegawai, explode(',',$row->ppj_penugasan)) AND $value->status_nhp == "Y") { ?>
                                    <a href="#" class="text-body" data-bs-toggle="modal"
                                        data-bs-target="#modals-slide-in"
                                        onclick="verifikasi_lhp(<?= $value->id_pekerjaan ?>)"><i
                                            data-feather="check-square" class="font-medium-5"></i>
                                        Verifikasi LHP</a>
                                    <?php } ?>
                                </div>
                                <?php } ?>
                                <?php } ?>
                                <?php } ?>
                            </div>
                            <div class="card-footer d-flex justify-content-between">
                                <div>
                                    <h5>
                                        <?= $row->nama_tim ?>
                                    </h5>
                                </div>
                                <div>
                                    <?php if($kepala_skpd == "Y"){?>
                                    <a href="#" class="text-body" data-bs-toggle="modal" data-bs-target="#addNewCard"
                                        onclick="change_klasifikasi(<?= $row->klasifikasi ?>,'<?= encode($row->id_penugasan) ?>')"><i
                                            data-feather="sliders" class="font-medium-5"></i>
                                        Ubah Klasifikasi</a>
                                        <?php }?>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
                <!--/ Role cards -->

            </div>

        </div>
    </div>
</div>
<!-- END: Content-->

<!-- add new card modal  -->
<div class="modal fade" id="addNewCard" tabindex="-1" aria-labelledby="addNewCardTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-transparent">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body px-sm-5 mx-50 pb-5">
                <h1 class="text-center mb-1" id="addNewCardTitle">Ubah Klasifikasi</h1>

                <!-- form -->
                <form id="addNewCardValidation" class="row gy-1 gx-2 mt-75" onsubmit="return false">

                    <div class="col-4 d-grid">
                        <button type="button" id="btn-klas-1" onclick="change_klasifikasi(1)"
                            class="btn btn-outline-success waves-effect form-control text-center pe-25 ps-25">
                            <p><i data-feather="alert-circle" class="font-medium-5"></i></p>
                            <small>Observasi</small>
                        </button>
                    </div>
                    <div class="col-4 d-grid">
                        <button type="button" id="btn-klas-2" onclick="change_klasifikasi(2)"
                            class="btn btn-warning waves-effect form-control text-center pe-25 ps-25">
                            <p><i data-feather="alert-triangle" class="font-medium-5"></i></p><small>Ketidaksesuaian
                                Minor</small>
                        </button>
                    </div>
                    <div class="col-4 d-grid">
                        <button type="button" id="btn-klas-3" onclick="change_klasifikasi(3)"
                            class="btn btn-outline-danger waves-effect form-control text-center pe-25 ps-25">
                            <p><i data-feather="alert-octagon" class="font-medium-5"></i></p> <small>Ketidaksesuaian
                                Mayor</small>
                        </button>
                    </div>


                    <div class="col-12 text-center">
                        <input type="hidden" id="klas-id" name="id_penugasan" required>
                        <input type="hidden" id="klas-name" name="klasifikasi" required>
                        <button type="submit" onclick="submit_klasifikasi()"
                            class="btn btn-primary me-1 mt-1">Ganti</button>
                        <button type="reset" class="btn btn-outline-secondary mt-1" data-bs-dismiss="modal"
                            aria-label="Close">
                            Batal
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--/ add new card modal  -->

<!-- Modal to add new user starts-->
<div class="modal modal-slide-in new-user-modal fade" id="modals-slide-in">
    <div class="add-new-data pangkat fileframe show" style="width:70%">
        <iframe id="slide-fileframe" frameborder="0"
            style="overflow: scroll; overflow-x: hidden; overflow-y: scroll; padding:0px;margin:0px; width: 100%; height: 100%;"></iframe>
    </div>
    <div class="modal-dialog" style="width:30%">
        <form class="add-new-user modal-content pt-0" id="form-verifikasi">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
            <div class="modal-header mb-1">
                <h5 class="modal-title" id="exampleModalLabel">Verifikasi</h5>
            </div>
            <div class="modal-body flex-grow-1">
                <div class="mb-1" id="coverv">
                    <label for="cover" class="form-label fw-bolder">Cover</label>
                    <img id="img-coverv" class="img-fluid rounded mb-50" height="3">
                </div>
                <div class="mb-1">
                    <label class="form-label fw-bolder">Judul</label>
                    <p class="card-text" id="judulv"></p>
                </div>
                <div class="mb-1">
                    <label class="form-label fw-bolder" for="due-date">Tanggal</label>
                    <p class="card-text" id="tanggalv"></p>
                </div>
                <div class="mb-1 lhp_itemsv">
                    <label class="form-label fw-bolder" for="due-date">Aspek Temuan</label>
                    <p class="card-text" id="aspekv"></p>
                </div>
                <div class="mb-1 lhp_itemsv">
                    <label class="form-label fw-bolder w-100" for="due-date">Jumlah Temuan <span class="float-end card-text" id="j_temuanv"></span></label>
                </div>
                <div class="mb-1 lhp_itemsv">
                    <label class="form-label fw-bolder w-100" for="due-date">Jumlah Rekomendasi <span class="float-end card-text" id="j_rekomendasiv"></span></label>
                </div>
                <div class="mb-1 lhp_itemsv">
                    <label class="form-label fw-bolder w-100" for="due-date">Jumlah Kerugian <span class="float-end card-text" id="j_kerugianv"></span></label>
                </div>
                <div class="mb-1 lhp_itemsv">
                    <label class="form-label fw-bolder w-100" for="due-date">Jumlah Kewajiban <span class="float-end card-text" id="j_kewajibanv"></span></label>
                </div>
                <div class="mb-1">
                    <label class="form-label fw-bolder" for="title">Nama Topik / Masalah yang
                        dijumpai</label>
                    <p class="card-text" id="topikv">
                    </p>
                </div>
                <div class="mb-1">
                    <label class="form-label fw-bolder" for="label">Lokasi Obrik</label>
                    <p class="card-text" id="skpdv"></p>
                </div>
                <div class="mb-1">
                    <label class="form-label fw-bolder">Anggota</label>
                    <ul class="assigned ps-0" id="anggotav">
                    </ul>
                </div>
                <hr />
                <div class="mb-2">
                    <label class="form-label fw-bolder" for="user-plan">Alasan Penolakan (*jika ditolak)</label>
                    <textarea name="alasan_penolakan" id="alasan_penolakanv" class="form-control"></textarea>
                </div>
                <input type="hidden" id="board_idv" name="board_id" class="form-control" placeholder="ID">
                <div id="btn_nhpv" class="hidden">
                    <button type="button" onclick="submit_verifikasi('terima','nhp')"
                        class="btn btn-primary me-1 data-submit">Terima</button>
                    <button type="button" onclick="submit_verifikasi('tolak','nhp')"
                        class="btn btn-danger me-1 data-submit">Tolak</button>
                    <button type="reset" class="btn btn-outline-secondary float-end"
                        data-bs-dismiss="modal">Kembali</button>
                </div>
                <div id="btn_lhpv" class="hidden">
                    <button type="button" onclick="submit_verifikasi('terima','lhp')"
                        class="btn btn-primary me-1 data-submit">Terima</button>
                    <button type="button" onclick="submit_verifikasi('tolak','lhp')"
                        class="btn btn-danger me-1 data-submit">Tolak</button>
                    <button type="reset" class="btn btn-outline-secondary float-end"
                        data-bs-dismiss="modal">Kembali</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- Modal to add new user Ends-->


<script type="text/javascript">
function change_klasifikasi(klas, id) {
    if (id) {
        $('#klas-id').val(id);
    }
    $('#klas-name').val(klas);
    switch (klas) {
        case 1:
            $('#btn-klas-1').removeClass("btn-outline-success").addClass("btn-success");
            $('#btn-klas-2').removeClass("btn-warning").addClass("btn-outline-warning");
            $('#btn-klas-3').removeClass("btn-danger").addClass("btn-outline-danger");
            break;
        case 2:
            $('#btn-klas-1').removeClass("btn-success").addClass("btn-outline-success");
            $('#btn-klas-2').removeClass("btn-outline-warning").addClass("btn-warning");
            $('#btn-klas-3').removeClass("btn-danger").addClass("btn-outline-danger");
            break;
        case 3:
            $('#btn-klas-1').removeClass("btn-success").addClass("btn-outline-success");
            $('#btn-klas-2').removeClass("btn-warning").addClass("btn-outline-warning");
            $('#btn-klas-3').removeClass("btn-outline-danger").addClass("btn-danger");
            break;
        default:
            $('#btn-klas-1').removeClass("btn-success").addClass("btn-outline-success");
            $('#btn-klas-2').removeClass("btn-warning").addClass("btn-outline-warning");
            $('#btn-klas-3').removeClass("btn-danger").addClass("btn-outline-danger");
            break;
    }
}

function submit_klasifikasi() {
    var form = $("#addNewCardValidation")[0];
    var data = new FormData(form);
    $.ajax({
        url: "<?= base_url() ?>auditor/change_klasifikasi",
        type: "post",
        data: data,
        processData: false,
        contentType: false,
        cache: false,
        success: function(data) {
            data = JSON.parse(data);
            if (data.error == false) {
                Swal.fire({
                    title: "Success!",
                    text: data.error_msg,
                    icon: "success",
                    customClass: {
                        confirmButton: "btn btn-primary",
                    },
                    buttonsStyling: !1,
                }).then(function() {
                    window.location.reload(true);
                });
            } else {
                Swal.fire({
                    title: "Error! ",
                    text: data.error_msg,
                    icon: "error",
                    customClass: {
                        confirmButton: "btn btn-danger",
                    },
                    buttonsStyling: !1,
                }).then(function() {
                    window.location.reload(true);
                });
            }
        },
    });
}

function verifikasi_nhp(id) {
    $.ajax({
        url: "<?= base_url() ?>auditor/get_pekerjaan/" + id,
        type: "get",
        processData: false,
        contentType: false,
        cache: false,
        success: function(data) {
            data = JSON.parse(data);
            $("#form-verifikasi")[0].reset();
            if (data.error == false) {
                if (data.pekerjaan) {
                    $('#board_idv').val(data.pekerjaan.detail.board_id);
                    $('#slide-fileframe').attr('src', '/data/auditor/kertas_kerja/attachment/' +
                        data.pekerjaan.detail.berkas_nhp);
                    if (data.pekerjaan.detail.cover_pekerjaan) {
                        $('#coverv').removeClass('hidden');
                        $('#img-coverv').attr('src', '/data/auditor/kertas_kerja/cover/' +
                            data.pekerjaan.detail.cover_pekerjaan);
                    } else {
                        $('#coverv').addClass('hidden');
                    }
                    $('#judulv').html(data.pekerjaan.detail.judul_nhp);
                    $('#tanggalv').html(data.pekerjaan.detail.tanggal_nhp);
                    $('#topikv').html(data.pekerjaan.detail.nama_topik);
                    $('#skpdv').html(data.pekerjaan.detail.nama_skpd);
                    list_anggota = "";
                    if (data.pekerjaan.anggota) {
                        data.pekerjaan.anggota.forEach(element => {
                            list_anggota +=
                                '<li class="avatar kanban-item-avatar avatar-sm me-50 mb-50" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="' +
                                element.nama_lengkap + '"><img src="/data/foto/pegawai/' + element
                                .foto_pegawai + '" alt="Avatar" height="32"></li>';
                        });
                    }
                    $('#anggotav').html(list_anggota);
                    $('[data-bs-toggle="tooltip"]').tooltip();
                    $('#btn_nhpv').removeClass('hidden');
                    $('#btn_lhpv').addClass('hidden');
                    $('.lhp_itemsv').addClass('hidden');
                }
            } else {
                Swal.fire({
                    title: "Error! ",
                    text: data.error_msg,
                    icon: "error",
                    customClass: {
                        confirmButton: "btn btn-danger",
                    },
                    buttonsStyling: !1,
                }).then(function() {
                    $('#modals-slide-in').modal('toggle');
                });
            }
        },
    });
}

function verifikasi_lhp(id) {
    $.ajax({
        url: "<?= base_url() ?>auditor/get_pekerjaan/" + id,
        type: "get",
        processData: false,
        contentType: false,
        cache: false,
        success: function(data) {
            data = JSON.parse(data);
            $("#form-verifikasi")[0].reset();
            if (data.error == false) {
                if (data.pekerjaan) {
                    $('#board_idv').val(data.pekerjaan.detail.board_id);
                    $('#slide-fileframe').attr('src', '/data/auditor/kertas_kerja/attachment/' +
                        data.pekerjaan.detail.berkas_lhp);
                    if (data.pekerjaan.detail.cover_pekerjaan) {
                        $('#coverv').removeClass('hidden');
                        $('#img-coverv').attr('src', '/data/auditor/kertas_kerja/cover/' +
                            data.pekerjaan.detail.cover_pekerjaan);
                    } else {
                        $('#coverv').addClass('hidden');
                    }
                    $('#judulv').html(data.pekerjaan.detail.judul_lhp);
                    $('#tanggalv').html(data.pekerjaan.detail.tanggal_lhp);
                    $('#aspekv').html(data.pekerjaan.detail.aspek_temuan);
                    $('#j_temuanv').html(data.pekerjaan.detail.jumlah_temuan);
                    $('#j_rekomendasiv').html(data.pekerjaan.detail.jumlah_rekomendasi);
                    $('#j_kerugianv').html("Rp"+(data.pekerjaan.detail.jumlah_kerugian - data.pekerjaan.detail.disetor_kerugian));
                    $('#j_kewajibanv').html("Rp"+(data.pekerjaan.detail.jumlah_kewajiban - data.pekerjaan.detail.disetor_kewajiban));
                    $('#topikv').html(data.pekerjaan.detail.nama_topik);
                    $('#skpdv').html(data.pekerjaan.detail.nama_skpd);
                    list_anggota = "";
                    if (data.pekerjaan.anggota) {
                        data.pekerjaan.anggota.forEach(element => {
                            list_anggota +=
                                '<li class="avatar kanban-item-avatar avatar-sm me-50 mb-50" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="' +
                                element.nama_lengkap + '"><img src="/data/foto/pegawai/' + element
                                .foto_pegawai + '" alt="Avatar" height="32"></li>';
                        });
                    }
                    $('#anggotav').html(list_anggota);
                    $('[data-bs-toggle="tooltip"]').tooltip();
                    $('#btn_nhpv').addClass('hidden');
                    $('#btn_lhpv').removeClass('hidden');
                    $('.lhp_itemsv').removeClass('hidden');
                }
            } else {
                Swal.fire({
                    title: "Error! ",
                    text: data.error_msg,
                    icon: "error",
                    customClass: {
                        confirmButton: "btn btn-danger",
                    },
                    buttonsStyling: !1,
                }).then(function() {
                    $('#modals-slide-in').modal('toggle');
                });
            }
        },
    });
}

function submit_verifikasi(verifikasi,jenis) {
    $.ajax({
        url: "<?= base_url() ?>auditor/submit_verifikasi",
        type: "post",
        data: {
            jenis: jenis,
            verifikasi: verifikasi,
            board_id: $('#board_idv').val(),
            alasan_penolakan: $('#alasan_penolakanv').val(),
        },
        success: function(data) {
            data = JSON.parse(data);
            if (data.error == false) {
                Swal.fire({
                    title: "Success!",
                    text: data.error_msg,
                    icon: "success",
                    customClass: {
                        confirmButton: "btn btn-primary",
                    },
                    buttonsStyling: !1,
                }).then(function() {
                    window.location.reload(true);
                });
            } else {
                Swal.fire({
                    title: "Error! ",
                    text: data.error_msg,
                    icon: "error",
                    customClass: {
                        confirmButton: "btn btn-danger",
                    },
                    buttonsStyling: !1,
                }).then(function() {
                    window.location.reload(true);
                });
            }
        },
    });
}
</script>