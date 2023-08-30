<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Rekapitulasi Absen</h4> </div>
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
                        <div class="col-md-6">
                            <div class="col-md-6">

                                <div class="form-group">
                                    <label class="control-label"> Bulan</label>
                                    <select class="form-control select2" name="bulan" id="bulan">
                                            <?php
                                                for($i=1; $i <= 12; $i++)
                                                {
                                                    $selected = (!empty($bulan) && $bulan==$i ) ? "selected" :"";
                                                    $b = date("M",strtotime(date("Y")."-".$i."-01"));
                                                    echo "<option $selected value='$i' >$b</option>";

                                                }
                                            ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">


                                <div class="form-group">
                                    <label class="control-label"> Tahun</label>
                                    <select class="form-control select2" id="tahun" name="tahun">
                                            <?php
                                                for($i=2020;$i<=date("Y");$i++)
                                                {
                                                    $selected = (!empty($tahun) && $tahun==$i ) ? "selected" :"";

                                                    echo "<option $selected value='$i' >$i</option>";
                                                }
                                            ?>
                                    </select>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <br>
                                <button type="submit" value="1" name="filter" class="btn btn-primary m-t-5 btn-outline"><i class="ti-filter"></i>Filter</button>
                                <button type="submit" value="1" name="download" class="btn btn-primary m-t-5"><i class="ti-download"></i>Download</button>
                            </div>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 col-sm-12 col-xs-12">
            <div class="collapse m-t-15" id="pgr1" aria-expanded="true"> <pre class="line-numbers language-javascript m-t-0"></pre> </div>
            <div class="row">
                <div class="col-lg-4 col-sm-4 col-xs-12">
                    <div class="white-box">
                        <h3 class="box-title"> Masuk Telat</h3>
                        <ul class="list-inline two-part">
                            <li><i class="icon-login text-danger"></i></li>
                            <li class="text-right"><span class="counter"><?= (!empty($masuk_telat)) ? number_format($masuk_telat) : "0" ;?></span> Menit</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-4 col-xs-12">
                    <div class="white-box">
                        <h3 class="box-title"> Pulang Cepat</h3>
                        <ul class="list-inline two-part">
                            <li><i class="icon-logout text-warning"></i></li>
                            <li class="text-right"><span class="counter"><?= (!empty($pulang_cepat)) ? number_format($pulang_cepat) : "0" ;?></span> Menit</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-4 col-xs-12">
                    <div class="white-box">
                        <h3 class="box-title"> Waktu Kerja</h3>
                        <ul class="list-inline two-part">
                            <li><i class="icon-clock text-success"></i></li>
                            <li class="text-right"><span class=""><?= (!empty($waktu_kerja)) ? number_format($waktu_kerja/60) : "0" ;?></span> Jam</li>
                        </ul>
                    </div>
                </div>
              </div>
            </div>
          </div>

    <div class="row">
        <div class="col-md-12">
            <div class="white-box">
                <div class="row">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Jam Masuk</th>
                                <th>Jam Pulang</th>
                                <!-- <th>Koordinat masuk</th> -->
                                <!-- <th>Koordinat pulang</th> -->
                                <th>Foto masuk</th>
                                <th>Foto pulang</th>
                            </tr>
                        </thead>
                                <tbody>
                                    <?php if (!empty($dt_log)) {
                                        $no = 1;
                                        foreach ($dt_log as $row) { 
                                                if(isset($row->id_ket_log_detail)){

                                                    $group_ket = $row->group_ket;
                                                    if($group_ket=='tk'){
                                                        $color = "danger";
                                                    }elseif($group_ket=='sakit'||$group_ket=='cuti'){
                                                        $color = 'active';
                                                    }else{
                                                        $color = 'info';
                                                    }

                                                    ?>
                                            <tr class="<?=$color?>">
                                                <td align="center"><?= $group_ket!=='wfh' && $group_ket!=='dd' && $group_ket!=='dl' && $group_ket!=='im' ? $no : null ?></td>
                                                <td><?= date("d/m/Y", strtotime($row->tanggal)); ?></td>
                                                <td colspan="6" style="font-weight: 500;">
                                                    <?=$row->ket_absen?>
                                                </td>
                                            </tr>
                                                    <?php
                                                    if( $group_ket!=='wfh' && $group_ket!=='dd' && $group_ket!=='dl' && $group_ket!=='im'){
                                                        $no++;
                                                    }
                                                }else{
                                            ?>
                                            <tr class="<?= empty($row->jam_pulang) ? "warning" : null ?>">
                                                <td align="center"><?= $no; ?></td>
                                                <td><?= date("d/m/Y", strtotime($row->tanggal)); ?></td>
                                                <td><?= $row->jam_masuk; ?></td>
                                                <td><?= !empty($row->jam_pulang) ? $row->jam_pulang : "<span class='text-muted' style='font-style:italic'><small>Tidak Absen Pulang</small></span>"; ?></td>
                                              <!-- <td>Lat: <?= $row->latitude_masuk; ?>
                                                    <br>
                                                    Lng: <?= $row->longitude_masuk; ?>
                                                    <?php if (isset($_GET['map']) && $_GET['map'] == 1 && ($row->latitude_masuk != null && $row->longitude_masuk != null)) { ?>
                                                        <br>
                                                        <a target="_blank" href="https://www.google.com/maps/search/?api=1&query=<?= $row->latitude_masuk; ?>,<?= $row->longitude_masuk; ?>">Lihat peta</a>
                                                    <?php }
                                                    ?>
                                                </td> -->
                                                <!-- <td>Lat: <?= $row->latitude_pulang; ?>
                                                    <br>
                                                    Lng: <?= $row->longitude_pulang; ?>
                                                    <?php if (isset($_GET['map']) && $_GET['map'] == 1 && ($row->latitude_pulang != null && $row->longitude_pulang != null)) { ?>
                                                        <br>
                                                        <a target="_blank" href="https://www.google.com/maps/search/?api=1&query=<?= $row->latitude_pulang; ?>,<?= $row->longitude_pulang; ?>">Lihat peta</a>
                                                    <?php }
                                                    ?>
                                                </td> -->
                                                <td>
                                                    <?php if ($row->foto_masuk) { ?>
                                                        <img src="<?= base_url("/data/absen/foto/") . "/" . $row->foto_masuk; ?>" style="max-height:50px" />
                                                    <?php } ?>
                                                </td>
                                                <td>
                                                    <?php if ($row->foto_pulang) { ?>
                                                        <img src="<?= base_url("/data/absen/foto/") . "/" . $row->foto_pulang; ?>" style="max-height:50px" />
                                                    <?php } ?>
                                                </td>
                                            </tr>
                                            <?php $no++; } ?>
                                    <?php 
                                        }
                                    } ?>
                                </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
