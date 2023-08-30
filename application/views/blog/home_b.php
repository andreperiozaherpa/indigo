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


<?php $this->load->view('blog/src/header_home');?>
<style type="text/css">
/*            ul.tabs{
            margin: 0px;
            padding: 0px;
            list-style: none;
        }
        ul.tabs li{
            background: none;
            color: #222;
            display: inline-block;
            padding: 10px 15px;
            cursor: pointer;
        }

        ul.tabs li.current{
            background: #ededed;
            color: #222;
        }*/
@keyframes fade-in
{
    from {
        opacity:0;
    }
    to {
        opacity:1;
    }
}
@-moz-keyframes fade-in
{
    from {
        opacity:0;
    }
    to {
        opacity:1;
    }
}
@-webkit-keyframes fade-in
{
    from {
        opacity:0;
    }
    to {
        opacity:1;
    }
}
        .tab-content{
            display: none;        }

        .tab-content.current{
            display: block;
    animation: fade-in 0.5s;
    -moz-animation: fade-in 0.5s;
    -webkit-animation: fade-in 0.5s;
        }

        h4.headline span{
            margin-top: 0px !important;
            font-size: 15px;
        }


</style>
<!-- Wrapper -->
<div id="wrapper">

    <?php $this->load->view('blog/src/top_nav');?>
    <div class="clearfix"></div>
    <!-- Header Container / End -->



<!-- Slider
    ================================================== -->

    <!-- Revolution Slider -->
    <div id="rev_slider_4_1_wrapper" class="rev_slider_wrapper fullwidthbanner-container" data-alias="classicslider1" style="margin:0px auto;background-color:transparent;padding:0px;margin-top:0px;margin-bottom:0px;">

        <!-- 5.0.7 auto mode -->
        <div id="rev_slider_4_1" class="rev_slider home fullwidthabanner" style="display:none;" data-version="5.0.7">
            <ul>

            <?php foreach ($header as $no => $h): ?>
                <!-- Slide  -->
                <li data-index="rs-<?php echo $no; ?>" data-transition="fade" data-slotamount="default"  data-easein="Power4.easeInOut" data-easeout="Power4.easeInOut" data-masterspeed="1000"  data-rotate="0"  data-fstransition="fade" data-fsmasterspeed="800" data-fsslotamount="7" data-saveperformance="off">

                    <!-- Background -->
                    <img src="<?php echo base_url().'data/images/header/'.$h->gbr_header;?>" alt="" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" data-bgparallax="10" class="rev-slidebg" data-no-retina data-kenburns="on" data-duration="12000" data-ease="Linear.easeNone" data-scalestart="100" data-scaleend="100" data-rotatestart="0" data-rotateend="0" data-offsetstart="0 0" data-offsetend="0 0">

                    <!-- Caption-->
                    <div class="tp-caption custom-caption-2 tp-shape tp-shapewrapper tp-resizeme rs-parallaxlevel-0"
                    id="slide-1-layer-2"
                    data-x="['left','left','left','left']"
                    data-hoffset="['0','40','40','40']"
                    data-y="['middle','middle','middle','middle']" data-voffset="['0']"
                    data-width="['640','640', 640','420','320']"
                    data-height="auto"
                    data-whitespace="nowrap"
                    data-transform_idle="o:1;"
                    data-transform_in="y:0;opacity:0;s:1000;e:Power2.easeOutExpo;s:400;e:Power2.easeOutExpo"
                    data-transform_out=""
                    data-mask_in="x:0px;y:[20%];s:inherit;e:inherit;"
                    data-mask_out="x:inherit;y:inherit;s:inherit;e:inherit;"
                    data-start="1000"
                    data-responsive_offset="on">

                    <!-- Caption Content -->
                    <div class="R_title margin-bottom-15"
                    id="slide-2-layer-1"
                    data-x="['left','center','center','center']"
                    data-hoffset="['0','0','40','0']"
                    data-y="['middle','middle','middle','middle']"
                    data-voffset="['-40','-40','-20','-80']"
                    data-fontsize="['42','36', '32','36','22']"
                    data-lineheight="['70','60','60','45','35']"
                    data-width="['640','640', 640','420','320']"
                    data-height="none" data-whitespace="normal"
                    data-transform_idle="o:1;"
                    data-transform_in="y:-50px;sX:2;sY:2;opacity:0;s:1000;e:Power4.easeOut;"
                    data-transform_out="opacity:0;s:300;"
                    data-start="600"
                    data-splitin="none"
                    data-splitout="none"
                    data-basealign="slide"
                    data-responsive_offset="off"
                    data-responsive="off"
                    style="z-index: 6; color: #fff; letter-spacing: 0px; font-weight: 600; "><?php echo $h->judul; ?></div>

                    <div class="caption-text"><?php echo $h->deskripsi; ?></div>
                    <a href="<?php echo $h->link; ?>" class="button medium"><?php echo $h->text; ?></a>
                </div>

            </li>

            <?php endforeach ?>

    </ul>
    <div class="tp-static-layers"></div>

</div>
</div>
<!-- Revolution Slider / End -->


<!-- Content
    ================================================== -->
<style type="text/css">
 .con {
    position: relative;
    text-align: center;
    color: white;
}

/* Bottom left text */
.bottom-left {
    position: absolute;
    bottom: 8px;
    left: 16px;
}

/* Top left text */
.top-left {
    position: absolute;
    top: 8px;
    left: 16px;
}

/* Top right text */
.top-right {
    position: absolute;
    top: 8px;
    right: 16px;
}

/* Bottom right text */
.bottom-right {
    position: absolute;
    bottom: 8px;
    right: 16px;
}

/* Centered text */
.centered-text {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}
</style>
    <!-- Container -->
    <div class="container">
        <div class="row margin-top-40 margin-bottom-30">
           <!-- Main container -->
    <div class="container main-container clearfix " id="about"> 
        <div class="col-md-6">
            <!-- <a href="//www.youtube.com/watch?v=XSGBVzeBUbk" data-lity>iFrame Youtube</a> -->
            <?php foreach ($video as $vd) :

        parse_str( parse_url( $vd->link, PHP_URL_QUERY ), $code );
        $url_id =  $code['v']; 
            ?>
            <!-- <a class="featured_vid"  href="//www.youtube.com/watch?v=<?php echo $url_id ?>" data-lity> -->
                <div class="con">
              <img style="width: 100%" src="https://img.youtube.com/vi/<?php echo $url_id ?>/maxresdefault.jpg" alt="">
                <div class="centered-text">
                    <a style="font-size:20px;padding: 30px 30px 24px 30px" href="//www.youtube.com/watch?v=<?php echo $url_id ?>" class="button medium" data-lity>
                        <i style="padding-right: 0px !important" class="sl sl-icon-control-play"></i>
                    </a>
                </div>
          </div>
          <!-- </a> -->
                            <!-- <iframe style="max-width: 100%; max-height: auto;" width='500px' height='280px' src='http://www.youtube.com/embed/<?php echo $url_id?>?rel=0&hd=1'></iframe> -->
            <?php endforeach;?>
        </div>


        
        <div class="col-md-6">
           <h3 class="uppercase">About US </h3>
           <h5><?php echo $p_nama;?></h5>
           <div class="h-30"></div>
            <p style="color:#a3a1a1;"><?php echo $p_tentang;?></p>
           
            <div class="h-10"></div>
            <ul class="social-icons">
                <li><a class="facebook" href="<?php echo $p_facebook; ?>" target="_blank"><i class="icon-facebook"></i></a></li>
                <li><a class="twitter" href="<?php echo $p_twitter; ?>" target="_blank"><i class="icon-twitter"></i></a></li>
                <li><a class="instagram" href="<?php echo $p_instagram; ?>" target="_blank"><i class="icon-instagram"></i></a></li>
                <li><a class="youtube" href="<?php echo $p_youtube; ?>"><i class="icon-youtube"></i></a></li>
            </ul>


        </div>
    </div>
</div>
                </div>
    <!-- end Main container -->
<hr>


            <div class="container">
                <div class="row">
                    <div class="col-md-12">

                        <div class="tabs-menu categories-boxes-container margin-top-5 margin-bottom-30">
                            <!-- Box -->
                            <a data-tab="tcontent1" class="current tab-link category-small-box">
                                <img src="<?php echo base_url()?>data/logo/logo/1.png">
                                <!-- <h4>Eat & Drink</h4> -->
                            </a>
                            <a data-tab="tcontent2" class="tab-link category-small-box">
                                <img src="<?php echo base_url()?>data/logo/logo/2.png">
                                <!-- <h4>Eat & Drink</h4> -->
                            </a>
                            <a data-tab="tcontent3" class="tab-link category-small-box">
                                <img src="<?php echo base_url()?>data/logo/logo/3.png">
                                <!-- <h4>Eat & Drink</h4> -->
                            </a>
                            <a data-tab="tcontent4" class="tab-link category-small-box">
                                <img src="<?php echo base_url()?>data/logo/logo/4.png">
                                <!-- <h4>Eat & Drink</h4> -->
                            </a>
                            <a data-tab="tcontent5" class="tab-link category-small-box">
                                <img src="<?php echo base_url()?>data/logo/logo/5.png">
                                <!-- <h4>Eat & Drink</h4> -->
                            </a>
                            <a data-tab="tcontent6" class="tab-link category-small-box">
                                <img src="<?php echo base_url()?>data/logo/logo/6.png">
                                <!-- <h4>Eat & Drink</h4> -->
                            </a>
                    </div>
                    <div id="tcontent1" class="tab-content current">
                        <div class="row">
                <h4 class="headline">Rekapitulasi Realisasi Kegiatan 2018
                    <span>Kementrian Koordinator Bidang POLHUKAM</span>
                </h4>

                <div class="style-2">
                    <!-- Tabs Navigation -->
                    <ul class="tabs-nav">
                        <li class="active"><a href="#tab1a"><span class="fa fa-bar-chart"></span></a></li>
                        <li><a href="#tab2a"><span class="fa fa-line-chart"></span></a></li>
                        <li><a href="#tab3a"><span class="fa fa-area-chart"></span></a></li>
                        <li><a href="#tab4a"><span class="fa fa-pie-chart"></span></a></li>
                        <li><a href="#tab5a"><span class="fa fa-support"></span></a></li>
                    </ul>

                    <!-- Tabs Content -->
                    <div class="tabs-container">
                        <div class="tab-content" id="tab1a">
                            <canvas id="barChart1"></canvas>          
                        </div>
                        <div class="tab-content" id="tab2a">
                            <canvas id="lineChart1"></canvas>          
                        </div>
                        <div class="tab-content" id="tab3a">
                            <canvas id="areaChart1"></canvas>          
                        </div>
                        <div class="tab-content" id="tab4a">
                            <canvas id="pieChart1"></canvas>          
                        </div>
                        <div class="tab-content" id="tab5a">
                            <canvas id="doughnutChart1"></canvas>          
                        </div>
                        </div>
                    </div>
                     <div class="col-md-7">
<div class="row margin-top-30">      
<div class="col-md-12">    
                     <div class="add-listing-section padding-top-30">
                    <div class="table-responsive"><table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Koordinator</th>
      <th scope="col">Nama Lembaga</th>
    </tr>
  </thead>
  <tbody>
    <?php 
        $lembaga = array('BADAN INTELEJEN NEGARA','BADAN NASIONAL PENANGGULANGAN TERORISME','KEJAKSAAN AGUNG INDONESIA','KEMENTERIAN DALAM NEGERI INDONESIA','KEMENTERIAN HUKUM DAN HAK ASASI MANUSIA INDONESIA','KEMENTERIAN KOMUNIKASI DAN INFORMATIKA INDONESIA','KEMENTERIAN KOORDINATOR BIDANG POLHUKAM','KEMENTERIAN LUAR NEGERI INDONESIA','KEPOLISIAN NEGARA REPUBLIK INDONESIA','PUSAT PELAPORAN DAN ANALISA TRANSAKSI KEUANGAN','TENTARA NASIONAL INDONESIA');
        $no=1;
        foreach($lembaga as $l){
    ?>
    <tr>
      <th scope="row"><?php echo $no ?></th>
      <td>Kementrian Koordinator Bidang POLHUKAM</td>
      <td><?php echo $l ?></td>
    </tr>
    <?php $no++; } ?>
  </tbody>
</table></div>
</div>
</div>
</div>

                </div> 
                <div class="col-md-5">
<div class="row margin-top-30">      
                    <div class="col-lg-12 col-md-12">
                        <div class="row">
                            <select class="chosen-select" data-placeholder="Opening Time">
                                <option>2016</option>
                                <option>2017</option>
                                <option>2018</option>
                                <option>2019</option>
                            </select>    
                        </div>
                        <div class="row margin-top-30">           
                           <div class="dashboard-stat color-4">
                            <div class="dashboard-stat-content"><h4>172</h4> <span>Total Target Kegiatan</span></div>
                            <div class="dashboard-stat-icon"><i class="im im-icon-Books"></i></div>
                        </div>
                    </div>
                    <div class="row margin-top-10">                  
                     <div class="add-listing-section">

                        <!-- Headline -->
                        <div class="add-listing-headline">
                            <h4><i class="sl sl-icon-doc"></i> Realisasi Kegiatan Yang Dilaporkan</h4>
                        </div>

                        <div class="table-responsive"><table class="table table-hover">
                          <thead>
                            <tr>
                              <th scope="col">Triwulan I</th>
                              <th scope="col">Triwulan II</th>
                              <th scope="col">Triwulan II</th>
                              <th scope="col">Triwulan IV</th>
                          </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>53</td>
                          <td>33</td>
                          <td>125</td>
                          <td>183</td>
                      </tr>
                      <tr>
                          <td>18.79 %</td>
                          <td>11.70 %</td>
                          <td>44.33 %</td>
                          <td>64.89 %</td>
                      </tr>
                  </tbody>
              </table></div>
                        <!-- Row / End -->

          </div>
          </div>
      </div>
</div>
                </div>
</div>
</div>

                    <div id="tcontent2" class="tab-content">
                        <div class="row">
                     <div class="col-md-7">
                <h4 class="headline">Rekapitulasi Realisasi Kegiatan 2018
                    <span>Kementrian Koordinator Bidang PMK</span>
                </h4>

                <div class="style-2">
                    <!-- Tabs Navigation -->
                    <ul class="tabs-nav">
                        <li class="active"><a href="#tab1a"><span class="fa fa-bar-chart"></span></a></li>
                        <li><a href="#tab2a"><span class="fa fa-line-chart"></span></a></li>
                        <li><a href="#tab3a"><span class="fa fa-area-chart"></span></a></li>
                        <li><a href="#tab4a"><span class="fa fa-pie-chart"></span></a></li>
                        <li><a href="#tab5a"><span class="fa fa-support"></span></a></li>
                    </ul>

                    <!-- Tabs Content -->
                    <div class="tabs-container">
                        <div class="tab-content" id="tab1a">
                            <canvas id="barChart2"></canvas>          
                        </div>
                        <div class="tab-content" id="tab2a">
                            <canvas id="lineChart2"></canvas>          
                        </div>
                        <div class="tab-content" id="tab3a">
                            <canvas id="areaChart2"></canvas>          
                        </div>
                        <div class="tab-content" id="tab4a">
                            <canvas id="pieChart2"></canvas>          
                        </div>
                        <div class="tab-content" id="tab5a">
                            <canvas id="doughnutChart2"></canvas>          
                        </div>
                        </div>
                    </div>
<div class="row margin-top-30">      
<div class="col-md-12">    
                     <div class="add-listing-section padding-top-30">
                    <div class="table-responsive"><table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Koordinator</th>
      <th scope="col">Nama Lembaga</th>
    </tr>
  </thead>
  <tbody>
    <?php 
        $lembaga = array('BADAN NASIONAL PENEMPATAN DAN PERLINDUNGAN TENAGA KERJA INDONESIA','KEMENTERIAN AGAMA','KEMENTERIAN KESEHATAN','KEMENTERIAN PENDIDIKAN DAN KEBUDAYAAN','KEMENTERIAN KOORDINATOR BIDANG PMK','KEMENTERIAN PEMUDA DAN OLAHRAGA','KOMISI PERLINDUNGAN ANAK INDONESIA','KEMENTERIAN RISET, TEKNOLOGI, DAN PENDIDIKAN TINGGI','KEMENTERIAN SOSIAL','LEMBAGA PERLINDUNGAN SAKSI DAN KORBAN');
        $no=1;
        foreach($lembaga as $l){
    ?>
    <tr>
      <th scope="row"><?php echo $no ?></th>
      <td>Kementrian Koordinator Bidang PMK</td>
      <td><?php echo $l ?></td>
    </tr>
    <?php $no++; } ?>
  </tbody>
</table></div>
</div>
</div>
</div>

                </div> 
                <div class="col-md-5">
                    <div class="col-lg-12 col-md-12">
                        <div class="row">
                            <select class="chosen-select" data-placeholder="Opening Time">
                                <option>2016</option>
                                <option>2017</option>
                                <option>2018</option>
                                <option>2019</option>
                            </select>    
                        </div>
                        <div class="row margin-top-30">           
                           <div class="dashboard-stat color-4">
                            <div class="dashboard-stat-content"><h4>73</h4> <span>Total Target Kegiatan</span></div>
                            <div class="dashboard-stat-icon"><i class="im im-icon-Books"></i></div>
                        </div>
                    </div>
                    <div class="row margin-top-10">                  
                     <div class="add-listing-section">

                        <!-- Headline -->
                        <div class="add-listing-headline">
                            <h4><i class="sl sl-icon-doc"></i> Realisasi Kegiatan Yang Dilaporkan</h4>
                        </div>

                        <div class="table-responsive"><table class="table table-hover">
                          <thead>
                            <tr>
                              <th scope="col">Triwulan I</th>
                              <th scope="col">Triwulan II</th>
                              <th scope="col">Triwulan II</th>
                              <th scope="col">Triwulan IV</th>
                          </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>15</td>
                          <td>5</td>
                          <td>38</td>
                          <td>47</td>
                      </tr>
                      <tr>
                          <td>20.55 %</td>
                          <td>6.85 %</td>
                          <td>52.05 %</td>
                          <td>64.38 %</td>
                      </tr>
                  </tbody>
              </table></div>
                        <!-- Row / End -->

          </div>
          </div>
      </div>

                </div>
</div>
</div>                    


<div id="tcontent3" class="tab-content">
                        <div class="row">
                     <div class="col-md-7">
                <h4 class="headline">Rekapitulasi Realisasi Kegiatan 2018
                    <span>Kementrian Koordinator Bidang KEMARITIMAN</span>
                </h4>

                <div class="style-2">
                    <!-- Tabs Navigation -->
                    <ul class="tabs-nav">
                        <li class="active"><a href="#tab1a"><span class="fa fa-bar-chart"></span></a></li>
                        <li><a href="#tab2a"><span class="fa fa-line-chart"></span></a></li>
                        <li><a href="#tab3a"><span class="fa fa-area-chart"></span></a></li>
                        <li><a href="#tab4a"><span class="fa fa-pie-chart"></span></a></li>
                        <li><a href="#tab5a"><span class="fa fa-support"></span></a></li>
                    </ul>

                    <!-- Tabs Content -->
                    <div class="tabs-container">
                        <div class="tab-content" id="tab1a">
                            <canvas id="barChart3"></canvas>          
                        </div>
                        <div class="tab-content" id="tab2a">
                            <canvas id="lineChart3"></canvas>          
                        </div>
                        <div class="tab-content" id="tab3a">
                            <canvas id="areaChart3"></canvas>          
                        </div>
                        <div class="tab-content" id="tab4a">
                            <canvas id="pieChart3"></canvas>          
                        </div>
                        <div class="tab-content" id="tab5a">
                            <canvas id="doughnutChart3"></canvas>          
                        </div>
                        </div>
                    </div>
<div class="row margin-top-30">      
<div class="col-md-12">    
                     <div class="add-listing-section padding-top-30">
                    <div class="table-responsive"><table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Koordinator</th>
      <th scope="col">Nama Lembaga</th>
    </tr>
  </thead>
  <tbody>
    <?php 
        $lembaga = array('KEMENTERIAN ENERGI DAN SUMBER DAYA MINERAL','KEMENTERIAN KELAUTAN DAN PERIKANAN','KEMENTERIAN PARIWISATA','KEMENTERIAN PERHUBUNGAN');
        $no=1;
        foreach($lembaga as $l){
    ?>
    <tr>
      <th scope="row"><?php echo $no ?></th>
      <td>Kementrian Koordinator Bidang KEMARITIMAN</td>
      <td><?php echo $l ?></td>
    </tr>
    <?php $no++; } ?>
  </tbody>
</table></div>
</div>
</div>
</div>

                </div> 
                <div class="col-md-5">
                    <div class="col-lg-12 col-md-12">
                        <div class="row">
                            <select class="chosen-select" data-placeholder="Opening Time">
                                <option>2016</option>
                                <option>2017</option>
                                <option>2018</option>
                                <option>2019</option>
                            </select>    
                        </div>
                        <div class="row margin-top-30">           
                           <div class="dashboard-stat color-4">
                            <div class="dashboard-stat-content"><h4>10</h4> <span>Total Target Kegiatan</span></div>
                            <div class="dashboard-stat-icon"><i class="im im-icon-Books"></i></div>
                        </div>
                    </div>
                    <div class="row margin-top-10">                  
                     <div class="add-listing-section">

                        <!-- Headline -->
                        <div class="add-listing-headline">
                            <h4><i class="sl sl-icon-doc"></i> Realisasi Kegiatan Yang Dilaporkan</h4>
                        </div>

                        <div class="table-responsive"><table class="table table-hover">
                          <thead>
                            <tr>
                              <th scope="col">Triwulan I</th>
                              <th scope="col">Triwulan II</th>
                              <th scope="col">Triwulan II</th>
                              <th scope="col">Triwulan IV</th>
                          </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>10</td>
                          <td>0</td>
                          <td>0</td>
                          <td>9</td>
                      </tr>
                      <tr>
                          <td>100.00 %</td>
                          <td>0.00 %</td>
                          <td>0.00 %</td>
                          <td>90.00 %</td>
                      </tr>
                  </tbody>
              </table></div>
                        <!-- Row / End -->

          </div>
          </div>
      </div>

                </div>
</div>
</div>                    

<div id="tcontent4" class="tab-content">
                        <div class="row">
                     <div class="col-md-7">
                <h4 class="headline">Rekapitulasi Realisasi Kegiatan 2018
                    <span>Kementrian Koordinator Bidang PEREKONOMIAN</span>
                </h4>

                <div class="style-2">
                    <!-- Tabs Navigation -->
                    <ul class="tabs-nav">
                        <li class="active"><a href="#tab1a"><span class="fa fa-bar-chart"></span></a></li>
                        <li><a href="#tab2a"><span class="fa fa-line-chart"></span></a></li>
                        <li><a href="#tab3a"><span class="fa fa-area-chart"></span></a></li>
                        <li><a href="#tab4a"><span class="fa fa-pie-chart"></span></a></li>
                        <li><a href="#tab5a"><span class="fa fa-support"></span></a></li>
                    </ul>

                    <!-- Tabs Content -->
                    <div class="tabs-container">
                        <div class="tab-content" id="tab1a">
                            <canvas id="barChart4"></canvas>          
                        </div>
                        <div class="tab-content" id="tab2a">
                            <canvas id="lineChart4"></canvas>          
                        </div>
                        <div class="tab-content" id="tab3a">
                            <canvas id="areaChart4"></canvas>          
                        </div>
                        <div class="tab-content" id="tab4a">
                            <canvas id="pieChart4"></canvas>          
                        </div>
                        <div class="tab-content" id="tab5a">
                            <canvas id="doughnutChart4"></canvas>          
                        </div>
                        </div>
                    </div>
<div class="row margin-top-30">      
<div class="col-md-12">    
                     <div class="add-listing-section padding-top-30">
                    <div class="table-responsive"><table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Koordinator</th>
      <th scope="col">Nama Lembaga</th>
    </tr>
  </thead>
  <tbody>
    <?php 
        $lembaga = array('KEMENTERIAN BADAN USAHA MILIK NEGARA','KEMENTERIAN KETENAGAKERJAAN','KEMENTERIAN KEUANGAN','KEMENTERIAN KOPERASI DAN USAHA KECIL DAN MENENGAH','KEMENTERIAN PEKERJAAN UMUM DAN PERUMAHAN RAKYAT','KEMENTERIAN PERENCANAAN PEMBANGUNAN NASIONAL/BAPPENAS','KEMENTERIAN PERTANIAN');
        $no=1;
        foreach($lembaga as $l){
    ?>
    <tr>
      <th scope="row"><?php echo $no ?></th>
      <td>Kementrian Koordinator Bidang PEREKONOMIAN</td>
      <td><?php echo $l ?></td>
    </tr>
    <?php $no++; } ?>
  </tbody>
</table></div>
</div>
</div>
</div>

                </div> 
                <div class="col-md-5">
                    <div class="col-lg-12 col-md-12">
                        <div class="row">
                            <select class="chosen-select" data-placeholder="Opening Time">
                                <option>2016</option>
                                <option>2017</option>
                                <option>2018</option>
                                <option>2019</option>
                            </select>    
                        </div>
                        <div class="row margin-top-30">           
                           <div class="dashboard-stat color-4">
                            <div class="dashboard-stat-content"><h4>27</h4> <span>Total Target Kegiatan</span></div>
                            <div class="dashboard-stat-icon"><i class="im im-icon-Books"></i></div>
                        </div>
                    </div>
                    <div class="row margin-top-10">                  
                     <div class="add-listing-section">

                        <!-- Headline -->
                        <div class="add-listing-headline">
                            <h4><i class="sl sl-icon-doc"></i> Realisasi Kegiatan Yang Dilaporkan</h4>
                        </div>

                        <div class="table-responsive"><table class="table table-hover">
                          <thead>
                            <tr>
                              <th scope="col">Triwulan I</th>
                              <th scope="col">Triwulan II</th>
                              <th scope="col">Triwulan II</th>
                              <th scope="col">Triwulan IV</th>
                          </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>0</td>
                          <td>2</td>
                          <td>1</td>
                          <td>16</td>
                      </tr>
                      <tr>
                          <td>0.00 %</td>
                          <td>7.41 %</td>
                          <td>3.70 %</td>
                          <td>59.26 %</td>
                      </tr>
                  </tbody>
              </table></div>
                        <!-- Row / End -->

          </div>
          </div>
      </div>

                </div>
</div>
</div>                    

<div id="tcontent5" class="tab-content">
                        <div class="row">
                     <div class="col-md-7">
                <h4 class="headline">Rekapitulasi Realisasi Kegiatan 2018
                    <span>Kementrian Sekretariat Negara RI</span>
                </h4>

                <div class="style-2">
                    <!-- Tabs Navigation -->
                    <ul class="tabs-nav">
                        <li class="active"><a href="#tab1a"><span class="fa fa-bar-chart"></span></a></li>
                        <li><a href="#tab2a"><span class="fa fa-line-chart"></span></a></li>
                        <li><a href="#tab3a"><span class="fa fa-area-chart"></span></a></li>
                        <li><a href="#tab4a"><span class="fa fa-pie-chart"></span></a></li>
                        <li><a href="#tab5a"><span class="fa fa-support"></span></a></li>
                    </ul>

                    <!-- Tabs Content -->
                    <div class="tabs-container">
                        <div class="tab-content" id="tab1a">
                            <canvas id="barChart5"></canvas>          
                        </div>
                        <div class="tab-content" id="tab2a">
                            <canvas id="lineChart5"></canvas>          
                        </div>
                        <div class="tab-content" id="tab3a">
                            <canvas id="areaChart5"></canvas>          
                        </div>
                        <div class="tab-content" id="tab4a">
                            <canvas id="pieChart5"></canvas>          
                        </div>
                        <div class="tab-content" id="tab5a">
                            <canvas id="doughnutChart5"></canvas>          
                        </div>
                        </div>
                    </div>
<div class="row margin-top-30">      
<div class="col-md-12">    
                     <div class="add-listing-section padding-top-30">
                    <div class="table-responsive"><table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Koordinator</th>
      <th scope="col">Nama Lembaga</th>
    </tr>
  </thead>
  <tbody>
    <?php 
        $lembaga = array('BADAN INTELEJEN NEGARA','BADAN NASIONAL PENANGGULANGAN TERORISME','BADAN NASIONAL PENEMPATAN DAN PERLINDUNGAN TENAGA KERJA INDONESIA','KEJAKSAAN AGUNG INDONESIA','KEMENTERIAN AGAMA','KEMENTERIAN BADAN USAHA MILIK NEGARA','KEMENTERIAN DALAM NEGERI INDONESIA','KEMENTERIAN ENERGI DAN SUMBER DAYA MINERAL','KEMENTERIAN HUKUM DAN HAK ASASI MANUSIA INDONESIA','KEMENTERIAN KELAUTAN DAN PERIKANAN','KEMENTERIAN KESEHATAN','KEMENTERIAN KETENAGAKERJAAN','KEMENTERIAN KEUANGAN','KEMENTERIAN KOMUNIKASI DAN INFORMATIKA INDONESIA','KEMENTERIAN KOORDINATOR BIDANG PMK','KEMENTERIAN KOORDINATOR BIDANG POLHUKAM','KEMENTERIAN KOPERASI DAN USAHA KECIL DAN MENENGAH','KEMENTERIAN LUAR NEGERI INDONESIA','KEMENTERIAN PARIWISATA','KEMENTERIAN PEKERJAAN UMUM DAN PERUMAHAN RAKYAT','KEMENTERIAN PEMUDA DAN OLAHRAGA','KEMENTERIAN PENDIDIKAN DAN KEBUDAYAAN','KEMENTERIAN PERENCANAAN PEMBANGUNAN NASIONAL/BAPPENAS','KEMENTERIAN PERHUBUNGAN','KEMENTERIAN PERTANIAN','KEMENTERIAN RISET, TEKNOLOGI, DAN PENDIDIKAN TINGGI','KEMENTERIAN SOSIAL','KEPOLISIAN NEGARA REPUBLIK INDONESIA','KOMISI PERLINDUNGAN ANAK INDONESIA','LEMBAGA PERLINDUNGAN SAKSI DAN KORBAN','PUSAT PELAPORAN DAN ANALISA TRANSAKSI KEUANGAN','TENTARA NASIONAL INDONESIA');
        $no=1;
        foreach($lembaga as $l){
    ?>
    <tr>
      <th scope="row"><?php echo $no ?></th>
      <td>Kementrian Sekretariat Negara RI</td>
      <td><?php echo $l ?></td>
    </tr>
    <?php $no++; } ?>
  </tbody>
</table></div>
</div>
</div>
</div>

                </div> 
                <div class="col-md-5">
                    <div class="col-lg-12 col-md-12">
                        <div class="row">
                            <select class="chosen-select" data-placeholder="Opening Time">
                                <option>2016</option>
                                <option>2017</option>
                                <option>2018</option>
                                <option>2019</option>
                            </select>    
                        </div>
                        <div class="row margin-top-30">           
                           <div class="dashboard-stat color-4">
                            <div class="dashboard-stat-content"><h4>282</h4> <span>Total Target Kegiatan</span></div>
                            <div class="dashboard-stat-icon"><i class="im im-icon-Books"></i></div>
                        </div>
                    </div>
                    <div class="row margin-top-10">                  
                     <div class="add-listing-section">

                        <!-- Headline -->
                        <div class="add-listing-headline">
                            <h4><i class="sl sl-icon-doc"></i> Realisasi Kegiatan Yang Dilaporkan</h4>
                        </div>

                        <div class="table-responsive"><table class="table table-hover">
                          <thead>
                            <tr>
                              <th scope="col">Triwulan I</th>
                              <th scope="col">Triwulan II</th>
                              <th scope="col">Triwulan II</th>
                              <th scope="col">Triwulan IV</th>
                          </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>53</td>
                          <td>33</td>
                          <td>125</td>
                          <td>183</td>
                      </tr>
                      <tr>
                          <td>18.79 %</td>
                          <td>11.70 %</td>
                          <td>44.33 %</td>
                          <td>64.89 %</td>
                      </tr>
                  </tbody>
              </table></div>
                        <!-- Row / End -->

          </div>
          </div>
      </div>

                </div>
</div>
</div>                    

<div id="tcontent6" class="tab-content">
                        <div class="row">
                     <div class="col-md-7">
                <h4 class="headline">Rekapitulasi Realisasi Kegiatan 2018
                    <span>Kantor Staf Presiden</span>
                </h4>

                <div class="style-2">
                    <!-- Tabs Navigation -->
                    <ul class="tabs-nav">
                        <li class="active"><a href="#tab1a"><span class="fa fa-bar-chart"></span></a></li>
                        <li><a href="#tab2a"><span class="fa fa-line-chart"></span></a></li>
                        <li><a href="#tab3a"><span class="fa fa-area-chart"></span></a></li>
                        <li><a href="#tab4a"><span class="fa fa-pie-chart"></span></a></li>
                        <li><a href="#tab5a"><span class="fa fa-support"></span></a></li>
                    </ul>

                    <!-- Tabs Content -->
                    <div class="tabs-container">
                        <div class="tab-content" id="tab1a">
                            <canvas id="barChart6"></canvas>          
                        </div>
                        <div class="tab-content" id="tab2a">
                            <canvas id="lineChart6"></canvas>          
                        </div>
                        <div class="tab-content" id="tab3a">
                            <canvas id="areaChart6"></canvas>          
                        </div>
                        <div class="tab-content" id="tab4a">
                            <canvas id="pieChart6"></canvas>          
                        </div>
                        <div class="tab-content" id="tab5a">
                            <canvas id="doughnutChart6"></canvas>          
                        </div>
                        </div>
                    </div>
<div class="row margin-top-30">      
<div class="col-md-12">    
                     <div class="add-listing-section padding-top-30">
                    <div class="table-responsive"><table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Koordinator</th>
      <th scope="col">Nama Lembaga</th>
    </tr>
  </thead>
  <tbody>
    <?php 
        $lembaga = array('BADAN INTELEJEN NEGARA','BADAN NASIONAL PENANGGULANGAN TERORISME','BADAN NASIONAL PENEMPATAN DAN PERLINDUNGAN TENAGA KERJA INDONESIA','KEJAKSAAN AGUNG INDONESIA','KEMENTERIAN AGAMA','KEMENTERIAN BADAN USAHA MILIK NEGARA','KEMENTERIAN DALAM NEGERI INDONESIA','KEMENTERIAN ENERGI DAN SUMBER DAYA MINERAL','KEMENTERIAN HUKUM DAN HAK ASASI MANUSIA INDONESIA','KEMENTERIAN KELAUTAN DAN PERIKANAN','KEMENTERIAN KESEHATAN','KEMENTERIAN KETENAGAKERJAAN','KEMENTERIAN KEUANGAN','KEMENTERIAN KOMUNIKASI DAN INFORMATIKA INDONESIA','KEMENTERIAN KOORDINATOR BIDANG PMK','KEMENTERIAN KOORDINATOR BIDANG POLHUKAM','KEMENTERIAN KOPERASI DAN USAHA KECIL DAN MENENGAH','KEMENTERIAN LUAR NEGERI INDONESIA','KEMENTERIAN PARIWISATA','KEMENTERIAN PEKERJAAN UMUM DAN PERUMAHAN RAKYAT','KEMENTERIAN PEMUDA DAN OLAHRAGA','KEMENTERIAN PENDIDIKAN DAN KEBUDAYAAN','KEMENTERIAN PERENCANAAN PEMBANGUNAN NASIONAL/BAPPENAS','KEMENTERIAN PERHUBUNGAN','KEMENTERIAN PERTANIAN','KEMENTERIAN RISET, TEKNOLOGI, DAN PENDIDIKAN TINGGI','KEMENTERIAN SOSIAL','KEPOLISIAN NEGARA REPUBLIK INDONESIA','KOMISI PERLINDUNGAN ANAK INDONESIA','LEMBAGA PERLINDUNGAN SAKSI DAN KORBAN','PUSAT PELAPORAN DAN ANALISA TRANSAKSI KEUANGAN','TENTARA NASIONAL INDONESIA');
        $no=1;
        foreach($lembaga as $l){
    ?>
    <tr>
      <th scope="row"><?php echo $no ?></th>
      <td>Kantor Staf Presiden</td>
      <td><?php echo $l ?></td>
    </tr>
    <?php $no++; } ?>
  </tbody>
</table></div>
</div>
</div>
</div>

                </div> 
                <div class="col-md-5">
                    <div class="col-lg-12 col-md-12">
                        <div class="row">
                            <select class="chosen-select" data-placeholder="Opening Time">
                                <option>2016</option>
                                <option>2017</option>
                                <option>2018</option>
                                <option>2019</option>
                            </select>    
                        </div>
                        <div class="row margin-top-30">           
                           <div class="dashboard-stat color-4">
                            <div class="dashboard-stat-content"><h4>282</h4> <span>Total Target Kegiatan</span></div>
                            <div class="dashboard-stat-icon"><i class="im im-icon-Books"></i></div>
                        </div>
                    </div>
                    <div class="row margin-top-10">                  
                     <div class="add-listing-section">

                        <!-- Headline -->
                        <div class="add-listing-headline">
                            <h4><i class="sl sl-icon-doc"></i> Realisasi Kegiatan Yang Dilaporkan</h4>
                        </div>

                        <div class="table-responsive"><table class="table table-hover">
                          <thead>
                            <tr>
                              <th scope="col">Triwulan I</th>
                              <th scope="col">Triwulan II</th>
                              <th scope="col">Triwulan II</th>
                              <th scope="col">Triwulan IV</th>
                          </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>53</td>
                          <td>33</td>
                          <td>125</td>
                          <td>183</td>
                      </tr>
                      <tr>
                          <td>18.79 %</td>
                          <td>11.70 %</td>
                          <td>44.33 %</td>
                          <td>64.89 %</td>
                      </tr>
                  </tbody>
              </table></div>
                        <!-- Row / End -->

          </div>
          </div>
      </div>

                </div>
</div>
</div>



  </div>
</div>
<!-- Container / End -->
</div>


<section class="fullwidth padding-top-75 padding-bottom-75" data-background-color="#fffff" id="blog">
    <div class="container">

        <div class="row">
            <div class="col-md-12">
                <h3 class="headline centered margin-bottom-50">
                    Berita Terbaru
                </h3>
            </div>
        </div>

        <div class="row">

    

    <?php
                                    foreach ($posts as $post) :
                                        $tag = "";
                                        $tags= $post->tag;
                                        if ($tags!=""){
                                            $exp = explode(";", $tags);
                                            $_tag = array();
                                            foreach ($Qtag as $r) {
                                                $_tag[$r->tag_name] = $r->tag_slug;
                                            }
                                            
                                            for ($x=0; $x < (count($exp) - 1) ; $x++)
                                            {
                                                $slug = $_tag[$exp[$x]];
                                                $tag .= "<a href='".base_url()."berita/tag/{$slug}' >$exp[$x]</a>";
                                                if ($x < (count($exp) - 2)) $tag .=",";
                                            }
                                        }
                                        $content = substr($post->content,0,100);
                                        if (strlen($post->content)>50) $content .="...";
                                ?>

            <!-- Blog Post Item -->
            <div class="col-md-4">
                <a href="<?php echo base_url()."berita/read/{$post->title_slug}";?>" class="blog-compact-item-container">
                    <div class="blog-compact-item">
                    <?php if (!empty($post->picture)) :?>
                        <img src="<?php echo base_url()."data/images/featured_image/{$post->picture}";?>" alt="">
                     <?php endif;?>
                        <span class="blog-item-tag"><?php echo $post->category_name;?></span>
                        <div class="blog-compact-item-content">
                            <ul class="blog-post-tags">
                                <li><?php echo date('d M Y ',strtotime($post->date)).$post->time;?></li>
                            </ul>
                            <h3><?php echo $post->title;?></h3>
                            <!-- <?php echo $content;?> -->
                        </div>
                    </div>
                </a>
            </div>
            <!-- Blog post Item / End -->
    <?php endforeach;?>
            

            <div class="col-md-12 centered-content">
                <a href="<?php echo base_url();?>blog" class="button border margin-top-10">View Blog</a>
            </div>

        </div>

    </div>
</section>


<section class="fullwidth border-top margin-top-40 margin-bottom-0 padding-top-60 padding-bottom-65"  data-background-color="#f8f8f8">
    <!-- Logo Carousel -->
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <h3 class="headline centered margin-bottom-40 margin-top-10">Sinergitas Penanggulangan Terorisme <span>Kami bersatu menolak terorisme</span></h3>
            </div>

            <!-- Carousel -->
            <div class="col-md-12">
                <div class="logo-slick-carousel dot-navigation">

<!--                     <div class="item">
                        <img src="<?php echo base_url();?>data/logo/logo/bin.png" alt="">
                    </div>

                    <div class="item">
                        <img src="<?php echo base_url();?>data/logo/logo/bnpt.png" alt="">
                    </div>

                    <div class="item">
                        <img src="<?php echo base_url();?>data/logo/logo/bnp.png" alt="">
                    </div>

                    <div class="item">
                        <img src="<?php echo base_url();?>data/logo/logo/kai.png" alt="">
                    </div>

                    <div class="item">
                        <img src="<?php echo base_url();?>data/logo/logo/kbumn.png" alt="">
                    </div>

                    <div class="item">
                        <img src="<?php echo base_url();?>data/logo/logo/kkdp.png" alt="">
                    </div>

                    <div class="item">
                        <img src="<?php echo base_url();?>data/logo/logo/kominfo.png" alt="">
                    </div> -->
                    
                    <?php foreach ($banner as $b): ?>
                    <div class="item">
                        <a href="<?php echo $b->url;?>"><img src="<?php echo base_url().'data/images/banner/'.$b->gambar;?>" alt=""></a>
                    </div>
                    <?php endforeach ?>

                </div>
            </div>
            <!-- Carousel / End -->

        </div>
    </div>
    <!-- Logo Carousel / End -->
</section>
<?php $this->load->view('blog/src/footer_home');?>

<?php
  $bln = json_encode($bulan);
  
?>  
<script>
  var BULAN = new Array();
    <?php
        for($i=1;$i<=count($bulan);$i++)
        {
         echo "BULAN[$i] = '{$bulan[$i]}';";
        }
    ?>
  var COLOUR = new Array();
  COLOUR[0] = "rgba(255, 99, 132, 0.2)";
  COLOUR[1] = "rgba(54, 162, 235, 0.2)";
  COLOUR[2] = "rgba(255, 206, 86, 0.2)";
  COLOUR[3] = "rgba(75, 192, 192, 0.2)";
  COLOUR[4] = "rgba(153, 102, 255, 0.2)";
  COLOUR[5] = "rgba(255, 159, 64, 0.2)";

  COLOUR[6] = "rgba(0, 255, 0, 0.2)";
  COLOUR[7] = "rgba(255, 0, 255, 0.2)";
  COLOUR[8] = "rgba(0, 191, 255, 0.2)";
  COLOUR[9] = "rgba(0, 0, 255, 0.2)";
  COLOUR[10] = "rgba(0, 255, 255, 0.2)";
  COLOUR[11] = "rgba(255, 0, 0, 0.2)";

  var COLOR = new Array();
  COLOR[0] = "rgba(255, 99, 132, 0.8)";
  COLOR[1] = "rgba(54, 162, 235, 0.8)";
  COLOR[2] = "rgba(255, 206, 86, 0.8)";
  COLOR[3] = "rgba(75, 192, 192, 0.8)";
  COLOR[4] = "rgba(153, 102, 255, 0.8)";
  COLOR[5] = "rgba(255, 159, 64, 0.8)";

  COLOR[6] = "rgba(0, 255, 0, 0.8)";
  COLOR[7] = "rgba(255, 0, 255, 0.8)";
  COLOR[8] = "rgba(0, 191, 255, 0.8)";
  COLOR[9] = "rgba(0, 0, 255, 0.8)";
  COLOR[10] = "rgba(0, 255, 255, 0.8)";
  COLOR[11] = "rgba(255, 0, 0, 0.8)";

  var PERIOD = new Array();
  var DATA_INVESTASI = new Array();
</script>

<script type="text/javascript">
// set up text to print, each item in array is new line
var aText = new Array(
    "Welcome to our official website, Normal is boring. The world is created from abnormal people, if only then there was no human minded to fly, maybe at this moment we can not boarding a plane. The normal word can be relative in accordance with its time, or the way of viewing from different perspective. The world in will continue to grow as long as there are people who think that normal is boring. People will be demanded more quickly and efficiently without having to do a lot of works. ", 
    "We have the same dream, contribute to creating a better world."
    );
var iSpeed = 50; // time delay of print out
var iIndex = 0; // start printing array at this posision
var iArrLength = aText[0].length; // the length of the text array
var iScrollAt = 20; // start scrolling up at this many lines

var iTextPos = 0; // initialise text position
var sContents = ''; // initialise contents variable
var iRow; // initialise current row

function typewriter()
{
   sContents =  ' ';
   iRow = Math.max(0, iIndex-iScrollAt);
   var destination = document.getElementById("typedtext");

   while ( iRow < iIndex ) {
      sContents += aText[iRow++] + '<br />';
  }
  destination.innerHTML = sContents + aText[iIndex].substring(0, iTextPos) + "_";
  if ( iTextPos++ == iArrLength ) {
      iTextPos = 0;
      iIndex++;
      if ( iIndex != aText.length ) {
         iArrLength = aText[iIndex].length;
         setTimeout("typewriter()", 1000);
     }
 } else {
  setTimeout("typewriter()", iSpeed);
}
}


typewriter();
</script>


<?php for ($i=1; $i <=6 ; $i++) {  ?>
<script>
    var ctx = document.getElementById("barChart<?php echo $i ?>");
    var barChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ["Triwulan 1", "Triwulan 2", "Triwulan 3", "Triwulan 4"],
            datasets: [{
                label: '# Jumlah Kegiatan',
                data: [
                    <?php foreach ($grafik1[$i] as $key => $value) {
                        echo "{$value}, ";
                    } ?>
                ],
                backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero:true
                    }
                }]
            },
            title: {
                display: true,
                text: 'Total Realisasi Kegiatan yang Dilaporkan dalam Triwulan'
            }
        }
    });
</script>
<script>

    var ctx = document.getElementById("lineChart<?php echo $i ?>");
    var lineChart = new Chart(ctx, {type: 'line',
            data: {
                labels: [
                    <?php foreach ($bulan as $bln) {
                        echo "'{$bln}', ";
                    } ?>
                ],
                datasets: [
                <?php foreach ($data_lembaga as $key => $value): ?>
                    {
                        label: '<?=$value->nama_instansi?>',
                        backgroundColor: COLOUR[<?=$key?>],
                        borderColor: COLOR[<?=$key?>],
                        data: [
                            <?php
                                $year = date('Y');
                                for($g=1;$g<=count($bulan);$g++)
                                {
                                 echo "{$grafik2[$i][$key][$g]}, ";
                                }
                            ?>
                        ],
                        fill: false,
                        borderWidth: 1
                    },
                <?php endforeach ?>
                ]
            },
            options: {
                responsive: true,
                title: {
                    display: true,
                    text: 'Total Realisasi Kegiatan yang Dilaporkan Sepanjang Waktu Berdasarkan Setiap Lembaga'
                },
                tooltips: {
                    mode: 'index',
                    intersect: false,
                },
                hover: {
                    mode: 'nearest',
                    intersect: true
                },
                scales: {
                    xAxes: [{
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: 'Bulan'
                        }
                    }],
                    yAxes: [{
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: 'Kegiatan'
                        }
                    }]
                }
            }
    });
</script>
<!-- <?php echo $i ?> -->
<script>
    var ctx = document.getElementById("areaChart<?php echo $i ?>");
    var areaChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: [
                <?php foreach ($bulan as $bln) {
                    echo "'{$bln}', ";
                } ?>
            ],
            datasets: [{
                label: '# Jumlah Kegiatan',
                data: [
                    <?php
                        $year = date('Y');
                        for($g=1;$g<=count($bulan);$g++)
                        {
                         echo "{$grafik3[$i][$g]}, ";
                        }
                    ?>
                ],
                backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            title: {
                display: true,
                text: 'Total Realisasi Kegiatan yang Dilaporkan Sepanjang Waktu'
            },
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero:true
                    }
                }]
            }
        }
    });
</script>
<script>
    var ctx = document.getElementById("pieChart<?php echo $i ?>");
    var pieChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: [
                <?php foreach ($data_lembaga as $key => $value) {
                    echo "'{$value->nama_instansi}', ";
                } ?>
            ],
            datasets: [{
                label: '# Jumlah Kegiatan',
                data: [
                    <?php foreach ($data_lembaga as $key => $value) {
                        echo "'{$grafik4[$i][$key]}', ";
                    } ?>
                ],
                backgroundColor: [
                    <?php for ($c=0; $c < 12; $c++) { 
                        echo "COLOUR[$c], ";
                    } ?>
                ],
                borderColor: [
                    <?php for ($c=0; $c < 12; $c++) { 
                        echo "COLOR[$c], ";
                    } ?>
                ],
                borderWidth: 1
            }]
        },
        options: {
            title: {
                display: true,
                text: 'Total Realisasi Kegiatan yang Dilaporkan Berdasarkan Setiap Lembaga'
            },
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero:true
                    }
                }]
            }
        }
    });
</script>
<script>
    var ctx = document.getElementById("doughnutChart<?php echo $i ?>");
    var doughnutChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: [
                <?php foreach ($data_lembaga as $key => $value) {
                    echo "'{$value->nama_instansi}', ";
                } ?>
            ],
            datasets: [{
                label: '# Jumlah Kegiatan',
                data: [
                    <?php foreach ($data_lembaga as $key => $value) {
                        echo "'{$grafik5[$i][$key]}', ";
                    } ?>
                ],
                backgroundColor: [
                    <?php for ($c=0; $c < 12; $c++) { 
                        echo "COLOUR[$c], ";
                    } ?>
                ],
                borderColor: [
                    <?php for ($c=0; $c < 12; $c++) { 
                        echo "COLOR[$c], ";
                    } ?>
                ],
                borderWidth: 1
            }]
        },
        options: {
            title: {
                display: true,
                text: 'Total Target Kegiatan yang Dilaporkan Berdasarkan Setiap Lembaga'
            },
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero:true
                    }
                }]
            }
        }
    });
</script>

<?php } ?>
</body>
</html>