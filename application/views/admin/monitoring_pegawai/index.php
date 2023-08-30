
<div class="container-fluid">

  <div class="row bg-title">
    <!-- .page title -->
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
      <h4 class="page-title">Monitoring Pegawai</h4>
    </div>
    <!-- /.page title -->
    <!-- .breadcrumb -->
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

      <ol class="breadcrumb">
        <?php echo breadcrumb($this->uri->segment_array()); ?>
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
          <label for="">SKPD</label>
          <select name="id_unit_kerja" class="form-control select2">
           <option value="">Pilih SKPD</option>
          
           <option value="">SKPD 1</option>
           <option value="">SKPD 1</option>
           <option value="">SKPD 1</option>

         
        </select>
      </div>
    </div>

        <div class="col-md-3">
         <div class="form-group">
          <label for="">Unit Kerja</label>
          <select name="id_unit_kerja" class="form-control select2">
           <option value="">Pilih Unit Kerja</option>
           <?php
           foreach($unit_kerja as $u){
            if($u->id_unit_kerja==set_value('id_unit_kerja')){
              $selected = ' selected';
            }else{
              $selected = '';
            }
            echo'<option value="'.$u->id_unit_kerja.'"'.$selected.'>'.$u->nama_unit_kerja.'</option>';
          }
          ?>
        </select>
      </div>
    </div>
    <div class="col-md-3">
     <label for="">Nama Pegawai</label>
     <div class="input-daterange input-group">
      <input type="text" class="form-control" name="">
    </div>
  </div>
  <div class="col-md-3">
   <div class="form-group text-center">
    <br>
    <button type="submit" class="btn btn-primary btn-outline m-t-5"><i class="ti-search"></i> Cari</button>
  </div>
</div>
</form>
</div>

</div>
</div>

</div>
<div class="row">
  <div class="col-md-12">
  
      <div id="map" class="gmaps"></div>
      <div class="hidden">
        <div id="infowindow-content">
          <img src="" width="16" height="16" id="place-icon">
          <span id="place-name"  class="title"></span><br>
          <span id="place-address"></span>
        </div>
        </div>
      </div>
  </div>
</div>

      <script>
      // This example requires the Places library. Include the libraries=places
      // parameter when you first load the API. For example:
      // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

      function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: -6.838118799999999, lng: 107.9275324},
          zoom: 11
        });
        
        

        var infowindow = new google.maps.InfoWindow();
        var infowindowContent = document.getElementById('infowindow-content');
        infowindow.setContent(infowindowContent);
        

        var locations = [
          ['Iqbal', '-6.83402821610385', '07.94745456669922', 4],
          ['Khalid', '-6.8292558239898895', '107.90419589970703', 5],
          ['Ihin', '-6.8701604939419', '107.97629367802735', 3],
          ['Arif', '-6.8701604939419', '107.85063755009766', 2],
          ['Nandang', '-6.783574809963231', '107.94333469365235', 1]
        ];
        
        
        var marker, i;

        for (i = 0; i < locations.length; i++) {  
          marker = new google.maps.Marker({
            position: new google.maps.LatLng(locations[i][1], locations[i][2]),
            map: map
          });

          google.maps.event.addListener(marker, 'click', (function(marker, i) {
            return function() {
              infowindow.setContent(locations[i][0]);
              infowindow.open(map, marker);
            }
          })(marker, i));
        }
        
        
      }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBF-EKYJaTXFn5AsQudXlemdxuzApgTTjw&libraries=places&callback=initMap"
        async defer></script>
   <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&amp;language=en"></script>
    <script src="<?php echo base_url()."asset/admin/js/maps/infobox.js";?>"></script>
    <script src="<?php echo base_url()."asset/admin/js/maps/markerclusterer.js";?>"></script>
    <script src="<?php echo base_url()."asset/admin/js/maps/map.js";?>"></script>
    