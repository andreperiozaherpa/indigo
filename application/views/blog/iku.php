
    <link href="http://202.93.229.205:80/sakip/asset/pixel/plugins/bower_components/orgchart/orgchart.css" rel="stylesheet" type="text/css"/>
    <style type="text/css">
      .panel{
    border-radius:3px;
    margin-bottom:15px;
    border:0
}
.panel .panel-heading{
    border-radius:3px;
    font-weight:500;
    text-transform:uppercase;
    padding:20px 25px
}
.panel .panel-heading .panel-title{
    font-size:14px;
    color:#3e4d6c
}
.panel .panel-heading a i{
    font-size:12px;
    margin-left:8px
}
.panel .panel-action{
    float:right
}
.panel .panel-action a{
    opacity:.5
}
.panel .panel-action a:hover{
    opacity:1
}
.panel .panel-body{
    padding:25px;
    border:1px solid #dddddd;
}
.panel .panel-body:first-child h3{
    margin-top:0;
    font-weight:500;
    font-family:Rubik,sans-serif;
    font-size:14px;
    text-transform:uppercase
}
.panel .panel-footer{
    background:#fff;
    border-radius:3px;
    padding:20px 25px
}
.panel-green,.panel-success{
    border-color:#00c292
}
.panel-green .panel-heading,.panel-success .panel-heading{
    border-color:#00c292;
    color:#fff;
    background-color:#00c292
}
.panel-green .panel-heading a,.panel-success .panel-heading a{
    color:#fff
}
.panel-green .panel-heading a:hover,.panel-success .panel-heading a:hover{
    color:rgba(255,255,255,.5)
}
.panel-green a,.panel-success a{
    color:#00c292
}
.panel-green a:hover,.panel-success a:hover{
    color:#007658
}
.panel-black,.panel-inverse{
    border-color:#3e4d6c
}
.panel-black .panel-heading,.panel-inverse .panel-heading{
    border-color:#3e4d6c;
    color:#fff;
    background-color:#3e4d6c
}
.panel-black .panel-heading a,.panel-inverse .panel-heading a{
    color:#fff
}
.panel-black .panel-heading a:hover,.panel-inverse .panel-heading a:hover{
    color:rgba(255,255,255,.5)
}
.panel-black a,.panel-inverse a{
    color:#3e4d6c
}
.panel-black a:hover,.panel-inverse a:hover{
    color:#222a3b
}
.panel-darkblue,.panel-primary{
    border-color:#6003c8
}
.panel-darkblue .panel-heading,.panel-primary .panel-heading{
    border-color:#6003c8;
    color:#fff;
    background-color:#6003c8
}
.panel-darkblue .panel-heading a,.panel-primary .panel-heading a{
    color:#fff
}
.panel-darkblue .panel-heading a:hover,.panel-primary .panel-heading a:hover{
    color:rgba(255,255,255,.5)
}
.panel-darkblue a,.panel-primary a{
    color:#6003c8
}
.panel-darkblue a:hover,.panel-primary a:hover{
    color:#1c3b6c
}
.panel-blue,.panel-info{
    border-color:#008efa
}
.panel-blue .panel-heading,.panel-info .panel-heading{
    border-color:#008efa;
    color:#fff;
    background-color:#008efa
}
.panel-blue .panel-heading a,.panel-info .panel-heading a{
    color:#fff
}
.panel-blue .panel-heading a:hover,.panel-info .panel-heading a:hover{
    color:rgba(255,255,255,.5)
}
.panel-blue a,.panel-info a{
    color:#008efa
}
.panel-blue a:hover,.panel-info a:hover{
    color:#0063ae
}
.panel-danger,.panel-red{
    border-color:#f75b36
}
.panel-danger .panel-heading,.panel-red .panel-heading{
    border-color:#f75b36;
    color:#fff;
    background-color:#f75b36
}
.panel-danger .panel-heading a,.panel-red .panel-heading a{
    color:#fff
}
.panel-danger .panel-heading a:hover,.panel-red .panel-heading a:hover{
    color:rgba(255,255,255,.5)
}
.panel-danger a,.panel-red a{
    color:#f75b36
}
.panel-danger a:hover,.panel-red a:hover{
    color:#d83009
}
.panel-warning,.panel-yellow{
    border-color:#f8c255
}
.panel-warning .panel-heading,.panel-yellow .panel-heading{
    border-color:#f8c255;
    color:#fff;
    background-color:#f8c255
}
.panel-warning .panel-heading a,.panel-yellow .panel-heading a{
    color:#fff
}
.panel-warning .panel-heading a:hover,.panel-yellow .panel-heading a:hover{
    color:rgba(255,255,255,.5)
}
.panel-warning a,.panel-yellow a{
    color:#f8c255
}
.panel-warning a:hover,.panel-yellow a:hover{
    color:#f5a80c
}
.panel-default,.panel-white{
    border-color:rgba(120,130,140,.21)
}
.panel-default .panel-heading,.panel-white .panel-heading{
    color:#3e4d6c;
    background-color:#fff;
    border-bottom:1px solid rgba(120,130,140,.21)
}
.panel-default .panel-body,.panel-white .panel-body{
    color:#3e4d6c
}
.panel-default .panel-action a,.panel-white .panel-action a{
    color:#3e4d6c;
    opacity:.5
}
.panel-default .panel-action a:hover,.panel-white .panel-action a:hover{
    opacity:1;
    color:#3e4d6c
}
.panel-default .panel-footer,.panel-white .panel-footer{
    background:#fff;
    color:#3e4d6c;
    border-top:1px solid rgba(120,130,140,.21)
}

.btn-circle{
    width:30px;
    height:30px;
    padding:6px 0;
    border-radius:15px;
    text-align:center;
    font-size:12px;
    line-height:1.428571429
}
.btn-circle.btn-lg{
    width:50px;
    height:50px;
    padding:10px 16px;
    border-radius:25px;
    font-size:18px;
    line-height:1.33
}
.btn-circle.btn-xl{
    width:70px;
    height:70px;
    padding:10px 16px;
    border-radius:35px;
    font-size:24px;
    line-height:1.33
}
    </style>
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
.listing-thumbnail{
	margin: 0;
	position: absolute;
	top: 50%;
	left: 50%;
	transform: translate(-50%, -50%);
}
.listing-thumbnail span{
	font-size: 100px;
	color: #f91942;
}
</style>
<!-- Titlebar
	================================================== -->
	<div id="titlebar" class="gradient">
		<div class="container">
			<div class="row">
				<div class="col-md-12">

					<h2>Perencanaan Kinerja</h2><span>Daftar Perencanaan Kinerja</span>

					<!-- Breadcrumbs -->
					<nav id="breadcrumbs">
						<ul>
							<li><a href="<?php echo base_url();?>">Beranda</a></li>
							<li>Perencanaan Kinerja</li>
						</ul>
					</nav>

				</div>
			</div>
		</div>
	</div>


<!-- Content
	================================================== -->
	<div class="container">
		<div class="add-listing-section margin-top-45">

			<!-- Headline -->
			<div class="add-listing-headline">
				
          <h3 align="center">Daftar <?=$j?> dan Indikator Kinerja Utama</h3>
          <h4 align="center" ><?=$detail->nama_unit_kerja?></h4>
          <p align="center" class="muted"> Tahun <?=$detail->tahun_rkt?></p> 
			</div>

			<!-- Switcher ON-OFF Content -->
			<div class="switcher-coasntent">
				<div class="row">

  <!-- .row -->
  <script type="text/javascript">
    var IKU = [];
  </script>
  <div class="row" style="overflow-x: auto;"> 
    <div class="col-md-12">
      <div class="container">
        <ul id="tree-data" style="display:none">
          <li id="root">
            <!-- visi -->
            <div class="panel panel-primary" > 
              <div class="panel-heading"> 
                Visi
              </div> 
              <div class="panel-body"> 
                <?= !empty($visi->visi) ? $visi->visi : "";?> 
              </div> 
            </div>
            <!-- end visi -->
            <ul>
              <!--- Level 1 -->
              <!-- Misi 1 -->

          <?php 
            $CI =& get_instance();
            $CI->load->model('pohon_kerja_model');
            $IKU = array();
            $modal = 0;
            foreach ($misi as $m) {
              echo '
              <li id="node1">
                <div class="panel panel-primary" > 
                  <div class="panel-heading"> 
                    Misi
                  </div> 
                  <div class="panel-body"> 
                    '.$m->misi.'
                  </div> 
                </div>
                <ul>';

                
                $dataSS = $CI->pohon_kerja_model->getTujuan($m->id_misi);

                foreach ($dataSS as $ss) {

                    echo '
                      <li id="node11">
                        <div class="panel panel-success"> 
                          <div class="panel-heading" >                
                            Tujuan
                          </div> 
                          <div class="panel-body">'.$ss->tujuan.'</div>

                        </div>

                        <ul>';
                    $dataSP = $CI->pohon_kerja_model->getSasaranRPJMD($ss->id_tujuan);
                    // print_r($dataSP);die;
                    //echo "<li>"; print_r($paramSP); echo"</li>";
                    foreach ($dataSP as $sp) {
                        $dataInd = $CI->pohon_kerja_model->getIndikatorRPJMD($sp->id_sasaran_rpjmd
);

                      echo '

                      <li id="node11">
                        <div class="panel panel-info" > 
                          <div class="panel-heading" >                
                            Sasaran RPJMD
                          </div> 
                          <div class="panel-body">'.$sp->sasaran_rpjmd
.'</div>
                          <table class="table table-bordered">';

                    foreach ($dataInd as $ind) {
                      echo'
                            <tr>
                              <td>
                              <small><b>Indikator</b></small><br>
                              '.$ind->indikator_rpjmd.'</td>
                            </tr>';
                          }
                            echo'
                          </table>
                        </div>
                        <ul >';

                        $no=1;
                        foreach ($dataInd as $sk) {            
                          echo '
                          <!-- Sasaran Kegiatan -->
                          <li id="node11">
                            <div class="panel panel-warning" > 
                              <div class="panel-heading" >                
                               INDIKATOR '.$no.'
                              </div> 
                              <div class="panel-body">'.$sk->indikator_rpjmd.'</div>
                            </div>
                            <ul type="vertical">
                            ';

                    $dataSP = $CI->pohon_kerja_model->getSasaranSKPD($sk->id_indikator_rpjmd);

                    foreach($dataSP as $d){
                        $dataInd = $CI->pohon_kerja_model->getIndikatorSKPD($d->id_sasaran_skpd
);
                      echo '

                      <li id="node11">
                        <div class="panel panel-info" > 
                          <div class="panel-heading" >                
                            Sasaran SKPD
                          </div> 
                          <div class="panel-body">'.$d->sasaran_skpd
.'</div>
                          <table class="table table-bordered">';
                          $nooo=1;
                    foreach ($dataInd as $ind) {
                      echo'
                            <tr>
                              <td>
                              <small><b>Indikator '.$nooo.'</b></small><br>
                              '.$ind->indikator_skpd.'</td>
                            </tr>';
                            $nooo++;
                          }
                            echo'
                            <tr>
                              <td>
                              <small><b>Unit SKPD</b></small><br>
                              '.$d->nama_skpd.'</td>
                            </tr>
                          </table>
                        </div>';

                    }

                            echo'
                            </ul>
                          </li>
                          <!-- End Sasaran Kegiatan -->
                          ';
                          $no++;


                        }
                      echo '

                        </ul> 
                      </li>
                      ';
                    }

                  echo '
                      </ul>
                    </li>';
                }

              echo'
                </ul>
              </li>
              ';
            }
          ?>  
            </ul>

          </li>

        </ul>
          <div id="tree-view"></div>    
        </div>
        <?php 
          //echo "<pre>";print_r($IKU); echo "</pre>";
        ?>
        <script type="text/javascript">

          var _gaq = _gaq || [];
          _gaq.push(['_setAccount', 'UA-36251023-1']);
          _gaq.push(['_setDomainName', 'jqueryscript.net']);
          _gaq.push(['_trackPageview']);

          (function() {
            var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
            ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
            var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
          })();
        </script>
      </div>
      <!-- .row -->

    </div>

				</div>
				<!-- Switcher ON-OFF Content / End -->

			</div>
			<!-- Section / End -->
		</div>
