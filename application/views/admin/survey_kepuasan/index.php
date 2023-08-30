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
            <div class="white-box text-center">
                <h3 style="margin: 0px;">SURVEY KEPUASAN</h3>
                <h3 style="margin: 0px;" class="box-title">SEKRETARIAT DPRD</h3>
                <p>Triwulan <span style="font-weight: 500;" class="text-purple"><?= $triwulan ?></span> Tahun <span style="font-weight: 500;" class="text-purple"><?= $tahun ?></span></p>
                <!-- <h4 class="box-title text-purple">Filter Bulan dan Tahun</h4> -->
            </div>
        </div>
    </div>
    <div class="row">
        <?php
        foreach ($unit_kerja as $i) {
            $status = $this->survey_kepuasan_model->check_pengisian($i->id_unit_kerja, $triwulan, $tahun, $this->session->userdata('id_pegawai'));
        ?>
            <div class="col-md-6">
                <div class="white-box" style="padding-left:0px">
                    <div style="border-left : solid 4px #cc9353;padding-left:15px;display:flex;align-items:center">
                        <div>
                            <span>Survey Kepuasan</span>
                            <h3 class="box-title" style="margin-bottom: 0px;"><?= strtoupper($i->nama_unit_kerja) ?></h3>
                        </div>
                        <div style="margin-left: auto;display:flex;flex-direction:column;align-items:center">
                            <?php
                            if ($status) {
                            ?>

                                <span class="text-success" style="margin-bottom:4px"><i class="icon-check"></i> Sudah diisi</span>
                                <a href="javascript:void(0)" class="btn btn-primary pull-right btn-disabled" disabled>Lakukan Penilaian</a>
                            <?php
                            } else {
                            ?>
                                <span class="text-danger" style="margin-bottom:4px"><i class="icon-close"></i> Belum diisi</span>
                                <a href="<?= base_url('survey_kepuasan/form/' . $i->id_unit_kerja . '/' . $triwulan . '/' . $tahun) ?>" class="btn btn-primary pull-right">Lakukan Penilaian</a>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>