 <style type="text/css">
   table.table thead tr th{
    background-color: #6003c8;
   }
 </style>
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
        <?php echo breadcrumb($this->uri->segment_array()) ?>
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
                <option value="">Semua Tahun</option>
                <?php for ($i=2018; $i <=2022 ; $i++) {
                  if ($tahun == $i) {
                    $selected = "selected";
                  }else{
                    $selected = "";
                  }
                  echo '<option value="'.$i.'"'.$selected.'>'.$i.'</option>';
                } ?>
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
               if ($id_skpd == $r->id_skpd ) {
                 $selected = "selected";
               }else{
                 $selected = "";
               }
              echo'<option value="'.$r->id_skpd.'"'.$selected.'>'.$r->nama_skpd.'</option>';
            }
            ?>
          </select>
        </div>
      </div>
    <?php } ?>
      <div class="col-md-3">
       <div class="form-group">
        <br>
        <button type="submit" class="btn btn-primary m-t-5"><i class="ti-filter"></i> Filter</button>
        <a href="javascript:void(0)" onclick="downloadExcelMulti('table','Laporan Renaksi')" class="btn btn-danger m-t-5 pull-right"><i class="fa fa-print"></i> Cetak Laporan </a>
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
      <h3 class="box-title">Sasaran Strategis</h3>
      <?php if ($list != true): ?>
        <div class="alert alert-danger">
          Belum ada Rencana Aksi Untuk Sasaran Strategis
        </div>
        <?php else: ?>
          <table id="table1" class="table table-bordered color-table table-hover">
            <thead style="background-color: #6003c8;">
              <tr >
                <th rowspan="2" style="color: #fff" >Rencana Aksi</th>
                <th rowspan="2" style="color: #fff" >Unit Kerja </th>
                <th rowspan="2" style="color: #fff" >Target</th>
                <th rowspan="2" style="color: #fff;text-align: center;vertical-align: middle;" > Polarisasi</th>
                <th rowspan="2" style="color: #fff;text-align: center;vertical-align: middle;" > Satuan</th>
                <th colspan="3" style="color: #fff;text-align: center;vertical-align: middle;" >Januari</th>
                <th colspan="3" style="color: #fff;text-align: center;vertical-align: middle;" >Februari</th>
                <th colspan="3" style="color: #fff;text-align: center;vertical-align: middle;" >Maret</th>
                <th colspan="3" style="color: #fff;text-align: center;vertical-align: middle;" >April</th>
                <th colspan="3" style="color: #fff;text-align: center;vertical-align: middle;" >Mei</th>
                <th colspan="3" style="color: #fff;text-align: center;vertical-align: middle;" >Juni</th>
                <th colspan="3" style="color: #fff;text-align: center;vertical-align: middle;" >Juli</th>
                <th colspan="3" style="color: #fff;text-align: center;vertical-align: middle;" >Agustus</th>
                <th colspan="3" style="color: #fff;text-align: center;vertical-align: middle;" >September</th>
                <th colspan="3" style="color: #fff;text-align: center;vertical-align: middle;" >Oktober</th>
                <th colspan="3" style="color: #fff;text-align: center;vertical-align: middle;" >November</th>
                <th colspan="3" style="color: #fff;text-align: center;vertical-align: middle;" >Desember</th>
              </tr>
              <tr>
                <?php for ($i=0; $i < 12 ; $i++) { ?>
                  <th style="color: #fff;text-align: center;vertical-align: middle;" >Target</th>
                  <th style="color: #fff;text-align: center;vertical-align: middle;" >Realisasi</th>
                  <th style="color: #fff;text-align: center;vertical-align: middle;" >Capaian</th>
                <?php } ?>


            </thead>
            <tbody>
              <tr class="info">
              <td colspan="41"><strong>Sasaran:</strong> Nama Sasaran - <strong>Indikator :</strong> Nama Indikator Kinerja</td>
              </tr>
                <?php foreach ($list as $l): ?>
                  <tr class="warning">
                    <td style="text-align: center;vertical-align: middle;"><?=$l['renaksi_iku_ss_renja']?></td>
                    <td style="text-align: center;vertical-align: middle;"><?=$l['nama_unit_kerja']?></td>
                    <td style="text-align: center;vertical-align: middle;"><?=$l['target_ss_renja']?></td>
                    <td style="text-align: center;vertical-align: middle;"><?=$l['polorarisasi']?></td>
                    <td style="text-align: center;vertical-align: middle;"><?=$l['satuan']?></td>

                    <?php for ($a=0; $a < count($bulan) ; $a++) { ?>
                        <?php if ($bulan[$a]['id_renaksi_iku_ss_renja'] == $l['id_renaksi_iku_ss_renja']): ?>
                          <?php if ($bulan[$a]['status_jadwal'] == "dijadwalkan"): ?>
                          <td style="text-align: center;vertical-align: middle;"><?=$bulan[$a]['target']?></td>
                          <td style="text-align: center;vertical-align: middle;"><?=$bulan[$a]['realisasi']?></td>
                          <?php if ($bulan[$a]['target'] != 0 || $bulan[$a]['realisasi'] != 0):
                            $capaian = $bulan[$a]['realisasi']/$bulan[$a]['target']*100;
                          else:
                            $capaian = 0;
                           endif; ?>
                          <td style="text-align: center;vertical-align: middle;"><?=$capaian?>%</td>
                        <?php else: ?>
                        <td colspan="3" style="text-align: center;vertical-align: middle;" >Tidak Dijadwalkan</th>
                      <?php endif; ?>
                      <?php endif; ?>
                    <?php } ?>

                  </tr>
                <?php endforeach; ?>
            </tbody>
          </table>
      <?php endif; ?>

    </div>
    <div class="white-box table-responsive dragscroll">
      <h3 class="box-title">Sasaran Program</h3>
      <?php if ($list_sp != true): ?>
        <div class="alert alert-danger">
          Belum ada Rencana Aksi Untuk Sasaran Program
        </div>
        <?php else: ?>
          <table id="table1" class="table table-bordered color-table table-hover">
            <thead style="background: #6003c8;">
              <tr >
                <th rowspan="2" style="color: #fff" >Rencana Aksi</th>
                <th rowspan="2" style="color: #fff" >Unit Kerja </th>
                <th rowspan="2" style="color: #fff" >Target</th>
                <th rowspan="2" style="color: #fff;text-align: center;vertical-align: middle;" > Polarisasi</th>
                <th rowspan="2" style="color: #fff;text-align: center;vertical-align: middle;" > Satuan</th>
                <th colspan="3" style="color: #fff;text-align: center;vertical-align: middle;" >Januari</th>
                <th colspan="3" style="color: #fff;text-align: center;vertical-align: middle;" >Februari</th>
                <th colspan="3" style="color: #fff;text-align: center;vertical-align: middle;" >Maret</th>
                <th colspan="3" style="color: #fff;text-align: center;vertical-align: middle;" >April</th>
                <th colspan="3" style="color: #fff;text-align: center;vertical-align: middle;" >Mei</th>
                <th colspan="3" style="color: #fff;text-align: center;vertical-align: middle;" >Juni</th>
                <th colspan="3" style="color: #fff;text-align: center;vertical-align: middle;" >Juli</th>
                <th colspan="3" style="color: #fff;text-align: center;vertical-align: middle;" >Agustus</th>
                <th colspan="3" style="color: #fff;text-align: center;vertical-align: middle;" >September</th>
                <th colspan="3" style="color: #fff;text-align: center;vertical-align: middle;" >Oktober</th>
                <th colspan="3" style="color: #fff;text-align: center;vertical-align: middle;" >November</th>
                <th colspan="3" style="color: #fff;text-align: center;vertical-align: middle;" >Desember</th>
              </tr>
              <tr>
                <?php for ($i=0; $i < 12 ; $i++) { ?>
                  <th style="color: #fff;text-align: center;vertical-align: middle;" >Target</th>
                  <th style="color: #fff;text-align: center;vertical-align: middle;" >Realisasi</th>
                  <th style="color: #fff;text-align: center;vertical-align: middle;" >Capaian</th>
                <?php } ?>
            </thead>
            <tbody>
               <tr class="info">
               <td colspan="41"><strong>Sasaran:</strong> Nama Sasaran - <strong>Indikator :</strong> Nama Indikator Kinerja</td>
              </tr>
                <?php foreach ($list_sp as $l_sp): ?>
                  <tr class="warning">
                    <td style="text-align: center;vertical-align: middle;"><?=$l_sp['renaksi_iku_sp_renja']?></td>
                    <td style="text-align: center;vertical-align: middle;"><?=$l_sp['nama_unit_kerja']?></td>
                    <td style="text-align: center;vertical-align: middle;"><?=$l_sp['target_sp_renja']?></td>
                    <td style="text-align: center;vertical-align: middle;"><?=$l_sp['polorarisasi']?></td>
                    <td style="text-align: center;vertical-align: middle;"><?=$l_sp['satuan']?></td>

                    <?php for ($a_sp=0; $a_sp < count($bulan_sp) ; $a_sp++) {?>
                        <?php if ($bulan_sp[$a_sp]['id_renaksi_iku_sp_renja'] == $l_sp['id_renaksi_iku_sp_renja']): ?>
                          <?php if ($bulan_sp[$a_sp]['status_jadwal'] == "dijadwalkan"): ?>
                          <td style="text-align: center;vertical-align: middle;"><?=$bulan_sp[$a_sp]['target']?></td>
                          <td style="text-align: center;vertical-align: middle;"><?=$bulan_sp[$a_sp]['realisasi']?></td>
                          <?php if ($bulan_sp[$a_sp]['target'] != 0 || $bulan_sp[$a_sp]['realisasi'] != 0):
                            $capaian_sp = $bulan_sp[$a_sp]['realisasi']/$bulan_sp[$a_sp]['target']*100;
                          else:
                            $capaian_sp = 0;
                           endif; ?>
                          <td style="text-align: center;vertical-align: middle;"><?=$capaian_sp?>%</td>
                        <?php else: ?>
                        <td colspan="3" style="text-align: center;vertical-align: middle;" >Tidak Dijadwalkan</th>
                      <?php endif; ?>
                      <?php endif; ?>
                    <?php } ?>

                  </tr>
                <?php endforeach; ?>
            </tbody>
          </table>
      <?php endif; ?>

    </div>
    <div class="white-box table-responsive dragscroll">
      <h3 class="box-title">Sasaran Kegiatan</h3>
      <?php if ($list_sk != true): ?>
        <div class="alert alert-danger">
          Belum ada Rencana Aksi Untuk Sasaran Kegiatan
        </div>
        <?php else: ?>
          <table id="table1" class="table table-bordered color-table table-hover">
            <thead style="background: #6003c8;">
              <tr >
                <th rowspan="2" style="color: #fff" >Rencana Aksi</th>
                <th rowspan="2" style="color: #fff" >Unit Kerja </th>
                <th rowspan="2" style="color: #fff" >Target</th>
                <th rowspan="2" style="color: #fff;text-align: center;vertical-align: middle;" > Polarisasi</th>
                <th rowspan="2" style="color: #fff;text-align: center;vertical-align: middle;" > Satuan</th>
                <th colspan="3" style="color: #fff;text-align: center;vertical-align: middle;" >Januari</th>
                <th colspan="3" style="color: #fff;text-align: center;vertical-align: middle;" >Februari</th>
                <th colspan="3" style="color: #fff;text-align: center;vertical-align: middle;" >Maret</th>
                <th colspan="3" style="color: #fff;text-align: center;vertical-align: middle;" >April</th>
                <th colspan="3" style="color: #fff;text-align: center;vertical-align: middle;" >Mei</th>
                <th colspan="3" style="color: #fff;text-align: center;vertical-align: middle;" >Juni</th>
                <th colspan="3" style="color: #fff;text-align: center;vertical-align: middle;" >Juli</th>
                <th colspan="3" style="color: #fff;text-align: center;vertical-align: middle;" >Agustus</th>
                <th colspan="3" style="color: #fff;text-align: center;vertical-align: middle;" >September</th>
                <th colspan="3" style="color: #fff;text-align: center;vertical-align: middle;" >Oktober</th>
                <th colspan="3" style="color: #fff;text-align: center;vertical-align: middle;" >November</th>
                <th colspan="3" style="color: #fff;text-align: center;vertical-align: middle;" >Desember</th>
              </tr>
              <tr>
                <?php for ($i=0; $i < 12 ; $i++) { ?>
                  <th style="color: #fff;text-align: center;vertical-align: middle;" >Target</th>
                  <th style="color: #fff;text-align: center;vertical-align: middle;" >Realisasi</th>
                  <th style="color: #fff;text-align: center;vertical-align: middle;" >Capaian</th>
                <?php } ?>
            </thead>
            <tbody>
                <?php 
                $list_iku_renja = array();
                foreach ($list_sk as $l_sk): 
                  if(!in_array($l_sk['id_iku_sk_renja'], $list_iku_renja)){
                  ?>

               <tr class="info">
                <td colspan="41"><strong>Sasaran:</strong> <?=$l_sk['sasaran_kegiatan_renstra']?> - <strong>Indikator :</strong> <?=$l_sk['iku_sk_renstra']?></td>
              </tr>
              <?php 
            }
              $list_iku_renja[] = $l_sk['id_iku_sk_renja'];
              ?>

                  <tr class="warning">
                    <td style="text-align: center;vertical-align: middle;"><?=$l_sk['renaksi_iku_sk_renja']?></td>
                    <td style="text-align: center;vertical-align: middle;"><?=$l_sk['nama_unit_kerja']?></td>
                    <td style="text-align: center;vertical-align: middle;"><?=$l_sk['target_sk_renja']?></td>
                    <td style="text-align: center;vertical-align: middle;"><?=$l_sk['polorarisasi']?></td>
                    <td style="text-align: center;vertical-align: middle;"><?=$l_sk['satuan']?></td>

                    <?php for ($a_sk=0; $a_sk < count($bulan_sk) ; $a_sk++) { ?>
                        <?php if ($bulan_sk[$a_sk]['id_renaksi_iku_sk_renja'] == $l_sk['id_renaksi_iku_sk_renja']): ?>
                          <?php if ($bulan_sk[$a_sk]['status_jadwal'] == "dijadwalkan"): ?>
                          <td style="text-align: center;vertical-align: middle;"><?=$bulan_sk[$a_sk]['target']?></td>
                          <td style="text-align: center;vertical-align: middle;"><?=$bulan_sk[$a_sk]['realisasi']?></td>
                          <?php if ($bulan_sk[$a_sk]['target'] != 0 || $bulan_sk[$a_sk]['realisasi'] != 0):
                            $capaian_sk = $bulan_sk[$a_sk]['realisasi']/$bulan_sk[$a_sk]['target']*100;
                          else:
                            $capaian_sk = 0;
                           endif; ?>
                          <td style="text-align: center;vertical-align: middle;"><?=$capaian_sk?>%</td>
                        <?php else: ?>
                        <td colspan="3" style="text-align: center;vertical-align: middle;" >Tidak Dijadwalkan</th>
                      <?php endif; ?>
                      <?php endif; ?>
                    <?php } ?>

                  </tr>
                <?php endforeach; ?>
            </tbody>
          </table>
      <?php endif; ?>

    </div>
  </div>

</div>


</div>
<!-- .row -->

</div>
