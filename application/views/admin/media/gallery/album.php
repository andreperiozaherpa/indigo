<ol class="breadcrumb bc-3" >
	<li>
		<a href="<?php echo base_url();?>admin"><i class="entypo-home"></i>Home</a>
	</li>
	<li>	
		<a href="<?php echo base_url();?>manage_media/gallery">Gallery</a>
	</li>
	<li class="active">		
		<strong>Album</strong>
	</li>
</ol>
<script type="text/javascript">
jQuery(document).ready(function($)
{
	$(".gallery-env").on("click", ".image-thumb .image-options a.delete", function(ev)
	{
		ev.preventDefault();
		
		
		var $image = $(this).closest('[data-tag]');
			
		var t = new TimelineLite({
			onComplete: function()
			{
				$image.slideUp(function()
				{
					$image.remove();
				});
			}
		});
		
		$image.addClass('no-animation');
		
		t.append( TweenMax.to($image, .2, {css: {scale: 0.95}}) );
		t.append( TweenMax.to($image, .5, {css: {autoAlpha: 0, transform: "translateX(100px) scale(.95)"}}) );
		
	}).on("click", ".image-thumb .image-options a.edit", function(ev)
	{
		ev.preventDefault();
		
		// This will open sample modal
		$("#album-image-options").modal('show');
		
		// Sample Crop Instance
		var image_to_crop = $("#album-image-options img"),
			img_load = new Image();
		
		img_load.src = image_to_crop.attr('src');
		img_load.onload = function()
		{
			if(image_to_crop.data('loaded'))
				return false;
				
			image_to_crop.data('loaded', true);
			
			image_to_crop.Jcrop({
				//boxWidth: $("#album-image-options").outerWidth(),
				boxWidth: 580,
				boxHeight: 385,
				onSelect: function(cords)
				{
					// you can use these vars to save cropping of the image coordinates
					var h = cords.h,
						w = cords.w,
						
						x1 = cords.x,
						x2 = cords.x2,
						
						y1 = cords.w,
						y2 = cords.y2;
					
				}
			}, function()
			{
				var jcrop = this;
				
				jcrop.animateTo([600, 400, 100, 150]);
			});
		}
	});
	
	
	// Sample Filtering
	var all_items = $("div[data-tag]"),
		categories_links = $(".image-categories a");
	
	categories_links.click(function(ev)
	{
		ev.preventDefault();
		
		var $this = $(this),
			filter = $this.data('filter');
		
		categories_links.removeClass('active');
		$this.addClass('active');
		
		all_items.addClass('not-in-filter').filter('[data-tag="' + filter + '"]').removeClass('not-in-filter');
		
		if(filter == 'all' || filter == '*')
		{
			all_items.removeClass('not-in-filter');
			return;
		}
	});
	
});
</script>

<div class="gallery-env">

	<div class="row">
	
		<div class="col-sm-12">
			
			<h3>
				<?php echo $album_title;
				if ($album_id!="untitled"){
				?>
				&nbsp;
				<a href="<?php echo base_url()."manage_media/edit_album/$album_id?ref=album";?>" class="btn btn-default btn-sm btn-icon icon-left">
					<i class="entypo-cog"></i>
					Edit Album
				</a>
				<?php } ?>
			</h3>
			
			<hr />
			
			<div class="image-categories">
				<span>Filter Images:</span>
				<a href="#" class="active" data-filter="all">Show All</a> /
				<a href="#" data-filter="jpg">JPG</a> /
				<a href="#" data-filter="png">PNG</a> /
				<a href="#" data-filter="jpeg">JPEG</a> /
				<a href="#" data-filter="gif">GIF</a> /
			</div>
		</div>
	
	</div>
	<div class="row" id='gallery'>
		<?php
		$dir = "data/upload";
		if ($album_id=="untitled"){
			$files = scandir($dir,1);
			$files2 = array();
			$x = 0;
			foreach ($query as $row) {
				$files2[$x]	= $row->picture;
				$x++;
			}
			
			foreach ($files as $file) {
				$cek = (array_search($file, $files2) === false ) ? TRUE : FALSE;
				if ($cek){
					$explode_file = explode(".", $file);
					$count = count($explode_file);
					if ($count>0) 
						$ext	= $explode_file[$count-1];
					else
						$ext 	= "";
					$img = base_url().$dir."/".$file;
					if ($ext=="jpg" || $ext=="png" || $ext=="gif" || $ext=="jpeg"){
					echo"
						<div class='col-sm-2 col-xs-4' data-tag='$ext'>
				
							<article class='image-thumb'>
								
								<a href='#' class='image'>
									<img src='$img' />
								</a>
								
								<div class='image-options'>
									<a href='#' onclick='jQuery(\"#confirm\").modal(\"show\");delete_(\"$album_id\",\"$file\")'><i class='entypo-cancel'></i></a>
								</div>
								
							</article>
						
						</div>
					";
					}
				}
				
			}
		}
		else{
			foreach ($query as $row) {
				$explode_file = explode(".", $row->picture);
					$count = count($explode_file);
					if ($count>0) 
						$ext	= $explode_file[$count-1];
					else
						$ext 	= "";
					$img = base_url().$dir."/".$row->picture;
					if ($ext=="jpg" || $ext=="png" || $ext=="gif" || $ext=="jpeg"){
					echo"
						<div class='col-sm-2 col-xs-4' data-tag='$ext'>
				
							<article class='image-thumb'>
								
								<a href='#' class='image'>
									<img src='$img' />
								</a>
								
								<div class='image-options'>
									
									<a href='#' onclick='jQuery(\"#confirm\").modal(\"show\");delete_(\"$album_id\",\"$row->picture\")'><i class='entypo-cancel'></i></a>
								</div>
								
							</article>
						
						</div>
					";
					}
				}
		}
		?>
	</div>
	<h3>
		Upload More Images
		</h3>

<br />

	<form id="upload" method="post" action="<?php echo base_url()."manage_media/upload/$album_id" ;?>" enctype="multipart/form-data">
			<div id="drop">
				Drop Here

				<a>Browse</a>
				<input type="file" name="upl" multiple />
			</div>

			<ul>
				<!-- The file uploads will be shown here -->
			</ul>

		</form>


<script type="text/javascript">
	function delete_(album_id,picture)
	{
		$('#confirm_title').html('Confirmation');
		$('#confirm_content').html('Are you sure want to delete it?');
		$('#confirm_btn').html('Delete');
		$('#confirm_btn').attr('href',"<?php echo base_url();?>manage_media/delete_gallery/"+album_id+"/"+picture);
	}
	function update_gallery()
	{
		$.post("<?php echo base_url().'manage_media/update_gallery/'.$album_id;?>",{},function(obj){
			$("#gallery").html(obj);
		});
	}
</script>
		<link rel="stylesheet" href="<?php echo base_url();?>asset/uploader/assets/css/style.css">

		<script src="<?php echo base_url();?>asset/uploader/assets/js/jquery.knob.js"></script>


		<script src="<?php echo base_url();?>asset/uploader/assets/js/jquery.ui.widget.js"></script>
		<script src="<?php echo base_url();?>asset/uploader/assets/js/jquery.iframe-transport.js"></script>
		<script src="<?php echo base_url();?>asset/uploader/assets/js/jquery.fileupload.js"></script>
		
	
		<script src="<?php echo base_url();?>asset/uploader/assets/js/script.js"></script>
