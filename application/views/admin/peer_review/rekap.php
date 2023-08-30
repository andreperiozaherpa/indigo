<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Laporan Rekapitulasi Absen</h4>
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
                                    <label class="control-label">SKPD</label>
                                    <select name="id_skpd" class="form-control select2" required>
                                        <?php
                                        foreach ($skpd as $s) {
                                            $selected = (!empty($id_skpd) && $id_skpd == $s->id_skpd) ? ' selected' : '';
                                            echo '<option value="' . $s->id_skpd . '"' . $selected . '>' . $s->nama_skpd . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">

                                <div class="form-group">
                                    <label class="control-label"> Bulan</label>
                                    <select class="form-control select2" name="bulan" id="bulan">
                                        <?php
                                        for ($i = 1; $i <= 12; $i++) {
                                            $selected = (!empty($bulan) && $bulan == $i) ? "selected" : "";
                                            $b = date("M", strtotime(date("Y") . "-" . $i . "-01"));
                                            echo "<option $selected value='$i' >$b</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">


                                <div class="form-group">
                                    <label class="control-label"> Tahun</label>
                                    <select class="form-control select2" id="tahun" name="tahun">
                                        <?php
                                        for ($i = 2020; $i <= date("Y"); $i++) {
                                            $selected = (!empty($tahun) && $tahun == $i) ? "selected" : "";

                                            echo "<option $selected value='$i' >$i</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-6">
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
        <div class="col-md-12">
            <div class="white-box">
                <div class="row">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NIP</th>
                                <th>Nama</th>
                                <th>Rata-Rata Nilai</th>
                                <th style="text-align:center" width="300px">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($pegawai)) {
                                $no = 1;
                                foreach ($pegawai as $row) { 
                                    ?>
                                    <tr>
                                        <td align="center"><?= $no; ?></td>
                                        <td><?= $row->nip; ?></td>
                                        <td><?= $row->nama_lengkap ?></td>
                                        <td>
                                        <span style="font-weight: 500;display:block">
                                        <?= $row->total_pertanyaan > 0 ? round($row->total_nilai/$row->total_pertanyaan,2) : 0 ?>
                                        </span>
                                        <small>dari <?=count($row->array_penilai)?> Penilai</small>
                                        </td>
                                        <td class="text-center">
                                    <a target="_blank" href="" class="btn btn-primary">Lihat detail</a>
                                        </td>

                                    </tr>
                            <?php $no++;
                                }
                            } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>