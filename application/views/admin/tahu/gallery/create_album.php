<div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Edit Post</h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                   
                        <ol class="breadcrumb">
							<li>
								<a href="<?php echo base_url();?>admin"><i class="entypo-home"></i>Home</a>
							</li>
							<li>	
								<a href="<?php echo base_url();?>manage_media/gallery">Gallery</a>
							</li>
							<li class="active">		
								<strong>Add</strong>
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
						<label class="col-sm-2 control-label">Title</label>
						<div class="col-sm-5">
							<input type="text" class="form-control" name='album_title' placeholder="">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">Description</label>
						<div class="col-sm-5">
							<input type="text" class="form-control" name='description' placeholder="">
						</div>
					</div>
					
					
					<div class="form-group">
						<label class="col-sm-2 control-label">Cover Image</label>
						
						<div class="col-sm-5">
							
							<input type="file" name='userfile' class="form-control fileinput fileinput-new input-group" data-label="<i class='glyphicon glyphicon-file'></i> Browse" />
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
							<button type="submit" class="btn btn-blue" class="btn btn-success waves-effect waves-light pull-right">Create</button>	
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