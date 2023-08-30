<div class="col-md-12 col-sm-12 col-xs-12">
  <div class="white-box">
    <div class="x_title">
      <h2>Tambah Pengajuan Absen</h2>
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
            <input type="text" class="mydatepicker form-control" placeholder="Masukkan Tanggal Awal" name="tanggal_awal"required>
          </div>
        </div>

        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Tanggal Akhir</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <input type="text" class="mydatepicker form-control" placeholder="Masukkan Tanggal Akhir" name="tanggal_akhir"required>
          </div>
        </div>

        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Kategori Absensi</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
                          <select class="form-control">
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
            <textarea class="form-control" placeholder="Masukkan Keterangan"></textarea>
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">File Pendukung</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <input type="file" class="form-control" name="nama"required>
          </div>
        </div>

        <div class="ln_solid"></div>
        <div class="form-group">
          <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
            <a href="<?=base_url('pengajuan_absensi')?>" class="btn btn-default">Batal</a>
            <button type="submit" class="btn btn-success">Tambah</button>
          </div>
        </div>

      </form> 
    </div>
  </div>
</div>
</div>
