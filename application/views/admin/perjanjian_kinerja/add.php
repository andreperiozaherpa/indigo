 <div class="container-fluid">

  <div class="row bg-title">
    <!-- .page title -->
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
      <h4 class="page-title">Perjanjian Kinerja</h4>
    </div>
    <!-- /.page title -->
    <!-- .breadcrumb -->
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

      <ol class="breadcrumb">
        <li><a href="<?= base_url();?>admin">Dashboard</a></li>
        <li><a href="<?= base_url();?>admin">Perjanjian Kinerja</a></li>
        <li class="active">Add</li>
      </ol>
    </div>
    <!-- /.breadcrumb -->
  </div>
  <!-- .row -->
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="white-box">
      <div class="x_title">
        <!-- <h2>Tambah Ref. kode_kegiatan</h2> -->
        <ul class="nav navbar-right panel_toolbox">
          <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
          </li>

        </ul>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">

       <div class="row">
        <div class="col-md-8">
          <div class="media m-b-30 p-t-20">
            <h4 class="font-bold m-t-0">Pihak Perjanjian Kinerja</h4>
            <div class="media-body">
            </div>
          </div>
          <form class="form-horizontal" method="post">
            <div class="row">
              <div class="col-md-3">
                <div class="form-group">
                  <label class="col-md-12">Tahun</label>
                  <div class="col-md-12">
                    <select onchange="getJabatan()" name="tahun_rkt"  id="tahun_rkt" class="form-control">
                      <option value="">Pilih Tahun</option>
                      <?php 
                      foreach($tahun as $r){
                        echo'<option value="'.$r->tahun_rkt.'">'.$r->tahun_rkt.'</option>';
                      }
                      ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-md-9">
                <div class="form-group">
                  <label class="col-md-12">Unit Kerja</label>
                  <div class="col-md-12">
                    <select onchange="getJabatan()"  name="id_unit" id="id_unit" class="form-control select2">
                      <option value="">Pilih Unit Kerja</option>
              <?php 
              foreach($unit_kerja as $r){
                if($user_level=='Administrator'){
                    echo'<option value="'.$r->id_unit_kerja.'">'.$r->nama_unit_kerja.'</option>';
                }else{
                  if($r->id_unit_kerja==$this->session->userdata('unit_kerja_id')){
                    echo'<option value="'.$r->id_unit_kerja.'">'.$r->nama_unit_kerja.'</option>';
                  }
                }
              }
              ?>
                    </select>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label class="col-md-12">Jabatan</label>
                  <div class="col-md-12">
                    <!-- <select onchange="getPegawai()" name="id_jabatan" id="jabatan" class="form-control select2">
                      <option value="">Pilih Jabatan</option>
                    </select> -->
                    <input type="text" name="" id="jabatan" class="form-control" disabled="" value="Nama Jabatan ">
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label class="col-md-12">Nama Pemegang Jabatan</label>
                  <div class="col-md-12">
                    <input type="text" name="" id="nama" class="form-control" disabled="" value="Nama Pemegang Jabatan ">
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label class="col-md-12">Jabatan Atasan</label>
                  <div class="col-md-12">
                    <input type="text" name="" id="jabatan_a" class="form-control" disabled="" value="Nama Jabatan ">
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label class="col-md-12">Nama Pemegang Jabatan</label>
                  <div class="col-md-12">
                    <input type="text" name="" id="nama_a" class="form-control" disabled="" value="Nama Pemegang Jabatan ">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </form> 
    </div>
  </div>
</div>  
<div class="col-md-12 col-sm-12 col-xs-12">
  <div class="white-box">
    <div class="x_title">
      <!-- <h2>Tambah Ref. kode_kegiatan</h2> -->
      <ul class="nav navbar-right panel_toolbox">
        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
        </li>

      </ul>
      <div class="clearfix"></div>
    </div>
    <div class="x_content">

     <div class="row">
      <div class="col-md-8">   
        <div class="media m-b-30 p-t-20">
          <h4 class="font-bold m-t-0">Sasaran Strategis</h4>
          <div class="media-body">
          </div>
        </div>

        <table class="table">
          <thead>
            <tr>
             <th>No.</th>
             <th>Sasaran Strategis</th>
             <th>Indikator Kerja Utama</th>
             <th>Target</th> 
           </tr> 
         </thead>
         <tbody id="ss">
          <tr>
            <td colspan="4"><center>Tidak Ada Data.</center></td>
          </tr>
        </tbody>

      </table>

    </div>
  </div>
</div>
</div>
</div>
<div class="col-md-12 col-sm-12 col-xs-12">
  <div class="white-box">
    <div class="x_title">
      <!-- <h2>Tambah Ref. kode_kegiatan</h2> -->
      <ul class="nav navbar-right panel_toolbox">
        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
        </li>

      </ul>
      <div class="clearfix"></div>
    </div>
    <div class="x_content">

     <div class="row">
      <div class="col-md-8">   
        <div class="media m-b-30 p-t-20">
          <h4 class="font-bold m-t-0">Program & Kegiatan</h4>
          <div class="media-body">
          </div>
        </div>

        <table class="table">
          <thead>
            <tr>
             <th>Kode.</th>
             <th>Program / Kegiatan</th>
             <th>Pagu</th>
           </tr> 
         </thead>
         <tbody id="rka">
          <tr>
            <td colspan="4"><center>Tidak Ada Data.</center></td>
          </tr>
        </tbody>
      </table>

    </div>
  </div>
</div>
</div>
</div>
<div class="col-md-8">
  <div class="form-group">
    <div class="col-md-12">
     <div class="pull-right">
       <a href="" class="btn btn-default waves-effect waves-light">Batal</a>
       <a href="#!" id="button-upload" onclick="" class="btn btn-success waves-effect waves-light hide" ><i class="fa fa-upload"></i> Unggah</a>
       <a href="#!" id="button-download" target="_blank" class="btn btn-info waves-effect waves-light hide"><i class="fa fa-download"></i> Unduh PK</a>
       <a href="#!" id="button-template" target="_blank" class="btn btn-primary waves-effect waves-light hide"><i class="fa fa-file"></i> Unduh Template</a>
     </div>
   </div>
 </div>
</div>
                <!-- sample modal content -->
                <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <h4 class="modal-title" id="myModalLabel">Modal Heading</h4>
                            </div>
                          <form id="form-upload" method="POST" enctype="multipart/form-data" >
                            <div class="modal-body">
                                <div class="form-group">
                    <label class="control-label">Unggah Berkas</label>
                    <input type="file" name='userfile' id="input-file-now-custom-3" class="dropify" data-label="<i class='glyphicon glyphicon-file'></i> Browse" />
                  </div>
                            </div>
                            <div class="modal-footer">
                              <button type="submit" class="btn btn-primary ">Simpan</button>
                                <button type="button" class="btn btn-info waves-effect" data-dismiss="modal">Close</button>
                            </div>
                          </form>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->

<script type="text/javascript">
  var hide_template;
  function getJabatan(){
    var tahun_rkt = $('#tahun_rkt').val();
    var id_unit = $('#id_unit').val();
    $.post('<?=base_url()."perjanjian_kinerja/get_jabatan"?>', {id_unit:id_unit}, function(data){ 
      data = JSON.parse(data);
      // $('#jabatan').html(data); 
      // $("#jabatan").select2("destroy");
      // $("#jabatan").select2();
      $('#jabatan').val(data.nama_jabatan);
      $('#nama').val(data.nama_pegawai);
      $('#jabatan_a').val(data.nama_jabatan_a);
      $('#nama_a').val(data.nama_pegawai_a);
      if (data.nama_jabatan.indexOf('[ERROR]:') > -1 || data.nama_pegawai.indexOf('[ERROR]:') > -1 || data.nama_jabatan_a.indexOf('[ERROR]:') > -1 || data.nama_pegawai_a.indexOf('[ERROR]:') > -1)
      {
        hide_template = true;
      } else {
        hide_template = false;
      }
      if (tahun_rkt && id_unit && hide_template==false) {
        $('#button-template').attr('href', "<?=base_url('perjanjian_kinerja/download_pk')?>/"+tahun_rkt+"/"+id_unit);
        $('#button-template').removeClass('hide');
      } else {
        $('#button-template').attr('href', "#!");
        $('#button-template').addClass('hide');
      }
    });
    $.post('<?=base_url()."perjanjian_kinerja/get_rka/"?>'+id_unit, {id_unit:id_unit}, function(data){ 
      $('#rka').html(data); 
    });
    $.post('<?=base_url()."perjanjian_kinerja/get_sasaran/"?>'+id_unit, {id_unit:id_unit,tahun_rkt:tahun_rkt}, function(data){ 
      $('#ss').html(data); 
    });
    $.post('<?=base_url()."perjanjian_kinerja/get_pk/"?>'+id_unit, {id_unit:id_unit,tahun_rkt:tahun_rkt}, function(data){ 
      data = JSON.parse(data);
      if (data.method == 'exist' && tahun_rkt && id_unit && hide_template==false) {
        $('#button-upload').attr('onclick', "upload_berkas('"+data.id_berkas+"','pk');");
        $('#button-upload').removeClass('hide');
        if (data.pk) {
          $('#button-download').attr('href', "<?=base_url('data/berkas_unit_kerja')?>/"+data.pk);
          $('#button-download').removeClass('hide');
        } else {
          $('#button-download').attr('href', "#!");
          $('#button-download').addClass('hide');
        }
      } else if (data.method == 'new' && tahun_rkt && id_unit && hide_template==false) {
        $('#button-upload').attr('onclick', "upload_berkas('"+data.method+"','pk');");
        $('#button-upload').removeClass('hide');
        $('#button-download').attr('href', "#!");
        $('#button-download').addClass('hide');
      } else {
        $('#button-upload').attr('onclick', "");
        $('#button-upload').addClass('hide');
        $('#button-download').attr('href', "#!");
        $('#button-download').addClass('hide');
        //alert("error getting PK data");
      }
    });
  }
  function getPegawai(){
    var jabatan = $('#jabatan').val();
    $.post('<?=base_url()."perjanjian_kinerja/get_pegawai"?>', {id_jabatan:jabatan}, function(data){ 
      data = JSON.parse(data);
      $('#nama').val(data.nama_pegawai); 
    });
  }

  function upload_berkas(id,col) {
    $('#myModal').modal();
    $('#myModalLabel').text('Unggah Berkas Perjanjian Kinerja');
    var col = "pk";
    var tahun_rkt = $('#tahun_rkt').val();
    var id_unit = $('#id_unit').val();
    if (id) {
      $('#form-upload').attr('action',"<?=base_url().'perjanjian_kinerja/upload_berkas/'?>"+id+"/"+col+"/"+id_unit+"/"+tahun_rkt);
    } else {
      $('#form-upload').attr('action',"");
    }
  }
</script>