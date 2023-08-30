<script type="text/javascript">
  function getKabupaten(){
    var id = $('#id_provinsi').val();
    $.post("<?=base_url()."/"?>ref_kode_kegiatan/get_kabupaten/"+id,{},function(obj){
      $('#id_kabupaten').html(obj);
    });
    
  }
  function getKecamatan(){
    var id = $('#id_kabupaten').val();
    $.post("<?=base_url()."/"?>ref_kode_kegiatan/get_kecamatan/"+id,{},function(obj){
      $('#id_kecamatan').html(obj);
    });
    
  }
  function getDesa(){
    var id = $('#id_kecamatan').val();
    $.post("<?=base_url()."/"?>ref_kode_kegiatan/get_desa/"+id,{},function(obj){
      $('#id_desa').html(obj);
    });
  }
</script>
<div class="col-md-12 col-sm-12 col-xs-12">
  <div class="white-box">
    <div class="x_title">
      <h2>Tambah Ref. kode_kegiatan</h2>
      <ul class="nav navbar-right panel_toolbox">
        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
        </li>

      </ul>
      <div class="clearfix"></div>
    </div>
    <div class="x_content">
      <form class="form-horizontal form-label-left" method="post">

        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Kode Kegiatan</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <input type="text" class="form-control" value="<?=$item->kode_kegiatan?>" name="kode_kegiatan"required>
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Uraian</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <input type="text" class="form-control" value="<?=$item->uraian?>" name="uraian" placeholder="Uraian" required>
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Anggaran</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <input type="text" class="form-control" value="<?=$item->anggaran?>" name="anggaran"required>
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Nama Lokasi</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <input type="text" class="form-control" value="<?=$item->nama_lokasi?>" name="nama_lokasi"required>
          </div>
        </div>

        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Provinsi</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <select name="id_provinsi_kegiatan" onchange="getKabupaten()" id="id_provinsi" class="form-control ">
              <option value="">Pilih Provinsi</option>
                <?php 
                foreach($provinsi as $p){
                  if($p->id_provinsi==$item->id_provinsi_kegiatan){
                    $selected = ' selected';
                  }else{
                    $selected = '';
                  }
                  echo '<option value="'.$p->id_provinsi.'"'.$selected.'>'.$p->provinsi.'</option>';
                }
                ?>
            </select>
          </div>
        </div>       
      <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Kabupaten</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
              <select name="id_kabupaten_kegiatan" onchange="getKecamatan()" id="id_kabupaten" class="form-control ">
              <option value="">Pilih Kabupaten</option>
                <?php 
                foreach($kabupaten as $p){
                  if($p->id_kabupaten==$item->id_kabupaten_kegiatan){
                    $selected = ' selected';
                  }else{
                    $selected = '';
                  }
                  echo '<option value="'.$p->id_kabupaten.'"'.$selected.'>'.$p->kabupaten.'</option>';
                }
                ?>
            </select>
          </div>
        </div>           <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Kecamatan</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
              <select name="id_kecamatan_kegiatan" onchange="getDesa()" id="id_kecamatan" class="form-control ">
              <option value="">Pilih Kecamatan</option>
                <?php 
                foreach($kecamatan as $p){
                  if($p->id_kecamatan==$item->id_kecamatan_kegiatan){
                    $selected = ' selected';
                  }else{
                    $selected = '';
                  }
                  echo '<option value="'.$p->id_kecamatan.'"'.$selected.'>'.$p->kecamatan.'</option>';
                }
                ?>
            </select>
          </div>
        </div>           <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Desa</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
              <select name="id_desa_kegiatan" id="id_desa" class="form-control ">
              <option value="">Pilih Desa</option>
                <?php 
                foreach($desa as $p){
                  if($p->id_desa==$item->id_desa_kegiatan){
                    $selected = ' selected';
                  }else{
                    $selected = '';
                  }
                  echo '<option value="'.$p->id_desa.'"'.$selected.'>'.$p->desa.'</option>';
                }
                ?>
            </select>
          </div>
        </div>
        <div class="ln_solid"></div>
        <div class="form-group">
          <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
            <a href="<?=base_url('ref_kode_kegiatan')?>" class="btn btn-default">Batal</a>
            <button type="submit" class="btn btn-success">Simpan</button>
          </div>
        </div>

      </form> 
    </div>
  </div>
</div>
</div>
