 <div class="container-fluid">

 	<div class="row bg-title">
 		<!-- .page title -->
 		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
 			<h4 class="page-title">Laporan Renaksi</h4>
 		</div>
 		<!-- /.page title -->
 		<!-- .breadcrumb -->
 		<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

 			<ol class="breadcrumb">
 				<li><a href="<?= base_url();?>/admin">Dashboard</a></li>
 				<li class="active">Laporan Renaksi</li>
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
        <a href="<?=base_url('laporan/cetak_renaksi')?>" class="btn btn-danger m-t-5 pull-right"><i class="fa fa-print"></i> Cetak Laporan </a>
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
      <div class="table-responsive">
        <table id="table1" class="table table-bordered color-table dark-table">

          <thead>
            <tr>
              <th style="vertical-align: middle;" rowspan="2">#</th>
              <th style="vertical-align: middle;" rowspan="2">Kode</th>
              <th style="vertical-align: middle;" rowspan="2">IKU</th>
              <th style="vertical-align: middle;" rowspan="2">Unit Kerja</th>
              <th style="vertical-align: middle;" rowspan="2">Satuan</th>
              <th colspan="2" style="text-align: center">Januari</th>
              <th colspan="2" style="text-align: center">Februari</th>
              <th colspan="2" style="text-align: center">Maret</th>
              <th colspan="2" style="text-align: center">April</th>
              <th colspan="2" style="text-align: center">Mei</th>
              <th colspan="2" style="text-align: center">Juni</th>
              <th colspan="2" style="text-align: center">Juli</th>
              <th colspan="2" style="text-align: center">Agustus</th>
              <th colspan="2" style="text-align: center">September</th>
              <th colspan="2" style="text-align: center">Oktober</th>
              <th colspan="2" style="text-align: center">November</th>
              <th colspan="2" style="text-align: center">Desember</th>
            </tr>
            <tr>
              <th>Target</th>
              <th>Realisasi</th>
              <th>Target</th>
              <th>Realisasi</th>
              <th>Target</th>
              <th>Realisasi</th>
              <th>Target</th>
              <th>Realisasi</th>
              <th>Target</th>
              <th>Realisasi</th>
              <th>Target</th>
              <th>Realisasi</th>
              <th>Target</th>
              <th>Realisasi</th>
              <th>Target</th>
              <th>Realisasi</th>
              <th>Target</th>
              <th>Realisasi</th>
              <th>Target</th>
              <th>Realisasi</th>
              <th>Target</th>
              <th>Realisasi</th>
              <th>Target</th>
              <th>Realisasi</th>
            </tr>
          </thead>
          <tbody>
            <?php 
            $no=1;
            foreach($item as $i){
              $uid = $i->uid_iku;
              $kode = substr($uid,1,2);
              if($kode=="SS"){
                $r = $this->sasaran_strategis_model->gDataW(array('uid_iku'=>$uid))->row();
                $nama_u = $this->sasaran_strategis_model->get_data_by_id($r->id_sasaran)[0]->nama_unit_kerja;
                // print_r($id_unit);
              }elseif($kode=="SK"){
                $r = $this->sasaran_kegiatan_model->gDataW(array('uid_iku'=>$uid))->row();
                $nama_u = $this->sasaran_kegiatan_model->get_data_by_id($r->id_sasaran)[0]->nama_unit_kerja;
              }elseif ($kode=="SP") {
                $r = $this->sasaran_program_model->gDataW(array('uid_iku'=>$uid))->row();
                $nama_u = $this->sasaran_program_model->get_data_by_id($r->id_sasaran)[0]->nama_unit_kerja;
              }

              $re = $this->renaksi_model->getDetail(array('renaksi.id_renaksi'=>$i->id_renaksi));
              ?>
              <tr>
                <td><?=$no?></td>
                <td><?=$r->kode_indikator?></td>
                <td><?=$r->nama_indikator?></td>
                <td><?=$nama_u?></td>
                <td><?=$i->satuan?></td>
                <?php
                foreach($re as $rr){
                  if(empty($rr->target)){
                    $jadwal = 'N';
                  }else{
                    $jadwal = 'Y';
                  }
                  $realisasi = ($rr->realisasi==''||empty($rr->realisasi)) ? '-' : $rr->realisasi;
                  $target = ($rr->target==''||empty($rr->target)) ? '-' : $rr->target;
                  if($jadwal=="Y"){
                    echo "<td>".$target."</td>";
                    echo "<td>".$realisasi."</td>";
                  }else{
                    echo '<td class="warning" colspan="2">Tidak Dijadwalkan</td>';
                  }
                }
                ?>
              </tr>
              <?php
              $no++;
            }
            ?>
          </tbody>
        </table>
      </div>


    </div>
  </div>

</div>    


</div>
<!-- .row -->

</div>
