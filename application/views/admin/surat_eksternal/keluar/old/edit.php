
        <div class="container-fluid">

	<div class="row bg-title">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title">Surat Eksternal</h4> </div>
			<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
				<ol class="breadcrumb">
					<li class="active">Tambah Surat Keluar</li>				</ol>
			</div>
			<!-- /.col-lg-12 -->
		</div>

    <div class="white-box">
      Surat Keluar - Eksternal
    </div>
		<div class="panel panel-default">
			<div class="panel-heading">
				Kepala surat
			</div>
			<div class="panel-body">
				<div class="col-md-12 ">
            <div class="form-group">
                <label>No. Surat</label>
                <input type="text" class="form-control" placeholder="Masukan no. surat">
            </div>
						<div class="form-group">
								<label>Perihal</label>
								<input type="text" class="form-control" placeholder="Masukan perihal surat">
						</div>
						<div class="form-group">
								<label>Lampiran</label>
								<input type="text" class="form-control" placeholder="Masukan daftar lampiran">
						</div>
						<div class="form-group">
							<div class="col-md-12">
								<label class="col-md-12">Sifat</label>
								<div class="col-lg-4 col-md-2 col-sm-4 col-xs-12">
										<div class="radio radio-primary">
												<input type="radio" name="radio1" id="radio1" value="option1">
												<label for="radio1"> Biasa </label><span class="badge badge-info pull-right"  data-toggle="tooltip" data-placement="top" title="Tooltip on top"><i class="ti-info" style="font-size:9px"></i></span>
										</div>
								</div>
								<div class="col-lg-4 col-md-2 col-sm-4 col-xs-12">
										<div class="radio radio-primary">
												<input type="radio" name="radio1" id="radio1" value="option1">
												<label for="radio1"> Penting </label><span class="badge badge-info pull-right"  data-toggle="tooltip" data-placement="top" title="Tooltip on top"><i class="ti-info" style="font-size:9px"></i></span>
										</div>
								</div>
								<div class="col-lg-4 col-md-2 col-sm-4 col-xs-12">
										<div class="radio radio-primary">
												<input type="radio" name="radio1" id="radio1" value="option1">
												<label for="radio1"> Rahasia </label><span class="badge badge-info pull-right"  data-toggle="tooltip" data-placement="top" title="Tooltip on top"><i class="ti-info" style="font-size:9px"></i></span>
										</div>
								</div>
							</div>
						</div>
						<br><br><br><br><br>
						<div class="form-group">
								<label>Dikirimkan kepada</label>
								<input type="text" class="form-control" placeholder="Masukan nama penerima">
						</div>
						<div class="form-group">
								<label>Di</label>
								<input type="text" class="form-control" placeholder="Masukan alamat penerima">
						</div>
        </div>
			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-heading">
				Badan Surat
			</div>
			<div class="panel-body">
          <div class="form-group">
              <textarea class="textarea_editor form-control" rows="15" placeholder="Enter text ..."></textarea>
          </div>
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label for="">Hari</label>
								<input type="text" name="" value="" placeholder="Masukan Hari" class="form-control">
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="">Tanggal</label>
                <input type="text" class="form-control" id="datepicker-autoclose" placeholder="mm/dd/yyyy">
              </div>
							</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="">Pukul</label>
                    <input type="text" class="clockpicker form-control" value="09:30" data-placement="bottom" data-align="top" data-autoclose="true">
							</div>
						</div>
					</div>
			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-heading">
				Penutup Surat
			</div>
			<div class="panel-body">
				<div class="form-group">
					<label class="col-md-12">Masukan Penutup</label>
					<input type="textarea" name="" value="" class="form-control" placeholder="Masukan Penutup">
				</div>
			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-heading">
				Entitas Surat
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label class="col-md-12">Pemeriksa</label>
							<input type="textarea" name="" value="" class="form-control" placeholder="Masukan Pemeriksa">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label class="col-md-12">Penandatangan</label>
							<input type="textarea" name="" value="" class="form-control" placeholder="Masukan Penandatangan">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label class="col-md-12" >Tembusan Surat</label>
							<input type="textarea" name="" value="" class="form-control" placeholder="Masukan Tembusan surat">
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="pull-right">
			<a href="<?php echo base_url('surat_eksternal/kategori_surat_keluar');?>" class="btn btn-default" style="background-color:grey;color:white;">Kembali</a>
			<a href="#" class="btn btn-warning">Simpan Draft</a>
			<a href="#" class="btn btn-primary">Simpan dan Download</a>
		</div>
