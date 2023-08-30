      <div class="container-fluid">
        <div class="row bg-title">
          <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Ref. Bahasa Asing</h4>
          </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
              <ol class="breadcrumb">
                <li class="active">Ref. Bahasa Asing</li>
              </ol>
              </div>
            </div>
<div class="col-md-4 col-xs-12">
                <div class="x_panel white-box">
                  <div class="x_title">
                    <h2>Tambah bahasa asing </h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                     
                      
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    <form class="form-horizontal form-label-left" method="post" action="<?php echo base_url();?>ref_bahasa_asing/add">

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Nama bahasa_asing</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="text" class="form-control" name="nama" placeholder="nama bahasa_asing" required>
                        </div>
                      </div>

                      
                      
              <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Status</label>
                        <div class="col-md-7 col-sm-7">
                          <div id="gender" class="btn-group" data-toggle="buttons">
                            <label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                              <input type="radio" name="status" value="Y" checked> &nbsp; Aktif &nbsp;
                            </label>
                            <label class="btn btn-primary" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                              <input type="radio" name="status" value="N"> Non Aktif
                            </label>
                          </div>
                        </div>
                      </div>

                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                          <button type="submit" class="btn btn-success">Tambah</button>
                        </div>
                      </div>

                    </form>
                  </div>
                </div>
              </div>





              <div class="col-md-8 col-sm-8 col-xs-12">
                <div class="x_panel white-box">
                  <div class="x_title">
                    <h2>Daftar bahasa_asing </h2>
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
                          <th>Nama bahasa_asing</th>
                          <th>Status</th>
                          <th>Opsi</th>
                        </tr>
                      </thead>
                      <tbody>

                        <?php 
                          $no=1; foreach ($item as $key){
                          if ($key->status=="Y") {
                           $status = "Aktif";
                          }elseif ($key->status=="N") {
                           $status = "Non Aktif";
                          }
                        ?>
                        <tr>
                          <th scope="row"><?php echo $no;?></th>
                          <td><?php echo $key->nama_bahasa_asing;?></td>
                          <td><?php echo $status;?></td>
                          <td>

                            <a href="<?php echo base_url(). "ref_bahasa_asing/edit/".$key->id_bahasa_asing ;?>" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>
                            <a  title='Delete' onclick='delete_(<?php echo $key->id_bahasa_asing;?>)' class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Delete </a>
                          
                            
                          </td>
                        </tr>
                        <?php $no++;}?>
                        
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
			window.location.href= "<?= base_url();?>ref_bahasa_asing/delete/"+id;
		}
	}
</script>