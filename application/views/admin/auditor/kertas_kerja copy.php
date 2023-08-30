<base href="https://e-office.sumedangkab.go.id" target="_parent">
<style>
div.more-info>p {
    margin: 0;
}

div.more-info>p>span.fw-bold {
    font-weight: 600 !important;
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
                            <?= $temuan['detail']->nama_temuan ?>
                        </h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="#">Home</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="<?= base_url('auditor/temuan'); ?>">Temuan</a>
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

            <!-- app e-commerce details start -->
            <section class="app-ecommerce-details">
                <div class="card">
                    <!-- Product Details starts -->
                    <div class="card-body">
                        <div class="row my-2">
                            <div class="col-12 col-md-5 d-flex align-items-center justify-content-center mb-2 mb-md-0">
                                <iframe
                                    src="https://docs.google.com/viewer?url=https://e-office.sumedangkab.go.id/data/surat_internal/surat_masuk/<?= $temuan['detail']->file_ttd ?>&amp;embedded=true"
                                    width="100%" height="100%" style="border: none;"></iframe>
                            </div>
                            <div class="col-12 col-md-7">
                                <h4>
                                    <?= $temuan['detail']->nomer_surat ?>
                                </h4>
                                <p class="card-text">
                                    <?= tanggal($temuan['detail']->tanggal_temuan) ?> -
                                    <span class="badge bg-primary">
                                        <?= $temuan['detail']->status_temuan ?>
                                    </span>
                                </p>
                                <div class="d-flex justify-content-between">
                                    <blockquote class="blockquote ps-1 border-start-primary border-start-3">
                                        <small>Nama yang diberi perintah</small>
                                        <h6><?= $temuan['detail']->nama_yang_diberi_perintah ?></h6>
                                    </blockquote>
                                    <blockquote class="blockquote ps-1 border-start-primary border-start-3">
                                        <small>Lokasi temuan</small>
                                        <h6><?= $temuan['detail']->nama_skpd ?></h6>
                                    </blockquote>
                                </div>
                                <hr />
                                <p class="card-text">
                                    <?= $temuan['detail']->rincian_temuan ?>
                                </p>
                                <ul class="product-features list-unstyled">
                                    <?php foreach ($temuan['program'] as $row) { ?>
                                    <li>
                                        <i data-feather="circle"></i>
                                        <span><?= $row->nama_program ?></span>
                                    </li>
                                    <?php } ?>
                                </ul>
                                <hr />
                                <div class="product-color-options d-flex justify-content-around">
                                    <div class="text-center">
                                        <h6>Ketua Tim</h6>
                                        <ul class="list-unstyled d-flex align-items-center avatar-group mb-0">
                                            <li data-bs-toggle="tooltip" data-popup="tooltip-custom"
                                                data-bs-placement="top" title="<?= $temuan['ketua']->nama_lengkap ?>"
                                                class="avatar avatar-sm pull-up ms-1 me-50">
                                                <img class="rounded-circle"
                                                    src="<?php echo base_url() . "data/foto/pegawai/" . $temuan['ketua']->foto_pegawai; ?>"
                                                    alt="Avatar" />
                                            </li>
                                            <span class="tex-dark"> <?= $temuan['ketua']->nama_lengkap ?>
                                            </span>
                                        </ul>
                                    </div>
                                    <div class="text-center">
                                        <h6>Anggota</h6>
                                        <ul class="list-unstyled d-flex align-items-center avatar-group mb-0 ">
                                            <?php foreach ($temuan['anggota'] as $key => $value) { ?>
                                            <li data-bs-toggle="tooltip" data-popup="tooltip-custom"
                                                data-bs-placement="top" title="<?= $value->nama_lengkap ?>"
                                                class="avatar avatar-sm pull-up">
                                                <img class="rounded-circle"
                                                    src="<?php echo base_url() . "data/foto/pegawai/" . $value->foto_pegawai; ?>"
                                                    alt="Avatar" />
                                            </li>
                                            <?php } ?>
                                        </ul>
                                    </div>
                                </div>
                                <hr />
                                <div class="d-flex flex-column flex-sm-row pt-1">
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
                                    </div>
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
                                                action="<?= base_url('auditor/kertas_kerja/' . $this->session->userdata('auditor_temuan')) ?>">
                                                <div class="col-12 mb-2">
                                                    <label class="form-label" for="nama_temuan">Nama Temuan</label>
                                                    <input type="text" name="nama_temuan" class="form-control"
                                                        placeholder="Nama Temuan"
                                                        value="<?= $temuan['detail']->nama_temuan ?>" />
                                                </div>
                                                <div class="col-12 mb-2">
                                                    <label class="form-label" for="rincian_temuan">Rincian
                                                        Temuan</label>
                                                    <textarea name="rincian_temuan" class="form-control"
                                                        placeholder="Rincian Temuan"><?= $temuan['detail']->rincian_temuan ?></textarea>
                                                </div>
                                                <hr />
                                                <h6>Daftar Program Kerja Audit</h6>
                                                <div class="col-12 mb-2 hidden" id="clone-program">
                                                    <input type="text" name="nama_program[]" class="form-control"
                                                        placeholder="Nama Program" />
                                                </div>
                                                <?php if (count($temuan['program']) > 0) {
                                                    foreach ($temuan['program'] as $key => $value) { ?>
                                                <div class="col-12 mb-2">
                                                    <input type="text" name="nama_program[]" class="form-control"
                                                        placeholder="Nama Program"
                                                        value="<?= $value->nama_program ?>" />
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
                                                    <button type="reset"
                                                        class="btn btn-outline-secondary me-1 float-end"
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
                                                action="<?= base_url('auditor/kertas_kerja/' . $this->session->userdata('auditor_temuan')) ?>">

                                                <div class="col-12 mb-2">
                                                    <select name="anggota_temuan" class="form-select select2" required>
                                                        <option value=""> - Pilih - </option>
                                                        <?php foreach ($temuan['anggota'] as $key => $value) { ?>
                                                        <option value="<?= $value->id_pegawai ?>">
                                                            <?= $value->nama_lengkap ?></option>
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
                            <input type="text" class="form-control add-new-board-input mb-50"
                                placeholder="Add Board Title" id="add-new-board-input" required />
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
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close">×</button>
                            <div class="modal-header mb-1">
                                <h5 class="modal-title">Kertas Kerja</h5>
                            </div>
                            <div class="modal-body flex-grow-1">
                                <ul class="nav nav-tabs tabs-line">
                                    <li class="nav-item">
                                        <a class="nav-link nav-link-update active" data-bs-toggle="tab"
                                            href="#tab-update">
                                            <i data-feather="edit"></i>
                                            <span class="align-middle">Update</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link nav-link-activity" data-bs-toggle="tab" href="#tab-activity">
                                            <i data-feather="activity"></i>
                                            <span class="align-middle">Aktifitas</span>
                                        </a>
                                    </li>
                                </ul>
                                <div class="tab-content mt-2">
                                    <div class="tab-pane tab-pane-update fade show active" id="tab-update"
                                        role="tabpanel">
                                        <form id="form-pekerjaan" class="update-item-form topik"
                                            action="javascript:void(0);">
                                            <div class="mb-1">
                                                <label for="cover" class="form-label">Cover</label>
                                                <img id="img-cover" class="img-fluid rounded mb-50" height="3">
                                                <input class="form-control file-attachments" type="file" id="cover"
                                                    accept="image/png, image/gif, image/jpeg" name="cover_pekerjaan" />
                                            </div>
                                            <div class="mb-1">
                                                <label class="form-label" for="title">Nama Topik</label>
                                                <input type="text" id="title" name="nama_topik" class="form-control"
                                                    placeholder="Enter Title" />
                                            </div>
                                            <div class="mb-1">
                                                <label class="form-label" for="due-date">Tanggal</label>
                                                <input type="text" id="due-date" name="tanggal_topik"
                                                    class="form-control" placeholder="Enter Due Date" />
                                            </div>
                                            <div class="mb-1">
                                                <label class="form-label" for="label">Program Kerja Audit</label>
                                                <select class="select2 select2-label form-select" id="label"
                                                    name="nama_program">
                                                    <option value="">&nbsp;</option>
                                                    <?php foreach ($temuan['program'] as $row) { ?>
                                                    <option value="<?= $row->nama_program ?>"><?= $row->nama_program ?>
                                                    </option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="mb-1">
                                                <label class="form-label">Anggota</label>
                                                <ul class="assigned ps-0"></ul>
                                            </div>
                                            <div class="mb-1">
                                                <select class="select2 select2-label form-select" multiple id="member"
                                                    name="anggota_topik[]">
                                                    <option value="<?= $temuan['ketua']->id_pegawai ?>">
                                                        <?= $temuan['ketua']->nama_lengkap ?>
                                                    </option>
                                                    <?php foreach ($temuan['anggota'] as $row) { ?>
                                                    <option value="<?= $row->id_pegawai ?>">
                                                        <?= $row->nama_lengkap ?>
                                                    </option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <hr />
                                            <div class="mb-1">
                                                <div class="d-flex flex-wrap">
                                                    <input type="hidden" id="board_id" name="board_id"
                                                        class="form-control" placeholder="ID" />
                                                    <button id="btn-simpan" type="button" class="btn btn-primary me-1"
                                                        data-bs-dismiss="modal">Simpan</button>
                                                    <button id="btn-hapus" type="button" class="btn btn-outline-danger"
                                                        data-bs-dismiss="modal">Hapus</button>
                                                </div>
                                            </div>
                                        </form>
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
                                                    <input type="hidden" id="board_ida" name="board_id"
                                                        class="form-control" placeholder="ID" />
                                                    <button id="btn-aktifitas" type="button"
                                                        class="btn btn-primary me-1">Tambahkan Komentar</button>
                                                </div>
                                            </div>
                                        </form>
                                        <hr />
                                        <section id="list-aktifitas">
                                            <div class="d-flex align-items-start mb-1">
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
                                            </div>
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

<script src="<?php echo base_url() . "asset/auditor/"; ?>app-assets/js/scripts/pages/app-kanban.js"></script>
<script>
var autorefresh = false;
var id_member = <?=($this->session->userdata('id_pegawai ')) ? $this->session->userdata('id_pegawai ') : 0 ?>;
var id_temuan = "<?= $this->session->userdata('auditor_temuan') ?>";

function kanbanIsIdle() {
    autorefresh = setInterval(function() {
        $('.kanban-wrapper').html('');
        $.getScript('<?php echo base_url() . "asset/auditor/"; ?>app-assets/js/scripts/pages/app-kanban.js');
    }, 5000);
}

$(document).ready(function() {
    // kanbanIsIdle()
});
</script>