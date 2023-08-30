<div class="container-fluid">

    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Detail Legislasi</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <?= breadcrumb($this->uri->segment_array()) ?>
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
        <a href="<?= base_url('legislasi') ?>" class="pull-right btn btn-primary btn-outline"><i class="ti-back-left"></i> Kembali</a><br><br>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="white-box">
                <h4 class="box-title">PANITIA KHUSUS</h4>
                <div style="display: flex;border:solid 1px #6003c8;padding:10px">
                    <img src="<?= base_url('data/foto/pegawai/' . $detail->foto_pegawai) ?>" style="border-radius:50%;width:50px;height:50px;object-fit:cover">
                    <div style="display:flex;flex-direction:column;margin-left:10px">
                        <span style="font-weight:500" class="text-purple"><?= $detail->nama_lengkap_ketua ?></span>
                        <span>Ketua</span>
                    </div>
                </div>
                <?php
                foreach ($anggota as $a) {
                ?>
                    <div style="display: flex;margin-top:20px">
                        <img src="<?= base_url('data/foto/pegawai/' . $a->foto_pegawai) ?>" style="border-radius:50%;width:50px;height:50px;object-fit:cover">
                        <div style="display:flex;flex-direction:column;margin-left:10px">
                            <span style="font-weight:500"><?= $a->nama_lengkap ?></span>
                            <span><?=$a->jabatan?></span>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
        
        <div class="col-md-8">
            <div class="white-box">
                <h4 class="box-title">DETAIL LEGISLASI</h4>
                <div class="form-group">
                    <label>Judul / Tema</label>
                    <p><?=$detail->judul?></p>
                </div>
                <div class="form-group">
                    <label>Tanggal Pelaksanaan</label>
                    <p><i class="ti-calendar"></i> <?=tanggal($detail->tanggal_pelaksanaan)?></p>
                </div>
                <div class="form-group">
                    <label>Laporan Singkat / Notulensi</label>
                    <p><?=$detail->laporan_singkat?></p>
                </div>
                <div class="form-group">
                    <label>Rekomendasi</label>
                    <p><?=$detail->rekomendasi?></p>
                </div>
                <div class="form-group">
                    <label>Status</label>
                    <p><?=ucwords($detail->status)?></p>
                </div>
                <div class="form-group">
                    <label>File Pendukung</label>
                    <p>
                        <?php 
                            if(!empty($detail->file_pendukung)){
                                ?>
                                
                    <a href="<?=base_url('data/legislasi/'.$detail->file_pendukung)?>" class="btn btn-primary"><i class="ti-download"></i> Download</a>
                                <?php
                            }else{
                                ?>
                                <span class="text-danger">Tidak tersedia</span>
                                <?php
                            }
                        ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>