
<div class="container-fluid">

	<div class="row bg-title">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title">Catatan</h4> </div>
			<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
				<ol class="breadcrumb">
					<li class="active">Catatan</li>				</ol>
				</div>
				<!-- /.col-lg-12 -->
			</div>


			<div class="row">
            <div class="col-sm-12">
                <div class="white-box" style="border-top: 5px solid #6003c8;">
									<div class="panel panel-primary">
										<div class="panel-heading text-center">
											EDIT PENGUMUMAN
										</div>
									</div>
                    <form method="post">
											<input type="hidden" name="id_pegawai" value="<?php echo $pengumuman->id_pegawai; ?> ">
											<input type="hidden" name="id_skpd" value="<?php echo $pengumuman->id_skpd; ?> ">
											<div class="form-group">
												<label for="">Nama Pengumuman</label>
												<input type="text" name="nama_pengumuman" class="form-control" maxlength="50" placeholder="Nama Pengumuman" value="<?=$pengumuman->nama?>">
											</div>
                        <div class="form-group">
													<label for="">Isi Pengumuman</label>
                            <textarea class="form-control" name="isi_pengumuman" value="" rows="3" maxlength="200" placeholder="Isi Pengumuman ..."><?php echo $pengumuman->isi?> </textarea>
                        </div>
												<div class="form-group">
													<label for="">Periode Tayang</label>
													<div class="input-daterange input-group" id="datepicker">
																	<input type="text" class="form-control" name="periode_awal" placeholder="Awal" value="<?=$pengumuman->periode_awal?>" />
																	<span class="input-group-addon bg-primary b-0 text-white">Sampai</span>
																	<input type="text" class="form-control" name="periode_akhir" placeholder="Akhir" value="<?=$pengumuman->periode_akhir?>" />
													</div>
												</div>
												<button type="submit" name="update" class="btn btn-primary" style="width:100px;">Update</button>
                    </form>
                </div>
            </div>
        </div>
