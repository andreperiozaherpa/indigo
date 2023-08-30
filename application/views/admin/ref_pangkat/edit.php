<div class="col-md-4 col-xs-12">
                <div class="white-box">
                  <div class="x_title">
                    <h2>Detail pangkat</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                     
                      
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                   <?php foreach ($item as $key) {
                     $id = $key->id_pangkat;
                     $nama = $key->nama_pangkat;
                     $status = $key->status;
                   }?>

                   <div class="white-box fixed_height_390">
                          <div class="x_content">

                            <div class="flex" style="text-align:center;">
                              
                               <img src="<?php echo base_url()."data/icon/skpd.png";?>" width="140px" align="midle">
                                
                            </div>

                            <h3 class="name" style="text-align:center;"><?php echo $nama;?></h3>

                            <div class="flex">
                              <ul class="list-inline count2">
                               
                              </ul>
                            </div>
                            <p>
                              </p>
                          </div>
                        </div>
               


               
                  </div>
                </div>
              </div>





              <div class="col-md-8 col-sm-8 col-xs-12">
                <div class="white-box">
                  <div class="x_title">
                    <h2>Edit Pangkat</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                  <form method="post" action="<?php echo base_url()."ref_pangkat/update/".$id;?>">
                    <table class="table table-striped">
                      
                      <tbody>

                        <tr>
                          <td>Nama Eselon</td> <td> : <td><td>  <input type="text" name="nama" class="form-control" placeholder="Jenjang Pendidikan" value="<?php echo $nama;?>" required></td></tr>
                         <td>Status </td> <td> : <td><td><div id="gender" class="btn-group" data-toggle="buttons">
                            <label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                              <input type="radio" name="status" value="Y" checked> &nbsp; Aktif &nbsp;
                            </label>
                            <label class="btn btn-primary" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                              <input type="radio" name="status" value="N"> Non Aktif
                            </label>
                          </div></td></tr>
                        
                      </tbody>
                    </table>
                       <button type="submit" class="btn btn-info "><i class="fa fa-pencil"></i> Update </button>
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