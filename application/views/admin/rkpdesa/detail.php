<style>
  th,
  td {
    vertical-align: middle !important;
  }

  td {
    background-color: #fff !important;
  }
</style>
<div class="container-fluid">

  <div class="row bg-title">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
      <h4 class="page-title">Detail RPJM Desa</h4>
    </div>
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
      <ol class="breadcrumb">
        <li>RPJMDesa</li>
        <li>Perencanaan</li>
        <li class="active">Detail</li>
      </ol>
    </div>
    <!-- /.col-lg-12 -->
  </div>
  <div class="row">
    <div class="col-md-12">
      <a href="<?= base_url('rkpdesa') ?>" style="margin-bottom: 10px;" class="btn btn-primary btn-outline pull-right"><i class="ti-back-left"></i> Kembali</a>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="white-box">
        <div class="row">
          <form method="POST">
            <div class="col-md-3 b-r">
              <center><img style="width: 80%" src="https://e-office.sumedangkab.go.id/data/logo/skpd/sumedang.png" alt="user" class="img-circle" /> </center>
            </div>
            <div class="col-md-9">
              <div class="panel panel-primary">
                <div class="panel-heading"> Desa Cijati <div class="pull-right"><a href="#" data-perform="panel-collapse"><i class="ti-minus"></i></a> </div>
                </div>
                <div class="panel-wrapper collapse in" aria-expanded="true">
                  <div class="panel-body">
                    <table class="table">
                      <tr>
                        <td style="width: 120px;">Nama Kepala </td>
                        <td>:</td>
                        <td> <strong>Data belum tersedia</strong>
                      </tr>
                      <tr>
                        <td style="width: 120px;">Alamat SKPD </td>
                        <td>:</td>
                        <td> <strong>-</strong>
                      </tr>
                      <tr>
                        <td style="width: 120px;">Email/tlp </td>
                        <td>:</td>
                        <td> <strong>email@emai.com / -</strong>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="col-md-12">
        <?php 
            for($t=2020;$t<=2025;$t++){
              $status = date('Y') == $t ? 'aktif' : 'nonaktif';
        ?>
    <a href="<?=base_url('rkpdesa/detail_tahun')?>" style="color:#636e72">
      <div class="panel panel-primary">
          <div class="panel-heading">
            Rencana Kerja <?=$t?> 
            <?php 
              if($status=='aktif'){
                echo '<span class="label label-success m-l-5 pull-right">Aktif</span>';
              }else{
                echo '<span class="label label-danger m-l-5 pull-right">Nonaktif</span>';
              }
            ?>    
          </div>
          <div class="panel-wrapper collapse in" aria-expanded="true">
              <div class="panel-body">
                <div class="col-sm-2 b-r text-center" style="max-height:110px;">
                    <div data-label="0%" class="css-bar css-bar-0 css-bar-lg"></div>
                </div>
                <div class="col-sm-2 b-r text-center">
                  <br>
                  <h3 class="panel-title">19</h3>
                  Bidang
                  <br>
                  &nbsp
                </div>

                <div class="col-sm-2 b-r text-center">
                  <br>
                  <h3 class="panel-title">1</h3>
                  Sub Bidang
                  <br>
                  &nbsp
                </div>
              
                <div class="col-sm-6 b-r">
                  <div class="col-sm-12 b-b">
                    <div class="col-sm-12 text-center">
                      <h3 class="panel-title ">13</h3>
                      Total Kegiatan
                    </div>
                  </div>
                  <div class="col-sm-12 text-center">
                    <h3 class="panel-title" style="padding-top:5px;">Rp1,708,086,020.00</h3>
                    total anggaran
                  </div>
                </div>
              </div>
          </div>
      </div>
    </a>
            <?php } ?>
  </div>
  </div>
</div>
