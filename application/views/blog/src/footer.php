<?php
$CI = &get_instance();
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
<!--================Footer Area =================-->
<footer class="footer_area section_gap">
  <div class="container">
    <div class="row footer_inner">
      <div class="col-lg-5 col-sm-6">
        <aside class="f_widget ab_widget">
          <div class="f_title">
            <h3>E-SAKIP</h3>
          </div>
          <p>(Sistem Akuntabilitas Kinerja Instansi Pemerintahan ) Adalah integrasi dari sistem perencanaan, sistem penganggaran dan sistem pelaporan kinerja, yang selaras dengan pelaksanaan sistem akuntabilitas keuangan</p>
          <p>
            Copyright <?= date('Y') ?> &copy; Made with <i class="fa fa-heart text-danger"></i> by <span class="text-primary">Diskominfosanditik Sumedang</span></p>
        </aside>
      </div>
      <div class="col-lg-5 col-sm-6">
        <aside class="f_widget news_widget">
          <div class="f_title">
            <h3>E-Office Kabupaten Sumedang</h3>
          </div>
          <p><?php echo $p_alamat; ?><br>
            Telepon: <span><?php echo $p_telepon; ?> </span><br>
            E-Mail:<span> <a href="#"><?php echo $p_email; ?></a> </span><br>

        </aside>
      </div>
      <div class="col-lg-2">
        <aside class="f_widget social_widget">
          <div class="f_title">
            <h3>Follow Kita</h3>
          </div>
          <p>di media sosial lainya</p>
          <ul class="list">
            <li><a href="<?php echo $p_facebook; ?>"><i class="fa fa-facebook"></i></a></li>
            <li><a href="<?php echo $p_twitter; ?>"><i class="fa fa-twitter"></i></a></li>
            <li><a href="<?php echo $p_instagram; ?>"><i class="fa fa-instagram"></i></a></li>

          </ul>
        </aside>
      </div>
    </div>
  </div>
</footer>
<!--================End Footer Area =================-->




<!-- Back To Top Button -->
<div id="backtotop"><a href="#"></a></div>


</div>
<!-- Wrapper / End -->



<!-- Scripts
================================================== -->
<script type="text/javascript" src="<?php echo base_url() . 'asset/skin/'; ?>scripts/jquery-2.2.0.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() . 'asset/skin/'; ?>scripts/jpanelmenu.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() . 'asset/skin/'; ?>scripts/chosen.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() . 'asset/skin/'; ?>scripts/slick.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() . 'asset/skin/'; ?>scripts/rangeslider.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() . 'asset/skin/'; ?>scripts/magnific-popup.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() . 'asset/skin/'; ?>scripts/waypoints.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() . 'asset/skin/'; ?>scripts/counterup.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() . 'asset/skin/'; ?>scripts/jquery-ui.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() . 'asset/skin/'; ?>scripts/tooltips.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() . 'asset/skin/'; ?>scripts/custom.js"></script>




<!-- REVOLUTION SLIDER SCRIPT -->
<script type="text/javascript" src="<?php echo base_url() . 'asset/skin/'; ?>scripts/themepunch.tools.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() . 'asset/skin/'; ?>scripts/themepunch.revolution.min.js"></script>

<script type="text/javascript">
  var tpj = jQuery;
  var revapi4;
  tpj(document).ready(function() {
    if (tpj("#rev_slider_4_1").revolution == undefined) {
      revslider_showDoubleJqueryError("#rev_slider_4_1");
    } else {
      revapi4 = tpj("#rev_slider_4_1").show().revolution({
        sliderType: "standard",
        jsFileLocation: "scripts/",
        sliderLayout: "auto",
        dottedOverlay: "none",
        delay: 9000,
        navigation: {
          keyboardNavigation: "off",
          keyboard_direction: "horizontal",
          mouseScrollNavigation: "off",
          onHoverStop: "on",
          touch: {
            touchenabled: "on",
            swipe_threshold: 75,
            swipe_min_touches: 1,
            swipe_direction: "horizontal",
            drag_block_vertical: false
          },
          arrows: {
            style: "zeus",
            enable: true,
            hide_onmobile: true,
            hide_under: 600,
            hide_onleave: true,
            hide_delay: 200,
            hide_delay_mobile: 1200,
            tmp: '<div class="tp-title-wrap"></div>',
            left: {
              h_align: "left",
              v_align: "center",
              h_offset: 40,
              v_offset: 0
            },
            right: {
              h_align: "right",
              v_align: "center",
              h_offset: 40,
              v_offset: 0
            }
          },
          bullets: {
            enable: false,
            hide_onmobile: true,
            hide_under: 600,
            style: "hermes",
            hide_onleave: true,
            hide_delay: 200,
            hide_delay_mobile: 1200,
            direction: "horizontal",
            h_align: "center",
            v_align: "bottom",
            h_offset: 0,
            v_offset: 32,
            space: 5,
            tmp: ''
          }
        },
        viewPort: {
          enable: true,
          outof: "pause",
          visible_area: "80%"
        },
        responsiveLevels: [1200, 992, 768, 480],
        visibilityLevels: [1200, 992, 768, 480],
        gridwidth: [1180, 1024, 778, 480],
        gridheight: [640, 500, 400, 300],
        lazyType: "none",
        parallax: {
          type: "mouse",
          origo: "slidercenter",
          speed: 2000,
          levels: [2, 3, 4, 5, 6, 7, 12, 16, 10, 25, 47, 48, 49, 50, 51, 55],
          type: "mouse",
        },
        shadow: 0,
        spinner: "off",
        stopLoop: "off",
        stopAfterLoops: -1,
        stopAtSlide: -1,
        shuffle: "off",
        autoHeight: "off",
        hideThumbsOnMobile: "off",
        hideSliderAtLimit: 0,
        hideCaptionAtLimit: 0,
        hideAllCaptionAtLilmit: 0,
        debugMode: false,
        fallbacks: {
          simplifyAll: "off",
          nextSlideOnWindowFocus: "off",
          disableFocusListener: false,
        }
      });
    }
  }); /*ready*/
</script>


<script type="text/javascript" src="<?php echo base_url() . 'asset/skin/'; ?>scripts/extensions/revolution.extension.actions.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() . 'asset/skin/'; ?>scripts/extensions/revolution.extension.carousel.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() . 'asset/skin/'; ?>scripts/extensions/revolution.extension.kenburn.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() . 'asset/skin/'; ?>scripts/extensions/revolution.extension.layeranimation.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() . 'asset/skin/'; ?>scripts/extensions/revolution.extension.migration.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() . 'asset/skin/'; ?>scripts/extensions/revolution.extension.navigation.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() . 'asset/skin/'; ?>scripts/extensions/revolution.extension.parallax.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() . 'asset/skin/'; ?>scripts/extensions/revolution.extension.slideanims.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() . 'asset/skin/'; ?>scripts/extensions/revolution.extension.video.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() . 'asset/skin/bootstrap/js/'; ?>bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() . 'asset/skin/lity/'; ?>lity.min.js"></script>
<script type="text/javascript" src="https://jedfoster.com/js/readmore.min.js"></script>

<script type="text/javascript">
  $(document).ready(function() {

    $('.tabs-menu a').click(function() {
      var tab_id = $(this).attr('data-tab');

      $('.tabs-menu a').removeClass('current');
      $('.tab-content').removeClass('current');

      $(this).addClass('current');
      $("#" + tab_id).addClass('current');
    })

    $('.readmore').readmore({
      collapsedHeight: 100,
      speed: 200,
      moreLink: '<a href="#">Selengkapnya</a>',
      lessLink: '<a href="#">Tutup</a>'
    });

  });
</script>

<script type="text/javascript">
  /**
   * Updates the donut chart's percent number and the CSS positioning of the progress bar.
   * Also allows you to set if it is a donut or pie chart
   * @param  {string}  el      The selector for the donut to update. '#thing'
   * @param  {number}  percent Passing in 22.3 will make the chart show 22%
   * @param  {boolean} donut   True shows donut, false shows pie
   */
  function updateDonutChart(el, percent, donut) {
    percent = Math.round(percent);
    if (percent > 100) {
      percent = 100;
    } else if (percent < 0) {
      percent = 0;
    }
    var deg = Math.round(360 * (percent / 100));

    if (percent > 50) {
      $(el + ' .pie').css('clip', 'rect(auto, auto, auto, auto)');
      $(el + ' .right-side').css('transform', 'rotate(180deg)');
    } else {
      $(el + ' .pie').css('clip', 'rect(0, 1em, 1em, 0.5em)');
      $(el + ' .right-side').css('transform', 'rotate(0deg)');
    }
    if (donut) {
      $(el + ' .right-side').css('border-width', '0.1em');
      $(el + ' .left-side').css('border-width', '0.1em');
      $(el + ' .shadow').css('border-width', '0.1em');
    } else {
      $(el + ' .right-side').css('border-width', '0.5em');
      $(el + ' .left-side').css('border-width', '0.5em');
      $(el + ' .shadow').css('border-width', '0.5em');
    }
    $(el + ' .num').text(percent);
    $(el + ' .left-side').css('transform', 'rotate(' + deg + 'deg)');
  }

  // Pass in a number for the percent
  updateDonutChart('#specificChart', 66.67, true);













  //Ignore the rest, it's for the input and checkbox

  $('#percent').change(function() {
    var percent = $(this).val();
    var donut = $('#donut input').is(':checked');
    updateDonutChart('#specificChart', percent, donut);
  }).keyup(function() {
    var percent = $(this).val();
    var donut = $('#donut input').is(':checked');
    updateDonutChart('#specificChart', percent, donut);
  });;

  $('#donut input').change(function() {
    var donut = $('#donut input').is(':checked');
    var percent = $("#percent").val();
    if (donut) {
      $('#donut span').html('Donut');
    } else {
      $('#donut span').html('Pie');
    }
    updateDonutChart('#specificChart', percent, donut);
  });
</script>

</body>

</html>