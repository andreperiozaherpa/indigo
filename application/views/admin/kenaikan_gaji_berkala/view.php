<?php 
if(isset($u)){
      foreach($u as $k => $v){
        $$k = $v;
        $info[$k] = $v;
      }
    }
?>
<style type="text/css">
.btn input[type=radio]{
  display: none;
}
.btn input[type=radio]:checked+label{
  color: #fff;
  background: #22a7f0;
  border: 1px solid #22a7f0;
  padding: 0px 2px;
}
.btn input[type=radio]:checked+label::before{
  content:"\f00c";
  font-family:FontAwesome;
}
.btn label{
  font-weight: 400;
  color: #337ab7;
}
</style>

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
        $tipe = (empty($error))? "info" : "danger";
        if (!empty($message)){
          ?>
          <div class="alert alert-<?= $tipe;?> alert-dismissible fade in" role="alert">
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
                <div class="panel panel-default">
                  <div class="panel-body">
                      <div class="white-box">
                          <div class="user-bg"> <img width="100%" height="100%" alt="user" src="<?php echo base_url();?>/data/images/header/header2.jpg">
                              <div class="overlay-box">
                                  <div class="user-content" style="padding-top:1px;">
                                      <a href="javascript:void(0)"><img src="<?=base_url('data/foto/pegawai/'.$detail->foto_pegawai.'')?>" class="thumb-lg img-circle" style=" object-fit: cover;
                                        width: 75px;
                                        height: 75px;border-radius: 50%;
                                        " alt="img"></a>
                                      <h5 class="text-white"><b><?= $detail->nama_lengkap?></b></h5>
                                      <h6 class="text-white"><?= isset($user->nip) ? $user->nip : '-' ?></h6>
                                  </div>
                              </div>
                        </div>
                        <div class="user-btm-box">
                          <div class="row">
                            <div class="col-md-12 b-b text-center">
                              <h6><b>SKPD
                              </b></h6>
                              <h6><?= isset($user->nama_skpd) ? ($user->nama_skpd) : "-" ; ?>
                              </h6>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-6 b-r text-center">
                              <h6><b>Unit Kerja</b></h6>
                              <h6>
                                <?= isset($user->nama_unit_kerja) ? ($user->nama_unit_kerja) : "-" ; ?>
                              </h6>
                            </div>
                            <div class="col-md-6 text-center">
                              <h6><b>Jabatan</b></h6>
                              <h6>
                                <?= isset($user->jabatan) ? ($user->jabatan) : "-" ; ?>
                              </h6>
                            </div>
                          </div>
                        </div>

                <div class="row b-t">
                  <div class="col-md-12 b-b text-center">
                    <h6><b>Masa Kerja</b></h6>
                    <h6>
                      <?php
                      $awal = (isset($data_by_bkd->tmtcpns) ? $data_by_bkd->tmtcpns : date("Y-m-d") );
                      $awal = (isset($data_pegawai->cpns_tmt) ? $data_pegawai->cpns_tmt : $awal );
                      if (@$data_pegawai->mkg_tahun_awal OR @$data_pegawai->mkg_bulan_awal) {
                        $awal = date("Y-m-d", strtotime("{$awal} -{$data_pegawai->mkg_tahun_awal} year -{$data_pegawai->mkg_bulan_awal} month"));
                      }
                      $awal = new DateTime ($awal);
                      $skrng = new DateTime (date("Y-m-d"));
                      $hasil = $skrng->diff($awal);
                      $tahun = $hasil->y;
                      $bulan = $hasil->m;
                      $hari = $hasil->d;
                      echo $tahun.' Tahun '.$bulan.' Bulan '.$hari.' Hari ';
                      if (@$data_pegawai->mkg_tahun_awal OR @$data_pegawai->mkg_bulan_awal) {
                        echo '(+'.$data_pegawai->mkg_tahun_awal.' Tahun '.$data_pegawai->mkg_bulan_awal.' Bulan)';
                      }
                       ?>
                    </h6>
                  </div>
                </div>
                <div class="row b-b">
                  <div class="col-md-6 b-r text-center">
                    <h6><b>TMT CPNS</b></h6>
                    <h6>
                      <?php if (@$data_pegawai->cpns_tmt): ?>
                      <?=isset($data_pegawai->cpns_tmt) ? tanggal($data_pegawai->cpns_tmt) : "-" ; ?>
                      <?php else: ?>
                      <?=isset($data_by_bkd->tmtcpns) ? tanggal($data_by_bkd->tmtcpns) : "-" ; ?>
                      <?php endif ?>
                    </h6>
                  </div>
                  <div class="col-md-6 text-center">
                    <h6><b>TMT PNS</b></h6>
                    <h6>
                      <?=isset($data_by_bkd->tmtpns) ? tanggal($data_by_bkd->tmtpns) : "-" ; ?>
                    </h6>
                  </div>
                </div>
                <div class="row b-b">
                  <div class="col-md-6 b-r text-center">
                    <h6><b>NIP</b></h6>
                    <h6>
                      <?=isset($data_by_bkd->nip) ? $data_by_bkd->nip : "-" ; ?>
                    </h6>
                  </div>
                  <div class="col-md-6 text-center">
                    <h6><b>Agama</b></h6>
                    <h6>
                      <?=isset($data_by_bkd->agama) ? $data_by_bkd->agama : "-" ;?>
                    </h6>
                  </div>
                </div>
                <div class="row b-b">
                  <div class="col-md-6 b-r text-center">
                    <h6><b>Tempat Lahir</b></h6>
                    <h6>
                      <?=isset($data_by_bkd->temlahir) ? $data_by_bkd->temlahir : "-" ;?>
                    </h6>
                  </div>
                  <div class="col-md-6 text-center">
                    <h6><b>Tgl Lahir</b></h6>
                    <h6>
                      <?=isset($data_by_bkd->tgllahir) ? tanggal($data_by_bkd->tgllahir) : "-" ;?>
                    </h6>
                  </div>
                </div>
                <div class="row b-b">
                  <div class="col-md-6 b-r text-center">
                    <h6><b>Jenis Kelamin</b></h6>
                    <h6>
                      <?=isset($data_by_bkd->kelamin) ? $data_by_bkd->kelamin : "-" ;?>
                    </h6>
                  </div>
                  <div class="col-md-6 text-center">
                    <h6><b>Pendidikan</b></h6>
                    <h6>
                      <?=isset($data_by_bkd->pendidikan) ? $data_by_bkd->pendidikan : "-" ;?>
                    </h6>
                  </div>
                </div>
                <div class="row b-b">
                  <div class="col-md-6 b-r text-center">
                    <h6><b>Pangkat / Golongan</b></h6>
                    <h6>
                      <?=isset($data_by_bkd->pangkat) ? $data_by_bkd->pangkat : "-" ;?><?=isset($data_by_bkd->gol) ? $data_by_bkd->gol : "-" ;?>
                    </h6>
                  </div>
                  <div class="col-md-6 text-center">
                    <h6><b>TMT Pangkat</b></h6>
                    <h6>
                      <?=isset($data_by_bkd->tmtpang) ? tanggal($data_by_bkd->tmtpang) : "-" ;?>
                    </h6>
                  </div>
                </div>
                      </div>
                </div>
              </div>

                <!-- <div class="panel panel-default">
                  <div class="panel-heading">Riwayat Kenaikan Gaji <a href="#" onclick="buat_kgb();" class="btn btn-primary btn-outline btn-sm pull-right"><i class="fa fa-pencil"></i> Buat Baru</a></div>
                  <div class="panel-body">
                            <div class="steamline">
                            	<?php if (@$data_pegawai->cpns_id_golongan>0 AND $prediksi_kgb): 
                            		$tanggal_prediksi_kgb = date("Y-m-d", strtotime(date("Y-m-d", strtotime($data_by_bkd->tmtcpns)) . " + {$prediksi_mkg} year"));
                            		$awal_prediksi = new DateTime ($tanggal_prediksi_kgb);
                            		$tanggal_prediksi = $skrng->diff($awal_prediksi);
                            		if ($tanggal_prediksi->format('%r%a')>0) {
                            			$hari_prediksi = $tanggal_prediksi->format('%r%a HARI LAGI'); 
                                  $jenis_prediksi = "prediksi";
                            		} elseif ($tanggal_prediksi->format('%r%a')<0) {
                            			$hari_prediksi = $tanggal_prediksi->format('%a HARI LALU'); 
                                  $jenis_prediksi = "rekomendasi";
                            		} else {
                            			$hari_prediksi = "HARI INI";
                                  $jenis_prediksi = "rekomendasi";
                            		}
                            		if ($tanggal_prediksi->format('%r%a')<100):
                            		?>
	                                <div class="sl-item b-b">
	                                    <div class="sl-left"> <a href="#" onclick="buat_kgb('baru',<?=$prediksi_kgb->id_kgb?>);" class="btn btn-primary btn-outline btn-block"><i class="fa fa-edit"></i> Buat</a> </div>
	                                    <div class="sl-right">
	                                        <div><a href="#!"><?="Rp".number_format($prediksi_kgb->gaji_pokok,0,',','.').',-'?> (<?=$jenis_prediksi?>)</a> <span class="sl-date"><?=tanggal($tanggal_prediksi_kgb)?></span> <span class="label label-rouded label-info pull-right"><?=$hari_prediksi?></span></div>
	                                        <p>Masa kerja <?=$prediksi_kgb->mkg?> tahun dalam golongan <?=$prediksi_kgb->pangkat?> <p class="text-right sl-date">*dapat berubah sewaktu-waktu</p></p>
	                                    </div>
	                                </div>
	                                <?php endif ?>
                            	<?php elseif (@!$data_pegawai->cpns_id_golongan>0): ?>
	                                <div class="sl-item">
	                                    <div class="sl-left"> <button class="btn btn-primary btn-outline btn-block" data-toggle="modal" data-target="#modal-update-golongan"><i class="fa fa-edit"></i> Update</button> </div>
	                                    <div class="sl-right">
	                                    	<span class=""> Golongan awal CPNS tidak ditemukan.</span>
	                                    </div>
	                                </div>
                            	<?php endif ?>
                                <?php if (count($riwayat_kgb)>0): ?>
	                                <?php $gaji_sekarang=false; foreach ($riwayat_kgb as $r_kgb): ?>
	                                <div class="sl-item">
	                                    <div class="sl-left"> 
	                                      <?php if ($r_kgb->id_riwayat_kgb_lama>0): ?>
	                                        <a href="<?=base_url('kenaikan_gaji_berkala/cetak_kgb/'.$r_kgb->id_riwayat_kgb)?>" target="_blank" class="btn btn-primary btn-outline btn-block"><i class="fa fa-print"></i> Cetak</a>
	                                      <?php elseif ($r_kgb->mkg>0): ?>
	                                        <a href="#" onclick="buat_kgb('update',<?=$r_kgb->id_riwayat_kgb?>);" class="btn btn-primary btn-outline btn-block"><i class="fa fa-edit"></i> Buat</a>
	                                      <?php else: ?>
	                                        <a href="#!" class="btn btn-primary btn-outline btn-xs btn-block"> Gaji Pertama</a>
	                                      <?php endif ?>
	                                    </div>
	                                    <div class="sl-right">
	                                        <div>
	                                          <a href="#!"><?="Rp".number_format($r_kgb->gaji_pokok,0,',','.').',-'?></a> 
	                                          <span class="sl-date"><?=tanggal($r_kgb->terhitung_mulai_tanggal)?></span> 
	                                          <?php if ((!$r_kgb->terakhir_dicetak==null OR $r_kgb->mkg==0) AND $gaji_sekarang==false): $gaji_sekarang=true;?>
	                                            <span class="label label-rouded label-purple pull-right">GAJI SEKARANG</span>
	                                          <?php elseif ($r_kgb->terakhir_dicetak==null AND $r_kgb->mkg>0): ?>
	                                            <span class="label label-rouded label-danger pull-right">BELUM DICETAK</span>
	                                          <?php endif ?>
	                                            
	                                        </div>
	                                        <p>Masa kerja <?=$r_kgb->mkg?> tahun dalam golongan <?=$r_kgb->pangkat?></p>
	                                    </div>
	                                </div>
	                                <?php endforeach ?>
                                <?php else: ?>
                                <div class="sl-item">
                                    <div class="sl-left"> <span class="btn btn-primary btn-outline btn-block"> Belum Ada Riwayat</span> </div>
                                    <div class="sl-right">
                                    	<span class=""> Tambah Riwayat terlebih dahulu.</span>
                                    </div>
                                </div>
                                <?php endif ?>
                            </div>
                      </div>
                    </div> -->
              
              

                    

                      <?php if (@$data_pegawai->cpns_id_golongan>0): ?>
                          <div class="alert alert-inverse m-t-10" role="alert">
                            <div class="row vertical-align">
                              <div class="col-xs-1 text-center">
                                <i class="fa fa-question-circle fa-2x"></i> 
                              </div>
                              <div class="col-xs-11">
                                <strong>Ubah Data CPNS.</strong> <button class="btn btn-primary btn-outline btn-sm pull-right" data-toggle="modal" data-target="#modal-update-golongan"><i class="fa fa-edit"></i> Update</button>
                              </div>
                            </div>
                          </div>
                      <?php endif ?>
                </div>
              </div>


                          <div id="riwayat-kgb" class="col-md-8">
                              <div class="panel panel-info">
                                  <div class="panel-wrapper collapse in" aria-expanded="true">
                                      <div class="panel-body">
                                        <h3 class="box-title">Riwayat Kenaikan Gaji Berkala <a href="javascript:void(0)" onclick="buat_kgb();" class="btn btn-primary btn-outline btn-sm pull-right"><i class="fa fa-pencil"></i> Buat Baru</a></h3>
                                        <hr class="m-t-0 m-b-40">
                                        <div class="col-md-12">
                                          <div class="row">
                                          <?php if (@$data_pegawai->cpns_id_golongan>0 AND $prediksi_kgb): 
                                            $tanggal_prediksi_kgb = date("Y-m-d", strtotime(date("Y-m-d", strtotime($data_pegawai->cpns_tmt)) . " +{$prediksi_mkg} year -{$data_pegawai->mkg_tahun_awal} year -{$data_pegawai->mkg_bulan_awal} month"));
                                            $awal_prediksi = new DateTime ($tanggal_prediksi_kgb);
                                            $tanggal_prediksi = $skrng->diff($awal_prediksi);
                                            if ($tanggal_prediksi->format('%r%a')>0) {
                                              $hari_prediksi = $tanggal_prediksi->format('%r%a HARI LAGI'); 
                                              $jenis_prediksi = "prediksi";
                                            } elseif ($tanggal_prediksi->format('%r%a')<0) {
                                              $hari_prediksi = $tanggal_prediksi->format('%a HARI LALU'); 
                                              $jenis_prediksi = "rekomendasi";
                                            } else {
                                              $hari_prediksi = "HARI INI";
                                              $jenis_prediksi = "rekomendasi";
                                            }
                                            if ($tanggal_prediksi->format('%r%a')<100):
                                            ?>
                                              <div class="col-md-12 b-b" style="background: #f7fafc">
                                                <div class="col-in row">
                                                  <div class="col-md-6"> <span class="btn btn-xs btn-circle btn-primary btn-outline"><?=$prediksi_kgb->mkg?></span> <?=tanggal($tanggal_prediksi_kgb)?> <small><b>(<?=$jenis_prediksi?>)</b></small>
                                                  <h5 class="text-muted vb">Masa kerja golongan <?=$prediksi_kgb->mkg?> tahun dalam golongan <?=$prediksi_kgb->pangkat?> <small>*dapat berubah sewaktu-waktu</small></h5> </div>
                                                  <div class="col-md-6">
                                                    <h4 class="text-right m-t-15 text-primary">Rp<strong class="counter"><?=number_format(round($prediksi_kgb->gaji_pokok))?></strong>,-</h4> </div>
                                                    <div class="col-md-12">
                                                      <!-- <div class="progress">
                                                        <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width:20%"> <span class="sr-only">20% Anggaran (used)</span> </div>
                                                      </div> -->
                                                      <div class="pull-left">
                                                          <span class="label label-rouded label-info pull-right"><?=$hari_prediksi?></span>
                                                      </div>
                                                      <div class="pull-right">
                                                        <a href="#" onclick="buat_kgb('baru',<?=$prediksi_kgb->id_kgb?>);" class="btn btn-xs btn-primary btn-outline"><i class="fa fa-edit"></i> Buat</a>
                                                    </div>
                                                  </div>
                                                </div>
                                              </div>
                                              <?php endif ?>
                                          <?php elseif (@!$data_pegawai->cpns_id_golongan>0): ?>
                                            <div class="col-md-12 b-b">
                                              <div class="alert alert-inverse m-t-10" role="alert">
                                                <div class="row vertical-align">
                                                  <div class="col-xs-1 text-center">
                                                    <i class="fa fa-question-circle fa-2x"></i> 
                                                  </div>
                                                  <div class="col-xs-11">
                                                    <strong>Golongan awal CPNS tidak ditemukan.</strong> <button class="btn btn-primary btn-outline btn-sm pull-right" data-toggle="modal" data-target="#modal-update-golongan"><i class="fa fa-edit"></i> Update</button>
                                                  </div>
                                                </div>
                                              </div>
                                            </div>
                                          <?php endif ?>
                                          <?php if (count($riwayat_kgb)>0): ?>
                                            <?php $gaji_sekarang=false; foreach ($riwayat_kgb as $n => $r_kgb):?>
                                              <div class="col-md-12 b-b">
                                                <div class="col-in row">
                                                  <div class="col-md-6"> <span class="btn btn-xs btn-circle btn-primary btn-outline"><?=$r_kgb->mkg?></span> <?=tanggal($r_kgb->terhitung_mulai_tanggal)?>
                                                  <h5 class="text-muted vb">Masa kerja golongan <?=$r_kgb->mkg?> tahun dalam golongan <?=$r_kgb->pangkat?></h5> </div>
                                                  <div class="col-md-6">
                                                    <h4 class="text-right m-t-15 text-primary">Rp<strong class="counter"><?=number_format(round($r_kgb->gaji_pokok))?></strong>,-</h4> </div>
                                                    <div class="col-md-12">
                                                      <!-- <div class="progress">
                                                        <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width:20%"> <span class="sr-only">20% Anggaran (used)</span> </div>
                                                      </div> -->
                                                      <div class="pull-left">
                                                        <?php if ((!$r_kgb->terakhir_dicetak==null OR $r_kgb->mkg==0) AND $gaji_sekarang==false): $gaji_sekarang=true;?>
                                                          <span class="label label-rouded label-purple pull-right">GAJI SEKARANG</span>
                                                        <?php elseif ($r_kgb->terakhir_dicetak==null AND $r_kgb->mkg>0): ?>
                                                          <span class="label label-rouded label-danger pull-right">BELUM DICETAK</span>
                                                        <?php endif ?>
                                                      </div>
                                                      <div class="pull-right">
                                                        <?php if ($r_kgb->id_riwayat_kgb_lama>0): ?>
                                                          <button onclick="hapus_kgb(<?=$r_kgb->id_riwayat_kgb?>)" target="_blank" class="btn btn-xs btn-danger btn-outline"><i class="fa fa-trash"></i> Hapus</button>
                                                          <a href="<?=base_url('kenaikan_gaji_berkala/cetak_kgb/'.$r_kgb->id_riwayat_kgb)?>" target="_blank" class="btn btn-xs btn-primary btn-outline" data-toggle="tooltip" data-placement="top" title="Hanya melihat preview KGB"><i class="fa fa-print"></i> Lihat</a>
                                                          <?php 
                                                            // $jenis_surat = $detail->id_skpd == 24 ? 'internal' : 'eksternal';
                                                            $jenis_surat = 'eksternal';
                                                          ?>
                                                          <a target="_blank" href="<?=base_url('surat_'.$jenis_surat.'/tambah_surat_keluar/901?id_riwayat_kgb='.$r_kgb->id_riwayat_kgb)?>" target="_blank" class="btn btn-xs btn-primary btn-outline" data-toggle="tooltip" data-placement="top" title="Surat KGB otomatis dibuat setelah dibuatkan draft surat"><i class="fa fa-envelope"></i> Buat Surat</a>
                                                        <?php elseif ($r_kgb->mkg>0): ?>
                                                          <button onclick="hapus_kgb(<?=$r_kgb->id_riwayat_kgb?>)" target="_blank" class="btn btn-xs btn-danger btn-outline"><i class="fa fa-trash"></i> Hapus</button>
                                                          <a href="#" onclick="buat_kgb('update',<?=$r_kgb->id_riwayat_kgb?>);" class="btn btn-xs btn-primary btn-outline"><i class="fa fa-edit"></i> Buat</a>
                                                        <?php else: ?>
                                                          <a href="#!" class="btn btn-xs btn-primary btn-outline"> Gaji Pertama</a>
                                                        <?php endif ?>
                                                    </div>
                                                  </div>
                                                </div>
                                              </div>
                                              <?php endforeach ?>
                                            <?php else: ?>
                                              <div class="col-md-12 b-b">
                                                <div class="alert btn-custom btn-outline alert-custom m-t-10" role="alert">
                                                  <div class="row vertical-align">
                                                    <div class="col-xs-1 text-center">
                                                      <i class="fa fa-info-circle  fa-2x"></i> 
                                                    </div>
                                                    <div class="col-xs-11">
                                                      <strong>Belum Ada Riwayat:</strong> Tambah Riwayat terlebih dahulu.
                                                    </div>
                                                  </div>
                                                </div>
                                              </div>
                                            <?php endif ?>
                                            </div>
                                        </div>
                                        </div>
                                      </div>
                              </div>
                          </div>

                          <div id="wizard-kgb" class="col-md-8 hide">
                            <div class="white-box">
                                <h3 class="box-title m-b-0">Tambah KGB</h3>
                                <p class="text-muted m-b-30 font-13"> </p>
                                <div id="main-wizard-kgb" class="wizard">
                                    <ul class="wizard-steps" role="tablist">
                                        <li class="active" role="tab">
                                            <h4><span>1</span>Pilih Gaji Pokok</h4>
                                        </li>
                                        <li role="tab">
                                            <h4><span>2</span>Isi Kelengkapan</h4>
                                        </li>
                                        <li role="tab">
                                            <h4><span>3</span>Data KGB Sebelumnya</h4>
                                        </li>
                                    </ul>
                                    <form method="post" id="form-input-kgb" action="<?=base_url('kenaikan_gaji_berkala/input_kgb/'.$id_pegawai)?>"> 
                                      <input type="hidden" name="id_riwayat_kgb" id="id_riwayat_kgb">
                                    <div class="wizard-content">   
                                        <div class="wizard-pane active" role="tabpanel">              
                                          <div class="panel-group" id="pp-main" aria-multiselectable="true" role="tablist">
                                          <?php foreach ($pp as $key => $r_pp): $item = "item".$r_pp->id_pp;?>
                                              <div class="panel">
                                                  <div class="panel-heading" id="pp-head-<?=$key?>" role="tab"> <a class="panel-title <?=($r_pp->status=="Y")?'':'collapsed'?>" data-toggle="collapse" href="#pp-body-<?=$key?>" data-parent="#pp-main" aria-expanded="<?=($r_pp->status=="Y")?'true':'false'?>" aria-controls="pp-body-<?=$key?>"> <?=$r_pp->nama_pp?> </a> </div>
                                                  <div class="panel-collapse collapse <?=($r_pp->status=="Y")?'in':''?>" id="pp-body-<?=$key?>" aria-labelledby="pp-head-<?=$key?>" role="tabpanel">
                                                      <div class="panel-body table-responsive dragscroll"> 
                                                        <table class="table table-striped table-bordered table-condensed color-table primary-table">
                                                          <thead>
                                                            <tr>
                                                              <?php for ($g=1; $g <= 4; $g++): 
                                                                $ig[$g]=0;
                                                                switch ($g) {
                                                                case 1:
                                                                  $max_r = ($mkg[$r_pp->id_pp][$g]>0) ? $mkg[$r_pp->id_pp][$g] : 0;
                                                                  break;
                                                                case 2:
                                                                  $max_r = ($max_r>$mkg[$r_pp->id_pp][$g]+6) ? $max_r : $mkg[$r_pp->id_pp][$g]+6;
                                                                  break;
                                                                case 3:
                                                                case 4:
                                                                  $max_r = ($max_r>$mkg[$r_pp->id_pp][$g]+11) ? $max_r : $mkg[$r_pp->id_pp][$g]+11;
                                                                  break;
                                                                
                                                                default:
                                                                  $max_r = 0;
                                                                  break;
                                                              } ?>
                                                                <th>MKG</th>
                                                                <?php foreach ($golongan_golongan[$g] as $gg => $r_gol): ?>
                                                                  <th class="text-right"><?=$r_gol->pangkat?></th>
                                                                <?php endforeach ?>
                                                              <?php endfor ?>
                                                            </tr>
                                                          </thead>
                                                          <tbody>
                                                            <?php for ($m_r=0; $m_r <= $max_r; $m_r++): ?>
                                                              <tr>
                                                                <?php for ($g=1; $g <= 4; $g++): 
                                                                  $skip = false;
                                                                  switch ($g) {
                                                                  case 1:
                                                                    if ($m_r>$mkg[$r_pp->id_pp][$g]) {
                                                                      $skip = true;
                                                                    }
                                                                    break;
                                                                  case 2:
                                                                    if ($m_r<6 OR $m_r>$mkg[$r_pp->id_pp][$g]+6) {
                                                                      $skip = true;
                                                                    }
                                                                    break;
                                                                  case 3:
                                                                  case 4:
                                                                    if ($m_r<11 OR $m_r>$mkg[$r_pp->id_pp][$g]+11) {
                                                                      $skip = true;
                                                                    }
                                                                    break;
                                                                  
                                                                  default:
                                                                    $skip = false;
                                                                    break;
                                                                } ?>
                                                                    <th class="active"><?=(!$skip)?$ig[$g]:''?></th>
                                                                    <?php foreach ($golongan_golongan[$g] as $gg => $r_gol): ?>
                                                                    <td class="text-right">
                                                                      <?php if (!$skip AND !empty($$item[$g][$ig[$g]][$r_gol->id_golongan]['id_kgb'])): ?>
                                                                        <div class="btn btn-xs" id="radio-kgb-<?=$$item[$g][$ig[$g]][$r_gol->id_golongan]['id_kgb']?>">
                                                                            <input type="radio" name="id_kgb" id="btn-kgb-<?=$$item[$g][$ig[$g]][$r_gol->id_golongan]['id_kgb']?>" value="<?=$$item[$g][$ig[$g]][$r_gol->id_golongan]['id_kgb']?>" onclick="pilih_kgb('<?=$$item[$g][$ig[$g]][$r_gol->id_golongan]['id_kgb']?>')">
                                                                            <label for="btn-kgb-<?=$$item[$g][$ig[$g]][$r_gol->id_golongan]['id_kgb']?>" id="label-kgb-<?=$$item[$g][$ig[$g]][$r_gol->id_golongan]['id_kgb']?>" style="margin-bottom: 0px"> <?=@number_format($$item[$g][$ig[$g]][$r_gol->id_golongan]['gaji_pokok'])?> </label>
                                                                        </div>
                                                                      <?php endif ?>
                                                                    </td>
                                                                    <?php endforeach ?>
                                                                <?php if(!$skip)$ig[$g]++; endfor ?>
                                                              </tr>
                                                            <?php endfor ?>
                                                          </tbody>
                                                        </table>
                                                      </div>
                                                  </div>
                                              </div>
                                          <?php endforeach ?>
                                          </div>
                                        </div>
                                        <div class="wizard-pane form-horizontal form-label-left" role="tabpanel">
                                          <div class="form-group">
                                              <label class="control-label col-md-3 col-sm-3 col-xs-12">Nomor Surat</label>
                                              <div class="col-md-9 col-sm-9 col-xs-12">
                                                <input type="text" class="form-control" name="nomor_kgb" id="nomor_kgb" placeholder="Nomor Surat" required>
                                              </div>
                                            </div>
                                          <div class="form-group">
                                              <label class="control-label col-md-3 col-sm-3 col-xs-12">Tanggal Buat</label>
                                              <div class="col-md-9 col-sm-9 col-xs-12">
                                                <input type="date" class="form-control" name="tanggal_buat" id="tanggal_buat" placeholder="Tanggal Buat" required>
                                              </div>
                                            </div>
                                          <div class="form-group">
                                              <label class="control-label col-md-3 col-sm-3 col-xs-12">Terhitung Mulai Tanggal</label>
                                              <div class="col-md-9 col-sm-9 col-xs-12">
                                                <input type="date" class="form-control" name="terhitung_mulai_tanggal" id="terhitung_mulai_tanggal" placeholder="Terhitung Mulai Tanggal" required>
                                              </div>
                                            </div>
                                            <hr/>
                                          <div class="form-group">
                                              <label class="control-label col-md-3 col-sm-3 col-xs-12">Peraturan Pemerintah</label>
                                              <div class="col-md-9 col-sm-9 col-xs-12">
                                                <select class="form-control" name="" id="select_id_pp" placeholder="peraturan pemerintah" disabled required>
                                                  <?php foreach ($pp as $row): ?>
                                                  <option value="<?=$row->id_pp?>" <?=($row->status=="Y")?"selected":""?>><?=$row->nama_pp?></option>
                                                  <?php endforeach ?>
                                                </select>
                                                <input type="hidden" class="form-control" name="id_pp" id="id_pp" placeholder="peraturan pemerintah" readonly required>
                                              </div>
                                            </div>
                                          <div class="form-group">
                                              <label class="control-label col-md-3 col-sm-3 col-xs-12">Golongan</label>
                                              <div class="col-md-9 col-sm-9 col-xs-12">
                                                <select class="form-control" name="" id="select_id_golongan" placeholder="golongan" disabled required>
                                                  <?php foreach ($golongan as $row): ?>
                                                  <option value="<?=$row->id_golongan?>" <?=(@$this->input->get('id_golongan')==$row->id_golongan)?"selected":"";?>><?=$row->pangkat?> - <?=$row->golongan?></option>
                                                  <?php endforeach ?>
                                                </select>
                                                <input type="hidden" class="form-control" name="id_golongan" id="id_golongan" placeholder="golongan" readonly required>
                                              </div>
                                            </div>
                                          <div class="form-group">
                                              <label class="control-label col-md-3 col-sm-3 col-xs-12">MKG</label>
                                              <div class="col-md-9 col-sm-9 col-xs-12">
                                                <input type="number" class="form-control" name="mkg" id="mkg" placeholder="mkg" readonly required>
                                              </div>
                                            </div>
                                          <div class="form-group">
                                              <label class="control-label col-md-3 col-sm-3 col-xs-12">Gaji Pokok</label>
                                              <div class="col-md-9 col-sm-9 col-xs-12">
                                                <input type="text" class="form-control" name="gaji_pokok" id="gaji_pokok" placeholder="gaji pokok" readonly required>
                                              </div>
                                            </div>
                                            <div class="ln_solid"></div>
                                        </div>
                                        <div class="wizard-pane" role="tabpanel">
                                          <input type="hidden" class="form-control" name="id_riwayat_kgb_lama" id="id_riwayat_kgb_lama" placeholder="Riwayat KGB" readonly required>
                                          <div class="steamline">

                                              <?php foreach ($riwayat_kgb as $r_kgb_input): $gaji_sekarang=false; ?>
                                              <div class="sl-item">
                                                  <div class="sl-left"> 
                                                    <a href="#!" onclick="pilih_riwayat(<?=$r_kgb_input->id_riwayat_kgb?>)" class="btn btn-primary btn-outline btn-block"><i class="fa fa-check"></i> Pilih</a>
                                                  </div>
                                                  <div class="sl-right">
                                                      <div>
                                                        <a href="#!"><?="Rp".number_format($r_kgb_input->gaji_pokok,2)?></a> 
                                                        <span class="sl-date"><?=tanggal($r_kgb_input->terhitung_mulai_tanggal)?></span> 
                                                        <span id="label-riwayat-dipilih-<?=$r_kgb_input->id_riwayat_kgb?>" class="label label-rouded label-info pull-right hide">DIPILIH</span>
                                                      </div>
                                                      <p>Masa kerja <?=$r_kgb_input->mkg?> tahun dalam golongan <?=$r_kgb_input->pangkat?></p>
                                                  </div>
                                              </div>
                                              <?php endforeach ?>
                                              <div class="sl-item">
                                                  <div class="sl-left"> <a href="#!" onclick="pilih_riwayat(0)" class="btn btn-primary btn-outline btn-block"><i class="fa fa-edit"></i> Tambah Riwayat KGB lama</a> </div>
                                                  <div class="sl-right">
                                        			<div id="add_kgb_lama" class="hide">
				                                        <ul class="nav customtab nav-tabs" role="tablist">
							                                <li class="active"><a href="#gaji" aria-controls="gaji" role="tab" data-toggle="tab" aria-expanded="true">Pilih Gaji Pokok</a></li>
							                                <li role="presentation" class=""><a href="#isi" aria-controls="isi" role="tab" data-toggle="tab" aria-expanded="false">Isi Kelengkapan</a></li>
							                            </ul>
							                            <!-- Tab panes -->
							                            <div class="tab-content">
							                                <div role="tabpanel" class="tab-pane fade active in" id="gaji">
                                                                <div class="btn" id="radio-kgb-lama-null">
                                                                    <input type="radio" name="id_kgb_lama" id="btn-kgb-lama-null" value="0" onclick="pilih_kgb_lama(null)">
                                                                    Pilih <label for="btn-kgb-lama-null" id="label-kgb-lama-null"> Input Manual KGB </label> apabila Gaji Pokok tidak ada yang sesuai.
                                                                </div>
	                                          					<div class="panel-group" id="pp-lama-main" aria-multiselectable="true" role="tablist">
						                                          <?php foreach ($pp as $key => $r_pp): $item = "item".$r_pp->id_pp;?>
						                                              <div class="panel">
						                                                  <div class="panel-heading" id="pp-lama-head-<?=$key?>" role="tab"> <a class="panel-title <?=($r_pp->status=="Y")?'':'collapsed'?>" data-toggle="collapse" href="#pp-lama-body-<?=$key?>" data-parent="#pp-lama-main" aria-expanded="<?=($r_pp->status=="Y")?'true':'false'?>" aria-controls="pp-lama-body-<?=$key?>"> <?=$r_pp->nama_pp?> </a> </div>
						                                                  <div class="panel-collapse collapse <?=($r_pp->status=="Y")?'in':''?>" id="pp-lama-body-<?=$key?>" aria-labelledby="pp-lama-head-<?=$key?>" role="tabpanel">
						                                                      <div class="panel-body table-responsive dragscroll"> 
						                                                        <table class="table table-striped table-bordered table-condensed color-table primary-table">
						                                                          <thead>
						                                                            <tr>
						                                                              <?php for ($g=1; $g <= 4; $g++): 
						                                                                $ig[$g]=0;
						                                                                switch ($g) {
						                                                                case 1:
						                                                                  $max_r = ($mkg[$r_pp->id_pp][$g]>0) ? $mkg[$r_pp->id_pp][$g] : 0;
						                                                                  break;
						                                                                case 2:
						                                                                  $max_r = ($max_r>$mkg[$r_pp->id_pp][$g]+6) ? $max_r : $mkg[$r_pp->id_pp][$g]+6;
						                                                                  break;
						                                                                case 3:
						                                                                case 4:
						                                                                  $max_r = ($max_r>$mkg[$r_pp->id_pp][$g]+11) ? $max_r : $mkg[$r_pp->id_pp][$g]+11;
						                                                                  break;
						                                                                
						                                                                default:
						                                                                  $max_r = 0;
						                                                                  break;
						                                                              } ?>
						                                                                <th>MKG</th>
						                                                                <?php foreach ($golongan_golongan[$g] as $gg => $r_gol): ?>
						                                                                  <th class="text-right"><?=$r_gol->pangkat?></th>
						                                                                <?php endforeach ?>
						                                                              <?php endfor ?>
						                                                            </tr>
						                                                          </thead>
						                                                          <tbody>
						                                                            <?php for ($m_r=0; $m_r <= $max_r; $m_r++): ?>
						                                                              <tr>
						                                                                <?php for ($g=1; $g <= 4; $g++): 
						                                                                  $skip = false;
						                                                                  switch ($g) {
						                                                                  case 1:
						                                                                    if ($m_r>$mkg[$r_pp->id_pp][$g]) {
						                                                                      $skip = true;
						                                                                    }
						                                                                    break;
						                                                                  case 2:
						                                                                    if ($m_r<6 OR $m_r>$mkg[$r_pp->id_pp][$g]+6) {
						                                                                      $skip = true;
						                                                                    }
						                                                                    break;
						                                                                  case 3:
						                                                                  case 4:
						                                                                    if ($m_r<11 OR $m_r>$mkg[$r_pp->id_pp][$g]+11) {
						                                                                      $skip = true;
						                                                                    }
						                                                                    break;
						                                                                  
						                                                                  default:
						                                                                    $skip = false;
						                                                                    break;
						                                                                } ?>
						                                                                    <th class="active"><?=(!$skip)?$ig[$g]:''?></th>
						                                                                    <?php foreach ($golongan_golongan[$g] as $gg => $r_gol): ?>
						                                                                    <td class="text-right">
						                                                                      <?php if (!$skip AND !empty($$item[$g][$ig[$g]][$r_gol->id_golongan]['id_kgb'])): ?>
						                                                                        <div class="btn btn-xs" id="radio-kgb-lama-<?=$$item[$g][$ig[$g]][$r_gol->id_golongan]['id_kgb']?>">
						                                                                            <input type="radio" name="id_kgb_lama" id="btn-kgb-lama-<?=$$item[$g][$ig[$g]][$r_gol->id_golongan]['id_kgb']?>" value="<?=$$item[$g][$ig[$g]][$r_gol->id_golongan]['id_kgb']?>" onclick="pilih_kgb_lama('<?=$$item[$g][$ig[$g]][$r_gol->id_golongan]['id_kgb']?>')">
						                                                                            <label for="btn-kgb-lama-<?=$$item[$g][$ig[$g]][$r_gol->id_golongan]['id_kgb']?>" id="label-kgb-lama-<?=$$item[$g][$ig[$g]][$r_gol->id_golongan]['id_kgb']?>" style="margin-bottom: 0px"> <?=@number_format($$item[$g][$ig[$g]][$r_gol->id_golongan]['gaji_pokok'])?> </label>
						                                                                        </div>
						                                                                      <?php endif ?>
						                                                                    </td>
						                                                                    <?php endforeach ?>
						                                                                <?php if(!$skip)$ig[$g]++; endfor ?>
						                                                              </tr>
						                                                            <?php endfor ?>
						                                                          </tbody>
						                                                        </table>
						                                                      </div>
						                                                  </div>
						                                              </div>
						                                          <?php endforeach ?>
						                                      	</div>
							                                    <div class="clearfix"></div>
							                                </div>
							                                <div role="tabpanel" class="tab-pane fade form-horizontal form-label-left" id="isi">
					                                          <div class="form-group">
					                                              <label class="control-label col-md-3 col-sm-3 col-xs-12">Nomor Surat</label>
					                                              <div class="col-md-9 col-sm-9 col-xs-12">
					                                                <input type="text" class="form-control" name="nomor_kgb_lama" id="nomor_kgb_lama" placeholder="Nomor Surat" required>
					                                              </div>
					                                            </div>
					                                          <div class="form-group">
					                                              <label class="control-label col-md-3 col-sm-3 col-xs-12">Tanggal Buat</label>
					                                              <div class="col-md-9 col-sm-9 col-xs-12">
					                                                <input type="date" class="form-control" name="tanggal_buat_lama" id="tanggal_buat_lama" placeholder="Tanggal Buat" required>
					                                              </div>
					                                            </div>
					                                          <div class="form-group">
					                                              <label class="control-label col-md-3 col-sm-3 col-xs-12">Terhitung Mulai Tanggal</label>
					                                              <div class="col-md-9 col-sm-9 col-xs-12">
					                                                <input type="date" class="form-control" name="terhitung_mulai_tanggal_lama" id="terhitung_mulai_tanggal_lama" placeholder="Terhitung Mulai Tanggal" required>
					                                              </div>
					                                            </div>
					                                            <hr/>
					                                          <div class="form-group">
					                                              <label class="control-label col-md-3 col-sm-3 col-xs-12">Peraturan Pemerintah</label>
					                                              <div class="col-md-9 col-sm-9 col-xs-12">
					                                                <select class="form-control" name="id_pp_lama" id="select_id_pp_lama" placeholder="peraturan pemerintah" disabled required>
					                                                  <?php foreach ($pp as $row): ?>
					                                                  <option value="<?=$row->id_pp?>" <?=($row->status=="Y")?"selected":""?>><?=$row->nama_pp?></option>
					                                                  <?php endforeach ?>
					                                                </select>
					                                                <input type="hidden" class="form-control" name="id_pp_lama" id="id_pp_lama" placeholder="peraturan pemerintah" readonly required>
					                                              </div>
					                                            </div>
					                                          <div class="form-group">
					                                              <label class="control-label col-md-3 col-sm-3 col-xs-12">Golongan</label>
					                                              <div class="col-md-9 col-sm-9 col-xs-12">
					                                                <select class="form-control" name="id_golongan_lama" id="select_id_golongan_lama" placeholder="golongan" disabled required>
					                                                  <?php foreach ($golongan as $row): ?>
					                                                  <option value="<?=$row->id_golongan?>" <?=(@$this->input->get('id_golongan')==$row->id_golongan)?"selected":"";?>><?=$row->pangkat?> - <?=$row->golongan?></option>
					                                                  <?php endforeach ?>
					                                                </select>
					                                                <input type="hidden" class="form-control" name="id_golongan_lama" id="id_golongan_lama" placeholder="golongan" readonly required>
					                                              </div>
					                                            </div>
					                                          <div class="form-group">
					                                              <label class="control-label col-md-3 col-sm-3 col-xs-12">MKG</label>
					                                              <div class="col-md-9 col-sm-9 col-xs-12">
					                                                <input type="number" class="form-control" name="mkg_lama" id="mkg_lama" placeholder="mkg" readonly required>
					                                              </div>
					                                            </div>
					                                          <div class="form-group">
					                                              <label class="control-label col-md-3 col-sm-3 col-xs-12">Gaji Pokok</label>
					                                              <div class="col-md-9 col-sm-9 col-xs-12">
					                                                <input type="text" class="form-control" name="gaji_pokok_lama" id="gaji_pokok_lama" placeholder="gaji pokok" readonly required>
					                                              </div>
					                                            </div>
					                                            <div class="ln_solid"></div>
							                                    <div class="clearfix"></div>
							                                </div>
							                            </div>
													</div>
                                                  </div>
                                              </div>
                                          </div>

                                        </div>
                                    </div>
                                    </form>
                                </div>
                            </div>
                          </div>
            </div>
        </div>
      </div>
    </div>
  </div>

            <div class="modal fade" id="modal-update-golongan" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header" style="background-color:#008efa">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h4 class="modal-title" id="myLargeModalLabel" style="color:white">Ubah Data CPNS</h4>
                        </div>
                        <div class="modal-body">
							<form method="post" class="form-horizontal form-label-left" action="<?=base_url('kenaikan_gaji_berkala/update_cpns/'.$data_pegawai->id_master_pegawai.'/'.$id_pegawai)?>">
                              <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Golongan Awal CPNS</label>
                                  <div class="col-md-9 col-sm-9 col-xs-12">
                                    <select class="form-control" name="cpns_id_golongan" placeholder="golongan" required>
                                      <?php foreach ($golongan as $row): ?>
                                      <option value="<?=$row->id_golongan?>" <?=(@$data_pegawai->cpns_id_golongan==$row->id_golongan)?"selected":"";?>><?=$row->pangkat?> - <?=$row->golongan?></option>
                                      <?php endforeach ?>
                                    </select>
                                  </div>
                                </div>
                              <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12">TMT</label>
                                  <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input type="date" class="form-control" name="cpns_tmt" value="<?=@$data_pegawai->cpns_tmt?>" placeholder="TMT CPNS" required>
                                  </div>
                                </div>
                              <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Masa Kerja Awal</label>
                                  <div class="col-md-4 col-sm-3 col-xs-6">
                                    <input type="number" class="form-control" name="mkg_tahun_awal" value="<?=@$data_pegawai->mkg_tahun_awal?>" placeholder="Tahun" min="0" max="99" required>
                                    <span class="help-block"> Tahun </span>
                                  </div>
                                  <div class="col-md-1 col-sm-1 col-xs-12"></div>
                                  <div class="col-md-4 col-sm-2 col-xs-6">
                                    <input type="number" class="form-control" name="mkg_bulan_awal" value="<?=@$data_pegawai->mkg_bulan_awal?>" placeholder="Bulan" min="0" max="99" required>
                                    <span class="help-block"> Bulan </span>
                                  </div>
                                </div>
                        </div>
                        <div class="modal-footer">
							<button type="submit" class="btn btn-danger waves-effect text-left">Update</button>
                            <button type="button" class="btn btn-default waves-effect text-left" data-dismiss="modal">Batal</button>
																		
							</form>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>


    <!-- jQuery -->
    <script src="<?=base_url()?>asset/pixel/plugins/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Form Wizard JavaScript -->
    <script src="<?=base_url()?>asset/pixel/plugins/bower_components/jquery-wizard-master/dist/jquery-wizard.min.js"></script>

<script type="text/javascript">

  function buat_kgb(jenis="baru",id=null) {
    $('#riwayat-kgbi').addClass('hide');
    $('#wizard-kgb').removeClass('hide');
  	main_wizard.wizard('reset');
    $('#id_riwayat_kgb').val('');
    $('[name="id_kgb"]').attr('disabled',false);
    $('#nomor_kgb').attr('disabled',false);
    $('#tanggal_buat').attr('disabled',false);
    $('#terhitung_mulai_tanggal').attr('disabled',false);

    if (jenis=="baru" && id>0) {
      $('#btn-kgb-'+id).click();
  		// main_wizard.wizard('goTo', 1);
    } else if (jenis=="update" && id>0) {

      $.post( "<?=base_url()?>kenaikan_gaji_berkala/update_kgb/"+id, function( data ) {
        if (data['id_kgb']>0) {
          $('#btn-kgb-'+data['id_kgb']).click();
        } else {
          $('#select_id_pp').val(data['id_pp']);
          $('#select_id_golongan').val(data['id_golongan']);
          $('#id_pp').val(data['id_pp']);
          $('#id_golongan').val(data['id_golongan']);
          $('#mkg').val(data['mkg']);
          $('#gaji_pokok').val(data['gaji_pokok']);
        }
        $('#nomor_kgb').val(data['nomor_kgb']);
        $('#tanggal_buat').val(data['tanggal_buat']);
        $('#terhitung_mulai_tanggal').val(data['terhitung_mulai_tanggal']);

        $('[name="id_kgb"]').attr('disabled',true);
        $('#nomor_kgb').attr('disabled',true);
        $('#tanggal_buat').attr('disabled',true);
        $('#terhitung_mulai_tanggal').attr('disabled',true);
      }, "json");
      $('#id_riwayat_kgb').val(id);
  		main_wizard.wizard('goTo', 2);
    }
  }

  function pilih_kgb(id) {
    $.post( "<?=base_url()?>kenaikan_gaji_berkala/pilih_kgb/"+id, function( data ) {
  	  $('#select_id_pp').val(data['id_pp']);
  	  $('#select_id_golongan').val(data['id_golongan']);
  	  $('#id_pp').val(data['id_pp']);
  	  $('#id_golongan').val(data['id_golongan']);
  	  $('#mkg').val(data['mkg']);
  	  $('#gaji_pokok').val(data['gaji_pokok']);
    	main_wizard.wizard('next');
	  }, "json");
  }

  function pilih_kgb_lama(id) {
  	$('[href="#isi"]').tab('show');
  	if (id==null) {
  		$('#select_id_pp_lama').attr('disabled',false);
  		$('#select_id_golongan_lama').attr('disabled',false);
  		$('#id_pp_lama').attr('disabled',true);
  		$('#id_golongan_lama').attr('disabled',true);
  		$('#id_pp_lama').attr('required',false);
  		$('#id_golongan_lama').attr('required',false);
  		$('#mkg_lama').attr('readonly',false);
  		$('#gaji_pokok_lama').attr('readonly',false);
  	} else {
  		$('#select_id_pp_lama').attr('disabled',true);
  		$('#select_id_golongan_lama').attr('disabled',true);
  		$('#id_pp_lama').attr('disabled',false);
  		$('#id_golongan_lama').attr('disabled',false);
  		$('#id_pp_lama').attr('required',true);
  		$('#id_golongan_lama').attr('required',true);
  		$('#mkg_lama').attr('readonly',true);
  		$('#gaji_pokok_lama').attr('readonly',true);
	    $.post( "<?=base_url()?>kenaikan_gaji_berkala/pilih_kgb/"+id, function( data ) {
  		  $('#select_id_pp_lama').val(data['id_pp']);
  		  $('#select_id_golongan_lama').val(data['id_golongan']);
  		  $('#id_pp_lama').val(data['id_pp']);
  		  $('#id_golongan_lama').val(data['id_golongan']);
  		  $('#mkg_lama').val(data['mkg']);
  		  $('#gaji_pokok_lama').val(data['gaji_pokok']);
  		}, "json");
  	}
  }

  function pilih_riwayat(id=0) {
    $('#id_riwayat_kgb_lama').val(id);
    <?php foreach ($riwayat_kgb as $row): ?>
      $('#label-riwayat-dipilih-<?=$row->id_riwayat_kgb?>').addClass('hide');
    <?php endforeach; ?>
  	if (id==0) {
  		$('#add_kgb_lama').removeClass('hide');
  		$('[href="#gaji"]').tab('show');

      $('[name="nomor_kgb_lama"]').attr('required',true);
      $('[name="tanggal_buat_lama"]').attr('required',true);
      $('[name="terhitung_mulai_tanggal_lama"]').attr('required',true);
      $('[name="id_pp_lama"]').attr('required',true);
      $('[name="id_golongan_lama"]').attr('required',true);
      $('[name="mkg_lama"]').attr('required',true);
      $('[name="gaji_pokok_lama"]').attr('required',true);
  	} else {
  		$('#add_kgb_lama').addClass('hide');
      $('#label-riwayat-dipilih-'+id).removeClass('hide');

      $('[name="nomor_kgb_lama"]').attr('required',false);
      $('[name="tanggal_buat_lama"]').attr('required',false);
      $('[name="terhitung_mulai_tanggal_lama"]').attr('required',false);
      $('[name="id_pp_lama"]').attr('required',false);
      $('[name="id_golongan_lama"]').attr('required',false);
      $('[name="mkg_lama"]').attr('required',false);
      $('[name="gaji_pokok_lama"]').attr('required',false);
  	}
  }

  function hapus_kgb(id) {
  	swal({   
        title: "Are you sure?",   
        text: "You will not be able to recover this imaginary file!",   
        type: "warning",   
        showCancelButton: true,   
        confirmButtonColor: "#DD6B55",   
        confirmButtonText: "Yes, delete it!",   
        closeOnConfirm: false 
    }, function(){   
        swal("Deleted!", "Your imaginary file has been deleted.", "success"); 
        window.location.href = "<?=base_url()?>kenaikan_gaji_berkala/hapus_kgb/"+id+"/<?=$id_pegawai?>";
    });
  }

</script>

<script type="text/javascript">
    (function() {
        main_wizard = $('#main-wizard-kgb').wizard({
            onFinish: function() {;
                var form = document.getElementById('form-input-kgb');
                for(var i=0; i < form.elements.length; i++){
                  if(form.elements[i].value === '' && form.elements[i].hasAttribute('required')){
                    swal("Maaf!", "Masih ada form yang kosong.\nField : "+form.elements[i].name,"error");
                    return false;
                  }
                }
                swal("Finish!", "Surat sudah dapat dicetak.");
                $('#riwayat-kgb').removeClass('hide');
                $('#wizard-kgb').addClass('hide');
                $('#form-input-kgb').submit();
            }
        });
    })();
    </script>