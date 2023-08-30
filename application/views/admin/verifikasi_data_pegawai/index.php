<div class="container-fluid">

	<div class="row bg-title">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title">Verifikasi Data Pegawai</h4> </div>
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
				<form method="POST">
					<div class="col-md-10">
						<div class="col-md-4">
							<div class="form-group">
								<label>NIP</label>
										<input type="number" max-length="18" class="form-control" placeholder="Cari berdasarkan NIP" name="nip" value="<?=($filter) ? $filter_data['nip'] : ''?>">
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label>Nama Lengkap</label>
										<input type="text" class="form-control" placeholder="Cari berdasarkan Nama Lengkap" name="nama_lengkap" value="<?=($filter) ? $filter_data['nama_lengkap'] : ''?>">
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="exampleInputEmail1">SKPD</label>
								<select name="id_skpd" class="form-control select2">
									<option value="">Pilih SKPD</option>
									<?php
									foreach($skpd as $s){
										if($filter){
											if($filter_data['id_skpd']==$s->id_skpd){
												$selected = ' selected';
											}else{
												$selected = '';
											}
										}else{
											$selected = '';
										}
										echo'<option value="'.$s->id_skpd.'"'.$selected.'>'.$s->nama_skpd.'</option>';
									}
									?>
								</select>
							</div>
						</div>
						<!-- <div class="col-md-3">
							<div class="form-group">
								<label>Status Verifikasi</label>
								<select class="form-control" name="status_verifikasi">
									<option value="">Pilih</option>
									<?php
									$selected1 = "";
									$selected2 = "";
									$selected3 = "";
									if ($filter_data['status_verifikasi'] == 1){
										$selected1 = "selected";
									}elseif ($filter_data['status_verifikasi'] == 2){
										$selected2 = "selected";
									}elseif ($filter_data['status_verifikasi'] == 3){
										$selected3 = "selected";
									} ?>
									<option value="true" <?=$selected1?>>SUDAH DIVERIFIKASI</option>
									<option value="false" <?=$selected2?>>BELUM DIVERIFIKASI</option>
									<option value="process" <?=$selected3?>>PERLU TANGGAPAN</option>
								</select>
							</div>
						</div> -->
					</div>
					<div class="col-md-2">
              <div class="form-group">
                <br>
                <button type="submit" class="btn btn-primary m-t-5 btn-outline"><i class="ti-filter"></i>Filter</button>
                <?php
                if($filter){
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
<!-- <div class="row">
	<div class="col-md-12">
			<div class="white-box" style="border-left: solid 3px #6003c8">
					<div class="row" >
						<div class="col-md-2 col-sm-2 text-center b-r" >
							<i class="ti-user mt-2" style="font-size:70px;color: #6003c8"></i>
						</div>
						<div class="col-md-10 col-sm-10"  >
							<div class="row b-b">
							<div class="col-md-12 text-center" style="color: #6003c8">
								<b>STATUS VERIFIKASI</b>
							</div>
							</div>
						<div class="row">
							<div class="col-md-3 text-center b-r">
								<h3 class="box-title m-b-0"><?=$total_pegawai;?></h3>
								<a style="color: #6003c8" href="https://e-office.sumedangkab.go.id/verifikasi_data_pegawai/index/">Total Pegawai</a>
							</div>
							<div class="col-md-3 text-center b-r">
								<h3 class="box-title m-b-0"><?=$total_pegawai_true;?></h3>
								<a style="color: #6003c8" href="https://e-office.sumedangkab.go.id/verifikasi_data_pegawai/index/status_verifikasi_data/true">Sudah Diverifikasi</a>
							</div>
							<div class="col-md-3 text-center b-r ">
								<h3 class="box-title m-b-0"><?=$total_pegawai_false;?></h3>
								<a style="color: #6003c8" href="https://e-office.sumedangkab.go.id/verifikasi_data_pegawai/index/status_verifikasi_data/false">Belum Diverifikasi</a>
							</div>
							<div class="col-md-3 text-center b-r ">
								<h3 class="box-title m-b-0"><?=$total_pegawai_process;?></h3>
								<a style="color: #6003c8" href="https://e-office.sumedangkab.go.id/verifikasi_data_pegawai/index/status_verifikasi_data/process">Perlu Tanggapan</a>
							</div>
						</div>
						</div>
					</div>
				</div>
			</div>
		 <br>
			<br>
			<br> 
</div> -->

<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<?php
		$color = "";
		$color_code = "";
		$icon = "";
		$status = "";
		foreach ($list as $l) {
			$id_pegawai = $l->id_pegawai;
			//data riwayat
			$data_pangkat = $this->pegawai_model->get_riwayat_pangkat_by_id($id_pegawai);
			$data_jabatan = $this->pegawai_model->get_riwayat_jabatan_by_id($id_pegawai);
			$data_pendidikan = $this->pegawai_model->get_riwayat_pendidikan_by_id($id_pegawai);
			$data_diklat = $this->pegawai_model->get_riwayat_diklat_by_id($id_pegawai);
			$data_penataran = $this->pegawai_model->get_riwayat_penataran($id_pegawai);
			$data_seminar = $this->pegawai_model->get_riwayat_seminar($id_pegawai);
			$data_kursus = $this->pegawai_model->get_riwayat_kursus($id_pegawai);
			$data_unit_kerja = $this->pegawai_model->get_riwayat_unit_kerja_by_id($id_pegawai);
			$data_penghargaan = $this->pegawai_model->get_riwayat_penghargaan_by_id($id_pegawai);
			$data_penugasan = $this->pegawai_model->get_riwayat_penugasan($id_pegawai);
			$data_cuti = $this->pegawai_model->get_riwayat_cuti($id_pegawai);
			$data_hukuman = $this->pegawai_model->get_riwayat_hukuman($id_pegawai);
			$pendidikan_last = $this->pegawai_model->get_riwayat_pendidikan($id_pegawai,1);
			$pangkat_last = $this->pegawai_model->get_riwayat_pangkat($id_pegawai,1);
			$jabatan_last = $this->pegawai_model->get_riwayat_jabatan($id_pegawai,1);
			$unit_kerja_last = $this->pegawai_model->get_riwayat_unit_kerja($id_pegawai,1);
			$data_bahasa= $this->pegawai_model->get_riwayat_bahasa($id_pegawai);
			$data_bahasa_asing= $this->pegawai_model->get_riwayat_bahasa_asing($id_pegawai);
			$data_pernikahan = $this->pegawai_model->get_riwayat_pernikahan($id_pegawai);
			$data_anak = $this->pegawai_model->get_riwayat_anak($id_pegawai);
			$data_orangtua = $this->pegawai_model->get_riwayat_orangtua($id_pegawai);
			$data_mertua = $this->pegawai_model->get_riwayat_mertua($id_pegawai);
			$jumlah_riwayat = count($data_pangkat) + count($data_jabatan) + count($data_pendidikan) + count($data_diklat) + count($data_penataran) + count($data_seminar) + count($data_kursus) + count($data_unit_kerja) + count($data_penghargaan) + count($data_penugasan) + count($data_cuti) + count($data_hukuman) + count($data_bahasa) + count($data_bahasa_asing) + count($data_pernikahan) + count($data_anak) + count($data_orangtua) + count($data_mertua);
			//data verif riwayat
			$data_verif_pangkat = $this->pegawai_model->get_verif_bkd_riwayat_pangkat_by_id($id_pegawai);
			$data_verif_jabatan = $this->pegawai_model->get_verif_bkd_riwayat_jabatan_by_id($id_pegawai);
			$data_verif_pendidikan = $this->pegawai_model->get_verif_bkd_riwayat_pendidikan_by_id($id_pegawai);
			$data_verif_diklat = $this->pegawai_model->get_verif_bkd_riwayat_diklat_by_id($id_pegawai);
			$data_verif_penataran = $this->pegawai_model->get_verif_bkd_riwayat_penataran($id_pegawai);
			$data_verif_seminar = $this->pegawai_model->get_verif_bkd_riwayat_seminar($id_pegawai);
			$data_verif_kursus = $this->pegawai_model->get_verif_bkd_riwayat_kursus($id_pegawai);
			$data_verif_unit_kerja = $this->pegawai_model->get_verif_bkd_riwayat_unit_kerja_by_id($id_pegawai);
			$data_verif_penghargaan = $this->pegawai_model->get_verif_bkd_riwayat_penghargaan_by_id($id_pegawai);
			$data_verif_penugasan = $this->pegawai_model->get_verif_bkd_riwayat_penugasan($id_pegawai);
			$data_verif_cuti = $this->pegawai_model->get_verif_bkd_riwayat_cuti($id_pegawai);
			$data_verif_hukuman = $this->pegawai_model->get_verif_bkd_riwayat_hukuman($id_pegawai);
			$data_verif_bahasa= $this->pegawai_model->get_verif_bkd_riwayat_bahasa($id_pegawai);
			$data_verif_bahasa_asing= $this->pegawai_model->get_verif_bkd_riwayat_bahasa_asing($id_pegawai);
			$data_verif_pernikahan = $this->pegawai_model->get_verif_bkd_riwayat_pernikahan($id_pegawai);
			$data_verif_anak = $this->pegawai_model->get_verif_bkd_riwayat_anak($id_pegawai);
			$data_verif_orangtua = $this->pegawai_model->get_verif_bkd_riwayat_orangtua($id_pegawai);
			$data_verif_mertua = $this->pegawai_model->get_verif_bkd_riwayat_mertua($id_pegawai);
			$jumlah_verif_riwayat = count($data_verif_pangkat) + count($data_verif_jabatan) + count($data_verif_pendidikan) + count($data_verif_diklat) + count($data_verif_penataran) + count($data_verif_seminar) + count($data_verif_kursus) + count($data_verif_unit_kerja) + count($data_verif_penghargaan) + count($data_verif_penugasan) + count($data_verif_cuti) + count($data_verif_hukuman) + count($data_verif_bahasa) + count($data_verif_bahasa_asing) + count($data_verif_pernikahan) + count($data_verif_anak) + count($data_verif_orangtua) + count($data_verif_mertua);

			if ($jumlah_verif_riwayat == $jumlah_riwayat) {
				if ($l->status_verifikasi_data !== "true") {
					$this->dm->update_status_data_true($id_pegawai);
				}
			}elseif ($jumlah_verif_riwayat > 0 && $jumlah_verif_riwayat < $jumlah_riwayat){
				if ($l->status_verifikasi_data !== "process") {
					$this->dm->update_status_data_process($id_pegawai);
				}
			}else{
				if ($l->status_verifikasi_data !== "false") {
					$this->dm->update_status_data_false($id_pegawai);
				}
			}
			if ($l->status_verifikasi_data == "true") {
				$color = "primary";
				$color_code = "#6003c8";
				$icon = "icon-user-following";
				$status = "SUDAH DIVERIFIKASI";
			}elseif($l->status_verifikasi_data == "process"){
				$color = "success";
				$color_code = "#00c292";
				$icon = "icon-user-follow";
				$status = "PERLU TANGGAPAN";
			}else{
				$color = "danger";
				$color_code = "#F75B36";
				$icon = "icon-user-unfollow";
				$status = "BELUM DIVERIFIKASI";
			}
			?>
			<div class="col-md-4 col-sm-6">
				<div class="verify-data-status <?=$color?>">
				<i class="<?=$icon?>"></i> <?=$status?>
				</div>
				<div class="white-box" style="height:300px;width:auto;">
					<div class="row b-b" style="height:120px;">
						<div class="col-md-4 col-xs-4 b-r text-center" style="height:120px;">
							<br>
							<img src="<?=base_url('data/foto/pegawai/'.$l->foto_pegawai.'')?>" alt="user" style=" object-fit: cover;
				  width: 80px;
				  height: 80px;border-radius: 50%;
				  ">
						</div>
						<div class="col-md-8  col-xs-8">
							<br>
							<h5><b><?=$l->nama_lengkap?></b></h5>
							<h5><small><?=$l->nip?></small></h5>
						</div>
					</div>
					<div class="row b-b" style="height:85px;">
						<div class="text-center">
							<br>
							<b><i class="fa fa-users"></i> SKPD</b>
							<br>
							<small><?=$l->nama_skpd?></small>
						</div>
					</div>
					<div class="row">
						<br>
						<a href="https://e-office.sumedangkab.go.id/verifikasi_data_pegawai/details_kepegawaian/<?=$l->id_pegawai?>">
							<button class="fcbtn btn-block btn btn-<?=$color?> btn-outline btn-1b btn-block">Detail Pegawai</button>
						</a>
					</div>
				</div>
			</div>
		<?php } ?>
	</div>
</div>


<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">

					<div class="row">
						<div class="col-md-12 pager">
							<?php
							if(!$filter){
								echo make_pagination($pages,$current);
							}
							?>
						</div>
					</div>

		</div>

	</div>
</div>

<script type="text/javascript">
	function delete_(id)
	{
		$('#confirm_title').html('Konfirmasi');
		$('#confirm_content').html('Apakah anda yakin akan menghapus data pegawai?');
		$('#confirm_btn').html('Hapus');
		$('#confirm_btn').attr('href',"<?php echo base_url();?>master_pegawai/delete/"+id);
	}

</script>
