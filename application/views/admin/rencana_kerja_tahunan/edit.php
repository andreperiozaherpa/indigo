 <div class="container-fluid">

  <div class="row bg-title">
    <!-- .page title -->
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
      <h4 class="page-title">Rencana Kerja Tahunan</h4>
    </div>
    <!-- /.page title -->
    <!-- .breadcrumb -->
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

      <ol class="breadcrumb">
        <li><a href="#">Dashboard</a></li>
        <li class="active">Starter Page</li>
      </ol>
    </div>
    <!-- /.breadcrumb -->
  </div>

  
  <!-- .row -->

  <div class="row">  
        <?php if (!empty($message)) echo "
        <div class='alert alert-$message_type'>$message</div>";?>
    <form method="POST">
      <div class="col-md-6">
        <div class="white-box">

          <div class="form-group">
            <label class="control-label">Tahun</label>
            <select name="tahun_rkt" class="form-control">
              <option value="">Pilih Tahun</option>
              <?php 
              $year = date('Y');
              for ($i=$year-10; $i < $year+10 ; $i++) { 
                if($item->tahun_rkt==$i){
                  $selected = ' selected';
                }else{
                  $selected = '';
                }
                echo'<option value="'.$i.'"'.$selected.'>'.$i.'</option>';
              }
              ?>
            </select>
          </div>

          <div class="form-group">
            <label class="control-label">Ref. Renstra</label>
            <select name="id_renstra" class="form-control">
              <option value="">Pilih Renstra</option>
              <?php 
              foreach($renstra as $r){
                if($item->id_renstra==$r->id_renstra){
                  $selected = ' selected';
                }else{
                  $selected = '';
                }
                echo'<option value="'.$r->id_renstra.'"'.$selected.'>'.$r->renstra.'</option>';
              }
              ?>
            </select>
          </div>


          <div class="form-group">
            <label class="control-label">Nama Kegiatan</label>
            <input name="nama_kegiatan" type="text" value="<?=$item->nama_kegiatan?>"  class="form-control" placeholder="">
          </div>


          <div class="form-group">
            <label class="control-label">Indikator Keluaran (Output)</label>
            <input name="indikator_keluaran" type="text" value="<?=$item->indikator_keluaran?>" class="form-control" placeholder="">
          </div>

          <div class="form-group">
            <label class="control-label">Indikator hasil (Outcome)</label>
            <input name="indikator_hasil" type="text" value="<?=$item->indikator_hasil?>" class="form-control" placeholder="">
          </div>



        </div>
      </div> 

      <div class="col-md-6">
        <div class="white-box">
          <div class="row">
            <div class="col-md-6">
             <div class="form-group">
              <label class="control-label">Target (kuantitatif) </label>
              <input name="target" type="number" value="<?=$item->target?>" class="form-control" placeholder="">
            </div>
          </div>
          <div class="col-md-6">

           <div class="form-group">
            <label class="control-label">Satuan</label>
            <select name="id_satuan_target" class="form-control">
              <option value="">Pilih Satuan</option>
              <?php 
              foreach($satuan as $r){
                if($item->id_satuan_target==$r->id_satuan){
                  $selected = ' selected';
                }else{
                  $selected = '';
                }
                echo'<option value="'.$r->id_satuan.'"'.$selected.'>'.$r->satuan.'</option>';
              }
              ?>
            </select>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-6">
         <div class="form-group">
          <label class="control-label">Waktu (yang dibutuhkan) </label>
          <input name="waktu" value="<?=$item->waktu?>" type="number" class="form-control" placeholder="">
        </div>
      </div>
      <div class="col-md-6">

       <div class="form-group">
        <label class="control-label">Type waktu</label>
        <select name="satuan_waktu" class="form-control">
      <option value="">Pilih Type waktu</option>
      <?php 
      $waktu = array('bulan','triwulan','tahun');
      foreach($waktu as $r){
                if($item->satuan_waktu==$r){
                  $selected = ' selected';
                }else{
                  $selected = '';
                }
        echo'<option value="'.$r.'"'.$selected.'>'.ucwords($r).'</option>';
      }
      ?>
       </select>
     </div>

   </div>

 </div>


 <div class="form-group">
  <label class="control-label">Anggaran (Rp)</label>
  <input name="anggaran" value="<?=$item->anggaran?>" type="text" class="form-control" placeholder="">
</div>

<div class="row">
 <div class="form-group">
   <div class="col-md-12">
    <label class="control-label">Unit Penanggung Jawab </label>
    <select name="id_unit_penanggungjawab" class="form-control">
      <option value="">Pilih Unit Penanggung Jawab</option>
      <?php 
      foreach($unit_kerja as $r){
                if($item->id_unit_penanggungjawab==$r->id_unit_kerja){
                  $selected = ' selected';
                }else{
                  $selected = '';
                }
        echo'<option value="'.$r->id_unit_kerja.'"'.$selected.'>'.$r->nama_unit_kerja.'</option>';
      }
      ?>
    </select>
  </div>
</div>
</div>


</div>
<div class="pull-right">
  <a href="<?=base_url('ref_rkt')?>" class="btn btn-default ">Batal</a>
  <button type="submit" class="btn btn-primary ">Simpan</button>
</div>
</div>



</div>

<form>


</div>


