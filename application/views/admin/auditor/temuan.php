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
                    <div class="col-xl-4 col-lg-6 col-md-6">
                        <div class="card">
                            <div class="row">
                                <div class="col-sm-5">
                                    <div class="d-flex align-items-end justify-content-center h-100">
                                        <img src="<?php echo base_url() . "asset/auditor/"; ?>app-assets/images/illustration/faq-illustrations.svg"
                                            class="img-fluid mt-2" alt="Image" width="85" />
                                    </div>
                                </div>
                                <div class="col-sm-7">
                                    <div class="card-body text-sm-end text-center ps-sm-0">
                                        <a href="javascript:void(0)" data-bs-target="#addRoleModal"
                                            data-bs-toggle="modal" class="stretched-link text-nowrap add-new-role">
                                            <span class="btn btn-primary mt-1">Tambah Temuan</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php foreach ($list_temuan['detail'] as $key => $row) { ?>
                    <div class="col-xl-4 col-lg-6 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <span class="badge bg-primary"><?= $row->status_temuan ?></span>
                                    <a href="javascript:;" class="role-edit-modal" data-bs-toggle="modal"
                                        data-bs-target="#addRoleModal">
                                        <small class="fw-bolder"><i data-feather='edit-3'></i> Ubah Temuan</small>
                                    </a>
                                    <ul class="list-unstyled d-flex align-items-center avatar-group mb-0">
                                        <?php foreach ($list_temuan['anggota'][$key] as $value) { ?>
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
                        </div>
                    </div>
                    <?php } ?>
                </div>
                <!--/ Role cards -->

                <!-- Add Role Modal -->
                <div class="modal fade" id="addRoleModal" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered modal-add-new-role">
                        <div class="modal-content">
                            <div class="modal-header bg-transparent">
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body px-5 pb-5">
                                <div class="text-center mb-4">
                                    <h1 class="role-title">Tambah Temuan</h1>
                                    <p>Temuan dibuat berdasarkan SP dari E-office</p>
                                </div>
                                <!-- Add role form -->
                                <form id="addRoleForm" class="row" method="post"
                                    action="<?= base_url('auditor/temuan') ?>">
                                    <div class="col-12 mb-2">
                                        <label class="form-label" for="id_surat">Pilih Surat Perintah</label>
                                        <select name="id_surat" class="form-select select2">
                                            <option> - Pilih - </option>
                                            <?php foreach ($list_sp as $row) { ?>
                                            <option value="<?= $row->id_surat_keluar ?>"><?= $row->nomer_surat ?>
                                            </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-12 mb-2">
                                        <label class="form-label" for="tanggal_temuan">Tanggal Temuan</label>
                                        <input type="date" name="tanggal_temuan" class="form-control"
                                            placeholder="Tanggal Temuan" />
                                    </div>
                                    <div class="col-12 mb-2">
                                        <label class="form-label" for="nama_temuan">Nama Temuan</label>
                                        <input type="text" name="nama_temuan" class="form-control"
                                            placeholder="Nama Temuan" />
                                    </div>
                                    <div class="col-12 mb-2">
                                        <label class="form-label" for="rincian_temuan">Rincian Temuan</label>
                                        <textarea name="rincian_temuan" class="form-control"
                                            placeholder="Rincian Temuan"></textarea>
                                    </div>
                                    <div class="col-12 mb-2">
                                        <label class="form-label" for="lokasi_temuan">Lokasi Temuan</label>
                                        <select name="lokasi_temuan[]" class="form-select select2" multiple>
                                            <?php foreach ($list_skpd as $row) { ?>
                                            <option value="<?= $row->id_skpd ?>"><?= $row->nama_skpd ?>
                                            </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-12 mb-2">
                                        <label class="form-label" for="anggota_temuan">Anggota Tim</label>
                                        <select name="anggota_temuan[]" class="form-select select2" multiple>
                                            <?php foreach ($list_anggota as $row) { ?>
                                            <option value="<?= $row->id_pegawai ?>"><?= $row->nama_lengkap ?>
                                            </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-12 mb-2">
                                        <button type="submit" class="btn btn-primary me-1">Simpan</button>
                                        <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal"
                                            aria-label="Close">
                                            Batal
                                        </button>
                                    </div>
                                </form>
                                <!--/ Add role form -->
                            </div>
                        </div>
                    </div>
                </div>
                <!--/ Add Role Modal -->

            </div>


            <div class="col-sm-12">

                <div class="d-flex align-items-start justify-content-center">
                    <ul class="pagination page1-links"></ul>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- END: Content-->


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
</script>