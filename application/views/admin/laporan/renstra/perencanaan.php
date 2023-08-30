 <div class="container-fluid">

 	<div class="row bg-title">
 		<!-- .page title -->
 		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
 			<h4 class="page-title">Laporan Perencanaan</h4>
 		</div>
 		<!-- /.page title -->
 		<!-- .breadcrumb -->
 		<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

 			<ol class="breadcrumb">
 				<li><a href="<?= base_url();?>/admin">Dashboard</a></li>
 				<li class="active">Laporan Perencanaan</li>
 			</ol>
 		</div>
 		<!-- /.breadcrumb -->
 	</div>

 	<div class="row">
 		<div class="col-md-12">
 			<div class="white-box">
 				<div class="row">
 					<form method="GET">
            <!-- <div class="col-md-3">
             <div class="form-group">
              <label for="exampleInputEmail1">Tahun</label>
              <select name="tahun" class="form-control">
               <option>2019</option>
               <option>2020</option>
               <option>2021</option>
               <option>2022</option>
               <option>2023</option>

             </select>				
           </div>
         </div> -->
         <?php if($user_level=='Administrator'){ ?>
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
    <?php } ?>
    <div class="col-md-3">
     <div class="form-group">

      <br>
         <?php if($user_level=='Administrator'){ ?>
      <button type="submit" class="btn btn-primary m-t-5">Filter</button>
    <?php } ?>
      <a href="javascript:void(0)" onclick="downloadExcel('renstra_perencanaan','Laporan Perencanaan Renstra')" class="btn btn-danger m-t-5 pull-right"><i class="fa fa-print"></i> Cetak Laporan </a>
    </div>
  </div>

</form>
</div>

</div>
</div>

</div>
<!-- .row -->

  <style>
    #renstra_perencanaan th 
    {
      text-align: center; 
      vertical-align: middle;
      background-color: #55a3a7; 
    }
  </style>
  <div class="row">
    <div class="col-md-12">
      <div class="white-box table-responsive dragscroll">

        <table id="renstra_perencanaan" class="table color-table dark-table table-hover table-bordered">
          <thead>
            <tr  style="text-align: center;">
              <th style="min-width:50px" rowspan="3" align="center" valign="midle">Misi/Tujuan/Sasaran Program Pembangunan Daerah</th>
              <th style="min-width:50px"  rowspan="3" align="center" valign="midle"> Indikator Kinerja (tujuan/impact/outcome)</th>
              <th style="min-width:50px"  rowspan="3" align="center" valign="midle">Kondisi Kinerja Awal Renstra (Tahun 0)</th>
              <th style="min-width:50px" colspan="12" align="center" valign="midle">Capaian Kinerja Program dan Kerangka Pendanaan</th>
              <th style="min-width:50px" rowspan="3" align="center" valign="midle">Unit Penanggung Jawab</th>
              <th style="min-width:50px" rowspan="3" align="center" valign="midle">Casecading Ke</th>
            </tr>
            <tr>

              <th style="min-width:50px" colspan="2" align="center" valign="midle">2019</th>
              <th style="min-width:50px" colspan="2" align="center" valign="midle">2020</th>
              <th style="min-width:50px" colspan="2" align="center" valign="midle">2021</th>
              <th style="min-width:50px" colspan="2" align="center" valign="midle">2022</th>
              <th style="min-width:50px" colspan="2" align="center" valign="midle">2023</th>
              <th style="min-width:50px" colspan="2" align="center" valign="midle">Kondisi Kinerja pada akhir periode Renstra</th>
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
              <th style="min-width:50px" align="center" valign="midle">16</th>
              <th style="min-width:50px" align="center" valign="midle">17</th>
            </tr>
          </thead>
          <tbody>
            <?php 
            foreach($misi as $n => $m){
              $n=$n+1;
              $tujuan = $this->laporan_sakip_model->get_tujuan_by_misi($m->id_misi);
              $empty_sasaran = true;
              foreach($tujuan as $t){
                $sasaran = $this->laporan_sakip_model->get_sasaran_strategis_renstra_by_tujuan($t->id_tujuan,$id_skpd);
                
                if(!empty($sasaran)){
                  $empty_sasaran = false;break;
                }
              }
              if(!$empty_sasaran){
                ?>
                <tr class="success">
                  <td style="min-width:50px" colspan="19">MISI <?=$n?> : <?=$m->misi?> </td>
                </tr>
                <?php
              } 
              foreach($tujuan as $nt=> $t){
                $nt=$nt+1;
                $sasaran = $this->laporan_sakip_model->get_sasaran_strategis_renstra_by_tujuan($t->id_tujuan,$id_skpd);
                if(!empty($sasaran)){
                  ?>
                  <tr class="warning">
                    <td style="min-width:50px" colspan="19">TUJUAN <?=$nt?> : <?=$t->tujuan?> </td>
                  </tr>
                  <?php
                  foreach($sasaran as $ns => $s){
                    $ns=$ns+1;
                    $list_iku = array();
                    $iku_sasaran = $this->laporan_sakip_model->get_iku_sasaran_strategis_renstra($s->id_sasaran_strategis_renstra);
                    ?>
                    <tr>
                      <td style="min-width:50px" rowspan="<?=count($iku_sasaran) == 0 ? 1 : count($iku_sasaran)?>">SASARAN <?=$ns?> : <?=$s->sasaran_strategis_renstra?> </td>
                      <td style="min-width:50px"><?=isset($iku_sasaran[0]) ? $iku_sasaran[0]->iku_ss_renstra : '-'?></td>
                      <td style="min-width:50px"><?=empty($iku_sasaran[0]->kondisi_awal) ? '-' : $iku_sasaran[0]->kondisi_awal.' '.$iku_sasaran[0]->satuan?></td>
                      <?php 
                      for($tahun=2019;$tahun<=2023;$tahun++){
                        $target = 'target_'.$tahun;
                        $anggaran = 'anggaran_'.$tahun;
                        ?>
                        <td style="min-width:50px"><?=empty($iku_sasaran[0]->$target) ? '-' : $iku_sasaran[0]->$target.' '.$iku_sasaran[0]->satuan?></td>
                        <td style="min-width:50px"><?=empty($iku_sasaran[0]->$anggaran) ? '-' : rupiah($iku_sasaran[0]->$anggaran)?></td>
                      <?php } ?>
                      <td style="min-width:50px"><?=empty($iku_sasaran[0]->kondisi_akhir_target) ? '-' : $iku_sasaran[0]->kondisi_akhir_target.' '.$iku_sasaran[0]->satuan?></td>
                      <td style="min-width:50px"><?=empty($iku_sasaran[0]->kondisi_akhir_anggaran) ? '-' : rupiah($iku_sasaran[0]->kondisi_akhir_anggaran)?></td>
                      <td style="min-width:50px" rowspan="<?=count($iku_sasaran) == 0 ? 1 : count($iku_sasaran)?>"> <?=$s->nama_skpd?> </td>
                      <td style="min-width:50px">
                        <?php 

                          if(!empty($iku_sasaran[0]->unit_kerja)){
                            $list_unit_kerja = array();
                            foreach($iku_sasaran[0]->unit_kerja as $u){
                              $list_unit_kerja[] = $u->nama_unit_kerja;
                            }
                            echo implode('; ', $list_unit_kerja);
                          }else{
                            echo "-";
                          }
                        ?>

                      </td>
                    </tr>
                    <?php
                    foreach($iku_sasaran as $nis => $is){
                      $list_iku[] = $is->id_iku_ss_renstra;
                      if($nis!==0){
                        ?>
                        <tr>
                          <td style="min-width:50px"><?=$is->iku_ss_renstra?></td>
                          <td style="min-width:50px"><?=empty($is->kondisi_awal) ? '-' : $is->kondisi_awal.' '.$is->satuan?></td>
                          <?php 
                          for($tahun=2019;$tahun<=2023;$tahun++){
                            $target = 'target_'.$tahun;
                            $anggaran = 'anggaran_'.$tahun;
                            ?>
                            <td style="min-width:50px"><?=empty($is->$target) ? '-' : $is->$target.' '.$is->satuan?></td>
                            <td style="min-width:50px"><?=empty($is->$anggaran) ? '-' : rupiah($is->$anggaran)?></td>
                          <?php } ?>
	                      <td style="min-width:50px"><?=empty($is->kondisi_akhir_target) ? '-' : $is->kondisi_akhir_target.' '.$is->satuan?></td>
	                      <td style="min-width:50px"><?=empty($is->kondisi_akhir_anggaran) ? '-' : rupiah($is->kondisi_akhir_anggaran)?></td>
                          <td style="min-width:50px">

                            <?php 

                              if(!empty($is->unit_kerja)){
                                $list_unit_kerja = array();
                                foreach($is->unit_kerja as $u){
                                  $list_unit_kerja[] = $u->nama_unit_kerja;
                                }
                                echo implode('; ', $list_unit_kerja);
                              }else{
                                echo "-";
                              }
                            ?>
                          </td>
                        </tr>
                        <?php
                      }
                    }?>

                    <?php 
                    $program = $this->laporan_sakip_model->get_sasaran_program_renstra_by_strategis($list_iku);

                    foreach ($program as $np => $p) {
                    	$np=$np+1;
                    	$list_iku = array();
                    	$iku_program = $this->laporan_sakip_model->get_iku_sasaran_program_renstra($p->id_sasaran_program_renstra);
                    ?>

	                    <tr>
	                      <td style="min-width:50px" rowspan="<?=count($iku_program) == 0 ? 1 : count($iku_program)?>">PROGRAM <?=$ns?>.<?=$np?> : <?=$p->sasaran_program_renstra?> </td>
	                      <td style="min-width:50px"><?=isset($iku_program[0]) ? $iku_program[0]->iku_sp_renstra : '-'?></td>
	                      <td style="min-width:50px"><?=empty($iku_program[0]->kondisi_awal) ? '-' : $iku_program[0]->kondisi_awal.' '.$iku_program[0]->satuan?></td>
	                      <?php 
	                      for($tahun=2019;$tahun<=2023;$tahun++){
	                        $target = 'target_'.$tahun;
	                        $anggaran = 'anggaran_'.$tahun;
	                        ?>
	                        <td style="min-width:50px"><?=empty($iku_program[0]->$target) ? '-' : $iku_program[0]->$target.' '.$iku_program[0]->satuan?></td>
	                        <td style="min-width:50px"><?=empty($iku_program[0]->$anggaran) ? '-' : rupiah($iku_program[0]->$anggaran)?></td>
	                      <?php } ?>
	                      <td style="min-width:50px"><?=empty($iku_program[0]->kondisi_akhir_target) ? '-' : $iku_program[0]->kondisi_akhir_target.' '.$iku_program[0]->satuan?></td>
	                      <td style="min-width:50px"><?=empty($iku_program[0]->kondisi_akhir_anggaran) ? '-' : rupiah($iku_program[0]->kondisi_akhir_anggaran)?></td>
	                      <td style="min-width:50px" rowspan="<?=count($iku_program) == 0 ? 1 : count($iku_program)?>"> <?=$p->nama_unit_kerja?> </td>
	                      <td style="min-width:50px">
	                        <?php 

	                          if(!empty($iku_program[0]->unit_kerja)){
	                            $list_unit_kerja = array();
	                            foreach($iku_program[0]->unit_kerja as $u){
	                              $list_unit_kerja[] = $u->nama_unit_kerja;
	                            }
	                            echo implode('; ', $list_unit_kerja);
	                          }else{
	                            echo "-";
	                          }
	                        ?>

	                      </td>
	                    </tr>
	                    <?php
	                    foreach($iku_program as $nip => $ip){
	                      $list_iku[] = $ip->id_iku_sp_renstra;
	                      if($nip!==0){
	                        ?>
	                        <tr>
	                          <td style="min-width:50px"><?=$ip->iku_sp_renstra?></td>
	                          <td style="min-width:50px"><?=empty($ip->kondisi_awal) ? '-' : $ip->kondisi_awal.' '.$ip->satuan?></td>
	                          <?php 
	                          for($tahun=2019;$tahun<=2023;$tahun++){
	                            $target = 'target_'.$tahun;
	                            $anggaran = 'anggaran_'.$tahun;
	                            ?>
	                            <td style="min-width:50px"><?=empty($ip->$target) ? '-' : $ip->$target.' '.$ip->satuan?></td>
	                            <td style="min-width:50px"><?=empty($ip->$anggaran) ? '-' : rupiah($ip->$anggaran)?></td>
	                          <?php } ?>
		                      <td style="min-width:50px"><?=empty($ip->kondisi_akhir_target) ? '-' : $ip->kondisi_akhir_target.' '.$ip->satuan?></td>
		                      <td style="min-width:50px"><?=empty($ip->kondisi_akhir_anggaran) ? '-' : rupiah($ip->kondisi_akhir_anggaran)?></td>
	                          <td style="min-width:50px">

	                            <?php 

	                              if(!empty($ip->unit_kerja)){
	                                $list_unit_kerja = array();
	                                foreach($ip->unit_kerja as $u){
	                                  $list_unit_kerja[] = $u->nama_unit_kerja;
	                                }
	                                echo implode('; ', $list_unit_kerja);
	                              }else{
	                                echo "-";
	                              }
	                            ?>
	                          </td>
	                        </tr>
	                        <?php
	                      }
	                    }?>

	                    <?php 
	                    $kegiatan = $this->laporan_sakip_model->get_sasaran_kegiatan_renstra_by_program($list_iku);

	                    foreach ($kegiatan as $nk => $k) {
	                    	$nk=$nk+1;
	                    	$list_iku = array();
	                    	$iku_kegiatan = $this->laporan_sakip_model->get_iku_sasaran_kegiatan_renstra($k->id_sasaran_kegiatan_renstra);
	                    ?>

		                    <tr>
		                      <td style="min-width:50px" rowspan="<?=count($iku_kegiatan) == 0 ? 1 : count($iku_kegiatan)?>">KEGIATAN <?=$ns?>.<?=$np?>.<?=$nk?> : <?=$k->sasaran_kegiatan_renstra?> </td>
		                      <td style="min-width:50px"><?=isset($iku_kegiatan[0]) ? $iku_kegiatan[0]->iku_sk_renstra : '-'?></td>
		                      <td style="min-width:50px"><?=empty($iku_kegiatan[0]->kondisi_awal) ? '-' : $iku_kegiatan[0]->kondisi_awal.' '.$iku_kegiatan[0]->satuan?></td>
		                      <?php 
		                      for($tahun=2019;$tahun<=2023;$tahun++){
		                        $target = 'target_'.$tahun;
		                        $anggaran = 'anggaran_'.$tahun;
		                        ?>
		                        <td style="min-width:50px"><?=empty($iku_kegiatan[0]->$target) ? '-' : $iku_kegiatan[0]->$target.' '.$iku_kegiatan[0]->satuan?></td>
		                        <td style="min-width:50px"><?=empty($iku_kegiatan[0]->$anggaran) ? '-' : rupiah($iku_kegiatan[0]->$anggaran)?></td>
		                      <?php } ?>
		                      <td style="min-width:50px"><?=empty($iku_kegiatan[0]->kondisi_akhir_target) ? '-' : $iku_kegiatan[0]->kondisi_akhir_target.' '.$iku_kegiatan[0]->satuan?></td>
		                      <td style="min-width:50px"><?=empty($iku_kegiatan[0]->kondisi_akhir_anggaran) ? '-' : rupiah($iku_kegiatan[0]->kondisi_akhir_anggaran)?></td>
		                      <td style="min-width:50px" rowspan="<?=count($iku_kegiatan) == 0 ? 1 : count($iku_kegiatan)?>"> <?=$k->nama_unit_kerja?> </td>
		                      <td style="min-width:50px">
		                        <?php 

		                          if(!empty($iku_kegiatan[0]->unit_kerja)){
		                            $list_unit_kerja = array();
		                            foreach($iku_kegiatan[0]->unit_kerja as $u){
		                              $list_unit_kerja[] = $u->nama_unit_kerja;
		                            }
		                            echo implode('; ', $list_unit_kerja);
		                          }else{
		                            echo "-";
		                          }
		                        ?>

		                      </td>
		                    </tr>
		                    <?php
		                    foreach($iku_kegiatan as $nik => $ik){
		                      $list_iku[] = $ik->id_iku_sk_renstra;
		                      if($nik!==0){
		                        ?>
		                        <tr>
		                          <td style="min-width:50px"><?=$ik->iku_sk_renstra?></td>
		                          <td style="min-width:50px"><?=empty($ik->kondisi_awal) ? '-' : $ik->kondisi_awal.' '.$ik->satuan?></td>
		                          <?php 
		                          for($tahun=2019;$tahun<=2023;$tahun++){
		                            $target = 'target_'.$tahun;
		                            $anggaran = 'anggaran_'.$tahun;
		                            ?>
		                            <td style="min-width:50px"><?=empty($ik->$target) ? '-' : $ik->$target.' '.$ik->satuan?></td>
		                            <td style="min-width:50px"><?=empty($ik->$anggaran) ? '-' : rupiah($ik->$anggaran)?></td>
		                          <?php } ?>
			                      <td style="min-width:50px"><?=empty($ik->kondisi_akhir_target) ? '-' : $ik->kondisi_akhir_target.' '.$ik->satuan?></td>
			                      <td style="min-width:50px"><?=empty($ik->kondisi_akhir_anggaran) ? '-' : rupiah($ik->kondisi_akhir_anggaran)?></td>
		                          <td style="min-width:50px">

		                            <?php 

		                              if(!empty($ik->unit_kerja)){
		                                $list_unit_kerja = array();
		                                foreach($ik->unit_kerja as $u){
		                                  $list_unit_kerja[] = $u->nama_unit_kerja;
		                                }
		                                echo implode('; ', $list_unit_kerja);
		                              }else{
		                                echo "-";
		                              }
		                            ?>
		                          </td>
		                        </tr>
		                        <?php
		                      }
		                    }?>

	                    <?php
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
