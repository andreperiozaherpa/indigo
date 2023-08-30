<div class="col-md-4 col-xs-12">
                <div class="white-box">
                  <div class="x_title">
                    <h2>kode_kegiatan</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                     
                      
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />     <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12 " style="text-align:center;">
                          <a href="<?=base_url('ref_kode_kegiatan/add')?>" > <button type="submit" class="btn btn-success">+ | Tambah kode_kegiatan</button></a>
                        </div>
                      </div>
                      <br>
                    <div class="ln_solid"></div>
            
                    <h4 align="center">Filter Data</h4>
                    <div class="ln_solid"></div>

                    <form class="form-horizontal form-label-left" method="post">

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Kode Kegiatan</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="text" class="form-control" name="kode_kegiatan">
                        </div>
                      </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Nama Lokasi</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="text" class="form-control" name="nama_lokasi">
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
                    <h2>Daftar kode_kegiatan </h2>
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
                          <th>Kode Kegiatan</th>
                          <th>Anggaran</th>
                          <th>Lokasi</th>
                          <th>Opsi</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $no=1; foreach($item as $i){?>

                                                <tr>
                          <th scope="row"><?=$no?></th>
                          <td><?=$i->kode_kegiatan?></td>
                          <td><?=rupiah($i->anggaran)?></td>
                          <td><?=$i->nama_lokasi?></td>
                          <td>

                            <a href="<?=site_url('ref_kode_kegiatan/edit/'.$i->id_kode_kegiatan.'')?>" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>
                            <a  title='Delete' onclick='delete_(<?=$i->id_kode_kegiatan?>)' class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Delete </a>
                          
                            
                          </td>
                        </tr>

                      <?php } ?>
                        
                      </tbody>
                    </table>

                  </div>
                </div>
              </div>
			  
			
<script type="text/javascript">
	function delete_(id)
	{
		if (confirm('Apakah anda yakin akan menghapus data?')){
			window.location.href= "<?= base_url();?>ref_kode_kegiatan/delete/"+id;
		}
	}
</script>