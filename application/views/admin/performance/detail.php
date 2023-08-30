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
      <center><img style="width: 80%" src="<?php echo base_url()."asset/pixel/" ;?>plugins/images/users/genu.jpg" alt="user" class="img-circle"/>   </center>         
      <div class="user-btm-box">
        <!-- .row -->
        <div class="row text-center m-t-10">
          <div class="col-md-6 b-r"><strong>Nama Lengkap</strong>
            <p>Genelia Dseshmukh</p>
          </div>
          <div class="col-md-6"><strong>Telepon</strong>
            <p>Designer</p>
          </div>
        </div>
        <!-- /.row -->
        <!-- /.row -->
        <hr>
        <!-- .row -->
        <div class="row text-center m-t-10">
          <div class="col-md-12"><strong>Alamat</strong>
            <p>E104, Dharti-2, Chandlodia Ahmedabad
              <br/> Gujarat, India.</p>
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
    <div class="col-md-8">
      <div class="white-box">
        <div class="row">
          <div class="col-md-12">
            <canvas id="chart1"></canvas>
          </div>
        </div>

      </div>
      <div class="white-box">
        <p class="lead">Progress Kegiatan</p>
        <hr>
        <div class="row">
          <form class="form-horizontal">
            <div class="col-md-3">
              <input type="text" name="" class="form-control" placeholder="Tanggal Awal">

            </div>
            <div class="col-md-3">

              <input type="text" name="" class="form-control" placeholder="Tanggal Akhir">
            </div>

            <div class="col-md-3">
              <select class="form-control">
                <option value="">Semua</option>
                <option value="">Selesai</option>
                <option value="">Dalam Proses</option>
              </select>
            </div>
            <div class="col-md-3">

              <button type="submit" class="btn btn-success btn-block">Filter</button>

            </div>
          </form>
        </div>
        <hr>
        <div class="row">
          <div class="col-md-11">
            <h5>Pekerjaan 1 <span class="pull-right">80%</span></h5>
          </div>
          <div class="col-md-1">
            <h5><a href="" class="btn btn-success btn-xs pull-right">Detail</a></h5>
          </div>
        </div>
        <div class="progress">
          <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width:80%;"> <span class="sr-only">50% Complete</span> </div>
        </div>
        <div class="row">
          <div class="col-md-11">
            <h5>Pekerjaan 1 <span class="pull-right">80%</span></h5>
          </div>
          <div class="col-md-1">
            <h5><a href="" class="btn btn-success btn-xs pull-right">Detail</a></h5>
          </div>
        </div>
        <div class="progress">
          <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width:80%;"> <span class="sr-only">50% Complete</span> </div>
        </div>
        <div class="row">
          <div class="col-md-11">
            <h5>Pekerjaan 1 <span class="pull-right">80%</span></h5>
          </div>
          <div class="col-md-1">
            <h5><a href="" class="btn btn-success btn-xs pull-right">Detail</a></h5>
          </div>
        </div>
        <div class="progress">
          <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width:80%;"> <span class="sr-only">50% Complete</span> </div>
        </div>
      </div>
      <div class="white-box">
        <div class="row">
          <div class="col-md-12">

            <p class="lead">Aktifitas</p>
            <hr>
        <div class="row">
          <form class="form-horizontal">
            <div class="col-md-3">
              <input type="text" name="" class="form-control" placeholder="Tanggal Awal">

            </div>
            <div class="col-md-3">

              <input type="text" name="" class="form-control" placeholder="Tanggal Akhir">
            </div>

            <div class="col-md-3">
              <select class="form-control">
                <option value="">Semua Jenis</option>
                <option value="">Jenis 1</option>
                <option value="">Jenis 2</option>
                <option value="">Jenis 3</option>
              </select>
            </div>
            <div class="col-md-3">

              <button type="submit" class="btn btn-success btn-block">Filter</button>

            </div>
          </form>
        </div>
        <hr>

                        <div class="steamline">
                                <div class="sl-item">
                                    <div class="sl-left"> <img src="<?php echo base_url()."asset/pixel/" ?>plugins/images/users/ritesh.jpg" alt="user" class="img-circle" /> </div>
                                    <div class="sl-right">
                                        <div class="m-l-40">
                                          <a href="#" class="text-info">Nama Kegiatan</a> 
                                          <span class="label label-success pull-right">Jenis</span><br>
                                          <span class="sl-date">15 Agustus 2018</span>
                                            <p class="m-t-10"> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam. Sed nisi. Nulla quis sem at nibh elementum imperdiet. Duis sagittis ipsum. Praesent mauris. Fusce nec tellus sed augue semper... </p>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="sl-item">
                                    <div class="sl-left"> <img src="<?php echo base_url()."asset/pixel/" ?>plugins/images/users/ritesh.jpg" alt="user" class="img-circle" /> </div>
                                    <div class="sl-right">
                                        <div class="m-l-40">
                                          <a href="#" class="text-info">Nama Kegiatan</a> 
                                          <span class="label label-success pull-right">Jenis</span><br>
                                          <span class="sl-date">15 Agustus 2018</span>
                                            <p class="m-t-10"> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam. Sed nisi. Nulla quis sem at nibh elementum imperdiet. Duis sagittis ipsum. Praesent mauris. Fusce nec tellus sed augue semper... </p>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="sl-item">
                                    <div class="sl-left"> <img src="<?php echo base_url()."asset/pixel/" ?>plugins/images/users/ritesh.jpg" alt="user" class="img-circle" /> </div>
                                    <div class="sl-right">
                                        <div class="m-l-40">
                                          <a href="#" class="text-info">Nama Kegiatan</a> 
                                          <span class="label label-success pull-right">Jenis</span><br>
                                          <span class="sl-date">15 Agustus 2018</span>
                                            <p class="m-t-10"> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam. Sed nisi. Nulla quis sem at nibh elementum imperdiet. Duis sagittis ipsum. Praesent mauris. Fusce nec tellus sed augue semper... </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
          </div>
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
