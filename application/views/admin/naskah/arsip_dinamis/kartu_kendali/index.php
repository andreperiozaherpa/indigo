<div class="container-fluid">

    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">
                <?= $title; ?>
            </h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li>Kartu Kendali</li>
                <li class="active">
                    <?= ($this->uri->segment(3) == 'keluar') ? "Keluar" : "Masuk"; ?>
                </li>
            </ol>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="white-box">
                <div class="row">
                    <!--                    <form method="POST">-->
                    <div class="col-md-6">
                        <label for="">Tanggal Naskah</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="tanggal_awal" autocomplete="off"
                                id="datepicker" placeholder="Tanggal Awal">
                            <div class="input-group-addon">s.d.</div>
                            <input type="text" class="form-control" name="tanggal_akhir" autocomplete="off"
                                id="datepicker" placeholder="Tanggal Akhir">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="">Kode Klasifikasi</label>
                        <div class="form-group">

                            <input type="text" class="form-control" placeholder="Pilih Klasifikasi Surat"
                                name="klasifikasi">
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="form-group text-center">
                            <br>
                            <button type="button" class="btn btn-block btn-primary btn-outline m-t-5" id="btn-search"
                                name="type" value="filter"><i class="ti-search"></i> Cari</button>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="form-group text-center">
                            <br>
                            <button type="reset" class="btn btn-block btn-warning btn-outline m-t-5" id="btn-reset"
                                name="type" value="reset"><i class="ti-refresh"></i> Reset</button>
                        </div>
                    </div>
                    <!--                    </form>-->
                </div>
            </div>
            <div class="white-box">
                <!--                <div class="row">-->
                <!--                    <div class="col-md-12">-->
                <!--                        <a href="javascript:void(0)" onclick="showDownload()" class="btn btn-primary mb-4 pull-right"><i class="ti-file"></i> Download Rekap LKH</a>-->
                <!--                    </div>-->
                <!--                </div>-->
                <?php
                if (isset($message)) {
                    ?>
                    <div class="alert alert-<?= $message_type ?>"><?= $message ?></div>
                <?php } ?>
                <!--                <hr>-->
                <div class="table-responsive">
                    <table class="table color-table primary-table table-responsive" id="kartuKendaliTable">
                        <thead>
                            <tr class="text-center">
                                <th width="5%">No. Urut</th>
                                <th>Hari / Tanggal</th>
                                <th width="10%">No. Surat</th>
                                <th width="10%">Klasifikasi</th>
                                <th width="20%">Perihal</th>
                                <th width="25%">Isi Ringkasan</th>
                                <th width="10%">
                                    <?= ($this->uri->segment(3) == "masuk") ? "Pengirim" : "Penerima" ?>
                                </th>
                                <th width="10%">Disposisi</th>
                                <th width="10%">File Surat</th>
                                <th>Cetak Kartu Kendali</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="10">
                                    <center>Data tidak ditemukan</center>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="addPengolahModal" tabindex="-1" role="dialog" aria-labelledby="addPengolahModal"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myLargeModalLabel">Tambah Pengolah Kearsipan</h4>
            </div>
            <!--            <form action="-->
            <? //= base_url('naskah/arsip_dinamis/kartu_kendali/updatePengolah') ?><!--" method="post" target="_blank">-->
            <div class="modal-body">
                <div class="form-group hidden">
                    <label>Kartu Kendali :</label>
                    <input type="text" class="form-control" name="kartuKendali" required />
                </div>
                <div class="form-group">
                    <label class="text-danger">Pengolah Kearsipan :</label>
                    <input type="text" name="pengolah" class="form-control"
                        placeholder="Masukan Nama Pengolah Kearsipan" required />
                </div>
            </div>
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-default waves-effect text-left">Tutup</button>
                <button type="submit" class="btn btn-primary waves-effect text-left">Simpan</button>
            </div>
            <!--            </form>-->
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {

        $("#addPengolahModal").modal('hide');
        let uriSegment = "<?= $this->uri->segment(3); ?>";

        let kartuKendaliTable = $('#kartuKendaliTable').DataTable({
            "processing": true,
            "serverSide": true,
            "ordering": false,
            "ajax": {
                "url": "<?php echo base_url('naskah/arsip_dinamis/kartu_kendali/get_kartu_kendali') ?>",
                // "dataType": "json",
                "type": "POST",
                "data": {
                    params: uriSegment,
                    startDate: function () {
                        return $('[name="tanggal_awal"]').val()
                    },
                    endDate: function () {
                        return $('[name="tanggal_akhir"]').val()
                    },
                    classification: function () {
                        return $('[name="klasifikasi"]').val()
                    }
                }
            },
            "columns": [
                {
                    "data": "no",
                    'searchable': false,
                    'orderable': true,
                    // 'render': function (data, type, row, meta) {
                    //     return meta.row + meta.settings._iDisplayStart + 1;
                    // }
                },
                {
                    "data": "tanggal_buat",
                    'searchable': false,
                    'orderable': false,
                },
                {
                    "data": "nomer_surat",
                    'searchable': true,
                    'orderable': false,
                    'render': function (data, type, row) {
                        if (row.jenis_surat == "eksternal") {
                            return row.nomer_surat + " <span class='badge badge-danger'>Eksternal</span>";
                        } else {
                            return row.nomer_surat + " <span class='badge badge-success'>Internal</span>";
                        }
                    }
                },
                {
                    "data": "klasifikasi",
                    'searchable': false,
                    'orderable': false,
                },
                {
                    "data": "perihal",
                    'searchable': true,
                    'orderable': false,
                },
                {
                    "data": "isi_ringkasan",
                    'searchable': false,
                    'orderable': false,
                },
                {
                    "data": "surat_id",
                    'searchable': false,
                    'orderable': false,
                },
                {
                    "data": "disposisi_surat_masuk",
                    'searchable': false,
                    'orderable': false,
                },
                {
                    "data": "file_surat",
                    'searchable': false,
                    'orderable': false,
                },
                {
                    "data": "kartu_kendali",
                    "searchable": false,
                    "orderable": false
                }
            ],
            "language": {
                "processing": '<i class="fa fa-circle-o-notch fa-spin" style="font-size:24px"></i> Mohon tunggu ...'
            }
        }); // End of DataTable


        $("#btn-search").click(function () {
            // kartuKendaliTable.ajax.data({
            //     params: uriSegment,
            //     startDate: function () {
            //         return $('[name="tanggal_awal"]').val()
            //     },
            //     endDate: function () {
            //         return $('[name="tanggal_akhir"]').val()
            //     }
            // });
            kartuKendaliTable.ajax.reload();
        });

        $("#btn-reset").click(function () {
            $('[name="tanggal_awal"]').val('');
            $('[name="tanggal_akhir"]').val('');
            $('[name="klasifikasi"]').val(null).trigger("change");
            kartuKendaliTable.ajax.reload();
        });

        $('[name="klasifikasi"]').select2({
            minimumInputLength: 2,
            allowClear: true,
            placeholder: 'Pilih Klasifikasi Surat',
            ajax: {
                dataType: 'json',
                url: "<?= base_url('naskah/arsip_dinamis/berkas_aktif/get_classifications') ?>",
                data: function (term, page) {
                    return {
                        search: term, //search term
                    };
                },
                results: function (data, page) {
                    return {
                        results: data
                    };
                },
            }
        });

        $("#klasifikasi").select2({
            width: "100%",
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

        $("#kartuKendaliTable").on('click', '.btn-pengolah', function () {
            $('[name="kartuKendali"]').val('');

            $('[name="kartuKendali"]').val(this.id);
            console.log(".btn-pengolah executed!");
            $("#addPengolahModal").modal('show');
        });

        $("form").submit(function (event) {
            var formData = {
                kartuKendali: $('[name="kartuKendali"]').val(),
                pengolah: $('[name="pengolah"]').val()
            }

            $.ajax({
                type: "POST",
                url: "<?= base_url('naskah/arsip_dinamis/kartu_kendali/updatePengolah') ?>",
                data: formData,
                dataType: "json",
                encode: true
            })
                .done(function (data) {
                    console.log(data);
                })
                .fail(function () {
                    console.log("Failed")
                });

            event.preventDefault();
        })

    });
</script>