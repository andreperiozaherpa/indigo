<!DOCTYPE html>
<html lang="en">
  <head>
  
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
    <title><?php echo $title ;?></title>
  <link rel="icon" type="image/png" href="<?php echo base_url().'data/logo/simon.png';?>">

    <link href="<?php echo base_url()."asset/pixel/inverse/" ;?>bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- animation CSS -->
 <link href="<?php echo base_url()."asset/pixel/inverse/" ;?>css/animate.css" rel="stylesheet">
<!-- Custom CSS -->
    <link href="<?php echo base_url()."asset/pixel/inverse/" ;?>css/style.css" rel="stylesheet">
<!-- color CSS -->
    <link href="<?php echo base_url()."asset/pixel/inverse/" ;?>css/colors/default.css" id="theme" rel="stylesheet">


  </head>
  <body class="page-body login-page login-form-fall" data-url="http://neon.dev">


<!-- This is needed when you send requests via Ajax --><script type="text/javascript">
var baseurl = "<?php echo base_url();?>/admin";
</script>

<!-- Preloader -->
<div class="preloader">
  <div class="cssload-speeding-wheel"></div>
</div>
<section id="wrapper" class="login-register">
  <div class="login-box login-sidebar">
    <div class="white-box">
      <form class="form-horizontal form-material" id="loginform" method="POST">
        <a href="javascript:void(0)" class="text-center db"><img src="<?php echo base_url().'data/logo/e.png';?>" height="50px;" /><img src="<?php echo base_url().'data/logo/office.png';?>" height="50px;" /></a>  
         <?php if(!empty($pesan)){
        echo"
        <div class='alert alert-danger'><strong>Opps.. </strong>$pesan</div>
      ";}?>
        <div class="form-group m-t-40">
          <div class="col-xs-12">
            <input class="form-control" name="username" type="text" required="" placeholder="Username">
          </div>
        </div>
        <div class="form-group">
          <div class="col-xs-12">
            <input class="form-control" name="password" type="password" required="" placeholder="Password">
          </div>
        </div>
        <div class="form-group">
          <div class="col-md-12">
            <div class="checkbox checkbox-primary pull-left p-t-0">
              <input id="checkbox-signup" type="checkbox">
              <label for="checkbox-signup"> Remember me </label>
            </div></div>
        </div>
        <div class="form-group text-center m-t-20">
          <div class="col-xs-12">
            <button class="btn btn-primary btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Log In</button>
          </div>
        </div>
        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-12 m-t-10 text-center">
          </div>
        </div>
      </form>



    </div>

    <center>
    Digital Signature By:
    <img src="<?php echo base_url().'data/logo/logo-bsre.png';?>" style="width: 100px" ></center>
  </div>
</section>
    
    
    <!-- jQuery -->
    <script src="<?php echo base_url()."asset/pixel/" ;?>plugins/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url()."asset/pixel/inverse/" ;?>bootstrap/dist/js/bootstrap.min.js"></script>
      <script src="<?php echo base_url()."asset/pixel/" ;?>plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js"></script>
    <!--slimscroll JavaScript -->
    <script src="<?php echo base_url()."asset/pixel/inverse/" ;?>js/jquery.slimscroll.js"></script>
        <script src="<?php echo base_url()."asset/pixel/inverse/" ;?>js/waves.js"></script>
            <script src="<?php echo base_url()."asset/pixel/inverse/" ;?>js/custom.min.js"></script>
             <!--Style Switcher -->
    <script src="<?php echo base_url()."asset/pixel/" ;?>plugins/bower_components/styleswitcher/jQuery.style.switcher.js"></script>

  </body>
</html>