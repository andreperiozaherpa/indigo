<div class="container-fluid">

  <div class="row bg-title">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
      <h4 class="page-title">Sigesit</h4>
    </div>
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
      <ol class="breadcrumb">
        <li>Monev</li>
        <li class="active">Detail SKPD</li>
      </ol>
    </div>
    <!-- /.col-lg-12 -->
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="white-box">
        <div class="row">
          <form method="POST">
            <div class="col-md-3 b-r">
              <center><img style="width: 80%" src="<?=base_url();?>/data/logo/bnpt.png" alt="user" class="img-circle">
              </center>
            </div>
            <div class="col-md-9">
              <div class="panel panel-primary">
                <div class="panel-heading"> <?= strtoupper($detail->nama_skpd) ;?> <div class="pull-right"><a href="#"
                      data-perform="panel-collapse"><i class="ti-minus"></i></a> </div>
                </div>
                <div class="panel-wrapper collapse in" aria-expanded="true">
                  <div class="panel-body">
                    <div class="table-responsive">
                      <table class="table">
                        <tbody>
                                      <tr>
                            <td style="width: 120px;">Nama Kepala </td>
                            <td>:</td>
                            <td> <strong><?=($kepala) ? $kepala->nama_lengkap : "" ;?></strong></td>
                          </tr>
                          <tr>
                            <td style="width: 120px;">Alamat SKPD </td>
                            <td>:</td>
                            <td> <strong><?=$detail->alamat_skpd;?></strong></td>
                          </tr>
                          <tr>
                            <td style="width: 120px;">Email/tlp </td>
                            <td>:</td>
                            <td> <strong><?=$detail->email_skpd;?> / <?=$detail->telepon_skpd;?></strong>
                            </td>
                          </tr>
                        </tbody>
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

  <div id="row-data">
    <?= $dt_list['content'] ;?>
    
  </div>

  <div class="row">
    
    <div class="col-12 text-center">
      <nav class="mt-4 mb-3">
        <ul class="pagination justify-content-center mb-0" id="pagination_">
          <?=$dt_list['pagination'];?>
        </ul>
      </nav>
    </div>
  </div>

</div>
