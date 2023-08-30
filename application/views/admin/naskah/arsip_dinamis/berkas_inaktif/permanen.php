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
		<div class="col-md-12 col-sm-12 col-xs-12">
			
			
			<?php
			if (isset($messages)) {
			?>
				<div class="alert alert-<?= $type ?>"><?= $messages ?></div>
			<?php } ?>
			<div class="alert alert-primary">
				<i class="ti-alert" style="color: #fff"></i> Kolom yang bertanda (<span class="text-danger"><b>*</b></span>)
				<b>wajib</b> diisi.
			</div>

			<div class="x_panel">
				<form method='post' action="<?= base_url('arsip_dinamis/berkas_inaktif/save_permanen') ?>">
					<div class="x_content">
						<div class="panel panel-primary">
							<div class="panel-heading">Form Usulan Permanen
							</div>

							<!-- begin table -->
							<span class="border border-black">
								<div class="col-md-12">
								<div class="white-box">
									<!--table class="table" id="berkas_aktif_table"-->
									<table class="table">
									<thead>
													<tr>
														<th>#</th>
														<th width="50px">No.</th>
														<th width="100px">
															<center>Kode Klasifikasi</center>
														</th>
														<th>Nama Berkas</th>
														<th>Kurun Waktu</th>
														<th>Jumlah Item</th>
														<th>Akhir Retensi Aktif</th>                            
														<th>Penyusutan Akhir</th>
													</tr>
									</thead>
									<tbody id="row-data">
													<?php if (!empty($files)) {
														$no = 1;
														foreach ($files as $file) { ?>
															<tr>
																<td><input type="checkbox" name="idberkas[]" value="<?= $file->id_surat_berkas; ?>"></td>
																<td><?= $no++; ?></td>
																<td><?= $file->id_surat_klasifikasi->kode_gabungan; ?></td>
																<td><?= $file->nama_berkas; ?></td>
																<td><?= $file->id_surat_klasifikasi->kurun_waktu; ?></td>
																<td>0</td>
																<td><?= $file->id_surat_klasifikasi->akhir_retensi_aktif; ?></td>
																<td><?= $file->id_surat_klasifikasi->penyusutan_akhir; ?></td>
															</tr>
													<?php }
													} ?>
									</tbody>

									</table>
								</div>    
								</div>
							</span>
							<!-- end table -->


						</div>
						<div class="pull-right">
							<a href='<?= base_url("arsip_dinamis/berkas_inaktif"); ?>' class='btn btn-default'>Back</a>
							<button type='submit' class='btn btn-primary'>Submit</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

