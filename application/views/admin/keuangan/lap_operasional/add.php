<div class="container-fluid">

    <div class="row bg-title">
        <div class="col-lg-6 col-md-6 col-sm-4 col-xs-12">
            <h4 class="page-title">Rekonsiliasi Laporan Operasional</h4>
        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <ol class="breadcrumb">
                <li>Lap. Operasional</li>
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
                <h3 class="box-title m-b-0">Laporan Operasional</h3>
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
                                                <?php foreach($skpd as $s){ ?>
                                                    <option value="<?=$s->id_skpd?>"><?=$s->nama_skpd;?></option>
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
                                                <td>Pendapatan Asli Daerah-LO</td>
                                                <td>
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                            <div class="input-group-addon">Rp.</div>
                                                            <input id="pendapatan_asli_sekarang" name="pendapatan_asli_sekarang" onkeyup="perhitungan()" onchange="perhitungan()" required type="number" class="form-control">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td> 
                                                <div class="form-group">
                                                        <div class="input-group">
                                                            <div class="input-group-addon">Rp.</div>
                                                            <input id="pendapatan_asli_awal" name="pendapatan_asli_awal" onkeyup="perhitungan()" onchange="perhitungan()" required type="number" class="form-control">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td> 
                                                <div class="form-group">
                                                        <div class="input-group">
                                                            <div class="input-group-addon">Rp.</div>
                                                            <input id="total_pendapatan_asli" name="total_pendapatan_asli" onkeyup="perhitungan()" onchange="perhitungan()" required type="number" class="form-control" readonly>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Pendapatan Transfer-LO</td>
                                                <td>
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                            <div class="input-group-addon">Rp.</div>
                                                            <input id="pendapatan_transfer_sekarang" name="pendapatan_transfer_sekarang" onkeyup="perhitungan()" onchange="perhitungan()" required type="number" class="form-control">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td> 
                                                <div class="form-group">
                                                        <div class="input-group">
                                                            <div class="input-group-addon">Rp.</div>
                                                            <input id="pendapatan_transfer_awal" name="pendapatan_transfer_awal" onkeyup="perhitungan()" onchange="perhitungan()" required type="number" class="form-control">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td> 
                                                <div class="form-group">
                                                        <div class="input-group">
                                                            <div class="input-group-addon">Rp.</div>
                                                            <input id="total_pendapatan_transfer" name="total_pendapatan_transfer" onkeyup="perhitungan()" onchange="perhitungan()" required type="number" class="form-control" readonly>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Lain-lain Pendapatan Daerah yang Sah-LO</td>
                                                <td>
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                            <div class="input-group-addon">Rp.</div>
                                                            <input id="pendapatan_lain_sekarang" name="pendapatan_lain_sekarang" onkeyup="perhitungan()" onchange="perhitungan()" required type="number" class="form-control">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td> 
                                                <div class="form-group">
                                                        <div class="input-group">
                                                            <div class="input-group-addon">Rp.</div>
                                                            <input id="pendapatan_lain_awal" name="pendapatan_lain_awal" onkeyup="perhitungan()" onchange="perhitungan()" required type="number" class="form-control">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td> 
                                                <div class="form-group">
                                                        <div class="input-group">
                                                            <div class="input-group-addon">Rp.</div>
                                                            <input id="total_pendapatan_lain" name="total_pendapatan_lain" onkeyup="perhitungan()" onchange="perhitungan()" required type="number" class="form-control" readonly>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Surplus Non Operasional-LO</td>
                                                <td>
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                            <div class="input-group-addon">Rp.</div>
                                                            <input id="pendapatan_surplus_sekarang" name="pendapatan_surplus_sekarang" onkeyup="perhitungan()" onchange="perhitungan()" required type="number" class="form-control">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td> 
                                                <div class="form-group">
                                                        <div class="input-group">
                                                            <div class="input-group-addon">Rp.</div>
                                                            <input id="pendapatan_surplus_awal" name="pendapatan_surplus_awal" onkeyup="perhitungan()" onchange="perhitungan()" required type="number" class="form-control">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td> 
                                                <div class="form-group">
                                                        <div class="input-group">
                                                            <div class="input-group-addon">Rp.</div>
                                                            <input id="total_pendapatan_surplus" name="total_pendapatan_surplus" onkeyup="perhitungan()" onchange="perhitungan()" required type="number" class="form-control" readonly>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td><b>I. Jumlah Pendapatan-LO </b></td>
                                                <td>
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                            <div class="input-group-addon">Rp.</div>
                                                            <input type="number" id="total_pendapatan_lo_sekarang" name="total_pendapatan_lo_sekarang" onkeyup="perhitungan()" onchange="perhitungan()" required class="form-control" readonly>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td> 
                                                <div class="form-group">
                                                        <div class="input-group">
                                                            <div class="input-group-addon">Rp.</div>
                                                            <input type="number" id="total_pendapatan_lo_awal" name="total_pendapatan_lo_awal" onkeyup="perhitungan()" onchange="perhitungan()" required class="form-control " readonly>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td> 
                                                <div class="form-group">
                                                        <div class="input-group">
                                                            <div class="input-group-addon">Rp.</div>
                                                            <input type="number" id="total_pendapatan1_lo" name="total_pendapatan1_lo" onkeyup="perhitungan()" onchange="perhitungan()" required class="form-control" readonly>
                                                        </div>
                                                    </div>
                                                </td>

                                            </tr>
                                                <tr>
                                                    <td colspan="4"><b>Beban Operasi</b></td>
                                                </tr>
                                            <tr>
                                                <td>Beban Pegawai</td>
                                                <td>
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                            <div class="input-group-addon">Rp.</div>
                                                            <input type="number" name="beban_pegawai_sekarang"  onkeyup="perhitungan()" onchange="perhitungan()" required id="beban_pegawai_sekarang" class="form-control">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td> 
                                                <div class="form-group">
                                                        <div class="input-group">
                                                            <div class="input-group-addon">Rp.</div>
                                                            <input type="number" name="beban_pegawai_awal"  onkeyup="perhitungan()" onchange="perhitungan()" required id="beban_pegawai_awal" class="form-control">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td> 
                                                <div class="form-group">
                                                        <div class="input-group">
                                                            <div class="input-group-addon">Rp.</div>
                                                            <input type="number" name="total_beban_pegawai"  onkeyup="perhitungan()" onchange="perhitungan()" required id="total_beban_pegawai" class="form-control" readonly>
                                                        </div>
                                                    </div>
                                                </td>

                                            </tr>

                                            <tr>
                                                <td>Beban Barang dan Jasa</td>
                                                <td>
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                            <div class="input-group-addon">Rp.</div>
                                                            <input type="number" name="beban_barangjasa_sekarang" onkeyup="perhitungan()" onchange="perhitungan()" required id="beban_barangjasa_sekarang" class="form-control ">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td> 
                                                <div class="form-group">
                                                        <div class="input-group">
                                                            <div class="input-group-addon">Rp.</div>
                                                            <input type="number" name="beban_barangjasa_awal" onkeyup="perhitungan()" onchange="perhitungan()" required id="beban_barangjasa_awal" class="form-control ">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td> 
                                                <div class="form-group">
                                                        <div class="input-group">
                                                            <div class="input-group-addon">Rp.</div>
                                                            <input type="number" name="total_barangjasa" onkeyup="perhitungan()" onchange="perhitungan()" required id="total_barangjasa" class="form-control " readonly>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Beban Bunga</td>
                                                <td>
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                            <div class="input-group-addon">Rp.</div>
                                                            <input type="number" name="beban_bunga_sekarang" onkeyup="perhitungan()" onchange="perhitungan()" required id="beban_bunga_sekarang" class="form-control ">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td> 
                                                <div class="form-group">
                                                        <div class="input-group">
                                                            <div class="input-group-addon">Rp.</div>
                                                            <input type="number" name="beban_bunga_awal" onkeyup="perhitungan()" onchange="perhitungan()" required id="beban_bunga_awal" class="form-control ">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td> 
                                                <div class="form-group">
                                                        <div class="input-group">
                                                            <div class="input-group-addon">Rp.</div>
                                                            <input type="number" name="total_bunga" onkeyup="perhitungan()" onchange="perhitungan()" required id="total_bunga" class="form-control " readonly>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Beban Hibah</td>
                                                <td>
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                            <div class="input-group-addon">Rp.</div>
                                                            <input type="number" name="beban_hibah_sekarang" onkeyup="perhitungan()" onchange="perhitungan()" required id="beban_hibah_sekarang" class="form-control ">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td> 
                                                <div class="form-group">
                                                        <div class="input-group">
                                                            <div class="input-group-addon">Rp.</div>
                                                            <input type="number" name="beban_hibah_awal" onkeyup="perhitungan()" onchange="perhitungan()" required id="beban_hibah_awal" class="form-control ">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td> 
                                                <div class="form-group">
                                                        <div class="input-group">
                                                            <div class="input-group-addon">Rp.</div>
                                                            <input type="number" name="total_beban_hibah" onkeyup="perhitungan()" onchange="perhitungan()" required id="total_beban_hibah" class="form-control " readonly>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Beban Bantuan Sosial</td>
                                                <td>
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                            <div class="input-group-addon">Rp.</div>
                                                            <input type="number" name="beban_bantuansosial_sekarang" onkeyup="perhitungan()" onchange="perhitungan()" required id="beban_bantuansosial_sekarang" class="form-control ">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td> 
                                                <div class="form-group">
                                                        <div class="input-group">
                                                            <div class="input-group-addon">Rp.</div>
                                                            <input type="number" name="beban_bantuansosial_awal" onkeyup="perhitungan()" onchange="perhitungan()" required id="beban_bantuansosial_awal" class="form-control ">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td> 
                                                <div class="form-group">
                                                        <div class="input-group">
                                                            <div class="input-group-addon">Rp.</div>
                                                            <input type="number" name="total_bantuansosial" onkeyup="perhitungan()" onchange="perhitungan()" required id="total_bantuansosial" class="form-control " readonly>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Beban Penyisihan Piutang</td>
                                                <td>
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                            <div class="input-group-addon">Rp.</div>
                                                            <input type="number" name="beban_penyisihanpiutang_sekarang" onkeyup="perhitungan()" onchange="perhitungan()" required id="beban_penyisihanpiutang_sekarang" class="form-control ">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td> 
                                                <div class="form-group">
                                                        <div class="input-group">
                                                            <div class="input-group-addon">Rp.</div>
                                                            <input type="number" name="beban_penyisihanpiutang_awal" onkeyup="perhitungan()" onchange="perhitungan()" required id="beban_penyisihanpiutang_awal" class="form-control ">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td> 
                                                <div class="form-group">
                                                        <div class="input-group">
                                                            <div class="input-group-addon">Rp.</div>
                                                            <input type="number" name="total_penyisihanpiutang" onkeyup="perhitungan()" onchange="perhitungan()" required id="total_penyisihanpiutang" class="form-control " readonly>
                                                        </div>
                                                    </div>
                                                </td>

                                            </tr>

                                            <tr>
                                                <td>Beban Lain-lain</td>
                                                <td>
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                            <div class="input-group-addon">Rp.</div>
                                                            <input type="number" name="beban_lain_sekarang" onkeyup="perhitungan()" onchange="perhitungan()" required id="beban_lain_sekarang" class="form-control ">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td> 
                                                <div class="form-group">
                                                        <div class="input-group">
                                                            <div class="input-group-addon">Rp.</div>
                                                            <input type="number" name="beban_lain_awal" onkeyup="perhitungan()" onchange="perhitungan()" required id="beban_lain_awal" class="form-control ">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td> 
                                                <div class="form-group">
                                                        <div class="input-group">
                                                            <div class="input-group-addon">Rp.</div>
                                                            <input type="number" name="total_beban_lain" onkeyup="perhitungan()" onchange="perhitungan()" required id="total_beban_lain" class="form-control " readonly>
                                                        </div>
                                                    </div>
                                                </td>

                                            </tr>

                                            <tr>
                                                <td><b>(1) Jumlah Beban Operasi</b></td>
                                                <td>
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                            <div class="input-group-addon">Rp.</div>
                                                            <input type="number" name="jumlah_beban_operasi_sekarang" onkeyup="perhitungan()" onchange="perhitungan()" required  id="jumlah_beban_operasi_sekarang" class="form-control" readonly>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td> 
                                                <div class="form-group">
                                                        <div class="input-group">
                                                            <div class="input-group-addon">Rp.</div>
                                                            <input type="number" name="jumlah_beban_operasi_awal" onkeyup="perhitungan()" onchange="perhitungan()" required  id="jumlah_beban_operasi_awal"  class="form-control" readonly >
                                                        </div>
                                                    </div>
                                                </td>
                                                <td> 
                                                <div class="form-group">
                                                        <div class="input-group">
                                                            <div class="input-group-addon">Rp.</div>
                                                            <input type="number" name="total_beban_operasi" onkeyup="perhitungan()" onchange="perhitungan()" required  id="total_beban_operasi" class="form-control " readonly>
                                                        </div>
                                                    </div>
                                                </td>

                                            </tr>

                                            <tr>
                                                <td><b>(2) Beban Penyusutan dan Amortisasi</b></td>
                                                <td>
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                            <div class="input-group-addon">Rp.</div>
                                                            <input type="number" name="beban_penyusutan_sekarang" onkeyup="perhitungan()" onchange="perhitungan()" required id="beban_penyusutan_sekarang" class="form-control ">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td> 
                                                <div class="form-group">
                                                        <div class="input-group">
                                                            <div class="input-group-addon">Rp.</div>
                                                            <input type="number" name="beban_penyusutan_awal" onkeyup="perhitungan()" onchange="perhitungan()" required id="beban_penyusutan_awal" class="form-control ">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td> 
                                                <div class="form-group">
                                                        <div class="input-group">
                                                            <div class="input-group-addon">Rp.</div>
                                                            <input type="number" name="total_beban_penyusutan" onkeyup="perhitungan()" onchange="perhitungan()" required id="total_beban_penyusutan" id class="form-control " readonly>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td><b>(3)Beban Transfer</b></td>
                                                <td>
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                            <div class="input-group-addon">Rp.</div>
                                                            <input type="number" name="beban_transfer_sekarang" onkeyup="perhitungan()" onchange="perhitungan()" required id="beban_transfer_sekarang" class="form-control ">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td> 
                                                <div class="form-group">
                                                        <div class="input-group">
                                                            <div class="input-group-addon">Rp.</div>
                                                            <input type="number" name="beban_transfer_awal" onkeyup="perhitungan()" onchange="perhitungan()" required id="beban_transfer_awal" class="form-control ">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td> 
                                                <div class="form-group">
                                                        <div class="input-group">
                                                            <div class="input-group-addon">Rp.</div>
                                                            <input type="number" name="total_beban_transfer" onkeyup="perhitungan()" onchange="perhitungan()" required  id="total_beban_transfer" class="form-control " readonly>
                                                        </div>
                                                    </div>
                                                </td>

                                            </tr>

                                            <tr>
                                                <td><b>(4) Beban Tak Terduga</b></td>
                                                <td>
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                            <div class="input-group-addon">Rp.</div>
                                                            <input type="number" name="beban_takterduga_sekarang" onkeyup="perhitungan()" onchange="perhitungan()" required id="beban_takterduga_sekarang" class="form-control ">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td> 
                                                <div class="form-group">
                                                        <div class="input-group">
                                                            <div class="input-group-addon">Rp.</div>
                                                            <input type="number" name="beban_takterduga_awal" onkeyup="perhitungan()" onchange="perhitungan()" required id="beban_takterduga_awal" class="form-control ">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td> 
                                                <div class="form-group">
                                                        <div class="input-group">
                                                            <div class="input-group-addon">Rp.</div>
                                                            <input type="number" name="total_beban_takterduga" onkeyup="perhitungan()" onchange="perhitungan()" required id="total_beban_takterduga" class="form-control " readonly>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td><b>(5) Defisit Non Operasional-LO</b></td>
                                                <td>
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                            <div class="input-group-addon">Rp.</div>
                                                            <input type="number" name="defisit_keg_nonopera_sekarang" onkeyup="perhitungan()" onchange="perhitungan()" required id="defisit_keg_nonopera_sekarang" class="form-control ">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td> 
                                                <div class="form-group">
                                                        <div class="input-group">
                                                            <div class="input-group-addon">Rp.</div>
                                                            <input type="number" name="defisit_keg_nonopera_awal" onkeyup="perhitungan()" onchange="perhitungan()" required id="defisit_keg_nonopera_awal" class="form-control ">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td> 
                                                <div class="form-group">
                                                        <div class="input-group">
                                                            <div class="input-group-addon">Rp.</div>
                                                            <input type="number" name="total_defisit_keg_nonopera" onkeyup="perhitungan()" onchange="perhitungan()" required id="total_defisit_keg_nonopera" id class="form-control " readonly>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td><b>II. Total Beban (1+2+3+4+5) </b></td>
                                                <td>
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                            <div class="input-group-addon">Rp.</div>
                                                            <input type="number" name="total_beban_sekarang" onkeyup="perhitungan()" onchange="perhitungan()" required  id="total_beban_sekarang" class="form-control " readonly>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td> 
                                                <div class="form-group">
                                                        <div class="input-group">
                                                            <div class="input-group-addon">Rp.</div>
                                                            <input type="number" name="total_beban_awal" onkeyup="perhitungan()" onchange="perhitungan()" required  id="total_beban_awal" class="form-control " readonly>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td> 
                                                <div class="form-group">
                                                        <div class="input-group">
                                                            <div class="input-group-addon">Rp.</div>
                                                            <input type="number" name="total_beban_akhir" onkeyup="perhitungan()" onchange="perhitungan()" required id="total_beban_akhir" class="form-control " readonly>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td><b>III. Surplus / Defisit (I - II)</b> </td>
                                                <td>
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                            <div class="input-group-addon">Rp.</div>
                                                            <input type="number" name="surplus_sekarang"  onkeyup="perhitungan()" onchange="perhitungan()" required id="surplus_sekarang" class="form-control " readonly>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td> 
                                                <div class="form-group">
                                                        <div class="input-group">
                                                            <div class="input-group-addon">Rp.</div>
                                                            <input type="number" name="surplus_awal" onkeyup="perhitungan()" onchange="perhitungan()" required id="surplus_awal" class="form-control " readonly>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td> 
                                                <div class="form-group">
                                                        <div class="input-group">
                                                            <div class="input-group-addon">Rp.</div>
                                                            <input type="number" name="surplus_akhir" onkeyup="perhitungan()" onchange="perhitungan()" required id="surplus_akhir" class="form-control " readonly>
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
                                                    foreach($pegawai_bpkad as $p){;?>
                                                     <option value="<?=$p->id_pegawai;?>" <?=(@$sarerea_penandatangan->id_pegawai_1_bpkad == $p->id_pegawai)?"selected":""?>><?=$p->nama_lengkap;?></option>
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
                                                    foreach($pegawai_bpkad as $p){;?>
                                                     <option value="<?=$p->id_pegawai;?>" <?=(@$sarerea_penandatangan->id_pegawai_2_bpkad == $p->id_pegawai)?"selected":""?>><?=$p->nama_lengkap;?></option>
                                                   <?php
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <!-- <div class="col-md-12  p-t-10">
                                    <div class="form-group">
                                        <label class="col-sm-12">Kasubid Pelaporan Bidang Akuntasi BPKAD</label>
                                        <div class="col-sm-12">
                                        <select class="form-control select2" name="id_pegawai_3_bpkad">
                                        <?php 
                                                    foreach($pegawai_bpkad as $p){;?>
                                                     <option value="<?=$p->id_pegawai;?>"><?=$p->nama_lengkap;?></option>
                                                   <?php
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div> -->

                                <!-- <div class="col-md-12  p-t-10">
                                    <div class="form-group">
                                        <label class="col-sm-12">Pemproses Bidang Akutansi BPKAD</label>
                                        <div class="col-sm-12">
                                        <select class="form-control select2" name="id_pegawai_4_bpkad">
                                        <?php 
                                                    foreach($pegawai_bpkad as $p){;?>
                                                     <option value="<?=$p->id_pegawai;?>"><?=$p->nama_lengkap;?></option>
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
                                        <label class="col-sm-12">Kepala  </label>
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

                                <!-- <div class="col-md-12  p-t-10">
                                    <div class="form-group">
                                        <label class="col-sm-12">Pengelola Pemanfaatan BMD</label>
                                        <div class="col-sm-12">
                                        <select id="pegawaiSkpdPengelolaPemanfaatanBMD" name="id_pegawai_3_skpd" class="form-control select2">
                                        <option value="">-- Pilih Pegawai --</option>
                                            </select>
                                        </div>
                                    </div>
                                </div> -->

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
                                            <label class="col-sm-12">Lampiran <code>File PDF LO print out dari Aplikasi SIPASTI</code></label>
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
    var bulan = ['Januari', 'Februari', 'Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];

    async function getPegawaiSKPD(id){
        try {
            let response = await fetch("<?=base_url('pegawai/getPegawaiBySKPD/lo')?>", {
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
                // var obj3 = document.getElementById('pegawaiSkpdPengelolaPemanfaatanBMD');
                // var obj4 = document.getElementById('pegawaiSkpdPetugasAkutansi');
                var pegawai = datasend.data;
                obj1.innerHTML = "";
                obj2.innerHTML = "";
                // obj3.innerHTML = "";
                // obj4.innerHTML = "";
                pegawai.forEach(peg => {
                    var opt = '<option value="' + peg.id_pegawai + '">' + peg.nama_lengkap +  '</option>';
                    obj1.innerHTML = obj1.innerHTML + opt;
                    obj2.innerHTML = obj2.innerHTML + opt;
                    // obj3.innerHTML = obj3.innerHTML + opt;
                    // obj4.innerHTML = obj4.innerHTML + opt;
                });
                nama_skpd.innerHTML = datasend.skpd.nama_skpd;
            	if (datasend.laporan.id_laporan_operasional > 0) {
            		document.getElementById('pendapatan_asli_awal').value = datasend.laporan.pendapatan_asli_awal;
            		document.getElementById('pendapatan_transfer_awal').value = datasend.laporan.pendapatan_transfer_awal;
            		document.getElementById('pendapatan_lain_awal').value = datasend.laporan.pendapatan_lain_awal;
            		document.getElementById('pendapatan_surplus_awal').value = datasend.laporan.pendapatan_surplus_awal;
                    document.getElementById('beban_pegawai_awal').value = datasend.laporan.beban_pegawai_awal;
            		document.getElementById('beban_barangjasa_awal').value = datasend.laporan.beban_barangjasa_awal;
                    document.getElementById('beban_bunga_awal').value = datasend.laporan.beban_bunga_awal;
            		document.getElementById('beban_hibah_awal').value = datasend.laporan.beban_hibah_awal;
                    document.getElementById('beban_bantuansosial_awal').value = datasend.laporan.beban_bantuansosial_awal;
            		document.getElementById('beban_penyisihanpiutang_awal').value = datasend.laporan.beban_penyisihanpiutang_awal;
            		document.getElementById('beban_lain_awal').value = datasend.laporan.beban_lain_awal;
                    document.getElementById('beban_penyusutan_awal').value = datasend.laporan.beban_penyusutan_awal;
                    document.getElementById('beban_transfer_awal').value = datasend.laporan.beban_transfer_awal;
            		document.getElementById('beban_takterduga_awal').value = datasend.laporan.beban_takterduga_awal;
                    document.getElementById('defisit_keg_nonopera_awal').value = datasend.laporan.defisit_keg_nonopera_awal;

            		set_readonly(true);
            	} else {
            		document.getElementById('pendapatan_asli_awal').value = "";
            		document.getElementById('pendapatan_transfer_awal').value = "";
            		document.getElementById('pendapatan_lain_awal').value = "";
            		document.getElementById('pendapatan_surplus_awal').value = "";
            		document.getElementById('beban_pegawai_awal').value = "";
            		document.getElementById('beban_barangjasa_awal').value = "";
                    document.getElementById('beban_bunga_awal').value = "";
                    document.getElementById('beban_hibah_awal').value = "";
            		document.getElementById('beban_bantuansosial_awal').value = "";
                    document.getElementById('beban_penyisihanpiutang_awal').value = "";
            		document.getElementById('beban_lain_awal').value = "";
                    document.getElementById('beban_penyusutan_awal').value = "";
                    document.getElementById('beban_transfer_awal').value = "";
            		document.getElementById('beban_takterduga_awal').value = "";
                    document.getElementById('defisit_keg_nonopera_awal').value = "";

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
    		document.getElementById('pendapatan_asli_awal').setAttribute("readonly",true);
    		document.getElementById('pendapatan_transfer_awal').setAttribute("readonly",true);
    		document.getElementById('pendapatan_lain_awal').setAttribute("readonly",true);
    		document.getElementById('pendapatan_surplus_awal').setAttribute("readonly",true);
            document.getElementById('beban_pegawai_awal').setAttribute("readonly",true);
            document.getElementById('beban_barangjasa_awal').setAttribute("readonly",true);
            document.getElementById('beban_bunga_awal').setAttribute("readonly",true);
            document.getElementById('beban_hibah_awal').setAttribute("readonly",true);
            document.getElementById('beban_bantuansosial_awal').setAttribute("readonly",true);
    		document.getElementById('beban_penyisihanpiutang_awal').setAttribute("readonly",true);
            document.getElementById('beban_lain_awal').setAttribute("readonly",true);
    		document.getElementById('beban_penyusutan_awal').setAttribute("readonly",true);
    		document.getElementById('beban_transfer_awal').setAttribute("readonly",true);
    		document.getElementById('beban_takterduga_awal').setAttribute("readonly",true);
            document.getElementById('defisit_keg_nonopera_awal').setAttribute("readonly",true);
    		document.getElementById('btnEditNilai').classList.remove("hidden");
    	} else {
            document.getElementById('pendapatan_asli_awal').removeAttribute("readonly",false);
            document.getElementById('pendapatan_transfer_awal').removeAttribute("readonly",false);
            document.getElementById('pendapatan_lain_awal').removeAttribute("readonly",false);
            document.getElementById('pendapatan_surplus_awal').removeAttribute("readonly",false);
            document.getElementById('beban_pegawai_awal').removeAttribute("readonly",false);
            document.getElementById('beban_barangjasa_awal').removeAttribute("readonly",false);
            document.getElementById('beban_bunga_awal').removeAttribute("readonly",false);
            document.getElementById('beban_hibah_awal').removeAttribute("readonly",false);
            document.getElementById('beban_bantuansosial_awal').removeAttribute("readonly",false);
            document.getElementById('beban_penyisihanpiutang_awal').removeAttribute("readonly",false);
            document.getElementById('beban_lain_awal').removeAttribute("readonly",false);
            document.getElementById('beban_penyusutan_awal').removeAttribute("readonly",false);
            document.getElementById('beban_transfer_awal').removeAttribute("readonly",false);
            document.getElementById('beban_takterduga_awal').removeAttribute("readonly",false);
            document.getElementById('defisit_keg_nonopera_awal').removeAttribute("readonly",false);
    		document.getElementById('btnEditNilai').classList.add("hidden");
    	}
    }

    function getPeriode(){
        var periode = document.getElementById('tgl_periode').value;
        var tgl = new Date(periode);
        var tanggal = tgl.getDate();
        var xhari = tgl.getDay();
        var xbulan = tgl.getMonth();
        var xtahun = tgl.getYear();
        var tahun = (xtahun < 1000)?xtahun + 1900 : xtahun;
        var tgl_periode = tanggal + " " + bulan[xbulan] + " " + tahun;
        document.getElementById("periode").innerHTML = tgl_periode;    
        document.getElementById("periode-tahun").innerHTML = tahun - 1;    
        console.log(tgl_periode);
            
    }
    function perhitungan() {

        var pendapatan_asli_sekarang = document.getElementById('pendapatan_asli_sekarang').value;
        var pendapatan_asli_awal = document.getElementById('pendapatan_asli_awal').value;
        var total_pendapatan_asli = document.getElementById('total_pendapatan_asli');
        if (pendapatan_asli_sekarang.length != 0 && pendapatan_asli_awal.length != 0) {
            var pendapatan_asli = parseFloat(pendapatan_asli_sekarang) - parseFloat(pendapatan_asli_awal);
            total_pendapatan_asli.value = parseFloat(pendapatan_asli_sekarang) - parseFloat(pendapatan_asli_awal);
        }

        var pendapatan_transfer_sekarang = document.getElementById('pendapatan_transfer_sekarang').value;
        var pendapatan_transfer_awal = document.getElementById('pendapatan_transfer_awal').value;
        var total_pendapatan_transfer = document.getElementById('total_pendapatan_transfer');
        if (pendapatan_transfer_sekarang.length != 0 && pendapatan_transfer_awal.length != 0) {
            var pendapatan_transfer = parseFloat(pendapatan_transfer_sekarang) - parseFloat(pendapatan_transfer_awal);
            total_pendapatan_transfer.value = parseFloat(pendapatan_transfer_sekarang) - parseFloat(pendapatan_transfer_awal);
        }

        var pendapatan_lain_sekarang = document.getElementById('pendapatan_lain_sekarang').value;
        var pendapatan_lain_awal = document.getElementById('pendapatan_lain_awal').value;
        var total_pendapatan_lain = document.getElementById('total_pendapatan_lain');
        if (pendapatan_lain_sekarang.length != 0 && pendapatan_lain_awal.length != 0) {
            var pendapatan_lain = parseFloat(pendapatan_lain_sekarang) - parseFloat(pendapatan_lain_awal);
            total_pendapatan_lain.value = parseFloat(pendapatan_lain_sekarang) - parseFloat(pendapatan_lain_awal);
        }

        var pendapatan_surplus_sekarang = document.getElementById('pendapatan_surplus_sekarang').value;
        var pendapatan_surplus_awal = document.getElementById('pendapatan_surplus_awal').value;
        var total_pendapatan_surplus = document.getElementById('total_pendapatan_surplus');
        if (pendapatan_surplus_sekarang.length != 0 && pendapatan_surplus_awal.length != 0) {
            var pendapatan_surplus = parseFloat(pendapatan_surplus_sekarang) - parseFloat(pendapatan_surplus_awal);
            total_pendapatan_surplus.value = parseFloat(pendapatan_surplus_sekarang) - parseFloat(pendapatan_surplus_awal);
        }

        // var pendapatan_lo_sekarang = document.getElementById('pendapatan_lo_sekarang').value;
        // var pendapatan_lo_awal = document.getElementById('pendapatan_lo_awal').value;
        // var total_pendapatan_lo = document.getElementById('total_pendapatan_lo');

        var total_pendapatan_lo_sekarang = document.getElementById('total_pendapatan_lo_sekarang');
        var total_pendapatan_lo_awal = document.getElementById('total_pendapatan_lo_awal');
        var total_pendapatan1_lo = document.getElementById('total_pendapatan1_lo');

        total_pendapatan_lo_sekarang.value = parseFloat(pendapatan_asli_sekarang) + parseFloat(pendapatan_transfer_sekarang) + parseFloat(pendapatan_lain_sekarang) + parseFloat(pendapatan_surplus_sekarang);
        total_pendapatan_lo_awal.value =  parseFloat(pendapatan_asli_awal) + parseFloat(pendapatan_transfer_awal) + parseFloat(pendapatan_lain_awal) + parseFloat(pendapatan_surplus_awal);
        total_pendapatan1_lo.value = parseFloat(total_pendapatan_lo_sekarang.value) - parseFloat(total_pendapatan_lo_awal.value);


        //beban

        var beban_pegawai_sekarang = document.getElementById('beban_pegawai_sekarang').value;
        var beban_pegawai_awal = document.getElementById('beban_pegawai_awal').value;

        if (beban_pegawai_sekarang.length != 0 && beban_pegawai_awal.length != 0) {
            var operasi = parseFloat(beban_pegawai_sekarang) - parseFloat(beban_pegawai_awal);
            total_beban_pegawai.value = parseFloat(beban_pegawai_sekarang) - parseFloat(beban_pegawai_awal);
        }

        var beban_barangjasa_sekarang = document.getElementById('beban_barangjasa_sekarang').value;
        var beban_barangjasa_awal = document.getElementById('beban_barangjasa_awal').value;

        if (beban_barangjasa_sekarang.length != 0 && beban_barangjasa_awal.length != 0) {
            var operasi = parseFloat(beban_barangjasa_sekarang) - parseFloat(beban_barangjasa_awal);
            total_barangjasa.value = parseFloat(beban_barangjasa_sekarang) - parseFloat(beban_barangjasa_awal);
        }

        var beban_bunga_sekarang = document.getElementById('beban_bunga_sekarang').value;
        var beban_bunga_awal = document.getElementById('beban_bunga_awal').value;

        if (beban_bunga_sekarang.length != 0 && beban_bunga_awal.length != 0) {
            var operasi = parseFloat(beban_bunga_sekarang) - parseFloat(beban_bunga_awal);
            total_bunga.value = parseFloat(beban_bunga_sekarang) - parseFloat(beban_bunga_awal);
        }
        

        var beban_hibah_sekarang = document.getElementById('beban_hibah_sekarang').value;
        var beban_hibah_awal = document.getElementById('beban_hibah_awal').value;

        if (beban_hibah_sekarang.length != 0 && beban_hibah_awal.length != 0) {
            var operasi = parseFloat(beban_hibah_sekarang) - parseFloat(beban_hibah_awal);
            total_beban_hibah.value = parseFloat(beban_hibah_sekarang) - parseFloat(beban_hibah_awal);
        }

        
        var beban_bantuansosial_sekarang = document.getElementById('beban_bantuansosial_sekarang').value;
        var beban_bantuansosial_awal = document.getElementById('beban_bantuansosial_awal').value;

        if (beban_bantuansosial_sekarang.length != 0 && beban_bantuansosial_awal.length != 0) {
            var operasi = parseFloat(beban_bantuansosial_sekarang) - parseFloat(beban_bantuansosial_awal);
            total_bantuansosial.value = parseFloat(beban_bantuansosial_sekarang) - parseFloat(beban_bantuansosial_awal);
        }
        
        var beban_penyisihanpiutang_sekarang = document.getElementById('beban_penyisihanpiutang_sekarang').value;
        var beban_penyisihanpiutang_awal = document.getElementById('beban_penyisihanpiutang_awal').value;

        if (beban_penyisihanpiutang_sekarang.length != 0 && beban_penyisihanpiutang_awal.length != 0) {
            var operasi = parseFloat(beban_penyisihanpiutang_sekarang) - parseFloat(beban_penyisihanpiutang_awal);
            total_penyisihanpiutang.value = parseFloat(beban_penyisihanpiutang_sekarang) - parseFloat(beban_penyisihanpiutang_awal);
        }

        var beban_lain_sekarang = document.getElementById('beban_lain_sekarang').value;
        var beban_lain_awal = document.getElementById('beban_lain_awal').value;

        if (beban_lain_sekarang.length != 0 && beban_lain_awal.length != 0) {
            var operasi = parseFloat(beban_lain_sekarang) - parseFloat(beban_lain_awal);
            total_beban_lain.value = parseFloat(beban_lain_sekarang) - parseFloat(beban_lain_awal);
        }


        var operasi1 = parseFloat(beban_pegawai_sekarang) + parseFloat(beban_barangjasa_sekarang) + parseFloat(beban_bunga_sekarang) + parseFloat(beban_hibah_sekarang) + parseFloat(beban_bantuansosial_sekarang) + parseFloat(beban_penyisihanpiutang_sekarang) + parseFloat(beban_lain_sekarang) ;
        jumlah_beban_operasi_sekarang.value = operasi1;
        
        var operasi2 = parseFloat(beban_pegawai_awal) + parseFloat(beban_barangjasa_awal) + parseFloat(beban_bunga_awal) + parseFloat(beban_hibah_awal) + parseFloat(beban_bantuansosial_awal) + parseFloat(beban_penyisihanpiutang_awal) + parseFloat(beban_lain_awal) ;
        jumlah_beban_operasi_awal.value = operasi2;

        var operasi3 = parseFloat(jumlah_beban_operasi_sekarang.value) - parseFloat(jumlah_beban_operasi_awal.value)  ;
        total_beban_operasi.value = operasi3;

        var beban_penyusutan_sekarang = document.getElementById('beban_penyusutan_sekarang').value;
        var beban_penyusutan_awal = document.getElementById('beban_penyusutan_awal').value;

        if (beban_penyusutan_sekarang.length != 0 && beban_penyusutan_awal.length != 0) {
            var operasi = parseFloat(beban_penyusutan_sekarang) - parseFloat(beban_penyusutan_awal);
            total_beban_penyusutan.value = parseFloat(beban_penyusutan_sekarang) - parseFloat(beban_penyusutan_awal);
        }

        var beban_transfer_sekarang = document.getElementById('beban_transfer_sekarang').value;
        var beban_transfer_awal = document.getElementById('beban_transfer_awal').value;

        if (beban_transfer_sekarang.length != 0 && beban_transfer_awal.length != 0) {
            var operasi = parseFloat(beban_transfer_sekarang) - parseFloat(beban_transfer_awal);
            total_beban_transfer.value = parseFloat(beban_transfer_sekarang) - parseFloat(beban_transfer_awal);
        }

        var beban_takterduga_sekarang = document.getElementById('beban_takterduga_sekarang').value;
        var beban_takterduga_awal = document.getElementById('beban_takterduga_awal').value;

        if (beban_takterduga_sekarang.length != 0 && beban_takterduga_awal.length != 0) {
            var operasi = parseFloat(beban_takterduga_sekarang) - parseFloat(beban_takterduga_awal);
            total_beban_takterduga.value = parseFloat(beban_takterduga_sekarang) - parseFloat(beban_takterduga_awal);
        }
        
        var defisit_keg_nonopera_sekarang = document.getElementById('defisit_keg_nonopera_sekarang').value;
        var defisit_keg_nonopera_awal = document.getElementById('defisit_keg_nonopera_awal').value;

        if (defisit_keg_nonopera_sekarang.length != 0 && defisit_keg_nonopera_awal.length != 0) {
            var operasi = parseFloat(defisit_keg_nonopera_sekarang) - parseFloat(defisit_keg_nonopera_awal);
            total_defisit_keg_nonopera.value = parseFloat(defisit_keg_nonopera_sekarang) - parseFloat(defisit_keg_nonopera_awal);
        }
         
        var operasi4 = parseFloat(jumlah_beban_operasi_sekarang.value) + parseFloat(beban_penyusutan_sekarang) + parseFloat(beban_transfer_sekarang) + parseFloat(beban_takterduga_sekarang) + parseFloat(defisit_keg_nonopera_sekarang) ;
        // console.log(operasi4);
        // console.log(jumlah_beban_operasi_sekarang);
        total_beban_sekarang.value = operasi4;
        
        var operasi5 = parseFloat(jumlah_beban_operasi_awal.value) + parseFloat(beban_penyusutan_awal) + parseFloat(beban_transfer_awal) + parseFloat(beban_takterduga_awal) + parseFloat(defisit_keg_nonopera_awal) ;
        total_beban_awal.value = operasi5;

        var operasi6 = parseFloat(total_beban_sekarang.value) - parseFloat(total_beban_awal.value) ;
        total_beban_akhir.value = operasi6;

        

        var operasi7 = parseFloat(total_pendapatan_lo_sekarang.value) - parseFloat(total_beban_sekarang.value);
        surplus_sekarang.value = operasi7;

        var operasi8 = parseFloat(total_pendapatan_lo_awal.value) - parseFloat(total_beban_awal.value);
        surplus_awal.value = operasi8;

        var operasi9 = parseFloat(surplus_sekarang.value) - parseFloat(surplus_awal.value) ;
        surplus_akhir.value = operasi9;



    }

   
    
    

</script>


<script src="<?= base_url(); ?>/asset/pixel/plugins/bower_components/mask/jquery.mask.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {

    	$('#edit-id_skpd').val('<?=$this->session->userdata("id_skpd")?>').trigger("change");
        <?php if ($this->session->userdata("id_skpd") != 25 AND $this->session->userdata("level") != "Administrator"): ?>
            $('#hidden-id_skpd').val('<?=$this->session->userdata("id_skpd")?>');
            $('#edit-id_skpd').attr("disabled",true);
        <?php endif; ?>
    	$('.dropify').dropify();
        // Format mata .
        $('.').mask('000.000.000', {
            reverse: true
        });

    })
</script>