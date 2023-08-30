<?php 
if ($detail->jenis_surat=="internal") {
  $jenis_surat = "surat_internal";
} elseif ($detail->jenis_surat=="eksternal") {
  $jenis_surat = "surat_eksternal";
}

if($detail->status_penomoran=='Y'){
  $color1 = "success";
  $color2 = "#00c292";
  $icon = "icon-envelope-open";
  $icon2 = "icon-check";
  $detail->status_penomoran = 'Sudah Diregistrasi';

}elseif($detail->status_penomoran=="N"){
  $color1 = "warning";
  $color2 = "#f8c255";
  $icon = "icon-clock";
  $icon2 = "icon-info";
  $detail->status_penomoran = 'Belum Diregistrasi';
}elseif($detail->status_penomoran=="T"){
    $color1 = "danger";
    $color2 = "#F75B36";
    $icon = "icon-close";
    $icon2 = "ti-close";
    $detail->status_penomoran = 'Ditolak';
}
?>
<div class="container-fluid">

    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Penomoran <?=ucwords(humanize($jenis_surat));?></h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li class="active">Detail</li>
            </ol>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">
        <div class="col-md-12">
            <?php 
            if(isset($message)){
                ?>
                <div class="alert alert-<?=$type?>"><?=$message?></div>
                <?php
            }
            ?>
        </div>
    </div>
    <div class="col-md-12">
        <a href="<?=base_url('penomoran_surat')?>" class="pull-right btn btn-primary btn-outline"><i
            class="ti-back-left"></i> Kembali</a>
            <button onclick="show_monitoring();" data-toggle="modal" data-target="#monitoring"
            class="m-r-10 pull-right btn btn-info"><i class="ti-zoom-in"></i> Monitoring Surat</button>
            <br><br>
        </div>
        <div class="col-md-3">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_content">
                        <div class="col-md-12 col-sm-6">
                            <div class="panel panel-primary">
                                <div class="panel-body" style="border-top: solid 5px #6003C8">
                                    <div class="row b-b">
                                        <div class="text-center">
                                            <p>
                                                <i style="font-size: 70px;" class="text-<?=$color1?> <?=$icon?>"></i>
                                            </p>
                                            <p>
                                                <span class="text-<?=$color1?>">
                                                    <i style="background-color: <?=$color2?>;border-radius: 50%;color: #fff;padding: 5px;"
                                                        class="<?=$icon2?>"></i> <?=$detail->status_penomoran?>
                                                    </span>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12 text-center">
                                                <h6>Pembuat Surat</h6>
                                                <h5> <b><?=$detail->nama_skpd?></b></h5>
                                                <h5><?=$detail->nama_lengkap_input." - ".$detail->nama_unit_kerja_input?></h5>
                                                <span class="badge"
                                                style="background-color: grey;font-size:10px;"><?=tanggal($detail->tgl_buat)?></span>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-12 text-center">
                                                <h6>Penerima</h6>
                                                <?php 
                                                foreach($penerima as $p){
                                                  ?>

                                                  <div
                                                  style="margin-bottom:10px;border: solid 1px #cdcdcd;text-align: left !important;padding:4px">
                                                  <?php
                                                  if($p->jenis_surat=='internal'){
                                                      ?>

                                                      <?php
                                                      ?>
                                                      <small style="display: block"><i style="color: #5D03C1" class="ti-user"></i>
                                                        <?=$p->nama_lengkap?></small>
                                                        <small style="display: block"><i style="color: #5D03C1"
                                                            class="ti-bar-chart"></i> <?=$p->nama_jabatan?></small>
                                                        <?php }elseif($p->jenis_surat=='eksternal'&&$p->jenis_penerima=='skpd'){
                                                          ?>
                                                          <small style="display: block"><i data-icon="&#xe030;" style="color: #5D03C1"
                                                            class="linea-icon linea-aerrow fa-fw"></i>Kepala
                                                            <?=$p->nama_skpd?></small>
                                                            <?php
                                                        }else{
                                                          ?>
                                                          <small style="display: block"><i style="color: #5D03C1"
                                                            class="ti-flag-alt"></i> <?=$p->nama_penerima?></small>
                                                            <small style="display: block"><i style="color: #5D03C1"
                                                                class="ti-location-pin"></i> <?=$p->alamat_penerima?></small>
                                                                <?php
                                                            }
                                                            ?>

                                                        </div>
                                                        <?php
                                                    } ?>
                                                    <center>
                                                        <span class="badge"
                                                        style="background-color: grey;font-size:10px;"><?=tanggal($detail->tgl_surat)?></span>
                                                    </center>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php 
                                    if(!empty($detail->file_lampiran)){?>
                                      <div class="panel panel-primary">
                                        <div class="panel-body">
                                            <h3 style="color: #6003C8">LAMPIRAN SURAT</h3>
                                            <div class="text-center">
                                                <i class="ti-file" style="font-size: 100px"></i>
                                                <p style="margin-top: 10px"><?=$detail->file_lampiran?></p>
                                                <a target="blank" href="<?=base_url('data/'.$jenis_surat.'/lampiran/'.$detail->file_lampiran.'')?>" style="color: #fff" class="btn btn-primary btn-block"><i class="ti-cloud-down"></i> Download Lampiran</a>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-primary">
                            <div class="panel-body" style="border-top: solid 5px #6003C8">
                                <h3 style="color: #6003C8" class="box-title"><?=$detail->nama_surat?></h3>
                                <br>
                                <div class="col-md-6">
                                    <table class="table b-b">
                                        <tr>
                                            <td style="width: 100px;">No Surat </td>
                                            <td>:</td>
                                            <td> <strong><?=$detail->nomer_surat?></strong>
                                            </tr>
                                            <tr>
                                                <td style="width: 100px;">Perihal </td>
                                                <td>:</td>
                                                <td> <strong><?=$detail->perihal?></strong>
                                                </tr>
                                            </table>
                                        </div>
                                        <!--/span-->
                                        <div class="col-md-6">
                                            <table class="table b-b">
                                                <tr>
                                                    <td style="width: 200px">Nomor Registrasi Sistem</td>
                                                    <td>:</td>
                                                    <td> <strong><?=ucwords($detail->hash_id)?></strong>
                                                    </tr>
                                                    <tr>
                                                        <td>Sifat</td>
                                                        <td>:</td>
                                                        <td> <strong><?=ucwords($detail->sifat_surat)?></strong>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="panel panel-default">
                                        <div class="panel-body">

                                          <?php 
                                          if($detail->status_ttd=="sudah_ditandatangani"){
                                            $viewer = "https://docs.google.com/viewer?url=".base_url('data/'.$jenis_surat.'/ttd/'.$detail->file_ttd.'');
                                            $m_icon = "ti-check";
                                            $m_alert = "success";
                                            $m_text = "Surat ini telah selesai ditandatangani dan sudah diteruskan ke penerima.";
                                        }else{
                                            $name =  $detail->file_verifikasi;
                                            $ext = explode('.', $name)[1];
                                            if($ext=="docx"){
                                                $viewer = "https://view.officeapps.live.com/op/embed.aspx?src=".base_url('data/'.$jenis_surat.'/keluar/'.$detail->file_verifikasi.'');
                                            }else{
                                                $viewer = "https://docs.google.com/viewer?url=".base_url('data/'.$jenis_surat.'/draf_pdf/'.$detail->file_verifikasi.'');
                                            }
                                            $m_icon = "ti-info";
                                            $m_alert = "danger";
                                            $m_text = "Dokumen dibawah ini hanya versi preview (pratinjau), untuk melihat dokumen asli silahkan download surat ini.";
                                        }
                                        ?>
                                        <div class="alert alert-<?=$m_alert?>">
                                            <i class="<?=$m_icon?>"></i> <?=$m_text?>
                                        </div>
                                        <iframe src="<?=$viewer?>
                                        &embedded=true" width="100%"
                                        height="700"
                                        style="border: none;"></iframe>
                                    </div>
                                </div>
                                <div class="white-box">
                                    <div class="row" style="margin-bottom: 15px">
                                        <span style="float: left">
                                            <?php 
                                            if($detail->status_penomoran=='Sudah Diregistrasi'){
                                                $a_type = 'primary';
                                                $icon = 'ti-check';
                                                $a_message = '<i class="ti-check"></i> Surat sudah dilakukan penomoran.';
                                            }elseif($detail->status_penomoran=='Ditolak'){
                                                $a_type = 'danger';
                                                $icon = 'ti-alert';
                                                $a_message = '<i class="ti-alert"></i> Surat telah ditolak, dengan alasan : <b>'.$detail->alasan_penolakan_penomoran.'</b>';
                                            }else{
                                                $a_type = 'danger';
                                                $icon = 'ti-alert';
                                                $a_message = '<i class="ti-alert"></i> Surat belum diregistrasi nomor, silahkan klik tombol Download dibawah untuk melakukan proses penomoran surat setelah itu klik tombol Register lalu upload kembali.';
                                            }
                                            ?>
                                            <h5 class="box-title"><i
                                                style="color:#fff;background-color: #6003C8;padding: 5px;border-radius: 50%"
                                                class="ti-check-box"></i> <span style="border-bottom: solid 2px #6003C8">Penomoran
                                                Surat</span></h5></span>
                                                <span style="float: right;text-align: center;margin-top: -10px;">
                                                    <p style="display: block;margin:2px">Status Penomoran</p>
                                                    <i style="position: absolute;z-index: 999;color:#fff;background-color: #6003C8;padding: 6px;border-radius: 50%;margin-top: -2px"
                                                    class="<?=$icon?>"></i> <span
                                                    style="position: relative;padding:6px;border :solid 1px #cdcdcd;color:#6003C8 "
                                                    class="label"><span
                                                    style="margin-left: 22px"><?=normal_string($detail->status_penomoran)?></span></span>
                                                </span>
                                            </div>
                                            <div class="alert alert-<?=$a_type?>">
                                                <?=$a_message?>
                                                </div> <?php 

                                                if($detail->status_ttd=="sudah_ditandatangani"){
                                                    ?>
                                                    <div class="form-group">
                                                        <label>No. Surat</label>
                                                        <p><?=$detail->nomer_surat?></p>
                                                    </div>
                                                    <a href="<?=base_url('data/'.$jenis_surat.'/ttd/'.$detail->file_ttd.'')?>" class="btn btn-primary" type="button" ><span class="btn-label"><i class="ti-cloud-down"></i></span> Download Surat Selesai TTD</a>
                                                    <?php
                                                }else{
                                                    if($detail->status_penomoran=='Sudah Diregistrasi'){
                                                      ?>
                                                      <div class="form-group">
                                                        <label>No. Surat</label>
                                                        <p><?=$detail->nomer_surat?></p>
                                                    </div>
                                                    <a href="javascript:void(0)" data-toggle="modal" data-target="#myModal" class="btn btn-default"
                                                    type="button"><span class="btn-label"><i class="ti-check-box"></i></span> Registrasi Ulang Nomor</a>
                                                    <?php
                                                }else{
                                                  ?>
                                                  <a href="javascript:void(0)" data-toggle="modal" data-target="#myModal" class="btn btn-primary"
                                                  type="button"><span class="btn-label"><i class="ti-check-box"></i></span> Register Nomor</a>
                                              <?php } ?>
                                              <!-- <a href="<?=base_url('data/'.$jenis_surat.'/draf_pdf/'.$detail->file_verifikasi.'')?>" -->
                                                <a href="<?=base_url('penomoran_surat/download/'.$detail->id_surat_keluar)?>"
                                                    class="btn btn-primary" type="button"><span class="btn-label"><i class="ti-cloud-down"></i></span>
                                                Download Surat</a>
                                                <?php 
                                                if($detail->status_penomoran!=='Sudah Diregistrasi'){
                                                  ?>
                                                  <button class="btn btn-default btn-outline" type="button" data-toggle="modal" data-target="#mdTolak"><span class="btn-label"><i class="ti-back-left"></i></span>Kembalikan ke Draf</button>
                                                  <?php 
                                              } } ?>
                                          </div>

                                      </div>
                                  </div>

    <div class="modal fade" id="myModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
<!--                    <h4 class="modal-title">Penomoran Surat</h4>-->
                    <h4 class="modal-title">Registrasi Surat</h4>
                </div>
                <form method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="hidden">
                        <input type="text" class="form-control" name="surat" value="<?= $detail->id_surat_keluar; ?>" required>
                        <input type="text" class="form-control" name="jenis_surat" value="<?= $detail->jenis_surat; ?>" required>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Indeks</label>
                            <input type="text" class="form-control" name="indeks" placeholder="Masukan indeks / kata tangkap" value="<?= (!empty($kartu_kendali)) ? $kartu_kendali->indeks : ""; ?>" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Lembar (opsional)</label>
                            <input type="text" class="form-control" name="lembar" placeholder="Masukkan lembar naskah bila ada" value="<?= (!empty($kartu_kendali)) ? $kartu_kendali->lembar : ""; ?>">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Isi Ringkasan</label>
                            <textarea class="form-control" name="isi_ringkasan" cols="30" rows="5" placeholder="Masukan isi ringkasan naskah" required><?= (!empty($kartu_kendali)) ? $kartu_kendali->isi_ringkasan : ""; ?></textarea>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Catatan (opsional)</label>
                            <textarea class="form-control" name="catatan" placeholder="Masukan catatan bila ada" rows="5"><?= (!empty($kartu_kendali)) ? $kartu_kendali->catatan : ""; ?></textarea>
                        </div>
                        <div class="form-group col-md-12">
                            <label>No. Surat</label>
                            <input type="text" class="form-control" name="nomer_surat" placeholder="Masukkan No. Surat" value="<?=$detail->nomer_surat?>">
                            <input type="hidden" class="form-control" name="jenis_surat" placeholder="Masukkan No. Surat" value="<?=$jenis_surat?>">
                        </div>
                        <!-- <div>
                            <label>Simpan Berkas?</label>
                            <br>
                            <label><input type="radio" name="type" value="tidak_simpan_berkas" checked />Tidak</label>
                            <label><input type="radio" name="type" value="simpan_berkas" />Ya</label>
                        </div>
                        
                        <div class="single select" id="simpan_berkas">
                            <label>Berkas Tersedia?</label>
                            <select>
                                <option>-pilih berkas-</option>
                            </select>
                            <label>Berkas Baru?</label>
                            <br>
                            <label><input type="radio" name="type" value="tidak" checked />Tidak</label>
                            <label><input type="radio" name="type" value="baru" />Ya</label>
                            
                        </div> -->
                        <!-- <div class="team select" id="baru">
                            <div class="col-md-6"> -->
										<!-- <input type="number" name="surat_klasifikasi" id="surat_klasifikasi" required hidden> -->
										<!-- <div class="form-group">
											<label>Nama Berkas</label>
											<input type="text" class="form-control" name="name_file" required placeholder="Masukan Nama Berkas">
										</div>

										<div class="form-group">
											<label>Klasifikasi</label>
											<select name="classification" id="classification" class="form-control" required>
												<option value=""></option>
											</select>
										</div>

										<div class="row m-b-20">
											<div class="col-md-6">
												<label>Retensi Aktif</label>
												<input type="number" class="form-control" name="retention_active" id="retention_active" readonly required placeholder="Diisi berdasarkan Kode Klasifikasi Berkas">
											</div>
											<div class="col-md-6">
												<label>Retensi Inaktif</label>
												<input type="number" class="form-control" name="retention_inactive" id="retention_inactive" readonly required placeholder="Diisi berdasarkan Kode Klasifikasi Berkas">
											</div>
										</div>
										<div class="form-group">
											<label>Nomor Berkas</label>
											<input type="number" class="form-control" name="number_file" id="number_file" required readonly placeholder="Diisi berdasarkan Kode Klasifikasi Berkas">
										</div>

										<div class="form-group">
											<label>Penyusutan Akhir</label>
											<input type="text" class="form-control" name="penyusutan_akhir" id="penyusutan_akhir" required readonly placeholder="Diisi berdasarkan Kode Klasifikasi Berkas">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Lokasi Fisik</label>
											<textarea rows="5" class="form-control" name="location_file" placeholder="Masukan Lokasi Fisik Berkas"></textarea>
										</div>

										<div class="form-group">
											<label>Uraian</label>
											<textarea rows="5" class="form-control" name="description" required placeholder="Masukan uraian/deskripsi berkas"></textarea>
										</div>

										<div class="form-group">
											<label>Kategori Berkas</label>
											<input type="text" class="form-control" name="category" placeholder="Masukan kategori berkas">
										</div>

										<div class="form-check">
											<input class="form-check-input" type="checkbox" name="arsip_vital" value="1" id="arsip_vital">
											<label class="form-check-label" for="arsip_vital">
												Berkas Kategori Arsip Vital
											</label>
										</div>
										<div class="form-check">
											<input class="form-check-input" type="checkbox" name="arsip_terjaga" value="1" id="arsip_terjaga">
											<label class="form-check-label" for="arsip_terjaga">
												Berkas Kategori Arsip Terjaga
											</label>
										</div>

										<div class="form-check">
											<input class="form-check-input" type="checkbox" name="mkb" value="1" id="mkb">
											<label class="form-check-label" for="mkb">
												Berkas Kategori MKB (Memori Kolektif Bangsa)
											</label>
										</div>
									</div>
                        </div> -->

                        <!-- <script type="text/javascript">
                            $("#baru").hide();
                            $("#simpan_berkas").hide();
                            $('input[type="radio"]').click(function () {
                            var inputValue = $(this).attr("value");
                            if (inputValue == "simpan_berkas") {
                                
                                $("#simpan_berkas").show();
                            } else if((inputValue == "baru")){
                                
                                $("#simpan_berkas").show();
                                $("#baru").show();
                            } else{
                                
                                $("#simpan_berkas").hide();
                                $("#baru").hide();
                            }
                            });
                        </script> -->
                        <div class="form-group col-md-12">
                            <label>File Surat (.pdf)</label>
                            <input type="file" name="file_verifikasi" class="dropify">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-rounded" data-dismiss="modal"><i
                                class="ti-close"></i> Tutup</button>
                    <button type="submit" class="btn btn-primary btn-rounded"><i class="ti-check-box"></i> Register
                        Nomor</button>
                </div>
                </form>
            </div>
        </div>
    </div>

<!--    <div id="myModal" class="modal fade" role="dialog">-->
<!--        <div class="modal-dialog modal-lg">-->
<!---->
<!--             Modal content-->
<!--            <div class="modal-content">-->
<!--                <div class="modal-header">-->
<!--                    <button type="button" class="close" data-dismiss="modal">&times;</button>-->
<!--                    <h4 class="modal-title">Penomoran Surat</h4>-->
<!--                </div>-->
<!--                <form method="POST" enctype="multipart/form-data">-->
<!--                    <div class="modal-body">-->
<!--                        <div class="hidden">-->
<!--                            <input type="text" class="form-control" name="surat" value="--><?//= $detail->id_surat_keluar; ?><!--" required>-->
<!--                            <input type="text" class="form-control" name="jenis_surat" value="--><?//= $detail->jenis_surat; ?><!--" required>-->
<!--                        </div>-->
<!--                        <div class="form-row">-->
<!--                            <div class="form-group col-md-6">-->
<!--                                <label>Indeks</label>-->
<!--                                <input type="text" class="form-control" name="indeks" placeholder="Masukan indeks / kata tangkap" required>-->
<!--                            </div>-->
<!--                            <div class="form-group col-md-6">-->
<!--                                <label>Lembar (opsional)</label>-->
<!--                                <input type="text" class="form-control" name="lembar" placeholder="Masukkan lembar naskah bila ada">-->
<!--                            </div>-->
<!--                            <div class="form-group col-md-6">-->
<!--                                <label>Isi Ringkasan</label>-->
<!--                                <textarea class="form-control" name="isi_ringkasan" cols="30" rows="3" placeholder="Masukan isi ringkasan naskah" required></textarea>-->
<!--                            </div>-->
<!--                            <div class="form-group col-md-6">-->
<!--                                <label>Catatan (opsional)</label>-->
<!--                                <textarea class="form-control" name="catatan" placeholder="Masukan catatan bila ada" rows="3"></textarea>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div class="form-row">-->
<!--                            <div class="form-group col-md-12">-->
<!--                                <label>No. Surat</label>-->
<!--                                <input type="text" class="form-control" name="nomer_surat" placeholder="Masukkan No. Surat" value="--><?//=$detail->nomer_surat?><!--">-->
<!--                                <input type="hidden" class="form-control" name="jenis_surat" placeholder="Masukkan No. Surat" value="--><?//=$jenis_surat?><!--">-->
<!--                            </div>-->
<!--                            <div class="form-group col-md-12">-->
<!--                                <label>File Surat (.pdf)</label>-->
<!--                                <input type="file" name="file_verifikasi" class="dropify">-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <div class="modal-footer">-->
<!--                        <button type="button" class="btn btn-default btn-rounded" data-dismiss="modal"><i-->
<!--                                    class="ti-close"></i> Tutup</button>-->
<!--                        <button type="submit" class="btn btn-primary btn-rounded"><i class="ti-check-box"></i> Register-->
<!--                            Nomor</button>-->
<!--                    </div>-->
<!--                </form>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->


                                    <div id="mdTolak" class="modal fade" role="dialog">
                                        <div class="modal-dialog">

                                          <!-- Modal content-->
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                                              <h4 class="modal-title">Tolak Registrasi Surat</h4>
                                          </div>
                                          <div class="modal-body">
                                              <form method="POST">
                                                <div class="form-group">
                                                  <label>Alasan Penolakan</label>
                                                  <textarea class="form-control" name="alasan_penolakan_penomoran" placeholder="Masukkan Alasan Penolakan"></textarea>
                                              </div>
                                          </div>
                                          <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                                            <button class="btn btn-primary" type="submit" name="tolak"><span class="btn-label"><i class="ti-back-left"></i></span>Kembalikan ke Draf</button>
                                        </form>
                                    </div>
                                </div>

                            </div>
                        </div>


                        <div id="monitoring" class="modal fade" role="dialog">
                            <div class="modal-dialog modal-lg">

                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Monitoring Surat</h4>
                                    </div>
                                    <div class="modal-body" id="monitoring-body">
                                        loading..
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default btn-rounded" data-dismiss="modal"><i
                                            class="ti-close"></i> Tutup</button>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <script type="text/javascript">
                                function show_monitoring() {
                                    $.post("<?=base_url('monitoring_surat_keluar/detail/'.$detail->id_surat_keluar)?>", {}, function(obj) {
                                        $('#monitoring-body').html(obj);
                                    });
                                }
                            </script>