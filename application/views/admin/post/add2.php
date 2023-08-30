  <script type="text/javascript" src="<?php echo base_url()."asset" ;?>/tinymce/tinymce.min.js"></script>
    <script type="text/javascript">
        tinymce.init({
            selector: "#post_content",
            theme: "modern",
            plugins: [ 
			"advlist autolink link image lists charmap print preview hr anchor pagebreak fullscreen", 
			"searchreplace wordcount visualblocks visualchars code insertdatetime media nonbreaking", 
			"table contextmenu directionality emoticons paste textcolor filemanager" 
			], 
			image_advtab: true, 
			toolbar: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect forecolor backcolor | link unlink anchor | image media | print preview code"
			 });

       
    </script>
<ol class="breadcrumb bc-3">
	<li>
		<a href="<?php echo base_url();?>admin"><i class="entypo-home"></i>Home</a>
	</li>
	<li>	
		<a href="<?php echo base_url();?>manage_post">Post</a>
	</li>
	<li class="active">		
		<strong>Add</strong>
	</li>
</ol>
<h2>Add New Post</h2>
<style>
.ms-container .ms-list {
	width: 135px;
	height: 205px;
}

.post-save-changes {
	float: right;
}

@media screen and (max-width: 789px)
{
	.post-save-changes {
		float: none;
		margin-bottom: 20px;
	}
}
</style>
<?php if (!empty($message)) echo "
				<div class='alert alert-$message_type'>$message</div>";?>
<form method="post" role="form" enctype="multipart/form-data">
	
	<!-- Title and Publish Buttons -->	
	<div class="row">
		<div class="col-sm-2 post-save-changes">
			<button type="submit" class="btn btn-green btn-lg btn-block btn-icon">
				Submit
				<i class="entypo-check"></i>
			</button>
		</div>
		
		<div class="col-sm-10">
			<input type="text" class="form-control input-lg" id="title" name="title" placeholder="Post title" />
		</div>
	</div>
	<div class="row">
		<br>
		
		<div class="col-sm-10" style='text-align:left'>
			<p ><?php echo base_url();?>post/<label id='slug'></label></p>
			<input type="hidden"  name="title_slug" id="title_slug" />
		</div>
		
	</div>
	<br />
	
	<!-- WYSIWYG - Content Editor -->	<div class="row">
		<div class="col-sm-12">
			<textarea class="form-control " rows="18" name="content" id="post_content"></textarea>
		</div>
	</div>
	
	<br />
	
	<!-- Metaboxes -->	<div class="row">
		
		
		<!-- Metabox :: Publish Settings -->		<div class="col-sm-4">
			
			<div class="panel panel-primary" data-collapsed="0">
		
				<div class="panel-heading">
					<div class="panel-title">
						Publish Settings
					</div>
					
					<div class="panel-options">
						<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
					</div>
				</div>
				
				<div class="panel-body">
					
					
					<br />
			
					<p>Date</p>
					<div class="input-group">
						<input type="text" name='date' class="form-control datepicker" value="<?php echo date('D, d F Y');?>" data-format="D, dd MM yyyy">
						
						<div class="input-group-addon">
							<a href="#"><i class="entypo-calendar"></i></a>
						</div>
					</div>
					<br>
					<p>Time</p>
							<div class="input-group minimal">
								<div class="input-group-addon">
									<i class="entypo-clock"></i>
								</div>
								<input type="text" name='time' value="<?php echo date('h:i:s');?>" class="form-control" />
							</div>
					<br>
						
					<p>Post Status</p>
					<select name="post_status" class="selectboxit">
						<optgroup label="Post Status">
							<option value="Publish">Publish</option>
							<option value="Draft">Draft</option>
						</optgroup>
					</select>
					
				</div>
			
			</div>
			
		</div>
		<!-- Metabox :: Featured Image -->		<div class="col-sm-4">
			
			<div class="panel panel-primary" data-collapsed="0">
		
				<div class="panel-heading">
					<div class="panel-title">
						Featured Image
					</div>
					
					<div class="panel-options">
						<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
					</div>
				</div>
				
				<div class="panel-body">
					
					<div class="fileinput fileinput-new" data-provides="fileinput">
						<?php if (!empty($error)) echo "
						<div class='alert alert-danger'>$error</div>";?>
						<div class="fileinput-new thumbnail" style="max-width: 310px; height: 160px;" data-trigger="fileinput">
							<img src="<?php echo base_url();?>/data/images/sys/f-img.png" alt="...">
						</div>
						<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 320px; max-height: 160px"></div>
						<div>
							<span class="btn btn-white btn-file">
								<span class="fileinput-new">Select image</span>
								<span class="fileinput-exists">Change</span>
								<input type="file" name="userfile" accept="image/*">
							</span>
							<a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput">Remove</a>
						</div>

					</div>
					
				</div>
			
			</div>
			
		</div>
		
		
		<!-- Metabox :: Categories -->		<div class="col-sm-4">
			
			<div class="panel panel-primary" data-collapsed="0">
		
				<div class="panel-heading">
					<div class="panel-title">
						Tags and Category
					</div>
					
					<div class="panel-options">
						<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
					</div>
				</div>
				
				<div class="panel-body">
					<p>Tags</p>
					<input type='hidden' id='tag_post' name='tag' value='' />
					<select name="tags" class="select2" multiple onChange='setTag()'>
						<?php 
							foreach ($tags as $row) {
								echo "<option value='$row->tag_id' >$row->tag_name</option>";
							}
						?>
					</select>
					<br>
					<p>Category</p>
					<select name="category_id" class="selectboxit" >
					<option value=''></option>
					<optgroup label="Category">
						<option value='-1'>::Internal::</option>
						<?php 
							foreach ($categories as $row) {
								echo "<option value='$row->category_id' >$row->category_name</option>";
							}
						?>
					</optgroup>
					</select>
					<br>
					<p>Channel</p>
					<select name="channel_id" class="selectboxit" >
						<?php 
							foreach ($channel as $row) {
								echo "<option value='$row->channel_id' >$row->channel_name</option>";
							}
						?>
					</select>
					
					
				</div>
			
			</div>
			
		</div>
		
		
		
	</div>
	
</form>

<link rel="stylesheet" href="<?php echo base_url()."asset/neon/neon-admin/" ;?>assets/js/wysihtml5/bootstrap-wysihtml5.css">
<link rel="stylesheet" href="<?php echo base_url()."asset/neon/neon-admin/" ;?>assets/js/selectboxit/jquery.selectBoxIt.css">

<script src="<?php echo base_url()."asset/neon/neon-admin/" ;?>assets/js/wysihtml5/wysihtml5-0.4.0pre.min.js"></script>
<script src="<?php echo base_url()."asset/neon/neon-admin/" ;?>assets/js/wysihtml5/bootstrap-wysihtml5.js"></script>
<script src="<?php echo base_url()."asset/neon/neon-admin/" ;?>assets/js/jquery.multi-select.js"></script>
<script src="<?php echo base_url()."asset/neon/neon-admin/" ;?>assets/js/fileinput.js"></script>

<script type="text/javascript">
$('#title').on('input', function() {
    var permalink;
    // Trim empty space
    permalink = $.trim($(this).val());
    // replace more then 1 space with only one
    permalink = permalink.replace(/\s+/g,' ');
    $('#title_slug').val(permalink.toLowerCase());
    $('#title_slug').val($('#title_slug').val().replace(/\W/g, ' '));
    $('#title_slug').val($.trim($('#title_slug').val()));
    $('#title_slug').val($('#title_slug').val().replace(/\s+/g, '-'));
    var gappermalink = $('#title_slug').val();
    $('#slug').html(gappermalink);
});

function setTag()
{

	var tagHtml = $('.select2-choices').html();
	$("#tag_post").val(tagHtml);
}
</script>