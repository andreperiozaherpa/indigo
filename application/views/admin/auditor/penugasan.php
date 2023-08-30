<base href="<?= base_url() ?>" target="_parent">

<!-- <pre><?php print_r($desa);?></pre> -->

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
                                    <a href="#">Home</a>
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

            <!-- Collapsible and Refresh Actions -->
            <div class="col-sm-12 hidden">
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
                                        <label class="form-label" for="helpInputTop">Nama Penugasan</label>
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
                                        <label class="form-label" for="helperText">Tanggal Penugasan</label>
                                        <input type="date" id="helperText" class="form-control" placeholder="Name" />
                                    </div>
                                </div>
                                <div class="col-xl-4 col-md-6 col-12 mb-1 mb-md-0">
                                    <label class="form-label" for="disabledInput">Tanggal Penugasan</label>
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
                    <div class="col-xl-4 col-lg-6 col-md-6 d-grid">
                        <div class="card bg-primary">
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
                                            data-bs-toggle="modal" class="stretched-link text-nowrap add-new-role"
                                            onclick="$('.select2').trigger('change')">
                                            <span class="btn btn-outline-primary bg-white mt-1">Tambah Penugasan</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php foreach ($list_penugasan['detail'] as $key => $row) { ?>
                    <div id="penugasan-<?= $key ?>" class="col-xl-4 col-lg-6 col-md-6 penugasan-list d-grid">
                        <div class="card">
                            <div class="card-header align-self-center">
                                <?= $row->no_surat ?>
                            </div>
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <!-- <span class="badge bg-primary"><?= $row->status_penugasan ?></span> -->
                                    <a href="javascript:;" class="role-edit-modal" data-bs-toggle="modal"
                                        data-bs-target="#addRoleModal" onclick="editPenugasan(<?= $key ?>)">
                                        <small class="fw-bolder"><i data-feather='edit-3'></i> Ubah Penugasan</small>
                                    </a>
                                    <ul class="list-unstyled d-flex align-items-center avatar-group mb-0">
                                        <?php foreach ($list_penugasan['anggota'][$key] as $num => $value) { ?>
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
                                                +
                                                <?= $limit ?>
                                            </div>
                                        </li>
                                        <?php } elseif ($limit == 1) { ?>
                                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                            title="<?= $list_penugasan['anggota'][$key][$num]->nama_lengkap ?>"
                                            class="avatar avatar-sm pull-up">
                                            <img class="rounded-circle"
                                                src="<?php echo base_url() . "data/foto/pegawai/" . $list_penugasan['anggota'][$key][$num]->foto_pegawai; ?>"
                                                alt="Avatar" />
                                        </li>
                                        <?php } ?>
                                    </ul>
                                </div>
                                <div class="d-flex justify-content-between align-items-end mt-1 pt-25">
                                    <div class="role-heading">
                                        <h4 class="fw-bolder nama_penugasan">
                                            <?= $row->nama_penugasan ?>
                                        </h4>
                                        <span>
                                            <?= tanggal($row->tanggal_awal_penugasan) ?> -
                                            <?= tanggal($row->tanggal_akhir_penugasan) ?>
                                        </span>
                                    </div>
                                    <button class="btn btn-outline-secondary btn-sm waves-effect"
                                        onclick="deletePenugasan('<?= encode($row->id_penugasan) ?>')">Hapus</button>
                                    <!-- <a href="<?= base_url('auditor/kertas_kerja/' . encode($row->id_penugasan)) ?>"
                                                        class="text-body"><i data-feather="book" class="font-medium-5"></i> Detail</a> -->
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
                                    <h1 class="role-title">Tambah Penugasan</h1>
                                    <p>Penugasan dibuat berdasarkan SP dari E-office</p>
                                </div>
                                <!-- Add role form -->
                                <form id="addRoleForm" class="row" method="post"
                                    action="<?= base_url('auditor/penugasan') ?>">
                                    <div class="col-12 mb-2">
                                        <label class="form-label" for="id_susunan">Pilih PKPT</label>
                                        <select id="id_susunan" name="id_susunan" class="form-select select2"
                                            onchange="selectPKPT()" required>
                                            <option> - Pilih - </option>
                                            <?php foreach ($list_pkpt['sub_kegiatan'] as $row) { ?>
                                            <optgroup
                                                label="<?= $row->kode_sub_kegiatan ?>                                                                                                                                                                                                                                                                                                                     <?= $row->nama_sub_kegiatan ?>">
                                                <?php foreach ($list_pkpt['pkpt'][$row->kode_sub_kegiatan] as $key => $value) { ?>
                                                <!-- <optgroup label="<?= $value->nama_aktifitas ?>"> -->
                                                <?php foreach ($list_pkpt['susunan'][$row->kode_sub_kegiatan][$key] as $list) { ?>
                                                <option value="<?= $list->id_susunan ?>">
                                                    <?= $value->nama_aktifitas ?> (Tim: <?= $list->nama_tim ?>)
                                                </option>
                                                <?php } ?>
                                                <!-- </optgroup> -->
                                                <?php } ?>
                                            </optgroup>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-12 mb-2">
                                        <label class="form-label" for="id_surat">Pilih Surat Perintah</label>
                                        <select id="id_surat" name="id_surat" class="form-select select2"
                                            onchange="$('#no_surat').val($('#id_surat option:selected').text().trim())"
                                            required>
                                            <option> - Pilih - </option>
                                            <?php foreach ($list_sp as $row) { ?>
                                            <option value="<?= $row->id_surat_keluar ?>">
                                                <?= $row->nomer_surat ?>
                                            </option>
                                            <?php } ?>
                                        </select>
                                        <input type="hidden" id="no_surat" name="no_surat" required>
                                    </div>
                                    <div class="col-12 mb-2">
                                        <div class="row">
                                            <div class="col-8">
                                                <label class="form-label" for="tanggal_penugasan">Tanggal Penugasan</label>
                                                <div class="d-flex justify-content-between">
                                                    <input type="date" id="tanggal_awal_penugasan" name="tanggal_awal_penugasan"
                                                        class="form-control" placeholder="Tanggal Penugasan" required />
                                                    <span class="m-50">s/d</span>
                                                    <input type="date" id="tanggal_akhir_penugasan"
                                                        name="tanggal_akhir_penugasan" class="form-control"
                                                        placeholder="Tanggal Penugasan" required />
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <label class="form-label" for="tanggal_penugasan">Tanggal Batas Pelaporan LHP</label>
                                                <input type="date" id="tanggal_batas_lhp"
                                                    name="tanggal_batas_lhp" class="form-control"
                                                    placeholder="Tanggal Batas Pelaporan LHP" required />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mb-2">
                                        <label class="form-label" for="nama_penugasan">Nama Penugasan</label>
                                        <input type="text" id="nama_penugasan" name="nama_penugasan"
                                            class="form-control" placeholder="Nama Penugasan" required />
                                    </div>
                                    <div class="col-12 mb-2">
                                        <label class="form-label" for="rincian_penugasan">Rincian Penugasan</label>
                                        <textarea id="rincian_penugasan" name="rincian_penugasan" class="form-control"
                                            placeholder="Rincian Penugasan"></textarea>
                                    </div>
                                    <div class="col-12 mb-2">
                                        <label class="form-label" for="lokasi_penugasan">Lokasi Penugasan /
                                            Obrik</label>
                                        <select id="lokasi_penugasan" name="lokasi_penugasan[]"
                                            class="form-select select2" multiple required>
                                            <?php foreach ($list_skpd as $row) { ?>
                                            <option value="<?= $row->id_skpd ?>">
                                                <?= $row->nama_skpd ?>
                                            </option>
                                            <?php } ?>
                                            <?php foreach ($desa as $row) { ?>
                                            <option value="d<?= $row->id_skpd ?>">
                                                <?= $row->nama_skpd ?>
                                            </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-12 mb-2">
                                        <label class="form-label" for="pj_penugasan">Penanggung Jawab</label>
                                        <div class="avatar bg-light-primary avatar-sm pull-up float-end"
                                            data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                            title="" data-bs-original-title="Penanggung Jawab">
                                            <div class="avatar-content" id="jumlah-pj"></div>
                                        </div>
                                        <select id="pj_penugasan" name="pj_penugasan[]" class="form-select select2"
                                            multiple>
                                            <?php foreach ($list_anggota as $row) { ?>
                                            <option value="<?= $row->id_pegawai ?>">
                                                <?= $row->nama_lengkap ?>
                                            </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-12 mb-2">
                                        <label class="form-label" for="ppj_penugasan">Pembantu Penanggung
                                            Jawab</label>
                                        <div class="avatar bg-primary avatar-sm pull-up float-end"
                                            data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                            title="" data-bs-original-title="Pembantu Penanggung Jawab">
                                            <div class="avatar-content" id="jumlah-ppj"></div>
                                        </div>
                                        <select id="ppj_penugasan" name="ppj_penugasan[]" class="form-select select2"
                                            multiple>
                                            <?php foreach ($list_anggota as $row) { ?>
                                            <option value="<?= $row->id_pegawai ?>">
                                                <?= $row->nama_lengkap ?>
                                            </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-12 mb-2">
                                        <label class="form-label" for="pt_penugasan">Pengendali Teknis</label>
                                        <div class="avatar bg-info avatar-sm pull-up float-end" data-bs-toggle="tooltip"
                                            data-popup="tooltip-custom" data-bs-placement="top" title=""
                                            data-bs-original-title="Pengendali Teknis">
                                            <div class="avatar-content" id="jumlah-pt"></div>
                                        </div>
                                        <select id="pt_penugasan" name="pt_penugasan[]" class="form-select select2"
                                            multiple>
                                            <?php foreach ($list_anggota as $row) { ?>
                                            <option value="<?= $row->id_pegawai ?>">
                                                <?= $row->nama_lengkap ?>
                                            </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-12 mb-2">
                                        <label class="form-label" for="kt_penugasan">Ketua Tim</label>
                                        <div class="avatar bg-light-success avatar-sm pull-up float-end"
                                            data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                            title="" data-bs-original-title="Ketua Tim">
                                            <div class="avatar-content" id="jumlah-kt"></div>
                                        </div>
                                        <select id="kt_penugasan" name="kt_penugasan[]" class="form-select select2"
                                            multiple>
                                            <?php foreach ($list_anggota as $row) { ?>
                                            <option value="<?= $row->id_pegawai ?>">
                                                <?= $row->nama_lengkap ?>
                                            </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-12 mb-2">
                                        <label class="form-label" for="at_penugasan">Anggota Tim</label>
                                        <div class="avatar bg-success avatar-sm pull-up float-end"
                                            data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                            title="" data-bs-original-title="Anggota Tim">
                                            <div class="avatar-content" id="jumlah-at"></div>
                                        </div>
                                        <select id="at_penugasan" name="at_penugasan[]" class="form-select select2"
                                            multiple>
                                            <?php foreach ($list_anggota as $row) { ?>
                                            <option value="<?= $row->id_pegawai ?>">
                                                <?= $row->nama_lengkap ?>
                                            </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-12 mb-2">
                                        <input type="hidden" name="id_penugasan">
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
                    <ul class="pagination page-penugasan"></ul>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- END: Content-->

<?php
$list_susunan = array();
foreach ($list_pkpt['susunan'] as $susunan) {
    foreach ($susunan as $list) {
        foreach ($list as $row) {
            $list_susunan[$row->id_susunan] = $row;
        }
    }
}
$limitPage = 8;
?>
<script type="text/javascript">
var list_susunan = <?= json_encode($list_susunan) ?>;
var list_penugasan = <?= json_encode($list_penugasan) ?>;

var limitPage = <?= $limitPage ?>;

$(document).ready(function() {
    $('.page-penugasan').twbsPagination({
        totalPages: <?= ceil(count($list_penugasan['detail']) / $limitPage) ?>,
        visiblePages: 7,
        prev: 'Prev',
        first: null,
        last: null,
        startPage: 1,
        onPageClick: function(event, page) {
            $('.penugasan-list').addClass('hidden');
            $('.penugasan-list').removeClass('d-grid');
            for (let i = (page * limitPage) - limitPage; i < (page * limitPage); i++) {
                $('#penugasan-' + i).removeClass('hidden');
                $('#penugasan-' + i).addClass('d-grid');
            }
        }
    });
    // $('.nama_penugasan').each(function() {
    //     var $element = $(this);
    //     console.log($element);
    //     if ($element.html().includes('Melaksanakan Monitoring Tindak lanjut Hasil Pemeriksaan Reguler Tahun 2021')) { 
    //         $element.removeClass('hidden');
    //         $element.addClass('d-grid');
    //     }
    // });

});

function selectPKPT() {
    var selected = $('#id_susunan').val();
    if (selected > 0) {
        if(list_susunan[selected].jumlah_pj > 0){
            $("#pj_penugasan").removeAttr("disabled");
            $("#pj_penugasan").select2("destroy").select2({
                maximumSelectionLength: list_susunan[selected].jumlah_pj
            }).val(null).trigger('change');
        } else {
            $("#pj_penugasan").attr("disabled","disabled");
        }
        $("#jumlah-pj").html(list_susunan[selected].jumlah_pj);
        
        if(list_susunan[selected].jumlah_ppj > 0){
            $("#ppj_penugasan").removeAttr("disabled");
            $("#ppj_penugasan").select2("destroy").select2({
                maximumSelectionLength: list_susunan[selected].jumlah_ppj
            }).val(null).trigger('change');
        } else {
            $("#ppj_penugasan").attr("disabled","disabled");
        }
        $("#jumlah-ppj").html(list_susunan[selected].jumlah_ppj);
        
        if(list_susunan[selected].jumlah_pt > 0){
            $("#pt_penugasan").removeAttr("disabled");
            $("#pt_penugasan").select2("destroy").select2({
                maximumSelectionLength: list_susunan[selected].jumlah_pt
            }).val(null).trigger('change');
        } else {
            $("#pt_penugasan").attr("disabled","disabled");
        }
        $("#jumlah-pt").html(list_susunan[selected].jumlah_pt);
        
        if(list_susunan[selected].jumlah_kt > 0){
            $("#kt_penugasan").removeAttr("disabled");
            $("#kt_penugasan").select2("destroy").select2({
                maximumSelectionLength: list_susunan[selected].jumlah_kt
            }).val(null).trigger('change');
        } else {
            $("#kt_penugasan").attr("disabled","disabled");
        }
        $("#jumlah-kt").html(list_susunan[selected].jumlah_kt);
        
        if(list_susunan[selected].jumlah_at > 0){
            $("#at_penugasan").removeAttr("disabled");
            $("#at_penugasan").select2("destroy").select2({
                maximumSelectionLength: list_susunan[selected].jumlah_at
            }).val(null).trigger('change');
        } else {
            $("#at_penugasan").attr("disabled","disabled");
        }
        $("#jumlah-at").html(list_susunan[selected].jumlah_at);
    }
}

function editPenugasan(id) {
    $("input[name=id_penugasan]").val(list_penugasan.detail[id].id_penugasan);
    $("select[name=id_susunan]").val(list_penugasan.detail[id].id_susunan).trigger("change");
    $("select[name=id_surat]").val(list_penugasan.detail[id].id_surat).trigger("change");
    $("input[name=tanggal_awal_penugasan]").val(list_penugasan.detail[id].tanggal_awal_penugasan);
    $("input[name=tanggal_akhir_penugasan]").val(list_penugasan.detail[id].tanggal_akhir_penugasan);
    $("input[name=tanggal_batas_lhp]").val(list_penugasan.detail[id].tanggal_batas_lhp);
    $("input[name=nama_penugasan]").val(list_penugasan.detail[id].nama_penugasan);
    $("textarea[name=rincian_penugasan]").val(list_penugasan.detail[id].rincian_penugasan);
    $("select[name^=lokasi_penugasan]").val(list_penugasan.detail[id].lokasi_penugasan.split(',').map(String)).trigger(
        "change");
    $("select[name^=pj_penugasan]").val(list_penugasan.detail[id].pj_penugasan.split(',').map(Number)).trigger(
        "change");
    $("select[name^=ppj_penugasan]").val(list_penugasan.detail[id].ppj_penugasan.split(',').map(Number)).trigger(
        "change");
    $("select[name^=pt_penugasan]").val(list_penugasan.detail[id].pt_penugasan.split(',').map(Number)).trigger(
        "change");
    $("select[name^=kt_penugasan]").val(list_penugasan.detail[id].kt_penugasan.split(',').map(Number)).trigger(
        "change");
    $("select[name^=at_penugasan]").val(list_penugasan.detail[id].at_penugasan.split(',').map(Number)).trigger(
        "change");

    list_penugasan.anggota[id].forEach(anggota => {});
}

function deletePenugasan(id) {
    Swal.fire({
        title: "Hapus Penugasan?",
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
                url: "<?= base_url() ?>auditor/delete_penugasan",
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
                        text: "Penugasan Telah Dihapus. \n" + data.error_msg,
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