<div class="col-md-12 col-sm-12 col-xs-12">
  <div class="white-box">
    <div class="x_title">
      <h2>Lihat Pengajuan Absen</h2>
      <ul class="nav navbar-right panel_toolbox">
        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
        </li>

      </ul>
      <div class="clearfix"></div>
    </div>
    <div class="x_content">
      <form class="form-horizontal form-label-left" method="post">

        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Tanggal Awal</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <input type="date" class="form-control" name="nama"required disabled>
          </div>
        </div>

        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Tanggal Akhir</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <input type="date" class="form-control" name="nama"required disabled>
          </div>
        </div>

        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Kategori Absensi</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
                          <select class="form-control" disabled>
                            <option value="">Pilih Kategori</option>
                            <option value="">Kategori 1</option>
                            <option value="">Kategori 2</option>
                            <option value="">Kategori 3</option>
                          </select>
          </div>
        </div>

        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Keterangan</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <textarea class="form-control" disabled></textarea>
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">File Pendukung</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <input type="file" class="form-control" name="nama" required disabled>
          </div>
        </div>

        <div class="ln_solid"></div>
        <div class="form-group">
          <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
            <a href="<?=base_url('pengajuan_absensi')?>" class="btn btn-default">Kembali</a>
            <button type="submit" class="btn btn-danger">Tolak</button>
            <button type="submit" class="btn btn-success">Terima</button>
          </div>
        </div>

      </form> 
    </div>
  </div>
</div>
</div>
