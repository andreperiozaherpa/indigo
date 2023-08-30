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
<div id="footer" class="margin-top-45">
  <!-- Main -->
  <div class="container">
    <div class="row">
      <div class="col-md-5 col-sm-6">
        <img class="footer-logo" src="<?php echo base_url()?>data/logo/logosipinter.png" alt="" height="80px" style="height: 80px!important; max-height: 80px   ">
        <br><br>
        <p><?php echo $p_tentang ;?></p>
      </div>

      <div class="col-md-4 col-sm-6 ">
        <h4>Link Terkait</h4>
        <ul class="footer-links">
          <li><a href="<?php echo base_url()?>home">Beranda</a></li>
           <li><a href="<?php echo base_url()?>perencanaan_kinerja">Perencanaan</a></li>
  
       
      
        </ul>

        <ul class="footer-links">
        
         
           <li><a href="<?php echo base_url()?>pengukuran_kinerja">Pengukuran</a></li>
           <li><a href="<?php echo base_url()?>pelaporan_kinerja">Pelaporan</a></li>
           <li><a href="<?php echo base_url()?>evaluasi_kinerja">Evaluasi</a></li>
        </ul>
        <div class="clearfix"></div>
      </div>    

      <div class="col-md-3  col-sm-12">
        <h4>Kontak Kami</h4>
        <div class="text-widget">
          <span><?php echo $p_alamat; ?></span> <br>
          Telepon: <span><?php echo $p_telepon; ?> </span><br>
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
        <div class="copyrights">© 2018 Badan Nasional Penanggulangan Terorisme</div>
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


<script type="text/javascript" src="<?php echo base_url().'asset/skin/';?>scripts/themepunch.tools.min.js"></script>
<script type="text/javascript" src="<?php echo base_url().'asset/skin/';?>scripts/themepunch.revolution.min.js"></script>

<script type="text/javascript">
  var tpj=jQuery;
  var revapi4;
  tpj(document).ready(function() {
    if(tpj("#rev_slider_4_1").revolution == undefined){
      revslider_showDoubleJqueryError("#rev_slider_4_1");
    }else{
      revapi4 = tpj("#rev_slider_4_1").show().revolution({
        sliderType:"standard",
        jsFileLocation:"scripts/",
        sliderLayout:"auto",
        dottedOverlay:"none",
        delay:9000,
        navigation: {
          keyboardNavigation:"off",
          keyboard_direction: "horizontal",
          mouseScrollNavigation:"off",
          onHoverStop:"on",
          touch:{
            touchenabled:"on",
            swipe_threshold: 75,
            swipe_min_touches: 1,
            swipe_direction: "horizontal",
            drag_block_vertical: false
          }
          ,
          arrows: {
            style:"zeus",
            enable:true,
            hide_onmobile:true,
            hide_under:600,
            hide_onleave:true,
            hide_delay:200,
            hide_delay_mobile:1200,
            tmp:'<div class="tp-title-wrap"></div>',
            left: {
              h_align:"left",
              v_align:"center",
              h_offset:40,
              v_offset:0
            },
            right: {
              h_align:"right",
              v_align:"center",
              h_offset:40,
              v_offset:0
            }
          }
          ,
          bullets: {
        enable:false,
        hide_onmobile:true,
        hide_under:600,
        style:"hermes",
        hide_onleave:true,
        hide_delay:200,
        hide_delay_mobile:1200,
        direction:"horizontal",
        h_align:"center",
        v_align:"bottom",
        h_offset:0,
        v_offset:32,
        space:5,
        tmp:''
          }
        },
        viewPort: {
          enable:true,
          outof:"pause",
          visible_area:"80%"
      },
      responsiveLevels:[1200,992,768,480],
      visibilityLevels:[1200,992,768,480],
      gridwidth:[1180,1024,778,480],
      gridheight:[640,500,400,300],
      lazyType:"none",
      parallax: {
        type:"mouse",
        origo:"slidercenter",
        speed:2000,
        levels:[2,3,4,5,6,7,12,16,10,25,47,48,49,50,51,55],
        type:"mouse",
      },
      shadow:0,
      spinner:"off",
      stopLoop:"off",
      stopAfterLoops:-1,
      stopAtSlide:-1,
      shuffle:"off",
      autoHeight:"off",
      hideThumbsOnMobile:"off",
      hideSliderAtLimit:0,
      hideCaptionAtLimit:0,
      hideAllCaptionAtLilmit:0,
      debugMode:false,
      fallbacks: {
        simplifyAll:"off",
        nextSlideOnWindowFocus:"off",
        disableFocusListener:false,
      }
    });
    }
  }); /*ready*/
</script>


<script type="text/javascript" src="<?php echo base_url().'asset/skin/';?>scripts/extensions/revolution.extension.actions.min.js"></script>
<script type="text/javascript" src="<?php echo base_url().'asset/skin/';?>scripts/extensions/revolution.extension.carousel.min.js"></script>
<script type="text/javascript" src="<?php echo base_url().'asset/skin/';?>scripts/extensions/revolution.extension.kenburn.min.js"></script>
<script type="text/javascript" src="<?php echo base_url().'asset/skin/';?>scripts/extensions/revolution.extension.layeranimation.min.js"></script>
<script type="text/javascript" src="<?php echo base_url().'asset/skin/';?>scripts/extensions/revolution.extension.migration.min.js"></script>
<script type="text/javascript" src="<?php echo base_url().'asset/skin/';?>scripts/extensions/revolution.extension.navigation.min.js"></script>
<script type="text/javascript" src="<?php echo base_url().'asset/skin/';?>scripts/extensions/revolution.extension.parallax.min.js"></script>
<script type="text/javascript" src="<?php echo base_url().'asset/skin/';?>scripts/extensions/revolution.extension.slideanims.min.js"></script>
<script type="text/javascript" src="<?php echo base_url().'asset/skin/';?>scripts/extensions/revolution.extension.video.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.min.js"></script>
<script type="text/javascript" src="<?php echo base_url().'asset/skin/bootstrap/js/';?>bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo base_url().'asset/skin/lity/';?>lity.min.js"></script>

<script type="text/javascript">
  $(document).ready(function(){
  
  $('.tabs-menu a').click(function(){
    var tab_id = $(this).attr('data-tab');

    $('.tabs-menu a').removeClass('current');
    $('.tab-content').removeClass('current');

    $(this).addClass('current');
    $("#"+tab_id).addClass('current');
  })

})
</script>



</body>
</html>
