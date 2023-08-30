
<div class="container-fluid">

	<div class="row bg-title">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title">Pengajuan Surat</h4> </div>
			<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
				<ol class="breadcrumb">
					<li class="active">pengajuan_surat</li>				</ol>
				</div>
				<!-- /.col-lg-12 -->
			</div>


			<div class="row">
            <div class="col-sm-12">
                <div class="white-box" style="border-top: 5px solid #6003c8;">
									<div class="panel panel-primary">
										<div class="panel-heading text-center">
											Edit Pengajuan Surat
										</div>
									</div>
									<?php if ($this->session->flashdata('error')) { ?>
										<div class="alert alert-danger">
											<?=$this->session->flashdata('error');?>
										</div>
									<?php } ?>
                    <form method="post" enctype="multipart/form-data">
						<input type="hidden" name="id_pegawai" value="<?=$id_pegawai?> ">
						<input type="hidden" name="id_skpd" value="<?=$id_skpd?> ">
						<div class="form-group">
							<label for="">Jenis Pengajuan Surat</label>
							<select class="form-control" name="id_ref_jenis_pengajuan_surat" id="jenis_pengajuan_surat" required>
							<?php
							$no = 1;
							foreach ($jenis_pengajuan_surat as $key => $value) { ?>
								<option id="<?=$no?>" value="<?=$value->id_ref_jenis_pengajuan_surat?>" <?php echo ($value->id_ref_jenis_pengajuan_surat == $pengajuan_surat->id_ref_jenis_pengajuan_surat) ? 'selected' : null; ?>><?=$value->jenis_pengajuan_surat?></option>
							<?php $no++; } ?>
							</select>
						</div>
						<div class="top-form" style="display:none">
							<div class="form-group">
								<label for="">Jenjang Pendidikan yang Ditempuh</label>
								<select name="jenjang_pendidikan" class="form-control" id="" required>
									<option value="SMP" <?=($pengajuan_surat->jenjang_pendidikan = 'SMP') ? 'selected' : null;?>>SMP</option>
									<option value="SMA" <?=($pengajuan_surat->jenjang_pendidikan = 'SMA') ? 'selected' : null;?>>SMA</option>
									<option value="SMK" <?=($pengajuan_surat->jenjang_pendidikan = 'SMK') ? 'selected' : null;?>>SMK</option>
									<option value="D1" <?=($pengajuan_surat->jenjang_pendidikan = 'D1') ? 'selected' : null;?>>D1</option>
									<option value="D2" <?=($pengajuan_surat->jenjang_pendidikan = 'D2') ? 'selected' : null;?>>D3</option>
									<option value="D3" <?=($pengajuan_surat->jenjang_pendidikan = 'D3') ? 'selected' : null;?>>D3</option>
									<option value="D4" <?=($pengajuan_surat->jenjang_pendidikan = 'D4') ? 'selected' : null;?>>D4</option>
									<option value="S1" <?=($pengajuan_surat->jenjang_pendidikan = 'S1') ? 'selected' : null;?>>S1</option>
									<option value="S2" <?=($pengajuan_surat->jenjang_pendidikan = 'S2') ? 'selected' : null;?>>S2</option>
									<option value="S3" <?=($pengajuan_surat->jenjang_pendidikan = 'S3') ? 'selected' : null;?>>S3</option>
									<option value="Profesi" <?=($pengajuan_surat->jenjang_pendidikan = 'Profesi') ? 'selected' : null;?>>Profesi</option>
								</select>
							</div>
							<div class="form-group">
								<label for="">Program Studi / Jurusan</label>
								<input class="form-control" value="<?=$pengajuan_surat->program_studi?>" name="program_studi" type="text"required>
							</div>
							<div class="form-group">
								<label for="">Lembaga Pendidikan (Universitas, Institut, Sekloah Tinggi dll.)</label>
								<input class="form-control" value="<?=$pengajuan_surat->lembaga_pendidikan?>" name="lembaga_pendidikan" type="text"required>
							</div>
							<div id="form2" class="form-update" style="display:none">
								<div class="form-group">
									<label for="">No Ijazah</label>
									<input class="form-control" value="<?=$pengajuan_surat->no_ijazah?>" name="no_ijazah" type="text">
								</div>
								<div class="form-group">
									<label for="">Tanggal Ijazah</label>
									<input class="form-control mydatepicker" value="<?=$pengajuan_surat->tanggal_ijazah?>" name="tanggal_ijazah" type="date">
								</div>
							</div>
							<div class="form-group">
								<label for="">Nilai PPK PNS / SKP</label>
								<input class="form-control" name="nilai_ppk" value="<?=$pengajuan_surat->nilai_ppk?>" type="text"required>
							</div>
							<div class="form-group">
								<label for="">No HP/WA</label>
								<input class="form-control" name="no_hp" value="<?=$pengajuan_surat->no_hp?>" type="text"required>
							</div>
							<div class="form-group">
								<label for="">Surat Usulan dari OPD</label>
								<input type="file" id="input-file-disable-remove" name="surat_usulan_opd" data-show-remove="false" data-default-file="<?=base_url('data/pengajuan_surat/'.$pengajuan_surat->surat_usulan_opd)?>" data-max-file-size="2M" data-allowed-file-extensions="pdf" class="dropify"/>
								<small style="color:red;font-weight:bold;">Format file PDF</small>
							</div>
							<div class="form-group">
								<label for="">Surat Keterangan Tidak Dijatuhi Hukuman Disiplin.</label>
								<input type="file" name="sk_tidak_dijatuhi_hukuman_disiplin" data-show-remove="false" data-default-file="<?=base_url('data/pengajuan_surat/'.$pengajuan_surat->sk_tidak_dijatuhi_hukuman_disiplin)?>" id="input-file-disable-remove" data-max-file-size="2M" data-allowed-file-extensions="pdf" class="dropify" />
								<small style="color:red;font-weight:bold;">Format file PDF</small>
							</div>
							<div class="form-group">
								<label for="">SK Pangkat Terakhir.</label>
								<input type="file" name="sk_pangkat_terakhir" data-show-remove="false" data-default-file="<?=base_url('data/pengajuan_surat/'.$pengajuan_surat->sk_pangkat_terakhir)?>" id="input-file-disable-remove" data-max-file-size="2M" data-allowed-file-extensions="pdf" class="dropify"/>
								<small style="color:red;font-weight:bold;">Format file PDF</small>
							</div>
							<div id="form-upload1" class="form-update" style="display:none">
								<div class="form-group">
									<label for="">Jadwal Kuliah</label>
									<input type="file" name="jadwal_kuliah" data-show-remove="false" data-default-file="<?=base_url('data/pengajuan_surat/'.$pengajuan_surat->jadwal_kuliah)?>" id="input-file-disable-remove" data-max-file-size="2M" data-allowed-file-extensions="pdf" class="dropify" />
									<small style="color:red;font-weight:bold;">Format file PDF</small>
								</div>
								<div class="form-group">
									<label for="">Surat Keterangan dari Lembaga Pendidikan.</label>
									<input type="file" name="sk_lembaga_pendidikan" data-show-remove="false" data-default-file="<?=base_url('data/pengajuan_surat/'.$pengajuan_surat->sk_lembaga_pendidikan)?>" id="input-file-disable-remove"fs" data-max-file-size="2M" data-allowed-file-extensions="pdf" class="dropify" />
									<small style="color:red;font-weight:bold;">Format file PDF</small>
								</div>
							</div>
							<div id="form-upload2" class="form-update" style="display:none">
								<div class="form-group">
									<label for="">Ijazah (fotocopy dilegalisir).</label>
									<input type="file" name="fc_ijazah" data-show-remove="false" data-default-file="<?=base_url('data/pengajuan_surat/'.$pengajuan_surat->fc_ijazah)?>" id="input-file-disable-remove" data-max-file-size="2M" data-allowed-file-extensions="pdf" class="dropify" />
									<small style="color:red;font-weight:bold;">Format file PDF</small>
								</div>
								<div class="form-group">
									<label for="">Transkrip Nilai (fotocopy dilegalisir).</label>
									<input type="file" name="transkip_nilai" data-show-remove="false" data-default-file="<?=base_url('data/pengajuan_surat/'.$pengajuan_surat->transkip_nilai)?>" id="input-file-disable-remove" data-max-file-size="2M" data-allowed-file-extensions="pdf" class="dropify" />
									<small style="color:red;font-weight:bold;">Format file PDF</small>
								</div>
							</div>
						<button type="submit" name="tombol_submit" class="btn btn-primary" style="width:100px;">Simpan</button>
						</div>
                    </form>
                </div>
            </div>
        </div>