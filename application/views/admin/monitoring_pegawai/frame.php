<div class="container-fluid">

	<div class="row bg-title">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title">Monitoring Pegawai</h4>
		</div>
		<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
			<ol class="breadcrumb">
				<li><a href="">Markonah</a></li>
				<li class="active">Monitoring Pegawai</li>
			</ol>
		</div>

	</div>
	<div class="row">
		<div class="col-md-3">
			<div class="white-box">
				<h3 class="box-title">TOTAL AJUAN WFH DARI MARKONAH</h3>
				<ul class="list-inline two-part">
					<li><i class="icon-book-open text-warning"></i></li>
					<li class="text-right">
						<span class="counter"><?=$total_markonah?></span>
						<p style="margin: 0px;line-height:0px">Ajuan</p>
					</li>
				</ul>
			</div>
		</div>
		<div class="col-md-3">
			<div class="white-box">
				<h3 class="box-title">SUDAH INPUT RENCANA KERJA</h3>
				<ul class="list-inline two-part">
					<li><i class="icon-people text-primary"></i></li>
					<li class="text-right"><span class="counter"><?=$total_pegawai_bekerja?></span>
						<p style="margin: 0px;line-height:0px">Pegawai</p></li>
				</ul>
			</div>
		</div>
		<div class="col-md-6">
			<div class="white-box" style="border-top:solid 3px #6003c8">
				<h4 class="box-title">
				Jumlah Pegawai WFH Hari Ini
				</h4>
				<p>
					<i class="icon-calender"></i> <?=tanggal_hari(date('Y-m-d'))?>
				</p>
				<span style="font-weight: 500;font-size:40px" class="text-purple"><?=$total_hari_ini?> </span ><span style="font-size:20px">Pegawai</span>
				<div class="pull-right">
				<i class="icon-people text-purple" style="font-size:50px"></i>
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="white-box">
				<h3 class="box-title">TOTAL ITEM PEKERJAAN</h3>
				<ul class="list-inline two-part">
					<li><i class="icon-briefcase text-info"></i></li>
					<li class="text-right"><span class="counter"><?=$total_pekerjaan?></span>
						<p style="margin: 0px;line-height:0px">Pekerjaan</p></li>
				</ul>
			</div>
		</div>
		<div class="col-md-3">
			<div class="white-box">
				<h3 class="box-title">TOTAL PEKERJAAN SELESAI</h3>
				<ul class="list-inline two-part">
					<li style="position:relative">
						<i class="icon-briefcase text-success"></i>
						<i style="position: absolute;font-size:12px;background-color:#03a079;color:#fff;padding:5px;border-radius:50%;right:40" class="ti-check"></i>
					</li>
					<li class="text-right"><span class="counter"><?=$total_pekerjaan_selesai?></span>
						<p style="margin: 0px;line-height:0px">Pekerjaan</p></li>
				</ul>
			</div>
		</div>
	</div>
	<iframe src="<?= base_url('monitoring_pegawai/?frame=true') ?>" height="700px" width="100%" frameborder="no"></iframe>
</div>