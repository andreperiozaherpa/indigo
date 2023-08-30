
<div class="container-fluid">

	<div class="row bg-title">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title">Ren. Strategis</h4> </div>
			<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
				<ol class="breadcrumb">
					<li class="active">Ren. Strategis</li>				</ol>
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
                    <tr><td style="width: 120px;">Nama Kepala </td><td>:</td><td> <strong><?=$kepala_skpd->nama_lengkap?></strong></tr>
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
                      <div class="m-l-20"><b>IKU RPJMD</b>
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
          $j_ss = $this->renstra_perencanaan_model->get_total_ss($detail->id_skpd);
          $iku_ss = $this->renstra_perencanaan_model->get_total_iku_ss($detail->id_skpd);

          $j_sp = $this->renstra_perencanaan_model->get_total_sp($detail->id_skpd);
          $iku_sp = $this->renstra_perencanaan_model->get_total_iku_sp($detail->id_skpd);

          $j_sk = $this->renstra_perencanaan_model->get_total_sk($detail->id_skpd);
          $iku_sk = $this->renstra_perencanaan_model->get_total_iku_sk($detail->id_skpd);




          ?>

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
                  <p class="text-center text-primary"><strong>Total Sasaran Program</strong></p>
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
                  <p class="text-center text-primary"><strong>Total Sasaran Kegiatan</strong></p>
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




          <!-- sasaran strategis -->
          <div class="panel panel-primary">
            <div class="panel-heading">

              Sasaran Strategis
            </div>
            <div class="panel-wrapper collapse in" aria-expanded="true">
              <div class="panel-body">
                <div class="row">

                  <div class="col-md-12">
                    <button type="button" class="btn btn-primary" onclick="new_sasaran_strategis_renstra();">Tambah Sasaran Strategis</button>
                    <!-- modal tambah sasaran strategis -->
                    <div id="tambahSasaran" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                      <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                          <div class="panel-heading">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h4 class="modal-title" id="data-title-tambahSasaran" style="color:white;">Tambah Sasaran Strategis</h4>
                          </div>
                          <div class="modal-body">
                            <form class="form-horizontal" id="data-form-tambahSasaran" action="#!">
                              <div class="form-group">
                                <label class="col-sm-12">IKU</label>
                                <div class="col-sm-12">
                                  <select id="data-id_iku_sasaran_rpjmd" name="id_iku_sasaran_rpjmd" class="form-control select2" required>
                                    <?php foreach ($perencanaan as $key => $value): ?>
                                      <option value="<?=$value['id_iku_sasaran_rpjmd']?>"><?=$value['iku_sasaran_rpjmd']?></option>
                                    <?php endforeach ?>
                                  </select>
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="col-md-12">NAMA SASARAN</label>
                                <div class="col-md-12">
                                  <input id="data-sasaran_strategis_renstra" name="sasaran_strategis_renstra" type="text" class="form-control" placeholder="placeholder" required>
                                </div>
                              </div>
                              <button type="submit" id="data-form-submit-tambahSasaran" hidden></button>
                            </form>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Batal</button>
                            <button id="data-button-tambahSasaran" type="button" class="btn btn-primary waves-effect text-left" onclick="add_sasaran_strategis_renstra();">Kirim</button>
                          </div>
                        </div>
                        <!-- /.modal-content -->
                      </div>
                      <!-- /.modal-dialog -->
                    </div>
                    <?php if(count($sasaran_strategis)>0) :?>
                      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahIndikator1">Tambah Indikator</button>
                      <!-- modal tambah indikator sasaran strategis -->
                      <div id="tambahIndikator1" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel2" aria-hidden="true" style="display: none;">
                        <div class="modal-dialog modal-lg">
                          <div class="modal-content">
                            <div class="panel-heading">
                              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                              <h4 class="modal-title" id="myLargeModalLabel2" style="color:white;">Tambah Indikator Strategis</h4>
                            </div>
                            <div class="modal-body">

                              <form class="form-horizontal" id="data-form-tambahIndikator1" action="#!">
                                <div class="form-group">
                                  <label class="col-sm-12">SASARAN</label>
                                  <div class="col-sm-12">
                                    <select id="data-id_sasaran_strategis_renstra" name="id_sasaran_strategis_renstra" class="form-control select2" required>
                                      <?php foreach ($sasaran_strategis as $key => $value): ?>
                                        <option value="<?=$value['id_sasaran_strategis_renstra']?>"><?=$value['sasaran_strategis_renstra']?></option>
                                      <?php endforeach ?>
                                    </select>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="col-md-12">INDIKATOR KERJA UTAMA</label>
                                  <div class="col-md-12">
                                    <input id="data-iku_ss_renstra" name="iku_ss_renstra" type="text" class="form-control" placeholder="placeholder" required>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="col-md-12">DESKRIPSI</label>
                                  <div class="col-md-12">
                                    <textarea name="deskripsi" class="form-control" rows="5"></textarea>
                                  </div>
                                </div>
                                
                                <div class="form-group">
                                  <div class="col-md-4">
                                    <label class="col-sm-12">Satuan Pengukuran</label>
                                    <div class="col-sm-12">
                                      <select name="id_satuan" class="form-control select2" required>
                                        <?php foreach ($ref_satuan as $key => $value): ?>
                                          <option value="<?=$value->id_satuan?>"><?=$value->satuan?></option>
                                        <?php endforeach ?>
                                      </select>
                                    </div>
                                  </div>
                                  <div class="col-md-4">
                                    <label class="col-sm-12">Waktu Pengukuran</label>
                                    <div class="col-sm-12">
                                      <select name="id_waktu" class="form-control" required>
                                        <option value="per hari">per hari</option>
                                        <option value="per bulan">per bulan</option>
                                        <option value="per semester">per semester</option>
                                        <option value="per tahun">per tahun</option>
                                      </select>
                                    </div>
                                  </div>
                                  <div class="col-md-4">
                                    <label class="col-sm-12">Anggaran Rp.</label>
                                    <input type="text" class="form-control" name="anggaran_ss_renstra" value="0" required>
                                  </div>
                                </div>
                                <hr>
                                <div class="form-group">
                                  <div class="col-md-12">
                                    <label class="col-sm-12">Kondisi Awal Kinerja RPJMD</label>
                                    <div class="col-md-12">
                                      <input name="kondisi_awal" type="text" class="form-control" placeholder="placeholder" required>
                                    </div>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <div class="col-md-6">
                                    <label class="col-sm-12">Target 2019</label>
                                    <div class="col-md-12">
                                      <input name="target_2019" type="text" class="form-control" placeholder="placeholder" value="0" required>
                                    </div>
                                  </div>
                                  <div class="col-md-6">
                                    <label class="col-sm-12">Target 2020</label>
                                    <div class="col-md-12">
                                      <input name="target_2020" type="text" class="form-control" placeholder="placeholder" value="0" required>
                                    </div>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <div class="col-md-6">
                                    <label class="col-sm-12">Target 2021</label>
                                    <div class="col-md-12">
                                      <input name="target_2021" type="text" class="form-control" placeholder="placeholder" value="0" required>
                                    </div>
                                  </div>
                                  <div class="col-md-6">
                                    <label class="col-sm-12">Target 2022</label>
                                    <div class="col-md-12">
                                      <input name="target_2022" type="text" class="form-control" placeholder="placeholder" value="0" required>
                                    </div>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <div class="col-md-6">
                                    <label class="col-sm-12">Target 2023</label>
                                    <div class="col-md-12">
                                      <input name="target_2023" type="text" class="form-control" placeholder="placeholder" value="0" required>
                                    </div>
                                  </div>
                                </div>
                               <!--  <hr>
                                <?php

                                for($tahun=2019;$tahun<=2023;$tahun++){
                                  ?>
                                  <div class="col-md-6">
                                    <div class="form-group">
                                      <label class="col-sm-12">Anggaran <?=$tahun?></label>
                                      <div class="col-md-12">
                                        <div class="input-group">
                                          <div class="input-group-addon">Rp.</div>
                                          <input name="anggaran_<?=$tahun?>" type="text" class="form-control" placeholder="placeholder" value="0" required>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <?php } ?> -->
                                  <hr>

                                  <div class="form-group">
                                    <div class="col-md-6">
                                      <label class="col-sm-12">Target Kondisi Akhir </label>
                                      <div class="col-md-12">
                                        <input name="kondisi_akhir_target" value="0" type="text" class="form-control" placeholder="placeholder" required>
                                      </div>
                                    </div>
                                    <div class="col-md-6">
                                      <label class="col-sm-12">anggaran Kondisi Akhir  </label>
                                      <div class="col-md-12">
                                        <input name="kondisi_akhir_anggaran" value="0" type="text" class="form-control" placeholder="placeholder" required>
                                      </div>
                                    </div>
                                  </div>
                                  <hr>
                                  <div class="form-group">
                                    <div class="col-lg-12">
                                      <label class="col-sm-12">Polorarisasi</label>
                                      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <div class="radio radio-primary">
                                          <input type="radio" name="polorarisasi" id="radio10" value="Maximaze" checked>
                                          <label for="radio10"> Maximaze </label> <span class="badge badge-info "  data-toggle="popover" data-placement="top" data-content="adalah kondisi bila realisasi kinerja harus lebih besar dari pada target, atau semakin besar hasil realisasi kinerja maka nilai capaian dari target tersebut semakin bagus. Contohnya : target jumlah pendapatan daerah (bisa menggunakan maximize)"><i class="ti-info" style="font-size:9px"></i></span>
                                        </div>
                                      </div>
                                      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <div class="radio radio-primary">
                                          <input type="radio" name="polorarisasi" id="radio11" value="Minimaze">
                                          <label for="radio11"> Minimaze </label> <span class="badge badge-info"  data-toggle="popover" data-placement="top" data-content="adalah kondisi bila realisasi kinerja harus lebih kecil dari pada target, atau semakin kecil hasil realisasi kinerja maka nilai capaian dari target tersebut semakin bagus. Contohnya : target jumlah kematian bayi (bisa menggunakan minimize)"><i class="ti-info" style="font-size:9px"></i></span>
                                        </div>
                                      </div>
                                      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <div class="radio radio-primary">
                                          <input type="radio" name="polorarisasi" id="radio12" value="Stabilize">
                                          <label for="radio12"> Stabilize </label> <span class="badge badge-info"  data-toggle="popover" data-placement="top" data-content="adalah kondisi bila realisasi kinerja harus mendekati nilai dari pada target, atau semakin kecil selisih antara  realisasi dan target, maka capaian tersebut semakin bagus. Contohnya : target penyerapan anggaran (bisa menggunakan stabilize)"><i class="ti-info" style="font-size:9px"></i></span>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <div class="col-lg-12">
                                      <label class="col-sm-12">Jenis Casecading</label>
                                      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <div class="radio radio-primary">
                                          <input type="radio" name="jenis_casecading" id="radio13" value="Casecading Peta" checked>
                                          <label for="radio13"> Pemilik KU </label> <span class="badge badge-info "  data-toggle="popover" data-placement="top" data-content="Bila kondisi IKU tersebut merupakan bagian dari tugas pokok dari unitkerja tersebut atau memiliki tanggung jawab besar atas ketercapaian target"><i class="ti-info" style="font-size:9px"></i></span>
                                        </div>
                                      </div>
                                      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <div class="radio radio-primary">
                                          <input type="radio" name="jenis_casecading" id="radio15" value="Non Casecading">
                                          <label for="radio15"> Bukan Pemilik IKU </label> <span class="badge badge-info"  data-toggle="popover" data-placement="top" data-content="Bila kondisi IKU tersebut merupakan tugas tambahan yang diberikan dan bukan bagian dari tugas pokok unitkerja, atau tidak bertanggung jawab secara langsung ata s target kinerja tersebut"><i class="ti-info" style="font-size:9px"></i></span>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <!-- <div class="form-group">
                                    <div class="col-lg-12">
                                      <label class="col-sm-12">Metode Casecading</label>
                                      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <div class="radio radio-primary">
                                          <input type="radio" name="metode_casecading" id="radio16" value="Direct" checked>
                                          <label for="radio16"> Direct </label> <span class="badge badge-info"  data-toggle="popover" data-placement="top" data-content="Tooltip on top"><i class="ti-info" style="font-size:9px"></i></span>
                                        </div>
                                      </div>
                                      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <div class="radio radio-primary">
                                          <input type="radio" name="metode_casecading" id="radio17" value="In-direct">
                                          <label for="radio17"> In-direct </label> <span class="badge badge-info"  data-toggle="popover" data-placement="top" data-content="Tooltip on top"><i class="ti-info" style="font-size:9px"></i></span>
                                        </div>
                                      </div>
                                    </div>
                                  </div> -->
                                  <div class="form-group">
                                    <div class="col-lg-12">
                                     <label class="col-sm-12">Casecading ke Unit Kerja</label>
                                     <div class="col-lg-12">
                                      <?php foreach ($unit_kerja as $key => $value): ?>
                                        <div class="checkbox checkbox-primary">
                                          <input id="checkbox<?=$key?>" type="checkbox" name="casecade_unit_kerja[]" value="<?=$value->id_unit_kerja?>">
                                          <label for="checkbox<?=$key?>"> <?=$value->nama_unit_kerja?> </label>
                                        </div>
                                        <?php  
                                        $unit_kerja_2 = $this->ref_skpd_model->get_unit_kerja_by_id_induk($detail->id_skpd,$value->id_unit_kerja);
                                        ?>
                                        <?php if(count($unit_kerja_2)!==0){ foreach ($unit_kerja_2 as $key2 => $value2):?>
                                          <div class="checkbox checkbox-primary m-l-20">
                                            <input id="checkbox<?=$key?>_<?=$key2?>" type="checkbox" name="casecade_unit_kerja[]" value="<?=$value2->id_unit_kerja?>">
                                            <label for="checkbox<?=$key?>_<?=$key2?>"> <?=$value2->nama_unit_kerja?> </label>
                                          </div>
                                          <?php  
                                          $unit_kerja_3 = $this->ref_skpd_model->get_unit_kerja_by_id_induk($detail->id_skpd,$value2->id_unit_kerja);
                                          ?>
                                          <?php if(count($unit_kerja_3)!==0){ foreach ($unit_kerja_3 as $key3 => $value3):?>
                                            <div class="checkbox checkbox-primary m-l-30">
                                              <input id="checkbox<?=$key?>_<?=$key2?>_<?=$key3?>" type="checkbox" name="casecade_unit_kerja[]" value="<?=$value3->id_unit_kerja?>">
                                              <label for="checkbox<?=$key?>_<?=$key2?>_<?=$key3?>"> <?=$value3->nama_unit_kerja?> </label>
                                            </div>
                                            <?php  
                                            $unit_kerja_4 = $this->ref_skpd_model->get_unit_kerja_by_id_induk($detail->id_skpd,$value3->id_unit_kerja);
                                            ?>
                                            <?php if(count($unit_kerja_4)!==0){ foreach ($unit_kerja_4 as $key4 => $value4):?>
                                              <div class="checkbox checkbox-primary m-l-40">
                                                <input id="checkbox<?=$key?>_<?=$key2?>_<?=$key3?>_<?=$key4?>" type="checkbox" name="casecade_unit_kerja[]" value="<?=$value4->id_unit_kerja?>">
                                                <label for="checkbox<?=$key?>_<?=$key2?>_<?=$key3?>_<?=$key4?>"> <?=$value4->nama_unit_kerja?> </label>
                                              </div>
                                            <?php endforeach; } ?>
                                          <?php endforeach; } ?>
                                        <?php endforeach; } ?>
                                        <hr style="margin:0;">
                                      <?php endforeach ?>
                                    </div>
                                  </div>
                                </div>

                                <button type="submit" id="data-form-submit-tambahIndikator1" hidden></button>
                              </form>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Batal</button>
                              <button type="button" class="btn btn-primary waves-effect text-left" id="data-button-tambahIndikator1" onclick="add_indikator_sasaran_strategis();">Kirim</button>
                            </div>
                          </div>
                          <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                      </div>
                    <?php endif ?>

                  </div>
                </div>


                <?php
                if(count($sasaran_strategis)==0) :
                  echo '<hr><div class="alert alert-info alert-dismissible fade in" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                  </button> -- Tidak ada data. -- </div>';
                else :
                  $n=1;
                  foreach ($sasaran_strategis as $key => $ss): ?>
                    <hr>
                    <div class="row b-t" style="padding-top: 20px;background:#f4f4f4" >
                      <div class="col-md-12 p-b-20">
                        <div class="col-md-12" >
                         <div class="btn-group m-r-10">
                          <button aria-expanded="false" data-toggle="dropdown" class="btn btn-default btn-outline dropdown-toggle waves-effect waves-light" type="button"> <i class="fa fa-gear m-r-5"></i> <span class="caret"></span></button>
                          <ul role="menu" class="dropdown-menu">
                            <li><a href="#!" onclick="edit_sasaran_strategis_renstra(<?=$ss['id_sasaran_strategis_renstra']?>);">Edit</a></li>
                            <?php
                            $id_ss = $ss['id_sasaran_strategis_renstra'];
                            echo"

                            <li>
                            <a href='#' class='btn-xs' title='Hapus Sasaran'  onclick='delete_ss_(\"$id_ss\")' data-toggle=\"tooltip\" data-original-title=\"Close\"> Hapus </a></li>";
                            ?>
                          </ul>
                        </div>


                          <button type="button" class="btn btn-warning pull-right" data-toggle="modal" data-target="#lakukanPembobotanss<?=$key?>">Lakukan Pembobotan</button>

                        <strong>Sasaran <?=$n?>.</strong> <?=$ss['sasaran_strategis_renstra']?>
                      </div>
                      <?php if (count($iku_sasaran_strategis[$key])>0): ?>
                        <div class="">

                          <div id="lakukanPembobotanss<?=$key?>" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabelss<?=$key?>" aria-hidden="true" style="display: none;">
                            <div class="modal-dialog modal-lg">
                              <div class="modal-content">
                                <div class="panel-heading">
                                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                  <h4 class="modal-title" id="myLargeModalLabelss<?=$key?>" style="color:white;">Lakukan Pembobotan</h4>
                                </div>
                                <div class="modal-body">
                                  <div class="table-responsive">
                                    <form id="data-form-bobotss<?=$key?>" action="#!">
                                      <table class="table color-table muted-table">
                                        <thead>
                                          <tr>
                                            <th>Nama Indikator</th>
                                            <th>Bobot</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          <?php foreach ($iku_sasaran_strategis[$key] as $keys => $iku_ss):  ?>
                                            <tr>
                                              <td><?=$iku_ss['iku_ss_renstra']?></td>
                                              <td><input type="number" max="100" min="0" name="bobot[<?=$iku_ss['id_iku_ss_renstra']?>]" value="<?=$iku_ss['bobot']?>" class="form-control" placeholder="Masukan Bobot"> </td>
                                            </tr>
                                          <?php endforeach ?>
                                        </tbody>
                                      </table>
                                      <button type="submit" id="data-form-submit-bobotss<?=$key?>" hidden></button>
                                    </form>
                                    <div class="alert alert-info alert-dismissible fade in" role="alert">
                                      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                                      </button> Jumlah bobot harus 100%. </div>
                                    </div>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Batal</button>
                                    <button type="button" class="btn btn-primary waves-effect text-left" onclick="lakukan_pembobotan_ss('<?=$key?>');">Kirim</button>
                                  </div>
                                </div>
                                <!-- /.modal-content -->
                              </div>
                              <!-- /.modal-dialog -->
                            </div>
                          </div>
                        <?php endif?>
                      </div>
                      <?php if (count($iku_sasaran_strategis[$key])>0): ?>
                        <br><br>
                        <div class="table-responsive col-md-12 dragscroll">
                          <table class="table color-table muted-table">
                            <thead>
                              <tr>
                                <th>Kode</th>
                                <th>Indikator</th>
                                <th>Satuan</th>
                                <th>Target  2019</th>
                                <th>Target  2020</th>
                                <th>Target  2021</th>
                                <th>Target  2022</th>
                                <th>Target  2023</th>
                                <th>Bobot IKU </th>
                                <th>Casecading ke Unit Kerja</th>
                                <th>Status Reviu</th>
                                <th>Opsi</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php
                              $nn=1;
                              foreach ($iku_sasaran_strategis[$key] as $keys => $iku_ss):
                                $array_smartc = array('s','m','a','r','t','c');
                                foreach ($array_smartc as $a) {
                                  $array_status_smartc[$a] = $iku_ss['status_'.$a];
                                }

                                if (in_array('2', $array_status_smartc)) {
                                  $status_reviu = "ti-alert";
                                } elseif (count(array_unique($array_status_smartc)) == 1 AND in_array('1', $array_status_smartc)) {
                                  $status_reviu = "ti-star";
                                } else {
                                  $status_reviu = "ti-time";
                                }
                                ?>
                                <tr>
                                  <td><?=$n?>.<?=$nn?></td>
                                  <td><?=$iku_ss['iku_ss_renstra']?></td>
                                  <td><?=$iku_ss['satuan']?></td>
                                  <?php for ($i=2019; $i <= 2023; $i++) { ?>
                                    <td><?=$iku_ss['target_'.$i]?></td>
                                  <?php } ?>

                                  <td><?=$iku_ss['bobot']?>%</td>
                                  <td>
                                    <?php
                                    // foreach ($iku_sasaran_strategis_unit_kerja[$key][$keys] as $row){
                                    //   echo "{$row['nama_unit_kerja']}; ";
                                    // }
                                    $a_unit_kerja = array();
                                    foreach($iku_sasaran_strategis_unit_kerja[$key][$keys] as $row){
                                      $a_unit_kerja[] = $row['nama_unit_kerja'];
                                    }
                                    $iku_unit_kerja = implode(', ', $a_unit_kerja);
                                    echo $iku_unit_kerja;
                                    ?>
                                  </td>
                                  <td><i class="<?=$status_reviu?>" data-toggle="modal" data-target="#statusIndikator<?=$keys?>"></i></td>
                                  <td><a href="<?php echo base_url('renstra_perencanaan/detail/ss/'.$detail->id_skpd.'/'.$iku_ss['id_iku_ss_renstra']);?>" class="btn btn-info" style="color:white;"><i class="ti-eye"></i> Detail</a></td>
                                </tr>
                                <?php $nn++; endforeach ?>
                              </tbody>
                            </table>
                            <?php foreach ($iku_sasaran_strategis[$key] as $keys => $iku_ss): ?>
                              <div id="statusIndikator<?=$keys?>" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel1" aria-hidden="true" style="display: none;">
                                <div class="modal-dialog modal-lg">
                                  <div class="modal-content">
                                    <div class="panel-heading">
                                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                      <h4 class="modal-title" id="myLargeModalLabel1" style="color:white;">Status Indikator Strategis</h4>
                                    </div>
                                    <div class="modal-body">
                                      <div class="table-responsive">
                                        <table class="table color-table success-table table-bordered">
                                          <thead>
                                            <tr>
                                              <th></th>
                                              <th>Penilaian</th>
                                              <th>Catatan</th>
                                              <th>Status</th>
                                            </tr>
                                          </thead>
                                          <tbody>
                                            <tr>
                                              <td><img src="<?php echo base_url('assets/images/smartc/S.jpg')?>" width="30" height="30"></td>
                                              <td> Definif (tidak normatif, tidak bermakna ganda,  relevan terhadap SS </td>
                                              <td><?=$iku_ss['catatan_s']?></td>
                                              <td>
                                                <?php if ($iku_ss['status_s']=="1"): ?>
                                                  <i class="ti-check" style="color:green;"></i>
                                                  <?php elseif ($iku_ss['status_s']=="2"): ?>
                                                    <i class="ti-close" style="color:red;"></i>
                                                    <?php else: ?>
                                                      <i class="ti-minus"></i>
                                                    <?php endif ?>
                                                  </td>
                                                </tr>
                                                <tr>
                                                  <td><img src="<?php echo base_url('assets/images/smartc/M.jpg')?>" width="30" height="30"></td>
                                                  <td> Dapat diukur dengan jelas dan memiliki satuan persen (%)</td>
                                                  <td><?=$iku_ss['catatan_m']?></td>
                                                  <td>
                                                    <?php if ($iku_ss['status_m']=="1"): ?>
                                                      <i class="ti-check" style="color:green;"></i>
                                                      <?php elseif ($iku_ss['status_m']=="2"): ?>
                                                        <i class="ti-close" style="color:red;"></i>
                                                        <?php else: ?>
                                                          <i class="ti-minus"></i>
                                                        <?php endif ?>
                                                      </td>
                                                    </tr>
                                                    <tr>
                                                      <td><img src="<?php echo base_url('assets/images/smartc/A.jpg')?>" width="30" height="30"></td>
                                                      <td> Disepakati oleh Iku atasanya</td>
                                                      <td><?=$iku_ss['catatan_a']?></td>
                                                      <td>
                                                        <?php if ($iku_ss['status_a']=="1"): ?>
                                                          <i class="ti-check" style="color:green;"></i>
                                                          <?php elseif ($iku_ss['status_a']=="2"): ?>
                                                            <i class="ti-close" style="color:red;"></i>
                                                            <?php else: ?>
                                                              <i class="ti-minus"></i>
                                                            <?php endif ?>
                                                          </td>
                                                        </tr>
                                                        <tr>
                                                          <td><img src="<?php echo base_url('assets/images/smartc/R.jpg')?>" width="30" height="30"></td>
                                                          <td> Ukuran Iku dapat dicapai dan menantang</td>
                                                          <td><?=$iku_ss['catatan_r']?></td>
                                                          <td>
                                                            <?php if ($iku_ss['status_r']=="1"): ?>
                                                              <i class="ti-check" style="color:green;"></i>
                                                              <?php elseif ($iku_ss['status_r']=="2"): ?>
                                                                <i class="ti-close" style="color:red;"></i>
                                                                <?php else: ?>
                                                                  <i class="ti-minus"></i>
                                                                <?php endif ?>
                                                              </td>
                                                            </tr>
                                                            <tr>
                                                              <td><img src="<?php echo base_url('assets/images/smartc/T.jpg')?>" width="30" height="30"></td>
                                                              <td> Memiliki batas capain</td>
                                                              <td><?=$iku_ss['catatan_t']?></td>
                                                              <td>
                                                                <?php if ($iku_ss['status_t']=="1"): ?>
                                                                  <i class="ti-check" style="color:green;"></i>
                                                                  <?php elseif ($iku_ss['status_t']=="2"): ?>
                                                                    <i class="ti-close" style="color:red;"></i>
                                                                    <?php else: ?>
                                                                      <i class="ti-minus"></i>
                                                                    <?php endif ?>
                                                                  </td>
                                                                </tr>
                                                                <tr>
                                                                  <td><img src="<?php echo base_url('assets/images/smartc/C.jpg')?>" width="30" height="30"></td>
                                                                  <td> Target iku disesuaikan dengan target organisasi dan selalu disempurnakan <p>          dari tahun ketahun</p></td>
                                                                  <td><?=$iku_ss['catatan_c']?></td>
                                                                  <td>
                                                                    <?php if ($iku_ss['status_c']=="1"): ?>
                                                                      <i class="ti-check" style="color:green;"></i>
                                                                      <?php elseif ($iku_ss['status_c']=="2"): ?>
                                                                        <i class="ti-close" style="color:red;"></i>
                                                                        <?php else: ?>
                                                                          <i class="ti-minus"></i>
                                                                        <?php endif ?>
                                                                      </td>
                                                                    </tr>
                                                                  </tbody>
                                                                </table>
                                                              </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                              <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Close</button>
                                                            </div>
                                                          </div>
                                                          <!-- /.modal-content -->
                                                        </div>
                                                        <!-- /.modal-dialog -->
                                                      </div>
                                                    <?php endforeach ?>
                                                  </div>
                                                <?php endif ?>
                                              </div>
                                              <?php $n++; endforeach; endif; ?>
                                            </div>
                                          </div>
                                        </div>
                                        <!-- sasaran program -->
                                        <div class="panel panel-primary">
                                          <div class="panel-heading">

                                            Sasaran Program
                                          </div>
                                          <div class="panel-wrapper collapse in" aria-expanded="true">
                                            <div class="panel-body">
                                              <?php if (count($unit_kerja_ss)>0): ?>
                                                <div class="row">

                                                  <div class="col-md-12">
                                                    <button type="button" class="btn btn-primary" onclick="new_sasaran_program_renstra();">Tambah Sasaran Program</button>
                                                    <!-- modal tambah sasaran strategis -->
                                                    <div id="tambahSasaran2" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                                                      <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                          <div class="panel-heading">
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                            <h4 class="modal-title" id="data-title-tambahSasaran2" style="color:white;">Tambah Sasaran Program</h4>
                                                          </div>
                                                          <div class="modal-body">
                                                            <form class="form-horizontal" id="data-form-tambahSasaran2" action="#!">
                                                              <div class="form-group">
                                                                <label class="col-sm-12">UNIT KERJA</label>
                                                                <div class="col-sm-12">
                                                                  <select id="data-id_unit_kerja" name="id_unit_kerja" class="form-control select2" onchange="get_iku_ss();" required>
                                                                    <?php foreach ($unit_kerja_ss as $key => $value): ?>
                                                                      <option value="<?=$value['id_unit_kerja']?>"><?=$value['nama_unit_kerja']?></option>
                                                                    <?php endforeach ?>
                                                                  </select>
                                                                </div>
                                                              </div>
                                                              <div class="form-group">
                                                                <label class="col-sm-12">IKU SASARAN STRATEGIS</label>
                                                                <div class="col-sm-12">
                                                                  <select id="data-id_iku_ss_renstra" name="id_iku_ss_renstra" class="form-control select2" required>
                                                                    <option value="">Pilih Iku Sasaran</option>
                                                                  </select>
                                                                </div>
                                                              </div>
                                                              <div class="form-group">
                                                                <label class="col-md-12">NAMA PROGRAM</label>
                                                                <div class="col-md-12">
                                                                  <input id="data-sasaran_program_renstra" name="sasaran_program_renstra" type="text" class="form-control" placeholder="placeholder" required>
                                                                </div>
                                                              </div>
                                                              <button type="submit" id="data-form-submit-tambahSasaran2" hidden></button>
                                                            </form>
                                                          </div>
                                                          <div class="modal-footer">
                                                            <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Batal</button>
                                                            <button id="data-button-tambahSasaran2" type="button" class="btn btn-primary waves-effect text-left" onclick="add_sasaran_program_renstra();">Kirim</button>
                                                          </div>
                                                        </div>
                                                        <!-- /.modal-content -->
                                                      </div>
                                                      <!-- /.modal-dialog -->
                                                    </div>
                                                    <?php if(count($sasaran_program)>0) :?>
                                                      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahIndikator2">Tambah Indikator</button>
                                                      <!-- modal tambah indikator sasaran strategis -->
                                                      <div id="tambahIndikator2" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel2" aria-hidden="true" style="display: none;">
                                                        <div class="modal-dialog modal-lg">
                                                          <div class="modal-content">
                                                            <div class="panel-heading">
                                                              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                              <h4 class="modal-title" id="myLargeModalLabel2" style="color:white;">Tambah Indikator Program</h4>
                                                            </div>
                                                            <div class="modal-body">

                                                              <form class="form-horizontal" id="data-form-tambahIndikator2" action="#!">
                                                                <div class="form-group">
                                                                  <label class="col-sm-12">SASARAN</label>
                                                                  <div class="col-sm-12">
                                                                    <select id="data-id_sasaran_program_renstra" name="id_sasaran_program_renstra" class="form-control select2" required>
                                                                      <?php foreach ($sasaran_program as $key => $value): ?>
                                                                        <option value="<?=$value['id_sasaran_program_renstra']?>"><?=$value['sasaran_program_renstra']?></option>
                                                                      <?php endforeach ?>
                                                                    </select>
                                                                  </div>
                                                                </div>
                                                                <div class="form-group">
                                                                  <label class="col-md-12">INDIKATOR PROGRAM</label>
                                                                  <div class="col-md-12">
                                                                    <input id="data-iku_sp_renstra" name="iku_sp_renstra" type="text" class="form-control" placeholder="placeholder" required>
                                                                  </div>
                                                                </div>
                                                                <div class="form-group">
                                                                  <label class="col-md-12">DESKRIPSI</label>
                                                                  <div class="col-md-12">
                                                                    <textarea name="deskripsi" class="form-control" rows="5"></textarea>
                                                                  </div>
                                                                </div>
                                                                <div class="form-group">
                                                                  <div class="col-md-4">
                                                                    <label class="col-sm-12">Satuan Pengukuran</label>
                                                                    <div class="col-sm-12">
                                                                      <select name="id_satuan" class="form-control select2" required>
                                                                        <?php foreach ($ref_satuan as $key => $value): ?>
                                                                          <option value="<?=$value->id_satuan?>"><?=$value->satuan?></option>
                                                                        <?php endforeach ?>
                                                                      </select>
                                                                    </div>
                                                                  </div>
                                                                  <div class="col-md-4">
                                                                    <label class="col-sm-12">Waktu Pengukuran</label>
                                                                    <div class="col-sm-12">
                                                                      <select name="id_waktu" class="form-control" required>
                                                                        <option value="per hari">per hari</option>
                                                                        <option value="per bulan">per bulan</option>
                                                                        <option value="per semester">per semester</option>
                                                                        <option value="per tahun">per tahun</option>
                                                                      </select>
                                                                    </div>
                                                                  </div>
                                                                  <div class="col-md-4">
                                                                    <label class="col-sm-12">Anggaran Rp.</label>
                                                                    <input type="text" class="form-control" name="anggaran_sp_renstra" value="0" required>
                                                                  </div>
                                                                </div>
                                                                <hr>
                                                                <div class="form-group">
                                                                  <div class="col-md-12">
                                                                    <label class="col-sm-12">Kondisi Awal</label>
                                                                    <div class="col-md-12">
                                                                      <input name="kondisi_awal" type="text" class="form-control" placeholder="placeholder" required>
                                                                    </div>
                                                                  </div>
                                                                </div>
                                                                <div class="form-group">
                                                                  <div class="col-md-6">
                                                                    <label class="col-sm-12">Target 2019</label>
                                                                    <div class="col-md-12">
                                                                      <input name="target_2019" type="text" class="form-control" placeholder="placeholder" value="0" required>
                                                                    </div>
                                                                  </div>
                                                                  <div class="col-md-6">
                                                                    <label class="col-sm-12">Target 2020</label>
                                                                    <div class="col-md-12">
                                                                      <input name="target_2020" type="text" class="form-control" placeholder="placeholder" value="0" required>
                                                                    </div>
                                                                  </div>
                                                                </div>
                                                                <div class="form-group">
                                                                  <div class="col-md-6">
                                                                    <label class="col-sm-12">Target 2021</label>
                                                                    <div class="col-md-12">
                                                                      <input name="target_2021" type="text" class="form-control" placeholder="placeholder" value="0" required>
                                                                    </div>
                                                                  </div>
                                                                  <div class="col-md-6">
                                                                    <label class="col-sm-12">Target 2022</label>
                                                                    <div class="col-md-12">
                                                                      <input name="target_2022" type="text" class="form-control" placeholder="placeholder" value="0" required>
                                                                    </div>
                                                                  </div>
                                                                </div>
                                                                <div class="form-group">
                                                                  <div class="col-md-6">
                                                                    <label class="col-sm-12">Target 2023</label>
                                                                    <div class="col-md-12">
                                                                      <input name="target_2023" type="text" class="form-control" placeholder="placeholder" value="0" required>
                                                                    </div>
                                                                  </div>
                                                                </div>
                                                           <!--    <hr>

                                                              <?php

                                                              for($tahun=2019;$tahun<=2023;$tahun++){
                                                                ?>
                                                                <div class="col-md-6">
                                                                  <div class="form-group">
                                                                    <label class="col-sm-12">Anggaran <?=$tahun?></label>
                                                                    <div class="col-md-12">
                                                                      <div class="input-group">
                                                                        <div class="input-group-addon">Rp.</div>
                                                                        <input name="anggaran_<?=$tahun?>" type="text" class="form-control" placeholder="placeholder" value="0" required>
                                                                      </div>
                                                                    </div>
                                                                  </div>
                                                                </div>
                                                                <?php } ?> -->
                                                                <hr>

                                                                <div class="form-group">
                                                                  <div class="col-md-6">
                                                                    <label class="col-sm-12">Kondisi Akhir Target RPJMD</label>
                                                                    <div class="col-md-12">
                                                                      <input name="kondisi_akhir_target" value="0" type="text" class="form-control" placeholder="placeholder" required>
                                                                    </div>
                                                                  </div>
                                                                  <div class="col-md-6">
                                                                    <label class="col-sm-12">Kondisi Akhir Anggaran RPJMD</label>
                                                                    <div class="col-md-12">
                                                                      <input name="kondisi_akhir_anggaran" value="0" type="text" class="form-control" placeholder="placeholder" required>
                                                                    </div>
                                                                  </div>
                                                                </div>
                                                                <hr>
                                                                <div class="form-group">
                                                                  <div class="col-lg-12">
                                                                    <label class="col-sm-12">Polorarisasi</label>
                                                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                                      <div class="radio radio-primary">
                                                                        <input type="radio" name="polorarisasi" id="radio102" value="Maximaze" checked>
                                                                        <label for="radio102"> Maximaze </label> <span class="badge badge-info"  data-toggle="popover" data-placement="top" data-content="adalah kondisi bila realisasi kinerja harus lebih besar dari pada target, atau semakin besar hasil realisasi kinerja maka nilai capaian dari target tersebut semakin bagus. Contohnya : target jumlah pendapatan daerah (bisa menggunakan maximize)"><i class="ti-info" style="font-size:9px"></i></span>
                                                                      </div>
                                                                    </div>
                                                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                                      <div class="radio radio-primary">
                                                                        <input type="radio" name="polorarisasi" id="radio112" value="Minimaze">
                                                                        <label for="radio112"> Minimaze </label> <span class="badge badge-info"  data-toggle="popover" data-placement="top" data-content="adalah kondisi bila realisasi kinerja harus lebih kecil dari pada target, atau semakin kecil hasil realisasi kinerja maka nilai capaian dari target tersebut semakin bagus. Contohnya : target jumlah kematian bayi (bisa menggunakan minimize)"><i class="ti-info" style="font-size:9px"></i></span>
                                                                      </div>
                                                                    </div>
                                                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                                      <div class="radio radio-primary">
                                                                        <input type="radio" name="polorarisasi" id="radio122" value="Stabilize">
                                                                        <label for="radio122"> Stabilize </label> <span class="badge badge-info"  data-toggle="popover" data-placement="top" data-content="adalah kondisi bila realisasi kinerja harus mendekati nilai dari pada target, atau semakin kecil selisih antara  realisasi dan target, maka capaian tersebut semakin bagus. Contohnya : target penyerapan anggaran (bisa menggunakan stabilize)"><i class="ti-info" style="font-size:9px"></i></span>
                                                                      </div>
                                                                    </div>
                                                                  </div>
                                                                </div>
                                                                <div class="form-group">
                                                                  <div class="col-lg-12">
                                                                    <label class="col-sm-12">Jenis Casecading</label>
                                                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                                      <div class="radio radio-primary">
                                                                        <input type="radio" name="jenis_casecading" id="radio132" value="Casecading Peta" checked>
                                                                        <label for="radio132"> Pemilik IKU </label> <span class="badge badge-info"  data-toggle="popover" data-placement="top" data-content="Bila kondisi IKU tersebut merupakan bagian dari tugas pokok dari unitkerja tersebut atau memiliki tanggung jawab besar atas ketercapaian target"><i class="ti-info" style="font-size:9px"></i></span>
                                                                      </div>
                                                                    </div>
                                                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                                      <div class="radio radio-primary">
                                                                        <input type="radio" name="jenis_casecading" id="radio152" value="Non Casecading">
                                                                        <label for="radio152"> Bukan Pemilik IKU </label> <span class="badge badge-info"  data-toggle="popover" data-placement="top" data-content="Bila kondisi IKU tersebut merupakan tugas tambahan yang diberikan dan bukan bagian dari tugas pokok unitkerja, atau tidak bertanggung jawab secara langsung ata s target kinerja tersebut"><i class="ti-info" style="font-size:9px"></i></span>
                                                                      </div>
                                                                    </div>
                                                                  </div>
                                                                </div>
                                                                <!-- <div class="form-group">
                                                                  <div class="col-lg-12">
                                                                    <label class="col-sm-12">Metode Casecading</label>
                                                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                                      <div class="radio radio-primary">
                                                                        <input type="radio" name="metode_casecading" id="radio162" value="Direct" checked>
                                                                        <label for="radio162"> Direct </label> <span class="badge badge-info"  data-toggle="popover" data-placement="top" data-content="Tooltip on top"><i class="ti-info" style="font-size:9px"></i></span>
                                                                      </div>
                                                                    </div>
                                                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                                      <div class="radio radio-primary">
                                                                        <input type="radio" name="metode_casecading" id="radio172" value="In-direct">
                                                                        <label for="radio172"> In-direct </label> <span class="badge badge-info"  data-toggle="popover" data-placement="top" data-content="Tooltip on top"><i class="ti-info" style="font-size:9px"></i></span>
                                                                      </div>
                                                                    </div>
                                                                  </div>
                                                                </div> -->
                                                                <div class="form-group">
                                                                  <div class="col-lg-12">
                                                                   <label class="col-sm-12">Casecading ke Unit Kerja</label>
                                                                     <div class="col-lg-12">
                                                                      <?php foreach ($unit_kerja as $key => $value): ?>
                                                                        <div class="checkbox checkbox-primary">
                                                                          <input id="checkbox<?=$key?>" type="checkbox" name="casecade_unit_kerja[]" value="<?=$value->id_unit_kerja?>">
                                                                          <label for="checkbox<?=$key?>"> <?=$value->nama_unit_kerja?> </label>
                                                                        </div>
                                                                        <?php  
                                                                        $unit_kerja_2 = $this->ref_skpd_model->get_unit_kerja_by_id_induk($detail->id_skpd,$value->id_unit_kerja);
                                                                        ?>
                                                                        <?php if(count($unit_kerja_2)!==0){ foreach ($unit_kerja_2 as $key2 => $value2):?>
                                                                          <div class="checkbox checkbox-primary m-l-20">
                                                                            <input id="checkbox<?=$key?>_<?=$key2?>" type="checkbox" name="casecade_unit_kerja[]" value="<?=$value2->id_unit_kerja?>">
                                                                            <label for="checkbox<?=$key?>_<?=$key2?>"> <?=$value2->nama_unit_kerja?> </label>
                                                                          </div>
                                                                          <?php  
                                                                          $unit_kerja_3 = $this->ref_skpd_model->get_unit_kerja_by_id_induk($detail->id_skpd,$value2->id_unit_kerja);
                                                                          ?>
                                                                          <?php if(count($unit_kerja_3)!==0){ foreach ($unit_kerja_3 as $key3 => $value3):?>
                                                                            <div class="checkbox checkbox-primary m-l-30">
                                                                              <input id="checkbox<?=$key?>_<?=$key2?>_<?=$key3?>" type="checkbox" name="casecade_unit_kerja[]" value="<?=$value3->id_unit_kerja?>">
                                                                              <label for="checkbox<?=$key?>_<?=$key2?>_<?=$key3?>"> <?=$value3->nama_unit_kerja?> </label>
                                                                            </div>
                                                                            <?php  
                                                                            $unit_kerja_4 = $this->ref_skpd_model->get_unit_kerja_by_id_induk($detail->id_skpd,$value3->id_unit_kerja);
                                                                            ?>
                                                                            <?php if(count($unit_kerja_4)!==0){ foreach ($unit_kerja_4 as $key4 => $value4):?>
                                                                              <div class="checkbox checkbox-primary m-l-40">
                                                                                <input id="checkbox<?=$key?>_<?=$key2?>_<?=$key3?>_<?=$key4?>" type="checkbox" name="casecade_unit_kerja[]" value="<?=$value4->id_unit_kerja?>">
                                                                                <label for="checkbox<?=$key?>_<?=$key2?>_<?=$key3?>_<?=$key4?>"> <?=$value4->nama_unit_kerja?> </label>
                                                                              </div>
                                                                            <?php endforeach; } ?>
                                                                          <?php endforeach; } ?>
                                                                        <?php endforeach; } ?>
                                                                        <hr style="margin:0;">
                                                                      <?php endforeach ?>
                                                                    </div>
                                                                </div>
                                                              </div>

                                                              <button type="submit" id="data-form-submit-tambahIndikator2" hidden></button>
                                                            </form>
                                                          </div>
                                                          <div class="modal-footer">
                                                            <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Batal</button>
                                                            <button type="button" class="btn btn-primary waves-effect text-left" id="data-button-tambahIndikator2" onclick="add_indikator_sasaran_program();">Kirim</button>
                                                          </div>
                                                        </div>
                                                        <!-- /.modal-content -->
                                                      </div>
                                                      <!-- /.modal-dialog -->
                                                    </div>
                                                  <?php endif ?>

                                                </div>
                                              </div>
                                            <?php endif ?>


                                            <?php
                                            if(count($sasaran_program)==0) :
                                              echo '<hr><div class="alert alert-info alert-dismissible fade in" role="alert">
                                              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                                              </button> -- Tidak ada data. -- </div>';
                                            else :
                                              $n=1;
                                              foreach ($sasaran_program as $key => $sp): ?>
                                                <hr>
                                                <div class="row b-t" style="padding-top: 20px;background:#f4f4f4" >
                                                  <div class="col-md-12 p-b-20">
                                                    <div class="col-md-12" >
                                                     <div class="btn-group m-r-10">
                                                      <button aria-expanded="false" data-toggle="dropdown" class="btn btn-default btn-outline btn-sm dropdown-toggle waves-effect waves-light" type="button"> <i class="fa fa-gear m-r-5"></i> <span class="caret"></span></button>
                                                      <ul role="menu" class="dropdown-menu">
                                                        <li><a href="#!" onclick="edit_sasaran_program_renstra(<?=$sp['id_sasaran_program_renstra']?>);">Edit</a></li>
                                                        <?php
                                                        $id_sp = $sp['id_sasaran_program_renstra'];
                                                        echo"

                                                        <li>
                                                        <a href='#' class='btn-xs' title='Hapus Sasaran'  onclick='delete_sp_(\"$id_sp\")' data-toggle=\"tooltip\" data-original-title=\"Close\"> Hapus </a></li>";
                                                        ?>
                                                      </ul>
                                                    </div>
                                                      <button type="button" class="btn btn-warning pull-right" data-toggle="modal" data-target="#lakukanPembobotansp<?=$key?>">Lakukan Pembobotan</button>
                                                    <strong>Sasaran <?=$n?>.</strong> <?=$sp['sasaran_program_renstra']?> <span class="label label-purple label-sm"><?=$sp['nama_unit_kerja']?></span>
                                                  </div>
                                                  <?php if (count($iku_sasaran_program[$key])>0): ?>
                                                    <div class="">

                                                      <div id="lakukanPembobotansp<?=$key?>" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabelsp<?=$key?>" aria-hidden="true" style="display: none;">
                                                        <div class="modal-dialog modal-lg">
                                                          <div class="modal-content">
                                                            <div class="panel-heading">
                                                              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                              <h4 class="modal-title" id="myLargeModalLabelsp<?=$key?>" style="color:white;">Lakukan Pembobotan</h4>
                                                            </div>
                                                            <div class="modal-body">
                                                              <div class="table-responsive">
                                                                <form id="data-form-bobotsp<?=$key?>" action="#!">
                                                                  <table class="table color-table muted-table">
                                                                    <thead>
                                                                      <tr>
                                                                        <th>Nama Indikator</th>
                                                                        <th>Bobot</th>
                                                                      </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                      <?php foreach ($iku_sasaran_program[$key] as $keys => $iku_sp):  ?>
                                                                        <tr>
                                                                          <td><?=$iku_sp['iku_sp_renstra']?></td>
                                                                          <td><input type="number" max="100" min="0" name="bobot[<?=$iku_sp['id_iku_sp_renstra']?>]" value="<?=$iku_sp['bobot']?>" class="form-control" placeholder="Masukan Bobot"> </td>
                                                                        </tr>
                                                                      <?php endforeach ?>
                                                                    </tbody>
                                                                  </table>
                                                                  <button type="submit" id="data-form-submit-bobotsp<?=$key?>" hidden></button>
                                                                </form>
                                                                <div class="alert alert-info alert-dismissible fade in" role="alert">
                                                                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                                                                  </button> Jumlah bobot harus 100%. </div>
                                                                </div>
                                                              </div>
                                                              <div class="modal-footer">
                                                                <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Batal</button>
                                                                <button type="button" class="btn btn-primary waves-effect text-left" onclick="lakukan_pembobotan_sp('<?=$key?>');">Kirim</button>
                                                              </div>
                                                            </div>
                                                            <!-- /.modal-content -->
                                                          </div>
                                                          <!-- /.modal-dialog -->
                                                        </div>
                                                      </div>
                                                    <?php endif?>
                                                  </div>
                                                  <?php if (count($iku_sasaran_program[$key])>0): ?>
                                                    <br><br>
                                                    <div class="table-responsive col-md-12 dragscroll">
                                                      <table class="table color-table muted-table">
                                                        <thead>
                                                          <tr>
                                                            <th>Kode</th>
                                                            <th>Indikator</th>
                                                            <th>Satuan</th>
                                                            <th>Target  2019</th>
                                                            <th>Target  2020</th>
                                                            <th>Target  2021</th>
                                                            <th>Target  2022</th>
                                                            <th>Target  2023</th>
                                                            <th>Bobot IKU </th>
                                                            <th>Casecading ke Unit Kerja</th>
                                                            <th>Status Reviu</th>
                                                            <th>Opsi</th>
                                                          </tr>
                                                        </thead>
                                                        <tbody>
                                                          <?php
                                                          $nn=1;
                                                          foreach ($iku_sasaran_program[$key] as $keys => $iku_sp):
                                                            $array_smartc = array('s','m','a','r','t','c');
                                                            foreach ($array_smartc as $a) {
                                                              $array_status_smartc[$a] = $iku_sp['status_'.$a];
                                                            }

                                                            if (in_array('2', $array_status_smartc)) {
                                                              $status_reviu = "ti-alert";
                                                            } elseif (count(array_unique($array_status_smartc)) == 1 AND in_array('1', $array_status_smartc)) {
                                                              $status_reviu = "ti-star";
                                                            } else {
                                                              $status_reviu = "ti-time";
                                                            }
                                                            ?>
                                                            <tr>
                                                              <td><?=$n?>.<?=$nn?></td>
                                                              <td><?=$iku_sp['iku_sp_renstra']?></td>
                                                              <td><?=$iku_sp['satuan']?></td>
                                                              <?php for ($i=2019; $i <= 2023; $i++) { ?>
                                                                <td><?=$iku_sp['target_'.$i]?></td>
                                                              <?php } ?>

                                                              <td><?=$iku_sp['bobot']?>%</td>
                                                              <td>
                                                                <?php
                                    // foreach ($iku_sasaran_strategis_unit_kerja[$key][$keys] as $row){
                                    //   echo "{$row['nama_unit_kerja']}; ";
                                    // }
                                                                $a_unit_kerja = array();
                                                                foreach($iku_sasaran_program_unit_kerja[$key][$keys] as $row){
                                                                  $a_unit_kerja[] = $row['nama_unit_kerja'];
                                                                }
                                                                $iku_unit_kerja = implode(', ', $a_unit_kerja);
                                                                echo $iku_unit_kerja;
                                                                ?>
                                                              </td>
                                                              <td><i class="<?=$status_reviu?>" data-toggle="modal" data-target="#statusIndikatorsp<?=$keys?>"></i></td>
                                                              <td><a href="<?php echo base_url('renstra_perencanaan/detail/sp/'.$detail->id_skpd.'/'.$iku_sp['id_iku_sp_renstra']);?>" class="btn btn-info" style="color:white;"><i class="ti-eye"></i> Detail</a></td>
                                                            </tr>
                                                            <?php $nn++; endforeach ?>
                                                          </tbody>
                                                        </table>
                                                        <?php foreach ($iku_sasaran_program[$key] as $keys => $iku_sp): ?>
                                                          <div id="statusIndikatorsp<?=$keys?>" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel1" aria-hidden="true" style="display: none;">
                                                            <div class="modal-dialog modal-lg">
                                                              <div class="modal-content">
                                                                <div class="panel-heading">
                                                                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                  <h4 class="modal-title" id="myLargeModalLabel1" style="color:white;">Status Indikator Program</h4>
                                                                </div>
                                                                <div class="modal-body">
                                                                  <div class="table-responsive">
                                                                    <table class="table color-table success-table table-bordered">
                                                                      <thead>
                                                                        <tr>
                                                                          <th></th>
                                                                          <th>Penilaian</th>
                                                                          <th>Catatan</th>
                                                                          <th>Status</th>
                                                                        </tr>
                                                                      </thead>
                                                                      <tbody>
                                                                        <tr>
                                                                          <td><img src="<?php echo base_url('assets/images/smartc/S.jpg')?>" width="30" height="30"></td>
                                                                          <td> Definif (tidak normatif, tidak bermakna ganda,  relevan terhadap SS </td>
                                                                          <td><?=$iku_sp['catatan_s']?></td>
                                                                          <td>
                                                                            <?php if ($iku_sp['status_s']=="1"): ?>
                                                                              <i class="ti-check" style="color:green;"></i>
                                                                              <?php elseif ($iku_sp['status_s']=="2"): ?>
                                                                                <i class="ti-close" style="color:red;"></i>
                                                                                <?php else: ?>
                                                                                  <i class="ti-minus"></i>
                                                                                <?php endif ?>
                                                                              </td>
                                                                            </tr>
                                                                            <tr>
                                                                              <td><img src="<?php echo base_url('assets/images/smartc/M.jpg')?>" width="30" height="30"></td>
                                                                              <td> Dapat diukur dengan jelas dan memiliki satuan persen (%)</td>
                                                                              <td><?=$iku_sp['catatan_m']?></td>
                                                                              <td>
                                                                                <?php if ($iku_sp['status_m']=="1"): ?>
                                                                                  <i class="ti-check" style="color:green;"></i>
                                                                                  <?php elseif ($iku_sp['status_m']=="2"): ?>
                                                                                    <i class="ti-close" style="color:red;"></i>
                                                                                    <?php else: ?>
                                                                                      <i class="ti-minus"></i>
                                                                                    <?php endif ?>
                                                                                  </td>
                                                                                </tr>
                                                                                <tr>
                                                                                  <td><img src="<?php echo base_url('assets/images/smartc/A.jpg')?>" width="30" height="30"></td>
                                                                                  <td> Disepakati oleh Iku atasanya</td>
                                                                                  <td><?=$iku_sp['catatan_a']?></td>
                                                                                  <td>
                                                                                    <?php if ($iku_sp['status_a']=="1"): ?>
                                                                                      <i class="ti-check" style="color:green;"></i>
                                                                                      <?php elseif ($iku_sp['status_a']=="2"): ?>
                                                                                        <i class="ti-close" style="color:red;"></i>
                                                                                        <?php else: ?>
                                                                                          <i class="ti-minus"></i>
                                                                                        <?php endif ?>
                                                                                      </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                      <td><img src="<?php echo base_url('assets/images/smartc/R.jpg')?>" width="30" height="30"></td>
                                                                                      <td> Ukuran Iku dapat dicapai dan menantang</td>
                                                                                      <td><?=$iku_sp['catatan_r']?></td>
                                                                                      <td>
                                                                                        <?php if ($iku_sp['status_r']=="1"): ?>
                                                                                          <i class="ti-check" style="color:green;"></i>
                                                                                          <?php elseif ($iku_sp['status_r']=="2"): ?>
                                                                                            <i class="ti-close" style="color:red;"></i>
                                                                                            <?php else: ?>
                                                                                              <i class="ti-minus"></i>
                                                                                            <?php endif ?>
                                                                                          </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                          <td><img src="<?php echo base_url('assets/images/smartc/T.jpg')?>" width="30" height="30"></td>
                                                                                          <td> Memiliki batas capain</td>
                                                                                          <td><?=$iku_sp['catatan_t']?></td>
                                                                                          <td>
                                                                                            <?php if ($iku_sp['status_t']=="1"): ?>
                                                                                              <i class="ti-check" style="color:green;"></i>
                                                                                              <?php elseif ($iku_sp['status_t']=="2"): ?>
                                                                                                <i class="ti-close" style="color:red;"></i>
                                                                                                <?php else: ?>
                                                                                                  <i class="ti-minus"></i>
                                                                                                <?php endif ?>
                                                                                              </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                              <td><img src="<?php echo base_url('assets/images/smartc/C.jpg')?>" width="30" height="30"></td>
                                                                                              <td> Target iku disesuaikan dengan target organisasi dan selalu disempurnakan <p>          dari tahun ketahun</p></td>
                                                                                              <td><?=$iku_sp['catatan_c']?></td>
                                                                                              <td>
                                                                                                <?php if ($iku_sp['status_c']=="1"): ?>
                                                                                                  <i class="ti-check" style="color:green;"></i>
                                                                                                  <?php elseif ($iku_sp['status_c']=="2"): ?>
                                                                                                    <i class="ti-close" style="color:red;"></i>
                                                                                                    <?php else: ?>
                                                                                                      <i class="ti-minus"></i>
                                                                                                    <?php endif ?>
                                                                                                  </td>
                                                                                                </tr>
                                                                                              </tbody>
                                                                                            </table>
                                                                                          </div>
                                                                                        </div>
                                                                                        <div class="modal-footer">
                                                                                          <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Close</button>
                                                                                        </div>
                                                                                      </div>
                                                                                      <!-- /.modal-content -->
                                                                                    </div>
                                                                                    <!-- /.modal-dialog -->
                                                                                  </div>
                                                                                <?php endforeach ?>
                                                                              </div>
                                                                            <?php endif ?>
                                                                          </div>
                                                                          <?php $n++; endforeach; endif; ?>
                                                                        </div>
                                                                      </div>
                                                                    </div>
                                                                    <!-- sasaran kegiatan -->
                                                                    <div class="panel panel-primary">
                                                                      <div class="panel-heading">

                                                                        Sasaran Kegiatan
                                                                      </div>
                                                                      <div class="panel-wrapper collapse in" aria-expanded="true">
                                                                        <div class="panel-body">
                                                                          <?php if (count($unit_kerja_sp)>0): ?>
                                                                            <div class="row">

                                                                              <div class="col-md-12">
                                                                                <button type="button" class="btn btn-primary" onclick="new_sasaran_kegiatan_renstra();">Tambah Sasaran Kegiatan</button>
                                                                                <!-- modal tambah sasaran strategis -->
                                                                                <div id="tambahSasaran3" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                                                                                  <div class="modal-dialog modal-lg">
                                                                                    <div class="modal-content">
                                                                                      <div class="panel-heading">
                                                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                                        <h4 class="modal-title" id="data-title-tambahSasaran3" style="color:white;">Tambah Sasaran Kegiatan</h4>
                                                                                      </div>
                                                                                      <div class="modal-body">
                                                                                        <form class="form-horizontal" id="data-form-tambahSasaran3" action="#!">
                                                                                          <div class="form-group">
                                                                                            <label class="col-sm-12">UNIT KERJA</label>
                                                                                            <div class="col-sm-12">
                                                                                              <select id="data-id_unit_kerja2" name="id_unit_kerja" class="form-control select2" onchange="get_iku_sp();" required>
                                                                                                <?php foreach ($unit_kerja_sp as $key => $value): ?>
                                                                                                  <option value="<?=$value['id_unit_kerja']?>"><?=$value['nama_unit_kerja']?></option>
                                                                                                <?php endforeach ?>
                                                                                              </select>
                                                                                            </div>
                                                                                          </div>
                                                                                          <div class="form-group">
                                                                                            <label class="col-sm-12">IKU PROGRAM</label>
                                                                                            <div class="col-sm-12">
                                                                                              <select id="data-id_iku_sp_renstra" name="id_iku_sp_renstra" class="form-control select2" required>
                                                                                                <option value="">Pilih Iku Program</option>
                                                                                              </select>
                                                                                            </div>
                                                                                          </div>
                                                                                          <div class="form-group">
                                                                                            <label class="col-md-12">NAMA KEGIATAN</label>
                                                                                            <div class="col-md-12">
                                                                                              <input id="data-sasaran_kegiatan_renstra" name="sasaran_kegiatan_renstra" type="text" class="form-control" placeholder="placeholder" required>
                                                                                            </div>
                                                                                          </div>
                                                                                          <button type="submit" id="data-form-submit-tambahSasaran3" hidden></button>
                                                                                        </form>
                                                                                      </div>
                                                                                      <div class="modal-footer">
                                                                                        <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Batal</button>
                                                                                        <button id="data-button-tambahSasaran3" type="button" class="btn btn-primary waves-effect text-left" onclick="add_sasaran_kegiatan_renstra();">Kirim</button>
                                                                                      </div>
                                                                                    </div>
                                                                                    <!-- /.modal-content -->
                                                                                  </div>
                                                                                  <!-- /.modal-dialog -->
                                                                                </div>
                                                                                <?php if(count($sasaran_kegiatan)>0) :?>
                                                                                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahIndikator3">Tambah Indikator</button>
                                                                                  <!-- modal tambah indikator sasaran strategis -->
                                                                                  <div id="tambahIndikator3" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel2" aria-hidden="true" style="display: none;">
                                                                                    <div class="modal-dialog modal-lg">
                                                                                      <div class="modal-content">
                                                                                        <div class="panel-heading">
                                                                                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                                          <h4 class="modal-title" id="myLargeModalLabel2" style="color:white;">Tambah Indikator Kegiatan</h4>
                                                                                        </div>
                                                                                        <div class="modal-body">

                                                                                          <form class="form-horizontal" id="data-form-tambahIndikator3" action="#!">
                                                                                            <div class="form-group">
                                                                                              <label class="col-sm-12">SASARAN</label>
                                                                                              <div class="col-sm-12">
                                                                                                <select id="data-id_sasaran_kegiatan_renstra" name="id_sasaran_kegiatan_renstra" class="form-control select2" required>
                                                                                                  <?php foreach ($sasaran_kegiatan as $key => $value): ?>
                                                                                                    <option value="<?=$value['id_sasaran_kegiatan_renstra']?>"><?=$value['sasaran_kegiatan_renstra']?></option>
                                                                                                  <?php endforeach ?>
                                                                                                </select>
                                                                                              </div>
                                                                                            </div>
                                                                                            <div class="form-group">
                                                                                              <label class="col-md-12">INDIKATOR KEGIATAN</label>
                                                                                              <div class="col-md-12">
                                                                                                <input id="data-iku_sk_renstra" name="iku_sk_renstra" type="text" class="form-control" placeholder="placeholder" required>
                                                                                              </div>
                                                                                            </div>
                                                                                            <div class="form-group">
                                                                                              <label class="col-md-12">DESKRIPSI</label>
                                                                                              <div class="col-md-12">
                                                                                                <textarea name="deskripsi" class="form-control" rows="5"></textarea>
                                                                                              </div>
                                                                                            </div>
                                                                                            
                                                                                            <div class="form-group">
                                                                                              <div class="col-md-6">
                                                                                                <label class="col-sm-12">Satuan Pengukuran</label>
                                                                                                <div class="col-sm-12">
                                                                                                  <select name="id_satuan" class="form-control select2" required>
                                                                                                    <?php foreach ($ref_satuan as $key => $value): ?>
                                                                                                      <option value="<?=$value->id_satuan?>"><?=$value->satuan?></option>
                                                                                                    <?php endforeach ?>
                                                                                                  </select>
                                                                                                </div>
                                                                                              </div>
                                                                                              <div class="col-md-6">
                                                                                                <label class="col-sm-12">Waktu Pengukuran</label>
                                                                                                <div class="col-sm-12">
                                                                                                  <select name="id_waktu" class="form-control" required>
                                                                                                    <option value="per hari">per hari</option>
                                                                                                    <option value="per bulan">per bulan</option>
                                                                                                    <option value="per semester">per semester</option>
                                                                                                    <option value="per tahun">per tahun</option>
                                                                                                  </select>
                                                                                                </div>
                                                                                              </div>
                                                                                            </div>
                                                                                            <hr>

                                                                                            <div class="form-group">
                                                                                              <div class="col-md-12">
                                                                                                <label class="col-sm-12">Kondisi Awal</label>
                                                                                                <div class="col-md-12">
                                                                                                  <input name="kondisi_awal" type="text" class="form-control" placeholder="placeholder" required>
                                                                                                </div>
                                                                                              </div>
                                                                                            </div>
                                                                                            <div class="form-group">
                                                                                              <div class="col-md-6">
                                                                                                <label class="col-sm-12">Target 2019</label>
                                                                                                <div class="col-md-12">
                                                                                                  <input name="target_2019" type="text" class="form-control" placeholder="placeholder" value="0" required>
                                                                                                </div>
                                                                                              </div>
                                                                                              <div class="col-md-6">
                                                                                                <label class="col-sm-12">Target 2020</label>
                                                                                                <div class="col-md-12">
                                                                                                  <input name="target_2020" type="text" class="form-control" placeholder="placeholder" value="0" required>
                                                                                                </div>
                                                                                              </div>
                                                                                            </div>
                                                                                            <div class="form-group">
                                                                                              <div class="col-md-6">
                                                                                                <label class="col-sm-12">Target 2021</label>
                                                                                                <div class="col-md-12">
                                                                                                  <input name="target_2021" type="text" class="form-control" placeholder="placeholder" value="0" required>
                                                                                                </div>
                                                                                              </div>
                                                                                              <div class="col-md-6">
                                                                                                <label class="col-sm-12">Target 2022</label>
                                                                                                <div class="col-md-12">
                                                                                                  <input name="target_2022" type="text" class="form-control" placeholder="placeholder" value="0" required>
                                                                                                </div>
                                                                                              </div>
                                                                                            </div>
                                                                                            <div class="form-group">
                                                                                              <div class="col-md-6">
                                                                                                <label class="col-sm-12">Target 2023</label>
                                                                                                <div class="col-md-12">
                                                                                                  <input name="target_2023" type="text" class="form-control" placeholder="placeholder" value="0" required>
                                                                                                </div>
                                                                                              </div>
                                                                                            </div>
                                                                                            <hr>
                                                                                            <?php

                                                                                            for($tahun=2019;$tahun<=2023;$tahun++){
                                                                                              ?>
                                                                                              <div class="col-md-6">
                                                                                                <div class="form-group">
                                                                                                  <label class="col-sm-12">Anggaran <?=$tahun?></label>
                                                                                                  <div class="col-md-12">
                                                                                                    <div class="input-group">
                                                                                                      <div class="input-group-addon">Rp.</div>
                                                                                                      <input name="anggaran_<?=$tahun?>" type="text" class="form-control" placeholder="placeholder" value="0" required>
                                                                                                    </div>
                                                                                                  </div>
                                                                                                </div>
                                                                                              </div>
                                                                                            <?php } ?>

                                                                                            <hr>

                                                                                            <div class="form-group">
                                                                                              <div class="col-md-6">
                                                                                                <label class="col-sm-12">Kondisi Akhir Target RPJMD</label>
                                                                                                <div class="col-md-12">
                                                                                                  <input name="kondisi_akhir_target" value="0" type="text" class="form-control" placeholder="placeholder" required>
                                                                                                </div>
                                                                                              </div>
                                                                                              <div class="col-md-6">
                                                                                                <label class="col-sm-12">Kondisi Akhir Anggaran RPJMD</label>
                                                                                                <div class="col-md-12">
                                                                                                  <input name="kondisi_akhir_anggaran" value="0" type="text" class="form-control" placeholder="placeholder" required>
                                                                                                </div>
                                                                                              </div>
                                                                                            </div>
                                                                                            <hr>
                                                                                            <div class="form-group">
                                                                                              <div class="col-lg-12">
                                                                                                <label class="col-sm-12">Polorarisasi</label>
                                                                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                                                                  <div class="radio radio-primary">
                                                                                                    <input type="radio" name="polorarisasi" id="radio103" value="Maximaze" checked>
                                                                                                    <label for="radio103"> Maximaze </label> <span class="badge badge-info"  data-toggle="popover" data-placement="top" data-content="adalah kondisi bila realisasi kinerja harus lebih besar dari pada target, atau semakin besar hasil realisasi kinerja maka nilai capaian dari target tersebut semakin bagus. Contohnya : target jumlah pendapatan daerah (bisa menggunakan maximize)"><i class="ti-info" style="font-size:9px"></i></span>
                                                                                                  </div>
                                                                                                </div>
                                                                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                                                                  <div class="radio radio-primary">
                                                                                                    <input type="radio" name="polorarisasi" id="radio113" value="Minimaze">
                                                                                                    <label for="radio113"> Minimaze </label> <span class="badge badge-info"  data-toggle="popover" data-placement="top" data-content="adalah kondisi bila realisasi kinerja harus lebih kecil dari pada target, atau semakin kecil hasil realisasi kinerja maka nilai capaian dari target tersebut semakin bagus. Contohnya : target jumlah kematian bayi (bisa menggunakan minimize)"><i class="ti-info" style="font-size:9px"></i></span>
                                                                                                  </div>
                                                                                                </div>
                                                                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                                                                  <div class="radio radio-primary">
                                                                                                    <input type="radio" name="polorarisasi" id="radio123" value="Stabilize">
                                                                                                    <label for="radio123"> Stabilize </label> <span class="badge badge-info"  data-toggle="popover" data-placement="top" data-content="adalah kondisi bila realisasi kinerja harus mendekati nilai dari pada target, atau semakin kecil selisih antara  realisasi dan target, maka capaian tersebut semakin bagus. Contohnya : target penyerapan anggaran (bisa menggunakan stabilize)"><i class="ti-info" style="font-size:9px"></i></span>
                                                                                                  </div>
                                                                                                </div>
                                                                                              </div>
                                                                                            </div>
                                                                                            <div class="form-group">
                                                                                              <div class="col-lg-12">
                                                                                                <label class="col-sm-12">Jenis Casecading</label>
                                                                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                                                                  <div class="radio radio-primary">
                                                                                                    <input type="radio" name="jenis_casecading" id="radio133" value="Casecading Peta" checked>
                                                                                                    <label for="radio133"> Pemilik IKU </label> <span class="badge badge-info"  data-toggle="popover" data-placement="top" data-content="Bila kondisi IKU tersebut merupakan bagian dari tugas pokok dari unitkerja tersebut atau memiliki tanggung jawab besar atas ketercapaian target"><i class="ti-info" style="font-size:9px"></i></span>
                                                                                                  </div>
                                                                                                </div>
                                                                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                                                                  <div class="radio radio-primary">
                                                                                                    <input type="radio" name="jenis_casecading" id="radio153" value="Non Casecading">
                                                                                                    <label for="radio153"> Bukan Pemilik IKU </label> <span class="badge badge-info"  data-toggle="popover" data-placement="top" data-content="Bila kondisi IKU tersebut merupakan tugas tambahan yang diberikan dan bukan bagian dari tugas pokok unitkerja, atau tidak bertanggung jawab secara langsung ata s target kinerja tersebut"><i class="ti-info" style="font-size:9px"></i></span>
                                                                                                  </div>
                                                                                                </div>
                                                                                              </div>
                                                                                            </div>
                                                                                            <!-- <div class="form-group">
                                                                                              <div class="col-lg-12">
                                                                                                <label class="col-sm-12">Metode Casecading</label>
                                                                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                                                                  <div class="radio radio-primary">
                                                                                                    <input type="radio" name="metode_casecading" id="radio163" value="Direct" checked>
                                                                                                    <label for="radio163"> Direct </label> <span class="badge badge-info"  data-toggle="popover" data-placement="top" data-content="Tooltip on top"><i class="ti-info" style="font-size:9px"></i></span>
                                                                                                  </div>
                                                                                                </div>
                                                                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                                                                  <div class="radio radio-primary">
                                                                                                    <input type="radio" name="metode_casecading" id="radio173" value="In-direct">
                                                                                                    <label for="radio173"> In-direct </label> <span class="badge badge-info"  data-toggle="popover" data-placement="top" data-content="Tooltip on top"><i class="ti-info" style="font-size:9px"></i></span>
                                                                                                  </div>
                                                                                                </div>
                                                                                              </div>
                                                                                            </div> -->
                                                                                            <!-- <div class="form-group">
                                                                                              <div class="col-lg-12">
                                                                                               <label class="col-sm-12">Casecading ke Unit Kerja</label>
                                                                                               <div class="col-lg-12">
                                                                                                <?php foreach ($unit_kerja as $key => $value): ?>
                                                                                                  <div class="checkbox checkbox-primary">
                                                                                                    <input id="checkbox3<?=$key?>" type="checkbox" name="casecade_unit_kerja[]" value="<?=$value->id_unit_kerja?>">
                                                                                                    <label for="checkbox3<?=$key?>"> <?=$value->nama_unit_kerja?> </label>
                                                                                                  </div>
                                                                                                <?php endforeach ?>
                                                                                              </div>
                                                                                            </div>
                                                                                          </div> -->

                                                                                          <button type="submit" id="data-form-submit-tambahIndikator3" hidden></button>
                                                                                        </form>
                                                                                      </div>
                                                                                      <div class="modal-footer">
                                                                                        <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Batal</button>
                                                                                        <button type="button" class="btn btn-primary waves-effect text-left" id="data-button-tambahIndikator3" onclick="add_indikator_sasaran_kegiatan();">Kirim</button>
                                                                                      </div>
                                                                                    </div>
                                                                                    <!-- /.modal-content -->
                                                                                  </div>
                                                                                  <!-- /.modal-dialog -->
                                                                                </div>
                                                                              <?php endif ?>

                                                                            </div>
                                                                          </div>
                                                                        <?php endif ?>


                                                                        <?php
                                                                        if(count($sasaran_kegiatan)==0) :
                                                                          echo '<hr><div class="alert alert-info alert-dismissible fade in" role="alert">
                                                                          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                                                                          </button> -- Tidak ada data. -- </div>';
                                                                        else :
                                                                          $n=1;
                                                                          foreach ($sasaran_kegiatan as $key => $sk): ?>
                                                                            <hr>
                                                                            <div class="row b-t" style="padding-top: 20px;background:#f4f4f4" >
                                                                              <div class="col-md-12 p-b-20">
                                                                                <div class="col-md-12" >
                                                                                 <div class="btn-group m-r-10">
                                                                                  <button aria-expanded="false" data-toggle="dropdown" class="btn btn-default btn-outline btn-sm dropdown-toggle waves-effect waves-light" type="button"> <i class="fa fa-gear m-r-5"></i> <span class="caret"></span></button>
                                                                                  <ul role="menu" class="dropdown-menu">
                                                                                    <li><a href="#!" onclick="edit_sasaran_kegiatan_renstra(<?=$sk['id_sasaran_kegiatan_renstra']?>);">Edit</a></li>
                                                                                    <?php
                                                                                    $id_sk = $sk['id_sasaran_kegiatan_renstra'];
                                                                                    echo"

                                                                                    <li>
                                                                                    <a href='#' class='btn-xs' title='Hapus Sasaran'  onclick='delete_sk_(\"$id_sk\")' data-toggle=\"tooltip\" data-original-title=\"Close\"> Hapus </a></li>";
                                                                                    ?>
                                                                                  </ul>
                                                                                </div>



                                                                                  <button type="button" class="btn btn-warning pull-right" data-toggle="modal" data-target="#lakukanPembobotansk<?=$key?>">Lakukan Pembobotan</button>
                                                                                <strong>Sasaran <?=$n?>.</strong> <?=$sk['sasaran_kegiatan_renstra']?> <span class="label label-purple label-sm"><?=$sk['nama_unit_kerja']?></span>
                                                                              </div>
                                                                              <?php if (count($iku_sasaran_kegiatan[$key])>0): ?>
                                                                                <div class="">

                                                                                  <div id="lakukanPembobotansk<?=$key?>" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabelsk<?=$key?>" aria-hidden="true" style="display: none;">
                                                                                    <div class="modal-dialog modal-lg">
                                                                                      <div class="modal-content">
                                                                                        <div class="panel-heading">
                                                                                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                                          <h4 class="modal-title" id="myLargeModalLabelsk<?=$key?>" style="color:white;">Lakukan Pembobotan</h4>
                                                                                        </div>
                                                                                        <div class="modal-body">
                                                                                          <div class="table-responsive">
                                                                                            <form id="data-form-bobotsk<?=$key?>" action="#!">
                                                                                              <table class="table color-table muted-table">
                                                                                                <thead>
                                                                                                  <tr>
                                                                                                    <th>Nama Indikator</th>
                                                                                                    <th>Bobot</th>
                                                                                                  </tr>
                                                                                                </thead>
                                                                                                <tbody>
                                                                                                 <?php foreach ($iku_sasaran_kegiatan[$key] as $keys => $iku_sk):  ?>
                                                                                                  <tr>
                                                                                                    <td><?=$iku_sk['iku_sk_renstra']?></td>
                                                                                                    <td><input type="number" max="100" min="0" name="bobot[<?=$iku_sk['id_iku_sk_renstra']?>]" value="<?=$iku_sk['bobot']?>" class="form-control" placeholder="Masukan Bobot"> </td>
                                                                                                  </tr>
                                                                                                <?php endforeach ?>
                                                                                              </tbody>
                                                                                            </table>
                                                                                            <button type="submit" id="data-form-submit-bobotsk<?=$key?>" hidden></button>
                                                                                          </form>
                                                                                          <div class="alert alert-info alert-dismissible fade in" role="alert">
                                                                                           <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                                                                                           </button> Jumlah bobot harus 100%. </div>
                                                                                         </div>
                                                                                       </div>
                                                                                       <div class="modal-footer">
                                                                                        <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Batal</button>
                                                                                        <button type="button" class="btn btn-primary waves-effect text-left" onclick="lakukan_pembobotan_sk('<?=$key?>');">Kirim</button>
                                                                                      </div>
                                                                                    </div>
                                                                                    <!-- /.modal-content -->
                                                                                  </div>
                                                                                  <!-- /.modal-dialog -->
                                                                                </div>
                                                                              </div>
                                                                            <?php endif?>
                                                                          </div>
                                                                          <?php if (count($iku_sasaran_kegiatan[$key])>0): ?>
                                                                            <br><br>
                                                                            <div class="table-responsive col-md-12 dragscroll">
                                                                              <table class="table color-table muted-table">
                                                                                <thead>
                                                                                  <tr>
                                                                                    <th>Kode</th>
                                                                                    <th>Indikator</th>
                                                                                    <th>Satuan</th>
                                                                                    <th>Target  2019</th>
                                                                                    <th>Target  2020</th>
                                                                                    <th>Target  2021</th>
                                                                                    <th>Target  2022</th>
                                                                                    <th>Target  2023</th>
                                                                                    <th>Bobot IKU </th>
                                                                                    <!-- <th>Casecading ke Unit Kerja</th> -->
                                                                                    <th>Status Reviu</th>
                                                                                    <th>Opsi</th>
                                                                                  </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                  <?php
                                                                                  $nn=1;
                                                                                  foreach ($iku_sasaran_kegiatan[$key] as $keys => $iku_sk):
                                                                                    $array_smartc = array('s','m','a','r','t','c');
                                                                                    foreach ($array_smartc as $a) {
                                                                                     $array_status_smartc[$a] = $iku_sk['status_'.$a];
                                                                                   }

                                                                                   if (in_array('2', $array_status_smartc)) {
                                                                                     $status_reviu = "ti-alert";
                                                                                   } elseif (count(array_unique($array_status_smartc)) == 1 AND in_array('1', $array_status_smartc)) {
                                                                                     $status_reviu = "ti-star";
                                                                                   } else {
                                                                                     $status_reviu = "ti-time";
                                                                                   }
                                                                                   ?>
                                                                                   <tr>
                                                                                    <td><?=$n?>.<?=$nn?></td>
                                                                                    <td><?=$iku_sk['iku_sk_renstra']?></td>
                                                                                    <td><?=$iku_sk['satuan']?></td>
                                                                                    <?php for ($i=2019; $i <= 2023; $i++) { ?>
                                                                                      <td><?=$iku_sk['target_'.$i]?></td>
                                                                                    <?php } ?>

                                                                                    <td><?=$iku_sk['bobot']?>%</td>
                                                                                    <!-- <td>
                                                                                      <?php
                                    // foreach ($iku_sasaran_strategis_unit_kerja[$key][$keys] as $row){
                                    //   echo "{$row['nama_unit_kerja']}; ";
                                    // }
                                                                                      $a_unit_kerja = array();
                                                                                      foreach($iku_sasaran_kegiatan_unit_kerja[$key][$keys] as $row){
                                                                                        $a_unit_kerja[] = $row['nama_unit_kerja'];
                                                                                      }
                                                                                      $iku_unit_kerja = implode(', ', $a_unit_kerja);
                                                                                      echo $iku_unit_kerja;
                                                                                      ?>
                                                                                    </td> -->
                                                                                    <td><i class="<?=$status_reviu?>" data-toggle="modal" data-target="#statusIndikatorsk<?=$keys?>"></i></td>
                                                                                    <td><a href="<?php echo base_url('renstra_perencanaan/detail/sk/'.$detail->id_skpd.'/'.$iku_sk['id_iku_sk_renstra']);?>" class="btn btn-info" style="color:white;"><i class="ti-eye"></i> Detail</a></td>
                                                                                  </tr>
                                                                                  <?php $nn++; endforeach ?>
                                                                                </tbody>
                                                                              </table>
                                                                              <?php foreach ($iku_sasaran_kegiatan[$key] as $keys => $iku_sk): ?>
                                                                               <div id="statusIndikatorsk<?=$keys?>" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel1" aria-hidden="true" style="display: none;">
                                                                                 <div class="modal-dialog modal-lg">
                                                                                   <div class="modal-content">
                                                                                     <div class="panel-heading">
                                                                                       <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                                       <h4 class="modal-title" id="myLargeModalLabel1" style="color:white;">Status Indikator Kegiatan</h4>
                                                                                     </div>
                                                                                     <div class="modal-body">
                                                                                       <div class="table-responsive">
                                                                                         <table class="table color-table success-table table-bordered">
                                                                                           <thead>
                                                                                             <tr>
                                                                                               <th></th>
                                                                                               <th>Penilaian</th>
                                                                                               <th>Catatan</th>
                                                                                               <th>Status</th>
                                                                                             </tr>
                                                                                           </thead>
                                                                                           <tbody>
                                                                                             <tr>
                                                                                               <td><img src="<?php echo base_url('assets/images/smartc/S.jpg')?>" width="30" height="30"></td>
                                                                                               <td> Definif (tidak normatif, tidak bermakna ganda,  relevan terhadap SS </td>
                                                                                               <td><?=$iku_sk['catatan_s']?></td>
                                                                                               <td>
                                                                                                <?php if ($iku_sk['status_s']=="1"): ?>
                                                                                                 <i class="ti-check" style="color:green;"></i>
                                                                                                 <?php elseif ($iku_sk['status_s']=="2"): ?>
                                                                                                   <i class="ti-close" style="color:red;"></i>
                                                                                                   <?php else: ?>
                                                                                                     <i class="ti-minus"></i>
                                                                                                   <?php endif ?>
                                                                                                 </td>
                                                                                               </tr>
                                                                                               <tr>
                                                                                                 <td><img src="<?php echo base_url('assets/images/smartc/M.jpg')?>" width="30" height="30"></td>
                                                                                                 <td> Dapat diukur dengan jelas dan memiliki satuan persen (%)</td>
                                                                                                 <td><?=$iku_sk['catatan_m']?></td>
                                                                                                 <td>
                                                                                                  <?php if ($iku_sk['status_m']=="1"): ?>
                                                                                                   <i class="ti-check" style="color:green;"></i>
                                                                                                   <?php elseif ($iku_sk['status_m']=="2"): ?>
                                                                                                     <i class="ti-close" style="color:red;"></i>
                                                                                                     <?php else: ?>
                                                                                                       <i class="ti-minus"></i>
                                                                                                     <?php endif ?>
                                                                                                   </td>
                                                                                                 </tr>
                                                                                                 <tr>
                                                                                                   <td><img src="<?php echo base_url('assets/images/smartc/A.jpg')?>" width="30" height="30"></td>
                                                                                                   <td> Disepakati oleh Iku atasanya</td>
                                                                                                   <td><?=$iku_sk['catatan_a']?></td>
                                                                                                   <td>
                                                                                                    <?php if ($iku_sk['status_a']=="1"): ?>
                                                                                                     <i class="ti-check" style="color:green;"></i>
                                                                                                     <?php elseif ($iku_sk['status_a']=="2"): ?>
                                                                                                       <i class="ti-close" style="color:red;"></i>
                                                                                                       <?php else: ?>
                                                                                                         <i class="ti-minus"></i>
                                                                                                       <?php endif ?>
                                                                                                     </td>
                                                                                                   </tr>
                                                                                                   <tr>
                                                                                                     <td><img src="<?php echo base_url('assets/images/smartc/R.jpg')?>" width="30" height="30"></td>
                                                                                                     <td> Ukuran Iku dapat dicapai dan menantang</td>
                                                                                                     <td><?=$iku_sk['catatan_r']?></td>
                                                                                                     <td>
                                                                                                      <?php if ($iku_sk['status_r']=="1"): ?>
                                                                                                       <i class="ti-check" style="color:green;"></i>
                                                                                                       <?php elseif ($iku_sk['status_r']=="2"): ?>
                                                                                                         <i class="ti-close" style="color:red;"></i>
                                                                                                         <?php else: ?>
                                                                                                           <i class="ti-minus"></i>
                                                                                                         <?php endif ?>
                                                                                                       </td>
                                                                                                     </tr>
                                                                                                     <tr>
                                                                                                       <td><img src="<?php echo base_url('assets/images/smartc/T.jpg')?>" width="30" height="30"></td>
                                                                                                       <td> Memiliki batas capain</td>
                                                                                                       <td><?=$iku_sk['catatan_t']?></td>
                                                                                                       <td>
                                                                                                        <?php if ($iku_sk['status_t']=="1"): ?>
                                                                                                         <i class="ti-check" style="color:green;"></i>
                                                                                                         <?php elseif ($iku_sk['status_t']=="2"): ?>
                                                                                                           <i class="ti-close" style="color:red;"></i>
                                                                                                           <?php else: ?>
                                                                                                             <i class="ti-minus"></i>
                                                                                                           <?php endif ?>
                                                                                                         </td>
                                                                                                       </tr>
                                                                                                       <tr>
                                                                                                         <td><img src="<?php echo base_url('assets/images/smartc/C.jpg')?>" width="30" height="30"></td>
                                                                                                         <td> Target iku disesuaikan dengan target organisasi dan selalu disempurnakan <p>          dari tahun ketahun</p></td>
                                                                                                         <td><?=$iku_sk['catatan_c']?></td>
                                                                                                         <td>
                                                                                                          <?php if ($iku_sk['status_c']=="1"): ?>
                                                                                                           <i class="ti-check" style="color:green;"></i>
                                                                                                           <?php elseif ($iku_sk['status_c']=="2"): ?>
                                                                                                             <i class="ti-close" style="color:red;"></i>
                                                                                                             <?php else: ?>
                                                                                                               <i class="ti-minus"></i>
                                                                                                             <?php endif ?>
                                                                                                           </td>
                                                                                                         </tr>
                                                                                                       </tbody>
                                                                                                     </table>
                                                                                                   </div>
                                                                                                 </div>
                                                                                                 <div class="modal-footer">
                                                                                                   <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Close</button>
                                                                                                 </div>
                                                                                               </div>
                                                                                               <!-- /.modal-content -->
                                                                                             </div>
                                                                                             <!-- /.modal-dialog -->
                                                                                           </div>
                                                                                         <?php endforeach ?>
                                                                                       </div>
                                                                                     <?php endif ?>
                                                                                   </div>
                                                                                   <?php $n++; endforeach; endif; ?>
                                                                                 </div>
                                                                               </div>
                                                                             </div>

                                                                           </div>
                                                                         </div>
                                                                       </div>

                                                                       <script type="text/javascript">
                                                                        function delete_ss_(id)
                                                                        {
                                                                          swal({
                                                                            title: "Apakah anda yakin menghapus sasaran strategis?",
                                                                            text: "jika data dihapus maka indikator dari sasaran tersebut akan terhapus juga.",
                                                                            type: "warning",
                                                                            showCancelButton: true,
                                                                            confirmButtonColor: "#DD6B55",
                                                                            confirmButtonText: "Hapus",
                                                                            closeOnConfirm: false
                                                                          }, function(){
                                                                            window.location = "<?php echo base_url();?>renstra_perencanaan/hapus_ss/<?=$this->uri->segment(3)?>/"+id;
                                                                            swal("Berhasil!", "Data telah dihapus.", "success");
                                                                          });
                                                                        }

                                                                        function delete_sp_(id)
                                                                        {
                                                                          swal({
                                                                            title: "Apakah anda yakin menghapus sasaran program?",
                                                                            text: "jika data dihapus maka indikator dari sasaran tersebut akan terhapus juga.",
                                                                            type: "warning",
                                                                            showCancelButton: true,
                                                                            confirmButtonColor: "#DD6B55",
                                                                            confirmButtonText: "Hapus",
                                                                            closeOnConfirm: false
                                                                          }, function(){
                                                                            window.location = "<?php echo base_url();?>renstra_perencanaan/hapus_sp/<?=$this->uri->segment(3)?>/"+id;
                                                                            swal("Berhasil!", "Data telah dihapus.", "success");
                                                                          });
                                                                        }

                                                                        function delete_sk_(id)
                                                                        {
                                                                          swal({
                                                                            title: "Apakah anda yakin menghapus sasaran kegiatan?",
                                                                            text: "jika data dihapus maka indikator dari sasaran tersebut akan terhapus juga.",
                                                                            type: "warning",
                                                                            showCancelButton: true,
                                                                            confirmButtonColor: "#DD6B55",
                                                                            confirmButtonText: "Hapus",
                                                                            closeOnConfirm: false
                                                                          }, function(){
                                                                            window.location = "<?php echo base_url();?>renstra_perencanaan/hapus_sk/<?=$this->uri->segment(3)?>/"+id;
                                                                            swal("Berhasil!", "Data telah dihapus.", "success");
                                                                          });
                                                                        }
                                                                      </script>





                                                                      <script type="text/javascript">


                                                                        function get_tujuan(id_misi=null) {
                                                                          if (id_misi == null) {
                                                                            var id_misi = $("#data-id_misi").val();
                                                                          }
                                                                          $("#data-id_tujuan").attr("readonly",true);
                                                                          $.ajax({
                                                                            url:"<?php echo base_url('renja_perencanaan/get_tujuan_by_misi');?>",
                                                                            type:"GET",
                                                                            data: "id_misi="+id_misi,
                                                                            dataType: "text",

                                                                            success:function(resp){
                                                                              $("#data-id_tujuan").attr("readonly",false);
                                                                              $("#data-id_tujuan").html(resp);
                                                                            },
                                                                            error:function(event, textStatus, errorThrown) {
                                                                              alert('Error Message: '+ textStatus + ' , HTTP Error: '+ errorThrown);
                                                                              $("#data-modal").unblock();
                                                                              $("#data-id_tujuan").html("");
                                                                              $("#data-id_tujuan").attr("readonly",true);
                                                                            }
                                                                          })
                                                                        }


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


                                                                        function block_ui(element) {
                                                                          $(element).block({
                                                                            message: '<h4><img src="<?=base_url('asset/pixel');?>/plugins/images/busy.gif" /> We are processing your request.</h4>',
                                                                            css: {
                                                                              border: '1px solid #fff'
                                                                            }
                                                                          });
                                                                        }
  //sasaran strategis
  function new_sasaran_strategis_renstra() {
    $("#tambahSasaran").modal();
    $("#data-title-tambahSasaran").text("Tambah Sasaran Strategis");
    // $("#data-sub-title").text("");
    $("#data-form-tambahSasaran")[0].reset();
    $("#data-button-tambahSasaran").text("Simpan Data");
    $("#data-button-tambahSasaran").attr("onclick", "add_sasaran_strategis_renstra();");
  }

  function edit_sasaran_strategis_renstra(id) {
    block_ui("#main-content");
    block_ui("#tambahSasaran");

    $.ajax({
      url:"<?php echo base_url('renstra_perencanaan/get_sasaran_strategis_renstra');?>/"+id,
      type:"GET",
      dataType: "json",
      cache: false,

      success:function(resp){
        $("#main-content").unblock();
        $("#tambahSasaran").unblock();

        if (resp == false) {
          $("#data-title-tambahSasaran").text("Data tidak ditemukan!");
          $("#data-button-tambahSasaran").attr("onclick", "");
          swal("Sorry!", "Data tidak ditemukan!", "error");
        } else {
          $("#data-form-tambahSasaran")[0].reset();
          $("#data-title-tambahSasaran").text("Ubah Data");
          $("#data-button-tambahSasaran").text("Simpan Data");
          $("#data-button-tambahSasaran").attr("onclick", "save_sasaran_strategis_renstra("+id+");");
          $("#data-id_iku_sasaran_rpjmd").val(resp.id_iku_sasaran_rpjmd);
          $("#data-id_iku_sasaran_rpjmd").select2();
          if (resp.sasaran_strategis_renstra) { $("#data-sasaran_strategis_renstra").val(resp.sasaran_strategis_renstra); }
          $("#tambahSasaran").modal();
        }
      },
      error:function(event, textStatus, errorThrown) {
        alert('Error Message: '+ textStatus + ' , HTTP Error: '+ errorThrown);
        $("#main-content").unblock();
        $("#tambahSasaran").unblock();
      }
    })
  }

  function add_sasaran_strategis_renstra() {
    block_ui("#tambahSasaran");

    $.ajax({
      url:"<?php echo base_url('renstra_perencanaan/add_sasaran_strategis_renstra/'.$detail->id_skpd);?>",
      type:"POST",
      data: $('#data-form-tambahSasaran').serialize(),

      success:function(resp){
        if (resp == true) {
          swal("Success!", "Data baru telah ditambahkan.", "success");
          window.location.reload(false);
        } else if (resp == false) {
          $("#tambahSasaran").unblock();
          $("#data-form-submit-tambahSasaran").click();
        } else {
          alert('Error Message: '+ resp);
        }
      },
      error:function(event, textStatus, errorThrown) {
        alert('Error Message: '+ textStatus + ' , HTTP Error: '+ errorThrown);
        $("#tambahSasaran").unblock();
      }
    })
  }

  function save_sasaran_strategis_renstra(id) {
    block_ui("#tambahSasaran");

    $.ajax({
      url:"<?php echo base_url('renstra_perencanaan/update_sasaran_strategis_renstra');?>/"+id,
      type:"POST",
      data: $('#data-form-tambahSasaran').serialize(),

      success:function(resp){
        if (resp == true) {
          swal("Success!", "Data telah berhasil diubah.", "success");
          window.location.reload(false);
        } else if (resp == "not found") {
          $("#tambahSasaran").unblock();
          swal("Sorry", "Data tidak ditemukan!", "error");
        } else if (resp == false) {
          $("#tambahSasaran").unblock();
          $("#data-form-submit-tambahSasaran").click();
        } else {
          alert('Error Message: '+ resp);
        }
      },
      error:function(event, textStatus, errorThrown) {
        alert('Error Message: '+ textStatus + ' , HTTP Error: '+ errorThrown);
        $("#tambahSasaran").unblock();
      }
    })
  }

  function add_indikator_sasaran_strategis() {
    block_ui("#tambahIndikator1");

    $.ajax({
      url:"<?php echo base_url('renstra_perencanaan/add_indikator_sasaran_strategis/'.$detail->id_skpd);?>",
      type:"POST",
      data: $('#data-form-tambahIndikator1').serialize(),

      success:function(resp){
        if (resp == true) {
          swal("Success!", "Data baru telah ditambahkan.", "success");
          window.location.reload(false);
        } else if (resp == false) {
          $("#tambahIndikator1").unblock();
          $("#data-form-submit-tambahIndikator1").click();
        } else {
          alert('Error Message: '+ resp);
        }
      },
      error:function(event, textStatus, errorThrown) {
        alert('Error Message: '+ textStatus + ' , HTTP Error: '+ errorThrown);
        $("#tambahIndikator1").unblock();
      }
    })
  }

  function lakukan_pembobotan_ss(id_iku) {
    block_ui("#lakukanPembobotanss"+id_iku);

    $.ajax({
      url:"<?php echo base_url('renstra_perencanaan/lakukan_pembobotan_ss/'.$detail->id_skpd);?>",
      type:"POST",
      data: $('#data-form-bobotss'+id_iku).serialize(),

      success:function(resp){
        if (resp == true) {
          swal("Success!", "Data baru telah ditambahkan.", "success");
          window.location.reload(false);
        } else if (resp == false) {
          $("#lakukanPembobotanss"+id_iku).unblock();
          $("#data-form-submit-bobotss"+id_iku).click();
        } else if (resp == "nothing") {
          $("#lakukanPembobotanss"+id_iku).unblock();
          swal("Sorry :(", "Jumlah bobot harus 100%.", "warning");
        } else {
          alert('Error Message: '+ resp);
        }
      },
      error:function(event, textStatus, errorThrown) {
        alert('Error Message: '+ textStatus + ' , HTTP Error: '+ errorThrown);
        $("#lakukanPembobotanss"+id_iku).unblock();
      }
    })
  }
  //sasaran program
  function get_iku_ss(id=null,selected=null) {
    if (id == null) {
      var id = $("#data-id_unit_kerja").val();
    }
    $("#data-id_iku_ss_renstra").attr("readonly",true);
    $.ajax({
      url:"<?php echo base_url('renstra_perencanaan/get_iku_ss_by_unit_kerja');?>",
      type:"GET",
      data: "id_unit_kerja="+id,
      dataType: "text",

      success:function(resp){
        $("#data-id_iku_ss_renstra").attr("readonly",false);
        $("#data-id_iku_ss_renstra").html(resp);
        if (selected) {$("#data-id_iku_ss_renstra").val(selected);}
        $("#data-id_iku_ss_renstra").select2();
      },
      error:function(event, textStatus, errorThrown) {
        alert('Error Message: '+ textStatus + ' , HTTP Error: '+ errorThrown);
        $("#tambahSasaran2").unblock();
        $("#data-id_iku_ss_renstra").html("");
        $("#data-id_iku_ss_renstra").attr("readonly",true);
      }
    })
  }

  function new_sasaran_program_renstra() {
    $("#tambahSasaran2").modal();
    $("#data-title-tambahSasaran2").text("Tambah Sasaran Program");
    // $("#data-sub-title").text("");
    $("#data-form-tambahSasaran2")[0].reset();
    $("#data-button-tambahSasaran2").text("Simpan Data");
    $("#data-button-tambahSasaran2").attr("onclick", "add_sasaran_program_renstra();");
    get_iku_ss('<?=($unit_kerja_ss)?$unit_kerja_ss[0]["id_unit_kerja"]:""?>');
  }

  function edit_sasaran_program_renstra(id) {
    block_ui("#main-content");
    block_ui("#tambahSasaran2");

    $.ajax({
      url:"<?php echo base_url('renstra_perencanaan/get_sasaran_program_renstra');?>/"+id,
      type:"GET",
      dataType: "json",
      cache: false,

      success:function(resp){
        $("#main-content").unblock();
        $("#tambahSasaran2").unblock();

        if (resp == false) {
          $("#data-title-tambahSasaran2").text("Data tidak ditemukan!");
          $("#data-button-tambahSasaran2").attr("onclick", "");
          swal("Sorry!", "Data tidak ditemukan!", "error");
        } else {
          $("#data-form-tambahSasaran2")[0].reset();
          $("#data-title-tambahSasaran2").text("Ubah Data");
          $("#data-button-tambahSasaran2").text("Simpan Data");
          $("#data-button-tambahSasaran2").attr("onclick", "save_sasaran_program_renstra("+id+");");
          $("#data-id_unit_kerja").val(resp.id_unit_kerja);
          $("#data-id_unit_kerja").select2();
          get_iku_ss(resp.id_unit_kerja,resp.id_iku_ss_renstra);
          if (resp.sasaran_program_renstra) { $("#data-sasaran_program_renstra").val(resp.sasaran_program_renstra); }
          $("#tambahSasaran2").modal();
        }
      },
      error:function(event, textStatus, errorThrown) {
        alert('Error Message: '+ textStatus + ' , HTTP Error: '+ errorThrown);
        $("#main-content").unblock();
        $("#tambahSasaran2").unblock();
      }
    })
  }

  function add_sasaran_program_renstra() {
    block_ui("#tambahSasaran2");

    $.ajax({
      url:"<?php echo base_url('renstra_perencanaan/add_sasaran_program_renstra/'.$detail->id_skpd);?>",
      type:"POST",
      data: $('#data-form-tambahSasaran2').serialize(),

      success:function(resp){
        if (resp == true) {
          swal("Success!", "Data baru telah ditambahkan.", "success");
          window.location.reload(false);
        } else if (resp == false) {
          $("#tambahSasaran2").unblock();
          $("#data-form-submit-tambahSasaran2").click();
        } else {
          alert('Error Message: '+ resp);
        }
      },
      error:function(event, textStatus, errorThrown) {
        alert('Error Message: '+ textStatus + ' , HTTP Error: '+ errorThrown);
        $("#tambahSasaran2").unblock();
      }
    })
  }

  function save_sasaran_program_renstra(id) {
    block_ui("#tambahSasaran2");

    $.ajax({
      url:"<?php echo base_url('renstra_perencanaan/update_sasaran_program_renstra');?>/"+id,
      type:"POST",
      data: $('#data-form-tambahSasaran2').serialize(),

      success:function(resp){
        if (resp == true) {
          swal("Success!", "Data telah berhasil diubah.", "success");
          window.location.reload(false);
        } else if (resp == "not found") {
          $("#tambahSasaran2").unblock();
          swal("Sorry", "Data tidak ditemukan!", "error");
        } else if (resp == false) {
          $("#tambahSasaran2").unblock();
          $("#data-form-submit-tambahSasaran2").click();
        } else {
          alert('Error Message: '+ resp);
        }
      },
      error:function(event, textStatus, errorThrown) {
        alert('Error Message: '+ textStatus + ' , HTTP Error: '+ errorThrown);
        $("#tambahSasaran2").unblock();
      }
    })
  }

  function add_indikator_sasaran_program() {
    block_ui("#tambahIndikator2");

    $.ajax({
      url:"<?php echo base_url('renstra_perencanaan/add_indikator_sasaran_program/'.$detail->id_skpd);?>",
      type:"POST",
      data: $('#data-form-tambahIndikator2').serialize(),

      success:function(resp){
        if (resp == true) {
          swal("Success!", "Data baru telah ditambahkan.", "success");
          window.location.reload(false);
        } else if (resp == false) {
          $("#tambahIndikator2").unblock();
          $("#data-form-submit-tambahIndikator2").click();
        } else {
          alert('Error Message: '+ resp);
        }
      },
      error:function(event, textStatus, errorThrown) {
        alert('Error Message: '+ textStatus + ' , HTTP Error: '+ errorThrown);
        $("#tambahIndikator2").unblock();
      }
    })
  }

  function lakukan_pembobotan_sp(id_iku) {
    block_ui("#lakukanPembobotansp"+id_iku);

    $.ajax({
      url:"<?php echo base_url('renstra_perencanaan/lakukan_pembobotan_sp/'.$detail->id_skpd);?>",
      type:"POST",
      data: $('#data-form-bobotsp'+id_iku).serialize(),

      success:function(resp){
        if (resp == true) {
          swal("Success!", "Data baru telah ditambahkan.", "success");
          window.location.reload(false);
        } else if (resp == false) {
          $("#lakukanPembobotansp"+id_iku).unblock();
          $("#data-form-submit-bobotsp"+id_iku).click();
        } else if (resp == "nothing") {
          $("#lakukanPembobotansp"+id_iku).unblock();
          swal("Sorry :(", "Jumlah bobot harus 100%.", "warning");
        } else {
          alert('Error Message: '+ resp);
        }
      },
      error:function(event, textStatus, errorThrown) {
        alert('Error Message: '+ textStatus + ' , HTTP Error: '+ errorThrown);
        $("#lakukanPembobotansp"+id_iku).unblock();
      }
    })
  }
  //sasaran kegiatan
  function get_iku_sp(id=null,selected=null) {
    if (id == null) {
      var id = $("#data-id_unit_kerja2").val();
    }
    $("#data-id_iku_sp_renstra").attr("readonly",true);
    $.ajax({
      url:"<?php echo base_url('renstra_perencanaan/get_iku_sp_by_unit_kerja');?>",
      type:"GET",
      data: "id_unit_kerja="+id,
      dataType: "text",

      success:function(resp){
        $("#data-id_iku_sp_renstra").attr("readonly",false);
        $("#data-id_iku_sp_renstra").html(resp);
        if (selected) {$("#data-id_iku_sp_renstra").val(selected);}
        $("#data-id_iku_sp_renstra").select2();
      },
      error:function(event, textStatus, errorThrown) {
        alert('Error Message: '+ textStatus + ' , HTTP Error: '+ errorThrown);
        $("#tambahSasaran3").unblock();
        $("#data-id_iku_sp_renstra").html("");
        $("#data-id_iku_sp_renstra").attr("readonly",true);
      }
    })
  }

  function new_sasaran_kegiatan_renstra() {
    $("#tambahSasaran3").modal();
    $("#data-title-tambahSasaran3").text("Tambah Sasaran Kegiatan");
    // $("#data-sub-title").text("");
    $("#data-form-tambahSasaran3")[0].reset();
    $("#data-button-tambahSasaran3").text("Simpan Data");
    $("#data-button-tambahSasaran3").attr("onclick", "add_sasaran_kegiatan_renstra();");
    get_iku_sp('<?=($unit_kerja_sp)?$unit_kerja_sp[0]["id_unit_kerja"]:""?>');
  }

  function edit_sasaran_kegiatan_renstra(id) {
    block_ui("#main-content");
    block_ui("#tambahSasaran3");

    $.ajax({
      url:"<?php echo base_url('renstra_perencanaan/get_sasaran_kegiatan_renstra');?>/"+id,
      type:"GET",
      dataType: "json",
      cache: false,

      success:function(resp){
        $("#main-content").unblock();
        $("#tambahSasaran3").unblock();

        if (resp == false) {
          $("#data-title-tambahSasaran3").text("Data tidak ditemukan!");
          $("#data-button-tambahSasaran3").attr("onclick", "");
          swal("Sorry!", "Data tidak ditemukan!", "error");
        } else {
          $("#data-form-tambahSasaran3")[0].reset();
          $("#data-title-tambahSasaran3").text("Ubah Data");
          $("#data-button-tambahSasaran3").text("Simpan Data");
          $("#data-button-tambahSasaran3").attr("onclick", "save_sasaran_kegiatan_renstra("+id+");");
          $("#data-id_unit_kerja2").val(resp.id_unit_kerja);
          $("#data-id_unit_kerja2").select2();
          get_iku_sp(resp.id_unit_kerja,resp.id_iku_sp_renstra);
          if (resp.sasaran_kegiatan_renstra) { $("#data-sasaran_kegiatan_renstra").val(resp.sasaran_kegiatan_renstra); }
          $("#tambahSasaran3").modal();
        }
      },
      error:function(event, textStatus, errorThrown) {
        alert('Error Message: '+ textStatus + ' , HTTP Error: '+ errorThrown);
        $("#main-content").unblock();
        $("#tambahSasaran3").unblock();
      }
    })
  }

  function add_sasaran_kegiatan_renstra() {
    block_ui("#tambahSasaran3");

    $.ajax({
      url:"<?php echo base_url('renstra_perencanaan/add_sasaran_kegiatan_renstra/'.$detail->id_skpd);?>",
      type:"POST",
      data: $('#data-form-tambahSasaran3').serialize(),

      success:function(resp){
        if (resp == true) {
          swal("Success!", "Data baru telah ditambahkan.", "success");
          window.location.reload(false);
        } else if (resp == false) {
          $("#tambahSasaran3").unblock();
          $("#data-form-submit-tambahSasaran3").click();
        } else {
          alert('Error Message: '+ resp);
        }
      },
      error:function(event, textStatus, errorThrown) {
        alert('Error Message: '+ textStatus + ' , HTTP Error: '+ errorThrown);
        $("#tambahSasaran3").unblock();
      }
    })
  }

  function save_sasaran_kegiatan_renstra(id) {
    block_ui("#tambahSasaran3");

    $.ajax({
      url:"<?php echo base_url('renstra_perencanaan/update_sasaran_kegiatan_renstra');?>/"+id,
      type:"POST",
      data: $('#data-form-tambahSasaran3').serialize(),

      success:function(resp){
        if (resp == true) {
          swal("Success!", "Data telah berhasil diubah.", "success");
          window.location.reload(false);
        } else if (resp == "not found") {
          $("#tambahSasaran3").unblock();
          swal("Sorry", "Data tidak ditemukan!", "error");
        } else if (resp == false) {
          $("#tambahSasaran3").unblock();
          $("#data-form-submit-tambahSasaran3").click();
        } else {
          alert('Error Message: '+ resp);
        }
      },
      error:function(event, textStatus, errorThrown) {
        alert('Error Message: '+ textStatus + ' , HTTP Error: '+ errorThrown);
        $("#tambahSasaran3").unblock();
      }
    })
  }

  function add_indikator_sasaran_kegiatan() {
    block_ui("#tambahIndikator3");

    $.ajax({
      url:"<?php echo base_url('renstra_perencanaan/add_indikator_sasaran_kegiatan/'.$detail->id_skpd);?>",
      type:"POST",
      data: $('#data-form-tambahIndikator3').serialize(),

      success:function(resp){
        if (resp == true) {
          swal("Success!", "Data baru telah ditambahkan.", "success");
          window.location.reload(false);
        } else if (resp == false) {
          $("#tambahIndikator3").unblock();
          $("#data-form-submit-tambahIndikator3").click();
        } else {
          alert('Error Message: '+ resp);
        }
      },
      error:function(event, textStatus, errorThrown) {
        alert('Error Message: '+ textStatus + ' , HTTP Error: '+ errorThrown);
        $("#tambahIndikator3").unblock();
      }
    })
  }

  function lakukan_pembobotan_sk(id_iku) {
    block_ui("#lakukanPembobotansk"+id_iku);

    $.ajax({
      url:"<?php echo base_url('renstra_perencanaan/lakukan_pembobotan_sk/'.$detail->id_skpd);?>",
      type:"POST",
      data: $('#data-form-bobotsk'+id_iku).serialize(),

      success:function(resp){
        if (resp == true) {
          swal("Success!", "Data baru telah ditambahkan.", "success");
          window.location.reload(false);
        } else if (resp == false) {
          $("#lakukanPembobotansk"+id_iku).unblock();
          $("#data-form-submit-bobotsk"+id_iku).click();
        } else if (resp == "nothing") {
          $("#lakukanPembobotansk"+id_iku).unblock();
          swal("Sorry :(", "Jumlah bobot harus 100%.", "warning");
        } else {
          alert('Error Message: '+ resp);
        }
      },
      error:function(event, textStatus, errorThrown) {
        alert('Error Message: '+ textStatus + ' , HTTP Error: '+ errorThrown);
        $("#lakukanPembobotansk"+id_iku).unblock();
      }
    })
  }
</script>
