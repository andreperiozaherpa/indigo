<div class="container-fluid">

<div class="row bg-title">
  <!-- .page title -->
  <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
    <h4 class="page-title"> Evaluasi terhadap Hasil RKPD </h4>
  </div>
  <!-- /.page title -->
  <!-- .breadcrumb -->
  <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

    <ol class="breadcrumb">
      <li><a href="<?= base_url();?>/admin">Dashboard</a></li>
      <li class="active">Evaluasi  RKPD</li>
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
              <select name="id_skpd" class="form-control select2">
                <option value="">Semua SKPD</option>
                <option>BKD</option>
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
<div class="white-box responsive" style="overflow-x: auto;">

<table class="table table-bordered">
  
    <tr>
        <td>No</td>
        <td>Urusan Pemerintah Daerah dan SKPD</td>
        <td> Pagu (Rp) </td>
        <td> Realisasi (Rp) </td>
        <td>Fisik (%)</td>
        <td>Predikat Fisik</td>
        <td>Keuangan (%)</td>
        <td>Predikat Keuangan</td>
    </tr>
    <tr>
        <td>(1)</td>
        <td>(2)</td>
        <td>(3)</td>
        <td>(4)</td>
        <td>(5)</td>
        <td>(6)</td>
        <td>(7)</td>
        <td>(8)</td>
    </tr>
    <tr>
        <td>A</td>
        <td>URUSAN WAJIB&nbsp;</td>
        <td> 24.000.000 </td>
        <td> 9.600.000 </td>
        <td>12,28</td>
        <td>Sangat Rendah</td>
        <td>40,00</td>
        <td>Sangat Rendah</td>
    </tr>
    <tr>
        <td>1</td>
        <td>Urusan wajib yang berkaitan dengan pelayanan dasar&nbsp;</td>
        <td> 6.000.000 </td>
        <td> 2.400.000 </td>
        <td>10,00</td>
        <td>Sangat Rendah</td>
        <td>40,00</td>
        <td>Sangat Rendah</td>
    </tr>
    <tr>
        <td>1.01</td>
        <td>Pendidikan</td>
        <td> 1.000.000 </td>
        <td> 500.000 </td>
        <td>10,00</td>
        <td>Sangat Rendah</td>
        <td>50,00</td>
        <td>Sangat Rendah</td>
    </tr>
    <tr>
        <td>1.02</td>
        <td>Kesehatan</td>
        <td> 1.000.000 </td>
        <td> 700.000 </td>
        <td>10,00</td>
        <td>Sangat Rendah</td>
        <td>70,00</td>
        <td>Sedang</td>
    </tr>
    <tr>
        <td>1.03</td>
        <td>Pekerjaan Umum dan Penataan Ruang</td>
        <td> 1.000.000 </td>
        <td> 300.000 </td>
        <td>10,00</td>
        <td>Sangat Rendah</td>
        <td>30,00</td>
        <td>Sangat Rendah</td>
    </tr>
    <tr>
        <td>1.04</td>
        <td>Perumahan Rakyat dan Kawasan Permukiman</td>
        <td> 1.000.000 </td>
        <td> 300.000 </td>
        <td>10,00</td>
        <td>Sangat Rendah</td>
        <td>30,00</td>
        <td>Sangat Rendah</td>
    </tr>
    <tr>
        <td>1.05</td>
        <td>Ketenteraman dan Ketertiban Umum Serta Perlindungan Masyarakat</td>
        <td> 1.000.000 </td>
        <td> 500.000 </td>
        <td>10,00</td>
        <td>Sangat Rendah</td>
        <td>50,00</td>
        <td>Sangat Rendah</td>
    </tr>
    <tr>
        <td>1.06</td>
        <td>Sosial</td>
        <td> 1.000.000 </td>
        <td> 100.000 </td>
        <td>10,00</td>
        <td>Sangat Rendah</td>
        <td>10,00</td>
        <td>Sangat Rendah</td>
    </tr>
    <tr>
        <td>2</td>
        <td>Urusan Wajib Non Pelayanan Dasar</td>
        <td> 18.000.000 </td>
        <td> 7.200.000 </td>
        <td>14,56</td>
        <td>Sangat Rendah</td>
        <td>40,00</td>
        <td>Sangat Rendah</td>
    </tr>
    <tr>
        <td>2.07</td>
        <td>Tenaga Kerja</td>
        <td> 1.000.000 </td>
        <td> 500.000 </td>
        <td>10,00</td>
        <td>Sangat Rendah</td>
        <td>50,00</td>
        <td>Sangat Rendah</td>
    </tr>
    <tr>
        <td>2.08</td>
        <td>Pemberdayaan Perempuan dan Perlindungan Anak</td>
        <td> 1.000.000 </td>
        <td> 700.000 </td>
        <td>101,00</td>
        <td>Sangat Tinggi</td>
        <td>70,00</td>
        <td>Sedang</td>
    </tr>
    <tr>
        <td>2.09</td>
        <td>Pangan</td>
        <td> 1.000.000 </td>
        <td> 300.000 </td>
        <td>1,00</td>
        <td>Sangat Rendah</td>
        <td>30,00</td>
        <td>Sangat Rendah</td>
    </tr>
    <tr>
        <td>2.10</td>
        <td>Pertanahan</td>
        <td> 1.000.000 </td>
        <td> 300.000 </td>
        <td>10,00</td>
        <td>Sangat Rendah</td>
        <td>30,00</td>
        <td>Sangat Rendah</td>
    </tr>
    <tr>
        <td>2.11</td>
        <td>Lingkungan Hidup</td>
        <td> 1.000.000 </td>
        <td> 500.000 </td>
        <td>10,00</td>
        <td>Sangat Rendah</td>
        <td>50,00</td>
        <td>Sangat Rendah</td>
    </tr>
    <tr>
        <td>2.12</td>
        <td>Administrasi Kependudukan dan Catatan Sipil</td>
        <td> 1.000.000 </td>
        <td> 100.000 </td>
        <td>10,00</td>
        <td>Sangat Rendah</td>
        <td>10,00</td>
        <td>Sangat Rendah</td>
    </tr>
    <tr>
        <td>2.13</td>
        <td>Pemberdayaan Masyarakat Desa</td>
        <td> 1.000.000 </td>
        <td> 400.000 </td>
        <td>10,00</td>
        <td>Sangat Rendah</td>
        <td>40,00</td>
        <td>Sangat Rendah</td>
    </tr>
    <tr>
        <td>2.14</td>
        <td>Pengendalian Penduduk dan Keluarga Berencana</td>
        <td> 1.000.000 </td>
        <td> 400.000 </td>
        <td>10,00</td>
        <td>Sangat Rendah</td>
        <td>40,00</td>
        <td>Sangat Rendah</td>
    </tr>
    <tr>
        <td>2.15</td>
        <td>Perhubungan</td>
        <td> 1.000.000 </td>
        <td> 400.000 </td>
        <td>10,00</td>
        <td>Sangat Rendah</td>
        <td>40,00</td>
        <td>Sangat Rendah</td>
    </tr>
    <tr>
        <td>2.16</td>
        <td>Komunikasi dan Informatika</td>
        <td> 1.000.000 </td>
        <td> 400.000 </td>
        <td>10,00</td>
        <td>Sangat Rendah</td>
        <td>40,00</td>
        <td>Sangat Rendah</td>
    </tr>
    <tr>
        <td>2.17</td>
        <td>Koperasi, Usaha Kecil dan Menengah</td>
        <td> 1.000.000 </td>
        <td> 400.000 </td>
        <td>10,00</td>
        <td>Sangat Rendah</td>
        <td>40,00</td>
        <td>Sangat Rendah</td>
    </tr>
    <tr>
        <td>2.18</td>
        <td>Penanaman Modal</td>
        <td> 1.000.000 </td>
        <td> 400.000 </td>
        <td>10,00</td>
        <td>Sangat Rendah</td>
        <td>40,00</td>
        <td>Sangat Rendah</td>
    </tr>
    <tr>
        <td>2.19</td>
        <td>Kepemudaan dan Olahraga</td>
        <td> 1.000.000 </td>
        <td> 400.000 </td>
        <td>10,00</td>
        <td>Sangat Rendah</td>
        <td>40,00</td>
        <td>Sangat Rendah</td>
    </tr>
    <tr>
        <td>2.20</td>
        <td>Statistik</td>
        <td> 1.000.000 </td>
        <td> 400.000 </td>
        <td>10,00</td>
        <td>Sangat Rendah</td>
        <td>40,00</td>
        <td>Sangat Rendah</td>
    </tr>
    <tr>
        <td>2.21</td>
        <td>Persandian</td>
        <td> 1.000.000 </td>
        <td> 400.000 </td>
        <td>10,00</td>
        <td>Sangat Rendah</td>
        <td>40,00</td>
        <td>Sangat Rendah</td>
    </tr>
    <tr>
        <td>2.22</td>
        <td>Kebudayaan</td>
        <td> 1.000.000 </td>
        <td> 400.000 </td>
        <td>10,00</td>
        <td>Sangat Rendah</td>
        <td>40,00</td>
        <td>Sangat Rendah</td>
    </tr>
    <tr>
        <td>2.23</td>
        <td>Perpustakaan</td>
        <td> 1.000.000 </td>
        <td> 400.000 </td>
        <td>10,00</td>
        <td>Sangat Rendah</td>
        <td>40,00</td>
        <td>Sangat Rendah</td>
    </tr>
    <tr>
        <td>2.24</td>
        <td>Kearsipan</td>
        <td> 1.000.000 </td>
        <td> 400.000 </td>
        <td>10,00</td>
        <td>Sangat Rendah</td>
        <td>40,00</td>
        <td>Sangat Rendah</td>
    </tr>
    <tr>
        <td>3</td>
        <td>URUSAN PILIHAN</td>
        <td> 8.000.000 </td>
        <td> 1.600.000 </td>
        <td>10,00</td>
        <td>Sangat Rendah</td>
        <td>20,00</td>
        <td>Sangat Rendah</td>
    </tr>
    <tr>
        <td>3.25</td>
        <td>Kelautan dan Perikanan</td>
        <td> 1.000.000 </td>
        <td> 200.000 </td>
        <td>10,00</td>
        <td>Sangat Rendah</td>
        <td>20,00</td>
        <td>Sangat Rendah</td>
    </tr>
    <tr>
        <td>3.26</td>
        <td>Pariwisata</td>
        <td> 1.000.000 </td>
        <td> 200.000 </td>
        <td>10,00</td>
        <td>Sangat Rendah</td>
        <td>20,00</td>
        <td>Sangat Rendah</td>
    </tr>
    <tr>
        <td>3.27</td>
        <td>Pertanian</td>
        <td> 1.000.000 </td>
        <td> 200.000 </td>
        <td>10,00</td>
        <td>Sangat Rendah</td>
        <td>20,00</td>
        <td>Sangat Rendah</td>
    </tr>
    <tr>
        <td>3.28</td>
        <td>Kehutanan</td>
        <td> 1.000.000 </td>
        <td> 200.000 </td>
        <td>10,00</td>
        <td>Sangat Rendah</td>
        <td>20,00</td>
        <td>Sangat Rendah</td>
    </tr>
    <tr>
        <td>3.29</td>
        <td>Energi dan Sumberdaya Mineral</td>
        <td> 1.000.000 </td>
        <td> 200.000 </td>
        <td>10,00</td>
        <td>Sangat Rendah</td>
        <td>20,00</td>
        <td>Sangat Rendah</td>
    </tr>
    <tr>
        <td>3.30</td>
        <td>Perdagangan</td>
        <td> 1.000.000 </td>
        <td> 200.000 </td>
        <td>10,00</td>
        <td>Sangat Rendah</td>
        <td>20,00</td>
        <td>Sangat Rendah</td>
    </tr>
    <tr>
        <td>3.31</td>
        <td>Perindustrian</td>
        <td> 1.000.000 </td>
        <td> 200.000 </td>
        <td>10,00</td>
        <td>Sangat Rendah</td>
        <td>20,00</td>
        <td>Sangat Rendah</td>
    </tr>
    <tr>
        <td>3.32</td>
        <td>Transmigrasi</td>
        <td> 1.000.000 </td>
        <td> 200.000 </td>
        <td>10,00</td>
        <td>Sangat Rendah</td>
        <td>20,00</td>
        <td>Sangat Rendah</td>
    </tr>
    <tr>
        <td>4</td>
        <td>PENDUKUNG URUSAN PEMERINTAHAN</td>
        <td> 2.000.000 </td>
        <td> 600.000 </td>
        <td>10,00</td>
        <td>Sangat Rendah</td>
        <td>30,00</td>
        <td>Sangat Rendah</td>
    </tr>
    <tr>
        <td>4.01</td>
        <td>Sekretariat Daerah</td>
        <td> 1.000.000 </td>
        <td> 300.000 </td>
        <td>10,00</td>
        <td>Sangat Rendah</td>
        <td>30,00</td>
        <td>Sangat Rendah</td>
    </tr>
    <tr>
        <td>4.02</td>
        <td>Sekretariat DPRD</td>
        <td> 1.000.000 </td>
        <td> 300.000 </td>
        <td>10,00</td>
        <td>Sangat Rendah</td>
        <td>30,00</td>
        <td>Sangat Rendah</td>
    </tr>
    <tr>
        <td>5</td>
        <td>PENUNJANG URUSAN PEMERINTAHAN</td>
        <td> 7.000.000 </td>
        <td> 2.800.000 </td>
        <td>10,00</td>
        <td>Sangat Rendah</td>
        <td>40,00</td>
        <td>Sangat Rendah</td>
    </tr>
    <tr>
        <td>5.01</td>
        <td>Perencanaan</td>
        <td> 1.000.000 </td>
        <td> 400.000 </td>
        <td>10,00</td>
        <td>Sangat Rendah</td>
        <td>40,00</td>
        <td>Sangat Rendah</td>
    </tr>
    <tr>
        <td>5.02</td>
        <td>Keuangan</td>
        <td> 1.000.000 </td>
        <td> 400.000 </td>
        <td>10,00</td>
        <td>Sangat Rendah</td>
        <td>40,00</td>
        <td>Sangat Rendah</td>
    </tr>
    <tr>
        <td>5.03</td>
        <td>Kepegawaian</td>
        <td> 1.000.000 </td>
        <td> 400.000 </td>
        <td>10,00</td>
        <td>Sangat Rendah</td>
        <td>40,00</td>
        <td>Sangat Rendah</td>
    </tr>
    <tr>
        <td>5.04</td>
        <td>Pendidikan dan Pelatihan</td>
        <td> 1.000.000 </td>
        <td> 400.000 </td>
        <td>10,00</td>
        <td>Sangat Rendah</td>
        <td>40,00</td>
        <td>Sangat Rendah</td>
    </tr>
    <tr>
        <td>5.05</td>
        <td>Penelitian dan Pengembangan</td>
        <td> 1.000.000 </td>
        <td> 400.000 </td>
        <td>10,00</td>
        <td>Sangat Rendah</td>
        <td>40,00</td>
        <td>Sangat Rendah</td>
    </tr>
    <tr>
        <td>5.06</td>
        <td>Penghubung</td>
        <td> 1.000.000 </td>
        <td> 400.000 </td>
        <td>10,00</td>
        <td>Sangat Rendah</td>
        <td>40,00</td>
        <td>Sangat Rendah</td>
    </tr>
    <tr>
        <td>5.07</td>
        <td>Pengelolaan Perbatasan Daerah</td>
        <td> 1.000.000 </td>
        <td> 400.000 </td>
        <td>10,00</td>
        <td>Sangat Rendah</td>
        <td>40,00</td>
        <td>Sangat Rendah</td>
    </tr>
    <tr>
        <td>6</td>
        <td>PENGAWASAN URUSAN PEMERINTAHAN</td>
        <td> 1.000.000 </td>
        <td> 300.000 </td>
        <td>10,00</td>
        <td>Sangat Rendah</td>
        <td>30,00</td>
        <td>Sangat Rendah</td>
    </tr>
    <tr>
        <td>6.01</td>
        <td>Inspektorat</td>
        <td> 1.000.000 </td>
        <td> 300.000 </td>
        <td>10,00</td>
        <td>Sangat Rendah</td>
        <td>30,00</td>
        <td>Sangat Rendah</td>
    </tr>
    <tr>
        <td>7</td>
        <td>PEMERINTAHAN UMUM KEWILAYAHAN</td>
        <td> 1.000.000 </td>
        <td> 5.000.000 </td>
        <td>10,00</td>
        <td>Sangat Rendah</td>
        <td>500,00</td>
        <td>Sangat Tinggi</td>
    </tr>
    <tr>
        <td>7.01</td>
        <td>Kecamatan</td>
        <td> 1.000.000 </td>
        <td> 5.000.000 </td>
        <td>10,00</td>
        <td>Sangat Rendah</td>
        <td>500,00</td>
        <td>Sangat Tinggi</td>
    </tr>
    <tr>
        <td>8</td>
        <td>URUSAN PEMERINTAHAN UMUM</td>
        <td> 1.000.000 </td>
        <td> 300.000 </td>
        <td>10,00</td>
        <td>Sangat Rendah</td>
        <td>30,00</td>
        <td>Sangat Rendah</td>
    </tr>
    <tr>
        <td>8.01</td>
        <td>Kesatuan Bangsa dan Politik</td>
        <td> 1.000.000 </td>
        <td> 300.000 </td>
        <td>10,00</td>
        <td>Sangat Rendah</td>
        <td>30,00</td>
        <td>Sangat Rendah</td>
    </tr>
    <tr>
        <td></td>
        <td>TOTAL</td>
        <td> 44.000.000 </td>
        <td> 20.200.000 </td>
        <td>10,57</td>
        <td>Sangat Rendah</td>
        <td>45,91</td>
        <td>Sangat Rendah</td>
    </tr>
</table>
</div>
</div>
</div>