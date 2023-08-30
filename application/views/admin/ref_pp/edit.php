<?php foreach ($item as $key) {
                     // $id = $key->id_pp;
                     // $nama = $key->nama_pp;
                     // $status = $key->status;
                   }?>
				   



              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel white-box">
                  <div class="x_title">
                    <h2>Edit Peraturan Pemerintah</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                  <form method="post" action="<?php echo base_url()."ref_pp/update/".$key->id_pp;?>">
                    <table class="table table-striped">
                      
                      <tbody>

                        <tr>
                          <td>Peraturan Pemerintah</td><td>  <input type="text" name="nama_pp" class="form-control" placeholder="nama pp" value="<?php echo $key->nama_pp;?>" required></td></tr>
                                                <tr> 
						 <td>Status </td>
						 <td>
							<?php
								$c1 = $key->status=="Y"? "checked" : "";
								$c2 = $key->status=="N"? "checked" : "";
							?>
                              <input type="radio" name="status" value="Y" <?= $c1;?> > &nbsp; Aktif &nbsp;
                            <input type="radio" name="status" value="N" <?= $c2;?> > Non Aktif</td>
                        </tr>
                        
                      </tbody>
                    </table>
                       <button type="submit" class="btn btn-info "><i class="fa fa-pencil"></i> Ubah </button>
					   <a href='<?= base_url();?>ref_pp' class='btn btn-default'>Kembali</a>
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
    $('#confirm_btn').attr('href',"<?php echo base_url();?>ref_pp/delete/"+id);
  }
</script>