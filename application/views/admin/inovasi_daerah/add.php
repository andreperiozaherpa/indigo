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
				<h3 class="box-title">Tambah Profil Inovasi Daerah 1111</h3>
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
					<?php if (in_array('admin_indeks_inovasi', $user_privileges) || $user_level == 'Administrator') { ?>
					<div class="form-group">
						<label>Nama Perangkat Daerah <sup class="text-danger" title="wajib diisi">*</sup> </label>
							<select name="id_skpd" class="form-control select2" id="">
								<?php foreach ($skpd as $key => $value) {
									?>
									<option value="<?=$value->id_skpd?>" <?=($id_skpd == $value->id_skpd) ? 'selected' : null?>><?=$value->nama_skpd?></option>
								<?php } ?>
							</select>
							<small class="text-danger">
								<?php echo form_error('id_skpd'); ?>
							</small>
						</div>
					<?php } ?>
					<div class="form-group">
						<label for="">Nama Desa (Optional)</label>
						<input type="text" class="form-control" name="nama_desa" id="" value="<?=set_value('nama_desa')?>" placeholder="contoh: DESA SUKAJAYA">
						<small class="text-danger">
							<?php echo form_error('nama_desa'); ?>
						</small>
					</div>
					<div class="form-group">
						<label for="">Nama Inovasi <sup class="text-danger" title="wajib diisi">*</sup></label>
						<input type="text" class="form-control" name="nama" id="" value="<?=set_value('nama')?>" placeholder="...">
						<small class="text-danger">
							<?php echo form_error('nama'); ?>
						</small>
					</div>
					<div class="form-group">
						<label for="">Tahapan Inovasi <sup class="text-danger" title="wajib diisi">*</sup></label>
						<div class="radio-list">
							<label class="radio-inline p-0">
								<div class="radio radio-info">
									<input type="radio" name="tahapan" id="Inisiatif" value="Inisiatif" checked>
									<label for="Inisiatif">Inisiatif</label>
								</div>
							</label>
							<label class="radio-inline">
								<div class="radio radio-info">
									<input type="radio" name="tahapan" id="Uji Coba" value="Uji Coba">
									<label for="Uji Coba">Uji Coba</label>
								</div>
							</label>
							<label class="radio-inline">
								<div class="radio radio-info">
									<input type="radio" name="tahapan" id="Penerapan" value="Penerapan">
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
									<input type="radio" name="inisiator" id="kepala_daerah" value="Kepala Daerah" checked>
									<label for="kepala_daerah">Kepala Daerah</label>
								</div>
							</label>
							<label class="radio-inline">
								<div class="radio radio-info">
									<input type="radio" name="inisiator" id="anggota_dprd" value="Anggota DPRD">
									<label for="anggota_dprd">Anggota DPRD</label>
								</div>
							</label>
							<label class="radio-inline">
								<div class="radio radio-info">
									<input type="radio" name="inisiator" id="opd" value="OPD">
									<label for="opd">OPD</label>
								</div>
							</label>
							<label class="radio-inline">
								<div class="radio radio-info">
									<input type="radio" name="inisiator" id="asn" value="ASN">
									<label for="asn">ASN</label>
								</div>
							</label>
							<label class="radio-inline">
								<div class="radio radio-info">
									<input type="radio" name="inisiator" id="masyarakat" value="Masyarakat">
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
									<input type="radio" name="jenis" id="digital" value="Digital" checked>
									<label for="digital">Digital</label>
								</div>
							</label>
							<label class="radio-inline">
								<div class="radio radio-info">
									<input type="radio" name="jenis" id="non_digital" value="Non Digital">
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
									<input type="radio" name="bentuk" id="non_covid19" value="Non COVID 19" checked>
									<label for="non_covid19">Non COVID 19</label>
								</div>
							</label>
							<label class="radio-inline">
								<div class="radio radio-info">
									<input type="radio" name="bentuk" id="covid19" value="COVID 19">
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
							<option value="Pendidikan">Pendidikan</option>
							<option value="Kesehatan">Kesehatan</option>
							<option value="Pekerjaan Umum dan Penataan Ruang">Pekerjaan Umum dan Penataan Ruang</option>
							<option value="Perumahan rakyat dan kawasan permukiman">Perumahan rakyat dan kawasan permukiman</option>
							<option value="Ketentraman, ketertiban umum, dan pelindungan masyarakat">Ketentraman, ketertiban umum, dan pelindungan masyarakat</option>
							<option value="Sosial">Sosial</option>
							<option value="Tenaga Kerja">Tenaga Kerja</option>
							<option value="Pemberdayaan perempuan dan perlindungan anak">Pemberdayaan perempuan dan perlindungan anak</option>
							<option value="Pangan">Pangan</option>
							<option value="Pertahanan">Pertahanan</option>
							<option value="Lingkungan Hidup">Lingkungan Hidup</option>
							<option value="Administrasi kependudukan dan pencatatan sipil">Administrasi kependudukan dan pencatatan sipil</option>
							<option value="Pemberdayaan masyarakat dan Desa">Pemberdayaan masyarakat dan Desa</option>
							<option value="Pengendalian penduduk dan keluarga berencana">Pengendalian penduduk dan keluarga berencana</option>
							<option value="Perhubungan">Perhubungan</option>
							<option value="Komunikasi dan informatika">Komunikasi dan informatika</option>
							<option value="Koperasi, usaha kecil dan menengah">Koperasi, usaha kecil dan menengah</option>
							<option value="Penanaman modal">Penanaman modal</option>
							<option value="Kepemudaan dan olahraga">Kepemudaan dan olahraga</option>
							<option value="Statistik">Statistik</option>
							<option value="Persandian">Persandian</option>
							<option value="Kebudayaan">Kebudayaan</option>
							<option value="Perpustakaan">Perpustakaan</option>
							<option value="Kearsipan">Kearsipan</option>
							<option value="Kelautan dan perikanan">Kelautan dan perikanan</option>
							<option value="Pariwisata">Pariwisata</option>
							<option value="Pertanian">Pertanian</option>
							<option value="Kehutanan">Kehutanan</option>
							<option value="Energi dan sumber daya mineral">Energi dan sumber daya mineral</option>
							<option value="Perdagangan">Perdagangan</option>
							<option value="Perindustrian">Perindustrian</option>
							<option value="Transmigrasi">Transmigrasi</option>
							<option value="Urusan lainnya sesuai dengan peraturan perundangan">Urusan lainnya sesuai dengan peraturan perundangan</option>
						</select>
						<small class="text-danger">
							<?php echo form_error('urusan'); ?>
						</small>
					</div>
					<div class="form-group">
						<label for="">Waktu Uji Coba Inovasi Daerah<sup class="text-danger" title="wajib diisi">*</sup></label>
						<input type="date" name="waktu_ujicoba" class="form-control" value="<?=set_value('waktu_ujicoba')?>">
						<small class="text-danger">
							<?php echo form_error('waktu_ujicoba'); ?>
						</small>
					</div>
					<div class="form-group">
						<label for="">Waktu Penerapan<sup class="text-danger" title="wajib diisi">*</sup></label>
						<input type="date" name="waktu_implementasi" value="<?=set_value('waktu_implementasi')?>" class="form-control">
						<small class="text-danger">
							<?php echo form_error('waktu_implementasi'); ?>
						</small>
					</div>
					<div class="form-group">
						<label for="">Rancang Bangun<sup class="text-danger" title="wajib diisi">*</sup></label>
						<textarea name="rancang_bangun" class="form-control" id="" cols="30" rows="5"><?=set_value('rancang_bangun')?></textarea>
						<span><b><small class="text-muted">Minimal 300 kata</small></b></span>
						<small class="text-danger">
							<?php echo form_error('rancang_bangun'); ?>
						</small>
					</div>
					<div class="form-group">
						<label for="">Tujuan<sup class="text-danger" title="wajib diisi">*</sup></label>
						<textarea name="tujuan" class="form-control" id="" cols="30" rows="5"><?=set_value('tujuan')?></textarea>
						<small class="text-danger">
							<?php echo form_error('tujuan'); ?>
						</small>
					</div>
					<div class="form-group">
						<label for="">Manfaat<sup class="text-danger" title="wajib diisi">*</sup></label>
						<textarea name="manfaat" class="form-control" id="" cols="30" rows="5"><?=set_value('manfaat')?></textarea>
						<small class="text-danger">
							<?php echo form_error('manfaat'); ?>
						</small>
					</div>
					<div class="form-group">
						<label for="">Hasil<sup class="text-danger" title="wajib diisi">*</sup></label>
						<textarea name="hasil" class="form-control" id="" cols="30" rows="5"><?=set_value('hasil')?></textarea>
						<small class="text-danger">
							<?php echo form_error('hasil'); ?>
						</small>
					</div>
					<div class="form-group">
						<label>Anggaran (Jika Diperlukan)</label>
						<div class="row" id="row-file">
							<div class="col-md-3" id="file-1">
								<input type="file" class="dropify" data-max-file-size="2M" data-allowed-file-extensions="ppt xls doc pdf" name="anggaran_file">
							</div>
						</div>
						<small>*Max file size 2MB, tipe file yang diizinkan: ppt,xls,doc dan pdf .</small>
						<small class="text-danger">
							<?php echo form_error('anggaran_file'); ?>
						</small>
					</div>
					<div class="form-group">
						<label>Profil Bisnis .ppt (Jika Ada)</label>
						<div class="row" id="row-file">
							<div class="col-md-3" id="file-1">
								<input type="file" class="dropify" data-max-file-size="2M" data-allowed-file-extensions="ppt xls doc pdf" name="profile_file">
							</div>
						</div>
						<small>*Max file size 2MB, tipe file yang diizinkan: ppt,xls,doc dan pdf .</small>
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