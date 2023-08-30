      <div class="container-fluid">
        <div class="row bg-title">
          <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Ref. Tempat Pendidikan</h4>
          </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
              <ol class="breadcrumb">
                <li class="active">Ref. Tempat Pendidikan</li>
              </ol>
              </div>
            </div>
<div class="col-md-4 col-xs-12">
                <div class="x_panel white-box">
                  <div class="x_title">
                    <h2>Tambah Sekolah </h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                     
                      
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                     <form class="form-horizontal form-label-left" method="post" action="<?php echo base_url();?>ref_tempatpendidikan/add">

                   
                     

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Nama Sekolah</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="text" name="nama_tempatpendidikan" class="form-control" placeholder="">
                        </div>
                      </div>
					<div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Level</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <select name="level" class="form-control">
							<?php
								for($i=1;$i<=(count($arr_level));$i++){
									echo "<option value=$i>$arr_level[$i]</option>";
								}
							?>
						  </select>
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
                    <h2>Daftar Sekolah</h2>
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
                          <th>Sekolah</th>
						  <th>Level</th>
                          <th>Status</th>
                          <th width='150px'>Opsi</th>
                        </tr>
                      </thead>
                      <tbody>
					   <?php 
                          $no=($offset+1); foreach ($result as $key){
                          if ($key->status=="Y") {
                           $status = "Aktif";
                          }elseif ($key->status=="N") {
                           $status = "Non Aktif";
                          }
                        ?>
                        <tr>
                          <th scope="row"><?php echo $no;?></th>
                          <td><?php echo $key->nama_tempatpendidikan;?></td>
                          
							<td></td>
                          <td><?php echo $status;?></td>
                          <td>

                             <a href="<?php echo base_url(). "ref_tempatpendidikan/edit/".$key->id_tempatpendidikan ;?>" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>
                           <a   title='Delete' onclick='delete_(<?php echo $key->id_tempatpendidikan;?>)' class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Delete </a>
                          	
                          	
                          </td>
                        </tr>
                        <?php $no++;}?>

                       
                      </tbody>
                    </table>
					<div class='row'>
						<div class='col-md-12 pager'>
						<?php
			
						
							$CI =& get_instance();
							$CI->load->library('pagination');

							$config['base_url'] = base_url(). 'ref_tempatpendidikan/index/';
							$config['total_rows'] = $total_rows;
							$config['per_page'] = $per_page;
							$config['attributes'] = array('class' => 'btn btn-primary btn-xm marginleft2px');
							$config['page_query_string']=TRUE;
							$CI->pagination->initialize($config);
							$link = $CI->pagination->create_links();
							$link = str_replace("<strong>", "<button type='button' class='btn btn-primary btn-xm disabled marginleft2px' >", $link);
							$link = str_replace("</strong>", "</button>", $link);
							echo $link;
							
						?>
						</div>

					</div>
                  </div>
                </div>
              </div>
              </div>
<script type="text/javascript">
	function delete_(id)
	{
		if (confirm('Apakah anda yakin akan menghapus data?')){
			window.location.href= "<?= base_url();?>ref_tempatpendidikan/delete/"+id;
		}
	}
</script>