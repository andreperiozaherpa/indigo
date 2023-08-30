
<div class="container-fluid">

	<div class="row bg-title">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title">Pengumuman</h4> </div>
			<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
				<ol class="breadcrumb">
					<?=breadcrumb($this->uri->segment_array()) ?>
				</ol>
				</div>
				<!-- /.col-lg-12 -->
			</div>


			<div class="row">
            <div class="col-sm-12">
                <div class="white-box" style="border-top: 5px solid #6003c8">
									<p class="text-center">
										<label for=""> <b>Nama</b> </label>
										<br>
										<?php echo $pengumuman->nama; ?>
									</p>
									<p class="text-center">
										<label for=""> <b>Isi</b> </label>
										<br>
										<?php echo $pengumuman->isi; ?>
									</p>
									<p class="text-center">
										<label for=""> <b>Periode Tayang</b> </label>
										<br>
										<?php echo $pengumuman->periode_awal; ?>&nbsp;&nbsp;<i><small>sampai</small></i>&nbsp;&nbsp;<?php echo $pengumuman->periode_akhir; ?>
									</p>
									<div class="row">
										<a href="<?= base_url('pengumuman/ubah/'.$pengumuman->id_pengumuman);?>" data-toggle="tooltip" title="Edit" class="btn btn-success btn-circle"> <i class="icon-pencil"></i> </a>
										<a href="<?= base_url('pengumuman/delete/'.$pengumuman->id_pengumuman);?>" data-toggle="tooltip" title="Hapus" class="btn btn-danger btn-circle"><i class="icon-trash"></i> </a>
									</div>
                </div>
            </div>
        </div>
