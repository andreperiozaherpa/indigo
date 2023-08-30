  <style type="text/css">
    .customvtab .tabs-vertical li.active a, .customvtab .tabs-vertical li.active a:focus, .customvtab .tabs-vertical li.active a:hover {
    color: #6003c8;
    border-right: 2px solid #6003c8;
}
  </style>
  <?php
  $jenis_surat = 'surat_'.$detail->jenis_surat;
  if($detail->status_arsip=='Sudah Diarsipkan'){
    $color1 = "success";
    $color2 = "#00c292";
    $icon = "ti-archive";
    $icon2 = "icon-check";

  }elseif($detail->status_arsip=="Belum Diarsipkan"){
    $color1 = "danger";
    $color2 = "#F75B36";
    $icon = "ti-archive";
    $icon2 = "icon-close";

  }elseif($detail->status_arsip=="Perlu Tanggapan"){
    $color1 = "warning";
    $color2 = "#f8c255";
    $icon = "icon-clock";
    $icon2 = "icon-info";
  }
  ?>      <div class="container-fluid">

   <div class="row bg-title">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
     <h4 class="page-title">Sijagur</h4> </div>
     <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
      <ol class="breadcrumb">
        <?=breadcrumb($this->uri->segment_array()) ?>   
      </ol>
    </div>
    <!-- /.col-lg-12 -->
  </div>
  <div class="row">
    <div class="col-md-12">
      <?php
      if(isset($message)){
        ?>
        <div class="alert alert-<?=$type?>"><?=$message?></div>
        <?php
      }
      ?>
    </div>
  </div>
  <div class="col-md-12">
    <a href="<?=base_url('sijagur/monitoring')?>" class="pull-right btn btn-primary btn-outline"><i class="ti-back-left"></i> Kembali</a><br><br>
  </div>

     <!-- <div class="row"> -->
       <div class="col-md-12">
        <div class="white-box">
         <div class="row">
          <form method="POST">
            <div class="col-md-3 b-r">
              <center><img style="width: 80%" src="https://e-office.sumedangkab.go.id/data/logo/skpd/sumedang.png" alt="user" class="img-circle"/>   </center>
            </div>
            <div class="col-md-9">
              <div class="panel panel-primary">
                <div class="panel-heading"> Dinas Pendidikan                  <div class="pull-right"><a href="#" data-perform="panel-collapse"><i class="ti-minus"></i></a>  </div>
                </div>
                <div class="panel-wrapper collapse in" aria-expanded="true">
                  <div class="panel-body">
                    <table class="table">
                      <tr><td style="width: 120px;">Kode Rekening </td><td>:</td><td> <strong>1.02.55.234.111</strong></tr>
                        <tr><td style="width: 120px;">Nama Kegiatan </td><td>:</td><td> <strong>Urusan Pendidikan</strong></tr>
                          <tr><td style="width: 120px;">Tahun </td><td>:</td><td> <strong>2021</strong>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        <!-- </div> -->
  
    <div class="col-md-12">
      <div class="white-box">
        <div class="row">
          <section class="">
                                
                            <div class="vtabs customvtab">
                                <ul class="nav tabs-vertical">
                                    <li class="tab active">
                                        <a data-toggle="tab" href="#vhome3" aria-expanded="true"> <span class="visible-xs"><i class="ti-home"></i></span> <span class="hidden-xs">Realisasi Keuangan</span> </a>
                                    </li>
                                    <li class="tab">
                                        <a data-toggle="tab" href="#vprofile3" aria-expanded="false"> <span class="visible-xs"><i class="ti-user"></i></span> <span class="hidden-xs">Realisasi Fisik</span> </a>
                                    </li>
                                    <li class="tab">
                                        <a aria-expanded="false" data-toggle="tab" href="#vmessages3"> <span class="visible-xs"><i class="ti-email"></i></span> <span class="hidden-xs">Realisasi IKU</span> </a>
                                    </li>
                                    <li class="tab">
                                        <a aria-expanded="false" data-toggle="tab" href="#vmessages4"> <span class="visible-xs"><i class="ti-email"></i></span> <span class="hidden-xs">Realisasi Pnegadaan</span> </a>
                                    </li>
                                </ul>
                                <div class="tab-content" style="width: 90%">
                                    <div id="vhome3" class="tab-pane active">
                                        <div class="col-md-12 align-center text-center">
                                            <h3>Realisasi Keuangan Berdasarkan SP2D</h3>
                                            <h4>Periode Minggu Ke 1 Bulan September Tahun Anggaran 2021</h4> </div>
                                          <table class="table table-responsive table-bordered table-striped">
                                            <thead>
                                              <tr>
                                                <th>No</th>
                                                <th>Kode SKPD</th>
                                                <th>SKPD</th>
                                                <th>Pagu Anggaran</th>
                                                <th>Realisasi (Belanja Operasi)</th>
                                                <th>Sisa Pagu Anggaran</th>
                                                <th>Presentase (%)</th>
                                              </tr>
                                            </thead>
                                            <tbody>
                                              <tr>
                                                <td>1</td>
                                                <td>1.01.0.00.0.00.01</td>
                                                <td>Dinas Pendidkikan</td>
                                                <td>964.787.448.584,00</td>
                                                <td>123.357.448.124,00</td>
                                                <td>1.121.355.218.160,00</td>
                                                <td>35.22%</td>
                                              </tr>
                                            </tbody>
                                          </table>

                                        <div class="clearfix"></div>
                                    </div>
                                    <div id="vprofile3" class="tab-pane">
                                        <div class="col-md-12 align-center text-center">
                                            <h3>Realisasi Fisik Dinas Pendidikan</h3>
                                            <h4>Periode Minggu Ke 1 Bulan September Tahun Anggaran 2021</h4> </div>
                                          <table class="table table-responsive table-bordered table-striped">
                                            <thead>
                                              <tr>
                                                <th rowspan="2">No</th>
                                                <th rowspan="2">Kode SKPD</th>
                                                <th rowspan="2">SKPD</th>
                                                <th colspan="2">Fisik</th>
                                              </tr>
                                              <tr>
                                                <th>Target</th>
                                                <th>Realisasi</th>
                                              </tr>
                                            </thead>
                                            <tbody>
                                              <tr>
                                                <td>1</td>
                                                <td>1.01.0.00.0.00.01</td>
                                                <td>Dinas Pendidkikan</td>
                                                <td>35.22%</td>
                                                <td>95.12%</td>
                                              </tr>
                                            </tbody>
                                          </table>

                                        <div class="clearfix"></div>
                                    </div>
                                    <div id="vmessages3" class="tab-pane">
                                        <div class="col-md-12 align-center text-center">
                                            <h3>IKU Strategis Perangkat Daerah</h3> </div>
                                          <table class="table table-responsive table-bordered table-striped">
                                            <thead>
                                              <tr>
                                                <th rowspan="2">No</th>
                                                <th rowspan="2">SKPD</th>
                                                <th colspan="4">PK</th>
                                              </tr>
                                              <tr>
                                                <th>IKU Strategis</th>
                                                <th>Target</th>
                                                <th>Satuan</th>
                                                <th>Capaian</th>
                                              </tr>
                                            </thead>
                                            <tbody>
                                              <tr>
                                                <td>1</td>
                                                <td>Dinas Pendidkikan</td>
                                                <td>Nilai LPPD Kabupaten</td>
                                                <td>100</td>
                                                <td>%</td>
                                                <td></td>
                                              </tr>
                                            </tbody>
                                          </table>

                                        <div class="clearfix"></div>
                                    </div>
                                    <div id="vmessages4" class="tab-pane">
                                        <div class="col-md-12 align-center text-center">
                                            <h3>Rekapitulasi Pelaksanaan Pengadaan Barang/Jasa Tender</h3>
                                            <h4>Periode Minggu Ke 1 Bulan September Tahun Anggaran 2021</h4>  </div>
                                          <table class="table table-responsive table-bordered table-striped align-middle text-center">
                                            <thead>
                                              <tr>
                                                <th rowspan="2">No</th>
                                                <th rowspan="2">SKPD</th>
                                                <th rowspan="2">Nama Paket Pengadaan</th>
                                                <th rowspan="2">Pagi Anggaran (Rp.)</th>
                                                <th rowspan="2">Nilai Kontrak (Rp.)</th>
                                                <th rowspan="2">Sisa Anggaran (Rp.)</th>
                                                <th rowspan="2">Jenis Pengadaan</th>
                                                <th rowspan="2">Metode Pengadaan</th>
                                                <th rowspan="2">Nama Penyedia <small>(PT, CV, Firma, Koperasi)</small></th>
                                                <th rowspan="2">Nomor dan Tanggal Tanda Kontrak <small>(SPK/ Surat Pengajuan/ Surat Pesanan)</small></th>
                                                <th colspan="2">Waktu Pelaksanaan Pekerjaan <small>(tgl/bln/thn)</small></th>
                                                <th rowspan="2">Waktu Pelaksanaan Pekerjaan <small>(Hari Kalender)</small></th>
                                                <th rowspan="2">Tanggal Serah Terima Pekerjaan/ PHO (untuk konstruksi)</th>
                                                <th rowspan="2">Lokasi Pekerjaan</th>
                                                <th rowspan="2">Output Pekerjaan</th>
                                                <th colspan="2">Progres Pelaksanaan Pekerjaan</th>
                                              </tr>
                                              <tr>
                                                <th>Awal</th>
                                                <th>Akhir</th>
                                                <th>%</th>
                                                <th>Foto</th>
                                              </tr>
                                            </thead>
                                            <tbody>
                                              <tr>
                                                <td>1</td>
                                                <td>Dinas Pendidkikan</td>
                                                <td>Belanja Modal Bangunan Gedung Kantor</td>
                                                <td>198.000.000</td>
                                                <td>197.000.000</td>
                                                <td> 1.000.000 </td>
                                                <td>Konstruksi</td>
                                                <td>Pengadaan Langsung</td>
                                                <td>CV. AQILLA</td>
                                                <td>05/SPK/PPK/BANGUNAN GEDUNG KANTOR/DISKOMINFOSANDITIK/2021</td>
                                                <td>07-Apr-21</td>
                                                <td>05-Jul-21</td>
                                                <td>90 Hari</td>
                                                <td></td>
                                                <td>Diskomin fosanditik</td>
                                                <td>Tersedianya bangunan gedung/Aula</td>
                                              </tr>
                                            </tbody>
                                          </table>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                                <!-- /tabs -->
                            </section>
                            <!-- Tabstyle start -->
        </div>
      </div>
    </div>


    <script src="https://e-office.sumedangkab.go.id/asset/pixel/inverse/js/cbpFWTabs.js" defer></script>
    <script type="text/javascript" defer>
    $(document).ready(function(){
        (function() {
            [].slice.call(document.querySelectorAll('.sttabs')).forEach(function(el) {
                new CBPFWTabs(el);
            });
        })();
    });
    </script>