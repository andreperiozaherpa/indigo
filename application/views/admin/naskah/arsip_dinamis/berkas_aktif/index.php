<div class="container-fluid">
    <!-- Begin Container Fluid -->

    <!-- begin title -->
    <div class="row bg-title">
        <!-- .page title -->
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Daftar Berkas Aktif</h4>
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
    <!--    <div class="row">-->
    <!--        <div class="col-md-12">-->
    <!--            <div class="white-box">-->
    <!--                <div class="row">-->
    <!---->
    <!--                    <form method="POST">-->
    <!---->
    <!--                        <div class="col-md-10">-->
    <!--                            <div class="row">-->
    <!--                                <div class="col-md-3">-->
    <!--                                    <div class="form-group">-->
    <!--                                        <label class="control-label">Nama Berkas</label>-->
    <!--                                        <input type="text" id="" name="perihal" placeholder="Masukkan Perihal Surat" class="form-control" placeholder="" value=""> isi value : <-?=($filter) ? $filter_data['perihal'] : ''?> -->
    <!--                                    </div>-->
    <!--                                </div>-->
    <!--                                <div class="col-md-3">-->
    <!--                                    <div class="form-group">-->
    <!--                                        <label class="control-label">Klasifikasi Berkas</label>-->
    <!--                                        <input type="text" id="" name="hash_id" placeholder="Masukkan No. Registrasi Sistem" class="form-control" placeholder="" value=""> isi value : <-?=($filter) ? $filter_data['hash_id'] : ''?>-->
    <!--                                    </div>-->
    <!--                                </div>-->
    <!--                                <div class="col-md-3">-->
    <!--                                    <div class="form-group">-->
    <!--                                        <label class="control-label">Tgl. Pembuatan Berkas</label>-->
    <!--                                        <input type="text" class="form-control" name="tgl_buat" id="datepicker" placeholder="Pilih Tanggal Penerimaan" value=""> isi value : <-?=($filter) ? $filter_data['tgl_buat'] : ''?>  -->
    <!--                                    </div>-->
    <!--                                </div>-->
    <!--                                -->
    <?php
    //                                if ($user_level == 'Administrator') {
//                                ?>
    <!--                                    <div class="col-md-3">-->
    <!--                                        <div class="form-group">-->
    <!--                                            <label class="control-label">SKPD Pembuat</label>-->
    <!--                                            <select name="id_skpd_pengirim" class="form-control select2">-->
    <!--                                                <option value="">Semua SKPD</option>-->
    <!--                                            </select>-->
    <!--                                        </div>-->
    <!--                                    </div>-->
    <!--                                -->
    <?php
    //                                }
//                                ?>
    <!--                            </div>-->
    <!--                        </div>-->
    <!--                        <div class="col-md-2 b-l text-center">-->
    <!--                            <div class="form-group">-->
    <!--                                <br>-->
    <!--                                <button type="submit" class="btn btn-primary m-t-5 btn-outline btn-block"><i class="ti-filter"></i> Filter</button>-->
    <!--                            </div>-->
    <!--                        </div>-->
    <!--                    </form>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--        </div>-->
    <!--    </div>-->
    <!-- Note : 
    1. Tujuan ketika submit
    2. Value objek input
    -->
    <!-- end search -->

    <div class="row m-t-5 m-b-5">
        <div class="col-md-3 justify-content-between">
            <a href="<?php echo base_url('naskah/arsip_dinamis/berkas_aktif/berkas_baru'); ?>" style="font-size: 15px;"
                class="btn btn-lg btn-rounded btn-primary btn-block m-t-20"><span class="btn-label"><i
                        class="fa fa-plus"></i></span>Berkas Baru</a>
            <button style="font-size: 15px;" class="btn btn-lg btn-rounded btn-primary btn-block btn-pemindahan-berkas"
                data-toggle="modal" data-target="#modal_pemindahan_berkas"><span class="btn-label"><i
                        data-icon="&#xe003;" class="linea-icon linea-elaborate"></i></span>Pemindahan</button>
        </div>
        <!-- Note : tujuan link belum sesuai -->

        <!-- begin status berkas -->
        <div class="col-md-9">
            <div class="white-box" style="border-left: solid 3px #6003c8">
                <div class="row">
                    <div class="col-md-2 col-sm-2 text-center b-r" style="min-height:70px;">
                        <img src="<?php echo base_url('asset/logo/surat.png'); ?>" width="80px" height="60px" alt="">
                    </div>
                    <div class="col-md-10 col-sm-10">
                        <div class="row b-b">
                            <div class="col-md-12 text-center" style="color: #6003c8">
                                <b>STATUS BERKAS</b>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 text-center b-r">
                                <h3 class="box-title m-b-0">
                                    <?= (!empty($totalFiles)) ? $totalFiles : 0; ?>
                                    <!--?=count($total)?-->
                                </h3>
                                <a style="color: #6003c8" href="<?= base_url('surat_eksternal/surat_keluar') ?>">Total
                                    Berkas</a>
                            </div>
                            <div class="col-md-3 text-center b-r ">
                                <h3 class="box-title m-b-0">
                                    <?= (!empty($totalFilesProcess)) ? $totalFilesProcess : 0; ?>
                                    <!--?=count($selesai)?-->
                                </h3>
                                <a style="color: #6003c8"
                                    href="<?= base_url('surat_eksternal/surat_keluar') ?>/status_surat/selesai">Proses
                                    Pemberkasan</a>
                            </div>

                            <div class="col-md-3 text-center b-r">
                                <h3 class="box-title m-b-0">
                                    <?= (!empty($totalFilesClosed)) ? $totalFilesClosed : 0; ?>
                                    <!--?=count($perlu_tanggapan)?-->
                                </h3>
                                <a style="color: #6003c8"
                                    href="<?= base_url('surat_eksternal/surat_keluar') ?>/status_surat/perlu_tanggapan">Berkas
                                    Ditutup</a>
                            </div>
                            <div class="col-md-3 text-center b-r ">
                                <h3 class="box-title m-b-0">
                                    <?= (!empty($totalFilesExpired)) ? $totalFilesExpired : 0; ?>
                                    <!--?=count($dalam_proses)?-->
                                </h3>
                                <a style="color: #6003c8"
                                    href="<?= base_url('surat_eksternal/surat_keluar') ?>/status_surat/dalam_proses">Memasuki
                                    Batas Pindah</a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Note : sesuaikan jumlah data dengan data yang tampil pada saat link di klik , icon status berkas 
    -->
    <!-- end status berkas -->

    <!-- begin table -->
    <div class="row">
        <div class="col-md-12">
            <div class="white-box">
                <?php if (isset($status) && !empty($status)) {
                    $tipe = (!empty($status) && $status = 200) ? "success" : "danger";
                    ?>
                    <div class="alert alert-<?= $tipe; ?> alert-dismissible fade in m-b-10 m-t-5" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                aria-hidden="true">×</span>
                        </button>
                        <label>
                            <?= $message; ?>
                        </label>
                    </div>
                <?php } ?>

                <table class="table table-responsive table-hover text-center" id="berkas_aktif_table">
                    <thead>
                        <tr>
                            <th width="5%" class="text-center">#</th>
                            <th></th>
                            <th width="5%" class="text-center">No.</th>
                            <th width="15%" class="text-center">Kode Klasifikasi</th>
                            <th width="25%" class="text-center">Nama Berkas</th>
                            <th width="10%" class="text-center">Kurun Waktu</th>
                            <th width="10%" class="text-center">Jumlah Item</th>
                            <th width="10%" class="text-center">Akhir Retensi Aktif</th>
                            <th width="20%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="row-data">
                        <?php if (!empty($files)) {
                            $no = 1;
                            foreach ($files as $file) { ?>
                                <tr>
                                    <td></td>
                                    <td>
                                        <?= $file->id_surat_berkas; ?>
                                    </td>
                                    <td>
                                        <?= $no++; ?>
                                    </td>
                                    <td>
                                        <?= $file->id_surat_klasifikasi->kode_gabungan; ?>
                                    </td>
                                    <td>
                                        <?= $file->nama_berkas; ?>
                                    </td>
                                    <td>
                                        <?= $file->id_surat_klasifikasi->kurun_waktu; ?>
                                    </td>
                                    <td>
                                        <?= $file->jumlah_item; ?>
                                    </td>
                                    <td>
                                        <?= $file->id_surat_klasifikasi->akhir_retensi_aktif; ?>
                                    </td>
                                    <td>
                                        <a href="<?= base_url('naskah/arsip_dinamis/berkas_aktif/view?x_slug=' . $file->slug . '&for=details') ?>"
                                            class="btn btn-sm btn-info"><i class="fa fa-info-circle"></i></a>
                                    
                                        <button type="button" class="btn btn-sm btn-danger x-btn-delete"
                                            id="<?= $file->slug ?>"><i class="fa fa-trash"></i></button>
                                    </td>
                                </tr>
                            <?php }
                        } ?>
                    </tbody>

                </table>
            </div>
        </div>
    </div>
    <!-- end table -->

    <!-- End Container Fluid -->
</div>

<div class="modal fade" id="modal_pemindahan_berkas" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Konfirmasi Pemindahan Berkas</h4>
            </div>
            <form action="#">
                <div class="modal-body">
                    <div id="loading_berkas_pemindahan" class="justify-content-center align-items-center">
                        <div id="message_loading_berkas" class="alert alert-success text-center" role="alert">Loading...
                        </div>
                        <div id="message_error_berkas" class="alert alert-danger" role="alert">Maaf! Anda belum memilih
                            berkas aktif.</div>
                    </div>
                    <div class="form_berkas_aktif_pemindahan">
                        <div class="form-group">
                            <label for="berkas_aktif_selected">Berkas yang dipilih</label>
                            <input type="text" class="form-control" name="berkas_selected" id="berkas_selected"
                                placeholder="daftar berkas yang dipilih" readonly required>
                        </div>
                        <div class="row" id="card_row">

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary btn_submit_pindah_berkas">Pindahkan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="<?php echo base_url() . "asset/pixel/"; ?>plugins/bower_components/sweetalert/sweetalert.min.js"></script>
<script
    src="<?php echo base_url() . "asset/pixel/"; ?>plugins/bower_components/sweetalert/jquery.sweet-alert.custom.js"></script>
<script
    src="<?php echo base_url() . "asset/pixel/plugins/bower_components/datatables/"; ?>jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/select/1.3.4/js/dataTables.select.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>

<script>
    $("#form_berkas_aktif_pemindahan").hide();
    $("#message_error_berkas").hide();
    $("#loading_berkas_pemindahan").show();
    $("#berkas_selected").hide();
    $(".btn_submit_pindah_berkas").attr('disabled', true);

    var berkas_aktif_table = $('#berkas_aktif_table').DataTable({
        columnDefs: [{
            orderable: false,
            className: 'select-checkbox',
            targets: 0
        },
        {
            targets: 1,
            visible: false,
            searchable: false
        }
        ],
        select: {
            style: 'multiple',
            selector: 'td:first-child'
        },
        order: [
            [1, 'asc']
        ]
    });

    $('.btn-pemindahan-berkas').click(function () {
        $("#loading_berkas_pemindahan").show();
        $(".form_berkas_aktif_pemindahan").hide();
        $("#message_error_berkas").hide();
        $("#message_loading_berkas").show();

        var data = berkas_aktif_table.rows({
            selected: true
        }).data().pluck(1).toArray();

        if (data.length > 0) {
            $("#berkas_selected").val(data);

            setTimeout(function () {
                $.get("<?= base_url('naskah/arsip_dinamis/berkas_aktif/get_selected') ?>", {
                    params: data
                }, function (data, status) {
                    var dao = JSON.parse(data);

                    if (dao.status == 200) {
                        $(dao.result).each(function (i) {
                            $("#card_row").append('<div class="col-md-3">' +
                                '<div class="thumbnail">' +
                                '<div class="caption">' +
                                '<h4>' + dao.result[i].nama_berkas + '</h4><hr>' +
                                '<p>' + dao.result[i].id_surat_klasifikasi.kode_gabungan + ' - ' + dao.result[i].id_surat_klasifikasi.nama_klasifikasi + '</p>' +
                                '</div>' +
                                '</div>' +
                                '</div>');
                        });
                        $(".btn_submit_pindah_berkas").attr('disabled', false);
                    } else {
                        $("#modal_pemindahan_berkas").hide();
                        swal("Kesalahan", "Maaf terjadi kesalahan saat memuat data.", "error");
                    }

                })
                    .done(function () {
                        $("#message_loading_berkas").hide();
                        $(".form_berkas_aktif_pemindahan").show();
                    })
                    .fail(function () {
                        $("#message_loading_berkas").hide();
                        $(".form_berkas_aktif_pemindahan").hide();
                        $("#message_error_berkas").show();
                    })
            }, 1000);
        } else {
            $("#message_error_berkas").show();
            $("#message_loading_berkas").hide();
        }
    });

    $('#berkas_aktif_table').on('click', '.x-btn-delete', function () {
        var berkas = this.id;
        swal({
            title: "Apakah Anda yakin akan menghapusnya?",
            text: "Jika telah dihapus, maka tidak bisa dikembalikan kembali!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Ya",
            cancelButtonText: "Batal",
            closeOnConfirm: false,
            closeOnCancel: false
        }, function (isConfirm) {
            if (isConfirm) {
                $.ajax({
                    url: "<?= base_url('naskah/arsip_dinamis/Berkas_aktif/delete_berkas') ?>",
                    method: "post",
                    data: {
                        berkas: berkas
                    },
                    success: function (data) {
                        var dao = JSON.parse(data);

                        if (dao.status == 200) {
                            swal({
                                title: "Berhasil",
                                text: "Berkas berhasil dihapus",
                                type: "success"
                            }, function () {
                                location.reload();
                            });

                        } else {
                            swal({
                                title: "Gagal",
                                text: "Berkas gagal dihapus! Silahkan coba lagi",
                                type: "error"
                            }, function () {
                                location.reload();
                            });
                        }
                    }
                });
            } else {
                swal("Anda membatalkan penghapusan", "error");
            }
        });
    });
</script>