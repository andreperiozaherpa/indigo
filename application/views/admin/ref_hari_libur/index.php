<div class="container-fluid">
  
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title"><?php echo title($title) ?></h4> </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12"> 
                <ol class="breadcrumb">
                    <?php echo breadcrumb($this->uri->segment_array()); ?>
                </ol>
            </div>
            <!-- /.col-lg-12 -->
        </div>
<div class="col-md-4 col-xs-12">
                <div class="white-box">
                  <div class="x_content">
                    <br />     <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12 " style="text-align:center;">
                          <a href="<?=base_url('ref_hari_libur/add')?>" > <button type="submit" class="btn btn-primary">+ | Tambah Hari Libur</button></a>
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
                          <input type="text" class="form-control mydatepicker" name="tanggal_awal">
                        </div>
                      </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Tanggal Akhir</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="text" class="form-control mydatepicker" name="tanggal_akhir">
                        </div>
                      </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Keterangan</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="text" class="form-control" name="keterangan" placeholder="Keterangan" >
                        </div>
                      </div>

                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                          <button type="submit" class="btn btn-default">Reset</button>
                          <button type="submit" class="btn btn-primary">Filter</button>
                        </div>
                      </div>

                    </form>
                  </div>
                </div>
              </div>





              <div class="col-md-8 col-sm-8 col-xs-12">
                <div class="white-box">
                  <div class="x_content">

                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Tanggal Libur</th>
                          <th>Keterangan</th>
                          <th>Opsi</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $no=1; foreach($item as $i){?>

                                                <tr>
                          <th scope="row"><?=$no?></th>
                          <td><?=tanggal($i->tanggal_libur)?></td>
                          <td><?=$i->keterangan?></td>
                          <td>

                            <a href="<?=site_url('ref_hari_libur/edit/'.$i->id_hari_libur.'')?>" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>
                            <a  title='Delete' onclick='delete_(<?=$i->id_hari_libur?>)' class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Delete </a>
                          
                            
                          </td>
                        </tr>
                      <?php $no++; } ?>

                        
                      </tbody>
                    </table>

                  </div>
                </div>
              </div>
			  
			</div>
<script type="text/javascript">
	function delete_(id)
	{
		if (confirm('Apakah anda yakin akan menghapus data?')){
			window.location.href= "<?= base_url();?>ref_hari_libur/delete/"+id;
		}
	}
</script>