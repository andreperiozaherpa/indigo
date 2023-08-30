<div class="container-fluid">

	<div class="row bg-title">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title">Status Seleksi Calon Talent</h4> </div>
			<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
				<ol class="breadcrumb">
					<?php echo breadcrumb($this->uri->segment_array()); ?>
				</ol>
			</div>
			<!-- /.col-lg-12 -->
		</div>


     <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <?php 
                for($i=1;$i<=1;$i++){
            ?>
            <div class="col-md-12">
                <div style="background-color: #00c292;padding:5px;color: #fff;text-align: center;font-weight: 600;font-size: 15px"><i class="ti-check"></i> Anda lolos pada seleksi ini, silahkan upload hasil uji kompetensi anda</div>
                <div class="white-box">
                    <div class="row">
                        <span class="pull-right label label-primary">1 - 30 Januari 2020</span>
                        <h5><b>Kepala Bagian Keuangan</b></h5>
                        <h5><small><i style="color: #6003c8" class="ti-pulse fa-fw"></i> Eselon II</small></h5>
                        <h5><small><i style="color: #6003c8" class="ti-briefcase fa-fw"></i> Bagian Keuangan</small></h5>
                        <h5><small><i style="color: #6003c8" data-icon="&#xe030;" class="linea-icon linea-aerrow fa-fw"></i> Sekretariat Daerah</small></h5>
                    </div>
                    <div class="row">
                        <a href="javascript:void(0)" data-toggle="modal" data-target="#myModal" class="btn btn-xs btn-primary btn-outline">Lihat Persyaratan</a>
                        <a href="javascript:void(0)" data-toggle="modal" data-target="#ujiKom" class="btn btn-xs btn-primary">Input Nilai SKP</a>
                        <span class="pull-right">
                            <b>Status</b><br>
                            <span class="label label-success">Lolos</span>
                        </span>
                    </div>
                </div>
            </div>
        <?php } ?>
        </div>
    </div>


    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">

            <div class="row">
                <div class="col-md-12 pager">
                    <a href="?page=1" class="btn btn-primary disabled">1</a> <a href="?page=2" class="btn btn-primary ">2</a> <a href="?page=3" class="btn btn-primary ">3</a> <a href="?page=4" class="btn btn-primary ">4</a> <a href="?page=2" class="btn btn-primary">Selanjutnya</a> <a href="?page=52" class="btn btn-primary">Akhir</a>                      </div>
                </div>

            </div>

        </div>
    </div>

    <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="myModalLabel">Persyaratan</h4> </div>
                    <div class="modal-body">

                        <ul>
                            <?php
                            $persyaratan = array('Memiliki pangkat serendah-rendahnya Pembina Tk. I (IV/b)','Jabatan Administrator paling singkat 4 tahun','Jabatan Fungsional jenjang Ahli Madya paling singkat 4 tahun','Jabatan Pimpinan Tinggi Pratama atau jabatan yang disetarakan dengan jabatan struktural eselon II.a','Usia paling tinggi 56 tahun pada saat pendaftaran, kecuali bagi pelamar yang sedang menduduki Jabatan Pimpinan Tinggi Pratama atau jabatan yang disetarakan dengan jabatan struktural eselon II.a dan Jabatan Fungsional Jenjang Ahli Madya.','Berpendidikan paling rendah sarjana (S1) sesuai bidang yang diminatinya, diutamakan pelamar dengan latar belakang pendidikan magister/pascasarjana (S2).');
                            foreach($persyaratan as $p){
                                ?>
                                <li><?=$p?></li>
                            <?php } ?>
                        </ul>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary waves-effect" data-dismiss="modal">Close</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
  <div id="ujiKom" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="myModalLabel">Input Nilai SKP</h4> </div>
                    <div class="modal-body">
                        <form method="POST">
                            <div class="form-group">
                                <label>Nilai SKP</label>
                                <input type="text" class="form-control" placeholder="Masukkan Nilai SKP" name="">
                            </div>
                            <div class="form-group">
                                <label>Scan Nilai SKP</label>
                                <input type="file" class="dropify" name="">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary waves-effect" data-dismiss="modal">Simpan</button>
                        <button type="button" class="btn btn-primary btn-outline waves-effect" data-dismiss="modal">Tutup</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <div id="myModalc" class="modal fade" tabindex="" index="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title" id="myModalLabel">Konfirmasi</h4> </div>
                        <div class="modal-body">
                            <p>Apakah anda yakin akan ikut serta dalam seleksi calon talent?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary waves-effect" data-dismiss="modal">Ya</button>
                            <button type="button" class="btn btn-primary btn-outline waves-effect" data-dismiss="modal">Tidak</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>