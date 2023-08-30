<div class="container-fluid">

    <div class="row bg-title">
        <div class="col-lg-6 col-md-6 col-sm-4 col-xs-12">
            <h4 class="page-title">Laporan Keuangan - Rekonsiliasi Neraca</h4>
        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <ol class="breadcrumb">
                <li>Lap. Operasional</li>
                <li class="active">Tambah</li>
            </ol>
        </div>
        <!-- /.col-lg-12 -->
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="white-box">
                <h3 class="box-title m-b-0">Laporan Neraca</h3>
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
                            <h4><span>3</span>Pendatangan</h4>
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
                                            <select class="form-control select2">
                                                <?php foreach($skpd as $s){ ?>
                                                    <option value=""><?=$s->nama_skpd;?></option>
                                                <?php } ?>
                                    
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12 p-t-10">
                                    <div class="form-group">
                                        <label class="col-sm-12">Periode </label>
                                        <div class="col-sm-12">
                                            <input type="date" class="form-control">
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
                                                <th>Jumlah s.d Juli</th>
                                                <th>Jumlah s.d 31 Desember 2021</th>
                                                <th>Kenaikan / Penurunan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr style="text-align: center; background: #f3f3f3">
                                                <td>1</td>
                                                <td>2</td>
                                                <td>3</td>
                                                <td>4 = 2 - 3</td>
                                            </tr>
                                            <tr>
                                                <td><b>Aset Lancar (a)</td>
                                                <td>
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                            <div class="input-group-addon">Rp.</div>
                                                            <input type="text" class="form-control uang">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td> 
                                                <div class="form-group">
                                                        <div class="input-group">
                                                            <div class="input-group-addon">Rp.</div>
                                                            <input type="text" class="form-control uang">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td> 
                                                <div class="form-group">
                                                        <div class="input-group">
                                                            <div class="input-group-addon">Rp.</div>
                                                            <input type="text" class="form-control uang" disabled>
                                                        </div>
                                                    </div>
                                                </td>

                                            </tr>

                                            <tr>
                                                <td>Kas Bendahara Pengeluaran</td>
                                                <td>
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                            <div class="input-group-addon">Rp.</div>
                                                            <input type="text" class="form-control uang">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td> 
                                                <div class="form-group">
                                                        <div class="input-group">
                                                            <div class="input-group-addon">Rp.</div>
                                                            <input type="text" class="form-control uang">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td> 
                                                <div class="form-group">
                                                        <div class="input-group">
                                                            <div class="input-group-addon">Rp.</div>
                                                            <input type="text" class="form-control uang" disabled>
                                                        </div>
                                                    </div>
                                                </td>

                                            </tr>

                                            <tr>
                                                <td>Persedian</td>
                                                <td>
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                            <div class="input-group-addon">Rp.</div>
                                                            <input type="text" class="form-control uang">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td> 
                                                <div class="form-group">
                                                        <div class="input-group">
                                                            <div class="input-group-addon">Rp.</div>
                                                            <input type="text" class="form-control uang">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td> 
                                                <div class="form-group">
                                                        <div class="input-group">
                                                            <div class="input-group-addon">Rp.</div>
                                                            <input type="text" class="form-control uang" disabled>
                                                        </div>
                                                    </div>
                                                </td>

                                            </tr>

                                            <tr>
                                                <td>dst</td>
                                                <td>
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                            <div class="input-group-addon">Rp.</div>
                                                            <input type="text" class="form-control uang">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td> 
                                                <div class="form-group">
                                                        <div class="input-group">
                                                            <div class="input-group-addon">Rp.</div>
                                                            <input type="text" class="form-control uang">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td> 
                                                <div class="form-group">
                                                        <div class="input-group">
                                                            <div class="input-group-addon">Rp.</div>
                                                            <input type="text" class="form-control uang" disabled>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td><b>Investasi Jangka Panjang</b></td>
                                                <td>
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                            <div class="input-group-addon">Rp.</div>
                                                            <input type="text" class="form-control uang">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td> 
                                                <div class="form-group">
                                                        <div class="input-group">
                                                            <div class="input-group-addon">Rp.</div>
                                                            <input type="text" class="form-control uang">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td> 
                                                <div class="form-group">
                                                        <div class="input-group">
                                                            <div class="input-group-addon">Rp.</div>
                                                            <input type="text" class="form-control uang" disabled>
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
                                                            <input type="text" class="form-control uang">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td> 
                                                <div class="form-group">
                                                        <div class="input-group">
                                                            <div class="input-group-addon">Rp.</div>
                                                            <input type="text" class="form-control uang">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td> 
                                                <div class="form-group">
                                                        <div class="input-group">
                                                            <div class="input-group-addon">Rp.</div>
                                                            <input type="text" class="form-control uang" disabled>
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
                                                            <input type="text" class="form-control uang">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td> 
                                                <div class="form-group">
                                                        <div class="input-group">
                                                            <div class="input-group-addon">Rp.</div>
                                                            <input type="text" class="form-control uang">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td> 
                                                <div class="form-group">
                                                        <div class="input-group">
                                                            <div class="input-group-addon">Rp.</div>
                                                            <input type="text" class="form-control uang" disabled>
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
                                                            <input type="text" class="form-control uang">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td> 
                                                <div class="form-group">
                                                        <div class="input-group">
                                                            <div class="input-group-addon">Rp.</div>
                                                            <input type="text" class="form-control uang">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td> 
                                                <div class="form-group">
                                                        <div class="input-group">
                                                            <div class="input-group-addon">Rp.</div>
                                                            <input type="text" class="form-control uang" disabled>
                                                        </div>
                                                    </div>
                                                </td>

                                            </tr>

                                            <tr>
                                                <td>Jalan Irigasi dan jaringan</td>
                                                <td>
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                            <div class="input-group-addon">Rp.</div>
                                                            <input type="text" class="form-control uang">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td> 
                                                <div class="form-group">
                                                        <div class="input-group">
                                                            <div class="input-group-addon">Rp.</div>
                                                            <input type="text" class="form-control uang">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td> 
                                                <div class="form-group">
                                                        <div class="input-group">
                                                            <div class="input-group-addon">Rp.</div>
                                                            <input type="text" class="form-control uang" disabled>
                                                        </div>
                                                    </div>
                                                </td>

                                            </tr>

                                            <tr>
                                                <td>Asset Tetap lainnya</td>
                                                <td>
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                            <div class="input-group-addon">Rp.</div>
                                                            <input type="text" class="form-control uang">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td> 
                                                <div class="form-group">
                                                        <div class="input-group">
                                                            <div class="input-group-addon">Rp.</div>
                                                            <input type="text" class="form-control uang">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td> 
                                                <div class="form-group">
                                                        <div class="input-group">
                                                            <div class="input-group-addon">Rp.</div>
                                                            <input type="text" class="form-control uang" disabled>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Kontruksi dalam pengerjaan</td>
                                                <td>
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                            <div class="input-group-addon">Rp.</div>
                                                            <input type="text" class="form-control uang">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td> 
                                                <div class="form-group">
                                                        <div class="input-group">
                                                            <div class="input-group-addon">Rp.</div>
                                                            <input type="text" class="form-control uang">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td> 
                                                <div class="form-group">
                                                        <div class="input-group">
                                                            <div class="input-group-addon">Rp.</div>
                                                            <input type="text" class="form-control uang" disabled>
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
                                                            <input type="text" class="form-control uang">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td> 
                                                <div class="form-group">
                                                        <div class="input-group">
                                                            <div class="input-group-addon">Rp.</div>
                                                            <input type="text" class="form-control uang">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td> 
                                                <div class="form-group">
                                                        <div class="input-group">
                                                            <div class="input-group-addon">Rp.</div>
                                                            <input type="text" class="form-control uang" disabled>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td><b>Aset Lainnya </b></td>
                                                <td>
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                            <div class="input-group-addon">Rp.</div>
                                                            <input type="text" class="form-control uang">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td> 
                                                <div class="form-group">
                                                        <div class="input-group">
                                                            <div class="input-group-addon">Rp.</div>
                                                            <input type="text" class="form-control uang">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td> 
                                                <div class="form-group">
                                                        <div class="input-group">
                                                            <div class="input-group-addon">Rp.</div>
                                                            <input type="text" class="form-control uang" disabled>
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
                                                            <input type="text" class="form-control uang" disabled>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td> 
                                                <div class="form-group">
                                                        <div class="input-group">
                                                            <div class="input-group-addon">Rp.</div>
                                                            <input type="text" class="form-control uang" disabled>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td> 
                                                <div class="form-group">
                                                        <div class="input-group">
                                                            <div class="input-group-addon">Rp.</div>
                                                            <input type="text" class="form-control uang" disabled>
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
                                                            <input type="text" class="form-control uang">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td> 
                                                <div class="form-group">
                                                        <div class="input-group">
                                                            <div class="input-group-addon">Rp.</div>
                                                            <input type="text" class="form-control uang">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td> 
                                                <div class="form-group">
                                                        <div class="input-group">
                                                            <div class="input-group-addon">Rp.</div>
                                                            <input type="text" class="form-control uang" disabled>
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
                                                            <input type="text" class="form-control uang">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td> 
                                                <div class="form-group">
                                                        <div class="input-group">
                                                            <div class="input-group-addon">Rp.</div>
                                                            <input type="text" class="form-control uang">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td> 
                                                <div class="form-group">
                                                        <div class="input-group">
                                                            <div class="input-group-addon">Rp.</div>
                                                            <input type="text" class="form-control uang" disabled>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>


                                            <tr>
                                                <td>Kewajiban Jangka Pangjang</td>
                                                <td>
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                            <div class="input-group-addon">Rp.</div>
                                                            <input type="text" class="form-control uang">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td> 
                                                <div class="form-group">
                                                        <div class="input-group">
                                                            <div class="input-group-addon">Rp.</div>
                                                            <input type="text" class="form-control uang">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td> 
                                                <div class="form-group">
                                                        <div class="input-group">
                                                            <div class="input-group-addon">Rp.</div>
                                                            <input type="text" class="form-control uang" disabled>
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
                                                            <input type="text" class="form-control uang" disabled>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td> 
                                                <div class="form-group">
                                                        <div class="input-group">
                                                            <div class="input-group-addon">Rp.</div>
                                                            <input type="text" class="form-control uang" disabled>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td> 
                                                <div class="form-group">
                                                        <div class="input-group">
                                                            <div class="input-group-addon">Rp.</div>
                                                            <input type="text" class="form-control uang" disabled>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td><b>Total Kewajiban dan Ekuitas (h) = (f + g )</b></td>
                                                <td>
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                            <div class="input-group-addon">Rp.</div>
                                                            <input type="text" class="form-control uang" disabled>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td> 
                                                <div class="form-group">
                                                        <div class="input-group">
                                                            <div class="input-group-addon">Rp.</div>
                                                            <input type="text" class="form-control uang" disabled>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td> 
                                                <div class="form-group">
                                                        <div class="input-group">
                                                            <div class="input-group-addon">Rp.</div>
                                                            <input type="text" class="form-control uang" disabled>
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
                                            <input type="date" name="" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <hr>
                                <div class="col-md-6 b-r" style="padding-top:40px;">
                                    <div class="row">
                                    <h3 class="box-title text-success text-center">Pihak dari BPAKD</h3>
                                
                                <div class="col-md-12 p-t-10">
                                    <div class="form-group">
                                        <label class="col-sm-12">Kepala Bidang Akutansi BPKAD</label>
                                        <div class="col-sm-12">
                                            <select class="form-control select2">
                                                <?php 
                                                    foreach($pegawai_bpkad as $p){
                                                        echo '<option value="">'.$p->nama_lengkap.'</option>';
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12  p-t-10">
                                    <div class="form-group">
                                        <label class="col-sm-12">Kasubid Pelaporan Bidang Akuntasi BPKAD</label>
                                        <div class="col-sm-12">
                                        <select class="form-control select2">
                                                <?php 
                                                    foreach($pegawai_bpkad as $p){
                                                        echo '<option value="">'.$p->nama_lengkap.'</option>';
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12  p-t-10">
                                    <div class="form-group">
                                        <label class="col-sm-12">Kasubid Pelaporan Bidang Akuntasi BPKAD</label>
                                        <div class="col-sm-12">
                                        <select class="form-control select2">
                                                <?php 
                                                    foreach($pegawai_bpkad as $p){
                                                        echo '<option value="">'.$p->nama_lengkap.'</option>';
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
                                        <select class="form-control select2">
                                                <?php 
                                                    foreach($pegawai_bpkad as $p){
                                                        echo '<option value="">'.$p->nama_lengkap.'</option>';
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                    </div>
                                </div>
                                



                                <div class="col-md-6 b-r" style="padding-top:40px;">
                                    <div class="row">
                                    <h3 class="box-title text-success text-center">Pihak dari Sekretariat Daerah</h3>
                                
                                <div class="col-md-12 p-t-10">
                                    <div class="form-group">
                                        <label class="col-sm-12">Kepala  </label>
                                        <div class="col-sm-12">
                                        <select class="form-control select2">
                                                <?php 
                                                    foreach($pegawai_setda as $p){
                                                        echo '<option value="">'.$p->nama_lengkap.'</option>';
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12  p-t-10">
                                    <div class="form-group">
                                        <label class="col-sm-12">Pejabat Penatausahaan Keuangan</label>
                                        <div class="col-sm-12">
                                        <select class="form-control select2">
                                                <?php 
                                                    foreach($pegawai_setda as $p){
                                                        echo '<option value="">'.$p->nama_lengkap.'</option>';
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12  p-t-10">
                                    <div class="form-group">
                                        <label class="col-sm-12">Pengelola Pemanfaatan BMD</label>
                                        <div class="col-sm-12">
                                        <select class="form-control select2">
                                                <?php 
                                                    foreach($pegawai_setda as $p){
                                                        echo '<option value="">'.$p->nama_lengkap.'</option>';
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12  p-t-10">
                                    <div class="form-group">
                                        <label class="col-sm-12">Petugas Akutansi</label>
                                        <div class="col-sm-12">
                                        <select class="form-control select2">
                                                <?php 
                                                    foreach($pegawai_setda as $p){
                                                        echo '<option value="">'.$p->nama_lengkap.'</option>';
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                    </div>
                                </div>



                                <hr>

                            </div>

                        </div>
                        <!-- akhir tab penandatangan -->
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
            onFinish: function() {
                window.location = "<?=base_url();?>keuangan/neraca/detail";
            }
        });
        $('#exampleBasic2').wizard({
            onFinish: function() {
                window.location = "<?=base_url();?>keuangan/neraca/detail";
            }
        });
        $('#exampleValidator').wizard({
            onInit: function() {
                $('#validation').formValidation({
                    framework: 'bootstrap',
                    fields: {
                        username: {
                            validators: {
                                notEmpty: {
                                    message: 'The username is required'
                                },
                                stringLength: {
                                    min: 6,
                                    max: 30,
                                    message: 'The username must be more than 6 and less than 30 characters long'
                                },
                                regexp: {
                                    regexp: /^[a-zA-Z0-9_\.]+$/,
                                    message: 'The username can only consist of alphabetical, number, dot and underscore'
                                }
                            }
                        },
                        email: {
                            validators: {
                                notEmpty: {
                                    message: 'The email address is required'
                                },
                                emailAddress: {
                                    message: 'The input is not a valid email address'
                                }
                            }
                        },
                        password: {
                            validators: {
                                notEmpty: {
                                    message: 'The password is required'
                                },
                                different: {
                                    field: 'username',
                                    message: 'The password cannot be the same as username'
                                }
                            }
                        }
                    }
                });
            },
            validator: function() {
                var fv = $('#validation').data('formValidation');
                var $this = $(this);
                // Validate the container
                fv.validateContainer($this);
                var isValidStep = fv.isValidContainer($this);
                if (isValidStep === false || isValidStep === null) {
                    return false;
                }
                return true;
            },
            onFinish: function() {
                $('#validation').submit();
                alert('finish');
            }
        });
        $('#accordion').wizard({
            step: '[data-toggle="collapse"]',
            buttonsAppendTo: '.panel-collapse',
            templates: {
                buttons: function() {
                    var options = this.options;
                    return '<div class="panel-footer"><ul class="pager">' + '<li class="previous">' + '<a href="#' + this.id + '" data-wizard="back" role="button">' + options.buttonLabels.back + '</a>' + '</li>' + '<li class="next">' + '<a href="#' + this.id + '" data-wizard="next" role="button">' + options.buttonLabels.next + '</a>' + '<a href="#' + this.id + '" data-wizard="finish" role="button">' + options.buttonLabels.finish + '</a>' + '</li>' + '</ul></div>';
                }
            },
            onBeforeShow: function(step) {
                step.$pane.collapse('show');
            },
            onBeforeHide: function(step) {
                step.$pane.collapse('hide');
            },
            onFinish: function() {
                alert('finish');
            }
        });
    })();
</script>

<script src="<?= base_url(); ?>/asset/pixel/plugins/bower_components/mask/jquery.mask.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {

        // Format mata uang.
        $('.uang').mask('000.000.000', {
            reverse: true
        });

    })
</script>