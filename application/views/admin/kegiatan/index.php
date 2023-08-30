<div class="container-fluid">

  <div class="row bg-title">
    <!-- .page title -->
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
      <h4 class="page-title">Target Kegiatan</h4>
    </div>
    <!-- /.page title -->
    <!-- .breadcrumb -->
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

      <ol class="breadcrumb">
        <li><a href="<?= base_url();?>/admin">Dashboard</a></li>
        <li class="active">Target Kegiatan</li>
      </ol>
    </div>
    <!-- /.breadcrumb -->
  </div>
                <!-- .row -->
                <div class="row">
                <div class="col-sm-3">
                <div class="white-box">
                	<h3 class="box-title"><a href="<?php echo base_url();?>kegiatan/add" class="btn btn-primary btn-sm waves-effect waves-light" type="button"><span class="btn-label"><i class="fa fa-plus"></i></span>Tambah Kegiatan Baru</a></h3>
                	<hr>
                	<form method="POST">
                <div class="form-group">
                	<label class="control-label">Nama Kegiatan</label>
                	<input type="text" name="nama_kegiatan" id="firstName" class="form-control" placeholder="">
                </div>

               	 <div class="form-group">
                	<label class="control-label">Prioritas</label>
                	<select name="prioritas" class="form-control">
                		<option value="">Semua</option>
                        <option value="tinggi">Tinggi</option>
                        <option value="menengah">Menengah</option>
                        <option value="rendah">Rendah</option>
                    </select>
               	 </div>

                

               	   <a class="btn btn-default" href="<?=base_url($this->uri->segment(1))?>"> Reset</a>
               	   <button class="btn btn-primary" type="submit"> Filter</button>
               	   <br>
               	</form>
                </div>
                </div>


                    <div class="col-sm-9">
                        <div class="white-box">
<?php if (!empty($message)) echo "
				<div class='alert alert-$message_type'>$message</div>";?>
 <div class="row">
                    <div class="col-sm-12">
                        <div class="white-box">
                        	
                            
                            <p class="text-muted m-b-20"></p>
                            <div class="table-responsive">

<table class="table table-striped datatable" id="data">
	<thead>
		<tr>
			<th>#</th>
			<th>Nama Kegiatan</th>
			<th>Ketua</th>
			<th>Tanggal Kegiatan </th>
			<th>Prioritas</th>
			<th>Status</th>
			<th width=100px>Aksi</th>
		</tr>
	</thead>
	<tbody>
		<?php $no=1; 
        if(!empty($query)){
        foreach($query as $q){?>
		<tr>
			<td><?=$no?></td>
			<td><?=$q->nama_kegiatan?></td>
			<td><?=$q->nama_lengkap?></td>
			<td><?=tanggal($q->tgl_mulai_kegiatan).' s.d. '.tanggal($q->tgl_mulai_kegiatan)?></td>
			<td><?= ucwords($q->prioritas) ?></td>
			<td><?= ucwords($q->status_kegiatan) ?></td>
<td>
                            <a href="#" onclick="return alert('under construction')"  class="btn btn-primary btn-xs"><i class="fa fa-folder"></i> View </a>
                            <a href="<?=site_url('kegiatan/edit/'.$q->id_kegiatan.'')?>" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>
                            <a  title='Delete' onclick='delete_(<?=$q->id_kegiatan?>)' class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Delete </a>
                        </td>
		</tr>
		<?php $no++; }
    }else{
        ?>
        <tr>
            <td colspan="7"><center>Belum ada kegiatan</center></td>
        </tr>
        <?php
    } ?>		
	</tbody>
</table>
</div>
</div>
</div>
</div>
</div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->

<script type="text/javascript">
	function delete_(id)
	{
		swal({   
            title: "Are you sure?",   
            text: "You will not be able to recover this imaginary file!",   
            type: "warning",   
            showCancelButton: true,   
            confirmButtonColor: "#DD6B55",   
            confirmButtonText: "Yes, delete it!",
            closeOnConfirm: false 
        }, function(){   
        	window.location = "<?php echo base_url();?>kegiatan/delete/"+id;
            swal("Deleted!", "Your imaginary file has been deleted.", "success"); 
        });
	}
</script>

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
	
</script>
<link rel="stylesheet" href="<?php echo base_url()."asset/neon/neon-admin/" ;?>assets/js/datatables/responsive/css/datatables.responsive.css">
<script src="<?php echo base_url()."asset/neon/neon-admin/" ;?>assets/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url()."asset/neon/neon-admin/" ;?>assets/js/datatables/TableTools.min.js"></script>
<script src="<?php echo base_url()."asset/neon/neon-admin/" ;?>assets/js/dataTables.bootstrap.js"></script>
<script src="<?php echo base_url()."asset/neon/neon-admin/" ;?>assets/js/datatables/jquery.dataTables.columnFilter.js"></script>
<script src="<?php echo base_url()."asset/neon/neon-admin/" ;?>assets/js/datatables/lodash.min.js"></script>
<script src="<?php echo base_url()."asset/neon/neon-admin/" ;?>assets/js/datatables/responsive/js/datatables.responsive.js"></script>
