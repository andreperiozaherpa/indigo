<style type="text/css">
    .g .gambar{
  width: 100%;
  height: 110px;
}
.g img{
  width: 100%;
  height: 100%;
  object-fit: cover;

}
</style>
<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Detail Berkas</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

            <ol class="breadcrumb">
               <li>
                <a href="<?php echo base_url();?>admin"><i class="entypo-home"></i>Home</a>
            </li>
            <li>	
                <a href="<?php echo base_url();?>manage_category_finance">Berkas</a>
            </li>
            <li class="active">		
                <strong>Detail</strong>
            </li>
        </ol>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- .row -->
<div class="row">
    <div class="col-md-3 col-xs-12">
        <div class="white-box">

            <div class="user-bg">
                <div class="overlay-box">
                    <div class="user-content">
                        <a href="javascript:void(0)"><img src="<?php echo base_url() ?>data/user_picture/<?php echo $detail->user_picture ?>" class="thumb-lg img-circle" alt="img"></a>
                        <h4 class="text-white"><?php echo $detail->full_name ?></h4>
                        <h5 class="text-white">Diinput pada <?php echo tanggal($detail->tanggal_input).' '.stime($detail->waktu_input)  ?></h5>
                    </div>
                </div>
            </div>
            <div class="user-btm-box">
                <!-- .row -->
                <div class="row text-center m-t-10">
                    <div class="col-md-6 b-r"><strong>Email</strong>
                        <p><?php echo $detail->email ?></p>
                    </div>
                    <div class="col-md-6"><strong>Telepon</strong>
                        <p><?php echo $detail->phone ?></p>
                    </div>
                </div>
                <!-- /.row -->
                <hr>
                <!-- .row -->
                <div class="row text-center m-t-10">
                    <div class="col-md-12"><strong>Alamat</strong>
                        <p><?php echo $detail->bio ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-9 col-xs-12">
        <div class="white-box">

            <div class="row">
             <div class="col-md-12">
              <div class="panel-body">

                <!-- Nav tabs -->
                <ul class="nav customtab nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#detail" aria-controls="home" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-home"></i></span><span class="hidden-xs"> Detail</span></a></li>
                    <li role="presentation" class=""><a href="#file" aria-controls="profile" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-user"></i></span> <span class="hidden-xs">Daftar File</span></a></li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active fade in" id="detail">
                        <div class="form-horizontal">
                            <div class="row">
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label class="control-label col-md-3">Unit Kerja</label>
                                    <div class="col-md-9">
                                      <p class="form-control-static"><?=$uk1_nama?></p>
                                  </div>
                              </div>
                              <div class="form-group">
                                <label class="control-label col-md-3">Sub Unit Kerja 1</label>
                                <div class="col-md-9">
                                  <p class="form-control-static"><?=$uk2_nama?></p>
                              </div>
                          </div>
                              <div class="form-group">
                                <label class="control-label col-md-3">Sub Unit Kerja 2</label>
                                <div class="col-md-9">
                                  <p class="form-control-static"><?=$uk3_nama?></p>
                              </div>
                          </div>
                              <div class="form-group">
                                <label class="control-label col-md-3">Sub Unit Kerja 3</label>
                                <div class="col-md-9">
                                  <p class="form-control-static"><?=$uk4_nama?></p>
                              </div>
                          </div>
                      </div>
                      <div class="col-md-6">
                              <div class="form-group">
                                <label class="control-label col-md-3">Nama Kegiatan</label>
                                <div class="col-md-9">
                                  <p  class="form-control-static"><?php echo $detail->nama_kegiatan ?> </p>
                              </div>
                          </div>
                              <div class="form-group">
                                <label class="control-label col-md-3">Keterangan</label>
                                <div class="col-md-9">
                                  <p  class="form-control-static"><?php echo $detail->keterangan ?> </p>
                              </div>
                          </div>
                              <div class="form-group">
                                <label class="control-label col-md-3">Tanggal Input</label>
                                <div class="col-md-9">
                                  <p  class="form-control-static"><?php echo tanggal($detail->tanggal_input) ?> </p>
                              </div>
                          </div>
                              <div class="form-group">
                                <label class="control-label col-md-3">Jam Input</label>
                                <div class="col-md-9">
                                  <p class="form-control-static"><?php echo stime($detail->waktu_input) ?> </p>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="clearfix"></div>
          </div>
          <div role="tabpanel" class="tab-pane fade" id="file">


            <div class="row el-element-overlay m-b-40">   
            <?php 
            if(empty($files)){
              ?>  
              <div style="text-align: center"> 
      <i style="font-size: 100px" data-icon="5" class="linea-icon linea-elaborate"></i>
        <h4 style="margin-top: -10px">Belum Ada File Terupload</h4>
      </div>
              <?php
            }else{
            foreach($files as $f){

            $type_file = $f->type_file;
            $type_file = explode('/', $type_file);
            $type_file = $type_file[0];
            if($type_file=='application'){
                $type = 'document';
                $ext = $f->eks_file;
                $ext = ltrim($ext, '.');
            }elseif($type_file=='image'){
                $type = 'image';
            }
             ?>                 
                <div class="g col-lg-3 col-md-4 col-sm-6 col-xs-12">
                <div class="white-box">
                <div class="el-card-item">
                <div class="el-card-avatar el-overlay-1"> 
                    <?php if($type=='document'){?>
                    <div style="margin: 20px" class="file-icon file-icon-lg" data-type="<?php echo $ext ?>"></div>
                <?php }elseif($type=='image'){ ?>
                    <div class="gambar">
                        <img src="<?php echo base_url().$f->path_file.$f->hash_file ?>">
                    </div>
                    <?php } ?>
                <div class="el-overlay">
                <ul class="el-info">
                <li><a target="blank" class="btn default btn-outline" href="<?php echo base_url()."berkas/download_file/".$f->id_berkas_file.'_'.$f->hash_file?>"><i class="icon-cloud-download"></i></a></li>
                <li><a class="btn default btn-outline" onclick="detail(<?=$f->id_berkas_file?>)" href="javascript:void(0)"><i class="icon-eye"></i></a></li>
                </ul>
                </div>
                </div>
                <div class="el-card-content"> <small><?php echo $f->nama_file ?></small>
                <br/> </div>
                </div>
                </div>
                </div>  
                <?php }
                    } ?>      
            </div>
                <div class="clearfix"></div>
            </div>
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
<div id="file_list" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel">Detail File <a href="" id="download_file" style="margin-right: 40px !important" class="btn btn-primary pull-right"><i class="icon-cloud-download"></i> Download File</a></h4> </div>
                <div class="modal-body">
              <div class="form-group">
                <label class="control-label col-md-3">Nama File : </label>
                <div class="col-md-9">
                  <p id="nama_file" class="form-control-static">  </p>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3">Waktu Upload : </label>
                <div class="col-md-9">
                  <p id="waktu_upload" class="form-control-static"> </p>
                </div>
              </div>
          <iframe id="src_file" src="" style="width:100%; height:500px;" frameborder="0">
            Memuat
          </iframe>
          <img id="src_image" class="thumbnail img-responsive" src="">
                </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</div>
<script type="text/javascript">

    function detail(id){
        // $('#daftar_file').block({
        //     message: '<i class="fa fa-circle-o-notch fa-spin"></i>',
        //     css: {
        //         border: '1px solid #fff'
        //     }
        // });
        $.ajax({
          url : "<?php echo base_url()."berkas/fetch_file/" ?>" + id,
          type: "GET",
          dataType: "JSON",
          success: function(data)
          {
              $('#nama_file').html(data.nama_file);
              $('#waktu_upload').html(data.tanggal_upload+' '+data.waktu_upload);
              if(data.type=='document'){
                $('#src_image').hide();
                $('#src_file').show();
                $('#src_file').attr('src','https://docs.google.com/gview?url=<?php echo base_url()?>'+data.path_file+data.hash_file+'&embedded=true');
            }else if(data.type=='image'){
                $('#src_file').hide();
                $('#src_image').show();
                $('#src_image').attr('src','<?php echo base_url()?>'+data.path_file+data.hash_file);
            }
            $('#download_file').attr('href','<?php echo base_url()."berkas/download_file/"?>'+data.id_berkas_file+'_'+data.hash_file);
            $('#file_list').modal('show'); 
            // $('#daftar_file').unblock();
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert("Gagal mendapatkan data");
        }
    });
    }
</script>