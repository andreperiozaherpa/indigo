<div class="col-md-4 col-xs-12">
                <div class="white-box">
                  <div class="x_title">
                    <h2>pengajuan_absensi</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                     
                      
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />     <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12 " style="text-align:center;">
                          <a href="<?=base_url('pengajuan_absensi/add')?>" > <button type="submit" class="btn btn-success">+ | Tambah pengajuan_absensi</button></a>
                        </div>
                      </div>
                      <br>
                    <div class="ln_solid"></div>
            
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
                    <h2>Daftar pengajuan_absensi </h2>
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
                          <th>#</th>
                          <th>Tanggal Awal</th>
                          <th>Tanggal Akhir</th>
                          <th>Kategori</th>
                          <th>Status</th>
                          <th>Opsi</th>
                        </tr>
                      </thead>
                      <tbody>

                                                <tr>
                          <th scope="row">1</th>
                          <td>1 Agustus 2018</td>
                          <td>17 Agustus 2018</td>
                          <td>Rapat</td>
                          <td>Disetujui</td>
                          <td>

                            <a href="<?=base_url('pengajuan_absensi/view')?>" class="btn btn-primary btn-xs"><i class="fa fa-eye"></i> View </a>
                            <a href="http://43.249.142.77:80/app/ref_bahasa_asing/edit/2" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>
                            <a  title='Delete' onclick='delete_(2)' class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Delete </a>
                          
                            
                          </td>
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