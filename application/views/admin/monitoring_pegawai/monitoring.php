<!DOCTYPE html>
<head>

<title><?= $title;?></title>

<link rel="stylesheet" href="<?=base_url();?>asset/admin/css/listeo.css">
<link rel="stylesheet" href="<?=base_url();?>asset/admin/css/listeo_color.css" id="colors">
</head>

<body>

  <!-- Header Container
================================================== -->
<?php 

  if(empty($frame)){
?>
<header id="header-container" class="fixed fullwidth dashboard">

  <!-- Header -->
  <div id="header" class="not-sticky">
    <div class="container">
      
      <!-- Left Side Content -->
      <div class="left-side">
        
        <!-- Logo -->
        <div id="logo" style="background: #fff">

          <a href="<?php echo base_url();?>admin"><img src="<?php echo base_url()."data/logo/" ;?>e.png" alt=""></a>
          <a href="<?php echo base_url();?>admin" class="dashboard-logo"><img src="<?php echo base_url()."data/logo/" ;?>e-office.png" alt="" width="200px"></a>
        </div>

        <!-- Mobile Navigation -->
        <div class="menu-responsive">
          <i class="fa fa-reorder menu-trigger"></i>
        </div>
        <div class="clearfix" style="color:#fff">
        <div class="row">
          <div class="col-md-3" style="border-right:solid 1px rgba(255,255,255,0.2)">
          <p style="margin: 0px;font-size:12px;line-height:10px;margin-top:10px">Statistik ASN Work from Home</p>
          <b><?=tanggal_hari(date('Y-m-d'))?></b>
          </div>
          <div class="col-md-3" style="border-right:solid 1px rgba(255,255,255,0.2)">
          <p style="margin: 0px;font-size:12px;line-height:10px;margin-top:10px">Total ASN Online</p>
          <b><?=$total_hari_ini?> Orang</b>
          </div>
          <div class="col-md-3" style="border-right:solid 1px rgba(255,255,255,0.2);padding-top:0px">
          <div style="margin-top:-5px;">
          <span style="margin: 0px;padding:0px;font-size:12px;line-height:0px;display:inline-block">Ajuan WFH Markonah</span>
          <b><?=$total_markonah?> Ajuan</b>
          <span style="margin: 0px;font-size:12px;line-height:10px;margin-top:10px;display:inline-block">Input Rencana Kerja</span>
          <b><?=$total_pegawai_bekerja?> Pegawai</b></div>
          </div>
          <div class="col-md-3" style="padding-top:0px">
          <div style="margin-top:-5px;">
          <span style="margin: 0px;padding:0px;font-size:12px;line-height:0px;display:inline-block">Item Pekerjaan</span>
          <b><?=$total_pekerjaan?> Pekerjaan</b>
          <span style="margin: 0px;font-size:12px;line-height:10px;margin-top:10px;display:inline-block">Pekerjaan Selesai</span>
          <b><?=$total_pekerjaan_selesai?> Pekerjaan</b></div>
          </div>
        </div>
        </div>
        <!-- Main Navigation / End -->
        
      </div>
      <!-- Left Side Content / End -->

      <!-- Right Side Content / End -->
      <div class="right-side">
        <!-- Header Widget -->
        <div class="header-widget">
          
          

          <a href="<?php echo base_url();?>admin" class="button border with-icon" style="background: #fff">kembali <i class="sl sl-icon-back"></i></a>
        </div>
        <!-- Header Widget / End -->
      </div>
      <!-- Right Side Content / End -->

    </div>
  </div>
  <!-- Header / End -->

</header>

  <?php } ?>

<div id="map-container" class="fullwidth-home-map">



<div class="main-search-inner" >

<form method="post">
<div class="container">
    <div class="row">
        <div class="col-md-12">
            
            <div class="main-search-input">

                <div class="main-search-input-item">
                    <input type="text" name="cari" placeholder="Cari pegawai" value="<?=!empty($cari) ? $cari : "";?>"/>
                </div>

                <div class="main-search-input-item">
                    <select name="id_skpd" onchange="get_unit_kerja()" id="id_skpd" data-placeholder="Pilih SKPD" class="" >
                            <?= $option_skpd;?>
                    </select>
                </div>

                <div class="main-search-input-item">
                    <select name="id_unit_kerja" id="id_unit_kerja" data-placeholder="Pilih Unit kerja" class="" >
                    <option value=''>Pilih unit kerja</option>
                        <?php 
                            foreach($unit_kerja as $row)
                            {
                                $selected = (!empty($id_unit_kerja) && $id_unit_kerja==$row->id_unit_kerja) ? "selected" :"";
                                echo "<option $selected value='$row->id_unit_kerja'>$row->nama_unit_kerja</option> ";
                            }
                        ?>
                    </select>
                </div>

                <button class="button">Cari</button>

            </div>
        </div>
    </div>
</div>
</form>
</div>

    
<div id="map" data-map-zoom="10" >
        <!-- map goes here -->
</div>
	

    <!-- Scroll Enabling Button -->
	<a href="#" id="scrollEnabling"  title="Enable or disable scrolling on map">Enable Scrolling</a>
</body>


<!-- Scripts
================================================== -->
<script type="text/javascript" src="<?=base_url();?>asset/admin/js/jquery-2.2.0.min.js"></script>

<!-- Maps -->
<script type="text/javascript" src="https://maps.google.com/maps/api/js?key=AIzaSyBF-EKYJaTXFn5AsQudXlemdxuzApgTTjw&sensor=false&amp;language=en&"></script>
<script type="text/javascript" src="<?=base_url();?>asset/admin/js/maps/infobox.min.js"></script>
<script type="text/javascript" src="<?=base_url();?>asset/admin/js/maps/markerclusterer.js"></script>



<script type="text/javascript" src="<?=base_url();?>asset/admin/js/maps/jpanelmenu.min.js"></script>
<script type="text/javascript" src="<?=base_url();?>asset/admin/js/maps/chosen.min.js"></script>
<script type="text/javascript" src="<?=base_url();?>asset/admin/js/maps/custom.js"></script>

<script>
    var infoBox_ratingType = 'star-rating';

(function($){
    "use strict";

    function mainMap() {

      // Locations
      // ----------------------------------------------- //
      var ib = new InfoBox();

      // Infobox Output
      function locationData(locationURL,locationImg,locationTitle, locationAddress, locationRating, locationRatingCounter) {
          return(''+
            '<a href="'+ locationURL +'" class="listing-img-container">'+
               '<div class="infoBox-close"><i class="fa fa-times"></i></div>'+
               '<img src="'+locationImg+'" alt="">'+

               '<div class="listing-item-content">'+
                  '<h3>'+locationTitle+'</h3>'+
                  '<span>'+locationAddress+'</span>'+
               '</div>'+

            '</a>'+

            '<div class="listing-content">'+
               '<div class="listing-title">'+
                  '<div class="'+infoBox_ratingType+'" data-rating="'+locationRating+'"><div class="rating-counter">('+locationRatingCounter+' reviews)</div></div>'+
               '</div>'+
            '</div>')
      }

      // Locations
      var locations2 = [
        [ locationData('','data/foto/pegawai/user-default.png',"Nandang Koswara",'964 School Street, New York', '3.5', '12'), 40.94401669296697, -74.16938781738281, 1, '<i class="im im-icon-Home-2"></i>'],
        [ locationData('','data/foto/pegawai/user-default.png','Arif','Bishop Avenue, New York', '5.0', '23'), 40.77055783505125, -74.26002502441406,          2, '<i class="im im-icon-Home-2"></i>'],
        [ locationData('','data/foto/pegawai/user-default.png','Solihin','778 Country Street, New York', '2.0', '17'), 40.7427837, -73.11445617675781,         3, '<i class="im im-icon-Home-2"></i>' ],
        [ locationData('','data/foto/pegawai/user-default.png','Khalid','2726 Shinn Street, New York', '5.0', '31'), 40.70437865245596, -73.98674011230469,     4, '<i class="im im-icon-Home-2"></i>' ],
        [ locationData('','data/foto/pegawai/user-default.png','Iqbal','1512 Duncan Avenue, New York', '3.5', '46'), 40.641311, -73.778139,                         5, '<i class="im im-icon-Home-2"></i>'],
        [ locationData('','data/foto/pegawai/user-default.png','Ryfa','215 Terry Lane, New York', '4.5', '15'), 41.080938, -73.535957,                        6, '<i class="im im-icon-Home-2"></i>'], 
        [ locationData('','data/foto/pegawai/user-default.png','Dilan','2726 Shinn Street, New York', '5.0', '31'), 41.079386, -73.519478,                     7, '<i class="im im-icon-Home-2"></i>'],
      ];

      var locations = <?=$monitoring;?>;

      //console.log(<?=$monitoring;?>);
      console.log(locations);

      // Chosen Rating Type
      google.maps.event.addListener(ib,'domready',function(){
         if (infoBox_ratingType = 'numerical-rating') {
            numericalRating('.infoBox .'+infoBox_ratingType+'');
         } 
         if (infoBox_ratingType = 'star-rating') {
            starRating('.infoBox .'+infoBox_ratingType+'');
         }
      });



      // Map Attributes
      // ----------------------------------------------- //

      var mapZoomAttr = $('#map').attr('data-map-zoom');
      var mapScrollAttr = $('#map').attr('data-map-scroll');

      if (typeof mapZoomAttr !== typeof undefined && mapZoomAttr !== false) {
          var zoomLevel = parseInt(mapZoomAttr);
      } else {
          var zoomLevel = 5;
      }

      if (typeof mapScrollAttr !== typeof undefined && mapScrollAttr !== false) {
         var scrollEnabled = parseInt(mapScrollAttr);
      } else {
        var scrollEnabled = false;
      }


      //lat: -6.838118799999999,
        //  lng: 107.9275324

      // Main Map
      var map = new google.maps.Map(document.getElementById('map'), {
        zoom: zoomLevel,
        scrollwheel: scrollEnabled,
        center: new google.maps.LatLng(-6.838118799999999,107.9275324),
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        zoomControl: false,
        mapTypeControl: false,
        scaleControl: false,
        panControl: false,
        navigationControl: false,
        streetViewControl: false,
        gestureHandling: 'cooperative',



       styles: [
  {
    "elementType": "geometry",
    "stylers": [
      {
        "color": "#242f3e"
      }
    ]
  },
  {
    "elementType": "labels.text.fill",
    "stylers": [
      {
        "color": "#746855"
      }
    ]
  },
  {
    "elementType": "labels.text.stroke",
    "stylers": [
      {
        "color": "#242f3e"
      }
    ]
  },
  {
    "featureType": "administrative",
    "elementType": "geometry",
    "stylers": [
      {
        "visibility": "off"
      }
    ]
  },
  {
    "featureType": "administrative.land_parcel",
    "elementType": "labels",
    "stylers": [
      {
        "visibility": "off"
      }
    ]
  },
  {
    "featureType": "administrative.locality",
    "elementType": "labels.text.fill",
    "stylers": [
      {
        "color": "#d59563"
      }
    ]
  },
  {
    "featureType": "poi",
    "stylers": [
      {
        "visibility": "off"
      }
    ]
  },
  {
    "featureType": "poi",
    "elementType": "labels.text.fill",
    "stylers": [
      {
        "color": "#d59563"
      }
    ]
  },
  {
    "featureType": "poi.park",
    "elementType": "geometry",
    "stylers": [
      {
        "color": "#263c3f"
      }
    ]
  },
  {
    "featureType": "poi.park",
    "elementType": "labels.text.fill",
    "stylers": [
      {
        "color": "#6b9a76"
      }
    ]
  },
  {
    "featureType": "road",
    "elementType": "geometry",
    "stylers": [
      {
        "color": "#38414e"
      }
    ]
  },
  {
    "featureType": "road",
    "elementType": "geometry.stroke",
    "stylers": [
      {
        "color": "#212a37"
      }
    ]
  },
  {
    "featureType": "road",
    "elementType": "labels.icon",
    "stylers": [
      {
        "visibility": "off"
      }
    ]
  },
  {
    "featureType": "road",
    "elementType": "labels.text.fill",
    "stylers": [
      {
        "color": "#9ca5b3"
      }
    ]
  },
  {
    "featureType": "road.highway",
    "elementType": "geometry",
    "stylers": [
      {
        "color": "#746855"
      }
    ]
  },
  {
    "featureType": "road.highway",
    "elementType": "geometry.stroke",
    "stylers": [
      {
        "color": "#1f2835"
      }
    ]
  },
  {
    "featureType": "road.highway",
    "elementType": "labels.text.fill",
    "stylers": [
      {
        "color": "#f3d19c"
      }
    ]
  },
  {
    "featureType": "road.local",
    "elementType": "labels",
    "stylers": [
      {
        "visibility": "off"
      }
    ]
  },
  {
    "featureType": "transit",
    "stylers": [
      {
        "visibility": "off"
      }
    ]
  },
  {
    "featureType": "transit",
    "elementType": "geometry",
    "stylers": [
      {
        "color": "#2f3948"
      }
    ]
  },
  {
    "featureType": "transit.station",
    "elementType": "labels.text.fill",
    "stylers": [
      {
        "color": "#d59563"
      }
    ]
  },
  {
    "featureType": "water",
    "elementType": "geometry",
    "stylers": [
      {
        "color": "#17263c"
      }
    ]
  },
  {
    "featureType": "water",
    "elementType": "labels.text.fill",
    "stylers": [
      {
        "color": "#515c6d"
      }
    ]
  },
  {
    "featureType": "water",
    "elementType": "labels.text.stroke",
    "stylers": [
      {
        "color": "#17263c"
      }
    ]
  }
]

      });




      // Google Map Style



      // Marker highlighting when hovering listing item
      $('.listing-item-container').on('mouseover', function(){

        var listingAttr = $(this).data('marker-id');

        if(listingAttr !== undefined) {
          var listing_id = $(this).data('marker-id') - 1;
          var marker_div = allMarkers[listing_id].div;

          $(marker_div).addClass('clicked');

          $(this).on('mouseout', function(){
              if ($(marker_div).is(":not(.infoBox-opened)")) {
                 $(marker_div).removeClass('clicked');
              }
           });
        }

      });


      // Infobox
      // ----------------------------------------------- //

      var boxText = document.createElement("div");
      boxText.className = 'map-box'

      var currentInfobox;
       
      var boxOptions = {
              content: boxText,
              disableAutoPan: false,
              alignBottom : true,
              maxWidth: 0,
              pixelOffset: new google.maps.Size(-134, -55),
              zIndex: null,
              boxStyle: { 
                width: "270px"
              },
              closeBoxMargin: "0",
              closeBoxURL: "",
              infoBoxClearance: new google.maps.Size(25, 25),
              isHidden: false,
              pane: "floatPane",
              enableEventPropagation: false,
      };


      var markerCluster, overlay, i;
      var allMarkers = [];
      
      var clusterStyles = [
        {
          textColor: 'white',
          url: '',
          height: 50,
          width: 50
        }
      ];


      var markerIco;
      for (i = 0; i < locations.length; i++) { 
        console.log(i);
        markerIco = locations[i][4];

        var overlaypositions = new google.maps.LatLng(locations[i][1], locations[i][2]),

        overlay = new CustomMarker(
         overlaypositions,
          map,
          {
            marker_id: i
          },
          markerIco
        );
        
        allMarkers.push(overlay);

        google.maps.event.addDomListener(overlay, 'click', (function(overlay, i) {

          return function() {
             ib.setOptions(boxOptions);
             boxText.innerHTML = locations[i][0];
             ib.open(map, overlay);

             currentInfobox = locations[i][3];
             // var latLng = new google.maps.LatLng(locations[i][1], locations[i][2]);
             // map.panTo(latLng);
             // map.panBy(0,-90);


            google.maps.event.addListener(ib,'domready',function(){
              $('.infoBox-close').click(function(e) {
                  e.preventDefault();
                  ib.close();
                  $('.map-marker-container').removeClass('clicked infoBox-opened');
              });

            });

          }
        })(overlay, i));

      }


      // Marker Clusterer Init
      // ----------------------------------------------- //

      var options = {
          imagePath: 'images/',
          styles : clusterStyles,
          minClusterSize : 2
      };

      markerCluster = new MarkerClusterer(map, allMarkers, options); 

      google.maps.event.addDomListener(window, "resize", function() {
          var center = map.getCenter();
          google.maps.event.trigger(map, "resize");
          map.setCenter(center); 
      });



      // Custom User Interface Elements
      // ----------------------------------------------- //

      // Custom Zoom-In and Zoom-Out Buttons
        var zoomControlDiv = document.createElement('div');
        var zoomControl = new ZoomControl(zoomControlDiv, map);

        function ZoomControl(controlDiv, map) {

          zoomControlDiv.index = 1;
          map.controls[google.maps.ControlPosition.RIGHT_CENTER].push(zoomControlDiv);
          // Creating divs & styles for custom zoom control
          controlDiv.style.padding = '5px';
          controlDiv.className = "zoomControlWrapper";

          // Set CSS for the control wrapper
          var controlWrapper = document.createElement('div');
          controlDiv.appendChild(controlWrapper);
          
          // Set CSS for the zoomIn
          var zoomInButton = document.createElement('div');
          zoomInButton.className = "custom-zoom-in";
          controlWrapper.appendChild(zoomInButton);
            
          // Set CSS for the zoomOut
          var zoomOutButton = document.createElement('div');
          zoomOutButton.className = "custom-zoom-out";
          controlWrapper.appendChild(zoomOutButton);

          // Setup the click event listener - zoomIn
          google.maps.event.addDomListener(zoomInButton, 'click', function() {
            map.setZoom(map.getZoom() + 1);
          });
            
          // Setup the click event listener - zoomOut
          google.maps.event.addDomListener(zoomOutButton, 'click', function() {
            map.setZoom(map.getZoom() - 1);
          });  
          
      }


      // Scroll enabling button
      var scrollEnabling = $('#scrollEnabling');

      $(scrollEnabling).click(function(e){
          e.preventDefault();
          $(this).toggleClass("enabled");

          if ( $(this).is(".enabled") ) {
             map.setOptions({'scrollwheel': true});
          } else {
             map.setOptions({'scrollwheel': false});
          }
      })


      // Geo Location Button
      $("#geoLocation, .input-with-icon.location a").click(function(e){
          e.preventDefault();
          geolocate();
      });

      function geolocate() {

          if (navigator.geolocation) {
              navigator.geolocation.getCurrentPosition(function (position) {
                  var pos = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
                  map.setCenter(pos);
                  map.setZoom(12);
              });
          }
      }

    }


    // Map Init
    var map =  document.getElementById('map');
    if (typeof(map) != 'undefined' && map != null) {
      google.maps.event.addDomListener(window, 'load',  mainMap);
      google.maps.event.addDomListener(window, 'resize',  mainMap);
    }
      

    // ---------------- Main Map / End ---------------- //


    // Single Listing Map
    // ----------------------------------------------- //

    function singleListingMap() {

      var myLatlng = new google.maps.LatLng({lng: $( '#singleListingMap' ).data('longitude'),lat: $( '#singleListingMap' ).data('latitude'), });

      var single_map = new google.maps.Map(document.getElementById('singleListingMap'), {
        zoom: 15,
        center: myLatlng,
        scrollwheel: false,
        zoomControl: false,
        mapTypeControl: false,
        scaleControl: false,
        panControl: false,
        navigationControl: false,  
        streetViewControl: false,
        styles:  [{"featureType":"poi","elementType":"labels.text.fill","stylers":[{"color":"#747474"},{"lightness":"23"}]},{"featureType":"poi.attraction","elementType":"geometry.fill","stylers":[{"color":"#f38eb0"}]},{"featureType":"poi.government","elementType":"geometry.fill","stylers":[{"color":"#ced7db"}]},{"featureType":"poi.medical","elementType":"geometry.fill","stylers":[{"color":"#ffa5a8"}]},{"featureType":"poi.park","elementType":"geometry.fill","stylers":[{"color":"#c7e5c8"}]},{"featureType":"poi.place_of_worship","elementType":"geometry.fill","stylers":[{"color":"#d6cbc7"}]},{"featureType":"poi.school","elementType":"geometry.fill","stylers":[{"color":"#c4c9e8"}]},{"featureType":"poi.sports_complex","elementType":"geometry.fill","stylers":[{"color":"#b1eaf1"}]},{"featureType":"road","elementType":"geometry","stylers":[{"lightness":"100"}]},{"featureType":"road","elementType":"labels","stylers":[{"visibility":"off"},{"lightness":"100"}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#ffd4a5"}]},{"featureType":"road.arterial","elementType":"geometry.fill","stylers":[{"color":"#ffe9d2"}]},{"featureType":"road.local","elementType":"all","stylers":[{"visibility":"simplified"}]},{"featureType":"road.local","elementType":"geometry.fill","stylers":[{"weight":"3.00"}]},{"featureType":"road.local","elementType":"geometry.stroke","stylers":[{"weight":"0.30"}]},{"featureType":"road.local","elementType":"labels.text","stylers":[{"visibility":"on"}]},{"featureType":"road.local","elementType":"labels.text.fill","stylers":[{"color":"#747474"},{"lightness":"36"}]},{"featureType":"road.local","elementType":"labels.text.stroke","stylers":[{"color":"#e9e5dc"},{"lightness":"30"}]},{"featureType":"transit.line","elementType":"geometry","stylers":[{"visibility":"on"},{"lightness":"100"}]},{"featureType":"water","elementType":"all","stylers":[{"color":"#d2e7f7"}]}]
      });
      
      // Steet View Button
      $('#streetView').click(function(e){
         e.preventDefault();
         single_map.getStreetView().setOptions({visible:true,position:myLatlng});
         // $(this).css('display', 'none')
      });


      // Custom zoom buttons
      var zoomControlDiv = document.createElement('div');
      var zoomControl = new ZoomControl(zoomControlDiv, single_map);

      function ZoomControl(controlDiv, single_map) {

        zoomControlDiv.index = 1;
        single_map.controls[google.maps.ControlPosition.RIGHT_CENTER].push(zoomControlDiv);

        controlDiv.style.padding = '5px';

        var controlWrapper = document.createElement('div');
        controlDiv.appendChild(controlWrapper);

        var zoomInButton = document.createElement('div');
        zoomInButton.className = "custom-zoom-in";
        controlWrapper.appendChild(zoomInButton);

        var zoomOutButton = document.createElement('div');
        zoomOutButton.className = "custom-zoom-out";
        controlWrapper.appendChild(zoomOutButton);

        google.maps.event.addDomListener(zoomInButton, 'click', function() {
          single_map.setZoom(single_map.getZoom() + 1);
        });

        google.maps.event.addDomListener(zoomOutButton, 'click', function() {
          single_map.setZoom(single_map.getZoom() - 1);
        });  
          
      }


      // Marker
      var singleMapIco =  "<i class='"+$('#singleListingMap').data('map-icon')+"'></i>";

      new CustomMarker(
        myLatlng, 
        single_map,
        {
          marker_id: '1'
        },
        singleMapIco
      );


    }

    // Single Listing Map Init
    var single_map =  document.getElementById('singleListingMap');
    if (typeof(single_map) != 'undefined' && single_map != null) {
      google.maps.event.addDomListener(window, 'load',  singleListingMap);
      google.maps.event.addDomListener(window, 'resize',  singleListingMap);
    }

    // -------------- Single Listing Map / End -------------- //



    // Custom Map Marker
    // ----------------------------------------------- //

    function CustomMarker(latlng, map, args, markerIco) {
      this.latlng = latlng; 
      this.args = args; 
      this.markerIco = markerIco; 
      this.setMap(map); 
    }

    CustomMarker.prototype = new google.maps.OverlayView();

    CustomMarker.prototype.draw = function() {
  
      var self = this;
      
      var div = this.div;
      
      if (!div) {
      
        div = this.div = document.createElement('div');
        div.className = 'map-marker-container'; 

        div.innerHTML = '<div class="marker-container">'+
                            '<div class="marker-card">'+
                               '<div class="front face">' + self.markerIco + '</div>'+
                               '<div class="back face">' + self.markerIco + '</div>'+
                               '<div class="marker-arrow"></div>'+
                            '</div>'+
                          '</div>'


        // Clicked marker highlight
        google.maps.event.addDomListener(div, "click", function(event) {
            $('.map-marker-container').removeClass('clicked infoBox-opened');
            google.maps.event.trigger(self, "click");
            $(this).addClass('clicked infoBox-opened');
        });


        if (typeof(self.args.marker_id) !== 'undefined') {
          div.dataset.marker_id = self.args.marker_id;
        }
        
        var panes = this.getPanes();
        panes.overlayImage.appendChild(div);
      }
      
      var point = this.getProjection().fromLatLngToDivPixel(this.latlng);
      
      if (point) {
        div.style.left = (point.x) + 'px';
        div.style.top = (point.y) + 'px';
      }
    };

    CustomMarker.prototype.remove = function() {
      if (this.div) {
        this.div.parentNode.removeChild(this.div);
        this.div = null; $(this).removeClass('clicked');
      } 
    };

    CustomMarker.prototype.getPosition = function() { return this.latlng; };

    // -------------- Custom Map Marker / End -------------- //



})(this.jQuery);


function get_unit_kerja()
{
    
    var id_skpd = $("#id_skpd").val();
    $.post("<?=base_url();?>monitoring_pegawai/get_unit_kerja/"+id_skpd,{
        
    },function(resp){
        $("#id_unit_kerja").html(resp);
        console.log(resp);
    });
    
}
</script>