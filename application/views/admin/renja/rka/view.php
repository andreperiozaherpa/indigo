
        <div class="container-fluid">

	<div class="row bg-title">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title">Detail Rencana Kerja SKPD</h4> </div>
			<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
				<ol class="breadcrumb">
					<li><a href="<?=base_url('renja_rka')?>">Rencana Kerja</a></li>				
          <li class="active">Detail</li>       
        </ol>
			</div>
			<!-- /.col-lg-12 -->
		</div>


<div class="row">
	<div class="col-md-12">
		<div class="white-box">
			<div class="row">
        <form method="POST">
        <div class="col-md-3 b-r">
          <center><img style="width: 80%" src="<?php echo base_url()."data/logo/bnpt.png" ;?>" alt="user" class="img-circle"/>   </center>
        </div>
        <div class="col-md-9">
          <div class="panel panel-primary">
            <div class="panel-heading"> <?=$detail->nama_skpd?>
                <div class="pull-right"><a href="#" data-perform="panel-collapse"><i class="ti-minus"></i></a>  </div>
            </div>
            <div class="panel-wrapper collapse in" aria-expanded="true">
                <div class="panel-body">
                  <div class="table-responsive">
                    <table class="table">
                        <tr><td style="width: 120px;">Nama Kepala </td><td>:</td><td> <strong><?=$kepala_skpd->nama_lengkap?></strong></tr>
                        <tr><td style="width: 120px;">Alamat SKPD </td><td>:</td><td> <strong><?=$detail->alamat_skpd?></strong></tr>
                        <tr><td style="width: 120px;">Email/tlp </td><td>:</td><td> <strong><?=$detail->email_skpd?> / <?=$detail->telepon_skpd?></strong>
                    </table>
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
<div class="row">
  <div class="col-sm-3">
    <div class="panel panel-primary">
        <div class="panel-heading">
        </div>
        <div class="panel-wrapper collapse in" aria-expanded="true">
            <div class="panel-body">
              <div class="steamline">
                  <div class="sl-item">
                      <div class="sl-left"><button type="button" class="btn btn-primary btn-circle  "></button></div>
                      <div class="sl-right">
                          <div class="m-l-20"><b>VISI</b>
                              <?php 
                                $perencanaan_visi = array(); 
                                foreach ($perencanaan as $k => $p){
                                  if(!array_key_exists($p['id_visi'], $perencanaan_visi)){
                                    $perencanaan_visi[$p['id_visi']]['name'] = $p['visi'];
                                    $perencanaan_visi[$p['id_visi']]['class'] = " perencanaan".$k;
                                  } else {
                                    $perencanaan_visi[$p['id_visi']]['class'] .= " perencanaan".$k;
                                  }
                                }
                              ?>
                              <?php $n=1; foreach ($perencanaan_visi as $value): ?>
                                <p class="<?=$value['class']?>"><?=count($perencanaan_visi)>1 ? "{$n}. " : "";?><?=$value['name']?></p>
                              <?php $n++; endforeach ?>
                          </div>
                      </div>
                  </div>
                  <hr>
                  <div class="sl-item">
                      <div class="sl-left"><button type="button" class="btn btn-primary btn-circle  "></button></div>
                      <div class="sl-right">
                          <div class="m-l-20"><b>MISI</b>
                              <?php 
                                $perencanaan_misi = array(); 
                                foreach ($perencanaan as $k => $p){
                                  if(!array_key_exists($p['id_misi'], $perencanaan_misi)){
                                    $perencanaan_misi[$p['id_misi']]['name'] = $p['misi'];
                                    $perencanaan_misi[$p['id_misi']]['class'] = " perencanaan".$k;
                                  } else {
                                    $perencanaan_misi[$p['id_misi']]['class'] .= " perencanaan".$k;
                                  }
                                }
                              ?>
                              <?php $n=1; foreach ($perencanaan_misi as $value): ?>
                                <p class="<?=$value['class']?>"><?=count($perencanaan_misi)>1 ? "{$n}. " : "";?><?=$value['name']?></p>
                              <?php $n++; endforeach ?>
                          </div>
                      </div>
                  </div>
                  <hr>
                  <div class="sl-item">
                      <div class="sl-left"><button type="button" class="btn btn-primary btn-circle  "></button></div>
                      <div class="sl-right">
                          <div class="m-l-20"><b>TUJUAN</b>
                              <?php 
                                $perencanaan_tujuan = array(); 
                                foreach ($perencanaan as $k => $p){
                                  if(!array_key_exists($p['id_tujuan'], $perencanaan_tujuan)){
                                    $perencanaan_tujuan[$p['id_tujuan']]['name'] = $p['tujuan'];
                                    $perencanaan_tujuan[$p['id_tujuan']]['class'] = " perencanaan".$k;
                                  } else {
                                    $perencanaan_tujuan[$p['id_tujuan']]['class'] .= " perencanaan".$k;
                                  }
                                }
                              ?>
                              <?php $n=1; foreach ($perencanaan_tujuan as $value): ?>
                                <p class="<?=$value['class']?>"><?=count($perencanaan_tujuan)>1 ? "{$n}. " : "";?><?=$value['name']?></p>
                              <?php $n++; endforeach ?>
                          </div>
                      </div>
                  </div>
                  <hr>
                  <div class="sl-item">
                      <div class="sl-left"><button type="button" class="btn btn-primary btn-circle  "></button></div>
                      <div class="sl-right">
                          <div class="m-l-20"><b>SASARAN</b>
                              <?php 
                                $perencanaan_sasaran_rpjmd = array(); 
                                foreach ($perencanaan as $k => $p){
                                  if(!array_key_exists($p['id_sasaran_rpjmd'], $perencanaan_sasaran_rpjmd)){
                                    $perencanaan_sasaran_rpjmd[$p['id_sasaran_rpjmd']]['name'] = $p['sasaran_rpjmd'];
                                    $perencanaan_sasaran_rpjmd[$p['id_sasaran_rpjmd']]['class'] = " perencanaan".$k;
                                  } else {
                                    $perencanaan_sasaran_rpjmd[$p['id_sasaran_rpjmd']]['class'] .= " perencanaan".$k;
                                  }
                                }
                              ?>
                              <?php $n=1; foreach ($perencanaan_sasaran_rpjmd as $value): ?>
                                <p class="<?=$value['class']?>"><?=count($perencanaan_sasaran_rpjmd)>1 ? "{$n}. " : "";?><?=$value['name']?></p>
                              <?php $n++; endforeach ?>

                          </div>
                      </div>
                  </div>
                  <hr>
                  <div class="sl-item">
                      <div class="sl-left"><button type="button" class="btn btn-primary btn-circle  "></button></div>
                      <div class="sl-right">
                          <div class="m-l-20"><b>IKU</b>
                              <?php 
                                $perencanaan_iku_sasaran_rpjmd = array(); 
                                foreach ($perencanaan as $k => $p){
                                  if(!array_key_exists($p['id_iku_sasaran_rpjmd'], $perencanaan_iku_sasaran_rpjmd)){
                                    $perencanaan_iku_sasaran_rpjmd[$p['id_iku_sasaran_rpjmd']]['name'] = $p['iku_sasaran_rpjmd'];
                                    $perencanaan_iku_sasaran_rpjmd[$p['id_iku_sasaran_rpjmd']]['class'] = " perencanaan".$k;
                                  } else {
                                    $perencanaan_iku_sasaran_rpjmd[$p['id_iku_sasaran_rpjmd']]['class'] .= " perencanaan".$k;
                                  }
                                }
                              ?>
                              <?php $n=1; foreach ($perencanaan_iku_sasaran_rpjmd as $value): ?>
                                <p class="<?=$value['class']?>"><?=count($perencanaan_iku_sasaran_rpjmd)>1 ? "{$n}. " : "";?><?=$value['name']?></p>
                              <?php $n++; endforeach ?>
                          </div>
                      </div>
                  </div>
                  <hr>
              </div>
            </div>
        </div>
    </div>
             <?php
              $j_ss = $this->renja_rka_model->get_total_ss($detail->id_skpd);
              $iku_ss = $this->renja_rka_model->get_total_iku_ss($detail->id_skpd);

              $j_sp = $this->renja_rka_model->get_total_sp($detail->id_skpd);
              $iku_sp = $this->renja_rka_model->get_total_iku_sp($detail->id_skpd);

              $j_sk = $this->renja_rka_model->get_total_sk($detail->id_skpd);
              $iku_sk = $this->renja_rka_model->get_total_iku_sk($detail->id_skpd);

              $j_iku = $this->renja_rka_model->get_total_iku($detail->id_skpd);


              ?>

    <div class="panel panel-primary">
        <div class="panel-wrapper collapse in" aria-expanded="true">
            <div class="panel-body">
              <div class="col-md-3 text-center b-r" style="min-height:120px;">
                <br><br>
                <center><img style="width: 80%" src="<?php echo base_url()."data/logo/bnpt.png" ;?>" alt="user" class="img-circle"/>   </center>
              </div>
              <div class="col-md-9">
                <p class="text-center text-primary"><strong>Total Sasaran Strategis Renstra</strong></p>
                <hr>
                <div class="col-md-6 text-center b-r">
                  <h3 class="box-title m-b-0"><?=$j_ss?></h3>
                  Sasaran
                </div>
                <div class="col-md-6 text-center ">
                  <h3 class="box-title m-b-0"><?=$iku_ss?></h3>
                  Indikator
                </div>
              </div>
            </div>
        </div>
    </div>
    <div class="panel panel-primary">
        <div class="panel-wrapper collapse in" aria-expanded="true">
            <div class="panel-body">
              <div class="col-md-3 text-center b-r" style="min-height:120px;">
                <br><br>
                <center><img style="width: 80%" src="<?php echo base_url()."data/logo/bnpt.png" ;?>" alt="user" class="img-circle"/>   </center>
              </div>
              <div class="col-md-9">
                <p class="text-center text-primary"><strong>Total Sasaran Program Renstra</strong></p>
                <hr>
                <div class="col-md-6 text-center b-r">
                  <h3 class="box-title m-b-0"><?=$j_sp?></h3>
                  Sasaran
                </div>
                <div class="col-md-6 text-center ">
                  <h3 class="box-title m-b-0"><?=$iku_sp?></h3>
                  Indikator
                </div>
              </div>
            </div>
        </div>
    </div>
    <div class="panel panel-primary">
        <div class="panel-wrapper collapse in" aria-expanded="true">
            <div class="panel-body">
              <div class="col-md-3 text-center b-r" style="min-height:120px;">
                <br><br>
                <center><img style="width: 80%" src="<?php echo base_url()."data/logo/bnpt.png" ;?>" alt="user" class="img-circle"/>   </center>
              </div>
              <div class="col-md-9">
                <p class="text-center text-primary"><strong>Total Sasaran Kegiatan Renstra</strong></p>
                <hr>
                <div class="col-md-6 text-center b-r">
                  <h3 class="box-title m-b-0"><?=$j_sk?></h3>
                  Sasaran
                </div>
                <div class="col-md-6 text-center ">
                  <h3 class="box-title m-b-0"><?=$iku_sk?></h3>
                  Indikator
                </div>
              </div>
            </div>
        </div>
    </div>
  </div>
  <div class="col-sm-9">
  <!-- <?=var_dump($rencana_kerja)?> -->
    <?php foreach ($rencana_kerja as $tahun => $rk) {
      if($tahun==date('Y')){
        $status = '<span class="label label-info m-l-5 pull-right">Aktif</span>';
      }else{
        $status = '<span class="label label-danger m-l-5 pull-right">Nonaktif</span>';
      }

      $total_pk = $rk->total_ss+$rk->total_sp+$rk->total_sk;
      $total_anggaran = $rk->anggaran_ss+$rk->anggaran_sp+$rk->anggaran_sk;
      $total_renaksi = $rk->renaksi_ss+$rk->renaksi_sp+$rk->renaksi_sk;
      ?>
    <a href="<?php echo base_url('renja_rka/detail/'.$detail->id_skpd.'/'.$tahun);?>" style="color:#636e72">
      <div class="panel panel-primary">
          <div class="panel-heading">
            Rencana Kerja <?=$tahun?> <?=$status?>
          </div>
          <div class="panel-wrapper collapse in" aria-expanded="true">
              <div class="panel-body">
                <div class="col-sm-2 b-r text-center" style="max-height:110px;">
                    <div data-label="<?=round($grafik_capaian[$tahun],1)?>%" class="css-bar css-bar-<?=roundfive($grafik_capaian[$tahun])?> css-bar-lg"></div>
                </div>
                <div class="col-sm-2 b-r text-center">
                  <br>
                  <h3 class="panel-title"><?=$total_pk?></h3>
                  Perubahan PK
                  <br>
                  &nbsp
                </div>

                <div class="col-sm-2 b-r text-center">
                  <br>
                  <h3 class="panel-title"><?=$total_renaksi?></h3>
                  Rencana Aksi
                  <br>
                  &nbsp
                </div>
              
                <div class="col-sm-6 b-r">
                  <div class="col-sm-12 b-b">
                    <div class="col-sm-4 text-center">
                      <h3 class="panel-title"><?=$rk->total_ss?></h3>
                      Indikator SS
                    </div>
                    
                    <div class="col-sm-4  text-center">
                      <h3 class="panel-title"><?=$rk->total_sp?></h3>
                      Indikator SP
                    </div>
                    <div class="col-sm-4 text-center">
                      <h3 class="panel-title "><?=$rk->total_sk?></h3>
                      Indikator SK
                    </div>
                  </div>
                  <div class="col-sm-12 text-center">
                    <h3 class="panel-title" style="padding-top:5px;">Rp<?=number_format($total_anggaran,2)?></h3>
                    total anggaran
                  </div>
                </div>
              </div>
          </div>
      </div>
    </a>
  <?php } ?>
  </div>
</div>

<script type="text/javascript">
  
                                                                      function hoverByClass(classname,colorover,colorout="transparent"){
                                                                        var elms=document.getElementsByClassName(classname);
                                                                        for(var i=0;i<elms.length;i++){
                                                                          elms[i].onmouseover = function(){
                                                                            for(var k=0;k<elms.length;k++){
                                                                              elms[k].style.backgroundColor=colorover;
                                                                            }
                                                                          };
                                                                          elms[i].onmouseout = function(){
                                                                            for(var k=0;k<elms.length;k++){
                                                                              elms[k].style.backgroundColor=colorout;
                                                                            }
                                                                          };
                                                                        }
                                                                      }
                                                                      <?php foreach ($perencanaan as $key => $value): ?>
                                                                        hoverByClass("perencanaan<?=$key?>","yellow");
                                                                      <?php endforeach ?>
</script>