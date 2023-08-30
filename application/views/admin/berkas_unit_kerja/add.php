 <div class="container-fluid">

  <div class="row bg-title">
    <!-- .page title -->
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
      <h4 class="page-title">Berkas Tahunan Unit Kerja</h4>
    </div>
    <!-- /.page title -->
    <!-- .breadcrumb -->
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

      <ol class="breadcrumb">
        <li><a href="<?= base_url();?>admin">Dashboard</a></li>
        <li><a href="<?= base_url();?>berkas_unit_kerja">Berkas Tahunan</a></li>
        <li class="active">Tambah</li>
      </ol>
    </div>
    <!-- /.breadcrumb -->
  </div>

  
  <!-- .row -->

  <div class="row">  
        <?php if (!empty($message)) echo "
        <div class='alert alert-$message_type'>$message</div>";?>
    <form method="POST" enctype="multipart/form-data" >

      <div class="col-md-6">
        <div class="white-box">


 <div class="form-group">
    <label class="control-label">Unit Kerja </label>
    <select name="id_unit_kerja" class="form-control" required>
      <option value="">Pilih Unit Kerja</option>
      <?php 
      foreach($unit_kerja as $r){
        if ($this->input->get('id_unit_kerja') == $r->id_unit_kerja) {
          $selected = "selected";
        } else {
          $selected = "";
        }
        echo'<option value="'.$r->id_unit_kerja.'"'.$selected.'>'.$r->nama_unit_kerja.'</option>';
      }
      ?>
    </select>
 </div>

 <div class="form-group">
    <label class="control-label">Tahun </label>
    <select name="tahun_berkas" class="form-control" required>
      <option value="">Pilih Tahun</option>
      <?php 
        $current_year = date("Y");
        $array_year = array();
        foreach($tahun as $r){
          if ($r->tahun_berkas>0) {
            array_push($array_year, $r->tahun_berkas);
          }
        }
        $min_year = ($array_year[0]<$current_year-5) ? $array_year[0] : $current_year-5;
        $max_year = ($array_year[count($array_year)-1]>$current_year+5) ? $array_year[count($array_year)-1] : $current_year+5;
        for ($i=$min_year; $i < $max_year; $i++) { 
          array_push($array_year, $i);
        }
        $array_year = array_unique($array_year);
        rsort($array_year);
        foreach ($array_year as $year) {
          echo'<option value="'.$year.'">'.$year.'</option>';
        }
      ?>
    </select>
</div>

 <div class="form-group">
  <label class="control-label">Renstra</label>
  <input type="file" name='renstra' id="input-file-now-custom-3" class="dropify" data-label="<i class='glyphicon glyphicon-file'></i> Browse" />
</div>

 <div class="form-group">
  <label class="control-label">RKT</label>
  <input type="file" name='rkt' id="input-file-now-custom-3" class="dropify" data-label="<i class='glyphicon glyphicon-file'></i> Browse" />
</div>

 <div class="form-group">
  <label class="control-label">PK</label>
  <input type="file" name='pk' id="input-file-now-custom-3" class="dropify" data-label="<i class='glyphicon glyphicon-file'></i> Browse" />
</div>

 <div class="form-group">
  <label class="control-label">LKJ</label>
  <input type="file" name='lkj' id="input-file-now-custom-3" class="dropify" data-label="<i class='glyphicon glyphicon-file'></i> Browse" />
</div>


</div>
<div class="pull-right">
  <a href="<?=base_url('berkas_unit_kerja')?>" class="btn btn-default ">Batal</a>
  <button type="submit" class="btn btn-primary ">Simpan</button>
</div>
</div>



</div>

<form>


</div>


