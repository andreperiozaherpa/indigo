<div class="">
	<div class="page-title">
		<div class="title_left">
			<h3>Tambah Pegawai</h3>
		</div>
	</div>
	<div class="clearfix"/>
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<?php
				$tipe = (empty($error))? "info" : "danger";
				if (!empty($message)){
			?>
				<div class="alert alert-<?= $tipe;?> alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                    <?= $message;?>
                  </div>
				<?php }?>
			<div class="x_panel">
				<form method='post' enctype="multipart/form-data" >
				<div class="x_content">
					<div class="alert alert-danger alert-dismissible fade in" role="alert" id='pesan' style='display:none'>
						<button type="button" onclick='hideMe()' class="close" aria-label="Close"><span aria-hidden="true">×</span>
						</button>
						<label id='status'></label>
					 </div>
					<div class="panel panel-default">
						<div class="panel-heading">
                            Nomor Induk Pegawai (NIP)
						</div>
						<div class="panel-body">
							<div class="row">
								<div class="col-md-4">
									<div class="form-group">
										<label>Lama</label>
										<input type="text" name="nip_lama" id="nip_lama" class="form-control" placeholder='NIP Lama' value='<?= $nip_lama;?>' />
										
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label>Baru *</label>
										<input  name='nip_baru' placeholder='NIP Baru' id='nip_baru' class="form-control"  name="NIPBaru" value='<?= $nip_baru;?>' />
										<div style='float:right;padding:5px;margin-right:-10px'>
											<a class='btn btn-default' data-toggle="modal" data-target=".search-from-master">
											<i class='fa fa-cloud-download'></i>
											cari dari master data</a>
										</div>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label>Karpeg</label>
										<input placeholder='Karpeg' class="form-control" id='karpeg' name="karpeg" value='<?= $karpeg;?>' >
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="panel panel-default">
						<div class="panel-heading">Nama Lengkap & Gelar</div>
						<div class="panel-body">
							<div class="row">
								<div class="col-md-4">
									<div class="form-group">
										<label>Gelar di depan nama</label>
										<select class='form-control' name='id_gelardepan' id='id_gelardepan'>
											<option value=''>Pilih</option>
											<?php 
												foreach($gelardepan as $row){
													$selected = "";
													if ($id_gelardepan==$row->id_gelardepan) $selected="selected";
													echo "<option value='$row->id_gelardepan' $selected>$row->nama_gelardepan</option>";
												}
											?>
										</select>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label>Nama lengkap</label>
										<input class="form-control" name="nama_lengkap" id='nama_lengkap' placeholder='Nama lengkap' value='<?= $nama_lengkap;?>'>
									</div>
								</div>
								<div class="col-md-4">                
									<div class="form-group">
										<label>Gelar di belakang nama</label>
										<select class='form-control' name='id_gelarbelakang' id='id_gelarbelakang'>
											<option value=''>Pilih</option>
											<?php 
												foreach($gelarbelakang as $row){
													$selected="";
													if ($id_gelarbelakang==$row->id_gelarbelakang) $selected="selected";
													echo "<option value='$row->id_gelarbelakang' $selected>$row->nama_gelarbelakang</option>";
												}
											?>
										</select>
									</div>
								</div>
							</div>
						</div>
					</div>    
					<div class="panel panel-default">
						<div class="panel-body">
							<div class="row">
								<div class="col-lg-4">
									<div class="form-group">
										<label>Tempat Lahir*</label>
										<input class="form-control" name="tempat_lahir" id='tempat_lahir' placeholder='Tempat lahir' value='<?= $tempat_lahir;?>'>
									</div>
								</div>
								<div class="col-lg-4">
									<div class="form-group">
										<label>Tanggal Lahir*</label>
										<input class="form-control" name="tgl_lahir" id="tgl_lahir" placeholder='yyyy-mm-dd' value='<?= $tgl_lahir;?>'>
										
									</div>
									
								</div>
								<div class="col-lg-4">
									<div class="form-group">
										<label>Agama*</label>
										<select class='form-control' name='id_agama' id='id_agama'>
											<?php 
												foreach($agama as $row){
													$selected="";
													if ($id_agama==$row->id_agama) $selected="selected";
													echo "<option value='$row->id_agama' $selected>$row->nama_agama</option>";
												}
											?>
										</select>
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group">
										<?php
											$checked1 = $jenis_kelamin==1 ? "checked" : "";
											$checked2 = $jenis_kelamin==2 ? "checked" : "";
										?>
										<label>Jenis Kelamin*</label>
										<label class="radio-inline">
											<input type="radio" name="jenis_kelamin" id="jenis_kelamin1" value="1" <?= $checked1;?> />Laki-laki
										</label>
										<label class="radio-inline">
											<input type="radio" name="jenis_kelamin" id="jenis_kelamin2" value="2" <?= $checked2;?> />Perempuan
										</label>
									</div>
								</div>
							</div>
						</div>
					</div>    
					<div class="panel panel-default">
						<div class="panel-heading">Pembayaran Gaji Pegawai*</div>
						<div class="panel-body">
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label>Bayar Gaji Dari : </label>
										<?php
											$bayar_gaji1 = $bayar_gaji=="Kas Daerah Sumedang" ? "checked" : "";
											$bayar_gaji2 = $bayar_gaji=="Luar Kas Daerah Sumedang" ? "checked" : "";
										?>
										<label class="radio-inline">
											<input <?= $bayar_gaji1;?> type="radio" name="bayar_gaji" id="bayar_gaji1" value="Kas Daerah Sumedang" >Kas Daerah Sumedang
										</label>
										<label class="radio-inline">
											<input <?= $bayar_gaji2;?> type="radio" name="bayar_gaji" id="bayar_gaji2" value="Luar Kas Daerah Sumedang" />Luar Kas Daerah Sumedang
										</label>
									</div>                 
								</div>
							</div>
						</div>
					</div>  
					<div class="panel panel-default">
						<div class="panel-heading">Status Pegawai*</div>
						<div class="panel-body">
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<?php
											$checked1 = $status_pegawai==1 ? "checked" : "";
											$checked2 = $status_pegawai==2 ? "checked" : "";
											$checked3 = $status_pegawai==3 ? "checked" : "";
											$checked4 = $status_pegawai==4 ? "checked" : "";
											$checked5 = $status_pegawai==5 ? "checked" : "";
										?>
										
										<label class="radio-inline">
											<input type="radio" name="status_pegawai" id="status_pegawai" value="1" <?= $checked1;?> />PNS
										</label>
										<label class="radio-inline">
											<input type="radio" name="status_pegawai" id="status_pegawai" value="2" <?= $checked2;?> />CPNS
										</label>
										<label class="radio-inline">
											<input type="radio" name="status_pegawai" id="status_pegawai" value="3" <?= $checked3;?> />PPPK
										</label>
										<label class="radio-inline">
											<input type="radio" name="status_pegawai" id="status_pegawai" value="4" <?= $checked4;?> />HONORER
										</label>
										<label class="radio-inline">
											<input type="radio" name="status_pegawai" id="status_pegawai" value="5" <?= $checked5;?> />SUKWAN
										</label>
									</div>               
								</div>
							</div>
						</div>
					</div>  
					<div class="panel panel-default">
						<div class="panel-heading">Kedudukan Hukum Pegawai*</div>
						<div class="panel-body">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<select class='form-control' name='kedudukan_pegawai' id='kedudukan_pegawai'>
											<?php
												$selected1 = $kedudukan_pegawai=="Aktif" ? "selected" : "";
												$selected2 = $kedudukan_pegawai=="CLTN" ? "selected" : "";
												$selected3 = $kedudukan_pegawai=="Masa Persiapan Pensiun" ? "selected" : "";
												$selected4 = $kedudukan_pegawai=="Tugas Belajar" ? "selected" : "";
												$selected5 = $kedudukan_pegawai=="Pejabat Negara" ? "selected" : "";
												$selected6 = $kedudukan_pegawai=="Kepala Desa" ? "selected" : "";
												$selected7 = $kedudukan_pegawai=="Hukuman Disiplin" ? "selected" : "";
												$selected8 = $kedudukan_pegawai=="Hilang" ? "selected" : "";
												$selected9 = $kedudukan_pegawai=="Meninggal Dunia" ? "selected" : "";
												$selected10 = $kedudukan_pegawai=="Diberhentikan Dengan Hormat" ? "selected" : "";
												$selected11 = $kedudukan_pegawai=="Diberhentikan Dengan Tidak Hormat" ? "selected" : "";
												$selected12 = $kedudukan_pegawai=="Pensiun" ? "selected" : "";
												$selected13 = $kedudukan_pegawai=="Mutasi Keluar" ? "selected" : "";
												$selected14 = $kedudukan_pegawai=="Mutasi Masuk" ? "selected" : "";
												$selected15 = $kedudukan_pegawai=="Menunggu Tugas" ? "selected" : "";
											?>
											<option value='Aktif' <?= $selected1;?>>Aktif</option>
											<option value='CLTN' <?= $selected2;?>>CLTN</option>
										    <option value='Masa Persiapan Pensiun' <?= $selected3;?>>Masa Persiapan Pensiun</option> 
											<option value='Tugas Belajar' <?= $selected4;?>>Tugas Belajar</option> 
											<option value='Pejabat Negara' <?= $selected5;?>>Pejabat Negara</option>
											<option value='Kepala Desa' <?= $selected6;?>>Kepala Desa</option>
											<option value='Hukuman Disiplin' <?= $selected7;?>>Hukuman Disiplin</option>   
											<option value='Hilang' <?= $selected8;?>>Hilang</option>   
											<option value='Meninggal Dunia' <?= $selected9;?>>Meninggal Dunia</option>   
											<option value='Diberhentikan Dengan Hormat' <?= $selected10;?>>Diberhentikan Dengan Hormat</option>   
											<option value='Diberhentikan Dengan Tidak Hormat' <?= $selected11;?>>Diberhentikan Dengan Tidak Hormat</option>   
											<option value='Pensiun' <?= $selected12;?>>Pensiun</option>   
											<option value='Mutasi Keluar' <?= $selected13;?>>Mutasi Keluar</option>   
											<option value='Mutasi Masuk' <?= $selected14;?>>Mutasi Masuk</option>   
											<option value='Menunggu Tugas' <?= $selected15;?>>Menunggu Tugas</option>    
										</select>
									</div>   
																		
								</div>
							</div>
						</div>
					</div>
							<div class="panel panel-default">
								<div class="panel-heading">
									Pengangkatan CPNS
								</div>
								<div class="panel-body">
									<div class="row">
										<div class="col-md-4">
											<div class="form-group">
												<label>TMT</label>
												<input class="form-control" name="cpns_tmt" id='cpns_tmt' value="" placeholder="yyyy-mm-dd">
											</div>
											
											<div class="form-group">
												<label>Gol. Ruang</label>
												<select class="form-control" id='cpns_id_golongan' name='cpns_id_golongan' >
												  <option value='' selected>Pilih</option>
												  <?php
													foreach ($golongan as $row ){
														$gol = ucwords(strtolower($row->golongan));
														$pkt1 = substr($row->pangkat,0,-1);
														$pkt2 = strtolower(substr($row->pangkat,-1));
														
														echo "<option value='$row->id_golongan' $selected>$gol, $pkt1$pkt2</option>";
													}
												  ?>
												
												</select>
												
											</div>
											
											<div class="form-group">
												<label>No. SK CPNS</label>
												<input class="form-control" name="cpns_no_sk" id='cpns_no_sk' value="">
											</div>
											
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label>No. Persetujuan BAKN</label>
												<input  class="form-control" name="cpns_no_bakn" id='cpns_no_bakn' value="">
											</div>
											<div class="form-group">
												<label>Pejabat</label>
												<input class="form-control" name="cpns_pejabat" id='cpns_pejabat' value="">
											</div>
											
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label>Pendidikan Saat CPNS</label>
												<select class="form-control" id='cpns_id_jenjangpendidikan' name='cpns_id_jenjangpendidikan'>
												  <option value='' selected>Pilih</option>
												  <?php
													foreach ($jenjangpendidikan as $row){
														echo "<option value='$row->id_jenjangpendidikan'>$row->nama_jenjangpendidikan</option>";
													}
												  ?>
												</select>
											</div>
											<div class="form-group">
												<label>Tahun Lulus Pendidikan</label>
												<input class="form-control" name="cpns_tahun_pendidikan" id='cpns_tahun_pendidikan' value="">
											</div>
											
											
										</div>                
										
									</div>  
								</div>  
							</div> 
							
							
													
							
							
							
							<div class="panel panel-default">
								<div class="panel-heading">
									Pengangkatan PNS
								</div>
								<div class="panel-body">
									<div class="row">
										<div class="col-md-3">
											<div class="form-group">
												<label>TMT</label>
												<input class="form-control" name="pns_tmt" id='pns_tmt' value="" placeholder='yyyy-mm-dd'>
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<label>Gol. Ruang</label>
												<select class="form-control" id='pns_id_golongan' name='pns_id_golongan' >
												  <option value='' selected>Pilih</option>
												  <?php
													foreach ($golongan as $row ){
														$gol = ucwords(strtolower($row->golongan));
														$pkt1 = substr($row->pangkat,0,-1);
														$pkt2 = strtolower(substr($row->pangkat,-1));
														
														echo "<option value='$row->id_golongan' $selected>$gol, $pkt1$pkt2</option>";
													}
												  ?>
												
												</select>
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<label>Pejabat</label>
												<input class="form-control" name="pns_pejabat" id='pns_pejabat' value="">
											</div>
										</div>                
										<div class="col-md-3">
											<div class="form-group">
												<label>No. SK</label>
												<input class="form-control" name="pns_no_sk" id='sk' value="">
											</div>
										</div>
									</div>  
								</div>  
							</div>  
							
							
							<div class="panel panel-default">
								<div class="panel-heading">
									Pangkat Terakhir
								</div>
								<div class="panel-body">
									<div class="row">
										<div class="col-md-3">
											<div class="form-group">
												<label>TMT</label>
												<input class="form-control" name="pns_tmt" id='pns_tmt' value="" placeholder='yyyy-mm-dd'>
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<label>Gol. Ruang</label>
												<select class="form-control" id='pns_id_golongan' name='pns_id_golongan' >
												  <option value='' selected>Pilih</option>
												  <?php
													foreach ($golongan as $row ){
														$selected = $pns_id_golongan == $row->id_golongan ? "selected" : "";
														$gol = ucwords(strtolower($row->golongan));
														$pkt1 = substr($row->pangkat,0,-1);
														$pkt2 = strtolower(substr($row->pangkat,-1));
														
														echo "<option value='$row->id_golongan' $selected>$gol, $pkt1$pkt2</option>";
													}
												  ?>
												
												</select>
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<label>Pejabat</label>
												<input class="form-control" name="pns_pejabat" id='pns_pejabat' value="">
											</div>
										</div>                
										<div class="col-md-3">
											<div class="form-group">
												<label>No. SK</label>
												<input class="form-control" name="pns_no_sk" id='sk' value="">
											</div>
										</div>
									</div>  
								</div>  
							</div>  
							
							<div class="panel panel-default">
								<div class="panel-heading">Unit Kerja Terakhir</div>
								<div class="panel-body">
									<div class="row">
									<div class="col-md-6">
										<div class="col-md-12">
											<div class="form-group">
												<label>Nama Unit Kerja</label>
												 <input class="form-control" value="">
											</div>
										</div>
										<div class="col-md-12">
											<div class="form-group">
												<label>Sub Unit Kerja</label>
												 <input class="form-control" value="">
											</div>
										</div>
										<div class="col-md-12">
											<div class="form-group">
												<label>Satuan</label>
												 <input class="form-control" value="">
											</div>
										</div>
										<div class="col-md-12">
											<div class="form-group">
												<label>Sub Unit 2</label>
												 <input class="form-control" value="">
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="col-md-12">
											<div class="form-group">
												<label>Alamat</label>
												<textarea class="form-control" ></textarea>
											</div>
										</div>  
										<div class="col-md-12">
											<div class="form-group">
												<label>Telepon</label>
												<input class="form-control"  value="">
											</div>
										</div>
										
										<div class="col-md-12">
											<div class="form-group">
												<label>Email</label>
												<input class="form-control" value="">
											</div>
										</div>
									</div>
										
									</div>
								</div>
							</div> 
							
					<div class="panel panel-default">
						<div class="panel-heading">Alamat
						</div>
						<div class="panel-body">
							<div class="row">
								<div class="col-md-4">
									<div class="form-group">
										<label>Alamat*</label>
										<textarea name="alamat"  id='alamat' class="form-control" rows="6"><?= $alamat;?></textarea>
									</div>  
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label>RT*</label>
										<input class="form-control" name="RT" id='RT' value="<?= $RT;?>">
									</div>
									<div class="form-group">
										<label>RW*</label>
										<input class="form-control" name="RW" id='RW' value="<?= $RW;?>">
									</div>
									<div class="form-group">
										<label>Kode POS</label>
										<input class="form-control" name="kode_pos" id='kode_pos' value="<?= $kode_pos;?>">
									</div>
									<div class="form-group">
										<label>Telepon</label>
										<input class="form-control" name="telepon" id='telepon' value="<?= $telepon;?>">
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label>Provinsi*</label>
										<select class='form-control' name='id_provinsi' id='id_provinsi' onchange='getKabupaten()'>
											<option value='' selected>Pilih</option> 
											<?php
												foreach($provinsi as $row){
													$selected = $row->id_provinsi == $id_provinsi ? "selected" : "";
													echo "<option value='$row->id_provinsi' $selected>$row->provinsi</option>";
												}
												
											?>
										</select>
									</div>
									<div class="form-group">
										<label>Kabupaten/Kota*</label>
										<select class='form-control' name='id_kabupaten' id='id_kabupaten' onchange='getKecamatan()'>
											<?php $kabupaten = $kabupaten==""? "Pilih" : $kabupaten;?>
											<option value='<?= $id_kabupaten;?>' selected><?= $kabupaten;?></option>             
										</select>
									</div>
									<div class="form-group">
										<label>Kecamatan*</label>
										<select class='form-control' name='id_kecamatan' id='id_kecamatan' onchange='getDesa()'>
											<?php $kecamatan = $kecamatan==""? "Pilih" : $kecamatan;?>
											<option value='<?= $id_kecamatan;?>' selected><?= $kecamatan;?></option>	
										</select>
									</div>
									<div class="form-group">
										<label>Kelurahan/Desa*</label>
										<select class='form-control' name='id_desa' id='id_desa'>
											<?php $desa = $desa=="" ? "Pilih" : $desa;?>
											<option value='<?= $id_desa;?>' selected><?= $desa;?></option>             
										</select>
									</div>  
								</div>  
							</div>
						</div>
					</div>  
					<div class="panel panel-default">
						<div class="panel-heading">
							Nomor-nomor Kartu
						</div>
						<div class="panel-body">
							<div class="row">
							<div class="col-md-12">
								<div class="col-md-4">
									<div class="form-group">
										<label>Kartu ASKES</label>
										<input class="form-control" name="kartu_askes" id='kartu_askes' value="<?= $kartu_askes;?>">
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label>Kartu TASPEN</label>
										<input class="form-control" name="kartu_taspen" id='kartu_taspen' value="<?= $kartu_taspen;?>">
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label>KARIS/KARSU</label>
										<input class="form-control" name="karis_karsu" id='karis_karsu' value="<?= $karis_karsu;?>">
									</div>
								</div> 
							</div>
							<div class="col-md-12">
								<div class="col-md-6">
									<div class="form-group">
										<label>NPWP</label>
										<input class="form-control" name="npwp" id='npwp' value="<?= $npwp;?>">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>NUPTK</label>
										<input class="form-control" name="npwp" id='npwp' value="<?= $npwp;?>">
									</div>
								</div>
							</div>
							</div>  
						</div>  
					</div>  
					<div class="panel panel-default">
						<div class="panel-heading">Keluarga</div>
						<div class="panel-body">
							<div class="row">
								<div class="col-md-4">
									<div class="form-group">
										<label>Status Perkawinan*</label>
										<select class='form-control' name='id_statusmenikah' id='id_statusmenikah'>
											<option value='' selected>Pilih</option>
											<?php
												foreach($statusmenikah as $row){
													$selected= $row->id_statusmenikah==$id_statusmenikah? "selected" : "";
													echo "<option value='$row->id_statusmenikah' $selected>$row->nama_statusmenikah</option>";
												}
												
											?>          
										</select>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label>Jumlah Tanggung Anak</label>
										<input class="form-control" name="jml_tanggungan_anak"  id='jml_tanggungan_anak' value="<?= $jml_tanggungan_anak;?>">
									</div>
								</div>  
								<div class="col-md-4">
									<div class="form-group">
										<label>Jumlah Seluruh Anak</label>
										<input class="form-control" name="jml_seluruh_anak" id='jml_seluruh_anak' value="<?= $jml_seluruh_anak;?>">
									</div>
								</div>
							</div>
						</div>
					</div>  
					<div class="panel panel-default">
						<div class="panel-heading">File Foto</div>
						<div class="panel-body">
								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
										<label>Upload Foto</label>
										<br />
										<img width="100px" height="120px" src="">
										<br />
										<br />
										<label>Ukuran foto maksimal <?= $max_size."KB (".$max_width." x ".$max_height." pixel)"?></label>
										<input type="file" class="form-control" name="userfile" placeholder="Tidak ada File"> 
										</div>
									</div>
								</div>
						</div>
					</div>
					
					<button type='submit' class='btn btn-primary'>Submit</button>
					<a href='<?= base_url();?>master_pegawai' class='btn btn-default'>Back</a>
					<label>*Wajib</label>
				</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- Small modal -->
                  
                  <div class="modal fade search-from-master" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-sm">
                      <div class="modal-content">

                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel2">Cari NIP</h4>
                        </div>
                        <div class="modal-body">
							<input class="form-control" name="nip_master" id='nip_master'>
						</div>
                        <div class="modal-footer">
                          <button type="button" onclick='getFromMaster()' class="btn btn-default" data-dismiss="modal">OK</button>
                        </div>

                      </div>
                    </div>
                  </div>
                  <!-- /modals -->
<script>
	function getFromMaster(){
		var nip_master = $('#nip_master').val();
		$.post("<?= base_url();?>master_pegawai/getFromMaster",{'nip_master':nip_master},function(response){
			var data = JSON.parse(response);
			//console.log(data[0]);
			if (data[0]!=undefined){
				$('#nip_lama').val(data[0].NIPLAMA);
				$('#nip_baru').val(data[0].NIP);
				$('#karpeg').val(data[0].KARPEG);
				$('#nama_lengkap').val(data[0].NAMA);
				$('#tempat_lahir').val(data[0].TEMLAHIR);
				$('#tgl_lahir').val(data[0].TGLLAHIR);
				$('#alamat').html(data[0].NALAMAT);
				$('#RT').val(data[0].RT);
				$('#RW').val(data[0].RW);
				$('#kode_pos').val(data[0].KODEPOS);
				$('#telepon').val(data[0].TELEPON);
				var jk = data[0].KELAMIN;
				$('#jenis_kelamin'+jk).attr('checked',true);
				/*
				var bayar_gaji = data[0].BAYARGAJI;
				if (bayar_gaji=="Kas Daerah Sumedang") {
					$('#bayar_gaji2').attr('checked',false);
					$('#bayar_gaji1').attr('checked',true);
					
				}
				else{
					$('#bayar_gaji2').attr('checked',true);
					$('#bayar_gaji1').attr('checked',false);
				}
				*/
			}
			else{
				//$('#status').html('Data tidak ditemukan');
				//$('#pesan').show();
				alert('data tidak ditemukan');
			}
		});
		
		
	}
	function hideMe()
	{$('#pesan').hide();}
	
	function getKabupaten(){
		var id = $('#id_provinsi').val();
		$('#id_desa').html('<option value="">Pilih</option>');
		$('#id_kecamatan').html('<option value="">Pilih</option>');
		$.post("<?= base_url();?>master_pegawai/get_kabupaten/"+id,{},function(obj){
			$('#id_kabupaten').html(obj);
		});
		
	}
	function getKecamatan(){
		$('#id_desa').html('<option value="">Pilih</option>');
		var id = $('#id_kabupaten').val();
		$.post("<?= base_url();?>master_pegawai/get_kecamatan/"+id,{},function(obj){
			$('#id_kecamatan').html(obj);
		});
		
	}
	function getDesa(){
		var id = $('#id_kecamatan').val();
		$.post("<?= base_url();?>master_pegawai/get_desa/"+id,{},function(obj){
			$('#id_desa').html(obj);
		});
	}
</script>