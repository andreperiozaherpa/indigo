<div class="container-fluid">

    <div class="row bg-title">
        <!-- .page title -->
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Kinerja Lembaga</h4>
        </div>
        <!-- /.page title -->
        <!-- .breadcrumb -->
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

            <ol class="breadcrumb">
                <li><a href="#">Dashboard</a></li>
                <li class="active">Starter Page</li>
            </ol>
        </div>
        <!-- /.breadcrumb -->
    </div>
    <!-- .row -->


<div class="col-md-4 col-xs-12">
  <div class="panel panel-default">
                            <div class="panel-heading">
                             Fitler Kinerja Lembaga

                            </div>
                            <div class="panel-wrapper collapse in">
                                <div class="panel-body">
                                    

                                    <form>
                                      <div class="form-group">
                                            <label for="exampleInputEmail1">Tahun</label>
                                            <select class="form-control">
                                              <option>2017</option>
                                              <option>2018</option>
                                              <option>2019</option>
                                            </select>
                                        </div>

                                         <div class="form-group">
                                            <label for="exampleInputEmail1">Triwulan</label>
                                            <select class="form-control">
                                              <option>1</option>
                                              <option>2</option>
                                              <option>3</option>
                                              <option>4</option>
                                            </select>
                                        </div>


                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Unit Kerja</label>
                                            <select class="form-control">
                                              <option>Unit Kerja 1</option>
                                              <option>Unit Kerja 2</option>
                                              <option>Unit Kerja 3</option>
                                            </select> 
                                          </div>


                                    
                                       
                                      
                                   
                                    <div class="m-t-15 collapseblebox dn">
                                        <div class="well">
                                          
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-footer"> 

                                  <button type="submit" class="btn btn-default"> Reset</button>
                                  <button type="submit" class="btn btn-primary"> Filter</button>
                                   </form>
                                 </div>
                            </div>
                        </div>
</div>





<div class="col-md-8 col-sm-8 col-xs-12">
  <div class="row white-box">
    <div class="col-md-3">
        <center><img style="width: 80%" src="<?php echo base_url()."data/icon/office.png" ;?>" alt="user" class="img-circle"/>   </center>         
    </div>
    <div class="col-md-9">
        <h2>Unit Kerja</h2> <small>Capaian Target</small>
                                    <div class="pull-right">98% <i class="fa fa-level-up text-success"></i></div>
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:98%;"> <span class="sr-only">98% Complete</span></div>
                                    </div>
                                    <a href="<?= base_url();?>kinerja_lembaga/detail"> <button class="btn btn-inverse pull-right"> detail</button></a>
    </div>
  </div>

  <div class="row white-box">
    <div class="col-md-3">
        <center><img style="width: 80%" src="<?php echo base_url()."data/icon/office.png" ;?>" alt="user" class="img-circle"/>   </center>         
    </div>
    <div class="col-md-9">
        <h2>Unit Kerja 1</h2> <small>Capaian Target</small>
                                    <div class="pull-right">98% <i class="fa fa-level-up text-success"></i></div>
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:70%;"> <span class="sr-only">70% Complete</span></div>
                                    </div>
                                    <a href="<?= base_url();?>kinerja_lembaga/detail"> <button class="btn btn-inverse pull-right"> detail</button></a>
    </div>
  </div>


  <div class="row white-box">
    <div class="col-md-3">
        <center><img style="width: 80%" src="<?php echo base_url()."data/icon/office.png" ;?>" alt="user" class="img-circle"/>   </center>         
    </div>
    <div class="col-md-9">
        <h2>Unit Kerja 2</h2> <small>Capaian Target</small>
                                    <div class="pull-right">98% <i class="fa fa-level-up text-success"></i></div>
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:30%;"> <span class="sr-only">30% Complete</span></div>
                                    </div>
                                    <a href="<?= base_url();?>kinerja_lembaga/detail"> <button class="btn btn-inverse pull-right"> detail</button></a>
    </div>
  </div>


  <div class="row white-box">
    <div class="col-md-3">
        <center><img style="width: 80%" src="<?php echo base_url()."data/icon/office.png" ;?>" alt="user" class="img-circle"/>   </center>         
    </div>
    <div class="col-md-9">
        <h2>Unit Kerja 3</h2> <small>Capaian Target</small>
                                    <div class="pull-right">98% <i class="fa fa-level-up text-success"></i></div>
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:50%;"> <span class="sr-only">50% Complete</span></div>
                                    </div>
                                    <a href="<?= base_url();?>kinerja_lembaga/detail"> <button class="btn btn-inverse pull-right"> detail</button></a>
    </div>
  </div>



</div>
</div>
      <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            <h4 class="modal-title" id="myModalLabel">Perjanjian Kinerja</h4>
                                        </div>
                                        <form>
                                        <div class="modal-body">
                                             <label for="input-file-now">Upload Dokumen</label>
                                             <input type="file" id="input-file-now" class="dropify" />
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                                              <button type="submit" class="btn btn-primary waves-effect" data-dismiss="modal">Upload</button>
                                        </div>
                                      </form>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>

<script type="text/javascript">
	function delete_(id)
	{
		if (confirm('Apakah anda yakin akan menghapus data?')){
			window.location.href= "<?= base_url();?>ref_kode_kegiatan/delete/"+id;
		}
	}
</script>