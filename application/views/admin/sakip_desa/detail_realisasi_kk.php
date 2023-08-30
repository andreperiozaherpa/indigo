<style>
    th,
    td {
        vertical-align: middle !important;
    }

    td {
        background-color: #fff !important;
    }
</style>
<div class="container-fluid">

    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Detail Rumah Tangga Miskin</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li>Rumah Tangga Miskin</li>
                <li class="active">Detail</li>
            </ol>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">
        <div class="col-md-12">
            <a href="<?= base_url('sakip_desa/detail/' . $detail_target->id_skpd) ?>" class="btn btn-primary btn-outline pull-right m-b-10">Kembali</a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="white-box">
                <div class="row">
                    <form method="POST">
                        <div class="col-md-3 b-r">
                            <center><img style="width: 80%" src="https://e-office.sumedangkab.go.id/data/logo/skpd/sumedang.png" alt="user" class="img-circle" /> </center>
                        </div>
                        <div class="col-md-9">

                            <div class="panel panel-primary">
                                <div class="panel-heading"> <?= $detail_skpd->nama_skpd ?>
                                    <div class="pull-right"><a href="#" data-perform="panel-collapse"><i class="ti-minus"></i></a> </div>
                                </div>
                                <div class="panel-wrapper collapse in" aria-expanded="true">
                                    <div class="panel-body">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <tr>
                                                    <td style="width: 120px;">Nama Kepala </td>
                                                    <td>:</td>
                                                    <td> <strong><?= $kepala_skpd->nama_lengkap ?></strong>
                                                </tr>
                                                <tr>
                                                    <td style="width: 120px;">Alamat SKPD </td>
                                                    <td>:</td>
                                                    <td> <strong><?= $detail_skpd->alamat_skpd ?></strong>
                                                </tr>
                                                <tr>
                                                    <td style="width: 120px;">Email/tlp </td>
                                                    <td>:</td>
                                                    <td> <strong><?= $detail_skpd->email_skpd ?> / <?= $detail_skpd->telepon_skpd ?></strong>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading text-center">
                    Target <?= $detail_target->nama_indikator ?>
                </div>
                <div class="panel-wrapper collapse in" aria-expanded="true">
                    <div class="panel-body">
                        <?php
                        if (empty($detail_target->target)) {
                        ?>
                            <div class="alert alert-warning">
                                Anda belum mengisi Target KK / Target KK masih 0
                            </div>
                        <?php
                        } else {
                        ?>
                            <hr>
                            <h3 class="box-title text-purple">DAFTAR KELUARGA MISKIN <span class="label label-primary">Target : <?= $detail_target->target ?></span> </h3>
                            <div class="table-responsive dragscroll">
                                <table class="table color-table muted-table table-bordered" style="margin-top:10px">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No.</th>
                                            <th class="text-center">No. KK</th>
                                            <th class="text-center">Nama Kepala Keluarga</th>
                                            <th class="text-center">Alamat</th>
                                            <th class="text-center">Status Realisasi</th>
                                            <th class="text-center">Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        if (empty($list)) {
                                        ?>
                                            <tr>
                                                <td colspan="5">
                                                    <center>Belum ada data</center>
                                                </td>
                                            </tr>
                                            <?php
                                        } else {
                                            foreach ($list as $l) {
                                            ?>
                                                <tr>
                                                    <td class="text-center"><?= $no ?></td>
                                                    <td><?= $l->no_kk ?></td>
                                                    <td class="text-center"><?= $l->nama_kepala_keluarga ?></td>
                                                    <td class="text-center"><?= $l->alamat ?>, Desa <?= $l->desa ?>, Kecamatan <?= $l->kecamatan ?></td>
                                                    <td class="text-center"><?= status_realisasi_kk($l->status_realisasi) ?></td>
                                                    <td class="text-center">
                                                        <a href="javascript:void(0)" onclick="updateRealisasiKK(<?= $l->id_sd_target_indikator_kk ?>)" class="btn btn-sm btn-primary" style="color:white;"><i class="ti-medall"></i>Update Realisasi</a>
                                                    </td>
                                                </tr>
                                        <?php $no++;
                                            }
                                        } ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div id="modalSearchKK" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Detail KK</h4>
            </div>
            <div class="modal-body">
                <table>
                    <tr>
                        <td style="font-weight: 500;">Nomor KK</td>
                        <td width="30px" class="text-center">:</td>
                        <td id="noKK">3211193328477</td>
                    </tr>
                    <tr>
                        <td style="font-weight: 500;">Nama Kepala Keluarga</td>
                        <td class="text-center">:</td>
                        <td id="namaKepala">Dadang Sulaiman</td>
                    </tr>
                    </tr>
                    <tr>
                        <td style="font-weight: 500;">Alamat</td>
                        <td class="text-center">:</td>
                        <td id="Alamat">TALUN KALER RT.02 RW.07 KEL. TALUN</td>
                    </tr>
                </table>

                <hr>
                <table class="table" id="tabelKeluarga">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Lengkap</th>
                            <th>NIK</th>
                            <th>Jenis Kelamin</th>
                            <th>Tempat, Tanggal Lahir</th>
                            <th>Jenis Pekerjaan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Dadang Sulaiman</td>
                            <td>3211193393716</td>
                            <td>Laki-laki</td>
                            <td>Sumedang, 2 Juli 1978</td>
                            <td>Buruh Harian Lepas</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Cicih Sukaesih</td>
                            <td>3211193393938</td>
                            <td>Perempuan</td>
                            <td>Sumedang, 5 Juni 1980</td>
                            <td>Ibu Rumah Tangga</td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Rizky Ramadhan</td>
                            <td>3211193393013</td>
                            <td>Laki-laki</td>
                            <td>Sumedang, 18 Agustus 2000</td>
                            <td>Belum / Tidak Bekerja</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="updateTargetKK()"><i class="ti-check"></i> Tambahkan</button>
                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="ti-close"></i> Tutup</button>
            </div>
        </div>

    </div>
</div>



<div id="modalHapusKK" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Konfirmasi Hapus</h4>
            </div>
            <div class="modal-body">
                Apakah Anda yakin akan menghapus keluarga ini?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="btnHapusTargetKK" onclick="hapusTargetKK()"><i class="ti-check"></i> Ya</button>
                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="ti-close"></i> Tidak</button>
            </div>
        </div>

    </div>
</div>
<div id="modalRealisasiKK" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Update Realisasi KK</h4>
            </div>
            <div class="modal-body">
                <form id="formRealisasi">
                    <div class="form-group">
                        <label>Bukti Realisasi</label>
                        <input type="file" name="bukti_realisasi" class="dropify">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="btnSaveRealisasiKK" onclick="saveRealisasiKK()"><i class="ti-check"></i> Simpan</button>
                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="ti-close"></i> Tutup</button>
            </div>
        </div>

    </div>
</div>



<script>
    function searchKK() {
        var no_kk = $('[name="no_kk"]').val();
        $.getJSON("<?= base_url('rtangga_miskin/getKK/' . $detail_target->id_skpd) ?>/" + no_kk + "/<?= $detail_target->id_sd_target_indikator ?>", function(data) {
            if (data.status) {
                $('#noKK').html(data.data.no_kk);
                $('#namaKepala').html(data.data.nama_kepala_keluarga);
                $('#Alamat').html(data.data.alamat + ", Desa " + data.data.desa + ", Kecamatan " + data.data.kecamatan);
                var tabel = '';
                var no = 1;
                $.each(data.data.keluarga, function(key, val) {
                    tabel += '<tr> <td>' + no + '</td><td>' + val.nama_lengkap + '</td><td>' + val.nik + '</td><td>' + val.jenis_kelamin + '</td><td>' + val.tempat_lahir + ', ' + val.tanggal_lahir_string + '</td><td>' + val.pekerjaan + '</td></tr>';
                    no++;
                });
                $('#tabelKeluarga > tbody').html(tabel);
                $('#modalSearchKK').modal('show');
            } else {
                swal("Oops", data.message, "error");
            }
        });
    }

    function updateTargetKK() {
        var no_kk = $('[name="no_kk"]').val();
        $.post("<?= base_url('rtangga_miskin/updateTarget/' . $detail_target->id_sd_target_indikator) ?>/", {
            no_kk: no_kk
        }, function(data) {
            if (data) {
                $('#modalSearchKK').modal('hide');
                swal("Berhasil", "Target KK Berhasil Disimpan!", "success");
                location.reload(false);
            } else {
                alert('Terjadi kesalahan');
            }
        });
    }

    function modalHapusTargetKK(id_sd_target_indikator_kk) {
        $('#btnHapusTargetKK').attr('onclick', 'hapusTargetKK(' + id_sd_target_indikator_kk + ')');
        $('#modalHapusKK').modal('show');
    }

    function hapusTargetKK(id_sd_target_indikator_kk = '') {
        if (id_sd_target_indikator_kk !== '') {
            $.post("<?= base_url('rtangga_miskin/hapusTarget/') ?>", {
                id_sd_target_indikator_kk: id_sd_target_indikator_kk
            }, function(data) {
                if (data) {
                    swal("Berhasil", "Target KK Berhasil Dihapus!", "success");
                    location.reload(false);
                } else {
                    alert('Terjadi kesalahan');
                }
            });
        }
    }

    function updateRealisasiKK(id_sd_target_indikator_kk) {
        $.getJSON("<?= base_url('rtangga_miskin/getDetailTargetKK') ?>/" + id_sd_target_indikator_kk, function(data) {
            if (data.bukti_realisasi !== '') {
                var drEvent = $('[name="bukti_realisasi"]').dropify({
                    defaultFile: ''
                });
                drEvent = drEvent.data('dropify');
                drEvent.resetPreview();
                drEvent.clearElement();
                drEvent.settings.defaultFile = '<?= base_url('data/bukti_realisasi') ?>/' + data.bukti_realisasi;
                drEvent.destroy();
                drEvent.init();
            }
            $('#btnSaveRealisasiKK').attr('onclick', 'saveRealisasiKK(' + id_sd_target_indikator_kk + ')');
            $('#modalRealisasiKK').modal('show');
        });
    }

    function saveRealisasiKK(id_sd_target_indikator_kk) {
        var fd = new FormData($("#formRealisasi")[0]);
        //fd.append("CustomField", "This is some extra data");
        $.ajax({
            url: '<?= base_url('rtangga_miskin/updateRealisasi') ?>/' + id_sd_target_indikator_kk,
            type: 'POST',
            data: fd,
            success: function(data) {
                if (data) {
                    $('#modalRealisasiKK').modal('hide');
                    swal("Berhasil", "Realisasi Berhasil Disimpan!", "success");
                    location.reload(false);
                } else {
                    alert('Terjadi kesalahan');
                }
            },
            cache: false,
            contentType: false,
            processData: false
        });
        //     var formData = new FormData($('#formRealisasi')[0]);
        //     $.post("<?= base_url('rtangga_miskin/updateRealisasi') ?>/" + id_sd_target_indikator_kk, formData, function(data) {
        //     // if (data) {
        //     //   $('#modalUpdateRealisasi').modal('hide');
        //     //   swal("Berhasil", "Realisasi Berhasil Disimpan!", "success");
        //     //   location.reload(false);
        //     // } else {
        //     //   alert('Terjadi kesalahan');
        //     // }
        //   });
    }
</script>