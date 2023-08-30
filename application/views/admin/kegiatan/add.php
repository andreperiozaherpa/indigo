 <script type="text/javascript">
  function getKabupaten(){
    var id = $('#id_provinsi').val();
    $.post("<?=base_url()."/"?>kegiatan/get_kabupaten/"+id,{},function(obj){
      $('#id_kabupaten').html(obj);
    });
    
  }
  function getKecamatan(){
    var id = $('#id_kabupaten').val();
    $.post("<?=base_url()."/"?>kegiatan/get_kecamatan/"+id,{},function(obj){
      $('#id_kecamatan').html(obj);
    });
    
  }
  function getDesa(){
    var id = $('#id_kecamatan').val();
    $.post("<?=base_url()."/"?>kegiatan/get_desa/"+id,{},function(obj){
      $('#id_desa').html(obj);
    });
  }
</script>
<div class="container-fluid">

  <div class="row bg-title">
    <!-- .page title -->
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
      <h4 class="page-title">Tambah Target Kegiatan</h4>
    </div>
    <!-- /.page title -->
    <!-- .breadcrumb -->
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

      <ol class="breadcrumb">
        <li><a href="<?= base_url();?>/admin">Dashboard</a></li>
        <li><a href="<?= base_url();?>/kegiatan">Target Kegiatan</a></li>
        <li class="active">Tambah</li>
      </ol>
    </div>
    <!-- /.breadcrumb -->
  </div>
  <!-- /.row -->
  <div class="row">
    <div class="col-md-12">
      <?php if (!empty($message)) echo "
      <div class='alert alert-$message_type'>$message</div>";?>

      <div class="row">
       <form role="form" method='post' enctype="multipart/form-data">
        <div class="row">
          <div class="col-md-6 ">
            <div class="white-box">


              <div class="form-group">
                <label class="control-label">Unit Kerja</label>
                <select onchange="getSasaran()" name="id_unit_kerja" id="id_unit_kerja" class="form-control select2">
                  <option value="">Pilih Unit Kerja</option>
                  <?php 
                  foreach($unit_kerja as $u){
                    $selected = ($u->id_unit_kerja==$this->session->userdata('id_unit_kerja')) ? ' selected' : '';
                    echo '<option value="'.$u->id_unit_kerja.'"'.$selected.'>'.$u->nama_unit_kerja.'</option>';
                  }
                  ?>
                </select>
              </div>
              <div class="form-group">
                <label class="control-label">Berdasarkan IKU</label>
                <input type="checkbox" id="tIKU" class="js-switch" data-color="#6003c8" onchange="toggleIKU()" />
              </div>
              <div id="divIKU" style="display: none;background-color: #f1e7fe;padding: 15px 10px;margin-bottom: 10px;">
              <div class="form-group">
                <label class="control-label">Sasaran</label>
                <select onchange="getIKU()" name="id_sasaran" id="id_sasaran" class="form-control">
                  <option value="">Pilih Sasaran</option>
                  <?=$sasaran?>
                </select>
              </div>
              <input type="hidden" id="jenis_sasaran">
              <div class="form-group">
                <label class="control-label">IKU</label>
                <select onchange="getRenaksi()" name="id_iku" id="id_iku" class="form-control">
                  <option value="">Tidak ada IKU</option>
                </select>
              </div>
              <div class="form-group">
                <label class="control-label">Renaksi</label>
                <select name="id_renaksi" id="id_renaksi" class="form-control">
                  <option value="">Tidak ada Renaksi</option>
                </select>
              </div>
            </div>
              <div class="form-group">
                <label class="control-label">Nama Kegiatan</label>
                <input name="nama_kegiatan" type="text" id="firstName" class="form-control" placeholder="Masukkan Nama Kegiatan">
              </div>
              <div class="form-group">
                <label class="control-label">Dasar Hukum</label>
                <input name="dasar_hukum" type="text" id="firstName" class="form-control" placeholder="Masukkan Dasar Hukum">
              </div>

              <div class="form-group">
                <label class="control-label">Priotas</label>
                <select name="prioritas" class="form-control">
                  <option value="tinggi">Tinggi</option>
                  <option value="menengah">Menengah</option>
                  <option value="rendah">Rendah</option>
                </select>
              </div>
              <div class="form-group">
                <label class="control-label">Anggaran</label>
                <input name="anggaran_kegiatan" type="text" id="firstName" class="form-control" placeholder="Masukkan Anggaran">
              </div>

              <div class="form-group">
                <label class="control-label">Uraian Kegiatan</label>
                <textarea name="uraian_kegiatan" placeholder="Masukkan Uraian Kegiatan" class="form-control"></textarea>
              </div>

              <div class="form-group">
                <label class="control-label">File Pendukung</label>
                <input type="file" name='file' id="input-file-now-custom-3" class="dropify"  data-label="<i class='glyphicon glyphicon-file'></i> Browse"  data-height="100" />
              </div>

              <div class="form-group">
                <label class="control-label">Surat Perintah</label>
                <input type="file" name='surat_perintah' id="input-file-now-custom-3" class="dropify"  data-label="<i class='glyphicon glyphicon-file'></i> Browse" data-height="100" />
              </div>

              <div class="form-group">
                <label class="control-label">Detail Pekerjaan</label>
                <textarea name="detail_pekerjaan" placeholder="Masukkan Detail Pekerjaan" class="form-control"></textarea>
              </div>



              <div class="form-group">
                <label class="control-label">Status</label>
                <select name="status_kegiatan" class="form-control">
                  <option value="rahasia">Rahasia</option>
                  <option value="publik">Publik</option>
                </select>
              </div>


            </div>

          </div>

          <div class="col-md-6 ">

           <div class="row">
            <div class="col-md-12 white-box">
              <address>

                <h4 class="font-bold">TIM </h4>
                <hr>
                <div class="form-group">
                  <label class="control-label">Ketua Tim</label>
                  <select onchange="eventKetua()" id="id_ketua_tim" name="id_ketua_tim" class="form-control select2">
                   <option value="">Pilih Ketua Tim</option>
                   <?php foreach ($pegawai as $key): ?>
                    <option value="<?php echo $key->id_pegawai ?>"><?php echo $key->nama_lengkap.' - '.$key->nama_unit_kerja ?></option>
                  <?php endforeach ?>
                </select>
              </div>

              <div id="divAnggota" style="display: none" class="form-group">
                <label class="control-label">Detail Pekerjaan</label>
                <table id="tableAnggota" class="table table-stripped">
                  
                  <tbody>
                  </tbody>
                </table>
                <a href="javascript:void(0)" id="btnAdd" onclick="addAnggota(0)" class="btn btn-primary btn-sm">Tambah Pekerjaan</a>
              </div>




            </address>
          </div>
        </div>

        <div class="row">
          <div class="col-md-12 white-box">
           <div class="row">
            <h4 class="font-bold">Tanggal Kegiatan </h4>
            <hr>
            <div class="col-md-6">
             <div class="form-group">
               <label class="control-label">Tgl. Mulai</label>
               <input name="tgl_mulai_kegiatan" type="text" class="form-control mydatepicker" placeholder="mm/dd/yyyy">
               <span class="input-group-addon"><i class="icon-calender"></i></span> 
             </div>
           </div>

           <div class="col-md-6">
            <div class="form-group">
             <label class="control-label">Tgl. Akhir</label>
             <input name="tgl_akhir_kegiatan" type="text" class="form-control mydatepicker" placeholder="mm/dd/yyyy">
             <span class="input-group-addon"><i class="icon-calender"></i></span> 
           </div>
         </div>

       </div>
     </div>
   </div>
   <div class="row">
    <div class="col-md-12 white-box">
      <div class="row">
        <h4 class="font-bold">Lokasi Kegiatan </h4>
        <hr>
        <div class="col-md-12">
         <div class="form-group">
          <label class="control-label">Nama Lokasi</label>
          <input name="nama_lokasi" type="text" placeholder="Masukkan Nama Lokasi" class="form-control">
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label class="control-label">Provinsi</label>
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
        <label class="control-label">Kabupaten</label>
        <select name="id_kabupaten_kegiatan" onchange="getKecamatan()" id="id_kabupaten" class="form-control ">
          <option value="">Pilih Kabupaten</option>
        </select>
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label class="control-label">Kecamatan</label>
        <select name="id_kecamatan_kegiatan" onchange="getDesa()" id="id_kecamatan" class="form-control ">
          <option value="">Pilih Kecamatan</option>
        </select>
      </div>
    </div>

    <div class="col-md-6">
     <div class="form-group">
      <label class="control-label">Desa</label>
      <select name="id_desa_kegiatan" id="id_desa" class="form-control ">
        <option value="">Pilih Desa</option>
      </select>
    </div>
  </div>

</div>
</div>
</div>





</div>

<div class="col-md-12">
  <div class="pull-right m-t-30 text-right">

  </div>
  <div class="clearfix"></div>
  
  <div class="text-right">
    <a href="<?php echo base_url('kegiatan/'); ?>" class="btn btn-default"> Batal</a>
    <button class="btn btn-primary" type="submit"> Simpan</button>

  </div>
</div>
</div>
</form>
</div>
<script type="text/javascript">
  var daftar_pegawai = ' <?php foreach ($pegawai as $key): ?> <option value="<?php echo $key->id_pegawai ?>"><?php echo $key->nama_lengkap.' - '.$key->nama_unit_kerja ?></option> <?php endforeach ?>';
  function addAnggota(no){
    var i = no; i++;     
    $("#btnAdd").attr("onclick", "addAnggota('"+i+"')"); 

    var $tableBody = $('#tableAnggota').find("tbody");

    $tableBody.append('<tr><td><b>Uraian Pekerjaan</b> <textarea name="uraian_pekerjaan[]" class="form-control uraian_pekerjaan"></textarea><br><b>Disposisi</b> <select id="'+i+'" class="select2 m-b-10 select2-multiple" name="id_user'+i+'[]" multiple="multiple" data-placeholder="Pilih Pegawai">'+daftar_pegawai+' </select> </td><td><br><button type="button" class="del-anggota btn btn-danger btn-sm"><i class="fa fa-trash"></i></button></td></tr>');

    $('#'+i).select2();
  }
  function eventKetua(){
    if($('#id_ketua_tim').val()!=''){
      $('#divAnggota').show();
    }else{
      $('#divAnggota').hide();
    }
  }
  function getSasaran(){
    var id = $('#id_unit_kerja').val();
    $.post("<?=base_url('kegiatan/get_sasaran/')?>/"+id,{},function(obj){
      $('#id_sasaran').html(obj);
    });  
  }
  function getIKU(){
    var id = $('#id_unit_kerja').val();
    var s = $('#id_sasaran').val();
    var sid = s.split("_");
    var jenis = sid[0];
    var id_s = sid[1];

    $.post("<?=base_url('kegiatan/get_iku/')?>/"+id_s+"/"+id+"/"+jenis,{},function(obj){
      $('#id_iku').html(obj);
    });  
  }
  function getRenaksi(){
    var id = $('#id_iku').val();

    var s = $('#id_sasaran').val();
    var sid = s.split("_");
    var jenis = sid[0];

    $.post("<?=base_url('kegiatan/get_renaksi_by_id_iku/')?>/"+id+"/"+jenis,{},function(obj){
      $('#id_renaksi').html(obj);
    });  
  }

  function toggleIKU(){
    var tIku = $('#tIKU').prop('checked');
    if(tIku==true){
      $('#divIKU').show();
    }else{
      $('#divIKU').hide();
    }
  }
</script>