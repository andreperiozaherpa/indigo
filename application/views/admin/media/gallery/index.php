
<div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">All Gallery</h4>
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
								<strong>All</strong>
							</li>
                        </ol>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- .row -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="white-box">


<script type="text/javascript">
jQuery(document).ready(function($)
{
	// Handle the Change Cover
	$(".gallery-env").on("click", ".album header .album-options", function(ev)
	{
		ev.preventDefault();
		
		// Sample Modal
		$("#album-cover-options").modal('show');
		
		// Sample Crop Instance
		var image_to_crop = $("#album-cover-options .croppable-image img"),
			img_load = new Image();
		
		img_load.src = image_to_crop.attr('src');
		img_load.onload = function()
		{
			if(image_to_crop.data('loaded'))
				return false;
				
			image_to_crop.data('loaded', true);
			
			image_to_crop.Jcrop({
				boxWidth: 410,
				boxHeight: 265,
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
				
				jcrop.animateTo([800, 600, 150, 50]);
			});
		}
	});
});
</script>

<div class="gallery-env">
	<div class="row">
		<div class='col-sm-12'>
			<h3 class="box-title"><a href="<?php echo base_url();?>manage_media/create_album" class="btn btn-success btn-sm waves-effect waves-light" type="button"><span class="btn-label"><i class="fa fa-plus"></i></span>Add Album</a></h3> <br>
		</div>
		<br>
	</div>
	<div class="row">
<?php 
	foreach ($query as $row) {
	$picture = $row->picture;
	echo"		
		<div class='col-sm-4'>
			
			<article class='album'>
				
				<header>
					
					<a href='".base_url()."	manage_media/album/$row->album_id'>
						<img src='".base_url()."data/images/album/$picture' / width='400px' >
					</a>
					
				</header>
				
				<section class='album-info'>
					<h3><a href='".base_url()."manage_media/album/$row->album_id'>$row->album_title</a></h3>
					
					<p>$row->description</p>
				</section>
				
				<footer>
					
					<div class='album-images-count'>
						<i class='entypo-picture'></i>
						$row->pict_count
					</div>
					
					<div class='album-options'>
						<a href='".base_url()."manage_media/edit_album/$row->album_id'>
							<i class='entypo-pencil'></i>
						</a>
						
						<a href='#' onclick='jQuery(\"#confirm\").modal(\"show\");delete_(\"$row->album_id\")'>
							<i class='entypo-trash'></i>
						</a>
					</div>
					
				</footer>
				
			</article>
			
		</div>


		";
	}
		echo 
		"
		<div class='col-sm-4'>
			
			<article class='album'>
				
				<header>
					
					<a href='".base_url()."manage_media/album/untitled'>
						<img src='".base_url()."data/images/album/album.jpg' />
					</a>
					
				</header>
				
				<section class='album-info'>
					<h3><a href='".base_url()."manage_media/album/untitled'>Untitled</a></h3>
					
					<p>Untitled album</p>
				</section>
				
				
				
			</article>
			
		</div>
		";
		?>
	</div>
</div>



                        </div>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
<script type="text/javascript">
	function delete_(id)
	{
		$('#confirm_title').html('Confirmation');
		$('#confirm_content').html('Are you sure want to delete it?');
		$('#confirm_btn').html('Delete');
		$('#confirm_btn').attr('href',"<?php echo base_url();?>manage_media/delete_album/"+id);
	}
</script>