<script type="text/javascript" src="<?php echo base_url()."asset" ;?>/tinymce/tinymce.min.js"></script>
    <script type="text/javascript">
        tinymce.init({
            selector: "#tentang",
            theme: "modern",
            plugins: [ 
			"advlist autolink link image lists charmap print preview hr anchor pagebreak", 
			"searchreplace wordcount visualblocks visualchars code insertdatetime media nonbreaking", 
			"table contextmenu directionality emoticons paste textcolor filemanager" 
			], 
			image_advtab: true, 
			toolbar: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect forecolor backcolor | link unlink anchor | image media | print preview code"
			 });
    </script>
<div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Identitas Lembaga </h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                   
                        <ol class="breadcrumb">
							<li>
								<a href="<?php echo base_url();?>admin"><i class="entypo-home"></i>Home</a>
							</li>
							
							<li class="active">		
								<strong>Edit Identitas Lembaga</strong>
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
					<div class="form-group">
						<label class="col-sm-2 control-label">Logo</label>
						
						<div class="col-sm-10">
							<?php echo"
							<div class='member-img'>
								<img src='".base_url()."data/logo/$logo' class='img-rounded' style='max-width:200px' />
								
							</div><br>
							";?>
							<input type="file" name='userfile' id="input-file-now-custom-3" class="dropify"  data-label="<i class='glyphicon glyphicon-file'></i> Browse" />
							<p>
								Max : 500px | 1MB
							</p>
							<?php if (!empty($error)) echo "
				<div class='alert alert-warning'>$error</div>";?>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">Nama</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" value='<?php echo $nama;?>' name='nama' placeholder="">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">Alamat</label>
						<div class="col-sm-10">
							<textarea class="form-control" name='alamat'><?php  echo $alamat;?></textarea>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">Telepon</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name='telepon' placeholder="" value='<?php echo $telepon;?>' >
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-2 control-label">Email</label>
						<div class="col-sm-10">
							<input type="text" class="form-control"  name='email' placeholder="" value='<?php echo $email;?>' >
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">Facebook</label>
						<div class="col-sm-10">
							<input type="text" class="form-control"  name='facebook' placeholder="" value='<?php echo $facebook;?>' >
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">Twitter</label>
						<div class="col-sm-10">
							<input type="text" class="form-control"  name='twitter' placeholder="" value='<?php echo $twitter;?>' >
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">Youtube</label>
						<div class="col-sm-10">
							<input type="text" class="form-control"  name='youtube' placeholder="" value='<?php echo $youtube;?>' >
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">Gmap</label>
						<div class="col-sm-10">
							<input type="text" class="form-control"  name='gmap' placeholder="" value='<?php echo $gmap;?>' >
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">Instagram</label>
						<div class="col-sm-10">
							<input type="text" class="form-control"  name='instagram' placeholder="" value='<?php echo $instagram;?>' >
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 control-label">Latitude</label>
						<div class="col-sm-10">
							<input type="text" class="form-control"  name='latitude' placeholder="" value='<?php echo $latitude;?>' >
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 control-label">Longitude</label>
						<div class="col-sm-10">
							<input type="text" class="form-control"  name='longitude' placeholder="" value='<?php echo $longitude;?>' >
						</div>
					</div>


					<div class="form-group">
						<label class="col-sm-2 control-label">Tentang</label>
						<div class="col-sm-10">
							<textarea class="form-control" rows="18" name="tentang" id="tentang">
				<?php echo $tentang;?>
			</textarea>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-2"></div>
						<div class="col-sm-10">
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
            <!-- /.container-fluid -->
