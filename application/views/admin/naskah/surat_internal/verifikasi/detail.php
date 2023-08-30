<?php 
if($detail->status_verifikasi=='sudah_diverifikasi'){
  $color1 = "success";
  $color2 = "#00c292";
  $icon = 'icon-check';
  $icon2 = "icon-check";

}elseif($detail->status_verifikasi=="ditolak"){
  $color1 = "danger";
  $color2 = "#F75B36";
  $icon = "icon-close";
  $icon2 = "icon-close";

}elseif($detail->status_verifikasi=="menunggu_verifikasi"){
  $color1 = "warning";
  $color2 = "#f8c255";
  $icon = "icon-clock";
  $icon2 = "icon-info";
}
?>
<div class="container-fluid">

  <div class="row bg-title">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
      <h4 class="page-title">Verifikasi Surat Internal</h4> </div>
      <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
        <ol class="breadcrumb">
          <li class="active">Detail</li>        </ol>
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
  <a href="<?=base_url('surat_internal/verifikasi_surat')?>" class="pull-right btn btn-primary btn-outline"><i class="ti-back-left"></i> Kembali</a><br><br>
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
                        <i style="background-color: <?=$color2?>;border-radius: 50%;color: #fff;padding: 5px;" class="<?=$icon2?>"></i> <?=normal_string($detail->status_verifikasi)?>
                      </span>
                      </p>
                    </div>
                  </div>
                    <div class="row">
                      <div class="col-md-12 text-center">
                        <h6>Pengirim</h6>
                        <h5> <?=$detail->nama_skpd?></h5>
                        <span class="badge" style="background-color: grey;font-size:10px;"><?=tanggal($detail->tgl_buat)?></span>
                      </div>
                    </div>
                    <hr>
                    <div class="row">
                      <div class="col-md-12 text-center">
                        <h6>Penerima</h6>
                        <?php
                        foreach($penerima as $p){
                          ?>
                          <div style="margin-bottom:10px;border: solid 1px #cdcdcd;text-align: left !important;padding:4px">
                            <small style="display: block"><i style="color: #5D03C1" class="ti-user"></i> <?=$p->nama_lengkap?></small>
                            <small style="display: block"><i style="color: #5D03C1" class="ti-bar-chart"></i> <?=($p->id_unit_kerja>0)?$p->nama_jabatan:"Kepala SKPD"?></small>
                          </div>
                        <?php } ?>
                        <span class="badge" style="background-color: grey;font-size:10px;"><?=tanggal($detail->tgl_surat)?></span>
                        <hr>  
                                       <?php 
                  if(!empty($tembusan)){
                    ?>
                  <h6 style="font-weight: 500;text-align: center;">Tembusan</h6>
                <?php } ?>

                  <?php 
                  foreach($tembusan as $p){
                    ?>
                    <div style="margin-bottom:10px;border: solid 1px #cdcdcd;text-align: left !important;padding:4px;position: relative;">
                      <small style="display: block"><i style="color: #5D03C1" class="ti-user"></i> <?=$p->nama_lengkap?></small>
                      <small style="display: block"><i style="color: #5D03C1" class="ti-bar-chart"></i> <?=$p->jabatan?></small>
                    </div>
                    <?php
                  } ?>
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
                    <a target="blank" href="<?=base_url('data/surat_internal/lampiran/'.$detail->file_lampiran.'')?>" style="color: #fff" class="btn btn-primary btn-block"><i class="ti-cloud-down"></i> Download Lampiran</a>
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
            <div class="panel panel-primary">
          <div class="panel-body" style="border-top: solid 5px #6003C8">
           <h3 style="color: #6003C8" class="box-title"><?=$detail->nama_surat?></h3>
           <br>
           <div class="col-md-6">
            <table class="table b-b">
              <tr><td style="width: 100px;">No Surat </td><td>:</td><td> <strong><?=$detail->nomer_surat?></strong></tr>
                <tr><td style="width: 100px;">Perihal </td><td>:</td><td> <strong><?=$detail->perihal?></strong></tr>
                </table>
              </div>                    <!--/span-->
              <div class="col-md-6">
                <table class="table b-b">
                  <tr><td style="width: 200px">Nomor Registrasi Sistem</td><td>:</td><td> <strong><?=ucwords($detail->hash_id)?></strong></tr>
                    <tr><td>Sifat</td><td>:</td><td> <strong><?=ucwords($detail->sifat_surat)?></strong></tr>
                    </table>
                  </div>
                </div>
            </div>
          </div>
          <div class="row">
            <div class="panel panel-default">
                      <?php 
                        if($detail->status_ttd=="sudah_ditandatangani"){
                            $viewer = "https://docs.google.com/viewer?url=".base_url('data/surat_internal/ttd/'.$detail->file_ttd.'');
                            $m_icon = "ti-check";
                            $m_alert = "success";
                            $m_text = "Surat yang Anda verifikasi telah selesai ditandatangani dan sudah diteruskan ke penerima.";
                        }else{
                            $viewer = "https://view.officeapps.live.com/op/embed.aspx?src=".base_url('data/surat_internal/keluar/'.$detail->file_draft_surat.'');
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
                <div class="panel-footer">
                  <form method="POST">

                    <?php 
                    if($detail->status_verifikasi=='sudah_diverifikasi' OR $detail->id_pegawai_verifikasi!=$this->session->userdata('id_pegawai')){
                      ?>
                      <button class="btn btn-primary" type="button" disabled><span class="btn-label"><i class="ti-check"></i></span> Verifikasi</button>
                      <button class="btn btn-success" type="button" disabled data-toggle="modal" data-target="#mdverifikasi"><span class="btn-label"><i class="ti-shift-right"></i></span>Teruskan</button>
                      <button class="btn btn-default btn-outline" type="button" disabled><span class="btn-label"><i class="ti-back-left"></i></span>Tolak</button>
                    <?php }else{
                      ?>
                      <button class="btn btn-primary" type="submit" name="terima"><span class="btn-label"><i class="ti-check"></i></span> Verifikasi</button>
                      <button class="btn btn-success" type="button" data-toggle="modal" data-target="#mdverifikasi"><span class="btn-label"><i class="ti-shift-right"></i></span>Teruskan</button>
                      <button class="btn btn-default btn-outline" type="button" data-toggle="modal" data-target="#mdTolak"><span class="btn-label"><i class="ti-back-left"></i></span>Tolak</button>
                      <?php
                    } ?>

                  </div>
                </form>
              </div>
              <?php if ($detail_verifikasi): ?>
                <div class="white-box">
                  <div class="row" style="margin-bottom: 15px">
                    <span style="float: left">
                      <h5 class="box-title"><i style="color:#fff;background-color: #6003C8;padding: 5px;border-radius: 50%" class="ti-medall"></i> <span style="border-bottom: solid 2px #6003C8">Sudah disetujui juga oleh</span></h5></span>

                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="row">
                          <?php foreach ($detail_verifikasi as $key2 => $row): $row->foto_pegawai = ($row->foto_pegawai=='') ? 'user-default.png' : $row->foto_pegawai;?>
                            <div class="col-md-12 m-t-5" id="selected-disposisi-internal-<?=$key2?>-<?=$row->id_pegawai?>" style="margin-bottom:10px;border: solid 1px #6003c8;text-align: left !important;padding:4px">
                              <div class="col-md-4">
                                <img src="<?=base_url('data/foto/pegawai/'.$row->foto_pegawai)?>" alt="user" class="img-circle img-responsive" style="max-height: 75px;">
                              </div>
                              <div class="col-md-8">
                                <small style="display: block" class="text-purple"> <?=$row->nama_lengkap?> <span class="label label-rouded label-primary"><?=strtoupper($row->jenis_pegawai)?></span></small>
                                <small style="display: block" class="text-muted"> <?=$row->jabatan?></small>
                                <span class="well" style="padding: unset;"><?=$row->tgl_verifikasi?></span>
                              </div>
                            </div> 
                          <?php endforeach ?>
                        </div>
                      </div>
                    </div>


                  </div>
                  
                <?php endif ?>

                <div class="white-box">
                  <div class="row" style="margin-bottom: 15px">
                    <span style="float: left">
                      <?php
                      if($detail->status_verifikasi=='sudah_diverifikasi'){
                        $a_type = 'primary';
                        $icon = 'ti-check';
                        $a_message = '<i class="ti-check"></i> Surat sudah disetujui oleh Anda';
                      }elseif($detail->status_verifikasi=='menunggu_verifikasi'){
                        $a_type = 'warning';
                        $icon = 'ti-time';
                        $a_message = '<i class="ti-time"></i> <span style="font-weight:400">Surat ini memerlukan verifikasi dari Anda </span>, silahkan klik salah satu opsi tombol diatas untuk memverifikasi surat atau anda bisa mengoreksi surat sendiri dengan mengklik tombol Download dibawah lalu koreksi dan Upload kembali. ';
                      }elseif($detail->status_verifikasi=='ditolak'){
                        $a_type = 'danger';
                        $icon = 'ti-close';
                        $a_message = '<i class="ti-close"></i> Surat ditolak';
                      }else{
                        $a_type = 'danger';
                        $icon = 'ti-alert';
                        $detail->status_verifikasi = 'Belum mengupload';
                        $a_message = '<i class="ti-alert"></i> Anda belum meng-upload draf surat, silahkan klik tombol Download dibawah lalu Upload kembali.';
                      }
                      ?>
                      <h5 class="box-title"><i style="color:#fff;background-color: #6003C8;padding: 5px;border-radius: 50%" class="ti-check-box"></i> <span style="border-bottom: solid 2px #6003C8">Verifikasi Surat</span></h5></span>
                      <span style="float: right;text-align: center;margin-top: -10px;">
                        <p style="display: block;margin:2px">Status Verifikasi</p>
                        <i style="position: absolute;z-index: 999;color:#fff;background-color: #6003C8;padding: 6px;border-radius: 50%;margin-top: -2px" class="<?=$icon?>"></i> <span style="position: relative;padding:6px;border :solid 1px #cdcdcd;color:#6003C8 " class="label"><span style="margin-left: 22px"><?=normal_string($detail->status_verifikasi)?></span></span>
                      </span>
                    </div>
                    <div class="alert alert-<?=$a_type?>">
                      <?=$a_message?>
                      <?php
                      if($detail->status_verifikasi=='ditolak'){
                        ?><br>
                        Alasan Penolakan : <?=$detail->alasan_penolakan_verifikasi?>
                        <?php
                      }
                      ?>
                    </div>
                  <?php 

                  if($detail->status_ttd=="sudah_ditandatangani"){
                    ?>
                    <a href="<?=base_url('data/surat_internal/ttd/'.$detail->file_ttd.'')?>" class="btn btn-primary" type="button" ><span class="btn-label"><i class="ti-cloud-down"></i></span> Download Surat Selesai TTD</a>
                    <?php
                  }else{
                    ?>
                    <a href="<?=base_url('data/surat_internal/keluar/'.$detail->file_draft_surat.'')?>" class="btn btn-primary" type="button" ><span class="btn-label"><i class="ti-cloud-down"></i></span> Download Draf Surat</a>
                  <?php 
                  if($detail->status_verifikasi=='sudah_diverifikasi' OR $detail->id_pegawai_verifikasi!=$this->session->userdata('id_pegawai')){
                    ?>
                    <a href="javascript:void(0)" class="btn btn-default btn-outline" type="button" disabled><span class="btn-label"><i class="ti-cloud-up"></i></span> 
                      <?= empty($detail->file_verifikasi)||is_null($detail->file_verifikasi) ? "Upload" : "Upload Ulang"?> Draf Surat</a>
                    <?php }else{
                      ?>
                      <a href="javascript:void(0)" class="btn btn-default btn-outline" type="button"  data-toggle="modal" data-target="#myModal"><span class="btn-label"><i class="ti-cloud-up"></i></span> 
                        <?= empty($detail->file_verifikasi)||is_null($detail->file_verifikasi) ? "Upload" : "Upload Ulang"?> Draf Surat</a>
                        <?php
                      } ?>
                    <?php
                  }
                  ?>

                      </div>

                    </div>
                  </div>

                  <div id="myModal" class="modal fade" role="dialog">
                    <div class="modal-dialog">

                      <!-- Modal content-->
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                          <h4 class="modal-title">Upload Draf Surat</h4>
                        </div>
                        <div class="modal-body">
                          <form method="POST" enctype="multipart/form-data">
                            <label>File Surat (.doc/docx)</label>
                            <input type="file" name="file_verifikasi" class="dropify">
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default btn-rounded" data-dismiss="modal"><i class="ti-close"></i> Tutup</button>
                            <button type="submit" class="btn btn-primary btn-rounded"><i class="ti-cloud-up"></i> Upload</button>
                          </form>
                        </div>
                      </div>

                    </div>
                  </div>

                  <div id="mdTolak" class="modal fade" role="dialog">
                    <div class="modal-dialog">

                      <!-- Modal content-->
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                          <h4 class="modal-title">Tolak Verifikasi Surat</h4>
                        </div>
                        <div class="modal-body">
                          <form method="POST">
                            <div class="form-group">
                              <label>Alasan Penolakan</label>
                              <textarea class="form-control" name="alasan_penolakan_verifikasi" placeholder="Masukkan Alasan Penolakan"></textarea>
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

                  <div id="mdverifikasi" class="modal fade" role="dialog">
                    <div class="modal-dialog">

                      <!-- Modal content-->
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                          <h4 class="modal-title"> Tambah Verifikator</h4>
                        </div>
                        <div class="modal-body">
                          <form method="POST">
                            <div class="form-group">
                              <label class="">Teruskan verifikasi kepada :</label>
                              <select id="id_pegawai" name="id_pegawai_verifikasi_teruskan" class="select2 m-b-10 form-control" data-placeholder="Pilih Verifikator" required>
                                <?php foreach ($unit_kerja as $u): ?>
                                  <optgroup label="<?=$u->nama_unit_kerja?>">
                                    <?php foreach ($pegawai[$u->id_unit_kerja] as $p): ?>
                                      <?php if (!in_array($p->id_pegawai, $array_id_verifikasi) AND $p->id_pegawai != $this->session->userdata('id_pegawai') AND $p->id_pegawai != $detail->id_pegawai_input): ?>
                                      <option value="<?=$p->id_pegawai?>"><?=$p->nama_lengkap?> - <?=$p->jabatan?></option>
                                    <?php endif ?>
                                  <?php endforeach ?>
                                </optgroup>
                              <?php endforeach ?>
                            </select>
                            <input type="hidden" name="id_pegawai_verifikasi" value="<?=$detail->id_pegawai_verifikasi?>">
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                          <button class="btn btn-primary" type="submit" name="teruskan"><span class="btn-label"><i class="ti-shift-right"></i></span>Setujui & Teruskan</button>
                        </form>
                      </div>
                    </div>

                  </div>
                </div>
