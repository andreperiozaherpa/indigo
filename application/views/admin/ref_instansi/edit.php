<div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Edit Instansi</h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                   
                        <ol class="breadcrumb">
							<li>
								<a href="<?php echo base_url();?>admin"><i class="entypo-home"></i>Beranda</a>
							</li>
							<li>	
								<a href="<?php echo base_url();?>ref_instansi">Daftar Instansi</a>
							</li>
							<li class="active">		
								<strong>tambah</strong>
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
                <div class="col-md-8">
				<?php if (!empty($message)) echo "
				<div class='alert alert-$message_type'>$message</div>";?>

                	<?php echo form_open_multipart() ?>
                   <div class="form-group">
                	<label class="control-label"> Nama Instansi</label>
                	<input type="text" id="firstName" value="<?php echo $data->nama_instansi ?>" name="nama_instansi" class="form-control" placeholder="">
                </div>

				<div class="form-group">
                	<label class="control-label"> Telepon</label>
                	<input type="text" id="firstName" value="<?php echo $data->telepon ?>" name="telepon" class="form-control" placeholder="">
                </div>

				<div class="form-group">
                	<label class="control-label"> Email</label>
                	<input type="text" id="firstName" value="<?php echo $data->email ?>" name="email" class="form-control" placeholder="">
                </div>

				<div class="form-group">
                	<label class="control-label"> Website</label>
                	<input type="text" id="firstName" value="<?php echo $data->website ?>" name="website" class="form-control" placeholder="">
                </div>



              	  <div class="form-group">
                	<label class="control-label">Type</label>
                	<select onchange="ganti()" id="type" name="level" class="form-control">
                        <option value="">Pilih Type</option>
                        <option value="koordinator" <?php echo $data->level=='koordinator' ? 'selected' : '' ?>>Koordinator</option>
                        <option value="lembaga" <?php echo $data->level=='lembaga' ? 'selected' : '' ?>>Lembaga</option>
                    </select>
               	 </div>

               	 <div style="display: <?php echo $data->level=='lembaga' ? 'block' : 'none' ?>" id="switch" class="form-group">
                	<label class="control-label">Pilih Koordinator</label>
                	<select name="id_koordinator" class="form-control">
                        <option value="">Pilih Koordinator</option>
						<?php 
							foreach ($koordinator as $k) {

								if($data->level=='lembaga'){
									if($data->id_koordinator==$k->id_instansi){
										$selected = ' selected';
									}else{
										$selected = '';
									}
								}else{
									$selected = '';
								}

								echo "<option value='$k->id_instansi'".$selected.">$k->nama_instansi</option>";
							}
						?>
                    </select>
               	 </div>

				


               	 <div class="form-group">
                	<label class="control-label">Logo </label>
					<input type="file" name='logo'  id="input-file-now-custom-3" class="dropify"  data-label="<i class='glyphicon glyphicon-file'></i> Browse" data-default-file="<?php echo base_url()."data/images/instansi/".$data->logo ?>" />
               	 </div>

               	 	 <div class="form-group">
                	<label class="control-label">Keterangan </label>
	    			 <textarea class="form-control" name="keterangan"><?php echo $data->keterangan ?></textarea>

               	 </div>

					<div class="form-group">
                	<label class="control-label">Status </label><br>
					Aktif 
					<input type="checkbox" name="status" checked class="js-switch" data-color="#f96262" data-size="medium" /> 
					 
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
	function ganti(){
		var type = $('#type').val();
		if(type=='lembaga'){
			$('#switch').css('display','block');
		}else{

			$('#switch').css('display','none');
		}
	}
</script>