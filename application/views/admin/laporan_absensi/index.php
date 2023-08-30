<div class="col-md-4 col-xs-12">
                <div class="white-box">
                  <div class="x_title">
                    <h2>laporan_absensi</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                     
                      
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br /> 
            
                    <h4 align="center">Filter Data</h4>
                    <div class="ln_solid"></div>

                    <form class="form-horizontal form-label-left" method="post">

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Tanggal Awal</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="date" class="form-control" name="nama"required>
                        </div>
                      </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Tanggal Akhir</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="date" class="form-control" name="nama"required>
                        </div>
                      </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Kategori</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <select class="form-control">
                            <option value="">Semua</option>
                            <option value="">Kategori 1</option>
                            <option value="">Kategori 2</option>
                            <option value="">Kategori 3</option>
                          </select>
                        </div>
                      </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Pegawai</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <select class="form-control">
                            <option value="">Semua</option>
                            <option value="">Pegawai 1</option>
                            <option value="">Pegawai 2</option>
                            <option value="">Pegawai 3</option>
                          </select>
                        </div>
                      </div>


                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                          <button type="submit" class="btn btn-default">Reset</button>
                          <button type="submit" class="btn btn-success">Filter</button>
                        </div>
                      </div>

                    </form>
                  </div>
                </div>
              </div>





              <div class="col-md-8 col-sm-8 col-xs-12">
                <div class="white-box">
                  <div class="x_title">
                    <h2>Daftar laporan_absensi </h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <table class="table table-striped">
                      <thead>
                        <tr>
                                            <th>Hari, Tanggal</th>
                                            <th>Nama Pegawai</th>
                                            <th>Jam Masuk</th>
                                            <th>Jam Pulang</th>
                                            <th>Keterangan</th>
                        </tr>
                      </thead>
                      <tbody>

                                            <tr>
                                                <td>Senin, 8 Agustus 2018</td>
                                                <td>Pegawai</td>
                                                <td>07.00</td>
                                                <td>17.00</td>
                                                <td>-</td>
                                            </tr>
                                            <tr>
                                                <td>Selasa, 9 Agustus 2018</td>
                                                <td>Pegawai</td>
                                                <td class="warning">-</td>
                                                <td class="warning">-</td>
                                                <td>Sakit</td>
                                            </tr>
                                            <tr>
                                                <td>Rabu, 10 Agustus 2018</td>
                                                <td>Pegawai</td>
                                                <td>07.00</td>
                                                <td>17.00</td>
                                                <td>-</td>
                                            </tr>
                                            <tr>
                                                <td>Kamis, 11 Agustus 2018</td>
                                                <td>Pegawai</td>
                                                <td class="success">-</td>
                                                <td class="success">-</td>
                                                <td>Tugas Luar Dinas</td>
                                            </tr>
                                            <tr>
                                                <td>Jumat, 12 Agustus 2018</td>
                                                <td>Pegawai</td>
                                                <td>07.00</td>
                                                <td>17.00</td>
                                                <td>-</td>
                                            </tr>

                        
                      </tbody>
                    </table>

                  </div>
                </div>
              </div>
			  
			
<script type="text/javascript">
	function delete_(id)
	{
		if (confirm('Apakah anda yakin akan menghapus data?')){
			window.location.href= "<?= base_url();?>ref_bahasa_asing/delete/"+id;
		}
	}
</script>