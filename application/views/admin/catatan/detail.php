
<div class="container-fluid">

	<div class="row bg-title">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title">Catatan</h4> </div>
			<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
				<ol class="breadcrumb">
					<li class="active">Catatan</li>				</ol>
				</div>
				<!-- /.col-lg-12 -->
			</div>


			<div class="row">
            <div class="col-sm-12">
                <div class="white-box" style="border-top: 5px solid #6003c8">
									<div class="title-box text-center">
										<h5><b><?php echo $catatan->nama_catatan ?> </b> </h5>
									</div>
									<p>
										<?php echo $catatan->isi; ?>
									</p>
									<div class="row">
										<a href="<?= base_url('catatan/ubah/'.$catatan->id_catatan);?>" data-toggle="tooltip" title="Edit" class="btn btn-success btn-circle"> <i class="icon-pencil"></i> </a>
										<a href="<?= base_url('catatan/delete/'.$catatan->id_catatan);?>" data-toggle="tooltip" title="Hapus" class="btn btn-danger btn-circle"><i class="icon-trash"></i> </a>
									</div>
                </div>
            </div>
        </div>
