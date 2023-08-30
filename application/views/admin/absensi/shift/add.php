<div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Tambah Shift</h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

                        <ol class="breadcrumb">
							<li>
								<a href="<?php echo base_url();?>admin"><i class="entypo-home"></i>Absen</a>
							</li>
							<li>
								<a href="<?php echo base_url();?>absen/shift">Shift</a>
							</li>
							<li class="active">
								<strong>Tambah</strong>
							</li>
                        </ol>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- .row -->
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <div class="white-box">

<div class="row">
	<div class="col-md-12 col-sm-12">

		<div class="panel panel-primary" data-collapsed="0">



			</div>
			<div class="panel-body">
				<?php if (!empty($message)) echo "
				<div class='alert alert-$message_type'>$message</div>";?>
				<form role="form" class="form-horizontal " method='post' enctype="multipart/form-data">

					<div class="form-group">
						<label class="col-sm-5 control-label">Nama Shift</label>
						<div class="col-sm-7">
							<input type="text" class="form-control" id='nama_shift' name='nama_shift' placeholder="">
						</div>
					</div>

          <div class="form-group">
						<label class="col-sm-5 control-label">Jam Masuk</label>
						<div class="col-sm-7">
              <div class="input-group clockpicker " data-placement="bottom" data-align="top" data-autoclose="true">
                  <input type="text" class="form-control" value="" name="jam_masuk">
                  <span class="input-group-addon"> <span class="glyphicon glyphicon-time"></span> </span>
              </div>
						</div>
					</div>
          <div class="form-group">
						<label class="col-sm-5 control-label">Jam Pulang</label>
						<div class="col-sm-7">
              <div class="input-group clockpicker " data-placement="bottom" data-align="top" data-autoclose="true">
                  <input type="text" class="form-control" value="" name="jam_pulang">
                  <span class="input-group-addon"> <span class="glyphicon glyphicon-time"></span> </span>
              </div>
						</div>
					</div>
          <?php
          foreach ($hariArr as $key => $value):
            $id = $key + 1;
            ?>
          <div class="form-group">
						<label for="hari<?=$id;?>" class="col-sm-5  control-label"><?=$value;?></label>
						<div class="col-sm-7">
              <input type="checkbox" value="Y" name="hari<?=$id;?>" id="hari<?=$id;?>" class="js-switch" data-color="#6164c1" data-size="small" />
						</div>
					</div>
        <?php endforeach?>
					<div class="form-group">
						<div class="col-sm-5"></div>
						<div class="col-sm-7">
							<button type="submit" class="btn btn-primary waves-effect waves-light" type="button"><span class="btn-label"><i class="fa fa-save"></i></span>Simpan</button>
              <a class="btn btn-default" href="/absensi/shift">Kembali</a>
            </div>

					</div>
				</form>

			</div>

		</div>
	</div>

</div>
</div>
                </div>
                <!-- /.row -->
            </div>
