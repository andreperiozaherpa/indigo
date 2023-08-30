 <!-- BEGIN: Vendor JS-->
 <script src="<?php echo base_url()."asset/simpeg/" ;?>app-assets/vendors/js/vendors.min.js"></script>
 <!-- BEGIN Vendor JS-->



 <!-- BEGIN: Page Vendor JS-->
 <script src="<?php echo base_url()."asset/simpeg/" ;?>app-assets/vendors/js/ui/jquery.sticky.js"></script>
 <script src="<?php echo base_url()."asset/simpeg/" ;?>app-assets/vendors/js/charts/apexcharts.min.js"></script>
 <script src="<?php echo base_url()."asset/simpeg/" ;?>app-assets/vendors/js/extensions/tether.min.js"></script>
 <script src="<?php echo base_url()."asset/simpeg/" ;?>app-assets/vendors/js/extensions/shepherd.min.js"></script>
 <!-- END: Page Vendor JS-->

 <!-- BEGIN: Theme JS-->
 <script src="<?php echo base_url()."asset/simpeg/" ;?>app-assets/js/core/app-menu.js"></script>
 <script src="<?php echo base_url()."asset/simpeg/" ;?>app-assets/js/core/app.js"></script>
 <script src="<?php echo base_url()."asset/simpeg/" ;?>app-assets/js/scripts/components.js"></script>
 <script src="<?php echo base_url()."asset/simpeg/" ;?>app-assets/vendors/dropify/js/dropify.min.js"></script>
 <script src="<?php echo base_url()."asset/simpeg/" ;?>app-assets/vendors/js/extensions/wNumb.js"></script>
 <script src="<?php echo base_url()."asset/simpeg/" ;?>app-assets/js/scripts/customizer.js"></script>
 <!-- END: Theme JS-->

 <!-- BEGIN: Page Vendor JS-->
 <script src="<?php echo base_url()."asset/simpeg/" ;?>app-assets/vendors/js/ui/jquery.sticky.js"></script>
 <script src="<?php echo base_url()."asset/simpeg/" ;?>app-assets/vendors/js/extensions/dropzone.min.js"></script>
 <script src="<?php echo base_url()."asset/simpeg/" ;?>app-assets/vendors/js/tables/datatable/datatables.min.js">
 </script>
 <script
     src="<?php echo base_url()."asset/simpeg/" ;?>app-assets/vendors/js/tables/datatable/datatables.buttons.min.js">
 </script>
 <script
     src="<?php echo base_url()."asset/simpeg/" ;?>app-assets/vendors/js/tables/datatable/datatables.bootstrap4.min.js">
 </script>
 <script src="<?php echo base_url()."asset/simpeg/" ;?>app-assets/vendors/js/tables/datatable/buttons.bootstrap.min.js">
 </script>
 <script src="<?php echo base_url()."asset/simpeg/" ;?>app-assets/vendors/js/tables/datatable/dataTables.select.min.js">
 </script>
 <script
     src="<?php echo base_url()."asset/simpeg/" ;?>app-assets/vendors/js/tables/datatable/datatables.checkboxes.min.js">
 </script>
 <script src="<?php echo base_url()."asset/simpeg/" ;?>app-assets/vendors/js/charts/chart.min.js"></script>
 <!-- END: Page Vendor JS-->

 <!-- BEGIN: Page JS
 <script src="<?php echo base_url()."asset/simpeg/" ;?>app-assets/js/scripts/pages/dashboard-ecommerce.js"></script>

 END: Page JS-->

 <!-- BEGIN: Page JS
    <script src="<?php echo base_url()."asset/simpeg/" ;?>app-assets/js/scripts/pages/dashboard-analytics.js"></script>
    END: Page JS-->


 <!-- BEGIN: Page JS-->
 <script src="<?php echo base_url()."asset/simpeg/" ;?>app-assets/js/scripts/ui/data-list-view.js"></script>
 <!-- END: Page JS-->



 <!--
<script src="<?php echo base_url()."asset/simpeg/" ;?>app-assets/js/scripts/pages/app-ecommerce-shop.js"></script>
-->

 <!-- END: Page JS-->
 <?php if(!empty($datepicker) && $datepicker==true) :?>

 <script src="<?= base_url()."asset/simpeg/";?>app-assets/vendors/js/pickers/pickadate/picker.js"></script>
 <script src="<?= base_url()."asset/simpeg/";?>app-assets/vendors/js/pickers/pickadate/picker.date.js"></script>
 <script src="<?= base_url()."asset/simpeg/";?>app-assets/vendors/js/pickers/pickadate/picker.time.js"></script>
 <script src="<?= base_url()."asset/simpeg/";?>app-assets/vendors/js/pickers/pickadate/legacy.js"></script>
 <script src="<?= base_url()."asset/simpeg/";?>app-assets/js/scripts/pickers/dateTime/pick-a-datetime.js"></script>
 <?php endif?>

 <script src="<?= base_url()."asset/simpeg/";?>app-assets/vendors/js/extensions/jquery.steps.min.js"></script>
 <!-- <script src="<?= base_url()."asset/simpeg/";?>app-assets/js/scripts/extensions/swiper.js"></script> -->
 <script src="<?= base_url()."asset/simpeg/" ;?>app-assets/vendors/js/forms/select/select2.full.min.js"></script>
 <script src="<?= base_url()."asset/simpeg/" ;?>app-assets/js/scripts/forms/select/form-select2.js"></script>
 <script src="<?= base_url()."asset/simpeg/" ;?>app-assets/js/scripts/forms/wizard-steps.js"></script>

 <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
 <script>
$(window).on("load", function() {
    // $('#collapse-menu').click();
    if (feather) {
        feather.replace({
            width: 14,
            height: 14
        });
    }
});
<?php
 if(!empty($this->session->flashdata('success'))){
  echo '
  swal("Sukses", "'.$this->session->flashdata('success').'", "success");
  ';
}
if(!empty($this->session->flashdata('error'))){
  echo '
  swal("Error", "'.$this->session->flashdata('error').'", "error");
  ';
}
?>
 </script>
 <script>
"use strict";

<?php if(!empty($map) && $map==true) :?>

function initMap() {
    var default_lat = -6.864113885641478;
    var default_lng = 107.9237869248534;

    var lat = $("#latitude").val();
    var lng = $("#longitude").val();
    if (lat != "" && lng != "") {
        var location = new google.maps.LatLng(parseFloat(lat), parseFloat(lng));
        //var location = new google.maps.LatLng(parseFloat(default_lat),parseFloat(default_lng));
    } else {
        var location = new google.maps.LatLng(parseFloat(default_lat), parseFloat(default_lng));
    }
    var mapProp = {
        center: location,
        zoom: 15,
        //disableDefaultUI: true,
        //mapTypeId:google.maps.MapTypeId.HYBRID
    };
    var map = new google.maps.Map(document.getElementById("map"), mapProp);

    var marker = new google.maps.Marker({
        position: location,
        //map: map,
        //animation: google.maps.Animation.BOUNCE
    });



    var infowindow = new google.maps.InfoWindow({
        content: 'Latitude: ' + location.lat() + '<br>Longitude: ' + location.lng()
    });

    if (lat != "" && lng != "") {
        marker.setMap(map);
        markers.push(marker);
        infowindow.open(map, marker);
    }


    google.maps.event.addListener(marker, 'click', function() {
        infowindow.open(map, marker);
    });


    google.maps.event.addListener(map, 'click', function(event) {
        placeMarker(map, event.latLng);
    });


}
var markers = [];

function placeMarker(map, location) {
    var marker = new google.maps.Marker({
        position: location,
        map: map,
        animation: google.maps.Animation.BOUNCE,
    });
    var infowindow = new google.maps.InfoWindow({
        content: 'Latitude: ' + location.lat() + '<br>Longitude: ' + location.lng()
    });

    //hapus tanda
    for (var i = 0; i < markers.length; i++) {
        markers[i].setMap(null);
    }

    infowindow.open(map, marker);
    markers.push(marker);
    $("#latitude").val(location.lat());
    $("#longitude").val(location.lng());
}
<?php endif ?>
/*----- BEGIN OF PAGINATION */

if (typeof loadPagination === "function") {
    loadPagination(1);
}

var pagination = document.getElementById("pagination");
if (pagination) {
    $('#pagination').on('click', 'a', function(e) {
        e.preventDefault();
        var pageno = $(this).attr('data-ci-pagination-page');
        if (typeof loadPagination === "function") {
            loadPagination(pageno);
        }
    });

}

$('.dropify').dropify();
// $('.select2').select2();


function close_sidebar(item = "") {
    if (item) {
        var item = "." + item;
    }
    $(".add-new-data" + item).removeClass("show");
    $(".overlay-bg" + item).removeClass("show");
}
 </script>