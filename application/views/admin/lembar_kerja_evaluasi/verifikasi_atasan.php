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
                    <form action="<?php echo base_url(); ?>Lembar_kerja_evaluasi/koreksi_v2_filter/zi_wbk" method="POST">
                        <!-- <div class="col-md-6">
<div class="form-group">
<label>Nama SKPD </label>
<input type="text" class="form-control" placeholder="Cari berdasarkan Nama SKPD" name="nama_skpd" value="<?= ($filter) ? $filter_data['nama_skpd'] : '' ?>">
</div>
</div> -->
                        <div class="col-md-10">
                            <?php
                            $year = date('Y');
                            ?>
                            <div class="form-group">
                                <label>Tahun LKE </label>
                                <select name="tahun" class="form-control" style="margin-bottom: 30px;" required>
                                    <option value="">Pilih Tahun Anggaran</option>
                                    <?php for ($awal_tahun = $year; $awal_tahun <= 2023; $awal_tahun++) {  ?>
                                        <option value="<?= $awal_tahun; ?>"><?= $awal_tahun; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <br>
                                <button type="submit" class="btn btn-primary m-t-5 btn-outline"><i class="ti-filter"></i> Filter</button>

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
                <h3 style="text-align:center;">LKE SKPD - <?= $nama ?> Tahun <?= $year ?></h3><br>
                <hr>
                <a href="<?php echo base_url(); ?>lembar_kerja_evaluasi/export_koreksi/<?= $jenis_lke ?>" class="btn btn-md btn-success">Export Excel</a>
                <hr>
                <div class="table-responsive">
                    <table id="myTable" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th scope="col">No. </th>
                                <th scope="col">Nama SKPD</th>
                                <th scope="col">Jenis LKE</th>
                                <th scope="col">Nilai LKE</th>
                                <th scope="col">Nilai Auditor</th>
                                <th scope="col">Option</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            ?>
                            <?php foreach ($list as $rows) {
                                $nilai = 0;
                                $nilai_koreksi = 0;
                                $indikator = $this->lembar_kerja_evaluasi_model->get_indikator($jenis_lke, 1, $rows->id_skpd);
                                foreach ($indikator as $i) {
                                    $nilai +=  $i->nilai;
                                    $nilai_koreksi +=  $i->nilai_koreksi;
                                }
                            ?>
                                <tr>
                                    <td><?= $no; ?></td>
                                    <td><?= $rows->nama_skpd ?></td>
                                    <td>
                                        <?php if ($jenis_lke == 'zi_wbk') {
                                            echo "<b style='color:#4285F4;'>ZI WBK</b>";
                                        } elseif ($jenis_lke == 'rb') {
                                            echo "<b style='color:#4285F4;'>Reformasi Birokrasi</b>";
                                        } ?>
                                    </td>
                                    <td><?= $nilai ?></td>
                                    <td><?= $nilai_koreksi ?></td>

                                    <td><a class="btn btn-small btn-primary" href="<?php echo base_url(); ?>lembar_kerja_evaluasi/verifikasi_atasan_detail/<?= $jenis_lke . "/" . $rows->id_skpd . "/" . $year ?>">Detail</a></td>
                                </tr>
                            <?php
                                $no++;
                            } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>