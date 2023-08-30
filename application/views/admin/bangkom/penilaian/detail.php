<div class="container-fluid">

	<div class="row bg-title">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<h4 class="page-title">Detail Penilaian Kompetensi</h4>
    </div>

		</div>

  <div class="row">


    <div class="col-md-12">
        <div class="white-box">
          <div class="row">
      <div class="col-md-12">
         <div class="box box-info">
            <div class="box-header with-border">
               <h3 class="box-title"><strong>Profil Kompetensi ASN</strong></h3>

            </div>
            <div class="box-body">
               <div class="row">
                  <div class="col-md-6">
                     <div class="table-responsive no-padding">
                        <table class="table table-hover">
                           <tr>
                              <td><strong>Nama</strong></td>
                              <td>:</td>
                              <td><?=$detail->nama_lengkap;?></td>
                           </tr>
                           <tr>
                              <td><strong>NIP</strong></td>
                              <td>:</td>
                              <td><?=$detail->nip;?></td>
                           </tr>
                           <tr>
                              <td><strong>Instansi</strong></td>
                              <td>:</td>
                              <td><?=$detail->nama_skpd;?></td>
                           </tr>
                           <tr>
                              <td><strong>Jabatan</strong></td>
                              <td>:</td>
                              <td><?=$detail->nama_jabatan;?></td>
                           </tr>
                           <tr>
                              <td><strong>Pendidikan Terakhir</strong></td>
                              <td>:</td>
                              <td><?=$detail->pendidikan;?></td>
                           </tr>
                           <tr>
                              <td><strong>Riwayat Diklat</strong></td>
                              <td>:</td>
                              <td><?= (!empty($riwayat_diklat->nama_diklat)) ? $riwayat_diklat->nama_diklat : "" ;?></td>
                           </tr>
                        </table>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="table-responsive no-padding">
                        <table class="table table-hover">
                           <tr hidden>
                              <td><strong>ID</strong></td>
                              <td>:</td>
                              <td><?=$detail->id_peserta;?></td>
                           </tr>
                           <tr>
                              <td><strong>Kompetensi</strong></td>
                              <td>:</td>
                              <td><?=$detail->jenis_kompetensi;?></td>
                           </tr>
                           <tr>
                              <td><strong>Tahun</strong></td>
                              <td>:</td>
                              <td><?=date("Y",strtotime($detail->tahun_kegiatan));?></td>
                           </tr>
                           <tr>
                              <td><strong>Analisis Kesenjangan Kinerja</strong></td>
                              <td>:</td>
                              <td>-</td>
                           </tr>
                           <tr>
                              <td><strong>Nilai Kesenjangan</strong></td>
                              <td>:</td>
                              <td><?=$detail->nilai_kompetensi;?></td>
                           </tr>
                           <tr>
                              <td><strong>Status</strong></td>
                              <td>:</td>
                              <td><i class="fa fa-square fa-lg" style="color:<?=($detail->status==1) ? 'green' : 'orange';?>"></i>&nbsp&nbsp <?=$detail->status_desc;?></td>
                            </tr>
                        </table>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
 </div>
</div>
<div class="col-md-12">
    <div class="white-box">
   <div class="row">
      <div class="col-xs-12">
         <div class="box box-info">
            <div class="box-header with-border">
               <h3 class="box-title"><strong>Indikator Kompetensi</strong></h3>

            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
               <table id="example1" class="table table-bordered table-striped">
                  <thead>
                     <tr class="info">
                        <th class="text-center">No.</th>
                        <th>Unit Kompentensi</th>
                        <th>Indikator</th>
                        <th class="text-center">Status</th>
                     </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no =1;
                    $i = 0;
                    $nama_kompetensi = "";
                    foreach ($dt_indikator as $row) {
                      if($nama_kompetensi != $row->nama_kompetensi)
                      {
                        $i = 1;
                        $nama_kompetensi = $row->nama_kompetensi;
                      }

                      ?>
                    <tr>
                        <td class="text-center"><?=$no;?></td>
                        <td><?=$row->nama_kompetensi;?></td>
                        <td><div style="float: left;width: 3%">1.<?=$i;?></div><div style="float: right;width: 97%"><?=$row->indikator;?></div></td>
                        <td class="text-center">
                          <div class='checkbox m-t-0 m-b-0'>
                            <input disabled type='checkbox'  <?= ($row->status=="Y") ? "checked" :"" ;?> class='checkbox' value='$row->id_indikator' id='checkbox$no' name='centang[]' >
                            <label for='checkbox$no'></label>
                          </div>

                        </td>
                     </tr>
                   <?php $i++; $no++;} ?>
                   </tbody>
               </table>
            </div>
         </div>
         <!-- /.box -->
      </div>
   </div>
 </div>
</div>
<div class="col-md-12">
    <div class="white-box">
      <div class="row">
      <div class="col-xs-12">
         <div class="box box-info">
            <div class="box-header with-border">
               <h3 class="box-title"><strong>Nilai Kesenjangan</strong></h3>

            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
               <table class="table table-bordered table-striped">
                  <thead>
                     <tr class="info">
                        <th class="text-center">No.</th>
                        <th>Unit Kompetensi</th>
                        <th>Nilai Kompetensi</th>
                     </tr>
                  </thead>
                  <tbody>
                  <?php
                  foreach ($dt_detail as $i => $row) {
                   ?>
                    <tr>
                        <td class="text-center"><?=($i+1);?></td>
                        <td><?=$row->nama_kompetensi;?></td>
                        <td><?=$row->nilai_kesenjangan;?></td>
                     </tr>
                   <?php }?>
                   </tbody>
               </table>
            </div>
         </div>
         <!-- /.box -->
      </div>
   </div>
    </div>
  </div>
<?php
if($dt_diklat->num_rows()>0):?>
<div class="col-md-12">
    <div class="white-box">
      <div class="row">
      <div class="col-xs-12">
         <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title"><strong><?=($status_title==0) ? 'Rekomendasi' : '';?> Pengembangan Kompetensi PNS</strong></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
               <table id="example2" class="table table-bordered table-striped">
                  <thead>
                     <tr class="info">
                        <th class="text-center">No.</th>
                        <th>Jenis PK</th>
                        <th>Bentuk PK</th>
                        <th>Status</th>
                     </tr>
                  </thead>
                  <tbody>
                  <?php foreach ($dt_diklat->result() as $key => $row) {?>
                      <tr>
                        <td class="text-center"><?= ($key+1) ;?></td>
                        <td><?=$row->nama_diklat;?></td>
                        <td><?=$row->kategori_diklat;?></td>
                        <td><span class="label label-info"><?=$row->status_desc;?></span></td>
                      </tr>
                    <?php }?>
                    </tbody>
               </table>
            </div>
         </div>
         <!-- /.box -->
      </div>
   </div>

        </div>

      </div>

    <?php endif?>

    </div>

    <div class="row">
    <div class="col-md-12">
       <div class="box box-info">
          <div class="box-footer">
             <div class="row">
                <div class="col-md-6">
                   <a href="<?=base_url();?>bangkom/penilaian" class="btn btn-primary">Kembali</a>
                </div>
             </div>
          </div>
       </div>
    </div>
 </div>

  </div>
