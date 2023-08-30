 <div class="container-fluid">

 	<div class="row bg-title">
 		<!-- .page title -->
 		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
 			<h4 class="page-title">Laporan Pencapaian</h4>
 		</div>
 		<!-- /.page title -->
 		<!-- .breadcrumb -->
 		<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

 			<ol class="breadcrumb">
 				<li><a href="<?= base_url();?>/admin">Dashboard</a></li>
 				<li class="active">Laporan Pencapaian</li>
 			</ol>
 		</div>
 		<!-- /.breadcrumb -->
 	</div>

 	<div class="row">
 		<div class="col-md-12">
 			<div class="white-box">
 				<div class="row">
 					<form method="GET">
         <?php if($user_level=='Administrator'){ ?>
            <div class="col-md-6">
             <div class="form-group">
              <label for="exampleInputEmail1">SKPD</label>
              <select name="id_skpd" class="form-control select2">
               <option value="">Semua SKPD</option>
               <?php 
               foreach($skpd as $s){
                $selected = (@$_GET['id_skpd'] == $s->id_skpd) ? "selected" : "" ;
                echo'<option value="'.$s->id_skpd.'" '.$selected.'>'.$s->nama_skpd.'</option>';
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
        <a href="javascript:void(0)" onclick="downloadExcel('renstra_pencapaian','Laporan Pencapaian Renstra')" class="btn btn-danger m-t-5 pull-right"><i class="fa fa-print"></i> Cetak Laporan </a>
      </div>
    </div>

  </form>
</div>

</div>
</div>

</div>
<!-- .row -->
<div class="row">	
 <div class="col-md-12">
  <div class="row">
   <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="white-box table-responsive dragscroll">

     <table id="renstra_pencapaian" class="table  table-bordered color-table dark-table table-hover">

      <thead>
       <tr class="text-center">
        <th rowspan="2"  style="text-align: center;vertical-align: middle" >#</th>
        <th rowspan="2" style="text-align: center;vertical-align: middle;" width="200px">Sasaran</th>
        <th rowspan="2" style="text-align: center;vertical-align: middle;">Indikator</th>
        <th rowspan="2" style="text-align: center;vertical-align: middle;" >Polarisasi</th>
        <th rowspan="2" style="text-align: center;vertical-align: middle;" >Data capaian pada awal tahun perencanaan (2018)</th>
        <th colspan="3" style="text-align: center;vertical-align: middle;">2019</th>
        <th colspan="3" style="text-align: center;vertical-align: middle;">2020</th>
        <th colspan="3" style="text-align: center;vertical-align: middle;">2021</th>
        <th colspan="3" style="text-align: center;vertical-align: middle;">2022</th>
        <th colspan="3" style="text-align: center;vertical-align: middle;">2023</th>
        <th colspan="3" style="text-align: center;vertical-align: middle;">Kondisi Akhir Periode</th>
        <th rowspan="2" style="text-align: center;vertical-align: middle;" >Satuan</th>
        <th rowspan="2" style="text-align: center;vertical-align: middle;" >SKPD Penanggung Jawab</th>
      </tr>
      <tr>
        <th>Target</th>
        <th>Realilisasi</th>
        <th>Capaian</th>
        <th>Target</th>
        <th>Realilisasi</th>
        <th>Capaian</th>
        <th>Target</th>
        <th>Realilisasi</th>
        <th>Capaian</th>
        <th>Target</th>
        <th>Realilisasi</th>
        <th>Capaian</th>
        <th>Target</th>
        <th>Realilisasi</th>
        <th>Capaian</th>
        <th>Target</th>
        <th>Realilisasi</th>
        <th>Capaian</th>
      </tr>
    </thead>
    <tbody>
      <?php 

      $no=1;
      foreach($jenis as $j){
        $name = $this->laporan_sakip_model->name($j);
        $sasaran = $this->laporan_sakip_model->get_sasaran_renstra($j,$id_skpd);
        foreach($name as $v => $n){
          $$v = $n;
        }
        foreach($sasaran as $s){
          if(isset($_GET['id_skpd'])){
            $id_skpd = $_GET['id_skpd'];
          }else{
            $id_skpd = null;
          }
          $iku = $this->laporan_sakip_model->get_iku_sasaran_renstra($j,$s->$cSasaran,$id_skpd);
          if (!empty($iku)) {
          ?>
          <tr>
            <th rowspan="<?=count($iku)==0 ? 1 : count($iku)?>"><?=$no?></th>
            <td rowspan="<?=count($iku)==0 ? 1 : count($iku)?>"><?=$s->$tSasaran?></td>
            <td><?=empty($iku[0]) ? '-' : $iku[0]->$tIku?></td>
            <td><?=empty($iku[0]) ? '-' : $iku[0]->polorarisasi?></td>
            <td><?=empty($iku[0]) ? '-' : $iku[0]->kondisi_awal?></td>
            <?php 
            $target_akhir = 0;
            $realisasi_akhir = 0;
            for($tahun=2019;$tahun<=2023;$tahun++){
              $target = 'target_'.$tahun;
              $realisasi = 'realisasi_'.$tahun;
              $target_akhir += $iku[0]->$target;
              $realisasi_akhir += $iku[0]->$realisasi;
              ?>
              <td><?=empty($iku[0]) ? '-' : $iku[0]->$target?></td>
              <td><?=empty($iku[0]) ? '-' : $iku[0]->$realisasi?></td>
              <td>-</td>
            <?php } ?>
            <td><?=$target_akhir/5?></td>
            <td><?=$realisasi_akhir/5?></td>
            <td>-</td>
            <td><?=empty($iku[0]) ? '-' : $iku[0]->satuan?></td>
            <td><?=empty($iku[0]) ? '-' : $iku[0]->nama_skpd?></td>
          </tr>
          <?php
          } 
            foreach($iku as $n => $i){
              if($n!==0){
              ?>
          <tr>
            <td><?=empty($i) ? '-' : $i->$tIku?></td>
            <td><?=empty($i) ? '-' : $i->polorarisasi?></td>
            <td><?=empty($i) ? '-' : $i->kondisi_awal?></td>
            <?php 
            $target_akhir = 0;
            $realisasi_akhir = 0;
            for($tahun=2019;$tahun<=2023;$tahun++){
              $target = 'target_'.$tahun;
              $realisasi = 'realisasi_'.$tahun;
              $target_akhir += $i->$target;
              $realisasi_akhir += $i->$realisasi;
              ?>
              <td><?=empty($i) ? '-' : $i->$target?></td>
              <td><?=empty($i) ? '-' : $i->$realisasi?></td>
              <td>-</td>
            <?php } ?>
            <td><?=$target_akhir/5?></td>
            <td><?=$realisasi_akhir/5?></td>
            <td>-</td>
            <td><?=empty($i) ? '-' : $i->satuan?></td>
            <td><?=empty($i) ? '-' : $i->nama_skpd?></td>
          </tr>
              <?php
            }
            }
          ?>
          <?php $no++; } } ?>


        </tbody>
      </table>



    </div>
  </div>

</div>    


</div>
<!-- .row -->

</div>
