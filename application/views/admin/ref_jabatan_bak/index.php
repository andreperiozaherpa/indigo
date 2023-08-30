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
                <div class="x_panel white-box">
                  <div class="x_content">
                    <br />
                    <form class="form-horizontal form-label-left" method="post" action="<?php echo base_url();?>ref_jabatan/add">

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Nama Jabatan</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="text" class="form-control" name="nama" placeholder="nama jabatan" required>
                        </div>
                      </div>
                      
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Unit Kerja</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
							<select class="form-control select2" name="id_unit" >
								<?php
									foreach ($arr_unit_kerja as $row) {
										echo "<option value='".$row->id_unit_kerja	."'>".$row->nama_unit_kerja	."</option>";
									}
									
								?>
							</select>
                        </div>
                     </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Level Jabatan</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
							<select class="form-control" name="level_jabatan">
								<?php
									for($i=1; $i <= count($arr_level_jabatan); $i++)
									{
										echo "<option value='$i'>$arr_level_jabatan[$i]</option>";
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
               
                          <button type="submit" class="btn btn-primary">Tambah Baru</button>
                        </div>
                      </div>

                    </form>
                  </div>
                </div>
              </div>





              <div class="col-md-8 col-sm-8 col-xs-12">
                <div class="x_panel white-box">
                  <div class="x_content">

                    <table class="table table-striped" id="myTable">
                      <thead>
                        <tr>
						  <th>No</th>
                          <th>Unit Kerja</th>
                          <th>Nama Jabatan</th>
						  <th>Level</th>
                          <th>Status</th>
                          <th>Opsi</th>
                        </tr>
                      </thead>
					  <?php
					  $no=0;
					  foreach($result as $r){
						
								if (!empty($result[$no])){
								$margin = ($result[$no]['level_jabatan'] * 20 ) - 20;
								if ($result[$no]['status']=="Y") {
								   $status = "Aktif";
								  }else {
								   $status = "Non Aktif";
								  }
								?>
								<tr>
								  <td><?=($no+1);?></td>
								  <td><?= $result[$no]['nama_unit_kerja'];?></td>
								  <td><i class='fa fa-angle-right' style='margin-left:<?= $margin;?>px'></i>
								  <?= $result[$no]['nama_jabatan'];?>
								  </td>
								  <td><?=$arr_level_jabatan[$result[$no]['level_jabatan']];?></td>
								  <td><?= $status;?></td>
								  <td>
								  <a href="<?php echo base_url(). "ref_jabatan/edit/".$result[$no]['id_jabatan'];?>" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>
								   <a title='Delete' onclick='delete_(<?php echo $result[$no]['id_jabatan'];?>)' class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Delete </a>
							
								   </td>
								</tr>
								<?php
							}
							$no++;
						}
						?>
                      
                    </table>

					
					  

                  </div>
                </div>
              </div>
			 </div> 
			    <!-- Small modal -
                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-sm">Small modal</button>
-->
                  <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-sm">
                      <div class="modal-content">

                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel2">Peringatan</h4>
                        </div>
                        <div class="modal-body">
                          <p>Apakah anda yakin data tersebut akan dihapus ?</p>
                           </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
						  <a href='' id='confirm_btn' type="button" class="btn btn-primary" >Ya</a>
                         
                        </div>

                      </div>
                    </div>
                  </div>
                  <!-- /modals -->

				  
<script type="text/javascript">
window.onload = function() {
	<?php if ($this->session->flashdata("msg")) :?>
		toast_notification(	'<?php echo $this->session->flashdata("t_msg");?>',
	  						'<?php echo $this->session->flashdata("h_msg");?>',
	  						'<?php echo $this->session->flashdata("msg");?>');
	<?php endif;?>
};

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
	function delete_(id)
	{/*
		$('#confirm_title').html('Confirmation');
		$('#confirm_content').html('Are you sure want to delete it?');
		$('#confirm_btn').html('Hapus');
		$('#confirm_btn').attr('href',"<?php echo base_url();?>ref_jabatan/delete/"+id);
		alert(id);
		*/
		if (confirm('Apakah anda yakin akan menghapus data?')){
			window.location.href= "<?= base_url();?>ref_jabatan/delete/"+id;
		}
	}

	function toast_notification(type,head,msg) {
		$.toast({
            heading: head,
            text: msg,
            position: 'top-right',
            loaderBg:'#ff6849',
            icon: type,
            hideAfter: 3500
      	});
	}
</script>