<div class="container-fluid">

	<div class="row bg-title">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title">Kenaikan Gaji Berkala</h4> </div>
			<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
				<ol class="breadcrumb">
					<?php echo breadcrumb($this->uri->segment_array()); $skrng = new DateTime (date("Y-m-d"));?>
				</ol>
			</div>
			<!-- /.col-lg-12 -->
		</div>


<div class="row">
	<div class="col-md-12">
		<div class="white-box">
			<div class="row">
				<!-- <div class="col-md-3 b-r">
					<a href="<?php echo base_url(). "master_pegawai/add" ;?>">
					<button  class="btn btn-primary m-t-15 btn-block">Tambah Pegawai</button>
				</a>
				</div> -->
				<form method="POST">
					<div class="col-md-3">
						<div class="form-group">
							<label>Nama Lengkap</label>
                  <input type="text" class="form-control" placeholder="Cari berdasarkan Nama Lengkap" name="nama_lengkap" value="<?=($filter) ? $filter_data['nama_lengkap'] : ''?>">
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label>NIP</label>
                  <input type="text" class="form-control" placeholder="Cari berdasarkan NIP" name="nip" value="<?=($filter) ? $filter_data['nip'] : ''?>">
						</div>
					</div>
					<?php if($user_level=='Administrator'){ ?>
					<div class="col-md-3">
						<div class="form-group">
							<label for="exampleInputEmail1">SKPD</label>
							<select name="id_skpd" class="form-control select2">
								<option value="">Pilih SKPD</option>
								<?php
								foreach($skpd as $s){
									if($filter){
										if($filter_data['id_skpd']==$s->id_skpd){
											$selected = ' selected';
										}else{
											$selected = '';
										}
									}else{
										$selected = '';
									}
									echo'<option value="'.$s->id_skpd.'"'.$selected.'>'.$s->nama_skpd.'</option>';
								}
								?>
							</select>
						</div>
					</div>
					<?php } ?>
					<div class="col-md-3">
              <div class="form-group">
                <br>
                <button type="submit" class="btn btn-primary m-t-5 btn-outline"><i class="ti-filter"></i>Filter</button>
                <?php
                if($filter){
                  ?>
                  <a href="" class="btn btn-default m-t-5"><i class="ti-back-left"></i> Reset</a>
                  <?php
                }
                ?>
              </div>
					</div>

				</form>
			</div>

		</div>
	</div>

</div>


<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">

		<div class="x_content">

			<?php
			$CI =& get_instance();
			foreach ($list as $l){
				$CI->load->model('pegawai_model');
			$cek_user = $CI->pegawai_model->cek_user($l->id_pegawai);
				?>
						<div class="col-md-4 col-sm-4">
							<div class="white-box">
								<div class="row">
									<div class="col-md-12">
										<div class="row" style="background-color: #6003c8;padding: 5px;border-radius: 2px;margin-bottom: 10px;">
											<div class="col-md-2 lihat">
												<div class="gambar">
													<img src="<?=base_url('data/foto/pegawai/'.$l->foto_pegawai.'')?>" class="img-circle img-responsive" style="max-width: 50px; max-height: 50px;">
												</div>
											</div>
											<div class="col-md-10">
												<h3 class="box-title m-b-0 text-white text-truncate" style="overflow: hidden; white-space: nowrap;text-overflow: ellipsis;"><?=$l->nama_lengkap?></h3> <small class="text-white"><?=$l->nip?></small>
											</div>
										</div>
										<div style="height: 155px;display: table-cell;vertical-align: middle;text-align: center !important;width: 999px">
											<span class="" style="font-size:12px;font-weight: 500"><i class="text-primary ti-flag-alt-2"></i> SKPD</span>
											<p><?=$l->nama_skpd?></p>
											<span class="" style="font-size:12px;font-weight: 500"><i class="ti-briefcase text-primary"></i> Unit Kerja</span>
											<p><?=$l->nama_unit_kerja?></p>
										</div>
										<div style="height: 175px; overflow-y: hidden;">
				                            <div class="steamline">
				                            	<?php if (@$data_pegawai[$l->id_pegawai]->cpns_id_golongan>0 AND $prediksi_kgb[$l->id_pegawai]): 
                                            		$tanggal_prediksi_kgb = date("Y-m-d", strtotime(date("Y-m-d", strtotime($data_pegawai[$l->id_pegawai]->cpns_tmt)) . " +{$prediksi_mkg[$l->id_pegawai]} year -{$data_pegawai[$l->id_pegawai]->mkg_tahun_awal} year -{$data_pegawai[$l->id_pegawai]->mkg_bulan_awal} month"));
				                            		$awal_prediksi = new DateTime ($tanggal_prediksi_kgb);
				                            		$tanggal_prediksi = $skrng->diff($awal_prediksi);
				                            		if ($tanggal_prediksi->format('%r%a')>0) {
				                            			$hari_prediksi = $tanggal_prediksi->format('%r%a HARI LAGI'); 
				                                  		$jenis_prediksi = "prediksi";
				                            		} elseif ($tanggal_prediksi->format('%r%a')<0) {
				                            			$hari_prediksi = $tanggal_prediksi->format('%a HARI LALU'); 
				                                  		$jenis_prediksi = "rekomendasi";
				                            		} else {
				                            			$hari_prediksi = "HARI INI";
				                                  		$jenis_prediksi = "rekomendasi";
				                            		}
				                            		if ($tanggal_prediksi->format('%r%a')<100):
				                            		?>
					                                <div class="sl-item b-b">
					                                    <div class="sl-left"> <a href="<?=base_url('kenaikan_gaji_berkala/view/'.$l->id_pegawai)?>#riwayat-kgb" class="btn btn-primary btn-outline btn-block"><i class="fa fa-edit"></i> Buat</a> </div>
					                                    <div class="sl-right">
					                                        <div><a href="#!"><?="Rp".number_format($prediksi_kgb[$l->id_pegawai]->gaji_pokok,0,',','.').',-'?> (<?=$jenis_prediksi?>)</a> <span class="sl-date"><?=tanggal($tanggal_prediksi_kgb)?></span> <span class="label label-rouded label-info pull-right"><?=$hari_prediksi?></span></div>
					                                        <p>Masa kerja <?=$prediksi_kgb[$l->id_pegawai]->mkg?> tahun dalam golongan <?=$prediksi_kgb[$l->id_pegawai]->pangkat?> <p class="text-right sl-date">*dapat berubah sewaktu-waktu</p></p>
					                                    </div>
					                                </div>
					                                <?php endif ?>
				                            	<?php elseif (@!$l->cpns_id_golongan>0): ?>
					                                <div class="sl-item">
					                                    <div class="sl-left"> <a class="btn btn-primary btn-outline btn-block" href="<?=base_url('kenaikan_gaji_berkala/view/'.$l->id_pegawai)?>#riwayat-kgb"><i class="fa fa-edit"></i> Update</a> </div>
					                                    <div class="sl-right">
					                                    	<span class=""> Golongan awal CPNS tidak ditemukan.</span>
					                                    </div>
					                                </div>
				                            	<?php endif ?>
				                                <?php if (count($riwayat_kgb[$l->id_pegawai])>0): ?>
					                                <?php $gaji_sekarang=false; foreach ($riwayat_kgb[$l->id_pegawai] as $r_kgb): ?>
					                                <div class="sl-item">
					                                    <div class="sl-left"> 
					                                      <?php if ($r_kgb->id_riwayat_kgb_lama>0): ?>
					                                        <a href="<?=base_url('kenaikan_gaji_berkala/cetak_kgb/'.$r_kgb->id_riwayat_kgb)?>" target="_blank" class="btn btn-primary btn-outline btn-block"><i class="fa fa-print"></i> Lihat</a>
					                                      <?php elseif ($r_kgb->mkg>0): ?>
					                                        <a href="<?=base_url('kenaikan_gaji_berkala/view/'.$l->id_pegawai)?>#riwayat-kgb" class="btn btn-primary btn-outline btn-block"><i class="fa fa-edit"></i> Buat</a>
					                                      <?php else: ?>
					                                        <a href="#!" class="btn btn-primary btn-outline btn-xs btn-block"> Gaji Pertama</a>
					                                      <?php endif ?>
					                                    </div>
					                                    <div class="sl-right">
					                                        <div>
					                                          <a href="#!"><?="Rp".number_format($r_kgb->gaji_pokok,0,',','.').',-'?></a> 
					                                          <span class="sl-date"><?=tanggal($r_kgb->terhitung_mulai_tanggal)?></span> 
					                                          <?php if ((!$r_kgb->terakhir_dicetak==null OR $r_kgb->mkg==0) AND $gaji_sekarang==false): $gaji_sekarang=true;?>
					                                            <span class="label label-rouded label-purple pull-right">GAJI SEKARANG</span>
					                                          <?php elseif ($r_kgb->terakhir_dicetak==null AND $r_kgb->mkg>0): ?>
					                                            <span class="label label-rouded label-danger pull-right">BELUM DICETAK</span>
					                                          <?php endif ?>
					                                            
					                                        </div>
					                                        <p>Masa kerja <?=$r_kgb->mkg?> tahun dalam golongan <?=$r_kgb->pangkat?></p>
					                                    </div>
					                                </div>
					                                <?php endforeach ?>
				                                <?php else: ?>
				                                <div class="sl-item">
				                                    <div class="sl-left"> <span class="btn btn-primary btn-outline btn-block"> Belum Ada Riwayat</span> </div>
				                                    <div class="sl-right">
				                                    	<span class=""> Tambah Riwayat terlebih dahulu.</span>
				                                    </div>
				                                </div>
				                                <?php endif ?>
				                            </div>
										</div>
										<a href="<?=base_url('kenaikan_gaji_berkala/view/'.$l->id_pegawai)?>" class="fcbtn btn btn-outline btn-primary btn-1c btn-block"><i class="ti-pencil"></i> Lihat Lebih Detail</a>
									</div>
								</div>
							</div>
						</div>
				<?php } ?>
				<!-- /.col -->
			</div>

					<div class="row">
						<div class="col-md-12 pager">
							<?php
							if(!$filter){
								echo make_pagination($pages,$current);
							}
							?>
						</div>
					</div>

		</div>

	</div>
</div>

<script type="text/javascript">
	function delete_(id)
	{
		$('#confirm_title').html('Konfirmasi');
		$('#confirm_content').html('Apakah anda yakin akan menghapus data pegawai?');
		$('#confirm_btn').html('Hapus');
		$('#confirm_btn').attr('href',"<?php echo base_url();?>master_pegawai/delete/"+id);
	}

</script>
