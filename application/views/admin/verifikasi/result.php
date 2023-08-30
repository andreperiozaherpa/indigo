<div class="container-fluid">
    <div class="row bg-title">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title">Verifikasi</h4> 
            </div>
			<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
				<ol class="breadcrumb">
					<li class="active">Verifikasi</li>				
                </ol>
			</div>
			<!-- /.col-lg-12 -->
		</div>
       <div class="row">
        <div class="col-md-12">
            <div class="white-box">
                <div class="row">
                    <form action="<?=base_url('verifikasi/search');?>" method="POST">
                        <div class="col-md-9">
                            <div class="row">
                                <div class="form-group">
                                    <label>Nomor Surat </label>
                                    <input type="text" class="form-control" placeholder="Cari berdasarkan Nomor Surat" name="no_surat" value="">
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
    </div>
    <div class="row">
        <div class="col-md-12"> 

            <?php if(count($result) == 0){ ?>
                <div class="row">
							<div class="alert" style="background-color:#F65193;">
								<span class="fa fa-bell" style="color:white"></span>
                                <div class="text-center">
                                 <p style="color:yellow">Informasi</p>
                                 <p style="color:white">Surat dengan Nomer <b><?=($filter) ? $filter_data['no_surat'] : ''?></b> Tidak ditemukan</p>
                                </div>
							</div>
						</div>
                 </div>
            <?php }else{ ?>
            <?php foreach ($result as $r) : ?>
                <div class="row">
							<div class="alert" style="background-color:#A3A0FB;">
								<span class="fa fa-bell" style="color:white"></span>
                                <p class="text-center" style="color:yellow">Informasi</p>
                                <p class="text-center" style="color:white">Surat dengan Nomor <b><?=$r->nomer_surat?></b> Terdaftar di server e-Office Kab. Sumedan</p>
							</div>
						</div>
                 </div>
                 <div class="col-md-3">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_content">
                            <div class="col-md-12 col-sm-6" >
                            <div class="panel panel-primary">
                                <div class="panel-heading text-center">
                                Detail Surat
                                </div>
                                <div class="panel-body">
                                <div class="row b-b" style="max-height: 120px;">
                                    <div class="text-center">
                                    <h1 data-icon="&" class="linea-icon linea-basic" style="font-size:80px;color:#6003c8;"></h1>
                                    </div>
                                </div>
                                <div class="row b-b">
                                    <div class="col-md-12 text-center">
                                    <h6>Pengirim</h6>
                                    <h5><?=$r->nama_skpd?> / <?=$r->nama_unit_kerja;?></h5>
                                    <span class="badge" style="background-color: grey;font-size:10px;"><?=tanggal($r->tgl_buat)?></span>
                                    </div>
                                </div>
                                <div class="row b-b">
                                    <div class="col-md-12 text-center">
                                    <h6>Penerima</h6>
                                    <h5><?=$r->nama_skpd?> / <?=$r->nama_unit_kerja;?></h5>
                                    <span class="badge" style="background-color: grey;font-size:10px;"><?=tanggal($r->tgl_surat)?><</span>
                                    </div>
                                </div>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                    </div>
                    </div>
                    <div class="col-md-9">
                        <div class="row">
                            <div class="col-md-12">
                            <div class="panel panel-primary">
                                <div class="panel-heading">

                                </div>
                                <div class="panel-body">
                                <?=$r->perihal?>
                                <br>
                                <br>
                                    <div class="col-md-12">
                                    <table class="table b-b">
                                        <tr><td style="width: 100px;">No Surat </td><td>:</td><td> <strong><?=$r->nomer_surat?></strong></tr>
                                        <tr><td style="width: 100px;">Sifat</td><td>:</td><td> <strong><?=$r->sifat_surat?></strong></tr>
                                    </table>
                                    </div>                    <!--/span-->
                                </div>
                            </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="panel panel-default">
                            <div class="panel-body">
                                <iframe src="https://docs.google.com/viewer?url=http://e-sakip.sumedangkab.go.id/v1/data/upload_berkas/LKIIP+2017+SMD.pdf
                                &embedded=true" width="720"
                                height="700"
                                style="border: none;"></iframe>
                            </div>
                            </div>

                            <br>
                            <div class="col-md-12">
                            <div class="col-md-10"></div>
                            <div class="col-md-2">
                                    Lampiran
                            <div class="panel panel-default text-center">
                                <br>
                                <i class="fa fa-file-text" style="font-size:60px;" ></i>
                                <br>
                                <a href="#" class="btn btn-primary btn-block">Download</a>
                            </div>
                            </div>
                            
                            </div>

                        </div>
                        </div>
    
                 <?php endforeach;?>
           <?php };?>
        </div>
    </div>
</div>