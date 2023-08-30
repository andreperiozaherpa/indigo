<?php
  $CI =& get_instance();
  $CI->load->model('company_profile_model');
  $CI->company_profile_model->set_identity();
  $p_nama = $CI->company_profile_model->nama;
  $p_alamat = $CI->company_profile_model->alamat;
  $p_logo = $CI->company_profile_model->logo;
  $p_email = $CI->company_profile_model->email;
  $p_facebook = $CI->company_profile_model->facebook;
  $p_twitter = $CI->company_profile_model->twitter;
  $p_telepon = $CI->company_profile_model->telepon;
  $p_youtube = $CI->company_profile_model->youtube;
  $p_gmap = $CI->company_profile_model->gmap;
  $p_tentang = $CI->company_profile_model->tentang;
  $p_instagram = $CI->company_profile_model->instagram;
?>

<!-- Footer
================================================== -->
<div id="footer" >
  <!-- Main -->
  <div class="container">
    <div class="row">
      <div class="col-md-5 col-sm-6">
        <img class="footer-logo" src="images/logo.png" alt="">
        <br><br>
        <p><?php echo $p_tentang ;?></p>
      </div>

      <div class="col-md-4 col-sm-6 ">
        <h4>Helpful Links</h4>
        <ul class="footer-links">
          <li><a href="#">Home</a></li>
          <li><a href="#">Consult</a></li>
          <li><a href="#">Product</a></li>
          <li><a href="#">Services</a></li>
         
        </ul>

        <ul class="footer-links">
          <li><a href="#">FAQ</a></li>
          <li><a href="#">Blog</a></li>
          <li><a href="#">Our Partners</a></li>
        </ul>
        <div class="clearfix"></div>
      </div>    

      <div class="col-md-3  col-sm-12">
        <h4>Contact Us</h4>
        <div class="text-widget">
          <span><?php echo $p_alamat; ?></span> <br>
          Phone: <span><?php echo $p_telepon; ?> </span><br>
          E-Mail:<span> <a href="#"><?php echo $p_email; ?></a> </span><br>
        </div>

        <ul class="social-icons margin-top-20">
          <li class="box-social"><a href="<?php echo $p_facebook; ?>" target="_blank"><i class="ion-social-facebook"></i></a></li>
                <li class="box-social"><a href="<?php echo $p_instagram; ?>"><i class="ion-social-instagram-outline" target="_blank"></i></a></li>
                <li class="box-social"><a href="<?php echo $p_twitter; ?>"><i class="ion-social-twitter" target="_blank"></i></a></li>
        </ul>

      </div>

    </div>
    
    <!-- Copyright -->
    <div class="row">
      <div class="col-md-12">
        <div class="copyrights">© 2017 IM Creative Studio. All Rights Reserved.</div>
      </div>
    </div>

  </div>

</div>
<!-- Footer / End -->


<!-- Back To Top Button -->
<div id="backtotop"><a href="#"></a></div>


</div>
<!-- Wrapper / End -->



<!-- Scripts
================================================== -->
<script type="text/javascript" src="<?php echo base_url().'asset/skin/';?>scripts/jquery-2.2.0.min.js"></script>
<script type="text/javascript" src="<?php echo base_url().'asset/skin/';?>scripts/jpanelmenu.min.js"></script>
<script type="text/javascript" src="<?php echo base_url().'asset/skin/';?>scripts/chosen.min.js"></script>
<script type="text/javascript" src="<?php echo base_url().'asset/skin/';?>scripts/slick.min.js"></script>
<script type="text/javascript" src="<?php echo base_url().'asset/skin/';?>scripts/rangeslider.min.js"></script>
<script type="text/javascript" src="<?php echo base_url().'asset/skin/';?>scripts/magnific-popup.min.js"></script>
<script type="text/javascript" src="<?php echo base_url().'asset/skin/';?>scripts/waypoints.min.js"></script>
<script type="text/javascript" src="<?php echo base_url().'asset/skin/';?>scripts/counterup.min.js"></script>
<script type="text/javascript" src="<?php echo base_url().'asset/skin/';?>scripts/jquery-ui.min.js"></script>
<script type="text/javascript" src="<?php echo base_url().'asset/skin/';?>scripts/tooltips.min.js"></script>
<script type="text/javascript" src="<?php echo base_url().'asset/skin/';?>scripts/custom.js"></script>



<!-- Maps -->
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&amp;language=en"></script>
<script type="text/javascript" src="<?php echo base_url().'asset/skin/';?>scripts/infobox.min.js"></script>
<script type="text/javascript" src="<?php echo base_url().'asset/skin/';?>scripts/markerclusterer.js"></script>
<script type="text/javascript" src="<?php echo base_url().'asset/skin/';?>scripts/maps.js"></script>


        
        <!-- Owl Carousel -->
        <script src="<?php echo base_url().'asset/skin/';?>js/owl.carousel.min.js"></script>
        <!-- Portfolio Filtering -->
        <script src="<?php echo base_url().'asset/skin/';?>js/jquery.mixitup.min2.js"></script>
        <!-- Jappear js -->
        <script src="<?php echo base_url().'asset/skin/';?>js/jquery.appear.js"></script>
        <!-- tweetie.min -->
        <script src="<?php echo base_url().'asset/skin/';?>js/tweetie.min.js"></script>
        <!-- Highlight menu item -->
        <script src="<?php echo base_url().'asset/skin/';?>js/jquery.nav.js"></script>
        <!-- Sticky Nav -->
        <script src="<?php echo base_url().'asset/skin/';?>js/jquery.sticky.js"></script>
        <!-- wow.min Script -->
        <script src="<?php echo base_url().'asset/skin/';?>js/wow.min.js"></script>
        <!-- For video responsive -->
        <script src="<?php echo base_url().'asset/skin/';?>js/jquery.fitvids.js"></script>
        <!-- Grid js -->
        <script src="<?php echo base_url().'asset/skin/';?>js/grid.js"></script>
        <!-- Custom js -->
        <script src="<?php echo base_url().'asset/skin/';?>js/custom2.js"></script>


    <!-- jQuery -->
    <script src="<?php echo base_url().'asset/skin/';?>js/jquery-2.1.1.js"></script>
    <!--  plugins -->
    <script src="<?php echo base_url().'asset/skin/';?>js/bootstrap.min.js"></script>
    <!--script src="<?php echo base_url().'asset/skin/';?>js/menu.js"></script-->
    <script src="<?php echo base_url().'asset/skin/';?>js/animated-headline.js"></script>
    <script src="<?php echo base_url().'asset/skin/';?>js/isotope.pkgd.min.js"></script>


    <!--  custom script -->
    <script src="<?php echo base_url().'asset/skin/';?>js/custom.js"></script>


<script src="<?php echo base_url().'asset/skin/';?>js/main.js"></script>
 <script src="<?php echo base_url().'asset/skin/';?>js/script.js"></script>
<script src="<?php echo base_url().'asset/skin/';?>js/waypoints.min.js"></script>

<!-- Style Switcher
================================================== -->
<script src="<?php echo base_url().'asset/skin/';?>scripts/switcher.js"></script>

<div id="style-switcher">
  <h2>Color Switcher <a href="#"><i class="sl sl-icon-settings"></i></a></h2>
  
  <div>
    <ul class="colors" id="color1">
      <li><a href="#" class="main" title="Main"></a></li>
      <li><a href="#" class="blue" title="Blue"></a></li>
      <li><a href="#" class="green" title="Green"></a></li>
      <li><a href="#" class="orange" title="Orange"></a></li>
      <li><a href="#" class="navy" title="Navy"></a></li>
      <li><a href="#" class="yellow" title="Yellow"></a></li>
      <li><a href="#" class="peach" title="Peach"></a></li>
      <li><a href="#" class="beige" title="Beige"></a></li>
      <li><a href="#" class="purple" title="Purple"></a></li>
      <li><a href="#" class="celadon" title="Celadon"></a></li>
      <li><a href="#" class="red" title="Red"></a></li>
      <li><a href="#" class="brown" title="Brown"></a></li>
      <li><a href="#" class="cherry" title="Cherry"></a></li>
      <li><a href="#" class="cyan" title="Cyan"></a></li>
      <li><a href="#" class="gray" title="Gray"></a></li>
      <li><a href="#" class="olive" title="Olive"></a></li>
    </ul>
  </div>
    
</div>
<!-- Style Switcher / End -->

