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

        .category-small-box.current{
            border-bottom: 2px solid #f91942;
        }


</style>
<!-- Titlebar
================================================== -->
<div id="titlebar" class="gradient">
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <h2>Monitoring</h2><span>Kegiatan K/L</span>

                <!-- Breadcrumbs -->
                <nav id="breadcrumbs">
                    <ul>
                        <li><a href="<?php echo base_url();?>">Beranda</a></li>
                        <li>Monitoring</li>
                    </ul>
                </nav>

            </div>
        </div>
    </div>
</div>


<!-- Content
================================================== -->

            <div class="container" id="data">
                <div class="row">
                    <div class="col-md-12">

                        <div class="tabs-menu categories-boxes-container margin-top-5 margin-bottom-30">
                            <!-- Box -->
                            <?php foreach ($data_koordinator as $key => $row): ?>
                            <a data-tab="tcontent<?=$row->id_instansi?>" class="tab-link category-small-box <?php if ($key==0) echo 'current'; ?>">
                                <img src="<?php echo base_url()?>data/logo/logo/<?=$row->logo?>">
                                <!-- <h4>Eat & Drink</h4> -->
                            </a>
                            <?php endforeach ?>
                    </div>
                            <?php foreach ($data_koordinator as $key => $row): ?>
                    <div id="tcontent<?=$row->id_instansi?>" class="tab-content <?php if ($key==0) echo 'current'; ?>">
                        <div class="row">
                <h4 class="headline">Rekapitulasi Realisasi Kegiatan <?=$tahun?>
                    <span><?=$row->nama_instansi?></span>
                </h4>

                <div class="style-2">
                    <!-- Tabs Navigation -->
                    <ul class="tabs-nav">
                        <li class="active"><a href="#tab1<?=$row->id_instansi?>"><span class="fa fa-bar-chart"></span></a></li>
                        <li><a href="#tab2<?=$row->id_instansi?>"><span class="fa fa-line-chart"></span></a></li>
                        <li><a href="#tab3<?=$row->id_instansi?>"><span class="fa fa-area-chart"></span></a></li>
                        <li><a href="#tab4<?=$row->id_instansi?>"><span class="fa fa-pie-chart"></span></a></li>
                        <li><a href="#tab5<?=$row->id_instansi?>"><span class="fa fa-support"></span></a></li>
                    </ul>

                    <!-- Tabs Content -->
                    <div class="tabs-container">
                        <div class="tab-content" id="tab1<?=$row->id_instansi?>">
                            <canvas id="barChart<?=$row->id_instansi?>"></canvas>          
                        </div>
                        <div class="tab-content" id="tab2<?=$row->id_instansi?>">
                            <canvas id="lineChart<?=$row->id_instansi?>"></canvas>          
                        </div>
                        <div class="tab-content" id="tab3<?=$row->id_instansi?>">
                            <canvas id="areaChart<?=$row->id_instansi?>"></canvas>          
                        </div>
                        <div class="tab-content" id="tab4<?=$row->id_instansi?>">
                            <canvas id="pieChart<?=$row->id_instansi?>"></canvas>          
                        </div>
                        <div class="tab-content" id="tab5<?=$row->id_instansi?>">
                            <canvas id="doughnutChart<?=$row->id_instansi?>"></canvas>          
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
        // $lembaga = array('BADAN INTELEJEN NEGARA','BADAN NASIONAL PENANGGULANGAN TERORISME','KEJAKSAAN AGUNG INDONESIA','KEMENTERIAN DALAM NEGERI INDONESIA','KEMENTERIAN HUKUM DAN HAK ASASI MANUSIA INDONESIA','KEMENTERIAN KOMUNIKASI DAN INFORMATIKA INDONESIA','KEMENTERIAN KOORDINATOR BIDANG POLHUKAM','KEMENTERIAN LUAR NEGERI INDONESIA','KEPOLISIAN NEGARA REPUBLIK INDONESIA','PUSAT PELAPORAN DAN ANALISA TRANSAKSI KEUANGAN','TENTARA NASIONAL INDONESIA');

        $no=1;
        foreach($data_lembaga[$row->id_instansi] as $l){
    ?>
    <tr>
      <th scope="row"><?php echo $no ?></th>
      <td><?=$row->nama_instansi?></td>
      <td><?php echo $l->nama_instansi ?></td>
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
                            <select id="select-year" class="chosen-select" data-placeholder="Opening Time" onchange="window.location = '<?php echo base_url()?>monitor?tahun='+$('#select-year :selected').val()+'#data';">>
                                <?php for ($t=2017; $t <= date("Y"); $t++) { ?>
                                    <option value="<?=$t?>" <?php if ($tahun==$t) echo "selected"; ?>><?=$t?></option>
                                <?php } ?>
                            </select>    
                        </div>
                        <div class="row margin-top-30">           
                           <div class="dashboard-stat color-4">
                            <div class="dashboard-stat-content"><h4><?=$totalgrafik[$row->id_instansi]?></h4> <span>Total Realisasi Kegiatan</span></div>
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
                          <td><?=$grafik1[$row->id_instansi][1]?></td>
                          <td><?=$grafik1[$row->id_instansi][2]?></td>
                          <td><?=$grafik1[$row->id_instansi][3]?></td>
                          <td><?=$grafik1[$row->id_instansi][4]?></td>
                      </tr>
                      <tr>
                          <td><?php echo ($totalgrafik[$row->id_instansi]==0) ? "0" : round(($grafik1[$row->id_instansi][1] / $totalgrafik[$row->id_instansi]) * 100, 2 )?>%</td>
                          <td><?php echo ($totalgrafik[$row->id_instansi]==0) ? "0" : round(($grafik1[$row->id_instansi][2] / $totalgrafik[$row->id_instansi]) * 100, 2 )?>%</td>
                          <td><?php echo ($totalgrafik[$row->id_instansi]==0) ? "0" : round(($grafik1[$row->id_instansi][3] / $totalgrafik[$row->id_instansi]) * 100, 2 )?>%</td>
                          <td><?php echo ($totalgrafik[$row->id_instansi]==0) ? "0" : round(($grafik1[$row->id_instansi][4] / $totalgrafik[$row->id_instansi]) * 100, 2 )?>%</td>
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

                            <?php endforeach ?>







  </div>
</div>
<!-- Container / End -->
</div>


