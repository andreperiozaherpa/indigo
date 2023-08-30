<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view('admin/src/head'); ?>
    <style type="text/css">
        .marginleft2px {
            margin-left: 2px;
        }
    </style>

</head>

<body>

    <div id="wrapper">


        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="white-box">
                        <div class="row">
                            <h3>REKAPITULASI ABSEN BULAN <?= strtoupper($bulan) . " " . $tahun; ?></h3>
                            <h4>NAMA : <?= strtoupper($user->full_name); ?></h4>
                            <hr>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Jam Masuk</th>
                                        <th>Jam Pulang</th>
                                        <th>Masuk Telat</th>
                                        <th>Pulang Cepat</th>
                                        <th>Waktu Kerja</th>
                                        <th>Shift</th>
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
                                            if (isset($row->id_ket_log_detail)) {
                                                $group_ket = $row->group_ket;
                                                if ($group_ket == 'tk') {
                                                    $color = "danger";
                                                } elseif ($group_ket == 'sakit' || $group_ket == 'cuti') {
                                                    $color = 'active';
                                                } else {
                                                    $color = 'info';
                                                }

                                    ?>
                                                <tr class="<?= $color ?>">
                                                    <td align="center"><?= $group_ket !== 'wfh' && $group_ket !== 'dd' && $group_ket !== 'dl' && $group_ket !== 'im' ? $no : null ?></td>
                                                    <td><?= hari_s(date("N", strtotime($row->tanggal))); ?>, <?= date("d/m/Y", strtotime($row->tanggal)); ?></td>
                                                    <td colspan="9" style="font-weight: 500;">
                                                        <?= $row->ket_absen ?>
                                                    </td>
                                                </tr>
                                                <?php
                                                if ($group_ket !== 'wfh' && $group_ket !== 'dd' && $group_ket !== 'dl' && $group_ket !== 'im') {
                                                    $no++;
                                                }
                                            } else {

                                                $hari = date('N', strtotime($row->tanggal));
                                                if ($row->id_shift == 1 && $hari == 5) {
                                                    $row->shift_pulang = "16:30:00";
                                                }
                                                if (($row->id_shift == 4 || $row->id_shift == 12) && $hari == 5) {
                                                    $row->shift_pulang = "11:00:00";
                                                }
                                                if (($row->id_shift == 4 || $row->id_shift == 12) && $hari == 6) {
                                                    $row->shift_pulang = "13:00:00";
                                                }
                                                ?>
                                                <tr class="<?= empty($row->jam_pulang) ? "warning" : null ?>">
                                                    <td align="center"><?= $no; ?></td>
                                                    <td><?= hari_s(date("N", strtotime($row->tanggal))); ?>, <?= date("d/m/Y", strtotime($row->tanggal)); ?></td>
                                                    <td><?= $row->jam_masuk; ?></td>
                                                    <td><?= !empty($row->jam_pulang) ? $row->jam_pulang : "<span class='text-muted' style='font-style:italic'><small>Tidak Absen Pulang</small></span>"; ?></td>
                                                    <td><?= ($row->masuk_telat) ? convert_minute($row->masuk_telat) : ''; ?></td>
                                                    <td><?= ($row->pulang_cepat) ? convert_minute($row->pulang_cepat)  : ''; ?></td>
                                                    <td><?= ($row->waktu_kerja) ? number_format($row->waktu_kerja / 60) . ' jam ' . $row->waktu_kerja % 60 . ' menit' : ''; ?></td>
                                                    <td><?= $row->nama_shift; ?>
                                                    <br>
                                                    <small><?= $row->shift_masuk?> - <?= $row->shift_pulang?></small>
                                                </td>
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
                                            <?php $no++;
                                            } ?>
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

    </div>


</body>

</html>