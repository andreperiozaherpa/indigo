<div class="container-fluid">

  <div class="row bg-title">
    <!-- .page title -->
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
      <h4 class="page-title">Realisasi Kegiatan</h4>
    </div>
    <!-- /.page title -->
    <!-- .breadcrumb -->
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

      <ol class="breadcrumb">
        <li><a href="<?= base_url();?>/admin">Dashboard</a></li>
        <li><a href="<?= base_url();?>/realisasi_kegiatan">Realisasi Kegiatan</a></li>
        <li class="active">Detail Realisasi Kegiatan</li>
      </ol>
    </div>
    <!-- /.breadcrumb -->
  </div>
  <div class="row">
   <div class="col-md-12">
    <div class="row">
      <div style="margin-bottom: 14px" class="pull-right">
        <a href="<?=base_url('realisasi_kegiatan')?>" class="btn btn-default"><i class="ti-arrow-circle-left"></i> Kembali</a> 
      </div>
    </div>
  </div>
  <div class="col-lg-4 col-sm-12">
    <div class="white-box">
      <div class="col-in row">
        <div class="col-md-6 col-sm-6 col-xs-6"> <i style="font-size: 40px" class="ti-briefcase"></i>
         <h5 class="text-muted vb">JUMLAH PEKERJAAN</h5> </div>
         <div class="col-md-6 col-sm-6 col-xs-6">
          <h3 class="counter text-right m-t-15 text-primary"><?=count($anggota)?></h3> </div>
          <div class="col-md-12 col-sm-12 col-xs-12">
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-4 col-sm-12">
      <div class="white-box">
        <div class="col-in row">
          <div class="col-md-6 col-sm-6 col-xs-6"> <i style="font-size: 40px" class="ti-check-box"></i>
            <h5 class="text-muted vb">SUDAH DIVERIFIKASI</h5> </div>
            <div class="col-md-6 col-sm-6 col-xs-6">
             <h3 class="counter text-right m-t-15 text-success"><?=$diterima?></h3> </div>
             <div class="col-md-12 col-sm-12 col-xs-12">
             </div>
           </div>
         </div>
       </div>
       <div class="col-lg-4 col-sm-12">
         <div class="white-box">
           <div class="col-in row">
             <div class="col-md-6 col-sm-6 col-xs-6"> <i style="font-size: 40px" class="ti-time"></i>
               <h5 class="text-muted vb">DALAM PROSES VERIFIKASI</h5> </div>
               <div class="col-md-6 col-sm-6 col-xs-6">
                <h3 class="counter text-right m-t-15 text-danger"><?=$menunggu_verifikasi?></h3> </div>
              </div>
            </div>
          </div>

          <div class="col-md-12">
           <div class="panel panel-default" > 
            <div class="panel-heading"> 
             <div class="row">
              <div class="col-md-2">
               <h3><b>Progress</b></h3>
             </div>
             <div class="col-md-8">
               <div class="progress progress-lg" style="margin-top:15px;">
                <?php 
                if($progress==100){
                  $color = 'info';
                }elseif($progress>=80&&$progress<100){
                  $color = 'success';
                }elseif($progress>=40&&$progress<80){
                  $color = 'warning';
                }else{
                  $color = 'danger';
                }
                ?>
                <div id="progress-bar" class="progress-bar progress-bar-<?=$color?>" role="progressbar" style="width: <?=$progress?>%;" role="progressbar" > <?=$progress?>% </div>
              </div>
            </div>
            <div class="col-md-2">
             <h3 class="pull-right"><b>Jatuh Tempo</b></h3>
           </div>
         </div>
       </div> 
       <div class="panel-body"> 
         <div class="row">
          <div class="col-md-5">
           <table class="table" id="data">
            <!-- <h3> &nbsp;<b class="text-danger">project 008</b></h3> -->
            <tr>
             <td>Kode IKU</td>
             <td>:</td>
             <td><?=empty($k->id_iku) ? 'Tidak Ada IKU' : $k->id_iku?></td>
           </tr>
           <tr>
             <td>Nama Kegiatan</td>
             <td>:</td>
             <td><?=$k->nama_kegiatan?></td>
           </tr>
           <tr>
             <td>Dasar Hukum</td>
             <td>:</td>
             <td><?=$k->dasar_hukum?></td>
           </tr>
           <tr>
             <td>Prioritas</td>
             <td>:</td>
             <td><?=ucwords($k->prioritas)?></td>
           </tr>
           <tr>
             <td>Anggaran</td>
             <td>:</td>
             <td><?=rupiah($k->anggaran_kegiatan)?></td>
           </tr>
           <tr>
             <td>Uraian</td>
             <td>:</td>
             <td><?=$k->uraian_kegiatan?></td>
           </tr>
           <tr>
             <td>Deskripsi Pekerjaan</td>
             <td>:</td>
             <td><?=$k->detail_pekerjaan?></td>
           </tr>
           <tr>
             <td>Status</td>
             <td>:</td>
             <td><?=ucwords($k->status_kegiatan)?></td>
           </tr>
           <tr>
             <td>File Pendukung</td>
             <td>:</td>
             <td><a href="<?=base_url('data/kegiatan/'.$k->file_pendukung.'')?>" target="_blank"><?=$k->file_pendukung?></a></td>
           </tr>
           <tr>
             <td>Surat Perintah</td>
             <td>:</td>
             <td><a href="<?=base_url('data/kegiatan/'.$k->surat_perintah.'')?>" target="_blank"><?=$k->surat_perintah?></a></td>
           </tr>
         </table>
       </div>
       <div class="col-md-3">
       </div>
       <div class="col-md-3">
         <address>
          <h4 class="font-bold">Tim </h4>
          <p class="text-muted m-l-30">
           <strong><?=$k->nama_lengkap?> (Ketua)</strong>,  <br>
           <?php
           $id_pegawai = array();
           foreach($anggota as $a){
            $p = $a->id_pegawai;
            $p = explode(';', $p);
            foreach($p as $q){
              if(!in_array($q, $id_pegawai)){
                $id_pegawai[] = $q;
                $this->pegawai_model->id_pegawai = $q;
                $get = $this->pegawai_model->get_by_id($q);
                echo $get->nama_lengkap."<br>";
              }
            }
          }
          ?>  
          <p class="m-t-30"><b>Tanggal Awal :</b> <i class="fa fa-calendar"></i> <?=tanggal($k->tgl_mulai_kegiatan)?></p>
          <p><b>Tanggal Akhir :</b> <i class="fa fa-calendar"></i> <?=tanggal($k->tgl_akhir_kegiatan)?></p>
          <p><b>Lokasi :</b> <i class="fa fa-map-marker"></i> 
            <?=$k->nama_lokasi?><br>
            <?php $desa = $this->ref_wilayah_model->get_nama_desa($k->id_desa_kegiatan); 
            echo $desa == '' ? '' : $desa.", "  ?>
            <?php $kecamatan = $this->ref_wilayah_model->get_nama_kecamatan($k->id_kecamatan_kegiatan); 
            echo $kecamatan == '' ? '' : $kecamatan.", "  ?>
            <?php $kabupaten = $this->ref_wilayah_model->get_nama_kabupaten($k->id_kabupaten_kegiatan); 
            echo $kabupaten == '' ? '' : $kabupaten.", "  ?>
            <?php $provinsi = $this->ref_wilayah_model->get_nama_provinsi($k->id_provinsi_kegiatan); 
            echo $provinsi == '' ? '' : $provinsi.""  ?>
          </p>
        </address>
      </div>
    </div>
  </div>
</div>

<div class="panel panel-default"> 
 <div class="panel-heading"> 
  REALISASI KEGIATAN
</div>
<div class="panel-body">
  <ul class="timeline">
    <?php $no=1; foreach($realisasi as $r){
      if($no%2==0){
        $class = 'timeline-inverted';
      }else{
        $class = '';
      }

      ?>
      <li class="<?=$class?>">
       <div class="timeline-badge primary">
        <i data-icon="e" class="linea-icon linea-basic fa-fw"></i>
      </div>
      <div class="timeline-panel">
       <div class="col-md-6">
        <?php 
        $p = $r->id_pegawai;
        $p = explode(';', $p);
        foreach($p as $q){
          $this->pegawai_model->id_pegawai = $q;
          $get = $this->pegawai_model->get_by_id($q);
          ?>
          <p><i class="fa fa-circle"></i> <?=$get->nama_lengkap?></p>
          <?php
        }
        ?>
        <hr>
      </div>
      <div class="col-md-6">
        <div class="row">
         <div class="col-md-12">
          <?=status_realisasi($r->status)?>
        </div>
        <div class="col-md-12">
          <p style="margin-top: 15px" class="pull-right"><i class="fa fa-calendar"></i> 
            <?php 
            $tgl = $r->tgl_update;
            if(is_null($tgl)){
              echo "-";
            }else{
              echo tanggal($tgl);
            }
            ?>
          </p>
        </div>
      </div>
    </div>
    <div class="col-md-12">

     <div class="form-group">
       <label class="control-label">Uraian Pekerjaan</label>
       <p class="form-control-static">
        <?=$r->uraian_pekerjaan?>
      </p>
    </div>
    <?php 
    if(!empty($r->realisasi)){
      ?>
      <div class="form-group">
       <label class="control-label">Realisasi Pekerjaan</label>
       <p class="form-control-static">
        <?=$r->realisasi?></p>
      </div>
    <?php } ?>
    <?php 

    $file = $this->realisasi_kegiatan_model->get_realisasi_file($r->id_realisasi);
    if(count($file)>0){
      ?>
      <div class="form-group">
       <label class="control-label">Attachement</label>
       <?php 
       foreach($file as $f){
         ?>
         <p> 
          <i class="ti-clip"></i> <a href="<?=base_url('data/kegiatan_realisasi/'.$f->file.'')?>"><?=$f->file?></a>
          </p>      <?php 
        }
        ?>

      </div>

      <?php
    } ?>
    <hr>
    <div class="pull-right">
      <?php 
      $id_p = $this->session->userdata('id_pegawai');
      ?>
      <?php if($user_level=='Administrator' || $k->id_ketua_tim == $id_p){
        if($r->status=='menunggu_verifikasi'){
        ?>
       <a onclick="return confirm('Apakah anda yakin?')" href="<?=site_url('realisasi_kegiatan/update_status/'.$k->id_kegiatan.'/'.$r->id_realisasi.'/1')?>" class="btn btn-success">Setujui</a>
       <a onclick="return confirm('Apakah anda yakin?')" href="<?=site_url('realisasi_kegiatan/update_status/'.$k->id_kegiatan.'/'.$r->id_realisasi.'/0')?>" class="btn btn-primary">Tolak</a>
     <?php }}
     $pe = $r->id_pegawai;
     $pe = explode(';', $pe);
     if(in_array($id_p, $pe)){
      ?>
      <a href="javascript:void(0)" onclick="updateRealisasi(<?=$r->id_realisasi?>)" class="btn btn-default">Update</a>
    <?php } ?>
  </div>
</div>
</div>
</li>  
<?php $no++; } ?>
</ul>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>


<div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title" id="myModalLabel">Tambah Baru</h4> </div>
        <div class="modal-body">
          <form role="form" id="form" method="post" enctype="multipart/form-data">
            <div id="hidden"></div>
            <div class="form-group">
              <label class="control-label">Uraian Pekerjaan </label>
              <textarea class="form-control" name="uraian_pekerjaan"></textarea>

            </div>
            <div class="form-group">
              <label class="control-label">Realisasi Pekerjaan </label>
              <textarea class="form-control" name="realisasi"></textarea>

            </div>
            <div id="file_add" class="form-group">
              <label class="control-label">File Pendukung </label>
              <input type="file" name='files[]'  id="data_pendukung" class="dropify"  data-label="<i class='glyphicon glyphicon-file'></i> Browse"  data-height="100" multiple />
              <small>File yang diizinkan : jpg,jpeg,png,gif,ppt,pptx,doc,docx,xls,xlsx,pdf</small>
            </div>
            <a onclick="addFile()" href="javascript:void(0)" class="btn btn-primary btn-xs">Tambah File</a>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            <input type="submit" id="submitBtn" name="" class="btn btn-primary" value="Simpan">
          </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
</div>

<script type="text/javascript">

  function addFile(){
    $('#file_add').append('<input type="file" name="files[]"  id="data_pendukung" class="dropify" data-height="100" />');
    $('.dropify').dropify();
  }
  function updateRealisasi(id){
    $('#form')[0].reset();
    $('#submitBtn').attr('name', 'edit');
    $('.modal-title').html('Edit Data');
    $.ajax({
      url : "<?php echo base_url('realisasi_kegiatan/fetch_realisasi/')?>/" + id,
      type: "GET",
      dataType: "JSON",
      success: function(data)
      {
        $('#hidden').html('<input type="hidden" name="id_realisasi" value="">');
        $('[name="id_realisasi"]').val(data.id_realisasi);
        $('[name="uraian_pekerjaan"]').val(data.uraian_pekerjaan);
        $('[name="realisasi"]').val(data.realisasi);
        $('#myModal').modal('show'); 
      },
      error: function (jqXHR, textStatus, errorThrown)
      {
        alert("Gagal mendapatkan data");
      }
    });
  }
</script>