<div class="col-md-4 col-xs-12">
                <div class="white-box">
                  <div class="x_title">
                    <h2>Detail SKPD</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                     
                      
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                   

                   <div class="white-box fixed_height_390">
                          <div class="x_content">

                            <div class="flex" style="text-align:center;">
                              
                               <img src="<?php echo base_url()."data/icon/skpd.png";?>" width="140px" align="midle">
                                
                            </div>

                            <h3 class="name" style="text-align:center;">BKPP Sumedang</h3>

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
                    <h2>Detail SKPD</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <table class="table table-striped">
                      
                      <tbody>
                        <tr>
                         <td>Kode SKPD</td> <td> : <td><td> 01 </td></tr>
                          <td>Nama SKPD </td> <td> : <td><td> BKPP Sumedang </td></tr>
                          <td>Telepon </td> <td> : <td><td> (0261) 202056</td></tr>
                          <td>Email </td> <td> : <td><td> bkkpsmd@gmail.com</td></tr>
                          <td>Alamat </td> <td> : <td><td>Jln. Empang No.1 Kab. Sumedang</td></tr>
                          <td>Status </td> <td> : <td><td>Aktif</td></tr>
                       
                      </tbody>
                    </table>
                       <a href="<?php echo base_url(). "ref_skpdlevel_1/edit" ;?>" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>
                            <a  title='Delete' onclick='jQuery(\"#confirm\").modal(\"show\");delete_(\"$row->category_id\")' class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Delete </a>

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