<div class="app-content content">
	<div class="content-overlay"></div>
	<div class="header-navbar-shadow"></div>
	<div class="content-wrapper">
		<div class="content-header row">
			<div class="content-header-left col-md-9 col-12 mb-2">
				<div class="row breadcrumbs-top">
					<div class="col-md-12">
						<h2 class="content-header-title float-left mb-0">Master Pegawai</h2>
						<div class="breadcrumb-wrapper col-12">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="#">Home</a>
								</li>
								<li class="breadcrumb-item "><a href="<?=base_url();?>simpeg">Master Pegawai</a></li>
							</ol>
						</div>
					</div>
				</div>
			</div>

		</div>
		<div class="content-body">

			<section class="page-users-view">



				<div class="row col-row-spacing">
					<!-- <div class="col-md-3">
						<a href="<?=base_url();?>simpeg/add" class="btn btn-block btn-primary waves-effect waves-light"><i class="feather icon-user-plus"></i> Tambah Pegawai</a>
					</div> -->
					<div class="col-md-12 inputselect-group">
						<form id="search-form" method="get" action="<?=base_url($this->router->fetch_class()."/cari");?>" role="form">
							<div class="form-group select-container">
								<?php //if ($this->session->userdata('level')=="Administrator"): ?>
								<select name="skpd" id="" onchange="loadPagination(1)" class="form-control select2">
									<option value="">Semua</option>
									<?php foreach ($skpd as $row): ?>
									<option value="<?=$row->id_skpd?>" <?=(@$_GET['skpd'] == $row->id_skpd)?"selected":""?> ><?=$row->nama_skpd?></option>
									<?php endforeach ?>
								</select>
								<?php //endif ?>
								<select name="" id="select-status" onchange="select_status_verifikasi();" class="form-control select2">
									<option value="0" <?=($this->router->fetch_method()=="cari")?'selected':''?>>Semua</option>
									<option value="1" <?=($this->router->fetch_method()=="cari")?'':'selected'?>>Belum Diverifikasi</option>
								</select>
							</div>
							<fieldset class="form-group position-relative has-icon-left input-divider-left">
								<div class="input-group">
									<input type="text" value="<?=@$_GET['s']?>" name="s" onkeyup="loadPagination(1)" id="search" class="round form-control" placeholder="Cari Berdasarkan Nama atau Nomor Kartu Identitas">
									<div class="form-control-position">
										<i class="feather icon-user"></i>
									</div>
									<div class="input-group-append" id="button-addon2">
										<button type="submit" class="btn btn-primary round waves-effect waves-light"><i class="feather icon-search"></i></button>
									</div>
								</div>
							</fieldset>
						</form>


						<a href="<?=base_url();?>simpeg" class="filter-btn">Reset Filter</a>

					</div>
				</div>

				<div class="row match-height mt-1" id="row-content">
					<?php foreach ($master_pegawai as $row): 
						switch ($row->id_kartu_identitas) {
							case 1:
							$no_kartu_identitas = "KTP : {$row->no_ktp}";
							break;
							case 2:
							$no_kartu_identitas = "Paspor : {$row->no_paspor}";
							break;
							case 3:
							$no_kartu_identitas = "SIM : {$row->no_sim}";
							break;
						}
						if ($row->pns == "Y") {
							$no_kartu_identitas = "NIP : {$row->nip_pns}";
						}
						?>

						<div class="col-xl-4 col-md-6 col-sm-12 profile-card-1">
							<div class="card with-dropdown" style="">
								<div class="btn-group mb-1 card-dropdown">
									<div class="dropdown">
										<button class="btn rounded-circle btn-primary mr-1" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i style="margin-right:0px" class="feather icon-more-horizontal"></i>
										</button>
										<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
											<a class="dropdown-item" href="<?=base_url();?>simpegedit/6"><i class="feather icon-edit"></i> Edit</a>
											<a class="dropdown-item" href="javascript:void(0)" onclick="hapus(6)"><i class="feather icon-trash"></i> Hapus</a>
										</div>
									</div>
								</div>

								<a href="<?=base_url('simpeg/detail/'.$row->id_orang);?>">
									<div class="card-content">
										<div class="media user-list">
											<img class="align-self-center mr-2 user-img" src="<?=get_foto_pegawai_by_nip($row->nip_pns);?>" alt="">
											<div class="media-body">
												<h5 class="mt-0 mb-0 font-weight-bold"><?=$row->nama_lengkap?></h5>
												<span class="user-role text-primary"><?=$no_kartu_identitas?></span>
												<hr style="border-top: 1px solid rgb(0 0 0 / 15%);">
												<?php if ($row->pns == "Y"): ?>
													<p class="mb-0 mt-0"><i class="feather icon-mail"></i> <?=$row->email?> <button type="button" class="btn btn-outline-primary btn-sm pull-right"><?=($row->status_cpns_pns == "P"? "PNS" : "CPNS")?></button></p>
													<?php else: ?>
														<p class="mb-0 mt-0"><button type="button" class="btn btn-outline-primary btn-sm pull-right">Masyarakat</button></p>
													<?php endif ?>
												</div>
											</div>
										</div>
									</a>

								</div>
							</div>

						<?php endforeach ?>

					</div>

					<div class="row">
						<div class="col-12 list">
							<?=$this->pagination->create_links();?>
						</div>
					</div>


				</section></div>

				<!-- page users view end -->




			</div>
		</div>

		<script type="text/javascript">
			select_status_verifikasi();
			
			function select_status_verifikasi() {
				var selected = $('#select-status').val();
				if (selected == 0) {
					$('#search-form').attr("action","<?=base_url($this->router->fetch_class()."/cari");?>");
				} else if (selected == 1) {
					$('#search-form').attr("action","<?=base_url($this->router->fetch_class()."/index");?>");
				}
			}
		</script>