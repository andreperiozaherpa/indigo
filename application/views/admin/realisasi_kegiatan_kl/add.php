<div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Tambah Realisasi Kegiatan K/L</h4>
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
								<strong>Tambah</strong>
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
		
		<div class="panel panel-primary " data-collapsed="0">
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
                                            echo'<option value="'.$k->id_target_kegiatan_kl.'">'.$k->rencana_kegiatan.'</option>';
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
                                <input type="text" class="form-control" id="tahun" name="tahun_realisasi_kegiatan_kl" placeholder="Masukkan Tahun" required readonly> 
                            </div>

                                <div class="col-md-6">
                                <select name="triwulan" class="form-control" required>
                                    <option value="">Pilih Triwulan</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                </select>
                            </div>
                        </div>
                            </div>
                            </div>
                        <?php  
                            if($instansi_level=='koordinator'||$instansi_level=='lembaga'){
                        ?>
                        <input type="hidden" name="id_koordinator" value="<?php echo $id_koordinator ?>">
                        <?php 
                            }else{
                                ?>
                        <div class="form-group">
                            <label class="col-md-12">Koordinator</label>
                            <div class="col-md-12">
                                <select onchange="getLembaga()" id="id_koordinator" name="id_koordinator" class="form-control" required readonly>
                                    <option value="">Pilih Koordinator</option>
                                    <?php 
                                        foreach($koordinator as $k){
                                            echo'<option value="'.$k->id_instansi.'">'.$k->nama_instansi.'</option>';
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                                <?php
                            }
                            ?>
                        <?php 
                            if($instansi_level=='lembaga'){
                                ?>
                        <input type="hidden" name="id_sub_koordinator" value="<?php echo $id_sub_koordinator ?>">

                                <?php
                            }else{
                        ?>
                        <div class="form-group">
                            <label class="col-md-12">Sub Koordinator</label>
                            <div class="col-md-12">
                                <select name="id_sub_koordinator" id="id_sub_koordinator" class="form-control" readonly>
                                    <option value="">Pilih Sub Koordinator</option>
                                </select>
                            </div>
                        </div>
                        <?php } ?>

                        <div class="form-group">
                            <label class="col-md-12">Jumlah Anggaran (Rp)</label>
                            <div class="col-md-12">
                                <input type="text" name="jumlah_anggaran" class="form-control" placeholder="Masukkan Jumlah Anggaran" required> 
                                <span class="help-block" id="help_anggaran"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Volume</label>
                            <div class="col-md-6">
                                <input type="number" name="volume" class="form-control" placeholder="Masukkan Volume"> 
                            </div>
                            <div class="col-md-6">
                                <select name="id_satuan" class="form-control select2">
                                    <option value="">Pilih Satuan</option>
                                    <?php 
                                        foreach($satuan as $k){
                                            echo'<option value="'.$k->id_satuan.'">'.$k->satuan.'</option>';
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
                                <input type="text" name="tanggal_awal" class="form-control" id="datepicker" placeholder="Masukkan Tanggal Awal" required> 
                                <span class="help-block" id="help_awal"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Tanggal Akhir</label>
                            <div class="col-md-12">
                                <input type="text" name="tanggal_akhir" class="form-control" id="datepicker" placeholder="Masukkan Tanggal Akhir" required>
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
                                            echo '<option value="'.$p->id_provinsi.'">'.$p->provinsi.'</option>';
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
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Kecamatan</label>
                            <div class="col-md-12">
                                <select name="id_kecamatan_realisasi" onchange="getDesa()" id="id_kecamatan" class="form-control select2">
                                    <option value="">Pilih Kecamatan</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Desa / Kelurahan</label>
                            <div class="col-md-12">
                                <select name="id_desa_realisasi" id="id_desa" class="form-control select2">
                                    <option value="">Pilih Desa / Kelurahan</option>
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
                                <input type="text" name="tempat_realisasi" class="form-control" placeholder="Masukkan Tempat Kegiatan">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Keterangan</label>
                            <div class="col-md-12">
                            	<textarea rows="4" name="keterangan_realisasi" class="form-control" placeholder="Masukkan Keterangan Kegiatan"></textarea>
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
                </form>
                        </div>
            </div>
                    </div>
					</div>
			
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
        $('#id_sub_koordinator').html(data); 
        $("#id_sub_koordinator").select2("destroy");
        $("#id_sub_koordinator").select2();
      });
    }
</script>
<script type="text/javascript">
    function getLembaga(){
      var id_koordinator = $('#id_koordinator').val();
      $.post('<?php echo site_url('target_kegiatan_kl/get_lembaga') ?>', {id_koordinator:id_koordinator}, function(data){ 
        $('#id_sub_koordinator').html(data); 
        $("#id_sub_koordinator").select2("destroy");
        $("#id_sub_koordinator").select2();
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