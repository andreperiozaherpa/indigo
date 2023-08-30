
<div class="container-fluid">

	<div class="row bg-title">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title">Laporan Rapat</h4> </div>
			<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
				<ol class="breadcrumb">
					<?php echo breadcrumb($this->uri->segment_array()); ?>
				</ol>
				</div>
				<!-- /.col-lg-12 -->
			</div>


			<div class="row">
            <div class="col-sm-12">
                <div class="white-box" style="border-top: 5px solid #6003c8;">
									<div class="panel panel-primary">
										<div class="panel-heading text-center">
											EDIT LAPORAN RAPAT
										</div>
									</div>
									<form method="post" enctype="multipart/form-data">
										<input type="hidden" name="id_pegawai" value="<?=$id_pegawai?>">
										<input type="hidden" name="id_skpd" value="<?=$id_skpd?>">
										<div class="form-group">
											<label for="">Nama Laporan Rapat</label>
											<input type="text" class="form-control" name="nama" value="<?=$laporan_rapat->nama_laporan?>" placeholder="Nama Laporan Rapat">
										</div>
											<div class="form-group">
												<label for="">Isi Rapat</label>
													<textarea  name="isi" class="textarea_editor form-control" rows="15" maxlength="200" placeholder="Isi Rapat ..."><?=$laporan_rapat->isi_laporan?></textarea>
											</div>
											<div class="form-group">
												<label for="">Tanggal Rapat</label>
												<div class="input-group">
													<input type="text" name="tanggal" class="form-control mydatepicker" value="<?=$laporan_rapat->tanggal_laporan?>" placeholder="mm-dd-yyyy">
													<span class="input-group-addon"><i class="icon-calender"></i></span> </div>
											</div>
											<div class="form-group">
												<label for="">Lokasi Rapat</label>
												<textarea name="lokasi" class="form-control" rows="3" cols="80" placeholder="Lokasi Rapat"><?=$laporan_rapat->lokasi_rapat?></textarea>
											</div>
											<div class="form-group">
												<label for="">File Laporan</label>
												<?php if ($laporan_rapat->file_laporan == 'default'): ?>
													<input type="file" id="file_" class="form-control" name="file_laporan">
												<?php else: ?>
													<br>
													<a href="<?=base_url('data/laporan_rapat/'.$id_pegawai.'/'.$laporan_rapat->file_laporan)?>" id="files_laporan_rapat_old"><?=$laporan_rapat->file_laporan?> </a>
													<label id="files_laporan_rapat_new"></label>
													<sup><label for="files_laporan_rapat" style="cursor:pointer;font-size:11px" data-toggle="tooltip" title="Ubah"><i class="fa fa-refresh" ></i></label></sup>
											  	<input id="files_laporan_rapat" style="display: none;" type="file" name="file_laporan">
												<?php endif; ?>
												<input type="hidden" name="file_lama" value="<?=$laporan_rapat->file_laporan?>">
											</div>
											<div class="form-group">
												<label for="">Penerima Laporan</label>
												<select class="form-control" name="id_penerima">
													<option value="<?=$laporan_rapat->id_pegawai_verifikasi?>"><?=$laporan_rapat->nama_lengkap?></option>
													<?php foreach ($penerima as $pm): ?>
													<option value="<?=$pm->id_pegawai?>"><?=$pm->nama_lengkap?></option>
													<?php endforeach; ?>
												</select>
											</div>
											<button type="submit" name="update" class="btn btn-primary" style="width:100px;">Update</button>
									</form>
                </div>
            </div>
        </div>
