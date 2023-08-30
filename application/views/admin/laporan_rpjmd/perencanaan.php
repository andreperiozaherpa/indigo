 <div class="container-fluid">

  <div class="row bg-title">
    <!-- .page title -->
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
      <h4 class="page-title">Laporan Perencanaan RPJMD</h4>
    </div>
    <!-- /.page title -->
    <!-- .breadcrumb -->
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

      <ol class="breadcrumb">
        <li><a href="<?= base_url();?>/admin">Dashboard</a></li>
        <li class="active">Laporan Perencanaan RPJMD</li>
      </ol>
    </div>
    <!-- /.breadcrumb -->
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="white-box">
        <div class="row">
          <form method="GET">
            <div class="col-md-6">
              <div class="form-group">
                <label for="exampleInputEmail1">SKPD</label>
                <select name="id_skpd" class="form-control select2">
                  <option value="">Semua SKPD</option>
                  <?php 
                  foreach($skpd as $r){
                    $selected = (@$_GET['id_skpd'] == $r->id_skpd) ? "selected" : "" ;
                    echo'<option value="'.$r->id_skpd.'" '.$selected.'>'.$r->nama_skpd.'</option>';
                  }
                  ?>
                </select>       
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">

                <br>
                <button type="submit" class="btn btn-primary m-t-5">Filter</button>
                <a href="javascript:void(0)" onclick="downloadExcel('rpjmd_perencanaan','Laporan Perencanaan RPJMD')" class="btn btn-danger m-t-5 pull-right"><i class="fa fa-print"></i> Cetak Laporan </a>
              </div>
            </div>

          </form>
        </div>

      </div>
    </div>

  </div>
  <style>
    #rpjmd_perencanaan th 
    {
      text-align: center; 
      vertical-align: middle;
      background-color: #55a3a7; 
    }
  </style>

  <div class="row">
    <div class="col-md-12">
      <div class="white-box table-responsive dragscroll">
        <table id="rpjmd_perencanaan" class="table color-table dark-table table-hover table-bordered">
          <thead>
            <tr  style="text-align: center;">
              <th style="min-width:50px" rowspan="3" align="center" valign="midle">Misi/Tujuan/Sasaran Program Pembangunan Daerah</th>
              <th style="min-width:50px"  rowspan="3" align="center" valign="midle"> Indikator Kinerja (tujuan/impact/outcome)</th>
              <th style="min-width:50px"  rowspan="3" align="center" valign="midle">Kondisi Kinerja Awal RPJMD (Tahun 0)</th>
              <th style="min-width:50px" colspan="11" align="center" valign="midle">Capaian Kinerja Program dan Kerangka Pendanaan</th>
              <th style="min-width:50px" rowspan="3" align="center" valign="midle">Perangkat Daerah Penanggung Jawab</th>
            </tr>
            <tr>

              <th style="min-width:50px" colspan="2" align="center" valign="midle">2019</th>
              <th style="min-width:50px" colspan="2" align="center" valign="midle">2020</th>
              <th style="min-width:50px" colspan="2" align="center" valign="midle">2021</th>
              <th style="min-width:50px" colspan="2" align="center" valign="midle">2022</th>
              <th style="min-width:50px" colspan="2" align="center" valign="midle">2023</th>
              <th style="min-width:50px" rowspan="2" align="center" valign="midle">Kondisi Kinerja pada akhir periode RPJMD</th>
            </tr>
            <tr>
              <th style="min-width:50px" align="center" valign="midle">target</th>
              <th style="min-width:50px" align="center" valign="midle">Rp</th>
              <th style="min-width:50px" align="center" valign="midle">target</th>
              <th style="min-width:50px" align="center" valign="midle">Rp</th>
              <th style="min-width:50px" align="center" valign="midle">target</th>
              <th style="min-width:50px" align="center" valign="midle">Rp</th>
              <th style="min-width:50px" align="center" valign="midle">target</th>
              <th style="min-width:50px" align="center" valign="midle">Rp</th>
              <th style="min-width:50px" align="center" valign="midle">target</th>
              <th style="min-width:50px" align="center" valign="midle">Rp</th>
            </tr>
            <tr>
              <th style="min-width:50px" align="center" valign="midle">1</th>
              <th style="min-width:50px" align="center" valign="midle">2</th>
              <th style="min-width:50px" align="center" valign="midle" >3</th>
              <th style="min-width:50px" align="center" valign="midle">4</th>
              <th style="min-width:50px" align="center" valign="midle">5</th>
              <th style="min-width:50px" align="center" valign="midle">6</th>
              <th style="min-width:50px" align="center" valign="midle">7</th>
              <th style="min-width:50px" align="center" valign="midle">8</th>
              <th style="min-width:50px" align="center" valign="midle">9</th>
              <th style="min-width:50px" align="center" valign="midle">10</th>
              <th style="min-width:50px" align="center" valign="midle">11</th>
              <th style="min-width:50px" align="center" valign="midle">12</th>
              <th style="min-width:50px" align="center" valign="midle">13</th>
              <th style="min-width:50px" align="center" valign="midle">14</th>
              <th style="min-width:50px" align="center" valign="midle">15</th>
            </tr>
          </thead>
          <tbody>
            <?php 
            foreach($misi as $n => $m){
              $n=$n+1;
              $tujuan = $this->laporan_sakip_model->get_tujuan_by_misi($m->id_misi);
              $empty_sasaran = true;
              foreach($tujuan as $t){
                $sasaran = $this->laporan_sakip_model->get_sasaran_rpjmd_by_tujuan($t->id_tujuan);
                foreach($sasaran as $ns => $s){
                  $iku_sasaran = $this->laporan_sakip_model->get_iku_sasaran_rpjmd($s->id_sasaran_rpjmd,@$_GET['id_skpd']);
                
                  if(!empty($iku_sasaran)){
                    $empty_sasaran = false;break;
                  }
                  $program = $this->laporan_sakip_model->get_program_by_sasaran($s->id_sasaran_rpjmd);
                  foreach($program as $np => $p){
                    $iku_program = $this->laporan_sakip_model->get_iku_program($p->id_program_rpjmd,@$_GET['id_skpd']);

                    if(!empty($iku_program)){
                      $empty_sasaran = false;break;
                    }
                  }
                }
                
              }
              if(!$empty_sasaran){
                ?>
                <tr class="success">
                  <td style="min-width:50px" colspan="17">MISI <?=$n?> : <?=$m->misi?> </td>
                </tr>
                <?php
              } 
              foreach($tujuan as $nt=> $t){
                $nt=$nt+1;
                $empty_sasaran = true;
                $sasaran = $this->laporan_sakip_model->get_sasaran_rpjmd_by_tujuan($t->id_tujuan);
                foreach($sasaran as $ns => $s){
                  $iku_sasaran = $this->laporan_sakip_model->get_iku_sasaran_rpjmd($s->id_sasaran_rpjmd,@$_GET['id_skpd']);
                
                  if(!empty($iku_sasaran)){
                    $empty_sasaran = false;break;
                  }
                  $program = $this->laporan_sakip_model->get_program_by_sasaran($s->id_sasaran_rpjmd);
                  foreach($program as $np => $p){
                    $iku_program = $this->laporan_sakip_model->get_iku_program($p->id_program_rpjmd,@$_GET['id_skpd']);

                    if(!empty($iku_program)){
                      $empty_sasaran = false;break;
                    }
                  }
                }
                if(!$empty_sasaran){
                  ?>
                  <tr class="warning">
                    <td style="min-width:50px" colspan="17">TUJUAN <?=$nt?> : <?=$t->tujuan?> </td>
                  </tr>
                  <?php
                  foreach($sasaran as $ns => $s){
                    $ns=$ns+1;
                    $iku_sasaran = $this->laporan_sakip_model->get_iku_sasaran_rpjmd($s->id_sasaran_rpjmd,@$_GET['id_skpd']);
                    $program = $this->laporan_sakip_model->get_program_by_sasaran($s->id_sasaran_rpjmd);
                    if ($iku_sasaran) {
                    ?>
                    <tr>
                      <td style="min-width:50px" rowspan="<?=count($iku_sasaran) == 0 ? 1 : count($iku_sasaran)?>">SASARAN <?=$ns?> : <?=$s->sasaran_rpjmd?> </td>
                      <td style="min-width:50px"><?=isset($iku_sasaran[0]) ? $iku_sasaran[0]->iku_sasaran_rpjmd : '-'?></td>
                      <td style="min-width:50px"><?=empty($iku_sasaran[0]->kondisi_awal) ? '-' : $iku_sasaran[0]->kondisi_awal?></td>
                      <?php 
                      for($tahun=2019;$tahun<=2023;$tahun++){
                        $target = 'target_'.$tahun;
                        $anggaran = 'anggaran_'.$tahun;
                        ?>
                        <td style="min-width:50px"><?=empty($iku_sasaran[0]->$target) ? '-' : $iku_sasaran[0]->$target.' '.$iku_sasaran[0]->satuan?></td>
                        <td style="min-width:50px">-</td>
                      <?php } ?>
                      <td style="min-width:50px"><?=empty($iku_sasaran[0]->kondisi_akhir) ? '-' : $iku_sasaran[0]->kondisi_akhir?></td>
                      <td style="min-width:50px">
                        <?php 

                        if(isset($iku_sasaran[0]->skpd)){
                          $list_skpd = array();
                          foreach($iku_sasaran[0]->skpd as $s){
                            $list_skpd[] = $s->nama_skpd;
                          }
                          echo implode(', ', $list_skpd);
                        }else{
                          echo "-";
                        }

                        ?>

                      </td>
                    </tr>
                    <?php
                    foreach($iku_sasaran as $nis => $is){
                      if($nis!==0){
                        ?>
                        <tr>
                          <td style="min-width:50px"><?=$is->iku_sasaran_rpjmd?></td>
                          <td style="min-width:50px"><?=$is->kondisi_awal?></td>
                          <?php 
                          for($tahun=2019;$tahun<=2023;$tahun++){
                            $target = 'target_'.$tahun;
                            $anggaran = 'anggaran_'.$tahun;
                            ?>
                            <td style="min-width:50px"><?=empty($is->$target) ? '-' : $is->$target.' '.$is->satuan?></td>
                            <td style="min-width:50px">-</td>
                          <?php } ?>
                      <td style="min-width:50px"><?=$is->kondisi_akhir?></td>
                          <td style="min-width:50px">

                            <?php 
                            $list_skpd = array();
                            foreach($is->skpd as $s){
                              $list_skpd[] = $s->nama_skpd;
                            }
                            echo implode(', ', $list_skpd);
                            ?>
                          </td>
                        </tr>
                        <?php
                      }
                    }
                  }

                    foreach($program as $np => $p){
                      $np=$np+1;
                      $iku_program = $this->laporan_sakip_model->get_iku_program($p->id_program_rpjmd,@$_GET['id_skpd']);
                      if ($iku_program) {
                      ?>
                      <tr>
                        <td style="min-width:50px" rowspan="<?=count($iku_program) == 0 ? 1 : count($iku_program)?>">PROGRAM <?=$np?> : <?=$p->program_rpjmd?> </td>
                        <td style="min-width:50px"><?=isset($iku_program[0]) ? $iku_program[0]->iku_program_rpjmd : '-'?></td>
                        <td style="min-width:50px"><?=empty($iku_program[0]->kondisi_awal) ? '-' : $iku_program[0]->kondisi_awal?></td>
                        <?php 
                        for($tahun=2019;$tahun<=2023;$tahun++){
                          $target = 'target_'.$tahun;
                          $anggaran = 'target_anggaran_'.$tahun;
                          ?>
                          <td style="min-width:50px"><?=empty($iku_program[0]->$target) ? '-' : $iku_program[0]->$target.' '.$iku_program[0]->satuan?></td>
                          <td style="min-width:50px" rowspan="<?=count($iku_program) == 0 ? 1 : count($iku_program)?>"><?=empty($p->$anggaran) ? '-' : rupiah($p->$anggaran)?></td>
                        <?php } ?>
                      <td style="min-width:50px"><?=empty($iku_program[0]->kondisi_akhir) ? '-' : $iku_program[0]->kondisi_akhir?></td>
                        <td style="min-width:50px">
                          <?php 
                          if(isset($iku_program[0]->skpd)){
                            $list_skpd = array();
                            foreach($iku_program[0]->skpd as $s){
                              $list_skpd[] = $s->nama_skpd;
                            }
                            echo implode(', ', $list_skpd);
                          }else{
                            echo "-";
                          }

                          ?></td>
                        </tr>
                        <?php
                        foreach($iku_program as $nip => $ip){
                          if($nip!==0){
                            ?>
                            <tr>
                              <td style="min-width:50px"><?=$ip->iku_program_rpjmd?></td>
                              <td style="min-width:50px"><?=$ip->kondisi_awal?></td>
                              <?php 
                              for($tahun=2019;$tahun<=2023;$tahun++){
                                $target = 'target_'.$tahun;
                                $anggaran = 'anggaran_'.$tahun;
                                ?>
                                <td style="min-width:50px"><?=empty($ip->$target) ? '-' : $ip->$target.' '.$ip->satuan?></td>
                                <!-- <td style="min-width:50px"><?=rupiah($ip->$anggaran)?></td> -->
                              <?php } ?>
                      <td style="min-width:50px"><?=$ip->kondisi_akhir?></td>
                              <td style="min-width:50px">

                                <?php 
                                $list_skpd = array();
                                foreach($ip->skpd as $s){
                                  $list_skpd[] = $s->nama_skpd;
                                }
                                echo implode(', ', $list_skpd);
                                ?>
                              </td>
                            </tr>
                            <?php
                          }
                        }
                        }
                      }
                    }
                  }
                }
                ?>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>