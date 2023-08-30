  <style type="text/css">
    .sttabs nav li.tab-current a {
      color: #6003c8;
    }

    .tabs-style-underline nav li a::after {
      background: #6003c8;
    }
  </style>
  <div class="container-fluid">

    <div class="row bg-title">
      <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h4 class="page-title">Sijagur</h4>
      </div>
      <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
        <ol class="breadcrumb">
          <?= breadcrumb($this->uri->segment_array()) ?>
        </ol>
      </div>
      <!-- /.col-lg-12 -->
    </div>
    <div class="row">
      <div class="col-md-12">
        <?php
        if (isset($message)) {
        ?>
          <div class="alert alert-<?= $type ?>"><?= $message ?></div>
        <?php
        }
        ?>
      </div>
    </div>
    <div class="col-md-12">
      <a href="<?= base_url('sijagur/monitoring') ?>" class="pull-right btn btn-primary btn-outline"><i class="ti-back-left"></i> Kembali</a><br><br>
    </div>

    <!-- <div class="row"> -->
    <div class="col-md-12">
      <div class="white-box">
        <div class="row">
          <form method="POST">
            <div class="col-md-3 b-r">
              <center><img style="width: 80%" src="https://e-office.sumedangkab.go.id/data/logo/skpd/sumedang.png" alt="user" class="img-circle" /> </center>
            </div>
            <div class="col-md-9">
              <div class="panel panel-primary">
                <div class="panel-heading"> <?= $detail->nama_skpd ?> <div class="pull-right"><a href="#" data-perform="panel-collapse"><i class="ti-minus"></i></a> </div>
                </div>
                <div class="panel-wrapper collapse in" aria-expanded="true">
                  <div class="panel-body">
                    <table class="table">
                      <tr>
                        <td style="width: 120px;">Kode RUP </td>
                        <td>:</td>
                        <td> <strong><?= $detail->kode_rup ?></strong>
                        <td class="text-center" > <strong><?= $detail->metode_pemilihan ?></strong>
                        <td></td>
                        <td> <strong><?= $detail->sumber_dana ?></strong>
                      </tr>
                      <tr>
                        <td style="width: 120px;">Nama Paket </td>
                        <td>:</td>
                        <td colspan="4"> <strong><?= $detail->nama_paket ?></strong>
                      </tr>
                      <tr>
                        <td style="width: 120px;">Pagu </td>
                        <td>:</td>
                        <td> <strong><?= rupiah($detail->pagu) ?></strong>
                        <td class="text-center" style="min-width: 120px;">Waktu Pemilihan </td>
                        <td>:</td>
                        <td> <strong><?= ($detail->bulan_pemilihan == date('m') and $detail->tahun_pemilihan == date('Y')) ? '<i class="fa fa-circle text-warning"></i> ' : ''; ?>
                            <?= ($detail->bulan_pemilihan < date('m') and $detail->tahun_pemilihan == date('Y')) ? '<i class="fa fa-circle text-danger"></i> ' : ''; ?>
                            <?= ($detail->tahun_pemilihan < date('Y')) ? '<i class="fa fa-circle text-danger"></i> ' : ''; ?>
                            <?= bulan($detail->bulan_pemilihan) ?> <?= $detail->tahun_pemilihan ?></strong></td>
                      </tr>
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
            <div class="sttabs tabs-style-underline">
              <nav>
                <ul>
                  <li><a href="#section-underline-1" class="sticon ti-home"><span>Perencanaan - SIRUP</span></a></li>
                  <li><a href="#section-underline-2" class="sticon ti-gift"><span>Realisasi - SIPDOK</span></a></li>
                  <li><a href="#section-underline-3" class="sticon ti-upload"><span>Evaluasi</span></a></li>
                </ul>
              </nav>
              <div class="content-wrap">
                <section id="section-underline-1">
                  <h3>Loading Data</h3>
                  <?php
                  // $url = 'https://sirup.lkpp.go.id/sirup/home/detailPaketPenyediaPublic2017/' . $detail->kode_rup;
                  // $contents = file_get_contents($url);
                  // echo $contents;
                  ?>

                </section>

                <section id="section-underline-2">
                  <a href="#!" style="color:#636e72">
                    <div class="panel panel-primary">
                      <div class="panel-heading">
                        Pemilihan Penyedia <span class="label label-primary bg-white text-purple m-l-5 pull-right">Selesai</span> </div>
                      <div class="panel-wrapper collapse in" aria-expanded="true">
                        <div class="panel-body">
                          <div class="col-sm-2 b-r text-center" style="max-height:110px;">
                            <br>
                            <img src="https://e-office.sumedangkab.go.id/data/foto/pegawai/user-default.png" alt="user-img" style=" object-fit: cover;

					          width: 50%;
					          height: 50%;border-radius: 50%;
					          ">
                            <br>
                            &nbsp
                          </div>
                          <div class="col-sm-3 b-r text-center">
                            <br>
                            <h3 class="panel-title">Nama Penyedia</h3>
                            CV. NOYA
                            <br>
                            &nbsp
                          </div>
                          <div class="col-sm-2 b-r text-center">
                            <br>
                            <h3 class="panel-title">NPWP Penyedia</h3>
                            74.914.312.9-446.000
                            <br>
                            &nbsp
                          </div>
                          <div class="col-sm-5 b-r text-center">
                            <br>
                            <h3 class="panel-title">Alamat Penyedia</h3>
                            Perum Kelapa Gading Permai Blok 84 No.20 RT.05 RW.05 Desa Padasuka Kecamatan Sumedang Utara Kabupaten Sumedang
                            <br>
                            &nbsp
                          </div>

                        </div>
                      </div>
                    </div>
                  </a>
                  <a href="https://dalbangsigsipdok.sumedangkab.go.id/admin/modul/mod_cetakspkkontrak/cetak1.php?id%5B%5D=3482&tgl_cetak=" style="color:#636e72" target="_blank">
                    <div class="panel panel-primary">
                      <div class="panel-heading">
                        Penandatanganan Kontrak <span class="label label-primary bg-white text-purple m-l-5 pull-right">Selesai</span> </div>
                      <div class="panel-wrapper collapse in" aria-expanded="true">
                        <div class="panel-body">
                          <div class="col-sm-2 b-r text-center">
                            <br>
                            <h3 class="panel-title">Tgl. Kontrak</h3>
                            29 Juli 2021 s.d.<br>
                            26 September 2021
                            <br>
                            &nbsp
                          </div>
                          <div class="col-sm-4 b-r text-center">
                            <br>
                            <h3 class="panel-title">No. Kontrak</h3>
                            55.PL/01.08/SPK/PPK/DPUPR/VII/2021/
                            <br>
                            &nbsp
                          </div>
                          <div class="col-sm-4 b-r text-center">
                            <br>
                            <h3 class="panel-title">Nilai Kontrak</h3>
                            Rp30,082,294,270.00
                            <br>
                            &nbsp
                          </div>
                          <div class="col-sm-2 b-r text-center">
                            <br>
                            <h3 class="panel-title">Waktu Pelaksanaan</h3>
                            60 Hari
                            <br>
                            &nbsp
                          </div>

                        </div>
                      </div>
                    </div>
                  </a>
                  <a href="https://dalbangsigsipdok.sumedangkab.go.id/admin/modul/mod_register/cetak1.php?id=3482" style="color:#636e72" target="_blank">
                    <div class="panel panel-primary">
                      <div class="panel-heading">
                        Registrasi <span class="label label-primary bg-white text-purple m-l-5 pull-right">Selesai</span> </div>
                      <div class="panel-wrapper collapse in" aria-expanded="true">
                        <div class="panel-body">
                          <div class="col-sm-2 b-r text-center" style="max-height:110px;">
                            <br>
                            <h3 class="panel-title">Tgl. Registrasi</h3>
                            Sumedang,<br>
                            22 Oktober 2021
                            <br>
                            &nbsp
                          </div>
                          <div class="col-sm-4 b-r text-center">
                            <br>
                            <h3 class="panel-title">No. Registrasi</h3>
                            318/DALBANG/X/2021
                            <br>
                            &nbsp
                          </div>
                          <div class="col-sm-3 b-r text-center">
                            <br>
                            <h3 class="panel-title">Penandatangan</h3>
                            AJENG SENDANG LESTARI, S.Kom
                            <br>
                            19821231 200901 2 005
                            <br>
                            &nbsp
                          </div>
                          <div class="col-sm-3 b-r text-center">
                            <br>
                            <h3 class="panel-title">Jabatan</h3>
                            Kasubag Bidang Pemerintahan dan Sosial
                            <br>
                            &nbsp
                          </div>

                        </div>
                      </div>
                    </div>
                  </a>
                  <a href="<?= base_url('sijagur/monitoring/realisasi') ?>" style="color:#636e72">
                    <div class="panel panel-primary">
                      <div class="panel-heading">
                        Proses Pengerjaan <span class="label label-primary bg-white text-purple m-l-5 pull-right">Selesai</span> </div>
                      <div class="panel-wrapper collapse in" aria-expanded="true">
                        <div class="panel-body">
                          <div class="col-sm-2 b-r text-center" style="max-height:110px;">
                            <div data-label="40hari" class="css-bar css-bar-75 css-bar-lg"></div>
                          </div>
                          <div class="col-sm-3 b-r text-center">
                            <br>
                            <h3 class="panel-title">Jenis Pekerjaan</h3>
                            Pekerjaan Konstruksi
                            <br>
                            &nbsp
                          </div>
                          <div class="col-sm-4 b-r text-center">
                            <br>
                            <h3 class="panel-title">Lokasi Pekerjaan</h3>
                            Cimungkal - Kirisik
                            <br>
                            &nbsp
                          </div>
                          <div class="col-sm-3 b-r text-center">
                            <br>
                            <h3 class="panel-title">Keterangan</h3>
                            Lapis Pondasi Kelas A
                            <br>
                            &nbsp
                          </div>

                        </div>
                      </div>
                    </div>
                  </a>
                  <a href="https://dalbangsigsipdok.sumedangkab.go.id/admin/modul/mod_cetakrekomendasi/cetak1.php?id=3482" style="color:#636e72" target="_blank">
                    <div class="panel panel-primary">
                      <div class="panel-heading">
                        SPM <span class="label label-primary bg-white text-purple m-l-5 pull-right">Selesai</span> </div>
                      <div class="panel-wrapper collapse in" aria-expanded="true">
                        <div class="panel-body">
                          <div class="col-sm-2 b-r text-center">
                            <br>
                            <h3 class="panel-title">Tgl. SPM</h3>
                            29 Juli 2021
                            <br>
                            &nbsp
                          </div>
                          <div class="col-sm-6 b-r text-center">
                            <br>
                            <h3 class="panel-title">No. SPM</h3>
                            55.PL/01.08/SP/PPK/DPUPR/VII/2021
                            <br>
                            &nbsp
                          </div>
                          <div class="col-sm-4 b-r text-center">
                            <br>
                            <h3 class="panel-title">Keterangan Rekomendasi</h3>
                            Lengkap
                            <br>
                            &nbsp
                          </div>

                        </div>
                      </div>
                    </div>
                  </a>
                </section>
                <section id="section-underline-3">

                  <table class="table table-responsive" cellspacing="0" border="0">
                    <colgroup width="145"></colgroup>
                    <colgroup width="128"></colgroup>
                    <colgroup span="2" width="64"></colgroup>
                    <colgroup width="90"></colgroup>
                    <colgroup width="155"></colgroup>
                    <colgroup width="64"></colgroup>
                    <colgroup width="152"></colgroup>
                    <colgroup width="146"></colgroup>
                    <colgroup width="59"></colgroup>
                    <tr>
                      <td style="border-top: 2px solid #000000; border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000" colspan=4 rowspan=2 height="38" align="left" valign=middle bgcolor="#6AF52B"><b>
                          <font color="#000000">DINAS KOMUNIKASI DAN INFORMATIKA, PERSANDIAN STATISTIK</font>
                        </b></td>
                      <td style="border-top: 2px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=4 align="center" valign=bottom bgcolor="#6AF52B"><b>
                          <font color="#000000">Pengguna Angaran</font>
                        </b></td>
                      <td style="border-top: 2px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" rowspan=2 align="center" valign=middle bgcolor="#6AF52B"><b>
                          <font color="#000000">Nomor HP</font>
                        </b></td>
                      <td style="border-top: 2px solid #000000; border-bottom: 1px solid #000000; border-right: 2px solid #000000" rowspan=2 align="center" valign=middle bgcolor="#2F5597"><b>
                          <font face="Arial" size=3 color="#FFFFFF">overall status</font>
                        </b></td>
                    </tr>
                    <tr>
                      <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=3 align="center" valign=bottom bgcolor="#6AF52B"><b>
                          <font color="#000000">Nama</font>
                        </b></td>
                      <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#6AF52B"><b>
                          <font color="#000000">NIP</font>
                        </b></td>
                    </tr>
                    <tr>
                      <td style="border-top: 1px solid #000000; border-bottom: 2px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000" colspan=2 height="20" align="left" valign=middle bgcolor="#FFFF99" sdnum="1033;0;_-[$Rp-421]* #,##0.00_-;-[$Rp-421]* #,##0.00_-;_-[$Rp-421]* &quot;-&quot;??_-;_-@_-"><b>
                          <font color="#000000"> TOTAL BELANJA OPERASIONAL </font>
                        </b></td>
                      <td style="border-top: 1px solid #000000; border-bottom: 2px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=2 align="center" valign=middle bgcolor="#FFFF99" sdval="0" sdnum="1033;0;_-[$Rp-421]* #,##0.00_-;-[$Rp-421]* #,##0.00_-;_-[$Rp-421]* &quot;-&quot;??_-;_-@_-"><b>
                          <font color="#000000"> Rp- </font>
                        </b></td>
                      <td style="border-top: 1px solid #000000; border-bottom: 2px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=3 align="center" valign=middle sdnum="1033;0;_-[$Rp-421]* #,##0.00_-;-[$Rp-421]* #,##0.00_-;_-[$Rp-421]* &quot;-&quot;??_-;_-@_-"><b>
                          <font color="#000000"> Dr. IWA KUSWAERI </font>
                        </b></td>
                      <td style="border-top: 1px solid #000000; border-bottom: 2px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle><b>
                          <font color="#000000">19620303 198803 1 012</font>
                        </b></td>
                      <td style="border-top: 1px solid #000000; border-bottom: 2px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#FFFFFF" sdval="8122375619" sdnum="1033;"><b>
                          <font color="#000000">8122375619</font>
                        </b></td>
                      <td style="border-top: 1px solid #000000; border-bottom: 2px solid #000000; border-right: 2px solid #000000" align="left" valign=middle bgcolor="#FF0000"><b>
                          <font color="#000000"><br></font>
                        </b></td>
                    </tr>
                    <tr>
                      <td height="20" align="left" valign=bottom bgcolor="#FFFFFF">
                        <font color="#000000"><br></font>
                      </td>
                      <td align="left" valign=bottom bgcolor="#FFFFFF">
                        <font color="#000000"><br></font>
                      </td>
                      <td align="left" valign=bottom bgcolor="#FFFFFF">
                        <font color="#000000"><br></font>
                      </td>
                      <td align="left" valign=bottom bgcolor="#FFFFFF">
                        <font color="#000000"><br></font>
                      </td>
                      <td align="left" valign=bottom bgcolor="#FFFFFF">
                        <font color="#000000"><br></font>
                      </td>
                      <td align="left" valign=bottom bgcolor="#FFFFFF">
                        <font color="#000000"><br></font>
                      </td>
                      <td align="left" valign=bottom bgcolor="#FFFFFF">
                        <font color="#000000"><br></font>
                      </td>
                      <td align="left" valign=bottom bgcolor="#FFFFFF">
                        <font color="#000000"><br></font>
                      </td>
                      <td align="left" valign=bottom bgcolor="#FFFFFF">
                        <font color="#000000"><br></font>
                      </td>
                      <td align="left" valign=bottom bgcolor="#FFFFFF">
                        <font color="#000000"><br></font>
                      </td>
                    </tr>
                    <tr>
                      <td style="border-top: 2px solid #000000; border-left: 2px solid #000000" height="20" align="center" valign=middle bgcolor="#2F5597">
                        <font face="Arial" color="#FFFFFF">report period</font>
                      </td>
                      <td style="border-top: 2px solid #000000; border-left: 2px solid #000000; border-right: 2px solid #000000" colspan=9 align="left" valign=middle>
                        <font face="Arial" color="#000000">Minggu I Juli 2021 (02/7/2021)</font>
                      </td>
                    </tr>
                    <tr>
                      <td style="border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-left: 2px solid #000000" height="42" align="center" valign=middle bgcolor="#2F5597">
                        <font face="Arial" color="#FFFFFF">conclusion</font>
                      </td>
                      <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="left" valign=middle>
                        <font face="Arial" color="#000000">Realisasi</font>
                      </td>
                      <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=2 align="left" valign=middle sdval="0" sdnum="1033;0;_-[$Rp-421]* #,##0.00_-;-[$Rp-421]* #,##0.00_-;_-[$Rp-421]* &quot;-&quot;_-;_-@_-">
                        <font face="Arial" color="#000000"> Rp- </font>
                      </td>
                      <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="left" valign=middle sdnum="1033;0;_-[$Rp-421]* #,##0.00_-;-[$Rp-421]* #,##0.00_-;_-[$Rp-421]* &quot;-&quot;??_-;_-@_-">
                        <font face="Arial" color="#000000"> atau baru </font>
                      </td>
                      <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="right" valign=middle sdval="0.99" sdnum="1033;0;0.00%">
                        <font face="Arial" color="#000000">99.00%</font>
                      </td>
                      <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=2 align="left" valign=middle sdnum="1033;0;0.00%">
                        <font face="Arial" color="#000000">dari target bulan Juli 2021 sebesar </font>
                      </td>
                      <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="right" valign=middle sdval="0.8" sdnum="1033;0;0.00%">
                        <font face="Arial" color="#000000">80.00%</font>
                      </td>
                      <td style="border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-right: 2px solid #000000" align="center" valign=middle>
                        <font face="Arial" color="#FFFFFF"><br></font>
                      </td>
                    </tr>
                    <tr>
                      <td style="border-bottom: 2px solid #000000; border-left: 2px solid #000000" rowspan=3 height="58" align="center" valign=middle bgcolor="#2F5597">
                        <font face="Arial" color="#FFFFFF">accomplishments</font>
                      </td>
                      <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 2px solid #000000" colspan=9 align="left" valign=middle>
                        <font face="Arial" color="#000000"><br></font>
                      </td>
                    </tr>
                    <tr>
                      <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 2px solid #000000" colspan=9 align="left" valign=middle>
                        <font face="Arial" color="#000000"><br></font>
                      </td>
                    </tr>
                    <tr>
                      <td style="border-top: 1px solid #000000; border-bottom: 2px solid #000000; border-left: 2px solid #000000; border-right: 2px solid #000000" colspan=9 align="left" valign=middle>
                        <font face="Arial" color="#000000"><br></font>
                      </td>
                    </tr>
                    <tr>
                      <td style="border-left: 2px solid #000000" rowspan=3 height="58" align="center" valign=middle bgcolor="#2F5597">
                        <font face="Arial" color="#FFFFFF">critical issues</font>
                      </td>
                      <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 2px solid #000000" colspan=9 align="left" valign=middle>
                        <font face="Arial" color="#000000"><br></font>
                      </td>
                    </tr>
                    <tr>
                      <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 2px solid #000000" colspan=9 align="left" valign=middle>
                        <font face="Arial" color="#000000"><br></font>
                      </td>
                    </tr>
                    <tr>
                      <td style="border-top: 1px solid #000000; border-left: 2px solid #000000; border-right: 2px solid #000000" colspan=9 align="left" valign=middle>
                        <font face="Arial" color="#000000"><br></font>
                      </td>
                    </tr>
                    <tr>
                      <td style="border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-left: 2px solid #000000" rowspan=2 height="39" align="center" valign=middle bgcolor="#2F5597">
                        <font face="Arial" color="#FFFFFF">major risks</font>
                      </td>
                      <td style="border-top: 2px solid #000000; border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 2px solid #000000" colspan=9 align="left" valign=middle>
                        <font face="Arial" color="#000000">Target IKU, Fisik Kuangan tidak tercapai</font>
                      </td>
                    </tr>
                    <tr>
                      <td style="border-top: 1px solid #000000; border-bottom: 2px solid #000000; border-left: 2px solid #000000; border-right: 2px solid #000000" colspan=9 align="left" valign=middle>
                        <font face="Arial" color="#000000">Penumpukan pekerjaan di akhir tahun anggaran</font>
                      </td>
                    </tr>
                    <tr>
                      <td style="border-bottom: 2px solid #000000; border-left: 2px solid #000000" rowspan=5 height="97" align="center" valign=middle bgcolor="#2F5597">
                        <font face="Arial" color="#FFFFFF">next steps</font>
                      </td>
                      <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 2px solid #000000" colspan=9 align="left" valign=middle>
                        <font face="Arial" color="#000000">Akselarasi Pelaksanaan Kegiatan</font>
                      </td>
                    </tr>
                    <tr>
                      <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 2px solid #000000" colspan=9 align="left" valign=middle>
                        <font face="Arial" color="#000000"><br></font>
                      </td>
                    </tr>
                    <tr>
                      <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 2px solid #000000" colspan=9 align="left" valign=middle>
                        <font face="Arial" color="#000000"><br></font>
                      </td>
                    </tr>
                    <tr>
                      <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 2px solid #000000" colspan=9 align="left" valign=middle>
                        <font face="Arial" color="#000000"><br></font>
                      </td>
                    </tr>
                    <tr>
                      <td style="border-top: 1px solid #000000; border-bottom: 2px solid #000000; border-left: 2px solid #000000; border-right: 2px solid #000000" colspan=9 align="left" valign=middle>
                        <font face="Arial" color="#000000"><br></font>
                      </td>
                    </tr>
                  </table>
                  <!-- ************************************************************************** -->
                </section>
              </div>
              <!-- /content -->
            </div>
            <!-- /tabs -->
          </section>
          <!-- Tabstyle start -->
        </div>
      </div>
    </div>


    <script src="https://e-office.sumedangkab.go.id/asset/pixel/inverse/js/cbpFWTabs.js" defer></script>
    <script type="text/javascript" defer>
      $(document).ready(function() {
        (function() {
          [].slice.call(document.querySelectorAll('.sttabs')).forEach(function(el) {
            new CBPFWTabs(el);
          });
        })();


        function get_sirup() {
          // var xmlHttp = new XMLHttpRequest();
          // xmlHttp.open("GET", "<?= base_url('sijagur/monitoring/get_sirup/' . $detail->kode_rup) ?>", false); // false for synchronous request
          // xmlHttp.send(null);
          // console.log(xmlHttp);
          // return xmlHttp.responseText;
          $.get("<?= base_url('sijagur/monitoring/get_sirup/' . $detail->kode_rup) ?>", function( data ) {
            $("#section-underline-1").html(data); 
            // alert("Load was performed.");
          });
      }
      get_sirup();
      });
    </script>