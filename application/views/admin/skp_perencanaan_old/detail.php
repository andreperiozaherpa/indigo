<div class="container-fluid">

  <div class="row bg-title">
    <!-- .page title -->
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
      <h4 class="page-title">Tambah Kegiatan SKP</h4>
    </div>
    <!-- /.page title -->
    <!-- .breadcrumb -->
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

      <ol class="breadcrumb">
        <li><a href="<?= base_url();?>/skp_perencanaan">SKP</a></li>
        <li class="active">Tambah</li>
      </ol>
    </div>
    <!-- /.breadcrumb -->
  </div>

  <div class="row">
    <div class="white-box">
      <div class="user-bg"> <img width="100%" height="100%" alt="user" src="https://e-office.sumedangkab.go.id/data/images/header/header2.jpg">
        <div class="overlay-box">
          <div class="col-md-3">
            <div class="user-content" <a="" href="javascript:void(0)"><img src="https://e-office.sumedangkab.go.id/data/foto/pegawai/fotoku1.png" class="thumb-lg img-circle" style=" object-fit: cover;
            width: 80px;
            height: 80px;border-radius: 50%;
            " alt="img">
            <h5 class="text-white"><b>SUPRIYANTO, SKM</b></h5>
            <h6 class="text-white">196604141988031009</h6>
          </div>
        </div>
        <div class="col-md-3" style="border-right: 1px solid grey;border-left: 1px solid grey;">
          <br>
          <div class="user-content" style="padding-bottom:15px;">
            <h5 class="text-white"><b>SKPD</b></h5>
            <h6 class="text-white">DINAS KESEHATAN</h6>
          </div>
        </div>
        <div class="col-md-3" style="border-right: 1px solid grey;">
          <br>
          <div class="user-content" style="padding-bottom:15px;">
            <h5 class="text-white"><b>Unit Kerja</b></h5>
            <h6 class="text-white">Sub Bagian Umum, Aset dan Kepegawaian</h6>
          </div>
        </div>
        <div class="col-md-3">
          <br>
          <div class="user-content" style="padding-bottom:15px;">
            <h5 class="text-white"><b>Jabatan</b></h5>
            <h6 class="text-white">Kepala Seksi Pelayanan Umum pada Kecamatan Situraja</h6>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>
<div class="row">

  <div class="white-box">
    <h3 class="box-title">DAFTAR KEGIATAN</h3>
    <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap" style="margin-bottom: 20px">Tambah Kegiatan SKP</button
      <div class="comment-center">
        <div class="comment-body" style="width: 100%">
          <table class="table table-bordered table-striped">
            <thead>
              <tr class="info">
                <th>No.</th>
                <th>Kegiatan Tugas Jabatan</th>
                <th>Angka Kredit</th>
                <th>Kuantiti</th>
                <th>Output</th>
                <th>kualitas</th>
                <th>Waktu</th>
                <th>Satuan</th>
                <th>Biaya</th>
              </tr>
            </thead>

            <tbody>
              <tr>
                <td>1.</td>
                <td>Pembangunan Puksesmas</td>
                <td>3.2</td>
                <td>1</td>
                <td>Bangunan</td>
                <td>1</td>
                <td>12</td>
                <td>Bulan</td>
                <td>-</td>
              </tr>
            </tbody>
          </table>

          <table class="table table-bordered table-striped">
            <thead>
              <tr class="success">
                <th>No.</th>
                <th>Kegiatan Tugas Tambahan</th>
                <th>Angka Kredit</th>
                <th>Kuantiti</th>
                <th>Output</th>
                <th>kualitas</th>
                <th>Waktu</th>
                <th>Satuan</th>
                <th>Biaya</th>
              </tr>
            </thead>

            <tbody>
              <tr>
                <td>-</td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
              </tr>
            </tbody>
          </table>

          <table class="table table-bordered table-striped">
            <thead>
              <tr class="warning">
                <th>No.</th>
                <th>Kegiatan Tugas Kreatifitas</th>
                <th>Angka Kredit</th>
                <th>Kuantiti</th>
                <th>Output</th>
                <th>kualitas</th>
                <th>Waktu</th>
                <th>Satuan</th>
                <th>Biaya</th>
              </tr>
            </thead>

            <tbody>
              <tr>
                <td>-</td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
              </tr>
            </tbody>
          </table>



        </div>
      </div>


    </div>

  </div>
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="exampleModalLabel1">Tambah Kegiatan</h4>
        </div>
        <div class="modal-body">
          <form>

            <div class="form-group">
              <label class="control-label">Jenis Kegiatan</label>
              <div class="radio-list">
                <label class="radio-inline p-0">
                  <div class="radio radio-info">
                    <input type="radio" name="radio" id="radio1" value="option1">
                    <label for="radio1">Tugas Jabatan</label>
                  </div>
                </label>
                <label class="radio-inline">
                  <div class="radio radio-info">
                    <input type="radio" name="radio" id="radio2" value="option2">
                    <label for="radio2">Tugas Tambahan</label>
                  </div>
                </label>

                <label class="radio-inline">
                  <div class="radio radio-info">
                    <input type="radio" name="radio" id="radio2" value="option2">
                    <label for="radio2">Tugas Kreatifitas</label>
                  </div>
                </label>
              </div>
            </div>

            <div class="form-group">
              <label class="control-label">Ambil dari</label>
              <select class="form-control" data-placeholder="Choose a Category" tabindex="1">
                <option value="Category 1">-</option>
                <option value="Category 2">Perjanjian Kinerja</option>
                <option value="Category 3">Tupoksi</option>
              </select>
            </div>

            <div class="form-group">
              <label for="recipient-name" class="control-label">Nama Kegiatan</label>
              <input type="text" class="form-control" id="recipient-name1">
            </div>

            

            <div class="row">
              <div class="col-md-4">
               <div class="form-group">
                <label for="recipient-name" class="control-label">Kuantiti</label>
                <input type="Text" class="form-control" id="recipient-name1">
              </div>
            </div>
            <div class="col-md-4">
               <div class="form-group">
                <label for="recipient-name" class="control-label">Output</label>
                <select class="form-control" data-placeholder="Choose a Category" tabindex="1">
                <option value="Category 1">Dokumen</option>
                <option value="Category 2">Bangunan</option>
                <option value="Category 3">Unit</option>
              </select>
              </div>
            </div>

             <div class="col-md-4">
            <div class="form-group">
              <label for="recipient-name" class="control-label">Angka Kredit</label>
              <input type="Text" class="form-control" id="recipient-name1">
            </div>
          </div>


          </div>

            <div class="row">
              <div class="col-md-4">
               <div class="form-group">
                <label for="recipient-name" class="control-label">Kualitas</label>
                <input type="Text" class="form-control" id="recipient-name1">
              </div>
            </div>

             <div class="col-md-4">
               <div class="form-group">
                <label for="recipient-name" class="control-label">Waktu</label>
                <input type="Text" class="form-control" id="recipient-name1">
              </div>
            </div>

            <div class="col-md-4">
               <div class="form-group">
                <label for="recipient-name" class="control-label">Satuan</label>
                <select class="form-control" data-placeholder="Choose a Category" tabindex="1">
                <option value="Category 1">Bulan</option>
                <option value="Category 2">Tahun</option>
                <option value="Category 3">Semester</option>
                <option value="Category 3">Triwulan</option>
              </select>
              </div>
            </div>

            <div class="col-md-12">
               <div class="form-group">
                <label for="recipient-name" class="control-label">Biaya</label>
                <input type="Text" class="form-control" id="recipient-name1">
              </div>
            </div>

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