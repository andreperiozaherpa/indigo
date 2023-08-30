<div class="container-fluid">

	<div class="row bg-title">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<h4 class="page-title">Daftar Peserta Pengembangan Kompetensi</h4>
    </div>

		</div>

<form method="post" action="<?=base_url();?>bangkom/verifikasi/submit_verifikasi">
  <div class="row">


    <div class="col-md-12">
        <div class="white-box">
          <div class="row">
      <div class="col-md-12">
         <div class="box box-info">
            <div class="box-header with-border">
               <h3 class="box-title"><strong>Informasi Pengembangan Kompetensi</strong></h3>

            </div>
            <div class="box-body">
              <div class="row">
                 <div class="col-md-6">
                    <div class="table-responsive no-padding">
                       <table class="table table-hover">
                          <tr>
                             <td><strong>Jenis PK</strong></td>
                             <td>:</td>
                             <td><?=$training[0]->nama_diklat ;?></td>
                          </tr>
                          <tr>
                             <td><strong>Bentuk PK</strong></td>
                             <td>:</td>
                             <td>
                             <?=$training[0]->kategori_diklat;?>
                             <?=( $training[0]->jenis_pelatihan != null) ? '-'.$training[0]->jenis_pelatihan :'' ?>
                             </td>
                          </tr>
                          <tr>
                             <td><strong>Nilai Kesenjangan</strong></td>
                             <td>:</td>
                             <td><?=$training[0]->nilai_kesenjangan?></td>
                          </tr>
                          <tr>
                             <td><strong>Penyelenggara</strong></td>
                             <td>:</td>
                             <td><?=$training[0]->penyelenggara?></td>
                          </tr>
                          <tr>
                             <td><strong>Jadwal</strong></td>
                             <td>:</td>
                             <td><?=date('M Y', strtotime($training[0]->jadwal))?></td>
                          </tr>
                          <tr>
                             <td><strong>Tahun PK</strong></td>
                             <td>:</td>
                             <td><?= $tahun ?></td>
                          </tr>
                       </table>
                    </div>
                 </div>
                 <div class="col-md-6">
                    <div class="table-responsive no-padding">
                       <table class="table table-hover">
                          <tr>
                             <td><strong>Jam Pelajaran</strong></td>
                             <td>:</td>
                             <td><?=$training[0]->jam_pelajaran." JP"?></td>
                          </tr>
                          <tr>
                             <td><strong>Anggaran Dasar</strong></td>
                             <td>:</td>
                             <td><?="Rp. ".number_format($training[0]->anggaran, 0, ',', '.')?></td>
                          </tr>
                          <tr hidden="true">
                             <td><strong>Jumlah Peserta yang tidak ikut</strong></td>
                             <td>:</td>
                             <td><?= $pesertaTidakIkut." Orang" ?></td>
                          </tr>
                          <tr>
                             <td><strong>Jumlah Peserta yang Ikut</strong></td>
                             <td>:</td>
                             <td><?= $pesertaIkut." Orang" ?></td>
                          </tr>
                          <tr>
                             <td><strong>Total Anggaran</strong></td>
                             <td>:</td>
                             <td><?="Rp. ".number_format($total_anggaran, 0, ',', '.')?></td>
                          </tr>
                          <tr>
                             <td><strong>Sumber DPA</strong></td>
                             <td>:</td>
                             <td><?= $training[0]->dpa ?></td>
                          </tr>
                          <tr>
                             <td><strong>Kesesuaian PK Dengan standar Kurikulum</strong></td>
                             <td>:</td>
                             <td><?= $training[0]->kesesuaian ?></td>
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


<?php
if(!empty($peserta) && $peserta->num_rows()>0):?>
<div class="col-md-12">
    <div class="white-box">
      <div class="row">
      <div class="col-xs-12">
         <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title"><strong>Peserta</strong></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
               <table id="example2" class="table table-bordered table-striped">
                  <thead>
                     <tr class="info">
                        <th class="text-center">No.</th>
                        <th>NIP</th>
                        <th>Nama</th>
                        <th>Jabatan</th>
                        <th>Instansi</th>
                        <th>Kompetensi</th>
                        <th>Status</th>
                        <th class="text-center">Status Dipilih</th>
                     </tr>
                  </thead>
                  <tbody>
                  <?php foreach ($peserta->result() as $key => $row) {?>
                      <tr>
                        <td class="text-center"><?= ($key+1) ;?></td>
                        <td><label for='checkbox_<?=$key;?>'><?=$row->nip;?></label></td>
                        <td><label for='checkbox_<?=$key;?>'><?=$row->nama_lengkap;?></label></td>
                        <td><label for='checkbox_<?=$key;?>'><?=$row->nama_jabatan;?></label></td>
                        <td><label for='checkbox_<?=$key;?>'><?=$row->nama_skpd;?></label></td>
                        <td><label for='checkbox_<?=$key;?>'><?=$row->jenis_kompetensi;?></label></td>

                        <?php
                        $color = "primary";
                        $checked= "";
                        $disabled = "";
                        if($row->status == '1' && $row->status_diklat == '0' ){
                          $color = "info";
                          $checked= "checked";
                          $disabled = "";
                          $status = "TERVERIFIKASI PYB";
                        }
                        else if($row->status == '1' && $row->status_diklat == null ){
                          $color = "danger";
                          $checked= "checked";
                          $disabled = "";
                          $status = "BELUM TERVERIFIKASI";
                        }
                        else if($row->status == '1' && $row->status_diklat == '1' ){
                          $color = "warning";
                          $checked= "checked";
                          $disabled = "disabled";
                          $status = "TERVALIDASI PPK";
                        }
                        else if($row->status == '0' && $row->status_diklat == '0' ){
                          $color = "info";
                          $checked= "";
                          $disabled = "";
                          $status = "TERVERIFIKASI PYB";
                        }
                        else if($row->status == '0' && $row->status_diklat == '1' ){
                          $color = "info";
                          $checked= "";
                          $disabled = "disabled";
                          $status = "TERVALIDASI PPK";
                        }
                        else {
                          $color = "danger";
                          $checked= "";
                          $disabled = "";
                          $status = "BELUM TERVERIFIKASI";
                        }
                        ?>

                        <td><span class="label label-<?=$color;?>"><?=$status;?></span></td>
                        <td class="text-center">
                          <div class='checkbox m-t-0 m-b-0'>
                            <input <?=$checked;?> <?=$disabled;?>  type='checkbox'  class='checkbox' value='<?=$row->id;?>' id="checkbox_<?=$key;?>" name='centang[]' >
                            <label for='checkbox_<?=$key;?>'></label>
                          </div>

                        </td>
                      </tr>
                    <?php }?>
                    </tbody>
               </table>
            </div>
         </div>
         <input type="hidden" value="<?=$tahun;?>" name="tahun"/>
         <input type="hidden" value="<?=$id_diklat;?>" name="id_diklat"/>
         <button type="submit" <?=($disable)?"disabled":"";?> value="submit" class="btn pull-right mt-3  btn-primary">Verifikasi</button>
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


                  <a href="<?=base_url();?>bangkom/verifikasi" class="btn btn-default">Kembali</a>
                </div>
             </div>
          </div>
       </div>
    </div>
 </div>

</form>

  </div>
