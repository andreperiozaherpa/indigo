<?php
  $CI =& get_instance();
  $CI->load->model('company_profile_model');
  $CI->company_profile_model->set_identity();
  $p_nama = $CI->company_profile_model->nama;
  $p_tentang = $CI->company_profile_model->tentang;
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

<style type="text/css">
.videoWrapper {
  position: relative;
  padding-bottom: 56.25%; /* 16:9 */
  padding-top: 25px;
  height: 0;
}
.videoWrapper iframe {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
}
</style>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.10&appId=1281033678674520";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<!-- Titlebar
================================================== -->


<div id="titlebar"  style="background: #ffffff fixed;margin-top: 30px;">
  <div class="container">
    <div class="row">
      <div class="col-md-12">

        <h2 class="putih"><?php echo $detail->judul ?></h2><span class="color">Detail Video</span>

        <!-- Breadcrumbs -->
        <nav id="breadcrumbs">
          <ul class="color">
            <li><a href=" <?php echo base_url().'home'; ?> ">Beranda</a></li>
            <li><a href="<?php echo base_url();?>video">Video</a></li>
              <li>detail video</li>
          </ul>
        </nav>

      </div>
    </div>
  </div>
</div>

<!-- Content
================================================== -->
<div class="container">

  <!-- Blog Posts -->
  <div class="blog-page">
  <div class="row">


    <!-- Post Content -->
    <div class="col-lg-9 col-md-8 padding-right-30">
      <?php
        parse_str( parse_url( $detail->link, PHP_URL_QUERY ), $code );
        $url_id =  $code['v']; 
        ?>

      <!-- Blog Post -->
      <div class="blog-post single-post">
<!-- <div class="video-container"> -->
<div class="videoWrapper">
    <!-- Copy & Pasted from YouTube -->
    <iframe width="560" height="349" src="http://www.youtube.com/embed/<?php echo $url_id?>?rel=0&hd=1" frameborder="0" allowfullscreen></iframe>
</div>
<!-- </div> -->
        
        <!-- Content -->
        <div class="post-content">

          <h3><?php echo $detail->judul;?></h3>

          <ul class="post-meta">
            <li><?php echo date('d M Y ',strtotime($detail->date_video)).$detail->time_video;?></li>
            <li><?php echo $detail->category_video_name ?></li>
          </ul>

          <?php echo $detail->content ?>

          <div class="clearfix"></div>

        </div>
      </div>
      <!-- Blog Post / End -->


    
      <div class="clearfix"></div>

    </div>
    <!-- Content / End -->



    <!-- Widgets -->
    <div class="col-lg-3 col-md-4">
    <div class="sidebar right">
      <form action="<?php echo base_url();?>video" method='get' style="width: 100%">
      <!-- Widget -->
      <div class="widget margin-bottom-40">
        <h3 class="margin-top-0 margin-bottom-30">Cari</h3>

        <!-- Row -->
        <div class="row with-forms">
          <!-- Cities -->
          <div class="col-md-12">
            <input name="s" type="text" placeholder="Masukan Nama Video" value="<?php if (!empty($search)) echo $search;?>"/>
          </div>
        </div>
        <!-- Row / End -->


        <!-- Row -->
        <div class="row with-forms">
          <!-- Type -->
          <div class="col-md-12">
            <select name="c" data-placeholder="Semua Kategori" class="chosen-select" >
              <option value="">Semua Kategori</option>  
              <?php
                foreach ($category as $row) {
                  $selected = "";
                  if ($row->category_id==$this->input->get('c')) {
                    $selected = "selected";
                  }
                  echo "<option value='{$row->category_video_id}' {$selected}>{$row->category_video_name}</option>";
                }
              ?>
            </select>
          </div>
        </div>
        <!-- Row / End -->

      

        

        <button class="button fullwidth margin-top-25">Cari</button>

      </div>
      <!-- Widget / End -->

      </form>

      <div class="clearfix"></div>
      <div class="margin-bottom-40"></div>
    </div>
    </div>
    </div>
    <!-- Sidebar / End -->


  </div>
</div>