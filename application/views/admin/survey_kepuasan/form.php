<div class="container-fluid">

    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Survey Kepuasan</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li>Survey Kepuasan</li>
                <li class="active">Input</li>
            </ol>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="white-box">
                <form method="POST">
                    <h4 class="box-title text-purple">Survey Kepuasan Pelayanan Sekretariat DPRD</h4>
                    <table>
                        <tr>
                            <td>Unit Kerja</td>
                            <td style="width: 50px;text-align:center">:</td>
                            <td style="font-weight: 500;"><?= $detail_unit_kerja->nama_unit_kerja ?></td>
                        </tr>
                        <tr>
                            <td>Triwulan</td>
                            <td style="width: 50px;text-align:center">:</td>
                            <td style="font-weight: 500;">Ke - <?= $triwulan ?></td>
                        </tr>
                        <tr>
                            <td>Tahun</td>
                            <td style="width: 50px;text-align:center">:</td>
                            <td style="font-weight: 500;"><?= $tahun ?></td>
                        </tr>
                    </table>
                    <hr>
                    <?php
                    if ($status_pengisian) {
                    ?>
                        <center>
                            <h4 class="box-title">TERIMA KASIH</h4>
                            <p>Anda sudah mengisi survey kepuasan</p>
                            <a href="<?= base_url('survey_kepuasan') ?>" class="btn btn-primary btn-outline" style="margin-top:12px">Kembali</a>
                        </center>
                    <?php
                    } else {
                    ?>
                        <div class="alert alert-info"><i class="icon-info"></i> Silahkan isi pertanyaan dibawah ini dengan se-objektif mungkin</div>

                        <?php $no = 1;
                        foreach ($pertanyaan as $p) {
                        ?>
                            <div class="form-group" style="margin-top: 20px;">
                                <span style="display: block;margin-bottom:15px;font-size:18px"><b><?= $no ?></b>. <?= $p->pertanyaan ?><sup class="text-danger">*</sup></span>

                                <?php
                                if ($p->jenis_data == 'radio') {
                                    $pilihan = $this->survey_kepuasan_model->get_pilihan($p->id_survey_kepuasan_pertanyaan);
                                    foreach ($pilihan as $k => $pi) {
                                ?>
                                        <input type="radio" style="height: auto;" id="j<?= $no . $k ?>" name="jawaban[<?= $p->id_survey_kepuasan_pertanyaan ?>]" value="<?= $pi->id_survey_kepuasan_pilihan ?>">
                                        <label for="j<?= $no . $k ?>"><?= $pi->pilihan ?></label><br>
                                    <?php
                                    }
                                } else if ($p->jenis_data == 'textarea') {
                                    ?>
                                    <textarea class="form-control" name="jawaban[<?= $p->id_survey_kepuasan_pertanyaan ?>]" placeholder="Masukkan Isian"></textarea>
                                <?php
                                }
                                ?>
                            </div>
                        <?php $no++;
                        } ?>
                        <button type="submit" class="btn btn-primary"><i class="ti-save"></i> Simpan</button>
                    <?php
                    }
                    ?>
                </form>
            </div>
        </div>
    </div>
</div>