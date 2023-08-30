<script type="text/javascript" src="<?php echo base_url()."asset" ;?>/tinymce/tinymce.min.js"></script>
    <script type="text/javascript">
        tinymce.init({
            selector: "textarea",
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
	<li class="active">		
		<strong>Struktur Organisasi</strong>
	</li>
</ol>


<div class="row">
	<div class="col-md-12">
		
		<div class="panel panel-primary" data-collapsed="0">
		
			<div class="panel-heading">
				<div class="panel-title">
					Struktur organisasi
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
						<div class="col-sm-12">
							<textarea class="form-control" rows="10" name="isi" id="isi"><?php echo $isi;?></textarea>
						</div>
					</div>
					
						<div class="col-sm-12">
							<button type="submit" class="btn btn-blue">Update</button>	
						</div>
						
					</div>
				</form>
			
			</div>

		</div>
	</div>
</div>
