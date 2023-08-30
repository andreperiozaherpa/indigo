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
                        <h2 class="content-header-title float-start mb-0">Daftar PKPT</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="#">Home</a>
                                </li>
                                <li class="breadcrumb-item active">
                                    <a href="#">Daftar PKPT</a>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-header-right text-md-end col-md-3 col-12 d-md-block d-none">
                <div class="mb-1 breadcrumb-right">
                    <?php if($user_level == 'Administrator' or in_array('auditor', $user_privileges)){?>
                    <button data-bs-target="#addRoleModal" data-bs-toggle="modal" onclick="resetTim();addTim();"
                        class="btn btn-primary btn-round btn-sm mr-1" type="button"><i data-feather="plus"></i>
                        Tambah PKPT</button>
                        <?php } ?>
                    <button class="btn btn-outline-primary btn-round btn-sm" type="button">PKPT TAHUN 2023 <i
                            data-feather="chevron-down"></i></button>
                </div>
            </div>

            <!-- Add Role Modal -->
            <div class="modal fade" id="addRoleModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered modal-add-new-role">
                    <div class="modal-content">
                        <div class="modal-header bg-transparent">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body px-5 pb-5">
                            <div class="text-center mb-4">
                                <h1 class="role-title">PKPT</h1>
                            </div>
                            <!-- Add role form -->
                            <form id="addRoleForm" class="row" method="post" action="<?= base_url('auditor/pkpt') ?>">
                                <div class="col-12 mb-2">
                                    <label class="form-label" for="kode_sub_kegiatan">Sub Kegiatan</label>
                                    <select name="kode_sub_kegiatan" class="form-select select2" required>
                                        <option> - Pilih - </option>
                                        <?php foreach ($list_subkegiatan as $row) { ?>
                                        <option value="<?= $row->kode_sub_kegiatan ?>">
                                            <?= $row->kode_sub_kegiatan ?>
                                            <?= $row->nama_sub_kegiatan ?>
                                        </option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class=" col-12 mb-2">
                                    <label class="form-label" for="nama_aktifitas">Nama Aktifitas</label>
                                    <input type="text" name="nama_aktifitas" class="form-control"
                                        placeholder="Nama Aktifitas" required />
                                </div>
                                <div class="col-8 mb-2">
                                    <label class="form-label" for="jenis_pemeriksaan">Jenis Pemeriksaan</label>
                                    <select name="jenis_pemeriksaan" class="form-select" required>
                                        <option> - Pilih - </option>
                                        <option value="Audit Ketaatan">Audit Ketaatan</option>
                                        <option value="Audit Kinerja">Audit Kinerja</option>
                                        <option value="Audit Tujuan Tertentu">Audit Tujuan Tertentu</option>
                                        <option value="Evaluasi">Evaluasi</option>
                                        <option value="Layanan Konsultasi pada SIS">Layanan Konsultasi pada SIS</option>
                                        <option value="Monitoring dan Evaluasi">Monitoring dan Evaluasi</option>
                                        <option value="Permintaan Narasumber APIP dari SKPD">Permintaan Narasumber APIP dari SKPD</option>
                                        <option value="Probity Audit">Probity Audit</option>
                                        <option value="Reviu">Reviu</option>
                                        <option value="Saberpungli">Saberpungli</option>
                                        <option value="Tindak lanjut hasil temuan pengawasan">Tindak lanjut hasil temuan pengawasan</option>
                                    </select>
                                </div>
                                <div class="col-4 mb-2">
                                    <label class="form-label" for="jumlah_lhp">Jumlah LHP</label>
                                    <input type="number" name="jumlah_lhp" class="form-control" placeholder="0"
                                        required />
                                </div>
                                <div class="col-12 mb-2">
                                    <div id="susunan-tim-0" class="row hidden">
                                        <div class="divider divider-primary">
                                            <div class="divider-text">Susunan Tim <span
                                                    class="badge badge-light-primary rounded-pill"></span>
                                            </div>
                                            <input type="hidden" name="id_susunan[]" class="form-control" />
                                        </div>
                                        <div class="col-12 mb-2">
                                            <label class="form-label" for="nama_tim">Nama Tim</label>
                                            <button type="button"
                                                class="btn btn-sm btn-outline-danger float-end mb-25">Hapus
                                                Tim</button>
                                            <input type="text" name="nama_tim[]" class="form-control"
                                                placeholder="Nama Tim" required />
                                        </div>
                                        <div class="col-4 mb-2">
                                            <label class="form-label" for="jumlah_pj">Penanggung Jawab</label>
                                            <input type="number" name="jumlah_pj[]" class="form-control" placeholder="0"
                                                required />
                                        </div>
                                        <div class="col-4 mb-2">
                                            <label class="form-label" for="jumlah_ppj">Pembantu Penanggung Jawab</label>
                                            <input type="number" name="jumlah_ppj[]" class="form-control"
                                                placeholder="0" required />
                                        </div>
                                        <div class="col-4 mb-2">
                                            <label class="form-label" for="jumlah_pt">Pengendali Teknis</label>
                                            <input type="number" name="jumlah_pt[]" class="form-control" placeholder="0"
                                                required />
                                        </div>
                                        <div class="col-6 mb-2">
                                            <label class="form-label" for="jumlah_kt">Ketua Tim</label>
                                            <input type="number" name="jumlah_kt[]" class="form-control" placeholder="0"
                                                required />
                                        </div>
                                        <div class="col-6 mb-2">
                                            <label class="form-label" for="jumlah_at">Anggota Tim</label>
                                            <input type="number" name="jumlah_at[]" class="form-control" placeholder="0"
                                                required />
                                        </div>
                                        <div class="divider">
                                            <div class="divider-text">Jadwal Pelaksanaan</div>
                                        </div>
                                        <div class="col-6 mb-2">
                                            <label class="form-label" for="jadwal_rmp">RMP</label>
                                            <select name="jadwal_rmp[]" class="form-select select2-clone" required>
                                                <option> - Pilih - </option>
                                                <?php foreach ($list_week as $row) { ?>
                                                <option value="<?= $row->dateid ?>">
                                                    <?= bulan($row->month) ?> Minggu
                                                    ke-<?= $row->week_month ?>
                                                </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class=" col-6 mb-2">
                                            <label class="form-label" for="jadwal_rpl">RPL</label>
                                            <select name="jadwal_rpl[]" class="form-select select2-clone" required>
                                                <option> - Pilih - </option>
                                                <?php foreach ($list_week as $row) { ?>
                                                <option value="<?= $row->dateid ?>">
                                                    <?= bulan($row->month) ?> Minggu
                                                    ke-<?= $row->week_month ?>
                                                </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div id="daftar-tim" class="clearfix">
                                    </div>
                                </div>
                                <hr />
                                <div class="col-12 mb-2">
                                    <input type="hidden" name="id_pkpt">
                                    <button type="submit" id="submit-pkpt" class="btn btn-primary me-1">Simpan</button>
                                    <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal"
                                        aria-label="Close">
                                        Batal
                                    </button>
                                    <button type="button" class="btn btn-secondary ms-1 float-end"
                                        onclick="addTim();">Tambah Tim
                                        Lainnya</button>
                                </div>
                            </form>
                            <!--/ Add role form -->
                        </div>
                    </div>
                </div>
            </div>
            <!--/ Add Role Modal -->
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

                <?php foreach ($list_pkpt['sub_kegiatan'] as $num => $row) { ?>
                            <?php
                            $hidden_sub="hidden";
                             $count_sub = 0;
                                 foreach ($list_pkpt['pkpt'][$row->kode_sub_kegiatan] as $key => $value) {  if($user_level == 'Administrator' or in_array('auditor', $user_privileges) or $kepala_skpd == "Y" or count($list_penugasan[$row->kode_sub_kegiatan][$key]['detail']) > 0) { $count_sub++;}}
                                 if ($count_sub > 0) {
                                    $hidden_sub = "";
                                 }?>
                <!-- Role cards -->
                <div class="row my-1 <?=$hidden_sub?>">
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

                <div class="card <?=$hidden_sub?>">
                    <div class="card-body">
                        <div class="added-cards">
                            <?php foreach ($list_pkpt['pkpt'][$row->kode_sub_kegiatan] as $key => $value) { ?>
                                <?php if($user_level == 'Administrator' or in_array('auditor', $user_privileges) or $kepala_skpd == "Y" or count($list_penugasan[$row->kode_sub_kegiatan][$key]['detail']) > 0) {?>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="cardMaster rounded border p-2 mb-1">
                                        <div class="d-flex justify-content-between flex-sm-row flex-column">
                                            <div class="card-information">
                                                <h6>
                                                    <?= $value->nama_aktifitas ?>
                                                </h6>
                                                <h6 class="badge badge-light-primary mt-50">
                                                    <?= $value->jenis_pemeriksaan ?>
                                                </h6>
                                            </div>
                                            <div class="d-flex flex-column text-start text-lg-end">
                                                <span class="mb-50">Jumlah LHP
                                                    <button type="button"
                                                        class="btn btn-icon btn-outline-primary btn-sm">
                                                        <?= $value->jumlah_lhp ?>
                                                    </button>
                                                </span>
                                                <div class="d-flex order-sm-0 order-1 mt-1 mt-sm-0">
                                                    <?php if($user_level == 'Administrator' or $kepala_skpd == "Y" or count($list_penugasan[$row->kode_sub_kegiatan][$key]['detail']) > 0) {?>
                                                    <a href="<?= base_url('auditor/pkpt_penugasan/' . encode($value->id_pkpt)) ?>"
                                                        class="btn btn-primary btn-sm waves-effect">
                                                        Daftar Penugasan
                                                    </a>
                                                    <?php }?>
                                                    <?php if($user_level == 'Administrator' or in_array('auditor', $user_privileges)){?>
                                                    <button data-bs-target="#addRoleModal" data-bs-toggle="modal"
                                                        onclick="editTim('<?= $row->kode_sub_kegiatan ?>','<?= $key ?>');"
                                                        class="btn btn-outline-primary btn-sm ms-75 me-75 waves-effect">
                                                        Ubah
                                                    </button>
                                                    <button class="btn btn-outline-secondary btn-sm waves-effect"
                                                        onclick="deletePKPT('<?= encode($value->id_pkpt) ?>')">Hapus</button>
                                                        <?php } ?>
                                                </div>
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
                                                            foreach ($list_pkpt['susunan'][$row->kode_sub_kegiatan][$key] as $list) {
                                                                if ($minggu['dateid'] == $list->jadwal_rmp) {
                                                                    $aclass[] = "table-primary";
                                                                    $jadwal_rmp[] = $list->nama_tim;
                                                                }
                                                                if ($minggu['dateid'] == $list->jadwal_rpl) {
                                                                    $aclass[] = "table-primary";
                                                                    $jadwal_rpl[] = $list->nama_tim;
                                                                }
                                                            }
                                                            foreach ($list_penugasan[$row->kode_sub_kegiatan][$key]['detail'] as $k => $list) {
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

                                                                foreach ($list_penugasan[$row->kode_sub_kegiatan][$key]['nhp'][$k] as $list_nhp) {
                                                                    if ($list_nhp->status_nhp == "P" and in_array($list_nhp->tanggal_nhp, explode(',', $minggu['list_date']))) {
                                                                        $aclass[] = "table-warning";
                                                                        $jadwal_verifikasinhp[] = (strlen($list->nama_penugasan) > 30) ? substr($list->nama_penugasan, 0, 30) . '...' : $list->nama_penugasan;
                                                                    }
                                                                    if ($list_nhp->status_nhp == "N" and in_array($list_nhp->tanggal_nhp, explode(',', $minggu['list_date']))) {
                                                                        $aclass[] = "table-danger";
                                                                        $jadwal_tolaknhp[] = (strlen($list->nama_penugasan) > 30) ? substr($list->nama_penugasan, 0, 30) . '...' : $list->nama_penugasan;
                                                                    }
                                                                }

                                                                foreach ($list_penugasan[$row->kode_sub_kegiatan][$key]['lhp'][$k] as $list_lhp) {
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
                                        class="col-12 d-flex justify-content-around flex-sm-row flex-column mt-50 mb-1 table-responsive">
                                        <?php foreach ($list_pkpt['susunan'][$row->kode_sub_kegiatan][$key] as $list) { ?>
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
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <!--/ Role cards -->
                <?php } ?>

            </div>

        </div>

        <section class="faq-contact">
            <div class="row mt-5 pt-75 justify-content-md-end">
                <div class="col-md-6">
                    <div class="card text-center faq-contact-card shadow-none py-1">
                        <a data-action="collapse" class="divider divider-primary text-primary fw-bolder mb-0">
                            <div class="divider-text">LEGENDA</div>
                        </a>
                        <div class="card-header justify-content-center p-0">
                            <div class="heading-elements">
                                <ul class="list-inline mb-0 text-primary">
                                    <li>
                                        <a data-action="collapse"><i data-feather="chevron-down"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-content collapse show">
                            <div class="card-body text-start">
                                <div class="row mt-2">
                                    <div class="col-md-4">
                                        <dl class="row">
                                            <dt class="col-sm-3">
                                                <div class="avatar avatar-sm bg-light-primary">
                                                    <div class="avatar-content"></div>
                                                </div>
                                            </dt>
                                            <dd class="col-sm-9">Penanggung Jawab</dd>
                                        </dl>
                                        <dl class="row">
                                            <dt class="col-sm-3">
                                                <div class="avatar avatar-sm bg-primary">
                                                    <div class="avatar-content"></div>
                                                </div>
                                            </dt>
                                            <dd class="col-sm-9">Pembantu Penanggung Jawab</dd>
                                        </dl>
                                        <dl class="row">
                                            <dt class="col-sm-3">
                                                <div class="avatar avatar-sm bg-info">
                                                    <div class="avatar-content"></div>
                                                </div>
                                            </dt>
                                            <dd class="col-sm-9">Pengendali Teknis</dd>
                                        </dl>
                                        <dl class="row">
                                            <dt class="col-sm-3">
                                                <div class="avatar avatar-sm bg-light-success">
                                                    <div class="avatar-content"></div>
                                                </div>
                                            </dt>
                                            <dd class="col-sm-9">Ketua Tim</dd>
                                        </dl>
                                        <dl class="row">
                                            <dt class="col-sm-3">
                                                <div class="avatar avatar-sm bg-success">
                                                    <div class="avatar-content"></div>
                                                </div>
                                            </dt>
                                            <dd class="col-sm-9">Anggota Tim</dd>
                                        </dl>
                                    </div>
                                    <div class="col-md-4">
                                        <dl class="row">
                                            <dt class="col-sm-3">
                                                <table class="table table-bordered text-center jadwal"
                                                    style="width:13px; height:40px;">
                                                    <tbody>
                                                        <tr>
                                                            <td></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </dt>
                                            <dd class="col-sm-9">Tidak ada jadwal</dd>
                                        </dl>
                                        <dl class="row">
                                            <dt class="col-sm-3">
                                                <table class="table table-bordered text-center jadwal"
                                                    style="width:13px; height:40px;">
                                                    <tbody>
                                                        <tr>
                                                            <td>1</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </dt>
                                            <dd class="col-sm-9">Minggu ke-1</dd>
                                        </dl>
                                        <dl class="row">
                                            <dt class="col-sm-3">
                                                <table class="table table-bordered text-center jadwal"
                                                    style="width:13px; height:40px;">
                                                    <tbody>
                                                        <tr>
                                                            <td>2</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </dt>
                                            <dd class="col-sm-9">Minggu ke-2</dd>
                                        </dl>
                                        <dl class="row">
                                            <dt class="col-sm-3">
                                                <table class="table table-bordered text-center jadwal"
                                                    style="width:13px; height:40px;">
                                                    <tbody>
                                                        <tr>
                                                            <td>3</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </dt>
                                            <dd class="col-sm-9">Minggu ke-3</dd>
                                        </dl>
                                        <dl class="row">
                                            <dt class="col-sm-3">
                                                <table class="table table-bordered text-center jadwal"
                                                    style="width:13px; height:40px;">
                                                    <tbody>
                                                        <tr>
                                                            <td>4</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </dt>
                                            <dd class="col-sm-9">Minggu ke-4</dd>
                                        </dl>
                                        <dl class="row">
                                            <dt class="col-sm-3">
                                                <table class="table table-bordered text-center jadwal"
                                                    style="width:13px; height:40px;">
                                                    <tbody>
                                                        <tr>
                                                            <td>5</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </dt>
                                            <dd class="col-sm-9">Minggu ke-5</dd>
                                        </dl>
                                    </div>
                                    <div class="col-md-4">
                                        <dl class="row">
                                            <dt class="col-sm-3">
                                                <table class="table table-bordered text-center jadwal"
                                                    style="width:13px; height:40px;">
                                                    <tbody>
                                                        <tr>
                                                            <td class="table-warning"></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </dt>
                                            <dd class="col-sm-9">Jadwal perlu tindakan</dd>
                                        </dl>
                                        <dl class="row">
                                            <dt class="col-sm-3">
                                                <table class="table table-bordered text-center jadwal"
                                                    style="width:13px; height:40px;">
                                                    <tbody>
                                                        <tr>
                                                            <td class="table-danger"></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </dt>
                                            <dd class="col-sm-9">Jadwal peringatan</dd>
                                        </dl>
                                        <dl class="row">
                                            <dt class="col-sm-3">
                                                <table class="table table-bordered text-center jadwal"
                                                    style="width:13px; height:40px;">
                                                    <tbody>
                                                        <tr>
                                                            <td class="table-success"></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </dt>
                                            <dd class="col-sm-9">Jadwal capaian</dd>
                                        </dl>
                                        <dl class="row">
                                            <dt class="col-sm-3">
                                                <table class="table table-bordered text-center jadwal"
                                                    style="width:13px; height:40px;">
                                                    <tbody>
                                                        <tr>
                                                            <td class="table-primary"></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </dt>
                                            <dd class="col-sm-9">Jadwal penting</dd>
                                        </dl>
                                        <dl class="row">
                                            <dt class="col-sm-3">
                                                <table class="table table-bordered text-center jadwal"
                                                    style="width:13px; height:40px;">
                                                    <tbody>
                                                        <tr>
                                                            <td class="table-light"></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </dt>
                                            <dd class="col-sm-9">Jadwal biasa</dd>
                                        </dl>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
<!-- END: Content-->


<script type="text/javascript">
var list_pkpt = <?= json_encode($list_pkpt) ?>;
var tim, curr_tim = 1;

function resetTim() {
    tim = 1;
    $("select[name=kode_sub_kegiatan]").val("").trigger(
        "change");
    $("#daftar-tim").html("");
}

function addTim() {
    $("#susunan-tim-0").clone().removeClass("hidden").attr("id", "susunan-tim-" + tim).appendTo("#daftar-tim");
    $("#susunan-tim-" + tim).children("div").children("div").children("span").html(tim);
    $("#susunan-tim-" + tim).children("div").children("button").attr("onclick", "deleteTim('" + tim + "')");
    $("#susunan-tim-" + tim).children("div").children(".select2-clone").removeClass("select2-clone").addClass(
        "select2-cloned").select2();
    // $(".select2").select2("destroy");
    // $(".select2").select2();
    tim++;
}

function deleteTim(tim) {
    $("#susunan-tim-" + tim).remove();
}

function editTim(kode_sub_kegiatan, pkpt) {
    resetTim();
    $("input[name=id_pkpt]").val(list_pkpt.pkpt[kode_sub_kegiatan][pkpt].id_pkpt);
    $("select[name=kode_sub_kegiatan]").val(list_pkpt.pkpt[kode_sub_kegiatan][pkpt].kode_sub_kegiatan).trigger(
        "change");
    $("input[name=nama_aktifitas]").val(list_pkpt.pkpt[kode_sub_kegiatan][pkpt].nama_aktifitas);
    $("select[name=jenis_pemeriksaan]").val(list_pkpt.pkpt[kode_sub_kegiatan][pkpt].jenis_pemeriksaan).trigger(
        "change");
    $("input[name=jumlah_lhp]").val(list_pkpt.pkpt[kode_sub_kegiatan][pkpt].jumlah_lhp);
    list_pkpt.susunan[kode_sub_kegiatan][pkpt].forEach(susunan => {
        curr_tim = tim;
        addTim();
        $("#susunan-tim-" + curr_tim).children("div").children("input[name^=id_susunan]").val(susunan
            .id_susunan);
        $("#susunan-tim-" + curr_tim).children("div").children("input[name^=nama_tim]").val(susunan.nama_tim);
        $("#susunan-tim-" + curr_tim).children("div").children("input[name^=jumlah_pj]").val(susunan.jumlah_pj);
        $("#susunan-tim-" + curr_tim).children("div").children("input[name^=jumlah_ppj]").val(susunan
            .jumlah_ppj);
        $("#susunan-tim-" + curr_tim).children("div").children("input[name^=jumlah_pt]").val(susunan.jumlah_pt);
        $("#susunan-tim-" + curr_tim).children("div").children("input[name^=jumlah_kt]").val(susunan.jumlah_kt);
        $("#susunan-tim-" + curr_tim).children("div").children("input[name^=jumlah_at]").val(susunan.jumlah_at);
        $("#susunan-tim-" + curr_tim).children("div").children("select[name^=jadwal_rmp]").val(susunan
            .jadwal_rmp).trigger(
            "change");
        $("#susunan-tim-" + curr_tim).children("div").children("select[name^=jadwal_rpl]").val(susunan
            .jadwal_rpl).trigger(
            "change");
    });
    document.querySelector('#addRoleModal div div').scrollIntoView({ behavior: 'smooth' });
}

function deletePKPT(id) {
    Swal.fire({
        title: "Hapus Objek Pemeriksaan?",
        text: "Data yang dihapus tidak bisa dikembalikan!",
        icon: "warning",
        showCancelButton: !0,
        confirmButtonText: "Ya, Hapus!",
        customClass: {
            confirmButton: "btn btn-danger",
            cancelButton: "btn btn-outline-danger ms-1",
        },
        buttonsStyling: !1,
    }).then(function(t) {
        t.value &&
            $.ajax({
                url: "<?= base_url() ?>auditor/delete_objek_pemeriksaan",
                type: "post",
                enctype: "multipart/form-data",
                data: {
                    id: id
                },
                // dataType: 'JSON',
                // processData: false,
                // contentType: false,
                cache: false,
                success: function(data) {
                    data = JSON.parse(data);
                    Swal.fire({
                        icon: "success",
                        title: "Deleted!",
                        text: "Objek Pemeriksaan Telah Dihapus. \n" + data.error_msg,
                        customClass: {
                            confirmButton: "btn btn-success",
                        },
                    }).then(function() {
                        window.location.reload(true);
                    });
                },
            });
    });
}
</script>