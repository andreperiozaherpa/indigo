

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


                            <?php foreach ($data_koordinator as $row): ?>
<script>
    var ctx = document.getElementById("barChart<?=$row->id_instansi?>");
    var barChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ["Triwulan 1", "Triwulan 2", "Triwulan 3", "Triwulan 4"],
            datasets: [{
                label: '# Jumlah Kegiatan',
                data: [
                    <?php foreach ($grafik1[$row->id_instansi] as $key => $value) {
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

    var ctx = document.getElementById("lineChart<?=$row->id_instansi?>");
    var lineChart = new Chart(ctx, {type: 'line',
            data: {
                labels: [
                    <?php foreach ($bulan as $bln) {
                        echo "'{$bln}', ";
                    } ?>
                ],
                datasets: [
                <?php foreach ($data_lembaga[$row->id_instansi] as $key => $value): ?>
                    {
                        label: '<?=$value->nama_instansi?>',
                        backgroundColor: COLOUR[<?=$key?>],
                        borderColor: COLOR[<?=$key?>],
                        data: [
                            <?php
                                $year = date('Y');
                                for($g=1;$g<=count($bulan);$g++)
                                {
                                 echo "{$grafik2[$row->id_instansi][$key][$g]}, ";
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
<script>
    var ctx = document.getElementById("areaChart<?=$row->id_instansi?>");
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
                         echo "{$grafik3[$row->id_instansi][$g]}, ";
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
    var ctx = document.getElementById("pieChart<?=$row->id_instansi?>");
    var pieChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: [
                <?php foreach ($data_lembaga[$row->id_instansi] as $key => $value) {
                    echo "'{$value->nama_instansi}', ";
                } ?>
            ],
            datasets: [{
                label: '# Jumlah Kegiatan',
                data: [
                    <?php foreach ($data_lembaga[$row->id_instansi] as $key => $value) {
                        echo "'{$grafik4[$row->id_instansi][$key]}', ";
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
    var ctx = document.getElementById("doughnutChart<?=$row->id_instansi?>");
    var doughnutChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: [
                <?php foreach ($data_lembaga[$row->id_instansi] as $key => $value) {
                    echo "'{$value->nama_instansi}', ";
                } ?>
            ],
            datasets: [{
                label: '# Jumlah Kegiatan',
                data: [
                    <?php foreach ($data_lembaga[$row->id_instansi] as $key => $value) {
                        echo "'{$grafik5[$row->id_instansi][$key]}', ";
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

<?php endforeach ?>