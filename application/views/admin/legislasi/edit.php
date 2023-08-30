<script type="text/javascript">
   function getKabupaten() {
     var id = $('#id_provinsi').val();
     $.post("<?= base_url() . "/" ?>kegiatan/get_kabupaten/" + id, {}, function(obj) {
       $('#id_kabupaten').html(obj);
     });

   }

   function getKecamatan() {
     var id = $('#id_kabupaten').val();
     $.post("<?= base_url() . "/" ?>kegiatan/get_kecamatan/" + id, {}, function(obj) {
       $('#id_kecamatan').html(obj);
     });

   }

   function getDesa() {
     var id = $('#id_kecamatan').val();
     $.post("<?= base_url() . "/" ?>kegiatan/get_desa/" + id, {}, function(obj) {
       $('#id_desa').html(obj);
     });
   }
 </script>
 <div class="container-fluid">

   <div class="row bg-title">
     <!-- .page title -->
     <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
       <h4 class="page-title">Edit Legislasi</h4>
     </div>
     <!-- /.page title -->
     <!-- .breadcrumb -->
     <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

       <ol class="breadcrumb">
         <li><a href="<?= base_url(); ?>/admin">Dashboard</a></li>
         <li><a href="<?= base_url(); ?>/kegiatan">Legislasi</a></li>
         <li class="active">Edit</li>
       </ol>
     </div>
     <!-- /.breadcrumb -->
   </div>
   <!-- /.row -->
   <div class="row">
     <div class="col-md-12">
       <?php if (!empty($message)) echo "
      <div class='alert alert-$message_type'>$message</div>"; ?>

       <div class="row">
         <?=form_open_multipart()?>
           <div class="row">
             <div class="col-md-6 ">
               <div class="white-box">
                 <div class="form-group">
                   <label class="control-label">Tema / Judul</label>
                   <input name="judul" value="<?=$detail->judul?>" type="text" id="firstName" class="form-control" placeholder="Masukkan Tema / Judul">
                 </div>
                 <div class="form-group">
                   <label class="control-label">Tanggal Pelaksanaan</label>
                   <input name="tanggal_pelaksanaan" value="<?=$detail->tanggal_pelaksanaan?>" autocomplete="off" type="text" id="firstName" class="form-control mydatepicker" placeholder="Masukkan Tanggal Pelaksanaan">
                 </div>
                 <div class="form-group">
                   <label class="control-label">Laporan Singkat / Notulensi</label>
                   <textarea name="laporan_singkat" placeholder="Masukkan Uraian Kegiatan" class="form-control"><?=$detail->laporan_singkat?></textarea>
                 </div>
                 <div class="form-group">
                   <label class="control-label">Rekomendasi</label>
                   <textarea name="rekomendasi" placeholder="Masukkan Uraian Kegiatan" class="form-control"><?=$detail->rekomendasi?></textarea>
                 </div>
                 <div class="form-group">
                   <label class="control-label">File Pendukung</label>
                   <input type="file" class="dropify" name="file_pendukung" data-default-file="<?=base_url('data/legislasi/'.$detail->file_pendukung)?>"/>
                 </div>
                 <div class="form-group">
                   <label class="control-label">Status</label>
                   <select name="status" class="form-control">
                     <option value="rahasia"<?=$detail->status=='rahasia'? ' selected' : null?>>Rahasia</option>
                     <option value="publik"<?=$detail->status=='publik'? ' selected' : null?>>Publik</option>
                   </select>
                 </div>
               </div>

             </div>

             <div class="col-md-6 ">

               <div class="row">
                 <div class="col-md-12 white-box">
                   <address>

                     <h4 class="font-bold">PANITIA KHUSUS </h4>
                     <hr>
                     <div class="form-group">
                       <label class="control-label">Ketua Pansus</label>
                       <select onchange="eventKetua()" id="id_ketua_tim" name="id_pegawai_ketua" class="form-control select2">
                         <option value="">Pilih Ketua Pansus</option>
                         <?php foreach ($pegawai as $key){
                            $selected = $key->id_pegawai == $detail->id_pegawai_ketua ? ' selected' : null;
                           ?>
                           <option value="<?php echo $key->id_pegawai ?>"<?=$selected?>><?php echo $key->nama_lengkap . ' - ' . $key->nama_unit_kerja ?></option>
                         <?php } ?>
                       </select>
                     </div>

                     <div id="divAnggota" class="form-group">
                       <label class="control-label">Anggota</label>
                       <table id="tableAnggota" class="table table-stripped">
                         <tbody>
                           <?php 
                            foreach($anggota as $a){
                              ?>
                              
                           <tr>
                             <td><select name="id_anggota[]" class="form-control select2">
                                 <option value="">Pilih Anggota</option>
                                 <?php 
                                  foreach($pegawai as $p){
                                    $selected = $p->id_pegawai == $a->id_pegawai ? ' selected' : null;
                                    echo '<option value="'.$p->id_pegawai.'"'.$selected.'>'.$p->nama_lengkap.'</option>';
                                  }
                                 ?>
                               </select></td>
                               
                             <td>
                               <input type="text" class="form-control" value="<?=$a->jabatan?>" name="jabatan[]" placeholder="Masukkan Jabatan"/>
                             </td>
                           </tr>
                              <?php
                            }
                           ?>
                           <tr>
                             <td><select name="id_anggota[]" class="form-control select2">
                                 <option value="">Pilih Anggota</option>
                                 <?php 
                                  foreach($pegawai as $p){
                                    echo '<option value="'.$p->id_pegawai.'">'.$p->nama_lengkap.'</option>';
                                  }
                                 ?>
                               </select></td>
                               
                             <td>
                               <input type="text" class="form-control" name="jabatan[]" placeholder="Masukkan Jabatan"/>
                             </td>
                           </tr>
                         </tbody>
                       </table>
                       <a href="javascript:void(0)" id="btnAdd" onclick="addAnggota(0)" class="btn btn-primary btn-sm">Tambah Anggota</a>
                     </div>


                   </address>
                 </div>
               </div>
             </div>

             <div class="col-md-12">
               <div class="pull-right m-t-30 text-right">

               </div>
               <div class="clearfix"></div>

               <div class="text-right">
                 <a href="<?php echo base_url('legislasi/'); ?>" class="btn btn-default"> Batal</a>
                 <button class="btn btn-primary" type="submit"> Simpan</button>

               </div>
             </div>
           </div>
         </form>
       </div>
       <script type="text/javascript">
         var daftar_pegawai = ' <?php foreach ($pegawai as $key) : ?> <option value="<?php echo $key->id_pegawai ?>"><?php echo $key->nama_lengkap ?></option> <?php endforeach ?>';

         function addAnggota(no) {
           var i = no;
           i++;
           $("#btnAdd").attr("onclick", "addAnggota('" + i + "')");

           var $tableBody = $('#tableAnggota').find("tbody");

           $tableBody.append('<tr><td><select name="id_anggota[]" id="'+i+'" class="form-control select2"> <option value="">Pilih Anggota</option>'+daftar_pegawai+'</select></td><td> <input type="text" class="form-control" name="jabatan[]" placeholder="Masukkan Jabatan"/> </td></tr>');

           $('#' + i).select2();
         }

         function eventKetua() {
           if ($('#id_ketua_tim').val() != '') {
             $('#divAnggota').show();
           } else {
             $('#divAnggota').hide();
           }
         }

       </script>