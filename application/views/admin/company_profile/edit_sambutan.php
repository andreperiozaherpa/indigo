<script type="text/javascript" src="<?php echo base_url()."asset" ;?>/tinymce/tinymce.min.js"></script>
    <script type="text/javascript">
        tinymce.init({
            selector: "#isi",
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
<ol class="breadcrumb bc-3" >
	<li>
		<a href="<?php echo base_url();?>admin"><i class="entypo-home"></i>Home</a>
	</li>
	<li>	
		<a href="#">Company profile</a>
	</li>
	<li>
		<a href="<?php echo base_url();?>manage_company_profile/sambutan">Sambutan</a>
	</li>
	<li class="active">		
		<strong>Edit</strong>
	</li>
</ol>


<div class="row">
	<div class="col-md-12">
		
		<div class="panel panel-primary" data-collapsed="0">
		
			<div class="panel-heading">
				<div class="panel-title">
					Edit sambutan
				</div>
				<div class="panel-options">
					<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
					<a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
				</div>
				
			</div>
			<div class="panel-body">
				<?php if (!empty($message)) echo "
				<div class='alert alert-$message_type'>$message</div>";?>
				<form role="form" class="form-horizontal " method='post' enctype="multipart/form-data">
					
					<div class="form-group">
						<label class="col-sm-2 control-label">Nama</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" value='<?php echo $nama;?>' id='nama' name='nama' placeholder="">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">Jabatan</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" value='<?php echo $jabatan;?>' name='jabatan' placeholder="">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">Foto</label>
						
						<div class="col-sm-10">
							<?php echo"
							<div class='member-img'>
								<img src='".base_url()."data/images/sambutan/$foto' class='img-rounded' style='max-width:200px' />
								
							</div><br>";?>
							<input type="file" name='userfile' class="form-control file2 inline btn btn-primary" data-label="<i class='glyphicon glyphicon-file'></i> Browse" />
							<p>
								Max : 500px | 1MB
							</p>
							<?php if (!empty($error)) echo "
				<div class='alert alert-warning'>$error</div>";?>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">Isi sambutan</label>
						<div class="col-sm-10">
							<textarea class="form-control" id='isi' name='isi'><?php echo $isi;?></textarea>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-2"></div>
						<div class="col-sm-5">
							<button type="submit" class="btn btn-blue">Update</button>	
						</div>
						
					</div>
				</form>
			
			</div>

		</div>
	</div>
</div>
