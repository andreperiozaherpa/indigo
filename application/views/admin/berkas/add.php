<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Tambah Berkas</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

            <ol class="breadcrumb">
               <li>
                <a href="<?php echo base_url();?>admin"><i class="entypo-home"></i>Home</a>
            </li>
            <li>	
                <a href="<?php echo base_url();?>manage_category_finance">Berkas</a>
            </li>
            <li class="active">		
                <strong>Tambah</strong>
            </li>
        </ol>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- .row -->
<div class="row">
    <div class="col-sm-12">
        <div class="white-box">

            <div class="row">
             <div class="col-md-12">

              <div class="panel panel-primary" data-collapsed="0">
              </div>
              <div class="panel-body">
                <?php if (!empty($message)) echo "
                <div class='alert alert-$message_type'>$message</div>";?>
                <?php if (!empty($message_f)) echo "
                <div class='alert alert-$message_type_f'>$message_f</div>";?>
                <form role="form" class="form-horizontal " method='post' enctype="multipart/form-data">

                <?php if($level=='Administrator'){?>
                 <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label class="col-md-12">Level Unit Kerja</label>
                            <div class="col-md-12">
                                <select onchange="getUnit()" name="level_unit" id="level_unit" class="form-control select2">
                                    <option value="">Pilih Level Unit Kerja</option>
                                    <option value="1">Unit Kerja</option>
                                    <option value="2">Sub Unit Kerja 1</option>
                                    <option value="3">Sub Unit Kerja 2</option>
                                    <option value="4">Sub Unit Kerja 3</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                 <div class="col-md-4">
                    <div id="u1" style="display:none" class="form-group">
                        <label class="col-md-12">Unit Kerja</label>
                        <div class="col-md-12">
                            <select id="uk1" onchange="getUK(2)" name="uk1" class="form-control select2">
                                <option value="">Pilih Unit Kerja</option>
                                <?php 
                                foreach($unit_kerja as $u){
                                    echo'<option value="'.$u->id_unit_kerja.'">'.$u->nama_unit_kerja.'</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div id="u2" style="display:none" class="form-group">
                        <label class="col-md-12">Sub Unit Kerja 1</label>
                        <div class="col-md-12">
                            <select id="uk2" onchange="getUK(3)" name="uk2" class="form-control select2">
                                <option value="">Pilih Sub Unit Kerja 1</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div id="u3" style="display:none" class="form-group">
                        <label class="col-md-12">Sub Unit Kerja 2</label>
                        <div class="col-md-12">
                            <select id="uk3" onchange="getUK(4)" name="uk3" class="form-control select2">
                                <option value="">Pilih Sub Unit Kerja 2</option>
                            </select>
                        </div>
                    </div>
                    <div id="u4" style="display:none" class="form-group">
                        <label class="col-md-12">Sub Unit Kerja 3</label>
                        <div class="col-md-12">
                            <select id="uk4" name="uk4" class="form-control select2">
                                <option value="">Pilih Sub Unit Kerja 3</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        <?php }else{?>
            <input type="hidden" name="level_unit" value="<?php echo $level_unit ?>">
            <input type="hidden" name="uk<?php echo $level_unit ?>" value="<?php echo $id_unit_kerja ?>">
        <?php } ?>

                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label class="col-md-12">Kategori Data</label>
                            <div class="col-md-12">
                                <select  name="id_kategori_berkas" id="id_kategori_berkas" class="form-control select2">
                                    <option value="">Pilih Kategori Data</option>
                                    <?php 
                                        foreach($kategori_berkas as $k){
                                            echo '<option value="'.$k->id_kategori_berkas.'">'.$k->kategori_berkas.'</option>';
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label class="col-md-12">Keamaanan Data</label>
                            <div class="col-md-12">
                                <select name="data_rahasia" id="level_unit" class="form-control select2">
                                    <option value="0">Umum</option>
                                    <option value="1">Rahasia</option>
                                   
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

            <div class="row">
                <div class="col-md-8">
                    <div class="form-group">
                        <label class="col-md-12">Nama Kegiatan</label>
                        <div class="col-md-12">
                            <input type="text" name="nama_kegiatan" class="form-control" placeholder="Masukkan Nama Kegiatan">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-12">Keterangan</label>
                        <div class="col-md-12">
                         <textarea rows="4" name="keterangan" class="form-control" placeholder="Masukkan Keterangan Kegiatan"></textarea>
                     </div>
                 </div>

                <div id="file_add" class="form-group">
                    <label class="col-md-12">File Pendukung
                        <small style="font-weight: normal;">File yang diizinkan : jpg,jpeg,png,doc,docx,xls,xlsx,pdf</small></label>
                        <div class="row">
                            <div class="col-md-12">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <input type="file" name='files[]'  id="data_pendukung" class="dropify"  data-label="<i class='glyphicon glyphicon-file'></i> Browse"  data-height="100" multiple />
                        </div>
                    </div>
                    <a style="margin-top: -10px" onclick="addFile()" href="javascript:void(0)" class="btn btn-primary btn-xs">Tambah File</a>

                    <div class="form-group" style="margin-top: 20px">
                        <label class="col-md-12">
                            Sharing Berkas <input name="sharing" id="sharing" onclick="toggleShare()" type="checkbox" class="js-switch" data-color="#FA4768" />
                        </label>
                    </div>
                    <div style="display: none" id="divSharing" class="form-group">
                        <label class="col-md-12">Sharing Dengan</label>
                        <div class="col-md-12">
                            <select id="share_dengan" onchange="toggleShareWith()" name="share_dengan" class="form-control">
                                <option value="semua">Semua Unit Kerja</option>
                                <option value="terpilih">Unit Kerja Terpilih</option>
                            </select>
                            <div id="divUnitKerja" style="display:none;margin-top: 10px" class="row">
                                <div class="col-md-12">
                                    <?php

                                    foreach($unit_kerja as $u){

                                                $child = $this->ref_unit_kerja_model->get_by_id_parent($u->id_unit_kerja); ?>
                                        <div class="panel panel-primary">
                                            <div class="panel-heading clearfix">
                                                <div class="checkbox checkbox-default pull-left" style="padding-top: 7.5px;">
                                                    <input id="parent<?php echo $u->id_unit_kerja?>" id="checkbox3" name="sharing_berkas[]" type="checkbox" value="<?php echo $u->id_unit_kerja ?>">
                                                    <label style="" for="checkbox3"> <?php echo $u->nama_unit_kerja ?> </label>
                                                </div>
                                                <?php 
                                                if(!empty($child)){
                                                ?>
                                                <div class="btn-group pull-right">
                                                    <a href="javascript:void(0)" id="btnCheck<?php echo $u->id_unit_kerja ?>" onclick="checkAll(<?php echo $u->id_unit_kerja ?>)" style="color: #222" class="btn btn-default btn-sm">Pilih Semua</a>
                                                </div>
                                            <?php } ?>
                                            </div> 
                                            <div class="panel-wrapper collapse in">
                                                <?php
                                                if(!empty($child)){
                                                    ?>

                                                    <div style="border: solid 1px #e4e7ea" class="panel-body">
                                                        <?php
                                                        foreach($child as $c){
                                                            ?>
                                                            <div class="checkbox checkbox-default">
                                                                <input id="child<?php echo $u->id_unit_kerja?>" name="sharing_berkas[]" type="checkbox" value="<?php echo $c->id_unit_kerja ?>">
                                                                <label style="" for="checkbox3"> <?php echo $c->nama_unit_kerja ?> </label>
                                                            </div>
                                                            <?php
                                                        }
                                                        ?>
                                                    </div>
                                                    <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                        <?php
                                    } ?>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                           <div class="pull-right">
                             <a href="" class="btn btn-default waves-effect waves-light">Batal</a>
                             <button type="submit" class="btn btn-primary waves-effect waves-light" type="button"><span class="btn-label"><i class="fa fa-plus"></i></span>Simpan</button>
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

</div>
</div>
</div>
<!-- /.row -->
</div>
<!-- /.container-fluid -->
<script type="text/javascript">

    function getUnit(){
      var level_unit = $('#level_unit').val();
      if(level_unit==1){
        $('#u1').show();
        $('#u2').hide();
        $('#u3').hide();
        $('#u4').hide();
    }else if(level_unit==2){
        $('#u1').show();
        $('#u2').show();
        $('#u3').hide();
        $('#u4').hide();
    }else if(level_unit==3){
        $('#u1').show();
        $('#u2').show();
        $('#u3').show();
        $('#u4').hide();
    }else if(level_unit==4){
        $('#u1').show();
        $('#u2').show();
        $('#u3').show();
        $('#u4').show();
    }else{
        $('#u1').hide();
        $('#u2').hide();
        $('#u3').hide();
        $('#u4').hide();
    }
}

function getUK(level){
  var id_parent = $('#uk'+parseInt(level-1)).val();
  $.post('<?php echo site_url('berkas/get_unit_kerja') ?>', {id_parent:id_parent,level:level}, function(data){ 
    $('#uk'+level).html(data); 
    $("#uk"+level).select2("destroy");
    $("#uk"+level).select2();
});
}
function addFile(){
    $('#file_add').append('<div class="col-md-4"><input type="file" name="files[]"  id="data_pendukung" class="dropify" data-height="100" /></div>');
    $('.dropify').dropify();
}
function toggleShare(){
    if ($('#sharing').is(':checked')) {
        $('#divSharing').show();
    }else{
        $('#divSharing').hide();
    }
}
function toggleShareWith(){
    var value = $('#share_dengan').val();
    if(value=='terpilih'){
        $('#divUnitKerja').show();
    }else{
        $('#divUnitKerja').hide();
    }
}
function checkAll(id){
        $('input[id="child'+id+'"]').each(function() { 
            this.checked = true; 
        });
        $('#parent'+id).prop('checked', true);
        $('#btnCheck'+id).html('Hapus Semua Pilihan');
        $('#btnCheck'+id).attr('onclick','uncheckAll('+id+')');
}
function uncheckAll(id){
        $('input[id="child'+id+'"]').each(function() { 
            this.checked = false; 
        });
        $('#parent'+id).prop('checked', false);
        $('#btnCheck'+id).html('Pilih Semua');
        $('#btnCheck'+id).attr('onclick','checkAll('+id+')');
}
</script>