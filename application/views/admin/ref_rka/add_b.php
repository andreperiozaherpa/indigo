 <style type="text/css">
   .checkbox, .radio{
    margin: 0;
   }
 </style>
 <div class="container-fluid">

  <div class="row bg-title">
    <!-- .page title -->
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
      <h4 class="page-title">Rencana Kerja Anggaran</h4>
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

      <div class="col-md-4">
        <div class="white-box">

         <div class="form-group">
          <label class="control-label">Kode</label>
          <input name="kode_rka" type="text" class="form-control" placeholder="">
        </div>

        <div class="form-group">
          <label class="control-label">Program/Kegiatan</label>
          <input name="kegiatan_rka" type="text" class="form-control" placeholder="">
        </div>

        <div class="form-group">
          <label class="control-label">Uraian Kegiatan</label>
          <textarea name="uraian_rka" class="form-control"></textarea>
        </div>

        <div class="form-group">
          <label class="control-label">Total Pagu (Rp)</label>
          <input name="pagu_rka" type="text" class="form-control" placeholder="">
        </div>
        <?php
        if($user_level=='Administrator'){
          if($this->uri->segment(4)=='master'){
            ?>

            <input type="hidden" name="id_unit_kerja" value="0">
            <?php
          }else{
            ?>
            <div class="row">
             <div class="form-group">
               <div class="col-md-12">
                <label class="control-label">Unit Kerja </label>
                <select name="id_unit_kerja" class="form-control">
                  <option value="">Pilih Unit Kerja</option>
                  <?php 
                  foreach($unit_kerja as $r){
                    if($item->id_unit_kerja==$r->id_unit_kerja){
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
        <?php }
      }else{
        ?>
        <input type="hidden" name="id_unit_kerja" value="<?=$this->session->userdata('unit_kerja_id')?>">
        <?php
      }
      ?>


    </div>
    <div class="pull-right">
      <a href="<?=base_url('ref_rka')?>" class="btn btn-default ">Batal</a>
      <button type="submit" class="btn btn-primary ">Simpan</button>
    </div>
  </div>

  <div class="col-md-8">
    <div class="white-box">


      <div class="table-responsive">
        <table class="table">
          <thead>
            <tr>
              <th style="text-align: center">Kode</th>
              <th style="text-align: center">Pagu</th>
              <th style="text-align: center">Uraian</th>
              <th style="text-align: center">
                <div class="checkbox checkbox-primary">
                  <input id="checkbox2" type="checkbox">
                  <label for="checkbox2"></label>
                </div>
              </th>
            </tr>
          </thead>
          <tbody>
            <?php 
            $no=1;
              foreach($master as $m){
            ?>
            <tr>
              <td style="text-align: center"><?=$m->kode_rka?></td>
              <td style="text-align: center"><?=rupiah($m->pagu_rka)?></td>
              <td style="text-align: center"><?=($m->uraian_rka)?></td>
              <td style="text-align: center">
                <div class="checkbox checkbox-primary">
                  <input id="checkbox2" type="checkbox">
                  <label for="checkbox2"></label>
                </div>
              </td>
            </tr>
            <?php $no++; } ?>
          </tbody>
        </table>
      </div>


    </div>
  </div>


</div>

<form>


</div>


