<div class="container-fluid">
    <div class="row bg-title">
        <!-- .page title -->
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Kegiatan Dewan</h4>
        </div>
        <!-- /.page title -->
        <!-- .breadcrumb -->
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

            <ol class="breadcrumb">
                <li><a href="<?= base_url('admin') ?>">Dashboard</a></li>
                <li class="active">Kegiatan Dewan</li>
            </ol>
        </div>
        <!-- /.breadcrumb -->
    </div>
    <div class="row">
        <div class="col-md-3">
            <a href="<?= base_url('kegiatan_dewan/add') ?>" class="btn btn-primary btn-block m-t-40"><i class="ti-plus"></i> Tambah Catatan Kegiatan</a>
        </div>
        <div class="col-md-9">
            <div class="white-box">
                <form>
                    <div class="row">
                        <div class="col-md-4">
                            <label>Nama Kegiatan</label>
                            <input type="text" class="form-control" value="<?= !empty($filter) && isset($filter['nama_kegiatan']) ? $filter['nama_kegiatan'] : null ?>" name="nama_kegiatan" placeholder="Cari Nama Kegiatan ...">
                        </div>
                        <div class="col-md-3">
                            <label>Tanggal Awal</label>
                            <input type="text" class="form-control mydatepicker" value="<?= !empty($filter) && isset($filter['tanggal_awal']) ? $filter['tanggal_awal'] : null ?>" name="tanggal_awal" autocomplete="off" placeholder="Masukkan Tanggal Awal">
                        </div>
                        <div class="col-md-3">
                            <label>Tanggal Akhir</label>
                            <input type="text" class="form-control mydatepicker" value="<?= !empty($filter) && isset($filter['tanggal_akhir']) ? $filter['tanggal_akhir'] : null ?>" name="tanggal_akhir" autocomplete="off" placeholder="Masukkan Tanggal Akhir">
                        </div>
                        <div class="col-md-2">
                            <label style="display: block;">&nbsp;</label>
                            <button type="submit" class="btn btn-outline btn-primary"><i class="ti-filter"></i> Filter</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--row -->
    <div class="row">
        <div class="col-md-12">
            <div class="white-box">

                <table class="table color-table primary-table table-striped" id="myTable">
                    <thead>
                        <tr>
                            <th width="40px">No.</th>
                            <th>Nama Kegiatan</th>
                            <th>Tanggal</th>
                            <th width="200px">Peserta</th>
                            <th width="100px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($list as $l) {
                        ?>
                            <tr>
                                <td><?= $no ?></td>
                                <td><?= $l->nama_kegiatan ?></td>
                                <td>
                                    <span style="display:block"><i class="ti-calendar text-purple"></i> <?= tanggal($l->tanggal) ?></span>
                                </td>
                                <td>
                                    <div style="display: flex;flex-direction:row">
                                        <?php
                                        foreach ($l->peserta_thumb as $k => $pt) {
                                        ?>

                                            <img class="img-circle" alt="user" style="width: 30px;border:solid 1px white;<?= $k !== 0 ? 'margin-left:-5px' : null ?>" src="<?= base_url('data/foto/pegawai/' . $pt['foto_pegawai']) ?>">

                                        <?php
                                        }
                                        ?>
                                        <?php
                                        if ($l->jumlah_peserta > 4) {
                                        ?>
                                            <span style="width: 30px;height:30px;background-color:#cc9353;margin-left:-5px;border-radius:50%;color:white;font-size:11px;display:flex;align-items:center;justify-content:center">+<?= ($l->jumlah_peserta - 4) ?></span>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                    <div style="margin-top:5px"><span style="font-weight:500" class="text-purple"><?= $l->jumlah_peserta ?></span> Peserta</div>
                                </td>
                                <td><a href="<?= base_url('kegiatan_dewan/detail/' . $l->id_kegiatan_dewan) ?>" class="btn btn-primary"><i class="ti-eye"></i> Detail</a> </td>
                            </tr>
                        <?php $no++;
                        } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>