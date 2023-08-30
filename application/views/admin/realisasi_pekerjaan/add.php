<script type="text/javascript">
  function getKabupaten(){
    var id = $('#id_provinsi').val();
    $.post("<?=base_url()."/"?>realisasi_pekerjaan/get_kabupaten/"+id,{},function(obj){
      $('#id_kabupaten').html(obj);
    });
    
  }
  function getKecamatan(){
    var id = $('#id_kabupaten').val();
    $.post("<?=base_url()."/"?>realisasi_pekerjaan/get_kecamatan/"+id,{},function(obj){
      $('#id_kecamatan').html(obj);
    });
    
  }
  function getDesa(){
    var id = $('#id_kecamatan').val();
    $.post("<?=base_url()."/"?>realisasi_pekerjaan/get_desa/"+id,{},function(obj){
      $('#id_desa').html(obj);
    });
  }

  function getKegiatan(){
    var id = $('#id_pekerjaan').val();
    $.post("<?=base_url()."/"?>realisasi_pekerjaan/get_kegiatan/"+id,{},function(obj){
      $('#id_kegiatan').html(obj);
    });
  }

  function getDetailKegiatan(){
    var id = $('#id_kegiatan').val();
    $.ajax({
      url : "<?=base_url()."/"?>realisasi_pekerjaan/get_detail_kegiatan/" + id,
      type: "GET",
      dataType: "JSON",
      success: function(data)
      {
        $('#angka_kredit').val(data.angka_kredit);
        $('#uraian_kegiatan').text(data.uraian_kegiatan);
        $('#tgl_mulai_kegiatan').val(data.tgl_mulai_kegiatan);
        $('#tgl_akhir_kegiatan').val(data.tgl_akhir_kegiatan);
        $('#nama_lokasi').val(data.nama_lokasi);
        $('#kuantitas_kegiatan').val(data.kuantitas_kegiatan);
        $('#kualitas_kegiatan').val(data.kualitas_kegiatan);
        $('#waktu_kegiatan').val(data.waktu_kegiatan);
        $('#id_satuan_kuantitas').val(data.satuan_kuantitas);
        $('#id_satuan_kualitas').val(data.satuan_kualitas);
        $('#id_satuan_waktu').val(data.satuan_waktu);
        $('#biaya_kegiatan').val(data.biaya_kegiatan);
        $('#provinsi').val(data.provinsi);
        $('#kabupaten').val(data.kabupaten);
        $('#kecamatan').val(data.kecamatan);
        $('#desa').val(data.desa);
        getTimeline();
      }
    });
  }

  function getTimeline(){
    var id = $('#id_kegiatan').val();
    $.post("<?=base_url()."/"?>realisasi_pekerjaan/get_timeline/"+id,{},function(obj){
      $('#timeline').html(obj);
    });
  }
</script>
<div class="col-md-12 col-sm-12 col-xs-12">
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

                      <select id="id_pekerjaan" onchange="getKegiatan()" name="id_pekerjaan" class="form-control">
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
                      <select onchange="getDetailKegiatan()" name="id_kegiatan" id="id_kegiatan" class="form-control">
                        <option value="">Pilih Kegiatan</option>

                      </select>
                    </div>
                  </div>
                  <!--/span-->

                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="control-label">Angka Kredit </label>
                      <input type="text" id="angka_kredit" class="form-control" placeholder="" disabled>
                    </div>
                  </div> 

                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="control-label">Uraian Kegiatan / Keterangan </label>
                      <textarea class="form-control" id="uraian_kegiatan" disabled></textarea>
                    </div>
                  </div> 


                  <h3 class="box-title">Tanggal Kegiatan</h3>
                  <hr>

                  <div class="row">
                   <div class="col-md-6">
                    <div class="form-group">
                      <label class="control-label">Tanggal Mulai </label>
                      <input type="date" id="tgl_mulai_kegiatan" class="form-control mydatepicker" placeholder="" disabled="">
                    </div>
                  </div> 

                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="control-label">Tanggal Akhir </label>
                      <input type="date" id="tgl_akhir_kegiatan" class="form-control mydatepicker" placeholder="" disabled="">
                    </div>
                  </div> 
                </div>



                <h3 class="box-title">Lokasi Kegiatan</h3>
                <hr>

                <div class="row">
                 <div class="col-md-12">
                  <div class="form-group">
                    <label class="control-label">Nama Lokasi </label>
                    <input type="text" id="nama_lokasi" class="form-control" placeholder="" disabled>
                  </div>
                </div> 

                <div class="col-md-6">
                  <div class="form-group">
                    <label class="control-label">Provinsi </label>
                    <input type="text" id="provinsi" class="form-control" placeholder="" disabled>
                  </div>
                </div> 


                <div class="col-md-6">
                  <div class="form-group">
                    <label class="control-label">Kabupaten / Kota </label>
                    <input type="text" id="kabupaten" class="form-control" placeholder="" disabled>
                  </div>
                </div> 


                <div class="col-md-6">
                  <div class="form-group">
                    <label class="control-label">Kecamatan  </label>
                    <input type="text" id="kecamatan" class="form-control" placeholder="" disabled>
                  </div>
                </div> 


                <div class="col-md-6">
                  <div class="form-group">
                    <label class="control-label">Desa / Kelurahan  </label>
                    <input type="text" id="desa" class="form-control" placeholder="" disabled>
                  </div>
                </div> 
              </div>


            </div>
          </div>
        </div>
      </div>

      <!--panel kanan -->

      <div class="col-md-6">
       <div class="panel-body">
        <div class="form-body">

          <h3 class="box-title" >Kuantitas Kegiatan</h3>
          <hr>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label class="control-label">Kuantitas</label>
                <input type="text" id="kuantitas_kegiatan" class="form-control" placeholder="" disabled>

              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label class="control-label">Satuan</label>
                <input type="text" id="id_satuan_kuantitas" class="form-control" placeholder="" disabled>
              </div>
            </div>
          </div>


          <h3 class="box-title">Kualitas Kegiatan</h3>
          <hr>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label class="control-label">Kualitas</label>
                <input type="text" id="kualitas_kegiatan" class="form-control" placeholder="" disabled>

              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label class="control-label">Satuan</label>
                <input type="text" id="id_satuan_kualitas" class="form-control" placeholder="" disabled>
              </div>
            </div>
          </div>



          <h3 class="box-title">Waktu Kegiatan</h3>
          <hr>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label class="control-label">Waktu</label>
                <input type="text" id="waktu_kegiatan" class="form-control" placeholder="" disabled>

              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label class="control-label">Satuan</label>
                <input type="text" id="id_satuan_waktu" class="form-control" placeholder="" disabled>
              </div>
            </div>
          </div>




          <h3 class="box-title">Biaya Kegiatan</h3>
          <hr>

          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label class="control-label">Biaya</label>
                <input type="text" id="biaya_kegiatan" class="form-control" placeholder="" value="" disabled>

              </div>
            </div>
          </div>





        </div>
      </div>

    </div>

  </form>


</div>

<hr>


<button  type="button" class="btn btn-success" onclick="addRealisasi()"> Tambah Realisasi</button>

<hr>


<!--modal -->


<div class="modal fade bs-example-modal-lg" id="modalRealisasi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title" id="exampleModalLabel1">Realisasi Target Kegiatan</h3>
      </div>
      <div class="modal-body">
        <form class="" id="formRealisasi" method="post" >
          <div class="row">
            <div class="col-md-12">
              <div id="message"></div>
              <div id="hidden"></div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label class="control-label">Nama Kegiatan</label>
                <input type="text" name="nama_kegiatan_realisasi" class="form-control" placeholder="">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label class="control-label">Kuantitas</label>
                <input type="text" name="kuantitas_realisasi" class="form-control" placeholder="">

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





          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label class="control-label">Kualitas</label>
                <input type="text" name="kualitas_realisasi" class="form-control" placeholder="">

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




          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label class="control-label">Waktu</label>
                <input type="text" name="waktu_realisasi" class="form-control" placeholder="">

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

          <hr>

          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label class="control-label">Biaya</label>
                <input type="text" name="biaya_realisasi" class="form-control" placeholder="">

              </div>
            </div>
          </div>

          <h3 class="box-title">Detail Kegiatan</h3>
          <hr>

          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label class="control-label">Tanggal kegiatan</label>
                <input type="text" name="tgl_kegiatan_realisasi" class="form-control mydatepicker"  placeholder="">

              </div>
            </div>
          </div>
          <hr>

          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label class="control-label">File Pendukung</label>
                <input type="file" name="file" id="input-file-now" class="dropify" />

              </div>
            </div>
          </div>
          <hr>

          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label class="control-label">Uraian</label>
                <textarea name="uraian_realisasi" class="form-control"></textarea>

              </div>
            </div>
          </div>
          <h3 class="box-title">Lokasi Kegiatan</h3>
          <hr>

          <div class="row">
           <div class="col-md-12">
            <div class="form-group">
              <label class="control-label">Nama Lokasi </label>
              <input type="text" name="nama_lokasi_realisasi" class="form-control" placeholder="" >
            </div>
          </div> 

          <div class="col-md-6">
            <div class="form-group">
              <label class="control-label">Provinsi </label>
              <select name="id_provinsi_realisasi" onchange="getKabupaten()" id="id_provinsi" class="form-control ">
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
              <select name="id_kabupaten_realisasi" onchange="getKecamatan()" id="id_kabupaten" class="form-control ">
                <option value="">Pilih Kabupaten</option>
              </select>
            </div>
          </div> 


          <div class="col-md-6">
            <div class="form-group">
              <label class="control-label">Kecamatan  </label>
              <select name="id_kecamatan_realisasi" onchange="getDesa()" id="id_kecamatan" class="form-control ">
                <option value="">Pilih Kecamatan</option>
              </select>
            </div>
          </div> 


          <div class="col-md-6">
            <div class="form-group">
              <label class="control-label">Desa / Kelurahan  </label>
              <select name="id_desa_realisasi" id="id_desa" class="form-control ">
                <option value="">Pilih Desa</option>
              </select>
            </div>
          </div> 
        </div>





      </form> 
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      <button type="button" id="btnSave" onclick="simpanRealisasi()" class="btn btn-success">Simpan</button>
    </div>
  </div>
</div>
</div>











<!-- Timeline -->
<div class="row">
  <div class="col-md-12">
    <div class="white-box">
      <ul class="timeline" id="timeline">

      </ul>
    </div>
  </div>
</div>
</div>
</div>
</div>
</div>


<script type="text/javascript">

  var save_method;

  function addRealisasi(){
    save_method = 'add';
    $('#formRealisasi')[0].reset(); 
    $('#message').html(''); 
    $('#modalRealisasi').modal('show'); 
    $('.modal-title').text('Tambah Realisasi Kegiatan'); 
  }

  function editRealisasi(id){
    save_method = 'update';
    $('#formRealisasi')[0].reset(); 
    $('#message').html(''); 
    $('.form-group').removeClass('has-error');
    $('#hidden').html('<input type="hidden" value="" name="id_realisasi_pekerjaan"/>');
    $('.help-block').empty(); 
    $.ajax({
      url : "<?php echo base_url('realisasi_pekerjaan/fetch_realisasi/')?>/" + id,
      type: "GET",
      dataType: "JSON",
      success: function(data)
      {
        $('[name="id_realisasi_pekerjaan"]').val(data.id_realisasi_pekerjaan);
        $('[name="nama_kegiatan_realisasi"]').val(data.nama_kegiatan_realisasi);
        $('[name="kuantitas_realisasi"]').val(data.kuantitas_realisasi);
        $('[name="id_satuan_kuantitas"]').val(data.id_satuan_kuantitas);
        $('[name="kualitas_realisasi"]').val(data.kualitas_realisasi);
        $('[name="id_satuan_kualitas"]').val(data.id_satuan_kualitas);
        $('[name="waktu_realisasi"]').val(data.waktu_realisasi);
        $('[name="id_satuan_waktu"]').val(data.id_satuan_waktu);
        $('[name="biaya_realisasi"]').val(data.biaya_realisasi);
        $('[name="tgl_kegiatan_realisasi"]').val(data.tgl_kegiatan_realisasi);
        $('[name="uraian_realisasi"]').val(data.uraian_realisasi);
        $('[name="nama_lokasi_realisasi"]').val(data.nama_lokasi_realisasi);
        $('[name="id_provinsi_realisasi"]').val(data.id_provinsi_realisasi);
        $('[name="id_kabupaten_realisasi"]').html('<option value="'+data.id_kabupaten_realisasi+'">'+data.kabupaten+'</option>');
        $('[name="id_kecamatan_realisasi"]').html('<option value="'+data.id_kecamatan_realisasi+'">'+data.kecamatan+'</option>');
        $('[name="id_desa_realisasi"]').html('<option value="'+data.id_desa_realisasi+'">'+data.desa+'</option>');
        // var imagenUrl = '<?=base_url('data/realisasi_pekerjaan/')?>/'+data.file_pendukung;
        var drEvent = $('[name="file"]').dropify();
        drEvent = drEvent.data('dropify');
        drEvent.resetPreview();
        drEvent.clearElement();
        if(data.file_jurnal!==''){
          drEvent.settings.defaultFile = '<?=base_url('data/realisasi_pekerjaan/')?>/'+data.file_pendukung;
        }else{
          drEvent.settings.defaultFile = '';
        }
        drEvent.destroy();
        drEvent.init();
        $('#modalRealisasi').modal('show'); 
        $('.modal-title').text('Ubah Realisasi Kegiatan'); 

      },
      error: function (jqXHR, textStatus, errorThrown)
      {
        alert("Gagal mendapatkan data");
      }
    });

  }
  function simpanRealisasi()
  {
    $('#btnSave').text('Menyimpan...'); 
    $('#message').html(''); 
    $('#btnSave').attr('disabled',true); 
    var url;
    var formData = new FormData($('#formRealisasi')[0]);
    formData.append('file', $('input[type=file]')[0].files[0]); 
    formData.append('id_target_pekerjaan', $('#id_kegiatan').val()); 
    if(save_method == 'add') {
      url = "<?php echo base_url('realisasi_pekerjaan/p_add')?>";
    } else {
      url = "<?php echo base_url('realisasi_pekerjaan/p_update')?>";
    }

    $.ajax({
      url : url,
      type: "POST",
      data: formData,
      contentType: false,          
      processData:false, 
      dataType: "JSON",
      success: function(data)
      {

        if(data.status) 
        {
          $('#modalRealisasi').modal('hide');
          swal("Berhasil", "Data Berhasil Disimpan!", "success");
        }else{
          $('#message').html('<div class="alert alert-danger">'+data.message+'</div>'); 
        }
        $('#btnSave').text('Simpan'); 
        $('#btnSave').attr('disabled',false); 
        getTimeline();


      },
      error: function (jqXHR, textStatus, errorThrown)
      {
        alert('Error adding / update data');
        $('#btnSave').text('Simpan'); 
        $('#btnSave').attr('disabled',false); 

      }
    });
  }
  function deleteRealisasi(id){
   swal({
    title: "Hapus Data",
    text: "Apakah anda yakin akan menghapus data ini?",
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: '#DD6B55',
    confirmButtonText: 'Ya',
    cancelButtonText: "Tidak",
    closeOnConfirm: false
  },
  function(isConfirm){
    if (isConfirm){
      $.ajax({
        url : "<?php echo base_url('realisasi_pekerjaan/delete')?>/"+id,
        type: "POST",
        dataType: "JSON",
        success: function(data)
        {
          $('#modal_form').modal('hide');
          swal("Berhasil", "Data Berhasil Dihapus!", "success");
          getTimeline();
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
          alert('Error deleting data');
        }
      });
    }
  });
 }
</script>