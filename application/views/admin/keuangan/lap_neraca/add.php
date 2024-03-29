<div class="container-fluid">

    <div class="row bg-title">
        <div class="col-lg-6 col-md-6 col-sm-4 col-xs-12">
            <h4 class="page-title">Rekonsiliasi Laporan Neraca</h4>
        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <ol class="breadcrumb">
                <li>Lap. Neraca</li>
                <li class="active">Tambah</li>
            </ol>
        </div>
        <!-- /.col-lg-12 -->
    </div>

    <?php
    if (isset($message)) {
    ?>
        <div class="alert alert-<?= $message_type ?> alert-dismissible fade show" role="alert">
            <p><?= $message ?></p>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="feather icon-x-circle"></i></span>
            </button>
        </div>
    <?php
    }
    ?>


    <div class="row">
        <form id="form" method="POST" enctype="multipart/form-data">
            <div class="col-sm-12">
                <div class="white-box">
                    <h3 class="box-title m-b-0">Laporan neraca</h3>
                    <p class="text-muted m-b-30 font-13"> Silakan isi data dibawah ini</p>
                    <div id="exampleBasic" class="wizard">
                        <ul class="wizard-steps" role="tablist">
                            <li class="active" role="tab">
                                <h4><span>1</span>Informasi</h4>
                            </li>
                            <li role="tab">
                                <h4><span>2</span>Isi Laporan</h4>
                            </li>
                            <li role="tab">
                                <h4><span>3</span>Penandatangan</h4>
                            </li>
                        </ul>
                        <div class="wizard-content">
                            <!-- awal tab informasi -->
                            <div class="wizard-pane active" role="tabpanel">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="col-sm-12">SKPD</label>
                                            <div class="col-sm-12">
                                                <input type="hidden" name="id_skpd" id="hidden-id_skpd">
                                                <select name="id_skpd" id="edit-id_skpd" onchange="getPegawaiSKPD(this.value)" class="form-control select2">
                                                    <option value="0">--Pilih SKPD--</option>
                                                    <?php foreach ($skpd as $s) { ?>
                                                        <option value="<?= $s->id_skpd ?>"><?= $s->nama_skpd; ?></option>
                                                    <?php } ?>

                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12 p-t-10">
                                        <div class="form-group">
                                            <label class="col-sm-12">Periode </label>
                                            <div class="col-sm-12">
                                                <input type="date" id="tgl_periode" name="tgl_periode" onchange="getPeriode()" class="form-control" required>
                                            </div>
                                        </div>
                                    </div>


                                    <hr>

                                </div>

                            </div>
                            <!-- akhir tab informasi -->

                            <!-- awal tab isi -->
                            <div class="wizard-pane" role="tabpanel">
                                <div class="row">
                                    <div class="col-md-12">
                                        <table class="table table-bordered color-table muted-table">
                                            <thead class="success" style="text-align: center !important;">
                                                <tr style="text-align: center !important;">
                                                    <th>Uraian</th>
                                                    <th>Jumlah s.d.
                                                        <span id="periode"></span>
                                                    </th>
                                                    <th>Jumlah s.d. 31 Desember <span id="periode-tahun"></span></th>
                                                    <th>Kenaikan / Penurunan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr style="text-align: center; background: #f3f3f3">
                                                    <td>1</td>
                                                    <td>2</td>
                                                    <td>3 <button id="btnEditNilai" class="btn btn-xs btn-inverse pull-right" onclick="set_readonly(false);"><span class="fa fa-pencil"></span> Ubah data</button></td>
                                                    <td>4 = 2 - 3</td>
                                                </tr>
                                                <tr>
                                                    <td><b>Aset Lancar (a)</td>
                                                    <td>
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <div class="input-group-addon">Rp.</div>
                                                                <input type="number" name="asset_lancar_sekarang" onkeyup="perhitungan()" onchange="perhitungan()" required id="asset_lancar_sekarang" class="form-control " readonly>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <div class="input-group-addon">Rp.</div>
                                                                <input type="number" name="asset_lancar_awal" onkeyup="perhitungan()" onchange="perhitungan()" required id="asset_lancar_awal" class="form-control " readonly>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <div class="input-group-addon">Rp.</div>
                                                                <input type="number" name="asset_lancar_total" onkeyup="perhitungan()" onchange="perhitungan()" required id="asset_lancar_total" class="form-control " readonly>
                                                            </div>
                                                        </div>
                                                    </td>

                                                </tr>

                                                <tr>
                                                    <td>Kas dan Setara Kas</td>
                                                    <td>
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <div class="input-group-addon">Rp.</div>
                                                                <input type="number" name="kas_sekarang" onkeyup="perhitungan()" onchange="perhitungan()" required id="kas_sekarang" class="form-control ">
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <div class="input-group-addon">Rp.</div>
                                                                <input type="number" name="kas_awal" onkeyup="perhitungan()" onchange="perhitungan()" required id="kas_awal" class="form-control ">
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <div class="input-group-addon">Rp.</div>
                                                                <input type="number" name="kas_total" onkeyup="perhitungan()" onchange="perhitungan()" required id="kas_total" class="form-control " readonly>
                                                            </div>
                                                        </div>
                                                    </td>

                                                </tr>

                                                <tr>
                                                    <td>Persediaan</td>
                                                    <td>
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <div class="input-group-addon">Rp.</div>
                                                                <input type="number" name="persedian_sekarang" onkeyup="perhitungan()" onchange="perhitungan()" required id="persedian_sekarang" class="form-control ">
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <div class="input-group-addon">Rp.</div>
                                                                <input type="number" name="persedian_awal" onkeyup="perhitungan()" onchange="perhitungan()" required id="persedian_awal" class="form-control ">
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <div class="input-group-addon">Rp.</div>
                                                                <input type="number" name="persedian_total" onkeyup="perhitungan()" onchange="perhitungan()" required id="persedian_total" class="form-control " readonly>
                                                            </div>
                                                        </div>
                                                    </td>

                                                </tr>

                                                <tr id="dst1_row" class="hidden">
                                                    <td><input type="text" name="dst1_text" id="dst1_text" class="form-control"></td>
                                                    <td>
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <div class="input-group-addon">Rp.</div>
                                                                <input type="number" name="dst1_sekarang" onkeyup="perhitungan()" onchange="perhitungan()"  id="dst1_sekarang" class="form-control ">
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <div class="input-group-addon">Rp.</div>
                                                                <input type="number" name="dst1_awal" onkeyup="perhitungan()" onchange="perhitungan()"  id="dst1_awal" class="form-control ">
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <div class="input-group-addon">Rp.</div>
                                                                <input type="number" name="dst1_total" onkeyup="perhitungan()" onchange="perhitungan()"  id="dst1_total" class="form-control " readonly>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>

                                                <tr id="dst2_row" class="hidden">
                                                    <td><input type="text" name="dst2_text" id="dst2_text" class="form-control"></td>
                                                    <td>
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <div class="input-group-addon">Rp.</div>
                                                                <input type="number" name="dst2_sekarang" onkeyup="perhitungan()" onchange="perhitungan()"  id="dst2_sekarang" class="form-control ">
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <div class="input-group-addon">Rp.</div>
                                                                <input type="number" name="dst2_awal" onkeyup="perhitungan()" onchange="perhitungan()"  id="dst2_awal" class="form-control ">
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <div class="input-group-addon">Rp.</div>
                                                                <input type="number" name="dst2_total" onkeyup="perhitungan()" onchange="perhitungan()"  id="dst2_total" class="form-control " readonly>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>

                                                <tr id="dst3_row" class="hidden">
                                                    <td><input type="text" name="dst3_text" id="dst3_text" class="form-control"></td>
                                                    <td>
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <div class="input-group-addon">Rp.</div>
                                                                <input type="number" name="dst3_sekarang" onkeyup="perhitungan()" onchange="perhitungan()"  id="dst3_sekarang" class="form-control ">
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <div class="input-group-addon">Rp.</div>
                                                                <input type="number" name="dst3_awal" onkeyup="perhitungan()" onchange="perhitungan()"  id="dst3_awal" class="form-control ">
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <div class="input-group-addon">Rp.</div>
                                                                <input type="number" name="dst3_total" onkeyup="perhitungan()" onchange="perhitungan()"  id="dst3_total" class="form-control " readonly>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>

                                                <tr id="dst4_row" class="hidden">
                                                    <td><input type="text" name="dst4_text" id="dst4_text" class="form-control"></td>
                                                    <td>
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <div class="input-group-addon">Rp.</div>
                                                                <input type="number" name="dst4_sekarang" onkeyup="perhitungan()" onchange="perhitungan()"  id="dst4_sekarang" class="form-control ">
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <div class="input-group-addon">Rp.</div>
                                                                <input type="number" name="dst4_awal" onkeyup="perhitungan()" onchange="perhitungan()"  id="dst4_awal" class="form-control ">
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <div class="input-group-addon">Rp.</div>
                                                                <input type="number" name="dst4_total" onkeyup="perhitungan()" onchange="perhitungan()"  id="dst4_total" class="form-control " readonly>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>

                                                <tr id="dst5_row" class="hidden">
                                                    <td><input type="text" name="dst5_text" id="dst5_text" class="form-control"></td>
                                                    <td>
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <div class="input-group-addon">Rp.</div>
                                                                <input type="number" name="dst5_sekarang" onkeyup="perhitungan()" onchange="perhitungan()"  id="dst5_sekarang" class="form-control ">
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <div class="input-group-addon">Rp.</div>
                                                                <input type="number" name="dst5_awal" onkeyup="perhitungan()" onchange="perhitungan()"  id="dst5_awal" class="form-control ">
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <div class="input-group-addon">Rp.</div>
                                                                <input type="number" name="dst5_total" onkeyup="perhitungan()" onchange="perhitungan()"  id="dst5_total" class="form-control " readonly>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>

                                                <tr id="dst6_row" class="hidden">
                                                    <td><input type="text" name="dst6_text" id="dst6_text" class="form-control"></td>
                                                    <td>
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <div class="input-group-addon">Rp.</div>
                                                                <input type="number" name="dst6_sekarang" onkeyup="perhitungan()" onchange="perhitungan()"  id="dst6_sekarang" class="form-control ">
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <div class="input-group-addon">Rp.</div>
                                                                <input type="number" name="dst6_awal" onkeyup="perhitungan()" onchange="perhitungan()"  id="dst6_awal" class="form-control ">
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <div class="input-group-addon">Rp.</div>
                                                                <input type="number" name="dst6_total" onkeyup="perhitungan()" onchange="perhitungan()"  id="dst6_total" class="form-control " readonly>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>

                                                <tr id="dst7_row" class="hidden">
                                                    <td><input type="text" name="dst7_text" id="dst7_text" class="form-control"></td>
                                                    <td>
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <div class="input-group-addon">Rp.</div>
                                                                <input type="number" name="dst7_sekarang" onkeyup="perhitungan()" onchange="perhitungan()"  id="dst7_sekarang" class="form-control ">
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <div class="input-group-addon">Rp.</div>
                                                                <input type="number" name="dst7_awal" onkeyup="perhitungan()" onchange="perhitungan()"  id="dst7_awal" class="form-control ">
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <div class="input-group-addon">Rp.</div>
                                                                <input type="number" name="dst7_total" onkeyup="perhitungan()" onchange="perhitungan()"  id="dst7_total" class="form-control " readonly>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>

                                                <tr id="dst8_row" class="hidden">
                                                    <td><input type="text" name="dst8_text" id="dst8_text" class="form-control"></td>
                                                    <td>
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <div class="input-group-addon">Rp.</div>
                                                                <input type="number" name="dst8_sekarang" onkeyup="perhitungan()" onchange="perhitungan()"  id="dst8_sekarang" class="form-control ">
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <div class="input-group-addon">Rp.</div>
                                                                <input type="number" name="dst8_awal" onkeyup="perhitungan()" onchange="perhitungan()"  id="dst8_awal" class="form-control ">
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <div class="input-group-addon">Rp.</div>
                                                                <input type="number" name="dst8_total" onkeyup="perhitungan()" onchange="perhitungan()"  id="dst8_total" class="form-control " readonly>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>

                                                <tr id="tambah_row">
                                                    <td><button class="btn btn-default form-control" onclick="tambahbaris();"><i class="fa fa-plus"></i> Tambah Baris Lainnya</button></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>

                                                <tr>
                                                    <td><b>Investasi Jangka Panjang (b)</b></td>
                                                    <td>
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <div class="input-group-addon">Rp.</div>
                                                                <input type="number" id="investasi_jangkapanjang_sekarang" name="investasi_jangkapanjang_sekarang" onkeyup="perhitungan()" onchange="perhitungan()" required class="form-control ">
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <div class="input-group-addon">Rp.</div>
                                                                <input type="number" name="investasi_jangkapanjang_awal" onkeyup="perhitungan()" onchange="perhitungan()" required id="investasi_jangkapanjang_awal" class="form-control ">
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <div class="input-group-addon">Rp.</div>
                                                                <input type="number" name="investasi_jangkapanjang_total" onkeyup="perhitungan()" onchange="perhitungan()" required id="investasi_jangkapanjang_total" class="form-control " readonly>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td><b>Asset Tetap (c) </b></td>
                                                    <td>
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <div class="input-group-addon">Rp.</div>
                                                                <input type="number" name="asset_tetap_sekarang" onkeyup="perhitungan()" onchange="perhitungan()" required id="asset_tetap_sekarang" class="form-control " readonly>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <div class="input-group-addon">Rp.</div>
                                                                <input type="number" name="asset_tetap_awal" onkeyup="perhitungan()" onchange="perhitungan()" required id="asset_tetap_awal" class="form-control " readonly>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <div class="input-group-addon">Rp.</div>
                                                                <input type="number" name="asset_tetap_total" onkeyup="perhitungan()" onchange="perhitungan()" required id="asset_tetap_total" class="form-control " readonly>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>




                                                <tr>
                                                    <td>Tanah</td>
                                                    <td>
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <div class="input-group-addon">Rp.</div>
                                                                <input type="number" name="tanah_sekarang" onkeyup="perhitungan()" onchange="perhitungan()" required id="tanah_sekarang" class="form-control ">
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <div class="input-group-addon">Rp.</div>
                                                                <input type="number" name="tanah_awal" onkeyup="perhitungan()" onchange="perhitungan()" required id="tanah_awal" class="form-control ">
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <div class="input-group-addon">Rp.</div>
                                                                <input type="number" name="tanah_total" onkeyup="perhitungan()" onchange="perhitungan()" required id="tanah_total" class="form-control " readonly>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>Peralatan dan Mesin</td>
                                                    <td>
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <div class="input-group-addon">Rp.</div>
                                                                <input type="number" name="peralatan_sekarang" onkeyup="perhitungan()" onchange="perhitungan()" required id="peralatan_sekarang" class="form-control ">
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <div class="input-group-addon">Rp.</div>
                                                                <input type="number" name="peralatan_awal" onkeyup="perhitungan()" onchange="perhitungan()" required id="peralatan_awal" class="form-control ">
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <div class="input-group-addon">Rp.</div>
                                                                <input type="number" name="peralatan_total" onkeyup="perhitungan()" onchange="perhitungan()" required id="peralatan_total" class="form-control " readonly>
                                                            </div>
                                                        </div>
                                                    </td>

                                                </tr>

                                                <tr>
                                                    <td>Gedung dan Bangunan</td>
                                                    <td>
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <div class="input-group-addon">Rp.</div>
                                                                <input type="number" name="gedung_sekarang" onkeyup="perhitungan()" onchange="perhitungan()" required id="gedung_sekarang" class="form-control ">
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <div class="input-group-addon">Rp.</div>
                                                                <input type="number" name="gedung_awal" onkeyup="perhitungan()" onchange="perhitungan()" required id="gedung_awal" class="form-control ">
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <div class="input-group-addon">Rp.</div>
                                                                <input type="number" name="gedung_total" onkeyup="perhitungan()" onchange="perhitungan()" required id="gedung_total" class="form-control " readonly>
                                                            </div>
                                                        </div>
                                                    </td>

                                                </tr>

                                                <tr>
                                                    <td>Jalan, Jaringan dan Irigasi</td>
                                                    <td>
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <div class="input-group-addon">Rp.</div>
                                                                <input type="number" name="jalan_sekarang" onkeyup="perhitungan()" onchange="perhitungan()" required id="jalan_sekarang" class="form-control ">
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <div class="input-group-addon">Rp.</div>
                                                                <input type="number" name="jalan_awal" onkeyup="perhitungan()" onchange="perhitungan()" required id="jalan_awal" class="form-control ">
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <div class="input-group-addon">Rp.</div>
                                                                <input type="number" name="jalan_total" onkeyup="perhitungan()" onchange="perhitungan()" required id="jalan_total" class="form-control " readonly>
                                                            </div>
                                                        </div>
                                                    </td>

                                                </tr>

                                                <tr>
                                                    <td>Asset Tetap Lainnya</td>
                                                    <td>
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <div class="input-group-addon">Rp.</div>
                                                                <input type="number" name="asset_lainya_sekarang" onkeyup="perhitungan()" onchange="perhitungan()" required id="asset_lainya_sekarang" class="form-control ">
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <div class="input-group-addon">Rp.</div>
                                                                <input type="number" name="asset_lainya_awal" onkeyup="perhitungan()" onchange="perhitungan()" required id="asset_lainya_awal" class="form-control ">
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <div class="input-group-addon">Rp.</div>
                                                                <input type="number" name="asset_lainya_total" onkeyup="perhitungan()" onchange="perhitungan()" required id="asset_lainya_total" class="form-control " readonly>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>Konstruksi dalam Pengerjaan</td>
                                                    <td>
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <div class="input-group-addon">Rp.</div>
                                                                <input type="number" name="kontruksi_sekarang" onkeyup="perhitungan()" onchange="perhitungan()" required id="kontruksi_sekarang" class="form-control ">
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <div class="input-group-addon">Rp.</div>
                                                                <input type="number" name="kontruksi_awal" onkeyup="perhitungan()" onchange="perhitungan()" required id="kontruksi_awal" class="form-control ">
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <div class="input-group-addon">Rp.</div>
                                                                <input type="number" name="kontruksi_total" onkeyup="perhitungan()" onchange="perhitungan()" required id="kontruksi_total" class="form-control " readonly>
                                                            </div>
                                                        </div>
                                                    </td>

                                                </tr>

                                                <tr>
                                                    <td>Akumulasi Penyusutan</td>
                                                    <td>
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <div class="input-group-addon">Rp.</div>
                                                                <input type="number" name="akumulasi_sekarang" onkeyup="perhitungan()" onchange="perhitungan()" required id="akumulasi_sekarang" class="form-control ">
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <div class="input-group-addon">Rp.</div>
                                                                <input type="number" name="akumulasi_awal" onkeyup="perhitungan()" onchange="perhitungan()" required id="akumulasi_awal" class="form-control ">
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <div class="input-group-addon">Rp.</div>
                                                                <input type="number" name="akumulasi_total" onkeyup="perhitungan()" onchange="perhitungan()" required id="akumulasi_total" class="form-control " readonly>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td><b>Aset Lainnya (d)</b></td>
                                                    <td>
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <div class="input-group-addon">Rp.</div>
                                                                <input type="number" name="asset_lain_sekarang" onkeyup="perhitungan()" onchange="perhitungan()" required id="asset_lain_sekarang" class="form-control ">
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <div class="input-group-addon">Rp.</div>
                                                                <input type="number" name="asset_lain_awal" onkeyup="perhitungan()" onchange="perhitungan()" required id="asset_lain_awal" class="form-control ">
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <div class="input-group-addon">Rp.</div>
                                                                <input type="number" name="asset_lain_total" onkeyup="perhitungan()" onchange="perhitungan()" required id="asset_lain_total" class="form-control " readonly>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td><b>Total Asset (e) = (a+b+c+d)</b> </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <div class="input-group-addon">Rp.</div>
                                                                <input type="number" name="total_asset_sekarang" onkeyup="perhitungan()" onchange="perhitungan()" required id="total_asset_sekarang" class="form-control " readonly>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <div class="input-group-addon">Rp.</div>
                                                                <input type="number" name="total_asset_awal" onkeyup="perhitungan()" onchange="perhitungan()" required id="total_asset_awal" class="form-control " readonly>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <div class="input-group-addon">Rp.</div>
                                                                <input type="number" name="total_asset" onkeyup="perhitungan()" onchange="perhitungan()" required id="total_asset" class="form-control " readonly>
                                                            </div>
                                                        </div>
                                                    </td>

                                                </tr>

                                                <tr>
                                                    <td><b>Kewajiban (f)</b></td>
                                                    <td>
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <div class="input-group-addon">Rp.</div>
                                                                <input type="number" name="total_kewajiban_sekarang" onkeyup="perhitungan()" onchange="perhitungan()" required id="total_kewajiban_sekarang" class="form-control " readonly>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <div class="input-group-addon">Rp.</div>
                                                                <input type="number" name="total_kewajiban_awal" onkeyup="perhitungan()" onchange="perhitungan()" required id="total_kewajiban_awal" class="form-control " readonly>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <div class="input-group-addon">Rp.</div>
                                                                <input type="number" name="total_kewajiban" onkeyup="perhitungan()" onchange="perhitungan()" required id="total_kewajiban" class="form-control " readonly>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>Kewajiban Jangka Pendek</td>
                                                    <td>
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <div class="input-group-addon">Rp.</div>
                                                                <input type="number" name="kewajiban_pendek_sekarang" onkeyup="perhitungan()" onchange="perhitungan()" required id="kewajiban_pendek_sekarang" class="form-control ">
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <div class="input-group-addon">Rp.</div>
                                                                <input type="number" name="kewajiban_pendek_awal" onkeyup="perhitungan()" onchange="perhitungan()" required id="kewajiban_pendek_awal" class="form-control ">
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <div class="input-group-addon">Rp.</div>
                                                                <input type="number" name="kewajiban_pendek_total" onkeyup="perhitungan()" onchange="perhitungan()" required id="kewajiban_pendek_total" class="form-control " readonly>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>


                                                <tr>
                                                    <td>Kewajiban Jangka Panjang</td>
                                                    <td>
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <div class="input-group-addon">Rp.</div>
                                                                <input type="number" name="kewajiban_panjang_sekarang" onkeyup="perhitungan()" onchange="perhitungan()" required id="kewajiban_panjang_sekarang" class="form-control ">
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <div class="input-group-addon">Rp.</div>
                                                                <input type="number" name="kewajiban_panjang_awal" onkeyup="perhitungan()" onchange="perhitungan()" required id="kewajiban_panjang_awal" class="form-control ">
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <div class="input-group-addon">Rp.</div>
                                                                <input type="number" name="kewajiban_panjang_total" onkeyup="perhitungan()" onchange="perhitungan()" required id="kewajiban_panjang_total" class="form-control " readonly>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>


                                                <tr>
                                                    <td><b>Ekuitas (g) = (e - f)</b></td>
                                                    <td>
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <div class="input-group-addon">Rp.</div>
                                                                <input type="number" name="ekuitas_sekarang" onkeyup="perhitungan()" onchange="perhitungan()" required id="ekuitas_sekarang" class="form-control " readonly>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <div class="input-group-addon">Rp.</div>
                                                                <input type="number" name="ekuitas_awal" onkeyup="perhitungan()" onchange="perhitungan()" required id="ekuitas_awal" class="form-control " readonly>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <div class="input-group-addon">Rp.</div>
                                                                <input type="number" name="ekuitas_total" id="ekuitas_total" onkeyup="perhitungan()" onchange="perhitungan()" required class="form-control " readonly>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td><b>Total Kewajiban dan Ekuitas (h) = (f + g)</b></td>
                                                    <td>
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <div class="input-group-addon">Rp.</div>
                                                                <input type="number" name="total_neraca_sekarang" onkeyup="perhitungan()" onchange="perhitungan()" required id="total_neraca_sekarang" class="form-control " readonly>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <div class="input-group-addon">Rp.</div>
                                                                <input type="number" name="total_neraca_awal" onkeyup="perhitungan()" onchange="perhitungan()" required id="total_neraca_awal" class="form-control " readonly>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <div class="input-group-addon">Rp.</div>
                                                                <input type="number" name="total_neraca" onkeyup="perhitungan()" onchange="perhitungan()" required id="total_neraca" class="form-control " readonly>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>













                                            </tbody>

                                        </table>

                                    </div>
                                </div>
                            </div>
                            <!-- akhir tab isi -->


                            <!-- awal tab penandatangan -->
                            <div class="wizard-pane" role="tabpanel">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="col-sm-12">Tanggal Pengesahan</label>
                                            <div class="col-sm-12">
                                                <input type="date" name="tgl_pengesahan" class="form-control" required>
                                            </div>
                                        </div>
                                    </div>

                                    <hr>
                                    <div class="col-md-6 b-r" style="padding-top:40px;">
                                        <div class="row">
                                            <h3 class="box-title text-success text-center">Pihak dari BKAD</h3>

                                            <div class="col-md-12 p-t-10">
                                                <div class="form-group">
                                                    <label class="col-sm-12">Kepala Bidang Akutansi BKAD</label>
                                                    <div class="col-sm-12">
                                                        <select class="form-control select2" name="id_pegawai_1_bpkad" readonly required>
                                                            <?php
                                                            foreach ($pegawai_bpkad as $p) {; ?>
                                                                <option value="<?= $p->id_pegawai; ?>" <?= (@$sarerea_penandatangan->id_pegawai_1_bpkad == $p->id_pegawai) ? "selected" : "" ?>><?= $p->nama_lengkap; ?></option>
                                                            <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-12  p-t-10">
                                                <div class="form-group">
                                                    <label class="col-sm-12">Kasubid Pelaporan Bidang Akuntasi BKAD</label>
                                                    <div class="col-sm-12">
                                                        <select class="form-control select2" name="id_pegawai_2_bpkad" readonly required>
                                                            <?php
                                                            foreach ($pegawai_bpkad as $p) {; ?>
                                                                <option value="<?= $p->id_pegawai; ?>" <?= (@$sarerea_penandatangan->id_pegawai_2_bpkad == $p->id_pegawai) ? "selected" : "" ?>><?= $p->nama_lengkap; ?></option>
                                                            <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-12  p-t-10">
                                                <div class="form-group">
                                                    <label class="col-sm-12">Kasubid Penatausahaan Aset Bidang Aset BKAD</label>
                                                    <div class="col-sm-12">
                                                        <select class="form-control select2" name="id_pegawai_3_bpkad" readonly required>
                                                            <?php
                                                            foreach ($pegawai_bpkad as $p) {; ?>
                                                                <option value="<?= $p->id_pegawai; ?>" <?= (@$sarerea_penandatangan->id_pegawai_3_bpkad == $p->id_pegawai) ? "selected" : "" ?>><?= $p->nama_lengkap; ?>><?= $p->nama_lengkap; ?></option>
                                                            <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- <div class="col-md-12  p-t-10">
                                    <div class="form-group">
                                        <label class="col-sm-12">Pemproses Bidang Akutansi BPKAD</label>
                                        <div class="col-sm-12">
                                        <select class="form-control select2" name="id_pegawai_4_bpkad">
                                        <?php
                                        foreach ($pegawai_bpkad as $p) {; ?>
                                                     <option value="<?= $p->id_pegawai; ?>"><?= $p->nama_lengkap; ?></option>
                                                   <?php
                                                }
                                                    ?>
                                            </select>
                                        </div>
                                    </div>
                                </div> -->
                                        </div>
                                    </div>




                                    <div class="col-md-6 b-r" style="padding-top:40px;">
                                        <div class="row">
                                            <h3 class="box-title text-success text-center">Pihak dari <span style="display: inline;" id="namaSkpd"></span></h3>

                                            <div class="col-md-12 p-t-10">
                                                <div class="form-group">
                                                    <label class="col-sm-12">Kepala </label>
                                                    <div class="col-sm-12">
                                                        <select id="pegawaiSkpdKepala" name="id_pegawai_1_skpd" class="form-control select2" required>
                                                            <option value="">-- Pilih Pegawai --</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-12  p-t-10">
                                                <div class="form-group">
                                                    <label class="col-sm-12">Pejabat Penatausahaan Keuangan</label>
                                                    <div class="col-sm-12">
                                                        <select id="pegawaiSkpdPejabatPenataKean" name="id_pegawai_2_skpd" class="form-control select2" required>
                                                            <option value="">-- Pilih Pegawai --</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-12  p-t-10">
                                                <div class="form-group">
                                                    <label class="col-sm-12">Pengelola Pemanfaatan BMD</label>
                                                    <div class="col-sm-12">
                                                        <select id="pegawaiSkpdPengelolaPemanfaatanBMD" name="id_pegawai_3_skpd" class="form-control select2" required>
                                                            <option value="">-- Pilih Pegawai --</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- <div class="col-md-12  p-t-10">
                                    <div class="form-group">
                                        <label class="col-sm-12">Petugas Akutansi</label>
                                        <div class="col-sm-12">
                                        <select id="pegawaiSkpdPetugasAkutansi" name="id_pegawai_4_skpd" class="form-control select2">
                                            <option value="">-- Pilih Pegawai --</option>
                                            </select>
                                        </div>
                                    </div>
                                </div> -->
                                        </div>
                                    </div>



                                    <hr>

                                    <div class="col-md-12" style="padding-top:40px;">
                                        <div class="form-group">
                                            <label class="col-sm-12">Lampiran <code>File PDF Neraca print out dari Aplikasi SIPASTI</code></label>
                                            <div class="col-sm-12">
                                                <input type="file" accept="application/pdf" name="file_draft" class="dropify" required="">
                                            </div>
                                            <small class="col-sm-12 text-muted">File dengan format <code>.pdf</code> dengan ukuran tidak lebih dari <code>10 MB</code>.</small>
                                        </div>
                                    </div>
                                    <hr>
                                </div>
                            </div>

                        </div>
                        <!-- akhir tab penandatangan -->

        </form>
    </div>
</div>
</div>
</div>
</div>


</div>



<script src="<?= base_url(); ?>/asset/pixel/plugins/bower_components/jquery-wizard-master/dist/jquery-wizard.min.js"></script>
<!-- FormValidation -->


<link rel="stylesheet" href="<?= base_url(); ?>/asset/pixel/plugins/bower_components/jquery-wizard-master/libs/formvalidation/formValidation.min.css">
<!-- FormValidation plugin and the class supports validating Bootstrap form -->
<script src="<?= base_url(); ?>/asset/pixel/plugins/bower_components/jquery-wizard-master/libs/formvalidation/formValidation.min.js"></script>
<script src="<?= base_url(); ?>/asset/pixel/plugins/bower_components/jquery-wizard-master/libs/formvalidation/bootstrap.min.js"></script>
<!-- Custom Theme JavaScript -->
<script src="js/custom.min.js"></script>
<script type="text/javascript">
    (function() {
        $('#exampleBasic').wizard({
            onFinish: function(event, currentIndex) {
                let cek = checkform();
                if(cek) {
                    $("#form").submit();
                    swal('Sedang diproses..');
                }
            }
        });
    })();

    function checkform() {
        form = document.getElementById('form');
        // get all the inputs within the submitted form
        var inputs = form.getElementsByTagName('input');
        var err = 0;
        $('.alert').remove();
        for (var i = 0; i < inputs.length; i++) {
            // only validate the inputs that have the required attribute
            if(inputs[i].hasAttribute("required")){
                if(inputs[i].value == ""){
                    // found an empty field that is required
                    inputs[i].insertAdjacentHTML("afterend", "<div class='alert alert-danger form-control'>*Harus diisi.</div>");
                    err++;
                }
            }
        }
        if(err == 0) {
            return true;
        } else {
            swal("Ada form yang belum diisi.");
            return false;
        }
    }
</script>

<script>
    var hari = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
    var bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
    var baris = 0;

    function tambahbaris() {
        baris++;
        if (baris <= 8) {
            $('#dst' + baris + '_row').removeClass("hidden");
        }
        if (baris == 8) {
            $('#tambah_row').addClass("hidden");
        }
    }

    async function getPegawaiSKPD(id) {
        try {
            let response = await fetch("<?= base_url('pegawai/getPegawaiBySKPD/neraca') ?>", {
                method: "POST",
                body: JSON.stringify({
                    id: id
                }),
                headers: {
                    "Content-Type": "application/json",
                    "X-Requested-With": "XMLHttpRequest"
                }
            });
            var datasend = await response.json();
            if (datasend !== undefined) {
                var nama_skpd = document.getElementById('namaSkpd');
                var obj1 = document.getElementById('pegawaiSkpdKepala');
                var obj2 = document.getElementById('pegawaiSkpdPejabatPenataKean');
                var obj3 = document.getElementById('pegawaiSkpdPengelolaPemanfaatanBMD');
                // var obj4 = document.getElementById('pegawaiSkpdPetugasAkutansi');
                var pegawai = datasend.data;
                obj1.innerHTML = "";
                obj2.innerHTML = "";
                obj3.innerHTML = "";
                // obj4.innerHTML = "";
                pegawai.forEach(peg => {
                    var opt = '<option value="' + peg.id_pegawai + '">' + peg.nama_lengkap + '</option>';
                    obj1.innerHTML = obj1.innerHTML + opt;
                    obj2.innerHTML = obj2.innerHTML + opt;
                    obj3.innerHTML = obj3.innerHTML + opt;
                    // obj4.innerHTML = obj4.innerHTML + opt;
                });
                nama_skpd.innerHTML = datasend.skpd.nama_skpd;
                if (datasend.laporan.id_laporan_neraca > 0) {
                    document.getElementById('asset_lancar_awal').value = datasend.laporan.asset_lancar_awal;
                    document.getElementById('kas_awal').value = datasend.laporan.kas_awal;
                    document.getElementById('persedian_awal').value = datasend.laporan.persedian_awal;
                    document.getElementById('dst1_text').value = datasend.laporan.dst1_text;
                    document.getElementById('dst2_text').value = datasend.laporan.dst2_text;
                    document.getElementById('dst3_text').value = datasend.laporan.dst3_text;
                    document.getElementById('dst4_text').value = datasend.laporan.dst4_text;
                    document.getElementById('dst5_text').value = datasend.laporan.dst5_text;
                    document.getElementById('dst6_text').value = datasend.laporan.dst6_text;
                    document.getElementById('dst7_text').value = datasend.laporan.dst7_text;
                    document.getElementById('dst8_text').value = datasend.laporan.dst8_text;
                    document.getElementById('dst1_awal').value = datasend.laporan.dst1_awal;
                    document.getElementById('dst2_awal').value = datasend.laporan.dst2_awal;
                    document.getElementById('dst3_awal').value = datasend.laporan.dst3_awal;
                    document.getElementById('dst4_awal').value = datasend.laporan.dst4_awal;
                    document.getElementById('dst5_awal').value = datasend.laporan.dst5_awal;
                    document.getElementById('dst6_awal').value = datasend.laporan.dst6_awal;
                    document.getElementById('dst7_awal').value = datasend.laporan.dst7_awal;
                    document.getElementById('dst8_awal').value = datasend.laporan.dst8_awal;
                    document.getElementById('investasi_jangkapanjang_awal').value = datasend.laporan.investasi_jangkapanjang_awal;
                    document.getElementById('asset_tetap_awal').value = datasend.laporan.asset_tetap_awal;
                    document.getElementById('tanah_awal').value = datasend.laporan.tanah_awal;
                    document.getElementById('peralatan_awal').value = datasend.laporan.peralatan_awal;
                    document.getElementById('gedung_awal').value = datasend.laporan.gedung_awal;
                    document.getElementById('jalan_awal').value = datasend.laporan.jalan_awal;
                    document.getElementById('asset_lainya_awal').value = datasend.laporan.asset_lainya_awal;
                    document.getElementById('kontruksi_awal').value = datasend.laporan.kontruksi_awal;
                    document.getElementById('akumulasi_awal').value = datasend.laporan.akumulasi_awal;
                    document.getElementById('asset_lain_awal').value = datasend.laporan.asset_lain_awal;
                    document.getElementById('total_kewajiban_awal').value = datasend.laporan.total_kewajiban_awal;
                    document.getElementById('kewajiban_pendek_awal').value = datasend.laporan.kewajiban_pendek_awal;
                    document.getElementById('kewajiban_panjang_awal').value = datasend.laporan.kewajiban_panjang_awal;

                    if (datasend.laporan.dst1_text !== "") {
                        tambahbaris();
                    }
                    if (datasend.laporan.dst2_text !== "") {
                        tambahbaris();
                    }
                    if (datasend.laporan.dst3_text !== "") {
                        tambahbaris();
                    }
                    if (datasend.laporan.dst4_text !== "") {
                        tambahbaris();
                    }
                    if (datasend.laporan.dst5_text !== "") {
                        tambahbaris();
                    }
                    if (datasend.laporan.dst6_text !== "") {
                        tambahbaris();
                    }
                    if (datasend.laporan.dst7_text !== "") {
                        tambahbaris();
                    }
                    if (datasend.laporan.dst8_text !== "") {
                        tambahbaris();
                    }

                    set_readonly(true);
                } else {
                    document.getElementById('asset_lancar_awal').value = "";
                    document.getElementById('kas_awal').value = "";
                    document.getElementById('persedian_awal').value = "";
                    document.getElementById('dst1_text').value = "";
                    document.getElementById('dst2_text').value = "";
                    document.getElementById('dst3_text').value = "";
                    document.getElementById('dst4_text').value = "";
                    document.getElementById('dst5_text').value = "";
                    document.getElementById('dst6_text').value = "";
                    document.getElementById('dst7_text').value = "";
                    document.getElementById('dst8_text').value = "";
                    document.getElementById('dst1_awal').value = "";
                    document.getElementById('dst2_awal').value = "";
                    document.getElementById('dst3_awal').value = "";
                    document.getElementById('dst4_awal').value = "";
                    document.getElementById('dst5_awal').value = "";
                    document.getElementById('dst6_awal').value = "";
                    document.getElementById('dst7_awal').value = "";
                    document.getElementById('dst8_awal').value = "";
                    document.getElementById('investasi_jangkapanjang_awal').value = "";
                    document.getElementById('asset_tetap_awal').value = "";
                    document.getElementById('tanah_awal').value = "";
                    document.getElementById('peralatan_awal').value = "";
                    document.getElementById('gedung_awal').value = "";
                    document.getElementById('jalan_awal').value = "";
                    document.getElementById('asset_lainya_awal').value = "";
                    document.getElementById('kontruksi_awal').value = "";
                    document.getElementById('akumulasi_awal').value = "";
                    document.getElementById('asset_lain_awal').value = "";
                    document.getElementById('total_kewajiban_awal').value = "";
                    document.getElementById('kewajiban_pendek_awal').value = "";
                    document.getElementById('kewajiban_panjang_awal').value = "";

                    set_readonly(false);
                }
                perhitungan();
            }
        } catch (err) {
            console.log(err);
        }
    }

    function set_readonly(val = true) {
        if (val == true) {
            // document.getElementById('asset_lancar_awal').setAttribute("readonly",true);
            document.getElementById('kas_awal').setAttribute("readonly", true);
            document.getElementById('persedian_awal').setAttribute("readonly", true);
            document.getElementById('dst1_text').setAttribute("readonly", true);
            document.getElementById('dst2_text').setAttribute("readonly", true);
            document.getElementById('dst3_text').setAttribute("readonly", true);
            document.getElementById('dst4_text').setAttribute("readonly", true);
            document.getElementById('dst5_text').setAttribute("readonly", true);
            document.getElementById('dst6_text').setAttribute("readonly", true);
            document.getElementById('dst7_text').setAttribute("readonly", true);
            document.getElementById('dst8_text').setAttribute("readonly", true);
            document.getElementById('dst1_awal').setAttribute("readonly", true);
            document.getElementById('dst2_awal').setAttribute("readonly", true);
            document.getElementById('dst3_awal').setAttribute("readonly", true);
            document.getElementById('dst4_awal').setAttribute("readonly", true);
            document.getElementById('dst5_awal').setAttribute("readonly", true);
            document.getElementById('dst6_awal').setAttribute("readonly", true);
            document.getElementById('dst7_awal').setAttribute("readonly", true);
            document.getElementById('dst8_awal').setAttribute("readonly", true);
            document.getElementById('investasi_jangkapanjang_awal').setAttribute("readonly", true);
            // document.getElementById('asset_tetap_awal').setAttribute("readonly",true);
            document.getElementById('tanah_awal').setAttribute("readonly", true);
            document.getElementById('peralatan_awal').setAttribute("readonly", true);
            document.getElementById('gedung_awal').setAttribute("readonly", true);
            document.getElementById('jalan_awal').setAttribute("readonly", true);
            document.getElementById('asset_lainya_awal').setAttribute("readonly", true);
            document.getElementById('kontruksi_awal').setAttribute("readonly", true);
            document.getElementById('akumulasi_awal').setAttribute("readonly", true);
            document.getElementById('asset_lain_awal').setAttribute("readonly", true);
            // document.getElementById('total_kewajiban_awal').setAttribute("readonly",true);
            document.getElementById('kewajiban_pendek_awal').setAttribute("readonly", true);
            document.getElementById('kewajiban_panjang_awal').setAttribute("readonly", true);
            document.getElementById('btnEditNilai').classList.remove("hidden");
        } else {
            // document.getElementById('asset_lancar_awal').removeAttribute("readonly",false);
            document.getElementById('kas_awal').removeAttribute("readonly", false);
            document.getElementById('persedian_awal').removeAttribute("readonly", false);
            document.getElementById('dst1_text').removeAttribute("readonly", false);
            document.getElementById('dst2_text').removeAttribute("readonly", false);
            document.getElementById('dst3_text').removeAttribute("readonly", false);
            document.getElementById('dst4_text').removeAttribute("readonly", false);
            document.getElementById('dst5_text').removeAttribute("readonly", false);
            document.getElementById('dst6_text').removeAttribute("readonly", false);
            document.getElementById('dst7_text').removeAttribute("readonly", false);
            document.getElementById('dst8_text').removeAttribute("readonly", false);
            document.getElementById('dst1_awal').removeAttribute("readonly", false);
            document.getElementById('dst2_awal').removeAttribute("readonly", false);
            document.getElementById('dst3_awal').removeAttribute("readonly", false);
            document.getElementById('dst4_awal').removeAttribute("readonly", false);
            document.getElementById('dst5_awal').removeAttribute("readonly", false);
            document.getElementById('dst6_awal').removeAttribute("readonly", false);
            document.getElementById('dst7_awal').removeAttribute("readonly", false);
            document.getElementById('dst8_awal').removeAttribute("readonly", false);
            document.getElementById('investasi_jangkapanjang_awal').removeAttribute("readonly", false);
            // document.getElementById('asset_tetap_awal').removeAttribute("readonly",false);
            document.getElementById('tanah_awal').removeAttribute("readonly", false);
            document.getElementById('peralatan_awal').removeAttribute("readonly", false);
            document.getElementById('gedung_awal').removeAttribute("readonly", false);
            document.getElementById('jalan_awal').removeAttribute("readonly", false);
            document.getElementById('asset_lainya_awal').removeAttribute("readonly", false);
            document.getElementById('kontruksi_awal').removeAttribute("readonly", false);
            document.getElementById('akumulasi_awal').removeAttribute("readonly", false);
            document.getElementById('asset_lain_awal').removeAttribute("readonly", false);
            // document.getElementById('total_kewajiban_awal').removeAttribute("readonly",false);
            document.getElementById('kewajiban_pendek_awal').removeAttribute("readonly", false);
            document.getElementById('kewajiban_panjang_awal').removeAttribute("readonly", false);
            document.getElementById('btnEditNilai').classList.add("hidden");
        }
    }

    function getPeriode() {
        var periode = document.getElementById('tgl_periode').value;
        var tgl = new Date(periode);
        var tanggal = tgl.getDate();
        var xhari = tgl.getDay();
        var xbulan = tgl.getMonth();
        var xtahun = tgl.getYear();
        var tahun = (xtahun < 1000) ? xtahun + 1900 : xtahun;
        var tgl_periode = tanggal + " " + bulan[xbulan] + " " + tahun;
        document.getElementById("periode").innerHTML = tgl_periode;
        document.getElementById("periode-tahun").innerHTML = tahun - 1;
        console.log(tgl_periode);

    }

    function perhitungan() {

        //a

        let dst_sekarang_val = 0;
        let dst_awal_val = 0;

        if (dst1_sekarang.value !== "" && dst1_text.value !== "") {
            dst_sekarang_val += parseFloat(dst1_sekarang.value);
        }
        if (dst2_sekarang.value !== "" && dst2_text.value !== "") {
            dst_sekarang_val += parseFloat(dst2_sekarang.value);
        }
        if (dst3_sekarang.value !== "" && dst3_text.value !== "") {
            dst_sekarang_val += parseFloat(dst3_sekarang.value);
        }
        if (dst4_sekarang.value !== "" && dst4_text.value !== "") {
            dst_sekarang_val += parseFloat(dst4_sekarang.value);
        }
        if (dst5_sekarang.value !== "" && dst5_text.value !== "") {
            dst_sekarang_val += parseFloat(dst5_sekarang.value);
        }
        if (dst6_sekarang.value !== "" && dst6_text.value !== "") {
            dst_sekarang_val += parseFloat(dst6_sekarang.value);
        }
        if (dst7_sekarang.value !== "" && dst7_text.value !== "") {
            dst_sekarang_val += parseFloat(dst7_sekarang.value);
        }
        if (dst8_sekarang.value !== "" && dst8_text.value !== "") {
            dst_sekarang_val += parseFloat(dst8_sekarang.value);
        }

        if (dst1_awal.value !== "" && dst1_text.value !== "") {
            dst_awal_val += parseFloat(dst1_awal.value);
        }
        if (dst2_awal.value !== "" && dst2_text.value !== "") {
            dst_awal_val += parseFloat(dst2_awal.value);
        }
        if (dst3_awal.value !== "" && dst3_text.value !== "") {
            dst_awal_val += parseFloat(dst3_awal.value);
        }
        if (dst4_awal.value !== "" && dst4_text.value !== "") {
            dst_awal_val += parseFloat(dst4_awal.value);
        }
        if (dst5_awal.value !== "" && dst5_text.value !== "") {
            dst_awal_val += parseFloat(dst5_awal.value);
        }
        if (dst6_awal.value !== "" && dst6_text.value !== "") {
            dst_awal_val += parseFloat(dst6_awal.value);
        }
        if (dst7_awal.value !== "" && dst7_text.value !== "") {
            dst_awal_val += parseFloat(dst7_awal.value);
        }
        if (dst8_awal.value !== "" && dst8_text.value !== "") {
            dst_awal_val += parseFloat(dst8_awal.value);
        }

        var operasi011 = parseFloat(kas_sekarang.value) + parseFloat(persedian_sekarang.value) + dst_sekarang_val;
        asset_lancar_sekarang.value = operasi011;

        var operasi012 = parseFloat(kas_awal.value) + parseFloat(persedian_awal.value) + dst_awal_val;
        asset_lancar_awal.value = operasi012;

        var operasi1 = parseFloat(asset_lancar_sekarang.value) - parseFloat(asset_lancar_awal.value);
        asset_lancar_total.value = operasi1;

        var operasi2 = parseFloat(kas_sekarang.value) - parseFloat(kas_awal.value);
        kas_total.value = operasi2;

        var operasi3 = parseFloat(persedian_sekarang.value) - parseFloat(persedian_awal.value);
        persedian_total.value = operasi3;

        var operasi41 = parseFloat(dst1_sekarang.value) - parseFloat(dst1_awal.value);
        dst1_total.value = operasi41;

        var operasi42 = parseFloat(dst2_sekarang.value) - parseFloat(dst2_awal.value);
        dst2_total.value = operasi42;

        var operasi43 = parseFloat(dst3_sekarang.value) - parseFloat(dst3_awal.value);
        dst3_total.value = operasi43;

        var operasi44 = parseFloat(dst4_sekarang.value) - parseFloat(dst4_awal.value);
        dst4_total.value = operasi44;

        var operasi45 = parseFloat(dst5_sekarang.value) - parseFloat(dst5_awal.value);
        dst5_total.value = operasi45;

        var operasi46 = parseFloat(dst6_sekarang.value) - parseFloat(dst6_awal.value);
        dst6_total.value = operasi46;

        var operasi47 = parseFloat(dst7_sekarang.value) - parseFloat(dst7_awal.value);
        dst7_total.value = operasi47;

        var operasi48 = parseFloat(dst8_sekarang.value) - parseFloat(dst8_awal.value);
        dst8_total.value = operasi48;

        //b
        var operasi5 = parseFloat(investasi_jangkapanjang_sekarang.value) - parseFloat(investasi_jangkapanjang_awal.value);
        investasi_jangkapanjang_total.value = operasi5;

        //c

        var operasi031 = parseFloat(tanah_sekarang.value) + parseFloat(peralatan_sekarang.value) + parseFloat(gedung_sekarang.value) + parseFloat(jalan_sekarang.value) + parseFloat(asset_lainya_sekarang.value) + parseFloat(kontruksi_sekarang.value) + parseFloat(akumulasi_sekarang.value);
        asset_tetap_sekarang.value = operasi031;

        var operasi032 = parseFloat(tanah_awal.value) + parseFloat(peralatan_awal.value) + parseFloat(gedung_awal.value) + parseFloat(jalan_awal.value) + parseFloat(asset_lainya_awal.value) + parseFloat(kontruksi_awal.value) + parseFloat(akumulasi_awal.value);
        asset_tetap_awal.value = operasi032;

        var operasi6 = parseFloat(asset_tetap_sekarang.value) - parseFloat(asset_tetap_awal.value);
        asset_tetap_total.value = operasi6;

        var operasi7 = parseFloat(tanah_sekarang.value) - parseFloat(tanah_awal.value);
        tanah_total.value = operasi7;

        var operasi8 = parseFloat(peralatan_sekarang.value) - parseFloat(peralatan_awal.value);
        peralatan_total.value = operasi8;

        var operasi9 = parseFloat(gedung_sekarang.value) - parseFloat(gedung_awal.value);
        gedung_total.value = operasi9;


        var operasi10 = parseFloat(jalan_sekarang.value) - parseFloat(jalan_awal.value);
        jalan_total.value = operasi10;

        var operasi11 = parseFloat(asset_lainya_sekarang.value) - parseFloat(asset_lainya_awal.value);
        asset_lainya_total.value = operasi11;

        var operasi12 = parseFloat(kontruksi_sekarang.value) - parseFloat(kontruksi_awal.value);
        kontruksi_total.value = operasi12;

        var operasi13 = parseFloat(akumulasi_sekarang.value) - parseFloat(akumulasi_awal.value);
        akumulasi_total.value = operasi13;


        //d
        var operasi14 = parseFloat(asset_lain_sekarang.value) - parseFloat(asset_lain_awal.value);
        asset_lain_total.value = operasi14;

        //e = a+b+c+d (sekarang)
        var operasi15 = parseFloat(asset_lancar_sekarang.value) + parseFloat(investasi_jangkapanjang_sekarang.value) + parseFloat(asset_tetap_sekarang.value) + parseFloat(asset_lain_sekarang.value);
        total_asset_sekarang.value = operasi15;

        //e = a+b+c+d (awal)
        var operasi16 = parseFloat(asset_lancar_awal.value) + parseFloat(investasi_jangkapanjang_awal.value) + parseFloat(asset_tetap_awal.value) + parseFloat(asset_lain_awal.value);
        total_asset_awal.value = operasi16;

        //e = e sekarang + e awal

        var operasi17 = parseFloat(total_asset_sekarang.value) - parseFloat(total_asset_awal.value);
        total_asset.value = operasi17;

        //f

        var operasi061 = parseFloat(kewajiban_pendek_sekarang.value) + parseFloat(kewajiban_panjang_sekarang.value);
        total_kewajiban_sekarang.value = operasi061;

        var operasi061 = parseFloat(kewajiban_pendek_awal.value) + parseFloat(kewajiban_panjang_awal.value);
        total_kewajiban_awal.value = operasi061;

        var operasi18 = parseFloat(total_kewajiban_sekarang.value) - parseFloat(total_kewajiban_awal.value);
        total_kewajiban.value = operasi18;

        var operasi19 = parseFloat(kewajiban_pendek_sekarang.value) - parseFloat(kewajiban_pendek_awal.value);
        kewajiban_pendek_total.value = operasi19;

        var operasi20 = parseFloat(kewajiban_panjang_sekarang.value) - parseFloat(kewajiban_panjang_awal.value);
        kewajiban_panjang_total.value = operasi20;

        //g = e - f (sekarang)
        var operasi21 = parseFloat(total_asset_sekarang.value) - parseFloat(total_kewajiban_sekarang.value);
        ekuitas_sekarang.value = operasi21;

        //g = e - f (awal)
        var operasi22 = parseFloat(total_asset_awal.value) - parseFloat(total_kewajiban_awal.value);
        ekuitas_awal.value = operasi22;

        //g = g sekarang + g awal
        var operasi23 = parseFloat(ekuitas_sekarang.value) - parseFloat(ekuitas_awal.value);
        ekuitas_total.value = operasi23;

        //h = (f+g) sekarang
        var operasi24 = parseFloat(total_kewajiban_sekarang.value) + parseFloat(ekuitas_sekarang.value);
        total_neraca_sekarang.value = operasi24;

        //h = (f+g) awal
        var operasi25 = parseFloat(total_kewajiban_awal.value) + parseFloat(ekuitas_awal.value);
        total_neraca_awal.value = operasi25;

        //h = (f+g) total
        var operasi26 = parseFloat(total_neraca_sekarang.value) - parseFloat(total_neraca_awal.value);
        total_neraca.value = operasi26;



    }
</script>


<script src="<?= base_url(); ?>/asset/pixel/plugins/bower_components/mask/jquery.mask.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {

        $('#edit-id_skpd').val('<?= $this->session->userdata("id_skpd") ?>').trigger("change");
        <?php if ($this->session->userdata("id_skpd") != 25 and $this->session->userdata("level") != "Administrator") : ?>
            $('#hidden-id_skpd').val('<?= $this->session->userdata("id_skpd") ?>');
            $('#edit-id_skpd').attr("disabled", true);
        <?php endif; ?>
        $('.dropify').dropify();
        // Format mata .
        $('.').mask('000.000.000', {
            reverse: true
        });

    })
</script>