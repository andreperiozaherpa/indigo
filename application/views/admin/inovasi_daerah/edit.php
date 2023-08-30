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
		<div class="col-md-12">
			<div class="white-box">
				<h3 class="box-title">Ubah Profil Inovasi Daerah</h3>
				<?php if ($this->session->flashdata('success')) { ?>
					<div class="alert alert-success">
						<?=$this->session->flashdata('success')?>
					</div>
				<?php } ?>
				<?php if ($this->session->flashdata('rancang_bangun_error')) { ?>
					<div class="alert alert-danger">
						<?=$this->session->flashdata('rancang_bangun_error')?>
					</div>
				<?php } ?>
					<?= form_open_multipart() ?>
					<?php
					if (isset($message)) {
					?>
						<div class="alert alert-<?= $type ?>"><?= $message ?></div>
					<?php } ?>
					<?php if (in_array('indeks_inovasi', $user_privileges) || $user_level == 'Administrator') { ?>
					<div class="form-group">
						<label>Nama Perangkat Daerah <sup class="text-danger" title="wajib diisi">*</sup> </label>
							<select name="id_skpd" class="form-control select2" id="">
								<?php foreach ($skpd as $key => $value) {
									?>
									<option value="<?=$value->id_skpd?>" <?=($detail->id_skpd == $value->id_skpd) ? 'selected' : null?>><?=$value->nama_skpd?></option>
								<?php } ?>
							</select>
							<small class="text-danger">
								<?php echo form_error('id_skpd'); ?>
							</small>
						</div>
					<?php } ?>
					<div class="form-group">
						<label for="">Nama Desa (Optional)</label>
						<input type="text" class="form-control" name="nama_desa" id="" value="<?=$detail->nama_desa ?? set_value('nama_desa')?>" placeholder="contoh: DESA SUKAJAYA">
						<small class="text-danger">
							<?php echo form_error('nama_desa'); ?>
						</small>
					</div>
					<div class="form-group">
						<label for="">Nama Inovasi <sup class="text-danger" title="wajib diisi">*</sup></label>
						<input type="text" class="form-control" name="nama" id="" value="<?=$detail->nama?>" placeholder="Masukan Jumlah dalam Angka (misal : 3)">
						<small class="text-danger">
							<?php echo form_error('nama'); ?>
						</small>
					</div>
					<div class="form-group">
						<label for="">Tahapan Inovasi <sup class="text-danger" title="wajib diisi">*</sup></label>
						<div class="radio-list">
							<label class="radio-inline p-0">
								<div class="radio radio-info">
									<input type="radio" name="tahapan" id="Inisiatif" value="Inisiatif"  <?=($detail->tahapan == 'Inisiatif') ? 'checked' : null?>>
									<label for="Inisiatif">Inisiatif</label>
								</div>
							</label>
							<label class="radio-inline">
								<div class="radio radio-info">
									<input type="radio" name="tahapan" id="Uji Coba" value="Uji Coba" <?=($detail->tahapan == 'Uji Coba') ? 'checked' : null?>>
									<label for="Uji Coba">Uji Coba</label>
								</div>
							</label>
							<label class="radio-inline">
								<div class="radio radio-info">
									<input type="radio" name="tahapan" id="Penerapan" value="Penerapan" <?=($detail->tahapan == 'Penerapan') ? 'checked' : null?>>
									<label for="Penerapan">Penerapan</label>
								</div>
							</label>
						</div>
						<small class="text-danger">
							<?php echo form_error('tahapan'); ?>
						</small>
					</div>
					<div class="form-group">
						<label for="">Inisiator Inovasi Daerah <sup class="text-danger" title="wajib diisi">*</sup></label>
						<div class="radio-list">
							<label class="radio-inline p-0">
								<div class="radio radio-info">
									<input type="radio" name="inisiator" id="kepala_daerah" value="Kepala Daerah"  <?=($detail->inisiator == 'Kepala Daerah') ? 'checked' : null?>>
									<label for="kepala_daerah">Kepala Daerah</label>
								</div>
							</label>
							<label class="radio-inline">
								<div class="radio radio-info">
									<input type="radio" name="inisiator" id="anggota_dprd" value="Anggota DPRD" <?=($detail->inisiator == 'Anggota DPRD') ? 'checked' : null?>>
									<label for="anggota_dprd">Anggota DPRD</label>
								</div>
							</label>
							<label class="radio-inline">
								<div class="radio radio-info">
									<input type="radio" name="inisiator" id="opd" value="OPD" <?=($detail->inisiator == 'OPD') ? 'checked' : null?>>
									<label for="opd">OPD</label>
								</div>
							</label>
							<label class="radio-inline">
								<div class="radio radio-info">
									<input type="radio" name="inisiator" id="asn" value="ASN" <?=($detail->inisiator == 'ASN') ? 'checked' : null?>>
									<label for="asn">ASN</label>
								</div>
							</label>
							<label class="radio-inline">
								<div class="radio radio-info">
									<input type="radio" name="inisiator" id="masyarakat" value="Masyarakat" <?=($detail->inisiator == 'Masyarakat') ? 'checked' : null?>>
									<label for="masyarakat">Masyarakat</label>
								</div>
							</label>
						</div>
						<small class="text-danger">
							<?php echo form_error('inisiator'); ?>
						</small>
					</div>
					<div class="form-group">
						<label for="">Jenis Inovasi<sup class="text-danger" title="wajib diisi">*</sup></label>
						<div class="radio-list">
							<label class="radio-inline p-0">
								<div class="radio radio-info">
									<input type="radio" name="jenis" id="digital" value="Digital"  <?=($detail->jenis == 'Digital') ? 'checked' : null?>>
									<label for="digital">Digital</label>
								</div>
							</label>
							<label class="radio-inline">
								<div class="radio radio-info">
									<input type="radio" name="jenis" id="non_digital" value="Non Digital" <?=($detail->jenis == 'Non Digital') ? 'checked' : null?>>
									<label for="non_digital">Non Digital</label>
								</div>
							</label>
						</div>
						<small class="text-danger">
							<?php echo form_error('jenis'); ?>
						</small>
					</div>
					<div class="form-group">
						<label for="">Bentuk Inovasi<sup class="text-danger" title="wajib diisi">*</sup></label>
						<div class="radio-list">
							<label class="radio-inline p-0">
								<div class="radio radio-info">
									<input type="radio" name="bentuk" id="non_covid19" value="Non COVID 19"  <?=($detail->bentuk == 'Non COVID 19') ? 'checked' : null?>>
									<label for="non_covid19">Non COVID 19</label>
								</div>
							</label>
							<label class="radio-inline">
								<div class="radio radio-info">
									<input type="radio" name="bentuk" id="covid19" value="COVID 19" <?=($detail->bentuk == 'COVID 19') ? 'checked' : null?>>
									<label for="covid19">COVID 19</label>
								</div>
							</label>
						</div>
						<small class="text-danger">
							<?php echo form_error('bentuk'); ?>
						</small>
					</div>
					<div class="form-group">
						<label for="">Urusan Inovasi Daerah<sup class="text-danger" title="wajib diisi">*</sup></label>
						<select name="urusan" class="form-control select2" id="">
							<option value="">-- Pilih</option>
							<option value="Pendidikan" <?=($detail->urusan == 'Pendidikan') ? 'selected' : null;?>>Pendidikan</option>
							<option value="Kesehatan" <?=($detail->urusan == 'Kesehatan') ? 'selected' : null;?>>Kesehatan</option>
							<option value="Pekerjaan Umum dan Penataan Ruang" <?=($detail->urusan == 'Pekerjaan Umum dan Penataan Ruang') ? 'selected' : null;?>>Pekerjaan Umum dan Penataan Ruang</option>
							<option value="Perumahan rakyat dan kawasan permukiman" <?=($detail->urusan == 'Perumahan rakyat dan kawasan permukiman') ? 'selected' : null;?>>Perumahan rakyat dan kawasan permukiman</option>
							<option value="Ketentraman, ketertiban umum, dan pelindungan masyarakat" <?=($detail->urusan == 'Ketentraman, ketertiban umum, dan pelindungan masyarakat') ? 'selected' : null;?>>Ketentraman, ketertiban umum, dan pelindungan masyarakat</option>
							<option value="Sosial" <?=($detail->urusan == 'Sosial') ? 'selected' : null;?>>Sosial</option>
							<option value="Tenaga Kerja" <?=($detail->urusan == 'Tenaga Kerja') ? 'selected' : null;?>>Tenaga Kerja</option>
							<option value="Pemberdayaan perempuan dan perlindungan anak" <?=($detail->urusan == 'Pemberdayaan perempuan dan perlindungan anak') ? 'selected' : null;?>>Pemberdayaan perempuan dan perlindungan anak</option>
							<option value="Pangan" <?=($detail->urusan == 'Pangan') ? 'selected' : null;?>>Pangan</option>
							<option value="Pertahanan" <?=($detail->urusan == 'Pertahanan') ? 'selected' : null;?>>Pertahanan</option>
							<option value="Lingkungan Hidup" <?=($detail->urusan == 'Lingkungan Hidup') ? 'selected' : null;?>>Lingkungan Hidup</option>
							<option value="Administrasi kependudukan dan pencatatan sipil" <?=($detail->urusan == 'Administrasi kependudukan dan pencatatan sipil') ? 'selected' : null;?>>Administrasi kependudukan dan pencatatan sipil</option>
							<option value="Pemberdayaan masyarakat dan Desa" <?=($detail->urusan == 'Pemberdayaan masyarakat dan Desa') ? 'selected' : null;?>>Pemberdayaan masyarakat dan Desa</option>
							<option value="Pengendalian penduduk dan keluarga berencana" <?=($detail->urusan == 'Pengendalian penduduk dan keluarga berencana') ? 'selected' : null;?>>Pengendalian penduduk dan keluarga berencana</option>
							<option value="Perhubungan" <?=($detail->urusan == 'Perhubungan') ? 'selected' : null;?>>Perhubungan</option>
							<option value="Komunikasi dan informatika" <?=($detail->urusan == 'Komunikasi dan informatika') ? 'selected' : null;?>>Komunikasi dan informatika</option>
							<option value="Koperasi, usaha kecil dan menengah" <?=($detail->urusan == 'Koperasi, usaha kecil dan menengah') ? 'selected' : null;?>>Koperasi, usaha kecil dan menengah</option>
							<option value="Penanaman modal" <?=($detail->urusan == 'Penanaman modal') ? 'selected' : null;?>>Penanaman modal</option>
							<option value="Kepemudaan dan olahraga" <?=($detail->urusan == 'Kepemudaan dan olahraga') ? 'selected' : null;?>>Kepemudaan dan olahraga</option>
							<option value="Statistik" <?=($detail->urusan == 'Statistik') ? 'selected' : null;?>>Statistik</option>
							<option value="Persandian" <?=($detail->urusan == 'Persandian') ? 'selected' : null;?>>Persandian</option>
							<option value="Kebudayaan" <?=($detail->urusan == 'Kebudayaan') ? 'selected' : null;?>>Kebudayaan</option>
							<option value="Perpustakaan" <?=($detail->urusan == 'Perpustakaan') ? 'selected' : null;?>>Perpustakaan</option>
							<option value="Kearsipan" <?=($detail->urusan == 'Kearsipan') ? 'selected' : null;?>>Kearsipan</option>
							<option value="Kelautan dan perikanan" <?=($detail->urusan == 'Kelautan dan perikanan') ? 'selected' : null;?>>Kelautan dan perikanan</option>
							<option value="Pariwisata" <?=($detail->urusan == 'Pariwisata') ? 'selected' : null;?>>Pariwisata</option>
							<option value="Pertanian" <?=($detail->urusan == 'Pertanian') ? 'selected' : null;?>>Pertanian</option>
							<option value="Kehutanan" <?=($detail->urusan == 'Kehutanan') ? 'selected' : null;?>>Kehutanan</option>
							<option value="Energi dan sumber daya mineral" <?=($detail->urusan == 'Energi dan sumber daya mineral') ? 'selected' : null;?>>Energi dan sumber daya mineral</option>
							<option value="Perdagangan" <?=($detail->urusan == 'Perdagangan') ? 'selected' : null;?>>Perdagangan</option>
							<option value="Perindustrian" <?=($detail->urusan == 'Perindustrian') ? 'selected' : null;?>>Perindustrian</option>
							<option value="Transmigrasi" <?=($detail->urusan == 'Transmigrasi') ? 'selected' : null;?>>Transmigrasi</option>
							<option value="Urusan lainnya sesuai dengan peraturan perundangan" <?=($detail->urusan == 'Urusan lainnya sesuai dengan peraturan perundangan') ? 'selected' : null;?>>Urusan lainnya sesuai dengan peraturan perundangan</option>
						</select>
						<small class="text-danger">
							<?php echo form_error('urusan'); ?>
						</small>
					</div>
					<div class="form-group">
						<label for="">Waktu Uji Coba Inovasi Daerah<sup class="text-danger" title="wajib diisi">*</sup></label>
						<input type="date" name="waktu_ujicoba" class="form-control" value="<?=$detail->waktu_ujicoba?>">
						<small class="text-danger">
							<?php echo form_error('waktu_ujicoba'); ?>
						</small>
					</div>
					<div class="form-group">
						<label for="">Waktu Penerapan<sup class="text-danger" title="wajib diisi">*</sup></label>
						<input type="date" name="waktu_implementasi" value="<?=$detail->waktu_implementasi?>" class="form-control">
						<small class="text-danger">
							<?php echo form_error('waktu_implementasi'); ?>
						</small>
					</div>
					<div class="form-group">
						<label for="">Rancang Bangun<sup class="text-danger" title="wajib diisi">*</sup></label>
						<textarea name="rancang_bangun" class="form-control" id="" cols="30" rows="5"><?=$detail->rancang_bangun?></textarea>
						<span><b><small class="text-muted">Minimal 300 kata</small></b></span>
						<small class="text-danger">
							<?php echo form_error('rancang_bangun'); ?>
						</small>
					</div>
					<div class="form-group">
						<label for="">Tujuan<sup class="text-danger" title="wajib diisi">*</sup></label>
						<textarea name="tujuan" class="form-control" id="" cols="30" rows="5"><?=$detail->tujuan?></textarea>
						<small class="text-danger">
							<?php echo form_error('tujuan'); ?>
						</small>
					</div>
					<div class="form-group">
						<label for="">Manfaat<sup class="text-danger" title="wajib diisi">*</sup></label>
						<textarea name="manfaat" class="form-control" id="" cols="30" rows="5"><?=$detail->manfaat?></textarea>
						<small class="text-danger">
							<?php echo form_error('manfaat'); ?>
						</small>
					</div>
					<div class="form-group">
						<label for="">Hasil<sup class="text-danger" title="wajib diisi">*</sup></label>
						<textarea name="hasil" class="form-control" id="" cols="30" rows="5"><?=$detail->hasil?></textarea>
						<small class="text-danger">
							<?php echo form_error('hasil'); ?>
						</small>
					</div>
					<div class="form-group">
						<label>Anggaran (Jika Diperlukan)</label>
						<div class="row" id="row-file">
							<div class="col-md-3" id="file-1">
								<input type="file" class="dropify" data-default-file="<?=('./data/inovasi_daerah/'.$detail->anggaran_file)?>" data-max-file-size="5M" data-allowed-file-extensions="ppt xls doc pdf" name="anggaran_file">
							</div>
						</div>
						<small>*Max file size 5MB, tipe file yang diizinkan: ppt,xls,doc dan pdf .</small>
						<small class="text-danger">
							<?php echo form_error('anggaran_file'); ?>
						</small>
					</div>
					<div class="form-group">
						<label>Profil Bisnis .ppt (Jika Ada)</label>
						<div class="row" id="row-file">
							<div class="col-md-3" id="file-1">
								<input type="file" class="dropify" data-max-file-size="5M" data-default-file="<?=('./data/inovasi_daerah/'.$detail->profile_file)?>" data-allowed-file-extensions="ppt xls doc pdf" name="profile_file">
							</div>
						</div>
						<small>*Max file size 5MB, tipe file yang diizinkan: ppt,xls,doc dan pdf .</small>
						<small class="text-danger">
							<?php echo form_error('profile_file'); ?>
						</small>
					</div>
					<div class="row">
						<div class="pull-right">
							<div class="col-md-12">
								<a href="<?= base_url('inovasi_daerah') ?>" class="btn btn-primary btn-outline"><i class="ti-arrow-circle-left"></i> Kembali</a>
								<button type="submit" name="submit" class="btn btn-primary"><i class="ti-save"></i> Submit</button>
							</div>
						</div>
					</div>
					</form>
			</div>
		</div>
	</div>

</div>
<script>
	function check_ketersediaan(label){
		var nilai = $("input[name="+label+"]:checked").val();
		if (nilai == 'Ya') {
			$('#'+label+'_doc').show();
		}else{
			$('#'+label+'_doc').hide();
		}
	}
</script>