
<?php 
$jumlah = count($pekerjaan);
$total = 0;
foreach($pekerjaan as $p){
	$presentase = $this->kegiatan_model->get_capaian($p->id_kegiatan,$id_pegawai);
	$total += $presentase;
}
if($total==0){
	$p_total = 0;
}else{
	$p_total = $total/$jumlah; 
}

if($p_total==100){
	$color = 'info';
}elseif($p_total>=80&&$p_total<100){
	$color = 'success';
}elseif($p_total>=40&&$p_total<80){
	$color = 'warning';
}else{
	$color = 'danger';
}
?>
<div class="container-fluid">
	<div class="row bg-title">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title">Detail Pegawai</h4>
		</div>
		<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
			>
			<ol class="breadcrumb">
				<li><a href="#">Dashboard</a></li>
				<li class="active">Contact Detail</li>
			</ol>
		</div>
		<!-- /.col-lg-12 -->
	</div>
	<!-- row -->
	<div class="row">
		<div class="col-md-4 col-xs-12">
			<div class="white-box">
				<div class="user-bg"> <img width="120%" alt="user" src="<?php echo base_url()."data/icon/bg_office.jpg" ;?>">
					<div class="overlay-box">
						<div class="user-content">
							<a href="javascript:void(0)">
								<div data-label="<?=round_c($p_total)?>%" class="css-bar css-bar-<?=round_c($p_total)?> css-bar-lg css-bar-<?=$color?>"><img src="<?=base_url()?>/data/user_picture/useravatar.png"  class="thumb-lg img-circle" alt="img"></div>
							</a>
							<h4 class="text-white"><?=$detail->nama_lengkap?></h4>
							<h5 class="text-white"><?=$detail->nip?></h5>

						</div>
					</div>
				</div>


				<div class="user-btm-box">
					<!-- .row -->
					<div class="row text-center m-t-10">
						<div class="col-md-6 b-r"><strong>Jabatan</strong>
							<p><?=$detail->nama_jabatan?> </p>
						</div>
						<div class="col-md-6"><strong>Unit Kerja</strong>
							<p><?=$detail->nama_unit_kerja?></p>
						</div>
					</div>
					<!-- /.row -->
					





				</div>
			</div>
		</div>

		<div class="col-md-8 col-xs-12">
			<div class="row">
				<div class="col-md-12">
					<div class="white-box">
						<div class="row">
							<form method="POST">
								<div class="col-md-9">
									<div class="form-group">
										<label for="exampleInputEmail1">Tahun</label>
										<select name="tahun_rkt" class="form-control">
											<?php 
											foreach($tahun as $r){
												$selected = (!empty($tahun_rkt) && $tahun_rkt==$r->tahun_rkt) ? "selected" : "";
												echo'<option '.$selected.' value="'.$r->tahun_rkt.'">'.$r->tahun_rkt.'</option>';
											}
											?>
										</select>				
									</div>
								</div>

								<div class="col-md-3">
									<div class="form-group">

										<br>
										<button type="submit" class="btn btn-primary m-t-5">Filter</button>

									</div>
								</div>

							</form>
						</div>

					</div>
				</div>

			</div>

			<div class="white-box">
				<!-- .tabs -->
				<ul class="nav nav-tabs tabs customtab">
					<li class="active tab">
						<a href="#home" data-toggle="tab"> <span class="visible-xs"><i class="fa fa-home"></i></span> <span class="hidden-xs">Capaian Kinerja</span> </a>
					</li>
					<li class="tab">
						<a href="#profile" data-toggle="tab"> <span class="visible-xs"><i class="fa fa-user"></i></span> <span class="hidden-xs">Biodata Pegawai</span> </a>
					</li>

				</ul>
				<!-- /.tabs -->
				<div class="tab-content">

					<!-- .tabs 1 -->
					<div class="tab-pane active" id="home">
						
						<hr>
						<?php foreach($pekerjaan as $p){
							$presentase = $this->kegiatan_model->get_capaian($p->id_kegiatan,$id_pegawai);
							if($presentase==100){
								$color = 'info';
							}elseif($presentase>=80&&$presentase<100){
								$color = 'success';
							}elseif($presentase>=40&&$presentase<80){
								$color = 'warning';
							}else{
								$color = 'danger';
							}
							?>
							<a href="#" data-toggle="modal" data-target="#responsive-modal" >
								<h5><?=$p->nama_kegiatan?> <span class="pull-right"><?=$presentase?>%</span></h5>
								<div class="progress">
									<div class="progress-bar progress-bar-<?=$color?>" role="progressbar" aria-valuenow="<?=$presentase?>" aria-valuemin="0" aria-valuemax="100" style="width:<?=$presentase?>%;"> <span class="sr-only"><?=$presentase?>% Complete</span> </div>
								</div>
							</a>

							<hr>
						<?php } ?>

					</div>
					<!-- /.tabs1 -->
					<!-- .tabs2 -->
					<div class="tab-pane" id="profile">
						<div class="row">

							<div class="row">
								<div class="col-md-3 col-xs-6 b-r"> <strong>Nama Lengkap</strong>
									<br>
									<p class="text-muted"><?=$detail->nama_lengkap?></p>
								</div>
								<div class="col-md-3 col-xs-6 b-r"> <strong>NIP</strong>
									<br>
									<p class="text-muted"><?=$detail->nip?></p>
								</div>
								<div class="col-md-3 col-xs-6 b-r"> <strong>Jabatan</strong>
									<br>
									<p class="text-muted"><?=$detail->nama_jabatan?></p>
								</div>
								<div class="col-md-3 col-xs-6"> <strong>Unit Kerja</strong>
									<br>
									<p class="text-muted"><?=$detail->nama_unit_kerja?></p>
								</div>
							</div>
							<h4 class="font-bold m-t-30">Tugas Pokok dan Fungsi</h4>
							<hr>
							<p><?=$detail->tugas_pokok_fungsi?></p>





						</div>
					</div>
					<!-- /.tabs2 -->
					<!-- .tabs3 -->
					<div class="tab-pane" id="settings">
						<form class="form-horizontal form-material">
							<div class="form-group">
								<label class="col-md-12">Full Name</label>
								<div class="col-md-12">
									<input type="text" placeholder="Johnathan Doe" class="form-control form-control-line">
								</div>
							</div>
							<div class="form-group">
								<label for="example-email" class="col-md-12">Email</label>
								<div class="col-md-12">
									<input type="email" placeholder="johnathan@admin.com" class="form-control form-control-line" name="example-email" id="example-email">
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-12">Password</label>
								<div class="col-md-12">
									<input type="password" value="password" class="form-control form-control-line">
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-12">Phone No</label>
								<div class="col-md-12">
									<input type="text" placeholder="123 456 7890" class="form-control form-control-line">
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-12">Message</label>
								<div class="col-md-12">
									<textarea rows="5" class="form-control form-control-line"></textarea>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-12">Select Country</label>
								<div class="col-sm-12">
									<select class="form-control form-control-line">
										<option>London</option>
										<option>India</option>
										<option>Usa</option>
										<option>Canada</option>
										<option>Thailand</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-12">
									<button class="btn btn-success">Update Profile</button>
								</div>
							</div>
						</form>
					</div>
					<!-- /.tabs3 -->
				</div>
			</div>
		</div>
	</div>
	<!-- /.row -->

	<div id="responsive-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header primary">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h4 class="modal-title">Detail Pekerjaan</h4>
				</div>
				<div class="modal-body">

					<table>
						<tr><td><strong>Sosialisasi perizinan</strong> </td></tr>
					</table>
					<hr>
					<div class="row text-center m-t-10">
						<div class="col-md-6 b-r"><strong>Kode IKU</strong>
							<p>IKU011 </p>
						</div>
						<div class="col-md-6"><strong>Prioritas</strong>
							<p>Tinggi</p>
						</div>
					</div>

					<hr>
					<div class="row text-center m-t-10">
						<div class="col-md-6 b-r"><strong>Tanggal Mulai</strong>
							<p>20 November 2018 </p>
						</div>

						<div class="col-md-6"><strong>Tanggal Selesai</strong>
							<p>30 November 2018</p>
						</div>
					</div>

					<hr>
					<div class="row text-center m-t-10">
						<div class="col-md-12"><strong>Deskripsi Pekerjaan</strong>
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
						</div>
					</div>
					<hr>
					<div class="row text-center m-t-10">
						<div class="col-md-12"><strong>Uraian Tugas</strong>
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
						</div>
					</div>

					<hr>
					<div class="row text-center m-t-10">
						<div class="col-md-6 b-r"><strong>Status Pekerjaan</strong>
							<p>Di Setujui </p>
						</div>
						<div class="col-md-6"><strong>Tgl. Diperiksa</strong>
							<p>27 November 2018</p>
						</div>
					</div>



					<!-- /.row -->


				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>

				</div>
			</div>
		</div>
	</div>


	<!-- .right-sidebar -->
	