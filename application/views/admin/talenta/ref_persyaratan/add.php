<div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Tambah Persyaratan Analisis Kebutuhan</h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                   
                        <ol class="breadcrumb">
							<li>
								<a href="<?php echo base_url();?>admin"><i class="entypo-home"></i>Home</a>
							</li>
                            <li>
								<a href="#">Manajemen Talenta</a>
							</li>
							<li>	
								<a href="<?php echo base_url();?>talenta/persyaratan">Persyaratan</a>
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

                	<?php echo form_open_multipart() ?>
                    <div class="form-group">
                    <label class="control-label"> Eselon</label>
                    <select class="form-control select2" name="eselon">
                        <option value="">Pilih Eselon</option>
                            <?php 
									$eselonArr = array("I","II","III","IV");
									foreach($eselonArr as $key=>$val){
										$selected = (!empty($eselon) && $eselon==$val) ? "selected" : "";
										echo "<option $selected value='".$val."'>".$val."</option>";
									}
							?>
                    </select>
                    <?= form_error("eselon",'<p class="text-info">','</p>');?>
                
                    </div>
                   <div class="form-group">
                	<label class="control-label"> Persyaratan</label>
                	<input type="text" name="persyaratan" class="form-control" value="<?= !empty($persyaratan)?$persyaratan:"" ;?>" placeholder="Masukkan Persyaratan">
                    <?= form_error("persyaratan",'<p class="text-info">','</p>');?>
                    
                </div>

				<div class="form-group">
                	<label class="control-label"> Deskripsi</label>
                    <textarea name="deskripsi" class="form-control" placeholder="Masukkan Deskripsi Persyaratan"><?= !empty($deskripsi)?$deskripsi    :"" ;?></textarea>
                </div>

			
                
               	 <div class="form-group">
					<button type="submit" class="btn btn-primary waves-effect waves-light" type="button">Simpan</button>
                    <a href="/talenta/persyaratan" class="btn btn-default">Kembali</a>
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
