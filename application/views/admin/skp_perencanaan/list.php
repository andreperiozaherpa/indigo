<div class="container-fluid">

	<div class="row bg-title">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title">Master Pegawai</h4>
		</div>
		<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
			<ol class="breadcrumb">
				<?php echo breadcrumb($this->uri->segment_array()); ?>
			</ol>
		</div>
		<!-- /.col-lg-12 -->
	</div>


	<div class="row">
		<div class="col-md-12">
			<div class="white-box">
				<div class="row">
					<form method="GET">
						<div class="col-md-2">
							<div class="form-group">
								<label>Nama Lengkap</label>
								<input type="text" class="form-control" placeholder="Cari berdasarkan Nama Lengkap" name="nama_lengkap" value="<?= ($filter) ? @$filter_data['nama_lengkap'] : '' ?>">
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<label>NIP</label>
								<input type="text" class="form-control" placeholder="Cari berdasarkan NIP" name="nip" value="<?= ($filter) ? @$filter_data['nip'] : '' ?>">
							</div>
						</div>
						<?php

						if ($user_level == 'Administrator' || in_array('op_kepegawaian', explode(";", $this->session->userdata('user_privileges'))) || $this->session->userdata('id_skpd') == 5) { ?>
							<div class="col-md-3">
								<div class="form-group">
									<label for="exampleInputEmail1">SKPD</label>
									<select name="id_skpd" class="form-control select2">
										<option value="">Pilih SKPD</option>
										<?php
										foreach ($skpd as $s) {
											if ($filter) {
												if ($filter_data['id_skpd'] == $s->id_skpd) {
													$selected = ' selected';
												} else {
													$selected = '';
												}
											} else {
												$selected = '';
											}
											echo '<option value="' . $s->id_skpd . '"' . $selected . '>' . $s->nama_skpd . '</option>';
										}
										?>
									</select>
								</div>
							</div>
						<?php } ?>
						<div class="col-md-2">
							<div class="form-group">
								<br>
								<button type="submit" class="btn btn-primary m-t-5 btn-outline"><i class="ti-filter"></i>Filter</button>
								<?php
								if ($filter) {
								?>
									<a href="" class="btn btn-default m-t-5"><i class="ti-back-left"></i> Reset</a>
								<?php
								}
								?>
							</div>
						</div>

					</form>
				</div>

			</div>
		</div>

	</div>


	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">

			<div class="x_content">

				<?php
				$CI = &get_instance();
				foreach ($list as $l) {
					$CI->load->model('pegawai_model');
					$cek_user = $CI->pegawai_model->cek_user($l->id_pegawai);
				?>

					<div class="col-md-4 col-sm-6">
						<?php
						if ($l->pensiun == 1) {
						?>
							<div style="color:#fff;text-align:center;padding:5px" class="bg-warning">PENSIUN</div>
						<?php
						}
						?>
						<div class="white-box">
							<div class="row">
								<div class="col-md-4 col-sm-4 text-center">

									<img src="<?= base_url('data/foto/pegawai/' . $l->foto_pegawai . '') ?>" alt="user" style=" object-fit: cover;

  width: 80px;
  height: 80px;border-radius: 50%;
  ">
								</div>
								<div class="col-md-8 col-sm-8" style="height:120px">
									<h3 class="box-title m-b-0"><?= $l->nama_lengkap; ?></h3>
									<div style="display: table;" class="row b-t m-t-10 m-b-10">
										<span>Capaian <b class="pull-right" style="color: #6003c8">100%</b></span>
										<div class="progress m-b-0">
			                                <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:100%;"> <span class="sr-only">100% Complete</span> </div>
			                            </div>
										<div style="display: table-row;" class="col-md-6 b-r b-l text-center">
											<div style="display: table-cell;width:1200px;text-align:center;vertical-align:middle;height: 100%;"><span>Perencanaan</span></div>
											<small style="color:#6003c8;display: block;font-weight: 500"> 60</small>
										</div>
										<div style="display: table-row;" class="col-md-6 b-r text-center">
											<div style="display: table-cell;width:1200px;text-align:center;vertical-align:middle;height: 100%;"><span>Realisasi</span></div>
											<small style="color:#6003c8;display: block;font-weight: 500"> 60<small class="text-dark">/<small>60</small></small></small>
										</div>
									</div>
								</div>
								<div class="col-md-12">

									<a href="<?php echo base_url() . "skp_perencanaan/pegawai/" . $l->id_pegawai; ?>">
										<button class="fcbtn btn-block btn btn-primary btn-outline btn-1b btn-block">Detail SKP</button>
									</a>
								</div>
							</div>
						</div>
					</div>
				<?php } ?>
				<!-- /.col -->
			</div>

			<div class="row">
				<div class="col-md-12 pager">
					<?php
					if (!$filter) {
						echo make_pagination($pages, $current);
					}
					?>
				</div>
			</div>

		</div>

	</div>
</div>
