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
            <h4 class="page-title">Peringkat Talent Guru</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <?php echo breadcrumb($this->uri->segment_array()); ?>
            </ol>
        </div>
        <!-- /.col-lg-12 -->
    </div>

    <!-- <pre>
        <?php print_r($list[0])?>
    </pre> -->



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
                                        <option value="">Guru</option>
                                        <!-- <option value="II.">II.a & II.b</option>
                                        <option value="III.">III.a, III.b & JF Ahli Madya</option>
                                        <option value="IV.">IV.a, IV.b & JFT</option> -->
                                        <!-- <option value="">Semua Eselon</option> -->
                                        <!-- <?php
                                        foreach ($eselon as $e) {
                                            $selected = $r == $selected_eselon ? ' selected' : '';
                                            echo '<option value="' . $e . '"' . $selected . '>' . $e . '</option>';
                                        }
                                        ?> -->
                                    </select>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <br>
                                <button type="submit" value="1" name="filter"
                                    class="btn btn-primary m-t-5 btn-outline"><i class="ti-filter"></i>Filter</button>
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
                    <h3>DAFTAR PERINGKAT TALENT GURU</h3>

                    <p>Rumpun : <b><?= empty($selected_rumpun) ? 'Semua Rumpun' : $selected_rumpun ?></b>, Eselon :
                        <b><?= empty($selected_eselon) ? 'Semua Eselon' : $selected_eselon ?></b>
                    </p>
                    <a href="javascript:void(0)" data-toggle="modal" data-target="#modalBox"
                        class="btn btn-primary btn-sm btn-rounded">Lihat 9 Box</a>
                </center>
                <button onclick="downloadExcel('tablePeringkat','Daftar Peringkat Talent')"
                    class="btn btn-primary">Download</button>
                <div class="table-responsives hidden">
                    <table id="tablePeringkat" class="table table-striped">
                        <thead>
                            <tr>
                                <th width="10px">No</th>
                                <th>NIP</th>
                                <th>Nama Lengkap</th>
                                <th>Jabatan</th>
                                <th>SKPD</th>
                                <th>Eselon</th>
                                <th>Nilai Potensi</th>
                                <th>Nilai Kinerja</th>
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
                                        $title = 'Kinerja di bawah ekspektasi dan potensial rendah';
                                        $text = array('Diproses sesuai ketentuan peraturan perundangan');
                                        break;
                                    case 2:
                                        $warna = '#f03434';
                                        $title = 'Kinerja sesuai ekspektasi dan potensial rendah';
                                        $text = array('Bimbingan kinerja','Pengembangan kompetensi','Penempatan yang sesuai');
                                        break;
                                    case 3:
                                        $warna = '#f03434';
                                        $title = 'Kinerja di bawah ekspektasi dan potensial menengah';
                                        $text = array('Bimbingan kinerja','Konseling kinerja','Pengembangan kompetensi','Penempatan yang sesuai');
                                        break;
                                    case 4:
                                        $warna = '#fad859';
                                        $title = 'Kinerja di atas ekspektasi dan potensial rendah';
                                        $text = array('Rotasi','Pengembangan kompetensi');
                                        break;
                                    case 5:
                                        $warna = '#fad859';
                                        $title = 'Kinerja sesuai ekspektasi dan potensial menengah';
                                        $text = array('Penempatan yang sesuai','Bimbingan kinerja','Pengembangan kompetensi');
                                        break;
                                    case 6:
                                        $warna = '#fad859';
                                        $title = 'Kinerja di bawah ekspektasi dan potensial tinggi';
                                        $text = array('Penempatan yang sesuai','Bimbingan kinerja','Konseling kinerja');
                                        break;
                                    case 7:
                                        $warna = '#049372';
                                        $title = 'Kinerja di atas ekspektasi dan potensial menengah';
                                        $text = array('Dipertahankan','Masuk Kelompok Rencana Suksesi Instansi','Rotasi/Pengayaan jabatan','Pengembangan kompetensi','Tugas belajar');
                                        break;
                                    case 8:
                                        $warna = '#049372';
                                        $title = 'Kinerja sesuai ekspektasi dan potensial tinggi';
                                        $text = array('Dipertahankan','Masuk Kelompok Rencana Suksesi Instansi','Rotasi/Perluasan jabatan','Bimbingan kinerja');
                                        break;
                                    case 9:
                                        $warna = '#1e824c';
                                        $title = 'Kinerja di atas ekspektasi dan potensial tinggi';
                                        $text = array('Dipromosikan dan dipertahankan','Masuk Kelompok Rencana Suksesi Instansi/Nasional','Penghargaan');
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
                                <td><?= $l->nama_skpd ?></td>
                                <td><?= $l->eselon ?></td>
                                <td>
                                    <a class="mytooltip" href="javascript:void(0)"
                                        style="color: #6003c8; z-index: 1050;">
                                        <?= $l->nilai_potensi ?> <span class="tooltip-content5"
                                            style="width: 300px;"><span class="tooltip-text3"
                                                style="background: #f6f3ff; padding: unset; border-bottom: 10px solid #6003c8;"><span
                                                    class="tooltip-inner2" style="padding: unset">
                                                    <h4 class="text-center text-white bg-primary">Nilai Potensi</h4>
                                                    <div class="col-xs-12 tooltip-inner2"
                                                        style="background: #f6f3ff; padding: 10px;">
                                                        <h5>Assestment <span
                                                                class="pull-right"><?= $l->skor_assestment ?></span>
                                                        </h5>
                                                        <div class="progress">
                                                            <div class="progress-bar progress-bar-info"
                                                                role="progressbar"
                                                                aria-valuenow="<?= $l->skor_assestment ?>"
                                                                aria-valuemin="0" aria-valuemax="100"
                                                                style="width:<?= $l->skor_assestment ?>%;"> <span
                                                                    class="sr-only"><?= $l->skor_assestment ?>%
                                                                    Complete</span> </div>
                                                        </div>
                                                        <h5>Pendidikan <span
                                                                class="pull-right"><?= $l->skor_pendidikan ?></span>
                                                        </h5>
                                                        <div class="progress">
                                                            <div class="progress-bar progress-bar-info"
                                                                role="progressbar"
                                                                aria-valuenow="<?= $l->skor_pendidikan ?>"
                                                                aria-valuemin="0" aria-valuemax="100"
                                                                style="width:<?= $l->skor_pendidikan ?>%;"> <span
                                                                    class="sr-only"><?= $l->skor_pendidikan ?>%
                                                                    Complete</span> </div>
                                                        </div>
                                                        <h5>Pangkat/Golongan <span
                                                                class="pull-right"><?= $l->skor_masa_kerja ?></span>
                                                        </h5>
                                                        <div class="progress">
                                                            <div class="progress-bar progress-bar-info"
                                                                role="progressbar"
                                                                aria-valuenow="<?= $l->skor_masa_kerja ?>"
                                                                aria-valuemin="0" aria-valuemax="100"
                                                                style="width:<?= $l->skor_masa_kerja ?>%;"> <span
                                                                    class="sr-only"><?= $l->skor_masa_kerja ?>%
                                                                    Complete</span> </div>
                                                        </div>
                                                        <h5>Jabatan <span
                                                                class="pull-right"><?= $l->skor_jabatan ?></span></h5>
                                                        <div class="progress">
                                                            <div class="progress-bar progress-bar-success"
                                                                role="progressbar"
                                                                aria-valuenow="<?= $l->skor_jabatan ?>"
                                                                aria-valuemin="0" aria-valuemax="100"
                                                                style="width:<?= $l->skor_jabatan ?>%;"> <span
                                                                    class="sr-only"><?= $l->skor_jabatan ?>%
                                                                    Complete</span> </div>
                                                        </div>
                                                        <h5>Pelatihan <span
                                                                class="pull-right"><?= $l->skor_pelatihan ?></span></h5>
                                                        <div class="progress">
                                                            <div class="progress-bar progress-bar-info"
                                                                role="progressbar"
                                                                aria-valuenow="<?= $l->skor_pelatihan ?>"
                                                                aria-valuemin="0" aria-valuemax="100"
                                                                style="width:<?= $l->skor_pelatihan ?>%;"> <span
                                                                    class="sr-only"><?= $l->skor_pelatihan ?>%
                                                                    Complete</span> </div>
                                                        </div>
                                                        <h5>Wawancara <span
                                                                class="pull-right"><?= $l->skor_wawancara ?></span></h5>
                                                        <div class="progress">
                                                            <div class="progress-bar progress-bar-success"
                                                                role="progressbar"
                                                                aria-valuenow="<?= $l->skor_wawancara ?>"
                                                                aria-valuemin="0" aria-valuemax="100"
                                                                style="width:<?= $l->skor_wawancara ?>%;"> <span
                                                                    class="sr-only"><?= $l->skor_wawancara ?>%
                                                                    Complete</span> </div>
                                                        </div>
                                                    </div>

                                                </span></span></span></a>
                                </td>
                                <td>
                                    <a class="mytooltip" href="javascript:void(0)"
                                        style="color: #6003c8; z-index: 1050;">
                                        <?= $l->nilai_kompetensi ?> <span class="tooltip-content5"
                                            style="width: 300px;"><span class="tooltip-text3"
                                                style="background: #f6f3ff; padding: unset; border-bottom: 10px solid #6003c8;"><span
                                                    class="tooltip-inner2" style="padding: unset">
                                                    <h4 class="text-center text-white bg-primary">Nilai Kinerja</h4>
                                                    <div class="col-xs-12 tooltip-inner2"
                                                        style="background: #f6f3ff; padding: 10px;">
                                                        <h5>PPK PNS <span
                                                                class="pull-right"><?= $l->skor_ppk_pns ?></span></h5>
                                                        <div class="progress">
                                                            <div class="progress-bar progress-bar-success"
                                                                role="progressbar"
                                                                aria-valuenow="<?= $l->skor_ppk_pns ?>"
                                                                aria-valuemin="0" aria-valuemax="100"
                                                                style="width:<?= $l->skor_ppk_pns ?>%;"> <span
                                                                    class="sr-only"><?= $l->skor_ppk_pns ?>%
                                                                    Complete</span> </div>
                                                        </div>
                                                        <h5>Prestasi <span
                                                                class="pull-right"><?= $l->skor_prestasi ?></span></h5>
                                                        <div class="progress">
                                                            <div class="progress-bar progress-bar-info"
                                                                role="progressbar"
                                                                aria-valuenow="<?= $l->skor_prestasi ?>"
                                                                aria-valuemin="0" aria-valuemax="100"
                                                                style="width:<?= $l->skor_prestasi ?>%;"> <span
                                                                    class="sr-only"><?= $l->skor_prestasi ?>%
                                                                    Complete</span> </div>
                                                        </div>
                                                        <h5>Penugasan <span
                                                                class="pull-right"><?= $l->skor_penugasan ?></span></h5>
                                                        <div class="progress">
                                                            <div class="progress-bar progress-bar-primary"
                                                                role="progressbar"
                                                                aria-valuenow="<?= $l->skor_penugasan ?>"
                                                                aria-valuemin="0" aria-valuemax="100"
                                                                style="width:<?= $l->skor_penugasan ?>%;"> <span
                                                                    class="sr-only"><?= $l->skor_penugasan ?>%
                                                                    Complete</span> </div>
                                                        </div>
                                                        <h5>Perilaku <span class="pull-right"><?= $l->skor_peer ?>
                                                                <?= ($l->skor_peer > 2) ? '<i class="fa fa-thumbs-o-up">' : '<i class="fa fa-thumbs-o-down">' ?>
                                                                </i></span></h5>
                                                        <div class="progress">
                                                            <div class="progress-bar progress-bar-info"
                                                                role="progressbar" aria-valuenow="<?= $l->skor_peer ?>"
                                                                aria-valuemin="0" aria-valuemax="5"
                                                                style="width:<?= $l->skor_peer*20 ?>%;"> <span
                                                                    class="sr-only"><?= $l->skor_peer*20 ?>%
                                                                    Complete</span> </div>
                                                        </div>
                                                        <h5>Presensi <span
                                                                class="pull-right"><?= $l->skor_tpp ?>%</span></h5>
                                                        <div class="progress">
                                                            <div class="progress-bar progress-bar-danger"
                                                                role="progressbar" aria-valuenow="<?= $l->skor_tpp ?>"
                                                                aria-valuemin="0" aria-valuemax="100"
                                                                style="width:<?= $l->skor_tpp ?>%;"> <span
                                                                    class="sr-only"><?= $l->skor_tpp ?>% Complete</span>
                                                            </div>
                                                        </div>
                                                        <h5>Kinerja Harian <span class="pull-right"><?= $l->skor_lkh ?>
                                                                <i class="fa fa-star-o"></i></span></h5>
                                                        <div class="progress">
                                                            <div class="progress-bar progress-bar-info"
                                                                role="progressbar" aria-valuenow="<?= $l->skor_lkh ?>"
                                                                aria-valuemin="0" aria-valuemax="5"
                                                                style="width:<?= $l->skor_lkh*20 ?>%;"> <span
                                                                    class="sr-only"><?= $l->skor_lkh*20 ?>%
                                                                    Complete</span> </div>
                                                        </div>
                                                    </div>
                                                </span></span></span></a>
                                </td>

                                <td style="background-color: <?= $warna ?>;color:#fff">
                                    <center><span class="text-center"><b><?= $l->kuadran ?> : <?= $title ?></b></span>
                                    </center>
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
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">9 Box</h4>
            </div>
            <div class="modal-body">
                <p style="text-align:center">Rumpun :
                    <b><?= empty($selected_rumpun) ? 'Semua Rumpun' : $selected_rumpun ?></b>, Eselon :
                    <b><?= empty($selected_eselon) ? 'Semua Eselon' : $selected_eselon ?></b>
                </p>
                <div class="table-responsive">
                    <?php
                    if (empty($_SERVER['QUERY_STRING'])) {
                        $dan = "";
                    } else {
                        $dan = "&";
                    }
                    $filter_link = base_url('talenta/peringkat_talent/ranking?' . $_SERVER['QUERY_STRING'] . $dan . "kuadran=");
                    ?>
                    <table class="table table-bordered posisi">
                        <tbody>
                            <tr>
                                <td rowspan="4"><span style="writing-mode: tb-rl;
                                    transform: rotate(-180deg);">Kinerja</span></td>
                                <?php if($nilai_kuadran and true){ ?>
                                <td><span class="badge badge-success"><?=number_format($nilai_kuadran['std_up_ko'], 2)?>
                                        - <?=number_format($nilai_kuadran['max_ko'], 2)?></span></td>
                                <?php } ?>
                                <td style="background-color:#fad859;color:black;">
                                    <a href="<?= $filter_link ?>4"
                                        style="color:white"><b><?= isset($count_kuadran[4]) ? $count_kuadran[4] : 0 ?></b></a>
                                </td>
                                <td style="background-color:#049372;color:white;">

                                    <a href="<?= $filter_link ?>7"
                                        style="color:white"><b><?= isset($count_kuadran[7]) ? $count_kuadran[7] : 0 ?></b></a>
                                </td>
                                <td style="background-color:#1e824c;color:white;"><a href="<?= $filter_link ?>9"
                                        style="color:white"><b><?= isset($count_kuadran[9]) ? $count_kuadran[9] : 0 ?></b></a>
                                </td>
                            </tr>
                            <tr>
                                <?php if($nilai_kuadran and true){ ?>
                                <td><span class="badge badge-warning"><?=number_format($nilai_kuadran['std_do_ko'], 2)?>
                                        - <?=number_format($nilai_kuadran['std_up_ko'], 2)-0.01?></span></td>
                                <?php } ?>
                                <td style="background-color:#f03434;color:white;"><a href="<?= $filter_link ?>2"
                                        style="color:white"><b><?= isset($count_kuadran[2]) ? $count_kuadran[2] : 0 ?></b></a>
                                </td>
                                <td style="background-color:#fad859;color:black;"><a href="<?= $filter_link ?>5"
                                        style="color:white"><b><?= isset($count_kuadran[5]) ? $count_kuadran[5] : 0 ?></b></a>
                                </td>
                                <td style="background-color:#049372;color:white;"><a href="<?= $filter_link ?>8"
                                        style="color:white"><b><?= isset($count_kuadran[8]) ? $count_kuadran[8] : 0 ?></b></a>
                                </td>
                            </tr>
                            <tr>
                                <?php if($nilai_kuadran and true){ ?>
                                <td><span class="badge badge-danger"><?=number_format($nilai_kuadran['min_ko'], 2)?> -
                                        <?=number_format($nilai_kuadran['std_do_ko'], 2)-0.01?></span></td>
                                <?php } ?>
                                <td style="background-color:#f03434;color:white;"><a href="<?= $filter_link ?>1"
                                        style="color:white"><b><?= isset($count_kuadran[1]) ? $count_kuadran[1] : 0 ?></b></a>
                                </td>
                                <td style="background-color:#f03434;color:white;"><a href="<?= $filter_link ?>3"
                                        style="color:white"><b><?= isset($count_kuadran[3]) ? $count_kuadran[3] : 0 ?></b></a>
                                </td>
                                <td style="background-color:#fad859;color:black;"><a href="<?= $filter_link ?>6"
                                        style="color:white"><b><?= isset($count_kuadran[6]) ? $count_kuadran[6] : 0 ?></b></a>
                                </td>
                            </tr>
                            <?php if($nilai_kuadran and true){ ?>
                            <tr>
                                <td>Range Nilai</td>
                                <td><span class="badge badge-danger"><?=number_format($nilai_kuadran['min_po'], 2)?> -
                                        <?=number_format($nilai_kuadran['std_do_po'], 2)-0.01?></span></td>
                                <td><span class="badge badge-warning"><?=number_format($nilai_kuadran['std_do_po'], 2)?>
                                        - <?=number_format($nilai_kuadran['std_up_po'], 2)-0.01?></span></td>
                                <td><span class="badge badge-success"><?=number_format($nilai_kuadran['std_up_po'], 2)?>
                                        - <?=number_format($nilai_kuadran['max_po'], 2)?></span></td>
                            </tr>
                            <?php } ?>
                            <tr>
                                <td colspan="5">Potensi</td>
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

<div class="modal fade" role="dialog" id="modalAuth">
    <div class=" modal-dialog" role="document">
        <div class="modal-content">
            <form action="javascript:void(0)" id="auth-form" onsubmit="talentaAuth()">
                <div class="modal-header">
                    <h4 class="modal-title">Authentication</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xs-12">
                            <input id="auth-pass" type="password" class="form-control" />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Enter</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
$(document).ready(function() {

    $('#page-wrapper').block({
        message: '<h4><img src="https://e-office.sumedangkab.go.id/asset/pixel/plugins/images/busy.gif" /> Konten Dikunci...</h4>',
        css: {
            border: '1px solid #fff'
        }
    });
    $('#tablePeringkat').DataTable({
        "displayLength": 50,
    });
    $('#tablePeringkat').parents('div.dataTables_wrapper').first().hide();
    talentaAuth();


    // setCookie('talentaAuth','<?=md5($this->session->userdata('user_id'))?>',1);

});



function talentaAuth() {
    let kode = "";
    if (getCookie("talentaAuth") == "") {
        $("#modalAuth").attr("style", "display:block;");
        $("#modalAuth").addClass("in");
        // kode = prompt("Authentication code :", "");
        kode = $("#auth-pass").val();
        kode = window.btoa(kode);
    }

    if (kode == "Nzg5MTIzMw==" || getCookie("talentaAuth") != "") {
        setCookie('talentaAuth', '<?=md5($this->session->userdata('user_id'))?>', 0.1);
        $('#tablePeringkat').parents('div.dataTables_wrapper').first().show();
        $('.table-responsives').removeClass("hidden");
        unblock_ui("#page-wrapper");
        $("#modalAuth").attr("style", "display:none;");
        $("#modalAuth").removeClass("in");
    } else {
        setCookie('talentaAuth', '<?=md5($this->session->userdata('user_id'))?>', 0);
        alert("Authentication Failed");
        // talentaAuth();
    }
}
</script>