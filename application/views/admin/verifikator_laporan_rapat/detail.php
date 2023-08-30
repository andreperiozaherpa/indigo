
<div class="container-fluid">

	<div class="row bg-title">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title">Laporan rapat</h4> </div>
			<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
				<ol class="breadcrumb">
					<li class="active">Laporan rapat</li>				</ol>
				</div>
				<!-- /.col-lg-12 -->
			</div>

			<div class="row">
            <div class="col-sm-12">
							<!-- <div class="col-sm-12">
								<div class="white-box" style="border-top: 5px solid #6003c8">
									<p>NAMA LAPORAN : <?=$laporan_rapat->nama_laporan?></p>
									<p>ISI LAPORAN : <?=$laporan_rapat->isi_laporan?></p>
									<p>TANGGAL LAPORAN : <?=tanggal($laporan_rapat->tanggal_laporan)?></p>
									<p>LOKASI RAPAT : <?=$laporan_rapat->lokasi_rapat?></p>
									<p>LAMPIRAN LAPORAN : <a href="<?php echo base_url("/data/laporan_rapat/$laporan_rapat->id_pegawai/$laporan_rapat->file_laporan")?>">Lampiran</a></p>
									<p>STATUS LAPORAN : <?=$laporan_rapat->status?></p>
									<p>PENGIRIM : <?=$laporan_rapat->nama_lengkap?></p>
									<hr>
									<div class="row">
											<?php if ($laporan_rapat->status == "BELUM DIVERIFIKASI"): ?>
													<form method="post">
													<button type="submit" name="verifikator_laporan" class="btn btn-primary">Verifikasi Laporan</button>
													</form>
											<?php else: ?>
													<form  method="post">
														<button class="btn btn-primary" disabled>Laporan Sudah di Verifikasi</button>
														<button type="submit" name="batal_verifikasi" class="btn btn-danger">Batal Verifikasi</button>
													</form>
											<?php endif; ?>
									</div>
								</div>
							</div> -->
	<div class="col-md-8">
      <div class="white-box">
        <div class="row">
          <div class="col-md-2 b-r">
            <h1><strong class="text-dark"><?=tgl_hungkul($laporan_rapat->tanggal_laporan);?></strong></h1>
            <h1 style="margin-top:-30px;"><small class="muted"><?=bln_hungkul($laporan_rapat->tanggal_laporan);?> <sup style="font-size:10px;font-weight: bold;"><?=thn_hungkul($laporan_rapat->tanggal_laporan);?></sup> </small> </h1>
          </div>
          <div class="col-md-7">
            <h3><small><strong><?=$laporan_rapat->nama_laporan?></strong> </small></h3>
          </div>
          <?php
          $warna = 'primary';
          if ($laporan_rapat->status == 'BELUM DIVERIFIKASI') {
            $warna = 'warning';
          }elseif ($laporan_rapat->status == 'SUDAH DIVERIFIKASI') {
            $warna = 'success';
          } ?>
          <div class="col-md-3">
            <span class="label label-<?=$warna?>"><?=$laporan_rapat->status?> <?=isset($kegiatan->catatan_verifikator) ? '<i class="icon-refresh" data-toggle="tooltip" title="Hooray!"></i>' : NULL ;?></span>
          </div>
        </div>
      </div>
      <div class="white-box">
        <div class="row">
          <h3><strong>Isi Laporan</strong> </h3>
          <?=$laporan_rapat->isi_laporan?>
        </div>
    </div>
      <div class="white-box">
        <div class="row">
          <h3><strong>Lokasi Rapat</strong> </h3>
          <?=$laporan_rapat->lokasi_rapat?>
        </div>
    </div>
      <div class="white-box">
        <div class="row">
          <h3><strong>Pengirim</strong> </h3>
          <?=$laporan_rapat->nama_lengkap?>
        </div>
    </div>
    <div class="row">
     <a href="<?=base_url("/data/laporan_rapat/$laporan_rapat->id_pegawai/$laporan_rapat->file_laporan")?>" download><span class="label label-warning label-rounded"><i class="fa fa-file"> </i> Download Lampiran</span></a>
    </div>
	<br>
	<div class="row">
		  <div class="white-box">
		  			<?php if ($laporan_rapat->status == "BELUM DIVERIFIKASI"): ?>
				<form method="post">
				<button type="submit" name="verifikator_laporan" class="btn btn-primary">Verifikasi Laporan</button>
				</form>
		<?php else: ?>
				<form  method="post">
					<button class="btn btn-primary" disabled>Laporan Sudah di Verifikasi</button>
					<button type="submit" name="batal_verifikasi" class="btn btn-danger">Batal Verifikasi</button>
				</form>
		<?php endif; ?>
		  </div>
	</div>

   			 </div>
            </div>
        </div>
