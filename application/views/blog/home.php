
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


    <!--================Home Banner Area =================-->
    <section class="home_banner_area">
        <div class="banner_inner">
            <div class="container">
                <div class="row">
                    <div class="col-lg-5">
                        <div class="banner_content">
                            <h2>
                               E-SAKIP <br>
                                Kab. Sumedang
                            </h2>
                            <p>
                                Mari Unjuk Kinerja untuk Sumedang Simpati (<b>MAUTI</b>)
                            </p>
                            <div class="d-flex align-items-center">
                                
                                <a id="play-home-video" class="video-play-button" href="https://www.youtube.com/watch?v=AF6vm6WS53M">
                                    <span></span>
                                </a>
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="home_right_img" >
                            <img class="img-fluid" src="<?php echo base_url()?>asset/landing/img/banner/home-right.png" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================End Home Banner Area =================-->

    <!--================Start Features Area =================-->
    <section class="section_gap features_area">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <div class="main_title">
                        <p class="top_title">Peran</p>
                        <h2>Sistem Akuntabilitas Kinerja Instansi Pemerintah</h2>
                        <p>Dalam Mewujudkan Efisiensi Birokrasi</p>
                        
                    </div>
                </div>
            </div>
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="left_features">
                        <img class="img-fluid" src="<?php echo base_url()?>asset/landing/img/diagram-sakip.png" alt="">
                    </div>
                </div>
                <div class="col-lg-5 offset-lg-1">
                    <!-- single features -->
                    <div class="single_feature">
                        <div class="feature_head">
                            <span class="lnr lnr-checkmark-circle"></span>
                            <h4>UU No. 17 Tahun 2003 tentang Keuangan Negara </h4>
                        </div>
                        <div class="feature_content">
                            <p>Asas pengelolaan keuangan negara adalah akuntabilitas  berorientasi hasil</p>
                        </div>
                    </div>
                    <!-- single features -->
                    <div class="single_feature">
                        <div class="feature_head">
                            <span class="lnr lnr-checkmark-circle"></span>
                            <h4>PP No. 8 Tahun 2006 tentang
Pelaporan Keuangan dan Kinerja Instansi Pemerintah</h4>
                        </div>
                        <div class="feature_content">
                            <p>Kewajiban melaporkan akuntabilitas keuangan dan akuntabilitas kinerja pemerintah</p>
                        </div>
                    </div>
                    <!-- single features -->
                    <div class="single_feature">
                        <div class="feature_head">
                            <span class="lnr lnr-checkmark-circle"></span>
                            <h4>Perpres No. 29 Tahun 2014 tentang Sistem Akuntabilitas Kinerja Instansi Pemerintah</h4>
                        </div>
                        <div class="feature_content">
                            <p>SAKIP diperlukan untuk meningkatkan efektivitas penggunaan anggaran berorientasi pada hasil
</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================End Features Area =================-->

    <!--================Recent Update Area =================-->
    <section class="recent_update_area">
        <div class="container">
            <div class="recent_update_inner">
                <ul class="nav nav-tabs justify-content-center" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">
                            <span class="lnr lnr-rocket"></span>
                            <h6>Perencanaan</h6>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile"
                         aria-selected="false">
                         <span class="lnr lnr-spell-check"></span>
                         <h6>Pengkuran</h6>
                        </a>
                    </li>
                 
                    <li class="nav-item">
                        <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact"
                         aria-selected="false">
                         <span class="lnr lnr-chart-bars"></span>
                         <h6>Pelaporan</h6>
                        </a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div class="row recent_update_text align-items-center">
                            <div class="col-lg-5">
                                <div class="common_style">
                                    <p class="line">Perencanaan</p>
                                   
                                    <p>Menu ini menampilkan daftar perencanaan yang akan dilakukan oleh setiap SKPD termasuk, penyusunan Renstra, Renja, IKU dan PK</p>
                                    <a class="primary_btn" href="<?php echo base_url()?>perencanaan_kinerja""><span>Selebihnya</span></a>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="chart_img">
                                    <img class="img-fluid" src="<?php echo base_url()?>data/icon/perencanaan.png" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <div class="row recent_update_text align-items-center">
                            <div class="col-lg-5">
                                <div class="common_style">
                                    <p class="line">Pengukuran</p>
                                 
                                    <p>Menu ini menampilkan pengukuran atas kinerja dari capaian realisasi target yang sudah direncanakan sebelumnya</p>
                                   <a class="primary_btn" href="<?php echo base_url()?>perencanaan_kinerja""><span>Selebihnya</span></a>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="chart_img">
                                    <img class="img-fluid" src="<?php echo base_url()?>data/icon/pengukuran.png" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade show active" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                        <div class="row recent_update_text align-items-center">
                            <div class="col-lg-5">
                                <div class="common_style">
                                    <p class="line">Pelaporan</p>
                                  
                                    <p>Menu ini menampilkan daftar file yang telah di upload oleh setiap SKPD yang tertuang didalam bentuk LAKIP</p>
                                     <a class="primary_btn" href="<?php echo base_url()?>perencanaan_kinerja""><span>Selebihnya</span></a>
                                </div>
                            </div>
                            <div class="col-lg-6 text-right">
                                <div class="chart_img">
                                    <img class="img-fluid" src="<?php echo base_url()?>data/icon/pelaporan.png" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================ Recent Update Area =================-->

 

    <!--================ Start Testimonial Area =================-->
    <div class="section_gap_top testimonial_area">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <div class="main_title">
                      
                        <h2>Sambutan </h2>
                       <p>Bupati Kab. Sumedang
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-6 text-center">
                    <div class="active_testimonial owl-carousel" data-slider-id="1">
                        <!-- single testimonial -->
                        <div class="single_testimonial">
                            <div class="testimonial_head">
                                <img src="<?=base_url()?>/data/images/sambutan/bupati2.jpg" alt="" class="img-circle" width="50px" style="width: 100px;">
                                <h4>H. Dony Ahmad Munir, ST.,M.M.</h4>
                               
                            </div>
                            <div>
                                <p>Selamat datang di Website E-Office Kab. Sumedang, Website ini dimaksudkan sebagai sarana publikasi untuk memberikan Informasi kinerja SKPD se-kab. Sumedang.

Kritik dan saran terhadap kekurangan dan kesalahan yang ada sangat kami harapkan guna penyempurnaan Website ini dimasa datang. Semoga Website ini memberikan manfaat bagi kita semua.</p>
                            </div>
                        </div>

                   
                
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--================ End Testimonial Area =================-->


    <!--================Impress Area =================-->
    <section class="impress_area">
        <div class="container">
            <div class="impress_inner">
                <h2>Ada Kritik, Saran Atau Perlu Bantuan ?</h2>
                <p>Silakan klik tombol dibawah ini untuk mengirim e-mail. Kami senantiasa menerima kritik dan saran serta informasi untuk dapat melayani masyarakat secara optimal</p>
                <a class="primary_btn" href=""mailto:someone@example.com?Subject=Hello%20again"><span>Kirim Email</span></a>
            </div>
        </div>
    </section>
    <!--================End Impress Area =================-->


    

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="<?php echo base_url()?>asset/landing/js/jquery-3.2.1.min.js"></script>
    <script src="<?php echo base_url()?>asset/landing/js/popper.js"></script>
    <script src="<?php echo base_url()?>asset/landing/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url()?>asset/landing/js/stellar.js"></script>
    <script src="<?php echo base_url()?>asset/landing/js/jquery.magnific-popup.min.js"></script>
    <script src="<?php echo base_url()?>asset/landing/vendors/nice-select/js/jquery.nice-select.min.js"></script>
    <script src="<?php echo base_url()?>asset/landing/vendors/isotope/imagesloaded.pkgd.min.js"></script>
    <script src="<?php echo base_url()?>asset/landing/vendors/isotope/isotope-min.js"></script>
    <script src="<?php echo base_url()?>asset/landing/vendors/owl-carousel/owl.carousel.min.js"></script>
    <script src="<?php echo base_url()?>asset/landing/js/jquery.ajaxchimp.min.js"></script>
    <script src="<?php echo base_url()?>asset/landing/vendors/counter-up/jquery.waypoints.min.js"></script>
    <script src="<?php echo base_url()?>asset/landing/vendors/counter-up/jquery.counterup.min.js"></script>
    <script src="<?php echo base_url()?>asset/landing/js/mail-script.js"></script>
    <!--gmaps Js-->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCjCGmQ0Uq4exrzdcL6rvxywDDOvfAu6eE"></script>
    <script src="<?php echo base_url()?>asset/landing/js/gmaps.min.js"></script>
    <script src="<?php echo base_url()?>asset/landing/js/theme.js"></script>
</body>

</html>