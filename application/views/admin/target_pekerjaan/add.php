<script type="text/javascript">
  function getKabupaten(){
    var id = $('#id_provinsi').val();
    $.post("<?=base_url()."/"?>target_pekerjaan/get_kabupaten/"+id,{},function(obj){
      $('#id_kabupaten').html(obj);
    });
    
  }
  function getKecamatan(){
    var id = $('#id_kabupaten').val();
    $.post("<?=base_url()."/"?>target_pekerjaan/get_kecamatan/"+id,{},function(obj){
      $('#id_kecamatan').html(obj);
    });
    
  }
  function getDesa(){
    var id = $('#id_kecamatan').val();
    $.post("<?=base_url()."/"?>target_pekerjaan/get_desa/"+id,{},function(obj){
      $('#id_desa').html(obj);
    });
  }
</script>
<div class="white-box">
  <div class="x_title">
    <ul class="nav navbar-right panel_toolbox">
      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
      </li>

    </ul>
    <div class="clearfix"></div>
  </div>
  <div class="x_content">
    <form  method="post">

      <div class="row">
        <div class="col-md-6">
          <div class="panel-body">
            <div class="form-body">
              <h3 class="box-title">Target Pekerjaan / Kegiatan</h3>
              <hr>


              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label class="control-label">Kategori Pekerjaan</label>
                    <select name="id_pekerjaan" class="form-control">
                      <option value="">Pilih Kategori Pekerjaan</option>
                      <?php foreach($pekerjaan as $p){
                        echo '<option value="'.$p->id_pekerjaan.'">'.$p->nama_pekerjaan.'</option>';
                      } ?>
                    </select>

                  </div>
                </div>
                <!--/span-->
                <div class="col-md-12">
                  <div class="form-group">
                    <label class="control-label">Nama Kegiatan</label>
                    <input type="text" name="nama_kegiatan" id="lastName" class="form-control" placeholder="">
                  </div>
                </div>
                <!--/span-->

                <div class="col-md-12">
                  <div class="form-group">
                    <label class="control-label">Angka Kredit </label>
                    <input type="text" name="angka_kredit" id="lastName" class="form-control" placeholder="">
                  </div>
                </div> 

                <div class="col-md-12">
                  <div class="form-group">
                    <label class="control-label">Uraian Kegiatan / Keterangan </label>
                    <textarea name="uraian_kegiatan" class="form-control"></textarea>
                  </div>
                </div> 

                <h3 class="box-title">Tanggal Kegiatan</h3>
                <hr>

                <div class="row">
                 <div class="col-md-6">
                  <div class="form-group">
                    <label class="control-label">Tanggal Mulai </label>
                    <input type="text" name="tgl_mulai_kegiatan" class="form-control mydatepicker" placeholder="">
                  </div>
                </div> 

                <div class="col-md-6">
                  <div class="form-group">
                    <label class="control-label">Tanggal Akhir </label>
                    <input type="text" name="tgl_akhir_kegiatan" class="form-control mydatepicker" placeholder="">
                  </div>
                </div> 
              </div>


              <h3 class="box-title">Lokasi Kegiatan</h3>
              <hr>

              <div class="row">
               <div class="col-md-12">
                <div class="form-group">
                  <label class="control-label">Nama Lokasi </label>
                  <input type="text" name="nama_lokasi" class="form-control" placeholder="">
                </div>
              </div> 

              <div class="col-md-6">
                <div class="form-group">
                  <label class="control-label">Provinsi </label>
                  <select name="id_provinsi_kegiatan" onchange="getKabupaten()" id="id_provinsi" class="form-control ">
                    <option value="">Pilih Provinsi</option>
                    <?php 
                    foreach($provinsi as $p){
                      echo '<option value="'.$p->id_provinsi.'">'.$p->provinsi.'</option>';
                    }
                    ?>
                  </select>
                </div>
              </div> 


              <div class="col-md-6">
                <div class="form-group">
                  <label class="control-label">Kabupaten / Kota </label>
                  <select name="id_kabupaten_kegiatan" onchange="getKecamatan()" id="id_kabupaten" class="form-control ">
                    <option value="">Pilih Kabupaten</option>
                  </select>
                </div>
              </div> 


              <div class="col-md-6">
                <div class="form-group">
                  <label class="control-label">Kecamatan  </label>
                  <select name="id_kecamatan_kegiatan" onchange="getDesa()" id="id_kecamatan" class="form-control ">
                    <option value="">Pilih Kecamatan</option>
                  </select>
                </div>
              </div> 


              <div class="col-md-6">
                <div class="form-group">
                  <label class="control-label">Desa / Kelurahan  </label>
                  <select name="id_desa_kegiatan" id="id_desa" class="form-control ">
                    <option value="">Pilih Desa</option>
                  </select>
                </div>
              </div> 

            </div>







          </div>




        </div>

      </div>
    </div>

    <div class="col-md-6">
     <div class="panel-body">
      <div class="form-body">

        <h3 class="box-title">Kuantitas Kegiatan</h3>
        <hr>

        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label class="control-label">Kuantitas</label>
              <input type="text" name="kuantitas_kegiatan" id="lastName" class="form-control" placeholder="">

            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label class="control-label">Satuan</label>

              <select name="id_satuan_kuantitas" class="form-control">
                <option value="">Pilih Satuan</option>
                <?php 
                foreach($satuan as $s){
                  echo '<option value="'.$s->id_satuan.'">'.$s->satuan.'</option>';
                }
                ?>
              </select>
            </div>
          </div>
        </div>


        <h3 class="box-title">Kualitas Kegiatan</h3>
        <hr>

        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label class="control-label">Kualitas</label>
              <input name="kualitas_kegiatan" type="text" id="lastName" class="form-control" placeholder="">

            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label class="control-label">Satuan</label>

              <select name="id_satuan_kualitas" class="form-control">
                <option value="">Pilih Satuan</option>
                <?php 
                foreach($satuan as $s){
                  echo '<option value="'.$s->id_satuan.'">'.$s->satuan.'</option>';
                }
                ?>
              </select>
            </div>
          </div>
        </div>



        <h3 class="box-title">Waktu Kegiatan</h3>
        <hr>

        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label class="control-label">Waktu</label>
              <input type="text" name="waktu_kegiatan" id="lastName" class="form-control" placeholder="">

            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label class="control-label">Satuan</label>

              <select name="id_satuan_waktu" class="form-control">
                <option value="">Pilih Satuan</option>
                <?php 
                foreach($satuan as $s){
                  echo '<option value="'.$s->id_satuan.'">'.$s->satuan.'</option>';
                }
                ?>
              </select>
            </div>
          </div>
        </div>




        <h3 class="box-title">Biaya Kegiatan</h3>
        <hr>

        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label class="control-label">Biaya</label>
              <input type="text" name="biaya_kegiatan" id="lastName" class="form-control" placeholder="">

            </div>
          </div>
        </div>





      </div>
    </div>

  </div>
  <hr>
  <div class="form-actions pull-right">

    <button type="button" class="btn btn-default">Cancel</button>
    <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>

  </div>
</form>


</div>





</form> 
</div>
</div>
</div>
</div>
