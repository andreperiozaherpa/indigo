<div class="container-fluid">

  <div class="row bg-title">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
      <h4 class="page-title">Ren. Strategis</h4>
    </div>
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
      <ol class="breadcrumb">
        <li class="active">Ren. Strategis</li>
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
              <center><img style="width: 80%" src="<?= base_url(); ?>/data/logo/skpd/sumedang.png" alt="user" class="img-circle"> </center>
            </div>
            <div class="col-md-9">
              <div class="panel panel-default">
                <div class="panel-heading"> DINAS KOPERASI, USAHA KECIL, MENENGAH, PERDAGANGAN DAN PERINDUSTRIAN <div class="pull-right"><a href="#" data-perform="panel-collapse"><i class="ti-minus"></i></a> </div>
                </div>
                <div class="panel-wrapper collapse in" aria-expanded="true">
                  <div class="panel-body">
                    <table class="table">
                      <tbody>
                        <tr>
                          <td style="width: 120px;">Nama Kepala </td>
                          <td>:</td>
                          <td> <strong>DENI TANRUS, S.IP</strong></td>
                        </tr>
                        <tr>
                          <td style="width: 120px;">Alamat SKPD </td>
                          <td>:</td>
                          <td> <strong>JL. Mayor Abdul Rachman No.107, Kotakaler, Kec. Sumedang Utara, Kabupaten Sumedang, Jawa Barat 45621</strong></td>
                        </tr>
                        <tr>
                          <td style="width: 120px;">Email/tlp </td>
                          <td>:</td>
                          <td> <strong>diskopukmpp@sumedangkab.go.id / (0261) 201238</strong>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="col-md-12">
    <div class="panel panel-default block6">
      <div class="panel-heading"> Detail Sasaran
        <div class="pull-right"><a href="#" data-perform="panel-collapse"><i class="ti-minus"></i></a> <a href="#" data-perform="panel-dismiss"><i class="ti-close"></i></a> </div>
      </div>
      <div class="panel-wrapper collapse in" aria-expanded="true">
        <div class="panel-body">
          <div class="row">
            <div class="col-md-6 b-r">
              <div class="row">
                <div class="col-md-12 b-b">
                  <h3 class="box-title m-b-0">Visi</h3>
                  <p> Terwujudnya Masyarakat Sumedang yang Sejahtera, Agamis, Maju, Profesional, dan Kreatif (SIMPATI) Pada Tahun 20231</p>
                </div>
                <div class="col-md-12">
                  <h3 class="box-title m-b-0">Misi</h3>
                  <p>
                    Menata birokrasi pemerintah yang responsif dan bertanggung jawab secara profesional dalam pelayanan masyarakat</p>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="col-md-12 b-b">
                <h3 class="box-title m-b-0">Tujuan</h3>
                <p>
                  Terwujudnya pelayanan publik yang berkualitas </p>
              </div>

              <div class="col-md-12 b-b">
                <h3 class="box-title m-b-0 ">Indikator Tujuan</h3>
                <p>Meningkatnya kualitas pelayanan publik </p>
              </div>

              <div class="col-md-12">
                <h3 class="box-title m-b-0">Urusan</h3>
                <p>Pendidikan </p>
              </div>

            </div>

          </div>

        </div>
      </div>
    </div>


    <div class="white-box">
      <b>Nama Sasaran : </b>Sasaran 1
      <table class="table table-bordered table-striped table-hover table-responsive ">
        <thead>
          <tr style="">
            <th style="text-align: center;vertical-align:middle">#</th>
            <th style="text-align: center;vertical-align:middle">Indikator</th>
            <th style="text-align: center;vertical-align:middle">Kondisi Awal</th>
            <th style="text-align: center;vertical-align:middle">Target 2019</th>
            <th style="text-align: center;vertical-align:middle">Target 2020</th>
            <th style="text-align: center;vertical-align:middle">Target 2021</th>
            <th style="text-align: center;vertical-align:middle">Target 2022</th>
            <th style="text-align: center;vertical-align:middle">Target 2023</th>
            <th style="text-align: center;vertical-align:middle">Kondisi Akhir</th>
            <th style="text-align: center;vertical-align:middle">Satuan</th>
            <th style="text-align: center;vertical-align:middle">Opsi</th>
          </tr>

        </thead>
        <tbody>
          <tr>
            <th>1</th>
            <td>Indeks Kepuasan masyarakat Bidang Perizinan</td>
            <td>-</td>
            <td>-</td>
            <td>-</td>
            <td>87,23</td>
            <td>88,31</td>
            <td>90,00</td>
            <td>90,00</td>
            <td>indeks</td>
            <td>
              <a href="javascript:void(0)" onclick="editIndikator(2)" class="btn btn-info btn-circle"><i class="ti-pencil"></i></a>
              <a href="javascript:void(0)" onclick="hapusIndikator(2)" class="btn btn-danger btn-circle"><i class="ti-trash"></i></a>
            </td>
          </tr>

        </tbody>
      </table>


      <button type="button" data-toggle="modal" data-target="#addIndikator" class="btn btn-primary e m-t-20" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i> Tambah Indikator </button>


    </div>


  </div>





</div>
</div>
</div>



<div class="modal fade" id="addIndikator" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Sasaran</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>

          <div class="form-group">
            <label for="message-text" class="col-form-label">Nama Indikator :</label>
            <input type="text" class="form-control">
          </div>

        

          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Satuan:</label>
            <select class="form-control">
              <option>Indeks</option>
              <option>Dokumen</option>
              <option>Kegiatan</option>
            </select>
          </div>






          <div class="row">
            <div class="col-md-6">
              <table class="table table-bordered p-t-20">
                <tr class="active">
                  <td style="text-align: center;"><b>Target Kondisi Awal</b></td>
                </tr>
                <tr>
                  <td><input type="text" name="kondisi_awal" class="form-control" placeholder="Masukkan Target"></td>
                </tr>
              </table>
            </div>

            <div class="col-md-6">
              <table class="table table-bordered p-t-20">
                <tr class="active">
                  <td style="text-align: center;"><b>Target Tahun 2019</b></td>
                </tr>
                <tr>
                  <td><input type="text" name="kondisi_awal" class="form-control" placeholder="Masukkan Kondisi target"></td>
                </tr>
              </table>
            </div>

            <div class="col-md-6">
              <table class="table table-bordered p-t-20">
                <tr class="active">
                  <td style="text-align: center;"><b>Taget Tahun 2020</b></td>
                </tr>
                <tr>
                  <td><input type="text" name="kondisi_awal" class="form-control" placeholder="Masukkan Kondisi target"></td>
                </tr>
              </table>
            </div>

            <div class="col-md-6">
              <table class="table table-bordered p-t-20">
                <tr class="active">
                  <td style="text-align: center;"><b>Target Tahun 2021</b></td>
                </tr>
                <tr>
                  <td><input type="text" name="kondisi_awal" class="form-control" placeholder="Masukkan Kondisi target"></td>
                </tr>
              </table>
            </div>

            <div class="col-md-6">
              <table class="table table-bordered p-t-20">
                <tr class="active">
                  <td style="text-align: center;"><b>Target Tahun 2022</b></td>
                </tr>
                <tr>
                  <td><input type="text" name="kondisi_awal" class="form-control" placeholder="Masukkan Kondisi target"></td>
                </tr>
              </table>
            </div>

            <div class="col-md-6">
              <table class="table table-bordered p-t-20">
                <tr class="active">
                  <td style="text-align: center;"><b>Target Tahun 2023</b></td>
                </tr>
                <tr>
                  <td><input type="text" name="kondisi_awal" class="form-control" placeholder="Masukkan Kondisi target"></td>
                </tr>
              </table>
            </div>

            <div class="col-md-6">
              <table class="table table-bordered p-t-20">
                <tr class="active">
                  <td style="text-align: center;"><b>Kondisi Akhir</b></td>
                </tr>
                <tr>
                  <td><input type="text" name="kondisi_awal" class="form-control" placeholder="Masukkan Kondisi target"></td>
                </tr>
              </table>
            </div>
          </div>





        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="button" class="btn btn-primary">Simpan</button>
      </div>
    </div>
  </div>
</div>