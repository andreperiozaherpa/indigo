<!DOCTYPE html>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">

<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta name="google-site-verification" content="jEA0Cf2WjPZDWVJmyTGoKFqSP04LwhsA9CC-f13iB-E" />
<meta name="description" content="Neon Admin Panel" />
<meta name="author" content="" />
<title>
    <?php echo $title; ?>
</title>


<?php if ($this->router->fetch_class() == 'auditor') {
        // $this->load->view('admin/auditor/src/head');
    } ?>

<link href="<?php echo base_url() . "asset/pixel/inverse/"; ?>bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Menu CSS -->
<link href="<?php echo base_url() . "asset/pixel/"; ?>/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css"
    rel="stylesheet">
<link rel="stylesheet"
    href="<?php echo base_url() . "asset/pixel/"; ?>/plugins/bower_components/dropify/dist/css/dropify.min.css">
<!-- Dropzone css -->
<link href="<?php echo base_url() . "asset/pixel/"; ?>/plugins/bower_components/dropzone-master/dist/dropzone.css"
    rel="stylesheet" type="text/css" />
<!-- toast CSS -->
<link href="<?php echo base_url() . "asset/pixel/"; ?>/plugins/bower_components/toast-master/css/jquery.toast.css"
    rel="stylesheet">
<!-- morris CSS -->
<link href="<?php echo base_url() . "asset/pixel/"; ?>/plugins/bower_components/morrisjs/morris.css" rel="stylesheet">
<link href="<?php echo base_url() . "asset/pixel/"; ?>/plugins/bower_components/css-chart/css-chart.css"
    rel="stylesheet">
<link href="<?php echo base_url() . "asset/pixel/"; ?>/plugins/bower_components/nestable/nestable.css" rel="stylesheet">


<link rel="stylesheet"
    href="<?php echo base_url() . "asset/pixel/plugins/bower_components/datatables/"; ?>jquery.dataTables.min.css">
<link href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />

<!-- Timeline CSS -->
<link
    href="<?php echo base_url() . "asset/pixel/"; ?>plugins/bower_components/horizontal-timeline/css/horizontal-timeline.css"
    rel="stylesheet">
<!-- wizard CSS -->
<link href="<?php echo base_url() . "asset/pixel/"; ?>plugins/bower_components/jquery-wizard-master/css/wizard.css"
    rel="stylesheet">

<link rel="stylesheet"
    href="<?php echo base_url() . "asset/pixel/plugins/bower_components/datatables/"; ?>jquery.dataTables.min.css">
<link href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />

<!-- Bootstrap WYSHTML-->
<link rel="stylesheet"
    href="<?php echo base_url() . "asset/pixel/"; ?>plugins/bower_components/html5-editor/bootstrap-wysihtml5.css" />


<!-- page CSS -->
<link
    href="<?php echo base_url() . "asset/pixel/"; ?>/plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.css"
    rel="stylesheet" type="text/css" />

<?php
// if first segment is naskah
// if ($this->uri->segment(1) == 'naskah') {
?>
<!-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> -->
<?php
// } else {
?>
<link href="<?php echo base_url() . "asset/pixel/"; ?>/plugins/bower_components/custom-select/custom-select.css"
    rel="stylesheet" type="text/css" />
<?php
// }
?>

<link href="<?php echo base_url() . "asset/pixel/"; ?>/plugins/bower_components/switchery/dist/switchery.min.css"
    rel="stylesheet" />
<link href="<?php echo base_url() . "asset/pixel/"; ?>/plugins/bower_components/footable/css/footable.core.css"
    rel="stylesheet">
<link
    href="<?php echo base_url() . "asset/pixel/"; ?>/plugins/bower_components/bootstrap-select/bootstrap-select.min.css"
    rel="stylesheet" />
<link
    href="<?php echo base_url() . "asset/pixel/"; ?>/plugins/bower_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.css"
    rel="stylesheet" />
<link
    href="<?php echo base_url() . "asset/pixel/"; ?>/plugins/bower_components/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css"
    rel="stylesheet" />
<link href="<?php echo base_url() . "asset/pixel/"; ?>/plugins/bower_components/multiselect/css/multi-select.css"
    rel="stylesheet" type="text/css" />
<link
    href="<?php echo base_url() . "asset/pixel/"; ?>/plugins/bower_components/Magnific-Popup-master/dist/magnific-popup.css"
    rel="stylesheet" type="text/css" />
<!-- animation CSS -->
<link href="<?php echo base_url() . "asset/pixel/inverse/"; ?>css/animate.css" rel="stylesheet">
<!--alerts CSS -->
<link href="<?php echo base_url() . "asset/pixel/"; ?>plugins/bower_components/sweetalert/sweetalert.css"
    rel="stylesheet" type="text/css">
<!-- Custom CSS -->
<link href="<?php echo base_url() . "asset/pixel/inverse/"; ?>css/style.css?v=2.2" rel="stylesheet">
<!-- color CSS -->
<link href="<?php echo base_url() . "asset/pixel/inverse/"; ?>css/colors/default.css" id="theme" rel="stylesheet">
<!-- FULLCALENDAR -->
<link href="<?php echo base_url() . "asset/pixel/"; ?>plugins/bower_components/calendar/dist/fullcalendar.css"
    rel="stylesheet" />
<!--Owl carousel CSS -->
<link href="<?php echo base_url() . "asset/pixel/"; ?>/plugins/bower_components/owl.carousel/owl.carousel.min.css"
    rel="stylesheet" type="text/css" />
<link href="<?php echo base_url() . "asset/pixel/"; ?>/plugins/bower_components/owl.carousel/owl.theme.default.css"
    rel="stylesheet" type="text/css" />

<link rel="icon" type="image/png" href="<?php echo base_url() . 'data/logo/e.png'; ?>">
<!-- Page plugins css -->
<link
    href="<?php echo base_url() . "asset/pixel/"; ?>plugins/bower_components/clockpicker/dist/jquery-clockpicker.min.css"
    rel="stylesheet">
<!-- Color picker plugins css -->
<link
    href="<?php echo base_url() . "asset/pixel/"; ?>plugins/bower_components/jquery-asColorPicker-master/css/asColorPicker.css"
    rel="stylesheet">
<!-- Date picker plugins css -->
<link
    href="<?php echo base_url() . "asset/pixel/"; ?>plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.css"
    rel="stylesheet" type="text/css" />
<!-- Daterange picker plugins css -->
<link href="<?php echo base_url() . "asset/pixel/"; ?>/plugins/bower_components/timepicker/bootstrap-timepicker.min.css"
    rel="stylesheet">
<link
    href="<?php echo base_url() . "asset/pixel/"; ?>/plugins/bower_components/bootstrap-daterangepicker/daterangepicker.css"
    rel="stylesheet">

<link href="<?php echo base_url() . "asset/pixel/"; ?>plugins/bower_components/orgchart/orgchart.css" rel="stylesheet"
    type="text/css" />
<link href="<?php echo base_url() . "asset/pixel/"; ?>plugins/bower_components/inputmask/css/inputmask.css"
    rel="stylesheet" type="text/css" />

<!-- jQuery -->
<script src="<?php echo base_url() . "asset/pixel/"; ?>plugins/bower_components/jquery/dist/jquery.min.js"></script>

<script type="text/javascript">
    var $mindate = "";
    var $maxdate = "";
// var $dayslimit;
</script>

<style>
    .custom_file_upload {
        border: 1px solid #ccc;
        display: inline-block;
        padding: 6px 12px;
        cursor: pointer;
    }

    #tree-view {
        transform: matrix(0.5, 0, 0, 0.5, 0, 0);
        max-height: 500px;
        padding-top: 200px;
    }

    @keyframes yellowfade {
        from {
            background: yellow;
        }

        to {
            background: transparent;
        }
    }

    .flash-highlight {
        animation-name: yellowfade;
        animation-duration: 1.5s;
    }

    .display-flex {
        display: grid;
        flex-wrap: wrap;
    }
</style>


<?php if ($this->router->fetch_class() == 'simpeg'): ?>
    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css"
        href="<?php echo base_url() . "asset/simpeg/"; ?>app-assets/vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css"
        href="<?php echo base_url() . "asset/simpeg/"; ?>app-assets/vendors/css/charts/apexcharts.css">
    <link rel="stylesheet" type="text/css"
        href="<?php echo base_url() . "asset/simpeg/"; ?>app-assets/vendors/css/extensions/tether-theme-arrows.css">
    <link rel="stylesheet" type="text/css"
        href="<?php echo base_url() . "asset/simpeg/"; ?>app-assets/vendors/css/extensions/tether.min.css">
    <link rel="stylesheet" type="text/css"
        href="<?php echo base_url() . "asset/simpeg/"; ?>app-assets/vendors/css/extensions/sweetalert2.min.css">
    <link rel="stylesheet" type="text/css"
        href="<?php echo base_url() . "asset/simpeg/"; ?>app-assets/vendors/css/extensions/nouislider.min.css">
    <link rel="stylesheet" type="text/css"
        href="<?php echo base_url() . "asset/simpeg/"; ?>app-assets/vendors/css/ui/prism.min.css">
    <link rel="stylesheet" type="text/css"
        href="<?php echo base_url() . "asset/simpeg/"; ?>app-assets/vendors/css/extensions/shepherd-theme-default.css">
    <link rel="stylesheet" type="text/css"
        href="<?php echo base_url() . "asset/simpeg/"; ?>app-assets/vendors/dropify/css/dropify.min.css">

    <link rel="stylesheet" type="text/css"
        href="<?php echo base_url() . "asset/simpeg/"; ?>app-assets/vendors/css/forms/select/select2.min.css">
    <link rel="stylesheet" type="text/css"
        href="<?php echo base_url() . "asset/simpeg/"; ?>app-assets/vendors/css/forms/spinner/jquery.bootstrap-touchspin.css">
    <link rel="stylesheet" type="text/css"
        href="<?php echo base_url() . "asset/simpeg/"; ?>app-assets/vendors/css/tables/datatable/datatables.min.css">
    <link rel="stylesheet" type="text/css"
        href="<?php echo base_url() . "asset/simpeg/"; ?>app-assets/vendors/css/pickers/pickadate/pickadate.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() . "asset/simpeg/"; ?>app-assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css"
        href="<?php echo base_url() . "asset/simpeg/"; ?>app-assets/css/bootstrap-extended.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() . "asset/simpeg/"; ?>app-assets/css/colors.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() . "asset/simpeg/"; ?>app-assets/css/components.css">
    <link rel="stylesheet" type="text/css"
        href="<?php echo base_url() . "asset/simpeg/"; ?>app-assets/css/themes/dark-layout.css">
    <link rel="stylesheet" type="text/css"
        href="<?php echo base_url() . "asset/simpeg/"; ?>app-assets/css/themes/semi-dark-layout.css">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css"
        href="<?php echo base_url() . "asset/simpeg/"; ?>app-assets/css/core/menu/menu-types/horizontal-menu.css">
    <link rel="stylesheet" type="text/css"
        href="<?php echo base_url() . "asset/simpeg/"; ?>app-assets/css/core/colors/palette-gradient.css">
    <link rel="stylesheet" type="text/css"
        href="<?php echo base_url() . "asset/simpeg/"; ?>app-assets/css/pages/authentication.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css"
        href="<?php echo base_url() . "asset/simpeg/"; ?>app-assets/css/pages/dashboard-analytics.css">
    <link rel="stylesheet" type="text/css"
        href="<?php echo base_url() . "asset/simpeg/"; ?>app-assets/css/pages/dashboard-ecommerce.css">
    <link rel="stylesheet" type="text/css"
        href="<?php echo base_url() . "asset/simpeg/"; ?>app-assets/css/pages/card-analytics.css">
    <link rel="stylesheet" type="text/css"
        href="<?php echo base_url() . "asset/simpeg/"; ?>app-assets/css/plugins/tour/tour.css">
    <link rel="stylesheet" type="text/css"
        href="<?php echo base_url() . "asset/simpeg/"; ?>app-assets/vendors/dropify/css/dropify.min.css">
    <link rel="stylesheet" type="text/css"
        href="<?php echo base_url() . "asset/simpeg/"; ?>app-assets/css/plugins/forms/wizard.css">
    <!-- END: Page CSS-->


    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() . "asset/simpeg/"; ?>assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() . "asset/simpeg/"; ?>assets/css/style.css">
    <link rel="stylesheet" type="text/css"
        href="<?php echo base_url() . "asset/simpeg/"; ?>app-assets/css/plugins/file-uploaders/dropzone.css">
    <!-- END: Custom CSS-->

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css"
        href="<?php echo base_url() . "asset/simpeg/"; ?>app-assets/css/plugins/file-uploaders/dropzone.css">
    <link rel="stylesheet" type="text/css"
        href="<?php echo base_url() . "asset/simpeg/"; ?>app-assets/css/pages/data-list-view.css">
    <link rel="stylesheet" type="text/css"
        href="<?php echo base_url() . "asset/simpeg/"; ?>app-assets/css/pages/invoice.css">
    <!-- END: Page CSS-->

    <link rel="stylesheet" type="text/css"
        href="<?php echo base_url() . "asset/simpeg/"; ?>app-assets/css/plugins/extensions/noui-slider.min.css">
    <link rel="stylesheet" type="text/css"
        href="<?php echo base_url() . "asset/simpeg/"; ?>app-assets/css/pages/app-ecommerce-shop.css">
    <link rel="stylesheet" type="text/css"
        href="<?php echo base_url() . "asset/simpeg/"; ?>app-assets/css/pages/dashboard-analytics.css">
    <link rel="stylesheet" type="text/css"
        href="<?php echo base_url() . "asset/simpeg/"; ?>app-assets/css/pages/app-ecommerce-shop.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() . "asset/"; ?>custom.css">

    <style type="text/css">
        .tab-content {
            margin-top: unset;
        }
    </style>

<?php endif ?>