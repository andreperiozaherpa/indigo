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


<!-- Titlebar
================================================== -->
<div id="titlebar"  style="background: url('data/images/bg_hello.png') #29333e fixed;">
   <div class="container" style="margin-top:10px;">
    <div class="row">
      <div class="col-md-12">

        <h2 class="putih">Download</h2><span class="color">Daftar File Publikasi</span>

        <!-- Breadcrumbs -->
        <nav id="breadcrumbs">
          <ul class="color">
            <li><a href="<?php echo base_url();?>">Home</a></li>
            <li>Download</li>
          </ul>
        </nav>

      </div>
    </div>
  </div>
</div>

    <!-- Start Content -->
    <div id="content">
      <div class="container">

          <style type="text/css">         
            .option-set{
                padding:0;
                margin:0
            }
            .option-set li{
                display:inline-block;
                margin-right:2px
            }
            .option-set li a{
                background:0 0;
                padding:5px 16px;
                display:block;
                outline:0;
                border:0;
                font-weight:600;
                float:right;
                margin:0;
                font-size:15px;
                border-radius:50px;
                background-color:#f0f0f0;
                color:#666;
                line-height:26px;
                transition:all .3s
            }
            .option-set li a:hover{
                background-color:#e9e9e9
            }
            .option-set li a.selected{
                color:#fff;
                background-color:#66676b
            }
          </style>

          <div class="row">
            <div class="col-md-12">

              <!-- Filters -->
              <div id="filters">
                <ul class="option-set margin-bottom-30">
                  <li><a href="#filter" class="selected" data-filter="*">All</a></li>
                  <?php 
                    $this->load->helper('file');
                    $list_file = array();
                    $list_tgl = array();
                    foreach ($download as $filter) {
                      $mime = get_mime_by_extension($filter->nama_file);
                      $ext = url_title(get_mime_by_extension($filter->nama_file),"-",TRUE);

                      if (!in_array($mime, $list_file)) {
                        $tmp_list_file = array($ext => $mime);
                        $list_file = array_merge($list_file,$tmp_list_file);
                      }

                      if (!in_array($filter->tgl_posting, $list_tgl)) {
                        $tmp_list_tgl = array($filter->tgl_posting => $filter->tgl_posting);
                        $list_tgl = array_merge($list_tgl,$tmp_list_tgl);
                      }

                    }

                    $list = array_merge($list_file,$list_tgl);

                    foreach ($list as $key => $value) {
                      echo '<li><a href="#filter" data-filter=".'.$key.'">'.$value.'</a></li>';
                    }
                  ?>
                </ul>
                <div class="clearfix"></div>
              </div>

            </div>
          </div>

        <div class="row">

          <!-- Projects -->
          <div class="projects isotope-wrapper">

              <?php $no = 1;?>
              <?php foreach ($download as $row ) :?>

              <!-- Listing Item -->
              <div class="col-lg-4 col-md-6 isotope-item third-filter first-filter <?=$row->tgl_posting?> <?=url_title(get_mime_by_extension($row->nama_file),"-",TRUE)?>">
                <a href="<?=base_url()."data/download/{$row->nama_file}"?>" target="_blank" class="listing-item-container compact" style="background-color: #222">
                  <div class="listing-item">
                    <img src="<?=base_url()."data/download/{$row->nama_file}"?>" alt="">
                    <div class="listing-badge now-open"></div>
                    <div class="listing-item-details">
                      <ul>
                        <li><?=$row->tgl_posting?></li>
                      </ul>
                    </div>
                    <div class="listing-item-content">
                      <!--span class="tag"></span-->
                      <div class="numerical-rating" data-rating="<?=$row->hits?>"></div>
                      <h3><!--i class="verified-icon"></i--></h3>
                      <span><?=$row->judul?></span>
                    </div>
                    <!--span class="like-icon"></span-->
                  </div>
                  <div class="star-rating"  style="padding: 15px 32px;">
                    <div class="rating-counter"><h6 style="color: #0094a1"><?=get_mime_by_extension($row->nama_file)?></h6></div>
                  </div>

                </a>
              </div>
              <!-- Listing Item / End -->

              <?php 
                $no++;
                endforeach;
              ?>
            

          </div>

        </div>


  </div>
  </div>
    <!-- End Content -->


