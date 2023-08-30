<base href="https://e-office.sumedangkab.go.id" target="_parent">

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

div.more-info>p {
    margin: 0;
}

div.more-info>p>span.fw-bold {
    font-weight: 600 !important;
}

.item-badges .badge {
    width: 225px;
    overflow: hidden;
    text-overflow: ellipsis;
}

div.d-flex.justify-content-between.align-items-center.flex-wrap.mt-1 {
    overflow-x: hidden;
    overflow-y: visible;
}

div .avatar-group.mb-0 {
    width: auto;
    padding-left: 0;
}
</style>

<!-- BEGIN: Content-->
<div class="app-content content kanban-application">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row ms-25">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-start mb-0">
                            <?= $penugasan['detail']->nama_penugasan ?>
                        </h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="<?= base_url('auditor/pkpt'); ?>">Home</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a
                                        href="<?= base_url('auditor/pkpt_penugasan/' . @$this->session->userdata('auditor_pkpt')); ?>">Penugasan</a>
                                </li>
                                <li class="breadcrumb-item active">
                                    <a href="#">Program Kerja Audit</a>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">

            <section>
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
                                                                foreach ($list_penugasan['detail'] as $key => $list) {
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

                                                                    foreach ($list_penugasan['nhp'][$key] as $list_nhp) {
                                                                        if ($list_nhp->status_nhp == "P" and in_array($list_nhp->tanggal_nhp, explode(',', $minggu['list_date']))) {
                                                                            $aclass[] = "table-warning";
                                                                            $jadwal_verifikasinhp[] = (strlen($list_nhp->nama_topik) > 30) ? substr($list_nhp->nama_topik, 0, 30) . '...' : $list_nhp->nama_topik;
                                                                        }
                                                                        if ($list_nhp->status_nhp == "N" and in_array($list_nhp->tanggal_nhp, explode(',', $minggu['list_date']))) {
                                                                            $aclass[] = "table-danger";
                                                                            $jadwal_tolaknhp[] = (strlen($list_nhp->nama_topik) > 30) ? substr($list_nhp->nama_topik, 0, 30) . '...' : $list_nhp->nama_topik;
                                                                        }
                                                                    }

                                                                    foreach ($list_penugasan['lhp'][$key] as $list_lhp) {
                                                                        if ($list_lhp->status_lhp == "P" and in_array($list_lhp->tanggal_lhp, explode(',', $minggu['list_date']))) {
                                                                            $aclass[] = "table-warning";
                                                                            $jadwal_verifikasilhp[] = (strlen($list_lhp->nama_topik) > 30) ? substr($list_lhp->nama_topik, 0, 30) . '...' : $list_lhp->nama_topik;
                                                                        }
                                                                        if ($list_lhp->status_lhp == "N" and in_array($list_lhp->tanggal_lhp, explode(',', $minggu['list_date']))) {
                                                                            $aclass[] = "table-danger";
                                                                            $jadwal_tolaklhp[] = (strlen($list_lhp->nama_topik) > 30) ? substr($list_lhp->nama_topik, 0, 30) . '...' : $list_lhp->nama_topik;
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
            </section>

            <!-- app e-commerce details start -->
            <section class="app-ecommerce-details">
                <div class="card">
                    <!-- Product Details starts -->
                    <div class="card-body">
                        <div class="row my-2">
                            <div class="col-12 col-md-5 d-flex align-items-center justify-content-center mb-2 mb-md-0">
                                <iframe
                                    src="https://e-office.sumedangkab.go.id/data/surat_internal/surat_masuk/<?= $penugasan['detail']->file_ttd ?>"
                                    width="100%" height="100%" style="border: none;"></iframe>
                            </div>
                            <div class="col-12 col-md-7">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h4>
                                            <?= $penugasan['detail']->no_surat ?>
                                        </h4>
                                        <p
                                            class="card-text <?=($penugasan['detail']->tanggal_akhir_penugasan < date('Y-m-d') and $penugasan['detail']->status_penugasan != 'Selesai') ? 'text-danger' : '' ?>">
                                            <?= tanggal($penugasan['detail']->tanggal_awal_penugasan) ?> -
                                            <?= tanggal($penugasan['detail']->tanggal_akhir_penugasan) ?>
                                            <span
                                                class="badge <?=($penugasan['detail']->status_penugasan == 'Selesai') ? 'bg-success' : 'bg-primary' ?>"
                                                id="status-penugasan">
                                                <?= $penugasan['detail']->status_penugasan ?>
                                            </span>
                                        </p>
                                    </div>
                                    <div class="">
                                        <blockquote class="blockquote pe-1 border-end-primary border-end-3">
                                            <small>Nama yang diberi perintah</small>
                                            <h6>
                                                <?= $penugasan['detail']->nama_yang_diberi_perintah ?>
                                            </h6>
                                        </blockquote>
                                    </div>
                                </div>
                                <div class="col-12 my-1">
                                    <blockquote class="blockquote ps-1 border-start-primary border-start-3">
                                        <small>Lokasi penugasan</small>
                                        <h6>
                                            <?php $lokasi = array();
                                            foreach ($penugasan['lo_penugasan'] as $row) {
                                                $lokasi[] = ucwords(strtolower($row->nama_skpd));
                                                echo '<span class="badge badge-light-primary me-25 mt-25">' . ucwords(strtolower($row->nama_skpd)) . '</span>';
                                            }
                                            implode(', ', $lokasi) ?>
                                        </h6>
                                    </blockquote>
                                </div>
                                <hr />
                                <p class="card-text">
                                    <?= $penugasan['detail']->rincian_penugasan ?>
                                </p>
                                <!-- <ul class="product-features list-unstyled">
                                    <?php foreach (@$penugasan['program'] as $row) { ?>
                                                                                                                                                                                                                                                                                                                                        <li>
                                                                                                                                                                                                                                                                                                                                            <i data-feather="circle"></i>
                                                                                                                                                                                                                                                                                                                                            <span><?= $row->nama_program ?></span>
                                                                                                                                                                                                                                                                                                                                        </li>
                                    <?php } ?>
                                </ul> -->
                                <hr />
                                <div class="product-color-options d-flex justify-content-around mb-2">
                                    <div class="col-12 text-center">
                                        <div class="text-center">Penanggung Jawab</div>
                                        <?php $jumlah = count($penugasan['pj_penugasan']);
                                        $baris = ceil($jumlah / 11);
                                        $kolom = ceil($jumlah / $baris);
                                        $list_pj = array();
                                        for ($i = 1; $i <= $baris; $i++) { ?>
                                        <div class="avatar-group tim justify-content-center my-75">
                                            <?php if (count($penugasan['pj_penugasan']) > 1) { ?>
                                            <?php for ($key = ($kolom * $i) - $kolom; $key < ($kolom * $i); $key++) { ?>
                                            <?php if (isset($penugasan['pj_penugasan'][$key])) { 
                                            $list_pj[] = $penugasan['pj_penugasan'][$key]->id_pegawai?>
                                            <div data-bs-toggle="tooltip" data-popup="tooltip-custom"
                                                data-bs-placement="top"
                                                title="<?= $penugasan['pj_penugasan'][$key]->nama_lengkap ?>"
                                                class="avatar avatar-sm pull-up">
                                                <img class="rounded-circle"
                                                    src="<?php echo base_url() . "data/foto/pegawai/" . $penugasan['pj_penugasan'][$key]->foto_pegawai; ?>"
                                                    alt="Avatar" />
                                            </div>
                                            <?php } ?>
                                            <?php } ?>
                                            <?php } else { 
                                            $list_pj[] = $penugasan['pj_penugasan'][0]->id_pegawai?>
                                            <div data-bs-toggle="tooltip" data-popup="tooltip-custom"
                                                data-bs-placement="top"
                                                title="<?= $penugasan['pj_penugasan'][0]->nama_lengkap ?>"
                                                class="avatar avatar-sm pull-up ms-1 me-50">
                                                <img class="rounded-circle"
                                                    src="<?php echo base_url() . "data/foto/pegawai/" . $penugasan['pj_penugasan'][0]->foto_pegawai; ?>"
                                                    alt="Avatar" />
                                            </div>
                                            <span class="tex-dark"></span>
                                            <?= $penugasan['pj_penugasan'][0]->nama_lengkap ?>
                                            </span>
                                            <?php } ?>
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div
                                    class="product-color-options d-flex justify-content-around flex-sm-row flex-column mb-2">
                                    <div class="col-6 text-center">
                                        <div class="text-center">Pembantu Penanggung Jawab</div>
                                        <?php $jumlah = count($penugasan['ppj_penugasan']);
                                        $baris = ceil($jumlah / 11);
                                        $kolom = ceil($jumlah / $baris);
                                        $list_ppj = array();
                                        for ($i = 1; $i <= $baris; $i++) { ?>
                                        <div class="avatar-group tim justify-content-center my-75">
                                            <?php if (count($penugasan['ppj_penugasan']) > 1) { ?>
                                            <?php for ($key = ($kolom * $i) - $kolom; $key < ($kolom * $i); $key++) { ?>
                                            <?php if (isset($penugasan['ppj_penugasan'][$key])) { 
                                            $list_ppj[] = $penugasan['ppj_penugasan'][$key]->id_pegawai?>
                                            <div data-bs-toggle="tooltip" data-popup="tooltip-custom"
                                                data-bs-placement="top"
                                                title="<?= $penugasan['ppj_penugasan'][$key]->nama_lengkap ?>"
                                                class="avatar avatar-sm pull-up">
                                                <img class="rounded-circle"
                                                    src="<?php echo base_url() . "data/foto/pegawai/" . $penugasan['ppj_penugasan'][$key]->foto_pegawai; ?>"
                                                    alt="Avatar" />
                                            </div>
                                            <?php } ?>
                                            <?php } ?>
                                            <?php } else { 
                                            $list_ppj[] = $penugasan['ppj_penugasan'][0]->id_pegawai?>
                                            <div data-bs-toggle="tooltip" data-popup="tooltip-custom"
                                                data-bs-placement="top"
                                                title="<?= $penugasan['ppj_penugasan'][0]->nama_lengkap ?>"
                                                class="avatar avatar-sm pull-up ms-1 me-50">
                                                <img class="rounded-circle"
                                                    src="<?php echo base_url() . "data/foto/pegawai/" . $penugasan['ppj_penugasan'][0]->foto_pegawai; ?>"
                                                    alt="Avatar" />
                                            </div>
                                            <span class="tex-dark"></span>
                                            <?= $penugasan['ppj_penugasan'][0]->nama_lengkap ?>
                                            </span>
                                            <?php } ?>
                                        </div>
                                        <?php } ?>
                                    </div>
                                    <div class="col-6 text-center">
                                        <div class="text-center">Pengendali Teknis</div>
                                        <?php $jumlah = count($penugasan['pt_penugasan']);
                                        $baris = ceil($jumlah / 11);
                                        $kolom = ceil($jumlah / $baris);
                                        $list_pt = array();
                                        for ($i = 1; $i <= $baris; $i++) { ?>
                                        <div class="avatar-group tim justify-content-center my-75">
                                            <?php if (count($penugasan['pt_penugasan']) > 1) { ?>
                                            <?php for ($key = ($kolom * $i) - $kolom; $key < ($kolom * $i); $key++) { ?>
                                            <?php if (isset($penugasan['pt_penugasan'][$key])) { 
                                            $list_pt[] = $penugasan['pt_penugasan'][$key]->id_pegawai?>
                                            <div data-bs-toggle="tooltip" data-popup="tooltip-custom"
                                                data-bs-placement="top"
                                                title="<?= $penugasan['pt_penugasan'][$key]->nama_lengkap ?>"
                                                class="avatar avatar-sm pull-up">
                                                <img class="rounded-circle"
                                                    src="<?php echo base_url() . "data/foto/pegawai/" . $penugasan['pt_penugasan'][$key]->foto_pegawai; ?>"
                                                    alt="Avatar" />
                                            </div>
                                            <?php } ?>
                                            <?php } ?>
                                            <?php } else { 
                                            $list_pt[] = $penugasan['pt_penugasan'][0]->id_pegawai?>
                                            <div data-bs-toggle="tooltip" data-popup="tooltip-custom"
                                                data-bs-placement="top"
                                                title="<?= $penugasan['pt_penugasan'][0]->nama_lengkap ?>"
                                                class="avatar avatar-sm pull-up ms-1 me-50">
                                                <img class="rounded-circle"
                                                    src="<?php echo base_url() . "data/foto/pegawai/" . $penugasan['pt_penugasan'][0]->foto_pegawai; ?>"
                                                    alt="Avatar" />
                                            </div>
                                            <span class="tex-dark"></span>
                                            <?= $penugasan['pt_penugasan'][0]->nama_lengkap ?>
                                            </span>
                                            <?php } ?>
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="product-color-options d-flex justify-content-around">
                                    <div class="col-6 text-center">
                                        <div class="text-center">Ketua Tim</div>
                                        <?php $jumlah = count($penugasan['kt_penugasan']);
                                        $baris = ceil($jumlah / 11);
                                        $kolom = ceil($jumlah / $baris);
                                        $list_kt = array();
                                        for ($i = 1; $i <= $baris; $i++) { ?>
                                        <div class="avatar-group tim justify-content-center my-75">
                                            <?php if (count($penugasan['kt_penugasan']) > 1) { ?>
                                            <?php for ($key = ($kolom * $i) - $kolom; $key < ($kolom * $i); $key++) { ?>
                                            <?php if (isset($penugasan['kt_penugasan'][$key])) { 
                                            $list_kt[] = $penugasan['kt_penugasan'][$key]->id_pegawai?>
                                            <div data-bs-toggle="tooltip" data-popup="tooltip-custom"
                                                data-bs-placement="top"
                                                title="<?= $penugasan['kt_penugasan'][$key]->nama_lengkap ?>"
                                                class="avatar avatar-sm pull-up">
                                                <img class="rounded-circle"
                                                    src="<?php echo base_url() . "data/foto/pegawai/" . $penugasan['kt_penugasan'][$key]->foto_pegawai; ?>"
                                                    alt="Avatar" />
                                            </div>
                                            <?php } ?>
                                            <?php } ?>
                                            <?php } else { 
                                            $list_kt[] = $penugasan['kt_penugasan'][0]->id_pegawai?>
                                            <div data-bs-toggle="tooltip" data-popup="tooltip-custom"
                                                data-bs-placement="top"
                                                title="<?= $penugasan['kt_penugasan'][0]->nama_lengkap ?>"
                                                class="avatar avatar-sm pull-up ms-1 me-50">
                                                <img class="rounded-circle"
                                                    src="<?php echo base_url() . "data/foto/pegawai/" . $penugasan['kt_penugasan'][0]->foto_pegawai; ?>"
                                                    alt="Avatar" />
                                            </div>
                                            <span class="tex-dark"></span>
                                            <?= $penugasan['kt_penugasan'][0]->nama_lengkap ?>
                                            </span>
                                            <?php } ?>
                                        </div>
                                        <?php } ?>
                                    </div>
                                    <div class="col-6 text-center">
                                        <div class="text-center">Anggota</div>
                                        <?php $jumlah = count($penugasan['at_penugasan']);
                                        $baris = ceil($jumlah / 11);
                                        $kolom = ceil($jumlah / $baris);
                                        $list_at = array();
                                        for ($i = 1; $i <= $baris; $i++) { ?>
                                        <div class="avatar-group tim justify-content-center my-75">
                                            <?php if (count($penugasan['at_penugasan']) > 1) { ?>
                                            <?php for ($key = ($kolom * $i) - $kolom; $key < ($kolom * $i); $key++) { ?>
                                            <?php if (isset($penugasan['at_penugasan'][$key])) { $list_at[] = $penugasan['at_penugasan'][$key]->id_pegawai?>
                                            <div data-bs-toggle="tooltip" data-popup="tooltip-custom"
                                                data-bs-placement="top"
                                                title="<?= $penugasan['at_penugasan'][$key]->nama_lengkap ?>"
                                                class="avatar avatar-sm pull-up">
                                                <img class="rounded-circle"
                                                    src="<?php echo base_url() . "data/foto/pegawai/" . $penugasan['at_penugasan'][$key]->foto_pegawai; ?>"
                                                    alt="Avatar" />
                                            </div>
                                            <?php } ?>
                                            <?php } ?>
                                            <?php } else { 
                                                $list_at[] = $penugasan['at_penugasan'][0]->id_pegawai?>
                                            <div data-bs-toggle="tooltip" data-popup="tooltip-custom"
                                                data-bs-placement="top"
                                                title="<?= $penugasan['at_penugasan'][0]->nama_lengkap ?>"
                                                class="avatar avatar-sm pull-up ms-1 me-50">
                                                <img class="rounded-circle"
                                                    src="<?php echo base_url() . "data/foto/pegawai/" . $penugasan['at_penugasan'][0]->foto_pegawai; ?>"
                                                    alt="Avatar" />
                                            </div>
                                            <span class="tex-dark"></span>
                                            <?= $penugasan['at_penugasan'][0]->nama_lengkap ?>
                                            </span>
                                            <?php } ?>
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>
                                <hr />
                                <!-- <div class="d-flex flex-column flex-sm-row pt-1">
                                    <a href="#" class="btn btn-primary btn-cart me-0 me-sm-1 mb-1 mb-sm-0"
                                        data-bs-toggle="modal" data-bs-target="#addRoleModal">
                                        <i data-feather="clipboard" class="me-50"></i>
                                        <span class="add-to-cart">Ubah Program Kerja Audit</span>
                                    </a>
                                    <a href="#" class="btn btn-outline-secondary btn-wishlist me-0 me-sm-1 mb-1 mb-sm-0"
                                        data-bs-toggle="modal" data-bs-target="#addNewCard">
                                        <i data-feather="users" class="me-50"></i>
                                        <span>Ganti Ketua Tim</span>
                                    </a>
                                    <div class="btn-group dropdown-icon-wrapper btn-share hidden">
                                        <button type="button"
                                            class="btn btn-icon hide-arrow btn-outline-secondary dropdown-toggle"
                                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i data-feather="share-2"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a href="#" class="dropdown-item">
                                                <i data-feather="facebook"></i>
                                            </a>
                                            <a href="#" class="dropdown-item">
                                                <i data-feather="twitter"></i>
                                            </a>
                                            <a href="#" class="dropdown-item">
                                                <i data-feather="youtube"></i>
                                            </a>
                                            <a href="#" class="dropdown-item">
                                                <i data-feather="instagram"></i>
                                            </a>
                                        </div>
                                    </div> -->
                            </div>
                        </div>


                        <!-- Add Role Modal -->
                        <div class="modal fade" id="addRoleModal" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered modal-add-new-role">
                                <div class="modal-content">
                                    <div class="modal-header bg-transparent">
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body px-5 pb-5">
                                        <!-- Add role form -->
                                        <form id="addRoleForm" class="row" method="post"
                                            action="<?= base_url('auditor/kertas_kerja/' . $this->session->userdata('auditor_penugasan')) ?>">
                                            <div class="col-12 mb-2">
                                                <label class="form-label" for="nama_penugasan">Nama penugasan</label>
                                                <input type="text" name="nama_penugasan" class="form-control"
                                                    placeholder="Nama penugasan"
                                                    value="<?= $penugasan['detail']->nama_penugasan ?>" />
                                            </div>
                                            <div class="col-12 mb-2">
                                                <label class="form-label" for="rincian_penugasan">Rincian
                                                    penugasan</label>
                                                <textarea name="rincian_penugasan" class="form-control"
                                                    placeholder="Rincian penugasan"><?= $penugasan['detail']->rincian_penugasan ?></textarea>
                                            </div>
                                            <hr />
                                            <h6>Daftar Program Kerja Audit</h6>
                                            <div class="col-12 mb-2 hidden" id="clone-program">
                                                <input type="text" name="nama_program[]" class="form-control"
                                                    placeholder="Nama Program" />
                                            </div>
                                            <?php if (count(@$penugasan['program']) > 0) {
                                                foreach ($penugasan['program'] as $key => $value) { ?>
                                            <div class="col-12 mb-2">
                                                <input type="text" name="nama_program[]" class="form-control"
                                                    placeholder="Nama Program" value="<?= $value->nama_program ?>" />
                                            </div>
                                            <?php }
                                            } else { ?>
                                            <div class="col-12 mb-2">
                                                <input type="text" name="nama_program[]" class="form-control"
                                                    placeholder="Nama Program" />
                                            </div>
                                            <?php } ?>
                                            <div id="input-program">
                                            </div>
                                            <div class="col-12 mb-2">
                                                <button type="submit" name="submit_program"
                                                    class="btn btn-primary float-end">Simpan</button>
                                                <button type="reset" class="btn btn-outline-secondary me-1 float-end"
                                                    data-bs-dismiss="modal" aria-label="Close">
                                                    Batal
                                                </button>
                                                <button type="button"
                                                    onclick="$('#clone-program').clone().insertBefore('#input-program').removeClass('hidden');"
                                                    class="btn btn-dark me-1 float-start">Tambah
                                                    Program Lainnya</button>
                                            </div>
                                        </form>
                                        <!--/ Add role form -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--/ Add Role Modal -->

                        <!-- add new card modal  -->
                        <div class="modal fade" id="addNewCard" tabindex="-1" aria-labelledby="addNewCardTitle"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header bg-transparent">
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body px-sm-5 mx-50 pb-5">
                                        <h1 class="text-center mb-1" id="addNewCardTitle">Ganti Ketua Tim</h1>

                                        <!-- form -->
                                        <form id="addNewCardValidation" class="row gy-1 gx-2 mt-75" method="post"
                                            action="<?= base_url('auditor/kertas_kerja/' . $this->session->userdata('auditor_penugasan')) ?>">

                                            <div class="col-12 mb-2">
                                                <select name="anggota_penugasan" class="form-select select2" required>
                                                    <option value=""> - Pilih - </option>
                                                    <?php foreach ($penugasan['at_penugasan'] as $key => $value) { ?>
                                                    <option value="<?= $value->id_pegawai ?>">
                                                        <?= $value->nama_lengkap ?>
                                                    </option>
                                                    <?php } ?>
                                                </select>
                                            </div>


                                            <div class="col-12 text-center">
                                                <button type="submit" name="change_ketua"
                                                    class="btn btn-primary me-1 mt-1">Ganti</button>
                                                <button type="reset" class="btn btn-outline-secondary mt-1"
                                                    data-bs-dismiss="modal" aria-label="Close">
                                                    Batal
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--/ add new card modal  -->

                    </div>
                </div>
                <!-- Product Details ends -->
        </div>
        </section>

        <!-- Kanban starts -->
        <section class="app-kanban-wrapper">
            <div class="row hidden">
                <div class="col-12">
                    <form class="add-new-board">
                        <label class="add-new-btn mb-2" for="add-new-board-input">
                            <i class="align-middle" data-feather="plus"></i>
                            <span class="align-middle">Add new</span>
                        </label>
                        <input type="text" class="form-control add-new-board-input mb-50" placeholder="Add Board Title"
                            id="add-new-board-input" required />
                        <div class="mb-1 add-new-board-input">
                            <button class="btn btn-primary btn-sm me-75">Add</button>
                            <button type="button"
                                class="btn btn-outline-secondary btn-sm cancel-add-new">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Kanban content starts -->
            <div class="kanban-wrapper"></div>
            <!-- Kanban content ends -->
            <!-- Kanban Sidebar starts -->
            <div class="modal modal-slide-in update-item-sidebar fade">
                <div class="modal-dialog sidebar-lg">
                    <div class="modal-content p-0">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
                        <div class="modal-header mb-1">
                            <h5 class="modal-title">Kertas Kerja</h5>
                        </div>
                        <div class="modal-body flex-grow-1">
                            <ul class="nav nav-tabs tabs-line">
                                <li class="nav-item">
                                    <a class="nav-link nav-link-update active" data-bs-toggle="tab" href="#tab-update">
                                        <i data-feather="edit"></i>
                                        <span class="align-middle">Update</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link nav-link-activity" data-bs-toggle="tab" href="#tab-nhp">
                                        <i data-feather="clipboard"></i>
                                        <span class="align-middle">NHP</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link nav-link-activity" data-bs-toggle="tab" href="#tab-lhp">
                                        <i data-feather="file-text"></i>
                                        <span class="align-middle">LHP</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link nav-link-activity" data-bs-toggle="tab" href="#tab-activity">
                                        <i data-feather="bell"></i>
                                        <span class="align-middle">Aktifitas</span>
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content mt-2">
                                <div class="tab-pane tab-pane-update fade show active" id="tab-update" role="tabpanel">
                                    <form id="form-pekerjaan" class="update-item-form topik"
                                        action="javascript:void(0);">
                                        <div class="mb-1">
                                            <label for="cover" class="form-label">Cover</label>
                                            <img id="img-cover" class="img-fluid rounded mb-50" height="3">
                                            <input class="form-control file-attachments" type="file" id="cover"
                                                accept="image/png, image/gif, image/jpeg" name="cover_pekerjaan" />
                                        </div>
                                        <div class="mb-1">
                                            <label class="form-label" for="title">Nama Topik / Masalah yang
                                                dijumpai</label>
                                            <textarea id="title" name="nama_topik" class="form-control"
                                                placeholder="Enter Title"></textarea>
                                        </div>
                                        <div class="mb-1">
                                            <label class="form-label" for="due-date">Tanggal</label>
                                            <input type="text" id="due-date" name="tanggal_topik" class="form-control"
                                                placeholder="Enter Due Date" />
                                        </div>
                                        <div class="mb-1">
                                            <label class="form-label" for="label">Lokasi Obrik</label>
                                            <select class="select2 select2-label form-select" id="label"
                                                name="nama_skpd">
                                                <option value="">&nbsp;</option>
                                                <?php foreach ($penugasan['lo_penugasan'] as $row) { ?>
                                                <option value="<?= $row->nama_skpd ?>">
                                                    <?= $row->nama_skpd ?>
                                                </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="mb-1">
                                            <label class="form-label">Pembuat Kertas Kerja</label>
                                            <h5 id="pembuat">-</h5>
                                        </div>
                                        <div class="mb-1">
                                            <label class="form-label">Anggota</label>
                                            <ul class="assigned ps-0"></ul>
                                        </div>
                                        <div class="mb-1">
                                            <select class="select2 select2-label form-select" multiple id="member"
                                                name="anggota_topik[]">
                                                <?php foreach ($penugasan['at_penugasan'] as $row) { ?>
                                                <option value="<?= $row->id_pegawai ?>">
                                                    <?= $row->nama_lengkap ?>
                                                </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div id="hidden-update" class="hidden">
                                            <hr />
                                            <div class="mb-1">
                                                <div class="d-flex flex-wrap">
                                                    <input type="hidden" id="board_id" name="board_id" class="form-control"
                                                        placeholder="ID" />
                                                    <button id="btn-simpan" type="button" class="btn btn-primary me-1"
                                                        data-bs-dismiss="modal">Simpan</button>
                                                    <button id="btn-hapus" type="button" class="btn btn-outline-danger"
                                                        data-bs-dismiss="modal">Hapus</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane tab-pane-activity pb-1 fade" id="tab-nhp" role="tabpanel">
                                    <div id="status-nhp">
                                        <!-- <div class="alert alert-primary" role="alert">
                                            <div class="alert-body"><strong>Status:</strong> NHP sudah disetujui.</div>
                                        </div>
                                        <div class="alert alert-danger" role="alert">
                                            <div class="alert-body"><strong>Status:</strong> Berkas NHP ditolak.
                                            </div>
                                        </div>
                                        <div class="alert alert-secondary" role="alert">
                                            <div class="alert-body"><strong>Status:</strong> NHP sedang tahap
                                                verifikasi.
                                            </div>
                                        </div>
                                        <div class="alert alert-danger" role="alert">
                                            <div class="alert-body"><strong>Status:</strong> Berkas NHP belum diupload.
                                            </div>
                                        </div>
                                        <div class="alert alert-dark" role="alert">
                                            <div class="alert-body"><strong>Status:</strong> Tidak memiliki NHP.</div>
                                        </div>
                                        <blockquote class="blockquote ps-1 border-start-primary border-start-3">
                                            <small><a
                                                    href="https://e-office.sumedangkab.go.id/data/auditor/kertas_kerja/attachment/4b8bb17942201f9996709e8b610a0fd7.pdf"
                                                    target="_blank"><svg width="24" height="24" viewBox="0 0 24 24"
                                                        fill="none" stroke="currentColor" stroke-width="2"
                                                        stroke-linecap="round" stroke-linejoin="round"
                                                        class="feather feather-paperclip font-small-3 align-middle me-0">
                                                        <path
                                                            d="M21.44 11.05l-9.19 9.19a6 6 0 0 1-8.49-8.49l9.19-9.19a4 4 0 0 1 5.66 5.66l-9.2 9.19a2 2 0 0 1-2.83-2.83l8.49-8.48">
                                                        </path>
                                                    </svg> 4b8bb17942201f9996709e8b610a0fd7.pdf</a></small>
                                            <footer class="blockquote-footer">Berkas NHP - 22 Desember 2022 | 22:26:50
                                            </footer>
                                        </blockquote> -->
                                    </div>
                                    <div id="hidden-nhp" class="hidden">
                                        <hr />
                                        <form id="form-aktifitas-nhp" action="javascript:void(0)">
                                            <div class="mb-1">
                                                <label for="judul_nhp" class="form-label">Judul NHP</label>
                                                <input class="form-control file-attachments" name="judul_nhp" type="text"
                                                    id="judul_nhp" required />
                                            </div>
                                            <div class="mb-1">
                                                <label for="tanggal_nhp" class="form-label">Tanggal NHP</label>
                                                <input class="form-control file-attachments" name="tanggal_nhp" type="date"
                                                    id="tanggal_nhp" required />
                                            </div>
                                            <div class="mb-1">
                                                <label for="attachments-nhp" class="form-label">Berkas NHP</label>
                                                <input class="form-control file-attachments" name="berkas_nhp" type="file"
                                                    id="attachments-nhp" required />
                                            </div>
                                            <div class="mb-1">
                                                <div class="d-flex flex-wrap justify-content-between">
                                                    <input type="hidden" id="board_idan" name="board_id"
                                                        class="form-control" placeholder="ID" />
                                                    <button id="btn-aktifitas-nhp" type="button"
                                                        class="btn btn-primary me-1">Upload NHP</button>
                                                    <button id="btn-hapus-nhp" type="button" class="btn btn-outline-dark"
                                                        data-bs-dismiss="modal">Tidak memiliki NHP</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <hr />
                                    <section id="list-aktifitas-nhp">
                                        <!-- <div class="d-flex align-items-start mb-1">
                                            <div class="avatar my-0 ms-0 me-50">
                                                <img src="/data/foto/pegawai/user-default.png" alt="Avatar" height="32">
                                            </div>
                                            <div class="more-info w-100">
                                                <p class="mb-0">
                                                </p>
                                                <blockquote class="blockquote">
                                                    <footer class="blockquote-footer text-dark"><span
                                                            class="fw-bolder">Administrator</span> <span
                                                            class="text-primary">menyetujui</span> berkas NHP.
                                                    </footer>
                                                </blockquote>
                                                <p></p>

                                                <small class="text-muted">22 Desember 2022 | 22:26:50 </small>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-start mb-1">
                                            <div class="avatar my-0 ms-0 me-50">
                                                <img src="/data/foto/pegawai/user-default.png" alt="Avatar" height="32">
                                            </div>
                                            <div class="more-info">
                                                <p class="mb-0">
                                                    <span class="fw-bold">Administrator</span>
                                                </p>
                                                <blockquote class="blockquote ps-1 border-start-primary border-start-3">
                                                    <small><a
                                                            href="https://e-office.sumedangkab.go.id/data/auditor/kertas_kerja/attachment/4b8bb17942201f9996709e8b610a0fd7.pdf"
                                                            target="_blank"><svg width="24" height="24"
                                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                                stroke-width="2" stroke-linecap="round"
                                                                stroke-linejoin="round"
                                                                class="feather feather-paperclip font-small-3 align-middle me-0">
                                                                <path
                                                                    d="M21.44 11.05l-9.19 9.19a6 6 0 0 1-8.49-8.49l9.19-9.19a4 4 0 0 1 5.66 5.66l-9.2 9.19a2 2 0 0 1-2.83-2.83l8.49-8.48">
                                                                </path>
                                                            </svg> 4b8bb17942201f9996709e8b610a0fd7.pdf</a></small>
                                                    <footer class="blockquote-footer">mengupload berkas NHP.
                                                    </footer>
                                                </blockquote>
                                                <small class="text-muted">22 Desember 2022 | 22:30:12 </small>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-start mb-1">
                                            <div class="avatar my-0 ms-0 me-50">
                                                <img src="/data/foto/pegawai/user-default.png" alt="Avatar" height="32">
                                            </div>
                                            <div class="more-info w-100 ">
                                                <p class="mb-0">
                                                </p>
                                                <blockquote class="blockquote">
                                                    <footer class="blockquote-footer text-dark"><span
                                                            class="fw-bolder">Administrator</span> <span
                                                            class="text-danger">menolak</span> berkas NHP.
                                                    </footer>
                                                </blockquote>
                                                <blockquote class="blockquote ps-1 border-start-danger border-start-3">
                                                    <small>Tolong perbaiki lagi berkasnya.</small>
                                                </blockquote>
                                                <p></p>

                                                <small class="text-muted">22 Desember 2022 | 22:26:50 </small>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-start mb-1">
                                            <div class="avatar my-0 ms-0 me-50">
                                                <img src="/data/foto/pegawai/user-default.png" alt="Avatar" height="32">
                                            </div>
                                            <div class="more-info">
                                                <p class="mb-0">
                                                    <span class="fw-bold">Administrator</span>
                                                </p>
                                                <blockquote class="blockquote ps-1 border-start-primary border-start-3">
                                                    <small><a
                                                            href="https://e-office.sumedangkab.go.id/data/auditor/kertas_kerja/attachment/4b8bb17942201f9996709e8b610a0fd7.pdf"
                                                            target="_blank"><svg width="24" height="24"
                                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                                stroke-width="2" stroke-linecap="round"
                                                                stroke-linejoin="round"
                                                                class="feather feather-paperclip font-small-3 align-middle me-0">
                                                                <path
                                                                    d="M21.44 11.05l-9.19 9.19a6 6 0 0 1-8.49-8.49l9.19-9.19a4 4 0 0 1 5.66 5.66l-9.2 9.19a2 2 0 0 1-2.83-2.83l8.49-8.48">
                                                                </path>
                                                            </svg> 4b8bb17942201f9996709e8b610a0fd7.pdf</a></small>
                                                    <footer class="blockquote-footer">mengupload berkas NHP.
                                                    </footer>
                                                </blockquote>
                                                <small class="text-muted">22 Desember 2022 | 22:30:12 </small>
                                            </div>
                                        </div> -->
                                    </section>
                                </div>
                                <div class="tab-pane tab-pane-activity pb-1 fade" id="tab-lhp" role="tabpanel">
                                    <div id="status-lhp">
                                        <!-- <div class="alert alert-primary" role="alert">
                                            <div class="alert-body"><strong>Status:</strong> LHP sudah disetujui.</div>
                                        </div>
                                        <div class="alert alert-danger" role="alert">
                                            <div class="alert-body"><strong>Status:</strong> Berkas LHP ditolak.
                                            </div>
                                        </div>
                                        <div class="alert alert-secondary" role="alert">
                                            <div class="alert-body"><strong>Status:</strong> LHP sedang tahap
                                                verifikasi.
                                            </div>
                                        </div>
                                        <div class="alert alert-danger" role="alert">
                                            <div class="alert-body"><strong>Status:</strong> Berkas LHP belum diupload.
                                            </div>
                                        </div>
                                        <div class="alert alert-dark" role="alert">
                                            <div class="alert-body"><strong>Status:</strong> Tidak memiliki LHP.</div>
                                        </div>
                                        <blockquote class="blockquote ps-1 border-start-primary border-start-3">
                                            <small><a
                                                    href="https://e-office.sumedangkab.go.id/data/auditor/kertas_kerja/attachment/4b8bb17942201f9996709e8b610a0fd7.pdf"
                                                    target="_blank"><svg width="24" height="24" viewBox="0 0 24 24"
                                                        fill="none" stroke="currentColor" stroke-width="2"
                                                        stroke-linecap="round" stroke-linejoin="round"
                                                        class="feather feather-paperclip font-small-3 align-middle me-0">
                                                        <path
                                                            d="M21.44 11.05l-9.19 9.19a6 6 0 0 1-8.49-8.49l9.19-9.19a4 4 0 0 1 5.66 5.66l-9.2 9.19a2 2 0 0 1-2.83-2.83l8.49-8.48">
                                                        </path>
                                                    </svg> 4b8bb17942201f9996709e8b610a0fd7.pdf</a></small>
                                            <footer class="blockquote-footer">Berkas LHP - 22 Desember 2022 | 22:26:50
                                            </footer>
                                        </blockquote> -->
                                    </div>
                                    <div id="hidden-lhp" class="hidden">
                                        <hr />
                                        <form id="form-aktifitas-lhp" action="javascript:void(0)">
                                            <div class="mb-1">
                                                <label for="judul_lhp" class="form-label">Judul LHP</label>
                                                <input class="form-control file-attachments" name="judul_lhp" type="text"
                                                    id="judul_lhp" required />
                                            </div>
                                            <div class="mb-1">
                                                <label for="tanggal_lhp" class="form-label">Tanggal LHP</label>
                                                <input class="form-control file-attachments" name="tanggal_lhp" type="date"
                                                    id="tanggal_lhp" required />
                                            </div>
                                            <div class="mb-1">
                                                <label for="attachments-lhp" class="form-label">Berkas LHP</label>
                                                <input class="form-control file-attachments" name="berkas_lhp" type="file"
                                                    id="attachments-lhp" required />
                                            </div>
                                            <div class="divider">
                                                <div class="divider-text">Aspek Temuan</div>
                                            </div>
                                            <div class="mb-1">
                                                <!-- <label for="attachments" class="form-label">Aspek Temuan</label> -->
                                                <select class="form-select select2" id="aspek"
                                                    name="aspek_temuan[]" multiple onchange="changeAspek();">
                                                    <option value="">-Pilih-</option>
                                                    <option value="Administrasi Kebijakan">Administrasi Kebijakan</option>
                                                    <option value="Administrasi Kelembagaan">Administrasi Kelembagaan</option>
                                                    <option value="Administrasi Pegawai">Administrasi Pegawai</option>
                                                    <option value="Administrasi Keuangan">Administrasi Keuangan</option>
                                                    <option value="Administrasi Barang">Administrasi Barang</option>
                                                    <option value="Urusan">Urusan</option>
                                                    <option value="Kinerja">Kinerja</option>
                                                    <option value="Sistem Pengendalian">Sistem Pengendalian</option>
                                                    <option value="Ekonomis Efisien Efektif">Ekonomis Efisien Efektif</option>
                                                    <option value="Kepatuhan">Kepatuhan</option>
                                                    <option value="Perencanaan">Perencanaan</option>
                                                    <option value="Pelaksanaan">Pelaksanaan</option>
                                                    <option value="Pelaporan">Pelaporan</option>
                                                </select>
                                            </div>
                                            <div id="aspek-kebijakan">
                                                <div class="divider">
                                                    <div class="divider-text">Administrasi Kebijakan</div>
                                                </div>
                                                <div class="mb-1">
                                                    <div class="row">
                                                        <div class="col-6">
                                                    <label for="" class="form-label">Jumlah Temuan</label>
                                                    <input class="form-control" name="jumlah_temuan[kebijakan]" type="text" required />
                                                        </div>
                                                        <div class="col-6">
                                                    <label for="" class="form-label">Jumlah Rekomendasi</label>
                                                    <input class="form-control" name="jumlah_rekomendasi[kebijakan]" type="text" required />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="aspek-kelembagaan">
                                                <div class="divider">
                                                    <div class="divider-text">Administrasi Kelembagaan</div>
                                                </div>
                                                <div class="mb-1">
                                                    <div class="row">
                                                        <div class="col-6">
                                                    <label for="" class="form-label">Jumlah Temuan</label>
                                                    <input class="form-control" name="jumlah_temuan[kelembagaan]" type="text" required />
                                                        </div>
                                                        <div class="col-6">
                                                    <label for="" class="form-label">Jumlah Rekomendasi</label>
                                                    <input class="form-control" name="jumlah_rekomendasi[kelembagaan]" type="text" required />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="aspek-pegawai">
                                                <div class="divider">
                                                    <div class="divider-text">Administrasi Pegawai</div>
                                                </div>
                                                <div class="mb-1">
                                                    <div class="row">
                                                        <div class="col-6">
                                                    <label for="" class="form-label">Jumlah Temuan</label>
                                                    <input class="form-control" name="jumlah_temuan[pegawai]" type="text" required />
                                                        </div>
                                                        <div class="col-6">
                                                    <label for="" class="form-label">Jumlah Rekomendasi</label>
                                                    <input class="form-control" name="jumlah_rekomendasi[pegawai]" type="text" required />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="aspek-keuangan">
                                                <div class="divider">
                                                    <div class="divider-text">Aspek Keuangan</div>
                                                </div>
                                                <div class="mb-1">
                                                    <div class="row">
                                                        <div class="col-6">
                                                    <label for="" class="form-label">Jumlah Temuan</label>
                                                    <input class="form-control" name="jumlah_temuan[keuangan]" type="text" required />
                                                        </div>
                                                        <div class="col-6">
                                                    <label for="" class="form-label">Jumlah Rekomendasi</label>
                                                    <input class="form-control" name="jumlah_rekomendasi[keuangan]" type="text" required />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mb-1">
                                                    <label for="jumlah_kerugian" class="form-label">Jumlah Kerugian</label>
                                                    <input class="form-control" name="jumlah_kerugian" type="number" step="0.01" id="jumlah_kerugian" />
                                                </div>
                                                <div class="mb-1">
                                                    <label for="disetor_kerugian" class="form-label">Kerugian Disetor/Ditarik</label>
                                                    <input class="form-control" name="disetor_kerugian" type="number" step="0.01" id="disetor_kerugian" />
                                                </div>
                                                <div class="mb-1">
                                                    <label for="jumlah_kewajiban" class="form-label">Jumlah Kewajiban</label>
                                                    <input class="form-control" name="jumlah_kewajiban" type="number" step="0.01" id="jumlah_kewajiban" />
                                                </div>
                                                <div class="mb-1">
                                                    <label for="disetor_kewajiban" class="form-label">Kewajiban Disetor/Ditarik</label>
                                                    <input class="form-control" name="disetor_kewajiban" type="number" step="0.01" id="disetor_kewajiban" />
                                                </div>
                                            </div>
                                            <div id="aspek-barang">
                                                <div class="divider">
                                                    <div class="divider-text">Administrasi Barang</div>
                                                </div>
                                                <div class="mb-1">
                                                    <div class="row">
                                                        <div class="col-6">
                                                    <label for="" class="form-label">Jumlah Temuan</label>
                                                    <input class="form-control" name="jumlah_temuan[barang]" type="text" required />
                                                        </div>
                                                        <div class="col-6">
                                                    <label for="" class="form-label">Jumlah Rekomendasi</label>
                                                    <input class="form-control" name="jumlah_rekomendasi[barang]" type="text" required />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="aspek-urusan">
                                                <div class="divider">
                                                    <div class="divider-text">Urusan</div>
                                                </div>
                                                <div class="mb-1">
                                                    <div class="row">
                                                        <div class="col-6">
                                                    <label for="" class="form-label">Jumlah Temuan</label>
                                                    <input class="form-control" name="jumlah_temuan[urusan]" type="text" required />
                                                        </div>
                                                        <div class="col-6">
                                                    <label for="" class="form-label">Jumlah Rekomendasi</label>
                                                    <input class="form-control" name="jumlah_rekomendasi[urusan]" type="text" required />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="aspek-kinerja">
                                                <div class="divider">
                                                    <div class="divider-text">Kinerja</div>
                                                </div>
                                                <div class="mb-1">
                                                    <div class="row">
                                                        <div class="col-6">
                                                    <label for="" class="form-label">Jumlah Temuan</label>
                                                    <input class="form-control" name="jumlah_temuan[kinerja]" type="text" required />
                                                        </div>
                                                        <div class="col-6">
                                                    <label for="" class="form-label">Jumlah Rekomendasi</label>
                                                    <input class="form-control" name="jumlah_rekomendasi[kinerja]" type="text" required />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="aspek-pengendalian">
                                                <div class="divider">
                                                    <div class="divider-text">Sistem Pengendalian</div>
                                                </div>
                                                <div class="mb-1">
                                                    <div class="row">
                                                        <div class="col-6">
                                                    <label for="" class="form-label">Jumlah Temuan</label>
                                                    <input class="form-control" name="jumlah_temuan[pengendalian]" type="text" required />
                                                        </div>
                                                        <div class="col-6">
                                                    <label for="" class="form-label">Jumlah Rekomendasi</label>
                                                    <input class="form-control" name="jumlah_rekomendasi[pengendalian]" type="text" required />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="aspek-3e">
                                                <div class="divider">
                                                    <div class="divider-text">Ekonomis Efisien Efektif</div>
                                                </div>
                                                <div class="mb-1">
                                                    <div class="row">
                                                        <div class="col-6">
                                                    <label for="" class="form-label">Jumlah Temuan</label>
                                                    <input class="form-control" name="jumlah_temuan[3e]" type="text" required />
                                                        </div>
                                                        <div class="col-6">
                                                    <label for="" class="form-label">Jumlah Rekomendasi</label>
                                                    <input class="form-control" name="jumlah_rekomendasi[3e]" type="text" required />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="aspek-kepatuhan">
                                                <div class="divider">
                                                    <div class="divider-text">Kepatuhan</div>
                                                </div>
                                                <div class="mb-1">
                                                    <div class="row">
                                                        <div class="col-6">
                                                    <label for="" class="form-label">Jumlah Temuan</label>
                                                    <input class="form-control" name="jumlah_temuan[kepatuhan]" type="text" required />
                                                        </div>
                                                        <div class="col-6">
                                                    <label for="" class="form-label">Jumlah Rekomendasi</label>
                                                    <input class="form-control" name="jumlah_rekomendasi[kepatuhan]" type="text" required />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="aspek-perencanaan">
                                                <div class="divider">
                                                    <div class="divider-text">Perencanaan</div>
                                                </div>
                                                <div class="mb-1">
                                                    <div class="row">
                                                        <div class="col-6">
                                                    <label for="" class="form-label">Jumlah Temuan</label>
                                                    <input class="form-control" name="jumlah_temuan[perencanaan]" type="text" required />
                                                        </div>
                                                        <div class="col-6">
                                                    <label for="" class="form-label">Jumlah Rekomendasi</label>
                                                    <input class="form-control" name="jumlah_rekomendasi[perencanaan]" type="text" required />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="aspek-pelaksanaan">
                                                <div class="divider">
                                                    <div class="divider-text">Pelaksanaan</div>
                                                </div>
                                                <div class="mb-1">
                                                    <div class="row">
                                                        <div class="col-6">
                                                    <label for="" class="form-label">Jumlah Temuan</label>
                                                    <input class="form-control" name="jumlah_temuan[pelaksanaan]" type="text" required />
                                                        </div>
                                                        <div class="col-6">
                                                    <label for="" class="form-label">Jumlah Rekomendasi</label>
                                                    <input class="form-control" name="jumlah_rekomendasi[pelaksanaan]" type="text" required />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="aspek-pelaporan">
                                                <div class="divider">
                                                    <div class="divider-text">Pelaporan</div>
                                                </div>
                                                <div class="mb-1">
                                                    <div class="row">
                                                        <div class="col-6">
                                                    <label for="" class="form-label">Jumlah Temuan</label>
                                                    <input class="form-control" name="jumlah_temuan[pelaporan]" type="text" required />
                                                        </div>
                                                        <div class="col-6">
                                                    <label for="" class="form-label">Jumlah Rekomendasi</label>
                                                    <input class="form-control" name="jumlah_rekomendasi[pelaporan]" type="text" required />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-1">
                                                <div class="d-flex flex-wrap">
                                                    <input type="hidden" id="board_idal" name="board_id"
                                                        class="form-control" placeholder="ID" />
                                                    <button id="btn-aktifitas-lhp" type="button"
                                                        class="btn btn-primary me-1">Upload LHP</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <hr />
                                    <section id="list-aktifitas-lhp">
                                        <!-- <div class="d-flex align-items-start mb-1">
                                            <div class="avatar my-0 ms-0 me-50">
                                                <img src="/data/foto/pegawai/user-default.png" alt="Avatar" height="32">
                                            </div>
                                            <div class="more-info w-100">
                                                <p class="mb-0">
                                                </p>
                                                <blockquote class="blockquote">
                                                    <footer class="blockquote-footer text-dark"><span
                                                            class="fw-bolder">Administrator</span> <span
                                                            class="text-primary">menyetujui</span> berkas LHP.
                                                    </footer>
                                                </blockquote>
                                                <p></p>

                                                <small class="text-muted">22 Desember 2022 | 22:26:50 </small>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-start mb-1">
                                            <div class="avatar my-0 ms-0 me-50">
                                                <img src="/data/foto/pegawai/user-default.png" alt="Avatar" height="32">
                                            </div>
                                            <div class="more-info">
                                                <p class="mb-0">
                                                    <span class="fw-bold">Administrator</span>
                                                </p>
                                                <blockquote class="blockquote ps-1 border-start-primary border-start-3">
                                                    <small><a
                                                            href="https://e-office.sumedangkab.go.id/data/auditor/kertas_kerja/attachment/4b8bb17942201f9996709e8b610a0fd7.pdf"
                                                            target="_blank"><svg width="24" height="24"
                                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                                stroke-width="2" stroke-linecap="round"
                                                                stroke-linejoin="round"
                                                                class="feather feather-paperclip font-small-3 align-middle me-0">
                                                                <path
                                                                    d="M21.44 11.05l-9.19 9.19a6 6 0 0 1-8.49-8.49l9.19-9.19a4 4 0 0 1 5.66 5.66l-9.2 9.19a2 2 0 0 1-2.83-2.83l8.49-8.48">
                                                                </path>
                                                            </svg> 4b8bb17942201f9996709e8b610a0fd7.pdf</a></small>
                                                    <footer class="blockquote-footer">mengupload berkas LHP.
                                                    </footer>
                                                </blockquote>
                                                <small class="text-muted">22 Desember 2022 | 22:30:12 </small>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-start mb-1">
                                            <div class="avatar my-0 ms-0 me-50">
                                                <img src="/data/foto/pegawai/user-default.png" alt="Avatar" height="32">
                                            </div>
                                            <div class="more-info w-100 ">
                                                <p class="mb-0">
                                                </p>
                                                <blockquote class="blockquote">
                                                    <footer class="blockquote-footer text-dark"><span
                                                            class="fw-bolder">Administrator</span> <span
                                                            class="text-danger">menolak</span> berkas LHP.
                                                    </footer>
                                                </blockquote>
                                                <blockquote class="blockquote ps-1 border-start-danger border-start-3">
                                                    <small>Tolong perbaiki lagi berkasnya.</small>
                                                </blockquote>
                                                <p></p>

                                                <small class="text-muted">22 Desember 2022 | 22:26:50 </small>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-start mb-1">
                                            <div class="avatar my-0 ms-0 me-50">
                                                <img src="/data/foto/pegawai/user-default.png" alt="Avatar" height="32">
                                            </div>
                                            <div class="more-info">
                                                <p class="mb-0">
                                                    <span class="fw-bold">Administrator</span>
                                                </p>
                                                <blockquote class="blockquote ps-1 border-start-primary border-start-3">
                                                    <small><a
                                                            href="https://e-office.sumedangkab.go.id/data/auditor/kertas_kerja/attachment/4b8bb17942201f9996709e8b610a0fd7.pdf"
                                                            target="_blank"><svg width="24" height="24"
                                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                                stroke-width="2" stroke-linecap="round"
                                                                stroke-linejoin="round"
                                                                class="feather feather-paperclip font-small-3 align-middle me-0">
                                                                <path
                                                                    d="M21.44 11.05l-9.19 9.19a6 6 0 0 1-8.49-8.49l9.19-9.19a4 4 0 0 1 5.66 5.66l-9.2 9.19a2 2 0 0 1-2.83-2.83l8.49-8.48">
                                                                </path>
                                                            </svg> 4b8bb17942201f9996709e8b610a0fd7.pdf</a></small>
                                                    <footer class="blockquote-footer">mengupload berkas LHP.
                                                    </footer>
                                                </blockquote>
                                                <small class="text-muted">22 Desember 2022 | 22:30:12 </small>
                                            </div>
                                        </div> -->
                                    </section>
                                </div>
                                <div class="tab-pane tab-pane-activity pb-1 fade" id="tab-activity" role="tabpanel">
                                    <form id="form-aktifitas" action="javascript:void(0)">
                                        <div class="mb-1">
                                            <label for="attachments" class="form-label">Berkas</label>
                                            <input class="form-control file-attachments" name="berkas_aktifitas"
                                                type="file" id="attachments" multiple />
                                        </div>
                                        <div class="mb-1">
                                            <label class="form-label">Aktifitas</label>
                                            <div class="comment-editor border-bottom-0" style="height:200px;"></div>
                                            <div class="d-flex justify-content-end comment-toolbar">
                                                <span class="ql-formats me-0">
                                                    <button class="ql-bold"></button>
                                                    <button class="ql-italic"></button>
                                                    <button class="ql-underline"></button>
                                                    <button class="ql-link"></button>
                                                    <button class="ql-image"></button>
                                                </span>
                                            </div>
                                            <textarea name="komentar_aktifitas" style="display:none"
                                                id="komentar_aktifitas"></textarea>
                                        </div>
                                        <div class="mb-1">
                                            <div class="d-flex flex-wrap">
                                                <input type="hidden" id="board_ida" name="board_id" class="form-control"
                                                    placeholder="ID" />
                                                <button id="btn-aktifitas" type="button"
                                                    class="btn btn-primary me-1">Tambahkan Komentar</button>
                                            </div>
                                        </div>
                                    </form>
                                    <hr />
                                    <section id="list-aktifitas">
                                        <!-- <div class="d-flex align-items-start mb-1">
                                            <div class="avatar bg-light-success my-0 ms-0 me-50">
                                                <span class="avatar-content">HJ</span>
                                            </div>
                                            <div class="more-info">
                                                <p class="mb-0"><span class="fw-bold">SUPENDI, SKM. M.Si</span>
                                                    Membuat Kertas Kerja.
                                                </p>
                                                <small class="text-muted">Today 11:00 AM</small>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-start mb-1">
                                            <div class="avatar my-0 ms-0 me-50">
                                                <img src="<?php echo base_url() . "asset/auditor/"; ?>app-assets/images/portrait/small/avatar-s-6.jpg"
                                                    alt="Avatar" height="32" />
                                            </div>
                                            <div class="more-info">
                                                <p class="mb-0">
                                                    <span class="fw-bold">AHMAD YUSUF PAMETA</span> menyebut <span
                                                        class="fw-bold text-primary">@supendi</span> dalam komentar.
                                                </p>
                                                <small class="text-muted">Today 10:20 AM</small>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-start mb-1">
                                            <div class="avatar my-0 ms-0 me-50">
                                                <img src="<?php echo base_url() . "asset/auditor/"; ?>app-assets/images/portrait/small/avatar-s-2.jpg"
                                                    alt="Avatar" height="32" />
                                            </div>
                                            <div class="more-info">
                                                <p class="mb-0">
                                                    <span class="fw-bold">SUPENDI, SKM. M.Si</span> memindahkan
                                                    Kertas Kerja menjadi Menunggu Pengkajian
                                                </p>
                                                <small class="text-muted">Today 10:00 AM</small>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-start mb-1">
                                            <div class="avatar my-0 ms-0 me-50">
                                                <img src="<?php echo base_url() . "asset/auditor/"; ?>app-assets/images/portrait/small/avatar-s-1.jpg"
                                                    alt="Avatar" height="32" />
                                            </div>
                                            <div class="more-info">
                                                <p class="mb-0"><span class="fw-bold">SUPENDI, SKM. M.Si</span>
                                                    Mengomentari Kertas Kerja.</p>
                                                <small class="text-muted">Today 8:32 AM</small>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-start mb-1">
                                            <div class="avatar bg-light-dark my-0 ms-0 me-50">
                                                <span class="avatar-content">BW</span>
                                            </div>
                                            <div class="more-info">
                                                <p class="mb-0"><span class="fw-bold">Bruce</span> was assigned task
                                                    of
                                                    code review.</p>
                                                <small class="text-muted">Today 8:30 PM</small>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-start mb-1">
                                            <div class="avatar bg-light-danger my-0 ms-0 me-50">
                                                <span class="avatar-content">CK</span>
                                            </div>
                                            <div class="more-info">
                                                <p class="mb-0">
                                                    <span class="fw-bold">Clark</span> assigned task UX Research to
                                                    <span class="fw-bold text-primary">@martian</span>
                                                </p>
                                                <small class="text-muted">Today 8:00 AM</small>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-start mb-1">
                                            <div class="avatar my-0 ms-0 me-50">
                                                <img src="<?php echo base_url() . "asset/auditor/"; ?>app-assets/images/portrait/small/avatar-s-4.jpg"
                                                    alt="Avatar" height="32" />
                                            </div>
                                            <div class="more-info">
                                                <p class="mb-0">
                                                    <span class="fw-bold">Ray</span> Added moved <span
                                                        class="fw-bold">Forms & Tables</span> task from
                                                    in progress to done.
                                                </p>
                                                <small class="text-muted">Today 7:45 AM</small>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-start mb-1">
                                            <div class="avatar my-0 ms-0 me-50">
                                                <img src="<?php echo base_url() . "asset/auditor/"; ?>app-assets/images/portrait/small/avatar-s-1.jpg"
                                                    alt="Avatar" height="32" />
                                            </div>
                                            <div class="more-info">
                                                <p class="mb-0"><span class="fw-bold">Barry</span> Complete all the
                                                    tasks assigned to him.</p>
                                                <small class="text-muted">Today 7:17 AM</small>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-start mb-1">
                                            <div class="avatar bg-light-success my-0 ms-0 me-50">
                                                <span class="avatar-content">HJ</span>
                                            </div>
                                            <div class="more-info">
                                                <p class="mb-0"><span class="fw-bold">Jordan</span> added task to
                                                    update
                                                    new images.</p>
                                                <small class="text-muted">Today 7:00 AM</small>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-start mb-1">
                                            <div class="avatar my-0 ms-0 me-50">
                                                <img src="<?php echo base_url() . "asset/auditor/"; ?>app-assets/images/portrait/small/avatar-s-6.jpg"
                                                    alt="Avatar" height="32" />
                                            </div>
                                            <div class="more-info">
                                                <p class="mb-0">
                                                    <span class="fw-bold">Dianna</span> moved task <span
                                                        class="fw-bold">FAQ UX</span> from in progress
                                                    to done board.
                                                </p>
                                                <small class="text-muted">Today 7:00 AM</small>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-start mb-1">
                                            <div class="avatar bg-light-danger my-0 ms-0 me-50">
                                                <span class="avatar-content">CK</span>
                                            </div>
                                            <div class="more-info">
                                                <p class="mb-0">
                                                    <span class="fw-bold">Clark</span> added new board with name
                                                    <span class="fw-bold">Done</span>.
                                                </p>
                                                <small class="text-muted">Yesterday 3:00 PM</small>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-start">
                                            <div class="avatar bg-light-dark my-0 ms-0 me-50">
                                                <span class="avatar-content">BW</span>
                                            </div>
                                            <div class="more-info">
                                                <p class="mb-0"><span class="fw-bold">Bruce</span> added new task in
                                                    progress board.</p>
                                                <small class="text-muted">Yesterday 12:00 PM</small>
                                            </div>
                                        </div> -->
                                    </section>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Kanban Sidebar ends -->
        </section>
        <!-- Kanban ends -->

    </div>
</div>
</div>
<!-- END: Content-->

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

<script src="<?php echo base_url() . "asset/auditor/"; ?>app-assets/js/scripts/pages/app-kanban.js"></script>
<script>
var autorefresh = false;
var id_member = "<?=($this->session->userdata('id_pegawai')) ? $this->session->userdata('id_pegawai') : 0 ?>";
var id_penugasan = "<?= $this->session->userdata('auditor_penugasan') ?>";
var list_pj = <?=json_encode($list_pj)?>;
var list_ppj = <?=json_encode($list_ppj)?>;
var list_pt = <?=json_encode($list_pt)?>;
var list_kt = <?=json_encode($list_kt)?>;
var list_at = <?=json_encode($list_at)?>;

function kanbanIsIdle() {
    autorefresh = setInterval(function() {
        $('.kanban-wrapper').html('');
        $.getScript('<?php echo base_url() . "asset/auditor/"; ?>app-assets/js/scripts/pages/app-kanban.js');
    }, 5000);
}

function changeAspek() {
    var list_aspek = {
        "kebijakan" : "Administrasi Kebijakan",
        "kelembagaan" : "Administrasi Kelembagaan",
        "pegawai" : "Administrasi Pegawai",
        "keuangan" : "Administrasi Keuangan",
        "barang" : "Administrasi Barang",
        "urusan" : "Urusan",
        "kinerja" : "Kinerja",
        "pengendalian" : "Sistem Pengendalian",
        "3e" : "Ekonomis Efisien Efektif",
        "kepatuhan" : "Kepatuhan",
        "perencanaan" : "Perencanaan",
        "pelaksanaan" : "Pelaksanaan",
        "pelaporan" : "Pelaporan"};

    var aspek = $('#aspek').val();
    Object.keys(list_aspek).forEach(k => {
        var el = $("#aspek-"+k);
        if (aspek.includes(list_aspek[k])) {
            el.removeClass("hidden");
        } else {
            el.addClass("hidden");
        }
    });
}

$(document).ready(function() {
    // kanbanIsIdle()
});
</script>


<script type="text/javascript">
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
                });
            }
            window.location.reload(true);
        },
    });
}
</script>