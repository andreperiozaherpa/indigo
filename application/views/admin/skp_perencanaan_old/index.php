<div class="container-fluid">

  <div class="row bg-title">
    <!-- .page title -->
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
      <h4 class="page-title">SKP</h4>
    </div>
    <!-- /.page title -->
    <!-- .breadcrumb -->
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

      <ol class="breadcrumb">
        <?php echo breadcrumb($this->uri->segment_array()); ?>
      </ol>
    </div>
    <!-- /.breadcrumb -->
  </div>

  <div class="row">
   <div class="col-md-12">
    <div class="white-box">
      <div class="row">
        <form method="POST">
          <div class="col-md-3 b-r">
            <center><img style="width: 80%" src="https://e-office.sumedangkab.go.id/data/logo/bnpt.png" alt="user" class="img-circle">   </center>
          </div>
          <div class="col-md-9">
            <div class="panel panel-primary">
              <div class="panel-heading"><?=$detail_skpd->nama_skpd?>
              <div class="pull-right"><a href="#" data-perform="panel-collapse"><i class="ti-minus"></i></a>  </div>
            </div>
            <div class="panel-wrapper collapse in" aria-expanded="true">
              <div class="panel-body">
                <div class="table-responsive">
                  <table class="table">
                    <table class="table">
                        <tr><td style="width: 120px;">Nama Kepala </td><td>:</td><td> <strong><?=$kepala_skpd->nama_lengkap?></strong></tr>
                        <tr><td style="width: 120px;">Alamat SKPD </td><td>:</td><td> <strong><?=$detail_skpd->alamat_skpd?></strong></tr>
                        <tr><td style="width: 120px;">Email/tlp </td><td>:</td><td> <strong><?=$detail_skpd->email_skpd?> / <?=$detail_skpd->telepon_skpd?></strong>
                    </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>


  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap" style="margin-bottom: 20px">Tambah Periode SKP</button

    <div class="row">

      <a href="<?=base_url();?>skp_perencanaan/detail">
        <div class="panel panel-primary">
          <div class="panel-heading">
            Sasaran Kinerja Pegawai 2019 <span class="label label-danger m-l-5 pull-right">Nonaktif</span>          </div>
            <div class="panel-wrapper collapse in" aria-expanded="true">
              <div class="panel-body">
                <div class="col-sm-2 b-r text-center" style="max-height:110px;">
                  <div data-label="20%" class="css-bar css-bar-20 css-bar-lg"></div>
                </div>
                <div class="col-sm-2 b-r text-center">
                  <br>
                  <h3 class="panel-title">10</h3>
                  Tugas Jabatan
                  <br>
                  &nbsp;
                </div>

                <div class="col-sm-2 b-r text-center">
                  <br>
                  <h3 class="panel-title">0</h3>
                  Tugas Tambahan
                  <br>
                  &nbsp;
                </div>

                <div class="col-sm-2 b-r text-center">
                  <br>
                  <h3 class="panel-title">0</h3>
                  Tugas Kreativitas
                  <br>
                  &nbsp;
                </div>


                <div class="col-sm-4 b-r">
                  <div class="col-sm-12 b-b">
                    <div class="col-sm-6 text-center">
                      <h3 class="panel-title">0</h3>
                      Periode Awal
                    </div>

                    <div class="col-sm-6  text-center">
                      <h3 class="panel-title">0</h3>
                      Periode Akhir
                    </div>

                  </div>
                  <div class="col-sm-12 text-center">
                    <h3 class="panel-title" style="padding-top:5px;">00</h3>
                    Nilai SKP
                  </div>
                </div>
              </div>
            </div>
          </div>

        </a>

      </div>

      <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="exampleModalLabel1">Tambah SKP</h4>
            </div>
            <div class="modal-body">
              <form>

                <div class="form-group">
                  <label for="recipient-name" class="control-label">Periode Awal:</label>
                  <input type="date" class="form-control" id="recipient-name1">
                </div>

                 <div class="form-group">
                  <label for="recipient-name" class="control-label">Periode Akhir:</label>
                  <input type="date" class="form-control" id="recipient-name1">
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
