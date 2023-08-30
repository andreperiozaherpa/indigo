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
			<h4 class="page-title">Data Usulan Pensiun</h4> </div>
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
							<div class="col-md-3">
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


		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">

				<div class="x_content">

					<?php
					$CI =& get_instance();
					foreach ($list as $l){
						?>
						<div class="col-md-12">
							<div class="white-box">
								<div class="row">
									<div class="col-md-2">
										<div class="row lihat" style="background-color: #22a7f0;padding: 5px;border-radius: 2px;margin-bottom: 10px;">
											<div class="col-md-12 gambar" style="padding: 20px;text-align: center;">
												<img src="<?=base_url('data/foto/pegawai/'.$l->foto_pegawai.'')?>" class="img-circle img-responsive img-center">
											</div>
											<div class="col-md-12" style="margin-top:25px;text-align: center;">
												<h3 class="box-title m-b-0 text-white text-truncate" style="overflow: hidden; white-space: nowrap;text-overflow: ellipsis;"><?=$l->nama_lengkap?></h3> <small class="text-white"><?=$l->nip?></small>
											</div>
										</div>
									</div>
									<div class="col-md-4" style="margin-left: -10px;">
										<div style="height: 260px;display: table-cell;vertical-align: middle;text-align: left !important;width: 999px;background-color: #dce7ed;padding-left: 10px">
											<span class="text-primary" style="font-size:12px;font-weight: 500">SKPD</span>
											<p><?=$l->nama_skpd?></p>
											<span class="text-primary" style="font-size:12px;font-weight: 500">Unit Kerja</span>
											<p><?=$l->nama_unit_kerja?></p>
											<span class="text-primary" style="font-size:12px;font-weight: 500">Jabatan</span>
											<p><?=$l->nama_jabatan?></p>
										</div>
									</div>
									<div class="col-md-6">
										<div  style="height: 260px;display: table-cell;vertical-align: middle;width: 999px">
											<div class="usulan-div">
												<div class="text-white" style="display:inline-block;width:130px;font-size:12px;font-weight: 500;background-color: #22A7F0;padding: 5px;text-align: center;">Tanggal Pensiun</div><span style="font-weight: 300;margin-left: 10px"><?= !empty($l->prediksi_pensiun) ? tanggal($l->prediksi_pensiun) : '<span style="font-size:10px">Tanggal lahir belum di set</span>'?></span>
											</div>
											<div class="usulan-div">
												<div class="text-white" style="display:inline-block;width:130px;font-size:12px;font-weight: 500;background-color: #22A7F0;padding: 5px;text-align: center;">Tanggal Usulan</div><span style="font-weight: 300;margin-left: 10px"><?=tanggal($l->tgl_usulan)?></span>
											</div>
											<div class="usulan-div">
												<div class="text-white" style="display:inline-block;width:130px;font-size:12px;font-weight: 500;background-color: #22A7F0;padding: 5px;text-align: center;">Alasan Pensiun</div><span style="font-weight: 300;margin-left: 10px"><?=$l->perihal?></span>
											</div>
											<div class="usulan-div">
												<div class="text-white" style="display:inline-block;width:130px;font-size:12px;font-weight: 500;background-color: #22A7F0;padding: 5px;text-align: center;">Status Usulan</div><span style="font-weight: 300;margin-left: 10px"><?=status_usulan($l->status_usulan)?></span>
											</div>
											<a href="<?=base_url('usulan_pensiun/view/'.$l->id_usulan)?>" class="fcbtn btn btn-outline btn-primary btn-1c btn-block"><i class="ti-arrow-circle-right"></i> Detail Usulan</a>
										</div>
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
