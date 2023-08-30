
<div class="container-fluid">
	
	<div class="row bg-title">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title">UMKM</h4> </div>
			<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12"> 
				<ol class="breadcrumb">
					<li class="active">UMKM</li>				</ol>
				</div>
				<!-- /.col-lg-12 -->
			</div>


			<div class="row">
				<div class="col-md-12">
					<div class="white-box">
						<div class="row">
							<!-- <div class="col-md-2 b-r">
								<a href="<?php echo base_url();?>profil/umkm/add">
									<button class="btn btn-primary m-t-15 btn-block"><i class="ti-plus" data-toggle="modal" data-target="#modal_add_new"></i> Tambah Umkm</button>
								</a>
							</div> -->
							<form method="GET">
							<!-- <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>" /> -->
														
								<div class="col-md-3">
									<div class="form-group">
										<label>Nama UMKM </label>
										<input type="text" class="form-control" placeholder="Cari berdasarkan Nama umkm" name="keyword" value="<?=set_value('keyword', (isset($_GET['keyword']) ? $_GET['keyword'] : null))?>">
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<label>Kecamatan </label>
										<select name="kecamatan" class="form-control select2">
                                            <option value="">- Pilih Kecamatan -</option>
                                            <?php foreach($kecamatan as $item) { ?>
                                                <option value="<?=$item->id_kecamatan?>" <?=isset($_GET['kecamatan']) ? (set_select('kecamatan',$item->id_kecamatan,($item->id_kecamatan == $_GET['kecamatan']) ? TRUE : FALSE)) : null?>><?=$item->kecamatan?></option>
                                            <?php } ?>
                                        </select>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<label>Desa </label>
										<select name="desa" class="form-control select2">
                                            <option value="">- Pilih Desa -</option>
                                            <?php foreach($desa as $item) { ?>
                                                <option value="<?=$item->id_skpd?>" <?=isset($_GET['desa']) ? (set_select('desa',$item->id_skpd,($item->id_skpd == $_GET['desa']) ? TRUE : FALSE)) : null?>><?=$item->nama_skpd?></option>
                                            <?php } ?>
                                        </select>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<br>
										<button type="submit" class="btn btn-primary m-t-5 btn-outline"><i class="ti-filter"></i> Filter</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
			<div class="row">

			<div class="col-md-12">
			<div class="white-box" style="border-left: solid 3px #6003c8">
					<div class="row">
						<div class="col-md-2 col-sm-2 text-center b-r" style="min-height:70px;">
						<i  class="icon-basket" style="font-size: 50px;color:#6003c8"></i> 
						</div>
						<div class="col-md-10 col-sm-10">
							<div class="row b-b">
							<div class="col-md-12 text-center" style="color: #6003c8">
								<b>Status UMKM</b>
							</div>
							</div>
						<div class="row">
							<div class="col-md-4 text-center b-r">
								<h3 class="box-title m-b-0"><?= number_format($umkm->total) ;?></h3>
								<a style="color: #6003c8" href="<?= base_url();?>umkm/beranda">Total UMKM</a>
							</div>
							<div class="col-md-4 text-center b-r">
								<h3 class="box-title m-b-0"><?= number_format($umkm->belum_diverifikasi) ;?></h3>
								<a style="color: #6003c8" href="<?= base_url();?>umkm/beranda?keyword=<?=isset($_GET['keyword']) ? $_GET['keyword'] : null?>&kecamatan=<?=isset($_GET['kecamatan']) ? $_GET['kecamatan'] : null?>&desa=<?=isset($_GET['desa']) ? $_GET['desa']: null?>&status=Belum diverifikasi">Belum diverifikasi</a>
							</div>
							<div class="col-md-4 text-center b-r ">
								<h3 class="box-title m-b-0"><?= number_format($umkm->sudah_diverifikasi) ;?></h3>
								<a style="color: #6003c8" href="<?= base_url();?>umkm/beranda?keyword=<?=isset($_GET['keyword']) ? $_GET['keyword']: null?>&kecamatan=<?=isset($_GET['kecamatan']) ? $_GET['kecamatan']: null?>&desa=<?=isset($_GET['desa']) ? $_GET['desa']: null?>&status=Terverifikasi">Terverifikasi</a>
							</div>
						
						</div>
						</div>
					</div>
				</div>
			</div>

			</div>

			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12">

					<div class="x_content">

						<?php foreach($umkm->data as $l){
							
							?>

							<div class="col-md-4 col-sm-6">
								<div class="white-box">
									<div class="row b-b" style="min-height: 120px;" >
										<div class="col-md-4 col-sm-4 text-center b-r" style="min-height: 120px;padding: 5%">
											<i class="icon-handbag" style="font-size: 50px;color:#6003c8"></i> 
											
										</div>
										<div class="col-md-8 col-sm-8">
											<br>
											<h3 class="box-title m-b-0"><?=$l->nama_umkm?></h3>
											
											
										</div>
									</div>


									<div class="row b-b">
										<div class="col-md-6 b-r text-center" style="padding-bottom: 20px;">
											<h3 class="box-title m-b-0">Status umkm</h3>
											<div class="label label-table label-<?=($l->status == 'Terverifikasi')?'success':'danger'?>"><?=$l->status?></div>

										</div>

									
										<div class="col-md-6 text-center">
											<h3 class="box-title m-b-0">Pemilik</h3>
											<?=$l->nama_pemilik ?: '-'?>
										</div>
									</div>

									<div class="row">
										<div class="col-md-12">
											<br>
											<address>
												<a href="<?php echo base_url();?>umkm/beranda/view/<?=$l->slug_umkm?>">
													<button class="fcbtn btn btn-primary btn-outline btn-1b btn-block">Detail UMKM</button>
												</a>
											</address>
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
								echo $umkm->pagination;
								?>
							</div>
						</div>

					</div>
				</div>
