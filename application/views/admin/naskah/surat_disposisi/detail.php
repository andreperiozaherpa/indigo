<?php 
if ($detail->jenis_surat == "eksternal") {
  $jenis_surat = "surat_eksternal";
} else {
  $jenis_surat = "surat_internal";
}

if($detail->status_surat=='Sudah Dibaca'){
  $color1 = "success";
  $color2 = "#00c292";
  $icon = "icon-envelope-letter";
  $icon2 = "icon-check";

}elseif($detail->status_surat=="Belum Dibaca"){
  $color1 = "danger";
  $color2 = "#F75B36";
  $icon = "icon-envelope-open";
  $icon2 = "icon-close";

}elseif($detail->status_surat=="Perlu Tanggapan"){
  $color1 = "warning";
  $color2 = "#f8c255";
  $icon = "icon-clock";
  $icon2 = "icon-info";
}
?>
<div class="container-fluid">

	<div class="row bg-title">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title">Surat Disposisi Masuk</h4> </div>
			<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
				<ol class="breadcrumb">

          <?=breadcrumb($this->uri->segment_array()) ?> 				
        </ol>
      </div>
      <!-- /.col-lg-12 -->
    </div>

    <div class="col-md-12">
      <a href="<?=base_url('surat_disposisi/'.$detail->jenis_surat)?>" class="pull-right btn btn-primary btn-outline"><i class="ti-back-left"></i> Kembali</a><br><br>
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
                          <i style="background-color: <?=$color2?>;border-radius: 50%;color: #fff;padding: 5px;" class="<?=$icon2?>"></i> <?=$detail->status_surat?>
                        </span>
                      </p>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12 text-center">
                      <h6 style="font-weight: 500">Pengirim Surat</h6>
                      <h5><?=$detail->nama_lengkap_input?></h5>
                      <span class="badge" style="background-color: grey;font-size:10px;"><?=tanggal($detail->tgl_input)?></span>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-md-12 text-center">
                      <h6 style="font-weight: 500">Penerima Surat</h6>
                      <h5><?=$detail->nama_lengkap_penerima?></h5>
                      <span class="badge" style="background-color: grey;font-size:10px;"><?=tanggal($detail->tanggal_surat)?></span>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-md-12 text-center">
                      <h6 style="font-weight: 500">Pengirim Disposisi</h6>
                      <h5><?=$detail->nama_lengkap_disposisi?></h5>
                      <span class="badge" style="background-color: grey;font-size:10px;"><?=tanggal($detail->tanggal_surat)?></span>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-md-12 text-center">
                      <h6 style="font-weight: 500">Penerima Disposisi</h6>
                      <h5><?=$detail->nama_lengkap_penerima_disposisi?></h5>
                      <span class="badge" style="background-color: grey;font-size:10px;"><?=$detail->tgl_terima ? tanggal($detail->tgl_terima) : '-'?></span>
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
                        <div class="text-center">
                          <a href="#" class="btn btn-warning" data-toggle="modal" data-target="#disposisiTembusan" style="color:white;">Disposisikan Kembali</a>
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
                    <br><br>
                    <b>Petunjuk</b>
                    <p style="color: #6003C8"><strong><?=$detail->nama_lengkap_disposisi?> <?="($detail->jabatan_disposisi)"?> :</strong></p>
                    <p><?php
                    $in = $detail->instruksi;
                    $instruksi = explode(";", $in);
                    foreach($instruksi as $i){
                      echo "- $i <br>";
                    }
                    ?></p>
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
                </div>
                <span style="background-color: #fff;padding: 10px;font-weight: 500;border-left: solid 3px #6003C8;margin-bottom: 10px;">Lampiran</span>
                <br>
                <br>
                <?php 
                if(!empty($detail->lampiran)){?>
                  <div class="row">
                    <div class="col-md-2">
                      <div class="panel panel-default text-center">
                        <br>
                        <i class="fa fa-file-text" style="font-size:60px;" ></i><br>
                        <?=$detail->lampiran?>
                        <br>
                        <br>
                        <a href="<?=base_url()?>/data/<?=$jenis_surat?>/lampiran/<?=$detail->lampiran?>" class="btn btn-primary btn-block"><i class="ti-download"></i> Download</a>
                      </div>
                    </div>
                  </div>
                <?php }else{
                  echo "Tidak ada lampiran";
                } ?>

              </div>
            </div>

            <!-- Modal Kembalikan Draft -->
            <div id="disposisiTembusan" class="modal fade bs-example-modal-md" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel2" aria-hidden="true" style="display: none;">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <div class="panel panel-primary">
                    <div class="panel-heading">
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                      Disposisikan dan Tembusan
                    </div>
                  </div>
                  <form class="form-horizontal" action="<?php echo base_url().'surat_disposisi/add_disposisi/'.$detail->id_surat_masuk.'/'.$this->uri->segment(3);?>" method="post" >
                    <div class="modal-body">
                      <div class="form-group">
                        <label class="col-md-12">Disposisi</label>
                        <div class="col-md-12">
                          <div class="btn-group btn-group-justified m-b-20"> 
                            <a id="btn-disposisi-internal" class="btn btn-primary waves-effect" onclick="change_disposisi('internal');" role="button">INTERNAL <span id="count-selected-internal" class="label label-rouded label-inverse pull-right"></span></a> 
                            <a id="btn-disposisi-eksternal" class="btn btn-primary btn-outline waves-effect" onclick="change_disposisi('eksternal');" role="button">EKSTERNAL <span id="count-selected-eksternal" class="label label-rouded label-inverse pull-right"></span></a>
                          </div>
                          <div id="disposisi-internal">
                            <div class="row">
                              <div class="panel-group" aria-multiselectable="true" role="tablist">
                                <div class="row">
                                  <div class="col-md-12">
                                    <div class="row">
                                      <div class="col-md-8">
                                        <div class="panel">
                                          <div class="panel-heading" role="tab"> <a class="panel-title collapsed" data-toggle="collapse" href="#searching-disposisi-internal" aria-expanded="false"> Pencarian penerima disposisi </a> </div>
                                          <div class="panel-collapse collapse" id="searching-disposisi-internal" role="tabpanel" aria-expanded="false" style="height: 0px;">
                                            <div class="panel-body">
                                             <div class="row">
                                              <div class="input-group"> 
                                                <span class="input-group-btn">
                                                  <button type="button" class="btn waves-effect waves-light btn-info" onclick="search_disposisi('internal');"><i class="fa fa-search"></i></button>
                                                </span>
                                                <input type="text" id="input-search-disposisi-internal" class="form-control" onkeyup="search_disposisi('internal');" placeholder="Search">
                                                <span class="input-group-btn">
                                                  <button id="count-search-disposisi-internal" type="button" class="btn waves-effect waves-light btn-primary" onclick="$('#input-search-disposisi-internal').val(''); search_disposisi('internal');"></button>
                                                </span>
                                              </div>
                                              <?php foreach ($unit_kerja as $key => $value): 
                                                $checked = "";
                                                $disabled = "";
                                                if (in_array($value->id_unit_kerja.'-', $array_disposisi)) {
                                                  $checked = "checked";
                                                  if (!in_array($this->session->userdata('id_pegawai').'-'.$value->id_unit_kerja.'-', $array_disposisi_user)) {
                                                    $disabled = "disabled";
                                                  }
                                                }
                                                ?>
                                                <div class="col-md-12">
                                                  <div class="row">
                                                    <div class="checkbox checkbox-primary checkbox-disposisi-internal" role="listitem" aria-labelledby="<?=strtoupper($value->nama_unit_kerja)?>">
                                                      <hr style="margin: 10px 0" />
                                                      <input id="checkbox-disposisi-internal-<?=$value->id_unit_kerja?>-" type="checkbox" name="unit_kerja[]" value="<?=$value->id_unit_kerja?>" <?="{$checked} {$disabled}"?> onchange="select_disposisi_unit_kerja('<?=$value->id_unit_kerja?>-');" <?=($value->id_unit_kerja=="0")?"disabled":"";?>>
                                                      <label for="checkbox-disposisi-internal-<?=$value->id_unit_kerja?>-">
                                                        <span class="tooltip-item bg-primary"><?=$value->nama_unit_kerja?></span>
                                                      </label>
                                                    </div>
                                                  </div>
                                                </div>
                                                <?php foreach ($pegawai[$value->id_unit_kerja] as $key2 => $row): 
                                                  $row->foto_pegawai = ($row->foto_pegawai=='') ? 'user-default.png' : $row->foto_pegawai;
                                                  $checked = "";
                                                  $disabled = "";
                                                  if (in_array($value->id_unit_kerja.'-'.$row->id_pegawai, $array_disposisi)) {
                                                    $checked = "checked";
                                                    if (!in_array($this->session->userdata('id_pegawai').'-'.$value->id_unit_kerja.'-'.$row->id_pegawai, $array_disposisi_user)) {
                                                      $disabled = "disabled";
                                                    }
                                                  }
                                                  ?>
                                                  <div class="checkbox checkbox-primary col-md-6 checkbox-disposisi-internal" role="listitem" aria-labelledby="<?=strtoupper($value->nama_unit_kerja)." ".strtoupper($row->nama_lengkap)." ".strtoupper($row->nama_jabatan)." ".strtoupper($row->jenis_pegawai)?>">
                                                    <input id="checkbox-disposisi-internal-<?=$value->id_unit_kerja?>-<?=$row->id_pegawai?>" type="checkbox" name="pegawai[]" value="<?=$value->id_unit_kerja.'-'.$row->id_pegawai?>" <?="{$checked} {$disabled}"?> onchange="select_disposisi('internal', '<?=$value->id_unit_kerja?>-<?=$row->id_pegawai?>');">
                                                    <label for="checkbox-disposisi-internal-<?=$value->id_unit_kerja?>-<?=$row->id_pegawai?>">
                                                      <div class="col-md-12" style="margin-bottom:10px;border: solid 1px #cdcdcd;text-align: left !important;padding:4px">
                                                        <div class="col-md-4">
                                                          <img src="<?=base_url('data/foto/pegawai/'.$row->foto_pegawai)?>" alt="user" class="img-circle img-responsive" style="max-height: 75px;">
                                                        </div>
                                                        <div class="col-md-8">
                                                          <small style="display: block" class="text-purple"> <?=$row->nama_lengkap?> <span class="label label-rouded label-primary"><?=strtoupper($row->jenis_pegawai)?></span></small>
                                                          <small style="display: block" class="text-muted"> <?=$row->nama_jabatan?></small>
                                                        </div>
                                                      </div> 
                                                    </label>
                                                  </div>
                                                <?php endforeach ?>
                                              <?php endforeach ?>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="col-md-4">
                                      <div class="panel">
                                        <div class="panel-heading" role="tab"> <a class="panel-title" data-toggle="collapse" href="#selected-disposisi-internal" aria-expanded="true"> Penerima disposisi yang dipilih </a> </div>
                                        <div class="panel-collapse collapse in" id="selected-disposisi-internal" role="tabpanel" aria-expanded="true" style="">
                                          <div class="panel-body">
                                           <div class="row">
                                            <?php foreach ($unit_kerja as $key => $value): ?>
                                              <div class="col-md-12 row hide" id="selected-disposisi-internal-<?=$value->id_unit_kerja?>-">
                                                <span class="tooltip-item bg-primary" id="color-selected-disposisi-internal-<?=$value->id_unit_kerja?>-">
                                                  <?=$value->nama_unit_kerja?>
                                                  <button type="button" class="close" aria-hidden="true" onclick="$('#checkbox-disposisi-internal-<?=$value->id_unit_kerja?>-').click();"><i class="ti ti-close"></i></button>
                                                </span>
                                                <hr style="margin: 10px 0" />
                                              </div>
                                              <?php foreach ($pegawai[$value->id_unit_kerja] as $key2 => $row): $row->foto_pegawai = ($row->foto_pegawai=='') ? 'user-default.png' : $row->foto_pegawai;?>
                                                <div class="col-md-12 m-t-5 hide" id="selected-disposisi-internal-<?=$value->id_unit_kerja?>-<?=$row->id_pegawai?>" style="margin-bottom:10px;border: solid 1px #6003c8;text-align: left !important;padding:4px">
                                                  <div class="col-md-4">
                                                    <img src="<?=base_url('data/foto/pegawai/'.$row->foto_pegawai)?>" alt="user" class="img-circle img-responsive" style="max-height: 75px;">
                                                  </div>
                                                  <div class="col-md-8">
                                                    <button type="button" class="close" aria-hidden="true" onclick="$('#checkbox-disposisi-internal-<?=$value->id_unit_kerja?>-<?=$row->id_pegawai?>').click();"><i class="ti ti-close"></i></button>
                                                    <small style="display: block" class="text-purple"> <?=$row->nama_lengkap?> <span class="label label-rouded label-primary"><?=strtoupper($row->jenis_pegawai)?></span></small>
                                                    <small style="display: block" class="text-muted"> <?=$row->nama_jabatan?></small>
                                                  </div>
                                                </div> 
                                              <?php endforeach ?>
                                            <?php endforeach ?>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div id="disposisi-eksternal" class="hide">
                        <div class="row">
                          <div class="panel-group" aria-multiselectable="true" role="tablist">
                            <div class="row">
                              <div class="col-md-12">
                                <div class="row">
                                  <div class="col-md-8">
                                    <div class="panel">
                                      <div class="panel-heading" role="tab"> <a class="panel-title collapsed" data-toggle="collapse" href="#searching-disposisi-eksternal" aria-expanded="false"> Pencarian penerima disposisi </a> </div>
                                      <div class="panel-collapse collapse" id="searching-disposisi-eksternal" role="tabpanel" aria-expanded="false" style="height: 0px;">
                                        <div class="panel-body">
                                         <div class="row">
                                          <div class="input-group"> 
                                            <span class="input-group-btn">
                                              <button type="button" class="btn waves-effect waves-light btn-info" onclick="search_disposisi('eksternal');"><i class="fa fa-search"></i></button>
                                            </span>
                                            <input type="text" id="input-search-disposisi-eksternal" class="form-control" onkeyup="search_disposisi('eksternal');" placeholder="Search">
                                            <span class="input-group-btn">
                                              <button id="count-search-disposisi-eksternal" type="button" class="btn waves-effect waves-light btn-primary" onclick="$('#input-search-disposisi-eksternal').val(''); search_disposisi('eksternal');"></button>
                                            </span>
                                          </div>
                                          <hr style="margin: 10px 0" />
                                          <?php foreach ($skpd as $key3 => $rows): 
                                            $rows->logo_skpd = ($rows->logo_skpd=='') ? 'sumedang.png' : $rows->logo_skpd;
                                            $checked = "";
                                            $disabled = "";
                                            if (in_array($rows->id_skpd, $array_disposisi)) {
                                              $checked = "checked";
                                              if (!in_array($this->session->userdata('id_pegawai').'-'.$rows->id_skpd, $array_disposisi_user)) {
                                                $disabled = "disabled";
                                              }
                                            }
                                            ?>
                                            <div class="checkbox checkbox-primary col-md-6 checkbox-disposisi-eksternal" role="listitem" aria-labelledby="<?=strtoupper($rows->nama_skpd)." ".strtoupper($rows->nama_skpd_alias)?>">
                                              <input id="checkbox-disposisi-eksternal-<?=$rows->id_skpd?>" type="checkbox" name="skpd[]" value="<?=$rows->id_skpd?>" <?="{$checked} {$disabled}"?> onchange="select_disposisi('eksternal', '<?=$rows->id_skpd?>');">
                                              <label for="checkbox-disposisi-eksternal-<?=$rows->id_skpd?>">
                                                <div class="col-md-12" style="margin-bottom:10px;border: solid 1px #cdcdcd;text-align: left !important;padding:4px">
                                                  <div class="col-md-4">
                                                    <img src="<?=base_url('data/logo/skpd/'.$rows->logo_skpd)?>" alt="skpd" class="img-circle img-responsive" style="max-height: 75px;">
                                                  </div>
                                                  <div class="col-md-8">
                                                    <small style="display: block" class="text-purple"> <?=$rows->nama_skpd?> <span class="label label-rouded label-primary"><?=strtoupper($rows->nama_skpd_alias)?></span></small>
                                                    <small style="display: block" class="text-muted"> <?=$rows->alamat_skpd?> <?=$rows->kode_pos?></small>
                                                  </div>
                                                </div> 
                                              </label>
                                            </div>
                                          <?php endforeach ?>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="col-md-4">
                                  <div class="panel">
                                    <div class="panel-heading" role="tab"> <a class="panel-title" data-toggle="collapse" href="#selected-disposisi-eksternal" aria-expanded="true"> Penerima disposisi yang dipilih </a> </div>
                                    <div class="panel-collapse collapse in" id="selected-disposisi-eksternal" role="tabpanel" aria-expanded="true" style="">
                                      <div class="panel-body">
                                       <div class="row">
                                        <?php foreach ($skpd as $key3 => $rows): $rows->logo_skpd = ($rows->logo_skpd=='') ? 'sumedang.png' : $rows->logo_skpd;?>
                                          <div class="col-md-12 hide" id="selected-disposisi-eksternal-<?=$rows->id_skpd?>" style="margin-bottom:10px;border: solid 1px #6003c8;text-align: left !important;padding:4px">
                                            <div class="col-md-4">
                                              <img src="<?=base_url('data/logo/skpd/'.$rows->logo_skpd)?>" alt="skpd" class="img-circle img-responsive" style="max-height: 75px;">
                                            </div>
                                            <div class="col-md-8">
                                              <button type="button" class="close" aria-hidden="true" onclick="$('#checkbox-disposisi-eksternal-<?=$rows->id_skpd?>').click();"><i class="ti ti-close"></i></button>
                                              <small style="display: block" class="text-purple"> <?=$rows->nama_skpd?> <span class="label label-rouded label-primary"><?=strtoupper($rows->nama_skpd_alias)?></span></small>
                                              <small style="display: block" class="text-muted"> <?=$rows->alamat_skpd?> <?=$rows->kode_pos?></small>
                                            </div>
                                          </div> 
                                        <?php endforeach ?>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <input type="hidden" name="id_skpd" value="<?=$detail->id_skpd_penerima?>">
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-12">Catatan</label>
                <div class="col-md-12">
                  <?php 

                  $instruksi = explode(";", $d->instruksi);

                  foreach($catatan_disposisi as $k => $c){
                    $checked = (array_search($c, $instruksi)) ? " checked" : "";
                    ?>
                    <div class="checkbox checkbox-primary">
                      <input id="checkbox<?=$k?>" name="instruksi[]" type="checkbox" value="<?=$c?>"<?=$checked?>>
                      <label for="checkbox<?=$k?>"><?=$c?></label>
                    </div>
                  <?php } ?>

                  <?php 
                  $catatan_lainnya = "";
                  foreach($instruksi as $i){
                    if(!array_search($i, $catatan_disposisi)){
                      $catatan_lainnya = $i;
                    }
                  }

                  if(!empty($catatan_lainnya)){
                    $display = "block";
                    $disabled = "";
                    $checked2 ="checked";
                  }else{
                    $display = "none";
                    $disabled = "disabled";
                    $checked2 ="";
                  }
                  ?>
                  <div class="checkbox checkbox-primary">
                    <input id="cbInstruksi" type="checkbox" value="lainnya" onclick="toggleInstruksi()" <?=$checked2?>>
                    <label for="cbInstruksi">Instruksi Lainnya</label>
                    <textarea name="instruksi[]" placeholder="Masukan catatan disposisi" id="frmInstruksi" class="form-control" style="display: <?=$display?>" <?=$disabled?>><?=$catatan_lainnya?></textarea>
                  </div>
                </div>
                <div class="col-md-12">
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Batal</button>
              <button type="submit" class="btn btn-primary waves-effect text-left" >Kirim</button>

            </div>
          </form>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>




    <script type="text/javascript">
     var selected_internal = 0;
     var selected_eksternal = 0;

     function load_disposisi() {
       search_disposisi('internal');
       search_disposisi('eksternal');
       <?php
       foreach ($array_disposisi as $key) {
        if (strpos($key, '-') !== false) {
          $expl_id = explode('-', $key);
          if (!empty($expl_id[1])) {
            echo "select_disposisi('internal','{$key}','load');";
          } else {
            echo "select_disposisi_unit_kerja('{$key}','load');";
            if (!in_array($this->session->userdata('id_pegawai').'-'.$key, $array_disposisi_user)) {
              echo "$('#checkbox-disposisi-internal-{$key}').click();
              $('#checkbox-disposisi-internal-{$key}').attr(\"disabled\",true);";
            }
          }
        } else {
          echo "select_disposisi('eksternal','{$key}','load');";
        }
      }
      ?>
    }


    function change_disposisi(jenis) {
      if (jenis == "internal") {
        $('#btn-disposisi-internal').removeClass('btn-outline');
        $('#btn-disposisi-eksternal').addClass('btn-outline');
        $('#disposisi-internal').removeClass('hide');
        $('#disposisi-eksternal').addClass('hide');
      } else {
        $('#btn-disposisi-internal').addClass('btn-outline');
        $('#btn-disposisi-eksternal').removeClass('btn-outline');
        $('#disposisi-internal').addClass('hide');
        $('#disposisi-eksternal').removeClass('hide');
      }
    }

    function search_disposisi(jenis) {
  // Declare variables
  var input, filter, div, small, i, jumlah;
  input = document.getElementById('input-search-disposisi-'+jenis);
  filter = input.value.toUpperCase();
  // alert(filter);
  div = document.getElementsByClassName("checkbox checkbox-primary checkbox-disposisi-"+jenis);
  jumlah = 0;
  for (i = 0; i < div.length; i++) {
    if (filter === ""){
      div[i].style.display = "";
      if (div[i].classList.contains("col-md-6")) {jumlah++;}
    }
    else {
      div[i].style.display = "none";
      if (div[i].getAttribute("aria-labelledby").indexOf(filter) > -1) {
        div[i].style.display = "";
        if (div[i].classList.contains("col-md-6")) {jumlah++;}
      }
    }
  }
  document.getElementById('count-search-disposisi-'+jenis).innerHTML = jumlah;
}

function select_disposisi(jenis,id,load=null) {
  if ($('#checkbox-disposisi-'+jenis+'-'+id).is(':checked')) {
    $('#selected-disposisi-'+jenis+'-'+id).removeClass('hide');
    if (load) {$('#selected-disposisi-'+jenis+'-'+id).css('border-color','#cdcdcd');}
    if (jenis == "internal") {
      selected_internal++;
      if(selected_internal>0){
        $('#count-selected-internal').text(selected_internal);
      } else {
        $('#count-selected-internal').text('');
      }
    } else {
      selected_eksternal++;
      if(selected_eksternal>0){
        $('#count-selected-eksternal').text(selected_eksternal);
      } else {
        $('#count-selected-eksternal').text('');
      }
    }
  } else if ($('#checkbox-disposisi-'+jenis+'-'+id).length > 0) {
    $('#selected-disposisi-'+jenis+'-'+id).addClass('hide');
    if (jenis == "internal") {
      selected_internal--;
      if(selected_internal>0){
        $('#count-selected-internal').text(selected_internal);
      } else {
        $('#count-selected-internal').text('');
      }
    } else {
      selected_eksternal--;
      if(selected_eksternal>0){
        $('#count-selected-eksternal').text(selected_eksternal);
      } else {
        $('#count-selected-eksternal').text('');
      }
    }
  }
}

function select_disposisi_unit_kerja(id,load=null) {
  var jenis = "internal";
  if ($('#checkbox-disposisi-'+jenis+'-'+id).is(':checked')) {
    $('#selected-disposisi-'+jenis+'-'+id).removeClass('hide');
    if (load) {$('#color-selected-disposisi-'+jenis+'-'+id).removeClass('bg-primary');$('#color-selected-disposisi-'+jenis+'-'+id).addClass('bg-default');}

    $('input:checkbox[id^="checkbox-disposisi-internal-'+id+'"]:checked').each(function(){
      $(this).click();
    });

    $('input:checkbox[id^="checkbox-disposisi-internal-'+id+'"]').each(function(){
      $(this).attr("disabled",true);
    });

    $('#checkbox-disposisi-internal-'+id).attr("disabled",false);
    $('#checkbox-disposisi-internal-'+id).click();

    selected_internal++;
    if(selected_internal>0){
      $('#count-selected-internal').text(selected_internal);
    } else {
      $('#count-selected-internal').text('');
    }
  } else if ($('#checkbox-disposisi-'+jenis+'-'+id).length > 0) {
    $('#selected-disposisi-'+jenis+'-'+id).addClass('hide');

    $('input:checkbox[id^="checkbox-disposisi-internal-'+id+'"]').each(function(){
      $(this).attr("disabled",false);
    });

    selected_internal--;
    if(selected_internal>0){
      $('#count-selected-internal').text(selected_internal);
    } else {
      $('#count-selected-internal').text('');
    }
  }
}
  
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

<script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
<script>
  $( document ).ready(function() {
    console.log( "document loaded" );
    load_disposisi();
  });
</script>