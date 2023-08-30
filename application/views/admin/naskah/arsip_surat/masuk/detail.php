  <?php
  $jenis_surat = 'surat_'.$detail->jenis_surat;
  if($detail->status_arsip=='Sudah Diarsipkan'){
    $color1 = "success";
    $color2 = "#00c292";
    $icon = "ti-archive";
    $icon2 = "icon-check";

  }elseif($detail->status_arsip=="Belum Diarsipkan"){
    $color1 = "danger";
    $color2 = "#F75B36";
    $icon = "ti-archive";
    $icon2 = "icon-close";

  }elseif($detail->status_arsip=="Perlu Tanggapan"){
    $color1 = "warning";
    $color2 = "#f8c255";
    $icon = "icon-clock";
    $icon2 = "icon-info";
  }
  ?>      <div class="container-fluid">

   <div class="row bg-title">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
     <h4 class="page-title">Arsip <?=normal_string($jenis_surat)?></h4> </div>
     <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
      <ol class="breadcrumb">
        <?=breadcrumb($this->uri->segment_array()) ?>   
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
    <a href="<?=base_url('arsip_surat')?>" class="pull-right btn btn-primary btn-outline"><i class="ti-back-left"></i> Kembali</a><br><br>
  </div>
  <div class="col-md-3">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_content">
          <div class="col-md-12 col-sm-6" >
            <div class="panel panel-primary">
              <div class="panel-body" style="border-top: solid 5px #6003C8">
                <div class="row b-b">
                  <div class="text-center">
                    <p>
                      <i style="font-size: 70px;" class="text-<?=$color1?> <?=$icon?>"></i>
                    </p>
                    <p>
                      <span class="text-<?=$color1?>">
                        <i style="background-color: <?=$color2?>;border-radius: 50%;color: #fff;padding: 5px;" class="<?=$icon2?>"></i> <?=$detail->status_arsip?>
                      </span>
                    </p>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12 text-center">
                    <h6 style="font-weight: 500">Pengirim</h6>
                    <h5><?=$detail->pengirim?></h5>
                    <span class="badge" style="background-color: grey;font-size:10px;"><?=tanggal($detail->tanggal_surat)?></span>
                  </div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-md-12 text-center">
                    <h6 style="font-weight: 500">Penerima</h6>
                    <h5><?=$detail->nama_lengkap_penerima?></h5>
                    <span class="badge" style="background-color: grey;font-size:10px;"><?=tanggal($detail->tgl_input)?></span>
                  </div>
                </div>
                <hr>
                <a href="<?=base_url()?>/data/<?=$jenis_surat?>/surat_masuk/<?=$detail->file_surat?>" class="btn btn-primary btn-block btn-outline"><i class="ti-download"></i> Download Surat</a>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_content">
                <div class="col-md-12 col-sm-6">
                  <div class="panel panel-primary">
                    <div class="panel-heading text-center">
                      Log surat
                    </div>
                    <div class="panel-wrapper collapse in" aria-expanded="true">
                      <div class="panel-body">
                        <div class="steamline">
                          <div class="sl-item">
                            <div class="sl-left"><button type="button" class="btn btn-primary btn-circle  "></button></div>
                            <div class="sl-right">
                              <div class="m-l-20"><b>Dibuat / Dikirim</b>
                                <p><?=$detail->pengirim?></p>
                                <h6><i><?=tanggal($detail->tanggal_surat)?></i></h6>
                              </div>
                            </div>
                          </div>
                          <hr>

                          <div class="sl-item">
                            <div class="sl-left"><button type="button" class="btn btn-primary btn-circle  "></button></div>
                            <div class="sl-right">
                              <div class="m-l-20"><b>Didistribusikan</b>
                                <p><?=$detail->nama_lengkap_input?> - <?=$detail->jabatan_input?></p>
                                <h6><i><?=tanggal($detail->tgl_input)?></i></h6>
                              </div>
                            </div>
                          </div>
                          <hr>
                          <?php if ($detail->tgl_dibaca): ?>
                            <div class="sl-item">
                              <div class="sl-left"><button type="button" class="btn btn-primary btn-circle  "></button></div>
                              <div class="sl-right">
                                <div class="m-l-20"><b>Dibaca</b>
                                  <p><?=$detail->nama_lengkap_penerima?> - <?=$detail->jabatan_penerima?></p>
                                  <h6><i><?=tanggal($detail->tgl_dibaca)?></i></h6>
                                </div>
                              </div>
                            </div>
                            <hr>
                          <?php endif ?>
                          <?php $array_disposisi = array(); $array_disposisi_user = array(); if ($disposisi): ?>
                          <div class="sl-item">
                            <div class="sl-left"><button type="button" class="btn btn-primary btn-circle  "></button></div>
                            <div class="sl-right">
                              <div class="m-l-20"><b>Disposisi</b>
                                <?php $n=1; foreach ($disposisi as $d): 
                                $color = "";
                                if ($d->jenis_penerima_disposisi == "internal") {
                                  if ($d->id_pegawai>0) {
                                    $array_disposisi[] = $d->id_unit_kerja.'-'.$d->id_pegawai;
                                    $array_disposisi_user[] = $d->id_pegawai_disposisi.'-'.$d->id_unit_kerja.'-'.$d->id_pegawai;
                                    $penerima_disposisi = $d->nama_lengkap;
                                    if ($d->id_pegawai == $this->session->userdata('id_pegawai')) $color = "color : #6003C8;";
                                  } else {
                                    $array_disposisi[] = $d->id_unit_kerja.'-';
                                    $array_disposisi_user[] = $d->id_pegawai_disposisi.'-'.$d->id_unit_kerja.'-';
                                    $penerima_disposisi = $d->nama_unit_kerja;
                                    if ($d->id_unit_kerja == $this->session->userdata('id_unit_kerja')) $color = "color : #6003C8;";
                                  }
                                } else {
                                  $array_disposisi[] = $d->id_skpd;
                                  $array_disposisi_user[] = $d->id_pegawai_disposisi.'-'.$d->id_skpd;
                                  $penerima_disposisi = $d->nama_skpd;
                                  if ($d->id_skpd == $this->session->userdata('id_skpd') AND $this->session->userdata('kepala_skpd')=='Y') $color = "color : #6003C8;";
                                }
                                ?>
                                <p style="<?=$color?>"><b><?=(count($disposisi)>1)? "{$n}. {$penerima_disposisi}": "{$penerima_disposisi}";?></b></p>
                                <p><?php
                                $in = $d->instruksi;
                                $instruksi = explode(";", $in);
                                foreach($instruksi as $i){
                                  echo "- $i <br>";
                                }
                                ?></p>
                                <h6><i> <?=($d->tgl_terima)?tanggal($d->tgl_terima):""?></i></h6>
                                <?php $n++; endforeach ?>
                              </div>
                            </div>
                          </div>
                          <hr>
                        <?php endif ?>

                      </div>

                    </div>
                  </div>
                </div>

              </div>
              <!-- /.col -->
            </div>

          </div>
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

          <h3 style="color: #6003C8" class="box-title"><span style="color: #222">PERIHAL : </span> <?=$detail->perihal?></h3>

          <br>
          <div class="col-md-6">
            <table class="table b-b">
              <tr><td style="width: 100px;">No Surat </td><td>:</td><td> <strong><?=($detail->jenis_surat=='internal') ? $detail->nomer_surat : $detail->indeks.'/'.$detail->kode.'/'.$detail->no_urut?> </strong></tr>
                <tr><td style="width: 100px;">Sifat</td><td>:</td><td> <strong><?=humanize($detail->sifat)?></strong></tr>
                </table>
              </div>                    <!--/span-->
              <div class="col-md-6">
                <table class="table b-b">
                  <tr><td style="width: 100px;">Catatan </td><td>:</td><td> <strong><?=empty($detail->catatan) ? '-' : $detail->catatan?> </strong></tr>
                    <tr><td style="width: 100px;">Ringkasan </td><td>:</td><td> <strong><?=empty($detail->isi_ringkasan) ? '-' : $detail->isi_ringkasan?> </strong></tr>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="panel panel-default">
              <div class="panel-body">
                <div class="alert alert-danger">
                  <i class="ti-info"></i> Dokumen dibawah ini hanya versi preview (pratinjau), untuk melihat dokumen asli silahkan download surat ini.
                </div>
                <iframe src="https://docs.google.com/viewer?url=<?=base_url()?>/data/<?=$jenis_surat?>/surat_masuk/<?=$detail->file_surat?>&embedded=true" width="100%"
                  height="700"
                  style="border: none;"></iframe>
                </div>
                <div class="panel-footer">
                              <a href="#" class="btn btn-info" align="right">Download Surat</a>
            <a href="#" data-toggle="modal" data-target="#arsipkanSurat" class="btn btn-primary" align="right">Arsipkan Surat</a>
          </div>
              </div>
              <span style="background-color: #fff;padding: 10px;font-weight: 500;border-left: solid 3px #6003C8;margin-bottom: 10px;">Lampiran</span>
              <br>
              <br>
              <?php 
              if(!empty($detail->lampiran)&&$detail->lampiran!=="-"){?>
                <div class="row">
                  <div class="col-md-2">
                    <div class="panel panel-default text-center">
                      <div class="panel-body">
                        <i class="ti-file" style="font-size:60px;" ></i>
                        <p style="word-wrap: break-word;margin: 10px 0px"><?=$detail->lampiran?></p>
                        <a href="<?=base_url()?>/data/<?=$jenis_surat?>/lampiran/<?=$detail->lampiran?>" class="btn btn-primary btn-block"><i class="ti-download"></i> Download</a>
                      </div></div>
                    </div>
                  </div>
                <?php }else{
                  echo "Tidak ada lampiran";
                } ?>


              </div>
            </div>




   <div class="modal fade bs-example-modal-lg" id="arsipkanSurat" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header" style="background-color:#6003C8">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h4 class="modal-title text-white" id="myLargeModalLabel">Arsipkan Surat</h4>
                        </div>
                        <div class="modal-body">
                           <form method="POST">
                            <div class="form-body">
                             <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Kode</label>
                                        <input type="text" name="kode" class="form-control" placeholder="Isi">
                                    </div>
                                </div>
                                  <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Indeks</label>
                                        <input type="text" name="indeks" class="form-control" placeholder="Isi">
                                    </div>
                                </div>
                                  <div class="col-md-4">
                                    <div class="form-group">
                                        <label>No Urut</label>
                                        <input type="text" name="no_urut" class="form-control" placeholder="Isi">
                                    </div>
                                </div>
                            </div>
                              <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Lokasi Box</label>
                                        <input type="text" name="lokasi_smpl" class="form-control" placeholder="Isi">
                                    </div>
                                </div>
                                  <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Lokasi SMPL</label>
                                        <input type="text" name="lokasi_box" class="form-control" placeholder="Isi">
                                    </div>
                                </div>
                                  <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Lokasi Rak</label>
                                        <input type="text" name="lokasi_rak" class="form-control" placeholder="Isi">
                                    </div>
                                </div>
                            </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary waves-effect text-left">Simpan</button>
                           </form>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>

            <script type="text/javascript">

              function toggleInstruksi(){
                var checked = $('#cbInstruksi').prop('checked');
                if(checked){
                  $('#frmInstruksi').removeAttr('disabled');
                  $('#frmInstruksi').show();
                }else{
                  $('#frmInstruksi').attr('disabled','disabled');
                  $('#frmInstruksi').hide();
                }
              }

            </script>

          