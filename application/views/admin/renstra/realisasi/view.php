<style type="text/css">
  .alert-default{
    border: solid 1px #6003c8;
    color: #6003c8;
    font-weight: 400;
  }
</style>
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

    <div class="col-md-12">

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
                <?php
                if(!empty($$value)){
                $no=1;
                foreach($$value as $ss){
                  $id_sasaran = $name['cSasaran'];
                  $nama_sasaran = $name['tSasaran'];
                  $iku = $this->renstra_realisasi_model->get_iku($key,$ss->$id_sasaran);
                  ?>
                <div class="row">
                   <p><strong>Sasaran <?=$no?>.</strong> <?=$ss->$nama_sasaran?> </p>
                  <div class="table-responsive">
                      <table class="table color-table muted-table table-bordered">
                          <thead>
                             <tr>
                              <th rowspan="2" class="text-center" style="vertical-align: middle;"> No </th><th rowspan="2" style="vertical-align: middle;"> Indikator </th><th rowspan="2" style="vertical-align: middle;"> Satuan </th><th colspan="3" style="text-align: center;"> 2019 </th><th colspan="3" style="text-align: center;"> 2020 </th> <th colspan="3" style="text-align: center;"> 2021 </th> <th colspan="3" style="text-align: center;"> 2022 </th> <th colspan="3" style="text-align: center;"> 2023 </th> <th rowspan="2" style="vertical-align: middle;"> Penanggung Jawab </th><th rowspan="2" style="vertical-align: middle;"> Opsi </th></tr>

                              <tr>
                                <th>Target</th><th>Realisasi</th><th>Capaian</th><th>Target</th><th>Realisasi</th><th>Capaian</th><th>Target</th><th>Realisasi</th><th>Capaian</th><th>Target</th><th>Realisasi</th><th>Capaian</th><th>Target</th><th>Realisasi</th><th>Capaian</th>
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
                                    $s_realisasi = 'realisasi_'.$ii;
                                    $target = $i->$s_target;
                                    $realisasi = $i->$s_realisasi;
                                    $capaian = ($realisasi>0 AND $target>0) ? ($realisasi/$target)*100 : 0;
                                 ?>
                                <td><?=$target?></td>
                                <td><?=$realisasi?></td>
                                <td><?=$capaian?>%</td>
                                 <?php
                                  }
                                ?>
                                <td><?=$unit_kerja?></td>
                                <td>  <a href="<?php echo base_url('renstra_realisasi/detail/'.$key.'/'.$i->$id_iku.'/'.$detail->id_skpd);?>" class="btn btn-primary" style="color:white;"> Detail</a>
                                  </td>
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
              <?php $no++; }
              }else{
                ?>
                <div class="alert alert-default"><i class="ti-alert"></i> Belum ada <?=normal_string($value)?></div>
                <?php
              } ?>
              </div>
          </div>
      </div>
<?php
  }
  ?>





    </div>
    </div>
</div>
