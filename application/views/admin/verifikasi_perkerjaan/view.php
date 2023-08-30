<div class="container-fluid">
  
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title"><?php echo title($title) ?></h4> </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12"> 
                <ol class="breadcrumb">
                    <?php echo breadcrumb($this->uri->segment_array()); ?>
                </ol>
            </div>
            <!-- /.col-lg-12 -->
        </div>
<div class="row">
  <div class="col-md-4">
    <div class="white-box">
      <center><img style="width: 80%" src="<?php echo base_url()."data/user_picture/".$detail->user_picture ;?>" alt="user" class="img-circle"/>   </center>         
      <div class="user-btm-box">
        <!-- .row -->
        <div class="row text-center m-t-10">
          <div class="col-md-6 b-r"><strong>Nama Lengkap</strong>
            <p><?=$detail->nama_lengkap?></p>
          </div>
          <div class="col-md-6"><strong>Telepon</strong>
            <p><?=$detail->telepon?></p>
          </div>
        </div>
        <!-- /.row -->
        <!-- /.row -->
        <hr>
        <!-- .row -->
        <div class="row text-center m-t-10">
          <div class="col-md-12"><strong>Alamat</strong>
            <p><?=$detail->alamat?></p>
            </div>
          </div>
          <div class="row text-center m-t-10">
            <div class="col-md-12">
              <a href="" class="btn btn-success btn-block"><i class="fa fa-user"></i> Lihat Profil Lengkap</a>
            </div>
          </div>
        </div>

      </div>
    </div>


<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 mail_listing">
  <div class="white-box">
                                    <div class="media m-b-30 p-t-20">
                                        <h4 class="font-bold m-t-0"><?=$detail->nama_kegiatan_realisasi?></h4>
                                        <span class="label label-info m-l-5 pull-right">Angka Kredit : <?=$detail->angka_kredit?></span>
                                        <hr>
                                        <a class="pull-left" href="#"> <img class="media-object thumb-sm img-circle" src="<?php echo base_url()."asset/pixel/" ;?>plugins/images/users/genu.jpg" alt=""> </a>
                                        <div class="media-body"> <span class="media-meta pull-right">22 Agustus 2018 <strong> - </strong> 24 Agustus 2018</span> 
                                            <h4 class="text-danger m-0"><?=$detail->nama_pekerjaan?></h4>
                                            </div>
                                    </div>

                                    <div class="row">
                                        
                                        <div class="col-md-3 col-xs-6 b-r"> <strong>Kuantitas</strong>
                                            <br>
                                            <p class="text-muted"><?=$detail->kuantitas?> <?=$kuantitas?></p>
                                        </div>
                                        <div class="col-md-3 col-xs-6 b-r"> <strong>Kualitas</strong>
                                            <br>
                                            <p class="text-muted"><?=$detail->kualitas?> <?=$kualitas?></p>
                                        </div>
                                        <div class="col-md-3 col-xs-6 b-r"> <strong>Biaya</strong>
                                            <br>
                                            <p class="text-muted"><?=$detail->biaya_realisasi?></p>
                                        </div>
                                        <div class="col-md-3 col-xs-6 b-r"> <strong>Waktu</strong>
                                            <br>
                                            <p class="text-muted"><?=$detail->waktu?> Bulan</p>
                                        </div>

                                    </div>

                                    <hr>
                                    <h5>Lokasi</h5>
                                    <hr>

                                       <div class="row">
                                        <div class="col-md-3 col-xs-6 b-r"> <strong>Nama Lokasi</strong>
                                            <br>
                                            <p class="text-muted"><?=$detail->nama_lokasi?></p>
                                        </div>
                                        <div class="col-md-9 col-xs-6 b-r"> <strong>Alamat</strong>
                                            <br>
                                            <p class="text-muted">Jawa Barat, Bogor </p>
                                        </div>
                                       
                                    </div>


                                    <hr>


                                 <h5>Uraian Kegiatan</h5> 

                                 <hr>
                                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem.Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi.</p>
                                    <p>enean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar,</p>
                                    <hr>
                                    <h4> <i class="fa fa-paperclip m-r-10 m-b-10"></i> Attachments <span>(3)</span> </h4>
                                    <div class="row">
                                        <div class="col-sm-2 col-xs-4">
                                            <a href="#"> File Dukungan</a>
                                        </div>
                                        
                                    </div>
                                    <hr>

                                    <div class="text-right">
                                         <button class="btn btn-default" type="submit"> Kembali </button>
                                        <button class="btn btn-success" type="submit"> Verifikasi </button>
                                        <button class="btn btn-danger" type="submit"> Tolak </button>
                                        <button onclick="javascript:window.print();" class="btn btn-default btn-outline" type="button"> <span><i class="fa fa-print"></i> Print</span> </button>
                                    </div>

                                    
                                </div>




    </div>
  </div>
</div>

<script type="text/javascript">
  $( document ).ready(function() {

    var ctx1 = document.getElementById("chart1").getContext("2d");
    var data1 = {
      labels: ["January", "February", "March", "April", "May", "June", "July"],
      datasets: [
      {
        label: "My First dataset",
        fillColor: "rgba(133,180,208,0.8)",
        strokeColor: "rgba(133,180,208,0.8)",
        pointColor: "rgba(133,180,208,1)",
        pointStrokeColor: "#fff",
        pointHighlightFill: "#fff",
        pointHighlightStroke: "rgba(133,180,208,1)",
        data: [0, 59, 80, 58, 20, 55, 40]
      }

      ]
    };

    var chart1 = new Chart(ctx1).Line(data1, {
      scaleShowGridLines : true,
      scaleGridLineColor : "rgba(0,0,0,.005)",
      scaleGridLineWidth : 0,
      scaleShowHorizontalLines: true,
      scaleShowVerticalLines: true,
      bezierCurve : true,
      bezierCurveTension : 0.4,
      pointDot : true,
      pointDotRadius : 4,
      pointDotStrokeWidth : 1,
      pointHitDetectionRadius : 2,
      datasetStroke : true,
      tooltipCornerRadius: 2,
      datasetStrokeWidth : 2,
      datasetFill : true,
      legendTemplate : "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].strokeColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
      responsive: true
    });

  });
</script>
<script src="<?php echo base_url()."asset/pixel/" ;?>plugins/bower_components/Chart.js/Chart.min.js"></script>
