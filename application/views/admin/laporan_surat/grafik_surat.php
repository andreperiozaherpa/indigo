<div class="container-fluid">
  <div class="row bg-title">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
      <h4 class="page-title">Grafik Surat</h4>
    </div>
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
      <ol class="breadcrumb">
        <li class="active">Grafik Surat</li>
      </ol>
    </div>
    <!-- /.col-lg-12 -->
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="white-box">
        <div class="row">
          <form method="POST">
            <div class="col-md-12">
              <div class="row">
                <!-- <div class="form-group">
                                <label>Periode Tanggal Surat </label>
                                <div class="input-daterange input-group" id="datepicker">
                                        <input type="text" class="form-control" name="start" placeholder="Start" value="<?= isset($start) ? $start : NULL; ?>"/>
                                        <span class="input-group-addon bg-primary b-0 text-white">Sampai</span>
                                        <input type="text" class="form-control" name="end" placeholder="End" value="<?= isset($end) ? $end : NULL; ?>" />
                                    </div>
                            </div> -->
                <div class="col-md-3">

                  <div class="form-group">
                    <label>Berdasarkan Tahun</label>
                    <select class="form-control" onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">
                      <?php for ($i = 2014; $i < 2024; $i++) {
                        if ($this->uri->segment(3) == $i) {
                          $selected = "selected";
                        } else {
                          $selected = NULL;
                        }
                        print_r($this->uri->segment(2));
                        echo '<option value="' . base_url("laporan_surat/grafik_surat/" . $i) . '"' . $selected . '>' . $i . '</option>';
                      } ?>
                    </select>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label>SKPD</label>
                    <select name="id_skpd" class="form-control select2">
                      <?php
                      foreach ($skpd as $s) {
                        echo '<option value="' . $s->id_skpd . '">' . $s->nama_skpd . '</option>';
                      }
                      ?>
                    </select>
                  </div>
                </div>
              </div>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="white-box">
        <center>
        <h4 class="box-title">GRAFIK SURAT<br>SEKRETARIAT DAERAH<br>TAHUN 2021</h4>
        </center>
        <div class="panel panel-default">
          <div class="panel-heading">Grafik Perbandingan Surat Internal <?= $this->uri->segment(3) ?></div>
        </div>
        <div class="row">
          <div class="chart-wrapper">
            <canvas id="bar-canvas9"></canvas>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-12">
      <div class="white-box">
        <div class="panel panel-default">
          <div class="panel-heading">Grafik Perbandingan Surat Eksternal <?= $this->uri->segment(3) ?></div>
        </div>
        <div class="row">
          <div class="chart-wrapper">
            <canvas id="bar-canvas10"></canvas>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php
$sm_si_jan_hsl = isset($sm_si_jan['total']) ? $sm_si_jan['total'] : 0;
$sm_si_feb_hsl = isset($sm_si_feb['total']) ? $sm_si_feb['total'] : 0;
$sm_si_mar_hsl = isset($sm_si_mar['total']) ? $sm_si_mar['total'] : 0;
$sm_si_apr_hsl = isset($sm_si_apr['total']) ? $sm_si_apr['total'] : 0;
$sm_si_mei_hsl = isset($sm_si_mei['total']) ? $sm_si_mei['total'] : 0;
$sm_si_jun_hsl = isset($sm_si_jun['total']) ? $sm_si_jun['total'] : 0;
$sm_si_jul_hsl = isset($sm_si_jul['total']) ? $sm_si_jul['total'] : 0;
$sm_si_agu_hsl = isset($sm_si_agu['total']) ? $sm_si_agu['total'] : 0;
$sm_si_sep_hsl = isset($sm_si_sep['total']) ? $sm_si_sep['total'] : 0;
$sm_si_okt_hsl = isset($sm_si_okt['total']) ? $sm_si_okt['total'] : 0;
$sm_si_nov_hsl = isset($sm_si_nov['total']) ? $sm_si_nov['total'] : 0;
$sm_si_des_hsl = isset($sm_si_des['total']) ? $sm_si_des['total'] : 0;
$sk_si_jan_hsl = isset($sk_si_jan['total']) ? $sk_si_jan['total'] : 0;
$sk_si_feb_hsl = isset($sk_si_feb['total']) ? $sk_si_feb['total'] : 0;
$sk_si_mar_hsl = isset($sk_si_mar['total']) ? $sk_si_mar['total'] : 0;
$sk_si_apr_hsl = isset($sk_si_apr['total']) ? $sk_si_apr['total'] : 0;
$sk_si_mei_hsl = isset($sk_si_mei['total']) ? $sk_si_mei['total'] : 0;
$sk_si_jun_hsl = isset($sk_si_jun['total']) ? $sk_si_jun['total'] : 0;
$sk_si_jul_hsl = isset($sk_si_jul['total']) ? $sk_si_jul['total'] : 0;
$sk_si_agu_hsl = isset($sk_si_agu['total']) ? $sk_si_agu['total'] : 0;
$sk_si_sep_hsl = isset($sk_si_sep['total']) ? $sk_si_sep['total'] : 0;
$sk_si_okt_hsl = isset($sk_si_okt['total']) ? $sk_si_okt['total'] : 0;
$sk_si_nov_hsl = isset($sk_si_nov['total']) ? $sk_si_nov['total'] : 0;
$sk_si_des_hsl = isset($sk_si_des['total']) ? $sk_si_des['total'] : 0;
$sm_se_jan_hsl = isset($sm_se_jan['total']) ? $sm_se_jan['total'] : 0;
$sm_se_feb_hsl = isset($sm_se_feb['total']) ? $sm_se_feb['total'] : 0;
$sm_se_mar_hsl = isset($sm_se_mar['total']) ? $sm_se_mar['total'] : 0;
$sm_se_apr_hsl = isset($sm_se_apr['total']) ? $sm_se_apr['total'] : 0;
$sm_se_mei_hsl = isset($sm_se_mei['total']) ? $sm_se_mei['total'] : 0;
$sm_se_jun_hsl = isset($sm_se_jun['total']) ? $sm_se_jun['total'] : 0;
$sm_se_jul_hsl = isset($sm_se_jul['total']) ? $sm_se_jul['total'] : 0;
$sm_se_agu_hsl = isset($sm_se_agu['total']) ? $sm_se_agu['total'] : 0;
$sm_se_sep_hsl = isset($sm_se_sep['total']) ? $sm_se_sep['total'] : 0;
$sm_se_okt_hsl = isset($sm_se_okt['total']) ? $sm_se_okt['total'] : 0;
$sm_se_nov_hsl = isset($sm_se_nov['total']) ? $sm_se_nov['total'] : 0;
$sm_se_des_hsl = isset($sm_se_des['total']) ? $sm_se_des['total'] : 0;
$sk_se_jan_hsl = isset($sk_se_jan['total']) ? $sk_se_jan['total'] : 0;
$sk_se_feb_hsl = isset($sk_se_feb['total']) ? $sk_se_feb['total'] : 0;
$sk_se_mar_hsl = isset($sk_se_mar['total']) ? $sk_se_mar['total'] : 0;
$sk_se_apr_hsl = isset($sk_se_apr['total']) ? $sk_se_apr['total'] : 0;
$sk_se_mei_hsl = isset($sk_se_mei['total']) ? $sk_se_mei['total'] : 0;
$sk_se_jun_hsl = isset($sk_se_jun['total']) ? $sk_se_jun['total'] : 0;
$sk_se_jul_hsl = isset($sk_se_jul['total']) ? $sk_se_jul['total'] : 0;
$sk_se_agu_hsl = isset($sk_se_agu['total']) ? $sk_se_agu['total'] : 0;
$sk_se_sep_hsl = isset($sk_se_sep['total']) ? $sk_se_sep['total'] : 0;
$sk_se_okt_hsl = isset($sk_se_okt['total']) ? $sk_se_okt['total'] : 0;
$sk_se_nov_hsl = isset($sk_se_nov['total']) ? $sk_se_nov['total'] : 0;
$sk_se_des_hsl = isset($sk_se_des['total']) ? $sk_se_des['total'] : 0;
?>


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
<i id="bar-canvas4"></i>
<i id="bar-canvas5"></i>
<i id="bar-canvas6"></i>
<i id="bar-canvas7"></i>
<i id="bar-canvas8"></i>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.bundle.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() . "asset/chartjs-plugin-labels/"; ?>src/chartjs-plugin-labels.js"></script>

<script>
  function hexToRgb(hex) {
    // Expand shorthand form (e.g. "03F") to full form (e.g. "0033FF")
    var shorthandRegex = /^#?([a-f\d])([a-f\d])([a-f\d])$/i;
    hex = hex.replace(shorthandRegex, function(m, r, g, b) {
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
      labels: 'My Data Shet',
      datasets: [{
        label: 'Jumlah',
        data: [123, 3123, 123],
        backgroundColor: [
          '#FF6384',
          '#36A2EB'
        ]
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        labels: [{
            render: 'value',
            fontColor: 'black',
            position: 'outside'
          },
          {
            render: 'percentage',
            fontColor: 'white'
          }
        ]
      }
    }
  });
  new Chart(document.getElementById('pie-canvas2'), {
    type: 'pie',

    data: {
      labels: 'My dadwda',
      datasets: [{
        label: 'Jumlah',
        data: [1, 2, 3],
        backgroundColor: [
          '#FF6384',
          '#36A2EB',
          '#FFCE56'
        ]
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        labels: [{
            render: 'value',
            fontColor: 'black',
            position: 'outside'
          },
          {
            render: 'percentage',
            fontColor: 'white'
          }
        ]
      }
    }
  });
  new Chart(document.getElementById('pie-canvas3'), {
    type: 'pie',

    data: {
      labels: 'My datesdawd',
      datasets: [{
        label: 'Jumlah',
        data: [1, 3, 4],
        backgroundColor: [
          '#FF6384',
          '#36A2EB',
          '#FFCE56'
        ]
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        labels: [{
            render: 'value',
            fontColor: 'black',
            position: 'outside'
          },
          {
            render: 'percentage',
            fontColor: 'white'
          }
        ]
      }
    }
  });

  new Chart(document.getElementById('bar-canvas1'), {
    type: 'bar',

    data: {
      labels: 'd',
      datasets: [{
        label: 'Jumlah',
        data: [3, 5, 6],
        backgroundColor: [
          '#FF6384',
          '#36A2EB',
          '#FFCE56'
        ]
      }]
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
      datasets: [{
        label: 'Jumlah',
        data: [1, 3, 4, 5],
        backgroundColor: [
          '#FF6384',
          '#36A2EB',
          '#FFCE56'
        ]
      }]
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
      labels: 'mydawd',
      datasets: [{
        label: 'Jumlah',
        data: [1, 4, 5],
        backgroundColor: [
          '#FF6384',
          '#36A2EB',
          '#FFCE56'
        ]
      }]
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
      labels: 'dawd',
      datasets: [{
        label: 'Jumlah',
        data: [1, 5, 6],
        backgroundColor: [
          '#FF6384',
          '#36A2EB',
          '#FFCE56'
        ]
      }]
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
      labels: 'dawd',
      datasets: [{
        label: 'Jumlah',
        data: [1, 3, 4],
        backgroundColor: [
          '#FF6384',
          '#36A2EB',
          '#FFCE56'
        ]
      }]
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
      labels: 'dawd',
      datasets: [{
        label: 'Jumlah',
        data: [1, 5, 6],
        backgroundColor: [
          '#FF6384',
          '#36A2EB',
          '#FFCE56'
        ]
      }]
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
      datasets: [{
        label: 'Jumlah',
        data: [50445, 33655, 15900],
        backgroundColor: [
          '#FF6384',
          '#36A2EB',
          '#FFCE56'
        ]
      }]
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
      datasets: [{
        label: 'Jumlah',
        data: [50445, 33655, 15900],
        backgroundColor: [
          '#FF6384',
          '#36A2EB',
          '#FFCE56'
        ]
      }]
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
      labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
      datasets: [{
          label: 'Surat Masuk',
          data: <?= '["' . $sm_si_jan_hsl . '","' . $sm_si_feb_hsl . '","' . $sm_si_mar_hsl . '","' . $sm_si_apr_hsl . '","' . $sm_si_mei_hsl . '","' . $sm_si_jun_hsl . '","' . $sm_si_jul_hsl . '","' . $sm_si_agu_hsl . '","' . $sm_si_sep_hsl . '","' . $sm_si_okt_hsl . '","' . $sm_si_nov_hsl . '","' . $sm_si_des_hsl . '"]'; ?>,
          backgroundColor: [
            '#FF6384',
            '#FF6384',
            '#FF6384',
            '#FF6384',
            '#FF6384',
            '#FF6384',
            '#FF6384',
            '#FF6384',
            '#FF6384',
            '#FF6384',
            '#FF6384',
            '#FF6384',
            '#FF6384'
          ]
        },
        {
          label: 'Surat Keluar',
          data: <?= '["' . $sk_si_jan_hsl . '","' . $sk_si_feb_hsl . '","' . $sk_si_mar_hsl . '","' . $sk_si_apr_hsl . '","' . $sk_si_mei_hsl . '","' . $sk_si_jun_hsl . '","' . $sk_si_jul_hsl . '","' . $sk_si_agu_hsl . '","' . $sk_si_sep_hsl . '","' . $sk_si_okt_hsl . '","' . $sk_si_nov_hsl . '","' . $sk_si_des_hsl . '"]'; ?>,
          backgroundColor: [
            '#36A2EB',
            '#36A2EB',
            '#36A2EB',
            '#36A2EB',
            '#36A2EB',
            '#36A2EB',
            '#36A2EB',
            '#36A2EB',
            '#36A2EB',
            '#36A2EB',
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
          render: 'value'
        }
      }
    }
  });
  new Chart(document.getElementById('bar-canvas10'), {
    type: 'bar',
    data: {
      labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
      datasets: [{
          label: 'Surat Masuk',
          data: <?= '["' . $sm_se_jan_hsl . '","' . $sm_se_feb_hsl . '","' . $sm_se_mar_hsl . '","' . $sm_se_apr_hsl . '","' . $sm_se_mei_hsl . '","' . $sm_se_jun_hsl . '","' . $sm_se_jul_hsl . '","' . $sm_se_agu_hsl . '","' . $sm_se_sep_hsl . '","' . $sm_se_okt_hsl . '","' . $sm_se_nov_hsl . '","' . $sm_se_des_hsl . '"]'; ?>,
          backgroundColor: [
            '#FF6384',
            '#FF6384',
            '#FF6384',
            '#FF6384',
            '#FF6384',
            '#FF6384',
            '#FF6384',
            '#FF6384',
            '#FF6384',
            '#FF6384',
            '#FF6384',
            '#FF6384',
            '#FF6384'
          ]
        },
        {
          label: 'Surat Keluar',
          data: <?= '["' . $sk_se_jan_hsl . '","' . $sk_se_feb_hsl . '","' . $sk_se_mar_hsl . '","' . $sk_se_apr_hsl . '","' . $sk_se_mei_hsl . '","' . $sk_se_jun_hsl . '","' . $sk_se_jul_hsl . '","' . $sk_se_agu_hsl . '","' . $sk_se_sep_hsl . '","' . $sk_se_okt_hsl . '","' . $sk_se_nov_hsl . '","' . $sk_se_des_hsl . '"]'; ?>,
          backgroundColor: [
            '#36A2EB',
            '#36A2EB',
            '#36A2EB',
            '#36A2EB',
            '#36A2EB',
            '#36A2EB',
            '#36A2EB',
            '#36A2EB',
            '#36A2EB',
            '#36A2EB',
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
          render: 'value'
        }
      }
    }
  });
</script>