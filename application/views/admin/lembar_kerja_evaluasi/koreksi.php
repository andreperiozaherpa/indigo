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
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="white-box">
                <div class="row">
                    <form method="POST">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nama SKPD </label>
                                <input type="text" class="form-control" placeholder="Cari berdasarkan Nama SKPD" name="nama_skpd" value="<?= ($filter) ? $filter_data['nama_skpd'] : '' ?>">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <?php
                            $year = date('Y');
                            ?>
                            <div class="form-group">
                                <label>Tahun LKE </label>
                                <select name="tahun" class="form-control" style="margin-bottom: 30px;">
                                    <option selected>Pilih Tahun Anggaran</option>
                                    <?php for ($awal_tahun = $year; $awal_tahun >= 2020; $awal_tahun--) {  ?>
                                        <option value="<?= $awal_tahun; ?>"><?= $awal_tahun; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <br>
                                <button type="submit" class="btn btn-primary m-t-5 btn-outline"><i class="ti-filter"></i> Filter</button>
                                <?php
                                if ($filter) {
                                ?>
                                    <a href="" class="btn btn-default m-t-5"><i class="ti-back-left"></i> Reset</a>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="white-box">
                <h3>DAFTAR KOREKSI LKE SKPD - <?= $nama ?> Tahun <?= $year - 1 ?></h3>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_content">
                <?php foreach ($list as $l) {
                    $nilai = 0;
                    $tahun = date('Y');
                    $indikator = $this->lembar_kerja_evaluasi_model->get_indikator($jenis_lke, 1, $l->id_skpd);
                    foreach ($indikator as $i) {
                        $nilai +=  $i->nilai;
                    }
                ?>
                    <div class="col-md-4 col-sm-6">
                        <div class="white-box">
                            <div class="row b-b" style="min-height: 120px;">
                                <div class="col-md-4 col-sm-4 text-center b-r" style="min-height: 120px;">
                                    <img src="<?= base_url() ?>data/logo/skpd/<?= ($l->logo_skpd == '') ? 'sumedang.png' : $l->logo_skpd  ?>" alt="user" class="img-circle img-responsive">
                                </div>
                                <div class="col-md-8 col-sm-8">
                                    <br>
                                    <h3 class="box-title m-b-0"><?= $l->nama_skpd ?></h3>
                                    <h3 class="box-title m-b-0"><?= $tahun - 1 ?></h3>
                                </div>
                            </div>
                            <div class="row b-b">
                                <div class="col-md-12 text-center">
                                    <h3 class="box-title m-b-0"><?= $nilai ?></h3>
                                    Total Nilai LKE
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <br>
                                    <address>
                                        <a href="<?php echo base_url(); ?>lembar_kerja_evaluasi/koreksi_detail/<?= $jenis_lke . "/" . $l->id_skpd ?>">
                                            <button class="fcbtn btn btn-primary btn-outline btn-1b btn-block">Detail LKE</button>
                                        </a>
                                    </address>
                                </div>
                            </div>

                        </div>
                    </div>
                <?php } ?>
                <!-- /.col -->
            </div>


            <div class="row">
                <div class="col-md-12 pager">
                    <?php
                    if (!$filter) {
                        echo make_pagination($pages, $current);
                    }
                    ?>
                </div>
            </div>
        </div>

    </div>