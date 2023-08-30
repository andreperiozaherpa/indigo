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
                                <button type="submit" value="1" name="download" class="btn btn-primary m-t-5"><i class="ti-download"></i>Download Word (.docx)</button>
                                <button type="submit" value="1" name="download_zip" class="btn btn-primary m-t-5"><i class="ti-file"></i>Download Semua pegawai(.zip)</button>
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
                                <th rowspan="2">No</th>
                                <th rowspan="2">NIP</th>
                                <th rowspan="2">Nama</th>
                                <th class="text-center" colspan="10">Jumlah Hari</th>
                                <th rowspan="2" style="text-align:center">Total Masuk Telat</th>
                                <th rowspan="2" style="text-align:center">Total Pulang Cepat</th>
                                <!-- <th rowspan="2" style="text-align:center">Total Waktu Kerja</th> -->
                                <th rowspan="2" style="text-align:center" width="300px">Aksi</th>
                            </tr>
                            <tr>
                                <th><span data-toggle="tooltip" title="Hadir">H</span></th>
                                <th><span data-toggle="tooltip" title="Tidak Absen Pulang">TAP</span></th>
                                <th><span data-toggle="tooltip" title="Sakit">S</span></th>
                                <th><span data-toggle="tooltip" title="Cuti">CT</span></th>
                                <th><span data-toggle="tooltip" title="Tanpa Keterangan">TK</span></th>
                                <th><span data-toggle="tooltip" title="Dinas Dalam">DD</span></th>
                                <th><span data-toggle="tooltip" title="Dinas Luar">DL</span></th>
                                <th><span data-toggle="tooltip" title="Isolasi Mandiri">IM</span></th>
                                <th><span data-toggle="tooltip" title="Work from Home">WFH</span></th>
                                <th><span data-toggle="tooltip" title="Masa Persiapan Pensiun">MPP</span></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($dt_pegawai)) {
                                $no = 1;
                                foreach ($dt_pegawai as $row) { 
                                    $api_key = $row->api_key;
                                    if(empty($api_key)){
                                        $api_key = 0;
                                    }
                                    $ket_log = ['sakit','cuti','tk','dd','dl','im','wfh','mpp'];
                                    ?>
                                    <tr>
                                        <td align="center"><?= $no; ?></td>
                                        <td><?= $row->nip; ?></td>
                                        <td><?= $row->nama_lengkap ?></td>
                                        <td align="center" style="background-color: #dcbffc;font-weight:500"><?= $row->hadir; ?></td>
                                        <td align="center" style="background-color: #dcbffc;font-weight:500"><?=$row->tap?></td>
                                        <?php 
                                            foreach($ket_log as $log){
                                                if($log=="sakit"||$log=="cuti"||$log=="tk"){
                                                    $style = "background-color: #dcbffc;font-weight:500";
                                                }else{
                                                    $style = "";
                                                }
                                                ?>
                                                <td style="<?=$style?>"><?=$row->$log?></td>
                                                <?php
                                            }
                                        ?>
                                        <td align="center"><?= convert_minute($row->masuk_telat); ?></td>
                                        <td align="center"><?= convert_minute($row->pulang_cepat); ?></td>
                                        <td class="text-center">
                                    <a target="_blank" href="<?=base_url('absensi/rekapitulasi/generate_download/'.$bulan.'/'.$tahun.'/'.$api_key.'/'.urlencode(base64_encode($row->id_pegawai)))?>?map=1" class="btn btn-primary">Lihat detail</a>
                                            <a target="_blank" href="<?= base_url('absensi/laporan/download_rekapitulasi_pegawai/' . $row->api_key . '/' . $bulan . '/' . $tahun) ?>" class="btn btn-primary"><i class="ti-download"></i> Download</a>
                                        </td>

                                    </tr>
                            <?php $no++;
                                }
                            }else{
                                ?>
                                <tr>
                                    <td colspan="16">
                                        <center>
                                            <h4 class="text-purple" style="font-weight:600">Opps..</h4>
                                            <p>Data tidak ditemukan</p>
                                        </center>
                                    </td>
                                </tr>
                                <?php
                            } ?>
                        </tbody>
                    </table>
                    <hr>
                    <span style="display: block;font-weight:500">Keterangan</span>
                    <table>
                        <tr>
                            <td>H</td>
                            <td width="30px" class="text-center">:</td>
                            <td>Hadir</td>
                        </tr>
                        <tr>
                            <td>TAP</td>
                            <td width="30px" class="text-center">:</td>
                            <td>Tidak Absen Pulang</td>
                        </tr>
                        <tr>
                            <td>S</td>
                            <td width="30px" class="text-center">:</td>
                            <td>Sakit</td>
                        </tr>
                        <tr>
                            <td>CT</td>
                            <td width="30px" class="text-center">:</td>
                            <td>Cuti</td>
                        </tr>
                        <tr>
                            <td>TK</td>
                            <td width="30px" class="text-center">:</td>
                            <td>Tanpa Keterangan</td>
                        </tr>
                        <tr>
                            <td>DD</td>
                            <td width="30px" class="text-center">:</td>
                            <td>Dinas Dalam</td>
                        </tr>
                        <tr>
                            <td>DL</td>
                            <td width="30px" class="text-center">:</td>
                            <td>Dinas Luar</td>
                        </tr>
                        <tr>
                            <td>IM</td>
                            <td width="30px" class="text-center">:</td>
                            <td>Isolasi Mandiri</td>
                        </tr>
                        <tr>
                            <td>WFH</td>
                            <td width="30px" class="text-center">:</td>
                            <td>Work from Home</td>
                        </tr>
                        <tr>
                            <td>MPP</td>
                            <td width="30px" class="text-center">:</td>
                            <td>Masa Persiapan Pensiun</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>