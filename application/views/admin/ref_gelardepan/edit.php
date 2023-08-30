 <?php foreach ($item as $key) {
                     $id = $key->id_gelardepan;
                     $nama = $key->nama_gelardepan;
                     $status = $key->status;
                   }?>



              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel white-box">
                  <div class="x_title">
                    <h2>Edit gelar depan</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                  <form method="post" action="<?php echo base_url()."ref_gelardepan/update/".$id;?>">
                    <table class="table table-striped">
                      
                      <tbody>

                        <tr>
                          <td>Nama gelar</td> <td>  <input type="text" name="nama" class="form-control" placeholder="nama gelardepan" value="<?php echo $nama;?>" required></td></tr>
                         <tr> 
						 <td>Status </td>
						 <td>
							<?php
								$c1 = $status=="Y"? "checked" : "";
								$c2 = $status=="N"? "checked" : "";
							?>
                              <input type="radio" name="status" value="Y" <?= $c1;?> > &nbsp; Aktif &nbsp;
                            <input type="radio" name="status" value="N" <?= $c2;?> > Non Aktif</td>
                        </tr>
						
                      </tbody>
                    </table>
						<a href='<?= base_url();?>ref_gelardepan' class='btn btn-default'>Kembali</a>
                       <button type="submit" class="btn btn-info ">Ubah </button>
                    </form>  
                  </div>
                </div>
              </div>
              </div>





