<div class="container-fluid">
    <!-- Begin Container Fluid -->

    <!-- begin title -->
    <div class="row bg-title">
        <!-- .page title -->
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Tambah Naskah Berkas Aktif</h4>
        </div>
        <!-- /.page title -->
        <!-- .breadcrumb -->
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

            <ol class="breadcrumb">
                <?php echo breadcrumb($this->uri->segment_array()); ?>
            </ol>
        </div>
        <!-- /.breadcrumb -->
    </div>
    <!-- end title -->

    <!-- begin search -->
    <div class="row">
        <div class="col-md-12">
            <div class="white-box">
                <div class="card">
                    <div class="card-body">
                        <h5>Berkas
                            <?= $file->nama_berkas; ?>
                        </h5>
                        <hr>
                        <div class="alert alert-info">
                            <p>Silahkan pilih <strong>Tahun</strong> dan <strong>Jenis Surat</strong> yang akan
                                ditambakan pada Berkas Aktif <strong>
                                    <?= $file->nama_berkas; ?>
                                </strong></p>
                        </div>


                        <div class="row">
                            <div
                                class="<?= ($this->session->userdata('level') == "Administrator") ? "col-md-4" : "col-md-6" ?>">
                                <label>Jenis Surat :</label>
                                <select name="category" id="category" class="form-control" required>
                                    <option value=""></option>
                                    <option value="masuk">Surat Masuk</option>
                                    <option value="keluar">Surat Keluar</option>
                                </select>
                            </div>

                            <div
                                class="<?= ($this->session->userdata('level') == "Administrator") ? "col-md-4" : "col-md-6" ?>">
                                <label>Tahun :</label>
                                <select name="year" id="year" class="form-control" required>
                                    <option value=""></option>
                                    <option value="2019">2019</option>
                                    <option value="2020">2020</option>
                                    <option value="2021">2021</option>
                                    <option value="2022">2022</option>
                                    <option value="2023">2023</option>
                                    <option value="2024">2024</option>
                                </select>
                            </div>
                            <div
                                class="<?= ($this->session->userdata('level') == "Administrator") ? "col-md-4" : "hidden" ?>">
                                <label>SKPD :</label>
                                <select name="skpd" id="skpd" class="form-control" required>
                                    <option value=""></option>
                                    <?php foreach ($skpd as $skpd) { ?>
                                        <option value="<?= $skpd->id_skpd; ?>"><?= $skpd->nama_skpd; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="row m-t-10">
                            <div class="col-md-12">
                                <div class="pull-right">
                                    <button type="button" class="btn btn-info btn-reset">Reset</button>
                                    <button type="button" class="btn btn-primary" id="btn-search"><i
                                            class="fa fa-search"></i> Cari</button>
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
            <div class="white-box">
                <div class="card">
                    <div class="card-body">
                        <h5>Pilih Surat disini</h5>
                        <hr>
                        <form action="#" method="POST">
                            <div class="form-group">
                                <select name="letters[]" id="letters" class="form-control" required>
                                </select>
                            </div>

                            <div class="form-group">
                                <select name="classification" id="classification" class="form-control" required>
                                </select>
                            </div>

                            <div class="row">
                                <div class="pull-right">
                                    <a href="<?= base_url('naskah/arsip_dinamis/berkas_aktif') ?>"
                                        class="btn btn-default" title="Kembali">Kembali</a>
                                    <button class="btn btn-success btn-save"><i class="fa fa-save m-r-5"></i>
                                        Simpan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<script src="<?php echo base_url() . "asset/pixel/"; ?>plugins/bower_components/sweetalert/sweetalert.min.js"></script>
<!--<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>-->
<script>

    $(document).ready(function () {
        let $category = $("#category");
        let $year = $("#year");
        let $skpd = $("#skpd");
        let $btnSave = $(".btn-save");
        let $letters = $("#letters");

        $category.select2({
            width: "100%",
            placeholder: 'Pilih Jenis Surat'
        });

        $year.select2({
            placeholder: "Pilih Tahun",
            width: "100%",
        });
        $skpd.select2({
            placeholder: "Pilih SKPD",
            width: "100%",
        });
        $letters.select2({
            width: "100%",
            placeholder: "Pilih Naskah"
        });

        $letters.prop('disabled', true);
        $btnSave.prop('disabled', true);

        $(".btn-reset").click(function () {
            $category.val(null).trigger('change');
            $year.val(null).trigger('change');
            $skpd.val(null).trigger('change');
            $letters.val(null).trigger('change');
        });

        $("#btn-search").on("click", function () {
            if ($category.val() == "") {
                swal("Kesalahan", "Jenis Surat harus dipilih!", "error");
            } else if ($year.val() == "") {
                swal("Kesalahan", "Tahun Surat harus dipilih!", "error");
            } else {
                $("#letters").select2({
                    width: "100%",
                    multiple: true,
                    ajax: {
                        url: "<?= base_url('naskah/arsip_dinamis/berkas_aktif/get_surat') ?>",
                        dataType: "json",
                        type: "get",
                        delay: 250,
                        data: function (params) {
                            return {
                                category: $category.val(),
                                year: $year.val(),
                                skpd: $skpd.val(),
                                search: params.term,
                                page: params.page || 1
                            }
                        },
                        processResults: function (data, params) {
                            params.page = params.page || 1;

                            return {
                                results: data.results,
                                pagination: {
                                    more: (params.page * 20) < data.totalRows
                                }
                            };
                        },
                        cache: true
                    },
                    placeholder: 'Masukan Perihal Surat / Nomor Surat',
                    // minimumInputLength: 0,
                    templateResult: formatRepo,
                    templateSelection: formatRepoSelection
                });

                function formatRepo(repo) {
                    if (repo.loading) {
                        return repo.text;
                    }

                    var $container = $(
                        "<div class='select2-result-repository clearfix'>" +
                        "<div class='select2-result-repository__meta'>" +
                        "<div class='select2-result-repository__title'></div>" +
                        "<div class='select2-result-repository__description'></div>" +
                        "<div class='select2-result-repository__statistics'>" +
                        "</div>" +
                        "</div>" +
                        "</div>"
                    );

                    $container.find(".select2-result-repository__title").text(repo.nomer_surat);
                    $container.find(".select2-result-repository__description").text(repo.perihal);

                    return $container;
                }

                function formatRepoSelection(repo) {
                    return repo.text || repo.text;
                }
                $letters.prop('disabled', false);
            }

        });

        $("#classification").select2({
            width: "100%",
            placeholder: "Pilih Kode Klasifikasi",
            ajax: {
                url: "<?= base_url('naskah/arsip_dinamis/berkas_aktif/get_classifications') ?>",
                dataType: "json",
                type: "get",
                delay: 250,
                data: function (params) {
                    return {
                        search: params.term,
                        page: params.page || 1
                    }
                },
                processResults: function (data, params) {
                    params.page = params.page || 1;

                    return {
                        results: data.results,
                        pagination: {
                            more: (params.page * 20) < data.totalRows
                        }
                    };
                },
                cache: true
            },
            placeholder: 'Masukan nama klasifikasi',
            // minimumInputLength: 0,
            templateResult: formatRepo,
            templateSelection: formatRepoSelection
        });

        function formatRepo(repo) {
            if (repo.loading) {
                return repo.text;
            }

            var $container = $(
                "<div class='select2-result-repository clearfix'>" +
                "<div class='select2-result-repository__meta'>" +
                "<div class='select2-result-repository__title'></div>" +
                "<div class='select2-result-repository__description'></div>" +
                "<div class='select2-result-repository__statistics'>" +
                "</div>" +
                "</div>" +
                "</div>"
            );

            $container.find(".select2-result-repository__title").text(repo.kode_gabungan);
            $container.find(".select2-result-repository__description").text(repo.nama_klasifikasi);

            return $container;
        }

        function formatRepoSelection(repo) {
            return repo.nama_klasifikasi || repo.text;
        }

    });
</script>