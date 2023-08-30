<div class="container-fluid">

  <div class="row bg-title">
    <!-- .page title -->
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
      <h4 class="page-title">Laporan Perencanaan RPJMD</h4>
    </div>
    <!-- /.page title -->
    <!-- .breadcrumb -->
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

      <ol class="breadcrumb">
        <li><a href="https://e-office.sumedangkab.go.id//admin">Dashboard</a></li>
        <li class="active">Laporan Perencanaan RPJMD</li>
      </ol>
    </div>
    <!-- /.breadcrumb -->
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="white-box">
        <div class="row">
          <form method="GET">
            <div class="col-md-6">
              <div class="form-group">
                <label for="exampleInputEmail1">SKPD</label>
                <select class="form-control select2">
                  <?php foreach($dt_skpd as $row){
                    echo '<option value="'.$row->id_skpd.'">'.$row->nama_skpd.'</option>';
                  }
                  ?>
                </select>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">

                <br>
                <button type="submit" class="btn btn-primary m-t-5">Filter</button>
                <a href="javascript:void(0)" onclick="downloadExcel('rpjmd_perencanaan','Laporan Perencanaan RPJMD')" class="btn btn-danger m-t-5 pull-right"><i class="fa fa-print"></i> Cetak Laporan </a>
              </div>
            </div>

          </form>
        </div>

      </div>
    </div>

  </div>
  <style>
  #rpjmd_perencanaan th 
  {
    text-align: center; 
    vertical-align: middle;
    background-color: #55a3a7; 
  }
</style>

<div class="row">
  <div class="col-md-12">
    <div class="white-box table-responsive dragscroll">
      <h4 class="text-center">Indikasi Rencana Program Prioritas yang disertai Kebutuhan Pendanaan</h4>
      <h4 class="text-center">Kabupaten Sumedang Tahun <?=$dt_tahun[0] .' - '. $dt_tahun[4];?></h4>
      
      <?=$report;?>

    </div>
  </div>
</div>
</div>