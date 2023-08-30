
            <div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Edit Berita</h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

                        <ol class="breadcrumb">
                            <li>
                                <a href="<?php echo base_url();?>admin"><i class="entypo-home"></i>Home</a>
                            </li>
                            <li>
                                <a href="<?php echo base_url();?>manage_post">Berita</a>
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



<script type="text/javascript" src="<?php echo base_url()."asset" ;?>/tinymce4x/tinymce/tinymce.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url()."asset" ;?>/tinymce4x/tinymce/plugins/codesample/prism.css">
<script src="<?php echo base_url()."asset" ;?>/tinymce4x/tinymce/plugins/codesample/prism.js"></script>
    <script type="text/javascript">
        tinymce.init({
            selector: "#post_content",
            theme: "modern",
            plugins: [
            "advlist autolink link image lists charmap print preview hr anchor pagebreak",
            "searchreplace wordcount visualblocks visualchars code insertdatetime media nonbreaking",
            "table contextmenu directionality emoticons paste textcolor filemanager codesample ",

            ],
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

            toolbar: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect forecolor backcolor | link unlink anchor | image media | print preview code codesample"
             });
    </script>
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

                            <?php if (!empty($message)) echo "<div class='alert alert-$message_type'>$message</div>";?>
                            <form method="post" role="form" enctype="multipart/form-data">
                                
                                <!-- Title and Publish Buttons -->  
                                <div class="row">
                                    <div class="col-sm-2 post-save-changes">
                                        <button type="submit" class="btn btn-primary waves-effect waves-light pull-right" type="button"><span class="btn-label"><i class="fa fa-check"></i></span>Perbarui</button>
                                    </div>
                                    
                                    <div class="col-sm-10">
                                        <input type="text" onchange="getSlug()" class="form-control input-lg" value='<?php echo set_value('title',$post_title); ?>' id="permalink" name="title" placeholder="Post title" />
                                    </div>
                                </div>
                                <div class="row">
                                    <br>
                                    
                                    <div class="col-sm-10" style='text-align:left'>
                                        <p ><?php echo base_url();?>post/<label id='slug'><?php echo $title_slug;?></label></p>
                                        <input type="hidden"  name="title_slug" id="title_slug" value='
                                           <?php echo set_value('title_slug',$title_slug); ?>' />
                                        <input type="hidden"  name="old_title_slug" id="old_title_slug" value='
                                           <?php echo set_value('old_title_slug',$title_slug); ?>' />
                                    </div>
                                    
                                </div>
                                <br />
                                
                                <!-- WYSIWYG - Content Editor -->   <div class="row">
                                    <div class="col-sm-12">
                                        <textarea class="form-control" rows="18" name="content" id="post_content">
                                           <?php echo set_value('content',$post_content); ?>
                                        </textarea>
                                    </div>
                                </div>
                                
                                <br />
                                
                                <!-- Metaboxes -->  <div class="row">
                                    
                                    
                                    <!-- Metabox :: Publish Settings -->        <div class="col-sm-4">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">Pengaturan Publikasi
                                            <div class="panel-action"><a href="#" data-perform="panel-collapse"><i class="ti-minus"></i></a></div>
                                        </div>
                                        <div class="panel-wrapper collapse in" aria-expanded="true" style="">
                                            <div class="panel-body">
                                                <p>Tanggal</p>
                                                <div class="input-group">
                                                    <input type="text" name='date' class="form-control mydatepicker" value="<?php echo date('Y-m-d',strtotime($date));?>" data-format="yyyy-mm-dd">
                                                    
                                                    <div class="input-group-addon">
                                                        <a href="#"><i class="entypo-calendar"></i></a>
                                                    </div>
                                                </div>
                                                <br>
                                                <p>Waktu</p>
                                                        <div class="input-group minimal">
                                                            <div class="input-group-addon">
                                                                <i class="entypo-clock"></i>
                                                            </div>
                                                            <input type="text" name='time' value="<?php echo $time;?>" class="form-control clockpicker"  data-autoclose="true" />
                                                        </div>
                                                <br>
                                                    
                                                <p>Status Berita</p>
                                                <select name="post_status" class="selectpicker">
                                                    <optgroup label="Status Berita">
                                                        <?php
                                                            if ($post_status=="Publish"){
                                                                echo"
                                                                    <option value='Publish' selected>Publikasi</option>
                                                                    <option value='Draft'>Draf</option>
                                                                ";
                                                            }
                                                            else if ($post_status=="Draft"){
                                                                echo"
                                                                    <option value='Publish'>Publikasi</option>
                                                                    <option value='Draft' selected>Draft</option>
                                                                ";
                                                            }
                                                            

                                                        ?>
                                                        
                                                    </optgroup>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                        
                                    </div>
                                    <!-- Metabox :: Featured Image -->      <div class="col-sm-4">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">Gambar Fitur
                                            <div class="panel-action"><a href="#" data-perform="panel-collapse"><i class="ti-minus"></i></a></div>
                                        </div>
                                        <div class="panel-wrapper collapse in" aria-expanded="true" style="">
                                            <div class="panel-body">
                                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                                    <?php 
                                                    if ($picture=="") $picture="sys/f-img.png";
                                                    else $picture ="featured_image/$picture";
                                                    if (!empty($error)) echo "
                                                    <div class='alert alert-danger'>$error</div>";?>
                                                    <input type="file" name="userfile" accept="image/*" id="input-file-now-custom-3" class="dropify" data-height="160px" data-default-file="<?php echo base_url()."data/images/$picture";?>">
                                                    

                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    </div>
                                    
                                    
                                    <!-- Metabox :: Categories -->      <div class="col-sm-4">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">Tag dan Kategori
                                            <div class="panel-action"><a href="#" data-perform="panel-collapse"><i class="ti-minus"></i></a></div>
                                        </div>
                                        <div class="panel-wrapper collapse in" aria-expanded="true" style="">
                                            <div class="panel-body">
                                                <p>Kategori</p>
                                                <select name="category_id" class="form-control select2" >
                                                <option value='Pilih Kategori'></option>
                                                    <?php 
                                                        $selected_ = "selected";
                                                        if ($category_id == -1) $selected_ ="selected";
                                                        foreach ($categories as $row) {
                                                            $selected = "";
                                                            if ($category_id == $row->category_id) $selected ="selected";
                                                            echo "<option value='$row->category_id' $selected>$row->category_name</option>";
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        
                                    </div>
                                        
                                    </div>
                                    
                                    
                                    
                                </div>
                                
                            </form>




                        </div>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->


<script type="text/javascript">
function getSlug(){
    var permalink;
    // Trim empty space
    permalink = $.trim($('#permalink').val());
    // replace more then 1 space with only one
    permalink = permalink.replace(/\s+/g,' ');
    // alert(permalink);
    $('#title_slug').val(permalink.toLowerCase());
    $('#title_slug').val($('#title_slug').val().replace(/\W/g, ' '));
    $('#title_slug').val($.trim($('#title_slug').val()));
    $('#title_slug').val($('#title_slug').val().replace(/\s+/g, '-'));
    var gappermalink = $('#title_slug').val();
    $('#slug').html(gappermalink);
};

function setTag()
{

    var tagHtml = $('.select2-choices').html();
    $("#tag_post").val(tagHtml);
}

</script>