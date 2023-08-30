<script type="text/javascript" src="<?php echo base_url()."asset" ;?>/tinymce4x/tinymce/tinymce.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url()."asset" ;?>/tinymce4x/tinymce/plugins/codesample/prism.css">
<script src="<?php echo base_url()."asset" ;?>/tinymce4x/tinymce/plugins/codesample/prism.js"></script>
    <script type="text/javascript">
        tinymce.init({
            selector: "#post_content",
            theme: "modern",
            codesample_dialog_width: '400',
            codesample_dialog_height: '400',
            codesample_languages: [
                {text: 'HTML/XML', value: 'markup'},
                {text: 'JavaScript', value: 'javascript'},
                {text: 'CSS', value: 'css'},
                {text: 'PHP', value: 'php'},
                {text: 'Ruby', value: 'ruby'},
                {text: 'Python', value: 'python'},
                {text: 'Java', value: 'java'},
                {text: 'C', value: 'c'},
                {text: 'C#', value: 'csharp'},
                {text: 'C++', value: 'cpp'}
            ],
            image_advtab: true,
            image_title: true, 
            automatic_uploads: true,
            theme_advanced_buttons1 : "openmanager",
            file_browser_callback_types: 'file image media',

file_browser_callback: function(field_id, url, type, win, editor) { 
            
                // from http://andylangton.co.uk/blog/development/get-viewport-size-width-and-height-javascript
                var w = window,
                d = document,
                e = d.documentElement,
                g = d.getElementsByTagName('body')[0],
                x = w.innerWidth || e.clientWidth || g.clientWidth,
                y = w.innerHeight|| e.clientHeight|| g.clientHeight;

            if(type == 'image') {           
                type_id = "1";
            } else if(type == 'file') {           
                type_id = "2";
            } else if(type == 'media') {           
                type_id = "3";
            } else {           
                type_id = "0";
            }

            var cmsURL = '<?php echo base_url()?>asset/tinymce/plugins/filemanager/dialog.php?type='+type_id+'&field_id='+field_id+'&relative_url=1&lang='+tinymce.settings.language + '&subfolder=' + tinymce.settings.subfolder;
        
            tinyMCE.activeEditor.windowManager.open({
                file : cmsURL,
                title: 'File Manager',
                filetype: 'all',
                classes: 'filemanager',
                inline: "yes",
                width : x * 0.8,
                height : y * 0.8,
                resizable : "yes",
                close_previous : "no"
            });  
        },
             });
    </script>

    <div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Edit Berkas E-Modul</h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                   
                        <ol class="breadcrumb">
							<li>
								<a href="<?php echo base_url();?>admin"><i class="entypo-home"></i>Home</a>
							</li>
							<li>	
								<a href="<?php echo base_url();?>manage_media/download">E-Modul</a>
							</li>
							<li class="active">		
								<strong>Ubah</strong>
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
						<label class="col-sm-2 control-label">Judul</label>
						<div class="col-sm-5">
							<input type="text" class="form-control" name='judul' value='<?php echo $judul;?>' placeholder="">
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 control-label">Kategori</label>
						<div class="col-sm-5">
							<select name="category_id" class="form-control">
								<?php foreach($category as $k){ 
									if($k->category_id==$category_id){
										$selected = ' selected';
									}else{
										$selected = '';
									}
								?>
								<option value="<?=$k->category_id?>"<?php echo $selected?>><?=$k->category_name?></option>
								<?php } ?>
							</select>
				<?php if (!empty($message_file)) echo "
				<div class='alert alert-warning'>$message_file</div>";?>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 control-label">Link E-Modul</label>
						<div class="col-sm-5">
							<input type="text" class="form-control" name='link' value="<?php echo $link?>" placeholder="">
						</div>
					</div>
					
					
					<div class="form-group">
						<label class="col-sm-2 control-label">Cover E-Modul</label>
						
						<div class="col-sm-5">
							<?php echo"
							<div class='member-img'>
								$nama_file
							</div><br>							";?>
							<input type="file" name='userfile' class="dropify" id="input-file-now-custom-3" data-label="<i class='glyphicon glyphicon-file'></i> Browse" data-default-file="<?php echo base_url('data/download/'.$nama_file);?>" />
							<p>
								Max : 2MB
							</p>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 control-label">Deskripsi</label>
						<div class="col-sm-8">
						
                                        <textarea class="form-control" rows="18" name="detail" id="post_content"><?php echo $detail?></textarea>
						</div>
					</div>

					<div class="form-group">
						
						<div class="col-sm-7">
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