


<script type="text/javascript" src="<?php echo base_url()."asset" ;?>/tinymce/tinymce.min.js"></script>
    <script type="text/javascript">
        tinymce.init({
            selector: "#txt2",
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

    <script type="text/javascript">
        tinymce.init({
            selector: "#txt1",
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


    <script type="text/javascript">
        tinymce.init({
            selector: "#txt3",
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

    <script type="text/javascript">
        tinymce.init({
            selector: "#txt4",
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
								<a href="<?php echo base_url();?>manage_menu">Menu</a>
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
						<label class="col-sm-2 control-label">Nama Menu</label>
						<div class="col-sm-5">
							<input type="text" name='menu' value="<?php echo $menu;?>" class="form-control">
						</div>
					</div>



<div class="form-group">
						<label class="col-sm-2 control-label">Parent Menu</label>
						<div class="col-sm-5">
							<select class="form-control" name="parent_id">
								<option value="0">-Menu Utama-</option>

								<?php foreach ($datamenu as $row) {  $selected =""?>
								<?php if ($parent_id == $row->id_menu) $selected ="selected";?>
									<option value="<?php echo $row->id_menu;?>" <?php echo $selected; ?> ><?php echo $row->menu; ?></option>
								<?php } ?>
							</select>
						</div>
				</div>

		<div class="form-group">
						<label class="col-sm-2 control-label">Posisi Menu ke</label>
						<div class="col-sm-5">
							<input type="text" name='menu_order' value="<?php echo $menu_order;?>" class="form-control">
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 control-label">Link</label>
						<div class="col-sm-5">
							<input type="text" name='link' value="<?php echo $link;?>" class="form-control">
							<p>*<b>nama_controller/function/url_unik</b></p>
							<p> contoh : <code>link/detail/menu1</code> <code>link/external?target=http://google.com</code></p>
						</div>
					</div>

          <div class="form-group">
						<label class="col-sm-2 control-label">Isi Menu</label>


							<div class="col-sm-5">
							<textarea class="form-control " rows="2" name="isi_menu" id="txt1"><?php echo $isi_menu;?></textarea>

						</div>

					</div>



						<div class="col-sm-7">
							 <button type="submit" class="btn btn-success waves-effect waves-light pull-right" type="button"><span class="btn-label"><i class="fa fa-plus"></i></span>Save</button>

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


<link rel="stylesheet" href="<?php echo base_url()."asset/neon/neon-admin/" ;?>assets/js/wysihtml5/bootstrap-wysihtml5.css">
<link rel="stylesheet" href="<?php echo base_url()."asset/neon/neon-admin/" ;?>assets/js/selectboxit/jquery.selectBoxIt.css">

<script src="<?php echo base_url()."asset/neon/neon-admin/" ;?>assets/js/wysihtml5/wysihtml5-0.4.0pre.min.js"></script>
<script src="<?php echo base_url()."asset/neon/neon-admin/" ;?>assets/js/wysihtml5/bootstrap-wysihtml5.js"></script>
<script src="<?php echo base_url()."asset/neon/neon-admin/" ;?>assets/js/jquery.multi-select.js"></script>
<script src="<?php echo base_url()."asset/neon/neon-admin/" ;?>assets/js/fileinput.js"></script>
