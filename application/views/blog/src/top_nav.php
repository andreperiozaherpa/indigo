<?php
  $CI =& get_instance();
  $CI->load->model('company_profile_model');
  $CI->company_profile_model->set_identity();
  //$p_nama = $CI->company_profile_model->nama;
  //$p_alamat = $CI->company_profile_model->alamat;
  $p_logo = $CI->company_profile_model->logo;
  //$p_email = $CI->company_profile_model->email;
  //$p_facebook = $CI->company_profile_model->facebook;
  //$p_twitter = $CI->company_profile_model->twitter;
  //$p_telepon = $CI->company_profile_model->telepon;
  //$p_youtube = $CI->company_profile_model->youtube;
  //$p_gmap = $CI->company_profile_model->gmap;
  //$p_tentang = $CI->company_profile_model->tentang;
  //$p_instagram = $CI->company_profile_model->instagram;
?>

<body>

    <!--================Header Menu Area =================-->
    <header class="header_area">
        <div class="main_menu">
            <nav class="navbar navbar-expand-lg navbar-light">
                <div class="container">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <a class="navbar-brand logo_h" href="<?php echo base_url()?>home"><img src="<?php echo base_url()?>data/logo/e.png" alt="" height="50px"><img src="<?php echo base_url()?>data/logo/office.png" alt="" height="50px"></a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                     aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
                        <ul class="nav navbar-nav menu_nav justify-content-center">
                            <li class="nav-item active"><a class="nav-link" href="<?php echo base_url()?>home">Beranda</a></li>
                            <li class="nav-item"><a class="nav-link" href="<?php echo base_url()?>perencanaan_kinerja">Perencanaan</a></li>
                            <li class="nav-item"><a class="nav-link" href="<?php echo base_url()?>pencapaian_kinerja">Pencapaian</a></li>
                            <!-- <li class="nav-item"><a class="nav-link" href="<?php echo base_url()?>pengukuran_kinerja">Pengukuran</a></li>
                            <li class="nav-item"><a class="nav-link" href="<?php echo base_url()?>evaluasi_kinerja">Evaluasi</a></li>
                            <li class="nav-item"><a class="nav-link" href="<?php echo base_url()?>pelaporan_kinerja">Pelaporan</a></li> -->

                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                            <li class="nav-item"><a href="<?php echo base_url()?>login" class="primary_btn text-uppercase">Masuk</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </header>
    <!--================Header Menu Area =================-->
