<div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Edit Kategori</h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                   
                        <ol class="breadcrumb">
							<li>
								<a href="<?php echo base_url();?>admin"><i class="entypo-home"></i>Home</a>
							</li>
							<li>	
								<a href="<?php echo base_url();?>manage_category">Kategori</a>
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
				<form role="form" class="form-horizontal " method='post' enctype="multipart/form-data">
					
					<div class="form-group">
						<label class="col-sm-2 control-label">Category</label>
						<div class="col-sm-5">
							<input type='hidden'  value='<?php echo $category_name;?>'  name='old_category' />
							<input type="text" id='category_name' value='<?php echo $category_name;?>' class="form-control" name='category_name' placeholder="">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label"></label>
						<div class="col-sm-5">
							<p ><?php echo base_url();?>category/<label id='slug'><?php echo $category_slug;?></label></p>
							<input type="hidden" value='<?php echo $category_slug;?>' class="form-control" id='category_slug' name='category_slug' placeholder="">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">Status</label>
						
						<div class="col-sm-2">
							
							<select name="category_status" class="form-control" data-first-option="false">
								<option>Pilih</option>
								<?php
									if ($category_status=="Active"){
										echo "
											<option value='Active' selected>Aktif</option>
											<option value='Not Active'>Nonaktif</option>
										";
									}
									else{
										echo "
											<option value='Active' >Aktif</option>
											<option value='Not Active' selected>Nonaktif</option>
										";
									}
								?>
							</select>
						</div>
					</div>
					
					<div class="form-group">
						<div class="col-sm-2"></div>
						<div class="col-sm-5">
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


<script type="text/javascript">
$('#category_name').on('input', function() {
    var permalink;
    // Trim empty space
    permalink = $.trim($(this).val());
    // replace more then 1 space with only one
    permalink = permalink.replace(/\s+/g,' ');
    $('#category_slug').val(permalink.toLowerCase());
    $('#category_slug').val($('#category_slug').val().replace(/\W/g, ' '));
    $('#category_slug').val($.trim($('#category_slug').val()));
    $('#category_slug').val($('#category_slug').val().replace(/\s+/g, '-'));
    var gappermalink = $('#category_slug').val();
    $('#slug').html(gappermalink);
});
</script>
