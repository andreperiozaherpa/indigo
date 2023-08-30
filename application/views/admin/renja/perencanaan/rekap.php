<div class="container-fluid">

    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Rekap SAKIP Kecamatan</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li>Renja Perencanaan</li>
                <li>Rekap</li>
                <li class="active">Kecamatan</li>
            </ol>
        </div>
        <!-- /.col-lg-12 -->
    </div>


    <div class="row">
        <div class="col-md-12">
            <div class="white-box">
                <form>
                    <div class="row">
                        <div class="col-md-4">
                            <label>Tahun</label>
                            <select name="tahun" class="form-control">
                                <?php 
                                if(isset($_GET['tahun'])){
                                    $tahun = $_GET['tahun'];
                                }else{
                                    $tahun = $default_tahun;
                                }
                                    for($t=2019;$t<=2023;$t++){
                                        $selected = $t == $tahun ? 'selected' : null;
                                        echo '<option value="'.$t.'"'.$selected.'>'.$t.'</option>';
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label style="display: block;">&nbsp;</label>
                            <button type="submit" class="btn btn-primary">Pilih Tahun</button>
                        </div>
                    </div>
                </form>
                <hr>
                <table class="table color-table primary-table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th width="5%">Peringkat</th>
                            <th>Kecamatan</th>
                            <th>Persentase</th>
                            <th width="7%">Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;

                        usort($list, function ($a, $b) {
                            if ($a->grafik_capaian == $b->grafik_capaian) return 0;
                            return $a->grafik_capaian < $b->grafik_capaian ? 1 : -1;
                            // return $a->jumlah_pengisian <=> $b->jumlah_pengisian;
                        });
                        foreach ($list as $l) {
                        ?>
                            <tr>
                                <td style="text-align: center;"><?= $no ?></td>
                                <td><?= $l->nama_skpd ?></td>
                                <td>

                                    <div class="progress progress-lg">
                                        <div class="progress-bar progress-bar-primary" role="progressbar" style="width: <?= round($grafik_capaian[$l->id_skpd], 1) ?>%;" role="progressbar"> <?= round($grafik_capaian[$l->id_skpd], 1) ?>% </div>
                                    </div>
                                </td>
                                <td>
                                    <a target="blank" href="<?=base_url('renja_perencanaan/view/'.$l->id_skpd)?>" class="btn btn-primary"><i class="ti-eye"></i> Lihat Detail</a>
                                </td>
                            </tr>
                        <?php
                            $no++;
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>