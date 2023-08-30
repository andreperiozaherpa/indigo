<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="<?php echo base_url().'data/logo/e.png';?>" type="image/png">
    <title><?php if (!empty($title)) echo $title;?></title>
    <!-- Bootstrap CSS -->
<link rel="stylesheet" href="<?php echo base_url().'asset/skin/';?>css/style.css">
<link rel="stylesheet" href="<?php echo base_url().'asset/skin/';?>css/colors/purple.css" id="colors">
    <link rel="stylesheet" href="<?php echo base_url()?>asset/landing/css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo base_url()?>asset/landing/vendors/linericon/style.css">
    <link rel="stylesheet" href="<?php echo base_url()?>asset/landing/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo base_url()?>asset/landing/vendors/owl-carousel/owl.carousel.min.css">
    <link rel="stylesheet" href="<?php echo base_url()?>asset/landing/css/magnific-popup.css">
    <link rel="stylesheet" href="<?php echo base_url()?>asset/landing/vendors/nice-select/css/nice-select.css">
    <link rel="stylesheet" href="<?php echo base_url()?>asset/landing/vendors/animate-css/animate.css">
    <link rel="stylesheet" href="<?php echo base_url()?>asset/landing/vendors/flaticon/flaticon.css">
    <!-- main css -->
    <link rel="stylesheet" href="<?php echo base_url()?>asset/landing/css/style.css?v=2.0">

    <style type="text/css">

    html,
    body {

    }

    #percent {
      display: block;
      width: 160px;
      border: 1px solid #CCC;
      border-radius: 5px;
      margin: 50px auto 20px;
      padding: 10px;
      color: #6610f2;

    }

    #donut {
      display: block;
      margin: 0px auto;
      color: #6610f2;
      font-size: 20px;
      text-align: center;
    }

    p {
      font-weight: normal;

    }

    .donut-size {
      font-size: 12em;
    }

    .pie-wrapper {
      position: relative;
      width: 1em;
      height: 1em;
      margin: 0px auto;
    }
    .pie-wrapper .pie {
      position: absolute;
      top: 0px;
      left: 0px;
      width: 100%;
      height: 100%;
      clip: rect(0, 1em, 1em, 0.5em);
    }
    .pie-wrapper .half-circle {
      position: absolute;
      top: 0px;
      left: 0px;
      width: 100%;
      height: 100%;
      border: 0.1em solid #6610f2;
      border-radius: 50%;
      clip: rect(0em, 0.5em, 1em, 0em);
    }
    .pie-wrapper .right-side {
      -webkit-transform: rotate(0deg);
              transform: rotate(0deg);
    }
    .pie-wrapper .label {
      position: absolute;
      top: 0.52em;
      right: 0.4em;
      bottom: 0.4em;
      left: 0.4em;
      display: block;
      background: none;
      border-radius: 50%;
      color: #7F8C8D;
      font-size: 0.25em;
      line-height: 2.6em;
      text-align: center;
      cursor: default;
      z-index: 2;
    }
    .pie-wrapper .smaller {
      padding-bottom: 20px;
      color: #BDC3C7;
      font-size: 0.45em;
      vertical-align: super;
    }
    .pie-wrapper .shadow {
      width: 100%;
      height: 100%;
      border: 0.1em solid #BDC3C7;
      border-radius: 50%;
    }
    </style>
</head>
