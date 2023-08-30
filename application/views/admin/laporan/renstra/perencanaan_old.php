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
 					<form method="POST">
            <div class="col-md-3">
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
         </div>
         <?php if($user_level=='Administrator'){ ?>
          <div class="col-md-6">
           <div class="form-group">
            <label for="exampleInputEmail1">SKPD</label>
            <select name="id_skpd" class="form-control select2">
             <option value="">Semua SKPD</option>
             <?php 
             foreach($skpd as $r){
              echo'<option value="'.$r->id_skpd.'">'.$r->nama_skpd.'</option>';
            }
            ?>
          </select>				
        </div>
      </div>
    <?php } ?>
    <div class="col-md-3">
     <div class="form-group">

      <br>
      <button type="submit" class="btn btn-primary m-t-5">Filter</button>
      <a href="<?=base_url('laporan/cetak_perencanaan')?>" class="btn btn-danger m-t-5 pull-right"><i class="fa fa-print"></i> Cetak Laporan </a>
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

      <table id="table1" class="table table-bordered color-table dark-table table-hover">

        <thead>
          <tr align="center">
            <th rowspan="2"><center>#</th>
              <th rowspan="2"><center>Sasaran</center></th>
              <th rowspan="2"><center>Indikator</center></th>
              <th rowspan="2"><center>Data capaian pada awal tahun perencanaan (2018)</center></th>
              <th colspan="2"><center>2019</center></th>
              <th  colspan="2"><center>2020</center></th>
              <th  colspan="2"><center>2021</center></th>
              <th  colspan="2"><center>2022</center></th>
              <th  colspan="2"><center>2023</center></th>
              <th  colspan="2"><center>Kondisi Akhir Periode</center></th>
              <th rowspan="2" ><center>Bidang Penanggung Jawab</center></th>
              <th rowspan="2"><center>SKPD </center></th>
            </tr>
            <tr>
              <th>Target</th><th>Anggaran</th>
              <th>Target</th><th>Anggaran</th>
              <th>Target</th><th>Anggaran</th>
              <th>Target</th><th>Anggaran</th>
              <th>Target</th><th>Anggaran</th>
              <th>Target</th><th>Anggaran</th>
            </tr>
            </thead>
            <tbody>
              <?php 

              $no=1;
              foreach($jenis as $j){
                $name = $this->laporan_sakip_model->name($j);
                $sasaran = $this->laporan_sakip_model->get_sasaran_renstra($j);
                foreach($name as $v => $n){
                  $$v = $n;
                }
                foreach($sasaran as $s){
                  $iku = $this->laporan_sakip_model->get_iku_sasaran_renstra($j,$s->$cSasaran);
                  ?>
                  <tr>
                    <th rowspan="<?=count($iku)==0 ? 1 : count($iku)?>"><?=$no?></th>
                    <td rowspan="<?=count($iku)==0 ? 1 : count($iku)?>"><?=$s->$tSasaran?></td>

                    <td><?=empty($iku[0]) ? '-' : $iku[0]->$tIku?></td>
                    <td><?=empty($iku[0]) ? '-' : $iku[0]->kondisi_awal?></td>
                    <?php 
                    for($tahun=2019;$tahun<=2023;$tahun++){
                      $target = 'target_'.$tahun;
                      $anggaran = 'anggaran_'.$tahun;
                      ?>
                      <td><?=empty($iku[0]) ? '-' : $iku[0]->$target?></td>
                      <td><?=empty($iku[0]) ? '-' : rupiah($iku[0]->$anggaran)?></td>
                    <?php } ?>
                    <td>{target_akhir}</td>
                    <td>{anggaran_akhir}</td>
                    <td><?=empty($iku[0]) ? '-' : $iku[0]->satuan?></td>
                    <td><?=empty($iku[0]) ? '-' : $iku[0]->nama_skpd?></td>
                  </tr>
                  <?php 
                  foreach($iku as $n => $i){
                    if($n!==0){
                      ?>
                      <tr>
                        <td><?=$i->$tIku?></td>
                        <td><?=$i->kondisi_awal?></td>
                        <?php 
                        for($tahun=2019;$tahun<=2023;$tahun++){
                          $target = 'target_'.$tahun;
                          $anggaran = 'anggaran_'.$tahun;

                          ?>
                          <td><?=$i->$target?></td>
                          <td><?=rupiah($i->$anggaran)?></td>
                        <?php } ?>
                        <td><?=$i->satuan?></td>
                        <td><?=$i->nama_skpd?></td>
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
