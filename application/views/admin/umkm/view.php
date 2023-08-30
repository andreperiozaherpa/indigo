<script>
		$(document).ready(function() {
			// create a tree
			$("#tree-data").jOrgChart({
				chartElement: $("#tree-view"),
				nodeClicked: nodeClicked
			});

			// lighting a node in the selection
			function nodeClicked(node, type) {
				node = node || $(this);
				$('.jOrgChart .selected').removeClass('selected');
				node.addClass('selected');
			}
		});
	</script>
	
	<script>
		function tambah_katalog() {
			
			$("#flag_katalog").val("insert");
			$("#title_katalog").html("Tambah Katalog");
			$("#id_katalog").val("");
			$("#nama_katalog").val("");
			$("#deskripsi_katalog").val("");
			$("#harga_katalog").val("");
		}
		function edit_katalog(id_katalog, nama, deskripsi, harga) {
			//alert("tes");
			$("#flag_katalog").val("update");
			$("#title_katalog").html("Edit Katalog");
			$("#id_katalog").val(id_katalog);
			$("#nama_katalog").val(nama);
			$("#deskripsi_katalog").val(deskripsi);
			$("#harga_katalog").val(harga);
			//alert(harga);
		}

		function delete_katalog_(id, id_umkm) {
			swal({
				title: "Apakah anda yakin akan menghapus Katalog?",
				//text: "Anda tidak dapat mengembalikan data ini lagi jika sudah terhapus!",   
				type: "warning",
				showCancelButton: true,
				confirmButtonColor: "#DD6B55",
				confirmButtonText: "Hapus",
				closeOnConfirm: false
			}, function() {
				window.location = "<?php echo base_url(); ?>profil/umkm/hapus_katalog/" + id + "/" + id_umkm;
				swal("Berhasil!", "Data telah terhapus.", "success");
			});
		}

		function delete_foto(id, id_umkm) {
			swal({
				title: "Apakah anda yakin akan menghapus Foto?",
				//text: "Anda tidak dapat mengembalikan data ini lagi jika sudah terhapus!",   
				type: "warning",
				showCancelButton: true,
				confirmButtonColor: "#DD6B55",
				confirmButtonText: "Hapus",
				closeOnConfirm: false
			}, function() {
				window.location = "<?php echo base_url(); ?>profil/umkm/hapus_foto/" + id + "/" + id_umkm;
				swal("Berhasil!", "Foto telah terhapus.", "success");
			});
		}

		function delete_umkm_(id) {
			swal({
				title: "Apakah anda yakin menghapus UMKM?",
				text: "Data yang berkaiatan dengan UMKM ini akan terhapus secara otomatis!",
				type: "warning",
				showCancelButton: true,
				confirmButtonColor: "#DD6B55",
				confirmButtonText: "Hapus",
				closeOnConfirm: false
			}, function() {
				window.location = "<?php echo base_url(); ?>profil/umkm/hapus_umkm/" + id;
				swal("Berhasil!", "Data telah terhapus.", "success");
			});
		}

		function verifikasi(id) {
			console.log('test');
			swal({
				title: "Apakah anda yakin memverikasi UMKM?",
				type: "warning",
				showCancelButton: true,
				confirmButtonColor: "#DD6B55",
				confirmButtonText: "Verifikasi",
				closeOnConfirm: false
			}, function() {
				window.location = "<?php echo base_url(); ?>profil/umkm/verifikasi_umkm/" + id;

			});
		}

		function rekomendasi(flag) {
			var title = "Rekomendasikan UMKM ini?";
			var button = "Rekomendasikan";
			var id = "<?= $detail->id_umkm; ?>";
			if (flag != "Y") {
				title = "Batalan rekomendasi UMKM?";
				button = "Batalkan";
			}
			swal({
				title: title,
				type: "warning",
				showCancelButton: true,
				confirmButtonColor: "#DD6B55",
				confirmButtonText: button,
				closeOnConfirm: false
			}, function() {
				window.location = "<?php echo base_url(); ?>profil/umkm/rekomendasi/" + id + "/" + flag;

			});
		}



		function edit_umkm() {
			//alert("tes");
			//$("#editlisting").show();
		}

		//edit_umkm();

		// function loadMap() {


		// 	var lat = <?= $detail->latitude; ?>;
		// 	var lng = <?= $detail->longitude; ?>;
		// 	if (lat != "" && lng != "") {
		// 		var location = new google.maps.LatLng(parseFloat(lat), parseFloat(lng));

		// 	}

		// 	var mapProp = {
		// 		center: location,
		// 		zoom: 12,
		// 		//disableDefaultUI: true,
		// 		//mapTypeId:google.maps.MapTypeId.HYBRID
		// 	};
		// 	var map = new google.maps.Map(document.getElementById("googleMap"), mapProp);


		// 	var marker = new google.maps.Marker({
		// 		position: location,
		// 		//map: map,
		// 		//animation: google.maps.Animation.BOUNCE
		// 	});



		// 	var infowindow = new google.maps.InfoWindow({
		// 		content: 'Latitude: ' + location.lat() + '<br>Longitude: ' + location.lng()
		// 	});

		// 	if (lat != "" && lng != "") {
		// 		marker.setMap(map);
		// 		//markers.push(marker);
		// 		infowindow.open(map, marker);
		// 	}
		// 	loadMapEdit();
		// }

		// function loadMapEdit() {
		// 	var default_lat = '-6.864113885641478';
		// 	var default_lng = '107.9237869248534';

		// 	var lat = <?= $detail->latitude; ?>;
		// 	var lng = <?= $detail->longitude; ?>;
		// 	if (lat != "" && lng != "") {
		// 		var location = new google.maps.LatLng(parseFloat(lat), parseFloat(lng));

		// 	} else {
		// 		var location = new google.maps.LatLng(parseFloat(default_lat), parseFloat(default_lng));
		// 	}
		// 	var mapProp = {
		// 		center: location,
		// 		zoom: 12,
		// 		//disableDefaultUI: true,
		// 		//mapTypeId:google.maps.MapTypeId.HYBRID
		// 	};
		// 	var map = new google.maps.Map(document.getElementById("googleMapEdit"), mapProp);

		// 	var marker = new google.maps.Marker({
		// 		position: location,
		// 		//map: map,
		// 		//animation: google.maps.Animation.BOUNCE
		// 	});



		// 	var infowindow = new google.maps.InfoWindow({
		// 		content: 'Latitude: ' + location.lat() + '<br>Longitude: ' + location.lng()
		// 	});

		// 	if (lat != "" && lng != "") {
		// 		marker.setMap(map);
		// 		markers.push(marker);
		// 		infowindow.open(map, marker);
		// 	}


		// 	google.maps.event.addListener(marker, 'click', function() {
		// 		infowindow.open(map, marker);
		// 	});


		// 	google.maps.event.addListener(map, 'click', function(event) {
		// 		placeMarker(map, event.latLng);
		// 	});


		// 	var input = document.getElementById('pac-input');
		// 	//var types = document.getElementById('type-selector');
		// 	//var strictBounds = document.getElementById('strict-bounds-selector');

		// 	//map.controls[google.maps.ControlPosition.TOP_RIGHT].push(card);

		// 	var autocomplete = new google.maps.places.Autocomplete(input);

		// 	// Bind the map's bounds (viewport) property to the autocomplete object,
		// 	// so that the autocomplete requests use the current map bounds for the
		// 	// bounds option in the request.
		// 	autocomplete.bindTo('bounds', map);

		// 	// Set the data fields to return when the user selects a place.
		// 	autocomplete.setFields(
		// 		['address_components', 'geometry', 'icon', 'name']);

		// 	var infowindow = new google.maps.InfoWindow();
		// 	//var infowindowContent = document.getElementById('infowindow-content');
		// 	//infowindow.setContent(infowindowContent);
		// 	var marker = new google.maps.Marker({
		// 		map: map,
		// 		anchorPoint: new google.maps.Point(0, -29)
		// 	});

		// 	autocomplete.addListener('place_changed', function() {
		// 		//infowindow.close();
		// 		marker.setVisible(false);
		// 		var place = autocomplete.getPlace();
		// 		if (!place.geometry) {
		// 			// User entered the name of a Place that was not suggested and
		// 			// pressed the Enter key, or the Place Details request failed.
		// 			window.alert("No details available for input: '" + place.name + "'");
		// 			return;
		// 		}

		// 		// If the place has a geometry, then present it on a map.
		// 		if (place.geometry.viewport) {

		// 			map.fitBounds(place.geometry.viewport);

		// 		} else {

		// 			map.setCenter(place.geometry.location);
		// 			map.setZoom(17); // Why 17? Because it looks good.
		// 		}

		// 		//hapus tanda
		// 		for (var i = 0; i < markers.length; i++) {
		// 			markers[i].setMap(null);
		// 		}

		// 		marker.setPosition(place.geometry.location);
		// 		marker.setVisible(true);

		// 		markers.push(marker);
		// 		var location = place.geometry.location;

		// 		$("#latitude").val(location.lat());
		// 		$("#longitude").val(location.lng());

		// 		var infowindow = new google.maps.InfoWindow({
		// 			content: 'Latitude: ' + location.lat() + '<br>Longitude: ' + location.lng()
		// 		});

		// 		infowindow.open(map, marker);

		// 	});


		// }
		// var markers = [];

		// function placeMarker(map, location) {
		// 	var marker = new google.maps.Marker({
		// 		position: location,
		// 		map: map,
		// 		animation: google.maps.Animation.BOUNCE,
		// 	});
		// 	var infowindow = new google.maps.InfoWindow({
		// 		content: 'Latitude: ' + location.lat() + '<br>Longitude: ' + location.lng()
		// 	});

		// 	//hapus tanda
		// 	for (var i = 0; i < markers.length; i++) {
		// 		markers[i].setMap(null);
		// 	}

		// 	infowindow.open(map, marker);
		// 	markers.push(marker);
		// 	$("#latitude").val(location.lat());
		// 	$("#longitude").val(location.lng());
		// 	$("#pac-input").val("");
		// }
		// $(document).ready(function() {


		// });
	</script>
	<style type="text/css">
		.nav-tabs>li {
			width: 50%;
			text-align: center;
			text-transform: uppercase;
		}

		.customtab li.active a,
		.customtab li.active a:focus,
		.customtab li.active a:hover {
			border-bottom: 2px solid #6003C8;
			color: #6003C8;
		}

		.nav-tabs>li>a {
			border-radius: 0px;
		}

		.auto-complete-map {
			z-index: 2150000000;
		}
	</style>
	<div class="container-fluid">

		<div class="row bg-title">
			<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
				<h4 class="page-title"><?php echo title($title) ?></h4>
			</div>
			<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
				<ol class="breadcrumb">
					<?php echo breadcrumb($this->uri->segment_array()); ?>
				</ol>
			</div>
			<!-- /.col-lg-12 -->
		</div>
		<div class="row">
			<!-- <button onclick="test()">Tet</button> -->
			<div class="col-md-12 col-sm-12 col-xs-12">
				<?php
				if (!empty($message)) {
				?>
					<div class="alert alert-<?= $type; ?> alert-dismissible fade in" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
						</button>
						<?= $message; ?>
					</div>
				<?php } ?>
				<div class="x_panel">
					<div class="x_content">
						<div class="alert alert-danger alert-dismissible fade in" role="alert" id='pesan' style='display:none'>
							<button type="button" onclick='hideMe()' class="close" aria-label="Close"><span aria-hidden="true">×</span>
							</button>
							<label id='status'></label>
						</div>
						<div class="row">
							<div class="col-md-4">
								<?php if ($detail->status == "Terverifikasi") { ?>

									<div class="alert alert-success alert-dismissible fade in">
										<p><span>UMKM ini</span> Telah terverifikasi oleh <?=ucfirst($detail->jenis_verifikator)?></p>
										<a class="close"></a>
									</div>
								<?php } else { ?>
									<div class="alert alert-danger alert-dismissible fade in">
										<p><span>UMKM ini</span> Belum diverifikasi</p>
										<a class="close"></a>
									</div>
								<?php } ?>
								<div class="panel panel-default">
									<div class="panel-heading">Banner</div>
									<div class="panel-body">
										<div class="row">
											<div class="col-md-12 centered">
												<div class="form-group">
													<?php if($detail->banner){ ?>
														<img src="<?= ($detail->banner == '') ? '' : 'https://e-officedesa.sumedangkab.go.id/data/umkm/' . $detail->banner ?>" alt="Belum ada gambar" class="img-responsive" style="width: 100%;">
													<?php }else{
														echo 'Belum ada gambar';
													} ?>
												</div>

											</div>

										</div>

										<!-- <a href="" class="fcbtn btn btn-outline btn-primary btn-block" style="margin-left: 7px;" data-toggle="modal" data-target="#editlisting"><i class="ti-pencil"></i> Edit UMKM</a>
										<a class="fcbtn btn btn-outline btn-primary btn-block" style="margin-left: 7px;" onclick="delete_umkm_(<?= $detail->id_umkm; ?>)"><i class="ti-trash"></i> Hapus UMKM</a> -->
										<?php
										if ($detail->status != "Terverifikasi") { ?>
											<a class="fcbtn btn btn-primary btn-block" style="margin-left: 7px;" href="<?=base_url('umkm/beranda/verifikasi_umkm/'.$detail->id_umkm.'/'.$detail->slug_umkm)?>"><i class="fa fa-check"></i> Verifikasi</a>
										<?php } ?>
											<!-- 
										<?php if ($detail->rekomendasi != "Y") { ?>
											<a class="fcbtn btn btn-success btn-block" style="margin-left: 7px;" href="<?=base_url('umkm/beranda/rekomendasi/'.$detail->id_umkm.'/Y')?>"><i class="fa fa-star"></i> Rekomendasikan</a>
										<?php } else if ($detail->rekomendasi == "Y") { ?>
											<a class="fcbtn btn btn-danger btn-block" style="margin-left: 7px;" href="<?=base_url('umkm/beranda/rekomendasi/'.$detail->id_umkm.'/N')?>">Batalkan Rekomendasikan</a>
										<?php } ?> -->




									</div>



									<div id="editlisting" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel1" aria-hidden="true" style="display: none;">
										<div class="modal-dialog modal-lg"">
											<div class=" modal-content">
												<div class="panel-heading">
													<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
													<h4 class="modal-title" id="myLargeModalLabel1" style="color:white;">Edit listing</h4>
												</div>

												<div class="modal-body">
													<form method='post' enctype="multipart/form-data">
														<!-- <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" /> -->

														<div class="row">
							<div class="col-md-3">
								<div class="panel panel-default">
									<div class="panel-heading">Banner / Logo Usaha <sup class="text-danger" title="Wajib diisi">*</sup></div>
									<div class="panel-body">
										<div class="row">
											<div class="col-md-12">
												<div class="form-group">
													<input type="file" id="input-file-now" name="banner" <?php if($detail->banner): ?> data-default-file="https://e-officedesa.sumedangkab.go.id/data/umkm/<?=$detail->banner?>" <?php endif; ?> class="dropify" />
												</div>
											</div>
											<small>* File yang diupload harus berformat png,jpg,jpeg dan Max 2MB</small>
										</div>
									</div>
								</div>

								<div class="panel panel-default">
									<div class="panel-body">

										<div class="col-md-12">
											<div class="form-group">
												<label for="telepon">Telepon <small class="text-danger"><sup>*</sup> </small> </label>
												<div class="input-group">
													<div class="input-group-addon"><i class="fa fa-phone"></i></div>
													<input type="text" class="form-control" id="telepon" name="telepon" placeholder="0815xxxxxxxx" value="<?= !empty($detail->telepon) ? $detail->telepon : ''; ?>">
												</div>
												<small class="error"><?= form_error("telepon"); ?></small>
											</div>
										</div>


										<div class="col-md-12">
											<div class="form-group">
												<label for="email">Email</label>
												<div class="input-group">
													<div class="input-group-addon"><i class="ti-email"></i></div>
													<input type="email" class="form-control" name="email" placeholder="contoh@email.com" value="<?= !empty($detail->email) ? $detail->email : ''; ?>">

												</div>
												<small class="error"><?= form_error("email"); ?></small>
											</div>
										</div>

										<div class="col-md-12">
											<div class="form-group">
												<label for="">Website</label>
												<div class="input-group">
													<div class="input-group-addon"><i class="fa fa-globe"></i></div>
													<input type="text" class="form-control" name="website" placeholder="wwww.contoh.com" value="<?= !empty($detail->website) ? $detail->website : ''; ?>">
												</div>
											</div>
										</div>

										<div class="col-md-12">
											<div class="form-group">
												<label for="">Facebook</label>
												<div class="input-group">
													<div class="input-group-addon"><i class="ti-facebook"></i></div>
													<input type="text" class="form-control" name="facebook" placeholder="username" value="<?= !empty($detail->facebook) ? $detail->facebook : ''; ?>">
												</div>
											</div>
										</div>

										<div class="col-md-12">
											<div class="form-group">
												<label for="">Twitter</label>
												<div class="input-group">
													<div class="input-group-addon"><i class="ti-twitter"></i></div>
													<input type="text" class="form-control" name="twitter" placeholder="username" value="<?= !empty($detail->twitter) ? $detail->twitter : ''; ?>">
												</div>
											</div>
										</div>

										<div class="col-md-12">
											<div class="form-group">
												<label for="">Instagram</label>
												<div class="input-group">
													<div class="input-group-addon"><i class="ti-instagram"></i></div>
													<input type="text" class="form-control" name="instagram" placeholder="username" value="<?= !empty($detail->instagram) ? $detail->instagram : ''; ?>">
												</div>
											</div>
										</div>

										<div class="col-md-12">
											<div class="form-group">
												<label for="">Tokopedia</label>
												<div class="input-group">
													<div class="input-group-addon"><i class="ti-tokopedia"></i></div>
													<input type="text" class="form-control" name="tokopedia" placeholder="username" value="<?= !empty($detail->tokopedia) ? $detail->tokopedia : ''; ?>">
												</div>
											</div>
										</div>

										<div class="col-md-12">
											<div class="form-group">
												<label for="">Shopee</label>
												<div class="input-group">
													<div class="input-group-addon"><i class="ti-shopee"></i></div>
													<input type="text" class="form-control" name="shopee" placeholder="username" value="<?= !empty($detail->shopee) ? $detail->shopee : ''; ?>">
												</div>
											</div>
										</div>

										<div class="col-md-12">
											<div class="form-group">
												<label for="">Bukalapak</label>
												<div class="input-group">
													<div class="input-group-addon"><i class="ti-bukalapak"></i></div>
													<input type="text" class="form-control" name="bukalapak" placeholder="username" value="<?= !empty($detail->bukalapak) ? $detail->bukalapak : ''; ?>">
												</div>
											</div>
										</div>
									</div>
								</div>


							</div>
								<div class="col-md-9">
									<div class="panel panel-default">
										<div class="panel-heading">
											Detail UMKM
										</div>
										<div class="panel-body">
											<div class="row">

												<div class="col-md-12">
													<div class="form-group">
														<label>Bidang Usaha <sup class="text-danger" title="Wajib diisi">*</sup> </label>
														<select id="kategori_kbli" name="kategori_kbli[]" class="kategori-kbli-multiple-select2" multiple>
														
														</select>
														<small class="error"><?= form_error("kategori_kbli[]"); ?></small>
													</div>
													<small>Selengkapnya terkait bidang usaha ada <a target="_blank" href="https://oss.go.id/informasi/kbli-berbasis-risiko">disini</a></small>
												</div>

												<div class="col-md-12">
													<div class="form-group">
														<label>Nama UMKM <sup class="text-danger" title="Wajib diisi">*</sup> </label>
														<input type="text" value="<?= !empty($detail->nama_umkm) ? $detail->nama_umkm : ''; ?>" name="nama_umkm" class="form-control" placeholder="Masukkan Nama UMKM">
														<small class="error"><?= form_error("nama_umkm"); ?></small>
													</div>
												</div>

												<div class="col-md-12">
													<div class="form-group">
														<label>Dekripsi UMKM</label>
														<textarea class="form-control" name="deskripsi_umkm"><?= !empty($detail->deskripsi_umkm) ? $detail->deskripsi_umkm : ''; ?> </textarea>
														<small class="error"><?= form_error("deskripsi_umkm"); ?></small>
													</div>
												</div>

												<div class="col-md-12">
													<div class="form-group">
														<label>NIK Pemilik <sup class="text-danger" title="Wajib diisi">*</sup></label>
														<input type="text" name="nik" value="<?= !empty($detail->nik) ? $detail->nik : ''; ?>" class="form-control" placeholder="Masukkan NIK Pemilik">
														<small class="error"><?= form_error("nik"); ?></small>
													</div>
												</div>

												<div class="col-md-12">
													<div class="form-group">
														<label>Nama Pemilik <sup class="text-danger" title="Wajib diisi">*</sup></label>
														<input type="text" name="nama_pemilik" value="<?= !empty($detail->nama_pemilik) ? $detail->nama_pemilik : ''; ?>" class="form-control" placeholder="Masukkan Nama Pemilik">
														<small class="error"><?= form_error("nama_pemilik"); ?></small>
													</div>
												</div>

												<div class="col-md-12">
													<div class="form-group">
														<label>Tanggal Lahir Pemilik <sup class="text-danger" title="Wajib diisi">*</sup></label>
														<input type="date" name="tgl_lahir" value="<?= !empty($detail->tgl_lahir) ? date('Y-m-d', strtotime($detail->tgl_lahir)) : ''; ?>" class="form-control" placeholder="Masukkan Tanggal Lahir">
														<small class="error"><?= form_error("tgl_lahir"); ?></small>
													</div>
												</div>

												<div class="col-md-12">
													<div class="form-group">
														<label>Jenis Kelamin Pemilik <sup class="text-danger" title="Wajib diisi">*</sup></label>
														<select name="jenis_kelamin" class="form-control form-control-line select2">
															<option hidden value="">Pilih Jenis Kelamin</option>
															<option value="Laki-laki" <?php echo set_select('jenis_kelamin', 'Laki-laki', ($detail->jenis_kelamin == 'Laki-laki') ? TRUE : FALSE ) ?>>Laki-laki</option>
															<option value="Perempuan" <?php echo set_select('jenis_kelamin', 'Perempuan', ($detail->jenis_kelamin == 'Perempuan') ? TRUE : FALSE ) ?>>Perempuan</option>
														</select>
														<small class="error"><?= form_error("jenis_kelamin"); ?></small>
													</div>
												</div>

												<div class="col-md-12">
													<div class="form-group">
														<label>Pendidikan Terakhir Pemilik</label>
														<select name="pendidikan" id="" class="form-control">
															<option value="">Pilih Tingkat Pendidikan</option>
															<option value="SD" <?php echo set_select('pendidikan', 'SD', ($detail->pendidikan == 'SD') ? TRUE : FALSE); ?>>SD</option>
															<option value="MI" <?php echo set_select('pendidikan', 'MI', ($detail->pendidikan == 'MI') ? TRUE : FALSE); ?>>MI</option>
															<option value="SMP" <?php echo set_select('pendidikan', 'SMP', ($detail->pendidikan == 'SMP') ? TRUE : FALSE); ?>>SMP</option>
															<option value="MTS" <?php echo set_select('pendidikan', 'MTS', ($detail->pendidikan == 'MTS') ? TRUE : FALSE); ?>>MTS</option>
															<option value="SMA" <?php echo set_select('pendidikan', 'SMA', ($detail->pendidikan == 'SMA') ? TRUE : FALSE); ?>>SMA</option>
															<option value="SMK" <?php echo set_select('pendidikan', 'SMK', ($detail->pendidikan == 'SMK') ? TRUE : FALSE); ?>>SMK</option>
															<option value="MA" <?php echo set_select('pendidikan', 'MA', ($detail->pendidikan == 'MA') ? TRUE : FALSE); ?>>MA</option>
															<option value="D1" <?php echo set_select('pendidikan', 'D1', ($detail->pendidikan == 'D1') ? TRUE : FALSE); ?>>D1</option>
															<option value="D2" <?php echo set_select('pendidikan', 'D2', ($detail->pendidikan == 'D2') ? TRUE : FALSE); ?>>D2</option>
															<option value="D3" <?php echo set_select('pendidikan', 'D3', ($detail->pendidikan == 'D3') ? TRUE : FALSE); ?>>D3</option>
															<option value="D4" <?php echo set_select('pendidikan', 'D4', ($detail->pendidikan == 'D4') ? TRUE : FALSE); ?>>D4</option>
															<option value="S1" <?php echo set_select('pendidikan', 'S1', ($detail->pendidikan == 'S1') ? TRUE : FALSE); ?>>S1</option>
															<option value="S2" <?php echo set_select('pendidikan', 'S2', ($detail->pendidikan == 'S2') ? TRUE : FALSE); ?>>S2</option>
															<option value="S3" <?php echo set_select('pendidikan', 'S3', ($detail->pendidikan == 'S3') ? TRUE : FALSE); ?>>S3</option>
														</select>
														<small class="error"><?= form_error("pendidikan"); ?></small>
													</div>
												</div>
												
												<div class="col-md-12">
													<div class="row">
														<div class="col-md-6">
															<div class="form-group">
																<label for="">Provinsi Pemilik<sup class="text-danger" title="Wajib diisi">*</sup></label>
																<select id="id_provinsi_pemilik" name="id_provinsi_pemilik" class="form-control select2" onChange='getKabupaten()'>
																	<option value="">- Pilih Provinsi -</option>
																	<?php foreach ($provinsi_all as $key => $value) { ?>
																		<option value="<?=$value->id_provinsi?>" <?php echo set_select('id_provinsi_pemilik', $value->id_provinsi, ($detail->id_provinsi_pemilik == $value->id_provinsi) ? TRUE : FALSE); ?>><?=$value->provinsi?></option>
																	<?php } ?>
																</select>
																<small class="error"><?= form_error("id_provinsi_pemilik"); ?></small>
															</div>
														</div>
														<div class="col-md-6">
															<div class="form-group">
																<label for="">Kota/Kabupaten Pemilik<sup class="text-danger" title="Wajib diisi">*</sup></label>
																<select id="id_kabupaten_pemilik" name="id_kabupaten_pemilik" class="form-control" id="">
																	<?php foreach ($kabupaten_all as $key => $value) { ?>
																			<option value="<?=$value->id_kabupaten?>" <?php echo set_select('id_kabupaten_pemilik', $value->id_kabupaten, ($detail->id_kabupaten_pemilik == $value->id_kabupaten) ? TRUE : FALSE); ?>><?=$value->kabupaten?></option>
																	<?php } ?>
																</select>
																<small class="error"><?= form_error("id_kabupaten_pemilik"); ?></small>
															</div>
														</div>
													</div>
												</div>
												
												<div class="col-md-12">
													<div class="row">
														<div class="col-md-6">
															<div class="form-group">
																<label for="">Kecamatan Pemilik<sup class="text-danger" title="Wajib diisi">*</sup></label>
																<select id="id_kecamatan_pemilik" name="id_kecamatan_pemilik" class="form-control" id="">
																	<?php foreach ($kecamatan_all as $key => $value) { ?>
																			<option value="<?=$value->id_kecamatan?>" <?php echo set_select('id_kecamatan_pemilik', $value->id_kecamatan, ($detail->id_kecamatan_pemilik == $value->id_kecamatan) ? TRUE : FALSE); ?>><?=$value->kecamatan?></option>
																	<?php } ?>
																</select>
																<small class="error"><?= form_error("id_kecamatan_pemilik"); ?></small>
															</div>
														</div>
														<div class="col-md-6">
															<div class="form-group">
																<label for="">Desa/Kelurahan Pemilik<sup class="text-danger" title="Wajib diisi">*</sup></label>
																<select id="id_desa_pemilik" name="id_desa_pemilik" class="form-control" id="">
																	<?php foreach ($desa_all as $key => $value) { ?>
																			<option value="<?=$value->id_desa?>" <?php echo set_select('id_desa_pemilik', $value->id_desa, ($detail->id_desa_pemilik == $value->id_desa) ? TRUE : FALSE); ?>><?=$value->desa?></option>
																	<?php } ?>
																</select>
																<small class="error"><?= form_error("id_desa_pemilik"); ?></small>
															</div>
														</div>
													</div>
												</div>
												<div class="col-md-12">
													<div class="form-group">
														<label>Alamat Pemilik<sup class="text-danger" title="Wajib diisi">*</sup></label>
														<textarea class="form-control" name="alamat_pemilik"><?=set_value('alamat_pemilik', $detail->alamat_pemilik)?></textarea>
														<small class="error"><?= form_error("alamat_pemilik"); ?></small>
													</div>
												</div>
												<div class="col-md-12">
													<div class="form-group">
														<label>Desa UMKM <sup class="text-danger">*</sup> </label>
														<select name="id_desa" class="form-control form-control-line select2">
															<option value="">Pilih desa</option>
															<?php
															foreach ($desa as $row) {
																$selected = (!empty($id_desa) && $id_desa == $row->id_desa) ? "selected" : "";
																echo "<option $selected value='$row->id_desa'>$row->desa, $row->kecamatan</option>";
															}
															?>
														</select>
														<small class="error"><?= form_error("id_desa"); ?></small>
													</div>
												</div>
												<div class="col-md-12">
													<div class="form-group">
														<label>Dusun UMKM</label>
														<input type="text" name="dusun" value="<?= !empty($dusun) ? $dusun : ''; ?>" class="form-control" placeholder="Masukkan Nama Dusun">
													</div>
												</div>
												<div class="col-md-12">
													<div class="form-group">
														<label>Alamat UMKM <sup class="text-danger" title="Wajib diisi">*</sup></label>
														<textarea class="form-control" name="alamat"><?= !empty($alamat) ? $alamat : ''; ?></textarea>
														<small class="error"><?= form_error("alamat"); ?></small>
													</div>
												</div>
												<div class="col-md-12">
													<div class="form-group">
														<label>Kodepos UMKM <sup class="text-danger" title="Wajib diisi">*</sup></label>
														<input type="number" class="form-control" name="kodepos_umkm" value="<?=set_value('kodepos_umkm', $detail->kodepos_umkm)?>">
														<small class="text-muted"> <sup>*</sup> Masukan angka saja</small>
														<small class="error"><?= form_error("kodepos_umkm"); ?></small>
													</div>
												</div>
												<div class="col-md-12">
													<div class="row">
														<div class="col-md-6">
															<div class="form-group">
																<label>Latitude UMKM</label>
																<input type="text" id="latitude" value="<?= !empty($detail->latitude) ? $detail->latitude : ''; ?>" onkeyup="loadMap()" name="latitude" class="form-control" placeholder="Masukkan Latitude (contoh: -6.838564884829641)">
																<small class="error"><?= form_error("latitude"); ?></small>
															</div>
															<small>Untuk tutorial pengambilan latitude dan longitude bisa dilihat <a target="_blank" href="https://help.catapa.com/articles/cara-mengisi-data-latitude-longitude-pada-alamat-karyawan-497dd694-aa4d-495b-a59d-cb0215d451bb">disini</a> </small>
														</div>
														<div class="col-md-6">
															<div class="form-group">
																<label>Longitude UMKM</label>
																<input type="text" value="<?= !empty($detail->longitude) ? $detail->longitude : ''; ?>" id="longitude" onkeyup="loadMap()" name="longitude" class="form-control" placeholder="Masukkan Longitude (contoh: 107.91891885804417)">
																<small class="error"><?= form_error("longitude"); ?></small>
															</div>
														</div>
													</div>
												</div>
												<br>
												<!-- 
												<div class="col-md-12">
													<input style="margin-bottom:10px" class="form-control" type="text" id="pac-input" placeholder="Cari alamat" />

													<div id="googleMap" class="gmaps"></div>
												</div> -->
												
												<div>
													<br>
													<br>
												<!-- <div class="col-md-12">
													<div class="form-group">
														<label>Lama Usaha</label>
														<input type="text" name="lama_usaha" value="<?= !empty($detail->lama_usaha) ? $lama_usaha : ''; ?>" class="form-control" placeholder="Masukkan Lama Usaha">
													</div>
												</div>
												</div>

												<div>
												<div class="col-md-12">
													<div class="form-group">
														<label>Harga</label>
														<input type="text" name="harga" value="<?= !empty($detail->harga) ? $harga : ''; ?>" class="form-control" placeholder="Masukkan Harga">
													</div>
												</div>
												</div> -->

												<div class="col-md-12">
													<div class="form-group">
														<label> Omset / Tahun <sup class="text-danger" title="Wajib diisi">*</sup></label>
														<div class="input-group"> <span class="input-group-addon">Rp.</span>
															<input type="number" name="omset" value="<?= !empty($detail->omset) ? $detail->omset : ''; ?>" class="form-control" placeholder="Masukkan Omset / Tahun (Rata-rata)">
														</div>
														<small class="text-muted"> <sup>*</sup> Masukan angka saja</small>
														<small class="error"><?= form_error("omset"); ?></small>
													</div>
												</div>

												<div class="col-md-12">
													<div class="form-group">
														<label>Aset (Rp) / Tahun <sup class="text-danger" title="Wajib diisi">*</sup></label>
														<div class="input-group"> <span class="input-group-addon">Rp.</span>
															<input type="number" name="aset" value="<?= !empty($detail->aset) ? $detail->aset : ''; ?>" class="form-control" placeholder="Masukkan Aset / Tahun (Rata-rata)">
														</div>
														<small class="text-muted"> <sup>*</sup> Masukan angka saja</small>
														<small class="error"><?= form_error("aset"); ?></small>
													</div>
												</div>

												<div class="col-md-12">
													<div class="form-group">
														<label>Kriteria Usaha</label>
														<select name="kriteria_usaha" class="form-control form-control-line select2">
															<option hidden value="">Pilih Kriteria Usaha</option>
															<option value="Mikro" <?php echo set_select('kriteria_usaha', 'Mikro', ($detail->kriteria_usaha == 'Mikro') ? TRUE : FALSE); ?>>Mikro</option>
															<option value="Kecil" <?php echo set_select('kriteria_usaha', 'Kecil', ($detail->kriteria_usaha == 'Kecil') ? TRUE : FALSE); ?>>Kecil</option>
															<option value="Menengah" <?php echo set_select('kriteria_usaha', 'Menengah', ($detail->kriteria_usaha == 'Menengah') ? TRUE : FALSE); ?>>Menengah</option>
														</select>
													</div>
												</div>

												<div class="col-md-12">
													<div class="form-group">
														<label>Jumlah Tenaga Kerja <sup class="text-danger" title="Wajib diisi">*</sup></label>
														<input type="number" name="jum_tk" value="<?= !empty($detail->jum_tk) ? $detail->jum_tk : ''; ?>" class="form-control" placeholder="Masukkan Jumlah Tenaga Kerja">
														<small class="text-muted"> <sup>*</sup> Masukan angka saja</small>
														<small class="error"><?= form_error("jum_tk"); ?></small>
													</div>
												</div>

												<div class="col-md-12">
													<div class="form-group">
														<label>Jumlah Produksi / Tahun <sup class="text-danger" title="Wajib diisi">*</sup></label>
														<input type="number" name="jum_produksi" value="<?= !empty($detail->jum_produksi) ? $detail->jum_produksi : ''; ?>" class="form-control" placeholder="Masukkan Jumlah Produksi">
														<small class="text-muted"> <sup>*</sup> Masukan angka saja</small>
														<small class="error"><?= form_error("jum_produksi"); ?></small>
													</div>
												</div>

												<div class="col-md-12">
													<div class="form-group">
														<label>Wilayah Pemasaran</label>
														<input type="text" name="wilayah_pemasaran" value="<?= !empty($detail->wilayah_pemasaran) ? $detail->wilayah_pemasaran : ''; ?>" class="form-control" placeholder="Masukkan Wilayah Pemasaran">
													</div>
												</div>

												<div class="col-md-12">
														<label>Legalitas Usaha</label>
												</div>

												<div class="col-md-12">
													<div class="form-group">
														<label>NPWP</label>
														<input type="text" name="npwp" value="<?= !empty($detail->npwp) ? $detail->npwp : ''; ?>" class="form-control" placeholder="Masukkan No NPWP">
														<small class="text-muted"><sup>*</sup> Kosongkan bila tidak ada</small>
														<small class="error"><?= form_error("npwp"); ?></small>
													</div>
												</div>

												<div class="col-md-12">
													<div class="form-group">
														<label>NIB</label>
														<input type="text" name="nib" value="<?= !empty($detail->nib) ? $detail->nib : ''; ?>" class="form-control" placeholder="Masukkan No NIB">
														<small class="text-muted"><sup>*</sup> Kosongkan bila tidak ada</small>
														<small class="error"><?= form_error("nib"); ?></small>
													</div>
												</div>

												<div class="col-md-12">
													<div class="form-group">
														<label>PIRT</label>
														<input type="text" name="pirt" value="<?= !empty($detail->pirt) ? $detail->pirt : ''; ?>" class="form-control" placeholder="Masukkan No PIRT">
														<small class="text-muted"><sup>*</sup> Kosongkan bila tidak ada</small>
													</div>
												</div>

												<div class="col-md-12">
													<div class="form-group">
														<label>HALAL</label>
														<input type="text" name="halal" value="<?= !empty($detail->halal) ? $detail->halal : ''; ?>" class="form-control" placeholder="Masukkan No Halal">
														<small class="text-muted"><sup>*</sup> Kosongkan bila tidak ada</small>
													</div>
												</div>

												<div class="col-md-12">
													<div class="form-group">
														<label>BPOM</label>
														<input type="text" name="bpom" value="<?= !empty($detail->bpom) ? $detail->bpom : ''; ?>" class="form-control" placeholder="Masukkan No BPOM">
														<small class="text-muted"><sup>*</sup> Kosongkan bila tidak ada</small>
													</div>
												</div>

												<div class="col-md-12">
													<div class="form-group">
														<label>HAKI</label>
														<input type="text" name="haki" value="<?= !empty($detail->haki) ? $detail->haki : ''; ?>" class="form-control" placeholder="Masukkan No HAKI">
														<small class="text-muted"><sup>*</sup> Kosongkan bila tidak ada</small>
													</div>
												</div>

												<div class="col-md-12">
													<div class="form-group">
														<label>PATEN</label>
														<input type="text" name="paten" value="<?= !empty($detail->paten) ? $detail->paten : ''; ?>" class="form-control" placeholder="Masukkan No Paten">
														<small class="text-muted"><sup>*</sup> Kosongkan bila tidak ada</small>
													</div>
												</div>

												<div class="col-md-12">
													<div class="form-group">
														<label>SNI</label>
														<input type="text" name="sni" value="<?= !empty($detail->sni) ? $detail->sni : ''; ?>" class="form-control" placeholder="Masukkan No SNI">
														<small class="text-muted"><sup>*</sup> Kosongkan bila tidak ada</small>
													</div>
												</div>

												<div class="col-md-12">
													<div class="form-group">
														<label>Lainnya</label>
														<input type="text" name="lainnya" value="<?= !empty($detail->lainnya) ? $detail->lainnya : ''; ?>" class="form-control" placeholder="Lainnya">
													</div>
												</div>

												<div class="col-md-12">
													<div class="form-group">
														<label>Modal Usaha <sup class="text-danger" title="Wajib diisi">*</sup></label>

														<select name="modal_usaha" class="form-control form-control-line select2">
															<option hidden value="">Pilih Modal Usaha</option>
															<option value="Laki-laki" <?php echo set_select('modal_usaha', 'Sendiri', False); ?>>Sendiri</option>
															<option value="Perempuan" <?php echo set_select('modal_usaha', 'Pinjaman', False); ?>>Pinjaman</option>
														</select>
														<small class="error"><?= form_error("modal_usaha"); ?></small>
													</div>
												</div>
												
												<div class="col-md-12">
													<div class="form-group">
														<label>Pelatihan yang Pernah Diikuti</label>
														<textarea class="form-control" name="pelatihan"><?= !empty($pelatihan) ? $pelatihan : ''; ?> </textarea>
														<small class="error"><?= form_error("pelatihan"); ?></small>
													</div>
												</div>

												<div class="col-md-12">
													<div class="form-group">
														<label>Tag</label>
														<textarea class="form-control" value="<?= !empty($tag) ? $tag : ''; ?>" name="tag" placeholder="Dipisah dengan tanda koma (,)"></textarea>
													</div>
												</div>

												Inputan dengan tanda <sup class="text-danger">*</sup> di label<b> WAJIB DIISI </b>.
											</div>
										</div>
									</div>

									</div>
								</div>
							</div>

														<div class="modal-footer">
															<button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Batal</button>
															<button type="submit" class="btn btn-primary waves-effect text-left">Kirim</button>
														</div>
													</form>
												</div>

											</div>
											<!-- /.modal-content -->
										</div>
										<!-- /.modal-dialog -->
									</div>

							</div>
							<br>
							<br>
							<!-- <div class="white-box">
								<label>Jadwal UMKM</label>
								<div class="table-responsive">
									<form action="<?php echo base_url(); ?>profil/umkm/update_jadwal" method="POST">

										<input type="hidden" name="id_umkm" value="<?= $detail->id_umkm; ?>">
										<table class="table color-table">
											<thead>
												<tr>
													<th style="text-align: center">Hari</th>
													<th style="text-align: center">Status</th>
													<th style="text-align: center">Jam Buka</th>
													<th style="text-align: center">Jam Tutup</th>

												</tr>
											</thead>
											<tbody>

												<tr>
													<?php
													$v_senin = $detail->senin == 'Y' ? 'checked' : '';
													$v_selasa = $detail->selasa == 'Y' ? 'checked' : '';
													$v_rabu = $detail->rabu == 'Y' ? 'checked' : '';
													$v_kamis = $detail->kamis == 'Y' ? 'checked' : '';
													$v_jumat = $detail->jumat == 'Y' ? 'checked' : '';
													$v_sabtu = $detail->sabtu == 'Y' ? 'checked' : '';
													?>


													<td style="text-align: center">Senin</td>
													<td style="text-align: center">

														<input type="checkbox" value="Y" class="js-switch" data-color="#7906FE" data-secondary-color="#B7B4AF" name="senin" <?= $v_senin; ?>>
													</td>
													<td style="text-align: center">
														<div class="input-group clockpicker " data-placement="bottom" data-align="top" data-autoclose="true">
															<input type="text" class="form-control jam_buka" name="jam_buka_senin" placeholder="" value="<?= $detail->jam_buka_senin; ?>">

														</div>

													</td>
													<td style="text-align: center">
														<div class="input-group clockpicker " data-placement="bottom" data-align="top" data-autoclose="true">
															<input type="text" class="form-control jam_tutup" name="jam_tutup_senin" placeholder="" value="<?= $detail->jam_tutup_senin; ?>">

														</div>
													</td>
												</tr>

												<tr>

													<td style="text-align: center">Selasa</td>
													<td style="text-align: center"><input type="checkbox" value="Y" class="js-switch" data-color="#7906FE" data-secondary-color="#B7B4AF" name="selasa" <?= $v_selasa; ?>></td>
													<td style="text-align: center">
														<div class="input-group clockpicker " data-placement="bottom" data-align="top" data-autoclose="true">
															<input type="text" class="form-control" name="jam_buka_selasa" placeholder="" value="<?= $detail->jam_buka_selasa; ?>">

														</div>
													</td>
													<td style="text-align: center">
														<div class="input-group clockpicker " data-placement="bottom" data-align="top" data-autoclose="true">
															<input type="text" class="form-control" name="jam_tutup_selasa" placeholder="" value="<?= $detail->jam_tutup_selasa; ?>">

														</div>
													</td>
												</tr>

												<tr>

													<td style="text-align: center">Rabu</td>
													<td style="text-align: center"><input type="checkbox" value="Y" class="js-switch" data-color="#7906FE" data-secondary-color="#B7B4AF" name="rabu" <?= $v_rabu; ?>></td>
													<td style="text-align: center">
														<div class="input-group clockpicker " data-placement="bottom" data-align="top" data-autoclose="true">
															<input type="text" class="form-control" name="jam_buka_rabu" placeholder="" value="<?= $detail->jam_buka_rabu; ?>">

														</div>
													</td>
													<td style="text-align: center">
														<div class="input-group clockpicker " data-placement="bottom" data-align="top" data-autoclose="true">
															<input type="text" class="form-control" name="jam_tutup_rabu" placeholder="" value="<?= $detail->jam_tutup_rabu; ?>">

														</div>
													</td>
												</tr>


												<tr>
													<td style="text-align: center">Kamis</td>
													<td style="text-align: center"><input type="checkbox" value="Y" class="js-switch" data-color="#7906FE" data-secondary-color="#B7B4AF" name="kamis" <?= $v_kamis; ?>></td>
													<td style="text-align: center">
														<div class="input-group clockpicker " data-placement="bottom" data-align="top" data-autoclose="true">
															<input type="text" class="form-control" name="jam_buka_kamis" placeholder="" value="<?= $detail->jam_buka_kamis; ?>">

														</div>
													</td>
													<td style="text-align: center">
														<div class="input-group clockpicker " data-placement="bottom" data-align="top" data-autoclose="true">
															<input type="text" class="form-control" name="jam_tutup_kamis" placeholder="" value="<?= $detail->jam_tutup_kamis; ?>">

														</div>
													</td>
												</tr>


												<tr>
													<td style="text-align: center">Jumat</td>
													<td style="text-align: center"><input type="checkbox" value="Y" class="js-switch" data-color="#7906FE" data-secondary-color="#B7B4AF" name="jumat" <?= $v_jumat; ?>></td>
													<td style="text-align: center">
														<div class="input-group clockpicker " data-placement="bottom" data-align="top" data-autoclose="true">
															<input type="text" class="form-control" name="jam_buka_jumat" placeholder="" value="<?= $detail->jam_buka_jumat; ?>">

														</div>
													</td>
													<td style="text-align: center">
														<div class="input-group clockpicker " data-placement="bottom" data-align="top" data-autoclose="true">
															<input type="text" class="form-control" name="jam_tutup_jumat" placeholder="" value="<?= $detail->jam_tutup_jumat; ?>">

														</div>
													</td>
												</tr>

												<tr>
													<td style="text-align: center">Sabtu</td>
													<td style="text-align: center"><input type="checkbox" value="Y" class="js-switch" data-color="#7906FE" data-secondary-color="#B7B4AF" name="sabtu" <?= $v_sabtu; ?>></td>
													<td style="text-align: center">
														<div class="input-group clockpicker " data-placement="bottom" data-align="top" data-autoclose="true">
															<input type="text" class="form-control" name="jam_buka_sabtu" placeholder="" value="<?= $detail->jam_buka_sabtu; ?>">

														</div>
													</td>
													<td style="text-align: center">
														<div class="input-group clockpicker " data-placement="bottom" data-align="top" data-autoclose="true">
															<input type="text" class="form-control" name="jam_tutup_sabtu" placeholder="" value="<?= $detail->jam_tutup_sabtu; ?>">

														</div>
													</td>
												</tr>


											</tbody>
										</table>
										<button type="submit" class="btn btn-primary pull-right"> Update Jadwal</button>
									</form>
								</div>
							</div> -->
					


						</div>
						<div class="col-md-8">

							<div class="panel panel-default">
								<div class="panel-heading">
									Detail UMKM
								</div>
								<div class="panel-body">
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label>Bidang Usaha</label>
												<?php if ($kategori_kbli_arr) { ?>
													<ul>
													 	<?php foreach ($kategori_kbli_arr as $key => $value) { ?>
															 <li><?=$value->nama_kbli?></li>
														 <?php } ?>
													</ul>
												<?php } else {
													echo 'Belum ada kategori';
												} ?>
											</div>
										</div>
										<div class="col-md-12">
											<div class="form-group">
												<label>Nama UMKM</label>
												<p><?= $detail->nama_umkm ?></p>
											</div>
										</div>
										<div class="col-md-12">
											<div class="form-group">
												<label>Deskripsi UMKM</label>
												<p><?= $detail->deskripsi_umkm ?></p>
											</div>
										</div>
									
										<div class="col-md-12">
											<div class="form-group">
												<label>NIK Pemilik</label>
												<p><?= $detail->nik ?></p>
											</div>
										</div>
										<div class="col-md-12">
											<div class="form-group">
												<label>Nama Pemilik </label>
												<p><?= $detail->nama_pemilik ?></p>
											</div>
										</div>
										<div class="col-md-12">
											<div class="form-group">
												<label>Tanggal Lahir Pemilik</label>
												<p><?= date('d M Y', strtotime($detail->tgl_lahir)) ?></p>
											</div>
										</div>
										<div class="col-md-12">
											<div class="form-group">
												<label>Jenis Kelamin Pemilik</label>
												<p><?= $detail->jenis_kelamin ?></p>
											</div>
										</div>
										<div class="col-md-12">
											<div class="form-group">
												<label>Pendidikan Terakhir Pemilik</label>
												<p><?= $detail->pendidikan ?: '-' ?></p>
											</div>
										</div>
										<div class="col-md-12">
											<div class="form-group">
												<label>Dusun </label>
												<p><?= $detail->dusun ?: '-' ?></p>
											</div>
										</div>
										<div class="col-md-12">
											<div class="form-group">
												<label>Lama Usaha </label>
												<p><?= $detail->lama_usaha ?: '-' ?></p>
											</div>
										</div>

										<div class="col-md-12">
											<div class="form-group">
												<label>Harga </label>
												<p><?= $detail->harga ?: '-' ?></p>
											</div>
										</div>
									
										<div class="col-md-12">
											<div class="form-group">
												<label>Omset / Tahun</label>
												<p>Rp. <?= $detail->omset ? number_format($detail->omset, 0, ',', '.') : '-' ?></p>
											</div>
										</div>
										<div class="col-md-12">
											<div class="form-group">
												<label>Aset / Tahun</label>
												<p>Rp. <?= $detail->aset ? number_format($detail->aset, 0, ',', '.') : '-' ?></p>
											</div>
										</div>
										<div class="col-md-12">
											<div class="form-group">
												<label>Kriteria Usaha</label>
												<p><?= $detail->kriteria_usaha ?: '-' ?></p>
											</div>
										</div>
										<div class="col-md-12">
											<div class="form-group">
												<label>Jumalah Tenaga Kerja</label>
												<p><?= $detail->jum_tk ?></p>
											</div>
										</div>
										<div class="col-md-12">
											<div class="form-group">
												<label>Jumlah Produksi / bulan</label>
												<p><?= $detail->jum_produksi ?></p>
											</div>
										</div>
										<div class="col-md-12">
											<div class="form-group">
												<label>Wilayah Pemasaran</label>
												<p><?= $detail->wilayah_pemasaran ?: '-' ?></p>
											</div>
										</div>
										<div class="col-md-12">
											<div class="form-group">
												<label>NPWP</label>
												<p><?= $detail->npwp ?: '-' ?></p>
											</div>
										</div>
										<div class="col-md-12">
											<div class="form-group">
												<label>NIB</label>
												<p><?= $detail->nib ?: '-' ?></p>
											</div>
										</div>
										<div class="col-md-12">
											<div class="form-group">
												<label>PIRT</label>
												<p><?= $detail->pirt ?: '-' ?></p>
											</div>
										</div>
										<div class="col-md-12">
											<div class="form-group">
												<label>HALAL</label>
												<p><?= $detail->halal ?: '-' ?></p>
											</div>
										</div>
										<div class="col-md-12">
											<div class="form-group">
												<label>BPOM</label>
												<p><?= $detail->bpom ?: '-' ?></p>
											</div>
										</div>
										<div class="col-md-12">
											<div class="form-group">
												<label>Haki</label>
												<p><?= $detail->haki ?: '-' ?></p>
											</div>
										</div>
										<div class="col-md-12">
											<div class="form-group">
												<label>paten</label>
												<p><?= $detail->paten ?: '-' ?></p>
											</div>
										</div>
										<div class="col-md-12">
											<div class="form-group">
												<label>SNI</label>
												<p><?= $detail->sni ?: '-' ?></p>
											</div>
										</div>
										
										<div class="col-md-12">
											<div class="form-group">
												<label>Alamat </label>
												<p><?= $detail->alamat_umkm ?: '-' ?></p>
												<?php
												if (!empty($detail_desa)) {
													echo $detail_desa->desa . ", " . $detail_desa->kecamatan;
												}
												?>
											</div>
										</div>
										<!-- <div class="col-md-12">
											<div id="googleMap" class="gmaps"></div>
										</div> -->

										<div class="col-md-12">
											<div class="form-group">
												<label>Kontak </label>
												<p>
													<i class="fa fa-envelope"></i> <?= $detail->email ?: '-'; ?><br>
													<i class="fa fa-phone"></i> <?= $detail->telepon ?: '-'; ?><br>
													<i class="fa fa-globe"></i> <?= $detail->website ?: '-'; ?><br>
													<i class="fa fa-instagram"></i> <?= $detail->instagram ?: '-'; ?><br>
													<i class="fa fa-facebook-square"></i> <?= $detail->facebook ?: '-'; ?><br>
													<i class="fa fa-twitter-square"></i> <?= $detail->twitter ?: '-'; ?><br>
													<i class="fa fa-shopping-basket"></i> <?= $detail->tokopedia ?: '-'; ?><br>
													<i class="fa fa-shopping-basket"></i> <?= $detail->shopee ?: '-'; ?><br>
													<i class="fa fa-shopping-basket"></i> <?= $detail->bukalapak ?: '-'; ?><br>
												</p>
											</div>
										</div>
									</div>
								</div>
							</div>




						</div>

						<div class="col-md-12">

							<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
											<h4 class="modal-title" id="title_katalog"> Katalog</h4>
										</div>
										<form id="data-form" method="post" action="<?= base_url(); ?>profil/umkm/simpan_katalog" enctype="multipart/form-data">
											<!-- <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" /> -->
											<input type="hidden" value="" name="flag" id="flag_katalog" />
											<input type="hidden" value="" name="id_katalog" id="id_katalog" />
											<div class="modal-body">

												<input type="hidden" name="id_umkm" value="<?= $detail->id_umkm; ?>" />


												<div class="form-group">
													<label for="recipient-name" class="control-label">Nama Katalog</label>
													<input type="text" class="form-control" name="nama_katalog" id="nama_katalog">
												</div>
												<div class="form-group">
													<label for="message-text" class="control-label">Deskripsi</label>
													<textarea class="form-control" name="deskripsi_katalog" id="deskripsi_katalog"></textarea>
												</div>
												<div class="form-group">
													<label for="recipient-name" class="control-label">Harga</label>
													<input type="text" class="form-control" name="harga" id="harga_katalog">
												</div>
												<div class="form-group">
													<label for="message-text" class="control-label">foto</label>
													<input type="file" id="input-file-now" name="foto" class="dropify" />
												</div>


											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
												<button type="submit" class="btn btn-primary" onclick="">Simpan</button>
											</div>
										</form>
									</div>
								</div>
							</div>

							<div class="panel panel-default">
								<div class="panel-heading">
									Katalog

									<!-- <div class="pull-right"><a href="#"><button class="btn btn-primary " style="margin-bottom: 15px;" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo" type="button" onclick="tambah_katalog()"><span class="btn-label"><i class="fa fa-plus"></i></span>Tambah Katalog</button></a> </div> -->

								</div>
								<div class="panel-body">
									<div class="row">

										<table class="table">
											<thead>
												<tr>
													<th>No</th>
													<th>Nama Katalog</th>
													<th>Deskripsi</th>
													<th>Harga</th>
													<th>Foto</th>
													<th>Opsi</th>
												</tr>
											</thead>
											<tbody>

												<?php
												$no = 0;
												foreach ($katalog as $p) {
													$no++;
													$foto = ($p->foto != "") ? "<a href='" ."https://e-officedesa.sumedangkab.go.id/data/umkmtalog/" . $p->foto . "'  data-toggle='lightbox' data-gallery='multiimages' data-title='" . $p->nama_katalog . "'> <img src='" . base_url() . "data/umkm/katalog/" . $p->foto . "' height='50px' /></a>" : "";
												?>

													<tr>
														<td><?= $no; ?></td>
														<td><?= $p->nama_katalog ?> </td>
														<td><?= $p->deskripsi_katalog ?> </td>
														<td><?= $p->harga ?></td>
														<td><?= $foto; ?> </td>
														<td class="text-nowrap">
															<a href="#" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo" data-original-title="Edit" onclick="edit_katalog(<?= $p->id_katalog; ?>,'<?= $p->nama_katalog; ?>','<?= $p->deskripsi_katalog; ?>','<?= $p->harga; ?>')"> <i class="fa fa-pencil text-inverse m-r-10"></i> </a>
															<a onclick="delete_katalog_(<?= $p->id_katalog; ?>,<?= $p->id_umkm; ?>)" data-toggle="tooltip" data-original-title="hapus"> <i class="fa fa-close text-danger"></i> </a>
														</td>
													</tr>
												<?php
												}
												?>
											</tbody>
										</table>
									</div>
								</div>
							</div>


							<div class="panel panel-default">
								<div class="panel-heading">
									Foto

									<!-- <div class="pull-right"><a href="#"><button class="btn btn-primary " style="margin-bottom: 15px;" data-toggle="modal" data-target="#sub_umkm_modal" data-whatever="@mdo" type="button"><span class="btn-label"><i class="fa fa-plus"></i></span>Tambah Foto</button></a> </div> -->

								</div>

								<div class="row">
									<div class="col-md-12">
										<div class="white-box">
											<!--
														<div id="gallery">
															
															<div id="gallery-content">
																<div id="gallery-content-center">
																	<?php
																	foreach ($foto as $f) { ?>
																		<a href="<?="https://e-officedesa.sumedangkab.go.id/data/umkm/" . $f->foto; ?>" data-toggle="lightbox" data-gallery="multiimages" data-title="<?= $nama_umkm; ?>"><img src="<?="https://e-officedesa.sumedangkab.go.id/data/umkm/" . $f->foto; ?>" alt="<?= $nama_umkm; ?>" class="all" /> </a>
																		
																	<?php } ?>	
																</div>
															</div>
														</div>
														-->
											<div class="popup-gallery m-t-30">
												<?php
												foreach ($foto as $f) {  ?>
												
													<a href="<?="https://e-officedesa.sumedangkab.go.id/data/umkm/" . $f->foto; ?>" title="<?= $detail->nama_umkm; ?>">
														<img src="<?="https://e-officedesa.sumedangkab.go.id/data/umkm/" . $f->foto; ?>" width="30.5%" />
													</a>
													<button class="fa fa-trash" style="position:static; top:0;" onclick="delete_foto(<?= $f->id_foto_listing_umkm; ?>,<?= $detail->id_umkm; ?>)"></button>

												<?php } ?>
											</div>
											<div class="clearfix"></div>
										</div>
									</div>
								</div>


								<div class="modal fade" id="sub_umkm_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
												<h4 class="modal-title" id="exampleModalLabel1">Tambah Foto</h4>
											</div>
											<div class="modal-body">
												<form action="<?php echo base_url('umkm/add_foto'); ?>" method="POST" enctype="multipart/form-data">
													<!-- <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" /> -->
													<input type="hidden" name="id_umkm" value="<?= $id_umkm; ?>">


													<div class="row">
														<div class="col-md-12">
															<div class="form-group">
																<label>Foto </label>
																<input type="file" id="input-file-now" name="foto" class="dropify" />
															</div>
														</div>

													</div>


											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
												<button type="submit" class="btn btn-primary">Simpan</button>
												</form>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

			</div>
			<a href='<?= base_url(); ?>profil/umkm' class='btn btn-default pull-right'>Kembali</a>

			
			<script>
					$(document).ready(function() {
						$('.kategori-kbli-multiple-select2').select2();
						var url = "<?=base_url()?>profil/umkm/get_kbli_all";
						fetch(url)
							.then((response) => {
								return response.json();
								})
							.then((data) => {
								let res = data;
								var kbli = '';

								res.forEach(e => {
									kbli += '<option value="'+e.kode_kbli+'" >'+e.nama_kbli+'</option>';
								});

								$('#kategori_kbli').html(kbli);
							});
							// $('.kategori-kbli-multiple-select2').val([01116,01118]);
					});

					$("#id_provinsi_pemilik").change(function() {
						var id_provinsi = $('#id_provinsi_pemilik').val();
						var url = "<?=base_url()?>profil/umkm/get_kabupaten_all/"+id_provinsi;

						fetch(url)
							.then((response) => {
								return response.json();
								})
							.then((data) => {
								let res = data;
								var kabupaten = '';

								res.forEach(e => {
									kabupaten += '<option value="'+e.id_kabupaten+'">'+e.kabupaten+'</option>';
								});

								$('#id_kabupaten_pemilik').attr('readonly',false);
								$('#id_kabupaten_pemilik').html(kabupaten);
							})
					});		

					$("#id_kabupaten_pemilik").change(function() {
						var id_kabupaten = $('#id_kabupaten_pemilik').val();
						var url = "<?=base_url()?>profil/umkm/get_kecamatan_all/"+id_kabupaten;
						console.log(url);

						fetch(url)
							.then((response) => {
								return response.json();
								})
							.then((data) => {
								let res = data;
								var kecamatan = '';

								res.forEach(e => {
									kecamatan += '<option value="'+e.id_kecamatan+'">'+e.kecamatan+'</option>';
								});

								$('#id_kecamatan_pemilik').attr('readonly',false);
								$('#id_kecamatan_pemilik').html(kecamatan);
							})
					});												

					$("#id_kecamatan_pemilik").change(function() {
						var id_kecamatan = $('#id_kecamatan_pemilik').val();
						var url = "<?=base_url()?>profil/umkm/get_desa_all/"+id_kecamatan;
						console.log(url);

						fetch(url)
							.then((response) => {
								return response.json();
								})
							.then((data) => {
								let res = data;
								var desa = '';

								res.forEach(e => {
									desa += '<option value="'+e.id_desa+'">'+e.desa+'</option>';
								});

								$('#id_desa_pemilik').attr('readonly',false);
								$('#id_desa_pemilik').html(desa);
							})
					});
			</script>
	
