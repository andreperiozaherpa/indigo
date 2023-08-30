 <div class="container-fluid">

    <div class="row bg-title">
        <!-- .page title -->
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Rencana Strategis</h4>
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
    <div class="row">
        <div class="col-md-4">


            <div class="white-box">
              <center><img style="width: 80%" src="<?php echo base_url()."data/icon/office.png" ;?>" alt="user" class="img-circle"/>   </center>         
              <div class="user-btm-box">
                <!-- .row -->
                <hr>
                <div class="row text-center m-t-10">

                    <div class="col-md-12 "><strong>Badan Penanggunalangan Terorisme</strong>

                    </div>

                </div>
                <!-- /.row -->
                <!-- /.row -->

                <!-- .row -->

                <div class="row text-center m-t-10">

                </div>



            </div>

        </div>

        <div class="col-md-12">
          <a href="" class="btn btn-primary btn-block" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo"><i class="fa fa-plus"></i> Tambah Renstra</a>
      </div>
  </div>

  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel1">Tambah Rencana Strategis</h4>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="recipient-name" class="control-label">Tahun:</label>
                        <input type="year" class="form-control" id="recipient-name1">
                    </div>



                    <div class="form-group">
                        <label for="message-text" class="control-label">Rencana Strategis:</label>
                        <textarea class="form-control" id="message-text1"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="message-text" class="control-label">Penanggung Jawab</label>
                        <select class="form-control">
                           <option>Pegawai 1</option>
                           <option>Pegawai 2</option>
                           <option>Pegawai 3</option>
                       </select>
                   </div>

               </form>
           </div>
           <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Simpan</button>
        </div>
    </div>
</div>
</div>



<div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel1">Disposisi Rencana Strategis</h4>
            </div>
            <div class="modal-body">
                <form>

                 <div class="form-group">
                    <label for="message-text" class="control-label">Unit Kerja</label>
                    <select class="form-control">
                       <option>Unit Kerja 1</option>
                       <option>Unit Kerja 2</option>
                       <option>Unit Kerja 3</option>
                   </select>
               </div>




               <div class="form-group">
                <label for="message-text" class="control-label">Penanggung Jawab</label>
                <select class="form-control">
                   <option>Pegawai 1</option>
                   <option>Pegawai 2</option>
                   <option>Pegawai 3</option>
               </select>
           </div>

       </form>
   </div>
   <div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    <button type="button" class="btn btn-primary">Simpan</button>
</div>
</div>
<!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>



<div class="col-md-8">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading">Rencana Strategis Sebelumnya <span class="label label-primary pull-right m-l-5">Tugas Jabatan</span></div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum tincidunt est vitae ultrices accumsan. Aliquam ornare lacus adipiscing, posuere lectus et, fringilla augue.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="row">
       <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="white-box">

            <table class="table color-table dark-table table-hover">

                <thead>
                    <tr>
                        <th>#</th>

                        <th>Tahun </th>
                        <th>Rencana Strategis</th>
                        <th>Penanggung Jawab</th>
                        <th>Disposisi</th>
                        <th>Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td> 2015 - 2019 </td>
                        <td>Meningkatnya daya tangkal masyarakat dari pengaruh radikal terorisme</td>
                        <td>Nandang</td>
                        <td><button type="button" class="btn btn-danger btn-circle" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i> </button></td>
                        <td><a href="<?=base_url('ref_renstra/detail')?>" class="btn btn-success btn-sm"><i class="fa fa-pencil"></i> view</a>
                            <a href="<?=base_url('ref_renstra/edit')?>" class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i> edit</a> <a href="<?=base_url('realisasi_kegiatan/delete')?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Delete</a></td>
                        </tr>



                    </tbody>


                </table>
            </div>
        </div>

    </div>    



</div>
<!-- .row -->

</div>