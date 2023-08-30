<div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Tambah Navigasi Menu</h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                   
                        <ol class="breadcrumb">
							<li>
								<a href="<?php echo base_url();?>admin"><i class="entypo-home"></i>Home</a>
							</li>
							<li>	
								<a href="<?php echo base_url();?>manage_media/navigasi_menu">Navigasi Menu</a>
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
				<form role="form" class="form-horizontal " method='post' enctype="multipart/form-data">
				<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>" />
					<div class="form-group">
						<label class="col-sm-2 control-label">Judul</label>
						<div class="col-sm-7">
							<input type="text" class="form-control" name='judul' placeholder="">
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-2 control-label">Url</label>
						<div class="col-sm-7">
							<input type="text" class="form-control" name='url' placeholder="">
							<small id="emailHelp" class="form-text text-muted">Dimohon untun menggunakan huruf kecil dan tiap kata di pisah dengan underscore.</small>
							<br>
                            <small id="emailHelp" class="form-text text-success"><i class="fa fa-check"></i> menu , menu_desa </small>
							<br>
                            <small id="emailHelp" class="form-text text-danger"><i class="fa fa-close"></i> Menu , Menu Desa </small>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 control-label">BG Header</label>
						<div class="col-sm-7">
						<input type="file" name="bg_header" id="input-file-now-custom-3" class="dropify" data-label="<i class='glyphicon glyphicon-file'></i> Browse" />
							<p>
								Max : 2000px | 2MB
							</p>
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-2 control-label">Isi</label>
						<div class="col-sm-7">
							<textarea name="isi" id="post_manager" cols="30" rows="30"></textarea>
						</div>
					</div>
					
					<div class="form-group">
						
						<div class="col-sm-9">
							 <button type="submit" class="btn btn-primary waves-effect waves-light pull-right" type="button"><span class="btn-label"><i class="fa fa-plus"></i></span>Simpan</button>

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