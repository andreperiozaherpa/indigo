<div class="container-fluid">
    <div class="row bg-title">
        <!-- .page title -->
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Buat Jadwal Rapat</h4>
        </div>
        <!-- /.page title -->
        <!-- .breadcrumb -->
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

            <ol class="breadcrumb">
                <li><a href="<?= base_url('admin') ?>">Dashboard</a></li>
                <li><a href="<?= base_url('manajemen_rapat') ?>">Manajemen Rapat</a></li>
                <li class="active">Buat Jadwal Rapat</li>
            </ol>
        </div>
        <!-- /.breadcrumb -->
    </div>
    <div class="row">
        <div class="col-md-12">
            <a href="<?= base_url('manajemen_rapat') ?>" class="btn btn-outline btn-primary pull-right"><i class="ti-back-left"></i> Kembali</a>
            <br><br>
        </div>
    </div>

    <?php
    if (isset($message)) {
        echo '<div class="alert alert-' . $type . '">' . $message . '</div>';
    }
    ?>
    <div class="row">
        <div class="col-md-12">
            <div class="white-box" style="border-top:solid 3px #cc9353">
                <h3 class="box-title">INFORMASI RAPAT</h3>
                <table>
                    <tr style="height: 30px;">
                        <td width="150px">Tema Rapat</td>
                        <td style="width:30px;text-align:center">:</td>
                        <td><span style="font-weight: 500" class="text-purple"><?= $detail->tema_rapat ?></span></td>
                    </tr>
                    <tr style="height: 30px;">
                        <td>Deskripsi</td>
                        <td style="width:30px;text-align:center">:</td>
                        <td><?= $detail->deskripsi_rapat ?></td>
                    </tr>
                    <tr style="height: 30px;">
                        <td width="100px">Waktu Pelaksanaan</td>
                        <td style="width:30px;text-align:center">:</td>
                        <td>
                            <i class="ti-calendar text-purple"></i> <?= tanggal($detail->tanggal) ?> - <?= stime($detail->jam) ?> WIB
                            <!-- <span style="font-style:italic" class="text-info">(Sedang berlangsung)</span> -->
                        </td>
                    </tr>
                    <tr style="height: 30px;">
                        <td width="100px">Jenis Rapat</td>
                        <td style="width:30px;text-align:center">:</td>
                        <td><span class="label label-<?= $detail->jenis_rapat == 'online' ? 'info' : 'warning' ?>"><?= ucwords($detail->jenis_rapat) ?></span></td>
                    </tr>
                    <?php
                    if ($detail->jenis_rapat == 'offline') {
                    ?>

                        <tr style="height: 30px;">
                            <td width="100px">Tempat</td>
                            <td style="width:30px;text-align:center">:</td>
                            <td>
                                <i class="ti-location-pin text-purple"></i> <?= $detail->lokasi ?>
                                <!-- <span style="font-style:italic" class="text-info">(Sedang berlangsung)</span> -->
                            </td>
                        </tr>
                    <?php
                    } else if ($detail->jenis_rapat == 'online') {
                    ?>
                        <tr style="height: 30px;">
                            <td width="100px">Tautan Rapat Online</td>
                            <td style="width:30px;text-align:center">:</td>
                            <td><a target="blank" href="<?= $detail->link_meeting ?>"><?= $detail->link_meeting ?></a></td>
                        </tr>
                        <?php
                        if ($detail->autentikasi == 'Y') {
                        ?>
                            <tr style="height: 30px;">
                                <td width="100px">Username</td>
                                <td style="width:30px;text-align:center">:</td>
                                <td><?= $detail->username ?></td>
                            </tr>
                            <tr style="height: 30px;">
                                <td width="100px">Password</td>
                                <td style="width:30px;text-align:center">:</td>
                                <td><?= $detail->password ?></td>
                            </tr>
                        <?php } ?>
                    <?php
                    }
                    ?>
                </table>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="white-box">
                <a href="<?= base_url('manajemen_rapat/edit/' . $detail->id_rapat) ?>" class="btn btn-info btn-block"><i class="ti-pencil"></i> Edit Jadwal</a>
                <a href="javascript:void(0)" onclick="deleteRapat()" class="btn btn-danger btn-block"><i class="ti-trash"></i> Hapus Jadwal</a>
                <hr>
                <a href="javascript:void(0)" onclick="daftarAbsensi()" class="btn btn-primary btn-block"><i class="ti-user"></i> Daftar Absensi</a>
                <a href="javascript:void(0)" onclick="notulensiRapat()" class="btn btn-primary btn-block"><i class="ti-book"></i> Notulensi Rapat</a>

            </div>
        </div>
        <div class="col-md-8">
            <div class="white-box">
                <h3 class="box-title">DAFTAR PESERTA</h3>
                <table class="table">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th colspan="2">Nama</th>
                            <th>Jabatan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($peserta as $p) { ?>
                            <tr>
                                <td style="vertical-align: middle;"><?= $no ?></td>
                                <td style="vertical-align: middle;width:50px">
                                    <img class="img-circle" alt="user" style="width: 50px;" src="<?= base_url('data/foto/pegawai/' . $p->foto_pegawai) ?>">
                                </td>
                                <td style="vertical-align: middle;"><span class="text-purple"><?= $p->nama_lengkap ?></span></td>
                                <td style="vertical-align: middle;"><?= $p->jabatan ?></td>
                            </tr>
                        <?php $no++;
                        } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div id="modalDaftarAbsensi" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel">Daftar Absensi</h4>
            </div>
            <div class="modal-body">

                <table class="table">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th colspan="2">Nama</th>
                            <th>Jabatan</th>
                            <th>Status Absensi</th>
                            <th>Waktu Absensi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($peserta as $p) { ?>
                            <tr>
                                <td style="vertical-align: middle;"><?= $no ?></td>
                                <td style="vertical-align: middle;width:50px">
                                    <img class="img-circle" alt="user" style="width: 50px;" src="<?= base_url('data/foto/pegawai/' . $p->foto_pegawai) ?>">
                                </td>
                                <td style="vertical-align: middle;"><span class="text-purple"><?= $p->nama_lengkap ?></span></td>
                                <td style="vertical-align: middle;"><?= $p->jabatan ?></td>
                                <td style="vertical-align: middle;">
                                    <?php
                                    $text_absensi = ucwords($p->status_absensi);
                                    if ($p->status_absensi == 'hadir') {
                                        $color_absensi = 'success';
                                    } elseif ($p->status_absensi == 'izin') {
                                        $color_absensi = 'info';
                                    } elseif ($p->status_absensi == 'sakit') {
                                        $color_absensi = 'warning';
                                    } else {
                                        $color_absensi = 'danger';
                                        $text_absensi = 'Belum absen';
                                    }
                                    ?>
                                    <span class="label label-<?= $color_absensi ?>"><?= $text_absensi ?></span>
                                </td>
                                <td style="vertical-align: middle;text-align:center"><?= !empty($p->tanggal) && !empty($p->jam) ? $p->tanggal . ' - ' . $p->jam : '-' ?></td>
                            </tr>
                        <?php $no++;
                        } ?>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary btn-outline waves-effect" data-dismiss="modal">Tutup</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<div id="modelNotulensiRapat" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <?= form_open_multipart() ?>
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel">Notulensi Rapat</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Notulensi Rapat</label>
                    <textarea rows="10" class="form-control" name="notulensi" placeholder="Masukkan Notulensi Rapat"><?= !empty($notulensi) ? $notulensi->notulensi : null ?></textarea>
                </div>
                <div class="form-group">
                    <label>Lampiran <?= !empty($notulensi) ? '<a target="blank" href="' . base_url('data/lampiran_rapat/' . $notulensi->lampiran) . '" class="btn btn-primary btn-xs"><i class="ti-download"></i> Download</a>' : null ?></label>
                    <input type="file" name="lampiran" class="dropify" <?= !empty($notulensi) ? 'data-default-file="' . base_url('data/lampiran_rapat/' . $notulensi->lampiran) . '"' : null ?> />
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" name="method" value="update_notulen" class="btn btn-primary waves-effect"><i class="ti-save"></i> Simpan</button>
                <button type="button" class="btn btn-primary btn-outline waves-effect" data-dismiss="modal">Tutup</button>
            </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<script>
    function notulensiRapat() {

        $('#modelNotulensiRapat').modal('show');
    }

    function daftarAbsensi() {
        $('#modalDaftarAbsensi').modal('show');
    }

    function deleteRapat(){
        swal({   
            title: "Apakah Anda yakin?",   
            text: "Data yang dihapus tidak akan bisa dikembalikan lagi",   
            type: "warning",   
            showCancelButton: true,   
            confirmButtonColor: "#DD6B55",   
            confirmButtonText: "Ya",
            cancelButtonText: "Tidak",   
            closeOnConfirm: false 
        }, function(){   
            // swal("Deleted!", "Your imaginary file has been deleted.", "success"); 
            window.location.replace('<?=base_url('manajemen_rapat/delete/'.$detail->id_rapat)?>');
        });
    }
</script>