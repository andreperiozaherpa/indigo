<div class="container-fluid">
    <!-- Begin Container Fluid -->

    <!-- begin title -->
    <div class="row bg-title">
        <!-- .page title -->
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Isi Berkas Inaktif</h4>
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
    <div class="row">
        <div class="col-md-12">
            <a href="<?= base_url('arsip_dinamis/berkas_inaktif') ?>" class="btn btn-info m-b-10" style="float: right;"><i class="fa fa-arrow-left"></i> Kembali</a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="x_panel">
                <div class="x_content">
                    <div class="panel panel-primary">
                        <div class="panel-heading">Infomasi Berkas - <strong><?= $file->nama_berkas; ?></strong></div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-md-4">Klasifikasi <label style="float: right;">:</label></label>
                                            <label class="col-md-8" style="font-weight: normal;"><?= $file->id_surat_klasifikasi->kode_gabungan . " - " . $file->id_surat_klasifikasi->nama_klasifikasi; ?></label>
                                        </div>
                                        <div class="row">
                                            <label class="col-md-4">Retensi Aktif <label style="float: right;">:</label></label>
                                            <label class="col-md-8" style="font-weight: normal;"><?= $file->id_surat_klasifikasi->retensi_aktif; ?> Tahun</label>
                                        </div>

                                        <div class="row">
                                            <label class="col-md-4">Retensi Inaktif <label style="float: right;">:</label></label>
                                            <label class="col-md-8" style="font-weight: normal;"><?= $file->id_surat_klasifikasi->retensi_inaktif; ?> Tahun</label>
                                        </div>

                                        <div class="row">
                                            <label class="col-md-4">Penyusutan Akhir <label style="float: right;">:</label></label>
                                            <label class="col-md-8" style="font-weight: normal;"><?= $file->id_surat_klasifikasi->penyusutan_akhir; ?></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-md-4">Kategori Berkas <label style="float: right;">:</label></label>
                                            <label class="col-md-8" style="font-weight: normal;"><?= $file->kategori_berkas; ?></label>
                                        </div>
                                        <div class="row">
                                            <label class="col-md-4">Vital <label style="float: right;">:</label></label>
                                            <label class="col-md-8" style="font-weight: normal;"><?= ($file->arsip_vital == 1) ? "Ya" : "Tidak" ?></label>
                                        </div>
                                        <div class="row">
                                            <label class="col-md-4">Terjaga <label style="float: right;">:</label></label>
                                            <label class="col-md-8" style="font-weight: normal;"><?= ($file->arsip_terjaga == 1) ? "Ya" : "Tidak" ?></label>
                                        </div>
                                        <div class="row">
                                            <label class="col-md-4">MKB (Memori Kolektif Bangsa) <label style="float: right;">:</label></label>
                                            <label class="col-md-8" style="font-weight: normal;"><?= ($file->mkb == 1) ? "Ya" : "Tidak" ?></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-4">
                                    <p style="font-weight: bold;">Tanggal Tutup Berkas</p>
                                    <p class="badge badge-warning p-10">Menunggu Tutup Berkas</p>
                                </div>

                                <div class="col-md-4">
                                    <p style="font-weight: bold;">Uraian</p>
                                    <p><?= $file->uraian; ?></p>
                                </div>

                                <div class="col-md-4">
                                    <p style="font-weight: bold;">Lokasi Fisik</p>
                                    <p><?= $file->lokasi_fisik; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="x_panel">
                <div class="x_content">
                    <div class="panel panel-primary">
                        <div class="panel-heading">Daftar Isi Berkas Aktif</div>
                        <div class="panel-body">
                            <form action="<?= base_url('arsip_dinamis/berkas_aktif/add_naskah') ?>" method="POST">
                                <div class="form-group">
                                    <input type="text" class="form-control hidden" name="x_slug" value="<?= $x_slug; ?>" required>
                                    <!--<button type="submit" class="btn btn-success"><i class="fa fa-plus"></i> Tambah Naskah</button>-->
                                </div>
                            </form>
                            <table class="table" id="myTable">
                                <thead>
                                    <tr>
                                        <th>Tipe Naskah</th>
                                        <th>Jenis Naskah</th>
                                        <th>Nomor Naskah</th>
                                        <th>Tanggal</th>
                                        <th>Hal</th>
                                        <th>File</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="row-data">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>