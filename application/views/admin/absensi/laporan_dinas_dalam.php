<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Laporan Rekapitulasi Absen</h4>
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
                        <div class="col-md-8">
                            <div class="col-md-4">

                                <div class="form-group">
                                    <label class="control-label"> Bulan</label>
                                    <select class="form-control select2" name="bulan" id="bulan">
                                        <?php
                                        for ($i = 1; $i <= 12; $i++) {
                                            $selected = (!empty($bulan) && $bulan == $i) ? "selected" : "";
                                            $b = bulan($i);
                                            echo "<option $selected value='$i' >$b</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
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
                            <div class="col-md-3">
                                <div class="form-group">
                                    <br>
                                    <button type="submit" value="1" name="filter" class="btn btn-primary m-t-5 btn-outline"><i class="ti-filter"></i>Filter</button>
                                </div>
                            </div>

                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="white-box">
                <div class="row">
                    <?php
                    $jml_hari = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);
                    if ("$tahun-$bulan-$jml_hari" >= date('Y-m-d')) {
                        $jml_hari = (int) date('d');
                    }
                    // echo $jml_hari;
                    $jumlah = array();
                    ?>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th rowspan="3" style="text-align: center;vertical-align: middle;">No</th>
                                    <th width="400px" rowspan="3" style="text-align: center;vertical-align: middle;">Nama SKPD</th>
                                    <th colspan="<?= $jml_hari * 2 ?>" style="text-align: center;vertical-align: middle;">Tanggal</th>
                                </tr>
                                <tr>
                                    <?php
                                    for ($i = 1; $i <= $jml_hari; $i++) {
                                    ?>
                                        <th colspan="2" style="text-align: center;vertical-align: middle;"><?= $i ?></th>
                                    <?php
                                    }
                                    ?>
                                </tr>
                                <tr>

                                    <?php
                                    for ($i = 1; $i <= $jml_hari; $i++) {
                                    ?>
                                        <th>K</th>
                                        <th>L</th>
                                    <?php
                                    }
                                    ?>
                                </tr>

                            </thead>
                            <tbody>
                                <?php
                                foreach ($skpd as $n => $s) {
                                ?>
                                    <tr>
                                        <td><?= $n + 1 ?></td>
                                        <td><?= $s->nama_skpd ?></td>

                                        <?php
                                        for ($i = 1; $i <= $jml_hari; $i++) {
                                            if (isset($jumlah[$i]['kantor'])) {
                                                $jumlah[$i]['kantor'] += isset($data_rekap[$s->id_skpd][$i]['kantor']) ? $data_rekap[$s->id_skpd][$i]['kantor'] : 0;
                                            } else {
                                                $jumlah[$i]['kantor'] = isset($data_rekap[$s->id_skpd][$i]['kantor']) ? $data_rekap[$s->id_skpd][$i]['kantor'] : 0;
                                            }

                                            if (isset($jumlah[$i]['dinas_dalam'])) {
                                                $jumlah[$i]['dinas_dalam'] += isset($data_rekap[$s->id_skpd][$i]['dinas_dalam']) ? $data_rekap[$s->id_skpd][$i]['dinas_dalam'] : 0;
                                            } else {
                                                $jumlah[$i]['dinas_dalam'] = isset($data_rekap[$s->id_skpd][$i]['dinas_dalam']) ? $data_rekap[$s->id_skpd][$i]['dinas_dalam'] : 0;
                                            }
                                        ?>
                                            <td><?= isset($data_rekap[$s->id_skpd][$i]['kantor']) ? $data_rekap[$s->id_skpd][$i]['kantor'] : 0 ?></td>
                                            <td><?= isset($data_rekap[$s->id_skpd][$i]['dinas_dalam']) ? $data_rekap[$s->id_skpd][$i]['dinas_dalam'] : 0 ?></td>
                                        <?php
                                        }
                                        ?>
                                    </tr>
                                <?php
                                }
                                ?>
                                <tr>
                                    <td style="font-weight: bold;" colspan="2">
                                        <center>JUMLAH</center>
                                    </td>

                                    <?php
                                    for ($i = 1; $i <= $jml_hari; $i++) {
                                    ?>
                                    <td style="font-weight: bold;"><?= isset( $jumlah[$i]['kantor']) ? $jumlah[$i]['kantor'] : 0 ?></td>
                                    <td style="font-weight: bold;"><?= isset( $jumlah[$i]['dinas_dalam']) ? $jumlah[$i]['dinas_dalam'] : 0 ?></td>
                                    <?php } ?>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>