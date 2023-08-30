<div class="container-fluid">

    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Rekap LKE - <?=$nama?></h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

            <ol class="breadcrumb">
                <li>Lembar Kerja Evaluasi</li>
                <li>Rekap</li>
                <li class="active"><?= $nama ?></li>
            </ol>
        </div>
        <!-- /.col-lg-12 -->
    </div>


    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">

            <div class="white-box">
                <center>
                    <h4>REKAP LEMBAR KERJA EVALUASI</h4>
                    <h4><?=$nama?></h4>
                </center>
                <hr>
            <table class="table color-table primary-table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th width="5%">No.</th>
                            <th>Kecamatan</th>
                            <th>Nilai</th>
                            <th width="10%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($list as $k => $l) {
                            $nilai = 0;
                            $indikator = $this->lembar_kerja_evaluasi_model->get_indikator($jenis_lke, 1,$l->id_skpd);
                            foreach($indikator as $i){
                                $nilai += $i->nilai;
                            }
                            $list[$k]->nilai = $nilai;
                        }
                        usort($list, function ($a, $b) {
                            if ($a->nilai == $b->nilai) return 0;
                            return $a->nilai < $b->nilai ? 1 : -1;
                            // return $a->jumlah_pengisian <=> $b->jumlah_pengisian;
                        });
                        foreach($list as $l){

                            
                        ?>
                            <tr>
                                <td><?= $no ?></td>
                                <td><?= $l->nama_skpd ?></td>
                                <td><b><?= $l->nilai ?></b></td>
                                <td><a target="blank" href="<?=base_url('lembar_kerja_evaluasi/koreksi_detail/'.$jenis_lke.'/'.$l->id_skpd)?>" class="btn btn-primary"><i class="ti-eye"></i> Detail</a></td>
                            </tr>
                        <?php
                            $no++;
                        }
                        ?>
                    </tbody>
                </table>
                <?php 
                ?>
            </div>

        </div>

    </div>