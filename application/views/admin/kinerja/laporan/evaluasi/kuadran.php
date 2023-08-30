<div class="container-fluid">

    <div class="row bg-title">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <h4 class="page-title">Hasil Evaluasi Kinerja Pegawai [SKP Tahun <?=$detail->tahun_desc;?> <?= ($triwulan) ? "TRIWULAN KE-".$triwulan: "";?>]</h4>
        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <ol class="breadcrumb">
                <li><?=$this->Config->app_name;?></li>
                <li>Laporan</li>
                <li>Evaluasi Kinerja</li>
                <li class="active">Kuadran</li>
            </ol>
        </div>
        <!-- /.col-lg-12 -->
    </div>


    <div class="row">

       

        <div class="col-md-12">
            <div class="white-box" style="min-height:380px">
                <div class="row">
                    <div class="col-md-4">
                        
                        <h3 class="box-title m-t-5">Kuadran</h3>
                        
                        <table style="width:450px;" class="table_ table-bordered ">
                            <tr align="center" valign="center">
                                <td rowspan="3" style="writing-mode: tb-rl;transform: rotate(-180deg);width:50px"><b>HASIL KINERJA</b></td>
                                <td width="100px" style=""><b>Diatas<br>Ekspektasi<b></td>
                                <td width="100px" style="background-color:#b0cc8d;color:black; width:100px; height:100px;"><b><?= ($box==7) ? "Kurang / Misconduct" : "" ;?></b></td>
                                <td width="100px" style="background-color:#fcb503;color:black;width:100px; height:100px;"><b><?= ($box==8) ? "Baik" : "" ;?></b></td>
                                <td width="100px" style="background-color:#c72d0e;color:white;width:100px; height:100px;"><b><?= ($box==9) ? "Sangat Baik" : "" ;?></b></td>
                            </tr>
                            <tr align="center">
                                <td width="100px" style=""><b>Sesuai<br>Ekspektasi<b></td>
                                <td width="100px" style="background-color:#b0cc8d;color:black; width:100px; height:100px;"><b><?= ($box==4) ? "Kurang / Misconduct" : "" ;?></b></td>
                                <td width="100px" style="background-color:#fcb503;color:black;width:100px; height:100px;"><b><?= ($box==5) ? "Baik" : "" ;?></b></td>
                                <td width="100px" style="background-color:#fcb503;color:black;width:100px; height:100px;"><b><?= ($box==6) ? "Baik" : "" ;?></b></td>
                            </tr>
                            <tr align="center">
                                <td width="100px" style=""><b>Dibawah<br>Ekspektasi<b></td>
                                <td width="100px" style="background-color:#cfd6e3;color:black; width:100px; height:100px;"><b><?= ($box==1) ? "Sangat Kurang" : "" ;?></b></td>
                                <td width="100px" style="background-color:#f0d784;color:black;width:100px; height:100px;"><b><?= ($box==2) ? "Butuh Perbaikan" : "" ;?></b></td>
                                <td width="100px" style="background-color:#f0d784;color:black;width:100px; height:100px;"><b><?= ($box==3) ? "Butuh Perbaikan" : "" ;?></b></td>
                            </tr>
                            <tr align="center">
                                <td colspan="2" rowspan="2"></td>
                                <td width="100px" style="height:100px"><b>Dibawah<br>Ekspektasi<b></td>
                                <td width="100px" style="height:100px"><b>Sesuai<br>Ekspektasi<b></td>
                                <td width="100px" style="height:100px"><b>Diatas<br>Ekspektasi<b></td>
                            </tr>
                            <tr>
                                <td colspan="3" align="center" style="height:50px"><b>PERILAKU</b></td>
                            </tr>
                        </table>

                    </div>
                    <div class="col-md-8">
                        <h3 class="box-title m-t-5">Detail Pegawai</h3>
                        <table width="100%" class="table">
                            <thead>
                                <tr valign="top"><td width="30%">Nama</td><td width="1%">:</td><td><?=$detail->nama_lengkap;?></td></tr>
                                <tr valign="top"><td>NIP</td><td>:</td><td><?=$detail->nip;?></td></tr>
                                <tr valign="top"><td>Pangkat/Gol</td><td>:</td><td><?=$detail->pangkat;?></td></tr>
                                <tr valign="top"><td>Jabatan</td><td>:</td><td><?=$detail->jabatan;?></td></tr>
                                <tr valign="top"><td>Unit Kerja</td><td>:</td><td><?=$detail->nama_unit_kerja;?></td></tr>
                            </thead>
                        </table>
                    </div>
                </div>

            </div>
        </div>
        

        

    </div>

</div>
