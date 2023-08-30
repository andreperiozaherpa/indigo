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
                echo'<option value="'.$i.'">'.$i.'</option>';
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
                echo'<option value="'.$r->id_renstra.'">'.$r->renstra.'</option>';
              }
              ?>
            </select>
          </div>


          <div class="form-group">
            <label class="control-label">Nama Kegiatan</label>
            <input name="nama_kegiatan" type="text"  class="form-control" placeholder="">
          </div>


          <div class="form-group">
            <label class="control-label">Indikator Keluaran (Output)</label>
            <input name="indikator_keluaran" type="text" class="form-control" placeholder="">
          </div>

          <div class="form-group">
            <label class="control-label">Indikator hasil (Outcome)</label>
            <input name="indikator_hasil" type="text" class="form-control" placeholder="">
          </div>



        </div>
      </div> 

      <div class="col-md-6">
        <div class="white-box">
          <div class="row">
            <div class="col-md-6">
             <div class="form-group">
              <label class="control-label">Target (kuantitatif) </label>
              <input name="target" type="number" class="form-control" placeholder="">
            </div>
          </div>
          <div class="col-md-6">

           <div class="form-group">
            <label class="control-label">Satuan</label>
            <select name="id_satuan_target" class="form-control">
              <option value="">Pilih Satuan</option>
              <?php 
              foreach($satuan as $r){
                echo'<option value="'.$r->id_satuan.'">'.$r->satuan.'</option>';
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
          <input name="waktu" type="number" class="form-control" placeholder="">
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
        echo'<option value="'.$r.'">'.ucwords($r).'</option>';
      }
      ?>
       </select>
     </div>

   </div>

 </div>


 <div class="form-group">
  <label class="control-label">Anggaran (Rp)</label>
  <input name="anggaran" type="text" class="form-control" placeholder="">
</div>

<div class="row">
 <div class="form-group">
   <div class="col-md-12">
    <label class="control-label">Unit Penanggung Jawab </label>
    <select name="id_unit_penanggungjawab" class="form-control">
      <option value="">Pilih Unit Penanggung Jawab</option>
      <?php 
      foreach($unit_kerja as $r){
        echo'<option value="'.$r->id_unit_kerja.'">'.$r->nama_unit_kerja.'</option>';
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


