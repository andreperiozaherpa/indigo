<div class="container-fluid">
  
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title"><?php echo title($title) ?></h4> </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12"> 
                <ol class="breadcrumb">
                    <?php echo breadcrumb($this->uri->segment_array()); ?>
                </ol>
            </div>
            <!-- /.col-lg-12 -->
        </div><div class="col-md-12 col-sm-12 col-xs-12">
  <div class="white-box">
    <div class="x_content">
                    <form class="form-horizontal form-label-left" method="post">

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Tanggal Libur</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="text" class="form-control datepicker" name="tanggal_libur"required>
                        </div>
                      </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Keterangan</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="text" class="form-control" name="keterangan" placeholder="Keterangan" required>
                        </div>
                      </div>

                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                          <a href="<?=base_url('ref_hari_libur')?>" class="btn btn-default">Batal</a>
                          <button type="submit" class="btn btn-primary">Tambah</button>
                        </div>
                      </div>

                    </form> 
       </div>
     </div>
   </div>
 </div>

