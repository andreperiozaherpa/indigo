<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Koreksi TPP Pegawai</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <?php echo breadcrumb($this->uri->segment_array()); ?>
            </ol>
        </div>
        <!-- /.col-lg-12 -->
    </div>


    <div class="row">
        <div class="col-md-12">
            <div class="white-box">
                <div class="row">
                    <form method="GET">
                        <div class="col-md-9">

                            <div class="col-md-6">

                                <div class="form-group">
                                    <label class="control-label">SKPD</label>
                                    <select name="id_skpd" class="form-control select2">
                                        <option value="">Semua SKPD</option>
                                        <?php
                                        foreach ($skpd as $s) {
                                            $selected = $id_skpd == $s->id_skpd ? ' selected' : '';
                                            echo '<option value="' . $s->id_skpd . '"' . $selected . '>' . $s->nama_skpd . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">

                                <div class="form-group">
                                    <label class="control-label"> Bulan</label>
                                    <select class="form-control select2" name="bulan" id="bulan">
                                        <?php
                                        for ($i = 1; $i <= 12; $i++) {
                                            $selected = (!empty($bulan) && $bulan == $i) ? "selected" : "";
                                            echo "<option $selected value='$i' >" . bulan($i) . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">


                                <div class="form-group">
                                    <label class="control-label"> Tahun</label>
                                    <select class="form-control select2" id="tahun" name="tahun">
                                        <?php
                                        for ($i = 2020; $i <= date("Y"); $i++) {
                                            $selected = (!empty($tahun) && $tahun == $i) ? "selected" : "";

                                            echo "<option $selected value='$i' >$i</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <br>
                                <button type="submit" value="1" name="filter" class="btn btn-primary m-t-5 btn-outline"><i class="ti-filter"></i>Filter</button>
                            </div>
                        </div>

                    </form>
                </div>
                <?php 
                    if($id_skpd!==''){
                ?>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <a href="<?=base_url("absensi/laporan?id_skpd=$id_skpd&bulan=$bulan&tahun=$tahun")?>" target="_blank" class="btn btn-primary">Lihat Laporan Absensi</a>
                        <a href="<?=base_url("absensi/laporan_tpp?id_skpd=$id_skpd&bulan=$bulan&tahun=$tahun")?>" target="_blank" class="btn btn-primary">Lihat Laporan TPP</a>
                        <a href="<?=base_url("master_pegawai/posisi?id_skpd_filter=$id_skpd&bulan=$bulan&tahun=$tahun")?>" target="_blank" class="btn btn-primary">Lihat Posisi Pegawai</a>
                    </div>
                </div>
                <?php } ?>

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="white-box">
                <center>
                    <span style="display: block;font-weight:500">CONSOLE KOREKSI ABSENSI</span>
                    <span style="display: block;font-weight:500;font-size:20px"><?= isset($selected_skpd) ? $selected_skpd->nama_skpd : "SEMUA SKPD" ?></span>
                    <span style="display: block;font-weight:400">Bulan <?= bulan($bulan) ?> Tahun <?= $tahun ?></span>
                </center>
                <div class="m-t-20">
                    <div class="row">
                        <form method="POST">
                            <div class="col-lg-2 col-sm-4 col-xs-12">
                                <button type="submit" onclick="return confirm('Are you sure?')" name="mode" value="generate_tpp" class="btn btn-block btn-primary">Generate TPP</button>
                            </div>
                            <div class="col-lg-2 col-sm-4 col-xs-12">
                                <button type="submit" onclick="return confirm('Are you sure?')" name="mode" value="hitung_lkh" class="btn btn-block btn-primary">Hitung LKH</button>
                            </div>
                            <div class="col-lg-2 col-sm-4 col-xs-12">
                                <button type="submit" onclick="return confirm('Are you sure?')" name="mode" value="hitung_tk" class="btn btn-block btn-primary">Hitung Tanpa Keterangan</button>
                            </div>
                            <div class="col-lg-2 col-sm-4 col-xs-12">
                                <button type="submit" onclick="return confirm('Are you sure?')" name="mode" value="hitung_tap" class="btn btn-block btn-primary">Hitung Log Absen</button>
                            </div>
                            <div class="col-lg-2 col-sm-4 col-xs-12">
                                <button type="submit" onclick="return confirm('Are you sure?')" name="mode" value="fix_absen_hari_libur" class="btn btn-block btn-primary">Fix Absen di Hari Libur</button>
                            </div>
                            <div class="col-lg-2 col-sm-4 col-xs-12">
                                <button type="submit" onclick="return confirm('Are you sure?')" name="mode" value="fix_tanpa_keterangan" class="btn btn-block btn-primary">Fix Tanpa Keterangan</button>
                            </div>
                        </form>
                    </div>
                </div>
                <hr>
                <h4 class="box-title">CONSOLE BOX</h4>
                <?php
                $iframe_url = base_url('/absensi/koreksi/console_iframe');
                if (isset($_POST['mode'])) {
                    $mode = $_POST['mode'];
                    if (!empty($mode)) {
                        $id_skpd = empty($id_skpd) ? 0 : $id_skpd;
                        $iframe_url = base_url('/absensi/koreksi/console_iframe') . "/$mode/$id_skpd/$bulan/$tahun";
                    }
                }
                ?>
                <iframe style="border:none" width="100%" height="500px" src="<?= $iframe_url ?>"></iframe>
                <?php

                ?>
            </div>
        </div>
    </div>
</div>