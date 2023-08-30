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
</div>