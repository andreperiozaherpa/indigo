





              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel white-box">
                  <div class="x_title">
                    <h2>Edit Jenjang Pendidikan</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      
                    </ul>
                    <div class="clearfix"></div>
                  </div>
				  <?php if (!empty($message)) echo "
				<div class='alert alert-$message_type'>$message</div>";?>
				
                  <div class="x_content">
				<form role="form" class="form-horizontal " method='post' enctype="multipart/form-data">
				
                    <table class="table table-striped">
                      
                      <tbody>
                        <tr>
                          <td>Jenjang</td><td>  <input type="text" class="form-control" name="nama_jenjangpendidikan" placeholder="Jenjang Pendidikan" value="<?php echo $nama_jenjangpendidikan;?>"></td>
						</tr>
						<tr>
							<td>Level</td>
							<td>
								<select name="level" class="form-control">
								<?php
									for($i=1;$i<=(count($arr_level));$i++){
										$selected= $level == $i ? "selected" : "";
										echo "<option value=$i $selected>$arr_level[$i]</option>";
									}
								?>
							  </select>
						  </td>
						</tr>
						<tr>
                          <td>Keterangan</td> <td>  <input type="text" class="form-control" name="keterangan" placeholder="Keterangan" value="<?php echo $keterangan;?>"></td>
						</tr>
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
                       <button type="submit" class="btn btn-primary">Update</button> 
					   <a href="<?=base_url();?>ref_pendidikan" class="btn btn-default">Kembali</a> 
					</form>
                  </div>
                </div>
              </div>
              </div>



