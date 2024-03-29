<div class="col-md-4 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Pengajuan izin belajar</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                     
                      
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />


                      <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12 " style="text-align:center;">
                          <a href="<?php echo base_url(). "pengajuan_izin_belajar/add" ;?>" > <button type="submit" class="btn btn-success">+ | Tambah pengajuan</button></a>
                        </div>
                      </div>
                      <br>
                    <br>
					<br>
                             <div class="ln_solid"></div>
							  <h4 align="center">Filter Data   </h4>
							  <div class="ln_solid"></div>
                    <form class="form-horizontal form-label-left" method=post>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">NIP</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="text" class="form-control" name='nip' placeholder="NIP" value='<?= !empty($nip)? $nip : "" ;?>'>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Nama </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="text" class="form-control" name='nama' placeholder="Nama" value="<?= !empty($nama)? $nama : "" ;?>">
                        </div>
                      </div>

                       <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Status </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <select class="form-control" name='status'>
							<?php
								foreach($arrStatusPengajuan as $key=>$val){
									$selected = $status==$key? "selected" : "";
									echo "<option value='$key' $selected >$val</option>";
								}
							?>
                             
                          </select>
                        </div>
                      </div>

                   

                       
                      
                      
                      
           

                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                          <a href='<?= base_url();?>pengajuan_izin_belajar' class="btn btn-primary">Reset</a>
                          <button type="submit" class="btn btn-success">Filter</button>
                        </div>
                      </div>

                    </form>
                  </div>
                </div>
              </div>


              <div class="col-md-8 col-sm-8 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Daftar pengajuan izin belajar </h2>
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
                           <th>NIP</th>
                          <th>Nama</th>
                          <th>Jenjang pendidikan</th>
                          <th>Nama sekolah</th>
						  <th>Tgl pengajuan</th>
						  <th>Status</th>
                          <th>Opsi</th>
                        </tr>
                      </thead>
                     <?php
					  $no=$offset;
						
						if ($result)
						{
							//$jml=count($result);
							foreach ($result as $row){
								if ($row->status==0)
										$tipe = "warning";
									else if ($row->status==1)
										$tipe = "info";
									else if ($row->status==2)
										$tipe = "success";
									else 
										$tipe = "danger";
									
									if ($row->status!=3){ // 3 = ditolak
										$opsi = "<a href=".base_url(). "pengajuan_izin_belajar/view/$row->id class='btn btn-primary btn-xs'><i class='fa fa-book'></i> View </a>";
										if ($row->status==0) {
											$opsi .= "<a href=".base_url(). "pengajuan_izin_belajar/edit/$row->id class='btn btn-info btn-xs'><i class='fa fa-pencil'></i> Edit </a>";
										}
									}
									else{
										$opsi = "<button class='btn btn-danger btn-xs' onclick='hapus($row->id,\"$row->berkas\")'>Hapus</button>";
									}
									
									
								echo"
									<tr>
									  <th scope=row>".($no+1)."</th>
									  <td>$row->nip_baru</td>
									  <td>$row->nama_lengkap</td>
									  <td>$row->nama_jenjangpendidikan</td>
									  <td>$row->nama_tempatpendidikan</td>
									  <td>".date("d M Y",strtotime($row->tgl_pengajuan))."</td>
									  <td>
									  <label class=\"label label-$tipe\">".$arrStatusPengajuan[$row->status]."</label>
									   
									  <td>$opsi</td>
									</tr>
								";
								$no++;
							}
						}
						else{
							echo "<tr><td colspan=8 align=center>- Tidak ada data -</td></tr>";
						}
						?>
						</table>
                      
					<div class='row'>
						<div class='col-md-12 pager'>
						<?php
			
						
							$CI =& get_instance();
							$CI->load->library('pagination');

							$config['base_url'] = base_url(). 'pengajuan_izin_belajar/index/';
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
<script type="text/javascript">
var responsiveHelper;
var breakpointDefinition = {
    tablet: 1024,
    phone : 480
};
var tableContainer;

  jQuery(document).ready(function($)
  {
    tableContainer = $("#data");
    
    tableContainer.dataTable({
      "sPaginationType": "bootstrap",
      "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
      "bStateSave": true,
      

        // Responsive Settings
        bAutoWidth     : false,
        fnPreDrawCallback: function () {
            // Initialize the responsive datatables helper once.
            if (!responsiveHelper) {
                responsiveHelper = new ResponsiveDatatablesHelper(tableContainer, breakpointDefinition);
            }
        },
        fnRowCallback  : function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
            responsiveHelper.createExpandIcon(nRow);
        },
        fnDrawCallback : function (oSettings) {
            responsiveHelper.respond();
        }
    });
    
    $(".dataTables_wrapper select").select2({
      minimumResultsForSearch: -1
    });
  });
  function hapus(id,berkas)
  {
    if (confirm("Apakah anda yakin akan menghapus data?")){
		window.location.href = "<?= base_url();?>pengajuan_izin_belajar/delete/"+id+"/"+berkas;
	}
  }
</script>