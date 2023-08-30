<div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Edit Pengumuman</h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                   
                        <ol class="breadcrumb">
							<li>
								<a href="<?php echo base_url();?>admin"><i class="entypo-home"></i>Home</a>
							</li>
							<li>	
								<a href="<?php echo base_url();?>manage_notice">Papan Pengumuman</a>
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
		
		<div class="panel panel-primary" data-collapsed="0">
		
						
			</div>
			<div class="panel-body">
				<?php if (!empty($message)) echo "
				<div class='alert alert-$message_type'>$message</div>";?>
				<form role="form" class="form-horizontal" method='post' enctype="multipart/form-data">

					<div class="form-group">
						<label class="col-sm-2 control-label">Teks</label>
						<div class="col-sm-5">
							<textarea name='text' class="form-control"><?=$text?></textarea>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 control-label">Tanggal</label>
						<div class="col-sm-5">
							<input type="text" name='date' value="<?=$date?>" class="form-control mydatepicker">
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 control-label">Publish</label>
						<div class="col-sm-5">
							<select name="status" class="form-control">
								<option value="Y"<?php if($status=='Y'){echo "selected";}?>>Y</option>
								<option value="N"<?php if($status=='N'){echo "selected";}?>>N</option>
							</select>
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
                <!-- /.row -->
            </div>