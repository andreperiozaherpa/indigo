<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Edit Kode Kegiatan</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

            <ol class="breadcrumb">
             <li>
                <a href="<?php echo base_url();?>admin"><i class="entypo-home"></i>Home</a>
            </li>
            <li>	
                <a href="<?php echo base_url();?>ref_kode">Kode Kegiatan</a>
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

                    <?php echo form_open_multipart() ?>
                    <div class="form-group">
                       <label class="control-label"> Kode Kegiatan</label>
                       <input type="text" id="firstName" value="<?php echo $data->kode ?>" name="kode" class="form-control" placeholder="">
                   </div>

                   <div class="form-group">
                       <label class="control-label"> Keterangan</label>
                       <input type="text" id="firstName" value="<?php echo $data->keterangan ?>" name="keterangan" class="form-control" placeholder="">
                   </div>





                   <div class="form-group">
                       <label class="control-label">Status </label><br>
                       Aktif 
                       <?php if($data->status == 'aktif') 
                       { 
                               $checked = "checked";
                       }
                       else 
                       {
                        $checked = "";
                    }
                    ?>

                          <input type='hidden' name='status' value='non-aktif'>
                          <input type='checkbox' name='status'  value='aktif' <?php echo $checked; ?> class='js-switch' data-color='#f96262' data-size='medium' />
                       


                </div>

                
                <div class="form-group">
                   <button type="submit" class="btn btn-success waves-effect waves-light" type="button"><span class="btn-label"><i class="fa fa-plus"></i></span>Simpan</button>
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

<script type="text/javascript">
	function ganti(){
		var type = $('#type').val();
		if(type=='lembaga'){
			$('#switch').css('display','block');
		}else{

			$('#switch').css('display','none');
		}
	}
</script>