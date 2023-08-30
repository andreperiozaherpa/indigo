
<div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Edit Gambar Header</h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                   
                        <ol class="breadcrumb">
							<li>
								<a href="<?php echo base_url();?>admin"><i class="entypo-home"></i>Home</a>
							</li>
							<li>	
								<a href="<?php echo base_url();?>manage_media/img_header">Gambar Header</a>
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
                        <div class="white-box">

<div class="row">
	<div class="col-md-12">
		
		
			<div class="panel-body">
				<?php if (!empty($message)) echo "
				<div class='alert alert-$message_type'>$message</div>";?>
				<form role="form" class="form-horizontal " method='post' enctype="multipart/form-data">
				<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>" />
					<div class="form-group">
						<label class="col-sm-2 control-label">Judul</label>
						<div class="col-sm-5">
							<input type="text" class="form-control" name='judul' value='<?php echo $judul;?>' placeholder="">
						</div>
					</div>
					
					
					

					<div class="form-group">
						<label class="col-sm-2 control-label">Deskripsi</label>
						<div class="col-sm-5">
							<textarea class="form-control" rows="4" name="deskripsi" id="deskripsi"><?php echo $deskripsi;?></textarea>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">Link</label>
						<div class="col-sm-5">
							<input type="text" class="form-control" name='link' placeholder="" value="<?php echo $link;?>">
						</div>
					</div>

					
					<div class="form-group">
						<label class="col-sm-2 control-label">Status</label>
						
						<div class="col-sm-2">
							
							<select name="status" class="form-control selectboxit" data-first-option="false">
								<option>Select</option>
								<?php
									if ($status=="Active"){
										echo "
											<option value='Active' selected>Active</option>
											<option value='Not Active'>Not Active</option>
										";
									}
									else{
										echo "
											<option value='Active' >Active</option>
											<option value='Not Active' selected>Not Active</option>
										";
									}
								?>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">Urutan</label>
						<div class="col-sm-5">
							<input type="text" class="form-control" name='urutan' placeholder="" value="<?php echo $urutan;?>">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">Gambar header</label>
						
						<div class="col-sm-5">
							<?php echo"
							<div class='member-img'>
								<img src='".base_url()."data/images/header/$gbr_header' class='img-rounded' style='max-width:600px' />
								
							</div><br>
							";?>
							<input type="file" name='userfile'  id="input-file-now-custom-3" class="dropify" data-label="<i class='glyphicon glyphicon-file'></i> Browse" />
							<p>
								Max : 2000px | 2MB
							</p>
						</div>
					</div>
					<div class="form-group">
						
						<div class="col-sm-7">
							 <button type="submit" class="btn btn-primary waves-effect waves-light pull-right" type="button"><span class="btn-label"><i class="fa fa-plus"></i></span>Perbarui</button>

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