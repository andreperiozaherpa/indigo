<?php 
if(isset($u)){
  foreach($u as $k => $v){
    $$k = $v;
    $info[$k] = $v;
  }
}
?>

<div class="container-fluid">

  <div class="row bg-title">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
      <h4 class="page-title"><?php echo title($title) ?></h4> </div>
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
        if (!empty($message)){
          ?>
          <div class="alert alert-<?= $type;?> alert-dismissible fade in" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
            </button>
            <?= $message;?>
          </div>
        <?php }?>
        <div class="x_panel">
          <div class="x_content">
            <div class="alert alert-danger alert-dismissible fade in" role="alert" id='pesan' style='display:none'>
              <button type="button" onclick='hideMe()' class="close" aria-label="Close"><span aria-hidden="true">×</span>
              </button>
              <label id='status'></label>
            </div>
            <div class="col-md-4">

              <div class="white-box">
                <div class="user-bg"> <img width="100%" height="100%" alt="user" src="<?php echo base_url();?>/data/images/header/header2.jpg">
                  <div class="overlay-box">
                    <div class="user-content" style="padding-top:1px;">
                      <a href="javascript:void(0)"><img src="<?=base_url('data/foto/pegawai/'.$detail->foto_pegawai.'')?>" class="thumb-lg img-circle" style=" object-fit: cover;width: 75px;height: 75px;border-radius: 50%;" alt="img"></a>
                      <h5 class="text-white"><b><?= $detail->nama_lengkap?></b></h5>
                      <h6 class="text-white"><?= isset($detail->nip) ? $detail->nip : '-' ?></h6>
                    </div>
                  </div>
                </div>
                <div class="user-btm-box">
                  <div class="row">
                    <div class="col-md-12 b-b text-center">
                      <h6><b>SKPD
                      </b></h6>
                      <h6><?= isset($detail->nama_skpd) ? ($detail->nama_skpd) : "-" ; ?>
                    </h6>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6 b-r text-center">
                    <h6><b>Unit Kerja</b></h6>
                    <h6>
                      <?= isset($detail->nama_unit_kerja) ? ($detail->nama_unit_kerja) : "-" ; ?>
                    </h6>
                  </div>
                  <div class="col-md-6 text-center">
                    <h6><b>Jabatan</b></h6>
                    <h6>
                      <?= isset($detail->nama_jabatan) ? ($detail->nama_jabatan) : "-" ; ?>
                    </h6>
                  </div>
                </div>
              </div>
            </div>
            <a href="<?=base_url('usulan_pensiun/download_pengantar/'.$detail->id_usulan)?>" class="btn btn-success btn-block"><i class="ti-cloud-down"></i> Download Surat Pengantar</a>
            <div class="white-box" style="border-top:10px solid #22a7f0;margin-top: 15px;">
              <div class="row">
                <div class="col-md-12 b-b text-center">
                  <h6><b>Masa Kerja</b></h6>
                  <h6>
                    <?php
                    $awal = new DateTime (isset($detail->tmtcpns) ? $detail->tmtcpns : date("Y-m-d") );
                    $skrng = new DateTime (date("Y-m-d"));
                    $hasil = $skrng->diff($awal);
                    $tahun = $hasil->y;
                    $bulan = $hasil->m;
                    $hari = $hasil->d;
                    echo $tahun.' Tahun '.$bulan.' Bulan '.$hari.' Hari ';
                    ?>
                  </h6>
                </div>
              </div>
              <div class="row b-b">
                <div class="col-md-6 b-r text-center">
                  <h6><b>TMT CPNS</b></h6>
                  <h6>
                    <?=isset($detail->tmtcpns) ? tanggal($detail->tmtcpns) : "-" ; ?>
                  </h6>
                </div>
                <div class="col-md-6 text-center">
                  <h6><b>TMT PNS</b></h6>
                  <h6>
                    <?=isset($detail->tmtpns) ? tanggal($detail->tmtpns) : "-" ; ?>
                  </h6>
                </div>
              </div>
              <div class="row b-b">
                <div class="col-md-6 b-r text-center">
                  <h6><b>NIP</b></h6>
                  <h6>
                    <?=isset($detail->nip) ? $detail->nip : "-" ; ?>
                  </h6>
                </div>
                <div class="col-md-6 text-center">
                  <h6><b>Agama</b></h6>
                  <h6>
                    <?=isset($detail->agama) ? $detail->agama : "-" ;?>
                  </h6>
                </div>
              </div>
              <div class="row b-b">
                <div class="col-md-6 b-r text-center">
                  <h6><b>Tempat Lahir</b></h6>
                  <h6>
                    <?=isset($detail->temlahir) ? $detail->temlahir : "-" ;?>
                  </h6>
                </div>
                <div class="col-md-6 text-center">
                  <h6><b>Tgl Lahir</b></h6>
                  <h6>
                    <?=isset($detail->tgllahir) ? tanggal($detail->tgllahir) : "-" ;?>
                  </h6>
                </div>
              </div>
              <div class="row b-b">
                <div class="col-md-6 b-r text-center">
                  <h6><b>Jenis Kelamin</b></h6>
                  <h6>
                    <?=isset($detail->kelamin) ? $detail->kelamin : "-" ;?>
                  </h6>
                </div>
                <div class="col-md-6 text-center">
                  <h6><b>Pendidikan</b></h6>
                  <h6>
                    <?=isset($detail->pendidikan) ? $detail->pendidikan : "-" ;?>
                  </h6>
                </div>
              </div>
              <div class="row b-b">
                <div class="col-md-6 b-r text-center">
                  <h6><b>Pangkat / Golongan</b></h6>
                  <h6>
                    <?=isset($detail->pangkat) ? $detail->pangkat : "-" ;?><?=isset($detail->gol) ? $detail->gol : "-" ;?>
                  </h6>
                </div>
                <div class="col-md-6 text-center">
                  <h6><b>TMT Pangkat</b></h6>
                  <h6>
                    <?=isset($detail->tmtpang) ? tanggal($detail->tmtpang) : "-" ;?>
                  </h6>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-8">
            <div class="white-box">
              <span style="border-right: solid 2px #22a7f0;padding-right: 7px;margin-right: 10px"><i style="background-color: #22a7f0;color: #fff;padding: 5px;" class="ti-list-ol"></i> #<?=$detail->nomor_urut?></span>
              <span style="border-right: solid 2px #22a7f0;padding-right: 7px;margin-right: 10px"><i style="background-color: #22a7f0;color: #fff;padding: 5px;" class="ti-comment-alt"></i> <?=$detail->perihal?></span>
              <span><i style="background-color: #22a7f0;color: #fff;padding: 5px;" class="ti-calendar"></i> <?=tanggal($detail->tgl_pensiun)?></span>
              <?=status_usulan($detail->status_usulan,"pull-right")?>
              <hr>
              <?php 
              if($detail->status_usulan=="terima"){
                $class = "success";
                $text = "Usulan sudah diterima oleh BKPSDM.";
              }elseif($detail->status_usulan=="tolak"){
                $class = "danger";
                $text = "Usulan ditolak oleh BKPSDM, silahkan periksa kembali persyaratan yang di upload.";
                $alasan = $detail->alasan_penolakan;
              }elseif($detail->status_usulan=="pending"){
                $class = "warning";
                $text = "Usulan sedang dalam proses verifikasi oleh BKPSDM";
              }else{
                $class = "danger";
                $text = "Usulan belum diajukan, silahkan lengkapi berkas dibawah ini.";
              }
              ?>
              <div class="alert alert-<?=$class?>">
                <?=$text?>
                <?= isset($alasan) ? "<br> <b>Alasan Penolakan</b> : ".$alasan : '' ?>
              </div>
            </div>

            <?php 
            if($detail->status_usulan=="upload"){?>
              <div class="panel panel-default">
                <div class="panel-heading">
                 UPLOAD BERKAS PERSYARATAN
               </div>
               <div class="panel-body">
                <div class="row">
                  <div class="col-md-12">
                    <?php 
                    echo form_open_multipart();
                    $persyaratan = explode(";", $detail->persyaratan);
                    $n=1;
                    foreach($persyaratan as $p){
                      $dp = $this->ref_alasan_pensiun_model->get_persyaratan_by_id($p);
                      ?>
                      <div class="form-group">
                        <label style="margin-bottom: 20px"><span style="background-color: #22a7f0;color: #fff;padding: 5px;border-radius: 2px;margin-right: 5px"><?=$n?></span><?=$dp->nama_berkas?></label>
                        <?php 
                        if($dp->nama_berkas=="Akta Nikah / Cerai"){
                          ?><br>
                          Pilih Salah Satu : 
                          <div class="radio radio-primary radio-circle" style="display: inline-block;margin-left: 10px;margin-right: 10px;">
                            <input id="radio-2" name="jenis_akta" value="nikah" type="radio" required>
                            <label for="radio-2"> Nikah </label>
                          </div>
                          <div class="radio radio-primary radio-circle" style="display: inline-block;">
                            <input id="radio-9" name="jenis_akta" value="cerai" type="radio" required>
                            <label for="radio-9"> Cerai </label>
                          </div>
                          <?php
                        }
                        ?>
                        <input type="file" class="dropify" name="file_<?=$p?>" required>
                      </div>
                      <?php $n++; } ?>
                      <div class="form-group">
                        <button class="btn btn-primary waves-effect waves-submit pull-right" type="submit"><span class="btn-label"><i class="ti-new-window"></i></span>Ajukan Usulan</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div> 
          <?php }else{?>

            <div class="panel panel-default">
              <div class="panel-heading">
                DAFTAR BERKAS PERSYARATAN
              </div>
              <div class="panel-body">
                <div class="row">
                  <div class="col-md-12">
                    <?php 
                    echo form_open_multipart();
                    $persyaratan = explode(";", $detail->persyaratan);
                    $n=1;
                    foreach($persyaratan as $p){
                      $dp = $this->usulan_pensiun_model->get_berkas($detail->id_usulan,$p);
                      $ext = explode(".", $dp->nama_file);
                      $ext = end($ext);
                      if($ext=="docx"||$ext=="doc"||$ext=="pdf"){
                        $tag = "iframe";
                        $url = base_url('data/upload/berkas_persyaratan/'.$dp->nama_file);
                        // if($ext=="pdf"){
                          $url = "https://docs.google.com/viewer?url=".$url."&embedded=true";
                        // }else{
                          // $url = "https://view.officeapps.live.com/op/embed.aspx?src=".$url."&embedded=true";
                        // }
                        // echo $url;
                      }else{
                        $tag = "img";
                        $url = base_url('data/upload/berkas_persyaratan/'.$dp->nama_file);
                      }
                      ?>
                      <div class="form-group">
                        <label style="margin-bottom: 20px"><span style="background-color: #22a7f0;color: #fff;padding: 5px;border-radius: 2px;margin-right: 5px"><?=$n?></span><?=$dp->nama_berkas?></label>
                        <p><span style="font-weight: 500" class="text-primary">Nama File</span> : <?=$dp->nama_file?></p>
                        <a href="<?=base_url('data/upload/berkas_persyaratan/'.$dp->nama_file)?>" class="btn btn-primary"><i class="ti-download"></i> Download</a>
                        <a href="javascript:void(0)" onclick="lihat('<?=$tag?>','<?=$ext?>','<?=$url?>')" class="btn btn-info"><i class="ti-eye"></i> Lihat</a>
                      </div>
                      <hr>
                      <?php $n++; } ?>
                    </form>
                  </div>
                </div>
              </div>
            </div> 
          <?php } ?>
        </div>
      </div>
    </div>
  </div>
</div>
</div>

<script type="text/javascript">
  function lihat(tag,ext,url){
    if(tag=='iframe'){
      $("#frameLihat").attr('src',url);
      $("#frameLihat").show();
      $("#imgLihat").hide();
    }else{
      $("#imgLihat").attr('src',url);
      $("#imgLihat").show();
      $("#frameLihat").hide();
    }
    $('#modalLihat').modal('show');
  }
</script>

<div class="modal fade bs-example-modal-lg" id="modalLihat" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title" id="myLargeModalLabel">Pratinjau File</h4>
      </div>
      <div class="modal-body">
        <iframe id="frameLihat" src="" width="100%"height="700"style="border: none;display: none;"></iframe>
        <img id="imgLihat" src="" class="img-responsive" style="display: none;"></img>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Close</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>