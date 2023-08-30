<div class="container-fluid">
    <div class="row bg-title">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title">Arsip Surat Masuk</h4> 
            </div>
			<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
				<ol class="breadcrumb">
					<li class="active">Arsip Surat Masuk</li>				
                </ol>
			</div>
			<!-- /.col-lg-12 -->
		</div>
        <div class="row">
        <div class="col-md-12">
            <div class="white-box">
                <div class="row">
                    <form method="POST">
                        <div class="col-md-9">
                            <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Nama Surat</label>
                                    <input type="text" name="key" id="" class="form-control" placeholder="Nama Surat">
                                </div>
                            </div>
                                <div class="form-group">
                                    <label>Periode Tanggal Surat </label>
                                    <div class="input-daterange input-group" id="datepicker">
                                            <input type="text" class="form-control" name="start" placeholder="Start" />
                                            <span class="input-group-addon bg-primary b-0 text-white">Sampai</span>
                                            <input type="text" class="form-control" name="end" placeholder="End" />
                                        </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 text-center">
                        <div class="row">
                            <div class="form-group">
                                <br>
                                <button type="submit" class="btn btn-primary m-t-5 btn-outline"><i class="ti-filter"></i> Verifikasi</button>
                            </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-4">
				
		</div>
			<div class="col-md-8">
				<div class="white-box">
					<div class="row" >
						<div class="col-md-2 col-sm-2 text-center b-r" style="min-height:70px;" >
							<img src="<?php echo base_url('asset/logo/surat.png');?>" width="80px" height="60px" alt="">
						</div>
						<div class="col-md-10 col-sm-10"  >
							<div class="row b-b">
								<div class="col-md-12 text-center">
									Status Surat
								</div>
							</div>
							<div class="row">
								<div class="col-md-4 text-center b-r">
									<h3 class="box-title m-b-0"><?=count($total)?></h3>
									Total Surat
								</div>
								<div class="col-md-4 text-center b-r">
									<h3 class="box-title m-b-0"><?=count($archived)?></h3>
									Sudah Diarsipkan
								</div>
								<div class="col-md-4 text-center b-r ">
									<h3 class="box-title m-b-0"><?=count($unarchived)?></h3>
									Belum Diarsipkan
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

						  <?php if(count($total) == 0){
									echo "<div class='alert alert-danger'>Belum ada Surat</div>";
								}else{ ?>
						  <?php foreach($list as $l){
						     	if($l->status_arsip == 'Sudah Diarsipkan'){
								  $label_status = "primary";
							  }elseif ($l->status_arsip == 'Belum Diarsipkan') {
								  $label_status = "danger";
							  };
						  	?>
						<div class="col-md-4 col-sm-6" >
							<div class="panel panel-<?=$label_status?>">
								<div class="panel-heading">
									<?=humanize($l->status_arsip)?>
									<span class="badge pull-right" style="background-color: white;color:black;"><?=humanize($l->sifat)?></span>
								</div>
								<div class="panel-body">
									<div class="row b-b" style="min-height: 30px;">
										<div class="col-md-4 col-sm-4 text-center b-r">
											<i data-icon="&" class="linea-icon linea-basic text-<?=$label_status?>" style="font-size:80px;"></i>
										</div>
										<div class="col-md-8 col-sm-8"  >
											<h5><?=$l->perihal?></h5>
										</div>
									</div>
									<div class="row b-b">
										<div class="col-md-12 text-center">
											<h6>Pengirim</h6>
											<h5><?=$l->pengirim?></h5>
											<span class="badge badge-<?=$label_status?>" style="font-size:10px;"><?=tanggal($l->tanggal_surat)?></span>
										</div>
									</div>
									<div class="row b-b">
										<div class="col-md-12 text-center">
											<h6>Penerima</h6>
											<h5><?=$l->nama_skpd?></h5>
											<span class="badge badge-<?=$label_status?>" style="font-size:10px;"><?=tanggal($l->tgl_input)?></span>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<br>
											<address>
												<a href="<?php echo base_url();?>renstra_perencanaan/view">
													<a href="<?php echo base_url('arsip_surat/detail_surat_masuk/'.$l->id_surat_masuk);?>" class="fcbtn btn btn-<?=$label_status?> btn-outline btn-1b btn-block">Detail Surat</a>
												</a>
											</address>
										</div>
									</div>
								</div>
							</div>
						</div>
						<?php }} ?>
					</div>
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