    <div class="container-fluid">
        <div class="row bg-title">
          <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Ref. Jenis Pengajuan Surat</h4>
          </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
              <ol class="breadcrumb">
                <li class="active">Ref. Jenis Pengajuan Surat</li>
              </ol>
              </div>
            </div>
            <div class="col-md-4 col-xs-12">
                <div class="white-box">
                  <div class="x_title">
                    <h2>Tambah Jenis Pengajuan Surat </h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    <form class="form-horizontal form-label-left" method="post" action="<?php echo base_url();?>ref_jenis_pengajuan_surat/add">
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Jenis Pengajuan Surat</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="text" class="form-control" name="jenis_pengajuan_surat" placeholder="nama jenis pengajuan surat" required>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Deskripsi</label>
                        <div class="col-md-9 col-sm-9">
                          <textarea class="form-control" name="deskripsi" id="" cols="30" rows="3" required></textarea>
                        </div>
                      </div>
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                          <button type="reset" class="btn btn-primary">Cancel</button>
                          <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
              <div class="col-md-8 col-sm-8 col-xs-12">
                <div class="white-box">
                  <div class="x_title">
                    <h2>Daftar Jenis Surat Pengajuan </h2>
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
                          <th>Jenis Pengajuan Surat</th>
                          <th>Deskripsi</th>
                          <th>Opsi</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                          $no=1; foreach ($item as $key){
                        ?>
                        <tr>
                          <th scope="row"><?php echo $no;?></th>
                          <td><?php echo $key->jenis_pengajuan_surat;?></td>
                          <td><?php echo $key->deskripsi;?></td>
                          <td>
                            <a href="<?php echo base_url(). "ref_jenis_pengajuan_surat/edit/".$key->id_ref_jenis_pengajuan_surat ;?>" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>
                           <a   title='Delete' onclick='delete_(<?php echo $key->id_ref_jenis_pengajuan_surat;?>)' class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Delete </a>
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
      			window.location.href= "<?= base_url();?>ref_jenis_pengajuan_surat/delete/"+id;
      		}
      	}

      </script>
