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



  <div class="white-box">
  <button type="button" data-toggle="modal" data-target="#addkegiatan" class="btn btn-primary e m-t-20" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i> Tambah kegiatan </button>
  
  <table class="table">
    <thead>
    <tr>
        <th>No.</th>
        <th>Kode</th>
        <th>Nama kegiatan</th>
        <th>Program</th>
        <th>kegiatan RPJMD</th>
        <th>Jml. Indikator</th>
        <th>Opsi</th>

    </tr>
    </thead>
    <tbody>
        <tr>

            <td>1</td>
            <td>1.1</td>
            <td>Optimalnya Fungsi Inspektorat sebagai Konsultan, Katalis dan Penjamin Kualitas di Lingkungan Pemerintah Kabupaten Sumedang</td> 
            
            <td>Program 1</td>
            <td>kegiatan 1</td>
            <td>0</td>
            <td><a href="<?=base_url();?>sicerdas/renstra_kegiatan/detail_kegiatan" class="btn btn-info" style="color:white;"><i class="ti-eye"></i> Detail</a></td>
        </tr>

       
    </tbody>

  </table>

  
</div>    


</div>

                
           
    

    </div>
  </div>
</div>



<div class="modal fade" id="addkegiatan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah kegiatan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Program Dari Renstra:</label>
            <select class="form-control">
              <option>kegiatan RPJMD 1</option>
              <option>kegiatan RPJMD 2</option>
              <option>kegiatan RPJMD 3</option>
            </select>
          </div>

          <div class="form-group">
            <label for="message-text" class="col-form-label">Indikator Proram Renstra:</label>
            <select class="form-control">
              <option>Indikator kegiatan RPJMD 1</option>
              <option>Indikator kegiatan RPJMD 2</option>
              <option>Indikator kegiatan RPJMD 3</option>
            </select>
          </div>

          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Pilih Kegiatan :</label>
            <select class="form-control">
              <option>kegiatan 1</option>
              <option>kegiatan 2</option>
              <option>kegiatan 3</option>
            </select>
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