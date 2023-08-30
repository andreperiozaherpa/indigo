
            <div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Tambah Berita</h4>
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
								<strong>Tambah</strong>
							</li>
                        </ol>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- .row -->
                <div class="row">
                    <div class="col-sm-12">
                            <?php if (!empty($message)) echo "<div class='alert alert-$message_type'>$message</div>";?>
                            <form method="post" enctype="multipart/form-data">
                                <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>" />
                                    <div class="white-box">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <input value="<?php echo set_value('title'); ?>" type="text" onkeyup="getSlug()" class="form-control input-lg" value='' id="judul" name="title" placeholder="Masukkan Judul" />
                                            </div>
                                        </div>
                                        <div class="row">
                                            <br>

                                            <div class="col-sm-10" style='text-align:left'>
                                                <p ><?php echo base_tahu();?>berita/detail/<label id='slug'></label></p>
                                                <input type="hidden" value="<?php echo set_value('title_slug'); ?>" name="title_slug" id="title_slug" value='' />
                                                <input type="hidden" value="<?php echo set_value('old_title_slug'); ?>" name="old_title_slug" id="old_title_slug" value='' />
                                            </div>

                                        </div>
                                        <br />

                                        <div class="row">
                                            <div class="col-sm-12">
                                                <textarea name="content" id="post_manager" cols="30" rows="10"><?php echo set_value('content'); ?></textarea>
                                            </div>
                                        </div>

                                        <br />
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">Thumbnail
                                                <div class="panel-action"><a href="#" data-perform="panel-collapse"><i class="ti-minus"></i></a></div>
                                            </div>
                                            <div class="panel-wrapper collapse in" aria-expanded="true" style="">
                                                <div class="panel-body">
                                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                                        <?php
                                                        $picture="sys/f-img.png";
                                                        if (!empty($error)) echo "
                                                        <div class='alert alert-danger'>$error</div>";?>
                                                        <input type="file" name="userfile" accept="image/*" id="input-file-now-custom-3" class="dropify" data-height="160px" data-default-file="<?php echo base_url()."data/images/$picture";?>">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">Kategori
                                                <div class="panel-action"><a href="#" data-perform="panel-collapse"><i class="ti-minus"></i></a></div>
                                            </div>
                                            <div class="panel-wrapper collapse in" aria-expanded="true" style="">
                                                <div class="panel-body">
                                                    <p>Kategori</p>
                                                    <select name="category_id" class="form-control select2" >
                                                    <option value=''>Pilih Kategori</option>
                                                        <?php
                                                            $selected_ = "selected";
                                                            foreach ($categories as $row) {
                                                                $selected = "";
                                                                echo "<option value='$row->category_id' $selected>$row->category_name</option>";
                                                            }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary waves-effect waves-light pull-right" type="button"><span class="btn-label"><i class="fa fa-plus"></i></span>Simpan</button>
                                    </div>
                                </form>
                            </div>
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
    permalink = $.trim($('#judul').val());
    // replace more then 1 space with only one
    permalink = permalink.replace(/\s+/g,' ');
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
