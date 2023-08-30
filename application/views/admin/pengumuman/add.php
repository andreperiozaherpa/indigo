
<div class="container-fluid">

	<div class="row bg-title">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title">Pengumuman</h4> </div>
			<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
				<ol class="breadcrumb">
					<li class="active">Pengumuman</li>				</ol>
				</div>
				<!-- /.col-lg-12 -->
			</div>


			<div class="row">
				<div class="col-sm-12">
					<div class="white-box" style="border-top: 5px solid #6003c8;">
						<div class="panel panel-primary">
							<div class="panel-heading text-center">
								TAMBAH PENGUMUMAN
							</div>
						</div>
						<?php 
						if(isset($message)){
							?>
							<div class="alert alert-<?=$type?>"><?=$message?></div>
							<?php
						}
						?>
						<form method="post">
							<input type="hidden" name="id_pegawai" value="<?=$id_pegawai?> ">
							<input type="hidden" name="id_skpd" value="<?=$id_skpd?> ">
							<div class="form-group">
								<label for="">Nama Pengumuman</label>
								<input type="text" name="nama_pengumuman" class="form-control" maxlength="50" placeholder="Nama Pengumuman" value="<?=set_value('nama_pengumuman')?>">
							</div>
							<div class="form-group">
								<label for="">Isi Pengumuman</label>
								<textarea  name="isi_pengumuman" class="form-control" rows="3" maxlength="200" placeholder="Isi Pengumuman ..."><?=set_value('isi_pengumuman')?></textarea>
							</div>
							<div class="form-group">
								<label for="">Periode Tayang</label>
								<div class="input-daterange input-group" id="datepicker">
									<input type="text" class="form-control" name="periode_awal" placeholder="Awal" <?=set_value('periode_awal')?>/>
									<span class="input-group-addon bg-primary b-0 text-white">Sampai</span>
									<input type="text" class="form-control" name="periode_akhir" placeholder="Akhir" <?=set_value('periode_akhir')?>/>
								</div>
							</div>
							<?php 
								if (in_array('pengumuman', $user_privileges)){
							?>
							<div class="form-group">
								<label for="">Pengumuman Ditujukan Kepada</label>
								<select class="select2 form-control" name="id_skpd_tujuan">
									<option value="semua">Semua SKPD</option>
									<?php 
										foreach($skpd as $s){
											echo '<option value="'.$s->id_skpd.'">'.$s->nama_skpd.'</option>';
										}
									?>
								</select>
							</div>
							<?php 
								}
							?>
							<button type="submit" name="tombol_submit" class="btn btn-primary" style="width:100px;">Simpan</button>
						</form>
					</div>
				</div>
			</div>
