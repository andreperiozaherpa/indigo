<style type="text/css">
	.lihat .gambar{
		width: 50px;
		height: 50px;
	}

	.lihat img {
		width: 100%;
		height: 100%;
		object-fit: cover;
	}
</style>
<div class="container-fluid">

	<div class="row bg-title">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title">Daftar Pegawai yang Akan Pensiun</h4> </div>
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
								<div class="col-md-3">
									<div class="form-group">
										<label>Nama Lengkap</label>
										<input type="text" class="form-control" placeholder="Cari berdasarkan Nama Lengkap" name="nama_lengkap" value="<?=($filter) ? $filter_data['nama_lengkap'] : ''?>">
									</div>
								</div>
								
							<?php if($user_level=='Administrator'){ ?>
								<div class="col-md-3">
									<div class="form-group">
										<label for="exampleInputEmail1">SKPD</label>
										<select name="id_skpd" class="form-control select2">
											<option value="">Semua SKPD</option>
											<?php
											foreach($skpd as $s){
												if($filter){
													if($filter_data['id_skpd']==$s->id_skpd){
														$selected = ' selected';
														$filter_data['nama_skpd'] = $s->nama_skpd;
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
							<?php } ?>
								<div class="col-md-4">
									<div class="form-group">
										<label for="exampleInputEmail1">Pensiun Pada</label>
										<div class="row">
											<div class="col-md-6">
												<select name="bulan" class="form-control select2">
													<option value="">Semua Bulan</option>
													<?php
													for($bulan=1;$bulan<=12;$bulan++){
														if($filter){
															if($filter_data['bulan']==$bulan){
																$selected = ' selected';
															}else{
																$selected = '';
															}
														}else{
															$selected = '';
														}
														echo'<option value="'.$bulan.'"'.$selected.'>'.bulan($bulan).'</option>';
													}
													?>
												</select>
											</div>
											<div class="col-md-6">
												<select name="tahun" class="form-control select2">
													<option value="">Semua Tahun</option>
													<?php
													for($tahun=date('Y');$tahun<=(date('Y')+10);$tahun++){
														if($filter){
															if($filter_data['tahun']==$tahun){
																$selected = ' selected';
															}else{
																$selected = '';
															}
														}else{
															$selected = '';
														}
														echo'<option value="'.$tahun.'"'.$selected.'>'.$tahun.'</option>';
													}
													?>
												</select>
											</div>
										</div>
									</div>
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
						</div>

					</form>
				</div>

			</div>
		</div>

	</div>

		<div class="col-md-12 col-sm-12 col-xs-12">
			<?php 
			if(!empty($filter_data)){
				?>
				<div class="alert alert-primary">
					<i class="ti-info-alt"></i> Ditemukan <b><?=count($list)?></b> PNS yang akan pensiun <?=!empty($filter_data['tahun']) || !empty($filter_data['bulan']) ? 'pada' : ''?> <?=!empty($filter_data['bulan']) ? ' bulan <b>'.bulan($filter_data['bulan']).'</b>' : ''?> <?=!empty($filter_data['tahun']) ? ' tahun <b>'.$filter_data['tahun'].'</b>' : ''?> <?=!empty($filter_data['nama_skpd']) ? 'dalam SKPD <b>'.$filter_data['nama_skpd'].'</b>' : ''?>
				</div>
				<?php
			}
			if(empty($list)){
				?>
				<div class="alert alert-primary">
					<i class="ti-info-alt"></i> Data tidak ditemukan
				</div>
				<?php
			}
			?>
		</div>
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">

			<div class="x_content">

				<?php
				$CI =& get_instance();
				foreach ($list as $l){
					if(date('Y-m-d')>$l->prediksi_pensiun){
						$color = 'danger';
					}else{
						$color = 'primary';
					}
					?>
					<div class="col-md-4 col-sm-4">
						<div class="white-box">
							<div class="row">
								<div class="col-md-12">
									<div class="row" style="background-color: #6003c8;padding: 5px;border-radius: 2px;margin-bottom: 10px;">
										<div class="col-md-2 lihat">
											<div class="gambar">
												<img src="<?=base_url('data/foto/pegawai/'.$l->foto_pegawai.'')?>" class="img-circle img-responsive">
											</div>
										</div>
										<div class="col-md-10">
											<h3 class="box-title m-b-0 text-white text-truncate" style="overflow: hidden; white-space: nowrap;text-overflow: ellipsis;"><?=$l->nama_lengkap?></h3> <small class="text-white"><?=$l->nip?></small>
										</div>
									</div>
									<div style="height: 285px;display: table-cell;vertical-align: middle;text-align: center !important;width: 999px">
										<span class="" style="font-size:12px;font-weight: 500"><i class="text-primary ti-flag-alt-2"></i> SKPD</span>
										<p><?=$l->nama_skpd?></p>
										<span class="" style="font-size:12px;font-weight: 500"><i class="ti-briefcase text-primary"></i> Unit Kerja</span>
										<p><?=$l->nama_unit_kerja?></p>
										<span class="" style="font-size:12px;font-weight: 500"><i class="ti-pulse text-primary"></i> Jabatan</span>
										<p><?=$l->nama_jabatan?></p>
										<span class="text-primary" style="font-size:12px;font-weight: 500">Prediksi Pensiun</span>
										<p><span style="font-size: 14px;font-weight: 300" class="label label-<?=$color?>"><?= !empty($l->prediksi_pensiun) ? tanggal($l->prediksi_pensiun) : '<span style="font-size:10px">Tanggal lahir belum di set</span>'?></span></p>
									</div>
									<a href="<?=base_url('prediksi_pensiun/create/'.$l->id_pegawai)?>" class="fcbtn btn btn-outline btn-primary btn-1c btn-block"><i class="ti-pencil"></i> Buat Usulan Pensiun</a>
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
