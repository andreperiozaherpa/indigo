 <?php foreach ($item as $key) {
                     $id = $key->id_jabatan;
                     $nama = $key->nama_jabatan;
                     $status = $key->status;
					 $jenis_jabatan = $key->jenis_jabatan;
					 $level_jabatan = $key->level_jabatan;
                   }?>


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

              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel white-box">
                  <div class="x_content">
                    <form method="post" action="<?php echo base_url()."ref_jabatan/update/".$id;?>">
                    <table class="table table-striped">
                      
                      <tbody>
                        <tr>
                          <td>Nama Jabatan</td>
						  <td>  <input type="text" class="form-control" name="nama" placeholder="nama jabatan" value="<?php echo $nama;?>" required></td>
						</tr>
						<tr>
							<td>Level Jabatan</td>
							<td>
							<select class="form-control" name="level_jabatan">
								<?php
									for($i=1; $i <= count($arr_level_jabatan); $i++)
									{
										$selected = $i==$level_jabatan? "selected" : "";
										echo "<option value='$i' $selected>$arr_level_jabatan[$i]</option>";
									}
									
								?>
							</select>
							</td>
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
						<a href='<?= base_url();?>ref_jabatan' class='btn btn-default'>Kembali</a>
                       <button type="submit" class="btn btn-primary ">Ubah </button>
                    </form> 
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