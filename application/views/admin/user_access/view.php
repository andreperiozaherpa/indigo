<div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Detail Unit Kerja</h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                   
                        <ol class="breadcrumb">
							<li>
								<a href="<?php echo base_url();?>ref_unit_kerja"><i class="entypo-home"></i>Unit Kerja</a>
							</li>
							<?php for ($i=1; $i < $level_unit_kerja; $i++): ?>
								<li>
									<a href="<?php echo base_url('ref_unit_kerja/view/'.$data_unit_kerja[$i][0]->id_unit_kerja);?>"><i class="entypo-home"></i><?= $data_unit_kerja[$i][0]->nama_unit_kerja;?></a>
								</li>
							<?php endfor; ?>
							<li class="active">		
								<strong><?= $nama_unit_kerja;?></strong>
							</li>
                        </ol>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>

        	<div class="row">	
              <div class="col-md-12 col-sm-8 col-xs-12">
                <div class="white-box">
                	<div class="row">

                    <table class="table table-striped">
                      
                      <tbody>
                        <tr>
                          <td>Nama Unit Kerja </td> <td> : </td><td><?= $nama_unit_kerja;?></td></tr>
                          <td>Telepon </td> <td> : </td><td><?= $telp;?></td></tr>
                          <td>Alamat </td> <td> : </td><td><?= $alamat;?></td></tr>
                          <td>Status </td> <td> : </td><td><?= $status;?></td>
						</tr>
                       
                      </tbody>
                    </table>
                       <?php
						if ($status=="Aktif"){
							$ubah_status = "Non Aktif";
							$title = "Nonaktifkan";
						}
						else{
							$ubah_status = "Aktif";
							$title = "Aktifkan";
						}
						
					   ?>
						<form method='post'>
							<input type='hidden' value='<?= $ubah_status;?>' name='status' />
							<a href="<?php echo base_url(). "ref_unit_kerja?action=Edit&id=".$id_unit_kerja ;?>" class="btn btn-default btn-xs">Ubah</a>
							<button class="btn btn-default btn-xs" type='submit'><?=$title;?></button>
							<a href='<?= base_url();?>ref_unit_kerja' class="btn btn-default btn-xs">Kembali</a>
						</form>
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
	function delete_(id)
	{
		$('#confirm_title').html('Confirmation');
		$('#confirm_content').html('Are you sure want to delete it?');
		$('#confirm_btn').html('Delete');
		$('#confirm_btn').attr('href',"<?php echo base_url();?>manage_category/delete/"+id);
	}
</script>