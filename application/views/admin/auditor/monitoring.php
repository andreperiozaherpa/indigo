<base href="<?= base_url() ?>" target="_parent">

<!-- BEGIN: Content-->
<div class="app-content content ecommerce-application">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-start mb-0">Daftar Temuan</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="#">Home</a>
                                </li>
                                <li class="breadcrumb-item active">
                                    <a href="#">Daftar Temuan</a>
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
                    <div class="col-lg-3 col-sm-6">
                        <div class="card">
                            <div class="card-body d-flex align-items-center justify-content-between">
                                <div>
                                    <h3 class="fw-bolder mb-75">4</h3>
                                    <span>Total Temuan</span>
                                </div>
                                <div class="avatar bg-light-primary p-50">
                                    <span class="avatar-content">
                                        <i data-feather="user" class="font-medium-4"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="card">
                            <div class="card-body d-flex align-items-center justify-content-between">
                                <div>
                                    <h3 class="fw-bolder mb-75">4</h3>
                                    <span>Temuan dalam Persiapan</span>
                                </div>
                                <div class="avatar bg-light-danger p-50">
                                    <span class="avatar-content">
                                        <i data-feather="user-plus" class="font-medium-4"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="card">
                            <div class="card-body d-flex align-items-center justify-content-between">
                                <div>
                                    <h3 class="fw-bolder mb-75">0</h3>
                                    <span>Temuan dalam Proses</span>
                                </div>
                                <div class="avatar bg-light-warning p-50">
                                    <span class="avatar-content">
                                        <i data-feather="user-x" class="font-medium-4"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="card">
                            <div class="card-body d-flex align-items-center justify-content-between">
                                <div>
                                    <h3 class="fw-bolder mb-75">0</h3>
                                    <span>Temuan Selesai</span>
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

            <!-- Collapsible and Refresh Actions -->
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Pencarian Lanjutan</h4>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <li>
                                    <a data-action="collapse"><i data-feather="chevron-down"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-content collapse">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-xl-4 col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="basicInput">Nomor SP</label>
                                        <input type="text" class="form-control" id="basicInput"
                                            placeholder="Masukkan Nomor SP" />
                                    </div>
                                </div>
                                <div class="col-xl-4 col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="helpInputTop">Nama Temuan</label>
                                        <input type="text" class="form-control" id="helpInputTop" />
                                    </div>
                                </div>
                                <div class="col-xl-4 col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="disabledInput">Anggota</label>
                                        <input type="text" class="form-control" id="disabledInput" />
                                    </div>
                                </div>
                                <div class="col-xl-4 col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="helperText">Tanggal Temuan</label>
                                        <input type="date" id="helperText" class="form-control" placeholder="Name" />
                                    </div>
                                </div>
                                <div class="col-xl-4 col-md-6 col-12 mb-1 mb-md-0">
                                    <label class="form-label" for="disabledInput">Tanggal Temuan</label>
                                    <input type="date" class="form-control" id="readonlyInput" />
                                </div>
                                <div class="col-xl-4 col-md-6 col-12">
                                    <label class="form-label" for="disabledInput">Status</label>
                                    <input type="text" id="helperText2" class="form-control" placeholder="Name" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--/ Collapsible and Refresh Actions -->


            <div class="col-sm-12">

                <!-- Role cards -->
                <div class="row">

                    <!-- Profile Card -->
                    <div class="col-xl-4 col-lg-6 col-md-6">
                        <div class="card bg-success text-white">
                            <div class="card-body text-center">
                                <h3 class="text-white"><i data-feather="alert-circle" class="font-medium-5"></i>
                                    Observasi</h3>
                                <h6 class="text-white">Tidak melanggar dokumentasi sistem manajemen yang telah
                                    ditetapkan. Saran untuk peningkatan.</h6>
                                <!-- <span class="badge badge-light-primary profile-badge">Pro Level</span> -->
                                <hr class="mb-2" />
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="text-white fw-bolder">Persiapan</h6>
                                        <h3 class="text-white mb-0">-</h3>
                                    </div>
                                    <div>
                                        <h6 class="text-white fw-bolder">Proses</h6>
                                        <h3 class="text-white mb-0">-</h3>
                                    </div>
                                    <div>
                                        <h6 class="text-white fw-bolder">Selesai</h6>
                                        <h3 class="text-white mb-0">-</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/ Profile Card -->

                    <!-- Profile Card -->
                    <div class="col-xl-4 col-lg-6 col-md-6">
                        <div class="card bg-warning text-white">
                            <div class="card-body text-center">
                                <h3 class="text-white"><i data-feather="alert-triangle" class="font-medium-5"></i>
                                    Ketidaksesuaian Minor</h3>
                                <h6 class="text-white">Tidak mempunyai dampak serius terhadap mutu, lingkungan dan K3
                                    atau sistemnya.</h6>
                                <!-- <span class="badge badge-light-primary profile-badge">Pro Level</span> -->
                                <hr class="mb-2" />
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="text-white fw-bolder">Persiapan</h6>
                                        <h3 class="text-white mb-0">-</h3>
                                    </div>
                                    <div>
                                        <h6 class="text-white fw-bolder">Proses</h6>
                                        <h3 class="text-white mb-0">-</h3>
                                    </div>
                                    <div>
                                        <h6 class="text-white fw-bolder">Selesai</h6>
                                        <h3 class="text-white mb-0">-</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/ Profile Card -->

                    <!-- Profile Card -->
                    <div class="col-xl-4 col-lg-6 col-md-6">
                        <div class="card bg-danger text-white">
                            <div class="card-body text-center">
                                <h3 class="text-white"><i data-feather="alert-octagon" class="font-medium-5"></i>
                                    Ketidaksesuaian Mayor</h3>
                                <h6 class="text-white">Berdampak yang serius terhadap pencapaian mutu atau efektivitas
                                    sistem mutu.</h6>
                                <!-- <span class="badge badge-light-primary profile-badge">Pro Level</span> -->
                                <hr class="mb-2" />
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="text-white fw-bolder">Persiapan</h6>
                                        <h3 class="text-white mb-0">-</h3>
                                    </div>
                                    <div>
                                        <h6 class="text-white fw-bolder">Proses</h6>
                                        <h3 class="text-white mb-0">-</h3>
                                    </div>
                                    <div>
                                        <h6 class="text-white fw-bolder">Selesai</h6>
                                        <h3 class="text-white mb-0">-</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/ Profile Card -->

                    <div class="col-xl-4 col-lg-6 col-md-6">
                        <?php foreach ($list_temuan[1]['detail'] as $key => $row) { ?>
                        <div class="card">
                            <div class="card-header align-self-center">SEKRETARIAT DAERAH</div>
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <span class="badge bg-primary"><?= $row->status_temuan ?></span>
                                    <ul class="list-unstyled d-flex align-items-center avatar-group mb-0">
                                        <?php foreach ($list_temuan[1]['anggota'][$key] as $value) { ?>
                                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                            title="<?= $value->nama_lengkap ?>" class="avatar avatar-sm pull-up">
                                            <img class="rounded-circle"
                                                src="<?php echo base_url() . "data/foto/pegawai/" . $value->foto_pegawai; ?>"
                                                alt="Avatar" />
                                        </li>
                                        <?php } ?>
                                    </ul>
                                </div>
                                <div class="d-flex justify-content-between align-items-end mt-1 pt-25">
                                    <div class="role-heading">
                                        <h4 class="fw-bolder"><?= $row->nama_temuan ?></h4>
                                        <span><?= tanggal($row->tanggal_temuan) ?></span>
                                    </div>
                                    <a href="<?= base_url('auditor/kertas_kerja/' . encode($row->id_temuan)) ?>"
                                        class="text-body"><i data-feather="book" class="font-medium-5"></i> Detail</a>
                                </div>
                            </div>
                            <div class="card-footer d-flex justify-content-between">
                                <div>
                                    <a href="<?= base_url('data/auditor/template/template_laporan_kerja_audit.pdf') ?>"
                                        target="_blank" class="text-body"><i data-feather="archive"
                                            class="font-medium-5"></i> Unduh Report</a>
                                </div>
                                <div>
                                    <a href="#" class="text-body" data-bs-toggle="modal" data-bs-target="#addNewCard"
                                        onclick="change_klasifikasi(<?= $row->klasifikasi ?>,'<?= encode($row->id_temuan) ?>')"><i
                                            data-feather="sliders" class="font-medium-5"></i>
                                        Ubah Klasifikasi</a>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                    <div class="col-xl-4 col-lg-6 col-md-6">
                        <?php foreach ($list_temuan[2]['detail'] as $key => $row) { ?>
                        <div class="card">
                            <div class="card-header align-self-center">SEKRETARIAT DAERAH</div>
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <span class="badge bg-primary"><?= $row->status_temuan ?></span>
                                    <ul class="list-unstyled d-flex align-items-center avatar-group mb-0">
                                        <?php foreach ($list_temuan[2]['anggota'][$key] as $value) { ?>
                                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                            title="<?= $value->nama_lengkap ?>" class="avatar avatar-sm pull-up">
                                            <img class="rounded-circle"
                                                src="<?php echo base_url() . "data/foto/pegawai/" . $value->foto_pegawai; ?>"
                                                alt="Avatar" />
                                        </li>
                                        <?php } ?>
                                    </ul>
                                </div>
                                <div class="d-flex justify-content-between align-items-end mt-1 pt-25">
                                    <div class="role-heading">
                                        <h4 class="fw-bolder"><?= $row->nama_temuan ?></h4>
                                        <span><?= tanggal($row->tanggal_temuan) ?></span>
                                    </div>
                                    <a href="<?= base_url('auditor/kertas_kerja/' . encode($row->id_temuan)) ?>"
                                        class="text-body"><i data-feather="book" class="font-medium-5"></i> Detail</a>
                                </div>
                            </div>
                            <div class="card-footer d-flex justify-content-between">
                                <div>
                                    <a href="<?= base_url('data/auditor/template/template_laporan_kerja_audit.pdf') ?>"
                                        target="_blank" class="text-body"><i data-feather="archive"
                                            class="font-medium-5"></i> Unduh Report</a>
                                </div>
                                <div>
                                    <a href="#" class="text-body" data-bs-toggle="modal" data-bs-target="#addNewCard"
                                        onclick="change_klasifikasi(<?= $row->klasifikasi ?>,'<?= encode($row->id_temuan) ?>')"><i
                                            data-feather="sliders" class="font-medium-5"></i>
                                        Ubah Klasifikasi</a>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                    <div class="col-xl-4 col-lg-6 col-md-6">
                        <?php foreach ($list_temuan[3]['detail'] as $key => $row) { ?>
                        <div class="card">
                            <div class="card-header align-self-center">SEKRETARIAT DAERAH</div>
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <span class="badge bg-primary"><?= $row->status_temuan ?></span>
                                    <ul class="list-unstyled d-flex align-items-center avatar-group mb-0">
                                        <?php foreach ($list_temuan[3]['anggota'][$key] as $value) { ?>
                                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                            title="<?= $value->nama_lengkap ?>" class="avatar avatar-sm pull-up">
                                            <img class="rounded-circle"
                                                src="<?php echo base_url() . "data/foto/pegawai/" . $value->foto_pegawai; ?>"
                                                alt="Avatar" />
                                        </li>
                                        <?php } ?>
                                    </ul>
                                </div>
                                <div class="d-flex justify-content-between align-items-end mt-1 pt-25">
                                    <div class="role-heading">
                                        <h4 class="fw-bolder"><?= $row->nama_temuan ?></h4>
                                        <span><?= tanggal($row->tanggal_temuan) ?></span>
                                    </div>
                                    <a href="<?= base_url('auditor/kertas_kerja/' . encode($row->id_temuan)) ?>"
                                        class="text-body"><i data-feather="book" class="font-medium-5"></i> Detail</a>
                                </div>
                            </div>
                            <div class="card-footer d-flex justify-content-between">
                                <div>
                                    <a href="<?= base_url('data/auditor/template/template_laporan_kerja_audit.pdf') ?>"
                                        target="_blank" class="text-body"><i data-feather="archive"
                                            class="font-medium-5"></i> Unduh Report</a>
                                </div>
                                <div>
                                    <a href="#" class="text-body" data-bs-toggle="modal" data-bs-target="#addNewCard"
                                        onclick="change_klasifikasi(<?= $row->klasifikasi ?>,'<?= encode($row->id_temuan) ?>')"><i
                                            data-feather="sliders" class="font-medium-5"></i>
                                        Ubah Klasifikasi</a>
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

                    <div class="col-4">
                        <button type="button" id="btn-klas-1" onclick="change_klasifikasi(1)"
                            class="btn btn-outline-success waves-effect form-control text-center pe-25 ps-25">
                            <p><i data-feather="alert-circle" class="font-medium-5"></i></p>
                            <small>Observasi
                                &#10;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</small>
                        </button>
                    </div>
                    <div class="col-4">
                        <button type="button" id="btn-klas-2" onclick="change_klasifikasi(2)"
                            class="btn btn-warning waves-effect form-control text-center pe-25 ps-25">
                            <p><i data-feather="alert-triangle" class="font-medium-5"></i></p><small>Ketidaksesuaian
                                Minor</small>
                        </button>
                    </div>
                    <div class="col-4">
                        <button type="button" id="btn-klas-3" onclick="change_klasifikasi(3)"
                            class="btn btn-outline-danger waves-effect form-control text-center pe-25 ps-25">
                            <p><i data-feather="alert-octagon" class="font-medium-5"></i></p> <small>Ketidaksesuaian
                                Mayor</small>
                        </button>
                    </div>


                    <div class="col-12 text-center">
                        <input type="hidden" id="klas-id" name="id_temuan" required>
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


<script type="text/javascript">
select_status_verifikasi();

function select_status_verifikasi() {
    var selected = $('#select-status').val();
    if (selected == 0) {
        $('#search-form').attr("action", "<?= base_url($this->router->fetch_class() . "/cari"); ?>");
    } else if (selected == 1) {
        $('#search-form').attr("action", "<?= base_url($this->router->fetch_class() . "/index"); ?>");
    }
}

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
</script>