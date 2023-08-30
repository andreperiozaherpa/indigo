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
 					<form method="POST">
            <div class="col-md-3">
             <div class="form-group">
              <label for="exampleInputEmail1">Tahun</label>
              <select name="tahun_rkt" class="form-control">
                <?php 
                foreach($tahun as $r){
                  echo'<option value="'.$r->tahun_rkt.'">'.$r->tahun_rkt.'</option>';
                }
                ?>
              </select>				
            </div>
          </div>
          <?php if($user_level=='Administrator'){ ?>
          <div class="col-md-6">
           <div class="form-group">
            <label for="exampleInputEmail1">Unit kerja</label>
            <select name="id_unit_kerja" class="form-control">
             <option value="">Semua Unit Kerja</option>
             <?php 
             foreach($unit_kerja as $r){
              echo'<option value="'.$r->id_unit_kerja.'">'.$r->nama_unit_kerja.'</option>';
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
        <a href="<?=base_url('laporan/cetak_pencapaian')?>" class="btn btn-danger m-t-5 pull-right"><i class="fa fa-print"></i> Cetak Laporan </a>
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
    <div class="white-box">

     <table class="table color-table dark-table table-hover">

      <thead>
       <tr>
        <th>#</th>
        <th>Kode</th>
        <th>Sasaran</th>
        <th>Bobot</th>
        <th>#</th>
        <th>Kode</th>
        <th>IKU</th>
        <th>Bobot</th>
        <th>Target</th>
        <th>Satuan</th>
        <th>Polarisasi</th>
        <th>Realisasi</th>
        <th>Capaian</th>
        <th>Unit Kerja</th>
      </tr>
    </thead>
    <tbody>
      <?php 
      $no=1;
      foreach($item as $i){
        if($i->jenis=='SS'){
          $n = 'sasaran_strategis';
          $iku = $this->sasaran_strategis_model->get_iku($i->id_sasaran_strategis);
        }elseif($i->jenis=='SP'){
          $n = 'sasaran_program';
          $iku = $this->sasaran_program_model->get_iku($i->id_sasaran_program);
        }elseif($i->jenis=='SK'){
          $n = 'sasaran_kegiatan';
          $iku = $this->sasaran_kegiatan_model->get_iku($i->id_sasaran_kegiatan);
        }
        $nama_unit_kerja = $this->ref_unit_kerja_model->get_by_id($i->id_unit)->nama_unit_kerja;
        $kode = 'kode_'.$n;
        ?>
        <tr>
          <th rowspan="<?=count($iku)==0 ? 1 : count($iku)?>"><?=$no?></th>
          <td rowspan="<?=count($iku)==0 ? 1 : count($iku)?>"><?=$i->$kode?></td>
          <td rowspan="<?=count($iku)==0 ? 1 : count($iku)?>" class="text-primary"><?=$i->$n?></td>
          <td rowspan="<?=count($iku)==0 ? 1 : count($iku)?>"><?=$i->bobot?>%</td>
          <?php 
          if(count($iku)>0){

            $capaian = round($iku[0]->capaian,2);

            if($capaian>85&&$capaian<=100){
              $warna = 'success';
            }elseif($capaian>65&&$capaian<=85){
              $warna = 'info';
            }elseif ($capaian>40&&$capaian<=65) {
              $warna = 'warning';
            }else{
              $warna = 'danger';
            }
            ?>
            <th>1</th>
            <td><?=$iku[0]->kode_indikator?></td>
            <td class="text-primary"><?=$iku[0]->nama_indikator?></td>
            <td><?=$iku[0]->bobot?>%</td>
            <td><?=$iku[0]->target?></td>
            <td><?=$iku[0]->satuan?></td>
            <td><?=($iku[0]->polaritas=='MAX') ? 'Maximize' : (($iku[0]->polaritas=='MIN') ? 'Minimize' : '-') ?></td>
            <td><?=$iku[0]->realisasi?></td>
            <td><span class="label label-<?=$warna?>"><?=$capaian?>%</span></td>

          <?php }else{
            ?>
                  <th colspan="9"><center>Belum Ada IKU</center></th>
            <?php
          } ?>
          <td><?=$nama_unit_kerja?></td>
        </tr>
        <?php $no++; 

        if(count($iku)>1){
          $noo=1;
          foreach($iku as $ii){
            if($noo!==1){
              $capaian = round($ii->capaian,2);

              if($capaian>85&&$capaian<=100){
                $warna = 'success';
              }elseif($capaian>65&&$capaian<=85){
                $warna = 'info';
              }elseif ($capaian>40&&$capaian<=65) {
                $warna = 'warning';
              }else{
                $warna = 'danger';
              }

              ?>
              <tr>
                <th><?=$noo?></th>
                <td><?=$ii->kode_indikator?></td>
                <td class="text-primary"><?=$ii->nama_indikator?></td>
                <td><?=$ii->bobot?>%</td>
                <td><?=$ii->target?></td>
                <td><?=$ii->satuan?></td>
                <td><?=($ii->polaritas=='MAX') ? 'Maximize' : (($ii->polaritas=='MIN') ? 'Minimize' : '-') ?></td>
                <td><?=$ii->realisasi?></td>
                <td><span class="label label-<?=$warna?>"><?=$capaian?>%</span></td>

                <td><?=$nama_unit_kerja?></td>
              </tr>
              <?php
            } $noo++; 
          }
        }
      } ?>
    </tbody>
  </table>



</div>
</div>

</div>    


</div>
<!-- .row -->

</div>
