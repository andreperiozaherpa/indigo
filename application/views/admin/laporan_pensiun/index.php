<style type="text/css">
	.lihat{
		height: 260px !important;
	}
	.lihat .gambar{
		width: 100%;
		height: 130px;
	}

	.lihat img {
		width: 130px;
		height: 130px;
		object-fit: cover;
	}
	.usulan-div{
		margin-bottom: 10px;
		display: block;
	}
	.img-center{
		display: block;
		margin: 0 auto;
	}
</style>
<div class="container-fluid">

	<div class="row bg-title">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title">Laporan Hasil Usulan Pensiun</h4> </div>
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
							<?php if($user_level=='Administrator'){ ?>
								<div class="col-md-3">
									<div class="form-group">
										<label>Nama Lengkap</label>
										<input type="text" class="form-control" placeholder="Cari berdasarkan Nama Lengkap" name="nama_lengkap" value="<?=($filter) ? $filter_data['nama_lengkap'] : ''?>">
									</div>
								</div>
								<div class="col-md-3">
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
							<?php } ?>
							<div class="col-md-3 b-r">
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
							<div class="col-md-3">
									<br>
									<?php 
										if(!empty($filter_data['id_skpd'])){
											$i_skpd = "/".$filter_data['id_skpd'];
										}else{
											$i_skpd = '';
										}
									?>
									<a href="<?=base_url('laporan_pensiun/export').$i_skpd?>" class="btn btn-success m-t-5 pull-right"><i class="ti-download"></i> Download Usulan yang Diterima</a>
							</div>

						</form>
					</div>

				</div>
			</div>

		</div>


		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">

				<div class="x_content">
					<div class="white-box">
						<div class="table-responsive">
							<table class="table">
								<thead style="background-color: #22A7F0">
									<tr>
										<th style="color: #fff">#</th>
										<th style="color: #fff">NIP</th>
										<th style="color: #fff">Nama</th>
										<th style="color: #fff">Jabatan</th>
										<th style="color: #fff">Perihal</th>
										<th style="color: #fff">Tanggal Usulan</th>
										<th style="color: #fff">Tanggal Pensiun</th>
										<th style="color: #fff">Status Usulan</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$CI =& get_instance();
									$n=1;
									foreach ($list as $l){
										$tgl_lahir = $l->tgllahir;
										$jenis_jabatan = $l->jenis_jabatan;
										if($jenis_jabatan=="Struktural"){
											$masa_kerja = 58;
										}else{
											$masa_kerja = 60;
										}
										$pensiun = date('Y-m-d', strtotime('+'.$masa_kerja.' year',strtotime($tgl_lahir)));
										$pensiun = date('Y-m-d', strtotime('first day of next month',strtotime($pensiun)));
										?>

										<tr>
											<td><?=$n?></td>
											<td><?=$l->nip?></td>
											<td><?=$l->nama_lengkap?></td>
											<td><?=$l->nama_jabatan?></td>
											<td><?=$l->perihal?></td>
											<td><?=tanggal($l->tgl_usulan)?></td>
											<td><?=tanggal($l->tgl_pensiun)?></td>
											<td><?=status_usulan($l->status_usulan)?> </td>
										</tr>
										<?php $n++; } ?>

									</tbody>
								</table>
							</div>
						</div>
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
