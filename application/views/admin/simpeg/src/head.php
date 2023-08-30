   <!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Vuexy admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Vuexy admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <title><?php echo $title ;?></title>
    <link rel="apple-touch-icon" href="<?php echo base_url()."asset/simpeg/" ;?>app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url()."asset/simpeg/" ;?>app-assets/images/ico/favicon.ico">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600" rel="stylesheet">


    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()."asset/simpeg/" ;?>app-assets/vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()."asset/simpeg/" ;?>app-assets/vendors/css/charts/apexcharts.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()."asset/simpeg/" ;?>app-assets/vendors/css/extensions/tether-theme-arrows.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()."asset/simpeg/" ;?>app-assets/vendors/css/extensions/tether.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()."asset/simpeg/" ;?>app-assets/vendors/css/extensions/sweetalert2.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()."asset/simpeg/" ;?>app-assets/vendors/css/extensions/nouislider.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()."asset/simpeg/" ;?>app-assets/vendors/css/ui/prism.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()."asset/simpeg/" ;?>app-assets/vendors/css/extensions/shepherd-theme-default.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()."asset/simpeg/" ;?>app-assets/vendors/dropify/css/dropify.min.css">

    <link rel="stylesheet" type="text/css" href="<?php echo base_url()."asset/simpeg/" ;?>app-assets/vendors/css/forms/select/select2.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()."asset/simpeg/" ;?>app-assets/vendors/css/forms/spinner/jquery.bootstrap-touchspin.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()."asset/simpeg/" ;?>app-assets/vendors/css/tables/datatable/datatables.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()."asset/simpeg/" ;?>app-assets/vendors/css/pickers/pickadate/pickadate.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()."asset/simpeg/" ;?>app-assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()."asset/simpeg/" ;?>app-assets/css/bootstrap-extended.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()."asset/simpeg/" ;?>app-assets/css/colors.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()."asset/simpeg/" ;?>app-assets/css/components.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()."asset/simpeg/" ;?>app-assets/css/themes/dark-layout.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()."asset/simpeg/" ;?>app-assets/css/themes/semi-dark-layout.css">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()."asset/simpeg/" ;?>app-assets/css/core/menu/menu-types/horizontal-menu.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()."asset/simpeg/" ;?>app-assets/css/core/colors/palette-gradient.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()."asset/simpeg/" ;?>app-assets/css/pages/authentication.css">
    <!-- END: Page CSS-->

      <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()."asset/simpeg/" ;?>app-assets/css/pages/dashboard-analytics.css">
     <link rel="stylesheet" type="text/css" href="<?php echo base_url()."asset/simpeg/" ;?>app-assets/css/pages/dashboard-ecommerce.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()."asset/simpeg/" ;?>app-assets/css/pages/card-analytics.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()."asset/simpeg/" ;?>app-assets/css/plugins/tour/tour.css">
       <link rel="stylesheet" type="text/css" href="<?php echo base_url()."asset/simpeg/" ;?>app-assets/vendors/dropify/css/dropify.min.css">
       <link rel="stylesheet" type="text/css" href="<?php echo base_url()."asset/simpeg/" ;?>app-assets/css/plugins/forms/wizard.css">
    <!-- END: Page CSS-->


    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()."asset/simpeg/" ;?>assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()."asset/simpeg/" ;?>assets/css/style.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url()."asset/simpeg/" ;?>app-assets/css/plugins/file-uploaders/dropzone.css">
    <!-- END: Custom CSS-->

       <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()."asset/simpeg/" ;?>app-assets/css/plugins/file-uploaders/dropzone.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()."asset/simpeg/" ;?>app-assets/css/pages/data-list-view.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()."asset/simpeg/" ;?>app-assets/css/pages/invoice.css">
    <!-- END: Page CSS-->

    <link rel="stylesheet" type="text/css" href="<?php echo base_url()."asset/simpeg/" ;?>app-assets/css/plugins/extensions/noui-slider.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()."asset/simpeg/" ;?>app-assets/css/pages/app-ecommerce-shop.css">
      <link rel="stylesheet" type="text/css" href="<?php echo base_url()."asset/simpeg/" ;?>app-assets/css/pages/dashboard-analytics.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url()."asset/simpeg/" ;?>app-assets/css/pages/app-ecommerce-shop.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url()."asset/" ;?>custom.css">

    
     <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
<?php if(!empty($map) && $map == true) :?>
 <script
 src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBF-EKYJaTXFn5AsQudXlemdxuzApgTTjw&callback=initMap&libraries=&v=weekly"
 defer
 ></script>
 <style type="text/css">
      /
      #map {
        height: 100%;
      }
    </style>

<?php endif ?>

</head>
<!-- END: Head-->


    <script type="text/javascript">
        var $mindate = "";
        var $maxdate = "";
        // var $dayslimit;
    </script>
