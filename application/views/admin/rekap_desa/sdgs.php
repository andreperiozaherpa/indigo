<div class="container-fluid">

    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title"><?= $title ?></h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><?= $title ?></li>

            </ol>
        </div>
        <!-- /.col-lg-12 -->
    </div>

    <div class="row">
        <div class="col-sm-12">

            <div class="white-box">
                <form method="GET">
                    <div class="row">
                        <div class="col-md-3">
                            <label>Kecamatan</label>
                            <select name="id_kecamatan" class="form-control select2">
                                <option value="">Semua Kecamatan</option>
                                <?php
                                foreach ($kecamatan as $k) {
                                    $selected = $id_kecamatan == $k->id_skpd ? ' selected' : null;
                                    echo '<option value="' . $k->id_skpd . '"' . $selected . '>' . $k->nama_skpd . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label style="display: block;">&nbsp;</label>
                            <button type="submit" class="btn btn-primary">Filter</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="white-box">
                <?php

                $get_data = json_decode(curlMadasih('get_sdgs/' . $id_kecamatan));
                if($id_kecamatan!==''){
                    $detail_kecamatan = $get_data->detail_kecamatan;
                }else{
                    $detail_kecamatan = array();
                }
                ?>
                <div class="text-center">
                    <span style="font-weight: 500;font-size:16px;display:block">PERINGKAT PENGISIAN DESA CANTIK dan SDGs</span>
                    <span style="font-weight: 500;font-size:16px;display:block"><?= $detail_kecamatan ? $detail_kecamatan->nama_skpd : 'KABUPATEN SUMEDANG' ?></span>
                </div>
                <?php
                $tjumlah_pengisian = 0;
                $ttotal_kk = 0;


                $skpd = $get_data->list;
                $tjumlah_pengisian = $get_data->jumlah_pengisian;
                $ttotal_kk = $get_data->total_kk;

                $persentase = round(($tjumlah_pengisian / $ttotal_kk) * 100, 2);
                ?>

                <div class="m-b-20 text-center">
                    <div>Total Pengisian <span style="font-weight: 600;"><?= $tjumlah_pengisian ?>/<?= $ttotal_kk ?></span> <span class="text-purple" style="font-weight: 600;">(<?= $persentase ?>%)</span></div>
                </div>

                <table class="table color-table primary-table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Desa</th>
                            <th>Kecamatan</th>
                            <th>Jumlah Pengisian</th>
                            <th>Total KK</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($skpd as $s) {
                            $total_kk = $s->total_kk;
                            $persentase = $s->persentase;
                        ?>
                            <tr>
                                <td><?= $no ?></td>
                                <td><a target="_blank" href="<?=base_url('rekap_desa/detail_sdgs/'.$s->id_skpd)?>"><?= $s->nama_skpd ?></a></td>
                                <td><?= $s->kecamatan ?></td>
                                <td>
                                    <?= $s->jumlah_pengisian ?> <b>Keluarga</b>
                                    <span class="text-purple" style="font-weight: bold;float:right">(<?= $persentase ?>%)</span>
                                </td>
                                <td><?= $total_kk ?> <b>Keluarga</b></td>
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