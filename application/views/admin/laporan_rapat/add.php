
<div class="container-fluid">

	<div class="row bg-title">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title">Laporan Rapat</h4> </div>
			<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
				<ol class="breadcrumb">
					<li class="active">Laporan Rapat</li>				</ol>
				</div>
				<!-- /.col-lg-12 -->
			</div>


			<div class="row">
            <div class="col-sm-12">
                <div class="white-box" style="border-top: 5px solid #6003c8;">
									<div class="panel panel-primary">
										<div class="panel-heading text-center">
											TAMBAH LAPORAN RAPAT
										</div>
									</div>





  <script src="http://maps.googleapis.com/maps/api/js"></script>
<script>
// variabel global marker
var marker;

function taruhMarker(peta, posisiTitik){

    if( marker ){
      // pindahkan marker
      marker.setPosition(posisiTitik);
    } else {
      // buat marker baru
      marker = new google.maps.Marker({
        position: posisiTitik,
        map: peta
      });
    }

    console.log("Posisi marker: " + posisiTitik);

}

function initialize() {
  var propertiPeta = {
    center:new google.maps.LatLng(-8.5830695,116.3202515),
    zoom:9,
    mapTypeId:google.maps.MapTypeId.ROADMAP
  };

  var peta = new google.maps.Map(document.getElementById("googleMap"), propertiPeta);

  // even listner ketika peta diklik
  google.maps.event.addListener(peta, 'click', function(event) {
    taruhMarker(this, event.latLng);
  });

}


// event jendela di-load
google.maps.event.addDomListener(window, 'load', initialize);


  </script>



                    <form method="post" enctype="multipart/form-data">
											<input type="hidden" name="id_pegawai" value="<?=$id_pegawai?> ">
											<input type="hidden" name="id_skpd" value="<?=$id_skpd?> ">
											<div class="form-group">
												<label for="">Nama Laporan Rapat</label>
												<input type="text" class="form-control" name="nama" value="" placeholder="Nama Laporan Rapat">
											</div>
                        <div class="form-group">
													<label for="">Isi Rapat</label>
                            <textarea  name="isi" class="textarea_editor form-control" rows="15" maxlength="200" placeholder="Isi Rapat ..."></textarea>
                        </div>
												<div class="form-group">
													<label for="">Tanggal Rapat</label>
													<div class="input-group">
                            <input type="text" name="tanggal" class="form-control mydatepicker" placeholder="mm-dd-yyyy">
                            <span class="input-group-addon"><i class="icon-calender"></i></span> </div>
												</div>
												<div class="form-group">
													<label for="">Lokasi Rapat</label>
													<textarea name="lokasi" class="form-control" rows="3" cols="80" placeholder="Lokasi Rapat"></textarea>
												</div>
												<div class="row">
													<div class="form-group">
														<label for="">Lampiran Laporan</label>
														<input type="file" class="form-control" name="file_laporan" value="">
														</div>
													</div>
												<div class="form-group">
													<label for="">Penerima Laporan</label>
													<select name="id_penerima" class="form-control select2" data-placeholder="Pilih">
																<option value="">Pilih Penerima</option>
																<?php foreach ($penerima as $pm): ?>
																<option value="<?=$pm->id_pegawai?>"><?=$pm->nama_lengkap?></option>
																<?php endforeach; ?>
                            </select>
												</div>
												<button type="submit" name="tombol_submit" class="btn btn-primary" style="width:100px;">Simpan</button>
                    </form>
                </div>
            </div>
        </div>


<!-- google maps api
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDEAiEZF-iXunR8kQn_4QFBNyWcK5XIy08&&callback=initMap"
      type="text/javascript"></script>
    <script src="http://maps.google.com/maps/api/js?sensor=true"></script>
    <script src="<?php echo base_url()."asset/pixel/" ;?>plugins/bower_components/gmaps/gmaps.min.js"></script>
    <script src="<?php echo base_url()."asset/pixel/" ;?>plugins/bower_components/gmaps/jquery.gmaps.js"></script>

    -->
