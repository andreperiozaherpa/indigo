<div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Edit Realisasi Kegiatan K/L</h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                   
                        <ol class="breadcrumb">
                            <li>
                                <a href="<?php echo base_url();?>admin"><i class="entypo-home"></i>Home</a>
                            </li>
                            <li>    
                                <a href="<?php echo base_url();?>manage_category_finance">Target Realisasi K/L</a>
                            </li>
                            <li class="active">     
                                <strong>Edit</strong>
                            </li>
                        </ol>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- .row -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="white-box block5">

<div class="row">
    <div class="col-md-12">
        
        <div class="panel panel-primary" data-collapsed="0">
        
            
                
            </div>
            <div class="panel-body">
                <?php if (!empty($message)) echo "
                <div class='alert alert-$message_type'>$message</div>";?>
                <form role="form" class="form-horizontal " method='post' enctype="multipart/form-data">
                    <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="col-md-12">Kegiatan</label>
                            <div class="col-md-12">
                                <select onchange="getData()" name="id_target_kegiatan_kl" id="id_target_kegiatan_kl" class="form-control select2" required>
                                    <option value="">Pilih Kegiatan</option>
                                    <?php 
                                        foreach($kegiatan as $k){
                                            if($k->id_target_kegiatan_kl==$detail->id_target_kegiatan_kl){
                                                $selected = ' selected';
                                            }else{
                                                $selected = '';
                                            }
                                            echo'<option value="'.$k->id_target_kegiatan_kl.'"'.$selected.'>'.$k->rencana_kegiatan.'</option>';
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Tahun</label>
                            <div class="col-md-12">
                                <div class="row">
                                <div class="col-md-6">
                                <input type="text" value="<?php echo $detail->tahun_realisasi_kegiatan_kl ?>" class="form-control" name="tahun_realisasi_kegiatan_kl" placeholder="Masukkan Tahun"> 
                            </div>

                                <div class="col-md-6">
                                <select name="triwulan" class="form-control">
                                    <option value="">Pilih Triwulan</option>
                                    <option value="1"<?=$detail->triwulan=='1' ? ' selected' : '' ?>>1</option>
                                    <option value="2"<?=$detail->triwulan=='2' ? ' selected' : '' ?>>2</option>
                                    <option value="3"<?=$detail->triwulan=='3' ? ' selected' : '' ?>>3</option>
                                    <option value="4"<?=$detail->triwulan=='4' ? ' selected' : '' ?>>4</option>
                                </select>
                            </div>
                        </div>
                            </div>
                            </div>
                        <div class="form-group">
                            <label class="col-md-12">Koordinator</label>
                            <div class="col-md-12">
                                <select onchange="getLembaga()" id="id_koordinator" name="id_koordinator" class="form-control select2">
                                    <option value="">Pilih Koordinator</option>
                                    <?php 
                                        foreach($koordinator as $k){
                                            if($k->id_instansi==$detail->id_koordinator){
                                                $selected = ' selected';
                                            }else{
                                                $selected = '';
                                            }
                                            echo'<option value="'.$k->id_instansi.'"'.$selected.'>'.$k->nama_instansi.'</option>';
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Kementrian / Lembaga</label>
                            <div class="col-md-12">
                                <select name="id_sub_koordinator" id="id_lembaga" class="form-control select2">
                                    <option value="">Pilih Instansi</option>
                                    <?php 
                                        foreach($lembaga as $l){
                                            if($l->id_instansi==$detail->id_sub_koordinator){
                                                $selected = ' selected';
                                            }else{
                                                $selected = '';
                                            }
                                            echo'<option value="'.$l->id_instansi.'"'.$selected.'>'.$l->nama_instansi.'</option>';
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-12">Jumlah Anggaran (Rp)</label>
                            <div class="col-md-12">
                                <input type="text" name="jumlah_anggaran" value="<?php echo $detail->jumlah_anggaran ?>" class="form-control" placeholder="Masukkan Jumlah Anggaran">
                                <span class="help-block" id="help_anggaran"></span> </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Volume</label>
                            <div class="col-md-6">
                                <input type="number" value="<?php echo $detail->volume ?>" name="volume_kegiatan" class="form-control" placeholder="Masukkan Volume"> 
                            </div>
                            <div class="col-md-6">
                                <select name="id_satuan" class="form-control select2">
                                    <option value="">Pilih Satuan</option>
                                    <?php 
                                        foreach($satuan as $k){
                                            if($k->id_satuan==$detail->id_satuan){
                                                $selected = ' selected';
                                            }else{
                                                $selected = '';
                                            }
                                            echo'<option value="'.$k->id_satuan.'"'.$selected.'>'.$k->satuan.'</option>';
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="col-md-12">Tanggal Awal</label>
                            <div class="col-md-12">
                                <input type="text" value="<?php echo $detail->tanggal_awal?>" name="tanggal_awal" class="form-control" id="datepicker" placeholder="Masukkan Tanggal Awal">
                                <span class="help-block" id="help_awal"></span> </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Tanggal Akhir</label>
                            <div class="col-md-12">
                                <input type="text" value="<?php echo $detail->tanggal_akhir?>" name="tanggal_akhir" class="form-control" id="datepicker" placeholder="Masukkan Tanggal Akhir">
                                <span class="help-block" id="help_akhir"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Provinsi</label>
                            <div class="col-md-12">
                                <select id="id_provinsi" onchange="getKabupaten()" name="id_provinsi_realisasi" class="form-control select2">
                                    <option value="">Pilih Provinsi</option>
                                    <?php 
                                        foreach($provinsi as $p){
                                            if($p->id_provinsi==$detail->id_provinsi_target){
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
                            <label class="col-md-12">Kabupaten / Kota</label>
                            <div class="col-md-12">
                                <select id="id_kabupaten" onchange="getKecamatan()" name="id_kabupaten_realisasi" class="form-control select2">
                                    <option value="">Pilih Kabupaten / Kota</option>
                                    <?php 
                                        foreach($kabupaten as $p){
                                            if($p->id_kabupaten==$detail->id_kabupaten_target){
                                                $selected = ' selected';
                                            }else{
                                                $selected = '';
                                            }
                                            echo '<option value="'.$p->id_kabupaten.'"'.$selected.'>'.$p->kabupaten.'</option>';
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Kecamatan</label>
                            <div class="col-md-12">
                                <select name="id_kecamatan_realisasi" onchange="getDesa()" id="id_kecamatan" class="form-control select2">
                                    <option value="">Pilih Kecamatan</option>
                                    <?php 
                                        foreach($kecamatan as $p){
                                            if($p->id_kecamatan==$detail->id_kecamatan_target){
                                                $selected = ' selected';
                                            }else{
                                                $selected = '';
                                            }
                                            echo '<option value="'.$p->id_kecamatan.'"'.$selected.'>'.$p->kecamatan.'</option>';
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Desa / Kelurahan</label>
                            <div class="col-md-12">
                                <select name="id_desa_realisasi" id="id_desa" class="form-control select2">
                                    <option value="">Pilih Desa / Kelurahan</option>
                                    <?php 
                                        foreach($desa as $p){
                                            if($p->id_desa==$detail->id_desa_target){
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

                        </div>
                    </div>
                        <div class="row">
                        <div class="col-md-8">

                        <div class="form-group">
                            <label class="col-md-12">Tempat Kegiatan</label>
                            <div class="col-md-12">
                                <input type="text" value="<?php echo $detail->tempat_realisasi?>"  name="tempat_realisasi" class="form-control" placeholder="Masukkan Tempat Kegiatan">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Keterangan</label>
                            <div class="col-md-12">
                                <textarea rows="4" value="<?php echo $detail->keterangan_realisasi?>" name="keterangan_realisasi" class="form-control" placeholder="Masukkan Keterangan Kegiatan"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <div class="pull-right">
                                    <a href="" class="btn btn-default waves-effect waves-light">Batal</a>
                                    <button type="submit" class="btn btn-primary waves-effect waves-light" type="button"><span class="btn-label"><i class="fa fa-plus"></i></span>Perbarui</button>
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
$('#category_name').on('input', function() {
    var permalink;
    // Trim empty space
    permalink = $.trim($(this).val());
    // replace more then 1 space with only one
    permalink = permalink.replace(/\s+/g,' ');
    $('#category_slug').val(permalink.toLowerCase());
    $('#category_slug').val($('#category_slug').val().replace(/\W/g, ' '));
    $('#category_slug').val($.trim($('#category_slug').val()));
    $('#category_slug').val($('#category_slug').val().replace(/\s+/g, '-'));
    var gappermalink = $('#category_slug').val();
    $('#slug').html(gappermalink);
});
</script>
<script type="text/javascript">
    function getLembaga(){
      var id_koordinator = $('#id_koordinator').val();
      $.post('<?php echo site_url('realisasi_kegiatan_kl/get_lembaga') ?>', {id_koordinator:id_koordinator}, function(data){ 
        $('#id_lembaga').html(data); 
        $("#id_lembaga").select2("destroy");
        $("#id_lembaga").select2();
      });
    }
</script>
<script type="text/javascript">
    function getLembaga(){
      var id_koordinator = $('#id_koordinator').val();
      $.post('<?php echo site_url('target_kegiatan_kl/get_lembaga') ?>', {id_koordinator:id_koordinator}, function(data){ 
        $('#id_lembaga').html(data); 
        $("#id_lembaga").select2("destroy");
        $("#id_lembaga").select2();
      });
    }
    function getKabupaten(){
      var id_provinsi = $('#id_provinsi').val();
      $.post('<?php echo site_url('target_kegiatan_kl/get_kabupaten') ?>', {id_provinsi:id_provinsi}, function(data){ 
        $('#id_kabupaten').html(data); 
        $("#id_kabupaten").select2("destroy");
        $("#id_kabupaten").select2();
      });
    }
    function getKecamatan(){
      var id_kabupaten = $('#id_kabupaten').val();
      $.post('<?php echo site_url('target_kegiatan_kl/get_kecamatan') ?>', {id_kabupaten:id_kabupaten}, function(data){ 
        $('#id_kecamatan').html(data); 
        $("#id_kecamatan").select2("destroy");
        $("#id_kecamatan").select2();
      });
    }
    function getDesa(){
      var id_kecamatan = $('#id_kecamatan').val();
      $.post('<?php echo site_url('target_kegiatan_kl/get_desa') ?>', {id_kecamatan:id_kecamatan}, function(data){ 
        $('#id_desa').html(data); 
        $("#id_desa").select2("destroy");
        $("#id_desa").select2();
      });
    }
    function getData(){

        $('div.block5').block({
            message: '<h4><i class="fa fa-circle-o-notch fa-spin"></i> Mengambil data...</h4>',
            css: {
                border: '1px solid #fff'
            }
        });

      var id = $('#id_target_kegiatan_kl').val();
          $.ajax({
            url : "<?php echo base_url('realisasi_kegiatan_kl/get_data/')?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
                // alert(data);
                $('#id_sub_koordinator').html(data.option);
                $('#id_koordinator').val(data.id_koordinator);
                $('#tahun').val(data.tahun_target_kegiatan_kl);
                $('#help_anggaran').html("*Sisa anggaran :"+data.sisa_anggaran);
                $('#help_awal').html("*Tidak boleh kurang dari "+data.help_awal);
                $('#help_akhir').html("*Tidak boleh lebih dari "+data.help_akhir);
                $('div.block5').unblock();

                // $('#datepicker').datepicker("destroy");
                // $('#datepicker').datepicker("option", "minDate", new Date('2018-7-1'));
                // $('#datepicker').datepicker("option", "maxDate", new Date('2018-7-29'));
          }
      });
    }
</script>