
    <!-- xeditable css -->
    <link href="<?php echo base_url()."asset/pixel/" ;?>plugins/bower_components/x-editable/dist/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet" />
    <script type="text/javascript">

    function save_setting(){
        $.ajax({
        url:"<?php echo base_url('manage_user/change_password/'.$this->session->userdata('user_id'));?>",
            type : "POST",
            data: $('#form-setting').serialize(),
            success:function(data){
                $("#message").html(data);
                $("#btnSetting").html('Update Profile');
            }
            ,beforeSend:function()
                {
                $("#message").html('');
                $("#btnSetting").html('<i class="fa fa-circle-o-notch fa-spin"></i> Please wait ...');
            }

        })

        return false;
    }

    function x_update(name,value){
      // data = new FormData($('#form')[0]);
      $.ajax({
        url:"<?php echo base_url('manage_user/x_update_profile');?>",
        type:"POST",
        data: {id:'<?php echo $this->session->userdata('user_id');?>', name:name, value:value},
        success:function(resp){
            //alert(resp);
            // window.location.reload(false);
            //$('#status-'+no).html('<span class="label label-danger">Ditangguhkan</span>');
            /*$('#proses-'+no).removeClass('hidden');
            $('#kirim-'+no).addClass('hidden');
            $('#button-status-'+no).attr('class','fcbtn btn btn-outline btn-info btn-rounded btn-1e');
            //$('#button-status-'+no).attr('data-content',$('#note').val());
            document.getElementById('button-status-'+no).innerHTML = " progress ";
            document.getElementById("form").reset();
            //progressbar();
            $('#status-'+no).val('progress');*/
        },
        error:function(event, textStatus, errorThrown) {
           alert('Error Message: '+ textStatus + ' , HTTP Error: '+ errorThrown);
        }
      })
    }

    function x_update_image(){
      data = new FormData($('#form-profile-image')[0]);
      $.ajax({
        url:"<?php echo base_url('manage_user/x_update_profile_image/'.$this->session->userdata('user_id'));?>",
        type:"POST",
        data: data,
        cache: false,
        contentType: false,
        processData: false,
        beforeSend:function() {
            $('#input-file-user-picture').attr("disabled",true);
        },
        success:function(resp){
            alert(resp);
            window.location.reload(false);
            //$('#status-'+no).html('<span class="label label-danger">Ditangguhkan</span>');
            /*$('#proses-'+no).removeClass('hidden');
            $('#kirim-'+no).addClass('hidden');
            $('#button-status-'+no).attr('class','fcbtn btn btn-outline btn-info btn-rounded btn-1e');
            //$('#button-status-'+no).attr('data-content',$('#note').val());
            document.getElementById('button-status-'+no).innerHTML = " progress ";
            document.getElementById("form").reset();
            //progressbar();
            $('#status-'+no).val('progress');*/
        },
        error:function(event, textStatus, errorThrown) {
           alert('Error Message: '+ textStatus + ' , HTTP Error: '+ errorThrown);
           $('#input-file-user-picture').attr("disabled",false);
           $('#form-profile-image')[0].reset();
        }
      })
    }
</script>

<div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Dashboard</h4> </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <ol class="breadcrumb">
                            <li class="active">Dashboard</li>

                        </ol>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12 col-sm-12 col-xs-12">
                        <div class="collapse m-t-15" id="pgr1" aria-expanded="true"> <pre class="line-numbers language-javascript m-t-0"></pre> </div>
                        <div class="row">
                            <div class="col-lg-3 col-sm-3 col-xs-12">
                                <div class="white-box">
                                    <h3 class="box-title">Pengguna</h3>
                                    <ul class="list-inline two-part">
                                        <li><i class="icon-people text-danger"></i></li>
                                        <li class="text-right"><span class="counter"><?php echo $user;?></span></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-3 col-xs-12">
                                <div class="white-box">
                                    <h3 class="box-title"> Unit Kerja</h3>
                                    <ul class="list-inline two-part">
                                        <li><i class="icon-compass text-info"></i></li>
                                        <li class="text-right"><span class="counter"><?php echo $skpd; ?></span></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-3 col-xs-12">
                                <div class="white-box">
                                    <h3 class="box-title"> Jumlah IKU</h3>
                                    <ul class="list-inline two-part">
                                        <li><i class="icon-folder text-success"></i></li>
                                        <li class="text-right"><span class="counter">1</span></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-3 col-xs-12">
                                <div class="white-box">
		                            <h3 class="box-title">Total anggaran</h3>
                                    <ul class="list-inline two-part">
                                        <li><i data-icon="d" class="linea-icon linea-basic fa-fw"></i></li>
                                        <li class="text-left">Menunggu API SIPD..</li>
                                    </ul>
		                        </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- .row -->

                    <!-- /.row -->
                <div class="row">
                    <div class="col-md-12 col-lg-12 col-sm-12">
                        <div class="white-box">
                            <div class="row row-in">
                                <div class="col-lg-3 col-sm-6 row-in-br">
                                    <div class="col-in row">
                                        <div class="col-md-6 col-sm-6 col-xs-6"> <i class="ti-user"></i>
                                            <h5 class="text-muted vb">Jumlah Misi</h5> </div>
                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                            <h3 class="counter text-right m-t-15 text-danger"><?php echo $misi; ?></h3> </div>
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <div class="progress">
                                                <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%"> <span class="sr-only">40% Complete (success)</span> </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-6 row-in-br  b-r-none">
                                    <div class="col-in row">
                                        <div class="col-md-6 col-sm-6 col-xs-6"> <i class="ti-pencil-alt"></i>
                                            <h5 class="text-muted vb">Jumlah Sasaran Strategis</h5> </div>
                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                            <h3 class="counter text-right m-t-15 text-info"><?php echo $sasaran_strategis; ?></h3> </div>
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <div class="progress">
                                                <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%"> <span class="sr-only">40% Complete (success)</span> </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-6 row-in-br">
                                    <div class="col-in row">
                                        <div class="col-md-6 col-sm-6 col-xs-6"> <i class="ti-mouse-alt"></i>
                                            <h5 class="text-muted vb">Jumlah Sasaran Program</h5> </div>
                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                            <h3 class="counter text-right m-t-15 text-success"><?php echo $sasaran_program; ?></h3> </div>
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <div class="progress">
                                                <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%"> <span class="sr-only">40% Complete (success)</span> </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-6  b-0">
                                    <div class="col-in row">
                                        <div class="col-md-6 col-sm-6 col-xs-6"> <i class="ti-receipt"></i>
                                            <h5 class="text-muted vb">Jumlah Sasaran Kegiatan</h5> </div>
                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                            <h3 class="counter text-right m-t-15 text-warning"><?php echo $sasaran_kegiatan; ?></h3> </div>
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <div class="progress">
                                                <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%"> <span class="sr-only">40% Complete (success)</span> </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-6">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                <div class="panel-action"><a href="#"><i class="ti-printer"></i></a></div>
                                    Grafik Jenis Kelamin
                                </div>
                                <div class="panel panel-body">
                                    <div class="chart-wrapper">
                                        <canvas id="pie-canvas1" width="500px"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                <div class="panel-action"><a href="#"><i class="ti-printer"></i></a></div>
                                    Grafik Status Pegawai
                                </div>
                                <div class="panel panel-body">
                                   <div class="chart-wrapper">
                                        <canvas id="pie-canvas2" width="500px"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-4">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                <div class="panel-action"><a href="#"><i class="ti-printer"></i></a></div>
                                    Grafik Jenis Pendidikan
                                </div>
                                <div class="panel panel-body">
                                    <div class="chart-wrapper">
                                        <canvas id="bar-canvas1"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                <div class="panel-action"><a href="#"><i class="ti-printer"></i></a></div>
                                    Grafik Golongan
                                </div>
                                <div class="panel panel-body">
                                    <div class="chart-wrapper">
                                        <canvas id="bar-canvas2"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                <div class="panel-action"><a href="#"><i class="ti-printer"></i></a></div>
                                    Grafik Golongan Ruang I
                                </div>
                                <div class="panel panel-body">
                                    <div class="chart-wrapper">
                                        <canvas id="bar-canvas3"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-4">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                <div class="panel-action"><a href="#"><i class="ti-printer"></i></a></div>
                                    Grafik Golongan Ruang II
                                </div>
                                <div class="panel panel-body">
                                    <div class="chart-wrapper">
                                        <canvas id="bar-canvas4"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                <div class="panel-action"><a href="#"><i class="ti-printer"></i></a></div>
                                    Grafik Golongan Ruang III
                                </div>
                                <div class="panel panel-body">
                                    <div class="chart-wrapper">
                                        <canvas id="bar-canvas5"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                <div class="panel-action"><a href="#"><i class="ti-printer"></i></a></div>
                                    Grafik Golongan Ruang IV
                                </div>
                                <div class="panel panel-body">
                                    <div class="chart-wrapper">
                                        <canvas id="bar-canvas6"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->

                <!-- <?php
                    foreach($grafik_kelamin as $row){
                        $g_kelamin[] = $row['kelamin'];
                        $t_kelamin[] = $row['total'];
                      }

                    foreach($grafik_nama_statuspeg as $row){
                        $g_nama_statuspeg[] = $row['nama_statuspeg'];
                        $t_nama_statuspeg[] = $row['total'];
                      }

                    foreach($grafik_pendidikan as $row){
                        $g_pendidikan[] = $row['pendidikan'];
                        $t_pendidikan[] = $row['total'];
                      }

                    foreach($grafik_golongan as $row){
                        $g_golongan[] = $row['gol'];
                        $t_golongan[] = $row['total'];
                      }

                    foreach($grafik_golongan_1 as $row){
                        $g_golongan_1[] = $row['gol'];
                        $t_golongan_1[] = $row['total'];
                        $j_golongan_1 = array_sum($t_golongan_1);
                      }

                    foreach($grafik_golongan_2 as $row){
                        $g_golongan_2[] = $row['gol'];
                        $t_golongan_2[] = $row['total'];
                        $j_golongan_2 = array_sum($t_golongan_2);
                      }

                    foreach($grafik_golongan_3 as $row){
                        $g_golongan_3[] = $row['gol'];
                        $t_golongan_3[] = $row['total'];
                        $j_golongan_3 = array_sum($t_golongan_3);
                      }

                    foreach($grafik_golongan_4 as $row){
                        $g_golongan_4[] = $row['gol'];
                        $t_golongan_4[] = $row['total'];
                        $j_golongan_4 = array_sum($t_golongan_4);
                      }
                ?> -->

          <i id="pie-canvas1"></i>
          <i id="doughnut-canvas1"></i>
          <i id="pie-canvas2"></i>
          <i id="doughnut-canvas2"></i>
          <i id="pie-canvas3"></i>
          <i id="doughnut-canvas3"></i>
          <i id="pie-canvas4"></i>
          <i id="doughnut-canvas4"></i>
          <i id="pie-canvas5"></i>
          <i id="doughnut-canvas5"></i>
          <i id="pie-canvas6"></i>
          <i id="doughnut-canvas6"></i>
          <i id="pie-canvas7"></i>
          <i id="doughnut-canvas7"></i>
          <i id="pie-canvas8"></i>
          <i id="doughnut-canvas8"></i>
          <i id="pie-canvas10"></i>
          <i id="doughnut-canvas10"></i>
          <i id="pie-canvas11"></i>
          <i id="doughnut-canvas11"></i>
          <i id="polarArea-canvas1"></i>
          <i id="bar-canvas1"></i>
          <i id="bar-canvas2"></i>
          <i id="bar-canvas3"></i>

          <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.bundle.min.js"></script>
          <script type="text/javascript" src="<?php echo base_url()."asset/chartjs-plugin-labels/" ;?>src/chartjs-plugin-labels.js"></script>

          <script>
            function hexToRgb(hex) {
              // Expand shorthand form (e.g. "03F") to full form (e.g. "0033FF")
              var shorthandRegex = /^#?([a-f\d])([a-f\d])([a-f\d])$/i;
              hex = hex.replace(shorthandRegex, function (m, r, g, b) {
                return r + r + g + g + b + b;
              });

              var result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);
              return result ? {
                r: parseInt(result[1], 16),
                g: parseInt(result[2], 16),
                b: parseInt(result[3], 16)
              } : null;
            }


            new Chart(document.getElementById('pie-canvas1'), {
              type: 'pie',

              data: {
                labels: <?php echo json_encode($g_kelamin);?>,
                datasets: [
                  {
                    label: 'Jumlah',
                    data: <?php echo json_encode($t_kelamin);?>,
                    backgroundColor: [
                      '#FF6384',
                      '#36A2EB'
                    ]
                  }
                ]
              },
              options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                  labels: [{
                    render: 'value',
                    fontColor: 'black',
                    position : 'outside'
                  },
                  {
                    render : 'percentage',
                    fontColor: 'white'
                  }
                ]
                }
              }
            });
            new Chart(document.getElementById('pie-canvas2'), {
              type: 'pie',

              data: {
                labels: <?php echo json_encode($g_nama_statuspeg);?>,
                datasets: [
                  {
                    label: 'Jumlah',
                    data: <?php echo json_encode($t_nama_statuspeg);?>,
                    backgroundColor: [
                      '#FF6384',
                      '#36A2EB',
                      '#FFCE56'
                    ]
                  }
                ]
              },
              options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                  labels: [{
                    render: 'value',
                    fontColor: 'black',
                    position : 'outside'
                  },
                  {
                    render : 'percentage',
                    fontColor: 'white'
                  }
                ]
                }
              }
            });
            new Chart(document.getElementById('pie-canvas3'), {
              type: 'pie',

              data: {
                labels: <?php echo json_encode($g_pendidikan);?>,
                datasets: [
                  {
                    label: 'Jumlah',
                    data: <?php echo json_encode($t_pendidikan);?>,
                    backgroundColor: [
                      '#FF6384',
                      '#36A2EB',
                      '#FFCE56'
                    ]
                  }
                ]
              },
              options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                  labels: [{
                    render: 'value',
                    fontColor: 'black',
                    position : 'outside'
                  },
                  {
                    render : 'percentage',
                    fontColor: 'white'
                  }
                ]
                }
              }
            });

            new Chart(document.getElementById('bar-canvas1'), {
              type: 'bar',

              data: {
                labels: <?php echo json_encode($g_pendidikan);?>,
                datasets: [
                  {
                    label: 'Jumlah',
                    data: <?php echo json_encode($t_pendidikan);?>,
                    backgroundColor: [
                      '#FF6384',
                      '#36A2EB',
                      '#FFCE56'
                    ]
                  }
                ]
              },
              options: {
                responsive: true,
                maintainAspectRatio: false,
                legend: {
                  display: false
                },
                plugins: {
                  labels: {
                    render: 'value'
                  }
                }
              }
            });
            new Chart(document.getElementById('bar-canvas2'), {
              type: 'bar',

              data: {
                labels: ['Gol IV', 'Gol III', 'Gol II', 'Gol I'],
                datasets: [
                  {
                    label: 'Jumlah',
                    data: ['<?=$j_golongan_4?>','<?=$j_golongan_3?>','<?=$j_golongan_2?>','<?=$j_golongan_1?>'],
                    backgroundColor: [
                      '#FF6384',
                      '#36A2EB',
                      '#FFCE56'
                    ]
                  }
                ]
              },
              options: {
                responsive: true,
                maintainAspectRatio: false,
                legend: {
                  display: false
                },
                plugins: {
                  labels: {
                    render: 'value'
                  }
                }
              }
            });
            new Chart(document.getElementById('bar-canvas3'), {
              type: 'bar',

              data: {
                labels: <?php echo json_encode($g_golongan_1);?>,
                datasets: [
                  {
                    label: 'Jumlah',
                    data: <?php echo json_encode($t_golongan_1);?>,
                    backgroundColor: [
                      '#FF6384',
                      '#36A2EB',
                      '#FFCE56'
                    ]
                  }
                ]
              },
              options: {
                responsive: true,
                maintainAspectRatio: false,
                legend: {
                  display: false
                },
                plugins: {
                  labels: {
                    render: 'value'
                  }
                }
              }
            });
            new Chart(document.getElementById('bar-canvas4'), {
              type: 'bar',

              data: {
                labels: <?php echo json_encode($g_golongan_2);?>,
                datasets: [
                  {
                    label: 'Jumlah',
                    data: <?php echo json_encode($t_golongan_2);?>,
                    backgroundColor: [
                      '#FF6384',
                      '#36A2EB',
                      '#FFCE56'
                    ]
                  }
                ]
              },
              options: {
                responsive: true,
                maintainAspectRatio: false,
                legend: {
                  display: false
                },
                plugins: {
                  labels: {
                    render: 'value'
                  }
                }
              }
            });
            new Chart(document.getElementById('bar-canvas5'), {
              type: 'bar',

              data: {
                labels: <?php echo json_encode($g_golongan_3);?>,
                datasets: [
                  {
                    label: 'Jumlah',
                    data: <?php echo json_encode($t_golongan_3);?>,
                    backgroundColor: [
                      '#FF6384',
                      '#36A2EB',
                      '#FFCE56'
                    ]
                  }
                ]
              },
              options: {
                responsive: true,
                maintainAspectRatio: false,
                legend: {
                  display: false
                },
                plugins: {
                  labels: {
                    render: 'value'
                  }
                }
              }
            });
            new Chart(document.getElementById('bar-canvas6'), {
              type: 'bar',

              data: {
                labels: <?php echo json_encode($g_golongan_4);?>,
                datasets: [
                  {
                    label: 'Jumlah',
                    data: <?php echo json_encode($t_golongan_4);?>,
                    backgroundColor: [
                      '#FF6384',
                      '#36A2EB',
                      '#FFCE56'
                    ]
                  }
                ]
              },
              options: {
                responsive: true,
                maintainAspectRatio: false,
                legend: {
                  display: false
                },
                plugins: {
                  labels: {
                    render: 'value'
                  }
                }
              }
            });
            new Chart(document.getElementById('bar-canvas7'), {
              type: 'bar',

              data: {
                labels: ['January', 'February', 'March'],
                datasets: [
                  {
                    label: 'Jumlah',
                    data: [50445, 33655, 15900],
                    backgroundColor: [
                      '#FF6384',
                      '#36A2EB',
                      '#FFCE56'
                    ]
                  }
                ]
              },
              options: {
                responsive: true,
                maintainAspectRatio: false,
                legend: {
                  display: false
                },
                plugins: {
                  labels: {
                    render: 'value'
                  }
                }
              }
            });
            new Chart(document.getElementById('bar-canvas8'), {
              type: 'bar',

              data: {
                labels: ['January', 'February', 'March'],
                datasets: [
                  {
                    label: 'Jumlah',
                    data: [50445, 33655, 15900],
                    backgroundColor: [
                      '#FF6384',
                      '#36A2EB',
                      '#FFCE56'
                    ]
                  }
                ]
              },
              options: {
                responsive: true,
                maintainAspectRatio: false,
                legend: {
                  display: false
                },
                plugins: {
                  labels: {
                    render: 'value'
                  }
                }
              }
            });
            new Chart(document.getElementById('bar-canvas9'), {
              type: 'bar',
              data: {
                labels: ['Januari', 'Februari', 'Maret'],
                datasets: [
                  {
                    label: 'Surat Masuk',
                    data: [50445, 33655, 15900],
                    backgroundColor: [
                      '#FF6384',
                      '#FF6384',
                      '#FF6384'
                    ]
                  },
                  {
                    label: 'Surat Keluar',
                    data: [40445, 23655, 35900],
                    backgroundColor: [
                      '#36A2EB',
                      '#36A2EB',
                      '#36A2EB'
                    ]
                  }
                ]
              },
              options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                  labels: {
                    render: 'percentage'
                  }
                }
              }
            });
            new Chart(document.getElementById('bar-canvas10'), {
              type: 'bar',
              data: {
                labels: ['Januari', 'Februari', 'Maret'],
                datasets: [
                  {
                    label: 'Surat Masuk',
                    data: [50445, 33655, 15900],
                    backgroundColor: [
                      '#FF6384',
                      '#FF6384',
                      '#FF6384'
                    ]
                  },
                  {
                    label: 'Surat Keluar',
                    data: [40445, 23655, 35900],
                    backgroundColor: [
                      '#36A2EB',
                      '#36A2EB',
                      '#36A2EB'
                    ]
                  }
                ]
              },
              options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                  labels: {
                    render: 'percentage'
                  }
                }
              }
            });


          </script>
