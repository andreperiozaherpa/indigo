<div class="container-fluid">
    <div class="row bg-title">

        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Isi Berkas Aktif</h4>
        </div>

        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <?php echo breadcrumb($this->uri->segment_array()); ?>
            </ol>
        </div>

    </div>

    <div class="row">
        <div class="col-md-12">
            <a href="<?= base_url('naskah/arsip_dinamis/berkas_aktif') ?>" class="btn btn-info m-b-10"
                style="float: right;"><i class="fa fa-arrow-left"></i> Kembali</a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="x_panel">
                <div class="x_content">
                    <div class="panel panel-primary">
                        <div class="panel-heading">Infomasi Berkas - <strong>
                                <?= $file->nama_berkas; ?>
                            </strong></div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-md-4">Klasifikasi <label
                                                    style="float: right;">:</label></label>
                                            <label class="col-md-8" style="font-weight: normal;">
                                                <?= $file->id_surat_klasifikasi->kode_gabungan . " - " . $file->id_surat_klasifikasi->nama_klasifikasi; ?>
                                            </label>
                                        </div>
                                        <div class="row">
                                            <label class="col-md-4">Retensi Aktif <label
                                                    style="float: right;">:</label></label>
                                            <label class="col-md-8" style="font-weight: normal;">
                                                <?= $file->id_surat_klasifikasi->retensi_aktif; ?> Tahun
                                            </label>
                                        </div>

                                        <div class="row">
                                            <label class="col-md-4">Retensi Inaktif <label
                                                    style="float: right;">:</label></label>
                                            <label class="col-md-8" style="font-weight: normal;">
                                                <?= $file->id_surat_klasifikasi->retensi_inaktif; ?> Tahun
                                            </label>
                                        </div>

                                        <div class="row">
                                            <label class="col-md-4">Penyusutan Akhir <label
                                                    style="float: right;">:</label></label>
                                            <label class="col-md-8" style="font-weight: normal;">
                                                <?= $file->id_surat_klasifikasi->penyusutan_akhir; ?>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-md-4">Kategori Berkas <label
                                                    style="float: right;">:</label></label>
                                            <label class="col-md-8" style="font-weight: normal;">
                                                <?= $file->kategori_berkas; ?>
                                            </label>
                                        </div>
                                        <div class="row">
                                            <label class="col-md-4">Vital <label style="float: right;">:</label></label>
                                            <label class="col-md-8" style="font-weight: normal;">
                                                <?= ($file->arsip_vital == 1) ? "Ya" : "Tidak" ?>
                                            </label>
                                        </div>
                                        <div class="row">
                                            <label class="col-md-4">Terjaga <label
                                                    style="float: right;">:</label></label>
                                            <label class="col-md-8" style="font-weight: normal;">
                                                <?= ($file->arsip_terjaga == 1) ? "Ya" : "Tidak" ?>
                                            </label>
                                        </div>
                                        <div class="row">
                                            <label class="col-md-4">MKB (Memori Kolektif Bangsa) <label
                                                    style="float: right;">:</label></label>
                                            <label class="col-md-8" style="font-weight: normal;">
                                                <?= ($file->mkb == 1) ? "Ya" : "Tidak" ?>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-3">
                                    <p style="font-weight: bold;">Nomor Urut Berkas</p>
                                    <p>
                                        <?= $file->nomor_berkas; ?>
                                    </p>
                                </div>

                                <div class="col-md-3">
                                    <p style="font-weight: bold;">Uraian</p>
                                    <p>
                                        <?= $file->uraian; ?>
                                    </p>
                                </div>

                                <div class="col-md-3">
                                    <p style="font-weight: bold;">Lokasi Fisik</p>
                                    <p>
                                        <?= $file->lokasi_fisik; ?>
                                    </p>
                                </div>

                                <div class="col-md-3">
                                    <p style="font-weight: bold;">Tanggal Tutup Berkas</p>
                                    <p class="badge badge-warning p-10">
                                        <?= $file->id_surat_klasifikasi->akhir_retensi_aktif; ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="x_panel">
                <div class="x_content">
                    <div class="panel panel-primary">
                        <div class="panel-heading">Daftar Isi Berkas Aktif</div>
                        <div class="panel-body">
                            <?php if (!empty($status) && !empty($message)) { ?>
                                <div class="alert alert-<?= ($status == 200) ? 'success' : 'error' ?> alert-dismissible fade show"
                                    role="alert">
                                    <strong>
                                        <?= ($status == 200) ? "Berhasil" : "Kesalahan" ?>!
                                    </strong> daftar isi
                                    <?= ($status == 200) ? "berhasil" : "gagal" ?> disimpan.
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            <?php } ?>
                            <div class="form-group">
                                <button data-toggle="modal" data-target="#addNaskahModal" class="btn btn-success"><i
                                        class="fa fa-plus"></i> Tambah Naskah</button>
                            </div>
                            <table class="table" id="myTable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tipe Naskah</th>
                                        <th>Jenis Naskah</th>
                                        <th>Nomor Naskah</th>
                                        <th>Tanggal</th>
                                        <th>Perihal</th>
                                        <th>File</th>
                                        <!--                                        <th>Aksi</th>-->
                                    </tr>
                                </thead>
                                <tbody id="row-data">
                                    <?php if (!empty($details)) {
                                        $no = 1;
                                        foreach ($details as $detail) { ?>
                                            <tr>
                                                <td>
                                                    <?= $no++; ?>
                                                </td>
                                                <td>
                                                    <?= ($detail->surat->tipe == "keluar") ? "Surat Keluar" : "Surat Masuk"; ?>
                                                </td>
                                                <td>
                                                    <?= $detail->surat->jenis_surat; ?>
                                                </td>
                                                <td>
                                                    <?= $detail->surat->nomer_surat; ?>
                                                </td>
                                                <td>
                                                    <?= $detail->surat->tanggal_surat; ?>
                                                </td>
                                                <td>
                                                    <?= $detail->surat->perihal; ?>
                                                </td>
                                                <td>
                                                    <?php if ($detail->surat->tipe == "keluar") {
                                                        if ($detail->surat->jenis_surat == "internal") {
                                                            ?>
                                                            <a href="<?= base_url('data/surat_internal/ttd/') . $detail->surat->file; ?>"
                                                                target="_blank" class="btn btn-block btn-success">
                                                                <i class="fa fa-mail"></i> Lihat
                                                            </a>
                                                        <?php } else if ($detail->surat->jenis_surat == "eksternal") { ?>
                                                                <a href="<?= base_url('data/surat_eksternal/ttd/') . $detail->surat->file; ?>"
                                                                    target="_blank" class="btn btn-block btn-success">
                                                                    <i class="fa fa-mail"></i> Lihat
                                                                </a>
                                                        <?php }
                                                    } else { ?>
                                                        <a href="<?= base_url('data/surat_eksternal/ttd/') . $detail->surat->file; ?>"
                                                            target="_blank" class="btn btn-block btn-success">
                                                            <i class="fa fa-mail"></i> Lihat
                                                        </a>
                                                    <?php } ?>

                                                </td>
                                                <td colspan="2">

                                                    <!--                                                    <a href="#" class="btn btn-info">-->
                                                    <!--                                                        <i class="fa fa-info"></i> Detail-->
                                                    <!--                                                    </a>-->
                                                    <!--                                                    <a href="#" class="btn btn-danger">-->
                                                    <!--                                                        <i class="fa fa-trash"></i> Hapus-->
                                                    <!--                                                    </a>-->
                                                </td>
                                            </tr>
                                        <?php }
                                    } else { ?>
                                        <tr>
                                            <td colspan="7" class="alert alert-danger text-center">Belum ada daftar isi
                                                berkas aktif pada berkas <strong>
                                                    <?= $file->nama_berkas; ?>
                                                </strong></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="addNaskahModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" id="closeModal">&times;</button>
                <h4 class="modal-title">Tambah Naskah pada Berkas <strong class="text-uppercase">
                        <?= $file->nama_berkas; ?>
                    </strong></h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div
                        class="<?= ($this->session->userdata('level') == "Administrator") ? "col-md-4" : "col-md-6" ?>">
                        <div class="form-group">
                            <label>Pilih Jenis Surat</label>
                            <select name="category" id="category" class="form-control" required>
                                <option value=""></option>
                                <option value="masuk">Surat Masuk</option>
                                <option value="keluar">Surat Keluar</option>
                            </select>
                        </div>
                    </div>

                    <div
                        class="<?= ($this->session->userdata('level') == "Administrator") ? "col-md-4" : "col-md-6" ?>">
                        <div class="form-group">
                            <label>Pilih Tahun</label>
                            <select name="year" id="year" class="form-control" required>
                                <option value=""></option>
                                <option value="2020">2020</option>
                                <option value="2021">2021</option>
                                <option value="2022">2022</option>
                                <option value="2023">2023</option>
                                <option value="2024">2024</option>
                                <option value="2025">2025</option>
                            </select>
                        </div>
                    </div>

                    <div class="<?= ($this->session->userdata('level') == "Administrator") ? "col-md-4" : "hidden" ?>">
                        <label>SKPD :</label>
                        <select name="skpd" id="skpd" class="form-control" required>
                            <option value=""></option>
                            <?php foreach ($skpd as $skpd) { ?>
                                <option value="<?= $skpd->id_skpd; ?>"><?= $skpd->nama_skpd; ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <form method="POST" action="<?= base_url('naskah/arsip_dinamis/berkas_aktif/save_naskah') ?>">
                        <div id="formNaskah">
                            <div class="form-group hidden">
                                <input type="text" name="berkas" value="<?= $this->input->get('x_slug') ?>"
                                    class="form-control" required>
                                <input type="text" name="jenis_surat" id="jenis_surat" class="form-control" required>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Pilih Naskah</label>
                                    <!-- <select name="letters[]" id="letters" class="form-control" required>

                                    </select> -->
                                    <input type="text" class="form-control" placeholder="Pilih Naskah" name="letters[]"
                                        id="letters" required>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="pull-right">
                                    <button class="btn btn-primary" type="submit"><span class="btn-label"><i
                                                class="ti-save"></i></span>Simpan</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo base_url() . "asset/pixel/"; ?>plugins/bower_components/sweetalert/sweetalert.min.js"></script>
<script>

    $(document).ready(function () {
        $category = $("#category");
        $year = $("#year");
        $letters = $("#letters");
        $skpd = $("#skpd");

        function initSelect2() {
            $category.select2({
                width: '100%',
                placeholder: 'Pilih Jenis Surat'
            });

            $year.select2({
                width: '100%',
                placeholder: 'Pilih Tahun'
            });

            $skpd.select2({
                width: '100%',
                placeholder: 'Pilih SKPD'
            });

            // $letters.select2({
            //     width: '100%',
            //     placeholder: 'Pilih Naskah'
            // });

            $("#formNaskah").hide();
        }

        function setDefaultNull() {
            $year.val(null).trigger('change');
            $skpd.val(null).trigger('change');
            $letters.val(null).trigger('change');
        }

        initSelect2();

        $category.change(function () {
            $letters.select2('destroy');
            setDefaultNull();
            initSelect2();
        });

        $("#closeModal").click(function () {
            $("#year").val('').trigger('change');
            $("#category").val('').trigger('change');
            $("#letters").select2('destroy');
        });

        $year.change(function () {
            if ($category.val() == "") {
                swal({
                    title: "Kesalahan",
                    text: "Jenis Surat harus dipilih!",
                    type: "error",
                    showCloseButton: true,
                }, function () {
                    // $('#year').val(null).trigger('change');
                    initSelect2();
                    setDefaultNull();
                });

            } else {
                // $("#letters").select2({
                //     width: "100%",
                //     multiple: true,
                //     placeholder: "Pilih Naskah yang akan diberkaskan",
                //     ajax: {
                //         //url: "<? //= base_url('naskah/arsip_dinamis/berkas_aktif/get_classifications') ?>//",
                //         url: function (params) {
                //             switch ($category.val()) {
                //                 case "masuk":
                //                     return "<?= base_url('naskah/arsip_dinamis/berkas_aktif/get_surat_masuk_json') ?>";
                //                     break;
                //                 case "keluar":
                //                     return "<?= base_url('naskah/arsip_dinamis/berkas_aktif/get_surat_keluar_json') ?>";
                //                     break;
                //             }
                //         },
                //         dataType: "json",
                //         type: "get",
                //         delay: 250,
                //         data: function (params) {
                //             return {
                //                 skpd: ($skpd.val() != "" ? $skpd.val() : "<?= $this->session->userdata('id_skpd') ?>"),
                //                 year: $year.val(),
                //                 search: params.term,
                //                 page: params.page || 1
                //             }
                //         },
                //         processResults: function (data, params) {
                //             params.page = params.page || 1;

                //             return {
                //                 results: data.results,
                //                 pagination: {
                //                     more: (params.page * 20) < data.totalRows
                //                 }
                //             };
                //         },
                //         cache: true
                //     },
                //     // minimumInputLength: 0,
                //     templateResult: formatRepo,
                //     templateSelection: formatRepoSelection
                // });

                // function formatRepo(repo) {
                //     if (repo.loading) {
                //         return repo.text;
                //     }

                //     var $container = $(
                //         "<div class='select2-result-repository clearfix'>" +
                //         "<div class='select2-result-repository__meta'>" +
                //         "<div class='select2-result-repository__title'></div>" +
                //         "<div class='select2-result-repository__description'></div>" +
                //         "<div class='select2-result-repository__statistics'>" +
                //         "</div>" +
                //         "</div>" +
                //         "</div>"
                //     );

                //     $container.find(".select2-result-repository__title").text(repo.perihal);
                //     $container.find(".select2-result-repository__description").text(repo.nomer_surat);

                //     return $container;
                // }

                // function formatRepoSelection(repo) {
                //     return repo.perihal || repo.text;
                // }

                let category = $category.val();

                let apiURL = "";
                if (category == 'masuk') {
                    apiURL = "<?= base_url('naskah/arsip_dinamis/berkas_aktif/getSuratMasuk') ?>";
                } else if (category == 'keluar') {
                    apiURL = "<?= base_url('naskah/arsip_dinamis/berkas_aktif/getSuratKeluar') ?>";
                }

                $('#letters').select2({
                    minimumInputLength: 2,
                    allowClear: true,
                    placeholder: "Pilih Naskah yang akan diberkaskan",
                    ajax: {
                        dataType: 'json',
                        url: apiURL,
                        data: function (term, page) {
                            return {
                                search: term, //search term
                                skpd: ($skpd.val() != "" ? $skpd.val() : "<?= $this->session->userdata('id_skpd') ?>"),
                                year: $year.val(),
                                page: page || 1
                            };
                        },
                        results: function (data, page) {
                            return {
                                results: data
                            };
                        },
                    }
                });

                $("#jenis_surat").val($category.val());
                $("#formNaskah").show();
            }
        });

    });


</script>