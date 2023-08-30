<style>
    .aligned-row {
        display: flex;
        flex-flow: row wrap;

        &::before {
            display: block;
        }
    }
</style>
<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Laporan Permintaan Cuti Pegawai</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <?php echo breadcrumb($this->uri->segment_array()); ?>
            </ol>
        </div>
        <!-- /.col-lg-12 -->
    </div>


    <div class="row aligned-row">
        <div class="col-md-12">
            <div class="white-box" style="display: flex;">
                <div class="row" style="display: flex;justify-content:center;align-items:center;width:100%">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-4">
                                <label>SKPD</label>
                                <select name="" class="form-control select2">
                                    <option value="">Semua SKPD</option>
                                    <?php
                                    foreach ($skpd as $s) {
                                        echo '<option value="' . $s->id_skpd . '">' . $s->nama_skpd . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label>Periode Permintaan</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="exampleInputuname" placeholder="Tanggal Awal">
                                    <div class="input-group-addon">s.d</div>
                                    <input type="text" class="form-control" id="exampleInputuname" placeholder="Tanggal Akhir">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <label>Jenis Cuti</label>
                                <select name="" class="form-control select2">
                                    <option value="">Semua Jenis Cuti</option>
                                    <?php
                                    foreach ($jenis_cuti as $jc) {
                                        echo '<option value="' . $jc->id_ref_jenis_cuti . '">' . $jc->nama_jenis_cuti . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label style="display: block;">&nbsp;</label>
                                <button type="submit" class="btn btn-outline btn-primary"><i class="ti-filter"></i> Filter</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="white-box">
                <h3 class="box-title">Disetujui</h3>
                <ul class="list-inline two-part">
                    <li><i class="icon-check text-success"></i></li>
                    <li class="text-right"><span class="counter">2</span></li>
                </ul>
            </div>
        </div>
        <div class="col-md-4">
            <div class="white-box">
                <h3 class="box-title">Ditolak</h3>
                <ul class="list-inline two-part">
                    <li><i class="icon-close text-danger"></i></li>
                    <li class="text-right"><span class="counter">0</span></li>
                </ul>
            </div>
        </div>
        <div class="col-md-4">
            <div class="white-box">
                <h3 class="box-title">Dalam Proses</h3>
                <ul class="list-inline two-part">
                    <li><i class="icon-refresh text-info"></i></li>
                    <li class="text-right"><span class="counter">1</span></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="white-box">
                <center>
                    <span style="display: block;font-weight:500">LAPORAN PERMINTAAN CUTI</span>
                    <span style="display: block;font-weight:500;font-size:20px">SEMUA SKPD</span>
                    <!-- <span style="display: block;font-weight:400">Bulan September Tahun 2021</span> -->
                </center>
                <div class="table-responsive" style="margin-top: 15px;">
                    <table class="table table-stripped" id="myTable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode</th>
                                <th>NIP</th>
                                <th>Nama</th>
                                <th>Tanggal Permintaan</th>
                                <th>Jenis Cuti</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($list as $l) {
                            ?>
                                <tr>
                                    <td><?= $no ?></td>
                                    <td><span class="text-purple">#<?= str_pad($l->id_permintaan_cuti, 4, '0', STR_PAD_LEFT) ?></span></td>
                                    <td><?= $l->nip ?></td>
                                    <td><?= $l->nama_lengkap ?></td>
                                    <td><?= tanggal($l->tanggal_pengajuan) ?></td>
                                    <td><?= $l->nama_jenis_cuti ?></td>
                                    <td><?= color_status_cuti(status_cuti($l->status_pengajuan, $l->status_verifikasi_kepegawaian, $l->status_verifikasi_bkd, $l->verifikasi_bkd)) ?></td>
                                    <td><a href="<?= base_url('permintaan_cuti/detail_verifikasi/' . $l->id_permintaan_cuti) ?>" class="btn btn-primary"><i class="ti-eye"></i> Detail</a></td>
                                </tr>
                            <?php $no++;
                            } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>