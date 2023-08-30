<style type="text/css">
    .posisi tbody tr td {
        width: 100px;
        height: 100px;
        text-align: center;
        vertical-align: middle;
    }
</style>
<div class="container-fluid">

    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Peringkat Talent</h4>
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
                        <div class="col-md-6">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label"> Rumpun</label>
                                    <select class="form-control select2" name="rumpun" id="rumpun">
                                        <option value="">Semua Rumpun</option>
                                        <?php
                                        foreach ($rumpun as $r) {
                                            $selected = $r == $selected_rumpun ? ' selected' : '';
                                            echo '<option value="' . $r . '"' . $selected . '>' . $r . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">


                                <div class="form-group">
                                    <label class="control-label"> Eselon</label>
                                    <select class="form-control select2" id="eselon" name="eselon">
                                        <option value="">Semua Eselon</option>
                                        <?php
                                        foreach ($eselon as $e) {
                                            $selected = $r == $selected_eselon ? ' selected' : '';
                                            echo '<option value="' . $e . '"' . $selected . '>' . $e . '</option>';
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
                <center>
                    <h3>DAFTAR PERINGKAT TALENT</h3>
                    <p>Rumpun : <b><?= empty($selected_rumpun) ? 'Semua Rumpun' : $selected_rumpun ?></b>, Eselon : <b><?= empty($selected_eselon) ? 'Semua Eselon' : $selected_eselon ?></b></p>
                    <a href="javascript:void(0)" data-toggle="modal" data-target="#modalBox" class="btn btn-primary btn-sm btn-rounded">Lihat 9 Box</a>
                </center>
                <button onclick="downloadExcel('tablePeringkat','Daftar Peringkat Talent')" class="btn btn-primary">Download</button>
                <div class="table-responsive">
                    <table id="tablePeringkat" class="table table-striped">
                        <thead>
                            <tr>
                                <th width="10px">No</th>
                                <th>NIP</th>
                                <th>Nama Lengkap</th>
                                <th>Jabatan</th>
                                <th>Nilai Kompetensi</th>
                                <th>Nilai Kinerja</th>
                                <th>Jumlah Nilai</th>
                                <th width="200px" class="text-center">Kuadran</th>
                                <th class="text-center">Ranking</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $n = 1;
                            foreach ($list as $l) {
                                switch ($l->kuadran) {
                                    case 1:
                                        $warna = '#f03434';
                                        $title = 'Strongest Concern';
                                        $text = array('Kinerja dibawah target dan potensi rendah', 'Konsisten pada kontrak kinerja dan feedback diberikan dan didokumentasikan', 'Dipertimbangkan exit');
                                        break;
                                    case 2:
                                        $warna = '#f03434';
                                        $title = 'Uncertain';
                                        $text = array('Kinerja dibawah target tapi masih menunjukan potensi', 'Pengembangan Kompetensi: secara reguler di review progresnya secara individual');
                                        break;
                                    case 3:
                                        $warna = '#f03434';
                                        $title = 'Unrealised Potential';
                                        $text = array('Kinerja dibawah ekspektasi tapi potensi tinggi', 'Senang belajar', 'Pengembangan Karir: melalui peningkatan pekerjaan yang spesifik');
                                        break;
                                    case 4:
                                        $warna = '#fad859';
                                        $title = 'Solid Contributor';
                                        $text = array('Pada umumnya kinerja baik meskipun potensi kurang', 'Menunjukan ketidaktertarikan untuk belajar', 'Pengembangan Kompetensi : peningkatan kinerja dan adaptasi');
                                        break;
                                    case 5:
                                        $warna = '#fad859';
                                        $title = 'Well Placed';
                                        $text = array('Kinerja baik dan potensi kelihatan', 'Menunjukkan ketertarikan untuk belajar dan mengaplikasikan skill baru', 'Pengembangan Kompetensi : peningkatan kinerja dan keep stay');
                                        break;
                                    case 6:
                                        $warna = '#fad859';
                                        $title = 'Emerging Potential';
                                        $text = array('Pada umumnya kinerja baik dan menunjukan potensi', 'Pengembangan Kompetensi : peningkatan kinerja dan dikelola untuk tinggal');
                                        break;
                                    case 7:
                                        $warna = '#049372';
                                        $title = 'Proven Performer';
                                        $text = array('Kinerja tinggi dan konsisten kinerjanya', 'Potential kurang untuk job yang kompleks', 'Kontributor berharga', 'Pengembangan Kompetensi : fokus pada loyalitas, penghargaan');
                                        break;
                                    case 8:
                                        $warna = '#049372';
                                        $title = 'High Achiever';
                                        $text = array('Kinerja tinggi dan konsisten', 'Menunjukan potensi pekerjaan yang kompleks', 'Mau Belajar', 'Pengembangan Kompetensi : fokus kinerja dan dipertahankan');
                                        break;
                                    case 9:
                                        $warna = '#1e824c';
                                        $title = 'Top Talent';
                                        $text = array('Kinerja diatas target dan konsisten kinerjanya', 'Menunjukan potensi tinggi untuk role/job yang kompleks', 'Siap dipromosikan', 'Pengembangan Karir : penghargaan, retention');
                                        break;
                                    default:
                                        $warna = '';
                                        $title = '';
                                        $text = array();
                                }
                            ?>
                                <tr>
                                    <td><?= $n ?></td>
                                    <td><?= $l->nip ?></td>
                                    <td><?= $l->nama_lengkap ?></td>
                                    <td><?= $l->jabatan ?></td>
                                    <td><?= $l->nilai_kompetensi ?></td>
                                    <td><?= $l->nilai_kinerja ?></td>
                                    <td><?= $l->jumlah_nilai ?></td>
                                    <td style="background-color: <?= $warna ?>;color:#fff">
                                        <center><span class="text-center"><b><?= $l->kuadran ?> : <?= $title ?></b></span></center>
                                        <ul style="padding-left: 20px">
                                            <?php
                                            foreach ($text as $t) {
                                            ?>
                                                <li><?= $t ?></li>
                                            <?php
                                            }
                                            ?>
                                        </ul>
                                    </td>
                                    <td class="text-center"><b><?= $n ?></b></td>
                                </tr>
                            <?php
                                $n++;
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

    </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="modalBox">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">9 Box</h4>
            </div>
            <div class="modal-body">
                <p style="text-align:center">Rumpun : <b><?= empty($selected_rumpun) ? 'Semua Rumpun' : $selected_rumpun ?></b>, Eselon : <b><?= empty($selected_eselon) ? 'Semua Eselon' : $selected_eselon ?></b></p>
                <div class="table-responsive">
                    <?php
                    if (empty($_SERVER['QUERY_STRING'])) {
                        $dan = "";
                    } else {
                        $dan = "&";
                    }
                    $filter_link = base_url('talenta/peringkat_talent?' . $_SERVER['QUERY_STRING'] . $dan . "kuadran=");
                    ?>
                    <table class="table table-bordered posisi">
                        <tbody>
                            <tr>
                                <td rowspan="3"><span style="writing-mode: tb-rl;
                                    transform: rotate(-180deg);">Kompetensi</span></td>
                                <td style="background-color:#fad859;color:black;">
                                    <a href="<?= $filter_link ?>4" style="color:white"><b><?= isset($count_kuadran[4]) ? $count_kuadran[4] : 0 ?></b></a>
                                </td>
                                <td style="background-color:#049372;color:white;">
                                
                                <a href="<?= $filter_link ?>7" style="color:white"><b><?= isset($count_kuadran[7]) ? $count_kuadran[7] : 0 ?></b></a></td>
                                <td style="background-color:#1e824c;color:white;"><a href="<?= $filter_link ?>9" style="color:white"><b><?= isset($count_kuadran[9]) ? $count_kuadran[9] : 0 ?></b></a></td>
                            </tr>
                            <tr>
                                <td style="background-color:#f03434;color:white;"><a href="<?= $filter_link ?>2" style="color:white"><b><?= isset($count_kuadran[2]) ? $count_kuadran[2] : 0 ?></b></a></td>
                                <td style="background-color:#fad859;color:black;"><a href="<?= $filter_link ?>5" style="color:white"><b><?= isset($count_kuadran[5]) ? $count_kuadran[5] : 0 ?></b></a></td>
                                <td style="background-color:#049372;color:white;"><a href="<?= $filter_link ?>8" style="color:white"><b><?= isset($count_kuadran[8]) ? $count_kuadran[8] : 0 ?></b></a></td>
                            </tr>
                            <tr>
                                <td style="background-color:#f03434;color:white;"><a href="<?= $filter_link ?>1" style="color:white"><b><?= isset($count_kuadran[1]) ? $count_kuadran[1] : 0 ?></b></a></td>
                                <td style="background-color:#f03434;color:white;"><a href="<?= $filter_link ?>3" style="color:white"><b><?= isset($count_kuadran[3]) ? $count_kuadran[3] : 0 ?></b></a></td>
                                <td style="background-color:#fad859;color:black;"><a href="<?= $filter_link ?>6" style="color:white"><b><?= isset($count_kuadran[6]) ? $count_kuadran[6] : 0 ?></b></a></td>
                            </tr>
                            <tr>
                                <td colspan="4">Kinerja</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>