<div class="container-fluid">

	<div class="row bg-title">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title">Markonah</h4>
		</div>
		<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
			<ol class="breadcrumb">
				<li><a href="">Markonah</a></li>
				<li class="active">Tambah Ajuan Surat Kerja Luar Kantor</li>
			</ol>
		</div>
		<!-- /.col-lg-12 -->
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="white-box" style="border-top:solid 3px #6003c8">
				<h4 class="box-title" style="color:#6003c8;margin-bottom:40px">Tambah Ajuan Surat Kerja Luar Kantor</h4>

				<?php 
					if(isset($message)){
						echo '<div class="alert alert-'.$message_type.'">'.$message.'</div>';
					}
				?>

				<form class="form-hotizontal" method="POST">
					<div class="form-group">
						<label>Nama Kegiatan</label>
						<input type="text" class="form-control" value="<?=set_value('nama_kegiatan')?>" name="nama_kegiatan" placeholder="Masukkan Nama Kegiatan" required>
					</div>
					<div class="form-group">
						<label><i class="ti-location-pin"></i> Lokasi Pengerjaan</label>
						<select name="lokasi_pengerjaan" class="form-control" required>
							<option value="">Pilih Lokasi Pekerjaan</option>
							<?php
							$a_lokasi = array('luar_kantor', 'rumah');
							foreach ($a_lokasi as $a) {
								$selected = $a == set_value('lokasi_pekerjaan') ? ' selected' : '';
								echo '<option value="' . $a . '"'.$selected.'>' . normal_string($a) . '</option>';
							}
							?>
						</select>
					</div>
					<div class="form-group">
						<label>Tanggal Kegiatan</label>
						<div class="input-group">
							<input type="text" name="tanggal_awal" value="<?=set_value('tanggal_awal')?>" class="form-control" id="datepicker" placeholder="Masukkan Tanggal Awal" autocomplete="off" required>
							<div class="input-group-addon" style="background: #6003c8"><i style="color:#fff" class="ti-control-forward"></i></div>
							<input type="text" name="tanggal_akhir" value="<?=set_value('tanggal_akhir')?>" class="form-control" id="datepicker" placeholder="Masukkan Tanggal Akhir" autocomplete="off" required>
						</div>
					</div>
					<div class="form-group">
						<label>Deskripsi Kegiatan</label>
						<small>(Gambarkan dengan jelas kegiatan yang akan dilaksanakan)</small>
						<textarea class="form-control" rows="5" placeholder="Masukkan Deskripsi Kegiatan" name="deskripsi_kegiatan" required><?=set_value('deskripsi_kegiatan')?></textarea>
					</div>
					<div class="form-group">
						<label>Target Kegiatan</label>
						<small>(Diisi dengan indikator kegiatan)</small>
						<input type="text" class="form-control" value="<?=set_value('target_kegiatan')?>" name="target_kegiatan" placeholder="Masukkan Target Kegiatan" required>
					</div>
					<div class="form-group">
						<label>Verifikator Kegiatan</label>
						<small>(Atasan Langsung)</small>
						<select name="id_pegawai_verifikator_kegiatan" class="form-control select2" required>
							<option value="">Pilih Verifikator Kegiatan</option>
							<?php 
							foreach($pegawai as $p){
								$selected = $p->id_pegawai == set_value('id_pegawai_verifikator_kegiatan') ? ' selected' : '';
								echo '<option value="'.$p->id_pegawai.'"'.$selected.'>'.$p->nama_lengkap.' - '.$p->jabatan.'</option>';
							}
							?>
						</select>
					</div>
					<div class="row">
						<div class="col-md-12">
						<button type="submit" class="btn btn-primary pull-right" style="margin-left:10px"><i class="ti-plus"></i> Buat Pengajuan</button>
							<a href="<?=base_url('kerja_luar_kantor')?>" class="btn btn-default pull-right"><i class="ti-arrow-circle-left"></i> Kembali</a>
						</div>
					</div>
				</form>
			</div>
		</div>

	</div>