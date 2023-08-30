
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

                            <?php if (!empty($message)) echo "<div class='alert alert-$message_type'>$message</div>";?>
                            <form method="post" role="form" enctype="multipart/form-data">
                            <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>" />
                                <!-- Title and Publish Buttons -->  
                                <div class="row">
                                    
                                    <div class="col-sm-10">
                                        <input type="text" onchange="getSlug()" class="form-control input-lg" value='<?php echo set_value('title',$post_title); ?>' id="permalink" name="title" placeholder="Post title" />
                                    </div>
                                    <!-- <div class="col-sm-2 post-save-changes">
                                        <button type="submit" class="btn btn-primary waves-effect waves-light pull-right" type="button"><span class="btn-label"><i class="fa fa-check"></i></span>Perbarui</button>
                                    </div> -->
                                </div>
                                <div class="row">
                                    <br>
                                    
                                    <div class="col-sm-10" style='text-align:left'>
                                        <p ><?php echo base_tahu();?>berita/detail/<label id='slug'><?php echo $title_slug;?></label></p>
                                        <input type="hidden"  name="title_slug" id="title_slug" value='
                                           <?php echo set_value('title_slug',$title_slug); ?>' />
                                        <input type="hidden"  name="old_title_slug" id="old_title_slug" value='
                                           <?php echo set_value('old_title_slug',$title_slug); ?>' />
                                    </div>
                                    
                                </div>
                                <br />
                                
                                <!-- WYSIWYG - Content Editor -->   <div class="row">
                                    <div class="col-sm-12">
                                        <textarea name="content" id="post_manager" cols="30" rows="30"><?=$post_content?></textarea>
                                    </div>
                                </div>
                                
                                <br />
                                
                                <!-- Metaboxes -->  <div class="row">
                                    
                                    
                                    <!-- Metabox :: Publish Settings -->
                                           <!-- <div class="col-sm-4">
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
                                                                    <option value='Draft' disabled>Draft</option>
                                                                ";
                                                            }
                                                            else if ($post_status=="Draft"){
                                                                echo"
                                                                    <option value='Publish' disabled>Publikasi</option>
                                                                    <option value='Draft' selected>Draft</option>
                                                                ";
                                                            }
                                                            

                                                        ?>
                                                        
                                                    </optgroup>
                                                </select>
                                            </div>
                                        </div>
                                    </div> -->
                                        
                                    </div>
                                    <!-- Metabox :: Featured Image -->      <div class="col-sm-4">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">Thumbnail
                                            <div class="panel-action"><a href="#" data-perform="panel-collapse"><i class="ti-minus"></i></a></div>
                                        </div>
                                        <div class="panel-wrapper collapse in" aria-expanded="true" style="">
                                            <div class="panel-body">
                                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                                    <?php 
                                                    if ($picture=="") $picture="sys/f-img.png";
                                                    else $picture ="featured_image/uploads/$picture";
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
                                    <br>
                                        <button type="submit" class="btn btn-primary waves-effect waves-light pull-right" type="button"><span class="btn-label"><i class="fa fa-check"></i></span>Perbarui</button>
                                        
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