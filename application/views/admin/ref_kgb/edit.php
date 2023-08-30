<?php foreach ($item as $key) {
                     // $id = $key->id_kgb;
                     // $nama = $key->nama_kgb;
                     // $status = $key->status;
                   }?>
				   



              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel white-box">
                  <div class="x_title">
                    <h2>Edit Gaji Pokok</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                  <form method="post" action="<?php echo base_url()."ref_kgb/update/".$key->id_kgb;?>">
                    <table class="table table-striped">
                      
                      <tbody>

                        <tr>
                          <td>Peraturan Pemerintah</td><td>  
                          <select class="form-control" name="id_pp" placeholder="peraturan pemerintah" required>
                            <?php foreach ($pp as $row): ?>
                            <option value="<?=$row->id_pp?>" <?=($row->id_pp==$key->id_pp)?"selected":""?>><?=$row->nama_pp?></option>
                            <?php endforeach ?>
                          </select></td></tr>
                                                <tr> 
                        <tr>
                          <td>Golongan</td><td>  
                          <select class="form-control" name="id_golongan" placeholder="golongan" required>
                            <?php foreach ($golongan as $row): ?>
                            <option value="<?=$row->id_golongan?>" <?=($row->id_golongan==$key->id_golongan)?"selected":""?>><?=$row->pangkat?> - <?=$row->golongan?></option>
                            <?php endforeach ?>
                          </select></td></tr>
                                                <tr> 
                        <tr>
                          <td>MKG</td><td>  
                          <input type="number" name="mkg" class="form-control" placeholder="MKG" value="<?php echo $key->mkg;?>" required></td></tr>
                                                <tr> 
                        <tr>
                          <td>Gaji Pokok</td><td>  
                          <input type="number" name="gaji_pokok" class="form-control" placeholder="gaji pokok" value="<?php echo $key->gaji_pokok;?>" required></td></tr>
                                                <!-- <tr> 
						 <td>Status </td>
						 <td>
							<?php
								$c1 = $key->status=="Y"? "checked" : "";
								$c2 = $key->status=="N"? "checked" : "";
							?>
                              <input type="radio" name="status" value="Y" <?= $c1;?> > &nbsp; Aktif &nbsp;
                            <input type="radio" name="status" value="N" <?= $c2;?> > Non Aktif</td>
                        </tr> -->
                        
                      </tbody>
                    </table>
                        <input type="hidden" name="status" value="Y">
                       <button type="submit" class="btn btn-info "><i class="fa fa-pencil"></i> Ubah </button>
                       <a   title='Delete' onclick='delete_(<?php echo $key->id_kgb;?>)' class="btn btn-danger"><i class="fa fa-trash-o"></i> Hapus </a>
					   <a href='<?= base_url();?>ref_kgb' class='btn btn-default'>Kembali</a>
                    </form>  
                  </div>
                </div>
              </div>
              </div>





      <script type="text/javascript">
       function delete_(id)
        {
          if (confirm('Apakah anda yakin akan menghapus data?')){
            window.location.href= "<?= base_url();?>ref_kgb/delete/"+id;
          }
        }

      </script>