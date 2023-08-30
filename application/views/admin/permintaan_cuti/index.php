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
            <h4 class="page-title">Permintaan Cuti Pegawai</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <?php echo breadcrumb($this->uri->segment_array()); ?>
            </ol>
        </div>
        <!-- /.col-lg-12 -->
    </div>


    <div class="row aligned-row">
        <div class="col-md-9">
            <div class="white-box" style="display: flex;height:91.25%">
                <div class="row" style="display: flex;justify-content:center;align-items:center;width:100%">
                    <div class="col-md-4">
                        <a href="<?= base_url('permintaan_cuti/add') ?>" class="btn btn-block btn-primary"><span class="btn-label"><i class="fa fa-plus"></i></span> Buat Permintaan Baru</a>
                    </div>
                    <div class="col-md-9 b-l">
                        <div class="row">
                            <div class="col-md-6">
                                <label>Periode Permintaan</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="exampleInputuname" placeholder="Tanggal Awal">
                                    <div class="input-group-addon">s.d</div>
                                    <input type="text" class="form-control" id="exampleInputuname" placeholder="Tanggal Akhir">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label>Jenis Cuti</label>
                                <select name="" class="form-control">
                                    <option value="">Pilih Jenis Cuti</option>
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
        <div class="col-md-3">
            <div class="white-box">
                <h3 class="box-title">SISA CUTI TAHUNAN</h3>
                <ul class="list-inline two-part">
                    <li><i class="icon-folder-alt text-purple"></i></li>
                    <li class="text-right"><span class="counter">12</span> <small>Hari</small></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="white-box">
                <h3 class="box-title">RIWAYAT Permintaan ANDA</h3>
                <div class="table-responsive" style="margin-top: 15px;">
                    <table class="table table-stripped" id="myTable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode</th>
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
                                    <td><span class="text-purple">#<?=str_pad($l->id_permintaan_cuti, 4, '0', STR_PAD_LEFT) ?></span></td>
                                    <td><?= tanggal($l->tanggal_pengajuan) ?></td>
                                    <td><?= $l->nama_jenis_cuti ?></td>
                                    <td><?=color_status_cuti(status_cuti($l->status_pengajuan,$l->status_verifikasi_kepegawaian,$l->status_verifikasi_bkd,$l->verifikasi_bkd))?></td>
                                    <td><a href="<?= base_url('permintaan_cuti/detail/' . $l->id_permintaan_cuti) ?>" class="btn btn-primary"><i class="ti-eye"></i> Detail</a></td>
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



<div class="modal fade" id="modalLog" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myLargeModalLabel">Detail Log</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Pegawai</label>
                    <p class="text-purple"><span id="nip"></span> - <span id="nama_lengkap"></span></p>
                </div>
                <div class="form-group">
                    <label>Status</label>
                    <p><span id="id_ket_absen"></span> - <span id="ket_absen"></span></p>
                </div>
                <div class="form-group">
                    <label>Daftar Tanggal</label>
                    <div class="row">
                        <div class="col-lg-6 col-md-8 col-sm-12">
                            <table class="table table-striped table-bordered" id="tabelTanggalLog">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Tanggal</th>
                                        <!-- <th>Aksi</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Bukti</label>
                    <div id="forLampiranAda" style="display: none">
                        <a href="" id="btnLampiran" target="_blank" class="btn btn-primary"><i class="ti-download"></i> Download Lampiran</a>
                    </div>
                    <div id="forLampiranTidakAda" style="display: none">
                        Tidak ada
                    </div>
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