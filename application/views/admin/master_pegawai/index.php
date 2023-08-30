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
					<?php
					if ($user_level == 'Administrator' || in_array('op_kepegawaian', explode(";", $this->session->userdata('user_privileges')))) { ?>
						<div class="col-md-3 b-r">
							<a href="<?php echo base_url() . "master_pegawai/add"; ?>">
								<button class="btn btn-primary m-t-15 btn-block">Tambah Pegawai</button>
							</a>
						</div>
					<?php } ?>
					<form method="POST">
						<div class="col-md-2">
							<div class="form-group">
								<label>Nama Lengkap</label>
								<input type="text" class="form-control" placeholder="Cari berdasarkan Nama Lengkap" name="nama_lengkap" value="<?= ($filter) ? $filter_data['nama_lengkap'] : '' ?>">
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<label>NIP</label>
								<input type="text" class="form-control" placeholder="Cari berdasarkan NIP" name="nip" value="<?= ($filter) ? $filter_data['nip'] : '' ?>">
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

					<div class="col-md-4 col-sm-6" style="position:relative">
							<?php
							if ($l->pensiun == 1) {
							?>
								<div style="color:#fff;text-align:center;padding:5px;position:absolute;width:97.2%;z-index:999;background-color:#f8c25599!important">PENSIUN</div>
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
									<br>
									<h3 class="box-title m-b-0"><?= $l->nama_lengkap; ?></h3>
									<?php
									if ($cek_user) {
									?>

										<span class="badge badge-success"><i class="ti-user"></i> User Terdaftar</span>
									<?php
									} else { ?>

										<span class="badge badge-info"><i class="ti-info"></i> User Tidak Terdaftar</span>
									<?php

									}
									?>
								</div>
								<div class="col-md-12">
									<div style="display: table;" class="row b-t m-t-10 m-b-10">
										<div style="display: table-row;" class="col-md-6 b-r text-center">
											<div style="display: table-cell;width:1200px;text-align:center;vertical-align:middle;height: 150px;"><span><?= $l->nama_skpd ?></span></div>
											<small style="color:#6003c8;display: block;font-weight: 500"><i data-icon="&#xe030;" class="linea-icon linea-aerrow"></i> SKPD</small>
										</div>
										<div style="display: table-row;" class="col-md-6 b-r text-center">
											<?php if ($l->kepala_skpd !== "Y") : ?>
												<div style="display: table-cell;width:1200px;text-align:center;vertical-align:middle;height: 150px;"><span><?= $l->nama_unit_kerja ?></span></div>
												<small style="color:#6003c8;display: block;font-weight: 500"><i class="ti-briefcase"></i> Unit Kerja</small>
											<?php else : ?>
												<div style="display: table-cell;width:1200px;text-align:center;vertical-align:middle;height: 150px;"><span class="well well-sm"><i class="fa fa-check-circle text-primary"></i> Kepala SKPD</span></div>
											<?php endif ?>
										</div>
									</div>

									<a href="<?php echo base_url() . "master_pegawai/view/" . $l->id_pegawai; ?>">
										<button class="fcbtn btn-block btn btn-primary btn-outline btn-1b btn-block">Detail Profil</button>
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

<script type="text/javascript">
	function delete_(id) {
		$('#confirm_title').html('Konfirmasi');
		$('#confirm_content').html('Apakah anda yakin akan menghapus data pegawai?');
		$('#confirm_btn').html('Hapus');
		$('#confirm_btn').attr('href', "<?php echo base_url(); ?>master_pegawai/delete/" + id);
	}
</script>