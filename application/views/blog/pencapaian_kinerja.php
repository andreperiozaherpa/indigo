<?php
$CI = &get_instance();
$CI->load->model('company_profile_model');
$CI->company_profile_model->set_identity();
$p_nama = $CI->company_profile_model->nama;
$p_tentang = $CI->company_profile_model->tentang;
$p_alamat = $CI->company_profile_model->alamat;
$p_logo = $CI->company_profile_model->logo;
$p_email = $CI->company_profile_model->email;
$p_facebook = $CI->company_profile_model->facebook;
$p_twitter = $CI->company_profile_model->twitter;
$p_telepon = $CI->company_profile_model->telepon;
$p_youtube = $CI->company_profile_model->youtube;
$p_gmap = $CI->company_profile_model->gmap;
$p_tentang = $CI->company_profile_model->tentang;
$p_instagram = $CI->company_profile_model->instagram;
?>
<style type="text/css">
	.listing-thumbnail {
		margin: 0;
		position: absolute;
		top: 50%;
		left: 50%;
		transform: translate(-50%, -50%);
	}

	.listing-thumbnail span {
		font-size: 100px;
		color: #f91942;
	}

	@-webkit-keyframes progress-bar-stripes {
		from {
			background-position: 40px 0;
		}

		to {
			background-position: 0 0;
		}
	}

	@-o-keyframes progress-bar-stripes {
		from {
			background-position: 40px 0;
		}

		to {
			background-position: 0 0;
		}
	}

	@keyframes progress-bar-stripes {
		from {
			background-position: 40px 0;
		}

		to {
			background-position: 0 0;
		}
	}

	.progress {
		height: 20px;
		margin-bottom: 20px;
		overflow: hidden;
		background-color: #f5f5f5;
		border-radius: 4px;
		-webkit-box-shadow: inset 0 1px 2px rgba(0, 0, 0, .1);
		box-shadow: inset 0 1px 2px rgba(0, 0, 0, .1);
	}

	.progress-bar {
		float: left;
		width: 0;
		height: 100%;
		font-size: 12px;
		line-height: 20px;
		color: #fff;
		text-align: center;
		background-color: #337ab7;
		-webkit-box-shadow: inset 0 -1px 0 rgba(0, 0, 0, .15);
		box-shadow: inset 0 -1px 0 rgba(0, 0, 0, .15);
		-webkit-transition: width .6s ease;
		-o-transition: width .6s ease;
		transition: width .6s ease;
	}

	.progress-striped .progress-bar,
	.progress-bar-striped {
		background-image: -webkit-linear-gradient(45deg, rgba(255, 255, 255, .15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, .15) 50%, rgba(255, 255, 255, .15) 75%, transparent 75%, transparent);
		background-image: -o-linear-gradient(45deg, rgba(255, 255, 255, .15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, .15) 50%, rgba(255, 255, 255, .15) 75%, transparent 75%, transparent);
		background-image: linear-gradient(45deg, rgba(255, 255, 255, .15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, .15) 50%, rgba(255, 255, 255, .15) 75%, transparent 75%, transparent);
		-webkit-background-size: 40px 40px;
		background-size: 40px 40px;
	}

	.progress.active .progress-bar,
	.progress-bar.active {
		-webkit-animation: progress-bar-stripes 2s linear infinite;
		-o-animation: progress-bar-stripes 2s linear infinite;
		animation: progress-bar-stripes 2s linear infinite;
	}

	.progress-bar-success {
		background-color: #5cb85c;
	}

	.progress-striped .progress-bar-success {
		background-image: -webkit-linear-gradient(45deg, rgba(255, 255, 255, .15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, .15) 50%, rgba(255, 255, 255, .15) 75%, transparent 75%, transparent);
		background-image: -o-linear-gradient(45deg, rgba(255, 255, 255, .15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, .15) 50%, rgba(255, 255, 255, .15) 75%, transparent 75%, transparent);
		background-image: linear-gradient(45deg, rgba(255, 255, 255, .15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, .15) 50%, rgba(255, 255, 255, .15) 75%, transparent 75%, transparent);
	}

	.progress-bar-info {
		background-color: #5bc0de;
	}

	.progress-striped .progress-bar-info {
		background-image: -webkit-linear-gradient(45deg, rgba(255, 255, 255, .15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, .15) 50%, rgba(255, 255, 255, .15) 75%, transparent 75%, transparent);
		background-image: -o-linear-gradient(45deg, rgba(255, 255, 255, .15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, .15) 50%, rgba(255, 255, 255, .15) 75%, transparent 75%, transparent);
		background-image: linear-gradient(45deg, rgba(255, 255, 255, .15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, .15) 50%, rgba(255, 255, 255, .15) 75%, transparent 75%, transparent);
	}

	.progress-bar-warning {
		background-color: #f0ad4e;
	}

	.progress-striped .progress-bar-warning {
		background-image: -webkit-linear-gradient(45deg, rgba(255, 255, 255, .15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, .15) 50%, rgba(255, 255, 255, .15) 75%, transparent 75%, transparent);
		background-image: -o-linear-gradient(45deg, rgba(255, 255, 255, .15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, .15) 50%, rgba(255, 255, 255, .15) 75%, transparent 75%, transparent);
		background-image: linear-gradient(45deg, rgba(255, 255, 255, .15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, .15) 50%, rgba(255, 255, 255, .15) 75%, transparent 75%, transparent);
	}

	.progress-bar-danger {
		background-color: #d9534f;
	}

	.progress-striped .progress-bar-danger {
		background-image: -webkit-linear-gradient(45deg, rgba(255, 255, 255, .15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, .15) 50%, rgba(255, 255, 255, .15) 75%, transparent 75%, transparent);
		background-image: -o-linear-gradient(45deg, rgba(255, 255, 255, .15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, .15) 50%, rgba(255, 255, 255, .15) 75%, transparent 75%, transparent);
		background-image: linear-gradient(45deg, rgba(255, 255, 255, .15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, .15) 50%, rgba(255, 255, 255, .15) 75%, transparent 75%, transparent);
	}

	progress {
		display: inline-block;
		vertical-align: baseline;
	}

	.progress {
		-webkit-box-shadow: none !important;
		background-color: rgba(120, 130, 140, .21);
		box-shadow: none !important;
		height: 15px;
		border-radius: 3px;
		margin-bottom: 18px;
		overflow: hidden
	}

	.progress-bar {
		box-shadow: none;
		font-size: 8px;
		font-weight: 600;
		line-height: 12px
	}

	.progress.progress-sm {
		height: 8px !important
	}

	.progress.progress-sm .progress-bar {
		font-size: 8px;
		line-height: 5px
	}

	.progress.progress-md {
		height: 15px !important
	}

	.progress.progress-md .progress-bar {
		font-size: 10.8px;
		line-height: 14.4px
	}

	.progress.progress-lg {
		height: 20px !important
	}

	.progress.progress-lg .progress-bar {
		font-size: 12px;
		line-height: 20px
	}

	.progress-bar-danger {
		background-color: #6441eb
	}
</style>
<!-- Titlebar
	================================================== -->
<section class="banner_area" style="min-height: unset;">
	<div class="banner_inner d-flex align-items-center">
		<div class="overlay bg-parallax" data-stellar-ratio="0.9" data-stellar-vertical-offset="0" data-background=""
			style="transform: translateY(-37.7529px);"></div>
		<div class="container">
			<div class="banner_content text-left">
				<span style="color:#FFFFFF;display:block;margin-bottom:10px;font-size:15px">E-SAKIP Kabupaten
					Sumedang</span>
				<span
					style="color:#FFFFFF;font-size:16px;background-color:#6441EB;padding:5px 15px;border-radius:30px;margin-bottom:300px">SICERDAS
					(Sistem Perencanaan Daerah Kabupaten Sumedang)
				</span>
				<!-- <div class="page_link">
							<a href="<?php echo base_url() ?>home">Home</a>
							<a href="<?php echo base_url() ?>perencanaan_kinerja">Perencaan Kinerja</a>
						</div> -->
				<h2 style="margin-top:5px">Pencapaian Kinerja, Hayu ah Kuykeun..</h2>
			</div>
		</div>
	</div>
</section>

<!-- Content
	================================================== -->
<section class="">
	<div class="container">
		<div class="add-listing-section margin-top-45">

			<!-- Headline -->
			<div class="add-listing-headline">
				<h3><i class="sl sl-icon-book-open"></i> Pencapaian Kinerja
					<?= $tahun_ ?>
				</h3>
			</div>

			<!-- Switcher ON-OFF Content -->
			<div class="switcher-coasntent">

				<div class="row">
					<div class="col-md-12">
						<div class="white-box">
							<div class="row">
								<div class="col-md-12">
									<h3>Filter</h3>
								</div>

								<div class="col-md-3">
									<div class="form-group">
										<label>Tahun</label>
										<select class="" id="tahun" onchange="loadPagination(1)">
											<?php foreach ($this->Globalvar->get_tahun() as $key => $value) {
												$i = $key + 1;
												if ($this->input->get("tahun")) {
													$selected = ($this->input->get("tahun") == $i) ? "selected" : "";
												} else {
													$selected = (date("Y") == $value) ? "selected" : "";
												}

												echo '<option ' . $selected . ' value="' . $i . '">' . $value . '</option>';
											}
											?>
										</select>
									</div>
								</div>

								<div class="col-md-3">
									<div class="form-group">
										<label>Bulan</label>
										<select class="" id="bulan" onchange="loadPagination(1)">
											<option value="">Semua</option>
											<?php foreach ($this->Config->bulan as $key => $value) {
												$selected = ($this->input->get("bulan") == $key) ? "selected" : "";
												echo '<option ' . $selected . ' value="' . $key . '">' . $value . '</option>';
											}
											?>
										</select>
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<label>Pencarian </label>
										<input type="text" onkeyup="loadPagination(1)" placeholder="Cari Nama SKPD"
											class="form-control" name="search" id="search" />
									</div>
								</div>

							</div>

						</div>
					</div>

					<div class="col-md-12">
						<div class="white-box">
							<div class="row">
								<div class="col-md-12">
									<h3 class="text-center box-title m-b-0" id="title">LAPORAN PENCAPAIAN KINERJA SKPD
									</h3>
									<p class="text-center text-dark m-b-0">PEMERINTAH KABUPATEN SUMEDANG</p>
									<div class="table-responsive">
										<button class="btn btn-default btn-outline pull-right hidden" onclick="download()"><i
												class="fa fa-download"></i> Download</button>
										<table style="" class="table table-striped_">
											<thead>
												<tr>
													<th>No</th>
													<th>Nama SKPD</th>
													<th>Penanggung Jawab</th>
													<th>Capaian (%)</th>
												</tr>
											</thead>
											<tbody id="row-data">

											</tbody>
										</table>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-12 text-center">
									<nav class="mt-4 mb-3">
										<ul class="pagination justify-content-center mb-0" id="pagination">
										</ul>
									</nav>
								</div>
							</div>

						</div>
					</div>

				</div>
			</div>
			<!-- Switcher ON-OFF Content / End -->
		</div>
		<!-- Section / End -->
	</div>

</section>


<script type="text/javascript" defer>
	document.addEventListener("DOMContentLoaded", function (event) {
		loadPagination(1);

	/*----- BEGIN OF PAGINATION */



	if (typeof loadPagination === "function") {

		loadPagination(1);

	}



	var pagination = document.getElementById("pagination");

	if (pagination) {

		$('#pagination').on('click', 'a', function (e) {

			e.preventDefault();

			var pageno = $(this).attr('data-ci-pagination-page');

			if (typeof loadPagination === "function") {

				loadPagination(pageno);

			}

		});



	}



	if (typeof loadPagination2 === "function") {

		loadPagination2(1);

	}



	var pagination2 = document.getElementById("pagination2");

	if (pagination) {

		$('#pagination2').on('click', 'a', function (e) {

			e.preventDefault();

			var pageno = $(this).attr('data-ci-pagination-page');

			if (typeof loadPagination2 === "function") {

				loadPagination2(pageno);

			}

		});



	}







	/*----- END OF PAGINATION */
	});

	var isloading = false;

	var page = 1;

	function loadPagination(p) {
		page = p;

		if (!isloading) {
			isloading = false;
			$.ajax({
				url: "<?= base_url() ?>pencapaian_kinerja/get_list/" + page,
				type: 'post',
				dataType: 'json',
				data: {
					tahun: $("#tahun").val(),
					bulan: $("#bulan").val(),
					search: $("#search").val()
				},
				success: function (data) {
					//console.log(data);
					$("#row-data").html(data.content);
					$("#pagination").html(data.pagination);
					isloading = false;
				},
				error: function (xhr, status, error) {
					console.log(xhr.responseText);
					swal("Opps", "Terjadi kesalahan", "error");
					isloading = false;
				}
			});
		}
	}

	function download() {
		var tahun = $("#tahun").val();
		var bulan = $("#bulan").val();

		var link = "<?= base_url(); ?>pencapaian_kinerja/download?tahun=" + tahun + "&bulan=" + bulan;
		window.open(link, "_blank");
	}

	// $(document).ready(function () {
	// 	loadPagination(1);
	// });
</script>