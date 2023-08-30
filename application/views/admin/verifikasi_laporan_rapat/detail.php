
<div class="container-fluid">

	<div class="row bg-title">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title">Laporan rapat</h4> </div>
			<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
				<ol class="breadcrumb">
					<?=breadcrumb($this->uri->segment_array()) ?>
				</ol>
				<!-- /.col-lg-12 -->
			</div>
			<div class="row">
            <div class="col-sm-12">
							<div class="col-sm-12">
								<div class="white-box" style="border-top: 5px solid #6003c8">
									<p>NAMA LAPORANk : <?=$laporan_rapat->nama_laporan?></p>
									<p>ISI LAPORAN : <?=$laporan_rapat->isi_laporan?></p>
									<p>TANGGAL LAPORAN : <?=tanggal($laporan_rapat->tanggal_laporan)?></p>
									<p>LOKASI RAPAT : <?=$laporan_rapat->lokasi_rapat?></p>
									<?php if ($laporan_rapat->file_laporan != "default"): ?>
									<p>LAMPIRAN LAPORAN : <a href="<?php echo base_url("/data/laporan_rapat/$laporan_rapat->id_pegawai/$laporan_rapat->file_laporan")?>">Lampiran</a></p>
									<?php endif; ?>
									<p>STATUS LAPORAN : <?=$laporan_rapat->status?></p>
									<p>PENGIRIM : <?=$laporan_rapat->nama_lengkap?></p>
									<!-- <hr>
									<div class="row">
										<form method="post">
											<button type="submit" name="verifikasi_laporan" class="btn btn-primary">Verifikasi Laporan</button>
										</form>
									</div> -->
								</div>
							</div>
							
            </div>
        </div>
