
<div class="container-fluid">

	<div class="row bg-title">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title">Laporan rapat</h4> </div>
			<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
				<ol class="breadcrumb">
					<?=breadcrumb($this->uri->segment_array()) ?>
				</ol>
				</div>
				<!-- /.col-lg-12 -->
			</div>
				<div class="row">
			    <div class="col-md-12">
			        <div class="white-box">
			          <div class="row">
			            <div class="col-md-2 b-r">
			              <h1><strong class="text-dark"><?=tgl_hungkul($laporan_rapat->tanggal_laporan)?></strong></h1>
			              <h1 style="margin-top:-30px;"><small class="muted"><?=bln_hungkul($laporan_rapat->tanggal_laporan)?></small> </h1>
			            </div>
			            <div class="col-md-7">
			              <h3><small><strong> <?=$laporan_rapat->nama_laporan?></strong> </small></h3>
			            </div>
			            <div class="col-md-3">
			              <span class="label label-<?=$laporan_rapat->code_warna_status?>"><?=$laporan_rapat->status?></span>
			            </div>
			          </div>
			        </div>
			        <div class="white-box">
			          <div class="row">
			            <h3><strong>Isi Laporan</strong> </h3>
			            <p><?=$laporan_rapat->isi_laporan?></p>
								</div>
			      </div>
			        <div class="white-box">
			          <div class="row">
			            <h3><strong>Lokasi Rapat</strong> </h3>
			            <p><?=$laporan_rapat->lokasi_rapat?></p>
								</div>
			      </div>
						<div class="white-box">
							<div class="row">
								<h3><strong>Verifikator</strong> </h3>
								<img class="img-circle" alt="user" src="http://202.93.229.205:80/sakip/asset/pixel/plugins/images/users/varun.jpg" style="-webkit-box-shadow: 0px 0px 10px -2px rgba(0,0,0,0.75);
-moz-box-shadow: 0px 0px 10px -2px rgba(0,0,0,0.75);
box-shadow: 0px 0px 10px -2px rgba(0,0,0,0.75);border:2px solid white;">
							<h5><strong><?=$laporan_rapat->nama_lengkap?></strong> </h5>
							</div>
						</div>
						<?php if ($laporan_rapat->file_laporan != "default"): ?>
							<div class="row">
								<a class="label label-warning label-rounded" href="<?php echo base_url("/data/laporan_rapat/$creator->id_pegawai/$laporan_rapat->file_laporan")?>"> Lampiran</a>
							</div>
						<?php endif; ?>
			      <br>
			      <div class="white-box">
			        <div class="row">
			          <div class="pull-right">
									<a href="<?=base_url('laporan_rapat/ubah/'.$laporan_rapat->id_laporan_rapat)?>" class="btn btn-success btn-circle" style="width:100px;"><i class="ti icon-pencil"></i>Edit </a>
									<a href="<?=base_url('laporan_rapat/delete/'.$laporan_rapat->id_laporan_rapat)?>" class="btn btn-danger btn-circle" style="width:100px;"><i class="ti icon-trash"></i>Hapus </a>
			          </div>
			        </div>
			      </div>
			    </div>

						</div>
					</div>
			    </div>
