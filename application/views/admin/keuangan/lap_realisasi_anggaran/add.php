<div class="container-fluid">

    <div class="row bg-title">
        <div class="col-lg-6 col-md-6 col-sm-4 col-xs-12">
            <h4 class="page-title">Rekonsiliasi Laporan Realisasi Anggaran</h4>
        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <ol class="breadcrumb">
                <li>Lap. Realisasi Anggaran</li>
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
                    <h3 class="box-title m-b-0">Laporan Realisasi Anggaran</h3>
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
                                                    <th>Total Pendapatan</th>
                                                    <th>Jumlah s.d. 
                                                    <span id="periode"></span>
                                                </th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr style="text-align: center; background: #f3f3f3">
                                                    <td>1</td>
                                                    <td>2</td>

                                                </tr>

                                                <tr>
                                                    <td>Pendapatan Asli Daerah</td>
                                                    <td>
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <div class="input-group-addon">Rp.</div>
                                                                <input type="number" name="pendapatan_asli" id="pendapatan_asli" onkeyup="perhitungan()" onchange="perhitungan()" required class="form-control ">
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>Pendapatan Transfer</td>
                                                    <td>
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <div class="input-group-addon">Rp.</div>
                                                                <input type="number" name="pendapatan_transfer" id="pendapatan_transfer" onkeyup="perhitungan()" onchange="perhitungan()" required class="form-control ">
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>Lain-lain Pendapatan Daerah yang Sah</td>
                                                    <td>
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <div class="input-group-addon">Rp.</div>
                                                                <input type="number" name="pendapatan_lain" id="pendapatan_lain" onkeyup="perhitungan()" onchange="perhitungan()" required class="form-control ">
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td><b>I. Jumlah Pendapatan </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <div class="input-group-addon">Rp.</div>
                                                                <input type="number" name="total_pendapatan" id="total_pendapatan" onkeyup="perhitungan()" onchange="perhitungan()" required  class="form-control " readonly>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td><b>Belanja Operasi </b></td>
                                                    <td>
                                                        <!-- <div class="form-group">
                                                            <div class="input-group">
                                                                <div class="input-group-addon">Rp.</div>
                                                                <input type="number" name="belanja_operasi" id="belanja_operasi" onkeyup="perhitungan()" onchange="perhitungan()" required class="form-control ">
                                                            </div>
                                                        </div> -->
                                                    </td>


                                                </tr>

                                                <!-- <tr>
                                                    <td><b>Beban Operasi</b></td>
                                                    <td>
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <div class="input-group-addon">Rp.</div>
                                                                <input type="number" name="beban_operasi" id="beban_operasi" onkeyup="perhitungan()" onchange="perhitungan()" required class="form-control ">
                                                            </div>
                                                        </div>
                                                    </td>


                                                </tr> -->

                                                <tr>
                                                    <td>Belanja Pegawai</td>
                                                    <td>
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <div class="input-group-addon">Rp.</div>
                                                                <input type="number" name="belanja_pegawai" id="belanja_pegawai" onkeyup="perhitungan()" onchange="perhitungan()" required class="form-control ">
                                                            </div>
                                                        </div>
                                                    </td>

                                                </tr>

                                                <tr>
                                                    <td>Belanja Barang dan Jasa</td>
                                                    <td>
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <div class="input-group-addon">Rp.</div>
                                                                <input type="number" name="belanja_barang_jasa" id="belanja_barang_jasa" onkeyup="perhitungan()" onchange="perhitungan()" required class="form-control ">
                                                            </div>
                                                        </div>
                                                    </td>

                                                </tr>

                                                <tr>
                                                    <td>Belanja Bunga</td>
                                                    <td>
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <div class="input-group-addon">Rp.</div>
                                                                <input type="number" name="belanja_bunga" id="belanja_bunga" onkeyup="perhitungan()" onchange="perhitungan()" required class="form-control ">
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>

                                                </tr>

                                                <tr>
                                                    <td>Belanja Hibah</td>
                                                    <td>
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <div class="input-group-addon">Rp.</div>
                                                                <input type="number" name="belanja_hibah" id="belanja_hibah" onkeyup="perhitungan()" onchange="perhitungan()" required class="form-control ">
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>

                                                </tr>

                                                <tr>
                                                    <td>Belanja Bantuan Sosial</td>
                                                    <td>
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <div class="input-group-addon">Rp.</div>
                                                                <input type="number" name="belanja_bantuan_sosial" onkeyup="perhitungan()" onchange="perhitungan()" required id="belanja_bantuan_sosial" class="form-control ">
                                                            </div>
                                                        </div>
                                                    </td>


                                                </tr>

                                                <tr>
                                                    <td><b>(1) Jumlah Belanja Operasi</b> </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <div class="input-group-addon">Rp.</div>
                                                                <input type="number" name="jumlah_belanja_operasi" onkeyup="perhitungan()" onchange="perhitungan()" required id="jumlah_belanja_operasi" class="form-control " readonly>
                                                            </div>
                                                        </div>
                                                    </td>


                                                </tr>


                                                <tr>
                                                    <td><b>Belanja Modal</b></td>
                                                    <td>
                                                        <!-- <div class="form-group">
                                                            <div class="input-group">
                                                                <div class="input-group-addon">Rp.</div>
                                                                <input type="number" name="belanja_modal" onkeyup="perhitungan()" onchange="perhitungan()" required id="belanja_modal" class="form-control ">
                                                            </div>
                                                        </div> -->
                                                    </td>


                                                </tr>

                                                <tr>
                                                    <td>Belanja Modal Tanah</td>
                                                    <td>
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <div class="input-group-addon">Rp.</div>
                                                                <input type="number" name="belanja_m_tanah" onkeyup="perhitungan()" onchange="perhitungan()" required id="belanja_m_tanah" class="form-control ">
                                                            </div>
                                                        </div>
                                                    </td>


                                                </tr>

                                                <tr>
                                                    <td>Belanja Modal Peralatan dan Mesin</td>
                                                    <td>
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <div class="input-group-addon">Rp.</div>
                                                                <input type="number" name="belanja_m_peralatan_mesin" onkeyup="perhitungan()" onchange="perhitungan()" required id="belanja_m_peralatan_mesin" class="form-control ">
                                                            </div>
                                                        </div>
                                                    </td>

                                                </tr>

                                                <tr>
                                                    <td>Belanja Modal Gedung dan Bangunan </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <div class="input-group-addon">Rp.</div>
                                                                <input type="number" name="belanja_m_gedung_bangunan" onkeyup="perhitungan()" onchange="perhitungan()" required id="belanja_m_gedung_bangunan" class="form-control ">
                                                            </div>
                                                        </div>
                                                    </td>

                                                </tr>

                                                <tr>
                                                    <td> Belanja Modal Jalan, Jaringan dan Irigasi</td>
                                                    <td>
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <div class="input-group-addon">Rp.</div>
                                                                <input type="number" name="belanja_m_jalan" onkeyup="perhitungan()" onchange="perhitungan()" required id="belanja_m_jalan" class="form-control ">
                                                            </div>
                                                        </div>
                                                    </td>

                                                </tr>

                                                <tr>
                                                    <td> Belanja Modal Aset Tetap Lainya</td>
                                                    <td>
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <div class="input-group-addon">Rp.</div>
                                                                <input type="number" name="belanja_m_aset_tetap" onkeyup="perhitungan()" onchange="perhitungan()" required id="belanja_m_aset_tetap" class="form-control ">
                                                            </div>
                                                        </div>
                                                    </td>

                                                </tr>

                                                <tr>
                                                    <td> Belanja Modal Aset Lainya</td>
                                                    <td>
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <div class="input-group-addon">Rp.</div>
                                                                <input type="number" name="belanja_m_aset_lainya" onkeyup="perhitungan()" onchange="perhitungan()" required id="belanja_m_aset_lainya" class="form-control ">
                                                            </div>
                                                        </div>
                                                    </td>

                                                </tr>

                                                <tr>
                                                    <td> <b>(2) Jumlah Belanja Modal</b></td>
                                                    <td>
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <div class="input-group-addon">Rp.</div>
                                                                <input type="number" name="jumlah_modal_belanja" onkeyup="perhitungan()" onchange="perhitungan()" required id="jumlah_modal_belanja" class="form-control " readonly >
                                                            </div>
                                                        </div>
                                                    </td>

                                                </tr>

                                                <tr>
                                                    <td> <b>(3) Belanja Tak Terduga</b></td>
                                                    <td>
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <div class="input-group-addon">Rp.</div>
                                                                <input type="number" name="belanja_tak_terduga" onkeyup="perhitungan()" onchange="perhitungan()" required id="belanja_tak_terduga" class="form-control ">
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td> <b>(4) Belanja Transfer</b></td>
                                                    <td>
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <div class="input-group-addon">Rp.</div>
                                                                <input type="number" name="transfer" onkeyup="perhitungan()" onchange="perhitungan()" required id="transfer" class="form-control ">
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td> <b>II. Total Belanja & Transfer (1+2+3+4)</b></td>
                                                    <td>
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <div class="input-group-addon">Rp.</div>
                                                                <input type="number" name="total_belanja_transfer" onkeyup="perhitungan()" onchange="perhitungan()" required id="total_belanja_transfer" class="form-control " readonly>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td> <b>III. Surplus/Defisit (I-II)</b></td>
                                                    <td>
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <div class="input-group-addon">Rp.</div>
                                                                <input type="number" name="surplus" id="surplus" onkeyup="perhitungan()" onchange="perhitungan()" required class="form-control " readonly>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>(1) Penerimaan Pembiayaan</td>
                                                    <td>
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <div class="input-group-addon">Rp.</div>
                                                                <input type="number" name="penerimaan_pembiayaan" id="penerimaan_pembiayaan" onkeyup="perhitungan()" onchange="perhitungan()" required class="form-control ">
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>(2) Pengeluaran Pembiayaan</td>
                                                    <td>
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <div class="input-group-addon">Rp.</div>
                                                                <input type="number" name="pengeluaran_pembiayaan" id="pengeluaran_pembiayaan" onkeyup="perhitungan()" onchange="perhitungan()" required class="form-control ">
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td><b>IV. Pembiayaan Bersih (1-2)</td>
                                                    <td>
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <div class="input-group-addon">Rp.</div>
                                                                <input type="number" name="pembiayaan_bersih" id="pembiayaan_bersih" onkeyup="perhitungan()" onchange="perhitungan()" required  class="form-control " readonly>
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
                                                                <option value="<?= $p->id_pegawai; ?>" <?=(@$sarerea_penandatangan->id_pegawai_1_bpkad == $p->id_pegawai)?"selected":""?>><?= $p->nama_lengkap; ?></option>
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
                                                                <option value="<?= $p->id_pegawai; ?>" <?=(@$sarerea_penandatangan->id_pegawai_2_bpkad == $p->id_pegawai)?"selected":""?>><?= $p->nama_lengkap; ?></option>
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
                                                            foreach ($pegawai_bpkad as $p) {; ?>
                                                                <option value="<?= $p->id_pegawai; ?>"><?= $p->nama_lengkap; ?></option>
                                                            <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-12  p-t-10">
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

                                            <!-- <div class="col-md-12  p-t-10">
                                                <div class="form-group">
                                                    <label class="col-sm-12">Pengelola Pemanfaatan BMD</label>
                                                    <div class="col-sm-12">
                                                        <select id="pegawaiSkpdPengelolaPemanfaatanBMD" name="id_pegawai_3_skpd" class="form-control select2">
                                                            <option value="">-- Pilih Pegawai --</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-12  p-t-10">
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
                                            <label class="col-sm-12">Lampiran <code>File PDF LRA print out dari Aplikasi SIPASTI</code></label>
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

    async function getPegawaiSKPD(id) {
        try {
            let response = await fetch("<?= base_url('pegawai/getPegawaiBySKPD') ?>", {
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
                    var opt = '<option value="' + peg.id_pegawai + '">' + peg.nama_lengkap + '</option>';
                    obj1.innerHTML = obj1.innerHTML + opt;
                    obj2.innerHTML = obj2.innerHTML + opt;
                    // obj3.innerHTML = obj3.innerHTML + opt;
                    // obj4.innerHTML = obj4.innerHTML + opt;
                });
                nama_skpd.innerHTML = datasend.skpd.nama_skpd;
            }
        } catch (err) {
            console.log(err);
        }
    }

    function getPeriode() {
        var periode = document.getElementById('tgl_periode').value;
        var tgl = new Date(periode);
        var tanggal = tgl.getDate();
        var xhari = tgl.getDay();
        var xbulan = tgl.getMonth();
        var xtahun = tgl.getYear();
        var tahun = (xtahun < 1000)?xtahun + 1900 : xtahun;
        var tgl_periode = tanggal + " " + bulan[xbulan] + " " + tahun;
        document.getElementById("periode").innerHTML = tgl_periode;    
        console.log(tgl_periode);

    }

    function perhitungan() {
        // var total_pendapatan = document.getElementById('total_pendapatan').value;
        // var belanja_operasi = document.getElementById('belanja_operasi').value;;
        // var belanja_pegawai = document.getElementById('belanja_pegawai').value;
        // var belanja_barang_jasa = document.getElementById('belanja_barang_jasa').value;
        // var belanja_hibah = document.getElementById('belanja_hibah').value;
        // var belanja_bantuan_sosial = document.getElementById('belanja_bantuan_sosial').value;
        // var jumlah_belanja_operasi = document.getElementById('jumlah_belanja_operasi').value;
        // var belanja_modal = document.getElementById('belanja_modal').value;
        // var belanja_m_tanah = document.getElementById('belanja_m_tanah').value;
        // var belanja_m_peralatan_mesin = document.getElementById('belanja_m_peralatan_mesin').value;
        // var belanja_m_gedung_bangunan = document.getElementById('belanja_m_gedung_bangunan').value;
        // var belanja_m_jalan = document.getElementById('belanja_m_jalan').value;
        // var belanja_m_aset_tetap = document.getElementById('belanja_m_aset_tetap').value;
        // var belanja_m_aset_lainya = document.getElementById('belanja_m_aset_lainya').value;
        // var jumlah_modal_belanja = document.getElementById('jumlah_modal_belanja').value;
        // var belanja_tak_terduga = document.getElementById('belanja_tak_terduga').value;
        // var transfer = document.getElementById('transfer').value;
        // var total_belanja_transfer = document.getElementById('total_belanja_transfer').value;
        // var surplus = document.getElementById('surplus').value;

        if (belanja_pegawai.length != 0 && belanja_barang_jasa.length != 0 && belanja_bunga.length != 0 && belanja_hibah.length != 0 && belanja_bantuan_sosial.length != 0) {

        var operasi1 = parseFloat(belanja_pegawai.value) + parseFloat(belanja_barang_jasa.value) + parseFloat(belanja_bunga.value) + parseFloat(belanja_hibah.value) + parseFloat(belanja_bantuan_sosial.value) ;
        jumlah_belanja_operasi.value = operasi1;
        }

        var get_total_pendapatan = parseFloat(pendapatan_asli.value) + parseFloat(pendapatan_transfer.value) + parseFloat(pendapatan_lain.value);
        total_pendapatan.value = get_total_pendapatan;

        var operasi2 = parseFloat(belanja_m_tanah.value) + parseFloat(belanja_m_peralatan_mesin.value) + parseFloat(belanja_m_gedung_bangunan.value) + parseFloat(belanja_m_jalan.value) + parseFloat(belanja_m_aset_tetap.value) + parseFloat(belanja_m_aset_lainya.value);
        jumlah_modal_belanja.value = operasi2;

        var operasi3 = parseFloat(jumlah_belanja_operasi.value) + parseFloat(jumlah_modal_belanja.value) + parseFloat(belanja_tak_terduga.value) +  parseFloat(transfer.value);
        total_belanja_transfer.value = operasi3;

        var operasi4 = parseFloat(total_pendapatan.value) - parseFloat(total_belanja_transfer.value);
        surplus.value = operasi4;

        var get_pembiayaan_bersih = parseFloat(penerimaan_pembiayaan.value) - parseFloat(pengeluaran_pembiayaan.value);
        pembiayaan_bersih.value = get_pembiayaan_bersih;
    }
</script>


<script src="<?= base_url(); ?>/asset/pixel/plugins/bower_components/mask/jquery.mask.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {

        $('#edit-id_skpd').val('<?=$this->session->userdata("id_skpd")?>').trigger("change");
        <?php if ($this->session->userdata("id_skpd") != 25): ?>
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