<div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Kategori</h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

                        <ol class="breadcrumb">
							<li>
								<a href="<?php echo base_url();?>admin"><i class="entypo-home"></i>Absen</a>
							</li>

							<li class="active">
								<strong>Pengaturan shift</strong>
							</li>
                        </ol>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- .row -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="white-box">

<?php if (!empty($message)) echo "
				<div class='alert alert-$message_type'>$message</div>";?>
 <div class="row">
                    <div class="col-sm-12">
                        <div class="white-box">

                            <h3 class="box-title"><a href="<?php echo base_url();?>absensi/shift/add" class="btn btn-primary waves-effect waves-light" type="button">Tambah shift</a></h3>
                            <p class="text-muted m-b-20"></p>
                            <div class="table-responsive">

<table class="table table-striped datatable" id="data">
	<thead>
		<tr>
			<th>#</th>
			<th>Nama Shift</th>
			<th>Jam Masuk</th>
			<th>Jam Pulang</th>
			<th width=70px>Aksi</th>
		</tr>
	</thead>
	<tbody>
		<?php
			$num = 1;
			foreach ($query as $row) {
				echo"
					<tr>
						<td>$num</td>
						<td>$row->nama_shift</td>
						<td>$row->jam_masuk</td>
						<td>$row->jam_pulang</td>
						<td>
							<a href='".base_url()."absensi/shift/edit/$row->id_shift' class='btn-xs' title='Edit' data-toggle=\"tooltip\" data-original-title=\"Edit\">

										<i class=\"fa fa-pencil text-inverse m-r-10\"></i>
									</a>
									<a class='btn-xs' title='Delete'  onclick='delete_(\"$row->id_shift\")' data-toggle=\"tooltip\" data-original-title=\"Close\">
										<i class=\"fa fa-close text-danger\"></i>
									</a>

						</td>
					</tr>
				";

				$num++;
			}
		?>
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
            title: "Hapus skema shift?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Hapus",
            closeOnConfirm: false
        }, function(){
        	window.location = "<?php echo base_url();?>absensi/shift/delete/"+id;
            swal("Berhasil!", "Shift telah dihapus.", "success");
        });
	}
</script>
