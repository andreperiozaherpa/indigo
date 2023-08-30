
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
											Tambah Pengajuan Surat
										</div>
									</div>
									<?php if ($this->session->flashdata('error')) { ?>
										<div class="alert alert-danger">
											<?=$this->session->flashdata('error');?>
										</div>
									<?php } ?>
                    <form method="post" enctype="multipart/form-data">
						<input type="hidden" name="id_pegawai" value="<?=$id_pegawai?> ">
						<div class="form-group">
							<label for="">Jenis Pengajuan Surat</label>
							<select class="form-control" name="id_ref_jenis_pengajuan_surat" id="jenis_pengajuan_surat" required>
							<option value="" id="option-lieur">--Pilih--</option>
							<?php
							$no = 1;
							foreach ($jenis_pengajuan_surat as $key => $value) { ?>
								<option id="<?=$no?>" value="<?=$value->id_ref_jenis_pengajuan_surat?>"><?=$value->jenis_pengajuan_surat?></option>
							<?php $no++; } ?>
							</select>
						</div>
						<div class="top-form" style="display:none">
							<div class="form-group">
								<label for="">Jenjang Pendidikan yang Ditempuh</label>
								<select name="jenjang_pendidikan" class="form-control" id="" required>
								<option value="" id="option-lieur">--Pilih--</option>
									<option value="SMP">SMP</option>
									<option value="SMA">SMA</option>
									<option value="SMK">SMK</option>
									<option value="D1">D1</option>
									<option value="D2">D2</option>
									<option value="D3">D3</option>
									<option value="D4">D4</option>
									<option value="S1">S1</option>
									<option value="S2">S2</option>
									<option value="S3">S3</option>
									<option value="Profesi">Profesi</option>
								</select>
							</div>
							<div class="form-group">
								<label for="">Program Studi / Jurusan</label>
								<input class="form-control" name="program_studi" type="text"required>
							</div>
							<div class="form-group">
								<label for="">Lembaga Pendidikan (Universitas, Institut, Sekloah Tinggi dll.)</label>
								<input class="form-control" name="lembaga_pendidikan" type="text"required>
							</div>
							<div id="form2" class="form-update" style="display:none">
								<div class="form-group">
									<label for="">No Ijazah</label>
									<input class="form-control" name="no_ijazah" type="text">
								</div>
								<div class="form-group">
									<label for="">Tanggal Ijazah</label>
									<input class="form-control mydatepicker" name="tanggal_ijazah" type="date">
								</div>
							</div>
							<div class="form-group">
								<label for="">Nilai PPK PNS / SKP</label>
								<input class="form-control" name="nilai_ppk" type="text"required>
							</div>
							<div class="form-group">
								<label for="">No HP/WA</label>
								<input class="form-control" name="no_hp" type="text"required>
							</div>
							<div class="form-group">
								<label for="">Surat Usulan dari OPD</label>
								<input type="file" id="input-file-max-fs" name="surat_usulan_opd" data-max-file-size="2M" data-allowed-file-extensions="pdf" class="dropify" required/>
								<small style="color:red;font-weight:bold;">Format file PDF</small>
							</div>
							<div class="form-group">
								<label for="">Surat Keterangan Tidak Dijatuhi Hukuman Disiplin.</label>
								<input type="file" name="sk_tidak_dijatuhi_hukuman_disiplin" id="input-file-max-fs" data-max-file-size="2M" data-allowed-file-extensions="pdf" class="dropify" required/>
								<small style="color:red;font-weight:bold;">Format file PDF</small>
							</div>
							<div class="form-group">
								<label for="">SK Pangkat Terakhir.</label>
								<input type="file" name="sk_pangkat_terakhir" id="input-file-max-fs" data-max-file-size="2M" data-allowed-file-extensions="pdf" class="dropify" required/>
								<small style="color:red;font-weight:bold;">Format file PDF</small>
							</div>
							<div id="form-upload1" class="form-update" style="display:none">
								<div class="form-group">
									<label for="">Jadwal Kuliah</label>
									<input type="file" name="jadwal_kuliah" id="input-file-max-fs" data-max-file-size="2M" data-allowed-file-extensions="pdf" class="dropify" />
									<small style="color:red;font-weight:bold;">Format file PDF</small>
								</div>
								<div class="form-group">
									<label for="">Surat Keterangan dari Lembaga Pendidikan.</label>
									<input type="file" name="sk_lembaga_pendidikan" id="input-file-max-fs" data-max-file-size="2M" data-allowed-file-extensions="pdf" class="dropify" />
									<small style="color:red;font-weight:bold;">Format file PDF</small>
								</div>
							</div>
							<div id="form-upload2" class="form-update" style="display:none">
								<div class="form-group">
									<label for="">Ijazah (fotocopy dilegalisir).</label>
									<input type="file" name="fc_ijazah" id="input-file-max-fs" data-max-file-size="2M" data-allowed-file-extensions="pdf" class="dropify" />
									<small style="color:red;font-weight:bold;">Format file PDF</small>
								</div>
								<div class="form-group">
									<label for="">Transkrip Nilai (fotocopy dilegalisir).</label>
									<input type="file" name="transkip_nilai" id="input-file-max-fs" data-max-file-size="2M" data-allowed-file-extensions="pdf" class="dropify" />
									<small style="color:red;font-weight:bold;">Format file PDF</small>
								</div>
							</div>
						<button type="submit" name="tombol_submit" class="btn btn-primary" style="width:100px;">Simpan</button>
						</div>
                    </form>
                </div>
            </div>
        </div>
