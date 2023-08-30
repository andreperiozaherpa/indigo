<?php
	$CI =& get_instance();
	$CI->load->model("sasaran_strategis_model");
	$CI->load->model("sasaran_program_model");
	$CI->load->model("sasaran_kegiatan_model");
	$CI->load->model("indikator_model");
	$CI->load->model("pegawai_model");
	$CI->load->model("pencapaian_model");
	$CI->load->model('kegiatan_model');

	$jumlah_ss = 0;

	if($unit->level_unit_kerja==0){
		$type="SS";
		$nama_sasaran = "sasaran_strategis";
		$id_sasaran = "id_sasaran_strategis";
		$jumlah_ss = $CI->sasaran_strategis_model->getTotalByUnit($unit->id_unit_kerja,$tahun_rkt);
		$data_ss = $CI->sasaran_strategis_model->getData(array('id_unit' => $unit->id_unit_kerja),$id_rkt);
	}
	else if($unit->level_unit_kerja==1){
		$type="SP";
		$nama_sasaran = "sasaran_program";
		$id_sasaran = "id_sasaran_program";
		$jumlah_ss = $CI->sasaran_program_model->getTotalByUnit($unit->id_unit_kerja,$tahun_rkt);
		$data_ss = $CI->sasaran_program_model->getData(array('id_unit' => $unit->id_unit_kerja),$id_rkt);
	}
	else{
		$type="SK";
		$nama_sasaran="sasaran_kegiatan";
		$id_sasaran = "id_sasaran_kegiatan";
		$jumlah_ss = $CI->sasaran_kegiatan_model->getTotalByUnit($unit->id_unit_kerja,$tahun_rkt);
		$data_ss = $CI->sasaran_program_model->getData(array('id_unit' => $unit->id_unit_kerja),$id_rkt);
	}
	$jumlah_iku = $CI->indikator_model->getTotal($type,$unit->id_unit_kerja,$tahun_rkt);
	$capaian_unit = $CI->pencapaian_model->getCapaianTahunan($unit->id_unit_kerja,$tahun_rkt);
?>
<div class="container-fluid">
	<div class="row bg-title">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title">Detail Unitkerja</h4>
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
								<div data-label="<?=number_format($capaian_unit);?>%" class="css-bar css-bar-<?= number_format($capaian_unit);?> css-bar-lg css-bar-warning"><img src="<?php echo base_url()."data/icon/office.png" ;?>" class="thumb-lg img-circle" alt="img"></div>
							</a>
							<h4 class="text-white"><?= $unit->nama_unit_kerja;?></h4>

						</div>
					</div>
				</div>


				<div class="user-btm-box">
					<!-- .row -->
					<div class="row text-center m-t-10">
						<div class="col-md-6 b-r"><strong>Jumlah Sasaran</strong>
							<p><?= $jumlah_ss;?></p>
						</div>
						<div class="col-md-6"><strong>Jumlah IKU</strong>
							<p><?= $jumlah_iku;?></p>
						</div>
					</div>
					<!-- /.row -->
					<hr>
					<!-- .row -->
					<div class="row text-center m-t-10">
						<div class="col-md-6 b-r"><strong>Nama Kepala</strong>
							<p><?= $detail_unit['nama_kepala'];?></p>
						</div>
						<div class="col-md-6"><strong>Jumlah Pegawai</strong>
							<p><?= $detail_unit['jumlah_pegawai'];?></p>
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
						<a href="#profile" data-toggle="tab"> <span class="visible-xs"><i class="fa fa-user"></i></span> <span class="hidden-xs">Kinerja Pegawai</span> </a>
					</li>

				</ul>
				<!-- /.tabs -->
				<div class="tab-content">

					<!-- .tabs 1 -->
					<div class="tab-pane active" id="home">
					<?php
					foreach ($data_ss as $ss) {
						echo'<h5 class="font-bold m-t-30">'.$ss->$nama_sasaran.'</h5> <span class="label label-danger m-l-5 pull-right">'.number_format($ss->capaian).'%</span><hr>';

						$paramIKU = array(
							'type'			=> $type,
							'id_sasaran'	=> $ss->$id_sasaran,
							'id_rkt'		=> $id_rkt,
						);
						$data_iku = $CI->indikator_model->getIndikator($paramIKU);
						foreach ($data_iku as $iku) {
							$capaian = $iku->capaian;
							if($capaian>=90){
								$progress = "progress-bar-custom";
							}
							elseif($capaian>=80){
								$progress = "progress-bar-success";
							}
							elseif($capaian>=70){
								$progress = "progress-bar-primary";
							}
							elseif($capaian>=60){
								$progress = "progress-bar-warning";
							}
							else{
								$progress ="progress-bar-danger";
							}
							echo '
							<h5>'.$iku->nama_indikator.' <span class="pull-right">'.number_format($capaian).'%</span></h5>
							<div class="progress">
								<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="'.number_format($capaian).'" aria-valuemin="0" aria-valuemax="100" style="width:'.number_format($capaian).'%;"> <span class="sr-only">'.number_format($capaian).'% Complete</span> </div>
							</div>
							';
						}
					}
					?>
					</div>
					<!-- /.tabs1 -->
					<!-- .tabs2 -->
					<div class="tab-pane" id="profile">
						<div class="row">
						<?php 
						$Pegawai = $CI->pegawai_model->getData(array('id_unit_kerja' => $unit->id_unit_kerja));
						foreach ($Pegawai as $pegawai) {
							$pekerjaan = $CI->kegiatan_model->get_pekerjaan($pegawai->id_pegawai);

						    $jumlah = count($pekerjaan);
						    $total = 0;
						    foreach($pekerjaan as $pe){
						      $presentase = $CI->kegiatan_model->get_capaian($pe->id_kegiatan,$pegawai->id_pegawai);
						      $total += $presentase;
						    }
						    if($total==0){
						      $p_total = 0;
						    }else{
						      $p_total = $total/$jumlah; 
						    }

							$capaian_user = number_format($p_total);
							echo '
							<div class="col-md-6 col-sm-12" style="box-shadow: 5px 5px 10px rgba(0, -0, 0, 0.1);">
								<div class="row">
									<div class="col-md-4 col-sm-4 text-center">
										<div class="chart easy-pie-chart-1" data-percent="'.$capaian_user.'"> <span><img src="'.base_url().'/data/user_picture/'.$pegawai->foto.'" alt="user" class="img-circle"></span> <canvas height="100" width="100"></canvas></div>
									</div>
									<div class="col-md-8 col-sm-8">
										<br>
										<h3 class="box-title m-b-0">'.$pegawai->nama_lengkap.'</h3>
										<small>'.$pegawai->nama_jabatan.'</small>
										<p>
										</p><address>
											
											
											
											<a href="'.base_url().'laporan/detail_pegawai/'.$pegawai->id_pegawai.'/'.$tahun_rkt.'" ><button class="fcbtn btn btn-primary btn-outline btn-1b btn-block">Detail Profil</button></a>
										</address>
										<p></p>
									</div>
								</div>
							</div>

							';
						}
						?>

                        




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
	<!-- .right-sidebar -->
	<div class="right-sidebar">
		<div class="slimscrollright">
			<div class="rpanel-title"> Service Panel <span><i class="ti-close right-side-toggle"></i></span> </div>
			<div class="r-panel-body">
				<ul>
					<li><b>Layout Options</b></li>
					<li>
						<div class="checkbox checkbox-info">
							<input id="checkbox1" type="checkbox" class="fxhdr">
							<label for="checkbox1"> Fix Header </label>
						</div>
					</li>
					<li>
						<div class="checkbox checkbox-warning">
							<input id="checkbox2" type="checkbox" checked="" class="fxsdr">
							<label for="checkbox2"> Fix Sidebar </label>
						</div>
					</li>
					<li>
						<div class="checkbox checkbox-success">
							<input id="checkbox4" type="checkbox" class="open-close">
							<label for="checkbox4"> Toggle Sidebar </label>
						</div>
					</li>
				</ul>
				<ul id="themecolors" class="m-t-20">
					<li><b>With Light sidebar</b></li>
					<li><a href="javascript:void(0)" theme="default" class="default-theme working">1</a></li>
					<li><a href="javascript:void(0)" theme="green" class="green-theme">2</a></li>
					<li><a href="javascript:void(0)" theme="gray" class="yellow-theme">3</a></li>
					<li><a href="javascript:void(0)" theme="blue" class="blue-theme">4</a></li>
					<li><a href="javascript:void(0)" theme="purple" class="purple-theme">5</a></li>
					<li><a href="javascript:void(0)" theme="megna" class="megna-theme">6</a></li>
					<li><b>With Dark sidebar</b></li>
					<br/>
					<li><a href="javascript:void(0)" theme="default-dark" class="default-dark-theme">7</a></li>
					<li><a href="javascript:void(0)" theme="green-dark" class="green-dark-theme">8</a></li>
					<li><a href="javascript:void(0)" theme="gray-dark" class="yellow-dark-theme">9</a></li>
					<li><a href="javascript:void(0)" theme="blue-dark" class="blue-dark-theme">10</a></li>
					<li><a href="javascript:void(0)" theme="purple-dark" class="purple-dark-theme">11</a></li>
					<li><a href="javascript:void(0)" theme="megna-dark" class="megna-dark-theme">12</a></li>
				</ul>
				<ul class="m-t-20 chatonline">
					<li><b>Chat option</b></li>
					<li>
						<a href="javascript:void(0)"><img src="../plugins/images/users/varun.jpg" alt="user-img" class="img-circle"> <span>Varun Dhavan <small class="text-success">online</small></span></a>
					</li>
					<li>
						<a href="javascript:void(0)"><img src="../plugins/images/users/genu.jpg" alt="user-img" class="img-circle"> <span>Genelia Deshmukh <small class="text-warning">Away</small></span></a>
					</li>
					<li>
						<a href="javascript:void(0)"><img src="../plugins/images/users/ritesh.jpg" alt="user-img" class="img-circle"> <span>Ritesh Deshmukh <small class="text-danger">Busy</small></span></a>
					</li>
					<li>
						<a href="javascript:void(0)"><img src="../plugins/images/users/arijit.jpg" alt="user-img" class="img-circle"> <span>Arijit Sinh <small class="text-muted">Offline</small></span></a>
					</li>
					<li>
						<a href="javascript:void(0)"><img src="../plugins/images/users/govinda.jpg" alt="user-img" class="img-circle"> <span>Govinda Star <small class="text-success">online</small></span></a>
					</li>
					<li>
						<a href="javascript:void(0)"><img src="../plugins/images/users/hritik.jpg" alt="user-img" class="img-circle"> <span>John Abraham<small class="text-success">online</small></span></a>
					</li>
					<li>
						<a href="javascript:void(0)"><img src="../plugins/images/users/john.jpg" alt="user-img" class="img-circle"> <span>Hritik Roshan<small class="text-success">online</small></span></a>
					</li>
					<li>
						<a href="javascript:void(0)"><img src="../plugins/images/users/pawandeep.jpg" alt="user-img" class="img-circle"> <span>Pwandeep rajan <small class="text-success">online</small></span></a>
					</li>
				</ul>
			</div>
		</div>
	</div>
	<!-- /.right-sidebar -->
