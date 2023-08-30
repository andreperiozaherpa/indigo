<style>
    .panel-warning a {
        color: #FFFFFF !important;
    }

    .label-white {
        background-color: #FFFFFF;
        color: blueviolet;
    }
</style>
<div class="container-fluid">

    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Koreksi LKE - <?= $nama ?></h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li>Lembar Kerja Evaluasi</li>
                <li>Koreksi</li>
                <li class="active"><?= $nama ?></li>
            </ol>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    
<div class="row">
	<div class="col-md-12">
		<div class="white-box">
			<div class="row">
        <form method="POST">
        <div class="col-md-3 b-r">
          <center><img style="width: 80%" src="<?php echo base_url()."data/logo/bnpt.png" ;?>" alt="user" class="img-circle"/>   </center>
        </div>
        <div class="col-md-9">
          <div class="panel panel-primary">
            <div class="panel-heading"> <?=$detail_skpd->nama_skpd?>
                <div class="pull-right"><a href="#" data-perform="panel-collapse"><i class="ti-minus"></i></a>  </div>
            </div>
            <div class="panel-wrapper collapse in" aria-expanded="true">
                <div class="panel-body">
                  <div class="table-responsive">
                    <table class="table">
                        <tr><td style="width: 120px;">Nama Kepala </td><td>:</td><td> <strong><?=$kepala_skpd->nama_lengkap?></strong></tr>
                        <tr><td style="width: 120px;">Alamat SKPD </td><td>:</td><td> <strong><?=$detail_skpd->alamat_skpd?></strong></tr>
                        <tr><td style="width: 120px;">Email/tlp </td><td>:</td><td> <strong><?=$detail_skpd->email_skpd?> / <?=$detail_skpd->telepon_skpd?></strong>
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
</div>
    <div class="row">
        <div class="col-md-12">
            <div class="white-box">
                <?php
                if (isset($message)) {
                ?>
                    <div class="alert alert-<?= $message_type ?>"><?= $message ?></div>
                <?php } ?>
                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                    <?php
                    foreach ($indikator as $n => $i) { ?>
                        <div class="panel panel-inverse">
                            <div class="panel-heading" role="tab" id="heading<?= $n ?>">
                                <h4 class="panel-title">
                                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse<?= $n ?>" aria-expanded="true" aria-controls="collapse<?= $n ?>">
                                        <?= normal_string($i->nama_indikator) ?> <span class="label label-white"><?= $i->nilai ?></span>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapse<?= $n ?>" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading<?= $n ?>">
                                <div class="panel-body">
                                    <div class="panel-group" id="accordion<?= $n ?>" role="tablist" aria-multiselectable="true">
                                        <?php
                                        $indikator2 = $this->lembar_kerja_evaluasi_model->get_indikator_by_induk($i->id_lke_indikator, false, $id_skpd);
                                        foreach ($indikator2 as $n2 => $i2) {
                                            $n2 = "level2" . $n . $n2;
                                        ?>
                                            <div class="panel panel-primary">
                                                <div class="panel-heading" role="tab" id="heading<?= $n2 ?>">
                                                    <h4 class="panel-title">
                                                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion<?= $n ?>" href="#collapse<?= $n2 ?>" aria-expanded="true" aria-controls="collapse<?= $n2 ?>">
                                                            <?= normal_string($i2->nama_indikator) ?> <span class="label label-white"><?= $i2->nilai ?></span>
                                                        </a>
                                                    </h4>
                                                </div>
                                                <div id="collapse<?= $n2 ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading<?= $n2 ?>">
                                                    <div class="panel-body">
                                                        <div class="panel-group" id="accordion<?= $n2 ?>" role="tablist" aria-multiselectable="true">
                                                            <?php
                                                            $indikator3 = $this->lembar_kerja_evaluasi_model->get_indikator_by_induk($i2->id_lke_indikator, false, $id_skpd);

                                                            foreach ($indikator3 as $n3 => $i3) {
                                                                $n3 = "level3" . $n2 . $n3;
                                                            ?>
                                                                <div class="panel panel-info">
                                                                    <div class="panel-heading" role="tab" id="heading<?= $n3 ?>">
                                                                        <h4 class="panel-title">
                                                                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion<?= $n2 ?>" href="#collapse<?= $n3 ?>" aria-expanded="true" aria-controls="collapse<?= $n3 ?>">
                                                                                <?= normal_string($i3->nama_indikator) ?> <span class="label label-white"><?= $i3->nilai ?></span>
                                                                            </a>
                                                                        </h4>
                                                                    </div>
                                                                    <div id="collapse<?= $n3 ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading<?= $n3 ?>">
                                                                        <div class="panel-body">

                                                                            <div class="panel-group" id="accordion<?= $n3 ?>" role="tablist" aria-multiselectable="true">
                                                                                <?php
                                                                                $indikator4 = $this->lembar_kerja_evaluasi_model->get_indikator_by_induk($i3->id_lke_indikator, false, $id_skpd);
                                                                                foreach ($indikator4 as $n4 => $i4) {
                                                                                    $n4 = "level4" . $n3 . $n4;
                                                                                ?>
                                                                                    <div class="panel panel-warning">
                                                                                        <div class="panel-heading" role="tab" id="heading<?= $n4 ?>">
                                                                                            <h4 class="panel-title">
                                                                                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion<?= $n3 ?>" href="#collapse<?= $n4 ?>" aria-expanded="true" aria-controls="collapse<?= $n4 ?>">
                                                                                                    <?= normal_string($i4->nama_indikator) ?> <span class="label label-white"><?= $i4->nilai ?></span>
                                                                                                </a>
                                                                                            </h4>
                                                                                        </div>
                                                                                        <div id="collapse<?= $n4 ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading<?= $n4 ?>">
                                                                                            <div class="panel-body">

                                                                                                <div class="table-responsive">
                                                                                                    <table id="tabel<?= $n4 ?>" class="table color-table muted-table">
                                                                                                        <thead>
                                                                                                            <tr>
                                                                                                                <th class="text-center" width="3%">No.</th>
                                                                                                                <th width="35%">Penilaian</th>
                                                                                                                <th width="12%">Pilihan Jawaban</th>
                                                                                                                <th>Jawaban</th>
                                                                                                                <th>Nilai</th>
                                                                                                                <th class="text-center" width="100px">Aksi</th>
                                                                                                            </tr>
                                                                                                        </thead>
                                                                                                        <tbody>
                                                                                                            <?php
                                                                                                            $indikator_jawaban = $this->lembar_kerja_evaluasi_model->get_indikator_by_induk($i4->id_lke_indikator, true, $id_skpd, true);
                                                                                                            if (empty($indikator_jawaban)) {
                                                                                                            ?>
                                                                                                                <tr>
                                                                                                                    <td colspan="4">
                                                                                                                        <center>Data tidak ditemukan</center>
                                                                                                                    </td>
                                                                                                                </tr>
                                                                                                                <?php
                                                                                                            } else {
                                                                                                                foreach ($indikator_jawaban as $k => $j) {
                                                                                                                    $no = $k + 1;
                                                                                                                ?>
                                                                                                                    <tr>
                                                                                                                        <td class="text-center"><?= $no ?></td>
                                                                                                                        <td><?= $j->nama_indikator ?></td>
                                                                                                                        <td><?= normal_string($j->alias_jenis_jawaban) ?></td>
                                                                                                                        <td>
                                                                                                                            <?= $j->jawaban ?>
                                                                                                                            <?php if ($j->jawaban_koreksi !== "Belum diisi") { ?>
                                                                                                                                <div class="alert alert-success" style="margin-top:10px">
                                                                                                                                <b>Koreksi :</b> <br>
                                                                                                                                    <?=$j->jawaban_koreksi?>
                                                                                                                                </div>
                                                                                                                            <?php } ?>
                                                                                                                        </td>
                                                                                                                        <td><?= $j->nilai ?>
                                                                                                                            <?php if ($j->jawaban_koreksi !== "Belum diisi") { ?>
                                                                                                                                <div class="alert alert-success" style="margin-top:10px">
                                                                                                                                    <?=$j->nilai_koreksi?>
                                                                                                                                </div>
                                                                                                                            <?php } ?></td>
                                                                                                                        <td class="text-center">
                                                                                                                            <?php if ($j->jawaban !== "Belum diisi") { ?>
                                                                                                                                <a href="javascript:void(0)" onclick="lihatJawaban(<?= $j->id_lke_jawaban ?>)" class="btn  btn-block mb-2 btn-sm btn-success">Detail Jawaban</a>
                                                                                                                                <?php if ($j->jawaban_koreksi == "Belum diisi") { ?>
                                                                                                                                    <a href="javascript:void(0)" onclick="isiKoreksi(<?= $j->id_lke_indikator ?>,'tabel<?= $n4 ?>',<?= $i4->id_lke_indikator ?>)" class="btn btn-block mb-2  btn-sm btn-warning">Koreksi</a>
                                                                                                                                <?php } else { ?>
                                                                                                                                    <a href="javascript:void(0)" onclick="lihatJawabanKoreksi(<?= $j->id_lke_jawaban_koreksi ?>)" class="btn btn-block mb-2  btn-sm btn-success">Detail Koreksi</a>
                                                                                                                                <?php } ?>
                                                                                                                            <?php } ?>
                                                                                                                        </td>
                                                                                                                    </tr>
                                                                                                            <?php
                                                                                                                }
                                                                                                            } ?>
                                                                                                        </tbody>
                                                                                                    </table>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                <?php } ?>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalJawaban" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myLargeModalLabel">Koreksi Jawaban</h4>
            </div>
            <div class="modal-body">
                <div id="message"></div>
                <form id="formJawaban" action="<?= base_url('lembar_kerja_evaluasi/post_jawaban_koreksi') ?>" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id_lke_indikator">
                    <input type="hidden" name="jenis_jawaban">
                    <input type="hidden" name="id_induk">
                    <input type="hidden" name="tabel">
                    <input type="hidden" name="id_skpd" value="<?=$id_skpd?>">
                    <small><b>Penilaian</b></small>
                    <p id="nama_indikator"></p>
                    <small><b>Jawaban</b></small>
                    <div id="jawaban"></div>
                    <small><b>Catatan / Keterangan / Penjelasan</b></small>
                    <textarea class="form-control" rows="5" placeholder="Masukkan Catatan / Keterangan / Penjelasan" name="catatan"></textarea>
            </div>
            <div class="modal-footer">
                <a href="javascript:void(0)" data-dismiss="modal" class="btn btn-default waves-effect text-left">Batal</a>
                <button type="submit" id="btnSimpan" class="btn btn-primary waves-effect text-left">Simpan</button>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="modalDetailJawaban" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myLargeModalLabel">Detail Jawaban</h4>
            </div>
            <div class="modal-body">

                <small><b>Penilaian</b></small>
                <p id="nama_indikator_jawaban"></p>
                <small><b>Jawaban</b></small>
                <p id="jawaban_jawaban"></p>
                <small><b>Catatan / Keterangan / Penjelasan</b></small>
                <p id="catatan_jawaban"></p>
                <div style="margin-top: 10px;">
                    <small><b>Lampiran / Evidence</b></small><br>
                    <a href="" target="blank" id="lampiran_jawaban" class="btn btn-primary btn-sm"><i class="ti-download"></i> Download Lampiran</a>
                </div>
            </div>
            <div class="modal-footer">
                <a href="javascript:void(0)" data-dismiss="modal" class="btn btn-default waves-effect text-left">Tutup</a>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="modalDetailJawabanKoreksi" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myLargeModalLabel">Detail Jawaban Koreksi</h4>
            </div>
            <div class="modal-body">

                <small><b>Penilaian</b></small>
                <p id="nama_indikator_jawabanKoreksi"></p>
                <small><b>Jawaban</b></small>
                <p id="jawaban_jawabanKoreksi"></p>
                <small><b>Catatan / Keterangan / Penjelasan</b></small>
                <p id="catatan_jawabanKoreksi"></p>
            </div>
            <div class="modal-footer">
                <a href="javascript:void(0)" data-dismiss="modal" class="btn btn-default waves-effect text-left">Tutup</a>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<script>
    function isiKoreksi(idIndikator, tabel, id_induk) {
        $("#message").html('');
        $("#jawaban").html('Jawaban belum tersedia');
        $('#formJawaban').find('input:text').val('');
        $('#formJawaban').find('textarea').val('');
        $.getJSON("<?= base_url('lembar_kerja_evaluasi/get_jawaban') ?>/" + idIndikator, function(data) {
            $('[name="id_lke_indikator"]').val(idIndikator);
            $('[name="id_induk"]').val(id_induk);
            $('[name="tabel"]').val(tabel);
            $('[name="jenis_jawaban"]').val(data.jenis_jawaban);
            $('#nama_indikator').html(data.nama_indikator);
            var html = '';
            if (data.jenis_jawaban == 'multiple') {
                $.each(data.jawaban, function(i, j) {
                    html += '<div class="radio radio-primary"><input type="radio" name="jawaban" id="radio' + i + '" value="' + j.id_lke_indikator_pilihan + '"><label for="radio' + i + '">' + j.penjelasan + '</label></div>';
                });
            } else {
                if (data.jawaban) {
                    html += data.jawaban.penjelasan;
                }
                if (data.jenis_jawaban == 'switch') {
                    html += '<div class="radio radio-primary"><input type="radio" name="jawaban" id="radio_ya" value="Ya"><label for="radio_ya">Ya</label></div>';
                    html += '<div class="radio radio-primary"><input type="radio" name="jawaban" id="radio_tidak" value="Tidak"><label for="radio_tidak">Tidak</label></div>';
                } else {
                    html += '<input style="margin-bottom:10px" placeholder="Masukkan ' + data.jenis_jawaban.charAt(0).toUpperCase() + data.jenis_jawaban.slice(1) + '" type="text" class="form-control" name="jawaban">';
                }
            }
            $('#jawaban').html(html);
            $('#modalJawaban').modal('show');
        });
    }

    function lihatJawaban(idJawaban) {
        $.getJSON("<?= base_url('lembar_kerja_evaluasi/get_detail_jawaban') ?>/" + idJawaban, function(data) {
            $('#nama_indikator_jawaban').html(data.nama_indikator);
            $('#jawaban_jawaban').html(data.jawaban);
            $('#catatan_jawaban').html(data.catatan);
            $('#lampiran_jawaban').attr('href', '<?= base_url('data/lampiran_lke') ?>/' + data.lampiran);
            $('#modalDetailJawaban').modal('show');
        });
    }

    function lihatJawabanKoreksi(idJawabanKoreksi) {
        $.getJSON("<?= base_url('lembar_kerja_evaluasi/get_detail_jawaban_koreksi') ?>/" + idJawabanKoreksi, function(data) {
            $('#nama_indikator_jawabanKoreksi').html(data.nama_indikator);
            $('#jawaban_jawabanKoreksi').html(data.jawaban);
            $('#catatan_jawabanKoreksi').html(data.catatan);
            $('#modalDetailJawabanKoreksi').modal('show');
        });
    }
    $(document).ready(function(e) {
        $("#formJawaban").on('submit', (function(e) {
            e.preventDefault();
            $.ajax({
                url: "<?= base_url('lembar_kerja_evaluasi/post_jawaban_koreksi') ?>",
                type: "POST",
                dataType: "JSON",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function() {
                    //$("#preview").fadeOut();
                    $("#message").fadeOut();
                    $("#btnSimpan").html('Menyimpan ...');
                },
                success: function(data) {
                    if (data.status == 0) {
                        $("#message").html('<div class="alert alert-warning">' + data.message + '</div>').fadeIn();
                    } else {
                        $("#message").html('<div class="alert alert-success">' + data.message + '</div>').fadeIn();
                        $('#' + data.tabel + ' tbody').html(data.data);
                        $('#modalJawaban').modal('hide');
                        swal("Sukses", data.message, "success");
                    }
                    $("#btnSimpan").html('Simpan');
                },
                error: function(e) {
                    $("#message").html('<div class="alert alert-danger">' + e + '</div>').fadeIn();
                    $("#btnSimpan").html('Simpan');
                }
            });
        }));
    });

    function simpanJawaban() {
        var id_lke_indikator = $('[name="id_lke_indikator"]').val();
        var jenis_jawaban = $('[name="jenis_jawaban"]').val();
        var jawaban;
        if (jenis_jawaban == 'multiple') {
            jawaban = $('input[name="jawaban"]:checked').val();
        } else {
            jawaban = $('input[name="jawaban"]').val();
        }
        var catatan = $('[name="catatan"]').val();
    }
</script>