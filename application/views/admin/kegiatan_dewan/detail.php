<div class="container-fluid">
    <div class="row bg-title">
        <!-- .page title -->
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Buat Jadwal Kegiatan</h4>
        </div>
        <!-- /.page title -->
        <!-- .breadcrumb -->
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

            <ol class="breadcrumb">
                <li><a href="<?= base_url('admin') ?>">Dashboard</a></li>
                <li><a href="<?= base_url('kegiatan_dewan') ?>">Manajemen Kegiatan</a></li>
                <li class="active">Buat Jadwal Kegiatan</li>
            </ol>
        </div>
        <!-- /.breadcrumb -->
    </div>
    <div class="row">
        <div class="col-md-12">
            <a href="<?= base_url('kegiatan_dewan') ?>" class="btn btn-outline btn-primary pull-right"><i class="ti-back-left"></i> Kembali</a>
            <br><br>
        </div>
    </div>

    <?php
    if (isset($message)) {
        echo '<div class="alert alert-' . $type . '">' . $message . '</div>';
    }
    ?>
    <div class="row">
        <div class="col-md-8">
            <div class="white-box" style="border-top:solid 3px #cc9353">
                <h3 class="box-title">INFORMASI KEGIATAN</h3>
                <table>
                    <tr style="height: 30px;">
                        <td width="150px">Tema Kegiatan</td>
                        <td style="width:30px;text-align:center">:</td>
                        <td><span style="font-weight: 500" class="text-purple"><?= $detail->nama_kegiatan ?></span></td>
                    </tr>
                    <tr style="height: 30px;">
                        <td>Deskripsi</td>
                        <td style="width:30px;text-align:center">:</td>
                        <td><?= $detail->deskripsi_kegiatan ?></td>
                    </tr>
                    <tr style="height: 30px;">
                        <td width="100px">Waktu Pelaksanaan</td>
                        <td style="width:30px;text-align:center">:</td>
                        <td>
                            <i class="ti-calendar text-purple"></i> <?= tanggal($detail->tanggal) ?>
                        </td>
                    </tr>

                    <tr style="height: 30px;">
                        <td width="100px">Tempat</td>
                        <td style="width:30px;text-align:center">:</td>
                        <td>
                            <i class="ti-location-pin text-purple"></i> <?= $detail->lokasi ?>
                            <!-- <span style="font-style:italic" class="text-info">(Sedang berlangsung)</span> -->
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="col-md-4">
            <div class="thumbnail">

                <img style="width: 100%;height:205px;object-fit:cover" src="<?= base_url('data/foto_kegiatan_dewan/' . $detail->foto_kegiatan) ?>" />
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="white-box">
                <h3 class="box-title">MENU</h3>
                <a href="<?= base_url('kegiatan_dewan/edit/' . $detail->id_kegiatan_dewan) ?>" class="btn btn-info btn-block"><i class="ti-pencil"></i> Edit Catatan</a>
                <a href="javascript:void(0)" onclick="deleteKegiatan()" class="btn btn-danger btn-block"><i class="ti-trash"></i> Hapus Catatan</a>

            </div>

            <div class="white-box">
                <h3 class="box-title"><i class="ti-clip"></i> LAMPIRAN</h3>
                <div style="display: flex;justify-content:center;align-items:center;flex-direction:column">
                    <i class="ti-file" style="font-size: 100px;"></i>
                    <span style="margin-top:10px;margin-bottom:10px"><?= $detail->lampiran ?></span>
                    <a target="blank" href="<?= base_url('data/lampiran_kegiatan_dewan/' . $detail->lampiran) ?>" class="btn btn-primary">Download Lampiran</a>
                </div>
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
<script>
    function deleteKegiatan() {
        swal({
            title: "Apakah Anda yakin?",
            text: "Data yang dihapus tidak akan bisa dikembalikan lagi",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Ya",
            cancelButtonText: "Tidak",
            closeOnConfirm: false
        }, function() {
            // swal("Deleted!", "Your imaginary file has been deleted.", "success"); 
            window.location.replace('<?= base_url('kegiatan_dewan/delete/' . $detail->id_kegiatan_dewan) ?>');
        });
    }
</script>