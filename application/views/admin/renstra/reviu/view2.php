<style type="text/css">
  .alert-default{
    border: solid 1px #6003c8;
    color: #6003c8;
    font-weight: 400;
  }
  .switchery > span {
    margin-left: 20px;
    margin-right: 20px;
    line-height: 28px;
    color: #6003c8;
    text-align: left !important;
  }
  .switchery small i{
    color: #6003c8;
    line-height: 28px;
    margin-left: 8px;
  }
</style>
<div class="container-fluid">


  <div class="row bg-title">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
      <h4 class="page-title">Detail Reviu</h4> </div>
      <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
        <ol class="breadcrumb">
          <li>RENSTRA</li>        
          <li class="active">Reviu</li>       
          <li>Detail</li>       
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
                <center><img style="width: 80%" src="<?=base_url()?>data/logo/skpd/<?= ($detail->logo_skpd=='') ? 'sumedang.png' : $detail->logo_skpd  ?>" alt="user" class="img-circle"/>   </center>
              </div>
              <div class="col-md-9">
                <div class="panel panel-primary">
                  <div class="panel-heading"> <?=$detail->nama_skpd?>
                  <div class="pull-right"><a href="#" data-perform="panel-collapse"><i class="ti-minus"></i></a>  </div>
                </div>
                <div class="panel-wrapper collapse in" aria-expanded="true">
                  <div class="panel-body">
                    <table class="table">
                      <tr><td style="width: 120px;">Nama Kepala </td><td>:</td><td> <strong>(?)</strong></tr>
                        <tr><td style="width: 120px;">Alamat SKPD </td><td>:</td><td> <strong><?=$detail->alamat_skpd?></strong></tr>
                          <tr><td style="width: 120px;">Email/tlp </td><td>:</td><td> <strong><?=$detail->email_skpd?> / <?=$detail->telepon_skpd?></strong>
                          </table>
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
            <div class="panel panel-primary">
              <div class="panel-wrapper collapse in" aria-expanded="true">
                <div class="panel-body">
                  <div class="col-md-3 text-center b-r" style="min-height:120px;">
                    <br><br>
                    <center><img style="width: 80%" src="<?php echo base_url()."data/logo/bnpt.png" ;?>" alt="user" class="img-circle"/>   </center>
                  </div>
                  <div class="col-md-9">
                    <p class="text-center text-primary"><strong>Total Sasaran Strategis</strong></p>
                    <hr>
                    <div class="col-md-6 text-center b-r">
                      <h3 class="box-title m-b-0">8</h3>
                      Sasaran
                    </div>
                    <div class="col-md-6 text-center ">
                      <h3 class="box-title m-b-0">8</h3>
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
                    <p class="text-center text-primary"><strong>Total Sasaran Program</strong></p>
                    <hr>
                    <div class="col-md-6 text-center b-r">
                      <h3 class="box-title m-b-0">8</h3>
                      Sasaran
                    </div>
                    <div class="col-md-6 text-center ">
                      <h3 class="box-title m-b-0">8</h3>
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
                    <p class="text-center text-primary"><strong>Total Sasaran Kegiatan</strong></p>
                    <hr>
                    <div class="col-md-6 text-center b-r">
                      <h3 class="box-title m-b-0">8</h3>
                      Sasaran
                    </div>
                    <div class="col-md-6 text-center ">
                      <h3 class="box-title m-b-0">8</h3>
                      Indikator
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-sm-9">
            <div class="row">
              <div class="col-md-4">
                <div class="white-box-no-padding">
                  <div class="row">
                    <div class="col-md-3 text-center b-r" style="padding-left:15px;min-height:120px;">
                      <br><br>
                      <i style="font-size: 50px" class="fa fa-clock-o text-purple"></i>
                    </div>
                    <div class="col-md-9" style="padding-top: 10px">
                      <p class="text-center text-purple"><strong>BELUM DIRIVIU</strong></p>
                      <hr class="no-margin">
                      <div class="col-md-12 text-center ">
                        <h3 class="box-title m-b-0" style="font-weight: bold;">8</h3>
                        Indikator
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="white-box-no-padding">
                  <div class="row">
                    <div class="col-md-3 text-center b-r" style="padding-left:15px;min-height:120px;">
                      <br><br>
                      <i style="font-size: 50px" class="fa fa-check-circle text-purple"></i>
                    </div>
                    <div class="col-md-9" style="padding-top: 10px">
                      <p class="text-center text-purple"><strong>DISETUJUI</strong></p>
                      <hr class="no-margin">
                      <div class="col-md-12 text-center ">
                        <h3 class="box-title m-b-0" style="font-weight: bold;">8</h3>
                        Indikator
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="white-box-no-padding">
                  <div class="row">
                    <div class="col-md-3 text-center b-r" style="padding-left:15px;min-height:120px;">
                      <br><br>
                      <i style="font-size: 50px" class="fa fa-close text-purple"></i>
                    </div>
                    <div class="col-md-9" style="padding-top: 10px">
                      <p class="text-center text-purple"><strong>DITOLAK</strong></p>
                      <hr class="no-margin">
                      <div class="col-md-12 text-center ">
                        <h3 class="box-title m-b-0" style="font-weight: bold;">8</h3>
                        Indikator
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <?php 
            $jenis = array('ss'=>'sasaran_strategis','sp'=>'sasaran_program','sk'=>'sasaran_kegiatan');
            foreach ($a_jenis as $key => $value) {
              $name = $this->renstra_realisasi_model->name($key);
              ?>
              <div class="panel panel-primary">
                <div class="panel-heading">
                  <?=normal_string($value)?>
                </div>
                <div class="panel-wrapper collapse in" aria-expanded="true">
                  <div class="panel-body">
                    <div class="row">
                      <div class="table-responsive">
                        <table class="table color-table muted-table">
                          <thead>
                            <tr>
                              <?= ($key=='ss') ? '<th>IKU RPJMD</th>': '' ?>
                              <th>Nama Sasaran</th>
                              <th>Prespektif</th>
                              <th>Jumlah Indikator</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php

                            if(!empty($$value)){
                              foreach($$value as $ss){
                                if($key=='ss'){
                                  $iku_sasaran_rpjmd = $this->sasaran_rpjmd_model->get_indikator_by_id($ss->id_iku_sasaran_rpjmd);
                                }
                                $id_sasaran = $name['cSasaran'];
                                $nama_sasaran = $name['tSasaran'];
                                $iku = $this->renstra_realisasi_model->get_iku($key,$ss->$id_sasaran);
                                ?>
                                <tr>
                                  <?= ($key=='ss') ? '<td>'.$iku_sasaran_rpjmd->iku_sasaran_rpjmd.'</td>': '' ?>
                                  <td><?=$ss->$nama_sasaran?></td>
                                  <td>Customer Perspective</td>
                                  <td><?=count($iku)?></td>

                                </tr>
                              <?php }
                            }else{
                              ?>
                              <tr>
                                <td colspan="4">
                                  <div class="alert alert-default"><i class="ti-alert"></i> Belum ada <?=normal_string($value)?></div></td>

                                </tr>
                                <?php
                              } ?>
                            </tbody>
                          </table>
                        </div>
                      </div>
                      <?php 

                      $no=1; 
                      foreach($$value as $ss){
                        $id_sasaran = $name['cSasaran'];
                        $nama_sasaran = $name['tSasaran'];
                        $iku = $this->renstra_realisasi_model->get_iku($key,$ss->$id_sasaran);
                        ?>
                        <div class="row" style="margin-top: 10px">
                         <p><strong>Sasaran <?=$no?>.</strong> <?=$ss->$nama_sasaran?> </p>
                         <div class="table-responsive">
                          <table class="table color-table muted-table">
                            <thead>
                              <tr>
                                <th>Kode</th>
                                <th>Indikator</th>
                                <th>Satuan</th>
                                <th>Target 2019</th>
                                <th>Target 2020</th>
                                <th>Target 2021</th>
                                <th>Target 2022</th>
                                <th>Target 2023</th>
                                <th>Unit Penanggung Jawab</th>
                                <th>Status Reviu</th>
                                <th>Opsi</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php 
                              if(!empty($iku)){
                                $nn=1;
                                foreach($iku as $i){
                                  $id_iku = $name['cIku'];
                                  $nama_iku = $name['tIku'];
                                  $unit_kerja = $this->renstra_realisasi_model->get_unit_iku($key,$i->$id_iku);
                                  $status_reviu = $this->renstra_reviu_model->get_status_reviu($key,$i->$id_iku);
                                  $a_unit_kerja = array();
                                  foreach($unit_kerja as $u){
                                    $a_unit_kerja[] = $u->nama_unit_kerja;
                                  }
                                  $unit_kerja = implode(', ', $a_unit_kerja);
                                  ?>
                                  <tr>
                                    <td><?=$no.'.'.$nn?></td>
                                    <td><?=$i->$nama_iku?></td>
                                    <td><?=$i->satuan?></td> 
                                    <?php 
                                    for ($ii=2019; $ii <= 2023 ; $ii++) { 
                                      $s_target = 'target_'.$ii;
                                      $target = $i->$s_target;
                                      ?>
                                      <td><?=$target?></td>
                                      <?php
                                    }
                                    ?>
                                    <td><?=$unit_kerja?> </td>
                                    <td>
                                      <i class="<?=status_reviu($status_reviu)?>"></i></td>
                                    <td><a href="javascript:void(0)" onclick="reviuIndikator('<?=$key?>',<?=$i->$id_iku?>)" class="btn btn-primary" style="color:white;"><i class="ti-eye"></i> Reviu</a></td>
                                  </tr>
                                  <?php $nn++; }
                                }else{
                                  ?>
                                  <tr>
                                    <td colspan="20">
                                      <div class="alert alert-default"><i class="ti-alert"></i> Belum ada indikator</div></td>
                                    </tr>
                                    <?php
                                  } ?>
                                </tbody>
                              </table>
                            </div>
                          </div>
                          <?php $no++; } ?>
                        </div>
                      </div>
                    </div>

                  <?php } ?>
                </div>
              </div>
            </div>


            <!-- MODAL REVIU !-->

            <div id="modalReviu" class="modal fade bs-example-modal-md" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <div class="panel panel-primary">
                    <div class="panel-heading">
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i style="color: #fff" class="ti-close"></i></button>
                      <h4 class="modal-title" id="myLargeModalLabel" style="color:white;">Reviu</h4>
                    </div>
                  </div>
                  <div class="modal-body">
                    <form method="POST" id="formReviu">
                      <input type="hidden" name="id_iku" id="id_iku">
                      <input type="hidden" name="jenis" id="jenis">
                      <table class="table table-bordered">
                        <thead>
                          <tr class="info">
                            <th></th>
                            <th width="50%">Penilaian</th>
                            <th style="text-align: center">Opsi</th>
                            <th style="text-align: center">Catatan</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>
                              <div class="word-box">
                                S
                              </div>
                            </td>
                            <td style="vertical-align: middle;">Definitif (tidak normatif, tidak bermakna ganda, relevan terhadap SS)</td>
                            <td style="vertical-align: middle;">
                              <input type="checkbox" onchange="asw()" class="js-switch2" value="1" data-color="#6003c8" id="status_s" name="status_s"/>

                            </td>
                            <td style="vertical-align: middle;"><input type="text" class="form-control" placeholder="Masukkan Catatan" name="catatan_s"></td>
                          </tr>
                          <tr>
                            <td>
                              <div class="word-box">
                                M
                              </div>
                            </td>
                            <td style="vertical-align: middle;">Dapat diukur dengan jelas dan memiliki satuan persen (%)</td>
                            <td style="vertical-align: middle;">
                              <input type="checkbox"  class="js-switch2" value="1" data-color="#6003c8"  id="status_m" name="status_m" />
                            </td>
                            <td style="vertical-align: middle;"><input type="text" class="form-control" placeholder="Masukkan Catatan" name="catatan_m"></td>
                          </tr>
                          <tr>
                            <td>
                              <div class="word-box">
                                A
                              </div>
                            </td>
                            <td style="vertical-align: middle;">Disepakati oleh Iku atasannya</td>
                            <td style="vertical-align: middle;">
                              <input type="checkbox"  class="js-switch2" value="1" data-color="#6003c8"  id="status_a" name="status_a"/>
                            </td>
                            <td style="vertical-align: middle;"><input type="text" class="form-control" placeholder="Masukkan Catatan" name="catatan_a"></td>
                          </tr>
                          <tr>
                            <td>
                              <div class="word-box">
                                R
                              </div>
                            </td>
                            <td style="vertical-align: middle;">Ukuran Iku dapat dicapai dan menantang</td>
                            <td style="vertical-align: middle;">
                              <input type="checkbox"  class="js-switch2" value="1" id="status_r" name="status_r" data-color="#6003c8" />
                            </td>
                            <td style="vertical-align: middle;"><input type="text" class="form-control" placeholder="Masukkan Catatan" name="catatan_r"></td>
                          </tr>
                          <tr>
                            <td>
                              <div class="word-box">
                                T
                              </div>
                            </td>
                            <td style="vertical-align: middle;">Memiliki batas capaian</td>
                            <td style="vertical-align: middle;">
                              <input type="checkbox"  class="js-switch2" value="1" id="status_t" name="status_t" data-color="#6003c8" />
                            </td>
                            <td style="vertical-align: middle;"><input type="text" class="form-control" placeholder="Masukkan Catatan" name="catatan_t"></td>
                          </tr>
                          <tr>
                            <td>
                              <div class="word-box">
                                C
                              </div>
                            </td>
                            <td style="vertical-align: middle;">Target Iku disesuaikan dengan target organisasi dan selalu disempurnakan dari tahun ke tahun</td>
                            <td style="vertical-align: middle;">
                              <input type="checkbox" id="status_c" name="status_c"  class="js-switch2" value="1" data-color="#6003c8" />
                            </td>
                            <td style="vertical-align: middle;"><input type="text" class="form-control" placeholder="Masukkan Catatan" name="catatan_c"></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default waves-effect text-left" data-dismiss="modal">Batal</button>
                      <button type="submit" class="btn btn-primary waves-effect text-left">Simpan</button>
                    </div>
                  </form>
                </div>
                <!-- /.modal-content -->
              </div>
              <!-- /.modal-dialog -->
            </div>

            <!-- AKHIR MODAL REVIU -->

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


            <script type="text/javascript">
              function reviuIndikator(jenis,id_iku){
                $('#formReviu')[0].reset(); 
                $.ajax({
                  url : "<?= base_url();?>renstra_reviu/get_iku/"+jenis+"/"+id_iku,
                  type: "GET",
                  dataType: "JSON",
                  success: function(data)
                  {
                    var arr = ['s','m','a','r','t','c'];
                    arr.forEach(function(item, index, array) {
                      var status = eval('data.status_'+item);
                      var catatan = eval('data.catatan_'+item);
                      if(status==1){
                        $('#status_'+item).prop('checked',false);
                        $('#status_'+item).next().trigger('click');
                      }else{
                        $('#status_'+item).prop('checked',true);
                        $('#status_'+item).next().trigger('click');
                      }
                      $('[name="catatan_'+item+'"]').val(catatan);
                    });
                    var id_iku = eval('data.id_iku_'+jenis+'_renstra');
                      $('#formReviu #id_iku').val(id_iku);
                      $('#formReviu #jenis').val(jenis);
                    $('#modalReviu').modal('show'); 

                  },
                  error: function (jqXHR, textStatus, errorThrown)
                  {
                    alert("Gagal mendapatkan data");
                  }
                });

              }
            </script>