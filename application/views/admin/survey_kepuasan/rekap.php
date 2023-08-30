<div class="container-fluid">

    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Survey Kepuasan</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li>Survey Kepuasan</li>
                <li class="active">Rekap</li>
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
                            <label>Triwulan</label>
                            <select name="triwulan" class="form-control select2">
                                <?php
                                for ($t = 1; $t <= 3; $t++) {
                                    $selected = $t == $filter['triwulan'] ? ' selected' : null;
                                ?>
                                    <option value="<?= $t ?>" <?= $selected ?>>Triwulan ke-<?= $t ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label>Tahun</label>

                            <select name="tahun" class="form-control select2">
                                <?php
                                for ($t = 2021; $t <= 2021 + 5; $t++) {
                                    $selected = $t == $filter['tahun'] ? ' selected' : null;
                                ?>
                                    <option value="<?= $t ?>" <?= $selected ?>><?= $t ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label style="display: block;">&nbsp;</label>
                            <button type="submit" class="btn btn-outline btn-primary"><i class="ti-filter"></i> Filter</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="white-box">
                <h3 style="margin: 0px;" class="text-center">REKAP SURVEY KEPUASAN</h3>
                <h3 style="margin: 0px;" class="box-title text-center">SEKRETARIAT DPRD</h3>
                <p class="text-center">Triwulan <span style="font-weight: 500;" class="text-purple"><?= $filter['triwulan'] ?></span> Tahun <span style="font-weight: 500;" class="text-purple"><?= $filter['tahun'] ?></span></p>
                <hr>

                <table class="table color-table primary-table">
                    <thead>
                        <tr>
                            <th width="20px">No.</th>
                            <th>Nama Unit Kerja</th>
                            <th>Skor</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($unit_kerja as $i) {
                            $skor = $this->survey_kepuasan_model->get_skor($i->id_unit_kerja, $filter['triwulan'], $filter['tahun']);
                        ?>
                            <tr>
                                <td><?= $no ?></td>
                                <td><?= $i->nama_unit_kerja ?></td>
                                <td><span class="text-purple" style="font-weight: 500;"><?= $skor ?></span></td>
                            </tr>
                        <?php
                            $no++;
                        }
                        ?>
                    </tbody>
                </table>
                <table>
                    <tr>
                        <th width="50px">Skor</th>
                        <th>Keterangan</th>
                    </tr>
                    <tr>
                        <td>0 - 1</td>
                        <td>Kurang</td>
                    </tr>
                    <tr>
                        <td>1.1 - 2</td>
                        <td>Cukup</td>
                    </tr>
                    <tr>
                        <td>2.1 - 3</td>
                        <td>Baik</td>
                    </tr>
                    <tr>
                        <td>3.1 - 4</td>
                        <td>Sangat Baik</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>