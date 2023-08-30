<div class="container-fluid">

  <div class="row bg-title">
    <!-- .page title -->
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
      <h4 class="page-title">Monitoring Kegiatan</h4>
    </div>
    <!-- /.page title -->
    <!-- .breadcrumb -->
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

      <ol class="breadcrumb">
        <li><a href="<?= base_url();?>/admin">Dashboard</a></li>
        <li class="active">Monitoring Kegiatan</li>
      </ol>
    </div>
    <!-- /.breadcrumb -->
  </div>
  <div class="row">
 		<div class="col-md-12">
 			<div class="white-box">
 				<div class="row">
 					<form method="POST">
 					<div class="col-md-3">
 						<div class="form-group">
 							<label for="">Unit Kerja</label>
 							<select name="tahun_berkas" class="form-control">
 								<option value="">Pilih Unit Kerja</option>
 								<option value="Inspektorat">Inspektorat</option>
                <option value="Kepala Dinas">Kepala Dinas</option>
              </select>
 						</div>
 					</div>
          <div class="col-md-6">
            	<label for="">Tanggal Kegiatan</label>
              <div class="input-daterange input-group" id="date-range">
                  <input type="text" class="form-control" name="start" placeholder="Dari"/>
                  <span class="input-group-addon bg-primary b-0 text-white">Sampai</span>
                  <input type="text" class="form-control" name="end" placeholder="" />
          </div>
          </div>
 					<div class="col-md-3">
 						<div class="form-group text-center">
 							<br>
 							<button type="submit" class="btn btn-primary btn-outline m-t-5">Verifikasi</button>
 						</div>
 					</div>
 				</form>
 				</div>

 			</div>
 		</div>

 	</div>
  <div class="row">
    <br>
    <div class="col-md-4 b-r">
      <div class="box-title text-center">
        <label>Daftar Pekerjaan</label>
      </div>
      <br>
      <div class="col-md-12">
      <div class="white-box">
          <span>Kegiatan Sosialisasi tentang Bahaya Narkotika</span>
          <div class="row">
            <div class="col-md-3">
              <div class="checkbox checkbox-info">
                <input type="checkbox" id="" name="1">
                <label for="1"> <span>10/8</span> </label>
              </div>
            </div>
            <div class="col-md-7">
              <div class="col-md-4">
                <div class="user-img">
                  <img src="<?php echo base_url('asset/pixel');?>/plugins/images/users/genu.jpg" alt="user" class="img-circle" width="40px" style="border:3px solid white">
                   <span class="profile-status online pull-right"></span>
                 </div>
              </div>
              <div class="col-md-4">
                <div class="user-img">
                  <img src="<?php echo base_url('asset/pixel');?>/plugins/images/users/genu.jpg" alt="user" class="img-circle" width="40px" style="border:3px solid white">
                   <span class="profile-status online pull-right"></span>
                 </div>
              </div>
              <div class="col-md-4">
                <div class="user-img">
                  <img src="<?php echo base_url('asset/pixel');?>/plugins/images/users/genu.jpg" alt="user" class="img-circle" width="40px" style="border:3px solid white">
                   <span class="profile-status online pull-right"></span>
                 </div>
              </div>
            </div>
            <div class="col-md-2">
              <div class="pull-right" style="margin-top:10px;">
                <a href="" class="icon-options-vertical" data-toggle="dropdown" style="font-size:20px;color:grey"></a>
                <ul role="menu" class="dropdown-menu">
                  <li>
                    <a href="#">Hai</a>
                  </li>
                  <li>
                    <a href="#">Hoi</a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <br>
          <div class="progress m-b-0">
            <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:0%;"> </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-4 b-r">
      <div class="box-title text-center">
        <label>Sedang Dikerjakan</label>
      </div>
      <br>
      <div class="col-md-12">
      <div class="white-box">
          <span>Kegiatan Sosialisasi tentang Bahaya Narkotika</span>
          <div class="row">
            <div class="col-md-3">
              <div class="checkbox checkbox-info">
                <input type="checkbox" id="" name="1">
                <label for="1"> <span>10/8</span> </label>
              </div>
            </div>
            <div class="col-md-7">
              <div class="col-md-4">
                <div class="user-img">
                  <img src="<?php echo base_url('asset/pixel');?>/plugins/images/users/genu.jpg" alt="user" class="img-circle" width="40px" style="border:3px solid white">
                   <span class="profile-status online pull-right"></span>
                 </div>
              </div>
              <div class="col-md-4">
                <div class="user-img">
                  <img src="<?php echo base_url('asset/pixel');?>/plugins/images/users/genu.jpg" alt="user" class="img-circle" width="40px" style="border:3px solid white">
                   <span class="profile-status online pull-right"></span>
                 </div>
              </div>
              <div class="col-md-4">
                <div class="user-img">
                  <img src="<?php echo base_url('asset/pixel');?>/plugins/images/users/genu.jpg" alt="user" class="img-circle" width="40px" style="border:3px solid white">
                   <span class="profile-status online pull-right"></span>
                 </div>
              </div>
            </div>
            <div class="col-md-2">
              <div class="pull-right" style="margin-top:10px;">
                <a href="" class="icon-options-vertical" data-toggle="dropdown" style="font-size:20px;color:grey"></a>
                <ul role="menu" class="dropdown-menu">
                  <li>
                    <a href="#">Hai</a>
                  </li>
                  <li>
                    <a href="#">Hoi</a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <br><div class="progress m-b-0">
      <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:20%;">
      </div>
      </div>
        </div>
      </div>
      <div class="col-md-12">
      <div class="white-box">
          <span>Kegiatan Sosialisasi tentang Bahaya Narkotika</span>
          <div class="row">
            <div class="col-md-3">
              <div class="checkbox checkbox-info">
                <input type="checkbox" id="" name="1">
                <label for="1"> <span>10/8</span> </label>
              </div>
            </div>
            <div class="col-md-7">
              <div class="col-md-4">
                <div class="user-img">
                  <img src="<?php echo base_url('asset/pixel');?>/plugins/images/users/genu.jpg" alt="user" class="img-circle" width="40px" style="border:3px solid white">
                   <span class="profile-status online pull-right"></span>
                 </div>
              </div>
              <div class="col-md-4">
                <div class="user-img">
                  <img src="<?php echo base_url('asset/pixel');?>/plugins/images/users/genu.jpg" alt="user" class="img-circle" width="40px" style="border:3px solid white">
                   <span class="profile-status online pull-right"></span>
                 </div>
              </div>
              <div class="col-md-4">
                <div class="user-img">
                  <img src="<?php echo base_url('asset/pixel');?>/plugins/images/users/genu.jpg" alt="user" class="img-circle" width="40px" style="border:3px solid white">
                   <span class="profile-status online pull-right"></span>
                 </div>
              </div>
            </div>
            <div class="col-md-2">
              <div class="pull-right" style="margin-top:10px;">
                <a href="" class="icon-options-vertical" data-toggle="dropdown" style="font-size:20px;color:grey"></a>
                <ul role="menu" class="dropdown-menu">
                  <li>
                    <a href="#">Hai</a>
                  </li>
                  <li>
                    <a href="#">Hoi</a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <br><div class="progress m-b-0">
      <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:70%;">
      </div>
      </div>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="box-title text-center">
        <label>Selesai Dikerjakan</label>
      </div>
      <br>
      <div class="col-md-12">
      <div class="white-box">
          <span>Kegiatan Sosialisasi tentang Bahaya Narkotika</span>
          <div class="row">
            <div class="col-md-3">
              <div class="checkbox checkbox-info">
                <input type="checkbox" id="" name="1">
                <label for="1"> <span>10/8</span> </label>
              </div>
            </div>
            <div class="col-md-7">
              <div class="col-md-4">
                <div class="user-img">
                  <img src="<?php echo base_url('asset/pixel');?>/plugins/images/users/genu.jpg" alt="user" class="img-circle" width="40px" style="border:3px solid white">
                   <span class="profile-status online pull-right"></span>
                 </div>
              </div>
              <div class="col-md-4">
                <div class="user-img">
                  <img src="<?php echo base_url('asset/pixel');?>/plugins/images/users/genu.jpg" alt="user" class="img-circle" width="40px" style="border:3px solid white">
                   <span class="profile-status online pull-right"></span>
                 </div>
              </div>
              <div class="col-md-4">
                <div class="user-img">
                  <img src="<?php echo base_url('asset/pixel');?>/plugins/images/users/genu.jpg" alt="user" class="img-circle" width="40px" style="border:3px solid white">
                   <span class="profile-status online pull-right"></span>
                 </div>
              </div>
            </div>
            <div class="col-md-2">
              <div class="pull-right" style="margin-top:10px;">
                <a href="" class="icon-options-vertical" data-toggle="dropdown" style="font-size:20px;color:grey"></a>
                <ul role="menu" class="dropdown-menu">
                  <li>
                    <a href="#">Hai</a>
                  </li>
                  <li>
                    <a href="#">Hoi</a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <br>
          <div class="progress m-b-0">
            <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:100%;"> </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
