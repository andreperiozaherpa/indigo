<ol class="breadcrumb bc-3" >
	<li>
		<a href="<?php echo base_url();?>admin"><i class="entypo-home"></i>Home</a>
	</li>
	<li>	
		<a href="<?php echo base_url();?>manage_media/gallery">Gallery</a>
	</li>
	<li class="active">		
		<strong>Edit Album</strong>
	</li>
</ol>


<div class="row">
	<div class="col-md-12">
		
		<div class="panel panel-primary" data-collapsed="0">
		
			<div class="panel-heading">
				<div class="panel-title">
					Edit Album
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
						<label class="col-sm-2 control-label">Title</label>
						<div class="col-sm-5">
							<input type="text" value='<?php echo $album_title;?>' class="form-control" name='album_title' placeholder="">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">Description</label>
						<div class="col-sm-5">
							<input type="text" value='<?php echo $album_description;?>' class="form-control" name='description' placeholder="">
						</div>
					</div>
					
					
					<div class="form-group">
						<label class="col-sm-2 control-label">Cover Image</label>
						
						<div class="col-sm-5">
							<?php echo"
							<div class='member-img'>
								<img src='".base_url()."data/images/album/$album_picture' class='img-rounded' style='max-width:200px' />
								
							</div><br>
							";?>
							<input type="file" name='userfile' class="form-control file2 inline btn btn-primary" data-label="<i class='glyphicon glyphicon-file'></i> Browse" />
							<p>
								Max : 2000 px | 2MB
							</p>
							<?php if (!empty($error)) echo "
							<div class='alert alert-danger'>$error</div>";?>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-2"></div>
						<div class="col-sm-5">
							<button type="submit" class="btn btn-blue">Update</button>
							<?php
								if (!empty($_GET['ref']) && $_GET['ref']=='album'){
									$back = base_url()."manage_media/album/$album_id";
								}
								else
								{
									$back = base_url()."manage_media/gallery";
								}
								echo "<a href='$back' class='btn btn-red'>Back</a>"
							?>
							
						</div>
						
					</div>
				</form>
			
			</div>

		</div>
	</div>
</div>
<script type="text/javascript">
$('#tag_name').on('input', function() {
    var permalink;
    // Trim empty space
    permalink = $.trim($(this).val());
    // replace more then 1 space with only one
    permalink = permalink.replace(/\s+/g,' ');
    $('#tag_slug').val(permalink.toLowerCase());
    $('#tag_slug').val($('#tag_slug').val().replace(/\W/g, ' '));
    $('#tag_slug').val($.trim($('#tag_slug').val()));
    $('#tag_slug').val($('#tag_slug').val().replace(/\s+/g, '-'));
    var gappermalink = $('#tag_slug').val();
    $('#slug').html(gappermalink);
});
</script>