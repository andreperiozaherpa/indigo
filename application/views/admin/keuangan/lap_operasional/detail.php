<div class="container-fluid">

    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title"> Rekonsiliasi Laporan Operasional</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="<?= base_url(); ?>admin">Dashboard</a></li>
                <li><a href="<?= base_url(); ?>keuangan/lap_operasional">Lap. Operasional</a></li>
                <li><a href="<?= base_url(); ?>keuangan/lap_operasional/detail">Detail</a></li>

            </ol>
        </div>
        <!-- /.col-lg-12 -->
    </div>

    <?php
    if (isset($message) OR isset($_GET['msg'])) {
    ?>
    <div class="alert alert-<?= (@$message_type)?$message_type:'inverse' ?> alert-dismissible" role="alert">
        <p><?= @$message ?></p>
        <p><?= @$_GET['msg'] ?></p>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true"><i class="feather icon-x-circle"></i></span>
        </button>
    </div>
    <?php
    }
    ?>


    <div class="row">
        <div class="col-md-12">
        </div>
    </div>
    <div class="col-md-12">
        <a href="<?= base_url(); ?>keuangan/lap_operasional" class="pull-right btn btn-primary btn-outline"><i
                class="ti-back-left"></i> Kembali</a><br><br>
    </div>
    <?php if (@$detail){ ?>
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
                                            <img src="https://e-office.sumedangkab.go.id/data/logo/skpd/sumedang.png"
                                                alt="user" width="200px">

                                        </p>
                                        <p>
                                            <?php if ($detail->status != "Selesai"): ?>
                                            <span class="text-danger">
                                                <i style="border-radius: 50%;color: #fff;padding: 5px;"
                                                    class="icon-close bg-danger"></i> <?=$detail->status;?> </span>
                                            <?php else: ?>
                                            <span class="text-success">
                                                <i style="border-radius: 50%;color: #fff;padding: 5px;"
                                                    class="icon-check bg-success"></i> <?=$detail->status;?> </span>
                                            <?php endif ?>
                                        </p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <h6 style="font-weight: 500">SKPD</h6>
                                        <h5><?=$detail->nama_skpd;?></h5>
                                    </div>
                                </div>
                                <hr>

                                <a href="<?= base_url(); ?>data/keuangan/tmp/<?=$detail->file_draft;?>"
                                    class="btn btn-primary btn-block btn-outline" target="_blank"><i
                                        class="ti-download"></i> Download Lampiran</a>
                                <?php if ($detail->status != "Selesai"): ?>
                                <hr>
                                <?php if (in_array('keuangan', explode(';', $this->session->userdata('user_privileges'))) OR $this->session->userdata('level') == "Administrator"): ?>
                                <a href="<?= base_url(); ?>keuangan/lap_operasional/edit/<?=encode($detail->id_laporan_operasional);?>"
                                    class="btn btn-info btn-block btn-outline"><i class="ti-pencil"></i> Edit BA</a>
                                <a href="javascript:void(0)" data-toggle="modal" data-target="#exampleModal"
                                    onclick="delete_ss_(<?=$detail->id_laporan_operasional;?>)"
                                    class="btn btn-danger btn-block btn-outline"><i class="fa fa-trash"></i> Hapus
                                    BA</a>
                                <button onclick="reset_dokumen()" class="btn btn-inverse btn-block btn-outline"><i
                                        class="ti-reload"></i> Reset
                                    Dokumen BA</button>
                                <hr>
                                <?php endif ?>
                                <?php 
                                    if($detail->file_signed_draft){
                                        ?>
                                <a style="color:white" href="<?=base_url('data/keuangan/'.$detail->file_signed_draft)?>"
                                    class="btn btn-primary btn-sm btn-block" target="blank">Download Draft</a>
                                <?php
                                    }
                                ?>
                                <!-- <button type="button" class="btn btn-warning btn-block btn-outline" onclick="openUploadPDF()"><i class="ti-upload"></i> <?=!empty($detail->file_signed_draft) ? 'Upload Ulang PDF' : 'Upload PDF'?></a></button> -->
                                <?php endif ?>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_content">
                                <div class="col-md-12 col-sm-6">
                                    <div class="white-box">
                                        <h4 class="box-title">Penandatangan - BPKAD</h4>
                                        <div class="message-center">
                                            <a href="#">
                                                <div class="user-img"> <img
                                                        src="<?= base_url(); ?>data/foto/pegawai/<?= empty($detail->foto1) ? 'user-default.png' : $detail->foto1 ?>"
                                                        alt="user" style="width:40px;height:40px; object-fit: cover;"
                                                        class="img-circle"> <span
                                                        class="profile-status online pull-right"></span> </div>
                                                <div class="mail-contnet">
                                                    <h5><?=$detail->nama_1_bpkad;?></h5> <span
                                                        class="mail-desc"><?=$detail->jabatan_1_bpkad;?></span><span
                                                        class="label label-rounded <?=label_status($detail->ttd_pegawai_1_bpkad)?>"><?=$detail->ttd_pegawai_1_bpkad;?></span>
                                                </div>
                                            </a>
                                            <a href="#" class="b-none">
                                                <div class="user-img"> <img
                                                        src="<?= base_url(); ?>data/foto/pegawai/<?= empty($detail->foto2) ? 'user-default.png' : $detail->foto2 ?>"
                                                        style="width:40px;height:40px; object-fit: cover;" alt="user"
                                                        class="img-circle"> <span
                                                        class="profile-status away pull-right"></span> </div>
                                                <div class="mail-contnet">
                                                    <h5><?=$detail->nama_2_bpkad;?></h5> <span
                                                        class="mail-desc"><?=$detail->jabatan_2_bpkad;?></span> <span
                                                        class="label label-rounded <?=label_status($detail->ttd_pegawai_2_bpkad)?>"><?=$detail->ttd_pegawai_2_bpkad;?></span>
                                                </div>
                                            </a>
                                            <!-- <a href="#">
                                                <div class="user-img"> <img src="<?= base_url(); ?>data/foto/pegawai/<?= empty($detail->foto3) ? 'user-default.png' : $detail->foto3 ?>" style="width:40px;height:40px; object-fit: cover;" alt="user" class="img-circle"> <span class="profile-status busy pull-right"></span> </div>
                                                <div class="mail-contnet">
                                                    <h5><?=$detail->nama_3_bpkad;?></h5> <span class="mail-desc"><?=$detail->jabatan_3_bpkad;?></span> <span class="label label-rounded label-warning"><?=$detail->ttd_pegawai_3_bpkad;?></span>
                                                </div>
                                            </a>

                                            <a href="#">
                                                <div class="user-img"> <img src="<?= base_url(); ?>data/foto/pegawai/<?= empty($detail->foto4) ? 'user-default.png' : $detail->foto4 ?>" style="width:40px;height:40px; object-fit: cover;" alt="user" class="img-circle"> <span class="profile-status busy pull-right"></span> </div>
                                                <div class="mail-contnet">
                                                    <h5><?=$detail->nama_4_bpkad;?></h5> <span class="mail-desc"><?=$detail->jabatan_4_bpkad;?></span> <span class="label label-rounded label-warning"><?=$detail->ttd_pegawai_4_bpkad;?></span>
                                                </div>
                                            </a> -->



                                        </div>
                                    </div>

                                    <div class="white-box">
                                        <h4 class="box-title">Verifikasi - SAREREA</h4>
                                        <div class="message-center">
                                            <a href="#">
                                                <div class="user-img"> <img
                                                        src="https://sarerea.sumedangkab.go.id/data/logo/e.png"
                                                        alt="user" style="width:40px;height:40px; object-fit: cover;"
                                                        class="img-circle"></div>
                                                <div class="mail-contnet">
                                                    <h5>PEMROSES</h5> <span class="mail-desc"></span> <span
                                                        class="label label-rounded <?=label_status($detail->status_verifikasi)?>"><?=$detail->status_verifikasi;?></span>
                                                </div>
                                            </a>
                                        </div>
                                    </div>


                                    <div class="white-box">
                                        <h4 class="box-title">Penandatangan - <?=$detail->nama_skpd;?></h4>
                                        <div class="message-center">
                                            <a href="#">
                                                <div class="user-img"> <img
                                                        src="<?= base_url(); ?>data/foto/pegawai/<?= empty($detail->foto5) ? 'user-default.png' : $detail->foto5 ?>"
                                                        style="width:40px;height:40px; object-fit: cover;" alt="user"
                                                        class="img-circle"> <span
                                                        class="profile-status busy pull-right"></span> </div>
                                                <div class="mail-contnet">
                                                    <h5><?=$detail->nama_1_skpd;?></h5> <span
                                                        class="mail-desc"><?=$detail->jabatan_1_skpd;?></span> <span
                                                        class="label label-rounded <?=label_status($detail->ttd_pegawai_1_skpd)?>"><?=$detail->ttd_pegawai_1_skpd;?></span>
                                                </div>
                                            </a>
                                            <a href="#">
                                                <div class="user-img"> <img
                                                        src="<?= base_url(); ?>data/foto/pegawai/<?= empty($detail->foto6) ? 'user-default.png' : $detail->foto6 ?>"
                                                        style="width:40px;height:40px; object-fit: cover;" alt="user"
                                                        class="img-circle"> <span
                                                        class="profile-status busy pull-right"></span> </div>
                                                <div class="mail-contnet">
                                                    <h5><?=$detail->nama_2_skpd;?></h5> <span
                                                        class="mail-desc"><?=$detail->jabatan_2_skpd;?></span> <span
                                                        class="label label-rounded <?=label_status($detail->ttd_pegawai_2_skpd)?>"><?=$detail->ttd_pegawai_2_skpd;?></span>
                                                </div>
                                            </a>
                                            <!-- <a href="#">
                                                <div class="user-img"> <img src="<?= base_url(); ?>data/foto/pegawai/<?= empty($detail->foto7) ? 'user-default.png' : $detail->foto7 ?>" style="width:40px;height:40px; object-fit: cover;" alt="user" class="img-circle"> <span class="profile-status busy pull-right"></span> </div>
                                                <div class="mail-contnet">
                                                    <h5><?=$detail->nama_3_skpd;?></h5> <span class="mail-desc"><?=$detail->jabatan_3_skpd;?></span> <span class="label label-rounded label-warning">><?=$detail->ttd_pegawai_3_skpd;?></span>
                                                </div>
                                            </a>

                                            <a href="#">
                                                <div class="user-img"> <img src="<?= base_url(); ?>data/foto/pegawai/<?= empty($detail->foto8) ? 'user-default.png' : $detail->foto8 ?>" style="width:40px;height:40px; object-fit: cover;" alt="user" class="img-circle"> <span class="profile-status busy pull-right"></span> </div>
                                                <div class="mail-contnet">
                                                    <h5><?=$detail->nama_4_skpd;?></h5> <span class="mail-desc"><?=$detail->jabatan_4_skpd;?></span> <span class="label label-rounded label-warning">><?=$detail->ttd_pegawai_4_skpd;?></span>
                                                </div>
                                            </a> -->


                                        </div>
                                    </div>


                                </div>
                                <!-- /.col -->
                            </div>

                        </div>
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

                        <h3 style="color: #6003C8" class="box-title"><span style="color: #222">Berita Acara Rekonsiliasi
                                Laporan Operasional </span></h3>

                        <br>
                        <div class="col-md-12">
                            <table class="table b-b">
                                <tbody>
                                    <tr>
                                        <td style="width: 100px;">Periode </td>
                                        <td>:</td>
                                        <td> <strong><?=tanggal($detail->tgl_periode);?> </strong></td>
                                    </tr>
                                    <tr>
                                        <td style="width: 100px;">Pengesahan</td>
                                        <td>:</td>
                                        <td> <strong><?=tanggal($detail->tgl_pengesahan);?> </strong></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!--/span-->

                    </div>
                </div>
            </div>
        </div>

        <?php if (!empty($detail->alasan_penolakan)): ?>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default" style="border-top: solid 5px #ff6849">
                    <blockquote class="alert alert-danger"><i class="icon-close"></i> Laporan Ditolak: <br />dengan
                        alasan - <?=$detail->alasan_penolakan?></blockquote>
                </div>
            </div>
        </div>
        <?php endif ?>

        <div class="">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <?php if($detail->file_signed_draft){
                                        ?>
                        <div class="alert alert-info">
                            <i class="ti-info"></i> Dokumen dibawah ini hanya versi preview (pratinjau), untuk melihat
                            dokumen asli silahkan download dokumen ini pada tombol <code>"Download Draft"</code>.
                        </div>
                        <iframe
                            src="https://docs.google.com/viewer?url=<?= base_url(); ?>data/keuangan/<?=($detail->status == "Selesai") ? $detail->file_signed : $detail->file_signed_draft?>&amp;embedded=true"
                            width="100%" height="700" style="border: none;"></iframe>
                        <?php } else {?>
                        <div class="alert alert-danger">
                            <i class="ti-info"></i> Dokumen Gagal Dimuat, Harap Lakukan <code>"Reset Dokumen BA"</code>.
                        </div>
                        <?php }?>
                    </div>
                    <div class="panel-footer">
                        <?php if (!empty($detail->file_signed_draft)): ?>
                        <?php if (
                        ($detail->ttd_pegawai_2_skpd == "belum" AND $this->session->userdata('id_pegawai') == $detail->id_pegawai_2_skpd) OR
                        ($detail->ttd_pegawai_1_skpd == "belum" AND $this->session->userdata('id_pegawai') == $detail->id_pegawai_1_skpd AND $detail->ttd_pegawai_2_skpd == "setuju") OR
                        ($detail->ttd_pegawai_2_bpkad == "belum" AND $this->session->userdata('id_pegawai') == $detail->id_pegawai_2_bpkad AND $detail->status_verifikasi == "setuju") OR
                        ($detail->ttd_pegawai_1_bpkad == "belum" AND $this->session->userdata('id_pegawai') == $detail->id_pegawai_1_bpkad AND $detail->ttd_pegawai_2_bpkad == "setuju")
                    ): ?>
                        <form method="POST">
                            <a href="javascript:void(0)" class="btn btn-primary" data-toggle="modal"
                                data-target="#passphrase"><span class="btn-label"><i class="ti-check"></i></span> Tanda
                                Tangani</a>
                            <a href="javascript:void(0)" class="btn btn-danger" data-toggle="modal"
                                data-target="#mdTolak"><span class="btn-label"><i class="ti-close"></i></span>Tolak</a>
                        </form>
                        <?php endif ?>
                        <?php endif ?>

                        <?php 
                                    if($detail->file_signed){
                                        ?>
                        <a style="color:white" href="<?=base_url('data/keuangan/'.$detail->file_signed)?>"
                            class="btn btn-primary btn-sm btn-block" target="blank">DOWNLOAD SURAT</a>
                        <?php
                                    }
                                ?>
                    </div>

                </div>

            </div>
        </div>
    </div>
    <?php }else{ ?>
    <div class="alert alert-danger">Maaf, data yang anda cari tidak ditemukan, mohon kembali ke halaman sebelumnya.
    </div>
    <?php } ?>

</div>

<div id="passphrase" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Passpharse Sertifikat Digital</h4>
            </div>
            <div class="modal-body">
                <div id="passMessage"></div>
                <form method="POST" enctype="multipart/form-data" id="ttdForm"
                    onsubmit="$('#passphrase').block();swal('Proses Penandatanganan','Mohon tunggu, jangan tutup laman ini ketika sistem sedang melakukan penandatanganan dokumen anda.','success')">
                    <label>Passpharse</label>
                    <input type="password" placeholder="Masukkan Passpharse sertifikat digital Anda" name="passkey"
                        class="form-control">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-rounded" data-dismiss="modal"><i class="ti-close"></i>
                    Tutup</button>
                <!-- <button class="btn btn-primary" type="button" id="btnTTD" name="terima" onclick="tandaTangani()"><span class="btn-label"><i class="ti-check"></i></span> Tanda Tangani</button> -->
                <button class="btn btn-primary" type="submit" name="terima"><span class="btn-label"><i
                            class="ti-check"></i></span> Tanda Tangani</button>
                </form>
            </div>
        </div>

    </div>
</div>

<script>
function tandaTangani() {
    $('#btnTTD').html('<span class="btn-label"><i class="fa fa-circle-o-notch fa-spin"></i></span> Menandatangani ...');
    $('#passMessage').html('');
    // $.ajaxSetup({
    //   timeout: 30000
    // });
    $.get("<?= base_url('dummy') ?>")
        .done(function() {
            $('#btnTTD').attr('type', 'submit');
            $('#btnTTD').click();
        })
        .fail(function() {
            $('#passMessage').html(
                '<div class="alert alert-danger">Tampaknya ada masalah pada Koneksi Internet Anda, silahkan coba lagi</div>'
                );
            $('#btnTTD').html('<span class="btn-label"><i class="ti-check"></i></span> Tanda Tangani');
        });
}

function reset_dokumen() {
    swal({
        title: "Apakah Anda Yakin?",
        text: "Setelah direset Dokumen akan dikembalikan ke Format awal, dan TTE yang sudah dilakukan terhadap dokumen ini akan terhapus!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Ya, Reset Dokumen!",
        cancelButtonText: "Batal!",
        closeOnConfirm: false,
        closeOnCancel: true
    }, function(isConfirm) {
        if (isConfirm) {
            location.href =
                "<?= base_url(); ?>keuangan/lap_operasional/reset_ulang/<?=encode($detail->id_laporan_operasional);?>";
            swal("Direset!", "Silakan periksa dokumen anda.", "success");
        }
    });
}
</script>

<div id="mdTolak" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Tolak Tandatangan Surat</h4>
            </div>
            <div class="modal-body">
                <form method="POST">
                    <div class="form-group">
                        <label>Alasan Penolakan</label>
                        <textarea class="form-control" name="alasan_penolakan_ttd"
                            placeholder="Masukkan Alasan Penolakan"></textarea>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                <button class="btn btn-primary" type="submit" name="tolak"><span class="btn-label"><i
                            class="ti-close"></i></span>Tolak Surat</button>
                </form>
            </div>
        </div>

    </div>
</div>

<script>
function openUploadPDF() {
    $('#modalUpload').modal('show');
}
</script>
<div id="modalUpload" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel">Upload Laporan bentuk PDF</h4>
            </div>
            <?=form_open_multipart()?>
            <div class="modal-body">
                <input type="file" accept="application/pdf" name="file_signed_draft" class="dropify">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info btn-outline waves-effect" data-dismiss="modal">batal</button>

                <button type="submit" class="btn btn-info  waves-effect">Simpan</button>

            </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<div id="exampleModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Konfirmasi Hapus Laporan</h4>
            </div>
            <div class="modal-body">
                <p>Apakah anda yakin akan mengapus Laporan ini?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
                <a href="<?=base_url()."keuangan/lap_operasional/delete/".$detail->id_laporan_operasional;?>"
                    class="btn btn-primary">Ya</a>
            </div>
        </div>

    </div>
</div>