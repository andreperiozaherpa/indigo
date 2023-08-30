
<div class="container-fluid">

	<div class="row bg-title">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title">Catatan</h4> </div>
			<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
				<ol class="breadcrumb">
					<li class="active">Catatan</li>				</ol>
				</div>
				<!-- /.col-lg-12 -->
			</div>


			<div class="row">
            <div class="col-sm-12">
                <div class="white-box" style="border-top: 5px solid #6003c8;">
									<div class="panel panel-primary">
										<div class="panel-heading text-center">
											EDIT CATATAN
										</div>
									</div>
                    <form method="post">
											<input type="hidden" name="id_pegawai" value="<?php echo $catatan->id_pegawai; ?> ">
											<input type="hidden" name="id_skpd" value="<?php echo $catatan->id_skpd; ?> ">
											<div class="form-group">
												<label for="">Nama Catatan</label>
												<input type="text" class="form-control" name="nama_catatan" value="<?php echo $catatan->nama_catatan; ?> " placeholder="Nama Catatan">
											</div>
                        <div class="form-group">
													<label for="">Isi Catatan</label>
                            <textarea class="textarea_editor form-control" name="isi" value="" rows="15" placeholder="Isi Catatan ..."><?php echo $catatan->isi?> </textarea>
                        </div>
												<button type="submit" name="update" class="btn btn-primary" style="width:100px;">Update</button>
                    </form>
                </div>
            </div>
        </div>
