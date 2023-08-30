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
        <a href="<?=base_url('data/sicerdas/RPJMD.xlsx')?>" class="btn btn-primary">Download Laporan RPJMD</a>
        <a href="javascript:void(0)" onclick="printDiv()" class="btn btn-primary">Cetak Laporan RPJMD</a>
      </div>

      </form>
    </div>


  </div>
  <style>
    #rpjmd_perencanaan th {
      text-align: center;
      vertical-align: middle;
      background-color: #55a3a7;
    }
  </style>

  <div class="row">
    <div class="col-md-12">
      <div class="white-box" id="printArea">
        <center>
          <h4>INDIKASI PROGRAM PRIORITAS YANG DISERTAI KEBUTUHAN PENDANAAN<br>
SESUDAH PERUBAHAN RPJMD KABUPATEN SUMEDANG TAHUN 2019-2023</h4>
        </center>
        <div class="table-responsive">
          <?= $this->load->view('admin/sicerdas/rpjmd/laporan/tabel') ?>
        </div>
      </div>
    </div>
  </div>
</div>


<script>
  function printDiv() 
{

  var divToPrint=document.getElementById('printArea');

  var newWin=window.open('','Print-Window');

  newWin.document.open();

  newWin.document.write('<html><body onload="window.print()"><link href="https://e-office.sumedangkab.go.id/asset/pixel/inverse/css/style.css" rel="stylesheet"><link href="https://e-office.sumedangkab.go.id/asset/pixel/inverse/css/colors/default.css" id="theme" rel="stylesheet"><style>th,td{font-size:11px !important}</style>'+divToPrint.innerHTML+'</body></html>');

  newWin.document.close();

  // setTimeout(function(){newWin.close();},10);

}
</script>