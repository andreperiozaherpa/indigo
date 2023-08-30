<?php
if ($detail->jenis_surat == "internal") {
    $jenis_surat = "surat_internal";
} elseif ($detail->jenis_surat == "eksternal") {
    $jenis_surat = "surat_eksternal";
}

if ($detail->status_penomoran == 'Y') {
    $color1 = "success";
    $color2 = "#00c292";
    $icon = "icon-envelope-open";
    $icon2 = "icon-check";
    $detail->status_penomoran = 'Sudah Diregistrasi';
} elseif ($detail->status_penomoran == "N") {
    $color1 = "warning";
    $color2 = "#f8c255";
    $icon = "icon-clock";
    $icon2 = "icon-info";
    $detail->status_penomoran = 'Belum Diregistrasi';
} elseif ($detail->status_penomoran == "T") {
    $color1 = "danger";
    $color2 = "#F75B36";
    $icon = "icon-close";
    $icon2 = "ti-close";
    $detail->status_penomoran = 'Ditolak';
}
?>
<script src="//mozilla.github.io/pdf.js/build/pdf.js"></script>
<div class="container-fluid">

    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Penomoran <?= ucwords(humanize($jenis_surat)); ?></h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li class="active">Detail</li>
            </ol>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">
        <div class="col-md-12">
            <?php
            if (isset($message)) {
            ?>
            <div class="alert alert-<?= $type ?>"><?= $message ?></div>
            <?php
            }
            ?>
        </div>
    </div>
    <div class="col-md-12">
        <a href="<?= base_url('penomoran_surat') ?>" class="pull-right btn btn-primary btn-outline"><i
                class="ti-back-left"></i> Kembali</a>
        <button onclick="show_monitoring();" data-toggle="modal" data-target="#monitoring"
            class="m-r-10 pull-right btn btn-info"><i class="ti-zoom-in"></i> Monitoring Surat</button>
        <br><br>
    </div>
    <div class="col-md-3">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_content">
                    <div class="col-md-12 col-sm-6">
                        <div class="panel panel-primary">
                            <div class="panel-body" style="border-top: solid 5px #6003C8">
                                <div class="row b-b">
                                    <div class="text-center">
                                        <p>
                                            <i style="font-size: 70px;" class="text-<?= $color1 ?> <?= $icon ?>"></i>
                                        </p>
                                        <p>
                                            <span class="text-<?= $color1 ?>">
                                                <i style="background-color: <?= $color2 ?>;border-radius: 50%;color: #fff;padding: 5px;"
                                                    class="<?= $icon2 ?>"></i> <?= $detail->status_penomoran ?>
                                            </span>
                                        </p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <h6>Pembuat Surat</h6>
                                        <h5> <b><?= $detail->nama_skpd ?></b></h5>
                                        <h5><?= $detail->nama_lengkap_input . " - " . $detail->nama_unit_kerja_input ?>
                                        </h5>
                                        <span class="badge"
                                            style="background-color: grey;font-size:10px;"><?= tanggal($detail->tgl_buat) ?></span>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <h6>Penerima</h6>
                                        <?php
                                        foreach ($penerima as $p) {
                                        ?>

                                        <div
                                            style="margin-bottom:10px;border: solid 1px #cdcdcd;text-align: left !important;padding:4px">
                                            <?php
                                                if ($p->jenis_surat == 'internal') {
                                                ?>

                                            <?php
                                                    ?>
                                            <small style="display: block"><i style="color: #5D03C1" class="ti-user"></i>
                                                <?= $p->nama_lengkap ?></small>
                                            <small style="display: block"><i style="color: #5D03C1"
                                                    class="ti-bar-chart"></i> <?= $p->nama_jabatan ?></small>
                                            <?php } elseif ($p->jenis_surat == 'eksternal' && $p->jenis_penerima == 'skpd') {
                                                ?>
                                            <small style="display: block"><i data-icon="&#xe030;" style="color: #5D03C1"
                                                    class="linea-icon linea-aerrow fa-fw"></i>Kepala
                                                <?= $p->nama_skpd ?></small>
                                            <?php
                                                } else {
                                                ?>
                                            <small style="display: block"><i style="color: #5D03C1"
                                                    class="ti-flag-alt"></i> <?= $p->nama_penerima ?></small>
                                            <small style="display: block"><i style="color: #5D03C1"
                                                    class="ti-location-pin"></i> <?= $p->alamat_penerima ?></small>
                                            <?php
                                                }
                                                ?>

                                        </div>
                                        <?php
                                        } ?>
                                        <center>
                                            <span class="badge"
                                                style="background-color: grey;font-size:10px;"><?= tanggal($detail->tgl_surat) ?></span>
                                        </center>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                        if (!empty($detail->file_lampiran)) { ?>
                        <div class="panel panel-primary">
                            <div class="panel-body">
                                <h3 style="color: #6003C8">LAMPIRAN SURAT</h3>
                                <div class="text-center">
                                    <i class="ti-file" style="font-size: 100px"></i>
                                    <p style="margin-top: 10px"><?= $detail->file_lampiran ?></p>
                                    <a target="blank"
                                        href="<?= base_url('data/' . $jenis_surat . '/lampiran/' . $detail->file_lampiran . '') ?>"
                                        style="color: #fff" class="btn btn-primary btn-block"><i
                                            class="ti-cloud-down"></i> Download Lampiran</a>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-9">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-body" style="border-top: solid 5px #6003C8">
                        <h3 style="color: #6003C8" class="box-title"><?= $detail->nama_surat ?></h3>
                        <br>
                        <div class="col-md-6">
                            <table class="table b-b">
                                <tr>
                                    <td style="width: 100px;">No Surat </td>
                                    <td>:</td>
                                    <td> <strong><?= $detail->nomer_surat ?></strong>
                                </tr>
                                <tr>
                                    <td style="width: 100px;">Perihal </td>
                                    <td>:</td>
                                    <td> <strong><?= $detail->perihal ?></strong>
                                </tr>
                            </table>
                        </div>
                        <!--/span-->
                        <div class="col-md-6">
                            <table class="table b-b">
                                <tr>
                                    <td style="width: 200px">Nomor Registrasi Sistem</td>
                                    <td>:</td>
                                    <td> <strong><?= ucwords($detail->hash_id) ?></strong>
                                </tr>
                                <tr>
                                    <td>Sifat</td>
                                    <td>:</td>
                                    <td> <strong><?= ucwords($detail->sifat_surat) ?></strong>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-body">

                    <?php
                    if ($detail->status_ttd == "sudah_ditandatangani") {
                        $viewer = "https://docs.google.com/viewer?url=" . base_url('data/' . $jenis_surat . '/ttd/' . $detail->file_ttd . '');
                        $viewer = base_url() . '/ViewerJS/#../' . 'data/' . $jenis_surat . '/ttd/' . $detail->file_ttd;
                        $m_icon = "ti-check";
                        $m_alert = "success";
                        $m_text = "Surat ini telah selesai ditandatangani dan sudah diteruskan ke penerima.";
                    } else {
                        $name =  $detail->file_verifikasi;
                        $ext = explode('.', $name)[1];
                        if ($ext == "docx") {
                            $viewer = "https://view.officeapps.live.com/op/embed.aspx?src=" . base_url('data/' . $jenis_surat . '/keluar/' . $detail->file_verifikasi . '');
                        } else {
                            // $viewer = "https://docs.google.com/viewer?url=" . base_url('data/' . $jenis_surat . '/draf_pdf/' . $detail->file_verifikasi . '');
                            $viewer = base_url() . '/ViewerJS/#../' . 'data/' . $jenis_surat . '/draf_pdf/' . $detail->file_verifikasi;
                        }
                        $m_icon = "ti-info";
                        $m_alert = "danger";
                        $m_text = "Dokumen dibawah ini hanya versi preview (pratinjau), untuk melihat dokumen asli silahkan download surat ini.";
                    }
                    ?>
                    <div class="alert alert-<?= $m_alert ?>">
                        <i class="<?= $m_icon ?>"></i> <?= $m_text ?>
                    </div>
                    <iframe src="<?= $viewer ?>" width="100%" height="900" style="border: none;"></iframe>
                </div>
            </div>
            <div class="white-box">
                <div class="row" style="margin-bottom: 15px">
                    <span style="float: left">
                        <?php
                        if ($detail->status_penomoran == 'Sudah Diregistrasi') {
                            $a_type = 'primary';
                            $icon = 'ti-check';
                            $a_message = '<i class="ti-check"></i> Surat sudah dilakukan penomoran.';
                        } elseif ($detail->status_penomoran == 'Ditolak') {
                            $a_type = 'danger';
                            $icon = 'ti-alert';
                            $a_message = '<i class="ti-alert"></i> Surat telah ditolak, dengan alasan : <b>' . $detail->alasan_penolakan_penomoran . '</b>';
                        } else {
                            $a_type = 'danger';
                            $icon = 'ti-alert';
                            $a_message = '<i class="ti-alert"></i> Surat belum diregistrasi nomor, silahkan klik tombol Download dibawah untuk melakukan proses penomoran surat setelah itu klik tombol Register lalu upload kembali.';
                        }
                        ?>
                        <h5 class="box-title"><i
                                style="color:#fff;background-color: #6003C8;padding: 5px;border-radius: 50%"
                                class="ti-check-box"></i> <span style="border-bottom: solid 2px #6003C8">Penomoran
                                Surat</span></h5>
                    </span>
                    <span style="float: right;text-align: center;margin-top: -10px;">
                        <p style="display: block;margin:2px">Status Penomoran</p>
                        <i style="position: absolute;z-index: 999;color:#fff;background-color: #6003C8;padding: 6px;border-radius: 50%;margin-top: -2px"
                            class="<?= $icon ?>"></i> <span
                            style="position: relative;padding:6px;border :solid 1px #cdcdcd;color:#6003C8 "
                            class="label"><span
                                style="margin-left: 22px"><?= normal_string($detail->status_penomoran) ?></span></span>
                    </span>
                </div>
                <div class="alert alert-<?= $a_type ?>">
                    <?= $a_message ?>
                </div> <?php

                        if ($detail->status_ttd == "sudah_ditandatangani") {
                        ?>
                <div class="form-group">
                    <label>No. Surat</label>
                    <p><?= $detail->nomer_surat ?></p>
                </div>
                <a href="<?= base_url('data/' . $jenis_surat . '/ttd/' . $detail->file_ttd . '') ?>"
                    class="btn btn-primary" type="button"><span class="btn-label"><i class="ti-cloud-down"></i></span>
                    Download Surat Selesai TTD</a>
                <?php
                        } else {
                            if ($detail->status_penomoran == 'Sudah Diregistrasi') {
                    ?>
                <div class="form-group">
                    <label>No. Surat</label>
                    <p><?= $detail->nomer_surat ?></p>
                </div>
                <a href="javascript:void(0)" data-toggle="modal" data-target="#myModal" class="btn btn-default"
                    type="button"><span class="btn-label"><i class="ti-check-box"></i></span> Registrasi Ulang Nomor</a>
                <?php
                            } else {
                    ?>
                <a href="javascript:void(0)" data-toggle="modal" data-target="#myModal" class="btn btn-primary"
                    type="button"><span class="btn-label"><i class="ti-check-box"></i></span> Register Nomor</a>
                <?php } ?>
                <!-- <a href="<?= base_url('data/' . $jenis_surat . '/draf_pdf/' . $detail->file_verifikasi . '') ?>" -->
                <a href="<?= base_url('penomoran_surat/download/' . $detail->id_surat_keluar) ?>"
                    class="btn btn-primary" type="button"><span class="btn-label"><i class="ti-cloud-down"></i></span>
                    Download Surat</a>
                <?php
                            if ($detail->status_penomoran !== 'Sudah Diregistrasi') {
                    ?>
                <button class="btn btn-default btn-outline" type="button" data-toggle="modal"
                    data-target="#mdTolak"><span class="btn-label"><i class="ti-back-left"></i></span>Kembalikan ke
                    Draf</button>
                <?php
                            }
                        } ?>
            </div>

        </div>
    </div>

    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Penomoran Surat</h4>
                </div>
                <div class="modal-body">
                    <form method="POST" enctype="multipart/form-data" id="formRegister">
                        <?php
                        if ($detail_ref->ttd_dinamis == 1) {
                        ?>
                        <div class="alert alert-warning">
                            <i class="ti-alert"></i> <b>Perhatian!</b>
                            <p>Surat ini menggunakan tandatangan dinamis, silahkan atur posisi tandatangan dengan
                                mengklik tombol "Ubah Posisi Tandatangan".</p>
                        </div>
                        <?php } ?>
                        <div class="form-group">
                            <label>No. Surat</label>
                            <input type="text" class="form-control" name="nomer_surat" placeholder="Masukkan No. Surat"
                                value="<?= $detail->nomer_surat ?>">
                            <input type="hidden" class="form-control" name="jenis_surat"
                                placeholder="Masukkan No. Surat" value="<?= $jenis_surat ?>">
                        </div>
                        <?php
                        if ($detail_ref->ttd_dinamis != 1) {
                        ?>

                        <label>File Surat (.pdf)</label>
                        <input type="file" name="file_verifikasi" class="dropify">
                        <?php
                        } else {
                        ?>
                        <div class="form-group">
                            <label style="display:block">Posisi Tandatangan</label>
                            <div id="statusPosisi">
                                <?php
                                    if ($detail->posisi_ttd == "Y") {
                                    ?>
                                <span class="text-success">Sudah Diatur</span>
                                <?php
                                    } else {
                                    ?>
                                <span class="text-danger">Belum Diatur</span>
                                <?php
                                    }
                                    ?>
                            </div>
                            <input type="hidden" class="form-control" name="posisi_ttd"
                                value="<?= $detail->posisi_ttd ?>">
                            <input type="hidden" class="form-control" name="posisi_llx"
                                value="<?= $detail->posisi_llx ?>">
                            <input type="hidden" class="form-control" name="posisi_lly"
                                value="<?= $detail->posisi_lly ?>">
                            <input type="hidden" class="form-control" name="posisi_urx"
                                value="<?= $detail->posisi_urx ?>">
                            <input type="hidden" class="form-control" name="posisi_ury"
                                value="<?= $detail->posisi_ury ?>">
                            <button id="btnSetPosisi" class="btn btn-primary" type="button"><span class="btn-label"><i
                                        class="ti-pencil"></i></span> Ubah Posisi Tandatangan</button>

                        </div>
                        <?php
                        }
                        ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-rounded" data-dismiss="modal"><i
                            class="ti-close"></i> Tutup</button>
                    <?php
                    if ($detail_ref->ttd_dinamis == 1) {
                    ?>
                    <button type="button" onclick="registerNomor()" class="btn btn-primary btn-rounded"><i
                            class="ti-check-box"></i> Register
                        Nomor</button>
                    <?php
                    } else {
                    ?>
                    <button type="submit" class="btn btn-primary btn-rounded"><i class="ti-check-box"></i> Register
                        Nomor</button>
                    <?php
                    }
                    ?>
                    </form>
                </div>
            </div>

        </div>
    </div>


    <div id="mdTolak" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Tolak Registrasi Surat</h4>
                </div>
                <div class="modal-body">
                    <form method="POST">
                        <div class="form-group">
                            <label>Alasan Penolakan</label>
                            <textarea class="form-control" name="alasan_penolakan_penomoran"
                                placeholder="Masukkan Alasan Penolakan"></textarea>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    <button class="btn btn-primary" type="submit" name="tolak"><span class="btn-label"><i
                                class="ti-back-left"></i></span>Kembalikan ke Draf</button>
                    </form>
                </div>
            </div>

        </div>
    </div>


    <div id="monitoring" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Monitoring Surat</h4>
                </div>
                <div class="modal-body" id="monitoring-body">
                    loading..
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-rounded" data-dismiss="modal"><i
                            class="ti-close"></i> Tutup</button>
                </div>
            </div>

        </div>
    </div>

    <div id="modalPosisi" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Set Posisi Tandatangan</h4>
                </div>
                <div class="modal-body">
                    <center>

                        <div>
                            <button id="prev" class="btn btn-primary btn-sm">Previous</button>
                            <button id="next" class="btn btn-primary btn-sm">Next</button>
                            &nbsp; &nbsp;
                            <span>Halaman : <span id="page_num"></span> / <span id="page_count"></span></span>
                        </div>
                        <canvas id="the-canvas" style="border:solid 1px #f6f6f6"></canvas>

                        <div>
                            llx <span id="llx"></span>
                            lly <span id="lly"></span>
                            urx <span id="urx"></span>
                            ury <span id="ury"></span>
                        </div>

                    </center>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-rounded" data-dismiss="modal"><i
                            class="ti-close"></i> Tutup</button>
                    <button type="button" id="btnSimpanPosisi" class="btn btn-primary btn-rounded"><i
                            class="ti-check-box"></i> Simpan Posisi</button>
                    </form>
                </div>
            </div>

        </div>
    </div>

    <script type="text/javascript">
    function show_monitoring() {
        $.post("<?= base_url('monitoring_surat_keluar/detail/' . $detail->id_surat_keluar) ?>", {}, function(obj) {
            $('#monitoring-body').html(obj);
        });
    }
    $('#btnSimpanPosisi').click(function() {
        $('#modalPosisi').modal('hide');
        $('[name="posisi_ttd"]').val("Y");
        $('#statusPosisi').html('<span class="text-success">Sudah Diatur</span>')
        $('#myModal').modal('show');
    });
    //btnSetPosisi on click
    $('#btnSetPosisi').click(function() {
        $('#myModal').modal('hide');
        $('.container-fluid').block({
            message: '<h4><i class="fa fa-spinner fa-spin"></i> Loading...</h4>',
            css: {
                border: '1px solid #fff'
            }
        });
        $.getJSON('<?= base_url('penomoran_surat/initSpecimen/' . $detail->id_surat_keluar) ?>', function(
        data) {
            $('.container-fluid').unblock();
            if (data.status) {
                $('#modalPosisi').modal('show');
                var imageTTD = 'data:image/png;base64,' + data.data.image_ttd;
                var img = null;
                var pdfData = atob(data.data.file_pdf);

                // Loaded via <script> tag, create shortcut to access PDF.js exports.
                var pdfjsLib = window['pdfjs-dist/build/pdf'];

                // The workerSrc property shall be specified.
                pdfjsLib.GlobalWorkerOptions.workerSrc =
                    '//mozilla.github.io/pdf.js/build/pdf.worker.js';

                var pdfDoc = null,
                    pageNum = 1,
                    pageRendering = false,
                    pageNumPending = null,
                    canvas = document.getElementById('the-canvas'),
                    ctx = canvas.getContext('2d');
                flag = false;
                let isShapeExist = false;
                var prevX = 0,
                    currX = 0,
                    prevY = 0,
                    currY = 0,
                    baseX = 0,
                    baseY = 0,
                    w, llx, lly, urx, ury, dvcRatio,
                    h;
                scale = 1;
                dot_flag = false;
                first_pinch = true;
                first_init = true;

                let shapeX, shapeY, shapeWidth, shapeHeight;

                let isDragging = false;
                let isResize = false;
                let resizeDirection = '';



                var ori_img;


                function init() {
                    w = canvas.width;
                    h = canvas.height;

                    dvcRatio = 1;
                    console.log(dvcRatio);

                    canvas.addEventListener("mousemove", function(e) {
                        findxy('move', e)
                    }, false);
                    canvas.addEventListener("mousedown", function(e) {
                        findxy('down', e)
                    }, false);
                    canvas.addEventListener("mouseup", function(e) {
                        findxy('up', e)
                    }, false);
                    canvas.addEventListener("mouseout", function(e) {
                        findxy('out', e)
                    }, false);


                    ori_img = ctx.getImageData(0, 0, w, h);
                    ctx.clearRect(0, 0, w, h);
                    ctx.putImageData(ori_img, 0, 0);
                    drawRect(0, 0, 200, 100);
                }

                function findxy(res, e) {
                    if (res == 'down') {
                        // console.log("DOWN action");
                        baseX = e.clientX;
                        baseY = e.clientY;
                        if (isMouseInRightBottomCorner(e.clientX, e.clientY) || isMouseInLeftTopCorner(e
                                .clientX, e.clientY) || isMouseInRightTopCorner(e.clientX, e.clientY) ||
                            isMouseInLeftBottomCorner(e.clientX, e.clientY)) {
                            isResize = true;
                            isDragging = false;
                            if (isMouseInRightBottomCorner(e.clientX, e.clientY)) {
                                resizeDirection = 'rightBottom';
                            } else if (isMouseInLeftTopCorner(e.clientX, e.clientY)) {
                                resizeDirection = 'leftTop';
                            } else if (isMouseInRightTopCorner(e.clientX, e.clientY)) {
                                resizeDirection = 'rightTop';
                            } else if (isMouseInLeftBottomCorner(e.clientX, e.clientY)) {
                                resizeDirection = 'leftBottom';
                            }


                        } else if (isMouseInShape(e.clientX, e.clientY)) {
                            isResize = false;
                            isDragging = true;
                        } else {
                            isResize = false;
                            isDragging = false;
                            if (isShapeExist) {
                                ctx.clearRect(0, 0, w, h);
                                ctx.putImageData(ori_img, 0, 0);
                                shapeHeight = img.height * (shapeWidth / img.width);
                                ctx.drawImage(img, shapeX, shapeY, shapeWidth, shapeHeight);
                            }
                        }
                    }
                    if (res == 'up') {
                        // console.log("UP action");
                        flag = false;
                        isDragging = false;
                        isResize = false;
                        if (isShapeExist) {
                            if (isMouseInShape(e.clientX, e.clientY)) {
                                ctx.clearRect(0, 0, w, h);
                                ctx.putImageData(ori_img, 0, 0);
                                shapeHeight = img.height * (shapeWidth / img.width);
                                ctx.drawImage(img, shapeX, shapeY, shapeWidth, shapeHeight);
                                ctx.strokeStyle = "#6003c8";
                                ctx.lineWidth = 2;
                                ctx.beginPath();
                                ctx.rect(shapeX, shapeY, shapeWidth, shapeHeight);
                                ctx.stroke();
                                ctx.closePath();
                                ctx.fillStyle = "#6003c8";
                                ctx.fillRect(shapeX + shapeWidth - 5, shapeY + shapeHeight - 5, 10, 10);
                                ctx.fillRect(shapeX - 5, shapeY + shapeHeight - 5, 10, 10);
                                ctx.fillRect(shapeX + shapeWidth - 5, shapeY - 5, 10, 10);
                                ctx.fillRect(shapeX - 5, shapeY - 5, 10, 10);
                            }
                        }
                        // console.log("Dest X >>>" + e.clientX);
                        // console.log("Dest Y >>>" + e.clientY);
                    }
                    if (res == 'out') {
                        flag = false;
                        isDragging = false;
                        isResize = false;
                    }
                    if (res == 'move') {
                        if (isMouseInRightBottomCorner(e.clientX, e.clientY) || isMouseInLeftTopCorner(e
                                .clientX, e.clientY)) {
                            canvas.style.cursor = "nwse-resize";
                        } else if (isMouseInRightTopCorner(e.clientX, e.clientY) ||
                            isMouseInLeftBottomCorner(e.clientX, e.clientY)) {
                            canvas.style.cursor = "nesw-resize";

                        } else if (isMouseInShape(e.clientX, e.clientY)) {
                            canvas.style.cursor = "move";
                        } else {
                            canvas.style.cursor = "default";
                        }

                        // console.log("MOVE action");
                        if (flag) {
                            prevX = currX;
                            prevY = currY;
                            currX = e.clientX;
                            currY = e.clientY;
                            drawRect();
                        }

                        if (isDragging) {
                            event.preventDefault();
                            var kotak = canvas.getBoundingClientRect();
                            let mouseX = parseInt(e.clientX);
                            let mouseY = parseInt(e.clientY);



                            let dy = mouseY - baseY;
                            let dx = mouseX - baseX;
                            shapeX += dx;
                            shapeY += dy;

                            // console.log("dx: " + dx + " dy: " + dy);

                            ctx.clearRect(0, 0, w, h);
                            ctx.putImageData(ori_img, 0, 0);
                            shapeHeight = img.height * (shapeWidth / img.width);
                            ctx.drawImage(img, shapeX, shapeY, shapeWidth, shapeHeight);

                            getCoordinate();
                            baseX = mouseX;
                            baseY = mouseY;
                        }

                        if (isResize) {
                            event.preventDefault();
                            var kotak = canvas.getBoundingClientRect();
                            let mouseX = parseInt(e.clientX);
                            let mouseY = parseInt(e.clientY);

                            let dy = mouseY - baseY;
                            let dx = mouseX - baseX;
                            if (resizeDirection == 'rightBottom') {
                                shapeWidth += dx;
                                shapeHeight += dy;
                            } else if (resizeDirection == 'leftTop') {
                                shapeWidth -= dx;
                                shapeHeight -= dy;
                                shapeX += dx;
                                shapeY += dy;
                            } else if (resizeDirection == 'rightTop') {
                                shapeWidth += dx;
                                shapeHeight -= dy;
                                shapeY += dy;
                            } else if (resizeDirection == 'leftBottom') {
                                shapeWidth -= dx;
                                shapeHeight += dy;
                                shapeX += dx;
                            }

                            ctx.clearRect(0, 0, w, h);
                            ctx.putImageData(ori_img, 0, 0);

                            shapeHeight = img.height * (shapeWidth / img.width);
                            ctx.drawImage(img, shapeX, shapeY, shapeWidth, shapeHeight);
                            ctx.strokeStyle = "#6003c8";
                            ctx.lineWidth = 2;
                            ctx.beginPath();
                            ctx.setLineDash([0]);
                            ctx.rect(shapeX, shapeY, shapeWidth, shapeHeight);
                            ctx.stroke();
                            ctx.closePath();
                            ctx.fillStyle = "#6003c8";
                            ctx.fillRect(shapeX + shapeWidth - 5, shapeY + shapeHeight - 5, 10, 10);
                            ctx.fillRect(shapeX - 5, shapeY + shapeHeight - 5, 10, 10);
                            ctx.fillRect(shapeX + shapeWidth - 5, shapeY - 5, 10, 10);
                            ctx.fillRect(shapeX - 5, shapeY - 5, 10, 10);

                            getCoordinate();
                            baseX = mouseX;
                            baseY = mouseY;
                        }

                    }
                }


                function drawRect(sX = '', sY = '', sW = '', sH = '') {
                    /*Get viewport by calling getBoundingClientRect() function*/
                    var kotak = canvas.getBoundingClientRect();
                    var lenX = currX - baseX;
                    var lenY = currY - baseY;

                    var srcX = baseX - kotak.left;
                    var srcY = baseY - kotak.top;
                    var dstX = srcX + lenX;
                    var dstY = srcY + lenY;
                    if (sX !== '' && sY !== '' && sW !== '' && sH !== '') {
                        shapeX = sX * dvcRatio;
                        shapeY = sY * dvcRatio;
                        shapeWidth = sW * dvcRatio;
                    } else {
                        shapeX = srcX * dvcRatio;
                        shapeY = srcY * dvcRatio;
                        shapeWidth = lenX * dvcRatio;
                    }
                    // shapeHeight = lenY * dvcRatio;




                    //Redraw canvas to its first 'state'
                    ctx.clearRect(0, 0, w, h);
                    ctx.putImageData(ori_img, 0, 0);

                    // Draw Rectangle above the canvas

                    img = new Image();
                    img.src = imageTTD;
                    img.onload = function() {
                        shapeHeight = (img.height * (shapeWidth / img.width)) * dvcRatio;
                        ctx.drawImage(img, shapeX, shapeY, shapeWidth, shapeHeight);
                        ctx.strokeStyle = "#6003c8";
                        ctx.lineWidth = 2;
                        ctx.beginPath();
                        ctx.rect(shapeX, shapeY, shapeWidth, shapeHeight);
                        ctx.stroke();
                        ctx.closePath();
                        ctx.fillStyle = "#6003c8";
                        ctx.fillRect(shapeX + shapeWidth - 5, shapeY + shapeHeight - 5, 10, 10);
                        ctx.fillRect(shapeX - 5, shapeY + shapeHeight - 5, 10, 10);
                        ctx.fillRect(shapeX + shapeWidth - 5, shapeY - 5, 10, 10);
                        ctx.fillRect(shapeX - 5, shapeY - 5, 10, 10);

                        isShapeExist = true;
                        getCoordinate();
                    };
                }

                function getCoordinate() {
                    var kotak = canvas.getBoundingClientRect();


                    var trans_x1 = shapeX;
                    var trans_x2 = shapeX + shapeWidth;
                    var trans_y1 = h / dvcRatio - (shapeY / dvcRatio);
                    var trans_y2 = h / dvcRatio - (shapeY + shapeHeight);

                    // console.log("fake" + trans_x1, trans_x2, trans_y1, trans_y2);

                    llx = (trans_x1 <= trans_x2) ? trans_x1 : trans_x2;
                    urx = (trans_x1 > trans_x2) ? trans_x1 : trans_x2;
                    lly = (trans_y1 <= trans_y2) ? trans_y1 : trans_y2;
                    ury = (trans_y1 > trans_y2) ? trans_y1 : trans_y2;
                    $('[name="posisi_llx"]').val(llx / scale);
                    $('[name="posisi_lly"]').val(lly / scale);
                    $('[name="posisi_urx"]').val(urx / scale);
                    $('[name="posisi_ury"]').val(ury / scale);

                    $('#llx').html(llx / scale);
                    $('#lly').html(lly / scale);
                    $('#urx').html(urx / scale);
                    $('#ury').html(ury / scale);


                }

                function isMouseInShape(x, y) {
                    var rect = canvas.getBoundingClientRect();
                    x = x - rect.left;
                    y = y - rect.top;

                    let shapeLeft = shapeX;
                    let shapeRight = shapeX + shapeWidth;
                    let shapeTop = shapeY;
                    let shapeBottom = shapeY + shapeHeight;

                    if (x > shapeLeft && x < shapeRight && y > shapeTop && y < shapeBottom) {
                        return true;
                    } else {
                        return false;
                    }
                }

                function isMouseInRightBottomCorner(x, y) {
                    var rect = canvas.getBoundingClientRect();
                    x = x - rect.left;
                    y = y - rect.top;

                    let shapeLeft = shapeX + shapeWidth - 5;
                    let shapeRight = shapeX + shapeWidth + 5;
                    let shapeTop = shapeY + shapeHeight - 5;
                    let shapeBottom = shapeY + shapeHeight + 5;

                    if (x > shapeLeft && x < shapeRight && y > shapeTop && y < shapeBottom) {
                        return true;
                    } else {
                        return false;
                    }
                }

                function isMouseInLeftTopCorner(x, y) {
                    var rect = canvas.getBoundingClientRect();
                    x = x - rect.left;
                    y = y - rect.top;

                    let shapeLeft = shapeX - 5;
                    let shapeRight = shapeX + 5;
                    let shapeTop = shapeY - 5;
                    let shapeBottom = shapeY + 5;

                    if (x > shapeLeft && x < shapeRight && y > shapeTop && y < shapeBottom) {
                        return true;
                    } else {
                        return false;
                    }
                }

                function isMouseInLeftBottomCorner(x, y) {
                    var rect = canvas.getBoundingClientRect();
                    x = x - rect.left;
                    y = y - rect.top;

                    let shapeLeft = shapeX - 5;
                    let shapeRight = shapeX + 5;
                    let shapeTop = shapeY + shapeHeight - 5;
                    let shapeBottom = shapeY + shapeHeight + 5;

                    if (x > shapeLeft && x < shapeRight && y > shapeTop && y < shapeBottom) {
                        return true;
                    } else {
                        return false;
                    }
                }

                function isMouseInRightTopCorner(x, y) {
                    var rect = canvas.getBoundingClientRect();
                    x = x - rect.left;
                    y = y - rect.top;

                    let shapeLeft = shapeX + shapeWidth - 5;
                    let shapeRight = shapeX + shapeWidth + 5;
                    let shapeTop = shapeY - 5;
                    let shapeBottom = shapeY + 5;

                    if (x > shapeLeft && x < shapeRight && y > shapeTop && y < shapeBottom) {
                        return true;
                    } else {
                        return false;
                    }
                }

                /**
                 * Get page info from document, resize canvas accordingly, and render page.
                 * @param num Page number.
                 */
                function renderPage(num) {
                    pageRendering = true;
                    // Using promise to fetch the page
                    pdfDoc.getPage(num).then(function(page) {
                        var viewport = page.getViewport({
                            scale: scale
                        });
                        canvas.height = viewport.height;
                        canvas.width = viewport.width;
                        console.log("canvas.height: " + canvas.height);
                        console.log("canvas.width: " + canvas.width);
                        // Render PDF page into canvas context
                        var renderContext = {
                            canvasContext: ctx,
                            viewport: viewport
                        };
                        var renderTask = page.render(renderContext);

                        // Wait for rendering to finish
                        renderTask.promise.then(function() {
                            pageRendering = false;
                            init();
                            if (pageNumPending !== null) {
                                // New page rendering is pending
                                renderPage(pageNumPending);
                                pageNumPending = null;
                            }
                        });
                    });

                    // Update page counters
                    document.getElementById('page_num').textContent = num;
                }

                /**
                 * If another page rendering in progress, waits until the rendering is
                 * finised. Otherwise, executes rendering immediately.
                 */
                function queueRenderPage(num) {
                    if (pageRendering) {
                        pageNumPending = num;
                    } else {
                        renderPage(num);
                    }
                }

                /**
                 * Displays previous page.
                 */
                function onPrevPage() {
                    if (pageNum <= 1) {
                        return;
                    }
                    pageNum--;
                    queueRenderPage(pageNum);
                }
                document.getElementById('prev').addEventListener('click', onPrevPage);

                /**
                 * Displays next page.
                 */
                function onNextPage() {
                    if (pageNum >= pdfDoc.numPages) {
                        return;
                    }
                    pageNum++;
                    queueRenderPage(pageNum);
                }
                document.getElementById('next').addEventListener('click', onNextPage);

                /**
                 * Asynchronously downloads PDF.
                 */
                pdfjsLib.getDocument({
                    data: pdfData
                }).promise.then(function(pdfDoc_) {
                    pdfDoc = pdfDoc_;
                    document.getElementById('page_count').textContent = pdfDoc.numPages;

                    // Initial/first page rendering
                    renderPage(pageNum);
                });
            }
        });
    });
    </script>

    <script>
    function registerNomor() {
        //ajax post penomoran_surat/actionPenomoran
        $.ajax({
            url: "<?php echo base_url('penomoran_surat/actionPenomoran') ?>",
            type: "POST",
            data: $('#formRegister').serialize() + "&id_surat_keluar=<?= $detail->id_surat_keluar ?>",
            dataType: "JSON",
            success: function(data) {
                //if success close modal and reload ajax table
                $('.container-fluid').unblock();
                if (data.status) {
                    swal({
                        title: "Berhasil!",
                        text: "Data berhasil disimpan",
                        type: "success",
                        showCancelButton: false,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "OK",
                        closeOnConfirm: false
                    });
                    window.location.reload();
                    $('#modalPenomoran').modal('hide');
                } else {
                    // alert(data.message);
                    swal({
                        title: "Gagal!",
                        text: data.message,
                        type: "error",
                        showCancelButton: false,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "OK",
                        closeOnConfirm: false
                    });
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                $('.container-fluid').unblock();
                alert('Error adding / update data');
            },
            beforeSend: function() {
                $('.container-fluid').block({
                    message: '<i class="fa fa-spinner fa-spin"></i> Loading...',
                    overlayCSS: {
                        backgroundColor: '#fff',
                        opacity: 0.8,
                        cursor: 'wait'
                    },
                    css: {
                        border: 0,
                        padding: 0,
                        backgroundColor: 'none'
                    }
                });
            }
        });
    }
    </script>